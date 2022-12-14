-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema MonitoresEspaciosAcademicos
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema MonitoresEspaciosAcademicos
-- -----------------------------------------------------
DROP DATABASE IF EXISTS MonitoresEspaciosAcademicos;
CREATE SCHEMA IF NOT EXISTS `MonitoresEspaciosAcademicos` DEFAULT CHARACTER SET utf8 ;
USE `MonitoresEspaciosAcademicos` ;

-- -----------------------------------------------------
-- Table `MonitoresEspaciosAcademicos`.`Edificio`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `MonitoresEspaciosAcademicos`.`Edificio` (
  `idEdificio` INT NOT NULL AUTO_INCREMENT,
  `nombreEdificio` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idEdificio`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `MonitoresEspaciosAcademicos`.`Espacio`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `MonitoresEspaciosAcademicos`.`Espacio` (
  `idEspacio` INT NOT NULL AUTO_INCREMENT,
  `numeroEspacio` INT NOT NULL,
  `Edificio_idEdificio` INT NOT NULL,
  PRIMARY KEY (`idEspacio`),
  INDEX `fk_Espacio_Edificio_idx` (`Edificio_idEdificio` ASC) VISIBLE,
  CONSTRAINT `fk_Espacio_Edificio`
    FOREIGN KEY (`Edificio_idEdificio`)
    REFERENCES `MonitoresEspaciosAcademicos`.`Edificio` (`idEdificio`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `MonitoresEspaciosAcademicos`.`Nodo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `MonitoresEspaciosAcademicos`.`Nodo` (
  `idNodo` INT NOT NULL AUTO_INCREMENT,
  `rangoNodo` FLOAT NOT NULL,
  PRIMARY KEY (`idNodo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `MonitoresEspaciosAcademicos`.`Actividad`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `MonitoresEspaciosAcademicos`.`Actividad` (
  `idActividad` INT NOT NULL AUTO_INCREMENT,
  `tipoActividad` VARCHAR(100) NULL,
  PRIMARY KEY (`idActividad`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `MonitoresEspaciosAcademicos`.`Espacio_has_Nodo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `MonitoresEspaciosAcademicos`.`Espacio_has_Nodo` (
  `idEHN` INT NOT NULL AUTO_INCREMENT,
  `Espacio_idEspacio` INT NOT NULL,
  `Nodo_idNodo` INT NOT NULL,
  INDEX `fk_Espacio_has_Nodo_Nodo1_idx` (`Nodo_idNodo` ASC) VISIBLE,
  INDEX `fk_Espacio_has_Nodo_Espacio1_idx` (`Espacio_idEspacio` ASC) VISIBLE,
  PRIMARY KEY (`idEHN`),
  CONSTRAINT `fk_Espacio_has_Nodo_Espacio1`
    FOREIGN KEY (`Espacio_idEspacio`)
    REFERENCES `MonitoresEspaciosAcademicos`.`Espacio` (`idEspacio`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Espacio_has_Nodo_Nodo1`
    FOREIGN KEY (`Nodo_idNodo`)
    REFERENCES `MonitoresEspaciosAcademicos`.`Nodo` (`idNodo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `MonitoresEspaciosAcademicos`.`Actividad_has_Espacio_has_Nodo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `MonitoresEspaciosAcademicos`.`Actividad_has_Espacio_has_Nodo` (
  `idAHEHN` INT NOT NULL AUTO_INCREMENT,
  `Actividad_idActividad` INT NOT NULL,
  `Espacio_has_Nodo_idEHN` INT NOT NULL,
  `fechaLectura` DATETIME NOT NULL,
  INDEX `fk_Actividad_has_Espacio_has_Nodo_Espacio_has_Nodo1_idx` (`Espacio_has_Nodo_idEHN` ASC) VISIBLE,
  INDEX `fk_Actividad_has_Espacio_has_Nodo_Actividad1_idx` (`Actividad_idActividad` ASC) VISIBLE,
  PRIMARY KEY (`idAHEHN`),
  CONSTRAINT `fk_Actividad_has_Espacio_has_Nodo_Actividad1`
    FOREIGN KEY (`Actividad_idActividad`)
    REFERENCES `MonitoresEspaciosAcademicos`.`Actividad` (`idActividad`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Actividad_has_Espacio_has_Nodo_Espacio_has_Nodo1`
    FOREIGN KEY (`Espacio_has_Nodo_idEHN`)
    REFERENCES `MonitoresEspaciosAcademicos`.`Espacio_has_Nodo` (`idEHN`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `MonitoresEspaciosAcademicos`.`LecturaNodo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `MonitoresEspaciosAcademicos`.`LecturaNodo` (
  `idLecturaNodo` INT NOT NULL AUTO_INCREMENT,
  `codicionLuz` FLOAT NOT NULL,
  `humedad` FLOAT NOT NULL,
  `temperatura` FLOAT NOT NULL,
  `Actividad_has_Espacio_has_Nodo_idAHEHN` INT NOT NULL,
  PRIMARY KEY (`idLecturaNodo`),
  INDEX `fk_LecturaNodo_Actividad_has_Espacio_has_Nodo1_idx` (`Actividad_has_Espacio_has_Nodo_idAHEHN` ASC) VISIBLE,
  CONSTRAINT `fk_LecturaNodo_Actividad_has_Espacio_has_Nodo1`
    FOREIGN KEY (`Actividad_has_Espacio_has_Nodo_idAHEHN`)
    REFERENCES `MonitoresEspaciosAcademicos`.`Actividad_has_Espacio_has_Nodo` (`idAHEHN`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

--
-- Vista de los espacios con sus respenctivos edificios
--
DROP VIEW IF EXISTS espacio_edificio;
CREATE VIEW espacio_edificio AS SELECT esp.idEspacio, esp.numeroEspacio, edi.idEdificio, edi.nombreEdificio FROM monitoresespaciosacademicos.espacio esp 
	INNER JOIN monitoresespaciosacademicos.edificio edi
		ON esp.Edificio_idEdificio = edi.idEdificio;

--
	-- Vista de los espacios con sus respectivos nodos
--
DROP VIEW IF EXISTS espacio_nodo;        
CREATE VIEW espacio_nodo AS SELECT esh.idEHN, esp.idEspacio, nodo.idNodo, nodo.rangoNodo FROM monitoresespaciosacademicos.espacio esp 
	INNER JOIN monitoresespaciosacademicos.espacio_has_nodo esh
		ON esp.idEspacio = esh.Espacio_idEspacio
	INNER JOIN monitoresespaciosacademicos.nodo nodo
		ON nodo.idNodo = esh.Nodo_idNodo;


--
	-- Vista que da el nodo y el edificio de cada espacio
--

DROP VIEW IF EXISTS espacio_edificio_nodo;
CREATE VIEW espacio_edificio_nodo AS 
	SELECT esh.idEHN, esp.idEspacio, esp.numeroEspacio, edi.idEdificio, edi.nombreEdificio, nodo.idNodo, nodo.rangoNodo FROM monitoresespaciosacademicos.espacio esp 
		INNER JOIN monitoresespaciosacademicos.espacio_has_nodo esh
			ON esp.idEspacio = esh.Espacio_idEspacio
		INNER JOIN monitoresespaciosacademicos.nodo nodo
			ON nodo.idNodo = esh.Nodo_idNodo
		INNER JOIN monitoresespaciosacademicos.edificio edi
			ON esp.Edificio_idEdificio = edi.idEdificio;

--
	-- Vista para el promedio
--
DROP VIEW IF EXISTS lecturaPromedio;
CREATE VIEW lecturaPromedio AS 
	SELECT TRUNCATE(AVG(codicionLuz), 2) AS PLuz, TRUNCATE(AVG(humedad), 2) AS PHum, TRUNCATE(AVG(temperatura), 2) AS PTem, 
		TRUNCATE(COUNT(Actividad_has_Espacio_has_Nodo_idAHEHN) / 10, 2) AS PHoras, Actividad_has_Espacio_has_Nodo_idAHEHN
		FROM lecturanodo GROUP BY  Actividad_has_Espacio_has_Nodo_idAHEHN;


INSERT INTO actividad(actividad.tipoActividad) VALUES ("Preparacion de clase"), ("Asesoria"), ("Redaccion de documentos");

INSERT INTO edificio(edificio.nombreEdificio) VALUES ("A"), ("B"), ("C"), ("D");

INSERT INTO nodo(nodo.rangoNodo) VALUES (10), (9), (8), (7), (6);

INSERT INTO espacio(espacio.numeroEspacio, espacio.Edificio_idEdificio) VALUES (12, 1), (157, 2), (47, 4);

INSERT INTO espacio_has_nodo(espacio_has_nodo.Espacio_idEspacio, espacio_has_nodo.Nodo_idNodo) 
	VALUES (1, 1), (1, 3), (1, 4);
    
INSERT INTO espacio_has_nodo(espacio_has_nodo.Espacio_idEspacio, espacio_has_nodo.Nodo_idNodo) 
	VALUES (2, 2), (2, 4), (2, 5);

INSERT INTO espacio_has_nodo(espacio_has_nodo.Espacio_idEspacio, espacio_has_nodo.Nodo_idNodo) 
	VALUES (3, 1), (3, 2), (3, 5);