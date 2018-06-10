-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 11, 2018 at 01:42 AM
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
(1, 'Batter 1'),
(2, 'Batter 2'),
(4, 'New batter test');

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
(6, 'Beer'),
(7, 'Scotch'),
(8, 'SeaFood'),
(9, 'Tandoori Specials'),
(10, 'Vegetable Dishes'),
(12, 'Side Orders - Bread'),
(13, 'Side Orders - Sundries');

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
(1, '9820181347', '', '1', 12, 0, '2018-06-11 05:10:59'),
(2, '9820181343', '', '0', 4, 0, '2018-06-11 04:44:36'),
(3, '9820181341', '', '0', 3, 0, '2018-06-11 04:52:50');

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
(20, 15, 3, 1, '2,', 1, NULL, 'comments', 2, NULL, 1),
(21, 15, 4, 1, '4,', 1, NULL, 'comments', 2, NULL, 1),
(22, 17, 4, 1, '4,', 1, NULL, 'comments', 2, NULL, 3),
(23, 18, 3, 5, '2,', 4, NULL, 'comments', 2, NULL, 3),
(24, 19, 3, 4, '2,', 4, NULL, 'comments', 2, NULL, 1);

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
  `date` varchar(2555) NOT NULL,
  `time` varchar(2555) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `nameOfPerson`, `amount`, `type`, `reason`, `date`, `time`, `name`) VALUES
