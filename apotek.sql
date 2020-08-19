-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 01, 2020 at 09:10 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apotek`
--

-- --------------------------------------------------------

--
-- Table structure for table `golongan_obat`
--

CREATE TABLE `golongan_obat` (
  `id_golongan` int(255) NOT NULL,
  `golongan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `golongan_obat`
--

INSERT INTO `golongan_obat` (`id_golongan`, `golongan`) VALUES
(1, 'Suplemen'),
(2, 'Bebas'),
(3, 'Bebas Terbatas'),
(4, 'Keras'),
(5, 'Psikotropika'),
(6, 'Narkotika'),
(8, 'stGolongan');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `id_pembelian` varchar(255) NOT NULL,
  `tanggal_pembelian` datetime NOT NULL,
  `id_supplier` int(255) NOT NULL,
  `user_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`id_pembelian`, `tanggal_pembelian`, `id_supplier`, `user_id`) VALUES
('200716542111', '2020-07-15 16:54:13', 1, 1),
('200731084612', '2020-07-31 08:46:23', 1, 1),
('201707060722', '2020-08-08 00:08:00', 1, 1),
('201707060736', '2020-07-17 00:07:00', 1, 1),
('201707060743', '2020-07-18 00:07:00', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pembelian_produk`
--

CREATE TABLE `pembelian_produk` (
  `id_pembelian_produk` int(255) NOT NULL,
  `id_pembelian` varchar(255) NOT NULL,
  `id_produk` int(255) NOT NULL,
  `pembelian` int(11) NOT NULL,
  `expire_date` date NOT NULL,
  `no_batch` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembelian_produk`
--

INSERT INTO `pembelian_produk` (`id_pembelian_produk`, `id_pembelian`, `id_produk`, `pembelian`, `expire_date`, `no_batch`) VALUES
(1, '200716542111', 1, 20, '2021-01-01', '523523456435'),
(2, '200716542111', 2, 10, '2020-11-14', 'fdqwedfasc'),
(3, '200731084612', 1, 20, '2020-07-31', 'fwesrdwqed'),
(4, '200731084612', 2, 50, '2020-09-17', 'dsdqw3e'),
(5, '201707060722', 1, 50, '2020-08-08', '24141234'),
(6, '201707060722', 2, 50, '2020-08-08', '3245234'),
(7, '201707060736', 2, 23, '2020-09-16', 'eqwdqw'),
(8, '201707060736', 1, 30, '2020-07-31', 'dsadas'),
(9, '201707060743', 2, 11, '2020-08-08', 'dqwdqws'),
(10, '201707060743', 2, 54, '2020-10-01', 'dqwdqw'),
(11, '200716542111', 2, 20, '2020-10-08', 'r3rqwerqwe');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `id_penjualan` varchar(255) NOT NULL,
  `tanggal_penjualan` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `diskon` varchar(255) NOT NULL DEFAULT '0',
  `tipe_diskon` varchar(255) DEFAULT NULL,
  `user_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`id_penjualan`, `tanggal_penjualan`, `diskon`, `tipe_diskon`, `user_id`) VALUES
('2007151253', '2020-07-20 03:01:25', '0', NULL, 1),
('201807070731', '2020-07-08 03:01:39', '0', NULL, 1),
('201807070737', '2020-07-08 03:01:39', '0', NULL, 1),
('202007090712', '2020-07-20 03:01:39', '0', NULL, 1),
('202007090719', '2020-07-20 03:01:39', '0', NULL, 1),
('202007100758', '2020-08-01 03:07:58', '20', 'persen', 1);

-- --------------------------------------------------------

--
-- Table structure for table `penjualan_produk`
--

