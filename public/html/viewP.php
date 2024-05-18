<?php
include ('../../php/global/controller/viewP.php');
include ('../../php/global/functions/viewF.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalles de la Propiedad</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/viewP.css">
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
            <h2>Detalles de la Propiedad</h2>
        </div>

        <?php if (!empty($message)): ?>
            <div class="alert alert-info">
                <?= $message ?>
            </div>
        <?php else: ?>
            <div class="card">
                <div class="card-header">
                    <h3><?= $property['titulo'] ?></h3>
                </div>
                <div class="carousel-container">
                    <div id="propertyCarousel" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <?php foreach ($images as $index => $image): ?>
                                    <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                                        <img src="<?= $image ?>" class="d-block w-100" alt="Imagen de la Propiedad">
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <a class="carousel-control-prev" href="#propertyCarousel" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#propertyCarousel" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                    </div>
                </div>
                <div class="card-body">
                    <p class="card-text"><?= $property['descripcion'] ?></p>
                    <p><strong>Precio:</strong> $<?= number_format($property['precio'], 0, ',', '.') ?></p>
                    <p><strong>Dirección:</strong> <?= $property['direccion'] ?></p>
                    <p><strong>Departamento:</strong> <?= obtenerNombreDepartamento($conexion, $property['id_departamento']) ?></p>
                    <p><strong>Ciudad:</strong> <?= obtenerNombreCiudad($conexion, $property['id_ciudad']) ?></p>
                    <p><strong>Tipo de Propiedad:</strong> <?= obtenerTipoPropiedad($conexion, $property['id_t_propiedad']) ?></p>
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

                    <div class="mt-4">
                        <p><strong>Número de propiedades del usuario:</strong> <?= $total_properties ?></p>
                        <?php if (!$is_owner && !$is_rented): ?>
                            <button class="btn btn-primary" onclick="mostrarCalendarios(<?= $property_id ?>)">Arrendar</button>
                        <?php elseif ($is_rented): ?>
                            <p class="text-danger">La propiedad ya se encuentra arrendada</p>
                        <?php endif; ?>

                        <?php if ($is_rented_by_user): ?>
                            <button class="btn btn-warning" onclick="cancelarArriendo(<?= $property_id ?>)">Cancelar Arriendo</button>
                        <?php endif; ?>

                        <?php if ($is_owner): ?>
                            <a href="editar.php?id=<?= $property_id ?>" class="btn btn-secondary">Editar Propiedad</a>
                            <a href="../../php/global/config/eliminar.php?id=<?= $property_id ?>" class="btn btn-danger" onclick="return confirmarEliminar();">Eliminar</a>
                        <?php endif; ?>
                    </div>

                    <div id="calendarios_<?= $property_id ?>" class="mt-4" style="display: none;">
                        <label for="fecha_llegada_<?= $property_id ?>">Fecha de Llegada:</label>
                        <input type="date" id="fecha_llegada_<?= $property_id ?>" name="fecha_llegada" class="form-control">
                        <label for="fecha_salida_<?= $property_id ?>" class="mt-2">Fecha de Salida:</label>
                        <input type="date" id="fecha_salida_<?= $property_id ?>" name="fecha_salida" class="form-control">
                        <button class="btn btn-success mt-3" onclick="validarFechasYArrendar(<?= $property_id ?>)">Confirmar Arriendo</button>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <?php include('../../resources/views/footer.php'); ?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="../../public/js/scripts/viewP.js"></script>
</body>
</html>
