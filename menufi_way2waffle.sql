-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 11, 2018 at 03:46 PM
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
(1, 'Waffle shots'),
(2, 'Signature Waffles'),
(3, 'Premium collection'),
(4, 'Oreo magic'),
(5, 'Fiery fries'),
(6, 'Drinks'),
(7, 'Shakes'),
(8, 'HOT DRINKS'),
(9, 'MINI PANCAKES');

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
(1, '9999999999', '', '1', 4, 0, '2018-09-11 18:00:28'),
(2, '9999999993', '', '0', 3, 0, '2018-09-11 17:57:25');

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
(1, 3, 1, 1, NULL, 0, NULL, 'comments', 2, NULL, NULL),
(2, 4, 4, 1, '1', 0, NULL, 'comments', 2, NULL, 1),
(3, 5, 7, 1, '1', 0, NULL, 'comments', 2, NULL, 1),
(4, 7, 4, 1, '', 0, NULL, 'comments', 2, NULL, 2),
(5, 7, 3, 1, '', 0, NULL, 'comments', 2, NULL, 2),
(6, 8, 6, 1, '', 0, NULL, 'comments', 2, NULL, 2),
(7, 9, 4, 1, '', 0, NULL, 'comments', 2, NULL, 1);

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
(1, 'Crushed Oreo', 10000, 1000, 0, 20),
(2, 'Sprinkles', 1000, 1, 0, 20),
(3, 'Brownie Base', 1000, 1, 1, 20),
(4, 'Whipped Cream', 1000, 1, 1, 30),
(5, 'Extra Chocolate', 100000, 101, 210, 30),
(6, 'Extra Nuts', 100000000, 999, 0, 40),
(7, 'Ice-Cream', 1000, 10, 11, 40),
(8, 'Extra Nutella', 10000, 10, 1, 40),
(9, 'Belgium Ice Cream', 1000, 1, 1, 60),
(10, 'Belgium Chocolate', 10000, 20, 1, 60),
(11, 'Sauces', 10000, 10, 1, 20),
(12, 'Choco Chips', 10000, 12, 1, 20);

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
(1, 'Classic shots', 49, 'cs', 'Veg', 'Waffle', 'chocolate dosa.JPG', '15', 1),
(2, 'Chocolate shots', 79, 'cs', 'Veg', 'Waffle', 'chocolate dosa.JPG', '15', 1),
(3, 'Simply best', 99, 'sb', 'Veg', 'Signature', 'chocolate dosa.JPG', '15', 1),
(4, 'Salted caramel', 120, 'sc', 'Veg', 'Signature', 'chocolate dosa.JPG', '15', 1),
(5, 'Blueberry cream cheese', 130, 'bcc', 'Veg', 'Signature', 'chocolate dosa.JPG', '15', 1),
(6, 'Strawberry cream cheese', 130, 'scc', 'Veg', 'Signature', 'chocolate dosa.JPG', '15', 1),
(7, 'Crunchy Butterscotch', 130, 'cc', 'Veg', 'Signature', 'chocolate dosa.JPG', '15', 1),
(8, 'Coffee twist', 130, 'ct', 'Veg', 'Signature', 'chocolate dosa.JPG', '15', 1),
(9, 'Crazy Nutella', 140, 'cn', 'Veg', 'Signature', 'chocolate dosa.JPG', '15', 1),
(10, 'Milky way', 140, 'mw', 'Veg', 'Signature', 'chocolate dosa.JPG', '15', 1),
(11, 'Dark knight', 140, 'dk', 'Veg', 'Signature', 'chocolate dosa.JPG', '15', 1),
(12, 'White fairy', 140, 'wf', 'Veg', 'Signature', 'chocolate dosa.JPG', '15', 1),
(13, 'Dark and white fantasy', 140, 'dwf', 'Veg', 'Signature', 'chocolate dosa.JPG', '15', 1),
(14, 'Red velvet', 140, 'rv', 'Veg', 'Premium', 'veeg uthppa.jpg', '15', 1),
(15, 'Choco Hazelnut', 159, 'ch', 'Veg', 'Premium', 'chocolate dosa.JPG', '15', 1),
(16, 'Nutty delight', 159, 'nd', 'Veg', 'Premium', 'chocolate dosa.JPG', '15', 1),
(17, 'Belgium bliss', 159, 'bb', 'Veg', 'Premium', 'chocolate dosa.JPG', '15', 1),
(18, 'Crazy gothwich', 179, 'cg', 'Veg', 'Premium', 'chocolate dosa.JPG', '15', 1),
(19, 'Black forest ', 179, 'bf', 'Veg', 'Premium', 'chocolate dosa.JPG', '15', 1),
(20, 'Ferrero fun', 295, 'ff', 'Veg', 'Oreo', 'chocolate dosa.JPG', '15', 1),
(21, 'chocolate avalanche', 295, 'ca', 'Veg', 'Oreo', 'chocolate dosa.JPG', '15', 1),
(22, 'Plain and simple fries', 99, 'psf', 'Veg', 'Fiery', 'waffle bg.jpg', '15', 1),
(23, 'Peri peri fries ', 119, 'ppf', 'Veg', 'Fiery', 'waffle bg.jpg', '15', 1),
(24, 'Cheesy mess', 119, 'cm', 'Veg', 'Fiery', 'waffle bg.jpg', '15', 1),
(25, 'Cheesy barbeque sauce', 119, 'cbs', 'Veg', 'Fiery', 'waffle bg.jpg', '15', 1),
(26, 'Pizza fries', 139, 'pf', 'Veg', 'Fiery', 'waffle bg.jpg', '15', 1),
(27, 'Mexican nacho fries', 139, 'mcf', 'Veg', 'Fiery', 'waffle bg.jpg', '15', 1),
(28, 'Corn cheese blast', 149, 'ccb', 'Veg', 'Fiery', 'waffle bg.jpg', '15', 1),
(29, 'Fiery fries platter', 249, 'ffp', 'Veg', 'Fiery', 'waffle bg.jpg', '15', 1),
(30, 'Fresh Lime soda', 65, 'fls', 'Veg', 'Drinks', 'waffle bg.jpg', '15', 1),
(31, 'Virgin mojito', 75, 'vm', 'Veg', 'Drinks', 'waffle bg.jpg', '15', 1),
(32, 'Kiwi mojito', 85, 'km', 'Veg', 'Drinks', 'chocolate dosa.JPG', '15', 1),
(33, 'Blue storm', 85, 'bs', 'Veg', 'Drinks', 'chocolate dosa.JPG', '15', 1),
(34, 'Cold Coffee Kick', 165, 'a', 'Veg', 'Shakes', 'chocolate dosa.JPG', '15', 1),
(35, 'CHOCOLATE DECADENCE', 175, 'sda', 'Veg', 'Shakes', 'pancake.jpg', '15', 1),
(36, 'OREO FREAK SHAKE', 195, 'SA', 'Veg', 'Shakes', 'pancake.jpg', '15', 1),
(37, 'NUTELLA FREAK SHAKE', 195, 'DQ', 'Veg', 'Shakes', 'pancake.jpg', '15', 1),
(38, 'STRAWBERRY FREAK SHAKE', 195, 'FE', 'Veg', 'Shakes', 'chocolate dosa.JPG', '15', 1),
(39, 'TEA', 55, 'FF', 'Veg', 'HOT', 'chocolate dosa.JPG', '15', 1),
(40, 'LEMON TEA', 65, 'DAS', 'Veg', 'HOT', 'chocolate dosa.JPG', '15', 1),
(41, 'HOT COFFEE', 75, 'DQ', 'Veg', 'HOT', 'pancake.jpg', '15', 1),
(42, 'CHOCOLATE MILK', 75, 'DWQ', 'Veg', 'HOT', 'pancake.jpg', '15', 1),
(43, 'BADAM MILK', 75, 'DD', 'Veg', 'HOT', 'pancake.jpg', '15', 1),
(44, 'THE CLASSIC (MAPLE / HONEY)', 150, 'ADAD', 'Veg', 'MINI', 'chocolate dosa.JPG', '15', 1),
(45, 'TRIPLE CHOSCOLATE', 170, 'WRQR', 'Veg', 'MINI', 'pancake.jpg', '15', 1),
(46, 'JUST NUTELLA', 170, 'W', 'Veg', 'MINI', 'chocolate dosa.JPG', '15', 1),
(47, 'BERRIES & CHEESE', 170, 'RF', 'Veg', 'MINI', 'pancake.jpg', '15', 1),
(48, 'RED VELVET', 170, 'FE', 'Veg', 'MINI', 'veeg uthppa.jpg', '15', 1);

