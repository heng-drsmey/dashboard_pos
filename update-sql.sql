-- update (Jun-06-2024)
ALTER TABLE `user` CHANGE `ActivedAt` `Remark` VARCHAR(255) NULL DEFAULT NULL;
-- update (Jun-06-2024)

ALTER TABLE `customer` ADD `Remark` TEXT NULL AFTER `Address`;

ALTER TABLE `employee` ADD `Remark` TEXT NULL ;
ALTER TABLE `employeepayroll` ADD `Remark` TEXT NULL ;
ALTER TABLE `employeereviewsalary` ADD `Remark` TEXT NULL ;
ALTER TABLE `invoice` ADD `Remark` TEXT NULL ;
ALTER TABLE `outlet` ADD `Remark` TEXT NULL ;
ALTER TABLE `shift` ADD `Remark` TEXT NULL ;
--add columm logo on outlet
ALTER TABLE `outlet` ADD `Logo` VARCHAR(255) NULL AFTER `Address`;
-- add column status on Table
ALTER TABLE `table` ADD `Status` TINYINT NULL DEFAULT '1' AFTER `Description`;

-- add foriend key (Jun-07-2024: 11:43 AM)
ALTER TABLE `paymentmethod` 
ADD FOREIGN KEY (CreateBy) REFERENCES `user` (Id);
ALTER TABLE `currency` ADD `Status` TINYINT NOT NULL DEFAULT '1' AFTER `CreateBy`;