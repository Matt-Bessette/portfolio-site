CREATE TABLE `projects` (
  `_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `description` longtext NOT NULL,
  `github` varchar(256) DEFAULT NULL,
  `date` date NOT NULL,
  `img` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
