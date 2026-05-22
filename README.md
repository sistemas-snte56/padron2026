# Padron2026

Sistema de seguimiento de entrega de padrón de sedes, desarrollado con Laravel 13, Filament 5 y Livewire 4.

---

## Descripción

Padron2026 es una aplicación web que permite administrar y monitorear el estado de entrega del padrón de delegaciones por sede y región. Cuenta con un panel administrativo completo y un dashboard público con gráficas en tiempo real.

---

## Tecnologías

- **Laravel 13**
- **Filament 5**
- **Livewire 4**
- **Chart.js 4** (via CDN)
- **MySQL**
- **Google Fonts** — Montserrat + Roboto

---

## Características

### Panel Administrativo (`/admin`)
- Autenticación con usuario administrador
- Tabla de padrón con búsqueda por región, delegación, nivel y sede
- Filtro por región y por estado de padrón (entregado / pendiente)
- Columna de estado con iconos visuales (✓ / ✗)
- Botón de acción rápida para cambiar el estado de entrega con confirmación
- Formulario de creación y edición con toggle para marcar entrega
- Vista de solo lectura por registro

### Dashboard Público (`/`)
- Acceso sin autenticación
- 4 tarjetas KPI: Total de sedes, Entregados, Pendientes y % de Avance
- Gráfica de pastel (doughnut) con distribución general de entrega
- Gráfica de barras con entrega por región
- Selector de región para consultar delegaciones pendientes en tiempo real (Livewire)
- Actualización reactiva sin recargar la página

---

## Estructura del Proyecto

```
app/
├── Livewire/
│   └── DashboardPublico.php
├── Models/
│   └── Padron.php
└── Filament/Resources/
    └── Padrons/
        ├── PadronResource.php
        ├── Pages/
        │   ├── ListPadrons.php
        │   ├── CreatePadron.php
        │   ├── EditPadron.php
        │   └── ViewPadron.php
        ├── Schemas/
        │   ├── PadronForm.php
        │   └── PadronInfolist.php
        └── Tables/
            └── PadronsTable.php

database/
├── migrations/
│   └── create_padron_table.php
└── seeders/
    ├── DatabaseSeeder.php
    ├── PadronSeeder.php
    └── data/
        └── padron.csv

resources/views/
├── layouts/
│   └── app.blade.php
└── livewire/
    └── dashboard-publico.blade.php

routes/
└── web.php
```

---

## Instalación

### Requisitos
- PHP 8.2+
- Composer
- Node.js + NPM
- MySQL

### Pasos

```bash
# 1. Clonar el repositorio
git clone <repositorio>
cd padron2026

# 2. Instalar dependencias PHP
composer install --optimize-autoloader --no-dev

# 3. Instalar dependencias JS y compilar
npm install && npm run build

# 4. Configurar entorno
cp .env.example .env
php artisan key:generate

# 5. Configurar base de datos en .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=padron2026
DB_USERNAME=root
DB_PASSWORD=

# 6. Ejecutar migraciones y seeder
php artisan migrate
php artisan db:seed

# 7. Crear usuario administrador
php artisan make:filament-user

# 8. Enlace de storage y caché
php artisan storage:link
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 9. Levantar servidor
php artisan serve
```

---

## Despliegue en cPanel via Git + SSH

```bash
git clone <repositorio>
cd padron2026
composer install --optimize-autoloader --no-dev
npm install && npm run build
cp .env.example .env
php artisan key:generate
# Configurar .env con datos de BD de cPanel
php artisan migrate
php artisan storage:link
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

> Apunta el `document_root` de cPanel al directorio `public/` del proyecto.
> Configura `APP_ENV=production` y `APP_DEBUG=false` en el `.env` del servidor.

---

## URLs

| URL | Descripción |
|-----|-------------|
| `/` | Dashboard público con gráficas |
| `/admin` | Panel administrativo Filament |

---

## Base de Datos

El seeder lee automáticamente el archivo `database/seeders/data/padron.csv` (UTF-8) con la siguiente estructura:

```
region, delegacion, nivel, sede, padron
```

El campo `padron` acepta `1` (entregado) o `0` (pendiente).

---

## Modelo

| Campo | Tipo | Descripción |
|-------|------|-------------|
| `id` | bigint | Clave primaria autoincremental |
| `region` | string | Nombre de la región |
| `delegacion` | string | Clave de la delegación |
| `nivel` | string | Nivel educativo |
| `sede` | string | Ciudad o lugar de la sede |
| `padron` | boolean | Estado de entrega (true/false) |
