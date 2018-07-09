-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 18, 2018 at 07:56 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
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
(4, '9820181343', '1', 'Uhu'),
(5, '9999988888', 'Test123', 'Test'),
(7, '9987333839', 'a-3 , 601 , vedhant', '1'),
(9, '9930520460', 'vedhant , c-5 402', 'mr. sammer'),
(10, '7021475977', 'Varuna-A,1504,Dosti vihar', 'Kiran kasbe'),
(12, '7045560301', 'VARUNA-C,504,DOSTI VIHAR', 'ANJALI'),
(14, '7045838706', 'A-3,502,RUNWAL PLAZA', 'KARISHMA'),
(18, '9999988881', '123', 'test'),
(19, '9632823345', 'VRITIKA-B,1402,DOSTI VIHAR', 'AJAY'),
(21, '9137968486', 'B-4 , 204, vedant complex', 's.s kadam'),
(22, '9769217599', '304 , neha , cours tower', 'Harsh'),
(24, '9819862967', 'B-4, 602 ,vedant', 'tanshika'),
(26, '9167931432', 'Anuradha, 301 ,  corese  nakshitra', 'sheal'),
(27, '9819502301', 'VRITIKA-A,1006,DOSTI VIHAR', 'NEHA'),
(29, '9511788842', 'BLDG.NO 4-A,403,DOSTI MMRDA OPPOSITE SHABRI REST', 'IMRAN FAIZAL'),
(31, '9137847087', 'A-4 , 703 rihang garden , samtanagar', '..'),
(32, '9923411713', '402,POORVA,KORAS NAKSHTRA', 'AMRITA'),
(35, '9146026125', '502,IRIS-C,UNNATHI GARDENS,DEVDAYA NAGAR,POKHRAN ROAD NO-2', 'SANDEEP PATIL'),
(37, '8879476135', 'B-7 304 , vedhant complex', 'shalaka kadam'),
(39, '9892115177', 'dosti vihar . , varuna A703', 'shalaka abyankar'),
(40, '9082921522', 'VEDANT,C-1,301', 'SANJAY'),
(41, '9820451132', 'vedant B-1 , 704', 'Dr'),
(43, '9833530817', 'vasanta A 202', '....');

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
(1, 'None'),
(5, 'Rice'),
(6, 'Neer'),
(7, 'Millet'),
(9, 'Rava');

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
(1, 'Dosa'),
(2, 'Uthappa'),
(3, 'Wraps'),
(4, 'Fusion'),
(5, 'Pardesi'),
(6, 'ThalI'),
(7, 'Desserts'),
(8, 'Beverages'),
(9, 'Sides'),
(10, 'Thanda Garam'),
(11, 'addons');

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
(1, '9820181347', '', '1', 1, 0, '2018-06-12 00:34:03'),
(2, '9999988888', '', '0', 120, 0, '2018-06-18 11:24:48'),
(3, '9146026125', '', '0', 34, 0, '2018-06-18 11:26:13'),
(4, '9930038889', '', '0', 13, 0, '2018-06-17 20:47:48'),
(5, '9769183885', '', '0', 2, 0, '2018-06-12 21:22:49'),
(6, '9987333839', '', '0', 2, 0, '2018-06-12 21:27:59'),
(7, '9930520460', '', '0', 4, 0, '2018-06-15 22:15:32'),
(8, '7021475977', '', '0', 2, 0, '2018-06-13 15:04:26'),
(9, '9987356888', '', '0', 3, 0, '2018-06-13 23:17:43'),
(10, '7045560301', '', '0', 2, 0, '2018-06-13 19:39:15'),
(11, '7045838706', '', '0', 2, 0, '2018-06-13 20:08:11'),
(12, '9999988881', '', '0', 2, 0, '2018-06-13 21:22:00'),
(13, '9632823345', '', '0', 2, 0, '2018-06-14 10:09:29'),
(14, '9892789115', '', '0', 2, 0, '2018-06-14 21:59:53'),
(15, '9137968486', '', '0', 3, 0, '2018-06-14 23:04:55'),
(16, '9769217599', '', '0', 2, 0, '2018-06-15 20:35:25'),
(17, '9819862967', '', '0', 2, 0, '2018-06-15 20:40:53'),
(18, '9167931432', '', '0', 2, 0, '2018-06-15 20:48:05'),
(19, '8692924499', '', '0', 2, 0, '2018-06-16 13:30:06'),
(20, '9819502301', '', '0', 2, 0, '2018-06-16 14:11:48'),
(21, '9511788842', '', '0', 2, 0, '2018-06-16 15:38:58'),
(22, '9137847087', '', '0', 2, 0, '2018-06-16 18:46:55'),
(23, '9923411713', '', '0', 2, 0, '2018-06-17 18:00:24'),
(24, '8879476135', '', '0', 2, 0, '2018-06-17 19:26:27'),
(25, '9892115177', '', '0', 7, 0, '2018-06-17 20:20:43'),
(26, '9082921522', '', '0', 2, 0, '2018-06-17 20:30:12'),
(27, '9819098961', '', '0', 1, 0, '2018-06-17 21:04:32'),
(28, '9820451132', '', '0', 2, 0, '2018-06-17 21:14:59'),
(29, '9892597911', '', '0', 2, 0, '2018-06-17 21:23:26'),
(30, '9833530817', '', '0', 4, 0, '2018-06-17 21:50:54'),
(31, '7738627637', '', '0', 2, 0, '2018-06-18 10:51:40');

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
(2, 3, 1, 2, '7,', 5, NULL, 'comments', 2, NULL, 2),
(3, 5, 1, 2, '7,', 5, NULL, 'comments', 2, NULL, 3),
(4, 7, 1, 2, '', 5, NULL, 'comments', 2, NULL, 2),
(5, 7, 1, 1, '', 5, NULL, 'comments', 2, NULL, 2),
(9, 13, 30, 1, '', 6, NULL, 'comments', 2, NULL, 2),
(10, 13, 45, 1, '', 7, NULL, 'comments', 2, NULL, 2),
(11, 13, 70, 1, '', 5, NULL, 'comments', 2, NULL, 2),
(12, 14, 30, 1, '', 6, NULL, 'comments', 2, NULL, 2),
(13, 14, 45, 1, '', 5, NULL, 'comments', 2, NULL, 2),
(14, 15, 21, 1, '', 6, NULL, 'comments', 2, NULL, 2),
(15, 15, 18, 1, '', 6, NULL, 'comments', 2, NULL, 2),
(16, 16, 21, 1, '', 5, NULL, 'comments', 2, NULL, 2),
(17, 16, 18, 1, '', 5, NULL, 'comments', 2, NULL, 2),
(18, 17, 1, 1, '', 5, NULL, 'comments', 2, NULL, 2),
(19, 17, 43, 1, '', 5, NULL, 'comments', 2, NULL, 2),
(20, 19, 57, 1, '', 5, NULL, 'comments', 2, NULL, 2),
(21, 26, 30, 1, '', 5, NULL, 'comments', 2, NULL, 2),
(22, 27, 30, 1, '', 5, NULL, 'comments', 2, NULL, 2),
(23, 28, 59, 1, '', 5, NULL, 'comments', 2, NULL, 2),
(24, 28, 21, 1, '', 5, NULL, 'comments', 2, NULL, 2),
(25, 28, 74, 2, '', 5, NULL, 'comments', 2, NULL, 2),
(26, 31, 74, 1, '', 5, NULL, 'comments', 2, NULL, 2),
(27, 31, 47, 1, '', 5, NULL, 'comments', 2, NULL, 2),
(28, 32, 71, 1, '', 5, NULL, 'comments', 2, NULL, 2),
(29, 32, 76, 1, '', 5, NULL, 'comments', 2, NULL, 2),
(30, 33, 13, 1, '', 5, NULL, 'comments', 2, NULL, 2),
(31, 33, 3, 1, '', 5, NULL, 'comments', 2, NULL, 2),
(32, 34, 71, 4, '', 5, NULL, 'comments', 2, NULL, 2),
(35, 36, 46, 1, '', 5, NULL, 'comments', 2, NULL, 2),
(36, 36, 71, 2, '', 5, NULL, 'comments', 2, NULL, 2),
(37, 37, 71, 1, '', 5, NULL, 'comments', 2, NULL, 2),
(38, 37, 6, 1, '', 5, NULL, 'comments', 2, NULL, 2),
(39, 37, 15, 1, '', 5, NULL, 'comments', 2, NULL, 2),
(40, 38, 71, 1, '', 5, NULL, 'comments', 2, NULL, 2),
(41, 38, 6, 1, '', 5, NULL, 'comments', 2, NULL, 2),
(42, 38, 15, 1, '', 5, NULL, 'comments', 2, NULL, 2),
(44, 41, 41, 1, '', 5, NULL, 'comments', 2, NULL, 5),
(45, 41, 61, 1, '', 5, NULL, 'comments', 2, NULL, 5),
(52, 52, 57, 1, '', 5, NULL, 'comments', 2, NULL, 2),
(53, 52, 23, 1, '', 6, NULL, 'comments', 2, NULL, 2),
(54, 52, 5, 1, '', 5, NULL, 'comments', 2, NULL, 2),
(55, 52, 56, 1, '', 5, NULL, 'comments', 2, NULL, 2),
(56, 52, 74, 1, '', 5, NULL, 'comments', 2, NULL, 2),
(57, 53, 89, 1, '', 5, NULL, 'comments', 2, NULL, 2),
(58, 54, 19, 1, '', 6, NULL, 'comments', 2, NULL, 2),
(59, 54, 56, 1, '', 5, NULL, 'comments', 2, NULL, 2),
(60, 54, 74, 1, '', 5, NULL, 'comments', 2, NULL, 2),
(61, 54, 89, 1, '', 5, NULL, 'comments', 2, NULL, 2),
(62, 55, 51, 1, '', 5, NULL, 'comments', 2, NULL, 2),
(63, 56, 5, 1, '', 5, NULL, 'comments', 2, NULL, 2),
(64, 57, 1, 1, '', 5, NULL, 'comments', 2, NULL, 2),
(70, 65, 71, 2, '', 5, NULL, 'comments', 2, NULL, 2),
(71, 65, 94, 1, '', 5, NULL, 'comments', 2, NULL, 2),
(72, 65, 95, 1, '', 5, NULL, 'comments', 2, NULL, 2),
(73, 69, 38, 1, '', 5, NULL, 'comments', 2, NULL, 3),
(74, 69, 71, 2, '', 5, NULL, 'comments', 2, NULL, 3),
(75, 71, 39, 1, '', 5, NULL, 'comments', 2, NULL, 10),
(76, 71, 46, 1, '', 5, NULL, 'comments', 2, NULL, 10),
(77, 73, 7, 1, '', 5, NULL, 'comments', 2, NULL, 11),
(78, 73, 17, 1, '', 5, NULL, 'comments', 2, NULL, 11),
(79, 73, 73, 1, '', 5, NULL, 'comments', 2, NULL, 11),
(80, 73, 77, 1, '', 5, NULL, 'comments', 2, NULL, 11),
(81, 74, 8, 1, '', 5, NULL, 'comments', 2, NULL, 4),
(82, 74, 14, 1, '', 5, NULL, 'comments', 2, NULL, 4),
(89, 79, 1, 1, '', 5, NULL, 'comments', 2, NULL, 12),
(90, 80, 1, 1, '', 5, NULL, 'comments', 2, NULL, 2),
(91, 81, 1, 1, '', 1, NULL, 'comments', 2, NULL, 2),
(92, 82, 1, 1, '', 1, NULL, 'comments', 2, NULL, 2),
(93, 83, 1, 1, '', 1, NULL, 'comments', 2, NULL, 3),
(106, 97, 1, 2, '', 1, NULL, 'comments', 2, NULL, 2),
(107, 98, 53, 1, '', 1, NULL, 'comments', 2, NULL, 2),
(108, 99, 50, 1, '', 1, NULL, 'comments', 2, NULL, 2),
(109, 99, 53, 1, '', 1, NULL, 'comments', 2, NULL, 2),
(110, 99, 71, 3, '', 1, NULL, 'comments', 2, NULL, 2),
(111, 99, 30, 1, '', 6, NULL, 'comments', 2, NULL, 2),
(112, 99, 29, 1, '', 6, NULL, 'comments', 2, NULL, 2),
(113, 99, 93, 1, '', 1, NULL, 'comments', 2, NULL, 2),
(114, 99, 19, 1, '', 5, NULL, 'comments', 2, NULL, 2),
(115, 99, 90, 4, '', 1, NULL, 'comments', 2, NULL, 2),
(118, 98, 60, 1, '', 1, NULL, 'comments', 2, NULL, 2),
(119, 98, 30, 2, '', 6, NULL, 'comments', 2, NULL, 2),
(120, 98, 89, 4, '', 1, NULL, 'comments', 2, NULL, 2),
(121, 103, 57, 1, '', 1, NULL, 'comments', 2, NULL, 2),
(122, 103, 58, 1, '', 1, NULL, 'comments', 2, NULL, 2),
(123, 103, 43, 1, '', 1, NULL, 'comments', 2, NULL, 2),
(124, 103, 95, 3, '', 1, NULL, 'comments', 2, NULL, 2),
(125, 104, 7, 2, '', 1, NULL, 'comments', 2, NULL, 9),
(126, 104, 13, 1, '', 1, NULL, 'comments', 2, NULL, 9),
(127, 106, 5, 1, '', 1, NULL, 'comments', 2, NULL, 13),
(128, 108, 7, 1, '', 1, NULL, 'comments', 2, NULL, 3),
(129, 109, 63, 1, '', 1, NULL, 'comments', 2, NULL, 3),
(130, 109, 16, 1, '', 1, NULL, 'comments', 2, NULL, 3),
(131, 109, 71, 1, '', 1, NULL, 'comments', 2, NULL, 3),
(132, 109, 95, 1, '', 1, NULL, 'comments', 2, NULL, 3),
(133, 110, 71, 2, '', 1, NULL, 'comments', 2, NULL, 2),
(134, 111, 30, 1, '', 6, NULL, 'comments', 2, NULL, 2),
(135, 111, 89, 3, '', 1, NULL, 'comments', 2, NULL, 2),
(136, 111, 63, 1, '', 1, NULL, 'comments', 2, NULL, 2),
(137, 111, 75, 1, '', 1, NULL, 'comments', 2, NULL, 2),
(138, 111, 71, 1, '', 1, NULL, 'comments', 2, NULL, 2),
(139, 111, 53, 1, '', 1, NULL, 'comments', 2, NULL, 2),
(140, 112, 5, 1, '', 1, NULL, 'comments', 2, NULL, 2),
(141, 112, 95, 1, '', 1, NULL, 'comments', 2, NULL, 2),
(142, 113, 21, 1, '', 6, NULL, 'comments', 2, NULL, 2),
(143, 113, 88, 1, '', 1, NULL, 'comments', 2, NULL, 2),
(144, 115, 23, 1, '', 6, NULL, 'comments', 2, NULL, 14),
(145, 115, 30, 1, '', 6, NULL, 'comments', 2, NULL, 14),
(146, 115, 89, 3, '', 1, NULL, 'comments', 2, NULL, 14),
(149, 118, 30, 1, '', 9, NULL, 'comments', 2, NULL, 2),
(150, 118, 4, 1, '', 1, NULL, 'comments', 2, NULL, 2),
(151, 118, 27, 1, '', 9, NULL, 'comments', 2, NULL, 2),
(152, 118, 71, 1, '', 1, NULL, 'comments', 2, NULL, 2),
(153, 118, 95, 1, '', 1, NULL, 'comments', 2, NULL, 2),
(154, 119, 7, 1, '', 1, NULL, 'comments', 2, NULL, 15),
(155, 119, 45, 1, '', 1, NULL, 'comments', 2, NULL, 15),
(156, 120, 29, 1, '', 1, NULL, 'comments', 2, NULL, 2),
(157, 120, 88, 1, '', 1, NULL, 'comments', 2, NULL, 2),
(158, 120, 89, 2, '', 1, NULL, 'comments', 2, NULL, 2),
(159, 120, 95, 1, '', 1, NULL, 'comments', 2, NULL, 2),
(161, 124, 3, 1, '', 1, NULL, 'comments', 2, NULL, 3),
(162, 125, 3, 1, '', 1, NULL, 'comments', 2, NULL, 3),
(170, 127, 40, 1, '', 1, NULL, 'comments', 2, NULL, 3),
(171, 127, 74, 1, '', 1, NULL, 'comments', 2, NULL, 3),
(172, 128, 57, 2, '', 1, NULL, 'comments', 2, NULL, 3),
(173, 128, 58, 2, '', 1, NULL, 'comments', 2, NULL, 3),
(174, 128, 74, 4, '', 1, NULL, 'comments', 2, NULL, 3),
(177, 130, 29, 1, '', 6, NULL, 'comments', 2, NULL, 3),
(178, 130, 89, 1, '', 1, NULL, 'comments', 2, NULL, 3),
(179, 132, 71, 2, '', 1, NULL, 'comments', 2, NULL, 2),
(181, 133, 1, 1, '', 1, NULL, 'comments', 2, NULL, 2),
(182, 134, 95, 1, '', 1, NULL, 'comments', 2, NULL, 2),
(183, 135, 71, 2, '', 1, NULL, 'comments', 2, NULL, 2),
(184, 135, 95, 1, '', 1, NULL, 'comments', 2, NULL, 2),
(185, 136, 93, 1, '', 1, NULL, 'comments', 2, NULL, 4),
(186, 136, 71, 2, '', 1, NULL, 'comments', 2, NULL, 4),
(188, 139, 29, 1, '', 6, NULL, 'comments', 2, NULL, 16),
(189, 141, 29, 1, '', 1, NULL, 'comments', 2, NULL, 17),
(190, 141, 49, 1, '', 1, NULL, 'comments', 2, NULL, 17),
(191, 141, 89, 1, '', 1, NULL, 'comments', 2, NULL, 17),
(192, 143, 55, 1, '', 1, NULL, 'comments', 2, NULL, 18),
(193, 145, 5, 1, '', 1, NULL, 'comments', 2, NULL, 2),
(194, 145, 83, 1, '', 1, NULL, 'comments', 2, NULL, 2),
(195, 145, 71, 1, '', 1, NULL, 'comments', 2, NULL, 2),
(196, 146, 49, 1, '', 1, NULL, 'comments', 2, NULL, 2),
(197, 146, 29, 1, '', 6, NULL, 'comments', 2, NULL, 2),
(201, 150, 5, 1, '', 1, NULL, 'comments', 2, NULL, 2),
(202, 151, 33, 1, '', 6, NULL, 'comments', 2, NULL, 7),
(203, 151, 89, 2, '', 1, NULL, 'comments', 2, NULL, 7),
(204, 151, 88, 1, '', 1, NULL, 'comments', 2, NULL, 7),
(205, 150, 72, 1, '', 1, NULL, 'comments', 2, NULL, 2),
(206, 152, 59, 3, '', 1, NULL, 'comments', 2, NULL, 2),
(207, 152, 60, 3, '', 1, NULL, 'comments', 2, NULL, 2),
(208, 152, 73, 1, '', 1, NULL, 'comments', 2, NULL, 2),
(209, 152, 74, 4, '', 1, NULL, 'comments', 2, NULL, 2),
(210, 152, 75, 2, '', 1, NULL, 'comments', 2, NULL, 2),
(211, 152, 80, 2, '', 1, NULL, 'comments', 2, NULL, 2),
(212, 152, 95, 1, '', 1, NULL, 'comments', 2, NULL, 2),
(213, 155, 7, 1, '', 1, NULL, 'comments', 2, NULL, 3),
(214, 155, 59, 1, '', 1, NULL, 'comments', 2, NULL, 3),
(215, 155, 72, 1, '', 1, NULL, 'comments', 2, NULL, 3),
(216, 155, 80, 1, '', 1, NULL, 'comments', 2, NULL, 3),
(217, 155, 79, 1, '', 1, NULL, 'comments', 2, NULL, 3),
(218, 155, 1, 1, '', 1, NULL, 'comments', 2, NULL, 3),
(221, 157, 8, 1, '', 1, NULL, 'comments', 2, NULL, 3),
(222, 157, 36, 1, '', 1, NULL, 'comments', 2, NULL, 3),
(223, 157, 71, 1, '', 1, NULL, 'comments', 2, NULL, 3),
(224, 158, 30, 1, '', 6, NULL, 'comments', 2, NULL, 2),
(225, 160, 30, 1, '', 6, NULL, 'comments', 2, NULL, 19),
(226, 160, 88, 1, '', 1, NULL, 'comments', 2, NULL, 19),
(227, 160, 27, 1, '', 9, NULL, 'comments', 2, NULL, 19),
(228, 160, 29, 1, '', 6, NULL, 'comments', 2, NULL, 19),
(229, 160, 91, 1, '', 1, NULL, 'comments', 2, NULL, 19),
(230, 160, 46, 1, '', 1, NULL, 'comments', 2, NULL, 19),
(231, 160, 74, 1, '', 1, NULL, 'comments', 2, NULL, 19),
(233, 158, 89, 1, '', 1, NULL, 'comments', 2, NULL, 2),
(234, 158, 49, 1, '', 1, NULL, 'comments', 2, NULL, 2),
(235, 160, 30, 2, '', 6, NULL, 'comments', 2, NULL, 19),
(236, 160, 52, 1, '', 1, NULL, 'comments', 2, NULL, 19),
(237, 160, 89, 2, '', 1, NULL, 'comments', 2, NULL, 19),
(238, 160, 89, 2, '', 1, NULL, 'comments', 2, NULL, 19),
(239, 158, 96, 1, '', 1, NULL, 'comments', 2, NULL, 2),
(240, 160, 34, 1, '', 6, NULL, 'comments', 2, NULL, 19),
(241, 160, 89, 2, '', 1, NULL, 'comments', 2, NULL, 19),
(242, 160, 88, 1, '', 1, NULL, 'comments', 2, NULL, 19),
(243, 162, 59, 1, '', 1, NULL, 'comments', 2, NULL, 4),
(244, 162, 29, 1, '', 6, NULL, 'comments', 2, NULL, 4),
(245, 162, 34, 1, '', 6, NULL, 'comments', 2, NULL, 4),
(246, 162, 64, 1, '', 1, NULL, 'comments', 2, NULL, 4),
(247, 160, 30, 1, '', 6, NULL, 'comments', 2, NULL, 19),
(248, 160, 19, 1, '', 9, NULL, 'comments', 2, NULL, 19),
(249, 160, 88, 1, '', 1, NULL, 'comments', 2, NULL, 19),
(252, 160, 96, 3, '', 1, NULL, 'comments', 2, NULL, 19),
(253, 165, 23, 1, '', 6, NULL, 'comments', 2, NULL, 3),
(254, 165, 27, 1, '', 5, NULL, 'comments', 2, NULL, 3),
(255, 165, 73, 2, '', 1, NULL, 'comments', 2, NULL, 3),
(256, 167, 50, 1, '', 1, NULL, 'comments', 2, NULL, 21),
(257, 167, 32, 1, '', 6, NULL, 'comments', 2, NULL, 21),
(258, 165, 87, 1, '', 1, NULL, 'comments', 2, NULL, 3),
(261, 170, 46, 1, '', 1, NULL, 'comments', 2, NULL, 22),
(262, 171, 46, 1, '', 1, NULL, 'comments', 2, NULL, 2),
(263, 171, 74, 1, '', 1, NULL, 'comments', 2, NULL, 2),
(264, 171, 63, 1, '', 1, NULL, 'comments', 2, NULL, 2),
(265, 171, 95, 1, '', 1, NULL, 'comments', 2, NULL, 2),
(266, 172, 29, 1, '', 6, NULL, 'comments', 2, NULL, 2),
(267, 172, 89, 1, '', 1, NULL, 'comments', 2, NULL, 2),
(268, 173, 8, 1, '', 5, NULL, 'comments', 2, NULL, 2),
(270, 174, 5, 1, '', 1, NULL, 'comments', 2, NULL, 2),
(271, 174, 45, 1, '', 1, NULL, 'comments', 2, NULL, 2),
(272, 174, 57, 1, '', 1, NULL, 'comments', 2, NULL, 2),
(273, 173, 54, 1, '', 1, NULL, 'comments', 2, NULL, 2),
(274, 173, 86, 1, '', 1, NULL, 'comments', 2, NULL, 2),
(275, 174, 87, 1, '', 1, NULL, 'comments', 2, NULL, 2),
(276, 173, 57, 1, '', 1, NULL, 'comments', 2, NULL, 2),
(278, 173, 33, 1, '', 6, NULL, 'comments', 2, NULL, 2),
(279, 173, 29, 1, '', 6, NULL, 'comments', 2, NULL, 2),
(280, 173, 74, 1, '', 1, NULL, 'comments', 2, NULL, 2),
(281, 173, 89, 2, '', 1, NULL, 'comments', 2, NULL, 2),
(282, 173, 19, 1, '', 1, NULL, 'comments', 2, NULL, 2),
(283, 173, 89, 1, '', 1, NULL, 'comments', 2, NULL, 2),
(284, 173, 66, 1, '', 1, NULL, 'comments', 2, NULL, 2),
(285, 175, 71, 3, '', 1, NULL, 'comments', 2, NULL, 2),
(286, 177, 57, 1, '', 1, NULL, 'comments', 2, NULL, 3),
(287, 177, 58, 1, '', 1, NULL, 'comments', 2, NULL, 3),
(288, 177, 63, 1, '', 1, NULL, 'comments', 2, NULL, 3),
(289, 177, 55, 1, '', 1, NULL, 'comments', 2, NULL, 3),
(290, 177, 87, 1, '', 1, NULL, 'comments', 2, NULL, 3),
(291, 177, 89, 1, '', 1, NULL, 'comments', 2, NULL, 3),
(292, 177, 88, 2, '', 1, NULL, 'comments', 2, NULL, 3),
(294, 177, 72, 1, '', 1, NULL, 'comments', 2, NULL, 3),
(295, 179, 58, 1, '', 1, NULL, 'comments', 2, NULL, 3),
(296, 181, 1, 1, '', 1, NULL, 'comments', 2, NULL, 23),
(297, 181, 3, 1, '', 1, NULL, 'comments', 2, NULL, 23),
(298, 181, 8, 1, '', 1, NULL, 'comments', 2, NULL, 23),
(299, 181, 14, 1, '', 1, NULL, 'comments', 2, NULL, 23),
(300, 179, 73, 1, '', 1, NULL, 'comments', 2, NULL, 3),
(301, 182, 13, 1, '', 1, NULL, 'comments', 2, NULL, 3),
(302, 182, 37, 1, '', 1, NULL, 'comments', 2, NULL, 3),
(305, 184, 27, 1, '', 1, NULL, 'comments', 2, NULL, 3),
(306, 184, 63, 1, '', 1, NULL, 'comments', 2, NULL, 3),
(307, 182, 77, 1, '', 1, NULL, 'comments', 2, NULL, 3),
(309, 210, 22, 1, '', 1, NULL, 'comments', 2, NULL, 28),
(310, 212, 21, 1, '', 6, NULL, 'comments', 2, NULL, 29),
(311, 212, 89, 1, '', 1, NULL, 'comments', 2, NULL, 29),
(312, 212, 92, 1, '', 1, NULL, 'comments', 2, NULL, 29),
(313, 212, 93, 1, '', 1, NULL, 'comments', 2, NULL, 29),
(314, 212, 41, 1, '', 1, NULL, 'comments', 2, NULL, 29),
(315, 216, 30, 1, '', 6, NULL, 'comments', 2, NULL, 2),
(317, 219, 56, 1, '', 1, NULL, 'comments', 2, NULL, 2),
(318, 219, 57, 1, '', 1, NULL, 'comments', 2, NULL, 2),
(319, 219, 59, 1, '', 1, NULL, 'comments', 2, NULL, 2),
(320, 219, 97, 1, '', 1, NULL, 'comments', 2, NULL, 2),
(321, 219, 45, 1, '', 1, NULL, 'comments', 2, NULL, 2),
(322, 219, 74, 1, '', 1, NULL, 'comments', 2, NULL, 2),
(323, 219, 77, 1, '', 1, NULL, 'comments', 2, NULL, 2),
(324, 219, 78, 1, '', 1, NULL, 'comments', 2, NULL, 2),
(325, 219, 88, 1, '', 1, NULL, 'comments', 2, NULL, 2),
(326, 219, 91, 1, '', 1, NULL, 'comments', 2, NULL, 2),
(327, 219, 29, 1, '', 6, NULL, 'comments', 2, NULL, 2),
(328, 219, 71, 3, '', 1, NULL, 'comments', 2, NULL, 2),
(329, 220, 59, 1, '', 1, NULL, 'comments', 2, NULL, 2),
(330, 220, 71, 1, '', 1, NULL, 'comments', 2, NULL, 2),
(331, 221, 45, 1, '', 1, NULL, 'comments', 2, NULL, 2),
(332, 221, 7, 1, '', 1, NULL, 'comments', 2, NULL, 2),
(333, 224, 13, 1, '', 1, NULL, 'comments', 2, NULL, 3),
(334, 224, 7, 1, '', 1, NULL, 'comments', 2, NULL, 3),
(335, 224, 1, 1, '', 1, NULL, 'comments', 2, NULL, 3);

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
(8, 'Abhishek', 2000, '', 'Salary', '2018-06-12', '22:31', 'Salary');

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
(1, 'Rice ', 1000, 100, 0, 10),
(2, 'Rava', 1000, 100, 0, 10),
(3, 'Neer', 1900, 100, 0, 10),
(4, 'Millet', 1000, 100, 0, 10),
(5, 'Butter', 100, 10, 0, 50),
(6, 'Cheese', 1000, 10, 0, 10),
(7, 'None', 10000, 1, 0, 0.01),
(8, 'Steam', 1000, 10, 0, 10),
(9, 'Coconut', 1000, 10, 0, 10),
(11, 'wrap dip', 1000, 10, 0, 10),
(12, 'cheesy dip', 1000, 10, 0, 10),
(13, 'Tomato chutney', 10000, 100, 0, 10),
(14, 'Paaji Balaji Special', 10000, 100, 0, 10),
(15, 'Sambar', 10000, 100, 0, 10),
(16, 'Wrap dip', 10000, 100, 0, 10);

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
(5, 'Masala Dosa', 80, 'md', 'Veg', 'Dosa', '', '10', 1),
(6, 'Mysore Dosa', 75, 'md', 'Veg', 'Dosa', '', '10', 1),
(7, 'Mysore Masala Dosa', 85, 'mmd', 'Veg', 'Dosa', '', '10', 1),
(8, 'Ghee Gunpowder Dosa', 110, 'ggd', 'Veg', 'Dosa', '', '10', 2),
(9, 'Table Top Dosa', 150, 'ttd', 'Veg', 'Dosa', '', '10', 2),
(10, 'Butter Uthappa', 70, 'bu', 'Veg', 'Uthappa', '', '10', 1),
(11, 'Onion Uthappa', 70, 'OU', 'Veg', 'Dosa', '', '10', 1),
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
(66, 'Chocolate Banana Wrap', 120, 'cbw', 'Veg', 'Desserts', '', '10', 1),
(67, 'Fried Ice cream', 180, 'fic', 'Veg', 'Desserts', '', '10', 2),
(71, 'filter coffee', 35, 'fc', 'Veg', 'thanda', '', '10', 1),
(72, 'Masala Chas', 50, 'mc', 'Veg', 'thanda', '', '10', 1),
(73, 'sweet lassi', 60, 'sl', 'Veg', 'thanda', '', '10', 1),
(74, 'Blueberry lassi', 80, 'bl', 'Veg', 'thanda', '', '10', 1),
(75, 'rasam', 20, 'r', 'Veg', 'thanda', '', '10', 1),
(77, 'Coconut', 10, '1', 'Veg', 'Addons', '', '1', 1),
(78, 'Tomato', 10, '1', 'Veg', 'Addons', '', '1', 1),
(79, 'Paaji Balaji spl', 15, '1', 'Veg', 'Addons', '', '1', 1),
(80, 'Sambar', 20, '1', 'Veg', 'Addons', '', '2', 1),
(83, 'Extra cheese', 30, '1', 'Veg', 'addons', '', '2', 1),
(84, 'Wrap dip', 30, '1', 'Veg', 'addons', '', '2', 1),
(86, 'Cheesy dip', 40, '1', 'Veg', 'addons', '', '1', 1),
(87, 'Rice', 40, '1', 'Veg', 'Sides', '', '1', 1),
(88, 'Rava', 40, '1', 'Veg', 'Sides', '1', '1', 1),
(89, 'Neer', 40, '1', 'Veg', 'Sides', '', '1', 1),
(90, 'Steam ', 40, '1', 'Veg', 'Sides', '', '10', 1),
(91, 'Millet', 45, '1', 'Veg', 'Sides', '', '1', 1),
(92, 'Patiala Wrap', 150, '1', 'Veg', 'Wraps', '', '2', 1),
(93, 'Pindi Chole Wrap', 150, '1', 'Veg', 'Wraps', '', '1', 1),
(94, 'Seekh Kabab Wrap', 180, '1', 'Non-Veg', 'Wraps', '', '1', 1),
(95, 'water bottle ', 10, 'water bottle ', 'Liquor', 'Thanda', '', '10', 1),
(96, 'Water', 20, '1', 'Veg', 'Thanda', '', '1', 1),
(97, 'chiken tacos', 190, 'hvfhvj', 'Non-Veg', 'Pardesi', '', '10', 2);

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
(40, 27, 6),
(41, 28, 10),
(42, 28, 9),
(43, 28, 7),
(44, 28, 6),
(45, 29, 10),
(46, 29, 9),
(47, 29, 7),
(48, 29, 6),
(49, 30, 10),
(50, 30, 9),
(51, 30, 7),
(52, 30, 6),
(53, 31, 10),
(54, 31, 9),
(55, 31, 7),
(56, 31, 6),
(57, 32, 10),
(58, 32, 9),
(59, 32, 7),
(60, 32, 6),
(61, 33, 10),
(62, 33, 9),
(63, 33, 7),
(64, 33, 6),
(65, 34, 10),
(66, 34, 9),
(67, 34, 7),
(68, 34, 6),
(70, 35, 10),
(71, 35, 9),
(72, 35, 7),
(73, 35, 6);

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
  `batters` text NOT NULL,
  `addon_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu_ingridient_rel`
