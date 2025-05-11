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
INSERT INTO productos (nombre, categoria, precio, imagen) VALUES
('Waffle with Berries', 'Waffle', 6.50, 'image-waffle'),
('Vanilla Bean Crème Brûlée', 'Crème Brûlée', 7.00, 'image-creme-brulee'),
('Macaron Mix of Five', 'Macaron', 8.00, 'image-macaron'),
('Classic Tiramisu', 'Tiramisu', 5.50, 'image-tiramisu'),
('Pistachio Baklava', 'Baklava', 4.00, 'image-baklava'),
('Lemon Meringue Pie', 'Pie', 5.00, 'image-meringue'),
('Red Velvet Cake', 'Cake', 4.50, 'image-cake'),
('Salted Caramel Brownie', 'Brownie', 4.50, 'image-brownie'),
('Vanilla Panna Cotta', 'Panna Cotta', 6.50, 'image-panna-cotta');

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
('Admin', 'User', 'admin@pastelix.com', '$2y$10$R.9tOuQ1OcLn6LDNWiRZ7.gp1YG08zjlE/JC3qOuudUutAVTbw6s.', 1, 1),
('Cliente', 'Ejemplo', 'cliente@pastelix.com', '$2y$10$Lf51rawlegGW9AvcPcVHUe6gt5FgIHJ3FJXEKjT//sAslpKBnSPAW', 1, 0);

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

CREATE TABLE IF NOT EXISTS direcciones (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NULL,
    nombre VARCHAR(45) NULL,
    apellido VARCHAR(45) NULL,
    calle VARCHAR(45) NULL,
    ciudad VARCHAR(45) NULL,
    provincia VARCHAR(45) NULL,
    codigo_postal VARCHAR(15) NULL,
    pais VARCHAR(45) NULL,
    telefono VARCHAR(45) NULL,
    fecha_creacion DATETIME NULL,
    fecha_actualizacion DATETIME NULL,
    predeterminada TINYINT NULL,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE ON UPDATE CASCADE
);