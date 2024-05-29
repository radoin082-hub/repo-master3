-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 29 mai 2024 à 02:10
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

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
-- Structure de la table `assamentstudent`
--

CREATE TABLE `assamentstudent` (
  `student_email` varchar(255) NOT NULL,
  `title_id` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `assamentstudent`
--

INSERT INTO `assamentstudent` (`student_email`, `title_id`, `id`) VALUES
('radoin082@gmail.com', 14, 23);

-- --------------------------------------------------------

--
-- Structure de la table `topic`
--

CREATE TABLE `topic` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `resume` varchar(255) NOT NULL,
  `speciality` varchar(255) NOT NULL,
  `state` tinyint(4) NOT NULL DEFAULT 0,
  `professeur` varchar(255) NOT NULL,
  `isClosed` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `topic`
--

INSERT INTO `topic` (`id`, `title`, `resume`, `speciality`, `state`, `professeur`, `isClosed`) VALUES
(14, 'theme1', 'dess', 'pro', 1, 'prof1', 0),
(15, 'theme2', 'dess', 'lmd', 0, 'prof2', 0),
(16, 'theme3', 'dess', 'pro', 0, 'prof3', 0),
(17, 'theme4', 'dess', 'eng', 0, 'prof4', 0),
(18, 'theme5', 'dess', 'eng', 0, 'prof5', 0),
(19, 'theme6', 'dess', 'pro', 0, 'prof6', 0);

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
(3, 'zara', 'godchi', 'amz', 'baba', 'mamaty', 'dikrabou@gmail.com', '$2y$10$RV7GyUeP497MUmQyzKi98uofFS0kmJTirD50ocCrLdsAjIODxrq8S', 'M2', 11, 0),
(4, 'safia', 'hoda', 'dikra', 'assia', 'groupe', 'gyzyziozi@gmail.com', '$2y$10$zkVpEhSYM8w8AeBEQ/l67O3o/ifdeDqECF8RVH.4zwXXexK6rs.XW', 'M2', 12, 0),
(5, 'dikra', 'iuy', 'djfirhfu', 'erjkejhfer', 'rozejreijr', 'foufa@gmail.com', '$2y$10$By2wsGbMj1T0o.Xf7/aZG.jg2gFM.H/UVOQWv//jGeXNvhFri7F2C', 'M2', 14, 0),
(6, 'dikra', '', '', '', 'groupe1', 'foufita@gmail.com', '$2y$10$l0FCLa4G4JazZR1khqq.B.7LBz24ABCAk0MOPHsmTtmfbnXF4.W92', 'M2', 13, 0),
(7, 'safia', 'hoda', 'dikra', 'assia', 'RAZAN', 'gdtysttsrfatzf@gmail.com', '$2y$10$nDwzeaLoCtfl8GqB.DGXTeZL6weCqk0iSOCS1yAHLPRZwBQ7y46Fq', 'M2', 15, 0),
(9, 'dikra', 'houda', '', '', 'dik', 'mz@gmail.com', '$2y$10$4xbr5rUAmyYd6MDb2eZSBOmNYQCexLl2IfqN20ynClJ4HhJ5kGsWW', 'L3', 15, 2),
(10, 'lala', 'fofa', '', '', 'sasa', 'sasa@gmail.com', '$2y$10$tIH/A9hu.09kYO7GuVz0beL1KGmxlCCtzAU2mk9HKLRD/uCpzYvki', 'M2', 0, 0),
(11, 'dikra', 'klba', '', '', 'jfheehf', 'eeee@gamil.com', '$2y$10$P/QFzFoSugy6jx5AyFxRrOWrVi.f.XU782/8yV9MzfuBanGBJ86BO', 'M2', 0, 0),
(12, 'safia', 'dikra', '', '', 'GG', 'gg@gmail.com', '$2y$10$l6Nu8qWm1q6mThh3t4pjKOKruomHDMP/yn15S9y2P3MfVE9lQCIsi', 'M2', 0, 0),
(13, 'a', 'b', '', '', 'err', 'err@gmail.com', '$2y$10$C0P.UYpEIICO689BOEo6quQf2aDwDN6zgNfERpIbDNFy/LIQAtrIa', 'M2', 0, 0),
(15, 'dikra', 'huda', '', '', 'DIKRA', 'dikrahuda@gmail.com', '$2y$10$rXC8jkqTvXrTSfZ66mM/sOWKeFLlLFycii2cXpHI0R11TscmAr8dS', 'M2', 0, 0),
(16, 'ss', 'qq', '', '', 'hello', 'dik@gmail.com', '$2y$10$k2Uf44rqDTGuZYEHX2VVIOxz6zZ77olJjFXreq5xAH5e1iVw4eikG', 'M2', 0, 0),
(17, 'selma', 'faiza', '', '', 'groupe2', 'selma@gmail.com', '$2y$10$9f5DVhmayBSuO/3uq2Xf7.wDamHQ72/OTV6DMJvNYqeuN1iRY0FL2', 'M2', 0, 0),
(18, 'dikra boubidi ', 'dikra', '', '', 'groupe1', 'dikraa@gmail.com', '$2y$10$xFUJbCrN3GKZVyYlGrPk2O9y.bv4l.OOnnZo5MTPVKEVSuPV2zeJK', 'L3', 0, 0),
(19, 'dikra', 'dikra', '', '', 'DIKRA', 'zz@gmail.com', '$2y$10$84iAoOCnspasQ3bkOeYZdOjXGJVLcNekZ8e.Ru/UfHXZsw/Cen0PC', 'M2', 0, 0),
(20, 'sss', 'zezeer', '', '', 'rzeyzu', 'oi@gmail.com', '$2y$10$LU7oU43X7rV9hwjpcUsgH.VvrTy5/GaqbewhOjBO6iZieqPRFkxpO', 'M2', 0, 0),
(22, 'baba', 'mama', '', '', 'azer', 'amrisamer54@gmail.com', '20032003', 'L3', 0, 0),
(25, 'samer2', 'samer3', 'samer4', 'samer5', 'amrisamer2', 'amrisamer55@gmail.com', '$2y$10$Fpp9k0hdXB8LKgzm6iJ5Le/QmERTKwz00b3unayruhJl3ax3Bdkj2', 'L3', 17, 1),
(26, 'samer2', 'samer3', 'samer4', 'samer5', 'dikra', 'dikraa1@gmail.com', '$2y$10$3v8GGtn1Xiuw3y0NDV8or..rYmZi/h.t4n1RTXkbNAc.Ez0.jp7ua', 'L3', 0, 0),
(27, 'mohamed', 'ali', 'samer', 'kacem', 'rachedi radouane', 'radoin082@gmail.com', '$2y$10$yjGMoDIW.Ab6Gaf8nHJyUeOMXgTbUrdjKYueBbytGcoTrAh.mzS46', 'L3', 0, 0);

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
(196, 'theme2', 'prof2', 'dess', 1, 'amrisamer55@gmail.com');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `assamentstudent`
--
ALTER TABLE `assamentstudent`
  ADD PRIMARY KEY (`id`),
  ADD KEY `topicid` (`title_id`) USING BTREE,
  ADD KEY `student` (`student_email`);

--
-- Index pour la table `topic`
--
ALTER TABLE `topic`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Index pour la table `wishsheet`
--
ALTER TABLE `wishsheet`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `assamentstudent`
--
ALTER TABLE `assamentstudent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pour la table `topic`
--
ALTER TABLE `topic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT pour la table `wishsheet`
--
ALTER TABLE `wishsheet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=197;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `assamentstudent`
--
ALTER TABLE `assamentstudent`
  ADD CONSTRAINT `student` FOREIGN KEY (`student_email`) REFERENCES `users` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `titleid` FOREIGN KEY (`title_id`) REFERENCES `topic` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
