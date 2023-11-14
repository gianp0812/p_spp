-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 14, 2023 at 03:50 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_spp`
--

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL,
  `nama_kelas` varchar(10) NOT NULL,
  `kompetensi_dasar` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nama_kelas`, `kompetensi_dasar`) VALUES
(1, 'XII', 'Rekayasa Perangkat Lunak'),
(2, 'XI', 'Teknik Komputer Jaringan');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `pesan` varchar(255) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_petugas` int(11) NOT NULL,
  `nisn` char(10) NOT NULL,
  `tgl_bayar` date NOT NULL,
  `bulan_bayar` varchar(8) NOT NULL,
  `tahun_bayar` varchar(4) NOT NULL,
  `id_spp` int(11) NOT NULL,
  `jumlah_bayar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_petugas`, `nisn`, `tgl_bayar`, `bulan_bayar`, `tahun_bayar`, `id_spp`, `jumlah_bayar`) VALUES
(36, 1, '1234567890', '2023-10-22', 'October', '2023', 1, 500000),
(37, 1, '1234567890', '2023-10-22', 'October', '2023', 1, 400000),
(38, 1, '1234567890', '2023-10-22', 'October', '2023', 1, 600000),
(39, 1, '1234567890', '2023-10-23', 'October', '2023', 4, 500000),
(42, 1, '1234567890', '2023-10-23', 'October', '2023', 4, 250000),
(44, 1, '1234567800', '2023-10-23', 'October', '2023', 1, 1000000),
(45, 1, '1234567890', '2023-10-24', 'October', '2023', 4, 250000),
(46, 1, '1234567000', '2023-10-25', 'October', '2023', 4, 500000),
(47, 1, '1234567000', '2022-10-25', 'October', '2022', 4, 1500000),
(48, 1, '1234567890', '2023-11-01', 'November', '2023', 4, 1000000),
(49, 1, '1234123400', '2023-11-03', 'November', '2023', 1, 750000),
(50, 1, '1234123400', '2023-11-03', 'November', '2023', 1, 750000),
(51, 1, '0123412345', '2023-11-07', 'November', '2023', 4, 250000),
(52, 1, '0123412345', '2023-11-08', 'November', '2023', 7, 400000),
(59, 1, '1234567890', '2023-11-08', 'November', '2023', 7, 1000000),
(60, 1, '1234567890', '2023-11-08', 'November', '2023', 7, 1000000),
(61, 1, '0123412345', '2023-11-08', 'November', '2023', 4, 50000),
(62, 1, '0123412345', '2023-11-08', 'November', '2023', 4, 50000),
(63, 1, '0123412345', '2023-11-08', 'November', '2023', 4, 50000),
(64, 1, '0123412345', '2023-11-08', 'November', '2023', 4, 50000),
(65, 1, '0123412345', '2023-11-08', 'November', '2023', 4, 50000),
(66, 1, '0123412345', '2023-11-08', 'November', '2023', 7, 50000),
(67, 1, '0123412345', '2023-11-08', 'November', '2023', 7, 50000),
(68, 1, '0123412345', '2023-11-08', 'November', '2023', 4, 50000),
(69, 1, '0123412345', '2023-11-08', 'November', '2023', 4, 50000),
(70, 1, '0123412345', '2023-11-08', 'November', '2023', 4, 50000),
(71, 5, '0123412345', '2023-11-08', 'November', '2023', 4, 400000),
(75, 5, '1234567000', '2023-11-08', 'November', '2023', 1, 500000),
(76, 5, '1234123400', '2023-11-08', 'November', '2023', 4, 500000);

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `id_petugas` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(32) NOT NULL,
  `nama_petugas` varchar(35) NOT NULL,
  `level` enum('admin','petugas') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id_petugas`, `username`, `password`, `nama_petugas`, `level`) VALUES
(1, 'admin', '202cb962ac59075b964b07152d234b70', 'ADMIN', 'admin'),
(5, 'gian', '202cb962ac59075b964b07152d234b70', 'Gian', 'petugas');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `nisn` char(10) NOT NULL,
  `nis` char(4) NOT NULL,
  `nama` varchar(35) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(13) NOT NULL,
  `password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`nisn`, `nis`, `nama`, `id_kelas`, `alamat`, `no_telp`, `password`) VALUES
('0123412345', '1112', 'Saya', 1, 'Kulon', '080808080', '202cb962ac59075b964b07152d234b70'),
('1234123400', '4444', 'Agos', 1, 'BatangHari\r\n', '083838383838', '202cb962ac59075b964b07152d234b70'),
('1234567000', '1122', 'Dhani', 1, 'Metro', '083847474260', '202cb962ac59075b964b07152d234b70'),
('1234567800', '1212', 'Bintang', 2, 'AOKSOAKSO', '446545678', '202cb962ac59075b964b07152d234b70'),
('1234567890', '6666', 'Gian Pambela', 1, 'Girikarto', '081223431111', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Table structure for table `spp`
--

CREATE TABLE `spp` (
  `id_spp` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  `nominal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `spp`
--

INSERT INTO `spp` (`id_spp`, `tahun`, `nominal`) VALUES
(1, 2023, 1500000),
(4, 2022, 2000000),
(7, 2020, 2000000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD KEY `id_petugas` (`id_petugas`),
  ADD KEY `id_spp` (`id_spp`),
  ADD KEY `nisn` (`nisn`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id_petugas`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`nisn`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- Indexes for table `spp`
--
ALTER TABLE `spp`
  ADD PRIMARY KEY (`id_spp`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id_petugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `spp`
--
ALTER TABLE `spp`
  MODIFY `id_spp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`id_spp`) REFERENCES `spp` (`id_spp`) ON UPDATE CASCADE,
  ADD CONSTRAINT `pembayaran_ibfk_2` FOREIGN KEY (`id_petugas`) REFERENCES `petugas` (`id_petugas`) ON UPDATE CASCADE,
  ADD CONSTRAINT `pembayaran_ibfk_3` FOREIGN KEY (`nisn`) REFERENCES `siswa` (`nisn`) ON UPDATE CASCADE;

--
-- Constraints for table `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
