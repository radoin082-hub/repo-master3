-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 07, 2024 at 03:10 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `professor`
--

-- --------------------------------------------------------

--
-- Table structure for table `professor`
--

CREATE TABLE `professor` (
  `id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `passWord` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `professor`
--

INSERT INTO `professor` (`id`, `Name`, `passWord`, `email`) VALUES
(1, 'Berghida Meriem', '20032003', 'BerghidaMeriem@univ-biskra.com'),
(2, 'Akrour Djoher', '20032003', 'AkrourDjoher@univ-biskra.com'),
(3, 'Babahenini Djihane', '20032003', 'BabaheniniDjihen@univ-biskra.com'),
(4, 'Babahenini mohamed', '20032003', 'BabaheniniMohamed@univ-biskra.com'),
(5, 'Betira Rofaida', '20032003', 'BetiraRofaida@univ-biskra.com'),
(6, 'Babahenini Sara', '20032003', 'BabaheniniSara@univ-biskra.com'),
(7, 'Hattab Dalila', '20032003', 'hattabDalila@univ-biskra.com'),
(8, 'Tibarmacine Ahmed', '20032003', 'tibarmacineAhmed@univ-biskra.com'),
(9, 'Hamidi Zohra', '20032003', 'hamidiZohra@univ-biskra.com'),
(10, 'Hamida Ammar', '20032003', 'hamidaAmmar@univ-biskra.com'),
(11, 'Bennaoui Hammadi', '20032003', 'BennaouiHammadi@univ-biskra.com'),
(12, 'Bentrah Ahlem', '20032003', 'bentrahAhlem@univ-biskra.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `professor`
--
ALTER TABLE `professor`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `professor`
--
ALTER TABLE `professor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
