-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 25, 2024 at 10:23 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_portofolskote`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_about`
--

CREATE TABLE `tb_about` (
  `id_about` int NOT NULL,
  `nama` varchar(50) NOT NULL,
  `profession` varchar(250) NOT NULL,
  `phone` varchar(25) NOT NULL,
  `email` varchar(255) NOT NULL,
  `location` text NOT NULL,
  `foto_about` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `about` text NOT NULL,
  `linkedn` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `instagram` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `github` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `cv` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_about`
--

INSERT INTO `tb_about` (`id_about`, `nama`, `profession`, `phone`, `email`, `location`, `birthday`, `foto_about`, `about`, `linkedn`, `instagram`, `facebook`, `cv`) VALUES
(1, 'joe', '-', '62895627552055', 'fiqrin1805@gmail.com', '-tes', '2002-05-18', '20241021002716-c44f2719-9dde-4286-ac23-954fb90478f1.jpg', '-', '-', '-', '-', '-');

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id_admin` int NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_level` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`id_admin`, `email`, `username`, `password`, `id_level`) VALUES
(10, 'admintest@gmail.com', 'admin', '$2y$10$RHxg4GGevmJ/BbC9vBxDSe9FsdVU/rcontxe5ROuTNQMYiYVhN0ru', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tb_certificate`
--

CREATE TABLE `tb_certificate` (
  `id_certificate` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `pihak` varchar(255) NOT NULL,
  `detail` text NOT NULL,
  `Gambar_hasilcertificate` text NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_certificate`
--

INSERT INTO `tb_certificate` (`id_certificate`, `title`, `pihak`, `detail`, `Gambar_hasilcertificate`, `tanggal_mulai`, `tanggal_selesai`) VALUES
(7, 'df', 'dfdf', 'akkasuasnjanamkskamksmkasmkmassmakmkask\r\nyuhu', '20241021003517-E10BAEA5-92E0-4FA3-AD88-E397202B47B6.jpg', '2024-10-14', '2024-10-26');

-- --------------------------------------------------------

--
-- Table structure for table `tb_education`
--

CREATE TABLE `tb_education` (
  `id_education` int NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `posisi` varchar(255) DEFAULT NULL,
  `detail` text,
  `tanggal_mulai` date DEFAULT NULL,
  `tanggal_selesai` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_education`
--

INSERT INTO `tb_education` (`id_education`, `title`, `posisi`, `detail`, `tanggal_mulai`, `tanggal_selesai`) VALUES
(2, 'test', 'test', 'test', '2024-10-11', '2024-10-26');

-- --------------------------------------------------------

--
-- Table structure for table `tb_experience`
--

CREATE TABLE `tb_experience` (
  `id_experience` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `posisi` varchar(255) NOT NULL,
  `detail` text NOT NULL,
  `technology` varchar(255) NOT NULL,
  `jobdesk` text NOT NULL,
  `Gambar_hasilexperience` text NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_experience`
--

INSERT INTO `tb_experience` (`id_experience`, `title`, `posisi`, `detail`, `technology`, `jobdesk`, `Gambar_hasilexperience`, `tanggal_mulai`, `tanggal_selesai`) VALUES
(1, 'test', 'test', 'test', 'test', 'test', '20241020021325-maulana fiqri - Copy (2).jpg', '2024-10-20', '2024-10-23');

-- --------------------------------------------------------

--
-- Table structure for table `tb_level`
--

CREATE TABLE `tb_level` (
  `id_level` int NOT NULL,
  `level` char(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_level`
--

INSERT INTO `tb_level` (`id_level`, `level`) VALUES
(3, 'super admin');

-- --------------------------------------------------------

--
-- Table structure for table `tb_project`
--

CREATE TABLE `tb_project` (
  `id_project` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `posisi` varchar(255) NOT NULL,
  `detail` text NOT NULL,
  `technology` varchar(255) NOT NULL,
  `jobdesk` text NOT NULL,
  `Gambar_hasilproject` text NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_project`
--

INSERT INTO `tb_project` (`id_project`, `title`, `posisi`, `detail`, `technology`, `jobdesk`, `Gambar_hasilproject`, `tanggal_mulai`, `tanggal_selesai`) VALUES
(1, 'p', 'p', 'p\r\naku ganteng', 'ps', 'p', '20241020045033-maulana fiqri - Copy.jpg', '2024-10-10', '2024-10-21');

-- --------------------------------------------------------

--
-- Table structure for table `tb_services`
--

CREATE TABLE `tb_services` (
  `id_services` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `detail` text NOT NULL,
  `icon` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_services`
--

INSERT INTO `tb_services` (`id_services`, `title`, `detail`, `icon`) VALUES
(4, 'test', 'test', 'test'),
(5, 'yuhu', 'yuhu\r\noke', 'a');

-- --------------------------------------------------------

--
-- Table structure for table `tb_skills`
--

CREATE TABLE `tb_skills` (
  `id_skills` int NOT NULL,
  `nama` varchar(25) DEFAULT NULL,
  `tgl_input` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_skills`
--

INSERT INTO `tb_skills` (`id_skills`, `nama`, `tgl_input`) VALUES
(1, 'test', '2024-10-20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_about`
--
ALTER TABLE `tb_about`
  ADD PRIMARY KEY (`id_about`);

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `tb_certificate`
--
ALTER TABLE `tb_certificate`
  ADD PRIMARY KEY (`id_certificate`);

--
-- Indexes for table `tb_education`
--
ALTER TABLE `tb_education`
  ADD PRIMARY KEY (`id_education`);

--
-- Indexes for table `tb_experience`
--
ALTER TABLE `tb_experience`
  ADD PRIMARY KEY (`id_experience`);

--
-- Indexes for table `tb_level`
--
ALTER TABLE `tb_level`
  ADD PRIMARY KEY (`id_level`);

--
-- Indexes for table `tb_project`
--
ALTER TABLE `tb_project`
  ADD PRIMARY KEY (`id_project`);

--
-- Indexes for table `tb_services`
--
ALTER TABLE `tb_services`
  ADD PRIMARY KEY (`id_services`);

--
-- Indexes for table `tb_skills`
--
ALTER TABLE `tb_skills`
  ADD PRIMARY KEY (`id_skills`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_about`
--
ALTER TABLE `tb_about`
  MODIFY `id_about` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id_admin` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tb_certificate`
--
ALTER TABLE `tb_certificate`
  MODIFY `id_certificate` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_education`
--
ALTER TABLE `tb_education`
  MODIFY `id_education` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_experience`
--
ALTER TABLE `tb_experience`
  MODIFY `id_experience` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_level`
--
ALTER TABLE `tb_level`
  MODIFY `id_level` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_project`
--
ALTER TABLE `tb_project`
  MODIFY `id_project` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_services`
--
ALTER TABLE `tb_services`
  MODIFY `id_services` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_skills`
--
ALTER TABLE `tb_skills`
  MODIFY `id_skills` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
