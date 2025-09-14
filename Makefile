# Makefile para Control de Biblioteca
# Comandos de conveniencia para Docker

.PHONY: help build up down logs shell test lint migrate seed smoke clean dev prod

# Variables
COMPOSE_FILE = docker-compose.yml
COMPOSE_DEV_FILE = docker-compose.dev.yml
APP_CONTAINER = biblioteca-app
DB_CONTAINER = biblioteca-db

# Ayuda
help: ## Mostrar ayuda
	@echo "Comandos disponibles:"
	@echo ""
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-20s\033[0m %s\n", $$1, $$2}'

# Construcción
build: ## Construir imágenes Docker
	docker-compose -f $(COMPOSE_FILE) build

build-dev: ## Construir imágenes Docker para desarrollo
	docker-compose -f $(COMPOSE_DEV_FILE) build

# Ejecución
up: ## Levantar servicios en producción
	docker-compose -f $(COMPOSE_FILE) up -d

up-dev: ## Levantar servicios en desarrollo
	docker-compose -f $(COMPOSE_DEV_FILE) up -d

down: ## Detener servicios
	docker-compose -f $(COMPOSE_FILE) down

down-dev: ## Detener servicios de desarrollo
	docker-compose -f $(COMPOSE_DEV_FILE) down

# Logs
logs: ## Ver logs de todos los servicios
	docker-compose -f $(COMPOSE_FILE) logs -f

logs-app: ## Ver logs de la aplicación
	docker-compose -f $(COMPOSE_FILE) logs -f app

logs-db: ## Ver logs de la base de datos
	docker-compose -f $(COMPOSE_FILE) logs -f db

logs-dev: ## Ver logs de desarrollo
	docker-compose -f $(COMPOSE_DEV_FILE) logs -f

# Shell
shell: ## Acceder al shell del contenedor de la aplicación
	docker-compose -f $(COMPOSE_FILE) exec app /bin/bash

shell-dev: ## Acceder al shell del contenedor de desarrollo
	docker-compose -f $(COMPOSE_DEV_FILE) exec app /bin/bash

shell-db: ## Acceder al shell de la base de datos
	docker-compose -f $(COMPOSE_FILE) exec db mysql -u root -p

# Base de datos
migrate: ## Ejecutar migraciones de base de datos
	@echo "Las migraciones se ejecutan automáticamente al iniciar el contenedor"
	@echo "Verificando estado de la base de datos..."
	docker-compose -f $(COMPOSE_FILE) exec db mysql -u biblioteca_user -pbiblioteca_pass control_biblioteca -e "SHOW TABLES;"

seed: ## Ejecutar seed de base de datos
	@echo "El seed se ejecuta automáticamente al iniciar el contenedor"
	@echo "Verificando datos..."
	docker-compose -f $(COMPOSE_FILE) exec db mysql -u biblioteca_user -pbiblioteca_pass control_biblioteca -e "SELECT COUNT(*) as total_libros FROM libros;"

db-reset: ## Reiniciar base de datos (CUIDADO: elimina todos los datos)
	docker-compose -f $(COMPOSE_FILE) down -v
	docker volume rm control-biblioteca_db_data || true
	docker-compose -f $(COMPOSE_FILE) up -d

# Testing
test: ## Ejecutar tests (placeholder)
	@echo "Tests no implementados aún"
	@echo "Verificando que la aplicación responde..."

smoke: ## Verificar que la aplicación responde
	@echo "Verificando que la aplicación responde..."
	@curl -f http://localhost:8080/ || (echo "❌ La aplicación no responde" && exit 1)
	@echo "✅ La aplicación responde correctamente"

# Linting
lint: ## Ejecutar linting (placeholder)
	@echo "Linting no implementado aún"
	@echo "Verificando sintaxis PHP..."
	docker-compose -f $(COMPOSE_FILE) exec app php -l index.php

# Limpieza
clean: ## Limpiar contenedores e imágenes
	docker-compose -f $(COMPOSE_FILE) down -v
	docker-compose -f $(COMPOSE_DEV_FILE) down -v
	docker system prune -f

clean-all: ## Limpiar todo (contenedores, imágenes, volúmenes)
	docker-compose -f $(COMPOSE_FILE) down -v --rmi all
	docker-compose -f $(COMPOSE_DEV_FILE) down -v --rmi all
	docker system prune -af

# Desarrollo
dev: build-dev up-dev ## Configurar entorno de desarrollo completo
	@echo "✅ Entorno de desarrollo listo"
	@echo "🌐 Aplicación: http://localhost:8080"
	@echo "🗄️  phpMyAdmin: http://localhost:8081"
	@echo "📊 Base de datos: localhost:3307"

# Producción
prod: build up ## Configurar entorno de producción completo
	@echo "✅ Entorno de producción listo"
	@echo "🌐 Aplicación: http://localhost:8080"
	@echo "📊 Base de datos: localhost:3306"

# Utilidades
status: ## Ver estado de los servicios
	docker-compose -f $(COMPOSE_FILE) ps

restart: ## Reiniciar servicios
	docker-compose -f $(COMPOSE_FILE) restart

restart-app: ## Reiniciar solo la aplicación
	docker-compose -f $(COMPOSE_FILE) restart app

backup-db: ## Hacer backup de la base de datos
	@mkdir -p backups
	docker-compose -f $(COMPOSE_FILE) exec db mysqldump -u root -p$${DB_ROOT_PASS:-root_password} control_biblioteca > backups/backup_$(shell date +%Y%m%d_%H%M%S).sql
	@echo "✅ Backup creado en backups/"

restore-db: ## Restaurar base de datos desde backup (usar: make restore-db BACKUP=archivo.sql)
	@if [ -z "$(BACKUP)" ]; then echo "❌ Especifica el archivo de backup: make restore-db BACKUP=archivo.sql"; exit 1; fi
	docker-compose -f $(COMPOSE_FILE) exec -T db mysql -u root -p$${DB_ROOT_PASS:-root_password} control_biblioteca < $(BACKUP)
	@echo "✅ Base de datos restaurada desde $(BACKUP)"

# Configuración inicial
setup: ## Configuración inicial del proyecto
	@echo "🔧 Configurando proyecto..."
	@if [ ! -f .env ]; then cp env.example .env; echo "✅ Archivo .env creado"; fi
	@echo "✅ Configuración inicial completada"
	@echo "📝 Edita el archivo .env con tus configuraciones"
	@echo "🚀 Ejecuta 'make dev' para desarrollo o 'make prod' para producción"
