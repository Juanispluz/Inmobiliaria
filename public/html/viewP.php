<?php
include ('../../php/global/controller/viewP.php');
include ('../../php/global/functions/viewF.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalles de la Propiedad</title>
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
<div>
    <a href="index.php">Inicio</a>
</div>
<h2>Detalles de la Propiedad</h2>
<?php if (!empty($message)): ?>
    <p class="message"><?= $message ?></p>
<?php else: ?>
    <div>
        <h3><?= $property['titulo'] ?></h3>
        <p><?= $property['descripcion'] ?></p>
        <p><strong>Precio:</strong> $<?= number_format($property['precio'], 0, ',', '.') ?></p>
        <p><strong>Dirección:</strong> <?= $property['direccion'] ?></p>
        <p><strong>Departamento:</strong> <?php echo obtenerNombreDepartamento($conexion, $property['id_departamento']); ?></p>
        <p><strong>Ciudad:</strong> <?php echo obtenerNombreCiudad($conexion, $property['id_ciudad']); ?></p>
        <p><strong>Tipo de Propiedad:</strong> <?php echo obtenerTipoPropiedad($conexion, $property['id_t_propiedad']); ?></p>
        <p><strong>Metros Cuadrados:</strong> <?= $property['metros_cuadrados'] ?></p>
        <p><strong>Publicado por:</strong> <?= isset($user['nombre']) ? $user['nombre'] : 'Desconocido' ?></p>
        <p><strong>Servicios:</strong></p>
        <ul>
            <li>Agua: <?= $services['agua'] ? 'Sí' : 'No' ?></li>
            <li>Amoblado: <?= $services['amoblado'] ? 'Sí' : 'No' ?></li>
            <li>Luz: <?= $services['luz'] ? 'Sí' : 'No' ?></li>
            <li>Gas: <?= $services['gas'] ? 'Sí' : 'No' ?></li>
            <li>Internet: <?= $services['internet'] ? 'Sí' : 'No' ?></li>
        </ul>
        <div>
            <?php foreach ($images as $image): ?>
                <img src="<?= $image ?>" alt="Imagen de la Propiedad" style="max-width: 300px; max-height: 300px;">
            <?php endforeach; ?>
        </div>
        <div>
        <p><strong>Numero de propiedades del usuario:</strong> <?= $total_properties ?></p>
            <!-- Mostrar botón "Arrendar" solo si el usuario no es el propietario y la propiedad no está arrendada -->
            <?php if (!$is_owner && !$is_rented): ?>
                <button onclick="mostrarCalendarios(<?= $property_id ?>)">Arrendar</button>
            <?php elseif ($is_rented): ?>
                <p>La propiedad ya se encuentra arrendada</p>
            <?php endif; ?>

            <!-- Mostrar botón "Cancelar Arriendo" solo si el usuario es el arrendatario actual -->
            <?php if ($is_rented_by_user): ?>
                <button onclick="cancelarArriendo(<?= $property_id ?>)">Cancelar Arriendo</button>
            <?php endif; ?>
            <!-- Mostrar botón "Editar" y "Eliminar" solo si el usuario es el propietario -->
            <?php if ($is_owner): ?>
                <a href="editar.php?id=<?= $property_id ?>">Editar Propiedad</a>
                <a href="../../php/global/config/eliminar.php?id=<?= $property_id ?>"
                    onclick="return confirmarEliminar();">Eliminar</a>
            <?php endif; ?>
        </div>

        <div id="calendarios_<?= $property_id ?>" style="display: none;">
            <label for="fecha_llegada_<?= $property_id ?>">Fecha de Llegada:</label>
            <input type="date" id="fecha_llegada_<?= $property_id ?>" name="fecha_llegada">
            <label for="fecha_salida_<?= $property_id ?>">Fecha de Salida:</label>
            <input type="date" id="fecha_salida_<?= $property_id ?>" name="fecha_salida">
            <button onclick="validarFechasYArrendar(<?= $property_id ?>)">Confirmar Arriendo</button>
        </div>      
    </div>
<?php endif; ?>
</body>
<script src="../../public/js/scripts/viewP.js"></script>
</html>