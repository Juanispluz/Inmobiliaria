DELIMITER //

CREATE TRIGGER RestaurarUsuario
AFTER DELETE ON usuarios_eliminados
FOR EACH ROW
BEGIN
    INSERT INTO usuario (id_usuario, nombre, apellido, correo, telefono, contraseña)
    VALUES (OLD.id_usuario_eliminado, OLD.nombre, OLD.apellido, OLD.correo, OLD.telefono, OLD.contraseña);
END //

DELIMITER ;
