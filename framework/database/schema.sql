DROP TABLE IF EXISTS `apiKeys`;
CREATE TABLE `apiKeys` (
  `apiKeyId` int(10) unsigned NOT NULL auto_increment,
  `owner` TEXT NOT NULL,
  `dateCreated` DATETIME NOT NULL,
  `dateExpires` DATETIME NOT NULL,
  PRIMARY KEY (`apiKeyId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
