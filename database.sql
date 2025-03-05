-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 05, 2025 at 07:02 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `data_siswa`
--

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id_siswa` int NOT NULL,
  `nama_siswa` varchar(100) NOT NULL,
  `kelas` varchar(50) NOT NULL,
  `jurusan` varchar(50) NOT NULL,
  `tanggal_lahir` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `nama_siswa`, `kelas`, `jurusan`, `tanggal_lahir`) VALUES
(1, 'Andi Wijaya', 'X-RPL', 'Rekayasa Perangkat Lunak', '2007-05-12'),
(2, 'Budi Santoso', 'XI-TKJ', 'Teknik Komputer dan Jaringan', '2006-08-23'),
(3, 'Citra Dewi', 'XII-MM', 'Multimedia', '2005-11-30'),
(4, 'Dewi Lestari', 'X-RPL', 'Rekayasa Perangkat Lunak', '2007-02-14'),
(5, 'Eko Prasetyo', 'XI-TKJ', 'Teknik Komputer dan Jaringan', '2006-07-19'),
(6, 'Fani Rahmawati', 'XII-MM', 'Multimedia', '2005-09-25'),
(7, 'Gilang Saputra', 'X-RPL', 'Rekayasa Perangkat Lunak', '2007-03-05'),
(8, 'Hanafi Putra', 'XI-TKJ', 'Teknik Komputer dan Jaringan', '2006-12-12'),
(9, 'Indah Permata', 'XII-MM', 'Multimedia', '2005-04-18'),
(10, 'Joko Susilo', 'X-RPL', 'Rekayasa Perangkat Lunak', '2007-06-22'),
(11, 'Kartika Sari', 'XI-TKJ', 'Teknik Komputer dan Jaringan', '2006-10-10'),
(12, 'Lukman Hakim', 'XII-MM', 'Multimedia', '2005-01-15'),
(13, 'Maya Puspita', 'X-RPL', 'Rekayasa Perangkat Lunak', '2007-09-09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id_siswa`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id_siswa` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;
