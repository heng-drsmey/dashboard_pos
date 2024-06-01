-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2024 at 08:37 AM
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
  `Status` tinyint(1) DEFAULT 1,
  `CreateBy` int(11) DEFAULT NULL,
  `CreateAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`Id`, `Name`, `Description`, `Image`, `Status`, `CreateBy`, `CreateAt`) VALUES
(1, 'Ice', 'iced coffee is a cold version of your favourite coffee', 'ice_image1.jpg', 1, 1, '2024-03-11 07:03:27'),
(2, 'Hot', 'hot coffee is a cold version of your favourite coffee', 'hot_image.jpg', 1, 1, '2024-03-11 07:03:27'),
(3, 'Soda', 'soda coffee is a cold version of your favourite coffee', 'soda_image.jpg', 1, 1, '2024-03-11 07:03:27'),
(4, 'Juice', 'juice coffee is a cold version of your favourite coffee', 'juice_image.jpg', 1, 1, '2024-03-11 07:03:27'),
(5, 'Frappe', 'frappe coffee is a cold version of your favourite coffee', 'frappe_image.jpg', 1, 1, '2024-03-11 07:03:27'),
(6, 'Cream', 'cream coffee is a cold version of your favourite coffee', 'cream_image.jpg', 1, 1, '2024-03-11 07:03:27');

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
  `CreateAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `currency`
--

INSERT INTO `currency` (`Id`, `Code`, `Name`, `Symbol`, `Remark`, `CreateBy`, `CreateAt`) VALUES
(1, 'USD', 'USD', '$', 'USD', '1', '2024-06-01 03:59:02'),
(2, 'KHR', 'KHR', '៛', 'Khmer riel', '2', '2024-06-01 03:59:02');

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
  `Currency` int(11) DEFAULT 1,
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

