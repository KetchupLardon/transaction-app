-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : sam. 24 avr. 2021 à 04:20
-- Version du serveur :  10.3.25-MariaDB-0ubuntu0.20.04.1
-- Version de PHP : 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `transapp`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id`, `user_id`, `name`) VALUES
(1, 1, 'Chèque Mamie'),
(2, 1, 'Alimentation'),
(3, 1, 'Restaurant'),
(4, 1, 'Sport'),
(5, 1, 'Divertissements'),
(6, 1, 'Salaire'),
(7, 1, 'Prime'),
(8, 1, 'Loto'),
(9, 1, 'Essence'),
(10, 1, 'Loyer'),
(11, 1, 'Vacances'),
(12, 1, 'Autres'),
(16, 1, 'Shopping'),
(17, 1, 'Famille');

-- --------------------------------------------------------

--
-- Structure de la table `moyen_paiement`
--

CREATE TABLE `moyen_paiement` (
  `id` int(11) NOT NULL,
  `method` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `moyen_paiement`
--

INSERT INTO `moyen_paiement` (`id`, `method`) VALUES
(1, 'Chèque'),
(2, 'Carte Bancaire'),
(3, 'Espèces'),
(4, 'Virement'),
(5, 'Paypal'),
(6, 'Autres');

-- --------------------------------------------------------

--
-- Structure de la table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `categorie_id` int(11) NOT NULL,
  `amount` float NOT NULL,
  `type` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `comment` varchar(255) NOT NULL,
  `payment_method_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `transaction`
--

INSERT INTO `transaction` (`id`, `user_id`, `categorie_id`, `amount`, `type`, `date`, `comment`, `payment_method_id`) VALUES
(10, 1, 4, -1212, 'debit', '2021-03-27', 'huhuhuhu', 2),
(11, 1, 2, 87, 'credit', '2021-03-19', 'test', 1),
(27, 1, 2, -212, 'debit', '2021-04-04', 'course du mois', 2),
(28, 1, 16, -70, 'debit', '2021-04-05', 'Veste hiver', 2),
(29, 1, 17, 50, 'credit', '2020-12-24', 'noël', 3),
(30, 1, 8, -22, 'debit', '2021-04-07', '', 1),
(31, 1, 6, 1100, 'credit', '2021-04-06', '', 1),
(32, 1, 3, -32, 'debit', '2021-04-21', 'Fernand', 3),
(33, 1, 5, -8, 'debit', '2021-03-09', 'Cinéma', 2),
(34, 1, 10, -450, 'debit', '2021-03-16', 'ce crevar', 4),
(35, 1, 6, 1100, 'credit', '2021-03-06', '', 4),
(36, 1, 4, -12, 'debit', '2021-03-16', 'escalade', 3),
(37, 1, 17, -15, 'debit', '2021-02-10', 'acheter cahier pour enfant', 1),
(38, 1, 2, -150, 'debit', '2021-02-09', 'course de la semaine', 1),
(39, 1, 5, -25, 'debit', '2021-02-08', 'parc d\'atraction', 2),
(40, 1, 16, 15, 'credit', '2021-02-16', 'retour colis', 2),
(41, 1, 6, -1100, 'credit', '2021-02-06', '', 4),
(42, 1, 16, -15, 'debit', '2021-04-13', '', 2),
(43, 1, 2, -45, 'debit', '2021-04-21', 'auchan', 2),
(44, 1, 5, 45, 'credit', '2021-04-22', 'wwe', 1),
(45, 1, 2, -12, 'debit', '2021-04-22', 'jajan', 2),
(46, 1, 1, 60, 'credit', '2021-04-17', 'cadeau', 1);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(16) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `name`, `password`, `first_name`, `last_name`) VALUES
(1, 'toto', 'toto', 'Eric', 'Christoffel');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_categorie_user_id` (`user_id`);

--
-- Index pour la table `moyen_paiement`
--
ALTER TABLE `moyen_paiement`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_user_id` (`user_id`),
  ADD KEY `FK_categorie_id` (`categorie_id`),
  ADD KEY `FK_moyen_paiement_id` (`payment_method_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `moyen_paiement`
--
ALTER TABLE `moyen_paiement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD CONSTRAINT `FK_categorie_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `FK_categorie_id` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id`),
  ADD CONSTRAINT `FK_moyen_paiement_id` FOREIGN KEY (`payment_method_id`) REFERENCES `moyen_paiement` (`id`),
  ADD CONSTRAINT `FK_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
