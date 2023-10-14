-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 14, 2023 at 03:24 PM
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
(24, 'AL0000000001', 13, 'DISB', 'Disbursed', 'Client Disbursed', '', '2023-09-26 16:17:06'),
(25, 'AL0000000001', 14, 'DISB', 'Disbursed', 'Client Disbursed', '', '2023-09-26 22:23:40'),
(26, 'AL0000000001', 15, 'DISB', 'Disbursed', 'Client Disbursed', '', '2023-09-26 22:26:37'),
(27, 'AL0000000001', 16, 'DISB', 'Disbursed', 'Client Disbursed', '', '2023-09-26 22:29:46'),
(28, 'AL0000000001', 17, 'DISB', 'Disbursed', 'Client Disbursed', '', '2023-09-26 22:32:00'),
(29, 'AL0000000001', 18, 'DISB', 'Disbursed', 'Client Disbursed', '', '2023-09-26 22:35:28'),
(30, 'AL0000000001', 19, 'DISB', 'Disbursed', 'Client Disbursed', '', '2023-09-26 22:37:40'),
(31, 'AL0000000001', 20, 'DISB', 'Disbursed', 'Client Disbursed', '', '2023-09-27 22:13:52'),
(32, 'AL0000000002', 9, 'DISB', 'Disbursed', 'Client Disbursed', '', '2023-09-29 21:02:40'),
(33, 'AL0000000002', 10, 'DISB', 'Disbursed', 'Client Disbursed', '', '2023-09-29 21:08:00'),
(34, 'AL0000000003', 1, 'PND', 'ENCODE', NULL, '0001', '2023-10-06 11:46:47'),
(35, 'AL0000000003', 2, 'APR', 'Approved', ' ', '0003', '2023-10-09 20:30:12'),
(36, 'AL0000000003', 3, 'DISB', 'Disbursed', 'Client Disbursed', '', '2023-10-09 20:30:32');

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
(5, 'C0003', '0002', 'TESTTTT', 'TEWSSS', 'TEST', '1998-12-28', '12121212121', 'sss', 'mikss@gmail.com', 'test', 'test a', 'F', 'S', 24, '2023-09-13 18:10:39', 'ACTV', '0001', NULL, NULL),
(6, 'C0004', '0001', 'A', 'A', 'A', '2002-12-30', '09123456789', 'a', 'ads@gmail.com', 'Computer Shop', 'test', 'M', 'S', 20, '2023-10-04 15:09:50', 'IACTV', '0001', NULL, NULL),
(7, 'C0005', '0001', 'A', 'A', 'A', '2002-12-30', '09123456789', 'a', 'ads@gmail.com', 'Computer Shop', 'test', 'M', 'S', 20, '2023-10-04 15:11:06', 'IACTV', '0001', NULL, NULL),
(8, 'C0006', '0002', 'A', 'A', 'A', '1999-02-03', '09123456789', 'a', 'ads@gmail.com', 'a', 'a', 'M', 'S', 24, '2023-10-04 15:59:43', 'IACTV', '0001', NULL, NULL),
(9, 'C0007', '0003', 'B', 'B', 'B', '1999-02-02', '21212121212', 'b', 'mikss@gmail.com', 'b', 'b', 'M', 'S', 24, '2023-10-04 16:09:05', 'IACTV', '0001', NULL, NULL),
(10, 'C0008', '0001', 'C', 'C', 'C', '1997-01-29', '21212121212', 'c', 'ads@gmail.com', 'cc', 'c', 'M', 'S', 26, '2023-10-04 16:11:04', 'IACTV', '0001', NULL, NULL),
(11, 'C0009', '0001', 'C', 'C', 'C', '1997-01-29', '21212121212', 'c', 'ads@gmail.com', 'cc', 'c', 'M', 'S', 26, '2023-10-04 16:13:46', 'DEL', '0001', NULL, NULL),
(12, 'C0010', '0001', 'C', 'C', 'C', '1997-01-29', '21212121212', 'c', 'ads@gmail.com', 'cc', 'c', 'M', 'S', 26, '2023-10-04 16:14:56', 'DEL', '0001', NULL, NULL),
(13, 'C0011', '0001', 'B', 'A', 'A', '1982-06-10', '09123456789', 'sss', 'ads@gmail.com', 'test', 'test a', 'M', 'S', 41, '2023-10-04 16:20:12', 'DEL', '0001', NULL, NULL),
(19, 'C0012', '0002', 'Z', 'b', 'Z', '2004-02-05', '21212121212', 'z', 'ads@gmail.com', 'z', 'z', 'M', 'M', 19, '2023-10-05 22:33:57', 'DEL', '0001', '2023-10-06 11:30:17', '0001'),
(20, 'C0013', '0002', 'Z', 'Z', 'Z', '1988-02-02', '21212121212', 'z', 'ads@gmail.com', 'test', 'test', 'M', 'M', 35, '2023-10-06 11:43:33', 'ACTV', '0001', '2023-10-06 11:43:49', '0001');

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
(2, 'AL0000000002', 'C0003', '0002', 'p3', 'r1', 'wkly', '2023-09-29 00:00:00', 'DISB', 'NL', NULL, '2023-09-14 20:42:18', '0001', '2023-09-20 15:05:58', 1),
(3, 'AL0000000003', 'C0013', '0002', 'p1', 'r1', 'wkly', '2023-10-20 00:00:00', 'DISB', 'NL', NULL, '2023-10-06 11:46:47', '0001', NULL, NULL);

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
(4, '0002', 'MIKO ANGELO', 'MARACE', 'CORONADO', '01', 'it_head', '09123456789', 'mikss@gmail.com', '2023-09-04 00:00:00', 0, '2023-09-06 15:17:35', '0001', NULL, NULL),
(5, '0003', 'TYEST', 'TEST', 'TEST', '01', 'it_hd', '01010101010', 'sa@gmail.com', '2001-01-01 00:00:00', 0, '2023-10-09 16:43:51', '0001', NULL, NULL);

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
  `CreatedAt` datetime NOT NULL,
  `PostRemarks` varchar(100) DEFAULT NULL,
  `ConfirmRemarks` varchar(100) DEFAULT NULL,
  `PostedBy` varchar(100) DEFAULT NULL,
  `ConfirmBy` varchar(100) DEFAULT NULL,
  `PostedAt` datetime DEFAULT NULL,
  `ConfirmAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_loan_schedule`
