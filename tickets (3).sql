-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 07, 2017 at 12:49 PM
-- Server version: 5.5.34
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`Admin_Id`, `Admin_Name`, `Admin_Email`, `Admin_CreatedOn`, `Admin_CreatedBy`, `Admin_Status`, `Admin_Uname`, `Admin_Pass`, `Admin_Role`, `Admin_ViewOnly`) VALUES
(1, 'Anurag Singh', 'info@creativewebie.org', '2016-09-04 12:40:24', 1, 1, 'anurag', 'anurag', 1, 0),
(3, 'KDMT', 'info@kdmt.in', '2017-11-07 09:02:53', 1, 1, 'kdmt', 'kdmt', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `bus_routes`
--

CREATE TABLE IF NOT EXISTS `bus_routes` (
  `Bus_Routes_Id` int(12) NOT NULL AUTO_INCREMENT,
  `Bus_Routes_Number` int(12) NOT NULL,
  `Bus_Routes_Source` varchar(250) NOT NULL,
  `Bus_Routes_Destination` varchar(250) NOT NULL,
  `Bus_Routes_Kilometers` decimal(8,3) NOT NULL,
  `Bus_Routes_Status` tinyint(1) NOT NULL DEFAULT '1',
  `Bus_Routes_AddedDateandTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Bus_Routes_CreatedBy` int(12) NOT NULL,
  PRIMARY KEY (`Bus_Routes_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `bus_routes`
--

INSERT INTO `bus_routes` (`Bus_Routes_Id`, `Bus_Routes_Number`, `Bus_Routes_Source`, `Bus_Routes_Destination`, `Bus_Routes_Kilometers`, `Bus_Routes_Status`, `Bus_Routes_AddedDateandTime`, `Bus_Routes_CreatedBy`) VALUES
(1, 11, 'Mumbai', 'Kalyan', '50.000', 1, '2017-11-06 11:47:56', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bus_timing`
--

CREATE TABLE IF NOT EXISTS `bus_timing` (
  `bus_timing_Id` int(12) NOT NULL AUTO_INCREMENT,
  `bus_timing_routeId` int(12) NOT NULL,
  `bus_timing_StartTime` time NOT NULL,
  `bus_timing_DestinationTime` time NOT NULL,
  `bus_timing_CreatedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `bus_timing_AddedBy` int(12) NOT NULL,
  `bus_timing_Status` tinyint(1) NOT NULL,
  PRIMARY KEY (`bus_timing_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `bus_timing`
--

INSERT INTO `bus_timing` (`bus_timing_Id`, `bus_timing_routeId`, `bus_timing_StartTime`, `bus_timing_DestinationTime`, `bus_timing_CreatedOn`, `bus_timing_AddedBy`, `bus_timing_Status`) VALUES
(1, 1, '12:15:13', '13:00:00', '0000-00-00 00:00:00', 0, 1),
(2, 1, '14:00:00', '15:00:00', '0000-00-00 00:00:00', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cashdeposit_slip`
--

CREATE TABLE IF NOT EXISTS `cashdeposit_slip` (
  `cashDeposit_slip_Id` int(12) NOT NULL AUTO_INCREMENT,
  `cashDeposit_slip_Number` bigint(20) NOT NULL,
  `cashDeposit_slip_ConductorEmpId` int(12) NOT NULL,
  `cashDeposit_slip_Date` date NOT NULL,
  `cashDeposit_slip_RouteId` int(12) NOT NULL,
  `cashDeposit_slip_BusNumber` varchar(250) NOT NULL,
  `cashDeposit_slip_DriverEmpId` int(12) NOT NULL,
  PRIMARY KEY (`cashDeposit_slip_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `cashdeposit_slip`
--


-- --------------------------------------------------------

--
-- Table structure for table `cashdeposit_slip_details`
--

CREATE TABLE IF NOT EXISTS `cashdeposit_slip_details` (
  `cashDeposit_slip_details_Id` int(12) NOT NULL AUTO_INCREMENT,
  `cashDeposit_slip_details_TicketId` int(12) NOT NULL,
  `cashDeposit_slip_details_ticketSeries` bigint(20) DEFAULT NULL,
  `cashDeposit_slip_details_TicketStartSerial` bigint(20) DEFAULT NULL,
  `cashDeposit_slip_details_TicketEndSerial` bigint(20) DEFAULT NULL,
  `cashDeposit_slip_details_ActualTicketsSold` int(12) DEFAULT NULL,
  `cashDeposit_slip_details_CalculatedAmount` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`cashDeposit_slip_details_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `cashdeposit_slip_details`
--

INSERT INTO `cashdeposit_slip_details` (`cashDeposit_slip_details_Id`, `cashDeposit_slip_details_TicketId`, `cashDeposit_slip_details_ticketSeries`, `cashDeposit_slip_details_TicketStartSerial`, `cashDeposit_slip_details_TicketEndSerial`, `cashDeposit_slip_details_ActualTicketsSold`, `cashDeposit_slip_details_CalculatedAmount`) VALUES
(1, 1, 1, 2, 5, 4, '20.00');

-- --------------------------------------------------------

--
-- Table structure for table `conductor_daysslip`
--

CREATE TABLE IF NOT EXISTS `conductor_daysslip` (
  `conductor_daysSlip_Id` int(12) NOT NULL AUTO_INCREMENT,
  `conductor_daysSlip_ConductorEmpId` int(12) NOT NULL,
  `conductor_daysSlip_RoutesId` int(12) NOT NULL,
  `conductor_daysSlip_BusNumber` int(12) NOT NULL,
  `conductor_daysSlip_DriveEmpId` int(12) NOT NULL,
  `conductor_daysslip_date` date NOT NULL,
  `conductor_daysSlip_AddedDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `conductor_daysSlip_AddedBy` int(12) NOT NULL,
  PRIMARY KEY (`conductor_daysSlip_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `conductor_daysslip`
--

INSERT INTO `conductor_daysslip` (`conductor_daysSlip_Id`, `conductor_daysSlip_ConductorEmpId`, `conductor_daysSlip_RoutesId`, `conductor_daysSlip_BusNumber`, `conductor_daysSlip_DriveEmpId`, `conductor_daysslip_date`, `conductor_daysSlip_AddedDateTime`, `conductor_daysSlip_AddedBy`) VALUES
(1, 1, 1, 1223, 1, '2017-10-30', '2017-10-30 12:18:43', 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `conductor_daysslip_details`
--


-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE IF NOT EXISTS `employees` (
  `Employee_Id` int(12) NOT NULL AUTO_INCREMENT,
  `Employee_Number` varchar(250) NOT NULL,
  `Employee_Type` tinyint(1) NOT NULL,
  `Employee_Name` varchar(250) NOT NULL,
  `Employee_Status` tinyint(1) NOT NULL,
  `Employee_AddedDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Employee_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`Employee_Id`, `Employee_Number`, `Employee_Type`, `Employee_Name`, `Employee_Status`, `Employee_AddedDate`) VALUES
(1, '2577', 1, 'Anurag', 1, '2017-10-30 12:17:26'),
(3, '525', 0, 'Tester', 1, '2017-11-07 11:30:13');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`tickets_Id`, `tickets_Price`, `tickets_ExtraPrice`, `tickets_Type`, `tickets_CreatedOn`, `tickets_CreatedBy`, `tickets_Status`) VALUES
(1, '4.85', '0.15', 0, '0000-00-00 00:00:00', 0, '1');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tickets_employee`
--

INSERT INTO `tickets_employee` (`tickets_employee_Id`, `tickets_employee_ticketId`, `tickets_employee_empId`, `tickets_employee_StartSerial`, `tickets_employee_Series`, `tickets_employee_EndSerial`, `tickets_employee_Addedby`, `tickets_employee_CreatedOn`) VALUES
(1, 1, 1, 1, 1, 100, 1, '0000-00-00 00:00:00');

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
  PRIMARY KEY (`TicketRegister_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `ticket_register`
--

INSERT INTO `ticket_register` (`TicketRegister_Id`, `TicketRegister_TicketId`, `TicketRegister_Qty`, `TicketRegister_DateTime`, `TicketRegister_Status`, `TicketRegister_AddedBy`) VALUES
(1, 1, 100, '2017-11-06 11:05:20', 1, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
