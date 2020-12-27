-- Add table to store information about icon packs --

use iosthemelive;

start transaction;

CREATE TABLE `iosthemelive`.`packs` (
    `packId` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `directory` VARCHAR(45) NOT NULL COMMENT 'All icons should be in the path \\application\\icon-packs\\. This field should be the name of the directory in that path.',
    `background` VARCHAR(45) NOT NULL COMMENT 'The background should be in the directory /public/images/icon-pack-previews/. This field should contain the filename.',
    `paid` TINYINT NOT NULL COMMENT 'Is this a package paid through GumRoad?',
    `title` TEXT NOT NULL,
    `description` TEXT NULL,
    `link1Text` TEXT NOT NULL,
    `link1Url` TEXT NOT NULL,
    `link2Text` TEXT NULL,
    `link2Url` TEXT NULL,
    PRIMARY KEY (`packId`),
    UNIQUE INDEX `packId_UNIQUE` (`packId` ASC) VISIBLE,
    UNIQUE INDEX `directory_UNIQUE` (`directory` ASC) VISIBLE);

commit;
