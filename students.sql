-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 27, 2021 at 10:25 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `students`
--

-- --------------------------------------------------------

--
-- Table structure for table `seats`
--

CREATE TABLE `seats` (
  `id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `neptun_id` varchar(50) DEFAULT NULL,
  `seat_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `seats`
--

INSERT INTO `seats` (`id`, `type`, `neptun_id`, `seat_status`) VALUES
(1, 'bus', 'ASC8GF', 'occupied'),
(2, 'bus', 'DC5QSW', 'occupied'),
(3, 'bus', NULL, 'n/a'),
(4, 'bus', NULL, 'n/a'),
(5, 'bus', NULL, 'n/a'),
(6, 'bus', NULL, 'n/a'),
(7, 'bus', NULL, 'n/a'),
(8, 'bus', NULL, 'n/a'),
(9, 'bus', NULL, 'n/a'),
(10, 'bus', NULL, 'n/a'),
(11, 'bus', NULL, 'n/a'),
(12, 'bus', NULL, 'n/a'),
(13, 'bus', NULL, 'n/a'),
(14, 'bus', NULL, 'n/a'),
(15, 'bus', NULL, 'n/a'),
(16, 'bus', NULL, 'n/a'),
(17, 'bus', NULL, 'n/a'),
(18, 'bus', NULL, 'n/a'),
(19, 'bus', NULL, 'n/a'),
(20, 'bus', NULL, 'n/a'),
(21, 'bus', NULL, 'n/a'),
(22, 'bus', NULL, 'n/a'),
(23, 'bus', NULL, 'n/a'),
(24, 'bus', NULL, 'n/a'),
(25, 'bus', NULL, 'n/a'),
(26, 'bus', NULL, 'n/a'),
(27, 'bus', NULL, 'n/a'),
(28, 'bus', NULL, 'n/a'),
(29, 'bus', NULL, 'n/a'),
(30, 'bus', NULL, 'n/a'),
(31, 'bus', NULL, 'n/a'),
(32, 'bus', NULL, 'n/a'),
(33, 'bus', NULL, 'n/a'),
(34, 'bus', NULL, 'n/a'),
(35, 'bus', NULL, 'n/a'),
(36, 'bus', NULL, 'n/a'),
(37, 'conference', 'ERV855', 'occupied'),
(38, 'conference', 'abcd', 'occupied'),
(39, 'conference', NULL, 'n/a'),
(40, 'conference', NULL, 'n/a'),
(41, 'conference', NULL, 'n/a'),
(42, 'conference', NULL, 'n/a'),
(43, 'conference', NULL, 'n/a'),
(44, 'conference', NULL, 'n/a'),
(45, 'conference', NULL, 'n/a'),
(46, 'conference', NULL, 'n/a'),
(47, 'conference', NULL, 'n/a'),
(48, 'conference', NULL, 'n/a'),
(49, 'conference', NULL, 'n/a'),
(50, 'conference', NULL, 'n/a'),
(51, 'conference', NULL, 'n/a'),
(52, 'conference', NULL, 'n/a'),
(53, 'conference', NULL, 'n/a'),
(54, 'conference', NULL, 'n/a'),
(55, 'conference', NULL, 'n/a'),
(56, 'conference', NULL, 'n/a'),
(57, 'conference', NULL, 'n/a'),
(58, 'conference', NULL, 'n/a'),
(59, 'conference', NULL, 'n/a'),
(60, 'conference', NULL, 'n/a'),
(61, 'conference', NULL, 'n/a'),
(62, 'conference', NULL, 'n/a'),
(63, 'conference', NULL, 'n/a'),
(64, 'conference', NULL, 'n/a'),
(65, 'conference', NULL, 'n/a'),
(66, 'conference', NULL, 'n/a'),
(67, 'conference', NULL, 'n/a'),
(68, 'conference', NULL, 'n/a'),
(69, 'conference', NULL, 'n/a'),
(70, 'conference', NULL, 'n/a'),
(71, 'conference', NULL, 'n/a'),
(72, 'conference', NULL, 'n/a'),
(73, 'conference', NULL, 'n/a'),
(74, 'conference', NULL, 'n/a'),
(75, 'conference', NULL, 'n/a'),
(76, 'conference', NULL, 'n/a'),
(77, 'conference', NULL, 'n/a'),
(78, 'conference', NULL, 'n/a'),
(79, 'conference', NULL, 'n/a'),
(80, 'conference', NULL, 'n/a'),
(81, 'conference', NULL, 'n/a'),
(82, 'conference', NULL, 'n/a'),
(83, 'conference', NULL, 'n/a'),
(84, 'conference', NULL, 'n/a'),
(85, 'conference', NULL, 'n/a'),
(86, 'conference', NULL, 'n/a'),
(87, 'conference', NULL, 'n/a'),
(88, 'conference', NULL, 'n/a'),
(89, 'conference', NULL, 'n/a'),
(90, 'conference', NULL, 'n/a'),
(91, 'conference', NULL, 'n/a'),
(92, 'conference', NULL, 'n/a');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `neptun_code` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`neptun_code`, `password`, `email`) VALUES
('abcd', '123456', 'ali77galou@gmail.com'),
('ASC8GF', 'student0004', 'std2@gmail.com'),
('DC5QSW', 'student00010', 'std3@gmail.com'),
('DRVDSE', 'student0002', 'std4@gmail.com'),
('ERV855', 'student0006', 'std5@gmail.com'),
('LMFRC5', 'student0001', 'std6@gmail.com'),
('LOU7FW', 'student0007', 'std7@gmail.com'),
('MLB8FR', 'student0009', 'std8@gmail.com'),
('P22BVR', 'student0005', 'std9@gmail.com'),
('SLU5MY', 'student0003', 'std10@gmail.com'),
('ZWX4FC', 'student0008', 'std11@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `seats`
--
ALTER TABLE `seats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`neptun_code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `seats`
--
ALTER TABLE `seats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
