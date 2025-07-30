# CRM Template con Laravel + Filament

Este es un template personalizado de Laravel con Filament preconfigurado para sistemas CRM.

## Características incluidas

- Laravel 11.x
- Filament 3.x con Panel de Administración
- Filament Shield para gestión de roles y permisos
- TinyEditor para edición de texto enriquecido
- Configuración MySQL optimizada
- Migraciones para roles y permisos
- Redirección automática a /admin

## Instalación

### Opción 1: Usando Composer (Recomendado)

```bash
composer create-project tuusuario/laravel-filament-crm mi-proyecto
cd mi-proyecto
./post-install.sh  # Configurar MySQL y crear usuario admin
npm install && npm run build
```

### Opción 2: Clonar repositorio

```bash
git clone https://github.com/tuusuario/laravel-filament-crm.git mi-proyecto
cd mi-proyecto
composer install
./post-install.sh  # Configurar MySQL y crear usuario admin
npm install && npm run build
```

## Configuración adicional

1. Crear el primer usuario admin:
```bash
php artisan make:filament-user
```

2. Asignar permisos de super admin:
```bash
php artisan shield:super-admin
```

## Uso

```bash
php artisan serve
```

Visita http://localhost:8000 (se redirigirá automáticamente a /admin)

## Estructura del proyecto

- Panel de administración en `/admin`
- Gestión de usuarios y roles preconfigurada
- Sistema de permisos con Filament Shield
- Editor TinyMCE integrado

## Personalización

Este template incluye configuraciones base que puedes extender según tus necesidades:

- Modelos de negocio en `app/Models/`
- Recursos de Filament en `app/Filament/Resources/`
- Migraciones personalizadas en `database/migrations/`
