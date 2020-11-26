-- Intial patch to create table for managing API keys --

use iosthemelive;

start transaction;

CREATE TABLE `apiKeys` (
  `apiKeyId` int(10) unsigned NOT NULL auto_increment,
  `owner` TEXT NOT NULL,
  `dateCreated` DATETIME NOT NULL,
  `dateExpires` DATETIME NOT NULL,
  PRIMARY KEY (`apiKeyId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

commit;