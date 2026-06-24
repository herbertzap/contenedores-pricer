#!/usr/bin/env bash

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
PROJECT_ROOT="$(cd "$SCRIPT_DIR/../.." && pwd)"

# shellcheck source=config.sh
source "$SCRIPT_DIR/config.sh"

setup_brew_path() {
    if [[ -x /opt/homebrew/bin/brew ]]; then
        eval "$(/opt/homebrew/bin/brew shellenv)"
    elif [[ -x /usr/local/bin/brew ]]; then
        eval "$(/usr/local/bin/brew shellenv)"
    fi
}

install_homebrew_if_needed() {
    setup_brew_path
    if command -v brew >/dev/null 2>&1; then
        return 0
    fi

    echo ""
    echo "Instalando Homebrew (gestor de paquetes de macOS)..."
    echo "Puede pedir su contraseña de Mac..."
    NONINTERACTIVE=1 /bin/bash -c "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/HEAD/install.sh)"
    setup_brew_path

    if ! command -v brew >/dev/null 2>&1; then
        echo "[ERROR] No se pudo instalar Homebrew."
        echo "        Instale manualmente desde https://brew.sh y vuelva a ejecutar."
        return 1
    fi

    echo "       OK - Homebrew instalado."
    return 0
}

brew_install_if_missing() {
    local pkg="$1"
    if brew list "$pkg" &>/dev/null; then
        echo "       OK - ${pkg} ya instalado."
        return 0
    fi

    echo "       Instalando ${pkg} con Homebrew..."
    if ! brew install "$pkg"; then
        echo "[ERROR] No se pudo instalar ${pkg}."
        return 1
    fi
    echo "       OK - ${pkg} instalado."
    return 0
}

install_composer_if_needed() {
    if command -v composer >/dev/null 2>&1; then
        echo "       OK - Composer ya instalado."
        return 0
    fi

    if brew_install_if_missing composer; then
        return 0
    fi

    echo "       Descargando Composer..."
    php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
    php composer-setup.php --quiet --install-dir=/usr/local/bin --filename=composer 2>/dev/null \
        || php composer-setup.php --quiet --install-dir="$HOME/.local/bin" --filename=composer
    php -r "unlink('composer-setup.php');"

    if [[ -x "$HOME/.local/bin/composer" ]]; then
        export PATH="$HOME/.local/bin:$PATH"
    fi

    if command -v composer >/dev/null 2>&1; then
        echo "       OK - Composer instalado."
        return 0
    fi

    echo "[ERROR] No se pudo instalar Composer."
    return 1
}

install_system_dependencies() {
    echo ""
    echo "[Paso 0] Instalando herramientas del sistema (PHP, MySQL, Node.js, Composer)..."

    install_homebrew_if_needed || return 1
    setup_brew_path

    brew_install_if_missing php || return 1
    brew_install_if_missing mysql || return 1
    brew_install_if_missing node || return 1
    install_composer_if_needed || return 1

    if ! brew services list 2>/dev/null | grep -qE "^${BREW_MYSQL_SERVICE}\s"; then
        if brew services list 2>/dev/null | grep -qE "^mysql@"; then
            BREW_MYSQL_SERVICE="$(brew services list 2>/dev/null | awk '/^mysql@/{print $1; exit}')"
        fi
    fi

    echo "       OK - Herramientas del sistema listas."
    return 0
}

check_command() {
    if ! command -v "$1" >/dev/null 2>&1; then
        echo "[ERROR] No se encontro '$1' en el PATH."
        return 1
    fi
    return 0
}

mysql_cmd() {
    if [[ -n "$MYSQL_BIN" && -x "$MYSQL_BIN" ]]; then
        echo "$MYSQL_BIN"
    elif [[ -x /opt/homebrew/bin/mysql ]]; then
        echo "/opt/homebrew/bin/mysql"
    elif [[ -x /usr/local/bin/mysql ]]; then
        echo "/usr/local/bin/mysql"
    else
        echo "mysql"
    fi
}

mysql_exec() {
    local cmd
    cmd="$(mysql_cmd)"
    if [[ -z "$DB_PASS" ]]; then
        "$cmd" -h"$DB_HOST" -P"$DB_PORT" -u"$DB_USER" "$@"
    else
        "$cmd" -h"$DB_HOST" -P"$DB_PORT" -u"$DB_USER" -p"$DB_PASS" "$@"
    fi
}

