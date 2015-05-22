-- MySQL dump 10.13  Distrib 5.6.21, for Linux (x86_64)
--
-- Host: localhost    Database: LETS
-- ------------------------------------------------------
-- Server version	5.6.21

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
-- Table structure for table `client`
--

DROP TABLE IF EXISTS `client`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `client` (
  `client_id` int(5) NOT NULL AUTO_INCREMENT,
  `email` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `username` varchar(64) DEFAULT NULL,
  `date_time_since_last_login` datetime DEFAULT NULL,
  `date_profile_created` date DEFAULT NULL,
  `bio_description_file` varchar(20) DEFAULT NULL,
  `img_file` varchar(20) DEFAULT NULL,
  `credit_amount` int(3) NOT NULL DEFAULT '20',
  `courses` enum('English','Maths','History','Computer Science') DEFAULT NULL,
  `user_type` enum('mod','admin','regular') DEFAULT NULL,
  `hash` varchar(32) DEFAULT NULL,
  `active` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`client_id`),
  FULLTEXT KEY `email` (`email`,`username`),
  FULLTEXT KEY `email_2` (`email`,`username`),
  FULLTEXT KEY `username` (`username`)
) ENGINE=MYISAM AUTO_INCREMENT=185 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `client`
--

LOCK TABLES `client` WRITE;
/*!40000 ALTER TABLE `client` DISABLE KEYS */;
INSERT INTO `client` VALUES (7,'empty@email.com','$2y$09$V2hhdCBpcyBpdCB5b3UgcemioyBtycehivG1NWKNgYXdnEwtAA2EW',NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1),(8,'james@email.com','$2y$09$V2hhdCBpcyBpdCB5b3UgcewWhkECjgrWPepchJDS25nOWT8Cr/rda','James',NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,2),(9,'michael@jackson.com','$2y$09$V2hhdCBpcyBpdCB5b3UgcewWhkECjgrWPepchJDS25nOWT8Cr/rda','MJ',NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,2),(10,'new@email.com','$2y$09$V2hhdCBpcyBpdCB5b3UgceotxRHqoCpfrDsU5L/cy2Uc9bMLIAE86',NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1),(11,'fake@gmail.com','$2y$09$V2hhdCBpcyBpdCB5b3Ugce3zfv8P0iuorJJ5wibzwv1ZLZVBkMcwC','fake',NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1),(12,'sam@email.com','$2y$09$V2hhdCBpcyBpdCB5b3UgceotxRHqoCpfrDsU5L/cy2Uc9bMLIAE86',NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1),(13,'some@email.com','$2y$09$V2hhdCBpcyBpdCB5b3UgceotxRHqoCpfrDsU5L/cy2Uc9bMLIAE86',NULL,NULL,NULL,NULL,NULL,20,NULL,NULL,NULL,1),(14,'cake@cake.com','$2y$09$V2hhdCBpcyBpdCB5b3Ugce3t3iDrf0PBlGyz5kgg55sZANauux0JS',NULL,NULL,NULL,NULL,NULL,20,NULL,NULL,NULL,1),(15,'cake@cake.com','$2y$09$V2hhdCBpcyBpdCB5b3Ugce3t3iDrf0PBlGyz5kgg55sZANauux0JS',NULL,NULL,NULL,NULL,NULL,20,NULL,NULL,NULL,1),(16,'cake@cake.com','$2y$09$V2hhdCBpcyBpdCB5b3Ugce3t3iDrf0PBlGyz5kgg55sZANauux0JS',NULL,NULL,NULL,NULL,NULL,20,NULL,NULL,NULL,1),(17,'cake2@cake.com','$2y$09$V2hhdCBpcyBpdCB5b3Ugce3t3iDrf0PBlGyz5kgg55sZANauux0JS',NULL,NULL,NULL,NULL,NULL,20,NULL,NULL,NULL,1),(18,'empty@email.com','$2y$09$V2hhdCBpcyBpdCB5b3UgcemioyBtycehivG1NWKNgYXdnEwtAA2EW',NULL,NULL,NULL,NULL,NULL,20,NULL,NULL,NULL,1),(19,'cake3@cake.com','$2y$09$V2hhdCBpcyBpdCB5b3Ugce3t3iDrf0PBlGyz5kgg55sZANauux0JS',NULL,NULL,NULL,NULL,NULL,20,NULL,NULL,NULL,1),(20,'empty@email.com','$2y$09$V2hhdCBpcyBpdCB5b3UgcemioyBtycehivG1NWKNgYXdnEwtAA2EW',NULL,NULL,NULL,NULL,NULL,20,NULL,NULL,NULL,1),(21,'newuser@email.com','$2y$09$V2hhdCBpcyBpdCB5b3UgceotxRHqoCpfrDsU5L/cy2Uc9bMLIAE86',NULL,NULL,NULL,NULL,NULL,20,NULL,NULL,NULL,1),(22,'newfake@email.com','$2y$09$V2hhdCBpcyBpdCB5b3UgceoYsFo5IU9l72wo0nwT643op9hIB4rKu',NULL,NULL,NULL,NULL,NULL,20,NULL,NULL,NULL,1),(23,'empty@email.com','$2y$09$V2hhdCBpcyBpdCB5b3UgcemioyBtycehivG1NWKNgYXdnEwtAA2EW',NULL,NULL,NULL,NULL,NULL,20,NULL,NULL,NULL,1),(24,'empty@email.com','$2y$09$V2hhdCBpcyBpdCB5b3UgcemioyBtycehivG1NWKNgYXdnEwtAA2EW',NULL,NULL,NULL,NULL,NULL,20,NULL,NULL,NULL,1),(25,'fakefake@fake.com','$2y$09$V2hhdCBpcyBpdCB5b3UgcewWhkECjgrWPepchJDS25nOWT8Cr/rda',NULL,NULL,NULL,NULL,NULL,20,NULL,NULL,NULL,1),(26,'fake2@email.com','$2y$09$V2hhdCBpcyBpdCB5b3UgceotxRHqoCpfrDsU5L/cy2Uc9bMLIAE86',NULL,NULL,NULL,NULL,NULL,20,NULL,NULL,NULL,1),(27,'fake3@email.com','$2y$09$V2hhdCBpcyBpdCB5b3UgcewWhkECjgrWPepchJDS25nOWT8Cr/rda',NULL,NULL,NULL,NULL,NULL,20,NULL,NULL,NULL,1),(28,'anemail@email.com','',NULL,NULL,NULL,NULL,NULL,20,NULL,NULL,NULL,1),(29,'trans@email.com','',NULL,NULL,NULL,NULL,NULL,20,NULL,NULL,NULL,1),(31,'new_email@fake.com','',NULL,NULL,NULL,NULL,NULL,20,NULL,NULL,NULL,1),(32,'new_email@fake.com','',NULL,NULL,NULL,NULL,NULL,20,NULL,NULL,NULL,1),(33,'new_email@fake.com','',NULL,NULL,NULL,NULL,NULL,20,NULL,NULL,NULL,1),(34,'new_email@fake.com','',NULL,NULL,NULL,NULL,NULL,20,NULL,NULL,NULL,1),(35,'new_email@fake.com','',NULL,NULL,NULL,NULL,NULL,20,NULL,NULL,NULL,1),(36,'new_email@fake.com','',NULL,NULL,NULL,NULL,NULL,20,NULL,NULL,NULL,1),(38,'new_email@fake.com','',NULL,NULL,NULL,NULL,NULL,20,NULL,NULL,NULL,1),(39,'a@a.com','$2y$09$V2hhdCBpcyBpdCB5b3UgcedGczLyYZVWk8AFHbX1SJJIgCGsqKc9C',NULL,NULL,NULL,NULL,NULL,20,NULL,NULL,NULL,1),(40,'something@email.com','$2y$09$V2hhdCBpcyBpdCB5b3UgcewWhkECjgrWPepchJDS25nOWT8Cr/rda',NULL,NULL,NULL,NULL,NULL,20,NULL,NULL,NULL,1),(41,'empty@email.com','2376',NULL,NULL,NULL,NULL,NULL,20,NULL,NULL,'ea5d2f1c4608232e07d3aa3d998e5135',1),(42,'empty@email.com','4809',NULL,NULL,NULL,NULL,NULL,20,NULL,NULL,'9fe8593a8a330607d76796b35c64c600',1),(138,'wwaz008@live.rhul.ac.uk','$2y$09$V2hhdCBpcyBpdCB5b3UgcefiNnJ6xOjZiZHz7DipUwERftbg9iXMm',NULL,NULL,NULL,NULL,NULL,20,NULL,NULL,'20aee3a5f4643755a79ee5f6a73050ac',0),(168,'james_black001@hotmail.co.uk','$2y$09$V2hhdCBpcyBpdCB5b3UgcewWhkECjgrWPepchJDS25nOWT8Cr/rda',NULL,NULL,NULL,NULL,NULL,20,NULL,NULL,'6f3ef77ac0e3619e98159e9b6febf557',2),(169,'','','Tony',NULL,NULL,NULL,NULL,20,NULL,NULL,NULL,0),(170,'','','Blackburn',NULL,NULL,NULL,NULL,20,NULL,NULL,NULL,0),(171,'','','Tony Blackburn',NULL,NULL,NULL,NULL,20,NULL,NULL,NULL,0),(172,'','','James hello',NULL,NULL,NULL,NULL,20,NULL,NULL,NULL,0),(173,'','','James James',NULL,NULL,NULL,NULL,20,NULL,NULL,NULL,0),(174,'','','Jamertes Soething',NULL,NULL,NULL,NULL,20,NULL,NULL,NULL,0),(175,'','','James Something',NULL,NULL,NULL,NULL,20,NULL,NULL,NULL,0),(176,'Something@james.com','',NULL,NULL,NULL,NULL,NULL,20,NULL,NULL,NULL,0),(177,'james@something.com','',NULL,NULL,NULL,NULL,NULL,20,NULL,NULL,NULL,0),(178,'james@something.james','',NULL,NULL,NULL,NULL,NULL,20,NULL,NULL,NULL,0),(179,'','','JamesSomething',NULL,NULL,NULL,NULL,20,NULL,NULL,NULL,0),(180,'eddiepcarr@gmail.com','$2y$09$V2hhdCBpcyBpdCB5b3UgceIt567f/E.25j4xsjKehDnVDAx9CKWpW',NULL,NULL,NULL,NULL,NULL,20,NULL,NULL,'043c3d7e489c69b48737cc0c92d0f3a2',2),(181,'loopvile@gmail.com','$2y$09$V2hhdCBpcyBpdCB5b3UgcewWhkECjgrWPepchJDS25nOWT8Cr/rda',NULL,NULL,NULL,NULL,NULL,20,NULL,NULL,'76dc611d6ebaafc66cc0879c71b5db5c',2),(182,'jas@email.com','$2y$09$V2hhdCBpcyBpdCB5b3UgcexqnT./DmnzcLku2mK1n9rez0ZkeJR4C',NULL,NULL,NULL,NULL,NULL,20,NULL,NULL,'71a3cb155f8dc89bf3d0365288219936',1),(183,'blahnlah@blah.com','$2y$09$V2hhdCBpcyBpdCB5b3UgceFOrRpSpfEZnH01iL3MtYV5h.5rMjcmS',NULL,NULL,NULL,NULL,NULL,20,NULL,NULL,'e0c641195b27425bb056ac56f8953d24',0),(184,'blahnlah@blah.com','$2y$09$V2hhdCBpcyBpdCB5b3Ugceb5UgpA2ZsY3CfCRE6WmZb5ryZ64w1xK',NULL,NULL,NULL,NULL,NULL,20,NULL,NULL,'6da37dd3139aa4d9aa55b8d237ec5d4a',0);
/*!40000 ALTER TABLE `client` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groupMembersRegistry`
--

DROP TABLE IF EXISTS `groupMembersRegistry`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groupMembersRegistry` (
  `client_id` int(5) NOT NULL,
  `group_id` int(5) NOT NULL,
  `group_user_type` enum('admin','regular') DEFAULT NULL,
  KEY `client_id` (`client_id`),
  KEY `group_id` (`group_id`),
  CONSTRAINT `groupMembersRegistry_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `client` (`client_id`),
  CONSTRAINT `groupMembersRegistry_ibfk_2` FOREIGN KEY (`group_id`) REFERENCES `groups` (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groupMembersRegistry`
--

LOCK TABLES `groupMembersRegistry` WRITE;
/*!40000 ALTER TABLE `groupMembersRegistry` DISABLE KEYS */;
/*!40000 ALTER TABLE `groupMembersRegistry` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groups` (
  `group_id` int(5) NOT NULL AUTO_INCREMENT,
  `group_img_file` varchar(20) DEFAULT NULL,
  `topics` enum('Foreign Language','Cooking','Sport','Books') DEFAULT NULL,
  `group_description_file` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `history`
--

DROP TABLE IF EXISTS `history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `history` (
  `pid` int(5) DEFAULT NULL,
  `favour_uid` int(5) DEFAULT NULL,
  `reciever_uid` int(5) DEFAULT NULL,
  `cost` int(2) DEFAULT NULL,
  `transaction_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `history`
--

LOCK TABLES `history` WRITE;
/*!40000 ALTER TABLE `history` DISABLE KEYS */;
INSERT INTO `history` VALUES (15,8,7,10,'2015-02-02'),(16,7,8,20,'2015-01-29'),(28,27,8,10,'2015-03-10'),(1,NULL,NULL,NULL,NULL),(999,888,777,5,'2015-03-10'),(999,888,8,5,'2015-03-10'),(999,888,8,5,'2015-03-10'),(999,888,8,5,'2015-03-10'),(999,888,8,5,'2015-03-10'),(999,888,8,5,'2015-03-10'),(999,888,8,5,'2015-03-10'),(999,888,8,5,'2015-03-10'),(999,888,8,5,'2015-03-10'),(999,888,8,5,'2015-03-10'),(30,9,8,10,'2015-03-12'),(29,9,8,10,'2015-03-12'),(29,9,8,10,'2015-03-12'),(31,9,8,10,'2015-03-12'),(31,9,8,10,'2015-03-12'),(32,9,8,10,'2015-03-12'),(32,9,8,10,'2015-03-12'),(32,9,8,10,'2015-03-12'),(32,9,8,10,'2015-03-12'),(32,9,8,10,'2015-03-12'),(34,9,8,10,'2015-03-12'),(33,9,8,10,'2015-03-12');
/*!40000 ALTER TABLE `history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `images` (
  `image_id` int(5) NOT NULL,
  `client_id` int(5) NOT NULL,
  `image` longblob NOT NULL,
  PRIMARY KEY (`image_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `images`
--

LOCK TABLES `images` WRITE;
/*!40000 ALTER TABLE `images` DISABLE KEYS */;
/*!40000 ALTER TABLE `images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messages` (
  `message_id` int(5) NOT NULL AUTO_INCREMENT,
  `client_id` int(5) DEFAULT NULL,
  `reciever_id` int(5) DEFAULT NULL,
  `subject` varchar(30) DEFAULT NULL,
  `content` varchar(300) DEFAULT NULL,
  `state` enum('read','unread') DEFAULT NULL,
  `date_time` datetime DEFAULT NULL,
  `threadid` int(5) DEFAULT NULL,
  PRIMARY KEY (`message_id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` VALUES (19,8,8,'new thread','this message is the start of a new thread','read','2015-03-24 21:57:43',1),(29,8,8,'a test subject yo','a test content for yo content yo yo','read','2015-03-24 22:19:02',1),(30,8,8,'a test subject yo','a test content for yo content yo yo','read','2015-03-24 22:19:02',1),(31,8,8,'a test subject yo','a test content for yo content yo yo','read','2015-03-24 22:19:03',1),(32,8,8,'hi','hi','read','2015-03-24 22:19:11',1),(33,8,8,'hello','hi','read','2015-03-24 22:19:50',1),(34,8,176,'a test subject yo','a test content for yo content yo yo','read','2015-03-24 22:41:49',3),(35,8,8,'hi','hello','read','2015-03-24 22:44:26',1),(36,176,8,'a reply to a test','some replied content','read','2015-03-24 23:48:02',3),(37,8,176,'a reply to a test','some replied content','read','2015-03-24 23:48:28',3),(38,176,8,'more subject','yet more content','read','2015-03-25 03:22:41',3);
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messagethread`
--

DROP TABLE IF EXISTS `messagethread`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messagethread` (
  `threadid` int(5) NOT NULL AUTO_INCREMENT,
  `sender1` int(5) NOT NULL,
  `sender2` int(5) NOT NULL,
  PRIMARY KEY (`threadid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messagethread`
--

LOCK TABLES `messagethread` WRITE;
/*!40000 ALTER TABLE `messagethread` DISABLE KEYS */;
INSERT INTO `messagethread` VALUES (1,8,8),(2,8,9),(3,8,176);
/*!40000 ALTER TABLE `messagethread` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post`
--

DROP TABLE IF EXISTS `post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `post` (
  `post_id` int(5) NOT NULL AUTO_INCREMENT,
  `title` varchar(20) DEFAULT NULL,
  `client_id` int(5) DEFAULT NULL,
  `post_img_file` varchar(20) DEFAULT NULL,
  `credit_cost` int(2) DEFAULT NULL,
  `topics` enum('Foreign Language','Cooking','Sport','Books') DEFAULT NULL,
  `post_description` varchar(300) DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `state` enum('active','unredeemed','redeemed','retired') DEFAULT NULL,
  `reciever_id` int(5) DEFAULT NULL,
  PRIMARY KEY (`post_id`),
  FULLTEXT KEY `title` (`title`,`post_description`),
  FULLTEXT KEY `title_2` (`title`,`post_description`),
  FULLTEXT KEY `post_description` (`post_description`)
) ENGINE=MYISAM AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post`
--

LOCK TABLES `post` WRITE;
/*!40000 ALTER TABLE `post` DISABLE KEYS */;
INSERT INTO `post` VALUES (1,'Football',8,NULL,NULL,NULL,'I give football lessons',NULL,NULL,NULL),(2,'Cooking',9,NULL,NULL,NULL,'I can teach you cooking',NULL,NULL,NULL),(3,'Flower arranging',8,NULL,NULL,NULL,'Learn all the is to know aout the ancient and beautiful art of flower-arranging',NULL,NULL,NULL),(4,'someTitle',8,NULL,NULL,NULL,'someDescription',NULL,NULL,NULL),(5,'Java',8,NULL,NULL,NULL,'I am looking for java lessons',NULL,NULL,NULL),(6,'Blowdry',NULL,NULL,NULL,NULL,'I am looking for java lessons',NULL,NULL,NULL),(7,'fake favour bro',NULL,NULL,NULL,NULL,'asdkmla',NULL,NULL,NULL),(8,'Some submit',8,NULL,NULL,NULL,'a description',NULL,NULL,NULL),(9,'Some submit',8,NULL,NULL,NULL,'a description',NULL,NULL,NULL),(10,'some title',8,NULL,NULL,NULL,'some description',NULL,NULL,NULL),(11,NULL,NULL,NULL,NULL,NULL,NULL,'2015-03-06',NULL,NULL),(12,NULL,NULL,NULL,NULL,NULL,NULL,'0000-00-00',NULL,NULL),(13,'someTitle',8,NULL,12,NULL,'someDescription','2007-09-09',NULL,NULL),(14,'Final test',8,NULL,34,NULL,'final description','2015-03-11',NULL,NULL),(15,'A second title',8,NULL,10,NULL,'A second description','2015-02-02','retired',NULL),(16,'A title',7,NULL,20,NULL,'A description','2015-01-29','retired',NULL),(17,'A new active title',8,NULL,5,NULL,'A short description for a new active title, isn\"t it fabulous.','2015-12-02','active',NULL),(19,'A blah title',8,NULL,2,NULL,'blah blah blah.','2015-11-29','retired',NULL),(20,'An unredeemdTitle',7,NULL,5,NULL,'Some uredeemed favour description.','2015-03-01','unredeemed',8),(22,'An unredeemdTitle',16,NULL,5,NULL,'Some uredeemed favour description.','2015-03-01','unredeemed',8),(23,'An retired Favour',8,NULL,5,NULL,'Some retired favour description.','2015-01-10','retired',0),(24,'An retired Favour',8,NULL,5,NULL,'Some retired favour description.','2015-01-10','retired',16),(25,'Cooking',8,NULL,15,NULL,'I will Italian Food cooking lessons','2015-03-25',NULL,NULL),(26,'someTitle',8,NULL,12,NULL,'someDescription','2007-09-09','retired',NULL),(27,'Cooking',8,NULL,15,NULL,'I will Italian Food cooking lessons','2015-03-20','retired',NULL),(28,'A new favour',27,NULL,10,NULL,'fake3@email.com brings you a new favour','2015-03-19','unredeemed',NULL),(29,'hello',9,NULL,10,NULL,'helloworld description','2015-03-15','unredeemed',NULL),(30,'hello',9,NULL,10,NULL,'helloworld description','2015-03-15','unredeemed',NULL),(31,'hello',9,NULL,10,NULL,'helloworld description','2015-03-15','unredeemed',NULL),(32,'hello',9,NULL,10,NULL,'helloworld description','2015-03-15','unredeemed',8),(33,'hello',9,NULL,10,NULL,'post description yo!!!','2015-03-15','unredeemed',8),(34,'hello',9,NULL,10,NULL,'post description yo!!!','2015-03-15','unredeemed',8),(35,'New 8 title',8,NULL,NULL,NULL,NULL,NULL,'redeemed',9),(36,'New 8 title',8,NULL,NULL,NULL,NULL,NULL,'redeemed',10),(37,'New 8 title',8,NULL,NULL,NULL,NULL,NULL,'redeemed',10),(38,'New 8 title',8,NULL,NULL,NULL,NULL,NULL,'redeemed',10),(39,'New 8 title',8,NULL,NULL,NULL,NULL,NULL,'redeemed',10),(40,'New 8 title',8,NULL,NULL,NULL,NULL,NULL,'redeemed',10),(41,'ad',8,NULL,3,NULL,'asd','2015-03-26','active',NULL);
/*!40000 ALTER TABLE `post` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `salt`
--

DROP TABLE IF EXISTS `salt`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `salt` (
  `saltValue` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `salt`
--

LOCK TABLES `salt` WRITE;
/*!40000 ALTER TABLE `salt` DISABLE KEYS */;
INSERT INTO `salt` VALUES ('What is it you really want?');
/*!40000 ALTER TABLE `salt` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `skills`
--

DROP TABLE IF EXISTS `skills`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `skills` (
  `client_id` int(5) NOT NULL,
  `skill_id` int(5) NOT NULL AUTO_INCREMENT,
  `skill` varchar(30) NOT NULL,
  `skill_level` enum('beginner','good','proficient','advanced','master') NOT NULL,
  `skill_type` enum('sports','language','maths','science','household','food','nature','fashion','art','general') NOT NULL,
  PRIMARY KEY (`skill_id`),
  FULLTEXT KEY `skill` (`skill`)
) ENGINE=MYISAM AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `skills`
--

LOCK TABLES `skills` WRITE;
/*!40000 ALTER TABLE `skills` DISABLE KEYS */;
INSERT INTO `skills` VALUES (8,4,'German Speaker','good','language'),(8,5,'French Speaker','proficient','language'),(8,6,'Soccer','master','sports'),(9,7,'Rugby','beginner','sports'),(9,8,'Calculus','master','maths'),(9,9,'Mental Arithmetic','beginner','maths'),(9,10,'Quantum Mechanics','proficient','science'),(9,11,'protein folding','advanced','science'),(8,12,'kitchen cleaning','advanced','household'),(8,13,'plumbing and maintenance','good','household'),(9,14,'German Schnitzel','master','food'),(8,15,'French Fries','advanced','food'),(8,16,'Bird-watching','good','nature'),(9,17,'Nature-enthusiast','advanced','nature'),(8,18,'fashion designer','proficient','fashion'),(9,19,'fashion advisor','advanced','fashion'),(9,20,'buyer','good','art'),(9,21,'critic','advanced','art'),(9,22,'Proof-reading','good','general'),(8,23,'masseuse','master','general'),(8,24,'aSkillName','proficient','general'),(8,25,'Calculus','beginner','maths'),(9,26,'Mental Arithmetic','beginner','maths'),(8,27,'German Speaker','beginner','language'),(8,28,'critic','beginner','art'),(8,29,'Nature-enthusiast','beginner','nature'),(8,30,'German Speaker','beginner','language'),(8,31,'Quantum Mechanics','beginner','science'),(8,32,'Spanish teaching','good','language'),(8,33,'French Speaker','beginner','language'),(8,34,'Soccer','beginner','sports'),(8,35,'basketball coach','beginner','sports'),(8,36,'French Speaker','beginner','language'),(8,37,'Baseball','beginner','sports'),(8,38,'Calculuc','beginner','maths'),(8,39,'Flower arranging','good','household'),(181,40,'French Speaker','proficient','language');
/*!40000 ALTER TABLE `skills` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `topics`
--

DROP TABLE IF EXISTS `topics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `topics` (
  `client_id` int(5) NOT NULL,
  `topics` enum('Foreign Language','Cooking','Sport','Books') NOT NULL DEFAULT 'Foreign Language',
  PRIMARY KEY (`topics`),
  KEY `client_id` (`client_id`),
  CONSTRAINT `topics_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `client` (`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `topics`
--

LOCK TABLES `topics` WRITE;
/*!40000 ALTER TABLE `topics` DISABLE KEYS */;
/*!40000 ALTER TABLE `topics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaction_request`
--

DROP TABLE IF EXISTS `transaction_request`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transaction_request` (
  `pid` int(5) DEFAULT NULL,
  `favour_uid` int(5) DEFAULT NULL,
  `client_uid` int(5) DEFAULT NULL,
  `date_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaction_request`
--

LOCK TABLES `transaction_request` WRITE;
/*!40000 ALTER TABLE `transaction_request` DISABLE KEYS */;
INSERT INTO `transaction_request` VALUES (31,9,8,'2015-03-12 04:30:14'),(32,9,8,'2015-03-12 04:47:00'),(32,9,8,'2015-03-12 04:48:09');
/*!40000 ALTER TABLE `transaction_request` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transactions` (
  `transaction_id` int(6) NOT NULL AUTO_INCREMENT,
  `client_received` int(5) DEFAULT NULL,
  `client_paid` int(5) DEFAULT NULL,
  `credit_amount` int(3) DEFAULT NULL,
  PRIMARY KEY (`transaction_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transactions`
--

LOCK TABLES `transactions` WRITE;
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-03-31  3:18:40
