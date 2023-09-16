-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 07, 2023 at 07:17 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cart-system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `email`, `password`) VALUES
(26, 'Aasath', 'aasathking35@gmail.com', '202cb962ac59075b964b07152d234b70'),
(29, 'Admin', 'admin@gmail.com', '23b58def11b45727d3351702515f86af');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_price` varchar(50) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `qty` int(10) NOT NULL,
  `total_price` varchar(100) NOT NULL,
  `product_code` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `product_name`, `product_price`, `product_image`, `qty`, `total_price`, `product_code`) VALUES
(162, 'Schezwan Fried Rice', '870', 'img/Schezwan Fried Rice.jpg', 5, '4350', 'p1029');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_title` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_title`) VALUES
(1, 'Beaverage'),
(6, 'Burgers'),
(7, 'Submarine'),
(9, 'Hot Drumlets'),
(10, 'Rice'),
(12, 'Ice-cream');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `g_id` int(11) NOT NULL,
  `g_name` varchar(150) NOT NULL,
  `g_description` varchar(100) NOT NULL,
  `g_image` varchar(150) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`g_id`, `g_name`, `g_description`, `g_image`, `date`) VALUES
(10, 'SANDWITCH', 'Its tasty and Chick flavor....', 'img/sandwich.jpg', '2023-03-16 05:01:58'),
(12, 'Cub cake', 'its Sweat', 'img/gallary_3.jpg', '2023-03-16 10:07:40');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `pmode` varchar(50) NOT NULL,
  `products` varchar(255) NOT NULL,
  `amount_paid` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(150) NOT NULL,
  `uid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `name`, `email`, `phone`, `address`, `pmode`, `products`, `amount_paid`, `date`, `status`, `uid`) VALUES
