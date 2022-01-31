-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 07, 2017 at 01:47 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `vasthramalika`
--

-- --------------------------------------------------------

--
-- Table structure for table `vm_billentry`
--

CREATE TABLE IF NOT EXISTS `vm_billentry` (
  `be_billid` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(100) NOT NULL,
  `be_billnumber` int(11) DEFAULT NULL,
  `be_customername` varchar(600) DEFAULT NULL,
  `be_customermobile` varchar(20) DEFAULT NULL,
  `be_billdate` datetime DEFAULT NULL,
  `be_total` float DEFAULT NULL,
  `be_paidamount` float DEFAULT NULL,
  `be_paymethod` varchar(250) DEFAULT NULL,
  `be_note` longtext,
  `be_updateddate` datetime DEFAULT NULL,
  `be_updatedby` varchar(250) DEFAULT NULL,
  `be_isactive` int(11) DEFAULT '0',
  `be_discount` float DEFAULT NULL,
  `be_mode` varchar(100) NOT NULL,
  `be_paydate` datetime NOT NULL,
  PRIMARY KEY (`be_billid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `vm_billentry`
--

INSERT INTO `vm_billentry` (`be_billid`, `user_id`, `be_billnumber`, `be_customername`, `be_customermobile`, `be_billdate`, `be_total`, `be_paidamount`, `be_paymethod`, `be_note`, `be_updateddate`, `be_updatedby`, `be_isactive`, `be_discount`, `be_mode`, `be_paydate`) VALUES
(1, '', 1, 'Dipeesh', '9961556418', '2017-01-10 20:16:00', 2300, 2200, NULL, NULL, '2017-01-10 20:17:24', NULL, 0, NULL, '', '0000-00-00 00:00:00'),
(2, '', 2, '', '', '2017-01-10 20:24:00', 3350, 3300, NULL, NULL, '2017-01-10 20:24:54', NULL, 0, NULL, '', '0000-00-00 00:00:00'),
(3, '', 3, '', '', '2017-01-11 19:11:00', 550, 550, NULL, NULL, '2017-01-11 19:11:48', NULL, 0, NULL, '', '0000-00-00 00:00:00'),
(4, '', 4, '', '', '2017-01-11 19:12:00', 600, 600, NULL, NULL, '2017-01-11 19:12:20', NULL, 0, NULL, '', '0000-00-00 00:00:00'),
(5, '', 5, '', '', '2017-01-12 07:58:00', 1799.72, 1749.72, NULL, NULL, '2017-01-12 08:03:37', NULL, 0, 50, '', '0000-00-00 00:00:00'),
(6, '', 6, '', '', '2017-01-12 08:08:00', 576.19, 576.19, NULL, NULL, '2017-01-12 08:08:58', NULL, 0, 0, '', '0000-00-00 00:00:00'),
(7, '', 7, 'geert', '52752', '2017-01-12 09:00:00', 1204.76, 1104.76, NULL, NULL, '2017-01-12 09:07:11', NULL, 0, 100, '', '0000-00-00 00:00:00'),
(8, '', 8, '', '', '2017-01-13 09:53:00', 0, 0, NULL, NULL, '2017-01-13 10:01:42', NULL, 0, 0, '', '0000-00-00 00:00:00'),
(9, '', 9, '', '', '2017-01-13 10:27:00', 576.19, 576.19, NULL, NULL, '2017-01-13 10:28:13', NULL, 0, 0, '', '0000-00-00 00:00:00'),
(10, '', 10, '', '', '2017-01-17 13:32:00', 10050, 9550, NULL, NULL, '2017-01-17 13:34:27', NULL, 0, 500, '', '0000-00-00 00:00:00'),
(11, '', 11, '', '', '2017-02-04 07:34:00', 550, 500, NULL, NULL, '2017-02-04 07:35:25', NULL, 0, 50, '', '0000-00-00 00:00:00'),
(12, 'admin', 12, '', '', '2017-02-07 12:34:00', 550, 550, NULL, NULL, '2017-02-07 12:34:09', NULL, 0, 0, 'sales', '0000-00-00 00:00:00'),
(13, '1', 13, '', '', '2017-02-07 13:35:00', 1500, 1500, NULL, NULL, '2017-02-07 13:35:30', NULL, 0, 0, 'sales', '0000-00-00 00:00:00'),
(14, '1', 14, '', '', '2017-02-07 13:36:00', 1500, 1500, NULL, NULL, '2017-02-07 13:36:38', NULL, 0, 0, 'sales', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `vm_billitems`
--

CREATE TABLE IF NOT EXISTS `vm_billitems` (
  `bi_billitemid` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(100) NOT NULL,
  `bi_billid` int(11) DEFAULT NULL,
  `bi_productid` int(11) DEFAULT NULL,
  `bi_price` float DEFAULT NULL,
  `bi_quantity` int(11) DEFAULT NULL,
  `bi_total` float DEFAULT NULL,
  `bi_updatedon` datetime DEFAULT NULL,
  `bi_isactive` int(11) DEFAULT '0',
  `bi_vatamount` float DEFAULT NULL,
  `bi_vatper` float DEFAULT NULL,
  PRIMARY KEY (`bi_billitemid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `vm_billitems`
--

INSERT INTO `vm_billitems` (`bi_billitemid`, `user_id`, `bi_billid`, `bi_productid`, `bi_price`, `bi_quantity`, `bi_total`, `bi_updatedon`, `bi_isactive`, `bi_vatamount`, `bi_vatper`) VALUES
(1, '0', 1, 1, 550, 2, 1100, '2017-01-10 20:17:24', 0, NULL, NULL),
(2, '0', 1, 2, 600, 2, 1200, '2017-01-10 20:17:24', 0, NULL, NULL),
(3, '0', 2, 1, 550, 5, 2750, '2017-01-10 20:24:54', 0, NULL, NULL),
(4, '0', 2, 2, 600, 1, 600, '2017-01-10 20:24:54', 0, NULL, NULL),
(5, '0', 3, 1, 550, 1, 550, '2017-01-11 19:11:48', 0, NULL, NULL),
(6, '0', 4, 2, 600, 1, 600, '2017-01-11 19:12:20', 0, NULL, NULL),
(7, '0', 5, 2, 600, 2, 1223.53, '2017-01-12 08:03:37', 0, 23.53, 2),
(8, '0', 5, 1, 550, 1, 576.19, '2017-01-12 08:03:37', 0, 26.19, 5),
(9, '0', 6, 1, 550, 1, 576.19, '2017-01-12 08:08:58', 0, 26.19, 5),
(10, '0', 7, 1, 550, 1, 576.19, '2017-01-12 09:07:11', 0, 26.19, 5),
(11, '0', 7, 2, 600, 1, 628.57, '2017-01-12 09:07:11', 0, 28.57, 5),
(12, '0', 8, 1, 550, 1, 550, '2017-01-13 10:01:42', 0, 0, 0),
(13, '0', 9, 1, 550, 1, 576.19, '2017-01-13 10:28:13', 0, 26.19, 5),
(14, '0', 10, 1, 550, 3, 1650, '2017-01-17 13:34:27', 0, 0, 0),
(15, '0', 10, 2, 600, 2, 1200, '2017-01-17 13:34:27', 0, 0, 0),
(16, '0', 10, 3, 800, 9, 7200, '2017-01-17 13:34:27', 0, 0, 0),
(17, '0', 11, 1, 523.81, 1, 550, '2017-02-04 07:35:25', 0, 26.19, 5),
(18, '', 12, 1, 523.81, 1, 550, '2017-02-07 12:34:09', 0, 26.19, 5),
(19, '', 13, 5, 1428.57, 1, 1500, '2017-02-07 13:35:30', 0, 71.43, 5),
(20, '', 14, 5, 1428.57, 1, 1500, '2017-02-07 13:36:38', 0, 71.43, 5);

-- --------------------------------------------------------

--
-- Table structure for table `vm_products`
--

CREATE TABLE IF NOT EXISTS `vm_products` (
  `pr_productid` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(100) NOT NULL,
  `pr_productcode` varchar(100) DEFAULT NULL,
  `pr_productname` varchar(1000) DEFAULT NULL,
  `pr_purchaseprice` float DEFAULT NULL,
  `pr_saleprice` float DEFAULT NULL,
  `pr_description` longtext,
  `pr_stock` float DEFAULT NULL,
  `pr_isactive` int(11) DEFAULT '0',
  `pr_updateddate` datetime DEFAULT NULL,
  `pr_type` int(11) DEFAULT NULL,
  PRIMARY KEY (`pr_productid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `vm_products`
--

INSERT INTO `vm_products` (`pr_productid`, `user_id`, `pr_productcode`, `pr_productname`, `pr_purchaseprice`, `pr_saleprice`, `pr_description`, `pr_stock`, `pr_isactive`, `pr_updateddate`, `pr_type`) VALUES
(1, '', '001', 'Cotton Saree', 500, 550, NULL, 128, 0, '2017-01-11 10:44:17', 1),
(2, '', '002', 'Set Saree', 450, 600, NULL, 2, 0, '2017-01-11 10:44:17', 2),
(3, '', '003', 'Mens Jeans', 700, 800, NULL, 31, 0, '2017-01-12 02:10:26', 1),
(4, '', '004', 'Frok', 600, 800, NULL, 24, 0, '2017-01-17 06:37:35', 1),
(5, '1', '015', 'das', 100, 1500, NULL, 4, 0, '2017-02-07 18:05:02', 1);

-- --------------------------------------------------------

--
-- Table structure for table `vm_shopprofile`
--

CREATE TABLE IF NOT EXISTS `vm_shopprofile` (
  `sp_shopid` int(11) NOT NULL AUTO_INCREMENT,
  `sp_shopname` varchar(600) DEFAULT NULL,
  `sp_shopaddress` varchar(1000) DEFAULT NULL,
  `sp_phone` varchar(20) DEFAULT NULL,
  `sp_mobile` varchar(20) DEFAULT NULL,
  `sp_email` varchar(350) DEFAULT NULL,
  `sp_logo` varchar(1000) DEFAULT NULL,
  `sp_username` varchar(50) DEFAULT NULL,
  `sp_password` varchar(50) DEFAULT NULL,
  `sp_isactive` int(11) DEFAULT '0',
  `sp_vatreadymades` float DEFAULT NULL,
  `sp_vatmillgoods` float DEFAULT NULL,
  PRIMARY KEY (`sp_shopid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `vm_shopprofile`
--

INSERT INTO `vm_shopprofile` (`sp_shopid`, `sp_shopname`, `sp_shopaddress`, `sp_phone`, `sp_mobile`, `sp_email`, `sp_logo`, `sp_username`, `sp_password`, `sp_isactive`, `sp_vatreadymades`, `sp_vatmillgoods`) VALUES
(1, 'das', 'Mannarkad, Palakkad', '04923216138', '9961556418', 'info@utparasolutions.com', NULL, 'admin', 'admin123', 0, 5, 5);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
