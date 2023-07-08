-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 07 juil. 2023 à 14:42
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `pi`
--

-- --------------------------------------------------------

--
-- Structure de la table `soumission`
--

CREATE TABLE `soumission` (
  `id_sous` int(10) NOT NULL,
  `titre_sous` varchar(50) DEFAULT NULL,
  `description_sous` varchar(50) DEFAULT NULL,
  `id_ens` int(10) DEFAULT NULL,
  `date_debut` datetime NOT NULL,
  `date_fin` datetime NOT NULL,
  `valide` tinyint(1) DEFAULT NULL,
  `status` int(5) DEFAULT 0,
  `id_matiere` int(10) DEFAULT NULL,
  `id_type_sous` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `soumission`
--

INSERT INTO `soumission` (`titre_sous`, `description_sous`, `id_ens`, `date_debut`, `date_fin`, `valide`, `status`, `id_matiere`, `id_type_sous`) VALUES
('TP Notee', 'TP note', 2, '2023-06-22 13:06:00', '2023-07-07 13:12:00', 0, 0, 1, 3),
('Titre', 'Examen', 2, '2023-07-06 19:04:00', '2023-08-03 19:06:00', 0, 0, 95, 1),
('Devoir', 'Description', 4, '2023-07-07 12:19:00', '2023-08-06 17:20:00', 0, 0, 4, 2),
('Examen Web', 'Description', 4, '2023-07-07 12:22:00', '2023-08-05 17:23:00', 0, 0, 3, 1),
('TP', 'Description', 4, '2023-07-07 12:22:00', '2023-08-06 12:24:00', 0, 0, 4, 3),
('Devoir', 'Description', 4, '2023-07-07 12:24:00', '2023-08-06 12:26:00', 0, 0, 5, 2),
('Examen', 'Description', 4, '2023-07-07 12:26:00', '2023-08-06 12:29:00', 0, 0, 5, 1),
('TP', 'Description', 4, '2023-07-07 12:27:00', '2023-08-06 12:28:00', 0, 0, 5, 3),
('Devoir', 'Description', 4, '2023-07-07 12:29:00', '2023-08-06 17:30:00', 0, 0, 32, 2),
('TP', 'Description', 4, '2023-07-07 12:29:00', '2023-08-06 12:38:00', 0, 0, 32, 3),
('Examen', 'Description', 4, '2023-07-07 12:31:00', '2023-08-06 12:33:00', 0, 0, 32, 1),
('Devoir', 'Description', 4, '2023-07-07 12:34:00', '2023-08-06 12:35:00', 0, 0, 33, 2),
('TP', 'Description', 4, '2023-07-07 12:35:00', '2023-08-06 12:36:00', 0, 0, 33, 3),
('Examen', 'Description', 4, '2023-07-07 12:36:00', '2023-07-29 12:37:00', 0, 0, 33, 1),
('Devoir', 'Description', 4, '2023-07-07 12:36:00', '2023-08-06 12:38:00', 0, 0, 49, 2),
('TP', 'Description', 4, '2023-07-07 12:36:00', '2023-08-05 12:38:00', 0, 0, 49, 3),
('Examen', 'Description', 4, '2023-07-07 12:39:00', '2023-08-06 17:40:00', 0, 0, 49, 1),
('Examen', 'Description', 4, '2023-07-07 12:39:00', '2023-08-06 17:40:00', 0, 0, 49, 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `soumission`
--
ALTER TABLE `soumission`
  ADD PRIMARY KEY (`id_sous`),
  ADD KEY `id_matiere` (`id_matiere`),
  ADD KEY `id_ens` (`id_ens`),
  ADD KEY `id_type_sous` (`id_type_sous`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `soumission`
--
ALTER TABLE `soumission`
  MODIFY `id_sous` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `soumission`
--
ALTER TABLE `soumission`
  ADD CONSTRAINT `soumission_ibfk_1` FOREIGN KEY (`id_matiere`) REFERENCES `matiere` (`id_matiere`),
  ADD CONSTRAINT `soumission_ibfk_2` FOREIGN KEY (`id_ens`) REFERENCES `enseignant` (`id_ens`),
  ADD CONSTRAINT `soumission_ibfk_3` FOREIGN KEY (`id_type_sous`) REFERENCES `type_soumission` (`id_type_sous`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
