CREATE TABLE IF NOT EXISTS `Article` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `UserID` int(10) unsigned NOT NULL,
  `CategoryID` int(10) unsigned NOT NULL,
  `CreationDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `PublishDate` datetime DEFAULT NULL,
  `Title` varchar(255) NOT NULL,
  `Text` longtext NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `Category` (`CategoryID`),
  KEY `ArticleAuthor` (`UserID`),
  CONSTRAINT `ArticleAuthor` FOREIGN KEY (`UserID`) REFERENCES `User` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;