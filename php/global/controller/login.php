<?php
session_start();
include '../../php/controller/conexion.php';

// Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $conexion->real_escape_string($_POST['correo']);
    $password = $conexion->real_escape_string($_POST['password']);

    // Consulta a la base de datos en la tabla usuario
    $sql_usuario = "SELECT id_usuario, contraseña FROM usuario WHERE correo = ?";
    $stmt_usuario = $conexion->prepare($sql_usuario);
    $stmt_usuario->bind_param("s", $correo);
    $stmt_usuario->execute();
    $result_usuario = $stmt_usuario->get_result();

    // Consulta a la base de datos en la tabla usuarios_eliminados
    $sql_eliminados = "SELECT id_usuario_eliminado AS id_usuario, contraseña FROM usuarios_eliminados WHERE correo = ?";
    $stmt_eliminados = $conexion->prepare($sql_eliminados);
    $stmt_eliminados->bind_param("s", $correo);
    $stmt_eliminados->execute();
    $result_eliminados = $stmt_eliminados->get_result();

    // Verificar si se encontró el usuario en la tabla usuario
    if ($result_usuario->num_rows > 0) {
        $row = $result_usuario->fetch_assoc();
        if (password_verify($password, $row['contraseña'])) {
            // Contraseña correcta, iniciar sesión
            $_SESSION['logged_in'] = true;
            $_SESSION['user_id'] = $row['id_usuario'];
            header("Location: ../../public/html/index.php");
            exit;
        } else {
            $error_message = "Contraseña incorrecta";
        }
    }
    // Verificar si se encontró el usuario en la tabla usuarios_eliminados
    elseif ($result_eliminados->num_rows > 0) {
        $row = $result_eliminados->fetch_assoc();
        if (password_verify($password, $row['contraseña'])) {
            // Contraseña correcta, iniciar sesión
            $_SESSION['logged_in'] = true;
            $_SESSION['user_id'] = $row['id_usuario'];

            // Eliminar al usuario de la tabla usuarios_eliminados
            $sql_delete = "DELETE FROM usuarios_eliminados WHERE id_usuario_eliminado = ?";
            $stmt_delete = $conexion->prepare($sql_delete);
            $stmt_delete->bind_param("i", $row['id_usuario']);
            $stmt_delete->execute();

            header("Location: ../../public/html/index.php");
            exit;
        } else {
            $error_message = "Contraseña incorrecta";
        }
    }
    // Si el usuario no se encuentra en ninguna de las tablas
    else {
        $error_message = "No se encontró el usuario";
    }
}
?>
