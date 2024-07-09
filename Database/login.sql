-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 08, 2024 at 04:41 PM
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
-- Database: `login`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `user_id`, `comment`, `created_at`) VALUES
(2, 23, 2, 'hi', '2024-07-05 18:17:20'),
(16, 23, 2, 'hi', '2024-07-05 19:39:00'),
(18, 23, 2, '@islamputh ', '2024-07-05 20:18:26'),
(21, 0, 2, 'gg', '2024-07-06 14:31:43'),
(26, 0, 2, 'hh', '2024-07-06 14:44:50'),
(28, 0, 10, 'gg', '2024-07-06 14:59:25'),
(57, 25, 2, 'hi', '2024-07-08 15:34:06');

-- --------------------------------------------------------

--
-- Table structure for table `follow`
--

CREATE TABLE `follow` (
  `id` int(11) NOT NULL,
  `follower_id` int(11) NOT NULL,
  `followed_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `follow`
--

INSERT INTO `follow` (`id`, `follower_id`, `followed_id`) VALUES
(20, 2, 1),
(23, 2, 2),
(21, 2, 10);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `content`, `created_at`) VALUES
(2, 2, 'hi everyone ', '2024-07-04 20:28:27'),
(3, 2, 'hi everyone ', '2024-07-04 20:29:40'),
(4, 2, 'hh', '2024-07-04 20:29:52'),
(5, 1, 'hiii', '2024-07-04 20:30:23'),
(20, 1, 'new post', '2024-07-04 21:01:06'),
(21, 2, 'so this is a new post man\\', '2024-07-04 21:16:24'),
(22, 2, 'hi guys again', '2024-07-04 21:18:05'),
(23, 3, 'hey guys im new', '2024-07-04 21:46:26'),
(24, 2, 'this will contain comments', '2024-07-05 17:37:47'),
(25, 10, 'hi', '2024-07-06 12:12:50');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(5) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pdp` enum('default','sara','dalia','islam','mohamed') DEFAULT 'default'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `pdp`) VALUES
(1, 'islam hamdaoui', 'islam123', 'islamhamdaoui@gmail.com', 'mohamed'),
(2, 'islam puth', 'islam123', 'islamhamdaoui2000@gmail.com', 'islam'),
(5, 'rayan', 'rayan123', 'rayan@gmail.com', ''),
(6, 'anis', 'anis123', 'anis@gmail.com', ''),
(7, 'ammar', 'omar123', 'ammar@gmail.com', ''),
(8, 'mazouni', 'flutter', 'mazouni@gmail.com', ''),
(9, 'galmi', 'galmi', 'galmi@gmail.com', ''),
(10, 'user1', 'user123', 'user@gmail.com', 'dalia');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `follow`
--
ALTER TABLE `follow`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_relationship` (`follower_id`,`followed_id`),
  ADD KEY `fk_followed_id` (`followed_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
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
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `follow`
--
ALTER TABLE `follow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `follow`
--
ALTER TABLE `follow`
  ADD CONSTRAINT `fk_followed_id` FOREIGN KEY (`followed_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_follower_id` FOREIGN KEY (`follower_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
