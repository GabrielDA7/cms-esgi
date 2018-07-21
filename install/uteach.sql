-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  sam. 21 juil. 2018 à 17:20
-- Version du serveur :  5.7.19
-- Version de PHP :  7.1.9

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
-- Structure de la table `chapter`
--

DROP TABLE IF EXISTS `chapter`;
CREATE TABLE IF NOT EXISTS `chapter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `trainning_id` int(11) DEFAULT NULL,
  `dateInserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `premium` tinyint(1) NOT NULL DEFAULT '0',
  `user_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `trainning_id` (`trainning_id`),
  KEY `trainning_id_2` (`trainning_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `chapter`
--

INSERT INTO `chapter` (`id`, `number`, `title`, `image`, `trainning_id`, `dateInserted`, `status`, `premium`, `user_id`) VALUES
(3, 1, 'zzzrttrzztr', 'public/img/chapters/711px-PHP-logo.svg.png', 36, '2018-07-13 20:52:49', 1, 0, 25),
(4, 1, 'zzzrttrzztr', 'public/img/chapters/711px-PHP-logo.svg.png', 36, '2018-07-13 20:53:03', 1, 0, 25),
(5, 1, 'zzzrttrzztr', 'public/img/chapters/711px-PHP-logo.svg.png', 36, '2018-07-13 21:26:34', 1, 0, 25),
(6, 1, 'zzzrttrzztr', 'public/img/chapters/711px-PHP-logo.svg.png', 36, '2018-07-13 21:27:09', 0, 0, 25),
(7, 1, 'zzzrttrzztr', 'public/img/chapters/711px-PHP-logo.svg.png', 36, '2018-07-13 21:32:09', 1, 0, 25),
(8, 1, 'zzzrttrzztr', 'public/img/chapters/711px-PHP-logo.svg.png', 36, '2018-07-13 21:33:25', 1, 0, 25),
(9, 1, 'zzzrttrzztr', 'public/img/chapters/711px-PHP-logo.svg.png', 36, '2018-07-13 21:33:54', 1, 0, 25),
(10, 1, 'zzzrttrzztr', 'public/img/chapters/711px-PHP-logo.svg.png', 36, '2018-07-13 21:34:28', 1, 0, 25),
(11, 1, 'zzzrttrzztr', 'public/img/chapters/711px-PHP-logo.svg.png', 36, '2018-07-13 21:34:39', 1, 0, 25),
(12, 1, 'zzzrttrzztr', 'public/img/chapters/711px-PHP-logo.svg.png', 36, '2018-07-13 21:35:03', 1, 0, 25),
(13, 1, 'zzzrttrzztr', 'public/img/chapters/711px-PHP-logo.svg.png', 36, '2018-07-13 21:35:39', 1, 0, 25),
(14, 2, 'zzzrttrzztr', 'public/img/chapters/711px-PHP-logo.svg.png', 36, '2018-07-13 21:36:45', 1, 0, 25),
(15, 2, 'zzzrttrzztr', 'public/img/chapters/711px-PHP-logo.svg.png', 36, '2018-07-13 21:58:48', 1, 0, 25),
(16, 2, 'zzzrttrzztr', 'public/img/chapters/711px-PHP-logo.svg.png', 36, '2018-07-13 21:59:00', 1, 0, 25),
(17, 2, 'zzzrttrzztr', 'public/img/chapters/711px-PHP-logo.svg.png', 36, '2018-07-13 21:59:45', 1, 0, 25),
(18, 2, 'zzzrttrzztr', 'public/img/chapters/711px-PHP-logo.svg.png', 36, '2018-07-13 22:00:04', 0, 0, 25),
(19, 2, 'zzzrttrzztr', 'public/img/chapters/711px-PHP-logo.svg.png', 36, '2018-07-13 22:00:28', 1, 0, 25),
(20, 2, 'zttzetzert', 'public/img/chapters/711px-PHP-logo.svg.png', 36, '2018-07-13 22:01:05', 1, 0, 25),
(21, 2, 'zttzetzert', 'public/img/chapters/711px-PHP-logo.svg.png', 36, '2018-07-13 22:01:11', 1, 0, 25),
(22, 2, 'zttzetzert', 'public/img/chapters/711px-PHP-logo.svg.png', 36, '2018-07-13 22:01:20', 1, 0, 25),
(23, 2, 'zttzetzert', 'public/img/chapters/711px-PHP-logo.svg.png', 36, '2018-07-13 22:01:26', 1, 0, 25),
(24, 5, 'ekjrrenjfnjref', 'public/img/chapters/711px-PHP-logo.svg.png', 37, '2018-07-14 18:35:06', 1, 0, 25),
(25, 1, 'zezre', NULL, 41, '2018-07-15 15:06:52', 1, 0, 25),
(26, NULL, 'dsdq', NULL, NULL, '2018-07-15 20:41:27', 1, 0, 25),
(27, NULL, 'dsdqqsdqsd', NULL, NULL, '2018-07-15 20:41:32', 1, 0, 25),
(28, NULL, 'qsdqsfqs', NULL, NULL, '2018-07-15 20:42:23', 0, 0, 25);

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `dateInserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `content` text NOT NULL,
  `report` tinyint(1) NOT NULL DEFAULT '0',
  `chapter_id` int(11) DEFAULT NULL,
  `trainning_id` int(11) DEFAULT NULL,
  `video_id` int(11) DEFAULT NULL,
  `comment_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `lesson_id` (`chapter_id`),
  KEY `trainning_id` (`trainning_id`),
  KEY `video_id` (`video_id`),
  KEY `comment_id` (`comment_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`id`, `user_id`, `dateInserted`, `content`, `report`, `chapter_id`, `trainning_id`, `video_id`, `comment_id`) VALUES
(6, 25, '2018-07-14 17:58:39', 'jhbhjhbhj', 1, 23, NULL, NULL, NULL),
(7, 25, '2018-07-14 18:12:06', 'ergtrgerg', 1, NULL, NULL, NULL, 6),
(8, 25, '2018-07-14 18:38:58', 'ezfzefez', 1, 24, NULL, NULL, NULL),
(9, 25, '2018-07-14 18:39:02', 'efreferf', 0, 24, NULL, NULL, NULL),
(10, 25, '2018-07-14 18:53:27', 'fgbfgbgfb', 0, NULL, NULL, NULL, 8),
(11, 25, '2018-07-14 19:14:03', 'erlkgklrze,g', 0, NULL, NULL, NULL, 8),
(12, 25, '2018-07-14 19:27:12', 'rtkktrr', 0, NULL, NULL, NULL, 8),
(13, 25, '2018-07-14 19:27:26', 'rtger,gergger', 0, NULL, NULL, NULL, 8),
(14, 25, '2018-07-14 19:28:38', 'trhrthrth', 0, NULL, NULL, NULL, 8),
(15, 25, '2018-07-14 20:28:52', 'kjnfdgjjdf', 0, NULL, NULL, NULL, 10),
(16, 25, '2018-07-14 20:29:03', 'df,b;dfnvd;f', 0, NULL, NULL, NULL, 15),
(19, 25, '2018-07-18 19:01:21', 'azerazerezar', 0, 27, NULL, NULL, NULL),
(24, 25, '2018-07-18 19:18:16', 'zrgjnkjzernkgnzr', 0, NULL, 43, NULL, NULL),
(25, 25, '2018-07-21 16:27:13', 'erk,gregk', 0, NULL, NULL, 8, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `installation`
--

DROP TABLE IF EXISTS `installation`;
CREATE TABLE IF NOT EXISTS `installation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `siteName` varchar(100) NOT NULL,
  `reasonRegister` text NOT NULL,
  `siteDescription` text NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `part`
--

DROP TABLE IF EXISTS `part`;
CREATE TABLE IF NOT EXISTS `part` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `chapter_id` int(11) DEFAULT NULL,
  `user_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `chapter_id` (`chapter_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `part`
--

INSERT INTO `part` (`id`, `number`, `title`, `content`, `chapter_id`, `user_id`) VALUES
(3, 1, 'zertztrze', 'zertzert', 20, 25),
(4, 2, 'ertezrtzert', 'zertze', 20, 25),
(5, 1, 'zertztrze', 'zertzert', 23, 25),
(6, 2, 'ertezrtzert', 'zertze', 23, 25),
(7, 1, 'erkjfnerfj', 'jkenvjkevnjen', 24, 25),
(8, 2, 'e,nfernfnekfn', 'ekjrkfnjer', 24, 25);

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
  `premiumOffer_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `User_idUser` (`user_id`),
  KEY `premiumOffer_id` (`premiumOffer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `trainning`
--

DROP TABLE IF EXISTS `trainning`;
CREATE TABLE IF NOT EXISTS `trainning` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `dateInserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `premium` tinyint(1) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `user_id_2` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `trainning`
--

INSERT INTO `trainning` (`id`, `title`, `description`, `image`, `dateInserted`, `status`, `premium`, `user_id`) VALUES
(36, 'ztzet', 'zetrzert', 'public/img/trainnings/711px-PHP-logo.svg.png', '2018-07-13 20:11:12', 1, 0, 25),
(37, 'hgvgvgh', 'jhhhvhg', 'public/img/trainnings/711px-PHP-logo.svg.png', '2018-07-13 20:11:37', 1, 0, 58),
(38, 'esgrtgztr', 'zthzrz', 'public/img/trainnings/711px-PHP-logo.svg.png', '2018-07-13 20:12:07', 1, 0, 25),
(39, 'php', 'eth', 'public/img/trainnings/711px-PHP-logo.svg.png', '2018-07-13 20:12:22', 1, 0, 25),
(40, 'AAAAAA', 'tyhrthyr', '/uteach/public/img/trainnings/711px-PHP-logo.svg.png', '2018-07-14 23:00:19', 1, 0, 25),
(41, 'AAAAAA', 'tyhrthyr', 'public/img/trainnings/711px-PHP-logo.svg.png', '2018-07-14 23:02:05', 1, 0, 25),
(42, 'php', 'zeezre', '/uteach/public/img/trainnings/711px-PHP-logo.svg.png', '2018-07-14 23:07:34', 1, 0, 25),
(43, 'er,erglke,', 'kjengkjrnkg', '/uteach/public/img/trainnings/711px-PHP-logo.svg.png', '2018-07-15 14:54:06', 1, 0, 25),
(44, 'ezrterzzer', 'zertzert', '/Uteach/public/img/trainnings/711px-PHP-logo.svg.png', '2018-07-20 19:24:19', 0, 0, 25);

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
  `emailConfirm` varchar(255) NOT NULL DEFAULT '1',
  `userName` varchar(100) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  `pwdReset` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `token` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `dateInserted` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `dateUpdated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `role` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `firstName`, `lastName`, `email`, `emailConfirm`, `userName`, `pwd`, `pwdReset`, `avatar`, `token`, `status`, `dateInserted`, `dateUpdated`, `role`) VALUES
