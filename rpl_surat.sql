-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 13, 2020 at 04:41 AM
-- Server version: 5.7.24
-- PHP Version: 7.2.19

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
  `no_arsip` varchar(30) NOT NULL,
  `no_surat` varchar(20) NOT NULL,
  `isi_surat` varchar(255) NOT NULL,
  `no_disposisi` varchar(30) NOT NULL,
  `isi_disposisi` varchar(255) NOT NULL,
  `isi_lpj` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `arsip`
--

INSERT INTO `arsip` (`no_arsip`, `no_surat`, `isi_surat`, `no_disposisi`, `isi_disposisi`, `isi_lpj`) VALUES
('001/22042020/1/ars', '001/22042020/1', 'C_123180051_Satya Ghifari A..pdf', '001/22042020/1/disp', 'tugas A,B,C,D 2020.pdf', 'UTS 2019-2020 genap.pdf'),
('002/21042020/5/ars', '002/21042020/5', 'certif sololearn.pdf', '002/21042020/5/disp', 'FIX SERTIFIKAT AI JULI-10.pdf', 'Sertifikat Kelulusan Belajar Dasar Pemrograman Web.pdf'),
('005/21042020/2/ars', '005/21042020/2', 'tiket1.pdf', '005/21042020/2/disp', 'tiket2.pdf', 'UTS_PBO_IF_ Genap_2019_2020.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `lembar_disposisi`
--

CREATE TABLE `lembar_disposisi` (
  `no_disposisi` varchar(30) NOT NULL,
  `isi_surat` varchar(255) NOT NULL,
  `no_surat` varchar(20) NOT NULL,
  `tgl_terbit` date NOT NULL,
  `isi_disposisi` varchar(255) NOT NULL,
  `disposisi_kejari` varchar(100) NOT NULL,
  `nip_pelaksana` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lembar_disposisi`
--

INSERT INTO `lembar_disposisi` (`no_disposisi`, `isi_surat`, `no_surat`, `tgl_terbit`, `isi_disposisi`, `disposisi_kejari`, `nip_pelaksana`) VALUES
('001/22042020/1/disp', 'C_123180051_Satya Ghifari A..pdf', '001/22042020/1', '2020-04-22', 'tugas A,B,C,D 2020.pdf', 'Bertemu bapak a terlebih dahulu', '0042005361'),
('002/21042020/5/disp', 'certif sololearn.pdf', '002/21042020/5', '2020-04-21', 'FIX SERTIFIKAT AI JULI-10.pdf', '- hati-hati dijalan', '0032008361'),
('005/21042020/2/disp', 'tiket1.pdf', '005/21042020/2', '2020-04-21', 'tiket2.pdf', 'hadiri dengan baik', '0042005361');

-- --------------------------------------------------------

--
-- Table structure for table `melaksanakan`
--

CREATE TABLE `melaksanakan` (
  `nip_pelaksana` char(10) NOT NULL,
  `no_disposisi` varchar(30) NOT NULL,
  `resp` varchar(100) NOT NULL,
  `LPJ` varchar(255) NOT NULL,
  `status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `melaksanakan`
--

INSERT INTO `melaksanakan` (`nip_pelaksana`, `no_disposisi`, `resp`, `LPJ`, `status`) VALUES
('0032008361', '002/21042020/5/disp', 'Siap laksanakan terimakasih', 'Sertifikat Kelulusan Belajar Dasar Pemrograman Web.pdf', 'selesai'),
('0042005361', '001/22042020/1/disp', 'siap pak saya laksanakan setelah ini', 'UTS 2019-2020 genap.pdf', 'selesai'),
('0042005361', '005/21042020/2/disp', 'Siap laksanakan terimakasih', 'UTS_PBO_IF_ Genap_2019_2020.pdf', 'selesai');

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
('0011999361', 'Luhur Istighfar', 'Kepala Kantor', 'luhurip@yahoo.com', 'srondoly7'),
('0022002361', 'I Made Wayan Kusuma', 'Sekretaris', 'wayankusuma@gmail.com', 'baliindah'),
('0032008361', 'Ismail bin Mail', 'Kepala Bagian', 'mailismail@gmail.com', 'duasinggit'),
('0042005361', 'Nur Archibald', 'Kepala Bagian', 'archibald17@gmail.com', 'kapten17'),
('0101997361', 'Sofie Hanna', 'Petugas TU', 'sofie75@gmail.com', 'kemanakita');

-- --------------------------------------------------------

--
-- Table structure for table `surat`
--

CREATE TABLE `surat` (
  `no_surat` varchar(20) NOT NULL,
  `tgl_input` date NOT NULL,
  `nip_pengisi` char(10) NOT NULL,
  `isi_surat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `surat`
--

INSERT INTO `surat` (`no_surat`, `tgl_input`, `nip_pengisi`, `isi_surat`) VALUES
('001/22042020/1', '2020-04-22', '0101997361', 'C_123180051_Satya Ghifari A..pdf'),
('002/21042020/5', '2020-04-21', '0101997361', 'certif sololearn.pdf'),
('005/21042020/2', '2020-04-21', '0101997361', 'tiket1.pdf');

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
  ADD CONSTRAINT `fk_isi_disposisi_arsip` FOREIGN KEY (`isi_disposisi`) REFERENCES `lembar_disposisi` (`isi_disposisi`),
  ADD CONSTRAINT `fk_isi_lpj_arsip` FOREIGN KEY (`isi_lpj`) REFERENCES `melaksanakan` (`LPJ`),
  ADD CONSTRAINT `fk_isi_surat_arsip` FOREIGN KEY (`isi_surat`) REFERENCES `surat` (`isi_surat`),
  ADD CONSTRAINT `fk_no_disposisi_arsip` FOREIGN KEY (`no_disposisi`) REFERENCES `lembar_disposisi` (`no_disposisi`),
  ADD CONSTRAINT `fk_no_surat_arsip` FOREIGN KEY (`no_surat`) REFERENCES `surat` (`no_surat`);

--
-- Constraints for table `lembar_disposisi`
--
ALTER TABLE `lembar_disposisi`
  ADD CONSTRAINT `fk_isi_surat` FOREIGN KEY (`isi_surat`) REFERENCES `surat` (`isi_surat`),
  ADD CONSTRAINT `fk_nip_pelaksana` FOREIGN KEY (`nip_pelaksana`) REFERENCES `pegawai` (`nip`),
  ADD CONSTRAINT `fk_no_surat` FOREIGN KEY (`no_surat`) REFERENCES `surat` (`no_surat`);

--
-- Constraints for table `melaksanakan`
--
ALTER TABLE `melaksanakan`
  ADD CONSTRAINT `fk_disposisi` FOREIGN KEY (`no_disposisi`) REFERENCES `lembar_disposisi` (`no_disposisi`),
  ADD CONSTRAINT `fk_nip_laksanakan` FOREIGN KEY (`nip_pelaksana`) REFERENCES `pegawai` (`nip`);

--
-- Constraints for table `surat`
--
ALTER TABLE `surat`
  ADD CONSTRAINT `fk_nip` FOREIGN KEY (`nip_pengisi`) REFERENCES `pegawai` (`nip`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
