<?php
class Coneccion{
    private $servername = "localhost";
    private $username = "root";
    private $password = "@luis.baquiax95";
    private $dbname = "intercambio";

    private $conn;
    public function __construct(){
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        if($this->conn->connect_error){
            die("Connection failed:luisbaquiax1234 " . $this->conn->connect_error);
        }
    }
    public function getconexion(){
        return $this->conn;
    }

}
