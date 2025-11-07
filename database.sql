-- Crear base de datos (opcional)
CREATE DATABASE IF NOT EXISTS carrito_postres;
USE carrito_postres;

-- Tabla: productos
CREATE TABLE IF NOT EXISTS productos (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(35) DEFAULT NULL,
    categoria VARCHAR(35) DEFAULT NULL,
    precio DECIMAL(5,2) DEFAULT NULL,
    imagen VARCHAR(45) DEFAULT NULL
);

-- Insertar datos de ejemplo en productos
INSERT INTO productos (nombre, categoria, precio, imagen) VALUES
('Pastel de Chocolate', 'Pastel', 28.00, 'imagen-pastel-chocolate'),
('Pastel Red Velvet', 'Pastel', 30.00, 'imagen-pastel-red-velvet'),

('Helado de Chocolate', 'Helado de Crema', 2.80, 'imagen-helado-chocolate'),
('Helado de Pistacho', 'Helado de Crema', 3.20, 'imagen-helado-pistacho'),

('Tarta de Manzana', 'Tarta', 18.00, 'imagen-tarta-manzana'),
('Tarta de Frutos Rojos', 'Tarta', 21.00, 'imagen-tarta-frutos-rojos'),

('Cupcake Chocolate', 'Cupcake', 2.50, 'imagen-cupcake-chocolate'),
('Cupcake Red Velvet', 'Cupcake', 2.80, 'imagen-cupcake-red-velvet'),

('Galleta de Avena y Miel', 'Galleta', 1.20, 'imagen-galleta-avena'),
('Galleta de Chocolate', 'Galleta', 1.50, 'imagen-galleta-chocolate'),

('Brownie Clásico', 'Brownie', 2.00, 'imagen-brownie-clasico'),
('Brownie con Nueces', 'Brownie', 2.50, 'imagen-brownie-nueces'),

('Cheesecake Clásico', 'Cheesecake', 3.50, 'imagen-cheesecake-clasico'),
('Cheesecake de Oreo', 'Cheesecake', 4.20, 'imagen-cheesecake-oreo'),

('Macaron Frambuesa', 'Macaron', 1.40, 'imagen-macaron-frambuesa'),
('Macaron Chocolate', 'Macaron', 1.60, 'imagen-macaron-chocolate'),

('Donut Chocolate', 'Donut', 1.70, 'imagen-donut-chocolate'),
('Donut Azúcar y Canela', 'Donut', 1.40, 'imagen-donut-azucar-canela'),
;

-- Tabla: usuarios
CREATE TABLE IF NOT EXISTS usuarios (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(45) DEFAULT NULL,
    apellido VARCHAR(45) DEFAULT NULL,
    email VARCHAR(45) DEFAULT NULL,
    telefono VARCHAR(20) DEFAULT NULL,
    password VARCHAR(60) DEFAULT NULL,
    fecha_registro  DATETIME DEFAULT NULL,
    confirmado TINYINT DEFAULT NULL,
    admin TINYINT DEFAULT NULL,
    baneo TINYINT DEFAULT NULL,

    UNIQUE INDEX `email_UNIQUE` (`email`)
);

INSERT INTO usuarios (id, nombre, confirmado, admin) VALUES
(1, 'Invitado', 1, 0);

-- Insertar usuarios de ejemplo 
INSERT INTO usuarios (nombre, apellido, email, telefono, password, confirmado, admin, baneo) VALUES
('Admin', 'User', 'admin@pastelix.com', '1234567', '$2y$10$R.9tOuQ1OcLn6LDNWiRZ7.gp1YG08zjlE/JC3qOuudUutAVTbw6s.', 1, 1, 0),
('Cliente', 'Ejemplo', 'cliente@pastelix.com', '1234567' '$2y$10$Lf51rawlegGW9AvcPcVHUe6gt5FgIHJ3FJXEKjT//sAslpKBnSPAW', 1, 0, 0);

