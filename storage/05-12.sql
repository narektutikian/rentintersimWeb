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
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `orders` */

LOCK TABLES `orders` WRITE;

insert  into `orders`(`id`,`from`,`to`,`landing`,`departure`,`reference_number`,`status`,`remark`,`costumer_number`,`package_id`,`created_by`,`updated_by`,`sim_id`,`created_at`,`updated_at`,`phone_id`,`deleted_at`) values (1,'1480686600','1480686600','1480686600','1480686600','3105877843','Waiting','Nisi consequatur ipsam qui aliquam cum. Ullam molestias voluptas voluptas. Perferendis consequatur quasi quia non quia.','16',30,10,20,4,NULL,NULL,11,'0000-00-00 00:00:00'),(2,'1480686600','1480686600','1480686600','1480686600','6337186184','Waiting','Magni dolor omnis iusto repellat architecto. Nihil corrupti qui omnis eius doloremque. Ipsum voluptatem et repudiandae nobis aut. Qui eos quis aut minus adipisci.','32',30,30,30,5,NULL,NULL,0,'0000-00-00 00:00:00'),(3,'1480686600','1480686600','1480686600','1480686600','2978738111','Waiting','Voluptate exercitationem unde voluptatem reiciendis deleniti. Recusandae sed repudiandae quaerat accusantium officiis facilis magni temporibus. Dolorum quia sed aut rerum praesentium.','39',30,30,30,5,NULL,NULL,0,'0000-00-00 00:00:00'),(4,'1480686600','1480686600','1480686600','1480686600','2242478516','Pending','Id modi et voluptate ea velit repellendus tenetur. Amet debitis officia necessitatibus temporibus ea sunt magnam nihil. Est ut maiores debitis. Officiis ab omnis tempora maxime nisi facere nihil.','27',30,20,30,5,NULL,NULL,19,'0000-00-00 00:00:00'),(5,'1480686600','1480686600','1480686600','1480686600','5796445650','Pending','Quia quisquam officiis officiis eius qui quae sed sint. Nam quas nemo inventore optio maiores blanditiis ut neque.','19',30,30,30,5,NULL,NULL,0,'0000-00-00 00:00:00'),(6,'1480686600','1480686600','1480686600','1480686600','7348893686','Active','Et et tenetur consequatur. Voluptate eos fugiat non corrupti delectus. Ad asperiores expedita eum. Sunt dolores minima a consequuntur.','27',30,30,30,5,NULL,NULL,0,'0000-00-00 00:00:00'),(7,'1480686600','1480686600','1480686600','1480686600','2377331742','Active','Quis quas iusto est quos in. Perferendis quia laudantium sit autem distinctio. Quo quia recusandae aliquam ad aperiam illo.','22',30,30,30,3,NULL,NULL,19,'0000-00-00 00:00:00'),(8,'1480686600','1480686600','1480686600','1480686600','7848585379','Waiting','Sit dolore consequatur odit et ullam molestiae aut. Cumque et quos consequuntur ex illo deserunt dolorum eius. Sint ullam voluptatem atque veritatis consequuntur non.','7',30,30,30,5,NULL,NULL,0,'0000-00-00 00:00:00'),(9,'1480686600','1480686600','1480686600','1480686600','9624855609','Waiting','Ea placeat consectetur similique corporis optio tempora modi voluptatem. Quisquam reprehenderit asperiores laboriosam officiis assumenda doloribus est.','29',30,30,30,5,NULL,NULL,15,'0000-00-00 00:00:00'),(10,'1480686600','1480686600','1480686600','1480686600','3499991632','Waiting','Quis et maiores eaque doloribus quasi est. Debitis necessitatibus et fugiat. Consequatur cupiditate molestiae aspernatur voluptas.','22',30,30,30,5,NULL,NULL,0,'0000-00-00 00:00:00'),(11,'1480686600','1480686600','1480686600','1480686600','0079747396','Waiting','Voluptatum pariatur quia dolorem sit. Harum aut totam magni. Aut mollitia dolorum rerum et quis culpa ullam.','3',30,30,30,5,NULL,NULL,0,'0000-00-00 00:00:00'),(12,'1480686600','1480686600','1480686600','1480686600','7195494551','Waiting','Ipsa amet fugiat molestias recusandae nihil. In et vel id voluptates in accusantium. Dicta optio adipisci totam magni voluptatum sed et. Consequatur labore nulla sit sit vel eum adipisci.','33',30,30,30,5,NULL,NULL,0,'0000-00-00 00:00:00'),(13,'1480686600','1480686600','1480686600','1480686600','567197111X','Active','Molestiae libero in veritatis itaque. Qui voluptates impedit accusantium doloribus nostrum rem. Illum tenetur aliquid amet.','15',30,30,30,5,NULL,NULL,0,'0000-00-00 00:00:00'),(14,'1480686600','1480686600','1480686600','1480686600','4459340704','Pending','Non numquam nostrum reiciendis aperiam tempore aspernatur. Sit odio earum qui perferendis repellendus. Qui non soluta culpa dolorum labore aperiam.','20',30,30,30,2,NULL,NULL,0,'0000-00-00 00:00:00'),(15,'1480686600','1480686600','1480686600','1480686600','5567769644','Active','Voluptatem accusamus facere ipsam voluptatibus et. Illum optio voluptates vitae. Omnis praesentium aut consequuntur similique reprehenderit debitis.','19',30,30,30,5,NULL,NULL,0,'0000-00-00 00:00:00'),(16,'1480686600','1480686600','1480686600','1480686600','738110105X','Waiting','Qui optio ut sapiente cumque aliquid neque. Nihil tenetur quia ut minus est. Est et et aut veritatis a sed. Sapiente omnis totam quod et culpa.','33',30,30,30,5,NULL,NULL,17,'0000-00-00 00:00:00'),(17,'1480686600','1480686600','1480686600','1480686600','3777981222','Pending','Voluptatem quo earum atque corrupti. Optio possimus perspiciatis dignissimos est qui id dicta. Blanditiis sapiente ut sint nobis aliquid et.','30',30,30,30,5,NULL,NULL,0,'0000-00-00 00:00:00'),(18,'1480686600','1480686600','1480686600','1480686600','2533860107','Waiting','Voluptas sit rerum quisquam. Nulla facilis placeat dolorem fuga odit. Fugiat porro suscipit quidem non iure. Doloremque qui cum dolore aut quis iste.','5',30,30,30,5,NULL,NULL,0,'0000-00-00 00:00:00'),(19,'1480686600','1480686600','1480686600','1480686600','7975235733','Pending','Maiores unde itaque eaque mollitia possimus quia. Ut aut et est. Quis expedita labore velit ea blanditiis omnis autem.','33',30,30,30,5,NULL,NULL,0,'0000-00-00 00:00:00'),(20,'1480686600','1480686600','1480686600','1480686600','0340203994','Waiting','Quo a doloribus sed ab. Quos fugiat autem et aliquam accusamus debitis vel ipsa. Sed veniam reiciendis commodi explicabo repudiandae ut delectus omnis. Itaque ab quos laborum temporibus non itaque.','28',30,30,30,5,NULL,NULL,0,'0000-00-00 00:00:00'),(21,'1480686600','1480686600','1480686600','1480686600','21','Waiting','new Order',NULL,21,30,30,2,'2016-12-02 14:06:22','2016-12-02 14:06:22',0,NULL),(22,'1480686600','1480686600','1480686600','1480686600','21','Waiting','new Order',NULL,21,30,30,2,'2016-12-02 14:10:17','2016-12-02 14:10:17',0,NULL),(23,'1480686600','1480686600','1480686600','1480686600','28','Panding','new Order',NULL,28,30,30,2,'2016-12-02 14:13:14','2016-12-02 14:13:14',14,NULL),(24,'1481093700','1481093700','1481093700','1481070300','25','Waiting','hfklsdjfh klshdflk hsdflksdhf lkjhsdflk ',NULL,25,30,30,1,'2016-12-05 07:03:00','2016-12-05 07:03:00',0,NULL),(25,'1482877800','1481334900','1482879600','1481336700','25','Panding','some text',NULL,25,30,30,7,'2016-12-05 07:32:48','2016-12-05 07:32:48',13,NULL);

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

