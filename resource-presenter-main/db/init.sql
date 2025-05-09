-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';


-- -----------------------------------------------------
-- Schema resPre
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `resPre` ;
CREATE SCHEMA IF NOT EXISTS resPre DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci ;
USE `resPre`;

-- -----------------------------------------------------
-- Table `resPre`.`countries`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `resPre`.`countries` ;

CREATE TABLE IF NOT EXISTS `resPre`.`countries` (
    `id` INT NOT NULL,
    `name` VARCHAR(45) NOT NULL,
    `region` VARCHAR(45) NOT NULL,
    `longitude` DECIMAL(10,8) NOT NULL,
    `latitude` DECIMAL(10,8) NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `name_UNIQUE` (`name` ASC)
    ) ENGINE = InnoDB
    DEFAULT CHARACTER SET = utf8mb4
    COLLATE = utf8mb4_0900_ai_ci;

-- -----------------------------------------------------
-- Table `resPre`.`conflicts`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `resPre`.`conflicts` ;

CREATE TABLE IF NOT EXISTS `resPre`.`conflicts` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(32) NOT NULL,
  `start_date` DATE NOT NULL,
  `end_date` DATE NULL DEFAULT NULL,
  `longitude` DECIMAL(10,8) NOT NULL,
  `latitude` DECIMAL(10,8) NOT NULL,
  `countries_id` INT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_conflicts_countries1_idx` (`countries_id` ASC) VISIBLE,
  CONSTRAINT `fk_conflicts_countries1`
    FOREIGN KEY (`countries_id`)
    REFERENCES `resPre`.`countries` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;

-- -----------------------------------------------------
-- Table `resPre`.`units`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `resPre`.`units` ;

CREATE TABLE IF NOT EXISTS `resPre`.`units` (
  `id` INT NOT NULL,
  `unit` VARCHAR(32) NOT NULL,
    PRIMARY KEY (`id`),
UNIQUE INDEX `unit_UNIQUE` (`unit` ASC) VISIBLE)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `resPre`.`resources`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `resPre`.`resources` ;

CREATE TABLE IF NOT EXISTS `resPre`.`resources` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(16) NOT NULL,
    `description` TEXT NULL,
    `unit_id` INT NOT NULL,
  PRIMARY KEY (`id`),
    INDEX `fk_resources_table11_idx` (`unit_id` ASC) VISIBLE,
    CONSTRAINT `fk_resources_table11`
    FOREIGN KEY (`unit_id`)
    REFERENCES `resPre`.`units` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `resPre`.`conflict_resource_impact`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `resPre`.`conflict_resource_impact` ;

CREATE TABLE IF NOT EXISTS `resPre`.`conflict_resource_impact` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `conflict_id` INT NOT NULL,
  `resource_id` INT NOT NULL,
  `impact_type` VARCHAR(32) NULL DEFAULT NULL,
  `description` TEXT NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `conflict_id` (`conflict_id` ASC) VISIBLE,
  INDEX `resource_id` (`resource_id` ASC) VISIBLE,
  CONSTRAINT `conflict_resource_impact_ibfk_1`
    FOREIGN KEY (`conflict_id`)
    REFERENCES `resPre`.`conflicts` (`id`),
  CONSTRAINT `conflict_resource_impact_ibfk_2`
    FOREIGN KEY (`resource_id`)
    REFERENCES `resPre`.`resources` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `resPre`.`resource_prices`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `resPre`.`resource_prices` ;

CREATE TABLE IF NOT EXISTS `resPre`.`resource_prices` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `resource_id` INT NOT NULL,
  `date` DATE NOT NULL,
  `price` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `resource_id` (`resource_id` ASC) VISIBLE,
  CONSTRAINT `resource_prices_ibfk_1`
    FOREIGN KEY (`resource_id`)
    REFERENCES `resPre`.`resources` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;


CREATE USER IF NOT EXISTS 'user'@'%' IDENTIFIED WITH mysql_native_password BY 'userPass';
GRANT PROCESS, REPLICATION CLIENT, SELECT ON *.* TO 'user'@'%';
GRANT SELECT, INSERT, UPDATE, DELETE ON resPre.* TO 'user'@'%';
FLUSH PRIVILEGES;
