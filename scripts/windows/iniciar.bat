@echo off
chcp 65001 >nul
setlocal EnableDelayedExpansion
title Iniciar - Sistema Contenedores Pricer

echo ============================================================
echo   INICIAR PROYECTO - Sistema Contenedores Pricer
echo   MySQL + Laravel + Vite (sin reinstalar dependencias)
echo ============================================================

cd /d "%~dp0\..\.."
set "PROJECT_ROOT=%CD%"
call "%~dp0config.bat"

REM Verificaciones minimas
where php >nul 2>&1 || (
    echo [ERROR] PHP no encontrado. Ejecute primero Instalar.bat
    pause & exit /b 1
)
where npm >nul 2>&1 || (
    echo [ERROR] npm no encontrado. Ejecute primero Instalar.bat
    pause & exit /b 1
)
if not exist "vendor\" (
    echo [ERROR] Carpeta vendor\ no existe. Ejecute primero Instalar.bat
    pause & exit /b 1
)
if not exist "node_modules\" (
    echo [ERROR] Carpeta node_modules\ no existe. Ejecute primero Instalar.bat
    pause & exit /b 1
)
if not exist ".env" (
    echo [ERROR] Archivo .env no existe. Ejecute primero Instalar.bat
    pause & exit /b 1
)

echo.
echo [1/2] Iniciando MySQL...
call "%~dp0_helpers.bat" :start_mysql
if errorlevel 1 goto :error

echo.
echo [2/2] Levantando Laravel y Vite...
call "%~dp0_helpers.bat" :start_servers

echo.
echo ============================================================
echo   PROYECTO EN EJECUCION
echo ============================================================
echo   URL: http://127.0.0.1:%LARAVEL_PORT%
echo   Para detener: cierre las ventanas "Laravel Server" y "Vite Dev"
echo.
pause
exit /b 0

:error
echo.
echo [ERROR] No se pudo iniciar el proyecto.
echo         Consulte docs\INSTALACION_WINDOWS.md
pause
exit /b 1
