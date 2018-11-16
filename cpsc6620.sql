-- MySQL dump 10.13  Distrib 5.7.24, for Linux (x86_64)
--
-- Host: localhost    Database: cpsc6620
-- ------------------------------------------------------
-- Server version	5.7.24-0ubuntu0.16.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `manage_parking`
--

DROP TABLE IF EXISTS `manage_parking`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `manage_parking` (
  `Spot` char(7) NOT NULL,
  `MID` char(4) NOT NULL,
  PRIMARY KEY (`Spot`,`MID`),
  KEY `MID` (`MID`),
  CONSTRAINT `manage_parking_ibfk_1` FOREIGN KEY (`Spot`) REFERENCES `parking_spot` (`spot`),
  CONSTRAINT `manage_parking_ibfk_2` FOREIGN KEY (`MID`) REFERENCES `manager` (`mid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `manage_parking`
--

LOCK TABLES `manage_parking` WRITE;
/*!40000 ALTER TABLE `manage_parking` DISABLE KEYS */;
INSERT INTO `manage_parking` VALUES ('E01_001','M002');
/*!40000 ALTER TABLE `manage_parking` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `manage_record`
--

DROP TABLE IF EXISTS `manage_record`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `manage_record` (
  `MID` char(4) NOT NULL,
  `Rcd_index` varchar(7) NOT NULL,
  PRIMARY KEY (`MID`,`Rcd_index`),
  KEY `Rcd_index` (`Rcd_index`),
  CONSTRAINT `manage_record_ibfk_1` FOREIGN KEY (`MID`) REFERENCES `manager` (`mid`),
  CONSTRAINT `manage_record_ibfk_2` FOREIGN KEY (`Rcd_index`) REFERENCES `parking_record` (`rcd_index`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `manage_record`
--

LOCK TABLES `manage_record` WRITE;
/*!40000 ALTER TABLE `manage_record` DISABLE KEYS */;
INSERT INTO `manage_record` VALUES ('M003','r000003');
/*!40000 ALTER TABLE `manage_record` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `manager`
--

DROP TABLE IF EXISTS `manager`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `manager` (
  `MID` char(4) NOT NULL,
  `Name` varchar(15) DEFAULT NULL,
  `Tel` char(12) DEFAULT NULL,
  `Password` varchar(255) NOT NULL,
  PRIMARY KEY (`MID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `manager`
--

LOCK TABLES `manager` WRITE;
/*!40000 ALTER TABLE `manager` DISABLE KEYS */;
INSERT INTO `manager` VALUES ('M002','Kathy','864-100-1001',''),('M003','Chris','843-100-1001','');
/*!40000 ALTER TABLE `manager` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `own`
--

DROP TABLE IF EXISTS `own`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `own` (
  `OID` char(9) NOT NULL DEFAULT '',
  `Plate` varchar(8) NOT NULL DEFAULT '',
  PRIMARY KEY (`OID`,`Plate`),
  KEY `Plate` (`Plate`),
  CONSTRAINT `own_ibfk_1` FOREIGN KEY (`OID`) REFERENCES `owner` (`oid`),
  CONSTRAINT `own_ibfk_2` FOREIGN KEY (`Plate`) REFERENCES `vehicle` (`plate`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `own`
--

LOCK TABLES `own` WRITE;
/*!40000 ALTER TABLE `own` DISABLE KEYS */;
INSERT INTO `own` VALUES ('C10000001','1AWJ785'),('C12895968','514-KZE'),('C10000002','PYY438'),('C10000000','SAMPLE1');
/*!40000 ALTER TABLE `own` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `owner`
--

DROP TABLE IF EXISTS `owner`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `owner` (
  `OID` char(9) NOT NULL,
  `Name` varchar(15) NOT NULL,
  `Tel` char(12) DEFAULT NULL,
  `Type` varchar(10) DEFAULT NULL,
  `Password` varchar(255) NOT NULL,
  PRIMARY KEY (`OID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `owner`
--

LOCK TABLES `owner` WRITE;
/*!40000 ALTER TABLE `owner` DISABLE KEYS */;
INSERT INTO `owner` VALUES ('C10000000','Jill','864-100-1000','Employee',''),('C10000001','Bob','843-100-1000','Visitor',''),('C10000002','Mike','864-100-1001','Employee',''),('C12895968','Jillian','','',''),('r65544454','mike','','','');
/*!40000 ALTER TABLE `owner` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `park_on`
--

DROP TABLE IF EXISTS `park_on`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `park_on` (
  `Plate` varchar(8) NOT NULL,
  `Spot` char(7) NOT NULL,
  PRIMARY KEY (`Plate`,`Spot`),
  KEY `Spot` (`Spot`),
  CONSTRAINT `park_on_ibfk_1` FOREIGN KEY (`Plate`) REFERENCES `vehicle` (`Plate`),
  CONSTRAINT `park_on_ibfk_2` FOREIGN KEY (`Spot`) REFERENCES `parking_spot` (`Spot`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `park_on`
--

LOCK TABLES `park_on` WRITE;
/*!40000 ALTER TABLE `park_on` DISABLE KEYS */;
INSERT INTO `park_on` VALUES ('SAMPLE1','E01_001'),('514-KZE','S01_001'),('1AWJ785','V01_001'),('PYY438','V01_110');
/*!40000 ALTER TABLE `park_on` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `parking_record`
--

DROP TABLE IF EXISTS `parking_record`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `parking_record` (
  `Rcd_index` varchar(7) NOT NULL,
  `Plate` varchar(8) NOT NULL,
  `Enter_date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Fee` decimal(4,2) NOT NULL,
  `Leave_date_time` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`Rcd_index`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `parking_record`
--

LOCK TABLES `parking_record` WRITE;
/*!40000 ALTER TABLE `parking_record` DISABLE KEYS */;
INSERT INTO `parking_record` VALUES ('r000003','1AWJ785','2018-02-03 10:03:32',1.50,NULL),('r000004','1AWJ785','2018-02-03 10:03:32',2.50,'2018-02-03 13:03:30');
/*!40000 ALTER TABLE `parking_record` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `parking_spot`
--

DROP TABLE IF EXISTS `parking_spot`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `parking_spot` (
  `Spot` char(7) NOT NULL,
  `Lot` varchar(10) NOT NULL,
  `Status` varchar(8) NOT NULL,
  `Rate` decimal(4,2) NOT NULL,
  PRIMARY KEY (`Spot`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `parking_spot`
--

LOCK TABLES `parking_spot` WRITE;
/*!40000 ALTER TABLE `parking_spot` DISABLE KEYS */;
INSERT INTO `parking_spot` VALUES ('E01_001','Employee','vacant',0.00),('S01_001','Student','occupied',0.00),('V01_001','Visitor','occupied',1.50),('V01_110','Visitor','vacant',1.50);
/*!40000 ALTER TABLE `parking_spot` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicle`
--

DROP TABLE IF EXISTS `vehicle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vehicle` (
  `Plate` varchar(8) NOT NULL,
  `Make` varchar(15) DEFAULT NULL,
  `Model` varchar(17) DEFAULT NULL,
  `Year` smallint(6) DEFAULT NULL,
  `Color` varchar(16) NOT NULL,
  PRIMARY KEY (`Plate`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicle`
--

LOCK TABLES `vehicle` WRITE;
/*!40000 ALTER TABLE `vehicle` DISABLE KEYS */;
INSERT INTO `vehicle` VALUES ('1AWJ785','Toyota','Camry',2017,'blue'),('514-KZE','Chevrolet','Tahoe',1997,'red'),('PYY438','Ford','focus',2015,'Grey'),('SAMPLE1','Ford','Explorer',2005,'blue');
/*!40000 ALTER TABLE `vehicle` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-11-15  7:25:07
