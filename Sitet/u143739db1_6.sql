-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  mar. 17 avr. 2018 à 09:09
-- Version du serveur :  5.7.20-19-log
-- Version de PHP :  5.5.38-1~dotdeb+7.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `u143739db1`
--

DELIMITER $$
--
-- Procédures
--
CREATE DEFINER=`u143739db1`@`%` PROCEDURE `AddGoodie` (IN `in_name` TEXT, IN `in_desc` TEXT, IN `in_prix` FLOAT, IN `in_categorie` TEXT)  MODIFIES SQL DATA
    DETERMINISTIC
    COMMENT 'Créer un goodie'
INSERT INTO goodie(id_goodie, name, description, prix_goodie, categorie)
VALUES(NULL, in_name, in_desc, in_prix, in_categorie)$$

CREATE DEFINER=`u143739db1`@`%` PROCEDURE `AddImgCommentEventByID` (IN `img_id` INT, IN `in_comment` TEXT, IN `usr_id` INT)  MODIFIES SQL DATA
    DETERMINISTIC
    COMMENT 'Ajoute un commentaire à une image par son id'
INSERT INTO image_comment(id_comment, comment_text, id_user, id_image) VALUES (NULL, in_comment, usr_id, img_id)$$

CREATE DEFINER=`u143739db1`@`%` PROCEDURE `AddImgEventByID` (IN `event_id` INT, IN `in_img` TEXT)  MODIFIES SQL DATA
    DETERMINISTIC
    COMMENT 'Ajoute une image dans un event avec l''ID'
INSERT INTO image_event(id_image,image,id_event)
VALUES (NULL,in_img,event_id)$$

CREATE DEFINER=`u143739db1`@`%` PROCEDURE `CreateEvent` (IN `in_name` TEXT, IN `in_status` INT, IN `in_desc` TEXT, IN `in_date` TIMESTAMP, IN `in_recc` TEXT, IN `in_prix` FLOAT)  MODIFIES SQL DATA
    DETERMINISTIC
    COMMENT 'Créer un événement'
INSERT INTO evenement VALUES (NULL, in_name, in_status, in_desc, in_date, in_recc, in_prix)$$

CREATE DEFINER=`u143739db1`@`%` PROCEDURE `GetEventInfosByID` (IN `event_id` INT, OUT `eventInfos` JSON)  READS SQL DATA
    DETERMINISTIC
    COMMENT 'Donne les infos event a partir de son id'
SELECT * FROM evenement
WHERE id_event=event_id$$

CREATE DEFINER=`u143739db1`@`%` PROCEDURE `GetGoodieInfosByID` (IN `goodie_id` INT)  READS SQL DATA
    DETERMINISTIC
    COMMENT 'donne les info d''un goodie a partir de son id'
SELECT * FROM goodie
WHERE id_goodie=goodie_id$$

CREATE DEFINER=`u143739db1`@`%` PROCEDURE `GetImgCommentsByID` (IN `img_id` INT)  READS SQL DATA
    DETERMINISTIC
    COMMENT 'Retournes tous les commentaires complets via l''id de l''image'
SELECT * FROM image_comment
WHERE id_image=img_id$$

CREATE DEFINER=`u143739db1`@`%` PROCEDURE `GetImgEventByID` (IN `event_id` INT)  READS SQL DATA
    DETERMINISTIC
    COMMENT 'Donne toutes les images d''un event à partir de son ID'
SELECT image FROM image_event
WHERE id_event=event_id$$

CREATE DEFINER=`u143739db1`@`%` PROCEDURE `GetImgLikesByID` (IN `img_id` INT)  READS SQL DATA
    DETERMINISTIC
    COMMENT 'Retourne les likes d''une image via l''ID de cette dernière'
SELECT * FROM AIME
WHERE id_image=img_id$$

CREATE DEFINER=`u143739db1`@`%` PROCEDURE `GetImgLikesTotalByID` (IN `img_id` INT)  READS SQL DATA
    DETERMINISTIC
    COMMENT 'Compte le nombre de like d''une image'
SELECT COUNT(id_image) FROM AIME
WHERE id_image=img_id$$

CREATE DEFINER=`u143739db1`@`%` PROCEDURE `GetImgMostLikesByID` (IN `nb` INT)  READS SQL DATA
    DETERMINISTIC
    COMMENT 'Donne les x images les plus likés'
SELECT COUNT(id_user), id_image FROM AIME
GROUP BY id_image
ORDER BY COUNT(id_user) DESC
LIMIT nb$$

