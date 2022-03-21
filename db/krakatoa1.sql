-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 16, 2022 at 04:41 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.3.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `krakatoa`
--

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `id_level` int(11) NOT NULL,
  `nama_level` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`id_level`, `nama_level`) VALUES
(1, 'admin'),
(2, 'kasir'),
(3, 'manajer');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id_menu` int(11) NOT NULL,
  `nama_menu` varchar(100) NOT NULL,
  `jenis` enum('makanan','minuman') NOT NULL,
  `harga` double NOT NULL,
  `status_masakan` enum('tersedia','habis') NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id_menu`, `nama_menu`, `jenis`, `harga`, `status_masakan`, `gambar`) VALUES
(1, 'Kopi Toraja', 'minuman', 40000, 'tersedia', '1647395732_510511ee8c4814849e0a.jpg'),
(3, 'Kopi Lampung', 'minuman', 40000, 'tersedia', '1647395785_3f00e68993eddb5ddaeb.jpeg'),
(15, 'Kopi Arabika Gayo Aceh', 'minuman', 40000, 'tersedia', '1647395369_c49e3ee10a893744d9e3.jpg'),
(16, 'Kopi Arabika Java Ijen Raung', 'minuman', 45000, 'tersedia', '1647395441_8f874ee2aa3c561f1b9d.jpeg'),
(17, 'Kopi Liberika Rangsang Meranti', 'minuman', 45000, 'tersedia', '1647395663_90fb76d7b59611003eed.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tb_detail_order`
--

CREATE TABLE `tb_detail_order` (
  `id_detail_order` int(11) NOT NULL,
  `id_order` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `status_detail_order` enum('proses','selesai') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_detail_order`
--

INSERT INTO `tb_detail_order` (`id_detail_order`, `id_order`, `id_menu`, `keterangan`, `status_detail_order`) VALUES
(3, 3, 1, '1 cangkir', 'selesai');

-- --------------------------------------------------------

--
-- Table structure for table `tb_order`
--

CREATE TABLE `tb_order` (
  `id_order` int(11) NOT NULL,
  `no_meja` int(11) NOT NULL,
  `tanggal` datetime NOT NULL,
  `id_user` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `status_order` enum('diorder','selesai') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_order`
--

INSERT INTO `tb_order` (`id_order`, `no_meja`, `tanggal`, `id_user`, `keterangan`, `status_order`) VALUES
(1, 1, '2022-02-09 09:34:32', 2, 'Pesanan 1', 'selesai'),
(2, 2, '2022-02-09 10:56:15', 2, 'pesanan 2', 'selesai'),
(3, 3, '2022-02-09 10:57:46', 2, 'pesanan 3', 'selesai'),
(4, 4, '2022-02-09 10:59:41', 2, 'pesanan 4', 'diorder');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_order` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `total_bayar` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_user`, `id_order`, `tanggal`, `total_bayar`) VALUES
(1, 2, 1, '2022-02-09', 100000),
(2, 2, 2, '2022-02-09', 50000),
(3, 2, 3, '2022-02-09', 50000);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(40) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `id_level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `nama`, `password`, `id_level`) VALUES
(1, 'admin', 'admin', '$2y$10$2W7LG7fnTkC7PDB/2c49TOr.nD04PzOySXCL1QmVXkr0DVygwjvu6', 1),
(2, 'kasir', 'kasir', '$2y$10$nWZ1BWletYe.KSP5v3M3o.Zi4K.I.gRitDt63fdBhZ0ap5pwvsig6', 2),
(3, 'manajer', 'Manajer', '$2y$10$KIzhwpe9Nw3p1mTA5xILj.Ghbkz.4ifzcBn33/rlF.oxK96WJJqrK', 3),
(4, 'test1234', 'test', '$2y$10$97X6iUxjUQwbh3ptplR9aO9PVzpcrnj./iVYq3/bRgeIN7DlfRJeu', 2),
(5, 'nyoba', 'nyoba', '$2y$10$VUPXW.Jkd7i1JUiZjHKQWu4lXrRRpDnEFPozCEBMVI0ArFKie/EfK', 2),
(8, 'bambang', 'bambang', '$2y$10$J.EXW3ahmN4MV6lWmEU5t.YYDfiR5yFV4YeLLyuYr7XTzeorUqK8y', 1),
(9, 'fahri rh', 'fahri rh', '$2y$10$g4UIFzXH8Jikp0wSh5eg7OkljcD6i69QsIk2wWUIq/f1grB2PHwLu', 2),
(10, 'vermilion', 'vermilion', '$2y$10$mlJrI7kSzcJhdvt/QGPn7uoESDz29GEjYbO.1bgAX.67SfClZzC2e', 2),
(11, 'jossi', 'jossi', '$2y$10$DkGTxa5yqR9EYkUjuFsDQu.sEJhnFRIqgxby3wRT5KvyaMNLsrhUC', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id_level`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `tb_detail_order`
--
ALTER TABLE `tb_detail_order`
  ADD PRIMARY KEY (`id_detail_order`),
  ADD KEY `id_order` (`id_order`),
  ADD KEY `id_masakan` (`id_menu`);

--
-- Indexes for table `tb_order`
--
ALTER TABLE `tb_order`
  ADD PRIMARY KEY (`id_order`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_order` (`id_order`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_level` (`id_level`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `id_level` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tb_detail_order`
--
ALTER TABLE `tb_detail_order`
  MODIFY `id_detail_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_order`
--
ALTER TABLE `tb_order`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_detail_order`
--
ALTER TABLE `tb_detail_order`
  ADD CONSTRAINT `tb_detail_order_ibfk_1` FOREIGN KEY (`id_order`) REFERENCES `tb_order` (`id_order`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_detail_order_ibfk_2` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`id_menu`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_order`
--
ALTER TABLE `tb_order`
  ADD CONSTRAINT `tb_order_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`id_order`) REFERENCES `tb_order` (`id_order`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_level`) REFERENCES `level` (`id_level`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
