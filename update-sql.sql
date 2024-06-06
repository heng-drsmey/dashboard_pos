-- update (Jun-06-2024)
ALTER TABLE `user` CHANGE `ActivedAt` `Remark` VARCHAR(255) NULL DEFAULT NULL;
--add columm logo on outlet
ALTER TABLE `outlet` ADD `Logo` VARCHAR(255) NULL AFTER `Address`;