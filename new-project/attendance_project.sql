-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 27, 2025 at 04:01 PM
-- Server version: 9.1.0
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `attendance_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

DROP TABLE IF EXISTS `attendance`;
CREATE TABLE IF NOT EXISTS `attendance` (
  `id` int NOT NULL AUTO_INCREMENT,
  `emp_id` varchar(10) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `status` enum('Present','Absent') DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `emp_id` (`emp_id`,`date`)
) ENGINE=MyISAM AUTO_INCREMENT=166 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `emp_id`, `date`, `status`) VALUES
(140, 'EMP002', '2025-07-23', 'Present'),
(139, 'EMP003', '2025-07-23', 'Present'),
(138, 'EMP004', '2025-07-23', 'Present'),
(137, 'EMP005', '2025-07-23', 'Present'),
(136, 'EMP006', '2025-07-23', 'Present'),
(135, 'EMP007', '2025-07-23', 'Present'),
(134, 'EMP008', '2025-07-23', 'Absent'),
(133, 'EMP009', '2025-07-23', 'Absent'),
(132, 'EMP010', '2025-07-23', 'Absent'),
(131, 'EMP011', '2025-07-23', 'Absent'),
(141, 'EMP001', '2025-07-23', 'Present'),
(142, 'EMP001', '2025-07-24', 'Present'),
(143, 'EMP002', '2025-07-24', 'Absent'),
(144, 'EMP003', '2025-07-24', 'Present'),
(145, 'EMP004', '2025-07-24', 'Absent'),
(146, 'EMP005', '2025-07-24', 'Present'),
(147, 'EMP006', '2025-07-24', 'Present'),
(148, 'EMP007', '2025-07-24', 'Absent'),
(149, 'EMP008', '2025-07-24', 'Present'),
(150, 'EMP009', '2025-07-24', 'Present'),
(151, 'EMP010', '2025-07-24', 'Absent'),
(152, 'EMP011', '2025-07-24', 'Absent'),
(153, 'EMP012', '2025-07-24', 'Present'),
(154, 'EMP001', '2025-07-27', 'Present'),
(155, 'EMP002', '2025-07-27', 'Present'),
(156, 'EMP003', '2025-07-27', 'Present'),
(157, 'EMP004', '2025-07-27', 'Present'),
(158, 'EMP005', '2025-07-27', 'Present'),
(159, 'EMP006', '2025-07-27', 'Present'),
(160, 'EMP007', '2025-07-27', 'Present'),
(161, 'EMP008', '2025-07-27', 'Absent'),
(162, 'EMP009', '2025-07-27', 'Absent'),
(163, 'EMP010', '2025-07-27', 'Absent'),
(164, 'EMP011', '2025-07-27', 'Absent'),
(165, 'EMP012', '2025-07-27', 'Absent');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
CREATE TABLE IF NOT EXISTS `employees` (
  `id` int NOT NULL AUTO_INCREMENT,
  `emp_id` varchar(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `emp_id`, `name`, `address`, `photo`) VALUES
(19, 'EMP006', 'Hema', 'Thuraiyur', 'photos/hema.webp'),
(17, 'EMP005', 'Maheswaran', 'Uppiliyapuram', 'photos/mahes.jpg'),
(14, 'EMP004', 'Ashwin', 'Thuraiyur', 'photos/baby.jpg'),
(13, 'EMP003', 'Kishore', 'Karur', 'photos/priya.jpg'),
(12, 'EMP002', 'Yugan', 'Perambalur', 'photos/yugan.jpg'),
(11, 'EMP001', 'Sayanthan', 'Lakshmi Complex, Annamalai Nagar,Trichy-620018', 'photos/sayanthan.jpg'),
(21, 'EMP007', 'Priya', 'Tiruchengode', 'photos/priya.jpg'),
(22, 'EMP008', 'Lavanya', 'Musiri', 'photos/lavi.jpg'),
(23, 'EMP009', 'Nitish', 'Salem', 'photos/nitish.jpg'),
(24, 'EMP010', 'Surya', 'Kumbakonam', 'photos/Surya.jpeg'),
(25, 'EMP011', 'Veeran', 'Cuddalore', 'photos/veeran.jpeg'),
(26, 'EMP012', 'Saburnisha', 'Gandhi Colony, Near Annai Hospital, Thuraiyur-621010', 'photos/sabur.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `reset_token` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `reset_token`) VALUES
(1, 'yugan', '8148745041', 'maheskarupaiya@gmail.com', NULL),
(2, 'hema', '12345', 'darshinihema2102@gmail.com', NULL),
(3, 'kishore', '934405834', 'kishoreselvam@gmail.com', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
