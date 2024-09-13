-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Jul 31, 2024 at 12:21 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sys_coffee`
--

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

CREATE TABLE `bank` (
  `Id` int(11) NOT NULL,
  `Bank` varchar(200) NOT NULL,
  `CreateBy` int(11) NOT NULL,
  `Remark` text NOT NULL,
  `Status` int(1) NOT NULL,
  `CreateAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `UpdateAt` datetime NOT NULL,
  `del` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `bank`
--

INSERT INTO `bank` (`Id`, `Bank`, `CreateBy`, `Remark`, `Status`, `CreateAt`, `UpdateAt`, `del`) VALUES
(1, 'ABA', 1, '', 1, '2024-06-18 15:32:11', '0000-00-00 00:00:00', 1),
(2, 'ACLEDA', 1, '', 1, '2024-06-18 09:55:38', '0000-00-00 00:00:00', 1),
(3, 'CANADIA', 1, '', 1, '2024-06-18 09:56:26', '0000-00-00 00:00:00', 1),
(4, 'CHIP MONG', 1, '', 1, '2024-06-27 10:13:10', '0000-00-00 00:00:00', 0),
(5, 'PRINCE', 1, '', 1, '2024-06-18 09:59:10', '0000-00-00 00:00:00', 1),
(6, 'VATTANAC', 1, '', 1, '2024-06-18 09:59:30', '0000-00-00 00:00:00', 1),
(7, 'WING', 1, '', 1, '2024-06-18 10:00:22', '0000-00-00 00:00:00', 1),
(8, 'LOLC', 1, '', 1, '2024-06-18 10:00:41', '0000-00-00 00:00:00', 1),
(9, 'Cambodia Bank', 2, 'USA Product', 0, '2024-06-27 10:09:47', '2024-06-26 13:27:58', 0);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `Id` int(11) NOT NULL,
  `Name` varchar(120) NOT NULL,
  `Description` text DEFAULT NULL,
  `Image` varchar(255) DEFAULT NULL,
  `Status` tinyint(1) DEFAULT 1,
  `CreateBy` int(11) DEFAULT NULL,
  `CreateAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdateAt` datetime DEFAULT NULL,
  `del` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`Id`, `Name`, `Description`, `Image`, `Status`, `CreateBy`, `CreateAt`, `UpdateAt`, `del`) VALUES
