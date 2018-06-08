-- MySQL dump 10.16  Distrib 10.1.26-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: mysql    Database: project
-- ------------------------------------------------------
-- Server version	5.5.60

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `couch_attachments`
--

DROP TABLE IF EXISTS `couch_attachments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `couch_attachments` (
  `attach_id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `file_real_name` varchar(255) NOT NULL,
  `file_disk_name` varchar(255) NOT NULL,
  `file_extension` varchar(255) NOT NULL,
  `file_size` int(20) unsigned NOT NULL DEFAULT '0',
  `file_time` int(10) unsigned NOT NULL DEFAULT '0',
  `is_orphan` tinyint(1) unsigned DEFAULT '1',
  `hit_count` int(10) unsigned DEFAULT '0',
  `creation_ip` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`attach_id`),
  KEY `couch_attachments_Index01` (`is_orphan`),
  KEY `couch_attachments_Index02` (`file_time`),
  KEY `couch_attachments_Index03` (`is_orphan`,`file_time`),
  KEY `couch_attachments_Index04` (`creation_ip`,`file_time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `couch_attachments`
--

LOCK TABLES `couch_attachments` WRITE;
/*!40000 ALTER TABLE `couch_attachments` DISABLE KEYS */;
/*!40000 ALTER TABLE `couch_attachments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `couch_comments`
--

DROP TABLE IF EXISTS `couch_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `couch_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tpl_id` int(11) NOT NULL,
  `page_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` tinytext,
  `email` varchar(128) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `ip_addr` varchar(100) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `data` text,
  `approved` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `couch_comments_Index01` (`date`),
  KEY `couch_comments_Index02` (`page_id`,`approved`,`date`),
  KEY `couch_comments_Index03` (`tpl_id`,`approved`,`date`),
  KEY `couch_comments_Index04` (`approved`,`date`),
  KEY `couch_comments_Index05` (`tpl_id`,`page_id`,`approved`,`date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `couch_comments`
--

LOCK TABLES `couch_comments` WRITE;
/*!40000 ALTER TABLE `couch_comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `couch_comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `couch_data_numeric`
--

DROP TABLE IF EXISTS `couch_data_numeric`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `couch_data_numeric` (
  `page_id` int(11) NOT NULL,
  `field_id` int(11) NOT NULL,
  `value` decimal(65,2) DEFAULT '0.00',
  PRIMARY KEY (`page_id`,`field_id`),
  KEY `couch_data_numeric_Index01` (`value`),
  KEY `couch_data_numeric_Index02` (`field_id`,`value`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `couch_data_numeric`
--

LOCK TABLES `couch_data_numeric` WRITE;
/*!40000 ALTER TABLE `couch_data_numeric` DISABLE KEYS */;
/*!40000 ALTER TABLE `couch_data_numeric` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `couch_data_text`
--

DROP TABLE IF EXISTS `couch_data_text`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `couch_data_text` (
  `page_id` int(11) NOT NULL,
  `field_id` int(11) NOT NULL,
  `value` longtext,
  `search_value` text,
  PRIMARY KEY (`page_id`,`field_id`),
  KEY `couch_data_text_Index01` (`search_value`(255)),
  KEY `couch_data_text_Index02` (`field_id`,`search_value`(255))
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `couch_data_text`
--

LOCK TABLES `couch_data_text` WRITE;
/*!40000 ALTER TABLE `couch_data_text` DISABLE KEYS */;
/*!40000 ALTER TABLE `couch_data_text` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `couch_fields`
--

DROP TABLE IF EXISTS `couch_fields`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `couch_fields` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `template_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `label` varchar(255) DEFAULT NULL,
  `k_desc` varchar(255) DEFAULT NULL,
  `k_type` varchar(128) NOT NULL,
  `hidden` int(1) DEFAULT NULL,
  `search_type` varchar(20) DEFAULT 'text',
  `k_order` int(11) DEFAULT NULL,
  `data` longtext,
  `default_data` longtext,
  `required` int(1) DEFAULT NULL,
  `deleted` int(1) DEFAULT NULL,
  `validator` varchar(255) DEFAULT NULL,
  `validator_msg` text,
  `k_separator` varchar(20) DEFAULT NULL,
  `val_separator` varchar(20) DEFAULT NULL,
  `opt_values` text,
  `opt_selected` tinytext,
  `toolbar` varchar(20) DEFAULT NULL,
  `custom_toolbar` text,
  `css` text,
  `custom_styles` text,
  `maxlength` int(11) DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `width` int(11) DEFAULT NULL,
  `k_group` varchar(128) DEFAULT NULL,
  `collapsed` int(1) DEFAULT '-1',
  `assoc_field` varchar(128) DEFAULT NULL,
  `crop` int(1) DEFAULT '0',
  `enforce_max` int(1) DEFAULT '1',
  `quality` int(11) DEFAULT NULL,
  `show_preview` int(1) DEFAULT '0',
  `preview_width` int(11) DEFAULT NULL,
  `preview_height` int(11) DEFAULT NULL,
  `no_xss_check` int(1) DEFAULT '0',
  `rtl` int(1) DEFAULT '0',
  `body_id` tinytext,
  `body_class` tinytext,
  `disable_uploader` int(1) DEFAULT '0',
  `_html` text COMMENT 'Internal',
  `dynamic` text,
  `custom_params` text,
  `searchable` int(1) DEFAULT '1',
  `class` tinytext,
  PRIMARY KEY (`id`),
  KEY `couch_fields_index01` (`k_group`,`k_order`,`id`),
  KEY `couch_fields_Index02` (`template_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `couch_fields`
--

LOCK TABLES `couch_fields` WRITE;
/*!40000 ALTER TABLE `couch_fields` DISABLE KEYS */;
/*!40000 ALTER TABLE `couch_fields` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `couch_folders`
--

DROP TABLE IF EXISTS `couch_folders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `couch_folders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) DEFAULT '-1',
  `template_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `k_desc` mediumtext,
  `image` text,
  `access_level` int(11) DEFAULT '0',
  `weight` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `couch_folders_Index02` (`template_id`,`name`),
  KEY `couch_folders_Index01` (`template_id`,`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `couch_folders`
--

LOCK TABLES `couch_folders` WRITE;
/*!40000 ALTER TABLE `couch_folders` DISABLE KEYS */;
/*!40000 ALTER TABLE `couch_folders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `couch_fulltext`
--

DROP TABLE IF EXISTS `couch_fulltext`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `couch_fulltext` (
  `page_id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` text,
  PRIMARY KEY (`page_id`),
  FULLTEXT KEY `couch_fulltext_Index01` (`title`),
  FULLTEXT KEY `couch_fulltext_Index02` (`content`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `couch_fulltext`
--

LOCK TABLES `couch_fulltext` WRITE;
/*!40000 ALTER TABLE `couch_fulltext` DISABLE KEYS */;
/*!40000 ALTER TABLE `couch_fulltext` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `couch_levels`
--

DROP TABLE IF EXISTS `couch_levels`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `couch_levels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `k_level` int(11) DEFAULT '0',
  `disabled` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `couch_levels_index01` (`k_level`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `couch_levels`
--

LOCK TABLES `couch_levels` WRITE;
/*!40000 ALTER TABLE `couch_levels` DISABLE KEYS */;
INSERT INTO `couch_levels` VALUES (1,'superadmin','Super Admin',10,0),(2,'admin','Administrator',7,0),(3,'authenticated_user_special','Authenticated User (Special)',4,0),(4,'authenitcated_user','Authenticated User',2,0),(5,'unauthenticated_user','Everybody',0,0);
/*!40000 ALTER TABLE `couch_levels` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `couch_pages`
--

DROP TABLE IF EXISTS `couch_pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `couch_pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `template_id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT '0',
  `page_title` varchar(255) DEFAULT NULL,
  `page_name` varchar(255) DEFAULT NULL,
  `creation_date` datetime DEFAULT '0000-00-00 00:00:00',
  `modification_date` datetime DEFAULT '0000-00-00 00:00:00',
  `publish_date` datetime DEFAULT '0000-00-00 00:00:00',
  `status` int(11) DEFAULT NULL,
  `is_master` int(1) DEFAULT '0',
  `page_folder_id` int(11) DEFAULT '-1',
  `access_level` int(11) DEFAULT '0',
  `comments_count` int(11) DEFAULT '0',
  `comments_open` int(1) DEFAULT '1',
  `nested_parent_id` int(11) DEFAULT '-1',
  `weight` int(11) DEFAULT '0',
  `show_in_menu` int(1) DEFAULT '1',
  `menu_text` varchar(255) DEFAULT NULL,
  `is_pointer` int(1) DEFAULT '0',
  `pointer_link` text,
  `pointer_link_detail` text,
  `open_external` int(1) DEFAULT '0',
  `masquerades` int(1) DEFAULT '0',
  `strict_matching` int(1) DEFAULT '0',
  `file_name` varchar(260) DEFAULT NULL,
  `file_ext` varchar(20) DEFAULT NULL,
  `file_size` int(11) DEFAULT '0',
  `file_meta` text,
  `creation_IP` varchar(45) DEFAULT NULL,
  `k_order` int(11) DEFAULT '0',
  `ref_count` int(11) DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `couch_pages_Index03` (`template_id`,`page_name`),
  KEY `couch_pages_Index01` (`template_id`,`publish_date`),
  KEY `couch_pages_Index02` (`template_id`,`page_folder_id`,`publish_date`),
  KEY `couch_pages_Index04` (`template_id`,`modification_date`),
  KEY `couch_pages_Index05` (`template_id`,`page_folder_id`,`modification_date`),
  KEY `couch_pages_Index06` (`template_id`,`page_folder_id`,`page_name`),
  KEY `couch_pages_Index07` (`template_id`,`comments_count`),
  KEY `couch_pages_Index08` (`template_id`,`page_title`),
  KEY `couch_pages_Index09` (`template_id`,`page_folder_id`,`page_title`),
  KEY `couch_pages_Index10` (`template_id`,`page_folder_id`,`comments_count`),
  KEY `couch_pages_Index11` (`template_id`,`parent_id`,`modification_date`),
  KEY `couch_pages_Index12` (`parent_id`,`modification_date`),
  KEY `couch_pages_Index13` (`template_id`,`is_pointer`,`masquerades`,`pointer_link_detail`(255)),
  KEY `couch_pages_Index14` (`template_id`,`file_name`(255)),
  KEY `couch_pages_Index15` (`template_id`,`page_folder_id`,`file_name`(255)),
  KEY `couch_pages_Index16` (`template_id`,`file_ext`,`file_name`(255)),
  KEY `couch_pages_Index17` (`template_id`,`page_folder_id`,`file_ext`,`file_name`(255)),
  KEY `couch_pages_Index18` (`template_id`,`file_size`),
  KEY `couch_pages_Index19` (`template_id`,`page_folder_id`,`file_size`),
  KEY `couch_pages_Index20` (`creation_IP`,`creation_date`),
  KEY `couch_pages_index21` (`template_id`,`k_order`),
  KEY `couch_pages_index22` (`template_id`,`page_folder_id`,`k_order`),
  KEY `couch_pages_index23` (`k_order`),
  KEY `couch_pages_Index24` (`status`,`ref_count`,`modification_date`),
  KEY `couch_pages_index25` (`template_id`,`parent_id`,`publish_date`),
  KEY `couch_pages_index26` (`template_id`,`parent_id`,`page_name`),
  KEY `couch_pages_index27` (`template_id`,`parent_id`,`page_title`),
  KEY `couch_pages_index28` (`template_id`,`parent_id`,`modification_date`),
  KEY `couch_pages_index29` (`template_id`,`parent_id`,`comments_count`),
  KEY `couch_pages_index30` (`template_id`,`parent_id`,`file_name`(255)),
  KEY `couch_pages_index31` (`template_id`,`parent_id`,`file_ext`,`file_name`(255)),
  KEY `couch_pages_index32` (`template_id`,`parent_id`,`file_size`),
  KEY `couch_pages_index33` (`template_id`,`parent_id`,`k_order`),
  KEY `couch_pages_index34` (`template_id`,`parent_id`,`page_folder_id`,`publish_date`),
  KEY `couch_pages_index35` (`template_id`,`parent_id`,`page_folder_id`,`page_name`),
  KEY `couch_pages_index36` (`template_id`,`parent_id`,`page_folder_id`,`page_title`),
  KEY `couch_pages_index37` (`template_id`,`parent_id`,`page_folder_id`,`modification_date`),
  KEY `couch_pages_index38` (`template_id`,`parent_id`,`page_folder_id`,`comments_count`),
  KEY `couch_pages_index39` (`template_id`,`parent_id`,`page_folder_id`,`file_name`(255)),
  KEY `couch_pages_index40` (`template_id`,`parent_id`,`page_folder_id`,`file_ext`,`file_name`(255)),
  KEY `couch_pages_index41` (`template_id`,`parent_id`,`page_folder_id`,`file_size`),
  KEY `couch_pages_index42` (`template_id`,`parent_id`,`page_folder_id`,`k_order`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `couch_pages`
--

LOCK TABLES `couch_pages` WRITE;
/*!40000 ALTER TABLE `couch_pages` DISABLE KEYS */;
/*!40000 ALTER TABLE `couch_pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `couch_relations`
--

DROP TABLE IF EXISTS `couch_relations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `couch_relations` (
  `pid` int(11) NOT NULL,
  `fid` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `weight` int(11) DEFAULT '0',
  PRIMARY KEY (`pid`,`fid`,`cid`),
  KEY `couch_relations_Index01` (`pid`,`fid`,`weight`),
  KEY `couch_relations_Index02` (`fid`,`cid`,`weight`),
  KEY `couch_relations_Index03` (`cid`,`fid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `couch_relations`
--

LOCK TABLES `couch_relations` WRITE;
/*!40000 ALTER TABLE `couch_relations` DISABLE KEYS */;
/*!40000 ALTER TABLE `couch_relations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `couch_settings`
--

DROP TABLE IF EXISTS `couch_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `couch_settings` (
  `k_key` varchar(255) NOT NULL,
  `k_value` longtext,
  PRIMARY KEY (`k_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `couch_settings`
--

LOCK TABLES `couch_settings` WRITE;
/*!40000 ALTER TABLE `couch_settings` DISABLE KEYS */;
INSERT INTO `couch_settings` VALUES ('k_couch_version','2.1'),('secret_key','J8JwcI0MoS1wVEmNpfOgw92DZRKKrCKBaTxN2Y0QgrMCvzQle41bDue2LocDqnE1');
/*!40000 ALTER TABLE `couch_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `couch_templates`
--

DROP TABLE IF EXISTS `couch_templates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `couch_templates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `clonable` int(1) DEFAULT '0',
  `executable` int(1) DEFAULT '1',
  `title` varchar(255) DEFAULT NULL,
  `access_level` int(11) DEFAULT '0',
  `commentable` int(1) DEFAULT '0',
  `hidden` int(1) DEFAULT '0',
  `k_order` int(11) DEFAULT '0',
  `dynamic_folders` int(1) DEFAULT '0',
  `nested_pages` int(1) DEFAULT '0',
  `gallery` int(1) DEFAULT '0',
  `handler` text,
  `custom_params` text,
  `type` varchar(255) DEFAULT NULL,
  `config_list` text,
  `config_form` text,
  `parent` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `deleted` int(1) DEFAULT '0',
  `has_globals` int(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `couch_templates_Index01` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `couch_templates`
--

LOCK TABLES `couch_templates` WRITE;
/*!40000 ALTER TABLE `couch_templates` DISABLE KEYS */;
/*!40000 ALTER TABLE `couch_templates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `couch_users`
--

DROP TABLE IF EXISTS `couch_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `couch_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `password` varchar(64) NOT NULL,
  `email` varchar(128) NOT NULL,
  `activation_key` varchar(64) DEFAULT NULL,
  `password_reset_key` varchar(64) DEFAULT NULL,
  `registration_date` datetime DEFAULT NULL,
  `access_level` int(11) DEFAULT '0',
  `disabled` int(11) DEFAULT '0',
  `system` int(11) DEFAULT '0',
  `last_failed` bigint(11) DEFAULT '0',
  `failed_logins` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `couch_users_email` (`email`),
  UNIQUE KEY `couch_users_name` (`name`),
  KEY `couch_users_activation_key` (`activation_key`),
  KEY `couch_users_password_reset_key` (`password_reset_key`),
  KEY `couch_users_index01` (`access_level`),
  KEY `couch_users_index02` (`access_level`,`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `couch_users`
--

LOCK TABLES `couch_users` WRITE;
/*!40000 ALTER TABLE `couch_users` DISABLE KEYS */;
INSERT INTO `couch_users` VALUES (1,'admin','admin','$P$Bh528kzzp61H9VAYIblY9E76jHgtgu1','admin@local.host','','','2018-06-08 16:40:06',10,0,1,0,0);
/*!40000 ALTER TABLE `couch_users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-06-08 11:11:35
