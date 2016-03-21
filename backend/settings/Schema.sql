CREATE TABLE `projects` (
  `_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `description` longtext NOT NULL,
  `github` varchar(256) DEFAULT NULL,
  `date` date NOT NULL,
  `img` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

CREATE TABLE `_session` (
  `cookie` VARCHAR(32) NOT NULL,
  `data` LONGTEXT NULL,
  `client` VARCHAR(512) NULL,
  `death_date` INT NULL,
  PRIMARY KEY (`cookie`));

CREATE TABLE `users` (
  `_id` INT NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(256) NOT NULL,
  `username` VARCHAR(128) NULL,
  `hash` VARCHAR(256) NOT NULL,
  `admin` INT(1) NOT NULL DEFAULT 0,
  `last_login` INT NULL,
  `failed_attempts` INT NULL DEFAULT 0,
  `locked` INT(1) NULL DEFAULT 0,
  PRIMARY KEY (`_id`));