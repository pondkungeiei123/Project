-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2023 at 05:35 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `testdata2`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ad_id` int(11) NOT NULL,
  `ad_name` varchar(50) DEFAULT NULL,
  `ad_lastname` varchar(50) DEFAULT NULL,
  `ad_email` varchar(100) DEFAULT NULL,
  `ad_password` varchar(20) DEFAULT NULL,
  `ad_gender` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ad_id`, `ad_name`, `ad_lastname`, `ad_email`, `ad_password`, `ad_gender`) VALUES
(2, 'สมจิต', 'นาน้อย', 'kanatakungtot@gmail.com', '$2y$10$IMR35ur8Vuqjz', 'female'),
(3, 'pond', 'kub', 'pondkungtot@gmail.com', '123123', 'male');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `cus_id` int(11) NOT NULL,
  `cus_name` varchar(50) DEFAULT NULL,
  `cus_lastname` varchar(50) DEFAULT NULL,
  `cus_email` varchar(100) DEFAULT NULL,
  `cus_password` varchar(255) DEFAULT NULL,
  `cus_gender` varchar(10) DEFAULT NULL,
  `cus_address` varchar(255) DEFAULT NULL,
  `cus_tel` varchar(15) DEFAULT NULL,
  `cus_age` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cus_id`, `cus_name`, `cus_lastname`, `cus_email`, `cus_password`, `cus_gender`, `cus_address`, `cus_tel`, `cus_age`) VALUES
(7, 'สมสัก', 'นาสิง', 'pondkungtot@gmail.com', '$2y$10$kdNtGCr5Lr.8LGx6cYqQaehZxbpIbG8exsVqAH8fvd6tZ.y6ktEZK', 'male', '123123123', '0659977988', 22),
(8, 'สมสัก', 'นาสิง', 'pondkungtot@gmail.com', '$2y$10$YcecZmLMXnHrDfZTOtc0/.ftGSQWxXA.M75O7fZk2E6WrZZse7aQu', 'male', '123123123', '0659977988', 22);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_lastname` varchar(50) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_gender` varchar(10) DEFAULT NULL,
  `user_address` varchar(255) DEFAULT NULL,
  `user_tel` varchar(15) DEFAULT NULL,
  `user_age` int(11) DEFAULT NULL,
  `user_Certificate` mediumblob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_lastname`, `user_email`, `user_password`, `user_gender`, `user_address`, `user_tel`, `user_age`, `user_Certificate`) VALUES
(6, 'นายศุภรักษ์ ', 'สะเดา', 'pondkungtot123@gmail.com', '123123123', 'male', '52/13 ร้อเอ็ด ร้อยเอ็ด', '0650949790', 22, NULL),
(10, 'ชายสี่', 'บะหมี่เกี๊ยว', 'pondkungtot123@gmail.com', '', 'male', 'asdf', '0650949790', 20, NULL),
(11, 'พิชิตชัย', 'ธรรมชัย', 'momkingtot@gmail.com', '$2y$10$zQPwpincAUpzzLP0JkL3XuBrPlue7/Pdg640prJXwFSdCDSG5v7mG', 'male', '52/13 ร้อเอ็ด ร้อยเอ็ด', '0987584315', 22, NULL),
(12, 'ชัย', 'ยา', 'momkingtot@gmail.com', '', 'male', '52/13 ร้อเอ็ด ร้อยเอ็ด', '0987584315', 22, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ad_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cus_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `ad_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `cus_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
