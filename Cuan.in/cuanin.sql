-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 10, 2023 at 03:29 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cuanin`
--

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

CREATE TABLE `akun` (
  `user_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`user_id`, `username`, `email`, `password`) VALUES
(1, 'admin', 'admin@jualin.com', '$2y$10$k56sEVH9Y9TWnuMDq2.ruOVsuX2Frfd7P7OCGemGXR1/vomrTAj0.'),
(2, 'temenadmin', 'temenadmin@jualin.com', '$2y$10$IBPZY6xksDesU7VBTaHAX.fu7EdV1/eMW/0Fmp.eVW7mWceNlfkyW'),
(3, '123', '123@gmail.com', '$2y$10$WpolNoc332aHM7RDWPMn4eoYJjCWCMROty8B5Av/xDOc84CnvaAKW'),
(4, 'admin123', 'admin123@jualin.com', '$2y$10$6B5adCuN7l90F4coqhTCuuvJfVnzUIRANwmkjx2GotVAa0aJVL.r6'),
(6, 'hafis', 'hafis@gmail.com', '$2y$10$k4SmRaaPRk8ktYi9pM/zPOe7ZlhwqtKH2OOCdfHihXFP4c9lMUVhy'),
(7, 'shera', 'sheraalice06@gmail.com', '$2y$10$nFmIELSLFPkbqTrpyS/sbOVK/31jdNavArlW.Y6STmfqWm3rLJHi6');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `buyer_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `picture` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `id_penjual` int(11) NOT NULL,
  `kategori` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `harga` int(10) NOT NULL,
  `gambar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_order`
--

CREATE TABLE `riwayat_order` (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `buyer_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` varchar(100) NOT NULL,
  `picture` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `hour` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `riwayat_order`
--

INSERT INTO `riwayat_order` (`order_id`, `product_id`, `seller_id`, `buyer_id`, `name`, `price`, `picture`, `date`, `hour`) VALUES
(1, 4, 2, 1, 'tes lagi', '55000', '61c5b6e37ff65.jpeg', '30-12-2021', '01:04'),
(2, 1, 1, 1, 'Lukisan Vincent Van Gogh KW', '500000', 'The Starry Night - Vincent van Gogh.png', '30-12-2021', '01:04'),
(3, 2, 2, 1, 'Lukisan Leonardo Da Vinci KW', '700000', '1200px-Mona_Lisa,_by_Leonardo_da_Vinci,_from_C2RMF_retouched.jpg', '31-12-2021', '12:44'),
(4, 4, 2, 6, 'Hmm tes', '320000', '61ce989b97c71.jpg', '10-07-2023', '20:14'),
(5, 3, 1, 6, 'Tes TES tes ini bukan BUKU, hanya tes saja', '60000', '61c5210c2085f.png', '10-07-2023', '20:16'),
(6, 5, 6, 7, 'Sandal', '15000', '64ac0580eb37a.png', '10-07-2023', '20:23');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `wishlist_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `buyer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `riwayat_order`
--
ALTER TABLE `riwayat_order`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`wishlist_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akun`
--
ALTER TABLE `akun`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `riwayat_order`
--
ALTER TABLE `riwayat_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `wishlist_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
