<?php
include ('../../php/global/controller/login.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
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
                    <h2 class="text-center">Iniciar Sesion</h2>
                    <?php if (!empty($error_message)): ?>
                        <div class="error text-center"><?= $error_message ?></div>
                    <?php endif; ?>
                    <form action="login.php" method="post">
                        <div class="form-group">
                            <label for="correo">Correo:</label>
                            <input type="email" class="form-control" id="correo" name="correo" required>
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
                        <button type="submit" class="btn btn-primary btn-block">Iniciar sesión</button>
                    </form>
                    <div class="text-center mt-3">
                        <a href="register.php">¿No estás registrado?</a>
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
