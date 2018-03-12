-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2017 at 07:09 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `training`
--

-- --------------------------------------------------------

--
-- Table structure for table `address_details`
--

CREATE TABLE IF NOT EXISTS `address_details` (
  `Address_id` int(11) NOT NULL AUTO_INCREMENT,
  `Address_Street` varchar(50) NOT NULL,
  `Address_city` varchar(50) NOT NULL,
  `Address_state` varchar(50) NOT NULL,
  `Address_zipcode` int(11) NOT NULL,
  `Address_country` varchar(50) NOT NULL,
  `Address_email` varchar(100) NOT NULL,
  `Address_phone1` varchar(20) NOT NULL,
  `Address_phone2` varchar(20) NOT NULL,
  `Address_phone3` varchar(20) NOT NULL,
  `Address_create_dt` datetime NOT NULL,
  `Address_update_dt` datetime NOT NULL,
  PRIMARY KEY (`Address_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `address_details`
--

INSERT INTO `address_details` (`Address_id`, `Address_Street`, `Address_city`, `Address_state`, `Address_zipcode`, `Address_country`, `Address_email`, `Address_phone1`, `Address_phone2`, `Address_phone3`, `Address_create_dt`, `Address_update_dt`) VALUES
(1, 'lic', 'coimbatore', 'tamilnadu', 632012, 'india', 'muthu@gmail.com', '95855655654', '95855655654', '95855655654', '2017-06-03 18:43:29', '0000-00-00 00:00:00'),
(2, 'palani street', 'Coimbatore', 'Tamil nadu', 632014, 'India', 'mani124@gmail.com', '9585445554', '', '', '2017-06-05 10:45:24', '2017-06-05 11:42:57'),
(3, 'vel street', 'Vellore', 'Tamil nadu', 632012, 'India', 'john@gmail.com', '95875545254', '', '', '2017-06-05 12:35:38', '2017-06-05 12:39:50'),
(4, 'Lic', 'Vellore', 'Tamil nadu', 632012, 'India', 'mage@gmail.com', '9685452141', '', '', '2017-06-05 12:37:15', '2017-06-05 12:39:14'),
(5, 'Lic Colony', 'Vellore', 'Tamil nadu', 632012, 'India', 'magesh@gmail.com', '8675752575', '', '', '2017-06-05 16:25:04', '0000-00-00 00:00:00'),
(6, 'Thennaimara st', 'Vellore', 'Tamil nadu', 632012, 'India', 'balaji', '9565656555', '', '', '2017-06-05 16:54:09', '0000-00-00 00:00:00'),
(7, 'cmc', 'Vellore', 'Tamil nadu', 632012, 'India', 'monishrko@gmail.com', '98774545452', '', '', '2017-06-05 16:55:28', '0000-00-00 00:00:00'),
(8, 'mnc', 'Vellore', 'Tamil nadu', 632014, 'India', 'logu@gmail.com', '85454454457', '', '', '2017-06-05 16:56:51', '0000-00-00 00:00:00'),
(9, 'ganesh', 'Vellore', 'Tamil nadu', 652101, 'India', 'arjun@gmail.com', '75221421455', '', '', '2017-06-05 16:58:37', '0000-00-00 00:00:00'),
(10, 'edayarpalayam', 'Coimbatore', 'Tamil nadu', 632012, 'India', 'kar@gmail.com', '95544212141', '', '', '2017-06-05 16:59:41', '0000-00-00 00:00:00'),
(11, 'Lic', 'Coimbatore', 'Tamil nadu', 632510, 'India', 'krish@gmail.com', '9564233221', '', '', '2017-06-05 17:00:41', '0000-00-00 00:00:00'),
(12, 'Then', 'Coimbatore', 'Tamil nadu', 632012, 'India', 'pra@gmail.com', '9536633224', '', '', '2017-06-05 17:01:42', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `customerxdebtor`
--

CREATE TABLE IF NOT EXISTS `customerxdebtor` (
  `cxd_id` int(11) NOT NULL,
  `debtor_id` int(11) NOT NULL COMMENT 'refer by debtors table',
  `cust_id` int(11) NOT NULL COMMENT 'refer by customer table',
  `cxd_prince_amt` double NOT NULL,
  `cxd_int_fees` double NOT NULL,
  `cxd_status` int(11) NOT NULL,
  `cxd_last_service_date` datetime NOT NULL,
  `cxd_ServiceRepID` int(11) NOT NULL,
  `cxd_created_dt` datetime NOT NULL,
  `cxd_updated_dt` datetime NOT NULL,
  `cxd_deleted` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customer_details`
--

CREATE TABLE IF NOT EXISTS `customer_details` (
  `Cus_id` int(11) NOT NULL AUTO_INCREMENT,
  `Cus_firstname` varchar(50) NOT NULL,
  `Cus_lastname` varchar(50) NOT NULL,
  `Cus_code` varchar(50) NOT NULL,
  `Cus_company` varchar(50) NOT NULL,
  `Cus_address` int(11) NOT NULL,
  `Cus_plan_type` varchar(50) NOT NULL,
  `Cus_plan_desc` text NOT NULL,
  `Cus_employee_id` int(11) NOT NULL,
  `Cus_notes` text NOT NULL,
  `Cus_status` int(11) NOT NULL,
  `Cus_create_dt` datetime NOT NULL,
  `Cus_update_dt` datetime NOT NULL,
  `Cus_deleted` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Cus_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `customer_details`
--

INSERT INTO `customer_details` (`Cus_id`, `Cus_firstname`, `Cus_lastname`, `Cus_code`, `Cus_company`, `Cus_address`, `Cus_plan_type`, `Cus_plan_desc`, `Cus_employee_id`, `Cus_notes`, `Cus_status`, `Cus_create_dt`, `Cus_update_dt`, `Cus_deleted`) VALUES
(1, 'Muthu', 'kumar', '2058', 'Velan', 1, 'normal', 'desc', 1, 'notes', 1, '2017-06-03 18:43:29', '2017-06-05 12:00:17', 0),
(2, 'Mani', 'kandan k', '2015', 'Velaninfo', 2, 'Advance', 'description', 2, 'notes test', 1, '2017-06-05 10:45:25', '2017-06-05 12:00:20', 0),
(3, 'John', 'livigston', '2254', 'CTS', 3, 'Normal', 'desc test ', 5, 'test', 1, '2017-06-05 12:35:38', '2017-06-06 10:36:23', 1),
(4, 'Mahendran', 'P', '2035', 'Gamesa', 4, 'adv', 'ssdsdsds', 4, 'dssdsd', 1, '2017-06-05 12:37:15', '2017-06-06 10:33:13', 1),
(5, 'Balaji', 'k', '2019', 'Jain', 6, 'normal', 'dfg', 1, 'test', 1, '2017-06-05 16:54:09', '2017-06-06 10:17:29', 1),
(6, 'Monish', 'kumar', '2018', 'KGM', 7, 'plan', 'test', 2, 'test', 1, '2017-06-05 16:55:28', '2017-06-06 10:16:32', 1),
(7, 'logu', 'P', '6202', 'B&B', 8, 'plan', 'desc', 1, 'otes', 1, '2017-06-05 16:56:51', '2017-06-06 10:15:48', 1),
(8, 'Arjun', 'kumar', '5021', 'Daffo', 9, 'Plan', 'dfgdgfj', 2, 'dfdf', 1, '2017-06-05 16:58:37', '2017-06-06 10:06:50', 1),
(9, 'Karthick', 'raj', '2056', 'Velan', 10, 'type', 'dsfsdf', 1, 'sdfsd', 1, '2017-06-05 16:59:41', '2017-06-06 09:57:10', 1),
(10, 'krishna', 'S', '6325', 'AGS', 11, 'plan', 'fsdfsdf', 2, 'sdfsd', 1, '2017-06-05 17:00:41', '2017-06-06 09:57:30', 1),
(11, 'prakash', 'O', '2017', 'SMS', 12, 'plan', 'shgdf', 1, 'fdsdfdsf', 1, '2017-06-05 17:01:42', '2017-06-06 09:57:02', 1);

-- --------------------------------------------------------

--
-- Table structure for table `debtor_status`
--

CREATE TABLE IF NOT EXISTS `debtor_status` (
  `debt_status_id` int(11) NOT NULL AUTO_INCREMENT,
  `debt_status_abrev` varchar(200) NOT NULL,
  `debt_status_description` text NOT NULL,
  `debt_status_created_dt` datetime NOT NULL,
  `debt_status_updated_dt` datetime NOT NULL,
  `debt_deleted` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`debt_status_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `debtor_status`
--

INSERT INTO `debtor_status` (`debt_status_id`, `debt_status_abrev`, `debt_status_description`, `debt_status_created_dt`, `debt_status_updated_dt`, `debt_deleted`) VALUES
(1, 'ACC-CLOSED\r\n', 'Acc. Reported to the Credit Bureau\r\n', '2017-06-03 00:00:00', '0000-00-00 00:00:00', 0),
(2, 'Active\r\n', 'Active in Collections\r\n', '2017-06-03 00:00:00', '0000-00-00 00:00:00', 0),
(3, 'Biz Closed\r\n', 'Closed-Bus. Not in Operations\r\n', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(4, 'C-BankRpt\r\n', 'Closed-Bankrupt\r\n', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(5, 'C-CCC\r\n', 'Closed-Credit Concelling\r\n', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(6, 'C-Client\r\n', 'Closed by Client\r\n', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(7, 'C-Deceased\r\n', 'Closed-Deceased\r\n', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(8, 'C-Legal\r\n', 'Recommend Legal Action\r\n', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(9, 'C-Minor\r\n', 'Closed-Minor', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(10, 'C-PartPay\r\n', 'Part Payment\n', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(11, 'Error\r\n', 'Error\n', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(12, 'Hold-Client\r\n', 'Hold by Client\n', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(13, 'IMPORT\r\n', 'Import No match\n', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(14, 'Legal Phase\r\n', 'Legal Phase 2\n', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(15, 'No Match\r\n', 'No match\n', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(16, 'NSF\r\n', 'Cheque Returned\n', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(17, 'PDC''S (CLNT)\r\n', 'Post Dated Cheques with Client\n', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(18, 'PDC''S (LCMC)\r\n', 'Post Dated Cheques on file\n', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(19, 'PIF\r\n', 'Closed-Paid in Full\n', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(20, 'Review Legal\r\n', 'Legal Phase 1\nLegal Phase 1\n', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(21, 'SIF\r\n', 'Closed-Settled in Full.\n', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `deptors_details`
--

CREATE TABLE IF NOT EXISTS `deptors_details` (
  `deptors_id` int(11) NOT NULL AUTO_INCREMENT,
  `deptors_ac_type` varchar(50) NOT NULL,
  `deptors_ref_no` varchar(50) NOT NULL,
  `deptors_firstname` varchar(50) NOT NULL,
  `deptors_lastname` varchar(50) NOT NULL,
  `deptors_address` int(11) NOT NULL,
  `deptors_debtors_owing` double NOT NULL,
  `deptors_attachment` text NOT NULL,
  `deptors_notes` text NOT NULL,
  `deptors_create_dt` datetime NOT NULL,
  PRIMARY KEY (`deptors_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `employee_details`
--

CREATE TABLE IF NOT EXISTS `employee_details` (
  `Emp_id` int(11) NOT NULL AUTO_INCREMENT,
  `Emp_firstname` varchar(50) NOT NULL,
  `Emp_lastname` varchar(50) NOT NULL,
  `Emp_create_dt` datetime NOT NULL,
  `Emp_deleted` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Emp_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `employee_details`
--

INSERT INTO `employee_details` (`Emp_id`, `Emp_firstname`, `Emp_lastname`, `Emp_create_dt`, `Emp_deleted`) VALUES
(1, 'mani', 'm', '2017-06-05 15:21:53', 0),
(2, 'John', 'Livingston', '2017-06-05 16:08:29', 0);

-- --------------------------------------------------------

--
-- Table structure for table `status_details`
--

CREATE TABLE IF NOT EXISTS `status_details` (
  `Status_id` int(11) NOT NULL AUTO_INCREMENT,
  `Status_adrev` varchar(10) NOT NULL,
  `Status_desc` varchar(10) NOT NULL,
  `Status_create_dt` datetime NOT NULL,
  `Status_update_dt` datetime NOT NULL,
  `Status_deleted` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Status_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `status_details`
--

INSERT INTO `status_details` (`Status_id`, `Status_adrev`, `Status_desc`, `Status_create_dt`, `Status_update_dt`, `Status_deleted`) VALUES
(1, 'Active', 'Active', '2017-06-03 00:00:00', '0000-00-00 00:00:00', 0),
(2, 'Deny', 'Deny', '2017-06-03 00:00:00', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `userxcustomer`
--

CREATE TABLE IF NOT EXISTS `userxcustomer` (
  `User_x_cus_id` int(11) NOT NULL AUTO_INCREMENT,
  `User_id` int(11) NOT NULL,
  `User_cus_id` int(11) NOT NULL,
  `User_cus_cretae_dt` datetime NOT NULL,
  `User_deleted` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`User_x_cus_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `userxcustomer`
--

INSERT INTO `userxcustomer` (`User_x_cus_id`, `User_id`, `User_cus_id`, `User_cus_cretae_dt`, `User_deleted`) VALUES
(1, 2, 4, '2017-06-05 15:21:08', 0);

-- --------------------------------------------------------

--
-- Table structure for table `userxemployee`
--

CREATE TABLE IF NOT EXISTS `userxemployee` (
  `User_x_emp_id` int(11) NOT NULL AUTO_INCREMENT,
  `User_id` int(11) NOT NULL,
  `User_emp_id` int(11) NOT NULL,
  `User_cus_cretae_dt` datetime NOT NULL,
  `User_deleted` int(11) NOT NULL,
  PRIMARY KEY (`User_x_emp_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `userxemployee`
--

INSERT INTO `userxemployee` (`User_x_emp_id`, `User_id`, `User_emp_id`, `User_cus_cretae_dt`, `User_deleted`) VALUES
(1, 3, 1, '2017-06-05 15:21:53', 0),
(2, 4, 2, '2017-06-05 16:08:29', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE IF NOT EXISTS `user_details` (
  `User_id` int(11) NOT NULL AUTO_INCREMENT,
  `User_firstname` varchar(50) NOT NULL,
  `User_lastname` varchar(50) NOT NULL,
  `User_username` varchar(50) NOT NULL,
  `User_password` varchar(50) NOT NULL,
  `User_type_id` int(11) NOT NULL COMMENT 'refer by user type table',
  `User_status` int(11) NOT NULL,
  `User_create_dt` datetime NOT NULL,
  `User_update_dt` datetime NOT NULL,
  `User_deleted` int(11) NOT NULL,
  PRIMARY KEY (`User_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`User_id`, `User_firstname`, `User_lastname`, `User_username`, `User_password`, `User_type_id`, `User_status`, `User_create_dt`, `User_update_dt`, `User_deleted`) VALUES
(1, 'Muthu', 'kumar', 'muthu', 'muthu', 1, 1, '2017-06-05 15:20:36', '2017-06-05 15:46:09', 0),
(2, 'magi', 'p', 'magi', 'magi', 2, 1, '2017-06-05 15:21:08', '2017-06-05 15:56:19', 0),
(3, 'mani', 'm', 'mani', 'mani', 3, 1, '2017-06-05 15:21:53', '2017-06-05 15:57:05', 0),
(4, 'John', 'Livingston', 'john', 'john', 3, 1, '2017-06-05 16:08:29', '0000-00-00 00:00:00', 0),
(5, 'Adminstrator', 'A', 'admin', 'admin', 1, 1, '2017-06-05 18:39:51', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_types`
--

CREATE TABLE IF NOT EXISTS `user_types` (
  `User_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `User_type` varchar(20) NOT NULL,
  `User_type_level` varchar(20) NOT NULL,
  `User_type_create_dt` datetime NOT NULL,
  `User_type_update_dt` datetime NOT NULL,
  `User_type_deleted` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`User_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user_types`
--

INSERT INTO `user_types` (`User_type_id`, `User_type`, `User_type_level`, `User_type_create_dt`, `User_type_update_dt`, `User_type_deleted`) VALUES
(1, 'Admin', '0', '2017-06-03 00:00:00', '0000-00-00 00:00:00', 0),
(2, 'Customer', '10', '2017-06-03 00:00:00', '0000-00-00 00:00:00', 0),
(3, 'Employee', '20', '2017-06-03 00:00:00', '0000-00-00 00:00:00', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
