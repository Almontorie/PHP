-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Mer 16 Janvier 2019 à 16:12
-- Version du serveur :  10.1.37-MariaDB-0+deb9u1
-- Version de PHP :  7.0.33-0+deb9u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `dbalmontorie`
--

-- --------------------------------------------------------

--
-- Structure de la table `listetache`
--

CREATE TABLE `listetache` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `pseudo` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `listetache`
--

INSERT INTO `listetache` (`id`, `nom`, `pseudo`) VALUES
(28, 'ffez', 'Alexis Bouvard'),
(25, 'lundi', 'Alexis Bouvard'),
(32, 'test', 'lutorret'),
(35, 'lundi', 'almontorie');

-- --------------------------------------------------------

--
-- Structure de la table `listetachepublic`
--

CREATE TABLE `listetachepublic` (
  `nom` varchar(100) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `tache`
--

CREATE TABLE `tache` (
  `nom` varchar(200) NOT NULL,
  `idListeTache` int(11) NOT NULL,
  `complete` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `tache`
--

INSERT INTO `tache` (`nom`, `idListeTache`, `complete`) VALUES
('test3', 32, 0),
('test2', 32, 0),
('ca', 32, 1),
('test', 35, 1),
('test2', 35, 1);

-- --------------------------------------------------------

--
-- Structure de la table `tachepublic`
--

CREATE TABLE `tachepublic` (
  `nom` varchar(200) NOT NULL,
  `idListeTache` int(11) NOT NULL,
  `complete` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `pseudo` varchar(50) NOT NULL,
  `mdp` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`pseudo`, `mdp`) VALUES
('Alexis Bouvard', '$2y$10$Nibnnmf6SxxSifSwaK8yWeo/P8oPiFNHtY2a2P09Lg/zG5.m1H/vS'),
('lutorret', '$2y$10$UTyYN/bG6wDvGnLQ66FkjuIPhdzE8Tgw0p60JnvLAqT3BY.nbzXYK'),
('almontorie', '$2y$10$TyVn1VLQ19WDiNuCCQjqxuxomkv0S.fksgBQvsWuwIg0hZHpkBZGm');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `listetache`
--
ALTER TABLE `listetache`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pseudo` (`pseudo`);

--
-- Index pour la table `listetachepublic`
--
ALTER TABLE `listetachepublic`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tache`
--
ALTER TABLE `tache`
  ADD PRIMARY KEY (`nom`,`idListeTache`),
  ADD KEY `idListeTache` (`idListeTache`);

--
-- Index pour la table `tachepublic`
--
ALTER TABLE `tachepublic`
  ADD PRIMARY KEY (`nom`,`idListeTache`),
  ADD KEY `idListeTachePublic` (`idListeTache`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`pseudo`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `listetache`
--
ALTER TABLE `listetache`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT pour la table `listetachepublic`
--
ALTER TABLE `listetachepublic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
