-- MySQL dump 10.13  Distrib 9.0.1, for macos14.4 (arm64)
--
-- Host: localhost    Database: tenant
-- ------------------------------------------------------
-- Server version	9.0.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `addresses`
--

DROP TABLE IF EXISTS `addresses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `addresses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `dealer_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `addresses`
--

LOCK TABLES `addresses` WRITE;
/*!40000 ALTER TABLE `addresses` DISABLE KEYS */;
/*!40000 ALTER TABLE `addresses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
INSERT INTO `cache` VALUES ('livewire-rate-limiter:a17961fa74e9275d529f489537f179c05d50c2f3','i:1;',1740055493),('livewire-rate-limiter:a17961fa74e9275d529f489537f179c05d50c2f3:timer','i:1740055493;',1740055493),('livewire-rate-limiter:c249f2149727eeb79f1792b01e586e68c4ec6608','i:1;',1739911573),('livewire-rate-limiter:c249f2149727eeb79f1792b01e586e68c4ec6608:timer','i:1739911573;',1739911573);
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer_issues`
--

DROP TABLE IF EXISTS `customer_issues`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customer_issues` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `dealer_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer_issues`
--

LOCK TABLES `customer_issues` WRITE;
/*!40000 ALTER TABLE `customer_issues` DISABLE KEYS */;
/*!40000 ALTER TABLE `customer_issues` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zip_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dealer_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` VALUES (1,'Tim Taylor','98034 Josiane Mission Apt. 620','Apt. 586','Rathton','OK','719-608-5552','27265',2,'2025-02-06 02:18:05','2025-02-06 02:18:05'),(2,'William Shatner\'s Gun Shop','378 Veum Summit','Suite 735','Winston-Salem','SC','(650) 417-1328','65214',1,'2025-02-06 02:18:05','2025-02-18 20:37:01'),(3,'Leonard Nimoy','3919 Johnathan Crossroad',NULL,'Wilmington','MS','(919) 192-4158','32551',1,'2025-02-06 02:18:05','2025-02-19 20:07:55'),(4,'Jerry Stiller','52817 Thelma Shore','Apt. 383','Dearborn','MI','(757) 469-4655','97210',1,'2025-02-06 02:18:05','2025-02-18 20:34:58'),(5,'Tim Allen','988 Rosalyn Dam Apt. 343','Apt. 462','Davontetown','ND','(315) 851-2975','75422',3,'2025-02-06 02:18:05','2025-02-19 02:02:44'),(6,'Jerry Seinfeld','891 McClure Lane','Apt. 558','Leeside','CO','(919) 434-2447','27263',1,'2025-02-06 02:18:05','2025-02-18 20:37:12'),(7,'David Frazier','67970 Glenda Glen','Suite 932','Randleman','NC','(541) 679-1817','27409',1,'2025-02-06 02:18:05','2025-02-18 20:36:50'),(8,'Larry Hagman','9479 Hamill Forest','Suite 809','Cocoa Beach','FL','(361) 334-4898','67422',1,'2025-02-06 02:18:05','2025-02-18 20:37:21'),(9,'Kevin James','7511 Altenwerth Unions Rd','Suite 529','Brooklyn','NY','(281) 412-2465','31352',1,'2025-02-06 02:18:05','2025-02-18 20:36:00'),(10,'Doug Heffernan','63125 Merle Extension Suite 796','Suite 894','Marvinchester','KY','(685) 660-1144','27260',3,'2025-02-06 02:18:05','2025-02-19 02:02:38');
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dealer_user`
--

DROP TABLE IF EXISTS `dealer_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dealer_user` (
  `dealer_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  KEY `dealer_user_dealer_id_foreign` (`dealer_id`),
  KEY `dealer_user_user_id_foreign` (`user_id`),
  CONSTRAINT `dealer_user_dealer_id_foreign` FOREIGN KEY (`dealer_id`) REFERENCES `dealers` (`id`),
  CONSTRAINT `dealer_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dealer_user`
--

LOCK TABLES `dealer_user` WRITE;
/*!40000 ALTER TABLE `dealer_user` DISABLE KEYS */;
INSERT INTO `dealer_user` VALUES (1,1),(3,3);
/*!40000 ALTER TABLE `dealer_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dealers`
--

DROP TABLE IF EXISTS `dealers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dealers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zip_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `terms` text COLLATE utf8mb4_unicode_ci,
  `ship_via` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ups_zone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `credit_limit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `credit_hold_flag` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ffl_id` int unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dealers`
--

LOCK TABLES `dealers` WRITE;
/*!40000 ALTER TABLE `dealers` DISABLE KEYS */;
INSERT INTO `dealers` VALUES (1,'Brad Sparks','42302 Carter Isle','Suite 921','North Danielahaven','NC','405.262.2684','27409','aperiam','Soluta cum laborum eos recusandae suscipit. Repellendus quod et voluptatem impedit consequatur eius illo nemo. Aliquam iure voluptatem ut et tempora. Qui ut minus tempora cumque vel.','sit','veniam','dolor','tenetur',1,'2025-02-06 01:53:49','2025-02-06 01:53:49'),(2,'Robert Loggia','7301 Rosamond Ridge Apt. 523','Suite 694','Teresafort','ND','605.433.3610','27263','sint','Voluptatem animi nesciunt ut in. Numquam voluptas est sit aut aliquid et voluptatem. Officia ullam molestiae maxime id omnis quia voluptatem. Neque ratione quia natus eligendi reiciendis.','voluptatibus','sit','odio','est',191611,'2025-02-06 01:53:49','2025-02-06 01:53:49'),(3,'Eric Snead','643 Pfannerstill Roads Apt. 868','Suite 000','Hillton','CA','+1.910.603.5796','90210','quos','Tempora voluptatibus aperiam voluptate. Itaque quae culpa vel enim hic velit laudantium. Id dolores ex soluta. Fugit aut in eligendi ut exercitationem vitae.','autem','voluptatem','totam','asperiores',2,'2025-02-06 01:53:49','2025-02-06 01:53:49'),(4,'Mrs. Cassie Welch','6844 Sawayn Way','Suite 071','Hermistonfort','TX','442.519.6483','98754','hic','Quas ratione deserunt maxime provident. Neque sunt at quisquam deserunt laboriosam non culpa. Id illo voluptatem aut quaerat et.','dicta','consequuntur','voluptatem','fugit',58039828,'2025-02-06 01:53:49','2025-02-06 01:53:49'),(5,'Emanuel Lang Sr.','332 Maggio Pass','Suite 368','Klingmouth','CT','1-336-501-1605','32645','facere','Veniam cumque quia corrupti est similique. Aspernatur laboriosam neque repellat aliquid. Sit aut suscipit error aliquid eos et nam.','dolor','eligendi','culpa','quo',46481,'2025-02-06 01:53:49','2025-02-06 01:53:49'),(6,'Ms. Reanna Fisher','277 Valentin Road','Suite 386','Schimmelville','CO','276.851.4927','41485','architecto','Doloremque voluptatibus magnam voluptas vel. Iure unde eligendi quos enim ratione.','est','eius','nam','et',420417,'2025-02-06 01:53:49','2025-02-06 01:53:49'),(7,'Jocelyn Hoeger','73184 Milan Path','Apt. 744','Beierbury','LA','(940) 414-0906','27652','qui','Ut quod voluptatibus ad odio. Qui a quo voluptatum voluptate doloribus dicta. Repudiandae esse ullam natus et.','sunt','quidem','omnis','assumenda',852018,'2025-02-06 01:53:49','2025-02-06 01:53:49'),(8,'Ms. Selina Ritchie Jr.','986 Cleta Park Suite 296','Apt. 483','Heidenreichberg','OR','510-949-3929','81252','aspernatur','Error doloremque ipsum ut a harum nulla. Et voluptatibus ipsam consequuntur. Tempora corrupti et in ullam nihil voluptatibus. Sed quae exercitationem recusandae rerum officiis iste ut accusamus.','unde','libero','quas','nemo',85,'2025-02-06 01:53:49','2025-02-06 01:53:49'),(9,'Dulce Hansen','7630 Audrey Meadows','Suite 594','Lake Alvenaville','WA','+14693967745','74585','voluptatibus','Quidem enim facere cum ea. Voluptatibus id doloribus quia aut.','vero','totam','non','rerum',3586077,'2025-02-06 01:53:49','2025-02-06 01:53:49'),(10,'Kian Gusikowski','520 Terry Station Apt. 613','Suite 470','Port Nathenchester','ID','907-729-7529','27260','eum','Molestias ut odit velit sit amet vel dolores harum. Architecto vero voluptatem velit occaecati libero. Dolorem ea dignissimos dolorem dolorum temporibus voluptas et. In culpa et corrupti.','dolore','placeat','eos','mollitia',88,'2025-02-06 01:53:49','2025-02-06 01:53:49'),(11,'Casimir Casper','1002 Lauren Groves','Apt. 106','New Nolan','SD','+1-530-620-7707','27262','quia','Accusantium asperiores est magni a dolor animi ipsum. Vitae ad ea repellat. Qui eum animi aperiam ut necessitatibus ratione. Ipsa harum quos quia quibusdam nam voluptas eum id.','fuga','perferendis','non','quae',1,'2025-02-06 02:18:05','2025-02-06 02:18:05'),(12,'Libbie McCullough II','173 Kling Island Apt. 736','Apt. 512','Nasirhaven','ND','1-559-395-3352','27261','qui','Quasi incidunt dolore nam. Voluptatem praesentium reprehenderit libero odit corporis. Ipsum ab qui consectetur ipsum harum maxime natus. Qui dignissimos aut aliquid non veniam.','dolores','assumenda','vitae','corrupti',7391035,'2025-02-06 02:18:05','2025-02-06 02:18:05'),(13,'Prof. Greyson Keeling','739 Gudrun Knolls','Apt. 859','East Allenfort','SC','+17032238480','27263','dignissimos','Sapiente maiores rerum fuga. Qui eveniet ab consectetur. Rem occaecati eveniet aliquid modi alias iste.','qui','nostrum','autem','voluptas',759389395,'2025-02-06 02:18:05','2025-02-06 02:18:05'),(14,'Murray Champlin','15252 Haley Stravenue Apt. 584','Apt. 037','Lake Adella','NC','513-789-4452','27265','commodi','Et aut officia consectetur ipsum vel nihil nesciunt. Sit atque dolor facilis aut. Qui cum quo non vel enim assumenda ut. Tempora labore cum quia architecto alias ut et.','dolor','consequuntur','sed','non',720459,'2025-02-06 02:18:05','2025-02-06 02:18:05'),(15,'Ford Haley','57869 Breitenberg Crescent','Apt. 521','Lake Jimmy','VA','1-678-407-6845','27407','recusandae','Omnis alias magni qui similique. Neque sed debitis praesentium sed placeat. Facilis aspernatur amet aspernatur et sed officiis.','inventore','reiciendis','et','sapiente',36,'2025-02-06 02:18:05','2025-02-06 02:18:05'),(16,'Ernest Gorczany','837 Runolfsson Falls Apt. 686','Suite 917','East April','GA','+16284677154','27401','eos','Sit officiis qui et. Quis eum dolorem nihil quia consequatur. Asperiores voluptatum odit velit.','dolores','velit','aspernatur','et',3401714,'2025-02-06 02:18:05','2025-02-06 02:18:05'),(17,'Sister Bechtelar','42899 Bahringer Cove Suite 536','Apt. 053','Hilpertborough','MA','+16786562084','27409','ullam','Dolor aut rem atque laborum ullam. Explicabo iure voluptas rerum nihil labore. Delectus quos quia velit occaecati. Quo omnis occaecati recusandae possimus ut molestiae corporis et.','facere','maiores','totam','ut',989958,'2025-02-06 02:18:05','2025-02-06 02:18:05'),(18,'Dorothy Wilkinson','21797 Watsica Manors','Apt. 241','North Theodoreshire','MD','912.488.0821','65421','qui','Dicta optio sequi sunt. Ut voluptas omnis quasi explicabo aperiam soluta nemo officiis. Accusantium ea hic vero sed rerum nemo. Quia tempore ut illo alias.','asperiores','est','mollitia','sed',24912,'2025-02-06 02:18:05','2025-02-06 02:18:05'),(19,'Destany Bernhard','779 Zelda Land','Suite 136','East Roelmouth','NJ','216.799.4452','65212','nam','Aut occaecati numquam quia voluptate. Dolores qui est repudiandae commodi. Nemo quis et beatae. Aut quaerat et numquam rerum atque saepe.','omnis','quia','quo','totam',244759972,'2025-02-06 02:18:05','2025-02-06 02:18:05'),(20,'Delia Lubowitz','770 Norberto Passage Suite 065','Suite 049','Rogerville','NY','534.931.5938','78780','nobis','Sunt officia et et necessitatibus ea a expedita non. Aut sed occaecati aut mollitia incidunt adipisci. Dolorum delectus dignissimos quo. Nulla enim reprehenderit natus eos ut voluptatem voluptatibus.','rerum','sunt','sed','magni',5081,'2025-02-06 02:18:05','2025-02-06 02:18:05'),(21,'Mr. Jimmy O\'Conner I','61196 Anahi Rapids','Apt. 764','North Sallyshire','ME','530.405.1257','79821','dolorem','Enim quaerat est impedit fuga qui consequuntur. Vel vel saepe tempora. Repellendus quia ab enim similique voluptatem incidunt ut.','voluptatem','veritatis','dolorem','voluptatem',9944,'2025-02-06 02:18:44','2025-02-06 02:18:44'),(22,'Dr. Syble Boehm','91356 Abernathy Burg Apt. 375','Apt. 462','East Berthatown','NH','+19382092373','65412','est','Et eaque repudiandae laudantium dolor necessitatibus perferendis. Dolores id aliquid rerum quo nisi nulla ipsam dicta. Sunt totam doloremque quis enim provident aut sint.','animi','quis','alias','vel',379,'2025-02-06 02:18:44','2025-02-06 02:18:44'),(23,'Jaleel Waelchi','408 Alexis Harbor','Suite 358','Daijafurt','VT','+1 (716) 222-8716','65232','architecto','Laudantium sunt et ipsa recusandae odio id adipisci. Aspernatur incidunt et molestias illum dicta recusandae rerum.','iste','est','molestiae','blanditiis',93158273,'2025-02-06 02:18:44','2025-02-06 02:18:44'),(24,'Milford Roob','96603 Waldo Trail','Suite 601','South Loganport','OH','936-923-4767','15451','error','Ut corrupti ut illo. Occaecati illo quidem aperiam iure eveniet vero. Et eum ad commodi quae quia molestiae fugit. Blanditiis perferendis rerum atque est.','qui','voluptatem','est','porro',97,'2025-02-06 02:18:44','2025-02-06 02:18:44'),(25,'Miss Dorris Buckridge','81814 Kayli Mountains Apt. 666','Suite 533','East Koreyport','OK','424.528.8624','32154','adipisci','Dolorem numquam repellat ab qui corrupti. Aut soluta id fugit iure ea repellat reiciendis.','aut','reprehenderit','dolor','molestiae',5,'2025-02-06 02:18:44','2025-02-06 02:18:44'),(26,'Prof. Merlin Pfeffer','391 Corwin Crescent Suite 564','Suite 203','Valentineborough','KS','475.436.5546','51256','dicta','Est et earum sint iste expedita vitae maxime. Ullam nemo suscipit et enim vel. Mollitia blanditiis ut nulla error occaecati.','eius','ducimus','neque','sunt',9,'2025-02-06 02:18:44','2025-02-06 02:18:44'),(27,'Verner Sporer','578 Brenna Rapids Apt. 186','Suite 828','Carolinaberg','IL','+1-650-745-7042','54854','quia','Fugit voluptatum magni inventore asperiores eum. Et corporis quis qui ipsam consequatur praesentium. Atque eaque minima et laudantium. Ut hic voluptate sapiente nihil porro.','commodi','ipsa','odio','aliquam',222880357,'2025-02-06 02:18:44','2025-02-06 02:18:44'),(28,'Kyle Oberbrunner','310 Connor Meadows','Suite 262','Lake Elijah','MI','667-265-4808','65622','et','Fuga ut eveniet velit distinctio et esse ullam. Asperiores dolore nisi consequatur. Quaerat dolores sed unde.','dolor','sint','et','corporis',55419,'2025-02-06 02:18:44','2025-02-06 02:18:44'),(29,'Brook Dare','106 Kemmer Rapids','Apt. 563','Kundeborough','NE','(680) 324-2979','87655','consequatur','Nisi alias et consequatur sed quia qui. Molestiae quod a eum vero consequatur asperiores expedita. Ut doloribus necessitatibus dolores quisquam quas eos. Tempore similique aspernatur nesciunt iusto.','distinctio','tenetur','rerum','nemo',282,'2025-02-06 02:18:44','2025-02-06 02:18:44'),(30,'Faustino O\'Reilly','6084 Bria Village Apt. 690','Apt. 787','Lake Jamarcus','AZ','1-660-923-4044','65421','tenetur','Optio voluptatem maiores consequatur sed. Ad aperiam est quo quis expedita et. Et magnam sapiente voluptatum iste atque esse. Aut temporibus et est doloribus.','similique','et','aliquam','aut',801254,'2025-02-06 02:18:44','2025-02-06 02:18:44');
/*!40000 ALTER TABLE `dealers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ffls`
--

DROP TABLE IF EXISTS `ffls`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ffls` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `license_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `license_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `license_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expire_date` date NOT NULL,
  `business_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zip_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `county` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bus_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bus_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fax` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `store_hours` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `directions` text COLLATE utf8mb4_unicode_ci,
  `dealer_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ffls`
--

LOCK TABLES `ffls` WRITE;
/*!40000 ALTER TABLE `ffls` DISABLE KEYS */;
INSERT INTO `ffls` VALUES (1,'9876541','voluptatibus','TYPE_08','1985-03-29','dolores','91902 Jerad Junction','Suite 238','Taryntown','GA','27626','Randolph','qui','eius','alias','sarah.dach@example.org','maiores','Voluptas illum error non sit exercitationem nostrum qui odit. Repellendus optio modi ullam eaque. Aut veniam est autem animi alias pariatur et.',2,'2025-02-06 02:18:44','2025-02-06 02:18:44'),(2,'5-43-099-01-5M-17773','Brad\'s Gun and Sport Shop','TYPE_10','2025-11-09','Vandelay Sports','166 Veda Dale','Suite 005','Lakinfurt','MT','27409','Guilford','accusantium','nisi','atque','rowan.hirthe@example.net','delectus','Nisi ut facilis quos beatae reprehenderit dolore. Maiores dolor consequatur nemo deleniti excepturi. Aliquid dolor officia iure fugiat sint provident ut. Eaque possimus sint voluptatum ipsam sed.',1,'2025-02-06 02:18:44','2025-02-06 02:18:44'),(3,'5-43-084-09-3M-17773','Eric\'s Explosives','TYPE_09','2007-02-11','Eric\'s Explosives','358 Kling Garden Suite 378','Suite 756','North Edisonborough','LA','65421','Davidson','corporis','ut','nisi','lindgren.aidan@example.net','voluptas','Perspiciatis fuga eos molestias dolorem maiores nihil. Et repellat similique quia occaecati. Ea soluta quisquam delectus ut.',3,'2025-02-06 02:18:44','2025-02-06 02:18:44'),(4,'9876546','vitae','TYPE_06','1986-12-23','dolorem','5406 Luettgen Plains Apt. 117','Apt. 463','South Grantview','SC','65874','Forsyth','asperiores','sit','sunt','lloyd.price@example.org','quis','Temporibus vero exercitationem enim in. Sapiente ea quam nobis vero. Corporis tempora facere itaque ea porro.',24,'2025-02-06 02:18:44','2025-02-06 02:18:44'),(5,'6543214','quos','TYPE_11','2001-09-20','distinctio','449 Tristian Keys Suite 900','Suite 743','New Camilleview','NC','61688','Mecklenburg','libero','perferendis','blanditiis','drowe@example.org','consequatur','Qui quae libero in error nihil asperiores. Qui aut sunt quidem a. Maxime temporibus unde iusto sed non.',25,'2025-02-06 02:18:44','2025-02-06 02:18:44'),(6,'7891591','molestias','TYPE_02','2019-03-04','eaque','94165 Senger Mill Apt. 469','Apt. 736','Port Carminefort','CA','97210','Boone','id','libero','praesentium','rath.dolly@example.org','quod','Ipsam est necessitatibus est corrupti impedit deleniti sint sed. Quo omnis ut nemo qui. Facere molestiae qui ipsam consequatur.',26,'2025-02-06 02:18:44','2025-02-06 02:18:44'),(7,'6514981','modi','TYPE_10','1986-10-09','facilis','9124 Howell Shoals Apt. 531','Apt. 030','Kubtown','FL','65872','Stokes','ut','et','quia','rosella.ankunding@example.net','earum','Quaerat quasi deserunt recusandae excepturi excepturi atque quae quis. Eos sed a et alias magni. Et fugiat quod ut eum animi.',27,'2025-02-06 02:18:44','2025-02-06 02:18:44'),(8,'9465477','et','TYPE_06','1984-07-11','est','162 Joesph Junction','Apt. 256','Corneliusview','CT','27263','Wake','ut','dolores','consequatur','schaefer.miguel@example.net','consequatur','Rem eos sapiente quam accusamus quidem temporibus perspiciatis illo. Vitae et omnis quo. Minima quas hic et ut.',28,'2025-02-06 02:18:44','2025-02-06 02:18:44'),(9,'6511653','in','TYPE_07','1998-09-30','ducimus','1522 Osinski Islands Suite 499','Suite 934','Kozeyberg','NY','27265','Alamance','ut','aut','aut','rice.watson@example.com','rerum','Dolor rerum tempore accusamus eum vero voluptatem nesciunt nihil. Facilis sit sed atque odit ullam consequatur. Reprehenderit quasi et nulla aut sed eos aut. Unde autem ipsum aut incidunt sed unde.',29,'2025-02-06 02:18:44','2025-02-06 02:18:44'),(10,'6549457','fugiat','TYPE_02','2019-06-18','perferendis','352 Cierra Alley','Apt. 034','North Linneafort','NJ','27260','Brunswick','dolores','est','facere','hayes.phoebe@example.net','tempore','Tempora necessitatibus praesentium unde ex architecto iste. Et magni et earum dolor. Provident magni non id qui necessitatibus. Nobis ut rerum aperiam quisquam voluptates.',30,'2025-02-06 02:18:44','2025-02-06 02:18:44');
/*!40000 ALTER TABLE `ffls` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gallery_of_guns`
--

DROP TABLE IF EXISTS `gallery_of_guns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gallery_of_guns` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `dealer_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gallery_of_guns`
--

LOCK TABLES `gallery_of_guns` WRITE;
/*!40000 ALTER TABLE `gallery_of_guns` DISABLE KEYS */;
/*!40000 ALTER TABLE `gallery_of_guns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoices`
--

DROP TABLE IF EXISTS `invoices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `invoices` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `dealer_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoices`
--

LOCK TABLES `invoices` WRITE;
/*!40000 ALTER TABLE `invoices` DISABLE KEYS */;
/*!40000 ALTER TABLE `invoices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `licensings`
--

DROP TABLE IF EXISTS `licensings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `licensings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `dealer_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `licensings`
--

LOCK TABLES `licensings` WRITE;
/*!40000 ALTER TABLE `licensings` DISABLE KEYS */;
/*!40000 ALTER TABLE `licensings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2025_02_05_195749_create_ffls_table',2),(5,'2025_02_05_195750_create_customers_table',2),(6,'2025_02_05_195751_create_dealers_table',2),(7,'2025_02_05_204932_create_dealer_user_table',3),(8,'2025_02_10_173827_create_store_profiles_table',4),(9,'2025_02_24_173828_create_my_favorites_table',5),(10,'2025_02_25_210420_create_my_orders_table',6),(11,'2025_02_25_210827_create_payments_table',6),(12,'2025_02_25_211105_create_invoices_table',6),(13,'2025_02_25_211358_create_addresses_table',6),(14,'2025_02_25_211921_create_licencings_table',6),(15,'2025_02_25_212537_create_programs_table',6),(16,'2025_02_25_212957_create_customer_issues_table',6),(17,'2025_02_25_213222_create_user_securities_table',6),(18,'2025_02_25_214004_create_gallery_of_guns_table',6),(19,'2025_02_25_211928_create_licensings_table',7);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `my_favorites`
--

DROP TABLE IF EXISTS `my_favorites`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `my_favorites` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `item` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `activity` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `action` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dealer_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `my_favorites`
--

LOCK TABLES `my_favorites` WRITE;
/*!40000 ALTER TABLE `my_favorites` DISABLE KEYS */;
/*!40000 ALTER TABLE `my_favorites` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `my_orders`
--

DROP TABLE IF EXISTS `my_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `my_orders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `dealer_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `my_orders`
--

LOCK TABLES `my_orders` WRITE;
/*!40000 ALTER TABLE `my_orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `my_orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `payments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `dealer_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payments`
--

LOCK TABLES `payments` WRITE;
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
/*!40000 ALTER TABLE `payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `programs`
--

DROP TABLE IF EXISTS `programs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `programs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `dealer_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `programs`
--

LOCK TABLES `programs` WRITE;
/*!40000 ALTER TABLE `programs` DISABLE KEYS */;
/*!40000 ALTER TABLE `programs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('QneFgeUcEhg0TtsQ5979kIvW7ssPAUIPuroZggtG',1,'127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36','YTo2OntzOjY6Il90b2tlbiI7czo0MDoiUjJqUEdEbDE3dVZTU0xxd2UyUEFLQ0V4TVVONlNsMkpRcXJFMDVISiI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjY4OiJodHRwOi8vbGFyYXZlbC10ZW5hbnQudGVzdDo4MDI2L2FkbWluL2RlYWxlci8xL3N0b3JlLXByb2ZpbGVzLzEvZWRpdCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czoxNzoicGFzc3dvcmRfaGFzaF93ZWIiO3M6NjA6IiQyeSQxMiQ3cjE3MDkuOXMuZW1va0ovc2JKclcuRDQ2bGpjY2pwM3dtVzBvdFJ1YXhWQ2I1VFBZam5CQyI7fQ==',1740055442),('UOhv4OyrIk8oafqw3xzrqjL9A897sKYfYYxrYMzQ',1,'127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiWnJNRDdNNGxCTE1Xb2VsWm5wUVJCR3FGWmN5RnpkZXFYMlhVeTJ6RSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTM6Imh0dHA6Ly9sYXJhdmVsLXRlbmFudC50ZXN0OjgwMjYvYWRtaW4vZGVhbGVyLzEvZmZscy8yIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjE3OiJwYXNzd29yZF9oYXNoX3dlYiI7czo2MDoiJDJ5JDEyJDdyMTcwOS45cy5lbW9rSi9zYkpyVy5ENDZsamNjanAzd21XMG90UnVheFZDYjVUUFlqbkJDIjt9',1739981565);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `store_profiles`
--

DROP TABLE IF EXISTS `store_profiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `store_profiles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `store_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slogan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zip_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fax` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `store_hours` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `directions` text COLLATE utf8mb4_unicode_ci,
  `about` text COLLATE utf8mb4_unicode_ci,
  `dealer_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `store_profiles`
--

LOCK TABLES `store_profiles` WRITE;
/*!40000 ALTER TABLE `store_profiles` DISABLE KEYS */;
INSERT INTO `store_profiles` VALUES (1,'Vandelay Sports','If it ain\'t broke, it soon will be.','3339 Timberwolf Ave.','Suite 211','Gastonia','PA','98754','(765) 786-8882','(864) 520-3666','leuschke.cassidy@example.net','http://www.raynor.com/','9am - 5pm Mon-Fri','You can\'t get here from there.','About as far away as you can get.',1,'2025-02-10 23:03:06','2025-02-19 20:34:28'),(2,'Dropping The Hammer',NULL,'203 Englewood Ave',NULL,'Archdale','NC','27263','(919) 434-2447','(864) 520-3661','john.hairston@yahoo.com','https://explosives.com','9am - 5pm Mon-Fri','You have to know basic compass headings first.','One dog barks; a thousand dogs bark because they hear the first dog bark.',3,NULL,'2025-02-19 02:18:56');
/*!40000 ALTER TABLE `store_profiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_securities`
--

DROP TABLE IF EXISTS `user_securities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_securities` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `dealer_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_securities`
--

LOCK TABLES `user_securities` WRITE;
/*!40000 ALTER TABLE `user_securities` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_securities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Brad Sparks','brad.sparks@davidsonsinc.com',NULL,'$2y$12$7r1709.9s.emokJ/sbJrW.D46ljccjp3wmW0otRuaxVCb5TPYjnBC',NULL,'2025-02-06 01:01:06','2025-02-06 01:01:06'),(3,'Eric Snead','eric.snead@davidsonsinc.com',NULL,'$2y$12$HquivGDt9sMOSaPN/pbP2emVWZ4D1TiYXnb3ZjNYcuEyGgyhZYQWy',NULL,'2025-02-19 01:45:14','2025-02-19 01:45:14');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-03-04 16:41:23
