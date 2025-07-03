-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 02, 2025 at 03:26 PM
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
-- Database: `emailverify`
--

-- --------------------------------------------------------

--
-- Table structure for table `emailregis`
--

CREATE TABLE `emailregis` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `cpassword` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `emailregis`
--

INSERT INTO `emailregis` (`id`, `username`, `email`, `mobile`, `password`, `cpassword`, `token`, `status`, `created_at`) VALUES
(14, 'RAJKUMAR ', 'rks701754@gmail.com', '7505064305', '$2y$10$gi5hDWTHz2aDoOVZl9Fv7eR/Ch4DbQH57wUb2pmEVsAs.R7vBfPwS', '$2y$10$/EU3Zz3NXhc4I5E8nY43kOzdN5qlOGGiTySxIHSnWRmBY5I05Gi2i', '257e53a98b58b822a86bae673e7f5745', 1, '2025-07-02 13:23:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `emailregis`
--
ALTER TABLE `emailregis`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `emailregis`
--
ALTER TABLE `emailregis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
