-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : mar. 13 juin 2023 à 13:09
-- Version du serveur : 5.7.39
-- Version de PHP : 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `moduleconnexion`
--

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `login`, `prenom`, `nom`, `password`) VALUES
(1, 'admin', 'admin', 'admin', 'admin'),
(2, 'Crâne d\'oeuf', 'Hercule', 'Poirot', '$2y$10$U08vEIuGvJy/PuVGJyrg5OaY5HU8tz4SpAGngfBueF1ExOt3fBNsC'),
(3, 'Plume', 'Arianne', 'Oliver', '$2y$10$eTGC3T0Kp3ln9PZw3tBte.U8d7cdyfCDJFxicrvf8oQ8G2npJ386W'),
(6, 'Capitaine', 'Arthur', 'Hastings', '$2y$10$KLthRyPH1hWkpV/z1wVLJu0xqZs0mwioZVWK2SxMDa9LfdXpzyCVC'),
(7, 'Inspecteur', 'James', 'Japp', '$2y$10$q5wJ4NRSrk9SWe3wn7Crfu2TSGBtgkHNhhMIgu/n9ZVLCPs1rpoCi'),
(8, 'lemon', 'lemon', 'Lemon', '$2y$10$j3vEWK5KmQva8ifCub36RuoeQBptMiVY3biMvbNlxBqGz1qSH9l2O');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
