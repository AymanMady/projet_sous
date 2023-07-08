-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 20 juin 2023 à 02:27
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.0.25

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
-- Structure de la table `etudiant`
--

CREATE TABLE `etudiant` (
  `id_etud` int(10) NOT NULL,
  `matricule` varchar(50) NOT NULL,
  `nom` varchar(60) DEFAULT NULL,
  `prenom` varchar(60) DEFAULT NULL,
  `lieu_naiss` varchar(100) DEFAULT NULL,
  `Date_naiss` date DEFAULT NULL,
  `id_semestre` int(10) DEFAULT NULL,
  `annee` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `id_role` int(11) NOT NULL,
  `id_groupe` int(10) DEFAULT NULL,
  `id_sous` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `etudiant`
--

INSERT INTO `etudiant` (`id_etud`, `matricule`, `nom`, `prenom`, `lieu_naiss`, `Date_naiss`, `id_semestre`, `annee`, `email`, `id_role`, `id_groupe`, `id_sous`) VALUES
(1, '22053', 'abderahman', 'abderahman', 'nkt', '2023-05-11', 2, '2023', '22053@supnum.mr', 3, NULL, NULL),
(2, '22014', 'Bechir', 'Mady', 'nkt', '2023-05-17', 2, '2023', '22014@supnum.mr', 3, NULL, NULL),
(3, '22018', 'souleyman', 'baba', 'nkt', '2023-05-25', 2, '2023', '22018@supnum.mr', 3, NULL, NULL),
(30, '21001', 'Cheikh Ahmed', 'Mohamed Ahmed', 'Nouakchott', '1997-01-05', 2, '2023', '21001@supnum.mr', 3, 1, NULL),
(31, '21003', 'Touba', 'Yarahallah', 'Nouadhibou', '1998-03-15', 4, '2023', '21003@supnum.mr', 3, 2, NULL),
(32, '21004', 'Mohamed Youssef', 'Abdelbarka', 'Nouakchott', '1999-05-25', 3, '2023', '21004@supnum.mr', 3, 3, NULL),
(33, '21008', 'Rakiea', 'Dhah', 'Atar', '2000-07-10', 1, '2023', '21008@supnum.mr', 3, 1, NULL),
(34, '21010', 'Esmaou', 'Vall', 'Kaédi', '1997-09-20', 5, '2023', '21010@supnum.mr', 3, 2, NULL),
(35, '21011', 'Mohamed Lemine', 'Taleb Ahmed', 'Nouakchott', '1998-11-05', 3, '2023', '21011@supnum.mr', 3, 3, NULL),
(36, '21012', 'Ahlam', 'Abdel Kader', 'Nouadhibou', '1999-12-15', 2, '2023', '21012@supnum.mr', 3, 1, NULL),
(37, '21014', 'Taleb', 'Bahan', 'Nouakchott', '2001-02-28', 4, '2023', '21014@supnum.mr', 3, 2, NULL),
(38, '21016', 'Khadijetou', 'Abdel Ghader', 'Rosso', '1997-04-10', 3, '2023', '21016@supnum.mr', 3, 3, NULL),
(39, '21017', 'Bedra', 'Deddy', 'Nouadhibou', '1998-05-25', 1, '2023', '21017@supnum.mr', 3, 1, NULL),
(40, '21018', 'Mohamed', 'Ejelal', 'Nouakchott', '1999-07-10', 5, '2023', '21018@supnum.mr', 3, 2, NULL),
(41, '21019', 'Fatimetou', 'Dah', 'Nouadhibou', '2000-08-25', 2, '2023', '21019@supnum.mr', 3, 3, NULL),
(42, '21020', 'Ahmed', 'Sejad', 'Nouakchott', '1997-10-10', 4, '2023', '21020@supnum.mr', 3, 1, NULL),
(43, '21021', 'El Moukhtar', 'DMeiss', 'Nouakchott', '1998-11-15', 5, '2023', '21021@supnum.mr', 3, 2, NULL),
(44, '21022', 'Sidi Abdoullah', 'Mehdi', 'Nouadhibou', '1999-12-25', 2, '2023', '21022@supnum.mr', 3, 3, NULL),
(45, '21024', 'Cheikh Elhdrami', 'Begnoug', 'Atar', '2000-02-10', 3, '2023', '21024@supnum.mr', 3, 1, NULL),
(46, '21027', 'Khadigetou', 'Mohamed Mewloud', 'Nouakchott', '1997-04-25', 4, '2023', '21027@supnum.mr', 3, 2, NULL),
(47, '21028', 'Fatimetou', 'El Alem', 'Nouadhibou', '1998-06-10', 1, '2023', '21028@supnum.mr', 3, 3, NULL),
(48, '21029', 'Sidi', 'Ebeidi', 'Nouakchott', '1999-07-25', 5, '2023', '21029@supnum.mr', 3, 1, NULL),
(49, '21030', 'Aicha', 'Moussa', 'Nouadhibou', '2000-09-10', 2, '2023', '21030@supnum.mr', 3, 2, NULL),
(50, '21031', 'Sidi El Valy', 'SidElemine', 'Nouakchott', '1997-11-15', 3, '2023', '21031@supnum.mr', 3, 3, NULL),
(51, '21032', 'Oum Elvadhli', 'Cheikh', 'Nouadhibou', '1998-12-25', 4, '2023', '21032@supnum.mr', 3, 1, NULL),
(52, '21033', 'Lalla', 'Ebety', 'Nouakchott', '1999-02-10', 1, '2023', '21033@supnum.mr', 3, 2, NULL),
(53, '21038', 'El Vaghih', 'Zeine', 'Nouadhibou', '2000-03-25', 5, '2023', '21038@supnum.mr', 3, 3, NULL),
(54, '21040', 'Abdoulaye', 'Ba', 'Nouakchott', '1997-05-10', 2, '2023', '21040@supnum.mr', 3, 1, NULL),
(55, '21041', 'Mariem', 'Dahi', 'Nouakchott', '1998-05-11', 3, '2023', '21041@supnum.mr', 3, 1, NULL),
(56, '21042', 'Zeinebou', 'Lebchir', 'Nouadhibou', '1999-05-17', 4, '2023', '21042@supnum.mr', 3, 2, NULL),
(57, '21043', 'Mohamed Vall', 'Mohameden Vall', 'Atar', '2000-05-25', 1, '2023', '21043@supnum.mr', 3, 3, NULL),
(58, '21045', 'Rougha', 'Amar Salem', 'Nouakchott', '1997-06-11', 2, '2023', '21045@supnum.mr', 3, 1, NULL),
(59, '21046', 'Zeinebou', 'El Ghellawi', 'Nouadhibou', '1998-06-17', 3, '2023', '21046@supnum.mr', 3, 2, NULL),
(60, '21047', 'Djilitt', 'Abdellahi', 'Nouakchott', '1999-06-25', 5, '2023', '21047@supnum.mr', 3, 3, NULL),
(61, '21050', 'Aicha', 'Chrif Bou Ghouba', 'Nouadhibou', '2000-07-11', 4, '2023', '21050@supnum.mr', 3, 1, NULL),
(62, '21051', 'Fatimetou', 'Abdel Haye', 'Nouakchott', '1997-07-17', 1, '2023', '21051@supnum.mr', 3, 2, NULL),
(63, '21052', 'Ghlana', 'Mohamed Habib', 'Nouadhibou', '1998-07-25', 3, '2023', '21052@supnum.mr', 3, 3, NULL),
(64, '21053', 'Imane', 'Hmeyada', 'Nouakchott', '1999-08-11', 5, '2023', '21053@supnum.mr', 3, 1, NULL),
(65, '21054', 'Mariem', 'SidAhmed Taleb', 'Nouadhibou', '2000-08-17', 2, '2023', '21054@supnum.mr', 3, 2, NULL),
(66, '21055', 'Cherifa', 'Beillahi', 'Nouakchott', '1997-08-25', 4, '2023', '21055@supnum.mr', 3, 3, NULL),
(67, '21056', 'Bouchra', 'Ahmed Ramdhane', 'Nouadhibou', '1998-09-11', 1, '2023', '21056@supnum.mr', 3, 1, NULL),
(68, '21059', 'Mariem', 'Afou', 'Nouakchott', '1999-09-17', 3, '2023', '21059@supnum.mr', 3, 2, NULL),
(69, '21060', 'Tekeiber', 'Bah', 'Nouadhibou', '2000-09-25', 5, '2023', '21060@supnum.mr', 3, 3, NULL),
(70, '21061', 'Abderrahmane', 'Nanne Mohamed', 'Nouakchott', '1997-10-11', 4, '2023', '21061@supnum.mr', 3, 1, NULL),
(71, '21062', 'Oumou', 'Ba', 'Nouadhibou', '1998-10-17', 2, '2023', '21062@supnum.mr', 3, 2, NULL),
(72, '21063', 'Aicha', 'Fadel', 'Nouakchott', '1999-10-25', 3, '2023', '21063@supnum.mr', 3, 3, NULL),
(73, '21064', 'Soumeya', 'Ebi El Maaly', 'Nouadhibou', '2000-11-11', 5, '2023', '21064@supnum.mr', 3, 1, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD PRIMARY KEY (`id_etud`),
  ADD UNIQUE KEY `matricule` (`matricule`),
  ADD KEY `id_semestre` (`id_semestre`),
  ADD KEY `id_role` (`id_role`),
  ADD KEY `id_groupe` (`id_groupe`),
  ADD KEY `id_sous` (`id_sous`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `etudiant`
--
ALTER TABLE `etudiant`
  MODIFY `id_etud` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD CONSTRAINT `etudiant_ibfk_1` FOREIGN KEY (`id_semestre`) REFERENCES `semestre` (`id_semestre`),
  ADD CONSTRAINT `etudiant_ibfk_2` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`),
  ADD CONSTRAINT `etudiant_ibfk_3` FOREIGN KEY (`id_groupe`) REFERENCES `groupe` (`id_groupe`),
  ADD CONSTRAINT `etudiant_ibfk_4` FOREIGN KEY (`id_sous`) REFERENCES `soumission` (`id_sous`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
