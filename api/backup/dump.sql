-- MySQL dump 10.13  Distrib 5.7.24, for Linux (x86_64)
--
-- Host: mysql1.cs.clemson.edu    Database: parkit
-- ------------------------------------------------------
-- Server version	5.5.52-0ubuntu0.12.04.1

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
  CONSTRAINT `manage_parking_ibfk_1` FOREIGN KEY (`Spot`) REFERENCES `parking_spot` (`Spot`),
  CONSTRAINT `manage_parking_ibfk_2` FOREIGN KEY (`MID`) REFERENCES `manager` (`MID`)
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
  CONSTRAINT `manage_record_ibfk_1` FOREIGN KEY (`MID`) REFERENCES `manager` (`MID`),
  CONSTRAINT `manage_record_ibfk_2` FOREIGN KEY (`Rcd_index`) REFERENCES `parking_record` (`Rcd_index`)
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
INSERT INTO `manager` VALUES ('admi','admin_1','111-111-1111','$2y$10$btyNgaSaw1x8EOTzZAlLqeE20tUEbVbvV14x8vJrhanU6PNDc18vu'),('m001','admin1','111-111-1111','$2y$10$Ic7LtZrR45NJfXF5/ocqNepjnDMmrRdZ9KuvL0hjXGAjEsZ19ikh.'),('M002','Kathy','864-100-1001',''),('M003','Chris','843-100-1001',''),('M004','dgg','222-444-5555','$2y$10$aPv2Dlvts0K/GoZ4OZoE9.sbIRurRgcyksOo10L0cXEWDTn0hsiXi'),('M005','gfghh','222-444-5555','$2y$10$F.JX/aoPx4dG5pksM0mJIupYgnRsjuOnFoPOwP.EEPIv0mmzbKzoS'),('M007','sddg','222-333-2222','$2y$10$LrFYa3/2IrreTlFazIDvs.9WQKXrqB6RjuPXoiELHt5o6bQBHw7/6'),('M008','llhh','111-111-1111','$2y$10$13FGVYGc/R3Mrc9a/5.NTuk0GkvOx5kL7iR2I9FhRCZmhrRJzpK7S'),('M012','hed','444-444-4444','$2y$10$hdIROssMACZ01z8uzIwjfuXaxcuQBrroF20RIAiFsRFkIDV7KVAO6');
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
  CONSTRAINT `own_ibfk_1` FOREIGN KEY (`OID`) REFERENCES `owner` (`OID`),
  CONSTRAINT `own_ibfk_2` FOREIGN KEY (`Plate`) REFERENCES `vehicle` (`Plate`)
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
INSERT INTO `owner` VALUES ('A100001','dgh','121-111-1111','Visitor','$2y$10$3r.hwW3v43sc7X/DgINP/.sYsA07VR89.WECjsRXE2URkJI9vU0sa'),('Ad10008','sfgd','111-111-1111','Student','$2y$10$gvA.uLOREpHRb.4sUo680uml3sds/9qvvY4PJBQBP4Xgmkzk4mHnW'),('C10000000','Jill','864-100-1000','Employee',''),('C10000001','Bob','843-100-1000','Visitor',''),('C10000002','Mike','864-100-1001','Employee',''),('C10000003','Julia','864-345-5345','Student','0000'),('C10000005','Sansha','122-344-5555','Student','$2y$10$8Nz/UvJx9MoBKMY1ZecJfulFFtJ3B9s2tEICQwe8DZTH79MeCw2JG'),('C10000007','Snow','222-444-2222','Employee','$2y$10$4jdmh4alk5riWcON1GzHe.bGtn7PVhb4pFQHD1X5azXAWwTvo4N7W'),('C10000011','hhh','111-111-1111','Visitor','$2y$10$othN4O1AyhH8VplpLs1WueJDvSWCi9LjB4TWVCGtlHN1Bx/kejCCO'),('C1000004','Stark','122-332-3333','Visitor','$2y$10$UQ6idx9UggQO7OXyy/xE0O0jaqnJ0G4pwE/kpf9fnyKOVCLg3adw.'),('C1000008','Cersie','566-224-5544','Student','$2y$10$/k.azyAKaZsHk1NCl1Rm4uAEPHwnpgnio8dFCE9BBV0fG9s41yCbO'),('C12','dfdf','111-111-1111','Student','$2y$10$CMkOrsrYv8v.ZI5ykXqjLu5lXTE6gf56W3umlA5ShrVxgN.s0/ZM2'),('C12895968','Jillian','','',''),('C20000001','ddgg','111-111-1111','Visitor','$2y$10$.YaS.t3XyUC.aoVbmkE8E.cO1KpFi75NuSoCjAHn979PukhoookXK'),('D1000001','sdgg','111-111-1111','Visitor','$2y$10$4UglTC85OTihBm27pPSbW.iAWT.wmSnbYafPJj6.aJSIFh8RNOS9y'),('qingbo8','qingbo','111-111-1111','Student','$2y$10$MWyf/7o8vFaoAc4.ip7W4ehGvaPx/ITVopR93V0xSqUa9wuj94nTy'),('r65544454','mike','','',''),('S001112','dsfdf','111-1','Student','$2y$10$1x2S1eYa3NS5GEBRuuBbGO3mShuARlqtiD7kJqiGawlkVvqxaxPrC'),('S1000001','sdg','111-111-1111','Student','$2y$10$m/Ce5BNT6Q.9OKqFYnUYEOz1YJxu4AePDLVS8ubEyetr4PN9GVL1G'),('test1','test_1','111-111-1111','Visitor','$2y$10$Id8higiHpFjc/1MC0dhX3uqtzyR9CSxy/HIdV0mAatFbc1LWf8dk2'),('V10000001','gdgas','111-111-1111','Employee','$2y$10$yh7/cCe1tU66Lv3tR7n/yOgdcrgaGp2cM.qpF8beS2W5jvlsZRFDG'),('X10000002','kdg','111-111-1111','Student','$2y$10$RjTnKX3.hysLMsX9KgOoh.n6Qz3mo2AHjAqvvbgJwqD5spfUKA9Y.'),('X1000006','sffd','111-111-1111','Student','$2y$10$9WA.2RYHkg00yqDtwh9jFeJ0WZpi0/vSNuuioxaLJyPHYJO41X3Sa');
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

-- Dump completed on 2018-11-29 15:43:46
