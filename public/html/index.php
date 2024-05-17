<?php
require_once ('../../php/global/controller/index.php');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inicio</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <?php include('../../resources/views/header.php'); ?>

    <div class="container">
        <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
            <button onclick="window.location='publicar.php'">Publicar</button>
            <button onclick="window.location='perfil.php'">Ver perfil</button>
            <button onclick="window.location='../../php/controller/logout.php'">Logout</button>
        <?php else: ?>
            <button onclick="window.location='login.php'">Iniciar sesión</button>
            <button onclick="window.location='register.php'">Registrarse</button>
        <?php endif; ?>

        <!-- Mostrar publicaciones -->
        <h2>Publicaciones</h2>
        <div class="publicaciones">
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
                    echo "<a href='$url_viewp'>";
                    echo "<div>";
                    echo "<img src='$primera_imagen' alt='Imagen de la Propiedad' style='max-width: 300px; max-height: 300px;'>";
                    echo "<h3>" . $row['titulo'] . "</h3>";
                    echo "<p><strong>Precio:</strong> $" . number_format($row['precio'], 0, ',', '.') . "</p>"; // Formatear precio con separadores de miles
                    echo "<p><strong>Ciudad:</strong> " . $row['n_ciudad'] . "</p>";
                    echo "<p><strong>Dirección:</strong> " . $row['direccion'] . "</p>";
                    echo "</div>";
                    echo "</a>";
                }
            } else {
                echo "<p>No se encontraron publicaciones.</p>";
            }
            ?>
        </div>
    </div>

    <?php include('../../resources/views/footer.php'); ?>
</body>
</html>
