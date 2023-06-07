-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2023 at 01:43 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_barang`
--

CREATE TABLE `tbl_barang` (
  `id_barang` int(11) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `diskon` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_barang`
--

INSERT INTO `tbl_barang` (`id_barang`, `nama_barang`, `harga_beli`, `harga_jual`, `diskon`, `stok`, `id_kategori`) VALUES
(12, 'SHAMPO HEAD & SOULDER', 30000, 33000, 0, 94, 7),
(11, 'INDOMIE SOTO', 2000, 3500, 0, 93, 3),
(10, 'INDOMIE GORENG', 2500, 4000, 0, 93, 3),
(9, 'AQUA', 2000, 3000, 0, 95, 1),
(13, 'SHAMPO CLEAR', 26500, 28000, 10, 95, 7),
(20, 'Sunco Minyak Goreng Botol 5 L', 145500, 147400, 26, 95, 20),
(21, 'Fortune Minyak Goreng Sawit 2 L ', 50000, 54100, 26, 100, 20),
(22, 'ABC Susu 1 Bag (20 x 30 gr)', 29000, 30400, 0, 99, 1),
(23, 'KAPAL API Special Mix 1 Renteng (10 x 24 gr)', 13000, 14900, 0, 100, 1),
(24, 'NutriSari Anggur Hijau 40 Sachet - Minuman Buah Vitamin C Vitamin D', 60000, 62000, 22, 100, 1),
(25, 'NutriSari Jeruk Nipis Jahe 40 Sachet - Minuman Buah Vitamin C Vitamin D', 60000, 62000, 22, 100, 1),
(26, 'OREO BLACKPINK COOKIE MULTIPACK 6PCS, 171G [LIMITED EDITION]', 15000, 16500, 7, 98, 3),
(27, 'Lemonilo Mie Instant Sehat 70gr', 5000, 6400, 13, 100, 3),
(28, 'Bihunku Korean Taste', 17000, 18401, 73, 100, 3),
(29, 'hirataki Mix Rice 1Kg', 125000, 130000, 27, 48, 20);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kategori`
--

CREATE TABLE `tbl_kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_kategori`
--

INSERT INTO `tbl_kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Minuman'),
(3, 'Makanan'),
(6, 'Baju'),
(7, 'Kesehatan dan Kecantikan'),
(20, 'Kebutuhan Sehari-hari');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_keranjang`
--

CREATE TABLE `tbl_keranjang` (
  `id` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `username` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_penjualan`
--

CREATE TABLE `tbl_penjualan` (
  `no_penjualan` int(11) NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `status` int(11) NOT NULL,
  `username` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_penjualan`
--

INSERT INTO `tbl_penjualan` (`no_penjualan`, `tgl_transaksi`, `status`, `username`) VALUES
(74279, '2023-02-25', 2, 'Fachri'),
(74610, '2023-02-25', 2, 'user'),
(39243, '2023-02-25', 2, 'user'),
(85098, '2023-02-25', 2, 'Fachri'),
(14723, '2023-02-25', 1, 'user'),
(57459, '2023-02-26', 1, 'user'),
(27370, '2023-02-26', 2, 'user'),
(36050, '2023-02-26', 2, 'Fachri'),
(20170, '2023-02-26', 2, 'Fachri'),
(67113, '2023-02-27', 1, 'user'),
(16428, '2023-02-27', 2, 'user'),
(43394, '2023-03-04', 1, 'Fachri'),
(44007, '2023-03-04', 2, 'Fachri'),
(57313, '2023-03-04', 1, 'Fachri'),
(25015, '2023-03-16', 1, 'Fachri'),
(71798, '2023-03-16', 2, 'Fachri'),
(75026, '2023-03-16', 1, 'Fachri'),
(40606, '2023-03-22', 0, 'jeki'),
(31202, '2023-03-22', 0, 'jeki'),
(45388, '2023-03-22', 0, 'jeki'),
(97191, '2023-06-07', 2, 'Fachri');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_penjualan_item`
--

CREATE TABLE `tbl_penjualan_item` (
  `id` int(11) NOT NULL,
  `no_penjualan` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_penjualan_item`
--

INSERT INTO `tbl_penjualan_item` (`id`, `no_penjualan`, `id_barang`, `harga_jual`, `jumlah`) VALUES
(92, 74610, 12, 33000, 2),
(93, 39243, 13, 25200, 1),
(94, 85098, 9, 3000, 2),
(95, 14723, 11, 3500, 1),
(96, 14723, 10, 4000, 3),
(97, 57459, 11, 3500, 2),
(98, 27370, 12, 33000, 2),
(99, 36050, 10, 4000, 2),
(100, 20170, 9, 3000, 2),
(101, 67113, 11, 3500, 2),
(102, 16428, 9, 3000, 1),
(103, 43394, 13, 25200, 2),
(104, 44007, 13, 25200, 2),
(105, 57313, 11, 3500, 2),
(106, 25015, 10, 4000, 2),
(107, 25015, 26, 15345, 2),
(108, 25015, 22, 30400, 1),
(109, 71798, 29, 94900, 2),
(110, 75026, 20, 109076, 1),
(111, 40606, 20, 109076, 2),
(112, 31202, 20, 109076, 2),
(113, 45388, 41, 0, 2),
(114, 45388, 41, 0, 2),
(115, 97191, 12, 33000, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `level` enum('admin','kasir') NOT NULL DEFAULT 'kasir',
  `foto` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `username`, `password`, `nama_lengkap`, `level`, `foto`) VALUES
(15, 'admin', '$2y$10$Q.5DZuHG0fjRT4o6dq6.z.9mUkCf0bZ/dMo.CqnDGAxYs5QHVYGqy', 'Muhamad Fachri', 'admin', '1618042729482.jpg'),
(9, 'Fachri', '$2y$10$E.cFEW5Mc/rTwpPRCxxzG.ezpMEKJK6QNSeygzL2XHYYgTtLocWCq', 'Muhamad Fachri', 'kasir', '1616585769215.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_barang`
--
ALTER TABLE `tbl_barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `tbl_keranjang`
--
ALTER TABLE `tbl_keranjang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_penjualan`
--
ALTER TABLE `tbl_penjualan`
  ADD PRIMARY KEY (`no_penjualan`);

--
-- Indexes for table `tbl_penjualan_item`
--
ALTER TABLE `tbl_penjualan_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_barang`
--
ALTER TABLE `tbl_barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_keranjang`
--
ALTER TABLE `tbl_keranjang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=326;

--
-- AUTO_INCREMENT for table `tbl_penjualan`
--
ALTER TABLE `tbl_penjualan`
  MODIFY `no_penjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123469;

--
-- AUTO_INCREMENT for table `tbl_penjualan_item`
--
ALTER TABLE `tbl_penjualan_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
