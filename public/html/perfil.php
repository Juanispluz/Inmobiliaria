<?php
include ('../../php/global/controller/perfil.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Perfil de Usuario</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/perfil.css">
</head>
<body>
    <?php include('../../resources/views/header.php'); ?>
    <div class="container my-5">
        <div class="row">
            <div class="col-md-6">
                <div class="btn-group">
                    <button onclick="window.location='index.php'" class="btn btn-primary">Inicio</button>
                </div>
            </div>
            <div class="col-md-6 text-right">
                <button onclick="window.location='../../php/controller/logout.php'" class="btn btn-danger">Logout</button>
            </div>
        </div>
    </div>
    <h2>Perfil de Usuario</h2>
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
    <br>
    <br>
    <?php include('../../resources/views/footer.php'); ?>
    <script src="../js/scripts/perfil.js"></script>
</body>
</html>
