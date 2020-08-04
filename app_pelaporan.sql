-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 01, 2020 at 12:07 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `app_pelaporan`
--

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan`
--

CREATE TABLE `kegiatan` (
  `id_kegiatan` int(5) NOT NULL,
  `nama_kegiatan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kegiatan`
--

INSERT INTO `kegiatan` (`id_kegiatan`, `nama_kegiatan`) VALUES
(1, 'WAS COVID-19'),
(2, 'OTT'),
(3, 'INTELIJEN'),
(4, 'YUSTISI'),
(5, 'SOSIALISASI');

-- --------------------------------------------------------

--
-- Table structure for table `laporan`
--

CREATE TABLE `laporan` (
  `id_laporan` int(9) NOT NULL,
  `id_upp` int(5) NOT NULL,
  `id_kegiatan` int(5) NOT NULL,
  `waktu_tgl` date NOT NULL,
  `waktu_jam1` varchar(20) NOT NULL,
  `waktu_jam2` varchar(20) NOT NULL,
  `tempat` text NOT NULL,
  `peserta` text NOT NULL,
  `pelaksana` text NOT NULL,
  `uraian_kegiatan` text NOT NULL,
  `dokumentasi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `laporan`
--

INSERT INTO `laporan` (`id_laporan`, `id_upp`, `id_kegiatan`, `waktu_tgl`, `waktu_jam1`, `waktu_jam2`, `tempat`, `peserta`, `pelaksana`, `uraian_kegiatan`, `dokumentasi`) VALUES
(2, 1, 1, '2020-07-16', '10:45', '12:30', 'asda', 'asda', 'sdfsfs', 'sdfs', 'c167b44f5a66faaefc317e6905968e76.jpg'),
(4, 3, 1, '2020-07-16', '12:00', '14:00', 'adad', 'adad', 'adad', 'adad', '980709ca7d27b6be0e479fc126270ee7.jpg'),
(5, 2, 1, '2020-07-16', '12:30', '15:30', 'eterte', 'gdfg', 'sdfdsfsf', 'sfdsfssf', '47bf05705397817da1f47b5936e4949b.jpg'),
(6, 2, 3, '2020-07-16', '10:45', '10:45', 'rtyryr', 'fhffhfh', 'fhfhhf', 'fghfhfhf', '84aaf10f434fe38b945f5237f945aee1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `pengaduan`
--

CREATE TABLE `pengaduan` (
  `id_pengaduan` int(5) NOT NULL,
  `tgl_pengaduan` date NOT NULL,
  `id_upp` int(5) NOT NULL,
  `posko` int(3) NOT NULL,
  `sms` int(3) NOT NULL,
  `email` int(3) NOT NULL,
  `telp` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengaduan`
--

INSERT INTO `pengaduan` (`id_pengaduan`, `tgl_pengaduan`, `id_upp`, `posko`, `sms`, `email`, `telp`) VALUES
(1, '2020-07-16', 2, 1, 2, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id_setting` int(5) NOT NULL,
  `logo_surat` text NOT NULL,
  `nama_ketua` varchar(50) NOT NULL,
  `jabatan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id_setting`, `logo_surat`, `nama_ketua`, `jabatan`) VALUES
(1, '2ef47a51f78b8cfdc8c65c70245caffe.png', 'MUSA TAMPUBOLON, S.H, S.I.K, M.Si.', 'KOMISARIS BESAR POLISI NRP. 69080351');

-- --------------------------------------------------------

--
-- Table structure for table `upp`
--

CREATE TABLE `upp` (
  `id_upp` int(5) NOT NULL,
  `nama_upp` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `upp`
--

INSERT INTO `upp` (`id_upp`, `nama_upp`) VALUES
(1, 'Prov. Kepri'),
(2, 'Kota Batam'),
(3, 'Kota Tanjungpinang'),
(4, 'Kab. Karimun'),
(5, 'Kab. Bintan'),
(6, 'Kab. Lingga'),
(7, 'Kab. Natuna'),
(8, 'Kab. Kep. Anambas');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `nama_user` varchar(50) NOT NULL,
  `role_upp` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `nama_user`, `role_upp`) VALUES
('admin', '0192023a7bbd73250516f069df18b500', 'Prov. Kepri', 1),
('batamkab', '82f89d35e884474b08648e8ac57e22bc', 'Kab. Batam', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD PRIMARY KEY (`id_kegiatan`);

--
-- Indexes for table `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`id_laporan`);

--
-- Indexes for table `pengaduan`
--
ALTER TABLE `pengaduan`
  ADD PRIMARY KEY (`id_pengaduan`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id_setting`);

--
-- Indexes for table `upp`
--
ALTER TABLE `upp`
  ADD PRIMARY KEY (`id_upp`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kegiatan`
--
ALTER TABLE `kegiatan`
  MODIFY `id_kegiatan` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `laporan`
--
ALTER TABLE `laporan`
  MODIFY `id_laporan` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pengaduan`
--
ALTER TABLE `pengaduan`
  MODIFY `id_pengaduan` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id_setting` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `upp`
--
ALTER TABLE `upp`
  MODIFY `id_upp` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
