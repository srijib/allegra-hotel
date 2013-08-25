-- phpMyAdmin SQL Dump
-- version 3.5.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 24, 2013 at 12:22 AM
-- Server version: 5.5.30-log
-- PHP Version: 5.4.14

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `techturbo_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `adjustment`
--

CREATE TABLE IF NOT EXISTS `adjustment` (
  `adjustment_id` int(11) NOT NULL AUTO_INCREMENT,
  `adjustment_type` varchar(45) NOT NULL,
  `adjustment_start` date DEFAULT NULL,
  `adjustment_end` date DEFAULT NULL,
  `adjustment_rate` double NOT NULL,
  `adjustment_priority` int(11) NOT NULL,
  PRIMARY KEY (`adjustment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `customer_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`) VALUES
(8),
(9);

-- --------------------------------------------------------

--
-- Table structure for table `customer_has_meta`
--

CREATE TABLE IF NOT EXISTS `customer_has_meta` (
  `customer_id` int(10) unsigned NOT NULL,
  `meta_id` int(10) unsigned NOT NULL,
  `value` longtext NOT NULL,
  PRIMARY KEY (`customer_id`,`meta_id`),
  KEY `fk_customer_has_meta_meta1_idx` (`meta_id`),
  KEY `fk_customer_has_meta_customer1_idx` (`customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer_has_meta`
--

INSERT INTO `customer_has_meta` (`customer_id`, `meta_id`, `value`) VALUES
(8, 1, 'user1'),
(8, 2, '24c9e15e52afc47c225b757e7bee1f9d'),
(8, 3, 'user1@test.com'),
(8, 4, 'Mr.'),
(8, 5, 'User1'),
(8, 6, 'Tester'),
(8, 7, '10000000'),
(8, 8, 'Aus'),
(8, 9, 'Vic'),
(8, 10, 'Mel'),
(8, 11, '100 King Street'),
(9, 1, 'user2'),
(9, 2, '7e58d63b60197ceb55a1c487989a3720'),
(9, 3, 'user2@test.com'),
(9, 4, 'Mrs.'),
(9, 5, 'User2'),
(9, 6, 'Tester'),
(9, 7, '10000002'),
(9, 8, 'Aus'),
(9, 9, 'Vic'),
(9, 10, 'Mel'),
(9, 11, '100 Queen Street');

-- --------------------------------------------------------

--
-- Table structure for table `customer_use_item`
--

CREATE TABLE IF NOT EXISTS `customer_use_item` (
  `use_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` int(10) unsigned NOT NULL,
  `room_has_item_id` int(10) unsigned DEFAULT NULL,
  `item_id` int(10) unsigned DEFAULT NULL,
  `use_date` datetime NOT NULL,
  `quantity` int(10) unsigned NOT NULL,
  `price` double NOT NULL,
  `refilled` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`use_id`),
  KEY `fk_customer_has_item_item1_idx` (`item_id`),
  KEY `fk_customer_has_item_customer1_idx` (`customer_id`),
  KEY `fk_customer_use_item_room_has_item1_idx` (`room_has_item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `hotel`
--

CREATE TABLE IF NOT EXISTS `hotel` (
  `hotel_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`hotel_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `hotel_has_meta`
--

CREATE TABLE IF NOT EXISTS `hotel_has_meta` (
  `hotel_id` int(10) unsigned NOT NULL,
  `meta_id` int(10) unsigned NOT NULL,
  `value` longtext NOT NULL,
  PRIMARY KEY (`hotel_id`,`meta_id`),
  KEY `fk_hotel_has_meta_meta1_idx` (`meta_id`),
  KEY `fk_hotel_has_meta_hotel1_idx` (`hotel_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE IF NOT EXISTS `item` (
  `item_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `item_has_meta`
--

CREATE TABLE IF NOT EXISTS `item_has_meta` (
  `item_id` int(10) unsigned NOT NULL,
  `meta_id` int(10) unsigned NOT NULL,
  `value` longtext NOT NULL,
  PRIMARY KEY (`item_id`,`meta_id`),
  KEY `fk_item_has_meta_meta1_idx` (`meta_id`),
  KEY `fk_item_has_meta_item1_idx` (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `meta`
--

CREATE TABLE IF NOT EXISTS `meta` (
  `meta_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `meta_key` varchar(45) NOT NULL,
  `meta_label` text NOT NULL,
  `meta_datatype` varchar(45) NOT NULL,
  `meta_system` int(1) NOT NULL DEFAULT '0',
  `meta_required` int(1) NOT NULL DEFAULT '1',
  `meta_default` longtext,
  PRIMARY KEY (`meta_id`),
  UNIQUE KEY `meta_key_UNIQUE` (`meta_key`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `meta`
--

INSERT INTO `meta` (`meta_id`, `meta_key`, `meta_label`, `meta_datatype`, `meta_system`, `meta_required`, `meta_default`) VALUES
(1, 'user_name', 'Username', 'VARCHAR', 1, 1, NULL),
(2, 'cus_passwd', 'Password', 'VARCHAR', 1, 1, NULL),
(3, 'cus_email', 'Email', 'VARCHAR', 1, 1, NULL),
(4, 'cus_title', 'Title', 'VARCHAR', 1, 1, NULL),
(5, 'cus_fname', 'First name', 'VARCHAR', 1, 1, NULL),
(6, 'cus_lname', 'Last name', 'VARCHAR', 1, 1, NULL),
(7, 'cus_phone', 'Phone', 'VARCHAR', 1, 1, NULL),
(8, 'cus_country', 'Country', 'VARCHAR', 1, 1, NULL),
(9, 'cus_state', 'State', 'VARCHAR', 1, 1, NULL),
(10, 'cus_city', 'City', 'VARCHAR', 1, 1, NULL),
(11, 'cus_address', 'Address', 'VARCHAR', 1, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `offering`
--

CREATE TABLE IF NOT EXISTS `offering` (
  `offering_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`offering_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `offering_has_meta`
--

CREATE TABLE IF NOT EXISTS `offering_has_meta` (
  `offering_id` int(10) unsigned NOT NULL,
  `meta_id` int(10) unsigned NOT NULL,
  `value` longtext NOT NULL,
  PRIMARY KEY (`offering_id`,`meta_id`),
  KEY `fk_offering_has_meta_meta1_idx` (`meta_id`),
  KEY `fk_offering_has_meta_offering1_idx` (`offering_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE IF NOT EXISTS `options` (
  `options_id` int(10) unsigned NOT NULL,
  `options_key` varchar(45) NOT NULL,
  `options_value` longtext,
  PRIMARY KEY (`options_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `package`
--

CREATE TABLE IF NOT EXISTS `package` (
  `package_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`package_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `package_has_meta`
--

CREATE TABLE IF NOT EXISTS `package_has_meta` (
  `package_id` int(10) unsigned NOT NULL,
  `meta_id` int(10) unsigned NOT NULL,
  `value` longtext NOT NULL,
  PRIMARY KEY (`package_id`,`meta_id`),
  KEY `fk_package_has_meta_meta1_idx` (`meta_id`),
  KEY `fk_package_has_meta_package1_idx` (`package_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `package_has_offering`
--

CREATE TABLE IF NOT EXISTS `package_has_offering` (
  `package_id` int(10) unsigned NOT NULL,
  `offering_id` int(10) unsigned NOT NULL,
  `quantity` int(10) unsigned NOT NULL,
  PRIMARY KEY (`package_id`,`offering_id`),
  KEY `fk_package_has_offering_offering1_idx` (`offering_id`),
  KEY `fk_package_has_offering_package1_idx` (`package_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE IF NOT EXISTS `payment` (
  `payment_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `reservation_id` int(10) unsigned DEFAULT NULL,
  `use_id` int(10) unsigned DEFAULT NULL,
  `payment_time` datetime NOT NULL,
  `payment_method` varchar(45) NOT NULL,
  `status` varchar(45) NOT NULL,
  PRIMARY KEY (`payment_id`),
  KEY `fk_payment_reservation1_idx` (`reservation_id`),
  KEY `fk_payment_reservation_customer_use_item1_idx` (`use_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE IF NOT EXISTS `reservation` (
  `reservation_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` int(10) unsigned NOT NULL,
  `create_time` datetime NOT NULL,
  `status` varchar(45) NOT NULL,
  `review` text,
  PRIMARY KEY (`reservation_id`),
  KEY `fk_reservation_customer1_idx` (`customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `reservation_has_package`
--

CREATE TABLE IF NOT EXISTS `reservation_has_package` (
  `reservation_id` int(10) unsigned NOT NULL,
  `package_id` int(10) unsigned NOT NULL,
  `quantity` int(10) unsigned NOT NULL DEFAULT '1',
  `price` double unsigned NOT NULL,
  PRIMARY KEY (`reservation_id`,`package_id`),
  KEY `fk_reservation_has_package_package1_idx` (`package_id`),
  KEY `fk_reservation_has_package_reservation1_idx` (`reservation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `reservation_has_room`
--

CREATE TABLE IF NOT EXISTS `reservation_has_room` (
  `reservation_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `room_id` int(10) unsigned NOT NULL,
  `reserve_date` date NOT NULL,
  `price` double unsigned NOT NULL,
  PRIMARY KEY (`reservation_id`,`room_id`,`reserve_date`),
  KEY `fk_reservation_has_room_reservation1_idx` (`reservation_id`),
  KEY `fk_reservation_has_roomtype_room1_idx` (`room_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE IF NOT EXISTS `room` (
  `room_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `hotel_id` int(10) unsigned NOT NULL,
  `roomtype_id` int(10) unsigned NOT NULL,
  `room_number` varchar(45) NOT NULL,
  PRIMARY KEY (`room_id`),
  KEY `fk_room_roomtype1_idx` (`roomtype_id`),
  KEY `fk_room_hotel1_idx` (`hotel_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `roomtype`
--

CREATE TABLE IF NOT EXISTS `roomtype` (
  `roomtype_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`roomtype_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `room_has_item`
--

CREATE TABLE IF NOT EXISTS `room_has_item` (
  `room_has_item_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `room_id` int(10) unsigned NOT NULL,
  `item_id` int(10) unsigned NOT NULL,
  `quatity` int(11) NOT NULL,
  PRIMARY KEY (`room_has_item_id`),
  KEY `fk_room_has_item_item1_idx` (`item_id`),
  KEY `fk_room_has_item_room1_idx` (`room_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `room_has_meta`
--

CREATE TABLE IF NOT EXISTS `room_has_meta` (
  `roomtype_id` int(10) unsigned NOT NULL,
  `meta_id` int(10) unsigned NOT NULL,
  `value` longtext NOT NULL,
  PRIMARY KEY (`roomtype_id`,`meta_id`),
  KEY `fk_meta_has_room_room1_idx` (`roomtype_id`),
  KEY `fk_meta_has_room_meta_idx` (`meta_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer_has_meta`
--
ALTER TABLE `customer_has_meta`
  ADD CONSTRAINT `fk_customer_has_meta_customer1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_customer_has_meta_meta1` FOREIGN KEY (`meta_id`) REFERENCES `meta` (`meta_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `customer_use_item`
--
ALTER TABLE `customer_use_item`
  ADD CONSTRAINT `fk_customer_has_item_customer1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_customer_has_item_item1` FOREIGN KEY (`item_id`) REFERENCES `item` (`item_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_customer_use_item_room_has_item1` FOREIGN KEY (`room_has_item_id`) REFERENCES `room_has_item` (`room_has_item_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `hotel_has_meta`
--
ALTER TABLE `hotel_has_meta`
  ADD CONSTRAINT `fk_hotel_has_meta_hotel1` FOREIGN KEY (`hotel_id`) REFERENCES `hotel` (`hotel_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_hotel_has_meta_meta1` FOREIGN KEY (`meta_id`) REFERENCES `meta` (`meta_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `item_has_meta`
--
ALTER TABLE `item_has_meta`
  ADD CONSTRAINT `fk_item_has_meta_item1` FOREIGN KEY (`item_id`) REFERENCES `item` (`item_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_item_has_meta_meta1` FOREIGN KEY (`meta_id`) REFERENCES `meta` (`meta_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `offering_has_meta`
--
ALTER TABLE `offering_has_meta`
  ADD CONSTRAINT `fk_offering_has_meta_offering1` FOREIGN KEY (`offering_id`) REFERENCES `offering` (`offering_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_offering_has_meta_meta1` FOREIGN KEY (`meta_id`) REFERENCES `meta` (`meta_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `package_has_meta`
--
ALTER TABLE `package_has_meta`
  ADD CONSTRAINT `fk_package_has_meta_package1` FOREIGN KEY (`package_id`) REFERENCES `package` (`package_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_package_has_meta_meta1` FOREIGN KEY (`meta_id`) REFERENCES `meta` (`meta_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `package_has_offering`
--
ALTER TABLE `package_has_offering`
  ADD CONSTRAINT `fk_package_has_offering_package1` FOREIGN KEY (`package_id`) REFERENCES `package` (`package_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_package_has_offering_offering1` FOREIGN KEY (`offering_id`) REFERENCES `offering` (`offering_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `fk_payment_reservation1` FOREIGN KEY (`reservation_id`) REFERENCES `reservation` (`reservation_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_payment_reservation_customer_use_item1` FOREIGN KEY (`use_id`) REFERENCES `customer_use_item` (`use_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `fk_reservation_customer1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `reservation_has_package`
--
ALTER TABLE `reservation_has_package`
  ADD CONSTRAINT `fk_reservation_has_package_reservation1` FOREIGN KEY (`reservation_id`) REFERENCES `reservation` (`reservation_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_reservation_has_package_package1` FOREIGN KEY (`package_id`) REFERENCES `package` (`package_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `reservation_has_room`
--
ALTER TABLE `reservation_has_room`
  ADD CONSTRAINT `fk_reservation_has_room_reservation1` FOREIGN KEY (`reservation_id`) REFERENCES `reservation` (`reservation_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_reservation_has_roomtype_room1` FOREIGN KEY (`room_id`) REFERENCES `room` (`room_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `fk_room_roomtype1` FOREIGN KEY (`roomtype_id`) REFERENCES `roomtype` (`roomtype_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_room_hotel1` FOREIGN KEY (`hotel_id`) REFERENCES `hotel` (`hotel_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `room_has_item`
--
ALTER TABLE `room_has_item`
  ADD CONSTRAINT `fk_room_has_item_room1` FOREIGN KEY (`room_id`) REFERENCES `room` (`room_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_room_has_item_item1` FOREIGN KEY (`item_id`) REFERENCES `item` (`item_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `room_has_meta`
--
ALTER TABLE `room_has_meta`
  ADD CONSTRAINT `fk_meta_has_room_meta` FOREIGN KEY (`meta_id`) REFERENCES `meta` (`meta_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_meta_has_room_room1` FOREIGN KEY (`roomtype_id`) REFERENCES `roomtype` (`roomtype_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
