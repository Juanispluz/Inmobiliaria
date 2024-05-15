--obtener reservaciones de user
DELIMITER //

CREATE PROCEDURE ObtenerReservacionesUsuario (
    IN usuario_id INT
)
BEGIN
    SELECT * FROM reservacion WHERE id_usuario = usuario_id;
END //

DELIMITER ;
