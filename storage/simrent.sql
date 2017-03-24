/*
SQLyog Ultimate v9.50 
MySQL - 5.7.17-0ubuntu0.16.04.1 : Database - rentsim
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `activations` */

DROP TABLE IF EXISTS `activations`;

CREATE TABLE `activations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `phone_number` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sim_number` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `call` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `answer` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `order_id` int(10) unsigned DEFAULT NULL,
  `attempts` int(10) DEFAULT NULL,
  `check_status` varchar(100) COLLATE utf8_unicode_ci DEFAULT 'unchecked',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=135 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `activations` */

LOCK TABLES `activations` WRITE;

insert  into `activations`(`id`,`phone_number`,`sim_number`,`call`,`answer`,`order_id`,`attempts`,`check_status`,`created_at`,`updated_at`) values (1,'19024672082','85345898388453455435','activate','4',95,1,'ok','2016-12-19 08:56:45','2017-01-30 13:27:05'),(2,'19024672082','85345898388453455435','deactivate','4',95,1,'ok','2016-12-19 09:28:40','2017-01-30 13:27:14'),(3,'19024672082','8629298858846150495','deactivate','4',71,1,'ok','2016-12-19 13:11:17','2017-01-30 13:27:20'),(4,'1 (960) 585-8051','8215750682424517468','deactivate','3',72,1,'ok','2016-12-19 13:11:38','2017-01-30 13:27:25'),(5,'19024672082','8629298858846150495','deactivate','4',96,1,'ok','2016-12-20 09:33:17','2017-01-30 13:27:30'),(6,'1 (960) 585-8051','8215750682424517468','deactivate','3',97,1,'ok','2016-12-20 09:36:35','2017-01-30 13:27:35'),(7,'1 (960) 585-8051','8215750682424517468','deactivate','3',98,1,'ok','2016-12-20 10:07:14','2017-01-30 13:27:41'),(8,'1 (960) 585-8051','8215750682424517468','deactivate','3',99,1,'ok','2016-12-20 10:09:06','2017-01-30 13:27:43'),(9,'19024672082','8629298858846150495','deactivate','4',102,1,'ok','2016-12-20 12:53:43','2017-01-30 13:27:47'),(10,'5821456','8479768997754135080','deactivate','4',105,1,'ok','2016-12-20 12:54:33','2017-01-30 13:27:51'),(11,'1 (960) 585-8051','8215750682424517468','deactivate','3',104,1,'ok','2016-12-20 12:55:03','2017-01-30 13:27:55'),(12,'19024672082','8629298858846150495','deactivate','4',103,1,'ok','2016-12-20 12:55:13','2017-01-30 13:28:04'),(13,'1 (960) 585-8051','8215750682424517468','deactivate','3',100,1,'ok','2016-12-20 12:55:54','2017-01-30 13:28:08'),(14,'19024672082','8629298858846150495','deactivate','4',101,1,'ok','2016-12-20 12:56:03','2017-01-30 13:28:12'),(15,'5821456','8479768997754135080','deactivate','4',107,1,'ok','2016-12-20 13:03:02','2017-01-30 13:28:19'),(16,'5821456','8479768997754135080','deactivate','4',106,1,'ok','2016-12-20 13:31:13','2017-01-30 13:28:25'),(17,'1 (960) 585-8051','8215750682424517468','deactivate','3',113,1,'ok','2016-12-20 13:31:28','2017-01-30 13:28:27'),(18,'19024672082','8629298858846150495','deactivate','4',112,1,'ok','2016-12-20 13:31:42','2017-01-30 13:28:31'),(19,'5821456','8479768997754135080','deactivate','4',110,1,'ok','2016-12-20 13:31:53','2017-01-30 13:28:35'),(20,'5821456','8479768997754135080','deactivate','4',109,1,'ok','2016-12-20 13:32:00','2017-01-30 13:28:41'),(21,'5821456','8479768997754135080','deactivate','4',111,1,'ok','2016-12-20 13:32:13','2017-01-30 13:28:45'),(22,'5821456','8479768997754135080','deactivate','4',108,1,'ok','2016-12-20 13:32:26','2017-01-30 13:28:50'),(23,'19024672082','85345345345453455435','activate','0',206,NULL,'ok','2016-12-22 10:42:22','2016-12-22 10:42:22'),(24,'19024672082','8629298858846150495','deactivate','0',206,NULL,'ok','2016-12-23 08:09:34','2016-12-23 08:09:34'),(25,'1.638.365.0425','8753397432615853442','activate','0',213,NULL,'ok','2016-12-23 08:09:54','2016-12-23 08:09:54'),(26,'52352356565555','8736256565544555555','activate','0',217,NULL,'ok','2016-12-23 08:10:15','2016-12-23 08:10:15'),(27,'34563456','8349631059760235464','activate','0',218,NULL,'ok','2016-12-23 08:10:35','2016-12-23 08:10:35'),(28,'1.638.365.0425','8898257124795575047','deactivate','0',213,NULL,'ok','2016-12-27 09:27:18','2016-12-27 09:27:18'),(29,'52352356565555','8479766697754138817','deactivate','0',217,NULL,'ok','2016-12-27 09:27:39','2016-12-27 09:27:39'),(30,'34563456','8629298858846158888','deactivate','0',218,NULL,'ok','2016-12-27 09:27:59','2016-12-27 09:27:59'),(31,'1-821-509-9002','535345345345345345444','activate','0',211,NULL,'ok','2016-12-27 09:28:19','2016-12-27 09:28:19'),(32,'5935072600','85345345345453455435','activate','0',219,NULL,'ok','2016-12-27 09:28:39','2016-12-27 09:28:39'),(33,'19024672082','8894793329832303275','activate','0',227,NULL,'ok','2016-12-27 09:28:59','2016-12-27 09:28:59'),(34,'34563456','853453453453455435','activate','0',232,NULL,'ok','2016-12-27 09:29:20','2016-12-27 09:29:20'),(35,'1-821-509-9002','8753397432615853442','deactivate','0',211,NULL,'ok','2016-12-27 10:26:17','2016-12-27 10:26:17'),(36,'5935072600','8986893210636792056','deactivate','0',219,NULL,'ok','2016-12-27 10:26:37','2016-12-27 10:26:37'),(37,'19024672082','8629298858846150495','deactivate','0',227,NULL,'ok','2016-12-27 10:26:57','2016-12-27 10:26:57'),(38,'34563456','8629298858846158888','deactivate','0',232,NULL,'ok','2016-12-28 12:48:04','2016-12-28 12:48:04'),(39,'1-821-509-9002','535345345345345345444','activate','0',244,NULL,'ok','2016-12-28 12:48:24','2016-12-28 12:48:24'),(40,'1-821-509-9002','8753397432615853442','deactivate','0',244,NULL,'ok','2016-12-28 12:55:53','2016-12-28 12:55:53'),(41,'1-821-509-9002','8736256565544555555','activate','0',245,NULL,'ok','2016-12-28 12:56:13','2016-12-28 12:56:13'),(42,'34563456','85345345345453455435','activate','0',246,NULL,'ok','2016-12-28 12:57:05','2016-12-28 12:57:05'),(43,'34563456','8753397432615853442','activate','0',247,NULL,'ok','2016-12-28 12:57:53','2016-12-28 12:57:53'),(44,'52352352345','8349631059760235464','activate','0',248,NULL,'ok','2016-12-28 12:58:40','2016-12-28 12:58:40'),(45,'1-821-509-9002','8753397432615853442','deactivate','0',245,NULL,'ok','2016-12-28 13:02:34','2016-12-28 13:02:34'),(46,'34563456','8629298858846158888','deactivate','0',246,NULL,'ok','2016-12-28 13:02:54','2016-12-28 13:02:54'),(47,'34563456','8629298858846158888','deactivate','0',247,NULL,'ok','2016-12-28 13:03:14','2016-12-28 13:03:14'),(48,'52352352345','85345345388453455435','deactivate','0',248,NULL,'ok','2016-12-28 13:03:34','2016-12-28 13:03:34'),(49,'1-821-509-9002','85345345345453455435','activate','0',249,NULL,'ok','2016-12-28 13:09:44','2016-12-28 13:09:44'),(50,'1-821-509-9002','8753397432615853442','deactivate','0',249,NULL,'ok','2016-12-28 13:14:09','2016-12-28 13:14:09'),(51,'1-821-509-9002','85345345345453455435','activate','0',250,NULL,'ok','2016-12-28 13:32:20','2016-12-28 13:32:20'),(52,'1-821-509-9002','8753397432615853442','deactivate','0',250,NULL,'ok','2016-12-28 13:37:02','2016-12-28 13:37:02'),(53,'5235235234555','8349631059760235464','activate','4',255,1,'ok','2017-01-12 15:45:34','2017-01-30 13:28:55'),(54,'34563456','535345345345345345444','activate','4',257,1,'ok','2017-01-12 15:46:18','2017-01-30 13:28:58'),(55,'5235235234555','8629298858846157776','deactivate','4',255,1,'ok','2017-01-13 07:30:24','2017-01-30 13:29:02'),(56,'34563456','8629298858846158888','deactivate','4',257,1,'ok','2017-01-13 07:31:15','2017-01-30 13:29:06'),(57,'34563456','8736256565544555555','activate','4',258,1,'ok','2017-01-13 15:35:02','2017-01-30 13:29:13'),(58,'34563456','8629298858846158888','deactivate','4',258,1,'ok','2017-01-13 15:42:39','2017-01-30 13:29:17'),(59,'34563456','8736256565544555555','activate','4',259,1,'ok','2017-01-13 15:47:48','2017-01-30 13:29:24'),(60,'34563456','8629298858846158888','deactivate','4',259,1,'ok','2017-01-13 15:48:57','2017-01-30 13:29:25'),(61,'1-821-509-9002','8736256565544555555','activate','4',260,1,'ok','2017-01-17 10:33:02','2017-01-30 13:29:28'),(62,'34563456','866666666666111','activate','4',261,1,'ok','2017-01-17 10:33:18','2017-01-30 13:29:32'),(63,'1-821-509-9002','85555555555555999','deactivate','4',260,1,'ok','2017-01-17 11:04:24','2017-01-30 13:29:36'),(64,'34563456','8629298858846158888','deactivate','4',261,1,'ok','2017-01-17 12:21:26','2017-01-30 13:29:39'),(65,'1-821-509-9002','866666666666999','activate','4',263,1,'ok','2017-01-17 15:58:36','2017-01-30 13:29:43'),(66,'34563456','866666666666111','activate','4',262,1,'ok','2017-01-17 15:58:52','2017-01-30 13:29:46'),(67,'1-821-509-9002','85555555555555999','deactivate','4',263,1,'ok','2017-01-17 15:59:08','2017-01-30 13:29:50'),(68,'34563456','8629298858846158888','deactivate','4',262,1,'ok','2017-01-17 15:59:19','2017-01-30 13:29:53'),(69,'1-821-509-9002','86666666666688899','activate','0',267,NULL,'ok','2017-01-18 13:43:56','2017-01-18 13:43:56'),(70,'1-821-509-9002','85555555555555999','deactivate','0',267,NULL,'ok','2017-01-18 13:44:08','2017-01-18 13:44:08'),(71,'34563456','866666666666777','activate','0',269,NULL,'ok','2017-01-18 14:41:52','2017-01-18 14:41:52'),(72,'34563456','8629298858846158888','deactivate','0',269,NULL,'ok','2017-01-18 14:42:30','2017-01-18 14:42:30'),(73,'1-821-509-9002','866666666666111','activate','0',265,NULL,'ok','2017-01-19 10:31:24','2017-01-19 10:31:24'),(74,'1-821-509-9002','86666666666688899','activate','0',268,NULL,'ok','2017-01-19 15:30:51','2017-01-19 15:30:51'),(75,'011111111112','866666666666999','activate','0',266,NULL,'ok','2017-01-19 15:31:58','2017-01-19 15:31:58'),(76,'1-821-509-9002','85555555555555999','deactivate','0',268,NULL,'ok','2017-01-19 15:37:49','2017-01-19 15:37:49'),(77,'1-821-509-9002','85555555555555999','deactivate','0',265,NULL,'ok','2017-01-19 15:38:42','2017-01-19 15:38:42'),(78,'011111111112','85555555555555777','deactivate','0',266,NULL,'ok','2017-01-19 15:39:05','2017-01-19 15:39:05'),(79,'34563456','866666666666111','activate','0',270,NULL,'ok','2017-01-19 15:40:51','2017-01-19 15:40:51'),(80,'34563456','8629298858846158888','deactivate','0',270,NULL,'ok','2017-01-19 15:41:04','2017-01-19 15:41:04'),(81,'34563456','866666666666111','activate','0',271,NULL,'ok','2017-01-20 11:03:50','2017-01-20 11:03:50'),(82,'34563456','8629298858846158888','deactivate','0',271,NULL,'ok','2017-01-20 12:18:27','2017-01-20 12:18:27'),(83,'052352356565555','866666666666999','activate','0',272,NULL,'ok','2017-01-20 12:19:40','2017-01-20 12:19:40'),(84,'052352356565555','87777777777777','deactivate','0',272,NULL,'ok','2017-01-20 13:07:34','2017-01-20 13:07:34'),(85,'34563456','866666666666111','activate','0',273,NULL,'ok','2017-01-20 13:39:58','2017-01-20 13:39:58'),(86,'34563456','8629298858846158888','deactivate','0',273,NULL,'ok','2017-01-20 13:42:01','2017-01-20 13:42:01'),(87,'34563456','866666666666111','activate','0',274,NULL,'ok','2017-01-20 13:46:40','2017-01-20 13:46:40'),(88,'34563456','8629298858846158888','deactivate','0',274,NULL,'ok','2017-01-20 13:48:00','2017-01-20 13:48:00'),(89,'34563456','866666666666111','activate','0',275,NULL,'ok','2017-01-20 13:52:13','2017-01-20 13:52:13'),(90,'34563456','8629298858846158888','deactivate','0',275,NULL,'ok','2017-01-20 13:53:36','2017-01-20 13:53:36'),(91,'34563456','866666666666111','activate','0',276,NULL,'ok','2017-01-20 14:28:01','2017-01-20 14:28:01'),(92,'34563456','8629298858846158888','deactivate','0',276,NULL,'ok','2017-01-20 14:29:04','2017-01-20 14:29:04'),(93,'34563456','866666666666111','activate','0',277,NULL,'ok','2017-01-23 12:03:22','2017-01-23 12:03:22'),(94,'34563456','8629298858846158888','deactivate','0',277,NULL,'ok','2017-01-23 12:03:35','2017-01-23 12:03:35'),(95,'34563456','866666666666111','activate','0',278,NULL,'ok','2017-01-24 11:12:57','2017-01-24 11:12:57'),(96,'34563456','8629298858846158888','deactivate','0',278,NULL,'ok','2017-01-24 11:15:13','2017-01-24 11:15:13'),(97,'34563456','866666666666999','activate','0',279,NULL,'ok','2017-01-24 12:42:18','2017-01-24 12:42:18'),(98,'1-821-509-9002','866666666666111','activate','0',280,NULL,'ok','2017-01-24 14:39:18','2017-01-24 14:39:18'),(99,'34563456','8629298858846158888','deactivate','0',279,NULL,'ok','2017-01-25 13:16:24','2017-01-25 13:16:24'),(100,'34563456','8809177776936982567','activate','0',288,NULL,'ok','2017-01-25 13:17:41','2017-01-25 13:17:41'),(101,'34563456','8629298858846158888','deactivate','0',288,NULL,'ok','2017-01-25 13:19:01','2017-01-25 13:19:01'),(102,'34563456','866666666666999','activate','0',290,NULL,'ok','2017-01-25 13:21:37','2017-01-25 13:21:37'),(103,'34563456','8629298858846158888','deactivate','0',290,NULL,'ok','2017-01-25 13:22:15','2017-01-25 13:22:15'),(104,'34563456','8349631059760235464','activate','0',291,NULL,'ok','2017-01-25 13:22:43','2017-01-25 13:22:43'),(105,'34563456','8629298858846158888','deactivate','0',291,NULL,'ok','2017-01-25 13:23:19','2017-01-25 13:23:19'),(106,'0465465465400','8894793329832303275','activate','0',300,NULL,'ok','2017-01-27 16:03:06','2017-01-27 16:03:06'),(107,'1-821-509-9002','85555555555555999','deactivate','0',280,NULL,'ok','2017-01-30 08:10:18','2017-01-30 08:10:18'),(108,'0465465465400','85555555555555555','deactivate','0',300,NULL,'ok','2017-01-30 08:10:33','2017-01-30 08:10:33'),(109,'05235235234555','866666666666999','activate','0',293,NULL,'ok','2017-01-30 08:10:48','2017-01-30 08:10:48'),(110,'011111111112','86666666666688899','activate','0',294,NULL,'ok','2017-01-30 08:11:03','2017-01-30 08:11:03'),(111,'011111111111','866666666666777','activate','0',295,NULL,'ok','2017-01-30 08:11:18','2017-01-30 08:11:18'),(112,'0523543434565555','8809177776936982567','activate','0',297,NULL,'ok','2017-01-30 08:11:33','2017-01-30 08:11:33'),(113,'19024672082','866666666666666','activate','0',299,NULL,'ok','2017-01-30 08:11:48','2017-01-30 08:11:48'),(114,'34563456','8736256565544555555','activate','4',298,1,'ok','2017-01-30 09:56:05','2017-01-30 14:41:29'),(115,'19024672082','8629298858846150495','deactivate','4',299,1,'ok','2017-01-30 10:02:34','2017-01-30 14:41:29'),(116,'011111111112','85555555555555777','deactivate','0',294,NULL,'ok','2017-02-03 13:57:20','2017-02-03 13:57:20'),(117,'05235235234555','8629298858846157776','deactivate','L',293,NULL,'ok','2017-02-06 13:15:26','2017-02-06 13:15:26'),(118,'34563456','8629298858846158888','deactivate','L',298,NULL,'ok','2017-02-13 09:11:53','2017-02-13 09:11:53'),(119,'0523543434565555','8629298858846158877','deactivate','L',297,NULL,'ok','2017-02-13 09:12:02','2017-02-13 09:12:02'),(120,'011111111111','85555555555555888','deactivate','L',295,NULL,'ok','2017-02-13 09:12:10','2017-02-13 09:12:10'),(121,'1-821-509-9002','86666666666688899','activate','L',335,NULL,'ok','2017-02-13 09:12:53','2017-02-13 09:12:53'),(122,'1-821-509-9002','85555555555555999','deactivate','L',335,NULL,'ok','2017-02-13 09:13:12','2017-02-13 09:13:12'),(123,'123123213','866666666666999','activate','L',339,NULL,'ok','2017-02-13 09:18:22','2017-02-13 09:18:22'),(124,'123123213','8555289798844210066','deactivate','L',339,NULL,'ok','2017-02-13 09:18:51','2017-02-13 09:18:51'),(125,'123123213','866666666666999','activate','L',340,NULL,'ok','2017-02-13 09:24:03','2017-02-13 09:24:03'),(126,'123123213','8555289798844210066','deactivate','L',340,NULL,'ok','2017-02-13 09:24:27','2017-02-13 09:24:27'),(127,'123123213','866666666666999','activate','L',342,NULL,'ok','2017-02-13 09:38:17','2017-02-13 09:38:17'),(128,'123123213','8555289798844210066','deactivate','L',342,NULL,'ok','2017-02-13 09:38:37','2017-02-13 09:38:37'),(129,'123123213','866666666666111','activate','4',341,1,'ok','2017-02-13 13:47:24','2017-02-16 10:45:24'),(130,'123123213','8555289798844210066','deactivate','4',341,1,'ok','2017-02-13 13:48:41','2017-02-16 10:45:24'),(131,'123123213','866666666666111','activate','L',343,1,'3','2017-02-13 15:23:40','2017-02-16 10:43:15'),(132,'123123213','8555289798844210066','deactivate','L',343,1,'3','2017-02-15 05:46:57','2017-02-16 10:43:15'),(133,'123123213','866666666666999','activate','L',344,NULL,'3','2017-02-16 08:45:51','2017-02-16 12:31:16'),(134,'123123213','8555289798844210066','deactivate','3',344,NULL,'unchecked','2017-03-23 14:27:40','2017-03-23 14:27:40');

