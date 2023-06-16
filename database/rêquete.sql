-- Active: 1684230870250@@127.0.0.1@3306
CREATE TABLE `groupe` (
  `id_groupe` int(10) PRIMARY KEY AUTO_INCREMENT ,
  `libelle` varchar(50) DEFAULT NULL,
  `filiere` varchar(50) DEFAULT NULL
);


CREATE TABLE `role` (
  `id_role` int(10) PRIMARY KEY AUTO_INCREMENT,
  `profile` varchar(50) DEFAULT NULL
);

CREATE TABLE `utilisateur` (
  `id_user` int(10) PRIMARY KEY AUTO_INCREMENT ,
  `login` varchar(50) DEFAULT NULL,
  `pwd` varchar(50) DEFAULT NULL,
  `active` tinyint(1) DEFAULT 0,
  `code` varchar(20) DEFAULT NULL,
  `id_role` int(10) DEFAULT NULL,
  FOREIGN KEY (id_role) REFERENCES role(id_role)
);


CREATE TABLE `module` (
  `id_module` int(10) PRIMARY KEY AUTO_INCREMENT,
  `nom_module` varchar(50) DEFAULT NULL
);

CREATE TABLE `semestre` (
  `id_semestre` int(10) PRIMARY KEY AUTO_INCREMENT,
  `nom_semestre` varchar(50) DEFAULT NULL
);

CREATE TABLE `type_matiere` (
  `id_type_matiere` int(10) PRIMARY KEY AUTO_INCREMENT,
  `libelle_type` varchar(50) NOT NULL
);

CREATE TABLE `matiere` (
  `id_matiere` int(10) PRIMARY KEY AUTO_INCREMENT ,
  `code` varchar(20)  UNIQUE,
  `libelle` varchar(50) DEFAULT NULL,
  `specialite` varchar(20) DEFAULT NULL,
  `charge` INT(20) NOT NULL,
  `id_module` int(10)  NOT NULL,
  `id_semestre` int(10) NOT NULL,
  `id_type_matiere` int(10) NOT NULL,
  FOREIGN KEY (id_module) REFERENCES module(id_module),
  FOREIGN KEY (id_semestre) REFERENCES semestre(id_semestre),
  FOREIGN KEY (id_type_matiere) REFERENCES type_matiere(id_type_matiere)
);
CREATE TABLE `enseignant` (
  `id_ens` int(10) PRIMARY KEY AUTO_INCREMENT ,
  `nom` varchar(60) DEFAULT NULL,
  `prenom` varchar(60) DEFAULT NULL,
  `Date_naiss` date DEFAULT NULL,
  `lieu_naiss` varchar(30) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `num_tel` int(20) DEFAULT NULL,
  `num_whatsapp` int(20) DEFAULT NULL,
  `diplome` varchar(20) DEFAULT NULL,
  `grade` varchar(20) DEFAULT NULL,
  `id_role` int(11) NOT NULL,
  FOREIGN KEY (id_role) REFERENCES role(id_role)
 
);

CREATE TABLE `soumission` (
  `id_sous` int(10) PRIMARY KEY AUTO_INCREMENT ,
  `titre_sous` varchar(50),
  `description_sous` varchar(50),
  `id_ens` int(10) ,
  `date_debut` datetime NOT NULL,
  `date_fin` datetime NOT NULL,
  `valide` tinyint(1) DEFAULT NULL,
  `archive` tinyint(1) DEFAULT NULL,
  `id_matiere` int(10) DEFAULT NULL,
  FOREIGN KEY (id_matiere) REFERENCES matiere(id_matiere),
   FOREIGN KEY (id_ens) REFERENCES enseignant(id_ens)
);


CREATE TABLE `devoir` (
  `id_devoir` int(10) PRIMARY KEY AUTO_INCREMENT,
  `date_devoir` date DEFAULT NULL,
  `id_sous` int(10) DEFAULT NULL,
  `id_matiere` int(10) DEFAULT NULL,
  FOREIGN KEY (id_matiere) REFERENCES matiere(id_matiere),
  FOREIGN KEY (id_sous) REFERENCES soumission(id_sous)
);

CREATE TABLE `examen` (
  `id_examen` int(10) PRIMARY KEY AUTO_INCREMENT  ,
  `date_examen` date DEFAULT NULL,
  `id_sous` int(10) DEFAULT NULL,
  `id_matiere` int(10) DEFAULT NULL,
  FOREIGN KEY (id_matiere) REFERENCES matiere(id_matiere),
  FOREIGN KEY (id_sous) REFERENCES soumission(id_sous)
);



