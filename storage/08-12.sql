/*
SQLyog Ultimate v9.50 
MySQL - 5.7.16-0ubuntu0.16.04.1 : Database - rentsim
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
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

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `migrations` */

LOCK TABLES `migrations` WRITE;

insert  into `migrations`(`id`,`migration`,`batch`) values (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2016_11_01_134904_create_Customers_table',1),(4,'2016_11_01_134904_create_Orders_table',1),(5,'2016_11_01_134904_create_Packages_table',1),(6,'2016_11_01_134904_create_SIMs_table',1),(7,'2016_11_01_134905_create_Languiges_table',1),(8,'2016_11_01_134905_create_Phones_table',1),(9,'2016_11_04_080249_create_providers_table',1),(10,'2016_06_01_000001_create_oauth_auth_codes_table',2),(11,'2016_06_01_000002_create_oauth_access_tokens_table',2),(12,'2016_06_01_000003_create_oauth_refresh_tokens_table',2),(13,'2016_06_01_000004_create_oauth_clients_table',2),(14,'2016_06_01_000005_create_oauth_personal_access_clients_table',2);

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
  `landing` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `departure` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `reference_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remark` text COLLATE utf8_unicode_ci,
  `costumer_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `package_id` int(11) unsigned NOT NULL,
  `created_by` int(11) unsigned NOT NULL,
  `updated_by` int(11) unsigned NOT NULL,
  `sim_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `phone_id` int(10) unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `orders` */

LOCK TABLES `orders` WRITE;

insert  into `orders`(`id`,`from`,`to`,`landing`,`departure`,`reference_number`,`status`,`remark`,`costumer_number`,`package_id`,`created_by`,`updated_by`,`sim_id`,`created_at`,`updated_at`,`phone_id`,`deleted_at`) values (1,'1481174386','1480686600','1480686600','1480686600','3105877843','pending','Nisi consequatur ipsam qui aliquam cum. Ullam molestias voluptas voluptas. Perferendis consequatur quasi quia non quia.','16',30,10,20,4,NULL,NULL,11,NULL),(41,'1481174386','1481174506','1482673140','1482068340','ref12345','finished','new Order',NULL,30,30,30,2,'2016-12-06 14:08:47','2016-12-08 05:21:35',11,'2016-12-08 05:21:35'),(42,'1481174386','1481174506','1482673140','1482068340','ref12345','finished','new Order',NULL,27,30,30,3,'2016-12-06 14:10:28','2016-12-08 05:21:35',14,'2016-12-08 05:21:35'),(43,'1481174386','1481174506','1482673140','1482068340','ref12345','finished','new Order',NULL,28,30,30,6,'2016-12-06 14:17:01','2016-12-08 05:21:35',15,'2016-12-08 05:21:35'),(44,'1481174386','1481174506','1482673140','1482068340','ref12345','finished','new Order',NULL,28,30,30,7,'2016-12-06 14:17:24','2016-12-08 05:21:35',15,'2016-12-08 05:21:35'),(48,'1481174386','1481174506','1482240840','1482413640','ref12345','finished','new Order',NULL,28,30,30,13,'2016-12-06 14:40:56','2016-12-08 05:21:35',15,'2016-12-08 05:21:35'),(49,'1481174386','1481174506','1481376840','1481463240','ref12345','finished','new Order',NULL,28,30,30,14,'2016-12-06 14:45:04','2016-12-08 05:21:35',12,'2016-12-08 05:21:35'),(55,'1481174386','1481174506','1481376840','1481463240','ref12345','finished','new Order',NULL,28,30,30,16,'2016-12-06 15:01:58','2016-12-08 05:21:35',15,'2016-12-08 05:21:35'),(56,'1481174386','1481174506','1481549640','1483104840','ref12345','finished','new Order',NULL,30,30,30,17,'2016-12-06 15:05:18','2016-12-08 05:21:36',18,'2016-12-08 05:21:36'),(57,'1481174386','1481174506','1481549640','1483104840','ref12345','finished','new Order',NULL,28,30,30,20,'2016-12-06 15:07:49','2016-12-08 05:21:36',13,'2016-12-08 05:21:36'),(58,'1481174386','1481174506','1483104840','1483191240','ref12345','finished','new Order',NULL,28,30,30,10,'2016-12-06 15:09:03','2016-12-08 05:21:36',15,'2016-12-08 05:21:36'),(59,'1481120503','1481123540','1483104840','1483191240','ref12345','finished','new Order',NULL,28,30,30,18,'2016-12-06 15:24:19','2016-12-07 15:11:31',12,'2016-12-07 15:11:31'),(63,'1481120503','1481123540','1482673140','1482068340','ref12345','finished','new Order',NULL,28,30,30,1,'2016-12-07 08:57:47','2016-12-07 15:11:32',15,'2016-12-07 15:11:32'),(66,'1481120503','1481123540','1478173020','1478000220','','finished','',NULL,23,30,30,8,'2016-12-07 11:41:00','2016-12-07 15:11:32',16,'2016-12-07 15:11:32'),(67,'1512710506','1544246506','1512710506','1544246506','1481193000','pending','',NULL,28,30,30,9,'2016-12-07 11:42:24','2016-12-07 15:18:00',15,NULL),(69,'1481193000','1481794200','1481796000','1481191200','123456','pending','',NULL,28,30,30,21,'2016-12-08 05:44:23','2016-12-08 05:44:23',15,NULL),(70,'1481865840','1482097200','1481867640','1482095400','321654','pending','',NULL,28,30,30,20,'2016-12-08 05:55:42','2016-12-08 05:55:42',15,NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `packages` */

LOCK TABLES `packages` WRITE;

insert  into `packages`(`id`,`type_code`,`name`,`description`,`provider_id`,`is_active`,`status`,`deleted_at`,`created_at`,`updated_at`) values (21,'А1427','Package 1','8 Mb Data id 21  + SMS',1,1,'Enable','0000-00-00 00:00:00',NULL,NULL),(22,'А1426','Package 2','8 Mb Data Unlimited local Call + SMS',1,0,'Disable','0000-00-00 00:00:00',NULL,NULL),(23,'А1425','Package 3','23 Mb Data Unlimited local Call + SMS',1,1,'Enable','0000-00-00 00:00:00',NULL,NULL),(24,'А1424','Package 4','24 Mb Data Unlimited local Call + SMS',1,1,'Disable','0000-00-00 00:00:00',NULL,NULL),(25,'А1427','Package 5','25 Mb Data Unlimited local Call + SMS',1,1,'Enable','0000-00-00 00:00:00',NULL,NULL),(26,'А1427','Package 6','8 Mb Data Unlimited local Call + SMS',1,0,'Disable','0000-00-00 00:00:00',NULL,NULL),(27,'А1427','Package 7','27 Mb Data Unlimited local Call + SMS',1,1,'Enable','0000-00-00 00:00:00',NULL,NULL),(28,'А1427','Package 8','28 Mb Data Unlimited local Call + SMS',1,1,'Enable','0000-00-00 00:00:00',NULL,NULL),(29,'А1427','Package 9','8 Mb Data Unlimited local Call + SMS',1,0,'Enable','0000-00-00 00:00:00',NULL,NULL),(30,'А1427','Package 10','8 Mb Data Unlimited local Call + SMS',1,0,'Disable','0000-00-00 00:00:00',NULL,NULL),(31,'A1245','pack 1','8 Mb Data Unlimited local Call + SMS',1,0,'Enable',NULL,'2016-12-02 05:56:16','2016-12-02 05:56:16'),(32,'A1243','pack 2','8 Mb Data Unlimited local Call + SMS',1,0,'Enable',NULL,'2016-12-02 05:56:57','2016-12-02 05:56:57'),(33,'A6698','type 1','8 Mb Data Unlimited local Call + SMS',1,0,'Enable',NULL,'2016-12-02 07:25:54','2016-12-02 07:25:54'),(34,'A6578','Type 7','8 Mb Data Unlimited local Call + SMS',1,0,'Enable',NULL,'2016-12-02 07:32:05','2016-12-02 07:32:05');

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
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `phones` */

LOCK TABLES `phones` WRITE;

insert  into `phones`(`id`,`phone`,`state`,`initial_sim_id`,`current_sim_id`,`package_id`,`provider_id`,`is_special`,`is_active`,`deleted_at`,`created_at`,`updated_at`) values (11,'123123213','pending',14,14,30,1,0,1,NULL,NULL,'2016-12-08 05:21:35'),(12,'19024672082','not in use',12,12,28,1,0,1,'0000-00-00 00:00:00',NULL,'2016-12-08 05:21:35'),(13,'1 (960) 585-8051','not in use',13,13,28,1,0,1,'0000-00-00 00:00:00',NULL,'2016-12-08 05:21:36'),(14,'987654321','not in use',15,15,27,1,0,1,NULL,NULL,'2016-12-08 05:21:35'),(15,'5821456','pending',11,11,28,1,0,1,NULL,NULL,'2016-12-08 05:21:35'),(16,'1.638.365.0425','not in use',16,16,23,1,0,1,'0000-00-00 00:00:00',NULL,'2016-12-07 15:11:32'),(17,'293 641-7256','not in use',17,17,28,1,0,1,'0000-00-00 00:00:00',NULL,NULL),(18,'1-840-724-5433','not in use',18,18,30,1,1,1,'0000-00-00 00:00:00',NULL,'2016-12-08 05:21:35'),(19,'593.507.2600','not in use',19,19,26,1,0,1,'0000-00-00 00:00:00',NULL,NULL),(20,'1-821-509-9002','not in use',20,20,21,1,0,1,'0000-00-00 00:00:00',NULL,NULL);

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
  `is_active` int(11) unsigned NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sims_number_unique` (`number`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `sims` */

LOCK TABLES `sims` WRITE;

insert  into `sims`(`id`,`state`,`number`,`provider_id`,`phone_id`,`is_parking`,`user_id`,`is_active`,`deleted_at`,`created_at`,`updated_at`) values (1,'available','8680806516165194700',1,5,0,21,1,NULL,NULL,'2016-12-07 15:11:31'),(2,'available','8809123146936982567',1,6,0,24,1,NULL,NULL,'2016-12-08 05:21:34'),(3,'available','8722722683583105155',1,10,0,2,1,NULL,NULL,'2016-12-08 05:21:35'),(4,'pending','8499656697856220938',1,9,0,19,1,NULL,NULL,NULL),(5,'available','8258450278575568651',1,5,0,19,1,NULL,NULL,'2016-12-07 11:51:13'),(6,'available','8878243040309747559',1,10,0,27,1,NULL,NULL,'2016-12-08 05:21:35'),(7,'available','8443685882458416190',1,9,0,6,1,NULL,NULL,'2016-12-08 05:21:35'),(8,'available','8766267833986166387',1,8,0,10,0,NULL,NULL,'2016-12-07 15:11:32'),(9,'pending','8666712643649515296',1,7,0,28,1,NULL,NULL,'2016-12-07 11:42:24'),(10,'available','8970602700912824833',1,8,0,4,0,NULL,NULL,'2016-12-08 05:21:36'),(11,'parking','8479768997754135080',1,3,1,4,1,NULL,NULL,NULL),(12,'parking','8629298858846150495',1,3,1,18,1,NULL,NULL,NULL),(13,'available','8215750682424517468',1,7,0,14,1,NULL,NULL,'2016-12-08 05:21:35'),(14,'available','8555289798844210066',1,10,0,27,1,NULL,NULL,'2016-12-08 05:21:35'),(15,'parking','8407879037904546496',1,3,1,18,1,NULL,NULL,NULL),(16,'available','8898257124795575047',1,10,0,21,1,NULL,NULL,'2016-12-08 05:21:35'),(17,'available','8894793329832303275',1,4,0,20,1,NULL,NULL,'2016-12-08 05:21:35'),(18,'available','8349631059760235464',1,9,0,16,0,NULL,NULL,'2016-12-07 15:03:45'),(19,'parking','8986893210636792056',1,10,1,19,1,NULL,NULL,NULL),(20,'pending','8753397432615853442',1,1,0,21,1,NULL,NULL,'2016-12-08 05:55:42'),(21,'pending','8736256565544555555',1,1,0,2,1,NULL,NULL,'2016-12-08 05:44:23'),(22,'parking','8479766697754138888',1,NULL,1,NULL,1,NULL,'2016-12-08 07:51:29','2016-12-08 07:51:29'),(23,'parking','8629298858846158888',1,NULL,1,NULL,1,NULL,'2016-12-08 07:51:29','2016-12-08 07:51:29');

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
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `language_id` int(11) DEFAULT NULL,
  `sim_balance` int(11) DEFAULT NULL,
  `phone_balance` int(11) DEFAULT NULL,
  `is_active` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `users` */

LOCK TABLES `users` WRITE;

insert  into `users`(`id`,`login`,`level`,`type`,`supervisor_id`,`name`,`email`,`password`,`logo`,`time_zone`,`phone`,`email2`,`language_id`,`sim_balance`,`phone_balance`,`is_active`,`deleted_at`,`remember_token`,`created_at`,`updated_at`) values (6,'Breanne','Subdealer','admin',7,'Dominique Berge','scrist@kunze.biz','$2y$10$WLF7SL3POVBi8YXFx18vZufPlzmEO3wY.OcvEhXHCsgQSPL0gWq0i','images/avatars/3e5dcf6e56e442925b8c5b02f264d3d2.jpg','Pacific/Guadalcanal','1-467-655-7053 x91003','eli22@gmail.com',1,5,10,1,NULL,NULL,NULL,NULL),(7,'Wilmer','Dealer','admin',20,'Alexanne Robel','maryam59@gmail.com','$2y$10$/oVM9LaQ7Yw9Xr5Bt.8WQ.3ZWNwpXbznPMW78J6E92X0HDer.zVUO','images/avatars/3e5dcf6e56e442925b8c5b02f264d3d2.jpg','Europe/Kaliningrad','(332) 284-0337 x150','bboehm@satterfield.com',1,5,10,1,NULL,'Wir8KHlPohxilM47foZkivWK5DgB2ndNH4ZHnIUP2HyMpWQo64XeN4w5laLS',NULL,'2016-11-29 11:54:13'),(10,'Priscilla','Subdealer','employee',6,'Naomie Hudson','xkilback@mitchell.info','$2y$10$Wrzf8CBhV/C3d4tg28GCdODYujoNyktUDFZdBiuS1s6XWWEdwGDHG','images/avatars/3e5dcf6e56e442925b8c5b02f264d3d2.jpg','Europe/Kiev','452.417.3576 x8847','avon@yahoo.com',1,5,10,1,NULL,'GaesonClU4Ie2nxCTdyUdJKkeadaRuzB5V64AXrGywamoSyruK4v4c9hIAbJ',NULL,'2016-11-24 07:31:17'),(15,'Myrtis','Dealer','manager',7,'Dr. Neha Harris','nader.tevin@hotmail.com','$2y$10$gWfL3o50jevpstiI8b1tJ.y8MIA.NdQeQTSZMGpvVwopeR8JE1nou','images/avatars/3e5dcf6e56e442925b8c5b02f264d3d2.jpg','Africa/Bangui','+1 (583) 382-7010','smckenzie@schowalter.com',1,5,10,1,NULL,NULL,NULL,NULL),(18,'Leon','Dealer','employee',7,'Felipa Pacocha','bella.leannon@bergstrom.biz','$2y$10$ZtwwpQee1OxoBrU5K5ic4.BUEvIa93onhyVzgcJkEVmlyj1Z.JVJK','images/avatars/3e5dcf6e56e442925b8c5b02f264d3d2.jpg','America/North_Dakota/Beulah','1-734-583-2185','anderson64@koepp.com',1,5,10,1,NULL,'FuEkCN4vEAG9YUy18f1gigp4AmP4qIx8BX7jyA2P3fZoRIxyN9GgOJbOQLsz',NULL,'2016-11-23 14:24:17'),(20,'Elroy','Distributor','admin',30,'Vallie Champlin','mhessel@fay.com','$2y$10$Slwl2.KALx6yj3/mM1UEG.vzcDwnrfXwtDz1Rly3aSU944q9c3GWq','images/avatars/3e5dcf6e56e442925b8c5b02f264d3d2.jpg','Africa/Nouakchott','953.695.9074 x17428','kleffler@pouros.com',1,5,10,1,NULL,'5abBTETnj5wLHla99IW8FdxFBrxWp0uybwGJdf39J08aBORnthhq8tuYmXlA',NULL,'2016-11-25 12:50:01'),(25,'Holly','Distributor','manager',20,'Liam Gibson','zane94@hotmail.com','$2y$10$kvg.IDJR3N3lmSpmGIUddOLAV46xL68wdV4/WV.3nPppVGCEvKC96','images/avatars/3e5dcf6e56e442925b8c5b02f264d3d2.jpg','Asia/Krasnoyarsk','+12835761094','sienna02@yahoo.com',1,5,10,1,NULL,'CXmHCEQFeyJaroLwzelzTJ3Y5YOAPWkDeTtqXfTshZdBmrXzB6C7hZl6VjYi',NULL,'2016-12-02 05:41:14'),(29,'Tamia','Distributor','employee',20,'Carlos Emard','estrella.greenholt@stroman.com','$2y$10$0ISH8xVfGMwmq.DXD5BCZu7QBJV32jaU7KkIktdNckWnZcE162872','images/avatars/3e5dcf6e56e442925b8c5b02f264d3d2.jpg','Pacific/Kosrae','+1-640-464-6642','baby.lang@yahoo.com',1,5,10,1,NULL,NULL,NULL,NULL),(30,'Alanis','Super admin','admin',0,'Carlos Emard','estrella.greenho2lt@stroman.com','$2y$10$0ISH8xVfGMwmq.DXD5BCZu7QBJV32jaU7KkIktdNckWnZcE162872','images/avatars/3e5dcf6e56e442925b8c5b02f264d3d2.jpg','Pacific/Kosrae','+1-640-464-6642','baby.la2ng@yahoo.com',1,5,10,1,NULL,'d4TT5VkAwVNtIDnQCpf650ObFLa2dQbSwWqRmZeXZPdETw3qzdAyww6oEmjH',NULL,'2016-12-08 05:38:08'),(31,'Baloo','Dealer','admin',30,'Seraphim','sadfa@jfgh.com','$2y$10$xDnmoM3vtUtxckCT.7Q06O9A8A7DMFOFHwM66tzGI4/TSTa2vWjXq',NULL,NULL,NULL,'hfkkdl@hkd.com',NULL,NULL,NULL,1,NULL,'osM7IDxq5nOvYm0GQfyjxmffpyz0aT6fPjA8rSI4IZDlUy4dsHtvpB4uSkPm','2016-11-17 13:03:27','2016-11-23 13:44:11'),(32,'Baloo2','Subdealer','admin',31,'Seraphim2','sadf2a@jfgh.com','$2y$10$dq2zN0jTh6Dk3xnQ.ma5S.C28TC.UhM4CDApeWv9pg1K0fvIAQ0.e',NULL,NULL,NULL,'hfkk2dl@hkd.com',NULL,NULL,NULL,1,NULL,'RGpudfOvI2VCyWLlsykj14SDQt8g309wKz44ogRGoOiVEG5IUWv0qaxiAgAc','2016-11-17 13:35:01','2016-11-23 13:19:01'),(33,'Baloo3','Subdealer','admin',31,'Seraphim3','sadf3a@jfgh.com','$2y$10$x15sOYiNmJIHcYE.ja1d8eD1ZPqA2PiconKOae/TJgmLxI2YFxjhW',NULL,NULL,NULL,'hfkk3dl@hkd.com',NULL,NULL,NULL,1,NULL,NULL,'2016-11-17 14:06:20','2016-11-17 14:06:20'),(34,'Baloo5','Distributor','admin',30,'Seraphim5','sadf5a@jfgh.com','$2y$10$acr31dB3OxTDARf2D3PxOeoAFK5sJirjb1FJgSkqzXpYB88Viguye',NULL,NULL,NULL,'hfkk5dl@hkd.com',NULL,NULL,NULL,1,NULL,NULL,'2016-11-17 14:30:29','2016-11-17 14:30:29'),(35,'Baloo6','Subdealer','admin',30,'Seraphim6','sadf6a@jfgh.com','$2y$10$285zPhxYt3TWNJYWzo3uOegSuJxELgTTUPMq5blye7VqwtNOOZgF2',NULL,NULL,NULL,'hfkk6dl@hkd.com',NULL,NULL,NULL,1,NULL,NULL,'2016-11-17 14:41:24','2016-11-17 14:41:24'),(36,'Baloo7','Dealer','admin',34,'Seraphim7','sadf7a@jfgh.com','$2y$10$8OFJFfIbcZU/JpLdy2K4aOvapapcS9MUj.AZ0YVuUQODKBWnFp6qq',NULL,NULL,NULL,'hfkk7dl@hkd.com',NULL,NULL,NULL,1,NULL,NULL,'2016-11-18 13:57:35','2016-11-18 13:57:35'),(37,'nik','Distributor','admin',30,'Nicky','niki@niki.com','password',NULL,NULL,NULL,'niki2@niki.com',1,NULL,NULL,1,NULL,NULL,'2016-11-30 06:38:03','2016-11-30 06:38:03'),(38,'nik2','Dealer','admin',37,'Nicky2','niki2@niki.com','password',NULL,NULL,NULL,'niki3@niki.com',1,NULL,NULL,1,NULL,NULL,'2016-11-30 06:51:13','2016-11-30 06:51:13');

UNLOCK TABLES;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
