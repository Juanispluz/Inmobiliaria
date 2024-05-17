CREATE DATABASE imcbd2;
USE imcbd2;

-- Crear tablas
CREATE TABLE ciudad (
  id_ciudad int(11) NOT NULL AUTO_INCREMENT,
  n_ciudad varchar(50) DEFAULT NULL,
  PRIMARY KEY (id_ciudad)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE departamentos (
  id_departamento int(11) NOT NULL AUTO_INCREMENT,
  n_departamento varchar(20) DEFAULT NULL,
  PRIMARY KEY (id_departamento)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE usuario (
  id_usuario int(11) NOT NULL AUTO_INCREMENT,
  nombre varchar(45) DEFAULT NULL,
  apellido varchar(45) DEFAULT NULL,
  correo varchar(200) DEFAULT NULL,
  telefono varchar(20) DEFAULT NULL,
  contraseña varchar(255) DEFAULT NULL,
  PRIMARY KEY (id_usuario)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE t_propiedades (
  id_t_propiedad int(11) NOT NULL AUTO_INCREMENT,
  tipo_propiedad varchar(50) DEFAULT NULL,
  PRIMARY KEY (id_t_propiedad)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE universidad (
  id_universidad int(11) NOT NULL AUTO_INCREMENT,
  nombreU varchar(100) DEFAULT NULL,
  PRIMARY KEY (id_universidad)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE universitario (
  id_universitario int(11) NOT NULL AUTO_INCREMENT,
  id_universidad int(11) DEFAULT NULL,
  id_usuario int(11) DEFAULT NULL,
  PRIMARY KEY (id_universitario),
  KEY id_universidad (id_universidad),
  KEY id_usuario (id_usuario)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE p_propiedad (
  id_p_propiedad int(11) NOT NULL AUTO_INCREMENT,
  id_usuario int(11) DEFAULT NULL,
  titulo varchar(200) DEFAULT NULL,
  descripcion text NOT NULL,
  precio bigint(20) DEFAULT NULL,
  direccion varchar(255) DEFAULT NULL,
  id_departamento int(11) DEFAULT NULL,
  id_ciudad int(11) DEFAULT NULL,
  id_t_propiedad int(11) DEFAULT NULL,
  metros_cuadrados int(11) DEFAULT NULL,
  PRIMARY KEY (id_p_propiedad),
  KEY id_usuario (id_usuario),
  KEY id_departamento (id_departamento),
  KEY id_ciudad (id_ciudad),
  KEY id_t_propiedad (id_t_propiedad)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE reservacion (
  id_reservacion int(11) NOT NULL AUTO_INCREMENT,
  id_usuario int(11) DEFAULT NULL,
  id_p_propiedad int(11) DEFAULT NULL,
  f_llegada datetime DEFAULT NULL,
  f_salida datetime DEFAULT NULL,
  PRIMARY KEY (id_reservacion),
  KEY id_usuario (id_usuario),
  KEY id_p_propiedad (id_p_propiedad)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE servicios (
  id_p_propiedad int(11) NOT NULL,
  agua tinyint(4) DEFAULT NULL,
  amoblado tinyint(4) DEFAULT NULL,
  luz tinyint(4) DEFAULT NULL,
  gas tinyint(4) DEFAULT NULL,
  internet tinyint(4) DEFAULT NULL,
  PRIMARY KEY (id_p_propiedad)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Inserciones para la tabla universidad
INSERT INTO universidad (id_universidad, nombreU) VALUES
(1, 'UCC'),
(2, 'UdeA');

-- Inserciones para la tabla ciudad
INSERT INTO ciudad (id_ciudad, n_ciudad) VALUES
(1, 'Medellín'),
(2, 'Marinilla');

-- Inserciones para la tabla departamentos
INSERT INTO departamentos (id_departamento, n_departamento) VALUES
(1, 'Antioquia'),
(2, 'Cundinamarca');

-- Inserciones para la tabla t_propiedades
INSERT INTO t_propiedades (id_t_propiedad, tipo_propiedad) VALUES
(1, 'Apartamento');

ALTER TABLE Usuario ADD COLUMN total_propiedades INT DEFAULT 0;