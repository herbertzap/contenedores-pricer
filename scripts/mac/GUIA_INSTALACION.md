# Guía de instalación en macOS

Esta guía explica cómo instalar y levantar el **Sistema de Administración de Contenedores** en Mac, desde cero hasta tener el servidor Laravel y Vite funcionando.

---

## Resumen rápido (usuario básico)

Si ya tiene PHP, Composer, Node.js y MySQL instalados:

| Acción | Qué hacer |
|--------|-----------|
| **Primera vez** | Doble clic en `Instalar.command` en la raíz del proyecto |
| **Siguientes veces** | Doble clic en `Iniciar.command` |
| **Abrir la app** | Navegador en `http://127.0.0.1:8000` |

> **Nota:** Si macOS bloquea la ejecución, clic derecho → **Abrir** → confirmar. O desde Terminal: `chmod +x Instalar.command Iniciar.command`

**Credenciales por defecto** (creadas por el seeder):

- Email: `admin@material.com`
- Contraseña: `secret`

---

## Requisitos previos

Instale estas herramientas antes de ejecutar los scripts.

| Herramienta | Versión mínima | Instalación recomendada |
|-------------|----------------|-------------------------|
| **PHP** | 8.2 | `brew install php` |
| **Composer** | 2.x | [getcomposer.org](https://getcomposer.org/download/) |
| **Node.js** (incluye npm) | 18 LTS+ | `brew install node` |
| **MySQL** | 8.0 | `brew install mysql` |

### Extensiones PHP requeridas

Con Homebrew suelen venir incluidas. Verifique con:

```bash
php -v
php -m | grep -E 'curl|fileinfo|gd|mbstring|pdo_mysql|zip|bcmath'
composer -V
node -v
npm -v
mysql --version
```

---

## Opción A: Instalación automática (recomendada)

### 1. Clonar el repositorio

```bash
git clone git@github-contenedores-pricer:herbertzap/contenedores-pricer.git
cd contenedores-pricer
git checkout feature/leo-new-desing
```

### 2. Dar permisos de ejecución (solo la primera vez)

```bash
chmod +x Instalar.command Iniciar.command scripts/mac/*.sh
```

### 3. Primera instalación

Doble clic en **`Instalar.command`** o desde Terminal:

```bash
./Instalar.command
```

El script realiza automáticamente:

1. Verifica PHP, Composer, Node.js y npm
2. Crea `.env` desde `.env.mac.example`
3. `composer install`
4. `npm install`
5. `php artisan key:generate`
6. Inicia MySQL (Homebrew / mysql.server)
7. Crea la base de datos `contenedores_pricer`
8. `php artisan migrate` y `php artisan db:seed`
9. `php artisan storage:link`
10. Abre Laravel y Vite en ventanas de Terminal

### 4. Inicios posteriores

Doble clic en **`Iniciar.command`** o:

```bash
./Iniciar.command
```

Solo inicia MySQL, Laravel y Vite **sin reinstalar** dependencias.

---

## Opción B: Instalación manual paso a paso

### Paso 1 — Instalar herramientas con Homebrew

```bash
# Instalar Homebrew si no lo tiene: https://brew.sh
brew install php composer node mysql
brew services start mysql
```

### Paso 2 — Crear la base de datos

```bash
mysql -u root -e "CREATE DATABASE IF NOT EXISTS contenedores_pricer CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
```

Si MySQL tiene contraseña:

```bash
mysql -u root -p -e "CREATE DATABASE IF NOT EXISTS contenedores_pricer CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
```

### Paso 3 — Configurar el entorno

```bash
cp .env.mac.example .env
```

Edite `.env` y ajuste la base de datos:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=contenedores_pricer
DB_USERNAME=root
DB_PASSWORD=

APP_URL=http://127.0.0.1:8000
```

### Paso 4 — Dependencias PHP y Node

```bash
composer install
npm install
```

### Paso 5 — Clave de aplicación y base de datos

```bash
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan storage:link
```

### Paso 6 — Levantar los servidores

Abra **dos terminales** en la raíz del proyecto:

**Terminal 1 — Laravel:**

```bash
php artisan serve --host=127.0.0.1 --port=8000
```

**Terminal 2 — Vite:**

```bash
npm run dev
```

### Paso 7 — Verificar

Abra en el navegador: **http://127.0.0.1:8000**

---

## Configuración de los scripts automáticos

Edite `scripts/mac/config.sh` si su entorno difiere:

```bash
# Servicio Homebrew (verifique con: brew services list)
BREW_MYSQL_SERVICE="mysql"

# Credenciales (deben coincidir con .env)
DB_HOST="127.0.0.1"
DB_PORT="3306"
DB_NAME="contenedores_pricer"
DB_USER="root"
DB_PASS=""

LARAVEL_PORT="8000"

# Rutas opcionales
MYSQL_BIN=""
MYSQL_START_CMD=""
```

### Usar MAMP en lugar de Homebrew

```bash
BREW_MYSQL_SERVICE=""
MYSQL_BIN="/Applications/MAMP/Library/bin/mysql"
MYSQL_START_CMD="open -a MAMP"
```

---

## Estructura de archivos macOS

```
contenedores-pricer/
├── Instalar.command          ← Primera instalación (doble clic)
├── Iniciar.command           ← Inicio rápido (doble clic)
├── .env.mac.example          ← Plantilla de entorno para Mac
├── scripts/mac/
│   ├── config.sh             ← Configuración MySQL y puertos
│   ├── instalar.sh           ← Lógica de instalación
│   ├── iniciar.sh            ← Lógica de inicio
│   └── _helpers.sh           ← Funciones compartidas
└── docs/
    └── INSTALACION_MAC.md
```

> Los scripts de **Windows** siguen disponibles en `scripts/windows/` por si se necesitan en el futuro.

---

## Comandos útiles de mantenimiento

```bash
# Limpiar caché
php artisan cache:clear
php artisan config:clear
php artisan view:clear

# Reejecutar migraciones (¡borra datos!)
php artisan migrate:fresh --seed

# Compilar assets para producción
npm run build

# Ver estado del proyecto
php artisan about

# MySQL con Homebrew
brew services stop mysql
brew services start mysql
```

---

## Solución de problemas

### macOS no permite abrir Instalar.command

```bash
xattr -d com.apple.quarantine Instalar.command Iniciar.command 2>/dev/null
chmod +x Instalar.command Iniciar.command scripts/mac/*.sh
```

O: clic derecho → **Abrir** → **Abrir** de nuevo.

### "command not found: php" o "composer"

Agregue Homebrew al PATH en `~/.zprofile`:

```bash
echo 'eval "$(/opt/homebrew/bin/brew shellenv)"' >> ~/.zprofile
source ~/.zprofile
```

En Mac Intel use `/usr/local/bin/brew` en lugar de `/opt/homebrew`.

### No se pudo iniciar MySQL

```bash
brew services list
brew services start mysql
# o para mysql@8.0:
brew services start mysql@8.0
```

Verifique conexión:

```bash
mysql -u root -e "SELECT 1;"
```

### Error de conexión a base de datos

1. Revise que `DB_*` en `.env` coincida con `scripts/mac/config.sh`
2. Confirme que la base `contenedores_pricer` exista
3. Pruebe: `mysql -u root -e "SHOW DATABASES;"`

### "vendor/ no existe" al usar Iniciar.command

Ejecute primero `Instalar.command` o `composer install`.

### Vite no carga estilos

Asegúrese de que la ventana de Terminal con `npm run dev` esté abierta y en ejecución.

### Puerto 8000 ocupado

Cambie `LARAVEL_PORT` en `config.sh` y `APP_URL` en `.env`, por ejemplo puerto `8080`:

```bash
php artisan serve --host=127.0.0.1 --port=8080
```

---

## Flujo de trabajo diario

1. Ejecutar `Iniciar.command`
2. Esperar que abran las ventanas de Terminal (Laravel y Vite)
3. Abrir `http://127.0.0.1:8000`
4. Al terminar, cerrar las dos ventanas de Terminal

---

## Notas de seguridad

- Los valores de `.env.mac.example` son para **desarrollo local**
- No use la contraseña `secret` ni `APP_DEBUG=true` en producción
- No suba su archivo `.env` al repositorio

---

## Soporte

Revise los logs en:

```
storage/logs/laravel.log
```
