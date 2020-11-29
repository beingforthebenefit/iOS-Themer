DROP TABLE IF EXISTS `apiKeys`;
CREATE TABLE `apiKeys` (
  `apiKeyId` int(10) unsigned NOT NULL auto_increment,
  `owner` TEXT NOT NULL,
  `dateCreated` DATETIME NOT NULL,
  `dateExpires` DATETIME NOT NULL,
  `timesUsed` INT NOT NULL DEFAULT 0,
  PRIMARY KEY (`apiKeyId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
  `adminId` INT unsigned NOT NULL auto_increment,
  `username` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `lastLogin` DATETIME NULL,
  PRIMARY KEY (`adminId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;