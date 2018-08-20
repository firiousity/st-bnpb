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
DROP DATABASE IF EXISTS `st_bnpb`;
CREATE DATABASE IF NOT EXISTS `st_bnpb` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `st_bnpb`;

-- Dumping structure for table st_bnpb.admin
DROP TABLE IF EXISTS `admin`;
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
DROP TABLE IF EXISTS `biaya_penginapan`;
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
DROP TABLE IF EXISTS `biaya_transport`;
CREATE TABLE IF NOT EXISTS `biaya_transport` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `provinsi` text NOT NULL,
  `besaran` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table st_bnpb.biaya_transport: ~4 rows (approximately)
DELETE FROM `biaya_transport`;
/*!40000 ALTER TABLE `biaya_transport` DISABLE KEYS */;
INSERT INTO `biaya_transport` (`id`, `provinsi`, `besaran`) VALUES
	(1, 'Maluku Utara', 215000),
	(2, 'Aceh', 123000),
	(3, 'Sumatera Utara', 232000),
	(4, 'Riau', 94000);
/*!40000 ALTER TABLE `biaya_transport` ENABLE KEYS */;

-- Dumping structure for table st_bnpb.data_rinci
DROP TABLE IF EXISTS `data_rinci`;
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
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;

-- Dumping data for table st_bnpb.data_rinci: ~32 rows (approximately)
DELETE FROM `data_rinci`;
/*!40000 ALTER TABLE `data_rinci` DISABLE KEYS */;
INSERT INTO `data_rinci` (`id`, `id_surat`, `nomor`, `pos`, `kegiatan`, `jenis`, `opsi`, `id_pegawai`, `tgl_mulai`, `tgl_akhir`, `tgl_surat`, `tempat`, `id_harian`, `id_penginapan`, `id_tiket`, `id_transport`, `id_transport2`) VALUES
	(12, 42, '1/KADIH/08/2018', 0, 'Penyelesaian Hibah Final Pusdatinmas BNPB Kepada BPBD Provinsi, Kabupaten dan Kota', 0, 1, 37, '2018-08-30', '2018-09-01', '16/08/2018', 'Provinsi Lampung', 2, '2', 1, 1, 1),
	(13, 42, '1/KADIH/08/2018', 0, 'Penyelesaian Hibah Final Pusdatinmas BNPB Kepada BPBD Provinsi, Kabupaten dan Kota', 0, 1, 43, '2018-08-04', '2018-08-06', '16/08/2018', 'Kalimantan Barat', 4, '1', 1, 1, 1),
	(14, 42, '1/KADIH/08/2018', 0, 'Penyelesaian Hibah Final Pusdatinmas BNPB Kepada BPBD Provinsi, Kabupaten dan Kota', 0, 1, 36, '2018-08-06', '2018-08-08', '16/08/2018', 'Provinsi Jawa Barat dan Kota Banjar', 1, '1', 1, 1, 1),
	(15, 43, '2/KADIH/08/2018', 0, 'Rapat Kerja Nasional', 1, 0, 42, '2018-08-02', '2018-08-03', '16/08/2018', 'Provinsi Aceh', 1, '1', 1, 1, 1),
	(16, 43, '2/KADIH/08/2018', 0, 'Rapat Kerja Nasional', 1, 0, 22, '2018-08-02', '2018-08-03', '16/08/2018', 'Provinsi Aceh', 1, '1', 1, 1, 1),
	(17, 44, '4/KADIH/08/2018', 0, 'Rapat Kerja Nasional Tes', 1, 1, 45, '2018-08-01', '2018-08-02', '16/08/2018', 'maluku', 1, '1', 1, 1, 1),
	(18, 45, '5/KADIH/08/2018', 0, '', 0, 1, 45, '2018-08-02', '2018-08-06', '16/08/2018', 'maluku', 1, '1', 1, 1, 1),
	(19, 45, '5/KADIH/08/2018', 0, '', 0, 1, 45, '2018-08-15', '2018-08-17', '16/08/2018', 'bb', 1, '1', 1, 1, 1),
	(20, 46, '6/KADIH/08/2018', 0, 'Monitoring dan Evaluasi BPBD', 0, 1, 45, '2018-08-02', '2018-08-04', '16/08/2018', 'maluku', 1, '1', 1, 1, 3),
	(21, 46, '6/KADIH/08/2018', 0, 'Monitoring dan Evaluasi BPBD', 0, 1, 29, '2018-08-15', '2018-08-17', '16/08/2018', 'maluku utara', 1, '1', 1, 1, 1),
	(22, 46, '6/KADIH/08/2018', 0, 'Monitoring dan Evaluasi BPBD', 0, 1, 1, '2018-08-01', '2018-08-02', '16/08/2018', 'serang', 1, '1', 1, 1, 1),
	(23, 47, '7/KADIH/08/2018', 0, 'Rapat Kerja Nasional', 0, 0, 34, '2018-08-17', '2018-08-20', '16/08/2018', 'Provinsi Bali', 2, '1', 1, 1, 1),
	(24, 47, '7/KADIH/08/2018', 0, 'Rapat Kerja Nasional', 0, 0, 5, '2018-08-17', '2018-08-20', '16/08/2018', 'Provinsi Bali', 2, '1', 1, 1, 1),
	(25, 48, '8/KADIH/08/2018', 0, 'Rapat Kerja Nasional', 0, 0, 29, '2018-08-03', '2018-08-15', '16/08/2018', 'Provinsi Aceh', 1, '1', 1, 1, 1),
	(26, 48, '8/KADIH/08/2018', 0, 'Rapat Kerja Nasional', 0, 0, 42, '2018-08-03', '2018-08-15', '16/08/2018', 'Provinsi Aceh', 1, '1', 1, 1, 1),
	(27, 48, '8/KADIH/08/2018', 0, 'Rapat Kerja Nasional', 0, 0, 22, '2018-08-03', '2018-08-15', '16/08/2018', 'Provinsi Aceh', 1, '1', 1, 1, 1),
	(28, 48, '8/KADIH/08/2018', 0, 'Rapat Kerja Nasional', 0, 0, 36, '2018-08-03', '2018-08-15', '16/08/2018', 'Provinsi Aceh', 1, '1', 1, 1, 1),
	(29, 48, '8/KADIH/08/2018', 0, 'Rapat Kerja Nasional', 0, 0, 11, '2018-08-03', '2018-08-15', '16/08/2018', 'Provinsi Aceh', 1, '1', 1, 1, 1),
	(30, 48, '8/KADIH/08/2018', 0, 'Rapat Kerja Nasional', 0, 0, 12, '2018-08-03', '2018-08-15', '16/08/2018', 'Provinsi Aceh', 1, '1', 1, 1, 1),
	(31, 48, '8/KADIH/08/2018', 0, 'Rapat Kerja Nasional', 0, 0, 18, '2018-08-03', '2018-08-15', '16/08/2018', 'Provinsi Aceh', 1, '1', 1, 1, 1),
	(32, 48, '8/KADIH/08/2018', 0, 'Rapat Kerja Nasional', 0, 0, 19, '2018-08-03', '2018-08-15', '16/08/2018', 'Provinsi Aceh', 1, '1', 1, 1, 1),
	(33, 48, '8/KADIH/08/2018', 0, 'Rapat Kerja Nasional', 0, 0, 6, '2018-08-03', '2018-08-15', '16/08/2018', 'Provinsi Aceh', 1, '1', 1, 1, 1),
	(34, 48, '8/KADIH/08/2018', 0, 'Rapat Kerja Nasional', 0, 0, 43, '2018-08-03', '2018-08-15', '16/08/2018', 'Provinsi Aceh', 1, '1', 1, 1, 1),
	(35, 48, '8/KADIH/08/2018', 0, 'Rapat Kerja Nasional', 0, 0, 1, '2018-08-03', '2018-08-15', '16/08/2018', 'Provinsi Aceh', 1, '1', 1, 1, 1),
	(36, 48, '8/KADIH/08/2018', 0, 'Rapat Kerja Nasional', 0, 0, 3, '2018-08-03', '2018-08-15', '16/08/2018', 'Provinsi Aceh', 1, '1', 1, 1, 1),
	(37, 48, '8/KADIH/08/2018', 0, 'Rapat Kerja Nasional', 0, 0, 34, '2018-08-03', '2018-08-15', '16/08/2018', 'Provinsi Aceh', 1, '1', 1, 1, 1),
	(38, 49, '     /KADIH/08/2018', 0, 'Monitoring dan Evaluasi BPBD', 1, 0, 45, '2018-08-23', '2018-08-25', '16/08/2018', 'Provinsi Aceh', 2, '2', 3, 2, 2),
	(39, 49, '     /KADIH/08/2018', 0, 'Monitoring dan Evaluasi BPBD', 1, 0, 16, '2018-08-23', '2018-08-25', '16/08/2018', 'Provinsi Aceh', 2, '2', 3, 2, 2),
	(40, 49, '     /KADIH/08/2018', 0, 'Monitoring dan Evaluasi BPBD', 1, 0, 29, '2018-08-23', '2018-08-25', '16/08/2018', 'Provinsi Aceh', 2, '2', 3, 2, 2),
	(41, 49, '     /KADIH/08/2018', 0, 'Monitoring dan Evaluasi BPBD', 1, 0, 22, '2018-08-23', '2018-08-25', '16/08/2018', 'Provinsi Aceh', 2, '2', 3, 2, 2),
	(42, 50, '5/KADIH/08/2018', 0, 'Ena', 0, 0, 29, '2018-08-02', '2018-08-03', '20/08/2018', 'rwm', 1, '1', 1, 1, 1),
	(43, 50, '5/KADIH/08/2018', 0, 'Ena', 0, 0, 42, '2018-08-02', '2018-08-03', '20/08/2018', 'rwm', 1, '1', 1, 1, 1),
	(44, 52, '6/KADIH/08/2018', 1, 'Ena', 0, 0, 42, '2018-08-03', '2018-08-06', '20/08/2018', 'Provinsi Aceh', 1, '1', 1, 1, 1),
	(45, 52, '6/KADIH/08/2018', 1, 'Ena', 0, 0, 22, '2018-08-03', '2018-08-06', '20/08/2018', 'Provinsi Aceh', 1, '1', 1, 1, 1);
