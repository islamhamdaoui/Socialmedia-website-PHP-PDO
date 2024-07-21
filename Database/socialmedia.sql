-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 21, 2024 at 02:24 PM
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
-- Database: `socialmedia`
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
(2, 2, 1, 'i love it!', '2024-07-20 20:48:43'),
(4, 4, 2, 'Not yet', '2024-07-20 21:18:23'),
(5, 4, 1, 'ofc! its my favorite', '2024-07-20 21:18:41'),
(6, 4, 4, '@islamhamdaoui story? ', '2024-07-21 12:05:55'),
(7, 2, 2, '@islamhamdaoui thank u 😊', '2024-07-21 12:11:32'),
(8, 1, 2, 'Hi', '2024-07-21 12:11:59');

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
(1, 2, 1, 'followed'),
(2, 3, 1, 'followed'),
(3, 1, 3, 'followed'),
(4, 4, 1, 'followed'),
(5, 1, 2, 'followed'),
(6, 5, 1, 'followed');

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
(1, 1, 1, 'liked', 1),
(3, 1, 2, 'liked', 1),
(4, 2, 1, 'liked', 2),
(5, 4, 3, 'liked', 3),
(6, 4, 1, 'liked', 3),
(7, 4, 2, 'liked', 3),
(8, 4, 4, 'liked', 3),
(9, 1, 4, 'liked', 1),
(10, 1, 3, 'liked', 1),
(11, 1, 5, 'liked', 1);

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
(1, 1, 1, 1, 'islamhamdaoui liked your post.', 'No', '2024-07-20 19:27:21'),
(3, 1, 2, 1, 'Rayan liked your post.', 'No', '2024-07-20 19:30:43'),
(4, NULL, 2, 1, 'Rayan followed you.', 'No', '2024-07-20 19:41:58'),
(6, 2, 1, 2, 'islamhamdaoui liked your post.', 'No', '2024-07-20 19:48:36'),
(7, 2, 1, 2, 'islamhamdaoui commented on your post.', 'YES', '2024-07-20 19:48:43'),
(10, NULL, 1, 2, 'islamhamdaoui viewed your profile.', 'No', '2024-07-20 19:57:12'),
(11, NULL, 1, 2, 'islamhamdaoui viewed your profile.', 'No', '2024-07-20 20:08:42'),
(12, NULL, 3, 1, 'daliagadi followed you.', 'YES', '2024-07-20 20:12:19'),
(13, 4, 3, 3, 'daliagadi liked your post.', 'No', '2024-07-20 20:16:21'),
(14, NULL, 1, 3, 'islamhamdaoui followed you.', 'No', '2024-07-20 20:16:36'),
(15, 4, 1, 3, 'islamhamdaoui liked your post.', 'No', '2024-07-20 20:16:39'),
(16, 4, 2, 3, 'Rayan liked your post.', 'No', '2024-07-20 20:17:04'),
(17, 4, 2, 3, 'Rayan commented on your post.', 'No', '2024-07-20 20:18:23'),
(18, 4, 1, 3, 'islamhamdaoui commented on your post.', 'No', '2024-07-20 20:18:41'),
(19, NULL, 1, 3, 'islamhamdaoui viewed your profile.', 'No', '2024-07-21 10:48:06'),
(20, NULL, 1, 2, 'islamhamdaoui viewed your profile.', 'No', '2024-07-21 10:48:25'),
(21, 4, 4, 3, 'Karim laribi liked your post.', 'No', '2024-07-21 11:05:29'),
(22, 4, 4, 3, 'Karim laribi commented on your post.', 'YES', '2024-07-21 11:05:55'),
(23, 4, 4, 1, 'Karim laribi mentioned you in a comment.', 'No', '2024-07-21 11:05:55'),
(24, 1, 4, 1, 'Karim laribi liked your post.', 'No', '2024-07-21 11:06:02'),
(25, NULL, 4, 1, 'Karim laribi viewed your profile.', 'No', '2024-07-21 11:07:09'),
(26, NULL, 4, 1, 'Karim laribi followed you.', 'No', '2024-07-21 11:07:10'),
(27, NULL, 4, 3, 'Karim laribi viewed your profile.', 'No', '2024-07-21 11:07:43'),
(28, NULL, 1, 3, 'islamhamdaoui viewed your profile.', 'YES', '2024-07-21 11:08:30'),
(29, NULL, 1, 2, 'islamhamdaoui viewed your profile.', 'No', '2024-07-21 11:08:33'),
(30, NULL, 1, 2, 'islamhamdaoui followed you.', 'No', '2024-07-21 11:08:34'),
(31, NULL, 4, 2, 'Karim laribi viewed your profile.', 'No', '2024-07-21 11:09:27'),
(32, NULL, 3, 1, 'daliagadi viewed your profile.', 'No', '2024-07-21 11:10:55'),
(33, 1, 3, 1, 'daliagadi liked your post.', 'No', '2024-07-21 11:10:58'),
(34, 2, 2, 2, 'Rayan commented on your post.', 'No', '2024-07-21 11:11:32'),
(35, 2, 2, 1, 'Rayan mentioned you in a comment.', 'No', '2024-07-21 11:11:32'),
(36, 1, 2, 1, 'Rayan commented on your post.', 'No', '2024-07-21 11:11:59'),
(37, NULL, 1, 3, 'islamhamdaoui viewed your profile.', 'No', '2024-07-21 11:34:55'),
(38, NULL, 1, 3, 'islamhamdaoui viewed your profile.', 'YES', '2024-07-21 12:07:08'),
(39, NULL, 3, 2, 'daliagadi viewed your profile.', 'No', '2024-07-21 12:12:39'),
(40, NULL, 5, 1, 'Jessyvalery followed you.', 'No', '2024-07-21 12:23:51'),
(41, 1, 5, 1, 'Jessyvalery liked your post.', 'No', '2024-07-21 12:23:55');

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
(1, 1, 'Hello everyone!', '2024-07-20 19:26:45', '', ''),
(2, 2, 'What a beautiful place', '2024-07-20 19:46:04', '20240720_203459.jpg', './uploads/20240720_203459.jpg'),
(4, 3, 'did u guys watch it?', '2024-07-20 20:16:19', 'bloodhounds.jpg', './uploads/bloodhounds.jpg');

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
(1, 1, 2, '2024-07-20 19:57:12'),
(2, 1, 2, '2024-07-20 20:08:42'),
(3, 1, 3, '2024-07-21 10:48:06'),
(4, 1, 2, '2024-07-21 10:48:25'),
(5, 4, 1, '2024-07-21 11:07:09'),
(6, 4, 3, '2024-07-21 11:07:43'),
(7, 1, 3, '2024-07-21 11:08:30'),
(8, 1, 2, '2024-07-21 11:08:33'),
(9, 4, 2, '2024-07-21 11:09:27'),
(10, 3, 1, '2024-07-21 11:10:55'),
(11, 1, 3, '2024-07-21 11:34:55'),
(12, 1, 3, '2024-07-21 12:07:08'),
(13, 3, 2, '2024-07-21 12:12:39');

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
(1, 'islamhamdaoui', 'islam123', 'islamhamdaoui2000@gmail.com', 'islam', 'Yes'),
(2, 'Rayan', 'rayan123', 'rayan@gmail.com', 'mohamed', ''),
(3, 'daliagadi', 'dalia123', 'dalia@gmail.com', 'dalia', ''),
(4, 'Karim laribi', 'karim123', 'karim@gmail.com', 'default', ''),
(5, 'Jessyvalery', 'jessy123', 'jessy@gmail.com', 'default', '');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `follow`
--
ALTER TABLE `follow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `profile_views`
--
ALTER TABLE `profile_views`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
