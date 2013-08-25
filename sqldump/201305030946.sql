-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 03, 2013 at 01:45 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

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
  `adjustment_type` varchar(45) DEFAULT NULL,
  `adjustment_start` date DEFAULT NULL,
  `adjustment_end` date DEFAULT NULL,
  `adjustment_rate` double NOT NULL,
  `adjustment_priority` int(11) NOT NULL,
  PRIMARY KEY (`adjustment_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `adjustment`
--

INSERT INTO `adjustment` (`adjustment_id`, `adjustment_type`, `adjustment_start`, `adjustment_end`, `adjustment_rate`, `adjustment_priority`) VALUES
(1, 'default', NULL, NULL, 1, 10),
(2, 'Monday', NULL, NULL, 0.9, 20),
(3, 'Tuesday', NULL, NULL, 0.95, 20),
(4, 'Wednesday', NULL, NULL, 0.94, 20),
(5, 'January', NULL, NULL, 1.12, 20),
(6, 'May', NULL, NULL, 1.15, 20),
(7, 'Special', '2013-12-23', '2014-01-02', 1.6, 30),
(8, 'Special', '2013-03-28', '2013-04-02', 1.4, 30);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `customer_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`) VALUES
(9),
(10),
(11),
(12);

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
(9, 11, '100 Queen Street'),
(10, 1, 'user3'),
(10, 2, '92877af70a45fd6a2ed7fe81e1236b78'),
(10, 3, 'alice@exmaple.com'),
(10, 4, 'Miss'),
(10, 5, 'Alice'),
(10, 6, 'Kim'),
(10, 7, '101010101'),
(10, 8, 'Australia'),
(10, 9, 'Victoria'),
(10, 10, 'Melbourne'),
(10, 11, '12 White Rd'),
(11, 1, 'user1'),
(11, 2, '24c9e15e52afc47c225b757e7bee1f9d'),
(11, 3, 'user1@gmail.com'),
(11, 4, 'Mr.'),
(11, 5, 'Alex'),
(11, 6, 'Smith'),
(11, 7, '0452022202'),
(11, 8, 'Australia'),
(11, 9, 'Victoria'),
(11, 10, 'Melbourne'),
(11, 11, '45 Charlse St'),
(12, 1, 'user4'),
(12, 2, '3f02ebe3d7929b091e3d8ccfde2f3bc6'),
(12, 3, 'user4@example.com'),
(12, 4, 'Miss'),
(12, 5, 'Rose'),
(12, 6, 'William'),
(12, 7, '00000000'),
(12, 8, 'US'),
(12, 9, 'Florida'),
(12, 10, 'asdad'),
(12, 11, 'asdsadasd');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `customer_use_item`
--

INSERT INTO `customer_use_item` (`use_id`, `customer_id`, `room_has_item_id`, `item_id`, `use_date`, `quantity`, `price`, `refilled`) VALUES
(1, 11, 21, 1, '2013-04-11 16:00:00', 2, 7, 1),
(2, 9, 25, 4, '2013-05-14 17:00:00', 1, 3.5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `hotel`
--

CREATE TABLE IF NOT EXISTS `hotel` (
  `hotel_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`hotel_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `hotel`
--

INSERT INTO `hotel` (`hotel_id`) VALUES
(1),
(2),
(3);

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

--
-- Dumping data for table `hotel_has_meta`
--

INSERT INTO `hotel_has_meta` (`hotel_id`, `meta_id`, `value`) VALUES
(1, 17, 'CBD'),
(1, 18, '299 Swanton St, VIC'),
(1, 19, 'Locates in the Melbourne CBD area. Close to public transport, all kinds of restaurants, malls and attractions.'),
(2, 17, 'St. Kilda Beach'),
(2, 18, '21 Wordsworth St, VIC'),
(2, 19, 'Close to the beautiful St. Kilda Beach. Quiet, sunshine and the beautiful beach are waiting for you.'),
(3, 17, 'Yarra River'),
(3, 18, '17 Salmon St, VIC'),
(3, 19, 'Locates near the beautiful Yarra River. Entertainment, beers, music and attractions around the city.');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE IF NOT EXISTS `item` (
  `item_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`item_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`item_id`) VALUES
(1),
(2),
(3),
(4),
(5);

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

--
-- Dumping data for table `item_has_meta`
--

INSERT INTO `item_has_meta` (`item_id`, `meta_id`, `value`) VALUES
(1, 20, 'Soft Drink'),
(1, 21, '4.5'),
(1, 22, 'Soft drinks, including: coke, sprite, fanta, etc.'),
(2, 20, 'Beer'),
(2, 21, '6.99'),
(2, 22, 'All kinds of beers.'),
(3, 20, 'Juice'),
(3, 21, '5.00'),
(3, 22, 'All kinds of fresh juice.'),
(4, 20, 'Tea'),
(4, 21, '3.50'),
(4, 22, 'Black tea, green tea, ice tea, etc.'),
(5, 20, 'Milk'),
(5, 21, '3.50'),
(5, 22, 'Full cream milk, fresh milk, lite milk, soy milk, etc.');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `meta`
--

INSERT INTO `meta` (`meta_id`, `meta_key`, `meta_label`, `meta_datatype`, `meta_system`, `meta_required`, `meta_default`) VALUES
(1, 'customer_username', 'Username', 'VARCHAR', 1, 1, NULL),
(2, 'customer_password', 'Password', 'VARCHAR', 1, 1, NULL),
(3, 'customer_email', 'Email', 'VARCHAR', 1, 1, NULL),
(4, 'customer_title', 'Title', 'VARCHAR', 1, 1, NULL),
(5, 'customer_fname', 'First name', 'VARCHAR', 1, 1, NULL),
(6, 'customer_lname', 'Last name', 'VARCHAR', 1, 1, NULL),
(7, 'customer_phone', 'Phone', 'VARCHAR', 1, 1, NULL),
(8, 'customer_country', 'Country', 'VARCHAR', 1, 1, NULL),
(9, 'customer_state', 'State', 'VARCHAR', 1, 1, NULL),
(10, 'customer_city', 'City', 'VARCHAR', 1, 1, NULL),
(11, 'customer_address', 'Address', 'VARCHAR', 1, 1, NULL),
(12, 'offering_title', 'Offering Title', 'VARCHAR', 1, 1, NULL),
(13, 'offering_description', 'Offering Description', 'VARCHAR', 1, 1, NULL),
(14, 'offering_abbr', 'Abbreviation', 'VARCHAR', 1, 1, NULL),
(15, 'offering_img_url', 'Image_URL', 'VARCHAR', 1, 1, NULL),
(16, 'offering_link_url', 'Link_url', 'VARCHAR', 1, 1, NULL),
(17, 'hotel_name', 'Hotel Name', 'VARCHAR', 1, 1, NULL),
(18, 'hotel_location', 'Hotel Location', 'VARCHAR', 1, 1, NULL),
(19, 'hotel_desccription', 'Hotel Description', 'VARCHAR', 1, 1, NULL),
(20, 'item_type', 'Item Type', 'VARCHAR', 1, 1, NULL),
(21, 'item_price', 'Item Price', 'DECIMAL(5,2)', 1, 1, NULL),
(22, 'item_description', 'Item Description', 'VARCHAR', 1, 1, NULL),
(23, 'package_title', 'Package Title', 'VARCHAR', 1, 1, NULL),
(24, 'package_description', 'Package Description', 'VARCHAR', 1, 1, NULL),
(25, 'offering_time', 'Offering Date Time', 'DATETIME', 1, 1, NULL),
(26, 'reservation_create_time', 'Reservation Date Time', 'DATETIME', 1, 1, NULL),
(27, 'reservation_status', 'Reservation Status', 'VARCHAR', 1, 1, NULL),
(28, 'reservation_review', 'Reservation Review', 'LONGTEXT', 1, 1, NULL),
(29, 'roomtype_size', 'Room Size', 'VARCHAR', 1, 1, NULL),
(30, 'roomtype_type', 'Room Type', 'VARCHAR', 1, 1, NULL),
(31, 'roomtype_numOfPeople', 'Room Number Of People', 'INTEGER', 1, 1, NULL),
(33, 'roomtype_class', 'Room Class', 'VARCHAR', 1, 1, NULL),
(34, 'roomtype_description', 'Room Type Description', 'VARCHAR', 1, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `offering`
--

CREATE TABLE IF NOT EXISTS `offering` (
  `offering_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`offering_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `offering`
--

INSERT INTO `offering` (`offering_id`) VALUES
(1),
(2),
(5),
(6),
(7);

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

--
-- Dumping data for table `offering_has_meta`
--

INSERT INTO `offering_has_meta` (`offering_id`, `meta_id`, `value`) VALUES
(1, 12, 'Enjoy the movie'),
(1, 13, 'Get discounted movie tickets with your booking. Go and watch your favourite movie when you stay.'),
(1, 14, 'movie'),
(1, 15, 'assets/img/movies.png'),
(1, 16, '#'),
(1, 25, '2013-03-21 14:00:00'),
(2, 12, 'Kick Start'),
(2, 13, 'Stay clost to the stadium and get ready to be exicited.'),
(2, 14, 'kick start'),
(2, 15, 'assets/img/stadium.jpg'),
(2, 16, '#'),
(2, 25, '2013-04-01 10:00:00'),
(5, 12, 'Stay a little longer'),
(5, 13, 'Stay a little longer and save your money.'),
(5, 14, 'stay longer'),
(5, 15, 'assets/img/offer_room.jpg'),
(5, 16, '#'),
(5, 25, '2013-05-06 15:00:00'),
(6, 12, 'Explore the culture'),
(6, 13, 'Get discounted tickets to culture events happening in Melbourne while you go outside.'),
(6, 14, 'culture'),
(6, 15, 'assets/img/redbull_aus.jpg'),
(6, 16, '#'),
(6, 25, '2013-05-19 20:00:00'),
(7, 12, 'See the amazing animals'),
(7, 13, 'Get free tickets and experience close-up encounters with amazing animals in Melboure Zoo.'),
(7, 14, 'zoo'),
(7, 15, 'assets/img/Kangaroo.jpg'),
(7, 16, '#'),
(7, 25, '2013-05-07 09:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE IF NOT EXISTS `options` (
  `options_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `options_key` varchar(45) NOT NULL,
  `options_value` longtext,
  PRIMARY KEY (`options_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`options_id`, `options_key`, `options_value`) VALUES
(1, 'aboutus_overview', 'Allegra Hotel is a nice hotel.'),
(2, 'aboutus_policy', 'blablablablablablablablabla'),
(3, 'aboutus_responsibility', 'Show the friendly side of melbourne and promote eco-friendly tourism to all tourists.'),
(4, 'admin_username', 'admin_user1'),
(7, 'admin_password', '1111');

-- --------------------------------------------------------

--
-- Table structure for table `package`
--

CREATE TABLE IF NOT EXISTS `package` (
  `package_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`package_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `package`
--

INSERT INTO `package` (`package_id`) VALUES
(1),
(2),
(3),
(4),
(5);

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

--
-- Dumping data for table `package_has_meta`
--

INSERT INTO `package_has_meta` (`package_id`, `meta_id`, `value`) VALUES
(1, 23, 'Moive Night'),
(1, 24, 'This package provides with you two tickets of the latest movie, you can enjoy with it while your stay in Allegra. A romantic movie night will be a fantastic moment during the journey for you and your beloved.'),
(2, 23, 'Kick Start'),
(2, 24, 'A family ticket of a footy game is great chance for you and your family to get excited. Get a close sight for the team in Melbourne, and you will be part of the fans here and enjoy.'),
(3, 23, 'Stay a little longer'),
(3, 24, 'If you enjoy our service and the time you stay here, this package can extend the check out time and makes your schedule more flexible. By the way, you can enjoy other fantastic packages by the money you save.'),
(4, 23, 'Culture Shock'),
(4, 24, 'If this is the first time you come here, this might be a quick path for you to get involved in the culture in Melbourne. One or two tickets for the vocal concert, sports game or museums are the windows to the Melbourne.'),
(5, 23, 'Perfect for tourism'),
(5, 24, 'The reason you choose to spend your holiday here in Melbourne might be the fascination tourists’ attractions. Get on the way to the Philips Island, Great Ocean Road and Yarra Valley etc. Discover the best scenery in Melbourne.');

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

--
-- Dumping data for table `package_has_offering`
--

INSERT INTO `package_has_offering` (`package_id`, `offering_id`, `quantity`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 5, 2),
(4, 6, 4),
(5, 7, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `reservation_id`, `use_id`, `payment_time`, `payment_method`, `status`) VALUES
(1, 1, 1, '2013-04-11 18:00:00', 'Credit Card', 'Succeed'),
(2, 2, 2, '2013-05-08 20:00:00', 'Credit Card', 'Pending');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`reservation_id`, `customer_id`, `create_time`, `status`, `review`) VALUES
(1, 11, '2013-04-24 10:09:00', 'unchecked-in', NULL),
(2, 9, '2013-04-30 12:38:00', 'unchecked-in', NULL),
(3, 9, '2013-05-01 15:00:00', 'unchecked-in', NULL),
(4, 11, '2013-03-14 11:00:00', 'checked-in', 'Good hotel, comfortable room and delicious breakfast.');

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

--
-- Dumping data for table `reservation_has_package`
--

INSERT INTO `reservation_has_package` (`reservation_id`, `package_id`, `quantity`, `price`) VALUES
(1, 1, 1, 90),
(2, 2, 1, 120),
(2, 4, 1, 180),
(3, 5, 1, 150),
(4, 3, 1, 200);

-- --------------------------------------------------------

--
-- Table structure for table `reservation_has_room`
--

CREATE TABLE IF NOT EXISTS `reservation_has_room` (
  `reservation_id` int(10) unsigned NOT NULL,
  `room_id` int(10) unsigned NOT NULL,
  `reserve_date` date NOT NULL,
  `price` double unsigned NOT NULL,
  PRIMARY KEY (`reservation_id`,`room_id`,`reserve_date`),
  KEY `fk_reservation_has_room_reservation1_idx` (`reservation_id`),
  KEY `fk_reservation_has_roomtype_room1_idx` (`room_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reservation_has_room`
--

INSERT INTO `reservation_has_room` (`reservation_id`, `room_id`, `reserve_date`, `price`) VALUES
(1, 1, '2013-04-11', 90),
(1, 1, '2013-04-12', 90),
(1, 1, '2013-04-13', 90),
(2, 9, '2013-05-08', 120),
(3, 7, '2013-06-14', 150),
(4, 3, '2013-05-14', 120);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=61 ;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`room_id`, `hotel_id`, `roomtype_id`, `room_number`) VALUES
(1, 1, 1, '101'),
(2, 1, 1, '102'),
(3, 1, 1, '103'),
(4, 1, 2, '104'),
(5, 1, 2, '105'),
(6, 1, 3, '106'),
(7, 1, 3, '107'),
(8, 1, 3, '108'),
(9, 1, 3, '109'),
(10, 1, 4, '110'),
(11, 1, 4, '111'),
(12, 1, 4, '112'),
(13, 1, 4, '113'),
(14, 1, 5, '114'),
(15, 1, 5, '115'),
(16, 1, 5, '116'),
(17, 1, 6, '117'),
(18, 1, 6, '118'),
(19, 1, 6, '119'),
(20, 1, 6, '120'),
(21, 2, 1, '201'),
(22, 2, 1, '202'),
(23, 2, 1, '203'),
(24, 2, 2, '204'),
(25, 2, 2, '205'),
(26, 2, 3, '206'),
(27, 2, 3, '207'),
(28, 2, 3, '208'),
(29, 2, 3, '209'),
(30, 2, 4, '210'),
(31, 2, 4, '211'),
(32, 2, 4, '212'),
(33, 2, 4, '213'),
(34, 2, 5, '214'),
(35, 2, 5, '215'),
(36, 2, 5, '216'),
(37, 2, 6, '217'),
(38, 2, 6, '218'),
(39, 2, 6, '219'),
(40, 2, 6, '220'),
(41, 3, 1, '301'),
(42, 3, 1, '302'),
(43, 3, 1, '303'),
(44, 3, 2, '304'),
(45, 3, 2, '305'),
(46, 3, 3, '306'),
(47, 3, 3, '307'),
(48, 3, 3, '308'),
(49, 3, 3, '309'),
(50, 3, 4, '310'),
(51, 3, 4, '311'),
(52, 3, 4, '312'),
(53, 3, 4, '313'),
(54, 3, 5, '314'),
(55, 3, 5, '315'),
(56, 3, 5, '316'),
(57, 3, 6, '317'),
(58, 3, 6, '318'),
(59, 3, 6, '319'),
(60, 3, 6, '320');

-- --------------------------------------------------------

--
-- Table structure for table `roomtype`
--

CREATE TABLE IF NOT EXISTS `roomtype` (
  `roomtype_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`roomtype_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `roomtype`
--

INSERT INTO `roomtype` (`roomtype_id`) VALUES
(1),
(2),
(3),
(4),
(5),
(6);

-- --------------------------------------------------------

--
-- Table structure for table `roomtype_has_meta`
--

CREATE TABLE IF NOT EXISTS `roomtype_has_meta` (
  `roomtype_id` int(10) unsigned NOT NULL,
  `meta_id` int(10) unsigned NOT NULL,
  `value` longtext NOT NULL,
  PRIMARY KEY (`roomtype_id`,`meta_id`),
  KEY `fk_meta_has_room_room1_idx` (`roomtype_id`),
  KEY `fk_meta_has_room_meta_idx` (`meta_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roomtype_has_meta`
--

INSERT INTO `roomtype_has_meta` (`roomtype_id`, `meta_id`, `value`) VALUES
(1, 29, '20m*20m'),
(1, 30, 'Single'),
(1, 31, '1'),
(1, 33, 'Economic'),
(2, 29, '40m*40m'),
(2, 31, '2'),
(2, 33, 'Standard'),
(3, 29, '60m*60m'),
(3, 30, 'Family'),
(3, 31, '4'),
(3, 33, 'Classic'),
(4, 29, '20m*20m'),
(4, 30, 'Single'),
(4, 31, '1'),
(4, 33, 'Standard'),
(5, 29, '40m*40m'),
(5, 30, 'Double'),
(5, 31, '2'),
(5, 33, 'Economic'),
(6, 29, '60m*60m'),
(6, 30, 'Family'),
(6, 31, '4'),
(6, 33, 'Standard');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=41 ;

--
-- Dumping data for table `room_has_item`
--

INSERT INTO `room_has_item` (`room_has_item_id`, `room_id`, `item_id`, `quatity`) VALUES
(21, 1, 1, 4),
(22, 1, 2, 4),
(23, 1, 4, 3),
(24, 1, 5, 2),
(25, 2, 1, 4),
(26, 2, 2, 4),
(27, 2, 3, 2),
(28, 2, 4, 1),
(29, 3, 3, 4),
(30, 3, 4, 4),
(31, 3, 5, 2),
(32, 4, 1, 2),
(33, 4, 4, 1),
(34, 8, 1, 2),
(35, 8, 2, 2),
(36, 9, 3, 4),
(37, 9, 5, 3),
(38, 15, 1, 2),
(39, 15, 2, 1),
(40, 15, 4, 4);

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
  ADD CONSTRAINT `fk_offering_has_meta_meta1` FOREIGN KEY (`meta_id`) REFERENCES `meta` (`meta_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_offering_has_meta_offering1` FOREIGN KEY (`offering_id`) REFERENCES `offering` (`offering_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `package_has_meta`
--
ALTER TABLE `package_has_meta`
  ADD CONSTRAINT `fk_package_has_meta_meta1` FOREIGN KEY (`meta_id`) REFERENCES `meta` (`meta_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_package_has_meta_package1` FOREIGN KEY (`package_id`) REFERENCES `package` (`package_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `package_has_offering`
--
ALTER TABLE `package_has_offering`
  ADD CONSTRAINT `fk_package_has_offering_offering1` FOREIGN KEY (`offering_id`) REFERENCES `offering` (`offering_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_package_has_offering_package1` FOREIGN KEY (`package_id`) REFERENCES `package` (`package_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
  ADD CONSTRAINT `fk_reservation_has_package_package1` FOREIGN KEY (`package_id`) REFERENCES `package` (`package_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_reservation_has_package_reservation1` FOREIGN KEY (`reservation_id`) REFERENCES `reservation` (`reservation_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `reservation_has_room`
--
ALTER TABLE `reservation_has_room`
  ADD CONSTRAINT `fk_reservation_has_roomtype_room1` FOREIGN KEY (`room_id`) REFERENCES `room` (`room_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_reservation_has_room_reservation1` FOREIGN KEY (`reservation_id`) REFERENCES `reservation` (`reservation_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `fk_room_hotel1` FOREIGN KEY (`hotel_id`) REFERENCES `hotel` (`hotel_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_room_roomtype1` FOREIGN KEY (`roomtype_id`) REFERENCES `roomtype` (`roomtype_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `roomtype_has_meta`
--
ALTER TABLE `roomtype_has_meta`
  ADD CONSTRAINT `fk_meta_has_room_meta` FOREIGN KEY (`meta_id`) REFERENCES `meta` (`meta_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_meta_has_room_room1` FOREIGN KEY (`roomtype_id`) REFERENCES `roomtype` (`roomtype_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `room_has_item`
--
ALTER TABLE `room_has_item`
  ADD CONSTRAINT `fk_room_has_item_item1` FOREIGN KEY (`item_id`) REFERENCES `item` (`item_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_room_has_item_room1` FOREIGN KEY (`room_id`) REFERENCES `room` (`room_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
