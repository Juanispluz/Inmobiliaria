<?php
session_start();
include ('../../php/controller/conexion.php');

// Verificar si el usuario está logueado
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: ../../public/html/login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$sql_user = "SELECT nombre, apellido, correo, telefono FROM usuario WHERE id_usuario = ?";
$stmt_user = $conexion->prepare($sql_user);
$stmt_user->bind_param("i", $user_id);
$stmt_user->execute();
$result_user = $stmt_user->get_result();

$image_user = "../../resources/images/default_image_user.jpg";


if ($result_user->num_rows === 1) {
    $user = $result_user->fetch_assoc();
} else {
    $message = "Usuario no encontrado.";
}
?>