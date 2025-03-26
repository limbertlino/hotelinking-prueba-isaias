# Hotelinking Prueba

## Requisitos previos

Asegúrate de tener instalados los siguientes requisitos en tu máquina de desarrollo:

- **Node.js** - Puedes instalar Node siguiendo estas instrucciones:
https://github.com/nvm-sh/nvm?tab=readme-ov-file#installing-and-updating 

  Una vez instalado puedes obtener la última versión LTS con este comando:
  ```bash
    nvm install --lts 
  ```

- **Laravel Installer** - Puedes instalar Laravel en Linux fácilmente con el siguiente comando:
    ```bash
    /bin/bash -c "$(curl -fsSL https://php.new/install/linux/8.4)"
    ```

  Esto instalará PHP, Laravel y Composer.

  Si tienes Windows o Mac, puedes seguir las instrucciones de este enlace:
https://laravel.com/docs/12.x/installation#installing-php

- **MySql**

## Configuración del entorno
 
### 1. Clonar repositorio
```bash
git clone https://github.com/limbertlino/hotelinking-prueba-isaias.git

cd hotelinking-prueba-isaias
```
### 2. Instalar dependencias
```bash
composer install
```
### 3. Configurar archivo de entorno
```bash
cp .env.example .env
```
También se recomienda crear un archivo `.env.testing` para pruebas, con los mismos valores de .env pero con una base de datos diferente para evitar afectar los datos principales.
### 4. Configurar base de datos
Edita el archivo .env con tus credenciales
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=<NOMBRE_DB>
DB_USERNAME=<NOMBRE_USER_MYSQL>
DB_PASSWORD=<PASSWORD>
```

### 5. Generar Clave de aplicación
```bash
php artisan key:generate
```
### 6. Ejecutar migraciones
```bash
php artisan migrate
```
### 7. Poblar base de datos
```bash
php artisan db:seed
```
### 8. Instalar dependencias de node
```bash
npm install
```

### 9. Correr aplicación
```bash
composer run dev
```

### 10. Acceder a la aplicación
Puedes acceder mediante http://localhost:8000 o http://127.0.0.1:8000

**Recuerda** que los usuarios generados por el seed pueden visualizarse en la tabla users de tu base de datos y que su contraseña por defecto es: password

Si tienes algún problema con la base de datos de los test revisa el archivo phpunit.xml, ahi puedes configurar los datos necesarios para tu base de datos de testing.


## Comandos útiles

### Ejecutar migraciones y seeders

Si deseas poblar la base de datos con datos de prueba, usa:

```bash
php artisan migrate --seed
```

## Ejecutar pruebas del backend

Para ejecutar las pruebas del backend con PHPUnit, usa el siguiente comando:

```bash
php artisan test
```

Si deseas ver la salida detallada de las pruebas, puedes ejecutar:

```bash
php artisan test --verbose
```

## Tecnologías utilizadas

- **Laravel** - Framework de PHP para desarrollo web.
- **MySQL** - Base de datos.
- **React** - Biblioteca de JavaScript para interfaces de usuario.