start_mysql() {
    # shellcheck source=config.sh
    source "$SCRIPT_DIR/config.sh"
    setup_brew_path

    echo ""
    echo "Iniciando MySQL..."

    if mysql_exec -e "SELECT 1;" >/dev/null 2>&1; then
        echo "       OK - MySQL ya responde en ${DB_HOST}:${DB_PORT}."
        return 0
    fi

    if command -v brew >/dev/null 2>&1 && [[ -n "$BREW_MYSQL_SERVICE" ]]; then
        echo "       Iniciando servicio Homebrew: ${BREW_MYSQL_SERVICE}..."
        brew services start "$BREW_MYSQL_SERVICE" >/dev/null 2>&1 || true
        sleep 4
        if mysql_exec -e "SELECT 1;" >/dev/null 2>&1; then
            echo "       OK - MySQL iniciado con brew services."
            return 0
        fi
    fi

    if [[ -n "$MYSQL_START_CMD" ]]; then
        echo "       Ejecutando: ${MYSQL_START_CMD}"
        eval "$MYSQL_START_CMD"
        sleep 4
        if mysql_exec -e "SELECT 1;" >/dev/null 2>&1; then
            echo "       OK - MySQL responde tras comando personalizado."
            return 0
        fi
    fi

    if command -v mysql.server >/dev/null 2>&1; then
        mysql.server start >/dev/null 2>&1 || true
        sleep 3
        if mysql_exec -e "SELECT 1;" >/dev/null 2>&1; then
            echo "       OK - MySQL iniciado con mysql.server."
            return 0
        fi
    fi

    echo "[ERROR] No se pudo iniciar ni conectar a MySQL."
    echo "        Pruebe: brew services start mysql"
    return 1
}

create_database() {
    # shellcheck source=config.sh
    source "$SCRIPT_DIR/config.sh"

    if ! mysql_exec -e "CREATE DATABASE IF NOT EXISTS \`${DB_NAME}\` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"; then
        echo "[ERROR] No se pudo crear la base de datos '${DB_NAME}'."
        return 1
    fi
    echo "       OK - Base de datos '${DB_NAME}' lista."
    return 0
}

setup_env() {
    cd "$PROJECT_ROOT" || return 1

    if [[ -f .env ]]; then
        echo "       .env ya existe, se conserva la configuracion actual."
        return 0
    fi

    if [[ -f .env.mac.example ]]; then
        cp .env.mac.example .env
        echo "       OK - Archivo .env creado desde .env.mac.example"
        return 0
    fi

    if [[ -f .env.example ]]; then
        cp .env.example .env
        echo "       OK - Archivo .env creado desde .env.example"
        return 0
    fi

    echo "[ERROR] No se encontro .env.mac.example ni .env.example"
    return 1
}

open_browser() {
    local url="http://127.0.0.1:${LARAVEL_PORT}/sign-in"
    echo ""
    echo "Abriendo navegador en ${url}..."
    sleep "${BROWSER_WAIT_SECONDS:-4}"
    open "$url" 2>/dev/null || true
}

start_servers() {
    local open_browser_flag="${1:-false}"

    # shellcheck source=config.sh
    source "$SCRIPT_DIR/config.sh"

    echo ""
    echo "Abriendo servidores en ventanas de Terminal..."
    echo "  - Laravel: http://127.0.0.1:${LARAVEL_PORT}"
    echo "  - Vite:    compilacion de assets en caliente"
    echo ""

    local escaped_root
    escaped_root="$(printf '%s' "$PROJECT_ROOT" | sed "s/'/'\\\\''/g")"

    osascript <<EOF
tell application "Terminal"
    activate
    do script "cd '${escaped_root}' && echo '=== Laravel Server ===' && php artisan serve --host=127.0.0.1 --port=${LARAVEL_PORT}"
    delay 1
    do script "cd '${escaped_root}' && echo '=== Vite Dev ===' && npm run dev"
end tell
EOF

    if [[ "$open_browser_flag" == "true" ]]; then
        open_browser
    fi
}

seed_demo_data() {
    echo ""
    echo "Cargando datos de prueba y usuario super administrador..."
    php artisan migrate:fresh --seed --force
    echo "       OK - Datos de demostracion cargados."
}

print_credentials() {
    echo ""
    echo "  Credenciales de acceso:"
    echo "    Super Admin -> superadmin@pricer.cl / pricer123"
    echo "    Admin       -> admin@pricer.cl / pricer123"
}
