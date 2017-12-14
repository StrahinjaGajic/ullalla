-- MySQL dump 10.13  Distrib 5.7.18, for Linux (x86_64)
--
-- Host: localhost    Database: ullalla
-- ------------------------------------------------------
-- Server version	5.7.18-0ubuntu0.16.04.1

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
-- Table structure for table `cantons`
--

DROP TABLE IF EXISTS `cantons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cantons` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `canton_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cantons`
--

LOCK TABLES `cantons` WRITE;
/*!40000 ALTER TABLE `cantons` DISABLE KEYS */;
INSERT INTO `cantons` VALUES (1,'Zürich'),(2,'Bern'),(3,'Luzern'),(4,'Uri'),(5,'Schwyz'),(6,'Obwalden'),(7,'Nidwalden'),(8,'Glarus'),(9,'Zug'),(10,'Fribourg'),(11,'Solothurn'),(12,'Basel-Stadt'),(13,'Basel-Landschaft'),(14,'Schaffhausen'),(15,'Appenzell Ausserrhoden'),(16,'Appenzell Innerrhoden'),(17,'St. Gallen'),(18,'Graubünden'),(19,'Aargau'),(20,'Thurgau'),(21,'Ticino'),(22,'Vaud'),(23,'Valais'),(24,'Neuchâtel'),(25,'Geneva'),(26,'Jura');
/*!40000 ALTER TABLE `cantons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clubs_info`
--

DROP TABLE IF EXISTS `clubs_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clubs_info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` int(11) NOT NULL,
  `free` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clubs_info`
--

LOCK TABLES `clubs_info` WRITE;
/*!40000 ALTER TABLE `clubs_info` DISABLE KEYS */;
/*!40000 ALTER TABLE `clubs_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact_options`
--

DROP TABLE IF EXISTS `contact_options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contact_options` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `contact_option_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact_options`
--

LOCK TABLES `contact_options` WRITE;
/*!40000 ALTER TABLE `contact_options` DISABLE KEYS */;
INSERT INTO `contact_options` VALUES (1,'viber'),(2,'whatsapp'),(3,'skype');
/*!40000 ALTER TABLE `contact_options` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `countries`
--

LOCK TABLES `countries` WRITE;
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
INSERT INTO `countries` VALUES (4,'Kabul','Afghan','004','afghani','AFN','pul','؋',2,'Islamic Republic of Afghanistan','AF','AFG','Afghanistan','142','034',0,'93','AF.png'),(8,'Tirana','Albanian','008','lek','ALL','(qindar (pl. qindarka))','Lek',2,'Republic of Albania','AL','ALB','Albania','150','039',0,'355','AL.png'),(10,'Antartica','of Antartica','010','','','','',2,'Antarctica','AQ','ATA','Antarctica','','',0,'672','AQ.png'),(12,'Algiers','Algerian','012','Algerian dinar','DZD','centime','DZD',2,'People’s Democratic Republic of Algeria','DZ','DZA','Algeria','002','015',0,'213','DZ.png'),(16,'Pago Pago','American Samoan','016','US dollar','USD','cent','$',2,'Territory of American','AS','ASM','American Samoa','009','061',0,'1','AS.png'),(20,'Andorra la Vella','Andorran','020','euro','EUR','cent','€',2,'Principality of Andorra','AD','AND','Andorra','150','039',0,'376','AD.png'),(24,'Luanda','Angolan','024','kwanza','AOA','cêntimo','Kz',2,'Republic of Angola','AO','AGO','Angola','002','017',0,'244','AO.png'),(28,'St John’s','of Antigua and Barbuda','028','East Caribbean dollar','XCD','cent','$',2,'Antigua and Barbuda','AG','ATG','Antigua and Barbuda','019','029',0,'1','AG.png'),(31,'Baku','Azerbaijani','031','Azerbaijani manat','AZN','kepik (inv.)','ман',2,'Republic of Azerbaijan','AZ','AZE','Azerbaijan','142','145',0,'994','AZ.png'),(32,'Buenos Aires','Argentinian','032','Argentine peso','ARS','centavo','$',2,'Argentine Republic','AR','ARG','Argentina','019','005',0,'54','AR.png'),(36,'Canberra','Australian','036','Australian dollar','AUD','cent','$',2,'Commonwealth of Australia','AU','AUS','Australia','009','053',0,'61','AU.png'),(40,'Vienna','Austrian','040','euro','EUR','cent','€',2,'Republic of Austria','AT','AUT','Austria','150','155',1,'43','AT.png'),(44,'Nassau','Bahamian','044','Bahamian dollar','BSD','cent','$',2,'Commonwealth of the Bahamas','BS','BHS','Bahamas','019','029',0,'1','BS.png'),(48,'Manama','Bahraini','048','Bahraini dinar','BHD','fils (inv.)','BHD',3,'Kingdom of Bahrain','BH','BHR','Bahrain','142','145',0,'973','BH.png'),(50,'Dhaka','Bangladeshi','050','taka (inv.)','BDT','poisha (inv.)','BDT',2,'People’s Republic of Bangladesh','BD','BGD','Bangladesh','142','034',0,'880','BD.png'),(51,'Yerevan','Armenian','051','dram (inv.)','AMD','luma','AMD',2,'Republic of Armenia','AM','ARM','Armenia','142','145',0,'374','AM.png'),(52,'Bridgetown','Barbadian','052','Barbados dollar','BBD','cent','$',2,'Barbados','BB','BRB','Barbados','019','029',0,'1','BB.png'),(56,'Brussels','Belgian','056','euro','EUR','cent','€',2,'Kingdom of Belgium','BE','BEL','Belgium','150','155',1,'32','BE.png'),(60,'Hamilton','Bermudian','060','Bermuda dollar','BMD','cent','$',2,'Bermuda','BM','BMU','Bermuda','019','021',0,'1','BM.png'),(64,'Thimphu','Bhutanese','064','ngultrum (inv.)','BTN','chhetrum (inv.)','BTN',2,'Kingdom of Bhutan','BT','BTN','Bhutan','142','034',0,'975','BT.png'),(68,'Sucre (BO1)','Bolivian','068','boliviano','BOB','centavo','$b',2,'Plurinational State of Bolivia','BO','BOL','Bolivia, Plurinational State of','019','005',0,'591','BO.png'),(70,'Sarajevo','of Bosnia and Herzegovina','070','convertible mark','BAM','fening','KM',2,'Bosnia and Herzegovina','BA','BIH','Bosnia and Herzegovina','150','039',0,'387','BA.png'),(72,'Gaborone','Botswanan','072','pula (inv.)','BWP','thebe (inv.)','P',2,'Republic of Botswana','BW','BWA','Botswana','002','018',0,'267','BW.png'),(74,'Bouvet island','of Bouvet island','074','','','','kr',2,'Bouvet Island','BV','BVT','Bouvet Island','','',0,'47','BV.png'),(76,'Brasilia','Brazilian','076','real (pl. reais)','BRL','centavo','R$',2,'Federative Republic of Brazil','BR','BRA','Brazil','019','005',0,'55','BR.png'),(84,'Belmopan','Belizean','084','Belize dollar','BZD','cent','BZ$',2,'Belize','BZ','BLZ','Belize','019','013',0,'501','BZ.png'),(86,'Diego Garcia','Changosian','086','US dollar','USD','cent','$',2,'British Indian Ocean Territory','IO','IOT','British Indian Ocean Territory','','',0,'246','IO.png'),(90,'Honiara','Solomon Islander','090','Solomon Islands dollar','SBD','cent','$',2,'Solomon Islands','SB','SLB','Solomon Islands','009','054',0,'677','SB.png'),(92,'Road Town','British Virgin Islander;','092','US dollar','USD','cent','$',2,'British Virgin Islands','VG','VGB','Virgin Islands, British','019','029',0,'1','VG.png'),(96,'Bandar Seri Begawan','Bruneian','096','Brunei dollar','BND','sen (inv.)','$',2,'Brunei Darussalam','BN','BRN','Brunei Darussalam','142','035',0,'673','BN.png'),(100,'Sofia','Bulgarian','100','lev (pl. leva)','BGN','stotinka','лв',2,'Republic of Bulgaria','BG','BGR','Bulgaria','150','151',1,'359','BG.png'),(104,'Yangon','Burmese','104','kyat','MMK','pya','K',2,'Union of Myanmar/','MM','MMR','Myanmar','142','035',0,'95','MM.png'),(108,'Bujumbura','Burundian','108','Burundi franc','BIF','centime','BIF',0,'Republic of Burundi','BI','BDI','Burundi','002','014',0,'257','BI.png'),(112,'Minsk','Belarusian','112','Belarusian rouble','BYR','kopek','p.',2,'Republic of Belarus','BY','BLR','Belarus','150','151',0,'375','BY.png'),(116,'Phnom Penh','Cambodian','116','riel','KHR','sen (inv.)','៛',2,'Kingdom of Cambodia','KH','KHM','Cambodia','142','035',0,'855','KH.png'),(120,'Yaoundé','Cameroonian','120','CFA franc (BEAC)','XAF','centime','FCF',0,'Republic of Cameroon','CM','CMR','Cameroon','002','017',0,'237','CM.png'),(124,'Ottawa','Canadian','124','Canadian dollar','CAD','cent','$',2,'Canada','CA','CAN','Canada','019','021',0,'1','CA.png'),(132,'Praia','Cape Verdean','132','Cape Verde escudo','CVE','centavo','CVE',2,'Republic of Cape Verde','CV','CPV','Cape Verde','002','011',0,'238','CV.png'),(136,'George Town','Caymanian','136','Cayman Islands dollar','KYD','cent','$',2,'Cayman Islands','KY','CYM','Cayman Islands','019','029',0,'1','KY.png'),(140,'Bangui','Central African','140','CFA franc (BEAC)','XAF','centime','CFA',0,'Central African Republic','CF','CAF','Central African Republic','002','017',0,'236','CF.png'),(144,'Colombo','Sri Lankan','144','Sri Lankan rupee','LKR','cent','₨',2,'Democratic Socialist Republic of Sri Lanka','LK','LKA','Sri Lanka','142','034',0,'94','LK.png'),(148,'N’Djamena','Chadian','148','CFA franc (BEAC)','XAF','centime','XAF',0,'Republic of Chad','TD','TCD','Chad','002','017',0,'235','TD.png'),(152,'Santiago','Chilean','152','Chilean peso','CLP','centavo','CLP',0,'Republic of Chile','CL','CHL','Chile','019','005',0,'56','CL.png'),(156,'Beijing','Chinese','156','renminbi-yuan (inv.)','CNY','jiao (10)','¥',2,'People’s Republic of China','CN','CHN','China','142','030',0,'86','CN.png'),(158,'Taipei','Taiwanese','158','new Taiwan dollar','TWD','fen (inv.)','NT$',2,'Republic of China, Taiwan (TW1)','TW','TWN','Taiwan, Province of China','142','030',0,'886','TW.png'),(162,'Flying Fish Cove','Christmas Islander','162','Australian dollar','AUD','cent','$',2,'Christmas Island Territory','CX','CXR','Christmas Island','','',0,'61','CX.png'),(166,'Bantam','Cocos Islander','166','Australian dollar','AUD','cent','$',2,'Territory of Cocos (Keeling) Islands','CC','CCK','Cocos (Keeling) Islands','','',0,'61','CC.png'),(170,'Santa Fe de Bogotá','Colombian','170','Colombian peso','COP','centavo','$',2,'Republic of Colombia','CO','COL','Colombia','019','005',0,'57','CO.png'),(174,'Moroni','Comorian','174','Comorian franc','KMF','','KMF',0,'Union of the Comoros','KM','COM','Comoros','002','014',0,'269','KM.png'),(175,'Mamoudzou','Mahorais','175','euro','EUR','cent','€',2,'Departmental Collectivity of Mayotte','YT','MYT','Mayotte','002','014',0,'262','YT.png'),(178,'Brazzaville','Congolese','178','CFA franc (BEAC)','XAF','centime','FCF',0,'Republic of the Congo','CG','COG','Congo','002','017',0,'242','CG.png'),(180,'Kinshasa','Congolese','180','Congolese franc','CDF','centime','CDF',2,'Democratic Republic of the Congo','CD','COD','Congo, the Democratic Republic of the','002','017',0,'243','CD.png'),(184,'Avarua','Cook Islander','184','New Zealand dollar','NZD','cent','$',2,'Cook Islands','CK','COK','Cook Islands','009','061',0,'682','CK.png'),(188,'San José','Costa Rican','188','Costa Rican colón (pl. colones)','CRC','céntimo','₡',2,'Republic of Costa Rica','CR','CRI','Costa Rica','019','013',0,'506','CR.png'),(191,'Zagreb','Croatian','191','kuna (inv.)','HRK','lipa (inv.)','kn',2,'Republic of Croatia','HR','HRV','Croatia','150','039',1,'385','HR.png'),(192,'Havana','Cuban','192','Cuban peso','CUP','centavo','₱',2,'Republic of Cuba','CU','CUB','Cuba','019','029',0,'53','CU.png'),(196,'Nicosia','Cypriot','196','euro','EUR','cent','CYP',2,'Republic of Cyprus','CY','CYP','Cyprus','142','145',1,'357','CY.png'),(203,'Prague','Czech','203','Czech koruna (pl. koruny)','CZK','halér','Kč',2,'Czech Republic','CZ','CZE','Czech Republic','150','151',1,'420','CZ.png'),(204,'Porto Novo (BJ1)','Beninese','204','CFA franc (BCEAO)','XOF','centime','XOF',0,'Republic of Benin','BJ','BEN','Benin','002','011',0,'229','BJ.png'),(208,'Copenhagen','Danish','208','Danish krone','DKK','øre (inv.)','kr',2,'Kingdom of Denmark','DK','DNK','Denmark','150','154',1,'45','DK.png'),(212,'Roseau','Dominican','212','East Caribbean dollar','XCD','cent','$',2,'Commonwealth of Dominica','DM','DMA','Dominica','019','029',0,'1','DM.png'),(214,'Santo Domingo','Dominican','214','Dominican peso','DOP','centavo','RD$',2,'Dominican Republic','DO','DOM','Dominican Republic','019','029',0,'1','DO.png'),(218,'Quito','Ecuadorian','218','US dollar','USD','cent','$',2,'Republic of Ecuador','EC','ECU','Ecuador','019','005',0,'593','EC.png'),(222,'San Salvador','Salvadoran','222','Salvadorian colón (pl. colones)','SVC','centavo','$',2,'Republic of El Salvador','SV','SLV','El Salvador','019','013',0,'503','SV.png'),(226,'Malabo','Equatorial Guinean','226','CFA franc (BEAC)','XAF','centime','FCF',2,'Republic of Equatorial Guinea','GQ','GNQ','Equatorial Guinea','002','017',0,'240','GQ.png'),(231,'Addis Ababa','Ethiopian','231','birr (inv.)','ETB','cent','ETB',2,'Federal Democratic Republic of Ethiopia','ET','ETH','Ethiopia','002','014',0,'251','ET.png'),(232,'Asmara','Eritrean','232','nakfa','ERN','cent','Nfk',2,'State of Eritrea','ER','ERI','Eritrea','002','014',0,'291','ER.png'),(233,'Tallinn','Estonian','233','euro','EUR','cent','kr',2,'Republic of Estonia','EE','EST','Estonia','150','154',1,'372','EE.png'),(234,'Tórshavn','Faeroese','234','Danish krone','DKK','øre (inv.)','kr',2,'Faeroe Islands','FO','FRO','Faroe Islands','150','154',0,'298','FO.png'),(238,'Stanley','Falkland Islander','238','Falkland Islands pound','FKP','new penny','£',2,'Falkland Islands','FK','FLK','Falkland Islands (Malvinas)','019','005',0,'500','FK.png'),(239,'King Edward Point (Grytviken)','of South Georgia and the South Sandwich Islands','239','','','','£',2,'South Georgia and the South Sandwich Islands','GS','SGS','South Georgia and the South Sandwich Islands','','',0,'44','GS.png'),(242,'Suva','Fijian','242','Fiji dollar','FJD','cent','$',2,'Republic of Fiji','FJ','FJI','Fiji','009','054',0,'679','FJ.png'),(246,'Helsinki','Finnish','246','euro','EUR','cent','€',2,'Republic of Finland','FI','FIN','Finland','150','154',1,'358','FI.png'),(248,'Mariehamn','Åland Islander','248','euro','EUR','cent',NULL,NULL,'Åland Islands','AX','ALA','Åland Islands','150','154',0,'358',NULL),(250,'Paris','French','250','euro','EUR','cent','€',2,'French Republic','FR','FRA','France','150','155',1,'33','FR.png'),(254,'Cayenne','Guianese','254','euro','EUR','cent','€',2,'French Guiana','GF','GUF','French Guiana','019','005',0,'594','GF.png'),(258,'Papeete','Polynesian','258','CFP franc','XPF','centime','XPF',0,'French Polynesia','PF','PYF','French Polynesia','009','061',0,'689','PF.png'),(260,'Port-aux-Francais','of French Southern and Antarctic Lands','260','euro','EUR','cent','€',2,'French Southern and Antarctic Lands','TF','ATF','French Southern Territories','','',0,'33','TF.png'),(262,'Djibouti','Djiboutian','262','Djibouti franc','DJF','','DJF',0,'Republic of Djibouti','DJ','DJI','Djibouti','002','014',0,'253','DJ.png'),(266,'Libreville','Gabonese','266','CFA franc (BEAC)','XAF','centime','FCF',0,'Gabonese Republic','GA','GAB','Gabon','002','017',0,'241','GA.png'),(268,'Tbilisi','Georgian','268','lari','GEL','tetri (inv.)','GEL',2,'Georgia','GE','GEO','Georgia','142','145',0,'995','GE.png'),(270,'Banjul','Gambian','270','dalasi (inv.)','GMD','butut','D',2,'Republic of the Gambia','GM','GMB','Gambia','002','011',0,'220','GM.png'),(275,NULL,'Palestinian','275',NULL,NULL,NULL,'₪',2,NULL,'PS','PSE','Palestinian Territory, Occupied','142','145',0,'970','PS.png'),(276,'Berlin','German','276','euro','EUR','cent','€',2,'Federal Republic of Germany','DE','DEU','Germany','150','155',1,'49','DE.png'),(288,'Accra','Ghanaian','288','Ghana cedi','GHS','pesewa','¢',2,'Republic of Ghana','GH','GHA','Ghana','002','011',0,'233','GH.png'),(292,'Gibraltar','Gibraltarian','292','Gibraltar pound','GIP','penny','£',2,'Gibraltar','GI','GIB','Gibraltar','150','039',0,'350','GI.png'),(296,'Tarawa','Kiribatian','296','Australian dollar','AUD','cent','$',2,'Republic of Kiribati','KI','KIR','Kiribati','009','057',0,'686','KI.png'),(300,'Athens','Greek','300','euro','EUR','cent','€',2,'Hellenic Republic','GR','GRC','Greece','150','039',1,'30','GR.png'),(304,'Nuuk','Greenlander','304','Danish krone','DKK','øre (inv.)','kr',2,'Greenland','GL','GRL','Greenland','019','021',0,'299','GL.png'),(308,'St George’s','Grenadian','308','East Caribbean dollar','XCD','cent','$',2,'Grenada','GD','GRD','Grenada','019','029',0,'1','GD.png'),(312,'Basse Terre','Guadeloupean','312','euro','EUR','cent','€',2,'Guadeloupe','GP','GLP','Guadeloupe','019','029',0,'590','GP.png'),(316,'Agaña (Hagåtña)','Guamanian','316','US dollar','USD','cent','$',2,'Territory of Guam','GU','GUM','Guam','009','057',0,'1','GU.png'),(320,'Guatemala City','Guatemalan','320','quetzal (pl. quetzales)','GTQ','centavo','Q',2,'Republic of Guatemala','GT','GTM','Guatemala','019','013',0,'502','GT.png'),(324,'Conakry','Guinean','324','Guinean franc','GNF','','GNF',0,'Republic of Guinea','GN','GIN','Guinea','002','011',0,'224','GN.png'),(328,'Georgetown','Guyanese','328','Guyana dollar','GYD','cent','$',2,'Cooperative Republic of Guyana','GY','GUY','Guyana','019','005',0,'592','GY.png'),(332,'Port-au-Prince','Haitian','332','gourde','HTG','centime','G',2,'Republic of Haiti','HT','HTI','Haiti','019','029',0,'509','HT.png'),(334,'Territory of Heard Island and McDonald Islands','of Territory of Heard Island and McDonald Islands','334','','','','$',2,'Territory of Heard Island and McDonald Islands','HM','HMD','Heard Island and McDonald Islands','','',0,'61','HM.png'),(336,'Vatican City','of the Holy See/of the Vatican','336','euro','EUR','cent','€',2,'the Holy See/ Vatican City State','VA','VAT','Holy See (Vatican City State)','150','039',0,'39','VA.png'),(340,'Tegucigalpa','Honduran','340','lempira','HNL','centavo','L',2,'Republic of Honduras','HN','HND','Honduras','019','013',0,'504','HN.png'),(344,'(HK3)','Hong Kong Chinese','344','Hong Kong dollar','HKD','cent','$',2,'Hong Kong Special Administrative Region of the People’s Republic of China (HK2)','HK','HKG','Hong Kong','142','030',0,'852','HK.png'),(348,'Budapest','Hungarian','348','forint (inv.)','HUF','(fillér (inv.))','Ft',2,'Republic of Hungary','HU','HUN','Hungary','150','151',1,'36','HU.png'),(352,'Reykjavik','Icelander','352','króna (pl. krónur)','ISK','','kr',0,'Republic of Iceland','IS','ISL','Iceland','150','154',0,'354','IS.png'),(356,'New Delhi','Indian','356','Indian rupee','INR','paisa','₹',2,'Republic of India','IN','IND','India','142','034',0,'91','IN.png'),(360,'Jakarta','Indonesian','360','Indonesian rupiah (inv.)','IDR','sen (inv.)','Rp',2,'Republic of Indonesia','ID','IDN','Indonesia','142','035',0,'62','ID.png'),(364,'Tehran','Iranian','364','Iranian rial','IRR','(dinar) (IR1)','﷼',2,'Islamic Republic of Iran','IR','IRN','Iran, Islamic Republic of','142','034',0,'98','IR.png'),(368,'Baghdad','Iraqi','368','Iraqi dinar','IQD','fils (inv.)','IQD',3,'Republic of Iraq','IQ','IRQ','Iraq','142','145',0,'964','IQ.png'),(372,'Dublin','Irish','372','euro','EUR','cent','€',2,'Ireland (IE1)','IE','IRL','Ireland','150','154',1,'353','IE.png'),(376,'(IL1)','Israeli','376','shekel','ILS','agora','₪',2,'State of Israel','IL','ISR','Israel','142','145',0,'972','IL.png'),(380,'Rome','Italian','380','euro','EUR','cent','€',2,'Italian Republic','IT','ITA','Italy','150','039',1,'39','IT.png'),(384,'Yamoussoukro (CI1)','Ivorian','384','CFA franc (BCEAO)','XOF','centime','XOF',0,'Republic of Côte d’Ivoire','CI','CIV','Côte d\'Ivoire','002','011',0,'225','CI.png'),(388,'Kingston','Jamaican','388','Jamaica dollar','JMD','cent','$',2,'Jamaica','JM','JAM','Jamaica','019','029',0,'1','JM.png'),(392,'Tokyo','Japanese','392','yen (inv.)','JPY','(sen (inv.)) (JP1)','¥',0,'Japan','JP','JPN','Japan','142','030',0,'81','JP.png'),(398,'Astana','Kazakh','398','tenge (inv.)','KZT','tiyn','лв',2,'Republic of Kazakhstan','KZ','KAZ','Kazakhstan','142','143',0,'7','KZ.png'),(400,'Amman','Jordanian','400','Jordanian dinar','JOD','100 qirsh','JOD',2,'Hashemite Kingdom of Jordan','JO','JOR','Jordan','142','145',0,'962','JO.png'),(404,'Nairobi','Kenyan','404','Kenyan shilling','KES','cent','KES',2,'Republic of Kenya','KE','KEN','Kenya','002','014',0,'254','KE.png'),(408,'Pyongyang','North Korean','408','North Korean won (inv.)','KPW','chun (inv.)','₩',2,'Democratic People’s Republic of Korea','KP','PRK','Korea, Democratic People\'s Republic of','142','030',0,'850','KP.png'),(410,'Seoul','South Korean','410','South Korean won (inv.)','KRW','(chun (inv.))','₩',0,'Republic of Korea','KR','KOR','Korea, Republic of','142','030',0,'82','KR.png'),(414,'Kuwait City','Kuwaiti','414','Kuwaiti dinar','KWD','fils (inv.)','KWD',3,'State of Kuwait','KW','KWT','Kuwait','142','145',0,'965','KW.png'),(417,'Bishkek','Kyrgyz','417','som','KGS','tyiyn','лв',2,'Kyrgyz Republic','KG','KGZ','Kyrgyzstan','142','143',0,'996','KG.png'),(418,'Vientiane','Lao','418','kip (inv.)','LAK','(at (inv.))','₭',0,'Lao People’s Democratic Republic','LA','LAO','Lao People\'s Democratic Republic','142','035',0,'856','LA.png'),(422,'Beirut','Lebanese','422','Lebanese pound','LBP','(piastre)','£',2,'Lebanese Republic','LB','LBN','Lebanon','142','145',0,'961','LB.png'),(426,'Maseru','Basotho','426','loti (pl. maloti)','LSL','sente','L',2,'Kingdom of Lesotho','LS','LSO','Lesotho','002','018',0,'266','LS.png'),(428,'Riga','Latvian','428','euro','EUR','cent','Ls',2,'Republic of Latvia','LV','LVA','Latvia','150','154',1,'371','LV.png'),(430,'Monrovia','Liberian','430','Liberian dollar','LRD','cent','$',2,'Republic of Liberia','LR','LBR','Liberia','002','011',0,'231','LR.png'),(434,'Tripoli','Libyan','434','Libyan dinar','LYD','dirham','LYD',3,'Socialist People’s Libyan Arab Jamahiriya','LY','LBY','Libya','002','015',0,'218','LY.png'),(438,'Vaduz','Liechtensteiner','438','Swiss franc','CHF','centime','CHF',2,'Principality of Liechtenstein','LI','LIE','Liechtenstein','150','155',0,'423','LI.png'),(440,'Vilnius','Lithuanian','440','euro','EUR','cent','Lt',2,'Republic of Lithuania','LT','LTU','Lithuania','150','154',1,'370','LT.png'),(442,'Luxembourg','Luxembourger','442','euro','EUR','cent','€',2,'Grand Duchy of Luxembourg','LU','LUX','Luxembourg','150','155',1,'352','LU.png'),(446,'Macao (MO3)','Macanese','446','pataca','MOP','avo','MOP',2,'Macao Special Administrative Region of the People’s Republic of China (MO2)','MO','MAC','Macao','142','030',0,'853','MO.png'),(450,'Antananarivo','Malagasy','450','ariary','MGA','iraimbilanja (inv.)','MGA',2,'Republic of Madagascar','MG','MDG','Madagascar','002','014',0,'261','MG.png'),(454,'Lilongwe','Malawian','454','Malawian kwacha (inv.)','MWK','tambala (inv.)','MK',2,'Republic of Malawi','MW','MWI','Malawi','002','014',0,'265','MW.png'),(458,'Kuala Lumpur (MY1)','Malaysian','458','ringgit (inv.)','MYR','sen (inv.)','RM',2,'Malaysia','MY','MYS','Malaysia','142','035',0,'60','MY.png'),(462,'Malé','Maldivian','462','rufiyaa','MVR','laari (inv.)','Rf',2,'Republic of Maldives','MV','MDV','Maldives','142','034',0,'960','MV.png'),(466,'Bamako','Malian','466','CFA franc (BCEAO)','XOF','centime','XOF',0,'Republic of Mali','ML','MLI','Mali','002','011',0,'223','ML.png'),(470,'Valletta','Maltese','470','euro','EUR','cent','MTL',2,'Republic of Malta','MT','MLT','Malta','150','039',1,'356','MT.png'),(474,'Fort-de-France','Martinican','474','euro','EUR','cent','€',2,'Martinique','MQ','MTQ','Martinique','019','029',0,'596','MQ.png'),(478,'Nouakchott','Mauritanian','478','ouguiya','MRO','khoum','UM',2,'Islamic Republic of Mauritania','MR','MRT','Mauritania','002','011',0,'222','MR.png'),(480,'Port Louis','Mauritian','480','Mauritian rupee','MUR','cent','₨',2,'Republic of Mauritius','MU','MUS','Mauritius','002','014',0,'230','MU.png'),(484,'Mexico City','Mexican','484','Mexican peso','MXN','centavo','$',2,'United Mexican States','MX','MEX','Mexico','019','013',0,'52','MX.png'),(492,'Monaco','Monegasque','492','euro','EUR','cent','€',2,'Principality of Monaco','MC','MCO','Monaco','150','155',0,'377','MC.png'),(496,'Ulan Bator','Mongolian','496','tugrik','MNT','möngö (inv.)','₮',2,'Mongolia','MN','MNG','Mongolia','142','030',0,'976','MN.png'),(498,'Chisinau','Moldovan','498','Moldovan leu (pl. lei)','MDL','ban','MDL',2,'Republic of Moldova','MD','MDA','Moldova, Republic of','150','151',0,'373','MD.png'),(499,'Podgorica','Montenegrin','499','euro','EUR','cent','€',2,'Montenegro','ME','MNE','Montenegro','150','039',0,'382','ME.png'),(500,'Plymouth (MS2)','Montserratian','500','East Caribbean dollar','XCD','cent','$',2,'Montserrat','MS','MSR','Montserrat','019','029',0,'1','MS.png'),(504,'Rabat','Moroccan','504','Moroccan dirham','MAD','centime','MAD',2,'Kingdom of Morocco','MA','MAR','Morocco','002','015',0,'212','MA.png'),(508,'Maputo','Mozambican','508','metical','MZN','centavo','MT',2,'Republic of Mozambique','MZ','MOZ','Mozambique','002','014',0,'258','MZ.png'),(512,'Muscat','Omani','512','Omani rial','OMR','baiza','﷼',3,'Sultanate of Oman','OM','OMN','Oman','142','145',0,'968','OM.png'),(516,'Windhoek','Namibian','516','Namibian dollar','NAD','cent','$',2,'Republic of Namibia','NA','NAM','Namibia','002','018',0,'264','NA.png'),(520,'Yaren','Nauruan','520','Australian dollar','AUD','cent','$',2,'Republic of Nauru','NR','NRU','Nauru','009','057',0,'674','NR.png'),(524,'Kathmandu','Nepalese','524','Nepalese rupee','NPR','paisa (inv.)','₨',2,'Nepal','NP','NPL','Nepal','142','034',0,'977','NP.png'),(528,'Amsterdam (NL2)','Dutch','528','euro','EUR','cent','€',2,'Kingdom of the Netherlands','NL','NLD','Netherlands','150','155',1,'31','NL.png'),(531,'Willemstad','Curaçaoan','531','Netherlands Antillean guilder (CW1)','ANG','cent',NULL,NULL,'Curaçao','CW','CUW','Curaçao','019','029',0,'599',NULL),(533,'Oranjestad','Aruban','533','Aruban guilder','AWG','cent','ƒ',2,'Aruba','AW','ABW','Aruba','019','029',0,'297','AW.png'),(534,'Philipsburg','Sint Maartener','534','Netherlands Antillean guilder (SX1)','ANG','cent',NULL,NULL,'Sint Maarten','SX','SXM','Sint Maarten (Dutch part)','019','029',0,'721',NULL),(535,NULL,'of Bonaire, Sint Eustatius and Saba','535','US dollar','USD','cent',NULL,NULL,NULL,'BQ','BES','Bonaire, Sint Eustatius and Saba','019','029',0,'599',NULL),(540,'Nouméa','New Caledonian','540','CFP franc','XPF','centime','XPF',0,'New Caledonia','NC','NCL','New Caledonia','009','054',0,'687','NC.png'),(548,'Port Vila','Vanuatuan','548','vatu (inv.)','VUV','','Vt',0,'Republic of Vanuatu','VU','VUT','Vanuatu','009','054',0,'678','VU.png'),(554,'Wellington','New Zealander','554','New Zealand dollar','NZD','cent','$',2,'New Zealand','NZ','NZL','New Zealand','009','053',0,'64','NZ.png'),(558,'Managua','Nicaraguan','558','córdoba oro','NIO','centavo','C$',2,'Republic of Nicaragua','NI','NIC','Nicaragua','019','013',0,'505','NI.png'),(562,'Niamey','Nigerien','562','CFA franc (BCEAO)','XOF','centime','XOF',0,'Republic of Niger','NE','NER','Niger','002','011',0,'227','NE.png'),(566,'Abuja','Nigerian','566','naira (inv.)','NGN','kobo (inv.)','₦',2,'Federal Republic of Nigeria','NG','NGA','Nigeria','002','011',0,'234','NG.png'),(570,'Alofi','Niuean','570','New Zealand dollar','NZD','cent','$',2,'Niue','NU','NIU','Niue','009','061',0,'683','NU.png'),(574,'Kingston','Norfolk Islander','574','Australian dollar','AUD','cent','$',2,'Territory of Norfolk Island','NF','NFK','Norfolk Island','009','053',0,'672','NF.png'),(578,'Oslo','Norwegian','578','Norwegian krone (pl. kroner)','NOK','øre (inv.)','kr',2,'Kingdom of Norway','NO','NOR','Norway','150','154',0,'47','NO.png'),(580,'Saipan','Northern Mariana Islander','580','US dollar','USD','cent','$',2,'Commonwealth of the Northern Mariana Islands','MP','MNP','Northern Mariana Islands','009','057',0,'1','MP.png'),(581,'United States Minor Outlying Islands','of United States Minor Outlying Islands','581','US dollar','USD','cent','$',2,'United States Minor Outlying Islands','UM','UMI','United States Minor Outlying Islands','','',0,'1','UM.png'),(583,'Palikir','Micronesian','583','US dollar','USD','cent','$',2,'Federated States of Micronesia','FM','FSM','Micronesia, Federated States of','009','057',0,'691','FM.png'),(584,'Majuro','Marshallese','584','US dollar','USD','cent','$',2,'Republic of the Marshall Islands','MH','MHL','Marshall Islands','009','057',0,'692','MH.png'),(585,'Melekeok','Palauan','585','US dollar','USD','cent','$',2,'Republic of Palau','PW','PLW','Palau','009','057',0,'680','PW.png'),(586,'Islamabad','Pakistani','586','Pakistani rupee','PKR','paisa','₨',2,'Islamic Republic of Pakistan','PK','PAK','Pakistan','142','034',0,'92','PK.png'),(591,'Panama City','Panamanian','591','balboa','PAB','centésimo','B/.',2,'Republic of Panama','PA','PAN','Panama','019','013',0,'507','PA.png'),(598,'Port Moresby','Papua New Guinean','598','kina (inv.)','PGK','toea (inv.)','PGK',2,'Independent State of Papua New Guinea','PG','PNG','Papua New Guinea','009','054',0,'675','PG.png'),(600,'Asunción','Paraguayan','600','guaraní','PYG','céntimo','Gs',0,'Republic of Paraguay','PY','PRY','Paraguay','019','005',0,'595','PY.png'),(604,'Lima','Peruvian','604','new sol','PEN','céntimo','S/.',2,'Republic of Peru','PE','PER','Peru','019','005',0,'51','PE.png'),(608,'Manila','Filipino','608','Philippine peso','PHP','centavo','Php',2,'Republic of the Philippines','PH','PHL','Philippines','142','035',0,'63','PH.png'),(612,'Adamstown','Pitcairner','612','New Zealand dollar','NZD','cent','$',2,'Pitcairn Islands','PN','PCN','Pitcairn','009','061',0,'649','PN.png'),(616,'Warsaw','Polish','616','zloty','PLN','grosz (pl. groszy)','zł',2,'Republic of Poland','PL','POL','Poland','150','151',1,'48','PL.png'),(620,'Lisbon','Portuguese','620','euro','EUR','cent','€',2,'Portuguese Republic','PT','PRT','Portugal','150','039',1,'351','PT.png'),(624,'Bissau','Guinea-Bissau national','624','CFA franc (BCEAO)','XOF','centime','XOF',0,'Republic of Guinea-Bissau','GW','GNB','Guinea-Bissau','002','011',0,'245','GW.png'),(626,'Dili','East Timorese','626','US dollar','USD','cent','$',2,'Democratic Republic of East Timor','TL','TLS','Timor-Leste','142','035',0,'670','TL.png'),(630,'San Juan','Puerto Rican','630','US dollar','USD','cent','$',2,'Commonwealth of Puerto Rico','PR','PRI','Puerto Rico','019','029',0,'1','PR.png'),(634,'Doha','Qatari','634','Qatari riyal','QAR','dirham','﷼',2,'State of Qatar','QA','QAT','Qatar','142','145',0,'974','QA.png'),(638,'Saint-Denis','Reunionese','638','euro','EUR','cent','€',2,'Réunion','RE','REU','Réunion','002','014',0,'262','RE.png'),(642,'Bucharest','Romanian','642','Romanian leu (pl. lei)','RON','ban (pl. bani)','lei',2,'Romania','RO','ROU','Romania','150','151',1,'40','RO.png'),(643,'Moscow','Russian','643','Russian rouble','RUB','kopek','руб',2,'Russian Federation','RU','RUS','Russian Federation','150','151',0,'7','RU.png'),(646,'Kigali','Rwandan; Rwandese','646','Rwandese franc','RWF','centime','RWF',0,'Republic of Rwanda','RW','RWA','Rwanda','002','014',0,'250','RW.png'),(652,'Gustavia','of Saint Barthélemy','652','euro','EUR','cent',NULL,NULL,'Collectivity of Saint Barthélemy','BL','BLM','Saint Barthélemy','019','029',0,'590',NULL),(654,'Jamestown','Saint Helenian','654','Saint Helena pound','SHP','penny','£',2,'Saint Helena, Ascension and Tristan da Cunha','SH','SHN','Saint Helena, Ascension and Tristan da Cunha','002','011',0,'290','SH.png'),(659,'Basseterre','Kittsian; Nevisian','659','East Caribbean dollar','XCD','cent','$',2,'Federation of Saint Kitts and Nevis','KN','KNA','Saint Kitts and Nevis','019','029',0,'1','KN.png'),(660,'The Valley','Anguillan','660','East Caribbean dollar','XCD','cent','$',2,'Anguilla','AI','AIA','Anguilla','019','029',0,'1','AI.png'),(662,'Castries','Saint Lucian','662','East Caribbean dollar','XCD','cent','$',2,'Saint Lucia','LC','LCA','Saint Lucia','019','029',0,'1','LC.png'),(663,'Marigot','of Saint Martin','663','euro','EUR','cent',NULL,NULL,'Collectivity of Saint Martin','MF','MAF','Saint Martin (French part)','019','029',0,'590',NULL),(666,'Saint-Pierre','St-Pierrais; Miquelonnais','666','euro','EUR','cent','€',2,'Territorial Collectivity of Saint Pierre and Miquelon','PM','SPM','Saint Pierre and Miquelon','019','021',0,'508','PM.png'),(670,'Kingstown','Vincentian','670','East Caribbean dollar','XCD','cent','$',2,'Saint Vincent and the Grenadines','VC','VCT','Saint Vincent and the Grenadines','019','029',0,'1','VC.png'),(674,'San Marino','San Marinese','674','euro','EUR','cent','€',2,'Republic of San Marino','SM','SMR','San Marino','150','039',0,'378','SM.png'),(678,'São Tomé','São Toméan','678','dobra','STD','centavo','Db',2,'Democratic Republic of São Tomé and Príncipe','ST','STP','Sao Tome and Principe','002','017',0,'239','ST.png'),(682,'Riyadh','Saudi Arabian','682','riyal','SAR','halala','﷼',2,'Kingdom of Saudi Arabia','SA','SAU','Saudi Arabia','142','145',0,'966','SA.png'),(686,'Dakar','Senegalese','686','CFA franc (BCEAO)','XOF','centime','XOF',0,'Republic of Senegal','SN','SEN','Senegal','002','011',0,'221','SN.png'),(688,'Belgrade','Serb','688','Serbian dinar','RSD','para (inv.)',NULL,NULL,'Republic of Serbia','RS','SRB','Serbia','150','039',0,'381',NULL),(690,'Victoria','Seychellois','690','Seychelles rupee','SCR','cent','₨',2,'Republic of Seychelles','SC','SYC','Seychelles','002','014',0,'248','SC.png'),(694,'Freetown','Sierra Leonean','694','leone','SLL','cent','Le',2,'Republic of Sierra Leone','SL','SLE','Sierra Leone','002','011',0,'232','SL.png'),(702,'Singapore','Singaporean','702','Singapore dollar','SGD','cent','$',2,'Republic of Singapore','SG','SGP','Singapore','142','035',0,'65','SG.png'),(703,'Bratislava','Slovak','703','euro','EUR','cent','Sk',2,'Slovak Republic','SK','SVK','Slovakia','150','151',1,'421','SK.png'),(704,'Hanoi','Vietnamese','704','dong','VND','(10 hào','₫',2,'Socialist Republic of Vietnam','VN','VNM','Viet Nam','142','035',0,'84','VN.png'),(705,'Ljubljana','Slovene','705','euro','EUR','cent','€',2,'Republic of Slovenia','SI','SVN','Slovenia','150','039',1,'386','SI.png'),(706,'Mogadishu','Somali','706','Somali shilling','SOS','cent','S',2,'Somali Republic','SO','SOM','Somalia','002','014',0,'252','SO.png'),(710,'Pretoria (ZA1)','South African','710','rand','ZAR','cent','R',2,'Republic of South Africa','ZA','ZAF','South Africa','002','018',0,'27','ZA.png'),(716,'Harare','Zimbabwean','716','Zimbabwe dollar (ZW1)','ZWL','cent','Z$',2,'Republic of Zimbabwe','ZW','ZWE','Zimbabwe','002','014',0,'263','ZW.png'),(724,'Madrid','Spaniard','724','euro','EUR','cent','€',2,'Kingdom of Spain','ES','ESP','Spain','150','039',1,'34','ES.png'),(728,'Juba','South Sudanese','728','South Sudanese pound','SSP','piaster',NULL,NULL,'Republic of South Sudan','SS','SSD','South Sudan','002','015',0,'211',NULL),(729,'Khartoum','Sudanese','729','Sudanese pound','SDG','piastre',NULL,NULL,'Republic of the Sudan','SD','SDN','Sudan','002','015',0,'249',NULL),(732,'Al aaiun','Sahrawi','732','Moroccan dirham','MAD','centime','MAD',2,'Western Sahara','EH','ESH','Western Sahara','002','015',0,'212','EH.png'),(740,'Paramaribo','Surinamese','740','Surinamese dollar','SRD','cent','$',2,'Republic of Suriname','SR','SUR','Suriname','019','005',0,'597','SR.png'),(744,'Longyearbyen','of Svalbard','744','Norwegian krone (pl. kroner)','NOK','øre (inv.)','kr',2,'Svalbard and Jan Mayen','SJ','SJM','Svalbard and Jan Mayen','150','154',0,'47','SJ.png'),(748,'Mbabane','Swazi','748','lilangeni','SZL','cent','SZL',2,'Kingdom of Swaziland','SZ','SWZ','Swaziland','002','018',0,'268','SZ.png'),(752,'Stockholm','Swedish','752','krona (pl. kronor)','SEK','öre (inv.)','kr',2,'Kingdom of Sweden','SE','SWE','Sweden','150','154',1,'46','SE.png'),(756,'Berne','Swiss','756','Swiss franc','CHF','centime','CHF',2,'Swiss Confederation','CH','CHE','Switzerland','150','155',0,'41','CH.png'),(760,'Damascus','Syrian','760','Syrian pound','SYP','piastre','£',2,'Syrian Arab Republic','SY','SYR','Syrian Arab Republic','142','145',0,'963','SY.png'),(762,'Dushanbe','Tajik','762','somoni','TJS','diram','TJS',2,'Republic of Tajikistan','TJ','TJK','Tajikistan','142','143',0,'992','TJ.png'),(764,'Bangkok','Thai','764','baht (inv.)','THB','satang (inv.)','฿',2,'Kingdom of Thailand','TH','THA','Thailand','142','035',0,'66','TH.png'),(768,'Lomé','Togolese','768','CFA franc (BCEAO)','XOF','centime','XOF',0,'Togolese Republic','TG','TGO','Togo','002','011',0,'228','TG.png'),(772,'(TK2)','Tokelauan','772','New Zealand dollar','NZD','cent','$',2,'Tokelau','TK','TKL','Tokelau','009','061',0,'690','TK.png'),(776,'Nuku’alofa','Tongan','776','pa’anga (inv.)','TOP','seniti (inv.)','T$',2,'Kingdom of Tonga','TO','TON','Tonga','009','061',0,'676','TO.png'),(780,'Port of Spain','Trinidadian; Tobagonian','780','Trinidad and Tobago dollar','TTD','cent','TT$',2,'Republic of Trinidad and Tobago','TT','TTO','Trinidad and Tobago','019','029',0,'1','TT.png'),(784,'Abu Dhabi','Emirian','784','UAE dirham','AED','fils (inv.)','AED',2,'United Arab Emirates','AE','ARE','United Arab Emirates','142','145',0,'971','AE.png'),(788,'Tunis','Tunisian','788','Tunisian dinar','TND','millime','TND',3,'Republic of Tunisia','TN','TUN','Tunisia','002','015',0,'216','TN.png'),(792,'Ankara','Turk','792','Turkish lira (inv.)','TRY','kurus (inv.)','₺',2,'Republic of Turkey','TR','TUR','Turkey','142','145',0,'90','TR.png'),(795,'Ashgabat','Turkmen','795','Turkmen manat (inv.)','TMT','tenge (inv.)','m',2,'Turkmenistan','TM','TKM','Turkmenistan','142','143',0,'993','TM.png'),(796,'Cockburn Town','Turks and Caicos Islander','796','US dollar','USD','cent','$',2,'Turks and Caicos Islands','TC','TCA','Turks and Caicos Islands','019','029',0,'1','TC.png'),(798,'Funafuti','Tuvaluan','798','Australian dollar','AUD','cent','$',2,'Tuvalu','TV','TUV','Tuvalu','009','061',0,'688','TV.png'),(800,'Kampala','Ugandan','800','Uganda shilling','UGX','cent','UGX',0,'Republic of Uganda','UG','UGA','Uganda','002','014',0,'256','UG.png'),(804,'Kiev','Ukrainian','804','hryvnia','UAH','kopiyka','₴',2,'Ukraine','UA','UKR','Ukraine','150','151',0,'380','UA.png'),(807,'Skopje','of the former Yugoslav Republic of Macedonia','807','denar (pl. denars)','MKD','deni (inv.)','ден',2,'the former Yugoslav Republic of Macedonia','MK','MKD','Macedonia, the former Yugoslav Republic of','150','039',0,'389','MK.png'),(818,'Cairo','Egyptian','818','Egyptian pound','EGP','piastre','£',2,'Arab Republic of Egypt','EG','EGY','Egypt','002','015',0,'20','EG.png'),(826,'London','British','826','pound sterling','GBP','penny (pl. pence)','£',2,'United Kingdom of Great Britain and Northern Ireland','GB','GBR','United Kingdom','150','154',1,'44','GB.png'),(831,'St Peter Port','of Guernsey','831','Guernsey pound (GG2)','GGP (GG2)','penny (pl. pence)',NULL,NULL,'Bailiwick of Guernsey','GG','GGY','Guernsey','150','154',0,'44',NULL),(832,'St Helier','of Jersey','832','Jersey pound (JE2)','JEP (JE2)','penny (pl. pence)',NULL,NULL,'Bailiwick of Jersey','JE','JEY','Jersey','150','154',0,'44',NULL),(833,'Douglas','Manxman; Manxwoman','833','Manx pound (IM2)','IMP (IM2)','penny (pl. pence)',NULL,NULL,'Isle of Man','IM','IMN','Isle of Man','150','154',0,'44',NULL),(834,'Dodoma (TZ1)','Tanzanian','834','Tanzanian shilling','TZS','cent','TZS',2,'United Republic of Tanzania','TZ','TZA','Tanzania, United Republic of','002','014',0,'255','TZ.png'),(840,'Washington DC','American','840','US dollar','USD','cent','$',2,'United States of America','US','USA','United States','019','021',0,'1','US.png'),(850,'Charlotte Amalie','US Virgin Islander','850','US dollar','USD','cent','$',2,'United States Virgin Islands','VI','VIR','Virgin Islands, U.S.','019','029',0,'1','VI.png'),(854,'Ouagadougou','Burkinabe','854','CFA franc (BCEAO)','XOF','centime','XOF',0,'Burkina Faso','BF','BFA','Burkina Faso','002','011',0,'226','BF.png'),(858,'Montevideo','Uruguayan','858','Uruguayan peso','UYU','centésimo','$U',0,'Eastern Republic of Uruguay','UY','URY','Uruguay','019','005',0,'598','UY.png'),(860,'Tashkent','Uzbek','860','sum (inv.)','UZS','tiyin (inv.)','лв',2,'Republic of Uzbekistan','UZ','UZB','Uzbekistan','142','143',0,'998','UZ.png'),(862,'Caracas','Venezuelan','862','bolívar fuerte (pl. bolívares fuertes)','VEF','céntimo','Bs',2,'Bolivarian Republic of Venezuela','VE','VEN','Venezuela, Bolivarian Republic of','019','005',0,'58','VE.png'),(876,'Mata-Utu','Wallisian; Futunan; Wallis and Futuna Islander','876','CFP franc','XPF','centime','XPF',0,'Wallis and Futuna','WF','WLF','Wallis and Futuna','009','061',0,'681','WF.png'),(882,'Apia','Samoan','882','tala (inv.)','WST','sene (inv.)','WS$',2,'Independent State of Samoa','WS','WSM','Samoa','009','061',0,'685','WS.png'),(887,'San’a','Yemenite','887','Yemeni rial','YER','fils (inv.)','﷼',2,'Republic of Yemen','YE','YEM','Yemen','142','145',0,'967','YE.png'),(894,'Lusaka','Zambian','894','Zambian kwacha (inv.)','ZMW','ngwee (inv.)','ZK',2,'Republic of Zambia','ZM','ZMB','Zambia','002','014',0,'260','ZM.png');
/*!40000 ALTER TABLE `countries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `local_girls`
--

DROP TABLE IF EXISTS `local_girls`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `local_girls`
--

LOCK TABLES `local_girls` WRITE;
/*!40000 ALTER TABLE `local_girls` DISABLE KEYS */;
/*!40000 ALTER TABLE `local_girls` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `local_types`
--

DROP TABLE IF EXISTS `local_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `local_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `local_types`
--

LOCK TABLES `local_types` WRITE;
/*!40000 ALTER TABLE `local_types` DISABLE KEYS */;
INSERT INTO `local_types` VALUES (1,'Tip 1','2017-12-12 21:06:10','2017-12-12 21:06:10'),(2,'Tip 2','2017-12-12 21:06:10','2017-12-12 21:06:10'),(3,'Tip 3','2017-12-12 21:06:10','2017-12-12 21:06:10'),(4,'Tip 4','2017-12-12 21:06:10','2017-12-12 21:06:10'),(5,'Tip 5','2017-12-12 21:06:10','2017-12-12 21:06:10'),(6,'Tip 6','2017-12-12 21:06:10','2017-12-12 21:06:10');
/*!40000 ALTER TABLE `local_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `locals`
--

DROP TABLE IF EXISTS `locals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `locals` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `activated` int(11) DEFAULT NULL,
  `approved` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `web` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about_me` text COLLATE utf8mb4_unicode_ci,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photos` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `videos` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `working_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `club_entrance_id` int(10) unsigned DEFAULT NULL,
  `club_wellness_id` int(10) unsigned DEFAULT NULL,
  `club_food_id` int(10) unsigned DEFAULT NULL,
  `club_outdoor_id` int(10) unsigned DEFAULT NULL,
  `local_type_id` int(10) unsigned DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `locals_club_entrance_id_foreign` (`club_entrance_id`),
  KEY `locals_club_wellness_id_foreign` (`club_wellness_id`),
  KEY `locals_club_food_id_foreign` (`club_food_id`),
  KEY `locals_club_outdoor_id_foreign` (`club_outdoor_id`),
  KEY `locals_local_type_id_foreign` (`local_type_id`),
  CONSTRAINT `locals_club_entrance_id_foreign` FOREIGN KEY (`club_entrance_id`) REFERENCES `clubs_info` (`id`) ON DELETE CASCADE,
  CONSTRAINT `locals_club_food_id_foreign` FOREIGN KEY (`club_food_id`) REFERENCES `clubs_info` (`id`) ON DELETE CASCADE,
  CONSTRAINT `locals_club_outdoor_id_foreign` FOREIGN KEY (`club_outdoor_id`) REFERENCES `clubs_info` (`id`) ON DELETE CASCADE,
  CONSTRAINT `locals_club_wellness_id_foreign` FOREIGN KEY (`club_wellness_id`) REFERENCES `clubs_info` (`id`) ON DELETE CASCADE,
  CONSTRAINT `locals_local_type_id_foreign` FOREIGN KEY (`local_type_id`) REFERENCES `local_types` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `locals`
--

LOCK TABLES `locals` WRITE;
/*!40000 ALTER TABLE `locals` DISABLE KEYS */;
/*!40000 ALTER TABLE `locals` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (42,'2017_11_01_150903_setup_countries_table',1),(43,'2017_11_01_150904_charify_countries_table',1),(44,'2017_11_01_152958_create_services_table',1),(45,'2017_11_01_155723_create_cantons_table',1),(46,'2017_11_01_163800_create_user_types_table',1),(47,'2017_11_02_000000_create_users_table',1),(48,'2017_11_02_100000_create_password_resets_table',1),(49,'2017_11_02_153237_create_user_service_table',1),(50,'2017_11_02_175533_create_prices_table',1),(51,'2017_11_02_181235_create_packages_table',1),(52,'2017_11_03_161925_create_user_activations_table',1),(53,'2017_11_04_201104_create_clubs_info_table',1),(54,'2017_11_07_120653_create_local_types_table',1),(55,'2017_11_13_205100_create_roles_table',1),(56,'2017_11_13_205202_create_user_role_table',1),(57,'2017_11_22_153939_create_notifications_table',1),(58,'2017_11_29_161731_create_contact_options_table',1),(59,'2017_11_29_162151_create_user_contact_option',1),(60,'2017_11_29_172652_create_service_options_table',1),(61,'2017_11_29_173003_create_user_service_options_table',1),(62,'2017_11_29_213138_create_spoken_languages_table',1),(63,'2017_11_29_213458_create_user_spoken_language_table',1),(64,'2017_11_30_144509_create_locals_table',1),(65,'2017_12_07_121332_create_local_girls_table',1),(66,'2017_12_07_173643_add_spoken_language_code_to_spoken_languages_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notifications` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `notifiable_id` int(10) unsigned DEFAULT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
INSERT INTO `notifications` VALUES (3,NULL,'Girl of The Month Package Expiration','Your girl of the month package expires on 12th December 2017',0,1,'App\\Models\\User','2017-12-13 22:34:17');
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `packages`
--

DROP TABLE IF EXISTS `packages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `packages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `package_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `package_duration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `package_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `packages`
--

LOCK TABLES `packages` WRITE;
/*!40000 ALTER TABLE `packages` DISABLE KEYS */;
INSERT INTO `packages` VALUES (1,'7 / S','7 Days','50 CHF','2017-12-12 21:06:09','2017-12-12 21:06:09'),(2,'14 / M','14 Days','150 CHF','2017-12-12 21:06:09','2017-12-12 21:06:09'),(3,'30 / L','30 Days','250 CHF','2017-12-12 21:06:09','2017-12-12 21:06:09'),(4,'90 / XL','90 Days','350 CHF','2017-12-12 21:06:09','2017-12-12 21:06:09'),(5,'180 / XXL','180 Days','450 CHF','2017-12-12 21:06:09','2017-12-12 21:06:09'),(6,'360 / XXXL','360 Days','550 CHF','2017-12-12 21:06:09','2017-12-12 21:06:09');
/*!40000 ALTER TABLE `packages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prices`
--

DROP TABLE IF EXISTS `prices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `prices` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `price_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_duration` int(10) unsigned DEFAULT NULL,
  `service_price` int(10) unsigned DEFAULT NULL,
  `service_price_unit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_price_currency` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `prices_user_id_foreign` (`user_id`),
  CONSTRAINT `prices_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prices`
--

LOCK TABLES `prices` WRITE;
/*!40000 ALTER TABLE `prices` DISABLE KEYS */;
INSERT INTO `prices` VALUES (1,1,'outcall',12,23,'days','chf'),(2,1,'outcall',23,43,'days','chf'),(3,1,'outcall',65,45,'days','chf');
/*!40000 ALTER TABLE `prices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Standard User','A standard registered user with no admin rights.','2017-12-12 21:06:10','2017-12-12 21:06:10'),(2,'Moderator','A moderator of the website who has similar permissions as the admin, but is not allowed to go to the admin page etc.','2017-12-12 21:06:10','2017-12-12 21:06:10'),(3,'Admin','An admin of the website who has similar permissions as the super admin, but still some of the permissions are restricted.','2017-12-12 21:06:10','2017-12-12 21:06:10');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service_options`
--

DROP TABLE IF EXISTS `service_options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `service_options` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `service_option_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service_options`
--

LOCK TABLES `service_options` WRITE;
/*!40000 ALTER TABLE `service_options` DISABLE KEYS */;
INSERT INTO `service_options` VALUES (1,'men'),(2,'women'),(3,'couples'),(4,'gays'),(5,'trans'),(6,'2+');
/*!40000 ALTER TABLE `service_options` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `services` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `service_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `services`
--

LOCK TABLES `services` WRITE;
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
INSERT INTO `services` VALUES (1,'Position 69'),(2,'Ins Gesicht spritzen'),(3,'Französisch mit'),(4,'Küssen'),(5,'Erotische Massage'),(6,'Deep Throat'),(7,'Lesbospiele'),(8,'Zungenanal (aktiv)'),(9,'Analmassage (passiv)'),(10,'Latex / Leder'),(11,'Rollenspiele'),(12,'Domina'),(13,'Anal Sex'),(14,'Sextoys'),(15,'Französisch ohne'),(16,'Sex in allen Positionen'),(17,'Spanisch'),(18,'Tantra'),(19,'Gangbang'),(20,'Masturbieren'),(21,'Zungenanal (passiv)'),(22,'BDSM'),(23,'Kliniksex'),(24,'Natursekt (aktiv)'),(25,'Spanking'),(26,'In den Mund spritzen'),(27,'Küssen'),(28,'Girlfriend Sex'),(29,'Körperbesamung'),(30,'Ganzkörpermassage'),(31,'Prostatamassage'),(32,'Kamasutra'),(33,'Pornostar service'),(34,'Analmassage (aktiv)'),(35,'Bondage'),(36,'Fetish'),(37,'Natursekt (passiv)'),(38,'Squirting');
/*!40000 ALTER TABLE `services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `spoken_languages`
--

DROP TABLE IF EXISTS `spoken_languages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `spoken_languages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `spoken_language_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `spoken_language_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `spoken_languages`
--

LOCK TABLES `spoken_languages` WRITE;
/*!40000 ALTER TABLE `spoken_languages` DISABLE KEYS */;
INSERT INTO `spoken_languages` VALUES (1,'English','en'),(2,'German','de'),(3,'Italian','it'),(4,'French','fr'),(5,'Spanish','es'),(6,'Russian','ru'),(7,'Portuguese','pt'),(8,'Dutch','nl'),(9,'Serbian','rs'),(10,'Slovenian','sl'),(11,'Slovak','sk'),(12,'Greek','gr'),(13,'Bulgarian','bg'),(14,'Czech','cz'),(15,'Indian','in'),(16,'Arabic','sa'),(17,'Japanese','jp'),(18,'Chinese','cn'),(19,'Finnish','fi'),(20,'Norwegian','no'),(21,'Swedish','se'),(22,'Danish','dk'),(23,'Turkish','tr'),(24,'Polish','pl'),(25,'Romanian','ro');
/*!40000 ALTER TABLE `spoken_languages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_activations`
--

DROP TABLE IF EXISTS `user_activations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_activations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `user_type` int(11) NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_activations_user_id_foreign` (`user_id`),
  CONSTRAINT `user_activations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_activations`
--

LOCK TABLES `user_activations` WRITE;
/*!40000 ALTER TABLE `user_activations` DISABLE KEYS */;
INSERT INTO `user_activations` VALUES (1,1,1,'',NULL,NULL),(2,14,1,'C9JVh6PJQ3tu3bOwGkH41YxGbuNSRmcdhYc69ag9',NULL,NULL);
/*!40000 ALTER TABLE `user_activations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_contact_option`
--

DROP TABLE IF EXISTS `user_contact_option`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_contact_option` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `contact_option_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_contact_option_user_id_foreign` (`user_id`),
  KEY `user_contact_option_contact_option_id_foreign` (`contact_option_id`),
  CONSTRAINT `user_contact_option_contact_option_id_foreign` FOREIGN KEY (`contact_option_id`) REFERENCES `contact_options` (`id`) ON DELETE CASCADE,
  CONSTRAINT `user_contact_option_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_contact_option`
--

LOCK TABLES `user_contact_option` WRITE;
/*!40000 ALTER TABLE `user_contact_option` DISABLE KEYS */;
INSERT INTO `user_contact_option` VALUES (1,1,2),(2,1,3);
/*!40000 ALTER TABLE `user_contact_option` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_role`
--

DROP TABLE IF EXISTS `user_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_role`
--

LOCK TABLES `user_role` WRITE;
/*!40000 ALTER TABLE `user_role` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_service`
--

DROP TABLE IF EXISTS `user_service`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_service`
--

LOCK TABLES `user_service` WRITE;
/*!40000 ALTER TABLE `user_service` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_service` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_service_options`
--

DROP TABLE IF EXISTS `user_service_options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_service_options`
--

LOCK TABLES `user_service_options` WRITE;
/*!40000 ALTER TABLE `user_service_options` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_service_options` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_spoken_language`
--

DROP TABLE IF EXISTS `user_spoken_language`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_spoken_language`
--

LOCK TABLES `user_spoken_language` WRITE;
/*!40000 ALTER TABLE `user_spoken_language` DISABLE KEYS */;
INSERT INTO `user_spoken_language` VALUES (11,1,2,2),(12,1,3,1),(13,1,1,3),(14,1,4,3),(15,1,5,2);
/*!40000 ALTER TABLE `user_spoken_language` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_types`
--

DROP TABLE IF EXISTS `user_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_type_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_types`
--

LOCK TABLES `user_types` WRITE;
/*!40000 ALTER TABLE `user_types` DISABLE KEYS */;
INSERT INTO `user_types` VALUES (1,'Private'),(2,'Local');
/*!40000 ALTER TABLE `user_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_type_id` int(10) unsigned NOT NULL,
  `activated` tinyint(1) NOT NULL DEFAULT '0',
  `approved` tinyint(1) NOT NULL DEFAULT '0',
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
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  `stripe_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'shogun','disabledbyfb@gmail.com','$2y$10$zJ9A5IYrAvuBgLBw.V5bUuiE.INWDgw2cJe.PZ/73DwtkYl/kbgt.',1,1,1,1,0,'Jena','Jansen','Jena',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'sms_and_call','skr',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,3,'2017-12-01 00:00:00','2017-12-20 20:32:59',1,'2017-12-13 00:00:00','2017-12-12 00:00:00','cus_BwQ91JEyodyKM8','urKHTL2oKLFti9ZGPQRVlomRbZekUkumZYwAxljTraIYo6Dx9QoMSaBznAZn','2017-12-12 21:06:09','2017-12-13 23:34:17'),(2,'test1','test1@test1.com','$2y$10$nQRjFP9TpSC.ng7ExejGyuz5qfpyxoioBkKUJxsxiYg8gVHYmxte.',1,1,0,0,0,'Jena2','Jansen2','Jena2',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2017-12-12 21:06:09','2017-12-12 21:06:09'),(3,'test2','test2@test2.com','$2y$10$45qduuFC0AhtKjWra0Ao2eENg0p4KhcqSyzmA0HaN/GbEYLqiWExC',1,1,0,0,0,'Jena3','Jansen3','Jena3',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2017-12-12 21:06:09','2017-12-12 21:06:09'),(4,'test3','test3@test3.com','$2y$10$V6EOJkhtOb2ctrIap8CTYuBnOxaDPtDTY/4HkhQ40cQKkdd.2SWqm',1,1,1,0,0,'Jena4','Jansen4','Jena4',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2017-12-12 21:06:09','2017-12-12 21:06:09'),(5,'test4','test4@test4.com','$2y$10$IWi0DAfumOHRg2bGAMBEDOCSwaBegqjPsJj3hL.TLrLAXGZ8FhejK',1,1,1,0,0,'Jena5','Jansen5','Jena5',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2017-12-12 21:06:09','2017-12-12 21:06:09'),(6,'test5','test5@test5.com','$2y$10$CbGS7z3Zv.YXN2GiJNloEOo6TSQyTPBZc5NcXfKECzSEciD5b.Q6y',1,1,0,0,0,'Jena6','Jansen6','Jena6',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2017-12-12 21:06:10','2017-12-12 21:06:10'),(7,'test6','test6@test6.com','$2y$10$.kC9IEN7voE6z818mEnmGOUJSxwMgFujxHiSr9nYwlurNi/Ud4O6W',1,1,1,0,0,'Jena7','Jansen7','Jena7',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2017-12-12 21:06:10','2017-12-12 21:06:10'),(8,'test7','test7@test7.com','$2y$10$II45G8MM5HzPtfrZ6AlKoOKX7oywPcazfr5NY.8RcsZmPqKUzZ.Oq',1,1,1,0,0,'Jena8','Jansen8','Jena8',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2017-12-12 21:06:10','2017-12-12 21:06:10'),(9,'test8','test8@test8.com','$2y$10$oHvbxBq2p9fxlLdCc9.bcOp4cQVaSb0rztxHhWnZseOh0g.coZehK',1,1,1,0,0,'Jena8','Jansen8','Jena8',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2017-12-12 21:06:10','2017-12-12 21:06:10'),(10,'test9','test9@test9.com','$2y$10$ieUCt/711Q8jkSSXzloAg.KYdvF/r5GKJA4mNNpHm.2RKfT96EVYO',1,1,1,0,0,'Jena9','Jansen9','Jena9',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2017-12-12 21:06:10','2017-12-12 21:06:10'),(11,'test10','test10@test10.com','$2y$10$1Ec3Dr1BalcQRQHoAxfaFOIlxgW96yvtySqq8eazo55zGIuLl9.pe',1,1,1,0,0,'Jena10','Jansen10','Jena10',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2017-12-12 21:06:10','2017-12-12 21:06:10'),(12,'test11','test11@test11.com','$2y$10$mXbYYy5oZlNUSxdrMKhDp.N.JBckfuXUGWPfjPozLVFbvRUNvOsHa',1,1,1,0,0,'Jena11','Jansen11','Jena11',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2017-12-12 21:06:10','2017-12-12 21:06:10'),(13,'test12','test12@test12.com','$2y$10$B3oZwDZ4Svqcb7hwu3tEXukqBAmcp0LhgYSevNx1QP4Z/0hBbz41a',1,1,0,0,0,'Jena12','Jansen12','Jena12',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2017-12-12 21:06:10','2017-12-12 21:06:10'),(14,'oroku','something@something.com','$2y$10$xc3JhHk1Y1I8ZWB/zA.a3ua4a62ajdeJKEf4IYNQw/hqCSRScp5Zq',1,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2017-12-13 19:45:16','2017-12-13 19:45:16');
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

-- Dump completed on 2017-12-14  9:14:44
