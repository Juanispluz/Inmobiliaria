<?php
session_start();
include '../../php/controller/conexion.php';

// Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $conexion->real_escape_string($_POST['correo']);
    $password = $conexion->real_escape_string($_POST['password']);

    // Consulta a la base de datos
    $sql = "SELECT id_usuario, contraseña FROM Usuario WHERE correo = '$correo'";
    $result = $conexion->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['contraseña'])) {
            // Contraseña correcta, iniciar sesión
            $_SESSION['logged_in'] = true;
            $_SESSION['user_id'] = $row['id_usuario'];
            header("Location: ../../public/html/index.php");
            exit;
        } else {
            $error_message = "Contraseña incorrecta";
        }
    } else {
        $error_message = "No se encontró el usuario";
    }
}
?>