/*!40000 ALTER TABLE `data_rinci` ENABLE KEYS */;

-- Dumping structure for table st_bnpb.pegawai
DROP TABLE IF EXISTS `pegawai`;
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
DROP TABLE IF EXISTS `pejabat_administratif`;
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
DROP TABLE IF EXISTS `pembayaran_awal`;
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
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table st_bnpb.pembayaran_awal: ~28 rows (approximately)
DELETE FROM `pembayaran_awal`;
/*!40000 ALTER TABLE `pembayaran_awal` DISABLE KEYS */;
INSERT INTO `pembayaran_awal` (`id`, `id_surat`, `id_pegawai`, `penginapan`, `harian`, `transport`, `tiket`, `representasi`, `total`) VALUES
	(36, 42, 37, 0, 0, 0, 0, 0, 0),
	(37, 42, 37, 0, 0, 0, 0, 0, 0),
	(38, 43, 42, 480000, 430000, 860000, 7081000, 0, 8851000),
	(39, 43, 42, 480000, 430000, 860000, 7081000, 0, 8851000),
	(40, 43, 42, 480000, 430000, 860000, 7081000, 0, 8851000),
	(41, 43, 42, 480000, 430000, 860000, 7081000, 0, 8851000),
	(42, 43, 42, 480000, 430000, 860000, 7081000, 0, 8851000),
	(43, 46, 45, 0, 0, 0, 0, 0, 0),
	(44, 46, 45, 0, 0, 0, 0, 0, 0),
	(45, 46, 45, 0, 0, 0, 0, 0, 0),
	(46, 48, 29, 0, 0, 0, 0, 0, 0),
	(47, 49, 45, 556000, 360000, 492000, 4492000, 0, 5900000),
	(48, 49, 45, 556000, 360000, 492000, 4492000, 0, 5900000),
	(49, 42, 37, 0, 0, 0, 0, 0, 0),
	(50, 49, 45, 556000, 360000, 492000, 4492000, 0, 5900000),
	(51, 49, 16, 556000, 360000, 492000, 4492000, 0, 5900000),
	(52, 49, 16, 556000, 360000, 492000, 4492000, 0, 5900000),
	(53, 49, 45, 556000, 360000, 492000, 4492000, 0, 5900000),
	(54, 49, 45, 556000, 360000, 492000, 4492000, 0, 5900000),
	(55, 49, 45, 556000, 360000, 492000, 4492000, 0, 5900000),
	(56, 49, 45, 556000, 360000, 492000, 4492000, 0, 5900000),
	(57, 49, 45, 556000, 360000, 492000, 4492000, 0, 5900000),
	(58, 49, 45, 556000, 360000, 492000, 4492000, 0, 5900000),
	(59, 49, 45, 556000, 360000, 492000, 4492000, 0, 5900000),
	(60, 49, 45, 556000, 360000, 492000, 4492000, 0, 5900000),
	(61, 49, 45, 556000, 360000, 492000, 4492000, 0, 5900000),
	(62, 49, 45, 556000, 360000, 492000, 4492000, 0, 5900000),
	(63, 49, 45, 556000, 360000, 492000, 4492000, 0, 5900000);