INSERT INTO `employee` (`Id`, `OutletId`, `Firstname`, `Lastname`, `Gender`, `Dob`, `Email`, `Tel`, `Salary`, `Currency`, `Position`, `Image`, `Status`, `JoinAT`, `ResignAt`, `ReasonResign`, `CreateBy`, `CreateAt`) VALUES
(1, 1, 'Mouk', 'Makara', 1, '2004-01-15 00:00:00', 'moukmakara@gmail.com', '013456789', 0.00, 1, 'Web Developer', 'mouk.jpg', 1, NULL, NULL, NULL, 1, '2024-03-06 22:00:00'),
(2, 1, 'Rorn', 'Mony', 1, '2002-05-20 00:00:00', 'rornmony@gmail.com', '098764321', 0.00, 1, 'IT Support', 'rorn.jpg', 1, NULL, NULL, NULL, 1, '2024-03-06 22:10:00'),
(3, 2, 'Souy', 'Sovichea', 1, '2003-08-10 00:00:00', 'souysovichea@gmail.com', '05556777', 0.00, 1, 'Customer Service', 'souy.jpg', 1, NULL, NULL, NULL, 1, '2024-03-06 22:20:00'),
(4, 2, 'Muth', 'Sinthean', 1, '2001-03-25 00:00:00', 'muthsinthean@gmail.com', '01112333', 0.00, 1, 'Accountant', 'muth.jpg', 1, NULL, NULL, NULL, 1, '2024-03-06 22:30:00'),
(5, 3, 'Sok', 'Sreyphea', 0, '2004-12-05 00:00:00', 'soksreyphea@gmail.com', '04447888', 0.00, 1, 'App Developer', 'sok.jpg', 1, NULL, NULL, NULL, 1, '2024-03-06 22:40:00'),
(6, 3, 'So', 'Dara', 0, '2004-12-05 00:00:00', 'sodara@gmail.com', '04447886', 0.00, 1, 'App Developer', 'sok.jpg', 1, NULL, NULL, NULL, 1, '2024-03-06 22:40:00');

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
  `CreateAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `employeepayroll`
--

INSERT INTO `employeepayroll` (`Id`, `EmployeeId`, `PayrollId`, `BaseSalary`, `Bunus`, `Food`, `OT`, `Total`, `Currency`, `CreateBy`, `CreateAt`) VALUES
(1, 1, 1, 500.00, 1300.00, 50.00, 50.00, 1900.00, NULL, 1, '2024-03-11 07:07:48'),
(2, 2, 1, 500.00, 1200.00, 50.00, 50.00, 1800.00, NULL, 1, '2024-03-11 07:07:48'),
(3, 3, 1, 600.00, 1200.00, 50.00, 50.00, 1900.00, NULL, 1, '2024-03-11 07:07:48'),
(4, 4, 1, 600.00, 1200.00, 50.00, 50.00, 1900.00, NULL, 1, '2024-03-11 07:07:48'),
(5, 5, 1, 600.00, 1200.00, 50.00, 50.00, 1900.00, NULL, 1, '2024-03-11 07:07:48'),
(6, 6, 1, 600.00, 1200.00, 50.00, 50.00, 1900.00, NULL, 1, '2024-03-11 07:07:48'),
(7, 1, 2, 500.00, 1300.00, 50.00, 50.00, 1900.00, NULL, 1, '2024-03-11 07:07:48'),
(8, 2, 2, 500.00, 1200.00, 50.00, 50.00, 1800.00, NULL, 1, '2024-03-11 07:07:48'),
(9, 3, 2, 600.00, 1200.00, 50.00, 50.00, 1900.00, NULL, 1, '2024-03-11 07:07:48'),
(10, 4, 2, 600.00, 1200.00, 50.00, 50.00, 1900.00, NULL, 1, '2024-03-11 07:07:48'),
(11, 5, 2, 600.00, 1200.00, 50.00, 50.00, 1900.00, NULL, 1, '2024-03-11 07:07:48'),
(12, 6, 2, 600.00, 1200.00, 50.00, 50.00, 1900.00, NULL, 1, '2024-03-11 07:07:48'),
(13, 1, 3, 500.00, 1300.00, 50.00, 50.00, 1900.00, NULL, 1, '2024-03-11 07:07:48'),
(14, 2, 3, 500.00, 1200.00, 50.00, 50.00, 1800.00, NULL, 1, '2024-03-11 07:07:48'),
(15, 3, 3, 600.00, 1200.00, 50.00, 50.00, 1900.00, NULL, 1, '2024-03-11 07:07:48'),
(16, 4, 3, 600.00, 1200.00, 50.00, 50.00, 1900.00, NULL, 1, '2024-03-11 07:07:48'),
(17, 5, 3, 600.00, 1200.00, 50.00, 50.00, 1900.00, NULL, 1, '2024-03-11 07:07:48'),
(18, 6, 3, 600.00, 1200.00, 50.00, 50.00, 1900.00, NULL, 1, '2024-03-11 07:07:48');

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
  `CreateAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

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
  `CreateAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`Id`, `OutletId`, `TableId`, `CustomerId`, `ShiftDetailsId`, `PaymentMethodId`, `InvoiceStatus`, `AmountInUSD`, `AmountInKHR`, `PaidInUSD`, `PaidInKHR`, `Status`, `CreateBy`, `CreateAt`) VALUES
(1, 1, 1, 1, 1, 1, NULL, 10.00, 0.00, 10.00, 0.00, 1, 1, '2024-03-15 04:40:04'),
(2, 1, 1, 1, 1, 1, NULL, 5.00, 0.00, 5.00, 0.00, 1, 1, '2024-03-15 04:40:04'),
(3, 1, 2, 1, 1, 1, NULL, 6.00, 0.00, 6.00, 0.00, 1, 1, '2024-03-15 04:40:04'),
(4, 1, 2, 1, 1, 1, NULL, 6.00, 0.00, 6.00, 0.00, 1, 1, '2024-03-15 04:40:04'),
(5, 1, 3, 1, 2, 1, NULL, 10.00, 0.00, 10.00, 0.00, 1, 1, '2024-03-15 04:40:04'),
(6, 1, 3, 1, 2, 1, NULL, 5.00, 0.00, 5.00, 0.00, 1, 1, '2024-03-15 04:40:04'),
(7, 1, 4, 1, 2, 1, NULL, 6.00, 0.00, 6.00, 0.00, 1, 1, '2024-03-15 04:40:04'),
(8, 1, 4, 1, 2, 1, NULL, 6.00, 0.00, 6.00, 0.00, 1, 1, '2024-03-15 04:40:04');

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
(3, 'Beong Kok-III', 'BK-III', 1, '#1243, st3545, Beong kokIII, Phnom Penh', 1, '2024-03-12 08:36:53', NULL, NULL),
(5, 'Test101', 'Test101', 1, '#143, st3475, Beong kokII, Phnom Penh', 2, '2024-03-12 09:02:27', NULL, NULL),
(6, 'Beong Kok-103', 'BK-103', 1, '#1243, st3545, Beong kokIII, Phnom Penh', 2, '2024-03-12 09:02:27', NULL, NULL),
(7, 'SKI-TK', 'SKI-TK', 1, '#123, st45, Toul Kok, Phnom Phenh', 3, '2024-03-06 07:03:18', NULL, NULL),
(8, 'SKI-TTP', 'SKI-TTP', 1, '#125, st48, Toul Tom Pong, Phnom Phenh', 3, '2024-03-06 07:03:18', NULL, NULL),
(9, 'SKI-BKK', 'SKI-BKK', 1, '#13, st47, Beong Keng Kong, Phnom Phenh', 4, '2024-03-06 07:03:18', NULL, NULL),
(10, 'SKI-TK11', 'SKI-TK', 1, '#123, st45, Toul Kok, Phnom Phenh', 4, '2024-03-06 07:24:43', NULL, NULL);

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
  `ProCode` varchar(10) DEFAULT NULL,
  `CategoryId` int(11) DEFAULT NULL,
  `SkuId` int(11) NOT NULL,
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

INSERT INTO `product` (`Id`, `ProCode`, `CategoryId`, `SkuId`, `Name`, `Description`, `Image`, `Status`, `CreateBy`, `CreateAt`) VALUES
(1, NULL, 1, 1, 'Iced-latte', 'Iced-latte my favourite coffee', 'Iced-latte_image.jpg', 0, 1, '2024-03-11 07:10:06'),
(2, NULL, 2, 2, 'Hot-latte', 'Hot-latte my favourite coffee', 'Hot-latte_image.jpg', 1, 1, '2024-03-11 07:10:06'),
(3, NULL, 3, 1, 'Passion-soda', 'Passion-soda my favourite coffee', 'Passion-soda_image.jpg', 1, 2, '2024-03-11 07:10:06'),
(4, NULL, 4, 4, 'Iced-lemon-tea', 'Iced-lemon-tea my favourite coffee', 'Iced-lemon-tea_image.jpg', 1, 2, '2024-03-11 07:10:06'),
(5, NULL, 5, 5, 'Chocolate-frappe', 'Chocolate-frappe my favourite coffee', 'Chocolate-frappe_image.jpg', 1, 3, '2024-03-11 07:10:06'),
(6, NULL, 6, 7, 'Passion-cream', 'Passion-cream my favourite coffee', 'Passion-cream_image.jpg', 1, 3, '2024-03-11 07:10:06'),
(7, NULL, 1, 8, 'Iced-americano', 'Iced-americano my favourite coffee', 'Iced-americano_image.jpg', 0, 1, '2024-03-11 07:10:06'),
(8, NULL, 2, 4, 'Hot-cappucino', 'Hot-cappucino my favourite coffee', 'Hot-cappucino_image.jpg', 1, 1, '2024-03-11 07:10:06'),
(9, NULL, 3, 8, 'Blue-soda', 'Blue-soda my favourite coffee', 'Blue-soda_image.jpg', 1, 2, '2024-03-11 07:10:06'),
(10, NULL, 4, 4, 'Mint-ice-greentea', 'Mint-ice-greentea my favourite coffee', 'Mint-ice-greentea_image.jpg', 1, 1, '2024-03-11 07:10:06'),
(11, NULL, 5, 9, 'Cookie-frappe', 'Cookie-frappe my favourite coffee', 'Cookie-frappe_image.jpg', 0, 2, '2024-03-11 07:10:06'),
(12, NULL, 6, 11, 'Mango-cream', 'Mango-cream my favourite coffee', 'Mango_image.jpg', 1, 1, '2024-03-11 07:10:06'),
(13, 'Ice-0012', 1, 2, 'Iced-latte002', 'Iced-latte my favourite coffee', 'Iced-latte_image.jpg', 1, 1, '2024-03-11 07:10:06');

-- --------------------------------------------------------

--
-- Table structure for table `productsku`
--

CREATE TABLE `productsku` (
  `Id` int(11) NOT NULL,
  `ProductId` int(11) DEFAULT NULL,
  `UomId` int(11) DEFAULT NULL,
  `Price` decimal(6,2) NOT NULL,
  `Currency` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `productsku`
--

INSERT INTO `productsku` (`Id`, `ProductId`, `UomId`, `Price`, `Currency`) VALUES
(1, 1, 1, 2.00, 1),
(2, 1, 2, 2.30, 1),
(3, 1, 3, 3.00, 1),
(4, 2, 1, 2.00, 1),
(5, 2, 2, 2.30, 1),
(6, 2, 3, 2.30, 1),
(7, 3, 1, 2.00, 1),
(8, 3, 2, 2.30, 1),
(9, 3, 3, 2.30, 1),
(10, 4, 1, 2.00, 1),
(11, 4, 2, 2.30, 1),
(12, 4, 3, 2.30, 1),
(13, 5, 1, 2.00, 1),
(14, 5, 2, 2.30, 1),
(15, 5, 3, 2.30, 1),
(16, 6, 1, 2.00, 1),
(17, 6, 2, 2.30, 1),
(18, 6, 3, 2.30, 1),
(19, 7, 1, 2.00, 1),
(20, 7, 2, 2.30, 1),
(21, 7, 3, 2.30, 1),
(22, 8, 1, 2.00, 1),
(23, 8, 2, 2.30, 1),
(24, 8, 3, 2.30, 1),
(25, 9, 1, 2.00, 1),
(26, 9, 2, 2.30, 1),
(27, 9, 3, 2.30, 1),
(28, 10, 1, 2.00, 1),
(29, 10, 2, 2.30, 1),
(30, 10, 3, 2.30, 1),
(31, 11, 1, 2.00, 1),
(32, 11, 2, 2.30, 1),
(33, 11, 3, 2.30, 1),
(34, 12, 1, 2.00, 1),
(35, 12, 2, 2.30, 1),
(36, 12, 3, 2.30, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pro_in`
--

