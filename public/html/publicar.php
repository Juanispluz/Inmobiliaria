<?php
include ('../../php/global/controller/publicar.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Publicar Propiedad</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/publicar.css" rel="stylesheet">
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
        <br>
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Publicar Propiedad</h2>
        </div>
        
        <?php if (!empty($message)): ?>
            <div class="alert alert-info">
                <?= $message ?>
            </div>
        <?php endif; ?>

        <form action="publicar.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="titulo">Título:</label>
                <input type="text" class="form-control" id="titulo" name="titulo" required>
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción:</label>
                <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
            </div>

            <div class="form-group">
                <label for="precio">Precio:</label>
                <input type="number" class="form-control" id="precio" name="precio" min="100000" required>
            </div>

            <div class="form-group">
                <label for="direccion">Dirección:</label>
                <input type="text" class="form-control" id="direccion" name="direccion" required>
            </div>

            <div class="form-group">
                <label for="departamento">Departamento:</label>
                <select class="form-control" id="departamento" name="departamento" required>
                    <?php while ($row = $result_departamentos->fetch_assoc()): ?>
                        <option value="<?= $row['id_departamento'] ?>"><?= $row['n_departamento'] ?></option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="ciudad">Ciudad:</label>
                <select class="form-control" id="ciudad" name="ciudad" required>
                    <?php while ($row = $result_ciudades->fetch_assoc()): ?>
                        <option value="<?= $row['id_ciudad'] ?>"><?= $row['n_ciudad'] ?></option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="tipo_propiedad">Tipo de Propiedad:</label>
                <select class="form-control" id="tipo_propiedad" name="tipo_propiedad" required>
                    <?php while ($row = $result_tipos_propiedad->fetch_assoc()): ?>
                        <option value="<?= $row['id_t_propiedad'] ?>"><?= $row['tipo_propiedad'] ?></option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="metros_cuadrados">Metros Cuadrados:</label>
                <input type="number" class="form-control" id="metros_cuadrados" name="metros_cuadrados" required>
            </div>

            <div class="form-group">
                <label>Servicios:</label>
                <div class="d-flex flex-wrap">
                    <div class="form-check mr-3 mb-2">
                        <button class="btn btn-outline-primary service-btn" id="agua-btn" onclick="toggleService('agua', this); return false;">Agua</button>
                        <input type="checkbox" class="form-check-input" id="agua" name="agua">
                    </div>
                    <div class="form-check mr-3 mb-2">
                        <button class="btn btn-outline-primary service-btn" id="amoblado-btn" onclick="toggleService('amoblado', this); return false;">Amoblado</button>
                        <input type="checkbox" class="form-check-input" id="amoblado" name="amoblado">
                    </div>
                    <div class="form-check mr-3 mb-2">
                        <button class="btn btn-outline-primary service-btn" id="luz-btn" onclick="toggleService('luz', this); return false;">Luz</button>
                        <input type="checkbox" class="form-check-input" id="luz" name="luz">
                    </div>
                    <div class="form-check mr-3 mb-2">
                        <button class="btn btn-outline-primary service-btn" id="gas-btn" onclick="toggleService('gas', this); return false;">Gas</button>
                        <input type="checkbox" class="form-check-input" id="gas" name="gas">
                    </div>
                    <div class="form-check mr-3 mb-2">
                        <button class="btn btn-outline-primary service-btn" id="internet-btn" onclick="toggleService('internet', this); return false;">Internet</button>
                        <input type="checkbox" class="form-check-input" id="internet" name="internet">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <button type="button" class="btn btn-secondary" onclick="document.getElementById('imagenes').click();">Seleccionar Imágenes</button>
                <input type="file" class="form-control-file d-none" id="imagenes" name="imagenes[]" multiple accept="image/*">
            </div>

            <div id="preview" class="mb-3"></div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Publicar</button>
            </div>
        </form>
    </div>

    <?php include('../../resources/views/footer.php'); ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../js/scripts/publicar.js"></script>
</body>
</html>