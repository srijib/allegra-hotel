-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2013 at 10:49 AM
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
(2, 'MON', NULL, NULL, 0.9, 20),
(3, 'TUE', NULL, NULL, 0.95, 20),
(4, 'WED', NULL, NULL, 0.94, 20),
(5, 'JAN', NULL, NULL, 1.12, 20),
(6, 'MAY', NULL, NULL, 1.15, 20),
(7, NULL, '2013-12-23', '2014-01-02', 1.6, 30),
(8, NULL, '2013-03-28', '2013-04-02', 1.4, 30);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `customer_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`) VALUES
(9),
(10),
(11),
(12),
(21),
(22);

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
(9, 5, 'Raj'),
(9, 6, 'Howard'),
(9, 7, '0422501212'),
(9, 8, 'Aus'),
(9, 9, 'Vic'),
(9, 10, 'Mel'),
(9, 11, '100 Queen Street'),
(9, 35, '0'),
(10, 1, 'user3'),
(10, 2, '92877af70a45fd6a2ed7fe81e1236b78'),
(10, 3, 'alice@exmaple.com'),
(10, 4, 'Miss'),
(10, 5, 'Alice'),
(10, 6, 'Miller'),
(10, 7, '101010101'),
(10, 8, 'Australia'),
(10, 9, 'Victoria'),
(10, 10, 'Melbourne'),
(10, 11, '12 White Rd'),
(10, 35, '0'),
(11, 1, 'user2'),
(11, 2, '24c9e15e52afc47c225b757e7bee1f9d'),
(11, 3, 'user2@test.com'),
(11, 4, 'Mrs.'),
(11, 5, 'Jack'),
(11, 6, 'Ass'),
(11, 7, '0422501212'),
(11, 8, 'Aus'),
(11, 9, 'Vic'),
(11, 10, 'Mel'),
(11, 11, '100 Queen Street'),
(11, 35, '0'),
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
(12, 11, 'asdsadasd'),
(12, 35, '0'),
(21, 1, 'user5'),
(21, 2, 'b59c67bf196a4758191e42f76670ceba'),
(21, 3, 'user5@example.com'),
(21, 4, 'Mr.'),
(21, 5, 'James'),
(21, 6, 'May'),
(21, 7, '+861381922912'),
(21, 8, 'China'),
(21, 9, 'Guangdong'),
(21, 10, 'Shenzhen'),
(21, 11, '12 Dawang Rd'),
(21, 35, '1'),
(22, 1, 'bboyjeans'),
(22, 2, '8a247692022953d51df4534b4eebc710'),
(22, 3, 'test@gmail.com'),
(22, 4, 'Mr.'),
(22, 5, 'Daniel'),
(22, 6, 'Zhang'),
(22, 7, '(+61) 45-262-2239'),
(22, 8, 'AU'),
(22, 9, 'VIC'),
(22, 10, 'Melbourne'),
(22, 11, '14 White RD'),
(22, 35, '0');

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
(1, 18, '270 Swanton St, VIC'),
(1, 19, 'Locates in the Melbourne CBD area. Close to public transport, all kinds of restaurants, malls and attractions.'),
(2, 17, 'St. Kilda Beach'),
(2, 18, '21 Wordsworth St, VIC'),
(2, 19, 'Close to the beautiful St. Kilda Beach. Quiet, sunshine and the beautiful beach are waiting for you.'),
(3, 17, 'Richmond'),
(3, 18, '19 Highett St'),
(3, 19, 'Locates in Richmond.');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=40 ;

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
(19, 'hotel_description', 'Hotel Description', 'VARCHAR', 1, 1, NULL),
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
(34, 'roomtype_description', 'Room Type Description', 'VARCHAR', 1, 1, NULL),
(35, 'customer_onmail', 'Customer On Email List', 'INTEGER', 1, 1, '0'),
(36, 'offering_type', 'Offering Type', 'VARCHAR', 1, 1, NULL),
(37, 'roomtype_price', 'Roomtype Price', 'DOUBLE', 1, 1, NULL),
(38, 'offering_price', 'Offering Price', 'DOUBLE', 1, 1, NULL),
(39, 'roomtype_img_url', 'Room Type ImgUrl', 'VARCHAR', 1, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `offering`
--

CREATE TABLE IF NOT EXISTS `offering` (
  `offering_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`offering_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `offering`
--

INSERT INTO `offering` (`offering_id`) VALUES
(1),
(2),
(6),
(7),
(9),
(10),
(11),
(12),
(13),
(14),
(15),
(16),
(17),
(18);

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
(1, 12, 'Iron Man 3'),
(1, 13, 'IMAX 3D, movie, Icon Man 3'),
(1, 14, 'movie'),
(1, 15, 'assets/img/offerings/movies/iron_man_three.jpg'),
(1, 16, '#'),
(1, 25, '21-03-2013 14:00:00'),
(1, 36, 'movie'),
(1, 38, '11.0'),
(2, 12, 'Kick Start'),
(2, 13, 'Stay close to the stadium and get ready to be exicited.'),
(2, 14, 'kick start'),
(2, 15, 'assets/img/offerings/sport/stadium.jpg'),
(2, 16, '#'),
(2, 25, '01-04-2013 10:00:00'),
(2, 36, 'sport'),
(2, 38, '11.5'),
(6, 12, 'Red Bull BC ONE Bboy Championshop'),
(6, 13, 'Love HipHop and breakdance? Come and join Red Bull BC ONE! Dance with the music and show your creazy moves.'),
(6, 14, 'culture'),
(6, 15, 'assets/img/offerings/culture/redbull_aus.jpg'),
(6, 16, '#'),
(6, 25, '19-05-2013 20:00:00'),
(6, 36, 'culture'),
(6, 38, '12.5'),
(7, 12, 'See the amazing animals'),
(7, 13, 'Get free tickets and experience close-up encounters with amazing animals in Melboure Zoo.'),
(7, 14, 'zoo'),
(7, 15, 'assets/img/offerings/tourism/Kangaroo.jpg'),
(7, 16, '#'),
(7, 25, '22-05-2013 09:00:00'),
(7, 36, 'tourism'),
(7, 38, '9.0'),
(9, 12, 'Hangover Part III'),
(9, 13, 'Hangover Part III'),
(9, 14, 'hangover'),
(9, 15, 'assets/img/offerings/movies/hangover_part_iii.jpg'),
(9, 16, '#'),
(9, 25, '30-05-2013 21:00:00'),
(9, 36, 'movie'),
(9, 38, '9.9'),
(10, 12, 'Man Of Steel'),
(10, 13, 'Man Of Steel'),
(10, 14, 'man_of_steel'),
(10, 15, 'assets/img/offerings/movies/man_of_steel.jpg'),
(10, 16, '#'),
(10, 25, '01-06-2013 15:01:11'),
(10, 36, 'movie'),
(10, 38, '12.9'),
(11, 12, 'Mortal Instruments City Of Bones'),
(11, 13, 'Mortal Instruments City Of Bones'),
(11, 14, 'mortal_instruments_city_of_bones'),
(11, 15, 'assets/img/offerings/movies/mortal_instruments_city_of_bones.jpg'),
(11, 16, '#'),
(11, 25, '19-06-2013 21:05:00'),
(11, 36, 'movie'),
(11, 38, '14.5'),
(12, 12, 'Tai Chi at Fed Square'),
(12, 13, 'Feeling tired? Stressed out? Start your day with a free session of tai chi, held every Tuesday morning at Fed Square.'),
(12, 14, 'taichi'),
(12, 15, 'assets/img/offerings/sport/taichi.jpg'),
(12, 16, '#'),
(12, 25, '14-07-2013 07:40:00'),
(12, 36, 'sport'),
(12, 38, '13.5'),
(13, 12, 'The Age Run Melbourne'),
(13, 13, 'The Age Run Melbourne is more than just a ''fun run''.  For many participants it is an opportunity to give back to the community by raising funds for a cause close to their heart.'),
(13, 14, 'age_run'),
(13, 15, 'assets/img/offerings/sport/age_run.jpg'),
(13, 16, '#'),
(13, 25, '21-07-2013 07:00:00'),
(13, 36, 'sport'),
(13, 38, '19.9'),
(14, 12, 'Urbanathlon'),
(14, 13, 'Join the global phenomenon that is Urbanathlon. Tackle ten gruelling obstacles and take on 11 kilometres of challenging course through Melbourne’s city streets. '),
(14, 14, 'urban'),
(14, 15, 'assets/img/offerings/sport/urbanathlon.jpg'),
(14, 16, '#'),
(14, 25, '26-05-2013 07:30:00'),
(14, 36, 'sport'),
(14, 38, '20.5'),
(15, 12, 'Brief Encounter – Melbourne Festival'),
(15, 13, 'Remembered as one of the most haunting love stories ever, Noël Coward’s Brief Encounter is retold by one of the UK’s most admired, award-winning theatre companies.'),
(15, 14, 'brief_encounter'),
(15, 15, 'assets/img/offerings/culture/brief_encounter.jpg'),
(15, 16, '#'),
(15, 25, '09-10-2013 18:30:00'),
(15, 36, 'culture'),
(15, 38, '89.0'),
(16, 12, 'Third Person'),
(16, 13, 'A world premiere production by one of Australia’s leading playwrights, ''Third Person'' takes place in the ruins of Berlin not long after the fall of Hitler’s Third Reich. At the same time it is a post-modern sequel to Shakespeare’s ''Merchant of Venice''. Portia has survived the end of the Third Reich and now must confront the role she played as a lawyer in supporting its corrupt laws. Jessekah returns from exile to find what has happened to her Jewish family, and Anton is looking for a way out of Germany'),
(16, 14, 'third_person'),
(16, 15, 'assets/img/offerings/culture/third_person.jpg'),
(16, 16, '#'),
(16, 25, '01-06-2013 19:30:00'),
(16, 36, 'culture'),
(16, 38, '25.0'),
(17, 12, 'Russian National Ballet Theatre at Her Majesty''s Theatre'),
(17, 13, 'The Russian National Ballet Theatre returns for a tour of full-length classical performances of Swan Lake and The Nutcracker in over 20 cities across Australia from September.'),
(17, 14, 'russian_ballet'),
(17, 15, 'assets/img/offerings/culture/russian_ballet.jpg'),
(17, 16, '#'),
(17, 25, '31-10-2013 19:30:00'),
(17, 36, 'culture'),
(17, 38, '105.3'),
(18, 12, 'Melbourne Town Hall Tours'),
(18, 13, 'Free tours of Melbourne''s historic Town Hall give visitors the chance to learn about the architectural, social and political significance of this impressive 19th century building. '),
(18, 14, 'town_hall'),
(18, 15, 'assets/img/offerings/tourism/town_hall.jpg'),
(18, 16, '#'),
(18, 25, '06-06-2013 11:00:00'),
(18, 36, 'tourism'),
(18, 38, '0.0');

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE IF NOT EXISTS `options` (
  `options_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `options_key` varchar(45) NOT NULL,
  `options_value` longtext,
  PRIMARY KEY (`options_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`options_id`, `options_key`, `options_value`) VALUES
(1, 'aboutus_overview', 'Allegra Hotels is a nice and comfortable place. We are sure you will enjoy your stay here. It is a great environment for families as well as general tourists.'),
(2, 'aboutus_policy', 'Customers should always read this policy. Allegra Hotels is not responsible for any policy which the customers don''t abide by. Our policies are there to ensure fair and equitable experience for all concerned.'),
(3, 'aboutus_responsibility', 'Allegra Hotels is always trying to promote the environment. We firmly believe that customers co-existing with the environment makes for a pleasant experience for all concerned.'),
(4, 'admin_username', 'admin_user1'),
(7, 'admin_password', '1111'),
(8, 'slider_1', '1'),
(9, 'slider_2', '2'),
(10, 'slider_3', '3'),
(11, 'contactus_phone', '(+61)xxx xxx xxxx'),
(12, 'contactus_fax', '(+61)xxx xxx xxxx'),
(13, 'contactus_postal', '30 xxx Road, xxx, VIC3xxx, Australia'),
(14, 'contactus_email', 'allegrahotel@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `package`
--

CREATE TABLE IF NOT EXISTS `package` (
  `package_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`package_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `package`
--

INSERT INTO `package` (`package_id`) VALUES
(1),
(2),
(3),
(4),
(5),
(6),
(7);

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
(1, 23, 'Pakcage For Movie Fans'),
(1, 24, 'This package provides with you two tickets of the latest movie, you can enjoy with it while your stay in Allegra. A romantic movie night will be a fantastic moment during the journey for you and your beloved.'),
(2, 23, 'Package for sports fans'),
(2, 24, 'A family ticket of a footy game is great chance for you and your family to get excited. Get a close sight for the team in Melbourne, and you will be part of the fans here and enjoy.'),
(3, 23, 'Stay a little longer'),
(3, 24, 'If you enjoy our service and the time you stay here, this package can extend the check out time and makes your schedule more flexible. By the way, you can enjoy other fantastic packages by the money you save.'),
(4, 23, 'Culture Shock'),
(4, 24, 'If this is the first time you come here, this might be a quick path for you to get involved in the culture in Melbourne. One or two tickets for the vocal concert, sports game or museums are the windows to the Melbourne.'),
(5, 23, 'Perfect for tourism'),
(5, 24, 'The reason you choose to spend your holiday here in Melbourne might be the fascination tourists’ attractions. Get on the way to the Philips Island, Great Ocean Road and Yarra Valley etc. Discover the best scenery in Melbourne.'),
(6, 23, 'Easter Day'),
(6, 24, 'Stay here for two days during Easter Holiday. Including: 1 master room for two nights, one breakfast, two dinner, free parking, wireless internet, two Easter Day event tickets.'),
(7, 23, 'Pacakge for family'),
(7, 24, 'family package');

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
(1, 6, 2),
(2, 2, 1),
(4, 6, 4),
(5, 7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `package_has_roomtype`
--

CREATE TABLE IF NOT EXISTS `package_has_roomtype` (
  `package_id` int(10) unsigned NOT NULL,
  `roomtype_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`package_id`,`roomtype_id`),
  KEY `roomtype_id` (`roomtype_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `package_has_roomtype`
--

INSERT INTO `package_has_roomtype` (`package_id`, `roomtype_id`) VALUES
(1, 2),
(3, 3),
(4, 4),
(2, 5),
(5, 5),
(6, 6),
(7, 6);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `reservation_id`, `use_id`, `payment_time`, `payment_method`, `status`) VALUES
(1, 1, 1, '2013-04-11 18:00:00', 'Credit Card', 'Succeed'),
(2, 2, 2, '2013-05-08 20:00:00', 'Credit Card', 'Pending'),
(3, 6, NULL, '2013-05-25 14:48:55', 'cc', 'complete');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`reservation_id`, `customer_id`, `create_time`, `status`, `review`) VALUES
(1, 11, '2013-04-24 10:09:00', 'unchecked-in', NULL),
(2, 9, '2013-04-30 12:38:00', 'unchecked-in', NULL),
(3, 9, '2013-05-01 15:00:00', 'unchecked-in', NULL),
(5, 9, '2013-05-25 09:06:15', 'reserved', '0'),
(6, 9, '2013-05-25 14:48:55', 'reserved', '0'),
(7, 22, '2013-05-26 16:00:00', 'checked-in', '4');

-- --------------------------------------------------------

--
-- Table structure for table `reservation_has_offering`
--

CREATE TABLE IF NOT EXISTS `reservation_has_offering` (
  `reservation_id` int(10) unsigned NOT NULL,
  `offering_id` int(10) unsigned NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` double DEFAULT NULL,
  PRIMARY KEY (`reservation_id`,`offering_id`),
  KEY `offering_id` (`offering_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reservation_has_offering`
--

INSERT INTO `reservation_has_offering` (`reservation_id`, `offering_id`, `quantity`, `price`) VALUES
(1, 1, 1, 10),
(1, 2, 1, 9),
(2, 10, 1, 15),
(3, 14, 1, 12),
(5, 1, 1, 11),
(6, 13, 1, 15),
(7, 17, 1, 12);

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
(5, 1, '2013-05-25', 103.5),
(6, 47, '2013-07-23', 185),
(7, 40, '2013-06-13', 90);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=65 ;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`room_id`, `hotel_id`, `roomtype_id`, `room_number`) VALUES
(1, 1, 1, '100'),
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
(60, 3, 6, '320'),
(64, 3, 2, '121');

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
(1, 29, '20'),
(1, 30, 'Single'),
(1, 31, '1'),
(1, 33, 'Standard'),
(1, 34, 'Quiet and comfortable. \nInclude: one single size bed, television, air conditioner, wireless connection, bathroom. '),
(1, 37, '90.0'),
(1, 39, 'assets/img/single_standard.jpg'),
(2, 29, '40'),
(2, 30, 'Family'),
(2, 31, '2'),
(2, 33, 'Standard'),
(2, 34, 'Large enough for your family and comfortable. \nInclude: two king size bed, one desk for work, television, air conditioner, wireless connection, bathroom, and more'),
(2, 37, '250.0'),
(2, 39, 'assets/img/family_standard.jpg'),
(3, 29, '60'),
(3, 30, 'Family'),
(3, 31, '4'),
(3, 33, 'Suite'),
(3, 34, 'Plenty of space for your family and comfortable. \nInclude: two bedrooms, each has one king size bed and one desk for work, one dinning room,  refrigerator, television, air conditioner, wireless connection, bathroom, and more'),
(3, 37, '270.0'),
(3, 39, 'assets/img/family_suite.jpg'),
(4, 29, '20'),
(4, 30, 'Single'),
(4, 31, '1'),
(4, 33, 'Suite'),
(4, 34, 'Perfect for one guest. Quiet and comfortable. \nInclude: one bedroom, one living room, one single size bed and one desk for work, refrigerator, television, air conditioner, wireless connection, bathroom, and more'),
(4, 37, '100.0'),
(4, 39, 'assets/img/single_suite.jpg'),
(5, 29, '40'),
(5, 30, 'Double'),
(5, 31, '2'),
(5, 33, 'Standard'),
(5, 34, 'A world for two. Quiet, comfortable and romantic. \r\nInclude: one bedroom, one king size bed, television, air conditioner, wireless connection, bathroom, free parking and more'),
(5, 37, '150.0'),
(5, 39, 'assets/img/double_standard.jpg'),
(6, 29, '60'),
(6, 30, 'Double'),
(6, 31, '4'),
(6, 33, 'Suite'),
(6, 34, 'Feels like being at home. Quiet, comfortable and romantic. \r\nInclude: one bedroom which has one king size bed, one living room, desk for work, refrigerator, television, air conditioner, wireless connection, bathroom, free parking and more'),
(6, 37, '190.0'),
(6, 39, 'assets/img/double_suite.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `room_has_item`
--

CREATE TABLE IF NOT EXISTS `room_has_item` (
  `room_has_item_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `room_id` int(10) unsigned NOT NULL,
  `item_id` int(10) unsigned NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`room_has_item_id`),
  KEY `fk_room_has_item_item1_idx` (`item_id`),
  KEY `fk_room_has_item_room1_idx` (`room_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=41 ;

--
-- Dumping data for table `room_has_item`
--

INSERT INTO `room_has_item` (`room_has_item_id`, `room_id`, `item_id`, `quantity`) VALUES
(21, 1, 1, 2),
(22, 1, 2, 1),
(25, 2, 1, 1),
(28, 2, 4, 1),
(29, 3, 3, 1),
(30, 3, 4, 1),
(31, 3, 5, 1),
(32, 4, 1, 2),
(34, 8, 1, 2),
(36, 9, 3, 4),
(38, 15, 1, 2),
(39, 15, 2, 1);

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
-- Constraints for table `package_has_roomtype`
--
ALTER TABLE `package_has_roomtype`
  ADD CONSTRAINT `package_has_roomtype_ibfk_1` FOREIGN KEY (`package_id`) REFERENCES `package` (`package_id`),
  ADD CONSTRAINT `package_has_roomtype_ibfk_2` FOREIGN KEY (`roomtype_id`) REFERENCES `roomtype` (`roomtype_id`);

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
-- Constraints for table `reservation_has_offering`
--
ALTER TABLE `reservation_has_offering`
  ADD CONSTRAINT `reservation_has_offering_ibfk_1` FOREIGN KEY (`reservation_id`) REFERENCES `reservation` (`reservation_id`),
  ADD CONSTRAINT `reservation_has_offering_ibfk_2` FOREIGN KEY (`offering_id`) REFERENCES `offering` (`offering_id`);

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
