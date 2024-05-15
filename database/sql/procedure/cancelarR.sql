DELIMITER //

CREATE PROCEDURE CancelarReserva(IN p_user_id INT, IN p_property_id INT)
BEGIN
    -- Eliminar el arriendo de la propiedad por el usuario actual
    DELETE FROM Reservacion WHERE id_usuario = p_user_id AND id_p_propiedad = p_property_id;
END //

DELIMITER ;