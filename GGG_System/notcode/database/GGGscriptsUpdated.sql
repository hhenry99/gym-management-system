-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema GGG_DB
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema GGG_DB
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `GGG_DB` DEFAULT CHARACTER SET utf8 ;
USE `GGG_DB` ;

-- -----------------------------------------------------
-- Table `GGG_DB`.`admin`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `GGG_DB`.`admin` (
  `admin_id` INT NOT NULL AUTO_INCREMENT,
  `image_name` VARCHAR(300) NULL,
  `name` VARCHAR(100) NOT NULL,
  `username` VARCHAR(100) NOT NULL,
  `password` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`admin_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `GGG_DB`.`plan`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `GGG_DB`.`plan` (
  `plan_id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `description` TEXT CHARACTER SET 'armscii8' NULL,
  `duration` INT NOT NULL,
  `cost` DECIMAL(9,2) NOT NULL,
  PRIMARY KEY (`plan_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `GGG_DB`.`equipment`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `GGG_DB`.`equipment` (
  `equipment_id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `cond` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`equipment_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `GGG_DB`.`member`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `GGG_DB`.`member` (
  `member_id` INT NOT NULL AUTO_INCREMENT,
  `image_name` VARCHAR(500) NULL,
  `name` VARCHAR(100) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `phone` VARCHAR(20) NOT NULL,
  `emergency_contact` VARCHAR(20) NOT NULL,
  `date_join` DATETIME NOT NULL,
  `member_status` VARCHAR(20) NOT NULL,
  `plan_plan_id` INT NOT NULL,
  PRIMARY KEY (`member_id`),
  INDEX `fk_member_plan1_idx` (`plan_plan_id` ASC),
  CONSTRAINT `fk_member_plan1`
    FOREIGN KEY (`plan_plan_id`)
    REFERENCES `GGG_DB`.`plan` (`plan_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `GGG_DB`.`trainer`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `GGG_DB`.`trainer` (
  `trainer_id` INT NOT NULL AUTO_INCREMENT,
  `image_name` VARCHAR(500) NULL,
  `name` VARCHAR(100) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `phone` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`trainer_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `GGG_DB`.`class`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `GGG_DB`.`class` (
  `class_id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `description` TEXT NOT NULL,
  `start_end` TEXT NOT NULL,
  `cost` DECIMAL(9,2) NOT NULL,
  `trainer_trainer_id` INT NOT NULL,
  PRIMARY KEY (`class_id`),
  INDEX `fk_class_trainer1_idx` (`trainer_trainer_id` ASC),
  CONSTRAINT `fk_class_trainer1`
    FOREIGN KEY (`trainer_trainer_id`)
    REFERENCES `GGG_DB`.`trainer` (`trainer_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `GGG_DB`.`invoice`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `GGG_DB`.`invoice` (
  `invoice_id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `amount` DECIMAL(9,2) NOT NULL,
  `date` DATETIME NOT NULL,
  `due_date` DATETIME NOT NULL,
  `invoice_status` VARCHAR(45) NOT NULL,
  `member_member_id` INT NOT NULL,
  PRIMARY KEY (`invoice_id`),
  INDEX `fk_invoice_member1_idx` (`member_member_id` ASC),
  CONSTRAINT `fk_invoice_member1`
    FOREIGN KEY (`member_member_id`)
    REFERENCES `GGG_DB`.`member` (`member_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `GGG_DB`.`payment`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `GGG_DB`.`payment` (
  `payment_id` INT NOT NULL AUTO_INCREMENT,
  `payment_type` VARCHAR(20) NOT NULL,
  `card_number` VARCHAR(45) NOT NULL,
  `card_ccv` VARCHAR(45) NOT NULL,
  `card_expired` DATE NOT NULL,
  `payment_amount` DECIMAL(9,2) NOT NULL,
  `payment_date` DATETIME NOT NULL,
  `invoice_invoice_id` INT NOT NULL,
  PRIMARY KEY (`payment_id`),
  INDEX `fk_payment_invoice1_idx` (`invoice_invoice_id` ASC),
  CONSTRAINT `fk_payment_invoice1`
    FOREIGN KEY (`invoice_invoice_id`)
    REFERENCES `GGG_DB`.`invoice` (`invoice_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `GGG_DB`.`member_has_class`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `GGG_DB`.`member_has_class` (
  `member_member_id` INT NOT NULL,
  `class_class_id` INT NOT NULL,
  PRIMARY KEY (`member_member_id`, `class_class_id`),
  INDEX `fk_member_has_class_class1_idx` (`class_class_id` ASC),
  INDEX `fk_member_has_class_member1_idx` (`member_member_id` ASC),
  CONSTRAINT `fk_member_has_class_member1`
    FOREIGN KEY (`member_member_id`)
    REFERENCES `GGG_DB`.`member` (`member_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_member_has_class_class1`
    FOREIGN KEY (`class_class_id`)
    REFERENCES `GGG_DB`.`class` (`class_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
