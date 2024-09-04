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
detalle de venta
*/
SELECT p.id, p.nombre, p.descripcion, p.precio, p.unidades, c.nombre as categoria, d.subtotal , p.ruta_imagen
FROM productos p
INNER JOIN categorias c ON p.id_categoria = c.id
INNER JOIN detalle_venta d ON p.id = d.id_producto
INNER JOIN ventas v ON v.id = d.id_venta
WHERE v.usuario_vendedor = 'cliente1';