/*!40000 ALTER TABLE `pembayaran_awal` ENABLE KEYS */;

-- Dumping structure for table st_bnpb.rincian_biaya
DROP TABLE IF EXISTS `rincian_biaya`;
CREATE TABLE IF NOT EXISTS `rincian_biaya` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `id_surat` int(5) NOT NULL,
  `id_pegawai` int(5) DEFAULT NULL,
  `transport` int(10) DEFAULT NULL,
  `penginapan` int(8) DEFAULT NULL,
  `harian` int(8) DEFAULT NULL,
  `tiket` int(10) DEFAULT NULL,
  `representasi` int(8) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table st_bnpb.rincian_biaya: ~0 rows (approximately)
DELETE FROM `rincian_biaya`;
/*!40000 ALTER TABLE `rincian_biaya` DISABLE KEYS */;
/*!40000 ALTER TABLE `rincian_biaya` ENABLE KEYS */;

-- Dumping structure for table st_bnpb.spd_rampung
DROP TABLE IF EXISTS `spd_rampung`;
CREATE TABLE IF NOT EXISTS `spd_rampung` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `id_surat` int(5) NOT NULL,
  `id_pegawai` int(10) DEFAULT NULL,
  `penginapan` int(8) DEFAULT NULL,
  `transport` int(8) DEFAULT NULL,
  `harian` int(8) DEFAULT NULL,
  `tiket` int(10) DEFAULT NULL,
  `representasi` int(8) DEFAULT NULL,
  `total` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table st_bnpb.spd_rampung: ~28 rows (approximately)
