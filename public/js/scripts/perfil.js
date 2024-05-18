function confirmarEliminacion() {
    if (confirm('¿Estás seguro de que deseas eliminar tu cuenta?')) {
        window.location.href = '../../php/global/config/eliminarUP.php';
    }
}