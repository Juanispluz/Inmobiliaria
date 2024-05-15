<?php
session_start();
include ('../../php/controller/conexion.php');

// Verificar si el usuario está logueado
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: ../../public/html/login.php");
    exit;
}

$message = "";

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $property_id = $_GET['id'];

    // Obtener detalles de la propiedad
    $sql_property = "SELECT * FROM P_Propiedad WHERE id_p_propiedad = ?";
    $stmt_property = $conexion->prepare($sql_property);
    $stmt_property->bind_param("i", $property_id);
    $stmt_property->execute();
    $result_property = $stmt_property->get_result();

    if ($result_property->num_rows === 1) {
        $property = $result_property->fetch_assoc();

        // Obtener la ruta de la carpeta donde se guardan las imágenes
        $year = date("Y");
        $month = date("m");
        $user_id = $property['id_usuario']; // ID del usuario propietario
        $upload_dir = "../../database/imgprobd/$year/$month/$user_id/$property_id/";

        // Escanear la carpeta y obtener los nombres de archivo de las imágenes
        $images = glob($upload_dir . "*.{jpg,jpeg,png,gif,webp}", GLOB_BRACE);

        // Si no se encontraron imágenes, establecer una imagen por defecto
        if (empty($images)) {
            $images[] = "../../resources/images/default_image.jpg";
        }

        // Obtener servicios de la propiedad
        $sql_services = "SELECT agua, amoblado, luz, gas, internet FROM Servicios WHERE id_p_propiedad = ?";
        $stmt_services = $conexion->prepare($sql_services);
        $stmt_services->bind_param("i", $property_id);
        $stmt_services->execute();
        $result_services = $stmt_services->get_result();
        if ($result_services->num_rows === 1) {
            $services = $result_services->fetch_assoc();
        } else {
            // Manejar el caso en que no se encuentren servicios para esta propiedad
            $services = array(
                'agua' => false,
                'amoblado' => false,
                'luz' => false,
                'gas' => false,
                'internet' => false
            );
        }

        // Verificar si el usuario actual es el mismo que publicó la propiedad
        $is_owner = $_SESSION['user_id'] == $property['id_usuario'];

        // Consulta para verificar si el usuario ha arrendado esta propiedad
        $sql_arriendo = "SELECT * FROM Reservacion WHERE id_usuario = ? AND id_p_propiedad = ?";
        $stmt_arriendo = $conexion->prepare($sql_arriendo);
        $stmt_arriendo->bind_param("ii", $_SESSION['user_id'], $property_id);
        $stmt_arriendo->execute();
        $result_arriendo = $stmt_arriendo->get_result();
        $is_rented_by_user = $result_arriendo->num_rows > 0;

        // Consulta para verificar si la propiedad está arrendada
        $sql_is_rented = "SELECT * FROM Reservacion WHERE id_p_propiedad = ?";
        $stmt_is_rented = $conexion->prepare($sql_is_rented);
        $stmt_is_rented->bind_param("i", $property_id);
        $stmt_is_rented->execute();
        $result_is_rented = $stmt_is_rented->get_result();
        $is_rented = $result_is_rented->num_rows > 0;

        // Obtener el nombre del usuario propietario
        $sql_user = "SELECT nombre FROM usuario WHERE id_usuario = ?";
        $stmt_user = $conexion->prepare($sql_user);
        $stmt_user->bind_param("i", $property['id_usuario']);
        $stmt_user->execute();
        $result_user = $stmt_user->get_result();
        $user = $result_user->fetch_assoc();

        // Consulta para obtener el total de propiedades publicadas por el usuario
        $total_properties = 0;
        $sql_total_properties = "SELECT COUNT(*) AS total FROM P_Propiedad WHERE id_usuario = ?";
        $stmt_total_properties = $conexion->prepare($sql_total_properties);
        $stmt_total_properties->bind_param("i", $property['id_usuario']);
        $stmt_total_properties->execute();
        $result_total_properties = $stmt_total_properties->get_result();
        if ($result_total_properties->num_rows === 1) {
            $row = $result_total_properties->fetch_assoc();
            $total_properties = $row['total'];
        }
    } else {
        $message = "La propiedad no existe.";
    }
} else {
    $message = "ID de propiedad no proporcionado.";
}
?>
