-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 17, 2024 at 01:07 PM
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
(90, 86, 54, 'Dude that\'s awesome I\'m gonna follow u', '2024-07-15 13:27:39'),
(92, 86, 54, '@islamputh welcome', '2024-07-15 13:48:46'),
(93, 86, 54, 'Hi dude', '2024-07-15 13:54:50'),
(94, 86, 54, 'How\'s u', '2024-07-15 13:54:54'),
(95, 86, 54, '@rayanmazouni fine wbu', '2024-07-15 14:06:47'),
(107, 86, 55, '@rayanmazouni wash rak dir hna hh', '2024-07-15 14:29:04'),
(111, 86, 55, '@user ', '2024-07-15 14:46:44'),
(112, 85, 55, '@user ', '2024-07-15 14:46:49'),
(115, 90, 53, 'hi', '2024-07-15 16:49:13'),
(116, 92, 55, 'Nice photo bro', '2024-07-15 16:49:47'),
(117, 92, 53, '@user thnks', '2024-07-15 16:49:57'),
(118, 92, 53, '@islamputh ', '2024-07-15 16:51:16'),
(119, 92, 55, 'فف', '2024-07-15 16:59:12'),
(120, 92, 55, 'سس', '2024-07-15 17:02:53'),
(121, 92, 55, 'سسص', '2024-07-15 17:04:33'),
(122, 92, 54, 'Hh', '2024-07-15 17:12:57'),
(123, 92, 54, 'Gg', '2024-07-15 17:25:21'),
(124, 92, 55, '@rayanmazouni hhh', '2024-07-15 19:48:06'),
(125, 92, 54, 'Hi', '2024-07-16 15:50:03'),
(126, 92, 54, 'Hi', '2024-07-16 15:54:12'),
(127, 94, 54, 'Look at this ', '2024-07-16 15:54:34'),
(128, 94, 54, '@islamputh look ', '2024-07-16 15:54:46'),
(129, 94, 53, '@rayanmazouni hhh', '2024-07-16 15:55:03');

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
(70, 53, 54, 'followed'),
(78, 55, 53, 'followed'),
(82, 54, 53, 'followed'),
(84, 53, 61, 'followed');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` varchar(10) NOT NULL,
  `owner_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `post_id`, `user_id`, `status`, `owner_id`) VALUES