CREATE DEFINER=`u143739db1`@`%` PROCEDURE `GetSuggVotesByID` (IN `sugg_id` INT)  READS SQL DATA
    DETERMINISTIC
    COMMENT 'Donne tout les votes complets d''une suggestion via son id'
SELECT * FROM VOTE
WHERE id_suggestion=sugg_id$$

CREATE DEFINER=`u143739db1`@`%` PROCEDURE `GetSuggVotesTotalByID` (IN `sugg_id` INT)  READS SQL DATA
    DETERMINISTIC
SELECT COUNT(id_suggestion) FROM VOTE
WHERE id_suggestion=sugg_id$$

CREATE DEFINER=`u143739db1`@`%` PROCEDURE `GetUserInfosByID` (IN `input_id` INT)  READS SQL DATA
    DETERMINISTIC
    COMMENT 'Get an user infos from the ID'
SELECT id_user, name, firstname, mail, role FROM utilisateur
WHERE id_user=input_id$$

CREATE DEFINER=`u143739db1`@`%` PROCEDURE `GetUserRoleByID` (IN `usr_id` INT)  READS SQL DATA
    DETERMINISTIC
    COMMENT 'permet de lire le rôle d''un utilisateur à partir de son idée'
SELECT id_user, role FROM utilisateur
WHERE id_user=usr_id$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `AIME`
--

