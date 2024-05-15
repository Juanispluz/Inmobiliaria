<?php
include ('../../php/global/controller/publicar.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Publicar Propiedad</title>
    <link rel="stylesheet" href="../styles/styles.css">
</head>
<body>
    <div>
        <a href="index.php">Inicio</a>
    </div>
    <h2>Publicar Propiedad</h2>
    <?php if (!empty($message)): ?>
        <p class="message"><?= $message ?></p>
    <?php endif; ?>
    <form action="publicar.php" method="post" enctype="multipart/form-data">
        <div>
            <label for="titulo">Título:</label>
            <input type="text" id="titulo" name="titulo" required>
        </div>
        <div>
            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion" required></textarea>
        </div>
        <div>
            <label for="precio">Precio:</label>
            <input type="number" id="precio" name="precio" min="100000" required>
        </div>
        <div>
            <label for="direccion">Dirección:</label>
            <input type="text" id="direccion" name="direccion" required>
        </div>
        <div>
            <label for="departamento">Departamento:</label>
            <select id="departamento" name="departamento" required>
                <?php while ($row = $result_departamentos->fetch_assoc()): ?>
                    <option value="<?= $row['id_departamento'] ?>"><?= $row['n_departamento'] ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div>
            <label for="ciudad">Ciudad:</label>
            <select id="ciudad" name="ciudad" required>
                <?php while ($row = $result_ciudades->fetch_assoc()): ?>
                    <option value="<?= $row['id_ciudad'] ?>"><?= $row['n_ciudad'] ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div>
            <label for="tipo_propiedad">Tipo de Propiedad:</label>
            <select id="tipo_propiedad" name="tipo_propiedad" required>
                <?php while ($row = $result_tipos_propiedad->fetch_assoc()): ?>
                    <option value="<?= $row['id_t_propiedad'] ?>"><?= $row['tipo_propiedad'] ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div>
            <label for="metros_cuadrados">Metros Cuadrados:</label>
            <input type="number" id="metros_cuadrados" name="metros_cuadrados" required>
        </div>
        <div>
            <label>Servicios:</label><br>
            <p>Si su propiedad cuenta con un servicio marque la respectiva casilla</p>
            <input type="checkbox" id="agua" name="agua">
            <label for="agua">Agua</label><br>
            <input type="checkbox" id="amoblado" name="amoblado">
            <label for="amoblado">Amoblado</label><br>
            <input type="checkbox" id="luz" name="luz">
            <label for="luz">Luz</label><br>
            <input type="checkbox" id="gas" name="gas">
            <label for="gas">Gas</label><br>
            <input type="checkbox" id="internet" name="internet">
            <label for="internet">Internet</label><br>
        </div>
        <div>
            <label for="imagenes">Imágenes:</label>
            <input type="file" id="imagenes" name="imagenes[]" multiple accept="image/*">
        </div>
        <div id="preview"></div>
        <div>
            <button type="submit">Publicar</button>
        </div>
    </form>
    <script src="../js/scripts/publicar.js"></script>
</body>
</html>
