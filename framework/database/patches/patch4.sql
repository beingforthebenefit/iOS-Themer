
-- Add column to see if key is active --

use iosthemelive;

start transaction;

ALTER TABLE `apiKeys` 
ADD COLUMN `active` TINYINT NOT NULL DEFAULT 1 AFTER `timesUsed`;

commit;
