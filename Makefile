# Makefile para Laravel Filament CRM

.PHONY: install setup build deploy clean test help

# Variables
PROJECT_NAME ?= mi-crm
PHP_VERSION ?= 8.3
NODE_VERSION ?= 20

# Comandos principales
help: ## Mostrar esta ayuda
	@echo "Laravel Filament CRM - Comandos disponibles:"
	@echo "=========================================="
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-20s\033[0m %s\n", $$1, $$2}'

install: ## Instalación completa del proyecto
	@echo "🚀 Instalando Laravel Filament CRM..."
	composer install
	npm install
	cp .env.example .env
	php artisan key:generate
	@echo "ℹ️ Configuración base creada. Ejecuta 'make setup' para configurar MySQL."
	@echo "✅ Instalación completada!"

setup: ## Configuración inicial para desarrollo (incluye MySQL)
	@echo "⚙️ Configurando entorno de desarrollo..."
	./post-install.sh
	@echo "✅ Configuración completada!"

build: ## Compilar assets para producción
	@echo "🎨 Compilando assets..."
	npm run build
	php artisan config:cache
	php artisan route:cache
	php artisan view:cache

dev: ## Iniciar servidor de desarrollo
	@echo "🔥 Iniciando servidor de desarrollo..."
	php artisan serve

fresh: ## Reinstalar completamente
	@echo "🧹 Limpiando instalación anterior..."
	rm -rf vendor node_modules .env database/database.sqlite
	$(MAKE) install

test: ## Ejecutar tests
	@echo "🧪 Ejecutando tests..."
	php artisan test

clean: ## Limpiar cache y archivos temporales
	@echo "🧹 Limpiando cache..."
	php artisan cache:clear
	php artisan config:clear
	php artisan route:clear
	php artisan view:clear
	rm -rf bootstrap/cache/*.php

deploy: build ## Preparar para despliegue
	@echo "🚀 Preparando para despliegue..."
	composer install --no-dev --optimize-autoloader
	php artisan migrate --force

# Comandos de utilidad
backup-db: ## Hacer backup de la base de datos MySQL
	@echo "💾 Creando backup de la base de datos..."
	mysqldump -u$(DB_USERNAME) -p$(DB_PASSWORD) $(DB_DATABASE) > database/backup-$(shell date +%Y%m%d_%H%M%S).sql

restore-db: ## Restaurar backup de la base de datos (usar con BACKUP=archivo.sql)
	@echo "♻️ Restaurando backup de la base de datos..."
	mysql -u$(DB_USERNAME) -p$(DB_PASSWORD) $(DB_DATABASE) < $(BACKUP)

logs: ## Ver logs de la aplicación
	@echo "📋 Mostrando logs..."
	tail -f storage/logs/laravel.log

update: ## Actualizar dependencias
	@echo "🔄 Actualizando dependencias..."
	composer update
	npm update
