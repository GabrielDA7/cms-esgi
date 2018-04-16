-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 16 avr. 2018 à 15:08
-- Version du serveur :  5.7.21
-- Version de PHP :  5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `uteach`
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `emailConfirm` varchar(255) DEFAULT NULL,
  `userName` varchar(100) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `dateInserted` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `dateUpdated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `role` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `firstName`, `lastName`, `email`, `emailConfirm`, `userName`, `pwd`, `token`, `avatar`, `status`, `dateInserted`, `dateUpdated`, `role`) VALUES
(23, 'Louis', 'Louis', 'louis@gmail.com', '22', 'Lala', 'de271790913ea81742b7d31a70d85f50a3d3e5ae', '4k5qdza6baio0sg0sc4oc44ggowcc880o8ccsg044cc8skscsg', '20', 1, '2018-03-20 19:41:10', '2018-04-15 10:06:35', 0),
(24, 'Louis', 'Louis', 'louis@gmail.com', NULL, 'Lala', 'de271790913ea81742b7d31a70d85f50a3d3e5ae', '66myo5znw64gwowkcwgkg44oo4wg0ogoksswgosw00kgs44ok4', '20', 0, '2018-03-20 19:44:31', NULL, 0),
(25, 'Louis', 'Louis', 'louis@gmail.com', NULL, 'lol', 'c1a1a4b81a220cf8195aa8560bae8a332d17cfe8', '4iz5qs50z280w4oksws0c4ssso8w480ogggcw0s8owsskowsko', '20', 1, '2018-03-20 19:48:58', '2018-04-16 09:51:02', 2),
(26, 'LOUIS', 'LOUIS', 'louis@gmail.com', NULL, 'Lala', 'de271790913ea81742b7d31a70d85f50a3d3e5ae', '2whcvk8hjtq8w0kwcs8ow80sws40cccgg8gkows0oc4kkwcssg', '20', 0, '2018-03-20 19:58:29', NULL, 0),
(27, 'LOUIS', 'LOUIS', 'louis@gmail.com', NULL, 'Lala', 'de271790913ea81742b7d31a70d85f50a3d3e5ae', 'gpxzj6bqeygwsk0s0w8o8sggos04wkokw0ck88o080gswg008', '20', 0, '2018-03-21 18:58:02', NULL, 0),
(28, 'ARETARET', 'ERATREAT', 'louis@gmail.com', NULL, 'teate', 'de271790913ea81742b7d31a70d85f50a3d3e5ae', '6auoeiaxbickogc044kowwsw0c08ock4s484k8ocsoowso0k4w', '2', 0, '2018-03-24 21:24:35', NULL, 0),
(29, 'AZRRZ', 'AZRRZAZR', 'louis@gmail.com', NULL, 'zraze', 'de271790913ea81742b7d31a70d85f50a3d3e5ae', '3ub8rvuptqck8scsc0koko4kksck0okc0goos0g4g00gckcwss', '20', 0, '2018-03-24 21:25:00', NULL, 0),
(30, 'Azrrz', 'Azrrzazr', 'louis@gmail.com', NULL, 'zraze', 'de271790913ea81742b7d31a70d85f50a3d3e5ae', '45nvhkmpvy04owokwgw44w44skc44kco0444kok0wkwgo8gogs', '20', 0, '2018-03-24 21:29:21', NULL, 0),
(31, 'Louis', 'Louis', 'louis@gmail.com', NULL, 'Lala', 'de271790913ea81742b7d31a70d85f50a3d3e5ae', '611jmyni2nc4sc40o8ocwck0kkkks8soskwog488ckkgc40so8', '20', 0, '2018-03-24 21:37:33', NULL, 0),
(32, 'Louis', 'Louis', 'louis@gmail.com', NULL, 'Lala', 'de271790913ea81742b7d31a70d85f50a3d3e5ae', 'i1bx9sjjgl4wwwog08gooc4ckkc8csc00gwgsscoog0okko04', '20', 0, '2018-03-24 22:01:36', NULL, 0),
(33, 'Louis', 'Louis', 'louis@gmail.com', NULL, 'Lala', 'de271790913ea81742b7d31a70d85f50a3d3e5ae', 'v2l5jb39neoww4ow84w4ow40ooo44wswgogw4c4gg48088wgk', '20', 0, '2018-03-24 22:03:33', NULL, 0),
(34, 'Louis', 'Louis', 'louis@gmail.com', NULL, 'zerazer', 'de271790913ea81742b7d31a70d85f50a3d3e5ae', '3iuuy6vxv2w4cs4g8kccsww08wkgg4g048s848k8w8sg8wok04', '20', 0, '2018-03-25 20:08:25', NULL, 0),
(35, 'Louis', 'Louis', 'louis@gmail.com', NULL, 'Lala', 'de271790913ea81742b7d31a70d85f50a3d3e5ae', 'y4tci0mxs9cck844so48csggsosso8w4w004880csc8gk0k0s', '20', 0, '2018-03-25 20:30:28', NULL, 0),
(36, 'Louis', 'Louis', 'louis@gmail.com', NULL, 'Lala', 'de271790913ea81742b7d31a70d85f50a3d3e5ae', '208l9xzozmw0os0sg8gss8c00sgkgwwwkk0goo84scw0gw08go', '20', 0, '2018-03-25 20:44:50', NULL, 0),
(37, 'Louis', 'Louis', 'louis@gmail.com', NULL, 'Lala', 'de271790913ea81742b7d31a70d85f50a3d3e5ae', '250n00lacvtw0o8co4k8oc8ssg000so84g0w8ck8880gkckkc4', '20', 0, '2018-03-30 17:28:42', NULL, 0),
(39, 'Louis', 'Louis', 'louis@gmail.com', NULL, 'admin', 'de271790913ea81742b7d31a70d85f50a3d3e5ae', '3mxstvh2hekg0okkcwg8gw8co4wo4k44s0kg04g8sksgss4wck', '20', 0, '2018-03-31 12:18:37', NULL, 2),
(40, 'Louis', 'Louis', 'louis@gmail.com', NULL, 'admin', 'de271790913ea81742b7d31a70d85f50a3d3e5ae', '4as5am6m4mw4ogww4swc88404kwoss4kw40ko0gkk4kc0sosws', '20', 0, '2018-03-31 17:17:52', NULL, 2),
(41, 'Azazeaze', 'Azeazeaze', 'azezaeze@ffk.dr', NULL, 'azeze', 'c1a1a4b81a220cf8195aa8560bae8a332d17cfe8', '6k79qax6tmw4g4g0o0o44ckkg4k4cwc04g08cw4kw84kcgks0', '99', 0, '2018-04-14 19:08:24', NULL, 1),
(42, 'Ztzer', 'Azeaze', 'azeaze@zetkj.com', '3wmt1v560n28ocw8c4k0kgo488o4wsocg00cokckss4ggok088', 'aazeaze', 'c1a1a4b81a220cf8195aa8560bae8a332d17cfe8', '5vtga3bwjrksow8kcos8cg4kw4gwgk804g8cwcw0s84ckg0kcc', 'public/img/image-1465348_960_720.jpg', 0, '2018-04-16 14:43:58', NULL, 1),
(43, 'Ztzer', 'Azeaze', 'azeaze@zetkj.com', 'l6is6j10m1c884gok40w08w44c4gcgo4oscc4cswogsk0os4c', 'aazeaze', 'c1a1a4b81a220cf8195aa8560bae8a332d17cfe8', '5ouf4lihnbc44ko0swgo4owcws8ggcwc4cssccgc0k8woo4o8k', '/Uteach/public/img/image-1465348_960_720.jpg', 0, '2018-04-16 14:45:42', NULL, 1),
(44, 'Ztzer', 'Azeaze', 'azeaze@zetkj.com', '5zy02p952ggsk0s4cc8c8ckgkc480o848084scs8o0c4gc8w0s', 'aazeaze', 'c1a1a4b81a220cf8195aa8560bae8a332d17cfe8', '27820fld3u80og4c8g04w4cgo404kgwgso0004w8kkkso0sgs0', 'public/img/image-1465348_960_720.jpg', 0, '2018-04-16 14:46:22', NULL, 1),
(45, 'Ztzer', 'Azeaze', 'azeaze@zetkj.com', '2lw8feo5rgkk8ko44ogwcgkgkk0gowosw8s8g4ksgkkw44o0o4', 'aazeaze', 'c1a1a4b81a220cf8195aa8560bae8a332d17cfe8', '56b73huhh1wckwk8wowc4w08ggoo4ok80wcw0cos488gwksgsk', 'public/img/image-1465348_960_720.jpg', 0, '2018-04-16 14:46:57', NULL, 1);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `premium`
--
ALTER TABLE `premium`
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
