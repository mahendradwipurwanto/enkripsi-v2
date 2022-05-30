/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 10.4.22-MariaDB : Database - db_otpsayur
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_otpsayur` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `db_otpsayur`;

/*Table structure for table `tb_auth` */

DROP TABLE IF EXISTS `tb_auth`;

CREATE TABLE `tb_auth` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` int(5) NOT NULL DEFAULT 0,
  `role` int(5) NOT NULL DEFAULT 2,
  `aktivasi` varchar(255) DEFAULT NULL,
  `otp` varchar(255) DEFAULT NULL,
  `expired_otp` varchar(255) DEFAULT NULL,
  `created_at` int(11) NOT NULL DEFAULT 0,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `tb_auth` */

insert  into `tb_auth`(`user_id`,`email`,`password`,`status`,`role`,`aktivasi`,`otp`,`expired_otp`,`created_at`,`is_deleted`) values 
(5,'admin@tokosayur.com','$2y$10$31CQBgl.x.HsutNvGn6IaucdHM8tpyp4/ymL4qF7IpYm4T/QBGTYO',1,1,'0f49f2360cfbcfb6f0e033f40faff81437ba612bf45b15ebdba9497ccff2d2488c7b7adb89b011b4aec44e01c2647c22f1d9d91d92aa17c14dbaa1b7bc9ce7fcn5d3vWDzwKCfCnKRYtG8m8A+2svUN8hIQ3JOJcN96bw=','eda15e5c1f2778f0a2b8323f0914ca8fcc530e55fef4e5d9ad4e6d214509ac3f3bcac94d55d994942c54cb9ba79fcf068bf8c8422f89d0c8b5b45e2a4a917b6b8fo6H+TYmVxHfBFhrWLw0TlJ9VfhB8+I1QBjLQN73Vo=','1653839610',0,0);

/*Table structure for table `tb_pengunjung` */

DROP TABLE IF EXISTS `tb_pengunjung`;

CREATE TABLE `tb_pengunjung` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `device` text DEFAULT NULL,
  `created_at` int(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=175 DEFAULT CHARSET=utf8;

/*Data for the table `tb_pengunjung` */

/*Table structure for table `tb_sayur` */

DROP TABLE IF EXISTS `tb_sayur`;

CREATE TABLE `tb_sayur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sayur` varchar(50) DEFAULT NULL,
  `gambar` varchar(255) DEFAULT 'assets/images/placeholder.png',
  `stok` int(20) NOT NULL DEFAULT 0,
  `harga` int(20) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` int(20) NOT NULL DEFAULT 0,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Data for the table `tb_sayur` */

/*Table structure for table `tb_settings` */

DROP TABLE IF EXISTS `tb_settings`;

CREATE TABLE `tb_settings` (
  `key` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` int(11) NOT NULL DEFAULT 0,
  `modified_at` int(11) NOT NULL DEFAULT 0,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `tb_settings` */

insert  into `tb_settings`(`key`,`value`,`desc`,`created_at`,`modified_at`,`is_deleted`) values 
('mailer_alias','Toko Sayur Indonesia',NULL,1653641032,0,0),
('mailer_host','smtp.gmail.com',NULL,1653641032,0,0),
('mailer_mode','0',NULL,1653641032,0,0),
('mailer_password','hazyzcmjpgjfjitd',NULL,1653641032,0,0),
('mailer_port','587',NULL,1653641032,0,0),
('mailer_username','ngodingin.indonesia@gmail.com',NULL,1653641032,0,0),
('web_desc','This is Base Project Template',NULL,1653641032,0,0),
('web_icon','favicon.ico',NULL,1653641032,0,0),
('web_logo','favicon.ico',NULL,1653641032,0,0),
('web_title','Toko Sayur',NULL,1653641032,0,0);

/*Table structure for table `tb_user` */

DROP TABLE IF EXISTS `tb_user`;

CREATE TABLE `tb_user` (
  `user_id` int(11) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `profil` varchar(255) DEFAULT 'assets/images/profile.png',
  `no_telp` varchar(20) DEFAULT NULL,
  `alamat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `tb_user` */

insert  into `tb_user`(`user_id`,`nama`,`profil`,`no_telp`,`alamat`) values 
(5,'Ngodingin Indonesia','assets/images/profile.png','085785111746',NULL);

/*Table structure for table `tb_wishlist` */

DROP TABLE IF EXISTS `tb_wishlist`;

CREATE TABLE `tb_wishlist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `status` int(5) NOT NULL DEFAULT 1,
  `created_at` int(11) NOT NULL DEFAULT 0,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

/*Data for the table `tb_wishlist` */

/*Table structure for table `tb_wishlist_detail` */

DROP TABLE IF EXISTS `tb_wishlist_detail`;

CREATE TABLE `tb_wishlist_detail` (
  `wishlist_id` int(11) DEFAULT NULL,
  `sayur_id` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `tb_wishlist_detail` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
