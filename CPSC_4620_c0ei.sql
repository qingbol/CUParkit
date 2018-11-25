-- phpMyAdmin SQL Dump
-- version 4.0.10deb1ubuntu0.1
-- http://www.phpmyadmin.net
--
-- Host: mysql1.cs.clemson.edu
-- Generation Time: Nov 22, 2018 at 11:08 AM
-- Server version: 5.5.52-0ubuntu0.12.04.1
-- PHP Version: 5.5.9-1ubuntu4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `CPSC_4620_c0ei`
--

-- --------------------------------------------------------

--
-- Table structure for table `manager`
--

CREATE TABLE IF NOT EXISTS `manager` (
  `MID` char(4) NOT NULL,
  `Name` varchar(15) DEFAULT NULL,
  `Tel` char(12) DEFAULT NULL,
  `Password` varchar(255) NOT NULL,
  PRIMARY KEY (`MID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `manage_parking`
--

CREATE TABLE IF NOT EXISTS `manage_parking` (
  `Spot` char(7) NOT NULL,
  `MID` char(4) NOT NULL,
  PRIMARY KEY (`Spot`,`MID`),
  KEY `MID` (`MID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `manage_record`
--

CREATE TABLE IF NOT EXISTS `manage_record` (
  `MID` char(4) NOT NULL,
  `Rcd_index` varchar(7) NOT NULL,
  PRIMARY KEY (`MID`,`Rcd_index`),
  KEY `Rcd_index` (`Rcd_index`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `own`
--

CREATE TABLE IF NOT EXISTS `own` (
  `OID` char(9) NOT NULL DEFAULT '',
  `Plate` varchar(8) NOT NULL DEFAULT '',
  PRIMARY KEY (`OID`,`Plate`),
  KEY `Plate` (`Plate`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `owner`
--

CREATE TABLE IF NOT EXISTS `owner` (
  `OID` char(9) NOT NULL,
  `Name` varchar(15) NOT NULL,
  `Tel` char(12) DEFAULT NULL,
  `Type` varchar(10) DEFAULT NULL,
  `Password` varchar(255) NOT NULL,
  PRIMARY KEY (`OID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `owner`
--

INSERT INTO `owner` (`OID`, `Name`, `Tel`, `Type`, `Password`) VALUES
('C10000000', 'Jill', '864-100-1000', 'Employee', ''),
('C10000001', 'Bob', '843-100-1000', 'Visitor', ''),
('C10000002', 'Jim', '111-222-3333', 'Visitor', ''),
('C10000003', 'Jim', '111-222-3333', 'Visitor', ''),
('C12895968', 'Jack', '864-244-5230', 'Student', ''),
('C28354923', 'JJJ', '859593453', 'visitor', ''),
('E17239324', 'Tammie', '777-777-7777', 'Employee', ''),
('JT33', 'Jeremiah', '111-111-1111', 'Student', '$2y$10$pRKDVtbbA6M/cm8/xQ2fBOLptA4e2vXHB4fa4wzz91c/DPVMw6QKu'),
('JT34', 'Jeremiah', '111-111-1111', 'Student', '$2y$10$tTsWEEUJ1Sr6x/J6dhiBxOFqz5xIrDkKYb2r4OyHtjCF7sgt/8XIK'),
('S38383838', 'sdfasfn', '859485934573', 'Student', ''),
('sdfjf;alk', 'sdfasf', '899879898', 'Visitor', ''),
('V17239324', 'Tammie', '777-777-7777', 'Visitor', '');

-- --------------------------------------------------------

--
-- Table structure for table `parking_record`
--

CREATE TABLE IF NOT EXISTS `parking_record` (
  `Rcd_index` varchar(7) NOT NULL,
  `Plate` varchar(8) NOT NULL,
  `Enter_date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Leave_date_time` timestamp NULL DEFAULT NULL,
  `Fee` decimal(4,2) NOT NULL,
  PRIMARY KEY (`Rcd_index`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `parking_spot`
--

CREATE TABLE IF NOT EXISTS `parking_spot` (
  `Spot` char(7) NOT NULL,
  `Lot` varchar(10) NOT NULL,
  `Status` varchar(8) NOT NULL,
  `Rate` decimal(4,2) NOT NULL,
  PRIMARY KEY (`Spot`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `parking_spot`
--

INSERT INTO `parking_spot` (`Spot`, `Lot`, `Status`, `Rate`) VALUES
('V01_110', 'Visitor', 'vacant', 1.50);

-- --------------------------------------------------------

--
-- Table structure for table `park_on`
--

CREATE TABLE IF NOT EXISTS `park_on` (
  `Plate` varchar(8) NOT NULL DEFAULT '',
  `Spot` char(7) NOT NULL DEFAULT '',
  PRIMARY KEY (`Plate`,`Spot`),
  KEY `Spot` (`Spot`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
--

CREATE TABLE IF NOT EXISTS `vehicle` (
  `Plate` varchar(8) NOT NULL,
  `Make` varchar(15) DEFAULT NULL,
  `Model` varchar(17) DEFAULT NULL,
  `Year` smallint(6) DEFAULT NULL,
  `Color` varchar(16) NOT NULL,
  PRIMARY KEY (`Plate`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehicle`
--

INSERT INTO `vehicle` (`Plate`, `Make`, `Model`, `Year`, `Color`) VALUES
('PYY438', 'Ford', 'focus', 2015, 'Grey');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `manage_parking`
--
ALTER TABLE `manage_parking`
  ADD CONSTRAINT `manage_parking_ibfk_1` FOREIGN KEY (`Spot`) REFERENCES `parking_spot` (`Spot`),
  ADD CONSTRAINT `manage_parking_ibfk_2` FOREIGN KEY (`MID`) REFERENCES `manager` (`MID`);

--
-- Constraints for table `manage_record`
--
ALTER TABLE `manage_record`
  ADD CONSTRAINT `manage_record_ibfk_1` FOREIGN KEY (`MID`) REFERENCES `manager` (`MID`),
  ADD CONSTRAINT `manage_record_ibfk_2` FOREIGN KEY (`Rcd_index`) REFERENCES `parking_record` (`Rcd_index`);

--
-- Constraints for table `own`
--
ALTER TABLE `own`
  ADD CONSTRAINT `own_ibfk_1` FOREIGN KEY (`OID`) REFERENCES `owner` (`OID`),
  ADD CONSTRAINT `own_ibfk_2` FOREIGN KEY (`Plate`) REFERENCES `vehicle` (`Plate`);

--
-- Constraints for table `park_on`
--
ALTER TABLE `park_on`
  ADD CONSTRAINT `park_on_ibfk_1` FOREIGN KEY (`Plate`) REFERENCES `vehicle` (`Plate`),
  ADD CONSTRAINT `park_on_ibfk_2` FOREIGN KEY (`Spot`) REFERENCES `parking_spot` (`Spot`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