CREATE TABLE `penjualan_produk` (
  `id_penjualan_produk` int(255) NOT NULL,
  `id_penjualan` varchar(255) NOT NULL,
  `id_produk` int(255) NOT NULL,
  `penjualan` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penjualan_produk`
--

INSERT INTO `penjualan_produk` (`id_penjualan_produk`, `id_penjualan`, `id_produk`, `penjualan`) VALUES
(1, '2007151253', 1, 5),
(2, '2007151253', 2, 10),
(3, '201807070737', 1, 21),
(4, '201807070731', 1, 4),
(5, '202007090712', 2, 8),
(6, '202007090712', 1, 10),
(7, '202007090719', 1, 10),
(8, '202007090719', 2, 10),
(9, '202007100758', 2, 20),
(10, '202007100758', 1, 20);

-- --------------------------------------------------------

--
-- Table structure for table `perusahaan`
--

CREATE TABLE `perusahaan` (
  `id_perusahaan` int(255) NOT NULL,
  `nama_perusahaan` varchar(255) NOT NULL,
  `alamat_perusahaan` text NOT NULL,
  `telp_perusahaan` varchar(255) NOT NULL,
  `kota_perusahaan` varchar(255) NOT NULL,
  `penanggung_jawab` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `perusahaan`
--

INSERT INTO `perusahaan` (`id_perusahaan`, `nama_perusahaan`, `alamat_perusahaan`, `telp_perusahaan`, `kota_perusahaan`, `penanggung_jawab`) VALUES
(1, 'Apotek Mitra Waluya', 'Jl. Cililin RT 02/08, Desa Cililin, Padalarang', '+62 895-3433-55224', 'Bandung Barat', 'Novi');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(255) NOT NULL,
  `id_golongan` int(255) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `harga_beli` varchar(255) NOT NULL,
  `harga_jual` varchar(255) NOT NULL,
  `id_satuan` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `id_golongan`, `nama_produk`, `harga_beli`, `harga_jual`, `id_satuan`) VALUES
(1, 1, 'Vitacimin', '2000', '5000', 3),
(2, 3, 'Meropamin', '3000', '7000', 2);

-- --------------------------------------------------------

--
-- Table structure for table `satuan_obat`
--

CREATE TABLE `satuan_obat` (
  `id_satuan` int(255) NOT NULL,
  `satuan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `satuan_obat`
--

INSERT INTO `satuan_obat` (`id_satuan`, `satuan`) VALUES
(1, 'Tablet'),
(2, 'Box'),
(3, 'Strip'),
(4, 'Blister'),
(5, 'Sirup'),
(6, 'Botol'),
(7, 'Drops'),
(8, 'Suppo'),
(9, 'Ovula');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` int(255) NOT NULL,
  `nama_supplier` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `phone` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `nama_supplier`, `alamat`, `phone`) VALUES
(1, 'PT. Contoh', 'Jl. Apa saja yang penting oke', '65412313215');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `nama_user` varchar(255) NOT NULL,
  `phone_user` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `nama_user`, `phone_user`, `password`, `last_login`) VALUES
(1, 'superadmin', 'Super Admin', '089618316760', '$2y$10$RT8abrGRksKtF85gndYUhuiZ3uYNX6a9ZWryIC9VL7csfOEK0R4xK', '2020-08-01 05:55:12'),
(2, 'dasdsa', 'dasdas', '32432', '$2y$10$Ih0e0gEXd4hyfPBxNXh.YesssKrXN2UAFVjgMKOujqC0Q26aFW3p2', '2020-07-14 14:44:34'),
(3, 'coba', 'Coba aja', '434', '$2y$10$.nCdvpgcHD.lAtrmb8OzkeP8vNZevHWkakQm3fS/yOpufFzby55Uy', '2020-07-14 14:45:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `golongan_obat`
--
ALTER TABLE `golongan_obat`
  ADD PRIMARY KEY (`id_golongan`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id_pembelian`),
  ADD KEY `id_supplier` (`id_supplier`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `pembelian_produk`
--
ALTER TABLE `pembelian_produk`
  ADD PRIMARY KEY (`id_pembelian_produk`),
  ADD KEY `id_pembelian` (`id_pembelian`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id_penjualan`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `penjualan_produk`
--
ALTER TABLE `penjualan_produk`
  ADD PRIMARY KEY (`id_penjualan_produk`),
  ADD KEY `id_penjualan` (`id_penjualan`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indexes for table `perusahaan`
--
ALTER TABLE `perusahaan`
  ADD PRIMARY KEY (`id_perusahaan`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD KEY `id_satuan` (`id_satuan`),
  ADD KEY `id_golongan` (`id_golongan`);

--
-- Indexes for table `satuan_obat`
--
ALTER TABLE `satuan_obat`
  ADD PRIMARY KEY (`id_satuan`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `phone_user` (`phone_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `golongan_obat`
--
ALTER TABLE `golongan_obat`
  MODIFY `id_golongan` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pembelian_produk`
--
ALTER TABLE `pembelian_produk`
  MODIFY `id_pembelian_produk` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `penjualan_produk`
--
ALTER TABLE `penjualan_produk`
  MODIFY `id_penjualan_produk` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `perusahaan`
--
ALTER TABLE `perusahaan`
  MODIFY `id_perusahaan` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `satuan_obat`
--
ALTER TABLE `satuan_obat`
  MODIFY `id_satuan` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id_supplier` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD CONSTRAINT `pembelian_ibfk_1` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id_supplier`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `pembelian_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON UPDATE NO ACTION;

--
-- Constraints for table `pembelian_produk`
--
ALTER TABLE `pembelian_produk`
  ADD CONSTRAINT `pembelian_produk_ibfk_1` FOREIGN KEY (`id_pembelian`) REFERENCES `pembelian` (`id_pembelian`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `pembelian_produk_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON UPDATE NO ACTION;

--
-- Constraints for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD CONSTRAINT `penjualan_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON UPDATE NO ACTION;

--
-- Constraints for table `penjualan_produk`
--
ALTER TABLE `penjualan_produk`
  ADD CONSTRAINT `penjualan_produk_ibfk_1` FOREIGN KEY (`id_penjualan`) REFERENCES `penjualan` (`id_penjualan`) ON UPDATE NO ACTION;

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`id_satuan`) REFERENCES `satuan_obat` (`id_satuan`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `produk_ibfk_2` FOREIGN KEY (`id_golongan`) REFERENCES `golongan_obat` (`id_golongan`) ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
