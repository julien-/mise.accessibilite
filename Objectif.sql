-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 05 Novembre 2014 à 13:51
-- Version du serveur :  5.6.15-log
-- Version de PHP :  5.4.24

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
(65, 2, '2014-11-13', 0),
(65, 3, '2014-11-20', 0);

-- --------------------------------------------------------

--
-- Structure de la table `objectif`
--

CREATE TABLE IF NOT EXISTS `objectif` (
  `id_objectif` int(11) NOT NULL AUTO_INCREMENT,
  `objectif` varchar(1000) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `points` int(11) NOT NULL,
  PRIMARY KEY (`id_objectif`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Contenu de la table `objectif`
--

INSERT INTO `objectif` (`id_objectif`, `objectif`, `description`, `points`) VALUES
(4, 'Expert', 'Finir le cours à 100 %', 200),
(2, 'Piplette', 'Poster 5 messages sur le forum', 25),
(3, 'Bavard', 'Poster 15 messages sur le forum', 50),
(5, 'En bonne voie', 'Avoir un avancement supérieur à 25 %', 50),
(6, 'Juge', 'Noter 5 bonus', 50),
(7, 'Professeur en herbe', 'Créer son premier bonus', 50),
(8, 'Idole', 'Plus de 15 étudiants ont mis 5 à un de tes bonus', 200),
(9, 'Habitué', 'Venir chaque jour durant 4 jours d''affilé', 100),
(10, 'Savant fou', 'Réaliser 5 bonus', 100);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
