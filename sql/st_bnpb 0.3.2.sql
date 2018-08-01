-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 01, 2018 at 04:28 AM
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

--
-- Dumping data for table `biaya_penginapan`
--

INSERT INTO `biaya_penginapan` (`id`, `provinsi`, `eselon_1`, `eselon_2`, `eselon_3`, `eselon_4`, `eselon_5`) VALUES
(1, 'Aceh', 4420000, 3526000, 1294000, 556000, 556000),
(2, 'Sumatra Utara', 4960000, 1518000, 1100000, 530000, 530000);

-- --------------------------------------------------------

--
-- Table structure for table `biaya_transport`
--

CREATE TABLE `biaya_transport` (
  `id` int(5) NOT NULL,
  `provinsi` text NOT NULL,
  `besaran` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `biaya_transport`
--

INSERT INTO `biaya_transport` (`id`, `provinsi`, `besaran`) VALUES
(1, 'Aceh', 123000),
(2, 'Sumatra Utara', 232000);

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
  `nip_pegawai` varchar(20) NOT NULL,
  `jabatan_pegawai` varchar(100) NOT NULL,
  `golongan_pegawai` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `nama_pegawai`, `nip_pegawai`, `jabatan_pegawai`, `golongan_pegawai`) VALUES
(1, 'Linda Lestari, S.Kom', '197903052005012001', 'Kepala Bidang Informasi', '3d'),
(2, 'Hermawan Agustina, S.Kom., M.Si', '19688888888', 'Kepala Bidang Data', '3A'),
(3, 'Kelik Is Cahyanto', '1991199191', 'Kepala Bidang Ena', '4A');

-- --------------------------------------------------------

--
-- Table structure for table `surat_dinas`
--

CREATE TABLE `surat_dinas` (
  `id` int(11) NOT NULL,
  `nomor` varchar(30) NOT NULL DEFAULT '2000/KADIH/02/2018',
  `tempat` varchar(100) NOT NULL,
  `kegiatan` varchar(5) NOT NULL,
  `tgl_mulai` text NOT NULL,
  `tgl_akhir` varchar(10) NOT NULL,
  `tgl_surat` varchar(10) NOT NULL,
  `jenis` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `surat_dinas`
--

INSERT INTO `surat_dinas` (`id`, `nomor`, `tempat`, `kegiatan`, `tgl_mulai`, `tgl_akhir`, `tgl_surat`, `jenis`) VALUES
(2, '1/KADIH/07/2018', 'Provinsi Bali', 'Rapat', '2018-07-04', '2018-07-11', '31/07/2018', 1),
(3, '2/KADIH/07/2018', 'Jepang', 'Rapat', '2018-07-04', '2018-07-22', '31/07/2018', 1),
(4, '3/KADIH/07/2018', 'Jepangv', 'Rapat', '2018-07-04', '2018-07-22', '31/07/2018', 1),
(5, '4/KADIH/07/2018', 'Jepangv', 'Rapat', '2018-07-04', '2018-07-22', '31/07/2018', 1),
(6, '5/KADIH/07/2018', 'Solo', 'Dinas', '2018-07-04', '2018-07-22', '31/07/2018', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tiket_pesawat`
--

CREATE TABLE `tiket_pesawat` (
  `id` int(5) NOT NULL,
  `kota` text NOT NULL,
  `biaya_tiket` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tiket_pesawat`
--

INSERT INTO `tiket_pesawat` (`id`, `kota`, `biaya_tiket`) VALUES
(1, 'Jakarta-Ambon', 7081000),
(2, 'Jakarta-Balikpapan', 3797000);

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

--
-- Dumping data for table `uang_harian`
--

INSERT INTO `uang_harian` (`id`, `provinsi`, `luar_kota`, `dalam_kota`, `diklat`) VALUES
(1, 'Aceh', 360000, 140000, 110000),
(2, 'Sumatra Utara', 370000, 150000, 110000);

-- --------------------------------------------------------

--
-- Table structure for table `uang_representasi`
--

CREATE TABLE `uang_representasi` (
  `id` int(5) NOT NULL,
  `uraian` text NOT NULL,
  `luar_kota` int(10) NOT NULL,
  `dalam_kota` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `uang_representasi`
--

INSERT INTO `uang_representasi` (`id`, `uraian`, `luar_kota`, `dalam_kota`) VALUES
(1, 'Pejabat Negara', 250000, 125000),
(2, 'Pejabat Eselon I', 200000, 100000);

-- --------------------------------------------------------

--
-- Table structure for table `yang_dinas`
--

CREATE TABLE `yang_dinas` (
  `id_dinas` int(11) NOT NULL,
  `id_surat` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `yang_dinas`
--

INSERT INTO `yang_dinas` (`id_dinas`, `id_surat`, `id_pegawai`) VALUES
(1, 1, 1),
(2, 4, 2),
(3, 4, 3),
(4, 5, 1),
(5, 5, 2),
(6, 5, 3);

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
-- Indexes for table `tiket_pesawat`
--
ALTER TABLE `tiket_pesawat`
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
-- Indexes for table `yang_dinas`
--
ALTER TABLE `yang_dinas`
  ADD PRIMARY KEY (`id_dinas`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `biaya_penginapan`
--
ALTER TABLE `biaya_penginapan`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `biaya_transport`
--
ALTER TABLE `biaya_transport`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kegiatan`
--
ALTER TABLE `kegiatan`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_pegawai` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `surat_dinas`
--
ALTER TABLE `surat_dinas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tiket_pesawat`
--
ALTER TABLE `tiket_pesawat`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `uang_harian`
--
ALTER TABLE `uang_harian`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `uang_representasi`
--
ALTER TABLE `uang_representasi`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `yang_dinas`
--
ALTER TABLE `yang_dinas`
  MODIFY `id_dinas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
