#!/bin/bash

# Script de instalación para Laravel Filament CRM
# Uso: ./install.sh nombre-del-proyecto

PROJECT_NAME=${1:-"mi-crm"}
CURRENT_DIR=$(pwd)

echo "🚀 Instalando Laravel Filament CRM: $PROJECT_NAME"
echo "==========================================="

# Crear directorio del proyecto
mkdir -p "$PROJECT_NAME"
cd "$PROJECT_NAME"

# Clonar o copiar archivos del template
echo "📦 Copiando archivos del template..."
cp -r "$CURRENT_DIR"/* . 2>/dev/null || true
cp -r "$CURRENT_DIR"/.[^.]* . 2>/dev/null || true

# Remover archivos específicos del template
rm -f install.sh TEMPLATE_README.md

# Instalar dependencias de PHP
echo "📋 Instalando dependencias de PHP..."
composer install --no-dev --optimize-autoloader

# Configurar archivo de entorno
echo "⚙️ Configurando entorno..."
if [ ! -f .env ]; then
    cp .env.example .env
fi

# Generar clave de aplicación
echo "🔑 Generando clave de aplicación..."
php artisan key:generate

# Crear base de datos MySQL placeholder en .env
echo "🗄️ Configurando base de datos MySQL..."
if [ ! -f .env ]; then
    echo "DB_CONNECTION=mysql" >> .env
    echo "DB_HOST=localhost" >> .env
    echo "DB_PORT=3306" >> .env
    echo "DB_DATABASE=laravel" >> .env
    echo "DB_USERNAME=admin" >> .env
    echo "DB_PASSWORD=admin" >> .env
    echo "ℹ️ Configuración MySQL por defecto agregada (user: admin, pass: admin). Ejecuta './post-install.sh' para personalizar."
fi

# Ejecutar migraciones
echo "🏗️ Ejecutando migraciones..."
php artisan migrate --force

# Instalar Filament Shield
echo "🛡️ Configurando Filament Shield..."
php artisan shield:install --fresh

# Instalar dependencias de Node.js
echo "📦 Instalando dependencias de Node.js..."
npm install

# Compilar assets
echo "🎨 Compilando assets..."
npm run build

# Configurar permisos
echo "🔐 Configurando permisos..."
chmod -R 755 storage bootstrap/cache
chmod -R 777 storage/logs

echo ""
echo "✅ ¡Instalación completada!"
echo ""
echo "🎯 Próximos pasos:"
echo "1. cd $PROJECT_NAME"
echo "2. php artisan make:filament-user  # Crear usuario admin"
echo "3. php artisan shield:super-admin  # Asignar permisos de super admin"
echo "4. php artisan serve               # Iniciar servidor"
echo ""
echo "🌐 Tu aplicación estará disponible en: http://localhost:8000"
echo "🔧 Panel de administración: http://localhost:8000/admin"
