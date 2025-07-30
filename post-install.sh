#!/bin/bash

# Script de configuración post-instalación
# Este script se ejecuta después de instalar el template

echo "🎯 Configuración post-instalación de Laravel Filament CRM"
echo "======================================================="

# Verificar que estamos en un proyecto Laravel
if [ ! -f "artisan" ]; then
    echo "❌ Error: No se detectó un proyecto Laravel en este directorio"
    exit 1
fi

echo ""
echo "📋 Configurando base de datos MySQL..."

read -p "Host de MySQL [localhost]: " mysql_host
mysql_host=${mysql_host:-localhost}
read -p "Puerto de MySQL [3306]: " mysql_port
mysql_port=${mysql_port:-3306}
read -p "Nombre de la base de datos: " mysql_db
read -p "Usuario de MySQL [admin]: " mysql_user
mysql_user=${mysql_user:-admin}
read -p "Contraseña de MySQL [admin]: " mysql_pass
mysql_pass=${mysql_pass:-admin}
echo ""

{
    echo "DB_CONNECTION=mysql"
    echo "DB_HOST=$mysql_host"
    echo "DB_PORT=$mysql_port"
    echo "DB_DATABASE=$mysql_db"
    echo "DB_USERNAME=$mysql_user"
    echo "DB_PASSWORD=$mysql_pass"
} >> .env
echo "✅ Base de datos MySQL configurada"

echo ""
echo "🏗️ Ejecutando migraciones..."
php artisan migrate --force

echo ""
echo "🛡️ Configurando Filament Shield..."
php artisan shield:install --fresh

echo ""
echo "👤 ¿Deseas crear un usuario administrador ahora?"
read -p "s/N: " create_admin

if [[ $create_admin =~ ^[Ss]$ ]]; then
    echo "Creando usuario administrador..."
    php artisan make:filament-user
    echo "Asignando permisos de super admin..."
    php artisan shield:super-admin
fi

echo ""
echo "🎨 Compilando assets..."
npm run build

echo ""
echo "✅ ¡Configuración completada!"
echo ""
echo "🎯 Tu aplicación CRM está lista. Comandos útiles:"
echo ""
echo "🔥 Iniciar servidor:           php artisan serve"
echo "🔄 Compilar assets:            npm run dev"
echo "👤 Crear usuario:              php artisan make:filament-user"
echo "🛡️ Asignar super admin:       php artisan shield:super-admin"
echo "🧪 Ejecutar tests:             php artisan test"
echo ""
echo "🌐 Panel de administración: http://localhost:8000/admin"
