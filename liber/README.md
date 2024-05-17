# Liber - Puesta en marcha del proyecto

## Instalación de herramientas necesarias

### PHP

Se necesita instalar el lenguaje de programación PHP con sus paquetes necesarios para el desarrollo web. 

```bash
    sudo apt install ca-certificates apt-transport-https software-properties-common
    sudo add-apt-repository ppa:ondrej/php
    sudo apt update
    sudo apt install php8.1 php8.1-bcmath php8.1-mbstring php8.1-xml php8.1-mysql php8.1-curl
    sudo update-alternatives --set php /usr/bin/php8.1
```

En la página oficial de PHP se pueden encontrar las instrucciones para instalar PHP en otros sistemas operativos. 
Puedes encontrar más detalles en https://www.php.net/manual/en/install.php.

### Composer
Para instalar Composer seguir las instrucciones en https://getcomposer.org/doc/00-intro.md.

Para los usuarios de Windows y MacOS, la documentación de Laravel recomienda la herramienta Laravel Herd que facilita la instalación
de PHP y Composer en estos sistemas operativos. Enlace a la documentación de Laravel Herd: https://herd.laravel.com/docs/windows/1/getting-started/about-herd.

### Node.js y NPM
También es necesario instalar Node.js y NPM para la gestión de paquetes de JavaScript. Para ello se recomienda usar el recurso
proporcionado por la página oficial de Node.js: https://nodejs.org/en/download/.

### MySQL
Por último, es necesario instalar un servidor de base de datos, para el desarrollo de Liber se ha utilizado MySQL. En Ubuntu
se puede instalar con el siguiente comando

```bash
    sudo apt install mysql-server
```
En otros sistemas operativos, se puede seguir la documentación oficial de MySQL para la instalación y utilizar el instalador
de MySQL que facilita la instalación en Windows y MacOS. Enlace de descarga: https://dev.mysql.com/downloads/mysql/.

Es necesario crear una base de datos en MySQL para el proyecto, esto se puede llevar a cabo de multiples maneras, por línea de comandos
o mediante una interfaz gráfica con herramientas como PhpMyAdmin, MySQL Workbench, Adminer o DataGrip. Se deja a elección del usuario
la herramienta que prefiera para la creación de la base de datos. Se pide crear una base de datos y un usuario que tenga acceso a ella.

## Dependencias y configuración del proyecto

Clonar o descargar el código fuente del proyecto desde el repositorio de GitHub. 

```bash
    git clone https://github.com/ea57-ua/Liber.git
```

Instalar las dependencias con:
    
```bash
    cd liber
    composer install
    npm install
```

Crear un archivo .env en la raíz del proyecto con la configuración de la base de datos. Se puede copiar el archivo .env.example y modificar
los valores de las variables de entorno. 

```bash
    cp .env.example .env
```

### Configuración de la base de datos
```bash
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=base_de_datos
    DB_USERNAME=usuario
    DB_PASSWORD=contraseña
```
Generamos la clave de aplicación de Laravel y ejecutamos las migraciones para crear las tablas de la base de datos.

```bash 
php artisan key:generate
php artisan migrate:install
php artisan migrate
php artisan db:seed
```

### Configuración para el envio de correos electrónicos
```bash
    MAIL_MAILER=smtp
    MAIL_HOST=sandbox.smtp.mailtrap.io
    MAIL_PORT=2525
    MAIL_USERNAME=f0a6bd********
    MAIL_PASSWORD=0c061c********
    MAIL_ENCRYPTION=null
    MAIL_FROM_ADDRESS="noreply@liber.com"
    MAIL_FROM_NAME="${APP_NAME}"
``` 

Se recomienda utilizar un servicio de correo electrónico como Mailtrap para el envío de correos electrónicos en un entorno de
desarrollo. En el siguiente enlace se puede encontrar información de como obtener las credenciales de Mailtrap:
https://help.mailtrap.io/article/5-testing-integration.

### Configuración del servicio Pusher para el chat
```bash
    PUSHER_APP_ID=15******
    PUSHER_APP_KEY=36b33d22e9***********
    PUSHER_APP_SECRET=f6c1f47dee0**********
    PUSHER_HOST=
    PUSHER_PORT=443
    PUSHER_SCHEME=https
    PUSHER_APP_CLUSTER=eu
```
Las credenciales anteriores se obtienen creando una aplicación en Pusher y copiando las credenciales que se generan en
la sección "App Keys" de la aplicación creada. También es necesario permitir los eventos de cliente en la configuración de la
aplicación de Pusher. Enlace de la documentación de Pusher: https://pusher.com/docs/channels/.

### Configuración para el protocolo OAuth2 con Google
```bash
    GOOGLE_CLIENT_ID="*************************************.apps.googleusercontent.com"
    GOOGLE_CLIENT_SECRET="*************************************"
    GOOGLE_CLIENT_REDIERECT="http://localhost:8000/auth/google/callback"
```

Dado que Google cambia con frecuencia la manera de obtener las credenciales, se recomienda seguir la documentación oficial de Google
para implementar el protocolo OAuth2. Enlace de interés: https://developers.google.com/identity/gsi/web/guides/get-google-api-clientid.

## Ejecución del proyecto
Ejecutamos en una terminal:
```bash
npm run dev
```
Y en otra terminal ejecutamos:
```bash
php artisan serve
```

Accedemos a la dirección http://localhost:8000/ para visualizar la aplicación web.
