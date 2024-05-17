DELIMITER //

CREATE FUNCTION ObtenerDetallesPropiedad(property_id INT) RETURNS VARCHAR(1000)
BEGIN
    DECLARE property_details VARCHAR(1000);
    
    SELECT CONCAT(
        'Título: ', titulo, '\n',
        'Descripción: ', descripcion, '\n',
        'Precio: ', precio, '\n',
        'Dirección: ', direccion, '\n',
        'Departamento: ', (SELECT n_departamento FROM departamentos WHERE id_departamento = p_propiedad.id_departamento), '\n',
        'Ciudad: ', (SELECT n_ciudad FROM ciudad WHERE id_ciudad = p_propiedad.id_ciudad), '\n',
        'Tipo de Propiedad: ', (SELECT tipo_propiedad FROM t_propiedades WHERE id_t_propiedad = p_propiedad.id_t_propiedad), '\n',
        'Metros Cuadrados: ', metros_cuadrados, '\n',
        'Publicado por: ', (SELECT nombre FROM usuario WHERE id_usuario = p_propiedad.id_usuario), '\n',
        'Servicios:\n',
        'Agua: ', IFNULL((SELECT agua FROM servicios WHERE id_p_propiedad = property_id), 'No especificado'), '\n',
        'Amoblado: ', IFNULL((SELECT amoblado FROM servicios WHERE id_p_propiedad = property_id), 'No especificado'), '\n',
        'Luz: ', IFNULL((SELECT luz FROM servicios WHERE id_p_propiedad = property_id), 'No especificado'), '\n',
        'Gas: ', IFNULL((SELECT gas FROM servicios WHERE id_p_propiedad = property_id), 'No especificado'), '\n',
        'Internet: ', IFNULL((SELECT internet FROM servicios WHERE id_p_propiedad = property_id), 'No especificado'), '\n'
    )
    INTO property_details
    FROM p_propiedad
    WHERE id_p_propiedad = property_id;

    RETURN property_details;
END //

DELIMITER ;

-- No esta implementado