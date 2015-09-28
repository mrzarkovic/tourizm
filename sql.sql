CREATE TABLE `tourizm`.`destinations` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NULL,
  `description` TEXT NULL,
  `price` INT NULL,
  `date_from` DATETIME NULL,
  `date_to` DATETIME NULL,
  PRIMARY KEY (`id`));

CREATE TABLE `tourizm`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(255) NULL,
  `password` VARCHAR(255) NULL,
  PRIMARY KEY (`id`));

ALTER TABLE `tourizm`.`destinations`
ADD COLUMN `total_quota` INT NULL AFTER `price`;

CREATE TABLE `tourizm`.`reservations` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `destination_id` INT NULL,
  `cutomer_name` VARCHAR(255) NULL,
  `customer_email` VARCHAR(255) NULL,
  PRIMARY KEY (`id`));

INSERT INTO `tourizm`.`users` (`username`, `password`) VALUES ('admin', '1a1dc91c907325c69271ddf0c944bc72');
#pass

ALTER TABLE `tourizm`.`destinations`
ADD COLUMN `image_path` VARCHAR(255) NULL AFTER `date_to`;

ALTER TABLE `tourizm`.`reservations`
CHANGE COLUMN `cutomer_name` `customer_name` VARCHAR(255) NULL DEFAULT NULL ;

ALTER TABLE `tourizm`.`reservations`
ADD COLUMN `customer_phone` VARCHAR(255) NULL AFTER `customer_email`;

ALTER TABLE `tourizm`.`reservations`
ADD INDEX `iddestination_idx` (`destination_id` ASC);
ALTER TABLE `tourizm`.`reservations`
ADD CONSTRAINT `iddestination`
  FOREIGN KEY (`destination_id`)
  REFERENCES `tourizm`.`destinations` (`id`)
  ON DELETE CASCADE
  ON UPDATE CASCADE;
