DELIMITER //

CREATE PROCEDURE GuardarUsuarioEliminado(
    IN p_id_usuario INT,
    IN p_nombre VARCHAR(45),
    IN p_apellido VARCHAR(45),
    IN p_correo VARCHAR(200),
    IN p_telefono VARCHAR(20),
    IN p_contraseña VARCHAR(255)
)
BEGIN
    INSERT INTO usuarios_eliminados (id_usuario_eliminado, nombre, apellido, correo, telefono, contraseña, fecha_eliminacion)
    VALUES (p_id_usuario, p_nombre, p_apellido, p_correo, p_telefono, p_contraseña, NOW());
END //

DELIMITER ;