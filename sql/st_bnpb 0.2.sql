-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 31, 2018 at 08:41 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `st_bnpb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `nama` varchar(10) NOT NULL,
  `password` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`nama`, `password`) VALUES
('admin', 'admin'),
('admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `biaya_penginapan`
--

CREATE TABLE `biaya_penginapan` (
  `id` int(5) NOT NULL,
  `provinsi` text NOT NULL,
  `eselon_1` int(10) NOT NULL,
  `eselon_2` int(10) NOT NULL,
  `eselon_3` int(10) NOT NULL,
  `eselon_4` int(10) NOT NULL,
  `eselon_5` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `biaya_transport`
--

CREATE TABLE `biaya_transport` (
  `id` int(5) NOT NULL,
  `provinsi` text NOT NULL,
  `besaran` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan`
--

CREATE TABLE `kegiatan` (
  `id` int(10) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `tempat` varchar(100) NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_selesai` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` int(5) NOT NULL,
  `nama_pegawai` varchar(100) NOT NULL,
  `nip_pegawai` varchar(30) NOT NULL,
  `jabatan_pegawai` varchar(100) NOT NULL,
  `golongan_pegawai` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `nama_pegawai`, `nip_pegawai`, `jabatan_pegawai`, `golongan_pegawai`) VALUES
(1, 'Linda Lestari, S.Kom', '197903052005012001', 'Kepala Bidang Informasi', '3d');

-- --------------------------------------------------------

--
-- Table structure for table `surat_dinas`
--

CREATE TABLE `surat_dinas` (
  `id` int(11) NOT NULL,
  `nomor` varchar(30) NOT NULL DEFAULT '2000/KADIH/02/2018',
  `kegiatan` varchar(5) NOT NULL,
  `tahun` int(4) NOT NULL DEFAULT '2018',
  `tgl_surat` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tiket_pesawat`
--

CREATE TABLE `tiket_pesawat` (
  `id` int(5) NOT NULL,
  `kota` text NOT NULL,
  `biaya_tiket` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `uang_harian`
--

CREATE TABLE `uang_harian` (
  `id` int(5) NOT NULL,
  `provinsi` text NOT NULL,
  `luar_kota` int(10) NOT NULL,
  `dalam_kota` int(10) NOT NULL,
  `diklat` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `uang_representasi`
--

CREATE TABLE `uang_representasi` (
  `id` int(5) NOT NULL,
  `uraian` varchar(20) NOT NULL,
  `luar_kota` int(10) NOT NULL,
  `dalam_kota` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `biaya_penginapan`
--
ALTER TABLE `biaya_penginapan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `biaya_transport`
--
ALTER TABLE `biaya_transport`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indexes for table `surat_dinas`
--
ALTER TABLE `surat_dinas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uang_harian`
--
ALTER TABLE `uang_harian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uang_representasi`
--
ALTER TABLE `uang_representasi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `biaya_penginapan`
--
ALTER TABLE `biaya_penginapan`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `biaya_transport`
--
ALTER TABLE `biaya_transport`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kegiatan`
--
ALTER TABLE `kegiatan`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_pegawai` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `surat_dinas`
--
ALTER TABLE `surat_dinas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `uang_harian`
--
ALTER TABLE `uang_harian`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `uang_representasi`
--
ALTER TABLE `uang_representasi`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
