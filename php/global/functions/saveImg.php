<?php
// Guardar fotos de la propiedad
function uploadImages($files, $property_id, $user_id, $property_title) {
    require_once('../../php/controller/conexion.php');

    $message = "";

    if (!empty($files['name'][0])) {
        $total_files = count($files['name']);
        $year = date("Y");
        $month = date("m");

        // Directorio de destino basado en id_usuario e id_propiedad
        $upload_dir = "../../database/imgprobd/$year/$month/$user_id/$property_id/";
        
        // Crear la carpeta si no existe
        if (!file_exists($upload_dir)) {
            if (!mkdir($upload_dir, 0777, true)) {
                die('Error al crear las carpetas...');
            }
        }

        for ($i = 0; $i < $total_files; $i++) {
            $file_name = $files['name'][$i];
            $file_tmp = $files['tmp_name'][$i];
            $file_type = $files['type'][$i];

            // Obtener la extensión del archivo
            $extension = pathinfo($file_name, PATHINFO_EXTENSION);

            // Generar un nombre único para la imagen
            $image_name = $user_id . "_" . $property_id . "_" . $property_title . "_" . $i . ".webp";

            // Guardar imagen en el servidor
            $target_file = $upload_dir . basename($image_name);

            // Convertir imagen a webp
            $image = imagecreatefromstring(file_get_contents($file_tmp));
            if ($image !== false) {
                $success = imagewebp($image, $target_file, 80); // 80 is the quality, you can adjust as needed
                imagedestroy($image);
                if (!$success) {
                    $message .= "Error al convertir la imagen $file_name a formato webp. ";
                }
            } else {
                $message .= "Error al cargar la imagen $file_name. ";
            }
        }
    }
    return $message;
}
?>
