-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 21 mars 2018 à 20:03
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
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `User_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `User_idUser` (`User_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `premium`
--

INSERT INTO `premium` (`id`, `start_date`, `end_date`, `User_id`) VALUES
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
  `premium` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `firstName`, `name`, `email`, `userName`, `pwd`, `token`, `age`, `status`, `dateInserted`, `dateUpdated`, `premium`) VALUES
(12, 'LOUIS', 'LOUIS', 'louis@gmail.com', '', '$2y$10$ck.AkZx1n6T.sUTclyinIeZ/fdW6IYhQ7jWk1sWIl5UM.ZYBilT8q', '4doloa4pp0u8cwokg0csgo4sc8g4w84wckgwk8os0gswowgcsg', 20, 0, '2018-03-13 14:09:07', NULL, 0),
(13, 'LOUIS', 'LOUIS', 'louis@gmail.com', '', '$2y$10$wg7y4dX5mIIBo9HgV/DboeuIA6/qkeS.W3EfMhO7RTmdkYadM5LYW', '5we9mm906ask00gcscg0kgww8sogwksksc88o0o8cc0400848o', 20, 0, '2018-03-13 14:09:07', NULL, 0),
(14, 'LOUIS', 'LOUIS', 'louis@gmail.com', '', '$2y$10$WfIQa95hMn4e35qx4My87OnEFoAHDiNgvMESRVLrnPv6NaTqyKWiq', '2owtiywyzhk48g04wwo4sk08o0skwoggkcw0o8448cc0s8cgs0', 20, 0, '2018-03-13 14:09:08', NULL, 0),
(15, 'LOUIS', 'LOUIS', 'louis@gmail.com', '', '$2y$10$czRSbU76awBJpz3Z8bNq5O6rbgsj7svsw4fRhGS5hWbJeTrXkOZKS', '3rgyhxmqrd44kwwgkswcc4w880840c8wg400w08kogs40ksgso', 20, 0, '2018-03-13 14:09:08', NULL, 0),
(16, 'LOUIS', 'LOUIS', 'louis@gmail.com', '', '$2y$10$4.pNtENW9xKTAlzULsxCRe1NIi3PyIED3Pf3EVv.sKUedqKAYYhWK', '4nqcdo37z3wgc4sw4go8wc044kgs84gco44g0oosg0wc408wg4', 20, 0, '2018-03-13 14:09:08', NULL, 0),
(18, 'LOUIS', 'LOUIS', 'louis@gmail.com', 'Lala', '$2y$10$RfDheOcyIkHbjqawYVeQ2.ulBkrQwLJOiFn3fsu9ZMSlMJ6uHq6WS', '5cg80fvc40ows8o0s48co4sw44g0ks8000w0koowckkg408ogo', 20, 0, '2018-03-13 15:20:45', NULL, 0),
(19, 'LOUIS', 'LOUIS', 'louis@gmail.com', 'Lala', 'de271790913ea81742b7d31a70d85f50a3d3e5ae', 'g88u88regdss8w840g4og0kssskokcgoo0o40s444ocggcws4', 20, 0, '2018-03-13 15:40:57', NULL, 0),
(20, 'LOUIS', 'LOUIS', 'louis@gmail.com', 'Lala', 'de271790913ea81742b7d31a70d85f50a3d3e5ae', '2v3wh6jleww0g8k4ow804gogg4w4owcw8owc0cgsggg44s0g40', 20, 0, '2018-03-14 12:20:10', NULL, 0),
(21, 'louiq', 'louis', 'louis@gmail.com', 'lala', 'de271790913ea81742b7d31a70d85f50a3d3e5ae', '58ymihk2ef8ko408ccwww0g44sc84g84gw8kc8os4s0gwgkwcc', 20, 0, '2018-03-20 19:17:55', NULL, 0),
(22, 'Louis', 'Louis', 'louis@gmail.com', 'Lala', 'de271790913ea81742b7d31a70d85f50a3d3e5ae', '1t84sr1te90ggsgw808g40g00cko88osoc8sco00o0g8gsswgk', 20, 0, '2018-03-20 19:36:55', NULL, 0),
(23, 'Louis', 'Louis', 'louis@gmail.com', 'Lala', 'de271790913ea81742b7d31a70d85f50a3d3e5ae', '4k5qdza6baio0sg0sc4oc44ggowcc880o8ccsg044cc8skscsg', 20, 0, '2018-03-20 19:41:10', NULL, 0),
(24, 'Louis', 'Louis', 'louis@gmail.com', 'Lala', 'de271790913ea81742b7d31a70d85f50a3d3e5ae', '66myo5znw64gwowkcwgkg44oo4wg0ogoksswgosw00kgs44ok4', 20, 0, '2018-03-20 19:44:31', NULL, 0),
(25, 'Louis', 'Louis', 'louis@gmail.com', 'lol', 'de271790913ea81742b7d31a70d85f50a3d3e5ae', '3em0l2v33c4kg8wws8kcow8ss84g0004gw88coc8ogc0g0o80s', 20, 0, '2018-03-20 19:48:58', '2018-03-21 19:56:19', 1),
(26, 'LOUIS', 'LOUIS', 'louis@gmail.com', 'Lala', 'de271790913ea81742b7d31a70d85f50a3d3e5ae', '2whcvk8hjtq8w0kwcs8ow80sws40cccgg8gkows0oc4kkwcssg', 20, 0, '2018-03-20 19:58:29', NULL, 0),
(27, 'LOUIS', 'LOUIS', 'louis@gmail.com', 'Lala', 'de271790913ea81742b7d31a70d85f50a3d3e5ae', 'gpxzj6bqeygwsk0s0w8o8sggos04wkokw0ck88o080gswg008', 20, 0, '2018-03-21 18:58:02', NULL, 0);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `premium`
--
ALTER TABLE `premium`
  ADD CONSTRAINT `premium_ibfk_1` FOREIGN KEY (`User_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
