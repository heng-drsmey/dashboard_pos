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

-- update (Jun-09-2024 : 3:13 PM)
ALTER TABLE `pro_moment` CHANGE `Pro_Out_Id` `Pro_Out_Id` INT(11) NULL;
ALTER TABLE `pro_moment` CHANGE `Pro_In_Id` `Pro_In_Id` INT(11) NULL;
ALTER TABLE `pro_in` ADD `Uom` INT NULL AFTER `ProId`;
ALTER TABLE `uom` ADD `del` INT NOT NULL DEFAULT '1' AFTER `UpdateAt`;
ALTER TABLE `user` ADD `del` INT NOT NULL DEFAULT '1' AFTER `UpdateAt`;
ALTER TABLE `role` ADD `del` INT NOT NULL DEFAULT '1' AFTER `UpdateAt`;
ALTER TABLE `table` ADD `del` INT NOT NULL DEFAULT '1' AFTER `UpdateAt`;
ALTER TABLE `paymentmethod` ADD `del` INT NOT NULL DEFAULT '1' AFTER `UpdateAt`;
ALTER TABLE `currency` ADD `del` INT NOT NULL DEFAULT '1' AFTER `UpdateAt`;
ALTER TABLE `category` ADD `del` INT NOT NULL DEFAULT '1' AFTER `UpdateAt`;

-- update (18-06-2024 : 10:42 PM)(Sorn Samneang)
ALTER TABLE `employee` ADD `Nation` VARCHAR(20) NOT NULL AFTER `Dob`, ADD `Marital` VARCHAR(20) NOT NULL AFTER `Nation`;
ALTER TABLE `employee` ADD `Address` TEXT NOT NULL AFTER `Tel`;
ALTER TABLE `employee` ADD `EmployeeType` VARCHAR(20) NOT NULL AFTER `Address`;
ALTER TABLE `employee` ADD `Bank` INT(11) NULL DEFAULT '1' AFTER `Position`, ADD `AccountName` VARCHAR(200) NOT NULL AFTER `Bank`, ADD `AccountNumber` VARCHAR(200) NOT NULL AFTER `AccountName`, ADD `IdCard` INT(20) NOT NULL AFTER `AccountNumber`;
ALTER TABLE `employee` ADD `del` INT(11) NULL AFTER `Remark`;

ALTER TABLE `employee` CHANGE `Nation` `Nation` INT(11) NULL DEFAULT '1';
ALTER TABLE `employee` CHANGE `EmployeeType` `EmployeeType` INT(11) NULL DEFAULT '1';
ALTER TABLE `employee` CHANGE `Position` `Position` INT(11) NULL DEFAULT '1';
ALTER TABLE `employee` CHANGE `del` `del` INT(11) NOT NULL DEFAULT '1';


CREATE TABLE `db_sys_coffee`.`nationality` (`Id` INT(11) NOT NULL AUTO_INCREMENT , `Nation` VARCHAR(200) NOT NULL , `CreateBy` INT(11) NOT NULL , `Remark` TEXT NULL , `Status` TINYINT(1) NOT NULL , `CreateAt` TIMESTAMP NOT NULL , `UpdateAt` DATETIME NOT NULL , `del` INT(11) NOT NULL DEFAULT '1' , PRIMARY KEY (`Id`)) ENGINE = InnoDB;
CREATE TABLE `db_sys_coffee`.`employeetype` (`Id` INT(11) NOT NULL AUTO_INCREMENT , `EmployeeType` VARCHAR(200) NOT NULL , `CreateBy` INT(11) NOT NULL , `Remark` TEXT NOT NULL , `Status` TINYINT(1) NOT NULL , `CreateAt` TIMESTAMP NOT NULL , `UpdateAt` DATETIME NOT NULL , `del` INT(11) NOT NULL DEFAULT '1' , PRIMARY KEY (`Id`)) ENGINE = InnoDB;
CREATE TABLE `db_sys_coffee`.`positions` (`Id` INT(11) NOT NULL AUTO_INCREMENT , `Positions` VARCHAR(200) NOT NULL , `CreateBy` INT(11) NOT NULL , `Remark` TEXT NOT NULL , `Status` INT(1) NOT NULL , `CreateAt` TIMESTAMP NOT NULL , `UpdateAt` DATETIME NOT NULL , `del` INT(11) NOT NULL DEFAULT '1' , PRIMARY KEY (`Id`)) ENGINE = InnoDB;
CREATE TABLE `db_sys_coffee`.`bank` (`Id` INT(11) NOT NULL AUTO_INCREMENT , `Bank` VARCHAR(200) NOT NULL , `CreateBy` INT(11) NOT NULL , `Remark` TEXT NOT NULL , `Status` INT(1) NOT NULL , `CreateAt` TIMESTAMP NOT NULL , `UpdateAt` DATETIME NOT NULL , `del` INT(11) NOT NULL DEFAULT '1' , PRIMARY KEY (`Id`)) ENGINE = InnoDB;

-- update query ( Jun-19-2024)
ALTER TABLE `pro_out` CHANGE `CreateBy` `CreateBy` INT(11) NULL DEFAULT NULL COMMENT 'Employee';
ALTER TABLE `pro_out` CHANGE `CreateBy` `SaleBy` INT(11) NULL DEFAULT NULL COMMENT 'Employee';
ALTER TABLE `pro_out` ADD `SaleDate` DATE NULL AFTER `Id`, ADD `SaleNo` VARCHAR(11) NULL AFTER `SaleDate`, ADD `Customer` INT(11) NULL AFTER `SaleNo`, ADD `Uom` INT(11) NULL AFTER `Customer`, ADD `Paid` DECIMAL(10,2) NOT NULL DEFAULT '0' AFTER `Uom`, ADD `Status` INT(11) NULL AFTER `Paid`, ADD UNIQUE `SaleNo` (`SaleNo`);
ALTER TABLE `pro_out` 
ADD FOREIGN KEY (SaleBy) REFERENCES `employee` (Id);

ALTER TABLE `pro_out` 
ADD FOREIGN KEY (Uom) REFERENCES `uom` (Id);




