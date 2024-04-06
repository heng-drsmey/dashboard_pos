-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 06, 2024 at 05:18 PM
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
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `Id` int(11) NOT NULL,
  `Name` varchar(120) NOT NULL,
  `Description` text DEFAULT NULL,
  `Image` varchar(255) DEFAULT NULL,
  `ParentId` int(11) DEFAULT NULL,
  `Status` tinyint(1) DEFAULT 1,
  `CreateBy` int(11) DEFAULT NULL,
  `CreateAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`Id`, `Name`, `Description`, `Image`, `ParentId`, `Status`, `CreateBy`, `CreateAt`) VALUES
(1, 'Ice', 'iced coffee is a cold version of your favourite coffee', 'ice_image1.jpg', NULL, 1, 1, '2024-03-11 07:03:27'),
(2, 'Hot', 'hot coffee is a cold version of your favourite coffee', 'hot_image.jpg', NULL, 1, 1, '2024-03-11 07:03:27'),
(3, 'Soda', 'soda coffee is a cold version of your favourite coffee', 'soda_image.jpg', NULL, 1, 1, '2024-03-11 07:03:27'),
(4, 'Juice', 'juice coffee is a cold version of your favourite coffee', 'juice_image.jpg', NULL, 1, 1, '2024-03-11 07:03:27'),
(5, 'Frappe', 'frappe coffee is a cold version of your favourite coffee', 'frappe_image.jpg', NULL, 1, 1, '2024-03-11 07:03:27'),
(6, 'Cream', 'cream coffee is a cold version of your favourite coffee', 'cream_image.jpg', NULL, 1, 1, '2024-03-11 07:03:27');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `Id` int(11) NOT NULL,
  `Firstname` varchar(120) NOT NULL,
  `Lastname` varchar(120) NOT NULL,
  `Gender` tinyint(1) NOT NULL,
  `Dob` datetime DEFAULT NULL,
  `Email` varchar(120) DEFAULT NULL,
  `Tel` varchar(18) NOT NULL,
  `Image` varchar(255) DEFAULT NULL,
  `Status` tinyint(1) DEFAULT 1,
  `Address` text DEFAULT NULL,
  `CreateBy` int(11) DEFAULT NULL,
  `CreateAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`Id`, `Firstname`, `Lastname`, `Gender`, `Dob`, `Email`, `Tel`, `Image`, `Status`, `Address`, `CreateBy`, `CreateAt`) VALUES
