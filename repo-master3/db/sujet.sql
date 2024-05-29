-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 29 mai 2024 à 02:11
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
-- Base de données : `sujet`
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
  `state` enum('invalide','validated','assignmant','') NOT NULL,
  `professeur` varchar(255) NOT NULL,
  `isClosed` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `topic`
--

INSERT INTO `topic` (`id`, `title`, `resume`, `speciality`, `state`, `professeur`, `isClosed`) VALUES
(1, 'Building a 6 Degree-of-Freedom manipulation Arm with some specific constraints.', 'This project aims to build a 6 degrees of freedom (DOF)\r\nmanipulation arm with specific constraints in a simulated\r\nenvironment. It allows the exploration of robotics\r\nconcepts, kinematics, control systems and simulation\r\ntechniques', 'SI', 'validated', 'Akrour Djoher', 1),
(2, 'Application mobile pour la reconnaissance optique des caractères', 'Ce projet a pour objectif de réaliser une application\r\nmobile de reconnaissance optique des caractères qui\r\npermet aux utilisateurs de capturer du texte à partir\r\nd\'images, puis de le convertir en texte éditable', 'SI', 'invalide', 'Babahenini Djihane', 1),
(3, 'Visiting Heritage Sites in Augmented Reality and Virtual Reality', 'The project aims to use virtual reality and augmented\r\nreality to take visitors on a virtual tour or to create a\r\nhistorical site, thus building a bridge between the past', 'SI', 'invalide', 'Babahenini mohamed', 1),
(5, 'Application basé image sur la fusion d\'images pour l\'amélioration de la photo', 'Amélioration de l\'image :\r\nFusionner des images pour obtenir une meilleure\r\nexposition, une plus grande netteté et une réduction du\r\nbruit', 'SI', 'invalide', 'Babahenini Sara', 1),
(6, 'Developpement of a cybersecurity tool for a company', 'In our increasingly digitized world, the looming threat of\r\ncyber attacks has made cyber security a topic of utmost\r\nimportance. With every piece of information and every\r\ntransaction happening onine, the digital landscape is a\r\nplace of immense opportuni', 'SI', 'invalide', 'Betira Rofaida', 1),
(7, 'Création d\'un site e-commerce (boutique en ligne)', 'Contexte:\r\n- Évolution du commerce électronique et des habitudes\r\nd\'achat en ligne.\r\n- Importance d\'avoir une présence en ligne pour les\r\nentreprises et commerçants.', 'SI', 'invalide', 'Berghida Meriem', 1),
(14, 'Design and development of a job\r\nboard platform', 'The Job Board platform aims to create a platform where\r\nemployers can post job openings and job seekers can\r\nsearch for and apply to those positions.', 'SI', 'invalide', 'Berima Salima', 1),
(15, 'Une plate-forme numérique pour la\r\nréception de réclamations des\r\ncitoyens de la wilaya de Biskra au\r\nniveau de l\'APW', 'Le travail demandé consiste à implémenter une plateforme (un ste Web) pour objectif de traiter et de répondre\r\naux réclamations envoyées par les citoyens de Biskra par\r\nles membres de l\'APW.\r\nIl nécessite en premier lieu de discuter avec le président\r\nde ', 'SI', 'invalide', 'Bennaoui Hammadi', 1),
(16, 'Enhancing Property Managemen\r\nSystems through Advanced\r\nScheduling Algorithms', 'In this project, we aim to develop an innovative Property\r\nManagement System (PMS) that\r\nintegrates sophisticated scheduling algorithms,\r\nspecifically metaheuristics, to optimize task\r\nallocation and resource management', 'SI', 'invalide', 'Tibarmacine Ahmed', 1),
(17, 'Dévéloppement d’une plateforme de\r\ngestion et de numérisation d’une\r\nétablissement éducatif : cas d’étude\r\nune CEM', 'cette plateforme consiste à numériser la gestion d\'une\r\nCEM d\'une part et de faciliter le suivi des parents pour\r\nces enfants tout ce qui concerne note document absence\r\nat annonces. en plus elle facilite la communication entre\r\nenseignant et parents.', 'SI', 'invalide', 'Hattab Dalila', 1),
(18, 'application mobile assurance', 'Le secteur des assurances est un domaine en constante\r\névolution. En proposant des applications mobiles\r\nd’assurance, les compagnies d’assurance donnent la\r\npossibilité à leurs abonnés de rester toujours connectés\r\navec eux et de recevoir un servi', 'SI', 'invalide', 'Hamida Ammar', 1),
(19, 'Une approche d\'apprentissage\r\nautomatique pour la prévision\r\nmétéorologique', 'La prévision météorologique constitue un défi majeur\r\ndans le département de météorologie en raison des\r\nchangements climatiques récurrents. De nombreuses\r\nactivités de plein air sont donc affectées par ces\r\nchangements et des rapports météorologiques ine', 'SI', 'invalide', 'Hamidi Zohra', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `topic`
--
ALTER TABLE `topic`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `topic`
--
ALTER TABLE `topic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
