-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 19 Mars 2018 à 19:29
-- Version du serveur :  5.7.9
-- Version de PHP :  5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
  `idPremium` int(11) NOT NULL AUTO_INCREMENT,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `User_idUser` int(11) NOT NULL,
  PRIMARY KEY (`idPremium`),
  KEY `User_idUser` (`User_idUser`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `premium`
--

INSERT INTO `premium` (`idPremium`, `start_date`, `end_date`, `User_idUser`) VALUES
(1, '2018-03-14', '2018-03-16', 20),
(2, '2018-03-14', '2018-03-16', 19);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `idUser` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(100) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `age` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `date_inserted` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `premium` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idUser`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`idUser`, `firstname`, `name`, `email`, `username`, `pwd`, `token`, `age`, `status`, `date_inserted`, `date_updated`, `premium`) VALUES
(12, 'LOUIS', 'LOUIS', 'louis@gmail.com', '', '$2y$10$ck.AkZx1n6T.sUTclyinIeZ/fdW6IYhQ7jWk1sWIl5UM.ZYBilT8q', '4doloa4pp0u8cwokg0csgo4sc8g4w84wckgwk8os0gswowgcsg', 20, 0, '2018-03-13 14:09:07', NULL, 0),
(13, 'LOUIS', 'LOUIS', 'louis@gmail.com', '', '$2y$10$wg7y4dX5mIIBo9HgV/DboeuIA6/qkeS.W3EfMhO7RTmdkYadM5LYW', '5we9mm906ask00gcscg0kgww8sogwksksc88o0o8cc0400848o', 20, 0, '2018-03-13 14:09:07', NULL, 0),
(14, 'LOUIS', 'LOUIS', 'louis@gmail.com', '', '$2y$10$WfIQa95hMn4e35qx4My87OnEFoAHDiNgvMESRVLrnPv6NaTqyKWiq', '2owtiywyzhk48g04wwo4sk08o0skwoggkcw0o8448cc0s8cgs0', 20, 0, '2018-03-13 14:09:08', NULL, 0),
(15, 'LOUIS', 'LOUIS', 'louis@gmail.com', '', '$2y$10$czRSbU76awBJpz3Z8bNq5O6rbgsj7svsw4fRhGS5hWbJeTrXkOZKS', '3rgyhxmqrd44kwwgkswcc4w880840c8wg400w08kogs40ksgso', 20, 0, '2018-03-13 14:09:08', NULL, 0),
(16, 'LOUIS', 'LOUIS', 'louis@gmail.com', '', '$2y$10$4.pNtENW9xKTAlzULsxCRe1NIi3PyIED3Pf3EVv.sKUedqKAYYhWK', '4nqcdo37z3wgc4sw4go8wc044kgs84gco44g0oosg0wc408wg4', 20, 0, '2018-03-13 14:09:08', NULL, 0),
(18, 'LOUIS', 'LOUIS', 'louis@gmail.com', 'Lala', '$2y$10$RfDheOcyIkHbjqawYVeQ2.ulBkrQwLJOiFn3fsu9ZMSlMJ6uHq6WS', '5cg80fvc40ows8o0s48co4sw44g0ks8000w0koowckkg408ogo', 20, 0, '2018-03-13 15:20:45', NULL, 0),
(19, 'LOUIS', 'LOUIS', 'louis@gmail.com', 'Lala', 'de271790913ea81742b7d31a70d85f50a3d3e5ae', 'g88u88regdss8w840g4og0kssskokcgoo0o40s444ocggcws4', 20, 0, '2018-03-13 15:40:57', NULL, 0),
(20, 'LOUIS', 'LOUIS', 'louis@gmail.com', 'Lala', 'de271790913ea81742b7d31a70d85f50a3d3e5ae', '2v3wh6jleww0g8k4ow804gogg4w4owcw8owc0cgsggg44s0g40', 20, 0, '2018-03-14 12:20:10', NULL, 0);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `premium`
--
ALTER TABLE `premium`
  ADD CONSTRAINT `premium_ibfk_1` FOREIGN KEY (`User_idUser`) REFERENCES `user` (`idUser`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