DELETE FROM `spd_rampung`;
/*!40000 ALTER TABLE `spd_rampung` DISABLE KEYS */;
INSERT INTO `spd_rampung` (`id`, `id_surat`, `id_pegawai`, `penginapan`, `transport`, `harian`, `tiket`, `representasi`, `total`) VALUES
	(37, 42, 37, 120000, 430000, 360000, 2100000, NULL, 3850000),
	(38, 42, 37, 120000, 430000, 360000, 2100000, NULL, 3850000),
	(39, 43, 42, 710000, 430000, 430000, 1500000, NULL, 3500000),
	(40, 43, 42, NULL, 430000, 430000, NULL, NULL, 1290000),
	(41, 43, 42, NULL, 430000, 430000, NULL, NULL, 1290000),
	(42, 43, 42, NULL, 430000, 430000, NULL, NULL, 1290000),
	(43, 43, 42, 710000, 430000, 430000, 1500000, NULL, 3500000),
	(44, 46, 45, 700000, 430000, 430000, 1500000, NULL, 4620000),
	(45, 46, 45, 700000, 430000, 430000, 1500000, NULL, 4620000),
	(46, 46, 45, 700000, 430000, 430000, 1500000, NULL, 4620000),
	(47, 48, 29, 100000, 430000, 430000, 10000000, NULL, 17220000),
	(48, 49, 45, 500000, 246000, 360000, 2500000, NULL, 4826000),
	(49, 49, 45, 500000, 246000, 360000, 2500000, NULL, 4826000),
	(50, 42, 37, 120000, 430000, 360000, 2100000, NULL, 3850000),
	(51, 49, 45, 500000, 246000, 360000, 2500000, NULL, 4826000),
	(52, 49, 16, 450000, 246000, 360000, 6700000, NULL, 8926000),
	(53, 49, 16, 450000, 246000, 360000, 6700000, NULL, 8926000),
	(54, 49, 45, 500000, 246000, 360000, 2500000, NULL, 4826000),
	(55, 49, 45, 500000, 246000, 360000, 2500000, NULL, 4826000),
	(56, 49, 45, 500000, 246000, 360000, 2500000, NULL, 4826000),
	(57, 49, 45, 500000, 246000, 360000, 2500000, NULL, 4826000),
	(58, 49, 45, 500000, 246000, 360000, 2500000, NULL, 4826000),
	(59, 49, 45, 500000, 246000, 360000, 2500000, NULL, 4826000),
	(60, 49, 45, 500000, 246000, 360000, 2500000, NULL, 4826000),
	(61, 49, 45, 500000, 246000, 360000, 2500000, NULL, 4826000),
	(62, 49, 45, 500000, 246000, 360000, 2500000, NULL, 4826000),
	(63, 49, 45, 500000, 246000, 360000, 2500000, NULL, 4826000),
	(64, 49, 45, 500000, 246000, 360000, 2500000, NULL, 4826000);
