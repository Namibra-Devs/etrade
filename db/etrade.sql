-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 26, 2023 at 02:52 AM
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
-- Database: `etrade`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart_list`
--

CREATE TABLE `cart_list` (
  `id` int(30) NOT NULL,
  `client_id` int(30) NOT NULL,
  `product_id` int(30) NOT NULL,
  `quantity` float NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `category_list`
--

CREATE TABLE `category_list` (
  `id` int(30) NOT NULL,
  `vendor_id` int(30) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `client_list`
--

CREATE TABLE `client_list` (
  `id` int(30) NOT NULL,
  `code` varchar(100) NOT NULL,
  `firstname` text NOT NULL,
  `middlename` text DEFAULT NULL,
  `lastname` text NOT NULL,
  `gender` text NOT NULL,
  `contact` text NOT NULL,
  `address` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `avatar` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `order_id` int(30) NOT NULL,
  `product_id` int(30) NOT NULL,
  `quantity` double NOT NULL DEFAULT 0,
  `price` double NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `order_list`
--

CREATE TABLE `order_list` (
  `id` int(30) NOT NULL,
  `code` varchar(100) NOT NULL,
  `client_id` int(30) NOT NULL,
  `vendor_id` int(30) NOT NULL,
  `total_amount` double NOT NULL DEFAULT 0,
  `delivery_address` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `product_list`
--

CREATE TABLE `product_list` (
  `id` int(30) NOT NULL,
  `vendor_id` int(30) DEFAULT NULL,
  `category_id` int(30) DEFAULT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `price` double NOT NULL DEFAULT 0,
  `image_path` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `shop_type_list`
--

CREATE TABLE `shop_type_list` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shop_type_list`
--

INSERT INTO `shop_type_list` (`id`, `name`, `status`, `delete_flag`, `date_created`, `date_updated`) VALUES
(1, 'Dry Goods', 1, 0, '2022-02-09 08:49:34', NULL),
(2, 'Cosmetics', 1, 0, '2022-02-09 08:49:46', NULL),
(3, 'Produce', 1, 0, '2022-02-09 08:50:31', NULL),
(4, 'Others', 1, 1, '2022-02-09 08:50:41', '2023-06-13 03:32:57');

-- --------------------------------------------------------

--
-- Table structure for table `system_info`
--

CREATE TABLE `system_info` (
  `id` int(30) NOT NULL,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `system_info`
--

INSERT INTO `system_info` (`id`, `meta_field`, `meta_value`) VALUES
(1, 'name', 'eTrade'),
(6, 'short_name', 'eTrade'),
(11, 'logo', 'uploads/favicon.png'),
(13, 'user_avatar', 'uploads/user_avatar.jpg'),
(14, 'cover', 'uploads/cover-1644367404.png'),
(15, 'title_logo', 'uploads/logo.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(50) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `lastname` varchar(250) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `avatar` text DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 0,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `password`, `avatar`, `last_login`, `type`, `date_added`, `date_updated`) VALUES
(12, 'Balogun', 'Abdulsamad', 'Admin1', '', 'uploads/avatar-12.png?v=1687280010', NULL, 0, '2023-06-20 17:53:28', '2023-06-20 17:53:30');

-- --------------------------------------------------------

--
-- Table structure for table `users_1`
--

CREATE TABLE `users_1` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users_1`
--

INSERT INTO `users_1` (`id`, `name`, `email`, `password`, `created_at`) VALUES
(0, 'anniemario', 'annie@example.com', '$2y$10$A..xczBE66aCbILVDyw3SOdgDtHUEbdEBROYPqJ4fNjSelrNoTsUy', '2023-06-13 05:03:07');

-- --------------------------------------------------------

--
-- Table structure for table `vendor_list`
--

CREATE TABLE `vendor_list` (
  `id` int(30) NOT NULL,
  `code` varchar(100) NOT NULL,
  `shop_type_id` int(30) NOT NULL,
  `shop_name` text NOT NULL,
  `shop_owner` text NOT NULL,
  `contact` text NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `avatar` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vendor_list`
--

INSERT INTO `vendor_list` (`id`, `code`, `shop_type_id`, `shop_name`, `shop_owner`, `contact`, `username`, `password`, `avatar`, `status`, `delete_flag`, `date_created`, `date_updated`) VALUES
(7, '202306-00001', 1, 'Ahop1', 'Balogun Abdullah', '08117084647', 'mustapha23', '343b1c4a3ea721b2d640fc8700db0f36', 'uploads/vendors/7.png?v=1687737819', 1, 0, '2023-06-26 01:03:39', '2023-06-26 01:03:39'),
(8, '202306-00002', 1, 'Ahop1', 'Balogun Abdullah', '08117084647', 'abdulsamadbalogun23@gmail.com', '4bbde07660e5eff90873642cfae9a8dd', 'uploads/vendors/8.png?v=1687739283', 1, 0, '2023-06-26 01:28:03', '2023-06-26 01:28:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart_list`
--
ALTER TABLE `cart_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `category_list`
--
ALTER TABLE `category_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vendor_id` (`vendor_id`);

--
-- Indexes for table `client_list`
--
ALTER TABLE `client_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `order_list`
--
ALTER TABLE `order_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `vendor_id` (`vendor_id`);

--
-- Indexes for table `product_list`
--
ALTER TABLE `product_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vendor_id` (`vendor_id`),
  ADD KEY `category_id` (`category_id`) USING BTREE;

--
-- Indexes for table `shop_type_list`
--
ALTER TABLE `shop_type_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_info`
--
ALTER TABLE `system_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendor_list`
--
ALTER TABLE `vendor_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shop_type_id` (`shop_type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart_list`
--
ALTER TABLE `cart_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `category_list`
--
ALTER TABLE `category_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `client_list`
--
ALTER TABLE `client_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order_list`
--
ALTER TABLE `order_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product_list`
--
ALTER TABLE `product_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `shop_type_list`
--
ALTER TABLE `shop_type_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `system_info`
--
ALTER TABLE `system_info`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `vendor_list`
--
ALTER TABLE `vendor_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart_list`
--
ALTER TABLE `cart_list`
  ADD CONSTRAINT `cart_list_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `client_list` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_list_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product_list` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `category_list`
--
ALTER TABLE `category_list`
  ADD CONSTRAINT `category_list_ibfk_1` FOREIGN KEY (`vendor_id`) REFERENCES `vendor_list` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order_list` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product_list` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_list`
--
ALTER TABLE `order_list`
  ADD CONSTRAINT `order_list_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `client_list` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_list_ibfk_2` FOREIGN KEY (`vendor_id`) REFERENCES `vendor_list` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_list`
--
ALTER TABLE `product_list`
  ADD CONSTRAINT `product_list_ibfk_1` FOREIGN KEY (`vendor_id`) REFERENCES `vendor_list` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `product_list_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `category_list` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `vendor_list`
--
ALTER TABLE `vendor_list`
  ADD CONSTRAINT `vendor_list_ibfk_1` FOREIGN KEY (`shop_type_id`) REFERENCES `shop_type_list` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
