-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 07 Agu 2018 pada 11.01
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
('pusdatin', 'pusdatin'),
('admin', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `biaya_penginapan`
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
-- Dumping data untuk tabel `biaya_penginapan`
--

INSERT INTO `biaya_penginapan` (`id`, `provinsi`, `eselon_1`, `eselon_2`, `eselon_3`, `eselon_4`, `eselon_5`) VALUES
(1, 'Maluku Utara', 3440000, 3175000, 1073000, 480000, 480000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `biaya_transport`
--

CREATE TABLE `biaya_transport` (
  `id` int(5) NOT NULL,
  `provinsi` text NOT NULL,
  `besaran` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `biaya_transport`
--

INSERT INTO `biaya_transport` (`id`, `provinsi`, `besaran`) VALUES
(1, 'Maluku Utara', 2000000);

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
(1, 'Dr.Sutopo Purwo Nugroho, M.Si., APU.', '19691007 199501 1 00', 'Kepala Pusat Data Informasi dan Humas', 'IV'),
(2, 'Hermawan Agustina, S.Kom., M.Si.', '19660502 199003 1 00', 'Kepala Bidang Data', 'IV'),
(3, 'Dra. Rita Rosita S.', '19631123 199203 2 00', 'Kepala Bidang Humas', 'IV'),
(4, 'Linda Lestari, S.Kom', '19790305 200501 2 00', 'Kepala Bidang Indormasi', 'IV'),
(5, 'Dyah Rusmiasih, ST, M.Kom, MDMa', '19660902 198903 2 00', 'Kepala Sub Bidang Pemeliharaan Sistem Jaringan', 'IV'),
(6, 'Dian Oktiari, ST, M.Si (Han)', '19771020 200604 2 00', 'Kasub.Bidang Data spasial', 'III'),
(7, 'Teguh Harjito, S.SI', '19750611 199712 1 00', 'Kasub.Bidang Data Statistik', 'III'),
(8, 'Sridewanto Edi Pinuji, S.Si', '19830209 200912 1 00', 'Staf Bidang Data', 'III'),
(9, 'Suprapto, S.Si, M.Si (Han)', '19850217 200912 1 00', 'Staf Bidang Data', 'III'),
(10, 'Ratih Nurmasari, S.Si', '19861117 201012 2 00', 'Staf Bidang Data', 'III'),
(11, 'Aulia Ismi Savitri, Ssi', '19850526 201012 2 00', 'Staf Bidang Data', 'III'),
(12, 'Budi Assaudi, S.Ikom', '', 'Staf Bidang Data', 'III'),
(13, 'Bangun Yoga P., S.E', '', 'Staf Bidang Data', 'III'),
(14, 'Nurul Maulidhini, S.T', '19841124 200912 2 00', 'Staf Bidang Data', 'III'),
(15, 'Meysita Noormasari, S.Si', '19900516 201503 2 00', 'Staf Bidang Data', 'III'),
(16, 'Ainun Rosyida, S.Si', '19911016 201503 2 00', 'Staf Bidang Data', 'III'),
(17, 'Ni Made Kesuma Astuti I.P., S.T', '19851206 201203 2 00', 'Staf Bidang Data', 'III'),
(18, 'Danang Wijaya', '', 'Staf Bidang Data', 'II'),
(19, 'Diah Putrie Afriliani, S.Kom', '', 'Staf Bidang Data', 'III'),
(20, 'Sulistyowati, S.E', '19750307 200501 2 00', 'Kepala Bidang Tata Usaha', 'III'),
(21, 'I Gusti Ayu, A.N Kusuma , SS, M.Si', '19771123 200604 2 00', 'Kepala Sub Bidang Media Cetak', 'III'),
(22, 'Ario Akbar Lomban, S.E', '19730908 200312 1 00', 'Kepala Sub Bidang Media Elektronik', 'III'),
(23, 'Tamora Nainggolan', '19911119 201012 1 00', 'Staf Tata Usaha', 'II'),
(24, 'Murliana', '19920904 201012 2 00', 'Staf Tata Usaha', 'II'),
(25, 'Ulfa Sari Febriani, A.Md', '19870202 201012 2 00', 'Staf Tata Usaha', 'II'),
(26, 'Putri Dewiyani, S.E', '19910702 201503 2 00', 'Staf Tata Usaha', 'III'),
(27, 'Theopilus Yanuarto, S.Sos', '19770108 200912 1 00', 'Staf Humas', 'III'),
(28, 'Slamet Riyadi, A.Md', '19810731 200912 1 00', 'Staf Humas', 'III'),
(29, 'Andri Cipto Utomo, S.Sos', '19820830 201012 1 00', 'Staf Humas', 'III'),
(30, 'Ignatius Toto Satrio, S.Ds', '19810609 201012 1 00', 'Staf Humas', 'III'),
(31, 'Rusnadi Suyatman Putra', '19810924 200912 1 00', 'Staf Humas', 'III'),
(32, 'Ika Kartika', '', 'Staf Humas', 'III'),
(33, 'Pebbyanti', '', 'Staf Humas', 'III'),
(34, 'Dume Harjuti Sinaga, S.Sos', '', 'Staf Humas', 'III'),
(35, 'Moch.Zakiyamani, A.Md', '19860729 200912 1 00', 'Staf Informasi', 'II'),
(36, 'Atang Supena, S.Kom', '19830528 200912 2 00', 'Staf Informasi', 'III'),
(37, 'Meliwaty Sihombing, S.Kom', '19830528 200912 2 00', 'Staf Informasi', 'III'),
(38, 'Yanuar Yuda Darmawan, S.Kom', '19800126 201012 1 00', 'Staf Informasi', 'III'),
(39, 'Leonard Purba, S.T', '19820107 200912 1 00', 'Staf Informasi', 'III'),
(40, 'M. Syaiful Hadi, S.', '', 'Staf Informasi', 'III'),
(41, 'Ersal Erlangga, S.Ip', '', 'Staf Informasi', 'III'),
(42, 'Ardi Karman Yumiardi, S.T', '19810225 201503 1 00', 'Staf Informasi', 'III'),
(43, 'Dinda Tasnym', '', 'Staf Informasi', 'II'),
(44, 'Andi Ahmad Bashir ', '', 'Staf Informasi', 'II'),
(45, 'Abdul Kodir Jaelani, S.Kom.', '', 'Staf Informasi', 'III');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pejabat_administratif`
--

CREATE TABLE `pejabat_administratif` (
  `id` int(8) NOT NULL,
  `jabatan` varchar(60) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nip` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pejabat_administratif`
--

INSERT INTO `pejabat_administratif` (`id`, `jabatan`, `nama`, `nip`) VALUES
(1, 'Pejabat Pembuat Komitmen', 'Linda Lestari, S.Kom', '19790305 2005012 0 02'),
(2, 'Bendahara Pengeluaran Pembantu', 'Murliana', '19820107 2009121 0 02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rincian_biaya`
--

CREATE TABLE `rincian_biaya` (
  `id` int(5) NOT NULL,
  `id_surat` int(5) NOT NULL,
  `id_pegawai` int(5) DEFAULT NULL,
  `transport` int(10) DEFAULT NULL,
  `penginapan` int(8) DEFAULT NULL,
  `harian` int(8) DEFAULT NULL,
  `tiket` int(10) DEFAULT NULL,
  `representasi` int(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `rincian_biaya`
--

INSERT INTO `rincian_biaya` (`id`, `id_surat`, `id_pegawai`, `transport`, `penginapan`, `harian`, `tiket`, `representasi`) VALUES
(1, 20, 1, NULL, NULL, NULL, NULL, NULL),
(2, 20, 1, NULL, NULL, NULL, NULL, NULL),
(3, 20, 1, NULL, NULL, NULL, NULL, NULL),
(4, 20, 1, NULL, NULL, NULL, NULL, NULL),
(5, 20, 1, NULL, NULL, NULL, NULL, NULL),
(6, 20, 1, NULL, NULL, NULL, NULL, NULL),
(7, 20, 1, NULL, NULL, NULL, NULL, NULL),
(8, 20, 1, NULL, NULL, NULL, NULL, NULL),
(9, 20, 1, 1, 1, 1, 0, NULL),
(10, 20, 1, 1, 1, 1, 1, NULL),
(11, 20, 1, 1, 1, 1, 1, NULL),
(12, 20, 1, 1, 1, 1, 1, NULL),
(13, 20, 1, 1, 1, 1, 1, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat_dinas`
--

CREATE TABLE `surat_dinas` (
  `id` int(11) NOT NULL,
  `nomor` varchar(30) NOT NULL DEFAULT '2000/KADIH/02/2018',
  `tempat` varchar(100) NOT NULL,
  `kegiatan` varchar(50) NOT NULL,
  `tgl_mulai` text NOT NULL,
  `tgl_akhir` varchar(10) NOT NULL,
  `tgl_surat` varchar(10) NOT NULL,
  `jenis` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `surat_dinas`
--

INSERT INTO `surat_dinas` (`id`, `nomor`, `tempat`, `kegiatan`, `tgl_mulai`, `tgl_akhir`, `tgl_surat`, `jenis`) VALUES
(20, '1/KADIH/08/2018', 'Provinsi Bali', 'Rapat Kerja Nasional', '2018-08-04', '2018-08-06', '03/08/2018', 1),
(21, '2/KADIH/08/2018', 'BPBD Provinsi Lampung', 'Survei NasionalBPBD', '2018-08-01', '2018-08-09', '07/08/2018', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tiket_pesawat`
--

CREATE TABLE `tiket_pesawat` (
  `id` int(5) NOT NULL,
  `biaya_tiket` int(10) NOT NULL,
  `rute` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tiket_pesawat`
--

INSERT INTO `tiket_pesawat` (`id`, `biaya_tiket`, `rute`) VALUES
(1, 6693000, 'Jakarta - Maluku');

-- --------------------------------------------------------

--
-- Struktur dari tabel `uang_harian`
--

CREATE TABLE `uang_harian` (
  `id` int(5) NOT NULL,
  `provinsi` text NOT NULL,
  `luar_kota` int(10) NOT NULL,
  `dalam_kota` int(10) NOT NULL,
  `diklat` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `uang_harian`
--

INSERT INTO `uang_harian` (`id`, `provinsi`, `luar_kota`, `dalam_kota`, `diklat`) VALUES
(1, 'Maluku Utara', 20000, 30000, 40000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `uang_representasi`
--

CREATE TABLE `uang_representasi` (
  `id` int(5) NOT NULL,
  `uraian` varchar(20) NOT NULL,
  `luar_kota` int(10) NOT NULL,
  `dalam_kota` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `uang_representasi`
--

INSERT INTO `uang_representasi` (`id`, `uraian`, `luar_kota`, `dalam_kota`) VALUES
(1, 'PEJABAT NEGARA', 250000, 125000),
(2, 'PEJABAT ESELON 1', 200000, 100000);

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
(22, 20, 1),
(23, 20, 2),
(24, 21, 2),
(25, 21, 32),
(26, 21, 33),
(27, 21, 35),
(28, 21, 37),
(29, 21, 38),
(30, 21, 41),
(31, 21, 43);

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
-- Indexes for table `pejabat_administratif`
--
ALTER TABLE `pejabat_administratif`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rincian_biaya`
--
ALTER TABLE `rincian_biaya`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `biaya_transport`
--
ALTER TABLE `biaya_transport`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `kegiatan`
--
ALTER TABLE `kegiatan`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_pegawai` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT for table `pejabat_administratif`
--
ALTER TABLE `pejabat_administratif`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `rincian_biaya`
--
ALTER TABLE `rincian_biaya`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `surat_dinas`
--
ALTER TABLE `surat_dinas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `tiket_pesawat`
--
ALTER TABLE `tiket_pesawat`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `uang_harian`
--
ALTER TABLE `uang_harian`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `uang_representasi`
--
ALTER TABLE `uang_representasi`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `yang_dinas`
--
ALTER TABLE `yang_dinas`
  MODIFY `id_dinas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
