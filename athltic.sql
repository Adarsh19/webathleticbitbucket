/*
SQLyog Ultimate v11.11 (32 bit)
MySQL - 5.5.5-10.1.29-MariaDB : Database - webathletic
*********************************************************************
*/


/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`webathletic` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `webathletic`;

/*Table structure for table `companies` */

DROP TABLE IF EXISTS `companies`;

CREATE TABLE `companies` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `iban` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `taal` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `klant_sinds` date DEFAULT NULL,
  `about` text COLLATE utf8mb4_unicode_ci,
  `user_meta` text COLLATE utf8mb4_unicode_ci,
  `role` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `activation_status` tinyint(4) NOT NULL DEFAULT '0',
  `block_reason` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `blocked_at` timestamp NULL DEFAULT NULL,
  `place_holder` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_of_account_holder` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bic_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `barcode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(255) NOT NULL,
  `parent_id` bigint(20) DEFAULT '1',
  `Bedrijfsnaam` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Soort` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `City` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Contactpersoon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cashback` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `companies` */

insert  into `companies`(`id`,`name`,`username`,`email`,`password`,`avatar`,`gender`,`phone`,`address`,`birthday`,`iban`,`taal`,`klant_sinds`,`about`,`user_meta`,`role`,`activation_status`,`block_reason`,`blocked_at`,`place_holder`,`name_of_account_holder`,`bic_code`,`barcode`,`remember_token`,`user_id`,`parent_id`,`Bedrijfsnaam`,`Soort`,`City`,`Contactpersoon`,`cashback`,`created_at`,`updated_at`,`slug`) values (1,'snehal','aperiam_nihil','snehal@virtualheight.com','$2y$10$fTInGzIS1X/BpYh8OIqhYuLscfionuHf0BbE6C/9WnJZWojRXCyAS',NULL,'m','1234567890','A/2, ravi tenement, A/2, ravi tenement','2005-01-29','dafbgsadf','adfbadfbdf','1970-01-03','wedgvawsedv',NULL,'Company1',0,'','2018-05-22 12:46:04',NULL,NULL,NULL,NULL,'nkImrflv8AfpmsIFi8MAxzxiWm6rsRKB4YeX9DxaRYQeBIOuu5gdk7tXKCcG',1,1,'dvasvads','adsvadsfv',NULL,'snehal','active','2018-04-18 18:03:16','2018-05-24 13:18:37','Misty_Streich3645'),(2,'Joel Hammes','assumenda_id','fdouglas@example.org','$2y$10$fTInGzIS1X/BpYh8OIqhYuLscfionuHf0BbE6C/9WnJZWojRXCyAS','2.png',NULL,NULL,NULL,'0000-00-00','','','0000-00-00',NULL,'{\"i\":{\"kcal\":\"1200\",\"eiwit\":\"12525\",\"koolhydraat\":\"12065646\",\"vezel\":\"238882\",\"vet\":\"120885\"},\"b\":{\"kcal\":\"125550\",\"eiwit\":\"12\",\"koolhydraat\":\"12\",\"vezel\":\"12\",\"vet\":\"120\"},\"doelstelling\":\"Test Message\",\"mayur\":\"test\"}','user',1,'','2018-05-22 12:46:07',NULL,NULL,NULL,NULL,'tGxUwVOCYKJ9RML2TQOoTa5CrzJbCzYWmzLEAEfdDfHjspcPVF9swVefZIYj',0,1,NULL,NULL,NULL,NULL,NULL,'2018-04-18 18:03:16','2018-05-08 17:48:04',''),(3,'Andres Metz Sr.','pariatur_eos','admin@vh.com','$2y$10$oWeLVANkG.dkOCsbqynHyue3KL1MUXw6JEnQf2vpaaL.0gCBlYDei',NULL,'f','9876543210','adsofihvopads','2012-02-24',NULL,'Angola','1970-01-01','asdvas',NULL,'user',1,'','2018-05-22 12:46:07',NULL,NULL,NULL,NULL,'xEFj6SkKKm',0,1,NULL,NULL,NULL,NULL,NULL,'2018-04-18 18:03:16','2018-05-22 06:39:59',''),(4,'Marisa Effertz','ad_laboriosam','clara.watsica@example.org','$2y$10$oWeLVANkG.dkOCsbqynHyue3KL1MUXw6JEnQf2vpaaL.0gCBlYDei',NULL,NULL,NULL,NULL,'0000-00-00','','','0000-00-00',NULL,NULL,'user',0,'','2018-05-22 12:46:08',NULL,NULL,NULL,NULL,'lhk2Wysftn',0,1,NULL,NULL,NULL,NULL,NULL,'2018-04-18 18:03:16','2018-04-18 18:03:16',''),(5,'Hilton Bergnaum','quia_ducimus','btrantow@example.com','$2y$10$oWeLVANkG.dkOCsbqynHyue3KL1MUXw6JEnQf2vpaaL.0gCBlYDei',NULL,NULL,NULL,NULL,'0000-00-00','','','0000-00-00',NULL,NULL,'user',0,'','2018-05-22 12:46:08',NULL,NULL,NULL,NULL,'ZSawMIPsf4',0,1,NULL,NULL,NULL,NULL,NULL,'2018-04-18 18:03:16','2018-04-18 18:03:16','Hilton_Bergnaum6847'),(6,'Clint Von PhD','sit_quasi','price.werner@example.com','$2y$10$oWeLVANkG.dkOCsbqynHyue3KL1MUXw6JEnQf2vpaaL.0gCBlYDei',NULL,NULL,NULL,NULL,'0000-00-00','','','0000-00-00',NULL,NULL,'user',1,'','2018-05-22 12:46:10',NULL,NULL,NULL,NULL,'l4J6fv1pvI',0,1,NULL,NULL,NULL,NULL,NULL,'2018-04-18 18:03:16','2018-04-18 19:05:12',''),(7,'Theresa Sporer','voluptas_explicabo','vhansen@example.net','$2y$10$oWeLVANkG.dkOCsbqynHyue3KL1MUXw6JEnQf2vpaaL.0gCBlYDei',NULL,NULL,NULL,NULL,'0000-00-00','','','0000-00-00',NULL,NULL,'user',0,'','2018-05-22 12:46:09',NULL,NULL,NULL,NULL,'WZUdUPOnyp',0,1,NULL,NULL,NULL,NULL,NULL,'2018-04-18 18:03:16','2018-04-18 18:03:16',''),(8,'Simeon Koepp','dolores_rerum','gwen.nader@example.com','$2y$10$oWeLVANkG.dkOCsbqynHyue3KL1MUXw6JEnQf2vpaaL.0gCBlYDei',NULL,NULL,NULL,NULL,'0000-00-00','','','0000-00-00',NULL,NULL,'user',0,'','2018-05-22 12:46:10',NULL,NULL,NULL,NULL,'vsfNgU6mfb',0,1,NULL,NULL,NULL,NULL,NULL,'2018-04-18 18:03:16','2018-04-18 18:03:16',''),(9,'Weldon Williamson','eveniet_voluptatem','grant82@example.com','$2y$10$oWeLVANkG.dkOCsbqynHyue3KL1MUXw6JEnQf2vpaaL.0gCBlYDei',NULL,NULL,NULL,NULL,'0000-00-00','','','0000-00-00',NULL,NULL,'user',0,'','2018-05-22 12:46:14',NULL,NULL,NULL,NULL,'YCjWrawPxj',0,1,NULL,NULL,NULL,NULL,NULL,'2018-04-18 18:03:16','2018-04-18 18:03:16',''),(10,'Dr. Donnie Runte','provident_est','juliet.bernhard@example.org','$2y$10$oWeLVANkG.dkOCsbqynHyue3KL1MUXw6JEnQf2vpaaL.0gCBlYDei',NULL,NULL,NULL,NULL,'0000-00-00','','','0000-00-00',NULL,NULL,'user',0,'','2018-05-22 12:46:15',NULL,NULL,NULL,NULL,'SMEJgHmGih',0,1,NULL,NULL,NULL,NULL,NULL,'2018-04-18 18:03:16','2018-04-18 18:03:16',''),(13,'vishal patel','abc','abc@ttt.com','$2y$10$W038y1AXKLT7wmhMEgwupeT5JEUMokAldXdeaw0QLz42K/BCMxZtq',NULL,'m','9898646866','702-703 iscon,jodhpur crose',NULL,NULL,NULL,NULL,'dsfvds',NULL,'company',1,'','2018-05-22 12:46:18',NULL,NULL,NULL,NULL,NULL,0,1,NULL,NULL,NULL,NULL,NULL,'2018-05-21 10:48:10','2018-05-21 10:48:10','');

