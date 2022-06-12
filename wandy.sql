-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 12, 2022 at 07:21 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop`
--
CREATE DATABASE IF NOT EXISTS `shop` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `shop`;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `id_user`, `id_product`, `qty`, `subtotal`) VALUES
(59, 12, 16, 3, 1050000),
(60, 12, 15, 3, 600000),
(69, 13, 16, 2, 700000);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `slug`, `title`) VALUES
(4, 'meja', 'Meja'),
(5, 'kursi', 'Kursi');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `id_user` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `invoice` varchar(100) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `total_bayar` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `status` enum('waiting','paid','delivered','cancel') DEFAULT NULL,
  `provinsi` varchar(255) DEFAULT NULL,
  `kota` varchar(255) DEFAULT NULL,
  `kode_pos` varchar(25) DEFAULT NULL,
  `ekspedisi` varchar(255) DEFAULT NULL,
  `paket` varchar(255) DEFAULT NULL,
  `estimasi` varchar(255) DEFAULT NULL,
  `ongkir` int(11) DEFAULT NULL,
  `berat` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `id_user`, `date`, `invoice`, `total`, `total_bayar`, `name`, `address`, `phone`, `status`, `provinsi`, `kota`, `kode_pos`, `ekspedisi`, `paket`, `estimasi`, `ongkir`, `berat`) VALUES
(22, '11', '2022-05-19', '1120220519172423', 1400000, 1667000, 'Albigame', 'asasasas', '+6282198600660', 'waiting', 'Bali', 'Bangli', '12345', 'jne', 'OKE', '4-5 Hari', 267000, 12000),
(23, '11', '2022-05-19', '1120220519193139', 350000, 617000, 'alberki rumbiak', 'asasa', '082198600660', 'waiting', 'Bali', 'Badung', '98357', 'jne', 'OKE', '4-5 Hari', 267000, 3000),
(24, '11', '2022-05-24', '1120220524131735', 750000, 918000, 'Albigameasas', 'sasasas', '+6282198600660', 'paid', 'Papua Barat', 'Sorong Selatan', '12345', 'jne', 'OKE', '9-10 Hari', 168000, 4000),
(25, '11', '2022-05-26', '1120220526223732', 3850000, 4153000, 'Albigame', 'asasasas', '082198600660', 'paid', 'Bangka Belitung', 'Bangka', '12345', 'jne', 'OKE', '4-5 Hari', 303000, 33000),
(26, '11', '2022-05-27', '1120220527085025', 550000, 853000, 'Albigame', 'asasasas', '082198600660', 'paid', 'Bangka Belitung', 'Bangka', '12345', 'jne', 'OKE', '4-5 Hari', 303000, 2000),
(27, '11', '2022-05-30', '1120220530194949', 550000, 853000, 'Albigame', 'asasas', '082198600660', 'paid', 'Bangka Belitung', 'Bangka Barat', '12345', 'jne', 'OKE', '4-5 Hari', 303000, 2000);

-- --------------------------------------------------------

--
-- Table structure for table `orders_confirm`
--

CREATE TABLE `orders_confirm` (
  `id` int(11) NOT NULL,
  `id_orders` int(11) NOT NULL,
  `account_name` varchar(255) NOT NULL,
  `account_number` varchar(80) NOT NULL,
  `nominal` int(11) NOT NULL,
  `note` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders_confirm`
--

INSERT INTO `orders_confirm` (`id`, `id_orders`, `account_name`, `account_number`, `nominal`, `note`, `image`) VALUES
(6, 24, '223234234324324', '2121212', 2147483647, '-dfsgdfgdfghfd', '1120220524131735_20220524132002.jpg'),
(7, 25, '223234234324324', '234234324324', 2147483647, '-32434asdasdsadas', '1120220526223732_20220526224405.jpg'),
(8, 26, '223234234324324', '850000', 2147483647, '-lumayan', '1120220527085025_20220527091853.jpg'),
(9, 27, '2324343543456456', '24542524545', 2147483647, '-dfsdfdfdfs', '1120220530194949_20220530195212.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `orders_detail`
--

CREATE TABLE `orders_detail` (
  `id` int(11) NOT NULL,
  `id_orders` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `qty` int(10) NOT NULL,
  `subtotal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders_detail`
--

INSERT INTO `orders_detail` (`id`, `id_orders`, `id_product`, `qty`, `subtotal`) VALUES
(32, 19, 15, 6, 1200000),
(33, 20, 15, 1, 200000),
(34, 21, 15, 5, 1000000),
(35, 22, 16, 4, 1400000),
(36, 23, 16, 1, 350000),
(37, 24, 15, 2, 400000),
(38, 24, 16, 1, 350000),
(39, 25, 16, 11, 3850000),
(40, 26, 15, 1, 200000),
(41, 26, 16, 1, 350000),
(42, 27, 15, 1, 200000),
(43, 27, 16, 1, 350000);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `id_category` int(11) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `price` int(11) NOT NULL,
  `is_available` tinyint(1) NOT NULL DEFAULT 1,
  `image` varchar(255) NOT NULL,
  `weight` int(11) NOT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `id_category`, `slug`, `title`, `description`, `price`, `is_available`, `image`, `weight`, `stock`) VALUES
(15, 4, 'rak-bunga-baruh', 'Rak Bunga Baruh', 'asasasas', 200000, 1, 'rak_bunga_baruh_20220519134941.jpg', 2000, 20),
(16, 4, 'meja-serba-guna', 'Meja Serba Guna', 'ini meja serba guna bro', 350000, 1, 'meja_serba_guna_20220519172337.jpg', 3000, 15);

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id` int(11) NOT NULL,
  `nama_toko` varchar(244) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `lokasi` int(11) DEFAULT NULL,
  `no_hp` varchar(233) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `nama_toko`, `alamat`, `lokasi`, `no_hp`) VALUES
(1, 'WandyShop', 'Amban Permai', 272, '+6282198600660');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','member') NOT NULL,
  `image` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `role`, `image`, `is_active`) VALUES
(11, 'alberki rumbiak', 'albigame05@gmail.com', '$2y$10$jKbjjCO8U79HXCYHDlMW5.9BkyyFN0NNrdoYd4snJ.WscPUL7ooKy', 'admin', '', 1),
(12, 'Fenny Paisey', 'fenny55@gmail.com', '$2y$10$apnYw7vLBxBVlhPqs76W3uZZPl.9lgeZAJrHxWmq.lYpEZSneHxVO', 'admin', '', 1),
(13, 'mihel', 'mihel55@gmail.com', '$2y$10$6MDOlMXy3E/a6WWHPFoAOeKHBN3a5VHZMWK8Q2KFFgqsDD7vzrtQa', 'admin', '', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders_confirm`
--
ALTER TABLE `orders_confirm`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders_detail`
--
ALTER TABLE `orders_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `orders_confirm`
--
ALTER TABLE `orders_confirm`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `orders_detail`
--
ALTER TABLE `orders_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
