-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 18, 2013 at 06:31 PM
-- Server version: 5.5.32
-- PHP Version: 5.3.10-1ubuntu3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `clockworkfull`
--

-- --------------------------------------------------------

--
-- Table structure for table `combinereports`
--

CREATE TABLE IF NOT EXISTS `combinereports` (
  `unitid` varchar(255) DEFAULT NULL,
  `unitname` varchar(255) NOT NULL,
  `dateooc` varchar(255) DEFAULT NULL,
  `dateic` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `notes` mediumtext,
  `reviewed` varchar(255) DEFAULT NULL,
  `reviewer` varchar(255) NOT NULL,
  `comments` varchar(255) NOT NULL,
  `RID` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`RID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