CREATE TABLE `AIME` (
  `id_user` int(11) NOT NULL,
  `id_image` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `AIME`
--

INSERT INTO `AIME` (`id_user`, `id_image`) VALUES
(3, 1),
(4, 2),
(3, 4),
(10, 4),
(4, 5),
(7, 5),
(8, 5);

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `id_commande` int(11) NOT NULL,
  `date_commande` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id_commande`, `date_commande`, `id_user`) VALUES
(1, '2018-04-10 12:50:12', 7);

-- --------------------------------------------------------

--
-- Structure de la table `CONTIENT`
--

CREATE TABLE `CONTIENT` (
  `quantite` int(11) NOT NULL,
  `id_commande` int(11) NOT NULL,
  `id_goodie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `evenement`
--

CREATE TABLE `evenement` (
  `id_event` int(11) NOT NULL,
  `name` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `description` text,
  `date_event` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `recurrence` varchar(8) NOT NULL DEFAULT '0',
  `prix_event` float NOT NULL DEFAULT '0',
  `id_user` int(11) NOT NULL,
  `background_img_event` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `evenement`
--

INSERT INTO `evenement` (`id_event`, `name`, `status`, `description`, `date_event`, `recurrence`, `prix_event`, `id_user`, `background_img_event`) VALUES
(1, 'Blocus devant le Patio', 0, 'La dernière assemblée générale du mois d\'avril', '2018-04-17 08:48:45', '0', 0, 8, '/images/image1.jpg'),
(2, 'Lan #26', 0, 'Venez à la prochaine LAN', '2018-04-17 08:48:45', '0', 0, 6, '/images/image2.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `goodie`
--

CREATE TABLE `goodie` (
  `id_goodie` int(11) NOT NULL,
  `name` text NOT NULL,
  `description` text,
  `prix_goodie` float NOT NULL,
  `categorie` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `goodie`
--

INSERT INTO `goodie` (`id_goodie`, `name`, `description`, `prix_goodie`, `categorie`) VALUES
(1, 'T-shirt Cesi Exia', 'T-shirt de qualité avec le logo du cesi exia', 11, 'vêtement'),
(2, 'Sweat Exia', 'Un sweat rembourré qui tient bien chaud, pratique pour l\'hiver!', 23, 'vêtement');

-- --------------------------------------------------------

--
-- Structure de la table `image_comment`
--

CREATE TABLE `image_comment` (
  `id_comment` int(11) NOT NULL,
  `comment_text` text NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_image` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `image_comment`
--

INSERT INTO `image_comment` (`id_comment`, `comment_text`, `id_user`, `id_image`) VALUES
(1, 'superbe image!', 10, 3);

-- --------------------------------------------------------

--
-- Structure de la table `image_event`
--

CREATE TABLE `image_event` (
  `id_image` int(11) NOT NULL,
  `image` text NOT NULL,
  `id_event` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `image_event`
--

INSERT INTO `image_event` (`id_image`, `image`, `id_event`) VALUES
(1, '/img/image1.jpg', 1),
(2, '/img/image2.jpg', 1),
(3, '/img/image3.jpg', 1),
(4, '/img/img4.jpg', 2),
(5, '/img/image6.jpg', 2),
(6, '/img/imag_proco.jpg', 1);

-- --------------------------------------------------------

--
-- Structure de la table `image_goodie`
--

CREATE TABLE `image_goodie` (
  `id_img_goodie` int(11) NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `image_goodie`
--

INSERT INTO `image_goodie` (`id_img_goodie`, `image`) VALUES
(1, '/img/goodie1.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `PARTICIPE`
--

CREATE TABLE `PARTICIPE` (
  `id_user` int(11) NOT NULL,
  `id_event` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `POSSEDE_IMG_GOODIES`
--

CREATE TABLE `POSSEDE_IMG_GOODIES` (
  `id_goodie` int(11) NOT NULL,
  `id_img_goodie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `POSTE`
--

CREATE TABLE `POSTE` (
  `id_user` int(11) NOT NULL,
  `id_image` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `REPORT_COMMENT`
--

CREATE TABLE `REPORT_COMMENT` (
  `id_comment` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `REPORT_EVENT`
--

CREATE TABLE `REPORT_EVENT` (
  `id_event` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `REPORT_IMAGE`
--

CREATE TABLE `REPORT_IMAGE` (
  `id_image` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `REPORT_SUGGESTION`
--

CREATE TABLE `REPORT_SUGGESTION` (
  `id_suggestion` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `suggestion_event`
--

CREATE TABLE `suggestion_event` (
  `id_suggestion` int(11) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `date_suggestion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id_user` int(11) NOT NULL,
  `name` text NOT NULL,
  `firstname` text NOT NULL,
  `mail` text NOT NULL,
  `password` text NOT NULL,
  `role` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id_user`, `name`, `firstname`, `mail`, `password`, `role`) VALUES
(1, 'Jean-Claude', 'Van Damme', 'JCVD@hotlook.com', 'jesuisfort', 1),
(2, 'Joseph', 'Dupont', 'jojo.dupont@gmail.com', 'faux', 1),
(3, 'Amandine', 'Weiss', 'amandine.weiss@viacesi.fr', 'amandinedu38', 1),
(4, 'Amine', 'brahmia', 'abrahmia@cesi.fr', 'eR3t1k', 2),
(5, 'Gérard', 'Schott', 'gerard.schott2@viacesi.fr', 'azertyuiop', 1),
(6, 'Pierre', 'Froideveaux', 'pierre.froideveaux', 'TheRedDuck', 3),
(7, 'Thomas', 'Wiedmann', 'thomas.wiedmann@viacesi.fr', 'KaliLinuxRGB', 1),
(8, 'Gülay', 'Kozludere', 'gulayhu.kozludere@viacesi.fr', 'Pandas-Wan', 3),
(9, 'Mathieu', 'Kister', 'mkister@cesi.fr', 'R5a8d9bx', 2),
(10, 'Gilbert', 'Kuntz', 'gilbert.kuntz@viacesi.fr', 'Zero0pique1', 1);

-- --------------------------------------------------------

--
-- Structure de la table `VOTE`
--

CREATE TABLE `VOTE` (
  `id_user` int(11) NOT NULL,
  `id_suggestion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `AIME`
--
ALTER TABLE `AIME`
  ADD PRIMARY KEY (`id_user`,`id_image`),
  ADD KEY `FK_AIME_id_image` (`id_image`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id_commande`),
  ADD KEY `FK_commande_id_user` (`id_user`);

--
-- Index pour la table `CONTIENT`
--
ALTER TABLE `CONTIENT`
  ADD PRIMARY KEY (`id_commande`,`id_goodie`),
  ADD KEY `FK_CONTIENT_id_goodie` (`id_goodie`);

--
-- Index pour la table `evenement`
--
ALTER TABLE `evenement`
  ADD PRIMARY KEY (`id_event`),
  ADD KEY `FK_evenement_id_user` (`id_user`);

--
-- Index pour la table `goodie`
--
ALTER TABLE `goodie`
  ADD PRIMARY KEY (`id_goodie`);

--
-- Index pour la table `image_comment`
--
ALTER TABLE `image_comment`
  ADD PRIMARY KEY (`id_comment`),
  ADD KEY `FK_image_comment_id_user` (`id_user`),
  ADD KEY `FK_image_comment_id_image` (`id_image`);

--
-- Index pour la table `image_event`
--
ALTER TABLE `image_event`
  ADD PRIMARY KEY (`id_image`),
  ADD KEY `FK_image_event_id_event` (`id_event`);

--
-- Index pour la table `image_goodie`
--
ALTER TABLE `image_goodie`
  ADD PRIMARY KEY (`id_img_goodie`);

--
-- Index pour la table `PARTICIPE`
--
ALTER TABLE `PARTICIPE`
  ADD PRIMARY KEY (`id_user`,`id_event`),
  ADD KEY `FK_PARTICIPE_id_event` (`id_event`);

--
-- Index pour la table `POSSEDE_IMG_GOODIES`
--
ALTER TABLE `POSSEDE_IMG_GOODIES`
  ADD PRIMARY KEY (`id_goodie`,`id_img_goodie`),
  ADD KEY `FK_POSSEDE_IMG_GOODIES_id_img_goodie` (`id_img_goodie`);

--
-- Index pour la table `POSTE`
--
ALTER TABLE `POSTE`
  ADD PRIMARY KEY (`id_user`,`id_image`),
  ADD KEY `FK_POSTE_id_image` (`id_image`);

--
-- Index pour la table `REPORT_COMMENT`
--
ALTER TABLE `REPORT_COMMENT`
  ADD PRIMARY KEY (`id_comment`,`id_user`),
  ADD KEY `FK_REPORT_COMMENT_id_user` (`id_user`);

--
-- Index pour la table `REPORT_EVENT`
--
ALTER TABLE `REPORT_EVENT`
  ADD PRIMARY KEY (`id_event`,`id_user`),
  ADD KEY `FK_REPORT_EVENT_id_user` (`id_user`);

--
-- Index pour la table `REPORT_IMAGE`
--
ALTER TABLE `REPORT_IMAGE`
  ADD PRIMARY KEY (`id_image`,`id_user`),
  ADD KEY `FK_REPORT_IMAGE_id_user` (`id_user`);

--
-- Index pour la table `REPORT_SUGGESTION`
--
ALTER TABLE `REPORT_SUGGESTION`
  ADD PRIMARY KEY (`id_suggestion`,`id_user`),
  ADD KEY `FK_REPORT_SUGGESTION_id_user` (`id_user`);

--
-- Index pour la table `suggestion_event`
--
ALTER TABLE `suggestion_event`
  ADD PRIMARY KEY (`id_suggestion`),
  ADD KEY `FK_suggestion_event_id_user` (`id_user`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id_user`);

--
-- Index pour la table `VOTE`
--
ALTER TABLE `VOTE`
  ADD PRIMARY KEY (`id_user`,`id_suggestion`),
  ADD KEY `FK_VOTE_id_suggestion` (`id_suggestion`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `id_commande` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `evenement`
--
ALTER TABLE `evenement`
  MODIFY `id_event` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `goodie`
--
ALTER TABLE `goodie`
  MODIFY `id_goodie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `image_comment`
--
ALTER TABLE `image_comment`
  MODIFY `id_comment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `image_event`
--
ALTER TABLE `image_event`
  MODIFY `id_image` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `image_goodie`
--
ALTER TABLE `image_goodie`
  MODIFY `id_img_goodie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `suggestion_event`
--
ALTER TABLE `suggestion_event`
  MODIFY `id_suggestion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `AIME`
--
ALTER TABLE `AIME`
  ADD CONSTRAINT `FK_AIME_id_image` FOREIGN KEY (`id_image`) REFERENCES `image_event` (`id_image`),
  ADD CONSTRAINT `FK_AIME_id_user` FOREIGN KEY (`id_user`) REFERENCES `utilisateur` (`id_user`);

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `FK_commande_id_user` FOREIGN KEY (`id_user`) REFERENCES `utilisateur` (`id_user`);

--
-- Contraintes pour la table `CONTIENT`
--
ALTER TABLE `CONTIENT`
  ADD CONSTRAINT `FK_CONTIENT_id_commande` FOREIGN KEY (`id_commande`) REFERENCES `commande` (`id_commande`),
  ADD CONSTRAINT `FK_CONTIENT_id_goodie` FOREIGN KEY (`id_goodie`) REFERENCES `goodie` (`id_goodie`);

--
-- Contraintes pour la table `evenement`
--
ALTER TABLE `evenement`
  ADD CONSTRAINT `FK_evenement_id_user` FOREIGN KEY (`id_user`) REFERENCES `utilisateur` (`id_user`);

--
-- Contraintes pour la table `image_comment`
--
ALTER TABLE `image_comment`
  ADD CONSTRAINT `FK_image_comment_id_image` FOREIGN KEY (`id_image`) REFERENCES `image_event` (`id_image`),
  ADD CONSTRAINT `FK_image_comment_id_user` FOREIGN KEY (`id_user`) REFERENCES `utilisateur` (`id_user`);

--
-- Contraintes pour la table `image_event`
--
ALTER TABLE `image_event`
  ADD CONSTRAINT `FK_image_event_id_event` FOREIGN KEY (`id_event`) REFERENCES `evenement` (`id_event`);

--
-- Contraintes pour la table `PARTICIPE`
--
ALTER TABLE `PARTICIPE`
  ADD CONSTRAINT `FK_PARTICIPE_id_event` FOREIGN KEY (`id_event`) REFERENCES `evenement` (`id_event`),
  ADD CONSTRAINT `FK_PARTICIPE_id_user` FOREIGN KEY (`id_user`) REFERENCES `utilisateur` (`id_user`);

--
-- Contraintes pour la table `POSSEDE_IMG_GOODIES`
--
ALTER TABLE `POSSEDE_IMG_GOODIES`
  ADD CONSTRAINT `FK_POSSEDE_IMG_GOODIES_id_goodie` FOREIGN KEY (`id_goodie`) REFERENCES `goodie` (`id_goodie`),
  ADD CONSTRAINT `FK_POSSEDE_IMG_GOODIES_id_img_goodie` FOREIGN KEY (`id_img_goodie`) REFERENCES `image_goodie` (`id_img_goodie`);

--
-- Contraintes pour la table `POSTE`
--
ALTER TABLE `POSTE`
  ADD CONSTRAINT `FK_POSTE_id_image` FOREIGN KEY (`id_image`) REFERENCES `image_event` (`id_image`),
  ADD CONSTRAINT `FK_POSTE_id_user` FOREIGN KEY (`id_user`) REFERENCES `utilisateur` (`id_user`);

--
-- Contraintes pour la table `REPORT_COMMENT`
--
ALTER TABLE `REPORT_COMMENT`
  ADD CONSTRAINT `FK_REPORT_COMMENT_id_comment` FOREIGN KEY (`id_comment`) REFERENCES `image_comment` (`id_comment`),
  ADD CONSTRAINT `FK_REPORT_COMMENT_id_user` FOREIGN KEY (`id_user`) REFERENCES `utilisateur` (`id_user`);

--
-- Contraintes pour la table `REPORT_EVENT`
--
ALTER TABLE `REPORT_EVENT`
  ADD CONSTRAINT `FK_REPORT_EVENT_id_event` FOREIGN KEY (`id_event`) REFERENCES `evenement` (`id_event`),
  ADD CONSTRAINT `FK_REPORT_EVENT_id_user` FOREIGN KEY (`id_user`) REFERENCES `utilisateur` (`id_user`);

--
-- Contraintes pour la table `REPORT_IMAGE`
--
ALTER TABLE `REPORT_IMAGE`
  ADD CONSTRAINT `FK_REPORT_IMAGE_id_image` FOREIGN KEY (`id_image`) REFERENCES `image_event` (`id_image`),
  ADD CONSTRAINT `FK_REPORT_IMAGE_id_user` FOREIGN KEY (`id_user`) REFERENCES `utilisateur` (`id_user`);

--
-- Contraintes pour la table `REPORT_SUGGESTION`
--
ALTER TABLE `REPORT_SUGGESTION`
  ADD CONSTRAINT `FK_REPORT_SUGGESTION_id_suggestion` FOREIGN KEY (`id_suggestion`) REFERENCES `suggestion_event` (`id_suggestion`),
  ADD CONSTRAINT `FK_REPORT_SUGGESTION_id_user` FOREIGN KEY (`id_user`) REFERENCES `utilisateur` (`id_user`);

--
-- Contraintes pour la table `suggestion_event`
--
ALTER TABLE `suggestion_event`
  ADD CONSTRAINT `FK_suggestion_event_id_user` FOREIGN KEY (`id_user`) REFERENCES `utilisateur` (`id_user`);

--
-- Contraintes pour la table `VOTE`
--
ALTER TABLE `VOTE`
  ADD CONSTRAINT `FK_VOTE_id_suggestion` FOREIGN KEY (`id_suggestion`) REFERENCES `suggestion_event` (`id_suggestion`),
  ADD CONSTRAINT `FK_VOTE_id_user` FOREIGN KEY (`id_user`) REFERENCES `utilisateur` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
