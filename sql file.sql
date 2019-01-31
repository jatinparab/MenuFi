-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 14, 2018 at 06:33 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `menufi`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` int(11) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `address` text NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`id`, `mobile`, `address`, `name`) VALUES
(1, '9820181342', 'Test address', ''),
(2, '9820181347', 'Test', 'jatin'),
(4, '9820181343', '1', 'Uhu');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  `user_type` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `user_type`) VALUES
(1, 'admin', 'admin', 'chef'),
(2, 'admin1', 'admin1', 'Manager'),
(3, 'admin2', 'admin2', 'Owner'),
(4, 'adminf', '2222', 'manager');

-- --------------------------------------------------------

--
-- Table structure for table `background_image`
--

CREATE TABLE `background_image` (
  `id` int(11) NOT NULL,
  `img_name` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `background_image`
--

INSERT INTO `background_image` (`id`, `img_name`) VALUES
(1, 'y2.png');

-- --------------------------------------------------------

--
-- Table structure for table `batter`
--

CREATE TABLE `batter` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `batter`
--

INSERT INTO `batter` (`id`, `name`) VALUES
(0, 'None'),
(5, 'Ricce'),
(6, 'Neer'),
(7, 'Millet'),
(8, 'Rava'),
(9, 'Rava'),
(10, 'Rice');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(14, 'Beer'),
(15, 'Uthappa'),
(16, 'Fusion'),
(17, 'Wraps'),
(18, 'Pardesi'),
(19, 'ThalI'),
(20, 'Desserts'),
(21, 'Sides'),
(30, 'Dosa');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` int(11) NOT NULL,
  `c_type` varchar(255) NOT NULL,
  `c_code` varchar(255) NOT NULL,
  `c_minvalue` varchar(255) NOT NULL,
  `c_status` varchar(255) NOT NULL,
  `c_value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `c_type`, `c_code`, `c_minvalue`, `c_status`, `c_value`) VALUES
(2, 'flat', 'PRA02', '2000', 'ON', '20'),
(3, 'percent', 'MDH02', '1000', 'ON', '10'),
(4, 'flat', 'PRA03', '300', 'ON', '100');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(255) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `otp` varchar(50) NOT NULL,
  `views` bigint(255) NOT NULL,
  `revenue` double NOT NULL,
  `Last_Visited` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `mobile`, `email`, `otp`, `views`, `revenue`, `Last_Visited`) VALUES
(1, '9820181347', '', '1', 41, 0, '2018-07-14 21:26:14'),
(2, '9820181343', '', '0', 7, 0, '2018-06-11 18:23:41'),
(3, '9820181341', '', '0', 9, 0, '2018-07-09 23:39:26'),
(4, '9096017752', '', '0', 3, 0, '2018-06-26 22:37:54');

-- --------------------------------------------------------

--
-- Table structure for table `customer_order`
--

CREATE TABLE `customer_order` (
  `id` int(20) NOT NULL,
  `Order_id` int(11) NOT NULL,
  `Menu_Id` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Addons` varchar(25555) DEFAULT NULL,
  `Batter` int(11) NOT NULL,
  `Optional_ingredients` text,
  `comments` text,
  `item_status` int(2) NOT NULL DEFAULT '1',
  `spice_level` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_order`
--

INSERT INTO `customer_order` (`id`, `Order_id`, `Menu_Id`, `Quantity`, `Addons`, `Batter`, `Optional_ingredients`, `comments`, `item_status`, `spice_level`, `customer_id`) VALUES
(1, 2, 3, 2, '2,', 1, NULL, 'comments', 2, NULL, 1),
(2, 3, 3, 3, '', 1, NULL, 'comments', 2, NULL, 1),
(3, 4, 3, 3, '', 1, NULL, 'comments', 2, NULL, 1),
(4, 5, 3, 1, NULL, 0, NULL, 'comments', 2, NULL, NULL),
(5, 7, 5, 2, '', 1, NULL, 'comments', 2, NULL, 2),
(6, 8, 3, 2, '', 1, NULL, 'comments', 2, NULL, 1),
(7, 9, 3, 1, '', 1, NULL, 'comments', 2, NULL, 1),
(8, 9, 3, 2, '2,', 1, NULL, 'comments', 2, NULL, 1),
(9, 10, 3, 2, '3,', 1, NULL, 'comments', 2, NULL, 2),
(10, 14, 3, 1, '2,', 1, NULL, 'comments', 2, NULL, 2),
(11, 14, 4, 2, '4,', 1, NULL, 'comments', 2, NULL, 2),
(12, 15, 3, 1, '2,', 1, NULL, 'comments', 2, NULL, 1),
(13, 15, 4, 1, '4,', 1, NULL, 'comments', 2, NULL, 1),
(14, 15, 3, 1, '2,', 1, NULL, 'comments', 2, NULL, 1),
(15, 15, 4, 1, '4,', 1, NULL, 'comments', 2, NULL, 1),
(16, 15, 3, 1, '2,', 1, NULL, 'comments', 2, NULL, 1),
(17, 15, 4, 1, '4,', 1, NULL, 'comments', 2, NULL, 1),
(18, 15, 3, 1, '2,', 1, NULL, 'comments', 2, NULL, 1),
(19, 15, 4, 1, '4,', 1, NULL, 'comments', 2, NULL, 1),
(22, 17, 4, 1, '4,', 1, NULL, 'comments', 2, NULL, 3),
(23, 18, 3, 5, '2,', 4, NULL, 'comments', 2, NULL, 3),
(24, 19, 3, 4, '2,', 4, NULL, 'comments', 2, NULL, 1),
(31, 28, 5, 1, '', 1, NULL, 'comments', 2, NULL, 2),
(33, 29, 3, 1, '', 1, NULL, 'comments', 2, NULL, 1),
(34, 30, 1, 1, '7,', 6, NULL, 'comments', 2, NULL, 3),
(35, 31, 1, 7, '11,', 5, NULL, 'comments', 2, NULL, 1),
(36, 32, 3, 2, NULL, 0, NULL, 'comments', 2, NULL, NULL),
(37, 33, 4, 2, NULL, 0, NULL, 'comments', 2, NULL, NULL),
(38, 33, 7, 2, NULL, 0, NULL, 'comments', 2, NULL, NULL),
(39, 33, 8, 2, NULL, 0, NULL, 'comments', 2, NULL, NULL),
(40, 34, 1, 2, NULL, 0, NULL, 'comments', 2, NULL, NULL),
(41, 34, 3, 2, NULL, 0, NULL, 'comments', 2, NULL, NULL),
(42, 35, 21, 2, NULL, 0, NULL, 'comments', 2, NULL, NULL),
(43, 36, 17, 2, NULL, 0, NULL, 'comments', 2, NULL, NULL),
(44, 37, 1, 2, NULL, 0, NULL, 'comments', 2, NULL, NULL),
(45, 38, 3, 2, NULL, 0, NULL, 'comments', 2, NULL, NULL),
(46, 38, 5, 2, NULL, 0, NULL, 'comments', 2, NULL, NULL),
(47, 38, 4, 1, NULL, 0, NULL, 'comments', 2, NULL, NULL),
(48, 39, 3, 2, NULL, 0, NULL, 'comments', 2, NULL, NULL),
(49, 40, 1, 2, NULL, 0, NULL, 'comments', 2, NULL, NULL),
(50, 41, 7, 2, NULL, 0, NULL, 'comments', 2, NULL, NULL),
(51, 42, 1, 2, '', 5, NULL, 'comments', 2, NULL, 3),
(52, 44, 3, 2, '', 5, NULL, 'comments', 2, NULL, 0),
(53, 44, 4, 3, '', 6, NULL, 'comments', 2, NULL, 0),
(54, 44, 3, 2, '', 5, NULL, 'comments', 2, NULL, 0),
(55, 44, 4, 3, '', 6, NULL, 'comments', 2, NULL, 0),
(56, 46, 3, 2, '', 5, NULL, 'comments', 2, NULL, 3),
(58, 46, 3, 2, '', 5, NULL, 'comments', 2, NULL, 3),
(60, 46, 9, 1, '', 7, NULL, 'comments', 2, NULL, 3),
(63, 48, 34, 2, '', 5, NULL, 'comments', 2, NULL, 1),
(64, 48, 5, 6, '2,3', 6, NULL, 'comments', 2, NULL, 1),
(65, 49, 45, 3, '', 6, NULL, 'comments', 2, NULL, 1),
(66, 49, 7, 2, '', 6, NULL, 'comments', 2, NULL, 1),
(67, 50, 8, 4, '', 6, NULL, 'comments', 2, NULL, 3),
(68, 50, 13, 2, '', 0, NULL, 'comments', 2, NULL, 3),
(69, 50, 11, 3, '4', 0, NULL, 'comments', 2, NULL, 3),
(70, 50, 11, 1, '', 0, NULL, 'comments', 2, NULL, 3),
(71, 50, 5, 3, '', 0, NULL, 'comments', 2, NULL, 3),
(72, 51, 1, 1, '', 0, NULL, 'comments', 2, NULL, 1),
(73, 51, 12, 1, '', 0, NULL, 'comments', 2, NULL, 1),
(78, 50, 8, 1, '2,   3,  5, 2', 0, NULL, 'comments', 2, NULL, 0),
(79, 50, 8, 1, '', 0, NULL, 'comments', 2, NULL, 0),
(80, 50, 3, 4, '', 0, NULL, 'comments', 2, NULL, 0),
(81, 53, 7, 1, '3', 0, NULL, 'comments', 2, NULL, 1),
(82, 53, 11, 1, '', 0, NULL, 'comments', 2, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` int(20) NOT NULL,
  `nameOfPerson` varchar(255) NOT NULL,
  `amount` int(11) NOT NULL,
  `type` text NOT NULL,
  `reason` varchar(2555) NOT NULL,
  `date` date NOT NULL,
  `time` varchar(2555) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `nameOfPerson`, `amount`, `type`, `reason`, `date`, `time`, `name`) VALUES