CREATE TABLE `ens_devoir` (
  `id_ens` int(10) DEFAULT NULL,
  `id_devoir` int(10) DEFAULT NULL,
  FOREIGN KEY (id_ens) REFERENCES enseignant(id_ens),
  FOREIGN KEY (id_devoir) REFERENCES devoir(id_devoir)
);

CREATE TABLE `ens_examen` (
  `id_ens` int(10) DEFAULT NULL,
  `id_examen` int(10) DEFAULT NULL,
  FOREIGN KEY (id_ens) REFERENCES enseignant(id_ens),
  FOREIGN KEY (id_examen) REFERENCES examen(id_examen)
);

CREATE TABLE `etudiant` (
  `id_etud` int(10) PRIMARY KEY AUTO_INCREMENT ,
  `matricule` varchar(50) NOT NULL UNIQUE,
  `nom` varchar(60) DEFAULT NULL,
  `prenom` varchar(60) DEFAULT NULL,
  `lieu_naiss` varchar(100) DEFAULT NULL,
  `Date_naiss` date DEFAULT NULL,
  `id_semestre` int(10) DEFAULT NULL,
  `annee` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `id_role` int(11) NOT NULL,
  `id_groupe` int(10) DEFAULT NULL,
  `id_sous` int(10) DEFAULT NULL,
   FOREIGN KEY (id_semestre) REFERENCES semestre(id_semestre),
  FOREIGN KEY (id_role) REFERENCES role(id_role),
  FOREIGN KEY (id_groupe) REFERENCES groupe(id_groupe),
  FOREIGN KEY (id_sous) REFERENCES soumission(id_sous)
);

CREATE TABLE `fait_devoir` (
  `id_etud` int(10) DEFAULT NULL,
  `id_devoir` int(10) DEFAULT NULL,
  `note_devoir` float(10) DEFAULT NULL,
  FOREIGN KEY (id_etud) REFERENCES etudiant(id_etud),
  FOREIGN KEY (id_devoir) REFERENCES devoir(id_devoir)
);

CREATE TABLE `fait_examen` (
  `id_etud` int(10) DEFAULT NULL,
  `id_examen` int(10) DEFAULT NULL,
  `note_examen` float(10) DEFAULT NULL,
  FOREIGN KEY (id_etud) REFERENCES etudiant(id_etud),
  FOREIGN KEY (id_examen) REFERENCES examen(id_examen)
);

CREATE TABLE `etudie` (
  `id_matiere` int(10) DEFAULT NULL,
  `id_etud` int(10) DEFAULT NULL,
  FOREIGN KEY (id_matiere) REFERENCES matiere(id_matiere),
  FOREIGN KEY (id_etud) REFERENCES etudiant(id_etud)
);


CREATE TABLE `enseigner` (
  `id_matiere` int(10) DEFAULT NULL,
  `id_ens` int(10) DEFAULT NULL,
  `id_groupe` int(10) DEFAULT NULL,
  `id_type_matiere` int(10) NOT NULL,
  FOREIGN KEY (id_type_matiere) REFERENCES type_matiere(id_type_matiere),
  FOREIGN KEY (id_matiere) REFERENCES matiere(id_matiere),
  FOREIGN KEY (id_groupe) REFERENCES groupe(id_groupe),
  FOREIGN KEY (id_ens) REFERENCES enseignant(id_ens)
);

CREATE TABLE inscripsion(
  id_insc int AUTO_INCREMENT PRIMARY key ,
  id_etudi int(10) NOT NULL ,
  id_matieres INT(10) NOt NULL,
FOREIGN KEY (id_matieres) REFERENCES matiere(id_matiere),
  FOREIGN KEY (id_etudi) REFERENCES etudiant(id_etud)
);


CREATE TABLE `departement` (
  `id_dep` int(30) AUTO_INCREMENT PRIMARY key,
  `code` text NOT NULL,
  `nom` text NOT NULL
);
--
CREATE TABLE data_test(
  id_data int AUTO_INCREMENT PRIMARY key ,
  data longblob NOT NULL ,
  id_sous INT(10) not NULL,
  FOREIGN KEY (id_sous) REFERENCES soumission(id_sous)
);

-- --------------------------------------------------------
-- --------------------------------------------------------


INSERT INTO `semestre` (`id_semestre`, `nom_semestre`) VALUES
(1, 'S1'),
(2, 'S2'),
(3, 'S3'),
(4, 'S4'),
(5, 'S5'),
(6, 'S6');




