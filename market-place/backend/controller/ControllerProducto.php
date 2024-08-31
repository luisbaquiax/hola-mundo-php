<?php
require_once "../coneccion/Coneccion.php";
require_once "../objects/Producto.php";
class ControllerProducto{
    private $conn;
    private $coneccion;
    public function __construct(){
        $this->coneccion = new Coneccion();
        $this->conn = $this->coneccion->getconexion();
    }

    public function getProductosByUser($user){
        $list = array();

        $sql = "SELECT * FROM productos WHERE usuario = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // output data of each row
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
}
