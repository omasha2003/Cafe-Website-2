-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 09, 2024 at 06:00 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gallerycafe`
--

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `cousin_type` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `name`, `description`, `price`, `cousin_type`, `category`, `image`, `created_at`) VALUES
(1, 'Kottu Roti', 'a stir-fried dish made from chopped roti (flatbread) mixed with vegetables, meat (such as chicken or beef), and spices. It’s typically served with a spicy sauce or curry.', 1150.00, 'Sri Lankan', 'Main Dishes', '../uploads/kottu.jpg', '2024-08-08 20:25:06'),
(2, 'Sri Lankan Rice and Curry', 'A traditional Sri Lankan meal consisting of rice served with a variety of vegetable, meat, or fish curries. The dishes are usually accompanied by sambol (a spicy condiment) and pickles.', 950.00, 'Sri Lankan', 'Main Dishes', '../uploads/849bcc692a887690945b579914aeda7a.jpg', '2024-08-08 20:32:45'),
(5, 'Spring Rolls', 'Spring Rolls are crispy, deep-fried rolls filled with a mixture of vegetables, and sometimes meat or seafood. They are commonly served with a dipping sauce, such as sweet and sour or soy sauce.', 980.00, 'Chinese', 'Main Dishes', '../uploads/cace9bfe070775a592d7700c54d9332d.jpg', '2024-08-08 21:56:33'),
(6, 'Hot and Sour Soup', 'Hot and Sour Soup is a flavorful soup with a combination of spicy and tangy flavors. It often includes ingredients like tofu, mushrooms, bamboo shoots, and pork, thickened with cornstarch and seasoned with vinegar and white pepper.', 1190.00, 'Chinese', 'Main Dishes', '../uploads/886b7e802836f52c62f8b290860cdd3b.jpg', '2024-08-08 22:01:10'),
(7, 'Jasmine Tea', 'A fragrant green tea infused with jasmine blossoms. It has a delicate floral aroma and a slightly sweet taste.', 690.00, 'Chinese', 'Beverages', '../uploads/387c898588f91d92d0d7fe66983e5c4d.jpg', '2024-08-08 22:05:37'),
(8, 'Cappuccino', 'A coffee drink made with equal parts espresso, steamed milk, and milk foam. It’s often enjoyed as a morning beverage and topped with a sprinkle of cocoa or cinnamon.', 800.00, 'Italian', 'Beverages', '../uploads/33442e58a74503c7cef4fc437a4ebc8e.jpg', '2024-08-08 22:14:08'),
(9, 'Cassata', 'A Sicilian cake made with layers of sponge cake soaked in liqueur, ricotta cheese, and candied fruit. It’s often decorated with colorful icing and marzipan.', 1190.00, 'Italian', 'Desserts', '../uploads/c0d2783a85790f08e24ec82db6625ca0.jpg', '2024-08-08 22:30:02');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `order_number` varchar(50) NOT NULL,
  `order_date` datetime NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `order_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `item_title` varchar(255) NOT NULL,
  `item_price` decimal(10,2) NOT NULL,
  `item_quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `TimeStamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phonenumber` varchar(20) NOT NULL,
  `meal` enum('breakfast','lunch','dinner') NOT NULL,
  `table_choice` varchar(20) NOT NULL,
  `date` date NOT NULL,
  `message` text DEFAULT NULL,
  `reservation_status` enum('requested','confirmed','cancelled') DEFAULT 'requested'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `TimeStamp`, `username`, `email`, `phonenumber`, `meal`, `table_choice`, `date`, `message`, `reservation_status`) VALUES
(1, '2024-08-08 14:51:48', 'prabod', 'prabod@gmail.com', '987654321', 'dinner', 'table3', '2024-08-28', '', 'requested'),
(4, '2024-08-08 14:58:48', 'abeseykara', 'niman@gmail.com', '07213636333', 'dinner', 'table2', '2024-08-24', 'hmm', 'requested');

-- --------------------------------------------------------

--
-- Table structure for table `userdetails`
--

CREATE TABLE `userdetails` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `acc_type` enum('admin','staff','customer') DEFAULT 'customer'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userdetails`
--

INSERT INTO `userdetails` (`id`, `username`, `email`, `phone`, `password`, `acc_type`) VALUES
(2, 'niman prabod', 'niman@gmail.com', '123456789', '$2y$10$/iYmM20yexOb9zOitWjcnO8J2sk8/4fyg8BCcxCxddERz.KcN5AGW', 'customer'),
(4, 'Niman Abey', 'abey@gmail.com', '071189001', '$2y$10$uhP2AmWkMMXvirHdsx5NfuNe7sRMfVmfmZvLFu81nQ2FKwgpZIW6O', 'admin'),
(5, 'Omasha ', 'omasha@gmail.com', '0987654321', '$2y$10$2We6LEiOjLQUH2ndAuXoYe6J7Y47ExC6ikZEIB52UmQPfKgbR3PgW', 'staff');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `order_number` (`order_number`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userdetails`
--
ALTER TABLE `userdetails`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `userdetails`
--
ALTER TABLE `userdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
