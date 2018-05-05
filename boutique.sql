-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 27 déc. 2017 à 11:25
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
-- Base de données :  `boutique`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `id_categorie` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id_categorie`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id_categorie`, `nom`, `description`) VALUES
(1, 'Ordinateur', 'tous type d\'ordinateur portable fixe et station de trvail'),
(2, 'Imprimantes', 'tous les types d\'imprimanates'),
(3, 'Onduleur', 'ONDULEUR OFF LINE et ONDULEUR LINE INTERACTIVE'),
(4, 'Réseau', 'routeur switch..');

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

DROP TABLE IF EXISTS `produit`;
CREATE TABLE IF NOT EXISTS `produit` (
  `reference` varchar(20) NOT NULL,
  `designation` varchar(100) NOT NULL,
  `quantite_stock` int(11) NOT NULL,
  `prix` float NOT NULL,
  `categorie` int(11) NOT NULL,
  `photo` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`reference`),
  KEY `categorie` (`categorie`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`reference`, `designation`, `quantite_stock`, `prix`, `categorie`, `photo`) VALUES
('P001', 'Ordinateur portable HP Pavilion X360 14-ba001nk ', 12, 8600, 1, 'P001.jpg'),
('P002', 'PC Portable convertible HP Spectre x360 13-ac002nk ', 8, 16020, 1, 'P002.jpg'),
('P003', 'Tablette PC 2-en-1 Lenovo Miix 510 Silver', 6, 16540, 1, 'P003.jpg'),
('P004', 'Ordinateur convertible HP Pavilion x2 ', 17, 105000, 1, 'P004.jpg'),
('P005', 'Imprimante jet d\'encre couleur grand format A3+ ', 7, 1850, 2, 'P005.jpg'),
('P006', 'Imprimante Jet d\'encre Couleur Canon PIXMA ', 6, 345, 2, 'P006.jpg'),
('P007', 'Imprimante A4 Couleur Jet d\'encre EPSON L310', 20, 1940, 2, 'P007.jpg'),
('P008', 'Imprimante Jet d\'encre Couleur Canon PIXMA E414 ', 23, 580, 2, 'P008.jpg'),
('P009', 'Onduleur OFF-Line Eaton Ellipse ECO 800 USB FR ', 12, 1040, 3, 'P009.jpg'),
('P010', 'Onduleur OFF-Line Eaton Ellipse ECO 1200 FR USB ', 30, 1600, 3, 'P010.jpg'),
('P011', 'Onduleur OFF-Line APC Power-Saving Back-UPS ES ', 13, 960, 3, 'P011.jpg'),
('P012', 'Onduleur Off-Line Eaton Protection Station 800 VA ', 14, 1340, 3, 'P012.jpg'),
('P013', 'Routeur D-Link sans fil 300Mbps (DIR-514/BEU)', 13, 290, 4, 'P013.jpg'),
('P014', 'Routeur Modem D-Link Dual Band Wireless Gigabit ', 17, 2160, 4, 'P014.jpg'),
('P015', 'Modem Routeur Linksys X6200 ADSL/VDSL Wi-Fi ', 14, 1190, 4, 'P015.jpg'),
('P016', 'Routeur Modem Wi-Fi D-Link ADSL2/2+802.11n ', 20, 1000, 4, 'P016.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `login` varchar(20) NOT NULL,
  `pass` varchar(20) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`login`, `pass`, `nom`, `prenom`) VALUES
('oumaira', 'azerty', 'Oumaira', 'Ilham'),
('ziad', '123456', 'ziad', 'lina');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `produit_ibfk_1` FOREIGN KEY (`categorie`) REFERENCES `categorie` (`id_categorie`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
