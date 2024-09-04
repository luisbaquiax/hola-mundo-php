<?php

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../../frontend/assets/css/formulario.css">
</head>
<body class="login-body">
<div class="login-container" style="border-radius: 30px;">
    <h1 class="text-center"><strong>Intercambios S.A.</strong></h1>
    <hr>
    <h2 class="text-center">Iniciar Sesión</h2>
    <form action="../../backend/controller/PeticionUsers.php?accion=iniciarSesion" method="POST">
        <div class="input-group">
            <label for="username" class="login-label">Nombre de usuario:</label>
            <input type="text" id="username" class="login-input" name="username" required maxlength="45">
        </div>
        <div class="input-group">
            <label for="password" class="login-label">Contraseña:</label>
            <input type="password" class="login-input" id="password" name="password" required maxlength="45">
        </div>
        <button type="submit">Iniciar Sesión</button>
    </form>
    <p>¿No tienes una cuenta? <a href="cliente/CrearCuenta.php">Crea una aquí</a></p>
</div>
</body>
</html>
