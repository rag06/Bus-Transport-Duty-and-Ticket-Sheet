-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 12, 2017 at 08:08 AM
-- Server version: 5.5.24-log
-- PHP Version: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `tickets`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE IF NOT EXISTS `admin_users` (
  `Admin_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Admin_Name` varchar(500) NOT NULL,
  `Admin_Email` varchar(500) NOT NULL,
  `Admin_CreatedOn` datetime NOT NULL,
  `Admin_CreatedBy` int(12) NOT NULL,
  `Admin_Status` int(1) NOT NULL DEFAULT '1',
  `Admin_Uname` varchar(500) NOT NULL,
  `Admin_Pass` varchar(500) NOT NULL,
  `Admin_Role` int(1) NOT NULL DEFAULT '0',
  `Admin_ViewOnly` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Admin_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`Admin_Id`, `Admin_Name`, `Admin_Email`, `Admin_CreatedOn`, `Admin_CreatedBy`, `Admin_Status`, `Admin_Uname`, `Admin_Pass`, `Admin_Role`, `Admin_ViewOnly`) VALUES
(1, 'Anurag Singh', 'info@creativewebie.org', '2016-09-04 12:40:24', 1, 1, 'anurag', 'anurag', 1, 0),
(3, 'KDMT Admin', 'shampashte@gmail.com', '2017-11-12 10:38:16', 1, 1, 'kdmtadmin', 'kdmt@2017', 1, 0),
(4, 'KDMT User', 'shampashte@gmail.com', '2017-11-12 10:39:27', 1, 1, 'kdmtuser', 'kdmt@2017', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `bus_duty`
--

CREATE TABLE IF NOT EXISTS `bus_duty` (
  `bus_duty_Id` int(12) NOT NULL AUTO_INCREMENT,
  `bus_duty_RouteId` int(12) NOT NULL,
  `bus_duty_Number` int(12) NOT NULL,
  `bus_duty_CreatedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `bus_duty_AddedBy` int(12) NOT NULL DEFAULT '0',
  PRIMARY KEY (`bus_duty_Id`),
  KEY `bus_duty_RouteId` (`bus_duty_RouteId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `bus_duty`
--

INSERT INTO `bus_duty` (`bus_duty_Id`, `bus_duty_RouteId`, `bus_duty_Number`, `bus_duty_CreatedOn`, `bus_duty_AddedBy`) VALUES
(1, 1, 1, '2017-11-12 04:31:01', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bus_routes`
--

CREATE TABLE IF NOT EXISTS `bus_routes` (
  `Bus_Routes_Id` int(12) NOT NULL AUTO_INCREMENT,
  `Bus_Routes_Number` int(12) NOT NULL,
  `Bus_Routes_Name` varchar(250) NOT NULL,
  `Bus_Routes_Status` tinyint(1) NOT NULL DEFAULT '1',
  `Bus_Routes_AddedDateandTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Bus_Routes_CreatedBy` int(12) NOT NULL,
  PRIMARY KEY (`Bus_Routes_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `bus_routes`
--

INSERT INTO `bus_routes` (`Bus_Routes_Id`, `Bus_Routes_Number`, `Bus_Routes_Name`, `Bus_Routes_Status`, `Bus_Routes_AddedDateandTime`, `Bus_Routes_CreatedBy`) VALUES
(1, 35, 'Bhiwandi', 1, '2017-11-12 04:39:06', 1),
(2, 45, 'Kalyan', 1, '2017-11-11 05:47:10', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bus_timing`
--

CREATE TABLE IF NOT EXISTS `bus_timing` (
  `bus_timing_Id` int(12) NOT NULL AUTO_INCREMENT,
  `bus_timing_DutyId` int(12) NOT NULL,
  `bus_timing_RouteId` int(12) NOT NULL,
  `bus_timing_Source` varchar(250) NOT NULL,
  `bus_timing_Destination` varchar(250) NOT NULL,
  `bus_timing_Kilometers` varchar(250) NOT NULL,
  `bus_timing_StartTime` time NOT NULL,
  `bus_timing_DestinationTime` time NOT NULL,
  `bus_timing_CreatedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `bus_timing_AddedBy` int(12) NOT NULL,
  `bus_timing_Status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`bus_timing_Id`),
  KEY `bus_timing_DutyId` (`bus_timing_DutyId`),
  KEY `bus_timing_RouteId` (`bus_timing_RouteId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `bus_timing`
--

INSERT INTO `bus_timing` (`bus_timing_Id`, `bus_timing_DutyId`, `bus_timing_RouteId`, `bus_timing_Source`, `bus_timing_Destination`, `bus_timing_Kilometers`, `bus_timing_StartTime`, `bus_timing_DestinationTime`, `bus_timing_CreatedOn`, `bus_timing_AddedBy`, `bus_timing_Status`) VALUES
(1, 1, 1, 'Kalyan', 'Bhiwandi', '11', '22:00:00', '22:30:00', '2017-11-12 04:58:05', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cashdeposit_slip`
--

CREATE TABLE IF NOT EXISTS `cashdeposit_slip` (
  `cashDeposit_slip_Id` int(12) NOT NULL AUTO_INCREMENT,
  `cashDeposit_slip_Number` bigint(20) NOT NULL,
  `cashDeposit_slip_ConductorEmpId` int(12) NOT NULL,
  `cashDeposit_slip_Date` date NOT NULL,
  `cashDeposit_slip_DutyId` int(12) NOT NULL,
  `cashDeposit_slip_BusNumber` varchar(250) NOT NULL,
  `cashDeposit_slip_DriverEmpId` int(12) NOT NULL,
  `cashDeposit_slip_AddedDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cashDeposit_slip_AddedBy` int(12) NOT NULL,
  PRIMARY KEY (`cashDeposit_slip_Id`),
  KEY `cashDeposit_slip_ConductorEmpId` (`cashDeposit_slip_ConductorEmpId`),
  KEY `cashDeposit_slip_DriverEmpId` (`cashDeposit_slip_DriverEmpId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `cashdeposit_slip`
--

INSERT INTO `cashdeposit_slip` (`cashDeposit_slip_Id`, `cashDeposit_slip_Number`, `cashDeposit_slip_ConductorEmpId`, `cashDeposit_slip_Date`, `cashDeposit_slip_DutyId`, `cashDeposit_slip_BusNumber`, `cashDeposit_slip_DriverEmpId`, `cashDeposit_slip_AddedDateTime`, `cashDeposit_slip_AddedBy`) VALUES
(1, 526659, 6, '2017-11-11', 1, '1171', 7, '2017-11-11 06:13:24', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cashdeposit_slip_details`
--

CREATE TABLE IF NOT EXISTS `cashdeposit_slip_details` (
  `cashDeposit_slip_details_Id` int(12) NOT NULL AUTO_INCREMENT,
  `cashDeposit_slip_details_SlipId` int(12) NOT NULL,
  `cashDeposit_slip_details_TicketId` int(12) NOT NULL,
  `cashDeposit_slip_details_ticketSeries` bigint(20) DEFAULT NULL,
  `cashDeposit_slip_details_TicketStartSerial` bigint(20) DEFAULT NULL,
  `cashDeposit_slip_details_TicketEndSerial` bigint(20) DEFAULT NULL,
  `cashDeposit_slip_details_ActualTicketsSold` int(12) DEFAULT NULL,
  `cashDeposit_slip_details_CalculatedAmount` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`cashDeposit_slip_details_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `cashdeposit_slip_details`
--

INSERT INTO `cashdeposit_slip_details` (`cashDeposit_slip_details_Id`, `cashDeposit_slip_details_SlipId`, `cashDeposit_slip_details_TicketId`, `cashDeposit_slip_details_ticketSeries`, `cashDeposit_slip_details_TicketStartSerial`, `cashDeposit_slip_details_TicketEndSerial`, `cashDeposit_slip_details_ActualTicketsSold`, `cashDeposit_slip_details_CalculatedAmount`) VALUES
(1, 1, 1, 3, 494768, 494768, 0, '0.00'),
(2, 1, 2, 51, 499182, 499196, 14, '70.00'),
(3, 1, 3, 10, 734642, 734699, 58, '580.00'),
(4, 1, 3, 10, 734700, 734745, 45, '450.00'),
(5, 1, 4, 23, 968782, 968799, 18, '108.00'),
(6, 1, 4, 23, 980600, 980678, 78, '468.00'),
(7, 1, 5, 4, 522815, 522899, 85, '765.00'),
(8, 1, 5, 4, 522900, 522911, 11, '99.00'),
(9, 1, 6, 3, 79832, 79832, 0, '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `conductor_daysslip`
--

CREATE TABLE IF NOT EXISTS `conductor_daysslip` (
  `conductor_daysSlip_Id` int(12) NOT NULL AUTO_INCREMENT,
  `conductor_daysSlip_ConductorEmpId` int(12) NOT NULL,
  `conductor_daysSlip_DutyId` int(12) NOT NULL,
  `conductor_daysSlip_BusNumber` int(12) NOT NULL,
  `conductor_daysSlip_DriveEmpId` int(12) NOT NULL,
  `conductor_daysslip_date` date NOT NULL,
  `conductor_daysSlip_AddedDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `conductor_daysSlip_AddedBy` int(12) NOT NULL,
  PRIMARY KEY (`conductor_daysSlip_Id`),
  KEY `conductor_daysSlip_ConductorEmpId` (`conductor_daysSlip_ConductorEmpId`),
  KEY `conductor_daysSlip_DriveEmpId` (`conductor_daysSlip_DriveEmpId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `conductor_daysslip`
--

INSERT INTO `conductor_daysslip` (`conductor_daysSlip_Id`, `conductor_daysSlip_ConductorEmpId`, `conductor_daysSlip_DutyId`, `conductor_daysSlip_BusNumber`, `conductor_daysSlip_DriveEmpId`, `conductor_daysslip_date`, `conductor_daysSlip_AddedDateTime`, `conductor_daysSlip_AddedBy`) VALUES
(1, 6, 1, 1171, 7, '2017-11-10', '2017-11-11 05:52:58', 1);

-- --------------------------------------------------------

--
-- Table structure for table `conductor_daysslip_details`
--

CREATE TABLE IF NOT EXISTS `conductor_daysslip_details` (
  `conductor_daysslip_details_Id` int(12) NOT NULL AUTO_INCREMENT,
  `conductor_daysslip_details_SlipId` int(12) NOT NULL,
  `conductor_daysslip_details_ActSourceTime` time NOT NULL,
  `conductor_daysslip_details_ActDestTime` time NOT NULL,
  `conductor_daysslip_details_ActualKm` decimal(8,3) NOT NULL,
  PRIMARY KEY (`conductor_daysslip_details_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `conductor_daysslip_details`
--

INSERT INTO `conductor_daysslip_details` (`conductor_daysslip_details_Id`, `conductor_daysslip_details_SlipId`, `conductor_daysslip_details_ActSourceTime`, `conductor_daysslip_details_ActDestTime`, `conductor_daysslip_details_ActualKm`) VALUES
(1, 1, '00:00:00', '00:00:00', '0.000');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE IF NOT EXISTS `employees` (
  `Employee_Id` int(12) NOT NULL AUTO_INCREMENT,
  `Employee_Number` bigint(20) NOT NULL,
  `Employee_Type` tinyint(1) NOT NULL,
  `Employee_Name` varchar(250) NOT NULL,
  `Employee_Status` tinyint(1) NOT NULL,
  `Employee_AddedDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Employee_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`Employee_Id`, `Employee_Number`, `Employee_Type`, `Employee_Name`, `Employee_Status`, `Employee_AddedDate`) VALUES
(4, 5001, 1, 'Ashok Bbhusare', 1, '2017-11-11 04:33:17'),
(5, 3002, 0, 'Bhau Aherkar', 1, '2017-11-11 04:33:46'),
(6, 5158, 1, 'Sham phiske', 1, '2017-11-11 05:31:46'),
(7, 3188, 0, 'Shankar Mule', 1, '2017-11-11 05:32:27');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE IF NOT EXISTS `tickets` (
  `tickets_Id` int(12) NOT NULL AUTO_INCREMENT,
  `tickets_Price` decimal(6,2) NOT NULL,
  `tickets_ExtraPrice` decimal(6,2) NOT NULL,
  `tickets_Type` tinyint(1) NOT NULL DEFAULT '0',
  `tickets_CreatedOn` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `tickets_CreatedBy` int(12) NOT NULL,
  `tickets_Status` varchar(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`tickets_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`tickets_Id`, `tickets_Price`, `tickets_ExtraPrice`, `tickets_Type`, `tickets_CreatedOn`, `tickets_CreatedBy`, `tickets_Status`) VALUES
(1, '3.00', '0.00', 1, '2017-11-11 05:48:57', 1, '1'),
(2, '4.85', '0.15', 0, '2017-11-11 05:49:24', 1, '1'),
(3, '9.85', '0.15', 0, '2017-11-11 05:49:42', 1, '1'),
(4, '6.00', '0.00', 0, '2017-11-11 05:50:08', 1, '1'),
(5, '9.00', '0.00', 0, '2017-11-11 05:50:23', 1, '1'),
(6, '14.00', '0.00', 0, '2017-11-11 05:50:34', 1, '1');

-- --------------------------------------------------------

--
-- Table structure for table `tickets_employee`
--

CREATE TABLE IF NOT EXISTS `tickets_employee` (
  `tickets_employee_Id` int(12) NOT NULL AUTO_INCREMENT,
  `tickets_employee_ticketId` int(12) NOT NULL,
  `tickets_employee_empId` int(12) NOT NULL,
  `tickets_employee_StartSerial` bigint(20) NOT NULL,
  `tickets_employee_Series` bigint(20) NOT NULL,
  `tickets_employee_EndSerial` bigint(20) NOT NULL,
  `tickets_employee_Addedby` int(12) NOT NULL,
  `tickets_employee_CreatedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`tickets_employee_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ticket_register`
--

CREATE TABLE IF NOT EXISTS `ticket_register` (
  `TicketRegister_Id` int(12) NOT NULL AUTO_INCREMENT,
  `TicketRegister_TicketId` int(12) NOT NULL,
  `TicketRegister_Qty` int(12) NOT NULL,
  `TicketRegister_DateTime` datetime NOT NULL,
  `TicketRegister_Status` tinyint(12) NOT NULL,
  `TicketRegister_AddedBy` int(12) NOT NULL,
  PRIMARY KEY (`TicketRegister_Id`),
  KEY `ticket_register_TicketId` (`TicketRegister_TicketId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `ticket_register`
--

INSERT INTO `ticket_register` (`TicketRegister_Id`, `TicketRegister_TicketId`, `TicketRegister_Qty`, `TicketRegister_DateTime`, `TicketRegister_Status`, `TicketRegister_AddedBy`) VALUES
(1, 1, 100, '2017-11-11 11:21:11', 1, 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bus_duty`
--
ALTER TABLE `bus_duty`
  ADD CONSTRAINT `bus_duty_RouteId` FOREIGN KEY (`bus_duty_RouteId`) REFERENCES `bus_routes` (`Bus_Routes_Id`) ON DELETE CASCADE;

--
-- Constraints for table `bus_timing`
--
ALTER TABLE `bus_timing`
  ADD CONSTRAINT `bus_timing_RouteId` FOREIGN KEY (`bus_timing_RouteId`) REFERENCES `bus_routes` (`Bus_Routes_Id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bus_timing_DutyId` FOREIGN KEY (`bus_timing_DutyId`) REFERENCES `bus_duty` (`bus_duty_Id`) ON DELETE CASCADE;

--
-- Constraints for table `cashdeposit_slip`
--
ALTER TABLE `cashdeposit_slip`
  ADD CONSTRAINT `cashDeposit_slip_DriverEmpId` FOREIGN KEY (`cashDeposit_slip_DriverEmpId`) REFERENCES `employees` (`Employee_Id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cashDeposit_slip_ConductorEmpId` FOREIGN KEY (`cashDeposit_slip_ConductorEmpId`) REFERENCES `employees` (`Employee_Id`) ON DELETE CASCADE;

--
-- Constraints for table `conductor_daysslip`
--
ALTER TABLE `conductor_daysslip`
  ADD CONSTRAINT `conductor_daysSlip_DriveEmpId` FOREIGN KEY (`conductor_daysSlip_DriveEmpId`) REFERENCES `employees` (`Employee_Id`) ON DELETE CASCADE,
  ADD CONSTRAINT `conductor_daysSlip_ConductorEmpId` FOREIGN KEY (`conductor_daysSlip_ConductorEmpId`) REFERENCES `employees` (`Employee_Id`) ON DELETE CASCADE;

--
-- Constraints for table `ticket_register`
--
ALTER TABLE `ticket_register`
  ADD CONSTRAINT `ticket_register_TicketId` FOREIGN KEY (`TicketRegister_TicketId`) REFERENCES `tickets` (`tickets_Id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