UNLOCK TABLES;

/*Table structure for table `customers` */

DROP TABLE IF EXISTS `customers`;

CREATE TABLE `customers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Country` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `City` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `zip` int(11) NOT NULL,
  `is_deleted` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `customers` */

LOCK TABLES `customers` WRITE;

UNLOCK TABLES;

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8_unicode_ci NOT NULL,
  `queue` text COLLATE utf8_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `failed_jobs` */

LOCK TABLES `failed_jobs` WRITE;

UNLOCK TABLES;

/*Table structure for table `jobs` */

DROP TABLE IF EXISTS `jobs`;

CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8_unicode_ci NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_reserved_at_index` (`queue`,`reserved_at`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `jobs` */

LOCK TABLES `jobs` WRITE;

insert  into `jobs`(`id`,`queue`,`payload`,`attempts`,`reserved_at`,`available_at`,`created_at`) values (1,'default','{\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":1:{s:11:\\\"\\u0000*\\u0000mailable\\\";O:22:\\\"App\\\\Mail\\\\notifications\\\":16:{s:8:\\\"\\u0000*\\u0000order\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":2:{s:5:\\\"class\\\";s:16:\\\"App\\\\Models\\\\Order\\\";s:2:\\\"id\\\";i:344;}s:7:\\\"\\u0000*\\u0000from\\\";a:0:{}s:5:\\\"\\u0000*\\u0000to\\\";a:1:{i:0;a:2:{s:7:\\\"address\\\";s:20:\\\"narek@horizondvp.com\\\";s:4:\\\"name\\\";N;}}s:5:\\\"\\u0000*\\u0000cc\\\";a:0:{}s:6:\\\"\\u0000*\\u0000bcc\\\";a:0:{}s:10:\\\"\\u0000*\\u0000replyTo\\\";a:0:{}s:10:\\\"\\u0000*\\u0000subject\\\";N;s:7:\\\"\\u0000*\\u0000view\\\";N;s:11:\\\"\\u0000*\\u0000textView\\\";N;s:11:\\\"\\u0000*\\u0000viewData\\\";a:0:{}s:14:\\\"\\u0000*\\u0000attachments\\\";a:0:{}s:17:\\\"\\u0000*\\u0000rawAttachments\\\";a:0:{}s:12:\\\"\\u0000*\\u0000callbacks\\\";a:0:{}s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;}}\"}}',0,NULL,1490272060,1490272060),(2,'default','{\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":1:{s:11:\\\"\\u0000*\\u0000mailable\\\";O:22:\\\"App\\\\Mail\\\\notifications\\\":16:{s:8:\\\"\\u0000*\\u0000order\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":2:{s:5:\\\"class\\\";s:16:\\\"App\\\\Models\\\\Order\\\";s:2:\\\"id\\\";i:346;}s:7:\\\"\\u0000*\\u0000from\\\";a:0:{}s:5:\\\"\\u0000*\\u0000to\\\";a:1:{i:0;a:2:{s:7:\\\"address\\\";s:20:\\\"narek@horizondvp.com\\\";s:4:\\\"name\\\";N;}}s:5:\\\"\\u0000*\\u0000cc\\\";a:0:{}s:6:\\\"\\u0000*\\u0000bcc\\\";a:0:{}s:10:\\\"\\u0000*\\u0000replyTo\\\";a:0:{}s:10:\\\"\\u0000*\\u0000subject\\\";N;s:7:\\\"\\u0000*\\u0000view\\\";N;s:11:\\\"\\u0000*\\u0000textView\\\";N;s:11:\\\"\\u0000*\\u0000viewData\\\";a:0:{}s:14:\\\"\\u0000*\\u0000attachments\\\";a:0:{}s:17:\\\"\\u0000*\\u0000rawAttachments\\\";a:0:{}s:12:\\\"\\u0000*\\u0000callbacks\\\";a:0:{}s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;}}\"}}',0,NULL,1490272093,1490272093);

UNLOCK TABLES;

/*Table structure for table `languages` */

DROP TABLE IF EXISTS `languages`;

CREATE TABLE `languages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ISO` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_eng` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_original` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `languages` */

LOCK TABLES `languages` WRITE;

UNLOCK TABLES;

/*Table structure for table `manual_activations` */

DROP TABLE IF EXISTS `manual_activations`;

CREATE TABLE `manual_activations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `phone_number` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sim_number` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `call` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `old_time` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `order_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `manual_activations` */

