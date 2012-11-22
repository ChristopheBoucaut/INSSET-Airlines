-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Ven 16 Novembre 2012 à 01:26
-- Version du serveur: 5.5.24-log
-- Version de PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `inssetair_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `aeroport`
--

CREATE TABLE IF NOT EXISTS `aeroport` (
  `id_aeroport` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nom_aeroport` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `longueur_max_piste` int(10) unsigned NOT NULL,
  `trigramme` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `id_ville` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id_aeroport`),
  KEY `id_ville_idx` (`id_ville`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Contenu de la table `aeroport`
--

INSERT INTO `aeroport` (`id_aeroport`, `nom_aeroport`, `longueur_max_piste`, `trigramme`, `id_ville`) VALUES
(1, 'Orly', 4, 'PAR', 1),
(2, 'Isset', 3, 'STQ', 2);

-- --------------------------------------------------------

--
-- Structure de la table `avion`
--

CREATE TABLE IF NOT EXISTS `avion` (
  `id_avion` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `immatriculation` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `heures_vol_totales` int(10) unsigned DEFAULT NULL,
  `heures_depuis_Gmaintenance` int(10) unsigned DEFAULT NULL,
  `id_type` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id_avion`),
  KEY `id_type_idx` (`id_type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Contenu de la table `avion`
--

INSERT INTO `avion` (`id_avion`, `immatriculation`, `heures_vol_totales`, `heures_depuis_Gmaintenance`, `id_type`) VALUES
(1, 'Avion1', 200000, 50000, 1),
(2, 'Avion2', 10000, 1000, 2);

-- --------------------------------------------------------

--
-- Structure de la table `brevet`
--

CREATE TABLE IF NOT EXISTS `brevet` (
  `id_brevet` int(10) unsigned NOT NULL,
  `id_pilote` int(10) unsigned NOT NULL,
  `date_expiration` date NOT NULL,
  PRIMARY KEY (`id_brevet`,`id_pilote`),
  KEY `id_brevet_idx` (`id_brevet`),
  KEY `id_pilote_idx` (`id_pilote`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `brevet`
--

INSERT INTO `brevet` (`id_brevet`, `id_pilote`, `date_expiration`) VALUES
(1, 1, '2014-11-06'),
(2, 2, '2013-11-06');

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE IF NOT EXISTS `client` (
  `id_client` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nom_client` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `prenom_client` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email_client` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `adresse_facturation` text COLLATE utf8_unicode_ci NOT NULL,
  `adresse_livraison` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_client`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Contenu de la table `client`
--

INSERT INTO `client` (`id_client`, `nom_client`, `prenom_client`, `email_client`, `adresse_facturation`, `adresse_livraison`) VALUES
(1, 'Bon', 'Jean', 'Jean.Bon@client.fr', '157 rue du temple 13000 Marseille', '157 rue du temple 13000 Marseille'),
(2, 'Croche', 'Sarah', 'sarah.croche@client.fr', '201 boulevard d''en bas 59000 Lille', '201 boulevard d''en bas 59000 Lille');

-- --------------------------------------------------------

--
-- Structure de la table `incident`
--

CREATE TABLE IF NOT EXISTS `incident` (
  `id_incident` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `numero_vol` int(10) unsigned NOT NULL,
  `heure_incident` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `note_incident` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_incident`),
  KEY `numero_vol_idx` (`numero_vol`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `ligne`
--

CREATE TABLE IF NOT EXISTS `ligne` (
  `id_ligne` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nom_ligne` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `aeroport_depart` int(10) unsigned NOT NULL,
  `aeroport_arrive` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id_ligne`),
  KEY `aeroport_depart_idx` (`aeroport_depart`),
  KEY `aeroport_arrivee_idx` (`aeroport_arrive`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Contenu de la table `ligne`
--

INSERT INTO `ligne` (`id_ligne`, `nom_ligne`, `aeroport_depart`, `aeroport_arrive`) VALUES
(1, 'PAR-STQ', 1, 2),
(2, 'STQ-PAR', 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `liste_brevets`
--

CREATE TABLE IF NOT EXISTS `liste_brevets` (
  `id_brevet` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_brevet`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Contenu de la table `liste_brevets`
--

INSERT INTO `liste_brevets` (`id_brevet`, `code`) VALUES
(1, 'boeing747'),
(2, 'airbus380');

-- --------------------------------------------------------

--
-- Structure de la table `liste_sections`
--

CREATE TABLE IF NOT EXISTS `liste_sections` (
  `id_section` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nom_section` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_section`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Contenu de la table `liste_sections`
--

INSERT INTO `liste_sections` (`id_section`, `nom_section`) VALUES
(5, 'Maintenance'),
(10, 'ClientLambda');

-- --------------------------------------------------------

--
-- Structure de la table `liste_vols`
--

CREATE TABLE IF NOT EXISTS `liste_vols` (
  `id_vol` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `heure_prevue_depart` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `heure_prevue_arrivee` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `id_ligne` int(10) unsigned NOT NULL,
  `periodicite` set('0','1','2','3','4','5','6','7') COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_vol`),
  KEY `id_ligne_idx` (`id_ligne`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Contenu de la table `liste_vols`
--

INSERT INTO `liste_vols` (`id_vol`, `heure_prevue_depart`, `heure_prevue_arrivee`, `id_ligne`, `periodicite`) VALUES
(1, '2012-11-06 07:00:00', '2012-11-06 08:00:00', 1, '7'),
(2, '2012-11-06 11:00:00', '2012-11-06 11:00:00', 2, '5');

-- --------------------------------------------------------

--
-- Structure de la table `maintenance`
--

CREATE TABLE IF NOT EXISTS `maintenance` (
  `id_maintenance` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `date_prevue` date NOT NULL,
  `duree_prevue` int(10) unsigned NOT NULL COMMENT 'en jour',
  `date_effective` date DEFAULT NULL,
  `duree_effective` int(10) unsigned DEFAULT NULL,
  `id_avion` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id_maintenance`),
  KEY `id_avion_idx` (`id_avion`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Contenu de la table `maintenance`
--

INSERT INTO `maintenance` (`id_maintenance`, `date_prevue`, `duree_prevue`, `date_effective`, `duree_effective`, `id_avion`) VALUES
(1, '2012-12-21', 2, NULL, NULL, 1),
(2, '2012-11-21', 10, NULL, NULL, 2);

-- --------------------------------------------------------

--
-- Structure de la table `pilote`
--

CREATE TABLE IF NOT EXISTS `pilote` (
  `id_pilote` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nom_pilote` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `prenom_pilote` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `adresse_pilote` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `temps_travail` int(10) unsigned DEFAULT NULL COMMENT 'stockée en nombre de minutes',
  PRIMARY KEY (`id_pilote`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Contenu de la table `pilote`
--

INSERT INTO `pilote` (`id_pilote`, `nom_pilote`, `prenom_pilote`, `adresse_pilote`, `temps_travail`) VALUES
(1, 'Louis', 'Nicolas', 'Pas loin d''ici', 240),
(2, 'Cutunio', 'Toto', '5 rue du temple 44000 Nantes', 90);

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE IF NOT EXISTS `reservation` (
  `id_enregistrement` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `numero_vol` int(10) unsigned NOT NULL,
  `id_client` int(10) unsigned NOT NULL,
  `nb_places_reservees` int(10) unsigned NOT NULL,
  `option_reservation` tinyint(1) NOT NULL COMMENT '0 : reserver pour 2h, 1 : reserver tout court',
  `option_reservation_heure` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'timestamp actuel',
  PRIMARY KEY (`id_enregistrement`),
  KEY `numero_vol_idx` (`numero_vol`),
  KEY `id_client_idx` (`id_client`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `reservation_remarque`
--

CREATE TABLE IF NOT EXISTS `reservation_remarque` (
  `id_enregistrement` int(10) unsigned NOT NULL,
  `id_type_remarque` int(10) unsigned NOT NULL,
  `note` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_enregistrement`,`id_type_remarque`),
  KEY `id_enregistrement_idx` (`id_enregistrement`),
  KEY `id_type_remarque_idx` (`id_type_remarque`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `section`
--

CREATE TABLE IF NOT EXISTS `section` (
  `id_utilisateur` int(10) unsigned NOT NULL,
  `id_section` int(10) unsigned NOT NULL,
  KEY `id_utilisateur_idx` (`id_utilisateur`),
  KEY `id_section_idx` (`id_section`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `section`
--

INSERT INTO `section` (`id_utilisateur`, `id_section`) VALUES
(1, 5),
(2, 5),
(3, 10);

-- --------------------------------------------------------

--
-- Structure de la table `type_avion`
--

CREATE TABLE IF NOT EXISTS `type_avion` (
  `id_type` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_brevet` int(10) unsigned NOT NULL,
  `nb_place` int(10) unsigned NOT NULL,
  `rayon_action` int(10) unsigned NOT NULL,
  `atterrissage_longueur` int(10) unsigned NOT NULL,
  `decollage_longueur` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id_type`),
  KEY `id_brevet_idx` (`id_brevet`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Contenu de la table `type_avion`
--

INSERT INTO `type_avion` (`id_type`, `id_brevet`, `nb_place`, `rayon_action`, `atterrissage_longueur`, `decollage_longueur`) VALUES
(1, 1, 140, 10000, 3, 3),
(2, 2, 180, 12000, 4, 4);

-- --------------------------------------------------------

--
-- Structure de la table `type_remarque`
--

CREATE TABLE IF NOT EXISTS `type_remarque` (
  `id_type_remarque` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nom_remarque` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ex : alergique, halal, etc',
  PRIMARY KEY (`id_type_remarque`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Contenu de la table `type_remarque`
--

INSERT INTO `type_remarque` (`id_type_remarque`, `nom_remarque`) VALUES
(1, 'vegetarien'),
(2, 'allergique citron');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id_utilisateur` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `mdp` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_utilisateur`,`login`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id_utilisateur`, `login`, `mdp`) VALUES
(1, 'JeanBon', 'JB'),
(2, 'sarahcroche', 'SC'),
(3, 'TotoCutunio', 'TC');

-- --------------------------------------------------------

--
-- Structure de la table `ville`
--

CREATE TABLE IF NOT EXISTS `ville` (
  `id_ville` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cp` int(10) unsigned DEFAULT NULL,
  `pays` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `nom_ville` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_ville`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Contenu de la table `ville`
--

INSERT INTO `ville` (`id_ville`, `cp`, `pays`, `nom_ville`) VALUES
(1, 75000, 'France', 'Paris'),
(2, 2100, 'France', 'Saint Quentin');

-- --------------------------------------------------------

--
-- Structure de la table `vol`
--

CREATE TABLE IF NOT EXISTS `vol` (
  `numero_vol` int(10) unsigned NOT NULL,
  `id_vol` int(10) unsigned NOT NULL,
  `heure_depart` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `heure_arrivee` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_vol` date NOT NULL,
  `id_avion` int(10) unsigned NOT NULL,
  `id_pilote` int(10) unsigned NOT NULL,
  `id_copilote` int(10) unsigned NOT NULL,
  PRIMARY KEY (`numero_vol`),
  KEY `id_vol_idx` (`id_vol`),
  KEY `id_avion_idx` (`id_avion`),
  KEY `id_pilote_idx` (`id_pilote`),
  KEY `id_copilote_idx` (`id_copilote`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `vol`
--

INSERT INTO `vol` (`numero_vol`, `id_vol`, `heure_depart`, `heure_arrivee`, `date_vol`, `id_avion`, `id_pilote`, `id_copilote`) VALUES
(1, 1, '2012-11-06 07:00:00', '2012-11-06 08:00:00', '2012-11-06', 1, 1, 2),
(2, 2, '2012-11-06 11:00:00', '2012-11-06 12:00:00', '2012-11-06', 2, 2, 1);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `aeroport`
--
ALTER TABLE `aeroport`
  ADD CONSTRAINT `id_ville` FOREIGN KEY (`id_ville`) REFERENCES `ville` (`id_ville`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `avion`
--
ALTER TABLE `avion`
  ADD CONSTRAINT `id_type` FOREIGN KEY (`id_type`) REFERENCES `type_avion` (`id_type`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `brevet`
--
ALTER TABLE `brevet`
  ADD CONSTRAINT `id_brevet2` FOREIGN KEY (`id_brevet`) REFERENCES `liste_brevets` (`id_brevet`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_pilote2` FOREIGN KEY (`id_pilote`) REFERENCES `pilote` (`id_pilote`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `incident`
--
ALTER TABLE `incident`
  ADD CONSTRAINT `numero_vol3` FOREIGN KEY (`numero_vol`) REFERENCES `vol` (`numero_vol`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `ligne`
--
ALTER TABLE `ligne`
  ADD CONSTRAINT `aeroport_arrive` FOREIGN KEY (`aeroport_arrive`) REFERENCES `aeroport` (`id_aeroport`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `aeroport_depart` FOREIGN KEY (`aeroport_depart`) REFERENCES `aeroport` (`id_aeroport`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `liste_vols`
--
ALTER TABLE `liste_vols`
  ADD CONSTRAINT `id_ligne` FOREIGN KEY (`id_ligne`) REFERENCES `ligne` (`id_ligne`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `maintenance`
--
ALTER TABLE `maintenance`
  ADD CONSTRAINT `id_avion2` FOREIGN KEY (`id_avion`) REFERENCES `avion` (`id_avion`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `id_client` FOREIGN KEY (`id_client`) REFERENCES `client` (`id_client`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `numero_vol2` FOREIGN KEY (`numero_vol`) REFERENCES `vol` (`numero_vol`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `reservation_remarque`
--
ALTER TABLE `reservation_remarque`
  ADD CONSTRAINT `id_enregistrement` FOREIGN KEY (`id_enregistrement`) REFERENCES `reservation` (`id_enregistrement`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_type_remarque` FOREIGN KEY (`id_type_remarque`) REFERENCES `type_remarque` (`id_type_remarque`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `section`
--
ALTER TABLE `section`
  ADD CONSTRAINT `id_section` FOREIGN KEY (`id_section`) REFERENCES `liste_sections` (`id_section`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_utilisateur` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Contraintes pour la table `type_avion`
--
ALTER TABLE `type_avion`
  ADD CONSTRAINT `id_brevet` FOREIGN KEY (`id_brevet`) REFERENCES `liste_brevets` (`id_brevet`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `vol`
--
ALTER TABLE `vol`
  ADD CONSTRAINT `id_avion` FOREIGN KEY (`id_avion`) REFERENCES `avion` (`id_avion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_copilote` FOREIGN KEY (`id_copilote`) REFERENCES `pilote` (`id_pilote`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_pilote` FOREIGN KEY (`id_pilote`) REFERENCES `pilote` (`id_pilote`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_vol` FOREIGN KEY (`id_vol`) REFERENCES `liste_vols` (`id_vol`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
