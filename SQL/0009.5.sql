CREATE TABLE IF NOT EXISTS `Comment` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `User` int(10) unsigned NOT NULL,
  `Article` int(10) unsigned NOT NULL,
  `Parent` int(10) unsigned DEFAULT NULL,
  `CreationDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Text` text NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `ArticleComment` (`Article`),
  KEY `CommentUser` (`User`),
  CONSTRAINT `ArticleComment` FOREIGN KEY (`Article`) REFERENCES `Article` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `CommentUser` FOREIGN KEY (`User`) REFERENCES `User` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;