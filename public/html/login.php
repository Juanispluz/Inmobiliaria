<?php
include ('../../php/global/controller/login.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="../styles/styles.css">
</head>
<body>
    <div>
        <a href="index.php">Inicio</a>
    </div>
    <h2>Login</h2>
    <?php if (!empty($error_message)): ?>
        <div class="error"><?= $error_message ?></div>
    <?php endif; ?>
    <form action="login.php" method="post">
        <div>
            <label for="correo">Correo:</label>
            <input type="email" id="correo" name="correo" required>
        </div>
        <div>
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>
            <button type="button" onclick="togglePasswordVisibility('password')">Mostrar Contraseña</button>
        </div>
        <div>
            <button type="submit">Iniciar sesión</button>
        </div>
    </form>
    <div>
        <a href="register.php">¿No estás registrado?</a>
    </div>
    <script src="../js/main.js"></script>
</body>
</html>
