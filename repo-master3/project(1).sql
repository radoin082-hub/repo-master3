-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 09 mai 2024 à 10:50
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `project`
--

-- --------------------------------------------------------

--
-- Structure de la table `topic`
--

CREATE TABLE `topic` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `resume` varchar(255) NOT NULL,
  `speciality` varchar(255) NOT NULL,
  `state` enum('invalide','validated') NOT NULL,
  `professeur` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `topic`
--

INSERT INTO `topic` (`id`, `title`, `resume`, `speciality`, `state`, `professeur`) VALUES
(14, 'theme1', 'dess', '', 'invalide', 'prof1'),
(15, 'theme2', 'dess', '', 'invalide', 'prof2'),
(16, 'theme3', 'dess', '', 'invalide', 'prof3'),
(17, 'theme4', 'dess', '', 'invalide', 'prof4'),
(18, 'theme5', 'dess', '', 'invalide', 'prof5'),
(19, 'theme6', 'dess', '', 'invalide', 'prof6');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `second_name` varchar(255) NOT NULL,
  `third_name` varchar(255) NOT NULL,
  `fourth_name` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `education_level` enum('L3','M2') NOT NULL,
  `Average` int(11) NOT NULL,
  `Ranking` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `first_name`, `second_name`, `third_name`, `fourth_name`, `full_name`, `email`, `password`, `education_level`, `Average`, `Ranking`) VALUES
