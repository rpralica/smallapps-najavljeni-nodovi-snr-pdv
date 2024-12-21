-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 27, 2024 at 09:24 PM
-- Server version: 8.0.35
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `najaveradova`
--

-- --------------------------------------------------------

--
-- Table structure for table `najave`
--

CREATE TABLE `najave` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `element` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `lokacija` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `pocetak` datetime NOT NULL,
  `trajanje` datetime NOT NULL,
  `komentar` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `najave`
--

INSERT INTO `najave` (`id`, `element`, `lokacija`, `pocetak`, `trajanje`, `komentar`) VALUES
(1, 'sdfsdf', 'sdfsdf', '2024-06-06 12:00:00', '2024-06-29 12:00:00', 'sdfsdf'),
(3, 'qweqweqwe', 'qweqweqwe', '2024-06-05 12:00:00', '2024-06-05 12:00:00', 'qweqwe');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `najave`
--
ALTER TABLE `najave`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `najave`
--
ALTER TABLE `najave`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
