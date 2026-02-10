-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 21 jan. 2026 à 10:23
-- Version du serveur : 8.2.0
-- Version de PHP : 8.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `mini_projet_php`
--
CREATE DATABASE IF NOT EXISTS `mini_projet_php` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `mini_projet_php`;

-- --------------------------------------------------------

--
-- Structure de la table `langue`
--

DROP TABLE IF EXISTS `langue`;
CREATE TABLE IF NOT EXISTS `langue` (
  `code_langue` char(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `design_langue` varchar(8) NOT NULL,
  PRIMARY KEY (`code_langue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `langue`
--

INSERT INTO `langue` (`code_langue`, `design_langue`) VALUES
('Ar', 'Arabe'),
('Fr', 'Français');

-- --------------------------------------------------------

--
-- Structure de la table `langue_stagiaire`
--

DROP TABLE IF EXISTS `langue_stagiaire`;
CREATE TABLE IF NOT EXISTS `langue_stagiaire` (
  `code_langue` char(2) NOT NULL,
  `code_stag` smallint NOT NULL,
  PRIMARY KEY (`code_langue`,`code_stag`),
  KEY `fk_langueStagiaire_stagiaire` (`code_stag`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `langue_stagiaire`
--

INSERT INTO `langue_stagiaire` (`code_langue`, `code_stag`) VALUES
('Fr', 1),
('Ar', 23),
('Ar', 54),
('Ar', 113),
('Fr', 113);

-- --------------------------------------------------------

--
-- Structure de la table `niveaux`
--

DROP TABLE IF EXISTS `niveaux`;
CREATE TABLE IF NOT EXISTS `niveaux` (
  `design_niv` char(3) NOT NULL,
  PRIMARY KEY (`design_niv`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `niveaux`
--

INSERT INTO `niveaux` (`design_niv`) VALUES
('2AS');

-- --------------------------------------------------------

--
-- Structure de la table `specialite`
--

DROP TABLE IF EXISTS `specialite`;
CREATE TABLE IF NOT EXISTS `specialite` (
  `code_spec` char(7) NOT NULL,
  `design_spec` varchar(30) NOT NULL,
  PRIMARY KEY (`code_spec`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `specialite`
--

INSERT INTO `specialite` (`code_spec`, `design_spec`) VALUES
('INF0701', 'Exploitant Informatique'),
('INF0705', 'Développement web et multimédi');

-- --------------------------------------------------------

--
-- Structure de la table `stagiaire`
--

DROP TABLE IF EXISTS `stagiaire`;
CREATE TABLE IF NOT EXISTS `stagiaire` (
  `num_stag` smallint NOT NULL,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `date_nais` date NOT NULL,
  `sexe` char(1) NOT NULL,
  `design_niv` char(3) NOT NULL,
  `adresse` varchar(150) NOT NULL,
  `code_spec` char(7) DEFAULT NULL,
  PRIMARY KEY (`num_stag`),
  KEY `fk_stagiaire_niveau` (`design_niv`),
  KEY `fk_stagiaire_specialite` (`code_spec`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `stagiaire`
--

INSERT INTO `stagiaire` (`num_stag`, `nom`, `prenom`, `date_nais`, `sexe`, `design_niv`, `adresse`, `code_spec`) VALUES
(1, 'Sabo', 'Ibrahim', '2010-01-01', 'M', '2AS', 'jijel algerie', 'INF0701'),
(23, 'KALI', 'Samira', '1993-03-13', 'F', '2AS', 'Tazmalt', 'INF0701'),
(54, 'FADI', 'Fatiha', '1992-02-10', 'F', '2AS', 'Akbou', 'INF0701'),
(113, 'SALI', 'Ali', '1990-01-11', 'M', '2AS', 'Seddouk', 'INF0701');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `langue_stagiaire`
--
ALTER TABLE `langue_stagiaire`
  ADD CONSTRAINT `fk_langueStagiaire_langue` FOREIGN KEY (`code_langue`) REFERENCES `langue` (`code_langue`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_langueStagiaire_stagiaire` FOREIGN KEY (`code_stag`) REFERENCES `stagiaire` (`num_stag`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Contraintes pour la table `stagiaire`
--
ALTER TABLE `stagiaire`
  ADD CONSTRAINT `fk_stagiaire_niveau` FOREIGN KEY (`design_niv`) REFERENCES `niveaux` (`design_niv`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_stagiaire_specialite` FOREIGN KEY (`code_spec`) REFERENCES `specialite` (`code_spec`) ON DELETE RESTRICT ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
