<?php
session_start();
include('../../controller/conexion.php');

// Verificar si la solicitud es POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitizar y validar los datos de entrada
    $propertyId = $_POST['propertyId'];
    $fechaLlegada = $_POST['fechaLlegada'];
    $fechaSalida = $_POST['fechaSalida'];

    // Llamar al procedimiento almacenado ArrendarPropiedad
    $sql_call_procedure = "CALL ReservarPropiedad(?, ?, ?, ?)";
    $stmt_call_procedure = $conexion->prepare($sql_call_procedure);
    $stmt_call_procedure->bind_param("iiss", $_SESSION['user_id'], $propertyId, $fechaLlegada, $fechaSalida);

    try {
        // Intentar ejecutar la llamada al procedimiento almacenado
        $stmt_call_procedure->execute();
        echo "¡La propiedad ha sido arrendada exitosamente!";
    } catch (Exception $e) {
        // Si se lanza una excepción, manejarla
        echo "Error al arrendar la propiedad: " . $e->getMessage();
    }

    // Cerrar la conexión a la base de datos
    $stmt_call_procedure->close();
    $conexion->close();
}
?>
