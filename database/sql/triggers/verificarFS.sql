DELIMITER //

CREATE TRIGGER verificar_fechas_reservacion
BEFORE INSERT ON reservacion
FOR EACH ROW
BEGIN
    IF NEW.f_llegada >= NEW.f_salida THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'La fecha de llegada debe ser anterior a la fecha de salida';
    END IF;
END;
//

DELIMITER ;

-- Para el usuario que vaya arrendar