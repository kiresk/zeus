CREATE TABLE IF NOT EXISTS `Article` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `User` int(10) unsigned NOT NULL,
  `Category` int(10) unsigned NOT NULL,
  `CreationDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `PublishDate` datetime DEFAULT NULL,
  `Title` varchar(255) NOT NULL,
  `Text` longtext NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;