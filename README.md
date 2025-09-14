# 📚 Control de Biblioteca

Sistema de gestión de biblioteca física desarrollado en PHP con MySQL, dockerizado con las mejores prácticas.

## 🚀 Inicio Rápido

### Requisitos Previos

- **Docker** 20.10+
- **Docker Compose** 2.0+
- **Make** (opcional, para comandos de conveniencia)

### Configuración Inicial

```bash
# 1. Clonar el repositorio
git clone <repository-url>
cd control-biblioteca

# 2. Configuración inicial
make setup

# 3. Editar variables de entorno
cp env.example .env
# Editar .env con tus configuraciones

# 4. Levantar entorno de desarrollo
make dev
```

### Acceso a la Aplicación

- **Aplicación**: http://localhost:8080
- **phpMyAdmin**: http://localhost:8081 (solo desarrollo)
- **Base de datos**: localhost:3306 (producción) / localhost:3307 (desarrollo)

## 🐳 Comandos Docker

### Comandos Básicos

```bash
# Desarrollo
make dev          # Configurar entorno de desarrollo completo
make up-dev       # Levantar servicios de desarrollo
make down-dev     # Detener servicios de desarrollo

# Producción
make prod         # Configurar entorno de producción completo
make up           # Levantar servicios de producción
make down         # Detener servicios de producción

# Construcción
make build        # Construir imágenes de producción
make build-dev    # Construir imágenes de desarrollo
```

### Comandos de Utilidad

```bash
# Logs
make logs         # Ver logs de todos los servicios
make logs-app     # Ver logs de la aplicación
make logs-db      # Ver logs de la base de datos

# Shell
make shell        # Acceder al shell de la aplicación
make shell-dev    # Acceder al shell de desarrollo
make shell-db     # Acceder al shell de la base de datos

# Base de datos
make migrate      # Verificar migraciones
make seed         # Verificar datos iniciales
make backup-db    # Hacer backup de la base de datos
make restore-db BACKUP=archivo.sql  # Restaurar desde backup

# Testing
make smoke        # Verificar que la aplicación responde
make status       # Ver estado de los servicios
```

### Limpieza

```bash
make clean        # Limpiar contenedores e imágenes
make clean-all    # Limpiar todo (contenedores, imágenes, volúmenes)
```

## ⚙️ Variables de Entorno

| Variable | Descripción | Valor por Defecto |
|----------|-------------|-------------------|
| `DB_HOST` | Host de la base de datos | `db` |
| `DB_NAME` | Nombre de la base de datos | `control_biblioteca` |
| `DB_USER` | Usuario de la base de datos | `biblioteca_user` |
| `DB_PASS` | Contraseña de la base de datos | `biblioteca_pass` |
| `DB_ROOT_PASS` | Contraseña root de MySQL | `root_password` |
| `APP_ENV` | Entorno de la aplicación | `production` |
| `APP_DEBUG` | Modo debug | `false` |

## 🏗️ Arquitectura

### Servicios

```
┌─────────────────┐    ┌─────────────────┐    ┌─────────────────┐
│   Aplicación    │    │   Base de       │    │   phpMyAdmin    │
│   PHP + Apache  │◄──►│   Datos MySQL   │◄──►│   (solo dev)    │
│   Puerto 8080   │    │   Puerto 3306   │    │   Puerto 8081   │
└─────────────────┘    └─────────────────┘    └─────────────────┘
```

### Volúmenes

- `db_data`: Datos persistentes de MySQL
- `app_uploads`: Imágenes de usuarios y libros
- `app_uploads_public`: Imágenes públicas

### Redes

- `biblioteca-network`: Red bridge para comunicación entre servicios

## 📁 Estructura del Proyecto

