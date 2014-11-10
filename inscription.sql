-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 10 Novembre 2014 à 23:42
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
-- Structure de la table `inscription`
--

CREATE TABLE IF NOT EXISTS `inscription` (
  `id_inscription` int(11) NOT NULL AUTO_INCREMENT,
  `id_cours` int(11) NOT NULL,
  `id_etu` int(11) NOT NULL,
  `date_inscription` date NOT NULL,
  `couleur_fond` varchar(50) DEFAULT NULL,
  `couleur_texte` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_inscription`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=43 ;

--
-- Contenu de la table `inscription`
--

INSERT INTO `inscription` (`id_inscription`, `id_cours`, `id_etu`, `date_inscription`, `couleur_fond`, `couleur_texte`) VALUES
(1, 1, 23, '2014-10-14', '', NULL),
(2, 1, 24, '2014-10-21', '', NULL),
(3, 1, 25, '2014-10-14', '', NULL),
(4, 1, 26, '2014-10-14', '', NULL),
(5, 1, 27, '2014-10-14', '', NULL),
(6, 1, 28, '2014-10-14', '', NULL),
(7, 1, 29, '2014-10-14', '', NULL),
(8, 1, 30, '2014-10-14', '', NULL),
(9, 1, 31, '2014-10-14', '', NULL),
(10, 1, 32, '2014-10-14', '', NULL),
(11, 1, 33, '2014-10-14', '', NULL),
(12, 1, 34, '2014-10-14', '', NULL),
(13, 1, 35, '2014-10-14', '', NULL),
(14, 1, 36, '2014-10-14', '', NULL),
(15, 1, 37, '2014-10-14', '', NULL),
(16, 1, 38, '2014-10-14', '', NULL),
(17, 1, 39, '2014-10-14', '', NULL),
(18, 1, 40, '2014-10-14', '', NULL),
(19, 1, 49, '2014-10-14', '', NULL),
(20, 1, 48, '2014-10-14', '', NULL),
(21, 1, 45, '2014-10-14', '', NULL),
(22, 1, 46, '2014-10-14', '', NULL),
(23, 1, 47, '2014-10-14', '', NULL),
(24, 1, 51, '2014-10-14', '', NULL),
(25, 1, 52, '2014-10-14', '', NULL),
(26, 1, 53, '2014-10-14', '', NULL),
(27, 1, 54, '2014-10-14', '', NULL),
(28, 1, 55, '2014-10-14', '', NULL),
(29, 1, 56, '2014-10-14', '', NULL),
(30, 1, 57, '2014-10-14', '', NULL),
(31, 1, 58, '2014-10-14', '', NULL),
(32, 1, 59, '2014-10-14', '', NULL),
(33, 1, 60, '2014-10-14', '', NULL),
(34, 1, 61, '2014-10-14', '', NULL),
(35, 1, 62, '2014-10-14', '', NULL),
(36, 1, 63, '2014-10-14', '', NULL),
(41, 1, 65, '2014-11-03', '#ff8040', '#004040'),
(38, 3, 65, '2014-10-14', '', NULL),
(42, 27, 65, '2014-11-10', NULL, NULL),
(40, 23, 65, '2014-11-07', '#0000ff', '#ffffff');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