CREATE TABLE IF NOT EXISTS usuario_sesion (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NULL,
    token VARCHAR(64) NULL,
    fecha_creacion DATETIME NULL,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE
);


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
    calle VARCHAR(45) NULL,
    ciudad VARCHAR(45) NULL,
    provincia VARCHAR(45) NULL,
    codigo_postal VARCHAR(15) NULL,
    pais_codigo VARCHAR(2) NULL,
    pais_nombre VARCHAR(45) NULL,
    fecha_creacion DATETIME NULL,
    fecha_actualizacion DATETIME NULL,
    predeterminada TINYINT NULL,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS carritos (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  usuario_id INT NULL,
  INDEX `usuarios-carritos_idx` (usuario_id) VISIBLE,
  CONSTRAINT `usuarios-carritos`
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE ON UPDATE NO ACTION
);

CREATE TABLE IF NOT EXISTS carrito_productos (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  carrito_id INT NULL,
  producto_id INT NULL,
  cantidad INT NULL,

  UNIQUE KEY un_carrito_producto (carrito_id, producto_id),
  
  INDEX `carritos-carrito_productos_idx` (carrito_id) VISIBLE,
  INDEX `productos-carrito_productos_idx` (producto_id) VISIBLE,
  CONSTRAINT `carritos-carrito_productos`
    FOREIGN KEY (carrito_id) REFERENCES carritos (id) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `productos-carrito_productos`
    FOREIGN KEY (producto_id) REFERENCES productos (id) ON DELETE CASCADE ON UPDATE NO ACTION
);


CREATE TABLE IF NOT EXISTS pedidos (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  usuario_id INT NULL,
  fecha DATETIME NULL,
  total DECIMAL(6,2) NULL,
  entrega VARCHAR(15) NULL,
  estado VARCHAR(15) NULL,
  pedido_id_paypal VARCHAR(30) NULL,

  UNIQUE INDEX `pedido_id_paypal_UNIQUE` (`pedido_id_paypal`),

  INDEX `usuarios-pedidos_idx` (usuario_id) VISIBLE,
  CONSTRAINT `usuarios-pedidos`
    FOREIGN KEY (usuario_id) REFERENCES usuarios (id) ON DELETE SET NULL ON UPDATE NO ACTION
);

CREATE TABLE IF NOT EXISTS pedido_productos (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  pedido_id INT NULL,
  producto_id INT NULL,
  cantidad INT NULL,
  precio_unitario DECIMAL(5,2) NULL,
  INDEX `productos-predido_productos_idx` (producto_id) VISIBLE,
  INDEX `pedidos-pedido_productos_idx` (pedido_id) VISIBLE,
  CONSTRAINT `productos-predido_productos`
    FOREIGN KEY (producto_id) REFERENCES productos (id) ON DELETE RESTRICT ON UPDATE NO ACTION,
  CONSTRAINT `pedidos-pedido_productos`
    FOREIGN KEY (pedido_id) REFERENCES pedidos (id) ON DELETE RESTRICT ON UPDATE NO ACTION
);

CREATE TABLE IF NOT EXISTS pedido_direccion (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  pedido_id INT NULL,
  calle VARCHAR(45) NULL,
  ciudad VARCHAR(45) NULL,
  provincia VARCHAR(45) NULL,
  codigo_postal VARCHAR(15) NULL,
  pais_codigo VARCHAR(2) NULL,
  pais_nombre VARCHAR(45) NULL,

  INDEX `pedidos-pedido_direccion_idx` (pedido_id) VISIBLE,
  CONSTRAINT `pedidos-pedido_direccion`
    FOREIGN KEY (pedido_id) REFERENCES pedidos (id) ON DELETE RESTRICT ON UPDATE NO ACTION
);

CREATE TABLE IF NOT EXISTS pedido_cliente (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
  pedido_id INT NULL,
  nombre VARCHAR(45) NULL,
  apellido VARCHAR(45) NULL,
  email VARCHAR(45) NULL,
  telefono VARCHAR(45) NULL,

  INDEX `pedidos-pedido_cliente_idx` (pedido_id) VISIBLE,
  CONSTRAINT `pedidos-pedido_cliente`
    FOREIGN KEY (pedido_id) REFERENCES pedidos (id) ON DELETE RESTRICT ON UPDATE NO ACTION   
);
