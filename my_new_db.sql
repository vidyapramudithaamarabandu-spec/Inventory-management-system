-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 10, 2026 at 09:57 AM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `my_new_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `PRODUCT_NAME` varchar(255) NOT NULL,
  `product_category` varchar(100) DEFAULT NULL,
  `brand` varchar(100) NOT NULL,
  `contact_no` varchar(10) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `ADDRESS` text,
  `current_stock` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `PRODUCT_NAME`, `product_category`, `brand`, `contact_no`, `email`, `ADDRESS`, `current_stock`) VALUES
(8, 'STROBERRY JAM', 'JAM', 'MD', '0114356879', 'vidya.pramuditha.amarabandu@gmail.com', 'INGIRIYA', 1342),
(10, 'BLUE BERRY JAM', 'JAM', 'MD', '0114356879', 'vidya.pramuditha.amarabandu@gmail.com', 'INGIRIYA', 10),
(11, 'MILK MADE', 'DAIRY', 'HILAND', '0112343887', 'vidya.pramuditha.amarabandu@gmail.com', 'RAJAGIRIYA', 167),
(12, 'MILK MADE', 'DAIRY', 'HILAND', '0112343887', 'vidya.pramuditha.amarabandu@gmail.com', 'RAJAGIRIYA', 0),
(13, 'MD CODIEL', 'DAIRY', 'MD', '0112343887', 'vidya.pramuditha.amarabandu@gmail.com', 'sasa', 700),
(15, 'CR BOOK SINGLE RULED', 'STATIONARY', 'ATLAS', '0112343887', 'customerfeedback@atlasaxillia.com', 'PILIYAGODA', 87),
(18, 'CR BOOK SQURE RULED', 'STATIONARY', 'ATLAS', '0112343887', 'customerfeedback@atlasaxillia.com', 'PILIYAGODA', 53),
(19, 'CR BOOK ', 'STATIONARY', 'ATLAS', '0112343887', 'customerfeedback@atlasaxillia.com', 'PILIYAGODA', 91),
(20, 'MILK TOFFEE', 'DAIRY', 'HILAND', '0778679442', 'customerfeedback@hiland.com', 'PILIYAGODA', 0),
(21, 'MARSHMELLOWS', 'DAIRY', 'HILAND', '0778679442', 'customerfeedback@hiland.com', 'PILIYAGODA', 90),
(22, 'MOZERALLA CHEESE', 'DAIRY', 'HILAND', '0778679442', 'customerfeedback@hiland.com', 'PILIYAGODA', 3),
(23, 'MIONEESE CHEESE', 'DAIRY', 'HILAND', '0778679442', 'customerfeedback@hiland.com', 'PILIYAGODA', 60);

-- --------------------------------------------------------

--
-- Table structure for table `stock_log`
--

CREATE TABLE IF NOT EXISTS `stock_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `type` enum('in','out') DEFAULT NULL,
  `movement_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `stock_transactions`
--

CREATE TABLE IF NOT EXISTS `stock_transactions` (
  `transaction_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `transaction_type` enum('IN','OUT') NOT NULL,
  `quality` int(11) NOT NULL,
  `transaction_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`transaction_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE IF NOT EXISTS `suppliers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `supplier_id` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `contact_no` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `registration_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `supplier_id` (`supplier_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `supplier_id`, `name`, `contact_no`, `address`, `registration_date`) VALUES
(7, '1005', 'THANUSHKA', '0778103918', 'ILIMBA', '2026-04-26 04:05:28'),
(8, '1006', 'YASURI DAHAMSA', '0771225365', 'INGIRIYA', '2026-04-26 04:19:29'),
(10, '1007', 'THARUSHA', '8973382738232', 'HORANA', '2026-04-26 04:32:45'),
(12, '1008', 'MATHEESHA', '0778679442', 'HORANA', '2026-04-26 04:36:06'),
(14, '1009', 'SUMANASIRI', '0773809662', 'INGIRIYA', '2026-04-26 04:38:47'),
(15, '1010', 'SUNIL', '0773809662', 'INGIRIYA', '2026-04-26 04:39:34'),
(18, '1011', 'RAMIRU', '0773809662', 'INGIRIYA', '2026-04-26 04:41:37'),
(19, '1012', 'GAYAN', '0773809662', 'INGIRIYA', '2026-04-26 04:42:42'),
(21, '1013', 'GAYANI', '0778679442', 'PANADURA', '2026-04-26 11:37:42'),
(22, '1014', 'MADUKA', '0778679442', 'PANADURA', '2026-04-27 16:56:20'),
(23, '1015', 'MANOJ', '0778679442', 'PANADURA', '2026-04-28 04:38:36'),
(26, '1017', 'SAJITH', '0778679442', 'INGIRIYA', '2026-04-29 07:56:46'),
(28, '1019', 'GIMHANA JAYATHILAKA', '0778679442', 'INGIRIYA', '2026-04-29 10:47:47'),
(29, '1020', 'SANIJA MANTHILA', '0778679442', 'INGIRIYA', '2026-04-30 04:54:39'),
(32, '1004', 'ARUNA AMARABANDU', '0778679442', 'INGIRIYA', '2026-04-30 10:53:12'),
(34, '1023', 'KASUN', '0710564848', 'MATHARA', '2026-05-02 14:22:03'),
(35, '1024', 'MADUSANKA', '0710564848', 'MATHARA', '2026-05-04 02:37:28');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password_harch` varchar(100) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `password_harch` (`password_harch`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password_harch`, `create_at`) VALUES
(7, 'admin', 'admin@2007', '2026-05-04 03:29:40'),
(8, 'IMS', '12345', '2026-10-10 07:26:58');

-- --------------------------------------------------------

--
-- Table structure for table `user_verifications`
--

CREATE TABLE IF NOT EXISTS `user_verifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `verification_type` varchar(50) NOT NULL,
  `is_used` tinyint(1) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `expires_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `idx_verification_token` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `stock_log`
--
ALTER TABLE `stock_log`
  ADD CONSTRAINT `stock_log_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `stock_transactions`
--
ALTER TABLE `stock_transactions`
  ADD CONSTRAINT `stock_transactions_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Constraints for table `user_verifications`
--
ALTER TABLE `user_verifications`
  ADD CONSTRAINT `user_verifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