(2, 'fff', 'ssss', 'zzzzz', 'oooo', 'heloo', 'dikraboubidi@gmail.com', '$2y$10$.L/s2mkj4pIW4.R.NVUEM.85KITV15Q5GvzvoZgDiUWL0iXSOxbui', 'L3', 10, 0),
(3, 'zara', 'godchi', 'amz', 'baba', 'mamaty', 'dikrabou@gmail.com', '$2y$10$RV7GyUeP497MUmQyzKi98uofFS0kmJTirD50ocCrLdsAjIODxrq8S', 'M2', 11, 0),
(4, 'safia', 'hoda', 'dikra', 'assia', 'groupe', 'gyzyziozi@gmail.com', '$2y$10$zkVpEhSYM8w8AeBEQ/l67O3o/ifdeDqECF8RVH.4zwXXexK6rs.XW', 'M2', 12, 0),
(5, 'dikra', 'iuy', 'djfirhfu', 'erjkejhfer', 'rozejreijr', 'foufa@gmail.com', '$2y$10$By2wsGbMj1T0o.Xf7/aZG.jg2gFM.H/UVOQWv//jGeXNvhFri7F2C', 'M2', 14, 0),
(6, 'dikra', '', '', '', 'groupe1', 'foufita@gmail.com', '$2y$10$l0FCLa4G4JazZR1khqq.B.7LBz24ABCAk0MOPHsmTtmfbnXF4.W92', 'M2', 13, 0),
(7, 'safia', 'hoda', 'dikra', 'assia', 'RAZAN', 'gdtysttsrfatzf@gmail.com', '$2y$10$nDwzeaLoCtfl8GqB.DGXTeZL6weCqk0iSOCS1yAHLPRZwBQ7y46Fq', 'M2', 15, 0),
(8, 'Walid', '', '', '', 'Walid Walid', 'w@w.com', '$2y$10$ACzAeK6Laslh.3xh9xxQHeHeb3kkZNTEubNKP6Ira3/w4naWOtItq', 'L3', 0, 0),
(9, 'dikra', 'houda', '', '', 'dik', 'mz@gmail.com', '$2y$10$4xbr5rUAmyYd6MDb2eZSBOmNYQCexLl2IfqN20ynClJ4HhJ5kGsWW', 'L3', 16, 0),
(10, 'lala', 'fofa', '', '', 'sasa', 'sasa@gmail.com', '$2y$10$tIH/A9hu.09kYO7GuVz0beL1KGmxlCCtzAU2mk9HKLRD/uCpzYvki', 'M2', 0, 0),
(11, 'dikra', 'klba', '', '', 'jfheehf', 'eeee@gamil.com', '$2y$10$P/QFzFoSugy6jx5AyFxRrOWrVi.f.XU782/8yV9MzfuBanGBJ86BO', 'M2', 0, 0),
(12, 'safia', 'dikra', '', '', 'GG', 'gg@gmail.com', '$2y$10$l6Nu8qWm1q6mThh3t4pjKOKruomHDMP/yn15S9y2P3MfVE9lQCIsi', 'M2', 0, 0),
(13, 'a', 'b', '', '', 'err', 'err@gmail.com', '$2y$10$C0P.UYpEIICO689BOEo6quQf2aDwDN6zgNfERpIbDNFy/LIQAtrIa', 'M2', 0, 0),
(14, 'fofa', 'dikra', 'huda', 'asia', 'GROUPE1', 'groupe@gmail.com', '$2y$10$5TY8E07YCxVqCFeUqKhS..7wp9XN3Hk/HIPHz8kopAI4ZOPbDbyEq', 'L3', 0, 0),
(15, 'dikra', 'huda', '', '', 'DIKRA', 'dikrahuda@gmail.com', '$2y$10$rXC8jkqTvXrTSfZ66mM/sOWKeFLlLFycii2cXpHI0R11TscmAr8dS', 'M2', 0, 0),
(16, 'ss', 'qq', '', '', 'hello', 'dik@gmail.com', '$2y$10$k2Uf44rqDTGuZYEHX2VVIOxz6zZ77olJjFXreq5xAH5e1iVw4eikG', 'M2', 0, 0),
(17, 'selma', 'faiza', '', '', 'groupe2', 'selma@gmail.com', '$2y$10$9f5DVhmayBSuO/3uq2Xf7.wDamHQ72/OTV6DMJvNYqeuN1iRY0FL2', 'M2', 0, 0),
(18, 'dikra boubidi ', 'dikra', '', '', 'groupe1', 'dikraa@gmail.com', '$2y$10$xFUJbCrN3GKZVyYlGrPk2O9y.bv4l.OOnnZo5MTPVKEVSuPV2zeJK', 'M2', 0, 0),
(19, 'dikra', 'dikra', '', '', 'DIKRA', 'zz@gmail.com', '$2y$10$84iAoOCnspasQ3bkOeYZdOjXGJVLcNekZ8e.Ru/UfHXZsw/Cen0PC', 'M2', 0, 0),
(20, 'sss', 'zezeer', '', '', 'rzeyzu', 'oi@gmail.com', '$2y$10$LU7oU43X7rV9hwjpcUsgH.VvrTy5/GaqbewhOjBO6iZieqPRFkxpO', 'M2', 0, 0),
(21, 'TOFAHA', 'CHINA', 'MADARINA', 'KHOKHA', 'BANAN', 'BANAN@gmail.com', '$2y$10$NL0GUsjpDdG812ItKYxhoeZUR3sn3lG4.7VsA91fkvROxEFmQiLK.', 'L3', 0, 0),
(22, 'baba', 'mama', '', '', 'azer', 'azaz@gmail.com', '$2y$10$5WSupcAf0v8tFvujlmunlOeh1EnmaKnSE.T.p23oDpxWAn6S5SnTm', 'M2', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `wishsheet`
--

CREATE TABLE `wishsheet` (
  `id` int(11) NOT NULL,
  `theme` varchar(255) NOT NULL,
  `professor` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `priority` int(11) NOT NULL,
  `email` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `wishsheet`
--

INSERT INTO `wishsheet` (`id`, `theme`, `professor`, `description`, `priority`, `email`) VALUES
(87, 'theme2', 'dess', 'prof2', 2, 'groupe@gmail.com'),
(88, 'theme1', 'dess', 'prof1', 3, 'groupe@gmail.com'),
(89, 'theme5', 'dess', 'prof5', 4, 'groupe@gmail.com'),
(90, 'theme2', 'dess', 'prof2', 5, 'groupe@gmail.com'),
(91, 'theme1', 'prof1', 'dess', 1, 'dikrahuda@gmail.com'),
(92, 'theme2', 'prof2', 'dess', 2, 'dikrahuda@gmail.com'),
(93, 'theme2', 'prof2', 'dess', 1, 'dik@gmail.com'),
(94, 'theme1', 'prof1', 'dess', 2, 'dik@gmail.com'),
(95, 'theme1', 'prof1', 'dess', 1, 'selma@gmail.com'),
(96, 'theme4', 'prof4', 'dess', 2, 'selma@gmail.com'),
(97, 'theme1', 'prof1', 'dess', 1, 'dikraa@gmail.com'),
(98, 'theme2', 'prof2', 'dess', 2, 'dikraa@gmail.com'),
(99, 'theme3', 'prof3', 'dess', 3, 'dikraa@gmail.com'),
(100, 'theme4', 'prof4', 'dess', 4, 'dikraa@gmail.com'),
(101, 'theme1', 'prof1', 'dess', 1, 'zz@gmail.com'),
(102, 'theme2', 'prof2', 'dess', 2, 'zz@gmail.com'),
(104, 'theme3', 'prof3', 'dess', 1, 'BANAN@gmail.com'),
(105, 'theme4', 'prof4', 'dess', 2, 'BANAN@gmail.com'),
(106, 'theme1', 'prof1', 'dess', 1, 'azaz@gmail.com'),
(107, 'theme2', 'prof2', 'dess', 2, 'azaz@gmail.com'),
(108, 'theme1', 'prof1', 'dess', 3, 'azaz@gmail.com');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `topic`
--
ALTER TABLE `topic`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `wishsheet`
--
ALTER TABLE `wishsheet`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `topic`
--
ALTER TABLE `topic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `wishsheet`
--
ALTER TABLE `wishsheet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
