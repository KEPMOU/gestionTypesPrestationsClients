-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 01 nov. 2022 à 17:04
-- Version du serveur : 10.4.24-MariaDB
-- Version de PHP : 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `bdd_gestiontypeprestations`
--

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `CODECLIENT` varchar(25) NOT NULL,
  `NOMCLIENT` varchar(50) DEFAULT NULL,
  `ADRESSECLIENT` varchar(50) DEFAULT NULL,
  `TELCLIENT` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`CODECLIENT`, `NOMCLIENT`, `ADRESSECLIENT`, `TELCLIENT`) VALUES
('CLT427', 'DOLORESSE', 'YAOUNDE MENDONG', '655 85 15 21'),
('CLT578', 'KAMDEM CARLOS ARTHUR', 'DOUALA AKWA', '699 14 52 68');

-- --------------------------------------------------------

--
-- Structure de la table `etatprestation`
--

CREATE TABLE `etatprestation` (
  `IDETATPRESTATION` int(11) NOT NULL,
  `LIBELLEETATPRESTATION` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `etatprestation`
--

INSERT INTO `etatprestation` (`IDETATPRESTATION`, `LIBELLEETATPRESTATION`) VALUES
(1, 'ENREGISTREE'),
(2, 'NON REGLEE'),
(3, 'REGLEE');

-- --------------------------------------------------------

--
-- Structure de la table `prestation`
--

CREATE TABLE `prestation` (
  `CODEPRESTATION` varchar(25) NOT NULL,
  `CODECLIENT` varchar(25) NOT NULL,
  `CODETYPEPRESTATION` varchar(25) NOT NULL,
  `IDETATPRESTATION` int(11) NOT NULL,
  `LIBELLEPRESTATION` varchar(50) DEFAULT NULL,
  `DATEENREGPRESTATION` date DEFAULT NULL,
  `HEUREENREGPRESTATION` time DEFAULT NULL,
  `MONTANTCOUTPRESTATION` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `prestation`
--

INSERT INTO `prestation` (`CODEPRESTATION`, `CODECLIENT`, `CODETYPEPRESTATION`, `IDETATPRESTATION`, `LIBELLEPRESTATION`, `DATEENREGPRESTATION`, `HEUREENREGPRESTATION`, `MONTANTCOUTPRESTATION`) VALUES
('P01112022645', 'CLT578', 'TP72', 2, NULL, '2022-11-11', '17:45:00', 45000),
('P31102022467', 'CLT578', 'TP72', 3, 'PROGRAMME DES OBSEQUES 100', '2022-10-31', '00:05:00', 45000),
('P31102022569', 'CLT427', 'TP82', 3, 'CONFECTIONS CARTE DE VISITE', '2022-03-11', '06:51:00', 150000);

-- --------------------------------------------------------

--
-- Structure de la table `reglementprestation`
--

CREATE TABLE `reglementprestation` (
  `REFERENCEREGLEMENTPRESTATION` varchar(25) NOT NULL,
  `CODEPRESTATION` varchar(25) NOT NULL,
  `DATEREGLEMENTPRESTATION` date DEFAULT NULL,
  `HEUREENREGREGLEMENTPRESTATION` time DEFAULT NULL,
  `MONTANTREGLEMENTPRESTATION` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `reglementprestation`
--

INSERT INTO `reglementprestation` (`REFERENCEREGLEMENTPRESTATION`, `CODEPRESTATION`, `DATEREGLEMENTPRESTATION`, `HEUREENREGREGLEMENTPRESTATION`, `MONTANTREGLEMENTPRESTATION`) VALUES
('REG011120229205', 'P31102022467', '2022-11-10', '17:04:00', 45000),
('REG311020225228', 'P31102022569', '2022-10-31', '09:32:00', 15000),
('REG311020226437', 'P31102022569', '2022-10-31', '10:24:00', 15000);

-- --------------------------------------------------------

--
-- Structure de la table `typeprestation`
--

CREATE TABLE `typeprestation` (
  `CODETYPEPRESTATION` varchar(25) NOT NULL,
  `LIBELLETYPEPRESTATION` varchar(50) DEFAULT NULL,
  `COUTTYPEPRESTATION` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `typeprestation`
--

INSERT INTO `typeprestation` (`CODETYPEPRESTATION`, `LIBELLETYPEPRESTATION`, `COUTTYPEPRESTATION`) VALUES
('TP72', 'PROGRAMME DES OBSEQUES 100', 25000),
('TP82', 'CARTE DE VISITE PACKAGE 100', 10000);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `ID` int(4) NOT NULL,
  `LOGIN` varchar(100) NOT NULL,
  `PWD` varchar(255) NOT NULL,
  `ROLE` varchar(50) DEFAULT NULL,
  `EMAIL` varchar(255) DEFAULT NULL,
  `ETAT` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`ID`, `LOGIN`, `PWD`, `ROLE`, `EMAIL`, `ETAT`) VALUES
(1, 'Administrateur', 'a67df150bda3d47dfa2ee83d00e0a068', 'Administrateur', 'Administrateur@gmail.com', 1),
(2, 'Secretaire', 'f46787def5aeec965f9308ac0689f09f', 'Secretaire', 'Secretaire@gmail.com', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`CODECLIENT`);

--
-- Index pour la table `etatprestation`
--
ALTER TABLE `etatprestation`
  ADD PRIMARY KEY (`IDETATPRESTATION`);

--
-- Index pour la table `prestation`
--
ALTER TABLE `prestation`
  ADD PRIMARY KEY (`CODEPRESTATION`),
  ADD KEY `FK_ASSOCIER` (`CODECLIENT`),
  ADD KEY `FK_AVOIR` (`IDETATPRESTATION`),
  ADD KEY `FK_CLASSER` (`CODETYPEPRESTATION`);

--
-- Index pour la table `reglementprestation`
--
ALTER TABLE `reglementprestation`
  ADD PRIMARY KEY (`REFERENCEREGLEMENTPRESTATION`),
  ADD KEY `FK_RELIER` (`CODEPRESTATION`);

--
-- Index pour la table `typeprestation`
--
ALTER TABLE `typeprestation`
  ADD PRIMARY KEY (`CODETYPEPRESTATION`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `etatprestation`
--
ALTER TABLE `etatprestation`
  MODIFY `IDETATPRESTATION` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `ID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `prestation`
--
ALTER TABLE `prestation`
  ADD CONSTRAINT `FK_ASSOCIER` FOREIGN KEY (`CODECLIENT`) REFERENCES `client` (`CODECLIENT`),
  ADD CONSTRAINT `FK_AVOIR` FOREIGN KEY (`IDETATPRESTATION`) REFERENCES `etatprestation` (`IDETATPRESTATION`),
  ADD CONSTRAINT `FK_CLASSER` FOREIGN KEY (`CODETYPEPRESTATION`) REFERENCES `typeprestation` (`CODETYPEPRESTATION`);

--
-- Contraintes pour la table `reglementprestation`
--
ALTER TABLE `reglementprestation`
  ADD CONSTRAINT `FK_RELIER` FOREIGN KEY (`CODEPRESTATION`) REFERENCES `prestation` (`CODEPRESTATION`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
