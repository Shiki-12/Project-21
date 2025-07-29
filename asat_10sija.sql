-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2025 at 05:12 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `asat_10sija`
--

-- --------------------------------------------------------

--
-- Table structure for table `biodata`
--

CREATE TABLE `biodata` (
  `id` int(11) NOT NULL,
  `nama_depan` varchar(20) NOT NULL,
  `nama_belakang` varchar(30) NOT NULL,
  `tentang` varchar(100) NOT NULL,
  `profesi` varchar(100) NOT NULL,
  `deskripsi_profesi` varchar(150) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `website` varchar(100) NOT NULL,
  `gelar` varchar(30) NOT NULL,
  `hp` varchar(17) NOT NULL,
  `email` varchar(100) NOT NULL,
  `kota` varchar(100) NOT NULL,
  `freelance` tinyint(1) NOT NULL,
  `keterangan_about` varchar(255) NOT NULL,
  `keterangan_skill` varchar(100) NOT NULL,
  `skill` varchar(255) NOT NULL,
  `url_hero` varchar(255) NOT NULL,
  `url_foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `biodata`
--

INSERT INTO `biodata` (`id`, `nama_depan`, `nama_belakang`, `tentang`, `profesi`, `deskripsi_profesi`, `tgl_lahir`, `website`, `gelar`, `hp`, `email`, `kota`, `freelance`, `keterangan_about`, `keterangan_skill`, `skill`, `url_hero`, `url_foto`) VALUES
(0, 'Hotaru', 'Hoshi', 'Hunter of Stellaron', 'Stellaron Hunter', 'Hunting a stellaron from other Milky Ways, Universe and other Sekai', '2007-01-23', 'Hoyoverse.com', 'HS', '+991 857 1098 017', 'Firefly@Hoyoverse.com', 'Glamoth', 1, 'Im a mecha robot that can crush you and love you at the same time', 'Burn evil people, protect the Mc', 'Intelectual 99% Power 100% Communication 98% Empathy 99% Cuteness 999% mywife 10000000000%', 'uploads/hero/hero2_68537943aa396.jpeg', 'uploads/foto/foto1_68537943a9fc7.jpg'),
(1, 'Fatar', 'Gaza', 'aku seorang cracker', 'Cracker', 'cracker game denvo ngl ngl', '2009-01-23', 'kamii.com', 'Mythic', '0857 1098 0170', 'uknowndonp@gmail.com', 'Bogor', 1, 'nothing about me but you maybe can change it if you give me work ofc', 'skill mahal', 'php 100% HTML 1% CSS 90% rakit-bom 90% Javascript 60% Photoshop 80%', 'uploads/hero/shiina_mahiru_684c33c77a229.png', 'uploads/foto/shirakami_fubuki_thumb_684c33c779e15.png');

-- --------------------------------------------------------

--
-- Table structure for table `kontak`
--

CREATE TABLE `kontak` (
  `id` int(11) NOT NULL,
  `deskripsi_kontak` varchar(100) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `peta` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kontak`
--

INSERT INTO `kontak` (`id`, `deskripsi_kontak`, `alamat`, `peta`) VALUES
(0, 'The stellaron cant take any call right now : D', 'Glamoth', 'Glamoth'),
(1, 'you can meet me at japan', 'Fuchū, Tokyo', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d51858.42993355553!2d139.43661498741247!3d35.67326230960236!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6018e4fa6309d11f%3A0xfbafd0d9d1031566!2zRnVjaMWrLCBUb2t5bywgSmVwYW5n!5e0!3m2!1sid!2sid!4v1749879129767!5m2!1sid!2sid\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>');

-- --------------------------------------------------------

--
-- Table structure for table `pesan`
--

CREATE TABLE `pesan` (
  `id` int(11) NOT NULL,
  `nama_pengirim` varchar(100) NOT NULL,
  `email_pengirim` varchar(100) NOT NULL,
  `judul_pesan` varchar(255) NOT NULL,
  `pesan` text NOT NULL,
  `tgl_pesan` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pesan`
--

INSERT INTO `pesan` (`id`, `nama_pengirim`, `email_pengirim`, `judul_pesan`, `pesan`, `tgl_pesan`) VALUES
(2, 'Sagami Mutsumi', 'arlecchino@tevyat.com', 'Pesan <3', '>///<', '2025-06-14 19:41:07'),
(11, 'owo', 'kontol@gmail.com', 'ochinchin', '1cm hahahah', '2025-06-16 09:43:05'),
(12, 'Fatar Gaza ', 'uknowndonp@gmail.com', 'aku cinta webste ini love love love xixixi', 'salam perjuagan', '2025-06-16 09:44:57'),
(13, '', '', '', '', '2025-06-19 05:08:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `biodata`
--
ALTER TABLE `biodata`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kontak`
--
ALTER TABLE `kontak`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pesan`
--
ALTER TABLE `pesan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pesan`
--
ALTER TABLE `pesan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
