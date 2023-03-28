
-- Creación de la tabla departamentos
CREATE TABLE IF NOT EXISTS departamentos (
  idDepartamento INT NOT NULL AUTO_INCREMENT,
  descripcion VARCHAR(100) NOT NULL,
  activo TINYINT(1) NOT NULL DEFAULT 1,
  fechaCreacion DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  fechaActualizacion DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  idEmpActualiza INT NULL DEFAULT 1,
  PRIMARY KEY (idDepartamento))
ENGINE = InnoDB