(6, 'Jatin', 3, 'general', '3', '2018-06-07', '11:11', '32'),
(7, 'Parab', 333, 'grossary', '123', '2018-06-11', '18:30', '12');

-- --------------------------------------------------------

--
-- Table structure for table `fake_order`
--

CREATE TABLE `fake_order` (
  `id` int(255) NOT NULL,
  `Menu_id` varchar(255) NOT NULL,
  `Customer_id` varchar(255) NOT NULL,
  `Quantity` varchar(255) NOT NULL,
  `addon` varchar(25555) NOT NULL,
  `batter` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `variety` int(11) DEFAULT NULL,
  `quality` int(11) DEFAULT NULL,
  `serving_portion` int(11) DEFAULT NULL,
  `presentation` int(11) DEFAULT NULL,
  `value_for_money` int(11) DEFAULT NULL,
  `speed` int(11) DEFAULT NULL,
  `staff_courtesy` int(11) DEFAULT NULL,
  `staff_knowledge` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `timestamp` datetime DEFAULT NULL,
  `login_type` varchar(20) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `variety`, `quality`, `serving_portion`, `presentation`, `value_for_money`, `speed`, `staff_courtesy`, `staff_knowledge`, `customer_id`, `timestamp`, `login_type`, `order_id`) VALUES
(1, 5, 4, 3, 2, 1, 5, 4, 3, NULL, NULL, NULL, NULL),
(52, 2, 2, 2, 2, 2, 2, 2, 2, 42, '2018-02-10 09:34:53', 'mobile', 465),
(53, 3, 3, 3, 3, 3, 3, 3, 3, 26, '2018-02-10 09:39:13', 'mobile', 466),
(54, 5, 5, 5, 5, 5, 1, 1, 1, 25, '2018-02-12 17:14:24', 'mobile', 476),
(55, 3, 3, 3, 3, 5, 4, 5, 5, 51, '2018-02-13 20:12:31', 'mobile', 490);

-- --------------------------------------------------------

--
-- Table structure for table `fonts`
--

