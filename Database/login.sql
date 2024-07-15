-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 15, 2024 at 05:27 PM
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
(79, 70, 55, 'Hi', '2024-07-11 14:40:15'),
(80, 74, 55, 'Hello', '2024-07-11 15:54:56'),
(81, 75, 53, 'hh', '2024-07-11 15:55:25'),
(82, 74, 54, 'Helo', '2024-07-12 11:24:47'),
(83, 83, 55, 'h', '2024-07-12 14:16:40'),
(84, 82, 55, 'Haha', '2024-07-12 15:52:07'),
(85, 85, 55, 'H', '2024-07-12 16:04:55'),
(86, 85, 55, 'Hh', '2024-07-12 16:41:57'),
(87, 85, 53, '@user hi', '2024-07-15 11:49:13'),
(88, 86, 53, 'I love it', '2024-07-15 11:56:08'),
(89, 86, 53, 'Thank u', '2024-07-15 11:56:15'),
(90, 86, 54, 'Dude that\'s awesome I\'m gonna follow u', '2024-07-15 13:27:39'),
(91, 86, 53, '@rayanmazouni thanks', '2024-07-15 13:44:03'),
(92, 86, 54, '@islamputh welcome', '2024-07-15 13:48:46'),
(93, 86, 54, 'Hi dude', '2024-07-15 13:54:50'),
(94, 86, 54, 'How\'s u', '2024-07-15 13:54:54'),
(95, 86, 54, '@rayanmazouni fine wbu', '2024-07-15 14:06:47'),
(96, 86, 53, '@rayanmazouni ', '2024-07-15 14:12:25'),
(97, 86, 53, '@rayanmazouni ', '2024-07-15 14:12:51'),
(98, 86, 53, '@rayanmazouni ', '2024-07-15 14:13:34'),
(99, 86, 53, '@rayanmazouni ', '2024-07-15 14:14:14'),
(100, 86, 53, '@rayanmazouni ', '2024-07-15 14:15:09'),
(107, 86, 55, '@rayanmazouni wash rak dir hna hh', '2024-07-15 14:29:04'),
(111, 86, 55, '@user ', '2024-07-15 14:46:44'),
(112, 85, 55, '@user ', '2024-07-15 14:46:49');

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
(7, 54, 55, 'followed'),
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
(65, 53, 63, 'followed'),
(70, 53, 54, 'followed'),
(78, 55, 53, 'followed'),
(82, 54, 53, 'followed');

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
(303, 85, 54, 'liked'),
(310, 82, 53, 'liked'),
(315, 83, 54, 'liked'),
(318, 85, 53, 'liked'),
(320, 84, 54, 'liked'),
(322, 85, 55, 'liked'),
(323, 83, 55, 'liked'),
(324, 83, 53, 'liked'),
(325, 84, 53, 'liked'),
(326, 86, 53, 'liked'),
(328, 86, 54, 'liked'),
(331, 86, 55, 'liked');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
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
(511, NULL, 54, 53, 'rayanmazouni followed you.', 'YES', '2024-07-15 12:48:21'),
(512, 86, 54, 53, 'rayanmazouni liked your post.', 'YES', '2024-07-15 12:48:33'),
(513, 86, 54, 53, 'rayanmazouni commented on your post.', 'YES', '2024-07-15 12:48:46'),
(514, 86, 54, 53, 'rayanmazouni commented on your post.', 'No', '2024-07-15 12:54:50'),
(515, 86, 54, 53, 'rayanmazouni commented on your post.', 'YES', '2024-07-15 12:54:54'),
(516, 86, 54, 53, 'rayanmazouni commented on your post.', 'No', '2024-07-15 13:06:47'),
(541, 85, 55, 53, 'user commented on your post.', 'YES', '2024-07-15 13:46:49'),
(542, 85, 55, 55, 'user mentioned you in a comment.', 'No', '2024-07-15 13:46:49'),
(549, 86, 55, 53, 'user liked your post.', 'YES', '2024-07-15 14:07:07');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `name` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `content`, `created_at`, `name`, `image`) VALUES
(77, 53, 'hello everyone', '2024-07-12 11:45:23', '', ''),
(79, 53, 'ff', '2024-07-12 11:49:02', '', ''),
(80, 53, 'gg', '2024-07-12 11:50:02', '', ''),
(81, 53, 'h', '2024-07-12 11:51:46', '', ''),
(82, 53, 'ho', '2024-07-12 13:05:06', '', ''),
(84, 53, '1', '2024-07-12 14:55:45', '', ''),
(85, 53, '2', '2024-07-12 14:55:46', '', ''),
(86, 53, 'The rags to riches story of Dick Whittington and his cat is not just a fairy tale: it is part of the folklore of London. Today there is a monument to his cat near the Whittington Stone pub at the foot of Highgate Hill where Dick sat down and heard the famous Bow Bells of East London ring out:\r\n\r\nTurn Again Whittington!\r\nThrice Lord Mayor of London!\r\n\r\nThe real Dick Whittington was Lord Mayor of London in 1397, 1406 and 1419, and was a successful textile merchant.\r\n\r\nThe figure of Sir Richard Whittington with his cat in his arms, carved in stone, was to be seen till the year 1780 over the archway of the old prison at Newgate, which he built for criminals, while the logo of the Whittington Hospital, Highgate, still encorporates his cat.', '2024-07-15 10:55:37', '', ''),
(87, 53, 'hi', '2024-07-15 15:02:57', '', ''),
(88, 53, 'hhh', '2024-07-15 15:12:00', 'share.png', './uploads/share.png'),
(89, 53, 'hi', '2024-07-15 15:18:54', '5c5285e01136275b7d003df9b785b811.jpg', './uploads/5c5285e01136275b7d003df9b785b811.jpg'),
(90, 53, 'f', '2024-07-15 15:24:11', 'medium.webp', './uploads/medium.webp');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(5) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pdp` enum('default','sara','dalia','islam','mohamed') DEFAULT 'default',
  `verified` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `pdp`, `verified`) VALUES
(53, 'islamputh', 'islam123', 'islamhamdaoui2000@gmail.com', 'islam', 'verified'),
(54, 'rayanmazouni', 'rayan123', 'rayan@gmail.com', 'mohamed', ''),
(55, 'user', 'user123', 'user@gmail.com', 'default', ''),
(56, 'Alice', 'password123', 'alice@example.com', 'default', ''),
(57, 'Aaron', 'password123', 'aaron@example.com', 'sara', ''),
(58, 'Aiden', 'password123', 'aiden@example.com', 'dalia', ''),
(59, 'Amelia', 'password123', 'amelia@example.com', 'islam', ''),
(60, 'Andrew', 'password123', 'andrew@example.com', 'mohamed', ''),
(61, 'Ava', 'password123', 'ava@example.com', 'default', ''),
(62, 'Asher', 'password123', 'asher@example.com', 'sara', ''),
(63, 'Abigail', 'password123', 'abigail@example.com', 'dalia', ''),
(64, 'Anthony', 'password123', 'anthony@example.com', 'islam', ''),
(65, 'Aurora', 'password123', 'aurora@example.com', 'mohamed', ''),
(66, 'Adam', 'password123', 'adam@example.com', 'default', ''),
(67, 'Ariana', 'password123', 'ariana@example.com', 'sara', ''),
(68, 'Alexander', 'password123', 'alexander@example.com', 'dalia', ''),
(69, 'Alyssa', 'password123', 'alyssa@example.com', 'islam', ''),
(70, 'Austin', 'password123', 'austin@example.com', 'mohamed', ''),
(71, 'Addison', 'password123', 'addison@example.com', 'default', ''),
(72, 'Adrian', 'password123', 'adrian@example.com', 'sara', ''),
(73, 'Aria', 'password123', 'aria@example.com', 'dalia', ''),
(74, 'Axel', 'password123', 'axel@example.com', 'islam', ''),
(75, 'Aubrey', 'password123', 'aubrey@example.com', 'mohamed', ''),
(76, 'Ashton', 'password123', 'ashton@example.com', 'default', ''),
(77, 'Andrea', 'password123', 'andrea@example.com', 'sara', ''),
(78, 'Amos', 'password123', 'amos@example.com', 'dalia', ''),
(79, 'Angela', 'password123', 'angela@example.com', 'islam', ''),
(80, 'Alvin', 'password123', 'alvin@example.com', 'mohamed', ''),
(81, 'Adele', 'password123', 'adele@example.com', 'default', ''),
(82, 'Amos', 'password123', 'amos@example.com', 'sara', ''),
(83, 'Alec', 'password123', 'alec@example.com', 'dalia', ''),
(84, 'Anya', 'password123', 'anya@example.com', 'islam', ''),
(85, 'Arnold', 'password123', 'arnold@example.com', 'mohamed', ''),
(86, 'Anabelle', 'password123', 'anabelle@example.com', 'default', ''),
(87, 'Alfred', 'password123', 'alfred@example.com', 'sara', ''),
(88, 'Amy', 'password123', 'amy@example.com', 'dalia', ''),
(89, 'Albert', 'password123', 'albert@example.com', 'islam', ''),
(90, 'Autumn', 'password123', 'autumn@example.com', 'mohamed', ''),
(91, 'Arthur', 'password123', 'arthur@example.com', 'default', ''),
(92, 'Ann', 'password123', 'ann@example.com', 'sara', ''),
(93, 'Aubrey', 'password123', 'aubrey@example.com', 'dalia', ''),
(94, 'Alma', 'password123', 'alma@example.com', 'islam', ''),
(95, 'Alex', 'password123', 'alex@example.com', 'mohamed', ''),
(96, 'Islam hamd', 'islam123', 'islamhamdaoui@gmail.com', 'dalia', '');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT for table `follow`
--
ALTER TABLE `follow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=332;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=550;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

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
