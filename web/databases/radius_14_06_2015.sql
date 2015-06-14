-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 14, 2015 at 10:40 AM
-- Server version: 5.5.43-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `radius`
--

-- --------------------------------------------------------

--
-- Table structure for table `app_acl_language`
--

CREATE TABLE IF NOT EXISTS `app_acl_language` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `abbreviation` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `app_acl_language`
--

INSERT INTO `app_acl_language` (`id`, `name`, `abbreviation`) VALUES
(1, 'English', 'en'),
(2, 'Français', 'fr'),
(3, 'Deutsch', 'de'),
(4, 'Español', 'es'),
(5, 'Italiano', 'it'),
(6, 'Български', 'bg');

-- --------------------------------------------------------

--
-- Table structure for table `app_acl_question`
--

CREATE TABLE IF NOT EXISTS `app_acl_question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_767FF0CEB6F7494E` (`question`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `app_acl_question`
--

INSERT INTO `app_acl_question` (`id`, `question`) VALUES
(3, 'In what city did your father born?'),
(2, 'In what city did your mother born?'),
(4, 'In what city or town was your first job?'),
(1, 'What was your childhood phone number?');

-- --------------------------------------------------------

--
-- Table structure for table `app_acl_role`
--

CREATE TABLE IF NOT EXISTS `app_acl_role` (
  `id` int(11) NOT NULL,
  `name` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `app_acl_role`
--

INSERT INTO `app_acl_role` (`id`, `name`) VALUES
(1, 'Guest'),
(2, 'Member'),
(3, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `app_acl_state`
--

CREATE TABLE IF NOT EXISTS `app_acl_state` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `state` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8F65C071A393D2FB` (`state`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `app_acl_state`
--

INSERT INTO `app_acl_state` (`id`, `state`) VALUES
(1, 'Disabled'),
(2, 'Enabled');

-- --------------------------------------------------------

--
-- Table structure for table `app_acl_user`
--

CREATE TABLE IF NOT EXISTS `app_acl_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `username` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `answer` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `registration_date` datetime DEFAULT NULL,
  `registration_token` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_confirmed` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_A21FD7F7F85E0677` (`username`),
  UNIQUE KEY `UNIQ_A21FD7F7E7927C74` (`email`),
  KEY `IDX_A21FD7F7D60322AC` (`role_id`),
  KEY `IDX_A21FD7F782F1BAF4` (`language_id`),
  KEY `IDX_A21FD7F75D83CC1` (`state_id`),
  KEY `IDX_A21FD7F71E27F6BF` (`question_id`),
  KEY `search_idx` (`username`,`first_name`,`last_name`,`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `app_acl_user`
--

INSERT INTO `app_acl_user` (`id`, `role_id`, `language_id`, `state_id`, `question_id`, `username`, `first_name`, `last_name`, `email`, `password`, `answer`, `picture`, `registration_date`, `registration_token`, `email_confirmed`) VALUES
(1, 2, 1, 2, 2, 'sysadmin', '12344321', '123', 'hieunguyenminh.93@gmail.com', '$2y$10$BBdSvTEOV/KGQP92EdGJHe2fLvc6B3Kz4MHKKmfUz6AyINGC/xYYi', 'ho chi minh', NULL, '2015-05-27 00:36:28', 'df78bd3949fe8fc454dccb97828e562f', 1);

-- --------------------------------------------------------

--
-- Table structure for table `app_active_code`
--

CREATE TABLE IF NOT EXISTS `app_active_code` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) DEFAULT NULL,
  `code` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `app_active_code`
--

INSERT INTO `app_active_code` (`id`, `username`, `code`) VALUES
(11, 'sysadmin', 'active'),
(12, 'sysadmin1', 'active'),
(13, 'hieu1234', 'active'),
(14, 'hieu', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `app_building`
--

CREATE TABLE IF NOT EXISTS `app_building` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `building_name` varchar(45) DEFAULT NULL,
  `building_address` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `app_mapper_nas_ip`
--

CREATE TABLE IF NOT EXISTS `app_mapper_nas_ip` (
  `ip` varchar(15) DEFAULT NULL,
  `nas` varchar(15) DEFAULT NULL,
  `descriptions` text,
  `id` int(10) unsigned zerofill NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `app_modules`
--

CREATE TABLE IF NOT EXISTS `app_modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `description` text CHARACTER SET utf8,
  `attribute` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `app_modules`
--

INSERT INTO `app_modules` (`id`, `name`, `description`, `attribute`, `status`, `created`, `created_by`) VALUES
(1, 'Băng thông edit', 'Băng thông sử dụng toàn bộ!', 'Max-All-Session', 1, '2015-05-24 23:05:48', 1),
(2, 'Băng thông', 'Loại Băng thông', NULL, NULL, '2015-05-24 13:05:00', 1),
(3, 'Băng thông', 'Băng thông', NULL, NULL, '2015-05-24 13:05:44', 1),
(4, 'đã sửa', 'aéad', 'Max-Daily-Session', 1, '2015-05-25 04:05:44', 2);

-- --------------------------------------------------------

--
-- Table structure for table `app_orders`
--

CREATE TABLE IF NOT EXISTS `app_orders` (
  `orderid` int(11) NOT NULL AUTO_INCREMENT,
  `customerid` int(11) DEFAULT NULL,
  `orderdate` datetime DEFAULT NULL,
  `status` int(11) DEFAULT '0',
  `sumtotal` decimal(18,0) DEFAULT NULL,
  PRIMARY KEY (`orderid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `app_orders`
--

INSERT INTO `app_orders` (`orderid`, `customerid`, `orderdate`, `status`, `sumtotal`) VALUES
(1, 1, '2015-05-25 08:05:33', 0, 10000),
(2, 3, '2015-05-25 08:05:33', 0, 10000),
(3, 4, '2015-05-25 08:05:33', 0, 10000),
(4, 6, '2015-05-25 08:05:33', 0, 10000),
(5, 7, '2015-05-25 08:05:33', 0, 10000),
(6, 8, '2015-05-25 08:05:34', 0, 10000),
(7, 9, '2015-05-25 08:05:34', 0, 10000),
(8, 10, '2015-05-25 08:05:34', 0, 10000),
(9, 11, '2015-05-25 08:05:34', 0, 10000),
(10, 2, '2015-05-31 13:05:52', 0, 10000),
(11, 1, '2015-06-02 07:06:55', 0, 10000),
(12, 2, '2015-06-02 07:06:56', 0, 10000),
(13, 4, '2015-06-04 15:06:03', 0, 10000),
(14, 5, '2015-06-04 15:06:03', 0, 10000),
(15, 6, '2015-06-04 15:06:03', 0, 10000),
(16, 7, '2015-06-04 15:06:03', 0, 10000),
(17, 8, '2015-06-04 15:06:03', 0, 10000),
(18, 9, '2015-06-04 15:06:03', 0, 10000),
(19, 10, '2015-06-04 15:06:04', 0, 10000),
(20, 11, '2015-06-04 15:06:04', 0, 10000),
(21, 12, '2015-06-04 15:06:04', 0, 10000),
(22, 13, '2015-06-04 15:06:04', 0, 10000);

-- --------------------------------------------------------

--
-- Table structure for table `app_order_details`
--

CREATE TABLE IF NOT EXISTS `app_order_details` (
  `orderid` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `unitprice` decimal(18,2) NOT NULL DEFAULT '0.00',
  `quantity` smallint(2) NOT NULL DEFAULT '1',
  `discount` double(8,0) NOT NULL DEFAULT '0',
  `total` decimal(18,2) DEFAULT NULL,
  PRIMARY KEY (`orderid`,`productid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `app_order_details`
--

INSERT INTO `app_order_details` (`orderid`, `productid`, `unitprice`, `quantity`, `discount`, `total`) VALUES
(1, 1, 10000.00, 1, 0, 10000.00),
(2, 1, 10000.00, 1, 0, 10000.00),
(3, 1, 10000.00, 1, 0, 10000.00),
(4, 1, 10000.00, 1, 0, 10000.00),
(5, 1, 10000.00, 1, 0, 10000.00),
(6, 1, 10000.00, 1, 0, 10000.00),
(7, 1, 10000.00, 1, 0, 10000.00),
(8, 1, 10000.00, 1, 0, 10000.00),
(9, 1, 10000.00, 1, 0, 10000.00),
(10, 1, 10000.00, 1, 0, 10000.00),
(11, 1, 10000.00, 1, 0, 10000.00),
(12, 1, 10000.00, 1, 0, 10000.00),
(13, 1, 10000.00, 1, 0, 10000.00),
(14, 1, 10000.00, 1, 0, 10000.00),
(15, 1, 10000.00, 1, 0, 10000.00),
(16, 1, 10000.00, 1, 0, 10000.00),
(17, 1, 10000.00, 1, 0, 10000.00),
(18, 1, 10000.00, 1, 0, 10000.00),
(19, 1, 10000.00, 1, 0, 10000.00),
(20, 1, 10000.00, 1, 0, 10000.00),
(21, 1, 10000.00, 1, 0, 10000.00),
(22, 1, 10000.00, 1, 0, 10000.00);

-- --------------------------------------------------------

--
-- Table structure for table `app_products`
--

CREATE TABLE IF NOT EXISTS `app_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `category` int(11) DEFAULT NULL,
  `price` decimal(18,2) DEFAULT NULL,
  `value` decimal(18,0) NOT NULL,
  `unit` text CHARACTER SET utf8,
  `created` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `app_products`
--

INSERT INTO `app_products` (`id`, `name`, `category`, `price`, `value`, `unit`, `created`, `created_by`) VALUES
(1, 'Gói băng thông 1GB edit', 1, 10000.00, 1024, 'VND', '2015-05-25 04:05:37', 2),
(2, 'Gói băng thông 1GB 2', 1, 10000.00, 1024, 'VND', '2015-05-25 04:05:21', 2),
(3, 'Gói băng thông 2GB', 1, 10000.00, 2048, 'VND', '2015-05-25 04:05:56', 2),
(4, 'Gói băng thông 1GB', 1, 10000.00, 1024, 'VND', '2015-05-25 04:05:54', 2),
(5, 'Gói băng thông 1GB', 1, 10000.00, 1024, 'VND', '2015-05-24 17:05:23', 1),
(6, 'Gói băng thông 1GB edit', 1, 10000.00, 1024, 'VND', '2015-05-24 17:05:44', 1),
(7, 'Gói băng thông 10GB', 1, 100000.00, 10240, 'VND', '2015-05-24 17:05:53', 1),
(8, 'Gói băng thông 20GB', 1, 200000.00, 20480, 'VND', '2015-05-24 17:05:20', 1),
(9, 'Gói băng thông 30GB', 1, 250000.00, 36120, 'VND', '2015-05-24 17:05:13', 1),
(10, 'Gói băng thông 40GB', 1, 300000.00, 40960, 'VND', '2015-05-24 17:05:41', 1),
(11, 'Gói băng thông Unlimite', 1, 500000.00, 0, 'vnd', '2015-05-24 17:05:12', 1);

-- --------------------------------------------------------

--
-- Table structure for table `app_product_categories`
--

CREATE TABLE IF NOT EXISTS `app_product_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `value` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `description` text CHARACTER SET utf8,
  `created` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `app_product_categories`
--

INSERT INTO `app_product_categories` (`id`, `name`, `value`, `description`, `created`, `created_by`) VALUES
(1, 'Gói băng thông 1', '1', 'Gói tính theo băng thông', '2015-05-24 14:05:14', 1);

-- --------------------------------------------------------

--
-- Table structure for table `app_users`
--

CREATE TABLE IF NOT EXISTS `app_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `password` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `fullname` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `email` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `phone` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `building` int(11) DEFAULT NULL,
  `room` int(11) DEFAULT NULL,
  `activate` tinyint(4) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `packet` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `app_users`
--

INSERT INTO `app_users` (`id`, `username`, `password`, `fullname`, `email`, `phone`, `building`, `room`, `activate`, `created`, `created_by`, `packet`) VALUES
(1, 'sysadmin', '380a9e7e1e616ab0d004c61ef2125612', 'Nguyen Minh Hieu', 'hieunguyenminh.93@gmail.com', '01642219419', NULL, NULL, 1, '2015-05-17 01:00:00', 1, 1),
(2, 'free_nomac', 'd26e0f6d93bf4f8fee8873e0e1a48345', 'Auto Register', 'contact@freewifi.vn', NULL, NULL, NULL, 1, '2015-05-29 23:05:29', 0, 1),
(3, 'hieu', '00a1f187721c63501356bf791e69382c', 'Nguy?n Minh Hi?u', 'hieunguyenminh.93@gmail.com', '01642219419', 1, 101, 0, '2015-05-29 00:00:00', NULL, 1),
(4, 'F0795949F555', '52bb93de7aa878fdbb90d4a42c0e7a1a', 'Auto Register', 'contact@freewifi.vn', NULL, NULL, NULL, 1, '2015-06-04 08:06:04', 0, 1),
(5, 'D0DF9A79C7BC', '7249770f5cde73629a9d9bccac182ecf', 'Auto Register', 'contact@freewifi.vn', NULL, NULL, NULL, 1, '2015-06-04 14:06:04', 0, 1),
(6, 'C0188513CCF0', '43a9c1c4185c3880652804b895b831a4', 'Auto Register', 'contact@freewifi.vn', NULL, NULL, NULL, 1, '2015-06-04 14:06:04', 0, 1),
(7, 'F0795949F555', '52bb93de7aa878fdbb90d4a42c0e7a1a', 'Auto Register', 'contact@freewifi.vn', NULL, NULL, NULL, 1, '2015-06-04 14:06:04', 0, 1),
(8, 'F0795949F555', '52bb93de7aa878fdbb90d4a42c0e7a1a', 'Auto Register', 'contact@freewifi.vn', NULL, NULL, NULL, 1, '2015-06-04 14:06:04', 0, 1),
(9, 'C0188513CCF0', '43a9c1c4185c3880652804b895b831a4', 'Auto Register', 'contact@freewifi.vn', NULL, NULL, NULL, 1, '2015-06-04 14:06:04', 0, 1),
(10, 'F0795949F555', '52bb93de7aa878fdbb90d4a42c0e7a1a', 'Auto Register', 'contact@freewifi.vn', NULL, NULL, NULL, 1, '2015-06-04 14:06:04', 0, 1),
(11, 'C0188513CCF0', '43a9c1c4185c3880652804b895b831a4', 'Auto Register', 'contact@freewifi.vn', NULL, NULL, NULL, 1, '2015-06-04 14:06:04', 0, 1),
(12, 'free_nomac', 'd26e0f6d93bf4f8fee8873e0e1a48345', 'Auto Register', 'contact@freewifi.vn', NULL, NULL, NULL, 1, '2015-06-04 14:06:04', 0, 1),
(13, 'F0795949F555', '52bb93de7aa878fdbb90d4a42c0e7a1a', 'Auto Register', 'contact@freewifi.vn', NULL, NULL, NULL, 1, '2015-06-04 14:06:04', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE IF NOT EXISTS `friends` (
  `user_id` int(11) NOT NULL,
  `friend_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`friend_id`),
  KEY `IDX_21EE7069A76ED395` (`user_id`),
  KEY `IDX_21EE70696A5458E8` (`friend_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nas`
--

CREATE TABLE IF NOT EXISTS `nas` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nasname` varchar(128) NOT NULL,
  `shortname` varchar(32) DEFAULT NULL,
  `type` varchar(30) DEFAULT 'other',
  `ports` int(5) DEFAULT NULL,
  `secret` varchar(60) NOT NULL DEFAULT 'secret',
  `server` varchar(64) DEFAULT NULL,
  `community` varchar(50) DEFAULT NULL,
  `description` varchar(200) DEFAULT 'RADIUS Client',
  PRIMARY KEY (`id`),
  KEY `nasname` (`nasname`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `nas`
--

INSERT INTO `nas` (`id`, `nasname`, `shortname`, `type`, `ports`, `secret`, `server`, `community`, `description`) VALUES
(1, '192.168.0.101', '192.168.0.101', 'other', 1813, 'hieu1234', NULL, NULL, 'RADIUS Client'),
(2, '192.168.0.100', '192.168.0.100', 'other', 1813, 'hieu1234', NULL, NULL, 'RADIUS Client'),
(3, '192.168.111.11', '192.168.111.11', 'other', 1813, 'hieu1234', NULL, NULL, 'RADIUS Client'),
(4, '192.168.111.15', '192.168.111.15', 'other', 1813, 'hieu1234', NULL, NULL, 'RADIUS Client');

-- --------------------------------------------------------

--
-- Table structure for table `radacct`
--

CREATE TABLE IF NOT EXISTS `radacct` (
  `radacctid` bigint(21) NOT NULL AUTO_INCREMENT,
  `acctsessionid` varchar(64) NOT NULL DEFAULT '',
  `acctuniqueid` varchar(32) NOT NULL DEFAULT '',
  `username` varchar(64) NOT NULL DEFAULT '',
  `groupname` varchar(64) NOT NULL DEFAULT '',
  `realm` varchar(64) DEFAULT '',
  `nasipaddress` varchar(15) NOT NULL DEFAULT '',
  `nasportid` varchar(50) DEFAULT NULL,
  `nasporttype` varchar(32) DEFAULT NULL,
  `acctstarttime` datetime DEFAULT NULL,
  `acctupdatetime` datetime DEFAULT NULL,
  `acctstoptime` datetime DEFAULT NULL,
  `acctinterval` int(12) DEFAULT NULL,
  `acctsessiontime` int(12) unsigned DEFAULT NULL,
  `acctauthentic` varchar(32) DEFAULT NULL,
  `connectinfo_start` varchar(50) DEFAULT NULL,
  `connectinfo_stop` varchar(50) DEFAULT NULL,
  `acctinputoctets` bigint(20) DEFAULT NULL,
  `acctoutputoctets` bigint(20) DEFAULT NULL,
  `calledstationid` varchar(50) NOT NULL DEFAULT '',
  `callingstationid` varchar(50) NOT NULL DEFAULT '',
  `acctterminatecause` varchar(32) NOT NULL DEFAULT '',
  `servicetype` varchar(32) DEFAULT NULL,
  `framedprotocol` varchar(32) DEFAULT NULL,
  `framedipaddress` varchar(15) NOT NULL DEFAULT '',
  PRIMARY KEY (`radacctid`),
  UNIQUE KEY `acctuniqueid` (`acctuniqueid`),
  KEY `username` (`username`),
  KEY `framedipaddress` (`framedipaddress`),
  KEY `acctsessionid` (`acctsessionid`),
  KEY `acctsessiontime` (`acctsessiontime`),
  KEY `acctstarttime` (`acctstarttime`),
  KEY `acctinterval` (`acctinterval`),
  KEY `acctstoptime` (`acctstoptime`),
  KEY `nasipaddress` (`nasipaddress`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `radacct`
--

INSERT INTO `radacct` (`radacctid`, `acctsessionid`, `acctuniqueid`, `username`, `groupname`, `realm`, `nasipaddress`, `nasportid`, `nasporttype`, `acctstarttime`, `acctupdatetime`, `acctstoptime`, `acctinterval`, `acctsessiontime`, `acctauthentic`, `connectinfo_start`, `connectinfo_stop`, `acctinputoctets`, `acctoutputoctets`, `calledstationid`, `callingstationid`, `acctterminatecause`, `servicetype`, `framedprotocol`, `framedipaddress`) VALUES
(8, '5570020a00000003', 'f3fc681f102a7336c709b1db7621a289', 'F0795949F555', '', '', '10.1.0.1', '3', 'Wireless-802.11', '2015-06-04 14:46:42', '2015-06-04 14:46:42', '2015-06-04 14:47:00', NULL, 18, '', '', '', 3974, 4291, '14-DA-E9-AC-49-F2', 'F0-79-59-49-F5-55', 'Session-Timeout', '', '', '10.1.0.2');

-- --------------------------------------------------------

--
-- Table structure for table `radcheck`
--

CREATE TABLE IF NOT EXISTS `radcheck` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(64) NOT NULL DEFAULT '',
  `attribute` varchar(64) NOT NULL DEFAULT '',
  `op` char(2) NOT NULL DEFAULT '==',
  `value` varchar(253) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `username` (`username`(32))
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `radcheck`
--

INSERT INTO `radcheck` (`id`, `username`, `attribute`, `op`, `value`) VALUES
(3, 'sysadmin1', 'Md5-Password', ':=', '81dc9bdb52d04dc20036dbd8313ed055'),
(26, 'F0795949F555', 'Md5-Password', ':=', '52bb93de7aa878fdbb90d4a42c0e7a1a'),
(27, 'F0795949F555', 'Expire-After', ':=', '16');

-- --------------------------------------------------------

--
-- Table structure for table `radgroupcheck`
--

CREATE TABLE IF NOT EXISTS `radgroupcheck` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `groupname` varchar(64) NOT NULL DEFAULT '',
  `attribute` varchar(64) NOT NULL DEFAULT '',
  `op` char(2) NOT NULL DEFAULT '==',
  `value` varchar(253) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `groupname` (`groupname`(32))
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `radgroupreply`
--

CREATE TABLE IF NOT EXISTS `radgroupreply` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `groupname` varchar(64) NOT NULL DEFAULT '',
  `attribute` varchar(64) NOT NULL DEFAULT '',
  `op` char(2) NOT NULL DEFAULT '=',
  `value` varchar(253) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `groupname` (`groupname`(32))
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `radpostauth`
--

CREATE TABLE IF NOT EXISTS `radpostauth` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(64) NOT NULL DEFAULT '',
  `pass` varchar(64) NOT NULL DEFAULT '',
  `reply` varchar(32) NOT NULL DEFAULT '',
  `authdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=173 ;

--
-- Dumping data for table `radpostauth`
--

INSERT INTO `radpostauth` (`id`, `username`, `pass`, `reply`, `authdate`) VALUES
(1, 'hieu', 'hieu1234', 'Access-Reject', '2015-04-07 11:11:37'),
(2, 'hieu', 'hieu1234', 'Access-Accept', '2015-04-07 11:12:53'),
(3, 'hieu', 'hieu1234', 'Access-Accept', '2015-04-07 13:06:40'),
(4, 'hieu', '0x008215ba056b2e787171008b3cbed2f6c3', 'Access-Reject', '2015-04-09 14:44:33'),
(5, 'hieu', '0x003ff8aa4855912bd440ca874023a123cc', 'Access-Reject', '2015-04-09 14:44:36'),
(6, 'hieu', '0x00fe8b3e3d33acb22fa5e63d3d45bc8ba3', 'Access-Reject', '2015-04-09 14:44:47'),
(7, 'hieu', '0x00c62cd14c0029c4e0170f4214d93d3a77', 'Access-Reject', '2015-04-09 14:45:00'),
(8, 'hieu', '0x00d68be423930f3c3b3fe4ea5b45a29023', 'Access-Reject', '2015-04-09 14:52:30'),
(9, 'hieu', '0x008994533ef3cf72f471d3e4f44715702d', 'Access-Reject', '2015-04-09 18:20:01'),
(10, '74-E5-43-61-BD-05', '74-E5-43-61-BD-05', 'Access-Reject', '2015-04-09 19:09:22'),
(11, '74-E5-43-61-BD-05', '74-E5-43-61-BD-05', 'Access-Reject', '2015-04-09 19:09:23'),
(12, '74-E5-43-61-BD-05', '74-E5-43-61-BD-05', 'Access-Reject', '2015-04-09 19:09:45'),
(13, '74-E5-43-61-BD-05', '74-E5-43-61-BD-05', 'Access-Reject', '2015-04-09 19:09:47'),
(14, '74-E5-43-61-BD-05', '74-E5-43-61-BD-05', 'Access-Reject', '2015-04-09 19:09:48'),
(15, '74-E5-43-61-BD-05', '74-E5-43-61-BD-05', 'Access-Reject', '2015-04-09 19:16:26'),
(16, '74-E5-43-61-BD-05', '74-E5-43-61-BD-05', 'Access-Reject', '2015-04-09 19:16:33'),
(17, '74-E5-43-61-BD-05', '74-E5-43-61-BD-05', 'Access-Reject', '2015-04-09 19:16:36'),
(18, '74-E5-43-61-BD-05', '74-E5-43-61-BD-05', 'Access-Reject', '2015-04-09 19:16:47'),
(19, '74-E5-43-61-BD-05', '74-E5-43-61-BD-05', 'Access-Reject', '2015-04-09 19:16:49'),
(20, '74-E5-43-61-BD-05', '74-E5-43-61-BD-05', 'Access-Reject', '2015-04-09 19:16:52'),
(21, '74-E5-43-61-BD-05', '74-E5-43-61-BD-05', 'Access-Reject', '2015-04-09 19:18:43'),
(22, '74-E5-43-61-BD-05', '74-E5-43-61-BD-05', 'Access-Reject', '2015-04-09 19:18:45'),
(23, '74-E5-43-61-BD-05', '74-E5-43-61-BD-05', 'Access-Reject', '2015-04-09 19:31:39'),
(24, '74-E5-43-61-BD-05', '74-E5-43-61-BD-05', 'Access-Reject', '2015-04-09 19:31:39'),
(25, '74-E5-43-61-BD-05', '74-E5-43-61-BD-05', 'Access-Reject', '2015-04-09 19:31:40'),
(26, '74-E5-43-61-BD-05', '74-E5-43-61-BD-05', 'Access-Reject', '2015-04-09 19:31:41'),
(27, '74-E5-43-61-BD-05', '74-E5-43-61-BD-05', 'Access-Reject', '2015-04-09 19:31:42'),
(28, '74-E5-43-61-BD-05', '74-E5-43-61-BD-05', 'Access-Reject', '2015-04-09 19:31:43'),
(29, '74-E5-43-61-BD-05', '74-E5-43-61-BD-05', 'Access-Reject', '2015-04-09 19:31:46'),
(30, '74-E5-43-61-BD-05', '74-E5-43-61-BD-05', 'Access-Reject', '2015-04-09 19:34:43'),
(31, '74-E5-43-61-BD-05', '74-E5-43-61-BD-05', 'Access-Reject', '2015-04-09 19:34:46'),
(32, '00-21-6A-59-D9-DA', '00-21-6A-59-D9-DA', 'Access-Reject', '2015-04-09 19:34:55'),
(33, '00-21-6A-59-D9-DA', '00-21-6A-59-D9-DA', 'Access-Reject', '2015-04-09 19:34:59'),
(34, '00-21-6A-59-D9-DA', '00-21-6A-59-D9-DA', 'Access-Reject', '2015-04-09 19:35:07'),
(35, '00-21-6A-59-D9-DA', '00-21-6A-59-D9-DA', 'Access-Reject', '2015-04-09 19:35:07'),
(36, '74-E5-43-61-BD-05', '74-E5-43-61-BD-05', 'Access-Reject', '2015-04-09 19:36:09'),
(37, '74-E5-43-61-BD-05', '74-E5-43-61-BD-05', 'Access-Reject', '2015-04-09 19:36:12'),
(38, '74-E5-43-61-BD-05', '74-E5-43-61-BD-05', 'Access-Reject', '2015-04-09 19:36:39'),
(39, '74-E5-43-61-BD-05', '74-E5-43-61-BD-05', 'Access-Reject', '2015-04-09 19:39:02'),
(40, '74-E5-43-61-BD-05', '74-E5-43-61-BD-05', 'Access-Reject', '2015-04-09 19:40:55'),
(41, '74-E5-43-61-BD-05', '74-E5-43-61-BD-05', 'Access-Reject', '2015-04-09 19:40:58'),
(42, '74-E5-43-61-BD-05', '74-E5-43-61-BD-05', 'Access-Reject', '2015-04-09 19:41:25'),
(43, '74-E5-43-61-BD-05', '74-E5-43-61-BD-05', 'Access-Reject', '2015-04-09 19:41:27'),
(44, '74-E5-43-61-BD-05', '74-E5-43-61-BD-05', 'Access-Reject', '2015-04-09 19:41:35'),
(45, '74-E5-43-61-BD-05', '74-E5-43-61-BD-05', 'Access-Reject', '2015-04-09 19:41:36'),
(46, '74-E5-43-61-BD-05', '74-E5-43-61-BD-05', 'Access-Reject', '2015-04-09 19:41:37'),
(47, '74-E5-43-61-BD-05', '74-E5-43-61-BD-05', 'Access-Reject', '2015-04-09 19:41:38'),
(48, '74-E5-43-61-BD-05', '74-E5-43-61-BD-05', 'Access-Reject', '2015-04-09 19:41:39'),
(49, '74-E5-43-61-BD-05', '74-E5-43-61-BD-05', 'Access-Reject', '2015-04-09 19:41:42'),
(50, '74-E5-43-61-BD-05', '74-E5-43-61-BD-05', 'Access-Reject', '2015-04-09 19:43:56'),
(51, '74-E5-43-61-BD-05', '74-E5-43-61-BD-05', 'Access-Reject', '2015-04-09 19:43:59'),
(52, '74-E5-43-61-BD-05', '74-E5-43-61-BD-05', 'Access-Reject', '2015-04-09 19:45:35'),
(53, '74-E5-43-61-BD-05', '74-E5-43-61-BD-05', 'Access-Reject', '2015-04-09 19:45:38'),
(54, '74-E5-43-61-BD-05', '74-E5-43-61-BD-05', 'Access-Reject', '2015-04-09 19:46:36'),
(55, '74-E5-43-61-BD-05', '74-E5-43-61-BD-05', 'Access-Reject', '2015-04-09 19:47:50'),
(56, '74-E5-43-61-BD-05', '74-E5-43-61-BD-05', 'Access-Reject', '2015-04-09 19:47:51'),
(57, '74-E5-43-61-BD-05', '74-E5-43-61-BD-05', 'Access-Reject', '2015-04-09 19:51:36'),
(58, '74-E5-43-61-BD-05', '74-E5-43-61-BD-05', 'Access-Reject', '2015-04-09 19:53:14'),
(59, '74-E5-43-61-BD-05', '74-E5-43-61-BD-05', 'Access-Reject', '2015-04-09 19:57:05'),
(60, '74-E5-43-61-BD-05', '74-E5-43-61-BD-05', 'Access-Reject', '2015-04-09 19:57:31'),
(61, '74-E5-43-61-BD-05', '74-E5-43-61-BD-05', 'Access-Reject', '2015-04-09 19:57:31'),
(62, '74-E5-43-61-BD-05', '74-E5-43-61-BD-05', 'Access-Reject', '2015-04-09 19:57:32'),
(63, '74-E5-43-61-BD-05', '74-E5-43-61-BD-05', 'Access-Reject', '2015-04-09 19:57:33'),
(64, '74-E5-43-61-BD-05', '74-E5-43-61-BD-05', 'Access-Reject', '2015-04-09 19:57:34'),
(65, '74-E5-43-61-BD-05', '74-E5-43-61-BD-05', 'Access-Reject', '2015-04-09 19:57:37'),
(66, '74-E5-43-61-BD-05', '74-E5-43-61-BD-05', 'Access-Reject', '2015-04-09 19:58:07'),
(67, '74-E5-43-61-BD-05', '74-E5-43-61-BD-05', 'Access-Reject', '2015-04-09 19:58:09'),
(68, '74-E5-43-61-BD-05', '74-E5-43-61-BD-05', 'Access-Reject', '2015-04-09 19:59:25'),
(69, '74-E5-43-61-BD-05', '74-E5-43-61-BD-05', 'Access-Reject', '2015-04-09 19:59:26'),
(70, '74-E5-43-61-BD-05', '74-E5-43-61-BD-05', 'Access-Reject', '2015-04-09 19:59:27'),
(71, '74-E5-43-61-BD-05', '74-E5-43-61-BD-05', 'Access-Reject', '2015-04-09 19:59:28'),
(72, '74-E5-43-61-BD-05', '74-E5-43-61-BD-05', 'Access-Reject', '2015-04-09 19:59:29'),
(73, 'hieu', '0x007f1cd8c7e444098a75e9b8dfe898c278', 'Access-Reject', '2015-04-09 20:18:13'),
(74, 'ghgh', '0x00a63805f19161490b01032078811772a6', 'Access-Reject', '2015-04-09 20:34:29'),
(75, 'hieu', '0x00a08392a8829ab3a8470b513abda5f5c8', 'Access-Reject', '2015-04-10 00:05:23'),
(76, 'hieu', '0x00bd95732a2133c5053d2a5befab7bef58', 'Access-Reject', '2015-04-10 00:13:21'),
(77, 'hieu', '0x000f633f0ab1161efa3ea759d22fa3da34', 'Access-Reject', '2015-04-10 00:13:56'),
(78, 'hieu', 'hieu1234', 'Access-Accept', '2015-04-10 00:35:04'),
(79, 'hieu', 'hieu1234', 'Access-Accept', '2015-04-10 13:34:04'),
(80, 'fgfg', '', 'Access-Reject', '2015-04-10 14:23:02'),
(81, 'hieu', 'hieu1234', 'Access-Accept', '2015-04-11 13:47:45'),
(82, 'hieu', 'hieu1234', 'Access-Accept', '2015-04-11 13:53:55'),
(83, 'hieu', 'hieu1234', 'Access-Accept', '2015-04-11 14:29:57'),
(84, 'hieu', 'hieu1234', 'Access-Accept', '2015-04-12 13:56:32'),
(85, 'hieu', '0x004917b48f4484a0b0b24d0fcdc7fb614e', 'Access-Reject', '2015-04-18 15:48:25'),
(86, 'hieu', '0x004917b48f4484a0b0b24d0fcdc7fb614e', 'Access-Reject', '2015-04-18 15:50:04'),
(87, 'hieu', '0x001c3eace813c9c95b44502ae76df89593', 'Access-Reject', '2015-04-18 15:50:23'),
(88, 'hieu', '0x005764a94aeef8f90bde7a6d4f94077ea9', 'Access-Reject', '2015-04-18 15:50:41'),
(89, 'hieu', '0x00d09c4f39d50d9d7759637973e69e29db', 'Access-Reject', '2015-04-18 15:51:31'),
(90, 'hieu', '0x0063c279fb5f62944a656bf3e5812eaf7e', 'Access-Reject', '2015-04-18 16:09:28'),
(91, 'hieu', '0x00f6c90cc1c06b8d2776de95bccd82a4ed', 'Access-Reject', '2015-04-18 16:12:10'),
(92, 'hieu', '0x00b8b13bd9955fcce75b869ced7fd094f3', 'Access-Reject', '2015-04-18 16:19:36'),
(93, 'hieu', 'hieu1234', 'Access-Accept', '2015-04-18 16:23:47'),
(94, 'hieu', 'hieu1234', 'Access-Accept', '2015-04-18 16:34:25'),
(95, 'hieu', 'hieu1234', 'Access-Accept', '2015-04-18 16:35:23'),
(96, 'admin', '1234', 'Access-Accept', '2015-04-18 16:37:18'),
(97, 'hieu', 'hieu1234', 'Access-Reject', '2015-04-18 16:40:34'),
(98, 'hieu', 'hieu1234', 'Access-Reject', '2015-04-23 17:07:08'),
(99, 'hieu', 'hieu1234', 'Access-Accept', '2015-04-23 17:13:43'),
(100, 'hieu', 'hieu1234', 'Access-Accept', '2015-04-23 17:25:40'),
(101, 'hieu', 'hieu1234', 'Access-Accept', '2015-05-13 11:27:28'),
(102, 'hieu', 'hieu1234', 'Access-Accept', '2015-05-16 06:00:26'),
(103, 'hoang', 'hoang3010', 'Access-Accept', '2015-05-16 06:06:59'),
(104, 'hieu', '', 'Access-Reject', '2015-05-18 10:28:17'),
(105, 'hieu', 'hieu1234', 'Access-Reject', '2015-05-18 10:28:32'),
(106, 'hieu', 'hieu1234', 'Access-Reject', '2015-05-18 10:43:12'),
(107, 'hieu', 'hieu1234', 'Access-Reject', '2015-05-18 10:51:04'),
(108, 'hieu', 'hieu1234', 'Access-Reject', '2015-05-18 11:03:16'),
(109, 'hieu', 'hieu1234', 'Access-Reject', '2015-05-18 11:05:22'),
(110, 'hieu', 'hieu1234', 'Access-Reject', '2015-05-18 11:13:20'),
(111, 'hieu', 'hieu1234', 'Access-Reject', '2015-05-18 11:13:26'),
(112, 'hieu', 'hieu1234', 'Access-Reject', '2015-05-18 11:13:30'),
(113, 'sysadmin', '1234', 'Access-Reject', '2015-05-18 11:48:08'),
(114, 'sysadmin', 'hieu1234', 'Access-Accept', '2015-05-18 11:49:01'),
(115, 'free_MYBTB', 'free_MYBTB', 'Access-Reject', '2015-05-20 15:30:23'),
(116, 'free_iKcix', 'free_Z7Fgqb', 'Access-Accept', '2015-05-20 15:30:52'),
(117, 'free_SK6wx', 'free_LSP00w', 'Access-Accept', '2015-05-20 15:41:07'),
(118, 'free_myfHn', 'free_myfHn', 'Access-Accept', '2015-05-20 15:51:14'),
(119, 'free_mDzOI', 'free_mDzOI', 'Access-Accept', '2015-05-20 15:52:08'),
(120, 'free_Cz5G4', 'free_Cz5G4', 'Access-Accept', '2015-05-20 17:27:06'),
(121, 'free_ssUfZ', 'free_ssUfZ', 'Access-Accept', '2015-05-20 19:01:34'),
(122, 'free_So5Wc', 'free_So5Wc', 'Access-Accept', '2015-05-20 19:05:48'),
(123, 'free_So5Wc', 'free_So5Wc', 'Access-Accept', '2015-05-20 19:07:18'),
(124, 'free_So5Wc', 'free_So5Wc', 'Access-Accept', '2015-05-20 19:08:09'),
(125, 'free_So5Wc', 'free_So5Wc', 'Access-Accept', '2015-05-20 19:08:54'),
(126, 'free_ZDQfb', 'free_ZDQfb', 'Access-Accept', '2015-05-21 11:25:42'),
(127, 'free_KMeem', 'free_KMeem', 'Access-Accept', '2015-05-21 11:28:01'),
(128, 'sysadmin', 'hieu1234', 'Access-Accept', '2015-05-21 12:59:51'),
(129, 'free_EYiyp', 'free_EYiyp', 'Access-Accept', '2015-05-21 13:02:23'),
(130, 'free_zFqWl', 'free_zFqWl', 'Access-Accept', '2015-05-21 13:03:38'),
(131, '34567890-ghjkl=3B=27fvgbhnjmk=2Cl./=3B=27gtyhujikol.=3B/=27', '', 'Access-Reject', '2015-05-21 13:06:06'),
(132, 'sysadmin', 'hieu1234', 'Access-Accept', '2015-05-21 13:06:18'),
(133, 'F0795949F555', 'F0795949F555', 'Access-Accept', '2015-05-21 18:26:51'),
(134, 'F0795949F555', 'F0795949F555', 'Access-Accept', '2015-05-21 18:32:31'),
(135, 'sysadmin', 'hieu1234', 'Access-Accept', '2015-05-23 01:17:53'),
(136, 'sysadmin', 'hieu1234', 'Access-Accept', '2015-05-23 01:18:22'),
(137, 'sysadmin', 'hieu1234', 'Access-Reject', '2015-05-23 01:22:11'),
(138, 'sysadmin', 'hieu1234', 'Access-Reject', '2015-05-23 02:16:11'),
(139, 'sysadmin', 'hieu1234', 'Access-Reject', '2015-05-23 02:23:21'),
(140, 'F0795949F555', 'F0795949F555', 'Access-Accept', '2015-05-23 07:40:19'),
(141, 'sysadmin', 'hieu1234', 'Access-Reject', '2015-05-23 07:45:24'),
(142, 'free_nomac', 'free_nomac', 'Access-Accept', '2015-05-23 07:47:54'),
(143, 'free_nomac', 'free_nomac', 'Access-Reject', '2015-05-23 07:49:18'),
(144, 'F0795949F555', 'F0795949F555', 'Access-Reject', '2015-05-23 08:45:10'),
(145, 'F0795949F555', 'F0795949F555', 'Access-Accept', '2015-05-23 08:49:07'),
(146, 'F0795949F555', 'F0795949F555', 'Access-Reject', '2015-05-23 08:49:46'),
(147, 'free_nomac', 'free_nomac', 'Access-Reject', '2015-05-23 08:53:52'),
(148, 'F0795949F555', 'F0795949F555', 'Access-Reject', '2015-05-23 09:16:44'),
(149, 'sysadmin', 'hieu1234', 'Access-Reject', '2015-05-23 09:23:19'),
(150, 'sysadmin', 'hieu1234', 'Access-Reject', '2015-05-23 09:23:31'),
(151, 'D0DF9A79C7BC', 'D0DF9A79C7BC', 'Access-Accept', '2015-05-23 09:27:38'),
(152, 'D0DF9A79C7BC', 'D0DF9A79C7BC', 'Access-Reject', '2015-05-23 09:31:41'),
(153, 'F0795949F555', 'F0795949F555', 'Access-Reject', '2015-05-23 14:50:45'),
(154, 'sysadmin', 'hieu1234', 'Access-Reject', '2015-05-23 18:01:37'),
(155, 'sysadmin', 'hieu1234', 'Access-Reject', '2015-05-23 18:13:23'),
(156, 'F0795949F555', 'F0795949F555', 'Access-Accept', '2015-05-23 18:15:05'),
(157, 'F0795949F555', 'F0795949F555', 'Access-Reject', '2015-05-23 18:30:40'),
(158, 'F0795949F555', 'F0795949F555', 'Access-Reject', '2015-05-23 18:31:35'),
(159, 'F0795949F555', 'F0795949F555', 'Access-Accept', '2015-05-23 18:32:41'),
(160, 'F0795949F555', 'F0795949F555', 'Access-Reject', '2015-05-23 18:35:34'),
(161, 'F0795949F555', 'F0795949F555', 'Access-Reject', '2015-05-23 18:35:39'),
(162, 'F0795949F555', 'F0795949F555', 'Access-Reject', '2015-06-04 01:46:48'),
(163, 'F0795949F555', 'F0795949F555', 'Access-Reject', '2015-06-04 07:26:01'),
(164, 'D0DF9A79C7BC', 'D0DF9A79C7BC', 'Access-Accept', '2015-06-04 07:30:13'),
(165, 'C0188513CCF0', 'C0188513CCF0', 'Access-Accept', '2015-06-04 07:31:54'),
(166, 'F0795949F555', 'F0795949F555', 'Access-Reject', '2015-06-04 07:36:00'),
(167, 'F0795949F555', 'F0795949F555', 'Access-Reject', '2015-06-04 07:36:34'),
(168, 'F0795949F555', 'F0795949F555', 'Access-Accept', '2015-06-04 07:39:46'),
(169, 'C0188513CCF0', 'C0188513CCF0', 'Access-Accept', '2015-06-04 07:39:50'),
(170, 'F0795949F555', 'F0795949F555', 'Access-Accept', '2015-06-04 07:44:56'),
(171, 'C0188513CCF0', 'C0188513CCF0', 'Access-Accept', '2015-06-04 07:45:17'),
(172, 'F0795949F555', 'F0795949F555', 'Access-Accept', '2015-06-04 07:46:42');

-- --------------------------------------------------------

--
-- Table structure for table `radreply`
--

CREATE TABLE IF NOT EXISTS `radreply` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(64) NOT NULL DEFAULT '',
  `attribute` varchar(64) NOT NULL DEFAULT '',
  `op` char(2) NOT NULL DEFAULT '=',
  `value` varchar(253) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `username` (`username`(32))
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `radusergroup`
--

CREATE TABLE IF NOT EXISTS `radusergroup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(64) NOT NULL DEFAULT '',
  `groupname` varchar(64) NOT NULL DEFAULT '',
  `priority` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `username` (`username`(32))
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `radusergroup`
--

INSERT INTO `radusergroup` (`id`, `username`, `groupname`, `priority`) VALUES
(1, 'hieu', 'administrator', 1);

-- --------------------------------------------------------

--
-- Table structure for table `roles_parents`
--

CREATE TABLE IF NOT EXISTS `roles_parents` (
  `role_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  PRIMARY KEY (`role_id`,`parent_id`),
  KEY `IDX_C70E6B91D60322AC` (`role_id`),
  KEY `IDX_C70E6B91727ACA70` (`parent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles_parents`
--

INSERT INTO `roles_parents` (`role_id`, `parent_id`) VALUES
(2, 1),
(3, 2);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `app_acl_user`
--
ALTER TABLE `app_acl_user`
  ADD CONSTRAINT `FK_A21FD7F71E27F6BF` FOREIGN KEY (`question_id`) REFERENCES `app_acl_question` (`id`),
  ADD CONSTRAINT `FK_A21FD7F75D83CC1` FOREIGN KEY (`state_id`) REFERENCES `app_acl_state` (`id`),
  ADD CONSTRAINT `FK_A21FD7F782F1BAF4` FOREIGN KEY (`language_id`) REFERENCES `app_acl_language` (`id`),
  ADD CONSTRAINT `FK_A21FD7F7D60322AC` FOREIGN KEY (`role_id`) REFERENCES `app_acl_role` (`id`);

--
-- Constraints for table `friends`
--
ALTER TABLE `friends`
  ADD CONSTRAINT `FK_21EE70696A5458E8` FOREIGN KEY (`friend_id`) REFERENCES `app_acl_user` (`id`),
  ADD CONSTRAINT `FK_21EE7069A76ED395` FOREIGN KEY (`user_id`) REFERENCES `app_acl_user` (`id`);

--
-- Constraints for table `roles_parents`
--
ALTER TABLE `roles_parents`
  ADD CONSTRAINT `FK_C70E6B91727ACA70` FOREIGN KEY (`parent_id`) REFERENCES `app_acl_role` (`id`),
  ADD CONSTRAINT `FK_C70E6B91D60322AC` FOREIGN KEY (`role_id`) REFERENCES `app_acl_role` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
