-- MySQL dump 10.13  Distrib 5.7.31, for Linux (x86_64)
--
-- Host: localhost    Database: businessba
-- ------------------------------------------------------
-- Server version	5.7.31-0ubuntu0.18.04.1

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
-- Table structure for table `branch_historics`
--

DROP TABLE IF EXISTS `branch_historics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `branch_historics` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `branch_historics`
--

LOCK TABLES `branch_historics` WRITE;
/*!40000 ALTER TABLE `branch_historics` DISABLE KEYS */;
INSERT INTO `branch_historics` VALUES (7,15,3,'2020-05-13','2020-05-12 14:02:34','2020-05-12 14:08:28'),(8,16,3,'2020-05-25','2020-05-13 22:11:46','2020-05-13 22:11:46'),(9,18,3,'2020-05-25','2020-05-13 22:28:35','2020-05-13 22:28:35');
/*!40000 ALTER TABLE `branch_historics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `branches`
--

DROP TABLE IF EXISTS `branches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `branches` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `status` enum('active','inactive') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `branches`
--

LOCK TABLES `branches` WRITE;
/*!40000 ALTER TABLE `branches` DISABLE KEYS */;
INSERT INTO `branches` VALUES (3,'{\"ar\":\"\\u0627\\u0644\\u0642\\u0627\\u0647\\u0631\\u0629\",\"en\":\"cairo\"}','inactive','2020-05-12 11:17:09','2020-08-21 18:21:58'),(35,'{\"ar\":\"\\u0643\\u0648\\u0627\\u062a\\u0631\\u0648\",\"en\":\"Quatrro\"}','active','2020-08-21 18:21:32','2020-08-21 18:21:48');
/*!40000 ALTER TABLE `branches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cities`
--

DROP TABLE IF EXISTS `cities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cities` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_id` int(11) DEFAULT NULL,
  `latitude` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zoom` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL,
  `show_website` enum('show','hidden') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `soft_delete` enum('no','yes') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cities`
--

