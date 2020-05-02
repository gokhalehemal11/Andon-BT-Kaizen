-- MySQL dump 10.13  Distrib 8.0.5, for Win64 (x86_64)
--
-- Host: localhost    Database: andon
-- ------------------------------------------------------
-- Server version	8.0.19

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8mb4 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `attendees`
--

DROP TABLE IF EXISTS `attendees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `attendees` (
  `id` int NOT NULL AUTO_INCREMENT,
  `employee id` varchar(10) NOT NULL,
  `password` varchar(20) NOT NULL,
  `name` varchar(20) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `department` varchar(20) DEFAULT NULL,
  `phone no` varchar(15) DEFAULT NULL,
  `priority` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attendees`
--

LOCK TABLES `attendees` WRITE;
/*!40000 ALTER TABLE `attendees` DISABLE KEYS */;
INSERT INTO `attendees` VALUES (1,'101','hemal123','Hemal','hemal@gmail.com','Quality','7378482101',1),(2,'102','alka123','Alka','alka@gmail.com','Quality','9518786014',1),(3,'103','simran123','Simran','simran@gmail.com','HSE','9518786014',1),(4,'104','radhika123','Radhika','radhika@gmail.com','HSE','9970103761',1),(5,'105','rishabh123','Rishabh','ri@gmail.com','HSE','7378482101',2);
/*!40000 ALTER TABLE `attendees` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `issues`
--

DROP TABLE IF EXISTS `issues`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `issues` (
  `id` int NOT NULL AUTO_INCREMENT,
  `Issue Raised Time` varchar(50) NOT NULL,
  `Station` varchar(50) NOT NULL,
  `Description` varchar(50) DEFAULT NULL,
  `Department` varchar(50) NOT NULL,
  `Status` varchar(50) DEFAULT NULL,
  `Attendee` varchar(50) DEFAULT NULL,
  `Attended on` varchar(50) DEFAULT NULL,
  `Issue Closure Time` varchar(50) DEFAULT NULL,
  `Issue Downtime` varchar(50) DEFAULT NULL,
  `MP per station` varchar(50) DEFAULT NULL,
  `Loss manhours` varchar(50) DEFAULT NULL,
  `Raised by Supervisor` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `issues`
--

LOCK TABLES `issues` WRITE;
/*!40000 ALTER TABLE `issues` DISABLE KEYS */;
INSERT INTO `issues` VALUES (1,'2020/04/15 12:39:43am','Bogie','Tooling and quality help','Tooling,Quality','closed','Hemal','2020/04/15 01:53:47pm','2020/04/19 12:51:09am','96','3','288','1011'),(2,'2020/04/15 12:50:16am','Assembly','Help urgent','Quality,Welding,Methods','closed','Hemal','2020/04/15 01:53:47pm','2020/04/16 12:00:34am','23','3','69','1011'),(3,'2020/04/15 03:03:26pm','White Steel','Heeellpppp','Welding,Plant Engineering','open','','','','','3','','1022'),(4,'2020/04/15 03:57:42pm','Black Steel','HSE, quality and warehouse issues ','HSE,Warehouse,Quality','closed','Rishabh','2020/04/15 05:48:36pm','2020/04/16 12:00:34am','8','3','24','1011'),(5,'2020/04/15 03:58:39pm','Testing','HSE minor issues','HSE,Plant Engineering','in progress','Rishabh','2020/04/15 05:48:36pm','','','3','','1022'),(12,'2020/04/19 12:47:24am','Assembly','HSE','HSE','open','','','','','','','1011'),(13,'2020/04/19 05:24:18pm','Black Steel','Urgent help needed ','HSE,Quality,Plant Engineering','in progress','Alka','2020/04/19 05:26:27pm','','','','','1022'),(14,'2020/04/20 11:44:06am','Black Steel','HSE major help need','HSE,Warehouse','closed','Alka','2020/04/20 11:49:34am','2020/04/20 12:21:05pm','0.61638888888889','3','1.8491666666667','1011'),(15,'2020/04/26 07:58:59pm','White Steel','HSE and quality issues','HSE,Quality','closed','Alka','2020/04/26 09:08:21pm','2020/04/26 09:23:17pm','1.405','3','4.215','1011');
/*!40000 ALTER TABLE `issues` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mp_per_station`
--

DROP TABLE IF EXISTS `mp_per_station`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `mp_per_station` (
  `id` int NOT NULL AUTO_INCREMENT,
  `Station` varchar(20) DEFAULT NULL,
  `MP` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mp_per_station`
--

LOCK TABLES `mp_per_station` WRITE;
/*!40000 ALTER TABLE `mp_per_station` DISABLE KEYS */;
INSERT INTO `mp_per_station` VALUES (1,'Bogie','2'),(2,'Black Steel','4'),(3,'White Steel','2'),(4,'Assembly','2'),(5,'Testing','4');
/*!40000 ALTER TABLE `mp_per_station` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `projects` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `stations` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects`
--

LOCK TABLES `projects` WRITE;
/*!40000 ALTER TABLE `projects` DISABLE KEYS */;
INSERT INTO `projects` VALUES (1,'NAT SW','SW Pillar, SW Structure, SW Bars and Bracket, SW Heat Straightning, SW MT/VT, SW Painting'),(2,'NAT EW','EW Topbeam, EW Structure, EW Bars and Bracket, EW Heat Straightning, EW DP/VT, EW Painting'),(3,'NAT UF','UF Structure, UF Painting');
/*!40000 ALTER TABLE `projects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `supervisors`
--

DROP TABLE IF EXISTS `supervisors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `supervisors` (
  `id` int NOT NULL AUTO_INCREMENT,
  `employee id` varchar(10) NOT NULL,
  `password` varchar(20) NOT NULL,
  `name` varchar(20) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `department` varchar(20) DEFAULT NULL,
  `phone no` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `supervisors`
--

LOCK TABLES `supervisors` WRITE;
/*!40000 ALTER TABLE `supervisors` DISABLE KEYS */;
INSERT INTO `supervisors` VALUES (2,'1011','hemal123','Hemal','gokhalehemal11@gmail.com','HSE','9518786014'),(3,'1022','alka123','Alka','alka@gmail.com','Quality','7378482101'),(4,'1033','simran123','Simran','simran@gmail.com','Warehouse','9518786014'),(5,'999','pass','dummy','email@gmail.com','Plant Engineering','0123457890');
/*!40000 ALTER TABLE `supervisors` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-05-01 23:38:45
