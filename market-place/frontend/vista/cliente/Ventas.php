<?php
require_once __DIR__ . "/../../../backend/controller/ControllerVenta.php";
require_once __DIR__ . "/../../../backend/objects/Producto.php";
require_once __DIR__ . "/../../../backend/objects/Venta.php";
require_once __DIR__ . "/../../../backend/objects/Usuario.php";

session_start();
$controllerVenta = new ControllerVenta();
$user = isset($_SESSION['user']) ? unserialize($_SESSION['user']) : new Usuario("", "", "", "", "", "", "", "");
if ($user && is_object($user)) {
    $username = $user->getUsername();
    $list = $controllerVenta->getMisVentas($username);
}
if ($user->getUsername() == '') {
    header('Location: ../../index.php');
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Producto</title>
    <link rel="stylesheet" href="../../assets/css/formulario.css">

    <link rel="stylesheet" href="../../assets/css/navbar.css">
    <link rel="stylesheet" href="../../assets/css/styles.css">
</head>
<body>
<?php
include "Menu.php";
?>
<section>
    <div class="container-component">
        <h1> Mis ventas</h1>
        <table id="tables">
            <tr>
                <th>#</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th>Ver detalle</th>
            </tr>
            <?php $contador = 1;
            foreach ($list as $index => $venta): ?>
                <tr>
                    <td><?= $contador ?></td>
                    <td><?= $venta->getFecha() ?></td>
                    <td><?= $venta->getEstado(); ?></td>
                    <td>
                        <button class="show-btn" data-index="<?= $index ?>">Ver detalle</button>
                        <div class="table-container" id="tableContainer<?= $index ?>" style="display: none;">
                            <table id="tables">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Categoria</th>
                                    <th>Precio</th>
                                    <th>Unidades</th>
                                    <th>Subtotal</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php  $detalle = $controllerVenta->getDetalleVenta($venta->getId());  ?>
                                <?php $numeral = 1; $total = 0; foreach ($detalle as $index1 => $producto): ?>
                                    <tr>
                                        <td><?= $numeral; ?></td>
                                        <td><?= $producto->getNombre(); ?></td>
                                        <td><?= $producto->getCategoria(); ?></td>
                                        <td><?= $producto->getPrecio(); ?></td>
                                        <td><?= $producto->getUnidades(); ?></td>
                                        <td><?= 'Q.'.$producto->getUsuario(); ?></td>
                                    </tr>

                                    <?php $numeral++; $total += $producto->getUsuario(); endforeach; ?>

                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>TOTAL</td>
                                    <td><?= 'Q.'.$total; ?></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </td>
                </tr>
                <?php $contador++; endforeach; ?>
        </table>
    </div>
</section>

<script src="../../assets/js/showtable.js"></script>

</body>
</html>