-- --------------------------------------------------------

--
-- Table structure for table `menu_batter_rel`
--

CREATE TABLE `menu_batter_rel` (
  `id` int(20) NOT NULL,
  `menu_id` int(20) NOT NULL,
  `batter_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

-- --------------------------------------------------------

--
-- Table structure for table `opening_amount`
--

CREATE TABLE `opening_amount` (
  `opening_amount_id` int(11) NOT NULL,
  `opening_amount` varchar(155) DEFAULT NULL,
  `added_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(1, 2, '2018-09-11 12:23:28', 'Dine In'),
(2, 2, '2018-09-11 12:23:29', 'Dine In'),
(3, 1, '2018-09-11 12:25:04', ''),
(4, 2, '2018-09-11 12:25:55', 'Dine In'),
(5, 3, '2018-09-11 12:26:22', 'Dine In'),
(6, 2, '2018-09-11 12:26:51', 'Dine In'),
(7, 2, '2018-09-11 12:26:51', 'Dine In'),
(8, 5, '2018-09-11 12:27:25', 'Dine In'),
(9, 33, '2018-09-11 12:30:28', 'Dine In');

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
(1, 3, 4, '2018-09-11 12:25:04', 0, NULL),
(2, 4, 4, '2018-09-11 12:25:55', 0, NULL),
(3, 5, 4, '2018-09-11 12:26:22', 0, NULL),
(4, 7, 4, '2018-09-11 12:26:51', 0, NULL),
(5, 8, 4, '2018-09-11 12:27:25', 0, NULL),
(6, 9, 4, '2018-09-11 12:30:28', 0, NULL);

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
(1, 3, 'Card', '51.45', '51.45', '0', NULL, '2018-09-11 14:25:49'),
(2, 4, 'Card', '120', '120', '0', NULL, '2018-09-11 14:26:12'),
(3, 5, 'Online', '130', '130', '0', NULL, '2018-09-11 14:26:40'),
(4, 7, 'Online', '219', '219', '0', NULL, '2018-09-11 14:27:06'),
(5, 8, 'Card', '130', '130', '0', NULL, '2018-09-11 14:30:21'),
(6, 9, 'Card', '120', '120', '0', NULL, '2018-09-11 14:30:59');

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
(1, 3, 1.225, 1.225, 51.45, NULL, '', '2018-09-11 12:25:25', 1, 'mobile', 0),
(2, 4, 0, 0, 120, NULL, '', '2018-09-11 12:25:59', 1, 'Manual', 0),
(3, 5, 0, 0, 130, NULL, '', '2018-09-11 12:26:27', 1, 'Manual', 0),
(4, 7, 0, 0, 219, NULL, '', '2018-09-11 12:26:55', 2, 'Manual', 0),
(5, 8, 0, 0, 130, NULL, '', '2018-09-11 12:27:29', 2, 'Manual', 0),
(6, 9, 0, 0, 120, NULL, '', '2018-09-11 12:30:31', 1, 'Manual', 0);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `customer_order`
--
ALTER TABLE `customer_order`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `fake_order`
--
ALTER TABLE `fake_order`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
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
  MODIFY `Ingredients_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
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
  MODIFY `Menu_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT for table `menu_batter_rel`
--
ALTER TABLE `menu_batter_rel`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `menu_ingridient_rel`
--
ALTER TABLE `menu_ingridient_rel`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `opening_amount`
--
ALTER TABLE `opening_amount`
  MODIFY `opening_amount_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `Order_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `payment_details`
--
ALTER TABLE `payment_details`
  MODIFY `payment_details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `sales_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
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
