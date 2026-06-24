@echo off
setlocal EnableDelayedExpansion

REM Ir a la raiz del proyecto (dos niveles arriba desde scripts/windows)
cd /d "%~dp0\..\.."
set "PROJECT_ROOT=%CD%"

call "%~dp0config.bat"

goto :eof

:check_command
where %1 >nul 2>&1
if errorlevel 1 (
    echo [ERROR] No se encontro '%1' en el PATH.
    echo        Instale %1 y agreguelo al PATH del sistema, luego vuelva a ejecutar.
    exit /b 1
)
exit /b 0

:check_prerequisites
echo.
echo [1/2] Verificando PHP, Composer, Node.js y npm...
call :check_command php || exit /b 1
call :check_command composer || exit /b 1
call :check_command node || exit /b 1
call :check_command npm || exit /b 1
echo       OK - Herramientas encontradas.
exit /b 0

:start_mysql
call "%~dp0config.bat"
echo.
echo Iniciando MySQL...

sc query "%MYSQL_SERVICE%" >nul 2>&1
if not errorlevel 1 (
    for /f "tokens=3" %%a in ('sc query "%MYSQL_SERVICE%" ^| find "STATE"') do set "SVC_STATE=%%a"
    if "!SVC_STATE!"=="RUNNING" (
        echo       MySQL ya esta en ejecucion ^(servicio %MYSQL_SERVICE%^).
        exit /b 0
    )
    echo       Iniciando servicio %MYSQL_SERVICE%...
    net start "%MYSQL_SERVICE%" >nul 2>&1
    if not errorlevel 1 (
        echo       OK - Servicio MySQL iniciado.
        exit /b 0
    )
    echo       [AVISO] No se pudo iniciar el servicio %MYSQL_SERVICE%.
)

if defined MYSQL_START_SCRIPT (
    if exist "%MYSQL_START_SCRIPT%" (
        echo       Ejecutando script de inicio: %MYSQL_START_SCRIPT%
        call "%MYSQL_START_SCRIPT%"
        timeout /t 3 /nobreak >nul
        exit /b 0
    )
)

REM Verificar si mysql responde (puede estar corriendo sin servicio)
set "MYSQL_CMD=mysql"
if defined MYSQL_BIN if exist "%MYSQL_BIN%" set "MYSQL_CMD=%MYSQL_BIN%"

if "%DB_PASS%"=="" (
    "%MYSQL_CMD%" -h%DB_HOST% -P%DB_PORT% -u%DB_USER% -e "SELECT 1;" >nul 2>&1
) else (
    "%MYSQL_CMD%" -h%DB_HOST% -P%DB_PORT% -u%DB_USER% -p%DB_PASS% -e "SELECT 1;" >nul 2>&1
)
if not errorlevel 1 (
    echo       OK - MySQL responde en %DB_HOST%:%DB_PORT%.
    exit /b 0
)

echo [ERROR] No se pudo iniciar ni conectar a MySQL.
echo        - Verifique que MySQL este instalado.
echo        - Ajuste MYSQL_SERVICE en scripts\windows\config.bat
echo        - O configure MYSQL_START_SCRIPT para XAMPP/Laragon.
exit /b 1

:create_database
call "%~dp0config.bat"
set "MYSQL_CMD=mysql"
if defined MYSQL_BIN if exist "%MYSQL_BIN%" set "MYSQL_CMD=%MYSQL_BIN%"

if "%DB_PASS%"=="" (
    "%MYSQL_CMD%" -h%DB_HOST% -P%DB_PORT% -u%DB_USER% -e "CREATE DATABASE IF NOT EXISTS `%DB_NAME%` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
) else (
    "%MYSQL_CMD%" -h%DB_HOST% -P%DB_PORT% -u%DB_USER% -p%DB_PASS% -e "CREATE DATABASE IF NOT EXISTS `%DB_NAME%` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
)

if errorlevel 1 (
    echo [ERROR] No se pudo crear la base de datos '%DB_NAME%'.
    echo        Revise usuario, contrasena y permisos en scripts\windows\config.bat y .env
    exit /b 1
)
echo       OK - Base de datos '%DB_NAME%' lista.
exit /b 0

:setup_env
if exist ".env" (
    echo       .env ya existe, se conserva la configuracion actual.
    exit /b 0
)

if exist ".env.windows.example" (
    copy /Y ".env.windows.example" ".env" >nul
    echo       OK - Archivo .env creado desde .env.windows.example
    exit /b 0
)

if exist ".env.example" (
    copy /Y ".env.example" ".env" >nul
    echo       OK - Archivo .env creado desde .env.example
    exit /b 0
)

echo [ERROR] No se encontro .env.windows.example ni .env.example
exit /b 1

:start_servers
call "%~dp0config.bat"
echo.
echo Abriendo servidores en ventanas separadas...
echo   - Laravel: http://127.0.0.1:%LARAVEL_PORT%
echo   - Vite:    compilacion de assets en caliente
echo.
echo Para detener: cierre las ventanas "Laravel Server" y "Vite Dev".
echo.

start "Laravel Server" cmd /k "cd /d %PROJECT_ROOT% && echo Servidor Laravel en http://127.0.0.1:%LARAVEL_PORT% && php artisan serve --host=127.0.0.1 --port=%LARAVEL_PORT%"
timeout /t 2 /nobreak >nul
start "Vite Dev" cmd /k "cd /d %PROJECT_ROOT% && echo Compilando assets con Vite... && npm run dev"

exit /b 0