insert  into `packages`(`id`,`type_code`,`name`,`description`,`provider_id`,`is_active`,`status`,`deleted_at`,`created_at`,`updated_at`) values (21,'А1427','Package 1','8 Mb Data Unlimited local Call + SMS',1,1,'Enable','0000-00-00 00:00:00',NULL,NULL),(22,'А1426','Package 2','8 Mb Data Unlimited local Call + SMS',1,0,'Disable','0000-00-00 00:00:00',NULL,NULL),(23,'А1425','Package 3','8 Mb Data Unlimited local Call + SMS',1,1,'Enable','0000-00-00 00:00:00',NULL,NULL),(24,'А1424','Package 4','8 Mb Data Unlimited local Call + SMS',1,1,'Disable','0000-00-00 00:00:00',NULL,NULL),(25,'А1427','Package 5','8 Mb Data Unlimited local Call + SMS',1,1,'Enable','0000-00-00 00:00:00',NULL,NULL),(26,'А1427','Package 6','8 Mb Data Unlimited local Call + SMS',1,0,'Disable','0000-00-00 00:00:00',NULL,NULL),(27,'А1427','Package 7','8 Mb Data Unlimited local Call + SMS',1,1,'Enable','0000-00-00 00:00:00',NULL,NULL),(28,'А1427','Package 8','8 Mb Data Unlimited local Call + SMS',1,0,'Disable','0000-00-00 00:00:00',NULL,NULL),(29,'А1427','Package 9','8 Mb Data Unlimited local Call + SMS',1,0,'Enable','0000-00-00 00:00:00',NULL,NULL),(30,'А1427','Package 10','8 Mb Data Unlimited local Call + SMS',1,0,'Disable','0000-00-00 00:00:00',NULL,NULL),(31,'A1245','pack 1','8 Mb Data Unlimited local Call + SMS',1,0,'Enable',NULL,'2016-12-02 05:56:16','2016-12-02 05:56:16'),(32,'A1243','pack 2','8 Mb Data Unlimited local Call + SMS',1,0,'Enable',NULL,'2016-12-02 05:56:57','2016-12-02 05:56:57'),(33,'A6698','type 1','8 Mb Data Unlimited local Call + SMS',1,0,'Enable',NULL,'2016-12-02 07:25:54','2016-12-02 07:25:54'),(34,'A6578','Type 7','8 Mb Data Unlimited local Call + SMS',1,0,'Enable',NULL,'2016-12-02 07:32:05','2016-12-02 07:32:05');

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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `phones` */

