-- Sumar 1 Si se creo una propiedad

DELIMITER //

CREATE TRIGGER actualizar_total_propiedades_usuario
AFTER INSERT ON p_propiedad
FOR EACH ROW
BEGIN
    -- Incrementar el contador de propiedades del usuario
    UPDATE Usuario
    SET total_propiedades = total_propiedades + 1
    WHERE id_usuario = NEW.id_usuario;
END;
//

DELIMITER ;

-- Restar 1 si se elimino la propiedad
DELIMITER //

CREATE TRIGGER reducir_total_propiedades_usuario
AFTER DELETE ON p_propiedad
FOR EACH ROW
BEGIN
    -- Reducir el contador de propiedades del usuario
    UPDATE Usuario
    SET total_propiedades = total_propiedades - 1
    WHERE id_usuario = OLD.id_usuario;
END;
//

DELIMITER ;
