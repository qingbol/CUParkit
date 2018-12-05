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
  CONSTRAINT `manage_parking_ibfk_1` FOREIGN KEY (`Spot`) REFERENCES `parking_spot` (`Spot`),
  CONSTRAINT `manage_parking_ibfk_2` FOREIGN KEY (`MID`) REFERENCES `manager` (`MID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `manage_parking`
--

LOCK TABLES `manage_parking` WRITE;
/*!40000 ALTER TABLE `manage_parking` DISABLE KEYS */;
INSERT INTO `manage_parking` VALUES ('S01_002','M001'),('E01_001','M002');
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
INSERT INTO `manage_record` VALUES ('M003','r000003'),('M001','r000008');
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
INSERT INTO `manager` VALUES ('admi','admin','000-000-0000','$2y$10$0/ZEP2NknT8NClfJcLJE6OqM.qW/9OHOAhwfL.JCDeNJNk7DhLv3e'),('M001','Richard','864-123-4567','2016'),('M002','Kathy','864-100-1001',''),('M003','Chris','843-100-1001',''),('max','katie','856-324-6824','0000'),('sdld','adsgg','1113','$2y$10$7wdDgZNi6i1o3GQLBEkU9uLuzTNX6TmlUNhkgNSA09.LWbIlwqj/C');
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
INSERT INTO `own` VALUES ('C10000001','1AWJ785'),('C12895968','514-KZE'),('JT30','ABC111'),('C10000002','PYY438'),('C10000000','SAMPLE1');
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
INSERT INTO `owner` VALUES ('abc','dds','876-384-9876','Employee',''),('C10000000','Jill','864-100-1000','Employee',''),('C10000001','Bob','843-100-1000','Visitor',''),('C10000002','Mike','864-100-1001','student',''),('C12895968','Jillian','','',''),('dsgsadg','asdgadsg','adgg','Student','$2y$10$8YuLbVyx08awu/71LfEUbuZ9yEAbtYzbxRLV4HACkLRgTZ3B/LG7C'),('JT30','Jeremiah','111-111-1111','Student','$2y$10$LJ62b60RrtlXzayhaccJFuqaRH9Uq1v6Abx5cKrRqD5dOjij2Q0Qu'),('qingbo6','andrew','980-422-4444','Employee','1234'),('user100','lsdjg','1232r','Employee','$2y$10$pkYjiw4q1gjSPGROZ41PNucKIydEbyop8AhhdqPvdb/xAUhyKwmna'),('user111','jason','','','');
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
INSERT INTO `park_on` VALUES ('SAMPLE1','E01_001'),('514-KZE','S01_001'),('ABC111','S01_002'),('1AWJ785','V01_001'),('PYY438','V01_110');
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
INSERT INTO `parking_record` VALUES ('r000001','1AWJ785','2018-02-25 16:36:51',3.40,'2018-08-11 17:10:04'),('r000002','1AWJ786','2018-07-01 12:30:35',4.00,'2018-06-16 22:52:01'),('r000003','1AWJ787','2018-09-06 05:46:00',6.70,'2018-02-24 01:10:08'),('r000004','1AWJ788','2018-02-23 01:59:52',21.30,'2018-09-29 13:12:50'),('r000005','1AWJ789','2018-09-21 20:12:49',18.40,'2018-05-16 23:29:29'),('r000006','1AWJ790','2018-06-27 13:38:58',11.80,'2018-03-31 13:31:37'),('r000007','1AWJ791','2018-02-06 07:10:55',1.70,'2018-09-23 15:53:45'),('r000008','1AWJ792','2018-01-31 15:13:29',20.40,'2018-08-23 19:42:14'),('r000009','1AWJ793','2018-05-15 00:28:27',16.90,'2018-08-21 18:32:53'),('r000010','1AWJ794','2018-06-18 06:28:15',10.20,'2018-01-12 23:24:18'),('r000011','1AWJ795','2018-08-19 13:34:09',9.60,'2018-10-23 01:48:59'),('r000012','1AWJ796','2018-08-09 23:21:18',26.30,'2018-08-20 01:28:25'),('r000013','1AWJ797','2018-07-03 17:17:14',23.70,'2018-08-27 10:51:58'),('r000014','1AWJ798','2018-01-27 03:37:56',5.60,'2018-04-13 14:53:41'),('r000015','1AWJ799','2018-05-02 20:29:34',5.90,'2018-10-20 22:46:53'),('r000016','1AWJ800','2018-10-08 22:33:48',17.40,'2018-09-27 18:27:10'),('r000017','1AWJ801','2018-05-18 07:09:20',13.70,'2018-04-29 07:56:27'),('r000018','1AWJ802','2018-04-01 14:57:25',11.00,'2018-01-18 09:58:06'),('r000019','1AWJ803','2018-06-27 12:01:05',1.80,'2018-08-03 23:24:17'),('r000020','1AWJ804','2018-06-03 00:03:01',20.70,'2018-06-11 01:50:50'),('r000021','1AWJ805','2018-02-26 18:00:56',4.70,'2018-09-07 16:53:57'),('r000022','1AWJ806','2018-02-28 02:30:54',21.80,'2018-09-26 19:31:48'),('r000023','1AWJ807','2018-01-02 05:43:08',18.40,'2018-04-10 21:26:05'),('r000024','1AWJ808','2018-09-19 17:17:22',9.90,'2018-01-19 12:51:40'),('r000025','1AWJ809','2018-04-28 04:34:56',27.90,'2018-02-02 17:54:58'),('r000026','1AWJ810','2018-09-07 10:07:10',24.70,'2018-07-24 12:29:39'),('r000027','1AWJ811','2018-05-15 04:04:50',13.30,'2018-08-09 02:03:44'),('r000028','1AWJ812','2018-02-16 09:41:14',0.30,'2018-05-30 22:50:28'),('r000029','1AWJ813','2018-05-29 11:29:41',17.00,'2018-01-24 23:04:10'),('r000030','1AWJ814','2018-01-28 01:55:22',22.20,'2018-08-25 19:36:21'),('r000031','1AWJ815','2018-06-24 15:18:20',22.20,'2018-01-21 16:15:44'),('r000032','1AWJ816','2018-06-02 18:41:31',29.60,'2018-04-23 07:32:10'),('r000033','1AWJ817','2018-03-28 23:59:47',7.60,'2018-09-11 16:30:33'),('r000034','1AWJ818','2018-03-04 03:27:00',8.60,'2018-05-08 15:12:55'),('r000035','1AWJ819','2018-07-24 19:19:14',11.80,'2018-09-26 08:53:29'),('r000036','1AWJ820','2018-07-03 01:10:50',13.00,'2018-01-22 13:05:43'),('r000037','1AWJ821','2018-08-20 02:54:58',20.50,'2018-04-09 09:25:12'),('r000038','1AWJ822','2018-10-26 09:08:11',16.10,'2018-03-16 20:01:48'),('r000039','1AWJ823','2018-07-09 17:15:36',6.80,'2018-06-20 12:48:33'),('r000040','1AWJ824','2018-08-30 10:35:47',1.50,'2018-05-28 01:51:42'),('r000041','1AWJ825','2018-05-28 06:45:11',28.80,'2018-04-22 01:44:07'),('r000042','1AWJ826','2018-03-05 10:14:39',28.50,'2018-06-14 13:04:23'),('r000043','1AWJ827','2018-05-22 22:01:03',15.60,'2018-03-12 15:01:16'),('r000044','1AWJ828','2018-04-02 08:14:24',15.70,'2018-09-15 12:36:44'),('r000045','1AWJ829','2018-01-17 20:26:52',5.50,'2018-01-04 21:50:14'),('r000046','1AWJ830','2018-03-08 06:53:27',27.40,'2018-10-19 03:00:22'),('r000047','1AWJ831','2018-01-19 12:56:22',28.40,'2018-03-30 17:08:53'),('r000048','1AWJ832','2018-07-04 14:29:08',25.00,'2018-07-29 09:10:20'),('r000049','1AWJ833','2018-01-05 03:11:46',21.70,'2018-05-20 09:32:40'),('r000050','1AWJ834','2018-06-12 19:37:33',14.90,'2018-01-03 05:00:44'),('r000051','1AWJ835','2018-07-10 10:07:57',28.40,'2018-10-24 06:13:57'),('r000052','1AWJ836','2018-08-07 09:28:58',1.40,'2018-08-26 02:17:37'),('r000053','1AWJ837','2018-09-24 22:37:51',3.60,'2018-06-20 00:20:16'),('r000054','1AWJ838','2018-07-15 12:21:29',17.50,'2018-03-14 12:44:39'),('r000055','1AWJ839','2018-09-13 17:00:32',11.30,'2018-04-25 19:06:56');
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
INSERT INTO `parking_spot` VALUES ('E01_01','Employee','occupied',0.00),('E01_02','Employee','occupied',0.00),('E01_03','Employee','vacant',0.00),('E01_04','Employee','occupied',0.00),('E01_05','Employee','vacant',0.00),('E01_06','Employee','occupied',0.00),('E01_07','Employee','vacant',0.00),('E01_08','Employee','vacant',0.00),('E01_09','Employee','vacant',0.00),('E01_10','Employee','vacant',0.00),('E01_11','Employee','occupied',0.00),('E01_12','Employee','occupied',0.00),('E01_13','Employee','vacant',0.00),('E01_14','Employee','vacant',0.00),('E01_15','Employee','occupied',0.00),('E01_16','Employee','occupied',0.00),('E01_17','Employee','vacant',0.00),('E01_18','Employee','vacant',0.00),('E01_19','Employee','occupied',0.00),('E01_20','Employee','vacant',0.00),('E01_21','Employee','vacant',0.00),('E01_22','Employee','vacant',0.00),('E01_23','Employee','occupied',0.00),('E01_24','Employee','vacant',0.00),('E01_25','Employee','occupied',0.00),('E01_26','Employee','occupied',0.00),('E01_27','Employee','vacant',0.00),('E01_28','Employee','occupied',0.00),('E01_29','Employee','vacant',0.00),('E01_30','Employee','vacant',0.00),('E01_31','Employee','occupied',0.00),('E01_32','Employee','vacant',0.00),('E01_33','Employee','vacant',0.00),('E01_34','Employee','occupied',0.00),('E01_35','Employee','occupied',0.00),('E01_36','Employee','vacant',0.00),('E01_37','Employee','vacant',0.00),('E01_38','Employee','occupied',0.00),('E01_39','Employee','vacant',0.00),('E01_40','Employee','vacant',0.00),('E01_41','Employee','vacant',0.00),('E01_42','Employee','occupied',0.00),('E01_43','Employee','vacant',0.00),('E01_44','Employee','occupied',0.00),('E01_45','Employee','occupied',0.00),('E01_46','Employee','vacant',0.00),('E01_47','Employee','occupied',0.00),('E01_48','Employee','vacant',0.00),('E01_49','Employee','vacant',0.00),('E01_50','Employee','occupied',0.00),('E01_51','Employee','vacant',0.00),('s01_001','Student','occupied',0.00),('s01_002','Student','vacant',0.00),('s01_003','Student','occupied',0.00),('s01_004','Student','vacant',0.00),('s01_005','Student','vacant',0.00),('s01_006','Student','occupied',0.00),('s01_007','Student','vacant',0.00),('s01_008','Student','vacant',0.00),('s01_009','Student','occupied',0.00),('s01_010','Student','vacant',0.00),('s01_011','Student','occupied',0.00),('s01_012','Student','vacant',0.00),('s01_013','Student','vacant',0.00),('s01_014','Student','vacant',0.00),('s01_015','Student','vacant',0.00),('s01_016','Student','occupied',0.00),('s01_017','Student','occupied',0.00),('s01_018','Student','vacant',0.00),('s01_019','Student','vacant',0.00),('s01_020','Student','occupied',0.00),('s01_021','Student','vacant',0.00),('s01_022','Student','occupied',0.00),('s01_023','Student','occupied',0.00),('s01_024','Student','vacant',0.00),('s01_025','Student','occupied',0.00),('s01_026','Student','vacant',0.00),('s01_027','Student','occupied',0.00),('s01_028','Student','vacant',0.00),('s01_029','Student','vacant',0.00),('s01_030','Student','vacant',0.00),('s01_031','Student','vacant',0.00),('s01_032','Student','occupied',0.00),('s01_033','Student','occupied',0.00),('s01_034','Student','vacant',0.00),('s01_035','Student','vacant',0.00),('s01_036','Student','occupied',0.00),('s01_037','Student','vacant',0.00),('s01_038','Student','vacant',0.00),('s01_039','Student','vacant',0.00),('s01_040','Student','occupied',0.00),('s01_041','Student','vacant',0.00),('s01_042','Student','occupied',0.00),('s01_043','Student','occupied',0.00),('s01_044','Student','vacant',0.00),('s01_045','Student','occupied',0.00),('s01_046','Student','vacant',0.00),('s01_047','Student','vacant',0.00),('s01_048','Student','occupied',0.00),('s01_049','Student','vacant',0.00),('V01_01','Visitor','vacant',1.50),('V01_02','Visitor','occupied',1.50),('V01_03','Visitor','occupied',1.50),('V01_04','Visitor','vacant',1.50),('V01_05','Visitor','vacant',1.50),('V01_06','Visitor','vacant',1.50),('V01_07','Visitor','occupied',1.50),('V01_08','Visitor','occupied',1.50),('V01_09','Visitor','vacant',1.50),('V01_10','Visitor','vacant',1.50),('V01_11','Visitor','occupied',1.50),('V01_12','Visitor','vacant',1.50),('V01_13','Visitor','vacant',1.50),('V01_14','Visitor','vacant',1.50),('V01_15','Visitor','vacant',1.50),('V01_16','Visitor','occupied',1.50),('V01_17','Visitor','occupied',1.50),('V01_18','Visitor','vacant',1.50),('V01_19','Visitor','vacant',1.50),('V01_20','Visitor','vacant',1.50),('V01_21','Visitor','occupied',1.50),('V01_22','Visitor','occupied',1.50),('V01_23','Visitor','vacant',1.50),('V01_24','Visitor','vacant',1.50),('V01_25','Visitor','occupied',1.50),('V01_26','Visitor','vacant',1.50),('V01_27','Visitor','occupied',1.50),('V01_28','Visitor','vacant',1.50),('V01_29','Visitor','vacant',1.50),('V01_30','Visitor','vacant',1.50),('V01_31','Visitor','occupied',1.50),('V01_32','Visitor','occupied',1.50),('V01_33','Visitor','vacant',1.50),('V01_34','Visitor','vacant',1.50);
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
INSERT INTO `vehicle` VALUES ('1AWJ785','Toyota','Camry',2017,'blue'),('514-KZE','Chevrolet','Tahoe',1997,'red'),('ABC111','Nissan','versa',2015,'red'),('PYY438','Ford','focus',2015,'Grey'),('SAMPLE1','Ford','Explorer',2005,'blue');
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

-- Dump completed on 2018-12-04 16:03:19
