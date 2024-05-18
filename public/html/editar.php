<?php
require_once('../../php/global/controller/editar.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Propiedad</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include('../../resources/views/header.php'); ?>
    <div class="container my-5">
        <div class="row">
            <div class="col-md-6">
                <div class="btn-group">
                    <button onclick="window.location='index.php'" class="btn btn-primary">Inicio</button>
                    <button onclick="window.location='perfil.php'" class="btn btn-primary">Ver perfil</button>
                </div>
            </div>
            <div class="col-md-6 text-right">
                <button onclick="window.location='../../php/controller/logout.php'" class="btn btn-danger">Logout</button>
            </div>
        </div>
        <h2 class="my-4">Editar Propiedad</h2>
        <?php if (!empty($message)): ?>
            <p class="message"><?= $message ?></p>
        <?php else: ?>
        <form action="../../php/global/config/actualizar.php" method="POST">
            <input type="hidden" name="property_id" value="<?= $property_id ?>">
            <div class="form-group">
                <label for="titulo">Título:</label>
                <input type="text" id="titulo" name="titulo" class="form-control" value="<?= $property['titulo'] ?>">
            </div>
            <div class="form-group">
                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion" class="form-control"><?= $property['descripcion'] ?></textarea>
            </div>
            <div class="form-group">
                <label for="precio">Precio:</label>
                <input type="text" id="precio" name="precio" class="form-control" value="<?= $property['precio'] ?>">
            </div>
            <div class="form-group">
                <label for="direccion">Dirección:</label>
                <input type="text" id="direccion" name="direccion" class="form-control" value="<?= $property['direccion'] ?>">
            </div>
            <div class="form-group">
                <label for="departamento">Departamento:</label>
                <select id="departamento" name="departamento" class="form-control">
                    <?php foreach ($departamentos as $departamento): ?>
                        <option value="<?= $departamento['id_departamento'] ?>" <?= $departamento['id_departamento'] == $property['id_departamento'] ? 'selected' : '' ?>>
                            <?= $departamento['n_departamento'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="ciudad">Ciudad:</label>
                <select id="ciudad" name="ciudad" class="form-control">
                    <?php foreach ($ciudades as $ciudad): ?>
                        <option value="<?= $ciudad['id_ciudad'] ?>" <?= $ciudad['id_ciudad'] == $property['id_ciudad'] ? 'selected' : '' ?>>
                            <?= $ciudad['n_ciudad'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="tipo_propiedad">Tipo de Propiedad:</label>
                <select id="tipo_propiedad" name="tipo_propiedad" class="form-control">
                    <?php foreach ($tipos_propiedad as $tipo_propiedad): ?>
                        <option value="<?= $tipo_propiedad['id_t_propiedad'] ?>" <?= $tipo_propiedad['id_t_propiedad'] == $property['id_t_propiedad'] ? 'selected' : '' ?>>
                            <?= $tipo_propiedad['tipo_propiedad'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="metros_cuadrados">Metros Cuadrados:</label>
                <input type="text" id="metros_cuadrados" name="metros_cuadrados" class="form-control" value="<?= $property['metros_cuadrados'] ?>">
            </div>
            <!-- Campo para editar los servicios -->
            <?php if (isset($services) && is_array($services)): ?>
            <div class="form-group d-flex flex-wrap">
                <p class="w-100"><strong>Servicios:</strong></p>
                <div class="form-check mr-3 mb-2">
                    <button class="btn <?= $services['agua'] ? 'btn-primary' : 'btn-outline-primary' ?> service-btn" id="agua-btn" onclick="toggleService('agua', this); return false;">Agua</button>
                    <input type="checkbox" class="form-check-input" id="agua" name="agua" <?= $services['agua'] ? 'checked' : '' ?> style="display: none;">
                </div>
                <div class="form-check mr-3 mb-2">
                    <button class="btn <?= $services['amoblado'] ? 'btn-primary' : 'btn-outline-primary' ?> service-btn" id="amoblado-btn" onclick="toggleService('amoblado', this); return false;">Amoblado</button>
                    <input type="checkbox" class="form-check-input" id="amoblado" name="amoblado" <?= $services['amoblado'] ? 'checked' : '' ?> style="display: none;">
                </div>
                <div class="form-check mr-3 mb-2">
                    <button class="btn <?= $services['luz'] ? 'btn-primary' : 'btn-outline-primary' ?> service-btn" id="luz-btn" onclick="toggleService('luz', this); return false;">Luz</button>
                    <input type="checkbox" class="form-check-input" id="luz" name="luz" <?= $services['luz'] ? 'checked' : '' ?> style="display: none;">
                </div>
                <div class="form-check mr-3 mb-2">
                    <button class="btn <?= $services['gas'] ? 'btn-primary' : 'btn-outline-primary' ?> service-btn" id="gas-btn" onclick="toggleService('gas', this); return false;">Gas</button>
                    <input type="checkbox" class="form-check-input" id="gas" name="gas" <?= $services['gas'] ? 'checked' : '' ?> style="display: none;">
                </div>
                <div class="form-check mr-3 mb-2">
                    <button class="btn <?= $services['internet'] ? 'btn-primary' : 'btn-outline-primary' ?> service-btn" id="internet-btn" onclick="toggleService('internet', this); return false;">Internet</button>
                    <input type="checkbox" class="form-check-input" id="internet" name="internet" <?= $services['internet'] ? 'checked' : '' ?> style="display: none;">
                </div>
            </div>
            <?php endif; ?>
            <div class="form-group">
                <?php if (isset($images) && is_array($images)): ?>
                    <label for="property_images">Imágenes:</label><br>
                    <div class="row">
                        <?php foreach ($images as $image): ?>
                            <div class="col-6 col-md-4">
                                <img src="<?= $image ?>" alt="Imagen de la Propiedad" class="img-fluid mb-2">
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            <a href="viewp.php?id=<?= $property_id ?>" class="btn btn-secondary">Cancelar</a>
        </form>
    <?php endif; ?>
    <?php include('../../resources/views/footer.php'); ?>
    </div>
    <script src="../js/scripts/editar.js"></script>
</body>
</html>