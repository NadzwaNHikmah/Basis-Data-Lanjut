-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 04, 2025 at 10:59 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sewaalat`
--

-- --------------------------------------------------------

--
-- Table structure for table `alat`
--

CREATE TABLE `alat` (
  `id` int(11) NOT NULL,
  `kode_alat` varchar(50) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `harga_sewa` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `alat`
--

INSERT INTO `alat` (`id`, `kode_alat`, `nama`, `harga_sewa`) VALUES
(1, '111', 'Carrier 40L', '75000'),
(2, '112', 'Carrier 60L', '100000'),
(3, '113', 'Tenda 4 Orang', '100000'),
(4, '114', 'Tenda 2 Orang', '75000'),
(5, '115', 'Sleeping Bag', '50000'),
(6, '116', 'Matras', '25000'),
(8, '117', 'Trekking Pole', '30000'),
(9, '118', 'Kompas', '50000'),
(10, '119', 'Cooking Set', '50000');

-- --------------------------------------------------------

--
-- Table structure for table `penyewa`
--

CREATE TABLE `penyewa` (
  `id` int(11) NOT NULL,
  `nomor_penyewa` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jk` enum('L','P') NOT NULL,
  `alamat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penyewa`
--

INSERT INTO `penyewa` (`id`, `nomor_penyewa`, `nama`, `jk`, `alamat`) VALUES
(1, 222, 'Caca', 'P', 'Cirebon'),
(2, 223, 'Bibil', 'L', 'Jakarta');

-- --------------------------------------------------------

--
-- Table structure for table `sewa`
--

CREATE TABLE `sewa` (
  `id` int(11) NOT NULL,
  `nomor_bukti` varchar(10) NOT NULL,
  `nomor_penyewa` varchar(10) NOT NULL,
  `tanggal_sewa` date NOT NULL,
  `tanggal_kembali` date NOT NULL,
  `disewa` tinyint(1) NOT NULL DEFAULT 0,
  `dikembalikan` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sewa`
--

INSERT INTO `sewa` (`id`, `nomor_bukti`, `nomor_penyewa`, `tanggal_sewa`, `tanggal_kembali`, `disewa`, `dikembalikan`) VALUES
(2, '333', '222', '2025-01-04', '2025-01-06', 1, 0),
(3, '358d780', '222', '2025-01-04', '0000-00-00', 0, 0),
(4, '3142517', '222', '2025-01-04', '2025-01-04', 1, 1),
(5, 'd9611b6', '223', '2025-01-01', '2025-01-04', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sewadetail`
--

CREATE TABLE `sewadetail` (
  `id` int(11) NOT NULL,
  `sewa_id` int(11) NOT NULL,
  `kode_alat` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sewadetail`
--

INSERT INTO `sewadetail` (`id`, `sewa_id`, `kode_alat`) VALUES
(1, 4, '112'),
(2, 5, '115'),
(3, 5, '116'),
(4, 5, '119');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` enum('admin','mahasiswa','dosen') NOT NULL DEFAULT 'mahasiswa'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `nama`, `password`, `level`) VALUES
(1, 'nadzwanrlhkmh@gmail.com', 'Nadzwa Nurul Hikmah', '$2y$10$I/dKc12dZU5dR.9EAM9o..EEzcBbmTGK3cvoXbDHiFRjxeU5h2mmC', 'mahasiswa'),
(2, 'safiratunnisa2004@gmail.com', 'Safira', '$2y$10$QCFkHOt5ElB1F.iPaJWLO.YqEbvDOC9KaD/vn9FT/FGIjjuOr/blu', 'mahasiswa'),
(3, 'callaa', 'Nadzwa Nurul Hikmah', '$2y$10$8SmFHZTGS4PQ6Bd0WCHgge4UP/2rwdtP.YWobAI/xOB7UgiKyOdHO', 'mahasiswa'),
(4, 'yusufK', 'M Yusuf Kurnia', '$2y$10$6hfOwsTYMeLh82qvaCeyM.TBuxbsasmH0V.Wbl67z0G4m1BYjH6zS', 'mahasiswa'),
(5, 'cacaa', 'Nadzwa Nurul Hikmah', '$2y$10$s8zX3JDmeznZb0MdGaLHnuUe6celrcoP8O2qHis48EYUePMGhDL6C', 'mahasiswa'),
(6, 'cava', 'Nadzwa', '$2y$10$kDpFPiDvfXM2IOHCRZLKV.eYuFnlrsmrSuNMmHQHgZr.8Etc9uXsW', 'mahasiswa');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alat`
--
ALTER TABLE `alat`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_alat` (`kode_alat`);

--
-- Indexes for table `penyewa`
--
ALTER TABLE `penyewa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nomor_penyewa` (`nomor_penyewa`);

--
-- Indexes for table `sewa`
--
ALTER TABLE `sewa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nomor_bukti` (`nomor_bukti`);

--
-- Indexes for table `sewadetail`
--
ALTER TABLE `sewadetail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_email` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alat`
--
ALTER TABLE `alat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `penyewa`
--
ALTER TABLE `penyewa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sewa`
--
ALTER TABLE `sewa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sewadetail`
--
ALTER TABLE `sewadetail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
