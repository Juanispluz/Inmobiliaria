<?php
include ('../../php/global/controller/perfil.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Perfil del Usuario</title>
    <link rel="stylesheet" href="style/perfil.css">
</head>
<body>
<div>
    <a href="index.php">Inicio</a>
</div>
<h2>Perfil del Usuario</h2>
<?php if (!empty($message)): ?>
    <p class="message"><?= $message ?></p>
<?php else: ?>
    <img src="<?= $image_user ?>" alt="Imagen de la Propiedad" style="max-width: 300px; max-height: 300px;">
    <div class="perfil">
        <p><strong>Nombre:</strong> <?= $user['nombre'] ?></p>
        <p><strong>apellido:</strong> <?= $user['apellido'] ?></p>
        <p><strong>Email:</strong> <?= $user['correo'] ?></p>
        <p><strong>Teléfono:</strong> <?= $user['telefono'] ?></p>
    </div>
    <div class="delete-button">
        <button onclick="confirmarEliminacion()" class="delete-button">Eliminar Cuenta</button>
    </div>
<?php endif; ?>
<script src="../js/scripts/perfil.js"></script>
</body>
</html>