(32, 'Aasath ', 'ak99@gmail.com', '0754834050', 'sainthamaruthu', 'cod', 'Double ducker Burger(2), Veggie Burger(2), Zinger Burger(3), Mango nector -200ml(1)', '6105', '2023-05-07 14:51:03', 'in process', 0);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` varchar(100) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_code` varchar(50) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_keywords` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `product_name`, `product_price`, `product_image`, `product_code`, `category_id`, `product_keywords`) VALUES
(15, 'Double ducker Burger', '900', 'img/double decker Burger.png', 'p1000', 6, 'Burger'),
(16, 'Veggie Burger', '700', 'img/veggie Burger.png', 'p1001', 6, 'veggie Burger'),
(18, 'Zinger Burger', '915', 'img/zinger Burger.png', 'p1003', 6, 'Burger'),
(21, 'Mango nector -200ml', '160', 'img/mango nector 200ml.png', 'p1005', 1, 'Mango nector'),
(22, 'Mineral water 500ml', '90', 'img/mineral water 500ml.png', 'p1006', 1, 'Mineral water '),
(23, '7up 500ml', '200', 'img/7up 500ml.png', 'p1007', 1, '7up '),
(24, 'Pepsi 500ml', '200', 'img/pepsi 500ml.png', 'p1008', 1, 'Pepsi'),
(25, 'Double decker combo', '1900', 'img/double decker combo.png', 'p1009', 11, 'combo'),
(26, 'Zinger Burger Combo', '1520', 'img/zinger Burger Combo.png', 'p1010', 11, 'Combo'),
(27, 'Twister Combo', '1520', 'img/Twister combo.png', 'p1011', 11, ' Combo'),
(29, 'Hot Drumblets 3pcs', '490', 'img/hot drumlets 3pcs.png', 'p1013', 9, 'Hot Drumblets'),
(30, 'Hot Drumblets 6pcs', '1090', 'img/hot drumlets 6pcs.png', 'p1014', 9, 'Hot Drumblets'),
(31, 'Hot Drumblets 20pcs', '2800', 'img/hot drumlets 20pcs.png', 'p1015', 9, 'Hot Drumblets'),
(32, 'Submarine', '650', 'img/Submarine.png', 'p1016', 7, 'Submarine'),
(34, 'Twister', '1080', 'img/Twister.png', 'p1018', 7, 'Twister'),
(42, 'Fanda', '200', 'img/fanta.jpg', 'p1019', 1, 'Fanda'),
(43, 'Chicken Biriyani', '350', 'img/biryani.webp', 'p1020', 10, 'Biriyani'),
(44, 'Coco Cola', '260', 'img/fresh-cola-drink-glass.jpg', 'p1021', 1, 'Coco Cola'),
(45, 'Waffle With Ice-Creams', '450', 'img/waffle.jpg', 'p1022', 12, 'Waffle '),
(46, 'Brownie with ice-creams', '480', 'img/brownie.jpg', 'p1023', 12, 'Brownie'),
(47, 'Vanilla sundae', '650', 'img/VANILLA sundae.jpg', 'p1024', 12, 'Vanilla'),
(48, 'Strawberry Sundae', '650', 'img/STRAWBERRY.jpg', 'p1025', 12, 'Strawberry Sundae'),
(49, 'Oreo Milkshake', '630', 'img/OREO.jpg', 'p1026', 12, 'Oreo Milkshake'),
(50, 'Nasi Goreng', '950', 'img/Nasi Goreng.jpg', 'p1027', 10, 'Nasi Goreng'),
(51, 'Mongolian Mixed Rice', '980', 'img/Mangolian Mixed rice.jfif', 'p1028', 10, 'Mongolian Rice'),
(52, 'Schezwan Fried Rice', '870', 'img/Schezwan Fried Rice.jpg', 'p1029', 10, 'Schezwan Fried Rice'),
(53, 'Chinese cuisine rice', '820', 'img/chinese cuisine rice.jpg', 'p1030', 10, 'Chinese'),
(54, 'Special Fried Rice', '1100', 'img/special fried rice.jpg', 'p1031', 10, 'Fried Rice');

-- --------------------------------------------------------

--
-- Table structure for table `remark`
--

CREATE TABLE `remark` (
  `id` int(11) NOT NULL,
  `frm_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `remark` mediumtext NOT NULL,
  `remarkDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `remark`
--

INSERT INTO `remark` (`id`, `frm_id`, `status`, `remark`, `remarkDate`) VALUES
(13, 21, 'closed', 'Wait a minute', '2023-03-19 06:53:35'),
(14, 21, 'rejected', 'Not stock', '2023-03-19 06:54:09'),
(15, 22, 'in process', 'Wait a minute', '2023-03-19 07:23:40'),
(16, 22, 'closed', 'Very soon', '2023-03-19 16:49:28'),
(17, 22, 'rejected', 'wait', '2023-03-20 11:30:35'),
(18, 26, 'closed', 'ok', '2023-03-21 03:42:32'),
(19, 30, 'in process', 'wait', '2023-04-02 04:15:56'),
(20, 32, 'in process', 'wait', '2023-05-07 14:51:03');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uid` int(11) NOT NULL,
  `username` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `password` varchar(150) NOT NULL,
  `address` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `username`, `email`, `phone`, `password`, `address`) VALUES
(9, 'Aasath ', 'ak99@gmail.com', '0754834050', '628631f07321b22d8c176c200c855e1b', 'mavady'),
(10, 'Aasath ', 'ak99@gmail.com', '0754834050', 'a127fd1f86e4ab650f2216f09992afa4', 'mavady'),
(11, 'Aasath ', 'ak@gmail.com', '0754834050', '202cb962ac59075b964b07152d234b70', 'mavady');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`g_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_code_2` (`product_code`),
  ADD KEY `product_code` (`product_code`);

--
-- Indexes for table `remark`
--
ALTER TABLE `remark`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=163;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `g_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `remark`
--
ALTER TABLE `remark`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
