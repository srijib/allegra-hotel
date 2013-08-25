-- MySQL dump 10.13  Distrib 5.5.30, for Linux (x86_64)
--
-- Host: localhost    Database: techturbo_database
-- ------------------------------------------------------
-- Server version	5.5.30-log

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
-- Table structure for table `ADJUSTMENT`
--

DROP TABLE IF EXISTS `ADJUSTMENT`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ADJUSTMENT` (
  `ADJUSTMENT_id` int(11) NOT NULL AUTO_INCREMENT,
  `ADJUSTMENT_type` varchar(45) NOT NULL,
  `ADJUSTMENT_start` date DEFAULT NULL,
  `ADJUSTMENT_end` date DEFAULT NULL,
  `ADJUSTMENT_rate` double NOT NULL,
  `ADJUSTMENT_priority` int(11) NOT NULL,
  PRIMARY KEY (`ADJUSTMENT_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `CUSTOMER`
--

DROP TABLE IF EXISTS `CUSTOMER`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CUSTOMER` (
  `CUSTOMER_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`CUSTOMER_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `CUSTOMER_has_META`
--

DROP TABLE IF EXISTS `CUSTOMER_has_META`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CUSTOMER_has_META` (
  `CUSTOMER_id` int(11) NOT NULL,
  `META_id` int(11) NOT NULL,
  `value` longtext NOT NULL,
  PRIMARY KEY (`CUSTOMER_id`,`META_id`),
  KEY `fk_CUSTOMER_has_META_META1_idx` (`META_id`),
  KEY `fk_CUSTOMER_has_META_CUSTOMER1_idx` (`CUSTOMER_id`),
  CONSTRAINT `fk_CUSTOMER_has_META_CUSTOMER1` FOREIGN KEY (`CUSTOMER_id`) REFERENCES `CUSTOMER` (`CUSTOMER_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_CUSTOMER_has_META_META1` FOREIGN KEY (`META_id`) REFERENCES `META` (`META_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `CUSTOMER_use_ITEM`
--

DROP TABLE IF EXISTS `CUSTOMER_use_ITEM`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CUSTOMER_use_ITEM` (
  `USE_id` int(11) NOT NULL AUTO_INCREMENT,
  `CUSTOMER_id` int(11) NOT NULL,
  `ROOM_has_ITEM_id` int(11) DEFAULT NULL,
  `ITEM_id` int(11) DEFAULT NULL,
  `use_date` datetime NOT NULL,
  `quatity` int(11) NOT NULL,
  `price` double NOT NULL,
  PRIMARY KEY (`USE_id`),
  KEY `fk_CUSTOMER_has_ITEM_ITEM1_idx` (`ITEM_id`),
  KEY `fk_CUSTOMER_has_ITEM_CUSTOMER1_idx` (`CUSTOMER_id`),
  KEY `fk_CUSTOMER_use_ITEM_ROOM_has_ITEM1_idx` (`ROOM_has_ITEM_id`),
  CONSTRAINT `fk_CUSTOMER_has_ITEM_CUSTOMER1` FOREIGN KEY (`CUSTOMER_id`) REFERENCES `CUSTOMER` (`CUSTOMER_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_CUSTOMER_has_ITEM_ITEM1` FOREIGN KEY (`ITEM_id`) REFERENCES `ITEM` (`ITEM_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_CUSTOMER_use_ITEM_ROOM_has_ITEM1` FOREIGN KEY (`ROOM_has_ITEM_id`) REFERENCES `ROOM_has_ITEM` (`ROOM_has_ITEM_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `HOTEL`
--

DROP TABLE IF EXISTS `HOTEL`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `HOTEL` (
  `HOTEL_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`HOTEL_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `HOTEL_has_META`
--

DROP TABLE IF EXISTS `HOTEL_has_META`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `HOTEL_has_META` (
  `HOTEL_id` int(11) NOT NULL,
  `META_id` int(11) NOT NULL,
  `value` longtext NOT NULL,
  PRIMARY KEY (`HOTEL_id`,`META_id`),
  KEY `fk_HOTEL_has_META_META1_idx` (`META_id`),
  KEY `fk_HOTEL_has_META_HOTEL1_idx` (`HOTEL_id`),
  CONSTRAINT `fk_HOTEL_has_META_HOTEL1` FOREIGN KEY (`HOTEL_id`) REFERENCES `HOTEL` (`HOTEL_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_HOTEL_has_META_META1` FOREIGN KEY (`META_id`) REFERENCES `META` (`META_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ITEM`
--

DROP TABLE IF EXISTS `ITEM`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ITEM` (
  `ITEM_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`ITEM_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ITEM_has_META`
--

DROP TABLE IF EXISTS `ITEM_has_META`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ITEM_has_META` (
  `ITEM_id` int(11) NOT NULL,
  `META_id` int(11) NOT NULL,
  `value` longtext NOT NULL,
  PRIMARY KEY (`ITEM_id`,`META_id`),
  KEY `fk_ITEM_has_META_META1_idx` (`META_id`),
  KEY `fk_ITEM_has_META_ITEM1_idx` (`ITEM_id`),
  CONSTRAINT `fk_ITEM_has_META_ITEM1` FOREIGN KEY (`ITEM_id`) REFERENCES `ITEM` (`ITEM_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_ITEM_has_META_META1` FOREIGN KEY (`META_id`) REFERENCES `META` (`META_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `META`
--

DROP TABLE IF EXISTS `META`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `META` (
  `META_id` int(11) NOT NULL AUTO_INCREMENT,
  `META_key` varchar(45) NOT NULL,
  `META_label` text NOT NULL,
  `META_datatype` varchar(45) NOT NULL,
  `META_system` int(1) NOT NULL DEFAULT '0',
  `META_required` int(1) NOT NULL DEFAULT '1',
  `META_default` longtext,
  PRIMARY KEY (`META_id`),
  UNIQUE KEY `META_key_UNIQUE` (`META_key`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `OFFERING`
--

DROP TABLE IF EXISTS `OFFERING`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `OFFERING` (
  `OFFERING_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`OFFERING_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `OFFERING_has_META`
--

DROP TABLE IF EXISTS `OFFERING_has_META`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `OFFERING_has_META` (
  `OFFERING_id` int(11) NOT NULL,
  `META_id` int(11) NOT NULL,
  `value` longtext NOT NULL,
  PRIMARY KEY (`OFFERING_id`,`META_id`),
  KEY `fk_OFFERING_has_META_META1_idx` (`META_id`),
  KEY `fk_OFFERING_has_META_OFFERING1_idx` (`OFFERING_id`),
  CONSTRAINT `fk_OFFERING_has_META_OFFERING1` FOREIGN KEY (`OFFERING_id`) REFERENCES `OFFERING` (`OFFERING_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_OFFERING_has_META_META1` FOREIGN KEY (`META_id`) REFERENCES `META` (`META_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `PACKAGE`
--

DROP TABLE IF EXISTS `PACKAGE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PACKAGE` (
  `PACKAGE_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`PACKAGE_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `PACKAGE_has_META`
--

DROP TABLE IF EXISTS `PACKAGE_has_META`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PACKAGE_has_META` (
  `PACKAGE_id` int(11) NOT NULL,
  `META_id` int(11) NOT NULL,
  `value` longtext NOT NULL,
  PRIMARY KEY (`PACKAGE_id`,`META_id`),
  KEY `fk_PACKAGE_has_META_META1_idx` (`META_id`),
  KEY `fk_PACKAGE_has_META_PACKAGE1_idx` (`PACKAGE_id`),
  CONSTRAINT `fk_PACKAGE_has_META_PACKAGE1` FOREIGN KEY (`PACKAGE_id`) REFERENCES `PACKAGE` (`PACKAGE_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_PACKAGE_has_META_META1` FOREIGN KEY (`META_id`) REFERENCES `META` (`META_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `PACKAGE_has_OFFERING`
--

DROP TABLE IF EXISTS `PACKAGE_has_OFFERING`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PACKAGE_has_OFFERING` (
  `PACKAGE_id` int(11) NOT NULL,
  `OFFERING_id` int(11) NOT NULL,
  `quatity` int(11) NOT NULL,
  PRIMARY KEY (`PACKAGE_id`,`OFFERING_id`),
  KEY `fk_PACKAGE_has_OFFERING_OFFERING1_idx` (`OFFERING_id`),
  KEY `fk_PACKAGE_has_OFFERING_PACKAGE1_idx` (`PACKAGE_id`),
  CONSTRAINT `fk_PACKAGE_has_OFFERING_PACKAGE1` FOREIGN KEY (`PACKAGE_id`) REFERENCES `PACKAGE` (`PACKAGE_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_PACKAGE_has_OFFERING_OFFERING1` FOREIGN KEY (`OFFERING_id`) REFERENCES `OFFERING` (`OFFERING_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `PAYMENT`
--

DROP TABLE IF EXISTS `PAYMENT`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PAYMENT` (
  `PAYMENT_id` int(11) NOT NULL AUTO_INCREMENT,
  `RESERVATION_id` int(11) DEFAULT NULL,
  `USE_id` int(11) DEFAULT NULL,
  `payment_time` datetime NOT NULL,
  `payment_method` varchar(45) NOT NULL,
  `status` varchar(45) NOT NULL,
  PRIMARY KEY (`PAYMENT_id`),
  KEY `fk_PAYMENT_RESERVATION1_idx` (`RESERVATION_id`),
  KEY `fk_PAYMENT_RESERVATION_CUSTOMER_use_ITEM1_idx` (`USE_id`),
  CONSTRAINT `fk_PAYMENT_RESERVATION1` FOREIGN KEY (`RESERVATION_id`) REFERENCES `RESERVATION` (`RESERVATION_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_PAYMENT_RESERVATION_CUSTOMER_use_ITEM1` FOREIGN KEY (`USE_id`) REFERENCES `CUSTOMER_use_ITEM` (`USE_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `RESERVATION`
--

DROP TABLE IF EXISTS `RESERVATION`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `RESERVATION` (
  `RESERVATION_id` int(11) NOT NULL AUTO_INCREMENT,
  `CUSTOMER_id` int(11) NOT NULL,
  `create_time` datetime NOT NULL,
  `status` varchar(45) NOT NULL,
  `review` text,
  PRIMARY KEY (`RESERVATION_id`),
  KEY `fk_RESERVATION_CUSTOMER1_idx` (`CUSTOMER_id`),
  CONSTRAINT `fk_RESERVATION_CUSTOMER1` FOREIGN KEY (`CUSTOMER_id`) REFERENCES `CUSTOMER` (`CUSTOMER_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `RESERVATION_has_PACKAGE`
--

DROP TABLE IF EXISTS `RESERVATION_has_PACKAGE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `RESERVATION_has_PACKAGE` (
  `RESERVATION_id` int(11) NOT NULL,
  `PACKAGE_id` int(11) NOT NULL,
  `quatity` int(11) NOT NULL DEFAULT '1',
  `price` double NOT NULL,
  PRIMARY KEY (`RESERVATION_id`,`PACKAGE_id`),
  KEY `fk_RESERVATION_has_PACKAGE_PACKAGE1_idx` (`PACKAGE_id`),
  KEY `fk_RESERVATION_has_PACKAGE_RESERVATION1_idx` (`RESERVATION_id`),
  CONSTRAINT `fk_RESERVATION_has_PACKAGE_RESERVATION1` FOREIGN KEY (`RESERVATION_id`) REFERENCES `RESERVATION` (`RESERVATION_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_RESERVATION_has_PACKAGE_PACKAGE1` FOREIGN KEY (`PACKAGE_id`) REFERENCES `PACKAGE` (`PACKAGE_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `RESERVATION_has_ROOM`
--

DROP TABLE IF EXISTS `RESERVATION_has_ROOM`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `RESERVATION_has_ROOM` (
  `RESERVATION_id` int(11) NOT NULL AUTO_INCREMENT,
  `ROOM_id` int(11) NOT NULL,
  `reserve_date` date NOT NULL,
  `price` double NOT NULL,
  PRIMARY KEY (`RESERVATION_id`,`ROOM_id`,`reserve_date`),
  KEY `fk_RESERVATION_has_ROOM_RESERVATION1_idx` (`RESERVATION_id`),
  KEY `fk_RESERVATION_has_ROOMTYPE_ROOM1_idx` (`ROOM_id`),
  CONSTRAINT `fk_RESERVATION_has_ROOM_RESERVATION1` FOREIGN KEY (`RESERVATION_id`) REFERENCES `RESERVATION` (`RESERVATION_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_RESERVATION_has_ROOMTYPE_ROOM1` FOREIGN KEY (`ROOM_id`) REFERENCES `ROOM` (`ROOM_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ROOM`
--

DROP TABLE IF EXISTS `ROOM`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ROOM` (
  `ROOM_id` int(11) NOT NULL AUTO_INCREMENT,
  `HOTEL_id` int(11) NOT NULL,
  `ROOMTYPE_id` int(11) NOT NULL,
  `ROOM_number` varchar(45) NOT NULL,
  PRIMARY KEY (`ROOM_id`),
  KEY `fk_ROOM_ROOMTYPE1_idx` (`ROOMTYPE_id`),
  KEY `fk_ROOM_HOTEL1_idx` (`HOTEL_id`),
  CONSTRAINT `fk_ROOM_ROOMTYPE1` FOREIGN KEY (`ROOMTYPE_id`) REFERENCES `ROOMTYPE` (`ROOMTYPE_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_ROOM_HOTEL1` FOREIGN KEY (`HOTEL_id`) REFERENCES `HOTEL` (`HOTEL_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ROOMTYPE`
--

DROP TABLE IF EXISTS `ROOMTYPE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ROOMTYPE` (
  `ROOMTYPE_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`ROOMTYPE_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ROOM_has_ITEM`
--

DROP TABLE IF EXISTS `ROOM_has_ITEM`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ROOM_has_ITEM` (
  `ROOM_has_ITEM_id` int(11) NOT NULL AUTO_INCREMENT,
  `ROOM_id` int(11) NOT NULL,
  `ITEM_id` int(11) NOT NULL,
  `quatity` int(11) NOT NULL,
  PRIMARY KEY (`ROOM_has_ITEM_id`),
  KEY `fk_ROOM_has_ITEM_ITEM1_idx` (`ITEM_id`),
  KEY `fk_ROOM_has_ITEM_ROOM1_idx` (`ROOM_id`),
  CONSTRAINT `fk_ROOM_has_ITEM_ROOM1` FOREIGN KEY (`ROOM_id`) REFERENCES `ROOM` (`ROOM_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_ROOM_has_ITEM_ITEM1` FOREIGN KEY (`ITEM_id`) REFERENCES `ITEM` (`ITEM_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ROOM_has_META`
--

DROP TABLE IF EXISTS `ROOM_has_META`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ROOM_has_META` (
  `ROOMTYPE_id` int(11) NOT NULL,
  `META_id` int(11) NOT NULL,
  `value` longtext NOT NULL,
  PRIMARY KEY (`ROOMTYPE_id`,`META_id`),
  KEY `fk_META_has_ROOM_ROOM1_idx` (`ROOMTYPE_id`),
  KEY `fk_META_has_ROOM_META_idx` (`META_id`),
  CONSTRAINT `fk_META_has_ROOM_META` FOREIGN KEY (`META_id`) REFERENCES `META` (`META_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_META_has_ROOM_ROOM1` FOREIGN KEY (`ROOMTYPE_id`) REFERENCES `ROOMTYPE` (`ROOMTYPE_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-04-01  0:55:19
