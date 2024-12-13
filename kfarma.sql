-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2024 at 08:45 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kfarma`
--

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `pasienId` int(11) NOT NULL,
  `pasienNama` varchar(50) DEFAULT NULL,
  `pasienNomor` varchar(50) DEFAULT NULL,
  `pasienJenisKelamin` varchar(50) DEFAULT NULL,
  `pasienTanggalLahir` date DEFAULT NULL,
  `pasienUsia` int(11) DEFAULT NULL,
  `pasienGolonganDarah` varchar(50) DEFAULT NULL,
  `pasienNomorKtp` varchar(50) DEFAULT NULL,
  `pasienStatus` int(1) DEFAULT 1,
  `pasienHapus` int(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pasien`
--

INSERT INTO `pasien` (`pasienId`, `pasienNama`, `pasienNomor`, `pasienJenisKelamin`, `pasienTanggalLahir`, `pasienUsia`, `pasienGolonganDarah`, `pasienNomorKtp`, `pasienStatus`, `pasienHapus`) VALUES
(8, 'Naufal Dzaky', 'KFAR1224001', 'Laki-Laki', '2006-08-10', 18, 'AB', '1902837462837462', 1, 0),
(9, 'Thoriq Shafwan', 'KFAR1224002', 'Laki-Laki', '2007-04-19', 17, 'AB', '4529837298236745', 1, 0),
(10, 'Alice Restituta', 'KFAR1224003', 'Perempuan', '2006-10-26', 18, 'A', '3839741102199216', 1, 0),
(11, 'Rafi Khairulah', 'KFAR1224004', 'Laki-Laki', '2006-03-18', 18, 'B', '4137747102199210', 1, 0),
(12, 'Thomas Christian', 'KFAR1224005', 'Laki-Laki', '2006-07-19', 18, 'O', '7838741102199217', 1, 0),
(13, 'Kaiyo Barasihan', 'KFAR1224006', 'Laki-Laki', '2006-08-17', 18, 'O', '1539741102176216', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `rekammedis`
--

CREATE TABLE `rekammedis` (
  `rekamMedisId` int(11) NOT NULL,
  `rekamMedisTanggalPeriksa` date DEFAULT NULL,
  `rekamMedisKode` varchar(50) DEFAULT NULL,
  `rekamMedisKeluhan` varchar(50) DEFAULT NULL,
  `rekamMedisPoli` varchar(50) DEFAULT NULL,
  `rekamMedisFaskes` varchar(50) DEFAULT NULL,
  `rekamMedisStatusPengaduan` tinyint(4) DEFAULT 0,
  `rekamMedisHapus` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rekammedis`
--

INSERT INTO `rekammedis` (`rekamMedisId`, `rekamMedisTanggalPeriksa`, `rekamMedisKode`, `rekamMedisKeluhan`, `rekamMedisPoli`, `rekamMedisFaskes`, `rekamMedisStatusPengaduan`, `rekamMedisHapus`) VALUES
(5, '2024-12-10', 'KFAR1224001', 'Batuk berdahak', 'Poli Umum', 'BPJS', 2, 0),
(7, '2024-12-10', 'KFAR1224003', 'Gigi berlubang', 'Poli Gigi', 'UMUM', 1, 0),
(8, '2024-12-10', 'KFAR1224002', 'Nafsu makan berkurang', 'Poli Gizi', 'BPJS', 2, 0),
(9, '2024-12-12', 'KFAR1224006', 'Batuk pilek', 'Poli Umum', 'UMUM', 2, 0),
(10, '2024-12-12', 'KFAR1224004', 'Sakit perut', 'Poli Umum', 'BPJS', 1, 0),
(11, '2024-12-12', 'KFAR1224006', 'Nyeri gusi', 'Poli Gigi', 'UMUM', 0, 0),
(12, '2024-12-12', 'KFAR1224003', 'Radang tenggorokan', 'Poli Umum', 'BPJS', 0, 1),
(13, '2024-12-12', 'KFAR1224002', 'Sering lapar', 'Poli Gizi', 'UMUM', 2, 0),
(14, '2024-12-13', 'KFAR1224005', 'Tidak mau makan', 'Poli Gizi', 'UMUM', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`pasienId`);

--
-- Indexes for table `rekammedis`
--
ALTER TABLE `rekammedis`
  ADD PRIMARY KEY (`rekamMedisId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pasien`
--
ALTER TABLE `pasien`
  MODIFY `pasienId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `rekammedis`
--
ALTER TABLE `rekammedis`
  MODIFY `rekamMedisId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
