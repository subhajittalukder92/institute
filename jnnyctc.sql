-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 08, 2018 at 06:25 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `jnnyctc`
--

-- --------------------------------------------------------

--
-- Table structure for table `cash_in_bank`
--

CREATE TABLE IF NOT EXISTS `cash_in_bank` (
`id` int(25) NOT NULL,
  `student_id` varchar(12) NOT NULL,
  `course_id` varchar(25) NOT NULL,
  `income_id` varchar(25) NOT NULL,
  `user_id` varchar(55) NOT NULL,
  `date` date NOT NULL,
  `particulars` varchar(100) NOT NULL,
  `cash` decimal(12,2) NOT NULL,
  `bank` decimal(12,2) NOT NULL,
  `type` varchar(55) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cash_in_bank`
--

INSERT INTO `cash_in_bank` (`id`, `student_id`, `course_id`, `income_id`, `user_id`, `date`, `particulars`, `cash`, `bank`, `type`) VALUES
(1, '2018005', '13', '1', 'admin', '2018-03-07', 'ADMISSION TO gilo[l-kk', '0.00', '4562.00', 'INCOME');

-- --------------------------------------------------------

--
-- Table structure for table `cash_in_hand`
--

CREATE TABLE IF NOT EXISTS `cash_in_hand` (
`id` int(25) NOT NULL,
  `student_id` varchar(12) NOT NULL,
  `course_id` varchar(25) NOT NULL,
  `expense_id` varchar(25) NOT NULL,
  `user_id` varchar(55) NOT NULL,
  `date` date NOT NULL,
  `particulars` varchar(100) NOT NULL,
  `cash` decimal(12,2) NOT NULL,
  `bank` decimal(12,2) NOT NULL,
  `type` varchar(55) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cash_in_hand`
--

INSERT INTO `cash_in_hand` (`id`, `student_id`, `course_id`, `expense_id`, `user_id`, `date`, `particulars`, `cash`, `bank`, `type`) VALUES
(1, '2018005', '13', '', 'admin', '2018-03-07', 'ADMISSION TO gilo[l-kk', '0.00', '4562.00', 'INCOME'),
(2, '2018006', '8', '', 'admin', '2018-03-08', 'ADMISSION TO 1-1', '1.00', '0.00', 'INCOME');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE IF NOT EXISTS `courses` (
`course_id` int(22) NOT NULL,
  `course_name` varchar(155) NOT NULL,
  `description` varchar(155) NOT NULL,
  `duration` varchar(55) NOT NULL,
  `unit` varchar(55) NOT NULL,
  `course_fee` decimal(12,2) NOT NULL,
  `fee_type` varchar(155) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_id`, `course_name`, `description`, `duration`, `unit`, `course_fee`, `fee_type`) VALUES
(1, 'p', 'p', 'p', 'p', '0.00', 'p'),
(2, 'u', 'u', 'u', 'u', '0.00', 'u'),
(3, '5', '5', '5', '5', '5.00', '5'),
(4, '6', '6', '6', '6', '6.00', '6'),
(5, '7', '7', '7', '7', '7.00', '7'),
(6, '8', '8', '8', '8', '8.00', '8'),
(7, '9', '9', '9', '9', '9.00', '9'),
(8, '1', '1', '1', '1', '1.00', '1'),
(9, '89898', '8989898', '989', '8989', '9898.00', '8989'),
(10, '1111111', '111111', '11', '1', '1.00', '1'),
(11, '565', '65', '5', '656', '56.00', '56'),
(12, 'p', 'p', 'p', 'p', '0.00', 'iioiioio'),
(13, 'gilo[l', 'kk', 'pp', '5', '4562.00', '56');

-- --------------------------------------------------------

--
-- Table structure for table `daybook`
--

CREATE TABLE IF NOT EXISTS `daybook` (
`id` int(25) NOT NULL,
  `student_id` varchar(12) NOT NULL,
  `course_id` varchar(25) NOT NULL,
  `user_id` varchar(55) NOT NULL,
  `date` date NOT NULL,
  `particulars` varchar(100) NOT NULL,
  `cash` decimal(12,2) NOT NULL,
  `bank` decimal(12,2) NOT NULL,
  `to` varchar(55) NOT NULL,
  `type` varchar(55) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `daybook`
--

INSERT INTO `daybook` (`id`, `student_id`, `course_id`, `user_id`, `date`, `particulars`, `cash`, `bank`, `to`, `type`) VALUES
(1, '2018001', '13', 'admin', '2018-01-04', 'ADMISSION TO gilo[l-kk', '0.00', '4562.00', 'BANK', 'INCOME'),
(2, '2018002', '13', 'admin', '2018-01-04', 'ADMISSION TO gilo[l-kk', '0.00', '4562.00', 'BANK', 'INCOME');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE IF NOT EXISTS `payment` (
`payment_id` int(25) NOT NULL,
  `date` date NOT NULL,
  `course_id` varchar(55) NOT NULL,
  `student_id` varchar(55) NOT NULL,
  `payment_amt` decimal(12,2) NOT NULL,
  `payby` varchar(25) NOT NULL,
  `cheque_no` varchar(25) NOT NULL,
  `remarks` varchar(22) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `date`, `course_id`, `student_id`, `payment_amt`, `payby`, `cheque_no`, `remarks`) VALUES
(1, '2018-01-04', '13', '2018001', '685.00', 'CHEQUE', '898989', ''),
(2, '2018-01-04', '13', '2018002', '685.00', 'CHEQUE', '898989', '');

-- --------------------------------------------------------

--
-- Table structure for table `pursuing_course`
--

CREATE TABLE IF NOT EXISTS `pursuing_course` (
`pusuing_id` int(25) NOT NULL,
  `date` date NOT NULL,
  `student_id` varchar(25) NOT NULL,
  `course_id` varchar(25) NOT NULL,
  `course_code` varchar(55) NOT NULL,
  `session_code` varchar(55) NOT NULL,
  `serial_no` varchar(55) NOT NULL,
  `course_fee` decimal(12,2) NOT NULL,
  `course_days` varchar(400) NOT NULL,
  `current_status` varchar(25) NOT NULL DEFAULT 'PURSUING'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pursuing_course`
--

INSERT INTO `pursuing_course` (`pusuing_id`, `date`, `student_id`, `course_id`, `course_code`, `session_code`, `serial_no`, `course_fee`, `course_days`, `current_status`) VALUES
(1, '2018-01-04', '2018001', '13', '013', '001', '0001', '4562.00', 'MONDAY,TUESDAY,WEDNESDAY,THURSDAY,FRIDAY,SATURDAY,SUNDAY', 'PURSUING'),
(2, '2018-01-04', '2018002', '13', '013', '001', '2', '4562.00', 'MONDAY,TUESDAY,WEDNESDAY,THURSDAY,FRIDAY,SATURDAY,SUNDAY', 'PURSUING');

-- --------------------------------------------------------

--
-- Table structure for table `student_info`
--

CREATE TABLE IF NOT EXISTS `student_info` (
`slno` int(25) NOT NULL,
  `Student_Id` varchar(9) NOT NULL DEFAULT '',
  `St_Name` varchar(25) DEFAULT NULL,
  `Fathers_Name` varchar(30) DEFAULT NULL,
  `DOB` varchar(10) DEFAULT NULL,
  `Gender` varchar(6) DEFAULT NULL,
  `Cust` varchar(7) DEFAULT NULL,
  `Religion` varchar(10) DEFAULT NULL,
  `Mother_Trong` varchar(10) DEFAULT NULL,
  `Session1` varchar(9) DEFAULT NULL,
  `session_month` varchar(55) NOT NULL,
  `session_code` varchar(55) NOT NULL,
  `Roll` varchar(3) DEFAULT NULL,
  `DOA` varchar(10) DEFAULT NULL,
  `Mothers_Name` varchar(22) DEFAULT NULL,
  `adminslno` varchar(14) DEFAULT NULL,
  `Vill` varchar(22) DEFAULT NULL,
  `Post` varchar(19) DEFAULT NULL,
  `PS` varchar(11) DEFAULT NULL,
  `Dist` varchar(11) DEFAULT NULL,
  `Pin` varchar(6) DEFAULT NULL,
  `Contact_no` varchar(11) DEFAULT NULL,
  `autosl` int(4) DEFAULT NULL,
  `mstatus` varchar(12) NOT NULL,
  `aadhar` varchar(20) NOT NULL,
  `qualification` varchar(100) NOT NULL,
  `regno` varchar(25) NOT NULL,
  `fathers_occupation` varchar(25) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student_info`
--

INSERT INTO `student_info` (`slno`, `Student_Id`, `St_Name`, `Fathers_Name`, `DOB`, `Gender`, `Cust`, `Religion`, `Mother_Trong`, `Session1`, `session_month`, `session_code`, `Roll`, `DOA`, `Mothers_Name`, `adminslno`, `Vill`, `Post`, `PS`, `Dist`, `Pin`, `Contact_no`, `autosl`, `mstatus`, `aadhar`, `qualification`, `regno`, `fathers_occupation`) VALUES
(1, '2018001', 'AL BISWAS', 'MR ALEX', '2018-03-08', 'MALE', 'GENERAL', 'HINDU', '', '2018', '3', '001', '', '2018-01-04', 'MM BISWAS', '', 'ML ROAD', 'KRISHNAGAR', 'KOTWALI', 'NADIA', '741101', '9000123456', NULL, 'SINGLE', '123456789321', 'MADHYAMIK', '0010130001', 'SERVICE MAN'),
(2, '2018002', 'AL BISWAS', 'MR ALEX', '2018-03-08', 'MALE', 'GENERAL', 'HINDU', '', '2018', '3', '001', '', '2018-01-04', 'MM BISWAS', '', 'ML ROAD', 'KRISHNAGAR', 'KOTWALI', 'NADIA', '741101', '9000123456', NULL, 'SINGLE', '123456789321', 'MADHYAMIK', '0010130002', 'SERVICE MAN');

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE IF NOT EXISTS `user_info` (
`user_id` int(22) NOT NULL,
  `user_name` varchar(55) NOT NULL,
  `password` varchar(55) NOT NULL,
  `type` varchar(15) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`user_id`, `user_name`, `password`, `type`) VALUES
(1, 'admin', 'admin', 'administrator');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cash_in_bank`
--
ALTER TABLE `cash_in_bank`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cash_in_hand`
--
ALTER TABLE `cash_in_hand`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
 ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `daybook`
--
ALTER TABLE `daybook`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
 ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `pursuing_course`
--
ALTER TABLE `pursuing_course`
 ADD PRIMARY KEY (`pusuing_id`);

--
-- Indexes for table `student_info`
--
ALTER TABLE `student_info`
 ADD PRIMARY KEY (`Student_Id`), ADD UNIQUE KEY `sl` (`slno`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
 ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cash_in_bank`
--
ALTER TABLE `cash_in_bank`
MODIFY `id` int(25) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `cash_in_hand`
--
ALTER TABLE `cash_in_hand`
MODIFY `id` int(25) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
MODIFY `course_id` int(22) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `daybook`
--
ALTER TABLE `daybook`
MODIFY `id` int(25) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
MODIFY `payment_id` int(25) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `pursuing_course`
--
ALTER TABLE `pursuing_course`
MODIFY `pusuing_id` int(25) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `student_info`
--
ALTER TABLE `student_info`
MODIFY `slno` int(25) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
MODIFY `user_id` int(22) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
