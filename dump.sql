-- MySQL dump 10.13  Distrib 5.1.49, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: blue-shop.dev
-- ------------------------------------------------------
-- Server version	5.1.49-1ubuntu8.1

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
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `cat_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `cat_alias` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `sec_id` int(10) unsigned DEFAULT NULL,
  `cat_description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `cat_code` varchar(128) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `cat_tags` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `cat_publish` enum('yes','no') CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT 'yes',
  `cat_created` datetime DEFAULT NULL,
  `cat_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`cat_id`),
  UNIQUE KEY `cat_name_UNIQUE` (`cat_name`),
  UNIQUE KEY `cat_code_UNIQUE` (`cat_code`),
  KEY `fk_categories_1` (`sec_id`),
  CONSTRAINT `fk_categories_1` FOREIGN KEY (`sec_id`) REFERENCES `sections` (`sec_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'test-cat-1',NULL,2,'desc-1',NULL,NULL,'yes','2011-05-28 15:50:24','2011-05-29 21:02:25'),(6,'test-cat-2',NULL,3,'desc-2',NULL,NULL,'yes','2011-05-28 16:07:55','2011-05-28 16:14:50'),(9,'test-cat-3',NULL,4,'desc-3',NULL,NULL,'yes','2011-05-28 16:08:39','2011-05-28 16:14:56');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `p_id` int(10) unsigned DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `name` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `mail` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `site` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `subject` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `message` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `ip` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `vote_up` bigint(20) DEFAULT '0',
  `vote_down` bigint(20) DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `publish` enum('yes','no','awaiting') CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT 'yes',
  PRIMARY KEY (`id`),
  KEY `fk_comments_1` (`p_id`),
  KEY `fk_comments_2` (`user_id`),
  CONSTRAINT `fk_comments_1` FOREIGN KEY (`p_id`) REFERENCES `products` (`p_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_comments_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (1,2,NULL,'name1','mail1','site1','asdasdas1','dasdasdasdasdsad1',NULL,34,4,'2011-05-31 03:23:14','yes'),(4,7,1,NULL,NULL,NULL,'lus velit, posuere et fringilla quis','lus velit, posuere et fringilla quis',NULL,0,0,'2011-05-31 04:14:13','yes'),(5,7,1,NULL,NULL,NULL,'lus velit, posuere et fringilla quis','lus velit, posuere et fringilla quis',NULL,0,0,'2011-05-31 04:14:18','yes'),(6,7,1,NULL,NULL,NULL,'lus velit, posuere et fringilla quis','lus velit, posuere et fringilla quis',NULL,0,0,'2011-05-31 04:14:22','yes'),(7,7,1,NULL,NULL,NULL,'lus velit, posuere et fringilla quis','lus velit, posuere et fringilla quis',NULL,0,0,'2011-05-31 04:14:27','yes'),(8,7,1,NULL,NULL,NULL,'lus velit, posuere et fringilla quis','lus velit, posuere et fringilla quis',NULL,0,0,'2011-05-31 04:14:31','yes'),(9,7,1,NULL,NULL,NULL,'lus velit, posuere et fringilla quis','lus velit, posuere et fringilla quis',NULL,0,0,'2011-05-31 04:14:36','yes'),(10,7,1,NULL,NULL,NULL,'lus velit, posuere et fringilla quis','lus velit, posuere et fringilla quis',NULL,0,0,'2011-05-31 04:14:40','yes'),(11,7,1,NULL,NULL,NULL,'lus velit, posuere et fringilla quis','lus velit, posuere et fringilla quis',NULL,0,0,'2011-05-31 04:14:43','yes'),(12,7,1,NULL,NULL,NULL,'lus velit, posuere et fringilla quis','lus velit, posuere et fringilla quis',NULL,0,0,'2011-05-31 04:14:50','yes'),(13,7,1,NULL,NULL,NULL,'lus velit, posuere et fringilla quis','lus velit, posuere et fringilla quis',NULL,0,0,'2011-05-31 04:15:05','yes'),(14,2,1,NULL,NULL,NULL,'asdasd','asdasdasd',NULL,4,0,'2011-06-03 14:26:48','yes'),(15,2,NULL,NULL,NULL,NULL,'dasdas','fsdfasdf',NULL,0,0,'2011-06-04 05:37:20','yes'),(16,2,NULL,NULL,NULL,NULL,'dasdas','fsdfasdf',NULL,0,0,'2011-06-04 05:37:42','yes'),(17,2,NULL,NULL,NULL,NULL,'dasdas','fsdfasdf',NULL,0,0,'2011-06-04 05:37:59','yes'),(18,2,NULL,'dasdas','dasd@mail.com',NULL,'asdfa','dasdasdas',NULL,0,0,'2011-06-04 05:40:34','yes'),(19,2,NULL,'dasdas','dasd@mail.com',NULL,'asdasdas11111','sadasas111111111111',NULL,0,0,'2011-06-04 05:41:16','yes'),(20,2,NULL,'dasdas','dasd@mail.com',NULL,'asdasdas222222222222222','sadasas22222222222',NULL,1,0,'2011-06-04 05:42:05','yes');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contacts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `mail` varchar(128) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `message` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `ip` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `status` enum('read','unread','important') CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT 'unread',
  `additional_info` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `mail` (`mail`),
  KEY `ip` (`ip`),
  KEY `time` (`created`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contacts`
--

LOCK TABLES `contacts` WRITE;
/*!40000 ALTER TABLE `contacts` DISABLE KEYS */;
/*!40000 ALTER TABLE `contacts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `currencies`
--

DROP TABLE IF EXISTS `currencies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `currencies` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `short_name` varchar(3) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `rate` decimal(9,7) DEFAULT NULL,
  `name` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `short_name_UNIQUE` (`short_name`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `currencies`
--

LOCK TABLES `currencies` WRITE;
/*!40000 ALTER TABLE `currencies` DISABLE KEYS */;
INSERT INTO `currencies` VALUES (1,'EUR','0.6951700','Euro'),(2,'GBP','0.6043800','Pound'),(3,'RSD','67.4176000','Dinar');
/*!40000 ALTER TABLE `currencies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `featured`
--

DROP TABLE IF EXISTS `featured`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `featured` (
  `f_id` int(11) NOT NULL AUTO_INCREMENT,
  `p_id` int(10) unsigned DEFAULT NULL,
  `start` date DEFAULT NULL,
  `expiration` date DEFAULT '9999-12-31',
  PRIMARY KEY (`f_id`),
  KEY `fk_featured_1` (`p_id`),
  CONSTRAINT `fk_featured_1` FOREIGN KEY (`p_id`) REFERENCES `products` (`p_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `featured`
--

LOCK TABLES `featured` WRITE;
/*!40000 ALTER TABLE `featured` DISABLE KEYS */;
INSERT INTO `featured` VALUES (1,2,'2011-05-01','2012-01-01'),(17,3,'2011-05-01','2012-01-01'),(20,4,'2011-05-01','2012-01-01'),(23,5,'2011-05-01','2012-01-01'),(24,6,'2011-05-01','2012-01-01'),(25,7,'2011-05-01','2012-01-01'),(30,2,'2011-06-04','2011-06-04'),(31,2,'2011-06-04','2011-06-04'),(32,2,'2011-06-04','2011-06-04');
/*!40000 ALTER TABLE `featured` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `manufacturers`
--

DROP TABLE IF EXISTS `manufacturers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `manufacturers` (
  `man_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `man_name` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `man_alias` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `man_description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `man_code` varchar(128) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `man_tags` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `man_publish` enum('yes','no') CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT 'yes',
  `man_created` datetime DEFAULT NULL,
  `man_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`man_id`),
  UNIQUE KEY `man_name_UNIQUE` (`man_name`),
  UNIQUE KEY `man_code_UNIQUE` (`man_code`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `manufacturers`
--

LOCK TABLES `manufacturers` WRITE;
/*!40000 ALTER TABLE `manufacturers` DISABLE KEYS */;
INSERT INTO `manufacturers` VALUES (1,'test-man-1',NULL,'desc-1','code-1','tag-1','yes',NULL,'2011-05-29 21:02:38'),(7,'test-man-2',NULL,'desc-2','code-2','tag-2','yes','2011-05-28 02:34:24','2011-05-29 21:05:47'),(8,'test-man-3',NULL,'desc-3','code-3','tag-3','yes','2011-05-28 02:41:42',NULL),(9,'test-man-4',NULL,'desc-4','code-4','tag-4','yes','2011-05-28 02:42:01',NULL);
/*!40000 ALTER TABLE `manufacturers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `navigation`
--

DROP TABLE IF EXISTS `navigation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `navigation` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `left` int(10) unsigned NOT NULL,
  `right` int(10) unsigned NOT NULL,
  `status` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `navigation`
--

LOCK TABLES `navigation` WRITE;
/*!40000 ALTER TABLE `navigation` DISABLE KEYS */;
/*!40000 ALTER TABLE `navigation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `options`
--

DROP TABLE IF EXISTS `options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `options` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `value` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=69 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `options`
--

LOCK TABLES `options` WRITE;
/*!40000 ALTER TABLE `options` DISABLE KEYS */;
/*!40000 ALTER TABLE `options` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `p_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `p_name` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `p_alias` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `p_images` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `p_description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `p_spec` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `p_price` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `cat_id` int(10) unsigned DEFAULT NULL,
  `man_id` int(10) unsigned DEFAULT NULL,
  `p_publish` enum('yes','no','awaiting') CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT 'awaiting',
  `p_code` varchar(128) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `p_stock` bigint(20) unsigned DEFAULT '0',
  `p_tags` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `p_created` datetime DEFAULT NULL,
  `p_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`p_id`),
  UNIQUE KEY `p_code_UNIQUE` (`p_code`),
  KEY `fk_products_1` (`cat_id`),
  KEY `fk_products_2` (`man_id`),
  CONSTRAINT `fk_products_1` FOREIGN KEY (`cat_id`) REFERENCES `categories` (`cat_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_products_2` FOREIGN KEY (`man_id`) REFERENCES `manufacturers` (`man_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (2,'demo-product-1','demo-product-1','100.jpg;Jellyfish.jpg','Consectetur adipiscing elit. Duis ullamcorper urna a odio pellentesque tincidunt. Pellentesque pharetra iaculis eros id molestie. Nam a libero sit amet leo malesuada lobortis. Vivamus mollis pellentesque condimentum. Lorem ipsum dolor sit amet, consectetur adipiscing elit.\r\nPhasellus tellus velit, posuere et fringilla quis, sollicitudin at lectus. Proin et justo libero, vitae imperdiet odio. Proin a nibh interdum magna porttitor sagittis. Fusce lacinia cursus lectus sit amet tristique. Sed vel tellus quis mauris convallis viverra quis vitae nibh. Ut rutrum, lectus non rutrum tempus, nunc enim volutpat lacus, id tempor nisi metus quis diam.  ','<p>Consectetur adipiscing elit. Duis ullamcorper urna a odio pellentesque tincidunt. Pellentesque pharetra iaculis eros id molestie. Nam a libero sit amet leo malesuada lobortis. Vivamus mollis pellentesque condimentum. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p><p>Phasellus tellus velit, posuere et fringilla quis, sollicitudin at lectus. Proin et justo libero, vitae imperdiet odio. Proin a nibh interdum magna porttitor sagittis. Fusce lacinia cursus lectus sit amet tristique. Sed vel tellus quis mauris convallis viverra quis vitae nibh. Ut rutrum, lectus non rutrum tempus, nunc enim volutpat lacus, id tempor nisi metus quis diam. Fusce nec dolor neque, in ultrices arcu. Fusce eros enim, vehicula vel hendrerit a, euismod vitae nulla.Consectetur adipiscing elit. Duis ullamcorper urna a odio pellentesque tincidunt. Pellentesque pharetra iaculis eros id molestie. Nam a libero sit amet leo malesuada lobortis. Vivamus mollis pellentesque condimentum. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p><p>Phasellus tellus velit, posuere et fringilla quis, sollicitudin at lectus. Proin et justo libero, vitae imperdiet odio. Proin a nibh interdum magna porttitor sagittis. Fusce lacinia cursus lectus sit amet tristique. Sed vel tellus quis mauris convallis viverra quis vitae nibh. Ut rutrum, lectus non rutrum tempus, nunc enim volutpat lacus, id tempor nisi metus quis diam. Fusce nec dolor neque, in ultrices arcu. Fusce eros enim, vehicula vel hendrerit a, euismod vitae nulla.Consectetur adipiscing elit. Duis ullamcorper urna a odio pellentesque tincidunt. Pellentesque pharetra iaculis eros id molestie. Nam a libero sit amet leo malesuada lobortis. Vivamus mollis pellentesque condimentum. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p><p>Phasellus tellus velit, posuere et fringilla quis, sollicitudin at lectus. Proin et justo libero, vitae imperdiet odio. Proin a nibh interdum magna porttitor sagittis. Fusce lacinia cursus lectus sit amet tristique. Sed vel tellus quis mauris convallis viverra quis vitae nibh. Ut rutrum, lectus non rutrum tempus, nunc enim volutpat lacus, id tempor nisi metus quis diam. Fusce nec dolor neque, in ultrices arcu. Fusce eros enim, vehicula vel hendrerit a, euismod vitae nulla.</p>  ','0',1,1,'yes',NULL,25,'foo;bar;baz','2011-05-29 17:26:13','2011-06-11 11:53:56'),(3,'demo-product-2','demo-product-2','products/daw.jpg;products/aw.jpg','Consectetur adipiscing elit. Duis ullamcorper urna a odio pellentesque tincidunt. Pellentesque pharetra iaculis eros id molestie. Nam a libero sit amet leo malesuada lobortis. Vivamus mollis pellentesque condimentum. Lorem ipsum dolor sit amet, consectetur adipiscing elit.\r\nPhasellus tellus velit, posuere et fringilla quis, sollicitudin at lectus. Proin et justo libero, vitae imperdiet odio. Proin a nibh interdum magna porttitor sagittis. Fusce lacinia cursus lectus sit amet tristique. Sed vel tellus quis mauris convallis viverra quis vitae nibh. Ut rutrum, lectus non rutrum tempus, nunc enim volutpat lacus, id tempor nisi metus quis diam.  ','Consectetur adipiscing elit. Duis ullamcorper urna a odio pellentesque tincidunt. Pellentesque pharetra iaculis eros id molestie. Nam a libero sit amet leo malesuada lobortis. <strong>Vivamus mollis pellentesque</strong> condimentum. Lorem ipsum dolor sit amet, consectetur adipiscing elit.\r\nPhasellus tellus velit, posuere et fringilla quis, sollicitudin at lectus. Proin et justo libero, vitae imperdiet odio. Proin a nibh interdum magna porttitor sagittis. Fusce lacinia cursus lectus sit amet tristique. Sed vel tellus quis mauris convallis <em>viverra quis vitae nibh</em>. Ut rutrum, lectus non rutrum tempus, nunc enim volutpat lacus, id tempor nisi metus quis diam. Fusce nec dolor neque, in ultrices arcu. Fusce eros enim, vehicula vel hendrerit a, euismod vitae nulla.Consectetur adipiscing elit. Duis ullamcorper urna a odio pellentesque tincidunt. Pellentesque pharetra iaculis eros id molestie. Nam a libero sit amet leo malesuada lobortis. Vivamus mollis pellentesque condimentum. Lorem ipsum dolor sit amet, consectetur adipiscing elit.\r\nPhasellus tellus velit, posuere et fringilla quis, sollicitudin at lectus. Proin et justo libero, vitae imperdiet odio. Proin a nibh interdum magna <span style=\"text-decoration:underline\">porttitor sagittis</span>. Fusce lacinia cursus lectus sit amet tristique. Sed vel tellus quis mauris convallis viverra quis vitae nibh. Ut rutrum, lectus non rutrum tempus, nunc enim volutpat lacus, id tempor nisi metus quis diam. Fusce nec dolor neque, in ultrices arcu. Fusce eros enim, vehicula vel hendrerit a, euismod vitae nulla.Consectetur adipiscing elit. Duis ullamcorper urna a odio pellentesque tincidunt. Pellentesque pharetra iaculis eros id molestie. Nam a libero sit amet leo malesuada lobortis. Vivamus mollis pellentesque condimentum. Lorem ipsum dolor sit amet, consectetur adipiscing elit.\r\nPhasellus tellus velit, posuere et fringilla quis, sollicitudin at lectus. Proin et justo libero, vitae imperdiet odio. Proin a nibh interdum magna porttitor sagittis. Fusce lacinia cursus lectus sit amet tristique. Sed vel tellus quis mauris convallis viverra quis vitae nibh. Ut rutrum, lectus non rutrum tempus, nunc enim volutpat lacus, id tempor nisi metus quis diam. Fusce nec dolor neque, in ultrices arcu. Fusce eros enim, vehicula vel hendrerit a, euismod vitae nulla.  ','25000',1,1,'yes',NULL,NULL,NULL,'2011-05-29 19:02:18','2011-06-03 01:31:45'),(4,'demo-product-3','demo-product-3','Jellyfish.jpg;100.jpg','Consectetur adipiscing elit. Duis ullamcorper urna a odio pellentesque tincidunt. Pellentesque pharetra iaculis eros id molestie. Nam a libero sit amet leo malesuada lobortis. Vivamus mollis pellentesque condimentum. Lorem ipsum dolor sit amet, consectetur adipiscing elit.\r\nPhasellus tellus velit, posuere et fringilla quis, sollicitudin at lectus. Proin et justo libero, vitae imperdiet odio. Proin a nibh interdum magna porttitor sagittis. Fusce lacinia cursus lectus sit amet tristique. Sed vel tellus quis mauris convallis viverra quis vitae nibh. Ut rutrum, lectus non rutrum tempus, nunc enim volutpat lacus, id tempor nisi metus quis diam.  ','<p>Consectetur adipiscing elit. Duis ullamcorper urna a odio pellentesque tincidunt. Pellentesque pharetra iaculis eros id molestie. Nam a libero sit amet leo malesuada lobortis. Vivamus mollis pellentesque condimentum. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p><p>Phasellus tellus velit, posuere et fringilla quis, sollicitudin at lectus. Proin et justo libero, vitae imperdiet odio. Proin a nibh interdum magna porttitor sagittis. Fusce lacinia cursus lectus sit amet tristique. Sed vel tellus quis mauris convallis viverra quis vitae nibh. Ut rutrum, lectus non rutrum tempus, nunc enim volutpat lacus, id tempor nisi metus quis diam. Fusce nec dolor neque, in ultrices arcu. Fusce eros enim, vehicula vel hendrerit a, euismod vitae nulla.Consectetur adipiscing elit. Duis ullamcorper urna a odio pellentesque tincidunt. Pellentesque pharetra iaculis eros id molestie. Nam a libero sit amet leo malesuada lobortis. Vivamus mollis pellentesque condimentum. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p><p>Phasellus tellus velit, posuere et fringilla quis, sollicitudin at lectus. Proin et justo libero, vitae imperdiet odio. Proin a nibh interdum magna porttitor sagittis. Fusce lacinia cursus lectus sit amet tristique. Sed vel tellus quis mauris convallis viverra quis vitae nibh. Ut rutrum, lectus non rutrum tempus, nunc enim volutpat lacus, id tempor nisi metus quis diam. Fusce nec dolor neque, in ultrices arcu. Fusce eros enim, vehicula vel hendrerit a, euismod vitae nulla.Consectetur adipiscing elit. Duis ullamcorper urna a odio pellentesque tincidunt. Pellentesque pharetra iaculis eros id molestie. Nam a libero sit amet leo malesuada lobortis. Vivamus mollis pellentesque condimentum. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p><p>Phasellus tellus velit, posuere et fringilla quis, sollicitudin at lectus. Proin et justo libero, vitae imperdiet odio. Proin a nibh interdum magna porttitor sagittis. Fusce lacinia cursus lectus sit amet tristique. Sed vel tellus quis mauris convallis viverra quis vitae nibh. Ut rutrum, lectus non rutrum tempus, nunc enim volutpat lacus, id tempor nisi metus quis diam. Fusce nec dolor neque, in ultrices arcu. Fusce eros enim, vehicula vel hendrerit a, euismod vitae nulla.</p>  ','50000',1,1,'yes',NULL,NULL,NULL,'2011-05-30 13:48:07','2011-05-31 22:12:39'),(5,'demo-product-4','demo-product-4','products/aw.jpg;products/amilo.jpg','Consectetur adipiscing elit. Duis ullamcorper urna a odio pellentesque tincidunt. Pellentesque pharetra iaculis eros id molestie. Nam a libero sit amet leo malesuada lobortis. Vivamus mollis pellentesque condimentum. Lorem ipsum dolor sit amet, consectetur adipiscing elit.\r\nPhasellus tellus velit, posuere et fringilla quis, sollicitudin at lectus. Proin et justo libero, vitae imperdiet odio. Proin a nibh interdum magna porttitor sagittis. Fusce lacinia cursus lectus sit amet tristique. Sed vel tellus quis mauris convallis viverra quis vitae nibh. Ut rutrum, lectus non rutrum tempus, nunc enim volutpat lacus, id tempor nisi metus quis diam.  ','<p>Consectetur adipiscing elit. Duis ullamcorper urna a odio pellentesque tincidunt. Pellentesque pharetra iaculis eros id molestie. Nam a libero sit amet leo malesuada lobortis. Vivamus mollis pellentesque condimentum. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p><p>Phasellus tellus velit, posuere et fringilla quis, sollicitudin at lectus. Proin et justo libero, vitae imperdiet odio. Proin a nibh interdum magna porttitor sagittis. Fusce lacinia cursus lectus sit amet tristique. Sed vel tellus quis mauris convallis viverra quis vitae nibh. Ut rutrum, lectus non rutrum tempus, nunc enim volutpat lacus, id tempor nisi metus quis diam. Fusce nec dolor neque, in ultrices arcu. Fusce eros enim, vehicula vel hendrerit a, euismod vitae nulla.Consectetur adipiscing elit. Duis ullamcorper urna a odio pellentesque tincidunt. Pellentesque pharetra iaculis eros id molestie. Nam a libero sit amet leo malesuada lobortis. Vivamus mollis pellentesque condimentum. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p><p>Phasellus tellus velit, posuere et fringilla quis, sollicitudin at lectus. Proin et justo libero, vitae imperdiet odio. Proin a nibh interdum magna porttitor sagittis. Fusce lacinia cursus lectus sit amet tristique. Sed vel tellus quis mauris convallis viverra quis vitae nibh. Ut rutrum, lectus non rutrum tempus, nunc enim volutpat lacus, id tempor nisi metus quis diam. Fusce nec dolor neque, in ultrices arcu. Fusce eros enim, vehicula vel hendrerit a, euismod vitae nulla.Consectetur adipiscing elit. Duis ullamcorper urna a odio pellentesque tincidunt. Pellentesque pharetra iaculis eros id molestie. Nam a libero sit amet leo malesuada lobortis. Vivamus mollis pellentesque condimentum. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p><p>Phasellus tellus velit, posuere et fringilla quis, sollicitudin at lectus. Proin et justo libero, vitae imperdiet odio. Proin a nibh interdum magna porttitor sagittis. Fusce lacinia cursus lectus sit amet tristique. Sed vel tellus quis mauris convallis viverra quis vitae nibh. Ut rutrum, lectus non rutrum tempus, nunc enim volutpat lacus, id tempor nisi metus quis diam. Fusce nec dolor neque, in ultrices arcu. Fusce eros enim, vehicula vel hendrerit a, euismod vitae nulla.</p>  ','22000',1,7,'yes',NULL,NULL,NULL,'2011-05-31 04:05:14','2011-05-31 22:12:47'),(6,'demo-product-5','demo-product-5','products/amilo.jpg;products/aw.jpg','Consectetur adipiscing elit. Duis ullamcorper urna a odio pellentesque tincidunt. Pellentesque pharetra iaculis eros id molestie. Nam a libero sit amet leo malesuada lobortis. Vivamus mollis pellentesque condimentum. Lorem ipsum dolor sit amet, consectetur adipiscing elit.\r\nPhasellus tellus velit, posuere et fringilla quis, sollicitudin at lectus. Proin et justo libero, vitae imperdiet odio. Proin a nibh interdum magna porttitor sagittis. Fusce lacinia cursus lectus sit amet tristique. Sed vel tellus quis mauris convallis viverra quis vitae nibh. Ut rutrum, lectus non rutrum tempus, nunc enim volutpat lacus, id tempor nisi metus quis diam.  ','<p>Consectetur adipiscing elit. Duis ullamcorper urna a odio pellentesque tincidunt. Pellentesque pharetra iaculis eros id molestie. Nam a libero sit amet leo malesuada lobortis. Vivamus mollis pellentesque condimentum. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p><p>Phasellus tellus velit, posuere et fringilla quis, sollicitudin at lectus. Proin et justo libero, vitae imperdiet odio. Proin a nibh interdum magna porttitor sagittis. Fusce lacinia cursus lectus sit amet tristique. Sed vel tellus quis mauris convallis viverra quis vitae nibh. Ut rutrum, lectus non rutrum tempus, nunc enim volutpat lacus, id tempor nisi metus quis diam. Fusce nec dolor neque, in ultrices arcu. Fusce eros enim, vehicula vel hendrerit a, euismod vitae nulla.Consectetur adipiscing elit. Duis ullamcorper urna a odio pellentesque tincidunt. Pellentesque pharetra iaculis eros id molestie. Nam a libero sit amet leo malesuada lobortis. Vivamus mollis pellentesque condimentum. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p><p>Phasellus tellus velit, posuere et fringilla quis, sollicitudin at lectus. Proin et justo libero, vitae imperdiet odio. Proin a nibh interdum magna porttitor sagittis. Fusce lacinia cursus lectus sit amet tristique. Sed vel tellus quis mauris convallis viverra quis vitae nibh. Ut rutrum, lectus non rutrum tempus, nunc enim volutpat lacus, id tempor nisi metus quis diam. Fusce nec dolor neque, in ultrices arcu. Fusce eros enim, vehicula vel hendrerit a, euismod vitae nulla.Consectetur adipiscing elit. Duis ullamcorper urna a odio pellentesque tincidunt. Pellentesque pharetra iaculis eros id molestie. Nam a libero sit amet leo malesuada lobortis. Vivamus mollis pellentesque condimentum. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p><p>Phasellus tellus velit, posuere et fringilla quis, sollicitudin at lectus. Proin et justo libero, vitae imperdiet odio. Proin a nibh interdum magna porttitor sagittis. Fusce lacinia cursus lectus sit amet tristique. Sed vel tellus quis mauris convallis viverra quis vitae nibh. Ut rutrum, lectus non rutrum tempus, nunc enim volutpat lacus, id tempor nisi metus quis diam. Fusce nec dolor neque, in ultrices arcu. Fusce eros enim, vehicula vel hendrerit a, euismod vitae nulla.</p>  ','1000',6,7,'yes',NULL,NULL,NULL,'2011-05-31 04:06:41','2011-05-31 22:12:55'),(7,'demo-product-6','demo-product-6','products/glass.jpg;products/samsung.jpg','Consectetur adipiscing elit. Duis ullamcorper urna a odio pellentesque tincidunt. Pellentesque pharetra iaculis eros id molestie. Nam a libero sit amet leo malesuada lobortis. Vivamus mollis pellentesque condimentum. Lorem ipsum dolor sit amet, consectetur adipiscing elit.\r\nPhasellus tellus velit, posuere et fringilla quis, sollicitudin at lectus. Proin et justo libero, vitae imperdiet odio. Proin a nibh interdum magna porttitor sagittis. Fusce lacinia cursus lectus sit amet tristique. Sed vel tellus quis mauris convallis viverra quis vitae nibh. Ut rutrum, lectus non rutrum tempus, nunc enim volutpat lacus, id tempor nisi metus quis diam.  ','<p>Consectetur adipiscing elit. Duis ullamcorper urna a odio pellentesque tincidunt. Pellentesque pharetra iaculis eros id molestie. Nam a libero sit amet leo malesuada lobortis. Vivamus mollis pellentesque condimentum. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p><p>Phasellus tellus velit, posuere et fringilla quis, sollicitudin at lectus. Proin et justo libero, vitae imperdiet odio. Proin a nibh interdum magna porttitor sagittis. Fusce lacinia cursus lectus sit amet tristique. Sed vel tellus quis mauris convallis viverra quis vitae nibh. Ut rutrum, lectus non rutrum tempus, nunc enim volutpat lacus, id tempor nisi metus quis diam. Fusce nec dolor neque, in ultrices arcu. Fusce eros enim, vehicula vel hendrerit a, euismod vitae nulla.Consectetur adipiscing elit. Duis ullamcorper urna a odio pellentesque tincidunt. Pellentesque pharetra iaculis eros id molestie. Nam a libero sit amet leo malesuada lobortis. Vivamus mollis pellentesque condimentum. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p><p>Phasellus tellus velit, posuere et fringilla quis, sollicitudin at lectus. Proin et justo libero, vitae imperdiet odio. Proin a nibh interdum magna porttitor sagittis. Fusce lacinia cursus lectus sit amet tristique. Sed vel tellus quis mauris convallis viverra quis vitae nibh. Ut rutrum, lectus non rutrum tempus, nunc enim volutpat lacus, id tempor nisi metus quis diam. Fusce nec dolor neque, in ultrices arcu. Fusce eros enim, vehicula vel hendrerit a, euismod vitae nulla.Consectetur adipiscing elit. Duis ullamcorper urna a odio pellentesque tincidunt. Pellentesque pharetra iaculis eros id molestie. Nam a libero sit amet leo malesuada lobortis. Vivamus mollis pellentesque condimentum. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p><p>Phasellus tellus velit, posuere et fringilla quis, sollicitudin at lectus. Proin et justo libero, vitae imperdiet odio. Proin a nibh interdum magna porttitor sagittis. Fusce lacinia cursus lectus sit amet tristique. Sed vel tellus quis mauris convallis viverra quis vitae nibh. Ut rutrum, lectus non rutrum tempus, nunc enim volutpat lacus, id tempor nisi metus quis diam. Fusce nec dolor neque, in ultrices arcu. Fusce eros enim, vehicula vel hendrerit a, euismod vitae nulla.</p>  ','500',9,9,'yes',NULL,NULL,NULL,'2011-05-31 04:08:39','2011-05-31 22:13:02');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_name` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `protect` tinyint(3) unsigned DEFAULT NULL,
  `note` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Master Admin',1,NULL),(2,'Admin',1,NULL),(3,'Editor',1,NULL),(4,'User',1,NULL),(5,'Guest',1,NULL);
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sections`
--

DROP TABLE IF EXISTS `sections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sections` (
  `sec_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sec_name` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `sec_alias` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `sec_description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `sec_code` varchar(128) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `sec_tags` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `sec_publish` enum('yes','no') CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT 'yes',
  `sec_created` datetime DEFAULT NULL,
  `sec_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`sec_id`),
  UNIQUE KEY `sec_name_UNIQUE` (`sec_name`),
  UNIQUE KEY `sec_code_UNIQUE` (`sec_code`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sections`
--

LOCK TABLES `sections` WRITE;
/*!40000 ALTER TABLE `sections` DISABLE KEYS */;
INSERT INTO `sections` VALUES (2,'test-sec-1',NULL,'desc-1','test-code-1','tag-1','yes','2011-05-28 15:28:12','2011-05-28 16:21:56'),(3,'test-sec-2',NULL,'desc-2','test-code-2','tag-2','yes','2011-05-28 15:28:28','2011-05-28 15:31:02'),(4,'test-sec-3',NULL,'desc-3','test-code-3','tag-3','yes','2011-05-28 15:28:43','2011-05-28 15:29:00');
/*!40000 ALTER TABLE `sections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `slide_groups`
--

DROP TABLE IF EXISTS `slide_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `slide_groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `animPause` int(10) unsigned DEFAULT NULL,
  `animDur` int(10) unsigned DEFAULT NULL,
  `animTypeI` enum('h','f') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `animTypeD` enum('h','f') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(3) unsigned DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `slide_groups`
--

LOCK TABLES `slide_groups` WRITE;
/*!40000 ALTER TABLE `slide_groups` DISABLE KEYS */;
INSERT INTO `slide_groups` VALUES (5,'Headlines',4000,500,'f','h',1),(6,'Top slide',4000,1000,'h','f',1),(7,'Big slide',4000,1000,'h','f',1);
/*!40000 ALTER TABLE `slide_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `slides`
--

DROP TABLE IF EXISTS `slides`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `slides` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `images` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `start` date DEFAULT NULL,
  `end` date DEFAULT '9999-12-31',
  `order` int(4) unsigned DEFAULT NULL,
  `group_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_slides_1` (`group_id`),
  CONSTRAINT `fk_slides_1` FOREIGN KEY (`group_id`) REFERENCES `slide_groups` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `slides`
--

LOCK TABLES `slides` WRITE;
/*!40000 ALTER TABLE `slides` DISABLE KEYS */;
INSERT INTO `slides` VALUES (1,'1Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore  ','','2011-06-01','2011-06-25',1,5),(2,'2Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore  ','','2011-06-01','2011-06-25',2,5),(3,'3Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore  ','','2011-06-01','2011-06-25',3,5),(5,'4Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore  ','','2011-06-01','2011-06-25',4,5),(6,'<div><strong style=\"color:#cc6666\">1Lorem ipsum</strong></div>1Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus tellus velit, posuere et fringilla quis, sollicitudin at lectus. Consectetur adipiscing elit. Duis ullamcorper urna a odio pellentesque tincidunt. Vivamus mollis pellentesque condimentum. Proin et justo libero, vitae imperdiet odio. Proin et justo libero, vitae imperdiet odio. Pellentesque pharetra iaculis eros id molestie. Nam a libero sit amet leo malesuada lobortis.  <div style=\"text-align:right\"><a href=\"#\">details</a></div>  ','','2011-06-01','2011-06-25',1,6),(7,'<div><strong style=\"color:#cc6666\">2Lorem ipsum</strong></div>2Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus tellus velit, posuere et fringilla quis, sollicitudin at lectus. Consectetur adipiscing elit. Duis ullamcorper urna a odio pellentesque tincidunt. Vivamus mollis pellentesque condimentum. Proin et justo libero, vitae imperdiet odio. Proin et justo libero, vitae imperdiet odio. Pellentesque pharetra iaculis eros id molestie. Nam a libero sit amet leo malesuada lobortis.  <div style=\"text-align:right\"><a href=\"#\">details</a></div>  ','','2011-06-01','2011-06-25',2,6),(8,'<div><strong style=\"color:#cc6666\">3Lorem ipsum</strong></div>3Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus tellus velit, posuere et fringilla quis, sollicitudin at lectus. Consectetur adipiscing elit. Duis ullamcorper urna a odio pellentesque tincidunt. Vivamus mollis pellentesque condimentum. Proin et justo libero, vitae imperdiet odio. Proin et justo libero, vitae imperdiet odio. Pellentesque pharetra iaculis eros id molestie. Nam a libero sit amet leo malesuada lobortis.  <div style=\"text-align:right\"><a href=\"#\">details</a></div>  ','','2011-06-01','2011-06-25',3,6),(9,'<div><strong style=\"color:#cc6666\">4Lorem ipsum</strong></div>4Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus tellus velit, posuere et fringilla quis, sollicitudin at lectus. Consectetur adipiscing elit. Duis ullamcorper urna a odio pellentesque tincidunt. Vivamus mollis pellentesque condimentum. Proin et justo libero, vitae imperdiet odio. Proin et justo libero, vitae imperdiet odio. Pellentesque pharetra iaculis eros id molestie. Nam a libero sit amet leo malesuada lobortis.  <div style=\"text-align:right\"><a href=\"#\">details</a></div>  ','','2011-06-01','2011-06-25',4,6),(10,'<div><strong style=\"color:#cc6666\">1Lorem ipsum</strong></div><div style=\"text-align:justify\">1Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus tellus velit, posuere et fringilla quis, sollicitudin at lectus. Consectetur adipiscing elit. Duis ullamcorper urna a odio pellentesque tincidunt. Vivamus mollis pellentesque condimentum. Proin et justo libero, vitae imperdiet odio. Proin et justo libero, vitae imperdiet odio. Pellentesque pharetra iaculis eros id molestie. Nam a libero sit amet leo malesuada lobortis  </div>  ','slides/1.png','2011-06-01','2011-06-25',1,7),(11,'<div><strong style=\"color:#cc6666\">2Lorem ipsum</strong></div>2Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus tellus velit, posuere et fringilla quis, sollicitudin at lectus. Consectetur adipiscing elit. Duis ullamcorper urna a odio pellentesque tincidunt. Vivamus mollis pellentesque condimentum. Proin et justo libero, vitae imperdiet odio. Proin et justo libero, vitae imperdiet odio. Pellentesque pharetra iaculis eros id molestie. Nam a libero sit amet leo malesuada lobortis  ','slides/2.png','2011-06-01','2011-06-25',2,7),(12,'<div><strong style=\"color:#cc6666\">3Lorem ipsum</strong></div><div style=\"text-align:justify\">3Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus tellus velit, posuere et fringilla quis, sollicitudin at lectus. Consectetur adipiscing elit. Duis ullamcorper urna a odio pellentesque tincidunt. Vivamus mollis pellentesque condimentum. Proin et justo libero, vitae imperdiet odio. Proin et justo libero, vitae imperdiet odio. Pellentesque pharetra iaculis eros id molestie. Nam a libero sit amet leo malesuada lobortis  </div>  ','slides/3.png','2011-06-01','2011-06-25',3,7),(13,'<div><strong style=\"color:#cc6666\">4Lorem ipsum</strong></div>4Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus tellus velit, posuere et fringilla quis, sollicitudin at lectus. Consectetur adipiscing elit. Duis ullamcorper urna a odio pellentesque tincidunt. Vivamus mollis pellentesque condimentum. Proin et justo libero, vitae imperdiet odio. Proin et justo libero, vitae imperdiet odio. Pellentesque pharetra iaculis eros id molestie. Nam a libero sit amet leo malesuada lobortis  ','slides/4.png','2011-06-01','2011-06-25',4,7);
/*!40000 ALTER TABLE `slides` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `firstname` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastname` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `company` varchar(256) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `location` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(128) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `password` varchar(128) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `registerdate` datetime DEFAULT NULL,
  `lastvisitdate` datetime DEFAULT NULL,
  `role_id` int(10) unsigned DEFAULT '4',
  `status` enum('active','inactive','awaiting','awaitingadmin','banned') CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `reg_ip` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `confirmcode` varchar(128) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username_UNIQUE` (`username`),
  UNIQUE KEY `confirmcode_UNIQUE` (`confirmcode`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  KEY `fk_users_1` (`role_id`),
  CONSTRAINT `fk_users_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Administrator',NULL,NULL,NULL,NULL,NULL,'2d68ec77c2cb1f452dc866639ad0ae8f',NULL,NULL,1,'active',NULL,NULL),(2,'demo-admin',NULL,NULL,NULL,NULL,NULL,'2d68ec77c2cb1f452dc866639ad0ae8f',NULL,NULL,2,'active',NULL,NULL),(3,'demo-editor',NULL,NULL,NULL,NULL,NULL,'2d68ec77c2cb1f452dc866639ad0ae8f',NULL,NULL,3,'active',NULL,NULL),(4,'demo-user',NULL,NULL,NULL,NULL,NULL,'2d68ec77c2cb1f452dc866639ad0ae8f',NULL,NULL,4,'active',NULL,NULL);
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

-- Dump completed on 2011-06-16 22:13:29
