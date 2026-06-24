#!/usr/bin/env bash
# Configuracion compartida para scripts macOS
# Edite estos valores segun su instalacion local de MySQL

# Servicio Homebrew (comun: mysql, mysql@8.0, mariadb)
# Verifique con: brew services list
BREW_MYSQL_SERVICE="mysql"

# Credenciales de base de datos (deben coincidir con su .env)
DB_HOST="127.0.0.1"
DB_PORT="3306"
DB_NAME="contenedores_pricer"
DB_USER="root"
DB_PASS=""

# Puerto del servidor Laravel (php artisan serve)
LARAVEL_PORT="8000"

# Ruta opcional a mysql si no esta en el PATH
# Ejemplos:
#   Homebrew Intel:  /usr/local/bin/mysql
#   Homebrew Apple Silicon: /opt/homebrew/bin/mysql
#   MAMP: /Applications/MAMP/Library/bin/mysql
MYSQL_BIN=""

# Comando alternativo para iniciar MySQL (si no usa brew services)
# Ejemplo MAMP: open -a MAMP
MYSQL_START_CMD=""
