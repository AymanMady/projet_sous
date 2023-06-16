-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 03, 2023 at 11:37 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pi`
--

-- --------------------------------------------------------

--
-- Table structure for table `appartient`
--

CREATE TABLE `appartient` (
  `id_etud` int(10) DEFAULT NULL,
  `id_groupe` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `devoir`
--

CREATE TABLE `devoir` (
  `id_devoir` int(10) NOT NULL,
  `matiere` varchar(50) DEFAULT NULL,
  `type_devoir` varchar(50) DEFAULT NULL,
  `data_devoir` longblob DEFAULT NULL,
  `date_devoir` date DEFAULT NULL,
  `id_sous` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `enseignant`
--

CREATE TABLE `enseignant` (
  `id_ens` int(10) NOT NULL,
  `code` int(10) DEFAULT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(60) DEFAULT NULL,
  `Date_naiss` date DEFAULT NULL,
  `lieu_naiss` varchar(30) DEFAULT NULL,
  `login` varchar(100) DEFAULT NULL,
  `pwd` varchar(20) DEFAULT NULL,
  `id_role` int(11) NOT NULL,
  `active` tinyint(1) DEFAULT 0,
  `id_sous` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enseignant`
--

INSERT INTO `enseignant` (`id_ens`, `code`, `nom`, `prenom`, `Date_naiss`, `lieu_naiss`, `login`, `pwd`, `id_role`, `active`, `id_sous`) VALUES
(2, 221, 'ayman', 'ali', '2022-10-10', 'nkt', 'bechirmady543@gmail.com', 'eehrwry', 1, 0, NULL),
(3, 22014, 'bechir', 'mady', '0000-00-00', '12-31-03', '22014@supnum.mr', 'hfsdfghjk', 12, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `enseigner`
--

CREATE TABLE `enseigner` (
  `id_matiere` int(10) DEFAULT NULL,
  `id_ens` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ens_devoir`
--

CREATE TABLE `ens_devoir` (
  `id_ens` int(10) DEFAULT NULL,
  `id_devoir` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ens_examen`
--

CREATE TABLE `ens_examen` (
  `id_ens` int(10) DEFAULT NULL,
  `id_examen` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `etudiant`
--

CREATE TABLE `etudiant` (
  `id_etud` int(10) NOT NULL,
  `matricule` int(20) NOT NULL,
  `nom` varchar(100) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `lieu_naiss` varchar(100) DEFAULT NULL,
  `Date_naiss` date DEFAULT NULL,
  `semestre` varchar(50) DEFAULT NULL,
  `annee` varchar(50) DEFAULT NULL,
  `login` varchar(100) DEFAULT NULL,
  `pwd` varchar(20) DEFAULT NULL,
  `id_role` int(11) NOT NULL,
  `active` tinyint(1) DEFAULT 0,
  `id_sous` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `etudiant`
--

INSERT INTO `etudiant` (`id_etud`, `matricule`, `nom`, `prenom`, `lieu_naiss`, `Date_naiss`, `semestre`, `annee`, `login`, `pwd`, `id_role`, `active`, `id_sous`) VALUES
(1, 22014, 'ayman', 'mady', 'nouakchott', '2023-05-01', '2', '2022', '22014@supjknum.mr', '123441ghvgd', 1, 0, NULL),
(2, 23, 'frngrjkbn', 'fvekjherj', 'grhuir', '2001-12-12', 'rehuhr', '2003', '22014@supnum.mr', '1234', 1, 0, NULL),
(3, 22014, 'mady', 'Nktt', '12', '0000-00-00', 'bechir', '', '20065', '22014@supnum.mr', 1234, 1, NULL),
(4, 22014, 'mady', 'Nktt', '12', '0000-00-00', 'bechir', '', '20065', '22014@supnum.mr', 1234, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `etudie`
--

CREATE TABLE `etudie` (
  `id_matiere` int(10) DEFAULT NULL,
  `id_etud` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `examen`
--

CREATE TABLE `examen` (
  `id_examen` int(10) NOT NULL,
  `matiere` varchar(50) DEFAULT NULL,
  `type_examen` varchar(50) DEFAULT NULL,
  `data_examen` longblob DEFAULT NULL,
  `date_examen` date DEFAULT NULL,
  `id_sous` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fait_devoir`
--

CREATE TABLE `fait_devoir` (
  `id_etud` int(10) DEFAULT NULL,
  `id_devoir` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fait_examen`
--

CREATE TABLE `fait_examen` (
  `id_etud` int(10) DEFAULT NULL,
  `id_examen` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `groupe`
--

CREATE TABLE `groupe` (
  `id_groupe` int(10) NOT NULL,
  `groupe_cm` varchar(50) DEFAULT NULL,
  `groupe_tp` varchar(50) DEFAULT NULL,
  `filiere` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `groupe`
--

INSERT INTO `groupe` (`id_groupe`, `groupe_cm`, `groupe_tp`, `filiere`) VALUES
(4, 'G3', 'T4', 'DSO'),
(5, 'G1', 'T²', 'digango'),
(6, 'G3', 'T4', 'DSO');

-- --------------------------------------------------------

--
-- Table structure for table `matiere`
--

CREATE TABLE `matiere` (
  `id_matiere` int(10) NOT NULL,
  `id_devoir` int(10) DEFAULT NULL,
  `id_examen` int(10) DEFAULT NULL,
  `code` varchar(20) DEFAULT NULL,
  `lebele` varchar(20) DEFAULT NULL,
  `semestre` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id_role` int(10) NOT NULL,
  `profile` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id_role`, `profile`) VALUES
(1, 'administrateur');

-- --------------------------------------------------------

--
-- Table structure for table `soumission`
--

CREATE TABLE `soumission` (
  `id_sous` int(10) NOT NULL,
  `date_sous` datetime DEFAULT NULL,
  `date_limite` datetime DEFAULT NULL,
  `valide` tinyint(1) DEFAULT NULL,
  `note_devoir` float DEFAULT NULL,
  `note_examen` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id_user` int(10) NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `date_naiss` date DEFAULT NULL,
  `lieu_naiss` varchar(50) DEFAULT NULL,
  `login` varchar(50) DEFAULT NULL,
  `pwd` varchar(50) DEFAULT NULL,
  `id_role` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `utilisateur`
--

INSERT INTO `utilisateur` (`id_user`, `nom`, `prenom`, `date_naiss`, `lieu_naiss`, `login`, `pwd`, `id_role`) VALUES
(1, 'admin', 'admin', '2023-04-11', 'Nouakchott', 'admin@supnum.mr', '1234', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `devoir`
--
ALTER TABLE `devoir`
  ADD PRIMARY KEY (`id_devoir`);

--
-- Indexes for table `enseignant`
--
ALTER TABLE `enseignant`
  ADD PRIMARY KEY (`id_ens`);

--
-- Indexes for table `etudiant`
--
ALTER TABLE `etudiant`
  ADD PRIMARY KEY (`id_etud`);

--
-- Indexes for table `examen`
--
ALTER TABLE `examen`
  ADD PRIMARY KEY (`id_examen`);

--
-- Indexes for table `groupe`
--
ALTER TABLE `groupe`
  ADD PRIMARY KEY (`id_groupe`);

--
-- Indexes for table `matiere`
--
ALTER TABLE `matiere`
  ADD PRIMARY KEY (`id_matiere`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indexes for table `soumission`
--
ALTER TABLE `soumission`
  ADD PRIMARY KEY (`id_sous`);

--
-- Indexes for table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `devoir`
--
ALTER TABLE `devoir`
  MODIFY `id_devoir` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `enseignant`
--
ALTER TABLE `enseignant`
  MODIFY `id_ens` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `etudiant`
--
ALTER TABLE `etudiant`
  MODIFY `id_etud` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `examen`
--
ALTER TABLE `examen`
  MODIFY `id_examen` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `groupe`
--
ALTER TABLE `groupe`
  MODIFY `id_groupe` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `matiere`
--
ALTER TABLE `matiere`
  MODIFY `id_matiere` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id_role` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `soumission`
--
ALTER TABLE `soumission`
  MODIFY `id_sous` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id_user` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
