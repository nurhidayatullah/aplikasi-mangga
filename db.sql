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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `group_user` */

insert  into `group_user`(`kode_group`,`nama_group`,`create_at`,`update_at`) values (1,'Administrator','2015-04-25 19:05:00','2015-05-03 17:11:03'),(2,'Developer','2015-04-25 19:05:00','2015-04-26 05:30:10'),(8,'User','2015-04-25 17:53:23','2015-04-25 17:14:38'),(9,'Guest','2015-04-25 17:49:38',NULL);

/*Table structure for table `menu` */

DROP TABLE IF EXISTS `menu`;

CREATE TABLE `menu` (
  `kode_menu` int(11) NOT NULL AUTO_INCREMENT,
  `nama_menu` varchar(50) DEFAULT NULL,
  `controller` varchar(100) DEFAULT NULL,
  `kode_parent` int(11) DEFAULT NULL,
  PRIMARY KEY (`kode_menu`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `menu` */

insert  into `menu`(`kode_menu`,`nama_menu`,`controller`,`kode_parent`) values (1,'menu user',NULL,0),(2,'user','admin/user',1),(3,'group','admin/group',1),(4,'role','admin/role',1),(8,'menu','admin/menu',1);

/*Table structure for table `role` */

DROP TABLE IF EXISTS `role`;

CREATE TABLE `role` (
  `kode_role` int(11) NOT NULL AUTO_INCREMENT,
  `kode_group` int(11) DEFAULT NULL,
  `kode_menu` int(11) DEFAULT NULL,
  `view` int(1) DEFAULT NULL,
  `add` int(1) DEFAULT NULL,
  `edit` int(1) DEFAULT NULL,
  `delete` int(1) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`kode_role`),
  KEY `FK_role_group` (`kode_group`),
  KEY `FK_role_menu` (`kode_menu`),
  CONSTRAINT `FK_role_group` FOREIGN KEY (`kode_group`) REFERENCES `group_user` (`kode_group`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_role_menu` FOREIGN KEY (`kode_menu`) REFERENCES `menu` (`kode_menu`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `role` */

insert  into `role`(`kode_role`,`kode_group`,`kode_menu`,`view`,`add`,`edit`,`delete`,`create_at`,`update_at`) values (1,1,2,0,0,0,0,'2015-05-03 20:21:00','2015-05-03 16:00:49'),(2,1,3,1,1,1,1,'2015-05-03 20:21:00','2015-05-03 16:27:47'),(3,2,2,1,1,1,1,'2015-05-03 20:21:00','2015-05-03 16:51:48'),(4,2,3,1,1,1,1,'2015-05-03 20:21:00','2015-05-03 16:29:47');

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `user` */

insert  into `user`(`kode_user`,`first_name`,`last_name`,`email`,`password`,`active`,`kode_group`,`create_at`,`update_at`) values (3,'Nur','Hidayatullah','kematjaya0@gmail.com','25bj8EjnmZyJU7aPva_1j3MelqlmlZ0g1hXbpVJNOw8',0,2,'2015-04-26 04:21:35','2015-05-04 03:37:08'),(6,'superuser','user','nur_hidayat_45@yahoo.com','25bj8EjnmZyJU7aPva_1j3MelqlmlZ0g1hXbpVJNOw8',1,1,'2015-04-26 05:17:29','2015-05-03 17:46:29');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
