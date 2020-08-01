-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 01, 2020 at 09:55 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jyoti_task`
--

-- --------------------------------------------------------

--
-- Table structure for table `information`
--

CREATE TABLE `information` (
  `inforamtionID` int(11) NOT NULL,
  `requested_email` varchar(100) CHARACTER SET utf8 NOT NULL,
  `request_no` bigint(20) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `information`
--

INSERT INTO `information` (`inforamtionID`, `requested_email`, `request_no`, `created_at`) VALUES
(1, 'jyotisinghaugust@gmail.com', 3, '2020-08-01 06:15:02'),
(2, 'jyotisingh@gmail.com', 3, '2020-08-01 07:48:35'),
(3, 'jyotisingh1@gmail.com', 1, '2020-08-01 07:48:38');

-- --------------------------------------------------------

--
-- Table structure for table `information_mapping`
--

CREATE TABLE `information_mapping` (
  `mappingID` int(11) NOT NULL,
  `information_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `information_mapping`
--

INSERT INTO `information_mapping` (`mappingID`, `information_id`, `created_at`) VALUES
(1, 1, '2020-08-01 06:14:40'),
(2, 1, '2020-08-01 06:15:01'),
(3, 1, '2020-08-01 06:15:02'),
(4, 2, '2020-08-01 06:15:42'),
(5, 2, '2020-08-01 07:41:47'),
(6, 2, '2020-08-01 07:48:35'),
(7, 3, '2020-08-01 07:48:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `information`
--
ALTER TABLE `information`
  ADD PRIMARY KEY (`inforamtionID`);

--
-- Indexes for table `information_mapping`
--
ALTER TABLE `information_mapping`
  ADD PRIMARY KEY (`mappingID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `information`
--
ALTER TABLE `information`
  MODIFY `inforamtionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `information_mapping`
--
ALTER TABLE `information_mapping`
  MODIFY `mappingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
