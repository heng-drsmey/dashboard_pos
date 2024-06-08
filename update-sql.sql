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
-- add column add on table pro_in (Jun-08-2024: 12:05AM)
ALTER TABLE `pro_in` ADD `PurchaseNo` VARCHAR(20) NULL AFTER `Id`;
ALTER TABLE `pro_in` ADD `DiscountAmount` DECIMAL(10,2) NULL DEFAULT '00.00' AFTER `Price_In`;
ALTER TABLE `pro_in` ADD `RecieveDate` DATE NULL AFTER `Id`;
ALTER TABLE `pro_in` CHANGE `Description` `Description` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL;
ALTER TABLE `pro_in` ADD `RecieveBy` TINYINT NULL AFTER `RecieveDate`;
ALTER TABLE `pro_in` ADD `Supplier` TINYINT NULL AFTER `RecieveBy`;
ALTER TABLE `pro_in` ADD `Paid` DECIMAL(10,2) NULL AFTER `Description`;
ALTER TABLE `pro_in` ADD `PaymentStatus` TINYINT NULL AFTER `Paid`;

INSERT INTO `supplier`( `Name`, `Email`, `Phone_Number`, `Address`, `CreateBy`) VALUES ('General Supplier',' ',0987654321,'Cambodia','1');


-- add foriend key add on table supplier (Jun-08-2024: 12:05AM)
ALTER TABLE `supplier` ADD FOREIGN KEY (CreateBy) REFERENCES `user` (Id);
ALTER TABLE `pro_in` ADD FOREIGN KEY (Uom) REFERENCES `uom` (Id);