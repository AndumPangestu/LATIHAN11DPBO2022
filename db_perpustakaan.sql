-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 09, 2022 at 05:38 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_perpustakaan`
--

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `id_author` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`id_author`, `nama`, `status`) VALUES
(1, 'Richard Adkins', 'Senior'),
(2, 'Pein Akatsuki', 'Senior'),
(4, 'Ken Northwood', 'Senior'),
(5, 'ad', 'Pendatang Baru');

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id_buku` int(11) NOT NULL,
  `judul_buku` varchar(100) NOT NULL,
  `penerbit` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `status` varchar(50) NOT NULL,
  `id_author` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id_buku`, `judul_buku`, `penerbit`, `deskripsi`, `status`, `id_author`) VALUES
(1, 'Alan Wade', 'Premium #', 'Cerita dibalik cerita', 'Best Seller', 2),
(2, 'Awan', 'Akamedia', 'buku tentang cerita awan, hujan, langit', 'Best Seller', 1),
(4, 'Puisi Patrick Star', 'Patrick', 'mawar itu biru, violet itu merah', 'Best Seller', 2);

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `nim` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jurusan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`nim`, `nama`, `jurusan`) VALUES
('111', 'Asep Saeful', 'Ilmu Komputer'),
('112', 'Jhon', 'Ilmu Komputer');

-- --------------------------------------------------------

--
-- Table structure for table `pinjam`
--

CREATE TABLE `pinjam` (
  `id` int(11) NOT NULL,
  `peminjam` varchar(100) NOT NULL,
  `buku` varchar(100) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pinjam`
--

INSERT INTO `pinjam` (`id`, `peminjam`, `buku`, `status`) VALUES
(2, '111', '1', 'Belum'),
(3, '112', '4', 'Sudah');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`id_author`);

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`),
  ADD KEY `id_author` (`id_author`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`nim`);

--
-- Indexes for table `pinjam`
--
ALTER TABLE `pinjam`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `author`
--
ALTER TABLE `author`
  MODIFY `id_author` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pinjam`
--
ALTER TABLE `pinjam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `buku`
--
ALTER TABLE `buku`
  ADD CONSTRAINT `buku_ibfk_1` FOREIGN KEY (`id_author`) REFERENCES `author` (`id_author`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
