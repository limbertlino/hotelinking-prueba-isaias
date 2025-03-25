# Hotelinking Prueba

## Prerrequisitos

Asegúrate de tener instalados los siguientes requisitos en tu máquina de desarrollo:

- **Docker** - Descarga e instala [Docker](https://www.docker.com/) para ejecutar contenedores.
- **Docker Compose** - Instalado automáticamente con Docker Desktop.
- **Laravel Installer** - Puedes instalar Laravel fácilmente con el siguiente comando:
    ```bash
    /bin/bash -c "$(curl -fsSL https://php.new/install/linux/8.4)"
    ```
    Esto instalará Laravel y todas sus dependencias necesarias.

## Configuración del entorno

Antes de ejecutar la aplicación, es necesario configurar el archivo `.env`. Laravel proporciona un archivo de ejemplo `.env.example` que debes copiar y renombrar:

```bash
cp .env.example .env
```

Luego, genera la clave de la aplicación:

```bash
./vendor/bin/sail artisan key:generate
```

### Configuración de la base de datos en `.env`

En el archivo `.env`, asegúrate de modificar los siguientes valores para la base de datos:

```env
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=hotelinking_codes
DB_USERNAME=<nombre_usuario>
DB_PASSWORD=
```

También se recomienda crear un archivo `.env.testing` para pruebas, con los mismos valores pero con una base de datos diferente para evitar afectar los datos principales.

## Instrucciones para Docker con Laravel Sail

### 1. Construir y levantar los contenedores

Para iniciar los contenedores con Laravel Sail, ejecuta el siguiente comando:

```bash
./vendor/bin/sail up -d
```

Este comando levantará todos los servicios definidos en `docker-compose.yml` en modo _detached_ (en segundo plano).

### 2. Aplicar las migraciones de la base de datos

Una vez que los contenedores estén corriendo, ejecuta las migraciones para preparar la base de datos:

```bash
./vendor/bin/sail artisan migrate
```

Este comando creará las tablas necesarias en la base de datos definida en Docker.

### 3. Poblar la base de datos con datos de prueba

Si deseas agregar datos iniciales a la base de datos, puedes ejecutar:

```bash
./vendor/bin/sail artisan db:seed
```

### 4. Acceder a la aplicación en el navegador

Una vez que los contenedores estén corriendo, puedes acceder al frontend visitando:

```
http://localhost:8000
```

### 5. Detener los contenedores

Si necesitas detener los contenedores, usa el siguiente comando:

```bash
./vendor/bin/sail down
```

Esto apagará y eliminará los contenedores sin afectar los datos almacenados en la base de datos.

### 6. Reconstruir los contenedores (si hay cambios en `docker-compose.yml`)

Si realizas cambios en la configuración de Docker, es recomendable reconstruir los contenedores con:

```bash
./vendor/bin/sail build --no-cache
```

## Comandos útiles

### Acceder al contenedor de la aplicación

Si necesitas ejecutar comandos dentro del contenedor de Laravel, usa:

```bash
./vendor/bin/sail shell
```

### Ejecutar migraciones y seeders

Si deseas poblar la base de datos con datos de prueba, usa:

```bash
./vendor/bin/sail artisan migrate --seed
```

### Ver los logs de los contenedores

Para ver los registros de los servicios en ejecución:

```bash
./vendor/bin/sail logs
```

## Ejecutar pruebas del backend

Para ejecutar las pruebas del backend con PHPUnit, usa el siguiente comando dentro del contenedor:

```bash
./vendor/bin/sail artisan test
```

Si deseas ver la salida detallada de las pruebas, puedes ejecutar:

```bash
./vendor/bin/sail artisan test --verbose
```

## Tecnologías utilizadas

- **Laravel** - Framework de PHP para desarrollo web.
- **MySQL / PostgreSQL** - Base de datos (según configuración en `docker-compose.yml`).
- **Sail** - Entorno de desarrollo basado en Docker para Laravel.

Con estas instrucciones, cualquier persona podrá levantar y trabajar con tu aplicación usando Docker y Laravel Sail. 🚀