-- --------------------------------------------------------
-- --------------------------------------------------------



INSERT INTO `role` (`id_role`, `profile`) VALUES
(1, 'administrateur'),
(2, 'enseignant'),
(3, 'etudiant');

-- --------------------------------------------------------
-- --------------------------------------------------------


INSERT INTO `utilisateur` (`id_user`, `login`, `pwd`, `active`, `code`, `id_role`) VALUES
(1, 'admin@supnum.mr', '25f9e794323b453885f5181f1b624d0b', 1, '0', 1),
(10, '22014@supnum.mr', '25f9e794323b453885f5181f1b624d0b', 1, NULL, 2),
(11, '22053@supnum.mr', '25f9e794323b453885f5181f1b624d0b', 1, NULL, 3);

-- --------------------------------------------------------
-- --------------------------------------------------------

INSERT INTO `module` ( `nom_module`) VALUES
(' Programmation et développement 1'),
(' Développement personnel'),
('Outils mathématiques et informatiques'),
(' Architecture et systèmes'),
('Atelier multumédia'),
('Programmation et développement 2'),
(' Systèmes et Réseaux');

-- --------------------------------------------------------
-- --------------------------------------------------------


INSERT INTO `departement` (`id`, `code`, `nom`) VALUES
(1, 'DSI', 'Devellopement'),
(2, 'RSS', 'reseaux'),
(3, 'CNM', 'multimedia'),
(4, 'TC', 'trancommun');

-- --------------------------------------------------------
-- --------------------------------------------------------
INSERT INTO `type_matiere` ( `libelle_type`) VALUES ( 'TP');
INSERT INTO `type_matiere` ( `libelle_type`) VALUES ( 'CM');


-- --------------------------------------------------------
-- --------------------------------------------------------

INSERT INTO `matiere` (`id_matiere`, `code`, `libelle`, `specialite`,`charge`, `id_module`, `id_semestre`,`id_type_matiere`) VALUES
(2, 'DEV110', 'Algorithmique et programmation C++', 'TC',33, 1, 1,1),
(3, 'DEV111', 'Introduction aux bases de données', 'TC',66, 1, 1,2),
(4, 'DEV210', 'Programmation Python', 'DSI',55, 1, 2,1),
(5, 'MAI210', 'Algèbre 2', 'CNM', 3,1, 2,1),
(6, 'DPR310', 'Communication', 'CNM',22, 2, 3,2),
(7, 'DPR313', 'Gestion entreprise', 'DSI',99, 2, 3,1);


-- --------------------------------------------------------
-- --------------------------------------------------------


INSERT INTO `enseignant` (`id_ens`, `nom`, `prenom`, `Date_naiss`, `lieu_naiss`, `email`,  `diplome`, `grade`, `id_role`,  `id_sous`) VALUES
(1, 'haroune', 'meya', '1993-06-22', 'nkt', 'meya.haroune@supnum.mr', 'doctor', 'prof', 2,  NULL),
(2, 'cheikh', 'dhib', '1983-01-22', 'nkt', 'cheikh.dhib@supnum.mr', 'doctor', 'directeur', 2,  NULL);


-- --------------------------------------------------------
-- --------------------------------------------------------


INSERT INTO `etudiant` (`id_etud`, `matricule`, `nom`, `prenom`, `lieu_naiss`, `Date_naiss`, `semestre`, `annee`, `email`,  `id_role`, `id_groupe`,  `id_sous`) VALUES
(1, '22053', 'abderahman', 'abderahman', 'nkt', '2023-05-11', 'S2', '2023', '22053@supnum.mr', 3,  NULL, NULL),
(2, '22014', 'Bechir', 'Mady', 'nkt', '2023-05-17', 'S2', '2023', '22014@supnum.mr', 3, NULL, NULL),
(3, '22018', 'souleyman', 'baba', 'nkt', '2023-05-25', 'S2', '2023', '22018@supnum.mr', 3,  NULL, NULL);



-- --------------------------------------------------------
-- --------------------------------------------------------

DELIMITER $$
CREATE PROCEDURE `EnseignantMatiereParGroupe`(id_matiere integer)
BEGIN 
	  SELECT DISTINCT 
      nom, prenom, 
      libelle, libelle_type
      FROM groupe
      NATURAL JOIN enseigner
      NATURAL JOIN enseignant
      NATURAL JOIN type_matiere
      WHERE id_matiere = 2 ORDER BY nom, prenom ASC;
         
         
END $$
DELIMITER ;


