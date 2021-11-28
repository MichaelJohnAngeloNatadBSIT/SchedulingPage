-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2021 at 03:24 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `appointments_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_accepted_appointments`
--

CREATE TABLE `tbl_accepted_appointments` (
  `schedule_id` int(11) NOT NULL,
  `appointment_id` int(11) NOT NULL,
  `client_username` varchar(50) NOT NULL,
  `client_schedule` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_accepted_appointments`
--

INSERT INTO `tbl_accepted_appointments` (`schedule_id`, `appointment_id`, `client_username`, `client_schedule`) VALUES
(1, 4, 'test', '0000-00-00 00:00:00'),
(2, 4, 'test', '0000-00-00 00:00:00'),
(3, 5, 'GLEND', '0000-00-00 00:00:00'),
(4, 4, 'test', '0000-00-00 00:00:00'),
(5, 4, 'test', '2021-11-25 00:00:00'),
(6, 5, 'GLEND', '2021-11-26 12:00:00'),
(7, 2, 'GLEND', '2021-11-22 12:00:00'),
(8, 2, 'GLEND', '2021-11-22 12:00:00'),
(9, 4, 'test', '2021-11-25 12:00:00'),
(10, 4, 'test', '2021-11-25 12:00:00'),
(11, 5, 'GLEND', '2021-11-26 12:00:00'),
(12, 5, 'GLEND', '2021-11-26 12:00:00'),
(13, 5, 'GLEND', '2021-11-26 12:00:00'),
(14, 4, 'test', '2021-11-25 12:00:00'),
(15, 4, 'test', '2021-11-25 12:00:00'),
(16, 5, 'GLEND', '2021-11-26 12:00:00'),
(17, 6, 'Michael John Angelo', '2021-11-29 08:00:00'),
(18, 5, 'GLEND', '2021-11-26 12:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_appointments`
--

CREATE TABLE `tbl_appointments` (
  `appointment_id` int(11) NOT NULL,
  `client_fname` varchar(50) NOT NULL,
  `client_lname` varchar(5) NOT NULL,
  `client_gender` varchar(50) NOT NULL,
  `client_number` varchar(100) NOT NULL,
  `client_email` varchar(50) NOT NULL,
  `client_address` varchar(50) NOT NULL,
  `client_description` varchar(100) NOT NULL,
  `client_schedule` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_appointments`
--

INSERT INTO `tbl_appointments` (`appointment_id`, `client_fname`, `client_lname`, `client_gender`, `client_number`, `client_email`, `client_address`, `client_description`, `client_schedule`) VALUES
(1, 'GLEND', 'REYES', 'Male', '09632972792', 'angelonatad22@gmail.com', 'PUROK 3 PROPER BALAYBAY', 'tet', '2021-11-22 00:00:00'),
(2, 'GLEND', 'REYES', 'Male', '09632972792', 'glendreyes40@gmail.com', 'PUROK 3 PROPER BALAYBAY', 'asasasasfdf', '2021-11-22 12:00:00'),
(3, 'GLEND', 'REYES', 'Male', '09632972792', 'glendreyes40@gmail.com', 'PUROK 3 PROPER BALAYBAY', 'asdasd', '2021-11-22 12:00:00'),
(4, 'test', 'test', 'Male', '123123', 'angelonatad22@gmail.com', 'test', 'asdasda', '2021-11-25 12:00:00'),
(5, 'GLEND', 'REYES', 'Male', '09632972792', 'angelonatad22@gmail.com', 'PUROK 3 PROPER BALAYBAY', 'asdasd', '2021-11-26 12:00:00'),
(6, 'Michael John Angelo', 'Natad', 'Male', '09186133041', 'angelonatad22@gmail.com', 'East Tapinac', 'HeadAche', '2021-11-29 08:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_accepted_appointments`
--
ALTER TABLE `tbl_accepted_appointments`
  ADD PRIMARY KEY (`schedule_id`),
  ADD KEY `appointment_id` (`appointment_id`);

--
-- Indexes for table `tbl_appointments`
--
ALTER TABLE `tbl_appointments`
  ADD PRIMARY KEY (`appointment_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_accepted_appointments`
--
ALTER TABLE `tbl_accepted_appointments`
  MODIFY `schedule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_appointments`
--
ALTER TABLE `tbl_appointments`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
