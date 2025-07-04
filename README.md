# Biblioteca Virtual

Bienvenido a **Biblioteca Virtual**, un sistema web para la gestión de bibliotecas, préstamos de libros, usuarios y reportes. Este proyecto está desarrollado con Laravel 11 y utiliza tecnologías modernas para ofrecer una experiencia eficiente y segura.

---

## Índice

- [Descripción](#descripción)
- [Funcionalidades](#funcionalidades)
- [Requisitos](#requisitos)
- [Instalación](#instalación)
- [Configuración](#configuración)
- [Uso](#uso)
- [Estructura del Proyecto](#estructura-del-proyecto)
- [Dependencias](#dependencias)
- [Créditos](#créditos)
- [Enlaces Útiles](#enlaces-útiles)

---

## Descripción

Biblioteca Virtual permite a los usuarios y bibliotecarios gestionar libros, categorías, usuarios y préstamos de manera sencilla. Incluye autenticación, roles y reportes automatizados. El sistema está optimizado para trabajar con Oracle Database.

---

## Funcionalidades

- Registro e inicio de sesión de usuarios
- Gestión de usuarios (alta, baja, modificación)
- Gestión de libros (agregar, editar, eliminar)
- Gestión de categorías de libros
- Préstamo y devolución de libros
- Generación de reportes de préstamos
- Roles de usuario: bibliotecario y usuario
- Panel de administración
- Integración con Oracle Database
- Interfaz responsiva con Bootstrap y Tailwind CSS

---

## Requisitos

### Software Requerido
- **PHP >= 8.2** con las siguientes extensiones:
  - BCMath PHP Extension
  - Ctype PHP Extension
  - cURL PHP Extension
  - DOM PHP Extension
  - Fileinfo PHP Extension
  - JSON PHP Extension
  - Mbstring PHP Extension
  - OpenSSL PHP Extension
  - PCRE PHP Extension
  - PDO PHP Extension
  - Tokenizer PHP Extension
  - XML PHP Extension
  - **OCI8 PHP Extension** (para Oracle Database)

- **Composer** (gestor de dependencias de PHP)
- **Node.js >= 18.0** y npm
- **Oracle Database** (XE, Standard, o Enterprise)
- **Oracle Instant Client** (para conexión con Oracle)

### Extensiones PHP Adicionales
```bash
# Para Ubuntu/Debian
sudo apt-get install php8.2-oci8

# Para CentOS/RHEL
sudo yum install php-oci8

# Para Windows (XAMPP/WAMP)
# Descargar e instalar Oracle Instant Client
# Habilitar oci8 en php.ini
```

---

## Instalación

### 1. Clonar el Repositorio
```bash
git clone https://github.com/yordypillaca/biblioteca_virtual.git
cd biblioteca_virtual
```

### 2. Instalar Dependencias de PHP
```bash
composer install
```

### 3. Instalar Dependencias de Node.js
```bash
npm install
```

### 4. Configurar Variables de Entorno
```bash
cp .env.example .env
```

Edita el archivo `.env` con tu configuración:
```env
APP_NAME="Biblioteca Virtual"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=oracle
DB_HOST=localhost
DB_PORT=1521
DB_DATABASE=XE
DB_USERNAME=system
DB_PASSWORD=Tecsup2025
DB_CHARSET=AL32UTF8
```

### 5. Generar Clave de Aplicación
```bash
php artisan key:generate
```

### 6. Configurar Base de Datos Oracle

#### Instalar Oracle Instant Client
```bash
# Ubuntu/Debian
wget https://download.oracle.com/otn_software/linux/instantclient/instantclient-basic-linux.x64-21.1.0.0.0.zip
unzip instantclient-basic-linux.x64-21.1.0.0.0.zip
sudo mv instantclient_21_1 /opt/oracle/instantclient
echo 'export LD_LIBRARY_PATH="/opt/oracle/instantclient:$LD_LIBRARY_PATH"' >> ~/.bashrc
source ~/.bashrc

# Windows
# Descargar Oracle Instant Client desde oracle.com
# Agregar la ruta al PATH del sistema
```

#### Crear Base de Datos y Usuario
```sql
-- Conectar como SYSDBA
CREATE USER biblioteca IDENTIFIED BY password;
GRANT CONNECT, RESOURCE, DBA TO biblioteca;
GRANT CREATE SESSION TO biblioteca;
GRANT UNLIMITED TABLESPACE TO biblioteca;
```

### 7. Ejecutar Migraciones y Seeders
```bash
php artisan migrate --seed
```

### 8. Compilar Assets
```bash
npm run dev
# Para producción
npm run build
```

### 9. Configurar Permisos
```bash
chmod -R 775 storage bootstrap/cache
```

### 10. Iniciar Servidor de Desarrollo
```bash
php artisan serve
```

---

## Configuración

### Configuración de Oracle
El proyecto utiliza `yajra/laravel-oci8` para la conexión con Oracle Database. La configuración se encuentra en `config/database.php`:

```php
'oracle' => [
    'driver' => 'oracle',
    'tns' => env('DB_TNS', ''),
    'host' => env('DB_HOST', 'localhost'),
    'port' => env('DB_PORT', '1521'),
    'database' => env('DB_DATABASE', 'XE'),
    'username' => env('DB_USERNAME', 'system'),
    'password' => env('DB_PASSWORD', 'Tecsup2025'),
    'charset' => 'AL32UTF8',
    'prefix' => '',
],
```

### Configuración de Cache y Sesiones
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Configuración de Colas (Opcional)
```bash
php artisan queue:table
php artisan migrate
php artisan queue:work
```

---

## Uso

1. **Acceder a la aplicación:**
   - URL: [http://localhost:8000](http://localhost:8000)

2. **Registro e inicio de sesión:**
   - Registra un nuevo usuario o inicia sesión
   - Los usuarios con rol "bibliotecario" tienen acceso completo

3. **Funcionalidades principales:**
   - **Gestión de Libros:** Agregar, editar, eliminar libros
   - **Gestión de Categorías:** Organizar libros por categorías
   - **Gestión de Usuarios:** Administrar usuarios del sistema
   - **Préstamos:** Registrar préstamos y devoluciones
   - **Reportes:** Generar reportes de actividad

---

## Estructura del Proyecto

```
biblioteca_virtual/
├── app/
│   ├── Http/Controllers/     # Controladores (Auth, Libro, Prestamo, etc.)
│   ├── Models/              # Modelos Eloquent (User, Usuario)
│   └── Providers/           # Proveedores de servicios
├── config/                  # Archivos de configuración
├── database/
│   ├── migrations/          # Migraciones de base de datos
│   └── seeders/            # Seeders para datos iniciales
├── resources/
│   ├── views/              # Vistas Blade
│   ├── css/               # Estilos CSS
│   └── js/                # JavaScript
├── routes/                 # Definición de rutas
├── storage/               # Archivos de almacenamiento
└── public/               # Archivos públicos
```

---

## Dependencias

### Dependencias de PHP (composer.json)
```json
{
    "require": {
        "php": "^8.2",
        "laravel/framework": "^11.31",
        "laravel/tinker": "^2.9",
        "yajra/laravel-oci8": "^11.0"
    },
    "require-dev": {
        "fakerphp/faker": "^1.23",
        "laravel/pail": "^1.1",
        "laravel/pint": "^1.13",
        "laravel/sail": "^1.26",
        "mockery/mockery": "^1.6",
        "nunomaduro/collision": "^8.1",
        "phpunit/phpunit": "^11.0.1"
    }
}
```

### Dependencias de Node.js (package.json)
```json
{
    "devDependencies": {
        "autoprefixer": "^10.4.20",
        "axios": "^1.7.4",
        "concurrently": "^9.0.1",
        "laravel-vite-plugin": "^1.2.0",
        "postcss": "^8.4.47",
        "tailwindcss": "^3.4.13",
        "vite": "^6.0.11"
    }
}
```

### Extensiones PHP Requeridas
- **oci8** - Para conexión con Oracle Database
- **pdo** - Para acceso a base de datos
- **mbstring** - Para manipulación de strings
- **xml** - Para procesamiento XML
- **curl** - Para peticiones HTTP
- **json** - Para manejo de JSON
- **openssl** - Para encriptación

### Configuración de Oracle
- **Oracle Instant Client** - Cliente de conexión
- **Oracle Database** - Base de datos principal
- **yajra/laravel-oci8** - Driver de Laravel para Oracle

---

## Solución de Problemas

### Error de Conexión Oracle
```bash
# Verificar instalación de OCI8
php -m | grep oci8

# Verificar variables de entorno Oracle
echo $ORACLE_HOME
echo $LD_LIBRARY_PATH
```

### Error de Permisos
```bash
# Dar permisos a directorios
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

### Error de Dependencias
```bash
# Limpiar cache de Composer
composer clear-cache
composer install --no-cache

# Limpiar cache de Laravel
php artisan config:clear
php artisan cache:clear
```

---

## Créditos

Desarrollado por [yordypillaca](https://github.com/yordypillaca/biblioteca_virtual.git).

---

## Enlaces Útiles

- [Documentación de Laravel](https://laravel.com/docs)
- [Yajra Laravel OCI8](https://github.com/yajra/laravel-oci8)
- [Oracle Database Documentation](https://docs.oracle.com/en/database/)
- [Tailwind CSS](https://tailwindcss.com/)
- [Bootstrap](https://getbootstrap.com/)
- [Composer](https://getcomposer.org/)
- [Node.js](https://nodejs.org/)
- [Vite](https://vitejs.dev/)