LOCK TABLES `manual_activations` WRITE;

insert  into `manual_activations`(`id`,`phone_number`,`sim_number`,`call`,`old_time`,`order_id`,`created_at`,`updated_at`) values (1,'0123','54234254','activate','1789654123',216,'2017-01-19 17:14:25','2017-01-19 17:14:29'),(2,'20',NULL,'activate','1484690400',268,'2017-01-19 15:30:46','2017-01-19 15:30:46'),(3,'34','46','activate','1484690400',266,'2017-01-19 15:31:53','2017-01-19 15:31:53'),(4,'20','44','deactivate','19/01/2017 23:00',268,'2017-01-19 15:37:44','2017-01-19 15:37:44'),(5,'20','48','deactivate','11/01/2017 00:00',265,'2017-01-19 15:38:37','2017-01-19 15:38:37'),(6,'34','46','deactivate','19/01/2017 00:00',266,'2017-01-19 15:39:00','2017-01-19 15:39:00'),(7,'25','48','activate','19/01/2017 00:00',270,'2017-01-19 15:40:46','2017-01-19 15:40:46'),(8,'25','48','deactivate','22/01/2017 02:30',270,'2017-01-19 15:40:59','2017-01-19 15:40:59'),(9,'25','48','activate','20/01/2017 03:00',271,'2017-01-20 11:03:45','2017-01-20 11:03:45'),(10,'25','48','deactivate','21/01/2017 08:00',271,'2017-01-20 12:18:22','2017-01-20 12:18:22'),(11,'29','46','activate','20/01/2017 01:15',272,'2017-01-20 12:19:35','2017-01-20 12:19:35'),(12,'29','46','deactivate','21/01/2017 00:30',272,'2017-01-20 13:07:29','2017-01-20 13:07:29'),(13,'25','48','activate','20/01/2017 00:00',273,'2017-01-20 13:39:53','2017-01-20 13:39:53'),(14,'25','48','deactivate','22/01/2017 00:30',273,'2017-01-20 13:41:56','2017-01-20 13:41:56'),(15,'25','48','activate','20/01/2017 00:00',274,'2017-01-20 13:46:35','2017-01-20 13:46:35'),(16,'25','48','deactivate','22/01/2017 00:30',274,'2017-01-20 13:47:55','2017-01-20 13:47:55'),(17,'25','48','activate','20/01/2017 02:30',275,'2017-01-20 13:52:08','2017-01-20 13:52:08'),(18,'25','48','deactivate','22/01/2017 00:30',275,'2017-01-20 13:53:31','2017-01-20 13:53:31'),(19,'25','48','activate','20/01/2017 00:00',276,'2017-01-20 14:27:56','2017-01-20 14:27:56'),(20,'25','48','deactivate','21/01/2017 00:00',276,'2017-01-20 14:28:59','2017-01-20 14:28:59'),(21,'25','48','activate','17/02/2017 16:00',277,'2017-01-23 12:03:17','2017-01-23 12:03:17'),(22,'25','48','deactivate','18/02/2017 03:00',277,'2017-01-23 12:03:30','2017-01-23 12:03:30'),(23,'25','48','activate','29/01/2017 06:00',278,'2017-01-24 11:12:52','2017-01-24 11:12:52'),(24,'25','48','deactivate','31/01/2017 23:45',278,'2017-01-24 11:15:08','2017-01-24 11:15:08'),(25,'25','46','activate','24/01/2017 02:00',279,'2017-01-24 12:42:13','2017-01-24 12:42:13'),(26,'20','48','activate','24/01/2017 00:00',280,'2017-01-24 14:39:13','2017-01-24 14:39:13'),(27,'25','46','deactivate','25/01/2017 00:00',279,'2017-01-25 13:16:18','2017-01-25 13:16:18'),(28,'25','39','activate','01/02/2017 23:45',288,'2017-01-25 13:17:36','2017-01-25 13:17:36'),(29,'25','39','deactivate','02/02/2017 23:30',288,'2017-01-25 13:18:56','2017-01-25 13:18:56'),(30,'25','46','activate','26/01/2017 23:45',290,'2017-01-25 13:21:32','2017-01-25 13:21:32'),(31,'25','46','deactivate','27/01/2017 23:30',290,'2017-01-25 13:22:10','2017-01-25 13:22:10'),(32,'25','18','activate','26/01/2017 23:45',291,'2017-01-25 13:22:38','2017-01-25 13:22:38'),(33,'25','18','deactivate','27/01/2017 23:30',291,'2017-01-25 13:23:14','2017-01-25 13:23:14'),(34,'35','17','activate','27/01/2017 00:00',300,'2017-01-27 16:03:01','2017-01-27 16:03:01'),(35,'25','21','activate','03/02/2017 00:00',298,'2017-01-30 09:56:00','2017-01-30 09:56:00'),(36,'12','41','deactivate','28/01/2017 21:45',299,'2017-01-30 10:02:29','2017-01-30 10:02:29'),(37,'34','44','deactivate','27/01/2017 22:45',294,'2017-02-03 13:57:15','2017-02-03 13:57:15'),(40,'28','46','deactivate','27/01/2017 22:45',293,'2017-02-06 13:15:21','2017-02-06 13:15:21'),(41,'25','21','deactivate','05/03/2017 22:45',298,'2017-02-13 09:11:48','2017-02-13 09:11:48'),(42,'30','39','deactivate','31/01/2017 22:45',297,'2017-02-13 09:11:57','2017-02-13 09:11:57'),(43,'33','42','deactivate','28/01/2017 22:45',295,'2017-02-13 09:12:05','2017-02-13 09:12:05'),(44,'20','44','activate','08/02/2017 01:15',335,'2017-02-13 09:12:48','2017-02-13 09:12:48'),(45,'20','44','deactivate','08/02/2017 23:45',335,'2017-02-13 09:13:07','2017-02-13 09:13:07'),(46,'11','46','activate','16/02/2017 23:00',339,'2017-02-13 09:18:17','2017-02-13 09:18:17'),(47,'11','46','deactivate','18/02/2017 23:45',339,'2017-02-13 09:18:46','2017-02-13 09:18:46'),(48,'11','46','activate','16/02/2017 23:00',340,'2017-02-13 09:23:58','2017-02-13 09:23:58'),(49,'11','46','deactivate','17/02/2017 23:45',340,'2017-02-13 09:24:22','2017-02-13 09:24:22'),(50,'11','46','activate','13/02/2017 23:45',342,'2017-02-13 09:38:12','2017-02-13 09:38:12'),(51,'11','46','deactivate','14/02/2017 23:00',342,'2017-02-13 09:38:32','2017-02-13 09:38:32'),(52,'11','48','activate','19/02/2017 23:45',341,'2017-02-13 13:47:19','2017-02-13 13:47:19'),(53,'11','48','deactivate','20/02/2017 23:00',341,'2017-02-13 13:48:36','2017-02-13 13:48:36'),(54,'11','48','activate','14/02/2017 23:00',343,'2017-02-13 15:23:35','2017-02-13 15:23:35'),(55,'11','48','deactivate','15/02/2017 23:45',343,'2017-02-15 09:49:52','2017-02-15 09:49:52'),(56,'11','46','activate','16/02/2017 00:15',344,'2017-02-16 08:45:46','2017-02-16 08:45:46'),(57,'11','46','deactivate','17/02/2017 23:45',344,'2017-03-23 14:27:14','2017-03-23 14:27:14');

