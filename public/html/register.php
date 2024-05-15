<?php
include ('../../php/global/controller/register.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
    <link rel="stylesheet" href="../styles/styles.css">
</head>
<body>
    <div>
        <a href="index.php">Inicio</a>
    </div>
    <h2>Registro</h2>
    <?php if (!empty($message)): ?>
        <p class="error"><?= $message ?></p>
    <?php endif; ?>
    <form action="register.php" method="post">
        <div>
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>
        </div>
        <div>
            <label for="apellido">Apellido:</label>
            <input type="text" id="apellido" name="apellido" required>
        </div>
        <div>
            <label for="correo">Correo electrónico:</label>
            <input type="email" id="correo" name="correo" required>
        </div>
        <div>
            <label for="confirm_email">Confirmar Correo:</label>
            <input type="email" id="confirm_email" name="confirm_email" required>
        </div>
        <div>
            <label for="telefono">Teléfono:</label>
            <input type="text" id="telefono" name="telefono" required>
        </div>
        <div>
            <input type="checkbox" id="es_universitario" name="es_universitario" onchange="toggleUniversidad()">
            <label for="es_universitario">¿Eres universitario?</label>
        </div>
        <div id="select_universidad" style="display:none;">
            <label for="universidad">Universidad:</label>
            <select name="universidad" id="universidad">
                <?php foreach ($universidades as $universidad): ?>
                    <option value="<?= $universidad['id_universidad'] ?>"><?= $universidad['nombreU'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" class="password-input" required>
            <button type="button" onclick="togglePasswordVisibility('password')">Mostrar Contraseña</button>
        </div>
        <div>
            <label for="confirm_password">Confirmar Contraseña:</label>
            <input type="password" id="confirm_password" name="confirm_password" class="password-input" required>
            <button type="button" onclick="togglePasswordVisibility('confirm_password')">Mostrar Contraseña</button>
        </div>
        <div>
            <button type="submit">Registrarse</button>
        </div>
    </form>
    <div>
        <a href="login.php">¿Ya tienes una cuenta?</a>
    </div>
    <script src="../js/main.js"></script>
</body>
</html>
