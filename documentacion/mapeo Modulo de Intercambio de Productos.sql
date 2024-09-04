DROP DATABASE IF EXISTS intercambio;
CREATE DATABASE intercambio;
USE intercambio;

CREATE TABLE usuarios(
    username VARCHAR(45) NOT NULL PRIMARY KEY,
    password VARCHAR(100) NOT NULL,
    tipo VARCHAR(10) NOT NULL,
    estado VARCHAR(10) NOT NULL,
    telefono VARCHAR(8) NOT NULL,
    name VARCHAR(45) NOT NULL,
    lastname VARCHAR(45) NOT NULL,
    email VARCHAR(45) NOT NULL
);

CREATE TABLE categorias(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(45) NOT NULL
);

CREATE TABLE tipo_pago(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(45) NOT NULL
);

CREATE TABLE productos(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(45) NOT NULL,
    descripcion VARCHAR(250) NOT NULL,
    precio DOUBLE NOT NULL,
    unidades INT NOT NULL,
    id_categoria INT NOT NULL,
    usuario VARCHAR(45) NOT NULL,
    ruta_imagen TEXT NOT NULL,
    FOREIGN KEY(id_categoria) REFERENCES categorias(id) ON UPDATE CASCADE,
    FOREIGN KEY(usuario) REFERENCES usuarios(username) ON UPDATE CASCADE
);

CREATE TABLE ventas(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    fecha DATE NOT NULL,
    id_pago INT NOT NULL,
    usuario_comprador VARCHAR(45) NOT NULL,
    usuario_vendedor VARCHAR(45) NOT NULL,
    estado VARCHAR(10) NOT NULL,
    FOREIGN KEY(id_pago) REFERENCES tipo_pago(id),
    FOREIGN KEY(usuario_comprador) REFERENCES usuarios(username) ON UPDATE CASCADE,
    FOREIGN KEY(usuario_vendedoR) REFERENCES usuarios(username) ON UPDATE CASCADE
);

CREATE TABLE detalle_venta(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    id_venta INT NOT NULL,
    id_producto INT NOT NULL,
    unidades INT NOT NULL,
    subtotal DOUBLE NOT NULL,
    FOREIGN KEY(id_venta) REFERENCES ventas(id),
    FOREIGN KEY(id_producto) REFERENCES productos(id)
);
