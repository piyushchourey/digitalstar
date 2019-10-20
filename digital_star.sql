-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 20, 2019 at 02:12 PM
-- Server version: 5.6.38-log
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `digital_star`
--

-- --------------------------------------------------------

--
-- Table structure for table `campaign`
--

DROP TABLE IF EXISTS `campaign`;
CREATE TABLE IF NOT EXISTS `campaign` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `dateTime` datetime NOT NULL,
  `createdBy` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `createdBy` (`createdBy`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `category_type` int(11) NOT NULL,
  `cat_img` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `category_type`, `cat_img`) VALUES
(8, 'Tifin', 2, '5a69c71862142.jpg'),
(10, 'Starter', 1, '5a69c6cbf0912.png'),
(11, 'Sweets', 1, '5a69c70102757.jpg'),
(12, 'Salad', 1, '5a69c71862142.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `category_type_info`
--

DROP TABLE IF EXISTS `category_type_info`;
CREATE TABLE IF NOT EXISTS `category_type_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_name` varchar(500) NOT NULL,
  `pack_type` varchar(500) NOT NULL,
  `pack_timing` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category_type_info`
--

INSERT INTO `category_type_info` (`id`, `type_name`, `pack_type`, `pack_timing`) VALUES
(1, 'regular', 'daily', 'everyTiming'),
(2, 'pack', 'weekly,monthly', 'onetime,twotime');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

DROP TABLE IF EXISTS `employee`;
CREATE TABLE IF NOT EXISTS `employee` (
  `id` int(11) NOT NULL,
  `name` int(11) NOT NULL,
  `lastname` int(11) NOT NULL,
  `image` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

DROP TABLE IF EXISTS `login`;
CREATE TABLE IF NOT EXISTS `login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(250) NOT NULL,
  `password` varchar(500) NOT NULL,
  `type` varchar(200) NOT NULL,
  `mobileNumber` int(11) NOT NULL,
  `dateTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `otp` int(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT '1=approve,0=disapprove',
  `manager_id` int(11) NOT NULL COMMENT 'refernce id of user',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `email`, `password`, `type`, `mobileNumber`, `dateTime`, `otp`, `status`, `manager_id`) VALUES
(1, 'admin@gmail.com', '18d8042386b79e2c279fd162df0205c8', 'admin', 0, '2019-09-16 02:18:28', 0, 1, 0),
(5, 'nikita@thedigitalstar.in', '18d8042386b79e2c279fd162df0205c8', 'Manager', 2147483647, '2019-09-21 00:32:12', 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

DROP TABLE IF EXISTS `order_detail`;
CREATE TABLE IF NOT EXISTS `order_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` float NOT NULL,
  `category_id` int(11) NOT NULL,
  `o_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`id`, `order_id`, `p_id`, `qty`, `price`, `category_id`, `o_date`) VALUES
(1, 2, 1, 2, 117.6, 2, '0000-00-00 00:00:00'),
(2, 3, 1, 1, 117.6, 2, '0000-00-00 00:00:00'),
(3, 3, 2, 1, 115.2, 3, '0000-00-00 00:00:00'),
(6, 6, 1, 1, 117.6, 1, '2018-01-28 18:15:39'),
(7, 6, 4, 1, 170, 1, '2018-01-28 18:15:39'),
(8, 7, 1, 1, 117.6, 1, '2018-01-28 18:36:04'),
(9, 7, 4, 1, 170, 1, '2018-01-28 18:36:04'),
(10, 8, 1, 1, 117.6, 1, '2018-01-28 19:07:13'),
(11, 9, 2, 1, 115.2, 3, '2018-01-28 19:08:20'),
(12, 10, 2, 1, 115.2, 1, '2018-01-28 19:09:58'),
(13, 11, 2, 1, 115.2, 1, '2018-01-28 19:10:47'),
(14, 12, 1, 1, 117.6, 1, '2018-01-28 19:13:21'),
(16, 17, 2, 1, 115.2, 1, '2018-01-28 19:20:56'),
(17, 17, 1, 1, 117.6, 1, '2018-01-28 19:20:56'),
(18, 18, 1, 9, 117.6, 2, '2018-01-28 19:21:20'),
(19, 22, 1, 4, 117.6, 2, '2018-01-28 19:28:53'),
(20, 23, 1, 1, 117.6, 2, '2018-01-28 19:44:45');

-- --------------------------------------------------------

--
-- Table structure for table `order_info`
--

