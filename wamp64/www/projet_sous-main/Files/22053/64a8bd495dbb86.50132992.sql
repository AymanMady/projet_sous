-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 08 juil. 2023 à 01:24
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
-- Structure de la table `enseignant`
--

CREATE TABLE `enseignant` (
  `id_ens` int(10) NOT NULL,
  `nom` varchar(60) DEFAULT NULL,
  `prenom` varchar(60) DEFAULT NULL,
  `Date_naiss` date DEFAULT NULL,
  `lieu_naiss` varchar(30) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `num_tel` int(20) DEFAULT NULL,
  `num_whatsapp` int(20) DEFAULT NULL,
  `diplome` varchar(20) DEFAULT NULL,
  `grade` varchar(20) DEFAULT NULL,
  `id_role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `enseignant`
--

INSERT INTO `enseignant` (`id_ens`, `nom`, `prenom`, `Date_naiss`, `lieu_naiss`, `email`, `num_tel`, `num_whatsapp`, `diplome`, `grade`, `id_role`) VALUES
(1, 'Cheikh', 'Dhib', '1983-01-22', 'nktt', 'cheikh.dhib@supnum.mr', NULL, NULL, 'doctor', 'directeur', 2),
(2, 'Moussa', 'Demba', '1989-10-12', 'nkt', 'moussa.demba@supnum.mr', NULL, NULL, 'doctor', 'directeur adjoint', 2),
(3, 'Meya', 'Haroune', '1993-06-22', 'nktt', 'meya.haroune@supnum.mr', NULL, NULL, 'doctor', 'prof', 2),
(4, 'Sidi', 'Mohamed', '1995-10-27', 'Rosso', 'sidi.med@supnum.mr', NULL, NULL, 'doctor', 'maître assistant', 2),
(5, 'Aicha', 'Bobakar', '1991-12-07', 'nkt', 'aicha.bobakar@supnum.mr', NULL, NULL, 'doctor', 'maître assistant', 2),
(6, 'Mariem', 'Bellal', '1988-12-17', 'nktt', 'mariem.bellal@supnum.mr', NULL, NULL, 'master', 'maître assistant', 2),
(7, 'ahmed', 'oumar', '1990-03-15', 'nktt', 'ahmed.oumar@supnum.mr', NULL, NULL, 'master', 'prof', 2),
(8, 'fatim', 'sidi', '1985-07-10', 'nktt', 'fatim.sidi@supnum.mr', NULL, NULL, 'doctor', 'prof', 2),
(9, 'mohamed', 'ali', '1992-09-05', 'nktt', 'mohamed.ali@supnum.mr', NULL, NULL, 'doctor', 'prof', 2),
(10, 'asma', 'oussama', '1995-04-25', 'Aion', 'asma.oussama@supnum.mr', NULL, NULL, 'master', 'maître assistant', 2),
(11, 'issouf', 'hamid', '1991-11-09', 'nktt', 'issouf.hamid@supnum.mr', NULL, NULL, 'doctor', 'maître assistant', 2),
(12, 'khadija', 'mohamed', '1987-08-03', 'nktt', 'khadija.mohamed@supnum.mr', NULL, NULL, 'doctor', 'prof', 2),
(13, 'ali', 'amine', '1994-02-18', 'nkt', 'ali.amine@supnum.mr', NULL, NULL, 'doctor', 'prof', 2),
(14, 'souad', 'abdou', '1996-05-30', 'nkt', 'souad.abdou@supnum.mr', NULL, NULL, 'doctor', 'prof', 2),
(15, 'ibrahim', 'khalil', '1984-09-02', 'nkt', 'ibrahim.khalil@supnum.mr', NULL, NULL, 'master', 'maître assistant', 2),
(16, 'salma', 'ahmed', '1986-06-28', 'nkt', 'salma.ahmed@supnum.mr', NULL, NULL, 'doctor', 'prof', 2),
(17, 'Oumar', 'Abdoulaye', '1990-07-15', 'Nouakchott', 'oumar.abdoulaye@supnum.mr', NULL, NULL, 'doctor', 'maître assistant', 2),
(18, 'Mariem', 'Ahmed', '1988-05-19', 'Nouadhibou', 'mariem.ahmed@supnum.mr', NULL, NULL, 'master', 'prof', 2),
(19, 'Khalifa', 'Mohamed', '1993-02-25', 'Rosso', 'khalifa.mohamed@supnum.mr', NULL, NULL, 'doctor', 'prof', 2),
(20, 'Aissatou', 'Mohamed', '1991-12-09', 'Nouakchott', 'aissatou.mohamed@supnum.mr', NULL, NULL, 'doctor', 'maître assistant', 2),
(21, 'Ahmed', 'Salem', '1987-10-27', 'Kaédi', 'ahmed.salem@supnum.mr', NULL, NULL, 'master', 'maître assistant', 2),
(22, 'Khadijetou', 'Ali', '1995-04-03', 'Nouakchott', 'khadijetou.ali@supnum.mr', NULL, NULL, 'doctor', 'prof', 2),
(23, 'Abdallahi', 'Fatimetou', '1986-08-18', 'Nouadhibou', 'abdallahi.fatimetou@supnum.mr', NULL, NULL, 'doctor', 'maître assistant', 2),
(24, 'Sidi', 'Mamadou', '1992-06-22', 'Nouakchott', 'sidi.mamadou@supnum.mr', NULL, NULL, 'doctor', 'directeur', 2),
(25, 'Hawa', 'Mohamed', '1989-04-09', 'Kaédi', 'hawa.mohamed@supnum.mr', NULL, NULL, 'doctor', 'maître assistant', 2),
(26, 'Moulaye', 'Sidi', '1994-12-17', 'Rosso', 'moulaye.sidi@supnum.mr', NULL, NULL, 'doctor', 'maître assistant', 2),
(27, 'Salem', 'Aicha', '1985-09-05', 'Nouakchott', 'salem.aicha@supnum.mr', NULL, NULL, 'master', 'maître assistant', 2),
(28, 'Mariem', 'Ahmed', '1991-07-10', 'Nouadhibou', 'mariem.ahmed@supnum.mr', NULL, NULL, 'doctor', 'prof', 2),
(29, 'Mohamed', 'Khalil', '1988-05-30', 'Nouakchott', 'mohamed.khalil@supnum.mr', NULL, NULL, 'master', 'prof', 2),
(30, 'Aminetou', 'Mohamed', '1996-03-12', 'Rosso', 'aminetou.mohamed@supnum.mr', NULL, NULL, 'doctor', 'maître assistant', 2),
(31, 'Abderrahmane', 'Salem', '1990-09-18', 'Nouakchott', 'abderrahmane.salem@supnum.mr', NULL, NULL, 'doctor', 'maître assistant', 2),
(32, 'Fatimetou', 'Ali', '1987-06-23', 'Nouadhibou', 'fatimetou.ali@supnum.mr', NULL, NULL, 'doctor', 'prof', 2),
(33, 'Mamadou', 'Sidi', '1993-04-10', 'Nouakchott', 'mamadou.sidi@supnum.mr', NULL, NULL, 'master', 'prof', 2),
(34, 'Hawa', 'Mohamed', '1989-02-15', 'Kaédi', 'hawa.mohamed@supnum.mr', NULL, NULL, 'doctor', 'maître assistant', 2),
(35, 'Salem', 'Aicha', '1986-08-08', 'Nouakchott', 'salem.aicha@supnum.mr', NULL, NULL, 'master', 'maître assistant', 2);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `enseignant`
--
ALTER TABLE `enseignant`
  ADD PRIMARY KEY (`id_ens`),
  ADD KEY `id_role` (`id_role`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `enseignant`
--
ALTER TABLE `enseignant`
  MODIFY `id_ens` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `enseignant`
--
ALTER TABLE `enseignant`
  ADD CONSTRAINT `enseignant_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
