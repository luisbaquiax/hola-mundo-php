<?php
require_once "ControllerUsers.php";
require_once "../objects/Usuario.php";
require_once "../objects/Producto.php";
require_once "ControllerProducts.php";

$controler = new ControllerUsers();
$controllerProducto = new ControllerProducts();

$method = $_SERVER['REQUEST_METHOD'];
switch ($method) {
case 'POST':
    $accion = $_GET['accion'];
    switch ($accion) {
        case 'iniciarSesion':
            $username = $_POST['username'];
            $password = $_POST['password'];

            $user = $controler->getUserByUsername($username, $password, 'ACTIVO');
            if($user != null){
                session_start();
                $_SESSION['user'] = serialize($user);
                header('Location: ../../frontend/vista/cliente/ProductosPublicados.php');
            }else{

                header('Location: ../../frontend/vista/Login.php');
            }
            break;
        case 'registrarProducto':
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
            $precio = $_POST['precio'];
            $unidades = $_POST['unidades'];
            $categoria = $_POST['categoria'];
            $ruta = $_POST['ruta'];
            $usuario = $_POST['usuario'];

            $producto = new Producto(0, $nombre, $descripcion, $precio, $unidades, $categoria, $usuario, $ruta);
            try {
                $controllerProducto->insertProducto($producto);
            } catch (Exception $e) {
                echo "<script type='text/javascript'>console.log('$e');</script>";
                echo "<script type='text/javascript'>alert('$e');</script>";
            }
            break;
    }


break;
case 'GET':
    $accion = $_GET['accion'];
    switch ($accion) {
        case 'salir';
            header('Location: ../../index.php');
            session_start();
            unset($_SESSION['user']);
        break;
    }
    echo 'hola GET';
    break;
}