LOCK TABLES `cities` WRITE;
/*!40000 ALTER TABLE `cities` DISABLE KEYS */;
INSERT INTO `cities` VALUES (1,'{\"ar\":\"Cairo\",\"en\":\"Cairo\"}',1,'30.0444196','31.23571160000006','6','active','show','no','2017-08-03 23:20:27','2017-08-03 23:20:27'),(2,'{\"ar\":\"\\u0628\\u0631\\u0644\\u064a\\u0646\",\"en\":\"Berlin\"}',2,'52.52000659999999','13.404953999999975','8','active','show','no','2017-08-12 12:05:38','2020-04-25 12:20:26'),(9,'{\"ar\":\"الاسكندرية\",\"en\":\"alex\"}',1,'31.200178','29.918762','5','inactive','hidden','no','2017-08-21 07:49:18','2017-08-21 07:49:18'),(10,'{\"ar\":\"اسوان\",\"en\":\"aswan\"}',1,'24.088956','32.899876','0','inactive','hidden','no','2017-08-21 07:49:18','2017-08-21 07:49:18'),(11,'{\"ar\":\"\\u0645\\u0643\\u0629\",\"en\":\"maka\"}',NULL,NULL,NULL,NULL,'active',NULL,'no','2020-05-13 13:51:48','2020-05-13 13:51:48'),(12,'{\"ar\":\"\\u0627\\u0644\\u0645\\u0646\\u0648\\u0641\\u064a\\u06291\",\"en\":\"1almenofia\"}',NULL,NULL,NULL,NULL,'active',NULL,'no','2020-05-13 14:00:26','2020-05-14 08:37:31');
/*!40000 ALTER TABLE `cities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `currencies`
--

DROP TABLE IF EXISTS `currencies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `currencies` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `symbol` varchar(199) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `soft_delete` enum('no','yes') NOT NULL DEFAULT 'no',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `currencies_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `currencies`
--

LOCK TABLES `currencies` WRITE;
/*!40000 ALTER TABLE `currencies` DISABLE KEYS */;
INSERT INTO `currencies` VALUES (3,'doller','$','active','no','2020-05-12 19:53:26','2020-05-12 19:53:26'),(4,'يورو','يورو','active','no','2020-05-14 09:18:00','2020-05-14 09:18:00');
/*!40000 ALTER TABLE `currencies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer_types`
--

DROP TABLE IF EXISTS `customer_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `status` enum('active','inactive') NOT NULL,
  `soft_delete` enum('no','yes') NOT NULL DEFAULT 'no',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer_types`
--

LOCK TABLES `customer_types` WRITE;
/*!40000 ALTER TABLE `customer_types` DISABLE KEYS */;
INSERT INTO `customer_types` VALUES (3,'{\"ar\":\"\\u0639\\u0645\\u064a\\u0644 \\u0645\\u0647\\u0645\",\"en\":\"vip\"}','active','no','2020-05-12 16:01:27','2020-05-12 16:10:14');
/*!40000 ALTER TABLE `customer_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `code` varchar(191) NOT NULL,
  `type_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `mobile` varchar(191) DEFAULT NULL,
  `phone` varchar(191) DEFAULT NULL,
  `employee_id` varchar(191) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `soft_delete` enum('no','yes') NOT NULL DEFAULT 'no',
  `files` varchar(199) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `customers_name_unique` (`name`),
  UNIQUE KEY `customers_code_unique` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` VALUES (4,'{\"ar\":\"\\u0645\\u062d\\u0645\\u062f \\u0639\\u0644\\u064a\",\"en\":\"mohamed ali\"}','232',3,1,'00201099608016','3423433','15','active','no','customer/1761589325562.jpg','2020-05-12 18:56:37','2020-05-12 23:19:22');
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `depart__historics`
--

DROP TABLE IF EXISTS `depart__historics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `depart__historics` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `depart_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `status` enum('active','inactive') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `depart__historics`
--

LOCK TABLES `depart__historics` WRITE;
/*!40000 ALTER TABLE `depart__historics` DISABLE KEYS */;
INSERT INTO `depart__historics` VALUES (1,15,2,'2020-02-28','active','2020-05-12 12:58:57','2020-05-12 14:10:48'),(3,16,2,'2020-05-11','active','2020-05-13 22:12:19','2020-05-13 22:12:19'),(4,18,2,'2020-05-25','active','2020-05-13 22:28:35','2020-05-13 22:28:35');
/*!40000 ALTER TABLE `depart__historics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `departments`
--

DROP TABLE IF EXISTS `departments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `departments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `status` enum('active','inactive') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departments`
--

LOCK TABLES `departments` WRITE;
/*!40000 ALTER TABLE `departments` DISABLE KEYS */;
INSERT INTO `departments` VALUES (2,'{\"ar\":\"\\u0627\\u062e\\u062a\\u0628\\u0627\\u0631\",\"en\":\"test\"}','active','2020-05-12 11:21:46','2020-05-12 11:21:46'),(46,'{\"ar\":\"\\u0642\\u0633\\u0645 \\u0627\\u0644\\u0627\\u0646\\u062a\\u0627\\u062c\",\"en\":\"production\"}','active','2020-05-13 14:31:50','2020-05-13 14:31:50');
/*!40000 ALTER TABLE `departments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employees` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `code` varchar(191) DEFAULT NULL,
  `email` varchar(191) DEFAULT NULL,
  `work_mobile` varchar(191) DEFAULT NULL,
  `personal_mobile` varchar(191) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `branch_id` int(11) NOT NULL,
  `address` varchar(191) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `depart_id` int(11) DEFAULT NULL,
  `postion_id` int(11) DEFAULT NULL,
  `notes` text,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `files` varchar(199) DEFAULT NULL,
  `salary_files` text,
  `soft_delete` enum('no','yes') NOT NULL DEFAULT 'no',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employees`
--

LOCK TABLES `employees` WRITE;
/*!40000 ALTER TABLE `employees` DISABLE KEYS */;
INSERT INTO `employees` VALUES (15,'{\"ar\":\"\\u0645\\u062d\\u0645\\u062f \\u0627\\u062d\\u0645\\u062f\",\"en\":\"mohamed ahmed\"}','242','m@gmail.com','2141214','2412424','2020-05-22','2020-05-12','2020-05-20',3,'لا يوجد',1,2,2,'لا يوجد','active','employees/97271589295615.jpg',NULL,'yes','2020-05-12 12:58:57','2020-05-13 14:16:47'),(16,'{\"ar\":\"Arabic empl\",\"en\":\"emp\"}',NULL,NULL,NULL,NULL,NULL,'2020-05-11',NULL,3,NULL,2,2,NULL,NULL,'active','employees/55211589382443.pdf|employees/18321589382443.pdf|employees/96541589382298.png|employees/46191589382298.png|employees/30201589382298.png',NULL,'no','2020-05-13 22:04:58','2020-09-30 13:21:29'),(18,'{\"ar\":\"\\u0627\\u062e\\u062a\\u0628\\u0627\\u0631\",\"en\":\"test\"}','32423432','m@gmail.com','3423423','01273626323','2020-05-28','2020-05-20','2020-05-19',3,'لا يوجد',1,2,2,NULL,'active','employees/69701589383715.jpg',NULL,'no','2020-05-13 22:28:35','2020-05-13 22:28:35');
/*!40000 ALTER TABLE `employees` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoice__logs`
--

DROP TABLE IF EXISTS `invoice__logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `invoice__logs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `type` varchar(99) DEFAULT NULL,
  `action` varchar(191) NOT NULL,
  `old_value` varchar(191) DEFAULT NULL,
  `new_value` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoice__logs`
--

LOCK TABLES `invoice__logs` WRITE;
/*!40000 ALTER TABLE `invoice__logs` DISABLE KEYS */;
INSERT INTO `invoice__logs` VALUES (1,1,3,'payment','add',NULL,'45','2020-05-13 13:30:29','2020-05-13 13:30:29'),(2,1,3,'payment','add',NULL,'50','2020-10-14 08:54:59','2020-10-14 08:54:59');
/*!40000 ALTER TABLE `invoice__logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoice_types`
--

DROP TABLE IF EXISTS `invoice_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `invoice_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `soft_delete` enum('no','yes') NOT NULL DEFAULT 'no',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `invoice_types_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoice_types`
--

LOCK TABLES `invoice_types` WRITE;
/*!40000 ALTER TABLE `invoice_types` DISABLE KEYS */;
INSERT INTO `invoice_types` VALUES (3,'{\"ar\":\"\\u0646\\u0648\\u0639 \\u0641\\u0627\\u062a\\u0648\\u0631\\u0629 \\u0627\\u0648\\u0644\",\"en\":\"type voice\"}','active','no','2020-05-12 19:38:31','2020-05-12 19:38:31');
/*!40000 ALTER TABLE `invoice_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoices`
--

DROP TABLE IF EXISTS `invoices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `invoices` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `invoice_number` varchar(191) NOT NULL,
  `date` date NOT NULL,
  `customer_id` int(11) NOT NULL,
  `amount` double NOT NULL,
  `invoice_type` int(11) NOT NULL,
  `currency_id` int(11) NOT NULL,
  `representor_id` int(11) NOT NULL,
  `notes` text,
  `softing_delete` enum('no','yes') NOT NULL DEFAULT 'no',
  `files` varchar(199) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `invoices_invoice_number_unique` (`invoice_number`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoices`
--

LOCK TABLES `invoices` WRITE;
/*!40000 ALTER TABLE `invoices` DISABLE KEYS */;
INSERT INTO `invoices` VALUES (3,'32341','2020-05-27',4,567,3,3,3,NULL,'no','invoices/84821589323825.jpg','2020-05-12 22:50:25','2020-05-14 05:22:12');
/*!40000 ALTER TABLE `invoices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `logs`
--

DROP TABLE IF EXISTS `logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `logs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `action` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `table` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `route` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `record_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logs`
--

LOCK TABLES `logs` WRITE;
/*!40000 ALTER TABLE `logs` DISABLE KEYS */;
INSERT INTO `logs` VALUES (86,'{\"ar\":\"تم اضافة بيان جديد => 1\",\"en\":\"Added Record . 1\"}','users','{\"ar\":\"المستخدمين\",\"en\":\"Users\"}','edit','log.add_record | orbscope.users |  log.record_number  | 1','1',NULL,'2020-09-21 18:08:18','2020-09-21 18:08:18'),(87,'{\"ar\":\"تم تعديل البيان => Arabic empl\",\"en\":\"Updated Record No. emp\"}','agents','{\"ar\":\"الموظفين\",\"en\":\"Agents\"}','edit','log.add_record | orbscope.agents |  log.record_number  | 16','1',NULL,'2020-09-30 13:21:29','2020-09-30 13:21:29'),(88,'{\"ar\":\"تم اضافة بيان جديد => \",\"en\":\"Added Record . \"}','payment','{\"ar\":\"الدفعات\",\"en\":\"Payments\"}','add','log.add_record | orbscope.payments |  log.record_number  | ','1',NULL,'2020-10-14 08:54:58','2020-10-14 08:54:58');
/*!40000 ALTER TABLE `logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2016_03_01_193027_create_sent_emails_table',1),(4,'2016_09_07_193027_create_sent_emails_Url_Clicked_table',1),(5,'2016_11_10_213551_add-message-id-to-sent-emails-table',1),(6,'2017_06_17_150444_create_settings_table',1),(7,'2017_06_21_171534_create_countries_table',1),(8,'2017_06_24_022538_create_files_table',1),(9,'2017_06_30_061530_create_logs_table',1),(10,'2017_07_01_031736_create_unit_types_table',1),(11,'2017_07_01_050322_create_agent_types_table',1),(12,'2017_07_03_023146_create_cities_table',1),(13,'2017_07_03_182013_create_states_table',1),(14,'2017_10_01_031030_create_contacts_table',1),(15,'2017_10_02_033511_create_permission_tables',1),(16,'2017_10_08_203530_create_contact_uses_table',1),(17,'2017_10_10_184930_create_pages_table',1),(18,'2019_02_17_120325_create_companies_table',1),(19,'2019_02_17_164743_create_products_table',1),(20,'2019_03_05_141156_create_delegates_table',1),(21,'2019_03_05_141518_create_delegate__companys_table',1),(22,'2019_03_14_121020_create_orders_table',2),(23,'2019_03_15_160319_create_order__items_table',3),(24,'2017_07_01_041239_create_industries_table',4),(25,'2017_07_01_042123_create_complain_types_table',4),(26,'2017_07_05_132709_create_groups_table',4),(27,'2017_08_07_023855_create_leads_table',4),(28,'2017_08_13_051730_create_orders_table',4),(29,'2018_01_17_115805_create_publish_houses_table',4),(30,'2018_01_17_234701_create_order_items_table',4),(31,'2018_03_19_192949_create_schools_table',4),(32,'2018_03_19_221559_create_guides_table',4),(33,'2019_10_27_191417_create_free_lancers_table',4),(34,'2019_10_29_231328_create_tags_table',5),(35,'2019_10_29_235201_create_lancer_tags_table',5),(36,'2019_10_30_000350_create_lancer_subs_table',6),(37,'2019_11_09_135224_create_types_table',7),(38,'2019_11_10_003508_create_members_table',8),(39,'2020_04_23_170409_create_branches_table',9),(40,'2020_04_23_172150_create_departments_table',10),(41,'2020_04_23_192643_create_positions_table',11),(42,'2020_04_24_173919_create_employees_table',12),(43,'2020_04_29_141814_create_salaries_table',13),(44,'2020_04_29_142225_create_subtracts_table',14),(45,'2020_05_02_202805_create_customer_types_table',15),(46,'2020_05_05_160235_create_branch_historics_table',16),(47,'2020_05_05_160252_create_depart_historics_table',16),(48,'2020_05_07_150125_create_customers_table',16),(49,'2020_05_07_173833_create_invoice_types_table',16),(50,'2020_05_07_182607_create_currencies_table',16),(51,'2020_05_08_152550_create_represent_lists_table',16),(52,'2020_05_08_203608_create_representor__details_table',16),(53,'2020_05_09_135142_create_invoices_table',16),(54,'2020_05_09_162724_create_payments_table',16),(55,'2020_05_12_141959_create_position__historics_table',17),(56,'2020_05_12_151439_create_vacations_table',18),(57,'2020_05_12_161810_create_stays_table',19),(58,'2020_05_13_150400_create_invoice__logs_table',20);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `model_has_permissions` (
  `permission_id` int(10) unsigned NOT NULL,
  `model_id` int(10) unsigned NOT NULL,
  `model_type` varchar(191) NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_permissions`
--

LOCK TABLES `model_has_permissions` WRITE;
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `model_has_roles` (
  `role_id` int(10) unsigned NOT NULL,
  `model_id` int(10) unsigned NOT NULL,
  `model_type` varchar(191) NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_roles`
--

LOCK TABLES `model_has_roles` WRITE;
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` VALUES (1,1,'App\\User'),(5,3,'App\\User'),(2,11,'App\\User'),(2,12,'App\\User'),(3,12,'App\\User'),(2,13,'App\\User'),(3,13,'App\\User'),(3,14,'App\\User'),(7,18,'App\\User'),(5,20,'App\\User'),(10,22,'App\\User'),(9,23,'App\\User'),(3,24,'App\\User'),(5,24,'App\\User'),(11,25,'App\\User'),(11,26,'App\\User'),(11,27,'App\\User'),(1,28,'App\\User');
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notifications` (
  `id` char(36) NOT NULL,
  `type` varchar(191) NOT NULL,
  `notifiable_id` int(10) unsigned NOT NULL,
  `notifiable_type` varchar(191) NOT NULL,
  `data` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_notifiable_id_notifiable_type_index` (`notifiable_id`,`notifiable_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
INSERT INTO `notifications` VALUES ('04b35b06-3f7a-4cae-8237-b24db1183a11','App\\Notifications\\MessageNotification',1,'App\\User','{\"id\":9,\"name\":\"ahmed\",\"date\":\"2018-09-23\",\"type\":\"message\"}',NULL,'2018-09-23 12:31:13','2018-09-23 12:31:13'),('9eb903eb-0509-4cd4-b48c-7b5b1c693aa4','App\\Notifications\\SchoolNotification',1,'App\\User','{\"id\":15,\"name\":\"\\u0627\\u0644\\u062b\\u0627\\u0646\\u0648\\u064a\\u0629 \\u0627\\u0644\\u0639\\u0633\\u0643\\u0631\\u064a\\u0629\",\"date\":\"2018-09-23\",\"type\":\"school\"}',NULL,'2018-09-23 12:33:24','2018-09-23 12:33:24');
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
INSERT INTO `password_resets` VALUES ('dev.mohamedreda@gmail.com','$2y$10$eOCt08hlSQa.xow6F0.iL.5ni7TUVP7EuHdWD7nPKXK4.wgdQUfU2','2017-09-30 18:09:32'),('dev.mohamedreda@gmail.com','$2y$10$eOCt08hlSQa.xow6F0.iL.5ni7TUVP7EuHdWD7nPKXK4.wgdQUfU2','2017-09-30 18:09:32');
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `amount` double NOT NULL,
  `RV` varchar(191) NOT NULL,
  `due_date` date NOT NULL,
  `receive_date` date NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payments`
--

LOCK TABLES `payments` WRITE;
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
INSERT INTO `payments` VALUES (1,100,'2334','2020-04-29','2020-04-30',1,'2020-05-10 11:39:13','2020-05-10 11:39:13'),(2,232,'2334','2020-05-06','2020-05-11',2,'2020-05-12 21:42:26','2020-05-12 21:42:26'),(3,34,'232','2020-04-26','2020-05-03',3,'2020-05-13 12:56:11','2020-05-13 12:56:11'),(4,451,'2334','2020-05-10','2020-05-25',3,'2020-05-13 13:30:29','2020-05-14 08:55:21'),(5,50,'122','2020-10-05','2020-10-05',3,'2020-10-14 08:54:59','2020-10-14 08:54:59');
/*!40000 ALTER TABLE `payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `guard_name` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=209 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (120,'Add Agents','web','2017-10-02 05:31:11','2017-10-03 00:09:41'),(121,'Edit Agents','web','2017-10-02 05:31:18','2017-10-03 00:09:46'),(122,'Show Agents','web','2017-10-02 05:32:18','2017-10-03 00:09:49'),(123,'Delete Agents','web','2017-10-02 05:32:24','2017-10-03 00:09:44'),(141,'Logs','web','2017-10-02 05:37:56','2017-10-02 05:37:56'),(150,'Add Roles','web','2017-10-03 02:49:02','2017-10-03 02:49:02'),(151,'Edit Roles','web','2017-10-03 02:49:11','2017-10-03 02:49:11'),(152,'Show Roles','web','2017-10-03 02:49:21','2017-10-03 02:49:21'),(153,'Delete Roles','web','2017-10-03 02:49:29','2017-10-03 02:49:29'),(154,'Log','web','2017-10-03 04:41:38','2017-10-03 04:41:38'),(155,'Settings','web','2017-10-03 04:42:32','2017-10-03 04:42:32'),(162,'Add Branches','web','2020-04-23 15:09:11','2020-04-23 15:09:11'),(163,'Edit Branches','web','2020-04-23 15:09:22','2020-04-23 15:09:22'),(164,'Show Branches','web','2020-04-23 15:09:31','2020-04-23 15:09:31'),(165,'Delete Branches','web','2020-04-23 15:09:44','2020-04-23 15:09:44'),(166,'Add Department','web','2020-04-23 15:25:19','2020-04-23 15:25:19'),(167,'Edit Department','web','2020-04-23 15:25:25','2020-04-23 15:25:25'),(168,'Show Department','web','2020-04-23 15:25:32','2020-04-23 15:25:32'),(169,'Delete Department','web','2020-04-23 15:25:42','2020-04-23 15:25:42'),(170,'Edit Position','web','2020-04-23 17:33:56','2020-04-23 17:33:56'),(171,'Add Position','web','2020-04-23 17:34:03','2020-04-23 17:34:03'),(172,'Show Position','web','2020-04-23 17:34:11','2020-04-23 17:34:11'),(173,'Delete Position','web','2020-04-23 17:34:18','2020-04-23 17:34:18'),(174,'Add Cities','web','2020-04-24 15:52:54','2020-04-24 15:52:54'),(175,'Edit Cities','web','2020-04-24 15:53:03','2020-04-24 15:53:03'),(176,'Show Cities','web','2020-04-24 15:53:09','2020-04-24 15:53:09'),(177,'Delete Cities','web','2020-04-24 15:53:17','2020-04-24 15:53:17'),(178,'Add Users','web','2020-04-25 12:47:44','2020-04-25 12:47:44'),(179,'Edit Users','web','2020-04-25 12:47:56','2020-04-25 12:47:56'),(180,'Show Users','web','2020-04-25 12:48:06','2020-04-25 12:48:06'),(181,'Show Salary','web','2020-04-29 12:14:52','2020-04-29 12:14:52'),(182,'Edit Salary','web','2020-04-29 12:15:25','2020-04-29 12:15:25'),(183,'Add Salary','web','2020-04-29 12:15:46','2020-04-29 12:15:46'),(184,'Delete CystomerType','web','2020-05-02 18:31:58','2020-05-02 18:31:58'),(185,'Show CystomerType','web','2020-05-02 18:32:06','2020-05-02 18:32:06'),(186,'Edit CystomerType','web','2020-05-02 18:32:14','2020-05-02 18:32:14'),(187,'Add CystomerType','web','2020-05-02 18:32:23','2020-05-02 18:32:23'),(188,'Add Invoice','web','2020-05-10 12:36:51','2020-05-10 12:36:51'),(189,'Edit Invoice','web','2020-05-10 12:36:59','2020-05-10 12:36:59'),(190,'Show Invoice','web','2020-05-10 12:37:06','2020-05-10 12:37:06'),(191,'Delete Invoice','web','2020-05-10 12:37:13','2020-05-10 12:37:13'),(192,'Add Currencies','web','2020-05-10 12:37:24','2020-05-10 12:37:24'),(193,'Edit Currencies','web','2020-05-10 12:37:30','2020-05-10 12:37:30'),(194,'Show Currencies','web','2020-05-10 12:37:40','2020-05-10 12:37:40'),(195,'Delete Currencies','web','2020-05-10 12:37:47','2020-05-10 12:37:47'),(196,'Add Customer','web','2020-05-10 12:38:41','2020-05-10 12:38:41'),(197,'Edit Customer','web','2020-05-10 12:38:54','2020-05-10 12:38:54'),(198,'Show Customer','web','2020-05-10 12:39:02','2020-05-10 12:39:02'),(199,'Delete Customer','web','2020-05-10 12:39:10','2020-05-10 12:39:10'),(200,'Add Representor_list','web','2020-05-10 12:39:20','2020-05-10 12:39:20'),(201,'Edit Representor_list','web','2020-05-10 12:39:28','2020-05-10 12:39:28'),(202,'Show Representor_list','web','2020-05-10 12:39:37','2020-05-10 12:39:37'),(203,'Delete Representor_list','web','2020-05-10 12:39:44','2020-05-10 12:39:44'),(204,'Add InvoiceType','web','2020-05-10 12:39:55','2020-05-10 12:39:55'),(205,'Edit InvoiceType','web','2020-05-10 12:40:02','2020-05-10 12:40:02'),(206,'Show InvoiceType','web','2020-05-10 12:40:11','2020-05-10 12:40:11'),(207,'Delete InvoiceType','web','2020-05-10 12:40:20','2020-05-10 12:40:20'),(208,'Show Representor_Details','web','2020-05-10 12:40:58','2020-05-10 12:40:58');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `positions`
--

DROP TABLE IF EXISTS `positions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `positions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `status` enum('active','inactive') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `positions`
--

LOCK TABLES `positions` WRITE;
/*!40000 ALTER TABLE `positions` DISABLE KEYS */;
INSERT INTO `positions` VALUES (2,'{\"ar\":\"\\u0645\\u0633\\u0627\\u0639\\u062f\",\"en\":\"assicstant\"}','active','2020-05-12 11:26:56','2020-05-12 11:26:56');
/*!40000 ALTER TABLE `positions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `postion_historics`
--

DROP TABLE IF EXISTS `postion_historics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `postion_historics` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `position_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `status` enum('active','inactive') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `postion_historics`
--

LOCK TABLES `postion_historics` WRITE;
/*!40000 ALTER TABLE `postion_historics` DISABLE KEYS */;
INSERT INTO `postion_historics` VALUES (3,14,2,'2020-05-19','active','2020-05-12 12:58:04','2020-05-12 12:58:04'),(4,15,2,'2020-05-13','active','2020-05-12 12:58:57','2020-05-12 14:08:45'),(5,18,2,'2020-05-19','active','2020-05-13 22:28:35','2020-05-13 22:28:35'),(6,16,2,'2020-05-28','active','2020-05-14 03:24:43','2020-05-14 03:24:43');
/*!40000 ALTER TABLE `postion_historics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `represent_lists`
--

DROP TABLE IF EXISTS `represent_lists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `represent_lists` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `soft_delete` enum('no','yes') NOT NULL DEFAULT 'no',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `represent_lists_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `represent_lists`
--

LOCK TABLES `represent_lists` WRITE;
/*!40000 ALTER TABLE `represent_lists` DISABLE KEYS */;
INSERT INTO `represent_lists` VALUES (3,'{\"ar\":\"\\u0627\\u0644\\u0642\\u0627\\u0626\\u0645\\u0629 \\u0627\\u0644\\u0627\\u0648\\u0644\\u064a\",\"en\":\"first list\"}','active','no','2020-05-12 19:09:49','2020-05-12 19:09:49');
/*!40000 ALTER TABLE `represent_lists` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `representor__details`
--

DROP TABLE IF EXISTS `representor__details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `representor__details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `street` varchar(191) DEFAULT NULL,
  `represent_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `sales_percent` double DEFAULT NULL,
  `service_percent` double DEFAULT NULL,
  `spare_part_percent` double DEFAULT NULL,
  `team_leader` tinyint(1) DEFAULT NULL,
  `manager_leader` tinyint(1) DEFAULT NULL,
  `soft_delete` enum('no','yes') NOT NULL DEFAULT 'no',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `representor__details`
--

LOCK TABLES `representor__details` WRITE;
/*!40000 ALTER TABLE `representor__details` DISABLE KEYS */;
INSERT INTO `representor__details` VALUES (1,NULL,1,7,0.66,0,0,1,NULL,'no','2020-05-10 12:42:58','2020-05-10 12:42:58'),(2,NULL,3,15,55.6,4.5,3.3,1,NULL,'no','2020-05-12 19:14:27','2020-05-12 19:14:27');
/*!40000 ALTER TABLE `representor__details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_has_permissions` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_has_permissions`
--

LOCK TABLES `role_has_permissions` WRITE;
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
INSERT INTO `role_has_permissions` VALUES (7,1),(8,1),(9,1),(10,1),(11,1),(12,1),(13,1),(14,1),(19,1),(20,1),(21,1),(22,1),(23,1),(24,1),(25,1),(26,1),(96,1),(97,1),(98,1),(99,1),(108,1),(109,1),(110,1),(111,1),(120,1),(121,1),(122,1),(123,1),(124,1),(125,1),(126,1),(127,1),(128,1),(129,1),(130,1),(136,1),(137,1),(138,1),(139,1),(141,1),(142,1),(143,1),(144,1),(145,1),(147,1),(148,1),(149,1),(150,1),(151,1),(152,1),(153,1),(154,1),(155,1),(156,1),(157,1),(160,1),(162,1),(163,1),(164,1),(165,1),(166,1),(167,1),(168,1),(169,1),(170,1),(171,1),(172,1),(173,1),(174,1),(175,1),(176,1),(177,1),(178,1),(179,1),(180,1),(181,1),(182,1),(183,1),(184,1),(185,1),(186,1),(187,1),(188,1),(189,1),(190,1),(191,1),(192,1),(193,1),(194,1),(195,1),(196,1),(197,1),(198,1),(199,1),(200,1),(201,1),(202,1),(203,1),(204,1),(205,1),(206,1),(207,1),(208,1),(157,3),(161,5),(159,7),(160,9),(163,11),(164,11),(165,11),(166,11),(167,11),(168,11),(169,11),(170,11),(171,11),(172,11),(173,11),(185,12),(186,12),(187,12),(188,12),(189,12),(192,12),(194,12),(196,12),(197,12),(198,12),(199,12),(200,12),(201,12),(202,12),(203,12),(204,12),(205,12),(206,12),(207,12),(208,12);
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `guard_name` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Admin','web','2017-10-03 00:26:29','2017-10-03 00:26:29'),(11,'DB-HR','web','2020-04-25 12:44:33','2020-04-25 12:44:33'),(12,'Accountant','web','2020-05-10 12:36:30','2020-05-10 12:36:30');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `salaries`
--

DROP TABLE IF EXISTS `salaries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `salaries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `salary` double NOT NULL,
  `id_office` varchar(191) NOT NULL,
  `sub_id` int(11) DEFAULT NULL,
  `note` text,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `salaries`
--

LOCK TABLES `salaries` WRITE;
/*!40000 ALTER TABLE `salaries` DISABLE KEYS */;
INSERT INTO `salaries` VALUES (1,7,'2019-07-17',2500,'3342',NULL,'لا يوجد','active','2020-04-29 18:58:28','2020-05-03 05:31:10'),(2,7,'2020-04-16',3000,'3342',NULL,NULL,'active','2020-04-30 13:12:09','2020-04-30 13:12:09'),(3,7,'2020-05-26',100,'123',NULL,'test','active','2020-05-03 05:30:47','2020-05-03 05:30:47'),(4,12,'2020-05-04',3000,'2342',NULL,NULL,'active','2020-05-10 18:03:53','2020-05-10 18:03:53'),(5,7,'2020-05-31',3000,'2342',NULL,NULL,'active','2020-05-10 18:04:40','2020-05-10 18:04:40'),(6,16,'2020-05-06',100,'5468',NULL,'ىخ','active','2020-05-13 22:12:58','2020-05-13 22:12:58');
/*!40000 ALTER TABLE `salaries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sent_emails`
--

DROP TABLE IF EXISTS `sent_emails`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sent_emails` (
  `id` int(10) unsigned NOT NULL,
  `hash` char(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` text COLLATE utf8mb4_unicode_ci,
  `sender` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `recipient` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `opens` int(11) DEFAULT NULL,
  `clicks` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `message_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sent_emails_hash_unique` (`hash`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sent_emails`
--

LOCK TABLES `sent_emails` WRITE;
/*!40000 ALTER TABLE `sent_emails` DISABLE KEYS */;
/*!40000 ALTER TABLE `sent_emails` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sent_emails_url_clicked`
--

DROP TABLE IF EXISTS `sent_emails_url_clicked`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sent_emails_url_clicked` (
  `id` int(10) unsigned NOT NULL,
  `sent_email_id` int(10) unsigned NOT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hash` char(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `clicks` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sent_emails_url_clicked_sent_email_id_foreign` (`sent_email_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sent_emails_url_clicked`
--

LOCK TABLES `sent_emails_url_clicked` WRITE;
/*!40000 ALTER TABLE `sent_emails_url_clicked` DISABLE KEYS */;
/*!40000 ALTER TABLE `sent_emails_url_clicked` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `login_color` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keywords` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci,
  `address` text COLLATE utf8mb4_unicode_ci,
  `admin_path` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin_theme` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website_theme` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `language` enum('en','ar') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `enable_watermark` enum('yes','no') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `watermark_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `watermark_position` enum('top-left','top','top-right','left','center','right','bottom-left','bottom','bottom-right') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `watermark_offset` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `multi_lang` enum('yes','no') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website_status` enum('open','closed') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `allow_admin_theme` enum('yes','no') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `allow_website_theme` enum('yes','no') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `close_message` longtext COLLATE utf8mb4_unicode_ci,
  `allow_register` enum('yes','no') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `session_timeout` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about_title` text COLLATE utf8mb4_unicode_ci,
  `contact_title` text COLLATE utf8mb4_unicode_ci,
  `address_lang` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_lat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zoom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `form_desc` text COLLATE utf8mb4_unicode_ci,
  `slider` varchar(199) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `copy_right` varchar(199) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Alweseemy',
  `slider_2` varchar(199) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `homepageTitle` text COLLATE utf8mb4_unicode_ci,
  `homesliderDesc` text COLLATE utf8mb4_unicode_ci,
  `homepageTitle_2` text COLLATE utf8mb4_unicode_ci,
  `homesliderDesc_2` text COLLATE utf8mb4_unicode_ci,
  `homepageImage` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `googleplus` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `footer_desc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,'{\"ar\":\"بلو أرو\",\"en\":\"Blue Arrow\"}','info@b-arrow.com','96897890223','+964',NULL,'#1062e5','images/21331598037442.png','images/681598036773.png','{\"ar\":\"هذا اختبار هذا اختبار هذا اختبار\",\"en\":null}','{\"ar\":null,\"en\":null}','{\"ar\":\"Erbil\",\"en\":\"Iraq\"}','admin','layout1','layout1','en','yes','/orbscope/logo.png','bottom-left','10','yes','open','yes','no','bn','yes','2800','images/58381507567271.jpg','images/43011507567228.jpg','{\"ar\":\"ما هو \\\"لوريم إيبسوم\\\" ؟\",\"en\":\"What is Lorem Ipsum?\"}','{\"ar\":null,\"en\":null}',NULL,NULL,NULL,'{\"ar\":null,\"en\":null}','images/9121569536925.jpg','Blue Arrow','images/24201569538776.jpg','{\"ar\":null,\"en\":null}','{\"ar\":null,\"en\":null}','{\"ar\":null,\"en\":null}','{\"ar\":null,\"en\":null}','images/9101507567167.jpg','https://www.facebook.com/','https://www.facebook.com/','https://www.facebook.com','https://www.facebook.com/','{\"ar\":null,\"en\":null}','2017-06-17 19:41:22','2020-08-21 18:17:22');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stays`
--

DROP TABLE IF EXISTS `stays`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stays` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `return` double NOT NULL,
  `stay` double NOT NULL,
  `date` date NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stays`
--

LOCK TABLES `stays` WRITE;
/*!40000 ALTER TABLE `stays` DISABLE KEYS */;
INSERT INTO `stays` VALUES (1,15,45.7,345.7,'2020-05-10','active','2020-05-12 14:34:45','2020-05-12 14:39:59'),(2,16,1000,2000,'2020-05-25','active','2020-05-14 03:25:27','2020-05-14 03:25:27');
/*!40000 ALTER TABLE `stays` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subtracts`
--

DROP TABLE IF EXISTS `subtracts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subtracts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `date` date NOT NULL,
  `amount` double NOT NULL,
  `note` text,
  `type` enum('sub','reward') NOT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subtracts`
--

LOCK TABLES `subtracts` WRITE;
/*!40000 ALTER TABLE `subtracts` DISABLE KEYS */;
INSERT INTO `subtracts` VALUES (1,7,'خصم يوم','2020-05-01',100,'لا يوجد','sub','active','2020-04-30 14:30:57','2020-05-01 12:12:32'),(2,7,'حافز اداء','2020-04-08',100,'لا يوجد','reward','active','2020-05-01 12:00:27','2020-05-01 12:00:27');
/*!40000 ALTER TABLE `subtracts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(225) CHARACTER SET utf8 DEFAULT NULL,
  `lang` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `admin_theme` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('inactive','active') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(99) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `inactive_date` date DEFAULT NULL,
  `active_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'عمر','+212676479581','$2y$10$Bettuen2U.iZJQK2s0I4L.J9d.rT1XTHhfrk7oU0okCZdE.75IDoy',NULL,'ar',NULL,'layout1','active','PA97zXIwKJ3P89vasfbMEgy1j6JwNxpl1g6aMxIddXMx6tKDf9yZvywgu0Zh','admin',NULL,NULL,'2017-06-17 19:41:22','2020-10-14 08:59:30'),(25,'hr user','hr@gmail.com','$2y$10$SooRrIDxbk82YaDou18DSu9Am/hBS8PHHk..W4/qzw0aHIM2MMx9u',NULL,NULL,NULL,NULL,'inactive','EvEI56WfDDeK8qrrMToGRU09MX5uA9tKL5E18V8STuWvRNjunxYEpuQ5oQov','agent','2020-08-22',NULL,'2020-04-25 13:32:15','2020-08-21 21:11:42'),(27,'gwerger','alisa@gmail.com','$2y$10$oLuVLo05KlYBUNlr7zOGzebIUnDWk4hjMTDQYYRwLGyfibT0fJ9XW',NULL,NULL,16,NULL,'inactive',NULL,'agent',NULL,NULL,'2020-04-26 15:22:20','2020-05-15 15:07:49'),(28,'Omar','omar@gmail.com','$2y$10$tnu0NEi.vHenvM27CxCEh.2pxy2.Basi8ASjqQc16/k/9hpEqKBba',NULL,NULL,NULL,NULL,'inactive',NULL,'agent','2020-05-15',NULL,'2020-05-03 05:17:11','2020-05-15 14:56:53');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vacations`
--

DROP TABLE IF EXISTS `vacations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vacations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `totla_hours` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vacations`
--

LOCK TABLES `vacations` WRITE;
/*!40000 ALTER TABLE `vacations` DISABLE KEYS */;
INSERT INTO `vacations` VALUES (1,15,47,'2020-05-17','2020-05-19','active','2020-05-12 13:50:50','2020-05-12 14:01:41'),(2,16,34,'2020-05-12','2020-05-19','active','2020-05-14 04:59:09','2020-05-14 04:59:09');
/*!40000 ALTER TABLE `vacations` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-10-14 14:08:15
