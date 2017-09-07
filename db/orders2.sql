-- MySQL dump 10.13  Distrib 5.5.57, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: orders
-- ------------------------------------------------------
-- Server version	5.5.57-0ubuntu0.14.04.1

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
-- Table structure for table `address`
--

DROP TABLE IF EXISTS `address`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `true_name` varchar(50) DEFAULT NULL COMMENT '收货人姓名',
  `mobile` char(11) NOT NULL,
  `is_default` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否为默认地址',
  `pcd` varchar(100) NOT NULL DEFAULT '',
  `info` varchar(100) NOT NULL COMMENT '收货地址其它信息',
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL COMMENT '地址名称',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='收货人地址表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `address`
--

LOCK TABLES `address` WRITE;
/*!40000 ALTER TABLE `address` DISABLE KEYS */;
INSERT INTO `address` VALUES (1,1,'zhangyg','13400994485',0,'beijing haidian ','qinghe xili7hao',NULL,NULL,NULL),(2,1,'张三','18888888888',0,'广东省 广州市 天河区','某巷某号',1504056279,1504056279,NULL);
/*!40000 ALTER TABLE `address` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL DEFAULT 'admin',
  `pwd` varchar(32) NOT NULL DEFAULT '',
  `mobile` char(11) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `login_ip` varchar(20) DEFAULT NULL,
  `login_time` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `true_name` varchar(10) DEFAULT NULL COMMENT '真实姓名',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='管理员表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (1,'admin','21232f297a57a5a743894a0e4a801fc3',NULL,NULL,'218.241.251.151',1504687244,1,NULL,1504687244,NULL);
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `adv`
--

DROP TABLE IF EXISTS `adv`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `adv` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `img` varchar(100) NOT NULL,
  `img_thumb` varchar(100) NOT NULL DEFAULT '' COMMENT '处理图片缩放',
  `url` varchar(255) NOT NULL DEFAULT '图片链接地址',
  `admin_id` int(11) NOT NULL COMMENT '后台用户',
  `create_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0不显示1显示2删除',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='首页滚动图';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adv`
--

LOCK TABLES `adv` WRITE;
/*!40000 ALTER TABLE `adv` DISABLE KEYS */;
/*!40000 ALTER TABLE `adv` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cate_shop`
--

DROP TABLE IF EXISTS `cate_shop`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cate_shop` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1正常，0删除',
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='店铺类别';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cate_shop`
--

LOCK TABLES `cate_shop` WRITE;
/*!40000 ALTER TABLE `cate_shop` DISABLE KEYS */;
INSERT INTO `cate_shop` VALUES (1,'演示店铺1',2,1497330837,1497341529),(2,'工在3ss2',2,1497330876,1497334806),(3,'演示分类1',1,1497334801,1497337801);
/*!40000 ALTER TABLE `cate_shop` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cate_shop_good`
--

DROP TABLE IF EXISTS `cate_shop_good`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cate_shop_good` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='店铺商品类别';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cate_shop_good`
--

LOCK TABLES `cate_shop_good` WRITE;
/*!40000 ALTER TABLE `cate_shop_good` DISABLE KEYS */;
INSERT INTO `cate_shop_good` VALUES (1,'演示分类1',2,1,1497342938,1497344196),(2,'arrrr',3,2,1497342951,1497344156),(3,'ddddd',1,2,1497342988,1497344150),(4,'演示分类2',0,1,1497344183,1497344183),(5,'演示分类3',2,1,1497838078,1497838078);
/*!40000 ALTER TABLE `cate_shop_good` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fankui`
--

DROP TABLE IF EXISTS `fankui`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fankui` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `good_ids` varchar(100) NOT NULL COMMENT '订单中商品',
  `user_id` int(11) NOT NULL,
  `cont` varchar(255) DEFAULT '',
  `st` tinyint(4) DEFAULT '1',
  `create_time` int(11) DEFAULT '0',
  `update_time` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `good_ids` (`good_ids`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='反馈表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fankui`
--

LOCK TABLES `fankui` WRITE;
/*!40000 ALTER TABLE `fankui` DISABLE KEYS */;
INSERT INTO `fankui` VALUES (1,5,'7,',1,'ysuj广西壮族自治区订单5 goodid7',0,1504158702,1504492909),(2,5,'7,',1,'orderid5-goodid7',0,1504158810,1504492914),(3,1,'7,8,',1,'orderid=1,good_ids=7,8,',1,1504159070,1504490834);
/*!40000 ALTER TABLE `fankui` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `good`
--

DROP TABLE IF EXISTS `good`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `good` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cate_id` tinyint(4) NOT NULL DEFAULT '1' COMMENT '商品类别',
  `img` varchar(100) DEFAULT NULL COMMENT '原图',
  `img_thumb` varchar(100) DEFAULT NULL COMMENT '缩图',
  `name` varchar(50) NOT NULL,
  `price_now` decimal(8,2) NOT NULL DEFAULT '0.00' COMMENT '现价',
  `price_original` decimal(8,2) NOT NULL DEFAULT '0.00' COMMENT '原价',
  `score` tinyint(4) NOT NULL DEFAULT '0' COMMENT '送多少积分',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `shop_id` int(11) NOT NULL DEFAULT '1' COMMENT '所属店铺',
  `in_or_out` varchar(50) NOT NULL DEFAULT '1,2' COMMENT '1堂食／2外送',
  `plus_default_show` tinyint(4) DEFAULT '1' COMMENT '列表中加号默认显示',
  `fee_canhe` decimal(5,2) DEFAULT '0.00' COMMENT '外送时餐盒费',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='店铺商品';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `good`
--

LOCK TABLES `good` WRITE;
/*!40000 ALTER TABLE `good` DISABLE KEYS */;
INSERT INTO `good` VALUES (1,1,'/uploads/20170614/b6a9e5098df1e14f81312badc2099dfc.png','/uploads/20170614/b6a9e5098df1e14f81312badc2099dfc_thumb.png','fdage444',23.00,21.00,0,1,1497349334,1497934441,1,'1,2',1,0.00),(2,4,'/uploads/20170620/38ef95bdfad1196e4df45b8ad01c861a.png','/uploads/20170620/38ef95bdfad1196e4df45b8ad01c861a_thumb.png','12',12.21,21.00,0,1,1497930422,1497930790,1,'1,2',1,0.00),(3,1,'/uploads/20170620/afeb2f38a4dbb4a5fbcebbea31e3c44d.png','/uploads/20170620/afeb2f38a4dbb4a5fbcebbea31e3c44d_thumb.png','wqeqwe',34.00,23.00,0,0,1497933580,1497933869,1,'1,2',1,0.00),(4,4,'/uploads/20170626/acc3dfb4ef36366ed9d7360af1f2af34.png','/uploads/20170626/acc3dfb4ef36366ed9d7360af1f2af34_thumb.png','asdsaf',23.00,12.00,0,1,1498452695,1498452695,1,'1,2',1,0.00),(5,4,'/uploads/20170630/ff000e02ffdf61941215486f32454919.png','/uploads/20170630/ff000e02ffdf61941215486f32454919_thumb.png','adfg',23.00,12.00,0,1,1498816653,1498816653,1,'1,2',1,1.00),(6,4,'/uploads/20170630/6e1b4b5950e9debfef9e67b77464dc38.png','/uploads/20170630/6e1b4b5950e9debfef9e67b77464dc38_thumb.png','adfg',23.00,12.00,0,1,1498816717,1498816717,1,'1,2',1,2.00),(7,4,'/uploads/20170829/20f6728a3e6313b84d59571b2258cf0a.jpg','/uploads/20170829/20f6728a3e6313b84d59571b2258cf0a_thumb.jpg','蛋糕草梅',0.02,1.00,0,1,1498816809,1504162835,1,'1,2',1,0.01),(8,4,'/uploads/20170829/e500fb86d0323449dd669a3cd19d8d13.png','/uploads/20170829/e500fb86d0323449dd669a3cd19d8d13_thumb.png','瘦肉粥',0.01,12.00,0,1,1498817043,1504000665,1,'1',1,0.00),(9,4,'/uploads/20170829/cf2f0d1b4fd8dd79938551bc92a28463.png','/uploads/20170829/cf2f0d1b4fd8dd79938551bc92a28463_thumb.png','汉堡包-鸡肉',0.01,12.00,0,1,1499045853,1504001289,1,'1,2',1,0.01);
/*!40000 ALTER TABLE `good` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order`
--

DROP TABLE IF EXISTS `order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trade_no` varchar(50) DEFAULT NULL COMMENT 'order bianhao',
  `refund_no` char(32) DEFAULT '',
  `user_id` int(11) NOT NULL,
  `address_id` int(11) DEFAULT '0',
  `sum_price` decimal(10,2) DEFAULT NULL COMMENT '商品总价',
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '订单状态（与支付相关）：1待支付 2已支付 3申请退款 4退款成功 5由用户取消 0由管理员删除',
  `type` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1堂食或是2外送订单',
  `to_shop_time` int(11) DEFAULT '0' COMMENT 'the time to shop，when it is type of 1',
  `note` varchar(200) DEFAULT '' COMMENT '订单备注',
  `good_st` tinyint(4) NOT NULL DEFAULT '1' COMMENT '商品状态（与送货相关）：1待做 2做饭中 3已做完 4已送出 5已收到 6已评价',
  PRIMARY KEY (`id`),
  UNIQUE KEY `trade_no` (`trade_no`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COMMENT='订单表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order`
--

LOCK TABLES `order` WRITE;
/*!40000 ALTER TABLE `order` DISABLE KEYS */;
INSERT INTO `order` VALUES (1,'082917074421_JqY0n8','',1,-1,0.05,1503997664,1504159070,2,1,0,'这个要饣好哦',6),(2,'083009242335_JqY0n8','',1,2,0.09,1504056263,1504078414,6,2,0,NULL,6),(3,'083009434036_JqY0n8','',1,-1,0.01,1504057420,1504169036,4,1,0,'请不要放辣的哦，谢谢',1),(4,'083009440638_JqY0n8','',1,-1,0.02,1504057446,1504077820,5,1,0,NULL,1),(5,'083009441941_JqY0n8','090116392266_zNTf7W_refund',1,2,0.03,1504057459,1504689634,3,2,0,' 提交业务失败 提交业务失败 提交业务失败 提交业务失败 提交业务失败 提交业务失败 提交业务失败 提交业务失败 提交业务失败 提交业务失败 提交业务失败 提交业务失败 提交业务失败 提交业务失败 提交业务失败 提交业务失败 提交业务失败 提交业务失败 提交业务失败 提交业务失败 提交业务失败 提交业务失败 提交业务失败 提交业务失败 提交业务失败 提交业务失败 提交业务失败 提交业务失败 提交业',1),(6,'083010441193_ut8DS2','',1,-1,0.01,1504061051,1504061051,2,1,0,NULL,5),(7,'083115175227_JqY0n8','090116402568_zNTf7W_refund',1,2,0.04,1504163872,1504255225,2,2,0,'',5),(8,'090109573336_JqY0n8','090114181787_JqY0n8_refund',1,-1,0.01,1504231053,1504261968,4,1,0,'不要放太多盐啊。。。。',1),(9,'090111074596_JqY0n8','',1,-1,23.00,1504235265,1504235265,1,1,0,'',1),(10,'090111103172_JqY0n8','',1,2,23.01,1504235431,1504235431,1,2,0,'',1),(11,'090115571881_zNTf7W','',1,0,0.04,1504252638,1504252638,1,2,0,'',1),(12,'090116000429_zNTf7W','',1,2,0.04,1504252804,1504252804,1,2,0,'',1),(13,'090513230329_zNTf7W','',1,-1,46.00,1504588983,1504588983,1,1,0,'',1),(14,'090513482036_zNTf7W','',1,2,0.03,1504590500,1504590500,1,2,0,'',1),(15,'090617044298_zNTf7W','',1,-1,0.01,1504688682,1504688682,1,1,0,'',1),(16,'090617050916_zNTf7W','',1,2,23.01,1504688709,1504688709,1,2,0,'',1);
/*!40000 ALTER TABLE `order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_good`
--

DROP TABLE IF EXISTS `order_good`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_good` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `good_id` int(11) NOT NULL,
  `num` int(11) NOT NULL DEFAULT '0' COMMENT '商品的数量',
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`,`good_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COMMENT='定单商品表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_good`
--

LOCK TABLES `order_good` WRITE;
/*!40000 ALTER TABLE `order_good` DISABLE KEYS */;
INSERT INTO `order_good` VALUES (1,1,8,1),(2,1,7,2),(3,2,9,2),(4,2,7,3),(5,3,8,1),(6,4,7,1),(7,5,7,1),(8,6,9,1),(9,7,9,1),(10,7,7,1),(11,8,8,1),(12,9,6,1),(13,10,6,1),(14,11,9,1),(15,11,7,1),(16,12,9,1),(17,12,7,1),(18,13,5,1),(19,13,4,1),(20,14,9,2),(21,15,9,1),(22,16,6,1);
/*!40000 ALTER TABLE `order_good` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop`
--

DROP TABLE IF EXISTS `shop`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cate_shop_id` tinyint(4) NOT NULL DEFAULT '1' COMMENT '店铺类别',
  `img_thumb` varchar(100) DEFAULT NULL COMMENT '店铺缩图',
  `name` varchar(50) NOT NULL,
  `stars` tinyint(4) NOT NULL DEFAULT '5' COMMENT '星级',
  `functions` varchar(50) DEFAULT '1,2' COMMENT '功能：1 wifi,2 刷卡，3停车位，4包箱',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '默认营业中,0不营业',
  `fee_start_post` decimal(8,2) NOT NULL DEFAULT '0.00' COMMENT '起送费',
  `fee_post` decimal(8,2) NOT NULL DEFAULT '0.00' COMMENT '配送费',
  `avg_price` decimal(8,2) DEFAULT NULL COMMENT '人均价格',
  `addr_detail` varchar(100) DEFAULT '' COMMENT '地址详情',
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `img` varchar(100) DEFAULT NULL COMMENT '原图',
  `cate_name` varchar(50) DEFAULT NULL COMMENT '类别名称',
  `info` text COMMENT '介绍',
  `phone` varchar(50) DEFAULT NULL COMMENT '电话',
  `wx` varchar(50) DEFAULT NULL COMMENT 'wx',
  `qq` varchar(50) DEFAULT NULL COMMENT 'qq',
  `start_time` char(5) NOT NULL DEFAULT '00:00' COMMENT '开业时间',
  `end_time` char(5) NOT NULL DEFAULT '00:00' COMMENT '关业时间',
  `slogan` varchar(50) NOT NULL DEFAULT '好吃好吃在这里' COMMENT '标语',
  `in_or_out` varchar(50) NOT NULL DEFAULT '1,2' COMMENT '1堂食／2外送',
  `latitude` varchar(50) NOT NULL DEFAULT '0' COMMENT '纬度',
  `longitude` varchar(50) NOT NULL DEFAULT '0' COMMENT '经度',
  `addr_name` varchar(50) DEFAULT '' COMMENT '地址名称',
  `address_more` varchar(50) DEFAULT '' COMMENT '地址补充',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='店铺';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop`
--

LOCK TABLES `shop` WRITE;
/*!40000 ALTER TABLE `shop` DISABLE KEYS */;
INSERT INTO `shop` VALUES (1,3,'/uploads/20170829/ec1a0b7208e7bfd3fcc16e1d01159ea9_thumb.png','sh0p1',5,'1,2,3,4',1,0.02,0.01,1.00,'北京市朝阳区潘家园桥西南',1498030025,1504685704,'/uploads/20170829/ec1a0b7208e7bfd3fcc16e1d01159ea9.png',NULL,'          本店介绍本店介绍','13222343345','     adfar234','13465435637','02:03','15:04','          没有最好，只有更好只有更好','1,2','39.87546','116.45841','潘家园旧货市场','12号');
/*!40000 ALTER TABLE `shop` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `open_id` varchar(255) NOT NULL DEFAULT 'asdf4657489234asdfasdg' COMMENT '微信用户的',
  `nickname` varchar(50) NOT NULL DEFAULT '微信昵称',
  `name` varchar(20) NOT NULL DEFAULT '' COMMENT '用户名',
  `pwd` varchar(32) NOT NULL DEFAULT '' COMMENT 'md5加密保存',
  `mobile` char(11) NOT NULL DEFAULT '',
  `sex` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1为男',
  `vistar` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(100) DEFAULT NULL,
  `login_ip` varchar(20) DEFAULT NULL,
  `login_time` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `open_id` (`open_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='会员表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'o8jjv0EjELzgPLxIavOKL7NAbdO4','zyg～php','zNTf7W','','',1,'https://wx.qlogo.cn/mmopen/vi_32/fbWPBkibNZDERvMIh9r6aaLNO4Iuabr01qgZuulwSOLaLiaaM9I68k3UpgeWMsbdZeoT6gHgJrqHP0LldTbQicibaA/0',NULL,NULL,NULL,1,1504252253,NULL);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-09-07 11:46:00
