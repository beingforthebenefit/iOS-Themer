-- Add table to store information about icon packs --

use iosthemelive;

start transaction;

CREATE TABLE `iosthemelive`.`packs` (
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

commit;
