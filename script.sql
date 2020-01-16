
CREATE SCHEMA IF NOT EXISTS `freedcamp` DEFAULT CHARACTER SET utf8 ;
USE `freedcamp` ;


CREATE TABLE IF NOT EXISTS `users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `first_name` VARCHAR(45) NOT NULL,
  `last_name` VARCHAR(45) NOT NULL,
  `birth_date` DATE NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `secret` VARCHAR(200) NOT NULL,
  PRIMARY KEY (`id`));



CREATE TABLE IF NOT EXISTS `enterprises` (
  `enterprise_id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  PRIMARY KEY (`enterprise_id`));




CREATE TABLE IF NOT EXISTS `markets` (
  `market_id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  PRIMARY KEY (`market_id`));



CREATE TABLE IF NOT EXISTS `services` (
  `service_id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  PRIMARY KEY (`service_id`));



CREATE TABLE IF NOT EXISTS `tasks_list` (
  `task_list_id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(45) NULL,
  `descriptión` VARCHAR(45) NULL,
  `project_id` INT NULL,
  PRIMARY KEY (`task_list_id`));



CREATE TABLE IF NOT EXISTS `services_list` (
  `service_id` INT NOT NULL,
  `enterprise_id` INT NOT NULL,
  `market_id` INT NOT NULL,
  `task_list_id` INT NULL,
  PRIMARY KEY (`service_id`, `enterprise_id`, `market_id`),
  INDEX `fk_market_id_idx` (`market_id` ASC) ,
  INDEX `fk_task_list_id_idx` (`task_list_id` ASC) ,
  CONSTRAINT `fk_enterprise_id`
    FOREIGN KEY (`enterprise_id`)
    REFERENCES `enterprises` (`enterprise_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_service_id`
    FOREIGN KEY (`service_id`)
    REFERENCES `services` (`service_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_market_id`
    FOREIGN KEY (`market_id`)
    REFERENCES `markets` (`market_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_task_list_id`
    FOREIGN KEY (`task_list_id`)
    REFERENCES `tasks_list` (`task_list_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);



CREATE TABLE IF NOT EXISTS `tasks` (
  `task_id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(45) NOT NULL,
  `responsible` VARCHAR(45) NULL,
  `state_id` INT NULL,
  `priority` VARCHAR(45) NULL,
  `start_date` DATE NULL,
  `end_date` DATE NULL,
  `task_list_id` INT NOT NULL,
  PRIMARY KEY (`task_id`),
  INDEX `fk_task_list_id_idx` (`task_list_id` ASC) ,
  CONSTRAINT `fk_task_list_id`
    FOREIGN KEY (`task_list_id`)
    REFERENCES `tasks_list` (`task_list_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

 
INSERT INTO `enterprises` (`enterprise_id`, `name`)
VALUES (NULL, 'K@pta'), (NULL, 'GMBh')

INSERT INTO `markets` (`market_id`, `name`)
VALUES (NULL, 'BMW'), (NULL, 'KIA'), (NULL, 'MINI'), (NULL, 'VOLVO');

INSERT INTO `services` (`service_id`, `name`) 
VALUES (NULL, 'Administrativas'), (NULL, 'Soporte técnico'),
(NULL, 'Diseño visual'), (NULL, 'Desarrollo de software'), (NULL, 'Consultoria');

INSERT INTO `services_list` (`service_id`, `enterprise_id`, `market_id`, `task_list_id`) 
VALUES ('4', '1', '1', NULL),('4', '1', '3', NULL),
('4', '2', '2', NULL) ,('4', '2', '4', NULL) ;