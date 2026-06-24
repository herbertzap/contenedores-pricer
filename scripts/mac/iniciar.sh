#!/usr/bin/env bash
set -euo pipefail

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
PROJECT_ROOT="$(cd "$SCRIPT_DIR/../.." && pwd)"

# shellcheck source=_helpers.sh
source "$SCRIPT_DIR/_helpers.sh"

echo "============================================================"
echo "  INICIAR PROYECTO - Sistema Contenedores Pricer (macOS)"
echo "  MySQL + Laravel + Vite + abrir navegador"
echo "============================================================"

cd "$PROJECT_ROOT"
setup_brew_path

if ! command -v php >/dev/null 2>&1; then
    echo "[ERROR] PHP no encontrado. Ejecute primero Instalar.command"
    exit 1
fi

if ! command -v npm >/dev/null 2>&1; then
    echo "[ERROR] npm no encontrado. Ejecute primero Instalar.command"
    exit 1
fi

if [[ ! -d vendor ]]; then
    echo "[ERROR] Carpeta vendor/ no existe. Ejecute primero Instalar.command"
    exit 1
fi

if [[ ! -d node_modules ]]; then
    echo "[ERROR] Carpeta node_modules/ no existe. Ejecute primero Instalar.command"
    exit 1
fi

if [[ ! -f .env ]]; then
    echo "[ERROR] Archivo .env no existe. Ejecute primero Instalar.command"
    exit 1
fi

echo ""
echo "[1/2] Iniciando MySQL..."
start_mysql || exit 1

echo ""
echo "[2/2] Levantando Laravel, Vite y abriendo navegador..."
start_servers true

echo ""
echo "============================================================"
echo "  PROYECTO EN EJECUCION"
echo "============================================================"
print_credentials
echo ""
echo "  URL: http://127.0.0.1:${LARAVEL_PORT}/sign-in"
echo "  Para detener: cierre las ventanas de Terminal de Laravel y Vite"
echo ""
