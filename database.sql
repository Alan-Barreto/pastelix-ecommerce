-- Crear base de datos (opcional)
CREATE DATABASE IF NOT EXISTS carrito_postres;
USE carrito_postres;

-- Tabla: productos
CREATE TABLE IF NOT EXISTS productos (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(35) DEFAULT NULL,
    categoria VARCHAR(35) DEFAULT NULL,
    precio DECIMAL(5,2) DEFAULT NULL,
    imagen VARCHAR(45) DEFAULT NULL,
    miniatura VARCHAR(45) DEFAULT NULL
);

-- Insertar datos de ejemplo en productos
INSERT INTO productos (nombre, categoria, precio, imagen, miniatura) VALUES
('Waffle with Berries', 'Waffle', 6.50, './img/productos/image-waffle-tablet.jpg', './images/image-waffle-thumbnail.jpg'),
('Vanilla Bean Crème Brûlée', 'Crème Brûlée', 7.00, './img/productos/image-creme-brulee-tablet.jpg', './images/image-creme-brulee-thumbnail.jpg'),
('Macaron Mix of Five', 'Macaron', 8.00, './img/productos/image-macaron-tablet.jpg', './images/image-macaron-thumbnail.jpg'),
('Classic Tiramisu', 'Tiramisu', 5.50, './img/productos/image-tiramisu-tablet.jpg', './images/image-tiramisu-thumbnail.jpg'),
('Pistachio Baklava', 'Baklava', 4.00, './img/productos/image-baklava-tablet.jpg', './images/image-baklava-thumbnail.jpg'),
('Lemon Meringue Pie', 'Pie', 5.00, './img/productos/image-meringue-tablet.jpg', './images/image-meringue-thumbnail.jpg'),
('Red Velvet Cake', 'Cake', 4.50, './img/productos/image-cake-tablet.jpg', './images/image-cake-thumbnail.jpg'),
('Salted Caramel Brownie', 'Brownie', 4.50, './img/productos/image-brownie-tablet.jpg', './images/image-brownie-thumbnail.jpg'),
('Vanilla Panna Cotta', 'Panna Cotta', 6.50, './img/productos/image-panna-cotta-tablet.jpg', './images/image-panna-cotta-thumbnail.jpg');

-- Tabla: usuarios
CREATE TABLE IF NOT EXISTS usuarios (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(45) DEFAULT NULL,
    apellido VARCHAR(45) DEFAULT NULL,
    email VARCHAR(45) DEFAULT NULL,
    password VARCHAR(60) DEFAULT NULL,
    confirmado TINYINT DEFAULT NULL,
    admin TINYINT DEFAULT NULL
);

-- Insertar usuarios de ejemplo (passwords sin hashear para pruebas locales)
INSERT INTO usuarios (nombre, apellido, email, password, confirmado, admin) VALUES
('Admin', 'User', 'admin@pastelix.com', '123456', 1, 1),
('Cliente', 'Ejemplo', 'cliente@pastelix.com', '123456', 1, 0);

-- Tabla: tokens
CREATE TABLE IF NOT EXISTS tokens (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT DEFAULT NULL,
    selector CHAR(16) DEFAULT NULL,
    token CHAR(60) DEFAULT NULL,
    accion VARCHAR(45) DEFAULT NULL,
    nuevoEmail VARCHAR(45) DEFAULT NULL,
    nuevoPassword VARCHAR(60) DEFAULT NULL,
    fecha_creacion DATETIME DEFAULT NULL,
    fecha_expiracion DATETIME DEFAULT NULL,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE
);