(341, 94, 53, 'liked', 54),
(342, 86, 53, 'liked', 53),
(343, 92, 53, 'liked', 53),
(344, 91, 53, 'liked', 53),
(345, 94, 54, 'liked', 54),
(346, 92, 54, 'liked', 53),
(347, 91, 54, 'liked', 53),
(348, 90, 54, 'liked', 53),
(349, 89, 54, 'liked', 53),
(350, 90, 53, 'liked', 53),
(351, 98, 53, 'liked', 53),
(352, 101, 54, 'liked', 53);

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
(549, 86, 55, 53, 'user liked your post.', 'YES', '2024-07-15 14:07:07'),
(550, 90, 53, 53, 'islamputh commented on your post.', 'No', '2024-07-15 15:49:13'),
(551, 92, 55, 53, 'user commented on your post.', 'YES', '2024-07-15 15:49:47'),
(552, 92, 53, 53, 'islamputh commented on your post.', 'No', '2024-07-15 15:49:57'),
(553, 92, 53, 55, 'islamputh mentioned you in a comment.', 'YES', '2024-07-15 15:49:57'),
(554, 92, 53, 53, 'islamputh commented on your post.', 'No', '2024-07-15 15:51:16'),
(555, 92, 53, 53, 'islamputh mentioned you in a comment.', 'No', '2024-07-15 15:51:16'),
(556, 92, 53, 53, 'islamputh liked your post.', 'No', '2024-07-15 15:51:39'),
(558, 92, 55, 53, 'user commented on your post.', 'No', '2024-07-15 15:59:12'),
(559, 92, 55, 53, 'user commented on your post.', 'No', '2024-07-15 16:02:53'),
(560, 92, 55, 53, 'user commented on your post.', 'No', '2024-07-15 16:04:33'),
(561, 92, 54, 53, 'rayanmazouni liked your post.', 'YES', '2024-07-15 16:04:48'),
(562, 92, 54, 53, 'rayanmazouni commented on your post.', 'No', '2024-07-15 16:12:57'),
(563, 92, 54, 53, 'rayanmazouni commented on your post.', 'YES', '2024-07-15 16:25:21'),
(564, 92, 55, 53, 'user commented on your post.', 'YES', '2024-07-15 18:48:06'),
(565, 92, 55, 54, 'user mentioned you in a comment.', 'YES', '2024-07-15 18:48:06'),
(566, 92, 54, 53, 'rayanmazouni commented on your post.', 'No', '2024-07-16 14:50:03'),
(567, 92, 54, 53, 'rayanmazouni commented on your post.', 'No', '2024-07-16 14:54:12'),
(568, 94, 54, 54, 'rayanmazouni commented on your post.', 'No', '2024-07-16 14:54:34'),
(569, 94, 54, 54, 'rayanmazouni commented on your post.', 'No', '2024-07-16 14:54:46'),
(570, 94, 54, 53, 'rayanmazouni mentioned you in a comment.', 'YES', '2024-07-16 14:54:46'),
(573, 91, 53, 0, 'islamputh liked your post.', 'No', '2024-07-16 15:12:08'),
(574, 92, 53, 53, 'islamputh liked your post.', 'No', '2024-07-16 15:19:38'),
(575, 90, 53, 53, 'islamputh liked your post.', 'No', '2024-07-16 15:19:44'),
(576, 89, 53, 53, 'islamputh liked your post.', 'No', '2024-07-16 15:19:47'),
(578, 94, 53, 54, 'islamputh liked your post.', 'No', '2024-07-16 15:31:00'),
(579, 94, 53, 54, 'islamputh liked your post.', 'YES', '2024-07-16 15:31:40'),
(580, 86, 53, 53, 'islamputh liked your post.', 'No', '2024-07-16 15:32:35'),
(581, 92, 53, 53, 'islamputh liked your post.', 'No', '2024-07-16 15:32:58'),
(582, 91, 53, 53, 'islamputh liked your post.', 'No', '2024-07-16 15:33:00'),
(583, 94, 54, 54, 'rayanmazouni liked your post.', 'No', '2024-07-16 15:33:13'),
(584, 92, 54, 53, 'rayanmazouni liked your post.', 'No', '2024-07-16 15:33:16'),
(585, 91, 54, 53, 'rayanmazouni liked your post.', 'No', '2024-07-16 15:33:17'),
(586, 90, 54, 53, 'rayanmazouni liked your post.', 'YES', '2024-07-16 15:33:18'),
(587, 89, 54, 53, 'rayanmazouni liked your post.', 'YES', '2024-07-16 15:33:21'),
(588, 90, 53, 53, 'islamputh liked your post.', 'No', '2024-07-16 15:34:52'),
(590, NULL, 53, 61, 'islamputh followed you.', 'No', '2024-07-16 15:35:03'),
(592, NULL, 53, 54, 'root viewed your profile.', 'YES', '2024-07-17 10:36:31'),
(593, NULL, 53, 54, 'islamputh viewed your profile.', 'No', '2024-07-17 10:39:29'),
(594, NULL, 53, 54, 'islamputh viewed your profile.', 'No', '2024-07-17 10:39:41'),
(595, NULL, 54, 53, 'rayanmazouni viewed your profile.', 'No', '2024-07-17 10:44:52'),
(609, NULL, 53, 54, 'islamputh viewed your profile.', 'No', '2024-07-17 11:05:37');

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
(86, 53, '    The rags to riches story of dack Whittington and his cat is not just a fairy tale: it is part of the folklore of London. Today there is a monument to his cat near the Whittington Stone pub at the foot of Highgate Hill where dack sat down and heard the famous Bow Bells of East London ring out: Turn Again Whittington! Thrice Lord Mayor of London! The real dack Whittington was Lord Mayor of London in 1397, 1406 and 1419, and was a successful textile merchant. The figure of Sir Richard Whittington with his cat in his arms, carved in stone, was to be seen till the year 1780 over the archway of the old prison at Newgate, which he built for criminals, while the logo of the Whittington Hospital, Highgate, still encorporates his cat.\n', '2024-07-15 10:55:37', '', ''),
(87, 53, 'hi', '2024-07-15 15:02:57', '', ''),
(88, 53, 'hhh', '2024-07-15 15:12:00', 'share.png', './uploads/share.png'),
(89, 53, 'hi', '2024-07-15 15:18:54', '5c5285e01136275b7d003df9b785b811.jpg', './uploads/5c5285e01136275b7d003df9b785b811.jpg'),
(90, 53, 'f', '2024-07-15 15:24:11', 'medium.webp', './uploads/medium.webp'),
(91, 53, 'sss', '2024-07-15 15:32:59', '', ''),
(92, 53, 'ss', '2024-07-15 15:33:16', 'goju_satoru_by_ranshiiki_dfy2isq-fullview.jpg', './uploads/goju_satoru_by_ranshiiki_dfy2isq-fullview.jpg'),
(94, 54, 'Xd', '2024-07-15 23:34:55', 'FB_IMG_1721078611604.jpg', './uploads/FB_IMG_1721078611604.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `profile_views`
--

CREATE TABLE `profile_views` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `viewer_id` int(11) NOT NULL,
  `viewed_id` int(11) NOT NULL,
  `viewed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profile_views`
--

INSERT INTO `profile_views` (`id`, `viewer_id`, `viewed_id`, `viewed_at`) VALUES
(1, 53, 54, '2024-07-17 10:29:18'),
(2, 53, 54, '2024-07-17 10:32:16'),
(3, 53, 54, '2024-07-17 10:35:23'),
(4, 53, 54, '2024-07-17 10:35:50'),
(5, 53, 54, '2024-07-17 10:36:31'),
(6, 53, 54, '2024-07-17 10:39:29'),
(7, 53, 54, '2024-07-17 10:39:41'),
(8, 54, 53, '2024-07-17 10:44:52'),
(9, 53, 54, '2024-07-17 11:05:37');

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
-- Indexes for table `profile_views`
--
ALTER TABLE `profile_views`
  ADD PRIMARY KEY (`id`),
  ADD KEY `viewer_id` (`viewer_id`),
  ADD KEY `viewed_id` (`viewed_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

--
-- AUTO_INCREMENT for table `follow`
--
ALTER TABLE `follow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=355;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=615;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `profile_views`
--
ALTER TABLE `profile_views`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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

--
-- Constraints for table `profile_views`
--
ALTER TABLE `profile_views`
  ADD CONSTRAINT `profile_views_ibfk_1` FOREIGN KEY (`viewer_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `profile_views_ibfk_2` FOREIGN KEY (`viewed_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
