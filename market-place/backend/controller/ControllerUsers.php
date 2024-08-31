<?php
require_once "../coneccion/Coneccion.php";
require_once "../objects/Usuario.php";
class ControllerUsers{
    private $conn;
    private $coneccion;
    public function __construct(){
        $this->coneccion = new Coneccion();
        $this->conn = $this->coneccion->getconexion();
    }

    public function getUserByUsername($username, $password, $estado)
    {
        $sql = "SELECT * FROM usuarios WHERE username = ? AND password = ? AND estado = ? LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sss", $username, $password, $estado);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            return new Usuario(
                $row['username'],
                $row['password'],
                $row['tipo'],
                $row['estado'],
                $row['telefono'],
                $row['name'],
                $row['lastname'],
                $row['email']
            );
        } else {
            return null;
        }
    }
}