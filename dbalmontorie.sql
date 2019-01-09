-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 09 jan. 2019 à 19:39
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
-- Base de données :  `dbalmontorie`
--

-- --------------------------------------------------------

--
-- Structure de la table `listetache`
--

DROP TABLE IF EXISTS `listetache`;
CREATE TABLE IF NOT EXISTS `listetache` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `pseudo` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pseudo` (`pseudo`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `listetache`
--

INSERT INTO `listetache` (`id`, `nom`, `pseudo`) VALUES
(28, 'ffez', 'Alexis Bouvard'),
(25, 'lundi', 'Alexis Bouvard');

-- --------------------------------------------------------

--
-- Structure de la table `listetachepublic`
--

DROP TABLE IF EXISTS `listetachepublic`;
CREATE TABLE IF NOT EXISTS `listetachepublic` (
  `nom` varchar(100) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=64 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `listetachepublic`
--

INSERT INTO `listetachepublic` (`nom`, `id`) VALUES
('mardi', 61),
('ffez', 56);

-- --------------------------------------------------------

--
-- Structure de la table `tache`
--

DROP TABLE IF EXISTS `tache`;
CREATE TABLE IF NOT EXISTS `tache` (
  `nom` varchar(200) NOT NULL,
  `idListeTache` int(11) NOT NULL,
  PRIMARY KEY (`nom`,`idListeTache`),
  KEY `idListeTache` (`idListeTache`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `tache`
--

INSERT INTO `tache` (`nom`, `idListeTache`) VALUES
('ca', 28);

-- --------------------------------------------------------

--
-- Structure de la table `tachepublic`
--

DROP TABLE IF EXISTS `tachepublic`;
CREATE TABLE IF NOT EXISTS `tachepublic` (
  `nom` varchar(200) NOT NULL,
  `idListeTache` int(11) NOT NULL,
  PRIMARY KEY (`nom`,`idListeTache`),
  KEY `idListeTachePublic` (`idListeTache`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `tachepublic`
--

INSERT INTO `tachepublic` (`nom`, `idListeTache`) VALUES
('ca', 56),
('ca', 61),
('ffez', 61),
('snv', 61);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `pseudo` varchar(50) NOT NULL,
  `mdp` varchar(100) NOT NULL,
  PRIMARY KEY (`pseudo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`pseudo`, `mdp`) VALUES
('Alexis Bouvard', '$2y$10$Nibnnmf6SxxSifSwaK8yWeo/P8oPiFNHtY2a2P09Lg/zG5.m1H/vS'),
('lutorret', '$2y$10$UTyYN/bG6wDvGnLQ66FkjuIPhdzE8Tgw0p60JnvLAqT3BY.nbzXYK');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
