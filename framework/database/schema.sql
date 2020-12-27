use `iosthemelive`;

DROP TABLE IF EXISTS `apiKeys`;
CREATE TABLE `apiKeys` (
    `apiKeyId` int(10) unsigned NOT NULL auto_increment,
    `owner` TEXT NOT NULL,
    `dateCreated` DATETIME NOT NULL,
    `timesUsed` INT NOT NULL DEFAULT 0,
    `active` TINYINT NOT NULL DEFAULT 1,
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

DROP TABLE IF EXISTS `packs`;
CREATE TABLE `packs` (
    `packId` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `background` VARCHAR(45) NOT NULL COMMENT 'The background should be in the directory /public/images/icon-pack-previews/. This field should contain the filename.',
    `paid` TINYINT NOT NULL COMMENT 'Is this a package paid through GumRoad?',
    `title` TEXT NOT NULL,
    `description` TEXT NULL,
    `link1Text` TEXT NOT NULL,
    `link1Url` TEXT NOT NULL,
    `link2Text` TEXT NULL,
    `link2Url` TEXT NULL,
    PRIMARY KEY (`packId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
