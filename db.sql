/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.6.16 : Database - aplikasi-mangga
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`aplikasi-mangga` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `aplikasi-mangga`;

/*Table structure for table `data_latih` */

DROP TABLE IF EXISTS `data_latih`;

CREATE TABLE `data_latih` (
  `kode_data` int(11) NOT NULL AUTO_INCREMENT,
  `mean_g` double DEFAULT NULL,
  `momen_g` double DEFAULT NULL,
  `dev_g` double DEFAULT NULL,
  `circularity` double DEFAULT NULL,
  `compactness` double DEFAULT NULL,
  `kode_mangga` int(11) DEFAULT NULL,
  `nama_file` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`kode_data`),
  KEY `nmn` (`kode_mangga`),
  CONSTRAINT `nmn` FOREIGN KEY (`kode_mangga`) REFERENCES `mangga` (`kode_mangga`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

/*Data for the table `data_latih` */

insert  into `data_latih`(`kode_data`,`mean_g`,`momen_g`,`dev_g`,`circularity`,`compactness`,`kode_mangga`,`nama_file`) values (5,19.0089,1569.4216,39.6159,0.0675,185.9504,8,'DSC_0097.jpg'),(6,11.3314,856.1443,29.2599,0.0715,175.6719,8,'DSC_0098.jpg'),(7,11.8062,813.9857,28.5304,0.0538,233.3739,8,'DSC_0099.jpg'),(8,12.1495,907.6383,30.127,0.0686,183.1425,8,'DSC_0100.jpg'),(9,16.5175,1154.8557,33.9832,0.0669,187.8479,8,'DSC_0101.jpg'),(10,12.075,909.0813,30.151,0.0714,175.9473,8,'DSC_0102.jpg'),(11,14.4927,1105.1201,33.2433,0.0737,170.3599,8,'DSC_0103.jpg'),(12,13.7615,990.308,31.4692,0.0645,194.6927,8,'DSC_0104.jpg'),(13,12.8831,1048.3667,32.3785,0.0632,198.8306,8,'DSC_0105.jpg'),(14,11.9617,879.5323,29.6569,0.0694,181.1019,8,'DSC_0106.jpg');

/*Table structure for table `group_user` */

DROP TABLE IF EXISTS `group_user`;

CREATE TABLE `group_user` (
  `kode_group` int(11) NOT NULL AUTO_INCREMENT,
  `nama_group` varchar(50) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`kode_group`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `group_user` */

insert  into `group_user`(`kode_group`,`nama_group`,`create_at`,`update_at`) values (1,'Administrator','2015-04-25 19:05:00','2015-05-03 17:11:03'),(2,'Admin','2015-05-14 17:43:43',NULL),(3,'Guest','2015-05-21 06:17:10',NULL);

/*Table structure for table `mangga` */

DROP TABLE IF EXISTS `mangga`;

CREATE TABLE `mangga` (
  `kode_mangga` int(11) NOT NULL AUTO_INCREMENT,
  `nama_mangga` varchar(50) DEFAULT NULL,
  `biner` varchar(4) DEFAULT NULL,
  `foto` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`kode_mangga`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `mangga` */

insert  into `mangga`(`kode_mangga`,`nama_mangga`,`biner`,`foto`) values (8,'Gadung','0011','DSC_0094_(2).jpg');

/*Table structure for table `menu` */

DROP TABLE IF EXISTS `menu`;

CREATE TABLE `menu` (
  `kode_menu` int(11) NOT NULL AUTO_INCREMENT,
  `nama_menu` varchar(50) DEFAULT NULL,
  `controller` varchar(100) DEFAULT NULL,
  `kode_parent` int(11) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`kode_menu`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

/*Data for the table `menu` */

insert  into `menu`(`kode_menu`,`nama_menu`,`controller`,`kode_parent`,`create_at`,`update_at`) values (17,'Menu Admin','',0,'2015-05-06 02:37:41','2015-05-08 02:37:59'),(18,'Master Menu','admin/menu/index',17,'2015-05-06 02:05:42',NULL),(20,'Master Group','admin/group/index',17,'2015-05-06 02:27:43',NULL),(21,'Master User','admin/user/index',17,'2015-05-06 02:47:43',NULL),(22,'Data Mangga','mangga/mangga/index',0,'2015-05-06 02:39:45',NULL),(23,'Data Latih','mangga/data_latih/index',22,'2015-05-06 02:16:46','2015-05-08 02:56:59'),(24,'Master Mangga','mangga/mangga/index',22,'2015-05-29 04:47:32',NULL),(25,'Voted Perceptron','',0,'2015-05-30 02:16:24',NULL),(26,'Pelatihan','voted/pelatihan/index',25,'2015-05-30 02:56:24',NULL),(27,'Klasifikasi','voted/classification/index',25,'2015-05-30 02:33:25',NULL);

/*Table structure for table `pelatihan` */

DROP TABLE IF EXISTS `pelatihan`;

CREATE TABLE `pelatihan` (
  `kode_vektor` int(11) NOT NULL AUTO_INCREMENT,
  `v11` double DEFAULT NULL,
  `v12` double DEFAULT NULL,
  `v13` double DEFAULT NULL,
  `v14` double DEFAULT NULL,
  `v21` double DEFAULT NULL,
  `v22` double DEFAULT NULL,
  `v23` double DEFAULT NULL,
  `v24` double DEFAULT NULL,
  `v31` double DEFAULT NULL,
  `v32` double DEFAULT NULL,
  `v33` double DEFAULT NULL,
  `v34` double DEFAULT NULL,
  `v41` double DEFAULT NULL,
  `v42` double DEFAULT NULL,
  `v43` double DEFAULT NULL,
  `v44` double DEFAULT NULL,
  `v51` double DEFAULT NULL,
  `v52` double DEFAULT NULL,
  `v53` double DEFAULT NULL,
  `v54` double DEFAULT NULL,
  `c` int(11) DEFAULT NULL,
  PRIMARY KEY (`kode_vektor`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `pelatihan` */

insert  into `pelatihan`(`kode_vektor`,`v11`,`v12`,`v13`,`v14`,`v21`,`v22`,`v23`,`v24`,`v31`,`v32`,`v33`,`v34`,`v41`,`v42`,`v43`,`v44`,`v51`,`v52`,`v53`,`v54`,`c`) values (1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(2,0,0,0,0,0,0,0,0,0,0,3,9,0,6,1,1,8,5,0,9,19);

/*Table structure for table `role` */

DROP TABLE IF EXISTS `role`;

CREATE TABLE `role` (
  `kode_role` int(11) NOT NULL AUTO_INCREMENT,
  `kode_group` int(11) DEFAULT NULL,
  `kode_menu` int(11) DEFAULT NULL,
  `view` int(1) DEFAULT '0',
  `itambah` int(1) DEFAULT '0',
  `iupdate` int(1) DEFAULT '0',
  `idelete` int(1) DEFAULT '0',
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`kode_role`),
  KEY `FK_role_group` (`kode_group`),
  KEY `FK_role_menu` (`kode_menu`),
  CONSTRAINT `FK_role_group` FOREIGN KEY (`kode_group`) REFERENCES `group_user` (`kode_group`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_role_menu` FOREIGN KEY (`kode_menu`) REFERENCES `menu` (`kode_menu`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=latin1;

/*Data for the table `role` */

insert  into `role`(`kode_role`,`kode_group`,`kode_menu`,`view`,`itambah`,`iupdate`,`idelete`,`create_at`,`update_at`) values (1,1,17,1,0,0,0,'2015-05-06 02:37:41','2015-05-21 05:57:55'),(5,1,18,1,1,1,1,'2015-05-06 02:06:42','2015-05-29 04:12:32'),(13,1,20,1,1,1,1,'2015-05-06 02:27:43','2015-05-07 17:39:45'),(17,1,21,1,1,1,1,'2015-05-06 02:47:43','2015-05-07 17:21:38'),(21,1,22,1,0,0,0,'2015-05-06 02:39:45','2015-05-11 15:50:34'),(25,1,23,1,1,1,1,'2015-05-06 02:17:46','2015-05-30 02:07:09'),(28,2,17,0,0,0,0,'2015-05-14 17:43:43','2015-05-21 06:32:15'),(29,2,18,0,0,0,0,'2015-05-14 17:43:43',NULL),(31,2,20,0,0,0,0,'2015-05-14 17:43:43',NULL),(32,2,21,0,0,0,0,'2015-05-14 17:43:43',NULL),(33,2,22,1,1,1,1,'2015-05-14 17:43:43','2015-05-21 06:57:29'),(34,2,23,1,1,1,1,'2015-05-14 17:43:43','2015-05-21 06:41:15'),(35,3,17,0,0,0,0,'2015-05-21 06:17:10',NULL),(36,3,18,0,0,0,0,'2015-05-21 06:17:10',NULL),(37,3,20,0,0,0,0,'2015-05-21 06:17:10',NULL),(38,3,21,0,0,0,0,'2015-05-21 06:17:10',NULL),(39,3,22,0,0,0,0,'2015-05-21 06:17:10',NULL),(40,3,23,0,0,0,0,'2015-05-21 06:17:10',NULL),(41,1,24,1,1,1,1,'2015-05-29 04:47:32','2015-05-29 04:15:33'),(42,2,24,1,0,0,0,'2015-05-29 04:47:32','2015-06-02 16:30:13'),(43,3,24,0,0,0,0,'2015-05-29 04:47:32',NULL),(44,1,25,1,0,0,0,'2015-05-30 02:16:24','2015-05-30 02:45:25'),(45,2,25,1,0,0,0,'2015-05-30 02:16:24','2015-06-02 16:21:13'),(46,3,25,0,0,0,0,'2015-05-30 02:16:24',NULL),(47,1,26,1,1,1,1,'2015-05-30 02:56:24','2015-05-30 17:05:26'),(48,2,26,1,0,0,0,'2015-05-30 02:56:24','2015-06-02 16:26:13'),(49,3,26,0,0,0,0,'2015-05-30 02:57:24',NULL),(50,1,27,1,1,0,0,'2015-05-30 02:33:25','2015-05-30 02:56:25'),(51,2,27,1,0,0,0,'2015-05-30 02:33:25','2015-06-02 16:28:13'),(52,3,27,0,0,0,0,'2015-05-30 02:33:25',NULL);

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `kode_user` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `active` int(1) DEFAULT NULL,
  `kode_group` int(11) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`kode_user`),
  KEY `FK_user` (`kode_group`),
  CONSTRAINT `FK_user` FOREIGN KEY (`kode_group`) REFERENCES `group_user` (`kode_group`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `user` */

insert  into `user`(`kode_user`,`first_name`,`last_name`,`email`,`password`,`active`,`kode_group`,`create_at`,`update_at`) values (1,'superuser','user','nur_hidayat_45@yahoo.com','Pz4UWvfYSKak_LeURZoanO_VFT-QOG1MUbUEUwenl1c',1,1,'2015-04-26 05:17:29','2015-05-14 17:27:38'),(2,'Nur','Hidayatullah','kematjaya0@gmail.com','Az3HG264cGTGj1MlxzOHzPuYQzwjquekgIcpqJ07q4c',1,2,'2015-05-14 17:00:58','2015-05-21 06:02:16');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
