<?php
require_once('../../php/global/controller/editar.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Propiedad</title>
    <link rel="stylesheet" href="../style/style.css">
</head>
<body>
    <div>
        <a href="index.php">Inicio</a>
    </div>
    <h2>Editar Propiedad</h2>
    <?php if (!empty($message)): ?>
        <p class="message"><?= $message ?></p>
    <?php else: ?>
        <form action="../../php/global/config/actualizar.php" method="POST">
            <input type="hidden" name="property_id" value="<?= $property_id ?>">
            <label for="titulo">Título:</label>
            <input type="text" id="titulo" name="titulo" value="<?= $property['titulo'] ?>"><br>
            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion"><?= $property['descripcion'] ?></textarea><br>
            <label for="precio">Precio:</label>
            <input type="text" id="precio" name="precio" value="<?= $property['precio'] ?>"><br>
            <label for="direccion">Dirección:</label>
            <input type="text" id="direccion" name="direccion" value="<?= $property['direccion'] ?>"><br>
            <label for="departamento">Departamento:</label>
            <select id="departamento" name="departamento">
                <?php foreach ($departamentos as $departamento): ?>
                    <option value="<?= $departamento['id_departamento'] ?>" <?= $departamento['id_departamento'] == $property['id_departamento'] ? 'selected' : '' ?>>
                        <?= $departamento['n_departamento'] ?>
                    </option>
                <?php endforeach; ?>
            </select><br>
            <label for="ciudad">Ciudad:</label>
            <select id="ciudad" name="ciudad">
                <?php foreach ($ciudades as $ciudad): ?>
                    <option value="<?= $ciudad['id_ciudad'] ?>" <?= $ciudad['id_ciudad'] == $property['id_ciudad'] ? 'selected' : '' ?>>
                        <?= $ciudad['n_ciudad'] ?>
                    </option>
                <?php endforeach; ?>
            </select><br>
            <label for="tipo_propiedad">Tipo de Propiedad:</label>
            <select id="tipo_propiedad" name="tipo_propiedad">
                <?php foreach ($tipos_propiedad as $tipo_propiedad): ?>
                    <option value="<?= $tipo_propiedad['id_t_propiedad'] ?>" <?= $tipo_propiedad['id_t_propiedad'] == $property['id_t_propiedad'] ? 'selected' : '' ?>>
                        <?= $tipo_propiedad['tipo_propiedad'] ?>
                    </option>
                <?php endforeach; ?>
            </select><br>
            <label for="metros_cuadrados">Metros Cuadrados:</label>
            <input type="text" id="metros_cuadrados" name="metros_cuadrados" value="<?= $property['metros_cuadrados'] ?>"><br>
            <!-- Campo para editar los servicios -->
            <?php if (isset($services) && is_array($services)): ?>
                <p><strong>Servicios:</strong></p>
                <label><input type="checkbox" name="agua" <?= $services['agua'] ? 'checked' : '' ?>> Agua</label><br>
                <label><input type="checkbox" name="amoblado" <?= $services['amoblado'] ? 'checked' : '' ?>> Amoblado</label><br>
                <label><input type="checkbox" name="luz" <?= $services['luz'] ? 'checked' : '' ?>> Luz</label><br>
                <label><input type="checkbox" name="gas" <?= $services['gas'] ? 'checked' : '' ?>> Gas</label><br>
                <label><input type="checkbox" name="internet" <?= $services['internet'] ? 'checked' : '' ?>> Internet</label><br>
            <?php endif; ?>
            <div>
                <?php if (isset($images) && is_array($images)): ?>
                    <?php foreach ($images as $image): ?>
                        <img src="<?= $image ?>" alt="Imagen de la Propiedad" style="max-width: 300px; max-height: 300px;">
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <button type="submit">Guardar Cambios</button>
            <a href="viewp.php?id=<?= $property_id ?>">Cancelar</a>
        </form>
    <?php endif; ?>
</body>
</html>