/*Table structure for table `galleries` */

DROP TABLE IF EXISTS `galleries`;

CREATE TABLE `galleries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `caption` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thumb` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `publication_status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `galleries_user_id_index` (`user_id`),
  CONSTRAINT `galleries_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `galleries` */

insert  into `galleries`(`id`,`user_id`,`caption`,`image`,`thumb`,`publication_status`,`created_at`,`updated_at`) values (1,1,'Molestiae ex nihil excepturi asperiores nam quia cupiditate.','1_786327837.png','thumb_1_786327837.png',1,'2018-04-18 18:03:20','2018-05-17 13:26:52'),(2,1,'Deserunt enim alias voluptates et quam.','2_1265860481.png',NULL,1,'2018-04-18 18:03:21','2018-05-17 11:10:15'),(3,1,'Quae qui autem dolores autem.','3_216125584.png',NULL,1,'2018-04-18 18:03:21','2018-05-17 11:10:44'),(4,1,'Ut architecto enim possimus sit doloribus explicabo.','1.jpg',NULL,0,'2018-04-18 18:03:21','2018-04-18 18:03:21'),(5,1,'Aut dolor quidem temporibus quasi est et omnis.','1.jpg',NULL,0,'2018-04-18 18:03:21','2018-04-19 21:36:47'),(6,1,'Similique cum temporibus vel nam cumque.','1.jpg',NULL,0,'2018-04-18 18:03:21','2018-04-18 18:03:21'),(7,1,'Dolorum possimus voluptatem aliquam non sapiente.','1.jpg',NULL,0,'2018-04-18 18:03:21','2018-04-18 18:03:21'),(8,1,'Quidem qui consequuntur qui est quisquam dolorem fuga.','1.jpg',NULL,0,'2018-04-18 18:03:21','2018-04-18 18:03:21'),(9,1,'Fugit recusandae officiis deserunt eius animi consequatur.','1.jpg',NULL,0,'2018-04-18 18:03:21','2018-04-18 18:03:21'),(10,1,'Id odit quos reiciendis minima consequuntur quo.','1.jpg',NULL,0,'2018-04-18 18:03:21','2018-04-19 21:36:42'),(11,1,'Non ea veritatis veritatis velit quo magnam non.','11.jpg','thumb_11.jpg',1,'2018-04-18 18:03:21','2018-05-17 11:19:53'),(12,1,'Fuga repudiandae veritatis totam quia quia corrupti a.','12_763253294.png',NULL,1,'2018-04-18 18:03:21','2018-05-17 11:12:27'),(13,1,'Et quia doloremque voluptate maiores qui.','1.jpg',NULL,1,'2018-04-18 18:03:21','2018-04-18 18:03:21'),(14,1,'Quo incidunt sit soluta qui molestias rerum distinctio.','1.jpg',NULL,1,'2018-04-18 18:03:21','2018-04-18 18:03:21'),(15,1,'Excepturi voluptas voluptas eum neque eum.','1.jpg',NULL,0,'2018-04-18 18:03:21','2018-04-18 18:03:21');

/*Table structure for table `log_events` */

DROP TABLE IF EXISTS `log_events`;

CREATE TABLE `log_events` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `log` longtext NOT NULL,
  `user_id` int(255) DEFAULT NULL,
  `role` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `log_events` */

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `migrations` */

/*Table structure for table `packages` */

DROP TABLE IF EXISTS `packages`;

