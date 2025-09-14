# 🏗️ Arquitectura del Sistema

## Diagrama de Servicios

```mermaid
graph TB
    subgraph "Docker Compose"
        subgraph "Red: biblioteca-network"
            A[App PHP + Apache<br/>Puerto: 8080<br/>Usuario: appuser]
            B[MySQL 8.0<br/>Puerto: 3306<br/>Usuario: biblioteca_user]
            C[phpMyAdmin<br/>Puerto: 8081<br/>Solo desarrollo]
        end
        
        subgraph "Volúmenes"
            D[db_data<br/>Datos MySQL]
            E[app_uploads<br/>Imágenes usuarios/libros]
            F[app_uploads_public<br/>Imágenes públicas]
        end
    end
    
    G[Usuario Final<br/>Navegador Web]
    H[Desarrollador<br/>Terminal/IDE]
    
    G -->|HTTP/HTTPS| A
    H -->|SSH/Shell| A
    H -->|MySQL Client| B
    H -->|Web Interface| C
    
    A <-->|PDO/MySQL| B
    C -->|MySQL| B
    
    B --> D
    A --> E
    A --> F
```

## Flujo de Datos

```mermaid
sequenceDiagram
    participant U as Usuario
    participant A as App PHP
    participant D as MySQL DB
    participant F as Sistema de Archivos
    
    U->>A: Solicitud HTTP
    A->>D: Consulta SQL
    D-->>A: Resultados
    A->>F: Leer/Escribir archivos
    F-->>A: Datos de archivos
    A-->>U: Respuesta HTML/JSON
```

## Estructura de Base de Datos

```mermaid
erDiagram
    USUARIOS ||--o{ PRESTAMOS : tiene
    LIBROS ||--o{ PRESTAMOS : prestado_en
    AUTORES ||--o{ LIBROS : escribe
    CATEGORIAS ||--o{ LIBROS : clasifica
    EDITORIALES ||--o{ LIBROS : publica
    UBICACIONES ||--o{ LIBROS : ubicado_en
    
    USUARIOS {
        int id_usuario PK
        string usu_perfil
        string usu_nombre
        text usu_password
        string usu_cedula
        string usu_email
        int usu_activo
    }
    
    LIBROS {
        int id_libro PK
        int id_autor FK
        int id_ubicacion FK
        int id_categoria FK
        int id_editorial FK
        string lib_titulo
        int lib_year
        string lib_isbn
        int lib_estado
    }
    
    PRESTAMOS {
        int id_prestamo PK
        int id_usuario FK
        int id_libro FK
        datetime pre_fechaPedido
        datetime pre_fechaPrestamo
        datetime pre_fechaDevolucion
        int pre_estado
    }
```

## Configuración de Redes

```mermaid
graph LR
    subgraph "Host Machine"
        subgraph "Docker Network: biblioteca-network"
            A[App Container<br/>172.20.0.2]
            B[DB Container<br/>172.20.0.3]
            C[phpMyAdmin Container<br/>172.20.0.4]
        end
        
        D[Host Ports<br/>8080, 3306, 8081]
    end
    
    E[Internet] --> D
    D --> A
    D --> B
    D --> C
```

## Ciclo de Vida de Contenedores

```mermaid
stateDiagram-v2
    [*] --> Building: docker-compose build
    Building --> Starting: docker-compose up
    Starting --> Running: Health checks pass
    Running --> Stopping: docker-compose down
    Stopping --> [*]
    
    Running --> Restarting: docker-compose restart
    Restarting --> Running
    
    Running --> Updating: Code changes (dev mode)
    Updating --> Running
    
    Running --> Error: Health check fails
    Error --> Restarting: Auto restart
```

## Estrategia de Despliegue

### Desarrollo
- Bind mounts para hot reload
- phpMyAdmin habilitado
- Logs detallados
- Debug mode activado

### Producción
- Imágenes optimizadas
- Usuario no-root
- Health checks
- Límites de recursos
- Logs estructurados

## Monitoreo y Observabilidad

```mermaid
graph TB
    subgraph "Aplicación"
        A[Health Check<br/>HTTP GET /]
        B[Logs de Apache<br/>/var/log/apache2/]
        C[Logs de PHP<br/>error_log]
    end
    
    subgraph "Base de Datos"
        D[Health Check<br/>mysqladmin ping]
        E[Logs de MySQL<br/>/var/log/mysql/]
        F[Métricas de rendimiento]
    end
    
    subgraph "Sistema"
        G[Uso de CPU/RAM<br/>docker stats]
        H[Espacio en disco<br/>df -h]
        I[Red<br/>netstat]
    end
    
    J[Dashboard de Monitoreo] --> A
    J --> D
    J --> G
```

## Seguridad

### Capas de Seguridad Implementadas

1. **Contenedor**
   - Usuario no-root
   - Imagen mínima
   - Health checks

2. **Aplicación**
   - Variables de entorno
   - Validación PDO
   - Headers de seguridad

3. **Base de Datos**
   - Usuario dedicado
   - Contraseñas seguras
   - Logs de auditoría

4. **Red**
   - Red aislada
   - Puertos específicos
   - Sin exposición innecesaria

## Escalabilidad

### Horizontal
- Múltiples instancias de app
- Load balancer (nginx/traefik)
- Base de datos replicada

### Vertical
- Aumentar recursos de contenedores
- Optimizar consultas SQL
- Cache de aplicación (Redis)

## Backup y Recuperación

```mermaid
graph LR
    A[Base de Datos] --> B[mysqldump]
    B --> C[Backup File]
    C --> D[Almacenamiento]
    D --> E[Restauración]
    E --> A
    
    F[Archivos de Usuario] --> G[rsync/tar]
    G --> H[Backup Archive]
    H --> D
```

## Troubleshooting

### Flujo de Diagnóstico

1. **Verificar estado de servicios**
   ```bash
   make status
   docker-compose ps
   ```

2. **Revisar logs**
   ```bash
   make logs-app
   make logs-db
   ```

3. **Verificar conectividad**
   ```bash
   make shell-db
   make smoke
   ```

4. **Reiniciar servicios**
   ```bash
   make restart
   ```

5. **Limpieza completa**
   ```bash
   make clean-all
   make setup
   make dev
   ```
