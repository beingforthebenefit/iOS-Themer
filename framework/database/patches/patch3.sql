-- Add column to keep track of key usage --

use iosthemelive;

start transaction;

ALTER TABLE `apiKeys` 
ADD COLUMN `timesUsed` INT NOT NULL DEFAULT 0 AFTER `dateExpires`;

commit;
