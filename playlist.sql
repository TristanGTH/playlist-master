-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 18 mai 2020 à 21:41
-- Version du serveur :  5.7.26
-- Version de PHP :  7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `playlist`
--

-- --------------------------------------------------------

--
-- Structure de la table `albums`
--

DROP TABLE IF EXISTS `albums`;
CREATE TABLE IF NOT EXISTS `albums` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `year` int(11) DEFAULT NULL,
  `artist_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `albums`
--

INSERT INTO `albums` (`id`, `name`, `year`, `artist_id`) VALUES
(1, 'Lucky Jim', 1993, 6),
(5, 'Fire of Love', 2016, 69),
(8, 'The Doors', 1967, 15),
(10, 'The Stooges', NULL, 6),
(13, 'Funhouse', 1970, 3),
(42, 'Brothers In Arms', 1985, 42),
(49, 'Dire Straits', 1978, 42),
(69, 'Doolittle', 1989, 54),
(70, 'deux frere', 2016, 6),
(100, 'Non Renseigné', NULL, NULL),
(102, 'test', 2016, 103);

-- --------------------------------------------------------

--
-- Structure de la table `artists`
--

DROP TABLE IF EXISTS `artists`;
CREATE TABLE IF NOT EXISTS `artists` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `biography` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `label_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `label_link` (`label_id`)
) ENGINE=InnoDB AUTO_INCREMENT=104 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `artists`
--

INSERT INTO `artists` (`id`, `name`, `biography`, `image`, `label_id`) VALUES
(6, 'Pink Floyd', '                                                                                                                                            ', NULL, 2),
(8, 'Dragonforce', '                                                                                                    ', NULL, 1),
(9, 'Elton John', '    aaaaaaa                ', NULL, 1),
(100, 'Non renseigné', '', NULL, 100),
(103, 'testImage', '                    ', '103.png', 100);

-- --------------------------------------------------------

--
-- Structure de la table `labels`
--

DROP TABLE IF EXISTS `labels`;
CREATE TABLE IF NOT EXISTS `labels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `labels`
--

INSERT INTO `labels` (`id`, `name`) VALUES
(1, 'Sony Music'),
(2, 'Universal Music'),
(100, 'Non renseigné');

-- --------------------------------------------------------

--
-- Structure de la table `songs`
--

DROP TABLE IF EXISTS `songs`;
CREATE TABLE IF NOT EXISTS `songs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `artist_id` int(11) DEFAULT NULL,
  `album_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `songs`
--

INSERT INTO `songs` (`id`, `title`, `artist_id`, `album_id`) VALUES
(3, 'I Wanna Be Your Dog', 100, 10),
(4, 'She\'s like Heroin to Me', 100, 5),
(5, 'Gouge Away', 100, 69),
(6, 'Money for Nothing', 100, 42),
(7, 'Break on Through (To the other side)', 100, 8),
(8, 'Hey', 100, 69),
(9, 'Sex Beat', 100, 5),
(10, 'Sultans Of Swing', 100, 49),
(16, 'Soldier of the Wastelands', 8, 100),
(17, 'Heroes of our time', 8, 100),
(19, 'aaaaaa', 103, 102);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `artists`
--
ALTER TABLE `artists`
  ADD CONSTRAINT `label_link` FOREIGN KEY (`label_id`) REFERENCES `labels` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
