-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 06 Novembre 2014 à 23:25
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
-- Structure de la table `objectif`
--

CREATE TABLE IF NOT EXISTS `objectif` (
  `id_objectif` int(11) NOT NULL AUTO_INCREMENT,
  `objectif` varchar(1000) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `points` int(11) NOT NULL,
  PRIMARY KEY (`id_objectif`)
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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
