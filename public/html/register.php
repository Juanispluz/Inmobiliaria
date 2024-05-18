<?php
include ('../../php/global/controller/register.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <?php include('../../resources/views/header.php'); ?>
    <div class="container my-5">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="btn-group">
                    <button onclick="window.location='index.php'" class="btn btn-primary">Inicio</button>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="mt-5">
                    <h2 class="text-center">Registro</h2>
                    <?php if (!empty($message)): ?>
                        <p class="error text-center"><?= $message ?></p>
                    <?php endif; ?>
                    <form action="register.php" method="post">
                        <div class="form-group">
                            <label for="nombre">Nombre:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                        <div class="form-group">
                            <label for="apellido">Apellido:</label>
                            <input type="text" class="form-control" id="apellido" name="apellido" required>
                        </div>
                        <div class="form-group">
                            <label for="correo">Correo electrónico:</label>
                            <input type="email" class="form-control" id="correo" name="correo" required>
                        </div>
                        <div class="form-group">
                            <label for="confirm_email">Confirmar Correo:</label>
                            <input type="email" class="form-control" id="confirm_email" name="confirm_email" required>
                        </div>
                        <div class="form-group">
                            <label for="telefono">Teléfono:</label>
                            <input type="text" class="form-control" id="telefono" name="telefono" required>
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="es_universitario" name="es_universitario" onchange="toggleUniversidad()">
                            <label class="form-check-label" for="es_universitario">¿Eres universitario?</label>
                        </div>
                        <div class="form-group" id="select_universidad" style="display:none;">
                            <label for="universidad">Universidad:</label>
                            <select class="form-control" name="universidad" id="universidad">
                                <?php foreach ($universidades as $universidad): ?>
                                    <option value="<?= $universidad['id_universidad'] ?>"><?= $universidad['nombreU'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="password">Contraseña:</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="password" name="password" required>
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-outline-secondary" onclick="togglePasswordVisibility('password')">Mostrar</button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="confirm_password">Confirmar Contraseña:</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-outline-secondary" onclick="togglePasswordVisibility('confirm_password')">Mostrar</button>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Registrarse</button>
                    </form>
                    <div class="text-center mt-3">
                        <a href="login.php">¿Ya tienes una cuenta?</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <?php include('../../resources/views/footer.php'); ?>
    <!-- Scripts opcionales de Bootstrap y otros -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../js/main.js"></script>
</body>
</html>
