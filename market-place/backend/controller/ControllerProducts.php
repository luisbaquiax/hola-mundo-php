<?php
//require_once "C:\Users\Usuario\Desktop\Teoria de sistemas 1\hola-mundo-php\market-place\backend\coneccion\Coneccion.php";
require_once __DIR__ . '/../coneccion/Coneccion.php';
//require_once "C:\Users\Usuario\Desktop\Teoria de sistemas 1\hola-mundo-php\market-place\backend\objects\Producto.php";
require_once __DIR__ . '/../objects/Producto.php';

class ControllerProducts
{
    const GET_PRODUCTS_BY_USER = "SELECT * FROM productos WHERE usuario = ?";
    const GET_PRODUCTS_BY_USER_MEJORADO = "
         select p.id, p.nombre, p.descripcion, p.precio, p.unidades, c.nombre as id_categoria, p.usuario, p.ruta_imagen
         from productos p
         inner join categorias c on p.id_categoria = c.id
         where p.usuario = ? order by id asc
         ";
    const GET_PRODUCTS = "SELECT * FROM productos WHERE usuario != ?";
    const GET_PRODUCTS_NOMBRE = '
    select p.id, p.nombre, p.descripcion, p.precio, p.unidades, c.nombre as id_categoria, p.usuario, p.ruta_imagen
         from productos p
         inner join categorias c on p.id_categoria = c.id
         where p.usuario != ? order by id asc
         ';
    private $connection;
    private $conn;

    public function __construct()
    {
        $this->connection = new Coneccion();
        $this->conn = $this->connection->getconexion();
    }

    public function getProductoByID($id)
    {
        $sql = "SELECT * FROM productos WHERE id = ? LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            return new Producto(
                $row['id'],
                $row['nombre'],
                $row['descripcion'],
                $row['precio'],
                $row['unidades'],
                $row['id_categoria'],
                $row['usuario'],
                $row['ruta_imagen']
            );
        } else {
            return null;
        }
    }

    public function getProductosByUser($user, $sentencia)
    {
        $list = array();

        $sql = $sentencia;
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $user);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $aux = new Producto(
                    $row['id'],
                    $row['nombre'],
                    $row['descripcion'],
                    (float)$row['precio'],
                    $row['unidades'],
                    $row['id_categoria'],
                    $row['usuario'],
                    $row['ruta_imagen']
                );
                $list[] = $aux;
            }
        }
        return $list;
    }

    public function insertProducto(Producto $producto)
    {
        $sql = "INSERT INTO productos (nombre, descripcion, precio, unidades, id_categoria, usuario, ruta_imagen) 
                VALUES (?,?,?,?,?,?,?)";
        $stmt = $this->conn->prepare($sql);

        if ($stmt) {
            $nombre = $producto->getNombre();
            $descripcion = $producto->getDescripcion();
            $precio = $producto->getPrecio();
            $unidades = $producto->getUnidades();
            $categoria = $producto->getCategoria();
            $usuario = $producto->getUsuario();
            $ruta = $producto->getRuta();
            $stmt->bind_param("ssdiiss",
                $nombre,
                $descripcion,
                $precio,
                $unidades,
                $categoria,
                $usuario,
                $ruta
            );
            $success = $stmt->execute();
            $stmt->close();

            if ($success) {
                $message = "Se registró correctamente el producto.";
                echo "<script type='text/javascript'>alert('$message');</script>";
                echo "<script type='text/javascript'>window.location.href='../../frontend/vista/cliente/ProductosPublicados.php';</script>";
                //header("Location: ../../index.php");
                exit();
            } else {
                throw new Exception("Error al insertar el usuario: " . $this->conn->error);
            }
        } else {
            throw new Exception("Error preparando la consulta: " . $this->conn->error);
        }
    }

    /**
     * @throws Exception
     */
    public function updateProducto(Producto $producto)
    {
        $sql = "UPDATE productos SET nombre = ?, descripcion = ?, precio = ?, unidades = ?, ruta_imagen = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        if ($stmt === false) {
            throw new Exception("Error preparando la consulta: " . $this->conn->error);
        }
        $id = $producto->getId();
        $nombre = $producto->getNombre();
        $descripcion = $producto->getDescripcion();
        $precio = $producto->getPrecio();
        $unidades = $producto->getUnidades();
        $usuario = $producto->getUsuario();
        $ruta = $producto->getRuta();
        $stmt->bind_param("ssdisi",
            $nombre,
            $descripcion,
            $precio,
            $unidades,
            $ruta,
            $id
        );
        $succes = $stmt->execute();
        $stmt->close();

        if ($succes) {
            echo "<script type='text/javascript'>alert('Producto actualizado correctamente.');</script>";
            echo "<script type='text/javascript'>window.location.href='../../frontend/vista/cliente/ProductosPublicados.php';</script>";
            exit();
        } else {
            echo "<script type='text/javascript'>alert('No se pudo actualizar el producto, lo sentimos.');</script>";
            throw new Exception("No se pudo actualizar el producto: " . $stmt->error);
        }
    }

}