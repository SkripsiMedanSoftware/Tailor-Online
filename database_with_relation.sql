-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 11, 2020 at 04:08 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.3.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skripsi_tailor_online`
--

-- --------------------------------------------------------

--
-- Table structure for table `bahan_baju`
--

CREATE TABLE `bahan_baju` (
  `id` int(4) NOT NULL,
  `jenis` varchar(10) NOT NULL,
  `warna` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `chat_message`
--

CREATE TABLE `chat_message` (
  `id` int(8) NOT NULL,
  `chat_room` int(4) NOT NULL,
  `by` enum('admin','customer') NOT NULL,
  `text` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `chat_room`
--

CREATE TABLE `chat_room` (
  `id` int(11) NOT NULL,
  `customer` int(4) NOT NULL,
  `admin` int(4) NOT NULL,
  `customer_name` varchar(20) DEFAULT NULL,
  `customer_email` varchar(20) DEFAULT NULL,
  `status` enum('selesai','berlangsung') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `desain_pesanan`
--

CREATE TABLE `desain_pesanan` (
  `id` int(8) NOT NULL,
  `pesanan` int(4) NOT NULL,
  `foto` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `detail_pesanan`
--

CREATE TABLE `detail_pesanan` (
  `id` int(8) NOT NULL,
  `pesanan` int(4) NOT NULL,
  `bahan` int(4) NOT NULL,
  `ukuran` int(1) NOT NULL,
  `jumlah` int(6) NOT NULL,
  `subtotal` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `foto_katalog`
--

CREATE TABLE `foto_katalog` (
  `id` int(11) NOT NULL,
  `id_katalog` int(4) NOT NULL,
  `foto` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `harga_per_ukuran`
--

CREATE TABLE `harga_per_ukuran` (
  `id` int(4) NOT NULL,
  `bahan` int(4) NOT NULL,
  `ukuran` int(1) NOT NULL,
  `harga` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `katalog_produk`
--

CREATE TABLE `katalog_produk` (
  `id` int(4) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `deskripsi` tinytext DEFAULT NULL,
  `tanggal_pemesanan` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `status` enum('publish','draft') NOT NULL DEFAULT 'publish'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id` int(4) NOT NULL,
  `role` enum('admin','customer') NOT NULL,
  `email` varchar(120) DEFAULT NULL,
  `seluler` varchar(15) DEFAULT NULL,
  `username` varchar(16) DEFAULT NULL,
  `password` varchar(40) NOT NULL,
  `nama_lengkap` varchar(80) NOT NULL,
  `foto` varchar(60) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `status` enum('aktif','non-aktif','blokir') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id`, `role`, `email`, `seluler`, `username`, `password`, `nama_lengkap`, `foto`, `alamat`, `status`) VALUES
(1, 'admin', 'admin@tailor-online.com', '082167368585', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrator', NULL, NULL, 'aktif'),
(2, 'customer', 'customer@tailor-online.com', '082167368586', 'customer', '91ec1f9324753048c0096d036a694f86', 'Customer', NULL, NULL, 'aktif');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id` int(4) NOT NULL,
  `uid` varchar(6) NOT NULL,
  `id_customer` int(4) NOT NULL,
  `tanggal_pemesanan` datetime NOT NULL,
  `catatan` text DEFAULT NULL,
  `estimasi_pengerjaan` int(3) DEFAULT NULL,
  `harga` double DEFAULT NULL,
  `status` enum('dibatalkan','menunggu-konfirmasi','diterima','ditolak','dalam-proses','selesai') NOT NULL,
  `status_pembayaran` varchar(12) DEFAULT NULL,
  `metode_pembayaran` enum('midtrans','cod') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ukuran_baju`
--

CREATE TABLE `ukuran_baju` (
  `id` int(1) NOT NULL,
  `nama` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `web_slider`
--

CREATE TABLE `web_slider` (
  `id` int(2) NOT NULL,
  `judul` varchar(20) DEFAULT NULL,
  `konten` text DEFAULT NULL,
  `tombol_teks` varchar(10) DEFAULT NULL,
  `tombol_link` varchar(80) DEFAULT NULL,
  `image` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bahan_baju`
