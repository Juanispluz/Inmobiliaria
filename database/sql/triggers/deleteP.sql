-- Eliminar propiedad

DELIMITER //

CREATE TRIGGER eliminar_propiedad_trigger
AFTER DELETE ON usuario
FOR EACH ROW
BEGIN
    DECLARE property_id INT;

    -- Obtener el ID de la propiedad asociada al usuario que se está eliminando
    SELECT id_p_propiedad INTO property_id FROM p_propiedad WHERE id_usuario = OLD.id_usuario;

    -- Eliminar las reservaciones asociadas a esta propiedad
    DELETE FROM reservacion WHERE id_p_propiedad = property_id;

    -- Eliminar los servicios asociados a esta propiedad
    DELETE FROM servicios WHERE id_p_propiedad = property_id;

    -- Finalmente, eliminar la propiedad
    DELETE FROM p_propiedad WHERE id_p_propiedad = property_id;
END //

DELIMITER ;
