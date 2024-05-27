-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : db.3wa.io
-- Généré le : dim. 26 mai 2024 à 20:45
-- Version du serveur :  5.7.33-0ubuntu0.18.04.1-log
-- Version de PHP : 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `eddyfrair_immo35`
--

-- --------------------------------------------------------

--
-- Structure de la table `energy_diagnostics`
--

CREATE TABLE `energy_diagnostics` (
  `id` int(11) NOT NULL,
  `note_energy_diagnostics` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `energy_diagnostics`
--

INSERT INTO `energy_diagnostics` (`id`, `note_energy_diagnostics`) VALUES
(1, 'A'),
(2, 'B'),
(3, 'C'),
(4, 'D'),
(5, 'E'),
(6, 'F'),
(7, 'G');

-- --------------------------------------------------------

--
-- Structure de la table `greenhouse_gas_emission_indices`
--

CREATE TABLE `greenhouse_gas_emission_indices` (
  `id` int(11) NOT NULL,
  `note_greenhouse_gas_emission_indices` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `greenhouse_gas_emission_indices`
--

INSERT INTO `greenhouse_gas_emission_indices` (`id`, `note_greenhouse_gas_emission_indices`) VALUES
(1, 'A'),
(2, 'B'),
(3, 'C'),
(4, 'D'),
(5, 'E'),
(6, 'F'),
(7, 'G');

-- --------------------------------------------------------

--
-- Structure de la table `location`
--

CREATE TABLE `location` (
  `id` int(11) NOT NULL,
  `city` varchar(255) NOT NULL,
  `district` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `location`
--

INSERT INTO `location` (`id`, `city`, `district`) VALUES
(1, 'Acigné', 35690),
(2, 'Amanlis', 35150),
(3, 'Andouillé-Neuville', 35250),
(4, 'Aubigné', 35250),
(5, 'Baulon', 35580),
(6, 'la Baussaine', 35190),
(7, 'Bécherel', 35190),
(8, 'Bédée', 35137),
(9, 'Betton', 35830),
(10, 'Boistrudan', 35150),
(11, 'la Bouëxière', 35340),
(12, 'Bourgbarré', 35230),
(13, 'Bourg-des-Comptes', 35890),
(14, 'Bovel', 35330),
(15, 'Bréal-sous-Montfort', 35310),
(16, 'Brécé', 35530),
(17, 'Breteil', 35160),
(18, 'Brie', 35150),
(19, 'Bruz', 35170),
(20, 'Cardroc', 35190),
(21, 'Cesson-Sévigné', 35510),
(22, 'Chanteloup', 35150),
(23, 'Chantepie', 35135),
(24, 'la Chapelle-Bouëxic', 35330),
(25, 'la Chapelle-Chaussée', 35630),
(26, 'la Chapelle-des-Fougeretz', 35520),
(27, 'la Chapelle-du-Lou-du-Lac', 35360),
(28, 'la Chapelle-Thouarault', 35590),
(29, 'Chartres-de-Bretagne', 35131),
(30, 'Chasné-sur-Illet', 35250),
(31, 'Châteaubourg', 35220),
(32, 'Châteaugiron', 35410),
(33, 'Chauvigné', 35490),
(34, 'Chavagne', 35310),
(35, 'Chevaigné', 35250),
(36, 'Cintré', 35310),
(37, 'Clayes', 35590),
(38, 'Corps-Nuds', 35150),
(39, 'la Couyère', 35320),
(40, 'Crevin', 35320),
(41, 'Dingé', 35440),
(42, 'Domagné', 35113),
(43, 'Domloup', 35410),
(44, 'Dourdain', 35450),
(45, 'Ercé-près-Liffré', 35340),
(46, 'Essé', 35150),
(47, 'Feins', 35440),
(48, 'Gahard', 35490),
(49, 'Gévezé', 35850),
(50, 'Gosné', 35140),
(51, 'Goven', 35580),
(52, 'Guichen', 35580),
(53, 'Guignen', 35580),
(54, 'Guipel', 35440),
(55, 'Hédé-Bazouges', 35630),
(56, 'l\'Hermitage', 35590),
(57, 'Iffendic', 35750),
(58, 'les Iffs', 35630),
(59, 'Irodouer', 35850),
(60, 'Janzé', 35150),
(61, 'Laillé', 35890),
(62, 'Landujan', 35360),
(63, 'Langan', 35850),
(64, 'Langouët', 35630),
(65, 'Lassy', 35580),
(66, 'Liffré', 35340),
(67, 'Livré-sur-Changeon', 35450),
(68, 'Lohéac', 35550),
(69, 'Longaulnay', 35190),
(70, 'Marcillé-Raoul', 35560),
(71, 'Val d\'Anast', 35330),
(72, 'Maxent', 35380),
(73, 'Melesse', 35520),
(74, 'Mernel', 35330),
(75, 'Guipry-Messac', 35480),
(76, 'la Mézière', 35520),
(77, 'Mezières-sur-Couesnon', 35140),
(78, 'Miniac-sous-Bécherel', 35190),
(79, 'Montauban-de-Bretagne', 35360),
(80, 'Monterfil', 35160),
(81, 'Montfort-sur-Meu', 35160),
(82, 'Montgermont', 35760),
(83, 'Montreuil-le-Gast', 35520),
(84, 'Montreuil-sur-Ille', 35440),
(85, 'Mordelles', 35310),
(86, 'Mouazé', 35250),
(87, 'la Nouaye', 35137),
(88, 'Nouvoitou', 35410),
(89, 'Noyal-Châtillon-sur-Seiche', 35230),
(90, 'Noyal-sur-Vilaine', 35530),
(91, 'Orgères', 35230),
(92, 'Pacé', 35740),
(93, 'Pancé', 35320),
(94, 'Parthenay-de-Bretagne', 35850),
(95, 'le Petit-Fougeray', 35320),
(96, 'Piré-Chancé', 35150),
(97, 'Pléchatel', 35470),
(98, 'Pleumeleuc', 35137),
(99, 'Poligné', 35320),
(100, 'Québriac', 35190),
(101, 'Rennes', 35000),
(102, 'Rennes', 35200),
(103, 'Rennes', 35700),
(104, 'le Rheu', 35650),
(105, 'Rimou', 35560),
(106, 'Romazy', 35490),
(107, 'Romillé', 35850),
(108, 'Saint-Armel', 35230),
(109, 'Saint-Aubin-d\'Aubigné', 35250),
(110, 'Saint-Aubin-du-Cormier', 35140),
(111, 'Saint-Brieuc-des-Iffs', 35630),
(112, 'Saint-Christophe-de-Valains', 35140),
(113, 'Sainte-Colombe', 35134),
(114, 'Saint-Domineuc', 35190),
(115, 'Saint-Erblon', 35230),
(116, 'Saint-Germain-sur-Ille', 35250),
(117, 'Saint-Gilles', 35590),
(118, 'Saint-Gondran', 35630),
(119, 'Saint-Grégoire', 35760),
(120, 'Saint-Jacques-de-la-Lande', 35136),
(121, 'Saint-Malo-de-Phily', 35480),
(122, 'Saint-Marc-le-Blanc', 35460),
(123, 'Saint-Médard-sur-Ille', 35250),
(124, 'Saint-Ouen-des-Alleux', 35140),
(125, 'Saint-Pern', 35190),
(126, 'Saint-Rémy-du-Plain', 35560),
(127, 'Saint-Senoux', 35580),
(128, 'Saint-Sulpice-la-Forêt', 35250),
(129, 'Saint-Symphorien', 35630),
(130, 'Saint-Thual', 35190),
(131, 'Saint-Thurial', 35310),
(132, 'Saulnieres', 35320),
(133, 'le Sel-de-Bretagne', 35320),
(134, 'Sens-de-Bretagne', 35490),
(135, 'Servon-sur-Vilaine', 35530),
(136, 'Talensac', 35160),
(137, 'le Theil-de-Bretagne', 35240),
(138, 'Thorigné-Fouillard', 35235),
(139, 'Tinténiac', 35190),
(140, 'Treffendel', 35380),
(141, 'Tresboeuf', 35320),
(142, 'Tréverien', 35190),
(143, 'Trimer', 35190),
(144, 'le Verger', 35160),
(145, 'Vern-sur-Seiche', 35770),
(146, 'Vezin-le-Coquet', 35132),
(147, 'Vieux-Vy-sur-Couesnon', 35490),
(148, 'Vignoc', 35630),
(149, 'Pont-Péan', 35131);

-- --------------------------------------------------------

--
-- Structure de la table `medias`
--

CREATE TABLE `medias` (
  `id` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `property_id` int(11) NOT NULL,
  `type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `medias`
--

INSERT INTO `medias` (`id`, `url`, `property_id`, `type`) VALUES
(23, 'img1-property-5.png', 5, 'vignette'),
(24, 'img2-property-5.png', 5, NULL),
(125, 'SFeemSHE.jpg', 74, 'vignette'),
(126, '0CmLTAxv.jpg', 74, NULL),
(127, 'H2dcNEFj.jpg', 74, NULL),
(128, '4drFbkMv.jpg', 64, 'vignette'),
(129, 'LnaxkNqZ.jpg', 64, NULL),
(130, 'jjdxazmZ.jpg', 64, NULL),
(131, 'rmQrbDmJ.jpg', 64, NULL),
(137, 'sjjtsMzA.jpg', 2, 'vignette'),
(138, 'A8l1M51j.jpg', 2, NULL),
(139, 'doKirHCZ.png', 2, NULL),
(140, '3isKEnM9.jpg', 2, NULL),
(150, 'prOcGOxV.jpg', 41, 'vignette'),
(166, '8zNcBwJU.jpg', 41, 'vignette'),
(167, 'dtrPnak4.jpg', 41, NULL),
(168, 'OE2TFYdz.jpg', 41, NULL),
(169, 'fXAbqF0Y.png', 41, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `propertys`
--

CREATE TABLE `propertys` (
  `id` int(11) NOT NULL,
  `status_property_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `types_id` int(11) NOT NULL,
  `availability_date` date DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `rooms` int(11) NOT NULL,
  `surface` int(11) NOT NULL,
  `description` longtext NOT NULL,
  `location_id` int(11) NOT NULL,
  `sales_price` int(11) DEFAULT NULL,
  `rent` int(11) DEFAULT NULL,
  `rent_charge` int(11) DEFAULT NULL,
  `charge` int(11) DEFAULT NULL,
  `security_deposit` int(11) DEFAULT NULL,
  `agency_fees_rent` int(11) DEFAULT NULL,
  `energy_diagnostics_id` int(11) DEFAULT NULL,
  `greenhouse_gas_emission_indices_id` int(11) DEFAULT NULL,
  `owner_id` int(11) NOT NULL,
  `tenant_id` int(11) DEFAULT NULL,
  `rental_management_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `propertys`
--

INSERT INTO `propertys` (`id`, `status_property_id`, `state_id`, `types_id`, `availability_date`, `title`, `rooms`, `surface`, `description`, `location_id`, `sales_price`, `rent`, `rent_charge`, `charge`, `security_deposit`, `agency_fees_rent`, `energy_diagnostics_id`, `greenhouse_gas_emission_indices_id`, `owner_id`, `tenant_id`, `rental_management_id`) VALUES
(2, 1, 1, 2, '2024-04-10', 'Maison de bourg', 3, 90, 'Belle maison de bourg neuve exposée plein sud', 9, NULL, 900, 950, 50, 950, 900, 1, 1, 7, 9, 1),
(4, 1, 2, 3, '2024-04-10', 'Parking sous terrain', 3, 90, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam debitis molestiae neque nobis quibusdam accusantium fugiat hic reiciendis dicta, odio quo obcaecati perspiciatis cumque perferendis, magnam qui suscipit rerum veritatis!\r\n', 3, NULL, 50, 60, 10, 50, 50, 3, 1, 7, 6, 1),
(5, 1, 1, 2, '2024-04-10', 'Villa meublé ', 3, 90, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam debitis molestiae neque nobis quibusdam accusantium fugiat hic reiciendis dicta, odio quo obcaecati perspiciatis cumque perferendis, magnam qui suscipit rerum veritatis!\r\n', 2, NULL, 650, 700, 50, 650, 300, 2, 1, 7, NULL, 1),
(41, 1, 2, 1, '2024-04-02', 'top appart', 4, 60, '', 1, NULL, 500, 550, 50, 500, 300, 2, 2, 7, 6, 1),
(43, 1, 2, 1, '2024-04-02', 'top appart', 4, 60, '', 1, NULL, 500, 550, 50, 500, 300, 2, 2, 7, 6, 1),
(45, 1, 2, 1, '2024-04-02', 'top appart', 4, 60, 'super super appart', 19, NULL, 500, 550, 50, 500, 300, 2, 2, 7, 6, 1),
(57, 3, 2, 1, NULL, 'APPARTEMENT À VENDRE', 4, 113, 'IMMO35 vous présente à RENNES, quartier ARSENAL-REDON, un appartement de 113m² . Idéalement situé dans une rue calme et avec la proximité immédiate des commerces, des écoles, et du métro Ligne B, vous bénéficierez du confort de la construction récente de cet immeuble. Actuellement aménagé en bureau, nous proposons des projections d&#039;aménagement sur un modèle de 2 ou 3 chambres. Balcon au sud et second balcon en cour intérieur. Cave privative en sous-sol, local à vélos.', 1, 399000, NULL, NULL, NULL, NULL, 6, 2, 2, 7, 6, 2),
(63, 3, 3, 1, '2024-04-02', 'Appart exposition sud', 5, 100, 'super super appart', 16, 200000, NULL, NULL, NULL, NULL, 6, 2, 2, 7, 6, 1),
(64, 3, 2, 2, '2024-04-02', 'Maison a vendre', 4, 90, 'Magnifique maison de de ville à vendre', 26, 150000, NULL, NULL, NULL, NULL, 6, 2, 2, 7, 6, 1),
(74, 1, 3, 2, '2024-04-07', 'Belle maison de ville rénové entièrement', 5, 100, 'Top maison,  de ville rénové entièrement. Effet waouh garantie.', 146, 0, 900, 950, 50, 900, 650, 3, 3, 7, 6, 1),
(75, 3, 2, 4, '2024-04-02', 'Top terrain', 0, 600, '', 1, 80000, NULL, NULL, NULL, NULL, 5, 2, 2, 7, 6, 1);

-- --------------------------------------------------------

--
-- Structure de la table `property_features`
--

CREATE TABLE `property_features` (
  `id` int(11) NOT NULL,
  `property_features_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `property_features`
--

INSERT INTO `property_features` (`id`, `property_features_name`) VALUES
(1, '1e étage'),
(2, '2e étage'),
(3, '3e étage'),
(4, '4e étage'),
(5, '5e étage'),
(6, 'Rez-de-chaussée'),
(7, '1 salle de bain'),
(8, 'Cuisine Simple'),
(9, 'Non meublé'),
(11, '2 salles de bain'),
(12, '1 chambre'),
(13, '2 chambres'),
(14, '3 chambres'),
(15, '4 chambres'),
(16, 'Ascenseur'),
(17, 'Exposition : Sud'),
(18, 'Exposition : Nord'),
(19, 'Exposition : Est'),
(20, 'Exposition : Ouest'),
(21, 'Garage'),
(23, 'Cuisine Aménagée'),
(24, 'Chauffage Autres'),
(25, 'Chauffage Individuel'),
(26, 'Chauffage Electrique');

-- --------------------------------------------------------

--
-- Structure de la table `property_link_features`
--

CREATE TABLE `property_link_features` (
  `id` int(11) NOT NULL,
  `property_features_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `property_link_features`
--

INSERT INTO `property_link_features` (`id`, `property_features_id`, `property_id`) VALUES
(241, 21, 2),
(242, 11, 2),
(253, 6, 2),
(254, 14, 2),
(293, 15, 74),
(294, 17, 74),
(295, 21, 74),
(296, 25, 74),
(297, 1, 64),
(299, 24, 64),
(307, 3, 57),
(308, 14, 57),
(309, 16, 57),
(310, 25, 57),
(311, 1, 43),
(326, 23, 2),
(327, 25, 2),
(392, 8, 41),
(393, 16, 41),
(395, 3, 41),
(396, 7, 41),
(397, 13, 41),
(398, 17, 41),
(401, 5, 63),
(402, 15, 63),
(403, 16, 63),
(404, 17, 63),
(405, 21, 63),
(406, 23, 63),
(407, 25, 63),
(408, 14, 64);

-- --------------------------------------------------------

--
-- Structure de la table `rental_management`
--

CREATE TABLE `rental_management` (
  `id` int(11) NOT NULL,
  `management` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `rental_management`
--

INSERT INTO `rental_management` (`id`, `management`) VALUES
(1, 'OUI'),
(2, 'NON');

-- --------------------------------------------------------

--
-- Structure de la table `states`
--

CREATE TABLE `states` (
  `id` int(11) NOT NULL,
  `state_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `states`
--

INSERT INTO `states` (`id`, `state_name`) VALUES
(1, 'Neuf'),
(2, 'Ancien'),
(3, 'Rénové');

-- --------------------------------------------------------

--
-- Structure de la table `status_property`
--

CREATE TABLE `status_property` (
  `id` int(11) NOT NULL,
  `status_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `status_property`
--

INSERT INTO `status_property` (`id`, `status_name`) VALUES
(1, 'A LOUER'),
(2, 'LOUE'),
(3, 'A VENDRE'),
(4, 'VENDU'),
(5, 'VACANCE LOCATIVE');

-- --------------------------------------------------------

--
-- Structure de la table `types`
--

CREATE TABLE `types` (
  `id` int(11) NOT NULL,
  `type_name` varchar(255) NOT NULL,
  `type_media` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `types`
--

INSERT INTO `types` (`id`, `type_name`, `type_media`) VALUES
(1, 'Appartements', '../assets/img/appartements-image.webp'),
(2, 'Maisons', '../assets/img/maisons-image.webp'),
(3, 'Stationnements', '../assets/img/parking-image.webp'),
(4, 'Terrains', '../assets/img/terrains-image.webp'),
(5, 'Immeubles', '../assets/img/immeubles-image.webp');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `address`, `phone`, `email`, `password`, `role`, `created_at`) VALUES
(4, 'John', 'DOE', '10 Rue de Paris', '06 85 87 87 85', 'test@test.fr', '$2y$10$Klu2TZeUNHysPmQ8CpXwLOetwsRJAkzMeb6ypdhtTZlvRrG.pxFcy', 'ADMIN', '2024-03-04 14:05:45'),
(6, 'Loc1', 'Doe', '10 rue du Maroc', '06 85 78 45 12', 'loc1@test.com', NULL, 'Locataire', '2024-03-05 12:17:54'),
(7, 'Prop', 'Doe', '10 rue de londre', '02 85 87 85 47 52', 'prop@test.com', NULL, 'Proprietaire', '2024-03-05 16:56:48'),
(9, 'Loc2', 'Doe', '10 rue de Dakhla', '02 44 42 42 44', 'loc2@test.com', NULL, 'Locataire', '2024-03-05 17:50:12'),
(10, 'Hello', 'Doe', '41 rue Marrakech', '02 58 45 44 44', 'hello@test.fr', '$2y$10$Klu2TZeUNHysPmQ8CpXwLOetwsRJAkzMeb6ypdhtTZlvRrG.pxFcy', 'READER', '2024-03-22 10:17:31'),
(15, 'loc3', 'Doe', '10 rue de Rabat', '02 44 42 42 44', 'loc3@test.com', NULL, 'Locataire', '2024-03-05 17:50:12'),
(16, 'loc4', 'Doe', '10 rue de Tanger', '02 44 42 42 44', 'loc4@test.com', NULL, 'Locataire', '2024-03-05 17:50:12'),
(18, 'Joe', 'Doe', '10rue de casa', '02 54 45 45 87 87', 'joe@test.com', NULL, 'Proprietaire', '2024-05-21 22:14:45'),
(19, 'Paul', 'Doe', '10 rue de Rabat', '05 86 89 68 98', 'paul@test.com', NULL, 'Proprietaire', '2024-05-21 22:16:11'),
(21, 'Karim', 'Doe', NULL, '06 58 98 98 58', 'karim@test.fr', '$2y$10$/r1LHSIftFQWCNtgn06iDecMrZC.QyOqLLREZvjlI2HNEkHJPwjVi', 'ADMIN', '2024-05-21 22:30:36'),
(22, 'Moussa', 'Doe', NULL, '06 58 98 98 58', 'moussa@test.fr', '$2y$10$8iFEYwqfrIBRgMZB/Rs3u.pm6wkopU.NUCeQVJFCcCN1lBk/q6fia', 'ADMIN', '2024-05-21 22:33:01'),
(23, 'Mohamed', 'Doe', NULL, '06 85 74 52 14', 'mohamed@test.fr', '$2y$10$cQkIQDkPZ7sP8Nuv/vuMRex92lNU9nVZimLofQ74458eDB3QQsYMS', 'READER', '2024-05-21 22:36:12');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `energy_diagnostics`
--
ALTER TABLE `energy_diagnostics`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `greenhouse_gas_emission_indices`
--
ALTER TABLE `greenhouse_gas_emission_indices`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `medias`
--
ALTER TABLE `medias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `property_id` (`property_id`);

--
-- Index pour la table `propertys`
--
ALTER TABLE `propertys`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status_property_id` (`status_property_id`),
  ADD KEY `state_id` (`state_id`),
  ADD KEY `types_id` (`types_id`),
  ADD KEY `location_id` (`location_id`),
  ADD KEY `rental_management_id` (`rental_management_id`),
  ADD KEY `energy_diagnostics_id` (`energy_diagnostics_id`),
  ADD KEY `greenhouse_gas_emission_indices_id` (`greenhouse_gas_emission_indices_id`),
  ADD KEY `owner_id` (`owner_id`),
  ADD KEY `tenant_id` (`tenant_id`);

--
-- Index pour la table `property_features`
--
ALTER TABLE `property_features`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `property_link_features`
--
ALTER TABLE `property_link_features`
  ADD PRIMARY KEY (`id`),
  ADD KEY `property_features_id` (`property_features_id`),
  ADD KEY `property_id` (`property_id`);

--
-- Index pour la table `rental_management`
--
ALTER TABLE `rental_management`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `status_property`
--
ALTER TABLE `status_property`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `energy_diagnostics`
--
ALTER TABLE `energy_diagnostics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `greenhouse_gas_emission_indices`
--
ALTER TABLE `greenhouse_gas_emission_indices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `location`
--
ALTER TABLE `location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=302;

--
-- AUTO_INCREMENT pour la table `medias`
--
ALTER TABLE `medias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=170;

--
-- AUTO_INCREMENT pour la table `propertys`
--
ALTER TABLE `propertys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT pour la table `property_features`
--
ALTER TABLE `property_features`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT pour la table `property_link_features`
--
ALTER TABLE `property_link_features`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=409;

--
-- AUTO_INCREMENT pour la table `rental_management`
--
ALTER TABLE `rental_management`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `states`
--
ALTER TABLE `states`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `status_property`
--
ALTER TABLE `status_property`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `types`
--
ALTER TABLE `types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `medias`
--
ALTER TABLE `medias`
  ADD CONSTRAINT `medias_ibfk_1` FOREIGN KEY (`property_id`) REFERENCES `propertys` (`id`);

--
-- Contraintes pour la table `propertys`
--
ALTER TABLE `propertys`
  ADD CONSTRAINT `propertys_ibfk_1` FOREIGN KEY (`status_property_id`) REFERENCES `status_property` (`id`),
  ADD CONSTRAINT `propertys_ibfk_10` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `propertys_ibfk_11` FOREIGN KEY (`tenant_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `propertys_ibfk_2` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`),
  ADD CONSTRAINT `propertys_ibfk_3` FOREIGN KEY (`types_id`) REFERENCES `types` (`id`),
  ADD CONSTRAINT `propertys_ibfk_4` FOREIGN KEY (`location_id`) REFERENCES `location` (`id`),
  ADD CONSTRAINT `propertys_ibfk_7` FOREIGN KEY (`rental_management_id`) REFERENCES `rental_management` (`id`),
  ADD CONSTRAINT `propertys_ibfk_8` FOREIGN KEY (`energy_diagnostics_id`) REFERENCES `energy_diagnostics` (`id`),
  ADD CONSTRAINT `propertys_ibfk_9` FOREIGN KEY (`greenhouse_gas_emission_indices_id`) REFERENCES `greenhouse_gas_emission_indices` (`id`);

--
-- Contraintes pour la table `property_link_features`
--
ALTER TABLE `property_link_features`
  ADD CONSTRAINT `property_link_features_ibfk_1` FOREIGN KEY (`property_features_id`) REFERENCES `property_features` (`id`),
  ADD CONSTRAINT `property_link_features_ibfk_2` FOREIGN KEY (`property_id`) REFERENCES `propertys` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
