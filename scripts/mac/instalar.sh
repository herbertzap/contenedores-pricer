#!/usr/bin/env bash
set -euo pipefail

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
PROJECT_ROOT="$(cd "$SCRIPT_DIR/../.." && pwd)"

# shellcheck source=_helpers.sh
source "$SCRIPT_DIR/_helpers.sh"

echo "============================================================"
echo "  INSTALACION COMPLETA - Sistema Contenedores Pricer (macOS)"
echo "  Instala PHP, MySQL, Node/Vite, datos demo y abre el sistema"
echo "============================================================"

cd "$PROJECT_ROOT"
setup_brew_path

install_system_dependencies || exit 1

echo ""
echo "Configurando entorno en: ${PROJECT_ROOT}"
echo ""

echo "[Paso 1/7] Configurando archivo .env..."
setup_env || exit 1

echo ""
echo "[Paso 2/7] Instalando dependencias PHP (composer install)..."
echo "           Esto puede tardar varios minutos..."
composer install --no-interaction --prefer-dist

echo ""
echo "[Paso 3/7] Instalando dependencias Node.js / Vite (npm install)..."
npm install

echo ""
echo "[Paso 4/7] Generando clave de aplicacion..."
php artisan key:generate --force

echo ""
echo "[Paso 5/7] Iniciando MySQL..."
start_mysql || exit 1

echo ""
echo "[Paso 6/7] Creando base de datos..."
create_database || exit 1

seed_demo_data || exit 1

if [[ ! -e public/storage ]]; then
    php artisan storage:link
fi

echo ""
echo "[Paso 7/7] Levantando servidores y abriendo navegador..."
start_servers true

echo ""
echo "============================================================"
echo "  INSTALACION COMPLETADA"
echo "============================================================"
print_credentials
echo ""
echo "  URL: http://127.0.0.1:${LARAVEL_PORT}/sign-in"
echo ""
echo "  Para futuros inicios use: Iniciar.command (doble clic)"
echo "  Guia completa: docs/INSTALACION_MAC.md"
echo ""
