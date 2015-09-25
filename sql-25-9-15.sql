CREATE DATABASE  IF NOT EXISTS `tourizm` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `tourizm`;
-- MySQL dump 10.13  Distrib 5.6.13, for Win32 (x86)
--
-- Host: 127.0.0.1    Database: tourizm
-- ------------------------------------------------------
-- Server version	5.6.16

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
-- Table structure for table `destinations`
--

DROP TABLE IF EXISTS `destinations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `destinations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `price` int(11) DEFAULT NULL,
  `total_quota` int(11) DEFAULT NULL,
  `date_from` datetime DEFAULT NULL,
  `date_to` datetime DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `destinations`
--

LOCK TABLES `destinations` WRITE;
/*!40000 ALTER TABLE `destinations` DISABLE KEYS */;
INSERT INTO `destinations` VALUES (2,'Francuska - Pariz','Quisque eu facilisis enim. Ut semper est eget aliquet blandit. In a purus ut dui faucibus placerat sit amet eu leo. Morbi eu diam sollicitudin, lacinia ipsum et, sodales lectus. Pellentesque eleifend ipsum in augue fringilla auctor. Praesent facilisis feugiat sem eu dapibus. Nunc aliquet, nulla sed vulputate aliquam, sem ante ornare diam, sit amet ornare velit erat vitae nisl. Curabitur tincidunt leo nec turpis aliquet, vel tincidunt lorem efficitur. Donec a accumsan sem. Aenean ex enim, vestibulum a nisl eu, efficitur rutrum arcu. Fusce pellentesque eros mollis odio placerat pulvinar. Duis bibendum nec arcu in tincidunt. Quisque sollicitudin turpis ac dictum porta. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Integer euismod condimentum arcu, ac sodales est tincidunt sed.\r\n\r\nNam quis quam vel arcu aliquet aliquet. Integer purus nulla, congue in ullamcorper id, ultricies ut mi. Nulla velit dolor, pellentesque eu tellus quis, finibus condimentum tortor. Nullam aliquam sed arcu ac auctor. Phasellus volutpat massa ex, non pulvinar neque pharetra et. Nulla placerat ligula ut hendrerit congue. Donec ut dui dolor. Donec eu pretium arcu, ut aliquet turpis. Ut vitae nunc nec felis interdum tincidunt vitae dictum mauris. Mauris et orci eget urna faucibus fringilla quis eu urna. Pellentesque venenatis dapibus neque, et auctor sapien posuere in. Pellentesque porttitor convallis velit nec suscipit. Nulla nec sem massa. Vivamus vehicula tortor ac neque eleifend mollis. Pellentesque ut lacinia leo.',10023,6,'2015-09-01 00:00:00','2015-09-10 00:00:00','Paris.jpg'),(3,'Italija - Rim 10 dana','Nam quis quam vel arcu aliquet aliquet. Integer purus nulla, congue in ullamcorper id, ultricies ut mi. Nulla velit dolor, pellentesque eu tellus quis, finibus condimentum tortor. Nullam aliquam sed arcu ac auctor. Phasellus volutpat massa ex, non pulvinar neque pharetra et. Nulla placerat ligula ut hendrerit congue. Donec ut dui dolor. Donec eu pretium arcu, ut aliquet turpis. Ut vitae nunc nec felis interdum tincidunt vitae dictum mauris. Mauris et orci eget urna faucibus fringilla quis eu urna. Pellentesque venenatis dapibus neque, et auctor sapien posuere in. Pellentesque porttitor convallis velit nec suscipit. Nulla nec sem massa. Vivamus vehicula tortor ac neque eleifend mollis. Pellentesque ut lacinia leo.\r\n\r\nMorbi orci quam, rhoncus vel mauris sit amet, faucibus sodales eros. Donec non lacus vehicula, varius massa in, dictum sem. Curabitur fringilla nulla quis hendrerit porttitor. Vestibulum semper massa nec purus varius convallis. Pellentesque ullamcorper turpis ac luctus ultrices. Ut justo massa, varius nec egestas eget, accumsan quis ex. Morbi accumsan molestie arcu, id porttitor risus porttitor eget. Pellentesque eget fringilla ipsum. Curabitur fringilla, libero a eleifend vehicula, sapien felis posuere lacus, tristique ullamcorper ipsum dolor et tellus. Ut posuere lacus at sodales semper. In hac habitasse platea dictumst. Proin pharetra turpis vel elementum posuere.',10000,10,'2015-09-08 00:00:00','2015-09-18 00:00:00','rometravelguide5.jpg'),(4,'Daleke destinacije - Karibi','Nam quis quam vel arcu aliquet aliquet. Integer purus nulla, congue in ullamcorper id, ultricies ut mi. Nulla velit dolor, pellentesque eu tellus quis, finibus condimentum tortor. Nullam aliquam sed arcu ac auctor. Phasellus volutpat massa ex, non pulvinar neque pharetra et. Nulla placerat ligula ut hendrerit congue. Donec ut dui dolor. Donec eu pretium arcu, ut aliquet turpis. Ut vitae nunc nec felis interdum tincidunt vitae dictum mauris. Mauris et orci eget urna faucibus fringilla quis eu urna. Pellentesque venenatis dapibus neque, et auctor sapien posuere in. Pellentesque porttitor convallis velit nec suscipit. Nulla nec sem massa. Vivamus vehicula tortor ac neque eleifend mollis. Pellentesque ut lacinia leo.\r\n\r\nMorbi orci quam, rhoncus vel mauris sit amet, faucibus sodales eros. Donec non lacus vehicula, varius massa in, dictum sem. Curabitur fringilla nulla quis hendrerit porttitor. Vestibulum semper massa nec purus varius convallis. Pellentesque ullamcorper turpis ac luctus ultrices. Ut justo massa, varius nec egestas eget, accumsan quis ex. Morbi accumsan molestie arcu, id porttitor risus porttitor eget. Pellentesque eget fringilla ipsum. Curabitur fringilla, libero a eleifend vehicula, sapien felis posuere lacus, tristique ullamcorper ipsum dolor et tellus. Ut posuere lacus at sodales semper. In hac habitasse platea dictumst. Proin pharetra turpis vel elementum posuere.',9999999,4,'2015-09-04 00:00:00','2015-09-14 00:00:00','kibi.jpg'),(5,'Japan - Tokio','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi odio quam, posuere ac odio sed, pellentesque posuere ante. Sed in augue feugiat, commodo ante ac, cursus ligula. Curabitur dui ligula, bibendum a elementum at, interdum imperdiet ante. Quisque fermentum convallis lobortis. Nullam dignissim scelerisque ante, non efficitur neque. Nulla a nibh vitae nisi volutpat pulvinar. Ut elementum nec enim in fringilla. Donec eget purus tempus orci condimentum ullamcorper.\r\n\r\nAenean quis viverra massa. Curabitur quis sapien eu urna mollis fermentum sit amet ac turpis. Fusce vitae ante ultricies, ullamcorper purus at, tincidunt libero. Pellentesque quis convallis augue, ut pulvinar justo. Aliquam tincidunt ut nisl id commodo. Sed elementum, mauris vitae laoreet dictum, libero lacus eleifend justo, non mollis erat lorem eget magna. Suspendisse porttitor diam ante, sit amet pretium nisi dictum ut. Maecenas eleifend nec nunc in fringilla. Cras efficitur velit eu arcu sollicitudin, ac suscipit nisl laoreet. Ut ligula nulla, fermentum a elementum quis, euismod vel justo. Curabitur maximus augue dolor.',230000,14,'2015-09-03 00:00:00','2015-09-13 00:00:00','tokyo-1.jpg'),(6,'Opustena varijanta - Jamajka','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi odio quam, posuere ac odio sed, pellentesque posuere ante. Sed in augue feugiat, commodo ante ac, cursus ligula. Curabitur dui ligula, bibendum a elementum at, interdum imperdiet ante. Quisque fermentum convallis lobortis. Nullam dignissim scelerisque ante, non efficitur neque. Nulla a nibh vitae nisi volutpat pulvinar. Ut elementum nec enim in fringilla. Donec eget purus tempus orci condimentum ullamcorper.\r\n\r\nAenean quis viverra massa. Curabitur quis sapien eu urna mollis fermentum sit amet ac turpis. Fusce vitae ante ultricies, ullamcorper purus at, tincidunt libero. Pellentesque quis convallis augue, ut pulvinar justo. Aliquam tincidunt ut nisl id commodo. Sed elementum, mauris vitae laoreet dictum, libero lacus eleifend justo, non mollis erat lorem eget magna. Suspendisse porttitor diam ante, sit amet pretium nisi dictum ut. Maecenas eleifend nec nunc in fringilla. Cras efficitur velit eu arcu sollicitudin, ac suscipit nisl laoreet. Ut ligula nulla, fermentum a elementum quis, euismod vel justo. Curabitur maximus augue dolor.',234445,4,'2015-09-06 00:00:00','2015-09-23 13:20:34','images.jpg');
/*!40000 ALTER TABLE `destinations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reservations`
--

DROP TABLE IF EXISTS `reservations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reservations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `destination_id` int(11) DEFAULT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `customer_email` varchar(255) DEFAULT NULL,
  `customer_phone` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservations`
--

LOCK TABLES `reservations` WRITE;
/*!40000 ALTER TABLE `reservations` DISABLE KEYS */;
INSERT INTO `reservations` VALUES (1,2,'Milos','milos@primer.rs',NULL),(2,6,'Milos','milos@primer.rs','111222'),(3,6,'Pera','pera@peric.rs','123456'),(4,6,'asda','milos@primer.rs','asd'),(7,5,'Milos','milos@primer.rs','123456');
/*!40000 ALTER TABLE `reservations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','1a1dc91c907325c69271ddf0c944bc72');
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

-- Dump completed on 2015-09-25 16:11:22
