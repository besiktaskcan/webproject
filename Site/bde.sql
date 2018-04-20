-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  ven. 20 avr. 2018 à 13:33
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
-- Base de données :  `bde`
--

DELIMITER $$
--
-- Procédures
--
DROP PROCEDURE IF EXISTS `AddGoodie`$$
CREATE DEFINER=`u143739db1`@`%` PROCEDURE `AddGoodie` (IN `in_name` TEXT, IN `in_desc` TEXT, IN `in_prix` FLOAT, IN `in_categorie` TEXT)  MODIFIES SQL DATA
    DETERMINISTIC
    COMMENT 'Créer un goodie'
INSERT INTO goodie(id_goodie, name, description, prix_goodie, categorie)
VALUES(NULL, in_name, in_desc, in_prix, in_categorie)$$

DROP PROCEDURE IF EXISTS `AddImgCommentEventByID`$$
CREATE DEFINER=`u143739db1`@`%` PROCEDURE `AddImgCommentEventByID` (IN `img_id` INT, IN `in_comment` TEXT, IN `usr_id` INT)  MODIFIES SQL DATA
    DETERMINISTIC
    COMMENT 'Ajoute un commentaire à une image par son id'
INSERT INTO image_comment(id_comment, comment_text, id_user, id_image) VALUES (NULL, in_comment, usr_id, img_id)$$

DROP PROCEDURE IF EXISTS `AddImgEventByID`$$
CREATE DEFINER=`u143739db1`@`%` PROCEDURE `AddImgEventByID` (IN `event_id` INT, IN `in_img` TEXT)  MODIFIES SQL DATA
    DETERMINISTIC
    COMMENT 'Ajoute une image dans un event avec l''ID'
INSERT INTO image_event(id_image,image,id_event)
VALUES (NULL,in_img,event_id)$$

DROP PROCEDURE IF EXISTS `CreateEvent`$$
CREATE DEFINER=`u143739db1`@`%` PROCEDURE `CreateEvent` (IN `in_name` TEXT, IN `in_status` INT, IN `in_desc` TEXT, IN `in_date` TIMESTAMP, IN `in_recc` TEXT, IN `in_prix` FLOAT)  MODIFIES SQL DATA
    DETERMINISTIC
    COMMENT 'Créer un événement'
INSERT INTO evenement VALUES (NULL, in_name, in_status, in_desc, in_date, in_recc, in_prix)$$

DROP PROCEDURE IF EXISTS `GetEventInfosByID`$$
CREATE DEFINER=`u143739db1`@`%` PROCEDURE `GetEventInfosByID` (IN `event_id` INT, OUT `eventInfos` JSON)  READS SQL DATA
    DETERMINISTIC
    COMMENT 'Donne les infos event a partir de son id'
SELECT * FROM evenement
WHERE id_event=event_id$$

DROP PROCEDURE IF EXISTS `GetGoodieInfosByID`$$
CREATE DEFINER=`u143739db1`@`%` PROCEDURE `GetGoodieInfosByID` (IN `goodie_id` INT)  READS SQL DATA
    DETERMINISTIC
    COMMENT 'donne les info d''un goodie a partir de son id'
SELECT * FROM goodie
WHERE id_goodie=goodie_id$$

DROP PROCEDURE IF EXISTS `GetImgCommentsByID`$$
CREATE DEFINER=`u143739db1`@`%` PROCEDURE `GetImgCommentsByID` (IN `img_id` INT)  READS SQL DATA
    DETERMINISTIC
    COMMENT 'Retournes tous les commentaires complets via l''id de l''image'
SELECT * FROM image_comment
WHERE id_image=img_id$$

DROP PROCEDURE IF EXISTS `GetImgEventByID`$$
CREATE DEFINER=`u143739db1`@`%` PROCEDURE `GetImgEventByID` (IN `event_id` INT)  READS SQL DATA
    DETERMINISTIC
    COMMENT 'Donne toutes les images d''un event à partir de son ID'
SELECT image FROM image_event
WHERE id_event=event_id$$

DROP PROCEDURE IF EXISTS `GetImgLikesByID`$$
CREATE DEFINER=`u143739db1`@`%` PROCEDURE `GetImgLikesByID` (IN `img_id` INT)  READS SQL DATA
    DETERMINISTIC
    COMMENT 'Retourne les likes d''une image via l''ID de cette dernière'
