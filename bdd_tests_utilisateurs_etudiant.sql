-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Dim 30 Novembre 2014 à 13:59
-- Version du serveur :  5.5.39
-- Version de PHP :  5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `apprentissage`
--

-- --------------------------------------------------------

--
-- Structure de la table `assignations_objectif`
--

CREATE TABLE IF NOT EXISTS `assignations_objectif` (
  `id_etu` int(11) NOT NULL,
  `id_objectif` int(11) NOT NULL,
  `date` date NOT NULL,
  `id_cours` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `assignations_objectif`
--

INSERT INTO `assignations_objectif` (`id_etu`, `id_objectif`, `date`, `id_cours`) VALUES
(4, 1, '2014-11-30', 1),
(3, 15, '2014-11-30', 1),
(3, 1, '2014-11-30', 1),
(3, 2, '2014-11-30', 1),
(3, 3, '2014-11-30', 1),
(3, 4, '2014-11-30', 1),
(3, 8, '2014-11-30', 1),
(4, 2, '2014-11-30', 1);

-- --------------------------------------------------------

--
-- Structure de la table `assignations_pokemon`
--

CREATE TABLE IF NOT EXISTS `assignations_pokemon` (
  `id_etu` int(11) NOT NULL,
  `id_pokemon` int(11) NOT NULL,
  `id_exo` int(11) NOT NULL,
  `poke_courant` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `avancement`
--

CREATE TABLE IF NOT EXISTS `avancement` (
  `id_etu` int(11) NOT NULL,
  `id_exo` int(11) NOT NULL,
  `fait` int(1) NOT NULL,
  `compris` int(1) NOT NULL,
  `assimile` int(1) NOT NULL,
  `id_seance` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `avancement`
--

INSERT INTO `avancement` (`id_etu`, `id_exo`, `fait`, `compris`, `assimile`, `id_seance`, `date`) VALUES
(4, 1, 25, 0, 0, 2, '0000-00-00'),
(4, 2, 25, 0, 0, 2, '0000-00-00'),
(4, 1, 0, 25, 0, 2, '0000-00-00'),
(4, 2, 0, 25, 0, 2, '0000-00-00'),
(4, 1, 0, 0, 50, 2, '0000-00-00'),
(3, 1, 25, 0, 0, 2, '0000-00-00'),
(3, 2, 25, 0, 0, 2, '0000-00-00'),
(3, 3, 25, 0, 0, 2, '0000-00-00'),
(3, 4, 25, 0, 0, 2, '0000-00-00'),
(3, 1, 0, 25, 0, 2, '0000-00-00'),
(3, 2, 0, 25, 0, 2, '0000-00-00'),
(3, 3, 0, 25, 0, 2, '0000-00-00'),
(3, 4, 0, 25, 0, 2, '0000-00-00'),
(3, 1, 0, 0, 50, 2, '0000-00-00'),
(3, 2, 0, 0, 50, 2, '0000-00-00'),
(3, 3, 0, 0, 50, 2, '0000-00-00'),
(3, 4, 0, 0, 50, 2, '0000-00-00'),
(4, 2, 0, 0, 50, 2, '2014-11-30');

-- --------------------------------------------------------

--
-- Structure de la table `avancement_bonus`
--

CREATE TABLE IF NOT EXISTS `avancement_bonus` (
  `id_etu` int(11) NOT NULL,
  `id_bonus` int(11) NOT NULL,
  `fait` tinyint(1) NOT NULL,
  `suivi` tinyint(1) NOT NULL,
  `note` tinyint(5) DEFAULT NULL,
  `remarque` varchar(400) DEFAULT NULL,
  `id_seance` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `avancement_bonus`
--

INSERT INTO `avancement_bonus` (`id_etu`, `id_bonus`, `fait`, `suivi`, `note`, `remarque`, `id_seance`) VALUES
(3, 1, 1, 0, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `bonus`
--

CREATE TABLE IF NOT EXISTS `bonus` (
`id_bonus` int(11) NOT NULL,
  `titre_bonus` varchar(200) NOT NULL,
  `type_bonus` varchar(200) NOT NULL,
  `id_theme` int(11) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `bonus`
--

INSERT INTO `bonus` (`id_bonus`, `titre_bonus`, `type_bonus`, `id_theme`) VALUES
(1, 'Les équations différentielles', 'Expose', 1);

-- --------------------------------------------------------

--
-- Structure de la table `cle`
--

CREATE TABLE IF NOT EXISTS `cle` (
`id_cle` int(11) NOT NULL,
  `valeur_cle` varchar(120) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `cle`
--

INSERT INTO `cle` (`id_cle`, `valeur_cle`) VALUES
(1, 'd939e7a6b17e374c1e3db59b4df2ae97');

-- --------------------------------------------------------

--
-- Structure de la table `cle_enseignant`
--

CREATE TABLE IF NOT EXISTS `cle_enseignant` (
  `cle` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `cle_enseignant`
--

INSERT INTO `cle_enseignant` (`cle`) VALUES
('3ac3e5a795913a424bb98674764116c9');

-- --------------------------------------------------------

--
-- Structure de la table `cours`
--

CREATE TABLE IF NOT EXISTS `cours` (
`id_cours` int(11) NOT NULL,
  `libelle_cours` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `couleur_calendar` varchar(7) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `id_prof` int(11) NOT NULL,
  `id_cle` int(11) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `cours`
--

INSERT INTO `cours` (`id_cours`, `libelle_cours`, `couleur_calendar`, `id_prof`, `id_cle`) VALUES
(1, 'Mathématiques', NULL, 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

CREATE TABLE IF NOT EXISTS `etudiant` (
`id_etu` int(3) NOT NULL,
  `nom_etu` varchar(200) NOT NULL,
  `prenom_etu` varchar(200) NOT NULL,
  `pseudo_etu` varchar(200) NOT NULL,
  `mail_etu` varchar(200) NOT NULL,
  `pass_etu` varchar(200) NOT NULL,
  `chemin_avatar` text,
  `code_lien` text,
  `admin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `etudiant`
--

INSERT INTO `etudiant` (`id_etu`, `nom_etu`, `prenom_etu`, `pseudo_etu`, `mail_etu`, `pass_etu`, `chemin_avatar`, `code_lien`, `admin`) VALUES
(1, 'Galmiche', 'Nicolas', 'nicolas', 'zerock54@hotmail.com', 'deb97a759ee7b8ba42e02dddf2b412fe', NULL, NULL, 0),
(2, 'Professeur', 'Jean-Michel', 'professeur', 'prof@prof.fr', 'a1c3fb0e3d546eee15f9989998799ac8', NULL, NULL, 1),
(3, 'Einstein', 'Albert', 'AtomicAlbert', 'einstein@emc2.de', '37a08ed30093a133b1bb4ae0b8f3601f', 'portrait-albert-einstein-16.jpg', '279b65cda68b4c28e64fad7a3221e9c2', 0),
(4, 'Etudiant', 'Jean-Michel', 'etudiant', 'etudiant@etudiant.fr', 'a3c6c43c72c71ed874d16ce12f8cede1', 'pidou_etudiant_zoom.jpg', 'f9d01ab17c9ccb8d6e4b2f33b75fa784', 0);

-- --------------------------------------------------------

--
-- Structure de la table `evolutions`
--

CREATE TABLE IF NOT EXISTS `evolutions` (
  `id_pokemon` int(11) NOT NULL,
  `id_evolution` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `exercice`
--

CREATE TABLE IF NOT EXISTS `exercice` (
`id_exo` int(11) NOT NULL,
  `titre_exo` varchar(200) NOT NULL,
  `num_exo` int(11) NOT NULL,
  `id_theme` int(11) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `exercice`
--

INSERT INTO `exercice` (`id_exo`, `titre_exo`, `num_exo`, `id_theme`) VALUES
(1, 'Addition', 1, 1),
(2, 'Soustraction', 2, 1),
(3, 'Multiplication', 3, 1),
(4, 'Division', 4, 1);

-- --------------------------------------------------------

--
-- Structure de la table `fichiers`
--

CREATE TABLE IF NOT EXISTS `fichiers` (
`id_fichier` int(11) NOT NULL,
  `id_exo` int(11) NOT NULL,
  `chemin_fichier` varchar(200) NOT NULL,
  `nom` varchar(200) NOT NULL,
  `commentaires` varchar(500) NOT NULL,
  `code_lien` varchar(100) NOT NULL,
  `enligne` tinyint(1) NOT NULL,
  `telechargements` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `forum_categorie`
--

CREATE TABLE IF NOT EXISTS `forum_categorie` (
`id_categorie` int(11) NOT NULL,
  `titre_categorie` varchar(200) NOT NULL,
  `description_categorie` varchar(90) NOT NULL,
  `id_cours` int(11) NOT NULL,
  `id_categorie_parent` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `forum_reponses`
--

CREATE TABLE IF NOT EXISTS `forum_reponses` (
`id_reponse` int(6) NOT NULL,
  `auteur_reponse` varchar(30) NOT NULL,
  `message` text NOT NULL,
  `date_reponse` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `correspondance_sujet` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `forum_sujets`
--

CREATE TABLE IF NOT EXISTS `forum_sujets` (
`id_sujet` int(6) NOT NULL,
  `auteur` varchar(30) NOT NULL,
  `titre` text NOT NULL,
  `date_derniere_reponse` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `id_categorie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `historique`
--

CREATE TABLE IF NOT EXISTS `historique` (
`id_historique` int(11) NOT NULL,
  `page` varchar(200) NOT NULL,
  `date_visite` date NOT NULL,
  `heure_visite` time NOT NULL,
  `id_etu` int(11) NOT NULL,
  `id_cours` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

--
-- Contenu de la table `historique`
--

INSERT INTO `historique` (`id_historique`, `page`, `date_visite`, `heure_visite`, `id_etu`, `id_cours`, `timestamp`) VALUES
(1, 'progression', '2014-11-30', '13:07:06', 3, 1, 1417349226),
(2, 'informations', '2014-11-30', '13:07:17', 3, 1, 1417349237),
(3, 'objectif', '2014-11-30', '13:07:23', 3, 1, 1417349243),
(4, 'mes_bonus', '2014-11-30', '13:07:28', 3, 1, 1417349248),
(5, 'progression', '2014-11-30', '13:07:32', 3, 1, 1417349252),
(6, 'details_theme_etudiant', '2014-11-30', '13:07:44', 3, 1, 1417349264),
(7, '../../forum/controleur/index_forum', '2014-11-30', '13:07:56', 3, 1, 1417349276),
(8, 'progression', '2014-11-30', '13:10:47', 4, 1, 1417349447),
(9, 'seance_precedente', '2014-11-30', '13:11:05', 4, 1, 1417349465),
(10, 'seance_actuelle', '2014-11-30', '13:11:13', 4, 1, 1417349473),
(11, 'seance_actuelle', '2014-11-30', '13:11:37', 4, 1, 1417349497),
(12, 'objectif', '2014-11-30', '13:11:46', 4, 1, 1417349506),
(13, 'objectif', '2014-11-30', '13:14:15', 4, 1, 1417349655),
(14, 'seance_actuelle', '2014-11-30', '13:14:25', 4, 1, 1417349665),
(15, 'mes_bonus', '2014-11-30', '13:15:19', 4, 1, 1417349719),
(16, 'progression', '2014-11-30', '13:22:46', 3, 1, 1417350166),
(17, 'seance_actuelle', '2014-11-30', '13:22:54', 3, 1, 1417350174),
(18, 'seance_actuelle', '2014-11-30', '13:23:13', 3, 1, 1417350193),
(19, 'mes_bonus', '2014-11-30', '13:23:33', 3, 1, 1417350213),
(20, 'mes_bonus', '2014-11-30', '13:24:01', 3, 1, 1417350241),
(21, 'informations', '2014-11-30', '13:24:11', 3, 1, 1417350251),
(22, 'progression', '2014-11-30', '13:25:44', 4, 1, 1417350344),
(23, 'seance_actuelle', '2014-11-30', '13:26:28', 4, 1, 1417350388),
(24, '../../forum/controleur/index_forum', '2014-11-30', '13:37:36', 4, 1, 1417351056),
(25, 'progression', '2014-11-30', '13:42:48', 3, 1, 1417351368),
(26, 'seance_actuelle', '2014-11-30', '13:43:04', 3, 1, 1417351384),
(27, 'progression', '2014-11-30', '13:44:16', 4, 1, 1417351456),
(28, 'seance_actuelle', '2014-11-30', '13:44:23', 4, 1, 1417351463),
(29, 'seance_actuelle', '2014-11-30', '13:44:33', 4, 1, 1417351473),
(30, 'progression', '2014-11-30', '13:51:23', 4, 1, 1417351883),
(31, 'seance_actuelle', '2014-11-30', '13:51:30', 4, 1, 1417351890);

-- --------------------------------------------------------

--
-- Structure de la table `inscription`
--

CREATE TABLE IF NOT EXISTS `inscription` (
`id_inscription` int(11) NOT NULL,
  `id_cours` int(11) NOT NULL,
  `id_etu` int(11) NOT NULL,
  `date_inscription` date NOT NULL,
  `couleur_fond` varchar(50) DEFAULT NULL,
  `couleur_texte` varchar(50) DEFAULT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `inscription`
--

INSERT INTO `inscription` (`id_inscription`, `id_cours`, `id_etu`, `date_inscription`, `couleur_fond`, `couleur_texte`) VALUES
(1, 1, 3, '2014-11-30', NULL, NULL),
(2, 1, 4, '2014-11-30', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
`id_mess` int(11) NOT NULL,
  `expediteur` int(11) NOT NULL,
  `destinataire` int(11) NOT NULL,
  `date_mess` datetime NOT NULL,
  `heure_mess` time NOT NULL,
  `titre_mess` varchar(1000) NOT NULL,
  `texte_mess` varchar(1000) NOT NULL,
  `lu` int(11) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `messages`
--

INSERT INTO `messages` (`id_mess`, `expediteur`, `destinataire`, `date_mess`, `heure_mess`, `titre_mess`, `texte_mess`, `lu`) VALUES
(1, 3, 4, '2014-11-30 13:22:30', '13:22:30', 'Bombe atomique', 'Salut Jean-Mi,\r\n\r\nVoici les plans de la bombe atomique: http://contreinfo.info/IMG/arton2083.jpg. Fais toi plaiz.\r\n\r\nCiao frère.\r\n\r\nAlberto', 0);

-- --------------------------------------------------------

--
-- Structure de la table `objectif`
--

CREATE TABLE IF NOT EXISTS `objectif` (
`id_objectif` int(11) NOT NULL,
  `objectif` varchar(1000) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `points` int(11) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Contenu de la table `objectif`
--

INSERT INTO `objectif` (`id_objectif`, `objectif`, `description`, `points`) VALUES
(1, 'Débutant', 'Avoir un avancement global supérieur à 25 %', 250),
(2, 'Intermédiaire', 'Avoir un avancement global supérieur à 50 %', 500),
(3, 'Avancé', 'Avoir un avancement global supérieur à 75 %', 750),
(4, 'Expert', 'Avoir un avancement global égal à 100 %', 1000),
(5, 'Discret', 'Poster son premier message sur le forum', 50),
(6, 'Loquace', 'Poster 5 messages sur le forum', 100),
(7, 'Bavard', 'Poster 15 messages sur le forum', 300),
(8, 'Prof en herbe', 'Créer son premier bonus', 50),
(9, 'Petit génie', 'Créer 5 bonus', 100),
(10, 'Savant fou', 'Créer 15 bonus', 300),
(11, 'Juge', 'Noter un premier bonus', 50),
(12, 'Juré', 'Noter 5 bonus', 100),
(13, 'Bourreau', 'Noter 15 bonus', 300),
(14, 'Idole', 'Plus de 15 étudiants ont mis 5 à un de tes bonus', 200),
(15, 'Pionier', 'Etre le premier à s''être inscrit au cours', 200);

-- --------------------------------------------------------

--
-- Structure de la table `oubli_password`
--

CREATE TABLE IF NOT EXISTS `oubli_password` (
`id` int(11) NOT NULL,
  `id_etu` int(11) NOT NULL,
  `cle` text NOT NULL,
  `date_expiration` date NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `oubli_password`
--

INSERT INTO `oubli_password` (`id`, `id_etu`, `cle`, `date_expiration`) VALUES
(1, 65, 'd3b01eea52c1a531af06585acd5fadbb', '2014-11-30');

-- --------------------------------------------------------

--
-- Structure de la table `pokemon`
--

CREATE TABLE IF NOT EXISTS `pokemon` (
`id_pokemon` int(11) NOT NULL,
  `nom_pokemon` varchar(200) NOT NULL,
  `pokemon_base` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `professeur`
--

CREATE TABLE IF NOT EXISTS `professeur` (
  `id_prof` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `remarque_seances`
--

CREATE TABLE IF NOT EXISTS `remarque_seances` (
  `id_seance` int(11) NOT NULL,
  `id_etu` int(11) NOT NULL,
  `remarque` varchar(400) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `seance`
--

CREATE TABLE IF NOT EXISTS `seance` (
`id_seance` int(11) NOT NULL,
  `date_seance` date NOT NULL,
  `id_cours` int(11) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `seance`
--

INSERT INTO `seance` (`id_seance`, `date_seance`, `id_cours`) VALUES
(1, '2014-11-18', 1),
(2, '2014-11-24', 1),
(3, '2014-12-01', 1);

-- --------------------------------------------------------

--
-- Structure de la table `theme`
--

CREATE TABLE IF NOT EXISTS `theme` (
`id_theme` int(11) NOT NULL,
  `titre_theme` varchar(200) NOT NULL,
  `id_cours` int(11) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `theme`
--

INSERT INTO `theme` (`id_theme`, `titre_theme`, `id_cours`) VALUES
(1, 'Calculs', 1);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `assignations_pokemon`
--
ALTER TABLE `assignations_pokemon`
 ADD PRIMARY KEY (`id_etu`,`id_pokemon`), ADD KEY `id_pokemon` (`id_pokemon`), ADD KEY `assign_exo` (`id_exo`), ADD KEY `id_etu` (`id_etu`,`id_pokemon`);

--
-- Index pour la table `avancement`
--
ALTER TABLE `avancement`
 ADD KEY `id_exo` (`id_exo`), ADD KEY `id_seance` (`id_seance`);

--
-- Index pour la table `avancement_bonus`
--
ALTER TABLE `avancement_bonus`
 ADD PRIMARY KEY (`id_etu`,`id_bonus`,`id_seance`), ADD KEY `id_bonus` (`id_bonus`), ADD KEY `id_seance` (`id_seance`);

--
-- Index pour la table `bonus`
--
ALTER TABLE `bonus`
 ADD PRIMARY KEY (`id_bonus`), ADD KEY `id_theme` (`id_theme`);

--
-- Index pour la table `cle`
--
ALTER TABLE `cle`
 ADD PRIMARY KEY (`id_cle`);

--
-- Index pour la table `cours`
--
ALTER TABLE `cours`
 ADD PRIMARY KEY (`id_cours`);

--
-- Index pour la table `etudiant`
--
ALTER TABLE `etudiant`
 ADD PRIMARY KEY (`id_etu`);

--
-- Index pour la table `evolutions`
--
ALTER TABLE `evolutions`
 ADD PRIMARY KEY (`id_pokemon`,`id_evolution`), ADD KEY `id_evolution` (`id_evolution`);

--
-- Index pour la table `exercice`
--
ALTER TABLE `exercice`
 ADD PRIMARY KEY (`id_exo`), ADD KEY `id_chap` (`id_theme`);

--
-- Index pour la table `fichiers`
--
ALTER TABLE `fichiers`
 ADD PRIMARY KEY (`id_fichier`);

--
-- Index pour la table `forum_categorie`
--
ALTER TABLE `forum_categorie`
 ADD PRIMARY KEY (`id_categorie`);

--
-- Index pour la table `forum_reponses`
--
ALTER TABLE `forum_reponses`
 ADD PRIMARY KEY (`id_reponse`);

--
-- Index pour la table `forum_sujets`
--
ALTER TABLE `forum_sujets`
 ADD PRIMARY KEY (`id_sujet`);

--
-- Index pour la table `historique`
--
ALTER TABLE `historique`
 ADD PRIMARY KEY (`id_historique`), ADD KEY `id_etu` (`id_etu`);

--
-- Index pour la table `inscription`
--
ALTER TABLE `inscription`
 ADD PRIMARY KEY (`id_inscription`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
 ADD PRIMARY KEY (`id_mess`), ADD KEY `expediteur` (`expediteur`,`destinataire`), ADD KEY `destinataire` (`destinataire`), ADD KEY `expediteur_2` (`expediteur`,`destinataire`);

--
-- Index pour la table `objectif`
--
ALTER TABLE `objectif`
 ADD PRIMARY KEY (`id_objectif`);

--
-- Index pour la table `oubli_password`
--
ALTER TABLE `oubli_password`
 ADD PRIMARY KEY (`id`);

--
-- Index pour la table `pokemon`
--
ALTER TABLE `pokemon`
 ADD PRIMARY KEY (`id_pokemon`);

--
-- Index pour la table `remarque_seances`
--
ALTER TABLE `remarque_seances`
 ADD PRIMARY KEY (`id_seance`,`id_etu`), ADD KEY `id_seance` (`id_seance`), ADD KEY `id_etudiant` (`id_etu`);

--
-- Index pour la table `seance`
--
ALTER TABLE `seance`
 ADD PRIMARY KEY (`id_seance`);

--
-- Index pour la table `theme`
--
ALTER TABLE `theme`
 ADD PRIMARY KEY (`id_theme`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `bonus`
--
ALTER TABLE `bonus`
MODIFY `id_bonus` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `cle`
--
ALTER TABLE `cle`
MODIFY `id_cle` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `cours`
--
ALTER TABLE `cours`
MODIFY `id_cours` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `etudiant`
--
ALTER TABLE `etudiant`
MODIFY `id_etu` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `exercice`
--
ALTER TABLE `exercice`
MODIFY `id_exo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `fichiers`
--
ALTER TABLE `fichiers`
MODIFY `id_fichier` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `forum_categorie`
--
ALTER TABLE `forum_categorie`
MODIFY `id_categorie` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `forum_reponses`
--
ALTER TABLE `forum_reponses`
MODIFY `id_reponse` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `forum_sujets`
--
ALTER TABLE `forum_sujets`
MODIFY `id_sujet` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `historique`
--
ALTER TABLE `historique`
MODIFY `id_historique` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT pour la table `inscription`
--
ALTER TABLE `inscription`
MODIFY `id_inscription` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
MODIFY `id_mess` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `objectif`
--
ALTER TABLE `objectif`
MODIFY `id_objectif` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT pour la table `oubli_password`
--
ALTER TABLE `oubli_password`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `pokemon`
--
ALTER TABLE `pokemon`
MODIFY `id_pokemon` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `seance`
--
ALTER TABLE `seance`
MODIFY `id_seance` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `theme`
--
ALTER TABLE `theme`
MODIFY `id_theme` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