(1, 'Mouk', 'Makara', 1, '2004-01-15 00:00:00', 'moukmakara@gmail.com', '013456789', NULL, 1, 'phnom penh', NULL, '2024-03-11 07:27:29'),
(2, 'Dara', 'Makara', 0, '2004-01-20 00:00:00', 'daramakara@gmail.com', '013456789', NULL, 1, 'takeo', NULL, '2024-03-11 07:27:29'),
(3, 'Sopheak', 'Bopha', 0, '2004-01-23 00:00:00', 'sopheakbopha@gmail.com', '013456789', NULL, 1, 'kamport', NULL, '2024-03-11 07:27:29');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `Id` int(11) NOT NULL,
  `OutletId` int(11) DEFAULT NULL,
  `Firstname` varchar(120) NOT NULL,
  `Lastname` varchar(120) NOT NULL,
  `Gender` tinyint(1) NOT NULL,
  `Dob` datetime DEFAULT NULL,
  `Email` varchar(120) DEFAULT NULL,
  `Tel` varchar(18) NOT NULL,
  `Salary` decimal(6,2) DEFAULT 0.00,
  `Position` varchar(120) NOT NULL,
  `Image` varchar(255) DEFAULT NULL,
  `Status` tinyint(1) DEFAULT 1,
  `JoinAT` datetime DEFAULT NULL,
  `ResignAt` datetime DEFAULT NULL,
  `ReasonResign` text DEFAULT NULL,
  `CreateBy` int(11) DEFAULT NULL,
  `CreateAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`Id`, `OutletId`, `Firstname`, `Lastname`, `Gender`, `Dob`, `Email`, `Tel`, `Salary`, `Position`, `Image`, `Status`, `JoinAT`, `ResignAt`, `ReasonResign`, `CreateBy`, `CreateAt`) VALUES
(1, 1, 'Mouk', 'Makara', 1, '2004-01-15 00:00:00', 'moukmakara@gmail.com', '013456789', 0.00, 'Web Developer', 'mouk.jpg', 1, NULL, NULL, NULL, 1, '2024-03-06 22:00:00'),
(2, 1, 'Rorn', 'Mony', 1, '2002-05-20 00:00:00', 'rornmony@gmail.com', '098764321', 0.00, 'IT Support', 'rorn.jpg', 1, NULL, NULL, NULL, 1, '2024-03-06 22:10:00'),
(3, 2, 'Souy', 'Sovichea', 1, '2003-08-10 00:00:00', 'souysovichea@gmail.com', '05556777', 0.00, 'Customer Service', 'souy.jpg', 1, NULL, NULL, NULL, 1, '2024-03-06 22:20:00'),
(4, 2, 'Muth', 'Sinthean', 1, '2001-03-25 00:00:00', 'muthsinthean@gmail.com', '01112333', 0.00, 'Accountant', 'muth.jpg', 1, NULL, NULL, NULL, 1, '2024-03-06 22:30:00'),
(5, 3, 'Sok', 'Sreyphea', 0, '2004-12-05 00:00:00', 'soksreyphea@gmail.com', '04447888', 0.00, 'App Developer', 'sok.jpg', 1, NULL, NULL, NULL, 1, '2024-03-06 22:40:00'),
(6, 3, 'So', 'Dara', 0, '2004-12-05 00:00:00', 'sodara@gmail.com', '04447886', 0.00, 'App Developer', 'sok.jpg', 1, NULL, NULL, NULL, 1, '2024-03-06 22:40:00');

-- --------------------------------------------------------

--
-- Table structure for table `employeepayroll`
--

CREATE TABLE `employeepayroll` (
  `Id` int(11) NOT NULL,
  `EmployeeId` int(11) DEFAULT NULL,
  `PayrollId` int(11) DEFAULT NULL,
  `BaseSalary` decimal(6,2) DEFAULT NULL,
  `Bunus` decimal(6,2) DEFAULT NULL,
  `Food` decimal(6,2) DEFAULT NULL,
  `OT` decimal(6,2) DEFAULT NULL,
  `Total` decimal(6,2) DEFAULT NULL,
  `CreateBy` int(11) DEFAULT NULL,
  `CreateAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `employeepayroll`
--