--

INSERT INTO `t_loan_schedule` (`id`, `ApplicationNo`, `BranchID`, `ProductCode`, `InstallmentNo`, `InstallmentAmount`, `Balance`, `DueDate`, `StatusID`, `CreatedAt`, `PostRemarks`, `ConfirmRemarks`, `PostedBy`, `ConfirmBy`, `PostedAt`, `ConfirmAt`) VALUES
(286, 'AL0000000003', '0002', 'p1', 1, 403.23, 12096.8, '2023-10-27 00:00:00', 'PAID', '2023-10-09 20:30:32', 'confirm test 1', NULL, '0001', '0001', NULL, NULL),
(287, 'AL0000000003', '0002', 'p1', 2, 403.23, 11693.5, '2023-11-03 00:00:00', 'PAID', '2023-10-09 20:30:32', 'confirm', NULL, '0001', '0001', '2023-10-12 00:27:01', '2023-10-12 00:27:15'),
(288, 'AL0000000003', '0002', 'p1', 3, 403.23, 11290.3, '2023-11-10 00:00:00', 'PAID', '2023-10-09 20:30:32', 'post remarks', 'confirm remarks', '0001', '0001', '2023-10-12 00:32:51', '2023-10-12 00:33:07'),
(289, 'AL0000000003', '0002', 'p1', 4, 403.23, 10887.1, '2023-11-17 00:00:00', 'PND', '2023-10-09 20:30:32', '', NULL, NULL, NULL, NULL, NULL),
(290, 'AL0000000003', '0002', 'p1', 5, 403.23, 10483.9, '2023-11-24 00:00:00', 'PND', '2023-10-09 20:30:32', '', NULL, NULL, NULL, NULL, NULL),
(291, 'AL0000000003', '0002', 'p1', 6, 403.23, 10080.7, '2023-12-01 00:00:00', 'PND', '2023-10-09 20:30:32', '', NULL, NULL, NULL, NULL, NULL),
(292, 'AL0000000003', '0002', 'p1', 7, 403.23, 9677.42, '2023-12-08 00:00:00', 'PND', '2023-10-09 20:30:32', '', NULL, NULL, NULL, NULL, NULL),
(293, 'AL0000000003', '0002', 'p1', 8, 403.23, 9274.19, '2023-12-15 00:00:00', 'PND', '2023-10-09 20:30:32', '', NULL, NULL, NULL, NULL, NULL),
(294, 'AL0000000003', '0002', 'p1', 9, 403.23, 8870.97, '2023-12-22 00:00:00', 'PND', '2023-10-09 20:30:32', '', NULL, NULL, NULL, NULL, NULL),
(295, 'AL0000000003', '0002', 'p1', 10, 403.23, 8467.74, '2023-12-29 00:00:00', 'PND', '2023-10-09 20:30:32', '', NULL, NULL, NULL, NULL, NULL),
(296, 'AL0000000003', '0002', 'p1', 11, 403.23, 8064.52, '2024-01-05 00:00:00', 'PND', '2023-10-09 20:30:32', '', NULL, NULL, NULL, NULL, NULL),
(297, 'AL0000000003', '0002', 'p1', 12, 403.23, 7661.29, '2024-01-12 00:00:00', 'PND', '2023-10-09 20:30:32', '', NULL, NULL, NULL, NULL, NULL),
(298, 'AL0000000003', '0002', 'p1', 13, 403.23, 7258.06, '2024-01-19 00:00:00', 'PND', '2023-10-09 20:30:32', '', NULL, NULL, NULL, NULL, NULL),
(299, 'AL0000000003', '0002', 'p1', 14, 403.23, 6854.84, '2024-01-26 00:00:00', 'PND', '2023-10-09 20:30:32', '', NULL, NULL, NULL, NULL, NULL),
(300, 'AL0000000003', '0002', 'p1', 15, 403.23, 6451.61, '2024-02-02 00:00:00', 'PND', '2023-10-09 20:30:32', '', NULL, NULL, NULL, NULL, NULL),
(301, 'AL0000000003', '0002', 'p1', 16, 403.23, 6048.39, '2024-02-09 00:00:00', 'PND', '2023-10-09 20:30:32', '', NULL, NULL, NULL, NULL, NULL),
(302, 'AL0000000003', '0002', 'p1', 17, 403.23, 5645.16, '2024-02-16 00:00:00', 'PND', '2023-10-09 20:30:32', '', NULL, NULL, NULL, NULL, NULL),
(303, 'AL0000000003', '0002', 'p1', 18, 403.23, 5241.94, '2024-02-23 00:00:00', 'PND', '2023-10-09 20:30:32', '', NULL, NULL, NULL, NULL, NULL),
(304, 'AL0000000003', '0002', 'p1', 19, 403.23, 4838.71, '2024-03-01 00:00:00', 'PND', '2023-10-09 20:30:32', '', NULL, NULL, NULL, NULL, NULL),
(305, 'AL0000000003', '0002', 'p1', 20, 403.23, 4435.48, '2024-03-08 00:00:00', 'PND', '2023-10-09 20:30:32', '', NULL, NULL, NULL, NULL, NULL),
(306, 'AL0000000003', '0002', 'p1', 21, 403.23, 4032.26, '2024-03-15 00:00:00', 'PND', '2023-10-09 20:30:32', '', NULL, NULL, NULL, NULL, NULL),
(307, 'AL0000000003', '0002', 'p1', 22, 403.23, 3629.03, '2024-03-22 00:00:00', 'PND', '2023-10-09 20:30:32', '', NULL, NULL, NULL, NULL, NULL),
(308, 'AL0000000003', '0002', 'p1', 23, 403.23, 3225.81, '2024-03-29 00:00:00', 'PND', '2023-10-09 20:30:32', '', NULL, NULL, NULL, NULL, NULL),
(309, 'AL0000000003', '0002', 'p1', 24, 403.23, 2822.58, '2024-04-05 00:00:00', 'PND', '2023-10-09 20:30:32', '', NULL, NULL, NULL, NULL, NULL),
(310, 'AL0000000003', '0002', 'p1', 25, 403.23, 2419.35, '2024-04-12 00:00:00', 'PND', '2023-10-09 20:30:32', '', NULL, NULL, NULL, NULL, NULL),
(311, 'AL0000000003', '0002', 'p1', 26, 403.23, 2016.13, '2024-04-19 00:00:00', 'PND', '2023-10-09 20:30:32', '', NULL, NULL, NULL, NULL, NULL),
(312, 'AL0000000003', '0002', 'p1', 27, 403.23, 1612.9, '2024-04-26 00:00:00', 'PND', '2023-10-09 20:30:32', '', NULL, NULL, NULL, NULL, NULL),
(313, 'AL0000000003', '0002', 'p1', 28, 403.23, 1209.68, '2024-05-03 00:00:00', 'PND', '2023-10-09 20:30:32', '', NULL, NULL, NULL, NULL, NULL),
(314, 'AL0000000003', '0002', 'p1', 29, 403.23, 806.45, '2024-05-10 00:00:00', 'PND', '2023-10-09 20:30:32', '', NULL, NULL, NULL, NULL, NULL),
(315, 'AL0000000003', '0002', 'p1', 30, 403.23, 403.23, '2024-05-17 00:00:00', 'PND', '2023-10-09 20:30:32', '', NULL, NULL, NULL, NULL, NULL),
(316, 'AL0000000003', '0002', 'p1', 31, 403.23, -0, '2024-05-24 00:00:00', 'PND', '2023-10-09 20:30:32', '', NULL, NULL, NULL, NULL, NULL);

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
(17, 'RL', 'Repeat Loan', 0, '2023-09-13 18:05:58', '0001', NULL, NULL),
(18, 'OP', 'On Process', 0, '2023-10-09 20:39:37', '0003', NULL, NULL),
(19, 'DUE', 'On Due', 0, '2023-10-09 20:40:25', '0003', NULL, NULL),
(20, 'PAID', 'Paid', 0, '2023-10-09 20:41:08', '0003', NULL, NULL);

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
(7, '0002', 'super', '0003', 'c11ef36ea7a522f474b44a014fd40f7f', 0, '2023-09-06 15:21:15', '0001', NULL, NULL),
(8, '0003', 'super', '0001', 'ac96dbafd2a4097f7ee4a40b75304a4e', 0, '2023-10-09 16:44:12', '0001', NULL, NULL);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `t_branch`
--
ALTER TABLE `t_branch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `t_client`
--
ALTER TABLE `t_client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `t_client_application`
--
ALTER TABLE `t_client_application`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `t_department`
--
ALTER TABLE `t_department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `t_employee`
--
ALTER TABLE `t_employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `t_interest_rate`
--
ALTER TABLE `t_interest_rate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `t_loan_schedule`
--
ALTER TABLE `t_loan_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=317;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `t_term_type`
--
ALTER TABLE `t_term_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `t_user_account`
--
ALTER TABLE `t_user_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `t_user_roles`
--
ALTER TABLE `t_user_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
