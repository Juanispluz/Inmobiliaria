<?php
require_once ('../../php/global/controller/index.php');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inicio</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <?php include('../../resources/views/header.php'); ?>

    <div class="container my-5">
        <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="btn-group">
                    <button onclick="window.location='publicar.php'" class="btn btn-primary">Publicar</button>
                    <button onclick="window.location='perfil.php'" class="btn btn-primary">Ver perfil</button>
                </div>
                <div>
                    <button onclick="window.location='../../php/controller/logout.php'" class="btn btn-danger">Logout</button>
                </div>
            </div>
        <?php else: ?>
            <div class="btn-group">
                <button onclick="window.location='login.php'" class="btn btn-primary">Iniciar sesión</button>
                <button onclick="window.location='register.php'" class="btn btn-primary">Registrarse</button>
            </div>
        <?php endif; ?>

        <!-- Mostrar publicaciones -->
        <h2 class="my-4">Publicaciones</h2>
        <div class="row">
            <?php
            // Consulta para obtener las publicaciones ordenadas por ID de forma descendente
            $sql_publicaciones = "SELECT P.id_p_propiedad, P.titulo, P.precio, C.n_ciudad, P.direccion, P.id_usuario FROM P_Propiedad P INNER JOIN Ciudad C ON P.id_ciudad = C.id_ciudad ORDER BY P.id_p_propiedad DESC";
            $result_publicaciones = $conexion->query($sql_publicaciones);

            if ($result_publicaciones->num_rows > 0) {
                // Mostrar las publicaciones
                while ($row = $result_publicaciones->fetch_assoc()) {
                    // Obtener la ruta de la primera imagen
                    $primera_imagen = obtenerPrimeraImagen($row['id_p_propiedad'], $row['id_usuario']);

                    // Enlace para visualizar la publicación completa
                    $url_viewp = "viewp.php?id=" . $row['id_p_propiedad'];
                    echo "<div class='col-md-4'>";
                    echo "<div class='card mb-4 shadow-sm' onclick=\"window.location='$url_viewp'\">";
                    echo "<img src='$primera_imagen' alt='Imagen de la Propiedad' class='card-img-top'>";
                    echo "<div class='card-body'>";
                    echo "<h5 class='card-title'>" . $row['titulo'] . "</h5>";
                    echo "<p class='card-text'><strong>Precio:</strong> $" . number_format($row['precio'], 0, ',', '.') . "</p>"; // Formatear precio con separadores de miles
                    echo "<p class='card-text'><strong>Ciudad:</strong> " . $row['n_ciudad'] . "</p>";
                    echo "<p class='card-text'><strong>Dirección:</strong> " . $row['direccion'] . "</p>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                }
            } else {
                echo "<div class='col-md-12'>";
                echo "<p>No se encontraron publicaciones.</p>";
                echo "</div>";
            }
            ?>
        </div>
    </div>

    <?php include('../../resources/views/footer.php'); ?>
</body>
</html>
