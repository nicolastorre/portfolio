-- phpMyAdmin SQL Dump
-- version 4.4.13.1
-- http://www.phpmyadmin.net
--
-- Client :  nicolastygdoudou.mysql.db
-- Généré le :  Lun 04 Janvier 2016 à 10:39
-- Version du serveur :  5.5.46-0+deb7u1-log
-- Version de PHP :  5.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `nicolastygdoudou`
--

-- --------------------------------------------------------

--
-- Structure de la table `Portfolio_Domain_Model_Article`
--

CREATE TABLE IF NOT EXISTS `Portfolio_Domain_Model_Article` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `publishedDate` int(11) NOT NULL,
  `author` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `published` tinyint(4) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `Portfolio_Domain_Model_Article`
--

INSERT INTO `Portfolio_Domain_Model_Article` (`id`, `title`, `content`, `publishedDate`, `author`, `image`, `published`) VALUES
(11, 'Prochainement ...', 'Ce blog ouvrira prochainement. Il présentera des actus du web, ma veille techno, des projets perso et des tutos de dev.\r\nA très bientôt!!!', 1443996000, 2, 'Comingsoon.png', 1);

-- --------------------------------------------------------

--
-- Structure de la table `Portfolio_Domain_Model_Bio`
--

CREATE TABLE IF NOT EXISTS `Portfolio_Domain_Model_Bio` (
  `id` int(11) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `presentation` text NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `Portfolio_Domain_Model_Bio`
--

INSERT INTO `Portfolio_Domain_Model_Bio` (`id`, `firstName`, `lastName`, `presentation`, `image`) VALUES
(7, 'Nicolas', 'Torre', 'Développeur web passionné, je souhaite m''épanouir dans des projets innovants!', 'test.png');

-- --------------------------------------------------------

--
-- Structure de la table `Portfolio_Domain_Model_Contact`
--

CREATE TABLE IF NOT EXISTS `Portfolio_Domain_Model_Contact` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `object` varchar(255) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `Portfolio_Domain_Model_Contact`
--

INSERT INTO `Portfolio_Domain_Model_Contact` (`id`, `email`, `object`, `message`) VALUES
(4, 'ntorre@gaya.fr', 'Test', 'Ceci est un message de test!!!'),
(5, 'dsffds@fdssdfd.fr', 'gfdgsfg', 'gfdsgfgfdg'),
(6, 'fdsfsdff@sdfdsfd.fr', 'gfdgdsfg', 'dfsfsdqf');

-- --------------------------------------------------------

--
-- Structure de la table `Portfolio_Domain_Model_Diploma`
--

CREATE TABLE IF NOT EXISTS `Portfolio_Domain_Model_Diploma` (
  `id` int(11) NOT NULL,
  `startDate` int(11) NOT NULL,
  `endDate` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `bio` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `Portfolio_Domain_Model_Diploma`
--

INSERT INTO `Portfolio_Domain_Model_Diploma` (`id`, `startDate`, `endDate`, `title`, `description`, `bio`) VALUES
(12, 1410991200, 1443564000, 'Licence Professionnelle Informatique Multimédia appliquée', 'Formation aux métiers du web et acquisition de compétences en PHP, JS, jQuery, Symfony et Wordpress.', 7),
(13, 1251756000, 1309384800, 'Master de Biologie', 'Spécialité écologie et biologie des populations', 7);

-- --------------------------------------------------------

--
-- Structure de la table `Portfolio_Domain_Model_Exp`
--

CREATE TABLE IF NOT EXISTS `Portfolio_Domain_Model_Exp` (
  `id` int(11) NOT NULL,
  `startDate` int(11) NOT NULL,
  `endDate` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `current` tinyint(4) NOT NULL,
  `bio` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `Portfolio_Domain_Model_Exp`
--

INSERT INTO `Portfolio_Domain_Model_Exp` (`id`, `startDate`, `endDate`, `title`, `description`, `current`, `bio`) VALUES
(1, 1431295200, 1443564000, 'Développeur web stagiaire dans l''agence GAYA', 'Stage de fin de Licence Pro d''une durée de 5 mois. Compétences acquises en TYPO3 CMS, TYPO3 Flow et Drupal.', 0, 7),
(2, 1443650400, 1262300400, 'Développeur web dans l''agence GAYA', 'Technologie utilisé: TYPO3 CMS, TYPO3 Flow et Drupal', 1, 7);

-- --------------------------------------------------------

--
-- Structure de la table `Portfolio_Domain_Model_Interest`
--

CREATE TABLE IF NOT EXISTS `Portfolio_Domain_Model_Interest` (
  `id` int(11) NOT NULL,
  `label` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `bio` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `Portfolio_Domain_Model_Interest`
--

INSERT INTO `Portfolio_Domain_Model_Interest` (`id`, `label`, `link`, `bio`) VALUES
(1, 'Vielle à roue', 'https://fr.wikipedia.org/wiki/Vielle_%C3%A0_roue', 7),
(2, 'Escalade', 'https://fr.wikipedia.org/wiki/Escalade', 7);

-- --------------------------------------------------------

--
-- Structure de la table `Portfolio_Domain_Model_Skill`
--

CREATE TABLE IF NOT EXISTS `Portfolio_Domain_Model_Skill` (
  `id` int(11) NOT NULL,
  `label` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `level` int(11) NOT NULL,
  `bio` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `Portfolio_Domain_Model_Skill`
--

INSERT INTO `Portfolio_Domain_Model_Skill` (`id`, `label`, `link`, `level`, `bio`) VALUES
(3, 'PHP', 'https://secure.php.net/manual/fr/index.php', 80, 7),
(5, 'Symfony', 'https://symfony.com/', 20, 7),
(6, 'JavaScript', 'https://developer.mozilla.org/fr/docs/Web/JavaScript', 80, 7),
(7, 'Flow', 'http://flow.typo3.org/home', 50, 7);

-- --------------------------------------------------------

--
-- Structure de la table `Portfolio_Domain_Model_User`
--

CREATE TABLE IF NOT EXISTS `Portfolio_Domain_Model_User` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(23) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `Portfolio_Domain_Model_User`
--

INSERT INTO `Portfolio_Domain_Model_User` (`id`, `username`, `password`, `salt`, `role`) VALUES
(1, 'JohnDoe', 'L2nNR5hIcinaJkKR+j4baYaZjcHS0c3WX2gjYF6Tmgl1Bs+C9Qbr+69X8eQwXDvw0vp73PrcSeT0bGEW5+T2hA==', 'YcM=A$nsYzkyeDVjEUa7W9K', 'ROLE_USER'),
(2, 'Nicolas', 'EBinkp8yCtzEjRtvk59kxmNMBLdOH8jCRujKOe8s/ryocjGqM1tslIF21nkGadkMH9ZwqzOVJ4dBRXiPPAt1Wg==', 'a729980633f607899400fdd', 'ROLE_ADMIN');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `Portfolio_Domain_Model_Article`
--
ALTER TABLE `Portfolio_Domain_Model_Article`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_article_author` (`author`);

--
-- Index pour la table `Portfolio_Domain_Model_Bio`
--
ALTER TABLE `Portfolio_Domain_Model_Bio`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Portfolio_Domain_Model_Contact`
--
ALTER TABLE `Portfolio_Domain_Model_Contact`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Portfolio_Domain_Model_Diploma`
--
ALTER TABLE `Portfolio_Domain_Model_Diploma`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_diploma_bio` (`bio`);

--
-- Index pour la table `Portfolio_Domain_Model_Exp`
--
ALTER TABLE `Portfolio_Domain_Model_Exp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_exp_bio` (`bio`);

--
-- Index pour la table `Portfolio_Domain_Model_Interest`
--
ALTER TABLE `Portfolio_Domain_Model_Interest`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_interest_bio` (`bio`);

--
-- Index pour la table `Portfolio_Domain_Model_Skill`
--
ALTER TABLE `Portfolio_Domain_Model_Skill`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_skill_bio` (`bio`);

--
-- Index pour la table `Portfolio_Domain_Model_User`
--
ALTER TABLE `Portfolio_Domain_Model_User`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `Portfolio_Domain_Model_Article`
--
ALTER TABLE `Portfolio_Domain_Model_Article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT pour la table `Portfolio_Domain_Model_Bio`
--
ALTER TABLE `Portfolio_Domain_Model_Bio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `Portfolio_Domain_Model_Contact`
--
ALTER TABLE `Portfolio_Domain_Model_Contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `Portfolio_Domain_Model_Diploma`
--
ALTER TABLE `Portfolio_Domain_Model_Diploma`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT pour la table `Portfolio_Domain_Model_Exp`
--
ALTER TABLE `Portfolio_Domain_Model_Exp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `Portfolio_Domain_Model_Interest`
--
ALTER TABLE `Portfolio_Domain_Model_Interest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `Portfolio_Domain_Model_Skill`
--
ALTER TABLE `Portfolio_Domain_Model_Skill`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `Portfolio_Domain_Model_User`
--
ALTER TABLE `Portfolio_Domain_Model_User`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `Portfolio_Domain_Model_Article`
--
ALTER TABLE `Portfolio_Domain_Model_Article`
  ADD CONSTRAINT `fk_article_author` FOREIGN KEY (`author`) REFERENCES `Portfolio_Domain_Model_User` (`id`);

--
-- Contraintes pour la table `Portfolio_Domain_Model_Diploma`
--
ALTER TABLE `Portfolio_Domain_Model_Diploma`
  ADD CONSTRAINT `fk_diploma_bio` FOREIGN KEY (`bio`) REFERENCES `Portfolio_Domain_Model_Bio` (`id`);

--
-- Contraintes pour la table `Portfolio_Domain_Model_Exp`
--
ALTER TABLE `Portfolio_Domain_Model_Exp`
  ADD CONSTRAINT `fk_exp_bio` FOREIGN KEY (`bio`) REFERENCES `Portfolio_Domain_Model_Bio` (`id`);

--
-- Contraintes pour la table `Portfolio_Domain_Model_Interest`
--
ALTER TABLE `Portfolio_Domain_Model_Interest`
  ADD CONSTRAINT `fk_interest_bio` FOREIGN KEY (`bio`) REFERENCES `Portfolio_Domain_Model_Bio` (`id`);

--
-- Contraintes pour la table `Portfolio_Domain_Model_Skill`
--
ALTER TABLE `Portfolio_Domain_Model_Skill`
  ADD CONSTRAINT `fk_skill_bio` FOREIGN KEY (`bio`) REFERENCES `Portfolio_Domain_Model_Bio` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
