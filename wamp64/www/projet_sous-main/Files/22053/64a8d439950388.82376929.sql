-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 17 mars 2022 à 09:30
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gestionetudiant`
--

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

DROP TABLE IF EXISTS `etudiant`;
CREATE TABLE IF NOT EXISTS `etudiant` (
  `matricule` int(11) NOT NULL,
  `nom` varchar(20) DEFAULT NULL,
  `filiere` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`matricule`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `etudiant`
--

INSERT INTO `etudiant` (`matricule`, `nom`, `filiere`) VALUES
(21080, 'Oumar', 'RSS'),
(21081, 'Aicha', 'RSS'),
(21082, 'Moussa', 'CNM'),
(21083, 'Cheikh', 'DSI'),
(21084, 'Ahmed', 'CNM'),
(21085, 'Fati', 'DSI'),
(21086, 'Aycha', 'CNM'),
(21087, 'Ahmed', 'CNM'),
(21088, 'Brahim', 'DSI'),
(21089, 'Jeynaba', 'DSI'),
(21090, 'Mariam', 'DSI');

-- --------------------------------------------------------

--
-- Structure de la table `etudiantexamen`
--

DROP TABLE IF EXISTS `etudiantexamen`;
CREATE TABLE IF NOT EXISTS `etudiantexamen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idexamen` int(11) DEFAULT NULL,
  `matricule` int(11) DEFAULT NULL,
  `code` varchar(10) DEFAULT NULL,
  `noteConn` decimal(4,2) DEFAULT NULL,
  `noteComp` decimal(4,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idexamen` (`idexamen`),
  KEY `matricule` (`matricule`),
  KEY `code` (`code`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `etudiantexamen`
--

INSERT INTO `etudiantexamen` (`id`, `idexamen`, `matricule`, `code`, `noteConn`, `noteComp`) VALUES
(1, 10, 21083, 'Dev11', '14.50', '12.50'),
(2, 20, 21083, 'Syr11', '12.50', '10.50'),
(3, 10, 21080, 'Syr11', '17.00', '13.75'),
(5, 10, 21085, 'Dev13', '11.75', '14.50'),
(6, 10, 21086, 'DEV12', '9.25', '9.75'),
(7, 10, 21087, 'DEV12', '15.00', '14.75'),
(8, 30, 21088, 'SYR11', '12.25', '10.75'),
(9, 40, 21089, 'DEV11', '5.25', '6.75'),
(10, 50, 21090, 'DEV13', '5.25', '9.75');

-- --------------------------------------------------------

--
-- Structure de la table `examen`
--

DROP TABLE IF EXISTS `examen`;
CREATE TABLE IF NOT EXISTS `examen` (
  `idexamen` int(11) NOT NULL,
  `semestre` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`idexamen`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `examen`
--

INSERT INTO `examen` (`idexamen`, `semestre`) VALUES
(10, '1'),
(20, '2'),
(30, '1'),
(40, '1'),
(50, '3');

-- --------------------------------------------------------

--
-- Structure de la table `matiere`
--

DROP TABLE IF EXISTS `matiere`;
CREATE TABLE IF NOT EXISTS `matiere` (
  `code` varchar(10) NOT NULL,
  `nom` varchar(20) DEFAULT NULL,
  `credit` int(11) DEFAULT NULL,
  PRIMARY KEY (`code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `matiere`
--

INSERT INTO `matiere` (`code`, `nom`, `credit`) VALUES
('Dev11', 'Algo', 3),
('Dev12', 'Base de Données', 2),
('Dev13', 'Tech Web', 2),
('Syr11', 'BI', 2),
('MAI12', 'Analyse', 3),
('MED11', 'Infographie', 2);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
