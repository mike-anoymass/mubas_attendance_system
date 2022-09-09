-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 13, 2021 at 02:52 AM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `attendance`
--

-- --------------------------------------------------------

--
-- Table structure for table `collectedcertificates`
--

DROP TABLE IF EXISTS `collectedcertificates`;
CREATE TABLE IF NOT EXISTS `collectedcertificates` (
  `student` varchar(30) NOT NULL,
  `date` datetime DEFAULT NULL,
  `issuer` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`student`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `collectedcertificates`
--

INSERT INTO `collectedcertificates` (`student`, `date`, `issuer`) VALUES
('cit001', '2021-10-12 07:17:34', 'Mike Mhango'),
('cit002', '2021-10-12 07:17:34', 'Mike Mhango');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

DROP TABLE IF EXISTS `courses`;
CREATE TABLE IF NOT EXISTS `courses` (
  `id` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `level` int(4) DEFAULT NULL,
  `credit` int(4) DEFAULT NULL,
  `dateRegistered` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `name`, `level`, `credit`, `dateRegistered`) VALUES
('coa-202', 'Managerial Accounting', 4, 3, '2021-08-28 22:49:26'),
('img', 'computer Graphics', 4, 4, '2021-08-31 03:33:34'),
('net-301', 'Networking ', 2, 4, '2021-08-31 03:29:20'),
('sam-301', 'Server Administration', 2, 4, '2021-08-28 22:48:52'),
('web-202', 'Web programming', 9, 5, '2021-08-31 03:29:48');

-- --------------------------------------------------------

--
-- Table structure for table `coursestolecturerallocation`
--

DROP TABLE IF EXISTS `coursestolecturerallocation`;
CREATE TABLE IF NOT EXISTS `coursestolecturerallocation` (
  `lecturerID` varchar(30) NOT NULL,
  `courseID` varchar(100) NOT NULL,
  `dayOfWeek` int(11) NOT NULL,
  `timeRange` int(11) NOT NULL,
  `room` varchar(40) DEFAULT NULL,
  `dateRegistered` datetime DEFAULT NULL,
  PRIMARY KEY (`lecturerID`,`courseID`),
  KEY `courseID` (`courseID`),
  KEY `dayOfWeek` (`dayOfWeek`),
  KEY `timeRange` (`timeRange`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `coursestolecturerallocation`
--

INSERT INTO `coursestolecturerallocation` (`lecturerID`, `courseID`, `dayOfWeek`, `timeRange`, `room`, `dateRegistered`) VALUES
('lect-001', 'coa-202', 32, 13, '101', '2021-10-11 07:45:47'),
('lect-001', 'net-301', 32, 14, '102', '2021-10-11 07:47:11'),
('lect-002', 'img', 32, 14, '102', '2021-10-11 07:47:42'),
('lect-002', 'sam-301', 26, 14, '104', '2021-10-11 07:47:57'),
('lect-002', 'web-202', 26, 13, '102', '2021-10-11 07:46:07');

-- --------------------------------------------------------

--
-- Table structure for table `coursestoprogramsallocation`
--

DROP TABLE IF EXISTS `coursestoprogramsallocation`;
CREATE TABLE IF NOT EXISTS `coursestoprogramsallocation` (
  `courseID` varchar(100) NOT NULL,
  `programID` varchar(100) NOT NULL,
  `unitCode` varchar(100) NOT NULL,
  `dateRegistered` datetime DEFAULT NULL,
  PRIMARY KEY (`programID`,`courseID`),
  KEY `courseID` (`courseID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `coursestoprogramsallocation`
--

INSERT INTO `coursestoprogramsallocation` (`courseID`, `programID`, `unitCode`, `dateRegistered`) VALUES
('coa-202', 'advanced', 'unit1', '2021-10-08 06:26:22'),
('web-202', 'advanced', 'uni4', '2021-10-08 06:26:03'),
('net-301', 'CCNA', 'unit', '2021-10-08 06:27:38'),
('img', 'diploma', 'unit', '2021-10-08 06:26:36'),
('sam-301', 'diploma', 'unit7', '2021-10-08 06:28:23');

-- --------------------------------------------------------

--
-- Table structure for table `days`
--

DROP TABLE IF EXISTS `days`;
CREATE TABLE IF NOT EXISTS `days` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dayName` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `dayName` (`dayName`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `days`
--

INSERT INTO `days` (`id`, `dayName`) VALUES
(32, 'Friday'),
(26, 'Saturday'),
(24, 'Sunday');

-- --------------------------------------------------------

--
-- Table structure for table `intake`
--

DROP TABLE IF EXISTS `intake`;
CREATE TABLE IF NOT EXISTS `intake` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `start` varchar(30) NOT NULL,
  `end` varchar(30) NOT NULL,
  `year` varchar(6) DEFAULT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `intake`
--

INSERT INTO `intake` (`id`, `start`, `end`, `year`, `date`) VALUES
(1, 'september', 'december', '2020', '2021-10-13'),
(2, 'january', 'april', '2021', '2021-10-11'),
(3, 'january', 'april', '2021', '2021-10-11');

-- --------------------------------------------------------

--
-- Table structure for table `lecturerattendance`
--

DROP TABLE IF EXISTS `lecturerattendance`;
CREATE TABLE IF NOT EXISTS `lecturerattendance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lecturerID` varchar(30) NOT NULL,
  `courseID` varchar(100) NOT NULL,
  `attended` int(1) NOT NULL,
  `dateRegistered` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `lecturerID` (`lecturerID`),
  KEY `courseID` (`courseID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lecturerattendance`
--

INSERT INTO `lecturerattendance` (`id`, `lecturerID`, `courseID`, `attended`, `dateRegistered`) VALUES
(1, 'lect-002', 'img', 1, '2021-10-12'),
(2, 'lect-002', 'sam-301', 1, '2021-10-12');

-- --------------------------------------------------------

--
-- Table structure for table `lecturers`
--

DROP TABLE IF EXISTS `lecturers`;
CREATE TABLE IF NOT EXISTS `lecturers` (
  `id` varchar(30) NOT NULL,
  `firstname` varchar(55) NOT NULL,
  `lastname` varchar(55) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `dateRegistered` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lecturers`
--

INSERT INTO `lecturers` (`id`, `firstname`, `lastname`, `gender`, `phone`, `email`, `dateRegistered`) VALUES
('lect-001', 'Osman', 'Sakala', 'male', '0994940404', 'osman@gmai.com', '2021-08-27 18:55:18'),
('lect-002', 'Sarah', 'khudze', 'female', '0883949490', 'sara@gmai.com', '2021-08-27 18:56:26');

-- --------------------------------------------------------

--
-- Table structure for table `programs`
--

DROP TABLE IF EXISTS `programs`;
CREATE TABLE IF NOT EXISTS `programs` (
  `id` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `tuitionFee` double NOT NULL,
  `dateRegistered` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `programs`
--

INSERT INTO `programs` (`id`, `name`, `tuitionFee`, `dateRegistered`) VALUES
('advanced', 'Advanced Diploma', 250000, '2021-10-08 05:46:56'),
('CCNA', 'Cisco Networking ', 15000, '2021-08-27 18:50:32'),
('diploma', 'Diploma ', 150000, '2021-10-08 05:46:19');

-- --------------------------------------------------------

--
-- Table structure for table `studentattendance`
--

DROP TABLE IF EXISTS `studentattendance`;
CREATE TABLE IF NOT EXISTS `studentattendance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `studentID` varchar(30) NOT NULL,
  `courseID` varchar(100) NOT NULL,
  `attended` int(1) NOT NULL,
  `dateRegistered` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `courseID` (`courseID`),
  KEY `studentID` (`studentID`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `studentattendance`
--

INSERT INTO `studentattendance` (`id`, `studentID`, `courseID`, `attended`, `dateRegistered`) VALUES
(1, 'cit003', 'img', 1, '2021-10-12'),
(2, 'cit004', 'img', 1, '2021-10-12'),
(3, 'cit005', 'img', 1, '2021-10-12'),
(4, 'cit006', 'img', 1, '2021-10-12'),
(5, 'cit017', 'img', 1, '2021-10-12'),
(6, 'cit019', 'img', 1, '2021-10-12'),
(7, 'cit003', 'sam-301', 1, '2021-10-12'),
(8, 'cit004', 'sam-301', 1, '2021-10-12'),
(9, 'cit005', 'sam-301', 1, '2021-10-12'),
(10, 'cit006', 'sam-301', 0, '2021-10-12'),
(11, 'cit017', 'sam-301', 0, '2021-10-12'),
(12, 'cit019', 'sam-301', 0, '2021-10-12');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
CREATE TABLE IF NOT EXISTS `students` (
  `id` varchar(30) NOT NULL,
  `firstname` varchar(55) NOT NULL,
  `lastname` varchar(55) NOT NULL,
  `programID` varchar(100) NOT NULL,
  `intake` int(11) NOT NULL,
  `dateRegistered` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `intake` (`intake`),
  KEY `programID` (`programID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `firstname`, `lastname`, `programID`, `intake`, `dateRegistered`) VALUES
('cit001', 'Mike', 'mhango', 'diploma', 1, '2021-10-09 11:03:11'),
('cit002', 'Vinjero', 'mhango', 'diploma', 1, '2021-10-09 11:03:11'),
('cit003', 'katikafwe', 'banda', 'diploma', 2, '2021-10-09 11:03:11'),
('cit004', 'mirrie', 'gibo', 'diploma', 2, '2021-10-09 11:03:12'),
('cit005', 'agness', 'seda', 'diploma', 3, '2021-10-09 11:03:12'),
('cit006', 'wongani', 'kapichi', 'diploma', 3, '2021-10-09 11:03:12'),
('cit007', 'davies', 'chanthunga', 'CCNA', 1, '2021-10-09 11:03:12'),
('cit008', 'chimwemwe', 'Phiri', 'CCNA', 1, '2021-10-09 11:03:12'),
('cit009', 'jovan', 'pempho', 'CCNA', 2, '2021-10-09 11:03:12'),
('cit010', 'stella', 'Phiri', 'CCNA', 2, '2021-10-09 11:03:12'),
('cit011', 'tamando', 'zoko', 'CCNA', 3, '2021-10-09 11:03:12'),
('cit012', 'kiwake', 'njolo', 'CCNA', 3, '2021-10-09 11:03:12'),
('cit013', 'wampapa', 'zake', 'advanced', 3, '2021-10-09 11:03:12'),
('cit014', 'khethiwe', 'zamabo', 'advanced', 3, '2021-10-09 11:03:12'),
('cit015', 'fraser', 'hepeni', 'advanced', 2, '2021-10-09 11:03:12'),
('cit016', 'umali', 'banda', 'advanced', 1, '2021-10-09 11:03:12'),
('cit017', 'jossam', 'mkandawire', 'diploma', 3, '2021-10-09 11:03:12'),
('cit018', 'frank', 'zothoka', 'CCNA', 2, '2021-10-09 11:03:12'),
('cit019', 'keneth', 'mhango', 'diploma', 1, '2021-10-09 11:03:12'),
('cit020', 'winnie', 'libamba', 'advanced', 2, '2021-10-09 11:03:12');

-- --------------------------------------------------------

--
-- Table structure for table `timerange`
--

DROP TABLE IF EXISTS `timerange`;
CREATE TABLE IF NOT EXISTS `timerange` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `startTime` varchar(10) NOT NULL,
  `endTime` varchar(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `timerange`
--

INSERT INTO `timerange` (`id`, `startTime`, `endTime`) VALUES
(13, '08:00', '10:00'),
(14, '10:00', '12:00'),
(15, '14:00', '16:00'),
(16, '16:00', '18:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `firstname` varchar(55) NOT NULL,
  `lastname` varchar(55) NOT NULL,
  `username` varchar(40) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `dateRegistered` datetime DEFAULT NULL,
  `password` varchar(40) NOT NULL,
  `typeOfUser` varchar(30) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`firstname`, `lastname`, `username`, `phone`, `email`, `gender`, `dateRegistered`, `password`, `typeOfUser`) VALUES
('Mike', 'Mhango', 'mmhango', '0884799203', 'mikelibamba@gmail.com', 'female', '2021-08-01 00:00:00', 'mike', 'Administrator'),
('Susan', 'Kadzingwe', 'skadzongwe', '0993848494', 's@g.com', 'female', '2021-08-27 00:00:00', 'susan', 'Secretary'),
('zondiwe', 'phiri', 'zphiri', '0993949494', 'zozndi@gmail.com', 'male', '2021-08-27 18:47:07', 'phiri', 'Technician');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `collectedcertificates`
--
ALTER TABLE `collectedcertificates`
  ADD CONSTRAINT `collectedcertificates_ibfk_1` FOREIGN KEY (`student`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `coursestolecturerallocation`
--
ALTER TABLE `coursestolecturerallocation`
  ADD CONSTRAINT `coursestolecturerallocation_ibfk_1` FOREIGN KEY (`lecturerID`) REFERENCES `lecturers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `coursestolecturerallocation_ibfk_2` FOREIGN KEY (`courseID`) REFERENCES `coursestoprogramsallocation` (`courseID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `coursestolecturerallocation_ibfk_3` FOREIGN KEY (`dayOfWeek`) REFERENCES `days` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `coursestolecturerallocation_ibfk_4` FOREIGN KEY (`timeRange`) REFERENCES `timerange` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `coursestoprogramsallocation`
--
ALTER TABLE `coursestoprogramsallocation`
  ADD CONSTRAINT `coursestoprogramsallocation_ibfk_1` FOREIGN KEY (`programID`) REFERENCES `programs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `coursestoprogramsallocation_ibfk_2` FOREIGN KEY (`courseID`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lecturerattendance`
--
ALTER TABLE `lecturerattendance`
  ADD CONSTRAINT `lecturerattendance_ibfk_1` FOREIGN KEY (`lecturerID`) REFERENCES `lecturers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lecturerattendance_ibfk_2` FOREIGN KEY (`courseID`) REFERENCES `coursestoprogramsallocation` (`courseID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `studentattendance`
--
ALTER TABLE `studentattendance`
  ADD CONSTRAINT `studentattendance_ibfk_1` FOREIGN KEY (`courseID`) REFERENCES `coursestoprogramsallocation` (`courseID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `studentattendance_ibfk_2` FOREIGN KEY (`studentID`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`intake`) REFERENCES `intake` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `students_ibfk_2` FOREIGN KEY (`programID`) REFERENCES `programs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
