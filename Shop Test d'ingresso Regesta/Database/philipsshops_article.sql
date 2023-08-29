-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: localhost    Database: philipsshops
-- ------------------------------------------------------
-- Server version	8.0.34

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `article`
--

DROP TABLE IF EXISTS `article`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `article` (
  `idArticle` int NOT NULL,
  `idSupplier` int DEFAULT NULL,
  `barcode` int DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `desc` varchar(45) DEFAULT NULL,
  `img_src` varchar(200) DEFAULT NULL,
  `date` varchar(45) DEFAULT NULL,
  `price` varchar(45) DEFAULT NULL,
  `quantity` varchar(45) DEFAULT NULL,
  `enable` varchar(45) DEFAULT NULL,
  `dt` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idArticle`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `article`
--

LOCK TABLES `article` WRITE;
/*!40000 ALTER TABLE `article` DISABLE KEYS */;
INSERT INTO `article` VALUES (1,1,555215,'OMEN PC','OMEN 45L GT22-1031nl Desktop con Intel® Core™','https://www.hp.com/it-it/shop/Html/Merch/Images/c08209914_1750x1285.jpg?imwidth=869','23/08/2023','120','98','1','1'),(2,2,555215,'OMEN PC','OMEN 45L GT22-1031nl Desktop con Intel® Core™','https://www.hp.com/it-it/shop/Html/Merch/Images/c08209914_1750x1285.jpg?imwidth=869','22/08/2023','128','13','1','1'),(3,3,555215,'OMEN PC','OMEN 45L GT22-1031nl Desktop con Intel® Core™','https://www.hp.com/it-it/shop/Html/Merch/Images/c08209914_1750x1285.jpg?imwidth=869','21/08/2023','129','23','1','1'),(4,1,635212,'Primacy 2 Stampante','Primacy 2 Schermo','https://www.omnitekstore.it/23385-large_default/Primacy-2-Doppio-Lato-300-dpi-USB-Ethernet-Scanner.jpg','23/08/2023','500','20','1','1'),(5,2,635212,'Primacy 2 Stampante','Primacy 2 Schermo','https://www.omnitekstore.it/23385-large_default/Primacy-2-Doppio-Lato-300-dpi-USB-Ethernet-Scanner.jpg','23/08/2023','600','30','1','1'),(6,3,635212,'Primacy 2 Stampante','Primacy 2 Schermo','https://www.omnitekstore.it/23385-large_default/Primacy-2-Doppio-Lato-300-dpi-USB-Ethernet-Scanner.jpg','23/08/2023','700','40','1','1'),(7,2,995324,'Monitor Gaming','Monitor Gaming','https://images.samsung.com/is/image/samsung/p6pim/it/lc34g55twwpxen/gallery/it-odyssey-g5-34g5-449680-lc34g55twwpxen-535118054?$1300_1038_PNG$','22/08/2023','399','50','1','1'),(8,3,995324,'Monitor Gaming','Monitor Gaming','https://images.samsung.com/is/image/samsung/p6pim/it/lc34g55twwpxen/gallery/it-odyssey-g5-34g5-449680-lc34g55twwpxen-535118054?$1300_1038_PNG$','22/08/2023','499','60','1','1');
/*!40000 ALTER TABLE `article` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-08-29 21:01:12
