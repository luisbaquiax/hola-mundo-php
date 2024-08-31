<?php
require_once "ControllerUsers.php";
require_once "../objects/Usuario.php";

$controler = new ControllerUsers();

$method = $_SERVER['REQUEST_METHOD'];
switch ($method) {
case 'POST':

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