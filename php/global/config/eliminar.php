<?php
session_start();
require_once('../../controller/conexion.php');

// Verificar si el usuario está logueado
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: ../../public/html/login.php");
    exit;
}

// Verificar si se ha proporcionado un ID de propiedad
if (!isset($_GET['id']) || empty($_GET['id'])) {
    // Redirigir al usuario de vuelta a la página anterior con un mensaje de error
    header("Location: ../../public/html/index.php?error=No se proporcionó un ID de propiedad.");
    exit;
}

// Obtener el ID de la propiedad
$property_id = $_GET['id'];

// Verificar si el usuario es el propietario de la propiedad que intenta eliminar
$sql_check_owner = "SELECT id_usuario FROM P_Propiedad WHERE id_p_propiedad = ?";
$stmt_check_owner = $conexion->prepare($sql_check_owner);
$stmt_check_owner->bind_param("i", $property_id);
$stmt_check_owner->execute();
$result_check_owner = $stmt_check_owner->get_result();
if ($result_check_owner->num_rows !== 1) {
    // La propiedad no existe
    header("Location: ../../public/html/index.php?error=La propiedad no existe.");
    exit;
}
$row_check_owner = $result_check_owner->fetch_assoc();
$property_owner_id = $row_check_owner['id_usuario'];

if ($_SESSION['user_id'] != $property_owner_id) {
    // El usuario no es el propietario de la propiedad, no tiene permiso para eliminarla
    header("Location: ../../public/html/index.php?error=No tiene permiso para eliminar esta propiedad.");
    exit;
}

// Eliminar la propiedad
$sql_delete_property = "DELETE FROM P_Propiedad WHERE id_p_propiedad = ?";
$stmt_delete_property = $conexion->prepare($sql_delete_property);
$stmt_delete_property->bind_param("i", $property_id);
$stmt_delete_property->execute();

// Redirigir a la página de inicio
header("Location: ../../../public/html/index.php");
exit;
?>
