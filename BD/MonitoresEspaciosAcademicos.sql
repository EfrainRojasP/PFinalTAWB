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
-- Table `MonitoresEspaciosAcademicos`.`Actividad`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `MonitoresEspaciosAcademicos`.`Actividad` (
  `idActividad` INT NOT NULL AUTO_INCREMENT,
  `tipoActividad` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`idActividad`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `MonitoresEspaciosAcademicos`.`Nodo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `MonitoresEspaciosAcademicos`.`Nodo` (
  `idNodo` INT NOT NULL AUTO_INCREMENT,
  `rangoNodo` FLOAT NOT NULL,
  `Actividad_idActividad` INT NOT NULL,
  PRIMARY KEY (`idNodo`),
  INDEX `fk_Nodo_Actividad1_idx` (`Actividad_idActividad` ASC) VISIBLE,
  CONSTRAINT `fk_Nodo_Actividad1`
    FOREIGN KEY (`Actividad_idActividad`)
    REFERENCES `MonitoresEspaciosAcademicos`.`Actividad` (`idActividad`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
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
-- Table `MonitoresEspaciosAcademicos`.`LecturaNodo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `MonitoresEspaciosAcademicos`.`LecturaNodo` (
  `idLecturaNodo` INT NOT NULL AUTO_INCREMENT,
  `codicionLuz` FLOAT NOT NULL,
  `humedad` FLOAT NOT NULL,
  `temperatura` FLOAT NOT NULL,
  `duracionActividad` TIME NOT NULL,
  `Espacio_has_Nodo_idEHN` INT NOT NULL,
  PRIMARY KEY (`idLecturaNodo`),
  INDEX `fk_LecturaNodo_Espacio_has_Nodo1_idx` (`Espacio_has_Nodo_idEHN` ASC) VISIBLE,
  CONSTRAINT `fk_LecturaNodo_Espacio_has_Nodo1`
    FOREIGN KEY (`Espacio_has_Nodo_idEHN`)
    REFERENCES `MonitoresEspaciosAcademicos`.`Espacio_has_Nodo` (`idEHN`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;


INSERT INTO actividad(actividad.tipoActividad) VALUES ("Asesoria"), ("Redaccion de documentos");

DROP VIEW IF EXISTS Nodo_Actividad;
CREATE VIEW Nodo_Actividad AS SELECT n.idNodo, n.rangoNodo, a.idActividad, a.tipoActividad 
	FROM nodo n INNER JOIN actividad a ON n.Actividad_idActividad = a.idActividad;
    
SELECT * FROM nodo_actividad;