UNLOCK TABLES;

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `migrations` */

LOCK TABLES `migrations` WRITE;

insert  into `migrations`(`id`,`migration`,`batch`) values (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2016_11_01_134904_create_Customers_table',1),(4,'2016_11_01_134904_create_Orders_table',1),(5,'2016_11_01_134904_create_Packages_table',1),(6,'2016_11_01_134904_create_SIMs_table',1),(7,'2016_11_01_134905_create_Languiges_table',1),(8,'2016_11_01_134905_create_Phones_table',1),(9,'2016_11_04_080249_create_providers_table',1),(10,'2016_06_01_000001_create_oauth_auth_codes_table',2),(11,'2016_06_01_000002_create_oauth_access_tokens_table',2),(12,'2016_06_01_000003_create_oauth_refresh_tokens_table',2),(13,'2016_06_01_000004_create_oauth_clients_table',2),(14,'2016_06_01_000005_create_oauth_personal_access_clients_table',2),(15,'2017_01_17_091128_create_jobs_table',3),(16,'2017_01_17_103857_create_failed_jobs_table',4);

UNLOCK TABLES;

/*Table structure for table `oauth_access_tokens` */

DROP TABLE IF EXISTS `oauth_access_tokens`;

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `client_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_access_tokens_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `oauth_access_tokens` */

LOCK TABLES `oauth_access_tokens` WRITE;

UNLOCK TABLES;

/*Table structure for table `oauth_auth_codes` */

DROP TABLE IF EXISTS `oauth_auth_codes`;

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `scopes` text COLLATE utf8_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `oauth_auth_codes` */

LOCK TABLES `oauth_auth_codes` WRITE;

UNLOCK TABLES;

/*Table structure for table `oauth_clients` */

DROP TABLE IF EXISTS `oauth_clients`;

CREATE TABLE `oauth_clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `redirect` text COLLATE utf8_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_clients_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `oauth_clients` */

LOCK TABLES `oauth_clients` WRITE;

insert  into `oauth_clients`(`id`,`user_id`,`name`,`secret`,`redirect`,`personal_access_client`,`password_client`,`revoked`,`created_at`,`updated_at`) values (1,NULL,'Laravel Personal Access Client','ifnQi4xB18JRwgowXvWMjQ8Ebsf9BkgCycbgIZAj','http://localhost',1,0,0,'2016-11-08 07:13:56','2016-11-08 07:13:56'),(2,NULL,'Laravel Password Grant Client','igoY3uPYMrtIdN5p38IpWq1tq3jrnL8y5KBpK8Hc','http://localhost',0,1,0,'2016-11-08 07:13:56','2016-11-08 07:13:56'),(3,NULL,'test','TdOjLaSeHfPEqapwAvaZkRpC56vdn5aPEYSH9qRQ','http://localhost/auth/callback',0,0,0,'2016-11-08 08:29:36','2016-11-08 08:29:36');

UNLOCK TABLES;

/*Table structure for table `oauth_personal_access_clients` */

DROP TABLE IF EXISTS `oauth_personal_access_clients`;

CREATE TABLE `oauth_personal_access_clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_personal_access_clients_client_id_index` (`client_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `oauth_personal_access_clients` */

LOCK TABLES `oauth_personal_access_clients` WRITE;

insert  into `oauth_personal_access_clients`(`id`,`client_id`,`created_at`,`updated_at`) values (1,1,'2016-11-08 07:13:56','2016-11-08 07:13:56');

UNLOCK TABLES;

/*Table structure for table `oauth_refresh_tokens` */

DROP TABLE IF EXISTS `oauth_refresh_tokens`;

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `oauth_refresh_tokens` */

LOCK TABLES `oauth_refresh_tokens` WRITE;

UNLOCK TABLES;

/*Table structure for table `order_phone` */

DROP TABLE IF EXISTS `order_phone`;

CREATE TABLE `order_phone` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `phone_id` int(10) unsigned DEFAULT NULL,
  `order_id` int(10) unsigned DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `order_phone` */

LOCK TABLES `order_phone` WRITE;

insert  into `order_phone`(`id`,`phone_id`,`order_id`) values (1,19,4),(2,19,7),(3,17,16),(4,15,9),(5,14,23),(6,14,27),(7,13,25),(8,11,1),(9,15,43),(10,15,44),(11,15,48);

UNLOCK TABLES;

/*Table structure for table `orders` */

DROP TABLE IF EXISTS `orders`;

CREATE TABLE `orders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `from` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `to` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `landing` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `departure` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone_id` int(10) unsigned DEFAULT NULL,
  `sim_id` int(10) unsigned DEFAULT NULL,
  `package_id` int(11) unsigned NOT NULL,
  `reference_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remark` text COLLATE utf8_unicode_ci,
  `costumer_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) unsigned NOT NULL,
  `updated_by` int(11) unsigned NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=348 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `orders` */

LOCK TABLES `orders` WRITE;

insert  into `orders`(`id`,`from`,`to`,`landing`,`departure`,`status`,`phone_id`,`sim_id`,`package_id`,`reference_number`,`remark`,`costumer_number`,`created_by`,`updated_by`,`updated_at`,`created_at`,`deleted_at`) values (262,'1483236000','1483747200','01/01/2017 00:00','07/01/2017 00:00','done',25,48,22,'','',NULL,7,7,'2017-01-17 15:59:19','2017-01-17 12:31:01','2017-01-17 15:59:19'),(263,'1484427600','1484524800','15/01/2017 00:00','16/01/2017 00:00','done',20,46,21,'','',NULL,7,7,'2017-01-17 15:59:08','2017-01-17 12:32:11','2017-01-17 15:59:08'),(265,'1483912800','1484092800','09/01/2017 00:00','19/01/2017 15:38','done',20,48,21,'','',NULL,30,30,'2017-02-21 13:59:30','2017-01-18 08:02:33','2017-02-21 13:59:30'),(266,'1484694000','1484784000','18/01/2017 01:00','19/01/2017 15:39','done',34,46,29,'','',NULL,30,30,'2017-01-24 10:56:32','2017-01-18 08:44:35',NULL),(267,'1484787600','1484798400','19/01/2017 03:00','19/01/2017 04:00','done',20,44,21,'','',NULL,30,30,'2017-01-24 10:56:32','2017-01-18 09:30:59',NULL),(268,'1484694000','1484866800','18/01/2017 01:00','19/01/2017 15:37','done',20,44,21,'123','Hi there',NULL,20,30,'2017-01-24 10:56:32','2017-01-18 14:40:46',NULL),(269,'1484866800','1485473400','20/01/2017 01:00','26/01/2017 23:30','done',25,42,22,'','',NULL,20,20,'2017-01-24 10:56:32','2017-01-18 14:41:23',NULL),(270,'1484833200','1485052200','19/01/2017 15:40','19/01/2017 15:40','done',25,48,22,'','',NULL,30,30,'2017-01-24 10:56:32','2017-01-19 15:40:38',NULL),(271,'1484902980','1484985600','20/01/2017 11:03','20/01/2017 12:18','done',25,48,22,'','',NULL,30,30,'2017-01-24 10:56:32','2017-01-20 09:29:08',NULL),(272,'1484907540','1484958600','20/01/2017 12:19','20/01/2017 13:07','done',29,46,23,'','',NULL,30,30,'2017-01-24 10:56:32','2017-01-20 11:00:02',NULL),(273,'1484650800','1484694000','17/01/2017 13:00','17/01/2017 21:00','done',25,48,22,'','',NULL,30,30,'2017-01-24 10:56:32','2017-01-20 13:12:41',NULL),(274,'1484912760','1485045000','20/01/2017 13:46','20/01/2017 13:47','done',25,48,22,'','',NULL,30,30,'2017-01-24 14:00:28','2017-01-20 13:43:09','2017-01-24 14:00:28'),(275,'1484913120','1485045000','20/01/2017 13:52','20/01/2017 13:53','done',25,48,22,'','',NULL,30,30,'2017-01-24 10:56:32','2017-01-20 13:51:16',NULL),(276,'1484949300','1484956800','20/01/2017 23:55','21/01/2017 00:05','done',25,48,22,'','',NULL,30,30,'2017-01-24 10:56:32','2017-01-20 14:20:53',NULL),(277,'1484575200','1487300400','16/01/2017 16:00','17/01/2017 03:00','done',25,48,22,'','',NULL,30,30,'2017-01-24 10:56:32','2017-01-23 12:02:16',NULL),(278,'1485249120','1485249308','24/01/2017 11:12','24/01/2017 11:15','done',25,48,22,'','',NULL,30,30,'2017-01-24 11:15:13','2017-01-24 11:10:06',NULL),(279,'1485254520','1485342979','24/01/2017 12:42','25/01/2017 13:16','done',25,46,22,'','',NULL,30,30,'2017-01-25 13:16:24','2017-01-24 12:42:08',NULL),(280,'1485261540','1485396000','24/01/2017 14:39','26/01/2017 02:00','done',20,48,21,'','',NULL,20,20,'2017-01-30 08:10:18','2017-01-24 14:04:49',NULL),(281,'1485378000','1485557100','26/01/2017 00:00','27/01/2017 22:45','deleted',34,44,29,'','',NULL,30,30,'2017-01-25 12:34:31','2017-01-25 12:31:47','2017-01-25 12:34:31'),(282,'1485378000','1485479700','26/01/2017 00:00','27/01/2017 01:15','deleted',0,44,29,'','',NULL,30,30,'2017-01-25 12:50:11','2017-01-25 12:46:47','2017-01-25 12:50:11'),(283,'1485378000','1485557100','26/01/2017 00:00','27/01/2017 22:45','deleted',34,42,29,'','',NULL,30,30,'2017-01-25 12:48:22','2017-01-25 12:47:48','2017-01-25 12:48:22'),(284,'1485550800','1485729900','28/01/2017 00:00','29/01/2017 22:45','deleted',34,42,29,'','',NULL,30,30,'2017-01-25 12:49:53','2017-01-25 12:49:14','2017-01-25 12:49:53'),(285,'1485550800','1485729900','28/01/2017 00:00','29/01/2017 22:45','deleted',0,41,29,'','',NULL,30,30,'2017-01-25 12:50:08','2017-01-25 12:49:47','2017-01-25 12:50:08'),(286,'1485381600','1485479700','26/01/2017 01:00','27/01/2017 01:15','deleted',0,44,29,'','',NULL,30,30,'2017-01-25 13:04:37','2017-01-25 13:01:51','2017-01-25 13:04:37'),(287,'1485378000','1485479700','26/01/2017 00:00','27/01/2017 01:15','deleted',34,44,29,'','',NULL,30,30,'2017-01-25 13:56:46','2017-01-25 13:09:11','2017-01-25 13:56:46'),(288,'1485343020','1485343136','25/01/2017 13:17','25/01/2017 13:18','done',25,39,22,'','',NULL,30,30,'2017-01-25 13:19:01','2017-01-25 13:15:27',NULL),(289,'1485981900','1486078200','01/02/2017 23:45','02/02/2017 23:30','deleted',25,46,22,'','',NULL,30,30,'2017-01-25 13:21:11','2017-01-25 13:17:58','2017-01-25 13:21:11'),(290,'1485343260','1485343330','25/01/2017 13:21','25/01/2017 13:22','done',25,46,22,'','',NULL,30,30,'2017-01-25 13:22:15','2017-01-25 13:21:25',NULL),(291,'1485343320','1485343394','25/01/2017 13:22','25/01/2017 13:23','done',25,18,22,'','',NULL,30,30,'2017-01-25 13:23:19','2017-01-25 13:21:53',NULL),(292,'1485463500','1485559800','26/01/2017 23:45','27/01/2017 23:30','deleted',25,17,22,'','',NULL,30,30,'2017-01-25 13:56:36','2017-01-25 13:22:51','2017-01-25 13:56:36'),(293,'1485381600','1486379721','26/01/2017 00:00','06/02/2017 13:15','done',28,46,29,'','',NULL,30,30,'2017-02-06 13:15:26','2017-01-25 13:58:52',NULL),(294,'1485381600','1486123035','26/01/2017 00:00','03/02/2017 13:57','done',34,44,29,'','',NULL,30,30,'2017-02-03 13:57:20','2017-01-25 14:01:12',NULL),(295,'1485468000','1486969925','27/01/2017 00:00','13/02/2017 09:12','done',33,42,21,'','',NULL,30,30,'2017-02-13 09:12:10','2017-01-27 10:20:12',NULL),(296,'1485464400','1485643500','27/01/2017 00:00','28/01/2017 22:45','deleted',25,41,22,'','',NULL,30,30,'2017-01-27 10:30:14','2017-01-27 10:21:48','2017-01-27 10:30:14'),(297,'1485640800','1486969917','29/01/2017 00:00','13/02/2017 09:11','done',30,39,22,'','',NULL,30,30,'2017-02-13 09:12:02','2017-01-27 10:27:12',NULL),(298,'1485762960','1486969908','30/01/2017 09:56','13/02/2017 09:11','done',25,21,22,'kjkjkjkj','',NULL,30,30,'2017-02-13 09:11:53','2017-01-27 10:27:58',NULL),(299,'1485468000','1485763349','27/01/2017 00:00','30/01/2017 10:02','done',12,41,28,'','',NULL,30,30,'2017-01-30 10:02:34','2017-01-27 10:34:31',NULL),(300,'1485525780','1485639900','27/01/2017 16:03','28/01/2017 21:45','done',35,17,22,'','',NULL,30,30,'2017-01-30 08:10:33','2017-01-27 10:34:56',NULL),(301,'1485467100','1485643500','27/01/2017 00:45','28/01/2017 22:45','deleted',0,1,22,'','',NULL,7,7,'2017-01-27 15:53:11','2017-01-27 11:06:50','2017-01-27 15:53:11'),(302,'1485986400','1489103100','02/02/2017 01:00','09/03/2017 23:45','deleted',0,48,22,'','',NULL,20,20,'2017-02-08 09:51:42','2017-01-31 17:13:11','2017-02-08 09:51:42'),(305,'1486071900','1486251000','03/02/2017 00:45','04/02/2017 23:30','deleted',0,29,22,'some number','',NULL,30,30,'2017-02-06 13:09:16','2017-02-02 09:06:19','2017-02-06 13:09:16'),(306,'1486098000','1486134000','03/02/2017 10:00','03/02/2017 15:00','deleted',20,20,21,'','',NULL,30,30,'2017-02-06 15:23:49','2017-02-02 11:12:42','2017-02-06 15:23:49'),(307,'1486584000','1486764000','09/02/2017 01:00','10/02/2017 22:00','deleted',12,44,28,'','',NULL,30,30,'2017-02-06 13:09:06','2017-02-03 14:36:50','2017-02-06 13:09:06'),(308,'1486065600','1486338300','03/02/2017 01:00','05/02/2017 23:45','deleted',0,18,22,'','',NULL,30,30,'2017-02-06 10:32:26','2017-02-03 14:42:04','2017-02-06 10:32:26'),(309,'1486062900','1486256400','03/02/2017 00:15','05/02/2017 01:00','deleted',12,17,28,'','',NULL,30,30,'2017-02-06 10:32:35','2017-02-03 14:42:59','2017-02-06 10:32:35'),(310,'1486238400','1486597500','05/02/2017 01:00','08/02/2017 23:45','deleted',0,16,22,'1234','',NULL,30,30,'2017-02-06 10:32:22','2017-02-03 14:45:29','2017-02-06 10:32:22'),(311,'1486322100','1486597500','06/02/2017 00:15','08/02/2017 23:45','deleted',13,14,28,'','',NULL,30,30,'2017-02-06 10:32:32','2017-02-06 09:08:56','2017-02-06 10:32:32'),(335,'1486969920','1486969987','13/02/2017 09:12','13/02/2017 09:13','done',20,44,21,'','',NULL,30,30,'2017-02-13 09:13:12','2017-02-08 10:00:21',NULL),(339,'1486970280','1486970326','13/02/2017 09:18','13/02/2017 09:18','done',11,46,21,'','',NULL,30,30,'2017-02-13 09:18:51','2017-02-13 09:17:24',NULL),(340,'1486970580','1486970662','13/02/2017 09:23','13/02/2017 09:24','done',11,46,21,'','',NULL,30,30,'2017-02-13 09:34:17','2017-02-13 09:20:13',NULL),(341,'1486986420','1486986516','13/02/2017 13:47','13/02/2017 13:48','done',11,48,21,'','',NULL,30,30,'2017-02-13 13:48:41','2017-02-13 09:23:39',NULL),(342,'1486971480','1486971512','13/02/2017 09:38','13/02/2017 09:38','done',11,46,21,'','',NULL,30,30,'2017-02-13 09:38:54','2017-02-13 09:38:01',NULL),(343,'1486992180','1487144992','13/02/2017 15:23','15/02/2017 09:49','done',11,48,21,'','',NULL,7,7,'2017-02-15 09:49:57','2017-02-13 15:23:09',NULL),(344,'1487227500','1490272034','16/02/2017 08:45','23/03/2017 14:27','done',11,46,21,'some long reference numbre for testing the field','',NULL,30,30,'2017-03-23 14:27:40','2017-02-16 08:42:52',NULL),(345,'1487793600','1487875500','22/02/2017 23:00','23/02/2017 23:45','pending',11,48,21,'','',NULL,30,30,'2017-02-21 14:06:16','2017-02-21 14:06:16',NULL),(346,'1487796300','1487872800','22/02/2017 23:45','23/02/2017 23:00','pending',39,44,23,'','',NULL,30,30,'2017-03-23 14:28:13','2017-02-21 14:06:56',NULL),(347,'1488405600','1488480300','02/03/2017 01:00','02/03/2017 23:45','pending',11,52,21,'','',NULL,30,30,'2017-02-27 13:31:36','2017-02-27 13:31:36',NULL);

UNLOCK TABLES;

/*Table structure for table `packages` */

DROP TABLE IF EXISTS `packages`;

CREATE TABLE `packages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `provider_id` int(11) NOT NULL,
  `is_active` int(10) unsigned DEFAULT NULL,
  `status` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `packages` */

LOCK TABLES `packages` WRITE;

insert  into `packages`(`id`,`type_code`,`name`,`description`,`provider_id`,`is_active`,`status`,`deleted_at`,`created_at`,`updated_at`) values (21,'А1427','Package 1','8 Mb Data id 21  + SMS',1,1,'Enable',NULL,NULL,NULL),(22,'А1426','Package 2','8 Mb Data Unlimited local Call + SMS',1,0,NULL,NULL,NULL,'2017-02-27 15:10:21'),(23,'А1425','Package 3','23 Mb Data Unlimited local Call + - SMS',1,1,NULL,NULL,NULL,'2017-02-27 15:11:34');

UNLOCK TABLES;

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `password_resets` */

LOCK TABLES `password_resets` WRITE;

UNLOCK TABLES;

/*Table structure for table `phones` */

DROP TABLE IF EXISTS `phones`;

CREATE TABLE `phones` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `initial_sim_id` int(11) unsigned NOT NULL,
  `current_sim_id` int(11) unsigned NOT NULL,
  `package_id` int(11) unsigned DEFAULT NULL,
  `provider_id` int(11) unsigned DEFAULT NULL,
  `is_special` int(11) unsigned NOT NULL DEFAULT '0',
  `is_active` int(11) unsigned NOT NULL DEFAULT '1',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `phones_phone_unique` (`phone`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `phones` */

LOCK TABLES `phones` WRITE;

insert  into `phones`(`id`,`phone`,`state`,`initial_sim_id`,`current_sim_id`,`package_id`,`provider_id`,`is_special`,`is_active`,`deleted_at`,`created_at`,`updated_at`) values (11,'123123213','pending',14,14,21,1,0,1,NULL,NULL,'2017-03-23 14:27:40'),(12,'019024672082','not in use',12,12,21,1,0,1,NULL,NULL,'2017-02-27 13:53:06'),(13,'19605858051','not in use',13,13,21,1,0,1,NULL,NULL,'2017-02-27 13:52:38'),(14,'987654321','not in use',15,15,21,1,0,1,'2017-01-27 14:19:18',NULL,'2017-01-27 14:19:18'),(15,'5821456','not in use',11,11,21,1,0,1,'2017-01-27 14:18:19',NULL,'2017-01-27 14:18:19'),(16,'16383650425','not in use',16,16,21,1,0,1,'2017-01-27 14:18:19',NULL,'2017-01-27 14:18:19'),(17,'2936417256','not in use',34,17,21,1,0,1,'2017-02-27 09:08:02',NULL,'2017-02-27 09:08:02'),(18,'18407245433','not in use',18,18,21,1,1,1,NULL,NULL,'2017-02-23 15:33:06'),(19,'05935072666','not in use',19,19,21,1,1,1,NULL,NULL,'2017-02-22 15:15:32'),(20,'18215099002','not in use',49,49,21,1,0,1,NULL,NULL,'2017-02-13 09:13:12'),(25,'34563456','not in use',23,23,21,1,0,1,NULL,'2016-12-12 07:55:52','2017-02-13 09:11:53'),(26,'045234523452','not in use',28,28,21,1,0,1,'2017-01-27 14:26:05','2016-12-16 15:53:23','2017-01-27 14:26:05'),(27,'52352352345','not in use',32,32,21,1,0,1,NULL,'2016-12-16 15:55:44','2016-12-28 15:19:19'),(28,'05235234555','not in use',25,25,21,1,0,1,NULL,'2016-12-16 15:55:58','2017-02-06 13:15:26'),(29,'052356565555','not in use',38,38,21,1,1,1,'2017-02-24 07:27:08','2016-12-16 15:57:00','2017-02-24 07:27:08'),(30,'052434565555','not in use',27,27,21,1,1,1,NULL,'2016-12-16 15:57:20','2017-02-13 09:12:02'),(32,'065454654654','not in use',24,24,21,1,1,1,NULL,'2016-12-23 16:21:41','2017-01-27 16:24:01'),(33,'011111111111','not in use',47,47,21,1,1,1,NULL,'2017-01-17 15:40:30','2017-02-13 09:12:10'),(34,'011111111112','not in use',45,45,21,2,1,1,NULL,'2017-01-17 15:40:30','2017-02-03 13:57:20'),(35,'0465465400','not in use',40,40,21,1,1,1,NULL,'2017-01-17 15:41:28','2017-01-30 08:10:33'),(36,'0789456123','not in use',22,22,21,1,0,1,NULL,'2017-02-22 13:37:28','2017-02-22 13:37:28'),(37,'0789456128','not in use',43,43,21,1,0,1,NULL,'2017-02-22 13:37:41','2017-02-22 13:37:41'),(38,'0789456125','not in use',50,50,21,1,0,1,NULL,'2017-02-22 13:37:51','2017-02-22 13:37:51'),(39,'0789456127','pending',26,26,23,1,0,1,NULL,'2017-02-22 13:38:01','2017-03-23 14:28:13');

UNLOCK TABLES;

/*Table structure for table `pl_name_user` */

DROP TABLE IF EXISTS `pl_name_user`;

CREATE TABLE `pl_name_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `pl_name_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `pl_name_user` */

LOCK TABLES `pl_name_user` WRITE;

insert  into `pl_name_user`(`id`,`user_id`,`pl_name_id`) values (58,30,3);

UNLOCK TABLES;

/*Table structure for table `pl_names` */

DROP TABLE IF EXISTS `pl_names`;

CREATE TABLE `pl_names` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cost_pl_name_id` int(10) unsigned DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `provider_id` int(10) unsigned DEFAULT NULL,
  `cost` double unsigned DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `pl_names` */

LOCK TABLES `pl_names` WRITE;

insert  into `pl_names`(`id`,`name`,`cost_pl_name_id`,`created_by`,`provider_id`,`cost`,`updated_at`,`created_at`,`deleted_at`) values (1,'Default_cost',NULL,0,1,1,'2017-03-24 15:48:27','2017-03-15 17:26:21',NULL),(2,'Default',1,0,1,5,'2017-03-23 13:32:21','2017-03-15 17:27:08',NULL),(3,'SuperAdmin',1,0,1,6,'2017-03-24 15:20:47','2017-03-20 11:10:04',NULL),(4,'Default',5,0,2,11,'2017-03-23 14:05:22','2017-03-20 11:54:33',NULL),(5,'Default_cost',NULL,0,2,8,'2017-03-23 14:05:11','2017-03-20 11:56:23',NULL);

UNLOCK TABLES;

/*Table structure for table `price_lists` */

DROP TABLE IF EXISTS `price_lists`;

CREATE TABLE `price_lists` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pl_name_id` int(10) unsigned DEFAULT NULL,
  `package_id` int(10) unsigned NOT NULL,
  `cost` double unsigned DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `price_lists` */

LOCK TABLES `price_lists` WRITE;

insert  into `price_lists`(`id`,`pl_name_id`,`package_id`,`cost`,`updated_at`,`deleted_at`,`created_at`) values (1,1,22,2,'2017-03-24 15:48:38',NULL,'2017-03-15 17:30:52'),(2,1,21,2,'2017-03-24 15:48:34',NULL,'2017-03-15 17:32:37'),(3,1,23,2,'2017-03-24 15:48:42',NULL,'2017-03-15 17:32:57'),(4,2,21,10,'2017-03-24 15:48:57',NULL,'2017-03-15 17:34:06'),(5,2,22,10,'2017-03-23 13:33:06',NULL,'2017-03-15 17:34:33'),(6,2,23,10,'2017-03-24 15:49:02',NULL,'2017-03-15 17:35:03'),(7,3,21,9,'2017-03-24 15:20:51',NULL,'2017-03-20 15:46:29'),(8,3,22,7.7,'2017-03-24 15:20:59',NULL,'2017-03-20 15:46:44'),(9,3,23,12,'2017-03-20 15:46:53',NULL,'2017-03-20 15:46:54');

UNLOCK TABLES;

/*Table structure for table `providers` */

DROP TABLE IF EXISTS `providers`;

CREATE TABLE `providers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `providers` */

LOCK TABLES `providers` WRITE;

insert  into `providers`(`id`,`name`,`code`,`deleted_at`,`created_at`,`updated_at`) values (1,'Vodafone','8',NULL,'2016-11-24 12:53:57','2016-11-24 12:54:00'),(2,'Orange','5',NULL,NULL,NULL);

UNLOCK TABLES;

/*Table structure for table `reports` */

DROP TABLE IF EXISTS `reports`;

CREATE TABLE `reports` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(10) unsigned DEFAULT NULL,
  `duration` int(10) unsigned DEFAULT NULL,
  `daily_sell_price` double unsigned DEFAULT NULL,
  `total_sell_price` double unsigned DEFAULT NULL,
  `sim_sell_price` double unsigned DEFAULT NULL,
  `package_cost` double unsigned DEFAULT NULL,
  `total_package_cost` double unsigned DEFAULT NULL,
  `sim_cost` double unsigned DEFAULT NULL,
  `total_profit` double unsigned DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `reports` */

LOCK TABLES `reports` WRITE;

UNLOCK TABLES;

/*Table structure for table `sims` */

DROP TABLE IF EXISTS `sims`;

CREATE TABLE `sims` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `state` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `provider_id` int(11) unsigned NOT NULL,
  `phone_id` int(11) unsigned DEFAULT NULL,
  `is_parking` int(10) unsigned DEFAULT '0',
  `user_id` int(11) unsigned DEFAULT NULL,
  `is_active` int(11) unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `sims` */

LOCK TABLES `sims` WRITE;

insert  into `sims`(`id`,`state`,`number`,`provider_id`,`phone_id`,`is_parking`,`user_id`,`is_active`,`deleted_at`,`created_at`,`updated_at`) values (1,'available','8680806516165194700',1,5,0,21,1,NULL,NULL,'2017-01-27 15:53:11'),(2,'available','8809123146936982567',1,6,0,24,1,NULL,NULL,'2016-12-19 08:08:16'),(3,'available','8722722683583105155',1,10,0,2,1,NULL,NULL,'2016-12-08 05:21:35'),(4,'available','8499656697856220938',1,9,0,19,1,NULL,NULL,'2016-12-14 14:59:09'),(5,'available','8258450278575568651',1,5,0,19,1,NULL,NULL,'2016-12-15 16:27:07'),(6,'available','8878243040309747559',1,10,0,27,1,NULL,NULL,'2016-12-16 12:38:11'),(7,'available','8443685882458416190',1,9,0,6,1,NULL,NULL,'2016-12-19 08:08:17'),(8,'available','8766267833986166387',1,8,0,10,0,NULL,NULL,'2016-12-07 15:11:32'),(9,'available','8666712643649515296',1,7,0,28,1,NULL,NULL,'2017-02-06 12:51:49'),(10,'available','8970602700912824833',1,8,0,4,0,NULL,NULL,'2017-02-06 12:51:25'),(11,'parking','8479768997754135080',1,3,1,4,1,NULL,NULL,NULL),(12,'parking','8629298858846150495',1,3,1,18,1,NULL,NULL,NULL),(13,'available','8215750682424517468',1,7,0,14,1,NULL,NULL,'2017-03-02 10:07:40'),(14,'available','8555289798844210066',1,10,0,27,1,NULL,NULL,'2017-02-06 12:51:33'),(15,'parking','8407879037904546496',1,3,1,18,1,NULL,NULL,NULL),(16,'available','8898257124795575047',1,10,0,21,1,NULL,NULL,'2017-02-06 15:23:38'),(17,'available','8894793329832303275',1,4,0,20,1,NULL,NULL,'2017-02-06 15:23:41'),(18,'available','8349631059760235464',1,9,0,16,0,NULL,NULL,'2017-02-06 12:51:45'),(19,'parking','8986893210636792056',1,10,1,19,1,NULL,NULL,NULL),(20,'available','8753397432615853442',1,1,0,21,1,NULL,NULL,'2017-02-07 13:10:49'),(21,'available','8736256565544555555',1,1,0,2,1,NULL,NULL,'2017-02-13 09:11:53'),(22,'parking','8479766697754138888',1,NULL,1,NULL,1,NULL,'2016-12-08 07:51:29','2016-12-08 07:51:29'),(23,'parking','8629298858846158888',1,NULL,1,NULL,1,NULL,'2016-12-08 07:51:29','2016-12-08 07:51:29'),(24,'parking','8629298858846157777',1,NULL,0,NULL,1,NULL,'2016-12-08 10:59:53','2016-12-08 10:59:53'),(25,'parking','8629298858846157776',1,NULL,0,NULL,1,NULL,'2016-12-08 11:00:38','2016-12-08 11:00:38'),(26,'parking','8479766697754138817',1,NULL,1,NULL,1,NULL,'2016-12-08 12:14:11','2016-12-09 05:58:53'),(27,'parking','8629298858846158877',1,NULL,1,NULL,1,NULL,'2016-12-08 12:14:11','2016-12-09 06:04:23'),(28,'parking','535345345345345345345',1,NULL,0,NULL,1,NULL,'2016-12-16 15:44:01','2016-12-16 15:44:01'),(29,'available','535345345345345345444',1,NULL,0,NULL,1,NULL,'2016-12-16 15:46:52','2017-02-13 09:12:57'),(30,'available','853453453453455435',1,NULL,0,NULL,1,NULL,'2016-12-16 15:57:58','2016-12-28 14:40:35'),(31,'available','85345345345453455435',1,NULL,0,NULL,1,NULL,'2016-12-16 15:58:17','2017-02-27 13:52:05'),(32,'parking','85345345388453455435',1,NULL,0,NULL,1,NULL,'2016-12-16 15:59:01','2016-12-16 15:59:01'),(33,'available','85345898388453455435',1,NULL,0,NULL,1,NULL,'2016-12-16 15:59:15','2017-02-27 13:52:38'),(34,'parking','7987987987987987987',1,NULL,0,NULL,NULL,NULL,'2016-12-23 16:22:49','2016-12-23 16:22:49'),(38,'parking','87777777777777',1,NULL,0,NULL,NULL,NULL,'2017-01-16 14:33:17','2017-01-16 14:33:17'),(39,'available','8809177776936982567',1,NULL,0,NULL,NULL,NULL,'2017-01-16 14:37:33','2017-02-27 13:53:06'),(40,'parking','85555555555555555',1,NULL,0,NULL,NULL,NULL,'2017-01-16 14:37:33','2017-01-16 14:37:33'),(41,'parking','866666666666666',1,NULL,0,NULL,NULL,'2017-03-02 10:08:19','2017-01-16 14:44:51','2017-03-02 10:08:19'),(42,'parking','866666666666777',1,NULL,0,NULL,NULL,NULL,'2017-01-16 15:05:21','2017-02-24 12:56:41'),(43,'parking','85555555555555666',1,NULL,0,NULL,NULL,NULL,'2017-01-16 15:05:29','2017-01-16 15:05:29'),(44,'pending','86666666666688899',1,NULL,0,NULL,NULL,NULL,'2017-01-16 15:06:42','2017-02-21 14:06:56'),(45,'parking','85555555555555777',1,NULL,0,NULL,NULL,NULL,'2017-01-16 15:06:47','2017-01-16 15:06:47'),(46,'available','866666666666999',1,NULL,0,NULL,NULL,NULL,'2017-01-16 15:12:06','2017-03-23 14:27:40'),(47,'parking','85555555555555888',1,NULL,0,NULL,NULL,NULL,'2017-01-16 15:12:15','2017-01-16 15:12:15'),(48,'pending','866666666666111',1,NULL,0,NULL,NULL,NULL,'2017-01-16 15:15:20','2017-02-21 14:06:16'),(49,'parking','85555555555555999',1,NULL,0,NULL,NULL,NULL,'2017-01-16 15:15:32','2017-01-16 15:15:32'),(50,'parking','822211221121212112121',1,NULL,0,NULL,NULL,NULL,'2017-01-17 15:44:53','2017-03-02 10:07:36'),(51,'parking','654654654654654',1,NULL,0,NULL,NULL,NULL,'2017-02-22 15:40:30','2017-02-22 15:40:30'),(52,'pending','49684335463547777',1,NULL,0,NULL,NULL,NULL,'2017-02-24 09:14:12','2017-02-27 13:31:36');

UNLOCK TABLES;

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `level` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `supervisor_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `time_zone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `network` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pl_name_id` int(11) DEFAULT '1',
  `sim_balance` int(11) DEFAULT NULL,
  `phone_balance` int(11) DEFAULT NULL,
  `is_active` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `users` */

LOCK TABLES `users` WRITE;

insert  into `users`(`id`,`login`,`level`,`type`,`supervisor_id`,`name`,`email`,`password`,`logo`,`time_zone`,`network`,`email2`,`pl_name_id`,`sim_balance`,`phone_balance`,`is_active`,`deleted_at`,`remember_token`,`created_at`,`updated_at`) values (7,'Wilmer','Dealer','admin',20,'Alexanne Robel','maryam59@gmail.com','$2y$10$/oVM9LaQ7Yw9Xr5Bt.8WQ.3ZWNwpXbznPMW78J6E92X0HDer.zVUO','images/avatars/3e5dcf6e56e442925b8c5b02f264d3d2.jpg','Europe/Kaliningrad','[7,15,18]','bboehm@satterfield.com',1,5,10,1,NULL,'HhUAVJYTX6y0pZGmbHgxeI4uc0MB4wcrClPz4QKJmAPDkFJWKzwBW7bNAWda',NULL,'2017-03-10 13:15:36'),(15,'Myrtis','Dealer','manager',7,'Dr. Neha Harris','nader.tevin@hotmail.com','$2y$10$gWfL3o50jevpstiI8b1tJ.y8MIA.NdQeQTSZMGpvVwopeR8JE1nou','images/avatars/3e5dcf6e56e442925b8c5b02f264d3d2.jpg','Africa/Bangui','[7,15,18]','smckenzie@schowalter.com',1,5,10,1,NULL,'24aSwNSjRTltDcTGlzOERPwYOVDCj01h69PBZ7G0DBEdNdkjs4kvUO5ewQ7c',NULL,'2017-03-10 13:15:36'),(18,'Leon','Dealer','employee',7,'Felipa Pacocha','bella.leannon@bergstrom.biz','$2y$10$ZtwwpQee1OxoBrU5K5ic4.BUEvIa93onhyVzgcJkEVmlyj1Z.JVJK','images/avatars/3e5dcf6e56e442925b8c5b02f264d3d2.jpg','America/North_Dakota/Beulah','[7,15,18]','anderson64@koepp.com',1,5,10,1,NULL,'QseXYUPglWsa0hVYPsgw6CIdD2MVGb514sUgeKC8pyutOYyd3CA9WGwcsSe4',NULL,'2017-03-10 13:15:36'),(20,'Vallie','Distributor','admin',30,'Vallie Champlin','mhessel@fay.com','$2y$10$nRE6W.pkLl/3brrsNIo13Oj.oPxAJDZjAzZngXrk4RNHTo2r1ettu','images/avatars/3e5dcf6e56e442925b8c5b02f264d3d2.jpg','Africa/Nouakchott','[20,15,18,7,25,29]','kleffler@pouros.com',1,5,10,1,NULL,'vVPNZC4frjW6oQpY68gHlnCdb9WFvlMHnLD9WPW60eUgKRVnGJL8FtDVHrFV',NULL,'2017-03-22 15:45:57'),(25,'Holly','Distributor','manager',20,'Liam Gibson','zane94@hotmail.com','$2y$10$kvg.IDJR3N3lmSpmGIUddOLAV46xL68wdV4/WV.3nPppVGCEvKC96','images/avatars/3e5dcf6e56e442925b8c5b02f264d3d2.jpg','Asia/Krasnoyarsk','[20,15,18,7,25,29]','sienna02@yahoo.com',1,5,10,1,NULL,'CwpzN25VD3gqh6FlzlZvYXb9HRXj7hZLSyd6efKAFOZf4cfyiIL4lhxJWgwp',NULL,'2017-03-22 08:16:21'),(29,'Tamia','Distributor','employee',20,'Carlos Emard','estrella.greenholt@stroman.com','$2y$10$wGRuprmgAqXtjqJj0PH.U.6flYpXsDqtJqUQdbd6kT4RV3fbM1jHa','images/avatars/3e5dcf6e56e442925b8c5b02f264d3d2.jpg','Pacific/Kosrae','[20,15,18,7,25,29]','baby.lang@yahoo.com',1,5,10,1,NULL,'eekAwaEuYXJMZUWsiUEzGjdOxAqkhxlgV2kyeg9K6UAzjhBAh6WqtHpOfByU',NULL,'2017-03-10 13:15:37'),(30,'Alanis','Super admin','admin',0,'Carlos Emard','narek@horizondvp.com','$2y$10$Pre8Ww.7DwB.XVx4Zixxre0B40r.oIp05pBa2v89Mlm2X5EuUCQ9m','images/avatars/3e5dcf6e56e442925b8c5b02f264d3d2.jpg','Pacific/Kosrae','[30,15,18,7,25,29,20,32,33,31,36,38,40,41,35,51,34]','narek@horizondvp.com',1,5,10,1,NULL,'auYdBoJymGzEhtimtVTO9P6UmaNcb1wscGps9PtUJEcHjuFISlwgUT7G45SH',NULL,'2017-03-24 14:17:23'),(31,'Baloo','Dealer','admin',34,'Seraphim','sadfa@jfgh.com','$2y$10$xDnmoM3vtUtxckCT.7Q06O9A8A7DMFOFHwM66tzGI4/TSTa2vWjXq',NULL,NULL,'[31,32,33]','hfkkdl@hkd.com',1,NULL,NULL,1,NULL,'osM7IDxq5nOvYm0GQfyjxmffpyz0aT6fPjA8rSI4IZDlUy4dsHtvpB4uSkPm','2016-11-17 13:03:27','2017-03-03 14:03:17'),(32,'Baloo2','Subdealer','admin',31,'Seraphim2','sadf2a@jfgh.com','$2y$10$dq2zN0jTh6Dk3xnQ.ma5S.C28TC.UhM4CDApeWv9pg1K0fvIAQ0.e',NULL,NULL,'[32]','hfkk2dl@hkd.com',1,NULL,NULL,1,NULL,'RGpudfOvI2VCyWLlsykj14SDQt8g309wKz44ogRGoOiVEG5IUWv0qaxiAgAc','2016-11-17 13:35:01','2017-03-03 14:03:18'),(33,'Baloo3','Subdealer','admin',31,'Seraphim3','sadf3a@jfgh.com','$2y$10$x15sOYiNmJIHcYE.ja1d8eD1ZPqA2PiconKOae/TJgmLxI2YFxjhW',NULL,NULL,'[33]','hfkk3dl@hkd.com',1,NULL,NULL,1,NULL,'gK2p9YRXX1dEbuumCOKN72e6VbB3D6XiY8YihAUcM0HiB08YHPMMxnetKlgT','2016-11-17 14:06:20','2017-03-15 12:32:26'),(34,'Baloo5','Distributor','admin',30,'Seraphim5','sadf5a@jfgh.com','$2y$10$acr31dB3OxTDARf2D3PxOeoAFK5sJirjb1FJgSkqzXpYB88Viguye',NULL,NULL,'[34,32,33,31,36,38,40,41,35,51]','hfkk5dl@hkd.com',1,NULL,NULL,1,NULL,'a6ZWXAYkf1Jeu3cz1fRzxKmiMhTTMyBoqnGFGYKtpNki9aYgO22CQ6ANmG5O','2016-11-17 14:30:29','2017-03-22 08:21:30'),(35,'Baloo6','Subdealer','admin',51,'Seraphim6','sadf6a@jfgh.com','$2y$10$285zPhxYt3TWNJYWzo3uOegSuJxELgTTUPMq5blye7VqwtNOOZgF2',NULL,NULL,'[35]','hfkk6dl@hkd.com',1,NULL,NULL,1,NULL,NULL,'2016-11-17 14:41:24','2017-03-03 14:03:18'),(36,'Baloo7','Dealer','admin',34,'Seraphim7','sadf7a@jfgh.com','$2y$10$8OFJFfIbcZU/JpLdy2K4aOvapapcS9MUj.AZ0YVuUQODKBWnFp6qq',NULL,NULL,'[36]','hfkk7dl@hkd.com',1,NULL,NULL,1,NULL,NULL,'2016-11-18 13:57:35','2017-03-03 14:03:18'),(38,'nik2','Dealer','admin',34,'Nicky2','niki2@niki.com','password',NULL,NULL,'[38]','niki3@niki.com',1,NULL,NULL,1,NULL,NULL,'2016-11-30 06:51:13','2017-03-03 14:03:18'),(40,'kmm','Dealer','admin',34,'kmm','test@test.com','$2y$10$apPSyczPE6hZ5cE9GSG3v.78/lpEpxXBBRaI.orPxoPhLPuUrgsQ2',NULL,NULL,'[40]','test@test.com',1,NULL,NULL,1,NULL,NULL,'2017-01-09 09:15:09','2017-03-03 14:03:18'),(41,'kmm2','Dealer','admin',34,'kmm2','test2@test.com','$2y$10$uTXYz/CP8G/pncLO9l/WouTXaf6Dm38LK.qd5L9Wz8LCEuQ1qOKBu',NULL,NULL,'[41]','test2@test.com',1,NULL,NULL,1,NULL,'FKkiFFD6DZOdr4ON1zBplAkdkwXD2VsJpFFRUTTCGsG4bB8vQu6IM13qDvia','2017-01-09 09:15:59','2017-03-15 12:27:27'),(51,'baloob','Dealer','admin',34,'baloo baloo','baloob@l.com','$2y$10$RTBfvT195Seb02p.64TU9Oyhn0xwNsSgZbz1BC/sMOodCeVTjeF/q',NULL,NULL,'[51,35]','',1,NULL,NULL,1,NULL,NULL,'2017-03-06 14:21:27','2017-03-06 14:36:22');

UNLOCK TABLES;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
