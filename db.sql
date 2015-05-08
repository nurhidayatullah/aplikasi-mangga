/*
SQLyog Enterprise - MySQL GUI v7.02 
MySQL - 5.6.16 : Database - aplikasi-mangga
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

CREATE DATABASE /*!32312 IF NOT EXISTS*/`aplikasi-mangga` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `aplikasi-mangga`;

/*Table structure for table `group_user` */

DROP TABLE IF EXISTS `group_user`;

CREATE TABLE `group_user` (
  `kode_group` int(11) NOT NULL AUTO_INCREMENT,
  `nama_group` varchar(50) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`kode_group`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `group_user` */

insert  into `group_user`(`kode_group`,`nama_group`,`create_at`,`update_at`) values (1,'Administrator','2015-04-25 19:05:00','2015-05-03 17:11:03'),(2,'Developer','2015-04-25 19:05:00','2015-04-26 05:30:10'),(8,'User','2015-04-25 17:53:23','2015-04-25 17:14:38');

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
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

/*Data for the table `menu` */

insert  into `menu`(`kode_menu`,`nama_menu`,`controller`,`kode_parent`,`create_at`,`update_at`) values (17,'Menu Admin','',0,'2015-05-06 02:37:41','2015-05-08 02:37:59'),(18,'Master Menu','admin/menu/index',17,'2015-05-06 02:05:42',NULL),(19,'Master Hak Akses','admin/role/index',17,'2015-05-06 02:41:42',NULL),(20,'Master Group','admin/group/index',17,'2015-05-06 02:27:43',NULL),(21,'Master User','admin/user/index',17,'2015-05-06 02:47:43',NULL),(22,'Data Mangga','mangga/mangga/index',0,'2015-05-06 02:39:45',NULL),(23,'Data Latih','mangga/data_latih/index',22,'2015-05-06 02:16:46','2015-05-08 02:56:59');

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
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;

/*Data for the table `role` */

insert  into `role`(`kode_role`,`kode_group`,`kode_menu`,`view`,`itambah`,`iupdate`,`idelete`,`create_at`,`update_at`) values (1,1,17,1,1,1,1,'2015-05-06 02:37:41','2015-05-07 17:03:45'),(2,2,17,1,1,1,1,'2015-05-06 02:37:41','2015-05-07 17:56:44'),(3,8,17,0,0,0,0,'2015-05-06 02:37:41','2015-05-07 17:39:44'),(5,1,18,1,1,1,1,'2015-05-06 02:06:42','2015-05-08 15:32:49'),(6,2,18,1,1,1,1,'2015-05-06 02:06:42','2015-05-07 17:16:45'),(7,8,18,0,0,0,0,'2015-05-06 02:06:42','2015-05-07 17:08:45'),(9,1,19,1,1,1,1,'2015-05-06 02:41:42','2015-05-07 06:05:55'),(10,2,19,1,0,0,0,'2015-05-06 02:41:42','2015-05-08 15:07:55'),(11,8,19,0,0,0,0,'2015-05-06 02:41:42',NULL),(13,1,20,1,1,1,1,'2015-05-06 02:27:43','2015-05-07 17:39:45'),(14,2,20,1,1,1,1,'2015-05-06 02:27:43','2015-05-07 17:37:45'),(15,8,20,0,0,0,0,'2015-05-06 02:27:43',NULL),(17,1,21,1,1,1,1,'2015-05-06 02:47:43','2015-05-07 17:21:38'),(18,2,21,1,1,1,1,'2015-05-06 02:47:43','2015-05-07 17:51:58'),(19,8,21,0,0,0,0,'2015-05-06 02:47:43',NULL),(21,1,22,1,1,1,1,'2015-05-06 02:39:45','2015-05-07 17:04:46'),(22,2,22,1,1,1,1,'2015-05-06 02:39:45','2015-05-07 17:03:46'),(23,8,22,1,0,0,0,'2015-05-06 02:40:45','2015-05-08 03:10:03'),(25,1,23,1,1,1,1,'2015-05-06 02:17:46','2015-05-07 17:15:46'),(26,2,23,1,1,1,1,'2015-05-06 02:17:46','2015-05-07 17:14:46'),(27,8,23,1,1,1,1,'2015-05-06 02:17:46','2015-05-08 03:23:03');

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `user` */

insert  into `user`(`kode_user`,`first_name`,`last_name`,`email`,`password`,`active`,`kode_group`,`create_at`,`update_at`) values (3,'Nur','Hidayatullah','kematjaya0@gmail.com','Az3HG264cGTGj1MlxzOHzPuYQzwjquekgIcpqJ07q4c',1,2,'2015-04-26 04:21:35','2015-05-04 03:37:08'),(6,'superuser','user','nur_hidayat_45@yahoo.com','Az3HG264cGTGj1MlxzOHzPuYQzwjquekgIcpqJ07q4c',1,1,'2015-04-26 05:17:29','2015-05-03 17:46:29'),(7,'ady','Setyawan','ady@gmail.com','Az3HG264cGTGj1MlxzOHzPuYQzwjquekgIcpqJ07q4c',1,8,'2015-05-07 06:19:48','2015-05-07 18:57:03');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
