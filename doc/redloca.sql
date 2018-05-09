-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 09 mai 2018 à 14:38
-- Version du serveur :  5.7.21
-- Version de PHP :  7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `redloca`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `idcategorie` int(11) NOT NULL AUTO_INCREMENT,
  `nomCategorie` varchar(45) NOT NULL,
  `prixCategorie` varchar(45) NOT NULL,
  `type_categories_idTypeCategorie` int(11) NOT NULL,
  PRIMARY KEY (`idcategorie`),
  KEY `fk_categories_type_categories1_idx1` (`type_categories_idTypeCategorie`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`idcategorie`, `nomCategorie`, `prixCategorie`, `type_categories_idTypeCategorie`) VALUES
(1, 'sport', '150', 1),
(2, 'monospace', '130', 1),
(3, 'suv', '110', 1),
(4, 'break', '90', 1),
(5, 'cabriolet', '80', 1),
(6, 'berline', '70', 1),
(7, 'scooter', '50', 2),
(8, 'sportive', '350', 2),
(9, 'enduro', '160', 2),
(10, 'side-car', '420', 2),
(11, 'trike', '350', 2),
(12, 'custom', '350', 2),
(13, 'touring', '320', 2),
(14, 'roadster', '330', 2);

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

DROP TABLE IF EXISTS `reservation`;
CREATE TABLE IF NOT EXISTS `reservation` (
  `dateDebut` date NOT NULL,
  `dateFin` date NOT NULL,
  `Vehicules_idVehicule` int(11) NOT NULL,
  `utilisateurs_idutilisateur` int(11) NOT NULL,
  PRIMARY KEY (`utilisateurs_idutilisateur`,`Vehicules_idVehicule`),
  KEY `fk_reservation_utilisateurs1_idx` (`utilisateurs_idutilisateur`),
  KEY `fk_reservation_vehicules_idx` (`Vehicules_idVehicule`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `reservation`
--

INSERT INTO `reservation` (`dateDebut`, `dateFin`, `Vehicules_idVehicule`, `utilisateurs_idutilisateur`) VALUES
('2018-05-05', '2018-05-08', 1, 1),
('2018-05-08', '2018-07-10', 5, 2),
('2018-05-08', '2018-06-07', 2, 3);

-- --------------------------------------------------------

--
-- Structure de la table `type_categories`
--

DROP TABLE IF EXISTS `type_categories`;
CREATE TABLE IF NOT EXISTS `type_categories` (
  `idTypeCategorie` int(11) NOT NULL AUTO_INCREMENT,
  `nomTypeCategorie` varchar(45) NOT NULL,
  PRIMARY KEY (`idTypeCategorie`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `type_categories`
--

INSERT INTO `type_categories` (`idTypeCategorie`, `nomTypeCategorie`) VALUES
(1, 'voiture'),
(2, 'moto');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `idutilisateur` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(45) NOT NULL,
  `prenom` varchar(45) NOT NULL,
  `dateNaissance` date NOT NULL,
  `natel` varchar(12) NOT NULL,
  `Email` varchar(45) NOT NULL,
  `Mdp` varchar(100) NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idutilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`idutilisateur`, `nom`, `prenom`, `dateNaissance`, `natel`, `Email`, `Mdp`, `type`) VALUES
(1, 'ryser', 'tom', '1998-03-03', '0798380065', 'tom.rsr@eduge.ch', '52d166edfc5ee6a6413333ea67be0eb40d467a72', 1),
(2, 'nikxla', 'nikola', '1998-04-30', '0893111565', 'nikola.antnj@eduge.ch', '52d166edfc5ee6a6413333ea67be0eb40d467a72', 0),
(3, 'djokovic', 'damjan', '1998-04-22', '04813461570', 'damjan.jvnvc@eduge.ch', '52d166edfc5ee6a6413333ea67be0eb40d467a72', 0),
(4, 'ryry', 'tomtom', '1998-03-03', '+41798380069', 'tom.rsr@eduge.ch', '52d166edfc5ee6a6413333ea67be0eb40d467a72', 0);

-- --------------------------------------------------------

--
-- Structure de la table `vehicules`
--

DROP TABLE IF EXISTS `vehicules`;
CREATE TABLE IF NOT EXISTS `vehicules` (
  `idVehicule` int(11) NOT NULL AUTO_INCREMENT,
  `immatriculation` varchar(10) NOT NULL,
  `marque` varchar(45) NOT NULL,
  `modele` varchar(45) NOT NULL,
  `nbPlace` int(11) NOT NULL,
  `couleur` varchar(45) NOT NULL,
  `image` varchar(45) NOT NULL,
  `dateDebutDisponibilite` varchar(45) NOT NULL,
  `dateFinDisponibilite` varchar(45) DEFAULT NULL,
  `utilisateurs_idutilisateur` int(11) NOT NULL,
  `categories_idcategorie` int(11) NOT NULL,
  PRIMARY KEY (`idVehicule`),
  UNIQUE KEY `idVehicule_UNIQUE` (`idVehicule`),
  KEY `fk_vehicules_utilisateurs1_idx` (`utilisateurs_idutilisateur`),
  KEY `fk_vehicules_categories1_idx` (`categories_idcategorie`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `vehicules`
--

INSERT INTO `vehicules` (`idVehicule`, `immatriculation`, `marque`, `modele`, `nbPlace`, `couleur`, `image`, `dateDebutDisponibilite`, `dateFinDisponibilite`, `utilisateurs_idutilisateur`, `categories_idcategorie`) VALUES
(1, 'GE 999 999', 'audi', 'R8', 2, 'rouge', 'image', '2018-04-10', NULL, 1, 1),
(2, 'GE 123 123', 'Yamaha', 'Fz6n', 2, 'noir', 'image', '2018-04-10', '2018-04-30', 1, 14),
(3, 'GE 123 321', 'Yamaha', 'Fz6n', 2, 'noir', 'image', '2018-04-01', '2018-05-05', 1, 14),
(4, 'GE 321 321', 'Yamaha', 'Fz6n', 2, 'noir', 'image', '2018-03-01', '2018-05-10', 1, 14),
(5, 'GE 999 999', 'audi', 'R8', 2, 'rouge', 'image', '2018-05-08', NULL, 1, 1),
(6, 'GE 456 789', 'Audi', 'R8', 2, 'Orange', 'image', '2018-08-08', NULL, 2, 1);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `fk_categories_type_categories1` FOREIGN KEY (`type_categories_idTypeCategorie`) REFERENCES `type_categories` (`idTypeCategorie`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `fk_reservation_utilisateur` FOREIGN KEY (`utilisateurs_idutilisateur`) REFERENCES `utilisateurs` (`idutilisateur`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_reservation_vehicules` FOREIGN KEY (`Vehicules_idVehicule`) REFERENCES `vehicules` (`idVehicule`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `vehicules`
--
ALTER TABLE `vehicules`
  ADD CONSTRAINT `fk_vehicules_categories1` FOREIGN KEY (`categories_idcategorie`) REFERENCES `categories` (`idcategorie`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_vehicules_utilisateurs1` FOREIGN KEY (`utilisateurs_idutilisateur`) REFERENCES `utilisateurs` (`idutilisateur`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
