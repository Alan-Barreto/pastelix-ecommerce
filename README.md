Pastelix Ecommerce
Versión en desarrollo

Tienda online para la venta de postres con gestión de usuarios (clientes y administradores), pagos para clientes e invitados, y funcionalidades completas de autenticación.

Tecnologías utilizadas
PHP 8.3

MySQL

Sass

JavaScript modular (compilado con Webpack)

Gulp

Composer

PHPMailer (para envío de correos)

Mailtrap (para pruebas de correo)


Requisitos
PHP 8.1 o superior

Node.js y npm

Composer

Servidor MySQL


Instalación
Clonar el repositorio:

git clone https://github.com/Alan-Barreto/pastelix-ecommerce.git
cd pastelix-ecommerce

Configurar el entorno

Renombrá el archivo .env.example a .env

Completá los datos con tu configuración local:

    Credenciales de base de datos (DB_HOST, DB_USER, etc.).

    Credenciales SMTP desde Mailtrap para pruebas de correo.

Instalar dependencias
Desde la raíz del proyecto, ejecutá:

composer install
npm install

Para compilar los assets:

npm run dev

Correo de prueba
Para que el envío de emails funcione, creá una cuenta gratuita en Mailtrap.io y copiá tus credenciales SMTP al archivo .env.

Importar la base de datos
Importá el archivo database.sql en tu gestor de base de datos MySQL/MariaDB (ej., phpMyAdmin, DBeaver o consola). Esto creará las tablas y algunos datos iniciales.

Usuarios de prueba
Cliente:

Email: cliente@pastelix.com

Contraseña: 123456

Administrador:

Email: admin@pastelix.com

Contraseña: 123456


Funcionalidades implementadas
    Registro y login de usuarios

    Confirmación de cuenta por correo

    Recuperación de contraseña
    

    Carrito de compras funcional

    Roles cliente/admin con vistas separadas

    Validaciones del lado cliente y servidor

    Conversión automática de imágenes a WebP

    Panel de administración para gestionar productos

    Pagos con integración a PayPal

    Historial de pedidos para usuarios

    Vista de estadísticas para administradores

En desarrollo

    Diseño visual y mejoras en UI


Contacto
Puedes seguir el desarrollo del proyecto desde mi perfil de GitHub: https://github.com/Alan-Barreto

