SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";
SET NAMES utf8mb4;

CREATE DATABASE IF NOT EXISTS `ceni` DEFAULT CHARACTER SET=utf8mb4;
USE `ceni`;

-- ------------------------------
-- TABLE admin
-- ------------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(255) NOT NULL,
  `prenom` VARCHAR(255) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `admin` VALUES
(2, 'admin', 'said', 'd033e22ae348aeb5660fc2140aec35850c4da997');

-- ------------------------------
-- TABLE arret
-- ------------------------------
DROP TABLE IF EXISTS `arret`;
CREATE TABLE `arret` (
  `id_at` INT NOT NULL AUTO_INCREMENT,
  `portant` VARCHAR(255) NOT NULL,
  `num_at` VARCHAR(255) NOT NULL,
  `dat_at` DATE NOT NULL,
  `file` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `arret` VALUES
(78, 'Formulaire de déclaration de candidature', '15-129/MIIDI/CAB', '2015-12-01', 'annexe 1.pdf'),
(82, 'OK', '22225', '2018-09-01', 'presentation de notre projet.pdf'),
(81, 'Liste définitive des candidats aux élections', '16-002/E/CC', '2016-12-31', 'annexe 2.pdf');

-- ------------------------------
-- TABLE arrete
-- ------------------------------
DROP TABLE IF EXISTS `arrete`;
CREATE TABLE `arrete` (
  `id_art` INT NOT NULL AUTO_INCREMENT,
  `portant` VARCHAR(255) NOT NULL,
  `num_art` VARCHAR(255) NOT NULL,
  `dat_art` DATE NOT NULL,
  `file` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id_art`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `arrete` VALUES
(18, 'Relatif aux membres des CECI de NDZUWANI', '15-187/Gouv/I.A.N', '2018-09-06', 'Rapport du processus électorale 2016.pdf'),
(16, 'Relatif aux membres des CECI de NDZUWANI', '15-187/Gouv/I.A.N', '2015-12-11', 'arrêté ceci.pdf'),
(17, 'Nomination des membres de la CEII de Ngazidja', '15-103/MIIDI/CAB', '2015-09-10', 'arrêté nomination.pdf');

-- ------------------------------
-- TABLE cadr_leg
-- ------------------------------
DROP TABLE IF EXISTS `cadr_leg`;
CREATE TABLE `cadr_leg` (
  `id_cadr` INT NOT NULL AUTO_INCREMENT,
  `type` VARCHAR(255) NOT NULL,
  `file` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id_cadr`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `cadr_leg` VALUES
(4, 'code électoral', 'Loi code electorale 2014.pdf');

-- ------------------------------
-- TABLE candidat
-- ------------------------------
DROP TABLE IF EXISTS `candidat`;
CREATE TABLE `candidat` (
  `id_cand` INT NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(255) NOT NULL,
  `prenom` VARCHAR(255) NOT NULL,
  `dat_nais` DATE NOT NULL,
  `lieu_nais` VARCHAR(255) NOT NULL,
  `resi` VARCHAR(255) NOT NULL,
  `ile` VARCHAR(255) NOT NULL,
  `prof` VARCHAR(255) NOT NULL,
  `fnt_ceni` VARCHAR(255) NOT NULL,
  `tel1` VARCHAR(255) NOT NULL,
  `tel2` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `peri_exe` VARCHAR(255) NOT NULL,
  `img` VARCHAR(255) NOT NULL,
  `aff_p` VARCHAR(255) NOT NULL,
  `pst_cand` VARCHAR(255) NOT NULL,
  `peri_scru` VARCHAR(255) NOT NULL,
  `pst_elu` VARCHAR(255) NOT NULL,
  `peri_md` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id_cand`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `candidat` VALUES
(30, 'Mohamed', 'Daoudou', '1981-01-27', 'Moroni', 'Moroni', 'Ngazidja', 'Ministre', 'Ministre de l''Intérieur', '54464646', '13131313', 'abdouanfani@live.fr', '2014-2020', 'telechargement.jpeg', 'Orange', 'Président', '2015', 'Aucun', '0'),
(31, 'Allaoui', 'Said Hamidou', '1986-01-06', 'Moroni', 'Moroni', 'Ngazidja', 'N/A', 'Aucune', '33333333', '44444444', 'abdouanfani@live.fr', '0', 'telechargement.jpeg', 'Ulezi', 'Président', '2015', 'Aucun', '0'),
(32, 'Salimou', 'Mohamed Amiri', '1980-06-11', 'Moroni', 'Moroni', 'Ngazidja', 'N/A', 'N/A', '33333333', '13131313', 'abdouanfani@live.fr', '2015-2016', 'telechargement.jpeg', 'Aucun', 'Président', '2015', 'Aucun', '0'),
(33, 'Mahamoud', 'Ahmed Wadaane', '1985-05-14', 'Moroni', 'Moroni', 'Ngazidja', 'N/A', 'Aucune', '33333333', '44444444', 'abdouanfani@live.fr', '0', 'telechargement.jpeg', 'RIFAD', 'Président', '2015', 'Aucun', '0'),
(34, 'Mohamed', 'Ali Dia', '1982-12-27', 'Moroni', 'Moroni', 'Ngazidja', 'N/A', 'Aucune', '33333333', '44444444', 'abdouanfani@live.fr', '0', 'telechargement.jpeg', 'Aucun', 'Président', '2015', 'Aucun', '0'),
(35, 'Azali', 'Assoumani', '1992-01-07', 'Mitsoudjé', 'Moroni', 'Ngazidja', 'Président de l''Union des Comores', 'Aucune', '33333333', '13131313', 'abdouanfani@live.fr', '2016-2021', 'telechargement.jpeg', 'CRC', 'Président', '2016', 'Président', '5'),
(36, 'Cheikh Ahmed', 'Said Abdourahmane', '1985-12-30', 'Moroni', 'Moroni', 'Ngazidja', 'N/A', 'Aucune', '3256458', '44444444', 'abdouanfani@live.fr', '0', 'telechargement.jpeg', 'MDC', 'Président', '2015', 'Aucun', '0'),
(37, 'Halid', 'Youssouf', '2018-09-19', 'Inde', 'Moroni', 'Mwali', 'Administrateur', 'Secrétaire Général', '54464646', '13131313', 'abdouanfani@live.fr', '2018-2019', 'telechargement.jpeg', 'Partie Orange', 'Président', '2015', 'Député', '5');

-- ------------------------------
-- TABLE contrat
-- ------------------------------
DROP TABLE IF EXISTS `contrat`;
CREATE TABLE `contrat` (
  `id_cnt` INT NOT NULL AUTO_INCREMENT,
  `type_cont` VARCHAR(255) NOT NULL,
  `title` VARCHAR(255) NOT NULL,
  `memb` VARCHAR(255) NOT NULL,
  `file_cont` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id_cnt`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `contrat` VALUES
(9, 'Contrat personnel', 'Contrat', 'Wahabou', 'Rapport du processus électorale 2016.pdf'),
(11, 'Contrat Général', 'Décision', 'Said', 'presentation de notre projet.pdf'),
(12, 'Contrat de préfecture', 'Contrat de maire', 'Abdou Ali', 'presentation de notre projet.pdf');

-- ------------------------------
-- TABLE decision
-- ------------------------------
DROP TABLE IF EXISTS `decision`;
CREATE TABLE `decision` (
  `id_deci` INT NOT NULL AUTO_INCREMENT,
  `portant` VARCHAR(255),
  `num_deci` VARCHAR(255),
  `dat_deci` VARCHAR(255),
  `file` VARCHAR(255),
  `memb` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id_deci`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `decision` VALUES
(5, 'Les emplacements des bureaux de vote', '14/006/CENI/PR', '2014-12-31', 'decision.pdf', 'Conseillés');

-- ------------------------------
-- TABLE decret
-- ------------------------------
DROP TABLE IF EXISTS `decret`;
CREATE TABLE `decret` (
  `id_dec` INT NOT NULL AUTO_INCREMENT,
  `portant` VARCHAR(255) NOT NULL,
  `num_dec` VARCHAR(255) NOT NULL,
  `dat_dec` DATE NOT NULL,
  `file` VARCHAR(255) NOT NULL,
  `memb` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id_dec`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `decret` VALUES
(7, 'Convocation du corps électoral', '14-150/PR', '2014-09-20', 'decret corps.pdf', 'Président');

-- ------------------------------
-- TABLE evenement
-- ------------------------------
DROP TABLE IF EXISTS `evenement`;
CREATE TABLE `evenement` (
  `id_atl` INT NOT NULL AUTO_INCREMENT,
  `type` VARCHAR(255) NOT NULL,
  `org_eve` VARCHAR(255) NOT NULL,
  `lieu_eve` VARCHAR(255) NOT NULL,
  `dat_eve` VARCHAR(255) NOT NULL,
  `img` VARCHAR(255) NOT NULL,
  `video` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id_atl`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ------------------------------
-- TABLE images
-- ------------------------------
DROP TABLE IF EXISTS `images`;
CREATE TABLE `images` (
  `id_img` INT NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(250) NOT NULL,
  `memb_id` INT NOT NULL,
  `cand_id` INT NOT NULL,
  PRIMARY KEY (`id_img`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `images` VALUES
(1, 'yggghh.jpg', 1, 1);

-- ------------------------------
-- TABLE membre
-- ------------------------------
DROP TABLE IF EXISTS `membre`;
CREATE TABLE `membre` (
  `id_memb` INT NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(255) NOT NULL,
  `prenom` VARCHAR(255) NOT NULL,
  `dat_nais` DATE NOT NULL,
  `lieu_nais` VARCHAR(255) NOT NULL,
  `resi` VARCHAR(255) NOT NULL,
  `ile` VARCHAR(255) NOT NULL,
  `prof` VARCHAR(255) NOT NULL,
  `fnt_ceni` VARCHAR(255) NOT NULL,
  `tel1` VARCHAR(255) NOT NULL,
  `tel2` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `peri_exe` VARCHAR(255) NOT NULL,
  `img` VARCHAR(255) NOT NULL,
  `lieu_exe` VARCHAR(255) NOT NULL,
  `descri` TEXT NOT NULL,
  PRIMARY KEY (`id_memb`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `membre` VALUES
(40, 'Latuf', 'Abdou', '1980-12-30', 'Moroni', 'Moroni', 'Ngazidja', 'Commissaire en charge des relations avec les politiques', 'Commissaire en charge des relations avec les politiques', '33333333', '44444444', 'abdouanfani@live.fr', '2013-2016', 'LOGO_CENI.jpg', '2013-2016', 'Commissaire en charge des relations avec les politiques'),
(39, 'Moinaecha', 'Mroudjae', '1975-03-05', 'Moroni', 'Moroni', 'Ngazidja', 'Commissaire en charge du matériel et de la logistique', 'Commissaire en charge du matériel et de la logistique', '33333333', '44444444', 'abdouanfani@live.fr', '2013-2016', 'LOGO_CENI.jpg', '2013-2016', 'Commissaire en charge du matériel et de la logistique');

COMMIT;