(25, 'Zerzerzerzerze', 'Louis', 'ouizi@gmail.com', '', 'lol', 'c1a1a4b81a220cf8195aa8560bae8a332d17cfe8', NULL, '/uteach/public/img/avatars/default.jpg', 'co7ay7cnctssk00owkgkcgog48ggg4gkgck4gs480swc4c040', 1, '2018-03-20 19:48:58', '2018-07-21 13:32:39', 2),
(33, 'Louis', 'Louis', 'louis@gmail.com', '', 'Lala', 'de271790913ea81742b7d31a70d85f50a3d3e5ae', NULL, NULL, 'v2l5jb39neoww4ow84w4ow40ooo44wswgogw4c4gg48088wgk', 0, '2018-03-24 22:03:33', NULL, 0),
(34, 'Louis', 'Louis', 'louis@gmail.com', '', 'zerazer', 'de271790913ea81742b7d31a70d85f50a3d3e5ae', NULL, NULL, '3iuuy6vxv2w4cs4g8kccsww08wkgg4g048s848k8w8sg8wok04', 0, '2018-03-25 20:08:25', NULL, 0),
(35, 'Louis', 'Louis', 'louis@gmail.com', '', 'Lala', 'de271790913ea81742b7d31a70d85f50a3d3e5ae', NULL, NULL, 'y4tci0mxs9cck844so48csggsosso8w4w004880csc8gk0k0s', 0, '2018-03-25 20:30:28', NULL, 0),
(36, 'Louis', 'Louis', 'louis@gmail.com', '', 'Lala', 'de271790913ea81742b7d31a70d85f50a3d3e5ae', NULL, NULL, '208l9xzozmw0os0sg8gss8c00sgkgwwwkk0goo84scw0gw08go', 0, '2018-03-25 20:44:50', NULL, 0),
(37, 'Louis', 'Louis', 'louis@gmail.com', '', 'Lala', 'de271790913ea81742b7d31a70d85f50a3d3e5ae', NULL, NULL, '250n00lacvtw0o8co4k8oc8ssg000so84g0w8ck8880gkckkc4', 0, '2018-03-30 17:28:42', NULL, 0),
(38, 'Louis', 'Louis', 'louis@gmail.com', '', 'Lala', 'de271790913ea81742b7d31a70d85f50a3d3e5ae', NULL, NULL, '3qkozdnut0is40cccs440g44o8804c0s4kc8oc4ww0sk0wss0g', 0, '2018-03-30 17:34:38', NULL, 0),
(39, 'Louis', 'Louis', 'louis@gmail.com', '', 'admin', 'de271790913ea81742b7d31a70d85f50a3d3e5ae', NULL, NULL, '3mxstvh2hekg0okkcwg8gw8co4wo4k44s0kg04g8sksgss4wck', 0, '2018-03-31 12:18:37', NULL, 2),
(40, 'Louis', 'Louis', 'louis@gmail.com', '', 'Lala', 'de271790913ea81742b7d31a70d85f50a3d3e5ae', NULL, NULL, '5b8op8hmhn48kgkw0o44swss4csswo0kw4sggkk0kc4k48wwow', 0, '2018-04-03 14:15:46', NULL, 1),
(41, 'Louis', 'Louis', 'louis@gmail.com', '', 'Lala', 'de271790913ea81742b7d31a70d85f50a3d3e5ae', NULL, NULL, '60tce6lhva4g48cc084k88wcoss48csk8s0o4wcckw4kwos4g8', 0, '2018-04-04 14:26:22', NULL, 1),
(42, 'Louis', 'Louis', 'louis@gmail.com', '', 'jkjhkjh', 'de271790913ea81742b7d31a70d85f50a3d3e5ae', NULL, NULL, '4ln1t1em6fc4k80kk84wks40k4g84kwwgco84oswosc0s488cg', 0, '2018-04-04 14:26:54', NULL, 1),
(43, 'Zefgizergzhg', 'Oiehfjboehoer', 'ezhfzghljzhglherg@gmail.com', '69d6ut4vyzs4sokcsckc8wc8ws8kwcck80so0kss8w4oggoo0g', 'mefhjgemohjoe', 'c1a1a4b81a220cf8195aa8560bae8a332d17cfe8', NULL, NULL, '1rislwf8mrz4gw8scggkgc88g0kwkcswkwskog4k844wk40gw4', 0, '2018-05-11 18:36:30', NULL, 1),
(44, 'Zefgizergzhg', 'Oiehfjboehoer', 'ezhfzghljzhglherg@gmail.com', '69d6ut4vyzs4sokcsckc8wc8ws8kwcck80so0kss8w4oggoo0g', 'mefhjgemohjoe', 'c1a1a4b81a220cf8195aa8560bae8a332d17cfe8', NULL, NULL, '1rislwf8mrz4gw8scggkgc88g0kwkcswkwskog4k844wk40gw4', 0, '2018-05-11 18:36:30', NULL, 1),
(58, 'Zernjzenrjzen', 'Erkjngerngjnrekj', 'decultot.louis@gmail.com', '3cd2h35goiqsokkgcs0ks00csc84oo4gk008coo8og8csw0o8g', 'ekjgnjkrengjknernge', 'c1a1a4b81a220cf8195aa8560bae8a332d17cfe8', NULL, NULL, '58knyvm395c844w0c8co0sog8848wogowg0w04wsw444sc0ogk', 0, '2018-07-11 17:47:28', NULL, 1),
(60, 'Kezjzetzejuzei', 'Kejrgerngrej', 'gabrieldaoud3112@gmail.com', '1', 'ekrgnjregnjerngzngjn', 'c1a1a4b81a220cf8195aa8560bae8a332d17cfe8', NULL, NULL, '65jqtmixoggsosg0cs4csg8gksw40gg4088s0k4o0skgswkkgk', 0, '2018-07-11 17:58:26', '2018-07-11 18:03:32', 1),
(61, 'Eznlkezlk', 'Zekjnfjzkenfkj', 'zefnzenfzeknf@gmail.com', '26ux6vuiaukgckwwwo4oogk8gk40gcgwgok0cow44kksos8ws0', 'zekjfnjznzjkf', 'c1a1a4b81a220cf8195aa8560bae8a332d17cfe8', NULL, 'public/img/avatars/default.jpg', '4pa6sfyafyqs84w4o084404gcgs8s840ssckgkkso4c4o808g4', 0, '2018-07-13 19:04:54', NULL, 1),
(62, 'Gfddgh', 'Dgdgh', 'aaaaaa@gmail.com', '45qaw4upkg4k84okosggwow0w8ks808owk04sw0gw84kkcw4c8', 'dgdgn', 'c1a1a4b81a220cf8195aa8560bae8a332d17cfe8', NULL, 'public/img/avatars/default.jpg', '3t6zfyzq74sg0okkcc00wwgow04wkog0w0cwkckk8884wgckgc', 0, '2018-07-14 20:36:03', NULL, 1),
(63, 'Azeraze', 'Zertzregz', 'decultot.erferflouis@gmail.com', '4zbhvysjlcowoo04os848g8skkw0g4kckoo8gcowc0k480c4ck', 'zfgbgentrber', 'c1a1a4b81a220cf8195aa8560bae8a332d17cfe8', NULL, 'public/img/avatars/default.jpg', '66cqz8nxzr8kc4ockoc4kkc0osg4ok80o84c4oo8ow48gkckkk', 0, '2018-07-14 20:37:12', NULL, 1),
(64, 'Rgrgrz', 'Aefaefea', 'qzeffzerger@gmail.com', 'fw1wn6bjmi8scc4o00wkook4wwk8ck8ckcg8owosoc00wc0ok', 'ergzerg', 'c1a1a4b81a220cf8195aa8560bae8a332d17cfe8', NULL, '/uteach/public/img/avatars/default.jpg', '6d3wffuvhdgccg8w4gkcoww8so4sgg4s0wowgg0cw04gswksw8', 1, '2018-07-14 20:41:06', '2018-07-21 16:28:21', 1);

