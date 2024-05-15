<?php
// Funciones para obtener el nombre del departamento, ciudad y tipo de propiedad
function obtenerNombreDepartamento($conexion, $id_departamento) {
    $sql = "SELECT n_departamento FROM Departamentos WHERE id_departamento = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id_departamento);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row['n_departamento'];
}

function obtenerNombreCiudad($conexion, $id_ciudad) {
    $sql = "SELECT n_ciudad FROM Ciudad WHERE id_ciudad = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id_ciudad);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row['n_ciudad'];
}

function obtenerTipoPropiedad($conexion, $id_tipo_propiedad) {
    $sql = "SELECT tipo_propiedad FROM T_Propiedades WHERE id_t_propiedad = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id_tipo_propiedad);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row['tipo_propiedad'];
}
?>
