DELIMITER //

CREATE FUNCTION numero_total_propiedades_usuario (
    usuario_id INT
) RETURNS INT
deterministic
BEGIN
    DECLARE total_propiedades INT;
    
    SELECT COUNT(*) INTO total_propiedades
    FROM p_propiedad
    WHERE id_usuario = usuario_id;
    
    RETURN total_propiedades;
END //

DELIMITER ;