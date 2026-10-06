# Sistema de Administración de Restaurante (Laravel)

Este es un módulo completo de backend y frontend para la gestión de platos y visualización del menú de un restaurante, construido con **Laravel 10/11**, **Docker (Laravel Sail)** y **Bootstrap 5.3**.

## Características Principales

- **Panel de Administración (CRUD de Platos):**
  - Creación, edición y eliminación (Soft Deletes) de platos.
  - Subida y gestión de imágenes para cada platillo.
  - Almacenamiento organizado dinámicamente (storage/app/public/platos/YYYY/MM).
- **Validaciones Desacopladas (Form Requests):**
  - Todas las reglas y límites (min, max, mimes, etc.) están centralizados en un único archivo de configuración (config/restaurante.php).
  - Mensajes de error completamente amigables, dinámicos y en español.
- **Menú Público (Cliente):**
  - Cuadrícula responsiva (Grid) con todos los platillos disponibles, ordenados alfabéticamente.
  - Diseño UI/UX premium, sobrio y elegante (colores marfil, dorado y marrón oscuro).
  - Ficha detallada individual por cada platillo.

## Requisitos

- Docker Desktop / WSL2
- Laravel Sail

## Instalación

1. Clona el repositorio.
2. Copia el archivo de entorno: cp .env.example .env
3. Instala las dependencias de PHP usando un contenedor temporal (si no tienes PHP local):
   `ash
   docker run --rm \
       -u "$(id -u):$(id -g)" \
       -v "$(pwd):/var/www/html" \
       -w /var/www/html \
       laravelsail/php83-composer:latest \
       composer install --ignore-platform-reqs
   `
4. Levanta el entorno de Docker:
   `ash
   ./vendor/bin/sail up -d
   `
5. Genera la key de la aplicación y ejecuta migraciones:
   `ash
   ./vendor/bin/sail artisan key:generate
   ./vendor/bin/sail artisan migrate
   `
6. Vincula el almacenamiento público:
   `ash
   ./vendor/bin/sail artisan storage:link
   `

## Acceso

- **Panel de Administración:** http://localhost/platos
- **Menú Público:** http://localhost/menu

## Tecnologías Utilizadas
- Laravel (Backend, Eloquent, Routing)
- Blade (Motor de plantillas)
- Bootstrap 5.3 + Custom CSS (Frontend UI)
- MySQL (Base de datos vía Docker)
