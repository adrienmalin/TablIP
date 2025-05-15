-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : lun. 27 sep. 2021 à 04:11
-- Version du serveur : 10.3.29-MariaDB-0+deb10u1
-- Version de PHP : 7.3.30-1+0~20210826.87+debian10~1.gbpe56a7b

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `TablIP`
--

-- --------------------------------------------------------

--
-- Structure de la table `Hosts`
--

CREATE TABLE `Hosts` (
  `IPAddress` bit(32) NOT NULL,
  `NetworkId` int(11) NOT NULL,
  `Hostname` varchar(255) NOT NULL DEFAULT '',
  `FQDN` varchar(255) NOT NULL DEFAULT '',
  `MacAddress` varchar(17) NOT NULL DEFAULT '',
  `Link` varchar(255) NOT NULL DEFAULT '',
  `Comments` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `Networks`
--

CREATE TABLE `Networks` (
  `id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Address` bit(32) NOT NULL,
  `Mask` bit(32) NOT NULL,
  `SiteId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `Sites`
--

CREATE TABLE `Sites` (
  `id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `Users`
--

CREATE TABLE `Users` (
  `id` int(11) NOT NULL,
  `login` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `UserSites`
--

CREATE TABLE `UserSites` (
  `id` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `SiteId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Hosts`
--
ALTER TABLE `Hosts`
  ADD PRIMARY KEY (`IPAddress`),
  ADD UNIQUE KEY `IPAddress` (`IPAddress`);

--
-- Index pour la table `Networks`
--
ALTER TABLE `Networks`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Sites`
--
ALTER TABLE `Sites`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Name` (`Name`),
  ADD UNIQUE KEY `Name_2` (`Name`);

--
-- Index pour la table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `UserSites`
--
ALTER TABLE `UserSites`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Networks`
--
ALTER TABLE `Networks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Sites`
--
ALTER TABLE `Sites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Users`
--
ALTER TABLE `Users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `UserSites`
--
ALTER TABLE `UserSites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
