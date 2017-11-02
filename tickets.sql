-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 02, 2017 at 01:51 PM
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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
