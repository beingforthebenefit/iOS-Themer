-- Add table for admin accounts --

use iosthemelive;

start transaction;

CREATE TABLE `admins` (
  `adminId` INT unsigned NOT NULL auto_increment,
  `username` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `lastLogin` DATETIME NULL,
  PRIMARY KEY (`adminId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

commit;