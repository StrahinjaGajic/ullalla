# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.18-0ubuntu0.16.04.1)
# Database: ullalla
# Generation Time: 2018-02-21 14:39:03 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table banner_page
# ------------------------------------------------------------

DROP TABLE IF EXISTS `banner_page`;

CREATE TABLE `banner_page` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `banner_id` int(10) unsigned NOT NULL,
  `page_id` int(10) unsigned NOT NULL,
  `banner_size_id` int(10) unsigned NOT NULL,
  `banner_activation_date` timestamp NULL DEFAULT NULL,
  `banner_expiry_date` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `banner_page_page_id_foreign` (`page_id`),
  KEY `banner_page_banner_id_foreign` (`banner_id`),
  KEY `banner_page_banner_size_id_foreign` (`banner_size_id`),
  CONSTRAINT `banner_page_banner_id_foreign` FOREIGN KEY (`banner_id`) REFERENCES `banners` (`id`) ON DELETE CASCADE,
  CONSTRAINT `banner_page_banner_size_id_foreign` FOREIGN KEY (`banner_size_id`) REFERENCES `banner_sizes` (`id`) ON DELETE CASCADE,
  CONSTRAINT `banner_page_page_id_foreign` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `banner_page` WRITE;
/*!40000 ALTER TABLE `banner_page` DISABLE KEYS */;

INSERT INTO `banner_page` (`id`, `banner_id`, `page_id`, `banner_size_id`, `banner_activation_date`, `banner_expiry_date`)
VALUES
	(3,16,1,2,'2018-01-29 21:19:56','2018-01-29 21:19:56'),
	(4,16,1,1,'2018-01-29 21:19:56','2018-01-29 21:19:56'),
	(5,16,1,3,'2018-01-29 21:19:56','2018-01-29 21:19:56'),
	(6,16,4,2,'2018-01-29 21:19:56','2018-01-29 21:19:56'),
	(7,16,4,4,'2018-01-29 21:19:56','2018-01-29 21:19:56'),
	(8,16,4,5,'2018-01-29 21:19:56','2018-01-29 21:19:56'),
	(9,16,5,2,'2018-01-29 21:19:56','2018-01-29 21:19:56'),
	(10,16,3,6,'2018-01-29 21:19:56','2018-01-29 21:19:56'),
	(11,16,3,3,'2018-01-29 21:19:56','2018-01-29 21:19:56'),
	(12,16,3,4,'2018-01-29 21:19:56','2018-01-29 21:19:56'),
	(13,16,3,5,'2018-01-29 21:19:56','2018-01-29 21:19:56'),
	(14,16,3,7,'2018-01-29 21:19:56','2018-01-29 21:19:56'),
	(15,16,2,4,'2018-01-29 21:19:56','2018-01-29 21:19:56'),
	(16,16,2,7,'2018-01-29 21:19:56','2018-01-29 21:19:56'),
	(17,16,2,5,'2018-01-29 21:19:56','2018-01-29 21:19:56'),
	(18,17,1,5,'2018-01-29 21:29:37','2018-01-29 21:29:37'),
	(19,17,1,3,'2018-01-29 21:29:37','2018-01-29 21:29:37'),
	(20,17,1,4,'2018-01-29 21:29:37','2018-01-29 21:29:37'),
	(21,18,1,5,'2018-01-29 22:12:09','2018-01-29 22:12:09'),
	(22,18,1,3,'2018-01-29 22:12:09','2018-01-29 22:12:09'),
	(23,18,1,4,'2018-01-29 22:12:09','2018-01-29 22:12:09'),
	(24,19,1,3,'2018-01-29 22:12:25','2018-01-29 22:12:25'),
	(25,19,1,4,'2018-01-29 22:12:25','2018-01-29 22:12:25'),
	(26,20,1,4,'2018-01-29 22:12:35','2018-01-29 22:12:35'),
	(27,20,1,5,'2018-01-29 22:12:35','2018-01-29 22:12:35'),
	(28,21,1,5,'2018-01-30 12:26:47','2018-01-30 12:26:47'),
	(29,22,1,4,'2018-01-30 12:27:42','2018-01-30 12:27:42'),
	(30,23,1,4,'2018-01-30 13:01:00','2018-01-30 13:01:00'),
	(31,23,1,5,'2018-01-30 13:01:00','2018-01-30 13:01:00'),
	(32,24,1,4,'2018-01-30 13:01:07','2018-01-30 13:01:07'),
	(33,25,1,3,'2018-01-30 13:01:17','2018-01-30 13:01:17'),
	(34,26,1,2,'2018-01-30 17:25:33','2018-01-30 17:25:33'),
	(35,27,1,2,'2018-01-30 17:25:40','2018-01-30 17:25:40'),
	(36,28,1,1,'2018-01-30 17:25:48','2018-01-30 17:25:48'),
	(37,29,1,1,'2018-01-30 17:25:55','2018-01-30 17:25:55'),
	(38,30,1,1,NULL,NULL);

/*!40000 ALTER TABLE `banner_page` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table banner_sizes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `banner_sizes`;

CREATE TABLE `banner_sizes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `banner_size_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `banner_size_price` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `banner_sizes` WRITE;
/*!40000 ALTER TABLE `banner_sizes` DISABLE KEYS */;

INSERT INTO `banner_sizes` (`id`, `banner_size_name`, `banner_size_price`)
VALUES
	(1,'Big',100),
	(2,'Medium',70),
	(3,'Small/Quarter Bottom',30),
	(4,'Small/Horizontal Bottom',50),
	(5,'Small/Vertical Bottom',50),
	(6,'Small/Quarter Left Sidebar',30),
	(7,'Small/Vertical Left Sidebar',50);

/*!40000 ALTER TABLE `banner_sizes` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table banners
# ------------------------------------------------------------

DROP TABLE IF EXISTS `banners`;

CREATE TABLE `banners` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `bannerable_id` int(10) unsigned DEFAULT NULL,
  `bannerable_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prepared_photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner_photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner_total_amount` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `banners_user_id_foreign` (`bannerable_id`),
  CONSTRAINT `banners_user_id_foreign` FOREIGN KEY (`bannerable_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `banners` WRITE;
/*!40000 ALTER TABLE `banners` DISABLE KEYS */;

INSERT INTO `banners` (`id`, `bannerable_id`, `bannerable_type`, `banner_url`, `prepared_photo`, `banner_photo`, `banner_total_amount`, `created_at`, `updated_at`)
VALUES
	(16,1,'App\\Models\\User',NULL,NULL,'https://ucarecdn.com/2d05c9f2-315a-41f8-ac0a-21c606756efa/jebo_sliku.jpg',0,NULL,NULL),
	(17,1,'App\\Models\\User',NULL,NULL,'https://ucarecdn.com/99edb167-eeb2-4cc3-9652-36eae1c6ca3d/artsfoncom73049.jpg',0,NULL,NULL),
	(18,1,'App\\Models\\User',NULL,NULL,'https://ucarecdn.com/781e3267-4cce-41e4-aee4-07f092f353bf/044cd180962f191c28ef704d08341925.jpg',0,NULL,NULL),
	(19,1,'App\\Models\\User',NULL,NULL,'https://ucarecdn.com/fc4aedb4-d949-43e8-bfc0-b987468efa92/jessicajaneclement6.jpg',0,NULL,NULL),
	(20,1,'App\\Models\\User',NULL,NULL,'https://ucarecdn.com/99edb167-eeb2-4cc3-9652-36eae1c6ca3d/artsfoncom73049.jpg',0,NULL,NULL),
	(21,1,'App\\Models\\User',NULL,NULL,'https://ucarecdn.com/fc4aedb4-d949-43e8-bfc0-b987468efa92/jessicajaneclement6.jpg',0,NULL,NULL),
	(22,1,'App\\Models\\User',NULL,NULL,'https://ucarecdn.com/c904e9ea-f771-462c-bdf2-3a6e19e9ba8d/EroticGirl4.jpg',0,NULL,NULL),
	(23,1,'App\\Models\\User',NULL,NULL,'https://ucarecdn.com/c904e9ea-f771-462c-bdf2-3a6e19e9ba8d/EroticGirl4.jpg',0,NULL,NULL),
	(24,1,'App\\Models\\User',NULL,NULL,'https://ucarecdn.com/99edb167-eeb2-4cc3-9652-36eae1c6ca3d/artsfoncom73049.jpg',0,NULL,NULL),
	(25,1,'App\\Models\\User',NULL,NULL,'https://ucarecdn.com/781e3267-4cce-41e4-aee4-07f092f353bf/044cd180962f191c28ef704d08341925.jpg',0,NULL,NULL),
	(26,1,'App\\Models\\User',NULL,NULL,'https://ucarecdn.com/c904e9ea-f771-462c-bdf2-3a6e19e9ba8d/EroticGirl4.jpg',0,NULL,NULL),
	(27,1,'App\\Models\\User',NULL,NULL,'https://ucarecdn.com/fc4aedb4-d949-43e8-bfc0-b987468efa92/jessicajaneclement6.jpg',0,NULL,NULL),
	(28,1,'App\\Models\\User',NULL,NULL,'https://ucarecdn.com/fc4aedb4-d949-43e8-bfc0-b987468efa92/jessicajaneclement6.jpg',0,NULL,NULL),
	(29,1,'App\\Models\\User',NULL,NULL,'https://ucarecdn.com/99edb167-eeb2-4cc3-9652-36eae1c6ca3d/artsfoncom73049.jpg',0,NULL,NULL),
	(30,1,'App\\Models\\User','https://google.com',NULL,'https://ucarecdn.com/733a97f5-e9f3-42c5-ab5f-a2bb771a1b0b/-/crop/564x645/0,0/-/resize/490x560/',400,'2018-02-15 23:14:23','2018-02-15 23:14:23');

/*!40000 ALTER TABLE `banners` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table black_books
# ------------------------------------------------------------

DROP TABLE IF EXISTS `black_books`;

CREATE TABLE `black_books` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `black_books_user_id_foreign` (`user_id`),
  CONSTRAINT `black_books_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `black_books` WRITE;
/*!40000 ALTER TABLE `black_books` DISABLE KEYS */;

INSERT INTO `black_books` (`id`, `user_id`, `name`, `city`, `phone`, `comment`, `photo`, `date`, `created_at`, `updated_at`)
VALUES
	(1,1,'asdasd','sdsdsd','asdas','asdsadasd','https://ucarecdn.com/6fcae11e-f347-4ca3-89e7-5c8dd5a9edfc/-/crop/597x597/152,0/-/preview/-/resize/200x200/','2018-01-22 20:13:37','2018-01-22 20:13:37','2018-01-22 20:13:37'),
	(2,1,'asd','asdas','sad','asdasd','https://ucarecdn.com/49d15e32-063c-401b-b18c-8848e83e2aa8/-/crop/597x597/152,0/-/preview/','2018-01-22 00:00:00','2018-01-22 20:15:30','2018-01-22 20:15:30'),
	(3,1,'Uros','Pirot','0603198250','he was very violent!','https://ucarecdn.com/c0134b3e-ded4-4b49-ab2f-375cd5e74cd8/-/crop/800x800/0,0/-/preview/','2018-01-10 00:00:00','2018-01-24 13:41:57','2018-01-24 13:41:57'),
	(4,1,'Uros','Pirot','0603198250','aasdasd','https://ucarecdn.com/bea9ee55-9ed9-43f0-9473-88b2b8ae6945/-/crop/1200x1199/720,0/-/preview/','2018-02-14 00:00:00','2018-02-14 11:25:28','2018-02-14 11:25:28');

/*!40000 ALTER TABLE `black_books` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table cantons
# ------------------------------------------------------------

DROP TABLE IF EXISTS `cantons`;

CREATE TABLE `cantons` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `canton_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `cantons` WRITE;
/*!40000 ALTER TABLE `cantons` DISABLE KEYS */;

INSERT INTO `cantons` (`id`, `canton_name`)
VALUES
	(1,'Zürich'),
	(2,'Bern'),
	(3,'Luzern'),
	(4,'Uri'),
	(5,'Schwyz'),
	(6,'Obwalden'),
	(7,'Nidwalden'),
	(8,'Glarus'),
	(9,'Zug'),
	(10,'Fribourg'),
	(11,'Solothurn'),
	(12,'Basel-Stadt'),
	(13,'Basel-Landschaft'),
	(14,'Schaffhausen'),
	(15,'Appenzell Ausserrhoden'),
	(16,'Appenzell Innerrhoden'),
	(17,'St. Gallen'),
	(18,'Graubünden'),
	(19,'Aargau'),
	(20,'Thurgau'),
	(21,'Ticino'),
	(22,'Vaud'),
	(23,'Valais'),
	(24,'Neuchâtel'),
	(25,'Geneva'),
	(26,'Jura');

/*!40000 ALTER TABLE `cantons` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table clubs_info
# ------------------------------------------------------------

DROP TABLE IF EXISTS `clubs_info`;

CREATE TABLE `clubs_info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` int(11) NOT NULL,
  `free` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `clubs_info` WRITE;
/*!40000 ALTER TABLE `clubs_info` DISABLE KEYS */;

