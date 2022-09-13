-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `MonitoresEspaciosAcademicos` DEFAULT CHARACTER SET utf8 ;
USE `MonitoresEspaciosAcademicos` ;

-- -----------------------------------------------------
-- Table `mydb`.`Edificio`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Edificio` (
  `idEdificio` INT NOT NULL,
  `nombreEdificio` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idEdificio`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Espacio`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Espacio` (
  `idEspacio` INT NOT NULL,
  `numeroEspacio` INT NOT NULL,
  `Edificio_idEdificio` INT NOT NULL,
  PRIMARY KEY (`idEspacio`),
  INDEX `fk_Espacio_Edificio_idx` (`Edificio_idEdificio` ASC) VISIBLE,
  CONSTRAINT `fk_Espacio_Edificio`
    FOREIGN KEY (`Edificio_idEdificio`)
    REFERENCES `mydb`.`Edificio` (`idEdificio`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Actividad`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Actividad` (
  `idActividad` INT NOT NULL,
  `tipoActividad` VARCHAR(100) NULL,
  PRIMARY KEY (`idActividad`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Nodo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Nodo` (
  `idNodo` INT NOT NULL,
  `rangoNodo` FLOAT NOT NULL,
  `Actividad_idActividad` INT NOT NULL,
  PRIMARY KEY (`idNodo`),
  INDEX `fk_Nodo_Actividad1_idx` (`Actividad_idActividad` ASC) VISIBLE,
  CONSTRAINT `fk_Nodo_Actividad1`
    FOREIGN KEY (`Actividad_idActividad`)
    REFERENCES `mydb`.`Actividad` (`idActividad`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Espacio_has_Nodo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Espacio_has_Nodo` (
  `idEHN` INT NOT NULL,
  `Espacio_idEspacio` INT NOT NULL,
  `Nodo_idNodo` INT NOT NULL,
  INDEX `fk_Espacio_has_Nodo_Nodo1_idx` (`Nodo_idNodo` ASC) VISIBLE,
  INDEX `fk_Espacio_has_Nodo_Espacio1_idx` (`Espacio_idEspacio` ASC) VISIBLE,
  PRIMARY KEY (`idEHN`),
  CONSTRAINT `fk_Espacio_has_Nodo_Espacio1`
    FOREIGN KEY (`Espacio_idEspacio`)
    REFERENCES `mydb`.`Espacio` (`idEspacio`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Espacio_has_Nodo_Nodo1`
    FOREIGN KEY (`Nodo_idNodo`)
    REFERENCES `mydb`.`Nodo` (`idNodo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`LecturaNodo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`LecturaNodo` (
  `idLecturaNodo` INT NOT NULL,
  `codicionLuz` FLOAT NOT NULL,
  `humedad` FLOAT NOT NULL,
  `temperatura` FLOAT NOT NULL,
  `duracionActividad` TIME NOT NULL,
  `Espacio_has_Nodo_idEHN` INT NOT NULL,
  PRIMARY KEY (`idLecturaNodo`),
  INDEX `fk_LecturaNodo_Espacio_has_Nodo1_idx` (`Espacio_has_Nodo_idEHN` ASC) VISIBLE,
  CONSTRAINT `fk_LecturaNodo_Espacio_has_Nodo1`
    FOREIGN KEY (`Espacio_has_Nodo_idEHN`)
    REFERENCES `mydb`.`Espacio_has_Nodo` (`idEHN`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
