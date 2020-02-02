-- phpMyAdmin SQL Dump
-- version 4.4.15.9
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 30, 2019 at 07:44 PM
-- Server version: 5.6.35
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `farmers`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `sett`(IN `email` VARCHAR(20), IN `status` VARCHAR(20))
    NO SQL
INSERT INTO logs(`email`,`status`,`cdate`)VALUES(email,status,NOW())$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `advertise`
--

CREATE TABLE IF NOT EXISTS `advertise` (
  `id` int(11) NOT NULL,
  `cp_name` varchar(255) NOT NULL,
  `cp_qty` varchar(255) NOT NULL,
  `sup_email` varchar(255) NOT NULL,
  `sup_mob` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `buyer_email` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `advertise`
--

INSERT INTO `advertise` (`id`, `cp_name`, `cp_qty`, `sup_email`, `sup_mob`, `status`, `buyer_email`) VALUES
(1, 'cherry', '20', 'ram@gmail.com', '9752411867', 'Accepted', 'deepak@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `complains`
--

CREATE TABLE IF NOT EXISTS `complains` (
  `id` int(11) NOT NULL,
  `farmer_id` varchar(255) NOT NULL,
  `c_type` varchar(255) NOT NULL,
  `d_decription` longtext NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `complains`
--

INSERT INTO `complains` (`id`, `farmer_id`, `c_type`, `d_decription`, `status`) VALUES
(1, '1', 'Crop Related', 'crops are not proper', 'Solved');

-- --------------------------------------------------------

--
-- Table structure for table `cropd_details`
--

CREATE TABLE IF NOT EXISTS `cropd_details` (
  `id` int(11) NOT NULL,
  `cropd_id` varchar(255) NOT NULL,
  `farmer_id` varchar(255) NOT NULL,
  `farmer_name` varchar(255) NOT NULL,
  `crop_name` varchar(255) NOT NULL,
  `req_qty` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `sup_email` varchar(255) NOT NULL,
  `buyer_email` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cropd_details`
--

INSERT INTO `cropd_details` (`id`, `cropd_id`, `farmer_id`, `farmer_name`, `crop_name`, `req_qty`, `amount`, `status`, `sup_email`, `buyer_email`) VALUES
(1, '1', '1', 'Deepak Dan', 'cherry', '20', '12000', 'Accepted', 'ram@gmail.com', 'deepak@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `farmers_details`
--

CREATE TABLE IF NOT EXISTS `farmers_details` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `uname` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `farmers_details`
--

INSERT INTO `farmers_details` (`id`, `name`, `email`, `uname`, `password`) VALUES
(1, 'Deepak Dansena(farmer)', 'deepak@gmail.com', 'deepu', '1234');

--
-- Triggers `farmers_details`
--
DELIMITER $$
CREATE TRIGGER `farmer_delete_trigger` AFTER DELETE ON `farmers_details`
 FOR EACH ROW CALL sett(OLD.email,"farmer deleted")
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `farmer_insert_trigger` BEFORE INSERT ON `farmers_details`
 FOR EACH ROW CALL sett(NEW.email,"farmer recorded")
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `farmtips`
--

CREATE TABLE IF NOT EXISTS `farmtips` (
  `id` int(11) NOT NULL,
  `message` varchar(255) NOT NULL,
  `Dates` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `farmtips`
--

INSERT INTO `farmtips` (`id`, `message`, `Dates`) VALUES
(1, 'plant more seeds', '2019-11-16 19:14:42'),
(2, 'the crops are not proper', '2019-11-26 17:25:42');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE IF NOT EXISTS `logs` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `status` varchar(20) NOT NULL,
  `cdate` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `email`, `status`, `cdate`) VALUES
(1, 'deepak@gmail.com', 'farmer recorded', '2019-11-07 19:55:02'),
(2, 'ram@gmail.com', 'seller recorded', '2019-11-08 00:45:45'),
(3, 'g@gmail.com', 'farmer recorded', '2019-11-16 19:25:26'),
(4, 'ramu@gmail.com', 'farmer recorded', '2019-11-30 19:35:48'),
(5, 'ramu@gmail.com', 'farmer deleted', '2019-11-30 19:36:22'),
(6, 'd@gmail.com', 'seller recorded', '2019-11-30 19:41:12'),
(7, 'd@gmail.com', 'seller deleted', '2019-11-30 19:41:22');

-- --------------------------------------------------------

--
-- Table structure for table `sellers_details`
--

CREATE TABLE IF NOT EXISTS `sellers_details` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `uname` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sellers_details`
--

INSERT INTO `sellers_details` (`id`, `name`, `email`, `uname`, `password`, `phone`) VALUES
(1, 'ram charan(supplier)', 'ram@gmail.com', 'ram', '1234', '9752411867');

--
-- Triggers `sellers_details`
--
DELIMITER $$
CREATE TRIGGER `trigger_seller_delete` AFTER DELETE ON `sellers_details`
 FOR EACH ROW CALL sett(OLD.email,"seller deleted")
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `trigger_seller_insert` BEFORE INSERT ON `sellers_details`
 FOR EACH ROW CALL sett(New.email,"seller recorded")
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `advertise`
--
ALTER TABLE `advertise`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `complains`
--
ALTER TABLE `complains`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cropd_details`
--
ALTER TABLE `cropd_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `farmers_details`
--
ALTER TABLE `farmers_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `farmtips`
--
ALTER TABLE `farmtips`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sellers_details`
--
ALTER TABLE `sellers_details`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `advertise`
--
ALTER TABLE `advertise`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `complains`
--
ALTER TABLE `complains`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `cropd_details`
--
ALTER TABLE `cropd_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `farmers_details`
--
ALTER TABLE `farmers_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `farmtips`
--
ALTER TABLE `farmtips`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `sellers_details`
--
ALTER TABLE `sellers_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