CREATE TABLE `fonts` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `font-family` varchar(50) DEFAULT NULL,
  `font-style` varchar(20) DEFAULT NULL,
  `font-weight` varchar(20) DEFAULT NULL,
  `src` varchar(500) DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fonts`
--

INSERT INTO `fonts` (`id`, `name`, `font-family`, `font-style`, `font-weight`, `src`, `is_active`) VALUES
(1, 'Berkshire Swash', 'Berkshire Swash', 'normal', '400', 'url(https://fonts.gstatic.com/s/berkshireswash/v6/4RZJjVRPjYnC2939hKCAiiJH4brlqpr7zMNWu0xQjN8.woff2)', 1),
(3, 'Comfortaa Regular', 'Comfortaa Regular', NULL, NULL, 'url(https://fonts.gstatic.com/s/comfortaa/v12/-DackuIFgo7Hfy3rR14C3xJtnKITppOI_IvcXXDNrsc.woff2)', 0),
(9, 'DancingScript-Regular', 'DancingScript-Regular', NULL, NULL, 'url(https://fonts.gstatic.com/s/dancingscript/v9/DK0eTGXiZjN6yA8zAEyM2Ud0sm1ffa_JvZxsF_BEwQk.woff2)', 0),
(10, 'Lobster-Regular', 'Lobster-Regular', NULL, NULL, 'url(https://fonts.gstatic.com/s/lobster/v20/cycBf3mfbGkh66G5NhszPQ.woff2)', 0),
(11, 'Lobster Two', 'Lobster Two', NULL, NULL, 'url(https://fonts.gstatic.com/s/lobstertwo/v10/Law3VVulBOoxyKPkrNsAaI4P5ICox8Kq3LLUNMylGO4.woff2)', 0),
(12, 'Macondo Swash Caps', 'Macondo Swash Caps', NULL, NULL, 'url(https://fonts.gstatic.com/s/macondoswashcaps/v5/SsSR706z-MlvEH7_LS6JAPL0dWkwMqAinnMVaAgLtdw.woff2)', 0),
(13, 'Pacifico-Regular', 'Pacifico-Regular', NULL, NULL, 'url(https://fonts.gstatic.com/s/pacifico/v12/Q_Z9mv4hySLTMoMjnk_rCfesZW2xOQ-xsNqO47m55DA.woff2)', 0),
(14, 'Raleway-Regular', 'Raleway-Regular', NULL, NULL, 'url(https://fonts.gstatic.com/s/raleway/v12/0dTEPzkLWceF7z0koJaX1A.woff2)', 0),
(15, 'Satisfy', 'Satisfy', NULL, NULL, 'url(https://fonts.gstatic.com/s/satisfy/v8/2OzALGYfHwQjkPYWELy-cw.woff2)', 0);

-- --------------------------------------------------------

--
-- Table structure for table `hotel_name_addr`
--

CREATE TABLE `hotel_name_addr` (
  `id` int(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `contact` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hotel_name_addr`
--

INSERT INTO `hotel_name_addr` (`id`, `name`, `address`, `contact`) VALUES
(1, 'Paaji Balaji', 'Shop no 32, Vedant complex, Next to ICICI bank', '8433840004');

-- --------------------------------------------------------

--
-- Table structure for table `ingredients`
--

