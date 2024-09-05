-- tipo de pago
INSERT INTO tipo_pago (nombre)
VALUES
('Efectivo'),
('Transacción');

-- usuarios

-- Insertar 1 usuario ADMIN
INSERT INTO usuarios (username, password, tipo, estado, telefono, name, lastname, email)
VALUES ('admin', 'luis', 'ADMIN', 'ACTIVO', '12345678', 'Admin', 'User', 'admin@example.com');

-- Insertar 4 usuarios MODERADOR
INSERT INTO usuarios (username, password, tipo, estado, telefono, name, lastname, email)
VALUES
('moderador1', 'mod_password1', 'MODERADOR', 'ACTIVO', '12345671', 'Mod1', 'User1', 'mod1@example.com'),
('moderador2', 'mod_password2', 'MODERADOR', 'ACTIVO', '12345672', 'Mod2', 'User2', 'mod2@example.com'),
('moderador3', 'mod_password3', 'MODERADOR', 'ACTIVO', '12345673', 'Mod3', 'User3', 'mod3@example.com'),
('moderador4', 'mod_password4', 'MODERADOR', 'ACTIVO', '12345674', 'Mod4', 'User4', 'mod4@example.com');

-- Insertar 3 usuarios CLIENTE
INSERT INTO usuarios (username, password, tipo, estado, telefono, name, lastname, email)
VALUES
('client1', 'client1', 'CLIENTE', 'ACTIVO', '12345675', 'Client1', 'User1', 'client1@example.com'),
('client2', 'client2', 'CLIENTE', 'ACTIVO', '12345676', 'Client2', 'User2', 'client2@example.com'),
('client3', 'client3', 'CLIENTE', 'ACTIVO', '12345677', 'Client3', 'User3', 'client3@example.com');

-- categorias
INSERT INTO categorias (nombre)
VALUES
('Electrónica'),
('Hogar'),
('Calzado'),
('Juguetes'),
('Deportes'),
('Belleza'),
('Jardinería'),
('Automotriz'),
('Alimentos'),
('Bebidas'),
('Tecnología'),
('Salud'),
('Muebles');
