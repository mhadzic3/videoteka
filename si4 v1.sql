CREATE DATABASE  IF NOT EXISTS `si4` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `si4`;
-- MySQL dump 10.13  Distrib 5.7.12, for Win64 (x86_64)
--
-- Host: localhost    Database: si4
-- ------------------------------------------------------
-- Server version	5.6.35-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `anketa`
--

DROP TABLE IF EXISTS `anketa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `anketa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `opis` varchar(45) NOT NULL,
  `vrijeme_aktivacije` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `vrijeme_deaktivacije` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `zaposlenik` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `zaposlenikFK_idx` (`zaposlenik`),
  CONSTRAINT `zaposlenikFK` FOREIGN KEY (`zaposlenik`) REFERENCES `korisnik` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `anketa`
--

LOCK TABLES `anketa` WRITE;
/*!40000 ALTER TABLE `anketa` DISABLE KEYS */;
/*!40000 ALTER TABLE `anketa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kontakt_informacija`
--

DROP TABLE IF EXISTS `kontakt_informacija`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kontakt_informacija` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `opis` varchar(45) NOT NULL,
  `adresa` varchar(45) DEFAULT NULL,
  `telefon` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kontakt_informacija`
--

LOCK TABLES `kontakt_informacija` WRITE;
/*!40000 ALTER TABLE `kontakt_informacija` DISABLE KEYS */;
/*!40000 ALTER TABLE `kontakt_informacija` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `korisnik`
--

DROP TABLE IF EXISTS `korisnik`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `korisnik` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `email` varchar(45) DEFAULT NULL,
  `uloga` int(11) NOT NULL,
  `lokacija` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_UNIQUE` (`username`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  KEY `ulogaFK_idx` (`uloga`),
  KEY `lokacijaFK2_idx` (`lokacija`),
  CONSTRAINT `lokacijaFK2` FOREIGN KEY (`lokacija`) REFERENCES `lokacija` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ulogaFK` FOREIGN KEY (`uloga`) REFERENCES `uloga` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `korisnik`
--

LOCK TABLES `korisnik` WRITE;
/*!40000 ALTER TABLE `korisnik` DISABLE KEYS */;
INSERT INTO `korisnik` VALUES (1,'Administrator','1DvaTri!',NULL,1,NULL),(2,'HumanResources','1DvaTri!',NULL,2,NULL);
/*!40000 ALTER TABLE `korisnik` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lokacija`
--

DROP TABLE IF EXISTS `lokacija`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lokacija` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `naziv_UNIQUE` (`naziv`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lokacija`
--

LOCK TABLES `lokacija` WRITE;
/*!40000 ALTER TABLE `lokacija` DISABLE KEYS */;
/*!40000 ALTER TABLE `lokacija` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `obavijest`
--

DROP TABLE IF EXISTS `obavijest`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `obavijest` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `naslov` varchar(45) NOT NULL,
  `tekst` varchar(255) NOT NULL,
  `vrijeme_objave` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `administrator` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `administratorFK_idx` (`administrator`),
  CONSTRAINT `administratorFK` FOREIGN KEY (`administrator`) REFERENCES `korisnik` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `obavijest`
--

LOCK TABLES `obavijest` WRITE;
/*!40000 ALTER TABLE `obavijest` DISABLE KEYS */;
/*!40000 ALTER TABLE `obavijest` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `obavijest_lokacija`
--

DROP TABLE IF EXISTS `obavijest_lokacija`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `obavijest_lokacija` (
  `obavijest` int(11) NOT NULL,
  `lokacija` int(11) NOT NULL,
  PRIMARY KEY (`obavijest`,`lokacija`),
  KEY `lokacijaFK_idx` (`lokacija`),
  CONSTRAINT `lokacijaFK` FOREIGN KEY (`lokacija`) REFERENCES `lokacija` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `obavijestFK` FOREIGN KEY (`obavijest`) REFERENCES `obavijest` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `obavijest_lokacija`
--

LOCK TABLES `obavijest_lokacija` WRITE;
/*!40000 ALTER TABLE `obavijest_lokacija` DISABLE KEYS */;
/*!40000 ALTER TABLE `obavijest_lokacija` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `odgovor`
--

DROP TABLE IF EXISTS `odgovor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `odgovor` (
  `korisnik` int(11) NOT NULL,
  `pitanje` int(11) NOT NULL,
  `tekst` varchar(255) NOT NULL,
  PRIMARY KEY (`korisnik`,`pitanje`),
  KEY `pitanjeFK_idx` (`pitanje`),
  CONSTRAINT `korisnikFK2` FOREIGN KEY (`korisnik`) REFERENCES `korisnik` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `pitanjeFK` FOREIGN KEY (`pitanje`) REFERENCES `pitanje` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `odgovor`
--

LOCK TABLES `odgovor` WRITE;
/*!40000 ALTER TABLE `odgovor` DISABLE KEYS */;
/*!40000 ALTER TABLE `odgovor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pitanje`
--

DROP TABLE IF EXISTS `pitanje`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pitanje` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tekst` varchar(45) NOT NULL,
  `anketa` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `anketaFK_idx` (`anketa`),
  CONSTRAINT `anketaFK` FOREIGN KEY (`anketa`) REFERENCES `anketa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pitanje`
--

LOCK TABLES `pitanje` WRITE;
/*!40000 ALTER TABLE `pitanje` DISABLE KEYS */;
/*!40000 ALTER TABLE `pitanje` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uloga`
--

DROP TABLE IF EXISTS `uloga`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uloga` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `naziv_UNIQUE` (`naziv`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uloga`
--

LOCK TABLES `uloga` WRITE;
/*!40000 ALTER TABLE `uloga` DISABLE KEYS */;
INSERT INTO `uloga` VALUES (1,'administrator'),(2,'hr'),(3,'prijavljeni_korisnik');
/*!40000 ALTER TABLE `uloga` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zabranjena_rijec`
--

DROP TABLE IF EXISTS `zabranjena_rijec`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zabranjena_rijec` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rijec` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `rijec_UNIQUE` (`rijec`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zabranjena_rijec`
--

LOCK TABLES `zabranjena_rijec` WRITE;
/*!40000 ALTER TABLE `zabranjena_rijec` DISABLE KEYS */;
/*!40000 ALTER TABLE `zabranjena_rijec` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zalba`
--

DROP TABLE IF EXISTS `zalba`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zalba` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tekst` varchar(255) NOT NULL,
  `status` bit(1) NOT NULL,
  `vrijeme_postavljanja` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `korisnik` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `korisnikFK_idx` (`korisnik`),
  CONSTRAINT `korisnikFK` FOREIGN KEY (`korisnik`) REFERENCES `korisnik` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zalba`
--

LOCK TABLES `zalba` WRITE;
/*!40000 ALTER TABLE `zalba` DISABLE KEYS */;
/*!40000 ALTER TABLE `zalba` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-05-08 18:15:41
