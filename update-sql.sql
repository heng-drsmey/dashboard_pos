-- update (Jun-06-2024)
ALTER TABLE `user` CHANGE `ActivedAt` `Remark` VARCHAR(255) NULL DEFAULT NULL;
<<<<<<< HEAD
-- update (Jun-06-2024)

ALTER TABLE `customer` ADD `Remark` TEXT NULL AFTER `Address`;

ALTER TABLE `employee` ADD `Remark` TEXT NULL ;
ALTER TABLE `employeepayroll` ADD `Remark` TEXT NULL ;
ALTER TABLE `employeereviewsalary` ADD `Remark` TEXT NULL ;
ALTER TABLE `invoice` ADD `Remark` TEXT NULL ;
ALTER TABLE `outlet` ADD `Remark` TEXT NULL ;
ALTER TABLE `shift` ADD `Remark` TEXT NULL ;
=======
--add columm logo on outlet
ALTER TABLE `outlet` ADD `Logo` VARCHAR(255) NULL AFTER `Address`;
>>>>>>> 46c76eee1163fbe7a9ab8e7931397ef8b478bbce