DROP TABLE IF EXISTS `order_info`;
CREATE TABLE IF NOT EXISTS `order_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `total_amount` float NOT NULL,
  `user_id` int(11) NOT NULL,
  `o_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` text NOT NULL,
  `d_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `payment_type` text NOT NULL,
  `payment_id` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_info`
--

INSERT INTO `order_info` (`id`, `total_amount`, `user_id`, `o_date`, `status`, `d_time`, `payment_type`, `payment_id`) VALUES
(2, 235.2, 18, '0000-00-00 00:00:00', 'in progress', '0000-00-00 00:00:00', 'online', 'pay_9Uokg9NTJJ4I6b'),
(3, 232.8, 18, '0000-00-00 00:00:00', 'in progress', '0000-00-00 00:00:00', 'online', 'pay_9UorGuPBVFQgXv'),
(6, 287.6, 17, '2018-01-28 18:15:39', 'in progress', '0000-00-00 00:00:00', 'payment_recieved', 'pay_9V6aqDpupayGvv'),
(7, 287.6, 17, '2018-01-28 18:36:04', 'in progress', '0000-00-00 00:00:00', 'payment_recieved', 'pay_9V7teg0WOFvp9W'),
(8, 117.6, 17, '2018-01-28 19:07:13', 'in progress', '0000-00-00 00:00:00', 'payment_recieved', 'pay_9V8Qh3doD5pTtk'),
(9, 115.2, 19, '2018-01-28 19:08:19', 'in progress', '0000-00-00 00:00:00', 'online', 'pay_9V8Rt12VcpOrt0'),
(10, 115.2, 17, '2018-01-28 19:09:58', 'in progress', '0000-00-00 00:00:00', 'payment_recieved', 'pay_9V8Rwjm7hZD428'),
(11, 115.2, 17, '2018-01-28 19:10:47', 'in progress', '0000-00-00 00:00:00', 'payment_recieved', 'pay_9V8Rwjm7hZD428'),
(12, 117.6, 17, '2018-01-28 19:13:21', 'in progress', '0000-00-00 00:00:00', 'payment_recieved', 'pay_9V8XALsyfXdMqF'),
(17, 232.8, 17, '2018-01-28 19:20:56', 'in progress', '0000-00-00 00:00:00', 'payment_recieved', 'pay_9V8fBeo3QfW880'),
(18, 1058.4, 19, '2018-01-28 19:21:20', 'in progress', '0000-00-00 00:00:00', 'online', 'pay_9V8fdaezoDINvI'),
(22, 470.4, 19, '2018-01-28 19:28:53', 'in progress', '0000-00-00 00:00:00', 'online', 'pay_9V8nbnUIoDY9sZ'),
(23, 117.6, 19, '2018-01-28 19:44:45', 'in progress', '0000-00-00 00:00:00', 'online', 'pay_9V94MOLillQUDT');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pack_type` varchar(200) NOT NULL,
  `name` varchar(250) NOT NULL,
  `category_id` int(11) NOT NULL,
  `price` float NOT NULL,
  `discount_type` varchar(200) NOT NULL,
  `discount` float NOT NULL,
  `discount_price` float NOT NULL,
  `description` text NOT NULL,
  `image` text NOT NULL,
  `status` int(11) NOT NULL COMMENT '0=disapprove,1=approve',
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `pack_type`, `name`, `category_id`, `price`, `discount_type`, `discount`, `discount_price`, `description`, `image`, `status`, `date`) VALUES
(1, '', 'Dal', 2, 120, 'percentage', 2, 117.6, 'Dal with Spice.', '5a6b16a1032f3.jpg', 1, '2018-01-16'),
(2, '', 'Khichdi special', 3, 120, 'percentage', 4, 115.2, 'Butter khichdi special..', '5a5f98e4a21fe.jpg', 1, '2018-01-17'),
(4, 'monthly', 'Dal tadka', 8, 180, 'rupee', 10, 170, '5 Chapati + Dal + Seasonal Vegetables + Special Vegetables + Rice + Salad + Papad + Pickle + Rayta + Dessert', '5a6431fe07c06.jpg', 1, '2018-01-21'),
(5, '', 'chilly paneer', 10, 120, '', 0, 0, 'Spicy chilly paneer with butter', '5a6b882384fbb.png', 1, '2018-01-26'),
(6, 'weekly', 'Weekly Tifin Dhamaka', 8, 1200, 'rupee', 100, 1100, '5 Chapati + Dal + Seasonal Vegetables + Special Vegetables + Rice + Salad + Papad + Pickle + Rayta + Dessert', '5a6f2777818e3.jpg', 1, '2018-01-29'),
(7, 'weekly', 'Weekly Dal Bati ', 8, 1200, 'rupee', 100, 1100, '5 Chapati + Dal + Seasonal Vegetables + Special Vegetables + Rice + Salad + Papad + Pickle + Rayta + Dessert', '5a6f2777818e3.jpg', 1, '2018-01-29'),
(8, 'monthly', 'Month Dhamal..', 8, 180, 'rupee', 10, 170, '5 Chapati + Dal + Seasonal Vegetables + Special Vegetables + Rice + Salad + Papad + Pickle + Rayta + Dessert', '5a6431fe07c06.jpg', 1, '2018-01-21');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`) VALUES
(1, 'Manager'),
(2, 'Finance');

-- --------------------------------------------------------

--
-- Table structure for table `subscription`
--

DROP TABLE IF EXISTS `subscription`;
CREATE TABLE IF NOT EXISTS `subscription` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `pack_nm` varchar(200) NOT NULL,
  `pack_timing` int(10) NOT NULL,
  `price` float NOT NULL,
  `discount_type` varchar(200) NOT NULL,
  `discount` float NOT NULL,
  `description` text NOT NULL,
  `image` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subscription`
--

INSERT INTO `subscription` (`id`, `pack_nm`, `pack_timing`, `price`, `discount_type`, `discount`, `description`, `image`, `status`, `date_time`) VALUES
(2, 'monthly', 2, 2400, 'percentage', 5, 'sdfdsfd', '5a60ec84af742.jpg', 1, '2018-01-19 00:20:44');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(500) NOT NULL,
  `email` varchar(500) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `alternate_mobile` varchar(20) NOT NULL,
  `address` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `campaign`
--
ALTER TABLE `campaign`
  ADD CONSTRAINT `campaign_ibfk_1` FOREIGN KEY (`createdBy`) REFERENCES `login` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
