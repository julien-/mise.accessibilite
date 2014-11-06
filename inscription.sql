-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 06 Novembre 2014 à 23:19
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
  PRIMARY KEY (`id_inscription`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40 ;

--
-- Contenu de la table `inscription`
--

INSERT INTO `inscription` (`id_inscription`, `id_cours`, `id_etu`, `date_inscription`) VALUES
(1, 1, 23, '2014-10-14'),
(2, 1, 24, '2014-10-21'),
(3, 1, 25, '2014-10-14'),
(4, 1, 26, '2014-10-14'),
(5, 1, 27, '2014-10-14'),
(6, 1, 28, '2014-10-14'),
(7, 1, 29, '2014-10-14'),
(8, 1, 30, '2014-10-14'),
(9, 1, 31, '2014-10-14'),
(10, 1, 32, '2014-10-14'),
(11, 1, 33, '2014-10-14'),
(12, 1, 34, '2014-10-14'),
(13, 1, 35, '2014-10-14'),
(14, 1, 36, '2014-10-14'),
(15, 1, 37, '2014-10-14'),
(16, 1, 38, '2014-10-14'),
(17, 1, 39, '2014-10-14'),
(18, 1, 40, '2014-10-14'),
(19, 1, 49, '2014-10-14'),
(20, 1, 48, '2014-10-14'),
(21, 1, 45, '2014-10-14'),
(22, 1, 46, '2014-10-14'),
(23, 1, 47, '2014-10-14'),
(24, 1, 51, '2014-10-14'),
(25, 1, 52, '2014-10-14'),
(26, 1, 53, '2014-10-14'),
(27, 1, 54, '2014-10-14'),
(28, 1, 55, '2014-10-14'),
(29, 1, 56, '2014-10-14'),
(30, 1, 57, '2014-10-14'),
(31, 1, 58, '2014-10-14'),
(32, 1, 59, '2014-10-14'),
(33, 1, 60, '2014-10-14'),
(34, 1, 61, '2014-10-14'),
(35, 1, 62, '2014-10-14'),
(36, 1, 63, '2014-10-14'),
(37, 1, 65, '2014-10-14'),
(38, 3, 65, '2014-10-14'),
(39, 27, 65, '2014-11-06');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
