-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2023 at 09:49 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tourism_agency`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int(50) NOT NULL,
  `user_id` int(30) NOT NULL,
  `tour_id` int(20) NOT NULL,
  `booking_date` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `destinations`
--

CREATE TABLE `destinations` (
  `id` int(50) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `review_date` date NOT NULL,
  `rating` int(10) NOT NULL,
  `comments` text NOT NULL,
  `user_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tour`
--

CREATE TABLE `tour` (
  `id` int(30) NOT NULL,
  `name` varchar(100) NOT NULL,
  `image` text NOT NULL,
  `date` date NOT NULL,
  `destination_id` int(100) NOT NULL,
  `booking_date` date NOT NULL,
  `description` varchar(100) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `seats` int(100) NOT NULL,
  `tour_guide_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(50) DEFAULT 'users'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `phone_number`, `password`, `role`) VALUES
(32, 'john_doe', 'john.doe@example.com', '1234567890', '$2y$10$5uTJ1ge3gop3Mv3my3wSK.gc1A9NYkvDHZyUqitEYTPKwR4T14KoC', 'users'),
(33, 'fthi', 'fathi@example.com', '111111', '$2y$10$WN8hN9kw9giBoys.6wPbSOXwwBkWnUqXs0l7NmuEaIqukc5zuEe3e', 'users'),
(34, 'mira', 'mira@gmail.com', '111111', '$2y$10$XRxbwChV0e6YgNzFyEgoyuwUIN.tXnqz1j7Uj6N2TOSUrbnO1P4yq', 'admin'),
(35, 'meme', 'meme@gmail.com', '111111', '$2y$10$VdebuuveNvVp8CHdFbjdTOoXV/fTrgUcRbW81ddwbIPnNba92sdJG', 'tour guide'),
(37, 'danaoe', 'dgtfoe@example.com', '1234567890', '$2y$10$HzvQ2BiwolKr5IDGD3A7XeYcdA.tWV3WPFpC/8L7Xaok.itM4z65W', 'users'),
(38, 'dddjoe', 'dgtfoe@example.com', '1gfhjh234567890', '$2y$10$WeUjl32o0f7b/g9rG4w77O3KLrUdj3lwYzhy53U38Mufhh1kFIcPK', 'users'),
(39, 'reem', 'reem@example.com', '1gfhjh234567890', '$2y$10$5RD/rEsUwvGAUl/h3cGIjeNRNcEeAdoD85nvD4BeBLvtJbSttH6Y6', 'users'),
(41, 'Jire ', 'jire@example.com', '1111111111', '$2y$10$D4F7DsgMRzwMY4.LNytXLOzJsxu04EjQKtrPV/JSfT6BHymkAknnu', 'users'),
(42, 'Joore ', 'joore@example.com', '1111111111', '$2y$10$qxhJfLRFI5.65voGimOtpOeoj4aHyurPf5nh60CHiIoj57D7j2e9a', 'tour guide');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `tour_id` (`tour_id`);

--
-- Indexes for table `destinations`
--
ALTER TABLE `destinations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tour`
--
ALTER TABLE `tour`
  ADD PRIMARY KEY (`id`),
  ADD KEY `destination_id` (`destination_id`),
  ADD KEY `tour_guide_id` (`tour_guide_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `destinations`
--
ALTER TABLE `destinations`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tour`
--
ALTER TABLE `tour`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`tour_id`) REFERENCES `tour` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tour`
--
ALTER TABLE `tour`
  ADD CONSTRAINT `tour_ibfk_1` FOREIGN KEY (`destination_id`) REFERENCES `destinations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
