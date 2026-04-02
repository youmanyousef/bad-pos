-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 16, 2026 at 10:57 PM
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
-- Database: `users`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` text NOT NULL,
  `password` longtext NOT NULL,
  `log_path` text NOT NULL,
  `connected` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`(16)) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `log_path`, `connected`) VALUES
(14, 'otheruser', '$2y$10$b/ECqcI1GTtqqkp0Hq6f2O055df9Na9qWPAgy1gklCdZwlGYimWMq', './user', 1),
(13, 'dusername', '$2y$10$ikvNFVgY1NujHyigMHUsqeE9lt1SWE6LASjnKN/a2/m3geq59SugO', './user', 0),
(15, 'admin', '$2a$12$OfkMJB1rkiz3LG65oNnjueG.CXXscm4obMuELMyagZrn6Jh0mmDYS', './user', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
