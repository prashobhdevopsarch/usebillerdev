-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 05, 2019 at 06:56 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 5.6.39

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `victory`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrator_account_name`
--

CREATE TABLE `administrator_account_name` (
  `refid` int(11) NOT NULL,
  `acc_name` varchar(30) DEFAULT '',
  `acc_head` enum('bs','tr','pl') DEFAULT 'bs',
  `group_head` enum('asset','liability','debit','credit') DEFAULT 'asset',
  `other_details` text,
  `act_group_head` varchar(50) DEFAULT NULL,
  `opening_balance` bigint(15) DEFAULT '0',
  `opening_balance_type` enum('debit','credit') DEFAULT NULL,
  `closing_balance` bigint(15) DEFAULT '0',
  `closing_balance_type` enum('debit','credit') DEFAULT NULL,
  `status` char(1) DEFAULT NULL,
  `backup` char(1) DEFAULT NULL,
  `acc_updatedtime` date DEFAULT NULL,
  `acnt_branch` varchar(100) DEFAULT NULL,
  `finyear` int(100) DEFAULT NULL,
  `isactive` int(11) DEFAULT '0',
  `note` varchar(200) DEFAULT NULL,
  `bill_id` varchar(100) DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `administrator_account_name`
--

INSERT INTO `administrator_account_name` (`refid`, `acc_name`, `acc_head`, `group_head`, `other_details`, `act_group_head`, `opening_balance`, `opening_balance_type`, `closing_balance`, `closing_balance_type`, `status`, `backup`, `acc_updatedtime`, `acnt_branch`, `finyear`, `isactive`, `note`, `bill_id`, `user_id`) VALUES
(1, 'CASH', 'bs', 'asset', '', '7', 1537717, 'debit', 0, NULL, NULL, NULL, NULL, NULL, 4, 0, '', '', 1),
(2, 'CUSTOMER', 'bs', 'liability', '', '1', 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, 4, 0, '', '', 1),
(4, 'SALES RETURN', 'tr', 'debit', '', '9', 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, 4, 0, '', '', 1),
(5, 'SALES', 'tr', 'credit', '', '9', 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, 4, 0, '', '', 1),
(6, 'PURCHASE', 'tr', 'debit', '', '10', 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, 4, 0, '', '', 1),
(13, 'BANK', 'bs', 'asset', '', '8', 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, 4, 0, '', '', 1),
(33, 'INPUT TAX', 'bs', 'asset', NULL, '11', 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, 4, 0, '', '', 1),
(34, 'OUTPUT TAX', 'bs', 'asset', NULL, '11', 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, 4, 0, '', '', 1),
(42, 'SALARY', 'bs', 'asset', NULL, '13', 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, 4, 0, '', NULL, 1),
(36, 'COOLIE', 'bs', 'asset', NULL, '12', 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, 4, 0, '', NULL, 1),
(37, 'DISCOUNT', 'bs', 'asset', NULL, '12', 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, 4, 0, '', NULL, 1),
(38, 'CASH SALE', 'bs', 'asset', NULL, '9', 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, 4, 0, '', NULL, 1),
(39, 'CREDIT SALE', 'bs', 'asset', NULL, '9', 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, 4, 0, '', NULL, 1),
(41, 'TAXABLE ', 'bs', 'asset', NULL, '11', 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, 4, 0, '', NULL, 1),
(43, 'CAPITAL', 'bs', 'asset', NULL, '3', 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, 4, 0, '', NULL, 1),
(46, 'PURCHASE RETURN', 'bs', 'asset', NULL, '10', 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, 4, 0, '', NULL, 1),
(75, 'HAVELLS HAVELLS', 'bs', 'liability', 'HAVELLS HAVELLS', '1', 0, 'debit', 0, NULL, NULL, NULL, '2018-12-24', '1', 4, 0, NULL, NULL, 1),
(76, 'JIDHUN', 'bs', 'asset', 'JIDHUN', '2', 0, 'debit', 0, NULL, NULL, NULL, '2018-12-24', '1', 4, 0, NULL, NULL, 1),
(77, 'STAR PLASTICS STAR PLASTICS', 'bs', 'liability', 'STAR PLASTICS STAR PLASTICS', '1', 0, 'debit', 0, NULL, NULL, NULL, '2018-12-24', '1', 4, 0, NULL, NULL, 1),
(78, 'SUBASH', 'bs', 'asset', 'SUBASH', '2', 0, 'debit', 0, NULL, NULL, NULL, '2018-12-24', '1', 4, 0, NULL, NULL, 1),
(79, 'SHARON PLAST SHARON PLAST', 'bs', 'liability', 'SHARON PLAST SHARON PLAST', '1', 0, 'debit', 0, NULL, NULL, NULL, '2018-12-26', '1', 4, 0, NULL, NULL, 1),
(80, 'SHARON EXTRUSIONS SHARON EXTRU', 'bs', 'liability', 'SHARON EXTRUSIONS SHARON EXTRUSIONS', '1', 0, 'debit', 0, NULL, NULL, NULL, '2018-12-26', '1', 4, 0, NULL, NULL, 1),
(81, 'SANKAR PLASTIC MOULDINGS SANKA', 'bs', 'liability', 'SANKAR PLASTIC MOULDINGS SANKAR PLASTIC MOULDINGS', '1', 0, 'debit', 0, NULL, NULL, NULL, '2018-12-26', '1', 4, 0, NULL, NULL, 1),
(82, 'JEEVA GRANITES JEEVA GRANITES', 'bs', 'liability', 'JEEVA GRANITES JEEVA GRANITES', '1', 0, 'debit', 0, NULL, NULL, NULL, '2018-12-31', '1', 4, 0, NULL, NULL, 1),
(83, 'KMT TILES AND SANITARYWARES KM', 'bs', 'liability', 'KMT TILES AND SANITARYWARES KMT TILES AND SANITARYWARES', '1', 0, 'debit', 0, NULL, NULL, NULL, '2018-12-31', '1', 4, 0, NULL, NULL, 1),
(84, 'VALLUVANAD TILES KMT', 'bs', 'liability', 'VALLUVANAD TILES KMT', '1', 0, 'debit', 0, NULL, NULL, NULL, '2018-12-31', '1', 4, 0, NULL, NULL, 1),
(85, 'WATERTEC INDIA PVT LTD WATERTE', 'bs', 'liability', 'WATERTEC INDIA PVT LTD WATERTEC INDIA PVT LTD', '1', 0, 'debit', 0, NULL, NULL, NULL, '2018-12-31', '1', 4, 0, NULL, NULL, 1),
(86, 'SPINNER MARKETING SPINNER MARK', 'bs', 'liability', 'SPINNER MARKETING SPINNER MARKETING', '1', 0, 'debit', 0, NULL, NULL, NULL, '2018-12-31', '1', 4, 0, NULL, NULL, 1),
(87, 'TUBES AND TUBINGS CONSEAL', 'bs', 'liability', 'TUBES AND TUBINGS CONSEAL', '1', 0, 'debit', 0, NULL, NULL, NULL, '2018-12-31', '1', 4, 0, NULL, NULL, 1),
(88, 'J & J ENTERPRISES J & J ENTERP', 'bs', 'liability', 'J & J ENTERPRISES J & J ENTERPRISES', '1', 0, 'debit', 0, NULL, NULL, NULL, '2018-12-31', '1', 4, 0, NULL, NULL, 1),
(89, 'POWER SOLUTIONS POWER SOLUTION', 'bs', 'liability', 'POWER SOLUTIONS POWER SOLUTIONS', '1', 0, 'debit', 0, NULL, NULL, NULL, '2019-01-01', '1', 4, 0, NULL, NULL, 1),
(90, 'VERTEX MARKETING VERTEX MARKET', 'bs', 'liability', 'VERTEX MARKETING VERTEX MARKETING', '1', 0, 'debit', 0, NULL, NULL, NULL, '2019-01-01', '1', 4, 0, NULL, NULL, 1),
(91, 'GM IMPEX GM IMPEX', 'bs', 'liability', 'GM IMPEX GM IMPEX', '1', 0, 'debit', 0, NULL, NULL, NULL, '2019-01-02', '1', 4, 0, NULL, NULL, 1),
(92, 'SUBASH', 'bs', 'asset', 'SUBASH', '2', 0, 'debit', 0, NULL, NULL, NULL, '2019-01-03', '1', 4, 0, NULL, NULL, 1),
(93, 'PRIYA AGENCIES PRIYA AGENCIES', 'bs', 'liability', 'PRIYA AGENCIES PRIYA AGENCIES', '1', 0, 'debit', 0, NULL, NULL, NULL, '2019-01-05', '1', 4, 0, NULL, NULL, 1),
(94, 'SIGNET ASSOCIATES SIGNET ASSOC', 'bs', 'liability', 'SIGNET ASSOCIATES SIGNET ASSOCIATES', '1', 0, 'debit', 0, NULL, NULL, NULL, '2019-01-05', '1', 4, 0, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `administrator_daybook`
--

CREATE TABLE `administrator_daybook` (
  `refid` int(10) NOT NULL,
  `ad_branchid` varchar(100) DEFAULT NULL,
  `dayBookDate` date DEFAULT '0000-00-00',
  `debit` varchar(50) DEFAULT '',
  `credit` varchar(50) DEFAULT '',
  `dayBookContra` enum('Y','N') DEFAULT 'Y',
  `dayBookAmount` double DEFAULT '0',
  `description` text,
  `status` char(1) DEFAULT '',
  `backup` char(1) DEFAULT '',
  `billid` varchar(100) DEFAULT NULL,
  `finyear` varchar(100) DEFAULT NULL,
  `bill_id` varchar(100) DEFAULT NULL,
  `mode` int(100) DEFAULT '0',
  `dr_cr` varchar(100) DEFAULT '0',
  `bill_amnt` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `administrator_daybook`
--

INSERT INTO `administrator_daybook` (`refid`, `ad_branchid`, `dayBookDate`, `debit`, `credit`, `dayBookContra`, `dayBookAmount`, `description`, `status`, `backup`, `billid`, `finyear`, `bill_id`, `mode`, `dr_cr`, `bill_amnt`, `user_id`) VALUES
(46, '1', '2018-12-31', '6', '1', 'Y', 8358, 'CASH PURCHASE', '', '', NULL, '4', '9', 1, 'D', '8358', 1),
(45, '1', '2018-12-31', '6', '82', 'Y', 9521, 'CASH PURCHASE', '', '', NULL, '4', '8', 2, 'D', '9521', 1),
(44, '1', '2018-12-31', '6', '1', 'Y', 9521, 'CASH PURCHASE', '', '', NULL, '4', '8', 1, 'D', '9521', 1),
(41, '1', '2018-12-27', '6', '77', 'Y', 7119, ' PURCHASE', '', '', NULL, '4', '6', 2, 'D', '7119', 1),
(42, '1', '2018-12-27', '6', '13', 'Y', 3894, ' PURCHASE', '', '', NULL, '4', '7', 1, 'D', '3894', 1),
(43, '1', '2018-12-27', '6', '77', 'Y', 3894, ' PURCHASE', '', '', NULL, '4', '7', 2, 'D', '3894', 1),
(26, '1', '2018-12-26', '6', '79', 'Y', 33581, ' PURCHASE', '', '', NULL, '4', '2', 2, 'D', '33581', 1),
(25, '1', '2018-12-26', '6', '13', 'Y', 33581, ' PURCHASE', '', '', NULL, '4', '2', 1, 'D', '33581', 1),
(40, '1', '2018-12-27', '6', '13', 'Y', 7119, ' PURCHASE', '', '', NULL, '4', '6', 1, 'D', '7119', 1),
(39, '1', '2018-12-24', '41', '5', 'Y', 1118.6400146484375, 'TAXABLE VALUE', '', '', NULL, '4', '4', 0, '0', '', 1),
(38, '1', '2018-12-24', '34', '5', 'Y', 201.36000061035156, 'GST', '', '', NULL, '4', '4', 0, '0', '', 1),
(36, '1', '2018-12-24', '1', '5', 'Y', 1320, 'CASH SALE', '', '', NULL, '4', '4', 1, 'C', '1320', 1),
(37, '1', '2018-12-24', '78', '5', 'Y', 3, 'CREDIT SALE', '', '', NULL, '4', '4', 1, 'D', '', 1),
(47, '1', '2018-12-31', '6', '82', 'Y', 8358, 'CASH PURCHASE', '', '', NULL, '4', '9', 2, 'D', '8358', 1),
(48, '1', '2018-12-31', '6', '13', 'Y', 64675, ' PURCHASE', '', '', NULL, '4', '10', 1, 'D', '64675', 1),
(49, '1', '2018-12-31', '6', '83', 'Y', 64675, ' PURCHASE', '', '', NULL, '4', '10', 2, 'D', '64675', 1),
(50, '1', '2018-12-31', '6', '13', 'Y', 4020, ' PURCHASE', '', '', NULL, '4', '11', 1, 'D', '4020', 1),
(51, '1', '2018-12-31', '6', '84', 'Y', 4020, ' PURCHASE', '', '', NULL, '4', '11', 2, 'D', '4020', 1),
(27, '1', '2018-12-26', '6', '1', 'Y', 123397, 'CASH PURCHASE', '', '', NULL, '4', '3', 1, 'D', '123397', 1),
(28, '1', '2018-12-26', '6', '80', 'Y', 123397, 'CASH PURCHASE', '', '', NULL, '4', '3', 2, 'D', '123397', 1),
(29, '1', '2018-12-26', '6', '13', 'Y', 11762, ' PURCHASE', '', '', NULL, '4', '4', 1, 'D', '11762', 1),
(30, '1', '2018-12-26', '6', '81', 'Y', 11762, ' PURCHASE', '', '', NULL, '4', '4', 2, 'D', '11762', 1),
(31, '1', '2018-12-26', '6', '13', 'Y', 9238.19, ' PURCHASE', '', '', NULL, '4', '5', 1, 'D', '9238.19', 1),
(32, '1', '2018-12-26', '6', '81', 'Y', 9238.19, ' PURCHASE', '', '', NULL, '4', '5', 2, 'D', '9238.19', 1),
(52, '1', '2018-12-31', '6', '13', 'Y', 11700, ' PURCHASE', '', '', NULL, '4', '12', 1, 'D', '11700', 1),
(53, '1', '2018-12-31', '6', '83', 'Y', 11700, ' PURCHASE', '', '', NULL, '4', '12', 2, 'D', '11700', 1),
(54, '1', '2018-12-31', '6', '13', 'Y', 0, 'CASH PURCHASE', '', '', NULL, '4', '13', 1, 'D', '11270', 1),
(55, '1', '2018-12-31', '6', '86', 'Y', 0, 'CASH PURCHASE', '', '', NULL, '4', '13', 2, 'D', '11270', 1),
(56, '1', '2018-12-31', '6', '86', 'Y', 11270, 'CREDIT PURCHASE', '', '', NULL, '4', '13', 1, 'C', '', 1),
(57, '1', '2018-12-31', '6', '13', 'Y', 14875, ' PURCHASE', '', '', NULL, '4', '14', 1, 'D', '14875', 1),
(58, '1', '2018-12-31', '6', '87', 'Y', 14875, ' PURCHASE', '', '', NULL, '4', '14', 2, 'D', '14875', 1),
(59, '1', '2018-12-31', '6', '13', 'Y', 23658.07, ' PURCHASE', '', '', NULL, '4', '15', 1, 'D', '23658.07', 1),
(60, '1', '2018-12-31', '6', '88', 'Y', 23658.07, ' PURCHASE', '', '', NULL, '4', '15', 2, 'D', '23658.07', 1),
(61, '1', '2019-01-01', '6', '13', 'Y', 42536, ' PURCHASE', '', '', NULL, '4', '16', 1, 'D', '42536', 1),
(62, '1', '2019-01-01', '6', '77', 'Y', 42536, ' PURCHASE', '', '', NULL, '4', '16', 2, 'D', '42536', 1),
(63, '1', '2019-01-01', '6', '1', 'Y', 0, 'CASH PURCHASE', '', '', NULL, '4', '17', 1, 'D', '3750', 1),
(64, '1', '2019-01-01', '6', '89', 'Y', 0, 'CASH PURCHASE', '', '', NULL, '4', '17', 2, 'D', '3750', 1),
(65, '1', '2019-01-01', '6', '89', 'Y', 3750, 'CREDIT PURCHASE', '', '', NULL, '4', '17', 1, 'C', '', 1),
(66, '1', '2019-01-01', '6', '13', 'Y', 0, 'CASH PURCHASE', '', '', NULL, '4', '18', 1, 'D', '29660', 1),
(67, '1', '2019-01-01', '6', '90', 'Y', 0, 'CASH PURCHASE', '', '', NULL, '4', '18', 2, 'D', '29660', 1),
(68, '1', '2019-01-01', '6', '90', 'Y', 29660, 'CREDIT PURCHASE', '', '', NULL, '4', '18', 1, 'C', '', 1),
(69, '1', '2019-01-02', 'PURCHASE', 'GM IMPEX GM IMPEX', 'Y', 69726, 'CASH PURCHASE', '', '', NULL, '4', '19', 1, 'D', '69726', 1),
(70, '1', '2019-01-02', '6', '91', 'Y', 69726, 'CASH PURCHASE', '', '', NULL, '4', '19', 2, 'D', '69726', 1),
(79, '1', '2019-01-05', '6', '93', 'Y', 141419, 'CASH PURCHASE', '', '', NULL, '4', '22', 2, 'D', '141419', 1),
(78, '1', '2019-01-05', '6', '1', 'Y', 141419, 'CASH PURCHASE', '', '', NULL, '4', '22', 1, 'D', '141419', 1),
(74, '1', '2019-01-04', '6', '1', 'Y', 13594, 'CASH PURCHASE', '', '', NULL, '4', '20', 1, 'D', '13594', 1),
(75, '1', '2019-01-04', '6', '88', 'Y', 13594, 'CASH PURCHASE', '', '', NULL, '4', '20', 2, 'D', '13594', 1),
(76, '1', '2019-01-04', '6', '1', 'Y', 605, 'CASH PURCHASE', '', '', NULL, '4', '21', 1, 'D', '605', 1),
(77, '1', '2019-01-04', '6', '88', 'Y', 605, 'CASH PURCHASE', '', '', NULL, '4', '21', 2, 'D', '605', 1);

-- --------------------------------------------------------

--
-- Table structure for table `us_allentry`
--

CREATE TABLE `us_allentry` (
  `h2_id` int(11) NOT NULL,
  `h2_productid` int(11) DEFAULT NULL,
  `h2_qty` int(11) DEFAULT NULL,
  `h2_supmode` int(11) DEFAULT NULL,
  `h2_cusmode` int(11) DEFAULT NULL,
  `h2_saleorpr` varchar(11) DEFAULT NULL,
  `h2_adddate` datetime DEFAULT NULL,
  `h2_updated` datetime DEFAULT NULL,
  `h2_bibillid` int(11) DEFAULT NULL,
  `h2_pibillid` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `finyear` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `us_billentry`
--

CREATE TABLE `us_billentry` (
  `be_billid` int(11) NOT NULL,
  `user_id` varchar(100) DEFAULT NULL,
  `be_billnumber` int(11) DEFAULT NULL,
  `be_customername` varchar(600) DEFAULT NULL,
  `be_customermobile` varchar(20) DEFAULT NULL,
  `be_customer_tin_num` varchar(100) DEFAULT NULL,
  `be_vehicle_number` varchar(10) DEFAULT NULL,
  `be_billdate` datetime DEFAULT NULL,
  `be_total` float DEFAULT NULL,
  `be_gtotal` varchar(100) DEFAULT NULL,
  `be_paidamount` float DEFAULT NULL,
  `be_paymethod` varchar(250) DEFAULT NULL,
  `be_note` longtext,
  `be_updateddate` datetime DEFAULT NULL,
  `be_updatedby` varchar(250) DEFAULT NULL,
  `be_isactive` int(11) DEFAULT '0',
  `be_discount` float DEFAULT NULL,
  `be_mode` varchar(100) DEFAULT NULL,
  `be_paydate` datetime DEFAULT NULL,
  `be_balance` int(11) DEFAULT NULL,
  `be_customerid` int(11) DEFAULT NULL,
  `be_coolie` varchar(100) DEFAULT NULL,
  `be_oldbal` varchar(100) DEFAULT NULL,
  `be_totvat` float DEFAULT NULL,
  `be_debitid` varchar(100) DEFAULT NULL COMMENT 'cash sales',
  `be_creditid` varchar(100) DEFAULT NULL COMMENT 'credit sales',
  `be_statecode` varchar(1000) DEFAULT NULL,
  `be_mod` varchar(100) DEFAULT NULL,
  `be_caddress` varchar(100) DEFAULT NULL,
  `be_cgstin` varchar(100) DEFAULT NULL,
  `be_cstate` varchar(100) DEFAULT NULL,
  `be_cname` varchar(100) DEFAULT NULL,
  `be_cphone` varchar(100) DEFAULT NULL,
  `be_eway` varchar(100) DEFAULT NULL,
  `finyear` int(100) DEFAULT NULL,
  `be_paid` int(10) NOT NULL,
  `be_sale` varchar(100) NOT NULL,
  `be_address` varchar(100) NOT NULL,
  `be_commision` varchar(150) NOT NULL,
  `be_com_amnt` varchar(150) NOT NULL,
  `be_electrician` varchar(150) NOT NULL,
  `be_custname` varchar(100) NOT NULL,
  `be_comm` varchar(100) NOT NULL,
  `bi_totcomm` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `us_billentry`
--

INSERT INTO `us_billentry` (`be_billid`, `user_id`, `be_billnumber`, `be_customername`, `be_customermobile`, `be_customer_tin_num`, `be_vehicle_number`, `be_billdate`, `be_total`, `be_gtotal`, `be_paidamount`, `be_paymethod`, `be_note`, `be_updateddate`, `be_updatedby`, `be_isactive`, `be_discount`, `be_mode`, `be_paydate`, `be_balance`, `be_customerid`, `be_coolie`, `be_oldbal`, `be_totvat`, `be_debitid`, `be_creditid`, `be_statecode`, `be_mod`, `be_caddress`, `be_cgstin`, `be_cstate`, `be_cname`, `be_cphone`, `be_eway`, `finyear`, `be_paid`, `be_sale`, `be_address`, `be_commision`, `be_com_amnt`, `be_electrician`, `be_custname`, `be_comm`, `bi_totcomm`) VALUES
(1, '1', 1, 'Safvan', '84525135', '', '', '2018-12-24 13:16:00', 1650, '1650', 1650, 'CASH', NULL, '2018-12-24 13:18:58', NULL, 1, 0, 'sales', NULL, 0, 0, '0', '0', NULL, '1', NULL, 'KL', '1', NULL, NULL, NULL, NULL, NULL, NULL, 4, 0, '', 'ajsdbkj', 'YES', '3', '', '', '', ''),
(2, '1', 2, 'Safvan', '84525135', '', '', '2018-12-24 13:21:00', 1650, '1650', 1650, 'CASH', NULL, '2018-12-24 13:22:31', NULL, 1, 0, 'sales', NULL, 0, 0, '0', '0', NULL, '4', NULL, 'KL', '1', NULL, NULL, NULL, NULL, NULL, NULL, 4, 0, '', 'fhgjkj', 'YES', '10', '', '', '', ''),
(3, '1', 3, 'Safvan', '84525135', '', '', '2018-12-24 13:24:00', 1650, '1650', 1650, 'CASH', NULL, '2018-12-24 13:25:39', NULL, 1, 0, 'sales', NULL, 0, 0, '0', '0', NULL, '7', NULL, 'KL', '1', NULL, NULL, NULL, NULL, NULL, NULL, 4, 0, '', 'ajsdbkj', '', '0', '', '', '', ''),
(4, '1', 4, 'SUBASH', '', '', '', '2018-12-24 14:12:00', 1320, '1320', 1320, 'CASH', NULL, '2018-12-27 10:55:23', NULL, 0, 0, 'sales', NULL, 3, 2, '0', '0', NULL, '78', '37', 'KL', '1', NULL, NULL, NULL, NULL, NULL, NULL, 4, 0, '', '', '', '0', '', '', '', ''),
(5, '1', 5, 'Safvan', '9747032888', '', '', '2018-12-24 15:18:00', 49.5, '50', 30, 'CASH', NULL, '2018-12-24 15:19:08', NULL, 1, 0, 'sales', NULL, 20, 0, '0', '0', NULL, '16', NULL, 'KL', '1', NULL, NULL, NULL, NULL, NULL, NULL, 4, 0, '', 'TB Junction-Kalladikode, Palakkad', 'YES', '0', 'jiji', '', '', ''),
(6, '1', 6, 'Jidhun', '84525135', '', '', '2018-12-24 15:40:00', 16.5, '17', 17, 'CASH', NULL, '2018-12-24 15:44:04', NULL, 1, 0, 'sales', NULL, 0, 0, '0', '0', NULL, '19', NULL, 'KL', '1', NULL, NULL, NULL, NULL, NULL, NULL, 4, 0, '', 'TB Junction-Kalladikode, Palakkad', '', '0', 'jiji', '', '', ''),
(7, '1', 7, 'sajna', '', '', '', '2018-12-24 16:34:00', 2400, '2400', 2400, 'CASH', NULL, '2018-12-24 16:34:32', NULL, 1, 0, 'sales', NULL, 0, 0, '0', '0', NULL, '22', NULL, 'KL', '1', NULL, NULL, NULL, NULL, NULL, NULL, 4, 0, '', '', 'YES', '200', 'jiji', '', '', ''),
(8, '1', 8, 'sajna', '', '', '', '2018-12-26 13:47:00', 31.3, '31', 31, 'CASH', NULL, '2018-12-26 16:27:09', NULL, 1, 0, 'sales', NULL, 0, 0, '0', '0', NULL, '33', NULL, 'KL', '1', NULL, NULL, NULL, NULL, NULL, NULL, 4, 0, '', '', '', '0', '', '', '', ''),
(9, '1', 9, '', '', '', '', '2019-01-03 17:38:00', 310, '310', 310, 'CASH', NULL, '2019-01-03 17:40:38', NULL, 1, 0, 'sales', NULL, 0, 0, '0', '0', NULL, '71', NULL, 'KL', '1', NULL, NULL, NULL, NULL, NULL, NULL, 4, 0, '', '', '', '0', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `us_billitems`
--

CREATE TABLE `us_billitems` (
  `bi_billitemid` int(11) NOT NULL,
  `user_id` varchar(100) DEFAULT NULL,
  `bi_billid` int(11) DEFAULT NULL,
  `bi_productid` int(11) DEFAULT NULL,
  `bi_price` float DEFAULT NULL,
  `bi_quantity` float DEFAULT NULL,
  `bi_taxamount` float DEFAULT NULL,
  `bi_discount` float DEFAULT NULL,
  `bi_discount_amount` float NOT NULL,
  `bi_total` float DEFAULT NULL,
  `bi_updatedon` datetime DEFAULT NULL,
  `bi_isactive` int(11) DEFAULT '0',
  `bi_vatamount` float DEFAULT NULL,
  `bi_vatper` float DEFAULT NULL,
  `be_coolie` varchar(100) DEFAULT NULL,
  `bi_sgst` float DEFAULT NULL,
  `bi_sgst_amt` float DEFAULT NULL,
  `bi_cgst` float DEFAULT NULL,
  `bi_cgst_amt` float DEFAULT NULL,
  `bi_igst` float DEFAULT NULL,
  `bi_igst_amt` float DEFAULT NULL,
  `bi_billdate` datetime DEFAULT NULL,
  `bi_purprice` float(10,2) DEFAULT NULL,
  `bi_disc` float(10,2) DEFAULT NULL,
  `bi_prenet` float DEFAULT NULL,
  `finyear` int(100) DEFAULT NULL,
  `bi_totcomm` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `us_billitems`
--

INSERT INTO `us_billitems` (`bi_billitemid`, `user_id`, `bi_billid`, `bi_productid`, `bi_price`, `bi_quantity`, `bi_taxamount`, `bi_discount`, `bi_discount_amount`, `bi_total`, `bi_updatedon`, `bi_isactive`, `bi_vatamount`, `bi_vatper`, `be_coolie`, `bi_sgst`, `bi_sgst_amt`, `bi_cgst`, `bi_cgst_amt`, `bi_igst`, `bi_igst_amt`, `bi_billdate`, `bi_purprice`, `bi_disc`, `bi_prenet`, `finyear`, `bi_totcomm`) VALUES
(1, '1', 1, 1, 1650, 1, 1473.21, 0, 0, 1650, '2018-12-24 13:18:58', 1, 176.79, 12, NULL, 6, 88.395, 6, 88.395, 0, 0, '2018-12-24 13:16:00', 1500.00, 0.00, 1473.21, 4, ''),
(2, '1', 2, 1, 1650, 1, 1473.21, 0, 0, 1650, '2018-12-24 13:22:31', 1, 176.79, 12, NULL, 6, 88.395, 6, 88.395, 0, 0, '2018-12-24 13:21:00', 1500.00, 0.00, 1473.21, 4, ''),
(3, '1', 3, 1, 1650, 1, 1473.21, 0, 0, 1650, '2018-12-24 13:25:39', 1, 176.79, 12, NULL, 6, 88.395, 6, 88.395, 0, 0, '2018-12-24 13:24:00', 1500.00, 0.00, 1473.21, 4, ''),
(5, '1', 5, 5, 9.9, 5, 41.95, 0, 0, 49.5, '2018-12-24 15:19:08', 1, 7.55, 18, NULL, 9, 3.775, 9, 3.775, 0, 0, '2018-12-24 15:18:00', 9.00, 0.00, 41.9492, 4, ''),
(6, '1', 6, 3, 5.5, 3, 13.98, 0, 0, 16.5, '2018-12-24 15:44:04', 1, 2.52, 18, NULL, 9, 1.26, 9, 1.26, 0, 0, '2018-12-24 15:40:00', 5.00, 0.00, 13.9831, 4, ''),
(7, '1', 7, 6, 2400, 1, 2285.71, 0, 0, 2400, '2018-12-24 16:34:32', 1, 114.29, 5, NULL, 2.5, 57.145, 2.5, 57.145, 0, 0, '2018-12-24 16:34:00', 2000.00, 0.00, 2285.71, 4, ''),
(8, '1', 8, 27, 3.13, 10, 26.53, 0, 0, 31.3, '2018-12-26 16:27:09', 1, 4.77, 18, NULL, 9, 2.385, 9, 2.385, 0, 0, '2018-12-26 13:47:00', 2.50, 0.00, 26.5254, 4, ''),
(9, '1', 4, 2, 3.3, 400, 1118.64, 0, 0, 1320, '2018-12-27 10:55:23', 0, 201.36, 18, NULL, 9, 100.68, 9, 100.68, 0, 0, '2018-12-24 14:12:00', 3.00, NULL, NULL, 4, ''),
(10, '1', 9, 12, 44, 5, 186.44, 0, 0, 220, '2019-01-03 17:40:38', 1, 33.56, 18, NULL, 9, 16.78, 9, 16.78, 0, 0, '2019-01-03 17:38:00', 33.33, 0.00, 186.441, 4, ''),
(11, '1', 9, 122, 18, 5, 76.27, 0, 0, 90, '2019-01-03 17:40:38', 1, 13.73, 18, NULL, 9, 6.865, 9, 6.865, 0, 0, '2019-01-03 17:38:00', 24.25, 0.00, 76.2712, 4, '');

-- --------------------------------------------------------

--
-- Table structure for table `us_catogory`
--

CREATE TABLE `us_catogory` (
  `ca_categoryid` int(11) NOT NULL,
  `user_id` varchar(100) DEFAULT NULL,
  `ca_categoryname` varchar(200) DEFAULT NULL,
  `ca_vat` varchar(200) DEFAULT NULL,
  `ca_isactive` int(11) DEFAULT '0',
  `ca_updatedtime` datetime DEFAULT NULL,
  `ca_note` longtext,
  `finyear` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `us_catogory`
--

INSERT INTO `us_catogory` (`ca_categoryid`, `user_id`, `ca_categoryname`, `ca_vat`, `ca_isactive`, `ca_updatedtime`, `ca_note`, `finyear`) VALUES
(1, '1', 'GST@0%', '0', 0, '2017-10-08 00:21:58', NULL, 0),
(2, '1', 'GST@5%', '5', 0, '2017-10-08 00:22:09', NULL, 0),
(3, '1', 'GST@12%', '12', 0, '2017-10-08 00:22:26', NULL, 0),
(4, '1', 'GST@18%', '18', 0, '2017-10-08 00:22:44', NULL, 0),
(5, '1', 'GST@28%', '28', 0, '2017-10-08 00:22:55', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `us_customer`
--

CREATE TABLE `us_customer` (
  `cs_customerid` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `cs_billnumber` int(11) DEFAULT NULL,
  `cs_customername` varchar(600) DEFAULT NULL,
  `cs_customerphone` varchar(100) DEFAULT NULL,
  `cs_address` varchar(1000) DEFAULT NULL,
  `cs_email` varchar(400) DEFAULT NULL,
  `cs_tin_number` varchar(100) DEFAULT NULL,
  `cs_payment` float DEFAULT NULL,
  `cs_discount` float DEFAULT NULL,
  `cs_paid` float DEFAULT NULL,
  `cs_balance` float DEFAULT NULL,
  `cs_paymethod` varchar(250) DEFAULT NULL,
  `cs_note` longtext,
  `cs_updateddate` datetime DEFAULT NULL,
  `cs_updatedby` varchar(250) DEFAULT NULL,
  `cs_isactive` int(11) DEFAULT '0',
  `cs_acntid` varchar(100) DEFAULT NULL,
  `cs_statecode` varchar(1000) DEFAULT NULL,
  `cs_category` varchar(111) DEFAULT NULL,
  `cs_regno` varchar(111) DEFAULT NULL,
  `finyear` int(100) DEFAULT NULL,
  `cs_elecid` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `us_customer`
--

INSERT INTO `us_customer` (`cs_customerid`, `user_id`, `cs_billnumber`, `cs_customername`, `cs_customerphone`, `cs_address`, `cs_email`, `cs_tin_number`, `cs_payment`, `cs_discount`, `cs_paid`, `cs_balance`, `cs_paymethod`, `cs_note`, `cs_updateddate`, `cs_updatedby`, `cs_isactive`, `cs_acntid`, `cs_statecode`, `cs_category`, `cs_regno`, `finyear`, `cs_elecid`) VALUES
(3, 1, NULL, 'SUBASH', '9747032888', 'CHIRAKKAL', '', '', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '92', 'KL', NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `us_elec`
--

CREATE TABLE `us_elec` (
  `el_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `el_billnumber` int(11) DEFAULT NULL,
  `el_name` varchar(600) DEFAULT NULL,
  `el_phone` varchar(100) DEFAULT NULL,
  `el_address` varchar(1000) DEFAULT NULL,
  `el_email` varchar(400) DEFAULT NULL,
  `el_tin_number` varchar(100) DEFAULT NULL,
  `el_payment` float DEFAULT NULL,
  `el_discount` float DEFAULT NULL,
  `el_paid` float DEFAULT NULL,
  `el_balance` float DEFAULT NULL,
  `el_paymethod` varchar(250) DEFAULT NULL,
  `el_note` longtext,
  `el_updateddate` datetime DEFAULT NULL,
  `el_updatedby` varchar(250) DEFAULT NULL,
  `el_isactive` int(11) DEFAULT '0',
  `el_acntid` varchar(100) NOT NULL,
  `el_statecode` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `us_elec`
--