-- --------------------------------------------------------

--
-- Structure de la table `video`
--

DROP TABLE IF EXISTS `video`;
CREATE TABLE IF NOT EXISTS `video` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text,
  `url` varchar(255) NOT NULL,
  `dateInserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `premium` tinyint(1) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL,
  `part_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `part_id` (`part_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `video`
--

INSERT INTO `video` (`id`, `title`, `description`, `url`, `dateInserted`, `status`, `premium`, `user_id`, `part_id`) VALUES
(3, 'php', NULL, 'public/img/videos/RÃ‰ACTION A CHAUD DES JOUEURS ! LA FRANCE EN FINALE.mp4', '2018-07-13 22:19:21', 0, 0, 25, NULL),
(4, 'php', NULL, 'public/img/videos/RÃ‰ACTION A CHAUD DES JOUEURS ! LA FRANCE EN FINALE.mp4', '2018-07-13 22:19:52', 0, 0, 25, NULL),
(5, 'php', NULL, 'public/img/videos/RÃ‰ACTION A CHAUD DES JOUEURS ! LA FRANCE EN FINALE.mp4', '2018-07-13 22:20:13', 0, 0, 25, NULL),
(6, 'php', NULL, 'public/img/videos/RÃ‰ACTION A CHAUD DES JOUEURS ! LA FRANCE EN FINALE.mp4', '2018-07-13 22:21:33', 0, 0, 25, NULL),
(7, 'php', NULL, 'public/img/videos/RÃ‰ACTION A CHAUD DES JOUEURS ! LA FRANCE EN FINALE.mp4', '2018-07-13 22:21:48', 0, 0, 25, NULL),
(8, 'rprprp', NULL, '/Uteach/public/img/videos/RÃ‰ACTION A CHAUD DES JOUEURS ! LA FRANCE EN FINALE.mp4', '2018-07-21 16:26:07', 1, 0, 25, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `viewed_chapter`
--

DROP TABLE IF EXISTS `viewed_chapter`;
CREATE TABLE IF NOT EXISTS `viewed_chapter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dateInserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ip` varchar(50) NOT NULL,
  `chapter_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `chapter_id` (`chapter_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `viewed_chapter`
--

INSERT INTO `viewed_chapter` (`id`, `dateInserted`, `ip`, `chapter_id`, `user_id`) VALUES
(1, '2018-07-14 13:18:56', '::1', 23, NULL),
(2, '2018-07-14 13:26:19', '::1', 21, NULL),
(3, '2018-07-14 13:26:32', '192.0.0.0', 11, NULL),
(4, '2018-07-14 13:26:44', '192.25.24.24', 21, NULL),
(5, '2018-07-14 13:26:59', '41.25.24.25', 20, NULL),
(6, '2018-07-14 13:27:08', '10.2.2', 20, NULL),
(7, '2018-07-14 13:27:25', '20.2424.2', 22, NULL),
(8, '2018-07-14 13:27:40', '444444', 21, NULL),
(9, '2018-07-14 18:38:47', '::1', 24, NULL),
(10, '2018-07-14 22:58:33', '::1', 20, NULL),
(11, '2018-07-14 23:03:40', '::1', 22, NULL),
(12, '2018-07-15 20:00:02', '::1', 3, NULL),
(13, '2018-07-16 17:07:11', '::1', 28, NULL),
(14, '2018-07-16 19:12:24', '::1', 27, NULL),
(15, '2018-07-20 19:21:08', '::1', 24, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `viewed_trainning`
--

DROP TABLE IF EXISTS `viewed_trainning`;
CREATE TABLE IF NOT EXISTS `viewed_trainning` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dateInserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ip` varchar(50) NOT NULL,
  `trainning_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trainning_id` (`trainning_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `viewed_trainning`
--

INSERT INTO `viewed_trainning` (`id`, `dateInserted`, `ip`, `trainning_id`, `user_id`) VALUES
(1, '2018-07-14 13:09:20', '::1', 39, NULL),
(2, '2018-07-14 13:17:37', '::1', 38, NULL),
(3, '2018-07-14 18:40:02', '::1', 37, NULL),
(4, '2018-07-18 17:29:51', '::1', 43, NULL),
(5, '2018-07-18 19:02:38', '::1', 42, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `viewed_video`
--

DROP TABLE IF EXISTS `viewed_video`;
CREATE TABLE IF NOT EXISTS `viewed_video` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dateInserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ip` varchar(50) NOT NULL,
  `video_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `video_id` (`video_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `viewed_video`
--

INSERT INTO `viewed_video` (`id`, `dateInserted`, `ip`, `video_id`, `user_id`) VALUES
(1, '2018-07-21 16:26:40', '::1', 8, NULL),
(2, '2018-07-21 16:27:13', '::1', 8, NULL),
(3, '2018-07-21 16:27:22', '::1', 8, NULL),
(4, '2018-07-21 16:27:23', '::1', 8, NULL),
(5, '2018-07-21 16:28:27', '::1', 8, NULL);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `chapter`
--
ALTER TABLE `chapter`
  ADD CONSTRAINT `chapter_ibfk_1` FOREIGN KEY (`trainning_id`) REFERENCES `trainning` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `chapter_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`video_id`) REFERENCES `video` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comment_ibfk_3` FOREIGN KEY (`trainning_id`) REFERENCES `trainning` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comment_ibfk_4` FOREIGN KEY (`chapter_id`) REFERENCES `chapter` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comment_ibfk_5` FOREIGN KEY (`comment_id`) REFERENCES `comment` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `part`
--
ALTER TABLE `part`
  ADD CONSTRAINT `part_ibfk_1` FOREIGN KEY (`chapter_id`) REFERENCES `chapter` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `part_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `premium`
--
ALTER TABLE `premium`
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `trainning`
--
ALTER TABLE `trainning`
  ADD CONSTRAINT `trainning_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `video`
--
ALTER TABLE `video`
  ADD CONSTRAINT `video_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `viewed_chapter`
--
ALTER TABLE `viewed_chapter`
  ADD CONSTRAINT `viewed_chapter_ibfk_1` FOREIGN KEY (`chapter_id`) REFERENCES `chapter` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `viewed_chapter_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `viewed_trainning`
--
ALTER TABLE `viewed_trainning`
  ADD CONSTRAINT `viewed_trainning_ibfk_1` FOREIGN KEY (`trainning_id`) REFERENCES `trainning` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `viewed_trainning_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `viewed_video`
--
ALTER TABLE `viewed_video`
  ADD CONSTRAINT `viewed_video_ibfk_1` FOREIGN KEY (`video_id`) REFERENCES `video` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `viewed_video_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
