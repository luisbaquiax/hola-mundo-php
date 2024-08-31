<?php
require_once "../../../backend/controller/Products.php";
require_once "../../../backend/objects/Producto.php";
require_once "../../../backend/objects/Usuario.php";

session_start();

$controllerProducto = new Products();
$user = isset($_SESSION['user']) ? unserialize($_SESSION['user']) : new Usuario("","","","","","","","");
    if ($user && is_object($user)) {
        $username = $user->getUsername();
        $list = $controllerProducto->getProductosByUser($username);
        //unset($_SESSION['user']);
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
            <h1> productos publicados</h1>
            <table id="customers">
                <tr>
                    <th>CODIGO</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Unidades</th>
                    <th>Categoría</th>
                    <th>Imagen</th>
                </tr>
                <?php foreach ($list as $producto): ?>
                    <tr>
                        <td><?= $producto->getId() ?></td>
                        <td><?= $producto->getNombre() ?></td>
                        <td><?= $producto->getDescripcion() ?></td>
                        <td><?= $producto->getPrecio() ?></td>
                        <td><?= $producto->getUnidades() ?></td>
                        <td><?= $producto->getCategoria() ?></td>
                        <td>
                            <img src="<?= $producto->getRuta() ?>" alt="Girl in a jacket" width="100px" height="100px">
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </section>

</body>
</html>