INSERT INTO `employeepayroll` (`Id`, `EmployeeId`, `PayrollId`, `BaseSalary`, `Bunus`, `Food`, `OT`, `Total`, `CreateBy`, `CreateAt`) VALUES
(1, 1, 1, 500.00, 1300.00, 50.00, 50.00, 1900.00, 1, '2024-03-11 07:07:48'),
(2, 2, 1, 500.00, 1200.00, 50.00, 50.00, 1800.00, 1, '2024-03-11 07:07:48'),
(3, 3, 1, 600.00, 1200.00, 50.00, 50.00, 1900.00, 1, '2024-03-11 07:07:48'),
(4, 4, 1, 600.00, 1200.00, 50.00, 50.00, 1900.00, 1, '2024-03-11 07:07:48'),
(5, 5, 1, 600.00, 1200.00, 50.00, 50.00, 1900.00, 1, '2024-03-11 07:07:48'),
(6, 6, 1, 600.00, 1200.00, 50.00, 50.00, 1900.00, 1, '2024-03-11 07:07:48'),
(7, 1, 2, 500.00, 1300.00, 50.00, 50.00, 1900.00, 1, '2024-03-11 07:07:48'),
(8, 2, 2, 500.00, 1200.00, 50.00, 50.00, 1800.00, 1, '2024-03-11 07:07:48'),
(9, 3, 2, 600.00, 1200.00, 50.00, 50.00, 1900.00, 1, '2024-03-11 07:07:48'),
(10, 4, 2, 600.00, 1200.00, 50.00, 50.00, 1900.00, 1, '2024-03-11 07:07:48'),
(11, 5, 2, 600.00, 1200.00, 50.00, 50.00, 1900.00, 1, '2024-03-11 07:07:48'),
(12, 6, 2, 600.00, 1200.00, 50.00, 50.00, 1900.00, 1, '2024-03-11 07:07:48'),
(13, 1, 3, 500.00, 1300.00, 50.00, 50.00, 1900.00, 1, '2024-03-11 07:07:48'),
(14, 2, 3, 500.00, 1200.00, 50.00, 50.00, 1800.00, 1, '2024-03-11 07:07:48'),
(15, 3, 3, 600.00, 1200.00, 50.00, 50.00, 1900.00, 1, '2024-03-11 07:07:48'),
(16, 4, 3, 600.00, 1200.00, 50.00, 50.00, 1900.00, 1, '2024-03-11 07:07:48'),
(17, 5, 3, 600.00, 1200.00, 50.00, 50.00, 1900.00, 1, '2024-03-11 07:07:48'),
(18, 6, 3, 600.00, 1200.00, 50.00, 50.00, 1900.00, 1, '2024-03-11 07:07:48');

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
  `ReviewAt` decimal(6,2) DEFAULT NULL,
  `ReviewBy` int(11) DEFAULT NULL,
  `ApproveAt` datetime DEFAULT NULL,
  `ApproveBy` int(11) DEFAULT NULL,
  `Status` tinyint(1) DEFAULT 1,
  `CreateBy` int(11) DEFAULT NULL,
  `CreateAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `Id` int(11) NOT NULL,
  `OutletId` int(11) DEFAULT NULL,
  `CustomerId` int(11) DEFAULT NULL,
  `ShiftDetailsId` int(11) DEFAULT NULL,
  `PaymentMethodId` int(11) DEFAULT NULL,
  `TableId` int(11) NOT NULL,
  `InvoiceStatus` varchar(120) DEFAULT NULL,
  `AmountInUSD` decimal(6,2) DEFAULT NULL,
  `AmountInKHR` decimal(6,2) DEFAULT NULL,
  `PaidInUSD` decimal(6,2) DEFAULT NULL,
  `PaidInKHR` decimal(6,2) DEFAULT NULL,
  `Status` tinyint(1) DEFAULT 1,
  `CreateBy` int(11) DEFAULT NULL,
  `CreateAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`Id`, `OutletId`, `CustomerId`, `ShiftDetailsId`, `PaymentMethodId`, `TableId`, `InvoiceStatus`, `AmountInUSD`, `AmountInKHR`, `PaidInUSD`, `PaidInKHR`, `Status`, `CreateBy`, `CreateAt`) VALUES
(1, 1, 1, 1, 1, 0, NULL, 10.00, 0.00, 10.00, 0.00, 1, 1, '2024-03-15 04:40:04'),
(2, 1, 1, 1, 1, 0, NULL, 5.00, 0.00, 5.00, 0.00, 1, 1, '2024-03-15 04:40:04'),
(3, 1, 1, 1, 1, 0, NULL, 6.00, 0.00, 6.00, 0.00, 1, 1, '2024-03-15 04:40:04'),
(4, 1, 1, 1, 1, 0, NULL, 6.00, 0.00, 6.00, 0.00, 1, 1, '2024-03-15 04:40:04'),
(5, 1, 1, 2, 1, 0, NULL, 10.00, 0.00, 10.00, 0.00, 1, 1, '2024-03-15 04:40:04'),
(6, 1, 1, 2, 1, 0, NULL, 5.00, 0.00, 5.00, 0.00, 1, 1, '2024-03-15 04:40:04'),
(7, 1, 1, 2, 1, 0, NULL, 6.00, 0.00, 6.00, 0.00, 1, 1, '2024-03-15 04:40:04'),
(8, 1, 1, 2, 1, 0, NULL, 6.00, 0.00, 6.00, 0.00, 1, 1, '2024-03-15 04:40:04');

-- --------------------------------------------------------

--
-- Table structure for table `invoicedetails`
--

