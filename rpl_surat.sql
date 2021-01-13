-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 13, 2021 at 11:02 AM
-- Server version: 5.7.24
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rpl_surat`
--

-- --------------------------------------------------------

--
-- Table structure for table `arsip`
--

CREATE TABLE `arsip` (
  `no_arsip` varchar(255) NOT NULL,
  `no_surat` varchar(255) NOT NULL,
  `isi_surat` varchar(255) NOT NULL,
  `no_disposisi` varchar(255) NOT NULL,
  `isi_disposisi` varchar(255) NOT NULL,
  `isi_lpj` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `arsip`
--

INSERT INTO `arsip` (`no_arsip`, `no_surat`, `isi_surat`, `no_disposisi`, `isi_disposisi`, `isi_lpj`) VALUES
('13739235512|40773165066|36284960526|18996080706|18727863387|23486668705', '13739235512|40773165066|36284960526|18996080706', 'Tugas1_B_123180051_Satya G.A.pdf', '13739235512|40773165066|36284960526|18996080706|11165263371|12626778865', 'B_Tugas 7_123180049_Nicholas Nanda Sulaksana.pdf', 'Tugas4_B_123180051_Satya Ghifari A.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `lembar_disposisi`
--

CREATE TABLE `lembar_disposisi` (
  `no_disposisi` varchar(255) NOT NULL,
  `isi_surat` varchar(255) NOT NULL,
  `no_surat` varchar(255) NOT NULL,
  `tgl_terbit` date NOT NULL,
  `isi_disposisi` varchar(255) NOT NULL,
  `disposisi_kejari` varchar(255) NOT NULL,
  `nip_pelaksana` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lembar_disposisi`
--

INSERT INTO `lembar_disposisi` (`no_disposisi`, `isi_surat`, `no_surat`, `tgl_terbit`, `isi_disposisi`, `disposisi_kejari`, `nip_pelaksana`) VALUES
('13739235512|40773165066|36284960526|18996080706|11165263371|12626778865', 'Tugas1_B_123180051_Satya G.A.pdf', '13739235512|40773165066|36284960526|18996080706', '2021-01-12', 'B_Tugas 7_123180049_Nicholas Nanda Sulaksana.pdf', 'WVMPBN RBAVW DNOWAH AGWSMKU', '0032008361'),
('32516739399|14609235478|36284960526|9832450707|11165263371|12626778865', 'SOAL TRANPORTASI.pdf', '32516739399|14609235478|36284960526|9832450707', '2021-01-13', '001/13012021/1/disp.pdf', 'ISAWHNTYB UFBATMSGHSB AVBDA DSBN DTYA BBH', '0042005361');

-- --------------------------------------------------------

--
-- Table structure for table `melaksanakan`
--

