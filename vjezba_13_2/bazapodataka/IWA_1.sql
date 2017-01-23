CREATE DATABASE vzr_iwa2004_01;

USE vzr_iwa2004_01;

GRANT DELETE, INSERT, SELECT, UPDATE
  ON `vzr_iwa2004_01`.*
  TO 'IWA2004'@'localhost' IDENTIFIED BY 'FOI';
COMMIT;

CREATE TABLE `grupe` (
  `GID` int(11) NOT NULL auto_increment,
  `Grupa` char(30) NOT NULL default '',
  `Naziv` char(30) NOT NULL default '',
  `Vrsta` smallint(6) NOT NULL default '1',
  PRIMARY KEY  (`GID`),
  UNIQUE KEY `Grupa` (`Grupa`)
) ENGINE=InnoDB DEFAULT CHARSET=latin2;

CREATE TABLE `osobe` (
  `KID` int(11) NOT NULL auto_increment,
  `korisnik` char(20) NOT NULL default '',
  `ime` char(20) NOT NULL default '',
  `prezime` char(20) NOT NULL default '',
  `lozinka` char(20) NOT NULL default '',
  `email` char(40) NOT NULL default '',
  `GID` int(11) NOT NULL default '1',
  `prog_jezik` int(11) NOT NULL default '0',
  `prog_godina` int(11) NOT NULL default '0',
  `pj1` int(11) NOT NULL default '0',
  `pj2` int(11) NOT NULL default '0',
  `pj3` int(11) NOT NULL default '0',
  `pj4` int(3) default '0',
  `pj5` int(4) default '0',
  `pj6` int(4) default '0',
  `pj7` int(11) default '0',
  `pj8` int(11) default '0',
  `pj9` tinyint(4) default '0',
  `pj10` tinyint(4) default '0',
  `datumUpisa` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`KID`),
  UNIQUE KEY `korisnik` (`korisnik`),
  KEY `OSOBE_FKEY_1` (`GID`),
  CONSTRAINT `OSOBE_FKEY_1` FOREIGN KEY (`GID`) REFERENCES `grupe` (`GID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin2;
