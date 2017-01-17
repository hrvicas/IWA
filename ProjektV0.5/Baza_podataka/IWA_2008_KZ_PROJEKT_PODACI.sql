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
--  Use schema iwa_2008_projekt
--

USE iwa_2008_kz_projekt;

--
-- Dumping data for table `vrsta_gradje`
--

#insert vrsta robe
/*!40000 ALTER TABLE `vrsta_robe` DISABLE KEYS */;
INSERT INTO `vrsta_robe` (`vrsta`,`naziv`) VALUES 
 (0000000001,'Knjiga'),
 (0000000002,'Rječnik'),
 (0000000003,'Enciklopedija'),
 (0000000004,'DVD'),
 (0000000005,'CD-ROM'),
 (0000000006,'Ostalo');
/*!40000 ALTER TABLE `vrsta_robe` ENABLE KEYS */;

#insert vrsta korisnika
/*!40000 ALTER TABLE `vrsta_korisnika` DISABLE KEYS */;
INSERT INTO `vrsta_korisnika` (`vrsta`,`naziv`) VALUES 
 (0,'Admnistrator'),
 (1,'Korisnik');
/*!40000 ALTER TABLE `vrsta_korisnika` ENABLE KEYS */;


#insert korisnik
/*!40000 ALTER TABLE `korisnik` DISABLE KEYS */;
INSERT INTO `korisnik` (`korisnik`,`ime`,`prezime`,`lozinka`,`email`,`vrsta`) VALUES 
 ('admin','Pero','Kos','foi','admin@foi.hr',0),
 ('george','George','Harrison','123456','george@foi.hr',1),
 ('janica','Janica','Kostelic','123456','janica@foi.hr',1),
 ('janis','Janis','Joplin','123456','janis@foi.hr',1),
 ('jdean','James','Dean','123456','jdean@foi.hr',1),
 ('jlo','Jennifer','Lopez','123456','jlo@foi.hr',1),
 ('john','John','Lennon','123456','john@foi.hr',1),
 ('paul','Paul','McCartney','123456','paul@foi.hr',1),
 ('pgreen','Peter','Green','123456','pgreen@foi.hr',1),
 ('ringo','Ringo','Star','123456','ringo@foi.hr',1),
 ('tjones','Tom','Jones','123456','tjones@foi.hr',1);
/*!40000 ALTER TABLE `korisnik` ENABLE KEYS */;

