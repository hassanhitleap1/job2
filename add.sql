
CREATE TABLE `job`.`educational_attainment` ( `id` INT NOT NULL AUTO_INCREMENT , `user_id` INT NOT NULL , `specialization` VARCHAR(250) NOT NULL , `university` VARCHAR(250) NOT NULL , `year_get` INT NOT NULL , `created_at` DATETIME NOT NULL , `updated_at` DATETIME NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;
CREATE TABLE `job`.`experiences` ( `id` INT NOT NULL AUTO_INCREMENT , `job_title` VARCHAR(255) NOT NULL , `month_from_exp` INT NOT NULL , `year_from_exp` INT NOT NULL , `month_to_exp` INT NOT NULL , `year_to_exp` INT NOT NULL , `facility_name` VARCHAR(255) NOT NULL , `created_at` DATETIME NOT NULL , `updated_at` DATETIME NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

CREATE TABLE `job`.`courses` ( `id` INT NOT NULL AUTO_INCREMENT , `name_course` VARCHAR(255) NOT NULL , `destination` VARCHAR(255) NOT NULL , `duration` VARCHAR(255) NOT NULL , `created_at` DATETIME NOT NULL , `updated_at` DATETIME NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

ALTER TABLE `courses` ADD `user_id` INT NOT NULL AFTER `id`;
ALTER TABLE `experiences` ADD `user_id` INT NOT NULL AFTER `id`;