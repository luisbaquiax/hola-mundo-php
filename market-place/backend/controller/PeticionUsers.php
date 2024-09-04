<?php
require_once "ControllerUsers.php";
require_once "../objects/Usuario.php";
require_once "../objects/Producto.php";
require_once "../objects/DetalleVenta.php";
require_once "ControllerProducts.php";
require_once  "ControllerVenta.php";

$controler = new ControllerUsers();
$controllerProducto = new ControllerProducts();
$controllerUsers = new ControllerUsers();

$method = $_SERVER['REQUEST_METHOD'];
switch ($method) {
    case 'POST':
        $accion = $_GET['accion'];
        switch ($accion) {
            case 'iniciarSesion':
                $username = $_POST['username'];
                $password = $_POST['password'];

                $user = $controler->getUserByUsername($username, $password, 'ACTIVO');
                if ($user != null) {
                    session_start();
                    $_SESSION['user'] = serialize($user);
                    header('Location: ../../frontend/vista/cliente/ProductosPublicados.php');
                } else {

                    header('Location: ../../frontend/vista/Login.php');
                }
                break;
            case 'registrarProducto':
                session_start();
                unset($_SESSION['producto']);

                $id = $_POST['id_producto'];
                $nombre = $_POST['nombre'];
                $descripcion = $_POST['descripcion'];
                $precio = $_POST['precio'];
                $unidades = $_POST['unidades'];
                $categoria = $_POST['categoria'];
                $ruta = $_POST['ruta'];
                $usuario = $_POST['usuario'];

                $producto = new Producto($id, $nombre, $descripcion, $precio, $unidades, $categoria, $usuario, $ruta);
                try {
                    if ($producto->getId() == 0) {
                        $controllerProducto->insertProducto($producto);
                    } else {
                        $controllerProducto->updateProducto($producto);
                    }
                } catch (Exception $e) {
                    echo "<script type='text/javascript'>console.log('$e');</script>";
                    echo "<script type='text/javascript'>alert('Error en el servidor: $e');</script>";
                }
                break;
            case 'procesoCompra':
                $controlVentas = new ControllerVenta();
                $idProducto = $_POST['id_producto'];
                $usuario = $_POST['usuario'];

                $nombre = $_POST['nombre'];
                $cantidad = $_POST['cantidad'];
                $fecha = date('Y-m-d');

                if($nombre){
                    $producto = $controllerProducto->getProductoById($idProducto);
                    if($producto->getUnidades() < $cantidad){

                    }else{
                        $venta = new Venta(0, $fecha, 1, $usuario,$producto->getUsuario() ,'ENTREGADO');
                        try {
                            $ultimoVenta = $controlVentas->insert($venta);
                            $detalleVenta = new DetalleVenta(0, $ultimoVenta, $idProducto, $cantidad, $producto->getPrecio() * $cantidad);
                            $controlVentas->inserDetalle($detalleVenta);
                            //actualizar producto
                            $producto->setUnidades($producto->getUnidades() - $cantidad);
                            $controllerProducto->updateProducto($producto);
                            //enviar mensaje
                            $message = "Se realizó correctamente la compra.";
                            echo "<script type='text/javascript'>alert('$message');</script>";
                            echo "<script type='text/javascript'>window.location.href='../../frontend/vista/cliente/Tienda.php';</script>";
                        } catch (Exception $e) {
                            echo "<script type='text/javascript'>alert('No se pudo realizar la compra.');</script>";
                            echo "<script type='text/javascript'>window.location.href='../../frontend/vista/cliente/Tienda.php';</script>";
                        }
                    }
                }else{
                    echo "<script type='text/javascript'>alert('No hay datos en el formulario.');</script>";
                    echo "<script type='text/javascript'>window.location.href='../../frontend/vista/cliente/Tienda.php';</script>";
                }
                break;
            case 'crearCuenta':
                $nombre = $_POST['nombre'];
                $apellido = $_POST['apellido'];
                $username = $_POST['username'];
                $email = $_POST['email'];
                $telefono = $_POST['telefono'];
                $password = $_POST['password'];
                $password1 = $_POST['password1'];
                if($password == $password1){
                    $user = new Usuario($username, $password, 'CLIENTE', 'ACTIVO', $telefono, $nombre, $apellido, $email);
                    try {
                        $controllerUsers->insert($user);
                    } catch (Exception $e) {
                        echo "<script type='text/javascript'>alert('No se pudo realizar el registro, lo sentimos!!!');</script>";
                        echo "<script type='text/javascript'>window.location.href='../../../index.php';</script>";
                    }
                }else{
                    echo "<script type='text/javascript'>alert('Las contraseñas deben ser iguales.');</script>";
                    echo "<script type='text/javascript'>window.location.href='../../../frontend/vista/cliente/CrearCuenta.php';</script>";
                }
                break;
        }
        break;
    case 'GET':
        $accion = $_GET['accion'];
        switch ($accion) {
            case 'salir':
                header('Location: ../../index.php');
                session_start();
                unset($_SESSION['user']);
                break;
            case 'actualizarProducto':
                $idProducto = $_GET['id'];
                $actualizar = $controllerProducto->getProductoById($idProducto);
                session_start();
                $_SESSION['producto'] = serialize($actualizar);
                header('Location: ../../frontend/vista/cliente/RegisterProducts.php');
                break;
            case 'comprar';
                $idProducto = $_GET['id'];
                $actualizar = $controllerProducto->getProductoById($idProducto);
                session_start();
                $_SESSION['vendiendo'] = serialize($actualizar);
                header('Location: ../../frontend/vista/cliente/Compra.php');
                break;
        }
        break;
}