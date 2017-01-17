-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.1.28-rc-community-log


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema iwa_2008_projekt
--

CREATE DATABASE IF NOT EXISTS iwa_2008_kz_projekt DEFAULT CHARACTER SET utf8;
USE iwa_2008_kz_projekt;

create user "iwa_2008";
GRANT DELETE, INSERT, SELECT, UPDATE ON `iwa_2008_kz_projekt`.*
TO 'iwa_2008'@'localhost' IDENTIFIED BY 'FOI';
--
-- Definition of table `vrsta_robe`
--

DROP TABLE IF EXISTS `vrsta_robe`;
CREATE TABLE `vrsta_robe` (
  `vrsta` int(10) unsigned zerofill NOT NULL DEFAULT '0',
  `naziv` varchar(20) NOT NULL,
  PRIMARY KEY (`vrsta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Definition of table `vrsta_korisnika`
--

DROP TABLE IF EXISTS `vrsta_korisnika`;
CREATE TABLE `vrsta_korisnika` (
  `vrsta` int(11) NOT NULL,
  `naziv` varchar(20) NOT NULL,
  PRIMARY KEY (`vrsta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Definition of table `vrsta_statusa`
--

DROP TABLE IF EXISTS `vrsta_statusa`;
CREATE TABLE `vrsta_statusa` (
  `status` float NOT NULL,
  `naziv` varchar(20) NOT NULL,
  PRIMARY KEY (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Definition of table `korisnik`
--

DROP TABLE IF EXISTS `korisnik`;
CREATE TABLE `korisnik` (
  `korisnik` varchar(15) NOT NULL DEFAULT ' ',
  `ime` varchar(15) NOT NULL,
  `prezime` varchar(20) NOT NULL,
  `lozinka` varchar(10) NOT NULL,
  `email` varchar(40) DEFAULT NULL,
  `vrsta` int(11) NOT NULL,
  PRIMARY KEY (`korisnik`) USING BTREE,
  KEY `FK_korisnik_1` (`vrsta`),
  CONSTRAINT `FK_korisnik_1` FOREIGN KEY (`vrsta`) REFERENCES `vrsta_korisnika` (`vrsta`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Definition of table `roba`
--

DROP TABLE IF EXISTS `roba`;
CREATE TABLE `roba` (
  `roba` int(10) unsigned NOT NULL,
  `naziv` varchar(99) NOT NULL,
  `vrsta` int(10) unsigned NOT NULL,
  `opis` varchar(255) DEFAULT NULL,
  `url` varchar(200) DEFAULT NULL,
  `url_foto` varchar(200) DEFAULT NULL,
  `korisnik` varchar(15) NOT NULL,
  `cijena` double unsigned NOT NULL DEFAULT '0',
  `evidentirano` date NOT NULL,
  `jm` varchar(7) NOT NULL,  
  `kolicina` double NOT NULL DEFAULT '0',
  PRIMARY KEY (`roba`),
  KEY `FK_roba_1` (`korisnik`),
  KEY `FK_roba_2` (`vrsta`),
  CONSTRAINT `FK_roba_1` FOREIGN KEY (`korisnik`) REFERENCES `korisnik` (`korisnik`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `FK_roba_2` FOREIGN KEY (`vrsta`) REFERENCES `vrsta_robe` (`vrsta`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Definition of table `narudzbenica`
--

DROP TABLE IF EXISTS `narudzbenica`;
CREATE TABLE `narudzbenica` (
  `narudzbenica` int(10) unsigned NOT NULL DEFAULT '1',
  `korisnik` varchar(15) NOT NULL,
  `naruceno` date NOT NULL,
  `status` float unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`narudzbenica`),
  KEY `FK_narudzbenica_1` (`korisnik`),
  KEY `FK_narudzbenica_2` (`status`),
  CONSTRAINT `FK_narudzbenica_1` FOREIGN KEY (`korisnik`) REFERENCES `korisnik` (`korisnik`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `FK_narudzbenica_2` FOREIGN KEY (`status`) REFERENCES `vrsta_statusa` (`status`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Definition of table `stavka`
--

DROP TABLE IF EXISTS `stavka`;
CREATE TABLE `stavka` (
  `narudzbenica` int(10) unsigned NOT NULL DEFAULT '1',
  `stavka` int(10) unsigned NOT NULL DEFAULT '1',
  `roba` int(10) unsigned NOT NULL,
  `kolicina` double NOT NULL DEFAULT '0',
  PRIMARY KEY (`narudzbenica`,  `stavka`),
  KEY `FK_stavka_1` (`narudzbenica`),
  KEY `FK_stavka_2` (`roba`),
  CONSTRAINT `FK_stavka_1` FOREIGN KEY (`narudzbenica`) REFERENCES `narudzbenica` (`narudzbenica`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `FK_stavka_2` FOREIGN KEY (`roba`) REFERENCES `roba` (`roba`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Definition of table `primka`
--

DROP TABLE IF EXISTS `primka`;
CREATE TABLE `primka` (
  `broj` int(10) unsigned NOT NULL DEFAULT '1',
  `korisnik` varchar(15) NOT NULL,
  `roba` int(10) unsigned NOT NULL,
  `kolicina` double NOT NULL DEFAULT '0',
  `primljeno` date NOT NULL,
  PRIMARY KEY (`broj`),
  KEY `FK_primka_1` (`korisnik`),
  KEY `FK_primka_2` (`roba`),
  CONSTRAINT `FK_primka_1` FOREIGN KEY (`korisnik`) REFERENCES `korisnik` (`korisnik`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `FK_primka_2` FOREIGN KEY (`roba`) REFERENCES `roba` (`roba`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Definition of table `izdatnica`
--

DROP TABLE IF EXISTS `izdatnica`;
CREATE TABLE `izdatnica` (
  `broj` int(10) unsigned NOT NULL DEFAULT '1',
  `narudzbenica` int(10) unsigned NOT NULL DEFAULT '1',
  `stavka` int(10) unsigned NOT NULL DEFAULT '1',
  `roba` int(10) unsigned NOT NULL,
  `kolicina` double NOT NULL DEFAULT '0',
  PRIMARY KEY (`broj`),
  KEY `FK_izdatnica_1` (`narudzbenica`),
  KEY `FK_izdatnica_2` (`roba`),
  CONSTRAINT `FK_izdatnica_1` FOREIGN KEY (`narudzbenica`) REFERENCES `narudzbenica` (`narudzbenica`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `FK_izdatnica_2` FOREIGN KEY (`roba`) REFERENCES `roba` (`roba`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Definition of table `primka`
--


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
