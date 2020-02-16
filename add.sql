CREATE TABLE `job`.`pages`
                        ( `id` INT NOT NULL AUTO_INCREMENT ,
                         `key` VARCHAR(50) NOT NULL ,
                         `title` VARCHAR(500) NOT NULL ,
                         `text` TEXT NOT NULL ,
                          `created_at` DATETIME NOT NULL ,
                           `updated_at` DATETIME NOT NULL , PRIMARY KEY (`id`),
                            UNIQUE (`key`)) ENGINE = InnoDB;

INSERT INTO `pages` (`id`, `key`, `title`, `text`, `created_at`, `updated_at`) VALUES
(1, 'our-vision', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'our-message', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'about', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'our-goals', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'growth-strategies', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'rate-us', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'our-responsibility', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00');


CREATE TABLE `job`.`manual_payment_user` (
    `id` INT NOT NULL AUTO_INCREMENT ,
    `user_id` INT NOT NULL , `amount` DOUBLE NOT NULL ,
     `created_at` DATETIME NOT NULL ,
      `updated_at` DATETIME NOT NULL ,
       PRIMARY KEY (`id`)) ENGINE = InnoDB;


ALTER TABLE `user` ADD `pay_service` TINYINT NOT NULL DEFAULT '0' AFTER `category_id`;

# ALL user regested must be payed
UPDATE `user` SET `pay_service` =1 WHERE `type`= 0

ALTER TABLE `user` ADD `priorities` TEXT NOT NULL AFTER `pay_service`;


ALTER TABLE `user` ADD `first_payment` DOUBLE NOT NULL DEFAULT '0.0' AFTER `priorities`;

ALTER TABLE `user` CHANGE `priorities` `priorities` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;


CREATE TABLE `job`.`user_message` (
                                      `id` INT NOT NULL AUTO_INCREMENT ,
                                      `text` text DEFAULT NULL,
                                      `user_id` int(11) DEFAULT NULL,
                                      `created_at` datetime DEFAULT NULL,
                                      `updated_at` datetime DEFAULT NULL,
                                      PRIMARY KEY (`id`)) ENGINE = InnoDB;


ALTER TABLE `manual_payment_user` ADD `is_first_payment` TINYINT NOT NULL AFTER `amount`;

#
# user_message_merchant

CREATE TABLE `user_message_merchant` (
                                `id` int(11) NOT NULL,
                                `text` text DEFAULT NULL,
                                `user_id` int(11) DEFAULT NULL,
                                `created_at` datetime DEFAULT NULL,
                                `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


ALTER TABLE `user_message_merchant`
    ADD PRIMARY KEY (`id`);


ALTER TABLE `user_message_merchant`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;



# date 9-2-2020   message job

CREATE TABLE `message_job_user` (
                                    `id` int(11) NOT NULL,
                                    `user_id` int(11) NOT NULL,
                                    `text` text NOT NULL,
                                    `created_at` datetime NOT NULL,
                                    `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


ALTER TABLE `message_job_user`
    ADD PRIMARY KEY (`id`);


ALTER TABLE `message_job_user`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;




CREATE TABLE `job`.`user_message_whatsapp` ( `id` INT NOT NULL , `test` TEXT NOT NULL , `user_id` INT NOT NULL , `marchent_id` INT NOT NULL , `created_at` DATETIME NOT NULL , `updated_at` DATETIME NOT NULL ) ENGINE = InnoDB;





ALTER TABLE `user_message_whatsapp` ADD PRIMARY KEY(`id`);

ALTER TABLE `user_message_whatsapp` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;