<?php
session_start();
include('../../controller/conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si el usuario está logueado
    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
        http_response_code(403); // Acceso prohibido
        exit;
    }

    // Verificar si se proporcionó un ID de propiedad
    if (!isset($_POST['propertyId']) || empty($_POST['propertyId'])) {
        http_response_code(400); // Solicitud incorrecta
        exit;
    }

    $property_id = $_POST['propertyId'];
    $user_id = $_SESSION['user_id'];

    // Llamar al procedimiento almacenado para cancelar el arriendo
    $sql_call_cancelar_arriendo = "CALL CancelarReserva(?, ?)";
    $stmt_call_cancelar_arriendo = $conexion->prepare($sql_call_cancelar_arriendo);
    $stmt_call_cancelar_arriendo->bind_param("ii", $user_id, $property_id);

    if ($stmt_call_cancelar_arriendo->execute()) {
        echo "Arriendo cancelado correctamente.";
    } else {
        echo "Error al cancelar el arriendo.";
    }

    // Cerrar la conexión a la base de datos
    $stmt_call_cancelar_arriendo->close();
    $conexion->close();
} else {
    http_response_code(405); // Método no permitido
}
?>
