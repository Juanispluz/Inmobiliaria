DELIMITER //

CREATE PROCEDURE ReservarPropiedad (
    IN usuario_id INT,
    IN propiedad_id INT,
    IN fecha_llegada DATETIME,
    IN fecha_salida DATETIME
)
BEGIN
    -- Insertar una nueva reservación para el usuario y la propiedad específicos
    INSERT INTO reservacion (id_usuario, id_p_propiedad, f_llegada, f_salida)
    VALUES (usuario_id, propiedad_id, fecha_llegada, fecha_salida);
END //

DELIMITER ;