INSERT INTO `clubs_info` (`id`, `name`, `value`, `free`, `created_at`, `updated_at`)
VALUES
	(1,'something',2,0,NULL,'2018-01-12 17:46:31'),
	(2,'something_else',0,0,NULL,NULL),
	(3,'entrance',1,1,'2018-01-19 12:01:49','2018-01-19 12:01:49'),
	(4,'wellness',1,1,'2018-01-19 12:01:49','2018-01-19 12:01:49'),
	(5,'food',1,1,'2018-01-19 12:01:49','2018-01-19 12:01:49'),
	(6,'outdoor',1,1,'2018-01-19 12:01:49','2018-01-19 12:01:49'),
	(7,'entrance',1,1,'2018-01-19 12:01:49','2018-01-19 12:01:49'),
	(8,'wellness',1,1,'2018-01-19 12:01:49','2018-01-19 12:01:49'),
	(9,'food',1,1,'2018-01-19 12:01:49','2018-01-19 12:01:49'),
	(10,'outdoor',1,1,'2018-01-19 12:01:49','2018-01-19 12:01:49'),
	(11,'entrance',1,1,'2018-01-19 12:04:07','2018-01-19 12:04:07'),
	(12,'wellness',1,1,'2018-01-19 12:04:07','2018-01-19 12:04:07'),
	(13,'food',1,1,'2018-01-19 12:04:07','2018-01-19 12:04:07'),
	(14,'outdoor',1,1,'2018-01-19 12:04:07','2018-01-19 12:04:07'),
	(15,'entrance',1,1,'2018-01-19 12:04:36','2018-01-19 12:04:36'),
	(16,'wellness',1,1,'2018-01-19 12:04:36','2018-01-19 12:04:36'),
	(17,'food',1,1,'2018-01-19 12:04:36','2018-01-19 12:04:36'),
	(18,'outdoor',1,1,'2018-01-19 12:04:36','2018-01-19 12:04:36'),
	(19,'entrance',1,1,'2018-01-19 12:09:25','2018-01-19 12:09:25'),
	(20,'wellness',1,1,'2018-01-19 12:09:25','2018-01-19 12:09:25'),
	(21,'food',1,1,'2018-01-19 12:09:25','2018-01-19 12:09:25'),
	(22,'outdoor',1,1,'2018-01-19 12:09:25','2018-01-19 12:09:25'),
	(23,'entrance',1,1,'2018-01-19 15:57:26','2018-01-19 15:57:26'),
	(24,'entrance',1,1,'2018-01-19 15:57:26','2018-01-19 15:57:26'),
	(25,'wellness',1,1,'2018-01-19 15:57:26','2018-01-19 15:57:26'),
	(26,'food',1,1,'2018-01-19 15:57:26','2018-01-19 15:57:26'),
	(27,'wellness',1,1,'2018-01-19 15:57:26','2018-01-19 15:57:26'),
	(28,'outdoor',1,1,'2018-01-19 15:57:26','2018-01-19 15:57:26'),
	(29,'food',1,1,'2018-01-19 15:57:26','2018-01-19 15:57:26'),
	(30,'outdoor',1,1,'2018-01-19 15:57:26','2018-01-19 15:57:26'),
	(31,'entrance',1,1,'2018-01-19 15:57:46','2018-01-19 15:57:46'),
	(32,'wellness',1,1,'2018-01-19 15:57:46','2018-01-19 15:57:46'),
	(33,'food',1,1,'2018-01-19 15:57:46','2018-01-19 15:57:46'),
	(34,'outdoor',1,1,'2018-01-19 15:57:46','2018-01-19 15:57:46'),
	(35,'entrance',1,1,'2018-01-19 15:58:20','2018-01-19 15:58:20'),
	(36,'wellness',1,1,'2018-01-19 15:58:20','2018-01-19 15:58:20'),
	(37,'food',1,1,'2018-01-19 15:58:20','2018-01-19 15:58:20'),
	(38,'outdoor',1,1,'2018-01-19 15:58:20','2018-01-19 15:58:20'),
	(39,'entrance',1,1,'2018-01-19 15:58:37','2018-01-19 15:58:37'),
	(40,'wellness',1,1,'2018-01-19 15:58:37','2018-01-19 15:58:37'),
	(41,'food',1,1,'2018-01-19 15:58:37','2018-01-19 15:58:37'),
	(42,'outdoor',1,1,'2018-01-19 15:58:37','2018-01-19 15:58:37'),
	(43,'entrance',1,1,'2018-01-19 16:00:52','2018-01-19 16:00:52'),
	(44,'wellness',1,1,'2018-01-19 16:00:52','2018-01-19 16:00:52'),
	(45,'food',1,1,'2018-01-19 16:00:52','2018-01-19 16:00:52'),
	(46,'outdoor',1,1,'2018-01-19 16:00:52','2018-01-19 16:00:52'),
	(47,'entrance',1,1,'2018-01-19 16:01:13','2018-01-19 16:01:13'),
	(48,'wellness',1,1,'2018-01-19 16:01:13','2018-01-19 16:01:13'),
	(49,'food',1,1,'2018-01-19 16:01:13','2018-01-19 16:01:13'),
	(50,'outdoor',1,1,'2018-01-19 16:01:13','2018-01-19 16:01:13'),
	(51,'entrance',1,1,'2018-01-19 16:01:31','2018-01-19 16:01:31'),
	(52,'wellness',1,1,'2018-01-19 16:01:31','2018-01-19 16:01:31'),
	(53,'food',1,1,'2018-01-19 16:01:31','2018-01-19 16:01:31'),
	(54,'outdoor',1,1,'2018-01-19 16:01:31','2018-01-19 16:01:31'),
	(55,'entrance',1,1,'2018-01-19 16:01:36','2018-01-19 16:01:36'),
	(56,'wellness',1,1,'2018-01-19 16:01:36','2018-01-19 16:01:36'),
	(57,'food',1,1,'2018-01-19 16:01:36','2018-01-19 16:01:36'),
	(58,'outdoor',1,1,'2018-01-19 16:01:36','2018-01-19 16:01:36'),
	(59,'entrance',1,1,'2018-01-19 16:02:35','2018-01-19 16:02:35'),
	(60,'wellness',1,1,'2018-01-19 16:02:35','2018-01-19 16:02:35'),
	(61,'food',1,1,'2018-01-19 16:02:35','2018-01-19 16:02:35'),
	(62,'outdoor',1,1,'2018-01-19 16:02:35','2018-01-19 16:02:35'),
	(63,'entrance',1,1,'2018-01-19 16:02:52','2018-01-19 16:02:52'),
	(64,'wellness',1,1,'2018-01-19 16:02:52','2018-01-19 16:02:52'),
	(65,'food',1,1,'2018-01-19 16:02:52','2018-01-19 16:02:52'),
	(66,'outdoor',1,1,'2018-01-19 16:02:52','2018-01-19 16:02:52'),
	(67,'entrance',1,1,'2018-01-19 16:03:00','2018-01-19 16:03:00'),
	(68,'wellness',1,1,'2018-01-19 16:03:00','2018-01-19 16:03:00'),
	(69,'food',1,1,'2018-01-19 16:03:00','2018-01-19 16:03:00'),
	(70,'outdoor',1,1,'2018-01-19 16:03:00','2018-01-19 16:03:00'),
	(71,'entrance',1,1,'2018-01-19 16:03:54','2018-01-19 16:03:54'),
	(72,'wellness',1,1,'2018-01-19 16:03:54','2018-01-19 16:03:54'),
	(73,'food',1,1,'2018-01-19 16:03:54','2018-01-19 16:03:54'),
	(74,'outdoor',1,1,'2018-01-19 16:03:54','2018-01-19 16:03:54'),
	(75,'entrance',1,1,'2018-01-19 16:08:29','2018-01-19 16:08:29'),
	(76,'wellness',1,1,'2018-01-19 16:08:29','2018-01-19 16:08:29'),
	(77,'food',1,1,'2018-01-19 16:08:29','2018-01-19 16:08:29'),
	(78,'entrance',1,1,'2018-01-19 16:08:29','2018-01-19 16:08:29'),
	(79,'wellness',1,1,'2018-01-19 16:08:29','2018-01-19 16:08:29'),
	(80,'outdoor',1,1,'2018-01-19 16:08:29','2018-01-19 16:08:29'),
	(81,'food',1,1,'2018-01-19 16:08:29','2018-01-19 16:08:29'),
	(82,'outdoor',1,1,'2018-01-19 16:08:29','2018-01-19 16:08:29'),
	(83,'entrance',1,1,'2018-01-19 16:08:51','2018-01-19 16:08:51'),
	(84,'wellness',1,1,'2018-01-19 16:08:51','2018-01-19 16:08:51'),
	(85,'food',1,1,'2018-01-19 16:08:51','2018-01-19 16:08:51'),
	(86,'outdoor',1,1,'2018-01-19 16:08:51','2018-01-19 16:08:51'),
	(87,'entrance',1,1,'2018-01-19 16:18:47','2018-01-19 16:18:47'),
	(88,'wellness',1,1,'2018-01-19 16:18:47','2018-01-19 16:18:47'),
	(89,'entrance',1,1,'2018-01-19 16:18:47','2018-01-19 16:18:47'),
	(90,'food',1,1,'2018-01-19 16:18:47','2018-01-19 16:18:47'),
	(91,'outdoor',1,1,'2018-01-19 16:18:47','2018-01-19 16:18:47'),
	(92,'wellness',1,1,'2018-01-19 16:18:47','2018-01-19 16:18:47'),
	(93,'food',1,1,'2018-01-19 16:18:47','2018-01-19 16:18:47'),
	(94,'outdoor',1,1,'2018-01-19 16:18:47','2018-01-19 16:18:47'),
	(95,'entrance',1,1,'2018-01-19 16:20:55','2018-01-19 16:20:55'),
	(96,'wellness',1,1,'2018-01-19 16:20:55','2018-01-19 16:20:55'),
	(97,'food',1,1,'2018-01-19 16:20:55','2018-01-19 16:20:55'),
	(98,'outdoor',1,1,'2018-01-19 16:20:55','2018-01-19 16:20:55'),
	(99,'entrance',1,1,'2018-01-19 16:20:55','2018-01-19 16:20:55'),
	(100,'wellness',1,1,'2018-01-19 16:20:55','2018-01-19 16:20:55'),
	(101,'food',1,1,'2018-01-19 16:20:55','2018-01-19 16:20:55'),
	(102,'outdoor',1,1,'2018-01-19 16:20:55','2018-01-19 16:20:55'),
	(103,'entrance',1,1,'2018-01-19 16:24:52','2018-01-19 16:24:52'),
	(104,'wellness',1,1,'2018-01-19 16:24:52','2018-01-19 16:24:52'),
	(105,'food',1,1,'2018-01-19 16:24:52','2018-01-19 16:24:52'),
	(106,'outdoor',1,1,'2018-01-19 16:24:52','2018-01-19 16:24:52'),
	(107,'entrance',1,1,'2018-01-19 16:24:52','2018-01-19 16:24:52'),
	(108,'wellness',1,1,'2018-01-19 16:24:52','2018-01-19 16:24:52'),
	(109,'food',1,1,'2018-01-19 16:24:52','2018-01-19 16:24:52'),
	(110,'outdoor',1,1,'2018-01-19 16:24:52','2018-01-19 16:24:52'),
	(111,'entrance',1,1,'2018-01-19 16:26:52','2018-01-19 16:26:52'),
	(112,'wellness',1,1,'2018-01-19 16:26:52','2018-01-19 16:26:52'),
	(113,'food',1,1,'2018-01-19 16:26:52','2018-01-19 16:26:52'),
	(114,'outdoor',1,1,'2018-01-19 16:26:52','2018-01-19 16:26:52'),
	(115,'entrance',1,1,'2018-01-19 16:26:52','2018-01-19 16:26:52'),
	(116,'wellness',1,1,'2018-01-19 16:26:52','2018-01-19 16:26:52'),
	(117,'food',1,1,'2018-01-19 16:26:52','2018-01-19 16:26:52'),
	(118,'outdoor',1,1,'2018-01-19 16:26:52','2018-01-19 16:26:52'),
	(119,'entrance',1,1,'2018-01-19 16:28:40','2018-01-19 16:28:40'),
	(120,'wellness',1,1,'2018-01-19 16:28:40','2018-01-19 16:28:40'),
	(121,'food',1,1,'2018-01-19 16:28:40','2018-01-19 16:28:40'),
	(122,'outdoor',1,1,'2018-01-19 16:28:40','2018-01-19 16:28:40'),
	(123,'entrance',1,1,'2018-01-19 16:28:40','2018-01-19 16:28:40'),
	(124,'wellness',1,1,'2018-01-19 16:28:40','2018-01-19 16:28:40'),
	(125,'food',1,1,'2018-01-19 16:28:40','2018-01-19 16:28:40'),
	(126,'outdoor',1,1,'2018-01-19 16:28:40','2018-01-19 16:28:40'),
	(127,'entrance',1,1,'2018-01-19 16:31:33','2018-01-19 16:31:33'),
	(128,'wellness',1,1,'2018-01-19 16:31:33','2018-01-19 16:31:33'),
	(129,'food',1,1,'2018-01-19 16:31:33','2018-01-19 16:31:33'),
	(130,'outdoor',1,1,'2018-01-19 16:31:33','2018-01-19 16:31:33'),
	(131,'entrance',1,1,'2018-01-19 16:31:33','2018-01-19 16:31:33'),
	(132,'wellness',1,1,'2018-01-19 16:31:33','2018-01-19 16:31:33'),
	(133,'food',1,1,'2018-01-19 16:31:33','2018-01-19 16:31:33'),
	(134,'outdoor',1,1,'2018-01-19 16:31:33','2018-01-19 16:31:33'),
	(135,'entrance',1,1,'2018-01-19 16:32:43','2018-01-19 16:32:43'),
	(136,'wellness',1,1,'2018-01-19 16:32:43','2018-01-19 16:32:43'),
	(137,'food',1,1,'2018-01-19 16:32:43','2018-01-19 16:32:43'),
	(138,'outdoor',1,1,'2018-01-19 16:32:43','2018-01-19 16:32:43'),
	(139,'entrance',1,1,'2018-01-19 16:32:44','2018-01-19 16:32:44'),
	(140,'wellness',1,1,'2018-01-19 16:32:44','2018-01-19 16:32:44'),
	(141,'food',1,1,'2018-01-19 16:32:44','2018-01-19 16:32:44'),
	(142,'outdoor',1,1,'2018-01-19 16:32:44','2018-01-19 16:32:44'),
	(143,'entrance',1,1,'2018-01-19 16:46:17','2018-01-19 16:46:17'),
	(144,'wellness',1,1,'2018-01-19 16:46:17','2018-01-19 16:46:17'),
	(145,'food',1,1,'2018-01-19 16:46:17','2018-01-19 16:46:17'),
	(146,'outdoor',1,1,'2018-01-19 16:46:17','2018-01-19 16:46:17'),
	(147,'entrance',1,1,'2018-01-19 16:46:17','2018-01-19 16:46:17'),
	(148,'wellness',1,1,'2018-01-19 16:46:17','2018-01-19 16:46:17'),
	(149,'food',1,1,'2018-01-19 16:46:17','2018-01-19 16:46:17'),
	(150,'outdoor',1,1,'2018-01-19 16:46:17','2018-01-19 16:46:17'),
	(151,'entrance',1,1,'2018-01-19 16:47:15','2018-01-19 16:47:15'),
	(152,'wellness',1,1,'2018-01-19 16:47:15','2018-01-19 16:47:15'),
	(153,'food',1,1,'2018-01-19 16:47:15','2018-01-19 16:47:15'),
	(154,'outdoor',1,1,'2018-01-19 16:47:15','2018-01-19 16:47:15'),
	(155,'entrance',1,1,'2018-01-19 16:47:46','2018-01-19 16:47:46'),
	(156,'wellness',1,1,'2018-01-19 16:47:46','2018-01-19 16:47:46'),
	(157,'food',1,1,'2018-01-19 16:47:46','2018-01-19 16:47:46'),
	(158,'outdoor',1,1,'2018-01-19 16:47:46','2018-01-19 16:47:46'),
	(159,'entrance',1,1,'2018-01-19 16:48:11','2018-01-19 16:48:11'),
	(160,'wellness',1,1,'2018-01-19 16:48:11','2018-01-19 16:48:11'),
	(161,'food',1,1,'2018-01-19 16:48:11','2018-01-19 16:48:11'),
	(162,'outdoor',1,1,'2018-01-19 16:48:11','2018-01-19 16:48:11'),
	(163,'entrance',1,1,'2018-01-19 16:49:58','2018-01-19 16:49:58'),
	(164,'wellness',1,1,'2018-01-19 16:49:58','2018-01-19 16:49:58'),
	(165,'food',1,1,'2018-01-19 16:49:58','2018-01-19 16:49:58'),
	(166,'outdoor',1,1,'2018-01-19 16:49:58','2018-01-19 16:49:58'),
	(167,'entrance',1,1,'2018-01-19 16:49:58','2018-01-19 16:49:58'),
	(168,'wellness',1,1,'2018-01-19 16:49:58','2018-01-19 16:49:58'),
	(169,'food',1,1,'2018-01-19 16:49:58','2018-01-19 16:49:58'),
	(170,'outdoor',1,1,'2018-01-19 16:49:58','2018-01-19 16:49:58'),
	(171,'entrance',1,1,'2018-02-12 17:39:12','2018-02-12 17:39:12'),
	(172,'wellness',1,1,'2018-02-12 17:39:12','2018-02-12 17:39:12'),
	(173,'food',1,1,'2018-02-12 17:39:12','2018-02-12 17:39:12'),
	(174,'outdoor',1,1,'2018-02-12 17:39:12','2018-02-12 17:39:12'),
	(175,'entrance',1,1,'2018-02-12 17:49:14','2018-02-12 17:49:14'),
	(176,'wellness',1,1,'2018-02-12 17:49:14','2018-02-12 17:49:14'),
	(177,'food',1,1,'2018-02-12 17:49:14','2018-02-12 17:49:14'),
	(178,'outdoor',1,1,'2018-02-12 17:49:14','2018-02-12 17:49:14'),
	(179,'entrance',1,1,'2018-02-12 18:17:54','2018-02-12 18:17:54'),
	(180,'wellness',1,1,'2018-02-12 18:17:54','2018-02-12 18:17:54'),
	(181,'food',1,1,'2018-02-12 18:17:54','2018-02-12 18:17:54'),
	(182,'outdoor',1,1,'2018-02-12 18:17:54','2018-02-12 18:17:54'),
	(183,'entrance',1,1,'2018-02-12 19:31:41','2018-02-12 19:31:41'),
	(184,'wellness',1,1,'2018-02-12 19:31:41','2018-02-12 19:31:41'),
	(185,'food',1,1,'2018-02-12 19:31:41','2018-02-12 19:31:41'),
	(186,'outdoor',1,1,'2018-02-12 19:31:41','2018-02-12 19:31:41'),
	(187,'entrance',1,1,'2018-02-21 14:18:09','2018-02-21 14:18:09'),
	(188,'wellness',1,1,'2018-02-21 14:18:09','2018-02-21 14:18:09'),
	(189,'food',1,1,'2018-02-21 14:18:09','2018-02-21 14:18:09'),
	(190,'outdoor',1,1,'2018-02-21 14:18:09','2018-02-21 14:18:09');

/*!40000 ALTER TABLE `clubs_info` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table contact_options
# ------------------------------------------------------------

DROP TABLE IF EXISTS `contact_options`;

CREATE TABLE `contact_options` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `contact_option_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `contact_options` WRITE;
/*!40000 ALTER TABLE `contact_options` DISABLE KEYS */;

INSERT INTO `contact_options` (`id`, `contact_option_name`)
VALUES
	(1,'viber'),
	(2,'whatsapp'),
	(3,'skype');

