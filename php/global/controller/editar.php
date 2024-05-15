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
    $sql_property = "SELECT P.*, D.n_departamento, C.n_ciudad, T.tipo_propiedad 
                     FROM P_Propiedad P 
                     INNER JOIN Departamentos D ON P.id_departamento = D.id_departamento 
                     INNER JOIN Ciudad C ON P.id_ciudad = C.id_ciudad 
                     INNER JOIN T_Propiedades T ON P.id_t_propiedad = T.id_t_propiedad
                     WHERE id_p_propiedad = ?";
    $stmt_property = $conexion->prepare($sql_property);
    $stmt_property->bind_param("i", $property_id);
    $stmt_property->execute();
    $result_property = $stmt_property->get_result();

    if ($result_property->num_rows === 1) {
        $property = $result_property->fetch_assoc();

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

        // Verificar si el usuario actual es el mismo que publicó la propiedad
        $is_owner = $_SESSION['user_id'] == $property['id_usuario'];

        // Obtener el nombre del usuario propietario
        $sql_user = "SELECT nombre FROM Usuario WHERE id_usuario = ?";
        $stmt_user = $conexion->prepare($sql_user);
        $stmt_user->bind_param("i", $user_id);
        $stmt_user->execute();
        $result_user = $stmt_user->get_result();
        $user = $result_user->fetch_assoc();

        // Obtener opciones para Departamento, Ciudad y Tipo de Propiedad
        $sql_departamentos = "SELECT id_departamento, n_departamento FROM Departamentos";
        $result_departamentos = $conexion->query($sql_departamentos);
        $departamentos = $result_departamentos->fetch_all(MYSQLI_ASSOC);

        $sql_ciudades = "SELECT id_ciudad, n_ciudad FROM Ciudad";
        $result_ciudades = $conexion->query($sql_ciudades);
        $ciudades = $result_ciudades->fetch_all(MYSQLI_ASSOC);

        $sql_tipos_propiedad = "SELECT id_t_propiedad, tipo_propiedad FROM T_Propiedades";
        $result_tipos_propiedad = $conexion->query($sql_tipos_propiedad);
        $tipos_propiedad = $result_tipos_propiedad->fetch_all(MYSQLI_ASSOC);
    } else {
        $message = "La propiedad no existe.";
    }
} else {
    $message = "ID de propiedad no proporcionado.";
}
?>