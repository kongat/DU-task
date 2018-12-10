-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 03, 2018 at 09:50 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `digitalup_task`
--

-- --------------------------------------------------------

--
-- Table structure for table `exercise`
--

CREATE TABLE `exercise` (
  `name` text NOT NULL,
  `email` text NOT NULL,
  `hashed_password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `exercise`
--

INSERT INTO `exercise` (`name`, `email`, `hashed_password`) VALUES
('kostas gatis', 'elgato@gmail.com', '$2y$10$T6KDNWo.1vKkw/Z4mNEgPOO8MBHhrqo4GhdSJEOoSxlUvsZY16V66'),
('spiros', 'spiros@gmail.com', '$2y$10$R/B3EN1tFlSko5U/5d6QZusqqq.Ajc6PmA1GxmNVTuFZvm1pATZBq'),
('cris', 'criss@gmail.com', '$2y$10$v/.AHvs7cq1YDtYgZPEATueMYY8csERugIeiYHBFsSW/ZjejarB5K'),
('stef', 'stef@gmail.com', '$2y$10$WW49GR/ckGWv5Hvkd3YRW.4BmHcG6SVUreFPJ7Qs11mOpYb5L7e7i'),
('panos', 'panos@gmail.com', '$2y$10$8.xmhi0rKXHIwxbq3ImdfuAvMbRXH8kSz45tvCjpV4Zf1iOvZ.w0e'),
('mitsos', 'mitsos@gmail.com', '$2y$10$gorSQxliF12QXlIfOoaK2OE02T3hHGR3.3uE0Mk2RE2eZINCm3WnK'),
('andreas', 'andreas@gmail.com', '$2y$10$Qh92WXXSkzPRzSCZDgeVjOHzw4S.9RVZmoWSVHZLrZpOAumTYo8xO'),
('george', 'george@gmail.com', '$2y$10$kuIG7nDWbkutp3hWb.khROVEEvq9VIO0V.1sfEsBcHFB.3ozxiQxe');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