--
ALTER TABLE `bahan_baju`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat_message`
--
ALTER TABLE `chat_message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chat_room` (`chat_room`);

--
-- Indexes for table `chat_room`
--
ALTER TABLE `chat_room`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer` (`customer`),
  ADD KEY `admin` (`admin`);

--
-- Indexes for table `desain_pesanan`
--
ALTER TABLE `desain_pesanan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pesanan` (`pesanan`);

--
-- Indexes for table `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pesanan` (`pesanan`),
  ADD KEY `bahan` (`bahan`),
  ADD KEY `ukuran` (`ukuran`);

--
-- Indexes for table `foto_katalog`
--
ALTER TABLE `foto_katalog`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_katalog` (`id_katalog`);

--
-- Indexes for table `harga_per_ukuran`
--
ALTER TABLE `harga_per_ukuran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bahan` (`bahan`),
  ADD KEY `ukuran` (`ukuran`);

--
-- Indexes for table `katalog_produk`
--
ALTER TABLE `katalog_produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uid` (`uid`),
  ADD KEY `id_customer` (`id_customer`);

--
-- Indexes for table `ukuran_baju`
--
ALTER TABLE `ukuran_baju`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `web_slider`
--
ALTER TABLE `web_slider`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bahan_baju`
--
ALTER TABLE `bahan_baju`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chat_message`
--
ALTER TABLE `chat_message`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chat_room`
--
ALTER TABLE `chat_room`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `desain_pesanan`
--
ALTER TABLE `desain_pesanan`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `foto_katalog`
--
ALTER TABLE `foto_katalog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `harga_per_ukuran`
--
ALTER TABLE `harga_per_ukuran`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `katalog_produk`
--
ALTER TABLE `katalog_produk`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ukuran_baju`
--
ALTER TABLE `ukuran_baju`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `web_slider`
--
ALTER TABLE `web_slider`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chat_message`
--
ALTER TABLE `chat_message`
  ADD CONSTRAINT `chat_message_ibfk_1` FOREIGN KEY (`chat_room`) REFERENCES `chat_room` (`id`);

--
-- Constraints for table `chat_room`
--
ALTER TABLE `chat_room`
  ADD CONSTRAINT `chat_room_ibfk_1` FOREIGN KEY (`customer`) REFERENCES `pengguna` (`id`),
  ADD CONSTRAINT `chat_room_ibfk_2` FOREIGN KEY (`admin`) REFERENCES `pengguna` (`id`);

--
-- Constraints for table `desain_pesanan`
--
ALTER TABLE `desain_pesanan`
  ADD CONSTRAINT `desain_pesanan_ibfk_1` FOREIGN KEY (`pesanan`) REFERENCES `pesanan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  ADD CONSTRAINT `detail_pesanan_ibfk_1` FOREIGN KEY (`pesanan`) REFERENCES `pesanan` (`id`),
  ADD CONSTRAINT `detail_pesanan_ibfk_2` FOREIGN KEY (`bahan`) REFERENCES `bahan_baju` (`id`),
  ADD CONSTRAINT `detail_pesanan_ibfk_3` FOREIGN KEY (`ukuran`) REFERENCES `ukuran_baju` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `foto_katalog`
--
ALTER TABLE `foto_katalog`
  ADD CONSTRAINT `foto_katalog_ibfk_1` FOREIGN KEY (`id_katalog`) REFERENCES `katalog_produk` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `harga_per_ukuran`
--
ALTER TABLE `harga_per_ukuran`
  ADD CONSTRAINT `harga_per_ukuran_ibfk_1` FOREIGN KEY (`ukuran`) REFERENCES `ukuran_baju` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `harga_per_ukuran_ibfk_2` FOREIGN KEY (`bahan`) REFERENCES `bahan_baju` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `pesanan_ibfk_1` FOREIGN KEY (`id_customer`) REFERENCES `pengguna` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;