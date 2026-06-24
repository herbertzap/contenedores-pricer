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

brew_is_busy() {
    pgrep -x brew >/dev/null 2>&1 || pgrep -f "/brew install" >/dev/null 2>&1
}

cleanup_stale_brew_downloads() {
    if brew_is_busy; then
        return 0
    fi

    local cache_dir
    cache_dir="$(brew --cache 2>/dev/null || echo "$HOME/Library/Caches/Homebrew")"
    if [[ -d "$cache_dir/downloads" ]]; then
        find "$cache_dir/downloads" -name '*.incomplete' -delete 2>/dev/null || true
    fi
}

wait_for_brew_available() {
    local max_attempts="${1:-24}"
    local attempt=0
    local wait_seconds="${2:-10}"

    while (( attempt < max_attempts )); do
        if ! brew_is_busy; then
            cleanup_stale_brew_downloads
            return 0
        fi

        ((attempt++))
        echo "       Homebrew ocupado (otra instalacion en curso). Esperando ${wait_seconds}s... (${attempt}/${max_attempts})"
        sleep "$wait_seconds"
    done

    echo "[ERROR] Homebrew sigue ocupado."
    echo "        Cierre otras ventanas de Terminal con 'brew install' en ejecucion."
    echo "        O espere a que termine y vuelva a ejecutar Instalar.command."
    echo ""
    echo "        Si no hay otra instalacion activa, ejecute en Terminal:"
    echo "          rm -f \"\$(brew --cache)/downloads/\"*.incomplete"
    echo "          brew install php"
    return 1
}

is_brew_pkg_installed() {
    local pkg="$1"
    brew list --formula "$pkg" &>/dev/null 2>&1
}

is_php_ready() {
    if command -v php >/dev/null 2>&1; then
        php -r 'exit(version_compare(PHP_VERSION, "8.2.0", ">=") ? 0 : 1);' 2>/dev/null
    else
        return 1
    fi
}

is_node_ready() {
    command -v node >/dev/null 2>&1 && command -v npm >/dev/null 2>&1
}

is_mysql_ready() {
    if command -v mysql >/dev/null 2>&1; then
        return 0
    fi
    is_brew_pkg_installed mysql || is_brew_pkg_installed mysql@8.0 || is_brew_pkg_installed mysql@8.4
}

brew_install_with_retry() {
    local pkg="$1"
    local max_attempts=8
    local attempt=0
    local output=""

    while (( attempt < max_attempts )); do
        wait_for_brew_available 18 10 || return 1

        echo "       Instalando ${pkg} con Homebrew..."
        if output="$(brew install "$pkg" 2>&1)"; then
            echo "       OK - ${pkg} instalado."
            return 0
        fi

        ((attempt++))

        if echo "$output" | grep -qiE 'already locked|Please wait for it to finish|Operation in progress'; then
            echo "       Homebrew bloqueado, reintentando... (${attempt}/${max_attempts})"
            sleep 15
            continue
        fi

        echo "$output"
        echo "[ERROR] No se pudo instalar ${pkg}."
        return 1
    done

    echo "[ERROR] No se pudo instalar ${pkg} despues de varios intentos (Homebrew bloqueado)."
    return 1
}

ensure_php() {
    if is_php_ready; then
        echo "       OK - PHP $(php -r 'echo PHP_VERSION;') ya disponible."
        return 0
    fi

    for formula in php php@8.3 php@8.2; do
        if is_brew_pkg_installed "$formula"; then
            echo "       OK - ${formula} ya instalado con Homebrew."
            setup_brew_path
            if is_php_ready; then
                return 0
            fi
        fi
    done

    brew_install_with_retry php
}

ensure_mysql() {
    if is_mysql_ready; then
        echo "       OK - MySQL ya disponible."
        return 0
    fi

    for formula in mysql mysql@8.4 mysql@8.0; do
        if is_brew_pkg_installed "$formula"; then
            echo "       OK - ${formula} ya instalado con Homebrew."
            BREW_MYSQL_SERVICE="$formula"
            return 0
        fi
    done

    if brew_install_with_retry mysql; then
        BREW_MYSQL_SERVICE="mysql"
        return 0
    fi

    return 1
}

ensure_node() {
    if is_node_ready; then
        echo "       OK - Node.js $(node -v) ya disponible."
        return 0
    fi

    if is_brew_pkg_installed node; then
        echo "       OK - node ya instalado con Homebrew."
        setup_brew_path
        is_node_ready
        return $?
    fi

    brew_install_with_retry node
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
    if is_brew_pkg_installed "$pkg"; then
        echo "       OK - ${pkg} ya instalado."
        return 0
    fi
    brew_install_with_retry "$pkg"
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
    echo "         Si Homebrew ya esta instalando algo, este paso esperara automaticamente."
    echo "         No ejecute Instalar.command dos veces al mismo tiempo."
    echo ""

    install_homebrew_if_needed || return 1
    setup_brew_path
    wait_for_brew_available 6 5 || true

    local failed=0
    ensure_php || failed=1
    ensure_mysql || failed=1
    ensure_node || failed=1
    install_composer_if_needed || failed=1

    setup_brew_path

    if ! brew services list 2>/dev/null | grep -qE "^${BREW_MYSQL_SERVICE}[[:space:]]"; then
        if brew services list 2>/dev/null | grep -qE "^mysql@"; then
            BREW_MYSQL_SERVICE="$(brew services list 2>/dev/null | awk '/^mysql@/{print $1; exit}')"
        elif is_brew_pkg_installed mysql; then
            BREW_MYSQL_SERVICE="mysql"
        fi
    fi

    if (( failed == 1 )); then
        if is_php_ready && is_node_ready && command -v composer >/dev/null 2>&1; then
            echo ""
            echo "       [AVISO] Hubo problemas con Homebrew, pero PHP/Node/Composer estan listos."
            echo "       Se continuara con la instalacion..."
            return 0
        fi
        return 1
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
