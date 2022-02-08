-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema ggg_db
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema ggg_db
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `ggg_db` DEFAULT CHARACTER SET utf8 ;
USE `ggg_db` ;

-- -----------------------------------------------------
-- Table `ggg_db`.`admin`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ggg_db`.`admin` (
  `admin_id` INT(11) NOT NULL AUTO_INCREMENT,
  `image_name` VARCHAR(300) NULL DEFAULT NULL,
  `name` VARCHAR(100) NOT NULL,
  `username` VARCHAR(100) NOT NULL,
  `password` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`admin_id`))
ENGINE = InnoDB
AUTO_INCREMENT = 18
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `ggg_db`.`trainer`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ggg_db`.`trainer` (
  `trainer_id` INT(11) NOT NULL AUTO_INCREMENT,
  `image_name` VARCHAR(300) NULL,
  `name` VARCHAR(100) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `phone` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`trainer_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `ggg_db`.`class`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ggg_db`.`class` (
  `class_id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `description` TEXT NOT NULL,
  `start_time` DATETIME NOT NULL,
  `end_time` DATETIME NOT NULL,
  `cost` DECIMAL(9,2) NOT NULL,
  `trainer_trainer_id` INT(11) NOT NULL,
  PRIMARY KEY (`class_id`, `trainer_trainer_id`),
  INDEX `fk_Member_has_trainer_trainer1_idx` (`trainer_trainer_id` ASC),
  CONSTRAINT `fk_Member_has_trainer_trainer1`
    FOREIGN KEY (`trainer_trainer_id`)
    REFERENCES `ggg_db`.`trainer` (`trainer_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `ggg_db`.`equipment`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ggg_db`.`equipment` (
  `equipment_id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `condition` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`equipment_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `ggg_db`.`plan`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ggg_db`.`plan` (
  `plan_id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `description` TEXT CHARACTER SET 'armscii8' NULL DEFAULT NULL,
  `duration` VARCHAR(12) NOT NULL,
  `cost` DECIMAL(9,2) NOT NULL,
  PRIMARY KEY (`plan_id`))
ENGINE = InnoDB
AUTO_INCREMENT = 7
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `ggg_db`.`member`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ggg_db`.`member` (
  `member_id` INT(11) NOT NULL AUTO_INCREMENT,
  `image_name` VARCHAR(500) NULL DEFAULT NULL,
  `name` VARCHAR(45) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `phone` VARCHAR(20) NOT NULL,
  `emergency_contact` VARCHAR(20) NOT NULL,
  `date_join` DATETIME NOT NULL,
  `member_status` VARCHAR(20) NOT NULL,
  `plan_plan_id` INT(11) NOT NULL,
  PRIMARY KEY (`member_id`),
  INDEX `fk_member_plan1_idx` (`plan_plan_id` ASC),
  CONSTRAINT `fk_member_plan1`
    FOREIGN KEY (`plan_plan_id`)
    REFERENCES `ggg_db`.`plan` (`plan_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `ggg_db`.`payment`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ggg_db`.`payment` (
  `payment_id` INT(11) NOT NULL AUTO_INCREMENT,
  `type` VARCHAR(20) NOT NULL,
  `card_number` VARCHAR(45) NOT NULL,
  `card_ccv` VARCHAR(45) NOT NULL,
  `card_expired` VARCHAR(45) NOT NULL,
  `amount` DECIMAL(9,2) NOT NULL,
  `date` DATETIME NOT NULL,
  PRIMARY KEY (`payment_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `ggg_db`.`invoice_payments`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ggg_db`.`invoice_payments` (
  `invoice_payments_id` INT(11) NOT NULL AUTO_INCREMENT,
  `payment_payment_id` INT(11) NOT NULL,
  PRIMARY KEY (`invoice_payments_id`, `payment_payment_id`),
  INDEX `fk_invoice_has_payment_payment1_idx` (`payment_payment_id` ASC),
  CONSTRAINT `fk_invoice_has_payment_payment1`
    FOREIGN KEY (`payment_payment_id`)
    REFERENCES `ggg_db`.`payment` (`payment_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `ggg_db`.`invoice`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ggg_db`.`invoice` (
  `invoice_id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `invoice_amount` DECIMAL(9,2) NOT NULL,
  `date` DATETIME NOT NULL,
  `due_date` DATETIME NOT NULL,
  `invoice_status` VARCHAR(45) NOT NULL,
  `member_member_id` INT(11) NOT NULL,
  `invoice_payments_invoice_payments_id` INT(11) NOT NULL,
  `invoice_payments_payment_payment_id` INT(11) NOT NULL,
  PRIMARY KEY (`invoice_id`),
  INDEX `fk_invoice_member1_idx` (`member_member_id` ASC),
  INDEX `fk_invoice_invoice_payments1_idx` (`invoice_payments_invoice_payments_id` ASC, `invoice_payments_payment_payment_id` ASC),
  CONSTRAINT `fk_invoice_member1`
    FOREIGN KEY (`member_member_id`)
    REFERENCES `ggg_db`.`member` (`member_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_invoice_invoice_payments1`
    FOREIGN KEY (`invoice_payments_invoice_payments_id` , `invoice_payments_payment_payment_id`)
    REFERENCES `ggg_db`.`invoice_payments` (`invoice_payments_id` , `payment_payment_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `ggg_db`.`member_has_class`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ggg_db`.`member_has_class` (
  `member_member_id` INT(11) NOT NULL,
  `class_class_id` INT(11) NOT NULL,
  `class_trainer_trainer_id` INT(11) NOT NULL,
  PRIMARY KEY (`member_member_id`, `class_class_id`, `class_trainer_trainer_id`),
  INDEX `fk_member_has_class_class1_idx` (`class_class_id` ASC, `class_trainer_trainer_id` ASC),
  INDEX `fk_member_has_class_member1_idx` (`member_member_id` ASC),
  CONSTRAINT `fk_member_has_class_member1`
    FOREIGN KEY (`member_member_id`)
    REFERENCES `ggg_db`.`member` (`member_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_member_has_class_class1`
    FOREIGN KEY (`class_class_id` , `class_trainer_trainer_id`)
    REFERENCES `ggg_db`.`class` (`class_id` , `trainer_trainer_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
