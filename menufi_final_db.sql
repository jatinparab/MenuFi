-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 29, 2018 at 07:56 AM
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
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`id`, `mobile`, `address`) VALUES
(1, '9820181342', 'Test address');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin');

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
(1, '9820181347', '', '1', 1, 0, '2018-04-29 11:18:46'),
(2, '9820181342', '', '0', 2, 0, '2018-04-29 11:24:28');

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
(1, 1, 3, 1, NULL, 0, NULL, 'comments', 2, NULL, NULL),
(2, 3, 21, 2, '', 1, NULL, 'comments', 2, NULL, 2);

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
(2, 'self-raising flour', 68, 20, 2, 15),
(3, 'chilli powder', 48, 40, 1, 13),
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
  `addons` int(11) DEFAULT '0' COMMENT '0-mandatory 2-optional 1-addon '
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu_ingridient_rel`
--

INSERT INTO `menu_ingridient_rel` (`id`, `Menu_id`, `Ingredients_id`, `quantity_rel`, `addons`) VALUES
(13, 3, 2, 2, 1),
(14, 3, 4, 2, 1);

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
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `Order_id` int(10) NOT NULL,
  `Table_id` int(10) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`Order_id`, `Table_id`, `Timestamp`) VALUES
(1, 3, '2018-04-29 05:48:49'),
(2, -1, '2018-04-29 05:54:27'),
(3, 0, '2018-04-29 05:54:28');

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
(1, 1, 4, '2018-04-29 05:48:49', 0),
(2, 3, 3, '2018-04-29 05:54:28', 0);

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
(1, 1, 4.5, 4.5, 189, NULL, '', '2018-04-29 05:50:05', 1, 'mobile', 0),
(2, 3, 0.325, 0.325, 13.65, NULL, '', '2018-04-29 05:54:50', 2, 'Manual', 0);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
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
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `fake_order`
--
ALTER TABLE `fake_order`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
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
  MODIFY `Menu_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT for table `menu_ingridient_rel`
--
ALTER TABLE `menu_ingridient_rel`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `nutrition`
--
ALTER TABLE `nutrition`
  MODIFY `Id` int(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `Order_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `sales_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer_order`
--
ALTER TABLE `customer_order`
  ADD CONSTRAINT `Order_constraint` FOREIGN KEY (`Order_id`) REFERENCES `orders` (`Order_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `menu_ingridient_rel`
--
ALTER TABLE `menu_ingridient_rel`
  ADD CONSTRAINT `ingredient_id_constraint` FOREIGN KEY (`Ingredients_id`) REFERENCES `ingredients` (`Ingredients_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `menu_id_constraint` FOREIGN KEY (`Menu_id`) REFERENCES `menu` (`Menu_Id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
