-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 27, 2021 at 05:10 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `php_mini_pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `slug` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `slug`, `name`) VALUES
(1, '60f7ce54de374-Hat', 'Hat'),
(2, '60f7ce54ecda1-Shirt', 'Shirt'),
(3, '60f7ce5506c35-Electronic', 'Electronic'),
(4, '60f7ce551c665-Drink', 'Drink');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `slug` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `image` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `total_qty` int(11) NOT NULL,
  `sale_price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `category_id`, `slug`, `name`, `image`, `description`, `total_qty`, `sale_price`) VALUES
(1, 1, '60f7ce561154e-name', 'name', 'image', 'des', 2, 200),
(2, 1, '60f7ce5611559-name', 'name', 'image', 'des', 2, 200),
(3, 1, '60f7ce561155a-name', 'name', 'image', 'des', 2, 200),
(4, 1, '60f7ce561155b-name', 'name', 'image', 'des', 2, 200),
(5, 1, '60f7ce561155c-name', 'name', 'image', 'des', 2, 200),
(6, 1, '60f7ce561155d-name', 'name', 'image', 'des', 2, 200),
(7, 1, '60f7ce561155e-name', 'name', 'image', 'des', 2, 200),
(8, 1, '60f7ce561155f-name', 'name', 'image', 'des', 2, 200),
(9, 1, '60f7ce5611560-name', 'name', 'image', 'des', 2, 200),
(10, 1, '60f7ce5611561-name', 'name', 'image', 'des', 2, 200),
(11, 1, '60f7ce5611562-name', 'name', 'image', 'des', 2, 200),
(12, 1, '60f7ce5611563-name', 'name', 'image', 'des', 2, 200);

-- --------------------------------------------------------

--
-- Table structure for table `product_buy`
--

CREATE TABLE `product_buy` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `buy_price` double NOT NULL,
  `total_qty` int(11) NOT NULL,
  `buy_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_buy`
--

INSERT INTO `product_buy` (`id`, `product_id`, `buy_price`, `total_qty`, `buy_date`) VALUES
(1, 7, 100, 10, '2021-07-10'),
(2, 13, 120, 5, '2021-07-13'),
(3, 14, 9000, 2, '2021-07-13'),
(4, 15, 90, 1, '2021-07-13'),
(6, 16, 100, 10, '2021-07-15'),
(7, 16, 100, 10, '2021-07-15'),
(8, 16, 90, 2, '2021-07-15'),
(9, 16, 100, 10, '2021-07-15'),
(10, 16, 0, 0, '2021-07-15'),
(11, 16, 10, 2, '2021-07-15'),
(12, 16, 0, 0, '2021-07-15'),
(13, 16, 90, 2, '2021-07-15'),
(22, 17, 200, 3, '2021-07-16'),
(23, 17, 100, 2, '2021-07-16'),
(29, 19, 900, 10, '2021-07-16'),
(31, 19, 120, 2, '2021-07-16'),
(36, 22, 100, 5, '2021-07-16'),
(38, 23, 90, 10, '2021-07-16'),
(39, 23, 90, 3, '2021-07-17'),
(40, 15, 90, 5, '2021-07-17'),
(41, 23, 90, 2, '2021-07-17');

-- --------------------------------------------------------

--
-- Table structure for table `product_sale`
--

CREATE TABLE `product_sale` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `sale_price` double NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_sale`
--

INSERT INTO `product_sale` (`id`, `product_id`, `sale_price`, `date`) VALUES
(2, 13, 100, '2021-07-16'),
(9, 23, 100, '2021-07-17'),
(10, 23, 100, '2021-07-17'),
(11, 23, 100, '2021-07-17'),
(12, 13, 100, '2021-07-17'),
(13, 13, 100, '2021-07-17'),
(14, 15, 100, '2021-07-17'),
(15, 23, 100, '2021-07-17'),
(16, 23, 100, '2021-07-17');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `slug` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `slug`, `name`, `email`, `password`) VALUES
(1, 'slug', 'userotwo', 'usertwo@gamil.com', '123456'),
(2, 'slug', 'userotwo', 'usertwo@gamil.com', '$2y$10$uuqsNNc3opbff1H5rP6DHOtIR/09d7ML9d9DKw6BM04PrphSRz6TO'),
(3, 'slug', 'thura', 'thura@gamil.com', 'thura'),
(4, 'hello', 'hello', 'hello@gmail.com', '$2y$10$D976lYYfJ58Ay6cxFnGAc.M7k1MDmmmkv4AiYSrJ6.qs3Wrx6exFm');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_buy`
--
ALTER TABLE `product_buy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_sale`
--
ALTER TABLE `product_sale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `product_buy`
--
ALTER TABLE `product_buy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `product_sale`
--
ALTER TABLE `product_sale`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
