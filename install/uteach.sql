-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 10, 2018 at 04:35 PM
-- Server version: 10.1.26-MariaDB-0+deb9u1
-- PHP Version: 7.0.30-0+deb9u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uteach`
--

-- --------------------------------------------------------

--
-- Table structure for table `chapter`
--

CREATE TABLE `chapter` (
  `id` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `trainning_id` int(11) DEFAULT NULL,
  `dateInserted` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chapter`
--

INSERT INTO `chapter` (`id`, `number`, `title`, `image`, `trainning_id`, `dateInserted`) VALUES
(1, 1, 'Les bases', NULL, 1, NULL),
(2, 1, 'jhkj', NULL, 6, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `content` text NOT NULL,
  `chapter_id` int(11) NOT NULL,
  `trainning_id` int(11) NOT NULL,
  `video_id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `user_id`, `date`, `content`, `chapter_id`, `trainning_id`, `video_id`, `comment_id`) VALUES
(23, 25, '2018-07-09 18:47:44', 'dsfsdf', 1, 0, 0, 0),
(24, 25, '2018-07-10 14:11:22', 'dsfsdfs', 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `part`
--

CREATE TABLE `part` (
  `id` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `chapter_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `part`
--

INSERT INTO `part` (`id`, `number`, `title`, `author`, `content`, `chapter_id`) VALUES
(1, 1, 'introduction', 'Louis decultot', 'voici l\'introduction', 1),
(2, 2, 'Les bases', 'Louis Decultot', 'les bases de la bddd', 1);

-- --------------------------------------------------------

--
-- Table structure for table `premium`
--

CREATE TABLE `premium` (
  `id` int(11) NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `trainning`
--

CREATE TABLE `trainning` (
  `id` int(10) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `author` varchar(255) NOT NULL,
  `dateInserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trainning`
--

INSERT INTO `trainning` (`id`, `title`, `description`, `image`, `author`, `dateInserted`) VALUES
(1, 'Creer uns bdd', 'Cette fromation vas apprendre a creer une bdd', NULL, 'Louis decultot', '2018-04-23 13:33:19'),
(2, 'php', 'le php', 'public/img/php.png', 'lol', '2018-04-26 08:37:04'),
(3, 'llll', 'hhkhkh', 'public/img/php.png', 'lol', '2018-04-26 11:16:01'),
(4, 'azeaze', 'azeaze', NULL, 'lol', '2018-04-28 18:23:21'),
(5, 'azeaze', 'azeaze', 'public/img/ac3-guerre-wallpaper-1920x1080.jpg', 'lol', '2018-04-28 18:25:54'),
(6, 'azeazeazezae', 'zaeazezaeze', NULL, 'lol', '2018-05-11 13:43:01'),
(7, 'azeazeazezae', 'zaeazezaeze', NULL, 'lol', '2018-05-11 13:43:31'),
(8, 'azeazeazezae', 'zaeazezaeze', NULL, 'lol', '2018-05-11 13:43:40'),
(9, 'gtrezz', 'aazeazer', NULL, 'lol', '2018-05-11 13:43:52'),
(10, 'ergerg', 'reqazgerger', NULL, 'lol', '2018-05-11 13:44:07'),
(11, 'zgergfdhbhghjhstrh', 'srthrtshsrth', NULL, 'lol', '2018-05-11 13:44:11'),
(12, 'sgdfsbshrth', 'esthsrthsth', NULL, 'lol', '2018-05-11 13:44:15'),
(13, 'srththcf', 'shsrhstr', NULL, 'lol', '2018-05-11 13:44:19'),
(14, 'seg esr gesh ', 's rths rth', NULL, 'lol', '2018-05-11 13:44:22'),
(15, 'srt hsrt hsrt h', 'h q h', NULL, 'lol', '2018-05-11 13:44:25'),
(16, 'hqhsj trh', 'st rhsr t', NULL, 'lol', '2018-05-11 13:44:28'),
(17, 'test1', 'dsfsdf', NULL, 'gabletop', '2018-05-12 23:37:55'),
(18, 'test2', 'dsfsdf', NULL, 'gabletop', '2018-05-12 23:37:55'),
(19, 'test3', 'dsfsdf', NULL, 'gabletop', '2018-05-12 23:37:55'),
(20, 'test4', 'dsfsdf', NULL, 'gabletop', '2018-05-12 23:37:55'),
(21, 'test5', 'dsfsdf', NULL, 'gabletop', '2018-05-12 23:37:55'),
(22, 'test6', 'dsfsdf', NULL, 'gabletop', '2018-05-12 23:37:55'),
(23, 'test7', 'dsfsdf', NULL, 'gabletop', '2018-05-12 23:37:56'),
(24, 'test8', 'dsfsdf', NULL, 'gabletop', '2018-05-12 23:37:56'),
(25, 'test9', 'dsfsdf', NULL, 'gabletop', '2018-05-12 23:37:56'),
(26, 'test10', 'dsfsdf', NULL, 'gabletop', '2018-05-12 23:37:56'),
(27, 'test11', 'dsfsdf', NULL, 'gabletop', '2018-05-12 23:37:56'),
(28, 'test12', 'dsfsdf', NULL, 'gabletop', '2018-05-12 23:37:56'),
(29, 'test13', 'dsfsdf', NULL, 'gabletop', '2018-05-12 23:37:56'),
(30, 'test14', 'dsfsdf', NULL, 'gabletop', '2018-05-12 23:37:56'),
(31, 'test15', 'dsfsdf', NULL, 'gabletop', '2018-05-12 23:37:56'),
(32, 'test16', 'dsfsdf', NULL, 'gabletop', '2018-05-12 23:37:56'),
(33, 'test17', 'dsfsdf', NULL, 'gabletop', '2018-05-12 23:37:56'),
(34, 'test18', 'dsfsdf', NULL, 'gabletop', '2018-05-12 23:37:56'),
(35, 'test19', 'dsfsdf', NULL, 'gabletop', '2018-05-12 23:37:56');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `emailConfirm` varchar(255) NOT NULL,
  `userName` varchar(100) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `token` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `dateInserted` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `dateUpdated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `role` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstName`, `lastName`, `email`, `emailConfirm`, `userName`, `pwd`, `avatar`, `token`, `status`, `dateInserted`, `dateUpdated`, `role`) VALUES
(20, 'Zqet', 'Qzetqzet', 'louis@gmail.com', '', 'aaaaa', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', NULL, '2v3wh6jleww0g8k4ow804gogg4w4owcw8owc0cgsggg44s0g40', 0, '2018-03-14 12:20:10', '2018-03-30 21:41:16', 2),
(23, 'Louis', 'Louis', 'louis@gmail.com', '', 'Lala', 'de271790913ea81742b7d31a70d85f50a3d3e5ae', NULL, '4k5qdza6baio0sg0sc4oc44ggowcc880o8ccsg044cc8skscsg', 1, '2018-03-20 19:41:10', '2018-03-30 21:48:46', 0),
(24, 'Louis', 'Louis', 'louis@gmail.com', '', 'Lala', 'de271790913ea81742b7d31a70d85f50a3d3e5ae', NULL, '66myo5znw64gwowkcwgkg44oo4wg0ogoksswgosw00kgs44ok4', 0, '2018-03-20 19:44:31', NULL, 0),
(25, 'Louis', 'Louis', 'louis@gmail.com', '', 'lol', 'c1a1a4b81a220cf8195aa8560bae8a332d17cfe8', NULL, 'edmlo29ftzwwkg8s4w8w0cccg4ckgcwkk48kccwo88g840kcg', 1, '2018-03-20 19:48:58', '2018-04-23 09:42:58', 2),
(26, 'LOUIS', 'LOUIS', 'louis@gmail.com', '', 'Lala', 'de271790913ea81742b7d31a70d85f50a3d3e5ae', NULL, '2whcvk8hjtq8w0kwcs8ow80sws40cccgg8gkows0oc4kkwcssg', 0, '2018-03-20 19:58:29', NULL, 0),
(27, 'LOUIS', 'LOUIS', 'louis@gmail.com', '', 'Lala', 'de271790913ea81742b7d31a70d85f50a3d3e5ae', NULL, 'gpxzj6bqeygwsk0s0w8o8sggos04wkokw0ck88o080gswg008', 0, '2018-03-21 18:58:02', NULL, 0),
(28, 'ARETARET', 'ERATREAT', 'louis@gmail.com', '', 'teate', 'de271790913ea81742b7d31a70d85f50a3d3e5ae', NULL, '6auoeiaxbickogc044kowwsw0c08ock4s484k8ocsoowso0k4w', 0, '2018-03-24 21:24:35', NULL, 0),
(29, 'AZRRZ', 'AZRRZAZR', 'louis@gmail.com', '', 'zraze', 'de271790913ea81742b7d31a70d85f50a3d3e5ae', NULL, '3ub8rvuptqck8scsc0koko4kksck0okc0goos0g4g00gckcwss', 0, '2018-03-24 21:25:00', NULL, 0),
(30, 'Azrrz', 'Azrrzazr', 'louis@gmail.com', '', 'zraze', 'de271790913ea81742b7d31a70d85f50a3d3e5ae', NULL, '45nvhkmpvy04owokwgw44w44skc44kco0444kok0wkwgo8gogs', 0, '2018-03-24 21:29:21', NULL, 0),
(31, 'Louis', 'Louis', 'louis@gmail.com', '', 'Lala', 'de271790913ea81742b7d31a70d85f50a3d3e5ae', NULL, '611jmyni2nc4sc40o8ocwck0kkkks8soskwog488ckkgc40so8', 0, '2018-03-24 21:37:33', NULL, 0),
(32, 'Louis', 'Louis', 'louis@gmail.com', '', 'Lala', 'de271790913ea81742b7d31a70d85f50a3d3e5ae', NULL, 'i1bx9sjjgl4wwwog08gooc4ckkc8csc00gwgsscoog0okko04', 0, '2018-03-24 22:01:36', NULL, 0),
(33, 'Louis', 'Louis', 'louis@gmail.com', '', 'Lala', 'de271790913ea81742b7d31a70d85f50a3d3e5ae', NULL, 'v2l5jb39neoww4ow84w4ow40ooo44wswgogw4c4gg48088wgk', 0, '2018-03-24 22:03:33', NULL, 0),
(34, 'Louis', 'Louis', 'louis@gmail.com', '', 'zerazer', 'de271790913ea81742b7d31a70d85f50a3d3e5ae', NULL, '3iuuy6vxv2w4cs4g8kccsww08wkgg4g048s848k8w8sg8wok04', 0, '2018-03-25 20:08:25', NULL, 0),
(35, 'Louis', 'Louis', 'louis@gmail.com', '', 'Lala', 'de271790913ea81742b7d31a70d85f50a3d3e5ae', NULL, 'y4tci0mxs9cck844so48csggsosso8w4w004880csc8gk0k0s', 0, '2018-03-25 20:30:28', NULL, 0),
(36, 'Louis', 'Louis', 'louis@gmail.com', '', 'Lala', 'de271790913ea81742b7d31a70d85f50a3d3e5ae', NULL, '208l9xzozmw0os0sg8gss8c00sgkgwwwkk0goo84scw0gw08go', 0, '2018-03-25 20:44:50', NULL, 0),
(37, 'Louis', 'Louis', 'louis@gmail.com', '', 'Lala', 'de271790913ea81742b7d31a70d85f50a3d3e5ae', NULL, '250n00lacvtw0o8co4k8oc8ssg000so84g0w8ck8880gkckkc4', 0, '2018-03-30 17:28:42', NULL, 0),
(38, 'Louis', 'Louis', 'louis@gmail.com', '', 'Lala', 'de271790913ea81742b7d31a70d85f50a3d3e5ae', NULL, '3qkozdnut0is40cccs440g44o8804c0s4kc8oc4ww0sk0wss0g', 0, '2018-03-30 17:34:38', NULL, 0),
(39, 'Louis', 'Louis', 'louis@gmail.com', '', 'admin', 'de271790913ea81742b7d31a70d85f50a3d3e5ae', NULL, '3mxstvh2hekg0okkcwg8gw8co4wo4k44s0kg04g8sksgss4wck', 0, '2018-03-31 12:18:37', NULL, 2),
(40, 'Louis', 'Louis', 'louis@gmail.com', '', 'Lala', 'de271790913ea81742b7d31a70d85f50a3d3e5ae', NULL, '5b8op8hmhn48kgkw0o44swss4csswo0kw4sggkk0kc4k48wwow', 0, '2018-04-03 14:15:46', NULL, 1),
(41, 'Louis', 'Louis', 'louis@gmail.com', '', 'Lala', 'de271790913ea81742b7d31a70d85f50a3d3e5ae', NULL, '60tce6lhva4g48cc084k88wcoss48csk8s0o4wcckw4kwos4g8', 0, '2018-04-04 14:26:22', NULL, 1),
(42, 'Louis', 'Louis', 'louis@gmail.com', '', 'jkjhkjh', 'de271790913ea81742b7d31a70d85f50a3d3e5ae', NULL, '4ln1t1em6fc4k80kk84wks40k4g84kwwgco84oswosc0s488cg', 0, '2018-04-04 14:26:54', NULL, 1),
(43, 'Zefgizergzhg', 'Oiehfjboehoer', 'ezhfzghljzhglherg@gmail.com', '69d6ut4vyzs4sokcsckc8wc8ws8kwcck80so0kss8w4oggoo0g', 'mefhjgemohjoe', 'c1a1a4b81a220cf8195aa8560bae8a332d17cfe8', NULL, '1rislwf8mrz4gw8scggkgc88g0kwkcswkwskog4k844wk40gw4', 0, '2018-05-11 18:36:30', NULL, 1),
(44, 'Zefgizergzhg', 'Oiehfjboehoer', 'ezhfzghljzhglherg@gmail.com', '69d6ut4vyzs4sokcsckc8wc8ws8kwcck80so0kss8w4oggoo0g', 'mefhjgemohjoe', 'c1a1a4b81a220cf8195aa8560bae8a332d17cfe8', NULL, '1rislwf8mrz4gw8scggkgc88g0kwkcswkwskog4k844wk40gw4', 0, '2018-05-11 18:36:30', NULL, 1),
(50, 'Gabriel', 'Daoud', 'gabrieldaoud3112@gmail.com', '1', 'D3oneLeBoss', 'c1a1a4b81a220cf8195aa8560bae8a332d17cfe8', NULL, '438gynozi0kkw8g8s0skw0oo8sg8co0owsks8k0s8g84occowo', 1, '2018-05-12 13:33:51', '2018-05-12 13:34:06', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chapter`
--
ALTER TABLE `chapter`
  ADD PRIMARY KEY (`id`),
  ADD KEY `trainning_id` (`trainning_id`),
  ADD KEY `trainning_id_2` (`trainning_id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lesson_id` (`chapter_id`),
  ADD KEY `trainning_id` (`trainning_id`),
  ADD KEY `video_id` (`video_id`),
  ADD KEY `comment_id` (`comment_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `part`
--
ALTER TABLE `part`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chapter_id` (`chapter_id`);

--
-- Indexes for table `premium`
--
ALTER TABLE `premium`
  ADD PRIMARY KEY (`id`),
  ADD KEY `User_idUser` (`user_id`);

--
-- Indexes for table `trainning`
--
ALTER TABLE `trainning`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chapter`
--
ALTER TABLE `chapter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `part`
--
ALTER TABLE `part`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `premium`
--
ALTER TABLE `premium`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `trainning`
--
ALTER TABLE `trainning`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `chapter`
--
ALTER TABLE `chapter`
  ADD CONSTRAINT `chapter_ibfk_1` FOREIGN KEY (`trainning_id`) REFERENCES `trainning` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `part`
--
ALTER TABLE `part`
  ADD CONSTRAINT `part_ibfk_1` FOREIGN KEY (`chapter_id`) REFERENCES `chapter` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `premium`
--
ALTER TABLE `premium`
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