CREATE TABLE `pro_in` (
  `Id` int(11) NOT NULL,
  `ProId` int(11) NOT NULL,
  `Qty_In` int(11) NOT NULL,
  `Price_In` decimal(10,2) DEFAULT NULL,
  `Currency` int(11) DEFAULT 1,
  `Description` varchar(255) NOT NULL,
  `CreateBy` int(11) DEFAULT NULL,
  `CreateAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pro_moment`
--

CREATE TABLE `pro_moment` (
  `Id` int(11) NOT NULL,
  `ProId` int(11) NOT NULL,
  `Pro_Out_Id` int(11) NOT NULL,
  `Pro_In_Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pro_out`
--

CREATE TABLE `pro_out` (
  `Id` int(11) NOT NULL,
  `ProId` int(11) NOT NULL,
  `TableId` int(11) NOT NULL,
  `Qty_Out` int(11) NOT NULL,
  `Price_Out` int(11) NOT NULL,
  `Disc_Amount` decimal(10,2) DEFAULT NULL,
  `Disc_Percent` int(11) NOT NULL,
  `Qty_Out_Free` int(11) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `Currency` int(11) DEFAULT 1,
  `CreateBy` int(11) DEFAULT NULL,
  `CreateAt` timestamp NOT NULL DEFAULT current_timestamp()
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
  `Currency` varchar(11) DEFAULT NULL,
  `Isclosed` tinyint(1) DEFAULT 0,
  `CloseBy` int(11) DEFAULT NULL,
  `CloseAt` datetime DEFAULT NULL,
  `Status` tinyint(1) DEFAULT 1,
  `CreateAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `shiftdetails`
--

INSERT INTO `shiftdetails` (`Id`, `ShiftId`, `UserId`, `OpenningBalance`, `ClosingBalance`, `Currency`, `Isclosed`, `CloseBy`, `CloseAt`, `Status`, `CreateAt`) VALUES
(1, 1, 1, 80.00, 80.00, '1', 0, NULL, NULL, 1, '2024-03-05 10:00:00'),
(2, 2, 2, 90.00, 90.00, '1', 0, NULL, NULL, 1, '2024-03-05 10:00:00'),
(3, 1, 1, 20.00, 20.00, '1', 0, NULL, NULL, 1, '2024-03-06 10:00:00'),
(4, 2, 2, 30.00, 30.00, '1', 0, NULL, NULL, 1, '2024-03-06 10:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `table`
--

CREATE TABLE `table` (
  `Id` int(11) NOT NULL,
  `Name` varchar(20) NOT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `CreateAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `table`
--

INSERT INTO `table` (`Id`, `Name`, `Description`, `CreateAt`) VALUES
(1, 'Table1', 'Table1', '2024-05-03 09:49:33'),
(2, 'Table2', 'Table2', '2024-05-03 09:49:33'),
(3, 'Table3', 'Table3', '2024-05-03 09:49:33'),
(4, 'Table4', 'Table4', '2024-05-03 09:49:33'),
(5, 'Table5', 'Table5', '2024-05-03 09:49:33'),
(6, 'Table6', 'Table6', '2024-05-03 09:49:33');

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
  `UpdateAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `uom`
--

INSERT INTO `uom` (`Id`, `Code`, `Name`, `Remark`, `Status`, `CreateAt`, `UpdateAt`) VALUES
(1, 'Small', 'Small', 'Small', 1, '2024-05-24 02:31:09', NULL),
(2, 'Midlle', 'Midlle', 'Midlle', 1, '2024-05-24 02:35:01', NULL),
(3, 'Large', 'Large', 'Large', 1, '2024-05-24 02:35:40', NULL),
(4, 'Couple', 'Couple', 'Couple', 1, '2024-05-24 08:14:03', '2024-05-24 10:32:36');

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
(2, 1, 3, 2, 'sale', '123', '2024-03-02 11:00:00', 1, 1, '2024-03-11 06:58:57'),
(3, 1, 3, 3, 'HR', '123', '2024-03-02 11:00:00', 1, 1, '2024-03-11 06:58:57'),
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
  ADD KEY `Currency` (`Currency`);

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
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `productsku`
--
ALTER TABLE `productsku`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

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
  ADD CONSTRAINT `invoice_ibfk_4` FOREIGN KEY (`PaymentMethodId`) REFERENCES `paymentmethod` (`Id`),
  ADD CONSTRAINT `invoice_ibfk_5` FOREIGN KEY (`TableId`) REFERENCES `table` (`Id`);

--
-- Constraints for table `invoicedetails`
--
ALTER TABLE `invoicedetails`
  ADD CONSTRAINT `invoicedetails_ibfk_1` FOREIGN KEY (`InvoiceId`) REFERENCES `invoice` (`Id`),
  ADD CONSTRAINT `invoicedetails_ibfk_2` FOREIGN KEY (`ProductSkuId`) REFERENCES `productsku` (`Id`);

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
  ADD CONSTRAINT `pro_out_ibfk_2` FOREIGN KEY (`TableId`) REFERENCES `table` (`Id`);

--
-- Constraints for table `shiftdetails`
--
ALTER TABLE `shiftdetails`
  ADD CONSTRAINT `shiftdetails_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `user` (`Id`),
  ADD CONSTRAINT `shiftdetails_ibfk_2` FOREIGN KEY (`ShiftId`) REFERENCES `shift` (`Id`);

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