#insert roba
/*!40000 ALTER TABLE `roba` DISABLE KEYS */;
INSERT INTO `roba` (`roba`,`naziv`,`vrsta`,`opis`,`url`,`url_foto`,`korisnik`,`cijena`,`evidentirano`,`jm`,`kolicina`) VALUES 
 (1,'REPUBLIKANCI','0000000001',1,'http://www.skolska.com.hr/hrv/page.asp?item=060682&act=more','http://www.skolska.com.hr/images_artikli/060682.jpg','admin', '150','2009-01-01','kom','200'),
 (2,'KĆI LOTRŠĆAKA','0000000002',1,'http://www.skolska.com.hr/hrv/page.asp?item=060237&act=more','http://www.skolska.com.hr/images_artikli/060237.jpg','ringo', '1150','2009-01-02','kom','2000'),
 (3,'KIKLOP','0000000003',1,'http://www.skolska.com.hr/hrv/page.asp?cID=beletristika&item=060721&act=more','http://www.skolska.com.hr/images_artikli/060721.jpg','admin', '150','2009-01-03','kom','200'),
 (4,'FAUST','0000000004',1,'http://www.skolska.com.hr/hrv/page.asp?item=061729&act=more','http://www.skolska.com.hr/images_artikli/061729.jpg','admin', '150','2009-01-04','kom','200'),
 (5,'MIROTVORCI','0000000005',1,'http://www.skolska.com.hr/hrv/page.asp?item=061720&act=more','http://www.skolska.com.hr/images_artikli/061720.jpg','admin', '150','2009-01-05','kom','200'),
 (6,'JUNO','0000000006',1,'http://www.skolska.com.hr/hrv/page.asp?item=040935&act=more','http://www.skolska.com.hr/images_artikli/040935.jpg','admin', '150','2009-01-06','kom','200'),
 (7,'MUMIJA','0000000001',1,'http://www.skolska.com.hr/hrv/page.asp?item=040223&act=more','http://www.skolska.com.hr/images_artikli/040223.jpg','admin', '150','2009-01-07','kom','200'),
 (8,'ELEANORE: ZIVOT PRVE DAME','0000000002',1,'http://www.skolska.com.hr/hrv/page.asp?item=061120&act=more','http://www.skolska.com.hr/images_artikli/061120.jpg','admin', '150','2009-01-08','kom','200'),
 (9,'ZIZEK ON ZIZEK','0000000003',1,'http://www.skolska.com.hr/hrv/page.asp?item=061112&act=more','http://www.skolska.com.hr/images_artikli/061112.jpg','admin', '150','2009-01-09','kom','200'),
 (10,'KANT: FILOZOFIJA MISLI','0000000004',1,'http://www.profil.hr/index.php?cmd=show_proizvod&proizvod_id=24808','http://www.profil.hr/fw3k/util_scripts/get_slika_varijacija.php?slika_id=33558&var_suff=w200','admin', '150','2009-01-10','kom','200'),
 (11,'DIKSRETNA GEOMETRIJA','0000000005',1,'http://www.profil.hr/index.php?cmd=show_proizvod&proizvod_id=8444','http://www.profil.hr/fw3k/util_scripts/get_slika_varijacija.php?slika_id=746&var_suff=w200','admin', '150','2009-01-11','kom','200');
 /*!40000 ALTER TABLE `roba` ENABLE KEYS */;
 
 #insert narudzba
 /*!40000 ALTER TABLE `narudzbenica` DISABLE KEYS */;
 insert into `narudzbenica` (`narudzbenica`,`korisnik`,`naruceno`,`status`) VALUES 
 ('0','ringo','2009-01-01','0'),
 ('1','admin','2009-02-01','2'),
 ('2','jlo','2009-03-11','1'),
 ('3','john','2009-01-23','0'),
 ('4','pgreen','2009-01-28','1'),
 ('5','tjones','2009-01-27','2'),
 ('6','jdean','2009-06-11','0'),
 ('7','janis','2009-01-21','1');
/*!40000 ALTER TABLE `narudzbenica` ENABLE KEYS */;

#insert stavka
/*!40000 ALTER TABLE `stavka` DISABLE KEYS */;
insert into `stavka` (`narudzbenica`,`stavka`,`roba`,`kolicina`) values 
('0','0','1','234'),
('5','1','2','22'),
('1','2','3','11'),
('2','3','4','110'),
('3','4','5','786'),
('4','5','6','754');
/*!40000 ALTER TABLE `stavka` ENABLE KEYS */;


#insert isporuke
/*!40000 ALTER TABLE `izdatnica` DISABLE KEYS */;
insert into `izdatnica` (`broj`,`narudzbenica`,`stavka`,`roba`,`kolicina`) values
(1,'0','0','1','23'),
(2,'5','1','2','2'),
(3,'1','2','3','1'),
(4,'2','3','4','10'),
(5,'3','4','5','86'),
(6,'4','5','6','54');
/*!40000 ALTER TABLE `izdatnica` DISABLE KEYS */;

#insert primka
/*!40000 ALTER TABLE `primka` DISABLE KEYS */;
insert into `primka` (`broj`,`korisnik`,`roba`,`kolicina`,`primljeno`) values
(0,'admin','1','458','2009-01-11'),
(2,'admin','1','458','2009-01-11'),
(3,'ringo','5','358','2009-01-21'),
(4,'jlo','6','258','2009-01-31'),
(5,'admin','3','758','2009-02-11'),
(6,'admin','8','858','2009-03-11'),
(7,'admin','11','558','2009-04-11'),
(8,'admin','10','58','2009-01-16'),
(9,'admin','7','58','2009-01-30'),
(10,'admin','3','358','2009-02-21'),
(11,'admin','4','4588','2009-03-01');
/*!40000 ALTER TABLE `primka` DISABLE KEYS */;

#insert vrste_statusa
/*!40000 ALTER TABLE `vrsta_statusa` DISABLE KEYS */;
insert into `vrsta_statusa` (`status`,`naziv`) values
(0,'Otvoreno'),
(1,'Nerealizirano'),
(2,'Zatvoreno');
/*!40000 ALTER TABLE `vrsta_statusa` DISABLE KEYS *

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
