-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 23 nov. 2026 à 12:40
-- Version du serveur : 8.4.7
-- Version de PHP : 8.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `pendu`
--

-- --------------------------------------------------------

--
-- Structure de la table `games`
--

DROP TABLE IF EXISTS `games`;
CREATE TABLE IF NOT EXISTS `games` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `word_id` int NOT NULL,
  `difficulty` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` int NOT NULL,
  `victory` int NOT NULL,
  `points` int NOT NULL,
  `created_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `scoreboard`
--

DROP TABLE IF EXISTS `scoreboard`;
CREATE TABLE IF NOT EXISTS `scoreboard` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `difficulty` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `points` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `scoreboard`
--

INSERT INTO `scoreboard` (`id`, `pseudo`, `difficulty`, `points`) VALUES
(1, 'Batman', 'Difficile', 500),
(2, 'Joker', 'Difficile', 450),
(3, 'SpiderMan', 'Difficile', 480),
(4, 'Blob', 'Difficile', 25),
(5, 'JeanDujardin', 'Facile', 140),
(6, 'Moderna', 'Moyen', 740);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL,
  `admin` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `pseudo`, `email`, `password`, `created_at`, `admin`) VALUES
(1, 'Jacque', 'Jacque@gmail', '$2y$10$Q6uLHM4PcZycMaJlkDJC8ucOB5YbJ/kf8Za7RvlWbEjkzGcNvkRzm', '0000-00-00 00:00:00', 0),
(2, 'Antonin', 'Antonin@gmail', '$2y$10$3I5ONdxo./LovyzogaZE8u4VEFfOFFTXmqPQ6p1LohFFAagl/Vyza', '0000-00-00 00:00:00', 0),
(3, 'halo', 'halo@gmail', '$2y$10$gEbqWDLSNd5yJBXgbSb8u.Mmyc6tqhSgkMw7WMnLnYmHPw2XjrEcW', '0000-00-00 00:00:00', 0),
(5, 'admin', 'admin@gmail', '$2y$10$iuRLYdUqJ6DLHyJBSGne6eOVPy4s854ILY3IsCwsWRqG5NCH4Hulm', '0000-00-00 00:00:00', 0),
(6, 'dieu', 'dieu@gmail', '$2y$10$iuRLYdUqJ6DLHyJBSGne6eOVPy4s854ILY3IsCwsWRqG5NCH4Hulm', '2026-11-13 11:45:40', 1),
(7, 'titou', 'titou@gmail', '$2y$10$iRBc5TN3kyLW1CFhNhr0S.eOhz1V4h2BbdGn4QyoyisUPjE.0YnRy', '0000-00-00 00:00:00', 0),
(8, 'tatou', 'tatou@gmail', '$2y$10$Csm3PDYEYw7/X.5S3jeWq.cipmcZ./4T69sbDuU9aK7yEc5Cixgwm', '0000-00-00 00:00:00', 0),
(9, 'gra', 'gra@gmail', '$2y$10$pHu1i97wfHZ1MDZBQ/w.HeoGovuCaMeVlsVzHL.tVArCO4Ldhywma', '0000-00-00 00:00:00', 0),
(10, 'tati', 'tati@gmail', '$2y$10$xQntrrtbcO1SHmfq1VCPcON9DuzQbzshDKdP0ZuGOhXzOrPhJLhny', '0000-00-00 00:00:00', 0),
(11, 'fra', 'fra@gmail', '$2y$10$w/o3CSHC4L39jD5QiTSghOr.61yppLJlVWAVfJl9./5L0l7m3vgl.', '0000-00-00 00:00:00', 0),
(12, 'tank', 'tank@gmail', '$2y$10$mX93LXYwAKDwLQx2f5m/seKSGNb0RTboKyqzFfs7o.vH50iQPjhzq', '0000-00-00 00:00:00', 0),
(13, 'tH', 'TH@gmail', '$2y$10$IOYeVu5L5l8W08t1Na6DFuzIcuQgnpe6epSUMLPKYVR26nTVRfg3.', '0000-00-00 00:00:00', 0),
(14, 'tati', 'tati@gmail', '$2y$10$nuC53dmwn1NDoxejV38ptel/YfAavxo2DisxeT44WY4HsBHGNEuPm', '0000-00-00 00:00:00', 0),
(15, 'tou', 'tout@sdd', '$2y$10$UkA1PwWOXcE/sY.9IYZVsemjByB/ccqq/geNslx5mj3AhhwOfx85.', '0000-00-00 00:00:00', 0),
(16, 'jean', 'jean@dz', '$2y$10$VL2cmX7GxonxERrHNouXMu8ZadZ2DatlhVesat.HNKn1paqlCY0sC', '0000-00-00 00:00:00', 0),
(17, 'erg', 'erg@erg', '$2y$10$.7kWzTNG1yzk4zAqkqpPjuqvG23Y9iWn3noEp/Nh/KT7W1M6tzRxq', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Structure de la table `words`
--

DROP TABLE IF EXISTS `words`;
CREATE TABLE IF NOT EXISTS `words` (
  `id` int NOT NULL AUTO_INCREMENT,
  `word` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `difficulty` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `theme` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `word_point` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `words`
--

INSERT INTO `words` (`id`, `word`, `difficulty`, `theme`, `word_point`) VALUES
(1, 'goron', 'medium', 'zelda', 10),
(2, 'link', 'easy', 'zelda', 3),
(3, 'link', 'medium', 'zelda', 5),
(4, 'ganondorf', 'hard', 'zelda', 0),
(5, 'impa', 'medium', 'zelda', 0),
(6, 'tingle', 'medium', 'zelda', 0),
(7, 'epona', 'medium', 'zelda', 0),
(8, 'triforce', 'easy', 'zelda', 0),
(9, 'Bedrock', 'easy', 'minecraft', 50),
(10, 'Steve', 'hard', 'minecraft', 40),
(11, 'Arcane', 'easy', 'endfield', 10),
(12, 'rossi', 'easy', 'endfield', 0),
(13, 'Alesh', 'medium', 'endfield', 40),
(14, 'estella', 'medium', 'endfield', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
