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
            <h1> cliente</h1>
            <form method="POST" action="../../api/model/ControllerPeticionCliente.php">
                <input type="hidden" name="id" value="" />

                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" value="" name="nombre" required>

                <label for="apellido">Apellido:</label>
                <input type="text" id="apellido" value="" name="apellido" required>

                <label for="correo">Correo:</label>
                <input type="email" id="correo" value="" name="correo" required>

                <label for="telefono">Telefono:</label>
                <input type="tel" id="telefono" value="" name="telefono" required minlength="8" maxlength="8">

                <label for="saldo">Saldo:</label>
                <input type="number" id="saldo" value="" name="saldo" required>

                <button type="submit" class="btn-green" style="margin-bottom: 10px">Guardar cambios</button>
                <div style="text-align: center">
                    <a class="btn btn-warning" href="../../index.php">Regresar</a>
                </div>
            </form>
        </div>
    </section>

</body>
</html>