CREATE TABLE `invoicedetails` (
  `Id` int(11) NOT NULL,
  `InvoiceId` int(11) DEFAULT NULL,
  `UomId` int(11) DEFAULT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `Price` decimal(6,2) DEFAULT NULL,
  `Discount` decimal(6,2) DEFAULT NULL,
  `Total` decimal(6,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `invoicedetails`
--

INSERT INTO `invoicedetails` (`Id`, `InvoiceId`, `UomId`, `Quantity`, `Price`, `Discount`, `Total`) VALUES
(1, 1, 1, 2, 2.00, 0.00, 2.00),
(2, 1, 1, 3, 3.00, 0.00, 3.00),
(3, 1, 1, 3, 3.00, 0.00, 3.00),
(4, 1, 1, 4, 4.00, 0.00, 4.00),
(5, 2, 1, 2, 2.00, 0.00, 2.00),
(6, 2, 1, 3, 3.00, 0.00, 3.00),
(7, 3, 1, 2, 2.00, 0.00, 2.00),
(8, 3, 2, 3, 2.00, 0.00, 6.00),
(9, 4, 1, 2, 2.00, 0.00, 2.00),
(10, 4, 2, 3, 2.00, 0.00, 6.00),
(11, 5, 1, 2, 2.00, 0.00, 2.00),
(12, 5, 1, 3, 2.00, 0.00, 3.00),
(13, 5, 1, 3, 1.00, 0.00, 3.00),
(14, 5, 1, 4, 1.00, 0.00, 4.00),
(15, 6, 1, 1, 2.00, 0.00, 2.00),
(16, 6, 1, 1, 3.00, 0.00, 3.00),
(17, 7, 1, 2, 2.00, 0.00, 4.00),
(18, 7, 2, 3, 2.00, 0.00, 6.00),
(19, 8, 1, 2, 2.00, 0.00, 4.00),
(20, 8, 2, 3, 2.00, 0.00, 6.00);

-- --------------------------------------------------------

--
-- Table structure for table `logo`
--

CREATE TABLE `logo` (
  `Id` int(11) NOT NULL,
  `Code` varchar(120) NOT NULL,
  `OutletId` tinyint(4) NOT NULL DEFAULT 1,
  `Logo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

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
  `CreateBy` int(11) DEFAULT NULL,
  `CreateAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `ApproveBy` int(11) DEFAULT NULL,
  `ApproveAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `outlet`
--

INSERT INTO `outlet` (`Id`, `Name`, `Code`, `Status`, `Address`, `CreateBy`, `CreateAt`, `ApproveBy`, `ApproveAt`) VALUES
(1, 'Beong Kok-I', 'BK-I', 1, '#123, st345, Beong kok, Phnom Penh', 1, '2024-03-12 08:36:53', NULL, NULL),
(2, 'Beong Kok-II', 'BK-II', 1, '#143, st3475, Beong kokII, Phnom Penh', 1, '2024-03-12 08:36:53', NULL, NULL),
(3, 'Beong Kok-III', 'BK-III', 1, '#1243, st3545, Beong kokIII, Phnom Penh', 2, '2024-03-12 08:36:53', NULL, NULL),
(5, 'Test101', 'Test101', 1, '#143, st3475, Beong kokII, Phnom Penh', 2, '2024-03-12 09:02:27', NULL, NULL),
(6, 'Beong Kok-103', 'BK-103', 1, '#1243, st3545, Beong kokIII, Phnom Penh', 3, '2024-03-12 09:02:27', NULL, NULL),
(7, 'SKI-TK', 'SKI-TK', 1, '#123, st45, Toul Kok, Phnom Phenh', 3, '2024-03-06 07:03:18', NULL, NULL),
(8, 'SKI-TTP', 'SKI-TTP', 1, '#125, st48, Toul Tom Pong, Phnom Phenh', 1, '2024-03-06 07:03:18', NULL, NULL),
(9, 'SKI-BKK', 'SKI-BKK', 1, '#13, st47, Beong Keng Kong, Phnom Phenh', 1, '2024-03-06 07:03:18', NULL, NULL),
(10, 'SKI-TK11', 'SKI-TK', 1, '#123, st45, Toul Kok, Phnom Phenh', 4, '2024-03-06 07:24:43', NULL, NULL),
(11, 'Test101', 'Test101', 1, '#125, st48, Toul Tom Pong, Phnom Phenh', 4, '2024-03-06 07:24:43', NULL, NULL);

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
  `CreateAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `paymentmethod`
--

INSERT INTO `paymentmethod` (`Id`, `Name`, `Code`, `Status`, `CreateBy`, `CreateAt`) VALUES
(1, 'cash', 'cash', 1, 1, '2024-03-07 01:30:00'),
(2, 'aba', 'aba', 1, 1, '2024-03-07 01:30:00'),
(3, 'aceleda', 'aceleda', 1, 1, '2024-03-07 02:30:00'),
(4, 'wing', 'wing', 1, 1, '2024-03-07 03:30:00');

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
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `Id` int(11) NOT NULL,
  `CategoryId` int(11) DEFAULT NULL,
  `Name` varchar(120) NOT NULL,
  `Description` text DEFAULT NULL,
  `Image` varchar(255) DEFAULT NULL,
  `Status` tinyint(1) DEFAULT 1,
  `CreateBy` int(11) DEFAULT NULL,
  `CreateAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`Id`, `CategoryId`, `Name`, `Description`, `Image`, `Status`, `CreateBy`, `CreateAt`) VALUES
(1, 1, 'Iced-latte', 'Iced-latte my favourite coffee', 'Iced-latte_image.jpg', 1, 1, '2024-03-11 07:10:06'),
(2, 2, 'Hot-latte', 'Hot-latte my favourite coffee', 'Hot-latte_image.jpg', 1, 1, '2024-03-11 07:10:06'),
(3, 3, 'Passion-soda', 'Passion-soda my favourite coffee', 'Passion-soda_image.jpg', 1, 1, '2024-03-11 07:10:06'),
(4, 4, 'Iced-lemon-tea', 'Iced-lemon-tea my favourite coffee', 'Iced-lemon-tea_image.jpg', 1, 1, '2024-03-11 07:10:06'),
(5, 5, 'Chocolate-frappe', 'Chocolate-frappe my favourite coffee', 'Chocolate-frappe_image.jpg', 1, 1, '2024-03-11 07:10:06'),
(6, 6, 'Passion-cream', 'Passion-cream my favourite coffee', 'Passion-cream_image.jpg', 1, 1, '2024-03-11 07:10:06'),
(7, 1, 'Iced-americano', 'Iced-americano my favourite coffee', 'Iced-americano_image.jpg', 1, 1, '2024-03-11 07:10:06'),
(8, 2, 'Hot-cappucino', 'Hot-cappucino my favourite coffee', 'Hot-cappucino_image.jpg', 1, 1, '2024-03-11 07:10:06'),
(9, 3, 'Blue-soda', 'Blue-soda my favourite coffee', 'Blue-soda_image.jpg', 1, 1, '2024-03-11 07:10:06'),
(10, 4, 'Mint-ice-greentea', 'Mint-ice-greentea my favourite coffee', 'Mint-ice-greentea_image.jpg', 1, 1, '2024-03-11 07:10:06'),
(11, 5, 'Cookie-frappe', 'Cookie-frappe my favourite coffee', 'Cookie-frappe_image.jpg', 1, 1, '2024-03-11 07:10:06'),
(12, 6, 'Mango-cream', 'Mango-cream my favourite coffee', 'Mango_image.jpg', 1, 1, '2024-03-11 07:10:06');

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
  `CreateAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`Id`, `Name`, `Code`, `Status`, `CreateBy`, `CreateAt`) VALUES
(1, 'Admin', 'ADM', 1, 1, '2024-03-06 22:00:00'),
(2, 'Manager', 'MGR', 1, 1, '2024-03-05 20:30:00'),
(3, 'Cashair', 'Cashair', 1, 1, '2024-03-05 20:30:00'),
(4, 'Service', 'Service', 1, 103, '2024-03-05 01:45:00'),
(5, 'Accountant', 'ACC', 1, 1, '2024-03-03 18:20:00'),
(6, 'IT', 'IT', 1, 1, '2024-03-03 00:10:00');

-- --------------------------------------------------------

--
-- Table structure for table `shift`
--

CREATE TABLE `shift` (
  `Id` int(11) NOT NULL,
  `Name` varchar(120) NOT NULL,
  `Status` tinyint(1) DEFAULT 1,
  `CreateBy` int(11) DEFAULT NULL,
  `CreateAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `shift`
--

INSERT INTO `shift` (`Id`, `Name`, `Status`, `CreateBy`, `CreateAt`) VALUES
(1, 'Morning Shift', 1, 1, '2024-03-11 06:48:57'),
(2, 'Evening Shift', 1, 1, '2024-03-11 06:48:57');

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
  `Isclosed` tinyint(1) DEFAULT 0,
  `CloseBy` int(11) DEFAULT NULL,
  `CloseAt` datetime DEFAULT NULL,
  `Status` tinyint(1) DEFAULT 1,
  `CreateAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `shiftdetails`
--

INSERT INTO `shiftdetails` (`Id`, `ShiftId`, `UserId`, `OpenningBalance`, `ClosingBalance`, `Isclosed`, `CloseBy`, `CloseAt`, `Status`, `CreateAt`) VALUES
(1, 1, 1, 80.00, 80.00, 0, NULL, NULL, 1, '2024-03-05 10:00:00'),
(2, 2, 2, 90.00, 90.00, 0, NULL, NULL, 1, '2024-03-05 10:00:00'),
(3, 1, 1, 20.00, 20.00, 0, NULL, NULL, 1, '2024-03-06 10:00:00'),
(4, 2, 2, 30.00, 30.00, 0, NULL, NULL, 1, '2024-03-06 10:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `table`
--

CREATE TABLE `table` (
  `Id` int(11) UNSIGNED NOT NULL,
  `Name` varchar(120) NOT NULL,
  `Code` varchar(120) NOT NULL,
  `NumberOfCustomers` int(11) UNSIGNED DEFAULT 0,
  `Status` tinyint(1) DEFAULT 1,
  `CreatedBy` int(11) DEFAULT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `table`
--

INSERT INTO `table` (`Id`, `Name`, `Code`, `NumberOfCustomers`, `Status`, `CreatedBy`, `CreatedAt`) VALUES
(1, 'Table 1', 'Table 1', 4, 1, 1, '2024-04-05 13:45:10'),
(2, 'Table 2', 'Table 2', 4, 1, 1, '2024-04-05 13:45:10'),
(3, 'Table 3', 'Table 3', 4, 1, 1, '2024-04-05 13:45:10'),
(4, 'Table 4', 'Table 4', 4, 1, 1, '2024-04-05 13:45:10'),
(5, 'Table 5', 'Table 5', 4, 1, 1, '2024-04-05 13:45:10'),
(6, 'Table 6', 'Table 6', 4, 1, 1, '2024-04-05 13:45:10'),
(7, 'Table 7', 'Table 7', 4, 1, 1, '2024-04-05 13:45:10'),
(8, 'Table 8', 'Table 8', 4, 1, 1, '2024-04-05 13:45:10'),
(9, 'Table 9', 'Table 9', 4, 1, 1, '2024-04-05 13:45:10');

-- --------------------------------------------------------

--
-- Table structure for table `uom`
--

CREATE TABLE `uom` (
  `Id` int(11) NOT NULL,
  `ProductId` int(11) DEFAULT NULL,
  `SizeName` varchar(120) NOT NULL,
  `Price` decimal(6,2) NOT NULL,
  `Unit` varchar(120) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `uom`
--

INSERT INTO `uom` (`Id`, `ProductId`, `SizeName`, `Price`, `Unit`) VALUES
(1, 1, 'Small', 2.00, 'PCS'),
(2, 1, 'Middle', 2.30, 'PCS'),
(3, 1, 'Large', 3.00, 'PCS'),
(4, 2, 'Small', 2.00, 'PCS'),
(5, 2, 'Middle', 2.30, 'PCS'),
(6, 2, 'Large', 2.30, 'PCS'),
(7, 3, 'Small', 2.00, 'PCS'),
(8, 3, 'Middle', 2.30, 'PCS'),
(9, 3, 'Large', 2.30, 'PCS'),
(10, 4, 'Small', 2.00, 'PCS'),
(11, 4, 'Middle', 2.30, 'PCS'),
(12, 4, 'Large', 2.30, 'PCS'),
(13, 5, 'Small', 2.00, 'PCS'),
(14, 5, 'Middle', 2.30, 'PCS'),
(15, 5, 'Large', 2.30, 'PCS'),
(16, 6, 'Small', 2.00, 'PCS'),
(17, 6, 'Middle', 2.30, 'PCS'),
(18, 6, 'Large', 2.30, 'PCS'),
(19, 7, 'Small', 2.00, 'PCS'),
(20, 7, 'Middle', 2.30, 'PCS'),
(21, 7, 'Large', 2.30, 'PCS'),
(22, 8, 'Small', 2.00, 'PCS'),
(23, 8, 'Middle', 2.30, 'PCS'),
(24, 8, 'Large', 2.30, 'PCS'),
(25, 9, 'Small', 2.00, 'PCS'),
(26, 9, 'Middle', 2.30, 'PCS'),
(27, 9, 'Large', 2.30, 'PCS'),
(28, 10, 'Small', 2.00, 'PCS'),
(29, 10, 'Middle', 2.30, 'PCS'),
(30, 10, 'Large', 2.30, 'PCS'),
(31, 11, 'Small', 2.00, 'PCS'),
(32, 11, 'Middle', 2.30, 'PCS'),
(33, 11, 'Large', 2.30, 'PCS'),
(34, 12, 'Small', 2.00, 'PCS'),
(35, 12, 'Middle', 2.30, 'PCS'),
(36, 12, 'Large', 2.30, 'PCS');

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
  `ActivedAt` datetime DEFAULT NULL,
  `Status` tinyint(1) DEFAULT 1,
  `CreateBy` int(11) DEFAULT NULL,
  `CreateAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`Id`, `OutletId`, `EmployeeId`, `RoleId`, `Username`, `Password`, `ActivedAt`, `Status`, `CreateBy`, `CreateAt`) VALUES
(1, 1, 1, 1, 'admin', '123', '2024-03-01 10:00:00', 1, 1, '2024-03-11 06:58:57'),
(2, 1, 3, 2, '098764321', '123456', '2024-03-02 11:00:00', 1, 1, '2024-03-11 06:58:57'),
(3, 1, 3, 3, '098764321', '123456', '2024-03-02 11:00:00', 1, 1, '2024-03-11 06:58:57'),
(4, 2, 4, 1, '05556777', '123456', '2024-03-03 12:00:00', 1, 1, '2024-03-11 06:58:57'),
(5, 2, 5, 2, '01112333', '123456', '2024-03-04 13:00:00', 1, 1, '2024-03-11 06:58:57'),
(6, 2, 6, 3, '04447888', '123456', '2024-03-05 14:00:00', 1, 1, '2024-03-11 06:58:57');

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
-- Indexes for table `category`
--
ALTER TABLE `category`
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
  ADD KEY `OutleteId` (`OutletId`);

--
-- Indexes for table `employeereviewsalary`
--
ALTER TABLE `employeereviewsalary`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `EmployeeId` (`EmployeeId`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `OutletId` (`OutletId`),
  ADD KEY `CustomerId` (`CustomerId`),
  ADD KEY `ShiftDetailsId` (`ShiftDetailsId`),
  ADD KEY `PaymentMethodId` (`PaymentMethodId`);

--
-- Indexes for table `invoicedetails`
--
ALTER TABLE `invoicedetails`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `InvoiceId` (`InvoiceId`),
  ADD KEY `UomId` (`UomId`) USING BTREE;

--
-- Indexes for table `logo`
--
ALTER TABLE `logo`
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
  ADD UNIQUE KEY `Code` (`Code`);

--
-- Indexes for table `payroll`
--
ALTER TABLE `payroll`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `CategoryId` (`CategoryId`);

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
-- Indexes for table `table`
--
ALTER TABLE `table`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `uom`
--
ALTER TABLE `uom`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `ProductId` (`ProductId`);

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
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `employeereviewsalary`
--
ALTER TABLE `employeereviewsalary`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT for table `logo`
--
ALTER TABLE `logo`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `outlet`
--
ALTER TABLE `outlet`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
-- AUTO_INCREMENT for table `table`
--
ALTER TABLE `table`
  MODIFY `Id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `uom`
--
ALTER TABLE `uom`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
  ADD CONSTRAINT `invoice_ibfk_4` FOREIGN KEY (`PaymentMethodId`) REFERENCES `paymentmethod` (`Id`);

--
-- Constraints for table `invoicedetails`
--
ALTER TABLE `invoicedetails`
  ADD CONSTRAINT `invoicedetails_ibfk_1` FOREIGN KEY (`InvoiceId`) REFERENCES `invoice` (`Id`),
  ADD CONSTRAINT `invoicedetails_ibfk_2` FOREIGN KEY (`UomId`) REFERENCES `uom` (`Id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`CategoryId`) REFERENCES `category` (`Id`);

--
-- Constraints for table `shiftdetails`
--
ALTER TABLE `shiftdetails`
  ADD CONSTRAINT `shiftdetails_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `user` (`Id`),
  ADD CONSTRAINT `shiftdetails_ibfk_2` FOREIGN KEY (`ShiftId`) REFERENCES `shift` (`Id`);

--
-- Constraints for table `uom`
--
ALTER TABLE `uom`
  ADD CONSTRAINT `uom_ibfk_1` FOREIGN KEY (`ProductId`) REFERENCES `product` (`Id`);

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
