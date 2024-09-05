<?php

require_once "../../../backend/controller/ControllerProducts.php";
require_once "../../../backend/objects/Producto.php";
require_once "../../../backend/objects/Usuario.php";

session_start();

$controllerProducto = new ControllerProducts();
$user = isset($_SESSION['user']) ? unserialize($_SESSION['user']) : new Usuario("", "", "", "", "", "", "", "");
if ($user && is_object($user)) {
    $username = $user->getUsername();
    $list = $controllerProducto->getProductosByUser($username, ControllerProducts::GET_PRODUCTS_NOMBRE);
    //unset($_SESSION['user']);
}
if ($user->getUsername() == '') {
    header('Location: ../../index.php');
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tienda</title>

    <link rel="stylesheet" href="../../assets/css/formulario.css">

    <link rel="stylesheet" href="../../assets/css/navbar.css">
    <link rel="stylesheet" href="../../assets/css/styles.css">
    <link rel="stylesheet" href="../../assets/css/card.css">
</head>
<body>
    <?php include ("Menu.php");?>
    <section>
        <h1>TIENDA DE PRODUCTOS</h1>
        <div class="container-component">

                <?php foreach ($list as $producto): ?>

                <div class="card width-300 inline-block">
                    <div class="card-header">
                        <h3 class="text-center"> <strong> <?= $producto->getNombre() ?> </strong> </h3>
                    </div>
                    <div class="card-body text-center">
                        <a style="text-decoration: none" href="<?= $producto->getRuta() ?>" target="_blank">
                        <img src="<?= $producto->getRuta() ?>"
                             style="text-align: center"
                             alt="producto"
                             width="100px"
                             height="100px">
                        <h4>Descripción del producto:</h4>
                        <h5>
                            Detalle: <?= $producto->getDescripcion() ?>,
                            Precio: <?= $producto->getPrecio() ?>,
                            Unidades: <?= $producto->getUnidades() ?>,
                            Categoría: <?= $producto->getCategoria() ?>
                        </h5>
                    </div>
                    <div class="card-footer" style="text-align: center">
                        <a href="../../../backend/controller/PeticionUsers.php?accion=comprar&&id=<?= $producto->getId() ?>"
                           class="btn btn-green">Comprar
                        </a>
                    </div>
                </div>

                <?php endforeach; ?>
        </div>
    </section>
</body>
</html>
