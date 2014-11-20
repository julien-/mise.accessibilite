-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 20 Novembre 2014 à 15:15
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
  `chemin_avatar` text,
  `code_lien` text,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_etu`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=162 ;

--
-- Contenu de la table `etudiant`
--

INSERT INTO `etudiant` (`id_etu`, `nom_etu`, `prenom_etu`, `pseudo_etu`, `mail_etu`, `pass_etu`, `chemin_avatar`, `code_lien`, `admin`) VALUES
(17, 'My Study Companion', ' (admin)', 'admin', 'zerock54@hotmail.com', 'f6fdffe48c908deb0f4c3bd36c032e72', NULL, NULL, 1),
(50, 'Mayot', 'Paul', 'paulm', 'paul.mayot@hotmail.fr', '6ec0de365a73d4e99aa75383fe49e083', NULL, NULL, 0),
(23, 'Bardon', 'Hélène', 'bardonhelene', 'bardonhelene@outlook.fr', 'bb148a34e1890fadcc0e8e943943adc4', NULL, NULL, 0),
(24, 'Lux', 'Mathieu', 'mathieu67', 'mathieu-lux@hotmail.fr', '6253e1406b64bbe6ba7b00ac0bf81257', NULL, NULL, 0),
(25, 'GREFF', 'Simon', 'bigross', 'greff.simon@gmail.com', '21232f297a57a5a743894a0e4a801fc3', NULL, NULL, 0),
(26, 'Hindermeyer', 'Andrew', 'Roni', 'andrew.hindermeyer@hotmail.fr', '4b94dcce4763d191e9a100cc8715037f', NULL, NULL, 0),
(27, 'Nothof', 'Carolin', 'Caro', 'CNothof@gmx.net', 'ed7f528e5cceb3b0c344241811af1cf0', NULL, NULL, 0),
(28, 'GRALL', 'Magalie', 'mgrall', 'magaliegrall@gmail.com', 'fa442f3f39d35c67c0f37c2aba79395d', NULL, NULL, 0),
(29, 'Godard', 'Eloïse', 'EloïseGodard', 'eloise.godard@gmail.com', 'b6edd10559b20cb0a3ddaeb15e5267cc', NULL, NULL, 0),
(30, 'preyssat', 'marina', 'mpreyssat', 'marinapreyssat@gmail.com', 'c9b9741c5f444218e071d942fa004d83', NULL, NULL, 0),
(31, 'BIER', 'Louis-Nicolas', 'neko', 'dewendelsidelor@gmail.com', 'b0bd5aa3fcc9f2f2c580d172ba9e6fb3', NULL, NULL, 0),
(32, 'Souto Tuna', 'Diogo', 'soutotun1u', 'diogo.tuna@hotmail.com', 'b5d27aeab112ba516af800d3bec2f647', NULL, NULL, 0),
(33, 'Le Rest', 'Adrien', 'Kohril', 'lerest.adrien@gmail.com', '59f4fe41ceeec27f74cbf1baf883e373', NULL, NULL, 0),
(34, 'Welker', 'Natalie', 'Natalie', 'natalie.welker@web.de', 'dd6f2a0e7515d0ed910921aad4258825', NULL, NULL, 0),
(35, 'Hudson', 'Frederick', 'Freddy', 'Frederick@Hudson.de', '69fd97f355e1997b5a08ae1d93876bd8', NULL, NULL, 0),
(36, 'Chupin', 'Alexander ', 'Alex', 'alexander.chupin@hotmail.de', '0957d2c1ae86e5eb0b9d397fa9cf2730', NULL, NULL, 0),
(37, 'giangreco', 'giannina', 'giannina', 'giannina.gianreco@gmail.com', 'b48fee99c626f0634db4bf8f5d2d54b2', NULL, NULL, 0),
(38, 'Demoulin', 'Miriam', 'mdemoulin', 'miriam.demoulin@orange.fr', '628adbb43b8e2efccbda9266ebbe0593', NULL, NULL, 0),
(39, 'Hoffmann', 'Daniel', 'Dan', 'daniel.hoffmann6@etu.univ-lorraine.fr', '66475847da18d826852a4eb646a070ec', NULL, NULL, 0),
(40, 'Rapp', 'Christian', 'nth', 'christian.r.rapp@t-online.de', '50b401b8605ee77ada5e87135f57156a', NULL, NULL, 0),
(49, 'Handrick', 'Florine', 'Flof', 'florine.handrick@gmail.com', '8836afd14c547660380406d7e7a13c26', NULL, NULL, 0),
(48, 'GURTLER', 'SOPHIE', 'Sophie', 'sophie.gurtler@orange.fr', '3b088b7cc2b2e5beec1cb14a7023655a', NULL, NULL, 0),
(45, 'Demmerlé', 'Thibaut', 'tibo', 'thibaut555@gmail.com', '7682fe272099ea26efe39c890b33675b', NULL, NULL, 0),
(46, 'Hoffmann', 'Nicolas', 'Nicolas.hoffmann', 'nicolashdu57@hotmail.com', 'cda1efa189ba1e3a79695bf43663c9f1', NULL, NULL, 0),
(47, 'HUMBERT', 'Lorraine', 'Lorraine', 'lorraineh.h@live.fr', 'c6ed9aa478ae56001957faced0271cb7', NULL, NULL, 0),
(51, 'Delanaux', 'Pierre', 'Pierre57420', 'pierredelanaux@yahoo.fr', 'edeedf39ecab63ded84bbcdc04e200bc', NULL, NULL, 0),
(52, 'Golkowski', 'Marc', 'm.golkowski@hamcom.biz', 'm.golkowski@hamcom.biz', '6f72d10b24ce6db292d40cf31b5377da', NULL, NULL, 0),
(53, 'schwarz', 'emmanuel', 'menechen', 'emmanuel.schwarz@hotmail.fr', '621507d7eec1a50b1a7d56957c67d297', NULL, NULL, 0),
(54, 'Theis', 'Annika', 'Annii', 'annika.theis@yahoo.com', '3d61774aaa23843f1d80a0b6903e8ba1', NULL, NULL, 0),
(55, 'Allal', 'Kenza', 'kenzanaj', 'kenzaallal@gmail.com', 'ab69d4f3abee17108f2fc2e571b5665d', NULL, NULL, 0),
(56, 'Heim', 'Guillaume', 'Weshladesh', 'guillaume.heim@gmail.com', '43ff0d53f5d019778ddcb4ea8259a322', NULL, NULL, 0),
(57, 'GREFF', 'Simon 2', 'TheBoss', 'simon.g5713@orange.fr', 'e7d56f3d9f5bd20065bc5b556e5f3197', NULL, NULL, 0),
(58, 'Pascal', 'Hoffman', 'divapasc', 'diva@hoff.fr', 'd3e309779350bf432bfd819492b825f1', NULL, NULL, 0),
(59, 'Ibrahimovic', 'Zlatan', 'zlatan', 'zlatan@ibra.com', '0b5ffc09eb62ef2241f07327276ee064', NULL, NULL, 0),
(60, 'Benzema', 'Karim', 'karim', 'kaka@rim.fr', '51467d5f95285c46f9dba677e991885b', NULL, NULL, 0),
(61, 'giangreco', 'Giannina', 'giagia', 'giannina.giangreco@gmail.com', 'b48fee99c626f0634db4bf8f5d2d54b2', NULL, NULL, 0),
(62, 'ADEBAYOR', 'Emmanuel', 'Adeba', 'ade@manu.fr', 'f4c2c8a86d7c9879f1d69c95838abd5a', NULL, NULL, 0),
(63, 'Buehler', 'Cindy', 'cinderella', 'elenanosaltarin@gmx.de', '9feb4c00dad9409f01a8e8b006691e0c', NULL, NULL, 0),
(64, 'gabi', 'gabi', 'gabi', 'gabi@gabi.com', 'a0d499c751053663c611a32779a57104', NULL, NULL, 1),
(65, 'azeazea', 'azaz', 'TEST', 'collet.damien@hotmail.fr', '033bd94b1168d7e4f0d644c3c95e35bf', NULL, NULL, 0),
(66, 'GALMICHE', 'Nicolas', 'nico', 'gabi@gabfffi.com', '410ec15153a6dff0bed851467309bcbd', NULL, NULL, 1),
(67, 'NICK', 'Df', 'dfdf', 'dffd@ggl.fr', 'b52c96bea30646abf8170f333bbd42b9', NULL, NULL, 1),
(68, 'TESTPROF', 'Testprof', 'testprof', 'testprof@testprof.fr', '694ae24230bc0baa4eabdc0d3d2995c8', NULL, NULL, 1),
(69, 'TESTPROF2', 'Testprof2', 'testprof2', 'gabintm@gg.fr', 'ec91ede073a72ad4b81625f3d394b7db', NULL, NULL, 1),
(70, 'LOL', 'Lol', 'ggg', 'lol@lol.fr', '73c18c59a39b18382081ec00bb456d43', NULL, NULL, 1),
(71, 'SWF', 'Fdf', 'dfsf', 'sfdsf@dwf.fr', '3238b0f5af9931fc73a43eb02a2ee528', NULL, NULL, 0),
(72, ':nom', ':prenom', ':pseudo', ':mail', ':pass', NULL, NULL, 0),
(73, 'Luc', 'Luc', 'Luc', 'Luc', 'Luc', NULL, NULL, 0),
(74, 'Luc', 'Luc', 'Luc', 'Luc', 'Luc', NULL, NULL, 0),
(75, 'Luc', 'Luc', 'Luc', 'Luc', 'Luc', NULL, NULL, 0),
(76, 'Luc', 'Luc', 'Luc', 'Luc', 'Luc', NULL, NULL, 0),
(77, 'Luc', 'Luc', 'Luc', 'Luc', 'Luc', NULL, NULL, 0),
(78, 'Luc', 'Luc', 'Luc', 'Luc', 'Luc', NULL, NULL, 0),
(79, 'Luc', 'Luc', 'Luc', 'Luc', 'Luc', NULL, NULL, 0),
(80, 'Luc', 'Luc', 'Luc', 'Luc', 'Luc', NULL, NULL, 0),
(81, 'Luc', 'Luc', 'Luc', 'Luc', 'Luc', NULL, NULL, 0),
(82, 'Luc', 'Luc', 'Luc', 'Luc', 'Luc', NULL, NULL, 0),
(83, 'Luc', 'Luc', 'Luc', 'Luc', 'Luc', NULL, NULL, 0),
(84, 'Luc', 'Luc', 'Luc', 'Luc', 'Luc', NULL, NULL, 0),
(85, 'Luc', 'Luc', 'Luc', 'Luc', 'Luc', NULL, NULL, 0),
(86, 'Luc', 'Luc', 'Luc', 'Luc', 'Luc', NULL, NULL, 0),
(87, 'Luc', 'Luc', 'Luc', 'Luc', 'Luc', NULL, NULL, 0),
(88, 'Luc', 'Luc', 'Luc', 'Luc', 'Luc', NULL, NULL, 0),
(89, 'Luc', 'Luc', 'Luc', 'Luc', 'Luc', NULL, NULL, 0),
(90, 'Luc', 'Luc', 'Luc', 'Luc', 'Luc', NULL, NULL, 0),
(91, 'Luc', 'Luc', 'Luc', 'Luc', 'Luc', NULL, NULL, 0),
(92, 'Luc', 'Luc', 'Luc', 'Luc', 'Luc', NULL, NULL, 0),
(93, 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', NULL, NULL, 0),
(94, 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', NULL, NULL, 0),
(95, 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', NULL, NULL, 0),
(96, 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', NULL, NULL, 0),
(97, 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', NULL, NULL, 0),
(98, 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', NULL, NULL, 0),
(99, 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', NULL, NULL, 0),
(100, 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', NULL, NULL, 0),
(101, 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', NULL, NULL, 0),
(102, 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', NULL, NULL, 0),
(103, 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', NULL, NULL, 0),
(104, 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', NULL, NULL, 0),
(105, 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', NULL, NULL, 0),
(106, 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', NULL, NULL, 0),
(107, 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', NULL, NULL, 0),
(108, 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', NULL, NULL, 0),
(109, 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', NULL, NULL, 0),
(110, 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', NULL, NULL, 0),
(111, 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', NULL, NULL, 0),
(112, 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', NULL, NULL, 0),
(113, 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', NULL, NULL, 0),
(114, 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', NULL, NULL, 0),
(115, 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', NULL, NULL, 0),
(116, 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', NULL, NULL, 0),
(117, 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', NULL, NULL, 0),
(118, 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', NULL, NULL, 0),
(119, 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', 'My Study Companion', NULL, NULL, 0),
(123, 'MICHEL', 'Gabriel', 'gabriel.michel', 'gabriel.michel@gmail.com', 'a0d499c751053663c611a32779a57104', NULL, NULL, 1),
(122, 'GALMICHE', 'Nicolas', 'zerock', 'zerock54@hotmail.fr', 'd450c5dbcc10db0749277efc32f15f9f', NULL, NULL, 1),
(124, 'PROF', 'Prof', 'prof', 'prof@etu.fr', 'd450c5dbcc10db0749277efc32f15f9f', NULL, NULL, 1),
(125, 'FFF', 'Fff', 'fr', 'fff@ff.fr', '82a9e4d26595c87ab6e442391d8c5bba', NULL, NULL, 1),
(126, 'n', 'n', 'zerockj', 'zerock54@hotmail.comj', 'aa', NULL, NULL, 0),
(127, 'n', 'n', 'zerockjk', 'zerock54@hotmail.comjk', 'aa', NULL, NULL, 0),
(128, 'n', 'n', 'zerockjkmm', 'zerock54@hotmail.comjkmm', 'aa', NULL, NULL, 0),
(129, 'na', 'na', 'zerockjka', 'zerock54@hotmail.comjka', 'aa', NULL, NULL, 0),
(130, '', '', '', '', 'd41d8cd98f00b204e9800998ecf8427e', NULL, NULL, 0),
(131, 'Aaaaaaaa', 'Aaaaaaaaaaa', 'AAAAAAAAAAAAAA', 'aa@aa.aa', 'd8a73157ce10cd94a91c2079fc9a92c8', '', '', 0),
(132, 'Aaaaaaaa', 'Aaaaaaaaaaa', 'AAAAAAAAAAAAAA', 'aa@aa.aa', '3dbe00a167653a1aaee01d93e77e730e', '', '', 0),
(133, 'Aaaaaaaa', 'Aaaaaaaaaaa', 'AAAAAAAAAAAAAA', 'aa@aa.aa', '3dbe00a167653a1aaee01d93e77e730e', '', 'd41d8cd98f00b204e9800998ecf8427e', 0),
(134, 'Aa', 'Aa', 'aaa', 'aa@aa.aa', '3dbe00a167653a1aaee01d93e77e730e', '', 'd41d8cd98f00b204e9800998ecf8427e', 0),
(135, 'Aa', 'Aa', 'aaa', 'aa@aa.aa', '3dbe00a167653a1aaee01d93e77e730e', '', '', 0),
(136, 'Aa', 'Aa', 'aaa', 'aa@aa.aa', '3dbe00a167653a1aaee01d93e77e730e', '', '', 0),
(137, 'Aa', 'Aa', 'aaa', 'aa@aa.aa', '3dbe00a167653a1aaee01d93e77e730e', '', '', 0),
(138, 'Aa', 'Aa', 'aaa', 'aa@aa.aa', '3dbe00a167653a1aaee01d93e77e730e', '', '', 0),
(139, 'Aaaa', 'Aa', 'qqqq', 'aa@aa.aa', '3dbe00a167653a1aaee01d93e77e730e', '', '', 0),
(140, 'Salut', 'Salut', 'salut', 'sdfsd@sdfsdf.sdf', '4bbde07660e5eff90873642cfae9a8dd', 'salut', 'salut', 0),
(141, 'Salut', 'Salut', 'salut', 'sdfsd@sdfsdf.sdf', '4bbde07660e5eff90873642cfae9a8dd', 'salut', 'salut', 0),
(142, 'Salut', 'Salut', 'salut', 'sdfsd@sdfsdf.sdf', '4bbde07660e5eff90873642cfae9a8dd', 'coucou', 'coucou', 0),
(143, 'Aa', 'Aa', 'aaaa', 'aa@aa.aa', '3dbe00a167653a1aaee01d93e77e730e', 'NULL', 'NULL', 0),
(144, 'Aa', 'Aa', 'aaa', 'aa@aa.aa', '3dbe00a167653a1aaee01d93e77e730e', '', 'd41d8cd98f00b204e9800998ecf8427e', 0),
(145, 'Aa', 'Aa', 'admin', 'aa@aa.aa', '3dbe00a167653a1aaee01d93e77e730e', 'WP_20140423_001.jpg', '912d7d1d5206cde2f9a5114511187d90', 0),
(146, 'Aa', 'Aa', 'admin', 'aa@aa.aa', '3dbe00a167653a1aaee01d93e77e730e', NULL, NULL, 0),
(147, 'Aa', 'Aa', 'admin', 'aa@aa.aa', '3dbe00a167653a1aaee01d93e77e730e', 'WP_20140423_0011.jpg', '9c38c69c0ac8523b0d849fb6fc2d6e4f', 0),
(148, 'Aaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 'Aa', 'aaa', 'aa@aa.aa', '3dbe00a167653a1aaee01d93e77e730e', NULL, NULL, 0),
(149, 'Bbbbbbbbbb', 'Bbbbbbb', 'bbbbbbbbbbbb', 'b@b.c', '810247419084c82d03809fc886fedaad', 'WP_20140419_001.jpg', 'd6d09bc53d90f431e4862f87f534f500', 0),
(150, 'Aa', 'Aaaaa', 'aaaaaaaaaaaaa', 'aa@aa.aa', '3dbe00a167653a1aaee01d93e77e730e', NULL, NULL, 0),
(151, 'Collet', 'Damien', 'Damien57070', 'collet.damien@hotmail.fr', 'e86ccb972fb44b55ed2b4d9b4f9bce7a', NULL, NULL, 0),
(152, 'Collet', 'Damien', 'Damien57070', 'collet.damien@hotmail.fr', 'e86ccb972fb44b55ed2b4d9b4f9bce7a', 'IMG_10112014_234548.png', 'a78ed6913acc7024fb1f90ff0538d05a', 0),
(153, 'Salut', 'Sss', 'sssssssssss', 'sdfsd@sdfsdf.sdf', '4bbde07660e5eff90873642cfae9a8dd', NULL, NULL, 0),
(154, 'A', 'Z', 'robot', 'aa@aa.aa', '12fc62439d5d79daf7ba8333e549b70b', 'IMG_10112014_2345481.png', 'b60a1d2d731185678568cc0001f17c80', 0),
(155, 'Hhhh', 'Hhh', 'hhhh', 'heyy@hey.hey', 'b7e6923f6de66497d51789db0ef3571d', NULL, NULL, 0),
(156, 'Ppp', 'Ppp', 'restaurant', 'aa@aa.aa', '6d4b62960a6aa2b1fff43a9c1d95f7b2', '2d19adeda1beb7f73ebce66af3cabe71', '2d19adeda1beb7f73ebce66af3cabe71', 0),
(157, 'Jjjjjjjjj', 'Jjjjj', 'jjjjjj', 'jptest@gmail.com', '4bb2c9d9a57a0d2a53e7c4d56c952331', 'IMG_10112014_2345483.png', '9a4a51b07b1fec9724c8f89bbc69d8bd', 0),
(158, 'Fdg', 'Dfgdfg', 'GGGGG', 'aa@aa.aa', '9ce68bf7aee21ff56acf75f4fd4f8bec', 'IMG_10112014_2345484.png', '2e81e74fb7921535e218ed9a189295c3', 0),
(159, 'Jp', 'Jp', 'alert', 'collet.damien@hotmail.fr', 'ca692b009da9da37cca5b0435e0c786d', 'logo.png', '1bb87d41d15fe27b500a4bfcde01bb0e', 0),
(160, 'Aaaazd', 'Azd', 'azdazdzad', 'aa@aa.aa', 'c162de19c4c3731ca3428769d0cd593d', NULL, NULL, 0),
(161, 'Galmiche', 'Nicolas', 'loserpoolfc', 'ng54@hotmail.fr', '89f5858214dfef761b40508b5c2c9b40', 'WP_20140423_0012.jpg', '59ce6833e57d6c143d9f0c0a25d7f857', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