/*!40000 ALTER TABLE `contact_options` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table countries
# ------------------------------------------------------------

DROP TABLE IF EXISTS `countries`;

CREATE TABLE `countries` (
  `id` int(10) unsigned NOT NULL,
  `capital` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `citizenship` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_code` char(3) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_sub_unit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_symbol` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_decimals` int(11) DEFAULT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `iso_3166_2` char(2) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `iso_3166_3` char(3) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `region_code` char(3) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `sub_region_code` char(3) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `eea` tinyint(1) NOT NULL DEFAULT '0',
  `calling_code` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `flag` varchar(6) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `countries_id_index` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `countries` WRITE;
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;

INSERT INTO `countries` (`id`, `capital`, `citizenship`, `country_code`, `currency`, `currency_code`, `currency_sub_unit`, `currency_symbol`, `currency_decimals`, `full_name`, `iso_3166_2`, `iso_3166_3`, `name`, `region_code`, `sub_region_code`, `eea`, `calling_code`, `flag`)
VALUES
	(4,'Kabul','Afghan','004','afghani','AFN','pul','؋',2,'Islamic Republic of Afghanistan','AF','AFG','Afghanistan','142','034',0,'93','AF.png'),
	(8,'Tirana','Albanian','008','lek','ALL','(qindar (pl. qindarka))','Lek',2,'Republic of Albania','AL','ALB','Albania','150','039',0,'355','AL.png'),
	(10,'Antartica','of Antartica','010','','','','',2,'Antarctica','AQ','ATA','Antarctica','','',0,'672','AQ.png'),
	(12,'Algiers','Algerian','012','Algerian dinar','DZD','centime','DZD',2,'People’s Democratic Republic of Algeria','DZ','DZA','Algeria','002','015',0,'213','DZ.png'),
	(16,'Pago Pago','American Samoan','016','US dollar','USD','cent','$',2,'Territory of American','AS','ASM','American Samoa','009','061',0,'1','AS.png'),
	(20,'Andorra la Vella','Andorran','020','euro','EUR','cent','€',2,'Principality of Andorra','AD','AND','Andorra','150','039',0,'376','AD.png'),
	(24,'Luanda','Angolan','024','kwanza','AOA','cêntimo','Kz',2,'Republic of Angola','AO','AGO','Angola','002','017',0,'244','AO.png'),
	(28,'St John’s','of Antigua and Barbuda','028','East Caribbean dollar','XCD','cent','$',2,'Antigua and Barbuda','AG','ATG','Antigua and Barbuda','019','029',0,'1','AG.png'),
	(31,'Baku','Azerbaijani','031','Azerbaijani manat','AZN','kepik (inv.)','ман',2,'Republic of Azerbaijan','AZ','AZE','Azerbaijan','142','145',0,'994','AZ.png'),
	(32,'Buenos Aires','Argentinian','032','Argentine peso','ARS','centavo','$',2,'Argentine Republic','AR','ARG','Argentina','019','005',0,'54','AR.png'),
	(36,'Canberra','Australian','036','Australian dollar','AUD','cent','$',2,'Commonwealth of Australia','AU','AUS','Australia','009','053',0,'61','AU.png'),
	(40,'Vienna','Austrian','040','euro','EUR','cent','€',2,'Republic of Austria','AT','AUT','Austria','150','155',1,'43','AT.png'),
	(44,'Nassau','Bahamian','044','Bahamian dollar','BSD','cent','$',2,'Commonwealth of the Bahamas','BS','BHS','Bahamas','019','029',0,'1','BS.png'),
	(48,'Manama','Bahraini','048','Bahraini dinar','BHD','fils (inv.)','BHD',3,'Kingdom of Bahrain','BH','BHR','Bahrain','142','145',0,'973','BH.png'),
	(50,'Dhaka','Bangladeshi','050','taka (inv.)','BDT','poisha (inv.)','BDT',2,'People’s Republic of Bangladesh','BD','BGD','Bangladesh','142','034',0,'880','BD.png'),
	(51,'Yerevan','Armenian','051','dram (inv.)','AMD','luma','AMD',2,'Republic of Armenia','AM','ARM','Armenia','142','145',0,'374','AM.png'),
	(52,'Bridgetown','Barbadian','052','Barbados dollar','BBD','cent','$',2,'Barbados','BB','BRB','Barbados','019','029',0,'1','BB.png'),
	(56,'Brussels','Belgian','056','euro','EUR','cent','€',2,'Kingdom of Belgium','BE','BEL','Belgium','150','155',1,'32','BE.png'),
	(60,'Hamilton','Bermudian','060','Bermuda dollar','BMD','cent','$',2,'Bermuda','BM','BMU','Bermuda','019','021',0,'1','BM.png'),
	(64,'Thimphu','Bhutanese','064','ngultrum (inv.)','BTN','chhetrum (inv.)','BTN',2,'Kingdom of Bhutan','BT','BTN','Bhutan','142','034',0,'975','BT.png'),
	(68,'Sucre (BO1)','Bolivian','068','boliviano','BOB','centavo','$b',2,'Plurinational State of Bolivia','BO','BOL','Bolivia, Plurinational State of','019','005',0,'591','BO.png'),
	(70,'Sarajevo','of Bosnia and Herzegovina','070','convertible mark','BAM','fening','KM',2,'Bosnia and Herzegovina','BA','BIH','Bosnia and Herzegovina','150','039',0,'387','BA.png'),
	(72,'Gaborone','Botswanan','072','pula (inv.)','BWP','thebe (inv.)','P',2,'Republic of Botswana','BW','BWA','Botswana','002','018',0,'267','BW.png'),
	(74,'Bouvet island','of Bouvet island','074','','','','kr',2,'Bouvet Island','BV','BVT','Bouvet Island','','',0,'47','BV.png'),
	(76,'Brasilia','Brazilian','076','real (pl. reais)','BRL','centavo','R$',2,'Federative Republic of Brazil','BR','BRA','Brazil','019','005',0,'55','BR.png'),
	(84,'Belmopan','Belizean','084','Belize dollar','BZD','cent','BZ$',2,'Belize','BZ','BLZ','Belize','019','013',0,'501','BZ.png'),
	(86,'Diego Garcia','Changosian','086','US dollar','USD','cent','$',2,'British Indian Ocean Territory','IO','IOT','British Indian Ocean Territory','','',0,'246','IO.png'),
	(90,'Honiara','Solomon Islander','090','Solomon Islands dollar','SBD','cent','$',2,'Solomon Islands','SB','SLB','Solomon Islands','009','054',0,'677','SB.png'),
	(92,'Road Town','British Virgin Islander;','092','US dollar','USD','cent','$',2,'British Virgin Islands','VG','VGB','Virgin Islands, British','019','029',0,'1','VG.png'),
	(96,'Bandar Seri Begawan','Bruneian','096','Brunei dollar','BND','sen (inv.)','$',2,'Brunei Darussalam','BN','BRN','Brunei Darussalam','142','035',0,'673','BN.png'),
	(100,'Sofia','Bulgarian','100','lev (pl. leva)','BGN','stotinka','лв',2,'Republic of Bulgaria','BG','BGR','Bulgaria','150','151',1,'359','BG.png'),
	(104,'Yangon','Burmese','104','kyat','MMK','pya','K',2,'Union of Myanmar/','MM','MMR','Myanmar','142','035',0,'95','MM.png'),
	(108,'Bujumbura','Burundian','108','Burundi franc','BIF','centime','BIF',0,'Republic of Burundi','BI','BDI','Burundi','002','014',0,'257','BI.png'),
	(112,'Minsk','Belarusian','112','Belarusian rouble','BYR','kopek','p.',2,'Republic of Belarus','BY','BLR','Belarus','150','151',0,'375','BY.png'),
	(116,'Phnom Penh','Cambodian','116','riel','KHR','sen (inv.)','៛',2,'Kingdom of Cambodia','KH','KHM','Cambodia','142','035',0,'855','KH.png'),
	(120,'Yaoundé','Cameroonian','120','CFA franc (BEAC)','XAF','centime','FCF',0,'Republic of Cameroon','CM','CMR','Cameroon','002','017',0,'237','CM.png'),
	(124,'Ottawa','Canadian','124','Canadian dollar','CAD','cent','$',2,'Canada','CA','CAN','Canada','019','021',0,'1','CA.png'),
	(132,'Praia','Cape Verdean','132','Cape Verde escudo','CVE','centavo','CVE',2,'Republic of Cape Verde','CV','CPV','Cape Verde','002','011',0,'238','CV.png'),
	(136,'George Town','Caymanian','136','Cayman Islands dollar','KYD','cent','$',2,'Cayman Islands','KY','CYM','Cayman Islands','019','029',0,'1','KY.png'),
	(140,'Bangui','Central African','140','CFA franc (BEAC)','XAF','centime','CFA',0,'Central African Republic','CF','CAF','Central African Republic','002','017',0,'236','CF.png'),
	(144,'Colombo','Sri Lankan','144','Sri Lankan rupee','LKR','cent','₨',2,'Democratic Socialist Republic of Sri Lanka','LK','LKA','Sri Lanka','142','034',0,'94','LK.png'),
	(148,'N’Djamena','Chadian','148','CFA franc (BEAC)','XAF','centime','XAF',0,'Republic of Chad','TD','TCD','Chad','002','017',0,'235','TD.png'),
	(152,'Santiago','Chilean','152','Chilean peso','CLP','centavo','CLP',0,'Republic of Chile','CL','CHL','Chile','019','005',0,'56','CL.png'),
	(156,'Beijing','Chinese','156','renminbi-yuan (inv.)','CNY','jiao (10)','¥',2,'People’s Republic of China','CN','CHN','China','142','030',0,'86','CN.png'),
	(158,'Taipei','Taiwanese','158','new Taiwan dollar','TWD','fen (inv.)','NT$',2,'Republic of China, Taiwan (TW1)','TW','TWN','Taiwan, Province of China','142','030',0,'886','TW.png'),
	(162,'Flying Fish Cove','Christmas Islander','162','Australian dollar','AUD','cent','$',2,'Christmas Island Territory','CX','CXR','Christmas Island','','',0,'61','CX.png'),
	(166,'Bantam','Cocos Islander','166','Australian dollar','AUD','cent','$',2,'Territory of Cocos (Keeling) Islands','CC','CCK','Cocos (Keeling) Islands','','',0,'61','CC.png'),
	(170,'Santa Fe de Bogotá','Colombian','170','Colombian peso','COP','centavo','$',2,'Republic of Colombia','CO','COL','Colombia','019','005',0,'57','CO.png'),
	(174,'Moroni','Comorian','174','Comorian franc','KMF','','KMF',0,'Union of the Comoros','KM','COM','Comoros','002','014',0,'269','KM.png'),
	(175,'Mamoudzou','Mahorais','175','euro','EUR','cent','€',2,'Departmental Collectivity of Mayotte','YT','MYT','Mayotte','002','014',0,'262','YT.png'),
	(178,'Brazzaville','Congolese','178','CFA franc (BEAC)','XAF','centime','FCF',0,'Republic of the Congo','CG','COG','Congo','002','017',0,'242','CG.png'),
	(180,'Kinshasa','Congolese','180','Congolese franc','CDF','centime','CDF',2,'Democratic Republic of the Congo','CD','COD','Congo, the Democratic Republic of the','002','017',0,'243','CD.png'),
	(184,'Avarua','Cook Islander','184','New Zealand dollar','NZD','cent','$',2,'Cook Islands','CK','COK','Cook Islands','009','061',0,'682','CK.png'),
	(188,'San José','Costa Rican','188','Costa Rican colón (pl. colones)','CRC','céntimo','₡',2,'Republic of Costa Rica','CR','CRI','Costa Rica','019','013',0,'506','CR.png'),
	(191,'Zagreb','Croatian','191','kuna (inv.)','HRK','lipa (inv.)','kn',2,'Republic of Croatia','HR','HRV','Croatia','150','039',1,'385','HR.png'),
	(192,'Havana','Cuban','192','Cuban peso','CUP','centavo','₱',2,'Republic of Cuba','CU','CUB','Cuba','019','029',0,'53','CU.png'),
	(196,'Nicosia','Cypriot','196','euro','EUR','cent','CYP',2,'Republic of Cyprus','CY','CYP','Cyprus','142','145',1,'357','CY.png'),
	(203,'Prague','Czech','203','Czech koruna (pl. koruny)','CZK','halér','Kč',2,'Czech Republic','CZ','CZE','Czech Republic','150','151',1,'420','CZ.png'),
	(204,'Porto Novo (BJ1)','Beninese','204','CFA franc (BCEAO)','XOF','centime','XOF',0,'Republic of Benin','BJ','BEN','Benin','002','011',0,'229','BJ.png'),
	(208,'Copenhagen','Danish','208','Danish krone','DKK','øre (inv.)','kr',2,'Kingdom of Denmark','DK','DNK','Denmark','150','154',1,'45','DK.png'),
	(212,'Roseau','Dominican','212','East Caribbean dollar','XCD','cent','$',2,'Commonwealth of Dominica','DM','DMA','Dominica','019','029',0,'1','DM.png'),
	(214,'Santo Domingo','Dominican','214','Dominican peso','DOP','centavo','RD$',2,'Dominican Republic','DO','DOM','Dominican Republic','019','029',0,'1','DO.png'),
	(218,'Quito','Ecuadorian','218','US dollar','USD','cent','$',2,'Republic of Ecuador','EC','ECU','Ecuador','019','005',0,'593','EC.png'),
	(222,'San Salvador','Salvadoran','222','Salvadorian colón (pl. colones)','SVC','centavo','$',2,'Republic of El Salvador','SV','SLV','El Salvador','019','013',0,'503','SV.png'),
	(226,'Malabo','Equatorial Guinean','226','CFA franc (BEAC)','XAF','centime','FCF',2,'Republic of Equatorial Guinea','GQ','GNQ','Equatorial Guinea','002','017',0,'240','GQ.png'),
	(231,'Addis Ababa','Ethiopian','231','birr (inv.)','ETB','cent','ETB',2,'Federal Democratic Republic of Ethiopia','ET','ETH','Ethiopia','002','014',0,'251','ET.png'),
	(232,'Asmara','Eritrean','232','nakfa','ERN','cent','Nfk',2,'State of Eritrea','ER','ERI','Eritrea','002','014',0,'291','ER.png'),
	(233,'Tallinn','Estonian','233','euro','EUR','cent','kr',2,'Republic of Estonia','EE','EST','Estonia','150','154',1,'372','EE.png'),
	(234,'Tórshavn','Faeroese','234','Danish krone','DKK','øre (inv.)','kr',2,'Faeroe Islands','FO','FRO','Faroe Islands','150','154',0,'298','FO.png'),
	(238,'Stanley','Falkland Islander','238','Falkland Islands pound','FKP','new penny','£',2,'Falkland Islands','FK','FLK','Falkland Islands (Malvinas)','019','005',0,'500','FK.png'),
	(239,'King Edward Point (Grytviken)','of South Georgia and the South Sandwich Islands','239','','','','£',2,'South Georgia and the South Sandwich Islands','GS','SGS','South Georgia and the South Sandwich Islands','','',0,'44','GS.png'),
	(242,'Suva','Fijian','242','Fiji dollar','FJD','cent','$',2,'Republic of Fiji','FJ','FJI','Fiji','009','054',0,'679','FJ.png'),
	(246,'Helsinki','Finnish','246','euro','EUR','cent','€',2,'Republic of Finland','FI','FIN','Finland','150','154',1,'358','FI.png'),
	(248,'Mariehamn','Åland Islander','248','euro','EUR','cent',NULL,NULL,'Åland Islands','AX','ALA','Åland Islands','150','154',0,'358',NULL),
	(250,'Paris','French','250','euro','EUR','cent','€',2,'French Republic','FR','FRA','France','150','155',1,'33','FR.png'),
	(254,'Cayenne','Guianese','254','euro','EUR','cent','€',2,'French Guiana','GF','GUF','French Guiana','019','005',0,'594','GF.png'),
	(258,'Papeete','Polynesian','258','CFP franc','XPF','centime','XPF',0,'French Polynesia','PF','PYF','French Polynesia','009','061',0,'689','PF.png'),
	(260,'Port-aux-Francais','of French Southern and Antarctic Lands','260','euro','EUR','cent','€',2,'French Southern and Antarctic Lands','TF','ATF','French Southern Territories','','',0,'33','TF.png'),
	(262,'Djibouti','Djiboutian','262','Djibouti franc','DJF','','DJF',0,'Republic of Djibouti','DJ','DJI','Djibouti','002','014',0,'253','DJ.png'),
	(266,'Libreville','Gabonese','266','CFA franc (BEAC)','XAF','centime','FCF',0,'Gabonese Republic','GA','GAB','Gabon','002','017',0,'241','GA.png'),
	(268,'Tbilisi','Georgian','268','lari','GEL','tetri (inv.)','GEL',2,'Georgia','GE','GEO','Georgia','142','145',0,'995','GE.png'),
	(270,'Banjul','Gambian','270','dalasi (inv.)','GMD','butut','D',2,'Republic of the Gambia','GM','GMB','Gambia','002','011',0,'220','GM.png'),
	(275,NULL,'Palestinian','275',NULL,NULL,NULL,'₪',2,NULL,'PS','PSE','Palestinian Territory, Occupied','142','145',0,'970','PS.png'),
	(276,'Berlin','German','276','euro','EUR','cent','€',2,'Federal Republic of Germany','DE','DEU','Germany','150','155',1,'49','DE.png'),
	(288,'Accra','Ghanaian','288','Ghana cedi','GHS','pesewa','¢',2,'Republic of Ghana','GH','GHA','Ghana','002','011',0,'233','GH.png'),
	(292,'Gibraltar','Gibraltarian','292','Gibraltar pound','GIP','penny','£',2,'Gibraltar','GI','GIB','Gibraltar','150','039',0,'350','GI.png'),
	(296,'Tarawa','Kiribatian','296','Australian dollar','AUD','cent','$',2,'Republic of Kiribati','KI','KIR','Kiribati','009','057',0,'686','KI.png'),
	(300,'Athens','Greek','300','euro','EUR','cent','€',2,'Hellenic Republic','GR','GRC','Greece','150','039',1,'30','GR.png'),
	(304,'Nuuk','Greenlander','304','Danish krone','DKK','øre (inv.)','kr',2,'Greenland','GL','GRL','Greenland','019','021',0,'299','GL.png'),
	(308,'St George’s','Grenadian','308','East Caribbean dollar','XCD','cent','$',2,'Grenada','GD','GRD','Grenada','019','029',0,'1','GD.png'),
	(312,'Basse Terre','Guadeloupean','312','euro','EUR','cent','€',2,'Guadeloupe','GP','GLP','Guadeloupe','019','029',0,'590','GP.png'),
	(316,'Agaña (Hagåtña)','Guamanian','316','US dollar','USD','cent','$',2,'Territory of Guam','GU','GUM','Guam','009','057',0,'1','GU.png'),
	(320,'Guatemala City','Guatemalan','320','quetzal (pl. quetzales)','GTQ','centavo','Q',2,'Republic of Guatemala','GT','GTM','Guatemala','019','013',0,'502','GT.png'),
	(324,'Conakry','Guinean','324','Guinean franc','GNF','','GNF',0,'Republic of Guinea','GN','GIN','Guinea','002','011',0,'224','GN.png'),
	(328,'Georgetown','Guyanese','328','Guyana dollar','GYD','cent','$',2,'Cooperative Republic of Guyana','GY','GUY','Guyana','019','005',0,'592','GY.png'),
	(332,'Port-au-Prince','Haitian','332','gourde','HTG','centime','G',2,'Republic of Haiti','HT','HTI','Haiti','019','029',0,'509','HT.png'),
	(334,'Territory of Heard Island and McDonald Islands','of Territory of Heard Island and McDonald Islands','334','','','','$',2,'Territory of Heard Island and McDonald Islands','HM','HMD','Heard Island and McDonald Islands','','',0,'61','HM.png'),
	(336,'Vatican City','of the Holy See/of the Vatican','336','euro','EUR','cent','€',2,'the Holy See/ Vatican City State','VA','VAT','Holy See (Vatican City State)','150','039',0,'39','VA.png'),
	(340,'Tegucigalpa','Honduran','340','lempira','HNL','centavo','L',2,'Republic of Honduras','HN','HND','Honduras','019','013',0,'504','HN.png'),
	(344,'(HK3)','Hong Kong Chinese','344','Hong Kong dollar','HKD','cent','$',2,'Hong Kong Special Administrative Region of the People’s Republic of China (HK2)','HK','HKG','Hong Kong','142','030',0,'852','HK.png'),
	(348,'Budapest','Hungarian','348','forint (inv.)','HUF','(fillér (inv.))','Ft',2,'Republic of Hungary','HU','HUN','Hungary','150','151',1,'36','HU.png'),
	(352,'Reykjavik','Icelander','352','króna (pl. krónur)','ISK','','kr',0,'Republic of Iceland','IS','ISL','Iceland','150','154',0,'354','IS.png'),
	(356,'New Delhi','Indian','356','Indian rupee','INR','paisa','₹',2,'Republic of India','IN','IND','India','142','034',0,'91','IN.png'),
	(360,'Jakarta','Indonesian','360','Indonesian rupiah (inv.)','IDR','sen (inv.)','Rp',2,'Republic of Indonesia','ID','IDN','Indonesia','142','035',0,'62','ID.png'),
	(364,'Tehran','Iranian','364','Iranian rial','IRR','(dinar) (IR1)','﷼',2,'Islamic Republic of Iran','IR','IRN','Iran, Islamic Republic of','142','034',0,'98','IR.png'),
	(368,'Baghdad','Iraqi','368','Iraqi dinar','IQD','fils (inv.)','IQD',3,'Republic of Iraq','IQ','IRQ','Iraq','142','145',0,'964','IQ.png'),
	(372,'Dublin','Irish','372','euro','EUR','cent','€',2,'Ireland (IE1)','IE','IRL','Ireland','150','154',1,'353','IE.png'),
	(376,'(IL1)','Israeli','376','shekel','ILS','agora','₪',2,'State of Israel','IL','ISR','Israel','142','145',0,'972','IL.png'),
	(380,'Rome','Italian','380','euro','EUR','cent','€',2,'Italian Republic','IT','ITA','Italy','150','039',1,'39','IT.png'),
	(384,'Yamoussoukro (CI1)','Ivorian','384','CFA franc (BCEAO)','XOF','centime','XOF',0,'Republic of Côte d’Ivoire','CI','CIV','Côte d\'Ivoire','002','011',0,'225','CI.png'),
	(388,'Kingston','Jamaican','388','Jamaica dollar','JMD','cent','$',2,'Jamaica','JM','JAM','Jamaica','019','029',0,'1','JM.png'),
	(392,'Tokyo','Japanese','392','yen (inv.)','JPY','(sen (inv.)) (JP1)','¥',0,'Japan','JP','JPN','Japan','142','030',0,'81','JP.png'),
	(398,'Astana','Kazakh','398','tenge (inv.)','KZT','tiyn','лв',2,'Republic of Kazakhstan','KZ','KAZ','Kazakhstan','142','143',0,'7','KZ.png'),
	(400,'Amman','Jordanian','400','Jordanian dinar','JOD','100 qirsh','JOD',2,'Hashemite Kingdom of Jordan','JO','JOR','Jordan','142','145',0,'962','JO.png'),
	(404,'Nairobi','Kenyan','404','Kenyan shilling','KES','cent','KES',2,'Republic of Kenya','KE','KEN','Kenya','002','014',0,'254','KE.png'),
	(408,'Pyongyang','North Korean','408','North Korean won (inv.)','KPW','chun (inv.)','₩',2,'Democratic People’s Republic of Korea','KP','PRK','Korea, Democratic People\'s Republic of','142','030',0,'850','KP.png'),
	(410,'Seoul','South Korean','410','South Korean won (inv.)','KRW','(chun (inv.))','₩',0,'Republic of Korea','KR','KOR','Korea, Republic of','142','030',0,'82','KR.png'),
	(414,'Kuwait City','Kuwaiti','414','Kuwaiti dinar','KWD','fils (inv.)','KWD',3,'State of Kuwait','KW','KWT','Kuwait','142','145',0,'965','KW.png'),
	(417,'Bishkek','Kyrgyz','417','som','KGS','tyiyn','лв',2,'Kyrgyz Republic','KG','KGZ','Kyrgyzstan','142','143',0,'996','KG.png'),
	(418,'Vientiane','Lao','418','kip (inv.)','LAK','(at (inv.))','₭',0,'Lao People’s Democratic Republic','LA','LAO','Lao People\'s Democratic Republic','142','035',0,'856','LA.png'),
	(422,'Beirut','Lebanese','422','Lebanese pound','LBP','(piastre)','£',2,'Lebanese Republic','LB','LBN','Lebanon','142','145',0,'961','LB.png'),
	(426,'Maseru','Basotho','426','loti (pl. maloti)','LSL','sente','L',2,'Kingdom of Lesotho','LS','LSO','Lesotho','002','018',0,'266','LS.png'),
	(428,'Riga','Latvian','428','euro','EUR','cent','Ls',2,'Republic of Latvia','LV','LVA','Latvia','150','154',1,'371','LV.png'),
	(430,'Monrovia','Liberian','430','Liberian dollar','LRD','cent','$',2,'Republic of Liberia','LR','LBR','Liberia','002','011',0,'231','LR.png'),
	(434,'Tripoli','Libyan','434','Libyan dinar','LYD','dirham','LYD',3,'Socialist People’s Libyan Arab Jamahiriya','LY','LBY','Libya','002','015',0,'218','LY.png'),
	(438,'Vaduz','Liechtensteiner','438','Swiss franc','CHF','centime','CHF',2,'Principality of Liechtenstein','LI','LIE','Liechtenstein','150','155',0,'423','LI.png'),
	(440,'Vilnius','Lithuanian','440','euro','EUR','cent','Lt',2,'Republic of Lithuania','LT','LTU','Lithuania','150','154',1,'370','LT.png'),
	(442,'Luxembourg','Luxembourger','442','euro','EUR','cent','€',2,'Grand Duchy of Luxembourg','LU','LUX','Luxembourg','150','155',1,'352','LU.png'),
	(446,'Macao (MO3)','Macanese','446','pataca','MOP','avo','MOP',2,'Macao Special Administrative Region of the People’s Republic of China (MO2)','MO','MAC','Macao','142','030',0,'853','MO.png'),
	(450,'Antananarivo','Malagasy','450','ariary','MGA','iraimbilanja (inv.)','MGA',2,'Republic of Madagascar','MG','MDG','Madagascar','002','014',0,'261','MG.png'),
	(454,'Lilongwe','Malawian','454','Malawian kwacha (inv.)','MWK','tambala (inv.)','MK',2,'Republic of Malawi','MW','MWI','Malawi','002','014',0,'265','MW.png'),
	(458,'Kuala Lumpur (MY1)','Malaysian','458','ringgit (inv.)','MYR','sen (inv.)','RM',2,'Malaysia','MY','MYS','Malaysia','142','035',0,'60','MY.png'),
	(462,'Malé','Maldivian','462','rufiyaa','MVR','laari (inv.)','Rf',2,'Republic of Maldives','MV','MDV','Maldives','142','034',0,'960','MV.png'),
	(466,'Bamako','Malian','466','CFA franc (BCEAO)','XOF','centime','XOF',0,'Republic of Mali','ML','MLI','Mali','002','011',0,'223','ML.png'),
	(470,'Valletta','Maltese','470','euro','EUR','cent','MTL',2,'Republic of Malta','MT','MLT','Malta','150','039',1,'356','MT.png'),
	(474,'Fort-de-France','Martinican','474','euro','EUR','cent','€',2,'Martinique','MQ','MTQ','Martinique','019','029',0,'596','MQ.png'),
	(478,'Nouakchott','Mauritanian','478','ouguiya','MRO','khoum','UM',2,'Islamic Republic of Mauritania','MR','MRT','Mauritania','002','011',0,'222','MR.png'),
	(480,'Port Louis','Mauritian','480','Mauritian rupee','MUR','cent','₨',2,'Republic of Mauritius','MU','MUS','Mauritius','002','014',0,'230','MU.png'),
	(484,'Mexico City','Mexican','484','Mexican peso','MXN','centavo','$',2,'United Mexican States','MX','MEX','Mexico','019','013',0,'52','MX.png'),
	(492,'Monaco','Monegasque','492','euro','EUR','cent','€',2,'Principality of Monaco','MC','MCO','Monaco','150','155',0,'377','MC.png'),
	(496,'Ulan Bator','Mongolian','496','tugrik','MNT','möngö (inv.)','₮',2,'Mongolia','MN','MNG','Mongolia','142','030',0,'976','MN.png'),
	(498,'Chisinau','Moldovan','498','Moldovan leu (pl. lei)','MDL','ban','MDL',2,'Republic of Moldova','MD','MDA','Moldova, Republic of','150','151',0,'373','MD.png'),
	(499,'Podgorica','Montenegrin','499','euro','EUR','cent','€',2,'Montenegro','ME','MNE','Montenegro','150','039',0,'382','ME.png'),
	(500,'Plymouth (MS2)','Montserratian','500','East Caribbean dollar','XCD','cent','$',2,'Montserrat','MS','MSR','Montserrat','019','029',0,'1','MS.png'),
	(504,'Rabat','Moroccan','504','Moroccan dirham','MAD','centime','MAD',2,'Kingdom of Morocco','MA','MAR','Morocco','002','015',0,'212','MA.png'),
	(508,'Maputo','Mozambican','508','metical','MZN','centavo','MT',2,'Republic of Mozambique','MZ','MOZ','Mozambique','002','014',0,'258','MZ.png'),
	(512,'Muscat','Omani','512','Omani rial','OMR','baiza','﷼',3,'Sultanate of Oman','OM','OMN','Oman','142','145',0,'968','OM.png'),
	(516,'Windhoek','Namibian','516','Namibian dollar','NAD','cent','$',2,'Republic of Namibia','NA','NAM','Namibia','002','018',0,'264','NA.png'),
	(520,'Yaren','Nauruan','520','Australian dollar','AUD','cent','$',2,'Republic of Nauru','NR','NRU','Nauru','009','057',0,'674','NR.png'),
	(524,'Kathmandu','Nepalese','524','Nepalese rupee','NPR','paisa (inv.)','₨',2,'Nepal','NP','NPL','Nepal','142','034',0,'977','NP.png'),
	(528,'Amsterdam (NL2)','Dutch','528','euro','EUR','cent','€',2,'Kingdom of the Netherlands','NL','NLD','Netherlands','150','155',1,'31','NL.png'),
	(531,'Willemstad','Curaçaoan','531','Netherlands Antillean guilder (CW1)','ANG','cent',NULL,NULL,'Curaçao','CW','CUW','Curaçao','019','029',0,'599',NULL),
	(533,'Oranjestad','Aruban','533','Aruban guilder','AWG','cent','ƒ',2,'Aruba','AW','ABW','Aruba','019','029',0,'297','AW.png'),
	(534,'Philipsburg','Sint Maartener','534','Netherlands Antillean guilder (SX1)','ANG','cent',NULL,NULL,'Sint Maarten','SX','SXM','Sint Maarten (Dutch part)','019','029',0,'721',NULL),
	(535,NULL,'of Bonaire, Sint Eustatius and Saba','535','US dollar','USD','cent',NULL,NULL,NULL,'BQ','BES','Bonaire, Sint Eustatius and Saba','019','029',0,'599',NULL),
	(540,'Nouméa','New Caledonian','540','CFP franc','XPF','centime','XPF',0,'New Caledonia','NC','NCL','New Caledonia','009','054',0,'687','NC.png'),
	(548,'Port Vila','Vanuatuan','548','vatu (inv.)','VUV','','Vt',0,'Republic of Vanuatu','VU','VUT','Vanuatu','009','054',0,'678','VU.png'),
	(554,'Wellington','New Zealander','554','New Zealand dollar','NZD','cent','$',2,'New Zealand','NZ','NZL','New Zealand','009','053',0,'64','NZ.png'),
	(558,'Managua','Nicaraguan','558','córdoba oro','NIO','centavo','C$',2,'Republic of Nicaragua','NI','NIC','Nicaragua','019','013',0,'505','NI.png'),
	(562,'Niamey','Nigerien','562','CFA franc (BCEAO)','XOF','centime','XOF',0,'Republic of Niger','NE','NER','Niger','002','011',0,'227','NE.png'),
	(566,'Abuja','Nigerian','566','naira (inv.)','NGN','kobo (inv.)','₦',2,'Federal Republic of Nigeria','NG','NGA','Nigeria','002','011',0,'234','NG.png'),
	(570,'Alofi','Niuean','570','New Zealand dollar','NZD','cent','$',2,'Niue','NU','NIU','Niue','009','061',0,'683','NU.png'),
	(574,'Kingston','Norfolk Islander','574','Australian dollar','AUD','cent','$',2,'Territory of Norfolk Island','NF','NFK','Norfolk Island','009','053',0,'672','NF.png'),
	(578,'Oslo','Norwegian','578','Norwegian krone (pl. kroner)','NOK','øre (inv.)','kr',2,'Kingdom of Norway','NO','NOR','Norway','150','154',0,'47','NO.png'),
	(580,'Saipan','Northern Mariana Islander','580','US dollar','USD','cent','$',2,'Commonwealth of the Northern Mariana Islands','MP','MNP','Northern Mariana Islands','009','057',0,'1','MP.png'),
	(581,'United States Minor Outlying Islands','of United States Minor Outlying Islands','581','US dollar','USD','cent','$',2,'United States Minor Outlying Islands','UM','UMI','United States Minor Outlying Islands','','',0,'1','UM.png'),
	(583,'Palikir','Micronesian','583','US dollar','USD','cent','$',2,'Federated States of Micronesia','FM','FSM','Micronesia, Federated States of','009','057',0,'691','FM.png'),
	(584,'Majuro','Marshallese','584','US dollar','USD','cent','$',2,'Republic of the Marshall Islands','MH','MHL','Marshall Islands','009','057',0,'692','MH.png'),
	(585,'Melekeok','Palauan','585','US dollar','USD','cent','$',2,'Republic of Palau','PW','PLW','Palau','009','057',0,'680','PW.png'),
	(586,'Islamabad','Pakistani','586','Pakistani rupee','PKR','paisa','₨',2,'Islamic Republic of Pakistan','PK','PAK','Pakistan','142','034',0,'92','PK.png'),
	(591,'Panama City','Panamanian','591','balboa','PAB','centésimo','B/.',2,'Republic of Panama','PA','PAN','Panama','019','013',0,'507','PA.png'),
	(598,'Port Moresby','Papua New Guinean','598','kina (inv.)','PGK','toea (inv.)','PGK',2,'Independent State of Papua New Guinea','PG','PNG','Papua New Guinea','009','054',0,'675','PG.png'),
	(600,'Asunción','Paraguayan','600','guaraní','PYG','céntimo','Gs',0,'Republic of Paraguay','PY','PRY','Paraguay','019','005',0,'595','PY.png'),
	(604,'Lima','Peruvian','604','new sol','PEN','céntimo','S/.',2,'Republic of Peru','PE','PER','Peru','019','005',0,'51','PE.png'),
	(608,'Manila','Filipino','608','Philippine peso','PHP','centavo','Php',2,'Republic of the Philippines','PH','PHL','Philippines','142','035',0,'63','PH.png'),
	(612,'Adamstown','Pitcairner','612','New Zealand dollar','NZD','cent','$',2,'Pitcairn Islands','PN','PCN','Pitcairn','009','061',0,'649','PN.png'),
	(616,'Warsaw','Polish','616','zloty','PLN','grosz (pl. groszy)','zł',2,'Republic of Poland','PL','POL','Poland','150','151',1,'48','PL.png'),
	(620,'Lisbon','Portuguese','620','euro','EUR','cent','€',2,'Portuguese Republic','PT','PRT','Portugal','150','039',1,'351','PT.png'),
	(624,'Bissau','Guinea-Bissau national','624','CFA franc (BCEAO)','XOF','centime','XOF',0,'Republic of Guinea-Bissau','GW','GNB','Guinea-Bissau','002','011',0,'245','GW.png'),
	(626,'Dili','East Timorese','626','US dollar','USD','cent','$',2,'Democratic Republic of East Timor','TL','TLS','Timor-Leste','142','035',0,'670','TL.png'),
	(630,'San Juan','Puerto Rican','630','US dollar','USD','cent','$',2,'Commonwealth of Puerto Rico','PR','PRI','Puerto Rico','019','029',0,'1','PR.png'),
	(634,'Doha','Qatari','634','Qatari riyal','QAR','dirham','﷼',2,'State of Qatar','QA','QAT','Qatar','142','145',0,'974','QA.png'),
	(638,'Saint-Denis','Reunionese','638','euro','EUR','cent','€',2,'Réunion','RE','REU','Réunion','002','014',0,'262','RE.png'),
	(642,'Bucharest','Romanian','642','Romanian leu (pl. lei)','RON','ban (pl. bani)','lei',2,'Romania','RO','ROU','Romania','150','151',1,'40','RO.png'),
	(643,'Moscow','Russian','643','Russian rouble','RUB','kopek','руб',2,'Russian Federation','RU','RUS','Russian Federation','150','151',0,'7','RU.png'),
	(646,'Kigali','Rwandan; Rwandese','646','Rwandese franc','RWF','centime','RWF',0,'Republic of Rwanda','RW','RWA','Rwanda','002','014',0,'250','RW.png'),
	(652,'Gustavia','of Saint Barthélemy','652','euro','EUR','cent',NULL,NULL,'Collectivity of Saint Barthélemy','BL','BLM','Saint Barthélemy','019','029',0,'590',NULL),
	(654,'Jamestown','Saint Helenian','654','Saint Helena pound','SHP','penny','£',2,'Saint Helena, Ascension and Tristan da Cunha','SH','SHN','Saint Helena, Ascension and Tristan da Cunha','002','011',0,'290','SH.png'),
	(659,'Basseterre','Kittsian; Nevisian','659','East Caribbean dollar','XCD','cent','$',2,'Federation of Saint Kitts and Nevis','KN','KNA','Saint Kitts and Nevis','019','029',0,'1','KN.png'),
	(660,'The Valley','Anguillan','660','East Caribbean dollar','XCD','cent','$',2,'Anguilla','AI','AIA','Anguilla','019','029',0,'1','AI.png'),
	(662,'Castries','Saint Lucian','662','East Caribbean dollar','XCD','cent','$',2,'Saint Lucia','LC','LCA','Saint Lucia','019','029',0,'1','LC.png'),
	(663,'Marigot','of Saint Martin','663','euro','EUR','cent',NULL,NULL,'Collectivity of Saint Martin','MF','MAF','Saint Martin (French part)','019','029',0,'590',NULL),
	(666,'Saint-Pierre','St-Pierrais; Miquelonnais','666','euro','EUR','cent','€',2,'Territorial Collectivity of Saint Pierre and Miquelon','PM','SPM','Saint Pierre and Miquelon','019','021',0,'508','PM.png'),
	(670,'Kingstown','Vincentian','670','East Caribbean dollar','XCD','cent','$',2,'Saint Vincent and the Grenadines','VC','VCT','Saint Vincent and the Grenadines','019','029',0,'1','VC.png'),
	(674,'San Marino','San Marinese','674','euro','EUR','cent','€',2,'Republic of San Marino','SM','SMR','San Marino','150','039',0,'378','SM.png'),
	(678,'São Tomé','São Toméan','678','dobra','STD','centavo','Db',2,'Democratic Republic of São Tomé and Príncipe','ST','STP','Sao Tome and Principe','002','017',0,'239','ST.png'),
	(682,'Riyadh','Saudi Arabian','682','riyal','SAR','halala','﷼',2,'Kingdom of Saudi Arabia','SA','SAU','Saudi Arabia','142','145',0,'966','SA.png'),
	(686,'Dakar','Senegalese','686','CFA franc (BCEAO)','XOF','centime','XOF',0,'Republic of Senegal','SN','SEN','Senegal','002','011',0,'221','SN.png'),
	(688,'Belgrade','Serb','688','Serbian dinar','RSD','para (inv.)',NULL,NULL,'Republic of Serbia','RS','SRB','Serbia','150','039',0,'381',NULL),
	(690,'Victoria','Seychellois','690','Seychelles rupee','SCR','cent','₨',2,'Republic of Seychelles','SC','SYC','Seychelles','002','014',0,'248','SC.png'),
	(694,'Freetown','Sierra Leonean','694','leone','SLL','cent','Le',2,'Republic of Sierra Leone','SL','SLE','Sierra Leone','002','011',0,'232','SL.png'),
	(702,'Singapore','Singaporean','702','Singapore dollar','SGD','cent','$',2,'Republic of Singapore','SG','SGP','Singapore','142','035',0,'65','SG.png'),
	(703,'Bratislava','Slovak','703','euro','EUR','cent','Sk',2,'Slovak Republic','SK','SVK','Slovakia','150','151',1,'421','SK.png'),
	(704,'Hanoi','Vietnamese','704','dong','VND','(10 hào','₫',2,'Socialist Republic of Vietnam','VN','VNM','Viet Nam','142','035',0,'84','VN.png'),
	(705,'Ljubljana','Slovene','705','euro','EUR','cent','€',2,'Republic of Slovenia','SI','SVN','Slovenia','150','039',1,'386','SI.png'),
	(706,'Mogadishu','Somali','706','Somali shilling','SOS','cent','S',2,'Somali Republic','SO','SOM','Somalia','002','014',0,'252','SO.png'),
	(710,'Pretoria (ZA1)','South African','710','rand','ZAR','cent','R',2,'Republic of South Africa','ZA','ZAF','South Africa','002','018',0,'27','ZA.png'),
	(716,'Harare','Zimbabwean','716','Zimbabwe dollar (ZW1)','ZWL','cent','Z$',2,'Republic of Zimbabwe','ZW','ZWE','Zimbabwe','002','014',0,'263','ZW.png'),
	(724,'Madrid','Spaniard','724','euro','EUR','cent','€',2,'Kingdom of Spain','ES','ESP','Spain','150','039',1,'34','ES.png'),
	(728,'Juba','South Sudanese','728','South Sudanese pound','SSP','piaster',NULL,NULL,'Republic of South Sudan','SS','SSD','South Sudan','002','015',0,'211',NULL),
	(729,'Khartoum','Sudanese','729','Sudanese pound','SDG','piastre',NULL,NULL,'Republic of the Sudan','SD','SDN','Sudan','002','015',0,'249',NULL),
	(732,'Al aaiun','Sahrawi','732','Moroccan dirham','MAD','centime','MAD',2,'Western Sahara','EH','ESH','Western Sahara','002','015',0,'212','EH.png'),
	(740,'Paramaribo','Surinamese','740','Surinamese dollar','SRD','cent','$',2,'Republic of Suriname','SR','SUR','Suriname','019','005',0,'597','SR.png'),
	(744,'Longyearbyen','of Svalbard','744','Norwegian krone (pl. kroner)','NOK','øre (inv.)','kr',2,'Svalbard and Jan Mayen','SJ','SJM','Svalbard and Jan Mayen','150','154',0,'47','SJ.png'),
	(748,'Mbabane','Swazi','748','lilangeni','SZL','cent','SZL',2,'Kingdom of Swaziland','SZ','SWZ','Swaziland','002','018',0,'268','SZ.png'),
	(752,'Stockholm','Swedish','752','krona (pl. kronor)','SEK','öre (inv.)','kr',2,'Kingdom of Sweden','SE','SWE','Sweden','150','154',1,'46','SE.png'),
	(756,'Berne','Swiss','756','Swiss franc','CHF','centime','CHF',2,'Swiss Confederation','CH','CHE','Switzerland','150','155',0,'41','CH.png'),
	(760,'Damascus','Syrian','760','Syrian pound','SYP','piastre','£',2,'Syrian Arab Republic','SY','SYR','Syrian Arab Republic','142','145',0,'963','SY.png'),
	(762,'Dushanbe','Tajik','762','somoni','TJS','diram','TJS',2,'Republic of Tajikistan','TJ','TJK','Tajikistan','142','143',0,'992','TJ.png'),
	(764,'Bangkok','Thai','764','baht (inv.)','THB','satang (inv.)','฿',2,'Kingdom of Thailand','TH','THA','Thailand','142','035',0,'66','TH.png'),
	(768,'Lomé','Togolese','768','CFA franc (BCEAO)','XOF','centime','XOF',0,'Togolese Republic','TG','TGO','Togo','002','011',0,'228','TG.png'),
	(772,'(TK2)','Tokelauan','772','New Zealand dollar','NZD','cent','$',2,'Tokelau','TK','TKL','Tokelau','009','061',0,'690','TK.png'),
	(776,'Nuku’alofa','Tongan','776','pa’anga (inv.)','TOP','seniti (inv.)','T$',2,'Kingdom of Tonga','TO','TON','Tonga','009','061',0,'676','TO.png'),
	(780,'Port of Spain','Trinidadian; Tobagonian','780','Trinidad and Tobago dollar','TTD','cent','TT$',2,'Republic of Trinidad and Tobago','TT','TTO','Trinidad and Tobago','019','029',0,'1','TT.png'),
	(784,'Abu Dhabi','Emirian','784','UAE dirham','AED','fils (inv.)','AED',2,'United Arab Emirates','AE','ARE','United Arab Emirates','142','145',0,'971','AE.png'),
	(788,'Tunis','Tunisian','788','Tunisian dinar','TND','millime','TND',3,'Republic of Tunisia','TN','TUN','Tunisia','002','015',0,'216','TN.png'),
	(792,'Ankara','Turk','792','Turkish lira (inv.)','TRY','kurus (inv.)','₺',2,'Republic of Turkey','TR','TUR','Turkey','142','145',0,'90','TR.png'),
	(795,'Ashgabat','Turkmen','795','Turkmen manat (inv.)','TMT','tenge (inv.)','m',2,'Turkmenistan','TM','TKM','Turkmenistan','142','143',0,'993','TM.png'),
	(796,'Cockburn Town','Turks and Caicos Islander','796','US dollar','USD','cent','$',2,'Turks and Caicos Islands','TC','TCA','Turks and Caicos Islands','019','029',0,'1','TC.png'),
	(798,'Funafuti','Tuvaluan','798','Australian dollar','AUD','cent','$',2,'Tuvalu','TV','TUV','Tuvalu','009','061',0,'688','TV.png'),
	(800,'Kampala','Ugandan','800','Uganda shilling','UGX','cent','UGX',0,'Republic of Uganda','UG','UGA','Uganda','002','014',0,'256','UG.png'),
	(804,'Kiev','Ukrainian','804','hryvnia','UAH','kopiyka','₴',2,'Ukraine','UA','UKR','Ukraine','150','151',0,'380','UA.png'),
	(807,'Skopje','of the former Yugoslav Republic of Macedonia','807','denar (pl. denars)','MKD','deni (inv.)','ден',2,'the former Yugoslav Republic of Macedonia','MK','MKD','Macedonia, the former Yugoslav Republic of','150','039',0,'389','MK.png'),
	(818,'Cairo','Egyptian','818','Egyptian pound','EGP','piastre','£',2,'Arab Republic of Egypt','EG','EGY','Egypt','002','015',0,'20','EG.png'),
	(826,'London','British','826','pound sterling','GBP','penny (pl. pence)','£',2,'United Kingdom of Great Britain and Northern Ireland','GB','GBR','United Kingdom','150','154',1,'44','GB.png'),
	(831,'St Peter Port','of Guernsey','831','Guernsey pound (GG2)','GGP (GG2)','penny (pl. pence)',NULL,NULL,'Bailiwick of Guernsey','GG','GGY','Guernsey','150','154',0,'44',NULL),
	(832,'St Helier','of Jersey','832','Jersey pound (JE2)','JEP (JE2)','penny (pl. pence)',NULL,NULL,'Bailiwick of Jersey','JE','JEY','Jersey','150','154',0,'44',NULL),
	(833,'Douglas','Manxman; Manxwoman','833','Manx pound (IM2)','IMP (IM2)','penny (pl. pence)',NULL,NULL,'Isle of Man','IM','IMN','Isle of Man','150','154',0,'44',NULL),
	(834,'Dodoma (TZ1)','Tanzanian','834','Tanzanian shilling','TZS','cent','TZS',2,'United Republic of Tanzania','TZ','TZA','Tanzania, United Republic of','002','014',0,'255','TZ.png'),
	(840,'Washington DC','American','840','US dollar','USD','cent','$',2,'United States of America','US','USA','United States','019','021',0,'1','US.png'),
	(850,'Charlotte Amalie','US Virgin Islander','850','US dollar','USD','cent','$',2,'United States Virgin Islands','VI','VIR','Virgin Islands, U.S.','019','029',0,'1','VI.png'),
	(854,'Ouagadougou','Burkinabe','854','CFA franc (BCEAO)','XOF','centime','XOF',0,'Burkina Faso','BF','BFA','Burkina Faso','002','011',0,'226','BF.png'),
	(858,'Montevideo','Uruguayan','858','Uruguayan peso','UYU','centésimo','$U',0,'Eastern Republic of Uruguay','UY','URY','Uruguay','019','005',0,'598','UY.png'),
	(860,'Tashkent','Uzbek','860','sum (inv.)','UZS','tiyin (inv.)','лв',2,'Republic of Uzbekistan','UZ','UZB','Uzbekistan','142','143',0,'998','UZ.png'),
	(862,'Caracas','Venezuelan','862','bolívar fuerte (pl. bolívares fuertes)','VEF','céntimo','Bs',2,'Bolivarian Republic of Venezuela','VE','VEN','Venezuela, Bolivarian Republic of','019','005',0,'58','VE.png'),
	(876,'Mata-Utu','Wallisian; Futunan; Wallis and Futuna Islander','876','CFP franc','XPF','centime','XPF',0,'Wallis and Futuna','WF','WLF','Wallis and Futuna','009','061',0,'681','WF.png'),
	(882,'Apia','Samoan','882','tala (inv.)','WST','sene (inv.)','WS$',2,'Independent State of Samoa','WS','WSM','Samoa','009','061',0,'685','WS.png'),
	(887,'San’a','Yemenite','887','Yemeni rial','YER','fils (inv.)','﷼',2,'Republic of Yemen','YE','YEM','Yemen','142','145',0,'967','YE.png'),
	(894,'Lusaka','Zambian','894','Zambian kwacha (inv.)','ZMW','ngwee (inv.)','ZK',2,'Republic of Zambia','ZM','ZMB','Zambia','002','014',0,'260','ZM.png');

/*!40000 ALTER TABLE `countries` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table events
# ------------------------------------------------------------

DROP TABLE IF EXISTS `events`;

CREATE TABLE `events` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `local_id` int(10) unsigned DEFAULT NULL,
  `events_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `events_venue` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `events_total_amount` int(11) DEFAULT NULL,
  `events_photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `events_description` text COLLATE utf8mb4_unicode_ci,
  `events_date` timestamp NULL DEFAULT NULL,
  `events_activation_date` timestamp NULL DEFAULT NULL,
  `events_expiry_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `events_local_id_foreign` (`local_id`),
  CONSTRAINT `events_local_id_foreign` FOREIGN KEY (`local_id`) REFERENCES `locals` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;

INSERT INTO `events` (`id`, `local_id`, `events_title`, `events_venue`, `events_total_amount`, `events_photo`, `events_description`, `events_date`, `events_activation_date`, `events_expiry_date`, `created_at`, `updated_at`)
VALUES
	(1,2,'Nesto','Something',123,'https://ucarecdn.com/307becb8-297b-4462-8ac0-63575787739e/-/crop/522x597/189,0/-/resize/490x560/','asdasdasdasdasdasdsad asd asd asd asd asd asd asd ','2018-01-24 20:35:37','2018-01-24 20:35:42','2018-01-24 20:35:46','2018-01-24 20:35:51','2018-01-24 20:35:51'),
	(2,2,NULL,NULL,13,'https://ucarecdn.com/4b00dbd9-5c8d-4ab8-bf86-a1dc82d42275/-/crop/522x596/378,0/-/resize/490x560/',NULL,'0000-00-00 00:00:00','2018-02-04 00:00:00','2018-02-07 00:00:00','2018-01-25 13:10:32','2018-01-25 13:10:32');

/*!40000 ALTER TABLE `events` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table faqs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `faqs`;

CREATE TABLE `faqs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `question_de` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `question_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `question_fr` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `question_it` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer_de` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer_fr` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer_it` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `faqs` WRITE;
/*!40000 ALTER TABLE `faqs` DISABLE KEYS */;

