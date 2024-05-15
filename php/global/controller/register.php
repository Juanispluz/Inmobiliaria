<?php
session_start();
include '../../php/controller/conexion.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $conexion->real_escape_string($_POST['nombre']);
    $apellido = $conexion->real_escape_string($_POST['apellido']);
    $correo = $conexion->real_escape_string($_POST['correo']);
    $telefono = $conexion->real_escape_string($_POST['telefono']);
    $password = $conexion->real_escape_string($_POST['password']);
    $confirm_password = $conexion->real_escape_string($_POST['confirm_password']);
    $es_universitario = isset($_POST['es_universitario']) ? 1 : 0;
    $id_universidad = $es_universitario ? $conexion->real_escape_string($_POST['universidad']) : null;

    if ($password !== $confirm_password) {
        $message = "Las contraseñas no coinciden.";
    } else {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO Usuario (nombre, apellido, correo, telefono, contraseña) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("sssss", $nombre, $apellido, $correo, $telefono, $password_hash);

        if ($stmt->execute()) {
            $user_id = $stmt->insert_id;
            if ($es_universitario && $id_universidad) {
                $sql_univ = "INSERT INTO Universitario (id_usuario, id_universidad) VALUES (?, ?)";
                $stmt_univ = $conexion->prepare($sql_univ);
                $stmt_univ->bind_param("ii", $user_id, $id_universidad);
                $stmt_univ->execute();
                $stmt_univ->close();
            }
            $message = "Registro exitoso. Puede <a href='../../public/html/login.php'>iniciar sesión ahora</a>.";
        } else {
            $message = "Error: " . $stmt->error;
        }

        $stmt->close();
    }
}

// Obtener universidades
$universidades = [];
$query = "SELECT id_universidad, nombreU FROM Universidad";
$result = $conexion->query($query);
while ($row = $result->fetch_assoc()) {
    $universidades[] = $row;
}
$conexion->close();
?>