CREATE TABLE `packages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `days` int(11) NOT NULL DEFAULT '0',
  `credits` int(11) NOT NULL DEFAULT '0',
  `products` int(11) NOT NULL DEFAULT '0',
  `pro_rato` int(11) NOT NULL DEFAULT '0',
  `expand_automatically` tinyint(4) NOT NULL DEFAULT '0',
  `Start_fee` int(11) NOT NULL DEFAULT '0',
  `entree` int(11) NOT NULL DEFAULT '0',
  `sell_category` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `enquette` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role_id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `max_users` int(255) NOT NULL,
  `added_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payment_days` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `packages` */

insert  into `packages`(`id`,`days`,`credits`,`products`,`pro_rato`,`expand_automatically`,`Start_fee`,`entree`,`sell_category`,`enquette`,`created_at`,`updated_at`,`user_id`,`added_by`,`payment_days`) values (1,2,100,1,20,1,100,1,'adrfbgsd',1200,NULL,'2018-05-25 13:57:50',0,'','05/31/2018,05/24/2018,05/17/2018,05/15/2018,05/23/2018,05/22/2018,05/29/2018,05/30/2018,05/16/2018,05/11/2018,05/05/2018,05/07/2018'),(2,25,1205,1,12505,1,600,1200,'sfdwthndfrt',0,'2018-05-18 11:46:30','2018-05-25 13:52:59',0,'','05/31/2018,05/24/2018,05/17/2018,05/15/2018,05/23/2018,05/22/2018,05/29/2018,05/30/2018,05/16/2018,05/11/2018,05/05/2018,05/07/2018'),(4,10,100,2,120,1,1200,1200,'asdgvads',0,'2018-05-24 12:53:02','2018-05-25 13:25:00',1,'','05/31/2018,05/24/2018,05/17/2018,05/15/2018,05/23/2018,05/22/2018,05/29/2018,05/30/2018,05/16/2018,05/11/2018,05/05/2018,05/07/2018'),(5,4,200,2,120,1,220,150,'dfbsdfbadf',0,'2018-05-24 12:57:18','2018-05-24 12:57:18',1,'',''),(7,10,120,2,201,1,120,200,'asdvadsfvads',0,'2018-05-25 11:54:01','2018-05-25 13:21:45',1,'admin','05/17/2018,05/18/2018,05/25/2018,05/24/2018,05/31/2018,06/02/2018,06/29/2018,06/15/2018,06/12/2018,06/27/2018,06/13/2018,06/18/2018');

/*Table structure for table `pages` */

DROP TABLE IF EXISTS `pages`;

CREATE TABLE `pages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `page_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `page_slug` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `page_content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `page_featured_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thumb` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `publication_status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pages_page_slug_unique` (`page_slug`),
  KEY `pages_user_id_index` (`user_id`),
  CONSTRAINT `pages_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `pages` */

insert  into `pages`(`id`,`user_id`,`page_name`,`category`,`page_slug`,`page_content`,`page_featured_image`,`thumb`,`meta_title`,`meta_keywords`,`meta_description`,`publication_status`,`created_at`,`updated_at`) values (4,1,'sign up','join','consequatur_a','<p>Temporibus minima similique eum officia. Est autem voluptas ducimus expedita aut adipisci. Quidem eius cumque libero eos. Tempore esse magnam voluptatem. Accusamus vel fugit ad illum.</p>',NULL,NULL,'Eos','rem, voluptate, voluptatem','Voluptates sit temporibus dolorem esse facere. Ab tenetur eum labore sunt deserunt minus. Incidunt omnis quis voluptatem modi totam quia nisi.',0,'2018-04-18 18:03:20','2018-05-16 15:31:13'),(5,1,'login','join','quis_ut','Quaerat quidem voluptatem et expedita et quia ut. Consectetur id exercitationem possimus nobis. Rerum voluptas vel voluptas et mollitia sed. Vitae soluta sunt dolor.Quaerat quidem voluptatem et expedita et quia ut. Consectetur id \r\nexercitationem possimus nobis. Rerum voluptas vel voluptas et mollitia \r\nsed. Vitae soluta sunt dolor.Quaerat quidem voluptatem et expedita et quia ut. Consectetur id \r\nexercitationem possimus nobis. Rerum voluptas vel voluptas et mollitia \r\nsed. Vitae soluta sunt dolor.Quaerat quidem voluptatem et expedita et quia ut. Consectetur id \r\nexercitationem possimus nobis. Rerum voluptas vel voluptas et mollitia \r\nsed. Vitae soluta sunt dolor.Quaerat quidem voluptatem et expedita et quia ut. Consectetur id \r\nexercitationem possimus nobis. Rerum voluptas vel voluptas et mollitia \r\nsed. Vitae soluta sunt dolor.Quaerat quidem voluptatem et expedita et quia ut. Consectetur id \r\nexercitationem possimus nobis. Rerum voluptas vel voluptas et mollitia \r\nsed. Vitae soluta sunt dolor.',NULL,NULL,'Architecto','voluptatem, necessitatibus, quia','At nulla deleniti non sequi. Voluptate ducimus soluta et. Dolore est odit ex et possimus et. Illum explicabo suscipit aut et sit.',0,'2018-04-18 18:03:20','2018-04-19 03:21:48'),(6,1,'company details','coaching','page_slug','<p>paldge<br></p>',NULL,NULL,'page Here','Page','page here',0,'2018-04-19 22:02:00','2018-04-19 22:02:00'),(11,1,'who I am & methods','coaching','1','',NULL,NULL,NULL,NULL,NULL,0,NULL,NULL),(12,1,'terms','conditions','2','',NULL,NULL,NULL,NULL,NULL,0,NULL,NULL),(13,1,'conditions','conditions','1-','',NULL,NULL,NULL,NULL,NULL,0,NULL,NULL),(14,1,'contact us','contact','2-','',NULL,NULL,NULL,NULL,NULL,0,NULL,NULL),(15,1,'about us','contact','sdfss','',NULL,NULL,NULL,NULL,NULL,0,NULL,NULL),(16,1,'privacy policy','contact','sdf','',NULL,NULL,NULL,NULL,NULL,0,NULL,NULL),(17,1,'blogs','contact','sdfd','',NULL,NULL,NULL,NULL,NULL,0,NULL,NULL),(18,1,'how does it work?','information','sdfsdfsdfsdf','<p>yes it is tyyyydsfsdfsdfsdf</p>',NULL,'thumb_1526567978.png','tags','titles','Description',1,NULL,'2018-05-17 14:39:38'),(19,1,'connect','information','nemo_laborum','<p>Tempora minima molestiae id quidem. Quod laborum itaque quae eveniet et illo quis. Aut nisi similique facilis eligendi aut inventore.</p>',NULL,NULL,'Nesciunt','dolor, illum, ad','Eum voluptatum voluptatum adipisci. Ut omnis et corporis quis praesentium in totam.',0,'2018-04-18 18:03:20','2018-05-16 15:30:53'),(20,1,'success stories','information','dolorem_eaque','<p>Nihil vel qui vel maiores qui laudantium distinctio</p>',NULL,NULL,'Nobis','perferendis, nemo, minus','Quae eum et dolorem et. Itaque et eaque ad et consequatur facilis explicabo quod. Dignissimos ipsam quaerat non.',1,'2018-04-18 18:03:20','2018-05-16 16:13:56'),(21,1,'services','information','illo_culpa','<p>Est atque</p>',NULL,NULL,'Deserunt','consequuntur, amet, nihil','Nobis sit aliquid numquam. Nobis sed quaerat quibusdam itaque possimus ipsam sequi vero. Sapiente fuga ea consequatur magnam ex.',1,'2018-04-18 18:03:20','2018-05-16 16:13:48');

/*Table structure for table `permissions` */

DROP TABLE IF EXISTS `permissions`;

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `permission` varchar(255) NOT NULL,
  `pdescription` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `added_by` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `permissions` */

insert  into `permissions`(`id`,`permission`,`pdescription`,`user_id`,`created_at`,`updated_at`,`added_by`) values (1,'user list','user list',0,NULL,'2018-05-21 12:45:57',''),(4,'user delete','user delete',0,NULL,NULL,''),(6,'user update','user update',0,'2018-05-19 14:04:50','2018-05-19 14:04:50',''),(8,'user add','user add',0,'2018-05-21 12:51:19','2018-05-21 12:51:19','');

/*Table structure for table `productmedia` */

DROP TABLE IF EXISTS `productmedia`;

CREATE TABLE `productmedia` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `tax` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `category` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `unlimited_stock` int(11) NOT NULL,
  `slug` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `path` text COLLATE utf8_unicode_ci,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `group_id` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `productmedia_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `productmedia` */

