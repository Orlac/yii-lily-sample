-- MySQL dump 10.13  Distrib 5.1.58, for debian-linux-gnu (i686)
--
-- Host: localhost    Database: lily_sample
-- ------------------------------------------------------
-- Server version	5.1.58-1ubuntu1

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
-- Table structure for table `tbl_lily_account`
--

DROP TABLE IF EXISTS `tbl_lily_account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_lily_account` (
  `aid` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `service` varchar(255) NOT NULL,
  `id` varchar(255) NOT NULL,
  `hidden` tinyint(1) DEFAULT NULL,
  `data` blob,
  `created` int(11) DEFAULT NULL,
  PRIMARY KEY (`aid`),
  UNIQUE KEY `service_id` (`service`,`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_lily_account`
--

LOCK TABLES `tbl_lily_account` WRITE;
/*!40000 ALTER TABLE `tbl_lily_account` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_lily_account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_lily_email_account_activation`
--

DROP TABLE IF EXISTS `tbl_lily_email_account_activation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_lily_email_account_activation` (
  `code_id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `created` int(11) DEFAULT NULL,
  PRIMARY KEY (`code_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_lily_email_account_activation`
--

LOCK TABLES `tbl_lily_email_account_activation` WRITE;
/*!40000 ALTER TABLE `tbl_lily_email_account_activation` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_lily_email_account_activation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_lily_onetime`
--

DROP TABLE IF EXISTS `tbl_lily_onetime`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_lily_onetime` (
  `tid` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `token` varchar(255) NOT NULL,
  `created` int(11) DEFAULT NULL,
  PRIMARY KEY (`tid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_lily_onetime`
--

LOCK TABLES `tbl_lily_onetime` WRITE;
/*!40000 ALTER TABLE `tbl_lily_onetime` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_lily_onetime` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_lily_session`
--

DROP TABLE IF EXISTS `tbl_lily_session`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_lily_session` (
  `sid` int(11) NOT NULL AUTO_INCREMENT,
  `aid` int(11) DEFAULT NULL,
  `data` blob,
  `ssid` varchar(255) NOT NULL,
  `created` int(11) DEFAULT NULL,
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_lily_session`
--

LOCK TABLES `tbl_lily_session` WRITE;
/*!40000 ALTER TABLE `tbl_lily_session` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_lily_session` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_lily_user`
--

DROP TABLE IF EXISTS `tbl_lily_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_lily_user` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `deleted` int(11) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `inited` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_lily_user`
--

LOCK TABLES `tbl_lily_user` WRITE;
/*!40000 ALTER TABLE `tbl_lily_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_lily_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_migration`
--

DROP TABLE IF EXISTS `tbl_migration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_migration` (
  `version` varchar(255) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_migration`
--

LOCK TABLES `tbl_migration` WRITE;
/*!40000 ALTER TABLE `tbl_migration` DISABLE KEYS */;
INSERT INTO `tbl_migration` VALUES ('m000000_000000_base',1330255383),('m120206_173608_sample_tables',1330255383),('m120131_112629_lily_tables_create',1330255384);
/*!40000 ALTER TABLE `tbl_migration` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_profile`
--

DROP TABLE IF EXISTS `tbl_profile`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_profile` (
  `pid` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `sex` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_profile`
--

LOCK TABLES `tbl_profile` WRITE;
/*!40000 ALTER TABLE `tbl_profile` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_profile` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_tag1`
--

DROP TABLE IF EXISTS `tbl_tag1`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_tag1` (
  `tid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`tid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_tag1`
--

LOCK TABLES `tbl_tag1` WRITE;
/*!40000 ALTER TABLE `tbl_tag1` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_tag1` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_tag1_relation`
--

DROP TABLE IF EXISTS `tbl_tag1_relation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_tag1_relation` (
  `tid` int(11) DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  UNIQUE KEY `tag1_tid_uid` (`tid`,`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_tag1_relation`
--

LOCK TABLES `tbl_tag1_relation` WRITE;
/*!40000 ALTER TABLE `tbl_tag1_relation` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_tag1_relation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_tag2`
--

DROP TABLE IF EXISTS `tbl_tag2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_tag2` (
  `tid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`tid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_tag2`
--

LOCK TABLES `tbl_tag2` WRITE;
/*!40000 ALTER TABLE `tbl_tag2` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_tag2` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_tag2_relation`
--

DROP TABLE IF EXISTS `tbl_tag2_relation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_tag2_relation` (
  `tid` int(11) DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  UNIQUE KEY `tag2_tid_uid` (`tid`,`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_tag2_relation`
--

LOCK TABLES `tbl_tag2_relation` WRITE;
/*!40000 ALTER TABLE `tbl_tag2_relation` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_tag2_relation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_tag3`
--

DROP TABLE IF EXISTS `tbl_tag3`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_tag3` (
  `tid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`tid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_tag3`
--

LOCK TABLES `tbl_tag3` WRITE;
/*!40000 ALTER TABLE `tbl_tag3` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_tag3` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_tag3_relation`
--

DROP TABLE IF EXISTS `tbl_tag3_relation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_tag3_relation` (
  `tid` int(11) DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  UNIQUE KEY `tag3_tid_uid` (`tid`,`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_tag3_relation`
--

LOCK TABLES `tbl_tag3_relation` WRITE;
/*!40000 ALTER TABLE `tbl_tag3_relation` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_tag3_relation` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2012-02-26 17:23:04