SELECT * FROM AIME
WHERE id_image=img_id$$

DROP PROCEDURE IF EXISTS `GetImgLikesTotalByID`$$
CREATE DEFINER=`u143739db1`@`%` PROCEDURE `GetImgLikesTotalByID` (IN `img_id` INT)  READS SQL DATA
    DETERMINISTIC
    COMMENT 'Compte le nombre de like d''une image'
SELECT COUNT(id_image) FROM AIME
WHERE id_image=img_id$$

DROP PROCEDURE IF EXISTS `GetImgMostLikesByID`$$
CREATE DEFINER=`u143739db1`@`%` PROCEDURE `GetImgMostLikesByID` (IN `nb` INT)  READS SQL DATA
    DETERMINISTIC
    COMMENT 'Donne les x images les plus likés'
SELECT COUNT(id_user), id_image FROM AIME
GROUP BY id_image
ORDER BY COUNT(id_user) DESC
LIMIT nb$$

DROP PROCEDURE IF EXISTS `GetSuggVotesByID`$$
CREATE DEFINER=`u143739db1`@`%` PROCEDURE `GetSuggVotesByID` (IN `sugg_id` INT)  READS SQL DATA
    DETERMINISTIC
    COMMENT 'Donne tout les votes complets d''une suggestion via son id'
SELECT * FROM VOTE
WHERE id_suggestion=sugg_id$$

DROP PROCEDURE IF EXISTS `GetSuggVotesTotalByID`$$
CREATE DEFINER=`u143739db1`@`%` PROCEDURE `GetSuggVotesTotalByID` (IN `sugg_id` INT)  READS SQL DATA
    DETERMINISTIC
SELECT COUNT(id_suggestion) FROM VOTE
WHERE id_suggestion=sugg_id$$

DROP PROCEDURE IF EXISTS `GetUserInfosByID`$$
CREATE DEFINER=`u143739db1`@`%` PROCEDURE `GetUserInfosByID` (IN `input_id` INT)  READS SQL DATA
    DETERMINISTIC
    COMMENT 'Get an user infos from the ID'
SELECT id_user, name, firstname, mail, role FROM utilisateur
WHERE id_user=input_id$$

DROP PROCEDURE IF EXISTS `GetUserRoleByID`$$
CREATE DEFINER=`u143739db1`@`%` PROCEDURE `GetUserRoleByID` (IN `usr_id` INT)  READS SQL DATA
    DETERMINISTIC
    COMMENT 'permet de lire le rôle d''un utilisateur à partir de son idée'
SELECT id_user, role FROM utilisateur
WHERE id_user=usr_id$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `aime`
--

