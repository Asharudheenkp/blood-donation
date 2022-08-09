-- phpMyAdmin SQL Dump
-- version 5.3.0-dev+20220727.b0c4426a43
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 28, 2022 at 06:44 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blood`
--
CREATE DATABASE IF NOT EXISTS `blood` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `blood`;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `address` varchar(250) NOT NULL,
  `type` varchar(250) NOT NULL,
  `phone` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `date` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `address`, `type`, `phone`, `password`, `date`) VALUES
(2, 'jojo', 'malappuram', 'B-', '2658754538', '5d08686ec98919bf063a58c0412838ea', '2022-07-22'),
(3, 'ashar', 'malappuram', 'O-', '7548961252', 'edb2fcd5b53da43436cd5a5d9ec3d3f9', '2022-07-25'),
(4, 'mark', 'kottayam', 'O+', '9678451268', 'bb65c351788e1d78ce8be8a1b3e76a79', '2022-07-25'),
(9, 'manoharan', 'calicut', 'A+', '2658754539', 'dc25c22524eb672f4747f65c136ea966', '2022-07-27'),
(11, 'adnan kp', 'malappuram', 'B-', '4559125649', '8e415cc2c4194c9c0469428ad2c9ffb7', '2022-07-20'),
(12, 'Jhon', 'kottayam', 'AB-', '2584657859', 'f7ac0316a7b88ec6600cad72d1835e6f', '2022-07-21'),
(17, 'anjali', 'palakkad', 'A-', '4852568947', '544cb87389cf6b8fe3c425e5845b205b', '2022-07-12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
