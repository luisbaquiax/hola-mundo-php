<?php
/*session_start();
require_once "../../api/a/Cliente.php";

$edicion = 'Agregar';

$cliente = isset($_SESSION['cliente']) ? unserialize($_SESSION['cliente']) : new Cliente(0,'','','','',0);
    if ($cliente && is_object($cliente)) {
        $id = $cliente->getId();
        $nombre = $cliente->getNombre();
        $apellido = $cliente->getApellido();
        $email = $cliente->getEmail();
        $telefono = $cliente->getTelefono();
        $saldo = $cliente->getSaldo();
        $edicion = "Editar";
        unset($_SESSION['cliente']);
    }
*/

require_once __DIR__. "/../../../backend/controller/ControllerCategoria.php";
require_once __DIR__. "/../../../backend/objects/Categoria.php";

$controller = new ControllerCategoria();
$listCat = $controller->getCategorias();
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
        <div class="container">
            <h1> Registro de producto</h1>
            <form method="POST" action="../../../backend/controller/PeticionUsers.php">
                <input type="hidden" name="id" value="" />

                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" value="" name="nombre" required>

                <label for="descripcion">Descripción:</label>
                <input type="text" id="descripcion" value="" name="descripcion" required>

                <label for="precio">Precio:</label>
                <input type="number" id="precio" value="" name="precio" required min="0">

                <label for="unidades">Unidades:</label>
                <input type="number" id="unidades" value="" name="unidades" required min="0">

                <label for="categoria">Categoría:</label>
                <select id="categoria" name="categoria">
                    <?php foreach($listCat as $cat): ?>
                        <option value="<?= $cat->getId(); ?>"><?= $cat->getNombre(); ?></option>
                    <?php endforeach; ?>
                </select>

                <label for="ruta">Ruta imagen:</label>
                <input type="text" id="ruta" value="" name="ruta" required>

                <button type="submit" class="btn-green" style="margin-bottom: 10px">Guardar cambios</button>
                <div style="text-align: center">
                    <a class="btn btn-warning" href="ProductosPublicados.php">Regresar</a>
                </div>
            </form>
        </div>
    </section>

</body>
</html>