(1, 'general', 0, 'dcdf', '', '', '', ''),
(2, 'general', 0, 'dcdf', '', '', '', ''),
(3, 'grossary', 0, '200', '', '', '', ''),
(4, 'grossary', 0, 'DJNFJKD', '', '', '', ''),
(5, '', 0, '', '', '', '', ''),
(6, 'Jatin', 3, 'general', '3', '2018-06-07', '11:11', '32');

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
(6, 'potatoes', 40, 0, 0, 2),
(7, 'onions', 280, 0, 0, 10),
(8, 'spring onions', 130, 0, 0, 22),
(9, 'spinach leaves', 100, 0, 0, 12),
(10, 'green chilli', 80, 0, 0, 11),
(11, 'salt', 320, 0, 0, 22),
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
(3, 'Tuborg', 180, 'Light beer', 'Liquor', 'Beer', 'tuborg.jpg', '2', 1),
(4, 'Kingfisher Mild', 150, 'Light beer', 'Liquor', 'Beer', 'Kingfisher_Mild.jpg', '3', NULL),
(5, 'Double Black', 600, 'Scotch', 'Liquor', 'Scotch', 'double_black.jpg', '4', NULL),
(11, 'Tandoori King Prawn', 6.95, 'test', 'Non-Veg', 'Beer', 'dj3.png', '2', 2),
(12, 'King Prawn Rosun', 5.95, '', 'Non-Veg', 'SeaFood', '', '1', 1),
(13, 'King Prawn on Puree', 5.95, '', 'Non-Veg', 'SeaFood', '', '3', NULL),
(14, 'Prawn Bhuna on Puree', 3.95, '', 'Non-Veg', 'SeaFood', '', '4', NULL),
(15, 'Prawn Cocktail', 3.95, '', 'Non-Veg', 'SeaFood', '', '1', NULL),
(16, 'Chi/Lam Sashlik Chi', 9.95, '', 'Non-Veg', 'Tandoori Specials', '', '12', NULL),
(17, 'Tandoori Deluxe', 12.95, '', 'Non-Veg', 'Tandoori Specials', '', '2', NULL),
(18, 'Tandoori Chicken Main', 9.95, '', 'Non-Veg', 'Tandoori Specials', '', '3', NULL),
(19, 'Chicken Tikka', 7.95, '', 'Non-Veg', 'Tandoori Specials', '', NULL, NULL),
(20, 'Lamb Tikka', 9.95, '', 'Non-Veg', 'Tandoori Specials', '', NULL, NULL),
(21, 'Bombay Aloo ', 6.5, '', 'Veg', 'Vegetable Dishes', '', NULL, NULL),
(22, 'Mushroom Bhaji ', 6.5, '', 'Veg', 'Vegetable Dishes', '', NULL, NULL),
(23, 'Saag Dall', 6.5, '', 'Veg', 'Vegetable Dishes', '', NULL, NULL),
(24, 'Mattor Paneer', 6.5, '', 'Veg', 'Vegetable Dishes', '', NULL, NULL),
(25, 'Vegetable Roshun', 6.5, '', 'Veg', 'Vegetable Dishes', '', NULL, NULL),
(29, 'Garlic Naan', 3, '', 'Veg', 'Side Orders - Bread', '', NULL, NULL),
(30, 'Stuffed Naan', 3.5, '', 'Veg', 'Side Orders - Bread', '', NULL, NULL),
(31, 'Chapati', 1, '', 'Veg', 'Side Orders - Bread', '', NULL, NULL),
(32, 'Green Salad', 2, '', 'Veg', 'Side Orders - Sundries', '', NULL, NULL),
(33, 'Spice Popadum', 0.8, '', 'Veg', 'Side Orders - Sundries', '', NULL, NULL),
(34, 'Chutney', 0.7, '', 'Veg', 'Side Orders - Sundries', '', NULL, NULL);

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
  `addon_price` text NOT NULL,
  `batters` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu_ingridient_rel`
--

INSERT INTO `menu_ingridient_rel` (`id`, `Menu_id`, `Ingredients_id`, `quantity_rel`, `addons`, `addon_price`, `batters`) VALUES
(1, 29, 3, 10, 1, '20', ''),
(2, 3, 2, 10, 1, '20', ''),
(3, 3, 3, 12, 1, '80', ''),
(4, 15, 11, 2, 1, '', ''),
(5, 20, 10, 12, 1, '', ''),
(7, 4, 4, 213123, 1, '23333', '');

-- --------------------------------------------------------

--
-- Table structure for table `nutrition`
--

CREATE TABLE `nutrition` (
  `Id` int(20) NOT NULL,
  `Calories` int(10) DEFAULT NULL,
  `Protein` float DEFAULT NULL,
  `Carbs` float DEFAULT NULL,
  `Fats` float DEFAULT NULL,
  `Menu_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(15, '343', '2018-06-10 12:44:51');

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
(19, 1, '2018-06-10 23:40:59', 'Dine In');

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `id` int(11) NOT NULL,
  `Order_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `Timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `seen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`id`, `Order_id`, `status`, `Timestamp`, `seen`) VALUES
(1, 2, 4, '2018-06-10 21:15:12', 0),
(2, 3, 3, '2018-06-10 21:19:53', 0),
(3, 4, 4, '2018-06-10 21:20:52', 0),
(4, 5, 4, '2018-06-10 21:21:35', 0),
(5, 7, 4, '2018-06-10 21:25:08', 0),
(6, 8, 4, '2018-06-10 21:54:51', 0),
(7, 9, 4, '2018-06-10 22:02:56', 0),
(8, 10, 4, '2018-06-10 22:27:41', 0),
(11, 13, 1, '2018-06-10 22:45:21', 0),
(12, 14, 4, '2018-06-10 23:14:36', 0),
(13, 15, 4, '2018-06-10 23:16:07', 0),
(14, 17, 4, '2018-06-10 23:21:24', 0),
(15, 18, 4, '2018-06-10 23:22:50', 0),
(16, 19, 4, '2018-06-10 23:40:59', 0);

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
(10, 19, 'Cash', '800', '2000', '1200', NULL, NULL);

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
(10, 19, 0, 0, 800, NULL, '', '2018-06-10 23:41:09', 1, 'Manual', 0);

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
-- Indexes for table `menu_ingridient_rel`
--
ALTER TABLE `menu_ingridient_rel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_id_constraint` (`Menu_id`),
  ADD KEY `Ingredients_id` (`Ingredients_id`),
  ADD KEY `Ingredients_id_2` (`Ingredients_id`);

--
-- Indexes for table `nutrition`
--
ALTER TABLE `nutrition`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `nutrition_ibfk_1` (`Menu_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `customer_order`
--
ALTER TABLE `customer_order`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `fake_order`
--
ALTER TABLE `fake_order`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
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
  MODIFY `Menu_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `menu_ingridient_rel`
--
ALTER TABLE `menu_ingridient_rel`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `nutrition`
--
ALTER TABLE `nutrition`
  MODIFY `Id` int(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `opening_amount`
--
ALTER TABLE `opening_amount`
  MODIFY `opening_amount_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `Order_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `payment_details`
--
ALTER TABLE `payment_details`
  MODIFY `payment_details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `sales_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer_order`
--
ALTER TABLE `customer_order`
  ADD CONSTRAINT `Order_constraint` FOREIGN KEY (`Order_id`) REFERENCES `orders` (`Order_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `nutrition`
--
ALTER TABLE `nutrition`
  ADD CONSTRAINT `nutrition_ibfk_1` FOREIGN KEY (`Menu_id`) REFERENCES `menu` (`Menu_Id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