INSERT INTO `faqs` (`id`, `question_de`, `question_en`, `question_fr`, `question_it`, `answer_de`, `answer_en`, `answer_fr`, `answer_it`, `created_at`, `updated_at`)
VALUES
	(1,'Pitanje 1','','','','Odgovor 1','','','','2018-01-10 21:20:06','2018-01-10 21:20:06'),
	(2,'Pitanje 2','','','','Odgovor 2','','','','2018-01-10 21:20:06','2018-01-10 21:20:06'),
	(3,'Pitanje 3','','','','Odgovor 3','','','','2018-01-10 21:20:06','2018-01-10 21:20:06'),
	(4,'Pitanje 4','','','','Odgovor 4','','','','2018-01-10 21:20:06','2018-01-10 21:20:06');

/*!40000 ALTER TABLE `faqs` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table local_girls
# ------------------------------------------------------------

DROP TABLE IF EXISTS `local_girls`;

CREATE TABLE `local_girls` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nickname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photos` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `local_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `local_girls_local_id_foreign` (`local_id`),
  CONSTRAINT `local_girls_local_id_foreign` FOREIGN KEY (`local_id`) REFERENCES `locals` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `local_girls` WRITE;
/*!40000 ALTER TABLE `local_girls` DISABLE KEYS */;