DROP TABLE IF EXISTS `aime`;
CREATE TABLE IF NOT EXISTS `aime` (
  `id_user` int(11) NOT NULL,
  `id_image` int(11) NOT NULL,
  PRIMARY KEY (`id_user`,`id_image`),
  KEY `FK_AIME_id_image` (`id_image`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `aime`
--

INSERT INTO `aime` (`id_user`, `id_image`) VALUES
(11, 12),
(11, 13),
(12, 15),
(11, 20),
(11, 21);

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

DROP TABLE IF EXISTS `commande`;
CREATE TABLE IF NOT EXISTS `commande` (
  `id_commande` int(11) NOT NULL AUTO_INCREMENT,
  `date_commande` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id_commande`),
  KEY `FK_commande_id_user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id_commande`, `date_commande`, `id_user`) VALUES
(1, '2018-04-10 12:50:12', 7);

-- --------------------------------------------------------

--
-- Structure de la table `contient`
--

DROP TABLE IF EXISTS `contient`;
CREATE TABLE IF NOT EXISTS `contient` (
  `quantite` int(11) NOT NULL,
  `id_commande` int(11) NOT NULL,
  `id_goodie` int(11) NOT NULL,
  PRIMARY KEY (`id_commande`,`id_goodie`),
  KEY `FK_CONTIENT_id_goodie` (`id_goodie`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `contient`
--

INSERT INTO `contient` (`quantite`, `id_commande`, `id_goodie`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `evenement`
--

DROP TABLE IF EXISTS `evenement`;
CREATE TABLE IF NOT EXISTS `evenement` (
  `id_event` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `description` text,
  `date_event` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `recurrence` varchar(8) NOT NULL DEFAULT '0',
  `prix_event` float NOT NULL DEFAULT '0',
  `id_user` int(11) NOT NULL,
  `background_img_event` text NOT NULL,
  PRIMARY KEY (`id_event`),
  KEY `FK_evenement_id_user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `evenement`
--

INSERT INTO `evenement` (`id_event`, `name`, `status`, `description`, `date_event`, `recurrence`, `prix_event`, `id_user`, `background_img_event`) VALUES
(1, 'Blocus devant le Patio', 0, 'La dernière assemblée générale du mois d\'avril', '2018-04-17 08:48:45', '0', 0, 8, '/images/image1.jpg'),
(2, 'Lan #26', 0, 'Venez à la prochaine LAN', '2018-04-17 08:48:45', '0', 0, 6, '/images/image2.jpg'),
(6, 'Jeudi Après-Midi Europa PARK !', 0, 'Le BDE souhaitant vous proposer une nouvelle expérience, nous vous proposons un jeudi après-midi à Europa Park afin de renforcer les liens inter-promo.', '2018-04-25 22:00:00', '0', 50, 11, 'eventimages/14081524212745.jpg'),
(7, '?', 0, '?', '2018-04-20 22:00:00', '0', 50, 11, 'eventimages/91121524230670.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `goodie`
--

DROP TABLE IF EXISTS `goodie`;
CREATE TABLE IF NOT EXISTS `goodie` (
  `id_goodie` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `description` text,
  `prix_goodie` float NOT NULL,
  `categorie` text NOT NULL,
  PRIMARY KEY (`id_goodie`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

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

DROP TABLE IF EXISTS `image_comment`;
CREATE TABLE IF NOT EXISTS `image_comment` (
  `id_comment` int(11) NOT NULL AUTO_INCREMENT,
  `comment_text` text NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_image` int(11) NOT NULL,
  PRIMARY KEY (`id_comment`),
  KEY `FK_image_comment_id_user` (`id_user`),
  KEY `FK_image_comment_id_image` (`id_image`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `image_event`
--

DROP TABLE IF EXISTS `image_event`;
CREATE TABLE IF NOT EXISTS `image_event` (
  `id_image` int(11) NOT NULL AUTO_INCREMENT,
  `image` text NOT NULL,
  `id_event` int(11) NOT NULL,
  PRIMARY KEY (`id_image`),
  KEY `FK_image_event_id_event` (`id_event`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `image_event`
--

INSERT INTO `image_event` (`id_image`, `image`, `id_event`) VALUES
(12, 'eventimages/120301524141202.jpg', 1),
(13, 'eventimages/114331524142345.jpg', 2),
(14, 'eventimages/57271524142426.jpg', 2),
(15, 'eventimages/104121524143138.jpg', 1),
(16, 'eventimages/264061524143146.jpg', 1),
(17, 'eventimages/128461524143156.jpg', 1),
(18, 'eventimages/211141524143161.jpg', 1),
(19, 'eventimages/209951524148493.jpg', 1),
(20, 'eventimages/147151524223704.jpg', 6),
(21, 'eventimages/321891524223738.jpg', 6),
(22, 'eventimages/19771524228475.jpg', 6);

-- --------------------------------------------------------

--
-- Structure de la table `image_goodie`
--

DROP TABLE IF EXISTS `image_goodie`;
CREATE TABLE IF NOT EXISTS `image_goodie` (
  `id_img_goodie` int(11) NOT NULL AUTO_INCREMENT,
  `image` text NOT NULL,
  PRIMARY KEY (`id_img_goodie`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `image_goodie`
--

INSERT INTO `image_goodie` (`id_img_goodie`, `image`) VALUES
(1, '/img/goodie1.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `participe`
--

DROP TABLE IF EXISTS `participe`;
CREATE TABLE IF NOT EXISTS `participe` (
  `id_user` int(11) NOT NULL,
  `id_event` int(11) NOT NULL,
  PRIMARY KEY (`id_user`,`id_event`),
  KEY `FK_PARTICIPE_id_event` (`id_event`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `participe`
--

INSERT INTO `participe` (`id_user`, `id_event`) VALUES
(12, 1),
(12, 2);

-- --------------------------------------------------------

--
-- Structure de la table `possede_img_goodies`
--

DROP TABLE IF EXISTS `possede_img_goodies`;
CREATE TABLE IF NOT EXISTS `possede_img_goodies` (
  `id_goodie` int(11) NOT NULL,
  `id_img_goodie` int(11) NOT NULL,
  PRIMARY KEY (`id_goodie`,`id_img_goodie`),
  KEY `FK_POSSEDE_IMG_GOODIES_id_img_goodie` (`id_img_goodie`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `poste`
--

DROP TABLE IF EXISTS `poste`;
CREATE TABLE IF NOT EXISTS `poste` (
  `id_user` int(11) NOT NULL,
  `id_image` int(11) NOT NULL,
  PRIMARY KEY (`id_user`,`id_image`),
  KEY `FK_POSTE_id_image` (`id_image`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `report_comment`
--

DROP TABLE IF EXISTS `report_comment`;
CREATE TABLE IF NOT EXISTS `report_comment` (
  `id_comment` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id_comment`,`id_user`),
  KEY `FK_REPORT_COMMENT_id_user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `report_event`
--

DROP TABLE IF EXISTS `report_event`;
CREATE TABLE IF NOT EXISTS `report_event` (
  `id_event` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id_event`,`id_user`),
  KEY `FK_REPORT_EVENT_id_user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `report_image`
--

DROP TABLE IF EXISTS `report_image`;
CREATE TABLE IF NOT EXISTS `report_image` (
  `id_image` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id_image`,`id_user`),
  KEY `FK_REPORT_IMAGE_id_user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `report_suggestion`
--

DROP TABLE IF EXISTS `report_suggestion`;
CREATE TABLE IF NOT EXISTS `report_suggestion` (
  `id_suggestion` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id_suggestion`,`id_user`),
  KEY `FK_REPORT_SUGGESTION_id_user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `suggestion_event`
--

DROP TABLE IF EXISTS `suggestion_event`;
CREATE TABLE IF NOT EXISTS `suggestion_event` (
  `id_suggestion` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `date_suggestion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id_suggestion`),
  KEY `FK_suggestion_event_id_user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `suggestion_event`
--

INSERT INTO `suggestion_event` (`id_suggestion`, `name`, `description`, `date_suggestion`, `id_user`) VALUES
(3, '?', '?', '2018-04-18 18:54:31', 1),
(4, 'Jeudi Après-Midi Europa PARK !', 'Le BDE souhaitant vous proposer une nouvelle expérience, nous vous proposons un jeudi après-midi à Europa Park afin de renforcer les liens inter-promo.', '2018-04-18 18:56:06', 11);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `firstname` text NOT NULL,
  `mail` text NOT NULL,
  `password` text NOT NULL,
  `role` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

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
(10, 'Gilbert', 'Kuntz', 'gilbert.kuntz@viacesi.fr', 'Zero0pique1', 1),
(11, 'PFEIFER', 'Florian', 'xflorianpf@gmail.com', 'c499eec73d18319f4066758e1daf8c84a64e52f7', 2),
(12, 'Leclercq', 'Lise', 'lise.leclercq.l@gmail.com', 'e87623a95f80d3c90464b6a0cbe1fedfd2e46938', 1),
(13, 'Test', 'test', 'test.test@test.test', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 1),
(14, 'Sandel', 'Olivier', 'Sandel.Olivier@viacesi.fr', 'c499eec73d18319f4066758e1daf8c84a64e52f7', 2);

-- --------------------------------------------------------

--
-- Structure de la table `vote`
--

DROP TABLE IF EXISTS `vote`;
CREATE TABLE IF NOT EXISTS `vote` (
  `id_user` int(11) NOT NULL,
  `id_suggestion` int(11) NOT NULL,
  PRIMARY KEY (`id_user`,`id_suggestion`),
  KEY `FK_VOTE_id_suggestion` (`id_suggestion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `aime`
--
ALTER TABLE `aime`
  ADD CONSTRAINT `FK_AIME_id_image` FOREIGN KEY (`id_image`) REFERENCES `image_event` (`id_image`),
  ADD CONSTRAINT `FK_AIME_id_user` FOREIGN KEY (`id_user`) REFERENCES `utilisateur` (`id_user`);

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `FK_commande_id_user` FOREIGN KEY (`id_user`) REFERENCES `utilisateur` (`id_user`);

--
-- Contraintes pour la table `contient`
--
ALTER TABLE `contient`
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
-- Contraintes pour la table `participe`
--
ALTER TABLE `participe`
  ADD CONSTRAINT `FK_PARTICIPE_id_event` FOREIGN KEY (`id_event`) REFERENCES `evenement` (`id_event`),
  ADD CONSTRAINT `FK_PARTICIPE_id_user` FOREIGN KEY (`id_user`) REFERENCES `utilisateur` (`id_user`);

--
-- Contraintes pour la table `possede_img_goodies`
--
ALTER TABLE `possede_img_goodies`
  ADD CONSTRAINT `FK_POSSEDE_IMG_GOODIES_id_goodie` FOREIGN KEY (`id_goodie`) REFERENCES `goodie` (`id_goodie`),
  ADD CONSTRAINT `FK_POSSEDE_IMG_GOODIES_id_img_goodie` FOREIGN KEY (`id_img_goodie`) REFERENCES `image_goodie` (`id_img_goodie`);

--
-- Contraintes pour la table `poste`
--
ALTER TABLE `poste`
  ADD CONSTRAINT `FK_POSTE_id_image` FOREIGN KEY (`id_image`) REFERENCES `image_event` (`id_image`),
  ADD CONSTRAINT `FK_POSTE_id_user` FOREIGN KEY (`id_user`) REFERENCES `utilisateur` (`id_user`);

--
-- Contraintes pour la table `report_comment`
--
ALTER TABLE `report_comment`
  ADD CONSTRAINT `FK_REPORT_COMMENT_id_comment` FOREIGN KEY (`id_comment`) REFERENCES `image_comment` (`id_comment`),
  ADD CONSTRAINT `FK_REPORT_COMMENT_id_user` FOREIGN KEY (`id_user`) REFERENCES `utilisateur` (`id_user`);

--
-- Contraintes pour la table `report_event`
--
ALTER TABLE `report_event`
  ADD CONSTRAINT `FK_REPORT_EVENT_id_event` FOREIGN KEY (`id_event`) REFERENCES `evenement` (`id_event`),
  ADD CONSTRAINT `FK_REPORT_EVENT_id_user` FOREIGN KEY (`id_user`) REFERENCES `utilisateur` (`id_user`);

--
-- Contraintes pour la table `report_image`
--
ALTER TABLE `report_image`
  ADD CONSTRAINT `FK_REPORT_IMAGE_id_image` FOREIGN KEY (`id_image`) REFERENCES `image_event` (`id_image`),
  ADD CONSTRAINT `FK_REPORT_IMAGE_id_user` FOREIGN KEY (`id_user`) REFERENCES `utilisateur` (`id_user`);

--
-- Contraintes pour la table `report_suggestion`
--
ALTER TABLE `report_suggestion`
  ADD CONSTRAINT `FK_REPORT_SUGGESTION_id_suggestion` FOREIGN KEY (`id_suggestion`) REFERENCES `suggestion_event` (`id_suggestion`),
  ADD CONSTRAINT `FK_REPORT_SUGGESTION_id_user` FOREIGN KEY (`id_user`) REFERENCES `utilisateur` (`id_user`);

--
-- Contraintes pour la table `suggestion_event`
--
ALTER TABLE `suggestion_event`
  ADD CONSTRAINT `FK_suggestion_event_id_user` FOREIGN KEY (`id_user`) REFERENCES `utilisateur` (`id_user`);

--
-- Contraintes pour la table `vote`
--
ALTER TABLE `vote`
  ADD CONSTRAINT `FK_VOTE_id_suggestion` FOREIGN KEY (`id_suggestion`) REFERENCES `suggestion_event` (`id_suggestion`),
  ADD CONSTRAINT `FK_VOTE_id_user` FOREIGN KEY (`id_user`) REFERENCES `utilisateur` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
