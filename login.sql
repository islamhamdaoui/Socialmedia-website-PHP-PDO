-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 06, 2024 at 04:02 PM
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
(3, 22, 2, 'hi', '2024-07-05 18:19:18'),
(5, 22, 2, 'hh', '2024-07-05 18:20:16'),
(6, 22, 2, 'ki', '2024-07-05 18:20:20'),
(7, 24, 2, 'hi', '2024-07-05 18:37:55'),
(8, 24, 2, 'first comment', '2024-07-05 18:38:21'),
(9, 24, 2, 'hi', '2024-07-05 18:40:08'),
(10, 24, 2, 'dude', '2024-07-05 18:47:30'),
(11, 24, 3, 'hhh islam ak hna', '2024-07-05 19:00:19'),
(12, 2, 3, 'wash kho', '2024-07-05 19:01:00'),
(13, 2, 2, 'sa7aa', '2024-07-05 19:02:06'),
(14, 24, 2, '@rayan mazouni hii', '2024-07-05 19:22:32'),
(15, 24, 2, 'hi', '2024-07-05 19:31:13'),
(16, 23, 2, 'hi', '2024-07-05 19:39:00'),
(17, 24, 2, 'hi', '2024-07-05 20:09:16'),
(18, 23, 2, '@islamputh ', '2024-07-05 20:18:26'),
(19, 24, 2, '@islamputh ', '2024-07-05 20:19:29'),
(0, 24, 2, 'hi', '2024-07-06 12:00:29'),
(0, 0, 2, 'gg', '2024-07-06 14:31:43'),
(0, 22, 2, 's', '2024-07-06 14:32:09'),
(0, 24, 2, 's', '2024-07-06 14:32:14'),
(0, 24, 2, '@islam puth ', '2024-07-06 14:43:33'),
(0, 24, 2, '@islam puth  thanks', '2024-07-06 14:43:37'),
(0, 0, 2, 'hh', '2024-07-06 14:44:50'),
(0, 2, 2, 'hh', '2024-07-06 14:47:27'),
(0, 0, 10, 'gg', '2024-07-06 14:59:25');

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
(0, 10, 'hi', '2024-07-06 12:12:50');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(5) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pdp` enum('tiger','monkey') DEFAULT 'tiger'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `pdp`) VALUES
(1, 'islamhamdaoui', 'islam123', 'islamhamdaoui@gmail.com', 'tiger'),
(2, 'islam puth', 'islam123', 'islamhamdaoui2000@gmail.com', 'tiger'),
(5, 'rayan', 'rayan123', 'rayan@gmail.com', 'tiger'),
(6, 'anis', 'anis123', 'anis@gmail.com', 'tiger'),
(7, 'ammar', 'omar123', 'ammar@gmail.com', 'tiger'),
(8, 'mazouni', 'flutter', 'mazouni@gmail.com', 'tiger'),
(9, 'galmi', 'galmi', 'galmi@gmail.com', 'tiger'),
(10, 'user1', 'user123', 'user@gmail.com', 'monkey');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
