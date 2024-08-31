/**
selecciona productos por usuario y diferente a los productos de usuario
*/

SELECT p.id, p.nombre, p.descripcion, p.precio, p.unidades, c.nombre as categoria, p.usuario, p.ruta_imagen
FROM productos p
INNER JOIN categorias c ON p.id_categoria = c.id
WHERE p.usuario = ?;

SELECT p.id, p.nombre, p.descripcion, p.precio, p.unidades, c.nombre as categoria, p.usuario, p.ruta_imagen
FROM productos p
INNER JOIN categorias c ON p.id_categoria = c.id
WHERE p.usuario = ?;


/**

*/
