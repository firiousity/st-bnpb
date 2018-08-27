-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.16-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.5.0.5284
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for st_bnpb
CREATE DATABASE IF NOT EXISTS `st_bnpb` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `st_bnpb`;

-- Dumping structure for table st_bnpb.admin
CREATE TABLE IF NOT EXISTS `admin` (
  `nama` varchar(10) NOT NULL,
  `password` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table st_bnpb.admin: ~2 rows (approximately)
DELETE FROM `admin`;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` (`nama`, `password`) VALUES
	('pusdatin', 'pusdatin'),
	('admin', 'admin');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;

-- Dumping structure for table st_bnpb.biaya_penginapan
CREATE TABLE IF NOT EXISTS `biaya_penginapan` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `provinsi` text NOT NULL,
  `eselon_1` int(10) NOT NULL,
  `eselon_2` int(10) NOT NULL,
  `eselon_3` int(10) NOT NULL,
  `eselon_4` int(10) NOT NULL,
  `eselon_5` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table st_bnpb.biaya_penginapan: ~3 rows (approximately)
DELETE FROM `biaya_penginapan`;
/*!40000 ALTER TABLE `biaya_penginapan` DISABLE KEYS */;
INSERT INTO `biaya_penginapan` (`id`, `provinsi`, `eselon_1`, `eselon_2`, `eselon_3`, `eselon_4`, `eselon_5`) VALUES
	(1, 'Maluku Utara', 3440000, 3175000, 1073000, 480000, 480000),
	(2, 'Aceh', 4420000, 3526000, 1294000, 556000, 556000),
	(3, 'Sumatera Utara', 4960, 1518000, 1100000, 530000, 530000),
	(4, 'Riau', 3820000, 3119000, 1650000, 852000, 852000);
/*!40000 ALTER TABLE `biaya_penginapan` ENABLE KEYS */;

-- Dumping structure for table st_bnpb.biaya_transport
CREATE TABLE IF NOT EXISTS `biaya_transport` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `provinsi` text NOT NULL,
  `besaran` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table st_bnpb.biaya_transport: ~4 rows (approximately)
DELETE FROM `biaya_transport`;
/*!40000 ALTER TABLE `biaya_transport` DISABLE KEYS */;
INSERT INTO `biaya_transport` (`id`, `provinsi`, `besaran`) VALUES
	(1, 'Maluku Utara', 215000),
	(2, 'Aceh', 123000),
	(3, 'Sumatera Utara', 232000),
	(4, 'Riau', 94000),
	(5, 'Jakarta', 256000);
/*!40000 ALTER TABLE `biaya_transport` ENABLE KEYS */;

-- Dumping structure for table st_bnpb.data_rinci
CREATE TABLE IF NOT EXISTS `data_rinci` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- Dumping data for table st_bnpb.data_rinci: ~8 rows (approximately)
DELETE FROM `data_rinci`;
/*!40000 ALTER TABLE `data_rinci` DISABLE KEYS */;
INSERT INTO `data_rinci` (`id`, `id_surat`, `nomor`, `pos`, `kegiatan`, `jenis`, `opsi`, `id_pegawai`, `tgl_mulai`, `tgl_akhir`, `tgl_surat`, `tempat`, `id_harian`, `id_penginapan`, `id_tiket`, `id_transport`, `id_transport2`) VALUES
	(1, 1, '1/KADIH/08/2018', 1, 'Monitoring dan Evaluasi BPBD', 1, 1, 38, '2018-05-29', '2018-06-01', '24/08/2018', 'Provinsi Sumatera Utara', 3, '3', 3, 5, 3),
	(2, 1, '1/KADIH/08/2018', 1, 'Monitoring dan Evaluasi BPBD', 1, 1, 39, '2018-06-04', '2018-06-07', '24/08/2018', 'Provinsi Maluku Utara', 1, '1', 1, 5, 1),
	(5, 4, '2/KADIH/08/2018', 1, 'Rapat Kerja Nasional', 0, 0, 29, '2018-08-25', '2018-08-27', '24/08/2018', 'Provinsi Bali', 1, '1', 1, 1, 1),
	(6, 4, '2/KADIH/08/2018', 1, 'Rapat Kerja Nasional', 0, 0, 36, '2018-08-25', '2018-08-27', '24/08/2018', 'Provinsi Bali', 1, '1', 1, 1, 1),
	(7, 4, '2/KADIH/08/2018', 1, 'Rapat Kerja Nasional', 0, 0, 11, '2018-08-25', '2018-08-27', '24/08/2018', 'Provinsi Bali', 1, '1', 1, 1, 1),
	(8, 4, '2/KADIH/08/2018', 1, 'Rapat Kerja Nasional', 0, 0, 13, '2018-08-25', '2018-08-27', '24/08/2018', 'Provinsi Bali', 1, '1', 1, 1, 1),
	(9, 4, '2/KADIH/08/2018', 1, 'Rapat Kerja Nasional', 0, 0, 12, '2018-08-25', '2018-08-27', '24/08/2018', 'Provinsi Bali', 1, '1', 1, 1, 1),
	(11, 6, ' 3/KADIH/08/2018', 1, 'enaks', 0, 0, 42, '2018-08-28', '2018-08-30', '27/08/2018', 'Provinsi Aceh', 1, '1', 1, 1, 1);
/*!40000 ALTER TABLE `data_rinci` ENABLE KEYS */;

-- Dumping structure for table st_bnpb.pegawai
CREATE TABLE IF NOT EXISTS `pegawai` (
  `id_pegawai` int(5) NOT NULL AUTO_INCREMENT,
  `nama_pegawai` varchar(100) NOT NULL,
  `nip_pegawai` varchar(20) NOT NULL,
  `jabatan_pegawai` varchar(100) NOT NULL,
  `golongan_pegawai` varchar(6) NOT NULL,
  PRIMARY KEY (`id_pegawai`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;

-- Dumping data for table st_bnpb.pegawai: ~45 rows (approximately)
DELETE FROM `pegawai`;
/*!40000 ALTER TABLE `pegawai` DISABLE KEYS */;
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
/*!40000 ALTER TABLE `pegawai` ENABLE KEYS */;

-- Dumping structure for table st_bnpb.pejabat_administratif
CREATE TABLE IF NOT EXISTS `pejabat_administratif` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `jabatan` varchar(60) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nip` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table st_bnpb.pejabat_administratif: ~0 rows (approximately)
DELETE FROM `pejabat_administratif`;
/*!40000 ALTER TABLE `pejabat_administratif` DISABLE KEYS */;
INSERT INTO `pejabat_administratif` (`id`, `jabatan`, `nama`, `nip`) VALUES
	(1, 'Pejabat Pembuat Komitmen', 'Linda Lestari, S.Kom', '19790305 2005012 0 02'),
	(2, 'Bendahara Pengeluaran Pembantu', 'Murliana', '19820107 2009121 0 02');
/*!40000 ALTER TABLE `pejabat_administratif` ENABLE KEYS */;

-- Dumping structure for table st_bnpb.pembayaran_awal
CREATE TABLE IF NOT EXISTS `pembayaran_awal` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `id_surat` int(5) NOT NULL,
  `id_pegawai` int(10) DEFAULT NULL,
  `penginapan` int(8) DEFAULT '0',
  `harian` int(8) DEFAULT '0',
  `transport` int(8) DEFAULT '0',
  `tiket` int(10) DEFAULT '0',
  `representasi` int(8) DEFAULT '0',
  `total` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table st_bnpb.pembayaran_awal: ~2 rows (approximately)
DELETE FROM `pembayaran_awal`;
/*!40000 ALTER TABLE `pembayaran_awal` DISABLE KEYS */;
INSERT INTO `pembayaran_awal` (`id`, `id_surat`, `id_pegawai`, `penginapan`, `harian`, `transport`, `tiket`, `representasi`, `total`) VALUES
	(1, 4, 29, 0, 0, 0, 0, 0, 0),
	(3, 6, 42, 0, 0, 0, 0, 0, 0);
/*!40000 ALTER TABLE `pembayaran_awal` ENABLE KEYS */;

-- Dumping structure for table st_bnpb.penginapan_lebih
CREATE TABLE IF NOT EXISTS `penginapan_lebih` (
  `id` int(10) DEFAULT NULL,
  `id_surat` int(10) DEFAULT NULL,
  `id_pegawai` int(10) DEFAULT NULL,
  `penginapan` int(10) DEFAULT NULL,
  `malam` int(10) DEFAULT NULL,
  `total` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table st_bnpb.penginapan_lebih: ~0 rows (approximately)
DELETE FROM `penginapan_lebih`;
/*!40000 ALTER TABLE `penginapan_lebih` DISABLE KEYS */;
/*!40000 ALTER TABLE `penginapan_lebih` ENABLE KEYS */;

-- Dumping structure for table st_bnpb.spd_rampung
CREATE TABLE IF NOT EXISTS `spd_rampung` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
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
  `tgl` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table st_bnpb.spd_rampung: ~3 rows (approximately)
DELETE FROM `spd_rampung`;
/*!40000 ALTER TABLE `spd_rampung` DISABLE KEYS */;
INSERT INTO `spd_rampung` (`id`, `id_surat`, `id_pegawai`, `multiple`, `malam`, `penginapan`, `transport`, `harian`, `tiket`, `representasi`, `total`, `tgl`) VALUES
	(1, 4, 29, '1', 1, 200000, 430000, 430000, 2000000, NULL, 4350000, '26/08/2018'),
	(2, 4, 29, '1', 2, 100000, 430000, 430000, 2000000, NULL, 4550000, '26/08/2018'),
	(5, 6, 42, '0', 2, 1212, 430000, 430000, 1212, NULL, 2153636, '27/08/2018');
/*!40000 ALTER TABLE `spd_rampung` ENABLE KEYS */;

-- Dumping structure for table st_bnpb.surat_dinas
CREATE TABLE IF NOT EXISTS `surat_dinas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomor` varchar(30) NOT NULL DEFAULT '00/KADIH/02/2018',
  `kegiatan` varchar(100) NOT NULL,
  `jenis` tinyint(1) NOT NULL,
  `opsi` tinyint(1) NOT NULL,
  `pos` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table st_bnpb.surat_dinas: ~3 rows (approximately)
DELETE FROM `surat_dinas`;
/*!40000 ALTER TABLE `surat_dinas` DISABLE KEYS */;
INSERT INTO `surat_dinas` (`id`, `nomor`, `kegiatan`, `jenis`, `opsi`, `pos`) VALUES
	(1, '1/KADIH/08/2018', 'Monitoring dan Evaluasi BPBD', 1, 1, 1),
	(4, '2/KADIH/08/2018', 'Rapat Kerja Nasional', 0, 0, 1),
	(6, ' 3/KADIH/08/2018', 'enaks', 0, 0, 1);
/*!40000 ALTER TABLE `surat_dinas` ENABLE KEYS */;

-- Dumping structure for table st_bnpb.tiket_pesawat
CREATE TABLE IF NOT EXISTS `tiket_pesawat` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `biaya_tiket` int(10) NOT NULL,
  `rute` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table st_bnpb.tiket_pesawat: ~4 rows (approximately)
DELETE FROM `tiket_pesawat`;
/*!40000 ALTER TABLE `tiket_pesawat` DISABLE KEYS */;
INSERT INTO `tiket_pesawat` (`id`, `biaya_tiket`, `rute`) VALUES
	(1, 7081000, 'Jakarta - Ambon'),
	(2, 3797000, 'Jakarta - Balikpapan'),
	(3, 4492000, 'Jakarta - Banda Aceh'),
	(4, 1583000, 'Jakarta - Bandar Lampung');
/*!40000 ALTER TABLE `tiket_pesawat` ENABLE KEYS */;

-- Dumping structure for table st_bnpb.transportasi_lokal
CREATE TABLE IF NOT EXISTS `transportasi_lokal` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `ibukota` varchar(200) NOT NULL DEFAULT '0',
  `kabupaten` varchar(200) NOT NULL DEFAULT '0',
  `besaran` int(12) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table st_bnpb.transportasi_lokal: ~0 rows (approximately)
DELETE FROM `transportasi_lokal`;
/*!40000 ALTER TABLE `transportasi_lokal` DISABLE KEYS */;
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
/*!40000 ALTER TABLE `transportasi_lokal` ENABLE KEYS */;

-- Dumping structure for table st_bnpb.uang_harian
CREATE TABLE IF NOT EXISTS `uang_harian` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `provinsi` text NOT NULL,
  `luar_kota` int(10) NOT NULL,
  `dalam_kota` int(10) NOT NULL,
  `diklat` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table st_bnpb.uang_harian: ~6 rows (approximately)
DELETE FROM `uang_harian`;
/*!40000 ALTER TABLE `uang_harian` DISABLE KEYS */;
INSERT INTO `uang_harian` (`id`, `provinsi`, `luar_kota`, `dalam_kota`, `diklat`) VALUES
	(1, 'Maluku Utara', 430000, 170000, 130000),
	(2, 'Aceh', 360000, 140000, 110000),
	(3, 'Sumatera Utara', 370000, 150000, 110000),
	(4, 'Riau', 370000, 150000, 110000),
	(5, 'Jambi', 370000, 150000, 110000),
	(6, 'Kepulauan Riau', 370000, 150000, 110000);
/*!40000 ALTER TABLE `uang_harian` ENABLE KEYS */;

-- Dumping structure for table st_bnpb.uang_representasi
CREATE TABLE IF NOT EXISTS `uang_representasi` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `uraian` varchar(20) NOT NULL,
  `luar_kota` int(10) NOT NULL,
  `dalam_kota` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table st_bnpb.uang_representasi: ~2 rows (approximately)
DELETE FROM `uang_representasi`;
/*!40000 ALTER TABLE `uang_representasi` DISABLE KEYS */;
INSERT INTO `uang_representasi` (`id`, `uraian`, `luar_kota`, `dalam_kota`) VALUES
	(1, 'PEJABAT NEGARA', 250000, 125000),
	(2, 'PEJABAT ESELON 1', 200000, 100000),
	(3, 'PEJABAT ESELON II', 150000, 75000);
/*!40000 ALTER TABLE `uang_representasi` ENABLE KEYS */;

-- Dumping structure for table st_bnpb.yang_dinas
CREATE TABLE IF NOT EXISTS `yang_dinas` (
  `id_dinas` int(11) NOT NULL AUTO_INCREMENT,
  `id_surat` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  PRIMARY KEY (`id_dinas`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- Dumping data for table st_bnpb.yang_dinas: ~8 rows (approximately)
DELETE FROM `yang_dinas`;
/*!40000 ALTER TABLE `yang_dinas` DISABLE KEYS */;
INSERT INTO `yang_dinas` (`id_dinas`, `id_surat`, `id_pegawai`) VALUES
	(1, 1, 38),
	(2, 1, 39),
	(5, 4, 29),
	(6, 4, 36),
	(7, 4, 11),
	(8, 4, 13),
	(9, 4, 12),
	(11, 6, 42);
/*!40000 ALTER TABLE `yang_dinas` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
