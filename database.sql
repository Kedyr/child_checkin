-- MySQL dump 10.13  Distrib 5.6.22, for Win64 (x86_64)
--
-- Host: localhost    Database: watoto_children
-- ------------------------------------------------------
-- Server version	5.6.22-log

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
-- Table structure for table `checkinout`
--

DROP TABLE IF EXISTS `checkinout`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `checkinout` (
  `checkInId` int(11) NOT NULL AUTO_INCREMENT,
  `childId` int(11) DEFAULT NULL,
  `handlerId` int(11) DEFAULT NULL,
  `serviceId` int(11) DEFAULT NULL,
  `timeIn` timestamp NULL DEFAULT NULL,
  `checkInNumber` varchar(45) DEFAULT NULL,
  `status` varchar(10) DEFAULT 'incomplete',
  `timeOut` varchar(45) DEFAULT NULL,
  `comments` varchar(145) DEFAULT NULL,
  `siblingCount` int(11) DEFAULT NULL,
  `handlerName` varchar(45) DEFAULT NULL,
  `checkinUnderId` int(11) DEFAULT NULL COMMENT '''the heckinId that the child registered under''',
  PRIMARY KEY (`checkInId`),
  KEY `fk_child_id_checkin_idx` (`childId`),
  KEY `fk_handlerId_checkin_idx` (`handlerId`),
  KEY `fk_ServiceId_checkin_idx` (`serviceId`),
  CONSTRAINT `fk_ServiceId_checkin` FOREIGN KEY (`serviceId`) REFERENCES `services` (`serviceId`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_childid_checkin` FOREIGN KEY (`childId`) REFERENCES `children` (`childId`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_handlerId_checkin` FOREIGN KEY (`handlerId`) REFERENCES `handlers` (`handlerId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `checkinout`
--

LOCK TABLES `checkinout` WRITE;
/*!40000 ALTER TABLE `checkinout` DISABLE KEYS */;
INSERT INTO `checkinout` VALUES (63,1,1,NULL,'2015-04-26 08:27:12','23','OUT',NULL,NULL,0,'',63),(64,6,1,NULL,'2015-04-26 08:27:14','23','OUT',NULL,NULL,0,'',63),(65,1,1,NULL,'2015-04-26 08:30:13','34','OUT',NULL,NULL,0,'',65),(66,6,1,NULL,'2015-04-26 08:30:14','34','OUT',NULL,NULL,0,'',65),(67,1,NULL,NULL,'2015-04-26 08:31:35',NULL,'IN',NULL,NULL,NULL,NULL,NULL),(68,NULL,NULL,NULL,'2015-04-26 08:59:58','0','IN',NULL,NULL,0,'2',68),(69,NULL,NULL,NULL,'2015-04-26 09:00:29','0','IN',NULL,NULL,0,'',69),(70,NULL,NULL,NULL,'2015-04-26 09:01:28','0','IN',NULL,NULL,0,'',70),(71,NULL,NULL,NULL,'2015-04-26 09:01:34','0','IN',NULL,NULL,0,'',71),(72,NULL,NULL,NULL,'2015-04-26 09:02:17','0','IN',NULL,NULL,0,'',72),(73,NULL,NULL,NULL,'2015-04-26 09:03:02','9','OUT',NULL,NULL,4,'',73),(74,NULL,NULL,NULL,'2015-04-26 09:06:09','22','OUT',NULL,NULL,6,'',74),(75,NULL,NULL,NULL,'2015-04-26 09:07:12','67','IN',NULL,NULL,3,'',75),(76,NULL,NULL,NULL,'2015-04-26 09:11:15','12','IN',NULL,NULL,4,'',76),(77,11,NULL,NULL,'2015-04-26 09:43:50',NULL,'IN',NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `checkinout` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `childhandlerrelationship`
--

DROP TABLE IF EXISTS `childhandlerrelationship`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `childhandlerrelationship` (
  `childId` int(11) NOT NULL,
  `handlerId` int(11) NOT NULL,
  `relationShip` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`childId`,`handlerId`),
  KEY `fk_handler_id_relationship_idx` (`handlerId`),
  CONSTRAINT `fk_child_id_relationship` FOREIGN KEY (`childId`) REFERENCES `children` (`childId`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_handler_id_relationship` FOREIGN KEY (`handlerId`) REFERENCES `handlers` (`handlerId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `childhandlerrelationship`
--

LOCK TABLES `childhandlerrelationship` WRITE;
/*!40000 ALTER TABLE `childhandlerrelationship` DISABLE KEYS */;
INSERT INTO `childhandlerrelationship` VALUES (1,1,'Father'),(6,1,'Father'),(11,3,'Sister');
/*!40000 ALTER TABLE `childhandlerrelationship` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `children`
--

DROP TABLE IF EXISTS `children`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `children` (
  `childId` int(11) NOT NULL AUTO_INCREMENT,
  `childName` varchar(245) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `sex` varchar(2) DEFAULT NULL,
  `school` varchar(145) DEFAULT NULL,
  `residence` varchar(45) DEFAULT NULL,
  `phoneNo` varchar(145) DEFAULT NULL,
  `cellNo` varchar(45) DEFAULT NULL,
  `cellLeaderName` varchar(145) DEFAULT NULL,
  `churchMembership` varchar(45) DEFAULT NULL,
  `schoolClass` varchar(45) DEFAULT NULL,
  `churchClass` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`childId`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `children`
--

LOCK TABLES `children` WRITE;
/*!40000 ALTER TABLE `children` DISABLE KEYS */;
INSERT INTO `children` VALUES (1,'Sheila Fiona','0000-00-00','m',NULL,'',NULL,'','','member',NULL,NULL),(2,'SIdney Stone','0000-00-00','m',NULL,'Ntinda',NULL,'CBG272','Susan','member',NULL,NULL),(3,'Kedyr denis','2010-10-10','m',NULL,'Ntinda',NULL,'CBG272','Susan','member',NULL,NULL),(4,'Tony Stark','2010-10-10','m',NULL,'Ntinda',NULL,'CBG272','Susan','member',NULL,NULL),(5,'James Tuskey',NULL,'m',NULL,'',NULL,'','','member',NULL,NULL),(6,'Finigan Joe',NULL,'m',NULL,'',NULL,'','','member',NULL,NULL),(7,'kahinda James',NULL,'m',NULL,'',NULL,'','','member',NULL,NULL),(8,'Francis',NULL,'m',NULL,'Kajanci',NULL,'','','visiting',NULL,NULL),(9,'3333',NULL,'m',NULL,'',NULL,'','','member',NULL,NULL),(10,'44444',NULL,'m',NULL,'',NULL,'','','member',NULL,NULL),(11,'Hulius',NULL,'m','','',NULL,'','','member','','');
/*!40000 ALTER TABLE `children` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `handlers`
--

DROP TABLE IF EXISTS `handlers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `handlers` (
  `handlerId` int(11) NOT NULL AUTO_INCREMENT,
  `handlerName` varchar(145) DEFAULT NULL,
  `residence` varchar(65) DEFAULT NULL,
  `workPlace` varchar(65) DEFAULT NULL,
  `phoneNo` varchar(65) DEFAULT NULL,
  `emailAddress` varchar(45) DEFAULT NULL,
  `cellNo` varchar(45) DEFAULT NULL,
  `cellLeaderName` varchar(145) DEFAULT NULL,
  `cellLeaderContact` varchar(65) DEFAULT NULL,
  `churchMembership` varchar(45) DEFAULT NULL,
  `otherChurch` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`handlerId`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `handlers`
--

LOCK TABLES `handlers` WRITE;
/*!40000 ALTER TABLE `handlers` DISABLE KEYS */;
INSERT INTO `handlers` VALUES (1,'Pentium Four','Town',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2,'555555','','','','',NULL,NULL,NULL,NULL,''),(3,'Jesus','','','','',NULL,NULL,NULL,NULL,'');
/*!40000 ALTER TABLE `handlers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `services` (
  `serviceId` int(11) NOT NULL AUTO_INCREMENT,
  `serviceName` varchar(45) DEFAULT NULL,
  `serviceTime` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`serviceId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `services`
--

LOCK TABLES `services` WRITE;
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
/*!40000 ALTER TABLE `services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `unregisteredcheckinout`
--

DROP TABLE IF EXISTS `unregisteredcheckinout`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `unregisteredcheckinout` (
  `unRegCheckInId` int(11) NOT NULL AUTO_INCREMENT,
  `serviceId` int(11) DEFAULT NULL,
  `timeIn` timestamp NULL DEFAULT NULL,
  `checkInNumber` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `timeOut` timestamp NULL DEFAULT NULL,
  `comments` varchar(145) DEFAULT NULL,
  PRIMARY KEY (`unRegCheckInId`),
  KEY `fk_serviceId_unregisterd_idx` (`serviceId`),
  CONSTRAINT `fk_serviceId_unregisterd` FOREIGN KEY (`serviceId`) REFERENCES `services` (`serviceId`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unregisteredcheckinout`
--

LOCK TABLES `unregisteredcheckinout` WRITE;
/*!40000 ALTER TABLE `unregisteredcheckinout` DISABLE KEYS */;
/*!40000 ALTER TABLE `unregisteredcheckinout` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-04-26 14:03:45