INSERT INTO `us_elec` (`el_id`, `user_id`, `el_billnumber`, `el_name`, `el_phone`, `el_address`, `el_email`, `el_tin_number`, `el_payment`, `el_discount`, `el_paid`, `el_balance`, `el_paymethod`, `el_note`, `el_updateddate`, `el_updatedby`, `el_isactive`, `el_acntid`, `el_statecode`) VALUES
(2, 1, NULL, 'jiji', '8848201980', 'ghjkldfghjkl', 'jiji@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `us_estimation`
--

CREATE TABLE `us_estimation` (
  `be_billid` int(11) NOT NULL,
  `user_id` varchar(100) DEFAULT NULL,
  `be_billnumber` int(11) DEFAULT NULL,
  `be_customername` varchar(600) DEFAULT NULL,
  `be_customermobile` varchar(20) DEFAULT NULL,
  `be_customer_tin_num` varchar(100) DEFAULT NULL,
  `be_vehicle_number` varchar(10) DEFAULT NULL,
  `be_billdate` datetime DEFAULT NULL,
  `be_total` float DEFAULT NULL,
  `be_gtotal` varchar(100) DEFAULT NULL,
  `be_paidamount` float DEFAULT NULL,
  `be_paymethod` varchar(250) DEFAULT NULL,
  `be_note` longtext,
  `be_updateddate` datetime DEFAULT NULL,
  `be_updatedby` varchar(250) DEFAULT NULL,
  `be_isactive` int(11) DEFAULT '0',
  `be_discount` float DEFAULT NULL,
  `be_mode` varchar(100) DEFAULT NULL,
  `be_paydate` datetime DEFAULT NULL,
  `be_balance` int(11) DEFAULT NULL,
  `be_customerid` int(11) DEFAULT NULL,
  `be_coolie` varchar(100) DEFAULT NULL,
  `be_oldbal` varchar(100) DEFAULT NULL,
  `be_totvat` float DEFAULT NULL,
  `be_debitid` varchar(100) DEFAULT NULL COMMENT 'cash sales',
  `be_creditid` varchar(100) DEFAULT NULL COMMENT 'credit sales',
  `be_statecode` varchar(1000) DEFAULT NULL,
  `finyear` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `us_estimationitems`
--

CREATE TABLE `us_estimationitems` (
  `bi_billitemid` int(11) NOT NULL,
  `user_id` varchar(100) DEFAULT NULL,
  `bi_billid` int(11) DEFAULT NULL,
  `bi_productid` int(11) DEFAULT NULL,
  `bi_price` float DEFAULT NULL,
  `bi_quantity` float DEFAULT NULL,
  `bi_discount` varchar(10) DEFAULT NULL,
  `bi_total` float DEFAULT NULL,
  `bi_updatedon` datetime DEFAULT NULL,
  `bi_isactive` int(11) DEFAULT '0',
  `bi_vatamount` float DEFAULT NULL,
  `bi_vatper` float DEFAULT NULL,
  `be_coolie` varchar(100) DEFAULT NULL,
  `bi_sgst` float DEFAULT NULL,
  `bi_sgst_amt` float DEFAULT NULL,
  `bi_cgst` float DEFAULT NULL,
  `bi_cgst_amt` float DEFAULT NULL,
  `bi_igst` float DEFAULT NULL,
  `bi_igst_amt` float DEFAULT NULL,
  `finyear` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `us_financialyear`
--

CREATE TABLE `us_financialyear` (
  `fy_id` int(11) NOT NULL,
  `fy_name` varchar(100) DEFAULT NULL,
  `fy_startdate` datetime DEFAULT NULL,
  `fy_enddate` datetime DEFAULT NULL,
  `fy_updatedtime` datetime DEFAULT NULL,
  `fy_default` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `us_financialyear`
--

INSERT INTO `us_financialyear` (`fy_id`, `fy_name`, `fy_startdate`, `fy_enddate`, `fy_updatedtime`, `fy_default`) VALUES
(4, '2018-2019', '2018-04-01 00:00:00', '2019-03-31 00:00:00', '2018-04-16 11:02:26', 1);

-- --------------------------------------------------------

--
-- Table structure for table `us_godown`
--

CREATE TABLE `us_godown` (
  `gd_id` int(11) NOT NULL,
  `user_id` varchar(100) DEFAULT NULL,
  `gd_name` varchar(200) DEFAULT NULL,
  `gd_isactive` int(11) DEFAULT '0',
  `gd_updatedtime` datetime DEFAULT NULL,
  `gd_description` longtext,
  `gd_place` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `us_groupheads`
--

CREATE TABLE `us_groupheads` (
  `gr_id` int(11) NOT NULL,
  `gr_head` varchar(110) DEFAULT NULL,
  `gr_type` varchar(110) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `us_groupheads`
--

INSERT INTO `us_groupheads` (`gr_id`, `gr_head`, `gr_type`) VALUES
(1, 'SUNDRY CREDITORS', 'LIABILITY'),
(2, 'SUNDRY DEBTORS', 'ASSET'),
(3, 'CAPITAL', 'LIABILITY'),
(4, 'LOANS', 'LIABILITY'),
(7, 'CASH', 'ASSET'),
(8, 'BANK CURRENT ACCOUNT', 'ASSET'),
(9, 'SALE', 'ASSET'),
(10, 'PURCHASE', 'LIABILITY'),
(11, 'TAX AND DUTIES', 'ASSET'),
(12, 'DIRECT EXPENSE', 'LIABILITY'),
(13, 'INDIRECT EXPENSE', 'LIABILITY'),
(14, 'DIRECT INCOME', 'ASSET'),
(15, 'INDIRECT INCOME', 'ASSET'),
(16, 'CURRENT ASSETS', 'ASSET'),
(17, 'FIXED ASSETS', 'ASSET'),
(18, 'CURRENT LIABILITY', 'LIABILITY'),
(19, 'Salary1', '--Select--'),
(20, 'Tele expense', 'LIABILITY');

-- --------------------------------------------------------

--
-- Table structure for table `us_note`
--

CREATE TABLE `us_note` (
  `be_billid` int(11) NOT NULL,
  `user_id` varchar(100) DEFAULT NULL,
  `be_bill_id` int(11) DEFAULT NULL,
  `be_billnumber` int(11) DEFAULT NULL,
  `be_customername` varchar(600) DEFAULT NULL,
  `be_customermobile` varchar(20) DEFAULT NULL,
  `be_customer_tin_num` varchar(100) DEFAULT NULL,
  `be_vehicle_number` varchar(10) DEFAULT NULL,
  `be_billdate` datetime DEFAULT NULL,
  `be_total` float(10,2) DEFAULT NULL,
  `be_gtotal` varchar(100) DEFAULT NULL,
  `be_paidamount` float DEFAULT NULL,
  `be_paymethod` varchar(250) DEFAULT NULL,
  `be_note` longtext,
  `be_updateddate` datetime DEFAULT NULL,
  `be_updatedby` varchar(250) DEFAULT NULL,
  `be_isactive` int(11) DEFAULT '0',
  `be_discount` float DEFAULT NULL,
  `be_mode` varchar(100) DEFAULT NULL,
  `be_paydate` datetime DEFAULT NULL,
  `be_balance` int(11) DEFAULT NULL,
  `be_customerid` int(11) DEFAULT NULL,
  `be_coolie` varchar(100) DEFAULT NULL,
  `be_oldbal` varchar(100) DEFAULT NULL,
  `be_totvat` float DEFAULT NULL,
  `be_debitid` varchar(100) DEFAULT NULL COMMENT 'cash sales',
  `be_creditid` varchar(100) DEFAULT NULL COMMENT 'credit sales',
  `be_statecode` varchar(1000) DEFAULT NULL,
  `be_brand` int(11) DEFAULT NULL,
  `be_reverse` varchar(100) DEFAULT NULL,
  `be_mode_pay` varchar(100) DEFAULT NULL,
  `be_duedate` datetime DEFAULT NULL,
  `be_reason` varchar(1000) DEFAULT NULL,
  `be_retunbillno` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `us_payment`
--

CREATE TABLE `us_payment` (
  `pa_paymentid` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `pa_customerid` int(11) DEFAULT NULL,
  `pa_billid` int(11) DEFAULT NULL,
  `pa_balance` float DEFAULT NULL,
  `pa_newpayment` float DEFAULT NULL,
  `pa_newbalance` float DEFAULT NULL,
  `pa_isactive` int(11) DEFAULT '0',
  `pa_updatedon` datetime DEFAULT NULL,
  `pa_mode` varchar(10) DEFAULT NULL COMMENT '(1)customer(2)supplier',
  `pa_transactionid` varchar(100) DEFAULT NULL,
  `finyear` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `us_products`
--

CREATE TABLE `us_products` (
  `pr_productid` int(11) NOT NULL,
  `user_id` varchar(100) DEFAULT NULL,
  `pr_productcode` varchar(100) DEFAULT NULL,
  `pr_productname` varchar(1000) DEFAULT NULL,
  `pr_hsn` varchar(1000) DEFAULT NULL,
  `pr_purchaseprice` float DEFAULT NULL,
  `pr_saleprice` float DEFAULT NULL,
  `pr_retail` varchar(100) DEFAULT NULL,
  `pr_wholesale` varchar(100) DEFAULT NULL,
  `pr_description` longtext,
  `pr_stock` float DEFAULT NULL,
  `pr_isactive` int(11) DEFAULT '0',
  `pr_updateddate` datetime DEFAULT NULL,
  `pr_type` int(11) DEFAULT NULL,
  `pr_unit` varchar(700) DEFAULT NULL,
  `pr_pecentage` varchar(100) DEFAULT NULL,
  `pr_purchasepriced` varchar(100) DEFAULT NULL,
  `finyear` int(100) DEFAULT NULL,
  `pr_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `us_products`
--

INSERT INTO `us_products` (`pr_productid`, `user_id`, `pr_productcode`, `pr_productname`, `pr_hsn`, `pr_purchaseprice`, `pr_saleprice`, `pr_retail`, `pr_wholesale`, `pr_description`, `pr_stock`, `pr_isactive`, `pr_updateddate`, `pr_type`, `pr_unit`, `pr_pecentage`, `pr_purchasepriced`, `finyear`, `pr_date`) VALUES
(1, '1', '100000001', 'BAt', '456', 1500, 1650, '1650', '', NULL, 1, 1, '2018-12-24 13:18:20', 3, 'Piece', '10', NULL, NULL, '2018-12-24'),
(2, '1', 'STR001', 'ELBOW 1/2 INC', '3917', 3, 3.3, '3.3', '', NULL, -406, 1, '2018-12-24 14:05:12', 4, 'Nos.', '10', NULL, NULL, '2018-12-24'),
(3, '1', 'STR002', 'ELBOW 3/4 INC', '3917', 5, 5.5, NULL, '', NULL, 3, 1, '2018-12-24 14:05:12', 4, 'Nos.', '10', NULL, NULL, '2018-12-24'),
(4, '1', 'STR003', 'ELBOW 1 INC', '3917', 9, 9.9, NULL, '', NULL, -15, 1, '2018-12-24 14:05:12', 4, 'Nos.', '10', NULL, NULL, '2018-12-24'),
(5, '1', 'STR004', 'ELBOW 1 1/4 INC', '3917', 9, 9.9, NULL, '', NULL, 5, 1, '2018-12-24 14:05:12', 4, 'Nos.', '10', NULL, NULL, '2018-12-24'),
(6, '1', '1000000', 'Kundham', '4566', 2000, 2400, NULL, '', NULL, 1, 1, '2018-12-24 16:17:27', 2, 'Piece', '20', NULL, NULL, '2018-12-24'),
(7, '1', 'ESP01', 'ESPEE 19MM (M) BLUE', '3917', 21.352, 32, '32', '', NULL, 300, 0, '2018-12-26 11:48:54', 4, 'Piece', '0', NULL, NULL, '2018-12-26'),
(8, '1', 'ESP02', 'ESPEE 19MM (M) BLACK', '3917', 23.184, 38, '38', '', NULL, 200, 0, '2018-12-26 11:48:54', 4, 'Piece', '0', NULL, NULL, '2018-12-26'),
(9, '1', 'ESP03', 'ESPEE 20MM CON', '3917', 38.304, 52, '52', '', NULL, 200, 0, '2018-12-26 12:09:37', 4, 'Piece', '0', NULL, NULL, '2018-12-26'),
(10, '1', 'ESP04', 'ESPEE 19 MM CON', '3917', 29.89, 44, '44', '', NULL, 100, 0, '2018-12-26 12:12:32', 4, 'Piece', '0', NULL, NULL, '2018-12-26'),
(11, '1', 'ESP05', 'ESPEE 25 MM BLUE', '3917', 33.832, 48, '48', '', NULL, 200, 0, '2018-12-26 12:14:09', 4, 'Piece', '0', NULL, NULL, '2018-12-26'),
(12, '1', 'SRN001', 'SHARON 1 1/2 INC FLO', '3917', 33.331, 44, '44', '', NULL, 50, 0, '2018-12-26 12:26:29', 4, 'M', '0', NULL, NULL, '2018-12-26'),
(13, '1', 'SRN002', 'SHARON 2 INC FLO', '3917', 40.538, 58, '58', '', NULL, 50, 0, '2018-12-26 12:27:37', 4, 'M', '0', NULL, NULL, '2018-12-26'),
(14, '1', 'SRN003', 'SHARON 4 INC FLO', '3917', 96.788, 135, '135', '', NULL, 50, 0, '2018-12-26 12:28:49', 4, 'M', '0', NULL, NULL, '2018-12-26'),
(15, '1', 'SRN004', 'SHARON 4 INC PIPE ISI', '3917', 124.576, 185, '185', '', NULL, 250, 0, '2018-12-26 12:36:59', 4, 'M', '0', NULL, NULL, '2018-12-26'),
(16, '1', 'SRN005', 'SHARON 1/2 INC PIPE ISI', '3917', 12.712, 26, '26', '', NULL, 125, 0, '2018-12-26 12:36:59', 4, 'M', '0', NULL, NULL, '2018-12-26'),
(17, '1', 'SRN006', 'SHARON 3/4 INC PIPE ISI', '3917', 19.594, 30, '30', '', NULL, 250, 0, '2018-12-26 12:49:06', 4, 'M', '0', NULL, NULL, '2018-12-26'),
(18, '1', 'SRN007', 'SHARON 1 INC PIPE ISI', '3917', 30.238, 45, '45', '', NULL, 200, 0, '2018-12-26 12:49:06', 4, 'M', '0', NULL, NULL, '2018-12-26'),
(19, '1', 'SRN008', 'SHARON 1 1/4 INC PIPE ISI', '3917', 32.034, 48, '48', '', NULL, 150, 0, '2018-12-26 12:49:06', 4, 'M', '0', NULL, NULL, '2018-12-26'),
(20, '1', 'SRN009', 'SHARON 1 1/2 INC PIPE ISI', '3917', 46.882, 62, '62', '', NULL, 125, 0, '2018-12-26 12:49:06', 4, 'M', '0', NULL, NULL, '2018-12-26'),
(21, '1', 'SRN010', 'SHARON 2 INC PIPE ISI', '3917', 53.458, 75, '75', '', NULL, 75, 0, '2018-12-26 12:49:06', 4, 'M', '0', NULL, NULL, '2018-12-26'),
(22, '1', 'SRN011', 'SHARON 2 1/2 INC PIPE ISI', '3917', 73.695, 105, '105', '', NULL, 50, 0, '2018-12-26 12:49:06', 4, 'M', '0', NULL, NULL, '2018-12-26'),
(23, '1', 'SRN012', 'SHARON 3 INC PIPE ISI', '3917', 106.373, 145, '145', '', NULL, 35, 0, '2018-12-26 12:49:06', 4, 'M', '0', NULL, NULL, '2018-12-26'),
(24, '1', 'SRN013', 'SHARON 4 INC PIPE POP', '3917', 106.779, 151, '151', '', NULL, 250, 0, '2018-12-26 12:49:06', 4, 'M', '0', NULL, NULL, '2018-12-26'),
(25, '1', 'SRN014', 'SHARON 3/4 THREADED PIPE', '3917', 28.678, 45, '45', '', NULL, 125, 0, '2018-12-26 12:49:06', 4, 'M', '0', NULL, NULL, '2018-12-26'),
(26, '1', 'SKR01', 'BEND 25 MM BLUE', '3917', 3.9, 8, '8', '', NULL, 1000, 0, '2018-12-26 13:46:48', 4, 'Nos.', '0', NULL, NULL, '2018-12-26'),
(27, '1', 'SKR02', 'BEND 20 MM BLACK', '3917', 2.5, 7, '7', '', NULL, 500, 0, '2018-12-26 13:46:49', 4, 'Nos.', '0', NULL, NULL, '2018-12-26'),
(28, '1', 'SKR03', 'BEND 19 MM BLUE', '3917', 2.33, 6, '6', '', NULL, 1000, 0, '2018-12-26 13:46:49', 4, 'Nos.', '0', NULL, NULL, '2018-12-26'),
(29, '1', 'SKR04', 'BEND 19 MM BLACK', '3917', 2.33, 6, '6', '', NULL, 500, 0, '2018-12-26 13:46:49', 4, 'Nos.', '0', NULL, NULL, '2018-12-26'),
(30, '1', 'SKR05', 'S BEND 1/2 INC', '3917', 6.74, 12, '12', '', NULL, 24, 0, '2018-12-26 13:46:49', 4, 'Nos.', '0', NULL, NULL, '2018-12-26'),
(31, '1', 'SKR06', 'S BEND 3/4 INC', '3917', 8.43, 15, '15', '', NULL, 24, 0, '2018-12-26 13:46:49', 4, 'Nos.', '0', NULL, NULL, '2018-12-26'),
(32, '1', 'SKR 07', 'S BEND 1 INC', '3917', 9.24, 15, '15', '', NULL, 24, 0, '2018-12-26 13:46:49', 4, 'Nos.', '0', NULL, NULL, '2018-12-26'),
(33, '1', 'SKR 08', 'S BEND 1 1/4 INC', '3917', 13.55, 20, '20', '', NULL, 12, 0, '2018-12-26 13:46:49', 4, 'Nos.', '0', NULL, NULL, '2018-12-26'),
(34, '1', 'SKR 09', 'S BEND 1 1/2 INC', '3917', 19.49, 35, '35', '', NULL, 12, 0, '2018-12-26 13:46:49', 4, 'Nos.', '0', NULL, NULL, '2018-12-26'),
(35, '1', 'SKR 10', 'S BEND 2 INC', '3917', 28.38, 44, '44', '', NULL, 12, 0, '2018-12-26 13:46:49', 4, 'Nos.', '0', NULL, NULL, '2018-12-26'),
(36, '1', 'SKR11', 'S BEND 2 1/2 INC', '3917', 35, 52, '52', '', NULL, 6, 0, '2018-12-26 14:29:54', 4, 'Nos.', '0', NULL, NULL, '2018-12-26'),
(37, '1', 'SKR12', 'S BEND 3 INC', '3917', 51.51, 75, '75', '', NULL, 6, 0, '2018-12-26 14:29:54', 4, 'Nos.', '0', NULL, NULL, '2018-12-26'),
(38, '1', 'SKR13', 'S BEND 4 INC', '3917', 90.67, 145, '145', '', NULL, 12, 0, '2018-12-26 14:29:54', 4, 'Nos.', '0', NULL, NULL, '2018-12-26'),
(39, '1', 'SKR14', 'BEND 1/2 INC', '3917', 4.88, 9, '9', '', NULL, 100, 0, '2018-12-26 14:29:54', 4, 'Nos.', '0', NULL, NULL, '2018-12-26'),
(40, '1', 'SKR15', 'BEND 3/4 INC', '3917', 5.67, 12, '12', '', NULL, 100, 0, '2018-12-26 14:29:54', 4, 'Nos.', '0', NULL, NULL, '2018-12-26'),
(41, '1', 'SKR16', 'BEND 1 INC', '3917', 6.76, 15, '15', '', NULL, 200, 0, '2018-12-26 14:29:54', 4, 'Nos.', '0', NULL, NULL, '2018-12-26'),
(42, '1', 'SKR17', 'BEND 1 1/4 INC', '3917', 9.23, 19, '19', '', NULL, 40, 0, '2018-12-26 14:29:54', 4, 'Nos.', '0', NULL, NULL, '2018-12-26'),
(43, '1', 'SKR18', 'BEND 1 1/2 INC', '3917', 12.71, 25, '25', '', NULL, 50, 0, '2018-12-26 14:29:54', 4, 'Nos.', '0', NULL, NULL, '2018-12-26'),
(44, '1', 'SKR19', 'BEND 2 INC', '3917', 18.5, 35, '35', '', NULL, 50, 0, '2018-12-26 14:29:54', 4, 'Nos.', '0', NULL, NULL, '2018-12-26'),
(45, '1', 'SKR20', 'BEND 2 1/2 INC', '3917', 26.69, 42, '42', '', NULL, 12, 0, '2018-12-26 14:29:54', 4, 'Nos.', '0', NULL, NULL, '2018-12-26'),
(46, '1', 'SKR21', 'BEND 3 INC', '3917', 38.84, 64, '64', '', NULL, 12, 0, '2018-12-26 14:29:54', 4, 'Nos.', '0', NULL, NULL, '2018-12-26'),
(47, '1', 'SKR22', 'BEND 4 INC', '3917', 63.55, 105, '105', '', NULL, 36, 0, '2018-12-26 14:29:54', 4, 'Nos.', '0', NULL, NULL, '2018-12-26'),
(48, '1', 'STR001', 'STAR BOND 25 ML', '3506', 13, 10, NULL, '', NULL, 24, 0, '2018-12-26 17:04:46', 4, 'Nos.', '', NULL, NULL, '2018-12-26'),
(49, '1', 'STR002', 'STAR BOND 100 ML', '3506', 114, 65, NULL, '', NULL, 48, 0, '2018-12-27 11:32:33', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(50, '1', 'STR003', 'STAR BOND 500 ML', '3506', 397, 280, NULL, '', NULL, 6, 0, '2018-12-27 11:39:14', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(51, '1', 'STR004', 'STAR BOND 50 ML', '3506', 58, 35, NULL, '', NULL, 48, 0, '2018-12-27 11:39:14', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(52, '1', 'STR005', 'STAR BOND 250 ML', '3506', 201, 148, NULL, '', NULL, 12, 0, '2018-12-27 11:42:16', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(53, '1', 'STR006', 'CPVC SOLVENT 20 ML TUBE', '3506', 72, 45, NULL, '', NULL, 10, 0, '2018-12-27 14:02:44', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(54, '1', 'STR007', 'CPVC SOLVENT 118 ML', '3506', 200, 210, NULL, '', NULL, 24, 0, '2018-12-27 14:06:21', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(55, '1', 'STR008', 'CPVC SOLVENT 50 ML', '3506', 149, 98, NULL, '', NULL, 12, 0, '2018-12-27 14:08:23', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(56, '1', 'STR009', 'CPVC BALL VALVE 3/4 INC', '3917', 143.85, 155, NULL, '', NULL, 5, 0, '2018-12-27 14:31:15', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(57, '1', 'STR010', 'CPVC BALL VALVE 1 INC', '3917', 318.15, 320, NULL, '', NULL, 3, 0, '2018-12-27 14:32:32', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(58, '1', 'STR011', 'CPVC CLAMP 3/4 INC', '3917', 6, 8, NULL, '', NULL, 25, 0, '2018-12-27 14:50:59', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(59, '1', 'STR012', 'CPVC CLAMP 1 INC', '3917', 7.35, 10, NULL, '', NULL, 25, 0, '2018-12-27 14:50:59', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(60, '1', 'STR013', 'CPVC COUPLER 3/4 INC', '3917', 14.55, 16, NULL, '', NULL, 50, 0, '2018-12-27 14:50:59', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(61, '1', 'STR014', 'CPVC COUPLER 1 INC', '3917', 28.35, 30, NULL, '', NULL, 20, 0, '2018-12-27 14:50:59', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(62, '1', 'STR015', 'CPVC HALF ELBOW 3/4 INC', '3917', 26.8, 28, NULL, '', NULL, 50, 0, '2018-12-27 14:50:59', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(63, '1', 'STR016', 'CPVC HALF ELBOW 1 INC', '3917', 58.8, 60, NULL, '', NULL, 20, 0, '2018-12-27 14:50:59', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(64, '1', 'STR017', 'CPVC ELBOW 3/4 INC', '3917', 17.85, 22, NULL, '', NULL, 100, 0, '2018-12-27 14:50:59', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(65, '1', 'STR018', 'CPVC ELBOW 1 INC', '3917', 43.05, 44, NULL, '', NULL, 20, 0, '2018-12-27 14:50:59', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(66, '1', 'STR019', 'CPVC ENDCAP 3/4 INC', '3917', 12.3, 13, NULL, '', NULL, 30, 0, '2018-12-27 14:50:59', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(67, '1', 'STR020', 'CPVC ENDCAP 1 INC', '3917', 23.9, 24, NULL, '', NULL, 20, 0, '2018-12-27 14:50:59', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(68, '1', 'STR021', 'CPVC TEE 3/4 INC', '3917', 29.4, 30, NULL, '', NULL, 30, 0, '2018-12-27 14:50:59', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(69, '1', 'STR022', 'CPVC TEE 1 INC', '3917', 54.6, 55, NULL, '', NULL, 20, 0, '2018-12-27 14:50:59', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(70, '1', 'STR023', 'CPVC FTA 3/4 INC', '3917', 28.35, 30, NULL, '', NULL, 25, 0, '2018-12-27 14:50:59', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(71, '1', 'STR024', 'CPVC FTA 1 INC', '3917', 47.8, 48, NULL, '', NULL, 10, 0, '2018-12-27 15:04:44', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(72, '1', 'STR025', 'CPVC MTA 3/4 INC', '3917', 20.65, 25, NULL, '', NULL, 25, 0, '2018-12-27 15:04:44', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(73, '1', 'STR026', 'CPVC MTA 1 INC', '3917', 38.15, 42, NULL, '', NULL, 10, 0, '2018-12-27 15:04:45', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(74, '1', 'STR027', 'CPVC  3/4 X 1/2 BRASS MTA', '3917', 101.75, 106, '106', '', NULL, 10, 0, '2018-12-27 15:04:45', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(75, '1', 'STR028', 'CPVC 3/4 X 1/2  BRASS ELBOW', '3917', 59.85, 70, NULL, '', NULL, 50, 0, '2018-12-27 15:04:45', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(76, '1', 'STR029', 'CPVC 1 X 1/2 BRASS ELBOW', '3917', 129.15, 145, NULL, '', NULL, 20, 0, '2018-12-27 15:04:45', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(77, '1', 'STR030', 'CPVC 3/4 X 1/2 BRASS TEE', '3917', 72.45, 78, NULL, '', NULL, 30, 0, '2018-12-27 15:04:45', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(78, '1', 'STR031', 'CPVC 1 X 1/2 BRASS TEE', '3917', 162.75, 175, NULL, '', NULL, 10, 0, '2018-12-27 15:32:44', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(79, '1', 'STR032', 'CPVC 3/4 X 1/2 BRASS FTA', '3917', 72.1, 78, NULL, '', NULL, 50, 0, '2018-12-27 15:32:44', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(80, '1', 'STR033', 'CPVC 1 X 1/2 BRASS FTA', '3917', 109.35, 125, NULL, '', NULL, 10, 0, '2018-12-27 15:32:44', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(81, '1', 'STR034', 'CPVC SOLAR 3/4 INC PIPE', '3917', 120.05, 315, NULL, '', NULL, 75, 0, '2018-12-27 15:32:44', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(82, '1', 'STR035', 'CPVC SOLAR 1 INC PIPE', '3917', 174.15, 350, NULL, '', NULL, 30, 0, '2018-12-27 15:32:44', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(83, '1', 'STR036', 'CPVC SDR 3/4 INC PIPE', '3917', 75.8, 180, NULL, '', NULL, 300, 0, '2018-12-27 15:32:44', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(84, '1', 'STR037', 'CPVC SDR 1 INC PIPE', '3917', 153.5, 230, NULL, '', NULL, 75, 0, '2018-12-27 15:32:44', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(85, '1', 'STR038', 'CPVC STEP OVER BEND 3/4 INC', '3917', 83.25, 85, NULL, '', NULL, 10, 0, '2018-12-27 15:32:44', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(86, '1', 'STR039', 'CPVC STEP OVER BEND 1 INC', '3917', 186.9, 195, NULL, '', NULL, 5, 0, '2018-12-27 15:32:44', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(87, '1', 'STR040', 'CPVC UNION 3/4 INC', '3917', 85.05, 88, NULL, '', NULL, 5, 0, '2018-12-27 15:48:07', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(88, '1', 'STR041', 'CPVC UNION 1 INC', '3917', 140.7, 145, NULL, '', NULL, 5, 0, '2018-12-27 15:48:08', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(89, '1', 'STR042', 'HALF ELBOW 1/2 INC', '3917', 4.9, 12, NULL, '', NULL, 0, 0, '2018-12-27 16:29:00', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(90, '1', 'STR043', 'HALF ELBOW 3/4 INC', '3917', 10.65, 15, NULL, '', NULL, 0, 0, '2018-12-27 16:29:00', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(91, '1', 'STR044', 'HALF ELBOW 1 INC', '3917', 15.7, 22, NULL, '', NULL, 0, 0, '2018-12-27 16:29:00', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(92, '1', 'STR045', 'HALF ELBOW 1 1/4 INC', '3917', 16.05, 25, NULL, '', NULL, 0, 0, '2018-12-27 16:29:00', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(93, '1', 'STR046', 'HALF ELBOW 1 1/2 INC', '3917', 20.25, 38, NULL, '', NULL, 0, 0, '2018-12-27 16:29:00', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(94, '1', 'STR047', 'HALF ELBOW  4 INC', '3917', 108.45, 135, NULL, '', NULL, 0, 0, '2018-12-27 16:29:00', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(95, '1', 'STR048', 'HALF ELBOW 2 INC', '3917', 44.75, 65, NULL, '', NULL, 0, 0, '2018-12-27 16:29:00', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(96, '1', 'STR049', 'HALF ELBOW 2 1/2 INC', '3917', 47.4, 82, NULL, '', NULL, 0, 0, '2018-12-27 16:29:00', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(97, '1', 'STR050', 'HALF ELBOW 3 INC', '3917', 57.35, 85, NULL, '', NULL, 0, 0, '2018-12-27 16:29:00', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(98, '1', 'STR051', 'COUPLER 4 INC', '3917', 99.5, 110, NULL, '', NULL, 0, 0, '2018-12-27 16:29:00', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(99, '1', 'STR052', 'COUPLER 1/2 INC', '3917', 4.4, 6, NULL, '', NULL, 0, 0, '2018-12-27 16:29:00', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(100, '1', 'STR053', 'COUPLER 3/4 INC', '3917', 6, 8, NULL, '', NULL, 0, 0, '2018-12-27 16:29:00', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(101, '1', 'STR054', 'COUPLER 1 INC', '3917', 9, 12, NULL, '', NULL, 0, 0, '2018-12-27 16:29:00', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(102, '1', 'STR055', 'COUPLER 1 1/4 INC', '3917', 11.55, 15, NULL, '', NULL, 0, 0, '2018-12-27 16:29:00', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(103, '1', 'STR056', 'COUPLER 1 1/2 INC', '3917', 17.25, 25, NULL, '', NULL, 0, 0, '2018-12-27 16:29:00', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(104, '1', 'STR057', 'COUPLER 2 INC', '3917', 32.3, 38, NULL, '', NULL, 0, 0, '2018-12-27 16:29:00', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(105, '1', 'STR058', 'COUPLER 2 1/2 INC', '3917', 50.55, 65, NULL, '', NULL, 0, 0, '2018-12-27 16:29:00', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(106, '1', 'STR059', 'COUPLER 3 INC', '3917', 73.65, 85, NULL, '', NULL, 0, 0, '2018-12-27 16:29:00', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(107, '1', 'STR060', 'DOOR ELBOW 4 INC', '3917', 131.05, 155, NULL, '', NULL, 0, 0, '2018-12-27 16:29:00', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(108, '1', 'STR061', 'DOOR ELBOW 1 1/4 INC', '3917', 30.5, 35, NULL, '', NULL, 0, 0, '2018-12-27 16:29:00', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(109, '1', 'STR062', 'DOOR ELBOW 1 1/2 INC', '3917', 33.2, 42, NULL, '', NULL, 0, 0, '2018-12-27 16:29:00', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(110, '1', 'STR063', 'DOOR ELBOW 2 INC', '3917', 46.65, 55, NULL, '', NULL, 0, 0, '2018-12-27 16:29:00', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(111, '1', 'STR064', 'DOOR ELBOW 2 1/2 INC', '3917', 82.7, 95, NULL, '', NULL, 0, 0, '2018-12-27 16:29:00', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(112, '1', 'STR065', 'DOOR ELBOW 3 INC', '3917', 95.85, 125, NULL, '', NULL, 0, 0, '2018-12-27 17:00:44', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(113, '1', 'STR066', 'DOOR TEE 4 INC', '3917', 180.6, 138, NULL, '', NULL, 0, 0, '2018-12-27 17:00:44', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(114, '1', 'STR067', 'DOOR TEE 1 1/4 INC', '3917', 44, 35, NULL, '', NULL, 0, 0, '2018-12-27 17:00:44', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(115, '1', 'STR068', 'DOOR TEE 1 1/2 INC', '3917', 63.75, 60, NULL, '', NULL, 0, 0, '2018-12-27 17:00:44', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(116, '1', 'STR069', 'DOOR TEE 2 INC', '3917', 72.5, 65, NULL, '', NULL, 0, 0, '2018-12-27 17:00:44', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(117, '1', 'STR070', 'DOOR TEE 2 1/2 INC', '3917', 97.65, 75, NULL, '', NULL, 0, 0, '2018-12-27 17:00:44', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(118, '1', 'STR071', 'DOOR TEE 3 INC', '3917', 126.2, 95, NULL, '', NULL, 0, 0, '2018-12-27 17:00:44', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(119, '1', 'STR072', 'ELBOW 4 INC ISI', '3917', 223.05, 135, NULL, '', NULL, 0, 0, '2018-12-27 17:00:44', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(120, '1', 'STR073', 'ELBOW 3/4 INC ISI', '3917', 8.5, 9, NULL, '', NULL, 0, 0, '2018-12-27 17:00:44', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(121, '1', 'STR074', 'ELBOW 1 INC ISI', '3917', 15.9, 12, NULL, '', NULL, 0, 0, '2018-12-27 17:00:44', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(122, '1', 'STR075', 'ELBOW 1 1/4 INC ISI', '3917', 24.25, 18, NULL, '', NULL, 5, 0, '2018-12-27 17:00:44', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(123, '1', 'STR076', 'ELBOW 1 1/2 INC ISI', '3917', 37.4, 25, NULL, '', NULL, 0, 0, '2018-12-27 17:00:44', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(124, '1', 'STR077', 'ELBOW 2 INC ISI', '3917', 62.05, 45, NULL, '', NULL, 0, 0, '2018-12-27 17:00:44', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(125, '1', 'STR078', 'ELBOW 4 INC', '3917', 133.2, 95, NULL, '', NULL, 0, 0, '2018-12-27 17:00:44', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(126, '1', 'STR079', 'ELBOW 3/4 INC', '3917', 7.05, 8, NULL, '', NULL, 0, 0, '2018-12-27 17:00:44', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(127, '1', 'STR080', 'ELBOW 1 INC', '3917', 11.45, 10, NULL, '', NULL, 0, 0, '2018-12-27 17:00:44', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(128, '1', 'STR081', 'ELBOW 1 1/4 INC', '3917', 20.65, 15, '15', '', NULL, 0, 0, '2018-12-27 17:00:44', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(129, '1', 'STR082', 'ELBOW 1 1/2 INC', '3917', 22.25, 18, '18', '', NULL, 0, 0, '2018-12-27 17:00:44', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(130, '1', 'STR083', 'ELBOW 2 INC', '3917', 42.1, 35, NULL, '', NULL, 0, 0, '2018-12-27 17:35:08', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(131, '1', 'STR084', 'ELBOW  2 1/2 INC', '3917', 66.05, 55, NULL, '', NULL, 0, 0, '2018-12-27 17:35:08', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(132, '1', 'STR085', 'ELBOW 3 INC', '3917', 90.8, 65, NULL, '', NULL, 0, 0, '2018-12-27 17:35:08', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(133, '1', 'STR086', 'ELBOW 4 INC COUP', '3917', 94.45, 70, NULL, '', NULL, 0, 0, '2018-12-27 17:35:09', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(134, '1', 'STR087', 'ENDCAP 1/2 INC', '3917', 3.9, 5, NULL, '', NULL, 0, 0, '2018-12-27 17:35:09', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(135, '1', 'STR088', 'ENDCAP 3/4 INC', '3917', 4.6, 6, NULL, '', NULL, 0, 0, '2018-12-27 17:35:09', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(136, '1', 'STR089', 'ENDCAP 1 INC', '3917', 6.6, 8, NULL, '', NULL, 0, 0, '2018-12-27 17:35:09', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(137, '1', 'STR090', 'ENDCAP 1 1/4 INC', '3917', 12.9, 10, NULL, '', NULL, 0, 0, '2018-12-27 17:57:45', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(138, '1', 'STR091', 'ENDCAP 1 1/2 INC', '3917', 14.4, 15, NULL, '', NULL, 0, 0, '2018-12-27 17:57:45', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(139, '1', 'STR092', 'ENDCAP 2 INC', '3917', 26.3, 25, NULL, '', NULL, 0, 0, '2018-12-27 17:57:45', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(140, '1', 'STR093', 'FTA 4 INC', '3917', 164.6, 95, NULL, '', NULL, 0, 0, '2018-12-27 17:57:45', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(141, '1', 'STR094', 'FTA 1/2 INC', '3917', 4.6, 5, NULL, '', NULL, 0, 0, '2018-12-27 17:57:45', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(142, '1', 'STR095', 'FTA 3/4 INC', '3917', 7.75, 8, NULL, '', NULL, 0, 0, '2018-12-27 17:57:45', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(143, '1', 'STR096', 'FTA 1 INC', '3917', 9.85, 10, NULL, '', NULL, 0, 0, '2018-12-27 17:57:45', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(144, '1', 'STR097', 'FTA 1 1/4 INC', '3917', 18.7, 15, NULL, '', NULL, 0, 0, '2018-12-27 17:57:45', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(145, '1', 'STR098', 'FTA 1 1/2 INC', '3917', 26.6, 20, NULL, '', NULL, 0, 0, '2018-12-27 17:57:46', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(146, '1', 'STR099', 'FTA 2 INC', '3917', 49.35, 35, NULL, '', NULL, 0, 0, '2018-12-27 17:57:46', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(147, '1', 'STR100', 'FTA 2 1/2 INC', '3917', 69.2, 40, NULL, '', NULL, 0, 0, '2018-12-27 17:57:46', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(148, '1', 'STR101', 'FTA 3 INC', '3917', 110.65, 70, NULL, '', NULL, 0, 0, '2018-12-27 17:57:46', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(149, '1', 'STR102', 'ENDCAP 4 INC', '3917', 47.25, 55, NULL, '', NULL, 0, 0, '2018-12-27 17:57:46', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(150, '1', 'STR103', 'ENDCAP 5 INC', '3917', 69.25, 65, NULL, '', NULL, 0, 0, '2018-12-27 17:57:46', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(151, '1', 'STR104', 'ONE WAY TRAP', '3917', 159.45, 150, NULL, '', NULL, 0, 0, '2018-12-27 17:57:46', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(152, '1', 'STR105', '4 WAY TRAP', '3917', 175.55, 180, NULL, '', NULL, 0, 0, '2018-12-27 17:57:46', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(153, '1', 'STR106', 'MTA 4 INC', '3917', 123.65, 110, NULL, '', NULL, 0, 0, '2018-12-27 17:57:46', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(154, '1', 'STR107', 'MTA 1/2 INC', '3917', 4.35, 8, NULL, '', NULL, 0, 0, '2018-12-27 17:57:46', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(155, '1', 'STR108', 'MTA 3/4 INC', '3917', 4.7, 9, NULL, '', NULL, 0, 0, '2018-12-27 17:57:46', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(156, '1', 'STR109', 'MTA 1 INC', '3917', 7.9, 10, NULL, '', NULL, 0, 0, '2018-12-27 17:57:46', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(157, '1', 'STR110', 'MTA 1 1/4 INC', '3917', 14.3, 12, NULL, '', NULL, 0, 0, '2018-12-27 17:57:46', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(158, '1', 'STR111', 'MTA 1 1/2 INC', '3917', 20.55, 16, NULL, '', NULL, 0, 0, '2018-12-27 17:57:46', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(159, '1', 'STR112', 'MTA 2 INC', '3917', 33.7, 25, NULL, '', NULL, 0, 0, '2018-12-27 17:57:46', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(160, '1', 'STR113', 'MTA 2 1/2 INC', '3917', 50, 35, NULL, '', NULL, 0, 0, '2018-12-27 17:57:46', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(161, '1', 'STR114', 'MTA 3 INC', '3917', 72.7, 55, NULL, '', NULL, 0, 0, '2018-12-27 17:57:46', 4, 'Nos.', '0', NULL, NULL, '2018-12-27'),
(162, '1', 'STR115', 'NANHI TRAP 110 X 63', '3917', 132, 110, NULL, '', NULL, 0, 0, '2018-12-28 15:40:53', 4, 'Nos.', '0', NULL, NULL, '2018-12-28'),
(163, '1', 'STR116', 'P TRAP', '3917', 242.35, 160, NULL, '', NULL, 0, 0, '2018-12-28 16:13:26', 4, 'Nos.', '0', NULL, NULL, '2018-12-28'),
(164, '1', 'STR117', 'CLAMP 4 INC', '3917', 16.7, 12, NULL, '', NULL, 0, 0, '2018-12-28 16:13:26', 4, 'Nos.', '0', NULL, NULL, '2018-12-28'),
(165, '1', 'STR118', 'CLAMP 1 INC', '3917', 6.6, 5, NULL, '', NULL, 0, 0, '2018-12-28 16:13:26', 4, 'Nos.', '0', NULL, NULL, '2018-12-28'),
(166, '1', 'STR119', 'CLAMP 1 1/4 INC', '3917', 7.25, 7, NULL, '', NULL, 0, 0, '2018-12-28 16:13:26', 4, 'Nos.', '0', NULL, NULL, '2018-12-28'),
(167, '1', 'STR120', 'CLAMP 1 1/2 INC', '3917', 8.95, 8, NULL, '', NULL, 0, 0, '2018-12-28 16:13:26', 4, 'Nos.', '0', NULL, NULL, '2018-12-28'),
(168, '1', 'STR121', 'CLAMP 2 INC', '3917', 10.65, 9, '9', '', NULL, 0, 0, '2018-12-28 16:13:26', 4, 'Nos.', '0', NULL, NULL, '2018-12-28'),
(169, '1', 'STR122', 'CLAMP 2 1/2 INC', '3917', 12.55, 10, '10', '', NULL, 0, 0, '2018-12-28 16:13:26', 4, 'Nos.', '0', NULL, NULL, '2018-12-28'),
(170, '1', 'STR123', 'CLAMP 3 INC', '3917', 13.75, 12, '12', '', NULL, 0, 0, '2018-12-28 16:13:26', 4, 'Nos.', '0', NULL, NULL, '2018-12-28'),
(171, '1', 'STR124', 'BUSH 1 1/2 X 3/4', '3917', 21.3, 20, '20', '', NULL, 0, 0, '2018-12-28 16:13:26', 4, 'Nos.', '0', NULL, NULL, '2018-12-28'),
(172, '1', 'STR125', 'BUSH 4 X 2', '3917', 112.1, 75, '75', '', NULL, 0, 0, '2018-12-28 16:13:26', 4, 'Nos.', '0', NULL, NULL, '2018-12-28'),
(173, '1', 'STR126', 'BUSH 3/4 X 1/2', '3917', 4.7, 5, '5', '', NULL, 0, 0, '2018-12-28 16:13:26', 4, 'Nos.', '0', NULL, NULL, '2018-12-28'),
(174, '1', 'STR127', 'BUSH 1 X 3/4', '3917', 7.1, 8, '8', '', NULL, 0, 0, '2018-12-28 16:13:26', 4, 'Nos.', '0', NULL, NULL, '2018-12-28'),
(175, '1', 'STR128', 'BUSH 1 1/4 X 3/4', '3917', 10, 10, '10', '', NULL, 0, 0, '2018-12-28 16:13:26', 4, 'Nos.', '0', NULL, NULL, '2018-12-28'),
(176, '1', 'STR129', 'BUSH 1 1/4 X 1', '3917', 12.55, 12, '12', '', NULL, 0, 0, '2018-12-28 16:13:26', 4, 'Nos.', '0', NULL, NULL, '2018-12-28'),
(177, '1', 'STR130', 'BUSH 1 1/2 X 1', '3917', 23.45, 15, '15', '', NULL, 0, 0, '2018-12-28 16:13:26', 4, 'Nos.', '0', NULL, NULL, '2018-12-28'),
(178, '1', 'STR131', 'BUSH 2 X 1', '3917', 26.3, 20, '20', '', NULL, 0, 0, '2018-12-28 16:13:26', 4, 'Nos.', '0', NULL, NULL, '2018-12-28'),
(179, '1', 'STR132', 'BUSH 2 X 1 1/2', '3917', 29.2, 25, '25', '', NULL, 0, 0, '2018-12-28 16:13:26', 4, 'Nos.', '0', NULL, NULL, '2018-12-28'),
(180, '1', 'STR133', 'BUSH 2 1/2 X 2', '3917', 42.5, 35, '35', '', NULL, 0, 0, '2018-12-28 16:13:26', 4, 'Nos.', '0', NULL, NULL, '2018-12-28'),
(181, '1', 'STR134', 'BUSH 3 X 2 ', '3917', 69.45, 55, '55', '', NULL, 0, 0, '2018-12-28 16:13:26', 4, 'Nos.', '0', NULL, NULL, '2018-12-28'),
(182, '1', 'STR135', 'REDUSER ELBOW 1 X 3/4', '3917', 20.75, 16, '16', '', NULL, 0, 0, '2018-12-28 16:13:26', 4, 'Nos.', '0', NULL, NULL, '2018-12-28'),
(183, '1', 'STR136', 'REDUSER TEE 1 X 3/4', '3917', 24.3, 18, '18', '', NULL, 0, 0, '2018-12-28 16:13:26', 4, 'Nos.', '0', NULL, NULL, '2018-12-28'),
(184, '1', 'STR137', 'REDUSER TEE 1 1/2 X 1', '3917', 66.9, 45, '45', '', NULL, 0, 0, '2018-12-28 16:13:26', 4, 'Nos.', '0', NULL, NULL, '2018-12-28'),
(185, '1', 'STR138', 'REDUSER 4 X 1 1/2', '3917', 83.4, 65, '65', '', NULL, 0, 0, '2018-12-28 16:13:26', 4, 'Nos.', '0', NULL, NULL, '2018-12-28'),
(186, '1', 'STR139', 'REDUSER 4 X 2', '3917', 81.8, 70, '70', '', NULL, 0, 0, '2018-12-28 16:13:26', 4, 'Nos.', '0', NULL, NULL, '2018-12-28'),
(187, '1', 'STR140', 'REDUSER 3/4 X 1/2', '3917', 5.45, 6, '6', '', NULL, 0, 0, '2018-12-28 16:45:01', 4, 'Nos.', '0', NULL, NULL, '2018-12-28'),
(188, '1', 'STR141', 'REDUSER 1 X 3/4', '3917', 7.05, 8, '8', '', NULL, 0, 0, '2018-12-28 16:45:01', 4, 'Nos.', '0', NULL, NULL, '2018-12-28'),
(189, '1', 'STR142', 'REDUSER 1 1/4 X 3/4', '3917', 17.25, 10, '10', '', NULL, 0, 0, '2018-12-28 16:45:01', 4, 'Nos.', '0', NULL, NULL, '2018-12-28'),
(190, '1', 'STR143', 'REDUSER 1 1/4 X 1', '3917', 16.65, 15, '15', '', NULL, 0, 0, '2018-12-28 16:45:01', 4, 'Nos.', '0', NULL, NULL, '2018-12-28'),
(191, '1', 'STR144', 'REDUSER 1 1/2 X 3/4', '3917', 22.85, 18, '18', '', NULL, 0, 0, '2018-12-28 16:45:01', 4, 'Nos.', '0', NULL, NULL, '2018-12-28'),
(192, '1', 'STR145', 'REDUSER 1 1/2 X 1', '3917', 21.9, 20, '20', '', NULL, 0, 0, '2018-12-28 16:45:01', 4, 'Nos.', '0', NULL, NULL, '2018-12-28'),
(193, '1', 'STR146', 'REDUSER 2 X 1', '3917', 35.4, 26, '26', '', NULL, 0, 0, '2018-12-28 16:45:01', 4, 'Nos.', '0', NULL, NULL, '2018-12-28'),
(194, '1', 'STR147', 'REDUSER 2 X 1 1/2', '3917', 30.65, 28, '28', '', NULL, 0, 0, '2018-12-28 16:45:01', 4, 'Nos.', '0', NULL, NULL, '2018-12-28'),
(195, '1', 'STR148', 'REDUSER 2 1/2 X 2', '3917', 43.8, 35, '35', '', NULL, 0, 0, '2018-12-28 16:45:01', 4, 'Nos.', '0', NULL, NULL, '2018-12-28'),
(196, '1', 'STR149', 'REDUSER 3 X 2', '3917', 72.6, 60, '60', '', NULL, 0, 0, '2018-12-28 16:45:01', 4, 'Nos.', '0', NULL, NULL, '2018-12-28'),
(197, '1', 'STR150', 'PN 16 FTA 3/4 X 1/2', '3917', 83.35, 60, '60', '', NULL, 0, 0, '2018-12-28 17:23:35', 4, 'Nos.', '0', NULL, NULL, '2018-12-28'),
(198, '1', 'STR151', 'REDUSER FTA 3/4 X 1/2', '3917', 6.3, 5, '5', '', NULL, 0, 0, '2018-12-28 17:23:35', 4, 'Nos.', '0', NULL, NULL, '2018-12-28'),
(199, '1', 'STR152', 'REDUSER FTA 1 X 3/4', '3917', 12.95, 8, '8', '', NULL, 0, 0, '2018-12-28 17:23:35', 4, 'Nos.', '0', NULL, NULL, '2018-12-28'),
(200, '1', 'STR153', 'SADDLE 1 1/2 X 1/2', '3917', 70.7, 60, '60', '', NULL, 0, 0, '2018-12-28 17:23:35', 4, 'Nos.', '0', NULL, NULL, '2018-12-28'),
(201, '1', 'STR186', 'SADDLE 2 X 1/2 ', '3917', 70.7, 60, '60', '', NULL, 0, 0, '2018-12-28 17:23:35', 4, 'Nos.', '0', NULL, NULL, '2018-12-28'),
(202, '1', 'STR154', 'SADDLE 2 X 3/4', '3917', 111.05, 95, NULL, '', NULL, 0, 0, '2018-12-28 17:23:35', 4, 'Nos.', '0', NULL, NULL, '2018-12-28'),
(203, '1', 'STR155', 'Y 4 INC', '3917', 246.1, 170, NULL, '', NULL, 0, 0, '2018-12-28 17:23:35', 4, 'Nos.', '0', NULL, NULL, '2018-12-28'),
(204, '1', 'STR156', 'Y 2 INC', '3917', 101.85, 70, NULL, '', NULL, 0, 0, '2018-12-28 17:23:35', 4, 'Nos.', '0', NULL, NULL, '2018-12-28'),
(205, '1', 'STR157', 'Y 2 1/2 INC', '3917', 120.15, 84, NULL, '', NULL, 0, 0, '2018-12-28 17:23:35', 4, 'Nos.', '0', NULL, NULL, '2018-12-28'),
(206, '1', 'STR158', 'Y 3 INC', '3917', 158.15, 110, NULL, '', NULL, 0, 0, '2018-12-28 17:23:36', 4, 'Nos.', '0', NULL, NULL, '2018-12-28'),
(207, '1', 'STR159', 'TANK CONNECTOR 3/4 INC', '3917', 31.5, 35, NULL, '', NULL, 0, 0, '2018-12-28 17:23:36', 4, 'Nos.', '0', NULL, NULL, '2018-12-28'),
(208, '1', 'STR160', 'TANK CONNECTOR 1 INC', '3917', 38.6, 45, NULL, '', NULL, 0, 0, '2018-12-28 17:23:36', 4, 'Nos.', '0', NULL, NULL, '2018-12-28'),
(209, '1', 'STR161', 'TANK CONNECTOR 1 1/4 INC', '3917', 54.9, 55, NULL, '', NULL, 0, 0, '2018-12-28 17:23:36', 4, 'Nos.', '0', NULL, NULL, '2018-12-28'),
(210, '1', 'STR162', 'TANK CONNECTOR 2 INC', '3917', 71.65, 68, NULL, '', NULL, 0, 0, '2018-12-28 17:23:36', 4, 'Nos.', '0', NULL, NULL, '2018-12-28'),
(211, '1', 'STR163', 'TEE 4 INC ISI ', '3917', 276.45, 185, NULL, '', NULL, 0, 0, '2018-12-29 12:07:08', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(212, '1', 'STR164', 'TEE 3/4 INC ISI', '3917', 12.85, 12, NULL, '', NULL, 0, 0, '2018-12-29 12:07:08', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(213, '1', 'STR165', 'TEE 1 INC ISI', '3917', 22.25, 16, NULL, '', NULL, 0, 0, '2018-12-29 12:07:08', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(214, '1', 'STR166', 'TEE 1 1/4 INC ISI', '3917', 31.2, 22, NULL, '', NULL, 0, 0, '2018-12-29 12:07:08', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(215, '1', 'STR167', 'TEE 1 1/2 INC ISI', '3917', 54.15, 38, NULL, '', NULL, 0, 0, '2018-12-29 12:07:08', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(216, '1', 'STR168', 'TEE 2 INC ISI', '3917', 89.05, 60, NULL, '', NULL, 0, 0, '2018-12-29 12:07:08', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(217, '1', 'STR169', 'TEE  (COUP) 4 INC', '3917', 133.2, 95, NULL, '', NULL, 0, 0, '2018-12-29 12:07:08', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(218, '1', 'STR170', 'TEE 4 INC', '3917', 164.7, 135, NULL, '', NULL, 0, 0, '2018-12-29 12:07:08', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(219, '1', 'STR171', 'TEE 3/4 INC', '3917', 8.4, 10, NULL, '', NULL, 0, 0, '2018-12-29 12:07:08', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(220, '1', 'STR172', 'TEE  1 INC', '3917', 13.85, 13, NULL, '', NULL, 0, 0, '2018-12-29 12:07:08', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(221, '1', 'STR173', 'TEE  1 1/4 INC', '3917', 26.3, 18, NULL, '', NULL, 0, 0, '2018-12-29 12:07:08', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(222, '1', 'STR174', 'TEE 1 1/2 INC', '3917', 30.65, 30, NULL, '', NULL, 0, 0, '2018-12-29 12:07:08', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(223, '1', 'STR175', 'TEE 2 INC', '3917', 50.2, 42, NULL, '', NULL, 0, 0, '2018-12-29 12:07:08', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(224, '1', 'STR176', 'TEE 2 1/2 INC', '3917', 85.5, 65, NULL, '', NULL, 0, 0, '2018-12-29 12:07:08', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(225, '1', 'STR177', 'TEE 3 INC', '3917', 120.45, 85, NULL, '', NULL, 0, 0, '2018-12-29 12:07:08', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(226, '1', 'STR178', 'PN 16 ELBOW 3/4 X 1/2', '3917', 63.05, 55, NULL, '', NULL, 0, 0, '2018-12-29 12:07:08', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(227, '1', 'STR179', 'ENDCAP THREADED 1/2 INC', '3917', 4.7, 5, NULL, '', NULL, 0, 0, '2018-12-29 12:07:08', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(228, '1', 'STR180', 'ENDCAP THREADED 3/4 INC', '3917', 7.75, 8, NULL, '', NULL, 0, 0, '2018-12-29 12:07:08', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(229, '1', 'STR181', 'ENDCAP THREADED 1 INC', '3917', 9, 10, NULL, '', NULL, 0, 0, '2018-12-29 12:07:08', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(230, '1', 'STR182', 'PN 16 TEE 3/4 X 1/2', '3917', 87.4, 65, NULL, '', NULL, 0, 0, '2018-12-29 12:07:08', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(231, '1', 'STR183', 'COWL 4 INC', '3917', 49.35, 35, NULL, '', NULL, 0, 0, '2018-12-29 12:07:08', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(232, '1', 'STR184', 'COWL 2 X 1 1/2', '3917', 28.35, 25, NULL, '', NULL, 0, 0, '2018-12-29 12:07:08', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(233, '1', 'STR185', 'COWL 3 INC', '3917', 38.9, 30, NULL, '', NULL, 0, 0, '2018-12-29 12:07:08', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(234, '1', 'SPR01', 'GREEN HOSE 1 INC SPINNER', '3917', 37.288, 55, NULL, '', NULL, 150, 0, '2018-12-29 13:11:39', 4, 'M', '0', NULL, NULL, '2018-12-29'),
(235, '1', 'SPR02', 'GREEN HOSE 1 1/4 INC SPINNER', '3917', 56.49, 76, NULL, '', NULL, 30, 0, '2018-12-29 13:11:39', 4, 'M', '0', NULL, NULL, '2018-12-29'),
(236, '1', 'SPR03', 'GREEN HOSE 1 1/2 INC SPINNER', '3917', 75.424, 110, NULL, '', NULL, 30, 0, '2018-12-29 13:11:40', 4, 'M', '0', NULL, NULL, '2018-12-29'),
(237, '1', 'WAT01', 'SINK TAP WALL WATERTEC', '3917', 388.48, 546, NULL, '', NULL, 0, 0, '2018-12-29 14:11:34', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(238, '1', 'WAT02', 'GARDEN TAP M WATERTEC', '3917', 195.84, 275, '275', '', NULL, 0, 0, '2018-12-29 14:11:34', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(239, '1', 'WAT03', 'CONNECTION TUBE 2 FT WATERTEC', '3917', 55.2, 80, '80', '', NULL, 0, 0, '2018-12-29 14:11:34', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(240, '1', 'WAT04', 'CONNECTION TUBE 1 1/2 FT WATERTEC', '3917', 49.2, 70, '70', '', NULL, 0, 0, '2018-12-29 14:11:34', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(241, '1', 'WAT05', 'CONNECTION TUBE 1 MTR WATERTEC', '3917', 90, 150, NULL, '', NULL, 0, 0, '2018-12-29 14:46:12', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(242, '1', 'WAT06', 'CONNECTION TUBE 1 1/2 MTR', '3917', 123, 185, NULL, '', NULL, 0, 0, '2018-12-29 14:46:12', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(243, '1', 'WAT07', 'FOOT VALVE 3/4 SPRING WATERTEC', '3917', 40.8, 62, NULL, '', NULL, 0, 0, '2018-12-29 14:46:12', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(244, '1', 'WAT08', 'FOOT VALVE 1 SPRING WATERTEC', '3917', 46.2, 70, NULL, '', NULL, 0, 0, '2018-12-29 14:46:12', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(245, '1', 'WAT09', 'FOOT VALVE 1 1/4 SPRING WATERTEC', '3917', 52.2, 80, NULL, '', NULL, 0, 0, '2018-12-29 14:46:12', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(246, '1', 'WAT10', 'FOOT VALVE 3/4 FLAP WATERTEC', '3917', 46.2, 70, NULL, '', NULL, 0, 0, '2018-12-29 14:46:12', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(247, '1', 'WAT11', 'FOOT VALVE 1 FLAP WATERTEC', '3917', 51, 80, NULL, '', NULL, 0, 0, '2018-12-29 14:46:12', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(248, '1', 'WAT12', 'FOOT VALVE 1 1/4 FLAP WATERTEC', '3917', 57, 90, NULL, '', NULL, 0, 0, '2018-12-29 14:46:12', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(249, '1', 'WAT13 ', 'FLUSH TANK CI-SLEEK WATERTEC', '3922', 628.48, 850, NULL, '', NULL, 0, 0, '2018-12-29 14:46:12', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(250, '1', 'WAT14', 'MIRROR WITH CABIN WATERTEC', '7009', 1190.4, 1600, NULL, '', NULL, 0, 0, '2018-12-29 14:46:12', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(251, '1', 'WAT15', 'BRUSH STAND WATERTEC', '3917', 154.88, 220, NULL, '', NULL, 0, 0, '2018-12-29 14:46:12', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(252, '1', 'WAT16', 'FLOOR TRAP WATERTEC', '3924', 67.2, 95, NULL, '', NULL, 0, 0, '2018-12-29 14:46:12', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(253, '1', 'WAT17', 'TOWEL RAD WATERTEC', '3924', 364.8, 530, NULL, '', NULL, 0, 0, '2018-12-29 14:46:12', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(254, '1', 'WAT18', 'PUSH COCK WATERTEC', '3917', 119.68, 180, NULL, '', NULL, 0, 0, '2018-12-29 14:46:12', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(255, '1', 'WAT19', 'GARDEN HOSE 1/2 INC 30 MTR WATERTEC', '3917', 444.8, 675, NULL, '', NULL, 0, 0, '2018-12-29 14:46:12', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(256, '1', 'WAT20', 'GARDEN HOSE 1/2 INC 10 MTR WATERTEC', '3917', 151.04, 230, NULL, '', NULL, 0, 0, '2018-12-29 14:46:12', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(257, '1', 'WAT21', 'GARDEN HOSE 3/4 INC 30 MTR WATERTEC', '3917', 752.64, 980, NULL, '', NULL, 0, 0, '2018-12-29 14:46:12', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(258, '1', 'WAT22', 'GARDEN HOSE 3/4 INC10  MTR WATERTEC', '3917', 258.56, 330, NULL, '', NULL, 0, 0, '2018-12-29 15:17:12', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(259, '1', 'WAT23', 'ANGLE VALVE WATERTEC', '3917', 146.56, 210, NULL, '', NULL, 0, 0, '2018-12-29 15:17:12', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(260, '1', 'WAT24', 'HEALTH FAUCET WATERTEC', '3917', 264.32, 380, NULL, '', NULL, 0, 0, '2018-12-29 15:17:12', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(261, '1', 'WAT25', 'BIP TAP WITH FLANGE WATERTEC', '3917', 187.52, 195, NULL, '', NULL, 0, 0, '2018-12-29 15:17:12', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(262, '1', 'WAT26', 'BIP TAP M WATERTEC', '3917', 136.32, 180, NULL, '', NULL, 0, 0, '2018-12-29 15:17:13', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(263, '1', 'WAT27', 'LONG BODY WATERTEC', '3917', 200.32, 280, NULL, '', NULL, 0, 0, '2018-12-29 15:17:13', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(264, '1', 'WAT28', 'PILLAR TAP WATERTEC', '3917', 214.4, 290, NULL, '', NULL, 0, 0, '2018-12-29 15:17:13', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(265, '1', 'WAT29', '2 WAY BIP TAP WATERTEC', '3917', 256.64, 380, NULL, '', NULL, 0, 0, '2018-12-29 15:17:13', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(266, '1', 'WAT30', 'FLOAT VALVE 1/2 INC WATERTEC', '3917', 144.64, 210, NULL, '', NULL, 0, 0, '2018-12-29 15:17:13', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(267, '1', 'WAT31', '2 WAY ANGLE VALVE WITH TAP WATERTEC', '3917', 247.04, 350, NULL, '', NULL, 0, 0, '2018-12-29 15:17:13', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(268, '1', 'WAT32', 'SINK TAP TABLE WATERTEC', '3917', 388.48, 560, NULL, '', NULL, 0, 0, '2018-12-29 15:17:13', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(269, '1', 'WAT33', 'BALL VALVE 1/2 INC PASTED', '3917', 38.4, 60, NULL, '', NULL, 0, 0, '2018-12-29 15:17:13', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(270, '1', 'WAT34', 'BALL VALVE 3/4 INC PASTED', '3917', 50.4, 80, NULL, '', NULL, 0, 0, '2018-12-29 15:17:13', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(271, '1', 'WAT35', 'BALL VALVE 1 INC PASTED', '3917', 66.6, 105, NULL, '', NULL, 0, 0, '2018-12-29 15:17:13', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(272, '1', 'WAT36', 'BALL VALVE 1 1/4 INC PASTED', '3917', 95.4, 140, NULL, '', NULL, 0, 0, '2018-12-29 15:17:13', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(273, '1', 'WAT37', 'BALL VALVE 1 1/2 INC PASTED', '3917', 140.4, 210, NULL, '', NULL, 0, 0, '2018-12-29 15:17:13', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(274, '1', 'WAT38', 'BALL VALVE 2 INC PASTED', '3917', 189, 280, NULL, '', NULL, 0, 0, '2018-12-29 15:17:13', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(275, '1', 'WAT39', 'WASHING MACHINE OUTLET', '3917', 83.2, 125, NULL, '', NULL, 0, 0, '2018-12-29 15:17:13', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(276, '1', 'WAT40', 'TOWEL RING DX WATERTEC', '3917', 103.04, 150, NULL, '', NULL, 0, 0, '2018-12-29 15:17:13', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(277, '1', 'WAT41', 'SOAP DISH WITH BRUSH STAND WATERTEC', '3924', 141.44, 190, NULL, '', NULL, 0, 0, '2018-12-29 15:17:13', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(278, '1', 'WAT42', 'SHOWER 8A WATERTEC', '3922', 174.72, 260, NULL, '', NULL, 0, 0, '2018-12-29 15:17:13', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(279, '1', 'WAT43', 'HAND SHOWER WATERTEC', '3922', 327.04, 450, NULL, '', NULL, 0, 0, '2018-12-29 15:17:13', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(280, '1', 'WAT44', 'WASHING MACHINE TAP', '3917', 217.6, 310, NULL, '', NULL, 0, 0, '2018-12-29 15:17:13', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(281, '1', 'KSL01', 'CASING CAP 1/2 INC', '3916', 25.74, 45, NULL, '', NULL, 150, 0, '2018-12-29 15:26:15', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(282, '1', 'KSL02', 'CASING CAP 3/4 INC', '3916', 35.64, 55, NULL, '', NULL, 100, 0, '2018-12-29 15:26:15', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(283, '1', 'KSL03', 'CASING CAP 1 INC', '3916', 46.2, 65, NULL, '', NULL, 50, 0, '2018-12-29 15:26:15', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(284, '1', 'KLS04', 'CASING CAP 1 INC', '3916', 57.42, 75, NULL, '', NULL, 0, 0, '2018-12-29 15:26:15', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(285, '1', 'JJ01', 'BALL VALVE BRASS 1/2 INC ', '8481', 94.92, 140, NULL, '', NULL, 6, 0, '2018-12-29 16:02:01', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(286, '1', 'JJ02', 'BALL VALVE BRASS 3/4 INC', '8481', 160.17, 250, NULL, '', NULL, 6, 0, '2018-12-29 16:02:01', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(287, '1', 'JJ03', 'BALL VALVE BRASS 1 INC', '8481', 241.53, 350, NULL, '', NULL, 6, 0, '2018-12-29 16:02:01', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(288, '1', 'JJ04', 'BALL VALVE BRASS 1 1/4 INC', '8481', 419.49, 550, NULL, '', NULL, 4, 0, '2018-12-29 16:02:01', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(289, '1', 'JJ05', 'BALL VALVE BRASS 1 1/2 INC', '8481', 596.61, 750, NULL, '', NULL, 2, 0, '2018-12-29 16:02:01', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(290, '1', 'JJ06', 'GI BEND 1/2 INC', '7307', 18.64, 38, NULL, '', NULL, 30, 0, '2018-12-29 16:02:01', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(291, '1', 'JJ07', 'GI BEND 3/4 INC', '7307', 22.46, 45, NULL, '', NULL, 30, 0, '2018-12-29 16:02:01', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(292, '1', 'JJ08', 'GI BEND 1 INC', '7307', 32.2, 55, NULL, '', NULL, 30, 0, '2018-12-29 16:02:01', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(293, '1', 'JJ09', 'GI COUPLER 1/2 INC', '7307', 11.53, 20, NULL, '', NULL, 30, 0, '2018-12-29 16:02:01', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(294, '1', 'JJ10', 'GI COUPLER 3/4 INC', '7307', 17.63, 30, NULL, '', NULL, 30, 0, '2018-12-29 16:02:01', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(295, '1', 'JJ11', 'GI COUPLER 1 INC', '7307', 22.03, 35, NULL, '', NULL, 30, 0, '2018-12-29 16:02:01', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(296, '1', 'JJ12', 'GI ELBOW 1/2 INC', '7307', 12.37, 24, NULL, '', NULL, 30, 0, '2018-12-29 16:02:01', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(297, '1', 'JJ13', 'GI ELBOW 3/4 INC', '7307', 20.34, 40, NULL, '', NULL, 50, 0, '2018-12-29 16:02:01', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(298, '1', 'JJ14', 'GI ELBOW 1 INC', '7307', 31.86, 53, NULL, '', NULL, 30, 0, '2018-12-29 16:02:01', 5, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(299, '1', 'JJ15', 'GI TEE 1/2 INC', '7307', 29.53, 45, NULL, '', NULL, 30, 0, '2018-12-29 16:02:01', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(300, '1', 'JJ16', 'GI TEE 3/4 INC', '7307', 39.19, 60, NULL, '', NULL, 30, 0, '2018-12-29 16:02:01', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(301, '1', 'JJ17', 'EX NIPPLE 1 INC', '7307', 12.5, 25, NULL, '', NULL, 21, 0, '2018-12-29 16:02:01', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(302, '1', 'JJ18', 'EX NIPPLE 1 1/2 INC', '7307', 25.08, 45, NULL, '', NULL, 24, 0, '2018-12-29 16:02:01', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(303, '1', 'JJ19', 'EX NIPPLE  2 INC', '7307', 29.66, 55, NULL, '', NULL, 10, 0, '2018-12-29 16:02:01', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(304, '1', 'JJ20', 'BARAL NIPPLE 1/2 X 3', '7307', 7.37, 18, NULL, '', NULL, 12, 0, '2018-12-29 16:02:01', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(305, '1', 'JJ21', 'BARAL NIPPLE 1/2 X 6 ', '7307', 14.75, 40, NULL, '', NULL, 12, 0, '2018-12-29 16:02:01', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(306, '1', 'JJ22 ', 'BARAL NIPPLE 1/2 X 9', '7307', 22.12, 55, NULL, '', NULL, 12, 0, '2018-12-29 16:02:01', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(307, '1', 'JJ23', 'BARAL NIPPLE 1/2 X  36', '7307', 89.83, 140, NULL, '', NULL, 12, 0, '2018-12-29 16:27:27', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(308, '1', 'JJ24', 'BARAL NIPPLE 3/4 X 3', '7307', 9.66, 20, NULL, '', NULL, 12, 0, '2018-12-29 16:27:27', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(309, '1', 'JJ25', 'BARAL NIPPLE 3/4 X 6', '7307', 19.32, 35, NULL, '', NULL, 12, 0, '2018-12-29 16:27:27', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(310, '1', 'JJ26', 'BARAL NIPPLE 3/4 X 9', '7307', 28.98, 60, NULL, '', NULL, 12, 0, '2018-12-29 16:27:27', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(311, '1', 'JJ27', 'BARAL NIPPLE 3/4 X 12', '7307', 38.64, 70, NULL, '', NULL, 4, 0, '2018-12-29 16:27:27', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(312, '1', 'JJ28', 'BARAL NIPPLE 3/4 X 24', '7307', 77.29, 130, NULL, '', NULL, 12, 0, '2018-12-29 16:27:27', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(313, '1', 'JJ29', 'BARAL NIPPLE 3/4 X 36', '7307', 115.93, 180, NULL, '', NULL, 12, 0, '2018-12-29 16:27:27', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(314, '1', 'JJ30', 'GI REDUSER ELBOW 1 X 3/4', '7307', 31.86, 53, NULL, '', NULL, 12, 0, '2018-12-29 16:27:27', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(315, '1', 'JJ31', 'GI REDUSER TEE 3/4 X 1/2', '7307', 29.53, 48, NULL, '', NULL, 12, 0, '2018-12-29 16:27:27', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(316, '1', 'JJ32', 'GI REDUSER TEE 1 X 3/4', '7307', 39.19, 65, NULL, '', NULL, 9, 0, '2018-12-29 16:27:27', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(317, '1', 'JJ33', 'GI PLUG 1/2 INC', '7307', 1.48, 5, NULL, '', NULL, 10, 0, '2018-12-29 16:27:27', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(318, '1', 'JJ34', 'GI PLUG 3/4 INC', '7307', 2.25, 10, NULL, '', NULL, 10, 0, '2018-12-29 16:27:27', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(319, '1', 'JJ35', 'GI PLUG 1 1/2 INC', '7307', 8.05, 20, NULL, '', NULL, 6, 0, '2018-12-29 16:27:27', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(320, '1', 'KMT01', 'EWC S TRAP PARRYWARE ULTRA W', '6910', 971.19, 1850, NULL, '', NULL, 6, 0, '2018-12-29 17:17:18', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(321, '1', 'KMT02', 'EWC P TRAP PARRYWARE ULTRA W', '6910', 971.19, 1850, NULL, '', NULL, 6, 0, '2018-12-29 17:17:19', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(322, '1', 'KMT03', 'ORISSA PAN PARRYWARE', '6910', 1064.41, 1550, NULL, '', NULL, 9, 0, '2018-12-29 17:17:19', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(323, '1', 'KMT04', 'P TRAP PARRYWARE', '6910', 205.08, 350, NULL, '', NULL, 9, 0, '2018-12-29 17:17:19', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(324, '1', 'KMT05', 'WASH BASIN 18 INC PARRYWARE', '6910', 770.34, 950, NULL, '', NULL, 9, 0, '2018-12-29 17:17:19', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(325, '1', 'KMT06', 'WASH BASIN 20 INC PARRYWARE', '6910', 798.31, 1050, NULL, '', NULL, 9, 0, '2018-12-29 17:17:19', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(326, '1', 'KMT07', 'WASH BASIN WALL HUNG JOY PARRYWARE', '6910', 638.14, 950, NULL, '', NULL, 2, 0, '2018-12-29 17:34:48', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(327, '1', 'KMT08', 'WASH BASIN HALF PEDESTAL JOY PARRYWARE', '6910', 638.14, 950, NULL, '', NULL, 2, 0, '2018-12-29 17:34:49', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(328, '1', 'KMT09', 'WASH BASIN CASCADE PARRYWARE', '6910', 1794.07, 2400, NULL, '', NULL, 2, 0, '2018-12-29 17:34:49', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(329, '1', 'KMT10', 'FLUSH TANK SLIM PARRYWARE', '3922', 645.76, 950, NULL, '', NULL, 12, 0, '2018-12-29 17:34:49', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(330, '1', 'KMT11', 'SEAT COVER ULTRA W PARRYWARE', '3922', 310.17, 550, NULL, '', NULL, 12, 0, '2018-12-29 17:34:49', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(331, '1', 'KMT12', 'ORISSA PAN SONICA ', '6910', 491.53, 850, NULL, '', NULL, 6, 0, '2018-12-29 17:34:49', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(332, '1', 'KMT13', 'P TRAP SONICA', '6910', 76.27, 200, NULL, '', NULL, 6, 0, '2018-12-29 17:34:49', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(333, '1', 'KMT14', 'EWC SUIT 908 BATHROB 220 MM', '6910', 5000, 7500, NULL, '', NULL, 1, 0, '2018-12-29 17:34:49', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(334, '1', 'KMT15', 'EWC SUIT 803 BATHROB 200 MM', '6910', 4915, 7000, NULL, '', NULL, 1, 0, '2018-12-29 17:34:49', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(335, '1', 'JVA01', 'SINK COCK WALL ABS', '3917', 158.47, 285, NULL, '', NULL, 4, 0, '2018-12-29 17:44:08', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(336, '1', 'JVA02', 'SINK COCK TABLE ABS', '3917', 158.47, 285, NULL, '', NULL, 3, 0, '2018-12-29 17:44:08', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(337, '1', 'JVA03', 'RACK BOLT SS', '7318', 211.86, 350, NULL, '', NULL, 6, 0, '2018-12-29 17:44:08', 4, 'Nos.', '0', NULL, NULL, '2018-12-29');
INSERT INTO `us_products` (`pr_productid`, `user_id`, `pr_productcode`, `pr_productname`, `pr_hsn`, `pr_purchaseprice`, `pr_saleprice`, `pr_retail`, `pr_wholesale`, `pr_description`, `pr_stock`, `pr_isactive`, `pr_updateddate`, `pr_type`, `pr_unit`, `pr_pecentage`, `pr_purchasepriced`, `finyear`, `pr_date`) VALUES
(338, '1', 'JVA04', 'HOSE TAP ABS', '3917', 61.01, 150, NULL, '', NULL, 10, 0, '2018-12-29 17:44:08', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(339, '1', 'JVA05', 'LONG BODY ABS', '3917', 55.08, 130, NULL, '', NULL, 30, 0, '2018-12-29 17:44:08', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(340, '1', 'JVA06', 'ANGLE VALVE ABS', '3917', 50.84, 90, NULL, '', NULL, 24, 0, '2018-12-29 17:44:08', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(341, '1', 'JVA07', 'SHORT BODY ABS', '3917', 50.84, 90, NULL, '', NULL, 24, 0, '2018-12-29 17:44:08', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(342, '1', 'JVA08', 'RACK BOLT SS 10 MM', '7318', 50.84, 90, NULL, '', NULL, 12, 0, '2018-12-29 17:59:59', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(343, '1', 'JVA09', 'RACK BOLT MS 10 MM', '7318', 33.89, 70, NULL, '', NULL, 12, 0, '2018-12-29 17:59:59', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(344, '1', 'JVA10', 'GARDEN HOSE 1/2 INC BRAIDED', '3917', 11.3, 16, '16', '', NULL, 90, 0, '2018-12-29 17:59:59', 4, 'M', '0', NULL, NULL, '2018-12-29'),
(345, '1', 'JVA11', 'GARDEN HOSE 1/2 INC ZEBRA', '3917', 11.86, 18, '18', '', NULL, 150, 0, '2018-12-29 17:59:59', 4, 'M', '0', NULL, NULL, '2018-12-29'),
(346, '1', 'JVA12', 'TUFFLON', '3919', 7.21, 15, '15', '', NULL, 300, 0, '2018-12-29 17:59:59', 4, 'M', '0', NULL, NULL, '2018-12-29'),
(347, '1', 'JVA13', 'GARDEN HOSE 3/4 INC BRAIDED', '3917', 18.36, 32, NULL, '', NULL, 30, 0, '2018-12-29 17:59:59', 4, 'M', '0', NULL, NULL, '2018-12-29'),
(348, '1', 'JVA14', 'PILLAR COCK ABS', '3917', 103.38, 250, NULL, '', NULL, 10, 0, '2018-12-29 17:59:59', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(349, '1', 'JVA15', 'HEALTH FAUCET ABS', '8481', 101.69, 280, NULL, '', NULL, 5, 0, '2018-12-29 17:59:59', 4, 'Nos.', '0', NULL, NULL, '2018-12-29'),
(350, '1', 'VG01', '1.0 SQ WIRE VGUARD', '8544', 579.15, 710, '710', '', NULL, 50, 0, '2018-12-30 18:32:49', 4, 'Nos.', '0', NULL, NULL, '2018-12-30'),
(351, '1', 'VG02', '1.50 SQ WIRE VGUARD', '8544', 868.79, 970, '970', '', NULL, 25, 0, '2018-12-30 18:32:49', 4, 'Nos.', '0', NULL, NULL, '2018-12-30'),
(352, '1', 'VG03', '2.50 SQ WIRE VGUARD', '8544', 1393.43, 1605, '1605', '', NULL, 18, 0, '2018-12-30 18:32:49', 4, 'Nos.', '0', NULL, NULL, '2018-12-30'),
(353, '1', 'VG04', '4.0 SQ WIRE VGUARD', '8544', 2049.3, 2618, '2618', '', NULL, 9, 0, '2018-12-30 18:32:49', 4, 'Nos.', '0', NULL, NULL, '2018-12-30'),
(354, '1', 'VG05', '6.0 SQ WIRE VGUARD', '8544', 3093.75, 3850, '3850', '', NULL, 1, 0, '2018-12-30 18:32:49', 4, 'Nos.', '0', NULL, NULL, '2018-12-30'),
(355, '1', 'VG06', '1.0 SQ WIRE  VGUARD LOOSE', '8544', 6.435, 10, '10', '', NULL, 900, 0, '2018-12-30 18:52:56', 4, 'M', '0', NULL, NULL, '2018-12-30'),
(356, '1', 'VG07', '1.50 SQ WIRE VGUARD LOOSE', '8544', 9.65, 14, '14', '', NULL, 450, 0, '2018-12-30 18:52:56', 4, 'M', '0', NULL, NULL, '2018-12-30'),
(357, '1', 'VG08', '2.5 SQ WIRE VGUARD LOOSE', '8544', 15.48, 22, '22', '', NULL, 270, 0, '2018-12-30 18:52:56', 4, 'M', '0', NULL, NULL, '2018-12-30'),
(358, '1', 'VG09', '4.0 SQ WIRE VGUARD LOOSE', '8544', 22.77, 30, '30', '', NULL, 90, 0, '2018-12-30 18:52:57', 4, 'M', '0', NULL, NULL, '2018-12-30'),
(359, '1', 'VG10', '6.0 SQ WIRE VGUARD LOOSE', '8544', 34.375, 45, '45', '', NULL, 180, 0, '2018-12-30 18:52:57', 4, 'M', '0', NULL, NULL, '2018-12-30'),
(360, '1', 'GM001', '2 WAY SWITCH GLSY', '8536', 59.85, 88, '88', '', NULL, 100, 0, '2018-12-30 20:12:37', 4, 'Piece', '0', NULL, NULL, '2018-12-30'),
(361, '1', 'GM002', '2 WAY SWITCH MEGA GLSY', '8536', 86.63, 128, '128', '', NULL, 10, 0, '2018-12-30 20:12:37', 4, 'Piece', '0', NULL, NULL, '2018-12-30'),
(362, '1', 'GM003', '20 A 1 WAY SWITCH GLSY', '8536', 93.45, 135, '135', '', NULL, 40, 0, '2018-12-30 20:12:37', 4, 'Piece', '0', NULL, NULL, '2018-12-30'),
(363, '1', 'GM004', '20 A 2 WAY SWITCH MEGA GLSY', '8536', 93.45, 138, '138', '', NULL, 20, 0, '2018-12-30 20:12:37', 4, 'Piece', '0', NULL, NULL, '2018-12-30'),
(364, '1', 'GM005', 'SOCKET GLSY', '8536', 63, 93, '93', '', NULL, 100, 0, '2018-12-30 20:12:37', 4, 'Piece', '0', NULL, NULL, '2018-12-30'),
(365, '1', 'GM006', 'SOCKET 16 A GLSY', '8536', 113.93, 168, '168', '', NULL, 40, 0, '2018-12-30 20:12:37', 4, 'Piece', '0', NULL, NULL, '2018-12-30'),
(366, '1', 'GM007', 'INTERNATIONAL SOCKET GLSY', '8536', 102.9, 152, '152', '', NULL, 40, 0, '2018-12-30 20:12:37', 4, 'Piece', '0', NULL, NULL, '2018-12-30'),
(367, '1', 'GM008', '2 PIN SOCKET GLSY', '8536', 56.7, 84, '84', '', NULL, 20, 0, '2018-12-30 20:12:37', 4, 'Piece', '0', NULL, NULL, '2018-12-30'),
(368, '1', 'GM009', 'BELL PUSH  GLSY', '8536', 74.03, 110, '110', '', NULL, 20, 0, '2018-12-30 20:12:38', 4, 'Piece', '0', NULL, NULL, '2018-12-30'),
(369, '1', 'GM010', 'INDICATOR GLSY', '8536', 59.85, 90, '90', '', NULL, 20, 0, '2018-12-30 20:12:38', 4, 'Piece', '0', NULL, NULL, '2018-12-30'),
(370, '1', 'GM011', 'BELL PUSH MEGA GLSY', '8536', 96.08, 143, '143', '', NULL, 20, 0, '2018-12-30 20:12:38', 4, 'Piece', '0', NULL, NULL, '2018-12-30'),
(371, '1', 'GM012', 'TV SOCKET GLSY', '8536', 68.25, 105, '105', '', NULL, 20, 0, '2018-12-30 20:12:38', 4, 'Piece', '0', NULL, NULL, '2018-12-30'),
(372, '1', 'GM013', 'TELEPHONE SOCKET GLSY', '8536', 65.1, 96, '96', '', NULL, 20, 0, '2018-12-30 20:12:38', 4, 'Piece', '0', NULL, NULL, '2018-12-30'),
(373, '1', 'GM014', 'BLANK PLATE GLSY', '8538', 14.18, 20, '20', '', NULL, 100, 0, '2018-12-30 20:12:38', 4, 'Piece', '0', NULL, NULL, '2018-12-30'),
(374, '1', 'GM015', 'REGULATOR 4 STEP GLSY', '8414', 212.63, 315, '315', '', NULL, 10, 0, '2018-12-30 20:12:38', 4, 'Piece', '0', NULL, NULL, '2018-12-30'),
(375, '1', 'GM016', 'REGULATOR 5 STEP GLSY', '8414', 228.38, 340, '340', '', NULL, 20, 0, '2018-12-30 20:12:38', 4, 'Piece', '0', NULL, NULL, '2018-12-30'),
(376, '1', 'GM017', 'DP SWITCH GLSY', '8536', 164.33, 245, '245', '', NULL, 10, 0, '2018-12-30 20:12:38', 4, 'Piece', '0', NULL, NULL, '2018-12-30'),
(377, '1', 'GM018', 'FOOD LAMP 4M GLSY', '9405', 351.75, 520, '520', '', NULL, 10, 0, '2018-12-30 20:12:38', 4, 'Piece', '0', NULL, NULL, '2018-12-30'),
(378, '1', 'GM019', '1M PLATE CASAVIVA ', '8538', 43.05, 65, '65', '', NULL, 40, 0, '2018-12-30 20:12:38', 4, 'Piece', '0', NULL, NULL, '2018-12-30'),
(379, '1', 'GM020', '2M PLATE CASAVIVA  ', '8538', 43.05, 65, '65', '', NULL, 40, 0, '2018-12-30 20:12:38', 4, 'Piece', '0', NULL, NULL, '2018-12-30'),
(380, '1', 'GM021', '3M  PLATE CASAVIVA ', '8538', 54.08, 80, '80', '', NULL, 20, 0, '2018-12-30 20:12:38', 4, 'Piece', '0', NULL, NULL, '2018-12-30'),
(381, '1', 'GM022', '4M PLATE CASAVIVA', '8538', 65.63, 98, '98', '', NULL, 20, 0, '2018-12-30 20:12:38', 4, 'Piece', '0', NULL, NULL, '2018-12-30'),
(382, '1', 'GM023', '6M PLATE CASAVIVA', '8538', 89.78, 135, '135', '', NULL, 20, 0, '2018-12-30 20:12:38', 1, 'Piece', '0', NULL, NULL, '2018-12-30'),
(383, '1', 'GM024', '8M PLATE CASAVIVA', '8538', 126.53, 190, '190', '', NULL, 20, 0, '2018-12-30 20:12:38', 1, 'Piece', '0', NULL, NULL, '2018-12-30'),
(384, '1', 'GM025', '12M PLATE CASSAVIVA', '8538', 136.5, 210, '210', '', NULL, 0, 0, '2018-12-30 20:12:38', 1, 'Piece', '0', NULL, NULL, '2018-12-30'),
(385, '1', 'GM026', '16M PALTE CASSAVIVA', '8538', 148.05, 220, '220', '', NULL, 0, 0, '2018-12-30 20:52:08', 4, 'Piece', '0', NULL, NULL, '2018-12-30'),
(386, '1', 'GM027', '18M PLATE CASSAVIVA', '8538', 177.45, 265, '265', '', NULL, 0, 0, '2018-12-30 20:52:08', 4, 'Piece', '0', NULL, NULL, '2018-12-30'),
(387, '1', 'GM028', '1M INNER PLATE NATURALZ ', '8538', 25.73, 40, '40', '', NULL, 0, 0, '2018-12-30 20:52:08', 4, 'Piece', '0', NULL, NULL, '2018-12-30'),
(388, '1', 'GM029', '2M  INNER PLATE NATURALZ', '8538', 25.73, 40, '40', '', NULL, 0, 0, '2018-12-30 20:52:08', 4, 'Piece', '0', NULL, NULL, '2018-12-30'),
(389, '1', 'GM030', '3M INNER PLATE NATURALZ', '8538', 30.98, 45, '45', '', NULL, 0, 0, '2018-12-30 20:52:09', 4, 'Piece', '0', NULL, NULL, '2018-12-30'),
(390, '1', 'GM031', '1M  PLATE FOREST ', '8538', 37.8, 55, '55', '', NULL, 0, 0, '2018-12-30 20:52:09', 4, 'Piece', '0', NULL, NULL, '2018-12-30'),
(391, '1', 'GM032', '2M PLATE FOREST', '8538', 37.8, 55, '55', '', NULL, 0, 0, '2018-12-30 20:52:09', 4, 'Piece', '0', NULL, NULL, '2018-12-30'),
(392, '1', 'GM033', '3M PLATE FOREST', '8538', 48.3, 75, '75', '', NULL, 0, 0, '2018-12-30 20:52:09', 4, 'Piece', '0', NULL, NULL, '2018-12-30'),
(393, '1', 'GM034', '4M PLATE FOREST', '8538', 66.68, 105, '105', '', NULL, 0, 0, '2018-12-30 20:52:09', 4, 'Piece', '0', NULL, NULL, '2018-12-30'),
(394, '1', 'GM035', '6M PLATE FOREST', '8538', 85.58, 130, '130', '', NULL, 0, 0, '2018-12-30 20:52:09', 4, 'Piece', '0', NULL, NULL, '2018-12-30'),
(395, '1', 'GM036', '8M PLATE FOREST', '8538', 112.88, 170, '170', '', NULL, 0, 0, '2018-12-30 20:52:09', 4, 'Piece', '0', NULL, NULL, '2018-12-30'),
(396, '1', 'GM037', '10M PLATE FOREST', '8538', 128.63, 195, '195', '', NULL, 0, 0, '2018-12-30 20:52:09', 4, 'Piece', '0', NULL, NULL, '2018-12-30'),
(397, '1', 'GM038', '12M PLATE VERTICAL  FOREST', '8538', 133.88, 210, '210', '', NULL, 0, 0, '2018-12-30 20:52:09', 4, 'Piece', '0', NULL, NULL, '2018-12-30'),
(398, '1', 'GM039', '12M PLATE HORZ FOREST', '8538', 133.88, 210, '210', '', NULL, 0, 0, '2018-12-30 20:52:09', 4, 'Piece', '0', NULL, NULL, '2018-12-30'),
(399, '1', 'GM040', '1WAY SWITCH G MAGIC', '8536', 10.5, 15, '15', '', NULL, 0, 0, '2018-12-30 20:52:09', 4, 'Piece', '0', NULL, NULL, '2018-12-30'),
(400, '1', 'GM041', '2WAY SWITCH G MAGIC', '8536', 18.9, 30, '30', '', NULL, 0, 0, '2018-12-30 20:52:09', 4, 'Piece', '0', NULL, NULL, '2018-12-30'),
(401, '1', 'GM042', 'SOCKET G MAGIC', '8536', 23.1, 35, '35', '', NULL, 0, 0, '2018-12-30 20:52:09', 4, 'Piece', '0', NULL, NULL, '2018-12-30'),
(402, '1', 'GM043', 'SOCKET 2PIN G MAGIC', '8536', 21.53, 35, '35', '', NULL, 0, 0, '2018-12-30 20:52:09', 4, 'Piece', '0', NULL, NULL, '2018-12-30'),
(403, '1', 'GM044', ' REGULATOR G MAGIC', '8414', 157.5, 230, '230', '', NULL, 0, 0, '2018-12-30 20:52:09', 4, 'Piece', '0', NULL, NULL, '2018-12-30'),
(404, '1', 'GM045', 'DP SWITCH G MAGIC', '8536', 111.83, 165, '165', '', NULL, 0, 0, '2018-12-30 20:52:09', 4, 'Piece', '0', NULL, NULL, '2018-12-30'),
(405, '1', 'GM046', '3PIN TOP 6A GM', '8536', 36.6, 60, '60', '', NULL, 0, 0, '2018-12-30 20:52:09', 4, 'Piece', '0', NULL, NULL, '2018-12-30'),
(406, '1', 'GM047', '3PIN TOP 16A GM', '8536', 42, 70, '70', '', NULL, 0, 0, '2018-12-30 20:52:09', 4, 'Piece', '0', NULL, NULL, '2018-12-30'),
(407, '1', 'GM048', 'ANGLE HOLDER SHEET TYPE GM', '8536', 37.8, 60, '60', '', NULL, 0, 0, '2018-12-30 20:52:09', 4, 'Piece', '0', NULL, NULL, '2018-12-30'),
(408, '1', 'GM049', 'CEILING ROSE GM', '8536', 28.88, 50, '50', '', NULL, 0, 0, '2018-12-30 20:52:09', 4, 'Piece', '0', NULL, NULL, '2018-12-30'),
(409, '1', 'GM050', '2PIN PLUG GM', '8536', 13.13, 20, '20', '', NULL, 0, 0, '2018-12-30 20:52:09', 4, 'Piece', '0', NULL, NULL, '2018-12-30'),
(410, '1', 'GM051', 'MALE AND FEMALE GM', '8536', 22.05, 30, '30', '', NULL, 0, 0, '2018-12-30 20:52:09', 4, 'Piece', '0', NULL, NULL, '2018-12-30'),
(411, '1', 'GM052', 'STRAIGHT HOLDER GM', '8536', 22.58, 35, '35', '', NULL, 0, 0, '2018-12-30 20:52:09', 4, 'Piece', '0', NULL, NULL, '2018-12-30'),
(412, '1', 'GM053', 'PENDANT HOLDER GM ', '8536', 20.48, 30, '30', '', NULL, 0, 0, '2018-12-30 20:52:09', 4, 'Piece', '0', NULL, NULL, '2018-12-30'),
(413, '1', 'GM054', 'ADAPTOR GM', '8536', 14.7, 25, '25', '', NULL, 0, 0, '2018-12-30 20:52:09', 4, 'Piece', '0', NULL, NULL, '2018-12-30'),
(414, '1', 'GM055', 'DP SWITCH OPEN GM', '8536', 97.13, 150, '150', '', NULL, 0, 0, '2018-12-30 20:52:09', 4, 'Piece', '0', NULL, NULL, '2018-12-30'),
(415, '1', 'GM056', 'S S COMBINED GM ', '8536', 51.98, 80, '80', '', NULL, 0, 0, '2018-12-30 21:34:35', 4, 'Piece', '0', NULL, NULL, '2018-12-30'),
(416, '1', 'GM057', 'POWER PLUG WITH BOX GM', '8536', 138.08, 210, '210', '', NULL, 0, 0, '2018-12-30 21:34:35', 4, 'Piece', '0', NULL, NULL, '2018-12-30'),
(417, '1', 'GM058', 'DP SWITCH  OPEN GM', '8536', 99.23, 150, '150', '', NULL, 0, 0, '2018-12-30 21:34:35', 4, 'Piece', '0', NULL, NULL, '2018-12-30'),
(418, '1', 'GM059', 'PLAIN SHEET 4 1/2 * 4 1/2 GM', '8538', 19.95, 30, '30', '', NULL, 0, 0, '2018-12-30 21:34:35', 4, 'Piece', '0', NULL, NULL, '2018-12-30'),
(419, '1', 'GM060', 'PLAIN SHEET 4 1/2 *6 1/2 GM', '8538', 26.78, 45, '45', '', NULL, 0, 0, '2018-12-30 21:34:35', 4, 'Piece', '0', NULL, NULL, '2018-12-30'),
(420, '1', 'GM061', 'PLAIN SHEET 4 1/2 * 8.5 GM', '8538', 37.8, 60, '60', '', NULL, 0, 0, '2018-12-30 21:34:35', 4, 'Piece', '0', NULL, NULL, '2018-12-30'),
(421, '1', 'GM062', 'PLAIN SHEET 41/2 * 10.5 GM', '8538', 52.5, 80, '80', '', NULL, 0, 0, '2018-12-30 21:34:35', 4, 'Piece', '0', NULL, NULL, '2018-12-30'),
(422, '1', 'GM063', 'PLAIN SHEET 41/2 * 12.5 GM', '8538', 55.65, 85, '85', '', NULL, 0, 0, '2018-12-30 21:34:35', 4, 'Piece', '0', NULL, NULL, '2018-12-30'),
(423, '1', 'GM064', 'PLAIN SHEET 6.5 * 8.5 GM', '8538', 64.58, 95, '95', '', NULL, 0, 0, '2018-12-30 21:34:35', 4, 'Piece', '0', NULL, NULL, '2018-12-30'),
(424, '1', 'GM065', 'PLAIN SHEET 8.5 * 10.5 GM', '8538', 100.28, 150, '150', '', NULL, 0, 0, '2018-12-30 21:34:35', 4, 'Piece', '0', NULL, NULL, '2018-12-30'),
(425, '1', 'GM066', 'PLAIN SHEET 8.5 *12.5 GM', '8538', 105, 160, '160', '', NULL, 0, 0, '2018-12-30 21:34:35', 4, 'Piece', '0', NULL, NULL, '2018-12-30'),
(426, '1', 'GM067', 'DING DONG BELL STRIO GM', '8531', 95.55, 150, '150', '', NULL, 0, 0, '2018-12-30 21:34:35', 4, 'Piece', '0', NULL, NULL, '2018-12-30'),
(427, '1', 'GM068', 'DING DONG BILL RADIUS GM', '8531', 85.05, 140, '140', '', NULL, 0, 0, '2018-12-30 21:34:35', 4, 'Piece', '0', NULL, NULL, '2018-12-30'),
(428, '1', 'GM069', 'FLEX BOX 2 PIN 5 MTR GM', '8537', 162.75, 280, '280', '', NULL, 0, 0, '2018-12-30 21:34:35', 4, 'Piece', '0', NULL, NULL, '2018-12-30'),
(429, '1', 'GM070', 'FLEX BOX 3 PIN 4 MTR GM', '8537', 223.13, 380, '380', '', NULL, 0, 0, '2018-12-30 21:49:40', 4, 'Piece', '0', NULL, NULL, '2018-12-30'),
(430, '1', 'GM071', 'SPIKE 4+1 GM', '8537', 250.43, 450, '450', '', NULL, 0, 0, '2018-12-30 21:49:40', 4, 'Piece', '0', NULL, NULL, '2018-12-30'),
(431, '1', 'GM072', 'METAL BOX 2M GM', '8538', 26.78, 40, '40', '', NULL, 0, 0, '2018-12-30 21:49:41', 4, 'Piece', '0', NULL, NULL, '2018-12-30'),
(432, '1', 'GM073', 'METAL BOX 3M GM', '8538', 36.23, 55, '55', '', NULL, 0, 0, '2018-12-30 21:49:41', 4, 'Piece', '0', NULL, NULL, '2018-12-30'),
(433, '1', 'GM074', 'METAL BOX 4M GM', '8538', 45.68, 70, '70', '', NULL, 0, 0, '2018-12-30 21:49:41', 4, 'Piece', '0', NULL, NULL, '2018-12-30'),
(434, '1', 'GM075', 'METAL BOX 6M GM', '8538', 56.18, 85, '85', '', NULL, 0, 0, '2018-12-30 21:49:41', 4, 'Piece', '0', NULL, NULL, '2018-12-30'),
(435, '1', 'GM076', 'METAL BOX 8M GM', '8538', 73.5, 110, '110', '', NULL, 0, 0, '2018-12-30 21:49:41', 4, 'Piece', '0', NULL, NULL, '2018-12-30'),
(436, '1', 'GM077', 'METAL BOX 12M GM', '8538', 93.98, 140, '140', '', NULL, 0, 0, '2018-12-30 21:49:41', 4, 'Piece', '0', NULL, NULL, '2018-12-30'),
(437, '1', 'GM078', 'METAL BOX 18M GM', '8538', 136.5, 210, '210', '', NULL, 0, 0, '2018-12-30 21:49:41', 4, 'Piece', '0', NULL, NULL, '2018-12-30'),
(438, '1', 'GM079', '1 WAY SWITCH GLSY', '8536', 23.75, 30, '30', '', NULL, 0, 0, '2018-12-30 21:49:41', 4, 'Piece', '0', NULL, NULL, '2018-12-30'),
(439, '1', 'GM080', 'TUBE LIGHT GM', '9405', 201, 280, '280', '', NULL, 0, 0, '2018-12-30 21:49:41', 4, 'Piece', '0', NULL, NULL, '2018-12-30'),
(440, '1', 'GM081', 'LED BULB 9 W GM', '8539', 64, 100, '100', '', NULL, 0, 0, '2018-12-30 21:49:41', 4, 'Piece', '0', NULL, NULL, '2018-12-30'),
(441, '1', 'KSL04', 'CASING CAP 1 1/4 INC', '3916', 57.42, 75, '75', '', NULL, 50, 0, '2018-12-31 13:29:36', 4, 'Nos.', '0', NULL, NULL, '2018-12-31'),
(442, '1', 'LKR01', 'LED LUKER 9 W COMBO', '8539', 133.92, 175, NULL, '', NULL, 26, 0, '2019-01-01 13:43:29', 3, 'Nos.', '', NULL, NULL, '2019-01-01'),
(443, '1', 'VTX01', 'MAIN SWITCH 16/240', '8536', 456.78, 650, NULL, '', NULL, 5, 0, '2019-01-01 14:17:42', 4, 'Nos.', '0', NULL, NULL, '2019-01-01'),
(444, '1', 'VTX02', 'MAIN SWITCH 32/240', '8536', 639.83, 950, NULL, '', NULL, 3, 0, '2019-01-01 14:17:42', 4, 'Nos.', '0', NULL, NULL, '2019-01-01'),
(445, '1', 'VTX03', 'FUSE 16/240', '8536', 32.2, 50, NULL, '', NULL, 24, 0, '2019-01-01 14:17:42', 4, 'Nos.', '0', NULL, NULL, '2019-01-01'),
(446, '1', 'VTX04', 'FUSE 16/415', '8536', 78.81, 140, NULL, '', NULL, 12, 0, '2019-01-01 14:17:42', 4, 'Nos.', '0', NULL, NULL, '2019-01-01'),
(447, '1', 'VTX05', 'FUSE 32/415', '8536', 111.02, 190, NULL, '', NULL, 12, 0, '2019-01-01 14:17:42', 4, 'Nos.', '0', NULL, NULL, '2019-01-01'),
(448, '1', 'VTX06', 'EXHAUST FAN KHAITAN 230 MM FRESH AIR', '8414', 889.83, 1250, NULL, '', NULL, 1, 0, '2019-01-01 14:17:42', 4, 'Nos.', '0', NULL, NULL, '2019-01-01'),
(449, '1', 'VTX07', 'EXHAUST FAN KHAITAN 150 MM VENTO', '8414', 805.08, 1200, NULL, '', NULL, 2, 0, '2019-01-01 14:17:42', 4, 'Nos.', '0', NULL, NULL, '2019-01-01'),
(450, '1', 'VTX08', 'EXHAUST FAN KHAITAN 150 MM POLO', '8414', 762.71, 1100, NULL, '', NULL, 1, 0, '2019-01-01 14:17:42', 4, 'Nos.', '0', NULL, NULL, '2019-01-01'),
(451, '1', 'VTX09', 'EXHAUST FAN KHAITAN 100 MM FRESH AIR', '8414', 720.34, 1050, NULL, '', NULL, 1, 0, '2019-01-01 14:17:42', 4, 'Nos.', '0', NULL, NULL, '2019-01-01'),
(452, '1', 'VTX10', 'EXHAUST FAN KHAITAN 300 MM METAL', '8414', 974.58, 1350, NULL, '', NULL, 1, 0, '2019-01-01 14:17:42', 4, 'Nos.', '0', NULL, NULL, '2019-01-01'),
(453, '1', 'VTX11', 'PEDESTAL FAN KHAITAN FLORA', '8414', 1652.54, 2350, NULL, '', NULL, 1, 0, '2019-01-01 14:17:42', 4, 'Nos.', '0', NULL, NULL, '2019-01-01'),
(454, '1', 'VTX12', 'WALL FAN KHAITAN MERLIN', '8414', 1440.68, 2000, NULL, '', NULL, 1, 0, '2019-01-01 14:17:42', 4, 'Nos.', '0', NULL, NULL, '2019-01-01'),
(455, '1', 'VTX13', 'TABLE FAN 16 INC KHAITAN HIGH SPEED', '8414', 1398.31, 1950, NULL, '', NULL, 1, 0, '2019-01-01 14:17:42', 4, 'Nos.', '0', NULL, NULL, '2019-01-01'),
(456, '1', 'VTX14', 'CEILING FAN EURO HIGH SPEED KHAITAN', '8414', 1038.14, 2750, NULL, '', NULL, 2, 0, '2019-01-01 14:17:42', 4, 'Nos.', '0', NULL, NULL, '2019-01-01'),
(457, '1', 'VTX15', 'CEILING FAN EURO DLX 1200 MM KHAITAN', '8414', 1122.88, 2950, NULL, '', NULL, 2, 0, '2019-01-01 14:17:42', 4, 'Nos.', '0', NULL, NULL, '2019-01-01'),
(458, '1', 'VTX16', 'CEILING FAN ADORE METALIC KHAITAN', '8414', 1737.29, 2250, NULL, '', NULL, 2, 0, '2019-01-01 14:17:42', 4, 'Nos.', '0', NULL, NULL, '2019-01-01'),
(459, '1', 'VTX17', 'IRON BOX NOVA', '8516', 317.8, 600, NULL, '', NULL, 2, 0, '2019-01-01 14:17:42', 4, 'Nos.', '0', NULL, NULL, '2019-01-01'),
(460, '1', 'STR187', 'SADDLE 1 1/2 X 3/4', '3917', 70.7, 120, NULL, '', NULL, 0, 0, '2019-01-01 16:00:31', 4, 'Nos.', '0', NULL, NULL, '2019-01-01'),
(461, '1', 'KMT16', 'SUIT EDEN PARRYWARE', '6910', 6089.83, 9200, NULL, '', NULL, 0, 0, '2019-01-02 11:58:48', 4, 'Piece', '0', NULL, NULL, '2019-01-02'),
(462, '1', 'KMT17', 'EWC WALL HANGING ULTRA WHITE PARRYWARE', '6910', 2992.37, 4250, NULL, '', NULL, 0, 0, '2019-01-02 11:58:49', 4, 'Piece', '0', NULL, NULL, '2019-01-02'),
(463, '1', 'KMT18', 'EWC WALL HANGING SEAT COVER ULTRA WHITE PARRYWARE', '6910', 818.64, 1250, NULL, '', NULL, 0, 0, '2019-01-02 11:58:49', 4, 'Piece', '0', NULL, NULL, '2019-01-02'),
(464, '1', 'KMT19', 'SUIT WALL HANGING VERVE PARRYWARE', '6910', 9103.39, 13500, NULL, '', NULL, 0, 0, '2019-01-02 11:58:49', 4, 'Piece', '0', NULL, NULL, '2019-01-02'),
(465, '1', 'KMT20', 'SUIT WALL HANGING CUITE PARRYWARE', '6910', 5510.17, 8000, NULL, '', NULL, 0, 0, '2019-01-02 11:58:49', 4, 'Piece', '0', NULL, NULL, '2019-01-02'),
(466, '1', 'KMT21', 'KITCHEN SINK 18 X 16 METRO', '7324', 1007.63, 1500, NULL, '', NULL, 0, 0, '2019-01-02 11:58:49', 4, 'Piece', '0', NULL, NULL, '2019-01-02'),
(467, '1', 'KMT22', 'KITCHEN SINK 20 X 17 METRO', '7324', 1098.31, 1600, NULL, '', NULL, 0, 0, '2019-01-02 11:58:49', 4, 'Piece', '0', NULL, NULL, '2019-01-02'),
(468, '1', 'KMT23', 'KITCHEN SINK 24 X 18 METRO', '7324', 1250.85, 1900, NULL, '', NULL, 0, 0, '2019-01-02 11:58:49', 4, 'Piece', '0', NULL, NULL, '2019-01-02'),
(469, '1', 'SPK01', '4 X 4 PVC BOX', '8638', 8, 15, NULL, '', NULL, 0, 1, '2019-01-02 12:53:41', 4, 'Piece', '0', NULL, NULL, '2019-01-02'),
(470, '1', 'SPK02', '6 X 4 PVC BOX', '8638', 9.5, 20, NULL, '', NULL, 0, 1, '2019-01-02 12:53:41', 4, 'Piece', '0', NULL, NULL, '2019-01-02'),
(471, '1', 'SPK03', 'TEE 19 MM', '3917', 1.4, 3, NULL, '', NULL, 0, 1, '2019-01-02 12:53:41', 4, 'Piece', '0', NULL, NULL, '2019-01-02'),
(472, '1', 'SPK04', 'ELBOW 19 MM', '3917', 1.35, 3, NULL, '', NULL, 0, 1, '2019-01-02 12:53:41', 4, 'Piece', '0', NULL, NULL, '2019-01-02'),
(473, '1', 'SPK05', 'ELBOW 20 MM', '3917', 1.45, 4, NULL, '', NULL, 0, 1, '2019-01-02 12:53:41', 4, 'Piece', '0', NULL, NULL, '2019-01-02'),
(474, '1', 'SPK06', 'TEE 20 MM', '3917', 1.5, 4, NULL, '', NULL, 0, 1, '2019-01-02 12:53:41', 4, 'Piece', '0', NULL, NULL, '2019-01-02'),
(475, '1', 'SPK07', 'ELBOW 25 MM', '3917', 3.4, 6, NULL, '', NULL, 0, 1, '2019-01-02 12:53:41', 4, 'Piece', '0', NULL, NULL, '2019-01-02'),
(476, '1', 'SPK08', 'TEE 25 MM', '3917', 3.55, 6, NULL, '', NULL, 0, 1, '2019-01-02 12:53:41', 4, 'Piece', '0', NULL, NULL, '2019-01-02'),
(477, '1', 'CLR001', '1 WAY SWITCH VOUGE', '8536', 15.61, 20, NULL, '', NULL, 0, 0, '2019-01-02 16:14:57', 4, 'Piece', '0', NULL, NULL, '2019-01-02'),
(478, '1', 'CLR002', '2 WAY SWITCH VOUGE', '8536', 79, 60, NULL, '', NULL, 0, 0, '2019-01-02 16:14:57', 4, 'Piece', '0', NULL, NULL, '2019-01-02'),
(479, '1', 'CLR003', 'INDICATOR VOUGE', '8536', 100, 80, NULL, '', NULL, 0, 0, '2019-01-02 16:14:57', 4, 'Piece', '0', NULL, NULL, '2019-01-02'),
(480, '1', 'CLR004', '2 WAY 16 A SWITCH VOUGE', '8536', 110, 90, NULL, '', NULL, 0, 0, '2019-01-02 16:14:57', 4, 'Piece', '0', NULL, NULL, '2019-01-02'),
(481, '1', 'CLR005', '16 A 1 WAY SWITCH VOUGE', '8536', 117, 95, NULL, '', NULL, 0, 0, '2019-01-02 16:14:57', 4, 'Piece', '0', NULL, NULL, '2019-01-02'),
(482, '1', 'CLR006', '2 WAY SWITCH MEGA VOUGE', '8536', 129, 110, NULL, '', NULL, 0, 0, '2019-01-02 16:14:57', 4, 'Piece', '0', NULL, NULL, '2019-01-02'),
(483, '1', 'CLR007', 'BELL PUSH MEGA VOUGE', '8536', 140, 100, NULL, '', NULL, 0, 0, '2019-01-02 16:14:57', 4, 'Piece', '0', NULL, NULL, '2019-01-02'),
(484, '1', 'CLR008', '32 A D P SWITCH VOUGE', '8536', 240, 180, NULL, '', NULL, 0, 0, '2019-01-02 16:14:57', 4, 'Piece', '0', NULL, NULL, '2019-01-02'),
(485, '1', 'CLR009', '2 PIN SOCKET VOUGE', '8536', 70, 50, NULL, '', NULL, 0, 0, '2019-01-02 16:14:57', 4, 'Piece', '0', NULL, NULL, '2019-01-02'),
(486, '1', 'CLR 010', 'SOCKET VOUGE', '8536', 80, 60, NULL, '', NULL, 0, 0, '2019-01-02 16:14:57', 4, 'Piece', '0', NULL, NULL, '2019-01-02'),
(487, '1', 'CLR011', 'UNIVERSAL SOCKET VOUGE', '8536', 155, 120, NULL, '', NULL, 0, 0, '2019-01-02 16:14:57', 4, 'Piece', '0', NULL, NULL, '2019-01-02'),
(488, '1', 'CLR012', 'INTERNATIONAL SOCKET VOUGE', '8536', 185, 170, NULL, '', NULL, 0, 0, '2019-01-02 16:14:57', 4, 'Piece', '0', NULL, NULL, '2019-01-02'),
(489, '1', 'CLR013', 'REGULATOR 4 STEP VOUGE', '8414', 335, 250, NULL, '', NULL, 0, 0, '2019-01-02 16:14:57', 4, 'Piece', '0', NULL, NULL, '2019-01-02'),
(490, '1', 'CLR014', 'REGULATOR 5 STEP VOUGE', '8414', 390, 285, NULL, '', NULL, 0, 0, '2019-01-02 16:14:57', 4, 'Piece', '0', NULL, NULL, '2019-01-02'),
(491, '1', 'CLR015', 'T V SOCKET VOUGE', '8536', 94, 70, NULL, '', NULL, 0, 0, '2019-01-02 16:14:57', 4, 'Piece', '0', NULL, NULL, '2019-01-02'),
(492, '1', 'CLR016', 'TELEPHONE SOCKET VOUGE', '8536', 94, 70, NULL, '', NULL, 0, 0, '2019-01-02 16:14:57', 4, 'Piece', '0', NULL, NULL, '2019-01-02'),
(493, '1', 'CLR017', 'INDICATOR VOUGE', '8531', 78, 55, NULL, '', NULL, 0, 0, '2019-01-02 16:14:57', 4, 'Piece', '0', NULL, NULL, '2019-01-02'),
(494, '1', 'CLR018', 'BLANK PLATE VOUGE', '8538', 24, 18, NULL, '', NULL, 0, 0, '2019-01-02 16:14:57', 4, 'Piece', '0', NULL, NULL, '2019-01-02'),
(495, '1', 'CLR019', 'FOOT LAMP 2 MODI VOUGE', '9405', 220, 220, NULL, '', NULL, 0, 0, '2019-01-02 16:14:57', 4, 'Piece', '0', NULL, NULL, '2019-01-02'),
(496, '1', 'CLR020', 'FOOT LAMP 4 MODI VOUGE', '9405', 390, 390, NULL, '', NULL, 0, 0, '2019-01-02 16:14:57', 4, 'Piece', '0', NULL, NULL, '2019-01-02'),
(497, '1', 'CLR021', '1 MODI PLATE VOUGE', '8538', 58, 45, NULL, '', NULL, 0, 0, '2019-01-02 16:14:57', 4, 'Piece', '0', NULL, NULL, '2019-01-02'),
(498, '1', 'CLR022', '2 MODI PLATE VOUGE', '8538', 58, 45, NULL, '', NULL, 0, 0, '2019-01-02 16:14:57', 4, 'Piece', '0', NULL, NULL, '2019-01-02'),
(499, '1', 'CLR023', '3 MODI PLATE VOUGE', '8538', 82, 65, NULL, '', NULL, 0, 0, '2019-01-02 16:14:57', 4, 'Piece', '0', NULL, NULL, '2019-01-02'),
(500, '1', 'CLR024', '4 MODI PLATE VOUGE', '8538', 90, 80, NULL, '', NULL, 0, 0, '2019-01-02 16:14:57', 4, 'Piece', '0', NULL, NULL, '2019-01-02'),
(501, '1', 'CLR025', '6 MODI PLATE VOUGE', '8538', 134, 105, NULL, '', NULL, 0, 0, '2019-01-02 16:14:57', 4, 'Piece', '0', NULL, NULL, '2019-01-02'),
(502, '1', 'CLR026', '8 MODI PLATE VOUGE', '8538', 175, 140, NULL, '', NULL, 0, 0, '2019-01-02 16:14:57', 4, 'Piece', '0', NULL, NULL, '2019-01-02'),
(503, '1', 'CLR027', '12 MODI PLATE VOUGE', '8538', 210, 170, NULL, '', NULL, 0, 0, '2019-01-02 16:14:57', 4, 'Piece', '0', NULL, NULL, '2019-01-02'),
(504, '1', 'CLR028', '16 MODI  PLATE VOUGE', '8538', 220, 180, NULL, '', NULL, 0, 0, '2019-01-02 16:14:57', 4, 'Piece', '0', NULL, NULL, '2019-01-02'),
(505, '1', 'CLR029', '18 MODI PLATE VOUGE', '8538', 245, 195, NULL, '', NULL, 0, 0, '2019-01-02 16:14:57', 4, 'Piece', '0', NULL, NULL, '2019-01-02'),
(506, '1', 'CLR030', '1 MODI PLATE COLORS', '8538', 59, 45, NULL, '', NULL, 0, 0, '2019-01-02 16:14:57', 4, 'Piece', '0', NULL, NULL, '2019-01-02'),
(507, '1', 'CLR031', '2 MODI PLATE COLORS', '8538', 59, 45, NULL, '', NULL, 0, 0, '2019-01-02 16:14:57', 4, 'Piece', '0', NULL, NULL, '2019-01-02'),
(508, '1', 'CLR032', '3 MODI PLATE COLORS', '8538', 76, 65, NULL, '', NULL, 0, 0, '2019-01-02 16:14:57', 4, 'Piece', '0', NULL, NULL, '2019-01-02'),
(509, '1', 'CLR033', '4 MODI PLATE COLORS', '8538', 93, 85, NULL, '', NULL, 0, 0, '2019-01-02 16:14:57', 4, 'Piece', '0', NULL, NULL, '2019-01-02'),
(510, '1', 'CLR034', '6 MODI PLATE COLORS', '8538', 110, 105, NULL, '', NULL, 0, 0, '2019-01-02 16:14:57', 4, 'Piece', '0', NULL, NULL, '2019-01-02'),
(511, '1', 'CLR035', '8 MODI PLATE COLORS', '8538', 139, 115, NULL, '', NULL, 0, 0, '2019-01-02 16:14:57', 4, 'Piece', '0', NULL, NULL, '2019-01-02'),
(512, '1', 'CLR036', '10 MODI PLATE COLORS ', '8538', 153, 145, NULL, '', NULL, 0, 0, '2019-01-02 16:14:57', 4, 'Piece', '0', NULL, NULL, '2019-01-02'),
(513, '1', 'CLR037', '12 MODI PLATE COLORS', '8538', 201, 160, NULL, '', NULL, 0, 0, '2019-01-02 16:14:57', 4, 'Piece', '0', NULL, NULL, '2019-01-02'),
(514, '1', 'CLR038', '12 MODI SQ PLATE COLORS', '8538', 201, 160, NULL, '', NULL, 0, 0, '2019-01-02 16:14:57', 4, 'Piece', '0', NULL, NULL, '2019-01-02'),
(515, '1', 'CLR039', '14 MODI PLATE COLORS', '8538', 260, 210, NULL, '', NULL, 0, 0, '2019-01-02 16:14:57', 4, 'Piece', '0', NULL, NULL, '2019-01-02'),
(516, '1', 'CLR040', '16 MODI PLATE COLORS', '8538', 230, 180, NULL, '', NULL, 0, 0, '2019-01-02 16:14:57', 4, 'Piece', '0', NULL, NULL, '2019-01-02'),
(517, '1', 'CLR041', '20 MODI PLATE COLORS', '8538', 250, 210, NULL, '', NULL, 0, 0, '2019-01-02 16:14:57', 4, 'Piece', '0', NULL, NULL, '2019-01-02'),
(518, '1', 'HVL001', 'DB 6 WAY CONCEILED HAVELS', '8537', 1505, 1400, NULL, '', NULL, 0, 0, '2019-01-02 16:36:59', 4, 'Piece', '0', NULL, NULL, '2019-01-02'),
(519, '1', 'HVL002', 'DB 8 WAY CONCEILED HAVELS', '8537', 1670, 1600, NULL, '', NULL, 0, 0, '2019-01-02 16:36:59', 4, 'Piece', '0', NULL, NULL, '2019-01-02'),
(520, '1', 'HVL003', 'DB 12 WAY CONCEILED HAVELS', '8537', 2030, 1850, NULL, '', NULL, 0, 0, '2019-01-02 16:36:59', 4, 'Piece', '0', NULL, NULL, '2019-01-02'),
(521, '1', 'HVL004', 'DB 16 WAY CONCEILED HAVELS', '8537', 2700, 2500, NULL, '', NULL, 0, 0, '2019-01-02 16:36:59', 4, 'Piece', '0', NULL, NULL, '2019-01-02'),
(522, '1', 'HVL005', 'DB 3 PHASE 4 WAY HAVELS', '8537', 9915, 8500, NULL, '', NULL, 0, 0, '2019-01-02 16:36:59', 4, 'Piece', '0', NULL, NULL, '2019-01-02'),
(523, '1', 'HVL006', 'DB 3 PHASE 6 WAY HAVELS', '8537', 10035, 9000, NULL, '', NULL, 0, 0, '2019-01-02 16:36:59', 4, 'Piece', '0', NULL, NULL, '2019-01-02'),
(524, '1', 'HVL007', 'MCB 6 A HAVELS', '8536', 180, 150, '150', '', NULL, 0, 0, '2019-01-02 16:36:59', 4, 'Piece', '0', NULL, NULL, '2019-01-02'),
(525, '1', 'HVL008', 'MCB 10 A HAVELS', '8536', 180, 150, '150', '', NULL, 0, 0, '2019-01-02 16:36:59', 4, 'Piece', '0', NULL, NULL, '2019-01-02'),
(526, '1', 'HVL009', 'MCB 16 A HAVELS', '8536', 180, 150, '150', '', NULL, 0, 0, '2019-01-02 16:36:59', 4, 'Piece', '0', NULL, NULL, '2019-01-02'),
(527, '1', 'HVL010', 'MCB 20 A HAVELS', '8536', 180, 150, '150', '', NULL, 0, 0, '2019-01-02 16:36:59', 4, 'Piece', '0', NULL, NULL, '2019-01-02'),
(528, '1', 'HVL011', 'ISOLATOR', '8536', 395, 330, '330', '', NULL, 0, 0, '2019-01-02 16:36:59', 4, 'Piece', '0', NULL, NULL, '2019-01-02'),
(529, '1', 'HVL012', 'ELCB 40/30 HAVELS', '8536', 2710, 2100, '2100', '', NULL, 0, 0, '2019-01-02 16:36:59', 4, 'Piece', '0', NULL, NULL, '2019-01-02'),
(530, '1', 'C&S01', 'DB 8 WAY C&S', '8537', 1581, 950, '950', '', NULL, 0, 0, '2019-01-02 17:58:02', 4, 'Piece', '0', NULL, NULL, '2019-01-02'),
(531, '1', 'C&S02', 'DB 12 WAY C & S', '8537', 1903, 1850, NULL, '', NULL, 0, 0, '2019-01-02 17:58:02', 4, 'Piece', '0', NULL, NULL, '2019-01-02'),
(532, '1', 'C&S03', 'DB 16 WAY C & S', '8537', 2392, 1950, NULL, '', NULL, 0, 0, '2019-01-02 17:58:02', 4, 'Piece', '0', NULL, NULL, '2019-01-02'),
(533, '1', 'C&S04', 'MCB 6 A C & S', '8536', 85.93, 110, NULL, '', NULL, 0, 0, '2019-01-02 17:58:02', 4, 'Piece', '0', NULL, NULL, '2019-01-02'),
(534, '1', 'C&S05', 'MCB 10 A C& S', '8536', 85.93, 110, NULL, '', NULL, 0, 0, '2019-01-02 17:58:02', 4, 'Piece', '0', NULL, NULL, '2019-01-02'),
(535, '1', 'C&S06', 'MCB 16 A C & S', '8536', 85.93, 110, NULL, '', NULL, 0, 0, '2019-01-02 17:58:02', 4, 'Piece', '0', NULL, NULL, '2019-01-02'),
(536, '1', 'C&S07', 'MCB 20 A C & S', '8536', 85.93, 110, NULL, '', NULL, 0, 0, '2019-01-02 17:58:03', 4, 'Piece', '0', NULL, NULL, '2019-01-02'),
(537, '1', 'C&S08', 'ISOLATOR 40/30 A', '8536', 184.37, 230, NULL, '', NULL, 0, 0, '2019-01-02 17:58:03', 4, 'Piece', '0', NULL, NULL, '2019-01-02'),
(538, '1', 'C&S09', 'ELCB 40/30 A', '8536', 1165.25, 1500, NULL, '', NULL, 0, 0, '2019-01-02 17:58:03', 4, 'Piece', '0', NULL, NULL, '2019-01-02'),
(539, '1', 'C&S10', 'ELCB 63/30 A', '8536', 3800, 2500, NULL, '', NULL, 0, 0, '2019-01-02 17:58:03', 4, 'Piece', '0', NULL, NULL, '2019-01-02'),
(540, '1', 'C&S11', 'ELCB63/100 A', '8536', 3800, 2500, NULL, '', NULL, 0, 0, '2019-01-02 17:58:03', 4, 'Piece', '0', NULL, NULL, '2019-01-02'),
(541, '1', 'POL01', 'SUIT EWC POLO 7018 9INCH', '', 2796.61, 2796.61, NULL, '', NULL, 1, 0, '2019-01-03 11:17:47', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(542, '1', 'POL02', 'SUIT EWC POLO 7013 12INCH', '', 2542.37, 2542.43, NULL, '', NULL, 1, 0, '2019-01-03 11:17:47', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(543, '1', 'POL03', 'SUIT EWC POLO 7011 12 INCH', '', 2118.64, 2288.14, NULL, '', NULL, 1, 0, '2019-01-03 11:17:47', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(544, '1', 'POL04', 'SUIT EWC POLO 7016 9INCH', '', 2288.14, 2288.14, NULL, '', NULL, 1, 0, '2019-01-03 11:17:47', 1, 'Piece', '0', NULL, NULL, '2019-01-03'),
(545, '1', 'POL05', 'EWC WALL HUNG POLO 4005', '', 1398.31, 1398.31, NULL, '', NULL, 1, 0, '2019-01-03 11:17:47', 1, 'Piece', '0', NULL, NULL, '2019-01-03'),
(546, '1', 'POL06', 'EWC WALL HUNG POLO 4007', '', 1440.68, 1440.68, NULL, '', NULL, 1, 0, '2019-01-03 11:17:47', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(547, '1', 'POL07', 'EWC WALL HUNG POLO 4012', '', 1328.13, 1328.13, NULL, '', NULL, 1, 0, '2019-01-03 11:17:47', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(548, '1', 'POL08', 'WASH BASEN TABLE TOP 5036 POLO', '', 618.64, 618.64, NULL, '', NULL, 1, 0, '2019-01-03 11:17:47', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(549, '1', 'POL09', 'WASH BASEN TABLE TOP 5033 POLO', '', 618.64, 618.64, NULL, '', NULL, 1, 0, '2019-01-03 11:17:47', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(550, '1', 'POL09', 'WASH BASEN TABLE TOP 5032', '', 593.22, 593.22, NULL, '', NULL, 1, 0, '2019-01-03 11:17:47', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(551, '1', 'POL10', 'WASH BASEN HALF PED SET POLO 1014', '', 644.07, 644.07, NULL, '', NULL, 1, 0, '2019-01-03 11:17:48', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(552, '1', 'C&S12', 'ISOLATOR 63A C&S', '8536', 1026, 1026, NULL, '', NULL, 1, 0, '2019-01-03 11:27:42', 1, 'Piece', '0', NULL, NULL, '2019-01-03'),
(553, '1', 'HVL013', '1.0 SQ WIRE HAVELLS', '8544', 699.15, 830, '830', '', NULL, 0, 0, '2019-01-03 12:20:54', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(554, '1', 'HVL014', '1.5 SQ WIRE HAVELLS', '8544', 1038.13, 12751, '12751', '', NULL, 0, 0, '2019-01-03 12:20:54', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(555, '1', 'HVL015', '2.5 WIRE HAVELLS', '8544', 1677.12, 2100, '2100', '', NULL, 0, 0, '2019-01-03 12:20:54', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(556, '1', 'HVL016', '4.0 SQMM WIRE HAVELLS', '8544', 2463.56, 3100, '3100', '', NULL, 0, 0, '2019-01-03 12:20:54', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(557, '1', 'HVL017', 'FAN SAMRAT  BROWN HAVELLS ', '8414', 1440.68, 1950, '1950', '', NULL, 0, 0, '2019-01-03 12:20:54', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(558, '1', 'HVL018', 'FAN SAMRAT IVORY HAVELLS', '8414', 1440.68, 1950, '1950', '', NULL, 0, 0, '2019-01-03 12:20:54', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(559, '1', 'HVL019', 'FAN ANDRIA HAVELLS', '8414', 1992.25, 2550, '2550', '', NULL, 0, 0, '2019-01-03 12:20:54', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(560, '1', 'HVL020', 'WALL FAN SAMEERA', '8414', 1709.5, 2200, '2200', '', NULL, 0, 0, '2019-01-03 12:20:54', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(561, '1', 'HVL021', 'PEDSETAL FAN HAVELLS SWING', '8414', 2073.5, 2700, '2700', '', NULL, 0, 0, '2019-01-03 12:20:54', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(562, '1', 'PRG01', 'SHORTBODY TAP PRAYAG', '8481', 136.8, 200, '200', '', NULL, 10, 0, '2019-01-03 12:46:47', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(563, '1', 'PRG02', 'PILLERCOCK PRAYAG', '8481', 165.6, 250, '250', '', NULL, 3, 0, '2019-01-03 12:46:47', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(564, '1', 'PRG03', 'LONG BODY TAP PRAYAG', '8481', 177.6, 260, '260', '', NULL, 6, 0, '2019-01-03 12:46:47', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(565, '1', 'PRG04', 'SINK COCK  PRAYAG', '8481', 273.6, 400, '400', '', NULL, 2, 0, '2019-01-03 12:46:47', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(566, '1', 'PRG05', 'ANGLE VALVE PRAYAG', '8481', 122.4, 180, '180', '', NULL, 25, 0, '2019-01-03 12:46:47', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(567, '1', 'PRG06', 'HOSE TAP PRAYAG', '8481', 106.8, 160, '160', '', NULL, 6, 0, '2019-01-03 12:46:47', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(568, '1', 'PRG07', 'HEALTH FAUSESET PRAYAG', '3924', 218.4, 330, '330', '', NULL, 6, 0, '2019-01-03 12:46:47', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(569, '1', 'PRG08', 'HAND SHOWER PRAYAG 183', '3922', 268.8, 400, '400', '', NULL, 3, 0, '2019-01-03 12:46:47', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(570, '1', 'PRG09', 'HAND SHOWER PRAYAG 1831', '1831', 252, 380, '380', '', NULL, 2, 0, '2019-01-03 12:46:47', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(571, '1', 'PRG10', 'OVERHEAD SHOWER PRAYAG 1821', '3922', 372, 550, '550', '', NULL, 2, 0, '2019-01-03 12:46:47', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(572, '1', 'PRG11', 'HEAD SHOWER 181C PRAYAG', '3922', 159.6, 240, '240', '', NULL, 2, 0, '2019-01-03 12:46:47', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(573, '1', 'PRG12', 'TUFLON TAP PRAYAG 3919', '1680', 16.8, 25, '25', '', NULL, 30, 0, '2019-01-03 12:46:47', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(574, '1', 'PRG13', 'WASHING MACHINE INLET PRAYAG', '3917', 138, 210, '210', '', NULL, 2, 0, '2019-01-03 12:46:47', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(575, '1', 'PRG14', 'GREEN HOSE EMRALD GOLD PRAYAG', '3917', 36.63, 54, '54', '', NULL, 14, 0, '2019-01-03 12:46:47', 4, 'M', '0', NULL, NULL, '2019-01-03'),
(576, '1', 'RBN01', 'LONG BODY TAP LINO RUBI', '8481', 820, 730, '730', '', NULL, 0, 0, '2019-01-03 13:14:19', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(577, '1', 'RBN02', 'LONGBODY TAP TRIO RUBI', '8481', 1415, 1250, '1250', '', NULL, 0, 0, '2019-01-03 13:14:19', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(578, '1', 'RBN03', 'LONG BODY TAP PERL RUBI', '8481', 1390, 1250, '1250', '', NULL, 0, 0, '2019-01-03 13:14:19', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(579, '1', 'RBN04', 'ANGLE COCK LINO RUBI', '8481', 420, 380, '380', '', NULL, 0, 0, '2019-01-03 13:14:19', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(580, '1', 'RBN05', 'ANGLE COCK  LEAF RUBI', '8481', 760, 680, '680', '', NULL, 0, 0, '2019-01-03 13:14:19', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(581, '1', 'RBN06', 'LONG BODY LEAF RUBI', '8481', 975, 880, '880', '', NULL, 0, 0, '2019-01-03 13:14:19', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(582, '1', 'RBN07', 'PILLER COCK LEAF RUBI', '8481', 1050, 900, '900', '', NULL, 0, 0, '2019-01-03 13:14:19', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(583, '1', 'RBN08', 'SHOWER COCK PEARL RUBI', '8481', 1365, 1250, '1250', '', NULL, 0, 0, '2019-01-03 13:14:19', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(584, '1', 'RBN09', 'SHOWER COCK LINO RUBI', '8481', 9040, 840, '840', '', NULL, 0, 0, '2019-01-03 13:14:19', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(585, '1', 'RBN10', 'PILLER COCK LINO RUBI', '8481', 905, 800, '800', '', NULL, 0, 0, '2019-01-03 13:14:19', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(586, '1', 'RBN11', 'SINK COCK TABLE TOP LINO RUBI LS', '8481', 1420, 1270, '1270', '', NULL, 0, 0, '2019-01-03 13:14:19', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(587, '1', 'RBN12', 'SINK COCK TABLE TOP SSP RUBI', '8481', 1290, 1100, '1100', '', NULL, 0, 0, '2019-01-03 13:14:19', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(588, '1', 'RBN13', 'PILLER COCK TRIO RUBI', '8481', 1550, 1390, '1390', '', NULL, 0, 0, '2019-01-03 13:14:19', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(589, '1', 'RBN14', 'PILLER COCK PEARL RUBI', '8481', 1440, 1300, '1300', '', NULL, 0, 0, '2019-01-03 13:14:19', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(590, '1', 'RBN15', 'SINK COCK LINO RUBI LS', '8481', 1230, 1100, '1100', '', NULL, 0, 0, '2019-01-03 13:14:19', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(591, '1', 'RBN16', 'SINK COCK SSP RUBI', '8481', 1100, 950, '950', '', NULL, 0, 0, '2019-01-03 13:14:19', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(592, '1', 'RBN17', 'SINK COCK DESIRE RUBI LS', '8481', 1275, 1150, '1150', '', NULL, 0, 0, '2019-01-03 13:14:19', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(593, '1', 'RBN18', 'SINK COCK DESIRE SSP RUBI ', '8481', 1165, 1050, '1050', '', NULL, 0, 0, '2019-01-03 13:14:19', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(594, '1', 'RBN19', 'SINK COCK TRIO RUBI', '8481', 2045, 1850, '1850', '', NULL, 0, 0, '2019-01-03 13:14:19', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(595, '1', 'RBN20', 'SINK COCK PEARL RUBI', '8481', 2055, 1850, '1850', '', NULL, 0, 0, '2019-01-03 13:14:19', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(596, '1', 'RBN21', 'ANGLE COCK LINO 2 IN 1 RUBI', '8481', 1225, 1100, '1100', '', NULL, 0, 0, '2019-01-03 13:14:19', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(597, '1', 'RBN22', 'LONG BODY 2 IN 1 LINO RUBI', '8481', 1400, 1260, '1260', '', NULL, 0, 0, '2019-01-03 13:14:19', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(598, '1', 'RBN23', 'WASTE COUPLING H/T RUBI', '7418', 420, 380, '380', '', NULL, 0, 0, '2019-01-03 13:14:19', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(599, '1', 'RBN24', 'WASTE COUPLING F/T RUBI', '7418', 420, 380, '380', '', NULL, 0, 0, '2019-01-03 13:14:19', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(600, '1', 'RBN25', 'CP CUP DOOM RUBI', '7412', 12.5, 10, '10', '', NULL, 0, 0, '2019-01-03 13:14:19', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(601, '1', 'RBN26', 'CP PLATE FLAT', '7412', 12, 10, NULL, '', NULL, 0, 0, '2019-01-03 16:22:17', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(602, '1', 'RBN27', 'SHOWER ROYAL SUMO RUBI', '8481', 580, 520, '520', '', NULL, 0, 0, '2019-01-03 16:22:18', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(603, '1', 'RBN28', 'SHOWER ROUND 4 RUBI', '8481', 530, 470, NULL, '', NULL, 0, 0, '2019-01-03 16:22:18', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(604, '1', 'RBN29', 'SHOWER CUBIC RUBI', '8481', 690, 620, '620', '', NULL, 0, 0, '2019-01-03 16:22:18', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(605, '1', 'RBN30', 'SHOWER ULTRA SLIM 6X6 RUBI', '8481', 920, 830, '830', '', NULL, 0, 0, '2019-01-03 16:22:18', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(606, '1', 'RBN31', 'SHOWER ARM SLIM 15 RUBI', '8481', 630, 570, '570', '', NULL, 0, 0, '2019-01-03 16:22:18', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(607, '1', 'RBN32', 'SHOWER SLEEK 8 X 8 RUBI', '8481', 1498, 1350, '1350', '', NULL, 0, 0, '2019-01-03 16:22:18', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(608, '1', 'RBN33', 'SHOWER ARM SLIM 18 RUBI', '8481', 702, 680, '680', '', NULL, 0, 0, '2019-01-03 16:22:18', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(609, '1', 'RBN34', 'TELEPHONE SHOWER FISH TYPE RUBI', '3922', 765, 690, '690', '', NULL, 0, 0, '2019-01-03 16:22:18', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(610, '1', 'RBN35', 'TELEPHONE SHOWER CUBIC RUBI', '3922', 750, 680, '680', '', NULL, 0, 0, '2019-01-03 16:22:18', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(611, '1', 'RBN36', 'HEALTH FAUCET CONDA RUBI', '8481', 640, 575, '575', '', NULL, 0, 0, '2019-01-03 16:22:18', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(612, '1', 'RBN37', 'HEALTH FAUCET LEXUS RUBI', '8481', 990, 900, '900', '', NULL, 0, 0, '2019-01-03 16:22:18', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(613, '1', 'RBN38', 'HEALTH FAUCET TRENDY RUBI', '8481', 1150, 1140, '1140', '', NULL, 0, 0, '2019-01-03 16:22:18', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(614, '1', 'RBN39', 'HEALTH FAUCET FUSION RUBI', '8481', 1010, 910, '910', '', NULL, 0, 0, '2019-01-03 16:22:18', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(615, '1', 'RBN40', 'HOSE TAP SPLASH RUBI', '8481', 650, 590, '590', '', NULL, 0, 0, '2019-01-03 16:22:18', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(616, '1', 'RBN41', 'LONG BODY TAP', '8481', 660, 600, '600', '', NULL, 0, 0, '2019-01-03 16:22:18', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(617, '1', 'SPK001', '4*4 PVC BOX SPARK', '', 10.5, 10.5, NULL, '', NULL, 1, 1, '2019-01-03 19:43:54', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(618, '1', 'SPK002', '6*4 PVC BOX SPARK', '', 13, 30, '30', '', NULL, 0, 0, '2019-01-03 19:43:54', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(619, '1', 'SPK003', '8*4 PVC BOX SPARK', '', 18, 40, '40', '', NULL, 0, 0, '2019-01-03 19:43:54', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(620, '1', 'SPK004', '10*4 PVC BOX SPK', '', 23, 23, '23', '', NULL, 1, 0, '2019-01-03 19:43:54', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(621, '1', 'SPK005', '12*4 PVC BOX SPARK', '', 29, 29, NULL, '', NULL, 1, 0, '2019-01-03 19:43:54', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(622, '1', 'SPK006', '10*6 PVC BOX SPARK', '', 28.5, 28.5, NULL, '', NULL, 1, 0, '2019-01-03 19:43:54', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(623, '1', 'SPK007', '12*6 PVC BOX SPARK', '', 33.75, 33.75, NULL, '', NULL, 1, 0, '2019-01-03 19:43:54', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(624, '1', 'SPK008', '10*8 PVC BOX SPARK', '', 34.5, 34.5, NULL, '', NULL, 1, 0, '2019-01-03 19:43:54', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(625, '1', 'SPK009', '12*8 PVC BOX SPARK', '', 37.5, 37.5, NULL, '', NULL, 1, 0, '2019-01-03 19:43:54', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(626, '1', 'SPK010', 'TEE 19mm SPARK', '', 1.95, 1.95, NULL, '', NULL, 1, 0, '2019-01-03 19:43:54', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(627, '1', 'SPK011', ' ELBOW 19mm SPARK', '', 1.85, 1.85, NULL, '', NULL, 1, 0, '2019-01-03 19:43:54', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(628, '1', 'SPK012', ' ELBOW 20mm SPARK', '', 1.95, 1.95, NULL, '', NULL, 1, 0, '2019-01-03 19:43:54', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(629, '1', 'SPK013', 'TEE 20mm SPARK', '', 2.1, 2.1, NULL, '', NULL, 1, 0, '2019-01-03 19:43:54', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(630, '1', 'SPK014', 'ELBOW 25mm SPARK', '', 4.25, 4.25, NULL, '', NULL, 1, 0, '2019-01-03 19:43:54', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(631, '1', 'SPK015', 'TEE 25mm SPARK', '', 4.35, 4.35, NULL, '', NULL, 1, 0, '2019-01-03 19:43:54', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(632, '1', 'SPK016', 'JUNCTION BOX 19mm 1way bk  SPK', '', 7.8, 7.8, NULL, '', NULL, 1, 0, '2019-01-03 20:17:44', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(633, '1', 'SPK017', 'JUNCTION BOX 19mm 2way bk  SPK', '', 7.8, 7.8, NULL, '', NULL, 1, 0, '2019-01-03 20:17:44', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(634, '1', 'SPK018', 'JUNCTION BOX 19mm 3way bk SPK', '', 7.8, 7.8, NULL, '', NULL, 1, 0, '2019-01-03 20:17:44', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(635, '1', 'SPK019', 'JUNCTION BOX 19mm 4way bk SPK', '', 7.8, 7.8, NULL, '', NULL, 1, 0, '2019-01-03 20:17:44', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(636, '1', 'SPK020', 'JUNCTION BOX 19mm 4way wt SPK', '', 8.8, 8.8, NULL, '', NULL, 1, 0, '2019-01-03 20:17:44', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(637, '1', 'SPK021', 'JUNCTION BOX 19mm 3way wt SPK', '', 8.8, 8.8, NULL, '', NULL, 1, 0, '2019-01-03 20:17:44', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(638, '1', 'SPK022', 'JUNCTION BOX 19mm 2way wt SPK', '', 8.8, 8.8, NULL, '', NULL, 1, 0, '2019-01-03 20:17:44', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(639, '1', 'SPK023', 'JUNCTION BOX 19mm 1way wt SPK', '', 8.8, 8.8, NULL, '', NULL, 1, 0, '2019-01-03 20:17:44', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(640, '1', 'SPK024', 'JUNCTION BOX 20mm 1way bk SPK', '', 8.85, 8.85, NULL, '', NULL, 1, 0, '2019-01-03 20:17:44', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(641, '1', 'SPK025', 'JUNCTION BOX 20mm 2way bk SPK', '', 8.85, 8.85, NULL, '', NULL, 1, 0, '2019-01-03 20:17:44', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(642, '1', 'SPK026', 'JUNCTION BOX 20mm 3way bk SPK', '', 8.85, 8.85, NULL, '', NULL, 1, 0, '2019-01-03 20:17:44', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(643, '1', 'SPK027', 'JUNCTION BOX 20mm 4way bk SPK', '', 8.85, 8.85, NULL, '', NULL, 1, 0, '2019-01-03 20:17:44', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(644, '1', 'SPK028', 'JUNCTION BOX 25mm 1way bk SPK', '', 13.5, 13.5, NULL, '', NULL, 1, 0, '2019-01-03 20:17:44', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(645, '1', 'SPK029', 'JUNCTION BOX 25mm 2way bk SPK', '', 13.5, 13.5, NULL, '', NULL, 1, 0, '2019-01-03 20:17:44', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(646, '1', 'SPK030', 'JUNCTION BOX 25mm 3way bk SPK', '', 13.5, 13.5, NULL, '', NULL, 1, 0, '2019-01-03 20:17:44', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(647, '1', 'SPK031', 'JUNCTION BOX 25mm 4way bk SPK', '', 13.5, 13.5, NULL, '', NULL, 1, 0, '2019-01-03 20:17:44', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(648, '1', 'SPK032', 'JUNCTION BOX 19mm 4way deep bk SPK', '', 12.5, 12.5, NULL, '', NULL, 1, 0, '2019-01-03 20:17:44', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(649, '1', 'SPK033', 'METRE BOARD OPEN SPK', '', 155, 155, NULL, '', NULL, 1, 0, '2019-01-03 20:17:44', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(650, '1', 'SPK034', 'METRE & MAIN COSMIC SPK', '', 340, 340, NULL, '', NULL, 1, 0, '2019-01-03 20:17:44', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(651, '1', 'SPK035', 'METRE BOX CONCIELD SPK', '', 440, 440, NULL, '', NULL, 1, 0, '2019-01-03 20:17:44', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(652, '1', 'SPK036', 'METRE & MAIN BOX SPK', '', 850, 850, NULL, '', NULL, 1, 0, '2019-01-03 20:17:44', 4, 'Piece', '0', NULL, NULL, '2019-01-03'),
(653, '1', 'SPK001', '4*4 PVC BOX SPK', '3917', 10.5, 20, '20', '', NULL, 0, 0, '2019-01-04 12:32:55', 4, 'Piece', '0', NULL, NULL, '2019-01-04');

-- --------------------------------------------------------

--
-- Table structure for table `us_purentry`
--

CREATE TABLE `us_purentry` (
  `pe_billid` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `pe_billnumber` int(11) DEFAULT NULL,
  `pe_customername` varchar(100) DEFAULT NULL,
  `pe_customermobile` int(11) DEFAULT NULL,
  `pe_billdate` datetime DEFAULT NULL,
  `pe_total` float DEFAULT NULL,
  `pe_gtotal` varchar(100) DEFAULT NULL,
  `pe_oldbal` varchar(100) DEFAULT NULL,
  `pe_paidamount` float DEFAULT NULL,
  `pe_paymethod` varchar(200) DEFAULT NULL,
  `pe_note` longtext,
  `pe_updateddate` datetime DEFAULT NULL,
  `pe_updatedby` varchar(250) DEFAULT NULL,
  `pe_isactive` int(11) DEFAULT '0',
  `pe_discount` float DEFAULT NULL,
  `pe_mode` varchar(100) DEFAULT NULL,
  `pe_paydate` datetime DEFAULT NULL,
  `pe_unitprice` int(100) DEFAULT NULL,
  `pe_balance` float DEFAULT NULL,
  `pe_supplierid` varchar(10) DEFAULT NULL,
  `pe_vehicle_number` varchar(100) DEFAULT NULL,
  `pe_invoice_number` varchar(100) DEFAULT NULL,
  `pe_invoice_date` date DEFAULT NULL,
  `pe_statecode` varchar(1000) DEFAULT NULL,
  `pe_debitid` varchar(100) DEFAULT NULL,
  `pe_creditid` int(100) DEFAULT NULL,
  `pe_mod` int(11) DEFAULT NULL,
  `pe_ref` varchar(100) DEFAULT NULL,
  `pe_otherref` varchar(100) DEFAULT NULL,
  `pe_refph` varchar(100) DEFAULT NULL,
  `pe_eway` varchar(100) DEFAULT NULL,
  `finyear` int(100) DEFAULT NULL,
  `pe_paid` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `us_purentry`
--

INSERT INTO `us_purentry` (`pe_billid`, `user_id`, `pe_billnumber`, `pe_customername`, `pe_customermobile`, `pe_billdate`, `pe_total`, `pe_gtotal`, `pe_oldbal`, `pe_paidamount`, `pe_paymethod`, `pe_note`, `pe_updateddate`, `pe_updatedby`, `pe_isactive`, `pe_discount`, `pe_mode`, `pe_paydate`, `pe_unitprice`, `pe_balance`, `pe_supplierid`, `pe_vehicle_number`, `pe_invoice_number`, `pe_invoice_date`, `pe_statecode`, `pe_debitid`, `pe_creditid`, `pe_mod`, `pe_ref`, `pe_otherref`, `pe_refph`, `pe_eway`, `finyear`, `pe_paid`) VALUES
(1, 1, 1, '', 0, '2018-12-24 14:05:00', 298.54, '299', '0', 299, 'BANK', NULL, '2018-12-24 14:10:39', NULL, 1, 0, 'purchase', '2018-12-24 00:00:00', NULL, 0, '2', '', 'PTR0036978', '2018-02-11', 'KL', '10', NULL, NULL, NULL, NULL, NULL, NULL, 4, 0),
(2, 1, 1, '', 0, '2018-12-26 12:14:00', 33581.1, '33581', '0', 33581, 'BANK', NULL, '2018-12-26 12:19:35', NULL, 0, 0, 'purchase', '2018-12-26 00:00:00', NULL, 0, '3', '', '04187', '2018-12-24', 'KL', '25', NULL, NULL, NULL, NULL, NULL, NULL, 4, 0),
(3, 1, 2, '', 0, '2018-12-26 12:49:00', 123397, '123397', '0', 123397, 'CASH', NULL, '2018-12-26 12:55:33', NULL, 0, 0, 'purchase', '2018-12-26 00:00:00', NULL, 0, '4', '', '5613', '2018-12-24', 'KL', '27', NULL, NULL, NULL, NULL, NULL, NULL, 4, 0),
(4, 1, 3, '', 0, '2018-12-26 14:00:00', 11762.1, '11762', '0', 11762, 'BANK', NULL, '2018-12-26 14:06:09', NULL, 0, 0, 'purchase', '2018-12-26 00:00:00', NULL, 0, '5', '', '292', '2018-12-25', 'KL', '29', NULL, NULL, NULL, NULL, NULL, NULL, 4, 0),
(5, 1, 4, '', 0, '2018-12-26 14:30:00', 10641.2, '9238.19', '0', 9238.19, 'BANK', NULL, '2018-12-26 14:42:46', NULL, 0, 1403, 'purchase', '2018-12-26 00:00:00', NULL, 0, '5', '', '293', '2018-12-25', 'KL', '31', NULL, NULL, NULL, NULL, NULL, NULL, 4, 0),
(6, 1, 5, '', 0, '2018-12-27 14:08:00', 7118.88, '7119', '0', 7119, 'BANK', NULL, '2018-12-27 14:14:34', NULL, 0, 7329.05, 'purchase', '2018-12-27 00:00:00', NULL, 0, '2', '', 'PTR0036978', '2018-12-21', 'KL', '40', NULL, NULL, NULL, NULL, NULL, NULL, 4, 0),
(7, 1, 6, '', 0, '2018-12-27 14:15:00', 3893.48, '3894', '0', 3894, 'BANK', NULL, '2018-12-27 14:21:47', NULL, 0, 4008.44, 'purchase', '2018-12-27 00:00:00', NULL, 0, '2', '', 'PTR0036990', '2018-12-21', 'KL', '42', NULL, NULL, NULL, NULL, NULL, NULL, 4, 0),
(8, 1, 7, '', 0, '2018-12-31 11:07:00', 9521.18, '9521', '0', 9521, 'CASH', NULL, '2018-12-31 11:14:52', NULL, 0, 0, 'purchase', '2018-12-31 00:00:00', NULL, 0, '6', '', '029', '2018-12-22', 'KL', '44', NULL, NULL, NULL, NULL, NULL, NULL, 4, 0),
(9, 1, 8, '', 0, '2018-12-31 11:15:00', 8358.26, '8358', '0', 8358, 'CASH', NULL, '2018-12-31 11:23:28', NULL, 0, 0, 'purchase', '2018-12-31 00:00:00', NULL, 0, '6', '', '030', '2018-01-22', 'KL', '46', NULL, NULL, NULL, NULL, NULL, NULL, 4, 0),
(10, 1, 9, '', 0, '2018-12-31 12:08:00', 64675.1, '64675', '0', 64675, 'BANK', NULL, '2018-12-31 12:13:20', NULL, 0, 0, 'purchase', '2018-12-31 00:00:00', NULL, 0, '7', '', 'B2B/1826', '2018-12-27', 'KL', '48', NULL, NULL, NULL, NULL, NULL, NULL, 4, 0),
(11, 1, 10, '', 0, '2018-12-31 12:18:00', 4020.02, '4020', '0', 4020, 'BANK', NULL, '2018-12-31 12:27:22', NULL, 0, 0, 'purchase', '2018-12-31 00:00:00', NULL, 0, '8', '', 'B2B/1904', '2018-12-27', 'KL', '50', NULL, NULL, NULL, NULL, NULL, NULL, 4, 0),
(12, 1, 11, '', 0, '2018-12-31 12:27:00', 11699.7, '11700', '0', 11700, 'BANK', NULL, '2018-12-31 12:28:39', NULL, 0, 0, 'purchase', '2018-12-31 00:00:00', NULL, 0, '7', '', 'B2B/573', '2018-12-27', 'KL', '52', NULL, NULL, NULL, NULL, NULL, NULL, 4, 0),
(13, 1, 12, '', 0, '2018-12-31 13:07:00', 11269.7, '11270', '0', 0, 'BANK', NULL, '2018-12-31 13:10:29', NULL, 0, 0, 'purchase', '2018-12-31 00:00:00', NULL, 11270, '10', '', '', '2018-12-27', 'KL', '54', 56, NULL, NULL, NULL, NULL, NULL, 4, 0),
(14, 1, 13, '', 0, '2018-12-31 13:30:00', 14875.1, '14875', '0', 14875, 'BANK', NULL, '2018-12-31 13:33:58', NULL, 0, 0, 'purchase', '2018-12-31 00:00:00', NULL, 0, '11', '', 'R6192', '2018-12-26', 'KL', '57', NULL, NULL, NULL, NULL, NULL, NULL, 4, 0),
(15, 1, 14, '', 0, '2018-12-31 13:36:00', 24999.1, '23658.07', '0', 23658.1, 'BANK', NULL, '2018-12-31 14:01:49', NULL, 0, 1341, 'purchase', '2018-12-31 00:00:00', NULL, 0, '12', '', '2445', '2018-12-27', 'KL', '59', NULL, NULL, NULL, NULL, NULL, NULL, 4, 0),
(16, 1, 15, '', 0, '2019-01-01 11:03:00', 42535.5, '42536', '0', 42536, 'BANK', NULL, '2019-01-01 11:23:28', NULL, 0, 43791.4, 'purchase', '2019-01-01 00:00:00', NULL, 0, '2', '', 'PTR0036979', '2018-12-21', 'KL', '61', NULL, NULL, NULL, NULL, NULL, NULL, 4, 0),
(17, 1, 16, '', 0, '2019-01-01 13:43:00', 3749.76, '3750', '0', 0, 'CASH', NULL, '2019-01-01 13:47:59', NULL, 0, 0, 'purchase', '2019-01-01 00:00:00', NULL, 3750, '13', '', 'PS/G1123', '2018-12-31', 'KL', '63', 65, NULL, NULL, NULL, NULL, NULL, 4, 0),
(18, 1, 17, '', 0, '2019-01-01 14:51:00', 29659.9, '29660', '0', 0, 'BANK', NULL, '2019-01-01 14:56:35', NULL, 0, 0, 'purchase', '2019-01-01 00:00:00', NULL, 29660, '14', '', 'L0894', '2018-12-27', 'KL', '66', 68, NULL, NULL, NULL, NULL, NULL, 4, 0),
(19, 1, 17, '', 0, '2019-01-02 10:31:00', 69726.2, '69726', '0', 69726, 'CASH', NULL, '2019-01-02 11:32:15', NULL, 0, 0, 'purchase', '2019-01-02 00:00:00', NULL, 0, '15', '', 'FF39925/18-19', '2018-12-26', 'KL', '69', NULL, NULL, NULL, NULL, NULL, NULL, 4, 0),
(20, 1, 18, '', 0, '2019-01-04 21:36:00', 13593.6, '13594', '0', 13594, 'CASH', NULL, '2019-01-04 21:45:42', NULL, 0, 122.4, 'purchase', '2019-01-04 00:00:00', NULL, 0, '12', '', 'JS11', '2019-01-02', 'KL', '74', NULL, NULL, NULL, NULL, NULL, NULL, 4, 0),
(21, 1, 19, '', 0, '2019-01-04 21:49:00', 605.13, '605', '0', 605, 'CASH', NULL, '2019-01-04 21:51:58', NULL, 0, 0, 'purchase', '2019-01-04 00:00:00', NULL, 0, '12', '', 'JS12', '2019-01-02', 'KL', '76', NULL, NULL, NULL, NULL, NULL, NULL, 4, 0),
(22, 1, 20, '', 0, '2019-01-05 09:30:00', 141419, '141419', '0', 141419, 'CASH', NULL, '2019-01-05 10:26:02', NULL, 0, 0, 'purchase', '2019-01-05 00:00:00', NULL, 0, '16', '', 'N-2957', '2018-12-29', 'KL', '78', NULL, NULL, NULL, NULL, NULL, NULL, 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `us_puritems`
--

CREATE TABLE `us_puritems` (
  `pi_billitemid` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `pi_billid` int(11) DEFAULT NULL,
  `pi_productid` int(11) DEFAULT NULL,
  `pi_price` float DEFAULT NULL,
  `pi_quantity` float DEFAULT NULL,
  `pi_total` float DEFAULT NULL,
  `pi_updatedon` datetime DEFAULT NULL,
  `pi_isactive` int(11) DEFAULT '0',
  `pi_vatamount` float DEFAULT NULL,
  `pi_vatper` float DEFAULT NULL,
  `pi_unitprice` int(100) DEFAULT NULL,
  `pi_sgst` float DEFAULT NULL,
  `pi_sgstamt` float DEFAULT NULL,
  `pi_cgst` float DEFAULT NULL,
  `pi_cgstamt` float DEFAULT NULL,
  `pi_igst` float DEFAULT NULL,
  `pi_igstamt` float DEFAULT NULL,
  `pi_discount` float DEFAULT NULL,
  `pi_discount_amt` float NOT NULL,
  `pi_taxamount` varchar(100) DEFAULT NULL,
  `pi_prrate` varchar(1000) DEFAULT NULL,
  `pi_hsn` varchar(1000) DEFAULT NULL,
  `pi_billdate` datetime DEFAULT NULL,
  `finyear` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `us_puritems`
--

INSERT INTO `us_puritems` (`pi_billitemid`, `user_id`, `pi_billid`, `pi_productid`, `pi_price`, `pi_quantity`, `pi_total`, `pi_updatedon`, `pi_isactive`, `pi_vatamount`, `pi_vatper`, `pi_unitprice`, `pi_sgst`, `pi_sgstamt`, `pi_cgst`, `pi_cgstamt`, `pi_igst`, `pi_igstamt`, `pi_discount`, `pi_discount_amt`, `pi_taxamount`, `pi_prrate`, `pi_hsn`, `pi_billdate`, `finyear`) VALUES
(1, 1, 1, 2, 3, 10, 35.4, '2018-12-24 14:10:39', 1, 5.4, 18, NULL, 9, 2.7, 9, 2.7, 0, 0, 0, 0, '30.00', '3.54', NULL, NULL, 4),
(2, 1, 1, 3, 5, 5, 29.5, '2018-12-24 14:10:39', 1, 4.5, 18, NULL, 9, 2.25, 9, 2.25, 0, 0, 0, 0, '25.00', '5.90', NULL, NULL, 4),
(3, 1, 1, 4, 9, 15, 159.3, '2018-12-24 14:10:39', 1, 24.3, 18, NULL, 9, 12.15, 9, 12.15, 0, 0, 0, 0, '135.00', '10.62', NULL, NULL, 4),
(4, 1, 1, 5, 9, 7, 74.34, '2018-12-24 14:10:39', 1, 11.34, 18, NULL, 9, 5.67, 9, 5.67, 0, 0, 0, 0, '63.00', '10.62', NULL, NULL, 4),
(5, 1, 2, 7, 21.352, 300, 7558.61, '2018-12-26 12:19:35', 0, 1153.01, 18, NULL, 9, 576.505, 9, 576.505, 0, 0, 0, 0, '6405.60', '25.20', NULL, NULL, 4),
(6, 1, 2, 8, 23.184, 200, 5471.42, '2018-12-26 12:19:35', 0, 834.62, 18, NULL, 9, 417.31, 9, 417.31, 0, 0, 0, 0, '4636.80', '27.36', NULL, NULL, 4),
(7, 1, 2, 9, 38.304, 200, 9039.74, '2018-12-26 12:19:35', 0, 1378.94, 18, NULL, 9, 689.47, 9, 689.47, 0, 0, 0, 0, '7660.80', '45.20', NULL, NULL, 4),
(8, 1, 2, 10, 29.89, 100, 3527.02, '2018-12-26 12:19:35', 0, 538.02, 18, NULL, 9, 269.01, 9, 269.01, 0, 0, 0, 0, '2989.00', '35.27', NULL, NULL, 4),
(9, 1, 2, 11, 33.832, 200, 7984.35, '2018-12-26 12:19:35', 0, 1217.95, 18, NULL, 9, 608.975, 9, 608.975, 0, 0, 0, 0, '6766.40', '39.92', NULL, NULL, 4),
(10, 1, 3, 12, 33.331, 50, 1966.53, '2018-12-26 12:55:33', 0, 299.98, 18, NULL, 9, 149.99, 9, 149.99, 0, 0, 0, 0, '1666.55', '39.33', NULL, NULL, 4),
(11, 1, 3, 13, 40.538, 50, 2391.74, '2018-12-26 12:55:33', 0, 364.84, 18, NULL, 9, 182.42, 9, 182.42, 0, 0, 0, 0, '2026.90', '47.83', NULL, NULL, 4),
(12, 1, 3, 14, 96.788, 50, 5710.49, '2018-12-26 12:55:33', 0, 871.09, 18, NULL, 9, 435.545, 9, 435.545, 0, 0, 0, 0, '4839.40', '114.21', NULL, NULL, 4),
(13, 1, 3, 15, 124.576, 250, 36749.9, '2018-12-26 12:55:33', 0, 5605.92, 18, NULL, 9, 2802.96, 9, 2802.96, 0, 0, 0, 0, '31144.00', '147.00', NULL, NULL, 4),
(14, 1, 3, 16, 12.712, 125, 1875.02, '2018-12-26 12:55:33', 0, 286.02, 18, NULL, 9, 143.01, 9, 143.01, 0, 0, 0, 0, '1589.00', '15.00', NULL, NULL, 4),
(15, 1, 3, 17, 19.594, 250, 5780.23, '2018-12-26 12:55:33', 0, 881.73, 18, NULL, 9, 440.865, 9, 440.865, 0, 0, 0, 0, '4898.50', '23.12', NULL, NULL, 4),
(16, 1, 3, 18, 30.238, 200, 7136.17, '2018-12-26 12:55:33', 0, 1088.57, 18, NULL, 9, 544.285, 9, 544.285, 0, 0, 0, 0, '6047.60', '35.68', NULL, NULL, 4),
(17, 1, 3, 19, 32.034, 150, 5670.02, '2018-12-26 12:55:33', 0, 864.92, 18, NULL, 9, 432.46, 9, 432.46, 0, 0, 0, 0, '4805.10', '37.80', NULL, NULL, 4),
(18, 1, 3, 20, 46.882, 125, 6915.09, '2018-12-26 12:55:33', 0, 1054.84, 18, NULL, 9, 527.42, 9, 527.42, 0, 0, 0, 0, '5860.25', '55.32', NULL, NULL, 4),
(19, 1, 3, 21, 53.458, 75, 4731.03, '2018-12-26 12:55:33', 0, 721.68, 18, NULL, 9, 360.84, 9, 360.84, 0, 0, 0, 0, '4009.35', '63.08', NULL, NULL, 4),
(20, 1, 3, 22, 73.695, 50, 4348, '2018-12-26 12:55:33', 0, 663.25, 18, NULL, 9, 331.625, 9, 331.625, 0, 0, 0, 0, '3684.75', '86.96', NULL, NULL, 4),
(21, 1, 3, 23, 106.373, 35, 4393.2, '2018-12-26 12:55:33', 0, 670.15, 18, NULL, 9, 335.075, 9, 335.075, 0, 0, 0, 0, '3723.06', '125.52', NULL, NULL, 4),
(22, 1, 3, 24, 106.779, 250, 31499.8, '2018-12-26 12:55:33', 0, 4805.05, 18, NULL, 9, 2402.52, 9, 2402.52, 0, 0, 0, 0, '26694.75', '126.00', NULL, NULL, 4),
(23, 1, 3, 25, 28.678, 125, 4230.01, '2018-12-26 12:55:33', 0, 645.25, 18, NULL, 9, 322.625, 9, 322.625, 0, 0, 0, 0, '3584.75', '33.84', NULL, NULL, 4),
(24, 1, 4, 26, 3.9, 1000, 4602, '2018-12-26 14:06:09', 0, 702, 18, NULL, 9, 351, 9, 351, 0, 0, 0, 0, '3900.00', '4.60', NULL, NULL, 4),
(25, 1, 4, 27, 2.5, 500, 1475, '2018-12-26 14:06:09', 0, 225, 18, NULL, 9, 112.5, 9, 112.5, 0, 0, 0, 0, '1250.00', '2.95', NULL, NULL, 4),
(26, 1, 4, 28, 2.33, 1000, 2749.4, '2018-12-26 14:06:09', 0, 419.4, 18, NULL, 9, 209.7, 9, 209.7, 0, 0, 0, 0, '2330.00', '2.75', NULL, NULL, 4),
(27, 1, 4, 29, 2.33, 500, 1374.7, '2018-12-26 14:06:09', 0, 209.7, 18, NULL, 9, 104.85, 9, 104.85, 0, 0, 0, 0, '1165.00', '2.75', NULL, NULL, 4),
(28, 1, 4, 30, 6.74, 24, 190.88, '2018-12-26 14:06:09', 0, 29.12, 18, NULL, 9, 14.56, 9, 14.56, 0, 0, 0, 0, '161.76', '7.95', NULL, NULL, 4),
(29, 1, 4, 31, 8.43, 24, 238.74, '2018-12-26 14:06:09', 0, 36.42, 18, NULL, 9, 18.21, 9, 18.21, 0, 0, 0, 0, '202.32', '9.95', NULL, NULL, 4),
(30, 1, 4, 32, 9.24, 24, 261.68, '2018-12-26 14:06:09', 0, 39.92, 18, NULL, 9, 19.96, 9, 19.96, 0, 0, 0, 0, '221.76', '10.90', NULL, NULL, 4),
(31, 1, 4, 33, 13.55, 12, 191.87, '2018-12-26 14:06:09', 0, 29.27, 18, NULL, 9, 14.635, 9, 14.635, 0, 0, 0, 0, '162.60', '15.99', NULL, NULL, 4),
(32, 1, 4, 34, 19.49, 12, 275.98, '2018-12-26 14:06:09', 0, 42.1, 18, NULL, 9, 21.05, 9, 21.05, 0, 0, 0, 0, '233.88', '23.00', NULL, NULL, 4),
(33, 1, 4, 35, 28.38, 12, 401.86, '2018-12-26 14:06:09', 0, 61.3, 18, NULL, 9, 30.65, 9, 30.65, 0, 0, 0, 0, '340.56', '33.49', NULL, NULL, 4),
(34, 1, 5, 36, 35, 6, 247.8, '2018-12-26 14:42:46', 0, 37.8, 18, NULL, 9, 18.9, 9, 18.9, 0, 0, 0, 0, '210.00', '41.30', NULL, NULL, 4),
(35, 1, 5, 37, 51.51, 6, 364.69, '2018-12-26 14:42:46', 0, 55.63, 18, NULL, 9, 27.815, 9, 27.815, 0, 0, 0, 0, '309.06', '60.78', NULL, NULL, 4),
(36, 1, 5, 38, 90.67, 12, 1283.89, '2018-12-26 14:42:46', 0, 195.85, 18, NULL, 9, 97.925, 9, 97.925, 0, 0, 0, 0, '1088.04', '106.99', NULL, NULL, 4),
(37, 1, 5, 39, 4.88, 100, 575.84, '2018-12-26 14:42:46', 0, 87.84, 18, NULL, 9, 43.92, 9, 43.92, 0, 0, 0, 0, '488.00', '5.76', NULL, NULL, 4),
(38, 1, 5, 40, 5.67, 100, 669.06, '2018-12-26 14:42:46', 0, 102.06, 18, NULL, 9, 51.03, 9, 51.03, 0, 0, 0, 0, '567.00', '6.69', NULL, NULL, 4),
(39, 1, 5, 41, 6.76, 200, 1595.36, '2018-12-26 14:42:46', 0, 243.36, 18, NULL, 9, 121.68, 9, 121.68, 0, 0, 0, 0, '1352.00', '7.98', NULL, NULL, 4),
(40, 1, 5, 42, 9.23, 40, 435.66, '2018-12-26 14:42:46', 0, 66.46, 18, NULL, 9, 33.23, 9, 33.23, 0, 0, 0, 0, '369.20', '10.89', NULL, NULL, 4),
(41, 1, 5, 43, 12.71, 50, 749.89, '2018-12-26 14:42:46', 0, 114.39, 18, NULL, 9, 57.195, 9, 57.195, 0, 0, 0, 0, '635.50', '15.00', NULL, NULL, 4),
(42, 1, 5, 44, 18.5, 50, 1091.5, '2018-12-26 14:42:46', 0, 166.5, 18, NULL, 9, 83.25, 9, 83.25, 0, 0, 0, 0, '925.00', '21.83', NULL, NULL, 4),
(43, 1, 5, 45, 26.69, 12, 377.93, '2018-12-26 14:42:46', 0, 57.65, 18, NULL, 9, 28.825, 9, 28.825, 0, 0, 0, 0, '320.28', '31.49', NULL, NULL, 4),
(44, 1, 5, 46, 38.84, 12, 549.97, '2018-12-26 14:42:46', 0, 83.89, 18, NULL, 9, 41.945, 9, 41.945, 0, 0, 0, 0, '466.08', '45.83', NULL, NULL, 4),
(45, 1, 5, 47, 63.55, 36, 2699.6, '2018-12-26 14:42:46', 0, 411.8, 18, NULL, 9, 205.9, 9, 205.9, 0, 0, 0, 0, '2287.80', '74.99', NULL, NULL, 4),
(46, 1, 6, 48, 13, 24, 166.23, '2018-12-27 14:14:34', 0, 25.36, 18, NULL, 9, 12.68, 9, 12.68, 0, 0, 0, 0, '140.87', '6.93', NULL, NULL, 4),
(47, 1, 6, 49, 114, 48, 2915.32, '2018-12-27 14:14:34', 0, 444.71, 18, NULL, 9, 222.355, 9, 222.355, 0, 0, 0, 0, '2470.61', '60.74', NULL, NULL, 4),
(48, 1, 6, 52, 201, 12, 1285.04, '2018-12-27 14:14:34', 0, 196.02, 18, NULL, 9, 98.01, 9, 98.01, 0, 0, 0, 0, '1089.02', '107.09', NULL, NULL, 4),
(49, 1, 6, 50, 397, 6, 1269.05, '2018-12-27 14:14:34', 0, 193.58, 18, NULL, 9, 96.79, 9, 96.79, 0, 0, 0, 0, '1075.47', '211.51', NULL, NULL, 4),
(50, 1, 6, 51, 58, 48, 1483.24, '2018-12-27 14:14:34', 0, 226.26, 18, NULL, 9, 113.13, 9, 113.13, 0, 0, 0, 0, '1256.98', '30.90', NULL, NULL, 4),
(51, 1, 7, 53, 72, 10, 383.59, '2018-12-27 14:21:47', 0, 58.51, 18, NULL, 9, 29.255, 9, 29.255, 0, 0, 0, 0, '325.08', '38.36', NULL, NULL, 4),
(52, 1, 7, 54, 200, 24, 2557.3, '2018-12-27 14:21:47', 0, 390.1, 18, NULL, 9, 195.05, 9, 195.05, 0, 0, 0, 0, '2167.20', '106.55', NULL, NULL, 4),
(53, 1, 7, 55, 149, 12, 952.59, '2018-12-27 14:21:47', 0, 145.31, 18, NULL, 9, 72.655, 9, 72.655, 0, 0, 0, 0, '807.28', '79.38', NULL, NULL, 4),
(54, 1, 8, 344, 11.3, 90, 1200.06, '2018-12-31 11:14:52', 0, 183.06, 18, NULL, 9, 91.53, 9, 91.53, 0, 0, 0, 0, '1017.00', '13.33', NULL, NULL, 4),
(55, 1, 8, 345, 11.86, 150, 2099.22, '2018-12-31 11:14:52', 0, 320.22, 18, NULL, 9, 160.11, 9, 160.11, 0, 0, 0, 0, '1779.00', '13.99', NULL, NULL, 4),
(56, 1, 8, 346, 7.21, 300, 2552.34, '2018-12-31 11:14:52', 0, 389.34, 18, NULL, 9, 194.67, 9, 194.67, 0, 0, 0, 0, '2163.00', '8.51', NULL, NULL, 4),
(57, 1, 8, 347, 18.36, 30, 649.94, '2018-12-31 11:14:52', 0, 99.14, 18, NULL, 9, 49.57, 9, 49.57, 0, 0, 0, 0, '550.80', '21.66', NULL, NULL, 4),
(58, 1, 8, 342, 50.84, 12, 719.89, '2018-12-31 11:14:52', 0, 109.81, 18, NULL, 9, 54.905, 9, 54.905, 0, 0, 0, 0, '610.08', '59.99', NULL, NULL, 4),
(59, 1, 8, 343, 33.89, 12, 479.88, '2018-12-31 11:14:52', 0, 73.2, 18, NULL, 9, 36.6, 9, 36.6, 0, 0, 0, 0, '406.68', '39.99', NULL, NULL, 4),
(60, 1, 8, 348, 103.38, 10, 1219.88, '2018-12-31 11:14:52', 0, 186.08, 18, NULL, 9, 93.04, 9, 93.04, 0, 0, 0, 0, '1033.80', '121.99', NULL, NULL, 4),
(61, 1, 8, 349, 101.69, 5, 599.97, '2018-12-31 11:14:52', 0, 91.52, 18, NULL, 9, 45.76, 9, 45.76, 0, 0, 0, 0, '508.45', '119.99', NULL, NULL, 4),
(62, 1, 9, 335, 158.47, 4, 747.98, '2018-12-31 11:23:28', 0, 114.1, 18, NULL, 9, 57.05, 9, 57.05, 0, 0, 0, 0, '633.88', '187.00', NULL, NULL, 4),
(63, 1, 9, 336, 158.47, 3, 560.98, '2018-12-31 11:23:28', 0, 85.57, 18, NULL, 9, 42.785, 9, 42.785, 0, 0, 0, 0, '475.41', '186.99', NULL, NULL, 4),
(64, 1, 9, 337, 211.86, 6, 1499.97, '2018-12-31 11:23:28', 0, 228.81, 18, NULL, 9, 114.405, 9, 114.405, 0, 0, 0, 0, '1271.16', '250.00', NULL, NULL, 4),
(65, 1, 9, 338, 61.01, 10, 719.92, '2018-12-31 11:23:28', 0, 109.82, 18, NULL, 9, 54.91, 9, 54.91, 0, 0, 0, 0, '610.10', '71.99', NULL, NULL, 4),
(66, 1, 9, 339, 55.08, 30, 1949.83, '2018-12-31 11:23:28', 0, 297.43, 18, NULL, 9, 148.715, 9, 148.715, 0, 0, 0, 0, '1652.40', '64.99', NULL, NULL, 4),
(67, 1, 9, 340, 50.84, 24, 1439.79, '2018-12-31 11:23:28', 0, 219.63, 18, NULL, 9, 109.815, 9, 109.815, 0, 0, 0, 0, '1220.16', '59.99', NULL, NULL, 4),
(68, 1, 9, 341, 50.84, 24, 1439.79, '2018-12-31 11:23:28', 0, 219.63, 18, NULL, 9, 109.815, 9, 109.815, 0, 0, 0, 0, '1220.16', '59.99', NULL, NULL, 4),
(69, 1, 10, 320, 971.19, 6, 6876.03, '2018-12-31 12:13:20', 0, 1048.89, 18, NULL, 9, 524.445, 9, 524.445, 0, 0, 0, 0, '5827.14', '1146.00', NULL, NULL, 4),
(70, 1, 10, 321, 971.19, 6, 6876.03, '2018-12-31 12:13:20', 0, 1048.89, 18, NULL, 9, 524.445, 9, 524.445, 0, 0, 0, 0, '5827.14', '1146.00', NULL, NULL, 4),
(71, 1, 10, 322, 1064.41, 9, 11304, '2018-12-31 12:13:20', 0, 1724.34, 18, NULL, 9, 862.17, 9, 862.17, 0, 0, 0, 0, '9579.69', '1256.00', NULL, NULL, 4),
(72, 1, 10, 323, 205.08, 9, 2177.95, '2018-12-31 12:13:20', 0, 332.23, 18, NULL, 9, 166.115, 9, 166.115, 0, 0, 0, 0, '1845.72', '241.99', NULL, NULL, 4),
(73, 1, 10, 324, 770.34, 9, 8181.01, '2018-12-31 12:13:20', 0, 1247.95, 18, NULL, 9, 623.975, 9, 623.975, 0, 0, 0, 0, '6933.06', '909.00', NULL, NULL, 4),
(74, 1, 10, 325, 798.31, 9, 8478.05, '2018-12-31 12:13:20', 0, 1293.26, 18, NULL, 9, 646.63, 9, 646.63, 0, 0, 0, 0, '7184.79', '942.01', NULL, NULL, 4),
(75, 1, 10, 326, 638.14, 2, 1506.01, '2018-12-31 12:13:20', 0, 229.73, 18, NULL, 9, 114.865, 9, 114.865, 0, 0, 0, 0, '1276.28', '753.00', NULL, NULL, 4),
(76, 1, 10, 327, 638.14, 2, 1506.01, '2018-12-31 12:13:20', 0, 229.73, 18, NULL, 9, 114.865, 9, 114.865, 0, 0, 0, 0, '1276.28', '753.00', NULL, NULL, 4),
(77, 1, 10, 328, 1794.07, 2, 4234.01, '2018-12-31 12:13:20', 0, 645.87, 18, NULL, 9, 322.935, 9, 322.935, 0, 0, 0, 0, '3588.14', '2117.01', NULL, NULL, 4),
(78, 1, 10, 329, 645.76, 12, 9143.96, '2018-12-31 12:13:20', 0, 1394.84, 18, NULL, 9, 697.42, 9, 697.42, 0, 0, 0, 0, '7749.12', '762.00', NULL, NULL, 4),
(79, 1, 10, 330, 310.17, 12, 4392.01, '2018-12-31 12:13:20', 0, 669.97, 18, NULL, 9, 334.985, 9, 334.985, 0, 0, 0, 0, '3722.04', '366.00', NULL, NULL, 4),
(80, 1, 11, 331, 491.53, 6, 3480.03, '2018-12-31 12:27:22', 0, 530.85, 18, NULL, 9, 265.425, 9, 265.425, 0, 0, 0, 0, '2949.18', '580.00', NULL, NULL, 4),
(81, 1, 11, 332, 76.27, 6, 539.99, '2018-12-31 12:27:22', 0, 82.37, 18, NULL, 9, 41.185, 9, 41.185, 0, 0, 0, 0, '457.62', '90.00', NULL, NULL, 4),
(82, 1, 12, 333, 5000, 1, 5900, '2018-12-31 12:28:39', 0, 900, 18, NULL, 9, 450, 9, 450, 0, 0, 0, 0, '5000', '5900.00', NULL, NULL, 4),
(83, 1, 12, 334, 4915, 1, 5799.7, '2018-12-31 12:28:39', 0, 884.7, 18, NULL, 9, 442.35, 9, 442.35, 0, 0, 0, 0, '4915', '5799.70', NULL, NULL, 4),
(84, 1, 13, 234, 37.288, 150, 6599.98, '2018-12-31 13:10:29', 0, 1006.78, 18, NULL, 9, 503.39, 9, 503.39, 0, 0, 0, 0, '5593.20', '44.00', NULL, NULL, 4),
(85, 1, 13, 235, 56.49, 30, 1999.75, '2018-12-31 13:10:29', 0, 305.05, 18, NULL, 9, 152.525, 9, 152.525, 0, 0, 0, 0, '1694.70', '66.66', NULL, NULL, 4),
(86, 1, 13, 236, 75.424, 30, 2670.01, '2018-12-31 13:10:29', 0, 407.29, 18, NULL, 9, 203.645, 9, 203.645, 0, 0, 0, 0, '2262.72', '89.00', NULL, NULL, 4),
(87, 1, 14, 281, 25.74, 150, 4555.98, '2018-12-31 13:33:58', 0, 694.98, 18, NULL, 9, 347.49, 9, 347.49, 0, 0, 0, 0, '3861.00', '30.37', NULL, NULL, 4),
(88, 1, 14, 282, 35.64, 100, 4205.52, '2018-12-31 13:33:58', 0, 641.52, 18, NULL, 9, 320.76, 9, 320.76, 0, 0, 0, 0, '3564.00', '42.06', NULL, NULL, 4),
(89, 1, 14, 283, 46.2, 50, 2725.8, '2018-12-31 13:33:58', 0, 415.8, 18, NULL, 9, 207.9, 9, 207.9, 0, 0, 0, 0, '2310.00', '54.52', NULL, NULL, 4),
(90, 1, 14, 441, 57.42, 50, 3387.78, '2018-12-31 13:33:58', 0, 516.78, 18, NULL, 9, 258.39, 9, 258.39, 0, 0, 0, 0, '2871.00', '67.76', NULL, NULL, 4),
(91, 1, 15, 285, 94.92, 6, 672.03, '2018-12-31 14:01:49', 0, 102.51, 18, NULL, 9, 51.255, 9, 51.255, 0, 0, 0, 0, '569.52', '112.01', NULL, NULL, 4),
(92, 1, 15, 286, 160.17, 6, 1134, '2018-12-31 14:01:49', 0, 172.98, 18, NULL, 9, 86.49, 9, 86.49, 0, 0, 0, 0, '961.02', '189.00', NULL, NULL, 4),
(93, 1, 15, 287, 241.53, 6, 1710.03, '2018-12-31 14:01:49', 0, 260.85, 18, NULL, 9, 130.425, 9, 130.425, 0, 0, 0, 0, '1449.18', '285.01', NULL, NULL, 4),
(94, 1, 15, 288, 419.49, 4, 1979.99, '2018-12-31 14:01:49', 0, 302.03, 18, NULL, 9, 151.015, 9, 151.015, 0, 0, 0, 0, '1677.96', '495.00', NULL, NULL, 4),
(95, 1, 15, 289, 596.61, 2, 1408, '2018-12-31 14:01:49', 0, 214.78, 18, NULL, 9, 107.39, 9, 107.39, 0, 0, 0, 0, '1193.22', '704.00', NULL, NULL, 4),
(96, 1, 15, 290, 18.64, 30, 659.86, '2018-12-31 14:01:49', 0, 100.66, 18, NULL, 9, 50.33, 9, 50.33, 0, 0, 0, 0, '559.20', '22.00', NULL, NULL, 4),
(97, 1, 15, 291, 22.46, 30, 795.08, '2018-12-31 14:01:49', 0, 121.28, 18, NULL, 9, 60.64, 9, 60.64, 0, 0, 0, 0, '673.80', '26.50', NULL, NULL, 4),
(98, 1, 15, 292, 32.2, 30, 1139.88, '2018-12-31 14:01:49', 0, 173.88, 18, NULL, 9, 86.94, 9, 86.94, 0, 0, 0, 0, '966.00', '38.00', NULL, NULL, 4),
(99, 1, 15, 293, 11.53, 30, 408.16, '2018-12-31 14:01:49', 0, 62.26, 18, NULL, 9, 31.13, 9, 31.13, 0, 0, 0, 0, '345.90', '13.61', NULL, NULL, 4),
(100, 1, 15, 294, 17.63, 30, 624.1, '2018-12-31 14:01:49', 0, 95.2, 18, NULL, 9, 47.6, 9, 47.6, 0, 0, 0, 0, '528.90', '20.80', NULL, NULL, 4),
(101, 1, 15, 295, 22.03, 30, 779.86, '2018-12-31 14:01:49', 0, 118.96, 18, NULL, 9, 59.48, 9, 59.48, 0, 0, 0, 0, '660.90', '26.00', NULL, NULL, 4),
(102, 1, 15, 296, 12.37, 30, 437.9, '2018-12-31 14:01:49', 0, 66.8, 18, NULL, 9, 33.4, 9, 33.4, 0, 0, 0, 0, '371.10', '14.60', NULL, NULL, 4),
(103, 1, 15, 297, 20.34, 50, 1200.06, '2018-12-31 14:01:49', 0, 183.06, 18, NULL, 9, 91.53, 9, 91.53, 0, 0, 0, 0, '1017.00', '24.00', NULL, NULL, 4),
(104, 1, 15, 298, 31.86, 30, 1223.42, '2018-12-31 14:01:49', 0, 267.62, 28, NULL, 14, 133.81, 14, 133.81, 0, 0, 0, 0, '955.80', '40.78', NULL, NULL, 4),
(105, 1, 15, 299, 29.53, 30, 1045.36, '2018-12-31 14:01:49', 0, 159.46, 18, NULL, 9, 79.73, 9, 79.73, 0, 0, 0, 0, '885.90', '34.85', NULL, NULL, 4),
(106, 1, 15, 300, 39.19, 30, 1387.33, '2018-12-31 14:01:49', 0, 211.63, 18, NULL, 9, 105.815, 9, 105.815, 0, 0, 0, 0, '1175.70', '46.24', NULL, NULL, 4),
(107, 1, 15, 301, 12.5, 21, 309.75, '2018-12-31 14:01:49', 0, 47.25, 18, NULL, 9, 23.625, 9, 23.625, 0, 0, 0, 0, '262.50', '14.75', NULL, NULL, 4),
(108, 1, 15, 302, 25.08, 24, 710.27, '2018-12-31 14:01:49', 0, 108.35, 18, NULL, 9, 54.175, 9, 54.175, 0, 0, 0, 0, '601.92', '29.59', NULL, NULL, 4),
(109, 1, 15, 303, 29.66, 10, 349.99, '2018-12-31 14:01:49', 0, 53.39, 18, NULL, 9, 26.695, 9, 26.695, 0, 0, 0, 0, '296.60', '35.00', NULL, NULL, 4),
(110, 1, 15, 304, 7.37, 12, 104.36, '2018-12-31 14:01:49', 0, 15.92, 18, NULL, 9, 7.96, 9, 7.96, 0, 0, 0, 0, '88.44', '8.70', NULL, NULL, 4),
(111, 1, 15, 305, 14.75, 12, 208.86, '2018-12-31 14:01:49', 0, 31.86, 18, NULL, 9, 15.93, 9, 15.93, 0, 0, 0, 0, '177.00', '17.41', NULL, NULL, 4),
(112, 1, 15, 306, 22.12, 12, 313.22, '2018-12-31 14:01:49', 0, 47.78, 18, NULL, 9, 23.89, 9, 23.89, 0, 0, 0, 0, '265.44', '26.10', NULL, NULL, 4),
(113, 1, 15, 307, 89.83, 12, 1271.99, '2018-12-31 14:01:49', 0, 194.03, 18, NULL, 9, 97.015, 9, 97.015, 0, 0, 0, 0, '1077.96', '106.00', NULL, NULL, 4),
(114, 1, 15, 308, 9.66, 12, 136.79, '2018-12-31 14:01:49', 0, 20.87, 18, NULL, 9, 10.435, 9, 10.435, 0, 0, 0, 0, '115.92', '11.40', NULL, NULL, 4),
(115, 1, 15, 309, 19.32, 12, 273.57, '2018-12-31 14:01:49', 0, 41.73, 18, NULL, 9, 20.865, 9, 20.865, 0, 0, 0, 0, '231.84', '22.80', NULL, NULL, 4),
(116, 1, 15, 310, 28.98, 12, 410.36, '2018-12-31 14:01:49', 0, 62.6, 18, NULL, 9, 31.3, 9, 31.3, 0, 0, 0, 0, '347.76', '34.20', NULL, NULL, 4),
(117, 1, 15, 311, 38.64, 4, 182.38, '2018-12-31 14:01:49', 0, 27.82, 18, NULL, 9, 13.91, 9, 13.91, 0, 0, 0, 0, '154.56', '45.60', NULL, NULL, 4),
(118, 1, 15, 312, 77.29, 12, 1094.43, '2018-12-31 14:01:49', 0, 166.95, 18, NULL, 9, 83.475, 9, 83.475, 0, 0, 0, 0, '927.48', '91.20', NULL, NULL, 4),
(119, 1, 15, 313, 115.93, 12, 1641.57, '2018-12-31 14:01:49', 0, 250.41, 18, NULL, 9, 125.205, 9, 125.205, 0, 0, 0, 0, '1391.16', '136.80', NULL, NULL, 4),
(120, 1, 15, 314, 31.86, 12, 451.14, '2018-12-31 14:01:49', 0, 68.82, 18, NULL, 9, 34.41, 9, 34.41, 0, 0, 0, 0, '382.32', '37.59', NULL, NULL, 4),
(121, 1, 15, 315, 29.53, 12, 418.14, '2018-12-31 14:01:49', 0, 63.78, 18, NULL, 9, 31.89, 9, 31.89, 0, 0, 0, 0, '354.36', '34.85', NULL, NULL, 4),
(122, 1, 15, 316, 39.19, 9, 416.2, '2018-12-31 14:01:49', 0, 63.49, 18, NULL, 9, 31.745, 9, 31.745, 0, 0, 0, 0, '352.71', '46.24', NULL, NULL, 4),
(123, 1, 15, 317, 1.48, 10, 17.46, '2018-12-31 14:01:49', 0, 2.66, 18, NULL, 9, 1.33, 9, 1.33, 0, 0, 0, 0, '14.80', '1.75', NULL, NULL, 4),
(124, 1, 15, 318, 2.25, 10, 26.55, '2018-12-31 14:01:49', 0, 4.05, 18, NULL, 9, 2.025, 9, 2.025, 0, 0, 0, 0, '22.50', '2.66', NULL, NULL, 4),
(125, 1, 15, 319, 8.05, 6, 56.99, '2018-12-31 14:01:49', 0, 8.69, 18, NULL, 9, 4.345, 9, 4.345, 0, 0, 0, 0, '48.30', '9.50', NULL, NULL, 4),
(126, 1, 16, 56, 143.85, 5, 383.19, '2019-01-01 11:23:28', 0, 58.45, 18, NULL, 9, 29.225, 9, 29.225, 0, 0, 0, 0, '324.74', '76.64', NULL, NULL, 4),
(127, 1, 16, 57, 318.15, 3, 508.5, '2019-01-01 11:23:28', 0, 77.57, 18, NULL, 9, 38.785, 9, 38.785, 0, 0, 0, 0, '430.93', '169.50', NULL, NULL, 4),
(128, 1, 16, 58, 6, 25, 79.91, '2019-01-01 11:23:28', 0, 12.19, 18, NULL, 9, 6.095, 9, 6.095, 0, 0, 0, 0, '67.72', '3.20', NULL, NULL, 4),
(129, 1, 16, 59, 7.35, 25, 97.89, '2019-01-01 11:23:28', 0, 14.93, 18, NULL, 9, 7.465, 9, 7.465, 0, 0, 0, 0, '82.96', '3.92', NULL, NULL, 4),
(130, 1, 16, 60, 14.55, 50, 387.59, '2019-01-01 11:23:28', 0, 59.12, 18, NULL, 9, 29.56, 9, 29.56, 0, 0, 0, 0, '328.47', '7.75', NULL, NULL, 4),
(131, 1, 16, 61, 28.35, 20, 302.08, '2019-01-01 11:23:28', 0, 46.08, 18, NULL, 9, 23.04, 9, 23.04, 0, 0, 0, 0, '256.00', '15.10', NULL, NULL, 4),
(132, 1, 16, 62, 26.8, 50, 713.91, '2019-01-01 11:23:28', 0, 108.9, 18, NULL, 9, 54.45, 9, 54.45, 0, 0, 0, 0, '605.01', '14.28', NULL, NULL, 4),
(133, 1, 16, 63, 58.8, 20, 626.53, '2019-01-01 11:23:28', 0, 95.57, 18, NULL, 9, 47.785, 9, 47.785, 0, 0, 0, 0, '530.96', '31.33', NULL, NULL, 4),
(134, 1, 16, 64, 17.85, 100, 951, '2019-01-01 11:23:28', 0, 145.07, 18, NULL, 9, 72.535, 9, 72.535, 0, 0, 0, 0, '805.93', '9.51', NULL, NULL, 4),
(135, 1, 16, 65, 43.05, 20, 458.71, '2019-01-01 11:23:28', 0, 69.97, 18, NULL, 9, 34.985, 9, 34.985, 0, 0, 0, 0, '388.74', '22.94', NULL, NULL, 4),
(136, 1, 16, 66, 12.3, 30, 196.59, '2019-01-01 11:23:28', 0, 29.99, 18, NULL, 9, 14.995, 9, 14.995, 0, 0, 0, 0, '166.60', '6.55', NULL, NULL, 4),
(137, 1, 16, 67, 23.9, 20, 254.67, '2019-01-01 11:23:28', 0, 38.85, 18, NULL, 9, 19.425, 9, 19.425, 0, 0, 0, 0, '215.82', '12.73', NULL, NULL, 4),
(138, 1, 16, 68, 29.4, 30, 469.9, '2019-01-01 11:23:28', 0, 71.68, 18, NULL, 9, 35.84, 9, 35.84, 0, 0, 0, 0, '398.22', '15.66', NULL, NULL, 4),
(139, 1, 16, 69, 54.6, 20, 581.79, '2019-01-01 11:23:28', 0, 88.75, 18, NULL, 9, 44.375, 9, 44.375, 0, 0, 0, 0, '493.04', '29.09', NULL, NULL, 4),
(140, 1, 16, 70, 28.35, 25, 377.6, '2019-01-01 11:23:28', 0, 57.6, 18, NULL, 9, 28.8, 9, 28.8, 0, 0, 0, 0, '320.00', '15.10', NULL, NULL, 4),
(141, 1, 16, 71, 47.8, 10, 254.67, '2019-01-01 11:23:28', 0, 38.85, 18, NULL, 9, 19.425, 9, 19.425, 0, 0, 0, 0, '215.82', '25.47', NULL, NULL, 4),
(142, 1, 16, 72, 20.65, 25, 275.05, '2019-01-01 11:23:28', 0, 41.96, 18, NULL, 9, 20.98, 9, 20.98, 0, 0, 0, 0, '233.09', '11.00', NULL, NULL, 4),
(143, 1, 16, 73, 38.15, 10, 203.25, '2019-01-01 11:23:28', 0, 31, 18, NULL, 9, 15.5, 9, 15.5, 0, 0, 0, 0, '172.25', '20.33', NULL, NULL, 4),
(144, 1, 16, 74, 101.75, 10, 542.09, '2019-01-01 11:23:28', 0, 82.69, 18, NULL, 9, 41.345, 9, 41.345, 0, 0, 0, 0, '459.40', '54.21', NULL, NULL, 4),
(145, 1, 16, 75, 59.85, 50, 1594.31, '2019-01-01 11:23:28', 0, 243.2, 18, NULL, 9, 121.6, 9, 121.6, 0, 0, 0, 0, '1351.11', '31.89', NULL, NULL, 4),
(146, 1, 16, 76, 129.15, 20, 1376.14, '2019-01-01 11:23:28', 0, 209.92, 18, NULL, 9, 104.96, 9, 104.96, 0, 0, 0, 0, '1166.22', '68.81', NULL, NULL, 4),
(147, 1, 16, 77, 72.45, 30, 1157.98, '2019-01-01 11:23:28', 0, 176.64, 18, NULL, 9, 88.32, 9, 88.32, 0, 0, 0, 0, '981.34', '38.60', NULL, NULL, 4),
(148, 1, 16, 78, 162.75, 10, 867.09, '2019-01-01 11:23:28', 0, 132.27, 18, NULL, 9, 66.135, 9, 66.135, 0, 0, 0, 0, '734.82', '86.71', NULL, NULL, 4),
(149, 1, 16, 79, 72.1, 50, 1920.64, '2019-01-01 11:23:28', 0, 292.98, 18, NULL, 9, 146.49, 9, 146.49, 0, 0, 0, 0, '1627.66', '38.41', NULL, NULL, 4),
(150, 1, 16, 80, 109.35, 10, 582.59, '2019-01-01 11:23:28', 0, 88.87, 18, NULL, 9, 44.435, 9, 44.435, 0, 0, 0, 0, '493.72', '58.26', NULL, NULL, 4),
(151, 1, 16, 81, 120.05, 75, 4796.92, '2019-01-01 11:23:28', 0, 731.73, 18, NULL, 9, 365.865, 9, 365.865, 0, 0, 0, 0, '4065.19', '63.96', NULL, NULL, 4),
(152, 1, 16, 82, 174.15, 30, 2783.45, '2019-01-01 11:23:28', 0, 424.59, 18, NULL, 9, 212.295, 9, 212.295, 0, 0, 0, 0, '2358.86', '92.78', NULL, NULL, 4),
(153, 1, 16, 83, 75.8, 300, 12115.2, '2019-01-01 11:23:28', 0, 1848.08, 18, NULL, 9, 924.04, 9, 924.04, 0, 0, 0, 0, '10267.11', '40.38', NULL, NULL, 4),
(154, 1, 16, 84, 153.5, 75, 6133.51, '2019-01-01 11:23:28', 0, 935.62, 18, NULL, 9, 467.81, 9, 467.81, 0, 0, 0, 0, '5197.89', '81.78', NULL, NULL, 4),
(155, 1, 16, 85, 83.25, 10, 443.53, '2019-01-01 11:23:28', 0, 67.66, 18, NULL, 9, 33.83, 9, 33.83, 0, 0, 0, 0, '375.87', '44.35', NULL, NULL, 4),
(156, 1, 16, 86, 186.9, 5, 497.88, '2019-01-01 11:23:28', 0, 75.95, 18, NULL, 9, 37.975, 9, 37.975, 0, 0, 0, 0, '421.93', '99.58', NULL, NULL, 4),
(157, 1, 16, 87, 85.05, 5, 226.56, '2019-01-01 11:23:28', 0, 34.56, 18, NULL, 9, 17.28, 9, 17.28, 0, 0, 0, 0, '192.00', '45.31', NULL, NULL, 4),
(158, 1, 16, 88, 140.7, 5, 374.8, '2019-01-01 11:23:28', 0, 57.17, 18, NULL, 9, 28.585, 9, 28.585, 0, 0, 0, 0, '317.63', '74.96', NULL, NULL, 4),
(159, 1, 17, 442, 133.92, 25, 3749.76, '2019-01-01 13:47:59', 0, 401.76, 12, NULL, 6, 200.88, 6, 200.88, 0, 0, 0, 0, '3348.00', '149.99', NULL, NULL, 4),
(160, 1, 18, 443, 456.78, 5, 2695, '2019-01-01 14:56:35', 0, 411.1, 18, NULL, 9, 205.55, 9, 205.55, 0, 0, 0, 0, '2283.90', '539.00', NULL, NULL, 4),
(161, 1, 18, 444, 639.83, 3, 2265, '2019-01-01 14:56:35', 0, 345.51, 18, NULL, 9, 172.755, 9, 172.755, 0, 0, 0, 0, '1919.49', '755.00', NULL, NULL, 4),
(162, 1, 18, 445, 32.2, 24, 911.9, '2019-01-01 14:56:35', 0, 139.1, 18, NULL, 9, 69.55, 9, 69.55, 0, 0, 0, 0, '772.80', '38.00', NULL, NULL, 4),
(163, 1, 18, 446, 78.81, 12, 1115.95, '2019-01-01 14:56:35', 0, 170.23, 18, NULL, 9, 85.115, 9, 85.115, 0, 0, 0, 0, '945.72', '93.00', NULL, NULL, 4),
(164, 1, 18, 447, 111.02, 12, 1572.04, '2019-01-01 14:56:35', 0, 239.8, 18, NULL, 9, 119.9, 9, 119.9, 0, 0, 0, 0, '1332.24', '131.00', NULL, NULL, 4),
(165, 1, 18, 448, 889.83, 1, 1050, '2019-01-01 14:56:35', 0, 160.17, 18, NULL, 9, 80.085, 9, 80.085, 0, 0, 0, 0, '889.83', '1050.00', NULL, NULL, 4),
(166, 1, 18, 449, 805.08, 2, 1899.99, '2019-01-01 14:56:35', 0, 289.83, 18, NULL, 9, 144.915, 9, 144.915, 0, 0, 0, 0, '1610.16', '950.00', NULL, NULL, 4),
(167, 1, 18, 450, 762.71, 1, 900, '2019-01-01 14:56:35', 0, 137.29, 18, NULL, 9, 68.645, 9, 68.645, 0, 0, 0, 0, '762.71', '900.00', NULL, NULL, 4),
(168, 1, 18, 451, 720.34, 1, 850, '2019-01-01 14:56:35', 0, 129.66, 18, NULL, 9, 64.83, 9, 64.83, 0, 0, 0, 0, '720.34', '850.00', NULL, NULL, 4),
(169, 1, 18, 452, 974.58, 1, 1150, '2019-01-01 14:56:35', 0, 175.42, 18, NULL, 9, 87.71, 9, 87.71, 0, 0, 0, 0, '974.58', '1150.00', NULL, NULL, 4),
(170, 1, 18, 453, 1652.54, 1, 1950, '2019-01-01 14:56:35', 0, 297.46, 18, NULL, 9, 148.73, 9, 148.73, 0, 0, 0, 0, '1652.54', '1950.00', NULL, NULL, 4),
(171, 1, 18, 454, 1440.68, 1, 1700, '2019-01-01 14:56:35', 0, 259.32, 18, NULL, 9, 129.66, 9, 129.66, 0, 0, 0, 0, '1440.68', '1700.00', NULL, NULL, 4),
(172, 1, 18, 455, 1398.31, 1, 1650.01, '2019-01-01 14:56:35', 0, 251.7, 18, NULL, 9, 125.85, 9, 125.85, 0, 0, 0, 0, '1398.31', '1650.01', NULL, NULL, 4),
(173, 1, 18, 456, 1038.14, 2, 2450.01, '2019-01-01 14:56:35', 0, 373.73, 18, NULL, 9, 186.865, 9, 186.865, 0, 0, 0, 0, '2076.28', '1225.01', NULL, NULL, 4),
(174, 1, 18, 457, 1122.88, 2, 2650, '2019-01-01 14:56:35', 0, 404.24, 18, NULL, 9, 202.12, 9, 202.12, 0, 0, 0, 0, '2245.76', '1325.00', NULL, NULL, 4),
(175, 1, 18, 458, 1737.29, 2, 4100, '2019-01-01 14:56:35', 0, 625.42, 18, NULL, 9, 312.71, 9, 312.71, 0, 0, 0, 0, '3474.58', '2050.00', NULL, NULL, 4),
(176, 1, 18, 459, 317.8, 2, 750.01, '2019-01-01 14:56:35', 0, 114.41, 18, NULL, 9, 57.205, 9, 57.205, 0, 0, 0, 0, '635.60', '375.00', NULL, NULL, 4),
(201, 1, 19, 360, 0, 100, 7062.3, '2019-01-02 11:32:15', 0, 1077.3, 18, NULL, 9, 538.65, 9, 538.65, 0, 0, 0, 0, '5985.00', '70.62', NULL, NULL, NULL),
(202, 1, 19, 361, 0, 10, 1022.23, '2019-01-02 11:32:15', 0, 155.93, 18, NULL, 9, 77.965, 9, 77.965, 0, 0, 0, 0, '866.30', '102.22', NULL, NULL, NULL),
(203, 1, 19, 362, 0, 40, 4410.84, '2019-01-02 11:32:15', 0, 672.84, 18, NULL, 9, 336.42, 9, 336.42, 0, 0, 0, 0, '3738.00', '110.27', NULL, NULL, NULL),
(204, 1, 19, 363, 0, 20, 2205.42, '2019-01-02 11:32:15', 0, 336.42, 18, NULL, 9, 168.21, 9, 168.21, 0, 0, 0, 0, '1869.00', '110.27', NULL, NULL, NULL),
(205, 1, 19, 364, 0, 100, 7434, '2019-01-02 11:32:15', 0, 1134, 18, NULL, 9, 567, 9, 567, 0, 0, 0, 0, '6300.00', '74.34', NULL, NULL, NULL),
(206, 1, 19, 365, 0, 40, 5377.5, '2019-01-02 11:32:15', 0, 820.3, 18, NULL, 9, 410.15, 9, 410.15, 0, 0, 0, 0, '4557.20', '134.44', NULL, NULL, NULL),
(207, 1, 19, 366, 0, 40, 4856.88, '2019-01-02 11:32:15', 0, 740.88, 18, NULL, 9, 370.44, 9, 370.44, 0, 0, 0, 0, '4116.00', '121.42', NULL, NULL, NULL),
(208, 1, 19, 367, 0, 20, 1338.12, '2019-01-02 11:32:15', 0, 204.12, 18, NULL, 9, 102.06, 9, 102.06, 0, 0, 0, 0, '1134.00', '66.91', NULL, NULL, NULL),
(209, 1, 19, 368, 0, 20, 1747.11, '2019-01-02 11:32:15', 0, 266.51, 18, NULL, 9, 133.255, 9, 133.255, 0, 0, 0, 0, '1480.60', '87.36', NULL, NULL, NULL),
(210, 1, 19, 369, 0, 20, 1412.46, '2019-01-02 11:32:15', 0, 215.46, 18, NULL, 9, 107.73, 9, 107.73, 0, 0, 0, 0, '1197.00', '70.62', NULL, NULL, NULL),
(211, 1, 19, 370, 0, 20, 2267.49, '2019-01-02 11:32:15', 0, 345.89, 18, NULL, 9, 172.945, 9, 172.945, 0, 0, 0, 0, '1921.60', '113.37', NULL, NULL, NULL),
(212, 1, 19, 371, 0, 20, 1610.7, '2019-01-02 11:32:15', 0, 245.7, 18, NULL, 9, 122.85, 9, 122.85, 0, 0, 0, 0, '1365.00', '80.53', NULL, NULL, NULL),
(213, 1, 19, 372, 0, 20, 1536.36, '2019-01-02 11:32:15', 0, 234.36, 18, NULL, 9, 117.18, 9, 117.18, 0, 0, 0, 0, '1302.00', '76.82', NULL, NULL, NULL),
(214, 1, 19, 373, 0, 100, 1673.24, '2019-01-02 11:32:15', 0, 255.24, 18, NULL, 9, 127.62, 9, 127.62, 0, 0, 0, 0, '1418.00', '16.73', NULL, NULL, NULL),
(215, 1, 19, 374, 0, 10, 2509.03, '2019-01-02 11:32:15', 0, 382.73, 18, NULL, 9, 191.365, 9, 191.365, 0, 0, 0, 0, '2126.30', '250.90', NULL, NULL, NULL),
(216, 1, 19, 375, 0, 20, 5389.77, '2019-01-02 11:32:15', 0, 822.17, 18, NULL, 9, 411.085, 9, 411.085, 0, 0, 0, 0, '4567.60', '269.49', NULL, NULL, NULL),
(217, 1, 19, 376, 0, 10, 1939.09, '2019-01-02 11:32:15', 0, 295.79, 18, NULL, 9, 147.895, 9, 147.895, 0, 0, 0, 0, '1643.30', '193.91', NULL, NULL, NULL),
(218, 1, 19, 377, 0, 10, 3939.6, '2019-01-02 11:32:15', 0, 422.1, 12, NULL, 6, 211.05, 6, 211.05, 0, 0, 0, 0, '3517.50', '393.96', NULL, NULL, NULL),
(219, 1, 19, 378, 0, 40, 2031.96, '2019-01-02 11:32:15', 0, 309.96, 18, NULL, 9, 154.98, 9, 154.98, 0, 0, 0, 0, '1722.00', '50.80', NULL, NULL, NULL),
(220, 1, 19, 379, 0, 40, 2031.96, '2019-01-02 11:32:15', 0, 309.96, 18, NULL, 9, 154.98, 9, 154.98, 0, 0, 0, 0, '1722.00', '50.80', NULL, NULL, NULL),
(221, 1, 19, 380, 0, 20, 1276.29, '2019-01-02 11:32:15', 0, 194.69, 18, NULL, 9, 97.345, 9, 97.345, 0, 0, 0, 0, '1081.60', '63.81', NULL, NULL, NULL),
(222, 1, 19, 381, 0, 20, 1548.87, '2019-01-02 11:32:15', 0, 236.27, 18, NULL, 9, 118.135, 9, 118.135, 0, 0, 0, 0, '1312.60', '77.44', NULL, NULL, NULL),
(223, 1, 19, 382, 0, 20, 2118.81, '2019-01-02 11:32:15', 0, 323.21, 18, NULL, 9, 161.605, 9, 161.605, 0, 0, 0, 0, '1795.60', '105.94', NULL, NULL, NULL),
(224, 1, 19, 383, 0, 20, 2986.11, '2019-01-02 11:32:15', 0, 455.51, 18, NULL, 9, 227.755, 9, 227.755, 0, 0, 0, 0, '2530.60', '149.31', NULL, NULL, NULL),
(225, 1, 20, 562, 136.8, 10, 1614.24, '2019-01-04 21:45:42', 0, 246.24, 18, NULL, 9, 123.12, 9, 123.12, 0, 0, 0, 0, '1368.00', '161.42', NULL, NULL, 4),
(226, 1, 20, 563, 165.6, 3, 586.22, '2019-01-04 21:45:42', 0, 89.42, 18, NULL, 9, 44.71, 9, 44.71, 0, 0, 0, 0, '496.80', '195.41', NULL, NULL, 4),
(227, 1, 20, 564, 177.6, 6, 1257.41, '2019-01-04 21:45:42', 0, 191.81, 18, NULL, 9, 95.905, 9, 95.905, 0, 0, 0, 0, '1065.60', '209.57', NULL, NULL, 4),
(228, 1, 20, 565, 273.6, 2, 645.7, '2019-01-04 21:45:42', 0, 98.5, 18, NULL, 9, 49.25, 9, 49.25, 0, 0, 0, 0, '547.20', '322.85', NULL, NULL, 4),
(229, 1, 20, 566, 122.4, 25, 3466.37, '2019-01-04 21:45:42', 0, 528.77, 18, NULL, 9, 264.385, 9, 264.385, 0, 0, 4, 0, '2937.60', '138.65', NULL, NULL, 4),
(230, 1, 20, 567, 106.8, 6, 756.14, '2019-01-04 21:45:42', 0, 115.34, 18, NULL, 9, 57.67, 9, 57.67, 0, 0, 0, 0, '640.80', '126.02', NULL, NULL, 4),
(231, 1, 20, 568, 218.4, 6, 1546.27, '2019-01-04 21:45:42', 0, 235.87, 18, NULL, 9, 117.935, 9, 117.935, 0, 0, 0, 0, '1310.40', '257.71', NULL, NULL, 4),
(232, 1, 20, 569, 268.8, 3, 951.55, '2019-01-04 21:45:42', 0, 145.15, 18, NULL, 9, 72.575, 9, 72.575, 0, 0, 0, 0, '806.40', '317.18', NULL, NULL, 4),
(233, 1, 20, 570, 252, 2, 594.72, '2019-01-04 21:45:42', 0, 90.72, 18, NULL, 9, 45.36, 9, 45.36, 0, 0, 0, 0, '504.00', '297.36', NULL, NULL, 4),
(234, 1, 20, 571, 372, 2, 877.92, '2019-01-04 21:45:42', 0, 133.92, 18, NULL, 9, 66.96, 9, 66.96, 0, 0, 0, 0, '744.00', '438.96', NULL, NULL, 4),
(235, 1, 20, 572, 159.6, 2, 376.66, '2019-01-04 21:45:42', 0, 57.46, 18, NULL, 9, 28.73, 9, 28.73, 0, 0, 0, 0, '319.20', '188.33', NULL, NULL, 4),
(236, 1, 20, 573, 16.8, 30, 594.72, '2019-01-04 21:45:42', 0, 90.72, 18, NULL, 9, 45.36, 9, 45.36, 0, 0, 0, 0, '504.00', '19.82', NULL, NULL, 4),
(237, 1, 20, 574, 138, 2, 325.68, '2019-01-04 21:45:42', 0, 49.68, 18, NULL, 9, 24.84, 9, 24.84, 0, 0, 0, 0, '276.00', '162.84', NULL, NULL, 4),
(238, 1, 21, 575, 36.63, 14, 605.13, '2019-01-04 21:51:58', 0, 92.31, 18, NULL, 9, 46.155, 9, 46.155, 0, 0, 0, 0, '512.82', '43.22', NULL, NULL, 4),
(239, 1, 22, 350, 579.15, 50, 34169.9, '2019-01-05 10:26:02', 0, 5212.35, 18, NULL, 9, 2606.18, 9, 2606.18, 0, 0, 0, 0, '28957.50', '683.40', NULL, NULL, 4),
(240, 1, 22, 351, 868.79, 25, 25629.3, '2019-01-05 10:26:02', 0, 3909.55, 18, NULL, 9, 1954.78, 9, 1954.78, 0, 0, 0, 0, '21719.75', '1025.17', NULL, NULL, 4),
(241, 1, 22, 352, 1393.43, 18, 29596.4, '2019-01-05 10:26:02', 0, 4514.71, 18, NULL, 9, 2257.35, 9, 2257.35, 0, 0, 0, 0, '25081.74', '1644.25', NULL, NULL, 4),
(242, 1, 22, 353, 2049.3, 9, 21763.6, '2019-01-05 10:26:02', 0, 3319.87, 18, NULL, 9, 1659.94, 9, 1659.94, 0, 0, 0, 0, '18443.70', '2418.17', NULL, NULL, 4),
(243, 1, 22, 354, 3093.75, 1, 3650.63, '2019-01-05 10:26:02', 0, 556.88, 18, NULL, 9, 278.44, 9, 278.44, 0, 0, 0, 0, '3093.75', '3650.63', NULL, NULL, 4),
(244, 1, 22, 355, 6.435, 900, 6833.97, '2019-01-05 10:26:02', 0, 1042.47, 18, NULL, 9, 521.235, 9, 521.235, 0, 0, 0, 0, '5791.50', '7.59', NULL, NULL, 4),
(245, 1, 22, 356, 9.65, 450, 5124.15, '2019-01-05 10:26:02', 0, 781.65, 18, NULL, 9, 390.825, 9, 390.825, 0, 0, 0, 0, '4342.50', '11.39', NULL, NULL, 4),
(246, 1, 22, 357, 15.48, 270, 4931.93, '2019-01-05 10:26:02', 0, 752.33, 18, NULL, 9, 376.165, 9, 376.165, 0, 0, 0, 0, '4179.60', '18.27', NULL, NULL, 4),
(247, 1, 22, 358, 22.77, 90, 2418.17, '2019-01-05 10:26:02', 0, 368.87, 18, NULL, 9, 184.435, 9, 184.435, 0, 0, 0, 0, '2049.30', '26.87', NULL, NULL, 4),
(248, 1, 22, 359, 34.375, 180, 7301.25, '2019-01-05 10:26:02', 0, 1113.75, 18, NULL, 9, 556.875, 9, 556.875, 0, 0, 0, 0, '6187.50', '40.56', NULL, NULL, 4);

-- --------------------------------------------------------

--
-- Table structure for table `us_purorder`
--

CREATE TABLE `us_purorder` (
  `pe_billid` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `pe_billnumber` int(11) DEFAULT NULL,
  `pe_customername` varchar(100) DEFAULT NULL,
  `pe_customermobile` int(11) DEFAULT NULL,
  `pe_billdate` datetime DEFAULT NULL,
  `pe_total` float DEFAULT NULL,
  `pe_gtotal` varchar(100) DEFAULT NULL,
  `pe_oldbal` varchar(100) DEFAULT NULL,
  `pe_paidamount` float DEFAULT NULL,
  `pe_paymethod` varchar(200) DEFAULT NULL,
  `pe_note` longtext,
  `pe_updateddate` datetime DEFAULT NULL,
  `pe_updatedby` varchar(250) DEFAULT NULL,
  `pe_isactive` int(11) DEFAULT '0',
  `pe_discount` float DEFAULT NULL,
  `pe_mode` varchar(100) DEFAULT NULL,
  `pe_paydate` datetime DEFAULT NULL,
  `pe_unitprice` int(100) DEFAULT NULL,
  `pe_balance` float DEFAULT NULL,
  `pe_supplierid` varchar(10) DEFAULT NULL,
  `pe_vehicle_number` varchar(100) DEFAULT NULL,
  `pe_invoice_number` varchar(100) DEFAULT NULL,
  `pe_invoice_date` date DEFAULT NULL,
  `pe_statecode` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `us_purorderitems`
--

CREATE TABLE `us_purorderitems` (
  `pi_billitemid` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `pi_billid` int(11) DEFAULT NULL,
  `pi_productid` int(11) DEFAULT NULL,
  `pi_price` float DEFAULT NULL,
  `pi_quantity` float DEFAULT NULL,
  `pi_total` float DEFAULT NULL,
  `pi_updatedon` datetime DEFAULT NULL,
  `pi_isactive` int(11) DEFAULT '0',
  `pi_vatamount` float DEFAULT NULL,
  `pi_vatper` float DEFAULT NULL,
  `pi_unitprice` int(100) DEFAULT NULL,
  `pi_sgst` float DEFAULT NULL,
  `pi_sgstamt` float DEFAULT NULL,
  `pi_cgst` float DEFAULT NULL,
  `pi_cgstamt` float DEFAULT NULL,
  `pi_igst` float DEFAULT NULL,
  `pi_igstamt` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `us_purreturnentry`
--

CREATE TABLE `us_purreturnentry` (
  `pre_billid` int(11) NOT NULL,
  `user_id` varchar(100) DEFAULT NULL,
  `pre_billnumber` int(11) DEFAULT NULL,
  `pre_customername` varchar(600) DEFAULT NULL,
  `pre_customermobile` varchar(20) DEFAULT NULL,
  `pre_customer_tin_num` varchar(100) DEFAULT NULL,
  `pre_vehicle_number` varchar(10) DEFAULT NULL,
  `pre_billdate` datetime DEFAULT NULL,
  `pre_total` float DEFAULT NULL,
  `pre_gtotal` float DEFAULT NULL,
  `pre_paidamount` float DEFAULT NULL,
  `pre_paymethod` varchar(250) DEFAULT NULL,
  `pre_note` longtext,
  `pre_updateddate` datetime DEFAULT NULL,
  `pre_updatedby` varchar(250) DEFAULT NULL,
  `pre_isactive` int(11) DEFAULT '0',
  `pre_discount` float DEFAULT NULL,
  `pre_mode` varchar(100) DEFAULT NULL,
  `pre_paydate` datetime DEFAULT NULL,
  `pre_balance` int(11) DEFAULT NULL,
  `pre_customerid` int(11) DEFAULT NULL,
  `pre_coolie` varchar(100) DEFAULT NULL,
  `pre_oldbal` varchar(100) DEFAULT NULL,
  `pre_totvat` float DEFAULT NULL,
  `pre_invoice_number` varchar(100) DEFAULT NULL,
  `pre_invoice_date` date DEFAULT NULL,
  `pre_rebill` varchar(100) DEFAULT NULL,
  `pre_statecode` varchar(1000) DEFAULT NULL,
  `pre_debitid` int(100) DEFAULT NULL,
  `finyear` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `us_purreturnitem`
--

CREATE TABLE `us_purreturnitem` (
  `pri_billitemid` int(11) NOT NULL,
  `user_id` varchar(100) DEFAULT NULL,
  `pri_billid` int(11) DEFAULT NULL,
  `pri_returnbillid` int(11) DEFAULT NULL,
  `pri_productid` int(11) DEFAULT NULL,
  `pri_price` varchar(100) DEFAULT NULL,
  `pri_quantity` float DEFAULT NULL,
  `pri_total` float DEFAULT NULL,
  `pri_updatedon` datetime DEFAULT NULL,
  `pri_isactive` int(11) DEFAULT NULL,
  `pri_vatamount` float DEFAULT NULL,
  `pri_vatper` float DEFAULT NULL,
  `pri_coolie` float DEFAULT NULL,
  `pri_sgst` float DEFAULT NULL,
  `pri_sgstamt` float DEFAULT NULL,
  `pri_cgst` float DEFAULT NULL,
  `pr_cgstamt` float DEFAULT NULL,
  `pri_igst` float DEFAULT NULL,
  `pri_igstamt` float DEFAULT NULL,
  `pri_billdate` datetime DEFAULT NULL,
  `finyear` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `us_salreturnentry`
--

CREATE TABLE `us_salreturnentry` (
  `sre_billid` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `sre_billnumber` int(11) DEFAULT NULL,
  `sre_customername` varchar(100) DEFAULT NULL,
  `sre_customeraddress` varchar(200) DEFAULT NULL,
  `sre_customermobile` varchar(100) DEFAULT NULL,
  `sre_customer_tin_num` varchar(100) DEFAULT NULL,
  `sre_billdate` datetime DEFAULT NULL,
  `sre_total` float DEFAULT NULL,
  `sre_gtotal` varchar(100) DEFAULT NULL,
  `sre_oldbal` varchar(100) DEFAULT NULL,
  `sre_paidamount` float DEFAULT NULL,
  `sre_paymethod` varchar(200) DEFAULT NULL,
  `sre_note` longtext,
  `sre_updateddate` datetime DEFAULT NULL,
  `sre_updatedby` varchar(250) DEFAULT NULL,
  `sre_isactive` int(11) DEFAULT '0',
  `sre_discount` float DEFAULT NULL,
  `sre_mode` varchar(100) DEFAULT NULL,
  `sre_paydate` datetime DEFAULT NULL,
  `sre_unitprice` int(100) DEFAULT NULL,
  `sre_balance` float DEFAULT NULL,
  `sre_supplierid` int(10) DEFAULT NULL,
  `sre_vehicle_number` varchar(100) DEFAULT NULL,
  `sre_rebill` varchar(100) DEFAULT NULL,
  `sre_statecode` varchar(1000) DEFAULT NULL,
  `sre_debitid` int(100) DEFAULT NULL,
  `sre_creditid` int(100) DEFAULT NULL,
  `finyear` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `us_salreturnitem`
--

CREATE TABLE `us_salreturnitem` (
  `sri_billitemid` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `sri_billid` int(11) DEFAULT NULL,
  `sri_returnbillid` int(11) DEFAULT NULL,
  `sri_productid` int(11) DEFAULT NULL,
  `sri_price` float DEFAULT NULL,
  `sri_quantity` float DEFAULT NULL,
  `sri_total` float DEFAULT NULL,
  `sri_updatedon` datetime DEFAULT NULL,
  `sri_isactive` int(11) DEFAULT NULL,
  `sri_vatamount` float DEFAULT NULL,
  `sri_vatper` float DEFAULT NULL,
  `sri_unitprice` float DEFAULT NULL,
  `sri_sgst` float DEFAULT NULL,
  `sri_sgstamt` float DEFAULT NULL,
  `sri_cgst` float DEFAULT NULL,
  `sri_cgstamt` float DEFAULT NULL,
  `sri_igst` float DEFAULT NULL,
  `sri_igstamt` float DEFAULT NULL,
  `sri_billdate` datetime DEFAULT NULL,
  `finyear` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `us_shopprofile`
--

CREATE TABLE `us_shopprofile` (
  `sp_shopid` int(11) NOT NULL,
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
  `sp_tin` varchar(100) DEFAULT NULL,
  `sp_cst` varchar(200) DEFAULT NULL,
  `sp_adddate` date DEFAULT NULL,
  `sp_acnttype` int(11) DEFAULT '0' COMMENT '(0)trail(1)payed',
  `sp_trlprd` int(11) DEFAULT NULL,
  `sp_barcode` varchar(10) DEFAULT NULL,
  `sp_stcode` varchar(1000) DEFAULT NULL,
  `sp_accno` varchar(100) DEFAULT NULL,
  `sp_ifsc` varchar(100) DEFAULT NULL,
  `sp_bank` varchar(100) DEFAULT NULL,
  `sp_branch` varchar(100) DEFAULT NULL,
  `sp_pan` varchar(100) DEFAULT NULL,
  `sp_city` varchar(100) DEFAULT NULL,
  `sp_district` varchar(100) DEFAULT NULL,
  `sp_pin` varchar(100) DEFAULT NULL,
  `sp_licenseno` varchar(100) DEFAULT NULL,
  `finyear` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `us_shopprofile`
--

INSERT INTO `us_shopprofile` (`sp_shopid`, `sp_shopname`, `sp_shopaddress`, `sp_phone`, `sp_mobile`, `sp_email`, `sp_logo`, `sp_username`, `sp_password`, `sp_isactive`, `sp_vatreadymades`, `sp_vatmillgoods`, `sp_tin`, `sp_cst`, `sp_adddate`, `sp_acnttype`, `sp_trlprd`, `sp_barcode`, `sp_stcode`, `sp_accno`, `sp_ifsc`, `sp_bank`, `sp_branch`, `sp_pan`, `sp_city`, `sp_district`, `sp_pin`, `sp_licenseno`, `finyear`) VALUES
(1, 'Victory Electrical & Plumbing Materials', 'TB Junction-Kalladikode, Palakkad', '9747032888', '9048336904', 'victoryelectricalskkd@gmail.com', NULL, 'ADMIN', 'ADMIN', 0, 0, 0, '32EVEPP1404A1ZC', '', '2018-12-24', 1, 5, 'US-ebiller', 'KL', '', '', 'SBI', 'Palakkad', '202302202302', ' Manjery', 'Malappuram', '676121', '1412467', 0),
(2, 'Victory', 'Kalladikode', '', '', '', NULL, 'new', '123', 0, 0, 0, '', '', '2017-06-23', 1, 1, 'US-ebiller', 'KL', '', '', 'SBI', 'Palakkad', '202302202302', ' Manjery', 'Malappuram', '676121', '1412467', 0);

-- --------------------------------------------------------

--
-- Table structure for table `us_stockreport`
--

CREATE TABLE `us_stockreport` (
  `sr_itemid` int(11) NOT NULL,
  `sr_date` datetime NOT NULL,
  `sr_qty` varchar(100) NOT NULL,
  `sr_amount` varchar(100) NOT NULL,
  `sr_closingstock` varchar(100) NOT NULL,
  `sr_mode` varchar(100) NOT NULL,
  `finyear` int(11) NOT NULL,
  `sr_id` int(11) NOT NULL,
  `billid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `us_stockreport`
--

INSERT INTO `us_stockreport` (`sr_itemid`, `sr_date`, `sr_qty`, `sr_amount`, `sr_closingstock`, `sr_mode`, `finyear`, `sr_id`, `billid`) VALUES
(7, '2018-12-26 12:14:00', '300', '600', '300', 'Purchase', 4, 12, 2),
(8, '2018-12-26 12:14:00', '200', '1400', '200', 'Purchase', 4, 13, 2),
(9, '2018-12-26 12:14:00', '200', '0', '200', 'Purchase', 4, 14, 2),
(10, '2018-12-26 12:14:00', '100', '200', '100', 'Purchase', 4, 15, 2),
(11, '2018-12-26 12:14:00', '200', '400', '200', 'Purchase', 4, 16, 2),
(12, '2018-12-26 12:49:00', '50', '150', '50', 'Purchase', 4, 17, 3),
(13, '2018-12-26 12:49:00', '50', '350', '50', 'Purchase', 4, 18, 3),
(14, '2018-12-26 12:49:00', '50', '200', '50', 'Purchase', 4, 19, 3),
(15, '2018-12-26 12:49:00', '250', '0', '250', 'Purchase', 4, 20, 3),
(16, '2018-12-26 12:49:00', '125', '0', '125', 'Purchase', 4, 21, 3),
(17, '2018-12-26 12:49:00', '250', '0', '250', 'Purchase', 4, 22, 3),
(18, '2018-12-26 12:49:00', '200', '0', '200', 'Purchase', 4, 23, 3),
(19, '2018-12-26 12:49:00', '150', '0', '150', 'Purchase', 4, 24, 3),
(20, '2018-12-26 12:49:00', '125', '0', '125', 'Purchase', 4, 25, 3),
(21, '2018-12-26 12:49:00', '75', '0', '75', 'Purchase', 4, 26, 3),
(22, '2018-12-26 12:49:00', '50', '0', '50', 'Purchase', 4, 27, 3),
(23, '2018-12-26 12:49:00', '35', '0', '35', 'Purchase', 4, 28, 3),
(24, '2018-12-26 12:49:00', '250', '0', '250', 'Purchase', 4, 29, 3),
(25, '2018-12-26 12:49:00', '125', '0', '125', 'Purchase', 4, 30, 3),
(26, '2018-12-26 14:00:00', '1000', '4000', '1000', 'Purchase', 4, 31, 4),
(27, '2018-12-26 14:00:00', '500', '0', '500', 'Purchase', 4, 32, 4),
(28, '2018-12-26 14:00:00', '1000', '7000', '1000', 'Purchase', 4, 33, 4),
(29, '2018-12-26 14:00:00', '500', '2500', '500', 'Purchase', 4, 34, 4),
(30, '2018-12-26 14:00:00', '24', '0', '24', 'Purchase', 4, 35, 4),
(31, '2018-12-26 14:00:00', '24', '0', '24', 'Purchase', 4, 36, 4),
(32, '2018-12-26 14:00:00', '24', '0', '24', 'Purchase', 4, 37, 4),
(33, '2018-12-26 14:00:00', '12', '0', '12', 'Purchase', 4, 38, 4),
(34, '2018-12-26 14:00:00', '12', '0', '12', 'Purchase', 4, 39, 4),
(35, '2018-12-26 14:00:00', '12', '0', '12', 'Purchase', 4, 40, 4),
(36, '2018-12-26 14:30:00', '6', '24', '6', 'Purchase', 4, 41, 5),
(37, '2018-12-26 14:30:00', '6', '0', '6', 'Purchase', 4, 42, 5),
(38, '2018-12-26 14:30:00', '12', '72', '12', 'Purchase', 4, 43, 5),
(39, '2018-12-26 14:30:00', '100', '600', '100', 'Purchase', 4, 44, 5),
(40, '2018-12-26 14:30:00', '100', '0', '100', 'Purchase', 4, 45, 5),
(41, '2018-12-26 14:30:00', '200', '0', '200', 'Purchase', 4, 46, 5),
(42, '2018-12-26 14:30:00', '40', '0', '40', 'Purchase', 4, 47, 5),
(43, '2018-12-26 14:30:00', '50', '0', '50', 'Purchase', 4, 48, 5),
(44, '2018-12-26 14:30:00', '50', '0', '50', 'Purchase', 4, 49, 5),
(45, '2018-12-26 14:30:00', '12', '0', '12', 'Purchase', 4, 50, 5),
(46, '2018-12-26 14:30:00', '12', '0', '12', 'Purchase', 4, 51, 5),
(47, '2018-12-26 14:30:00', '36', '0', '36', 'Purchase', 4, 52, 5),
(2, '2018-12-24 14:12:00', '400', '-1218', '-406', 'Sales', 4, 53, 4),
(48, '2018-12-27 14:08:00', '24', '144', '24', 'Purchase', 4, 54, 6),
(49, '2018-12-27 14:08:00', '48', '0', '48', 'Purchase', 4, 55, 6),
(52, '2018-12-27 14:08:00', '12', '84', '12', 'Purchase', 4, 56, 6),
(50, '2018-12-27 14:08:00', '6', '0', '6', 'Purchase', 4, 57, 6),
(51, '2018-12-27 14:08:00', '48', '0', '48', 'Purchase', 4, 58, 6),
(53, '2018-12-27 14:15:00', '10', '30', '10', 'Purchase', 4, 59, 7),
(54, '2018-12-27 14:15:00', '24', '0', '24', 'Purchase', 4, 60, 7),
(55, '2018-12-27 14:15:00', '12', '0', '12', 'Purchase', 4, 61, 7),
(344, '2018-12-31 11:07:00', '90', '90', '90', 'Purchase', 4, 62, 8),
(345, '2018-12-31 11:07:00', '150', '450', '150', 'Purchase', 4, 63, 8),
(346, '2018-12-31 11:07:00', '300', '1500', '300', 'Purchase', 4, 64, 8),
(347, '2018-12-31 11:07:00', '30', '180', '30', 'Purchase', 4, 65, 8),
(342, '2018-12-31 11:07:00', '12', '108', '12', 'Purchase', 4, 66, 8),
(343, '2018-12-31 11:07:00', '12', '0', '12', 'Purchase', 4, 67, 8),
(348, '2018-12-31 11:07:00', '10', '0', '10', 'Purchase', 4, 68, 8),
(349, '2018-12-31 11:07:00', '5', '0', '5', 'Purchase', 4, 69, 8),
(335, '2018-12-31 11:15:00', '4', '4', '4', 'Purchase', 4, 70, 9),
(336, '2018-12-31 11:15:00', '3', '24', '3', 'Purchase', 4, 71, 9),
(337, '2018-12-31 11:15:00', '6', '0', '6', 'Purchase', 4, 72, 9),
(338, '2018-12-31 11:15:00', '10', '90', '10', 'Purchase', 4, 73, 9),
(339, '2018-12-31 11:15:00', '30', '270', '30', 'Purchase', 4, 74, 9),
(340, '2018-12-31 11:15:00', '24', '0', '24', 'Purchase', 4, 75, 9),
(341, '2018-12-31 11:15:00', '24', '0', '24', 'Purchase', 4, 76, 9),
(320, '2018-12-31 12:08:00', '6', '6', '6', 'Purchase', 4, 77, 10),
(321, '2018-12-31 12:08:00', '6', '6', '6', 'Purchase', 4, 78, 10),
(322, '2018-12-31 12:08:00', '9', '45', '9', 'Purchase', 4, 79, 10),
(323, '2018-12-31 12:08:00', '9', '0', '9', 'Purchase', 4, 80, 10),
(324, '2018-12-31 12:08:00', '9', '0', '9', 'Purchase', 4, 81, 10),
(325, '2018-12-31 12:08:00', '9', '9', '9', 'Purchase', 4, 82, 10),
(326, '2018-12-31 12:08:00', '2', '0', '2', 'Purchase', 4, 83, 10),
(327, '2018-12-31 12:08:00', '2', '0', '2', 'Purchase', 4, 84, 10),
(328, '2018-12-31 12:08:00', '2', '0', '2', 'Purchase', 4, 85, 10),
(329, '2018-12-31 12:08:00', '12', '0', '12', 'Purchase', 4, 86, 10),
(330, '2018-12-31 12:08:00', '12', '0', '12', 'Purchase', 4, 87, 10),
(331, '2018-12-31 12:18:00', '6', '30', '6', 'Purchase', 4, 88, 11),
(332, '2018-12-31 12:18:00', '6', '0', '6', 'Purchase', 4, 89, 11),
(333, '2018-12-31 12:27:00', '1', '5', '1', 'Purchase', 4, 90, 12),
(334, '2018-12-31 12:27:00', '1', '7', '1', 'Purchase', 4, 91, 12),
(234, '2018-12-31 13:07:00', '150', '600', '150', 'Purchase', 4, 92, 13),
(235, '2018-12-31 13:07:00', '30', '180', '30', 'Purchase', 4, 93, 13),
(236, '2018-12-31 13:07:00', '30', '0', '30', 'Purchase', 4, 94, 13),
(281, '2018-12-31 13:30:00', '150', '450', '150', 'Purchase', 4, 95, 14),
(282, '2018-12-31 13:30:00', '100', '200', '100', 'Purchase', 4, 96, 14),
(283, '2018-12-31 13:30:00', '50', '0', '50', 'Purchase', 4, 97, 14),
(441, '2018-12-31 13:30:00', '50', '350', '50', 'Purchase', 4, 98, 14),
(285, '2018-12-31 13:36:00', '6', '6', '6', 'Purchase', 4, 99, 15),
(286, '2018-12-31 13:36:00', '6', '48', '6', 'Purchase', 4, 100, 15),
(287, '2018-12-31 13:36:00', '6', '30', '6', 'Purchase', 4, 101, 15),
(288, '2018-12-31 13:36:00', '4', '0', '4', 'Purchase', 4, 102, 15),
(289, '2018-12-31 13:36:00', '2', '0', '2', 'Purchase', 4, 103, 15),
(290, '2018-12-31 13:36:00', '30', '0', '30', 'Purchase', 4, 104, 15),
(291, '2018-12-31 13:36:00', '30', '0', '30', 'Purchase', 4, 105, 15),
(292, '2018-12-31 13:36:00', '30', '0', '30', 'Purchase', 4, 106, 15),
(293, '2018-12-31 13:36:00', '30', '0', '30', 'Purchase', 4, 107, 15),
(294, '2018-12-31 13:36:00', '30', '0', '30', 'Purchase', 4, 108, 15),
(295, '2018-12-31 13:36:00', '30', '0', '30', 'Purchase', 4, 109, 15),
(296, '2018-12-31 13:36:00', '30', '0', '30', 'Purchase', 4, 110, 15),
(297, '2018-12-31 13:36:00', '50', '0', '50', 'Purchase', 4, 111, 15),
(298, '2018-12-31 13:36:00', '30', '0', '30', 'Purchase', 4, 112, 15),
(299, '2018-12-31 13:36:00', '30', '0', '30', 'Purchase', 4, 113, 15),
(300, '2018-12-31 13:36:00', '30', '0', '30', 'Purchase', 4, 114, 15),
(301, '2018-12-31 13:36:00', '21', '0', '21', 'Purchase', 4, 115, 15),
(302, '2018-12-31 13:36:00', '24', '0', '24', 'Purchase', 4, 116, 15),
(303, '2018-12-31 13:36:00', '10', '0', '10', 'Purchase', 4, 117, 15),
(304, '2018-12-31 13:36:00', '12', '0', '12', 'Purchase', 4, 118, 15),
(305, '2018-12-31 13:36:00', '12', '0', '12', 'Purchase', 4, 119, 15),
(306, '2018-12-31 13:36:00', '12', '0', '12', 'Purchase', 4, 120, 15),
(307, '2018-12-31 13:36:00', '12', '0', '12', 'Purchase', 4, 121, 15),
(308, '2018-12-31 13:36:00', '12', '0', '12', 'Purchase', 4, 122, 15),
(309, '2018-12-31 13:36:00', '12', '0', '12', 'Purchase', 4, 123, 15),
(310, '2018-12-31 13:36:00', '12', '0', '12', 'Purchase', 4, 124, 15),
(311, '2018-12-31 13:36:00', '4', '0', '4', 'Purchase', 4, 125, 15),
(312, '2018-12-31 13:36:00', '12', '0', '12', 'Purchase', 4, 126, 15),
(313, '2018-12-31 13:36:00', '12', '0', '12', 'Purchase', 4, 127, 15),
(314, '2018-12-31 13:36:00', '12', '0', '12', 'Purchase', 4, 128, 15),
(315, '2018-12-31 13:36:00', '12', '0', '12', 'Purchase', 4, 129, 15),
(316, '2018-12-31 13:36:00', '9', '0', '9', 'Purchase', 4, 130, 15),
(317, '2018-12-31 13:36:00', '10', '0', '10', 'Purchase', 4, 131, 15),
(318, '2018-12-31 13:36:00', '10', '0', '10', 'Purchase', 4, 132, 15),
(319, '2018-12-31 13:36:00', '6', '0', '6', 'Purchase', 4, 133, 15),
(56, '2019-01-01 11:03:00', '5', '35', '5', 'Purchase', 4, 134, 16),
(57, '2019-01-01 11:03:00', '3', '18', '3', 'Purchase', 4, 135, 16),
(58, '2019-01-01 11:03:00', '25', '50', '25', 'Purchase', 4, 136, 16),
(59, '2019-01-01 11:03:00', '25', '50', '25', 'Purchase', 4, 137, 16),
(60, '2019-01-01 11:03:00', '50', '0', '50', 'Purchase', 4, 138, 16),
(61, '2019-01-01 11:03:00', '20', '0', '20', 'Purchase', 4, 139, 16),
(62, '2019-01-01 11:03:00', '50', '0', '50', 'Purchase', 4, 140, 16),
(63, '2019-01-01 11:03:00', '20', '0', '20', 'Purchase', 4, 141, 16),
(64, '2019-01-01 11:03:00', '100', '0', '100', 'Purchase', 4, 142, 16),
(65, '2019-01-01 11:03:00', '20', '0', '20', 'Purchase', 4, 143, 16),
(66, '2019-01-01 11:03:00', '30', '0', '30', 'Purchase', 4, 144, 16),
(67, '2019-01-01 11:03:00', '20', '0', '20', 'Purchase', 4, 145, 16),
(68, '2019-01-01 11:03:00', '30', '0', '30', 'Purchase', 4, 146, 16),
(69, '2019-01-01 11:03:00', '20', '0', '20', 'Purchase', 4, 147, 16),
(70, '2019-01-01 11:03:00', '25', '0', '25', 'Purchase', 4, 148, 16),
(71, '2019-01-01 11:03:00', '10', '0', '10', 'Purchase', 4, 149, 16),
(72, '2019-01-01 11:03:00', '25', '0', '25', 'Purchase', 4, 150, 16),
(73, '2019-01-01 11:03:00', '10', '0', '10', 'Purchase', 4, 151, 16),
(74, '2019-01-01 11:03:00', '10', '0', '10', 'Purchase', 4, 152, 16),
(75, '2019-01-01 11:03:00', '50', '0', '50', 'Purchase', 4, 153, 16),
(76, '2019-01-01 11:03:00', '20', '0', '20', 'Purchase', 4, 154, 16),
(77, '2019-01-01 11:03:00', '30', '0', '30', 'Purchase', 4, 155, 16),
(78, '2019-01-01 11:03:00', '10', '0', '10', 'Purchase', 4, 156, 16),
(79, '2019-01-01 11:03:00', '50', '0', '50', 'Purchase', 4, 157, 16),
(80, '2019-01-01 11:03:00', '10', '0', '10', 'Purchase', 4, 158, 16),
(81, '2019-01-01 11:03:00', '75', '0', '75', 'Purchase', 4, 159, 16),
(82, '2019-01-01 11:03:00', '30', '0', '30', 'Purchase', 4, 160, 16),
(83, '2019-01-01 11:03:00', '300', '0', '300', 'Purchase', 4, 161, 16),
(84, '2019-01-01 11:03:00', '75', '0', '75', 'Purchase', 4, 162, 16),
(85, '2019-01-01 11:03:00', '10', '0', '10', 'Purchase', 4, 163, 16),
(86, '2019-01-01 11:03:00', '5', '0', '5', 'Purchase', 4, 164, 16),
(87, '2019-01-01 11:03:00', '5', '0', '5', 'Purchase', 4, 165, 16),
(88, '2019-01-01 11:03:00', '5', '0', '5', 'Purchase', 4, 166, 16),
(442, '2019-01-01 13:43:00', '25', '26', '26', 'Purchase', 4, 167, 17),
(443, '2019-01-01 14:51:00', '5', '25', '5', 'Purchase', 4, 168, 18),
(444, '2019-01-01 14:51:00', '3', '15', '3', 'Purchase', 4, 169, 18),
(445, '2019-01-01 14:51:00', '24', '0', '24', 'Purchase', 4, 170, 18),
(446, '2019-01-01 14:51:00', '12', '0', '12', 'Purchase', 4, 171, 18),
(447, '2019-01-01 14:51:00', '12', '0', '12', 'Purchase', 4, 172, 18),
(448, '2019-01-01 14:51:00', '1', '0', '1', 'Purchase', 4, 173, 18),
(449, '2019-01-01 14:51:00', '2', '0', '2', 'Purchase', 4, 174, 18),
(450, '2019-01-01 14:51:00', '1', '0', '1', 'Purchase', 4, 175, 18),
(451, '2019-01-01 14:51:00', '1', '0', '1', 'Purchase', 4, 176, 18),
(452, '2019-01-01 14:51:00', '1', '0', '1', 'Purchase', 4, 177, 18),
(453, '2019-01-01 14:51:00', '1', '0', '1', 'Purchase', 4, 178, 18),
(454, '2019-01-01 14:51:00', '1', '0', '1', 'Purchase', 4, 179, 18),
(455, '2019-01-01 14:51:00', '1', '0', '1', 'Purchase', 4, 180, 18),
(456, '2019-01-01 14:51:00', '2', '0', '2', 'Purchase', 4, 181, 18),
(457, '2019-01-01 14:51:00', '2', '0', '2', 'Purchase', 4, 182, 18),
(458, '2019-01-01 14:51:00', '2', '0', '2', 'Purchase', 4, 183, 18),
(459, '2019-01-01 14:51:00', '2', '0', '2', 'Purchase', 4, 184, 18),
(360, '2019-01-02 10:31:00', '100', '700', '100', 'Purchase', 4, 185, 19),
(361, '2019-01-02 10:31:00', '10', '0', '10', 'Purchase', 4, 186, 19),
(362, '2019-01-02 10:31:00', '40', '0', '40', 'Purchase', 4, 187, 19),
(363, '2019-01-02 10:31:00', '20', '0', '20', 'Purchase', 4, 188, 19),
(364, '2019-01-02 10:31:00', '100', '400', '100', 'Purchase', 4, 189, 19),
(365, '2019-01-02 10:31:00', '40', '160', '40', 'Purchase', 4, 190, 19),
(366, '2019-01-02 10:31:00', '40', '0', '40', 'Purchase', 4, 191, 19),
(367, '2019-01-02 10:31:00', '20', '0', '20', 'Purchase', 4, 192, 19),
(368, '2019-01-02 10:31:00', '20', '0', '20', 'Purchase', 4, 193, 19),
(369, '2019-01-02 10:31:00', '20', '0', '20', 'Purchase', 4, 194, 19),
(370, '2019-01-02 10:31:00', '20', '0', '20', 'Purchase', 4, 195, 19),
(371, '2019-01-02 10:31:00', '20', '0', '20', 'Purchase', 4, 196, 19),
(372, '2019-01-02 10:31:00', '20', '0', '20', 'Purchase', 4, 197, 19),
(373, '2019-01-02 10:31:00', '100', '0', '100', 'Purchase', 4, 198, 19),
(374, '2019-01-02 10:31:00', '10', '0', '10', 'Purchase', 4, 199, 19),
(375, '2019-01-02 10:31:00', '20', '0', '20', 'Purchase', 4, 200, 19),
(376, '2019-01-02 10:31:00', '10', '0', '10', 'Purchase', 4, 201, 19),
(377, '2019-01-02 10:31:00', '10', '0', '10', 'Purchase', 4, 202, 19),
(378, '2019-01-02 10:31:00', '40', '0', '40', 'Purchase', 4, 203, 19),
(379, '2019-01-02 10:31:00', '40', '0', '40', 'Purchase', 4, 204, 19),
(380, '2019-01-02 10:31:00', '20', '0', '20', 'Purchase', 4, 205, 19),
(381, '2019-01-02 10:31:00', '20', '0', '20', 'Purchase', 4, 206, 19),
(382, '2019-01-02 10:31:00', '20', '0', '20', 'Purchase', 4, 207, 19),
(383, '2019-01-02 10:31:00', '20', '0', '20', 'Purchase', 4, 208, 19),
(562, '2019-01-04 21:36:00', '10', '10', '10', 'Purchase', 4, 211, 20),
(563, '2019-01-04 21:36:00', '3', '27', '3', 'Purchase', 4, 212, 20),
(564, '2019-01-04 21:36:00', '6', '54', '6', 'Purchase', 4, 213, 20),
(565, '2019-01-04 21:36:00', '2', '0', '2', 'Purchase', 4, 214, 20),
(566, '2019-01-04 21:36:00', '25', '150', '25', 'Purchase', 4, 215, 20),
(567, '2019-01-04 21:36:00', '6', '12', '6', 'Purchase', 4, 216, 20),
(568, '2019-01-04 21:36:00', '6', '0', '6', 'Purchase', 4, 217, 20),
(569, '2019-01-04 21:36:00', '3', '0', '3', 'Purchase', 4, 218, 20),
(570, '2019-01-04 21:36:00', '2', '0', '2', 'Purchase', 4, 219, 20),
(571, '2019-01-04 21:36:00', '2', '0', '2', 'Purchase', 4, 220, 20),
(572, '2019-01-04 21:36:00', '2', '0', '2', 'Purchase', 4, 221, 20),
(573, '2019-01-04 21:36:00', '30', '0', '30', 'Purchase', 4, 222, 20),
(574, '2019-01-04 21:36:00', '2', '0', '2', 'Purchase', 4, 223, 20),
(575, '2019-01-04 21:49:00', '14', '56', '14', 'Purchase', 4, 224, 21),
(350, '2019-01-05 09:30:00', '50', '300', '50', 'Purchase', 4, 225, 22),
(351, '2019-01-05 09:30:00', '25', '0', '25', 'Purchase', 4, 226, 22),
(352, '2019-01-05 09:30:00', '18', '72', '18', 'Purchase', 4, 227, 22),
(353, '2019-01-05 09:30:00', '9', '72', '9', 'Purchase', 4, 228, 22),
(354, '2019-01-05 09:30:00', '1', '0', '1', 'Purchase', 4, 229, 22),
(355, '2019-01-05 09:30:00', '900', '0', '900', 'Purchase', 4, 230, 22),
(356, '2019-01-05 09:30:00', '450', '0', '450', 'Purchase', 4, 231, 22),
(357, '2019-01-05 09:30:00', '270', '0', '270', 'Purchase', 4, 232, 22),
(358, '2019-01-05 09:30:00', '90', '0', '90', 'Purchase', 4, 233, 22),
(359, '2019-01-05 09:30:00', '180', '0', '180', 'Purchase', 4, 234, 22);

-- --------------------------------------------------------

--
-- Table structure for table `us_supplier`
--

CREATE TABLE `us_supplier` (
  `rs_supplierid` int(11) NOT NULL,
  `rs_company_name` varchar(100) DEFAULT NULL,
  `rs_name` varchar(50) DEFAULT NULL,
  `rs_phone` varchar(20) DEFAULT NULL,
  `rs_mobile` varchar(20) DEFAULT NULL,
  `rs_address` longtext,
  `rs_email` varchar(100) DEFAULT NULL,
  `rs_balance` varchar(10) DEFAULT NULL,
  `rs_isactive` int(11) DEFAULT '0',
  `rs_tinnum` varchar(100) DEFAULT NULL,
  `user_id` varchar(10) DEFAULT NULL,
  `rs_acntid` varchar(100) DEFAULT NULL,
  `rs_statecode` varchar(1000) DEFAULT NULL,
  `rs_category` varchar(100) DEFAULT NULL,
  `rs_regno` varchar(100) DEFAULT NULL,
  `finyear` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `us_supplier`
--

INSERT INTO `us_supplier` (`rs_supplierid`, `rs_company_name`, `rs_name`, `rs_phone`, `rs_mobile`, `rs_address`, `rs_email`, `rs_balance`, `rs_isactive`, `rs_tinnum`, `user_id`, `rs_acntid`, `rs_statecode`, `rs_category`, `rs_regno`, `finyear`) VALUES
(2, 'STAR PLASTICS', 'STAR PLASTICS', '7907443863', NULL, 'THRISSUR', '', '0', 0, '32AAKFS1090C1ZL', '1', '77', 'KL', NULL, NULL, NULL),
(3, 'SHARON PLAST', 'SHARON PLAST', '04912832786', NULL, 'MUNDUR, PALAKKAD', '', '0', 0, '32AKIPS1684C1Z9', '1', '79', 'KL', NULL, NULL, NULL),
(4, 'SHARON EXTRUSIONS', 'SHARON EXTRUSIONS', '04912832680', NULL, 'MUNDUR, PALAKKAD', '', '0', 0, '32AANFS2676K1ZR', '1', '80', 'KL', NULL, NULL, NULL),
(5, 'SANKAR PLASTIC MOULDINGS', 'SANKAR PLASTIC MOULDINGS', '9539885635', NULL, 'KOTTEKKAD P O, PALAKKAD', '', '0', 0, '32CFRPB3809L1ZC', '1', '81', 'KL', NULL, NULL, NULL),
(6, 'JEEVA GRANITES', 'JEEVA GRANITES', '9446147006', NULL, 'OLAVAKKODE, PALAKKAD', '', '0', 0, '32AALFJ4195J1Z2', '1', '82', 'KL', NULL, NULL, NULL),
(7, 'KMT TILES AND SANITARYWARES', 'KMT TILES AND SANITARYWARES', '9447530273', NULL, 'PONNIAKURUSSI, PERINTHALMANNA', '', '0', 0, '32AAFFK3546E1ZP', '1', '83', 'KL', NULL, NULL, NULL),
(8, 'VALLUVANAD TILES', 'KMT', '9447530273', NULL, 'PONNIAKURUSSI, PERINTHALMANNA', '', '0', 0, '32ABPPJ8553K1Z7', '1', '84', 'KL', NULL, NULL, NULL),
(9, 'WATERTEC INDIA PVT LTD', 'WATERTEC INDIA PVT LTD', '04912538715', NULL, 'KADAMKODE,KARINGARAPULLY, PALAKKAD', '', '0', 0, '32AAACW1645GIZO', '1', '85', 'KL', NULL, NULL, NULL),
(10, 'SPINNER MARKETING', 'SPINNER MARKETING', '9387822502,048722060', NULL, 'ATHANI P O , THRISSUR', '', '11270', 0, '32ABAFS6757P1ZM', '1', '86', 'KL', NULL, NULL, NULL),
(11, 'TUBES AND TUBINGS', 'CONSEAL', '04842649808', NULL, 'PERUMBAVOOR, ERNAKULAM', '', '0', 0, '32AISPS8557L1ZA', '1', '87', 'KL', NULL, NULL, NULL),
(12, 'J & J ENTERPRISES', 'J & J ENTERPRISES', '04933225302', NULL, 'KODUVAYIKKAL BUILDING, OOTTY ROAD, PERINTHALMANNA', '', '0', 0, '32AACFJ0914A1ZB', '1', '88', 'KL', NULL, NULL, NULL),
(13, 'POWER SOLUTIONS', 'POWER SOLUTIONS', '7025885887', NULL, 'CHANDRANAGAR P O, PALAKKAD', '', '3750', 0, '32ARIPP6321Q1ZD', '1', '89', 'KL', NULL, NULL, NULL),
(14, 'VERTEX MARKETING', 'VERTEX MARKETING', '9846845088', NULL, 'EZHAKKAD, KONGAD, PALAKKAD', '', '29660', 0, '32BBPPR5134M1Z7', '1', '90', 'KL', NULL, NULL, NULL),
(15, 'GM IMPEX', 'GM IMPEX', '04952773555', NULL, 'RED CROSS RAOD, CALICUT', '', '0', 0, '32AAJFG5630R1Z1', '1', '91', 'KL', NULL, NULL, NULL),
(16, 'PRIYA AGENCIES', 'PRIYA AGENCIES', '04872449288', NULL, 'CHITTILAPILLY TOWER, KANIMANGALAM P O, THRISSUR', '', '0', 0, '32AAGFP1500L1ZM', '1', '93', 'KL', NULL, NULL, NULL),
(17, 'SIGNET ASSOCIATES', 'SIGNET ASSOCIATES', '8606266777', NULL, 'VANIYAMKULAM, OTTAPALAM', '', '0', 0, '32ACJFS4685A1Z7', '1', '94', 'KL', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `us_transaction`
--

CREATE TABLE `us_transaction` (
  `tr_id` int(11) NOT NULL,
  `tr_billid` int(11) DEFAULT NULL,
  `tr_particulars` varchar(500) DEFAULT NULL,
  `tr_openingbalance` float DEFAULT NULL,
  `tr_transactionamount` float DEFAULT NULL,
  `tr_closingbalance` float DEFAULT NULL,
  `tr_date` datetime DEFAULT NULL,
  `tr_transactiontype` varchar(500) DEFAULT NULL,
  `tr_isactive` int(11) DEFAULT '0',
  `tr_updateddate` datetime DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `tr_mode` int(10) DEFAULT '0',
  `pay_type` varchar(100) DEFAULT NULL,
  `cus_id` varchar(100) DEFAULT NULL,
  `tr_name` varchar(100) DEFAULT NULL,
  `tr_accid` int(100) DEFAULT NULL,
  `finyear` int(100) DEFAULT NULL,
  `rpt_no` varchar(100) NOT NULL,
  `rpt_status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `us_transaction`
--

INSERT INTO `us_transaction` (`tr_id`, `tr_billid`, `tr_particulars`, `tr_openingbalance`, `tr_transactionamount`, `tr_closingbalance`, `tr_date`, `tr_transactiontype`, `tr_isactive`, `tr_updateddate`, `user_id`, `tr_mode`, `pay_type`, `cus_id`, `tr_name`, `tr_accid`, `finyear`, `rpt_no`, `rpt_status`) VALUES
(1, 1, 'Sales', 0, 1650, 1650, '2018-12-24 13:16:00', 'income', 1, NULL, 1, 0, NULL, NULL, NULL, NULL, 4, '', ''),
(2, 2, 'Sales', 1650, 1650, 3300, '2018-12-24 13:21:00', 'income', 1, NULL, 1, 0, NULL, NULL, NULL, NULL, 4, '', ''),
(3, 3, 'Sales', 3300, 1650, 4950, '2018-12-24 13:24:00', 'income', 1, NULL, 1, 0, NULL, NULL, NULL, NULL, 4, '', ''),
(4, 1, 'Purchase', 4950, 299, 4651, '2018-12-24 14:05:00', 'expense', 1, NULL, 1, 0, NULL, NULL, NULL, NULL, 4, '', ''),
(6, 5, 'Sales', 4661, 30, 4691, '2018-12-24 15:18:00', 'income', 1, NULL, 1, 0, NULL, NULL, NULL, NULL, 4, '', ''),
(7, 6, 'Sales', 4691, 17, 4708, '2018-12-24 15:40:00', 'income', 1, NULL, 1, 0, NULL, NULL, NULL, NULL, 4, '', ''),
(8, 7, 'Sales', 4708, 2400, 7108, '2018-12-24 16:34:00', 'income', 1, NULL, 1, 0, NULL, NULL, NULL, NULL, 4, '', ''),
(9, 1, 'Purchase', 7108, 33581, -26473, '2018-12-26 12:14:00', 'expense', 0, NULL, 1, 0, NULL, NULL, NULL, NULL, 4, '', ''),
(10, 2, 'Purchase', -26473, 123397, -149870, '2018-12-26 12:49:00', 'expense', 0, NULL, 1, 0, NULL, NULL, NULL, NULL, 4, '', ''),
(11, 3, 'Purchase', -149870, 11762, -161632, '2018-12-26 14:00:00', 'expense', 0, NULL, 1, 0, NULL, NULL, NULL, NULL, 4, '', ''),
(12, 4, 'Purchase', -161632, 9238.19, -170870, '2018-12-26 14:30:00', 'expense', 0, NULL, 1, 0, NULL, NULL, NULL, NULL, 4, '', ''),
(13, 8, 'Sales', -170870, 31, -170839, '2018-12-26 13:47:00', 'income', 1, NULL, 1, 0, NULL, NULL, NULL, NULL, 4, '', ''),
(14, 4, 'Sales', -170839, 1320, -169519, '2018-12-24 14:12:00', 'income', 0, NULL, 1, 0, NULL, NULL, NULL, NULL, 4, '', ''),
(15, 5, 'Purchase', -169519, 7119, -176638, '2018-12-27 14:08:00', 'expense', 0, NULL, 1, 0, NULL, NULL, NULL, NULL, 4, '', ''),
(16, 6, 'Purchase', -176638, 3894, -180532, '2018-12-27 14:15:00', 'expense', 0, NULL, 1, 0, NULL, NULL, NULL, NULL, 4, '', ''),
(17, 7, 'Purchase', -180532, 9521, -190053, '2018-12-31 11:07:00', 'expense', 0, NULL, 1, 0, NULL, NULL, NULL, NULL, 4, '', ''),
(18, 8, 'Purchase', -190053, 8358, -198411, '2018-12-31 11:15:00', 'expense', 0, NULL, 1, 0, NULL, NULL, NULL, NULL, 4, '', ''),
(19, 9, 'Purchase', -198411, 64675, -263086, '2018-12-31 12:08:00', 'expense', 0, NULL, 1, 0, NULL, NULL, NULL, NULL, 4, '', ''),
(20, 10, 'Purchase', -263086, 4020, -267106, '2018-12-31 12:18:00', 'expense', 0, NULL, 1, 0, NULL, NULL, NULL, NULL, 4, '', ''),
(21, 11, 'Purchase', -267106, 11700, -278806, '2018-12-31 12:27:00', 'expense', 0, NULL, 1, 0, NULL, NULL, NULL, NULL, 4, '', ''),
(22, 12, 'Purchase', -278806, 0, -278806, '2018-12-31 13:07:00', 'expense', 0, NULL, 1, 0, NULL, NULL, NULL, NULL, 4, '', ''),
(23, 13, 'Purchase', -278806, 14875, -293681, '2018-12-31 13:30:00', 'expense', 0, NULL, 1, 0, NULL, NULL, NULL, NULL, 4, '', ''),
(24, 14, 'Purchase', -293681, 23658.1, -317339, '2018-12-31 13:36:00', 'expense', 0, NULL, 1, 0, NULL, NULL, NULL, NULL, 4, '', ''),
(25, 15, 'Purchase', -317339, 42536, -359875, '2019-01-01 11:03:00', 'expense', 0, NULL, 1, 0, NULL, NULL, NULL, NULL, 4, '', ''),
(26, 16, 'Purchase', -359875, 0, -359875, '2019-01-01 13:43:00', 'expense', 0, NULL, 1, 0, NULL, NULL, NULL, NULL, 4, '', ''),
(27, 17, 'Purchase', -359875, 69726, -359875, '2019-01-01 14:51:00', 'expense', 0, NULL, 1, 0, NULL, NULL, NULL, NULL, 4, '', ''),
(28, 18, 'Purchase', -359875, 69726, -429601, '2019-01-02 10:31:00', 'expense', 0, NULL, 1, 0, NULL, NULL, NULL, NULL, 4, '', ''),
(29, 9, 'Sales', -429601, 310, -429291, '2019-01-03 17:38:00', 'income', 1, NULL, 1, 0, NULL, NULL, NULL, NULL, 4, '', ''),
(30, 18, 'Purchase', -429291, 13594, -442885, '2019-01-04 21:36:00', 'expense', 0, NULL, 1, 0, NULL, NULL, NULL, NULL, 4, '', ''),
(31, 19, 'Purchase', -442885, 605, -443490, '2019-01-04 21:49:00', 'expense', 0, NULL, 1, 0, NULL, NULL, NULL, NULL, 4, '', ''),
(32, 20, 'Purchase', -443490, 141419, -584909, '2019-01-05 09:30:00', 'expense', 0, NULL, 1, 0, NULL, NULL, NULL, NULL, 4, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `vm_h2report`
--

CREATE TABLE `vm_h2report` (
  `h2_id` int(11) NOT NULL,
  `h2_productid` int(11) NOT NULL,
  `h2_qty` int(11) NOT NULL,
  `h2_supmode` int(11) NOT NULL,
  `h2_cusmode` int(11) NOT NULL,
  `h2_saleorpr` varchar(11) NOT NULL,
  `h2_adddate` datetime NOT NULL,
  `h2_updated` datetime NOT NULL,
  `h2_bibillid` int(11) NOT NULL,
  `h2_pibillid` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `finyear` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrator_account_name`
--
ALTER TABLE `administrator_account_name`
  ADD PRIMARY KEY (`refid`);

--
-- Indexes for table `administrator_daybook`
--
ALTER TABLE `administrator_daybook`
  ADD PRIMARY KEY (`refid`);

--
-- Indexes for table `us_allentry`
--
ALTER TABLE `us_allentry`
  ADD PRIMARY KEY (`h2_id`);

--
-- Indexes for table `us_billentry`
--
ALTER TABLE `us_billentry`
  ADD PRIMARY KEY (`be_billid`);

--
-- Indexes for table `us_billitems`
--
ALTER TABLE `us_billitems`
  ADD PRIMARY KEY (`bi_billitemid`);

--
-- Indexes for table `us_catogory`
--
ALTER TABLE `us_catogory`
  ADD PRIMARY KEY (`ca_categoryid`);

--
-- Indexes for table `us_customer`
--
ALTER TABLE `us_customer`
  ADD PRIMARY KEY (`cs_customerid`);

--
-- Indexes for table `us_elec`
--
ALTER TABLE `us_elec`
  ADD PRIMARY KEY (`el_id`);

--
-- Indexes for table `us_estimation`
--
ALTER TABLE `us_estimation`
  ADD PRIMARY KEY (`be_billid`);

--
-- Indexes for table `us_estimationitems`
--
ALTER TABLE `us_estimationitems`
  ADD PRIMARY KEY (`bi_billitemid`);

--
-- Indexes for table `us_financialyear`
--
ALTER TABLE `us_financialyear`
  ADD PRIMARY KEY (`fy_id`);

--
-- Indexes for table `us_godown`
--
ALTER TABLE `us_godown`
  ADD PRIMARY KEY (`gd_id`);

--
-- Indexes for table `us_groupheads`
--
ALTER TABLE `us_groupheads`
  ADD PRIMARY KEY (`gr_id`);

--
-- Indexes for table `us_note`
--
ALTER TABLE `us_note`
  ADD PRIMARY KEY (`be_billid`);

--
-- Indexes for table `us_payment`
--
ALTER TABLE `us_payment`
  ADD PRIMARY KEY (`pa_paymentid`);

--
-- Indexes for table `us_products`
--
ALTER TABLE `us_products`
  ADD PRIMARY KEY (`pr_productid`);

--
-- Indexes for table `us_purentry`
--
ALTER TABLE `us_purentry`
  ADD PRIMARY KEY (`pe_billid`);

--
-- Indexes for table `us_puritems`
--
ALTER TABLE `us_puritems`
  ADD PRIMARY KEY (`pi_billitemid`);

--
-- Indexes for table `us_purorder`
--
ALTER TABLE `us_purorder`
  ADD PRIMARY KEY (`pe_billid`);

--
-- Indexes for table `us_purorderitems`
--
ALTER TABLE `us_purorderitems`
  ADD PRIMARY KEY (`pi_billitemid`);

--
-- Indexes for table `us_purreturnentry`
--
ALTER TABLE `us_purreturnentry`
  ADD PRIMARY KEY (`pre_billid`);

--
-- Indexes for table `us_purreturnitem`
--
ALTER TABLE `us_purreturnitem`
  ADD PRIMARY KEY (`pri_billitemid`);

--
-- Indexes for table `us_salreturnentry`
--
ALTER TABLE `us_salreturnentry`
  ADD PRIMARY KEY (`sre_billid`);

--
-- Indexes for table `us_salreturnitem`
--
ALTER TABLE `us_salreturnitem`
  ADD PRIMARY KEY (`sri_billitemid`);

--
-- Indexes for table `us_shopprofile`
--
ALTER TABLE `us_shopprofile`
  ADD PRIMARY KEY (`sp_shopid`);

--
-- Indexes for table `us_stockreport`
--
ALTER TABLE `us_stockreport`
  ADD PRIMARY KEY (`sr_id`);

--
-- Indexes for table `us_supplier`
--
ALTER TABLE `us_supplier`
  ADD PRIMARY KEY (`rs_supplierid`);

--
-- Indexes for table `us_transaction`
--
ALTER TABLE `us_transaction`
  ADD PRIMARY KEY (`tr_id`);

--
-- Indexes for table `vm_h2report`
--
ALTER TABLE `vm_h2report`
  ADD PRIMARY KEY (`h2_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrator_account_name`
--
ALTER TABLE `administrator_account_name`
  MODIFY `refid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `administrator_daybook`
--
ALTER TABLE `administrator_daybook`
  MODIFY `refid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `us_allentry`
--
ALTER TABLE `us_allentry`
  MODIFY `h2_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `us_billentry`
--
ALTER TABLE `us_billentry`
  MODIFY `be_billid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `us_billitems`
--
ALTER TABLE `us_billitems`
  MODIFY `bi_billitemid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `us_catogory`
--
ALTER TABLE `us_catogory`
  MODIFY `ca_categoryid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `us_customer`
--
ALTER TABLE `us_customer`
  MODIFY `cs_customerid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `us_elec`
--
ALTER TABLE `us_elec`
  MODIFY `el_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `us_estimation`
--
ALTER TABLE `us_estimation`
  MODIFY `be_billid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `us_estimationitems`
--
ALTER TABLE `us_estimationitems`
  MODIFY `bi_billitemid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `us_financialyear`
--
ALTER TABLE `us_financialyear`
  MODIFY `fy_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `us_godown`
--
ALTER TABLE `us_godown`
  MODIFY `gd_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `us_groupheads`
--
ALTER TABLE `us_groupheads`
  MODIFY `gr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `us_note`
--
ALTER TABLE `us_note`
  MODIFY `be_billid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `us_payment`
--
ALTER TABLE `us_payment`
  MODIFY `pa_paymentid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `us_products`
--
ALTER TABLE `us_products`
  MODIFY `pr_productid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=654;

--
-- AUTO_INCREMENT for table `us_purentry`
--
ALTER TABLE `us_purentry`
  MODIFY `pe_billid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `us_puritems`
--
ALTER TABLE `us_puritems`
  MODIFY `pi_billitemid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=249;

--
-- AUTO_INCREMENT for table `us_purorder`
--
ALTER TABLE `us_purorder`
  MODIFY `pe_billid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `us_purorderitems`
--
ALTER TABLE `us_purorderitems`
  MODIFY `pi_billitemid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `us_purreturnentry`
--
ALTER TABLE `us_purreturnentry`
  MODIFY `pre_billid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `us_purreturnitem`
--
ALTER TABLE `us_purreturnitem`
  MODIFY `pri_billitemid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `us_salreturnentry`
--
ALTER TABLE `us_salreturnentry`
  MODIFY `sre_billid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `us_salreturnitem`
--
ALTER TABLE `us_salreturnitem`
  MODIFY `sri_billitemid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `us_shopprofile`
--
ALTER TABLE `us_shopprofile`
  MODIFY `sp_shopid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `us_stockreport`
--
ALTER TABLE `us_stockreport`
  MODIFY `sr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=235;

--
-- AUTO_INCREMENT for table `us_supplier`
--
ALTER TABLE `us_supplier`
  MODIFY `rs_supplierid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `us_transaction`
--
ALTER TABLE `us_transaction`
  MODIFY `tr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `vm_h2report`
--
ALTER TABLE `vm_h2report`
  MODIFY `h2_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
