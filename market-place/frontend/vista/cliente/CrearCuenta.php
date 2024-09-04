<?php
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva cuenta</title>
    <link rel="stylesheet" href="../../assets/css/styles.css">
    <link rel="stylesheet" href="../../assets/css/navbar.css">
    <link rel="stylesheet" href="../../assets/css/formulario.css">
</head>
<body>
<nav class="navbar">
    <div class="container-navbar text-center">
        <a href="../../../index.php" class="brand">Intercambios S.A.</a>
    </div>
</nav>
    <div class="login-container centrado" style="border-radius: 30px;">
        <form action="../../../backend/controller/PeticionUsers.php?accion=crearCuenta" method="POST">
            <h2 class="text-center">Crear Cuenta</h2>
            <div class="input-group">
                <label for="nombre" class="login-label">Nombres:</label>
                <input type="text" id="nombre" class="login-input" name="nombre" required maxlength="45">
            </div>
            <div class="input-group">
                <label for="apellido" class="login-label">Apellidos:</label>
                <input type="text" class="login-input" id="apellido" name="apellido" required maxlength="45">
            </div>
            <div class="input-group">
                <label for="username" class="login-label">Nombre de usuario:</label>
                <input type="text" class="login-input" id="username" name="username" required maxlength="45">
            </div>
            <div class="input-group">
                <label for="telefono" class="login-label">Teléfono:</label>
                <input type="text" class="login-input" id="telefono" name="telefono" required maxlength="8" minlength="8">
            </div>
            <div class="input-group">
                <label for="email" class="login-label">Correo electrónico:</label>
                <input type="email" class="login-input" id="email" name="email" required maxlength="45">
            </div>
            <div class="input-group">
                <label for="password" class="login-label">Contraseña:</label>
                <input type="password" class="login-input" id="password" name="password" required maxlength="100">
            </div>
            <div class="input-group">
                <label for="password1" class="login-label">Repetir contraseña:</label>
                <input type="password" class="login-input" id="password1" name="password1" required maxlength="100">
            </div>
            <button type="submit">Registrarse</button>
        </form>
        <br>
        <div class="text-center">
            <a class="btn btn-warning" href="../../../index.php">Cancelar</a>
        </div>
    </div>
</body>
</html>
