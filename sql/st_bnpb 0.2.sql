-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 31 Jul 2018 pada 09.42
-- Versi Server: 10.1.16-MariaDB
-- PHP Version: 7.0.9

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
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `nama` varchar(10) NOT NULL,
  `password` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`nama`, `password`) VALUES
('admin', 'admin'),
('admin', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kegiatan`
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
-- Struktur dari tabel `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` int(5) NOT NULL,
  `nama_pegawai` varchar(100) NOT NULL,
  `nip_pegawai` varchar(20) NOT NULL,
  `jabatan_pegawai` varchar(100) NOT NULL,
  `golongan_pegawai` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `nama_pegawai`, `nip_pegawai`, `jabatan_pegawai`, `golongan_pegawai`) VALUES
(1, 'Linda Lestari, S.Kom', '197903052005012001', 'Kepala Bidang Informasi', '3d'),
(2, 'Hermawan Agustina, S.Kom., M.Si', '19688888888', 'Kepala Bidang Data', '3A'),
(3, 'Kelik Is Cahyanto', '1991199191', 'Kepala Bidang Ena', '4A');

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat_dinas`
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
-- Dumping data untuk tabel `surat_dinas`
--

INSERT INTO `surat_dinas` (`id`, `nomor`, `tempat`, `kegiatan`, `tgl_mulai`, `tgl_akhir`, `tgl_surat`, `jenis`) VALUES
(2, '1/KADIH/07/2018', 'Provinsi Bali', 'Rapat', '2018-07-04', '2018-07-11', '31/07/2018', 1),
(3, '2/KADIH/07/2018', 'Jepang', 'Rapat', '2018-07-04', '2018-07-22', '31/07/2018', 1),
(4, '3/KADIH/07/2018', 'Jepangv', 'Rapat', '2018-07-04', '2018-07-22', '31/07/2018', 1),
(5, '4/KADIH/07/2018', 'Jepangv', 'Rapat', '2018-07-04', '2018-07-22', '31/07/2018', 1),
(6, '5/KADIH/07/2018', 'Solo', 'Dinas', '2018-07-04', '2018-07-22', '31/07/2018', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `yang_dinas`
--

CREATE TABLE `yang_dinas` (
  `id_dinas` int(11) NOT NULL,
  `id_surat` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `yang_dinas`
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
-- Indexes for table `yang_dinas`
--
ALTER TABLE `yang_dinas`
  ADD PRIMARY KEY (`id_dinas`);

--
-- AUTO_INCREMENT for dumped tables
--

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
-- AUTO_INCREMENT for table `yang_dinas`
--
ALTER TABLE `yang_dinas`
  MODIFY `id_dinas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
