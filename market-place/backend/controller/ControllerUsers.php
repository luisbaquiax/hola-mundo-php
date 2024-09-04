<?php
require_once "../coneccion/Coneccion.php";
require_once "../objects/Usuario.php";
class ControllerUsers{

    const INSERT = 'INSERT INTO usuarios (
                      username, 
                      password,
                      tipo, 
                      estado, 
                      telefono,
                      name,
                      lastname,
                      email) 
                VALUES (?,?,?,?,?,?,?,?)';
    private $conn;
    private $coneccion;
    public function __construct(){
        $this->coneccion = new Coneccion();
        $this->conn = $this->coneccion->getconexion();
    }

    public function insert(Usuario $usuario)
    {
        $stmt = $this->conn->prepare(self::INSERT);

        if ($stmt) {
           $username = $usuario->getUsername();
           $password = $usuario->getPassword();
           $tipo = $usuario->getTipo();
           $estado = $usuario->getEstado();
           $telefono = $usuario->getTelefono();
           $name = $usuario->getName();
           $lastname = $usuario->getLastname();
           $email = $usuario->getEmail();
            $stmt->bind_param("ssssssss",
                $username, $password, $tipo, $estado, $telefono, $name, $lastname, $email
            );
            $success = $stmt->execute();
            $stmt->close();

            if ($success) {
                $message = "Se registró correctamente el producto.";
                echo "<script type='text/javascript'>alert('$message');</script>";
                echo "<script type='text/javascript'>window.location.href='../../frontend/vista/Login.php';</script>";
                //header("Location: ../../index.php");
                exit();
            } else {
                throw new Exception("Error al insertar el usuario: " . $this->conn->error);
            }
        } else {
            throw new Exception("Error preparando la consulta: " . $this->conn->error);
        }
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