(1, 'Ice', 'iced coffee is a cold version of your favourite coffee', 'ice_image1.jpg', 1, 1, '2024-03-11 07:03:27', NULL, 1),
(2, 'Hot', 'hot coffee is a cold version of your favourite coffee', 'hot_image.jpg', 1, 1, '2024-03-11 07:03:27', NULL, 1),
(3, 'Soda', 'soda coffee is a cold version of your favourite coffee', 'soda_image.jpg', 1, 1, '2024-03-11 07:03:27', NULL, 1),
(4, 'Juice', 'juice coffee is a cold version of your favourite coffee', 'juice_image.jpg', 1, 1, '2024-03-11 07:03:27', NULL, 1),
(5, 'Frappe', 'frappe coffee is a cold version of your favourite coffee', 'frappe_image.jpg', 1, 1, '2024-03-11 07:03:27', NULL, 1),
(6, 'Cream', 'cream coffee is a cold version of your favourite coffee', 'cream_image.jpg', 1, 1, '2024-03-11 07:03:27', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `currency`
--

CREATE TABLE `currency` (
  `Id` int(11) NOT NULL,
  `Code` varchar(11) NOT NULL,
  `Name` varchar(11) NOT NULL,
  `Symbol` varchar(11) DEFAULT NULL,
  `Remark` varchar(100) DEFAULT NULL,
  `CreateBy` varchar(100) DEFAULT NULL,
  `Status` tinyint(4) NOT NULL DEFAULT 1,
  `CreateAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdateAt` datetime DEFAULT NULL,
  `del` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `currency`
--

INSERT INTO `currency` (`Id`, `Code`, `Name`, `Symbol`, `Remark`, `CreateBy`, `Status`, `CreateAt`, `UpdateAt`, `del`) VALUES
(1, 'USD', 'USD', '$', 'USD', '1', 1, '2024-06-01 03:59:02', NULL, 1),
(2, 'KHR', 'KHR', '៛', 'Khmer riel', '2', 1, '2024-06-01 03:59:02', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `Id` int(11) NOT NULL,
  `OutletId` int(11) NOT NULL,
  `Code` varchar(120) NOT NULL,
  `Firstname` varchar(120) NOT NULL,
  `Lastname` varchar(120) NOT NULL,
  `Gender` varchar(10) NOT NULL,
  `Dob` date DEFAULT NULL,
  `Email` varchar(120) DEFAULT NULL,
  `Tel` varchar(18) NOT NULL,
  `Nation` int(11) NOT NULL,
  `Currency` int(11) NOT NULL,
  `Image` varchar(255) DEFAULT NULL,
  `Status` tinyint(1) DEFAULT 1,
  `Address` text DEFAULT NULL,
  `Remark` text DEFAULT NULL,
  `CreateBy` int(11) DEFAULT NULL,
  `CreateAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdateAt` datetime DEFAULT NULL,
  `del` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`Id`, `OutletId`, `Code`, `Firstname`, `Lastname`, `Gender`, `Dob`, `Email`, `Tel`, `Nation`, `Currency`, `Image`, `Status`, `Address`, `Remark`, `CreateBy`, `CreateAt`, `UpdateAt`, `del`) VALUES
(1, 0, '', 'Mouk', 'Makara', '1', '2004-01-15', 'moukmakara@gmail.com', '013456789', 0, 0, NULL, 1, 'phnom penh', NULL, NULL, '2024-03-11 07:27:29', NULL, 0),
(2, 0, '', 'Dara', 'Makara', '0', '2004-01-20', 'daramakara@gmail.com', '013456789', 0, 0, NULL, 1, 'takeo', NULL, NULL, '2024-03-11 07:27:29', NULL, 0),
(3, 0, '', 'Sopheak', 'Bopha', '0', '2004-01-23', 'sopheakbopha@gmail.com', '013456789', 0, 0, NULL, 1, 'kamport', NULL, NULL, '2024-03-11 07:27:29', NULL, 0),
(4, 1, 'C001', 'Sorn', 'Samneang', '0', '2024-07-17', 'admin@example.com', '0978760040', 1, 1, 'no_image.png', 1, 'Phnom Penh', 'afagfdag', 2, '2024-07-05 20:59:57', NULL, 0),
(5, 1, 'C002', 'Taing', 'Youleang', '0', '2024-07-03', 'admin@example.com', '0978760040', 7, 1, 'no_image.png', 1, 'Phnom Penh', 'fagfgfdsafsaf', 2, '2024-07-05 21:02:28', NULL, 0),
(6, 16, 'C003', 'Sorn', 'Samneang', 'female', '2024-06-30', 'sornsamneang077@gmail.com', '09876543', 8, 2, 'no_image.png', 1, 'Phnom Penh', 'sdfghjkl', 3, '2024-07-05 21:05:31', '2024-07-06 12:10:37', 1),
(7, 30, 'C004', 'Sorn', 'Samneang', 'female', '2024-07-16', '', '', 4, 1, '2024_07_06_12_10_55_487040934_Ederra Rioja (2016).jpg', 1, '', '', 2, '2024-07-05 21:06:53', '2024-07-06 12:11:24', 1),
(8, 1, 'C005', 'Li', 'Young', 'male', '0000-00-00', '', '', 1, 1, 'no_image.png', 1, '', '', 1, '2024-07-06 05:02:57', NULL, 1),
(9, 1, 'C006', 'Van', 'Leo', 'female', '0000-00-00', '', '', 10, 2, 'no_image.png', 1, '', '', 1, '2024-07-06 05:05:39', '2024-07-06 12:06:46', 1);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `Id` int(11) NOT NULL,
  `OutletId` int(11) NOT NULL,
  `Code` varchar(120) NOT NULL,
  `Firstname` varchar(120) NOT NULL,
  `Lastname` varchar(120) NOT NULL,
  `Gender` varchar(10) NOT NULL,
  `Dob` date DEFAULT NULL,
  `Nation` int(11) DEFAULT 1,
  `Marital` varchar(20) NOT NULL,
  `Email` varchar(120) DEFAULT NULL,
  `Tel` varchar(18) DEFAULT NULL,
  `Address` text DEFAULT NULL,
  `EmployeeType` int(11) DEFAULT 1,
  `Salary` decimal(6,2) DEFAULT 0.00,
  `Currency` int(11) DEFAULT 1,
  `Position` int(11) DEFAULT 1,
  `Bank` int(11) DEFAULT 1,
  `AccountName` varchar(200) DEFAULT NULL,
  `AccountNumber` varchar(200) DEFAULT NULL,
  `IdCard` int(20) DEFAULT NULL,
  `Image` varchar(255) DEFAULT NULL,
  `Status` tinyint(1) DEFAULT 1,
  `JoinAT` date DEFAULT NULL,
  `ResignAt` date DEFAULT NULL,
  `ReasonResign` text DEFAULT NULL,
  `CreateBy` int(11) DEFAULT NULL,
  `CreateAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdateAt` datetime DEFAULT NULL,
  `Remark` text DEFAULT NULL,
  `del` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`Id`, `OutletId`, `Code`, `Firstname`, `Lastname`, `Gender`, `Dob`, `Nation`, `Marital`, `Email`, `Tel`, `Address`, `EmployeeType`, `Salary`, `Currency`, `Position`, `Bank`, `AccountName`, `AccountNumber`, `IdCard`, `Image`, `Status`, `JoinAT`, `ResignAt`, `ReasonResign`, `CreateBy`, `CreateAt`, `UpdateAt`, `Remark`, `del`) VALUES
(1, 1, 'E01', 'Mouk', 'Makara', '1', '2004-01-15', 0, '', 'moukmakara@gmail.com', '013456789', '', 0, 0.00, 1, 0, 1, '', '', 0, 'mouk.jpg', 1, NULL, NULL, NULL, 1, '2024-03-06 22:00:00', NULL, NULL, 0),
(2, 1, 'E02', 'Rorn', 'Mony', '1', '2002-05-20', 0, '', 'rornmony@gmail.com', '098764321', '', 0, 0.00, 1, 0, 1, '', '', 0, 'rorn.jpg', 1, NULL, NULL, NULL, 1, '2024-03-06 22:10:00', NULL, NULL, 0),
(3, 3, 'E03', 'Souy', 'Sovichea', '1', '2003-08-10', 0, '', 'souysovichea@gmail.com', '05556777', '', 0, 0.00, 1, 0, 1, '', '', 0, 'souy.jpg', 1, NULL, NULL, NULL, 1, '2024-03-06 22:20:00', NULL, NULL, 0),
(5, 3, 'E04', 'Sok', 'Sreyphea', '0', '2004-12-05', 0, '', 'soksreyphea@gmail.com', '04447888', '', 0, 0.00, 1, 0, 1, '', '', 0, 'sok.jpg', 1, NULL, NULL, NULL, 1, '2024-03-06 22:40:00', NULL, NULL, 0),
(6, 3, 'E05', 'So', 'Dara', '0', '2004-12-05', 0, '', 'sodara@gmail.com', '04447886', '', 0, 0.00, 1, 0, 1, '', '', 0, 'sok.jpg', 1, NULL, NULL, NULL, 1, '2024-03-06 22:40:00', NULL, NULL, 0),
(7, 1, 'E015', 'Sorn', 'Samneang', 'female', '0000-00-00', 1, 'single', '', '', '', 1, 0.00, 0, 1, 0, '', '', 0, 'no_image.png', 1, '0000-00-00', '0000-00-00', '', 1, '2024-06-20 03:52:51', '2024-07-04 17:59:24', '', 1),
(8, 3, 'E020', 'Sorn', 'Ronaldo', 'male', '2002-07-27', 9, 'married', 'sornsamneang077@gmail.com', '0978760040', 'Phnom Penh', 1, 1000.00, 1, 4, 2, 'Sorn Samneang', '12345678', 9876543, '2024_07_06_05_39_46_1948171886_images.jpg', 1, '2024-01-01', '2024-06-20', 'Continue Study', 1, '2024-06-20 04:47:34', '2024-07-06 05:39:46', 'worked 6 month', 1),
(9, 1, 'E08', 'Sorn', 'Samneang', 'male', '0000-00-00', 1, 'single', '', '', '', 1, 0.00, 0, 1, 0, '', '', 0, 'no_image.png', 1, '0000-00-00', '0000-00-00', '', 1, '2024-06-22 01:44:56', NULL, '', 1),
(10, 1, 'E09', 'Sorn', 'Samneang', 'male', '0000-00-00', 1, 'married', '', '', '', 1, 0.00, 0, 1, 0, '', '', 0, 'no_image.png', 1, '0000-00-00', '0000-00-00', '', 2, '2024-06-22 02:17:34', '2024-06-24 17:16:41', '', 1),
(11, 1, 'E010', 'Taing', 'Youleang', 'male', '0000-00-00', 1, 'single', '', '', '', 1, 0.00, 0, 1, 0, '', '', 0, '2024_07_01_09_16_34_2088618852_Cambodia-Premium-Draft-Beer-Bott.jpg', 1, '0000-00-00', '0000-00-00', '', 1, '2024-07-01 02:16:34', NULL, '', 0),
(12, 1, 'E014', 'Ti', 'Ti', 'female', '0000-00-00', 1, 'single', '', '', '', 1, 0.00, 0, 1, 0, '', '', 0, 'no_image.png', 1, '0000-00-00', '0000-00-00', '', 1, '2024-07-04 10:34:37', '2024-07-04 18:02:27', '', 1),
(13, 1, 'E018', 'Ti', 'Ronaldo', 'female', '0000-00-00', 1, 'single', '', '', '', 1, 0.00, 0, 1, 0, '', '', 0, 'no_image.png', 1, '0000-00-00', '0000-00-00', '', 1, '2024-07-05 20:27:09', '2024-07-06 05:18:44', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `employeepayroll`
--

CREATE TABLE `employeepayroll` (
  `Id` int(11) NOT NULL,
  `EmployeeId` int(11) NOT NULL,
  `PayrollId` int(11) NOT NULL,
  `BaseSalary` decimal(6,2) DEFAULT NULL,
  `Bunus` decimal(6,2) DEFAULT NULL,
  `Food` decimal(6,2) DEFAULT NULL,
  `OT` decimal(6,2) DEFAULT NULL,
  `Total` decimal(6,2) DEFAULT NULL,
  `Currency` int(11) DEFAULT 1,
  `CreateBy` int(11) DEFAULT NULL,
  `CreateAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `Remark` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `employeepayroll`
--

INSERT INTO `employeepayroll` (`Id`, `EmployeeId`, `PayrollId`, `BaseSalary`, `Bunus`, `Food`, `OT`, `Total`, `Currency`, `CreateBy`, `CreateAt`, `Remark`) VALUES
(1, 1, 1, 500.00, 1300.00, 50.00, 50.00, 1900.00, NULL, 1, '2024-03-11 07:07:48', NULL),
(2, 2, 1, 500.00, 1200.00, 50.00, 50.00, 1800.00, NULL, 1, '2024-03-11 07:07:48', NULL),
(3, 3, 1, 600.00, 1200.00, 50.00, 50.00, 1900.00, NULL, 1, '2024-03-11 07:07:48', NULL),
(4, 4, 1, 600.00, 1200.00, 50.00, 50.00, 1900.00, NULL, 1, '2024-03-11 07:07:48', NULL),
(5, 5, 1, 600.00, 1200.00, 50.00, 50.00, 1900.00, NULL, 1, '2024-03-11 07:07:48', NULL),
(6, 6, 1, 600.00, 1200.00, 50.00, 50.00, 1900.00, NULL, 1, '2024-03-11 07:07:48', NULL),
(7, 1, 2, 500.00, 1300.00, 50.00, 50.00, 1900.00, NULL, 1, '2024-03-11 07:07:48', NULL),
(8, 2, 2, 500.00, 1200.00, 50.00, 50.00, 1800.00, NULL, 1, '2024-03-11 07:07:48', NULL),
(9, 3, 2, 600.00, 1200.00, 50.00, 50.00, 1900.00, NULL, 1, '2024-03-11 07:07:48', NULL),
(10, 4, 2, 600.00, 1200.00, 50.00, 50.00, 1900.00, NULL, 1, '2024-03-11 07:07:48', NULL),
(11, 5, 2, 600.00, 1200.00, 50.00, 50.00, 1900.00, NULL, 1, '2024-03-11 07:07:48', NULL),
(12, 6, 2, 600.00, 1200.00, 50.00, 50.00, 1900.00, NULL, 1, '2024-03-11 07:07:48', NULL),
(13, 1, 3, 500.00, 1300.00, 50.00, 50.00, 1900.00, NULL, 1, '2024-03-11 07:07:48', NULL),
(14, 2, 3, 500.00, 1200.00, 50.00, 50.00, 1800.00, NULL, 1, '2024-03-11 07:07:48', NULL),
(15, 3, 3, 600.00, 1200.00, 50.00, 50.00, 1900.00, NULL, 1, '2024-03-11 07:07:48', NULL),
(16, 4, 3, 600.00, 1200.00, 50.00, 50.00, 1900.00, NULL, 1, '2024-03-11 07:07:48', NULL),
(17, 5, 3, 600.00, 1200.00, 50.00, 50.00, 1900.00, NULL, 1, '2024-03-11 07:07:48', NULL),
(18, 6, 3, 600.00, 1200.00, 50.00, 50.00, 1900.00, NULL, 1, '2024-03-11 07:07:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employeereviewsalary`
--

CREATE TABLE `employeereviewsalary` (
  `Id` int(11) NOT NULL,
  `EmployeeId` int(11) DEFAULT NULL,
  `OldSalary` decimal(6,2) DEFAULT NULL,
  `IncreaseSalary` decimal(6,2) DEFAULT NULL,
  `NewSalary` decimal(6,2) DEFAULT NULL,
  `Currency` int(11) DEFAULT 1,
  `ReviewAt` decimal(6,2) DEFAULT NULL,
  `ReviewBy` int(11) DEFAULT NULL,
  `ApproveAt` datetime DEFAULT NULL,
  `ApproveBy` int(11) DEFAULT NULL,
  `Status` tinyint(1) DEFAULT 1,
  `CreateBy` int(11) DEFAULT NULL,
  `CreateAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdateAt` datetime DEFAULT NULL,
  `Remark` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employeetype`
--

CREATE TABLE `employeetype` (
  `Id` int(11) NOT NULL,
  `EmployeeType` varchar(200) NOT NULL,
  `CreateBy` int(11) NOT NULL,
  `Remark` text NOT NULL,
  `Status` tinyint(1) NOT NULL,
  `CreateAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `UpdateAt` datetime NOT NULL,
  `del` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `employeetype`
--

INSERT INTO `employeetype` (`Id`, `EmployeeType`, `CreateBy`, `Remark`, `Status`, `CreateAt`, `UpdateAt`, `del`) VALUES
(1, 'Full Time', 1, '', 1, '2024-06-18 15:28:19', '0000-00-00 00:00:00', 1),
(2, 'Part Time', 1, '', 1, '2024-06-18 10:01:51', '0000-00-00 00:00:00', 1),
(3, 'Internship', 1, '', 1, '2024-06-18 10:02:11', '0000-00-00 00:00:00', 1),
(4, 'Volunteer', 1, '', 1, '2024-06-18 10:02:34', '0000-00-00 00:00:00', 1),
(5, 'svsddbvbbnbbbb', 1, 'safagafva', 0, '2024-07-04 05:05:56', '2024-07-04 12:05:50', 0);

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `Id` int(11) NOT NULL,
  `OutletId` int(11) DEFAULT NULL,
  `TableId` int(11) NOT NULL,
  `CustomerId` int(11) DEFAULT NULL,
  `ShiftDetailsId` int(11) DEFAULT NULL,
  `PaymentMethodId` int(11) DEFAULT NULL,
  `InvoiceStatus` varchar(120) DEFAULT NULL,
  `AmountInUSD` decimal(6,2) DEFAULT NULL,
  `AmountInKHR` decimal(6,2) DEFAULT NULL,
  `PaidInUSD` decimal(6,2) DEFAULT NULL,
  `PaidInKHR` decimal(6,2) DEFAULT NULL,
  `Status` tinyint(1) DEFAULT 1,
  `CreateBy` int(11) DEFAULT NULL,
  `CreateAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdateAt` datetime DEFAULT NULL,
  `del` tinyint(4) DEFAULT 1,
  `Remark` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`Id`, `OutletId`, `TableId`, `CustomerId`, `ShiftDetailsId`, `PaymentMethodId`, `InvoiceStatus`, `AmountInUSD`, `AmountInKHR`, `PaidInUSD`, `PaidInKHR`, `Status`, `CreateBy`, `CreateAt`, `UpdateAt`, `del`, `Remark`) VALUES
(1, 1, 1, 1, 1, 1, NULL, 10.00, 0.00, 10.00, 0.00, 1, 1, '2024-03-15 04:40:04', NULL, 1, NULL),
(2, 1, 1, 1, 1, 1, NULL, 5.00, 0.00, 5.00, 0.00, 1, 1, '2024-03-15 04:40:04', NULL, 1, NULL),
(3, 1, 2, 1, 1, 1, NULL, 6.00, 0.00, 6.00, 0.00, 1, 1, '2024-03-15 04:40:04', NULL, 1, NULL),
(4, 1, 2, 1, 1, 1, NULL, 6.00, 0.00, 6.00, 0.00, 1, 1, '2024-03-15 04:40:04', NULL, 1, NULL),
(5, 1, 3, 1, 2, 1, NULL, 10.00, 0.00, 10.00, 0.00, 1, 1, '2024-03-15 04:40:04', NULL, 1, NULL),
(6, 1, 3, 1, 2, 1, NULL, 5.00, 0.00, 5.00, 0.00, 1, 1, '2024-03-15 04:40:04', NULL, 1, NULL),
(7, 1, 4, 1, 2, 1, NULL, 6.00, 0.00, 6.00, 0.00, 1, 1, '2024-03-15 04:40:04', NULL, 1, NULL),
(8, 1, 4, 9, 2, 1, NULL, 6.00, 0.00, 6.00, 0.00, 1, 1, '2024-03-15 04:40:04', NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `invoicedetails`
--

CREATE TABLE `invoicedetails` (
  `Id` int(11) NOT NULL,
  `InvoiceId` int(11) DEFAULT NULL,
  `ProductSkuId` int(11) DEFAULT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `Currency` int(11) DEFAULT 1,
  `Price` decimal(6,2) DEFAULT NULL,
  `Discount` decimal(6,2) DEFAULT NULL,
  `Total` decimal(6,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `invoicedetails`
--

INSERT INTO `invoicedetails` (`Id`, `InvoiceId`, `ProductSkuId`, `Quantity`, `Currency`, `Price`, `Discount`, `Total`) VALUES
(1, 1, 1, 2, NULL, 2.00, 0.00, 2.00),
(2, 1, 1, 3, NULL, 3.00, 0.00, 3.00),
(3, 1, 1, 3, NULL, 3.00, 0.00, 3.00),
(4, 1, 1, 4, NULL, 4.00, 0.00, 4.00),
(5, 2, 1, 2, NULL, 2.00, 0.00, 2.00),
(6, 2, 1, 3, NULL, 3.00, 0.00, 3.00),
(7, 3, 1, 2, NULL, 2.00, 0.00, 2.00),
(8, 3, 2, 3, NULL, 2.00, 0.00, 6.00),
(9, 4, 1, 2, NULL, 2.00, 0.00, 2.00),
(10, 4, 2, 3, NULL, 2.00, 0.00, 6.00),
(11, 5, 1, 2, NULL, 2.00, 0.00, 2.00),
(12, 5, 1, 3, NULL, 2.00, 0.00, 3.00),
(13, 5, 1, 3, NULL, 1.00, 0.00, 3.00),
(14, 5, 1, 4, NULL, 1.00, 0.00, 4.00),
(15, 6, 1, 1, NULL, 2.00, 0.00, 2.00),
(16, 6, 1, 1, NULL, 3.00, 0.00, 3.00),
(17, 7, 1, 2, NULL, 2.00, 0.00, 4.00),
(18, 7, 2, 3, NULL, 2.00, 0.00, 6.00),
(19, 8, 1, 2, NULL, 2.00, 0.00, 4.00),
(20, 8, 2, 3, NULL, 2.00, 0.00, 6.00);

-- --------------------------------------------------------

--
-- Table structure for table `nationality`
--

CREATE TABLE `nationality` (
  `Id` int(11) NOT NULL,
  `Nation` varchar(200) NOT NULL,
  `CreateBy` int(11) NOT NULL,
  `Remark` text DEFAULT NULL,
  `Status` tinyint(1) NOT NULL,
  `CreateAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `UpdateAt` datetime NOT NULL,
  `del` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nationality`
--

INSERT INTO `nationality` (`Id`, `Nation`, `CreateBy`, `Remark`, `Status`, `CreateAt`, `UpdateAt`, `del`) VALUES
(1, 'Khmer', 1, NULL, 1, '2024-06-18 10:03:18', '0000-00-00 00:00:00', 1),
(2, 'Brunei', 1, NULL, 1, '2024-06-18 10:03:33', '0000-00-00 00:00:00', 1),
(3, 'East-Timor', 1, NULL, 1, '2024-06-18 10:03:50', '0000-00-00 00:00:00', 1),
(4, 'Indonesia', 1, NULL, 1, '2024-06-18 10:04:06', '0000-00-00 00:00:00', 1),
(5, 'Laos', 1, NULL, 1, '2024-06-18 10:04:19', '0000-00-00 00:00:00', 1),
(6, 'Malaysia', 1, NULL, 1, '2024-06-18 10:04:31', '0000-00-00 00:00:00', 1),
(7, 'Myanmar', 1, NULL, 1, '2024-06-18 10:04:47', '0000-00-00 00:00:00', 1),
(8, 'Philippines', 1, NULL, 1, '2024-06-18 10:05:04', '0000-00-00 00:00:00', 1),
(9, 'Singapore', 1, NULL, 1, '2024-06-18 10:05:19', '0000-00-00 00:00:00', 1),
(10, 'Thailand', 1, NULL, 1, '2024-06-18 10:05:57', '0000-00-00 00:00:00', 1),
(11, 'Vietnam', 1, NULL, 1, '2024-06-18 10:06:11', '0000-00-00 00:00:00', 1),
(12, 'dfasfdasgsfsdgvsdgsdgsd', 2, 'sgdsdgvsdgsgdsfg', 0, '2024-07-04 08:32:30', '2024-07-04 15:32:26', 0);

-- --------------------------------------------------------

--
-- Table structure for table `outlet`
--

CREATE TABLE `outlet` (
  `Id` int(11) NOT NULL,
  `Name` varchar(120) NOT NULL,
  `Code` varchar(120) NOT NULL,
  `Status` tinyint(1) DEFAULT 1,
  `Address` text DEFAULT NULL,
  `Logo` varchar(255) DEFAULT NULL,
  `CreateBy` int(11) DEFAULT NULL,
  `CreateAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdateAt` datetime DEFAULT NULL,
  `ApproveBy` int(11) DEFAULT NULL,
  `ApproveAt` datetime DEFAULT NULL,
  `Remark` text DEFAULT NULL,
  `del` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `outlet`
--

INSERT INTO `outlet` (`Id`, `Name`, `Code`, `Status`, `Address`, `Logo`, `CreateBy`, `CreateAt`, `UpdateAt`, `ApproveBy`, `ApproveAt`, `Remark`, `del`) VALUES
(1, 'Beong Kok-I', 'BK-I', 1, '#123, st345, Beong kok, Phnom Penh', '2024_06_13_16_29_34_120002940_Cambodia-Prize-Can-330ml.jpg', 1, '2024-03-12 08:36:53', '2024-06-13 16:29:34', NULL, NULL, 'sgdgsdgsgg', 1),
(2, 'Beong Kok-II', 'BK-II', 1, '#143, st3475, Beong kokII, Phnom Penh', 'apple-iphone-15-1.jpg', 1, '2024-03-12 08:36:53', NULL, NULL, NULL, '', 0),
(3, 'Beong Kok-III', 'BK-III', 1, '#1243, st3545, Beong kokIII, Phnom Penh', NULL, 1, '2024-03-12 08:36:53', '2024-06-14 09:57:28', NULL, NULL, '', 1),
(5, 'Test101', 'Test101', 1, '#143, st3475, Beong kokII, Phnom Penh', NULL, 2, '2024-03-12 09:02:27', NULL, NULL, NULL, NULL, 1),
(8, 'SKI-TTP', 'SKI-TTP', 1, '#125, st48, Toul Tom Pong, Phnom Phenh', NULL, 3, '2024-03-06 07:03:18', NULL, NULL, NULL, NULL, 1),
(9, 'SKI-BKK', 'SKI-BKK', 0, '#13, st47, Beong Keng Kong, Phnom Phenh', NULL, 4, '2024-03-06 07:03:18', NULL, NULL, NULL, NULL, 1),
(10, 'SKI-TK11', 'SKI-TK', 1, '#123, st45, Toul Kok, Phnom Phenh', NULL, 4, '2024-03-06 07:24:43', NULL, NULL, NULL, NULL, 1),
(14, 'apple-iphone-15-1.jpg', 'FB', 1, '', '2024_06_13_13_38_41_1903366227_Oppo Reno 10.jpg', 1, '2024-06-11 03:41:44', '2024-06-13 13:38:41', NULL, NULL, '', 0),
(15, 'apple-iphone-15-1.jpg', 'FB', 1, 'Phnom Penh', '2024_06_13_13_37_06_1101438689_Huawei P30 Pro.jpg', 3, '2024-06-11 03:43:19', '0000-00-00 00:00:00', NULL, NULL, 'Product application USA', 1),
(16, 'LV Cambodia', 'LV', 1, 'Phnom Penh', '2024_06_13_17_05_16_470932956_Carabao.jpg', 2, '2024-06-11 08:34:43', '2024-06-13 17:05:16', NULL, NULL, 'new product usa', 1),
(17, 'Google', 'oppo', 1, '', '2024_07_06_05_22_01_383648821_Tiger Blue Can 330ml.jpg', 1, '2024-06-13 09:40:01', '2024-07-06 05:22:01', NULL, NULL, '', 1),
(18, 'Google', 'GG', 1, '', '2024_06_13_17_04_01_854783838_Cambodia Beer Snow Glass.jpg', 1, '2024-06-13 09:41:05', '2024-06-13 17:04:01', NULL, NULL, '', 0),
(19, 'Google', 'oppo', 1, 'Phnom Penh', '2024_07_06_04_56_34_57250555_Capture.PNG', 3, '2024-06-13 09:45:54', '2024-07-06 04:56:34', NULL, NULL, 'Coffee', 1),
(20, 'Google', 'oppo', 1, 'Phnom Penh', '2024_06_13_16_49_58_1660974117_ABC Can 330ml.jpg', 1, '2024-06-13 09:49:58', NULL, NULL, NULL, '', 1),
(21, 'Marvel', 'oppo', 1, '', '2024_06_13_16_51_21_257690826_coca colas.jpg', 1, '2024-06-13 09:51:21', NULL, NULL, NULL, '', 1),
(23, 'Oppo', 'GG', 1, '', '2024_06_13_17_05_43_372586517_Anchor-Small-Btl-330ml-01-1.jpg', 1, '2024-06-13 10:05:43', NULL, NULL, NULL, '', 1),
(24, 'Lenovo PC', 'Len', 1, 'Phnom Penh', '2024_06_13_17_19_49_1670628596_Schweppes-Soda-Water-330ml.jpg', 1, '2024-06-13 10:19:49', '2024-06-20 17:19:50', NULL, NULL, '', 1),
(25, 'Google', 'oppo', 1, 'Phnom Penh', '2024_06_13_17_20_23_2144047118_Bacchus.jpg', 1, '2024-06-13 10:20:23', '2024-06-14 09:19:50', NULL, NULL, '', 1),
(26, 'Cambodia', 'Cam', 1, '', '2024_06_13_17_22_14_679037904_Red-Bull-Energy-Drink-12-fl-oz-C.jpg', 1, '2024-06-13 10:22:14', '2024-06-14 09:54:00', NULL, NULL, '', 0),
(27, 'Google', 'Cam', 1, '', '2024_06_13_17_30_42_397332454_Ganzberg Can 330ml.jpg', 1, '2024-06-13 10:30:42', NULL, NULL, NULL, '', 0),
(28, 'Zoo Cambodia', 'Zoo', 1, '', '2024_06_14_08_52_08_273491416_fanta-orange.jpg', 1, '2024-06-14 01:45:53', '2024-06-14 08:52:08', NULL, NULL, 'fanfa', 1),
(29, 'Google', 'GG', 1, '', 'no_image.png', 1, '2024-06-14 01:55:07', NULL, NULL, NULL, '', 1),
(30, 'Oppo', 'oppo', 1, 'China', '2024_06_14_09_06_41_478295514_SM10287475-9.jpg', 1, '2024-06-14 02:06:41', '2024-06-14 09:13:50', NULL, NULL, 'OPPO', 1),
(31, 'Google', 'GG', 1, 'Phnom Penh', '2024_06_14_09_19_33_1289311744_Bacchus.jpg', 1, '2024-06-14 02:19:33', NULL, NULL, NULL, '', 1),
(32, 'Cambodia', 'Cam', 1, '', '2024_06_14_09_21_30_26891278_Cambodia Beer Snow Glass.jpg', 3, '2024-06-14 02:21:30', NULL, NULL, NULL, '', 0),
(33, 'Maxell', 'Max', 0, 'Phnom Penh', '2024_07_01_09_15_13_1812462171_Sprite.jpg', 2, '2024-07-01 02:15:13', '2024-07-01 09:15:43', NULL, NULL, '', 0),
(34, 'Viso home', 'Viso', 1, 'Phnom Penh', '2024_07_06_05_10_21_1410483045_Red-Bull-Energy-Drink-12-fl-oz-C.jpg', 1, '2024-07-05 21:22:40', '2024-07-06 05:10:21', NULL, NULL, '', 1),
(35, 'Football Football ', 'Foot', 1, '', 'no_image.png', 1, '2024-07-05 22:12:56', NULL, NULL, NULL, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `paymentmethod`
--

CREATE TABLE `paymentmethod` (
  `Id` int(11) NOT NULL,
  `Name` varchar(120) NOT NULL,
  `Code` varchar(120) NOT NULL,
  `Status` tinyint(1) DEFAULT 1,
  `CreateBy` int(11) DEFAULT NULL,
  `CreateAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdateAt` datetime DEFAULT NULL,
  `del` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `paymentmethod`
--

INSERT INTO `paymentmethod` (`Id`, `Name`, `Code`, `Status`, `CreateBy`, `CreateAt`, `UpdateAt`, `del`) VALUES
(1, 'cash', 'cash', 1, 1, '2024-03-07 01:30:00', NULL, 1),
(2, 'aba', 'aba', 1, 1, '2024-03-07 01:30:00', NULL, 1),
(3, 'aceleda', 'aceleda', 1, 1, '2024-03-07 02:30:00', NULL, 1),
(4, 'wing', 'wing', 1, 1, '2024-03-07 03:30:00', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `payroll`
--

CREATE TABLE `payroll` (
  `Id` int(11) NOT NULL,
  `Name` varchar(120) NOT NULL,
  `Note` text DEFAULT NULL,
  `ApprovedAt` datetime DEFAULT NULL,
  `ApprovedBy` int(11) DEFAULT NULL,
  `CreateBy` int(11) DEFAULT NULL,
  `CreateAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `payroll`
--

INSERT INTO `payroll` (`Id`, `Name`, `Note`, `ApprovedAt`, `ApprovedBy`, `CreateBy`, `CreateAt`) VALUES
(1, 'Jan-2024', 'Payroll in Jan 2024', NULL, 1, 1, '2024-03-11 07:06:22'),
(2, 'Feb-2024', 'Payroll in Feb 2024', NULL, 1, 1, '2024-03-11 07:06:22'),
(3, 'March-2024', 'Payroll in Feb 2024', NULL, 1, 1, '2024-03-11 07:06:22');

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `Id` int(11) NOT NULL,
  `Positions` varchar(200) NOT NULL,
  `CreateBy` int(11) NOT NULL,
  `Remark` text NOT NULL,
  `Status` int(1) NOT NULL,
  `CreateAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `UpdateAt` datetime NOT NULL,
  `del` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`Id`, `Positions`, `CreateBy`, `Remark`, `Status`, `CreateAt`, `UpdateAt`, `del`) VALUES
(1, 'CEO', 1, '', 1, '2024-06-18 15:16:56', '0000-00-00 00:00:00', 1),
(2, 'Manager', 1, '', 1, '2024-06-18 15:17:16', '0000-00-00 00:00:00', 1),
(3, 'Accounting', 1, '', 1, '2024-06-18 15:18:44', '0000-00-00 00:00:00', 1),
(4, 'Human Resource', 1, '', 1, '2024-06-18 15:19:36', '0000-00-00 00:00:00', 1),
(5, 'Store Manager', 1, '', 1, '2024-06-18 15:21:12', '0000-00-00 00:00:00', 1),
(6, 'Cashier', 1, '', 1, '2024-06-18 15:21:28', '0000-00-00 00:00:00', 1),
(7, 'Cleaner', 1, '', 1, '2024-06-18 15:21:40', '0000-00-00 00:00:00', 1),
(8, 'Waiter', 1, '', 1, '2024-06-18 15:22:38', '0000-00-00 00:00:00', 1),
(9, 'Security', 1, '', 1, '2024-06-18 15:23:17', '0000-00-00 00:00:00', 1),
(10, 'sabsdfsgsgsdvs', 2, 'tyjty54u45tjrthj', 0, '2024-07-04 09:42:29', '2024-07-04 16:42:26', 0);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `Id` int(11) NOT NULL,
  `ProCode` varchar(10) DEFAULT NULL,
  `CategoryId` int(11) DEFAULT NULL,
  `SkuId` int(11) NOT NULL,
  `Name` varchar(120) NOT NULL,
  `Description` text DEFAULT NULL,
  `Image` varchar(255) DEFAULT NULL,
  `Status` tinyint(1) DEFAULT 1,
  `CreateBy` int(11) DEFAULT NULL,
  `CreateAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdateAt` datetime DEFAULT NULL,
  `del` tinyint(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`Id`, `ProCode`, `CategoryId`, `SkuId`, `Name`, `Description`, `Image`, `Status`, `CreateBy`, `CreateAt`, `UpdateAt`, `del`) VALUES
(1, NULL, 1, 1, 'Iced-latte', 'Iced-latte my favourite coffee', 'Iced-latte_image.jpg', 0, 1, '2024-03-11 07:10:06', NULL, 1),
(2, NULL, 2, 2, 'Hot-latte', 'Hot-latte my favourite coffee', 'Hot-latte_image.jpg', 1, 1, '2024-03-11 07:10:06', NULL, 1),
(3, NULL, 3, 1, 'Passion-soda', 'Passion-soda my favourite coffee', 'Passion-soda_image.jpg', 1, 2, '2024-03-11 07:10:06', NULL, 1),
(4, NULL, 4, 4, 'Iced-lemon-tea', 'Iced-lemon-tea my favourite coffee', 'Iced-lemon-tea_image.jpg', 1, 2, '2024-03-11 07:10:06', NULL, 1),
(5, NULL, 5, 5, 'Chocolate-frappe', 'Chocolate-frappe my favourite coffee', 'Chocolate-frappe_image.jpg', 1, 3, '2024-03-11 07:10:06', NULL, 1),
(6, NULL, 6, 7, 'Passion-cream', 'Passion-cream my favourite coffee', 'Passion-cream_image.jpg', 1, 3, '2024-03-11 07:10:06', NULL, 1),
(7, NULL, 1, 8, 'Iced-americano', 'Iced-americano my favourite coffee', 'Iced-americano_image.jpg', 0, 1, '2024-03-11 07:10:06', NULL, 1),
(8, NULL, 2, 4, 'Hot-cappucino', 'Hot-cappucino my favourite coffee', 'Hot-cappucino_image.jpg', 1, 1, '2024-03-11 07:10:06', NULL, 1),
(9, NULL, 3, 8, 'Blue-soda', 'Blue-soda my favourite coffee', 'Blue-soda_image.jpg', 1, 2, '2024-03-11 07:10:06', NULL, 1),
(10, NULL, 4, 4, 'Mint-ice-greentea', 'Mint-ice-greentea my favourite coffee', 'Mint-ice-greentea_image.jpg', 1, 1, '2024-03-11 07:10:06', NULL, 1),
(11, NULL, 5, 9, 'Cookie-frappe', 'Cookie-frappe my favourite coffee', 'Cookie-frappe_image.jpg', 1, 2, '2024-03-11 07:10:06', NULL, 1),
(12, NULL, 6, 11, 'Mango-cream', 'Mango-cream my favourite coffee', 'Mango_image.jpg', 1, 1, '2024-03-11 07:10:06', NULL, 1),
(13, 'Ice-0012', 1, 2, 'Iced-latte002', 'Iced-latte my favourite coffee', 'Iced-latte_image.jpg', 1, 1, '2024-03-11 07:10:06', NULL, 1),
(16, 'sdf', 4, 0, 'sd', 'sdf', 'no_image.png', 0, 1, '2024-06-01 18:28:32', NULL, 1),
(17, 'Ice_cycold', 1, 0, 'Ice_cycold', 'Ice_cycold', '2024_06_01_20_33_44_28973892_ភូមិ(១).png', 1, 3, '2024-06-01 18:33:44', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `productsku`
--

CREATE TABLE `productsku` (
  `Id` int(11) NOT NULL,
  `ProductId` int(11) DEFAULT NULL,
  `UomId` int(11) DEFAULT NULL,
  `Price` decimal(11,2) NOT NULL,
  `Currency` int(11) DEFAULT 1,
  `UpdateAt` datetime DEFAULT NULL,
  `del` tinyint(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `productsku`
--

INSERT INTO `productsku` (`Id`, `ProductId`, `UomId`, `Price`, `Currency`, `UpdateAt`, `del`) VALUES
(1, 1, 1, 2.00, 1, NULL, 1),
(2, 1, 2, 2.30, 1, NULL, 1),
(3, 3, 3, 12300.00, 2, NULL, 1),
(4, 2, 1, 2.00, 1, NULL, 1),
(5, 2, 2, 2.30, 1, NULL, 1),
(6, 2, 3, 2.30, 1, NULL, 1),
(7, 3, 1, 2.00, 1, NULL, 1),
(8, 3, 2, 2.30, 1, NULL, 1),
(9, 3, 3, 2.30, 1, NULL, 1),
(10, 4, 1, 2.00, 1, NULL, 1),
(11, 4, 2, 2.30, 1, NULL, 1),
(12, 4, 3, 2.30, 1, NULL, 1),
(13, 5, 1, 2.00, 1, NULL, 1),
(14, 5, 2, 9000.00, 2, NULL, 1),
(15, 5, 3, 2.30, 1, NULL, 1),
(16, 6, 1, 2.00, 1, NULL, 1),
(17, 6, 2, 2.30, 1, NULL, 1),
(18, 6, 3, 2.30, 1, NULL, 1),
(19, 7, 1, 2.00, 1, NULL, 1),
(20, 7, 2, 2.30, 1, NULL, 1),
(21, 7, 3, 2.30, 1, NULL, 1),
(22, 8, 1, 2.00, 1, NULL, 1),
(23, 8, 2, 2.30, 1, NULL, 1),
(24, 8, 3, 2.30, 1, NULL, 1),
(25, 1, 1, 8000.00, 2, NULL, 1),
(27, 9, 3, 2.30, 1, '0000-00-00 00:00:00', 1),
(28, 10, 1, 2.00, 1, NULL, 1),
(29, 10, 2, 2.30, 1, NULL, 1),
(30, 10, 3, 2.30, 1, NULL, 1),
(31, 11, 1, 2.00, 1, NULL, 1),
(32, 11, 2, 2.30, 1, NULL, 1),
(33, 11, 3, 2.30, 1, NULL, 1),
(34, 12, 1, 2.00, 1, NULL, 1),
(35, 12, 2, 2.30, 1, NULL, 1),
(36, 12, 3, 2.30, 1, NULL, 1),
(38, 17, 2, 15.00, 1, NULL, 1),
(39, 17, 2, 16.00, 1, NULL, 1),
(40, 1, 1, 1.00, 1, NULL, 1),
(41, 9, 1, 8000.00, 2, NULL, 1),
(45, 16, 1, 123.00, 1, NULL, 1),
(47, 16, 1, 1111.00, 1, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pro_in`
--

CREATE TABLE `pro_in` (
  `Id` int(11) NOT NULL,
  `RecieveDate` date DEFAULT NULL,
  `RecieveBy` tinyint(4) DEFAULT NULL,
  `Supplier` tinyint(4) DEFAULT NULL,
  `PurchaseNo` varchar(20) DEFAULT NULL,
  `ProId` int(11) NOT NULL,
  `Uom` int(11) DEFAULT NULL,
  `Qty_In` int(11) NOT NULL,
  `Price_In` decimal(10,2) DEFAULT NULL,
  `DiscountAmount` decimal(10,2) DEFAULT 0.00,
  `Currency` int(11) DEFAULT 1,
  `Description` text DEFAULT NULL,
  `Paid` decimal(10,2) DEFAULT NULL,
  `PaymentStatus` tinyint(4) DEFAULT NULL,
  `CreateBy` int(11) DEFAULT NULL,
  `CreateAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdateAt` datetime DEFAULT NULL,
  `del` tinyint(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pro_moment`
--

CREATE TABLE `pro_moment` (
  `Id` int(11) NOT NULL,
  `ProId` int(11) NOT NULL,
  `Pro_Out_Id` int(11) DEFAULT NULL,
  `Pro_In_Id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pro_out`
--

CREATE TABLE `pro_out` (
  `Id` int(11) NOT NULL,
  `SaleDate` date DEFAULT NULL,
  `SaleNo` varchar(11) DEFAULT NULL,
  `Customer` int(11) DEFAULT NULL,
  `Uom` int(11) DEFAULT NULL,
  `Paid` decimal(10,2) NOT NULL DEFAULT 0.00,
  `Status` int(11) DEFAULT NULL,
  `ProId` int(11) NOT NULL,
  `TableId` int(11) NOT NULL,
  `Qty_Out` int(11) NOT NULL,
  `Price_Out` int(11) NOT NULL,
  `Disc_Amount` decimal(10,2) DEFAULT NULL,
  `Disc_Percent` int(11) NOT NULL,
  `Qty_Out_Free` int(11) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `Currency` int(11) DEFAULT 1,
  `SaleBy` int(11) DEFAULT NULL COMMENT 'Employee',
  `CreateAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdateAt` datetime DEFAULT NULL,
  `del` tinyint(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `Id` int(11) NOT NULL,
  `Name` varchar(120) NOT NULL,
  `Code` varchar(120) NOT NULL,
  `Status` tinyint(1) DEFAULT 1,
  `CreateBy` int(11) DEFAULT NULL,
  `CreateAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdateAt` datetime DEFAULT NULL,
  `del` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`Id`, `Name`, `Code`, `Status`, `CreateBy`, `CreateAt`, `UpdateAt`, `del`) VALUES
(1, 'Admin', 'ADM', 1, 1, '2024-03-06 22:00:00', NULL, 1),
(2, 'Manager', 'MGR', 1, 1, '2024-03-05 20:30:00', NULL, 1),
(3, 'Cashair', 'Cashair', 1, 1, '2024-03-05 20:30:00', NULL, 1),
(4, 'Service', 'Service', 1, 103, '2024-03-05 01:45:00', NULL, 1),
(5, 'Accountant', 'ACC', 1, 1, '2024-03-03 18:20:00', NULL, 1),
(6, 'IT', 'IT', 1, 1, '2024-03-03 00:10:00', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `shift`
--

CREATE TABLE `shift` (
  `Id` int(11) NOT NULL,
  `Name` varchar(120) NOT NULL,
  `Status` tinyint(1) DEFAULT 1,
  `CreateBy` int(11) DEFAULT NULL,
  `CreateAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdateAt` datetime DEFAULT NULL,
  `Remark` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `shift`
--

INSERT INTO `shift` (`Id`, `Name`, `Status`, `CreateBy`, `CreateAt`, `UpdateAt`, `Remark`) VALUES
(1, 'Morning Shift', 1, 1, '2024-03-11 06:48:57', NULL, NULL),
(2, 'Evening Shift', 1, 1, '2024-03-11 06:48:57', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shiftdetails`
--

CREATE TABLE `shiftdetails` (
  `Id` int(11) NOT NULL,
  `ShiftId` int(11) DEFAULT NULL,
  `UserId` int(11) DEFAULT NULL,
  `OpenningBalance` decimal(6,2) DEFAULT NULL,
  `ClosingBalance` decimal(6,2) DEFAULT NULL,
  `Currency` varchar(11) DEFAULT NULL,
  `Isclosed` tinyint(1) DEFAULT 0,
  `CloseBy` int(11) DEFAULT NULL,
  `CloseAt` datetime DEFAULT NULL,
  `Status` tinyint(1) DEFAULT 1,
  `CreateAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdateAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `shiftdetails`
--

INSERT INTO `shiftdetails` (`Id`, `ShiftId`, `UserId`, `OpenningBalance`, `ClosingBalance`, `Currency`, `Isclosed`, `CloseBy`, `CloseAt`, `Status`, `CreateAt`, `UpdateAt`) VALUES
(1, 1, 1, 80.00, 80.00, '1', 0, NULL, NULL, 1, '2024-03-05 10:00:00', NULL),
(2, 2, 2, 90.00, 90.00, '1', 0, NULL, NULL, 1, '2024-03-05 10:00:00', NULL),
(3, 1, 1, 20.00, 20.00, '1', 0, NULL, NULL, 1, '2024-03-06 10:00:00', NULL),
(4, 2, 2, 30.00, 30.00, '1', 0, NULL, NULL, 1, '2024-03-06 10:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `Id` int(11) NOT NULL,
  `Name` varchar(120) NOT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Phone_Number` int(20) NOT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `CreateAt` datetime NOT NULL DEFAULT current_timestamp(),
  `CreateBy` int(11) DEFAULT NULL,
  `UpdateAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`Id`, `Name`, `Email`, `Phone_Number`, `Address`, `CreateAt`, `CreateBy`, `UpdateAt`) VALUES
(1, 'General Supplier', ' ', 987654321, 'Cambodia', '2024-06-08 12:08:44', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `table`
--

CREATE TABLE `table` (
  `Id` int(11) NOT NULL,
  `Name` varchar(20) NOT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `CreateAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdateAt` datetime DEFAULT NULL,
  `del` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `table`
--

INSERT INTO `table` (`Id`, `Name`, `Description`, `CreateAt`, `UpdateAt`, `del`) VALUES
(1, 'Table1', 'Table1', '2024-05-03 09:49:33', NULL, 1),
(2, 'Table2', 'Table2', '2024-05-03 09:49:33', NULL, 1),
(3, 'Table3', 'Table3', '2024-05-03 09:49:33', NULL, 1),
(4, 'Table4', 'Table4', '2024-05-03 09:49:33', NULL, 1),
(5, 'Table5', 'Table5', '2024-05-03 09:49:33', NULL, 1),
(6, 'Table6', 'Table6', '2024-05-03 09:49:33', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `uom`
--

CREATE TABLE `uom` (
  `Id` int(11) NOT NULL,
  `Code` varchar(120) NOT NULL,
  `Name` varchar(120) DEFAULT NULL,
  `Remark` varchar(255) DEFAULT NULL,
  `Status` tinyint(1) DEFAULT 1,
  `CreateAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdateAt` datetime DEFAULT NULL,
  `del` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `uom`
--

INSERT INTO `uom` (`Id`, `Code`, `Name`, `Remark`, `Status`, `CreateAt`, `UpdateAt`, `del`) VALUES
(1, 'Small', 'Small', 'Small', 1, '2024-05-24 02:31:09', NULL, 1),
(2, 'Midlle', 'Midlle', 'Midlle', 1, '2024-05-24 02:35:01', '2024-06-01 22:27:25', 1),
(3, 'Large', 'Large', 'Large', 1, '2024-05-24 02:35:40', NULL, 1),
(4, 'Couple', 'Couple', 'Couple', 1, '2024-05-24 08:14:03', '2024-06-01 22:27:22', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `Id` int(11) NOT NULL,
  `OutletId` int(11) DEFAULT NULL,
  `EmployeeId` int(11) DEFAULT NULL,
  `RoleId` int(11) DEFAULT NULL,
  `Username` varchar(120) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Remark` varchar(255) DEFAULT NULL,
  `Status` tinyint(1) DEFAULT 1,
  `CreateBy` int(11) DEFAULT NULL,
  `CreateAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdateAt` datetime DEFAULT NULL,
  `del` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`Id`, `OutletId`, `EmployeeId`, `RoleId`, `Username`, `Password`, `Remark`, `Status`, `CreateBy`, `CreateAt`, `UpdateAt`, `del`) VALUES
(1, 1, 1, 1, 'admin', '123', '2024-03-01 10:00:00', 1, 1, '2024-03-11 06:58:57', NULL, 1),
(2, 1, 3, 2, 'sale', '123', '2024-03-02 11:00:00', 1, 1, '2024-03-11 06:58:57', NULL, 1),
(3, 1, 7, 3, 'HR', '123', '2024-03-02 11:00:00', 1, 1, '2024-03-11 06:58:57', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `values`
--

CREATE TABLE `values` (
  `Id` int(11) NOT NULL,
  `Name` varchar(120) DEFAULT NULL,
  `Code` varchar(120) DEFAULT NULL,
  `GroupCode` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `values`
--

INSERT INTO `values` (`Id`, `Name`, `Code`, `GroupCode`) VALUES
(1, 'Small', 'sm', 'SizeName'),
(2, 'Middle', 'md', 'SizeName'),
(3, 'Large', 'lg', 'SizeName'),
(4, 'Pending', 'Pending', 'OrderStatus'),
(5, 'Paid', 'lg', 'OrderStatus'),
(6, 'Due', 'lg', 'OrderStatus');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `currency`
--
ALTER TABLE `currency`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `OutleteId` (`OutletId`),
  ADD KEY `Currency` (`Currency`);

--
-- Indexes for table `employeepayroll`
--
ALTER TABLE `employeepayroll`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Currency` (`Currency`);

--
-- Indexes for table `employeereviewsalary`
--
ALTER TABLE `employeereviewsalary`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `EmployeeId` (`EmployeeId`),
  ADD KEY `Currency` (`Currency`);

--
-- Indexes for table `employeetype`
--
ALTER TABLE `employeetype`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `OutletId` (`OutletId`),
  ADD KEY `CustomerId` (`CustomerId`),
  ADD KEY `ShiftDetailsId` (`ShiftDetailsId`),
  ADD KEY `PaymentMethodId` (`PaymentMethodId`),
  ADD KEY `TableId` (`TableId`);

--
-- Indexes for table `invoicedetails`
--
ALTER TABLE `invoicedetails`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `InvoiceId` (`InvoiceId`),
  ADD KEY `ProductSkuId` (`ProductSkuId`),
  ADD KEY `Currency` (`Currency`);

--
-- Indexes for table `nationality`
--
ALTER TABLE `nationality`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `outlet`
--
ALTER TABLE `outlet`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `paymentmethod`
--
ALTER TABLE `paymentmethod`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Name` (`Name`),
  ADD UNIQUE KEY `Code` (`Code`),
  ADD KEY `CreateBy` (`CreateBy`);

--
-- Indexes for table `payroll`
--
ALTER TABLE `payroll`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `CategoryId` (`CategoryId`);

--
-- Indexes for table `productsku`
--
ALTER TABLE `productsku`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `ProductId` (`ProductId`),
  ADD KEY `UomId` (`UomId`),
  ADD KEY `Currency` (`Currency`);

--
-- Indexes for table `pro_in`
--
ALTER TABLE `pro_in`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `ProId` (`ProId`),
  ADD KEY `Currency` (`Currency`);

--
-- Indexes for table `pro_moment`
--
ALTER TABLE `pro_moment`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `ProId` (`ProId`),
  ADD KEY `Pro_Out_Id` (`Pro_Out_Id`),
  ADD KEY `Pro_In_Id` (`Pro_In_Id`);

--
-- Indexes for table `pro_out`
--
ALTER TABLE `pro_out`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `ProId` (`ProId`),
  ADD KEY `TableId` (`TableId`),
  ADD KEY `Currency` (`Currency`),
  ADD KEY `SaleBy` (`SaleBy`),
  ADD KEY `Uom` (`Uom`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Name` (`Name`),
  ADD UNIQUE KEY `Code` (`Code`);

--
-- Indexes for table `shift`
--
ALTER TABLE `shift`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Name` (`Name`);

--
-- Indexes for table `shiftdetails`
--
ALTER TABLE `shiftdetails`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `UserId` (`UserId`),
  ADD KEY `ShiftId` (`ShiftId`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `CreateBy` (`CreateBy`);

--
-- Indexes for table `table`
--
ALTER TABLE `table`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `uom`
--
ALTER TABLE `uom`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `OutletId` (`OutletId`),
  ADD KEY `EmployeeId` (`EmployeeId`),
  ADD KEY `RoleId` (`RoleId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bank`
--
ALTER TABLE `bank`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `currency`
--
ALTER TABLE `currency`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `employeepayroll`
--
ALTER TABLE `employeepayroll`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `employeereviewsalary`
--
ALTER TABLE `employeereviewsalary`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employeetype`
--
ALTER TABLE `employeetype`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `invoicedetails`
--
ALTER TABLE `invoicedetails`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `nationality`
--
ALTER TABLE `nationality`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `outlet`
--
ALTER TABLE `outlet`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `paymentmethod`
--
ALTER TABLE `paymentmethod`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `payroll`
--
ALTER TABLE `payroll`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `productsku`
--
ALTER TABLE `productsku`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `pro_in`
--
ALTER TABLE `pro_in`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pro_moment`
--
ALTER TABLE `pro_moment`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pro_out`
--
ALTER TABLE `pro_out`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `shift`
--
ALTER TABLE `shift`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `shiftdetails`
--
ALTER TABLE `shiftdetails`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `table`
--
ALTER TABLE `table`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `uom`
--
ALTER TABLE `uom`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`OutletId`) REFERENCES `outlet` (`Id`);

--
-- Constraints for table `employeereviewsalary`
--
ALTER TABLE `employeereviewsalary`
  ADD CONSTRAINT `employeereviewsalary_ibfk_1` FOREIGN KEY (`EmployeeId`) REFERENCES `employee` (`Id`);

--
-- Constraints for table `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `invoice_ibfk_1` FOREIGN KEY (`OutletId`) REFERENCES `outlet` (`Id`),
  ADD CONSTRAINT `invoice_ibfk_2` FOREIGN KEY (`CustomerId`) REFERENCES `customer` (`Id`),
  ADD CONSTRAINT `invoice_ibfk_3` FOREIGN KEY (`ShiftDetailsId`) REFERENCES `shiftdetails` (`Id`),
  ADD CONSTRAINT `invoice_ibfk_4` FOREIGN KEY (`PaymentMethodId`) REFERENCES `paymentmethod` (`Id`),
  ADD CONSTRAINT `invoice_ibfk_5` FOREIGN KEY (`TableId`) REFERENCES `table` (`Id`);

--
-- Constraints for table `invoicedetails`
--
ALTER TABLE `invoicedetails`
  ADD CONSTRAINT `invoicedetails_ibfk_1` FOREIGN KEY (`InvoiceId`) REFERENCES `invoice` (`Id`),
  ADD CONSTRAINT `invoicedetails_ibfk_2` FOREIGN KEY (`ProductSkuId`) REFERENCES `productsku` (`Id`);

--
-- Constraints for table `paymentmethod`
--
ALTER TABLE `paymentmethod`
  ADD CONSTRAINT `paymentmethod_ibfk_1` FOREIGN KEY (`CreateBy`) REFERENCES `user` (`Id`),
  ADD CONSTRAINT `paymentmethod_ibfk_2` FOREIGN KEY (`CreateBy`) REFERENCES `user` (`Id`),
  ADD CONSTRAINT `paymentmethod_ibfk_3` FOREIGN KEY (`CreateBy`) REFERENCES `user` (`Id`),
  ADD CONSTRAINT `paymentmethod_ibfk_4` FOREIGN KEY (`CreateBy`) REFERENCES `user` (`Id`),
  ADD CONSTRAINT `paymentmethod_ibfk_5` FOREIGN KEY (`CreateBy`) REFERENCES `user` (`Id`),
  ADD CONSTRAINT `paymentmethod_ibfk_6` FOREIGN KEY (`CreateBy`) REFERENCES `user` (`Id`),
  ADD CONSTRAINT `paymentmethod_ibfk_7` FOREIGN KEY (`CreateBy`) REFERENCES `user` (`Id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`CategoryId`) REFERENCES `category` (`Id`);

--
-- Constraints for table `productsku`
--
ALTER TABLE `productsku`
  ADD CONSTRAINT `productsku_ibfk_1` FOREIGN KEY (`ProductId`) REFERENCES `product` (`Id`),
  ADD CONSTRAINT `productsku_ibfk_2` FOREIGN KEY (`UomId`) REFERENCES `uom` (`Id`);

--
-- Constraints for table `pro_in`
--
ALTER TABLE `pro_in`
  ADD CONSTRAINT `pro_in_ibfk_1` FOREIGN KEY (`ProId`) REFERENCES `product` (`Id`);

--
-- Constraints for table `pro_moment`
--
ALTER TABLE `pro_moment`
  ADD CONSTRAINT `pro_moment_ibfk_1` FOREIGN KEY (`ProId`) REFERENCES `product` (`Id`),
  ADD CONSTRAINT `pro_moment_ibfk_2` FOREIGN KEY (`Pro_Out_Id`) REFERENCES `pro_out` (`Id`),
  ADD CONSTRAINT `pro_moment_ibfk_3` FOREIGN KEY (`Pro_In_Id`) REFERENCES `pro_in` (`Id`);

--
-- Constraints for table `pro_out`
--
ALTER TABLE `pro_out`
  ADD CONSTRAINT `pro_out_ibfk_1` FOREIGN KEY (`ProId`) REFERENCES `product` (`Id`),
  ADD CONSTRAINT `pro_out_ibfk_2` FOREIGN KEY (`TableId`) REFERENCES `table` (`Id`),
  ADD CONSTRAINT `pro_out_ibfk_3` FOREIGN KEY (`SaleBy`) REFERENCES `employee` (`Id`),
  ADD CONSTRAINT `pro_out_ibfk_4` FOREIGN KEY (`Uom`) REFERENCES `uom` (`Id`);

--
-- Constraints for table `shiftdetails`
--
ALTER TABLE `shiftdetails`
  ADD CONSTRAINT `shiftdetails_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `user` (`Id`),
  ADD CONSTRAINT `shiftdetails_ibfk_2` FOREIGN KEY (`ShiftId`) REFERENCES `shift` (`Id`);

--
-- Constraints for table `supplier`
--
ALTER TABLE `supplier`
  ADD CONSTRAINT `supplier_ibfk_1` FOREIGN KEY (`CreateBy`) REFERENCES `user` (`Id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`OutletId`) REFERENCES `outlet` (`Id`),
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`EmployeeId`) REFERENCES `employee` (`Id`),
  ADD CONSTRAINT `user_ibfk_3` FOREIGN KEY (`RoleId`) REFERENCES `role` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
