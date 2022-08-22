-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 22, 2022 at 12:40 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ejn_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `transaction_record`
--

CREATE TABLE `transaction_record` (
  `id` int(11) NOT NULL,
  `invoice` varchar(100) NOT NULL,
  `date` varchar(50) DEFAULT NULL,
  `contract` varchar(50) DEFAULT NULL,
  `seller` varchar(50) DEFAULT NULL,
  `noSack` double DEFAULT NULL,
  `gross` double DEFAULT NULL,
  `tare` double DEFAULT NULL,
  `net_weight` double DEFAULT NULL,
  `dust` double DEFAULT NULL,
  `new_dust` double DEFAULT NULL,
  `total_dust` double DEFAULT NULL,
  `moisture` double DEFAULT NULL,
  `discount` double DEFAULT NULL,
  `total_moisture` double DEFAULT NULL,
  `net_res` double DEFAULT NULL,
  `first_res` double DEFAULT NULL,
  `sec_res` double DEFAULT NULL,
  `third_res` double DEFAULT NULL,
  `total_first_res` double DEFAULT NULL,
  `total_sec_res` double DEFAULT NULL,
  `total_third_res` double DEFAULT NULL,
  `total_amount` double DEFAULT NULL,
  `less` double DEFAULT NULL,
  `amount_paid` double DEFAULT NULL,
  `amount_words` varchar(100) DEFAULT NULL,
  `rese_weight_1` float DEFAULT NULL,
  `rese_weight_2` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaction_record`
--

INSERT INTO `transaction_record` (`id`, `invoice`, `date`, `contract`, `seller`, `noSack`, `gross`, `tare`, `net_weight`, `dust`, `new_dust`, `total_dust`, `moisture`, `discount`, `total_moisture`, `net_res`, `first_res`, `sec_res`, `third_res`, `total_first_res`, `total_sec_res`, `total_third_res`, `total_amount`, `less`, `amount_paid`, `amount_words`, `rese_weight_1`, `rese_weight_2`) VALUES
(107, '001', '2022-08-18', 'SPOT', 'dale ronald', 100, 2000, 10, 1990, 1, 20, 1970, 8, 2, -39, 1931, 44, 0, 0, 84964, 0, 0, 84964, 0, 84964, 'Eighty Four Thousand Nine Hundred Sixty Four peso/s', 1931, 0),
(108, '002', '2022-08-18', 'SPOT', 'dale ronald', 100, 2000, 1, 1999, 1, 20, 1979, 13, 8.1, -160, 1819, 29, 0, 0, 52751, 0, 0, 52751, 0, 52751, 'Fifty Two Thousand Seven Hundred Fifty One peso/s', 1819, 0),
(109, '003', '2022-08-18', 'SPOT', 'dale ronald', 1000, 233, 12, 221, 1, 2, 219, 13, 8.1, -18, 201, 23, 0, 0, 4623, 0, 0, 4623, 0, 4623, 'Four Thousand Six Hundred Twenty Three peso/s', 201, 0),
(110, '004', '2022-08-18', '2022-001', 'dale ronald', 23, 10000, 1, 9999, 0, 0, 9999, 0, 0, 0, 9999, 29, 23, 0, 7076, 224365, 0, 231441, 1000, 230441, 'Two Hundred Thirty   Thousand Four Hundred Forty One peso/s', 244, 9755),
(111, '005', '2022-08-22', 'SPOT', 'dale ronald', 3434, 232, 2323, -2091, 1, -21, -2070, 13, 8.1, 168, -2238, 23, 0, 0, -51474, 0, 0, -51474, 0, -51474, '  peso/s', -2238, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `transaction_record`
--
ALTER TABLE `transaction_record`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `transaction_record`
--
ALTER TABLE `transaction_record`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