CREATE TABLE `melaksanakan` (
  `nip_pelaksana` char(10) NOT NULL,
  `no_disposisi` varchar(255) NOT NULL,
  `resp` varchar(100) NOT NULL,
  `LPJ` varchar(255) NOT NULL,
  `status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `melaksanakan`
--

INSERT INTO `melaksanakan` (`nip_pelaksana`, `no_disposisi`, `resp`, `LPJ`, `status`) VALUES
('0032008361', '13739235512|40773165066|36284960526|18996080706|11165263371|12626778865', 'MIWH DISB ATDT WOMHAW MIWH MIWH', 'Tugas4_B_123180051_Satya Ghifari A.pdf', 'selesai');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `nip` char(10) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jabatan` varchar(25) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pass` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`nip`, `nama`, `jabatan`, `email`, `pass`) VALUES
('0011999361', 'Luhur Istighfar', 'Kepala Kantor', 'luhurip@yahoo.com', '7e044b3216dc65162d37bf6348e306b3'),
('0022002361', 'I Made Wayan Kusuma', 'Sekretaris', 'wayankusuma@gmail.com', '342527b2c4fd7d5533d6b2a36a71f39d'),
('0032008361', 'Ismail bin Mail', 'Kepala Bagian', 'mailismail@gmail.com', '8d754c603dfb0dd79be9caa238ff97a4'),
('0042005361', 'Nur Archibald', 'Kepala Bagian', 'archibald17@gmail.com', '5aaf94fcf075502dc1f65cdbf10ab07f'),
('0101997361', 'Sofie Hanna', 'Petugas TU', 'sofie75@gmail.com', '60b45d8546dd90e456ee7efae698c874');

-- --------------------------------------------------------

--
-- Table structure for table `surat`
--

CREATE TABLE `surat` (
  `no_surat` varchar(255) NOT NULL,
  `tgl_input` date NOT NULL,
  `nip_pengisi` char(10) NOT NULL,
  `isi_surat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `surat`
--

INSERT INTO `surat` (`no_surat`, `tgl_input`, `nip_pengisi`, `isi_surat`) VALUES
('13739235512|40773165066|36284960526|18996080706', '2021-01-12', '0101997361', 'Tugas1_B_123180051_Satya G.A.pdf'),
('32516739399|14609235478|36284960526|9832450707', '2021-01-13', '0101997361', 'SOAL TRANPORTASI.pdf');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `arsip`
--
ALTER TABLE `arsip`
  ADD PRIMARY KEY (`no_arsip`),
  ADD KEY `fk_isi_disposisi_arsip` (`isi_disposisi`),
  ADD KEY `fk_isi_lpj_arsip` (`isi_lpj`),
  ADD KEY `fk_isi_surat_arsip` (`isi_surat`),
  ADD KEY `fk_no_disposisi_arsip` (`no_disposisi`),
  ADD KEY `fk_no_surat_arsip` (`no_surat`);

--
-- Indexes for table `lembar_disposisi`
--
ALTER TABLE `lembar_disposisi`
  ADD PRIMARY KEY (`no_disposisi`),
  ADD UNIQUE KEY `isi_disposisi` (`isi_disposisi`),
  ADD KEY `fk_isi_surat` (`isi_surat`),
  ADD KEY `fk_nip_pelaksana` (`nip_pelaksana`),
  ADD KEY `fk_no_surat` (`no_surat`);

--
-- Indexes for table `melaksanakan`
--
ALTER TABLE `melaksanakan`
  ADD UNIQUE KEY `LPJ` (`LPJ`),
  ADD KEY `fk_disposisi` (`no_disposisi`),
  ADD KEY `fk_nip_laksanakan` (`nip_pelaksana`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`nip`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `surat`
--
ALTER TABLE `surat`
  ADD PRIMARY KEY (`no_surat`),
  ADD UNIQUE KEY `isi_surat` (`isi_surat`),
  ADD KEY `fk_nip` (`nip_pengisi`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `arsip`
--
ALTER TABLE `arsip`
  ADD CONSTRAINT `fk_isi_disposisi_arsip` FOREIGN KEY (`isi_disposisi`) REFERENCES `lembar_disposisi` (`isi_disposisi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_isi_lpj_arsip` FOREIGN KEY (`isi_lpj`) REFERENCES `melaksanakan` (`LPJ`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_isi_surat_arsip` FOREIGN KEY (`isi_surat`) REFERENCES `surat` (`isi_surat`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_no_disposisi_arsip` FOREIGN KEY (`no_disposisi`) REFERENCES `lembar_disposisi` (`no_disposisi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_no_surat_arsip` FOREIGN KEY (`no_surat`) REFERENCES `surat` (`no_surat`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lembar_disposisi`
--
ALTER TABLE `lembar_disposisi`
  ADD CONSTRAINT `fk_isi_surat` FOREIGN KEY (`isi_surat`) REFERENCES `surat` (`isi_surat`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_nip_pelaksana` FOREIGN KEY (`nip_pelaksana`) REFERENCES `pegawai` (`nip`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_no_surat` FOREIGN KEY (`no_surat`) REFERENCES `surat` (`no_surat`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `melaksanakan`
--
ALTER TABLE `melaksanakan`
  ADD CONSTRAINT `fk_disposisi` FOREIGN KEY (`no_disposisi`) REFERENCES `lembar_disposisi` (`no_disposisi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_nip_laksanakan` FOREIGN KEY (`nip_pelaksana`) REFERENCES `pegawai` (`nip`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `surat`
--
ALTER TABLE `surat`
  ADD CONSTRAINT `fk_nip` FOREIGN KEY (`nip_pengisi`) REFERENCES `pegawai` (`nip`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
