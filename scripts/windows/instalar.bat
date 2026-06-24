@echo off
chcp 65001 >nul
setlocal EnableDelayedExpansion
title Instalacion - Sistema Contenedores Pricer

echo ============================================================
echo   INSTALACION COMPLETA - Sistema Contenedores Pricer
echo   Primera vez: dependencias, MySQL, migraciones y servidores
echo ============================================================

cd /d "%~dp0\..\.."
set "PROJECT_ROOT=%CD%"
call "%~dp0config.bat"
call "%~dp0_helpers.bat" :check_prerequisites
if errorlevel 1 goto :error

echo.
echo [2/2] Configurando entorno en: %PROJECT_ROOT%
echo.

REM --- Archivo .env ---
echo [Paso 1/8] Configurando archivo .env...
call "%~dp0_helpers.bat" :setup_env
if errorlevel 1 goto :error

REM --- Composer ---
echo.
echo [Paso 2/8] Instalando dependencias PHP (composer install)...
echo            Esto puede tardar varios minutos...
composer install --no-interaction --prefer-dist
if errorlevel 1 goto :error
echo       OK - Dependencias PHP instaladas.

REM --- NPM ---
echo.
echo [Paso 3/8] Instalando dependencias Node.js (npm install)...
npm install
if errorlevel 1 goto :error
echo       OK - Dependencias Node.js instaladas.

REM --- APP_KEY ---
echo.
echo [Paso 4/8] Generando clave de aplicacion...
php artisan key:generate --force
if errorlevel 1 goto :error
echo       OK - APP_KEY generada.

REM --- MySQL ---
echo.
echo [Paso 5/8] Iniciando MySQL...
call "%~dp0_helpers.bat" :start_mysql
if errorlevel 1 goto :error

echo.
echo [Paso 6/8] Creando base de datos...
call "%~dp0_helpers.bat" :create_database
if errorlevel 1 goto :error

REM --- Migraciones ---
echo.
echo [Paso 7/8] Ejecutando migraciones y datos iniciales...
php artisan migrate --force
if errorlevel 1 goto :error

php artisan db:seed --force
if errorlevel 1 (
    echo       [AVISO] db:seed fallo. Puede continuar si la BD ya tenia datos.
)

if not exist "public\storage" (
    php artisan storage:link
)

echo       OK - Base de datos configurada.

REM --- Iniciar servidores ---
echo.
echo [Paso 8/8] Levantando servidores...
call "%~dp0_helpers.bat" :start_servers

echo.
echo ============================================================
echo   INSTALACION COMPLETADA
echo ============================================================
echo.
echo   Abra el navegador en: http://127.0.0.1:%LARAVEL_PORT%
echo.
echo   Usuario por defecto (seeder):
echo     Email:    admin@material.com
echo     Password: secret
echo.
echo   Para futuros inicios use: Iniciar.bat
echo   Guia completa: docs\INSTALACION_WINDOWS.md
echo   (tambien en scripts\windows\GUIA_INSTALACION.md)
echo.
pause
exit /b 0

:error
echo.
echo ============================================================
echo   LA INSTALACION NO PUDO COMPLETARSE
echo ============================================================
echo   Revise los mensajes anteriores y consulte:
echo   docs\INSTALACION_WINDOWS.md
echo.
pause
exit /b 1
