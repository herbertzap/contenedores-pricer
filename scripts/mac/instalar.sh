#!/usr/bin/env bash
set -euo pipefail

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
PROJECT_ROOT="$(cd "$SCRIPT_DIR/../.." && pwd)"

# shellcheck source=_helpers.sh
source "$SCRIPT_DIR/_helpers.sh"

echo "============================================================"
echo "  INSTALACION COMPLETA - Sistema Contenedores Pricer (macOS)"
echo "  Primera vez: dependencias, MySQL, migraciones y servidores"
echo "============================================================"

cd "$PROJECT_ROOT"

check_prerequisites || exit 1

echo ""
echo "[2/2] Configurando entorno en: ${PROJECT_ROOT}"
echo ""

echo "[Paso 1/8] Configurando archivo .env..."
setup_env || exit 1

echo ""
echo "[Paso 2/8] Instalando dependencias PHP (composer install)..."
echo "           Esto puede tardar varios minutos..."
composer install --no-interaction --prefer-dist

echo ""
echo "[Paso 3/8] Instalando dependencias Node.js (npm install)..."
npm install

echo ""
echo "[Paso 4/8] Generando clave de aplicacion..."
php artisan key:generate --force

echo ""
echo "[Paso 5/8] Iniciando MySQL..."
start_mysql || exit 1

echo ""
echo "[Paso 6/8] Creando base de datos..."
create_database || exit 1

echo ""
echo "[Paso 7/8] Ejecutando migraciones y datos iniciales..."
php artisan migrate --force

if ! php artisan db:seed --force; then
    echo "       [AVISO] db:seed fallo. Puede continuar si la BD ya tenia datos."
fi

if [[ ! -e public/storage ]]; then
    php artisan storage:link
fi

echo "       OK - Base de datos configurada."

echo ""
echo "[Paso 8/8] Levantando servidores..."
start_servers

echo ""
echo "============================================================"
echo "  INSTALACION COMPLETADA"
echo "============================================================"
echo ""
echo "  Abra el navegador en: http://127.0.0.1:${LARAVEL_PORT}"
echo ""
echo "  Usuario por defecto (seeder):"
echo "    Email:    admin@material.com"
echo "    Password: secret"
echo ""
echo "  Para futuros inicios use: Iniciar.command (doble clic)"
echo "  Guia completa: docs/INSTALACION_MAC.md"
echo ""
