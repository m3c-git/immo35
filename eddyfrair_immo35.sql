-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : db.3wa.io
-- Généré le : dim. 03 mars 2024 à 16:44
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
-- Structure de la table `energy_performance`
--

CREATE TABLE `energy_performance` (
  `id` int(11) NOT NULL,
  `energy_diagnostics` varchar(255) NOT NULL,
  `greenhouse_gas_emission_indices` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `energy_performance`
--

INSERT INTO `energy_performance` (`id`, `energy_diagnostics`, `greenhouse_gas_emission_indices`) VALUES
(1, 'A', 'A'),
(2, 'B', 'B'),
(3, 'C', 'C'),
(4, 'D', 'D'),
(5, 'E', 'E'),
(6, 'F', 'F'),
(7, 'G', 'G');

-- --------------------------------------------------------

--
-- Structure de la table `location`
--

CREATE TABLE `location` (
  `id` int(11) NOT NULL,
  `city` varchar(255) NOT NULL,
  `district` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `propertys`
--

CREATE TABLE `propertys` (
  `id` int(11) NOT NULL,
  `status_property_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `types_id` int(11) NOT NULL,
  `availability_date` date NOT NULL,
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
  `energy_performance_id` int(11) DEFAULT NULL,
  `users_id` int(11) NOT NULL,
  `rental_management_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `type_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `types`
--

INSERT INTO `types` (`id`, `type_name`) VALUES
(1, 'Appartement'),
(2, 'Maison'),
(3, 'Stationnement'),
(4, 'Terrain'),
(5, 'Immeuble');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `energy_performance`
--
ALTER TABLE `energy_performance`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `propertys`
--
ALTER TABLE `propertys`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status_property_id` (`status_property_id`),
  ADD KEY `state_id` (`state_id`),
  ADD KEY `types_id` (`types_id`),
  ADD KEY `location_id` (`location_id`),
  ADD KEY `energy_performance_id` (`energy_performance_id`),
  ADD KEY `users_id` (`users_id`),
  ADD KEY `rental_management_id` (`rental_management_id`);

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
-- AUTO_INCREMENT pour la table `energy_performance`
--
ALTER TABLE `energy_performance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `location`
--
ALTER TABLE `location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `propertys`
--
ALTER TABLE `propertys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `propertys`
--
ALTER TABLE `propertys`
  ADD CONSTRAINT `propertys_ibfk_1` FOREIGN KEY (`status_property_id`) REFERENCES `status_property` (`id`),
  ADD CONSTRAINT `propertys_ibfk_2` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`),
  ADD CONSTRAINT `propertys_ibfk_3` FOREIGN KEY (`types_id`) REFERENCES `types` (`id`),
  ADD CONSTRAINT `propertys_ibfk_4` FOREIGN KEY (`location_id`) REFERENCES `location` (`id`),
  ADD CONSTRAINT `propertys_ibfk_5` FOREIGN KEY (`energy_performance_id`) REFERENCES `energy_performance` (`id`),
  ADD CONSTRAINT `propertys_ibfk_6` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `propertys_ibfk_7` FOREIGN KEY (`rental_management_id`) REFERENCES `rental_management` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
