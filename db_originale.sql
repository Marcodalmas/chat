-- MariaDB dump 10.17  Distrib 10.4.6-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: whatschat
-- ------------------------------------------------------
-- Server version	10.4.6-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `amicizie`
--

DROP TABLE IF EXISTS `amicizie`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `amicizie` (
  `uid_da` int(11) NOT NULL,
  `uid_a` int(11) NOT NULL,
  `data_inizio` datetime NOT NULL,
  `sospensione` char(1) NOT NULL DEFAULT 'N',
  PRIMARY KEY (`uid_da`,`uid_a`),
  KEY `uid_a` (`uid_a`),
  CONSTRAINT `amicizie_ibfk_1` FOREIGN KEY (`uid_da`) REFERENCES `utenti` (`uid`),
  CONSTRAINT `amicizie_ibfk_2` FOREIGN KEY (`uid_a`) REFERENCES `utenti` (`uid`),
  CONSTRAINT `CONSTRAINT_1` CHECK (`sospensione` in ('N','Y'))
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `amicizie`
--

LOCK TABLES `amicizie` WRITE;
/*!40000 ALTER TABLE `amicizie` DISABLE KEYS */;
/*!40000 ALTER TABLE `amicizie` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messaggi`
--

DROP TABLE IF EXISTS `messaggi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messaggi` (
  `mid` int(11) NOT NULL AUTO_INCREMENT,
  `testo` varchar(5000) NOT NULL,
  `e_uid` int(11) NOT NULL,
  `e_quando` datetime NOT NULL,
  `r_uid` int(11) NOT NULL,
  `r_quando` datetime DEFAULT NULL,
  PRIMARY KEY (`mid`),
  KEY `e_uid` (`e_uid`),
  KEY `r_uid` (`r_uid`),
  CONSTRAINT `messaggi_ibfk_1` FOREIGN KEY (`e_uid`) REFERENCES `utenti` (`uid`),
  CONSTRAINT `messaggi_ibfk_2` FOREIGN KEY (`r_uid`) REFERENCES `utenti` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messaggi`
--

LOCK TABLES `messaggi` WRITE;
/*!40000 ALTER TABLE `messaggi` DISABLE KEYS */;
/*!40000 ALTER TABLE `messaggi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `utenti`
--

DROP TABLE IF EXISTS `utenti`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `utenti` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(30) NOT NULL,
  `nickname` varchar(30) NOT NULL,
  `password_hash` varchar(30) NOT NULL,
  `frasetta` varchar(255) DEFAULT NULL,
  `foto` blob DEFAULT NULL,
  PRIMARY KEY (`uid`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `utenti`
--

LOCK TABLES `utenti` WRITE;
/*!40000 ALTER TABLE `utenti` DISABLE KEYS */;
/*!40000 ALTER TABLE `utenti` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-01-31 22:37:01
