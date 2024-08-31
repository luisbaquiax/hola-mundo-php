<?php
require_once __DIR__ . '/../coneccion/Coneccion.php';
require_once __DIR__ . '/../objects/Categoria.php';
class ControllerCategoria
{
    private $connection;
    private $conn;

    public function __construct(){
        $this->connection = new Coneccion();
        $this->conn = $this->connection->getconexion();
    }

    public function getCategorias(){
        $list = array();

        $sql = "SELECT * FROM categorias";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $aux = new Categoria(
                    $row['id'],
                    $row['nombre']
                );
                $list[] = $aux;
            }
        }
        return $list;
    }
}