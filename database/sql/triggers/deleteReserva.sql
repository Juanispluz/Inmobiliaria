DELIMITER //

CREATE TRIGGER eliminar_reservacion AFTER INSERT ON reservacion
FOR EACH ROW
BEGIN
    IF NEW.f_salida < NOW() THEN
        DELETE FROM reservacion WHERE id_reservacion = NEW.id_reservacion;
    END IF;
END;
//

DELIMITER ;


CALL eliminar_reservacion()