insert  into `productmedia`(`id`,`name`,`price`,`tax`,`stock`,`category`,`unlimited_stock`,`slug`,`type`,`path`,`user_id`,`group_id`,`created_at`,`updated_at`) values (2,'Energydrink',909.00,21.00,0,'product_2018-05-07 20:03:16',1,'energydrink','image','15261390050.JPG',1,2,'2018-05-07 23:33:16','2018-05-13 01:00:05');

/*Table structure for table `role_credentials` */

DROP TABLE IF EXISTS `role_credentials`;

CREATE TABLE `role_credentials` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `role_id` int(255) NOT NULL,
  `menu_id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

/*Data for the table `role_credentials` */

insert  into `role_credentials`(`id`,`role_id`,`menu_id`,`user_id`,`created_at`,`updated_at`) values (1,2,1,0,NULL,NULL),(24,1,1,0,'2018-05-23 09:42:13','2018-05-23 09:42:13'),(25,1,4,0,'2018-05-23 09:42:13','2018-05-23 09:42:13'),(26,1,6,0,'2018-05-23 09:42:13','2018-05-23 09:42:13'),(27,1,8,0,'2018-05-23 09:42:13','2018-05-23 09:42:13');

/*Table structure for table `roles` */

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `role` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `rdescription` text COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `added_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `roles` */

insert  into `roles`(`id`,`role`,`rdescription`,`user_id`,`created_at`,`updated_at`,`added_by`) values (1,'Administrator','This role stands for back side consumers of this product.',1,'2018-05-18 12:05:02','2018-05-21 13:20:24',''),(2,'User','This role stands for front side customers of this product.',1,'2018-05-18 12:05:59','2018-05-18 12:05:59',''),(3,'Company','company role is third party role',0,'2018-05-21 13:22:38','2018-05-21 13:22:38',''),(4,'New Company','Testing the company roles.',1,'2018-05-24 12:10:09','2018-05-24 12:10:09','company1');

/*Table structure for table `services` */

DROP TABLE IF EXISTS `services`;

CREATE TABLE `services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service` varchar(255) NOT NULL,
  `sdescription` text NOT NULL,
  `company_id` int(11) NOT NULL,
  `sprice` int(255) NOT NULL,
  `user_mass` int(255) NOT NULL,
  `payment_time` int(255) NOT NULL,
  `bg_color` varchar(7),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `added_by` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `services` */

insert  into `services`(`id`,`service`,`sdescription`,`company_id`,`sprice`,`user_mass`,`payment_time`,`created_at`,`updated_at`,`added_by`) values (1,'service1','hello world, idswfbvndisa, asdvads. adfbv. asgdvbads',1,100,200,1200,NULL,NULL,''),(2,'services','hello world, idswfbvndisa, asdvads. adfbv. asgddfwvbads',0,10,20,30,'2018-05-23 10:27:31','2018-05-25 07:11:14',''),(3,'New Service','hello world, idswfbvndisa, asdvads. adfbv.',0,100,1000,1200,'2018-05-24 13:14:19','2018-05-25 07:46:05','company1'),(4,'helloo world','this is testing. only testing. No other intention please. afadssdfuiylghsd.',0,10,20,25,'2018-05-25 06:56:35','2018-05-25 07:34:11','admin');

/*Table structure for table `site_images` */

DROP TABLE IF EXISTS `site_images`;

CREATE TABLE `site_images` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(1024) DEFAULT NULL,
  `src` varchar(1024) DEFAULT NULL,
  `title` varchar(1024) DEFAULT NULL,
  `description` varchar(1024) DEFAULT NULL,
  `type` varchar(1024) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

/*Data for the table `site_images` */

insert  into `site_images`(`id`,`name`,`src`,`title`,`description`,`type`) values (1,'logo','images/logo.png','logo','logo','logo'),(2,'banner','images/home-img.png','banner','banner','banner'),(3,'footer-woomen','images/women-img.png ',NULL,NULL,NULL),(4,'none','images/1526540438glpus2.jpg','none','none','other'),(5,'test','images/152654242011_tshirt_front_woman.jpg','test','test','banner');

/*Table structure for table `stories` */

DROP TABLE IF EXISTS `stories`;