INSERT INTO `local_girls` (`id`, `nickname`, `photos`, `local_id`, `created_at`, `updated_at`)
VALUES
	(1,'jena','https://ucarecdn.com/fddc0fed-7ae6-4c01-ba97-abeaf89399b6~5/',2,'2018-01-18 17:42:33','2018-01-18 17:50:52'),
	(2,'jena123','https://ucarecdn.com/1c9dcde5-5b75-4007-9b45-b7ae6c82a1f5~4/',2,'2018-02-12 21:31:28','2018-02-12 21:31:28');

/*!40000 ALTER TABLE `local_girls` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table local_packages
# ------------------------------------------------------------

DROP TABLE IF EXISTS `local_packages`;

CREATE TABLE `local_packages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `month_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `local_packages` WRITE;
/*!40000 ALTER TABLE `local_packages` DISABLE KEYS */;

INSERT INTO `local_packages` (`id`, `name`, `month_price`, `year_price`, `created_at`, `updated_at`)
VALUES
	(1,'Solo','1','12','2018-01-10 21:20:06','2018-01-10 21:20:06'),
	(2,'Start 1-5','2','24','2018-01-10 21:20:06','2018-01-10 21:20:06'),
	(3,'Business 6-10','3','36','2018-01-10 21:20:06','2018-01-10 21:20:06'),
	(4,'Pro 11-20','4','48','2018-01-10 21:20:06','2018-01-10 21:20:06'),
	(5,'VIP 21-40','4','48','2018-01-10 21:20:06','2018-01-10 21:20:06'),
	(6,'ELITE 41+','4','48','2018-01-10 21:20:06','2018-01-10 21:20:06');

/*!40000 ALTER TABLE `local_packages` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table local_types
# ------------------------------------------------------------

DROP TABLE IF EXISTS `local_types`;

CREATE TABLE `local_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name_de` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_fr` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_it` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `local_types` WRITE;
/*!40000 ALTER TABLE `local_types` DISABLE KEYS */;

INSERT INTO `local_types` (`id`, `name_de`, `name_en`, `name_fr`, `name_it`, `created_at`, `updated_at`)
VALUES
	(1,'Tip 1','','','','2018-01-10 21:20:06','2018-01-10 21:20:06'),
	(2,'Tip 2','','','','2018-01-10 21:20:06','2018-01-10 21:20:06'),
	(3,'Tip 3','','','','2018-01-10 21:20:06','2018-01-10 21:20:06'),
	(4,'Tip 4','','','','2018-01-10 21:20:06','2018-01-10 21:20:06'),
	(5,'Tip 5','','','','2018-01-10 21:20:06','2018-01-10 21:20:06'),
	(6,'Tip 6','','','','2018-01-10 21:20:06','2018-01-10 21:20:06');

/*!40000 ALTER TABLE `local_types` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table locals
# ------------------------------------------------------------

DROP TABLE IF EXISTS `locals`;

CREATE TABLE `locals` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `activated` int(11) DEFAULT NULL,
  `has_profile` tinyint(1) DEFAULT '0',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sms_notifications` tinyint(1) DEFAULT '0',
  `about_me` text COLLATE utf8mb4_unicode_ci,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photos` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `videos` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `working_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lat` decimal(9,6) DEFAULT NULL,
  `lng` decimal(9,6) DEFAULT NULL,
  `club_entrance_id` int(10) unsigned DEFAULT NULL,
  `club_wellness_id` int(10) unsigned DEFAULT NULL,
  `club_food_id` int(10) unsigned DEFAULT NULL,
  `club_outdoor_id` int(10) unsigned DEFAULT NULL,
  `local_type_id` int(10) unsigned DEFAULT NULL,
  `package1_id` int(10) unsigned DEFAULT NULL,
  `is_active_d_package` tinyint(1) DEFAULT '0',
  `is_active_gotm_package` tinyint(1) DEFAULT '0',
  `package1_duration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `package1_activation_date` timestamp NULL DEFAULT NULL,
  `package1_expiry_date` timestamp NULL DEFAULT NULL,
  `package2_id` int(10) unsigned DEFAULT NULL,
  `package2_activation_date` timestamp NULL DEFAULT NULL,
  `package2_expiry_date` timestamp NULL DEFAULT NULL,
  `scheduled_default_package` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scheduled_gotm_package` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stripe_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stripe_last4_digits` varchar(4) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stripe_amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `year_visitors` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `locals_club_entrance_id_foreign` (`club_entrance_id`),
  KEY `locals_club_wellness_id_foreign` (`club_wellness_id`),
  KEY `locals_club_food_id_foreign` (`club_food_id`),
  KEY `locals_club_outdoor_id_foreign` (`club_outdoor_id`),
  KEY `locals_local_type_id_foreign` (`local_type_id`),
  KEY `locals_package1_id_foreign` (`package1_id`),
  CONSTRAINT `locals_club_entrance_id_foreign` FOREIGN KEY (`club_entrance_id`) REFERENCES `clubs_info` (`id`) ON DELETE CASCADE,
  CONSTRAINT `locals_club_food_id_foreign` FOREIGN KEY (`club_food_id`) REFERENCES `clubs_info` (`id`) ON DELETE CASCADE,
  CONSTRAINT `locals_club_outdoor_id_foreign` FOREIGN KEY (`club_outdoor_id`) REFERENCES `clubs_info` (`id`) ON DELETE CASCADE,
  CONSTRAINT `locals_club_wellness_id_foreign` FOREIGN KEY (`club_wellness_id`) REFERENCES `clubs_info` (`id`) ON DELETE CASCADE,
  CONSTRAINT `locals_local_type_id_foreign` FOREIGN KEY (`local_type_id`) REFERENCES `local_types` (`id`) ON DELETE CASCADE,
  CONSTRAINT `locals_package1_id_foreign` FOREIGN KEY (`package1_id`) REFERENCES `local_packages` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `locals` WRITE;
/*!40000 ALTER TABLE `locals` DISABLE KEYS */;

