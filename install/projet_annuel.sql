-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 29 mars 2018 à 17:50
-- Version du serveur :  5.7.19
-- Version de PHP :  5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `projet_annuel`
--

-- --------------------------------------------------------

--
-- Structure de la table `premium`
--

DROP TABLE IF EXISTS `premium`;
CREATE TABLE IF NOT EXISTS `premium` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `User_idUser` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `premium`
--

INSERT INTO `premium` (`id`, `startDate`, `endDate`, `user_id`) VALUES
(1, '2018-03-14', '2018-03-31', 20),
(2, '2018-03-14', '2018-03-16', 19),
(3, '2018-03-15', '2018-03-31', 25);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `userName` varchar(100) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `age` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `dateInserted` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `dateUpdated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `firstName`, `name`, `email`, `userName`, `pwd`, `token`, `age`, `status`, `dateInserted`, `dateUpdated`) VALUES
(19, 'LOUIS', 'LOUIS', 'louis@gmail.com', 'rrrrrr', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', 'g88u88regdss8w840g4og0kssskokcgoo0o40s444ocggcws4', 20, 0, '2018-03-13 15:40:57', '2018-03-25 20:45:04'),
(20, 'Zqet', 'Qzetqzet', 'louis@gmail.com', 'zeqtf', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', '2v3wh6jleww0g8k4ow804gogg4w4owcw8owc0cgsggg44s0g40', 20, 0, '2018-03-14 12:20:10', '2018-03-24 23:52:38'),
(23, 'Louis', 'Louis', 'louis@gmail.com', 'Lala', 'de271790913ea81742b7d31a70d85f50a3d3e5ae', '4k5qdza6baio0sg0sc4oc44ggowcc880o8ccsg044cc8skscsg', 20, 0, '2018-03-20 19:41:10', NULL),
(24, 'Louis', 'Louis', 'louis@gmail.com', 'Lala', 'de271790913ea81742b7d31a70d85f50a3d3e5ae', '66myo5znw64gwowkcwgkg44oo4wg0ogoksswgosw00kgs44ok4', 20, 0, '2018-03-20 19:44:31', NULL),
(25, 'Louis', 'Louis', 'louis@gmail.com', 'lol', 'de271790913ea81742b7d31a70d85f50a3d3e5ae', '3em0l2v33c4kg8wws8kcow8ss84g0004gw88coc8ogc0g0o80s', 20, 2, '2018-03-20 19:48:58', '2018-03-29 17:37:02'),
(26, 'LOUIS', 'LOUIS', 'louis@gmail.com', 'Lala', 'de271790913ea81742b7d31a70d85f50a3d3e5ae', '2whcvk8hjtq8w0kwcs8ow80sws40cccgg8gkows0oc4kkwcssg', 20, 0, '2018-03-20 19:58:29', NULL),
(27, 'LOUIS', 'LOUIS', 'louis@gmail.com', 'Lala', 'de271790913ea81742b7d31a70d85f50a3d3e5ae', 'gpxzj6bqeygwsk0s0w8o8sggos04wkokw0ck88o080gswg008', 20, 0, '2018-03-21 18:58:02', NULL),
(28, 'ARETARET', 'ERATREAT', 'louis@gmail.com', 'teate', 'de271790913ea81742b7d31a70d85f50a3d3e5ae', '6auoeiaxbickogc044kowwsw0c08ock4s484k8ocsoowso0k4w', 2, 0, '2018-03-24 21:24:35', NULL),
(29, 'AZRRZ', 'AZRRZAZR', 'louis@gmail.com', 'zraze', 'de271790913ea81742b7d31a70d85f50a3d3e5ae', '3ub8rvuptqck8scsc0koko4kksck0okc0goos0g4g00gckcwss', 20, 0, '2018-03-24 21:25:00', NULL),
(30, 'Azrrz', 'Azrrzazr', 'louis@gmail.com', 'zraze', 'de271790913ea81742b7d31a70d85f50a3d3e5ae', '45nvhkmpvy04owokwgw44w44skc44kco0444kok0wkwgo8gogs', 20, 0, '2018-03-24 21:29:21', NULL),
(31, 'Louis', 'Louis', 'louis@gmail.com', 'Lala', 'de271790913ea81742b7d31a70d85f50a3d3e5ae', '611jmyni2nc4sc40o8ocwck0kkkks8soskwog488ckkgc40so8', 20, 0, '2018-03-24 21:37:33', NULL),
(32, 'Louis', 'Louis', 'louis@gmail.com', 'Lala', 'de271790913ea81742b7d31a70d85f50a3d3e5ae', 'i1bx9sjjgl4wwwog08gooc4ckkc8csc00gwgsscoog0okko04', 20, 0, '2018-03-24 22:01:36', NULL),
(33, 'Louis', 'Louis', 'louis@gmail.com', 'Lala', 'de271790913ea81742b7d31a70d85f50a3d3e5ae', 'v2l5jb39neoww4ow84w4ow40ooo44wswgogw4c4gg48088wgk', 20, 0, '2018-03-24 22:03:33', NULL),
(34, 'Louis', 'Louis', 'louis@gmail.com', 'zerazer', 'de271790913ea81742b7d31a70d85f50a3d3e5ae', '3iuuy6vxv2w4cs4g8kccsww08wkgg4g048s848k8w8sg8wok04', 20, 0, '2018-03-25 20:08:25', NULL),
(35, 'Louis', 'Louis', 'louis@gmail.com', 'Lala', 'de271790913ea81742b7d31a70d85f50a3d3e5ae', 'y4tci0mxs9cck844so48csggsosso8w4w004880csc8gk0k0s', 20, 0, '2018-03-25 20:30:28', NULL),
(36, 'Louis', 'Louis', 'louis@gmail.com', 'Lala', 'de271790913ea81742b7d31a70d85f50a3d3e5ae', '208l9xzozmw0os0sg8gss8c00sgkgwwwkk0goo84scw0gw08go', 20, 0, '2018-03-25 20:44:50', NULL);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `premium`
--
ALTER TABLE `premium`
  ADD CONSTRAINT `premium_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
