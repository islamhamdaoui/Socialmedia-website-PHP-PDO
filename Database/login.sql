-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 11, 2024 at 04:16 PM
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
(76, 74, 54, 'hi', '2024-07-11 14:00:26'),
(77, 72, 55, 'hi dude', '2024-07-11 14:15:36'),
(78, 75, 53, 'hhh', '2024-07-11 14:21:22'),
(79, 70, 55, 'Hi', '2024-07-11 14:40:15');

-- --------------------------------------------------------

--
-- Table structure for table `follow`
--

CREATE TABLE `follow` (
  `id` int(11) NOT NULL,
  `follower_id` int(11) NOT NULL,
  `followed_id` int(11) NOT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `follow`
--

INSERT INTO `follow` (`id`, `follower_id`, `followed_id`, `status`) VALUES
(6, 55, 53, 'followed'),
(7, 54, 55, 'followed'),
(8, 54, 53, 'followed'),
(9, 60, 53, 'followed'),
(10, 61, 53, 'followed'),
(11, 62, 53, 'followed'),
(12, 63, 53, 'followed'),
(13, 64, 53, 'followed'),
(14, 65, 53, 'followed'),
(15, 66, 53, 'followed'),
(16, 67, 53, 'followed'),
(17, 68, 53, 'followed'),
(18, 69, 53, 'followed'),
(19, 70, 53, 'followed'),
(20, 71, 53, 'followed'),
(21, 72, 53, 'followed'),
(22, 73, 53, 'followed'),
(23, 74, 53, 'followed'),
(24, 75, 53, 'followed'),
(25, 76, 53, 'followed'),
(26, 77, 53, 'followed'),
(27, 78, 53, 'followed'),
(28, 79, 53, 'followed'),
(29, 80, 53, 'followed'),
(30, 81, 53, 'followed'),
(31, 82, 53, 'followed'),
(32, 83, 53, 'followed'),
(33, 84, 53, 'followed'),
(34, 85, 53, 'followed'),
(35, 86, 53, 'followed'),
(36, 87, 53, 'followed'),
(37, 88, 53, 'followed'),
(38, 89, 53, 'followed'),
(41, 53, 89, 'followed'),
(44, 53, 63, 'followed');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `post_id`, `user_id`, `status`) VALUES
(127, 69, 53, 'liked'),
(132, 67, 53, 'liked'),
(149, 72, 53, 'liked'),
(150, 74, 54, 'liked');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `message` varchar(255) NOT NULL,
  `is_read` varchar(3) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `post_id`, `user_id`, `owner_id`, `message`, `is_read`, `created_at`) VALUES
(8, 74, 53, 53, 'islamputh commented on your post', '0', '2024-07-11 12:55:02'),
(9, 74, 54, 53, 'rayanmazouni commented on your post', '0', '2024-07-11 12:55:57'),
(10, 74, 54, 53, 'rayanmazouni commented on your post', 'No', '2024-07-11 13:00:26'),
(11, 72, 55, 53, 'user commented on your post', 'No', '2024-07-11 13:15:36'),
(12, 75, 53, 55, 'islamputh commented on your post', 'No', '2024-07-11 13:21:22'),
(13, 70, 55, 53, 'user commented on your post', 'No', '2024-07-11 13:40:15');

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
(67, 53, 'hi', '2024-07-10 11:41:13'),
(68, 53, 'hello', '2024-07-10 11:41:15'),
(69, 53, 'hhh', '2024-07-10 11:42:07'),
(70, 53, 'ff', '2024-07-10 11:42:09'),
(71, 53, 'hhh', '2024-07-10 11:43:50'),
(72, 53, 'Hello guys', '2024-07-10 14:46:29'),
(73, 53, 'Hh', '2024-07-10 14:46:35'),
(74, 53, 'Hu', '2024-07-10 14:46:38'),
(75, 55, 'hi its m\r\n', '2024-07-11 13:17:56');

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
(53, 'islamputh', 'islam123', 'islamhamdaoui2000@gmail.com', 'islam'),
(54, 'rayanmazouni', 'rayan123', 'rayan@gmail.com', 'mohamed'),
(55, 'user', 'user123', 'user@gmail.com', 'default'),
(56, 'Alice', 'password123', 'alice@example.com', 'default'),
(57, 'Aaron', 'password123', 'aaron@example.com', 'sara'),
(58, 'Aiden', 'password123', 'aiden@example.com', 'dalia'),
(59, 'Amelia', 'password123', 'amelia@example.com', 'islam'),
(60, 'Andrew', 'password123', 'andrew@example.com', 'mohamed'),
(61, 'Ava', 'password123', 'ava@example.com', 'default'),
(62, 'Asher', 'password123', 'asher@example.com', 'sara'),
(63, 'Abigail', 'password123', 'abigail@example.com', 'dalia'),
(64, 'Anthony', 'password123', 'anthony@example.com', 'islam'),
(65, 'Aurora', 'password123', 'aurora@example.com', 'mohamed'),
(66, 'Adam', 'password123', 'adam@example.com', 'default'),
(67, 'Ariana', 'password123', 'ariana@example.com', 'sara'),
(68, 'Alexander', 'password123', 'alexander@example.com', 'dalia'),
(69, 'Alyssa', 'password123', 'alyssa@example.com', 'islam'),
(70, 'Austin', 'password123', 'austin@example.com', 'mohamed'),
(71, 'Addison', 'password123', 'addison@example.com', 'default'),
(72, 'Adrian', 'password123', 'adrian@example.com', 'sara'),
(73, 'Aria', 'password123', 'aria@example.com', 'dalia'),
(74, 'Axel', 'password123', 'axel@example.com', 'islam'),
(75, 'Aubrey', 'password123', 'aubrey@example.com', 'mohamed'),
(76, 'Ashton', 'password123', 'ashton@example.com', 'default'),
(77, 'Andrea', 'password123', 'andrea@example.com', 'sara'),
(78, 'Amos', 'password123', 'amos@example.com', 'dalia'),
(79, 'Angela', 'password123', 'angela@example.com', 'islam'),
(80, 'Alvin', 'password123', 'alvin@example.com', 'mohamed'),
(81, 'Adele', 'password123', 'adele@example.com', 'default'),
(82, 'Amos', 'password123', 'amos@example.com', 'sara'),
(83, 'Alec', 'password123', 'alec@example.com', 'dalia'),
(84, 'Anya', 'password123', 'anya@example.com', 'islam'),
(85, 'Arnold', 'password123', 'arnold@example.com', 'mohamed'),
(86, 'Anabelle', 'password123', 'anabelle@example.com', 'default'),
(87, 'Alfred', 'password123', 'alfred@example.com', 'sara'),
(88, 'Amy', 'password123', 'amy@example.com', 'dalia'),
(89, 'Albert', 'password123', 'albert@example.com', 'islam'),
(90, 'Autumn', 'password123', 'autumn@example.com', 'mohamed'),
(91, 'Arthur', 'password123', 'arthur@example.com', 'default'),
(92, 'Ann', 'password123', 'ann@example.com', 'sara'),
(93, 'Aubrey', 'password123', 'aubrey@example.com', 'dalia'),
(94, 'Alma', 'password123', 'alma@example.com', 'islam'),
(95, 'Alex', 'password123', 'alex@example.com', 'mohamed');

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
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_id` (`user_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `follow`
--
ALTER TABLE `follow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `follow`
--
ALTER TABLE `follow`
  ADD CONSTRAINT `fk_followed_id` FOREIGN KEY (`followed_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_follower_id` FOREIGN KEY (`follower_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`),
  ADD CONSTRAINT `notifications_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
