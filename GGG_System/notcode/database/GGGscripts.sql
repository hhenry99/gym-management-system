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
  `admin_photo_name` VARCHAR(300) NULL,
  `admin_name` VARCHAR(100) NOT NULL,
  `username` VARCHAR(100) NOT NULL,
  `password` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`admin_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `GGG_DB`.`plan`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `GGG_DB`.`plan` (
  `plan_id` INT NOT NULL AUTO_INCREMENT,
  `plan_name` VARCHAR(100) NOT NULL,
  `plan_description` TEXT CHARACTER SET 'armscii8' NULL,
  `plan_duration` INT NOT NULL,
  `plan_cost` DECIMAL(9,2) NOT NULL,
  `signup_fee` DECIMAL(9,2) NOT NULL,
  PRIMARY KEY (`plan_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `GGG_DB`.`equipment`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `GGG_DB`.`equipment` (
  `equipment_id` INT NOT NULL AUTO_INCREMENT,
  `equipment_name` VARCHAR(100) NOT NULL,
  `equipment_condition` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`equipment_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `GGG_DB`.`member`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `GGG_DB`.`member` (
  `member_id` INT NOT NULL AUTO_INCREMENT,
  `member_photo_name` VARCHAR(500) NULL,
  `member_first` VARCHAR(45) NOT NULL,
  `member_last` VARCHAR(45) NOT NULL,
  `member_email` VARCHAR(255) NOT NULL,
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
  `trainer_name` VARCHAR(100) NOT NULL,
  `trainer_email` VARCHAR(255) NOT NULL,
  `trainer_phone` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`trainer_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `GGG_DB`.`class`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `GGG_DB`.`class` (
  `class_id` INT NOT NULL AUTO_INCREMENT,
  `class_name` VARCHAR(45) NOT NULL,
  `class_description` TEXT NOT NULL,
  `class_time_start` DATETIME NOT NULL,
  `class_time_end` DATETIME NOT NULL,
  `Member_member_id` INT NOT NULL,
  `trainer_trainer_id` INT NOT NULL,
  `class_cost` DECIMAL(9,2) NOT NULL,
  PRIMARY KEY (`class_id`, `Member_member_id`, `trainer_trainer_id`),
  INDEX `fk_Member_has_trainer_trainer1_idx` (`trainer_trainer_id` ASC),
  INDEX `fk_Member_has_trainer_Member1_idx` (`Member_member_id` ASC),
  CONSTRAINT `fk_Member_has_trainer_Member1`
    FOREIGN KEY (`Member_member_id`)
    REFERENCES `GGG_DB`.`member` (`member_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Member_has_trainer_trainer1`
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
  `invoice_name` VARCHAR(100) NOT NULL,
  `invoice_amount` DECIMAL(9,2) NOT NULL,
  `invoice_date` DATETIME NOT NULL,
  `invoice_due_date` DATETIME NOT NULL,
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
  `payment_amount` DECIMAL(9,2) NOT NULL,
  `payment_date` DATETIME NOT NULL,
  PRIMARY KEY (`payment_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `GGG_DB`.`invoice_payments`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `GGG_DB`.`invoice_payments` (
  `invoice_payments_id` INT NOT NULL AUTO_INCREMENT,
  `invoice_invoice_id` INT NOT NULL,
  `payment_payment_id` INT NOT NULL,
  `invoice_amount` DECIMAL(9,2) NOT NULL,
  `payment_amount` DECIMAL(9,2) NOT NULL,
  `amount_due` DECIMAL(9,2) NOT NULL,
  PRIMARY KEY (`invoice_payments_id`, `invoice_invoice_id`, `payment_payment_id`),
  INDEX `fk_invoice_has_payment_payment1_idx` (`payment_payment_id` ASC),
  INDEX `fk_invoice_has_payment_invoice1_idx` (`invoice_invoice_id` ASC),
  CONSTRAINT `fk_invoice_has_payment_invoice1`
    FOREIGN KEY (`invoice_invoice_id`)
    REFERENCES `GGG_DB`.`invoice` (`invoice_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_invoice_has_payment_payment1`
    FOREIGN KEY (`payment_payment_id`)
    REFERENCES `GGG_DB`.`payment` (`payment_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