/*!40000 ALTER TABLE `spd_rampung` ENABLE KEYS */;

-- Dumping structure for table st_bnpb.surat_dinas
DROP TABLE IF EXISTS `surat_dinas`;
CREATE TABLE IF NOT EXISTS `surat_dinas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomor` varchar(30) NOT NULL DEFAULT '00/KADIH/02/2018',
  `kegiatan` varchar(100) NOT NULL,
  `jenis` tinyint(1) NOT NULL,
  `opsi` tinyint(1) NOT NULL,
  `pos` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=latin1;

-- Dumping data for table st_bnpb.surat_dinas: ~11 rows (approximately)
DELETE FROM `surat_dinas`;
/*!40000 ALTER TABLE `surat_dinas` DISABLE KEYS */;
INSERT INTO `surat_dinas` (`id`, `nomor`, `kegiatan`, `jenis`, `opsi`, `pos`) VALUES
	(42, '1/KADIH/08/2018', 'Penyelesaian Hibah Final Pusdatinmas BNPB Kepada B', 0, 1, NULL),
	(43, '2/KADIH/08/2018', 'Rapat Kerja Nasional', 1, 0, NULL),
	(44, '4/KADIH/08/2018', 'Rapat Kerja Nasional Tes', 1, 1, NULL),
	(45, '5/KADIH/08/2018', '', 0, 1, NULL),
	(46, '6/KADIH/08/2018', 'Monitoring dan Evaluasi BPBD', 0, 1, NULL),
	(47, '7/KADIH/08/2018', 'Rapat Kerja Nasional', 0, 0, NULL),
	(48, '8/KADIH/08/2018', 'Rapat Kerja Nasional', 0, 0, NULL),
	(49, '     /KADIH/08/2018', 'Monitoring dan Evaluasi BPBD', 1, 0, NULL),
	(50, '5/KADIH/08/2018', 'Ena', 0, 0, NULL),
	(51, '6/KADIH/08/2018', 'Ena', 0, 0, 1),
	(52, '6/KADIH/08/2018', 'Ena', 0, 0, 1);
/*!40000 ALTER TABLE `surat_dinas` ENABLE KEYS */;

-- Dumping structure for table st_bnpb.tiket_pesawat
DROP TABLE IF EXISTS `tiket_pesawat`;
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

-- Dumping structure for table st_bnpb.uang_harian
DROP TABLE IF EXISTS `uang_harian`;
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
DROP TABLE IF EXISTS `uang_representasi`;
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
DROP TABLE IF EXISTS `yang_dinas`;
CREATE TABLE IF NOT EXISTS `yang_dinas` (
  `id_dinas` int(11) NOT NULL AUTO_INCREMENT,
  `id_surat` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  PRIMARY KEY (`id_dinas`)
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=latin1;

-- Dumping data for table st_bnpb.yang_dinas: ~35 rows (approximately)
DELETE FROM `yang_dinas`;
/*!40000 ALTER TABLE `yang_dinas` DISABLE KEYS */;
INSERT INTO `yang_dinas` (`id_dinas`, `id_surat`, `id_pegawai`) VALUES
	(67, 42, 37),
	(68, 42, 43),
	(69, 42, 36),
	(70, 43, 42),
	(71, 43, 22),
	(72, 44, 45),
	(73, 45, 45),
	(74, 45, 45),
	(75, 46, 45),
	(76, 46, 29),
	(77, 46, 1),
	(78, 47, 34),
	(79, 47, 5),
	(80, 48, 29),
	(81, 48, 42),
	(82, 48, 22),
	(83, 48, 36),
	(84, 48, 11),
	(85, 48, 12),
	(86, 48, 18),
	(87, 48, 19),
	(88, 48, 6),
	(89, 48, 43),
	(90, 48, 1),
	(91, 48, 3),
	(92, 48, 34),
	(93, 49, 45),
	(94, 49, 16),
	(95, 49, 29),
	(96, 49, 22),
	(97, 50, 29),
	(98, 50, 42),
	(99, 51, 42),
	(100, 52, 42),
	(101, 52, 22);
/*!40000 ALTER TABLE `yang_dinas` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
