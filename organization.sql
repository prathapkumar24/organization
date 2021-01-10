-- Adminer 4.2.1 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `employee`;
CREATE TABLE `employee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(200) NOT NULL,
  `last_name` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `role` enum('employee','lead','pm','ceo') NOT NULL,
  `reporting_person` int(11) DEFAULT NULL,
  `status` smallint(6) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `employee` (`id`, `first_name`, `last_name`, `email`, `dob`, `role`, `reporting_person`, `status`, `created_at`) VALUES
(3,	'Lead person 1',	'name',	'reportingmanager1@gmail.com',	'2021-01-10',	'lead',	NULL,	1,	'2021-01-10 15:33:02'),
(4,	'Project Manager 1',	'name',	'reportingmanager2@gmail.com',	'2021-01-10',	'pm',	NULL,	1,	'2021-01-10 15:33:02'),
(5,	'Lead person 2',	'name',	'reportingmanager3@gmail.com',	'2021-01-10',	'lead',	NULL,	1,	'2021-01-10 15:33:02'),
(6,	'Lead person 3',	'kumar',	'prathapkumar2as40@gmail.com',	'2021-01-10',	'lead',	1,	1,	'2021-01-10 16:06:04');

-- 2021-01-10 12:34:10
