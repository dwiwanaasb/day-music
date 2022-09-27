-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2020 at 07:10 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `day-music`
--

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `id_cart` int(11) NOT NULL,
  `nama_produk` varchar(50) NOT NULL,
  `jumlah_beli` int(11) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_bayar` int(11) NOT NULL,
  `nama_user` varchar(50) NOT NULL,
  `metode_pembayaran` enum('OVO','GoPay','Transfer Bank','COD') NOT NULL,
  `tanggal` varchar(50) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `nominal_pembayaran` int(11) NOT NULL,
  `jumlah_kembalian` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(50) NOT NULL,
  `stok` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `gambar` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `stok`, `harga`, `gambar`) VALUES
(1, 'Gitar Yamaha APXii', 20, 1500000, 'yamaha-apx500ii.jpg'),
(2, 'Gitar Cort ad810', 20, 1100000, 'cort-ad810.jpg'),
(3, 'Gitar Yamaha F310', 20, 1000000, 'yamaha-f310.jpg'),
(4, 'Gitar Takaminer D Series', 20, 3200000, 'takamine-dseries.jpg'),
(5, 'Gitar Ibanez RG250', 20, 4000000, 'ibanez-rg250.jpg'),
(6, 'Gitar Yamaha Pasifica PAC112J', 20, 2100000, 'yamaha-pasifica-pac112j.jpg'),
(7, 'Bass Squier Bronco', 15, 3000000, 'squier-bronco-bass.jpg'),
(8, 'Bass Cort Action V Plus', 15, 2600000, 'cort-actionvplus.jpg'),
(9, 'Bass Ibanez Talman Series', 15, 3200000, 'ibanez-talman.jpg'),
(10, 'Drum Elektrik Yamaha DTX452', 5, 5500000, 'yamaha-dtx452.jpg'),
(11, 'Satu Set Pick Gitar', 10, 100000, 'satusetpick.jpg'),
(12, 'Keyboard Yamaha PSR-E363', 10, 3200000, 'yamaha-psrE363.jpg'),
(13, 'Kabel Jack 1 Meter', 10, 200000, 'jack1m.jpg'),
(14, 'Strap Gitar & Bass Ernie Ball', 20, 90000, 'strap-ernieball.jpg'),
(15, 'Senar Gitar D\'Addrio Bronze', 20, 20000, 'senardaddrio.jpg'),
(16, 'Gitar Ibanez AEG8E', 20, 2900000, 'ibanez-aeg8e.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `riwayatkeranjang`
--

CREATE TABLE `riwayatkeranjang` (
  `id_cart` int(11) NOT NULL,
  `nama_user` varchar(50) NOT NULL,
  `nama_produk` varchar(50) NOT NULL,
  `jumlah_beli` int(11) NOT NULL,
  `tanggal` varchar(25) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `jenis_kelamin` enum('Laki-Laki','Perempuan') NOT NULL,
  `no_telepon` varchar(50) NOT NULL,
  `alamat` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nama_lengkap`, `username`, `password`, `jenis_kelamin`, `no_telepon`, `alamat`) VALUES
(1, 'admin', 'admin', '$2y$10$kujaGmO8FECRUNhKENo7.Oe4Kz0TAnz/K2/MXA6E0CatnHPfAUJTG', 'Laki-Laki', '123', 'admin'),
(2, 'user', 'user', '$2y$10$rTpZ0bZ7E2bL4z6jIw2YHu4zgx6geuwxivEIlK5uh9WaffEv6SKG.', 'Laki-Laki', '123', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id_cart`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_bayar`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `riwayatkeranjang`
--
ALTER TABLE `riwayatkeranjang`
  ADD PRIMARY KEY (`id_cart`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id_cart` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_bayar` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `riwayatkeranjang`
--
ALTER TABLE `riwayatkeranjang`
  MODIFY `id_cart` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
