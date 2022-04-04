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
  `num` INT NOT NULL,
  `name` VARCHAR(100) NOT NULL,
  `cond` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`equipment_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `GGG_DB`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `GGG_DB`.`user` (
  `user_id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `role` INT NOT NULL,
  `image_name` VARCHAR(300) NULL,
  `name` VARCHAR(100) NULL,
  `phone` VARCHAR(20) NULL,
  `emergency_contact` VARCHAR(20) NULL,
  `email` VARCHAR(255) NULL,
  `account_date_created` DATETIME NULL,
  `status` INT NULL,
  PRIMARY KEY (`user_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `GGG_DB`.`class`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `GGG_DB`.`class` (
  `class_id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `description` TEXT NOT NULL,
  `location` VARCHAR(200) NOT NULL,
  `start_end` TEXT NOT NULL,
  `cost` DECIMAL(9,2) NOT NULL,
  `user_user_id` INT NOT NULL,
  PRIMARY KEY (`class_id`),
  INDEX `fk_class_user1_idx` (`user_user_id` ASC),
  CONSTRAINT `fk_class_user1`
    FOREIGN KEY (`user_user_id`)
    REFERENCES `GGG_DB`.`user` (`user_id`)
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
  `date_created` DATETIME NOT NULL,
  `due_date` DATETIME NOT NULL,
  `amount_paid` DECIMAL(9,2) NOT NULL,
  `user_user_id` INT NOT NULL,
  PRIMARY KEY (`invoice_id`),
  INDEX `fk_invoice_user1_idx` (`user_user_id` ASC),
  CONSTRAINT `fk_invoice_user1`
    FOREIGN KEY (`user_user_id`)
    REFERENCES `GGG_DB`.`user` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `GGG_DB`.`payment`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `GGG_DB`.`payment` (
  `payment_id` INT NOT NULL AUTO_INCREMENT,
  `card_number` VARCHAR(45) NOT NULL,
  `card_ccv` VARCHAR(45) NOT NULL,
  `card_expired` VARCHAR(5) NOT NULL,
  `payment_amount` DECIMAL(9,2) NOT NULL,
  `payment_date` DATETIME NOT NULL,
  `invoice_invoice_id` INT NOT NULL,
  PRIMARY KEY (`payment_id`, `invoice_invoice_id`),
  INDEX `fk_payment_invoice1_idx` (`invoice_invoice_id` ASC),
  CONSTRAINT `fk_payment_invoice1`
    FOREIGN KEY (`invoice_invoice_id`)
    REFERENCES `GGG_DB`.`invoice` (`invoice_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `GGG_DB`.`registration`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `GGG_DB`.`registration` (
  `regist_id` INT NOT NULL AUTO_INCREMENT,
  `plan_expired` DATETIME NULL,
  `plan_start` DATETIME NULL,
  `plan_plan_id` INT NOT NULL,
  `user_user_id` INT NOT NULL,
  `class_class_id` INT NOT NULL,
  PRIMARY KEY (`regist_id`),
  INDEX `fk_registration_plan1_idx` (`plan_plan_id` ASC),
  INDEX `fk_registration_user1_idx` (`user_user_id` ASC),
  INDEX `fk_registration_class1_idx` (`class_class_id` ASC),
  CONSTRAINT `fk_registration_plan1`
    FOREIGN KEY (`plan_plan_id`)
    REFERENCES `GGG_DB`.`plan` (`plan_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_registration_user1`
    FOREIGN KEY (`user_user_id`)
    REFERENCES `GGG_DB`.`user` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_registration_class1`
    FOREIGN KEY (`class_class_id`)
    REFERENCES `GGG_DB`.`class` (`class_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

INSERT INTO user (username, password, role, name) VALUES ("admin","admin",4,"admin");
INSERT INTO plan (name, description, duration, cost) VALUES ("None", "No Plan Selected", 0, 0.00);
