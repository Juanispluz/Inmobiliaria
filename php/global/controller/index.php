<?php
session_start();
include ('../../php/controller/conexion.php');

// Función para obtener la ruta de la primera imagen de una propiedad
function obtenerPrimeraImagen($property_id, $user_id) {
    $year = date("Y");
    $month = date("m");
    $upload_dir = "../../database/imgprobd/$year/$month/$user_id/$property_id/";

    // Escanear la carpeta y obtener los nombres de archivo de las imágenes
    $images = glob($upload_dir . "*.{jpg,jpeg,png,gif,webp}", GLOB_BRACE);

    // Si hay al menos una imagen, devolver la ruta de la primera
    if (!empty($images)) {
        return $images[0];
    } else {
        // Si no hay imágenes, devolver una ruta de imagen predeterminada
        return "../../resources/images/default_image.jpg";
    }
}
?>