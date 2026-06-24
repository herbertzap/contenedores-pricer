#!/usr/bin/env bash

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
PROJECT_ROOT="$(cd "$SCRIPT_DIR/../.." && pwd)"

# shellcheck source=config.sh
source "$SCRIPT_DIR/config.sh"

check_command() {
    if ! command -v "$1" >/dev/null 2>&1; then
        echo "[ERROR] No se encontro '$1' en el PATH."
        echo "        Instale $1 y agreguelo al PATH, luego vuelva a ejecutar."
        return 1
    fi
    return 0
}

check_prerequisites() {
    echo ""
    echo "[1/2] Verificando PHP, Composer, Node.js y npm..."
    check_command php || return 1
    check_command composer || return 1
    check_command node || return 1
    check_command npm || return 1
    echo "       OK - Herramientas encontradas."
    return 0
}

mysql_cmd() {
    if [[ -n "$MYSQL_BIN" && -x "$MYSQL_BIN" ]]; then
        echo "$MYSQL_BIN"
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

    echo ""
    echo "Iniciando MySQL..."

    if mysql_exec -e "SELECT 1;" >/dev/null 2>&1; then
        echo "       OK - MySQL ya responde en ${DB_HOST}:${DB_PORT}."
        return 0
    fi

    if command -v brew >/dev/null 2>&1 && [[ -n "$BREW_MYSQL_SERVICE" ]]; then
        echo "       Iniciando servicio Homebrew: ${BREW_MYSQL_SERVICE}..."
        if brew services start "$BREW_MYSQL_SERVICE" >/dev/null 2>&1; then
            sleep 3
            if mysql_exec -e "SELECT 1;" >/dev/null 2>&1; then
                echo "       OK - MySQL iniciado con brew services."
                return 0
            fi
        fi
        echo "       [AVISO] brew services no pudo iniciar ${BREW_MYSQL_SERVICE}."
    fi

    if [[ -n "$MYSQL_START_CMD" ]]; then
        echo "       Ejecutando: ${MYSQL_START_CMD}"
        eval "$MYSQL_START_CMD"
        sleep 3
        if mysql_exec -e "SELECT 1;" >/dev/null 2>&1; then
            echo "       OK - MySQL responde tras comando personalizado."
            return 0
        fi
    fi

    if command -v mysql.server >/dev/null 2>&1; then
        echo "       Intentando mysql.server start..."
        mysql.server start >/dev/null 2>&1 || true
        sleep 2
        if mysql_exec -e "SELECT 1;" >/dev/null 2>&1; then
            echo "       OK - MySQL iniciado con mysql.server."
            return 0
        fi
    fi

    echo "[ERROR] No se pudo iniciar ni conectar a MySQL."
    echo "        - Instale MySQL: brew install mysql"
    echo "        - O inicie MAMP / DBngin manualmente"
    echo "        - Ajuste scripts/mac/config.sh"
    return 1
}

create_database() {
    # shellcheck source=config.sh
    source "$SCRIPT_DIR/config.sh"

    if ! mysql_exec -e "CREATE DATABASE IF NOT EXISTS \`${DB_NAME}\` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"; then
        echo "[ERROR] No se pudo crear la base de datos '${DB_NAME}'."
        echo "        Revise usuario, contrasena y permisos en scripts/mac/config.sh y .env"
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

start_servers() {
    # shellcheck source=config.sh
    source "$SCRIPT_DIR/config.sh"

    echo ""
    echo "Abriendo servidores en ventanas de Terminal..."
    echo "  - Laravel: http://127.0.0.1:${LARAVEL_PORT}"
    echo "  - Vite:    compilacion de assets en caliente"
    echo ""
    echo "Para detener: cierre las pestanas 'Laravel Server' y 'Vite Dev' en Terminal."
    echo ""

    local escaped_root
    escaped_root="$(printf '%s' "$PROJECT_ROOT" | sed "s/'/'\\\\''/g")"

    osascript <<EOF
tell application "Terminal"
    activate
    do script "cd '${escaped_root}' && echo 'Servidor Laravel en http://127.0.0.1:${LARAVEL_PORT}' && php artisan serve --host=127.0.0.1 --port=${LARAVEL_PORT}"
    delay 1
    do script "cd '${escaped_root}' && echo 'Compilando assets con Vite...' && npm run dev"
end tell
EOF
}
