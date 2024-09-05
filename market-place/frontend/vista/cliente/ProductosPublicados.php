<?php
require_once "../../../backend/controller/ControllerProducts.php";
require_once "../../../backend/objects/Producto.php";
require_once "../../../backend/objects/Usuario.php";

session_start();

$controllerProducto = new ControllerProducts();
$user = isset($_SESSION['user']) ? unserialize($_SESSION['user']) : new Usuario("", "", "", "", "", "", "", "");
if ($user && is_object($user)) {
    $username = $user->getUsername();
    $list = $controllerProducto->getProductosByUser($username, ControllerProducts::GET_PRODUCTS_BY_USER_MEJORADO);
    //unset($_SESSION['user']);
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
    <title>Productos</title>
    <link rel="stylesheet" href="../../assets/css/formulario.css">

    <link rel="stylesheet" href="../../assets/css/navbar.css">
    <link rel="stylesheet" href="../../assets/css/styles.css">
    <link rel="stylesheet" href="../../assets/css/table.css">
</head>
<body>
<?php
include "Menu.php";
?>
<section>
    <div class="container-component">
        <h1> Productos publicados</h1>
        <table id="tables">
            <tr>
                <th>CODIGO</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Unidades</th>
                <th>Categoría</th>
                <th>Imagen</th>
                <th>Acciones</th>
            </tr>
            <?php foreach ($list as $producto): ?>
                <tr>
                    <td><?= $producto->getId() ?></td>
                    <td><?= $producto->getNombre() ?></td>
                    <td><?= $producto->getDescripcion() ?></td>
                    <td>Q.<?= $producto->getPrecio() ?></td>
                    <td><?= $producto->getUnidades() ?></td>
                    <td><?= $producto->getCategoria() ?></td>
                    <td>
                        <img src="<?= $producto->getRuta() ?>" alt="Girl in a jacket" width="100px" height="100px">
                    </td>
                    <td>
                        <a href="../../../backend/controller/PeticionUsers.php?accion=actualizarProducto&&id=<?= $producto->getId() ?>"
                           class="btn btn-primary">Editar
                        </a>
                        <a href="../../../backend/controller/PeticionUsers.php?accion=eliminarProducto&&id=<?= $producto->getId() ?>"
                           class="btn btn-red"
                           style="margin-left: 5px" >Eliminar
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</section>

</body>
</html>


