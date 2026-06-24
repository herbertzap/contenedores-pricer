@echo off
REM =============================================================================
REM Configuracion compartida para scripts Windows
REM Edite estos valores segun su instalacion local de MySQL
REM =============================================================================

REM Nombre del servicio de Windows para MySQL (comun: MySQL80, MySQL, MariaDB)
set "MYSQL_SERVICE=MySQL80"

REM Credenciales de base de datos (deben coincidir con su .env)
set "DB_HOST=127.0.0.1"
set "DB_PORT=3306"
set "DB_NAME=contenedores_pricer"
set "DB_USER=root"
set "DB_PASS="

REM Puerto del servidor Laravel (php artisan serve)
set "LARAVEL_PORT=8000"

REM Ruta opcional a mysql.exe si no esta en el PATH
REM Ejemplos:
REM   XAMPP:  C:\xampp\mysql\bin\mysql.exe
REM   Laragon: C:\laragon\bin\mysql\mysql-8.0.30-winx64\bin\mysql.exe
set "MYSQL_BIN="

REM Ruta opcional a mysqld o script de inicio si MySQL no es servicio de Windows
REM Ejemplo XAMPP: C:\xampp\mysql_start.bat
set "MYSQL_START_SCRIPT="
