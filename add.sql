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