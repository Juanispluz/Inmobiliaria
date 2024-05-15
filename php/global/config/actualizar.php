<?php
session_start();
require_once('../../controller/conexion.php');

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si el usuario está logueado
    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
        header("Location: ../../public/html/login.php");
        exit;
    }

    // Obtener los datos del formulario
    $property_id = $_POST['property_id'];
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $direccion = $_POST['direccion'];
    $departamento = $_POST['departamento'];
    $ciudad = $_POST['ciudad'];
    $tipo_propiedad = $_POST['tipo_propiedad'];
    $metros_cuadrados = $_POST['metros_cuadrados'];

    // Obtener los servicios del formulario, si es necesario
    $agua = isset($_POST['agua']) ? 1 : 0;
    $amoblado = isset($_POST['amoblado']) ? 1 : 0;
    $luz = isset($_POST['luz']) ? 1 : 0;
    $gas = isset($_POST['gas']) ? 1 : 0;
    $internet = isset($_POST['internet']) ? 1 : 0;

    // Actualizar los detalles de la propiedad en la tabla P_Propiedad
    $sql_update_property = "UPDATE P_Propiedad 
                            SET titulo=?, descripcion=?, precio=?, direccion=?, id_departamento=?, id_ciudad=?, id_t_propiedad=?, metros_cuadrados=? 
                            WHERE id_p_propiedad=?";
    $stmt_update_property = $conexion->prepare($sql_update_property);
    $stmt_update_property->bind_param("ssisiiiii", $titulo, $descripcion, $precio, $direccion, $departamento, $ciudad, $tipo_propiedad, $metros_cuadrados, $property_id);

    // Actualizar los servicios de la propiedad en la tabla Servicios
    $sql_update_services = "UPDATE Servicios 
                            SET agua=?, amoblado=?, luz=?, gas=?, internet=? 
                            WHERE id_p_propiedad=?";
    $stmt_update_services = $conexion->prepare($sql_update_services);
    $stmt_update_services->bind_param("iiiiii", $agua, $amoblado, $luz, $gas, $internet, $property_id);

    // Ejecutar las consultas
    if ($stmt_update_property->execute() && $stmt_update_services->execute()) {
        // Redireccionar a la página de detalles de la propiedad actualizada
        header("Location: ../../../public/html/viewp.php?id=" . $property_id);
        exit;
    } else {
        echo "Error al actualizar la propiedad y/o los servicios.";
    }

    // Cerrar las conexiones y liberar recursos
    $stmt_update_property->close();
    $stmt_update_services->close();
    $conexion->close();
}
?>
