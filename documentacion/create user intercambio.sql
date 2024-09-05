/*creacion de usuario para la base de datos*/
CREATE USER 'admin'@'localhost' IDENTIFIED BY 'intercambios';
GRANT ALL PRIVILEGES ON intercambio.* TO 'admin'@'localhost' WITH GRANT OPTION;
FLUSH PRIVILEGES;