INSERT INTO `locals` (`id`, `username`, `email`, `password`, `activated`, `has_profile`, `name`, `street`, `zip`, `city`, `website`, `phone`, `mobile`, `sms_notifications`, `about_me`, `photo`, `photos`, `videos`, `working_time`, `lat`, `lng`, `club_entrance_id`, `club_wellness_id`, `club_food_id`, `club_outdoor_id`, `local_type_id`, `package1_id`, `is_active_d_package`, `is_active_gotm_package`, `package1_duration`, `package1_activation_date`, `package1_expiry_date`, `package2_id`, `package2_activation_date`, `package2_expiry_date`, `scheduled_default_package`, `scheduled_gotm_package`, `stripe_id`, `stripe_last4_digits`, `stripe_amount`, `year_visitors`, `remember_token`, `created_at`, `updated_at`)
VALUES
	(2,'club','asd@sadas.asd','$2y$10$XFGmVgKghwvZMH4du2wBPutF6yzVLT04f5ZBUO.OBLLlZfHlch98u',1,1,'sda','asd','3232','sdsdsd',NULL,'213','60 319826',1,'ads',NULL,'https://ucarecdn.com/873d8e87-6c00-42f4-bcc5-e9ea1a954443~4/',NULL,NULL,44.778425,20.483719,187,188,189,190,1,NULL,0,0,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'cus_CMK8h1zMVMHa9A',NULL,NULL,NULL,'76W5mK9JPgtqyR1orQNBrOV50Pc6l9rgqQ0pc6isj9OdUe8LpwcfNaumc1sW','2018-01-12 15:32:00','2018-02-21 14:18:09'),
	(3,'Milana','asd@sadas.asd','$2y$10$XFGmVgKghwvZMH4du2wBPutF6yzVLT04f5ZBUO.OBLLlZfHlch98u',1,1,'name','street','123','asdas',NULL,NULL,NULL,0,NULL,NULL,'http://www.ucarecdn.com/31d11483-333f-4a20-9b2d-401d224ca02c~4/',NULL,NULL,43.148417,22.590480,NULL,NULL,NULL,NULL,3,1,0,NULL,'month','2017-12-21 14:43:14','2017-12-27 14:43:14',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2018-01-12 15:32:03','2018-01-14 23:55:08'),
	(4,'Milana d','asd@sadas.asd','asdas',1,1,'name','street','123','asdas',NULL,NULL,NULL,0,NULL,NULL,'http://www.ucarecdn.com/31d11483-333f-4a20-9b2d-401d224ca02c~4/',NULL,NULL,43.149419,22.594342,NULL,NULL,NULL,NULL,2,2,0,NULL,'month','2017-12-21 14:43:14','2017-12-27 14:43:14',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2018-01-12 15:32:07','2018-01-14 23:55:08'),
	(5,'Milana g','asd@sadas.asd','asdas',1,1,'name','street','123','asdas',NULL,NULL,NULL,0,NULL,NULL,'http://www.ucarecdn.com/31d11483-333f-4a20-9b2d-401d224ca02c~4/',NULL,NULL,43.158427,22.587334,NULL,NULL,NULL,NULL,2,2,0,NULL,'month','2017-12-21 14:43:14','2017-12-27 14:43:14',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2018-01-12 15:32:13','2018-01-18 23:55:05'),
	(6,'Milana h','asd@sadas.asd','asdas',1,1,'name','street','123','asdas',NULL,NULL,NULL,0,NULL,NULL,'http://www.ucarecdn.com/31d11483-333f-4a20-9b2d-401d224ca02c~4/',NULL,NULL,43.174587,22.581271,NULL,NULL,NULL,NULL,2,1,0,NULL,'month','2017-12-21 14:43:14','2017-12-27 14:43:14',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2018-01-12 15:32:05','2018-01-18 23:55:05'),
	(7,'Milana j','asd@sadas.asd','asdas',1,1,'name','street','123','asdas',NULL,NULL,NULL,0,NULL,NULL,'http://www.ucarecdn.com/31d11483-333f-4a20-9b2d-401d224ca02c~4/',NULL,NULL,43.148291,22.587023,NULL,NULL,NULL,NULL,2,2,0,NULL,'month','2017-12-21 14:43:14','2017-12-27 14:43:14',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2018-01-12 15:32:10','2018-01-31 23:55:15'),
	(10,'club1','sad@asd.asd','$2y$10$567KYPuKt6uM/x8wDgn/6eIaIqUC.ul2AyGVk6x2I.dQMGfoUsdtS',1,NULL,'sd','sd','sd','sd',NULL,'23',NULL,0,NULL,NULL,'https://ucarecdn.com/0e57c276-f72a-4cdd-bb54-d877c1cf4b59~4/',NULL,NULL,NULL,NULL,167,168,169,170,1,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'6Ft8MnHMi91OSM39Tv1awk4aaa3rrUJzZHNo3sSHG6pPEk0IZCs0lT02dGeq','2018-01-19 16:06:35','2018-01-19 16:49:58'),
	(11,'club123','club123@123.com','$2y$10$5OMntuhPC9h6RVqrKaewi.rzR5tPjBTDxbGQVeqIDkN8XNu6gg4Ri',1,NULL,'sad','asd','sad','asd',NULL,'123',NULL,0,NULL,NULL,'https://ucarecdn.com/9a7e14e9-2aea-4153-9094-3276d49f224c~4/',NULL,NULL,NULL,NULL,171,172,173,174,1,1,1,NULL,'year','2018-02-12 00:00:00','2019-02-12 00:00:00',NULL,NULL,NULL,NULL,NULL,'cus_CJN4LR4MwhpVDe',NULL,'12',NULL,'LJMkaWRNXfwytkUcYcnVRvDOr4eB7COGE9IT0yU5FEIJKrwHFcuZSe67cTUz','2018-02-12 17:37:11','2018-02-12 17:39:13'),
	(12,'club12','club12@club12.com','$2y$10$5VkbEOrIQmCg8mmja60fgOIXoemIV3b2U6jijNMprnCfvWPtYj50y',1,NULL,'sd','sd','sd','sd',NULL,'123',NULL,0,NULL,NULL,'https://ucarecdn.com/6ffa085d-b294-4ef0-91c5-442b323c07f4~4/',NULL,NULL,NULL,NULL,175,176,177,178,1,1,1,NULL,'month','2018-02-12 00:00:00','2018-03-12 00:00:00',NULL,NULL,NULL,NULL,NULL,'cus_CJNE6XML6MHin9',NULL,'1',NULL,'m7RJmyiv6njHriVYUmUyCN3dcYzdSCACvqgqHokbdI8Yi0KZO5ptCvco3UJ8','2018-02-12 17:47:49','2018-02-12 17:49:15'),
	(13,'club12','club12@club12.com','$2y$10$uyN4kggTyazKMIxYp.8FM.BZdPHNBdcIehKSjX85CKOZ4WsT.7AEa',1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2018-02-12 17:47:51','2018-02-12 17:47:51'),
	(14,'shogun1234','apostat@apostat.com','$2y$10$tarfZ/3.UPtXKN.xOH1Xg.Rm8IL8CTN22k6CH4PSXmdUFMQ/uTqpy',1,NULL,'sdfsdf sdfsdf','ds','12312','dsfsdf',NULL,'12312',NULL,0,NULL,NULL,'https://ucarecdn.com/22361050-23b2-42bf-b978-6340e0f284ca~4/',NULL,NULL,NULL,NULL,179,180,181,182,1,1,1,NULL,'year','2018-02-12 00:00:00','2019-02-12 00:00:00',NULL,NULL,NULL,NULL,NULL,'cus_CJNhqksr6rlFLq',NULL,'12',NULL,'u2dKN6odEb85LB4k8grZioKbsN7pG5JPUdVSpFzc0Vt3seKEwPjwcXoRe73s','2018-02-12 18:07:08','2018-02-12 18:17:55'),
	(22,'uros123','uros.djordjevic3009@gmail.com','$2y$10$zGOKA.XwvNcGDykBSj8y4.HH9qPrDJ.kFvzk/qE27Cjo9SHE6RuPO',1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2018-02-12 18:21:43','2018-02-12 18:21:43'),
	(23,'uros123','uros.djordjevic3009@gmail.com','$2y$10$ofXV0E09dkbqgUJH.t2SRer/7vwKyMPQ79u4xrzZAYYoBmPaeKNpG',1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2018-02-12 18:21:46','2018-02-12 18:21:46'),
	(24,'shogun1233','sd@asd.asd','$2y$10$rekIFh8DTI02PHw2ScF3x.Sgxit0pGXRpO9rS06ofSVsVseG6mgo.',1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2018-02-12 18:30:48','2018-02-12 18:30:48'),
	(25,'konj2','konj@konj.com22','$2y$10$/3Cb8GeM809bgrNkS23e4.GOGu/RibZeRZeNYCFApeaxbRhJ1ZWCO',1,NULL,'ads','c','sad','asd',NULL,'213',NULL,0,NULL,NULL,'https://ucarecdn.com/202fb3fb-8d78-46fe-9ac6-b108ba5c4d07~4/',NULL,NULL,NULL,NULL,183,184,185,186,1,1,1,NULL,'year','2018-02-12 00:00:00','2019-02-12 00:00:00',NULL,NULL,NULL,NULL,NULL,'cus_CJOtrTDYD6PKBj',NULL,'12',NULL,'2co75qt5cU9gMNQiynIKcV98LXJh6G0bf0CIR6r5CKg0Uh20LJxijjTBUDjz','2018-02-12 19:21:18','2018-02-12 19:31:43'),
	(26,'username','myemailname410@gmail.com','$2y$10$f.tEwXWjNDjj5JR9d1RBwOUE5rc/L16CPyvGIL1FZFPTyOFoxclCm',1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2018-02-15 19:06:31','2018-02-15 19:06:31');

/*!40000 ALTER TABLE `locals` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table migrations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;

INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES
	(121,'2017_11_01_150903_setup_countries_table',1),
	(122,'2017_11_01_150904_charify_countries_table',1),
	(123,'2017_11_01_152958_create_services_table',1),
	(124,'2017_11_01_155723_create_cantons_table',1),
	(125,'2017_11_01_163800_create_user_types_table',1),
	(126,'2017_11_02_000000_create_users_table',1),
	(127,'2017_11_02_100000_create_password_resets_table',1),
	(128,'2017_11_02_153237_create_user_service_table',1),
	(129,'2017_11_02_175533_create_prices_table',1),
	(130,'2017_11_02_181235_create_packages_table',1),
	(131,'2017_11_03_161925_create_user_activations_table',1),
	(132,'2017_11_04_201104_create_clubs_info_table',1),
	(133,'2017_11_07_120653_create_local_types_table',1),
	(134,'2017_11_13_174810_create_local_packages_table',1),
	(135,'2017_11_13_205100_create_roles_table',1),
	(136,'2017_11_13_205202_create_user_role_table',1),
	(137,'2017_11_22_153939_create_notifications_table',1),
	(138,'2017_11_29_161731_create_contact_options_table',1),
	(139,'2017_11_29_162151_create_user_contact_option',1),
	(140,'2017_11_29_172652_create_service_options_table',1),
	(141,'2017_11_29_173003_create_user_service_options_table',1),
	(142,'2017_11_29_213138_create_spoken_languages_table',1),
	(143,'2017_11_29_213458_create_user_spoken_language_table',1),
	(144,'2017_11_30_144509_create_locals_table',1),
	(145,'2017_12_07_121332_create_local_girls_table',1),
	(146,'2017_12_07_173643_add_spoken_language_code_to_spoken_languages_table',1),
	(147,'2017_12_15_152551_create_faqs_table',1),
	(150,'2018_01_22_172524_create_black_books_table',2),
	(157,'2018_01_23_133408_create_news_table',3),
	(158,'2018_01_23_133440_create_events_table',3),
	(167,'2018_01_25_172645_create_banners_table',4),
	(168,'2018_01_26_111406_create_pages_table',4),
	(169,'2018_01_26_112420_create_banner_sizes_table',4),
	(170,'2018_01_26_121912_create_page_banner_size_table',5),
	(171,'2018_01_26_135923_create_page_banner_table',6),
	(172,'2018_01_29_190757_create_banner_page_migration',7);

/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table news
# ------------------------------------------------------------

DROP TABLE IF EXISTS `news`;

CREATE TABLE `news` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `local_id` int(10) unsigned DEFAULT NULL,
  `news_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `news_total_amount` int(11) DEFAULT NULL,
  `news_photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `news_description` text COLLATE utf8mb4_unicode_ci,
  `news_activation_date` timestamp NULL DEFAULT NULL,
  `news_expiry_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `news_local_id_foreign` (`local_id`),
  CONSTRAINT `news_local_id_foreign` FOREIGN KEY (`local_id`) REFERENCES `locals` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `news` WRITE;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;

INSERT INTO `news` (`id`, `local_id`, `news_title`, `news_total_amount`, `news_photo`, `news_description`, `news_activation_date`, `news_expiry_date`, `created_at`, `updated_at`)
VALUES
	(2,2,'asdasd',16,'https://ucarecdn.com/307becb8-297b-4462-8ac0-63575787739e/-/crop/522x597/189,0/-/resize/490x560/','asdasdasd','2018-01-24 00:00:00','2018-01-30 00:00:00','2018-01-24 20:19:15','2018-01-24 20:19:15'),
	(3,2,'asdasd',25,'https://ucarecdn.com/8ff70294-1b1c-417d-8d1c-a40b8c4e0f61/-/crop/522x596/378,0/-/resize/490x560/','asdasdas','2018-01-24 00:00:00','2018-02-08 00:00:00','2018-01-24 21:15:15','2018-01-24 21:15:15'),
	(4,2,'asdsad',19,'https://ucarecdn.com/a96ef7ac-280c-44da-a429-167c26a45ead/-/crop/522x597/189,0/-/resize/490x560/','asdasd','2018-01-24 00:00:00','2018-02-02 00:00:00','2018-01-24 21:19:21','2018-01-24 21:19:21'),
	(5,2,'asdasd',10,'https://ucarecdn.com/460844ac-5bed-4998-993a-27b1223acadf/-/crop/700x800/290,0/-/resize/490x560/','asd','2018-01-24 00:00:00','2018-01-24 00:00:00','2018-01-24 22:51:27','2018-01-24 22:51:27'),
	(6,2,'sad',10,'https://ucarecdn.com/99edb167-eeb2-4cc3-9652-36eae1c6ca3d/-/crop/700x800/290,0/-/resize/490x560/','asd','2018-01-24 00:00:00','2018-01-24 00:00:00','2018-01-24 22:52:49','2018-01-24 22:52:49'),
	(7,2,'ASD',10,'https://ucarecdn.com/781e3267-4cce-41e4-aee4-07f092f353bf/-/crop/522x597/189,0/-/resize/490x560/','ASD','2018-01-24 00:00:00','2018-01-24 00:00:00','2018-01-24 22:53:37','2018-01-24 22:53:37');

/*!40000 ALTER TABLE `news` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table notifications
# ------------------------------------------------------------

DROP TABLE IF EXISTS `notifications`;

CREATE TABLE `notifications` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_de` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_fr` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_it` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note_de` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note_fr` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note_it` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `notifiable_id` int(10) unsigned DEFAULT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;

INSERT INTO `notifications` (`id`, `url`, `title_de`, `title_en`, `title_fr`, `title_it`, `note_de`, `note_en`, `note_fr`, `note_it`, `is_read`, `notifiable_id`, `notifiable_type`, `created`)
VALUES
	(2,NULL,'Girl of The Month Package Expiration','Girl of The Month Package Expiration','Girl of The Month Package Expiration','Girl of The Month Package Expiration','Your girl of the month package expires on 23rd January 2018','Your girl of the month package expires on 23rd January 2018','Your girl of the month package expires on 23rd January 2018','Your girl of the month package expires on 23rd January 2018',0,1,'App\\Models\\User','2018-01-22 13:53:05'),
	(3,NULL,'Basic Package Expiration','Basic Package Expiration','Basic Package Expiration','Basic Package Expiration','Your default package expires on 30th January 2018','Your default package expires on 30th January 2018','Your default package expires on 30th January 2018','Your default package expires on 30th January 2018',0,1,'App\\Models\\User','2018-01-29 10:20:57');

/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table packages
# ------------------------------------------------------------

DROP TABLE IF EXISTS `packages`;

CREATE TABLE `packages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `package_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `package_duration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `package_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `packages` WRITE;
/*!40000 ALTER TABLE `packages` DISABLE KEYS */;

INSERT INTO `packages` (`id`, `package_name`, `package_duration`, `package_price`, `created_at`, `updated_at`)
VALUES
	(1,'S','7','50','2018-01-10 21:20:04','2018-01-10 21:20:04'),
	(2,'M','14','150','2018-01-10 21:20:04','2018-01-10 21:20:04'),
	(3,'L','30','25','2018-01-10 21:20:04','2018-01-10 21:20:04'),
	(4,'XL','90','350','2018-01-10 21:20:04','2018-01-10 21:20:04'),
	(5,'XXL','180','450','2018-01-10 21:20:04','2018-01-10 21:20:04'),
	(6,'XXXL','365','550','2018-01-10 21:20:04','2018-01-10 21:20:04');

/*!40000 ALTER TABLE `packages` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table page_banner_size
# ------------------------------------------------------------

DROP TABLE IF EXISTS `page_banner_size`;

CREATE TABLE `page_banner_size` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `page_id` int(10) unsigned NOT NULL,
  `banner_size_id` int(10) unsigned NOT NULL,
  `price_per_day` int(10) unsigned DEFAULT NULL,
  `price_per_week` int(10) unsigned DEFAULT NULL,
  `price_per_month` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `page_banner_size_page_id_foreign` (`page_id`),
  KEY `page_banner_size_banner_size_id_foreign` (`banner_size_id`),
  CONSTRAINT `page_banner_size_banner_size_id_foreign` FOREIGN KEY (`banner_size_id`) REFERENCES `banner_sizes` (`id`) ON DELETE CASCADE,
  CONSTRAINT `page_banner_size_page_id_foreign` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `page_banner_size` WRITE;
/*!40000 ALTER TABLE `page_banner_size` DISABLE KEYS */;

INSERT INTO `page_banner_size` (`id`, `page_id`, `banner_size_id`, `price_per_day`, `price_per_week`, `price_per_month`)
VALUES
	(1,1,1,100,500,2000),
	(4,1,2,70,250,1600),
	(5,1,3,20,60,500),
	(6,1,4,40,100,1000),
	(7,1,5,40,100,1000),
	(8,2,3,15,90,500),
	(9,2,4,25,140,700),
	(10,2,5,25,140,700),
	(11,2,6,25,140,700),
	(12,2,7,25,140,700),
	(13,3,3,15,90,500),
	(14,3,4,25,140,700),
	(15,3,5,25,140,700),
	(16,3,6,25,140,700),
	(17,3,7,25,140,700),
	(18,4,2,25,140,700),
	(19,4,3,15,90,500),
	(20,4,4,20,120,400),
	(21,4,5,20,120,400),
	(22,5,2,25,140,700),
	(23,5,3,15,90,500),
	(24,5,4,20,120,400),
	(25,5,5,20,120,400);

/*!40000 ALTER TABLE `page_banner_size` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table pages
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pages`;

CREATE TABLE `pages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `page_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;

INSERT INTO `pages` (`id`, `page_name`)
VALUES
	(1,'Home'),
	(2,'Private'),
	(3,'Locals'),
	(4,'FAQ'),
	(5,'Contact Us');

/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table password_resets
# ------------------------------------------------------------

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table prices
# ------------------------------------------------------------

DROP TABLE IF EXISTS `prices`;

CREATE TABLE `prices` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `price_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_duration` int(10) unsigned DEFAULT NULL,
  `service_price` int(10) unsigned DEFAULT NULL,
  `service_price_unit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `on_demand` tinyint(1) DEFAULT NULL,
  `service_price_currency` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `prices_user_id_foreign` (`user_id`),
  CONSTRAINT `prices_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `prices` WRITE;
/*!40000 ALTER TABLE `prices` DISABLE KEYS */;

INSERT INTO `prices` (`id`, `user_id`, `price_type`, `service_duration`, `service_price`, `service_price_unit`, `on_demand`, `service_price_currency`)
VALUES
	(9,2,'outcall',12,23,'days',NULL,'chf'),
	(85,1,'outcall',12,32,'days',NULL,'chf'),
	(89,1,'outcall',34,23,'days',NULL,'chf'),
	(90,1,'outcall',78,NULL,'days',1,'chf'),
	(91,1,'outcall',32,54,'Tage',NULL,'CHF'),
	(92,1,'outcall',12,NULL,'Tage',1,'CHF');

/*!40000 ALTER TABLE `prices` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table roles
# ------------------------------------------------------------

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;

INSERT INTO `roles` (`id`, `role_name`, `role_description`, `created_at`, `updated_at`)
VALUES
	(1,'Standard User','A standard registered user with no admin rights.','2018-01-10 21:20:06','2018-01-10 21:20:06'),
	(2,'Moderator','A moderator of the website who has similar permissions as the admin, but is not allowed to go to the admin page etc.','2018-01-10 21:20:06','2018-01-10 21:20:06'),
	(3,'Admin','An admin of the website who has similar permissions as the super admin, but still some of the permissions are restricted.','2018-01-10 21:20:06','2018-01-10 21:20:06');

/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table service_options
# ------------------------------------------------------------

DROP TABLE IF EXISTS `service_options`;

CREATE TABLE `service_options` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `service_option_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `service_options` WRITE;
/*!40000 ALTER TABLE `service_options` DISABLE KEYS */;

INSERT INTO `service_options` (`id`, `service_option_name`)
VALUES
	(1,'men'),
	(2,'women'),
	(3,'couples'),
	(4,'gays'),
	(5,'trans'),
	(6,'2+');

/*!40000 ALTER TABLE `service_options` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table services
# ------------------------------------------------------------

DROP TABLE IF EXISTS `services`;

CREATE TABLE `services` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `service_name_de` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_name_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_name_fr` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_name_it` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `services` WRITE;
/*!40000 ALTER TABLE `services` DISABLE KEYS */;

INSERT INTO `services` (`id`, `service_name_de`, `service_name_en`, `service_name_fr`, `service_name_it`)
VALUES
	(1,'Position 69','Position 69','Position 69','Posizione 69'),
	(2,'Anal Sex','Anal Sex','Sexe anal','Sesso anale'),
	(3,'In den Mund spritzen','Cum in Mouth','Ejaculation dans la bouche','Sborrata in Bocca'),
	(4,'Ins Gesicht spritzen','Cum on Face','Ejaculation faciale','Sborrata in faccia'),
	(5,'Dildo Spiele/Toys','Dildo Play/Toys','Jeux avec gode/sextoys','Dildo/Toys'),
	(6,'Küssen','Kissing','Bisous','Bacio'),
	(7,'Französisch mit','Blowjob with Condom','Fellation avec préservatif','Pompino con Preservativo'),
	(8,'Französisch ohne','Blowjob without Condom','Fellation sans préservatif','Pompino senza preservativo'),
	(9,'Franz. ohne bis zum Abschluss','Blowjob without Condom to Completion','Fellation sans préservatif jusqu\'à l\'éjaculation','Pompino senza preservativo completo'),
	(10,'Girlfriend Sex','Girlfriend Sex','Comme avec une petite amie (GFE)','Esperienza con Fidanzata (GFE)'),
	(11,'Zungenküsse','French Kissing','Embrasser avec la langue','Bacio alla francese'),
	(12,'Sex in allen Positionen','Sex in Different Positions','Sexe dans différentes positions','Sesso in posizioni diverse'),
	(13,'Körperbesamung','Cumshot on body (COB)','Ejaculation sur le corps','Sborrata sul corpo (COB)'),
	(14,'Feinmassage','Intimate massage','Massage intime','Massaggio parti intime'),
	(15,'Küssen bei Sympathie','Kissing if good chemistry','Bisous selon l\'alchimie','Bacio in caso di buona empatia'),
	(16,'Handjob','Handjob','Handjob','Sega'),
	(17,'Spanisch','Titjob','Branlette espagnole','Spagnola'),
	(18,'Erotische Massagen','Erotic massage','Massage érotique','Massaggio erotico'),
	(19,'Tantra','Tantric','Tantrique','Tantrico'),
	(20,'Deep Throat','Deep Throat','Gorge profonde','Deep Throat'),
	(21,'Gangbang','Gangbang','Gang-bang','Sesso di Gruppo'),
	(22,'Double Penetration (DP)','Double pénétration','','Doppia penetrazione (DP)'),
	(23,'Eierlecken','Ball Licking and Sucking','Lécher et sucer les testicules','Leccare e succhiare le palle'),
	(24,'Dirtytalk','Dirtytalk','Discussions cochonnes','Linguaggio volgare'),
	(25,'Bodyschaum','Foam massage','Massage avec mousse','Massaggio con Schiuma'),
	(26,'Striptease/Lapdance','Striptease/Lapdance','Striptease/Lapdance','Striptease/Lapdance'),
	(27,'Kamasutra','Kamasutra','Kamasutra','Kamasutra'),
	(28,'Snowballing','Snowballing','Snowballing','Snowballing'),
	(29,'Lesben Sexspiele','Lesbian Sex Games','Jeux sexuels lesbiens','Giochi sessuali Lesbiche'),
	(30,'Mehrfachspritzer willkommen','Extraball','Plusieurs éjaculations','Extraball'),
	(31,'Facesitting','Facesitting','S\'asseoir sur le visage','Seduta in faccia'),
	(32,'Fisting','Firsting','Fist-fucking','Fisting'),
	(33,'Ganzkörpermassage','Full Body Sensual Massage','Massage sensuel intégral','Massaggio sensuale su tutto il corpo'),
	(34,'Private Video','Private Video','Vidéo privée','Video Private'),
	(35,'Privates Fotoshooting','Private Photo','Photos Privées','Foto Private'),
	(36,'Masturbieren','Masturbate','Masturbation','Masturbazione'),
	(37,'Reizwäsche','Lingerie','Lingerie','Lingerie'),
	(38,'Duschservice','Shower service','Service de douche','Servizio Doccia'),
	(39,'Prostata Massage','Prostate Massage','Massage de la prostate','Massaggio alla prostata'),
	(40,'Whirlpool','Whirlpool','Bain à bulles','Idromassaggio'),
	(41,'Pornostar Service','Pornstar Service','Expérience de star du porno (PSE)','Esperienza Pornstar (PSE)'),
	(42,'DUO','DUO','','DUO'),
	(43,'Intimrasur','Intimate shaving','Epilation intime','Depilazione parti intime'),
	(44,'Outdoor Sex','Outdoor Sex','Sexe à l\'extérieur','Sesso all\'aperto'),
	(45,'Zungenanal (aktiv)','Rimming (attivo)','Anulingus (actif)',''),
	(46,'Zungenanal (passiv)','Rimming (receive)','Anulingus (passif)','Rimming (passivo)'),
	(47,'Analmassage (aktiv)','Anal massage (give)','Massage anal (actif)','Massaggio anale (attivo)'),
	(48,'Analmassage (passiv)','Anal massage (receive)','Massage anal (passif)','Massaggio anale (passivo)'),
	(49,'BDSM','BDSM','BDSM','BDSM'),
	(50,'Bondage','Bondage','Bondage','Bondage'),
	(51,'Latex / Leder','Latex / Leather','Cuir / latex / PVC','Pelle / Latex/PVC'),
	(52,'Kliniksex','Clinic Sex','Sexe médical','Sesso Clinico'),
	(53,'Fetish','Fetish','Fétischisme','Fetish'),
	(54,'Rollenspiele','Role Play and Fantasy','Jeux de rôles et fantaisie','Gioco di Ruolo e Fantasy'),
	(55,'Natursekt (aktiv)','Golden Shower (give)','Douche dorée (donneur)','Pioggia dorata (attivo)'),
	(56,'Natursekt (passiv)','Golden Shower (receive)','Douche dorée (receveur)','Pioggia dorata (passivo)'),
	(57,'Domina','Mistress','Maitresse','Mistress'),
	(58,'Spanking (aktiv)','Spanking (receive)','Fessée (actif)','Sculacciata (attivo)'),
	(59,'Spanking (passiv)','Spanking (receive)','Fessée (passif)','Sculacciata (passivo)'),
	(60,'Squirting','Squirting','Éjaculation féminine','Squirting'),
	(61,'Kaviar KV (passiv)','Scat (give)','Scato (actif)','Scat (attivo)'),
	(62,'Kaviar KV (aktiv)','Scat (receive)','Scato (passif)','Scat (passivo)'),
	(63,'Fussfetish','Foot Fetish','Fétischisme des pieds','Fetish Piedi'),
	(64,'Strap on','Strap on','Gode-ceinture','Strap on'),
	(65,'Devot / Sklavin (hart)','Submissive/Slave (hard)','Soumission/esclave (hard)','Sottomesso / Schiavo (hard)'),
	(66,'Devot / Sklavin (soft)','Soumission/esclave (soft)','Submissive/Slave (soft)','Sottomesso / Schiavo (soft)');

/*!40000 ALTER TABLE `services` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table spoken_languages
# ------------------------------------------------------------

DROP TABLE IF EXISTS `spoken_languages`;

CREATE TABLE `spoken_languages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `spoken_language_name_de` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `spoken_language_name_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `spoken_language_name_fr` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `spoken_language_name_it` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `spoken_language_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `spoken_languages` WRITE;
/*!40000 ALTER TABLE `spoken_languages` DISABLE KEYS */;

INSERT INTO `spoken_languages` (`id`, `spoken_language_name_de`, `spoken_language_name_en`, `spoken_language_name_fr`, `spoken_language_name_it`, `spoken_language_code`)
VALUES
	(1,'English','','','','en'),
	(2,'German','','','','de'),
	(3,'Italian','','','','it'),
	(4,'French','','','','fr'),
	(5,'Spanish','','','','es'),
	(6,'Russian','','','','ru'),
	(7,'Portuguese','','','','pt'),
	(8,'Dutch','','','','nl'),
	(9,'Serbian','','','','rs'),
	(10,'Slovenian','','','','sl'),
	(11,'Slovak','','','','sk'),
	(12,'Greek','','','','gr'),
	(13,'Bulgarian','','','','bg'),
	(14,'Czech','','','','cz'),
	(15,'Indian','','','','in'),
	(16,'Arabic','','','','sa'),
	(17,'Thai','','','','th'),
	(18,'Japanese','','','','jp'),
	(19,'Chinese','','','','cn'),
	(20,'Finnish','','','','fi'),
	(21,'Norwegian','','','','no'),
	(22,'Swedish','','','','se'),
	(23,'Danish','','','','dk'),
	(24,'Turkish','','','','tr'),
	(25,'Polish','','','','pl'),
	(26,'Romanian','','','','ro');

/*!40000 ALTER TABLE `spoken_languages` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table user_activations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_activations`;

CREATE TABLE `user_activations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `user_type` int(11) NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_activations_user_id_foreign` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `user_activations` WRITE;
/*!40000 ALTER TABLE `user_activations` DISABLE KEYS */;

INSERT INTO `user_activations` (`id`, `user_id`, `user_type`, `token`, `created_at`, `updated_at`)
VALUES
	(3,20,1,'R8mT1Nu2QM23QM8Ci6ToLxoOnr2sKUqfDdeYsqYp',NULL,NULL),
	(4,8,2,'soq0NTLDfrEsV8KvgX7pw1WrcRHmllrlIk57bZ5e',NULL,NULL),
	(5,9,2,'fSxoLvZObx2EbzrSnBHbjmHpzBI2t3cYqEVibmHj',NULL,NULL),
	(6,10,2,'MULmxSP6S1VjrYnQ7VOP0GFN4Ixfw2Thn3dkzanB',NULL,NULL),
	(7,11,2,'yXIGJdF6cSb76ZuLK6NILschV7C7kCBkWRpQ4uWO',NULL,NULL),
	(8,12,2,'QsB4sKQIeB56gbQlAqvQ8OeUSPeJ2bleronveTc6',NULL,NULL),
	(9,13,2,'cJzjnFT1sXUNU40xyDv4jpQal2XA66cMSHtWODXw',NULL,NULL),
	(13,17,2,'6QKL4rApIpVvpefeOYl08aKakKR9JCTFJZGOjM6k',NULL,NULL),
	(14,21,1,'GrQapjikBZz2yNxf4oikivdnib4YSxsQOeidDPBi',NULL,NULL),
	(17,20,2,'ukZPIjerXPMDe4jmxcrU3DHZAYa7s8JuuYC7XNED',NULL,NULL),
	(18,21,2,'3HxV0slu7oQqvRmU2BhvfEzn9qEBxiRJcunaDH96',NULL,NULL),
	(19,22,2,'zOFJg4YHymdLyO4msrSuRzcZ8riqLjkI4VD0vRj9',NULL,NULL),
	(20,23,2,'ktjMjjuy5ZlvIvthjd93x0ps7OzQfLAAgme6XbrE',NULL,NULL),
	(21,22,1,'k4VUrVZIVmSPRikScEzftaYplHIyvIqZ1G9gZX0B',NULL,NULL),
	(22,24,2,'gANW9GBVJAPeqDmpYJEbBmkTuLF8g231IcsqmAZU',NULL,NULL),
	(23,23,1,'kLGOcubNQ9BXezuhPsoR3s3CLTcXoRZf816INGki',NULL,NULL),
	(24,24,1,'xSXYTyV3ZgmV6vh1z6c7D4YVJ85moSCXpTEfEGEu',NULL,NULL),
	(25,25,1,'25V7TZEt0QM93EzViJFfZpEB4eQcYg1HCR5hv9ZM',NULL,NULL),
	(26,26,1,'R44s2esrlZk7tkLKf3Y2bBNVXXTNNiuIqUJSWDzF',NULL,NULL),
	(27,27,1,'HvOXTJw7vbioH9qIWAbPOvCi4wwAP4J7cqaYPmVk',NULL,NULL),
	(28,28,1,'x69ilF0nVpWEvYmZojcHpwR4gDdzJnzNFgcTpfKZ',NULL,NULL),
	(29,29,1,'JU0A93JtLaGhzc7PxzgHVg8mD17KLwEWuy3ZEAJG',NULL,NULL),
	(30,30,1,'grzs6WRE5vo6UFZRuo4ntLulXIqJfRhLihwz5UiJ',NULL,NULL),
	(31,31,1,'86ul1iJYZz09Au5Yd4HbKGFbSpHyWMvPNXCzTdmv',NULL,NULL),
	(32,25,2,'RY7euaMM9pIojeh2G4Q6yxByhUxQbHmoOAkT6Rq7',NULL,NULL),
	(33,26,2,'231TWY7tgMkbFcoEmyxB6EZQCfLUCgyJhnIMKBb6',NULL,NULL);

/*!40000 ALTER TABLE `user_activations` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table user_contact_option
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_contact_option`;

CREATE TABLE `user_contact_option` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `contact_option_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_contact_option_user_id_foreign` (`user_id`),
  KEY `user_contact_option_contact_option_id_foreign` (`contact_option_id`),
  CONSTRAINT `user_contact_option_contact_option_id_foreign` FOREIGN KEY (`contact_option_id`) REFERENCES `contact_options` (`id`) ON DELETE CASCADE,
  CONSTRAINT `user_contact_option_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `user_contact_option` WRITE;
/*!40000 ALTER TABLE `user_contact_option` DISABLE KEYS */;

INSERT INTO `user_contact_option` (`id`, `user_id`, `contact_option_id`)
VALUES
	(3,2,1),
	(4,2,2),
	(5,2,3);

/*!40000 ALTER TABLE `user_contact_option` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table user_role
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_role`;

CREATE TABLE `user_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `role_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_role_user_id_foreign` (`user_id`),
  KEY `user_role_role_id_foreign` (`role_id`),
  CONSTRAINT `user_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `user_role_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table user_service
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_service`;

CREATE TABLE `user_service` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `service_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_service_user_id_foreign` (`user_id`),
  KEY `user_service_service_id_foreign` (`service_id`),
  CONSTRAINT `user_service_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE,
  CONSTRAINT `user_service_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `user_service` WRITE;
/*!40000 ALTER TABLE `user_service` DISABLE KEYS */;

INSERT INTO `user_service` (`id`, `user_id`, `service_id`)
VALUES
	(3,2,2),
	(4,2,16),
	(5,2,18),
	(6,2,34),
	(7,2,35),
	(8,2,37),
	(9,2,39),
	(10,2,40),
	(11,2,43),
	(12,2,44),
	(13,2,47),
	(14,2,50),
	(15,2,51),
	(16,2,58),
	(17,2,62),
	(19,1,56);

/*!40000 ALTER TABLE `user_service` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table user_service_options
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_service_options`;

CREATE TABLE `user_service_options` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `service_option_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_service_options_user_id_foreign` (`user_id`),
  KEY `user_service_options_service_option_id_foreign` (`service_option_id`),
  CONSTRAINT `user_service_options_service_option_id_foreign` FOREIGN KEY (`service_option_id`) REFERENCES `service_options` (`id`) ON DELETE CASCADE,
  CONSTRAINT `user_service_options_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `user_service_options` WRITE;
/*!40000 ALTER TABLE `user_service_options` DISABLE KEYS */;

INSERT INTO `user_service_options` (`id`, `user_id`, `service_option_id`)
VALUES
	(1,2,1),
	(3,1,1);

/*!40000 ALTER TABLE `user_service_options` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table user_spoken_language
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_spoken_language`;

CREATE TABLE `user_spoken_language` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `spoken_language_id` int(10) unsigned DEFAULT NULL,
  `language_level` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_spoken_language_user_id_foreign` (`user_id`),
  KEY `user_spoken_language_spoken_language_id_foreign` (`spoken_language_id`),
  CONSTRAINT `user_spoken_language_spoken_language_id_foreign` FOREIGN KEY (`spoken_language_id`) REFERENCES `spoken_languages` (`id`) ON DELETE CASCADE,
  CONSTRAINT `user_spoken_language_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `user_spoken_language` WRITE;
/*!40000 ALTER TABLE `user_spoken_language` DISABLE KEYS */;

INSERT INTO `user_spoken_language` (`id`, `user_id`, `spoken_language_id`, `language_level`)
VALUES
	(2,2,1,2),
	(3,2,2,1),
	(4,2,3,3);

/*!40000 ALTER TABLE `user_spoken_language` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table user_types
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_types`;

CREATE TABLE `user_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_type_name_de` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_type_name_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_type_name_fr` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_type_name_it` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `user_types` WRITE;
/*!40000 ALTER TABLE `user_types` DISABLE KEYS */;

INSERT INTO `user_types` (`id`, `user_type_name_de`, `user_type_name_en`, `user_type_name_fr`, `user_type_name_it`)
VALUES
	(1,'Private','','',''),
	(2,'Local','','','');

/*!40000 ALTER TABLE `user_types` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_type_id` int(10) unsigned NOT NULL,
  `local_id` int(10) unsigned DEFAULT NULL,
  `activated` tinyint(1) NOT NULL DEFAULT '0',
  `has_profile` tinyint(1) NOT NULL DEFAULT '0',
  `is_active_d_package` tinyint(1) NOT NULL DEFAULT '0',
  `is_active_gotm_package` tinyint(1) NOT NULL DEFAULT '0',
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nickname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_id` int(10) unsigned DEFAULT NULL,
  `age` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `height` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `weight` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sex` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sex_orientation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `figure` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `breast_size` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `eye_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hair_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tattoos` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `piercings` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `body_hair` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `intimate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `smoker` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alcohol` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about_me` text COLLATE utf8mb4_unicode_ci,
  `photos` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `videos` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sms_notifications` tinyint(1) DEFAULT '0',
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `prefered_contact_option` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `skype_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_withheld_numbers` tinyint(1) NOT NULL DEFAULT '0',
  `canton_id` int(10) unsigned DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lat` decimal(9,6) DEFAULT NULL,
  `lng` decimal(9,6) DEFAULT NULL,
  `club_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `incall_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `outcall_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `working_time` text COLLATE utf8mb4_unicode_ci,
  `package1_id` int(10) unsigned DEFAULT NULL,
  `package1_activation_date` timestamp NULL DEFAULT NULL,
  `package1_expiry_date` timestamp NULL DEFAULT NULL,
  `package2_id` int(10) unsigned DEFAULT NULL,
  `package2_activation_date` timestamp NULL DEFAULT NULL,
  `package2_expiry_date` timestamp NULL DEFAULT NULL,
  `scheduled_default_package` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scheduled_gotm_package` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stripe_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stripe_last4_digits` varchar(4) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stripe_amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `year_visitors` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `users_user_type_id_foreign` (`user_type_id`),
  KEY `users_country_id_foreign` (`country_id`),
  KEY `users_canton_id_foreign` (`canton_id`),
  CONSTRAINT `users_canton_id_foreign` FOREIGN KEY (`canton_id`) REFERENCES `cantons` (`id`) ON DELETE CASCADE,
  CONSTRAINT `users_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE,
  CONSTRAINT `users_user_type_id_foreign` FOREIGN KEY (`user_type_id`) REFERENCES `user_types` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `username`, `email`, `password`, `user_type_id`, `local_id`, `activated`, `has_profile`, `is_active_d_package`, `is_active_gotm_package`, `first_name`, `last_name`, `nickname`, `country_id`, `age`, `height`, `weight`, `sex`, `sex_orientation`, `type`, `figure`, `breast_size`, `eye_color`, `hair_color`, `tattoos`, `piercings`, `body_hair`, `intimate`, `smoker`, `alcohol`, `about_me`, `photos`, `videos`, `phone`, `mobile`, `sms_notifications`, `website`, `prefered_contact_option`, `skype_name`, `no_withheld_numbers`, `canton_id`, `city`, `zip_code`, `address`, `lat`, `lng`, `club_name`, `incall_type`, `outcall_type`, `working_time`, `package1_id`, `package1_activation_date`, `package1_expiry_date`, `package2_id`, `package2_activation_date`, `package2_expiry_date`, `scheduled_default_package`, `scheduled_gotm_package`, `stripe_id`, `stripe_last4_digits`, `stripe_amount`, `year_visitors`, `remember_token`, `created_at`, `updated_at`)
VALUES
	(1,'shogun','disabledbyfb@gmail.com','$2y$10$wyj/D.lvAjx2BnuFrYSFvOoXC6wycRcADaDH4vnLBqlHLck/1K6xK',1,NULL,1,1,0,0,'sd','as','sd',NULL,'18','23','12','female','heterosexual',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'shaved','yes','yes','sd','https://ucarecdn.com/eed8bc5b-a941-4c9d-9c21-2ca21d19f74a~4/',NULL,NULL,'60319825',0,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2018-02-20 00:00:00','2018-02-27 00:00:00',1,'2018-02-20 00:00:00','2018-02-21 00:00:00',NULL,'1&|2018-02-23 00:00:00&|2018-03-02 00:00:00&|50','cus_CMMyvBywNy6bnD',NULL,NULL,NULL,'rkr9XK6Tx8VgbM8peLI5NKFogp65sKSxuc8tdaJabVLDkocxhwW1gRJsMxux','2017-12-18 12:56:56','2018-02-20 17:52:02'),
	(2,'test1','test1@test1.com','$2y$10$xXg4TlP.rge0d1eVLd27aujpcuEiODzkCquz3kJ.oilbFa2UyhEXa',1,NULL,1,1,1,1,'sd','sd','sd',NULL,'18','12','332','female','heterosexual',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'shaved','shaved','yes','yes','sd','https://ucarecdn.com/df7ec48a-e7bc-4b1b-aa6d-4803238edad4~4/',NULL,'123','60 3198250',1,'https://www.google.com','sms_and_call','opalac',0,4,'Pirot','18300','Tanasko Rajic 64',43.148018,22.589060,'Slub','Private Apartment','define_yourself|asd','[\"Monday|00:00 - 00:00\",\"Tuesday|00:00 - 00:00&2\",\"Wednesday|00:00 - 00:00\",\"Thursday|00:00 - 00:00&4\",\"Friday|00:00 - 00:00\",\"Saturday|00:00 - 00:00&6\",\"Sunday|00:00 - 00:00&7\"]',2,'2018-01-12 00:00:00','2018-02-28 00:00:00',2,'2017-12-19 08:29:41','2019-12-25 08:29:41',NULL,NULL,NULL,NULL,NULL,NULL,'lg21yyBuIwYY1fOqMXfCowHM6QgfoEu7bGz3e6ESj4Td4buZ23yCotreAHer','2017-12-18 12:56:56','2018-01-31 23:55:09'),
	(3,'test2','test2@test2.com','$2y$10$E6.2GPkkUQpsLwbwFmWSqemf/9TF6M75YXM1NXBZrh8YcwP1EcqL6',1,NULL,1,1,1,1,'Jena3','Jansen3','Jena3',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'https://www.ucarecdn.com/31d11483-333f-4a20-9b2d-401d224ca02c~4/',NULL,NULL,NULL,NULL,'https://www.google.com',NULL,NULL,0,NULL,NULL,NULL,NULL,43.149419,22.594342,NULL,NULL,NULL,NULL,1,'2017-12-19 08:29:30','2018-12-26 08:29:30',2,'2017-12-19 08:29:41','2019-12-25 08:29:41',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2017-12-18 12:56:56','2018-01-11 18:00:08'),
	(4,'test3','test3@test3.com','$2y$10$CI5yPCyzDjsel3xGEIsIUO2X113sdAOHf.p4s41INqD4YABRjwtCK',1,NULL,1,1,1,1,'Jena4','Jansen4','Jena4',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'https://www.ucarecdn.com/31d11483-333f-4a20-9b2d-401d224ca02c~4/',NULL,NULL,NULL,NULL,'https://www.google.com',NULL,NULL,0,NULL,NULL,NULL,NULL,43.158427,22.587334,NULL,NULL,NULL,NULL,1,'2017-12-19 08:29:41','2019-12-25 08:29:41',2,'2017-12-19 08:29:41','2019-12-25 08:29:41',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2017-12-18 12:56:56','2018-01-11 18:00:09'),
	(5,'test4','test4@test4.com','$2y$10$LmufbDUVGZBfx.VOLAYuO.bxYL1SesMyakS7/I4Q2mMW17LitxhCK',1,NULL,1,1,1,1,'Jena5','Jansen5','Jena5',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'https://www.ucarecdn.com/31d11483-333f-4a20-9b2d-401d224ca02c~4/',NULL,NULL,NULL,NULL,'https://www.google.com',NULL,NULL,0,NULL,NULL,NULL,NULL,43.174587,22.581271,NULL,NULL,NULL,NULL,1,'2017-12-19 08:29:51','2019-12-25 08:29:51',2,'2017-12-19 08:29:41','2019-12-25 08:29:41',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2017-12-18 12:56:56','2018-01-11 18:00:11'),
	(6,'test5','test5@test5.com','$2y$10$z8LYtP/pAStQJKX/biqimuNsn.PSqeYajSorBFOS9Bos.VZt./Jru',1,NULL,1,1,1,1,'Jena6','Jansen6','Jena6',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'https://www.ucarecdn.com/31d11483-333f-4a20-9b2d-401d224ca02c~4/',NULL,NULL,NULL,NULL,'https://www.google.com',NULL,NULL,0,NULL,NULL,NULL,NULL,43.148291,22.587023,NULL,NULL,NULL,NULL,1,'2017-12-19 08:30:04','2019-12-25 08:30:04',2,'2017-12-19 08:29:41','2019-12-25 08:29:41',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2017-12-18 12:56:57','2018-01-11 18:00:13'),
	(7,'test6','test6@test6.com','$2y$10$EsO4w7yUpRCLxUsWD9Ny0.1kNZXTAkqMKwvkeDGNZ/4TqRYB8rWtq',1,NULL,1,1,0,0,'Jena7','Jansen7','Jena7',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'https://www.ucarecdn.com/31d11483-333f-4a20-9b2d-401d224ca02c~4/',NULL,NULL,NULL,NULL,'https://www.google.com',NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2017-12-18 12:56:57','2017-12-18 12:56:57'),
	(8,'test7','test7@test7.com','$2y$10$S4E6.FRMmJ4GTTZy7glY6eNn2/TYhvBz6vwWc0E.CLDJUTZRjhjuC',1,NULL,1,1,0,0,'Jena8','Jansen8','Jena8',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'https://www.google.com',NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2017-12-18 12:56:57','2017-12-18 12:56:57'),
	(9,'test8','test8@test8.com','$2y$10$hWlZdwFKJvm59ekTsgY0Bu.DVcB1DF0wDesFkmUhmDzBe4YnZQ2jC',1,NULL,1,1,0,0,'Jena8','Jansen8','Jena8',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'https://www.google.com',NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2017-12-18 12:56:57','2017-12-18 12:56:57'),
	(10,'test9','test9@test9.com','$2y$10$tC2YQ4OHBon4Vs1rK9Y66.DThGKrH44hh5gJgDctiAkQVjFO18shq',1,NULL,1,1,0,0,'Jena9','Jansen9','Jena9',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'https://www.google.com',NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2017-12-18 12:56:57','2017-12-18 12:56:57'),
	(11,'test10','test10@test10.com','$2y$10$zjuKGHuKCijiQqtEhdWHgucolrOZRAyQJ9pQK/8CwPQMgFtgQhAZm',1,NULL,1,1,0,0,'Jena10','Jansen10','Jena10',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'https://www.google.com',NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2017-12-18 12:56:57','2017-12-18 12:56:57'),
	(12,'test11','test11@test11.com','$2y$10$NRGwy8qK1gebiQHqikgXp.TUAf3yopXdQE3ZC4Lzu0SDRA5YaaCTW',1,NULL,1,1,0,0,'Jena11','Jansen11','Jena11',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'https://www.google.com',NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2017-12-18 12:56:58','2017-12-18 12:56:58'),
	(13,'test12','test12@test12.com','$2y$10$clxbZce4LcIydZa6Gg2W3uAPtivuNYlYW2cRAlmoFFQuAEEyzNurO',1,NULL,1,0,0,0,'Jena12','Jansen12','Jena12',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'https://www.google.com',NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2017-12-18 12:56:58','2017-12-18 12:56:58'),
	(17,'paolo','sd@gmail.com','$2y$10$wyj/D.lvAjx2BnuFrYSFvOoXC6wycRcADaDH4vnLBqlHLck/1K6xK',1,NULL,1,1,0,0,'Jena','Jameson','Jena',688,'27','160','50','female','heterosexual','european','athletic','d','blue',NULL,'yes','yes','partial','shaved','yes','no','Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.','https://ucarecdn.com/3d29bf46-ab20-43a5-a775-ae72f97c7e96~4/','https://ucarecdn.com/711eb4b7-a7a3-4142-a5ba-dbfab0d75ce0/','012435678','603198250',1,'https://www.google.com','sms_and_call','sd',1,6,'Beograd','18300','Brace Jerkovic 32',NULL,NULL,'Club','Hotel','define_yourself|Car','[\"Monday|08:12 - 14:00&1\",\"Thursday|03:08 - 09:15\",\"Saturday|06:08 - 10:17\",\"Sunday|08:00 - 13:00&7\"]',1,'2017-12-19 00:00:00','2018-01-14 00:00:00',NULL,NULL,NULL,NULL,NULL,'cus_Byjdpr4vy92szC',NULL,'50',NULL,'tZ9XUmljtRxCttDQEBmDLzyw7P1KwK05nnzh6bWi1PHqIwZ9oBCKWyI9clb9','2017-12-18 12:56:56','2018-01-11 20:08:52'),
	(20,'shogun_oroku1','myemailname410@gmail.co','$2y$10$SX/hYY6nOJg4Y.MjUK1GXuPbHgWlfYe5XBmhy7.iC5Eh8tj5XzbzS',1,NULL,1,1,0,0,'sd','sd','sd',NULL,'18','123','123','female','heterosexual',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'shaved','yes','yes','asdsad','https://ucarecdn.com/206ecff8-b932-4565-b90d-2704ecf1d95f~4/',NULL,NULL,'603198250',0,'https://www.google.com',NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2018-01-16 00:00:00','2018-01-23 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'3A1hr3I9eNCI2W9YtmrNHMajuNKINudRRoKxTcktQH2FxcydwMDCCYw1Yp32','2018-01-16 17:55:29','2018-01-31 23:55:10'),
	(21,'uros','uros@soldatech.rs','$2y$10$HQ68de6R/UC9Kw3NWmG.sO7oBYmWLkpkClzWudoFFJ9UkxyWIKrDi',1,NULL,1,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'https://www.google.com',NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2018-02-12 18:19:55','2018-02-12 18:19:55'),
	(22,'shogun456','shogun@asd.asd','$2y$10$pXCB8CMXRX/AFZyFvKbB/.MwW78gZpqej37wvfCeFriHUMi74ZTzq',1,NULL,1,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'https://www.google.com',NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2018-02-12 18:25:17','2018-02-12 18:25:17'),
	(28,'sad@asd.asd','asd@asd.asdsdgdfgsd','$2y$10$3A4YbzNTWu5vxUXqATvVWeO4NsuTLkfcs4Sy.HVZog5w3Mp61S32e',1,NULL,1,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'https://www.google.com',NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2018-02-12 19:16:16','2018-02-12 19:16:16'),
	(31,'asd@asd.asdasdsa','adssa2@sadasd.dsfsdf','$2y$10$ctC.M5bvsbre8npoTpvGj.8MKzR2iWbDoaT6JcRdN0MJrWGXHzdwq',1,NULL,1,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'https://www.google.com',NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2018-02-12 19:19:10','2018-02-12 19:19:10'),
	(34,'oroku','oroku@oroku.com','$2y$10$wyj/D.lvAjx2BnuFrYSFvOoXC6wycRcADaDH4vnLBqlHLck/1K6xK',1,NULL,1,1,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'https://www.google.com',NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(48,'konjina','random@random.com','',1,2,0,0,0,0,'asd','asd','asd',NULL,'18','23','12','female','heterosexual',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'shaved','yes','yes','dsa','https://ucarecdn.com/d9fbaaa7-cceb-4ec5-8f36-db4ddc082536~4/',NULL,NULL,NULL,0,'https://www.google.com',NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2018-02-14 19:02:06','2018-02-14 19:02:06');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table visitor_date_user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `visitor_date_user`;

CREATE TABLE `visitor_date_user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `visitor_date_id` int(10) unsigned DEFAULT NULL,
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `local_id` int(10) unsigned NOT NULL DEFAULT '0',
  `visitors` int(10) unsigned DEFAULT NULL,
  `active` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `visitor_date_user` WRITE;
/*!40000 ALTER TABLE `visitor_date_user` DISABLE KEYS */;

INSERT INTO `visitor_date_user` (`id`, `visitor_date_id`, `user_id`, `local_id`, `visitors`, `active`, `created_at`, `updated_at`)
VALUES
	(1,1,2,0,1,0,'2018-02-21 15:31:56','2018-02-21 15:31:56'),
	(2,1,2,0,1,0,'2018-02-21 15:35:52','2018-02-21 15:35:52'),
	(3,1,2,0,1,0,'2018-02-21 15:36:36','2018-02-21 15:36:36'),
	(4,1,2,0,1,0,'2018-02-21 15:37:17','2018-02-21 15:37:17'),
	(5,1,3,0,1,0,'2018-02-21 15:37:24','2018-02-21 15:37:24'),
	(6,1,2,0,1,0,'2018-02-21 15:37:32','2018-02-21 15:37:32');

/*!40000 ALTER TABLE `visitor_date_user` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table visitor_dates
# ------------------------------------------------------------

DROP TABLE IF EXISTS `visitor_dates`;

CREATE TABLE `visitor_dates` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `visitor_dates` WRITE;
/*!40000 ALTER TABLE `visitor_dates` DISABLE KEYS */;

INSERT INTO `visitor_dates` (`id`, `date`, `created_at`, `updated_at`)
VALUES
	(1,'0000-00-00 00:00:00','2018-02-21 15:31:56','2018-02-21 15:31:56'),
	(2,'0000-00-00 00:00:00','2018-02-21 15:35:52','2018-02-21 15:35:52'),
	(3,'0000-00-00 00:00:00','2018-02-21 15:36:36','2018-02-21 15:36:36'),
	(4,'0000-00-00 00:00:00','2018-02-21 15:37:17','2018-02-21 15:37:17'),
	(5,'0000-00-00 00:00:00','2018-02-21 15:37:24','2018-02-21 15:37:24'),
	(6,'0000-00-00 00:00:00','2018-02-21 15:37:32','2018-02-21 15:37:32');

/*!40000 ALTER TABLE `visitor_dates` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
