-- ### Create tbl UOM

create table UOM(
    Id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    Code VARCHAR(120),
    Name VARCHAR(120),
    Remark VARCHAR(255),
    Status TINYINT(1) DEFAULT 1,
    CreateAt timestamp NOT NULL DEFAULT current_timestamp()
    );

-- #### ADD Forein KEY

ALTER table `pro_moment`
ADD FOREIGN KEY (ProId) REFERENCES `product` (Id);

ALTER table `pro_moment`
ADD FOREIGN KEY (Pro_Out_Id) REFERENCES `pro_out` (Id);

ALTER table `pro_moment`
ADD FOREIGN KEY (Pro_In_Id) REFERENCES `pro_in` (Id);

ALTER table `pro_in`
ADD FOREIGN KEY (ProId) REFERENCES `product` (Id);

ALTER table `pro_out`
ADD FOREIGN KEY (ProId) REFERENCES `product` (Id);

ALTER table `pro_out`
ADD FOREIGN KEY (TableId) REFERENCES `Table` (Id);

ALTER TABLE `invoice` 
ADD FOREIGN KEY (TableId) REFERENCES `table` (Id);

ALTER TABLE `productsku` 
ADD FOREIGN KEY (UomId) REFERENCES `uom` (Id);

-- #### Add column UpdateAt on table UOM

ALTER TABLE `uom` ADD `UpdateAt` DATETIME NULL AFTER `CreateAt`;

-- #### Change name column sizename on table productsku

ALTER TABLE `productsku` 
CHANGE   `SizeName`  `UomId`varchar(50);

-- Drop column on table category

ALTER TABLE category
DROP COLUMN ParentId;
-- Add column PaymentMethod on table productsku
ALTER TABLE `productsku` ADD `Currency` VARCHAR(11) NOT NULL AFTER `Price`;


ALTER TABLE `shiftdetails` ADD `Currency` VARCHAR(11) NULL AFTER `Price`;
UPDATE `shiftdetails` SET `Currency` = '1' WHERE `shiftdetails`.`Id` = 1;
UPDATE `shiftdetails` SET `Currency` = '1' WHERE `shiftdetails`.`Id` = 2;
UPDATE `shiftdetails` SET `Currency` = '1' WHERE `shiftdetails`. `Id` = 3;
UPDATE `shiftdetails` SET `Currency` = '1' WHERE `shiftdetails`. `Id` = 4;
ALTER TABLE `employee` ADD `Currency` VARCHAR(11) NULL AFTER `Salary`;
ALTER TABLE `employeepayroll` ADD `Currency` VARCHAR(11) NULL AFTER `Total`;
ALTER TABLE `employeereviewsalary` ADD `Currency` VARCHAR(11) NULL AFTER `NewSalary`;
ALTER TABLE `invoicedetails` ADD `Currency` VARCHAR(11) NULL AFTER `Quantity`;
ALTER TABLE `productsku` CHANGE `Currency` `Currency` VARCHAR(11) CHARACTER SET utf8 COLLATE utf8_general_ci NULL;
ALTER TABLE `pro_in` ADD `Currency` VARCHAR(11) NULL AFTER `Price_In`;
ALTER TABLE `pro_out` ADD `Currency` VARCHAR(11) NULL AFTER `Description`;


ALTER TABLE `employeepayroll` ADD KEY `Currency` (`currency`);
ALTER TABLE `employeereviewsalary` ADD KEY `Currency` (`currency`);
ALTER TABLE `invoicedetails` ADD KEY `Currency` (`currency`);
ALTER TABLE `productsku` ADD KEY `Currency` (`currency`);
ALTER TABLE `pro_in` ADD KEY `Currency` (`currency`);
ALTER TABLE `pro_out` ADD KEY `Currency` (`currency`);
ALTER TABLE `employee` ADD KEY `Currency` (`currency`);

ALTER TABLE `employee` CHANGE `Currency` `Currency` INT(11) NULL DEFAULT NULL;
ALTER TABLE `employeepayroll` CHANGE `Currency` `Currency` INT(11) NULL DEFAULT NULL;
ALTER TABLE `employeereviewsalary` CHANGE `Currency` `Currency` INT(11) NULL DEFAULT NULL;
ALTER TABLE `invoicedetails` CHANGE `Currency` `Currency` INT(11) NULL DEFAULT NULL;
ALTER TABLE `pro_in` CHANGE `Currency` `Currency` INT(11) NULL DEFAULT NULL;
ALTER TABLE `pro_out` CHANGE `Currency` `Currency` INT(11) NULL DEFAULT NULL;
ALTER TABLE `productsku` CHANGE `Currency` `Currency` INT(11) NULL DEFAULT NULL;

ALTER TABLE `employee` CHANGE `Currency` `Currency` INT(11) NULL DEFAULT '1';
ALTER TABLE `employeepayroll` CHANGE `Currency` `Currency` INT(11) NULL DEFAULT '1';
ALTER TABLE `employeereviewsalary` CHANGE `Currency` `Currency` INT(11) NULL DEFAULT '1';
ALTER TABLE `invoicedetails` CHANGE `Currency` `Currency` INT(11) NULL DEFAULT '1';
ALTER TABLE `pro_in` CHANGE `Currency` `Currency` INT(11) NULL DEFAULT '1';
ALTER TABLE `pro_out` CHANGE `Currency` `Currency` INT(11) NULL DEFAULT '1';
ALTER TABLE `productsku` CHANGE `Currency` `Currency` INT(11) NULL DEFAULT '1';