CREATE TABLE `stories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `possition` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `story_featured_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thumb` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `publication_status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `stories_user_id_index` (`user_id`),
  CONSTRAINT `stories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `stories` */

insert  into `stories`(`id`,`user_id`,`name`,`content`,`possition`,`story_featured_image`,`thumb`,`publication_status`,`created_at`,`updated_at`) values (1,1,'Nesciunt test again','<p>Story Table</p>\r\n<p>&nbsp;</p>','Story Table Here','1.jpg','thumb_1.jpg',1,'2018-04-18 18:03:20','2018-05-17 14:17:21'),(2,1,'Nobis','<p>Nihil vel qui vel maiores qui laudantium distinctio. Quaerat sapiente sint voluptatem consequatur aperiam placeat. Sequi ad voluptatem ut deleniti dolorem.</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>','Story Table Here','2_1168218981.png',NULL,1,'2018-04-18 18:03:20','2018-05-17 10:32:14'),(3,1,'Deserunt','<p>Est atque consectetur accusantium quod. Fuga quos non nulla id accusamus. Quasi consequuntur quae amet voluptas aut deserunt. hi there</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>','Story Table Here','3.jpg',NULL,1,'2018-04-18 18:03:20','2018-05-16 16:21:16'),(6,1,'story name is Ulrich','<p>Nihil vel qui vel maiores qui laudantium distinctio. Quaerat sapiente sint voluptatem consequatur aperiam placeat. Sequi ad voluptatem ut delenit</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>','Story Table Here','6_1576047592.png',NULL,1,'2018-04-19 19:14:17','2018-05-17 11:13:07'),(7,1,'Name of my','<p>ttetstsdf ksdjf sd kjsd s</p>\r\n<p>dddd</p>\r\n<p>sdsd</p>','Designation of Client','7.jpg','thumb_7.jpg',1,'2018-04-19 22:14:32','2018-05-17 11:35:46');

/*Table structure for table `subscribers` */

DROP TABLE IF EXISTS `subscribers`;

CREATE TABLE `subscribers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `subscribers_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=104 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `subscribers` */

insert  into `subscribers`(`id`,`email`,`created_at`,`updated_at`) values (1,'lehner.lynn@example.net','2018-04-18 18:03:16','2018-04-18 18:03:16'),(2,'phyllis60@example.org','2018-04-18 18:03:17','2018-04-18 18:03:17'),(4,'nina60@example.net','2018-04-18 18:03:17','2018-04-18 18:03:17'),(5,'hjacobi@example.org','2018-04-18 18:03:17','2018-04-18 18:03:17'),(6,'ymueller@example.com','2018-04-18 18:03:17','2018-04-18 18:03:17'),(7,'roob.maria@example.net','2018-04-18 18:03:17','2018-04-18 18:03:17'),(8,'antonietta.hilll@example.net','2018-04-18 18:03:17','2018-04-18 18:03:17'),(9,'ybernhard@example.com','2018-04-18 18:03:17','2018-04-18 18:03:17'),(10,'christiansen.orie@example.com','2018-04-18 18:03:17','2018-04-18 18:03:17'),(11,'lindsey.hayes@example.net','2018-04-18 18:03:17','2018-04-18 18:03:17'),(12,'tyreek.champlin@example.org','2018-04-18 18:03:17','2018-04-18 18:03:17'),(13,'colby04@example.com','2018-04-18 18:03:17','2018-04-18 18:03:17'),(14,'janiya23@example.com','2018-04-18 18:03:17','2018-04-18 18:03:17'),(15,'yhowe@example.org','2018-04-18 18:03:17','2018-04-18 18:03:17'),(16,'camryn66@example.net','2018-04-18 18:03:17','2018-04-18 18:03:17'),(17,'xdaniel@example.org','2018-04-18 18:03:17','2018-04-18 18:03:17'),(18,'syost@example.org','2018-04-18 18:03:17','2018-04-18 18:03:17'),(19,'beatrice82@example.net','2018-04-18 18:03:17','2018-04-18 18:03:17'),(20,'harrison80@example.net','2018-04-18 18:03:17','2018-04-18 18:03:17'),(21,'ellie.reilly@example.org','2018-04-18 18:03:17','2018-04-18 18:03:17'),(22,'weissnat.sabrina@example.net','2018-04-18 18:03:17','2018-04-18 18:03:17'),(23,'ijacobi@example.com','2018-04-18 18:03:17','2018-04-18 18:03:17'),(24,'gaston10@example.net','2018-04-18 18:03:17','2018-04-18 18:03:17'),(25,'wanda.ruecker@example.com','2018-04-18 18:03:17','2018-04-18 18:03:17'),(26,'qtorphy@example.org','2018-04-18 18:03:17','2018-04-18 18:03:17'),(27,'joelle41@example.com','2018-04-18 18:03:17','2018-04-18 18:03:17'),(28,'tnolan@example.org','2018-04-18 18:03:17','2018-04-18 18:03:17'),(29,'adams.maribel@example.net','2018-04-18 18:03:17','2018-04-18 18:03:17'),(30,'robel.bridget@example.net','2018-04-18 18:03:18','2018-04-18 18:03:18'),(31,'leuschke.sherwood@example.net','2018-04-18 18:03:18','2018-04-18 18:03:18'),(32,'angie.kilback@example.com','2018-04-18 18:03:18','2018-04-18 18:03:18'),(33,'xsauer@example.net','2018-04-18 18:03:18','2018-04-18 18:03:18'),(34,'ortiz.osvaldo@example.org','2018-04-18 18:03:18','2018-04-18 18:03:18'),(35,'jaclyn28@example.net','2018-04-18 18:03:18','2018-04-18 18:03:18'),(36,'wdach@example.net','2018-04-18 18:03:18','2018-04-18 18:03:18'),(37,'marianne60@example.com','2018-04-18 18:03:18','2018-04-18 18:03:18'),(38,'donnell22@example.org','2018-04-18 18:03:18','2018-04-18 18:03:18'),(39,'beahan.clifton@example.org','2018-04-18 18:03:18','2018-04-18 18:03:18'),(40,'muriel51@example.net','2018-04-18 18:03:18','2018-04-18 18:03:18'),(41,'karl61@example.net','2018-04-18 18:03:18','2018-04-18 18:03:18'),(42,'stark.enola@example.com','2018-04-18 18:03:18','2018-04-18 18:03:18'),(43,'bbogan@example.org','2018-04-18 18:03:18','2018-04-18 18:03:18'),(44,'uswift@example.org','2018-04-18 18:03:18','2018-04-18 18:03:18'),(45,'johnathan63@example.net','2018-04-18 18:03:18','2018-04-18 18:03:18'),(46,'frederique.dicki@example.org','2018-04-18 18:03:18','2018-04-18 18:03:18'),(47,'ablock@example.com','2018-04-18 18:03:18','2018-04-18 18:03:18'),(48,'ismael94@example.org','2018-04-18 18:03:18','2018-04-18 18:03:18'),(49,'shettinger@example.org','2018-04-18 18:03:18','2018-04-18 18:03:18'),(50,'general45@example.org','2018-04-18 18:03:18','2018-04-18 18:03:18'),(51,'effie58@example.net','2018-04-18 18:03:18','2018-04-18 18:03:18'),(52,'miller.hortense@example.net','2018-04-18 18:03:18','2018-04-18 18:03:18'),(53,'dkuphal@example.com','2018-04-18 18:03:18','2018-04-18 18:03:18'),(54,'trath@example.com','2018-04-18 18:03:18','2018-04-18 18:03:18'),(55,'lamont13@example.net','2018-04-18 18:03:18','2018-04-18 18:03:18'),(56,'legros.katlynn@example.net','2018-04-18 18:03:19','2018-04-18 18:03:19'),(57,'gaston.wunsch@example.net','2018-04-18 18:03:19','2018-04-18 18:03:19'),(58,'corkery.loy@example.net','2018-04-18 18:03:19','2018-04-18 18:03:19'),(59,'murphy.jarrett@example.org','2018-04-18 18:03:19','2018-04-18 18:03:19'),(60,'garland.hayes@example.com','2018-04-18 18:03:19','2018-04-18 18:03:19'),(61,'alison90@example.com','2018-04-18 18:03:19','2018-04-18 18:03:19'),(62,'napoleon53@example.net','2018-04-18 18:03:19','2018-04-18 18:03:19'),(63,'nick.steuber@example.org','2018-04-18 18:03:19','2018-04-18 18:03:19'),(64,'fjacobs@example.net','2018-04-18 18:03:19','2018-04-18 18:03:19'),(65,'ilene67@example.net','2018-04-18 18:03:19','2018-04-18 18:03:19'),(66,'gerson.kuhlman@example.com','2018-04-18 18:03:19','2018-04-18 18:03:19'),(67,'yparker@example.net','2018-04-18 18:03:19','2018-04-18 18:03:19'),(68,'vdurgan@example.com','2018-04-18 18:03:19','2018-04-18 18:03:19'),(69,'hhodkiewicz@example.org','2018-04-18 18:03:19','2018-04-18 18:03:19'),(70,'logan21@example.net','2018-04-18 18:03:19','2018-04-18 18:03:19'),(71,'koepp.adeline@example.org','2018-04-18 18:03:19','2018-04-18 18:03:19'),(72,'lindsey00@example.org','2018-04-18 18:03:19','2018-04-18 18:03:19'),(73,'elisabeth37@example.net','2018-04-18 18:03:19','2018-04-18 18:03:19'),(74,'maya.harris@example.org','2018-04-18 18:03:19','2018-04-18 18:03:19'),(75,'jboyer@example.org','2018-04-18 18:03:19','2018-04-18 18:03:19'),(76,'audrey70@example.com','2018-04-18 18:03:19','2018-04-18 18:03:19'),(77,'agoyette@example.net','2018-04-18 18:03:19','2018-04-18 18:03:19'),(78,'ferry.oceane@example.org','2018-04-18 18:03:19','2018-04-18 18:03:19'),(79,'hayes.candido@example.net','2018-04-18 18:03:19','2018-04-18 18:03:19'),(80,'gideon85@example.org','2018-04-18 18:03:19','2018-04-18 18:03:19'),(81,'jayde36@example.net','2018-04-18 18:03:19','2018-04-18 18:03:19'),(82,'sweimann@example.net','2018-04-18 18:03:19','2018-04-18 18:03:19'),(83,'upton.raheem@example.com','2018-04-18 18:03:20','2018-04-18 18:03:20'),(84,'bernier.piper@example.org','2018-04-18 18:03:20','2018-04-18 18:03:20'),(85,'halie16@example.net','2018-04-18 18:03:20','2018-04-18 18:03:20'),(86,'paul04@example.com','2018-04-18 18:03:20','2018-04-18 18:03:20'),(87,'brown.adrain@example.net','2018-04-18 18:03:20','2018-04-18 18:03:20'),(88,'edgar67@example.net','2018-04-18 18:03:20','2018-04-18 18:03:20'),(89,'bryana.bins@example.org','2018-04-18 18:03:20','2018-04-18 18:03:20'),(90,'kshlerin.howard@example.net','2018-04-18 18:03:20','2018-04-18 18:03:20'),(91,'gust.hane@example.org','2018-04-18 18:03:20','2018-04-18 18:03:20'),(92,'jessyca90@example.com','2018-04-18 18:03:20','2018-04-18 18:03:20'),(93,'derek03@example.org','2018-04-18 18:03:20','2018-04-18 18:03:20'),(94,'icole@example.org','2018-04-18 18:03:20','2018-04-18 18:03:20'),(95,'stacey92@example.net','2018-04-18 18:03:20','2018-04-18 18:03:20'),(96,'jaime.schamberger@example.org','2018-04-18 18:03:20','2018-04-18 18:03:20'),(97,'tessie.hermiston@example.net','2018-04-18 18:03:20','2018-04-18 18:03:20'),(98,'johnston.carmen@example.com','2018-04-18 18:03:20','2018-04-18 18:03:20'),(99,'oscar87@example.org','2018-04-18 18:03:20','2018-04-18 18:03:20'),(100,'blang@example.com','2018-04-18 18:03:20','2018-04-18 18:03:20'),(101,'ulrichquatess@gmail.com','2018-04-26 23:51:51','2018-04-26 23:51:51'),(102,'adas@sdf.com','2018-04-26 23:52:05','2018-04-26 23:52:05'),(103,'mayur@gmail.com','2018-04-26 23:52:55','2018-04-26 23:52:55');

/*Table structure for table `test` */

DROP TABLE IF EXISTS `test`;

CREATE TABLE `test` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `iban` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `taal` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `klant_sinds` date DEFAULT NULL,
  `about` text COLLATE utf8mb4_unicode_ci,
  `user_meta` text COLLATE utf8mb4_unicode_ci,
  `role` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `activation_status` tinyint(4) NOT NULL DEFAULT '0',
  `block_reason` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `blocked_at` timestamp NULL DEFAULT NULL,
  `place_holder` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_of_account_holder` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bic_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `barcode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(255) NOT NULL,
  `parent_id` bigint(20) DEFAULT '1',
  `Bedrijfsnaam` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Soort` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `City` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Contactpersoon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cashback` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `test` */

insert  into `test`(`id`,`name`,`username`,`email`,`password`,`avatar`,`gender`,`phone`,`address`,`birthday`,`iban`,`taal`,`klant_sinds`,`about`,`user_meta`,`role`,`activation_status`,`block_reason`,`blocked_at`,`place_holder`,`name_of_account_holder`,`bic_code`,`barcode`,`remember_token`,`user_id`,`parent_id`,`Bedrijfsnaam`,`Soort`,`City`,`Contactpersoon`,`cashback`,`created_at`,`updated_at`,`slug`) values (1,'Misty Streich','aperiam_nihil','ulrichquatess@gmail.com','$2y$10$fTInGzIS1X/BpYh8OIqhYuLscfionuHf0BbE6C/9WnJZWojRXCyAS',NULL,NULL,NULL,NULL,'0000-00-00','','','0000-00-00',NULL,NULL,'admin',0,'','2018-05-22 12:46:04',NULL,NULL,NULL,NULL,'nkImrflv8AfpmsIFi8MAxzxiWm6rsRKB4YeX9DxaRYQeBIOuu5gdk7tXKCcG',0,1,NULL,NULL,NULL,NULL,NULL,'2018-04-18 18:03:16','2018-04-18 18:03:16','Misty_Streich3645'),(2,'Joel Hammes','assumenda_id','fdouglas@example.org','$2y$10$fTInGzIS1X/BpYh8OIqhYuLscfionuHf0BbE6C/9WnJZWojRXCyAS','2.png',NULL,NULL,NULL,'0000-00-00','','','0000-00-00',NULL,'{\"i\":{\"kcal\":\"1200\",\"eiwit\":\"12525\",\"koolhydraat\":\"12065646\",\"vezel\":\"238882\",\"vet\":\"120885\"},\"b\":{\"kcal\":\"125550\",\"eiwit\":\"12\",\"koolhydraat\":\"12\",\"vezel\":\"12\",\"vet\":\"120\"},\"doelstelling\":\"Test Message\",\"mayur\":\"test\"}','user',1,'','2018-05-22 12:46:07',NULL,NULL,NULL,NULL,'tGxUwVOCYKJ9RML2TQOoTa5CrzJbCzYWmzLEAEfdDfHjspcPVF9swVefZIYj',0,1,NULL,NULL,NULL,NULL,NULL,'2018-04-18 18:03:16','2018-05-08 17:48:04',''),(3,'Andres Metz Sr.','pariatur_eos','admin@vh.com','$2y$10$oWeLVANkG.dkOCsbqynHyue3KL1MUXw6JEnQf2vpaaL.0gCBlYDei',NULL,'f','9876543210','adsofihvopads','2012-02-24',NULL,'Angola','1970-01-01','asdvas',NULL,'user',1,'','2018-05-22 12:46:07',NULL,NULL,NULL,NULL,'xEFj6SkKKm',0,1,NULL,NULL,NULL,NULL,NULL,'2018-04-18 18:03:16','2018-05-22 06:39:59',''),(4,'Marisa Effertz','ad_laboriosam','clara.watsica@example.org','$2y$10$oWeLVANkG.dkOCsbqynHyue3KL1MUXw6JEnQf2vpaaL.0gCBlYDei',NULL,NULL,NULL,NULL,'0000-00-00','','','0000-00-00',NULL,NULL,'user',0,'','2018-05-22 12:46:08',NULL,NULL,NULL,NULL,'lhk2Wysftn',0,1,NULL,NULL,NULL,NULL,NULL,'2018-04-18 18:03:16','2018-04-18 18:03:16',''),(5,'Hilton Bergnaum','quia_ducimus','btrantow@example.com','$2y$10$oWeLVANkG.dkOCsbqynHyue3KL1MUXw6JEnQf2vpaaL.0gCBlYDei',NULL,NULL,NULL,NULL,'0000-00-00','','','0000-00-00',NULL,NULL,'user',0,'','2018-05-22 12:46:08',NULL,NULL,NULL,NULL,'ZSawMIPsf4',0,1,NULL,NULL,NULL,NULL,NULL,'2018-04-18 18:03:16','2018-04-18 18:03:16','Hilton_Bergnaum6847'),(6,'Clint Von PhD','sit_quasi','price.werner@example.com','$2y$10$oWeLVANkG.dkOCsbqynHyue3KL1MUXw6JEnQf2vpaaL.0gCBlYDei',NULL,NULL,NULL,NULL,'0000-00-00','','','0000-00-00',NULL,NULL,'user',1,'','2018-05-22 12:46:10',NULL,NULL,NULL,NULL,'l4J6fv1pvI',0,1,NULL,NULL,NULL,NULL,NULL,'2018-04-18 18:03:16','2018-04-18 19:05:12',''),(7,'Theresa Sporer','voluptas_explicabo','vhansen@example.net','$2y$10$oWeLVANkG.dkOCsbqynHyue3KL1MUXw6JEnQf2vpaaL.0gCBlYDei',NULL,NULL,NULL,NULL,'0000-00-00','','','0000-00-00',NULL,NULL,'user',0,'','2018-05-22 12:46:09',NULL,NULL,NULL,NULL,'WZUdUPOnyp',0,1,NULL,NULL,NULL,NULL,NULL,'2018-04-18 18:03:16','2018-04-18 18:03:16',''),(8,'Simeon Koepp','dolores_rerum','gwen.nader@example.com','$2y$10$oWeLVANkG.dkOCsbqynHyue3KL1MUXw6JEnQf2vpaaL.0gCBlYDei',NULL,NULL,NULL,NULL,'0000-00-00','','','0000-00-00',NULL,NULL,'user',0,'','2018-05-22 12:46:10',NULL,NULL,NULL,NULL,'vsfNgU6mfb',0,1,NULL,NULL,NULL,NULL,NULL,'2018-04-18 18:03:16','2018-04-18 18:03:16',''),(9,'Weldon Williamson','eveniet_voluptatem','grant82@example.com','$2y$10$oWeLVANkG.dkOCsbqynHyue3KL1MUXw6JEnQf2vpaaL.0gCBlYDei',NULL,NULL,NULL,NULL,'0000-00-00','','','0000-00-00',NULL,NULL,'user',0,'','2018-05-22 12:46:14',NULL,NULL,NULL,NULL,'YCjWrawPxj',0,1,NULL,NULL,NULL,NULL,NULL,'2018-04-18 18:03:16','2018-04-18 18:03:16',''),(10,'Dr. Donnie Runte','provident_est','juliet.bernhard@example.org','$2y$10$oWeLVANkG.dkOCsbqynHyue3KL1MUXw6JEnQf2vpaaL.0gCBlYDei',NULL,NULL,NULL,NULL,'0000-00-00','','','0000-00-00',NULL,NULL,'user',0,'','2018-05-22 12:46:15',NULL,NULL,NULL,NULL,'SMEJgHmGih',0,1,NULL,NULL,NULL,NULL,NULL,'2018-04-18 18:03:16','2018-04-18 18:03:16',''),(13,'vishal patel','abc','abc@ttt.com','$2y$10$W038y1AXKLT7wmhMEgwupeT5JEUMokAldXdeaw0QLz42K/BCMxZtq',NULL,'m','9898646866','702-703 iscon,jodhpur crose',NULL,NULL,NULL,NULL,'dsfvds',NULL,'company',1,'','2018-05-22 12:46:18',NULL,NULL,NULL,NULL,NULL,0,1,NULL,NULL,NULL,NULL,NULL,'2018-05-21 10:48:10','2018-05-21 10:48:10','');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `iban` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `taal` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `klant_sinds` date DEFAULT NULL,
  `about` text COLLATE utf8mb4_unicode_ci,
  `user_meta` text COLLATE utf8mb4_unicode_ci,
  `role` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `activation_status` tinyint(4) NOT NULL DEFAULT '0',
  `block_reason` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `blocked_at` timestamp NULL DEFAULT NULL,
  `place_holder` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_of_account_holder` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bic_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `barcode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(255) NOT NULL,
  `parent_id` bigint(20) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `sign` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `packagefk` int(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`username`,`email`,`password`,`avatar`,`gender`,`phone`,`address`,`birthday`,`iban`,`taal`,`klant_sinds`,`about`,`user_meta`,`role`,`activation_status`,`block_reason`,`blocked_at`,`place_holder`,`name_of_account_holder`,`bic_code`,`barcode`,`remember_token`,`user_id`,`parent_id`,`created_at`,`updated_at`,`sign`,`packagefk`) values (1,'snehal gajjarsdgbavsdgb','aperiam_nihil','ulrichquatess@gmail.com','$2y$10$fTInGzIS1X/BpYh8OIqhYuLscfionuHf0BbE6C/9WnJZWojRXCyAS',NULL,'m','7046828181','A/2, ravi tenement, A/2, ravi tenement','1970-01-01','adfhbrdfh6874','India','1970-01-01','awsedgvardv',NULL,'admin',0,'','2018-05-22 12:46:04',NULL,NULL,NULL,NULL,'nkImrflv8AfpmsIFi8MAxzxiWm6rsRKB4YeX9DxaRYQeBIOuu5gdk7tXKCcG',1,1,'2018-04-18 18:03:16','2018-05-24 11:33:57','',0),(2,'Joel Hammes','assumenda_id','fdouglas@example.org','$2y$10$fTInGzIS1X/BpYh8OIqhYuLscfionuHf0BbE6C/9WnJZWojRXCyAS','2.png',NULL,NULL,NULL,'0000-00-00','','','0000-00-00',NULL,'{\"i\":{\"kcal\":\"1200\",\"eiwit\":\"12525\",\"koolhydraat\":\"12065646\",\"vezel\":\"238882\",\"vet\":\"120885\"},\"b\":{\"kcal\":\"125550\",\"eiwit\":\"12\",\"koolhydraat\":\"12\",\"vezel\":\"12\",\"vet\":\"120\"},\"doelstelling\":\"Test Message\",\"mayur\":\"test\"}','user',1,'','2018-05-22 12:46:07',NULL,NULL,NULL,NULL,'tGxUwVOCYKJ9RML2TQOoTa5CrzJbCzYWmzLEAEfdDfHjspcPVF9swVefZIYj',0,1,'2018-04-18 18:03:16','2018-05-08 17:48:04','',0),(3,'Andres Metz Sr.','pariatur_eos','admin@vh.com','$2y$10$oWeLVANkG.dkOCsbqynHyue3KL1MUXw6JEnQf2vpaaL.0gCBlYDei',NULL,'f','9876543210','adsofihvopads','2012-02-24',NULL,'Angola','1970-01-01','asdvas',NULL,'user',1,'','2018-05-22 12:46:07',NULL,NULL,NULL,NULL,'xEFj6SkKKm',0,1,'2018-04-18 18:03:16','2018-05-22 06:39:59','',0),(4,'Marisa Effertz','ad_laboriosam','clara.watsica@example.org','$2y$10$oWeLVANkG.dkOCsbqynHyue3KL1MUXw6JEnQf2vpaaL.0gCBlYDei',NULL,NULL,NULL,NULL,'0000-00-00','','','0000-00-00',NULL,NULL,'user',0,'','2018-05-22 12:46:08',NULL,NULL,NULL,NULL,'lhk2Wysftn',0,1,'2018-04-18 18:03:16','2018-04-18 18:03:16','',0),(5,'Hilton Bergnaum','quia_ducimus','btrantow@example.com','$2y$10$oWeLVANkG.dkOCsbqynHyue3KL1MUXw6JEnQf2vpaaL.0gCBlYDei',NULL,NULL,NULL,NULL,'0000-00-00','','','0000-00-00',NULL,NULL,'user',0,'','2018-05-22 12:46:08',NULL,NULL,NULL,NULL,'ZSawMIPsf4',0,1,'2018-04-18 18:03:16','2018-04-18 18:03:16','',0),(6,'Clint Von PhD','sit_quasi','price.werner@example.com','$2y$10$oWeLVANkG.dkOCsbqynHyue3KL1MUXw6JEnQf2vpaaL.0gCBlYDei',NULL,NULL,NULL,NULL,'0000-00-00','','','0000-00-00',NULL,NULL,'user',1,'','2018-05-22 12:46:10',NULL,NULL,NULL,NULL,'l4J6fv1pvI',0,1,'2018-04-18 18:03:16','2018-04-18 19:05:12','',0),(7,'Theresa Sporer','voluptas_explicabo','vhansen@example.net','$2y$10$oWeLVANkG.dkOCsbqynHyue3KL1MUXw6JEnQf2vpaaL.0gCBlYDei',NULL,NULL,NULL,NULL,'0000-00-00','','','0000-00-00',NULL,NULL,'user',0,'','2018-05-22 12:46:09',NULL,NULL,NULL,NULL,'WZUdUPOnyp',0,1,'2018-04-18 18:03:16','2018-04-18 18:03:16','',0),(8,'Simeon Koepp','dolores_rerum','gwen.nader@example.com','$2y$10$oWeLVANkG.dkOCsbqynHyue3KL1MUXw6JEnQf2vpaaL.0gCBlYDei',NULL,NULL,NULL,NULL,'0000-00-00','','','0000-00-00',NULL,NULL,'user',0,'','2018-05-22 12:46:10',NULL,NULL,NULL,NULL,'vsfNgU6mfb',0,1,'2018-04-18 18:03:16','2018-04-18 18:03:16','',0),(9,'Weldon Williamson','eveniet_voluptatem','grant82@example.com','$2y$10$oWeLVANkG.dkOCsbqynHyue3KL1MUXw6JEnQf2vpaaL.0gCBlYDei',NULL,NULL,NULL,NULL,'0000-00-00','','','0000-00-00',NULL,NULL,'user',0,'','2018-05-22 12:46:14',NULL,NULL,NULL,NULL,'YCjWrawPxj',0,1,'2018-04-18 18:03:16','2018-04-18 18:03:16','',0),(10,'Dr. Donnie Runte','provident_est','juliet.bernhard@example.org','$2y$10$oWeLVANkG.dkOCsbqynHyue3KL1MUXw6JEnQf2vpaaL.0gCBlYDei',NULL,NULL,NULL,NULL,'0000-00-00','','','0000-00-00',NULL,NULL,'user',0,'','2018-05-22 12:46:15',NULL,NULL,NULL,NULL,'SMEJgHmGih',0,1,'2018-04-18 18:03:16','2018-04-18 18:03:16','',0),(13,'vishal patel','abc','abc@ttt.com','$2y$10$W038y1AXKLT7wmhMEgwupeT5JEUMokAldXdeaw0QLz42K/BCMxZtq',NULL,'m','9898646866','702-703 iscon,jodhpur crose',NULL,NULL,NULL,NULL,'dsfvds',NULL,'company',1,'','2018-05-22 12:46:18',NULL,NULL,NULL,NULL,NULL,0,1,'2018-05-21 10:48:10','2018-05-21 10:48:10','',0),(15,'snehal_gajjar','','snehal@virtualheight.com','$2y$10$Cy45.dkisQF9lc8dliviZeRbMLlqMWUZiZ2LlvUPz4DNMW5KhbG7C',NULL,NULL,'7046828181',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'user',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,1,'2018-05-24 21:13:00','2018-05-24 21:13:00','{\"0\":{\"jQuery3310066079860842207522\":{\"kbwSignature\":\"{\\\"lines\\\":[]}\"},\"jQuery3310066079860842207521\":{\"events\":{\"remove\":[{\"type\":\"remove\",\"origType\":\"remove\",\"guid\":4,\"namespace\":\"signature0\"}],\"mousedown\":[{\"type\":\"mousedown\",\"origType\":\"mousedown\",\"guid\":5,\"namespace\":\"signature\"}],\"click\":[{\"type\":\"click\",\"origType\":\"click\",\"guid\":6,\"namespace\":\"signature\"}]}}},\"length\":1}',0),(19,'snehal_gajjar','snehal_gajjar8496','snehal@asdads.com','$2y$10$/zTsurMbF.zZ.PS9/iHLnOcoBUkWidb.fS989qCi.JuAGiLvt.ybG',NULL,NULL,'7046828181',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'user',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,1,'2018-05-24 21:17:13','2018-05-24 21:17:13','{\"0\":{\"jQuery331032680550806812892\":{\"kbwSignature\":\"{\\\"lines\\\":[]}\"},\"jQuery331032680550806812891\":{\"events\":{\"remove\":[{\"type\":\"remove\",\"origType\":\"remove\",\"guid\":4,\"namespace\":\"signature0\"}],\"mousedown\":[{\"type\":\"mousedown\",\"origType\":\"mousedown\",\"guid\":5,\"namespace\":\"signature\"}],\"click\":[{\"type\":\"click\",\"origType\":\"click\",\"guid\":6,\"namespace\":\"signature\"}]}}},\"length\":1}',0);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
