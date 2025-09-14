# Multi-stage Dockerfile para Control de Biblioteca
# Etapa 1: Builder - Instalar dependencias
FROM composer:2.6 AS builder

WORKDIR /app

# Copiar archivos de dependencias
COPY admin/extensiones/composer.json admin/extensiones/composer.lock ./

# Instalar dependencias PHP
RUN composer install --no-dev --optimize-autoloader --no-scripts

# Etapa 2: Runtime - Imagen de producción
FROM php:8.2-apache

# Instalar extensiones PHP necesarias
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    unzip \
    curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd pdo pdo_mysql zip \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Configurar Apache
RUN a2enmod rewrite headers

# Crear usuario no-root para seguridad
RUN groupadd -r appuser && useradd -r -g appuser appuser

# Configurar directorio de trabajo
WORKDIR /var/www/html

# Copiar aplicación
COPY --chown=appuser:appuser . .

# Copiar dependencias desde builder
COPY --from=builder --chown=appuser:appuser /app/vendor ./admin/extensiones/vendor

# Configurar permisos
RUN chown -R appuser:appuser /var/www/html \
    && chmod -R 755 /var/www/html \
    && chmod -R 777 /var/www/html/admin/vistas/img \
    && chmod -R 777 /var/www/html/vistas/img

# Configurar Apache virtual host
COPY docker/apache/000-default.conf /etc/apache2/sites-available/000-default.conf
COPY docker/apache/security.conf /etc/apache2/conf-available/security.conf
RUN a2enconf security

# Healthcheck
HEALTHCHECK --interval=30s --timeout=3s --start-period=5s --retries=3 \
    CMD curl -f http://localhost/ || exit 1

# Cambiar a usuario no-root
USER appuser

# Exponer puerto
EXPOSE 80

# Comando por defecto
CMD ["apache2-foreground"]
