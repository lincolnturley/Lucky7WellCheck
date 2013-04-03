-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 25, 2013 at 06:39 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `wcheck`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE IF NOT EXISTS `appointments` (
  `apid` int(8) NOT NULL AUTO_INCREMENT,
  `apdate` date NOT NULL,
  `aptime` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `apstatus` char(15) COLLATE utf8_unicode_ci NOT NULL,
  `apdoctorid` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `apdoctorname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `appatientid` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `appatientname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`apid`),
  UNIQUE KEY `apid` (`apid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`apid`, `apdate`, `aptime`, `apstatus`, `apdoctorid`, `apdoctorname`, `appatientid`, `appatientname`) VALUES
(1, '2013-04-01', '12:00 pm', 'Future', '96', 'Applegate, Diane', 'LVMLLT', 'Turley, Lincoln');

-- --------------------------------------------------------

--
-- Table structure for table `memos`
--

CREATE TABLE IF NOT EXISTS `memos` (
  `meid` int(8) NOT NULL AUTO_INCREMENT,
  `mepatientid` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `metype` char(2) COLLATE utf8_unicode_ci NOT NULL,
  `medate` date NOT NULL,
  `menote` text COLLATE utf8_unicode_ci NOT NULL,
  `meread` tinyint(1) NOT NULL,
  PRIMARY KEY (`meid`),
  UNIQUE KEY `meid` (`meid`),
  KEY `mepatientid` (`mepatientid`),
  KEY `mepatientid_2` (`mepatientid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `memos`
--

INSERT INTO `memos` (`meid`, `mepatientid`, `metype`, `medate`, `menote`, `meread`) VALUES
(2, 'LVMLLT', 'PA', '2013-03-25', 'Dear Lincoln,\r\n\r\nPlease follow these instructions.\r\nInstruction 1\r\nInstruction 2\r\nInstruction 3\r\nInstruction 4', 0),
(3, 'LVMLLT', 'DO', '2013-03-25', 'This is the body of the memo.\r\nInstruction 1\r\nInstruction 2\r\nInstruction 3\r\nInstruction 4', 0);

-- --------------------------------------------------------

--
-- Table structure for table `prescriptions`
--

CREATE TABLE IF NOT EXISTS `prescriptions` (
  `prid` int(8) NOT NULL AUTO_INCREMENT,
  `prpatientid` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `prdrugname` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `prdosage` varchar(240) COLLATE utf8_unicode_ci NOT NULL,
  `prstartdate` date NOT NULL,
  `prexpiredate` date NOT NULL,
  `prprescriptionactive` tinyint(1) NOT NULL,
  PRIMARY KEY (`prid`),
  UNIQUE KEY `prid` (`prid`),
  KEY `prpatientid` (`prpatientid`),
  KEY `prpatientid_2` (`prpatientid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `prescriptions`
--

INSERT INTO `prescriptions` (`prid`, `prpatientid`, `prdrugname`, `prdosage`, `prstartdate`, `prexpiredate`, `prprescriptionactive`) VALUES
(1, 'LVMLLT', 'Tylenol', '2 pills every 4 hours. Not to exceed 10 pills per day', '2013-03-01', '2013-03-31', 1);

-- --------------------------------------------------------

--
-- Table structure for table `testresults`
--

CREATE TABLE IF NOT EXISTS `testresults` (
  `trid` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `trpatientid` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `trdate` date NOT NULL,
  `trbpsystolic` int(4) NOT NULL,
  `trbpdiastolic` int(4) NOT NULL,
  `trbloodsugarlevel` int(4) NOT NULL,
  `trweight` double(8,2) NOT NULL,
  PRIMARY KEY (`trid`),
  UNIQUE KEY `trid` (`trid`),
  KEY `trpatientid` (`trpatientid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `testresults`
--

INSERT INTO `testresults` (`trid`, `trpatientid`, `trdate`, `trbpsystolic`, `trbpdiastolic`, `trbloodsugarlevel`, `trweight`) VALUES
('0', 'LVMLLT', '2013-03-13', 120, 80, 100, 100.00),
('1', 'LVMLLT', '2013-03-13', 120, 80, 80, 199.45),
('2', 'LVMLLT', '2013-03-13', 123, 82, 90, 198.50),
('3', 'DAFFYDK', '2013-03-24', 120, 80, 80, 201.40),
('4', 'DAFFYDK', '2013-03-25', 122, 80, 90, 200.00);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `userid` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `usertype` char(2) COLLATE utf8_unicode_ci NOT NULL,
  `userpassword` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `useremail` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `userfname` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `userlname` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `userbirthdate` date NOT NULL,
  `useractive` tinyint(1) NOT NULL,
  `pa_mrnnumber` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `pa_doctorid` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `pa_doctorname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `nu_hasmanagerauth` tinyint(1) NOT NULL,
  `nu_doctorid1` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `nu_doctorid2` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `nu_doctorid3` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `nu_doctorid4` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`userid`),
  UNIQUE KEY `userid` (`userid`),
  KEY `fname` (`userfname`),
  KEY `lname` (`userlname`),
  KEY `lname_2` (`userlname`),
  KEY `nu_doctorid1` (`nu_doctorid1`,`nu_doctorid2`,`nu_doctorid3`,`nu_doctorid4`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `usertype`, `userpassword`, `useremail`, `userfname`, `userlname`, `userbirthdate`, `useractive`, `pa_mrnnumber`, `pa_doctorid`, `pa_doctorname`, `nu_hasmanagerauth`, `nu_doctorid1`, `nu_doctorid2`, `nu_doctorid3`, `nu_doctorid4`) VALUES
('96', 'DO', 'pas', 'dapplegate@gmail.com', 'Diane', 'Applegate', '1985-05-19', 1, '', '', '', 0, '', '', '', ''),
('DAFFYDK', 'PA', 'changeme01', 'daffy.duck@hotmail.com', 'Daffy', 'Duck', '2004-06-01', 1, '00kk0', '96', 'Diane Applegate', 0, '', '', '', ''),
('INACT', 'NU', 'pas', 'inactiveuser@gmail.com', 'InactiveF', 'InactiveL', '2001-01-01', 0, '', '', '', 0, '96', '', '', ''),
('LVMLLT', 'PA', 'pas', 'lincolnlogs12@juno.com', 'Lincoln', 'Turley', '1980-01-01', 1, '12345MRN', '96', 'Diane Applegate', 0, '', '', '', ''),
('NURSEJ', 'NU', 'pas', 'jenSmith@gmail.com', 'Jenny', 'Smith', '1975-12-09', 1, '', '', '', 1, '96', '', '', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
