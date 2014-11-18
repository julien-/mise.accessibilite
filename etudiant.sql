-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 18 Novembre 2014 à 18:11
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
-- Structure de la table `etudiant`
--

CREATE TABLE IF NOT EXISTS `etudiant` (
  `id_etu` int(3) NOT NULL AUTO_INCREMENT,
  `nom_etu` varchar(200) NOT NULL,
  `prenom_etu` varchar(200) NOT NULL,
  `pseudo_etu` varchar(200) NOT NULL,
  `mail_etu` varchar(200) NOT NULL,
  `pass_etu` varchar(200) NOT NULL,
  `avatar` text,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_etu`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=131 ;

--
-- Contenu de la table `etudiant`
--

INSERT INTO `etudiant` (`id_etu`, `nom_etu`, `prenom_etu`, `pseudo_etu`, `mail_etu`, `pass_etu`, `avatar`, `admin`) VALUES
(17, 'My Study Companion', ' (admin)', 'admin', 'zerock54@hotmail.com', 'f6fdffe48c908deb0f4c3bd36c032e72', NULL, 1),
(50, 'Mayot', 'Paul', 'paulm', 'paul.mayot@hotmail.fr', '6ec0de365a73d4e99aa75383fe49e083', NULL, 0),
(23, 'Bardon', 'Hélène', 'bardonhelene', 'bardonhelene@outlook.fr', 'bb148a34e1890fadcc0e8e943943adc4', NULL, 0),
(24, 'Lux', 'Mathieu', 'mathieu67', 'mathieu-lux@hotmail.fr', '6253e1406b64bbe6ba7b00ac0bf81257', NULL, 0),
(25, 'GREFF', 'Simon', 'bigross', 'greff.simon@gmail.com', '21232f297a57a5a743894a0e4a801fc3', NULL, 0),
(26, 'Hindermeyer', 'Andrew', 'Roni', 'andrew.hindermeyer@hotmail.fr', '4b94dcce4763d191e9a100cc8715037f', NULL, 0),
(27, 'Nothof', 'Carolin', 'Caro', 'CNothof@gmx.net', 'ed7f528e5cceb3b0c344241811af1cf0', NULL, 0),
(28, 'GRALL', 'Magalie', 'mgrall', 'magaliegrall@gmail.com', 'fa442f3f39d35c67c0f37c2aba79395d', NULL, 0),
(29, 'Godard', 'Eloïse', 'EloïseGodard', 'eloise.godard@gmail.com', 'b6edd10559b20cb0a3ddaeb15e5267cc', NULL, 0),
(30, 'preyssat', 'marina', 'mpreyssat', 'marinapreyssat@gmail.com', 'c9b9741c5f444218e071d942fa004d83', NULL, 0),
(31, 'BIER', 'Louis-Nicolas', 'neko', 'dewendelsidelor@gmail.com', 'b0bd5aa3fcc9f2f2c580d172ba9e6fb3', NULL, 0),
(32, 'Souto Tuna', 'Diogo', 'soutotun1u', 'diogo.tuna@hotmail.com', 'b5d27aeab112ba516af800d3bec2f647', NULL, 0),
(33, 'Le Rest', 'Adrien', 'Kohril', 'lerest.adrien@gmail.com', '59f4fe41ceeec27f74cbf1baf883e373', NULL, 0),
(34, 'Welker', 'Natalie', 'Natalie', 'natalie.welker@web.de', 'dd6f2a0e7515d0ed910921aad4258825', NULL, 0),
(35, 'Hudson', 'Frederick', 'Freddy', 'Frederick@Hudson.de', '69fd97f355e1997b5a08ae1d93876bd8', NULL, 0),
(36, 'Chupin', 'Alexander ', 'Alex', 'alexander.chupin@hotmail.de', '0957d2c1ae86e5eb0b9d397fa9cf2730', NULL, 0),
(37, 'giangreco', 'giannina', 'giannina', 'giannina.gianreco@gmail.com', 'b48fee99c626f0634db4bf8f5d2d54b2', NULL, 0),
(38, 'Demoulin', 'Miriam', 'mdemoulin', 'miriam.demoulin@orange.fr', '628adbb43b8e2efccbda9266ebbe0593', NULL, 0),
(39, 'Hoffmann', 'Daniel', 'Dan', 'daniel.hoffmann6@etu.univ-lorraine.fr', '66475847da18d826852a4eb646a070ec', NULL, 0),
(40, 'Rapp', 'Christian', 'nth', 'christian.r.rapp@t-online.de', '50b401b8605ee77ada5e87135f57156a', NULL, 0),
(49, 'Handrick', 'Florine', 'Flof', 'florine.handrick@gmail.com', '8836afd14c547660380406d7e7a13c26', NULL, 0),
(48, 'GURTLER', 'SOPHIE', 'Sophie', 'sophie.gurtler@orange.fr', '3b088b7cc2b2e5beec1cb14a7023655a', NULL, 0),
(45, 'Demmerlé', 'Thibaut', 'tibo', 'thibaut555@gmail.com', '7682fe272099ea26efe39c890b33675b', NULL, 0),
(46, 'Hoffmann', 'Nicolas', 'Nicolas.hoffmann', 'nicolashdu57@hotmail.com', 'cda1efa189ba1e3a79695bf43663c9f1', NULL, 0),
(47, 'HUMBERT', 'Lorraine', 'Lorraine', 'lorraineh.h@live.fr', 'c6ed9aa478ae56001957faced0271cb7', NULL, 0),
(51, 'Delanaux', 'Pierre', 'Pierre57420', 'pierredelanaux@yahoo.fr', 'edeedf39ecab63ded84bbcdc04e200bc', NULL, 0),
(52, 'Golkowski', 'Marc', 'm.golkowski@hamcom.biz', 'm.golkowski@hamcom.biz', '6f72d10b24ce6db292d40cf31b5377da', NULL, 0),
(53, 'schwarz', 'emmanuel', 'menechen', 'emmanuel.schwarz@hotmail.fr', '621507d7eec1a50b1a7d56957c67d297', NULL, 0),
(54, 'Theis', 'Annika', 'Annii', 'annika.theis@yahoo.com', '3d61774aaa23843f1d80a0b6903e8ba1', NULL, 0),
(55, 'Allal', 'Kenza', 'kenzanaj', 'kenzaallal@gmail.com', 'ab69d4f3abee17108f2fc2e571b5665d', NULL, 0),
(56, 'Heim', 'Guillaume', 'Weshladesh', 'guillaume.heim@gmail.com', '43ff0d53f5d019778ddcb4ea8259a322', NULL, 0),
(57, 'GREFF', 'Simon 2', 'TheBoss', 'simon.g5713@orange.fr', 'e7d56f3d9f5bd20065bc5b556e5f3197', NULL, 0),
(58, 'Pascal', 'Hoffman', 'divapasc', 'diva@hoff.fr', 'd3e309779350bf432bfd819492b825f1', NULL, 0),
(59, 'Ibrahimovic', 'Zlatan', 'zlatan', 'zlatan@ibra.com', '0b5ffc09eb62ef2241f07327276ee064', NULL, 0),
(60, 'Benzema', 'Karim', 'karim', 'kaka@rim.fr', '51467d5f95285c46f9dba677e991885b', NULL, 0),
(61, 'giangreco', 'Giannina', 'giagia', 'giannina.giangreco@gmail.com', 'b48fee99c626f0634db4bf8f5d2d54b2', NULL, 0),
(62, 'ADEBAYOR', 'Emmanuel', 'Adeba', 'ade@manu.fr', 'f4c2c8a86d7c9879f1d69c95838abd5a', NULL, 0),
(63, 'Buehler', 'Cindy', 'cinderella', 'elenanosaltarin@gmx.de', '9feb4c00dad9409f01a8e8b006691e0c', NULL, 0),
(64, 'gabi', 'gabi', 'gabi', 'gabi@gabi.com', 'a0d499c751053663c611a32779a57104', NULL, 1),
(65, 'azeazea', 'azaz', 'TEST', 'collet.damien@hotmail.fr', '033bd94b1168d7e4f0d644c3c95e35bf', NULL, 0),
(66, 'GALMICHE', 'Nicolas', 'nico', 'gabi@gabfffi.com', '410ec15153a6dff0bed851467309bcbd', NULL, 1),
(67, 'NICK', 'Df', 'dfdf', 'dffd@ggl.fr', 'b52c96bea30646abf8170f333bbd42b9', NULL, 1),
(68, 'TESTPROF', 'Testprof', 'testprof', 'testprof@testprof.fr', '694ae24230bc0baa4eabdc0d3d2995c8', NULL, 1),
(69, 'TESTPROF2', 'Testprof2', 'testprof2', 'gabintm@gg.fr', 'ec91ede073a72ad4b81625f3d394b7db', NULL, 1),
(70, 'LOL', 'Lol', 'ggg', 'lol@lol.fr', '73c18c59a39b18382081ec00bb456d43', NULL, 1),
(71, 'SWF', 'Fdf', 'dfsf', 'sfdsf@dwf.fr', '3238b0f5af9931fc73a43eb02a2ee528', NULL, 0),
(72, ':nom', ':prenom', ':pseudo', ':mail', ':pass', NULL, 0),
(73, 'Luc', 'Luc', 'Luc', 'Luc', 'Luc', NULL, 0),
(74, 'Luc', 'Luc', 'Luc', 'Luc', 'Luc', NULL, 0),
(75, 'Luc', 'Luc', 'Luc', 'Luc', 'Luc', NULL, 0),
(76, 'Luc', 'Luc', 'Luc', 'Luc', 'Luc', NULL, 0),
(77, 'Luc', 'Luc', 'Luc', 'Luc', 'Luc', NULL, 0),
(78, 'Luc', 'Luc', 'Luc', 'Luc', 'Luc', NULL, 0),
(79, 'Luc', 'Luc', 'Luc', 'Luc', 'Luc', NULL, 0),
(80, 'Luc', 'Luc', 'Luc', 'Luc', 'Luc', NULL, 0),
(81, 'Luc', 'Luc', 'Luc', 'Luc', 'Luc', NULL, 0),
(82, 'Luc', 'Luc', 'Luc', 'Luc', 'Luc', NULL, 0),
(83, 'Luc', 'Luc', 'Luc', 'Luc', 'Luc', NULL, 0),
(84, 'Luc', 'Luc', 'Luc', 'Luc', 'Luc', NULL, 0),
(85, 'Luc', 'Luc', 'Luc', 'Luc', 'Luc', NULL, 0),
(86, 'Luc', 'Luc', 'Luc', 'Luc', 'Luc', NULL, 0),
(87, 'Luc', 'Luc', 'Luc', 'Luc', 'Luc', NULL, 0),
(88, 'Luc', 'Luc', 'Luc', 'Luc', 'Luc', NULL, 0),
(89, 'Luc', 'Luc', 'Luc', 'Luc', 'Luc', NULL, 0),
(90, 'Luc', 'Luc', 'Luc', 'Luc', 'Luc', NULL, 0),
(91, 'Luc', 'Luc', 'Luc', 'Luc', 'Luc', NULL, 0),
(92, 'Luc', 'Luc', 'Luc', 'Luc', 'Luc', NULL, 0),
(93, 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', NULL, 0),
(94, 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', NULL, 0),
(95, 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', NULL, 0),
(96, 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', NULL, 0),
(97, 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', NULL, 0),
(98, 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', NULL, 0),
(99, 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', NULL, 0),
(100, 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', NULL, 0),
(101, 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', NULL, 0),
(102, 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', NULL, 0),
(103, 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', NULL, 0),
(104, 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', NULL, 0),
(105, 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', NULL, 0),
(106, 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', NULL, 0),
(107, 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', NULL, 0),
(108, 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', NULL, 0),
(109, 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', NULL, 0),
(110, 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', NULL, 0),
(111, 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', NULL, 0),
(112, 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', NULL, 0),
(113, 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', NULL, 0),
(114, 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', NULL, 0),
(115, 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', NULL, 0),
(116, 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', NULL, 0),
(117, 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', NULL, 0),
(118, 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', NULL, 0),
(119, 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', NULL, 0),
(123, 'MICHEL', 'Gabriel', 'gabriel.michel', 'gabriel.michel@gmail.com', 'a0d499c751053663c611a32779a57104', NULL, 1),
(122, 'GALMICHE', 'Nicolas', 'zerock', 'zerock54@hotmail.fr', 'd450c5dbcc10db0749277efc32f15f9f', NULL, 1),
(124, 'PROF', 'Prof', 'prof', 'prof@etu.fr', 'd450c5dbcc10db0749277efc32f15f9f', NULL, 1),
(125, 'FFF', 'Fff', 'fr', 'fff@ff.fr', '82a9e4d26595c87ab6e442391d8c5bba', NULL, 1),
(126, 'n', 'n', 'zerockj', 'zerock54@hotmail.comj', 'aa', NULL, 0),
(127, 'n', 'n', 'zerockjk', 'zerock54@hotmail.comjk', 'aa', NULL, 0),
(128, 'n', 'n', 'zerockjkmm', 'zerock54@hotmail.comjkmm', 'aa', NULL, 0),
(129, 'na', 'na', 'zerockjka', 'zerock54@hotmail.comjka', 'aa', NULL, 0),
(130, '', '', '', '', 'd41d8cd98f00b204e9800998ecf8427e', NULL, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