CREATE TABLE `ingredients` (
  `Ingredients_id` int(10) NOT NULL,
  `Name` text NOT NULL,
  `quantity` float NOT NULL,
  `min_quantity` float NOT NULL,
  `addons` int(5) NOT NULL DEFAULT '0',
  `cost` double DEFAULT NULL COMMENT 'cost per kg'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ingredients`
--

INSERT INTO `ingredients` (`Ingredients_id`, `Name`, `quantity`, `min_quantity`, `addons`, `cost`) VALUES
(2, 'self-raising flour', 58, 20, 2, 15),
(3, 'chilli powder', 36, 40, 1, 13),
(4, 'garam masala', 1790, 190, 1, 14),
(5, 'tandoori masala powder', 200, 190, 0, 15),
(6, 'potatoes', -224, 0, 0, 2),
(7, 'onions', 273.78, 0, 0, 10),
(8, 'spring onions', 130, 0, 0, 22),
(9, 'spinach leaves', 100, 0, 0, 12),
(10, 'green chilli', 80, 0, 0, 11),
(11, 'salt', 308, 0, 0, 22),
(13, 'Tomato', 100, 10, 0, 12),
(14, 'burger buns', 100, 20, 0, 12);

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `inventory_id` int(10) NOT NULL,
  `inventory_name` varchar(255) NOT NULL,
  `quantity` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `logo`
--

CREATE TABLE `logo` (
  `id` int(11) NOT NULL,
  `img_name` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logo`
--

INSERT INTO `logo` (`id`, `img_name`) VALUES
(1, 'menufi_1.png');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `Menu_Id` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Price` float NOT NULL,
  `Description` varchar(500) NOT NULL,
  `Type` varchar(20) DEFAULT NULL,
  `Category` varchar(30) NOT NULL,
  `Image` varchar(255) NOT NULL,
  `time` varchar(20) DEFAULT NULL,
  `spice_level` int(11) DEFAULT NULL COMMENT '1:lowest, 2:medium, 3:spicy'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`Menu_Id`, `Name`, `Price`, `Description`, `Type`, `Category`, `Image`, `time`, `spice_level`) VALUES
(1, 'Butter Dosa', 70, 'Butter dosa', 'Veg', 'Dosa', 'butter uthappa.jpg', '10', 1),
(3, 'Coconut Neer dosa', 75, 'c', 'Veg', 'Dosa', '', '10', 1),
(4, 'Rava Butter Dosa', 75, 'rbd', 'Veg', 'Dosa', '', '10', 1),
(5, 'Masala Dosa', 75, 'md', 'Veg', 'Dosa', '', '10', 1),
(6, 'Mysore Dosa', 80, 'md', 'Veg', 'Dosa', '', '10', 1),
(7, 'Mysore Masala Dosa', 85, 'mmd', 'Veg', 'Dosa', '', '10', 1),
(8, 'Ghee Gunpowder Dosa', 110, 'ggd', 'Veg', 'Dosa', '', '10', 2),
(9, 'Table Top Dosa', 150, 'ttd', 'Veg', 'Dosa', '', '10', 2),
(10, 'Butter Uthappa', 70, 'bu', 'Veg', 'Uthappa', '', '10', 1),
(11, 'Onion Uthappa', 80, 'OU', 'Veg', 'Uthappa', '', '10', 1),
(12, 'Tomato Uthappa', 70, 'TU', 'Veg', 'Uthappa', '', '10', 2),
(13, 'Masala Uthappa', 80, 'mu', 'Veg', 'Uthappa', '', '10', 2),
(14, 'Mix Veg Uthappa', 80, 'mvu', 'Veg', 'Uthappa', '', '10', 2),
(15, 'Burnt Garlic Cheese Uthappa', 85, 'bgcu', 'Veg', 'Uthappa', '', '10', 2),
(16, 'Coconut Uthappa', 75, 'cu', 'Veg', 'Uthappa', '', '10', 1),
(17, 'Corn and cheese Uthappa', 90, 'ccu', 'Veg', 'Uthappa', '', '10', 1),
(18, 'Dum Aloo', 140, 'da', 'Veg', 'Fusion', '', '10', 2),
(19, 'Tawa Methi Mushroom', 170, 'tmm', 'Veg', 'Fusion', 'butter uthappa.jpg', '10', 2),
(21, 'Paneer Makhni', 170, 'pm', 'Veg', 'Fusion', '', '10', 2),
(22, 'Palak Paneer', 170, 'pp', 'Veg', 'Fusion', '', '10', 1),
(23, 'Bhuna Paneer', 170, 'b', 'Veg', 'Fusion', '', '10', 2),
(24, 'Sarson ka saag', 180, 'sks', 'Veg', 'Fusion', '', '10', 2),
(25, 'Kadi Pakoda', 160, 'kp', 'Veg', 'Fusion', '', '10', 2),
(26, 'Dal Makhni', 160, 'dm', 'Veg', 'Fusion', '', '10', 1),
(27, 'Pindi Chole', 170, 'pc', 'Veg', 'Fusion', '', '10', 2),
(28, 'Baida Curry', 170, 'bc', 'Non-Veg', 'Fusion', '', '10', 2),
(29, 'Bhuna Murgh', 190, 'bm', 'Non-Veg', 'Fusion', '', '10', 2),
(30, 'Butter Chicken', 210, 'bc', 'Non-Veg', 'Fusion', '', '10', 1),
(31, 'Tawa Methi Chicken', 210, 'tmc', 'Non-Veg', 'Fusion', '', '10', 2),
(32, 'Gosht ka kheema', 220, 'gkk', 'Non-Veg', 'Fusion', '', '10', 2),
(33, 'Mutton Rogan Josh', 220, 'gmrj', 'Non-Veg', 'Dosa', 'butter uthappa.jpg', '10', 2),
(34, 'Ghee Mutton Rogan Josh', 220, 'gmrj', 'Non-Veg', 'Fusion', '', '10', 2),
(35, 'Gosht Seekh Kadhi', 220, 'gsk', 'Non-Veg', 'Fusion', '', '10', 2),
(36, 'Masala Scrambled Paneer Wrap', 140, 'mspw', 'Non-Veg', 'Wraps', 'dosa wrap.jpg', '10', 2),
(37, 'Masala Scrambled Paneer Wrap', 140, 'mspw', 'Non-Veg', 'Wraps', '', '10', 2),
(38, 'Dilli Wali Tikki Wrap', 140, 'dwtw', 'Veg', 'Wraps', '', '10', 1),
(39, 'Mushroom Chilli Wrap', 150, 'mcw', 'Veg', 'Wraps', '', '10', 2),
(40, 'Dhuadhar Paneer Wrap', 160, 'dpw', 'Veg', 'Wraps', '', '10', 2),
(41, 'Cheese Burst Wrap', 190, 'cbw', 'Veg', 'Wraps', '', '10', 2),
(42, 'Baida Wrap', 140, 'bw', 'Non-Veg', 'Wraps', '', '10', 2),
(43, 'Murgh Patiala Wrap', 170, 'mpw', 'Non-Veg', 'Wraps', 'dosa wrap.jpg', '10', 2),
(44, 'Murgh Patiala Wrap', 170, 'mpw', 'Non-Veg', 'Wraps', '', '10', 2),
(45, 'Dhuadhar Murgh wrap', 170, 'dmw', 'Non-Veg', 'Wraps', '', '10', 2),
(46, 'Chicken Chilli Wrap', 170, 'ccw', 'Non-Veg', 'Wraps', '', '10', 2),
(47, 'Chicken Kheema Wrap', 180, 'ckw', 'Non-Veg', 'Wraps', '', '10', 2),
(48, 'Mutton Kheema Wrap', 190, 'mkw', 'Non-Veg', 'Wraps', '', '10', 2),
(49, 'Chicken Cheese Burst', 210, 'ccb', 'Non-Veg', 'Wraps', '', '10', 2),
(50, 'Dosa Tacos', 180, 'dt', 'Veg', 'Pardesi', '', '10', 1),
(51, 'Cheese Fries Crisp Salad', 180, 'cfcs', 'Veg', 'Pardesi', '', '10', 2),
(52, 'Pizza', 220, 'P', 'Veg', 'Pardesi', '', '10', 2),
(53, 'Murgh Dosa Tacos', 190, 'mdt', 'Non-Veg', 'Fusion', '', '10', 2),
(54, 'Creamy Chicken Crisp Salad', 190, 'cccs', 'Non-Veg', 'Pardesi', '', '190', 1),
(55, 'Chicken Pizza', 230, 'cp', 'Non-Veg', 'Pardesi', '', '10', 2),
(56, 'Veg Thali', 260, 'vt', 'Veg', 'ThalI', '', '10', 2),
(57, 'Murgh Thali', 290, 'mt', 'Non-Veg', 'ThalI', '', '10', 2),
(58, 'Gosht Thali', 330, 'gt', 'Non-Veg', 'ThalI', '', '10', 2),
(59, 'Uthappam Superstar', 180, 'us', 'Veg', 'ThalI', '', '10', 2),
(60, 'Rang De Basanti Dosa', 190, 'rd', 'Veg', 'ThalI', '', '10', 2),
(61, 'Banana pancakes', 150, 'bp', 'Veg', 'Desserts', '', '10', 1),
(62, 'Honey Jaggery pancakes', 160, 'hjp', 'Veg', 'Desserts', '', '10', 1),
(63, 'Chocolate Wrap', 150, 'cw', 'Veg', 'Desserts', '', '10', 1),
(64, 'Sweet Coconut wrap', 90, 'scw', 'Veg', 'Desserts', 'ice cream dosa.png', '90', 1),
(65, 'Sweet Coconut wrap', 90, 'scw', 'Veg', 'Desserts', '', '90', 1),
(66, 'Chocolate Banana Wrap', 120, 'cbw', 'Veg', 'Desserts', '', '10', 1),
(67, 'Fried Ice cream', 180, 'fic', 'Veg', 'Desserts', '', '10', 2),
(68, 'cheese', 30, 'cheese', 'Veg', 'Sides', '', '2', 1),
(69, 'beer', 100, 'asdfsasa', 'Veg', 'Beer', 'tuborg.jpg', '10', 1);

-- --------------------------------------------------------

--
-- Table structure for table `menu_batter_rel`
--

CREATE TABLE `menu_batter_rel` (
  `id` int(20) NOT NULL,
  `menu_id` int(20) NOT NULL,
  `batter_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu_batter_rel`
--

INSERT INTO `menu_batter_rel` (`id`, `menu_id`, `batter_id`) VALUES
(2, 1, 10),
(3, 1, 6),
(4, 1, 8),
(5, 1, 7),
(6, 18, 10),
(7, 18, 6),
(8, 18, 8),
(9, 18, 7),
(10, 19, 10),
(11, 19, 6),
(12, 19, 7),
(13, 21, 10),
(14, 21, 9),
(15, 19, 8),
(16, 21, 6),
(17, 22, 10),
(18, 22, 9),
(19, 22, 7),
(20, 22, 6),
(21, 23, 10),
(22, 23, 9),
(23, 23, 7),
(24, 23, 6),
(25, 24, 10),
(26, 24, 9),
(27, 24, 7),
(28, 24, 6),
(29, 25, 10),
(30, 25, 8),
(31, 25, 7),
(32, 25, 6),
(33, 26, 10),
(34, 26, 9),
(35, 26, 7),
(36, 26, 6),
(37, 27, 10),
(38, 27, 9),
(39, 27, 7),
(40, 27, 6);

-- --------------------------------------------------------

--
-- Table structure for table `menu_ingridient_rel`
--

CREATE TABLE `menu_ingridient_rel` (
  `id` int(10) NOT NULL,
  `Menu_id` int(10) NOT NULL,
  `Ingredients_id` int(10) NOT NULL,
  `quantity_rel` float NOT NULL,
  `addons` int(11) DEFAULT '0' COMMENT '0-mandatory 2-optional 1-addon ',
  `addon_price` int(11) NOT NULL,
  `batters` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu_ingridient_rel`
--

INSERT INTO `menu_ingridient_rel` (`id`, `Menu_id`, `Ingredients_id`, `quantity_rel`, `addons`, `addon_price`, `batters`) VALUES
(2, 1, 7, 0.01, 1, 0, ''),
(3, 3, 7, 0.01, 1, 0, ''),
(4, 4, 7, 0.01, 1, 0, ''),
(5, 5, 7, 1, 1, 0, ''),
(6, 6, 7, 1, 1, 0, ''),
(7, 7, 7, 1, 1, 0, ''),
(8, 8, 7, 1, 1, 0, ''),
(9, 9, 7, 1, 1, 0, ''),
(10, 10, 7, 1, 1, 0, ''),
(11, 11, 7, 1, 1, 0, ''),
(12, 12, 7, 1, 1, 0, ''),
(13, 13, 7, 1, 1, 0, ''),
(14, 14, 7, 1, 1, 0, ''),
(15, 15, 7, 1, 1, 0, ''),
(16, 16, 7, 1, 1, 0, ''),
(17, 17, 7, 1, 1, 0, ''),
(18, 18, 7, 1, 1, 0, ''),
(19, 19, 7, 1, 1, 0, ''),
(20, 21, 7, 1, 1, 0, ''),
(21, 22, 7, 1, 1, 0, ''),
(22, 23, 7, 1, 1, 0, ''),
(23, 24, 7, 1, 1, 0, ''),
(24, 25, 7, 1, 1, 0, ''),
(25, 26, 7, 1, 1, 0, ''),
(26, 27, 7, 1, 1, 0, ''),
(27, 28, 7, 1, 1, 0, ''),
(28, 29, 7, 1, 1, 0, ''),
(29, 30, 7, 1, 1, 0, ''),
(30, 31, 7, 2, 1, 0, ''),
(31, 32, 7, 1, 1, 0, ''),
(32, 33, 7, 1, 1, 0, ''),
(33, 34, 7, 1, 1, 0, ''),
(34, 35, 7, 1, 1, 0, ''),
(35, 36, 7, 1, 1, 0, ''),
(36, 38, 7, 1, 1, 0, ''),
(37, 39, 7, 1, 1, 0, ''),
(38, 40, 7, 1, 1, 0, ''),
(39, 41, 7, 1, 1, 0, ''),
(40, 42, 7, 1, 1, 0, ''),
(41, 45, 7, 1, 1, 0, ''),
(42, 46, 7, 1, 1, 0, ''),
(43, 47, 7, 1, 1, 0, ''),
(44, 48, 7, 1, 1, 0, ''),
(45, 49, 7, 1, 1, 0, ''),
(46, 50, 7, 1, 1, 0, ''),
(47, 51, 7, 1, 1, 0, ''),
(48, 52, 7, 1, 1, 0, ''),
(49, 53, 7, 1, 1, 0, ''),
(50, 54, 7, 1, 1, 0, ''),
(51, 55, 7, 1, 1, 0, ''),
(52, 56, 7, 1, 1, 0, ''),
(53, 57, 7, 1, 1, 0, ''),
(54, 58, 7, 1, 1, 0, ''),
(55, 59, 7, 1, 1, 0, ''),
(56, 60, 7, 1, 1, 0, ''),
(57, 61, 7, 1, 1, 0, ''),
(58, 62, 7, 1, 1, 0, ''),
(59, 64, 7, 1, 1, 0, ''),
(60, 66, 7, 1, 1, 0, ''),
(61, 67, 7, 1, 1, 0, ''),
(62, 1, 6, 11, 1, 0, ''),
(63, 3, 6, 11, 1, 0, ''),
(64, 4, 6, 11, 1, 0, ''),
(65, 5, 6, 11, 1, 0, ''),
(66, 6, 6, 11, 1, 0, ''),
(67, 7, 6, 11, 1, 0, ''),
(68, 10, 6, 11, 1, 0, ''),
(69, 11, 6, 11, 1, 0, ''),
(70, 13, 6, 11, 1, 0, ''),
(71, 18, 6, 11, 1, 0, ''),
(72, 1, 11, 2, 1, 90, '');

-- --------------------------------------------------------

--
-- Table structure for table `opening_amount`
--

CREATE TABLE `opening_amount` (
  `opening_amount_id` int(11) NOT NULL,
  `opening_amount` varchar(155) DEFAULT NULL,
  `added_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `opening_amount`
--

INSERT INTO `opening_amount` (`opening_amount_id`, `opening_amount`, `added_date`) VALUES
(1, '300', '2018-06-09 23:00:34'),
(2, '400', '2018-06-10 00:00:40'),
(14, '3', '2018-06-10 12:40:20'),
(15, '343', '2018-06-10 12:44:51'),
(16, '34', '2018-07-08 12:39:02');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `Order_id` int(10) NOT NULL,
  `Table_id` int(10) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `order_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`Order_id`, `Table_id`, `Timestamp`, `order_type`) VALUES
(1, 2, '2018-06-10 21:15:11', 'Dine In'),
(2, 2, '2018-06-10 21:15:12', 'Dine In'),
(3, 99, '2018-06-10 21:19:53', 'Take Away'),
(4, 5, '2018-06-10 21:20:52', 'Dine In'),
(5, 1, '2018-06-10 21:21:35', ''),
(6, 2, '2018-06-10 21:25:07', 'Dine In'),
(7, 2, '2018-06-10 21:25:08', 'Dine In'),
(8, 3, '2018-06-10 21:54:51', 'Dine In'),
(9, 6, '2018-06-10 22:02:56', 'Dine In'),
(10, 5, '2018-06-10 22:27:41', 'Dine In'),
(13, 2, '2018-06-10 22:45:21', 'Dine In'),
(14, 4, '2018-06-10 23:14:36', 'Dine In'),
(15, 7, '2018-06-10 23:16:07', 'Dine In'),
(16, 4, '2018-06-10 23:21:23', 'Dine In'),
(17, 4, '2018-06-10 23:21:24', 'Dine In'),
(18, 99, '2018-06-10 23:22:50', 'Take Away'),
(19, 1, '2018-06-10 23:40:59', 'Dine In'),
(20, 4, '2018-06-11 07:35:54', 'Dine In'),
(21, 4, '2018-06-11 07:58:49', 'Dine In'),
(22, 1, '2018-06-11 09:26:09', 'Dine In'),
(23, 2, '2018-06-11 09:31:15', 'Dine In'),
(24, 1, '2018-06-11 09:31:58', 'Dine In'),
(25, 3, '2018-06-11 09:44:13', 'Dine In'),
(26, 4, '2018-06-11 12:41:59', 'Dine In'),
(27, 4, '2018-06-11 12:42:16', 'Dine In'),
(28, 3, '2018-06-11 12:53:41', 'Dine In'),
(29, 4, '2018-06-11 12:54:29', 'Dine In'),
(30, 4, '2018-06-11 13:45:08', 'Dine In'),
(31, 8, '2018-06-11 13:51:51', 'Dine In'),
(32, 5, '2018-06-25 18:27:40', ''),
(33, 6, '2018-06-25 18:32:02', ''),
(34, 3, '2018-06-25 19:47:02', ''),
(35, 4, '2018-06-26 17:08:16', ''),
(36, 7, '2018-06-26 17:13:04', ''),
(37, 5, '2018-06-27 15:39:51', ''),
(38, 5, '2018-06-27 15:52:10', ''),
(39, 5, '2018-06-27 19:11:04', ''),
(40, 5, '2018-07-03 08:16:31', ''),
(41, 5, '2018-07-03 08:32:19', ''),
(42, 5, '2018-07-03 16:01:44', 'Dine In'),
(43, 3, '2018-07-08 10:39:28', 'Dine In'),
(44, 1, '2018-07-08 11:16:18', 'Dine In'),
(45, 3, '2018-07-08 12:19:49', 'Dine In'),
(46, 3, '2018-07-08 12:42:23', 'Dine In'),
(47, 3, '2018-07-08 12:44:18', 'Dine In'),
(48, 3, '2018-07-08 12:47:11', 'Dine In'),
(49, 6, '2018-07-08 12:53:37', 'Dine In'),
(50, 2, '2018-07-09 18:09:26', 'Dine In'),
(51, 5, '2018-07-09 19:27:12', 'Dine In'),
(52, 4, '2018-07-09 19:28:57', 'Dine In'),
(53, 4, '2018-07-09 20:38:51', 'Dine In'),
(54, 3, '2018-07-14 07:19:32', ''),
(55, 2, '2018-07-14 08:16:34', '');

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `id` int(11) NOT NULL,
  `Order_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `Timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `seen` int(11) NOT NULL,
  `seen_timestamp` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`id`, `Order_id`, `status`, `Timestamp`, `seen`, `seen_timestamp`) VALUES
