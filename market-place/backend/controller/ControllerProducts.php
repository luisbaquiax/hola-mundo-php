<?php
//require_once "C:\Users\Usuario\Desktop\Teoria de sistemas 1\hola-mundo-php\market-place\backend\coneccion\Coneccion.php";
require_once __DIR__ . '/../coneccion/Coneccion.php';
//require_once "C:\Users\Usuario\Desktop\Teoria de sistemas 1\hola-mundo-php\market-place\backend\objects\Producto.php";
require_once __DIR__ . '/../objects/Producto.php';
class ControllerProducts{
    private $connection;
    private $conn;

    public function __construct(){
        $this->connection = new Coneccion();
        $this->conn = $this->connection->getconexion();
    }

    public function getProductosByUser($user){
        $list = array();

        $sql = "SELECT * FROM productos WHERE usuario = ?";
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
                $message = "Se registró correctamente el usuario.";
                echo "<script type='text/javascript'>alert('$message');</script>";
                //echo "<script type='text/javascript'>window.location.href='../../frontend/vista/cliente/ProductosPublicados.php';</script>";
                //header("Location: ../../index.php");
                exit();
            } else {
                throw new Exception("Error al insertar el usuario: " . $this->conn->error);
            }
        } else {
            throw new Exception("Error preparando la consulta: " . $this->conn->error);
        }
    }

}