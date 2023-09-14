-- MariaDB dump 10.19  Distrib 10.11.2-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: Student
-- ------------------------------------------------------
-- Server version	10.11.2-MariaDB-1

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
-- Current Database: `Student`
--

-- CREATE DATABASE /*!32312 IF NOT EXISTS*/ `Student` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

-- USE `Student`;

--
-- Table structure for table `LMS_student`
--

DROP TABLE IF EXISTS `LMS_student`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `LMS_student` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `LMS_ID` int DEFAULT NULL,
  `SID` int DEFAULT NULL,
  `submittion_date` date DEFAULT (curdate()),
  `ischeck` varchar(5) DEFAULT 'false',
  `comment` varchar(500) DEFAULT NULL,
  `Assign_file` varchar(100) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Assign_file` (`Assign_file`),
  KEY `LMS_ID` (`LMS_ID`),
  KEY `SID` (`SID`),
  CONSTRAINT `LMS_student_ibfk_1` FOREIGN KEY (`LMS_ID`) REFERENCES `subject_LMS` (`ID`),
  CONSTRAINT `LMS_student_ibfk_2` FOREIGN KEY (`SID`) REFERENCES `student` (`SID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `LMS_student`
--

LOCK TABLES `LMS_student` WRITE;
/*!40000 ALTER TABLE `LMS_student` DISABLE KEYS */;
/*!40000 ALTER TABLE `LMS_student` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `attandance`
--

DROP TABLE IF EXISTS `attandance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `attandance` (
  `attandance_id` int(11) NOT NULL AUTO_INCREMENT,
  `DATE` date DEFAULT (curdate()),
  `SID` int(11) DEFAULT NULL,
  `status` varchar(1) DEFAULT 'A',
  PRIMARY KEY (`attandance_id`),
  UNIQUE KEY `DATE_SID` (`DATE`,`SID`),
  KEY `primary_k` (`SID`),
  CONSTRAINT `primary_k` FOREIGN KEY (`SID`) REFERENCES `student` (`SID`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attandance`
--

LOCK TABLES `attandance` WRITE;
/*!40000 ALTER TABLE `attandance` DISABLE KEYS */;
INSERT INTO `attandance` VALUES
(1,'2023-04-07',1,'P'),
(2,'2023-04-14',1,'P');
/*!40000 ALTER TABLE `attandance` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `credintial`
--

DROP TABLE IF EXISTS `credintial`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `credintial` (
  `credintial_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `isadmin` varchar(10) DEFAULT 'false',
  PRIMARY KEY (`credintial_id`),
  UNIQUE KEY `user_name` (`user_name`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `credintial`
--

LOCK TABLES `credintial` WRITE;
/*!40000 ALTER TABLE `credintial` DISABLE KEYS */;
INSERT INTO `credintial` VALUES
(1,'student','cd73502828457d15655bbd7a63fb0bc8','false'),
(2,'admin','21232f297a57a5a743894a0e4a801fc3','true');

