-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2026 at 04:11 PM
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
-- Database: `fuzzy_sawit`
--

-- --------------------------------------------------------

--
-- Table structure for table `hasil_produksi`
--

CREATE TABLE `hasil_produksi` (
  `id` int(11) NOT NULL,
  `input_id` int(11) DEFAULT NULL,
  `nilai_produksi` float NOT NULL,
  `kategori_produksi` varchar(20) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `input_produksi`
--

CREATE TABLE `input_produksi` (
  `id` int(11) NOT NULL,
  `permintaan` float NOT NULL,
  `persediaan` float NOT NULL,
  `tanggal` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hasil_produksi`
--
ALTER TABLE `hasil_produksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `input_id` (`input_id`);

--
-- Indexes for table `input_produksi`
--
ALTER TABLE `input_produksi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hasil_produksi`
--
ALTER TABLE `hasil_produksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `input_produksi`
--
ALTER TABLE `input_produksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hasil_produksi`
--
ALTER TABLE `hasil_produksi`
  ADD CONSTRAINT `hasil_produksi_ibfk_1` FOREIGN KEY (`input_id`) REFERENCES `input_produksi` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
