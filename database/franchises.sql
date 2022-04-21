-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 04, 2022 at 01:14 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inst_comp`
--

-- --------------------------------------------------------

--
-- Table structure for table `franchises`
--

CREATE TABLE `franchises` (
  `id` int(12) NOT NULL,
  `franchise_name` varchar(150) DEFAULT NULL,
  `subtitle` text DEFAULT NULL,
  `affiliation` text DEFAULT NULL,
  `registration` text DEFAULT NULL,
  `iso` text DEFAULT NULL,
  `code` varchar(25) DEFAULT NULL,
  `address` varchar(150) DEFAULT NULL,
  `contact` varchar(25) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `franchises`
--

INSERT INTO `franchises` (`id`, `franchise_name`, `subtitle`, `affiliation`, `registration`, `iso`, `code`, `address`, `contact`, `created_at`, `updated_at`) VALUES
(1, 'Franchise-1', NULL, NULL, NULL, NULL, NULL, 'Franchise-1', '9956897845', NULL, NULL),
(2, 'Franchise-2', NULL, NULL, NULL, NULL, NULL, 'Franchise-2', '9956897845', NULL, NULL),
(5, 'Franchise-3', NULL, NULL, NULL, NULL, '002', 'MM Road', '999999999', NULL, NULL),
(6, 'Franchise-4', NULL, NULL, NULL, NULL, 'FRAN002', 'MM Road', '9932898989', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `franchises`
--
ALTER TABLE `franchises`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `franchises`
--
ALTER TABLE `franchises`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