```
control-biblioteca/
├── admin/                    # Panel administrativo
│   ├── controladores/        # Controladores PHP
│   ├── modelos/             # Modelos de datos
│   ├── vistas/              # Vistas HTML/CSS/JS
│   └── extensiones/         # Dependencias PHP (Composer)
├── vistas/                  # Frontend público
├── docker/                  # Configuración Docker
│   ├── apache/              # Configuración Apache
│   └── mysql/               # Configuración MySQL
├── docker-compose.yml       # Servicios de producción
├── docker-compose.dev.yml   # Servicios de desarrollo
├── Dockerfile               # Imagen de producción
├── Dockerfile.dev           # Imagen de desarrollo
├── Makefile                 # Comandos de conveniencia
├── .gitignore               # Archivos ignorados por Git
├── GIT_GUIDELINES.md        # Guías de Git
└── env.example              # Variables de entorno de ejemplo
```

## 🔧 Desarrollo

### Hot Reload

El entorno de desarrollo incluye hot reload automático:
- Los cambios en el código se reflejan inmediatamente
- No es necesario reconstruir la imagen

### Control de Versiones (Git)

El proyecto incluye un `.gitignore` completo que excluye:
- Archivos de configuración sensibles (`.env`)
- Archivos de uploads de usuarios y libros
- Logs y archivos temporales
- Archivos del sistema operativo
- Archivos de IDEs y editores

**Ver [GIT_GUIDELINES.md](GIT_GUIDELINES.md) para guías detalladas de Git.**

### Base de Datos

La base de datos se inicializa automáticamente con:
- Esquema de tablas
- Datos de ejemplo (seed)
- Usuarios de prueba

### Credenciales por Defecto

- **Admin**: admin@gmail.com / contraseña por defecto
- **Usuario**: carlos0altamirano@gmail.com / contraseña por defecto

## 🚨 Troubleshooting

### Problemas Comunes

#### La aplicación no responde
```bash
# Verificar estado de servicios
make status

# Ver logs de la aplicación
make logs-app

# Verificar que la base de datos esté funcionando
make shell-db
```

#### Error de conexión a la base de datos
```bash
# Verificar logs de la base de datos
make logs-db

# Reiniciar servicios
make restart

# Reiniciar solo la base de datos
docker-compose restart db
```

#### Problemas de permisos
```bash
# Verificar permisos de archivos
docker-compose exec app ls -la /var/www/html

# Corregir permisos
docker-compose exec app chown -R appuser:appuser /var/www/html
```

#### Limpiar todo y empezar de nuevo
```bash
make clean-all
make setup
make dev
```

### Logs Útiles

```bash
# Logs de Apache
docker-compose exec app tail -f /var/log/apache2/error.log

# Logs de PHP
docker-compose exec app tail -f /var/log/php_errors.log

# Logs de MySQL
docker-compose exec db tail -f /var/log/mysql/error.log
```

## 🔒 Seguridad

### Mejoras Implementadas

- ✅ Credenciales movidas a variables de entorno
- ✅ Usuario no-root en contenedores
- ✅ Configuración de seguridad en Apache
- ✅ Validación de entrada en PDO
- ✅ Headers de seguridad

### Recomendaciones

- Cambiar contraseñas por defecto en producción
- Usar HTTPS en producción
- Configurar firewall
- Hacer backups regulares
- Monitorear logs de seguridad

## 📊 Monitoreo

### Health Checks

- **Aplicación**: Verifica que responda en http://localhost/
- **Base de datos**: Verifica conexión MySQL
- **Intervalo**: 30 segundos

### Métricas

```bash
# Ver uso de recursos
docker stats

# Ver estado de salud
docker-compose ps
```

## 🤝 Contribución

1. Fork el proyecto
2. Crear una rama para tu feature (`git checkout -b feature/AmazingFeature`)
3. Commit tus cambios (`git commit -m 'Add some AmazingFeature'`)
4. Push a la rama (`git push origin feature/AmazingFeature`)
5. Abrir un Pull Request

## 📄 Licencia

Este proyecto está bajo la Licencia MIT - ver el archivo [LICENSE](LICENSE) para detalles.

## 📞 Soporte

Para soporte técnico o preguntas:
- Crear un issue en GitHub
- Revisar la sección de troubleshooting
- Consultar los logs con `make logs`
