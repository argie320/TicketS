-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 08, 2014 at 02:14 AM
-- Server version: 5.6.11
-- PHP Version: 5.5.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `steadfast`
--
CREATE DATABASE IF NOT EXISTS `steadfast` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `steadfast`;

-- --------------------------------------------------------

--
-- Table structure for table `gagamit`
--

CREATE TABLE IF NOT EXISTS `gagamit` (
  `registration_date` datetime DEFAULT NULL,
  `user_name` varchar(255) NOT NULL,
  `pass_word` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `position` int(1) NOT NULL,
  `company` varchar(255) DEFAULT NULL,
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(11) DEFAULT NULL,
  `register` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `user_name` (`user_name`,`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `gagamit`
--

INSERT INTO `gagamit` (`registration_date`, `user_name`, `pass_word`, `email`, `fullname`, `phone`, `mobile`, `position`, `company`, `ID`, `type`, `register`) VALUES
('2014-07-24 17:40:21', 'csr', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 'derechoandro@gmail.com', 'Andro Derecho', '093234234', '03992342', 0, 'Atomit Biz Soln', 1, 1, 0),
('2014-08-01 14:36:42', 'supervisor', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 'derechoandro@yahoo.com', 'Melaine', '23423423', '9325551294', 1, 'Jump Solutions Inc.', 2, 0, 0),
('2014-08-01 14:36:42', 'engineer_vonryan', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'andro.derecho@atomitsoln.com', 'Vonryan', '23423423', '9325551294', 2, 'Jump Solutions Inc.', 3, 0, 0),
('2014-09-04 12:53:33', 'argiecsr', 'fba9bcec58ec16c59389ab110f33df597d6406868e1144ccc662ff58ac84088a', 'blah@gmail.com', 'csrargie', '', '9999999999', 0, 'Jump Solutions Inc.', 14, 0, 0),
('2014-09-11 09:19:12', 'admin', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 'admin@gmail.com', 'admin', '', '9999999999', 3, 'Jump Solutions Inc.', 15, 0, 0),
('2014-09-29 09:36:45', 'Argiesv', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 'Argie_sv@gmail.com', 'supervisorargie', '', '', 1, 'Steadfast Solutions Inc.', 16, 0, 0),
('2014-09-29 09:43:11', 'argieengr', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 'areeSVN320@gmail.com', 'Engineer argie', '', '', 2, 'Jump Solutions Inc.', 17, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sv_ticket_details`
--

CREATE TABLE IF NOT EXISTS `sv_ticket_details` (
  `sv_number` int(11) NOT NULL,
  `log_ID` int(20) NOT NULL AUTO_INCREMENT,
  `subject` varchar(255) NOT NULL,
  `issue` varchar(255) NOT NULL,
  `remarks` varchar(255) NOT NULL,
  PRIMARY KEY (`log_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `sv_ticket_details`
--

INSERT INTO `sv_ticket_details` (`sv_number`, `log_ID`, `subject`, `issue`, `remarks`) VALUES
(761963, 19, 'Monitor(screen problem)', 'sira', 'see attachment part 4'),
(761963, 18, 'Monitor(screen problem)', 'sira', 'see attachment part 3'),
(761963, 17, 'Monitor(screen problem)', 'sira', 'see attachment'),
(761963, 16, 'Monitor(screen problem)', 'sira', ''),
(278321, 20, 'Desktop Problem', 'sira ang desktop', 'paki assign nlng po mr. supervisor :)'),
(506073, 21, 'Payment for Acer Tablet', 'Payment for the month of January', 'see attachment for more details');

-- --------------------------------------------------------

--
-- Table structure for table `sv_ticket_details_attachment`
--

CREATE TABLE IF NOT EXISTS `sv_ticket_details_attachment` (
  `sv_number` int(11) NOT NULL,
  `attachment` text NOT NULL,
  `date_uploaded` date NOT NULL,
  `reply_sv_number` int(11) NOT NULL,
  `uniqid` text NOT NULL,
  `logs` int(20) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`logs`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=49 ;

--
-- Dumping data for table `sv_ticket_details_attachment`
--

INSERT INTO `sv_ticket_details_attachment` (`sv_number`, `attachment`, `date_uploaded`, `reply_sv_number`, `uniqid`, `logs`) VALUES
(761963, '10368238_811864538908476_727298576026824168_n.jpg', '2014-10-07', 0, '54341cc84b4e53.16900464.jpg', 45),
(761963, 'Beelzebub-beelzebub-29427388-1920-1080.png', '2014-10-07', 0, '543420a1039816.69150136.png', 46),
(278321, '2352.jpg', '2014-10-07', 0, '54343a2cb6df82.76993372.jpg', 47),
(506073, 'fairy_tail_wallpaper_by_jokr17-d4dpdil.png', '2014-10-07', 0, '54345510739d02.02009830.png', 48);

-- --------------------------------------------------------

--
-- Table structure for table `sv_ticket_header`
--

CREATE TABLE IF NOT EXISTS `sv_ticket_header` (
  `sv_number` int(11) NOT NULL,
  `log_ID` int(20) NOT NULL AUTO_INCREMENT,
  `source` varchar(25) NOT NULL,
  `status` varchar(25) NOT NULL,
  `assignto` varchar(50) NOT NULL,
  `details` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `company` varchar(50) NOT NULL,
  `reference` varchar(100) NOT NULL,
  `duedate` date NOT NULL,
  `priority` varchar(25) NOT NULL,
  `ticketID` int(10) NOT NULL,
  `response` int(1) NOT NULL DEFAULT '0',
  `help_topic` varchar(20) NOT NULL,
  `slaplan` varchar(16) NOT NULL,
  `duetime` time NOT NULL,
  `ticketSender` varchar(200) NOT NULL,
  `ticketSenderEmail` varchar(255) NOT NULL,
  `time_created` time NOT NULL,
  `date_created` date NOT NULL,
  `isOverdue` int(11) NOT NULL,
  `isAssign` int(1) NOT NULL DEFAULT '0',
  `isClosed` int(1) NOT NULL,
  PRIMARY KEY (`log_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `sv_ticket_header`
--

INSERT INTO `sv_ticket_header` (`sv_number`, `log_ID`, `source`, `status`, `assignto`, `details`, `department`, `company`, `reference`, `duedate`, `priority`, `ticketID`, `response`, `help_topic`, `slaplan`, `duetime`, `ticketSender`, `ticketSenderEmail`, `time_created`, `date_created`, `isOverdue`, `isAssign`, `isClosed`) VALUES
(278321, 20, 'Email', 'Open', 'derechoandro@yahoo.com', '', 'Internal', 'Forefront Innovative Technologies Inc.', 'ACER', '2014-10-07', 'High', 278321, 1, 'Support', 'Default SLA(48hr', '12:59:00', 'csr', 'derechoandro@gmail.com', '12:08:29', '2014-10-07', 0, 0, 0),
(761963, 19, 'Walk-in', 'Open', 'derechoandro@yahoo.com', '', 'External', 'Jump Solutions Inc.', 'IBM', '2014-10-07', 'High', 761963, 1, 'Support', 'Default SLA(48hr', '12:59:00', 'csr', 'derechoandro@gmail.com', '10:23:22', '2014-10-07', 0, 1, 0),
(761963, 18, 'Walk-in', 'Open', 'derechoandro@yahoo.com', '', 'External', 'Forefront Innovative Technologies Inc.', 'IBM', '2014-10-07', 'High', 761963, 1, 'Support', 'Default SLA(48hr', '12:59:00', 'csr', 'derechoandro@gmail.com', '10:19:29', '2014-10-07', 0, 1, 1),
(761963, 17, 'Walk-in', 'Open', 'derechoandro@yahoo.com', '', 'External', 'Jump Solutions Inc.', 'IBM', '2014-10-07', 'High', 761963, 0, 'Support', 'Default SLA(48hr', '12:59:00', 'csr', 'derechoandro@gmail.com', '10:14:02', '2014-10-07', 0, 1, 1),
(761963, 16, 'Walk-in', 'Open', 'derechoandro@yahoo.com', '', 'External', 'Jump Solutions Inc.', 'IBM', '2014-10-07', 'High', 761963, 0, 'Support', 'Default SLA(48hr', '12:59:00', 'csr', 'derechoandro@gmail.com', '10:03:04', '2014-10-07', 0, 1, 1),
(506073, 21, 'Email', 'Open', 'derechoandro@yahoo.com', '', 'Internal', 'Stead Fast Solutions Inc.', 'ACER', '2014-10-07', 'High', 506073, 0, 'Billing', 'Default SLA(48hr', '12:59:00', 'csr', 'derechoandro@gmail.com', '14:03:12', '2014-10-07', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sv_ticket_item_details`
--

CREATE TABLE IF NOT EXISTS `sv_ticket_item_details` (
  `item` int(11) NOT NULL DEFAULT '1',
  `Unit_Brand` varchar(20) NOT NULL,
  `Unit_Model` varchar(60) NOT NULL,
  `Machine_Serial_No` varchar(30) NOT NULL,
  `Part_No_Quantity` varchar(30) NOT NULL,
  `Quantity` int(11) NOT NULL DEFAULT '1',
  `Warranty` varchar(20) NOT NULL,
  `sv_number` int(11) NOT NULL,
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`log_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `sv_ticket_item_details`
--

INSERT INTO `sv_ticket_item_details` (`item`, `Unit_Brand`, `Unit_Model`, `Machine_Serial_No`, `Part_No_Quantity`, `Quantity`, `Warranty`, `sv_number`, `log_id`) VALUES
(1, 'ACER', 'Tablet', 'Acer212', 'SN3534534534534', 1, 'Under Warranty', 506073, 36),
(1, 'ACER', 'Desktop', 'Acer212', 'SN823742553596849589', 1, 'Under Warranty', 278321, 35),
(1, 'IBM ', 'Monitor', 'IBM32525', 'SIN124142', 1, 'Under Warranty', 761963, 34);

-- --------------------------------------------------------

--
-- Table structure for table `sv_ticket_replay`
--

CREATE TABLE IF NOT EXISTS `sv_ticket_replay` (
  `sv_number` int(11) NOT NULL,
  `logs` int(11) NOT NULL AUTO_INCREMENT,
  `message` text NOT NULL,
  `sender` varchar(20) NOT NULL,
  `reciever` varchar(20) NOT NULL,
  `DatePosted` datetime NOT NULL,
  PRIMARY KEY (`logs`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=58 ;

--
-- Dumping data for table `sv_ticket_replay`
--

INSERT INTO `sv_ticket_replay` (`sv_number`, `logs`, `message`, `sender`, `reciever`, `DatePosted`) VALUES
(761963, 57, 'okay', 'supervisor', '', '2014-10-07 16:09:57'),
(278321, 56, 'i will assign it to engr blah blah', 'supervisor', '', '2014-10-07 14:10:21'),
(761963, 55, 'okay', 'supervisor', '', '2014-10-07 11:30:45'),
(761963, 54, 'okay', 'supervisor', '', '2014-10-07 11:30:23'),
(761963, 53, '[ SYSTEM : TICKET RE-OPENED ] :', 'csr', '', '2014-10-07 10:23:23'),
(761963, 52, '[ SYSTEM : TICKET CLOSED ] :', 'csr', '', '2014-10-07 10:22:32'),
(761963, 51, '[ SYSTEM : TICKET RE-OPENED ] :', 'csr', '', '2014-10-07 10:19:29'),
(761963, 50, '[ SYSTEM : TICKET RE-OPENED ] :', 'csr', '', '2014-10-07 10:18:46'),
(761963, 49, '[ SYSTEM : TICKET CLOSED ] :', 'csr', '', '2014-10-07 10:16:45'),
(761963, 48, '[ SYSTEM : TICKET RE-OPENED ] :', 'csr', '', '2014-10-07 10:14:02'),
(761963, 47, '[ SYSTEM : TICKET CLOSED ] :', 'csr', '', '2014-10-07 10:07:50');

-- --------------------------------------------------------

--
-- Table structure for table `tbcustomer`
--

CREATE TABLE IF NOT EXISTS `tbcustomer` (
  `customer_snum` varchar(11) DEFAULT NULL,
  `customer_company` text NOT NULL,
  `customer_attention` text NOT NULL,
  `customer_name` text NOT NULL,
  `customer_code` varchar(255) DEFAULT NULL,
  `customer_email` varchar(255) DEFAULT NULL,
  `customer_cnum` varchar(255) DEFAULT NULL,
  `customer_fnum` varchar(255) DEFAULT NULL,
  `customer_baddr` varchar(255) DEFAULT NULL,
  `customer_daddr` varchar(255) DEFAULT NULL,
  `customer_contact` varchar(255) DEFAULT NULL,
  `customer_terms` varchar(255) DEFAULT NULL,
  `customer_vat` varchar(255) DEFAULT NULL,
  `sv_number` int(11) NOT NULL,
  `logs` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`logs`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=226 ;

--
-- Dumping data for table `tbcustomer`
--

INSERT INTO `tbcustomer` (`customer_snum`, `customer_company`, `customer_attention`, `customer_name`, `customer_code`, `customer_email`, `customer_cnum`, `customer_fnum`, `customer_baddr`, `customer_daddr`, `customer_contact`, `customer_terms`, `customer_vat`, `sv_number`, `logs`) VALUES
('761963', 'Jump Solutions Inc.', '', 'mariz', NULL, 'mariz@yahoo.com', '09057090055', '45345345', 'Alabang, Muntinlupa City', NULL, 'von ryan', NULL, NULL, 761963, 223),
('278321', 'Forefront Innovative Technologies Inc.', '', 'carla', NULL, 'carla@gmail.com', '09057090056', '7970922', 'T.S Cruz Almanza Dos, Las Pinas', NULL, 'von ryan', NULL, NULL, 278321, 224),
('506073', 'Stead Fast Solutions Inc.', '', 'James', NULL, 'James@yahoo.com', '8789789', '8789789', 'Pasay City', NULL, 'von ryan', NULL, NULL, 506073, 225);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pullout`
--

CREATE TABLE IF NOT EXISTS `tb_pullout` (
  `log` int(20) NOT NULL,
  `sv_number` int(11) NOT NULL,
  `pullout_type` varchar(255) NOT NULL,
  `pullout_remarks` varchar(255) NOT NULL,
  `preparedBy` varchar(255) NOT NULL,
  `pulloutBy` varchar(255) NOT NULL,
  `pulloutDate` varchar(50) NOT NULL,
  `pulloutNo` varchar(255) NOT NULL,
  PRIMARY KEY (`log`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pullout`
--

INSERT INTO `tb_pullout` (`log`, `sv_number`, `pullout_type`, `pullout_remarks`, `preparedBy`, `pulloutBy`, `pulloutDate`, `pulloutNo`) VALUES
(19, 761963, 'customer', 'bebreb', 'Andro Derecho', 'Vonryan', '2014-10-07 16:47:38', '770599');

-- --------------------------------------------------------

--
-- Table structure for table `tb_reopen`
--

CREATE TABLE IF NOT EXISTS `tb_reopen` (
  `log` int(11) NOT NULL AUTO_INCREMENT,
  `sv_number` int(11) NOT NULL,
  `reassignTo` varchar(255) NOT NULL,
  `reason` varchar(255) NOT NULL,
  `date_reopen` datetime NOT NULL,
  `reopenBy` varchar(255) NOT NULL,
  PRIMARY KEY (`log`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `tb_reopen`
--

INSERT INTO `tb_reopen` (`log`, `sv_number`, `reassignTo`, `reason`, `date_reopen`, `reopenBy`) VALUES
(27, 761963, 'derechoandro@yahoo.com', '', '2014-10-07 10:23:22', 'Andro Derecho'),
(26, 761963, 'derechoandro@yahoo.com', '', '2014-10-07 10:19:29', 'Andro Derecho'),
(25, 761963, 'derechoandro@yahoo.com', '', '2014-10-07 10:14:02', 'Andro Derecho');

-- --------------------------------------------------------

--
-- Table structure for table `tb_return`
--

CREATE TABLE IF NOT EXISTS `tb_return` (
  `log` int(20) NOT NULL,
  `sv_number` int(11) NOT NULL,
  `returnNo` int(11) NOT NULL,
  `r_preparedBy` varchar(255) NOT NULL,
  `returnBy` varchar(255) NOT NULL,
  `returnDate` datetime NOT NULL,
  `problem_res` varchar(255) NOT NULL,
  `r_remarks` varchar(255) NOT NULL,
  PRIMARY KEY (`log`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_return`
--

INSERT INTO `tb_return` (`log`, `sv_number`, `returnNo`, `r_preparedBy`, `returnBy`, `returnDate`, `problem_res`, `r_remarks`) VALUES
(19, 761963, 867736, 'Andro Derecho', 'Vonryan', '2014-10-07 17:10:18', '', 'aus na');

-- --------------------------------------------------------

--
-- Table structure for table `ticket_status`
--

CREATE TABLE IF NOT EXISTS `ticket_status` (
  `ticketNo` int(20) NOT NULL,
  `log_ID` int(20) NOT NULL AUTO_INCREMENT,
  `isCreated` int(1) NOT NULL,
  `isOpen` int(1) NOT NULL,
  `isAnswered` int(1) NOT NULL,
  `isOverdue` int(1) NOT NULL,
  `isClosed` int(1) NOT NULL,
  `isWorkOder` int(1) NOT NULL,
  `dateCreated` date NOT NULL,
  `dateAnswered` date DEFAULT NULL,
  `dateOverdue` date DEFAULT NULL,
  `dateClosed` date DEFAULT NULL,
  `dateWorkOderCreated` date DEFAULT NULL,
  `WorkOderNo` int(11) DEFAULT NULL,
  `isReopen` int(1) DEFAULT NULL,
  `isWOOpen` int(1) NOT NULL DEFAULT '0',
  `isWOAnswered` int(1) NOT NULL DEFAULT '0',
  `isWOOverdue` int(1) NOT NULL DEFAULT '0',
  `isWOClosed` int(1) NOT NULL DEFAULT '0',
  `dateWOCreated` datetime DEFAULT NULL,
  `dateWOAnswered` datetime DEFAULT NULL,
  `dateWOOverdue` datetime DEFAULT NULL,
  `dateWOClosed` datetime DEFAULT NULL,
  PRIMARY KEY (`log_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `ticket_status`
--

INSERT INTO `ticket_status` (`ticketNo`, `log_ID`, `isCreated`, `isOpen`, `isAnswered`, `isOverdue`, `isClosed`, `isWorkOder`, `dateCreated`, `dateAnswered`, `dateOverdue`, `dateClosed`, `dateWorkOderCreated`, `WorkOderNo`, `isReopen`, `isWOOpen`, `isWOAnswered`, `isWOOverdue`, `isWOClosed`, `dateWOCreated`, `dateWOAnswered`, `dateWOOverdue`, `dateWOClosed`) VALUES
(761963, 16, 1, 0, 0, 0, 1, 0, '2014-10-07', NULL, NULL, '2014-10-07', NULL, NULL, 1, 0, 0, 0, 0, NULL, NULL, NULL, NULL),
(761963, 17, 1, 0, 0, 0, 1, 0, '2014-10-07', NULL, NULL, '2014-10-07', NULL, NULL, 1, 0, 0, 0, 0, NULL, NULL, NULL, NULL),
(761963, 18, 1, 0, 0, 0, 1, 0, '2014-10-07', NULL, NULL, '2014-10-07', NULL, NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL),
(761963, 19, 1, 1, 1, 0, 0, 0, '2014-10-07', '2014-10-07', NULL, NULL, '2014-10-07', 305695, NULL, 0, 1, 0, 1, '2014-10-07 11:30:06', '2014-10-07 16:44:16', NULL, '2014-10-07 17:10:52'),
(278321, 20, 1, 1, 0, 0, 0, 0, '2014-10-07', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL),
(506073, 21, 1, 1, 0, 0, 0, 0, '2014-10-07', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wo_ticket_details`
--

CREATE TABLE IF NOT EXISTS `wo_ticket_details` (
  `sv_number` int(11) NOT NULL,
  `assignToEngineer` varchar(50) NOT NULL,
  `log_ID` int(11) NOT NULL AUTO_INCREMENT,
  `MessagetoEngineer` text NOT NULL,
  `work_number` int(6) NOT NULL,
  `created` datetime NOT NULL,
  `status` varchar(25) NOT NULL,
  `priority` varchar(25) NOT NULL,
  `duedate` date NOT NULL,
  `response` int(1) NOT NULL,
  `duetime` time NOT NULL,
  `time_created` datetime NOT NULL,
  `wo_date_created` datetime NOT NULL,
  `isOverdue` int(1) NOT NULL,
  `log_No` int(11) NOT NULL,
  PRIMARY KEY (`log_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `wo_ticket_details`
--

INSERT INTO `wo_ticket_details` (`sv_number`, `assignToEngineer`, `log_ID`, `MessagetoEngineer`, `work_number`, `created`, `status`, `priority`, `duedate`, `response`, `duetime`, `time_created`, `wo_date_created`, `isOverdue`, `log_No`) VALUES
(761963, 'andro.derecho@atomitsoln.com', 13, '', 305695, '2014-10-07 11:30:06', '1', 'High', '2014-10-07', 0, '12:59:00', '2014-10-07 11:30:06', '2014-10-07 11:30:06', 0, 19);

-- --------------------------------------------------------

--
-- Table structure for table `wo_ticket_details_replay`
--

CREATE TABLE IF NOT EXISTS `wo_ticket_details_replay` (
  `message` text NOT NULL,
  `sender` varchar(20) NOT NULL,
  `reciever` varchar(20) NOT NULL,
  `DateResponse` datetime NOT NULL,
  `sv_number` int(6) NOT NULL,
  `logs` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`logs`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `wo_ticket_details_replay`
--

INSERT INTO `wo_ticket_details_replay` (`message`, `sender`, `reciever`, `DateResponse`, `sv_number`, `logs`) VALUES
('okay', 'engineer_vonryan', '', '2014-10-07 16:36:46', 761963, 30),
('okay\r\n', 'engineer_vonryan', '', '2014-10-07 16:36:19', 761963, 29),
('okay mr. supervisor', 'engineer_vonryan', '', '2014-10-07 16:18:47', 761963, 28),
('aus', 'engineer_vonryan', '', '2014-10-07 16:38:43', 761963, 31),
('okay na po', 'engineer_vonryan', '', '2014-10-07 16:44:16', 761963, 32),
('okay boss', 'engineer_vonryan', '', '2014-10-07 16:45:24', 761963, 33),
('[ SYSTEM : WORKORDER CLOSED ]: ', 'supervisor', '', '2014-10-07 17:10:52', 761963, 34);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
