-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 26, 2023 at 10:20 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `loandb`
--

-- --------------------------------------------------------

--
-- Table structure for table `t_applicationprocess`
--

CREATE TABLE `t_applicationprocess` (
  `id` int(11) NOT NULL,
  `ApplicationNo` varchar(100) NOT NULL,
  `ProcessNo` int(11) NOT NULL,
  `StatusID` varchar(100) NOT NULL,
  `ProcessValue` varchar(100) NOT NULL,
  `Remarks` varchar(100) DEFAULT NULL,
  `ProcessBy` varchar(100) NOT NULL,
  `CreatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_applicationprocess`
--

INSERT INTO `t_applicationprocess` (`id`, `ApplicationNo`, `ProcessNo`, `StatusID`, `ProcessValue`, `Remarks`, `ProcessBy`, `CreatedAt`) VALUES
(4, 'AL0000000001', 1, 'APR', 'Approved', 'test approved', '0001', '2023-09-17 00:41:46'),
(5, 'AL0000000002', 1, 'REJ', 'Rejected', 'Reject test', '0001', '2023-09-17 00:42:33'),
(6, 'AL0000000002', 2, 'CNCL', 'Cancelled', 'cancel muna', '0001', '2023-09-17 00:43:10'),
(7, 'AL0000000002', 3, 'APR', 'Approved', ' ', '0001', '2023-09-20 15:06:23'),
(8, 'AL0000000001', 2, 'DISB', 'Disbursed', 'Client Disbursed', '', '2023-09-21 17:46:04'),
(9, 'AL0000000002', 4, 'DISB', 'Disbursed', 'Client Disbursed', '', '2023-09-21 17:54:56'),
(10, 'AL0000000001', 3, 'DISB', 'Disbursed', 'Client Disbursed', '', '2023-09-21 17:58:16'),
(11, 'AL0000000001', 4, 'DISB', 'Disbursed', 'Client Disbursed', '', '2023-09-22 20:14:43'),
(12, 'AL0000000001', 5, 'DISB', 'Disbursed', 'Client Disbursed', '', '2023-09-22 20:15:17'),
(13, 'AL0000000001', 6, 'DISB', 'Disbursed', 'Client Disbursed', '', '2023-09-25 19:29:19'),
(14, 'AL0000000002', 5, 'DISB', 'Disbursed', 'Client Disbursed', '', '2023-09-25 19:30:23'),
(15, 'AL0000000001', 7, 'DISB', 'Disbursed', 'Client Disbursed', '', '2023-09-26 12:24:17'),
(16, 'AL0000000001', 8, 'DISB', 'Disbursed', 'Client Disbursed', '', '2023-09-26 12:24:44'),
(17, 'AL0000000002', 6, 'DISB', 'Disbursed', 'Client Disbursed', '', '2023-09-26 12:25:02'),
(18, 'AL0000000001', 9, 'DISB', 'Disbursed', 'Client Disbursed', '', '2023-09-26 14:40:30'),
(19, 'AL0000000002', 7, 'DISB', 'Disbursed', 'Client Disbursed', '', '2023-09-26 14:44:59'),
(20, 'AL0000000001', 10, 'DISB', 'Disbursed', 'Client Disbursed', '', '2023-09-26 14:47:36'),
(21, 'AL0000000001', 11, 'DISB', 'Disbursed', 'Client Disbursed', '', '2023-09-26 16:08:37'),
(22, 'AL0000000002', 8, 'DISB', 'Disbursed', 'Client Disbursed', '', '2023-09-26 16:12:25'),
(23, 'AL0000000001', 12, 'DISB', 'Disbursed', 'Client Disbursed', '', '2023-09-26 16:14:26'),
(24, 'AL0000000001', 13, 'DISB', 'Disbursed', 'Client Disbursed', '', '2023-09-26 16:17:06');

-- --------------------------------------------------------

--
-- Table structure for table `t_branch`
--

CREATE TABLE `t_branch` (
  `id` int(11) NOT NULL,
  `BranchID` varchar(100) NOT NULL,
  `BranchName` varchar(100) NOT NULL,
  `AreaCode` varchar(100) NOT NULL,
  `CreatedAt` datetime NOT NULL DEFAULT current_timestamp(),
  `CreatedBy` varchar(100) NOT NULL,
  `UpdatedAt` datetime DEFAULT NULL,
  `UpdatedBy` varchar(100) DEFAULT NULL,
  `isActive` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_branch`
--

INSERT INTO `t_branch` (`id`, `BranchID`, `BranchName`, `AreaCode`, `CreatedAt`, `CreatedBy`, `UpdatedAt`, `UpdatedBy`, `isActive`) VALUES
(4, '0001', 'Head Office', '', '2023-09-04 19:22:00', '0001', NULL, NULL, 0),
(5, '0002', 'Sariaya', '', '2023-09-04 19:23:17', '0001', '2023-09-05 21:30:49', '0001', 0),
(6, '0003', 'Candelaria', '', '2023-09-05 21:45:54', '0001', '2023-09-05 21:46:15', '0001', 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_client`
--

CREATE TABLE `t_client` (
  `id` int(11) NOT NULL,
  `ClientID` varchar(100) NOT NULL,
  `BranchID` varchar(100) NOT NULL,
  `FirstName` varchar(100) NOT NULL,
  `MiddleName` varchar(100) NOT NULL,
  `LastName` varchar(100) NOT NULL,
  `Birthday` date NOT NULL,
  `ContactNo` varchar(100) NOT NULL,
  `Address` varchar(256) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `BusinessName` varchar(256) NOT NULL,
  `BusinessAddress` varchar(256) NOT NULL,
  `Gender` varchar(100) NOT NULL,
  `MaritalStatus` varchar(100) NOT NULL,
  `Age` int(11) NOT NULL,
  `CreatedAt` datetime NOT NULL,
  `StatusID` varchar(100) NOT NULL,
  `CreatedBy` varchar(100) NOT NULL,
  `UpdatedAt` datetime DEFAULT NULL,
  `UpdatedBy` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_client`
--

INSERT INTO `t_client` (`id`, `ClientID`, `BranchID`, `FirstName`, `MiddleName`, `LastName`, `Birthday`, `ContactNo`, `Address`, `Email`, `BusinessName`, `BusinessAddress`, `Gender`, `MaritalStatus`, `Age`, `CreatedAt`, `StatusID`, `CreatedBy`, `UpdatedAt`, `UpdatedBy`) VALUES
(2, 'C0001', '0002', 'JASON', 'LOPEZ', 'MACALINDONG', '2000-10-19', '09123456711', 'pahinga', 'jasons@gmail.com', 'bbbbb', 'aaaaaaaaa', 'M', 'M', 22, '2023-08-14 22:11:01', 'ACTV', '0001', '2023-09-10 17:47:45', '0001'),
(4, 'C0002', '0003', 'JASON', 'LOPEZ', 'MACALINDONG', '2000-06-10', '21212121212', 'sss', 'mikss@gmail.com', 'Computer Shop', 'test', 'M', 'S', 23, '2023-09-10 17:24:35', 'IACTV', '0001', NULL, NULL),
(5, 'C0003', '0002', 'TESTTTT', 'TEWSSS', 'TEST', '1998-12-28', '12121212121', 'sss', 'mikss@gmail.com', 'test', 'test a', 'F', 'S', 24, '2023-09-13 18:10:39', 'ACTV', '0001', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_client_application`
--

CREATE TABLE `t_client_application` (
  `id` int(11) NOT NULL,
  `ApplicationNo` varchar(100) NOT NULL,
  `ClientID` varchar(100) NOT NULL,
  `BranchID` varchar(100) NOT NULL,
  `ProductID` varchar(100) NOT NULL,
  `InterestCode` varchar(100) NOT NULL,
  `TermType` varchar(100) NOT NULL,
  `DisbursementDate` datetime NOT NULL,
  `StatusID` varchar(100) NOT NULL,
  `LoanType` varchar(100) NOT NULL,
  `ClosedDate` datetime DEFAULT NULL,
  `CreatedAt` datetime NOT NULL,
  `CreatedBy` varchar(100) NOT NULL,
  `UpdatedAt` datetime DEFAULT NULL,
  `UpdatedBy` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_client_application`
--

INSERT INTO `t_client_application` (`id`, `ApplicationNo`, `ClientID`, `BranchID`, `ProductID`, `InterestCode`, `TermType`, `DisbursementDate`, `StatusID`, `LoanType`, `ClosedDate`, `CreatedAt`, `CreatedBy`, `UpdatedAt`, `UpdatedBy`) VALUES
(1, 'AL0000000001', 'C0001', '0002', 'p2', 'r1', 'wkly', '2023-10-02 00:00:00', 'DISB', 'NL', NULL, '2023-09-14 00:36:12', '0001', '2023-09-15 22:14:48', 1),
(2, 'AL0000000002', 'C0003', '0002', 'p3', 'r1', 'wkly', '2023-09-29 00:00:00', 'FORDISB', 'NL', NULL, '2023-09-14 20:42:18', '0001', '2023-09-20 15:05:58', 1);

-- --------------------------------------------------------

--
-- Table structure for table `t_department`
--

CREATE TABLE `t_department` (
  `id` int(11) NOT NULL,
  `DeptID` varchar(100) NOT NULL,
  `DeptName` varchar(100) NOT NULL,
  `isActive` tinyint(1) NOT NULL,
  `CreatedBy` varchar(100) NOT NULL,
  `CreatedAt` datetime NOT NULL DEFAULT current_timestamp(),
  `UpdatedBy` varchar(100) DEFAULT NULL,
  `UpdatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_department`
--

INSERT INTO `t_department` (`id`, `DeptID`, `DeptName`, `isActive`, `CreatedBy`, `CreatedAt`, `UpdatedBy`, `UpdatedAt`) VALUES
(3, '01', 'IT Department', 0, '0001', '2023-08-07 13:44:11', '0001', '2023-09-05 21:41:20');

-- --------------------------------------------------------

--
-- Table structure for table `t_employee`
--

CREATE TABLE `t_employee` (
  `id` int(11) NOT NULL,
  `EmployeeID` varchar(100) NOT NULL,
  `FirstName` varchar(100) NOT NULL,
  `MiddleName` varchar(100) NOT NULL,
  `LastName` varchar(100) NOT NULL,
  `DeptID` varchar(100) NOT NULL,
  `PositionID` varchar(100) NOT NULL,
  `ContactNo` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Birthday` datetime NOT NULL,
  `isActive` tinyint(1) NOT NULL,
  `CreatedAt` datetime NOT NULL,
  `CreatedBy` varchar(100) NOT NULL,
  `UpdatedAt` datetime DEFAULT NULL,
  `UpdatedBy` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_employee`
--

INSERT INTO `t_employee` (`id`, `EmployeeID`, `FirstName`, `MiddleName`, `LastName`, `DeptID`, `PositionID`, `ContactNo`, `Email`, `Birthday`, `isActive`, `CreatedAt`, `CreatedBy`, `UpdatedAt`, `UpdatedBy`) VALUES
(1, '0001', 'JASON', 'LOPEZ', 'MACALINDONG', '01', 'it_hd', '09123456799', 'jasons@gmail.com', '1999-10-17 00:00:00', 0, '2023-09-06 23:27:16', '', '2023-09-05 23:30:13', '0001'),
(4, '0002', 'MIKO ANGELO', 'MARACE', 'CORONADO', '01', 'it_head', '09123456789', 'mikss@gmail.com', '2023-09-04 00:00:00', 0, '2023-09-06 15:17:35', '0001', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_interest_rate`
--

CREATE TABLE `t_interest_rate` (
  `id` int(11) NOT NULL,
  `RateID` varchar(100) NOT NULL,
  `RateName` varchar(100) NOT NULL,
  `Rate` float NOT NULL,
  `CreatedAt` datetime NOT NULL,
  `CreatedBy` varchar(100) NOT NULL,
  `UpdatedAt` datetime DEFAULT NULL,
  `UpdatedBy` varchar(100) DEFAULT NULL,
  `isActive` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_interest_rate`
--

INSERT INTO `t_interest_rate` (`id`, `RateID`, `RateName`, `Rate`, `CreatedAt`, `CreatedBy`, `UpdatedAt`, `UpdatedBy`, `isActive`) VALUES
(1, 'r1', 'Rate 1', 0.5, '2023-08-08 14:04:02', '0001', '2023-09-06 13:59:15', '0001', 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_loan_schedule`
--

CREATE TABLE `t_loan_schedule` (
  `id` int(11) NOT NULL,
  `ApplicationNo` varchar(100) NOT NULL,
  `BranchID` varchar(100) NOT NULL,
  `ProductCode` varchar(100) NOT NULL,
  `InstallmentNo` int(11) NOT NULL,
  `InstallmentAmount` float NOT NULL,
  `Balance` float NOT NULL,
  `DueDate` datetime NOT NULL,
  `StatusID` varchar(100) NOT NULL,
  `CreatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_loan_schedule`
--

INSERT INTO `t_loan_schedule` (`id`, `ApplicationNo`, `BranchID`, `ProductCode`, `InstallmentNo`, `InstallmentAmount`, `Balance`, `DueDate`, `StatusID`, `CreatedAt`) VALUES
(176, 'AL0000000001', '0002', 'p2', 1, 2500, 22500, '2023-10-09 00:00:00', 'PND', '2023-09-26 16:17:06'),
(177, 'AL0000000001', '0002', 'p2', 2, 2500, 20000, '2023-10-16 00:00:00', 'PND', '2023-09-26 16:17:06'),
(178, 'AL0000000001', '0002', 'p2', 3, 2500, 17500, '2023-10-23 00:00:00', 'PND', '2023-09-26 16:17:06'),
(179, 'AL0000000001', '0002', 'p2', 4, 2500, 15000, '2023-10-30 00:00:00', 'PND', '2023-09-26 16:17:06'),
(180, 'AL0000000001', '0002', 'p2', 5, 2500, 12500, '2023-11-06 00:00:00', 'PND', '2023-09-26 16:17:06'),
(181, 'AL0000000001', '0002', 'p2', 6, 2500, 10000, '2023-11-13 00:00:00', 'PND', '2023-09-26 16:17:06'),
(182, 'AL0000000001', '0002', 'p2', 7, 2500, 7500, '2023-11-20 00:00:00', 'PND', '2023-09-26 16:17:06'),
(183, 'AL0000000001', '0002', 'p2', 8, 2500, 5000, '2023-11-27 00:00:00', 'PND', '2023-09-26 16:17:06'),
(184, 'AL0000000001', '0002', 'p2', 9, 2500, 2500, '2023-12-04 00:00:00', 'PND', '2023-09-26 16:17:06'),
(185, 'AL0000000001', '0002', 'p2', 10, 2500, 0, '2023-12-11 00:00:00', 'PND', '2023-09-26 16:17:06');

-- --------------------------------------------------------

--
-- Table structure for table `t_marital_status`
--

CREATE TABLE `t_marital_status` (
  `id` int(11) NOT NULL,
  `MaritalID` varchar(100) NOT NULL,
  `MaritalName` varchar(100) NOT NULL,
  `isActive` tinyint(1) NOT NULL,
  `CreatedAt` datetime NOT NULL DEFAULT current_timestamp(),
  `CreatedBy` varchar(100) NOT NULL,
  `UpdatedBy` varchar(100) DEFAULT NULL,
  `UpdatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_marital_status`
--

INSERT INTO `t_marital_status` (`id`, `MaritalID`, `MaritalName`, `isActive`, `CreatedAt`, `CreatedBy`, `UpdatedBy`, `UpdatedAt`) VALUES
(2, 'M', 'Married', 0, '2023-08-11 18:20:27', '0001', NULL, NULL),
(3, 'S', 'Single', 0, '2023-08-11 18:20:44', '0001', '0001', '2023-09-05 23:42:50');

-- --------------------------------------------------------

--
-- Table structure for table `t_position`
--

CREATE TABLE `t_position` (
  `id` int(11) NOT NULL,
  `PositionID` varchar(100) NOT NULL,
  `PositionName` varchar(100) NOT NULL,
  `isActive` tinyint(1) NOT NULL,
  `CreatedAt` datetime NOT NULL DEFAULT current_timestamp(),
  `CreatedBy` varchar(100) NOT NULL,
  `UpdatedBy` varchar(100) DEFAULT NULL,
  `UpdatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_position`
--

INSERT INTO `t_position` (`id`, `PositionID`, `PositionName`, `isActive`, `CreatedAt`, `CreatedBy`, `UpdatedBy`, `UpdatedAt`) VALUES
(9, 'it_hd', 'IT Helpdesk', 0, '2023-08-05 18:23:02', '0001', NULL, NULL),
(11, 'it_head', 'IT Head', 0, '2023-08-07 13:39:46', '0001', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_product`
--

CREATE TABLE `t_product` (
  `id` int(11) NOT NULL,
  `ProductID` varchar(100) NOT NULL,
  `ProductName` varchar(100) NOT NULL,
  `LoanAmount` float NOT NULL,
  `TermID` varchar(100) NOT NULL,
  `isActive` tinyint(1) NOT NULL,
  `CreatedAt` datetime NOT NULL,
  `CreatedBy` varchar(100) NOT NULL,
  `UpdatedAt` datetime DEFAULT NULL,
  `UpdatedBy` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_product`
--

INSERT INTO `t_product` (`id`, `ProductID`, `ProductName`, `LoanAmount`, `TermID`, `isActive`, `CreatedAt`, `CreatedBy`, `UpdatedAt`, `UpdatedBy`) VALUES
(2, 'p1', 'P1-5k', 5000, 't2', 0, '2023-08-09 18:49:38', '0001', '2023-09-14 21:27:33', '0001'),
(3, 'p2', 'p10', 10000, 't3', 1, '2023-09-06 00:16:37', '0001', '2023-09-06 00:17:03', '0001'),
(4, 'p3', '15k', 15000, 't1', 0, '2023-09-14 21:21:39', '0001', NULL, NULL),
(5, 'p4', '20k', 20000, 't2', 0, '2023-09-14 21:23:20', '0001', NULL, NULL),
(6, 'p5', 'p5 2 Months', 30000, 't3', 0, '2023-09-15 21:57:47', '0001', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_product_term`
--

CREATE TABLE `t_product_term` (
  `id` int(11) NOT NULL,
  `TermID` varchar(100) NOT NULL,
  `TermName` varchar(100) NOT NULL,
  `TermNo` int(11) NOT NULL,
  `isActive` tinyint(1) NOT NULL,
  `CreatedAt` datetime NOT NULL,
  `CreatedBy` varchar(100) NOT NULL,
  `UpdatedAt` datetime DEFAULT NULL,
  `UpdatedBy` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_product_term`
--

INSERT INTO `t_product_term` (`id`, `TermID`, `TermName`, `TermNo`, `isActive`, `CreatedAt`, `CreatedBy`, `UpdatedAt`, `UpdatedBy`) VALUES
(8, 't1', '15 Days', 15, 0, '2023-09-14 21:02:23', '0001', NULL, NULL),
(9, 't2', '1 Month', 31, 0, '2023-09-14 21:02:48', '0001', NULL, NULL),
(10, 't3', '2 Months', 10, 0, '2023-09-15 21:55:41', '0001', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_status`
--

CREATE TABLE `t_status` (
  `id` int(11) NOT NULL,
  `StatusID` varchar(100) NOT NULL,
  `StatusName` varchar(100) NOT NULL,
  `isActive` tinyint(1) NOT NULL,
  `CreatedAt` datetime NOT NULL,
  `CreatedBy` varchar(100) NOT NULL,
  `UpdatedAt` datetime DEFAULT NULL,
  `UpdatedBy` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_status`
--

INSERT INTO `t_status` (`id`, `StatusID`, `StatusName`, `isActive`, `CreatedAt`, `CreatedBy`, `UpdatedAt`, `UpdatedBy`) VALUES
(2, 'PND', 'Pending', 0, '2023-08-17 21:19:14', '0001', NULL, NULL),
(3, 'APR', 'Approved', 0, '2023-08-24 18:39:13', '0001', NULL, NULL),
(4, 'REJ', 'Rejected', 0, '2023-08-24 18:39:24', '0001', NULL, NULL),
(8, 'DISB', 'Disbursed', 0, '2023-09-11 14:29:00', '0001', NULL, NULL),
(12, 'FORDISB', 'For Disbursement', 0, '2023-09-11 14:54:28', '0001', NULL, NULL),
(13, 'CNCL', 'Cancel', 0, '2023-09-13 18:00:37', '0001', NULL, NULL),
(14, 'ACTV', 'Active', 0, '2023-09-13 18:02:31', '0001', NULL, NULL),
(15, 'IACTV', 'Inactive', 0, '2023-09-13 18:04:20', '0001', NULL, NULL),
(16, 'NL', 'New Loan', 0, '2023-09-13 18:05:44', '0001', NULL, NULL),
(17, 'RL', 'Repeat Loan', 0, '2023-09-13 18:05:58', '0001', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_term_type`
--

CREATE TABLE `t_term_type` (
  `id` int(11) NOT NULL,
  `TypeID` varchar(100) NOT NULL,
  `TypeName` varchar(100) NOT NULL,
  `DaysNo` int(11) NOT NULL,
  `isActive` tinyint(1) NOT NULL,
  `CreatedBy` varchar(100) NOT NULL,
  `CreatedAt` datetime NOT NULL,
  `UpdatedBy` varchar(100) DEFAULT NULL,
  `UpdatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_term_type`
--

INSERT INTO `t_term_type` (`id`, `TypeID`, `TypeName`, `DaysNo`, `isActive`, `CreatedBy`, `CreatedAt`, `UpdatedBy`, `UpdatedAt`) VALUES
(2, 'dly', 'Daily', 1, 0, '0001', '2023-08-25 14:51:22', NULL, NULL),
(4, 'wkly', 'Weekly', 7, 0, '0001', '2023-09-14 21:08:18', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_user_account`
--

CREATE TABLE `t_user_account` (
  `id` int(11) NOT NULL,
  `EmployeeID` varchar(100) NOT NULL,
  `RoleID` varchar(100) NOT NULL,
  `BranchID` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `isActive` tinyint(1) NOT NULL,
  `CreatedAt` datetime NOT NULL,
  `CreatedBy` varchar(100) NOT NULL,
  `UpdatedAt` datetime DEFAULT NULL,
  `UpdatedBy` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_user_account`
--

INSERT INTO `t_user_account` (`id`, `EmployeeID`, `RoleID`, `BranchID`, `Password`, `isActive`, `CreatedAt`, `CreatedBy`, `UpdatedAt`, `UpdatedBy`) VALUES
(1, '0001', 'super', '0001', '47a8aacd3fa2d4d8f7adb54a236bae29', 0, '2023-09-01 15:16:30', '', NULL, NULL),
(7, '0002', 'super', '0003', 'c11ef36ea7a522f474b44a014fd40f7f', 0, '2023-09-06 15:21:15', '0001', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_user_roles`
--

CREATE TABLE `t_user_roles` (
  `id` int(11) NOT NULL,
  `RoleID` varchar(100) NOT NULL,
  `RoleName` varchar(100) NOT NULL,
  `CreatedBy` varchar(100) NOT NULL,
  `CreatedAt` datetime NOT NULL,
  `UpdatedBy` varchar(100) DEFAULT NULL,
  `UpdatedAt` datetime DEFAULT NULL,
  `isActive` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_user_roles`
--

INSERT INTO `t_user_roles` (`id`, `RoleID`, `RoleName`, `CreatedBy`, `CreatedAt`, `UpdatedBy`, `UpdatedAt`, `isActive`) VALUES
(1, 'super', 'Super Admin', '0001', '2023-08-06 14:37:52', '0001', '2023-08-06 14:42:44', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_applicationprocess`
--
ALTER TABLE `t_applicationprocess`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_branch`
--
ALTER TABLE `t_branch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_client`
--
ALTER TABLE `t_client`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_client_application`
--
ALTER TABLE `t_client_application`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_department`
--
ALTER TABLE `t_department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_employee`
--
ALTER TABLE `t_employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_interest_rate`
--
ALTER TABLE `t_interest_rate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_loan_schedule`
--
ALTER TABLE `t_loan_schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_marital_status`
--
ALTER TABLE `t_marital_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_position`
--
ALTER TABLE `t_position`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_product`
--
ALTER TABLE `t_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_product_term`
--
ALTER TABLE `t_product_term`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_status`
--
ALTER TABLE `t_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_term_type`
--
ALTER TABLE `t_term_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_user_account`
--
ALTER TABLE `t_user_account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_user_roles`
--
ALTER TABLE `t_user_roles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_applicationprocess`
--
ALTER TABLE `t_applicationprocess`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `t_branch`
--
ALTER TABLE `t_branch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `t_client`
--
ALTER TABLE `t_client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `t_client_application`
--
ALTER TABLE `t_client_application`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `t_department`
--
ALTER TABLE `t_department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `t_employee`
--
ALTER TABLE `t_employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `t_interest_rate`
--
ALTER TABLE `t_interest_rate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `t_loan_schedule`
--
ALTER TABLE `t_loan_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=186;

--
-- AUTO_INCREMENT for table `t_marital_status`
--
ALTER TABLE `t_marital_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `t_position`
--
ALTER TABLE `t_position`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `t_product`
--
ALTER TABLE `t_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `t_product_term`
--
ALTER TABLE `t_product_term`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `t_status`
--
ALTER TABLE `t_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `t_term_type`
--
ALTER TABLE `t_term_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `t_user_account`
--
ALTER TABLE `t_user_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `t_user_roles`
--
ALTER TABLE `t_user_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
