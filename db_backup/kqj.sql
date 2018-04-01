-- MySQL dump 10.13  Distrib 5.7.18, for Linux (x86_64)
--
-- Host: localhost    Database: kqj
-- ------------------------------------------------------
-- Server version	5.7.18-1

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
-- Table structure for table `kqj_clock_in`
--

DROP TABLE IF EXISTS `kqj_clock_in`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kqj_clock_in` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `stu_id` varchar(20) NOT NULL,
  `time` datetime DEFAULT NULL,
  `style` varchar(10) NOT NULL,
  `pic` mediumblob,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kqj_clock_in`
--

LOCK TABLES `kqj_clock_in` WRITE;
/*!40000 ALTER TABLE `kqj_clock_in` DISABLE KEYS */;
/*!40000 ALTER TABLE `kqj_clock_in` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kqj_fingerprint`
--

DROP TABLE IF EXISTS `kqj_fingerprint`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kqj_fingerprint` (
  `stu_id` varchar(20) NOT NULL,
  `fingerprint1` mediumblob NOT NULL,
  `fingerprint2` mediumblob,
  PRIMARY KEY (`stu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kqj_fingerprint`
--

LOCK TABLES `kqj_fingerprint` WRITE;
/*!40000 ALTER TABLE `kqj_fingerprint` DISABLE KEYS */;
/*!40000 ALTER TABLE `kqj_fingerprint` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kqj_machine`
--

DROP TABLE IF EXISTS `kqj_machine`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kqj_machine` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `series_number` varchar(20) DEFAULT NULL,
  `space` int(11) DEFAULT NULL,
  `user` int(11) DEFAULT NULL,
  `fingerprint` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kqj_machine`
--

LOCK TABLES `kqj_machine` WRITE;
/*!40000 ALTER TABLE `kqj_machine` DISABLE KEYS */;
/*!40000 ALTER TABLE `kqj_machine` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kqj_order`
--

DROP TABLE IF EXISTS `kqj_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kqj_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `command` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `kqj_order_id_uindex` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kqj_order`
--

LOCK TABLES `kqj_order` WRITE;
/*!40000 ALTER TABLE `kqj_order` DISABLE KEYS */;
/*!40000 ALTER TABLE `kqj_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kqj_student`
--

DROP TABLE IF EXISTS `kqj_student`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kqj_student` (
  `stu_id` varchar(20) NOT NULL,
  `name` text NOT NULL,
  `class` int(11) NOT NULL,
  `grade` int(11) NOT NULL,
  `password` int(11) NOT NULL,
  PRIMARY KEY (`stu_id`),
  UNIQUE KEY `kqj_student_stu_id_uindex` (`stu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kqj_student`
--

LOCK TABLES `kqj_student` WRITE;
/*!40000 ALTER TABLE `kqj_student` DISABLE KEYS */;
/*!40000 ALTER TABLE `kqj_student` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-04-02  1:58:00