(1, 2, 4, '2018-06-10 21:15:12', 0, NULL),
(2, 3, 3, '2018-06-10 21:19:53', 0, NULL),
(3, 4, 4, '2018-06-10 21:20:52', 0, NULL),
(4, 5, 4, '2018-06-10 21:21:35', 0, NULL),
(5, 7, 4, '2018-06-10 21:25:08', 0, NULL),
(6, 8, 4, '2018-06-10 21:54:51', 0, NULL),
(7, 9, 4, '2018-06-10 22:02:56', 0, NULL),
(8, 10, 4, '2018-06-10 22:27:41', 0, NULL),
(11, 13, 1, '2018-06-10 22:45:21', 0, NULL),
(12, 14, 4, '2018-06-10 23:14:36', 0, NULL),
(13, 15, 4, '2018-06-10 23:16:07', 0, NULL),
(14, 17, 4, '2018-06-10 23:21:24', 0, NULL),
(15, 18, 4, '2018-06-10 23:22:50', 0, NULL),
(16, 19, 4, '2018-06-10 23:40:59', 0, NULL),
(17, 20, 1, '2018-06-11 07:35:54', 0, NULL),
(18, 21, 1, '2018-06-11 07:58:49', 0, NULL),
(19, 22, 3, '2018-06-11 09:26:09', 0, NULL),
(20, 23, 3, '2018-06-11 09:31:15', 0, NULL),
(21, 24, 3, '2018-06-11 09:31:58', 0, NULL),
(22, 25, 3, '2018-06-11 09:44:13', 0, NULL),
(23, 26, 1, '2018-06-11 12:41:59', 0, NULL),
(24, 27, 3, '2018-06-11 12:42:16', 0, NULL),
(25, 28, 4, '2018-06-11 12:53:41', 0, NULL),
(26, 29, 4, '2018-06-11 12:54:29', 0, NULL),
(27, 30, 4, '2018-06-11 13:45:08', 0, NULL),
(28, 31, 4, '2018-06-11 13:51:51', 0, NULL),
(29, 32, 1, '2018-06-25 18:27:41', 0, NULL),
(30, 33, 3, '2018-06-25 18:32:02', 1, NULL),
(31, 34, 3, '2018-06-25 19:47:02', 1, NULL),
(32, 35, 3, '2018-06-26 17:08:16', 0, NULL),
(33, 36, 1, '2018-06-26 17:13:04', 1, NULL),
(34, 37, 2, '2018-06-27 15:39:51', 1, NULL),
(35, 38, 3, '2018-06-27 17:33:11', 0, NULL),
(36, 39, 1, '2018-06-27 19:11:04', 0, NULL),
(37, 40, 3, '2018-07-03 08:16:31', 1, NULL),
(38, 41, 3, '2018-07-03 08:32:19', 1, '2018-07-03 08:33:49'),
(39, 42, 4, '2018-07-03 16:01:44', 0, NULL),
(40, 43, 1, '2018-07-08 10:39:28', 0, NULL),
(41, 44, 1, '2018-07-08 11:16:18', 0, NULL),
(42, 45, 1, '2018-07-08 12:19:49', 0, NULL),
(43, 46, 4, '2018-07-08 12:42:23', 0, NULL),
(44, 47, 1, '2018-07-08 12:44:18', 0, NULL),
(45, 48, 4, '2018-07-08 12:47:11', 0, NULL),
(46, 49, 1, '2018-07-08 12:53:37', 0, NULL),
(47, 50, 1, '2018-07-09 18:09:26', 0, NULL),
(48, 51, 4, '2018-07-09 19:27:12', 0, NULL),
(49, 52, 1, '2018-07-09 19:28:57', 0, NULL),
(50, 53, 4, '2018-07-09 20:38:51', 1, '2018-07-09 20:40:35'),
(51, 54, 0, '2018-07-14 07:19:32', 0, NULL),
(52, 55, 0, '2018-07-14 08:16:34', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payment_details`
--

CREATE TABLE `payment_details` (
  `payment_details_id` int(11) NOT NULL,
  `Order_id` int(11) DEFAULT NULL,
  `payment_type` varchar(55) DEFAULT NULL,
  `total_amount` varchar(255) DEFAULT NULL,
  `given_amount` varchar(255) DEFAULT NULL,
  `return_amount` varchar(255) DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL,
  `added_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_details`
--

INSERT INTO `payment_details` (`payment_details_id`, `Order_id`, `payment_type`, `total_amount`, `given_amount`, `return_amount`, `added_by`, `added_date`) VALUES
(1, 5, 'Online', '189', '189', '0', NULL, NULL),
(2, 7, 'Online', '1200', '1200', '0', NULL, NULL),
(3, 8, 'Card', '360', '360', '0', NULL, NULL),
(4, 9, 'Online', '540', '540', '0', NULL, NULL),
(5, 10, 'Cash', '360', '400', '40', NULL, NULL),
(6, 14, 'Cash', '480', '500', '20', NULL, NULL),
(7, 15, 'Online', '118415', '118415', '0', NULL, NULL),
(8, 17, 'Online', '23483', '23483', '0', NULL, NULL),
(9, 18, 'Cash', '1000', '1000', '0', NULL, NULL),
(10, 19, 'Cash', '800', '2000', '1200', NULL, NULL),
(11, 28, 'Cash', '600', '600', '0', NULL, NULL),
(12, 29, 'Online', '330', '330', '0', NULL, NULL),
(13, 30, 'Online', '70', '70', '0', NULL, NULL),
(14, 30, 'Online', '70', '70', '0', NULL, NULL),
(15, 31, 'Online', '1120', '1120', '0', NULL, NULL),
(16, 42, 'Online', '140', '140', '0', NULL, '2018-07-03 18:11:17'),
(17, 46, 'Online', '900', '900', '0', NULL, '2018-07-08 14:46:32'),
(18, 48, 'Card', '890', '890', '0', NULL, '2018-07-08 14:52:47'),
(19, 51, 'Cash', '220', '220', '0', NULL, '2018-07-09 21:28:20'),
(20, 53, 'Card', '165', '165', '0', NULL, '2018-07-09 22:40:50');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `sales_id` int(10) NOT NULL,
  `Order_id` int(10) NOT NULL,
  `cgst` float NOT NULL,
  `sgst` float NOT NULL,
  `net_total` float NOT NULL,
  `coupon_apply` int(11) DEFAULT NULL,
  `coupon_code` varchar(255) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `customer_id` int(11) DEFAULT NULL,
  `login_type` varchar(20) DEFAULT NULL,
  `refund` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`sales_id`, `Order_id`, `cgst`, `sgst`, `net_total`, `coupon_apply`, `coupon_code`, `Timestamp`, `customer_id`, `login_type`, `refund`) VALUES
(1, 5, 4.5, 4.5, 189, NULL, '', '2018-06-10 21:21:56', 1, 'mobile', 0),
(2, 7, 0, 0, 1200, NULL, '', '2018-06-10 21:25:18', 2, 'Manual', 0),
(3, 8, 0, 0, 360, NULL, '', '2018-06-10 21:55:00', 1, 'Manual', 0),
(4, 9, 0, 0, 540, NULL, '', '2018-06-10 22:03:31', 1, 'Manual', 0),
(5, 10, 0, 0, 360, NULL, '', '2018-06-10 22:27:52', 2, 'Manual', 0),
(6, 14, 0, 0, 480, NULL, '', '2018-06-10 23:14:47', 2, 'Manual', 0),
(7, 15, 0, 0, 118415, NULL, '', '2018-06-10 23:20:21', 1, 'Manual', 0),
(8, 17, 0, 0, 23483, NULL, '', '2018-06-10 23:21:32', 3, 'Manual', 0),
(9, 18, 0, 0, 1000, NULL, '', '2018-06-10 23:23:11', 3, 'Manual', 0),
(10, 19, 0, 0, 800, NULL, '', '2018-06-10 23:41:09', 1, 'Manual', 0),
(11, 22, 0, 0, 400, NULL, '', '2018-06-11 09:26:19', 1, 'Manual', 0),
(12, 23, 0, 0, 260, NULL, '', '2018-06-11 09:31:29', 3, 'Manual', 0),
(13, 24, 0, 0, 360, NULL, '', '2018-06-11 09:32:04', 2, 'Manual', 0),
(14, 25, 0, 0, 180, NULL, '', '2018-06-11 09:44:21', 3, 'Manual', 0),
(15, 27, 0, 0, 510, NULL, '', '2018-06-11 12:42:46', 1, 'Manual', 0),
(16, 28, 0, 0, 600, NULL, '', '2018-06-11 12:53:49', 2, 'Manual', 0),
(17, 29, 0, 0, 330, NULL, '', '2018-06-11 12:54:39', 1, 'Manual', 0),
(18, 30, 0, 0, 70, NULL, '', '2018-06-11 13:45:21', 3, 'Manual', 0),
(19, 31, 0, 0, 1120, NULL, '', '2018-06-11 13:52:05', 1, 'Manual', 0),
(20, 33, 13.5, 13.5, 567, NULL, '', '2018-06-25 19:41:41', 4, 'mobile', 0),
(21, 35, 0, 0, 0, NULL, '', '2018-06-26 17:08:35', 1, 'mobile', 0),
(22, 35, 8.5, 8.5, 357, NULL, '', '2018-06-26 17:10:41', 1, 'mobile', 0),
(23, 37, 3.5, 3.5, 147, NULL, '', '2018-06-27 15:51:14', 1, 'mobile', 0),
(24, 38, 9.375, 9.375, 393.75, NULL, '', '2018-06-27 18:09:01', 1, 'mobile', 0),
(25, 42, 0, 0, 140, NULL, '', '2018-07-03 16:01:49', 3, 'Manual', 0),
(26, 46, 0, 0, 900, NULL, '', '2018-07-08 12:42:28', 3, 'Manual', 0),
(27, 47, 0, 0, 375, NULL, '', '2018-07-08 12:44:20', 1, 'Manual', 0),
(28, 48, 0, 0, 890, NULL, '', '2018-07-08 12:52:14', 1, 'Manual', 0),
(29, 49, 0, 0, 680, NULL, '', '2018-07-08 12:54:44', 1, 'Manual', 0),
(30, 50, 0, 0, 1145, NULL, '', '2018-07-09 19:26:18', 3, 'Manual', 0),
(31, 51, 0, 0, 220, NULL, '', '2018-07-09 19:27:30', 1, 'Manual', 0),
(32, 52, 0, 0, 620, NULL, '', '2018-07-09 20:00:29', 1, 'Manual', 0),
(33, 53, 0, 0, 165, NULL, '', '2018-07-09 20:39:42', 1, 'Manual', 0);

-- --------------------------------------------------------

--
-- Table structure for table `staff_management`
--

CREATE TABLE `staff_management` (
  `id` int(255) NOT NULL,
  `name` varchar(20) NOT NULL,
  `salary` int(255) NOT NULL,
  `shifts` time NOT NULL,
  `chores` varchar(20) NOT NULL,
  `table_no` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff_management`
--

INSERT INTO `staff_management` (`id`, `name`, `salary`, `shifts`, `chores`, `table_no`) VALUES
(23, 'Ankit', 20000, '14:00:00', 'Chef', 87),
(32, 'Srijan', 20000, '09:00:00', 'Chef', 22);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mobile` (`mobile`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `background_image`
--
ALTER TABLE `background_image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `batter`
--
ALTER TABLE `batter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `customer_id_2` (`customer_id`);

--
-- Indexes for table `customer_order`
--
ALTER TABLE `customer_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Menu_constraint` (`Menu_Id`),
  ADD KEY `Order_constraint` (`Order_id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fake_order`
--
ALTER TABLE `fake_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fonts`
--
ALTER TABLE `fonts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hotel_name_addr`
--
ALTER TABLE `hotel_name_addr`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ingredients`
--
ALTER TABLE `ingredients`
  ADD PRIMARY KEY (`Ingredients_id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`inventory_id`);

--
-- Indexes for table `logo`
--
ALTER TABLE `logo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`Menu_Id`,`Name`);

--
-- Indexes for table `menu_batter_rel`
--
ALTER TABLE `menu_batter_rel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_ingridient_rel`
--
ALTER TABLE `menu_ingridient_rel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_id_constraint` (`Menu_id`),
  ADD KEY `Ingredients_id` (`Ingredients_id`),
  ADD KEY `Ingredients_id_2` (`Ingredients_id`);

--
-- Indexes for table `opening_amount`
--
ALTER TABLE `opening_amount`
  ADD PRIMARY KEY (`opening_amount_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`Order_id`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_status` (`Order_id`);

--
-- Indexes for table `payment_details`
--
ALTER TABLE `payment_details`
  ADD PRIMARY KEY (`payment_details_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`sales_id`),
  ADD KEY `sale_order` (`Order_id`);

--
-- Indexes for table `staff_management`
--
ALTER TABLE `staff_management`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `background_image`
--
ALTER TABLE `background_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `batter`
--
ALTER TABLE `batter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `customer_order`
--
ALTER TABLE `customer_order`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;
--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `fake_order`
--
ALTER TABLE `fake_order`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT for table `fonts`
--
ALTER TABLE `fonts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `hotel_name_addr`
--
ALTER TABLE `hotel_name_addr`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ingredients`
--
ALTER TABLE `ingredients`
  MODIFY `Ingredients_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `inventory_id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `logo`
--
ALTER TABLE `logo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `Menu_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;
--
-- AUTO_INCREMENT for table `menu_batter_rel`
--
ALTER TABLE `menu_batter_rel`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `menu_ingridient_rel`
--
ALTER TABLE `menu_ingridient_rel`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;
--
-- AUTO_INCREMENT for table `opening_amount`
--
ALTER TABLE `opening_amount`
  MODIFY `opening_amount_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `Order_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
--
-- AUTO_INCREMENT for table `payment_details`
--
ALTER TABLE `payment_details`
  MODIFY `payment_details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `sales_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer_order`
--
ALTER TABLE `customer_order`
  ADD CONSTRAINT `Order_constraint` FOREIGN KEY (`Order_id`) REFERENCES `orders` (`Order_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_status`
--
ALTER TABLE `order_status`
  ADD CONSTRAINT `order_status` FOREIGN KEY (`Order_id`) REFERENCES `orders` (`Order_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sale_order` FOREIGN KEY (`Order_id`) REFERENCES `orders` (`Order_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
