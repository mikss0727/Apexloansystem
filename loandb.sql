-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 08, 2023 at 10:45 AM
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
  `ProcessBy` varchar(100) NOT NULL,
  `CreatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(1, '0001', 'Head Office', '01', '2023-08-05 17:35:37', '', NULL, '', 0),
(3, '0002', 'Sariaya', '', '2023-08-05 18:46:14', '0001', NULL, NULL, 0);

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
  `Age` int(11) NOT NULL,
  `CreatedAt` datetime NOT NULL,
  `StatusID` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `t_client_application`
--

CREATE TABLE `t_client_application` (
  `id` int(11) NOT NULL,
  `ApplicationNo` varchar(100) NOT NULL,
  `ClientID` varchar(100) NOT NULL,
  `BranchID` varchar(100) NOT NULL,
  `ProductCode` varchar(100) NOT NULL,
  `InterestCode` varchar(100) NOT NULL,
  `TermCode` varchar(100) NOT NULL,
  `DisbursementDate` datetime NOT NULL,
  `StatusID` varchar(100) NOT NULL,
  `ClosedDate` datetime NOT NULL,
  `CreateAt` datetime NOT NULL,
  `CreatedBy` int(11) NOT NULL,
  `UpdatedAt` datetime DEFAULT NULL,
  `UpdatedBy` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(3, '01', 'IT Department', 0, '0001', '2023-08-07 13:44:11', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_employee`
--

CREATE TABLE `t_employee` (
  `EmployeeID` varchar(100) NOT NULL,
  `FirstName` varchar(100) NOT NULL,
  `MiddleName` varchar(100) NOT NULL,
  `LastName` varchar(100) NOT NULL,
  `DeptID` varchar(100) NOT NULL,
  `PositionID` varchar(100) NOT NULL,
  `ContactNo` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `isActive` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_employee`
--

INSERT INTO `t_employee` (`EmployeeID`, `FirstName`, `MiddleName`, `LastName`, `DeptID`, `PositionID`, `ContactNo`, `Email`, `isActive`) VALUES
('0001', 'Jason', 'Lopez', 'Macalindong', '01', 'it_lead', '09123456789', 'jason@gmail.com', 0);

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
(1, 'r1', 'Rate 1', 0.00001, '2023-08-08 14:04:02', '0001', '2023-08-08 14:08:37', '0001', 0);

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
  `StatusID` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `ProductCode` varchar(100) NOT NULL,
  `ProductName` varchar(100) NOT NULL,
  `LoanAmount` float NOT NULL,
  `TermCode` varchar(100) NOT NULL,
  `isActive` tinyint(1) NOT NULL,
  `CreatedAt` datetime NOT NULL,
  `CreatedBy` varchar(100) NOT NULL,
  `UpdatedAt` datetime DEFAULT NULL,
  `UpdatedBy` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `t_product_term`
--

CREATE TABLE `t_product_term` (
  `id` int(11) NOT NULL,
  `TermID` varchar(100) NOT NULL,
  `TermName` varchar(100) NOT NULL,
  `WeeksNo` int(11) NOT NULL,
  `isActive` tinyint(1) NOT NULL,
  `CreatedAt` datetime NOT NULL,
  `CreatedBy` varchar(100) NOT NULL,
  `UpdatedAt` datetime DEFAULT NULL,
  `UpdatedBy` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_product_term`
--

INSERT INTO `t_product_term` (`id`, `TermID`, `TermName`, `WeeksNo`, `isActive`, `CreatedAt`, `CreatedBy`, `UpdatedAt`, `UpdatedBy`) VALUES
(3, 'w2', 'Half Month', 5, 0, '2023-08-08 14:15:30', '0001', '2023-08-08 14:15:39', '0001');

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
  `isActive` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_user_account`
--

INSERT INTO `t_user_account` (`id`, `EmployeeID`, `RoleID`, `BranchID`, `Password`, `isActive`) VALUES
(1, '0001', 'super', '0001', '47a8aacd3fa2d4d8f7adb54a236bae29', 0);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_branch`
--
ALTER TABLE `t_branch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `t_client`
--
ALTER TABLE `t_client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_client_application`
--
ALTER TABLE `t_client_application`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_department`
--
ALTER TABLE `t_department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `t_interest_rate`
--
ALTER TABLE `t_interest_rate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `t_loan_schedule`
--
ALTER TABLE `t_loan_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_position`
--
ALTER TABLE `t_position`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `t_product`
--
ALTER TABLE `t_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_product_term`
--
ALTER TABLE `t_product_term`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `t_status`
--
ALTER TABLE `t_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t_user_account`
--
ALTER TABLE `t_user_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t_user_roles`
--
ALTER TABLE `t_user_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
