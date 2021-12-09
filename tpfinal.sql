-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 09 déc. 2021 à 20:18
-- Version du serveur :  10.4.18-MariaDB
-- Version de PHP : 8.0.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `tpfinal`
--

-- --------------------------------------------------------

--
-- Structure de la table `billet`
--

CREATE TABLE `billet` (
  `id_billet` int(50) NOT NULL,
  `date_billet` date NOT NULL,
  `contenu_billet` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `billet`
--

INSERT INTO `billet` (`id_billet`, `date_billet`, `contenu_billet`) VALUES
(3, '2021-11-22', 'lorem\r\nlorem'),
(4, '2021-11-22', 'LOREM LOREM'),
(7, '2021-11-22', 'coucou'),
(8, '2021-11-22', 'le dernier'),
(9, '2021-12-03', 'Coucou, nouveau billet UwU'),
(10, '2021-12-08', 'Bonjour toi !'),
(11, '2021-12-08', 'mon billet du jour');

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE `commentaire` (
  `id_com` int(50) NOT NULL,
  `date_com` date NOT NULL,
  `contenu_com` text NOT NULL,
  `ext_billet` int(11) NOT NULL,
  `ext_utilisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `commentaire`
--

INSERT INTO `commentaire` (`id_com`, `date_com`, `contenu_com`, `ext_billet`, `ext_utilisateur`) VALUES
(3, '2021-11-22', 'coucou c le commentaire', 8, 2),
(4, '2021-11-22', 'coucou c le commentaire N2', 8, 1),
(5, '2021-11-22', '', 0, 0),
(6, '2021-12-03', 'EEGEZGZ', 8, 0),
(7, '2021-12-03', 'EEGEZGZ', 8, 0),
(8, '2021-12-03', 'EEGEZGZ', 8, 0),
(9, '2021-12-03', 'EEGEZGZ', 8, 0),
(10, '2021-12-03', 'EEGEZGZ', 8, 0),
(11, '2021-12-03', 'EEGEZGZ', 8, 0),
(12, '2021-12-03', 'EEGEZGZ', 8, 0),
(13, '2021-12-03', 'EEGEZGZ', 8, 0),
(14, '2021-12-03', 'EEGEZGZ', 8, 0),
(15, '2021-12-03', 'EEGEZGZ', 8, 0),
(16, '2021-12-03', 'EEGEZGZ', 8, 0),
(17, '2021-12-03', 'ttezgz\'', 8, 10),
(18, '2021-12-03', 'petit test', 8, 10),
(19, '2021-12-03', 'coucou', 8, 1),
(20, '2021-12-03', 'hihih', 8, 1),
(21, '2021-12-03', 'egzgez', 8, 11),
(22, '2021-12-03', 'rrr', 8, 11),
(23, '2021-12-03', 'uuu', 8, 11),
(24, '2021-12-03', 'ttt', 8, 11),
(25, '2021-12-03', 'eeezz', 8, 11),
(26, '2021-12-03', '', 8, 11),
(27, '2021-12-03', '', 8, 11),
(28, '2021-12-03', '', 8, 11),
(29, '2021-12-03', '', 8, 11),
(30, '2021-12-03', 'coucou mec ^^\r\n', 8, 1),
(31, '2021-12-03', 'coucou c estelle', 8, 12),
(32, '2021-12-03', 'Lucien est bg', 8, 12),
(33, '2021-12-03', 'lucien trop \r\nnul', 8, 12),
(34, '2021-12-08', 'coucou\r\n', 10, 1),
(35, '2021-12-08', 'coucou\r\n', 10, 1),
(36, '2021-12-08', 'coucou', 8, 1),
(37, '2021-12-08', 'test cc\r\n', 10, 1),
(38, '2021-12-08', 'test coucou', 10, 1),
(39, '2021-12-08', 'test1', 10, 1);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(50) NOT NULL,
  `pseudo` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mdp` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `pseudo`, `email`, `mdp`) VALUES
(1, 'admin', 'admin@admin.admin', '$2y$10$E9sPO1BUpzmGVk.mk0mviuNNHGPP3pxGN9JRYx6nFxeIaVn8IuCD.'),
(2, 'toto', 'toto@toto.com', '$2y$10$LDCkRNGuIt3kUq2ca.FUkuwtJDnrAUmxb9M9/rxP5nM4UrM7JPUbW'),
(9, 'oo', 'o@o.o', '$2y$10$pp1J4QJqT0geNV692X19ze95nMfttdA21Wce14Nk.S/in6Xz5LL02'),
(10, 'p', 'pp@pp.pp', '$2y$10$46nRvk.1kKsMiMOFmLtilukYPr1JQgOgU60IxEmP3YcSCC61HKmiK'),
(11, 'r', 'rrr@r.r', '$2y$10$HmU17fWEyg/76hEYsR9Pl.5xJ501XcRsP3j/1V2SR01RmHYEHpu5q'),
(12, 'e', 'estelle@e.e', '$2y$10$h9IdCd3ZSBueKp3vJEv66.NlPsTPArYyvpfNlrFZJqabjpy4coTaW'),
(13, 't', 't@t.t', '$2y$10$eR4By4e5GM7oLDoYfHmsUegAss6b1xlEP0ozZ38zc2hjH.t.m2yFa'),
(14, 'titi', 'titi@t.t', '$2y$10$fEgOCRPmwAbRG09h4smju.G8rVBsmYjJalQdhKP7eJjTo6hCC5Xry');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `billet`
--
ALTER TABLE `billet`
  ADD PRIMARY KEY (`id_billet`);

--
-- Index pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD PRIMARY KEY (`id_com`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pseudo` (`pseudo`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `billet`
--
ALTER TABLE `billet`
  MODIFY `id_billet` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `commentaire`
--
ALTER TABLE `commentaire`
  MODIFY `id_com` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
