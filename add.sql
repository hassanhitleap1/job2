
CREATE TABLE `job`.`educational_attainment` ( `id` INT NOT NULL AUTO_INCREMENT , `user_id` INT NOT NULL , `specialization` VARCHAR(250) NOT NULL , `university` VARCHAR(250) NOT NULL , `year_get` INT NOT NULL , `created_at` DATETIME NOT NULL , `updated_at` DATETIME NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;
CREATE TABLE `job`.`experiences` ( `id` INT NOT NULL AUTO_INCREMENT , `job_title` VARCHAR(255) NOT NULL , `month_from_exp` INT NOT NULL , `year_from_exp` INT NOT NULL , `month_to_exp` INT NOT NULL , `year_to_exp` INT NOT NULL , `facility_name` VARCHAR(255) NOT NULL , `created_at` DATETIME NOT NULL , `updated_at` DATETIME NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

CREATE TABLE `job`.`courses` ( `id` INT NOT NULL AUTO_INCREMENT , `name_course` VARCHAR(255) NOT NULL , `destination` VARCHAR(255) NOT NULL , `duration` VARCHAR(255) NOT NULL , `created_at` DATETIME NOT NULL , `updated_at` DATETIME NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

ALTER TABLE `courses` ADD `user_id` INT NOT NULL AFTER `id`;
ALTER TABLE `experiences` ADD `user_id` INT NOT NULL AFTER `id`;


ALTER TABLE `educational_attainment` ADD `degree` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL AFTER `user_id`

ALTER TABLE `experiences`
  DROP `month_from_exp`,
  DROP `year_from_exp`,
  DROP `month_to_exp`,
  DROP `year_to_exp`;


ALTER TABLE `experiences` ADD `date_from` DATETIME NOT NULL AFTER `job_title`, ADD `date_to` DATETIME NOT NULL AFTER `date_from`;

ALTER TABLE `user` CHANGE `verification_email` `verification_email` SMALLINT NULL DEFAULT NULL;


CREATE TABLE `forgot_password` ( `id` INT NOT NULL AUTO_INCREMENT , `validate_code` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , `user_id` INT NOT NULL , `created_at` DATETIME NOT NULL , `updated_at` DATETIME NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;



CREATE TABLE `schools` (
  `id` int(11) NOT NULL,
  `name` varchar(200) CHARACTER SET utf8 NOT NULL,
  `details` longtext CHARACTER SET utf8 NOT NULL,
  `director_word` longtext CHARACTER SET utf8 NOT NULL,
  `discounts_form` longtext CHARACTER SET utf8 NOT NULL,
  `map` longtext CHARACTER SET utf8 NOT NULL,
  `brochure` longtext CHARACTER SET utf8 NOT NULL,
  `contact_information` longtext CHARACTER SET utf8 NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


ALTER TABLE `schools`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `schools`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;


CREATE TABLE `images_school` ( `id` INT NOT NULL AUTO_INCREMENT , `school_id` INT NOT NULL , `path` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

ALTER TABLE `experiences` CHANGE `date_from` `date_from` DATE NOT NULL, CHANGE `date_to` `date_to` DATE NOT NULL;

ALTER TABLE `educational_attainment` CHANGE `specialization` `specialization` VARCHAR(250) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, CHANGE `university` `university` VARCHAR(250) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;

ALTER TABLE `experiences` CHANGE `job_title` `job_title` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, CHANGE `facility_name` `facility_name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;

ALTER TABLE `schools` ADD `path_logo` VARCHAR(255) NOT NULL AFTER `contact_information`;
ALTER TABLE `schools` CHANGE `path_logo` `path_logo` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;


ALTER TABLE `user` ADD `action_user` INT NOT NULL DEFAULT '0' AFTER `verification_email`;

CREATE TABLE name_of_jobs ( `id` INT NOT NULL AUTO_INCREMENT , `name_ar` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , `created_at` DATETIME NOT NULL , `updated_at` DATETIME NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

CREATE TABLE `job`.`specialties`
( `id` INT NOT NULL AUTO_INCREMENT , `name_ar` VARCHAR
(255) CHARACTER
SET utf8
COLLATE utf8_general_ci NOT NULL , `created_at` DATETIME NOT NULL , `updated_at` DATETIME NOT NULL , PRIMARY KEY
(`id`)) ENGINE = InnoDB;
ALTER TABLE `user`
ADD `contract_path` VARCHAR
(255) NOT NULL AFTER `action_user`;

ALTER TABLE `request_merchant` ADD `experience` INT NOT NULL DEFAULT '0' AFTER `updated_at`, ADD `count_employees` INT NOT NULL DEFAULT '1' AFTER `experience`;

CREATE TABLE school_owners ( `id` INT NOT NULL AUTO_INCREMENT , `phone` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , `name` VARCHAR(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , `web_site` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , `created_at` DATETIME NOT NULL , `updated_at` DATETIME NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;


CREATE TABLE `user_message_clarification` ( `id` INT NOT NULL AUTO_INCREMENT , `text` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , `user_id` INT NOT NULL , `created_at` DATETIME NOT NULL , `updated_at` DATETIME NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;



CREATE TABLE `message_school_owners` ( `id` INT NOT NULL AUTO_INCREMENT , `text` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , `user_id` INT NOT NULL , `created_at` DATETIME NOT NULL , `updated_at` DATETIME NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;


CREATE TABLE `user_message_zoom`
( `id` INT NOT NULL AUTO_INCREMENT , `text` TEXT CHARACTER
SET utf8
COLLATE utf8_general_ci NOT NULL , `user_id` INT NOT NULL , `created_at` DATETIME NOT NULL , `updated_at` DATETIME NOT NULL , PRIMARY KEY
(`id`)) ENGINE = InnoDB;


CREATE TABLE `action_admin` ( `id` INT NOT NULL AUTO_INCREMENT , `user_id` INT NOT NULL , `admin_id` INT NOT NULL , `action` VARCHAR(400) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , `date` DATETIME NOT NULL , `created_at` DATETIME NOT NULL , `updated_at` DATETIME NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

ALTER TABLE `user` ADD `location` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL AFTER `contract_path`;

ALTER TABLE `user` ADD `address` VARCHAR(600) NULL DEFAULT NULL AFTER `location`;


CREATE TABLE `video_vimo` ( `id` INT NOT NULL AUTO_INCREMENT , `video_id` VARCHAR(250) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL , `title` VARCHAR(250) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL , `desc` VARCHAR(500) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL , `user_id` INT NOT NULL , `created_at` DATETIME NULL DEFAULT NULL , `updated_at` DATETIME NULL DEFAULT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

CREATE TABLE `vedio_user` ( `id` INT NOT NULL AUTO_INCREMENT , `video_id` VARCHAR(250) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL , `title` VARCHAR(250) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , `desc` VARCHAR(500) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL , `user_id` INT NOT NULL , `from` SMALLINT NOT NULL , `path` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , `status` SMALLINT NOT NULL , `created_at` DATETIME NULL DEFAULT NULL , `updated_at` DATETIME NULL DEFAULT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

ALTER TABLE `video_vimo` ADD `specialtie_id` INT NULL DEFAULT NULL AFTER `user_id`;


ALTER TABLE `vedio_user`
ADD `specialtie_id` INT NULL DEFAULT NULL AFTER `user_id`;


ALTER TABLE `vedio_user` CHANGE `specialtie_id` `name_of_jobs_id` INT(11) NULL DEFAULT NULL;

ALTER TABLE `video_vimo` CHANGE `specialtie_id` `name_of_jobs_id` INT(11) NULL DEFAULT NULL;


ALTER TABLE `vedio_user` CHANGE `title` `title` VARCHAR(250) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL, CHANGE `from` `from` SMALLINT(6) NULL DEFAULT NULL;


