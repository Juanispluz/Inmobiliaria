<?php
session_start();
include ('../../php/controller/conexion.php');
//include ('../functions/saveImg.php');
include ('../../php/global/functions/saveImg.php');


// Verificar si el usuario está logueado
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: ../../public/html/login.php");
    exit;
}

$message = "";

// Obtener departamentos
$sql_departamentos = "SELECT id_departamento, n_departamento FROM Departamentos";
$result_departamentos = $conexion->query($sql_departamentos);

// Obtener ciudades
$sql_ciudades = "SELECT id_ciudad, n_ciudad FROM Ciudad";
$result_ciudades = $conexion->query($sql_ciudades);

// Obtener tipos de propiedad
$sql_tipos_propiedad = "SELECT id_t_propiedad, tipo_propiedad FROM T_Propiedades";
$result_tipos_propiedad = $conexion->query($sql_tipos_propiedad);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $conexion->real_escape_string($_POST['titulo']);
    $descripcion = $conexion->real_escape_string($_POST['descripcion']);
    $precio = $conexion->real_escape_string($_POST['precio']);
    $direccion = $conexion->real_escape_string($_POST['direccion']);
    $id_departamento = $conexion->real_escape_string($_POST['departamento']);
    $id_ciudad = $conexion->real_escape_string($_POST['ciudad']);
    $id_tipo_propiedad = $conexion->real_escape_string($_POST['tipo_propiedad']);
    $metros_cuadrados = $conexion->real_escape_string($_POST['metros_cuadrados']);
    $agua = isset($_POST['agua']) ? 1 : 0;
    $amoblado = isset($_POST['amoblado']) ? 1 : 0;
    $luz = isset($_POST['luz']) ? 1 : 0;
    $gas = isset($_POST['gas']) ? 1 : 0;
    $internet = isset($_POST['internet']) ? 1 : 0;
    $id_usuario = $_SESSION['user_id'];

    // Insertar en la base de datos
    $sql = "INSERT INTO P_Propiedad (id_usuario, titulo, descripcion, precio, direccion, id_departamento, id_ciudad, id_t_propiedad, metros_cuadrados) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("issisiiii", $id_usuario, $titulo, $descripcion, $precio, $direccion, $id_departamento, $id_ciudad, $id_tipo_propiedad, $metros_cuadrados);

    if ($stmt->execute()) {
        $property_id = $stmt->insert_id;
        
        // Insertar servicios en la base de datos
        $sql_services = "INSERT INTO Servicios (id_p_propiedad, agua, amoblado, luz, gas, internet) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt_services = $conexion->prepare($sql_services);
        $stmt_services->bind_param("iiiiii", $property_id, $agua, $amoblado, $luz, $gas, $internet);
        $stmt_services->execute();

        // Llamar a la función para subir imágenes
        uploadImages($_FILES['imagenes'], $property_id, $id_usuario, $titulo);

        $message = "Propiedad publicada exitosamente.";
        
        // Redirigir a la página view_property.php
        header("Location: ../../public/html/viewp.php?id=$property_id");
        exit;
    } else {
        $message = "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>