LOCK TABLES `phones` WRITE;

insert  into `phones`(`id`,`phone`,`state`,`initial_sim_id`,`current_sim_id`,`package_id`,`provider_id`,`is_special`,`is_active`,`deleted_at`,`created_at`,`updated_at`) values (11,'928 687-0059','Active',11,1,21,1,0,1,'0000-00-00 00:00:00',NULL,NULL),(12,'+19024672082','Pending',12,2,25,1,0,1,'0000-00-00 00:00:00',NULL,NULL),(13,'+1 (960) 585-8051','Pending',13,3,25,1,0,1,'0000-00-00 00:00:00',NULL,'2016-12-05 07:32:48'),(14,'784351-2044','Not in use',14,4,28,1,1,1,'0000-00-00 00:00:00',NULL,'2016-12-02 14:13:13'),(15,'0528.485.4335','Pending',15,5,28,1,0,1,'0000-00-00 00:00:00',NULL,NULL),(16,'+1.638.365.0425','Pending',16,6,23,1,0,1,'0000-00-00 00:00:00',NULL,NULL),(17,'293 641-7256','Pending',17,7,27,1,0,1,'0000-00-00 00:00:00',NULL,NULL),(18,'1-840-724-5433','Pending',18,8,30,1,1,1,'0000-00-00 00:00:00',NULL,NULL),(19,'593.507.2600','Pending',19,9,26,1,0,1,'0000-00-00 00:00:00',NULL,NULL),(20,'+1-821-509-9002','Pending',20,10,21,1,0,1,'0000-00-00 00:00:00',NULL,NULL),(21,'099 10 10 10','Active',11,6,25,1,0,1,NULL,NULL,NULL);

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
  `phone_id` int(11) unsigned NOT NULL,
  `is_parking` int(10) unsigned DEFAULT '0',
  `user_id` int(11) unsigned NOT NULL,
  `is_active` int(11) unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sims_number_unique` (`number`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `sims` */

LOCK TABLES `sims` WRITE;

insert  into `sims`(`id`,`state`,`number`,`provider_id`,`phone_id`,`is_parking`,`user_id`,`is_active`,`deleted_at`,`created_at`,`updated_at`) values (1,'active','8680806516165194700',1,5,0,21,1,'0000-00-00 00:00:00',NULL,NULL),(2,'pending','8809123146936982567',1,6,0,24,1,'0000-00-00 00:00:00',NULL,'2016-12-02 14:13:14'),(3,'pending','8722722683583105155',1,10,0,2,1,'0000-00-00 00:00:00',NULL,NULL),(4,'available','8499656697856220938',1,9,0,19,1,'0000-00-00 00:00:00',NULL,NULL),(5,'available','8258450278575568651',1,5,0,19,1,'0000-00-00 00:00:00',NULL,NULL),(6,'pending','8878243040309747559',1,10,0,27,1,'0000-00-00 00:00:00',NULL,NULL),(7,'pending','8443685882458416190',1,9,0,6,1,'0000-00-00 00:00:00',NULL,'2016-12-05 07:32:48'),(8,'available','8766267833986166387',1,8,0,10,0,'0000-00-00 00:00:00',NULL,NULL),(9,'available','8666712643649515296',1,7,0,28,1,'0000-00-00 00:00:00',NULL,NULL),(10,'available','8970602700912824833',1,8,0,4,0,'0000-00-00 00:00:00',NULL,NULL),(11,'parking','8479768997754135080',1,3,1,4,1,'0000-00-00 00:00:00',NULL,NULL),(12,'parking','8629298858846150495',1,3,1,18,1,'0000-00-00 00:00:00',NULL,NULL),(13,'available','8215750682424517468',1,7,0,14,1,'0000-00-00 00:00:00',NULL,NULL),(14,'pending','8555289798844210066',1,10,0,27,1,'0000-00-00 00:00:00',NULL,NULL),(15,'parking','8407879037904546496',1,3,1,18,1,'0000-00-00 00:00:00',NULL,NULL),(16,'pending','8898257124795575047',1,10,0,21,1,'0000-00-00 00:00:00',NULL,NULL),(17,'pending','8894793329832303275',1,4,0,20,1,'0000-00-00 00:00:00',NULL,NULL),(18,'available','8349631059760235464',1,9,0,16,0,'0000-00-00 00:00:00',NULL,NULL),(19,'parking','8986893210636792056',1,10,1,19,1,'0000-00-00 00:00:00',NULL,NULL),(20,'available','8753397432615853442',1,1,0,21,1,'0000-00-00 00:00:00',NULL,NULL);

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

insert  into `users`(`id`,`login`,`level`,`type`,`supervisor_id`,`name`,`email`,`password`,`logo`,`time_zone`,`phone`,`email2`,`language_id`,`sim_balance`,`phone_balance`,`is_active`,`deleted_at`,`remember_token`,`created_at`,`updated_at`) values (6,'Breanne','Subdealer','admin',7,'Dominique Berge','scrist@kunze.biz','$2y$10$WLF7SL3POVBi8YXFx18vZufPlzmEO3wY.OcvEhXHCsgQSPL0gWq0i','images/avatars/3e5dcf6e56e442925b8c5b02f264d3d2.jpg','Pacific/Guadalcanal','1-467-655-7053 x91003','eli22@gmail.com',1,5,10,1,'0000-00-00 00:00:00',NULL,NULL,NULL),(7,'Wilmer','Dealer','admin',20,'Alexanne Robel','maryam59@gmail.com','$2y$10$/oVM9LaQ7Yw9Xr5Bt.8WQ.3ZWNwpXbznPMW78J6E92X0HDer.zVUO','images/avatars/3e5dcf6e56e442925b8c5b02f264d3d2.jpg','Europe/Kaliningrad','(332) 284-0337 x150','bboehm@satterfield.com',1,5,10,1,'0000-00-00 00:00:00','Wir8KHlPohxilM47foZkivWK5DgB2ndNH4ZHnIUP2HyMpWQo64XeN4w5laLS',NULL,'2016-11-29 11:54:13'),(10,'Priscilla','Subdealer','employee',6,'Naomie Hudson','xkilback@mitchell.info','$2y$10$Wrzf8CBhV/C3d4tg28GCdODYujoNyktUDFZdBiuS1s6XWWEdwGDHG','images/avatars/3e5dcf6e56e442925b8c5b02f264d3d2.jpg','Europe/Kiev','452.417.3576 x8847','avon@yahoo.com',1,5,10,1,'0000-00-00 00:00:00','GaesonClU4Ie2nxCTdyUdJKkeadaRuzB5V64AXrGywamoSyruK4v4c9hIAbJ',NULL,'2016-11-24 07:31:17'),(15,'Myrtis','Dealer','manager',7,'Dr. Neha Harris','nader.tevin@hotmail.com','$2y$10$gWfL3o50jevpstiI8b1tJ.y8MIA.NdQeQTSZMGpvVwopeR8JE1nou','images/avatars/3e5dcf6e56e442925b8c5b02f264d3d2.jpg','Africa/Bangui','+1 (583) 382-7010','smckenzie@schowalter.com',1,5,10,1,'0000-00-00 00:00:00',NULL,NULL,NULL),(18,'Leon','Dealer','employee',7,'Felipa Pacocha','bella.leannon@bergstrom.biz','$2y$10$ZtwwpQee1OxoBrU5K5ic4.BUEvIa93onhyVzgcJkEVmlyj1Z.JVJK','images/avatars/3e5dcf6e56e442925b8c5b02f264d3d2.jpg','America/North_Dakota/Beulah','1-734-583-2185','anderson64@koepp.com',1,5,10,1,'0000-00-00 00:00:00','FuEkCN4vEAG9YUy18f1gigp4AmP4qIx8BX7jyA2P3fZoRIxyN9GgOJbOQLsz',NULL,'2016-11-23 14:24:17'),(20,'Elroy','Distributor','admin',30,'Vallie Champlin','mhessel@fay.com','$2y$10$Slwl2.KALx6yj3/mM1UEG.vzcDwnrfXwtDz1Rly3aSU944q9c3GWq','images/avatars/3e5dcf6e56e442925b8c5b02f264d3d2.jpg','Africa/Nouakchott','953.695.9074 x17428','kleffler@pouros.com',1,5,10,1,'0000-00-00 00:00:00','5abBTETnj5wLHla99IW8FdxFBrxWp0uybwGJdf39J08aBORnthhq8tuYmXlA',NULL,'2016-11-25 12:50:01'),(25,'Holly','Distributor','manager',20,'Liam Gibson','zane94@hotmail.com','$2y$10$kvg.IDJR3N3lmSpmGIUddOLAV46xL68wdV4/WV.3nPppVGCEvKC96','images/avatars/3e5dcf6e56e442925b8c5b02f264d3d2.jpg','Asia/Krasnoyarsk','+12835761094','sienna02@yahoo.com',1,5,10,1,'0000-00-00 00:00:00','CXmHCEQFeyJaroLwzelzTJ3Y5YOAPWkDeTtqXfTshZdBmrXzB6C7hZl6VjYi',NULL,'2016-12-02 05:41:14'),(29,'Tamia','Distributor','employee',20,'Carlos Emard','estrella.greenholt@stroman.com','$2y$10$0ISH8xVfGMwmq.DXD5BCZu7QBJV32jaU7KkIktdNckWnZcE162872','images/avatars/3e5dcf6e56e442925b8c5b02f264d3d2.jpg','Pacific/Kosrae','+1-640-464-6642','baby.lang@yahoo.com',1,5,10,1,'0000-00-00 00:00:00',NULL,NULL,NULL),(30,'Alanis','Super admin','admin',0,'Carlos Emard','estrella.greenho2lt@stroman.com','$2y$10$0ISH8xVfGMwmq.DXD5BCZu7QBJV32jaU7KkIktdNckWnZcE162872','images/avatars/3e5dcf6e56e442925b8c5b02f264d3d2.jpg','Pacific/Kosrae','+1-640-464-6642','baby.la2ng@yahoo.com',1,5,10,1,'0000-00-00 00:00:00','eiqbGUVIGR8uzvBdGJZHOeqTknuwNmTo7JCplsJRUBg9S0dBMSgtEOPStUX9',NULL,'2016-12-02 14:46:57'),(31,'Baloo','Dealer','admin',30,'Seraphim','sadfa@jfgh.com','$2y$10$xDnmoM3vtUtxckCT.7Q06O9A8A7DMFOFHwM66tzGI4/TSTa2vWjXq',NULL,NULL,NULL,'hfkkdl@hkd.com',NULL,NULL,NULL,1,'0000-00-00 00:00:00','osM7IDxq5nOvYm0GQfyjxmffpyz0aT6fPjA8rSI4IZDlUy4dsHtvpB4uSkPm','2016-11-17 13:03:27','2016-11-23 13:44:11'),(32,'Baloo2','Subdealer','admin',31,'Seraphim2','sadf2a@jfgh.com','$2y$10$dq2zN0jTh6Dk3xnQ.ma5S.C28TC.UhM4CDApeWv9pg1K0fvIAQ0.e',NULL,NULL,NULL,'hfkk2dl@hkd.com',NULL,NULL,NULL,1,'0000-00-00 00:00:00','RGpudfOvI2VCyWLlsykj14SDQt8g309wKz44ogRGoOiVEG5IUWv0qaxiAgAc','2016-11-17 13:35:01','2016-11-23 13:19:01'),(33,'Baloo3','Subdealer','admin',31,'Seraphim3','sadf3a@jfgh.com','$2y$10$x15sOYiNmJIHcYE.ja1d8eD1ZPqA2PiconKOae/TJgmLxI2YFxjhW',NULL,NULL,NULL,'hfkk3dl@hkd.com',NULL,NULL,NULL,1,'0000-00-00 00:00:00',NULL,'2016-11-17 14:06:20','2016-11-17 14:06:20'),(34,'Baloo5','Distributor','admin',30,'Seraphim5','sadf5a@jfgh.com','$2y$10$acr31dB3OxTDARf2D3PxOeoAFK5sJirjb1FJgSkqzXpYB88Viguye',NULL,NULL,NULL,'hfkk5dl@hkd.com',NULL,NULL,NULL,1,'0000-00-00 00:00:00',NULL,'2016-11-17 14:30:29','2016-11-17 14:30:29'),(35,'Baloo6','Subdealer','admin',30,'Seraphim6','sadf6a@jfgh.com','$2y$10$285zPhxYt3TWNJYWzo3uOegSuJxELgTTUPMq5blye7VqwtNOOZgF2',NULL,NULL,NULL,'hfkk6dl@hkd.com',NULL,NULL,NULL,1,'0000-00-00 00:00:00',NULL,'2016-11-17 14:41:24','2016-11-17 14:41:24'),(36,'Baloo7','Dealer','admin',34,'Seraphim7','sadf7a@jfgh.com','$2y$10$8OFJFfIbcZU/JpLdy2K4aOvapapcS9MUj.AZ0YVuUQODKBWnFp6qq',NULL,NULL,NULL,'hfkk7dl@hkd.com',NULL,NULL,NULL,1,'0000-00-00 00:00:00',NULL,'2016-11-18 13:57:35','2016-11-18 13:57:35'),(37,'nik','Distributor','admin',30,'Nicky','niki@niki.com','password',NULL,NULL,NULL,'niki2@niki.com',1,NULL,NULL,1,'0000-00-00 00:00:00',NULL,'2016-11-30 06:38:03','2016-11-30 06:38:03'),(38,'nik2','Dealer','admin',37,'Nicky2','niki2@niki.com','password',NULL,NULL,NULL,'niki3@niki.com',1,NULL,NULL,1,'0000-00-00 00:00:00',NULL,'2016-11-30 06:51:13','2016-11-30 06:51:13');

UNLOCK TABLES;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
