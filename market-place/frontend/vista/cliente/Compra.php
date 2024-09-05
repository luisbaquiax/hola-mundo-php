<?php
require_once "../../../backend/controller/ControllerProducts.php";
require_once __DIR__ .'/../../../backend/objects/Producto.php';
require_once "../../../backend/objects/Usuario.php";

session_start();
$controllerProducto = new ControllerProducts();

$producto = isset($_SESSION['vendiendo']) ? unserialize($_SESSION['vendiendo']) : $producto = new Producto(0,'','','','','','','');
if ($producto && is_object($producto)) {
    unset($_SESSION['vendiendo']);
}

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
    <title>Intercambios S.A.</title>
    <link rel="stylesheet" href="../../assets/css/formulario.css">
    <link rel="stylesheet" href="../../assets/css/navbar.css">
    <link rel="stylesheet" href="../../assets/css/styles.css">
    <link rel="stylesheet" href="../../assets/css/card.css">
</head>
<body>
<?php
include "Menu.php";
?>
<section>
    <div class="card">
        <div class="card-header">
            <h1 class="text-center">Comprar de producto</h1>
        </div>
       <div class="card-body">
           <form action="../../../backend/controller/PeticionUsers.php?accion=procesoCompra" method="POST">
               <button type="submit" class="btn-green-dark"><strong> Finalizar compra </strong></button>
               <div class="input-group">
                   <input type="hidden" name="id_producto" value="<?= $producto->getId(); ?>" />
                   <input type="hidden" name="usuario" value="<?= $user->getUsername(); ?>" />

                   <label for="nombre" class="login-label">Nombre del producto:</label>
                   <input type="text" id="nombre" class="login-input" name="nombre" value="<?= $producto->getNombre(); ?>" readonly>
               </div>
               <input type="hidden" id="precioProducto" name="precioProducto" value="<?= $producto->getPrecio()?>" />
               <div class="input-group">
                   <label for="cantidad" class="login-label">Cantidad:</label>
                   <input type="number" class="login-input" id="cantidad" name="cantidad" value="1" required min="1" max="<?= $producto->getUnidades(); ?>">
               </div>
           </form>
           <h4>
               Detalle: <?= $producto->getDescripcion() ?>,
               Precio: <?= 'Q.'.$producto->getPrecio() ?>,
               Unidades: <?= $producto->getUnidades() ?>,
               Categoría: <?= $producto->getCategoria() ?>
               <hr>
               Cantidad a pagar: <span id="totalPagar"><?= 'Q.'.$producto->getPrecio() ?></span>
           </h4>
       </div>
    </div>
</section>
<script src="../../assets/js/updateTotalPago.js"></script>
</body>
</html>
