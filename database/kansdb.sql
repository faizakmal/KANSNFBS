-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 07, 2018 at 05:03 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kansdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `datadiri_alumni`
--

CREATE TABLE `datadiri_alumni` (
  `email` varchar(30) CHARACTER SET utf8 NOT NULL,
  `nama` varchar(50) NOT NULL,
  `image` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `noHP` varchar(12) NOT NULL,
  `angkatan` varchar(2) NOT NULL,
  `lulusan` varchar(10) NOT NULL,
  `pekerjaan` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `datadiri_alumni`
--

INSERT INTO `datadiri_alumni` (`email`, `nama`, `image`, `alamat`, `noHP`, `angkatan`, `lulusan`, `pekerjaan`) VALUES
('husni@gmail.com', 'Husni Mubarok Al Ghifari', 'silueta.png', 'Gg. Makam D 14, Keputih, Surabaya City, East Java, Indonesia', '082298664546', '10', 'SMP-SMA', 'Mahasisa'),
('r@gmail.com', 'Tayo Si Tayo', 'r@gmail.com.png', 'Wisma Permai Regency, Krajan Kulon, Waru, Sidoarjo Regency, East Java, Indonesia', '081222111111', '9', 'SMP-SMA', 'Mahasiswa');

-- --------------------------------------------------------

--
-- Table structure for table `mediasosial_alumni`
--

CREATE TABLE `mediasosial_alumni` (
  `email` varchar(30) CHARACTER SET utf8 NOT NULL,
  `facebook` varchar(50) NOT NULL,
  `twitter` varchar(50) NOT NULL,
  `lineid` varchar(50) NOT NULL,
  `instagram` varchar(50) NOT NULL,
  `whatsapp` varchar(50) NOT NULL,
  `linkedin` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mediasosial_alumni`
--

INSERT INTO `mediasosial_alumni` (`email`, `facebook`, `twitter`, `lineid`, `instagram`, `whatsapp`, `linkedin`) VALUES
('husni@gmail.com', '', '', '', '', '', ''),
('r@gmail.com', 'fasfaf', '@opowqpeq', 'asdsadasdasd', '@asdasda', '081222111111', 'Poasda sasdada');

-- --------------------------------------------------------

--
-- Table structure for table `pekerjaan_alumni`
--

CREATE TABLE `pekerjaan_alumni` (
  `email` varchar(30) CHARACTER SET utf8 NOT NULL,
  `namaPerusahaan` varchar(30) NOT NULL,
  `jenisPerusahaan` varchar(20) NOT NULL,
  `divisiPerusahaan` varchar(50) NOT NULL,
  `tahunBekerja` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pekerjaan_alumni`
--

INSERT INTO `pekerjaan_alumni` (`email`, `namaPerusahaan`, `jenisPerusahaan`, `divisiPerusahaan`, `tahunBekerja`) VALUES
('husni@gmail.com', 'WISMA DOLLY', 'Bisnis', '', 0),
('r@gmail.com', 'TOYOTA', 'Pemerintahan', 'Admin', 3);

-- --------------------------------------------------------

--
-- Table structure for table `pendidikan_alumni`
--

CREATE TABLE `pendidikan_alumni` (
  `email` varchar(30) CHARACTER SET utf8 NOT NULL,
  `strata` varchar(20) NOT NULL,
  `universitas` varchar(50) NOT NULL,
  `fakultas` varchar(30) NOT NULL,
  `jurusan` varchar(30) NOT NULL,
  `tahunMasuk` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pendidikan_alumni`
--

INSERT INTO `pendidikan_alumni` (`email`, `strata`, `universitas`, `fakultas`, `jurusan`, `tahunMasuk`) VALUES
('husni@gmail.com', '', 'ITS', 'FTE', 'TEKNIK KOMPUTER', 2014),
('r@gmail.com', 'S1', 'UNAIR', 'Ilmu Komputer', 'Kedokteran Gigi', 2013);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `email` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `name` varchar(40) NOT NULL,
  `angkatan` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`email`, `password`, `name`, `angkatan`) VALUES
('admin@admin.com', '698d51a19d8a121ce581499d7b701668', 'admin', '613'),
('husni@gmail.com', '202cb962ac59075b964b07152d234b70', 'Husni', '10'),
('r@gmail.com', '698d51a19d8a121ce581499d7b701668', 'Tayo', '9');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `datadiri_alumni`
--
ALTER TABLE `datadiri_alumni`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `mediasosial_alumni`
--
ALTER TABLE `mediasosial_alumni`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pekerjaan_alumni`
--
ALTER TABLE `pekerjaan_alumni`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pendidikan_alumni`
--
ALTER TABLE `pendidikan_alumni`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`email`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `datadiri_alumni`
--
ALTER TABLE `datadiri_alumni`
  ADD CONSTRAINT `datadiri_alumni_ibfk_1` FOREIGN KEY (`email`) REFERENCES `user` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mediasosial_alumni`
--
ALTER TABLE `mediasosial_alumni`
  ADD CONSTRAINT `mediasosial_alumni_ibfk_1` FOREIGN KEY (`email`) REFERENCES `user` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pekerjaan_alumni`
--
ALTER TABLE `pekerjaan_alumni`
  ADD CONSTRAINT `pekerjaan_alumni_ibfk_1` FOREIGN KEY (`email`) REFERENCES `user` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pendidikan_alumni`
--
ALTER TABLE `pendidikan_alumni`
  ADD CONSTRAINT `pendidikan_alumni_ibfk_1` FOREIGN KEY (`email`) REFERENCES `user` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
