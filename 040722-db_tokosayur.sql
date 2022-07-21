/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 10.4.22-MariaDB : Database - db_otpproduk
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `tb_auth` */

insert  into `tb_auth`(`user_id`,`email`,`password`,`status`,`role`,`aktivasi`,`otp`,`expired_otp`,`created_at`,`is_deleted`) values 
(5,'admin@tokoproduk.com','$2y$10$31CQBgl.x.HsutNvGn6IaucdHM8tpyp4/ymL4qF7IpYm4T/QBGTYO',1,1,'0f49f2360cfbcfb6f0e033f40faff81437ba612bf45b15ebdba9497ccff2d2488c7b7adb89b011b4aec44e01c2647c22f1d9d91d92aa17c14dbaa1b7bc9ce7fcn5d3vWDzwKCfCnKRYtG8m8A+2svUN8hIQ3JOJcN96bw=','eda15e5c1f2778f0a2b8323f0914ca8fcc530e55fef4e5d9ad4e6d214509ac3f3bcac94d55d994942c54cb9ba79fcf068bf8c8422f89d0c8b5b45e2a4a917b6b8fo6H+TYmVxHfBFhrWLw0TlJ9VfhB8+I1QBjLQN73Vo=','1653839610',0,0),
(6,'mahendradwipurwanto@gmail.com','$2y$10$wx7x9ndaPAKvB6MG.CP75uazGTc2IxW5cPP4e1bCqe4InPUEDdcsC',1,2,'c209cb53caf5e85f3bad79c9f072f32de5aaeeab1127009dd773050e493e28a55741673124cf738ad826399314b911407bc9702bd3261319aec7832c859b162bYSyyhuOvW0PrYvK/rem8JU+U8orOHN/KJLWjcY8hi/Y=','d4f0c7b20e2c7824f711481fa24f62513e91d4212ddb1556706604d1dd525b1a7bf072195e46312d5261d32aaa0bffe796edb0f0548f2f6bff2cace84ee83f7ffhuFVdQN7pmWCGA5McP4MM3KDHA+MdN+rus7WiFAZZA=','1656229761',1656229653,0);

/*Table structure for table `tb_pengunjung` */

DROP TABLE IF EXISTS `tb_pengunjung`;

CREATE TABLE `tb_pengunjung` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `device` text DEFAULT NULL,
  `created_at` int(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=184 DEFAULT CHARSET=utf8;

/*Data for the table `tb_pengunjung` */

insert  into `tb_pengunjung`(`id`,`device`,`created_at`) values 
(175,'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.5005.63 Safari/537.36',1653885323),
(176,'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.0.0 Safari/537.36',1656229631),
(177,'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.0.0 Safari/537.36',1656229704),
(178,'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.0.0 Safari/537.36',1656229718),
(179,'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.0.0 Safari/537.36',1656229749),
(180,'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.0.0 Safari/537.36',1656229772),
(181,'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.0.0 Safari/537.36',1656229952),
(182,'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.0.0 Safari/537.36',1656230109),
(183,'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.0.0 Safari/537.36',1656230123);

/*Table structure for table `tb_produk` */

DROP TABLE IF EXISTS `tb_produk`;

CREATE TABLE `tb_produk` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sayur` varchar(50) DEFAULT NULL,
  `gambar` varchar(255) DEFAULT 'assets/images/placeholder.png',
  `stok` int(20) NOT NULL DEFAULT 0,
  `harga` int(20) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` int(20) NOT NULL DEFAULT 0,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

/*Data for the table `tb_produk` */

insert  into `tb_produk`(`id`,`sayur`,`gambar`,`stok`,`harga`,`keterangan`,`created_at`,`is_deleted`) values 
(9,'Kentang Segar','berkas/sayur/1656229744.jpg',5,25000,'',0,0);

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
('mailer_alias','Toko Produk Indonesia',NULL,1653641032,0,0),
('mailer_host','smtp.gmail.com',NULL,1653641032,0,0),
('mailer_mode','0',NULL,1653641032,0,0),
('mailer_password','hazyzcmjpgjfjitd',NULL,1653641032,0,0),
('mailer_port','587',NULL,1653641032,0,0),
('mailer_username','ngodingin.indonesia@gmail.com',NULL,1653641032,0,0),
('web_desc','This is Base Project Template',NULL,1653641032,0,0),
('web_icon','favicon.ico',NULL,1653641032,0,0),
('web_logo','favicon.ico',NULL,1653641032,0,0),
('web_title','Toko Produk',NULL,1653641032,0,0);

/*Table structure for table `tb_user` */

DROP TABLE IF EXISTS `tb_user`;

CREATE TABLE `tb_user` (
  `user_id` int(11) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `profil` varchar(255) DEFAULT 'assets/images/profile.png',
  `no_telp` varchar(20) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  KEY `user_id` (`user_id`),
  CONSTRAINT `tb_user_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tb_auth` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `tb_user` */

insert  into `tb_user`(`user_id`,`nama`,`profil`,`no_telp`,`alamat`) values 
(5,'Ngodingin Indonesia','assets/images/profile.png','085785111746',NULL),
(6,'Mahendra Dwi Purwanto','assets/images/profile.png','085785111746',NULL);

/*Table structure for table `tb_wishlist` */

DROP TABLE IF EXISTS `tb_wishlist`;

CREATE TABLE `tb_wishlist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `status` int(5) NOT NULL DEFAULT 1,
  `created_at` int(11) NOT NULL DEFAULT 0,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `tb_wishlist_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tb_auth` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

/*Data for the table `tb_wishlist` */

insert  into `tb_wishlist`(`id`,`user_id`,`catatan`,`status`,`created_at`,`is_deleted`) values 
(14,6,'test',1,1656230123,0);

/*Table structure for table `tb_wishlist_detail` */

DROP TABLE IF EXISTS `tb_wishlist_detail`;

CREATE TABLE `tb_wishlist_detail` (
  `wishlist_id` int(11) DEFAULT NULL,
  `produk_id` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  KEY `wishlist_id` (`wishlist_id`),
  KEY `produk_id` (`produk_id`),
  CONSTRAINT `tb_wishlist_detail_ibfk_1` FOREIGN KEY (`wishlist_id`) REFERENCES `tb_wishlist` (`id`),
  CONSTRAINT `tb_wishlist_detail_ibfk_2` FOREIGN KEY (`produk_id`) REFERENCES `tb_produk` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `tb_wishlist_detail` */

insert  into `tb_wishlist_detail`(`wishlist_id`,`produk_id`,`jumlah`) values 
(14,9,5);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
