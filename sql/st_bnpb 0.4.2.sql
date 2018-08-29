-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 29, 2018 at 07:18 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Table structure for table `dasar_hukum`
--

CREATE TABLE `dasar_hukum` (
  `id` int(5) NOT NULL,
  `hukum` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dasar_hukum`
--

INSERT INTO `dasar_hukum` (`id`, `hukum`) VALUES
(1, 'Keputusan Presiden Nomor 72 Tahun 2004 tentang Pelaksanaan Anggaran\r\nPendapatan dan Belanja Negara;'),
(2, 'Peraturan Menteri Keuangan Nomor 134/PMK.06/2005 tentang Pedoman\r\nPembayaran dalam Pelaksanan Anggaran Pendapatan dan Belanja Negara;'),
(3, 'Peraturan Kepala Badan Nasional Penanggulangan Bencana Nomor 1 tahun 2008\r\ntentang Organisasi dan Tata Kerja Badan Nasional Penanggulangan Bencana.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dasar_hukum`
--
ALTER TABLE `dasar_hukum`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dasar_hukum`
--
ALTER TABLE `dasar_hukum`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
