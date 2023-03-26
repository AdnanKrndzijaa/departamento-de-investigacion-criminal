-- MySQL dump 10.13  Distrib 8.0.28, for Win64 (x86_64)
--
-- Host: localhost    Database: dic_database
-- ------------------------------------------------------
-- Server version	8.0.23

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (1,'Adnan','admin','admin123');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `news` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(150) NOT NULL,
  `date` datetime NOT NULL,
  `description` varchar(255) NOT NULL,
  `image` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `news`
--

LOCK TABLES `news` WRITE;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
INSERT INTO `news` VALUES (1,'Bomb Squads Safely Handle Decades-Old Military Explosives','2021-06-04 22:00:00','DIC and local police bomb squads are frequently called to homes where decades-old military explosives have been found.','images/news/bombs.png'),(2,'Partnership with Italian Authorities Leads to Artwork Return','2022-04-09 00:00:00','The DIC located and returned several pieces of historic art, including a gold coin and tapestries, back to Italy.','images/news/italypa.png'),(3,'Investigation into Online Drug Vendor Illuminates Counterfeit Pill Danger','2022-12-08 00:00:00','A suspect in Los Angeles was allegedly manufacturing and shipping large quantities of fake pills and other dangerous drugs.','images/news/onlined.png'),(5,'Prolific Drug Trafficking Organization Dismantled','2023-01-02 00:00:00','Agents from the DIC initially began investigating a violent street gang operating in western Pennsylvania beginning in 2018.','images/news/profilic.png'),(8,'Virginia Man Found Guilty of Felony and Misdemeanor','2023-03-10 23:00:00','A Virginia man was found guilty in the District of Columbia today of felony and misdemeanor charges for his actions during the Jan. 6, 2021, Capitol breach.','images/news/virginia.png'),(19,'test','2002-12-08 23:00:00','test','images/news/virginia.png'),(20,'test','2002-09-09 00:00:00','test','images/news/virginia.png');
/*!40000 ALTER TABLE `news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reports`
--

DROP TABLE IF EXISTS `reports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reports` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `date_of_birth` datetime NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `zip` varchar(10) NOT NULL,
  `category` varchar(20) NOT NULL,
  `description` text NOT NULL,
  `status` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reports`
--

LOCK TABLES `reports` WRITE;
/*!40000 ALTER TABLE `reports` DISABLE KEYS */;
INSERT INTO `reports` VALUES (1,'John','Smith','1985-05-02 00:00:00','0603433955','john.smith@gmail.com','NYC','US','1200','Terrorism','Uzasssssss je ovoooooooooo','in-process'),(2,'Samantha','Cristy','1968-01-08 00:00:00','3628973','suvad.k@gmail.com','SA','BIH','71000','Drug Trafficking','GHH DHSJS DDJJS SHDJW SUAJAWH WUSJJ','in-process'),(3,'Emiliano','Poetzi','1966-01-01 00:00:00','37283','seida@gmail.com','SA','BIH','71000','Cyber Crime','SJB DKSHL DKLSFHN OSFHSN LHDLWHN','solved'),(4,'Ende','Amani','1998-12-25 00:00:00','28347839','ende.amani@gmail.com','London','UK','12000','Drug Trafficking','sdfgj fvbhtj fhtj fgfg rhjuiz z 75 thgn ','solved'),(5,'Emi','Alonso','2001-04-04 00:00:00','1298384859','emi-alonso@gmail.com','Madrid','Spain','20200','Civil Rights','dmkkaio wowihd wodhd wodhs q0eo dlxkcn','solved'),(6,'Jonathan','Vollen','2002-12-02 00:00:00','0370347','jonathan_v@gmail.com','Chicago','US','1250','Public Corruption','dlfjs srliue ewkuersh,n ckxnxo fer  bfhf rdf t','solved'),(7,'Chloe','Chicko','2000-05-05 00:00:00','040284','chloechicko@gmail.com','Las Vegas','US','1130','Organized Crime','flkjrpios wq qef t c s fgd ssf','in-process');
/*!40000 ALTER TABLE `reports` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wanted`
--

DROP TABLE IF EXISTS `wanted`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wanted` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `image` varchar(150) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wanted`
--

LOCK TABLES `wanted` WRITE;
/*!40000 ALTER TABLE `wanted` DISABLE KEYS */;
INSERT INTO `wanted` VALUES (2,'Amanda','Sanchez','images/wanted/asanchez.png','Shoplifter'),(5,'John','Smith','images/wanted/jsmith.png','Robber, murder, shoplifter'),(6,'Kristina','Valdez','images/wanted/kvaldez.png','Murder');
/*!40000 ALTER TABLE `wanted` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-03-26 11:21:44
