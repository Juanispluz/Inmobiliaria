<?php
session_start();
include ('../../controller/conexion.php');

// Verificar si el usuario está logueado
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: ../../public/html/login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Obtener las reservaciones del usuario antes de eliminarlo
$sql_select_reservations = "SELECT id_reservacion FROM reservacion WHERE id_usuario = ?";
$stmt_select_reservations = $conexion->prepare($sql_select_reservations);
$stmt_select_reservations->bind_param("i", $user_id);
$stmt_select_reservations->execute();
$result_select_reservations = $stmt_select_reservations->get_result();

// Eliminar cada reservación del usuario
while ($row = $result_select_reservations->fetch_assoc()) {
    $reservation_id = $row['id_reservacion'];
    $sql_delete_reservation = "DELETE FROM reservacion WHERE id_reservacion = ?";
    $stmt_delete_reservation = $conexion->prepare($sql_delete_reservation);
    $stmt_delete_reservation->bind_param("i", $reservation_id);
    $stmt_delete_reservation->execute();
    $stmt_delete_reservation->close();
}

$stmt_select_reservations->close();

// Guardar los datos del usuario eliminado en la tabla usuarios_eliminados
$sql_select_user = "SELECT nombre, apellido, correo, telefono, contraseña FROM usuario WHERE id_usuario = ?";
$stmt_select_user = $conexion->prepare($sql_select_user);
$stmt_select_user->bind_param("i", $user_id);
$stmt_select_user->execute();
$result_select_user = $stmt_select_user->get_result();
$user_data = $result_select_user->fetch_assoc();

$sql_guardar_usuario_eliminado = "INSERT INTO usuarios_eliminados (id_usuario_eliminado, nombre, apellido, correo, telefono, contraseña, fecha_eliminacion) VALUES (?, ?, ?, ?, ?, ?, NOW())";
$stmt_guardar_usuario_eliminado = $conexion->prepare($sql_guardar_usuario_eliminado);
$stmt_guardar_usuario_eliminado->bind_param("isssss", $user_id, $user_data['nombre'], $user_data['apellido'], $user_data['correo'], $user_data['telefono'], $user_data['contraseña']);
$stmt_guardar_usuario_eliminado->execute();
$stmt_guardar_usuario_eliminado->close();

// Eliminar el usuario y todas las propiedades asociadas
$sql_delete_properties = "DELETE FROM p_propiedad WHERE id_usuario = ?";
$stmt_delete_properties = $conexion->prepare($sql_delete_properties);
$stmt_delete_properties->bind_param("i", $user_id);
$stmt_delete_properties->execute();
$stmt_delete_properties->close();

$sql_delete_user = "DELETE FROM usuario WHERE id_usuario = ?";
$stmt_delete_user = $conexion->prepare($sql_delete_user);
$stmt_delete_user->bind_param("i", $user_id);
$stmt_delete_user->execute();
$stmt_delete_user->close();

// Cerrar la sesión y redirigir a la página de inicio de sesión
session_destroy();
header("Location: ../../../public/html/index.php");
exit;
?>
