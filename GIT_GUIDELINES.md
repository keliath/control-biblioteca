# 📋 Guías de Git para Control de Biblioteca

## 🚫 Archivos que NO se versionan

### Archivos de Configuración Sensibles
- `.env` - Variables de entorno (usar `env.example` como plantilla)
- `config/database.php` - Configuración de base de datos local
- `*.local.php` - Archivos de configuración local

### Archivos de Uploads y Media
- `admin/vistas/img/usuarios/*` - Fotos de usuarios subidas
- `admin/vistas/img/libros/*` - Portadas de libros subidas
- `vistas/img/usuarios/*` - Imágenes públicas de usuarios
- `vistas/img/libros/*` - Imágenes públicas de libros

### Archivos de Logs y Cache
- `*.log` - Todos los archivos de log
- `cache/` - Archivos de caché
- `tmp/` - Archivos temporales

### Archivos del Sistema
- `.DS_Store` - Archivos de macOS
- `Thumbs.db` - Archivos de Windows
- `*.swp`, `*.swo` - Archivos temporales de Vim

## ✅ Archivos que SÍ se versionan

### Configuración del Proyecto
- `docker-compose.yml` - Configuración de servicios
- `docker-compose.dev.yml` - Configuración de desarrollo
- `Dockerfile` - Imagen de producción
- `Dockerfile.dev` - Imagen de desarrollo
- `Makefile` - Scripts de conveniencia
- `env.example` - Plantilla de variables de entorno

### Código Fuente
- `*.php` - Archivos PHP
- `*.js` - Archivos JavaScript
- `*.css` - Archivos CSS
- `*.html` - Archivos HTML

### Documentación
- `README.md` - Documentación principal
- `ARCHITECTURE.md` - Documentación de arquitectura
- `GIT_GUIDELINES.md` - Esta guía

### Estructura de Directorios
- `.gitkeep` - Archivos para mantener directorios vacíos

## 🔧 Comandos Útiles

### Ver archivos ignorados
```bash
git status --ignored
```

### Ver qué archivos serían agregados
```bash
git add --dry-run .
```

### Limpiar archivos ignorados del working directory
```bash
git clean -fd
```

### Ver diferencias incluyendo archivos ignorados
```bash
git status --ignored
```

## 📝 Flujo de Trabajo Recomendado

### 1. Configuración Inicial
```bash
# Copiar plantilla de variables de entorno
cp env.example .env

# Editar configuración local
nano .env
```

### 2. Desarrollo
```bash
# Hacer cambios en el código
# Los archivos de uploads se ignoran automáticamente

# Verificar qué se va a commitear
git status

# Agregar archivos específicos
git add archivo.php

# Commit con mensaje descriptivo
git commit -m "feat: agregar nueva funcionalidad de búsqueda"
```

### 3. Antes de hacer Push
```bash
# Verificar que no hay archivos sensibles
git status

# Verificar que no hay archivos grandes
git ls-files | xargs ls -lh | sort -k5 -hr | head -10
```

## ⚠️ Advertencias Importantes

### Nunca commitees:
- Archivos `.env` con credenciales reales
- Archivos de base de datos (`.sql`, `.db`)
- Archivos de uploads de usuarios
- Archivos de logs con información sensible
- Archivos de configuración local

### Siempre verifica:
- Que las credenciales estén en variables de entorno
- Que los archivos de uploads no estén en el commit
- Que no haya archivos temporales o de cache
- Que la documentación esté actualizada

## 🔍 Verificación de Seguridad

### Script de verificación (opcional)
```bash
#!/bin/bash
# Verificar que no hay archivos sensibles en el commit

echo "🔍 Verificando archivos sensibles..."

# Verificar archivos .env
if git ls-files | grep -q "\.env$"; then
    echo "❌ ERROR: Archivo .env encontrado en el commit"
    exit 1
fi

# Verificar archivos de base de datos
if git ls-files | grep -q "\.sql$"; then
    echo "❌ ERROR: Archivos .sql encontrados en el commit"
    exit 1
fi

# Verificar archivos de uploads
if git ls-files | grep -q "admin/vistas/img/usuarios/[^.]"; then
    echo "❌ ERROR: Archivos de uploads de usuarios encontrados"
    exit 1
fi

echo "✅ Verificación completada - No se encontraron archivos sensibles"
```

## 📚 Recursos Adicionales

- [Git Documentation](https://git-scm.com/doc)
- [GitHub Gitignore Templates](https://github.com/github/gitignore)
- [PHP Gitignore Template](https://github.com/github/gitignore/blob/main/PHP.gitignore)
- [Docker Gitignore Template](https://github.com/github/gitignore/blob/main/Docker.gitignore)