/*!40000 ALTER TABLE `credintial` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `faculty`
--

DROP TABLE IF EXISTS `faculty`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `faculty` (
  `FID` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `SUBID` int(11) DEFAULT NULL,
  `avatar` varchar(100) DEFAULT '/images/Default_avatar.png',
  `mobile_no` varchar(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `credintial_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`FID`),
  KEY `SUBID` (`SUBID`),
  KEY `credintial_id` (`credintial_id`),
  CONSTRAINT `faculty_ibfk_1` FOREIGN KEY (`SUBID`) REFERENCES `subject` (`SUBID`),
  CONSTRAINT `faculty_ibfk_2` FOREIGN KEY (`credintial_id`) REFERENCES `credintial` (`credintial_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `faculty`
--

LOCK TABLES `faculty` WRITE;
/*!40000 ALTER TABLE `faculty` DISABLE KEYS */;
INSERT INTO `faculty` VALUES
(1,'admin','null',1,'/images/Default_avatar.png','9845763498','admin@web1.com','male',2);
/*!40000 ALTER TABLE `faculty` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `student` (
  `SID` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `sem` int(11) NOT NULL,
  `class` varchar(2) NOT NULL,
  `join_date` date DEFAULT (curdate()),
  `avatar` varchar(100) DEFAULT '/images/Default_avatar.png',
  `mobile_no` varchar(10) DEFAULT NULL,
  `parent_mobile_no` varchar(10) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `credintial_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`SID`),
  KEY `credintial_id` (`credintial_id`),
  CONSTRAINT `student_ibfk_1` FOREIGN KEY (`credintial_id`) REFERENCES `credintial` (`credintial_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student`
--

LOCK TABLES `student` WRITE;
/*!40000 ALTER TABLE `student` DISABLE KEYS */;
INSERT INTO `student` VALUES
(1,'student','student',1,'H','2023-03-20','/images/Default_avatar.png','7548563219','8658563412','student@site_name.com','male',1);
/*!40000 ALTER TABLE `student` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subject`
--

DROP TABLE IF EXISTS `subject`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subject` (
  `SUBID` int(11) NOT NULL AUTO_INCREMENT,
  `subject_code` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `credit` int(11) NOT NULL,
  `sem` int(11) NOT NULL,
  `img` varchar(100) DEFAULT '/images/books.jpg',
  PRIMARY KEY (`SUBID`),
  UNIQUE KEY `subject_code` (`subject_code`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subject`
--

LOCK TABLES `subject` WRITE;
/*!40000 ALTER TABLE `subject` DISABLE KEYS */;
INSERT INTO `subject` VALUES
(1,'21CS101','C programming',6,1,'/images/books.jpg'),
(2,'21CS202','Fundamental of electronics',4,2,'/images/books.jpg'),
(3,'21CS203','Java',5,2,'/images/books.jpg'),
(4,'21HS204','Communicative english',3,2,'/images/books.jpg'),
(5,'21HS102','Mathematics - I',6,1,'/images/books.jpg'),
(6,'21HS103','Physics',4,1,'/images/books.jpg'),
(7,'21CS104','Web Designing',4,1,'/images/books.jpg'),
(8,'21CS201','Database Management System - I',4,2,'/images/books.jpg');
/*!40000 ALTER TABLE `subject` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subject_LMS`
--

DROP TABLE IF EXISTS `subject_LMS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subject_LMS` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `SUBID` int(11) DEFAULT NULL,
  `LMS_file` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `comment` varchar(500) DEFAULT NULL,
  `view` int(11) DEFAULT 0,
  `date` date DEFAULT (curdate()),
  `FID` int(11) DEFAULT NULL,
  `is_assign` varchar(5) DEFAULT 'false',
  `end_date` date DEFAULT '0000-00-00',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `LMS_file` (`LMS_file`),
  KEY `SUBID` (`SUBID`),
  KEY `FID` (`FID`),
  CONSTRAINT `subject_LMS_ibfk_1` FOREIGN KEY (`SUBID`) REFERENCES `subject` (`SUBID`),
  CONSTRAINT `subject_LMS_ibfk_2` FOREIGN KEY (`FID`) REFERENCES `faculty` (`FID`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subject_LMS`
--

LOCK TABLES `subject_LMS` WRITE;
/*!40000 ALTER TABLE `subject_LMS` DISABLE KEYS */;
INSERT INTO `subject_LMS` VALUES
(28,1,'/LMS/27.pdf','lms','',1,'2023-04-20',1,'false','0000-00-00');
/*!40000 ALTER TABLE `subject_LMS` ENABLE KEYS */;
UNLOCK TABLES;

SET GLOBAL log_bin_trust_function_creators = 1;

USE Student;
CREATE FUNCTION GETPR(id INT) 
  RETURNS DECIMAL(5,2) 
  RETURN 
    (SELECT 
      (SELECT COUNT(SID) FROM attandance WHERE status="P" AND SID=id)
    *100/COUNT(DISTINCT DATE) 
    FROM attandance 
    INNER JOIN 
    student ON 
    student.SID = id AND attandance.SID=id 
    WHERE DATE >= join_date
  );

SET GLOBAL event_scheduler = ON;

CREATE EVENT add_att_daily
    ON SCHEDULE
    	EVERY 1 DAY
    	STARTS CURRENT_TIMESTAMP
    DO
    	INSERT INTO attandance (SID) SELECT SID FROM student;
      
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-08-16  8:54:11