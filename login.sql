-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 05 juil. 2024 à 21:20
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `login`
--

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `comments`
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
(19, 24, 2, '@islamputh ', '2024-07-05 20:19:29');

-- --------------------------------------------------------

--
-- Structure de la table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `posts`
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
(24, 2, 'this will contain comments', '2024-07-05 17:37:47');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(5) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`) VALUES
(1, 'islam', 'islama', 'islamputh@gmail.com'),
(2, 'islamputh', 'islam123', 'islamhamdaoui@gmail.com'),
(3, 'rayan mazouni', 'rayan123', 'rayan@gmail.com');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
