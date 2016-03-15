CREATE TABLE `projects` (
  `_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `description` longtext NOT NULL,
  `github` varchar(256) DEFAULT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`_id`),
  UNIQUE KEY `github_UNIQUE` (`github`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
