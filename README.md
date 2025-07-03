# Biblioteca Virtual

Bienvenido a **Biblioteca Virtual**, un sistema web para la gestión de bibliotecas, préstamos de libros, usuarios y reportes. Este proyecto está desarrollado con Laravel y utiliza tecnologías modernas para ofrecer una experiencia eficiente y segura.

---

## Índice

- [Descripción](#descripción)
- [Funcionalidades](#funcionalidades)
- [Requisitos](#requisitos)
- [Instalación](#instalación)
- [Configuración](#configuración)
- [Uso](#uso)
- [Estructura del Proyecto](#estructura-del-proyecto)
- [Créditos](#créditos)
- [Enlaces Útiles](#enlaces-útiles)

---

## Descripción

Biblioteca Virtual permite a los usuarios y bibliotecarios gestionar libros, categorías, usuarios y préstamos de manera sencilla. Incluye autenticación, roles y reportes automatizados.

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

---

## Requisitos

- PHP >= 8.0
- Composer
- Node.js y npm
-PLSQL o cualquier base de datos compatible con Laravel

---

## Instalación

1. **Clona el repositorio:**
   ```bash
   git clone https://github.com/yordypillaca/biblioteca_virtual.git
   cd biblioteca_virtual
   ```

2. **Instala las dependencias de PHP:**
   ```bash
   composer install
   ```

3. **Instala las dependencias de Node.js:**
   ```bash
   npm install
   ```

4. **Copia el archivo de entorno y configura tus variables:**
   ```bash
   cp .env.example .env
   ```

5. **Genera la clave de la aplicación:**
   ```bash
   php artisan key:generate
   ```

6. **Configura la base de datos en el archivo `.env`.**

7. **Ejecuta las migraciones y seeders:**
   ```bash
   php artisan migrate --seed
   ```

8. **Compila los assets:**
   ```bash
   npm run dev
   ```

9. **Inicia el servidor de desarrollo:**
   ```bash
   php artisan serve
   ```

---

## Configuración

- Edita el archivo `.env` para establecer la conexión a tu base de datos y otras variables de entorno.
- Puedes personalizar la configuración en la carpeta [`config/`](config/).

---

## Uso

1. Accede a la aplicación desde tu navegador en [http://localhost:8000](http://localhost:8000).
2. Regístrate o inicia sesión.
3. Explora las funcionalidades desde el panel principal:
   - Gestiona usuarios, libros y categorías
   - Realiza préstamos y devoluciones
   - Genera reportes desde la sección correspondiente

---

## Estructura del Proyecto

- `app/Http/Controllers/` — Controladores de la lógica de negocio (usuarios, libros, préstamos, reportes, autenticación)
- `app/Models/` — Modelos de Eloquent (User, Usuario, etc.)
- `resources/views/` — Vistas Blade (interfaz de usuario)
- `routes/web.php` — Definición de rutas web
- `database/migrations/` — Migraciones de base de datos
- `public/` — Archivos públicos (CSS, JS, imágenes)
- `config/` — Archivos de configuración

---

## Créditos

Desarrollado por [yordypillaca](https://github.com/yordypillaca/biblioteca_virtual.git).

---

## Enlaces Útiles

- [Documentación de Laravel](https://laravel.com/docs)
- [Tailwind CSS](https://tailwindcss.com/)
- [Composer](https://getcomposer.org/)
- [Node.js](https://nodejs.org/)