--

INSERT INTO `menu_ingridient_rel` (`id`, `Menu_id`, `Ingredients_id`, `quantity_rel`, `addons`, `batters`, `addon_price`) VALUES
(75, 1, 12, 1, 1, '', 40),
(76, 5, 12, 10, 1, '', 40),
(77, 6, 12, 1, 1, '', 40),
(78, 7, 12, 1, 1, '', 40),
(79, 8, 12, 2, 1, '', 40),
(80, 9, 12, 1, 1, '', 40),
(81, 10, 12, 1, 1, '', 40),
(82, 11, 12, 1, 1, '', 40);

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
(16, '0', NULL),
(17, '90', '2018-06-13 17:38:38');

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
(1, 1, '2018-06-11 19:04:09', ''),
(2, 1, '2018-06-11 19:04:58', 'Dine In'),
(3, 1, '2018-06-11 19:04:58', 'Dine In'),
(4, 3, '2018-06-11 19:08:20', 'Dine In'),
(5, 3, '2018-06-11 19:08:21', 'Dine In'),
(6, 6, '2018-06-11 19:12:14', 'Dine In'),
(7, 2, '2018-06-11 19:16:11', 'Dine In'),
(8, -1, '2018-06-11 19:19:05', 'Home Delivery'),
(9, 0, '2018-06-11 19:21:10', 'Home Delivery'),
(10, 99, '2018-06-11 19:23:13', 'Take Away'),
(11, 1, '2018-06-12 05:18:47', 'Dine In'),
(12, 1, '2018-06-12 05:20:36', 'Dine In'),
(13, 1, '2018-06-12 07:21:36', 'Dine In'),
(14, 1, '2018-06-12 07:24:12', 'Dine In'),
(15, 2, '2018-06-12 08:24:57', 'Dine In'),
(16, 2, '2018-06-12 08:30:47', 'Dine In'),
(17, 4, '2018-06-12 08:45:38', 'Dine In'),
(18, 2, '2018-06-12 09:26:59', 'Dine In'),
(19, 1, '2018-06-12 10:15:09', 'Dine In'),
(20, 99, '2018-06-12 10:44:34', 'Take Away'),
(21, 99, '2018-06-12 10:44:34', 'Take Away'),
(22, 99, '2018-06-12 10:54:35', 'Take Away'),
(23, 99, '2018-06-12 10:55:09', 'Take Away'),
(24, 99, '2018-06-12 10:55:33', 'Take Away'),
(25, 99, '2018-06-12 11:02:01', 'Take Away'),
(26, 4, '2018-06-12 11:25:30', 'Dine In'),
(27, 4, '2018-06-12 11:29:42', 'Dine In'),
(28, 2, '2018-06-12 11:46:02', 'Dine In'),
(29, 2, '2018-06-12 11:50:13', 'Dine In'),
(30, 5, '2018-06-12 11:54:31', 'Dine In'),
(31, 5, '2018-06-12 11:55:07', 'Dine In'),
(32, 2, '2018-06-12 11:58:24', 'Dine In'),
(33, 1, '2018-06-12 12:49:21', 'Dine In'),
(34, 5, '2018-06-12 13:03:11', 'Dine In'),
(35, 2, '2018-06-12 13:07:38', 'Dine In'),
(36, 2, '2018-06-12 13:09:44', 'Dine In'),
(37, 2, '2018-06-12 13:58:16', 'Dine In'),
(38, 2, '2018-06-12 14:00:18', 'Dine In'),
(39, -1, '2018-06-12 15:46:30', 'Home Delivery'),
(40, 5, '2018-06-12 15:52:49', 'Dine In'),
(41, 5, '2018-06-12 15:52:50', 'Dine In'),
(42, -1, '2018-06-12 15:57:59', 'Home Delivery'),
(43, 0, '2018-06-12 15:57:59', 'Home Delivery'),
(44, -1, '2018-06-12 16:09:17', 'Home Delivery'),
(45, -1, '2018-06-12 16:09:17', 'Home Delivery'),
(46, 0, '2018-06-12 16:15:51', 'Home Delivery'),
(47, 1, '2018-06-12 16:19:57', 'Dine In'),
(48, 1, '2018-06-12 16:21:52', 'Dine In'),
(49, 1, '2018-06-12 16:24:20', 'Dine In'),
(50, 1, '2018-06-12 16:37:18', 'Dine In'),
(51, 99, '2018-06-12 16:43:53', 'Take Away'),
(52, 5, '2018-06-12 17:07:01', 'Dine In'),
(53, 5, '2018-06-12 17:37:56', 'Dine In'),
(54, 3, '2018-06-12 17:39:13', 'Dine In'),
(55, 1, '2018-06-12 18:02:27', 'Dine In'),
(56, 1, '2018-06-13 04:08:51', 'Dine In'),
(57, 99, '2018-06-13 05:06:47', 'Take Away'),
(58, 99, '2018-06-13 08:40:31', 'Take Away'),
(59, 1, '2018-06-13 08:41:19', 'Dine In'),
(60, -1, '2018-06-13 09:34:26', 'Home Delivery'),
(61, 0, '2018-06-13 09:34:26', 'Home Delivery'),
(62, 5, '2018-06-13 10:19:43', 'Dine In'),
(63, 5, '2018-06-13 10:23:41', 'Dine In'),
(64, 5, '2018-06-13 10:25:36', 'Dine In'),
(65, 5, '2018-06-13 10:29:43', 'Dine In'),
(66, 1, '2018-06-13 11:18:16', 'Dine In'),
(67, 1, '2018-06-13 11:18:16', 'Dine In'),
(68, 1, '2018-06-13 14:01:27', 'Dine In'),
(69, 1, '2018-06-13 14:01:28', 'Dine In'),
(70, -1, '2018-06-13 14:09:14', 'Home Delivery'),
(71, 0, '2018-06-13 14:09:15', 'Home Delivery'),
(72, -1, '2018-06-13 14:38:10', 'Home Delivery'),
(73, 0, '2018-06-13 14:38:11', 'Home Delivery'),
(74, 5, '2018-06-13 15:06:58', 'Dine In'),
(75, 1, '2018-06-13 15:31:29', 'Dine In'),
(76, -1, '2018-06-13 15:46:43', 'Home Delivery'),
(77, -1, '2018-06-13 15:50:14', 'Home Delivery'),
(78, -1, '2018-06-13 15:52:00', 'Home Delivery'),
(79, -1, '2018-06-13 15:52:00', 'Home Delivery'),
(80, 3, '2018-06-13 15:55:53', 'Dine In'),
(81, 2, '2018-06-13 16:00:04', 'Dine In'),
(82, 2, '2018-06-13 16:00:45', 'Dine In'),
(83, 2, '2018-06-13 16:08:50', 'Dine In'),
(84, -1, '2018-06-13 16:11:17', 'Home Delivery'),
(85, 2, '2018-06-13 16:12:04', 'Dine In'),
(86, 1, '2018-06-13 16:13:29', 'Dine In'),
(87, 2, '2018-06-13 16:14:37', 'Dine In'),
(88, 2, '2018-06-13 16:23:20', 'Dine In'),
(89, 2, '2018-06-13 16:24:54', 'Dine In'),
(90, 1, '2018-06-13 16:25:14', 'Dine In'),
(91, 2, '2018-06-13 16:28:40', 'Dine In'),
(92, 2, '2018-06-13 16:46:42', 'Dine In'),
(93, 1, '2018-06-13 16:50:44', 'Dine In'),
(94, 3, '2018-06-13 16:53:12', 'Dine In'),
(95, 3, '2018-06-13 16:53:12', 'Dine In'),
(96, 1, '2018-06-13 16:56:13', 'Dine In'),
(97, 4, '2018-06-13 17:02:08', 'Dine In'),
(98, 2, '2018-06-13 17:02:43', 'Dine In'),
(99, 5, '2018-06-13 17:13:35', 'Dine In'),
(100, 2, '2018-06-13 17:20:35', 'Dine In'),
(101, 1, '2018-06-13 17:22:44', 'Dine In'),
(102, 1, '2018-06-13 17:25:32', 'Dine In'),
(103, 4, '2018-06-13 17:35:16', 'Dine In'),
(104, 1, '2018-06-13 17:47:43', 'Dine In'),
(105, -1, '2018-06-14 04:39:29', 'Home Delivery'),
(106, -1, '2018-06-14 04:39:29', 'Home Delivery'),
(107, 1, '2018-06-14 04:59:46', 'Dine In'),
(108, 1, '2018-06-14 05:00:02', 'Dine In'),
(109, 1, '2018-06-14 06:26:09', 'Dine In'),
(110, 2, '2018-06-14 11:42:31', 'Dine In'),
(111, 3, '2018-06-14 12:29:46', 'Dine In'),
(112, 4, '2018-06-14 14:40:19', 'Dine In'),
(113, 4, '2018-06-14 16:01:44', 'Dine In'),
(114, 99, '2018-06-14 16:29:53', 'Take Away'),
(115, 99, '2018-06-14 16:29:53', 'Take Away'),
(116, -1, '2018-06-14 17:17:36', 'Home Delivery'),
(117, 0, '2018-06-14 17:17:36', 'Home Delivery'),
(118, 5, '2018-06-14 17:24:49', 'Dine In'),
(119, -1, '2018-06-14 17:34:55', 'Home Delivery'),
(120, 1, '2018-06-14 17:42:15', 'Dine In'),
(121, 99, '2018-06-15 06:15:40', 'Take Away'),
(122, 99, '2018-06-15 06:15:58', 'Take Away'),
(123, 99, '2018-06-15 06:16:20', 'Take Away'),
(124, 99, '2018-06-15 06:16:35', 'Take Away'),
(125, 99, '2018-06-15 06:50:55', 'Take Away'),
(126, 4, '2018-06-15 07:49:02', 'Dine In'),
(127, 2, '2018-06-15 08:27:39', 'Dine In'),
(128, 1, '2018-06-15 08:30:55', 'Dine In'),
(129, 2, '2018-06-15 08:31:35', 'Dine In'),
(130, 4, '2018-06-15 09:16:03', 'Dine In'),
(131, 1, '2018-06-15 10:33:20', 'Dine In'),
(132, 1, '2018-06-15 10:40:14', 'Dine In'),
(133, 1, '2018-06-15 10:41:30', 'Dine In'),
(134, 1, '2018-06-15 10:50:50', 'Dine In'),
(135, 1, '2018-06-15 11:03:34', 'Dine In'),
(136, 99, '2018-06-15 12:25:05', 'Take Away'),
(137, 1, '2018-06-15 13:07:16', 'Dine In'),
(138, -1, '2018-06-15 15:05:25', 'Home Delivery'),
(139, -1, '2018-06-15 15:05:25', 'Home Delivery'),
(140, -1, '2018-06-15 15:10:52', 'Home Delivery'),
(141, -1, '2018-06-15 15:10:53', 'Home Delivery'),
(142, -1, '2018-06-15 15:18:05', 'Home Delivery'),
(143, -1, '2018-06-15 15:18:05', 'Home Delivery'),
(144, 5, '2018-06-15 15:24:03', 'Dine In'),
(145, 5, '2018-06-15 15:26:47', 'Dine In'),
(146, -1, '2018-06-15 15:45:38', 'Home Delivery'),
(147, 99, '2018-06-15 15:51:48', 'Take Away'),
(148, 5, '2018-06-15 16:15:34', 'Dine In'),
(149, 5, '2018-06-15 16:15:34', 'Dine In'),
(150, 4, '2018-06-15 16:33:56', 'Dine In'),
(151, -1, '2018-06-15 16:45:32', 'Home Delivery'),
(152, 3, '2018-06-15 17:03:22', 'Dine In'),
(153, 1, '2018-06-15 17:58:37', 'Dine In'),
(154, 3, '2018-06-15 18:04:20', 'Dine In'),
(155, 5, '2018-06-16 04:38:09', 'Dine In'),
(156, 1, '2018-06-16 05:34:47', 'Dine In'),
(157, 1, '2018-06-16 05:35:41', 'Dine In'),
(158, 1, '2018-06-16 07:57:51', 'Dine In'),
(159, 3, '2018-06-16 08:00:06', 'Dine In'),
(160, 3, '2018-06-16 08:00:06', 'Dine In'),
(161, 1, '2018-06-16 08:02:28', 'Dine In'),
(162, 99, '2018-06-16 08:28:08', 'Take Away'),
(163, -1, '2018-06-16 08:41:48', 'Home Delivery'),
(164, -1, '2018-06-16 08:41:48', 'Home Delivery'),
(165, 5, '2018-06-16 10:04:20', 'Dine In'),
(166, -1, '2018-06-16 10:08:58', 'Home Delivery'),
(167, -1, '2018-06-16 10:08:58', 'Home Delivery'),
(168, 5, '2018-06-16 13:06:56', 'Dine In'),
(169, -1, '2018-06-16 13:16:55', 'Home Delivery'),
(170, -1, '2018-06-16 13:16:55', 'Home Delivery'),
(171, 1, '2018-06-16 14:34:39', 'Dine In'),
(172, 5, '2018-06-16 14:59:18', 'Dine In'),
(173, 1, '2018-06-16 15:58:20', 'Dine In'),
(174, 4, '2018-06-16 16:20:28', 'Dine In'),
(175, 1, '2018-06-16 17:43:30', 'Dine In'),
(176, 1, '2018-06-16 18:11:22', 'Dine In'),
(177, 3, '2018-06-17 09:09:17', 'Dine In'),
(178, 1, '2018-06-17 09:56:19', 'Dine In'),
(179, 2, '2018-06-17 12:01:44', 'Dine In'),
(180, -1, '2018-06-17 12:30:23', 'Home Delivery'),
(181, -1, '2018-06-17 12:30:24', 'Home Delivery'),
(182, 1, '2018-06-17 12:47:26', 'Dine In'),
(183, -1, '2018-06-17 13:07:19', 'Home Delivery'),
(184, -1, '2018-06-17 13:12:43', 'Home Delivery'),
(185, -1, '2018-06-17 13:52:41', 'Home Delivery'),
(186, -1, '2018-06-17 13:56:27', 'Home Delivery'),
(187, -1, '2018-06-17 13:56:27', 'Home Delivery'),
(188, -1, '2018-06-17 14:22:49', 'Home Delivery'),
(189, -1, '2018-06-17 14:22:49', 'Home Delivery'),
(190, -1, '2018-06-17 14:44:21', 'Home Delivery'),
(191, -1, '2018-06-17 14:44:55', 'Home Delivery'),
(192, -1, '2018-06-17 14:46:11', 'Home Delivery'),
(193, 99, '2018-06-17 14:47:09', 'Take Away'),
(194, 1, '2018-06-17 14:49:41', 'Dine In'),
(195, -1, '2018-06-17 14:50:43', 'Home Delivery'),
(196, 1, '2018-06-17 14:59:13', 'Dine In'),
(197, -1, '2018-06-17 15:00:12', 'Home Delivery'),
(198, -1, '2018-06-17 15:00:12', 'Home Delivery'),
(199, 1, '2018-06-17 15:01:00', 'Dine In'),
(200, 1, '2018-06-17 15:07:55', 'Dine In'),
(201, 1, '2018-06-17 15:15:25', 'Dine In'),
(202, 1, '2018-06-17 15:16:35', 'Dine In'),
(203, 1, '2018-06-17 15:17:48', 'Dine In'),
(204, 7, '2018-06-17 15:18:01', 'Dine In'),
(205, 5, '2018-06-17 15:27:49', 'Dine In'),
(206, -1, '2018-06-17 15:34:32', 'Home Delivery'),
(207, 5, '2018-06-17 15:41:36', 'Dine In'),
(208, 5, '2018-06-17 15:42:28', 'Dine In'),
(209, -1, '2018-06-17 15:44:58', 'Home Delivery'),
(210, -1, '2018-06-17 15:44:59', 'Home Delivery'),
(211, 99, '2018-06-17 15:53:26', 'Take Away'),
(212, 99, '2018-06-17 15:53:26', 'Take Away'),
(213, 1, '2018-06-17 16:02:37', 'Dine In'),
(214, -1, '2018-06-17 16:06:05', 'Home Delivery'),
(215, -1, '2018-06-17 16:07:41', 'Home Delivery'),
(216, 99, '2018-06-17 16:08:45', 'Take Away'),
(217, 99, '2018-06-17 16:12:34', 'Take Away'),
(218, -1, '2018-06-17 16:20:54', 'Home Delivery'),
(219, 5, '2018-06-17 16:29:53', 'Dine In'),
(220, 1, '2018-06-17 16:40:54', 'Dine In'),
(221, 5, '2018-06-17 17:35:58', 'Dine In'),
(222, 99, '2018-06-18 05:21:39', 'Take Away'),
(223, 99, '2018-06-18 05:21:40', 'Take Away'),
(224, 1, '2018-06-18 05:23:46', 'Dine In'),
(225, 5, '2018-06-18 05:45:37', 'Dine In'),
(226, 3, '2018-06-18 05:52:42', 'Dine In'),
(227, 3, '2018-06-18 05:54:48', 'Dine In'),
(228, 99, '2018-06-18 05:56:13', 'Take Away');

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
(1, 1, 3, '2018-06-11 19:04:09', 0),
(2, 3, 4, '2018-06-11 19:04:58', 0),
(3, 5, 4, '2018-06-11 19:08:21', 0),
(4, 6, 1, '2018-06-11 19:12:14', 0),
(5, 7, 4, '2018-06-11 19:16:11', 0),
(6, 8, 1, '2018-06-11 19:19:05', 0),
(7, 9, 3, '2018-06-11 19:21:10', 1),
(8, 10, 3, '2018-06-11 19:23:13', 1),
(9, 11, 1, '2018-06-12 05:18:47', 0),
(10, 12, 1, '2018-06-12 05:20:36', 0),
(11, 13, 4, '2018-06-12 07:21:37', 0),
(12, 14, 4, '2018-06-12 07:24:12', 0),
(13, 15, 4, '2018-06-12 08:24:57', 0),
(14, 16, 4, '2018-06-12 08:30:47', 1),
(15, 17, 4, '2018-06-12 08:45:38', 0),
(16, 18, 1, '2018-06-12 09:26:59', 0),
(17, 19, 4, '2018-06-12 10:15:09', 0),
(18, 21, 1, '2018-06-12 10:44:34', 0),
(19, 22, 1, '2018-06-12 10:54:35', 0),
(20, 23, 1, '2018-06-12 10:55:09', 0),
(21, 24, 1, '2018-06-12 10:55:33', 0),
(22, 25, 1, '2018-06-12 11:02:01', 0),
(23, 26, 4, '2018-06-12 11:25:30', 0),
(24, 27, 4, '2018-06-12 11:29:42', 0),
(25, 28, 4, '2018-06-12 11:46:02', 0),
(26, 29, 1, '2018-06-12 11:50:13', 0),
(27, 30, 1, '2018-06-12 11:54:32', 0),
(28, 31, 4, '2018-06-12 11:55:07', 0),
(29, 32, 4, '2018-06-12 11:58:24', 0),
(30, 33, 4, '2018-06-12 12:49:21', 0),
(31, 34, 4, '2018-06-12 13:03:11', 0),
(32, 35, 3, '2018-06-12 13:07:38', 0),
(33, 36, 4, '2018-06-12 13:09:44', 0),
(34, 37, 4, '2018-06-12 13:58:16', 0),
(35, 38, 4, '2018-06-12 14:00:18', 0),
(36, 39, 3, '2018-06-12 15:46:30', 0),
(37, 41, 4, '2018-06-12 15:52:50', 1),
(38, 43, 3, '2018-06-12 15:57:59', 1),
(39, 45, 1, '2018-06-12 16:09:18', 0),
(40, 46, 3, '2018-06-12 16:15:51', 0),
(41, 47, 1, '2018-06-12 16:19:57', 0),
(42, 48, 1, '2018-06-12 16:21:52', 0),
(43, 49, 1, '2018-06-12 16:24:20', 0),
(44, 50, 3, '2018-06-12 16:37:18', 0),
(45, 51, 1, '2018-06-12 16:43:53', 0),
(46, 52, 4, '2018-06-12 17:07:01', 0),
(47, 53, 4, '2018-06-12 17:37:57', 0),
(48, 54, 4, '2018-06-12 17:39:13', 0),
(49, 55, 4, '2018-06-12 18:02:27', 0),
(50, 56, 4, '2018-06-13 04:08:51', 0),
(51, 57, 4, '2018-06-13 05:06:47', 0),
(85, 96, 1, '2018-06-13 16:56:13', 0),
(86, 97, 4, '2018-06-13 17:02:08', 0),
(87, 98, 4, '2018-06-13 17:02:43', 0),
(88, 99, 4, '2018-06-13 17:13:35', 0),
(89, 100, 1, '2018-06-13 17:20:35', 0),
(90, 101, 1, '2018-06-13 17:22:44', 0),
(91, 102, 1, '2018-06-13 17:25:32', 0),
(92, 103, 4, '2018-06-13 17:35:16', 0),
(93, 104, 4, '2018-06-13 17:47:43', 1),
(94, 106, 4, '2018-06-14 04:39:29', 0),
(95, 107, 1, '2018-06-14 04:59:46', 0),
(96, 108, 4, '2018-06-14 05:00:02', 0),
(97, 109, 4, '2018-06-14 06:26:09', 0),
(98, 110, 4, '2018-06-14 11:42:31', 0),
(99, 111, 4, '2018-06-14 12:29:46', 0),
(100, 112, 4, '2018-06-14 14:40:19', 0),
(101, 113, 4, '2018-06-14 16:01:44', 0),
(102, 115, 4, '2018-06-14 16:29:53', 0),
(103, 117, 3, '2018-06-14 17:17:36', 0),
(104, 118, 4, '2018-06-14 17:24:49', 0),
(105, 119, 4, '2018-06-14 17:34:56', 0),
(106, 120, 4, '2018-06-14 17:42:15', 0),
(107, 121, 1, '2018-06-15 06:15:40', 0),
(108, 122, 1, '2018-06-15 06:15:58', 0),
(109, 123, 1, '2018-06-15 06:16:20', 0),
(110, 124, 4, '2018-06-15 06:16:35', 0),
(111, 125, 4, '2018-06-15 06:50:55', 0),
(112, 126, 1, '2018-06-15 07:49:02', 0),
(113, 127, 4, '2018-06-15 08:27:39', 0),
(114, 128, 4, '2018-06-15 08:30:55', 0),
(115, 129, 1, '2018-06-15 08:31:36', 0),
(116, 130, 4, '2018-06-15 09:16:03', 0),
(117, 131, 1, '2018-06-15 10:33:20', 0),
(118, 132, 4, '2018-06-15 10:40:14', 0),
(119, 133, 4, '2018-06-15 10:41:30', 0),
(120, 134, 4, '2018-06-15 10:50:50', 0),
(121, 135, 4, '2018-06-15 11:03:34', 0),
(122, 136, 4, '2018-06-15 12:25:05', 0),
(123, 137, 1, '2018-06-15 13:07:16', 0),
(124, 139, 4, '2018-06-15 15:05:26', 0),
(125, 141, 4, '2018-06-15 15:10:53', 0),
(126, 143, 4, '2018-06-15 15:18:05', 0),
(127, 144, 1, '2018-06-15 15:24:03', 0),
(128, 145, 4, '2018-06-15 15:26:47', 0),
(129, 146, 4, '2018-06-15 15:45:39', 0),
(130, 147, 1, '2018-06-15 15:51:48', 0),
(131, 148, 1, '2018-06-15 16:15:34', 0),
(132, 149, 1, '2018-06-15 16:15:34', 0),
(133, 150, 4, '2018-06-15 16:33:56', 0),
(134, 151, 4, '2018-06-15 16:45:32', 0),
(135, 152, 4, '2018-06-15 17:03:22', 0),
(136, 153, 1, '2018-06-15 17:58:37', 0),
(137, 154, 1, '2018-06-15 18:04:20', 0),
(138, 155, 4, '2018-06-16 04:38:09', 0),
(139, 156, 1, '2018-06-16 05:34:47', 0),
(140, 157, 4, '2018-06-16 05:35:41', 0),
(141, 158, 4, '2018-06-16 07:57:51', 0),
(142, 160, 4, '2018-06-16 08:00:06', 0),
(143, 161, 4, '2018-06-16 08:02:28', 0),
(144, 162, 4, '2018-06-16 08:28:08', 0),
(145, 164, 1, '2018-06-16 08:41:48', 0),
(146, 165, 4, '2018-06-16 10:04:20', 0),
(147, 167, 4, '2018-06-16 10:08:58', 0),
(148, 168, 1, '2018-06-16 13:06:56', 0),
(149, 170, 4, '2018-06-16 13:16:55', 0),
(150, 171, 4, '2018-06-16 14:34:39', 0),
(151, 172, 4, '2018-06-16 14:59:18', 0),
(152, 173, 4, '2018-06-16 15:58:20', 0),
(153, 174, 4, '2018-06-16 16:20:28', 0),
(154, 175, 4, '2018-06-16 17:43:30', 0),
(155, 176, 1, '2018-06-16 18:11:22', 0),
(156, 177, 4, '2018-06-17 09:09:17', 0),
(157, 178, 1, '2018-06-17 09:56:19', 0),
(158, 179, 4, '2018-06-17 12:01:44', 0),
(159, 181, 4, '2018-06-17 12:30:24', 0),
(160, 182, 4, '2018-06-17 12:47:26', 0),
(161, 183, 1, '2018-06-17 13:07:19', 0),
(162, 184, 4, '2018-06-17 13:12:43', 0),
(163, 185, 1, '2018-06-17 13:52:41', 0),
(164, 187, 1, '2018-06-17 13:56:27', 0),
(165, 189, 1, '2018-06-17 14:22:49', 0),
(166, 190, 1, '2018-06-17 14:44:21', 0),
(167, 191, 1, '2018-06-17 14:44:55', 0),
(168, 192, 1, '2018-06-17 14:46:11', 0),
(169, 193, 1, '2018-06-17 14:47:09', 0),
(170, 194, 1, '2018-06-17 14:49:41', 0),
(171, 195, 1, '2018-06-17 14:50:43', 0),
(172, 196, 1, '2018-06-17 14:59:13', 0),
(173, 198, 1, '2018-06-17 15:00:13', 0),
(174, 199, 1, '2018-06-17 15:01:00', 0),
(175, 200, 1, '2018-06-17 15:07:55', 0),
(176, 201, 1, '2018-06-17 15:15:25', 0),
(177, 202, 1, '2018-06-17 15:16:35', 0),
(178, 203, 1, '2018-06-17 15:17:48', 0),
(179, 204, 1, '2018-06-17 15:18:01', 0),
(180, 205, 1, '2018-06-17 15:27:49', 0),
(181, 207, 1, '2018-06-17 15:41:36', 0),
(182, 208, 1, '2018-06-17 15:42:28', 0),
(183, 210, 4, '2018-06-17 15:44:59', 0),
(184, 212, 4, '2018-06-17 15:53:26', 0),
(185, 213, 1, '2018-06-17 16:02:37', 0),
(186, 215, 1, '2018-06-17 16:07:41', 0),
(187, 216, 4, '2018-06-17 16:08:45', 0),
(188, 217, 1, '2018-06-17 16:12:34', 0),
(189, 218, 1, '2018-06-17 16:20:54', 0),
(190, 219, 4, '2018-06-17 16:29:53', 0),
(191, 220, 4, '2018-06-17 16:40:54', 0),
(192, 221, 4, '2018-06-17 17:35:58', 0),
(193, 223, 1, '2018-06-18 05:21:40', 0),
(194, 224, 1, '2018-06-18 05:23:46', 0),
(195, 225, 1, '2018-06-18 05:45:37', 0),
(196, 226, 1, '2018-06-18 05:52:42', 0),
(197, 227, 1, '2018-06-18 05:54:48', 0),
(198, 228, 1, '2018-06-18 05:56:13', 0);

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
(1, 3, 'Online', '140', '140', '0', NULL, NULL),
(2, 5, 'Online', '140', '140', '0', NULL, NULL),
(3, 7, 'Card', '210', '210', '0', NULL, NULL),
(4, 9, 'Cash', '140', '500', '0', NULL, NULL),
(5, 14, 'Cash', '380', '0', '0', NULL, NULL),
(6, 16, 'Cash', '310', '0', '0', NULL, NULL),
(7, 17, 'Cash', '240', '0', '0', NULL, NULL),
(8, 17, 'Cash', '240', '0', '0', NULL, NULL),
(9, 19, 'Cash', '290', '500', '210', NULL, NULL),
(10, 13, 'Cash', '460', '0', '0', NULL, NULL),
(11, 15, 'Cash', '310', '0', '0', NULL, NULL),
(12, 26, 'Cash', '210', '500', '290', NULL, NULL),
(13, 27, 'Cash', '210', '0', '0', NULL, NULL),
(14, 28, 'Cash', '510', '0', '0', NULL, NULL),
(15, 31, 'Cash', '260', '0', '0', NULL, NULL),
(16, 32, 'Cash', '55', '0', '0', NULL, NULL),
(17, 33, 'Cash', '155', '0', '0', NULL, NULL),
(18, 34, 'Cash', '140', '200', '60', NULL, NULL),
(19, 36, 'Cash', '240', '0', '0', NULL, NULL),
(20, 37, 'Cash', '200', '0', '0', NULL, NULL),
(21, 38, 'Cash', '200', '0', '0', NULL, NULL),
(22, 41, 'Cash', '340', '0', '0', NULL, NULL),
(23, 52, 'Cash', '880', '0', '0', NULL, NULL),
(24, 53, 'Cash', '40', '0', '0', NULL, NULL),
(25, 54, 'Cash', '550', '0', '0', NULL, NULL),
(26, 55, 'Cash', '180', '0', '0', NULL, NULL),
(27, 43, '', '280', '280', '0', NULL, NULL),
(28, 46, '', '290', '290', '0', NULL, NULL),
(29, 56, 'Cash', '80', '0', '0', NULL, NULL),
(30, 57, '', '70', '70', '0', NULL, NULL),
(31, 61, 'Cash', '220', '0', '0', NULL, NULL),
(32, 65, 'Card', '260', '260', '0', NULL, NULL),
(33, 69, 'Cash', '210', '500', '290', NULL, NULL),
(34, 71, 'Cash', '320', '500', '0', NULL, NULL),
(35, 71, 'Cash', '320', '500', '180', NULL, NULL),
(36, 74, 'Cash', '190', '500', '310', NULL, NULL),
(37, 75, 'Card', '315', '315', '0', NULL, '2018-06-13 17:34:40'),
(38, 75, 'Cash', '315', '0', '0', NULL, '2018-06-13 17:37:51'),
(39, 76, 'Card', '70', '70', '0', NULL, '2018-06-13 17:47:13'),
(59, 97, 'Online', '140', '140', '0', NULL, '2018-06-13 19:02:26'),
(60, 99, 'Card', '1355', '1355', '0', NULL, '2018-06-13 19:15:41'),
(61, 98, 'Cash', '960', '0', 'NaN', NULL, '2018-06-13 19:30:00'),
(62, 103, 'Card', '820', '820', '0', NULL, '2018-06-13 19:39:46'),
(63, 104, 'Cash', '250', '250', '0', NULL, '2018-06-13 19:48:27'),
(64, 106, 'Cash', '80', '100', '20', NULL, '2018-06-14 06:40:33'),
(65, 108, 'Cash', '85', '100', '15', NULL, '2018-06-14 07:01:05'),
(66, 109, 'Cash', '270', '500', '230', NULL, '2018-06-14 08:38:59'),
(67, 110, 'Cash', '70', '0', '0', NULL, '2018-06-14 13:43:06'),
(68, 111, 'Cash', '725', '0', '0', NULL, '2018-06-14 14:40:53'),
(69, 112, 'Cash', '90', '0', '0', NULL, '2018-06-14 16:42:06'),
(70, 113, 'Card', '210', '210', '0', NULL, '2018-06-14 18:02:41'),
(71, 115, 'Card', '500', '500', '0', NULL, '2018-06-14 18:31:08'),
(72, 117, 'Cash', '255', '500', '0', NULL, '2018-06-14 19:22:31'),
(73, 118, 'Card', '500', '500', '0', NULL, '2018-06-14 19:28:48'),
(74, 119, 'Cash', '255', '500', '245', NULL, '2018-06-14 19:36:17'),
(75, 120, 'Card', '320', '320', '0', NULL, '2018-06-14 19:43:35'),
(76, 124, 'Cash', '75', '100', '25', NULL, '2018-06-15 08:18:25'),
(77, 125, 'Cash', '75', '100', '25', NULL, '2018-06-15 09:01:38'),
(78, 127, 'Cash', '240', '500', '260', NULL, '2018-06-15 10:28:18'),
(79, 128, 'Card', '1560', '1560', '0', NULL, '2018-06-15 10:38:50'),
(80, 130, 'Cash', '230', '0', '0', NULL, '2018-06-15 11:35:35'),
(81, 132, 'Cash', '140', '0', '0', NULL, '2018-06-15 12:41:06'),
(82, 133, 'Cash', '70', '0', '0', NULL, '2018-06-15 12:51:24'),
(83, 134, '', '10', '10', '0', NULL, '2018-06-15 12:52:04'),
(84, 135, 'Cash', '80', '100', '20', NULL, '2018-06-15 13:04:31'),
(85, 136, 'Cash', '220', '0', '0', NULL, '2018-06-15 14:36:43'),
(86, 139, 'Cash', '190', '500', '310', NULL, '2018-06-15 17:09:36'),
(87, 141, 'Cash', '440', '500', '60', NULL, '2018-06-15 17:21:56'),
(88, 145, 'Card', '145', '145', '0', NULL, '2018-06-15 17:27:47'),
(89, 143, 'Cash', '230', '500', '270', NULL, '2018-06-15 17:35:43'),
(90, 146, 'Cash', '400', '500', '100', NULL, '2018-06-15 17:48:42'),
(91, 151, 'Cash', '340', '500', '160', NULL, '2018-06-15 18:55:52'),
(92, 150, 'Cash', '130', '150', '20', NULL, '2018-06-15 18:59:54'),
(93, 152, 'Cash', '1580', '0', '0', NULL, '2018-06-15 19:48:41'),
(94, 155, 'Cash', '420', '500', '80', NULL, '2018-06-16 07:48:59'),
(95, 157, 'Card', '285', '285', '0', NULL, '2018-06-16 08:15:28'),
(96, 161, 'Cash', '70', '0', '0', NULL, '2018-06-16 10:13:48'),
(97, 162, 'Card', '680', '680', '0', NULL, '2018-06-16 10:29:28'),
(98, 158, 'Cash', '480', '500', '20', NULL, '2018-06-16 10:44:45'),
(99, 160, 'Cash', '2525', '2525', '0', NULL, '2018-06-16 11:09:14'),
(100, 167, 'Cash', '400', '500', '100', NULL, '2018-06-16 13:01:04'),
(101, 165, 'Cash', '500', '500', '0', NULL, '2018-06-16 13:02:54'),
(102, 170, 'Cash', '170', '0', '0', NULL, '2018-06-16 16:33:08'),
(103, 171, 'Cash', '410', '0', '0', NULL, '2018-06-16 17:02:35'),
(104, 172, 'Card', '230', '230', '0', NULL, '2018-06-16 17:23:45'),
(105, 174, 'Cash', '580', '0', '0', NULL, '2018-06-16 19:23:33'),
(106, 173, 'Cash', '1530', '0', '0', NULL, '2018-06-16 19:37:30'),
(107, 175, 'Card', '105', '105', '0', NULL, '2018-06-16 19:56:24'),
(108, 177, 'Cash', '1210', '2210', '1000', NULL, '2018-06-17 12:32:57'),
(109, 179, 'Card', '390', '390', '0', NULL, '2018-06-17 14:35:32'),
(110, 179, 'Card', '390', '390', '0', NULL, '2018-06-17 14:35:32'),
(111, 181, 'Cash', '335', '500', '165', NULL, '2018-06-17 15:10:31'),
(112, 73, 'Card', '245', '245', '0', NULL, '2018-06-17 15:21:44'),
(113, 182, 'Card', '230', '230', '0', NULL, '2018-06-17 15:22:58'),
(114, 184, 'Cash', '320', '320', '0', NULL, '2018-06-17 15:39:51'),
(115, 210, 'Cash', '170', '0', '0', NULL, '2018-06-17 17:47:48'),
(116, 212, 'Cash', '700', '0', '0', NULL, '2018-06-17 18:00:55'),
(117, 216, 'Cash', '210', '0', '0', NULL, '2018-06-17 18:10:22'),
(118, 219, 'Cash', '1570', '0', '0', NULL, '2018-06-17 18:39:38'),
(119, 220, 'Cash', '215', '0', '0', NULL, '2018-06-17 19:04:36'),
(120, 221, 'Cash', '255', '0', '0', NULL, '2018-06-17 19:59:01');

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
(1, 1, 1.75, 1.75, 73.5, NULL, '', '2018-06-11 19:04:27', 1, 'mobile', 0),
(3, 5, 0, 0, 140, NULL, '', '2018-06-11 19:08:28', 3, 'Manual', 0),
(4, 7, 0, 0, 210, NULL, '', '2018-06-11 19:16:22', 2, 'Manual', 0),
(5, 9, 0, 0, 140, NULL, '', '2018-06-11 19:21:23', 2, 'Manual', 0),
(6, 10, 0, 0, 245, NULL, '', '2018-06-11 19:23:25', 3, 'Manual', 0),
(7, 13, 0, 0, 460, NULL, '', '2018-06-12 07:23:16', 2, 'Manual', 0),
(8, 14, 0, 0, 380, NULL, '', '2018-06-12 07:25:22', 2, 'Manual', 0),
(10, 16, 0, 0, 310, NULL, '', '2018-06-12 08:31:21', 2, 'Manual', 0),
(11, 17, 0, 0, 240, NULL, '', '2018-06-12 08:46:58', 2, 'Manual', 0),
(12, 19, 0, 0, 290, NULL, '', '2018-06-12 10:15:50', 2, 'Manual', 0),
(13, 26, 0, 0, 210, NULL, '', '2018-06-12 11:26:13', 2, 'Manual', 0),
(14, 27, 0, 0, 210, NULL, '', '2018-06-12 11:30:02', 2, 'Manual', 0),
(15, 28, 0, 0, 510, NULL, '', '2018-06-12 11:47:47', 2, 'Manual', 0),
(16, 31, 0, 0, 260, NULL, '', '2018-06-12 11:55:56', 2, 'Manual', 0),
(17, 32, 0, 0, 55, NULL, '', '2018-06-12 11:59:11', 2, 'Manual', 0),
(18, 33, 0, 0, 155, NULL, '', '2018-06-12 12:50:19', 2, 'Manual', 0),
(19, 34, 0, 0, 140, NULL, '', '2018-06-12 13:03:27', 2, 'Manual', 0),
(20, 35, 0, 0, 240, NULL, '', '2018-06-12 13:08:18', 2, 'Manual', 0),
(21, 36, 0, 0, 240, NULL, '', '2018-06-12 13:10:32', 2, 'Manual', 0),
(22, 37, 0, 0, 200, NULL, '', '2018-06-12 13:59:25', 2, 'Manual', 0),
(23, 38, 0, 0, 200, NULL, '', '2018-06-12 14:02:27', 2, 'Manual', 0),
(24, 39, 0, 0, 170, NULL, '', '2018-06-12 15:47:13', 2, 'Manual', 0),
(25, 41, 0, 0, 340, NULL, '', '2018-06-12 15:54:12', 5, 'Manual', 0),
(26, 43, 0, 0, 280, NULL, '', '2018-06-12 15:58:42', 6, 'Manual', 0),
(27, 46, 0, 0, 290, NULL, '', '2018-06-12 16:16:22', 7, 'Manual', 0),
(28, 50, 0, 0, 70, NULL, '', '2018-06-12 16:37:30', 2, 'Manual', 0),
(29, 52, 0, 0, 880, NULL, '', '2018-06-12 17:08:18', 2, 'Manual', 0),
(30, 53, 0, 0, 40, NULL, '', '2018-06-12 17:38:33', 2, 'Manual', 0),
(31, 54, 0, 0, 550, NULL, '', '2018-06-12 17:40:32', 2, 'Manual', 0),
(32, 55, 0, 0, 180, NULL, '', '2018-06-12 18:03:08', 2, 'Manual', 0),
(33, 56, 0, 0, 80, NULL, '', '2018-06-13 04:09:12', 2, 'Manual', 0),
(34, 57, 0, 0, 70, NULL, '', '2018-06-13 05:06:55', 2, 'Manual', 0),
(35, 61, 0, 0, 220, NULL, '', '2018-06-13 09:34:57', 8, 'Manual', 0),
(36, 62, 0, 0, 215, NULL, '', '2018-06-13 10:20:32', 2, 'Manual', 0),
(37, 64, 0, 0, 45, NULL, '', '2018-06-13 10:26:23', 2, 'Manual', 0),
(38, 65, 0, 0, 260, NULL, '', '2018-06-13 10:30:09', 2, 'Manual', 0),
(39, 69, 0, 0, 210, NULL, '', '2018-06-13 14:02:05', 3, 'Manual', 0),
(40, 71, 0, 0, 320, NULL, '', '2018-06-13 14:09:34', 10, 'Manual', 0),
(41, 73, 0, 0, 245, NULL, '', '2018-06-13 14:38:56', 11, 'Manual', 0),
(42, 74, 0, 0, 190, NULL, '', '2018-06-13 15:07:12', 4, 'Manual', 0),
(43, 75, 0, 0, 315, NULL, '', '2018-06-13 15:32:06', 2, 'Manual', 0),
(44, 76, 0, 0, 70, NULL, '', '2018-06-13 15:46:55', 2, 'Manual', 0),
(45, 77, 0, 0, 70, NULL, '', '2018-06-13 15:50:21', 2, 'Manual', 0),
(46, 79, 0, 0, 70, NULL, '', '2018-06-13 15:52:09', 12, 'Manual', 0),
(47, 80, 0, 0, 70, NULL, '', '2018-06-13 15:56:05', 2, 'Manual', 0),
(48, 81, 0, 0, 70, NULL, '', '2018-06-13 16:00:19', 2, 'Manual', 0),
(49, 82, 0, 0, 70, NULL, '', '2018-06-13 16:01:01', 2, 'Manual', 0),
(50, 83, 0, 0, 145, NULL, '', '2018-06-13 16:09:37', 3, 'Manual', 0),
(51, 84, 0, 0, 70, NULL, '', '2018-06-13 16:11:23', 2, 'Manual', 0),
(52, 85, 0, 0, 70, NULL, '', '2018-06-13 16:12:18', 2, 'Manual', 0),
(53, 86, 0, 0, 70, NULL, '', '2018-06-13 16:13:35', 2, 'Manual', 0),
(54, 87, 0, 0, 70, NULL, '', '2018-06-13 16:14:55', 3, 'Manual', 0),
(55, 88, 0, 0, 70, NULL, '', '2018-06-13 16:23:28', 2, 'Manual', 0),
(56, 90, 0, 0, 220, NULL, '', '2018-06-13 16:25:27', 2, 'Manual', 0),
(57, 91, 0, 0, 70, NULL, '', '2018-06-13 16:28:57', 2, 'Manual', 0),
(58, 92, 0, 0, 140, NULL, '', '2018-06-13 16:47:13', 2, 'Manual', 0),
(59, 95, 0, 0, 70, NULL, '', '2018-06-13 16:53:19', 2, 'Manual', 0),
(60, 97, 0, 0, 140, NULL, '', '2018-06-13 17:02:20', 2, 'Manual', 0),
(61, 98, 0, 0, 960, NULL, '', '2018-06-13 17:03:13', 2, 'Manual', 0),
(62, 99, 0, 0, 1355, NULL, '', '2018-06-13 17:15:30', 2, 'Manual', 0),
(63, 100, 0, 0, 70, NULL, '', '2018-06-13 17:20:53', 2, 'Manual', 0),
(64, 101, 0, 0, 70, NULL, '', '2018-06-13 17:22:53', 2, 'Manual', 0),
(65, 103, 0, 0, 820, NULL, '', '2018-06-13 17:36:35', 2, 'Manual', 0),
(66, 104, 0, 0, 250, NULL, '', '2018-06-13 17:48:10', 9, 'Manual', 0),
(67, 106, 0, 0, 80, NULL, '', '2018-06-14 04:39:43', 13, 'Manual', 0),
(68, 108, 0, 0, 85, NULL, '', '2018-06-14 05:00:15', 3, 'Manual', 0),
(69, 109, 0, 0, 270, NULL, '', '2018-06-14 06:27:10', 3, 'Manual', 0),
(70, 110, 0, 0, 70, NULL, '', '2018-06-14 11:42:49', 2, 'Manual', 0),
(71, 111, 0, 0, 725, NULL, '', '2018-06-14 12:32:13', 2, 'Manual', 0),
(72, 112, 0, 0, 90, NULL, '', '2018-06-14 14:41:49', 2, 'Manual', 0),
(73, 113, 0, 0, 210, NULL, '', '2018-06-14 16:02:28', 2, 'Manual', 0),
(74, 115, 0, 0, 500, NULL, '', '2018-06-14 16:30:58', 14, 'Manual', 0),
(75, 117, 0, 0, 255, NULL, '', '2018-06-14 17:18:34', 15, 'Manual', 0),
(76, 118, 0, 0, 500, NULL, '', '2018-06-14 17:26:32', 2, 'Manual', 0),
(77, 119, 0, 0, 255, NULL, '', '2018-06-14 17:35:36', 15, 'Manual', 0),
(78, 120, 0, 0, 320, NULL, '', '2018-06-14 17:43:17', 2, 'Manual', 0),
(79, 121, 0, 0, 75, NULL, '', '2018-06-15 06:15:47', 3, 'Manual', 0),
(80, 124, 0, 0, 75, NULL, '', '2018-06-15 06:16:44', 3, 'Manual', 0),
(81, 125, 0, 0, 75, NULL, '', '2018-06-15 06:51:20', 3, 'Manual', 0),
(82, 126, 0, 0, 2040, NULL, '', '2018-06-15 07:49:32', 4, 'Manual', 0),
(83, 127, 0, 0, 240, NULL, '', '2018-06-15 08:28:00', 3, 'Manual', 0),
(84, 128, 0, 0, 1560, NULL, '', '2018-06-15 08:31:23', 3, 'Manual', 0),
(85, 129, 0, 0, 240, NULL, '', '2018-06-15 08:31:51', 4, 'Manual', 0),
(86, 130, 0, 0, 230, NULL, '', '2018-06-15 09:16:19', 3, 'Manual', 0),
(87, 132, 0, 0, 140, NULL, '', '2018-06-15 10:40:36', 2, 'Manual', 0),
(88, 133, 0, 0, 70, NULL, '', '2018-06-15 10:41:40', 2, 'Manual', 0),
(89, 134, 0, 0, 10, NULL, '', '2018-06-15 10:51:07', 2, 'Manual', 0),
(90, 135, 0, 0, 80, NULL, '', '2018-06-15 11:04:14', 2, 'Manual', 0),
(91, 136, 0, 0, 220, NULL, '', '2018-06-15 12:25:37', 4, 'Manual', 0),
(92, 137, 0, 0, 80, NULL, '', '2018-06-15 13:07:26', 4, 'Manual', 0),
(93, 139, 0, 0, 190, NULL, '', '2018-06-15 15:07:39', 16, 'Manual', 0),
(94, 141, 0, 0, 440, NULL, '', '2018-06-15 15:13:36', 17, 'Manual', 0),
(95, 143, 0, 0, 230, NULL, '', '2018-06-15 15:18:36', 18, 'Manual', 0),
(96, 145, 0, 0, 145, NULL, '', '2018-06-15 15:27:25', 2, 'Manual', 0),
(97, 146, 0, 0, 400, NULL, '', '2018-06-15 15:47:08', 2, 'Manual', 0),
(98, 147, 0, 0, 400, NULL, '', '2018-06-15 15:52:30', 2, 'Manual', 0),
(99, 149, 0, 0, 220, NULL, '', '2018-06-15 16:15:57', 2, 'Manual', 0),
(100, 150, 0, 0, 130, NULL, '', '2018-06-15 16:34:33', 2, 'Manual', 0),
(101, 151, 0, 0, 340, NULL, '', '2018-06-15 16:46:39', 7, 'Manual', 0),
(102, 152, 0, 0, 1580, NULL, '', '2018-06-15 17:05:00', 2, 'Manual', 0),
(103, 153, 0, 0, 80, NULL, '', '2018-06-15 17:58:51', 2, 'Manual', 0),
(104, 155, 0, 0, 420, NULL, '', '2018-06-16 05:16:06', 3, 'Manual', 0),
(105, 156, 0, 0, 250, NULL, '', '2018-06-16 05:35:23', 3, 'Manual', 0),
(106, 157, 0, 0, 285, NULL, '', '2018-06-16 05:36:07', 3, 'Manual', 0),
(107, 158, 0, 0, 480, NULL, '', '2018-06-16 07:58:09', 2, 'Manual', 0),
(108, 160, 0, 0, 2525, NULL, '', '2018-06-16 08:02:11', 19, 'Manual', 0),
(109, 161, 0, 0, 70, NULL, '', '2018-06-16 08:02:40', 3, 'Manual', 0),
(110, 162, 0, 0, 680, NULL, '', '2018-06-16 08:29:13', 4, 'Manual', 0),
(111, 164, 0, 0, 410, NULL, '', '2018-06-16 08:42:35', 20, 'Manual', 0),
(112, 165, 0, 0, 500, NULL, '', '2018-06-16 10:05:13', 3, 'Manual', 0),
(113, 167, 0, 0, 400, NULL, '', '2018-06-16 10:09:43', 21, 'Manual', 0),
(114, 168, 0, 0, 230, NULL, '', '2018-06-16 13:07:40', 2, 'Manual', 0),
(115, 170, 0, 0, 170, NULL, '', '2018-06-16 13:17:33', 22, 'Manual', 0),
(116, 171, 0, 0, 410, NULL, '', '2018-06-16 14:35:05', 2, 'Manual', 0),
(117, 172, 0, 0, 230, NULL, '', '2018-06-16 14:59:39', 2, 'Manual', 0),
(118, 173, 0, 0, 1530, NULL, '', '2018-06-16 15:58:45', 2, 'Manual', 0),
(119, 174, 0, 0, 580, NULL, '', '2018-06-16 16:21:02', 2, 'Manual', 0),
(120, 175, 0, 0, 105, NULL, '', '2018-06-16 17:43:45', 2, 'Manual', 0),
(121, 176, 0, 0, 80, NULL, '', '2018-06-16 18:11:33', 2, 'Manual', 0),
(122, 177, 0, 0, 1210, NULL, '', '2018-06-17 09:11:43', 3, 'Manual', 0),
(123, 178, 0, 0, 85, NULL, '', '2018-06-17 09:56:29', 3, 'Manual', 0),
(124, 179, 0, 0, 390, NULL, '', '2018-06-17 12:01:53', 3, 'Manual', 0),
(125, 181, 0, 0, 335, NULL, '', '2018-06-17 12:30:53', 23, 'Manual', 0),
(126, 182, 0, 0, 230, NULL, '', '2018-06-17 12:47:45', 3, 'Manual', 0),
(127, 183, 0, 0, 320, NULL, '', '2018-06-17 13:08:38', 2, 'Manual', 0),
(128, 184, 0, 0, 320, NULL, '', '2018-06-17 13:13:08', 3, 'Manual', 0),
(129, 187, 0, 0, 340, NULL, '', '2018-06-17 13:56:53', 24, 'Manual', 0),
(130, 189, 0, 0, 500, NULL, '', '2018-06-17 14:23:27', 25, 'Manual', 0),
(131, 190, 0, 0, 340, NULL, '', '2018-06-17 14:44:35', 25, 'Manual', 0),
(132, 196, 0, 0, 340, NULL, '', '2018-06-17 14:59:19', 3, 'Manual', 0),
(133, 208, 0, 0, 170, NULL, '', '2018-06-17 15:43:20', 2, 'Manual', 0),
(134, 210, 0, 0, 170, NULL, '', '2018-06-17 15:45:23', 28, 'Manual', 0),
(135, 212, 0, 0, 700, NULL, '', '2018-06-17 15:57:45', 29, 'Manual', 0),
(136, 216, 0, 0, 210, NULL, '', '2018-06-17 16:09:44', 2, 'Manual', 0),
(137, 218, 0, 0, 210, NULL, '', '2018-06-17 16:21:34', 30, 'Manual', 0),
(138, 219, 0, 0, 1570, NULL, '', '2018-06-17 16:37:57', 2, 'Manual', 0),
(139, 220, 0, 0, 215, NULL, '', '2018-06-17 16:41:39', 2, 'Manual', 0),
(140, 221, 0, 0, 255, NULL, '', '2018-06-17 17:36:50', 2, 'Manual', 0),
(141, 224, 0, 0, 235, NULL, '', '2018-06-18 05:24:04', 3, 'Manual', 0),
(142, 227, 0, 0, 500, NULL, '', '2018-06-18 05:55:51', 2, 'Manual', 0),
(143, 228, 0, 0, 150, NULL, '', '2018-06-18 05:56:27', 3, 'Manual', 0);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `customer_order`
--
ALTER TABLE `customer_order`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=340;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `fake_order`
--
ALTER TABLE `fake_order`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

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
  MODIFY `Ingredients_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

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
  MODIFY `Menu_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `menu_batter_rel`
--
ALTER TABLE `menu_batter_rel`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `menu_ingridient_rel`
--
ALTER TABLE `menu_ingridient_rel`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `opening_amount`
--
ALTER TABLE `opening_amount`
  MODIFY `opening_amount_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `Order_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=229;

--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=199;

--
-- AUTO_INCREMENT for table `payment_details`
--
ALTER TABLE `payment_details`
  MODIFY `payment_details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `sales_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
