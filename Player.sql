-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 06, 2016 at 11:40 PM
-- Server version: 10.0.27-MariaDB-0ubuntu0.16.04.1
-- PHP Version: 7.0.8-0ubuntu0.16.04.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Player`
--

-- --------------------------------------------------------

--
-- Table structure for table `Player`
--

CREATE TABLE `Player` (
  `PlayerID` varchar(12) NOT NULL,
  `Name` varchar(50) DEFAULT NULL,
  `Credits` bigint(20) UNSIGNED NOT NULL DEFAULT '2000',
  `LifetimeSpins` int(7) UNSIGNED DEFAULT '0',
  `LifetimeWinnings` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `Salt` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Player`
--

INSERT INTO `Player` (`PlayerID`, `Name`, `Credits`, `LifetimeSpins`, `LifetimeWinnings`, `Salt`) VALUES
('8711', 'Devin Nemec', 2000, 0, 0, '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Player`
--
ALTER TABLE `Player`
  ADD PRIMARY KEY (`PlayerID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
