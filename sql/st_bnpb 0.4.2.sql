-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 29, 2018 at 08:33 AM
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
('pusdatin', 'pusdatin'),
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
(1, 'Maluku Utara', 3440000, 3175000, 1073000, 480000, 4800012),
(3, 'Sumatera Utara', 4960, 1518000, 1100000, 530000, 530000),
(4, 'Riau', 3820000, 3119000, 1650000, 852000, 852000);

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
(1, 'Maluku Utara', 215000),
(2, 'Aceh', 123000),
(3, 'Sumatera Utara', 232000),
(4, 'Riau', 94000),
(5, 'Jakarta', 256000);

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

-- --------------------------------------------------------

--
-- Table structure for table `data_rinci`
--

CREATE TABLE `data_rinci` (
  `id` int(10) NOT NULL,
  `id_surat` int(10) NOT NULL DEFAULT '0',
  `nomor` varchar(30) NOT NULL DEFAULT '0',
  `pos` tinyint(1) NOT NULL DEFAULT '1',
  `kegiatan` varchar(100) NOT NULL DEFAULT '0',
  `jenis` tinyint(1) NOT NULL DEFAULT '0',
  `opsi` tinyint(1) NOT NULL DEFAULT '0',
  `id_pegawai` smallint(4) NOT NULL DEFAULT '0',
  `tgl_mulai` varchar(50) NOT NULL DEFAULT '0',
  `tgl_akhir` varchar(50) NOT NULL DEFAULT '0',
  `tgl_surat` varchar(50) NOT NULL DEFAULT '0',
  `tempat` varchar(100) NOT NULL DEFAULT '0',
  `id_harian` smallint(4) NOT NULL DEFAULT '0',
  `id_penginapan` varchar(100) NOT NULL DEFAULT '0',
  `id_tiket` smallint(4) NOT NULL DEFAULT '0',
  `id_transport` smallint(4) NOT NULL DEFAULT '0',
  `id_transport2` smallint(4) NOT NULL DEFAULT '0',
  `id_lokal` smallint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_rinci`
--

INSERT INTO `data_rinci` (`id`, `id_surat`, `nomor`, `pos`, `kegiatan`, `jenis`, `opsi`, `id_pegawai`, `tgl_mulai`, `tgl_akhir`, `tgl_surat`, `tempat`, `id_harian`, `id_penginapan`, `id_tiket`, `id_transport`, `id_transport2`, `id_lokal`) VALUES
(1, 1, ' 1/KADIH/08/2018', 1, 'Monitoring dan Evaluasi BPBD', 1, 0, 44, '2018-08-02', '2018-08-04', '27/08/2018', 'Provinsi Aceh', 2, '2', 3, 5, 2, 1),
(2, 1, ' 1/KADIH/08/2018', 1, 'Monitoring dan Evaluasi BPBD', 1, 0, 42, '2018-08-02', '2018-08-04', '27/08/2018', 'Provinsi Aceh', 2, '2', 3, 5, 2, 1),
(3, 1, ' 1/KADIH/08/2018', 1, 'Monitoring dan Evaluasi BPBD', 1, 0, 36, '2018-08-02', '2018-08-04', '27/08/2018', 'Provinsi Aceh', 2, '2', 3, 5, 2, 1),
(4, 1, ' 1/KADIH/08/2018', 1, 'Monitoring dan Evaluasi BPBD', 1, 0, 11, '2018-08-02', '2018-08-04', '27/08/2018', 'Provinsi Aceh', 2, '2', 3, 5, 2, 1),
(5, 1, ' 1/KADIH/08/2018', 1, 'Monitoring dan Evaluasi BPBD', 1, 0, 21, '2018-08-02', '2018-08-04', '27/08/2018', 'Provinsi Aceh', 2, '2', 3, 5, 2, 1),
(6, 1, ' 1/KADIH/08/2018', 1, 'Monitoring dan Evaluasi BPBD', 1, 0, 30, '2018-08-02', '2018-08-04', '27/08/2018', 'Provinsi Aceh', 2, '2', 3, 5, 2, 1),
(7, 2, ' /KADIH/08/2018', 1, 'main', 0, 1, 5, '2018-08-30', '2018-09-02', '28/08/2018', 'BPBD Aceh', 2, '2', 3, 5, 2, 8),
(8, 3, ' /KADIH/08/2018', 1, 'asian games', 0, 0, 45, '2018-08-30', '2018-09-02', '28/08/2018', 'as', 1, '2', 1, 1, 3, 18);

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
-- Table structure for table `pejabat_administratif`
--

CREATE TABLE `pejabat_administratif` (
  `id` int(8) NOT NULL,
  `jabatan` varchar(60) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nip` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pejabat_administratif`
--

INSERT INTO `pejabat_administratif` (`id`, `jabatan`, `nama`, `nip`) VALUES
(1, 'Pejabat Pembuat Komitmen', 'Linda Lestari, S.Kom', '19790305 2005012 0 02'),
(2, 'Bendahara Pengeluaran Pembantu', 'Murliana', '19820107 2009121 0 02');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran_awal`
--

CREATE TABLE `pembayaran_awal` (
  `id` int(5) NOT NULL,
  `id_surat` int(5) NOT NULL,
  `id_pegawai` int(10) DEFAULT NULL,
  `penginapan` int(8) DEFAULT '0',
  `harian` int(8) DEFAULT '0',
  `transport` int(8) DEFAULT '0',
  `tiket` int(10) DEFAULT '0',
  `representasi` int(8) DEFAULT '0',
  `total` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `pembayaran_awal`
--

INSERT INTO `pembayaran_awal` (`id`, `id_surat`, `id_pegawai`, `penginapan`, `harian`, `transport`, `tiket`, `representasi`, `total`) VALUES
(1, 1, 44, 556000, 360000, 1028000, 4492000, 0, 7712000),
(2, 1, 42, 556000, 360000, 1028000, 4492000, 0, 7712000),
(3, 1, 36, 556000, 360000, 1028000, 4492000, 0, 7712000),
(4, 1, 21, 556000, 360000, 1028000, 4492000, 0, 7712000),
(5, 1, 21, 556000, 360000, 1028000, 4492000, 0, 7712000);

-- --------------------------------------------------------

--
-- Table structure for table `spd_rampung`
--

CREATE TABLE `spd_rampung` (
  `id` int(5) NOT NULL,
  `id_surat` int(5) NOT NULL,
  `id_pegawai` int(10) DEFAULT NULL,
  `multiple` varchar(3) DEFAULT NULL,
  `malam` tinyint(3) DEFAULT NULL,
  `penginapan` int(8) DEFAULT NULL,
  `transport` int(8) DEFAULT NULL,
  `harian` int(8) DEFAULT NULL,
  `tiket` int(10) DEFAULT NULL,
  `representasi` int(8) DEFAULT NULL,
  `total` int(10) DEFAULT NULL,
  `tgl` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `spd_rampung`
--

INSERT INTO `spd_rampung` (`id`, `id_surat`, `id_pegawai`, `multiple`, `malam`, `penginapan`, `transport`, `harian`, `tiket`, `representasi`, `total`, `tgl`) VALUES
(1, 1, 44, '0', 2, 1, 1028000, 360000, 3, NULL, 2108005, '27/08/2018'),
(2, 1, 42, '1', 1, 1, 1028000, 360000, 2, NULL, 2108003, '27/08/2018'),
(3, 1, 42, '1', 1, 2, 1028000, 360000, 2, NULL, 2108005, '27/08/2018'),
(4, 1, 36, '1', 2, 120000, 1028000, 360000, 2000000, NULL, 4348000, '27/08/2018'),
(5, 1, 36, '1', 1, 200000, 1028000, 360000, 2000000, NULL, 4548000, '27/08/2018'),
(6, 1, 21, '1', 127, 12, 1028000, 360000, 450000, NULL, 2572544, '28/08/2018'),
(7, 1, 21, '1', 127, 23, 1028000, 360000, 450000, NULL, 2644557, '28/08/2018');

-- --------------------------------------------------------

--
-- Table structure for table `surat_dinas`
--

CREATE TABLE `surat_dinas` (
  `id` int(11) NOT NULL,
  `nomor` varchar(30) NOT NULL DEFAULT '00/KADIH/02/2018',
  `kegiatan` varchar(100) NOT NULL,
  `jenis` tinyint(1) NOT NULL,
  `opsi` tinyint(1) NOT NULL,
  `pos` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `surat_dinas`
--

INSERT INTO `surat_dinas` (`id`, `nomor`, `kegiatan`, `jenis`, `opsi`, `pos`) VALUES
(1, ' 1/KADIH/08/2018', 'Monitoring dan Evaluasi BPBD', 1, 0, 1),
(2, ' /KADIH/08/2018', 'main', 0, 1, 1),
(3, ' /KADIH/08/2018', 'asian games', 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tiket_pesawat`
--

CREATE TABLE `tiket_pesawat` (
  `id` int(5) NOT NULL,
  `biaya_tiket` int(10) NOT NULL,
  `rute` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tiket_pesawat`
--

INSERT INTO `tiket_pesawat` (`id`, `biaya_tiket`, `rute`) VALUES
(1, 7081000, 'Jakarta - Ambon'),
(2, 3797000, 'Jakarta - Balikpapan'),
(3, 4492000, 'Jakarta - Banda Aceh'),
(4, 1583000, 'Jakarta - Bandar Lampung');

-- --------------------------------------------------------

--
-- Table structure for table `transportasi_lokal`
--

CREATE TABLE `transportasi_lokal` (
  `id` int(10) NOT NULL,
  `ibukota` varchar(200) NOT NULL DEFAULT '0',
  `kabupaten` varchar(200) NOT NULL DEFAULT '0',
  `besaran` int(12) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transportasi_lokal`
--

INSERT INTO `transportasi_lokal` (`id`, `ibukota`, `kabupaten`, `besaran`) VALUES
(1, 'Banda Aceh', 'Kab .  Aceh Utara', 270000),
(2, 'Banda Aceh', 'Kab.  Aceh Barat Daya', 298000),
(3, 'Banda Aceh', 'Kab .  Aceh Besar', 183000),
(4, 'Banda Aceh', 'Kab.  Aceh Jaya', 238000),
(5, 'Banda Aceh', 'Kab . Aceh Selatan', 325000),
(6, 'Banda Aceh                                                                                                             ', 'Kab. Aceh Singkil', 420000),
(7, 'Banda Aceh', 'Kab .  Aceh Tamiang', 315000),
(8, 'Banda Aceh', 'Kab.  Aceh Tengah', 293000),
(9, 'Banda Aceh', 'Kab.  Aceh Tenggara', 460000),
(10, 'Banda Aceh', 'Kab.  Aceh Timur', 289000),
(12, 'Banda Aceh', 'Kab .  Bener Meriah', 278000),
(13, 'Banda Aceh', 'Kab .  Bireuen', 220000),
(14, 'Banda Aceh', 'Kab Gayo Lues', 370000),
(15, 'Banda Aceh', 'Kab. Nagari Raya', 275000),
(16, 'Banda Aceh', 'Kab.  Pidie', 190000),
(17, 'Banda Aceh', 'Kab. Pidie Jaya', 205000),
(18, 'Banda Aceh', 'Kab Langsa', 301000),
(19, 'Banda Aceh', 'Kab. Lhokseumawe', 240000),
(20, 'Banda Aceh', 'Kab. Subulussalam', 400000),
(21, 'Medan', 'Kab . Asahan', 259000),
(22, 'Medan', 'Kab.  Batubara', 225000),
(23, 'Medan', 'Kab .  Dairi', 270000),
(24, 'Medan', 'Kab .  Deli Serdang', 186000),
(25, 'Medan', 'Kab. Humbang Hasundutan', 300000),
(26, 'Medan', 'Kab .  Karo', 200000),
(27, 'Medan', 'Kab.  Labuhan Batu', 287000),
(28, 'Medan', 'Kab . Labuhan Batu Selatan', 360000),
(29, 'Medan', 'Kab . Labuhan Batu Utara', 300000),
(30, 'Medan', 'Kab.  Langkat', 186000),
(31, 'Medan', 'Kab. Mandailing', 420000),
(32, 'Medan', 'Kab. Mandailing  Natal', 420000),
(33, 'Medan', 'Kab.  Padang Lawas', 420000),
(34, 'Medan', 'Kab. Padang  Lawas Utara', 420000);

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
(1, 'Maluku Utara', 430000, 170000, 130000),
(2, 'Aceh', 360000, 140000, 110000),
(3, 'Sumatera Utara', 370000, 150000, 110000),
(4, 'Riau', 370000, 150000, 110000),
(5, 'Jambi', 370000, 150000, 110000),
(6, 'Kepulauan Riau', 370000, 150000, 110000);

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
-- Dumping data for table `uang_representasi`
--

INSERT INTO `uang_representasi` (`id`, `uraian`, `luar_kota`, `dalam_kota`) VALUES
(1, 'PEJABAT NEGARA', 250000, 125000),
(2, 'PEJABAT ESELON 1', 200000, 100000),
(3, 'PEJABAT ESELON II', 150000, 75000);

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
(1, 1, 44),
(2, 1, 42),
(3, 1, 36),
(4, 1, 11),
(5, 1, 21),
(6, 1, 30),
(7, 2, 5),
(8, 3, 45);

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
-- Indexes for table `dasar_hukum`
--
ALTER TABLE `dasar_hukum`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_rinci`
--
ALTER TABLE `data_rinci`
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
-- Indexes for table `pembayaran_awal`
--
ALTER TABLE `pembayaran_awal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `spd_rampung`
--
ALTER TABLE `spd_rampung`
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
-- Indexes for table `transportasi_lokal`
--
ALTER TABLE `transportasi_lokal`
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
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `biaya_transport`
--
ALTER TABLE `biaya_transport`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `dasar_hukum`
--
ALTER TABLE `dasar_hukum`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `data_rinci`
--
ALTER TABLE `data_rinci`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
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
-- AUTO_INCREMENT for table `pembayaran_awal`
--
ALTER TABLE `pembayaran_awal`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `spd_rampung`
--
ALTER TABLE `spd_rampung`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `surat_dinas`
--
ALTER TABLE `surat_dinas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tiket_pesawat`
--
ALTER TABLE `tiket_pesawat`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `transportasi_lokal`
--
ALTER TABLE `transportasi_lokal`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `uang_harian`
--
ALTER TABLE `uang_harian`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `uang_representasi`
--
ALTER TABLE `uang_representasi`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `yang_dinas`
--
ALTER TABLE `yang_dinas`
  MODIFY `id_dinas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
