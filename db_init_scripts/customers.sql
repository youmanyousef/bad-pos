-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 16, 2026 at 10:58 PM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `customers`
--

-- --------------------------------------------------------

--
-- Table structure for table `archive`
--

DROP TABLE IF EXISTS `archive`;
CREATE TABLE IF NOT EXISTS `archive` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `time_start` datetime NOT NULL,
  `time_end` datetime NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `phone` text NOT NULL,
  `type` tinyint(1) NOT NULL COMMENT 'This is to index phones and laptops',
  `service` text NOT NULL,
  `notes` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `phone` text NOT NULL,
  `email` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`(70))
) ENGINE=MyISAM AUTO_INCREMENT=52 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

DROP TABLE IF EXISTS `invoice`;
CREATE TABLE IF NOT EXISTS `invoice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `time_start` datetime NOT NULL,
  `time_end` datetime NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `phone` text NOT NULL,
  `type` tinyint(1) NOT NULL COMMENT 'This is to index phones and laptops',
  `service` text NOT NULL,
  `notes` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=84 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`id`, `time_start`, `time_end`, `name`, `email`, `phone`, `type`, `service`, `notes`) VALUES
(1, '2021-09-21 12:11:03', '2021-09-25 12:11:03', 'Test', '8008008888', '5', 0, 'IPHONE X GLASS', 'shattered more than my heart'),
(2, '2021-09-27 17:08:00', '2021-10-06 17:08:00', '3', '3', '5', 2, 'IPHONE X GLASS', '3'),
(3, '2021-09-09 23:48:00', '2021-09-30 23:48:00', 'othername', '5555', '53', 0, 'IPHONE X GLASS', '333');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
