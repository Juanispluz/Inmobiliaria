// Mostrar los dos calendarios
function mostrarCalendarios(propertyId) {
    var calendarios = document.getElementById("calendarios_" + propertyId);
    if (calendarios.style.display === "none") {
        calendarios.style.display = "block";
    } else {
        calendarios.style.display = "none";
    }
}

// Función para cancelar el arriendo
function cancelarArriendo(propertyId) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../../php/global/config/cancelar_arriendo.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // Arriendo cancelado exitosamente
                alert(xhr.responseText);
                // Actualizar la página para reflejar los cambios
                location.reload();
            } else {
                // Error al cancelar el arriendo
                alert('Hubo un error al cancelar el arriendo.');
            }
        }
    };
    xhr.send("propertyId=" + propertyId);
}

// Función para arrendar la propiedad
function arrendarPropiedad(propertyId) {
    var fechaLlegada = document.getElementById("fecha_llegada_" + propertyId).value;
    var fechaSalida = document.getElementById("fecha_salida_" + propertyId).value;
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../../php/global/config/arrendar.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // Aquí puedes manejar la respuesta del servidor si es necesario
                alert(xhr.responseText);
                // Recargar la página después de arrendar la propiedad
                location.reload();
            } else {
                // Aquí puedes manejar errores si la solicitud falla
                alert('Hubo un error al procesar la solicitud.');
            }
        }
    };
    xhr.send("propertyId=" + propertyId + "&fechaLlegada=" + fechaLlegada + "&fechaSalida=" + fechaSalida);
}