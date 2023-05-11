-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2023 at 03:55 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

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
-- Table structure for table `bales_transaction`
--

CREATE TABLE `bales_transaction` (
  `id` int(11) NOT NULL,
  `invoice` varchar(255) NOT NULL,
  `date` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `contract` varchar(255) DEFAULT NULL,
  `seller` varchar(255) DEFAULT NULL,
  `delivery_date` date DEFAULT NULL,
  `lot_code` varchar(255) DEFAULT NULL,
  `entry` int(100) DEFAULT NULL,
  `net_weight_1` int(100) DEFAULT NULL,
  `net_weight_2` int(100) DEFAULT NULL,
  `total_net_weight` int(11) NOT NULL,
  `kilo_bales_1` int(100) DEFAULT NULL,
  `kilo_bales_2` int(100) DEFAULT NULL,
  `total_bales_1` varchar(255) DEFAULT NULL,
  `total_bales_2` varchar(255) DEFAULT NULL,
  `bales_compute` varchar(255) DEFAULT NULL,
  `drc` int(100) DEFAULT NULL,
  `price_1` int(100) DEFAULT NULL,
  `price_2` int(100) DEFAULT NULL,
  `first_total` int(11) DEFAULT NULL,
  `second_total` int(11) DEFAULT NULL,
  `total_amount` int(100) DEFAULT NULL,
  `less` int(100) DEFAULT NULL,
  `amount_paid` int(100) DEFAULT NULL,
  `words_amount` varchar(255) DEFAULT NULL,
  `loc` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bales_transaction`
--

INSERT INTO `bales_transaction` (`id`, `invoice`, `date`, `address`, `contract`, `seller`, `delivery_date`, `lot_code`, `entry`, `net_weight_1`, `net_weight_2`, `total_net_weight`, `kilo_bales_1`, `kilo_bales_2`, `total_bales_1`, `total_bales_2`, `bales_compute`, `drc`, `price_1`, `price_2`, `first_total`, `second_total`, `total_amount`, `less`, `amount_paid`, `words_amount`, `loc`) VALUES
(12, '001', '2022-10-27', '6KM. ISABELA CITY', 'SPOT', 'RUBEN RAMOS', '2022-09-30', 'K', 5864, 3213, 0, 3213, 35, 1, '91 Bales & 28 Kg', '0 Bales ', '91.28', 55, 47, 0, NULL, NULL, 151011, 50000, 101011, 'One Hundred One Thousand Eleven Peso/s ', 'Basilan'),
(13, '001', '2022-10-27', 'SAYUGAN, LAMITAN CITY', 'SPOT', 'RASHID AMILIN', '2022-09-14', '3', 19582, 11102, 0, 11102, 35, 1, '317 Bales & 7 Kg', '0 Bales ', '317.7', 57, 51, 0, NULL, NULL, 566202, 528809, 37393, 'Thirty Seven Thousand Three Hundred Ninety Three Peso/s ', 'Basilan'),
(14, '001', '2022-10-27', 'TABIAWAN, ISABELA CITY', 'SPOT', 'NENETH COSTAN', '2022-09-05', 'K', 7463, 3901, 0, 3901, 35, 1, '111 Bales & 16 Kg', '0 Bales ', '111.16', 52, 49, 0, NULL, NULL, 191149, 182844, 8305, 'Eight Thousand Three Hundred Five Peso/s ', 'Basilan'),
(15, '001', '2022-10-27', 'TABIAWAN, ISABELA CITY', 'SPOT', 'NENETH COSTAN', '2022-08-30', 'H', 21724, 11382, 0, 11382, 35, 1, '325 Bales & 7 Kg', '0 Bales ', '325.7', 52, 52, 0, NULL, NULL, 591864, 564824, 27040, 'Twenty Seven Thousand Forty Peso/s ', 'Basilan'),
(16, '002', '2022-10-28', 'SAYUGAN, LAMITAN CITY', 'SPOT', 'TANY SULAYMAN', '2022-09-12', '8', 20956, 11589, 0, 11589, 35, 1, '331 Bales & 4 Kg', '0 Bales ', '331.4', 55, 52, 0, NULL, NULL, 602602, 576087, 26515, 'Twenty Six Thousand Five Hundred Fifteen Peso/s ', 'Basilan'),
(17, '002', '2022-10-28', 'MALOONG SAN JOSE, LAMITAN CITY', 'SPOT', 'EPIGIL MOLEJE', '2022-09-24', 'G', 5251, 2743, 0, 2743, 35, 1, '78 Bales & 13 Kg', '0 Bales ', '78.13', 52, 47, 0, NULL, NULL, 128898, 50000, 78898, 'Seventy Eight Thousand Eight Hundred Ninety Seven Peso/s And Five Centavo/s ', 'Basilan'),
(18, '002', '2022-10-28', 'TABIAWAN, ISABELA CITY', 'SPOT', 'NENETH COSTAN', '2022-09-10', 'M', 2555, 1408, 0, 1408, 35, 1, '40 Bales & 8 Kg', '0 Bales ', '40.8', 55, 47, 0, NULL, NULL, 66176, 60043, 6134, 'Six Thousand One Hundred Thirty Three Peso/s And Five Centavo/s ', 'Basilan'),
(19, '006', '2022-11-03', 'MALOONG SAN JOSE, LAMITAN CITY', 'SPOT', 'EPIGIL MOLEJE', '2022-09-29', 'H', 5501, 3018, 0, 3018, 35, 1, '86 Bales & 8 Kg', '0 Bales ', '86.8', 55, 47, 0, NULL, NULL, 141846, 100000, 41846, 'Forty One Thousand Eight Hundred Forty Six Peso/s ', 'Basilan'),
(20, '006', '2022-11-03', 'TABIAWAN, ISABELA CITY', 'SPOT', 'NENETH COSTAN', '2022-09-15', 'N', 6690, 3402, 0, 3402, 35, 1, '97 Bales & 7 Kg', '0 Bales ', '97.7', 51, 47, 0, NULL, NULL, 159894, 157215, 2679, 'Two Thousand Six Hundred Seventy Nine Peso/s ', 'Basilan'),
(21, '006', '2022-11-03', 'MALOONG, LAMITAN CITY', 'SPOT', 'RONIE VILDAD', '2022-10-02', 'S', 9129, 4672, 0, 4672, 35, 1, '133 Bales & 17 Kg', '0 Bales ', '133.17', 51, 47, 0, NULL, NULL, 219584, 214532, 5052, 'Five Thousand Fifty Two Peso/s ', 'Basilan'),
(22, '006', '2022-11-09', 'lamitan', 'SPOT', 'LITO PURI', '2022-09-30', '7', 8530, 4785, 0, 4785, 35, 1, '136 Bales & 25 Kg', '0 Bales ', '136.25', 56, 47, 0, NULL, NULL, 224895, 100000, 124895, 'One Hundred Twenty Four Thousand Eight Hundred Ninety Five Peso/s ', 'Basilan'),
(23, '006', '2022-11-09', 'SAYUGAN, LAMITAN CITY', 'SPOT', 'TANY SULAYMAN', '2022-09-19', '9', 21843, 12507, 0, 12507, 35, 1, '357 Bales & 12 Kg', '0 Bales ', '357.12', 57, 49, 0, NULL, NULL, 612843, 565911, 46932, 'Forty Six Thousand Nine Hundred Thirty Two Peso/s ', 'Basilan'),
(24, '006', '2022-11-10', 'TABIAWAN, ISABELA CITY', 'SPOT', 'NENETH COSTAN', '2022-09-18', 'O', 8313, 4359, 0, 4359, 35, 1, '124 Bales & 19 Kg', '0 Bales ', '124.19', 52, 47, 0, NULL, NULL, 204873, 195356, 9517, 'Nine Thousand Five Hundred Seventeen Peso/s ', 'Basilan'),
(25, '006', '2022-11-14', 'SAYUGAN, LAMITAN CITY', 'SPOT', 'SAMAN AWALIN', '2022-09-26', '5', 29453, 16320, 0, 16320, 35, 1, '466 Bales & 10 Kg', '0 Bales ', '466.1', 55, 51, 0, NULL, NULL, 832320, 792948, 39372, 'Thirty Nine Thousand Three Hundred Seventy Two Peso/s ', 'Basilan'),
(26, '006', '2022-11-14', 'MALOONG, LAMITAN CITY', 'SPOT', 'RONIE VILDAD', '2022-10-16', 'V', 7245, 3762, 0, 3762, 35, 1, '107 Bales & 17 Kg', '0 Bales ', '107.17', 52, 47, 0, NULL, NULL, 176814, 170258, 6556, 'Six Thousand Five Hundred Fifty Six Peso/s ', 'Basilan'),
(27, '27', '2022-11-15', 'MALOONG, LAMITAN CITY', 'SPOT', 'JIMROY MCCLINTOCK', '2022-10-01', 'I', 9235, 5357, 0, 5357, 35, 1, '153 Bales & 2 Kg', '0 Bales ', '153.2', 58, 47, 0, NULL, NULL, 251779, 150000, 101779, 'One Hundred One Thousand Seven Hundred Seventy Nine Peso/s ', 'Basilan'),
(28, '27', '2022-11-15', 'TABIAWAN, ISABELA CITY', 'SPOT', 'NENETH COSTAN', '2022-09-21', 'Q', 7339, 3675, 0, 3675, 35, 1, '105 Bales ', '0 Bales ', '105', 50, 47, 0, NULL, NULL, 172725, 172466, 259, 'Two Hundred Fifty Nine Peso/s ', 'Basilan'),
(29, '27', '2022-11-21', 'MALOONG SAN JOSE, LAMITAN CITY', 'SPOT', 'EPIGIL MOLEJE', '2022-09-28', 'I', 5108, 2500, 0, 2500, 35, 1, '71 Bales & 15 Kg', '0 Bales ', '71.15', 49, 47, 0, NULL, NULL, 117500, 50000, 67500, 'Sixty Seven Thousand Five Hundred Peso/s ', 'Basilan'),
(30, '27', '2022-11-21', 'LOOK, LAMITAN CITY', 'SPOT', 'ALIPIO', '2022-10-03', '', 6190, 3413, 0, 3413, 35, 1, '97 Bales & 18 Kg', '0 Bales ', '97.18', 55, 47, 0, NULL, NULL, 160411, 140000, 20411, 'Twenty Thousand Four Hundred Eleven Peso/s ', 'Basilan'),
(31, '27', '2022-11-24', 'MALOONG, LAMITAN CITY', 'SPOT', 'RONIE VILDAD', '2022-10-16', 'V', 7245, 3762, 0, 3762, 35, 1, '107 Bales & 17 Kg', '0 Bales ', '107.17', 52, 47, 0, NULL, NULL, 176814, 170258, 6556, 'Six Thousand Five Hundred Fifty Six Peso/s ', 'Basilan'),
(32, '27', '2022-11-24', 'MALOONG, LAMITAN CITY', 'SPOT', 'RONIE VILDAD', '2022-08-28', 'N', 3489, 1828, 0, 1828, 35, 1, '52 Bales & 8 Kg', '0 Bales ', '52.8', 52, 52, 0, NULL, NULL, 95056, 90714, 4342, 'Four Thousand Three Hundred Forty Two Peso/s ', 'Basilan'),
(33, '27', '2022-11-24', 'MALOONG, LAMITAN CITY', 'SPOT', 'RONIE VILDAD', '2022-09-04', 'O', 7046, 3741, 0, 3741, 35, 1, '106 Bales & 31 Kg', '0 Bales ', '106.31', 53, 52, 0, NULL, NULL, 194532, 183196, 11336, 'Eleven Thousand Three Hundred Thirty Six Peso/s ', 'Basilan'),
(34, '27', '2022-11-24', 'MALOONG, LAMITAN CITY', 'SPOT', 'RONIE VILDAD', '2022-09-18', 'P', 5756, 2969, 0, 2969, 35, 1, '84 Bales & 29 Kg', '0 Bales ', '84.29', 52, 48, 0, NULL, NULL, 142512, 135266, 7246, 'Seven Thousand Two Hundred Forty Six Peso/s ', 'Basilan'),
(35, '27', '2022-11-24', 'MALOONG, LAMITAN CITY', 'SPOT', 'RONIE VILDAD', '2022-09-25', 'Q', 1434, 738, 0, 738, 35, 1, '21 Bales & 3 Kg', '0 Bales ', '21.3', 51, 48, 0, NULL, NULL, 35424, 34416, 1008, 'One Thousand Eight Peso/s ', 'Basilan'),
(36, '27', '2022-11-24', 'MALOONG, LAMITAN CITY', 'SPOT', 'RONIE VILDAD', '2022-09-26', 'R', 6622, 4150, 0, 4150, 35, 1, '118 Bales & 20 Kg', '0 Bales ', '118.2', 63, 48, 0, NULL, NULL, 199200, 158928, 40272, 'Forty Thousand Two Hundred Seventy Two Peso/s ', 'Basilan'),
(37, '27', '2022-11-24', 'MALOONG, LAMITAN CITY', 'SPOT', 'RONIE VILDAD', '2022-10-02', 'T', 2930, 1677, 0, 1677, 35, 1, '47 Bales & 32 Kg', '0 Bales ', '47.32', 57, 47, 0, NULL, NULL, 78819, 68855, 9964, 'Nine Thousand Nine Hundred Sixty Four Peso/s ', 'Basilan'),
(38, '27', '2022-11-24', 'MALOONG, LAMITAN CITY', 'SPOT', 'RONIE VILDAD', '2022-10-09', 'U', 1321, 740, 0, 740, 35, 1, '21 Bales & 5 Kg', '0 Bales ', '21.5', 56, 47, 0, NULL, NULL, 34757, 31044, 3713, 'Three Thousand Seven Hundred Thirteen Peso/s ', 'Basilan'),
(39, '27', '2022-11-24', 'MALOONG, LAMITAN CITY', 'SPOT', 'RONIE VILDAD', '2022-10-16', 'V', 7245, 3762, 0, 3762, 35, 1, '107 Bales & 17 Kg', '0 Bales ', '107.17', 52, 47, 0, NULL, NULL, 176814, 170258, 6556, 'Six Thousand Five Hundred Fifty Six Peso/s ', 'Basilan'),
(40, '27', '2022-11-24', 'MALOONG, LAMITAN CITY', 'SPOT', 'RONIE VILDAD', '2022-10-30', 'X', 7702, 4466, 0, 4466, 35, 1, '127 Bales & 21 Kg', '0 Bales ', '127.21', 58, 46, 0, NULL, NULL, 205436, 177146, 28290, 'Twenty Eight Thousand Two Hundred Ninety Peso/s ', 'Basilan'),
(41, '27', '2022-11-25', 'MALOONG, LAMITAN CITY', 'SPOT', 'JIMROY MCCLINTOCK', '2022-10-31', 'K', 4831, 2700, 0, 2700, 35, 1, '77 Bales & 5 Kg', '0 Bales ', '77.5', 56, 44, 0, NULL, NULL, 118800, 100000, 18800, 'Eighteen Thousand Eight Hundred Peso/s ', 'Basilan'),
(42, '27', '2022-11-25', 'lamitan', 'SPOT', 'LITO PURI', '2022-10-31', '8', 6430, 3477, 0, 3477, 35, 1, '99 Bales & 12 Kg', '0 Bales ', '99.12', 54, 47, 0, NULL, NULL, 163419, 0, 163419, 'Peso/s ', 'Basilan'),
(43, '27', '2022-11-25', 'BINUANGAN, ISABELA CITY', 'SPOT', 'JUN  MCCLINTOCK', '2022-10-15', 'F', 6930, 4017, 0, 4017, 35, 1, '114 Bales & 27 Kg', '0 Bales ', '114.27', 58, 47, 0, NULL, NULL, 188799, 150000, 38799, 'Thirty Eight Thousand Seven Hundred Ninety Nine Peso/s ', 'Basilan'),
(44, '27', '2022-11-25', 'MALOONG, LAMITAN CITY', 'SPOT', 'JIMROY MCCLINTOCK', '2022-09-02', 'F', 6320, 3492, 0, 3492, 35, 1, '99 Bales & 27 Kg', '0 Bales ', '99.27', 55, 50, 0, NULL, NULL, 174608, 100000, 74608, 'Seventy Four Thousand Six Hundred Eight Peso/s ', 'Basilan'),
(45, '27', '2022-11-26', 'MALOONG, LAMITAN CITY', 'SPOT', 'JIMROY MCCLINTOCK', '2022-11-07', 'L', 5523, 2872, 0, 2872, 35, 1, '82 Bales & 2 Kg', '0 Bales ', '82.2', 52, 44, 0, NULL, NULL, 126368, 100000, 26368, 'Twenty Six Thousand Three Hundred Sixty Eight Peso/s ', 'Basilan'),
(46, '27', '2022-12-01', '6KM. ISABELA CITY', 'SPOT', 'RUBEN RAMOS', '2022-10-17', 'L', 1453, 736, 0, 736, 35, 1, '21 Bales & 1 Kg', '0 Bales ', '21.1', 51, 47, 0, NULL, NULL, 34592, 30000, 4592, 'Four Thousand Five Hundred Ninety Two Peso/s ', 'Basilan'),
(47, '27', '2022-12-01', '6KM. ISABELA CITY', 'SPOT', 'RUBEN RAMOS', '2022-11-10', 'M', 5247, 2724, 0, 2724, 35, 1, '77 Bales & 29 Kg', '0 Bales ', '77.29', 52, 44, 0, NULL, NULL, 119856, 90000, 29856, 'Twenty Nine Thousand Eight Hundred Fifty Six Peso/s ', 'Basilan'),
(48, '27', '2022-12-01', 'PANUNSULAN, ISABELA CITY', 'SPOT', 'LOUIE DELOS REYES', '2022-10-21', 'W', 9090, 5316, 0, 5316, 35, 1, '151 Bales & 31 Kg', '0 Bales ', '151.31', 58, 47, 0, NULL, NULL, 249852, 153181, 96671, 'Ninety Six Thousand Six Hundred Seventy One Peso/s ', 'Basilan'),
(49, '27', '2022-12-05', 'MALOONG, LAMITAN CITY', 'SPOT', 'RONIE VILDAD', '2022-10-30', 'W', 9519, 4959, 0, 4959, 35, 1, '141 Bales & 24 Kg', '0 Bales ', '141.24', 52, 46, 0, NULL, NULL, 228114, 218937, 9177, 'Nine Thousand One Hundred Seventy Seven Peso/s ', 'Basilan'),
(50, '27', '2022-12-05', 'MALOONG, LAMITAN CITY', 'SPOT', 'RONIE VILDAD', '2022-11-13', 'Y', 7932, 4168, 0, 4168, 35, 1, '119 Bales & 3 Kg', '0 Bales ', '119.3', 53, 44, 0, NULL, NULL, 183392, 174504, 8888, 'Eight Thousand Eight Hundred Eighty Eight Peso/s ', 'Basilan'),
(51, '27', '2022-12-07', 'BINUANGAN, ISABELA CITY', 'SPOT', 'JUN  MCCLINTOCK', '2022-11-16', 'G', 6970, 4074, 0, 4074, 35, 1, '116 Bales & 14 Kg', '0 Bales ', '116.14', 58, 44, 0, NULL, NULL, 179256, 150000, 29256, 'Twenty Nine Thousand Two Hundred Fifty Six Peso/s ', 'Basilan'),
(52, '27', '2022-12-07', 'PANUNSULAN, ISABELA CITY', 'SPOT', 'LOUIE DELOS REYES', '2022-10-25', 'X', 3115, 1543, 0, 1543, 35, 1, '44 Bales & 2 Kg', '0 Bales ', '44.2', 50, 47, 0, NULL, NULL, 72502, 51090, 21412, 'Twenty One Thousand Four Hundred Twelve Peso/s ', 'Basilan'),
(53, '27', '2022-12-07', 'MALOONG SAN JOSE, LAMITAN CITY', 'SPOT', 'EPIGIL MOLEJE', '2022-11-17', 'M', 6025, 3207, 0, 3207, 35, 1, '91 Bales & 22 Kg', '0 Bales ', '91.22', 53, 44, 0, NULL, NULL, 141108, 60000, 81108, 'Eighty One Thousand One Hundred Eight Peso/s ', 'Basilan'),
(54, '27', '2022-12-13', 'TABIAWAN, ISABELA CITY', 'SPOT', 'NENETH COSTAN', '2022-09-25', 'R', 9251, 5208, 0, 5208, 35, 1, '148 Bales & 28 Kg', '0 Bales ', '148.28', 56, 47, 0, NULL, NULL, 244776, 217398, 27378, 'Twenty Seven Thousand Three Hundred Seventy Eight Peso/s ', 'Basilan'),
(55, '27', '2022-12-13', 'TABIAWAN, ISABELA CITY', 'SPOT', 'NENETH COSTAN', '2022-09-28', 'S', 4398, 2173, 0, 2173, 35, 1, '62 Bales & 3 Kg', '0 Bales ', '62.3', 49, 47, 0, NULL, NULL, 102131, 103353, -1222, 'Undefined One Thousand Two Hundred Twenty Two Peso/s ', 'Basilan'),
(56, '27', '2022-12-13', 'TABIAWAN, ISABELA CITY', 'SPOT', 'NENETH COSTAN', '2022-09-30', 'T', 15596, 8082, 0, 8082, 35, 1, '230 Bales & 32 Kg', '0 Bales ', '230.32', 52, 47, 0, NULL, NULL, 379854, 366506, 13348, 'Thirteen Thousand Three Hundred Forty Eight Peso/s ', 'Basilan'),
(57, '27', '2022-12-13', 'TABIAWAN, ISABELA CITY', 'SPOT', 'NENETH COSTAN', '2022-11-02', 'U', 13687, 7114, 0, 7114, 35, 1, '203 Bales & 9 Kg', '0 Bales ', '203.9', 52, 47, 0, NULL, NULL, 334358, 321644, 12714, 'Twelve Thousand Seven Hundred Fourteen Peso/s ', 'Basilan'),
(58, '27', '2022-12-13', 'TABIAWAN, ISABELA CITY', 'SPOT', 'NENETH COSTAN', '2022-10-02', 'V', 4366, 2122, 0, 2122, 35, 1, '60 Bales & 21 Kg', '0 Bales ', '60.21', 49, 47, 0, NULL, NULL, 99711, 102601, -2891, 'Undefined Two Thousand Eight Hundred Ninety Peso/s And Five Centavo/s ', 'Basilan'),
(59, '27', '2022-12-13', 'TABIAWAN, ISABELA CITY', 'SPOT', 'NENETH COSTAN', '2022-10-14', 'X', 12624, 6937, 0, 6937, 35, 1, '198 Bales & 7 Kg', '0 Bales ', '198.7', 55, 47, 0, NULL, NULL, 326039, 296664, 29375, 'Twenty Nine Thousand Three Hundred Seventy Five Peso/s ', 'Basilan'),
(60, '27', '2022-12-13', 'TABIAWAN, ISABELA CITY', 'SPOT', 'NENETH COSTAN', '2022-10-13', 'W', 11179, 5888, 0, 5888, 35, 1, '168 Bales & 8 Kg', '0 Bales ', '168.8', 53, 47, 0, NULL, NULL, 276736, 262706, 14030, 'Fourteen Thousand Thirty Peso/s ', 'Basilan'),
(61, '27', '2022-12-13', 'TABIAWAN, ISABELA CITY', 'SPOT', 'NENETH COSTAN', '2022-10-16', 'Y', 5094, 2927, 0, 2927, 35, 1, '83 Bales & 22 Kg', '0 Bales ', '83.22', 57, 47, 0, NULL, NULL, 137569, 119709, 17860, 'Seventeen Thousand Eight Hundred Sixty Peso/s ', 'Basilan'),
(62, '27', '2022-12-13', 'TABIAWAN, ISABELA CITY', 'SPOT', 'NENETH COSTAN', '2022-10-22', 'Z', 1347, 800, 0, 800, 35, 1, '22 Bales & 30 Kg', '0 Bales ', '22.3', 59, 46, 0, NULL, NULL, 36800, 30981, 5819, 'Five Thousand Eight Hundred Nineteen Peso/s ', 'Basilan'),
(63, '27', '2022-12-13', 'TABIAWAN, ISABELA CITY', 'SPOT', 'NENETH COSTAN', '2022-10-28', 'C', 1307, 768, 0, 768, 35, 1, '21 Bales & 33 Kg', '0 Bales ', '21.33', 59, 46, 0, NULL, NULL, 35328, 30061, 5267, 'Five Thousand Two Hundred Sixty Seven Peso/s ', 'Basilan'),
(64, '27', '2022-12-13', 'TABIAWAN, ISABELA CITY', 'SPOT', 'NENETH COSTAN', '2022-10-31', 'D', 17876, 8463, 0, 8463, 35, 1, '241 Bales & 28 Kg', '0 Bales ', '241.28', 47, 46, 0, NULL, NULL, 389275, 411148, -21873, 'Undefined Million Four Hundred Eleven Thousand One Hundred Forty Eight Peso/s ', 'Basilan'),
(65, '27', '2022-12-13', 'MALOONG, LAMITAN CITY', 'SPOT', 'JIMROY MCCLINTOCK', '2022-11-22', 'M', 8317, 4600, 0, 4600, 35, 1, '131 Bales & 15 Kg', '0 Bales ', '131.15', 55, 45, 0, NULL, NULL, 207000, 150000, 57000, 'Fifty Seven Thousand Peso/s ', 'Basilan'),
(66, '27', '2022-12-14', 'PANUNSULAN, ISABELA CITY', 'SPOT', 'LOUIE DELOS REYES', '2022-11-25', 'Z', 9745, 5355, 0, 5355, 35, 1, '153 Bales ', '0 Bales ', '153', 55, 46, 0, NULL, NULL, 246330, 305857, -59527, 'Undefined Hundred Fifty Nine Thousand Five Hundred Twenty Seven Peso/s ', 'Basilan'),
(67, '27', '2022-12-14', 'PANUNSULAN, ISABELA CITY', 'SPOT', 'LOUIE DELOS REYES', '2022-11-25', 'A', 6990, 3912, 0, 3912, 35, 1, '111 Bales & 27 Kg', '0 Bales ', '111.27', 56, 46, 0, NULL, NULL, 179952, 59527, 120425, 'One Hundred Twenty Thousand Four Hundred Twenty Five Peso/s ', 'Basilan'),
(68, '27', '2022-12-16', 'PANUNSULAN, ISABELA CITY', 'SPOT', 'LOUIE DELOS REYES', '2022-11-25', 'Z', 9745, 5355, 0, 5355, 35, 1, '153 Bales ', '0 Bales ', '153', 55, 46, 0, NULL, NULL, 246330, 153411, 92919, 'Ninety Two Thousand Nine Hundred Nineteen Peso/s ', 'Basilan'),
(69, '27', '2022-12-16', 'PANUNSULAN, ISABELA CITY', 'SPOT', 'LOUIE DELOS REYES', '2022-11-25', 'A', 6990, 3912, 0, 3912, 35, 1, '111 Bales & 27 Kg', '0 Bales ', '111.27', 56, 46, 0, NULL, NULL, 179952, 102446, 77506, 'Seventy Seven Thousand Five Hundred Six Peso/s ', 'Basilan'),
(70, '27', '2022-12-20', 'SAYUGAN, LAMITAN CITY', 'SPOT', 'KIM AWALIN', '2022-09-26', '3', 22269, 12057, 0, 12057, 35, 1, '344 Bales & 16 Kg', '0 Bales ', '344.16', 54, 50, 0, NULL, NULL, 602825, 579410, 23415, 'Twenty Three Thousand Four Hundred Fifteen Peso/s ', 'Basilan'),
(71, '27', '2022-12-20', 'SAYUGAN, LAMITAN CITY', 'SPOT', 'SAMAN AWALIN', '2022-10-03', '6', 51232, 28817, 0, 28817, 35, 1, '823 Bales & 12 Kg', '0 Bales ', '823.12', 56, 50, 0, NULL, NULL, 1440850, 1353560, 87290, 'Eighty Seven Thousand Two Hundred Ninety Peso/s ', 'Basilan'),
(72, '27', '2022-12-28', 'lamitan', 'SPOT', 'LITO PURI', '2022-11-30', '9', 7470, 4231, 0, 4231, 35, 1, '120 Bales & 31 Kg', '0 Bales ', '120.31', 57, 47, 0, NULL, NULL, 198857, 0, 198857, 'One Hundred Ninety Eight Thousand Eight Hundred Fifty Seven Peso/s ', 'Basilan'),
(73, '27', '2022-12-28', 'MALOONG, LAMITAN CITY', 'SPOT', 'RONIE VILDAD', '2022-11-27', 'Z', 5220, 2666, 0, 2666, 35, 1, '76 Bales & 6 Kg', '0 Bales ', '76.6', 51, 44, 0, NULL, NULL, 117304, 114840, 2464, 'Two Thousand Four Hundred Sixty Four Peso/s ', 'Basilan'),
(74, '27', '2022-12-28', 'MALOONG, LAMITAN CITY', 'SPOT', 'RONIE VILDAD', '2022-12-04', 'A', 4858, 2705, 0, 2705, 35, 1, '77 Bales & 10 Kg', '0 Bales ', '77.1', 56, 43, 0, NULL, NULL, 116315, 104447, 11868, 'Eleven Thousand Eight Hundred Sixty Eight Peso/s ', 'Basilan'),
(75, '27', '2022-12-28', '6KM. ISABELA CITY', 'SPOT', 'RUBEN RAMOS', '2022-11-17', 'N', 861, 415, 0, 415, 35, 1, '11 Bales & 30 Kg', '0 Bales ', '11.3', 48, 44, 0, NULL, NULL, 18260, 0, 18260, 'Eighteen Thousand Two Hundred Sixty Peso/s ', 'Basilan'),
(76, '27', '2022-12-28', '6KM. ISABELA CITY', 'SPOT', 'RUBEN RAMOS', '2022-11-30', 'O', 4547, 2421, 0, 2421, 35, 1, '69 Bales & 6 Kg', '0 Bales ', '69.6', 53, 43, 0, NULL, NULL, 104103, 100000, 4103, 'Four Thousand One Hundred Three Peso/s ', 'Basilan'),
(77, '27', '2022-12-30', 'MALOONG SAN JOSE, LAMITAN CITY', 'SPOT', 'EPIGIL MOLEJE', '2022-12-07', 'N', 7941, 4259, 0, 4259, 35, 1, '121 Bales & 24 Kg', '0 Bales ', '121.24', 54, 44, 0, NULL, NULL, 187396, 100000, 87396, 'Eighty Seven Thousand Three Hundred Ninety Six Peso/s ', 'Basilan'),
(78, '27', '2022-12-30', 'MALOONG, LAMITAN CITY', 'SPOT', 'JIMROY MCCLINTOCK', '2022-12-10', 'N', 8600, 5067, 0, 5067, 35, 1, '144 Bales & 27 Kg', '0 Bales ', '144.27', 59, 46, 0, NULL, NULL, 233082, 150000, 83082, 'Eighty Three Thousand Eighty Two Peso/s ', 'Basilan'),
(79, '27', '2023-01-05', 'PANUNSULAN, ISABELA CITY', 'SPOT', 'LOUIE DELOS REYES', '2022-12-10', 'B', 6830, 3698, 0, 3698, 35, 1, '105 Bales & 23 Kg', '0 Bales ', '105.23', 54, 46, 0, NULL, NULL, 170108, 102390, 67718, 'Sixty Seven Thousand Seven Hundred Eighteen Peso/s ', 'Basilan'),
(80, '27', '2023-01-05', 'BINUANGAN, ISABELA CITY', 'SPOT', 'JUN  MCCLINTOCK', '2022-12-15', 'H', 3805, 2070, 0, 2070, 35, 1, '59 Bales & 5 Kg', '0 Bales ', '59.5', 54, 46, 0, NULL, NULL, 95220, 100000, -4780, 'Undefined Four Thousand Seven Hundred Eighty Peso/s ', 'Basilan'),
(81, '27', '2023-01-05', 'BINUANGAN, ISABELA CITY', 'SPOT', 'JUN  MCCLINTOCK', '2022-12-20', 'I', 5760, 3170, 0, 3170, 35, 1, '90 Bales & 20 Kg', '0 Bales ', '90.2', 55, 46, 0, NULL, NULL, 145820, 140000, 5820, 'Five Thousand Eight Hundred Twenty Peso/s ', 'Basilan'),
(82, '27', '2023-01-05', 'SAYUGAN, LAMITAN CITY', 'SPOT', 'HARI SABTAL', '2022-09-23', '5', 19160, 10587, 0, 10587, 35, 1, '302 Bales & 17 Kg', '0 Bales ', '302.17', 55, 50, 0, NULL, NULL, 529350, 517320, 12030, 'Twelve Thousand Thirty Peso/s ', 'Basilan'),
(83, '27', '2023-01-06', 'MALOONG, LAMITAN CITY', 'SPOT', 'JIMROY MCCLINTOCK', '2022-12-17', 'O', 5875, 3564, 0, 3564, 35, 1, '101 Bales & 29 Kg', '0 Bales ', '101.29', 61, 46, 0, NULL, NULL, 163944, 100000, 63944, 'Sixty Three Thousand Nine Hundred Forty Four Peso/s ', 'Basilan'),
(84, '27', '2023-01-09', 'MALOONG SAN JOSE, LAMITAN CITY', 'SPOT', 'EPIGIL MOLEJE', '2022-12-16', 'O', 3285, 1684, 0, 1684, 35, 1, '48 Bales & 4 Kg', '0 Bales ', '48.4', 51, 46, 0, NULL, NULL, 77464, 50000, 27464, 'Twenty Seven Thousand Four Hundred Sixty Four Peso/s ', 'Basilan'),
(85, '27', '2023-01-09', 'PANUNSULAN, ISABELA CITY', 'SPOT', 'LOUIE DELOS REYES', '2022-12-23', 'C', 7030, 4104, 0, 4104, 35, 1, '117 Bales & 9 Kg', '0 Bales ', '117.9', 58, 46, 0, NULL, NULL, 188784, 102460, 86324, 'Eighty Six Thousand Three Hundred Twenty Four Peso/s ', 'Basilan'),
(86, '27', '2023-01-10', 'SAYUGAN, LAMITAN CITY', 'SPOT', 'TANY SULAYMAN', '2022-09-24', '10', 22664, 12286, 0, 12286, 35, 1, '351 Bales & 1 Kg', '0 Bales ', '351.1', 54, 50, 0, NULL, NULL, 614300, 600730, 13570, 'Thirteen Thousand Five Hundred Seventy Peso/s ', 'Basilan'),
(87, '27', '2023-01-16', 'MALOONG SAN JOSE, LAMITAN CITY', 'SPOT', 'EPIGIL MOLEJE', '2022-12-27', 'P', 6781, 3618, 0, 3618, 35, 1, '103 Bales & 13 Kg', '0 Bales ', '103.13', 53, 46, 0, NULL, NULL, 166428, 120000, 46428, 'Forty Six Thousand Four Hundred Twenty Eight Peso/s ', 'Basilan'),
(88, '27', '2023-01-16', 'SAYUGAN, LAMITAN CITY', 'SPOT', 'TANY SULAYMAN', '2022-09-28', '11', 22848, 13148, 0, 13148, 35, 1, '375 Bales & 23 Kg', '0 Bales ', '375.23', 58, 50, 0, NULL, NULL, 657400, 602940, 54460, 'Fifty Four Thousand Four Hundred Sixty Peso/s ', 'Basilan'),
(89, '27', '2023-01-16', 'SAYUGAN, LAMITAN CITY', 'SPOT', 'TANY SULAYMAN', '2022-09-29', '12', 13212, 7001, 0, 7001, 35, 1, '200 Bales & 1 Kg', '0 Bales ', '200.1', 53, 50, 0, NULL, NULL, 350050, 349700, 350, 'Three Hundred Fifty Peso/s ', 'Basilan'),
(91, '27', '2023-01-19', '6KM. ISABELA CITY', 'SPOT', 'RUBEN RAMOS', '2022-12-27', 'P', 2857, 1506, 0, 1506, 35, 1, '43 Bales & 1 Kg', '0 Bales ', '43.1', 53, 44, 0, NULL, NULL, 66264, 30000, 36264, 'Thirty Six Thousand Two Hundred Sixty Four Peso/s ', 'Basilan'),
(92, '92', '2023-01-21', 'MALOONG, LAMITAN CITY', 'SPOT', 'JIMROY MCCLINTOCK', '2022-12-30', 'Q', 7095, 4031, 0, 4031, 35, 1, '115 Bales & 6 Kg', '0 Bales ', '115.6', 57, 44, 0, NULL, NULL, 177364, 100000, 77364, 'Seventy Seven Thousand Three Hundred Sixty Four Peso/s ', NULL),
(93, '92', '2023-01-23', 'PANUNSULAN, ISABELA CITY', 'SPOT', 'LOUIE DELOS REYES', '2023-01-02', 'D', 5080, 2916, 0, 2916, 35, 1, '83 Bales & 11 Kg', '0 Bales ', '83.11', 57, 46, 0, NULL, NULL, 134136, 101778, 32358, 'Thirty Two Thousand Three Hundred Fifty Eight Peso/s ', NULL),
(94, '92', '2023-01-23', 'LAMITAN CITY', 'SPOT', 'TUWA', '2023-01-02', '1', 12955, 7094, 0, 7094, 35, 1, '202 Bales & 24 Kg', '0 Bales ', '202.24', 55, 47, 0, NULL, NULL, 333418, 295031, 38387, 'Thirty Eight Thousand Three Hundred Eighty Seven Peso/s ', NULL),
(95, '92', '2023-01-24', 'MALOONG SAN JOSE, LAMITAN CITY', 'SPOT', 'EPIGIL MOLEJE', '2023-01-04', 'Q', 4040, 2078, 0, 2078, 35, 1, '59 Bales & 13 Kg', '0 Bales ', '59.13', 51, 46, 0, NULL, NULL, 95588, 0, 95588, 'Ninety Five Thousand Five Hundred Eighty Eight Peso/s ', NULL),
(96, '92', '2023-01-24', 'MALOONG SAN JOSE, LAMITAN CITY', 'SPOT', 'EPIGIL MOLEJE', '2023-01-04', 'R', 6596, 3782, 0, 3782, 35, 1, '108 Bales & 2 Kg', '0 Bales ', '108.2', 57, 46, 0, NULL, NULL, 173972, 100000, 73972, 'Seventy Three Thousand Nine Hundred Seventy Two Peso/s ', NULL),
(97, '92', '2023-01-24', 'MALOONG SAN JOSE, LAMITAN CITY', 'SPOT', 'EPIGIL MOLEJE', '2023-01-04', 'R', 6596, 3502, 0, 3502, 35, 1, '100 Bales & 2 Kg', '0 Bales ', '100.2', 53, 46, 0, NULL, NULL, 161092, 0, 161092, 'One Hundred Sixty One Thousand Ninety Two Peso/s ', NULL),
(98, '92', '2023-01-27', 'lamitan', 'SPOT', 'LITO PURI', '2022-12-29', '10', 5880, 3366, 0, 3366, 35, 1, '96 Bales & 6 Kg', '0 Bales ', '96.6', 57, 48, 0, NULL, NULL, 161568, 0, 161568, 'One Hundred Sixty One Thousand Five Hundred Sixty Eight Peso/s ', NULL),
(99, '92', '2023-01-30', 'MALOONG, LAMITAN CITY', 'SPOT', 'RONIE VILDAD', '2022-12-30', 'B', 3148, 1709, 0, 1709, 35, 1, '48 Bales & 29 Kg', '0 Bales ', '48.29', 54, 46, 0, NULL, NULL, 78614, 72404, 6210, 'Six Thousand Two Hundred Ten Peso/s ', NULL),
(100, '92', '2023-01-30', 'MALOONG, LAMITAN CITY', 'SPOT', 'RONIE VILDAD', '2023-01-09', 'C', 3088, 1685, 0, 1685, 35, 1, '48 Bales & 5 Kg', '0 Bales ', '48.5', 55, 46, 0, NULL, NULL, 77510, 71024, 6486, 'Six Thousand Four Hundred Eighty Six Peso/s ', NULL),
(101, '92', '2023-01-31', 'MALOONG, LAMITAN CITY', 'SPOT', 'JIMROY MCCLINTOCK', '2023-01-12', 'R', 5270, 3228, 0, 3228, 35, 1, '92 Bales & 8 Kg', '0 Bales ', '92.8', 61, 45, 0, NULL, NULL, 145260, 100000, 45260, 'Forty Five Thousand Two Hundred Sixty Peso/s ', NULL),
(102, '92', '2023-02-03', 'SAYUGAN, LAMITAN CITY', 'SPOT', 'SAMAN AWALIN', '2022-10-21', '8', 45985, 25037, 0, 25037, 35, 1, '715 Bales & 12 Kg', '0 Bales ', '715.12', 54, 51, 0, NULL, NULL, 1276887, 1219520, 57367, 'Fifty Seven Thousand Three Hundred Sixty Seven Peso/s ', NULL),
(103, '92', '2023-02-07', 'PANUNSULAN, ISABELA CITY', 'SPOT', 'LOUIE DELOS REYES', '2023-01-19', 'E', 14805, 8332, 0, 8332, 35, 1, '238 Bales & 2 Kg', '0 Bales ', '238.2', 56, 46, 0, NULL, NULL, 383272, 235182, 148090, 'One Hundred Forty Eight Thousand Ninety Peso/s ', NULL),
(104, '92', '2023-02-08', 'MALOONG, LAMITAN CITY', 'SPOT', 'JIMROY MCCLINTOCK', '2023-01-24', 'S', 5040, 3017, 0, 3017, 35, 1, '86 Bales & 7 Kg', '0 Bales ', '86.7', 60, 46, 0, NULL, NULL, 138782, 100000, 38782, 'Thirty Eight Thousand Seven Hundred Eighty Two Peso/s ', NULL),
(105, '92', '2023-02-08', 'MALOONG SAN JOSE, LAMITAN CITY', 'SPOT', 'EPIGIL MOLEJE', '2023-01-23', 'S', 5319, 2758, 0, 2758, 35, 1, '78 Bales & 28 Kg', '0 Bales ', '78.28', 52, 46, 0, NULL, NULL, 126868, 50000, 76868, 'Seventy Six Thousand Eight Hundred Sixty Eight Peso/s ', NULL),
(106, '92', '2023-02-08', 'BINUANGAN, ISABELA CITY', 'SPOT', 'JUN  MCCLINTOCK', '2023-01-16', 'J', 6065, 3438, 0, 3438, 35, 1, '98 Bales & 8 Kg', '0 Bales ', '98.8', 57, 46, 0, NULL, NULL, 158148, 150000, 8148, 'Undefined Million One Hundred Fifty Thousand Peso/s ', NULL),
(107, '92', '2023-02-09', 'SAYUGAN, LAMITAN CITY', 'SPOT', 'SAMAN AWALIN', '2022-10-26', '9', 30755, 16736, 0, 16736, 35, 1, '478 Bales & 6 Kg', '0 Bales ', '478.6', 54, 51, 0, NULL, NULL, 853536, 815623, 37913, 'Undefined Million Eight Hundred Fifteen Thousand Six Hundred Twenty Three Peso/s ', NULL),
(108, '92', '2023-02-15', 'MALOONG SAN JOSE, LAMITAN CITY', 'SPOT', 'EPIGIL MOLEJE', '2023-02-01', 'T', 6304, 3497, 0, 3497, 35, 1, '99 Bales & 32 Kg', '0 Bales ', '99.32', 55, 48, 0, NULL, NULL, 167856, 0, 167856, 'One Hundred Sixty Seven Thousand Eight Hundred Fifty Six Peso/s ', NULL),
(109, '92', '2023-02-15', 'MALOONG SAN JOSE, LAMITAN CITY', 'SPOT', 'EPIGIL MOLEJE', '2023-02-01', 'T', 6304, 3392, 0, 3392, 35, 1, '96 Bales & 32 Kg', '0 Bales ', '96.32', 54, 48, 0, NULL, NULL, 162816, 0, 162816, 'One Hundred Sixty Two Thousand Eight Hundred Sixteen Peso/s ', NULL),
(110, '92', '2023-02-15', 'MALOONG, LAMITAN CITY', 'SPOT', 'JIMROY MCCLINTOCK', '2023-01-30', 'T', 4950, 2864, 0, 2864, 35, 1, '81 Bales & 29 Kg', '0 Bales ', '81.29', 58, 46, 0, NULL, NULL, 131744, 100000, 31744, 'Thirty One Thousand Seven Hundred Forty Four Peso/s ', NULL),
(111, '92', '2023-02-16', 'PANUNSULAN, ISABELA CITY', 'SPOT', 'LOUIE DELOS REYES', '2023-02-25', 'F', 6500, 3771, 0, 3771, 35, 1, '107 Bales & 26 Kg', '0 Bales ', '107.26', 58, 47, 0, NULL, NULL, 177237, 102275, 74962, 'Seventy Four Thousand Nine Hundred Sixty Two Peso/s ', NULL),
(112, '92', '2023-02-22', 'MALOONG, LAMITAN CITY', 'SPOT', 'JIMROY MCCLINTOCK', '2023-02-04', 'U', 5650, 2964, 0, 2964, 35, 1, '84 Bales & 24 Kg', '0 Bales ', '84.24', 52, 46, 0, NULL, NULL, 136344, 100000, 36344, 'Thirty Six Thousand Three Hundred Forty Four Peso/s ', NULL),
(113, '92', '2023-02-24', 'ISABELA CITY', 'SPOT', 'JAMES TAN', '2023-02-01', '1', 15350, 9044, 0, 9044, 35, 1, '258 Bales & 14 Kg', '0 Bales ', '258.14', 59, 50, 0, NULL, NULL, 452200, 300000, 152200, 'One Hundred Fifty Two Thousand Two Hundred Peso/s ', NULL),
(114, '92', '2023-02-27', 'lamitan', 'SPOT', 'LITO PURI', '2023-01-30', '11', 5470, 2941, 0, 2941, 35, 1, '84 Bales & 1 Kg', '0 Bales ', '84.1', 54, 51, 0, NULL, NULL, 149991, 0, 149991, 'One Hundred Forty Nine Thousand Nine Hundred Ninety One Peso/s ', NULL),
(115, '92', '2023-03-02', 'MALOONG, LAMITAN CITY', 'SPOT', 'JIMROY MCCLINTOCK', '2023-02-16', 'V', 8070, 4954, 0, 4954, 35, 1, '141 Bales & 19 Kg', '0 Bales ', '141.19', 61, 50, 0, NULL, NULL, 247700, 150000, 97700, 'Ninety Seven Thousand Seven Hundred Peso/s ', NULL),
(116, '92', '2023-03-04', 'MALOONG SAN JOSE, LAMITAN CITY', 'SPOT', 'EPIGIL MOLEJE', '2023-02-16', 'U', 5588, 2966, 0, 2966, 35, 1, '84 Bales & 26 Kg', '0 Bales ', '84.26', 53, 50, 0, NULL, NULL, 148300, 0, 148300, 'Peso/s ', NULL),
(117, '92', '2023-03-04', '6KM. ISABELA CITY', 'SPOT', 'RUBEN RAMOS', '2023-02-12', 'T', 1797, 1070, 0, 1070, 35, 1, '30 Bales & 20 Kg', '0 Bales ', '30.2', 60, 50, 0, NULL, NULL, 53500, 30000, 23500, 'Twenty Three Thousand Five Hundred Peso/s ', NULL),
(118, '92', '2023-03-13', 'MALOONG, LAMITAN CITY', 'SPOT', 'JIMROY MCCLINTOCK', '2023-02-27', 'w', 3320, 1948, 0, 1948, 35, 1, '55 Bales & 23 Kg', '0 Bales ', '55.23', 59, 50, 0, NULL, NULL, 97400, 50000, 47400, 'Forty Seven Thousand Four Hundred Peso/s ', NULL),
(119, '92', '2023-03-13', 'TABIAWAN, ISABELA CITY', 'SPOT', 'NENETH COSTAN', '2023-02-10', 'E', 7035, 3775, 0, 3775, 35, 1, '107 Bales & 30 Kg', '0 Bales ', '107.3', 54, 49, 0, NULL, NULL, 184975, 0, 184975, 'One Hundred Eighty Four Thousand Nine Hundred Seventy Five Peso/s ', NULL),
(120, '92', '2023-03-17', 'TABIAWAN, ISABELA CITY', 'SPOT', 'NENETH COSTAN', '2023-02-28', 'F', 20490, 12686, 0, 12686, 35, 1, '362 Bales & 16 Kg', '0 Bales ', '362.16', 62, 52, 0, NULL, NULL, 659672, 500000, 159672, 'One Hundred Fifty Nine Thousand Six Hundred Seventy Two Peso/s ', NULL),
(121, '92', '2023-03-17', 'LAMITAN CITY', 'SPOT', 'LONG2X SAN JUAN', '2023-02-27', '01', 13680, 8125, 0, 8125, 35, 1, '232 Bales & 5 Kg', '0 Bales ', '232.5', 59, 52, 0, NULL, NULL, 422500, 400551, 21949, 'Twenty One Thousand Nine Hundred Forty Nine Peso/s ', NULL),
(122, '92', '2023-03-20', 'LAMITAN CITY', 'SPOT', 'LONG2X SAN JUAN', '2023-02-28', '2', 8350, 4917, 0, 4917, 35, 1, '140 Bales & 17 Kg', '0 Bales ', '140.17', 59, 52, 0, NULL, NULL, 255684, 251240, 4444, 'Four Thousand Four Hundred Forty Four Peso/s ', NULL),
(123, '92', '2023-03-20', 'MALOONG SAN JOSE, LAMITAN CITY', 'SPOT', 'EPIGIL MOLEJE', '2023-03-06', 'T', 5570, 3053, 0, 3053, 35, 1, '87 Bales & 8 Kg', '0 Bales ', '87.8', 55, 50, 0, NULL, NULL, 152650, 0, 152650, 'One Hundred Fifty Two Thousand Six Hundred Fifty Peso/s ', NULL),
(124, '92', '2023-03-21', 'TABIAWAN, ISABELA CITY', 'SPOT', 'NENETH COSTAN', '2023-02-28', 'G', 10715, 6113, 0, 6113, 35, 1, '174 Bales & 23 Kg', '0 Bales ', '174.23', 57, 52, 0, NULL, NULL, 317876, 278590, 39286, 'Thirty Nine Thousand Two Hundred Eighty Six Peso/s ', NULL),
(125, '92', '2023-03-23', 'MALOONG, LAMITAN CITY', 'SPOT', 'RONIE VILDAD', '2023-02-06', '', 5942, 3057, 0, 3057, 35, 1, '87 Bales & 12 Kg', '0 Bales ', '87.12', 51, 49, 0, NULL, NULL, 149793, 145579, 4214, 'Four Thousand Two Hundred Fourteen Peso/s ', NULL),
(126, '92', '2023-03-27', 'BULINGAN, LAMITAN CITY', 'SPOT', 'TATA HALAL', '2023-03-07', '1', 13475, 8823, 0, 8823, 35, 1, '252 Bales & 3 Kg', '0 Bales ', '252.3', 65, 50, 0, NULL, NULL, 441150, 63369, 377781, 'Undefined Hundred Sixty Three Thousand Three Hundred Sixty Nine Peso/s ', NULL),
(127, '92', '2023-03-28', '6KM. ISABELA CITY', 'SPOT', 'RUBEN RAMOS', '2023-03-01', 'U', 3796, 1996, 0, 1996, 35, 1, '57 Bales & 1 Kg', '0 Bales ', '57.1', 53, 51, 0, NULL, NULL, 101796, 0, 101796, 'One Hundred One Thousand Seven Hundred Ninety Six Peso/s ', NULL),
(128, '92', '2023-03-29', 'lamitan', 'SPOT', 'LITO PURI', '2023-02-28', '12', 5530, 3193, 0, 3193, 35, 1, '91 Bales & 7 Kg', '0 Bales ', '91.7', 58, 51, 0, NULL, NULL, 162818, 0, 162818, 'One Hundred Sixty Two Thousand Eight Hundred Seventeen Peso/s And Five Centavo/s ', NULL),
(129, '92', '2023-03-29', 'MALOONG, LAMITAN CITY', 'SPOT', 'JIMROY MCCLINTOCK', '0000-00-00', 'X', 5305, 2824, 0, 2824, 35, 1, '80 Bales & 24 Kg', '0 Bales ', '80.24', 53, 50, 0, NULL, NULL, 141200, 100000, 41200, 'Forty One Thousand Two Hundred Peso/s ', NULL),
(130, '92', '2023-04-11', 'MALOONG SAN JOSE, LAMITAN CITY', 'SPOT', 'EPIGIL MOLEJE', '2023-03-25', 'W', 6725, 3454, 0, 3454, 35, 1, '98 Bales & 24 Kg', '0 Bales ', '98.24', 51, 50, 0, NULL, NULL, 172700, 0, 172700, 'One Hundred Seventy Two Thousand Seven Hundred Peso/s ', NULL),
(131, '92', '2023-04-13', 'ULAMI, LAMITAN CITY', 'SPOT', 'JERRY ARIERO', '2023-03-30', '1', 4336, 2874, 0, 2874, 35, 1, '82 Bales & 4 Kg', '0 Bales ', '82.4', 66, 50, 0, NULL, NULL, 143700, 70000, 73700, 'Seventy Three Thousand Seven Hundred Peso/s ', NULL),
(132, '92', '2023-04-14', 'MALOONG, LAMITAN CITY', 'SPOT', 'JIMROY MCCLINTOCK', '2023-03-28', 'Y', 4330, 2626, 0, 2626, 35, 1, '75 Bales & 1 Kg', '0 Bales ', '75.1', 61, 50, 0, NULL, NULL, 131300, 100000, 31300, 'Thirty One Thousand Three Hundred Peso/s ', NULL),
(133, '92', '2023-04-17', 'CALVARIO, LAMITAN CITY', 'SPOT', 'JARWIN GARCIA', '2023-03-30', '1', 4840, 2811, 0, 2811, 35, 1, '80 Bales & 11 Kg', '0 Bales ', '80.11', 58, 50, 0, NULL, NULL, 140550, 121000, 19550, 'Nineteen Thousand Five Hundred Fifty Peso/s ', NULL),
(134, '92', '2023-04-18', 'CALVARIO, LAMITAN CITY', 'SPOT', 'JARWIN GARCIA', '2023-04-01', '2', 11390, 6844, 0, 6844, 35, 1, '195 Bales & 19 Kg', '0 Bales ', '195.19', 60, 50, 0, NULL, NULL, 342200, 284750, 57450, 'Fifty Seven Thousand Four Hundred Fifty Peso/s ', NULL),
(135, '92', '2023-04-18', 'MALOONG SAN JOSE, LAMITAN CITY', 'SPOT', 'EPIGIL MOLEJE', '2023-04-03', 'X', 2125, 1197, 0, 1197, 35, 1, '34 Bales & 7 Kg', '0 Bales ', '34.7', 56, 51, 0, NULL, NULL, 61047, 0, 61047, 'Sixty One Thousand Forty Seven Peso/s ', NULL),
(136, '92', '2023-04-20', 'lamitan', 'SPOT', 'LITO PURI', '2023-03-31', '13', 5585, 3265, 0, 3265, 35, 1, '93 Bales & 10 Kg', '0 Bales ', '93.1', 58, 52, 0, NULL, NULL, 169780, 0, 169780, 'One Hundred Sixty Nine Thousand Seven Hundred Eighty Peso/s ', NULL),
(137, '92', '2023-04-21', 'BULINGAN, LAMITAN CITY', 'SPOT', 'TATA HALAL', '2023-04-04', '2', 5255, 3086, 0, 3086, 35, 1, '88 Bales & 6 Kg', '0 Bales ', '88.6', 59, 51, 0, NULL, NULL, 157386, 20000, 137386, 'One Hundred Thirty Seven Thousand Three Hundred Eighty Six Peso/s ', NULL),
(138, '92', '2023-04-22', 'MALOONG, LAMITAN CITY', 'SPOT', 'JIMROY MCCLINTOCK', '2023-04-10', 'Z', 5520, 3409, 0, 3409, 35, 1, '97 Bales & 14 Kg', '0 Bales ', '97.14', 62, 51, 0, NULL, NULL, 173859, 110000, 63859, 'Sixty Three Thousand Eight Hundred Fifty Nine Peso/s ', NULL),
(139, '92', '2023-04-28', 'CALVARIO, LAMITAN CITY', 'SPOT', 'JARWIN GARCIA', '2023-04-10', '3', 5230, 2978, 0, 2978, 35, 1, '85 Bales & 3 Kg', '0 Bales ', '85.3', 57, 50, 0, NULL, NULL, 148900, 130750, 18150, 'One Hundred Forty Eight Thousand Nine Hundred Peso/s ', NULL),
(140, '92', '2023-04-28', 'CALVARIO, LAMITAN CITY', 'SPOT', 'JARWIN GARCIA', '2023-04-15', '4', 4575, 2723, 0, 2723, 35, 1, '77 Bales & 28 Kg', '0 Bales ', '77.28', 60, 50, 0, NULL, NULL, 136150, 114375, 21775, 'Twenty One Thousand Seven Hundred Seventy Five Peso/s ', NULL),
(141, '92', '2023-04-28', 'MALOONG SAN JOSE, LAMITAN CITY', 'SPOT', 'EPIGIL MOLEJE', '2023-04-17', 'Y', 3425, 1860, 0, 1860, 35, 1, '53 Bales & 5 Kg', '0 Bales ', '53.5', 54, 50, 0, NULL, NULL, 93000, 0, 93000, 'Ninety Three Thousand Peso/s ', NULL),
(142, '92', '2023-05-03', 'CALVARIO, LAMITAN CITY', 'SPOT', 'JARWIN GARCIA', '2023-04-17', '5', 7030, 4005, 0, 4005, 35, 1, '114 Bales & 15 Kg', '0 Bales ', '114.15', 57, 50, 0, NULL, NULL, 200250, 175750, 24500, 'Twenty Four Thousand Five Hundred Peso/s ', NULL),
(143, '92', '2023-05-03', 'ISABELA CITY', 'SPOT', 'DANNY BARANDINO', '2023-04-18', '1', 2725, 1699, 0, 1699, 35, 1, '48 Bales & 19 Kg', '0 Bales ', '48.19', 62, 50, 0, NULL, NULL, 84950, 70926, 14024, 'Fourteen Thousand Twenty Four Peso/s ', NULL),
(144, '92', '2023-05-08', 'ULAMI, LAMITAN CITY', 'SPOT', 'JERRY ARIERO', '2023-04-25', '2', 3557, 2417, 0, 2417, 35, 1, '69 Bales & 2 Kg', '0 Bales ', '69.2', 68, 50, 0, NULL, NULL, 120838, 80000, 40838, 'Undefined Hundred Eighty Thousand Peso/s ', NULL),
(145, '92', '2023-05-09', 'MALOONG, LAMITAN CITY', 'SPOT', 'JIMROY MCCLINTOCK', '2023-04-24', 'A', 3250, 2016, 0, 2016, 35, 1, '57 Bales & 21 Kg', '0 Bales ', '57.21', 62, 51, 0, NULL, NULL, 102806, 100000, 2806, 'Two Thousand Eight Hundred Five Peso/s And Eight Centavo/s ', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category_expenses`
--

CREATE TABLE `category_expenses` (
  `id` int(11) NOT NULL,
  `category` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category_expenses`
--

INSERT INTO `category_expenses` (`id`, `category`) VALUES
(68, 'EJN SALARIES'),
(69, 'Philhealth'),
(70, 'SSS'),
(71, 'Food and Snack'),
(72, 'Electricity'),
(73, 'Water'),
(74, 'Freight'),
(75, 'Taxes and Licenses'),
(76, 'RBN Expense'),
(77, 'Pakyawan Salaries'),
(78, 'EJN Supply Expenses'),
(79, 'Pag-ibig'),
(80, 'Other Expense');

-- --------------------------------------------------------

--
-- Table structure for table `contract_purchase`
--

CREATE TABLE `contract_purchase` (
  `id` int(11) NOT NULL,
  `contract_no` varchar(11) NOT NULL,
  `seller` varchar(50) NOT NULL,
  `contract_quantity` float NOT NULL,
  `delivered` float DEFAULT NULL,
  `balance` float DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `date` varchar(10) DEFAULT NULL,
  `price_kg` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `copra_cashadvance`
--

CREATE TABLE `copra_cashadvance` (
  `id` int(11) NOT NULL,
  `seller` varchar(50) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `category` varchar(10) NOT NULL,
  `date` varchar(11) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ledger_buahantoppers`
--

CREATE TABLE `ledger_buahantoppers` (
  `id` int(11) NOT NULL,
  `date` varchar(10) NOT NULL,
  `voucher` varchar(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `net_kilos` varchar(100) NOT NULL,
  `price` varchar(100) NOT NULL,
  `total` varchar(100) NOT NULL,
  `ejn_percent` varchar(50) NOT NULL,
  `ejn_total` varchar(50) NOT NULL,
  `toppers_percent` varchar(50) NOT NULL,
  `gross_amount` varchar(50) NOT NULL,
  `less_category` varchar(50) NOT NULL,
  `less_toppers` varchar(50) NOT NULL,
  `toppers_total` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ledger_buahantoppers`
--

INSERT INTO `ledger_buahantoppers` (`id`, `date`, `voucher`, `name`, `net_kilos`, `price`, `total`, `ejn_percent`, `ejn_total`, `toppers_percent`, `gross_amount`, `less_category`, `less_toppers`, `toppers_total`) VALUES
(2, '2023-01-16', '35328', 'HENRY ARBUENA TENANT', '1779', '20', '35580', '', '0', '20', '7116', '', '', '7116'),
(3, '2023-01-16', '2941', 'moyong', '218', '20', '4360', '20', '872', '40', '1744', 'Cash Advance', '500', '1244'),
(4, '2023-01-16', '2944', 'sanogal', '438', '20', '8760', '20', '1752', '40', '3504', 'Cash Advance', '1000', '2504'),
(5, '2023-01-16', '2940', 'pepito', '320', '20', '6400', '20', '1280', '40', '2560', 'Cash Advance', '500', '2060'),
(6, '2023-01-16', '2942', 'nonoy', '482', '20', '9640', '20', '1928', '40', '3856', 'Cash Advance', '1000', '2856'),
(7, '2023-01-16', '2943', 'sandijas', '321', '20', '6420', '20', '1284', '40', '2568', 'Cash Advance', '1000', '1568'),
(8, '2023-01-21', '35149', 'jbn share', '1779', '20', '35580', '40', '14232', '', '0', '', '', '0'),
(9, '2023-02-22', '40861', 'henry tenant share', '1843', '20', '36860', '', '0', '20', '7372', '', '', '7372'),
(10, '2023-02-22', '40862', 'JBN share wet rubber ', '1843', '20', '36860', '40', '14744', '', '0', '', '', '0'),
(11, '2023-02-15', '2866', 'pepito', '414', '20', '8280', '', '0', '40', '3312', 'Cash Advance', '500', '2812'),
(12, '2023-02-22', '2863', 'sandijas', '274', '20', '5480', '', '0', '40', '2192', 'Cash Advance', '1000', '1192'),
(13, '2023-02-22', '2864', 'sanogal', '374', '20', '7480', '', '0', '40', '2992', 'Cash Advance', '1000', '1992'),
(14, '2023-02-22', '2862', 'nonoy', '438', '20', '8760', '', '0', '40', '3504', 'Cash Advance', '1000', '2504'),
(15, '2023-02-22', '2865', 'moyong', '343', '20', '6860', '', '0', '40', '2744', 'Cash Advance', '500', '2244'),
(16, '2023-03-30', '2880', 'sandias', '203', '20', '4060', '', '0', '40', '1624', '', '1970', '-346'),
(17, '2023-03-30', '2878', 'nonoy', '363', '20', '7260', '', '0', '40', '2904', '', '1970', '934'),
(18, '2023-03-30', '2879', 'sanogal', '311', '20', '6220', '', '0', '40', '2488', '', '1970', '518'),
(19, '2023-03-30', '2876', 'moyong', '274', '20', '5480', '', '0', '40', '2192', '', '1470', '722'),
(20, '2023-03-30', '2877', 'pepito', '295', '20', '5900', '', '0', '40', '2360', '', '500', '1860'),
(21, '2023-03-30', '40569', 'henry abuena', '1446', '20', '28920', '', '0', '20', '5784', '', '', '5784'),
(22, '2023-05-02', '2896', 'sandias', '263', '20', '5260', '60', '3156', '40', '2104', 'Cash Advance', '1970', '134'),
(23, '2023-05-02', '2898', 'nonoy', '351', '20', '7020', '', '0', '40', '2808', '', '1970', '838'),
(24, '2023-05-02', '2900', 'pepito', '311', '20', '6220', '', '0', '40', '2488', 'Cash Advance', '500', '1988'),
(25, '2023-05-02', '2899', 'moyong ', '248', '20', '4960', '', '0', '40', '1984', 'Cash Advance', '1470', '514'),
(26, '2023-05-02', '2897', 'sanogal', '374', '20', '7480', '', '0', '40', '2992', 'Cash Advance', '1970', '1022'),
(27, '2023-05-02', '40449', 'henry abuena', '1547', '20', '30940', '', '0', '20', '6188', '', '', '6188');

-- --------------------------------------------------------

--
-- Table structure for table `ledger_buying_station`
--

CREATE TABLE `ledger_buying_station` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ledger_buying_station`
--

INSERT INTO `ledger_buying_station` (`id`, `name`) VALUES
(1, 'Sayugan Buying Station'),
(2, 'Nenet Buying Station'),
(3, 'June Buying Station'),
(4, 'Kidapawan Buying Station');

-- --------------------------------------------------------

--
-- Table structure for table `ledger_cashadvance`
--

CREATE TABLE `ledger_cashadvance` (
  `id` int(11) NOT NULL,
  `date` varchar(50) NOT NULL,
  `voucher` varchar(50) NOT NULL,
  `customer` varchar(50) NOT NULL,
  `buying_station` varchar(50) NOT NULL,
  `category` varchar(50) NOT NULL,
  `amount` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ledger_cashadvance`
--

INSERT INTO `ledger_cashadvance` (`id`, `date`, `voucher`, `customer`, `buying_station`, `category`, `amount`) VALUES
(6, '2023-01-03', '91556', 'RASHID AMILIMN', '', 'Customer', '300000'),
(7, '2023-01-03', '39589', 'ANTHONY CASTIL/ TOTO CASTIL', '', 'Employee', '10000'),
(8, '2023-01-03', '91554', 'ELENA CONSTAN', 'Nenet Buying Station', 'Customer', '200000'),
(9, '2023-01-03', '91555', 'ANDREW PAMARAN', '', 'Customer', '10000'),
(10, '2023-01-06', '35254', 'DAILE PELIGRIN', 'EMPLOYEE', 'CASH ADVANCE', '10000'),
(11, '2023-01-06', '91568', 'SULAYMAN TANI', 'CUSTOMER', 'CASH ADVANCE for wet export', '200000'),
(12, '2023-01-06', '27122', 'virginia morados', 'CUSTOMER', 'cash advance for copra', '5000'),
(13, '2023-01-06', '27122', 'viriginia morados', 'CUSTOMER', 'CASH ADVANCE FOR COPRA', '5000'),
(14, '2023-01-06', '91568', 'TANY SULAYMAN', 'CUSTOMER', 'CASH ADVANCE FOR WET EXPORT', '200000'),
(15, '2023-01-06', '35254', 'DAILE PELIGRIN', 'EMPLOYEE', 'CASH ADVANCE', '10000'),
(16, '2023-01-07', '91574', 'TANY SULAYMAN', 'CUSTOMER', 'CASH ADVANCE FOR EXPORT', '200000'),
(17, '2023-01-07', '91571', 'LOUIE DELOS REYES', 'CUSTOMER', 'CASH ADVANCE FOR DRY PRICE', '100000'),
(18, '2023-01-07', '91572', 'RUBEN RAMOS', 'CUSTOMER', 'CASH ADVANCE FOR WET', '30000'),
(19, '2023-01-07', '35260', 'BERTO ENRIQUEZ', 'EMPLOYEE', 'CASH ADVANCE FOR SALARY', '3000'),
(20, '2023-01-07', '39593', 'MALOONG STONE BREAKER', 'MALOONG EXPENSES', 'cash advance for gravel 2x2 for 2nd lane', '6000'),
(21, '2023-01-09', '91578', 'tany sulayman', 'CUSTOMER', 'CASH ADVANCE FOR WET EXPORT', '200000'),
(22, '2023-01-10', '91583', 'tany sulayman', 'CUSTOMER', 'CASH FOR WET EXPORT', '150000'),
(23, '2023-01-12', '91588', 'CHARLEY CAWLEY', 'CUSTOMER', 'CASH ADVANCE AGAINST MILLING', '130000'),
(24, '2023-01-12', '91590', 'JIMROY mCcLINTOCK', 'CUSTOMER', 'CASH ADVANCE FOR DRY PRICE', '100000'),
(25, '2023-01-13', '91591', 'SAMAN AWALIN', 'CUSTOMER', 'CASH ADVANCE FOR WET EXPORT DRC', '200000'),
(26, '2023-01-13', '35286', 'NOEL GUANZON', 'EMLOYEE', 'CASH ADVANCE AGAINST SALARY', '10000'),
(27, '2023-01-13', '35282', 'SIMEON MANAGUIT', 'EMPLOYEE', 'CASH ADVANCE AGAINST SALARY ', '9000'),
(28, '2023-01-14', '91595', 'NENET COSNTAN', 'CUSTOMER', 'CASH ADVANC FOR WET EXPORT', '200000'),
(29, '2023-01-14', '91594', 'mudzkier aldurahman', 'customer', 'cash advance fie export dry', '100000'),
(30, '2023-01-14', '91594', 'mudzkier aldurahman', 'customer', 'cash advance fie export dry', '100000'),
(31, '2023-01-14', '91594', 'mudzkier aldurahman', 'customer', 'cash advance fie export dry', '100000'),
(32, '2023-01-14', '35137', 'lalang langutan', 'Employee', 'Cash advance against salary', '1000'),
(33, '2023-01-14', '35137', 'lalang langutan', 'Employee', 'Cash advance against salary', '1000'),
(34, '2023-01-14', '35303', 'eric manuel', 'employee', 'cash advance against salary', '6500'),
(35, '2023-01-14', '35303', 'eric manuel', 'EMPLOYEE', 'cash advance against salary', '6500'),
(36, '2023-01-14', '35293', 'RAQUEL BAIS', 'EMPLOYEE', 'CASH ADVANCE AGAINST SALARY', '9000'),
(37, '2023-01-14', '35294', 'BERTO ENRIQUEZ', 'EMPLOYEE', 'CASH ADVANCE AGAINST SALARY', '10000'),
(38, '2023-01-14', '35296', 'MAE ANGELES', 'EMPLOYEE', 'CASH ADVANCE AGAINST SALARY', '9000'),
(39, '2023-01-14', '35297', 'RODJANE QUINOL', 'EMPLOYEE', 'CASH ADVANCE AGAINST SALARY', '5000'),
(40, '2023-01-14', '91593', 'TANNY SULAYMAN', 'CUSTOMER', 'CASHA DVANCE AGAINST WET EXPORT', '100000'),
(41, '2023-01-14', '35301', 'ROGELIO ADAYA JR', 'EMPLOYEE', 'CASH ADVANCE AGAINTS SALARY', '3000'),
(42, '2023-01-14', '35298', 'JOSEPH BENOSA', 'EMPLOYEE', 'CASH ADVANCE AGAINST SALARY', '3200'),
(43, '2023-01-14', '35292', 'DAYANARA REMIGIO', 'EMPLOYEE', 'CASH ADVANCE AGAINST SALARY', '4500'),
(44, '2023-01-14', '35295', 'DALE PELEGRIN', 'EMPLOYEE', 'CASH ADVANCE AGAINST SALARY', '10000'),
(45, '2023-01-14', '35135', 'JERRY BAPURA', 'EMPLOYEE', 'CASH ADVANCE AGAINST SALARY', '4200'),
(46, '2023-01-14', '35290', 'ALIH SUBBA', 'COFFEE BEANS SUPPLIER', 'CASH ADVANCE AGAINST COFFEE BEANS COLLECTION', '10000'),
(47, '2023-01-14', '35308', 'AMMAN AWALIN', 'CUSTOMER', 'CASH ADVANCE FOR WET EXPORT', '200000'),
(48, '2023-01-14', '35300', 'IRENEO TORRES', 'EMPLOYEE', 'CASH ADVANCE AGAINST SALARY', '5000'),
(49, '2023-01-14', '35178', 'CORPUZ DENNIS', 'EMPLOYEE', 'CASH ADVANCE AGAINST SALARY', '3000'),
(50, '2023-01-14', '35179', 'CORNELIA, ALBERT', 'EMPLOYEE', 'CASH ADVANCE AGAINST SALARY', '3000'),
(51, '2023-01-14', '35180', 'RAMIL PELEGRIN', 'EMPLOYEE', 'CASH ADVANCE AGAINST SALARY', '3000'),
(52, '2023-01-14', '35181', 'SUALOG, CERILO', 'EMPLOYEE', 'CASH ADVANCE AGAINST SALARY', '3000'),
(53, '2023-01-14', '35187', 'RAP2X ABARQUEZ', 'EMPLOYEE', 'CASH ADVANCE AGAINST SALARY', '3000'),
(54, '2023-01-14', '35188', 'ASILAN EDWIN', 'EMPLOYEE', 'CASH ADVANCE AGAINST SALARY', '4000'),
(55, '2023-01-14', '35189', 'CRISTOBAL EDMUNDO', 'EMPLOYEE', 'CASH ADVANCE AGAINST SALARY', '3000'),
(56, '2023-01-14', '35190', 'RAMILANO SAMUEL', 'EMPLOYEE', 'CASH ADVANCE AGAINST SALARY', '1000'),
(57, '2023-01-14', '35174', 'LUANG EDRITO', 'EMPLOYEE', 'CASH ADVANCE AGAINST SALARY', '3000'),
(58, '2023-01-14', '35175', 'HIPULAN PABLO', 'EMPLOYEE', 'CASH ADVANCE AGAINST SALARY', '7000'),
(59, '2023-01-14', '35176', 'PENTOJO DINDO', 'EMPLOYEE', 'CASH ADVANCE AGAINST SALARY', '4000'),
(60, '2023-01-14', '35177', 'BONIFACIO ALVIN', 'EMPLOYEE', 'CASH ADVANCE AGAINST SALARY', '3000'),
(61, '2023-01-14', '35171', 'MELVIN FERRER', 'EMPLOYEE', 'CASH ADVANCE AGAINST SALARY', '4000'),
(62, '2023-01-14', '35172', 'SAMIJON JOVY', 'EMPLOYEE', 'CASH ADVANCE AGAINST SALARY', '8000'),
(63, '2023-01-14', '35173', 'GARCIA JERRY', 'EMPLOYEE', 'CASH ADVANCE AGAINST SALARY', '3000'),
(64, '2023-01-14', '35173', 'GARCIA JERRY', 'EMPLOYEE', 'CASH ADVANCE AGAINST SALARY', '3000'),
(65, '2023-01-14', '35167', 'RONIE VILDAD', 'EMPLOYEE', 'CASH ADVANCE AGAINST SALARY', '5000'),
(66, '2023-01-14', '35167', 'RONIE VILDAD', 'EMPLOYEE', 'CASH ADVANCE AGAINST SALARY', '5000'),
(67, '2023-01-14', '35168', 'GALANO BERTO', 'EMPLOYEE', 'CASH ADVANCE AGAINST SALARY', '7000'),
(68, '2023-01-14', '35169', 'ABELLA JEANNE', 'EMPLOYEE', 'CASH ADVANCE AGAINST SALARY', '6000'),
(69, '2023-01-14', '35170', 'MATULAC GREGORIO', 'EMPLOYEE', 'CASH ADVANCE AGAINST SALARY', '4000'),
(70, '2023-01-16', '35200', 'OSCAR', 'MALOONG TOPPERS', 'CASH ADVANCE FOR WET ', '1000'),
(71, '2023-01-16', '35324', 'MARCELO BONG FUMIGATOR', 'FUMIGATOR FOR PALLET EXPORT VITRY', 'CASH ADVANCE', '10000'),
(72, '2023-01-16', '35198', 'GUILBERT ', 'MALOONG TOPPERS', 'CASH ADVANCE FOR WET', '1000'),
(73, '2023-01-16', '35323', 'MERCY PALCONIT', 'EMPLOYEE-HELPER', 'CASH ADVANCE AGAINST SALARY', '1000'),
(74, '2023-01-16', '35199', 'MANOLIT MROALES', 'MALOONG TOPPERS', 'CASH ADVANCE', '2000'),
(75, '2023-01-16', '35197', 'RENATO', 'MALOONG TOPPERS', 'CASH ADVANCE', '2500'),
(76, '2023-01-16', '35327', 'BUAHAN TOPPERS 5PERSON PEPITO/MOYONG/SANOGAL/SANDI', 'BUAHAN TOPPERS', 'CASH ADVANCE FOR WET', '4000'),
(77, '2023-01-17', '35333', 'JOEVENIL CANONES', 'CUSTOMER/BALUGAY SHOP', 'CASH ADVANCE FOR BUSHING AND HOUSING REPAIR', '20000'),
(78, '2023-01-18', '35336', 'eric manuel', 'employee', 'cash advance against salary', '1500'),
(79, '2023-01-18', '91613', 'mudzykier abdurahman', 'customer', 'cash advance against wet deliver for export', '100000'),
(80, '2023-01-18', '91599', 'JIMROY MCCLINTOCK', 'CUSTOMER', 'CASH ADVANCE AGAINST FOR DRY PRICE', '50000'),
(81, '2023-01-19', '91624', 'tany sulayman', 'customer', 'cash advance against wet rubber export', '50000'),
(82, '2023-01-19', '91620', 'ANDREW PAMARAN', 'CUSTOMER', 'CASH ADVANCE FRO WET RUBBER', '10000'),
(83, '2023-01-19', '35339', 'BRYAN ALBUTRA', 'EMPLOYEE', 'CASH ADVANCE AGAINST SALARY', '3000'),
(84, '2023-01-20', '35346', 'NOEL GUANZON', 'EMPLOYEE', 'CASH ADVANCE AGAINST SALARY', '20000'),
(85, '2023-01-20', '91627', 'AMMAN AWALIN', 'CUSTOMER', 'CASH ADVANCE AGAINST WET EXPORT', '200000'),
(86, '2023-01-20', '91626', 'TANY SULAYMAN', 'CUSTOMER', 'CASH ADVANCE AGAINST WET EXPORT', '50000'),
(87, '2023-01-21', '35367', 'dennis corpuz', 'employee', 'cash advance against salary', '4000'),
(88, '2023-01-21', '35366', 'ALBERT CORNELIA', 'EMPLOYEE', 'CASH ADVANCE AGAINST SALARY', '8000'),
(89, '2023-01-21', '91631', 'tany sulayman', 'customer', 'cash advance against wet export', '100000'),
(90, '2023-01-21', '91634', 'AMMAN AWALIN', 'CUSTOMER', 'CASH ADVANCE FOR EXPORT', '150000'),
(91, '2023-01-21', '91630', 'NENET CONSTAN', 'CUSTOMER', 'CASH ADVANCE FOR WET EXPORT', '130000'),
(92, '2023-01-21', '91631', 'TANY SULAYMAN', 'CUSTOMER', 'CASH ADVANCE FOR WET RUBBER', '100000'),
(93, '2023-01-21', '35366', 'ALBERT CORNELIA', 'EMPLOYEE', 'CASH ADVANCE AGAINST SALARY', '8000'),
(94, '2023-01-21', '35367', 'DENNIS CORPUZ', 'EMPLOYEE', 'CASH ADVANCE AGAINST SALARY', '4000'),
(95, '2023-01-21', '35601', 'TANY SULAYMAN', 'CUSTOMER', 'CASH ADVANCE AGAINST WET RUBBER', '100000'),
(96, '2023-01-21', '91634', 'AMMAN AWALIN', 'CUSTOMER', 'CASH ADVANCE FOR EXPORT', '150000'),
(97, '2023-01-21', '35401', 'maloong workers contractual', 'EMPLOYEE', 'CASH ADVANCE AGAINST SALARY', '117000'),
(98, '2023-01-23', '35651', 'roger group miller', 'MALOONG CONTRACTUAL', 'CASH ADVANCE AGAINST RUBBER ', '9000'),
(99, '2023-01-23', '35652', 'TOPENG/MANUEL GROUP CRUMBLING', 'MALOONG CONTRACTUAL', 'CASH ADVANCE FOR RUBBER', '13500'),
(100, '2023-01-23', '35653', 'USMAN SABATAL FURNACE', 'MALOONG CONTRACTUAL', 'CASH ADVANCE FOR RUBBER', '1500'),
(101, '2023-01-23', '35608', 'ERNESTO NALAM', 'EMPLOYEE', 'CASH ADVANCE AGAINST SALARY', '2000'),
(102, '2023-01-23', '35609', 'JIMSON SAMSONA', 'EMPLOYEE', 'CASH ADVANCE AGAISNT SALARY', '1000'),
(103, '2023-01-23', '91641', 'ADAM ASALUL', 'CUSTOMER', 'CASH ADVANCE AGAINST COPRA', '50000'),
(104, '2023-01-24', '91645', 'JIMROY McClintock', 'CUSTOMER', 'CASH ADVANCE AGAINST DRY PRICE', '100000'),
(105, '2023-01-24', '35374', 'GARY GROUP MILLER', 'MALOONG CONTRACTUAL', 'CASH ADVANCE AGAINST MILLING RUBBER', '10000'),
(106, '2023-01-24', '35613', 'AMMAN AWALIN', 'CUSTOMER', 'CASH ADVANCE AGAINST EXPORT WET', '100000'),
(107, '2023-01-24', '91643', 'TANNY SULAYMAN', 'CSUTOMER', 'CASH ADVANCE AGAISNT COPRA DELIVERY', '100000'),
(108, '2023-01-25', '35506', 'romelyn ', 'LACAFE PACKINGERA', 'CASH ADVANCE', '1500'),
(109, '2023-01-25', '35507', 'JAQUELYN', 'LACAFE PACKINGERA', 'CASH ADVANCE', '1000'),
(110, '2023-01-25', '35621', 'TANNY SULAYMAN', 'CUSTOMER', 'CASH ADVANCE FOR COPRA CARGILL', '100000'),
(111, '2023-01-27', '91809', 'nenet constan', 'Customer', 'cash advance for wet export', '130000'),
(112, '2023-01-28', '35555', 'rogelio adaya jr.', 'Employee', 'cash advance against salary', '500'),
(113, '2023-01-28', '91813', 'Jimroy McClintock', 'CUSTOMER', 'CASH ADVANCE AGAINST DRY PRICE', '30000'),
(114, '2023-01-28', '35556', 'MAE ANGELES', 'EMPLOYEE', 'CASH ADVANCE AGAINST SALARY', '500'),
(115, '2023-01-28', '91812', 'nenet constan', 'customer', 'cash advance against export', '100000'),
(116, '2023-01-28', '35635', 'RONIE SADIO', 'EMPLOYEE', 'CASH ADVANCE AGAINST SALARY', '5000'),
(117, '2023-01-28', '35636', 'SULAYMAN TANI', 'CUSTOMER', 'CASH ADVANCE AGAINST COPRA', '50000'),
(118, '2023-01-30', '91818', 'jimroy McClintock', 'customer', 'cash advance for dry price', '70000'),
(119, '2023-01-30', '27128', 'norma dela cruz', 'Customer', 'cash advance for working capital copra', '10000'),
(122, '2023-01-31', '35703', 'raquel bais', 'Employee', 'cash advance  against salary', '9500'),
(123, '2023-01-31', '35704', 'ROSAMIE ANGELES', 'EMPLOYEE', 'CASH ADVANCE AGAINST SALARY', '7000'),
(124, '2023-01-31', '35568', 'BRIAN ALBUTRA', 'EMPLOYEE', 'CASH ADVANCE AGAINST SALARY', '4000'),
(125, '2023-01-31', '35711', 'ROGELIO ADAYA JR', 'EMPLOYEE', 'CASH ADVANCE AGAINST SALARY', '3000'),
(126, '2023-01-31', '35712', 'ERIC MANUEL', 'EMPLOYEE', 'CASH ADVANCE AGAINST SALARY', '5000'),
(127, '2023-01-31', '35709', 'ROBERTO ENRIQUEZ', 'EMPLOYEE', 'CASH ADVANCE AGAINST SALARY', '4500'),
(128, '2023-01-31', '35707', 'DAILE PELIGRIN', 'EMPLOYEE', 'CASH ADVANCE AGAINST SALARY', '4000'),
(129, '2023-01-31', '35705', 'RODJANE QUINOL', 'EMPLOYEE', 'CASH ADVANCE AGAINST SALARY', '4400'),
(130, '2023-01-31', '35710', 'IRENEO TORRES', 'EMPLOYEE', 'CASH ADVANCE AGAINST SALARY', '4500'),
(131, '2023-01-31', '35706', 'JOSEPH BENOSA', 'EMPLOYEE', 'CASH ADVANCE AGAINST SALARY', '3000'),
(132, '2023-01-31', '35708', 'DAYANRA REMIGIO', 'EMPLOYEE', 'CASH ADVANCE AGAINST SALARY', '4500'),
(133, '2023-01-31', '35439', 'CERILO SUALOG MALOONG', 'EMPLOYEE', 'CASH ADVANCE AGAINST SALARY ', '3500'),
(134, '2023-01-31', '35440', 'RAMIL PELIGRIN', 'EMPLOYEE MALOONG', 'CASH ADVANCE AGAINST SALARY', '3000'),
(135, '2023-01-31', '35420', 'RONIE VILDAD', 'EMPLOYEE MALOONG', 'CASH ADVANCE AGAINST SALARY', '2500'),
(136, '2023-01-31', '35421', 'BERTO GALANO JR', 'EMPLOYEE-MALOONG', 'CASH ADVANCE AGAINST SALARY', '7000'),
(137, '2023-01-31', '35422', 'EDWIN ASILAN', 'EMPLOYEE MALOONG', 'CASH ADVANCE AGAINST SALARY', '3800'),
(138, '2023-01-31', '35423', 'SAMUEL RAMILLANO', 'EMPLOYEE MALOONG', 'CASH ADVANCE AGAINST SALARY', '1000'),
(139, '2023-01-31', '35424', 'JEANNE ABELLA', 'EMPLOYEE MALOONG', 'CASH ADVANCE AGAINST SALARY', '15000'),
(140, '2023-01-31', '35425', 'JERRY GARCIA', 'EMPLOYEE MALOONG', 'CASH ADVANCE AGAINS SALARY', '3000'),
(141, '2023-01-31', '35426', 'GREGORIO MATULAC', 'EMLOYEE MALOONG', 'CASH ADVANCE AGAINST SALARY', '4000'),
(142, '2023-01-31', '35427', 'JONATHAN MANAGUIT', 'EMPLOYEE MALOONG', 'CASH ADVANCE AGAINST SALARY', '9000'),
(143, '2023-01-31', '35428', 'MELVIN FERRER', 'EMPLOYEE MALOONG', 'CASH ADVANCE AGAINST SALARY', '3500'),
(144, '2023-01-31', '35429', 'EDRITO LUANG', 'EMPLOYEE MALOONG', 'CASH ADVANCE AGAINST SALARY', '5000'),
(145, '2023-01-31', '35430', 'PABLO HIPULAN', 'EMPLOYEE-MALOONG', 'CASH ADVANCE AGAINST SALARY', '4000'),
(146, '2023-01-31', '35431', 'DENNIS CORPUZ', 'EMPLOYEE MALOONG', 'CASH ADVANCE AGAINST SALARY', '3500'),
(147, '2023-01-31', '35432', 'DINDO PENTOJO', 'EMPLOYEE MALOONG', 'CASH ADVANCE AGAINST SALARY', '4000'),
(148, '2023-01-31', '35433', 'ALVIN BONIFACIO', 'EMPLOYEE MALOONG', 'CASH ADVANCE AGAINST SALARY', '3000'),
(149, '2023-01-31', '35434', 'EDMUNDO CRISTOBAL', 'EMPLOYEE-MALOONG', 'CASH ADVANCE AGAINST SALARY', '3000'),
(150, '2023-01-31', '35435', 'ALBERT CORNELIA', 'EMPLOYEE-MALOONG', 'CASH ADVANCE AGAINST SALARY', '2000'),
(151, '2023-01-31', '35436', 'RAPRAP ABARQUEZ', 'EMPLOYEE MALOONG', 'CASH ADVANCE AGAINST SALARY', '3000'),
(152, '2023-01-31', '35437', 'JOVYLYN SAMIJON', 'EMPLOYEE MALOONG', 'CASH ADVANCE AGAINST SALARY', '4500'),
(153, '2023-01-31', '354385', 'WILFREDO QUIAMCO JR', 'EMPLOYEE MALOONG', 'CASH ADVANCE AGAINST SALARY', '3000'),
(154, '2023-01-31', '35416', 'OSCAR MALOONG TOPPERS', 'MALOONG TOPPERS', 'CASH ADVANCE FOR WET', '1000'),
(155, '2023-01-31', '35418', 'RENATO TOPPERS', 'MALOONG TOPPERS', 'CASH ADVANCE FOR WET RUBBER', '2000'),
(156, '2023-01-31', '35564', 'JERRY BAPURA MALOONG', 'MALOONG TOPPERS', 'CASH ADVANCE FOR WET RUBBER', '4000'),
(157, '2023-01-31', '35417', 'GUILBERT PANIDAR TOPPERS', 'MALOONG TOPPERS', 'CASH ADVANCE FOR WET', '1000'),
(158, '2023-02-01', '35720', 'edith butona', 'employee claret helper', 'cash advance against salary', '4000'),
(159, '2023-02-01', '91825', 'andrew pamaran', 'customer', 'cash advance against wet', '15000'),
(160, '2023-02-01', '91827', 'lee brown', 'customer', 'cash advance against rubber', '200000'),
(161, '2023-02-02', '91835', 'kotoh lasarul', 'customer', 'cash advance for copra', '10000'),
(162, '2023-02-02', '91833', 'elena constan', 'customer', 'cash advance for  copra', '200000'),
(163, '2023-02-03', '91837', 'EPIGIL MOLEJE', 'CUSTOMER', 'CASH ADVANCE FOR DRY PRICE', '50000'),
(164, '2023-02-04', '91844', 'nenet constan', 'customer', 'cash advance against export', '100000'),
(165, '2023-02-04', '91845', 'jimroy McClintock', 'customer', 'cash advance against dry price', '70000'),
(166, '2023-02-06', '91849', 'ELENA CONSTAN', 'CUSTOMER', 'CASH ADVANCE AGAINST COPRA', '200000'),
(167, '2023-02-06', '35588', 'LALANG LANGUTAN', 'EMPLOYEE', 'CASH ADVANCE AGAINST SALARY', '1500'),
(168, '2023-02-06', '35738', 'RONIE VILDAD', 'CUSTOMER', 'CASH ADVANCE WET BUYING', '100000'),
(169, '2023-02-07', '91850', 'amin abubakar', 'customer', 'cash advance against in copra', '150000'),
(170, '2023-02-08', '91858', 'nenet constan', 'customer', 'cash advance against export', '100000'),
(171, '2023-02-08', '91857', 'andrew pamaran', 'customer', 'cash advance for wet buying', '5000'),
(172, '2023-02-08', '39652', 'berto enriquez', 'employee', 'cash advance against salary', '3000'),
(173, '2023-02-09', '91860', 'NENET CONSTAN', 'CUSTOMER', 'CASH ADVANCE AGAINST COPRA', '200000'),
(174, '2023-02-10', '39667', 'editha labandera', 'employee', 'cash advance for labada', '500'),
(175, '2023-02-10', '91864', 'nenet constan', 'customer', 'cash advance for export wet', '100000'),
(176, '2023-02-10', '91864', 'nenet constan', 'customer', 'cash advance for export wet', '100000'),
(177, '2023-02-10', '39664', 'karpintero for ejn construction 3pcs. door jam', 'personal expenses', 'cash advance for ejn construction door', '3000'),
(178, '2023-02-11', '35661', 'jameson samsona', 'employee', 'cash advance against salary', '500'),
(179, '2023-02-11', '39671', 'brian albutra', 'employee', 'cash advance against salary', '1000'),
(180, '2023-02-11', '39670', 'dayanara remigio', 'employee', 'cash against salary', '3500'),
(181, '2023-02-11', '91865', 'tany sulayman', 'customer', 'cash advance against wet export', '50000'),
(182, '2023-02-11', '35591', 'rafael ramirez', 'employee', 'cash advance against salary', '1000'),
(183, '2023-02-13', '39677', 'raquel bais', 'employee', 'cash advance against against salary', '5000'),
(184, '2023-02-13', '91868', 'nenet costan', 'customer', 'cash advance for milling', '100000'),
(185, '2023-02-13', '91869', 'mudzkier abdulrahman', 'customer', 'cash advance for wet export', '50000'),
(186, '2023-02-14', '27140', 'SULAYMAN TANY', 'CUSTOMER', 'CASH ADVANCE AGAINST WET EXPORT', '50000'),
(187, '2023-02-14', '91873', 'JIMROY McClintock', 'customer', 'cash advance against dry price', '50000'),
(188, '2023-02-15', '40856', 'lalang langutan', 'employee', 'cash advance against salary', '1000'),
(189, '2023-02-15', '39691', 'roberto enriquez', 'employee', 'cash advance against salary', '4500'),
(190, '2023-02-15', '39699', 'jerry bapora', 'employee', 'cash advance against salary', '4200'),
(191, '2023-02-15', '39690', 'dayanara remigio', 'employee', 'cash advance against salary', '4500'),
(192, '2023-02-15', '39687', 'rosamie angeles', 'employee', 'cash advance against salary', '8500'),
(193, '2023-02-15', '39688', 'rodjane quinol', 'employee', 'cash advance against salary', '5000'),
(194, '2023-02-15', '39689', 'joseph benosa', 'employee', 'cash advance against salary', '3200'),
(195, '2023-02-15', '39686', 'raquel bais', 'employee', 'cash advance against salary', '10000'),
(196, '2023-02-15', '39692', 'ireneo torres', 'employee', 'cash advance against salary', '5000'),
(197, '2023-02-15', '35783', 'alvin bonifacio', 'employee maloong', 'cash advance against salary', '3000'),
(198, '2023-02-15', '39696', 'mercy palconit', 'employee helper', 'cash advance against salary', '1000'),
(199, '2023-02-15', '35598', 'biran albutra', 'employee Guard', 'cash advance against salary', '5000'),
(200, '2023-02-15', '35822', 'albert cornelia', 'employee maloong', 'cash advance against salary', '2000'),
(201, '2023-02-15', '35805', 'jonathan managuit ', 'employee maloong', 'cash advance against salary', '9000'),
(202, '2023-02-15', '35806', 'melvin ferrer', 'employee maloong', 'cash advance against salary', '4000'),
(203, '2023-02-15', '35807', 'jeanne abella', 'employee maloong', 'cash advance against salary', '7000'),
(204, '2023-02-15', '35808', 'gregorio matulac', 'employee maloong', 'cash advance against salary', '3500'),
(205, '2023-02-15', '35809', 'ronie vildad', 'employee maloong', 'cash advance against salary', '5000'),
(206, '2023-02-15', '35810', 'raprap abarquez', 'employee maloong', 'cash advance against salary', '3000'),
(207, '2023-02-15', '35811', 'ederito luang', 'employee maloong', 'cash advance against salary', '3000'),
(208, '2023-02-15', '35813', 'dindo pentojo', 'employee maloong', 'cash advance against salary', '3500'),
(209, '2023-02-15', '35812', 'cerilo sualog', 'employee maloong', 'cash advance against salary', '3500'),
(210, '2023-02-15', '35814', 'edmudno cristobal', 'employee maloong', 'cash advance against salary', '3000'),
(211, '2023-02-15', '35815', 'edwin asilan', 'employee maloong', 'cash advance against salary', '3800'),
(212, '2023-02-15', '35816', 'samuel ramillano', 'employee maloong', 'cash advance against salary', '1000'),
(213, '2023-02-15', '35817', 'dennis corpuz', 'employee maloong', 'cash advance against salary', '3500'),
(214, '2023-02-15', '35818', 'pablo hipulan', 'employee maloong', 'cash advance against salary', '3000'),
(217, '2023-02-15', '35819', 'jerry garcia', 'employee maloong', 'cash advance against salary', '3000'),
(218, '2023-02-15', '35820', 'hereberto galano jr', 'employee maloong', 'cash advance against salary', '10000'),
(219, '2023-02-15', '35821', 'jovylyn samijon', 'employee maloong', 'cash advance against salary', '3500'),
(220, '2023-02-15', '35597', 'ramil peligrin', 'employee maloong', 'cash advance against salary', '4000'),
(221, '2023-02-15', '35802', 'guilbert panidar', 'maloong wet rubber toppers', 'cash advance againts wet deliver', '1000'),
(222, '2023-02-15', '35801', 'oscar balagolan', 'maloong wet toppers', 'cash advance against wet rubber', '1000'),
(223, '2023-02-15', '35804', 'renato cotales', 'maloong wet toppers', 'cash advance against wet rubber', '2000'),
(224, '2023-02-15', '39693', 'rogelio adaya jr', 'employee ', 'cash advance against salary', '3000'),
(225, '2023-02-16', '91881', 'jimroy McClintock', 'customer', 'cash advance for dry ', '100000'),
(226, '2023-02-16', '39694', 'eric manuel', 'employee', 'csah advance against salary', '6500'),
(227, '2023-02-17', '39755', 'roger napalcruz', 'pakyawan laborer', 'cash advance  against pordia', '7500'),
(228, '2023-02-18', '35784', 'ANTHONY CASTIL', 'MALOONG EMPLOYEE', 'CASH ADVANCE AGAINST SALARY', '5000'),
(229, '2023-02-18', '35785', 'PABLO HIPULAN', 'MALOONG EMPLOYEE', 'CASH ADVANCE AGAINST SALARY', '2000'),
(230, '2023-02-18', '91888', 'NENET COSTAN', 'CUSTOMER', 'CASH ADVANCE AGAINST WET', '200000'),
(231, '2023-02-20', '91894', 'RUBEN RAMOS', 'CUSTOMER', 'CASH ADVANCE AGAINST DRY PRICE', '30000'),
(232, '2023-02-20', '39765', 'SULAYMAN TANY', 'CUSTOMER', 'CASH ADVANCE AGAINST EXPORT', '50000'),
(233, '2023-02-20', '40858', 'JONG2X ADAYA JR', 'EMPLOYEE', 'CASH ADVANCE AGAINST SALARY', '500'),
(234, '2023-02-20', '39766', 'RASHID AMILIN', 'CUSTOMER', 'CASH ADVANCE AGAINST EXPORT WET', '100000'),
(235, '2023-02-20', '40859', 'ERNESTO NALAM', 'EMPLOYEE PORDIA', 'CASH ADVANCE AGAINST SALARY', '1500'),
(236, '2023-02-20', '91893', 'RAYMOND SAN JUAN', 'CUSOMER BUYING WET SAYUGAN', 'CASH ADVANCE AGAINST WET BUYING', '100000'),
(237, '2023-02-20', '91892', 'ANDREW PAMARAN', 'CUSTOMER', 'CASH ADVANCE AGAINS WET RUBBER', '10000'),
(238, '2023-02-20', '91891', 'SULAYMAN TANY', 'CUSTOMER', 'CASH ADVANCE AGAINST WET EXPORT', '50000'),
(239, '2023-02-20', '39762', 'MUDZKIER ABDURAHMAN', 'CUSTOMER', 'CASH ADVANCE AGAINST WET RUBBER EXPORT', '100000'),
(240, '2023-02-21', '39772', 'rashid amilin', 'customer', 'cash advance against for rubber', '200000'),
(241, '2023-02-21', '40860', 'feliper borda', 'employee lacafe', 'cash advance against salary', '1500'),
(242, '2023-02-21', '91895', 'nenet costan', 'customer', 'cash advance against wet export', '50000'),
(243, '2023-02-22', '40863', ' 5person  sandijas/nonoy/moyong/sanogal/pepito', 'toppers buahan', 'cash advance against rubber output', '4000'),
(244, '2023-02-23', '93510', 'harry sabtal', 'customer', 'cash advance for wet rubber export', '200000'),
(245, '2023-02-23', '93508', 'nenet costan', 'customer ', 'cash advance against wet for export', '50000'),
(246, '2023-02-23', '93505', 'long2x san juan', 'customer', 'cash advance against wet buying', '200000'),
(247, '2023-02-23', '39781', 'niño garcia', 'maloong contractual', 'cash advance ', '1000'),
(248, '2023-02-24', '39785', 'IRENEO TORRES', 'EMPLOYEE', 'CASH ADVANCE AGAINST SALARY', '1000'),
(249, '2023-02-24', '93512', 'ASIM GAHAMUN ONZ', 'CUSTOMER', 'CASH ADVANCE AGAINST WET RUBBER EXPORT', '200000'),
(250, '2023-02-25', '93516', 'amin abubakar', 'customer', 'cash advance against copra', '150000'),
(251, '2023-02-25', '93515', 'long2x san juan', 'customer', 'cash advance against wet ', '100000'),
(252, '2023-02-25', '35859', 'jean abella', 'employee', 'cash advance against salary', '3000'),
(253, '2023-02-25', '35854', 'toto castil', 'employee maloong', 'cash advance against salary', '10000'),
(254, '2023-02-25', '27537', 'NENET COSTAN', 'CUSTOMER', 'CASH ADVANCE AGAINST WET', '200000'),
(255, '2023-02-25', '93517', 'LOUIE DELOS REYES', 'CUSTOMER', 'CASH ADVANCE AGAINST DRY PRICE', '150000'),
(256, '2023-02-27', '93523', 'sulayman tani', 'customer', 'cash advance against wet export', '100000'),
(257, '2023-02-27', '93522', 'ruben ramos', 'customer', 'cash advance against dry price', '150000'),
(258, '2023-02-27', '93521', 'rapid amilin', 'customer', 'cash advance for export', '200000'),
(259, '2023-02-27', '93520', 'jimroy McClintock', 'customer', 'cash advance against dry price', '80000'),
(260, '2023-02-27', '39954', 'raquel bais', 'employee', 'cash advance for salary', '9500'),
(261, '2023-02-27', '39953', 'mae angeles', 'employee', 'cash advance against salary', '1000'),
(262, '2023-02-27', '39951', 'joseph benosa', 'employee', 'cash advance against salayr', '5000'),
(263, '2023-02-27', '93518', 'long2x san juan', 'customer', 'cash advance wet buying', '200000'),
(264, '2023-02-28', '93524', 'long2x san juan', 'customer', 'cash advance against wet buying', '200000'),
(265, '2023-02-28', '39973', 'felipe borda', 'employee', 'cash advance against salary', '1000'),
(266, '2023-02-28', '39974', 'ernesto nalam', 'employee', 'cash advance against salary', '2000'),
(267, '2023-02-28', '39975', 'lalang langutan', 'employee pordia', 'cash advance against salary', '1000'),
(268, '2023-02-28', '39968', 'berto enriquez', 'employee', 'cash advance against salary', '4500'),
(269, '2023-02-28', '39976', 'eric manuel', 'employee', 'cash advance against salary', '4500'),
(270, '2023-02-28', '39965', 'jane quinol', 'employee', 'cash advance against salary', '4400'),
(271, '2023-02-28', '40869', 'mae angeles', 'employee', 'cash advance against salary', '6500'),
(272, '2023-02-28', '35863', 'asilan edwin', 'employee maloong', 'cash advance against salary', '4000'),
(273, '2023-02-28', '35861', 'ronie vildad', 'employee maloong', 'cash advance for salary', '5000'),
(274, '2023-02-28', '35860', 'galano berto', 'employee maloong', 'cash advance for salary', '7000'),
(275, '2023-02-28', '35862', 'matulac gregorio', 'employee maloong', 'cash advance for salary', '5000'),
(276, '2023-02-28', '35878', 'jovylyn samijon', 'employee maloong', 'cash advance for salary', '8000'),
(277, '2023-02-28', '35877', 'albert cornelia', 'employee maloong', 'cash advance for salary', '2500'),
(278, '2023-02-28', '35876', 'ramil pelegrin', 'employee maloong', 'cash advance for salary', '3000'),
(279, '2023-02-28', '35875', 'cristobal edmundo', 'employee maloong', 'cash advance against salary', '4000'),
(280, '2023-02-28', '35873', 'alvin bonifacio', 'employee maloong', 'cash advance against salary', '4000'),
(281, '2023-02-28', '35872', 'samuel ramillano', 'employee maloong', 'cash advance against salary', '2000'),
(282, '2023-02-28', '35871', 'jeanne abella', 'EMPLOYEE MALOONG', 'CASH ADVANCE AGAINST SALARY', '10000'),
(283, '2023-02-28', '35874', 'JONATHAN MANAGUIT', 'EMPLOYEE MALOONG', 'CASH ADVANCE AGAINST SALARY', '9000'),
(284, '2023-02-28', '35865', 'HIPULAN PABLO', 'EMPLOYEE MALOONG', 'CASH ADVANCE FOR SALARY', '5000'),
(285, '2023-02-28', '35864', 'CORPUZ DENNIS', 'EMPLOYEE MALOONG', 'CASH ADVANCE FOR SALARY', '4000'),
(286, '2023-02-28', '35866', 'LUANG EDERITO', 'EMPLOYEE MALOONG', 'CASH ADVANCE AGAINST SALARY', '3000'),
(287, '2023-02-28', '35867', 'PENTOJO DINDO', 'EMPLOYEE MALOONG', 'CASH ADVANCE AGAINST SALARY', '5000'),
(288, '2023-02-28', '35868', 'MELVIN FERER', 'EMPLOYEE MALOONG', 'CASH ADVANCE AGAINST SALARY', '4000'),
(289, '2023-02-28', '35869', 'ABARQUEZ RAF2X', 'EMPLOYEE MALOONG', 'CASH ADVANCE FOR SALARY', '4000'),
(290, '2023-02-28', '35870', 'JERRY GARCIA', 'EMPLOYEE', 'CASH ADVANCE AGAINST SALARY', '3000'),
(291, '2023-02-28', '35881', 'GILBERT PANIDAR', 'MALOONG TOPPERS', 'CASH ADVANCE FOR WET', '1000'),
(292, '2023-02-28', '35880', 'renato cotales', 'maloong toppers', 'cash advance for wet', '2000'),
(293, '2023-02-28', '35879', 'oscar balagolan', 'maloong toppers', 'cash advance for wet', '1000'),
(294, '2023-02-28', '39959', 'anthony castil', 'maloong toppers', 'cash advance for wet', '5000'),
(295, '2023-02-28', '39964', 'gerry bapura', 'guard employee', 'cash advance for salary', '4200'),
(296, '2023-02-28', '39963', 'brian albutra', 'guard employee', 'cash advance for salary', '4000'),
(297, '2023-02-28', '39969', 'ireneo torres', 'employee coffee', 'cash advance against salary', '4500'),
(298, '2023-02-28', '39970', 'rogelio adaya jr', 'employee coffee', 'cash advance against salary', '3000'),
(299, '2023-02-28', '27146', 'ervin sardam', 'sungkitero', 'cash advance against copra ejn personal', '2000'),
(300, '2023-03-01', '39982', 'edith butona', 'employee helper', 'cash advance against salary', '3000'),
(301, '2023-03-01', '93531', 'charly cawley', 'customer', 'cash advance for bales', '130000'),
(302, '2023-03-01', '39980', 'melvin ferer', 'employee maloong', 'cash advance for salary', '1000'),
(303, '2023-03-01', '93529', 'long2x san juan', 'customer', 'cash advance for wet', '200000'),
(304, '2023-03-02', '39989', 'DINDO PENTOJO', 'EMPLOYEE MALOONG', 'Employee', '1000'),
(305, '2023-03-02', '39988', 'JOEY ORTEGA', 'SAYUGAN GUARD', 'Employee', '2500'),
(306, '2023-03-02', '39985', 'DANNY DELIGERO', 'MALOONG CABINET', 'Karpentero', '3000'),
(309, '2023-03-03', '39995', 'RAP2x ABARQUEZ', 'EMPLOYEE OF MALOONG ', 'Employee', '1100'),
(310, '2023-03-03', '93536', 'ASIM GAHAMUN (ONZ)', 'CUSTOMER', 'CASH ADVANCE WET RUBBER', '200000'),
(311, '2023-03-03', '93537', 'LONG2x SAN JUAN', 'Sayugan Buying Station', 'Customer', '100000'),
(312, '2023-03-04', '39999', 'JAYSON CASTILLO', 'MALOONG EMPLOYEE', 'Employee', '2000'),
(313, '2023-03-04', '40000', 'BERTO ENRIQUEZ', 'EMPLOYEE', 'Employee', '6000'),
(314, '2023-03-04', '93538', 'ANDREW PAMARAN', 'WET RUBBER', 'Customer', '10000'),
(315, '2023-03-06', '93543', 'long2 san juan', 'Sayugan Buying Station', 'Customer', '150000'),
(316, '2023-03-06', '93541', 'long2 san juan', 'Sayugan Buying Station', 'Customer', '200000'),
(317, '2023-03-07', '35692', 'brian albutra', 'employee guard', 'Employee', '1000'),
(318, '2023-03-07', '93546', 'lee roy brown', 'lee brown buying wet rubber', 'Customer', '200000'),
(319, '2023-03-07', '93547', 'tany sulayman', 'for export wt container', 'Customer', '100000'),
(320, '2023-03-08', '93550', 'charles cawley', 'cawley for rubber bales', 'Customer', '130000'),
(321, '2023-03-09', '93553', 'jimroy mcclintok', 'buying jimroy', 'Customer', '50000'),
(322, '2023-03-09', '93551', 'mudzkier abdurahman', 'rubber export', 'Customer', '300000'),
(323, '2023-03-10', '0001', 'long2 san juan', 'Sayugan Buying Station', 'Customer', '200000'),
(324, '2023-03-10', '40020', 'jimson samsona', 'lacafe', 'Employee', '1000'),
(325, '2023-03-10', '40018', 'dayanara mae remigio', 'employee', 'Employee', '5000'),
(326, '2023-03-10', '40019', 'tata torres', 'employee', 'Employee', '1000'),
(327, '2023-03-10', '40016', 'danny deligerio', 'karpentero', 'Karpentero', '2000'),
(328, '2023-03-11', '40030', 'editha del rosario', 'labandera', 'Employee', '1500'),
(329, '2023-03-11', '27567', 'andrew pamaran', 'wet rubber', 'Customer', '3000'),
(330, '2023-03-11', '40874-40881', 'maloong miller', 'employee', 'Maloong Contractual', '34000'),
(331, '2023-03-11', '40882', 'jay2 group ( crumbling)', 'contractual maloong', 'Maloong Contractual', '5000'),
(332, '2023-03-13', '0004', 'mudzkier abdurahman', 'rubber export', 'Customer', '100000'),
(333, '2023-03-14', '40039', 'jeanne abella', 'employee', 'Employee', '15000'),
(334, '2023-03-14', '93556', 'amin abubakar', 'copras', 'Customer', '200000'),
(335, '2023-03-15', '35897', 'oscar balagolan', 'maloong toppers', 'Topper', '1000'),
(336, '2023-03-15', '40045', 'brian albutra', 'employee guard', 'Employee', '4000'),
(337, '2023-03-15', '40046', 'mercy falconit', 'yaya', 'Employee', '3000'),
(338, '2023-03-15', '40891', 'pablo hipulan', 'maloong employee', 'Employee', '5000'),
(339, '2023-03-15', '40892', 'dennis cruz', 'maloong', 'Employee', '6000'),
(340, '2023-03-15', '35900', 'jonathan malaguit', 'maloong', 'Employee', '9000'),
(341, '2023-03-15', '40900', 'edwin asilan', 'maloong', 'Employee', '4000'),
(342, '2023-03-15', '40886', 'gregorio matulac', 'maloong', 'Employee', '4500'),
(343, '2023-03-15', '40884', 'ronnie vildad', 'maloong', 'Employee', '5000'),
(344, '2023-03-15', '40885', 'hereberto galano', 'maloong', 'Employee', '8000'),
(345, '2023-03-15', '40889', 'ederito luang', 'maloong', 'Employee', '5000'),
(346, '2023-03-15', '40887', 'dindo pentojo', 'maloong', 'Employee', '3000'),
(347, '2023-03-15', '40893', 'melvin ferrer', 'maloong', 'Employee', '6000'),
(348, '2023-03-15', '40890', 'rafraf abarquez', 'maloong', 'Employee', '4500'),
(349, '2023-03-15', '35899', 'jerry garcia', 'maloong', 'Employee', '3000'),
(350, '2023-03-15', '40896', 'samuel ramillano', 'maloong', 'Employee', '5000'),
(351, '2023-03-15', '40897', 'alvin bonifacio', 'maloong', 'Employee', '4000'),
(352, '2023-03-15', '40898', 'edmundo cristobal', 'maloong', 'Employee', '6000'),
(353, '2023-03-15', '40899', 'ramil pelegrin', 'maloong', 'Employee', '5000'),
(354, '2023-03-15', '40895', 'cerilo sualog', 'maloong', 'Employee', '3500'),
(355, '2023-03-15', '40894', 'jovylyn samijon', 'maloong', 'Employee', '6000'),
(356, '2023-03-15', '40888', 'wilfredo quimco', 'maloong', 'Employee', '5000'),
(357, '2023-03-15', '40101', 'albrt cornelia', 'maloong', 'Employee', '2500'),
(358, '2023-03-15', '0006', 'long2 san juan', 'Sayugan Buying Station', 'Customer', '200000'),
(359, '2023-03-15', '40049', 'gerry bapora', 'guard', 'Employee', '4200'),
(360, '2023-03-15', '40048', 'conchita delos reyes', 'helper', 'Employee', '4500'),
(361, '2023-03-15', '40462', 'rogelio adaya jr', 'pordia', 'Employee', '3000'),
(362, '2023-03-15', '40462', 'ernesto nalam', 'pordiya', 'Employee', '2000'),
(363, '2023-03-15', '40463', 'emelito langutan', 'pordia', 'Employee', '1500'),
(364, '2023-03-15', '40464', 'felipe borda', 'lacafe', 'Employee', '1000'),
(365, '2023-03-15', '40458', 'tata torres', 'lacafe', 'Employee', '4500'),
(366, '2023-03-15', '40467', 'jane quinol', 'en office', 'Employee', '5000'),
(367, '2023-03-15', '40466', 'dayanara mae remigio', 'en office', 'Employee', '4500'),
(368, '2023-03-15', '40469', 'joseph benosa', 'en office', 'Employee', '3200'),
(369, '2023-03-15', '40468', 'berto enriquez', 'en office', 'Employee', '4500'),
(370, '2023-03-15', '40472', 'jimson samson', 'lacafe', 'Employee', '500'),
(371, '2023-03-15', '40465', 'raquel bais', 'en office', 'Employee', '9500'),
(372, '2023-03-15', '40473', 'eric manuel', 'driver', 'Employee', '6500'),
(373, '2023-03-16', '0008', 'LONG2 SAN JUAN', 'Sayugan Buying Station', 'Customer', '100000'),
(374, '2023-03-16', '93559', 'JIMROY MCCLINTOK', 'FOR MILLING', 'Customer', '50000'),
(375, '2023-03-17', '0014', 'ANDREW RAMARAN', 'WET RUBBER', 'Customer', '10000'),
(376, '2023-03-17', '0012', 'MUDZKIER ABDURAHMAN', 'WET RUBBER EXPORT', 'Customer', '50000'),
(377, '2023-03-17', '0010', 'HON. JOEL MATURAN/ LONG2 SAN JUAN', 'WET RUBBER @ KABASALAN', 'Customer', '350000'),
(378, '2023-03-18', '40492', 'LONG SAN JUAN', 'Sayugan Buying Station', 'Customer', '100000'),
(379, '2023-03-18', '0020', 'LOUI DELOS REYES', 'CUSTOMER', 'Customer', '15000'),
(380, '2023-03-18', '0015', 'TANY SULAYMAN', 'WET RUBBER EXPORT', 'Customer', '200000'),
(381, '2023-03-18', '0016', 'NENETH COSTAN', 'WET RUBBER TO LANTAWAN', 'Customer', '140000'),
(382, '2023-03-18', '40351', 'ANTHONY CASTIL', 'MALOONG EMPLOYEE', 'Employee', '10000'),
(383, '2023-03-20', '40511', 'CONCHITA DELOS REYES', 'HELPER', 'Employee', '1000'),
(384, '2023-03-20', '40515', 'ERIC MANUEL', 'DRIVER', 'Employee', '1500'),
(385, '2023-03-20', '0021', 'CAPT. ALFARO', 'WET RUBBER', 'Customer', '50000'),
(386, '2023-03-20', '0022', 'TANY SULAYMAN', 'WET RUBBER EXPORT', 'Customer', '100000'),
(387, '2023-03-20', '0024', 'LONG2 SAN JUAN', 'Sayugan Buying Station', 'Customer', '100000'),
(388, '2023-03-21', '0025', 'MUDZKIER ABDURAHMAN', 'RUBBER EXPORT', 'Customer', '200000'),
(389, '2023-03-21', '0027', 'LONG SAN JUAN', 'Sayugan Buying Station', 'Customer', '150000'),
(390, '2023-03-21', '0029', 'NENETH COSTAN', 'Nenet Buying Station', 'Customer', '100000'),
(391, '2023-03-23', '40358', 'TOTOH CASTIL', 'MALOONG', 'Employee', '5000'),
(392, '2023-03-23', '0031', 'LONG SAN JUAN', 'Sayugan Buying Station', 'Customer', '100000'),
(393, '2023-03-24', '40538', 'FELIPE BORDA', 'LACAFE', 'Employee', '1000'),
(394, '2023-03-24', '40534', 'ANDREW PAMARAN', 'WET RUBBER', 'Customer', '5000'),
(395, '2023-03-24', '00037', 'CAPT ALFARO', 'WET RUBBER', 'Customer', '10000'),
(396, '2023-03-24', '0038', 'NENETH COSTAN', 'Nenet Buying Station', 'Customer', '150000'),
(397, '2023-03-24', '0039', 'LOUIE DELOS REYES', 'LOUIE BUYING STATION', 'Customer', '150000'),
(398, '2023-03-25', '40373', 'ROWEL GROUP (MILLER', 'MILLER', 'Maloong Contractual', '15000'),
(399, '2023-03-25', '40374', 'ALIM ROUP', 'MILLER', 'Maloong Contractual', '5000'),
(400, '2023-03-25', '40376', 'DONDON GROUP', 'MILLER', 'Maloong Contractual', '5000'),
(401, '2023-03-25', '40375', 'JAY2 GROUP', 'CRUMBLING', 'Maloong Contractual', '3000'),
(402, '2023-03-25', '40377', 'FIELD DEPT.', 'PORDIYA', 'Maloong Contractual', '4000'),
(403, '2023-03-25', '40378', 'ALBERT MANAGUIT', 'MALOONG', 'Employee', '3000'),
(404, '2023-03-25', '40380', 'GUARD', 'MALOONG', 'Maloong Contractual', '5000'),
(405, '2023-03-25', '40381', 'RURNACE', 'MALOONH', 'Maloong Contractual', '4500'),
(406, '2023-03-25', '0042', 'LONG SAN JUAN', 'Sayugan Buying Station', 'Customer', '100000'),
(407, '2023-03-25', '0040', 'LONG SAN JUAN', 'Sayugan Buying Station', 'Customer', '100000'),
(408, '2023-03-25', '0041', 'ANDREW PAMARAN', 'WET RUBBER', 'Customer', '3000'),
(409, '2023-03-27', '40544', 'andrew abella', 'karpentero', 'Karpentero', '5000'),
(410, '2023-03-27', '0044', 'long san juan', 'Sayugan Buying Station', 'Customer', '100000'),
(411, '2023-03-27', '0045', 'jimroy mcclintock', 'wet rubber', 'Customer', '30000'),
(412, '2023-03-27', '40545', 'edith bbuatona', 'helper', 'Employee', '5000'),
(413, '2023-03-27', '0046', 'neneth costan', 'Nenet Buying Station', 'Customer', '100000'),
(414, '2023-03-27', '40384', 'topeng group', 'miller maloong', 'Maloong Contractual', '2000'),
(415, '2023-03-27', '40546', 'brian albutra', 'security guard', 'Employee', '400'),
(416, '2023-03-28', '0048', 'jimroy mcclintock', 'jimroy buying', 'Customer', '30000'),
(417, '2023-03-28', '0049', 'ruben ramos', 'ruben buying', 'Customer', '150000'),
(418, '2023-03-28', '0047', 'long san juan', 'Sayugan Buying Station', 'Customer', '200000'),
(419, '2023-03-29', '0050', 'long san juan', 'Sayugan Buying Station', 'Customer', '150000'),
(420, '2023-03-29', '40559', 'alvin gulphere', 'arkho', 'Customer', '100000'),
(421, '2023-03-29', '40202', 'totoh castil', 'employee', 'Employee', '5000'),
(422, '2023-03-29', '40201', 'anthony castil', 'employee', 'Employee', '5000'),
(423, '2023-03-29', '40563', 'loloy cero', 'employee', 'Employee', '3500'),
(424, '2023-03-29', '40564', 'joey ortega', 'sayugan guard', 'Employee', '6000'),
(425, '2023-03-29', '0055', 'neneth costan', 'Nenet Buying Station', 'Customer', '150000'),
(426, '2023-03-30', '40568', 'sandias', 'buahan toppers', 'Topper', '1000'),
(427, '2023-03-30', '40568', 'nonoy', 'buahan toppers', 'Topper', '1000'),
(428, '2023-03-30', '40568', 'moyong', 'buahan topper', 'Topper', '500'),
(429, '2023-03-30', '40568', 'sanugal', 'buahan topper', 'Topper', '1000'),
(430, '2023-03-30', '40568', 'pepito', 'buahan topper', 'Topper', '500'),
(431, '2023-03-30', '0056', 'long san juan', 'Sayugan Buying Station', 'Customer', '200000'),
(432, '2023-03-30', '0058', 'long san juan', 'Sayugan Buying Station', 'Customer', '50000'),
(433, '2023-03-31', '40227', 'oscar balagolan', 'maloong', 'Topper', '1000'),
(434, '2023-03-31', '40220', 'hereberto galano', 'maloong', 'Employee', '7000'),
(435, '2023-03-31', '40218', 'gregorio matulac', 'maloong', 'Employee', '4000'),
(436, '2023-03-31', '40217', 'ronnie vildad', 'maloong', 'Employee', '5000'),
(437, '2023-03-31', '40216', 'jovylyn samijon', 'maloong', 'Employee', '3500'),
(438, '2023-03-31', '40215', 'melvin ferrer', 'maloong', 'Employee', '5000'),
(439, '2023-03-31', '40214', 'edwin asilan', 'maloong', 'Employee', '3900'),
(440, '2023-03-31', '40213', 'samuel ramillano', 'maloong', 'Employee', '5000'),
(441, '2023-03-31', '40212', 'pablo hipulan', 'maloong', 'Employee', '4000'),
(442, '2023-03-31', '40211', 'dennis corpus', 'maloong', 'Employee', '4000'),
(443, '2023-03-31', '40210', 'jonathan managuit', 'maloong', 'Employee', '9000'),
(444, '2023-03-31', '40208', 'ederito juang', 'maloong', 'Employee', '3500'),
(445, '2023-03-31', '40209', 'rafraf abarques', 'maloong', 'Employee', '4000'),
(446, '2023-03-31', '40207', 'alvin bonifacio', 'maloong', 'Employee', '3000'),
(447, '2023-03-31', '40206', 'idmundo cristobal', 'maloong', 'Employee', '3000'),
(448, '2023-03-31', '40230', 'ramil pelegrin', 'maloong', 'Employee', '4000'),
(449, '2023-03-31', '40204', 'dindo pentojo', 'maloong', 'Employee', '2500'),
(450, '2023-03-31', '40205', 'albert cornella', 'maloong', 'Employee', '3000'),
(451, '2023-03-31', '40221', 'cerilo sualog', 'maloong', 'Employee', '3500'),
(452, '2023-03-31', '40222', 'jeanne abella', 'maloong', 'Employee', '7000'),
(453, '2023-03-31', '40219', 'jerry garcia', 'maloong', 'Employee', '3000'),
(454, '2023-03-31', '40228', 'jerom alcoreza', 'maloong', 'Topper', '500'),
(455, '2023-03-31', '40231', 'guilbert panidar', 'maloong', 'Employee', '1000'),
(456, '2023-03-31', '0059', 'long san juan', 'Sayugan Buying Station', 'Employee', '200000'),
(457, '2023-03-31', '0061', 'jerry ariero', 'customer', 'Customer', '70000'),
(458, '2023-03-31', '0062', 'jimroy mcclintock', 'customer', 'Customer', '50000'),
(459, '2023-03-31', '40583', 'joseph benosa', 'employee', 'Employee', '3200'),
(460, '2023-03-31', '40588', 'brian albutra', 'guard', 'Employee', '5000'),
(461, '2023-03-31', '40584', 'dayanara mae remigio', 'employee', 'Employee', '4500'),
(462, '2023-03-31', '40582', 'jane quinol', 'employee', 'Employee', '4400'),
(463, '2023-03-31', '40581', 'raquel bais', 'employee', 'Employee', '9500'),
(464, '2023-03-31', '40585', 'eric manuel', 'employee ', 'Employee', '5000'),
(465, '2023-03-31', '40600', 'linda del rosario', 'helper', 'Employee', '3000'),
(466, '2023-03-31', '40593', 'felipe borda', 'lacafe', 'Employee', '2000'),
(467, '2023-03-31', '40592', 'ernesto nalam', 'pordiya', 'Employee', '2000'),
(468, '2023-03-31', '40586', 'berto enriquez', 'employee', 'Employee', '4500'),
(469, '2023-03-31', '40591', 'jung adaya', 'pordiya', 'Employee', '3000'),
(470, '2023-03-31', '40589', 'tata torres', 'lacafe', 'Employee', '5000'),
(471, '2023-03-31', '40596', 'lalang langutan', 'pordiya', 'Employee', '2000'),
(472, '2023-04-01', '40602', 'GIGI BAPORA', 'GUARD', 'Employee', '4200'),
(473, '2023-04-01', '91773', 'NENETH COSTAN', 'Nenet Buying Station', 'Customer', '100000'),
(474, '2023-04-01', '0063', 'LONG SAN JUAN', 'Sayugan Buying Station', 'Customer', '200000'),
(475, '2023-04-03', '40617', 'ANDREW ABELLA', 'OTHER', 'Karpentero', '9500'),
(476, '2023-04-03', '93581', 'JIMROY MCCLINTOCK', 'JIMROY BUYING', 'Customer', '30000'),
(477, '2023-04-03', '93583', 'ANDREW PAMARAN', 'ANDREW  BUYING', 'Customer', '10000'),
(478, '2023-04-03', '40626', 'ERIC MANUEL', 'DRIVER', 'Employee', '1500'),
(479, '2023-04-04', '93582', 'amin abubakar', 'copra', 'Customer', '93582'),
(480, '2023-04-04', '93584', 'long san juan', 'Sayugan Buying Station', 'Customer', '100000'),
(481, '2023-04-04', '40628', 'jeanne abella', 'maloong employee', 'Employee', '7000'),
(482, '2023-04-04', '93585', 'mudzkier abdurahman', 'wet rubber export', 'Customer', '100000'),
(483, '2023-04-04', '40631', 'JIMSON SAMSONA', 'LACAFE', 'Employee', '1500'),
(484, '2023-04-05', '91777', 'LONG2 SAN JUAN', 'Sayugan Buying Station', 'Customer', '100000'),
(485, '2023-04-05', '91775', 'CHARLS CAWLEY', 'WET RUBBER', 'Customer', '130000'),
(486, '2023-04-05', '91776', 'LOUIE DELOS REYES', 'LOUIE BUYING', 'Customer', '200000'),
(487, '2023-04-05', '91778', 'NENETH COSTAN', 'Nenet Buying Station', 'Customer', '50000'),
(488, '2023-04-05', '91775', 'charles cawley', 'carley buying', 'Customer', '130000'),
(489, '2023-04-05', '91776', 'louie delos reyes', 'louei buying', 'Customer', '200000'),
(490, '2023-04-05', '91778', 'neneth costan', 'Nenet Buying Station', 'Customer', '50000'),
(491, '2023-04-05', '91777', 'long san juan', 'Sayugan Buying Station', 'Customer', '100000'),
(492, '2023-04-08', '40643', 'edith buaton', 'zambo', 'Employee', '2000'),
(493, '2023-04-05', '40637', 'ANDREW ABELLA', 'KARPINTERO/MALOONG CR', 'Karpentero', '6500'),
(494, '2023-04-08', '40638', 'DANNY BARANDINO', 'EMPLOYEE/ISABELA', 'Employee', '8000'),
(495, '2023-04-08', '40241', 'JOSEPH INOVEJAS', 'FIELD DEPARTMENT', 'Maloong Contractual', '1000'),
(496, '2023-04-08', '40241', 'RAMON IBANEZ', 'FIELD DEPARTMENT', 'Maloong Contractual', '1000'),
(497, '2023-04-08', '40241', 'RODEL AROY', 'FIELD PORDIA', 'Maloong Contractual', '1000'),
(498, '2023-04-08', '40241', 'ARNEL PADILLA', 'FIELD DEPARTMENT', 'Maloong Contractual', '1000'),
(499, '2023-04-08', '40240', 'USMAN SABATAL', 'FURNACE MALOONG', 'Maloong Contractual', '1500'),
(500, '2023-04-08', '40240', 'EUSEBIO CABAQUIT', 'FURNACE', 'Maloong Contractual', '1500'),
(501, '2023-04-08', '40239', 'ALBERT MALAGUIT', 'SECURITY', 'Maloong Contractual', '2000'),
(502, '2023-04-08', '40239', 'ANDONG GUILBERT', 'SECURITY', 'Maloong Contractual', '2000'),
(503, '2023-04-08', '40239', 'LARIOSA JOSEPH', 'SECURITY', 'Maloong Contractual', '2000'),
(504, '2023-04-08', '40243', 'DONDON GROUP', 'MILLER', 'Maloong Contractual', '2000'),
(505, '2023-04-08', '91781', 'CAPT TATA ALFARO', 'MILLING', 'Customer', '20000'),
(506, '2023-04-08', '91779', 'LONG SAN JUAN', 'Sayugan Buying Station', 'Customer', '220000'),
(507, '2023-04-08', '91780', 'NENETH COSTAN', 'Nenet Buying Station', 'Customer', '50000'),
(508, '2023-04-14', '40674', 'ANDREW ABELLA', 'KARPENTERO MALOONG', 'Karpentero', '5000'),
(509, '2023-04-14', '91800', 'NENETH COSTAN', 'Nenet Buying Station', 'Customer', '50000'),
(510, '2023-04-14', '91797', 'LONG SAN JUAN', 'Sayugan Buying Station', 'Customer', '200000'),
(511, '2023-04-10', '91785', 'neneth costan', 'Nenet Buying Station', 'Customer', '150000'),
(512, '2023-04-10', '91784', 'jimroy macclintok', 'jimroy buying', 'Customer', '100000'),
(513, '2023-04-10', '91783', 'long san juan', 'Sayugan Buying Station', 'Customer', '150000'),
(514, '2023-04-10', '91782', 'mudzkhier abdurahman', 'mudz buying', 'Customer', '100000'),
(515, '2023-04-11', '40665', 'maymona baldon', 'other', 'Customer', '195'),
(516, '2023-04-11', '91787', 'long san juan', 'Sayugan Buying Station', 'Customer', '150000'),
(517, '2023-04-11', '91788', 'long san juan', 'Sayugan Buying Station', 'Customer', '100000'),
(518, '2023-04-13', '40673', 'bong bong- pintor', 'sayugan office', 'Karpentero', '1000'),
(519, '2023-04-13', '91793', 'long san juan', 'Sayugan Buying Station', 'Customer', '100000'),
(520, '2023-04-13', '91794', 'neneth costan', 'Nenet Buying Station', 'Customer', '50000'),
(521, '2023-04-15', '40718', 'jimson samsona ', 'lacafe', 'Employee', '1000'),
(522, '2023-04-15', '40719', 'brian albutra', 'security guard', 'Employee', '5000'),
(523, '2023-04-15', '40721', 'eric manuel', 'driver', 'Employee', '4000'),
(524, '2023-04-15', '40720', 'eric manuel', 'driver', 'Employee', '5000'),
(525, '2023-04-15', '40717', 'emelito langutan', 'pordiya', 'Employee', '2000'),
(526, '2023-04-15', '40714', 'nalam ernesto', 'pordiya', 'Employee', '2000'),
(527, '2023-04-15', '40103', 'jerome alcorea', 'maloong proc.', 'Topper', '500'),
(528, '2023-04-15', '40105', 'renato', 'maloong proc', 'Topper', '1000'),
(529, '2023-04-15', '40106', 'guilbert panidar', 'maloong proc', 'topper', '1000'),
(530, '2023-04-15', '40104', 'oscar balagolan', 'maloong proc', 'Topper', '1000'),
(531, '2023-04-15', '40265', 'edwin asilan', 'maloong proc,', 'Employee', '4000'),
(532, '2023-04-15', '40269', 'simeon malaguit', 'maloong proc.', 'Employee', '9000'),
(533, '2023-04-15', '40248', 'ramil pelegrin', 'maloong proc.', 'Employee', '4000'),
(534, '2023-04-15', '40264', 'jeanne abella', 'maloong proc.', 'Employee', '7000'),
(535, '2023-04-15', '40263', 'jerry garcia', 'maloong proc.', 'Employee', '3000'),
(536, '2023-04-15', '40262', 'edmundo cristobal', 'maloong proc.', 'Employee', '4000'),
(537, '2023-04-15', '40261', 'alvin bonifacio', 'maloong proc.', 'Employee', '4000'),
(538, '2023-04-15', '40260', 'pablo hipulan', 'maloong proc.', 'Employee', '4000'),
(539, '2023-04-15', '40259', 'dennis corpuz', 'maloong proc.', 'Employee', '8000'),
(540, '2023-04-15', '40285', 'cerilo sualog', 'maloong proc.', 'Employee', '4000'),
(541, '2023-04-15', '40257', 'dindo pentojo', 'maloong proc.', 'Employee', '3000'),
(542, '2023-04-15', '40256', 'ederito luang', 'maloong proc', 'Employee', '4000'),
(543, '2023-04-15', '40255', 'samuel ramillano', 'maloong proc.', 'Employee', '5000'),
(544, '2023-04-15', '40254', 'gregorio matulac', 'maloong proc', 'Employee', '6000'),
(545, '2023-04-15', '40253', 'rafraf abarquez', 'maloong proc', 'Employee', '4000'),
(546, '2023-04-15', '40267', 'hereberto galano', 'maloong proc', 'Employee', '10000'),
(547, '2023-04-15', '40266', 'ronnie vildad', 'maloong proc.', 'Employee', '10000'),
(548, '2023-04-15', '40251', 'melvin ferrer', 'maloong proc.', 'Employee', '4500'),
(549, '2023-04-15', '40268', 'jovylyn samijon', 'maloong proc.', 'Employee', '5000'),
(550, '2023-04-15', '40252', 'albert cornella', 'maloong proc.', 'Employee', '3000'),
(551, '2023-04-15', '40694', 'jerry bapora', 'security guard', 'Employee', '4200');
INSERT INTO `ledger_cashadvance` (`id`, `date`, `voucher`, `customer`, `buying_station`, `category`, `amount`) VALUES
(552, '2023-04-15', '93597', 'neneth costan', 'Nenet Buying Station', 'Customer', '150000'),
(553, '2023-04-15', '40702', 'editha del rosario', 'zambo', 'Employee', '1500'),
(554, '2023-04-15', '40704', 'dayanara mae remigio', 'en staff', 'Employee', '5000'),
(555, '2023-04-15', '40703', 'raquel bais', 'en staff', 'Employee', '10000'),
(556, '2023-04-15', '40701', 'jane quinol', 'en staff', 'Employee', '5000'),
(557, '2023-04-15', '40705', 'joseph benosa', 'en staff', 'Employee', '3200'),
(558, '2023-04-15', '40706', 'berto enriquez', 'en truckscale', 'Employee', '4500'),
(559, '2023-04-15', '40711', 'mercy falconit', 'houde helper', 'Employee', '2000'),
(560, '2023-04-15', '40710', 'felipe borda', 'la cafe', 'Employee', '2000'),
(561, '2023-04-15', '40709', 'jung adaya', 'pordiya', 'Employee', '3000'),
(562, '2023-04-15', '40708', 'tata torres', 'lacafe', 'Employee', '5000'),
(563, '2023-04-17', '40107', 'jason castillo', 'maloong', 'Maloong Contractual', '3000'),
(564, '2023-04-17', '0102', 'long san juan', 'Sayugan Buying Station', 'Customer', '230000'),
(565, '2023-04-18', '40728', 'jeanne abella', 'maloong ', 'Employee', '10000'),
(566, '2023-04-18', '0104', 'danny barandino', 'danny buying', 'Customer', '70000'),
(567, '2023-04-18', '0103', 'long san juan', 'Sayugan Buying Station', 'Customer', '700000'),
(568, '2023-04-19', '40746', 'andrew abella', 'other', 'Karpentero', '4000'),
(569, '2023-04-19', '0108', 'long san juan', 'Sayugan Buying Station', 'Customer', '120000'),
(570, '2023-04-19', '0110', 'long san juan', 'Sayugan Buying Station', 'Customer', '100000'),
(571, '2023-04-20', '0112', 'LONG SAN JUAN', 'Sayugan Buying Station', 'Customer', '400000'),
(572, '2023-04-22', '40813', 'RAFAEL RAMIREZ', 'DRIVER', 'Employee', '10000'),
(573, '2023-04-22', '40280', 'HEREBERTO GALLANO', 'MALOONG', 'Employee', '5000'),
(574, '2023-04-22', '40279', 'PABLO HIPULAN', 'MALOONG', 'Employee', '7000'),
(575, '2023-04-22', '40282', 'ANTHONY CASTIL', 'MALOONG', 'Employee', '5000'),
(576, '2023-04-22', '40811', 'BERTO ENRIQUEZ', 'TRUCKSCALE', 'Employee', '2000'),
(577, '2023-04-22', '40815', 'BRIAN ALBUTRA', 'SECURITY GUARD', 'Employee', '2000'),
(578, '2023-04-22', '40286', 'MILLER/ CRUMBLING/BOX CLEANING', 'MALOONG', 'Maloong Contractual', '39500'),
(579, '2023-04-24', '40287', 'jayson candido', 'miller', 'Maloong Contractual', '2500'),
(580, '2023-04-24', '0121', 'jimroy mcclintock @ 51', 'jimroy buying', 'Customer', '50000'),
(581, '2023-04-24', '0120', 'mudzkhier abdurahman', 'mudz buying', 'Customer', '200000'),
(582, '2023-04-24', '0122', 'ruben ramos', 'ruben buying', 'Customer', '100000'),
(583, '2023-04-25', '0126', 'LOUIE DELOS REYES', 'LOUIE BUYING', 'Customer', '80000'),
(584, '2023-04-25', '123', 'TANY SULAYMAN', 'SULAYMAN BUYING', 'Customer', '50000'),
(585, '2023-04-25', '0124', 'LONG SAN JUAN', 'Sayugan Buying Station', 'Customer', '150000'),
(586, '2023-04-26', '128', 'ASIM ONZ GAHAMAN', 'RUBBER EXPORT', 'Customer', '100000'),
(587, '2023-04-26', '127', 'JERRY ARIERO', 'JERRY BUYING', 'Customer', '80000'),
(588, '2023-04-26', '40838', 'ANDREW ABELLA', 'KAPINTERO MALOONG', 'Karpentero', '3000'),
(589, '2023-04-27', '40842', 'MAE ANGELES', 'EMPLOYEE', 'Employee', '10000'),
(590, '2023-04-27', '0129', 'LONG SAN JUAN', 'Sayugan Buying Station', 'Customer', '150000'),
(591, '2023-04-27', '40843', 'raz idjing -menzi', 'other', 'other', '10000'),
(592, '2023-04-28', '40401', 'JANE QUINOL', 'EMPLOYEE', 'Employee', '4500'),
(593, '2023-04-28', '40850', 'DAYANARA MAE REMIGIO', 'EMPLOYEE', 'Employee', '5000'),
(594, '2023-04-28', '40849', 'RAQUEL BAIS', 'EMPLOYEE', 'Employee', '9500'),
(595, '2023-04-28', '0130', 'ARCO-ALVIN GULPERE', 'ARCO BUYING', 'Customer', '150000'),
(596, '2023-04-29', '40408', 'JEFFERSON ALIPIO', 'EMPLOYEE', 'Employee', '7666'),
(597, '2023-04-29', '40109', 'JEROME ALCOREZA / EJN PERSONAL TOPPERS', 'MALOONG', 'Topper', '500'),
(598, '2023-04-29', '40108', 'OSCAR BALAGOLAN EJN PERSONAL TOPPERS', 'MALOONG', 'Topper', '1000'),
(599, '2023-04-29', '40412', 'JOSEPH BENOSA', 'EMPLOYEE', 'Employee', '3800'),
(600, '2023-04-29', '40409', 'GERRY BAPORA', 'SECURITY GUARD', 'Employee', '4200'),
(601, '2023-04-29', '40135', 'MELVIN FERRER', 'MALOONG', 'Employee', '6000'),
(602, '2023-04-29', '40429', 'ERIC MANUEL', 'DRIVER', 'Employee', '6500'),
(603, '2023-04-29', '40428', 'BERTO ENRIQUEZ', 'EMPLOYEE', 'Employee', '9000'),
(604, '2023-04-29', '40430', 'BRIAN ALBUTRA', 'SECURITY GUARD', 'Employee', '5000'),
(605, '2023-04-29', '40432', 'IRENEO TORRES', 'lacafe', 'Employee', '5000'),
(606, '2023-04-29', '40437', 'jung2 adaya', 'pordiya', 'Employee', '3000'),
(607, '2023-04-29', '40433', 'jimson samsona', 'la cafe', 'Employee', '1000'),
(608, '2023-04-29', '40435', 'nalam ernesto', 'pordiya', 'Employee', '2000'),
(609, '2023-04-29', '40436', 'langutan emelito', 'pordiya', 'Employee', '2000'),
(610, '2023-04-29', '40434', 'felipe borda', 'lacafe', 'Employee', '2000'),
(611, '2023-04-29', '40129', 'CORONELLA ALBERT', 'MALOONG', 'Employee', '3000'),
(612, '2023-04-29', '40128', 'SUALOG CERILO', 'MALOONG', 'Employee', '4000'),
(613, '2023-04-29', '40127', 'PELEGRIN RAMIL', 'MALOONG', 'Employee', '3000'),
(614, '2023-04-29', '40405', 'JAY AR QUIAMCO', 'MALOONG', 'Employee', '2000'),
(615, '2023-04-29', '40126', 'LUANG EDERITO', 'MALOONG', 'Employee', '3000'),
(616, '2023-04-29', '40125', 'CRISTOBAL EDMUNDO', 'MALOONG', 'Employee', '3000'),
(617, '2023-04-29', '40124', 'BONIFACIO ALVIN', 'MALOONG', 'Employee', '3000'),
(618, '2023-04-29', '40123', 'RAMILLANO SAMUEL', 'MALOONG', 'Employee', '4000'),
(619, '2023-04-29', '40122', 'ABELLA JEANNE', 'MALOONG', 'Employee', '6000'),
(620, '2023-04-29', '40121', 'PELEGRIN DAILE', 'EMPLOYEE', 'Employee', '5000'),
(621, '2023-04-29', '40120', 'GARCIA JERRY', 'MALOONG', 'Employee', '3000'),
(622, '2023-04-29', '40119', 'RHAP2 ABARQUEZ', 'MALOONG DRIVER', 'Employee', '3000'),
(623, '2023-04-29', '40118', 'PENTOJO DINDO', 'MALOONG', 'Employee', '4000'),
(624, '2023-04-29', '40117', 'HIPULAN PABLO', 'MALOONG', 'Employee', '4000'),
(625, '2023-04-29', '40116', 'CORPUZ DENNIS', 'MALOONG', 'Employee', '3000'),
(626, '2023-04-29', '40115', 'MALAGUIT JONATHAN', 'MALOONG', 'Employee', '9000'),
(627, '2023-04-29', '40114', 'ASILAN EDWIN', 'MALOONG', 'Employee', '3800'),
(628, '2023-04-29', '40113', 'MATULAC GREGORIO', 'MALOONG', 'Employee', '3500'),
(629, '2023-04-29', '40112', 'VILDAD RONNIE', 'MALOONG', 'Employee', '3000'),
(630, '2023-04-29', '40111', 'GALANO HEREBERTO', 'MALOONG', 'Employee', '10000'),
(631, '2023-04-29', '40130', 'SAMIJON JOVY', 'MALOONG', 'Employee', '3500'),
(632, '2023-05-01', '40439', 'LONG SAN JUAN', 'Sayugan Buying Station', 'Customer', '150000'),
(633, '2023-05-01', '40438', 'ANDREW ABELLA', 'JAYSON HOUCE', 'Karpentero', '1000'),
(634, '2023-05-01', '0135', 'NENETH COSTAN LOT4& 5', '', 'Customer', '250000'),
(635, '2023-05-01', '0136', 'LONG SAN JUAN', 'Sayugan Buying Station', 'Customer', '100000'),
(636, '2023-05-02', '40450', 'buahan toppers', 'toppers', 'Topper', '4000'),
(637, '2023-05-02', '0139', 'lee brown', 'wet rubber', 'Customer', '200000'),
(638, '2023-05-02', '137', 'jimroy mcclintock', 'milling', 'Customer', '50000'),
(639, '2023-05-02', '138', 'long san juan lot 18/19', 'Sayugan Buying Station', 'Customer', '318523'),
(640, '2023-05-03', '40907', 'lalang langutan', 'pordiya', 'Employee', '500'),
(641, '2023-05-03', '143', 'long san juan', 'Sayugan Buying Station', 'Customer', '135000');

-- --------------------------------------------------------

--
-- Table structure for table `ledger_expenses`
--

CREATE TABLE `ledger_expenses` (
  `id` int(11) NOT NULL,
  `voucher_no` varchar(100) NOT NULL,
  `particulars` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `type_expense` varchar(255) DEFAULT NULL,
  `amount` varchar(100) NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `destination` varchar(100) DEFAULT NULL,
  `mode_transact` varchar(255) DEFAULT NULL,
  `date_payment` date DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ledger_expenses`
--

INSERT INTO `ledger_expenses` (`id`, `voucher_no`, `particulars`, `date`, `category`, `type_expense`, `amount`, `description`, `remarks`, `destination`, `mode_transact`, `date_payment`, `location`) VALUES
(1, '1234', '', '2023-05-10', 'Philhealth', '', '2333', NULL, 'TEST', NULL, '', NULL, 'Basilan');

-- --------------------------------------------------------

--
-- Table structure for table `ledger_maloong`
--

CREATE TABLE `ledger_maloong` (
  `id` int(11) NOT NULL,
  `date` varchar(50) NOT NULL,
  `voucher` varchar(50) NOT NULL,
  `net_kilos` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `ejn_price` varchar(100) NOT NULL,
  `ejn_total` varchar(100) NOT NULL,
  `topper_price` varchar(100) NOT NULL,
  `topper_gross` varchar(100) NOT NULL,
  `less_category` varchar(100) NOT NULL,
  `less` varchar(100) NOT NULL,
  `topper_total` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ledger_maloong`
--

INSERT INTO `ledger_maloong` (`id`, `date`, `voucher`, `net_kilos`, `name`, `ejn_price`, `ejn_total`, `topper_price`, `topper_gross`, `less_category`, `less`, `topper_total`) VALUES
(5, '2023-01-16', '2936', '208', 'jerome', '', '0', '10', '2080', 'SSS', '200', '1880'),
(6, '2023-01-16', '2937', '245', 'MAYETO', '10', '2450', '10', '2450', 'SSS', '300', '2150'),
(7, '2023-01-16', '2939', '207', 'MANOLIT', '10', '2070', '10', '2070', 'Cash Advance', '2000', '70'),
(8, '2023-01-16', '2938', '251', 'OSCAR', '10', '2510', '10', '2510', 'SSS', '300', '2210'),
(9, '2023-01-16', '2934', '363', 'RENATO', '10', '3630', '10', '3630', '', '', '3630'),
(10, '2023-01-16', '2935', '92', 'GUILBERT', '10', '920', '10', '920', '', '', '920'),
(11, '2023-01-20', '34865', '1366', 'JBN SHARE', '10', '13660', '10', '13660', '', '', '13660'),
(12, '2023-01-31', '2949', '206', 'MANOLIT MORALLAS', '10', '2060', '10', '2060', 'Cash Advance', '2000', '60'),
(13, '2023-01-31', '2950', '248', 'OSCAR', '10', '2480', '10', '2480', 'Cash Advance', '1000', '1480'),
(14, '2023-01-31', '2948', '164', 'MAYETO', '10', '1640', '10', '1640', '', '', '1640'),
(15, '2023-01-31', '2947', '160', 'JEROME', '10', '1600', '10', '1600', '', '', '1600'),
(16, '2023-01-31', '2945', '313', 'RENATO', '10', '3130', '10', '3130', 'Cash Advance', '2500', '630'),
(17, '2023-01-31', '2946', '151', 'GUILBERT', '10', '1510', '10', '1510', '', '1000', '510'),
(18, '2023-02-15', '2857', '227', 'mayeto', '10', '2270', '10', '2270', 'SSS', '300', '1970'),
(19, '2023-02-15', '2858', '287', 'renato', '10', '2870', '10', '2870', 'Cash Advance', '2000', '870'),
(20, '2023-02-15', '2860', '220', 'jerome', '10', '2200', '10', '2200', 'SSS', '200', '2000'),
(21, '2023-02-15', '2861', '144', 'oscar', '10', '1440', '10', '1440', 'Cash Advance', '1300', '140'),
(22, '2023-02-15', '2859', '158', 'guilbert', '10', '1580', '10', '1580', 'Cash Advance', '1000', '580'),
(23, '2023-02-22', '35667', '1036', 'jbn share maloong nursery wet', '10', '10360', '', '0', '', '', '0'),
(24, '2023-02-28', '2868', '141', 'oscar', '10', '1410', '10', '1410', 'Cash Advance', '1000', '410'),
(25, '2023-02-28', '2870', '100', 'jerome', '10', '1000', '10', '1000', '', '', '1000'),
(26, '2023-02-28', '2867', '120', 'gilbert', '10', '1200', '10', '1200', 'Cash Advance', '1000', '200'),
(27, '2023-02-28', '2869', '289', 'renato', '10', '2890', '10', '2890', 'Cash Advance', '2000', '890'),
(28, '2023-03-01', '35671', '650', 'jbn share wet maloong ', '10', '6500', '10', '6500', '', '', '6500'),
(29, '2023-03-15', '2872', '76', 'guilbert', '10', '760', '10', '760', '', '', '760'),
(30, '2023-03-15', '2874', '152', 'oscar', '10', '1520', '10', '1520', 'Cash Advance sss', '1300', '220'),
(31, '2023-03-15', '2873', '168', 'jerome', '10', '1680', '10', '1680', 'SSS', '200', '1480'),
(32, '2023-03-15', '2875', '262', 'mayeto', '10', '2620', '10', '2620', 'SSS', '300', '2320'),
(33, '2023-03-15', '2871', '341', 'renato', '10', '3410', '10', '3410', 'Cash Advance', '2000', '1410'),
(34, '2023-03-31', '2884', '165', 'mayeto', '', '0', '10', '1650', '', '', '1650'),
(35, '2023-03-31', '2881', '112', 'guilbert', '', '0', '10', '1120', 'Cash Advance', '1000', '120'),
(36, '2023-03-31', '2882', '165', 'jerome', '', '0', '10', '1650', '', '', '1650'),
(37, '2023-03-31', '2883', '134', 'oscar', '', '0', '10', '1340', 'Cash Advance', '1000', '340'),
(38, '2023-03-31', '40572', '999', 'jbn share maloong 3/15/2023', '10', '9990', '', '0', '', '', '0'),
(39, '2023-03-31', '40572', '576', 'jbn share maloong 3/31/2023', '10', '5760', '', '0', '', '', '0'),
(40, '2023-04-15', '40700', '731', 'jbn share maloong toppers', '10', '7310', '', '0', '', '', '0'),
(41, '2023-04-15', '2888', '149', 'oscar ', '', '0', '10', '1490', 'Cash Advance/sss', '1300', '190'),
(42, '2023-04-15', '2889', '114', 'mayeto', '', '0', '10', '1140', 'SSS', '280', '860'),
(43, '2023-04-15', '2887', '174', 'jerome', '', '0', '10', '1740', 'Cash Advance/sss', '680', '1060'),
(44, '2023-04-15', '2885', '124', 'guilbert', '', '0', '10', '1240', 'Cash Advance', '1000', '240'),
(45, '2023-04-15', '2886', '170', 'renato', '', '0', '10', '1700', '', '', '1700'),
(46, '2023-04-29', '2891', '149', 'oscar b.', '', '0', '10', '1490', 'Cash Advance', '1000', '490'),
(47, '2023-04-29', '2890', '91', 'guilbert p.', '', '0', '10', '910', '', '', '910'),
(48, '2023-04-29', '2892', '79', 'mayeto m', '', '0', '10', '790', '', '', '790'),
(49, '2023-04-29', '2893', '154', 'jerome a.', '', '0', '10', '1540', 'Cash Advance', '500', '1040');

-- --------------------------------------------------------

--
-- Table structure for table `ledger_purchase`
--

CREATE TABLE `ledger_purchase` (
  `id` int(11) NOT NULL,
  `date` varchar(50) NOT NULL,
  `voucher` varchar(50) NOT NULL,
  `customer_name` varchar(50) DEFAULT NULL,
  `net_kilos` varchar(50) DEFAULT NULL,
  `price` varchar(50) DEFAULT NULL,
  `adjustment_price` varchar(50) DEFAULT NULL,
  `less` varchar(50) DEFAULT NULL,
  `partial_payment` varchar(50) DEFAULT NULL,
  `net_total` varchar(50) DEFAULT NULL,
  `total_amount` varchar(50) NOT NULL,
  `category` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ledger_purchase`
--

INSERT INTO `ledger_purchase` (`id`, `date`, `voucher`, `customer_name`, `net_kilos`, `price`, `adjustment_price`, `less`, `partial_payment`, `net_total`, `total_amount`, `category`) VALUES
(23, '2023-01-02', '\'00180', 'ismael', '360', '19', '', '', '', '', '6840', 'COPRA'),
(24, '2023-01-03', '91553', 'AMIN ABUBAKAR', '3219', '31', '', '', '', '', '99789', 'COPRA'),
(25, '2023-01-02', '35122', 'MALOONG PLANTATION JR CATALLA', '32852', '28', '', '', '500000', '0', '419856', 'WET RUBBER'),
(26, '2023-01-04', '91560', 'CHARLY CAWLEY', '1111', '44', '', '', '', '0', '48884', 'BALES'),
(28, '2023-01-04', '91559', 'ABDUL', '610', '29', '', '', '', '0', '17690', 'COPRA'),
(29, '2023-01-04', '91558', 'KOTOH', '3679', '29.5', '', '', '', '0', '108530.5', 'COPRA'),
(30, '2023-01-04', '91557', 'JULMA', '3868', '29.50', '', '', '', '0', '114106', 'COPRA'),
(31, '2023-01-03', '35124', 'TUWA', '7980', '47', '', '180029', '', '0', '195031', 'BALES'),
(32, '2023-01-05', '91566', 'NORUDDIN', '3388', '29', '', '', '', '0', '98252', 'COPRA'),
(33, '2023-01-05', '153105', 'TOTONG', '119', '21', '', '', '', '0', '2499', 'WET RUBBER'),
(34, '2023-01-05', '91561', 'JULMA', '3244', '29.50', '', '', '', '0', '95698', 'COPRA'),
(35, '2023-01-05', '91562', 'ABDUL', '2153', '29.50', '', '', '', '0', '63513.5', 'COPRA'),
(36, '2023-01-05', ' \'0183', 'alih', '165', '19', '', '', '', '0', '3135', 'COPRA'),
(37, '2023-01-05', '91565', 'louie delos reyes', '3698', '46', '', '102390', '', '0', '67718', 'BALES'),
(38, '2023-01-04', '91560', 'charly cawley', '4489', '46', '', '', '', '0', '206494', 'BALES'),
(40, '2023-01-02', '35123', 'NENET', '', '', '', '', '', '', '6014', 'BALES'),
(41, '2023-01-03', '00183', 'jong', '102', '19', '', '', '', '0', '1938', 'COPRA'),
(43, '2023-01-06', '35126', 'JUN mCcLINTOCK', '5240', '46', '', '241332', '', '0', '-292', 'BALES'),
(44, '2023-01-06', '91569', 'JIMROY mCcLINTOCK', '3564', '46', '', '100000', '', '0', '63944', 'BALES'),
(46, '2023-01-06', '91567', 'hari sabtal', '10587', '50', '', '517320', '', '0', '12030', 'BALES'),
(47, '2023-01-07', '91573', 'NONONG FURIGAY', '4515', '30', '', '', '', '0', '135450', 'WET RUBBER'),
(48, '2023-01-07', '91570', 'AMIN ABUBAKAR', '3899', '31', '', '', '', '0', '120869', 'COPRA'),
(49, '2023-01-07', '00194', 'LIGIT', '75', '18', '', '', '', '0', '1350', 'COPRA'),
(50, '2023-01-07', '91575', 'SANDRA DUMDUM', '5435', '25', '', '', '', '0', '135875', 'WET RUBBER'),
(51, '2023-01-09', '91580', 'EPIGIL MOLEJE', '1684', '46', '', '50000', '', '0', '27464', 'BALES'),
(52, '2023-01-09', '153106', 'TOY', '100', '21', '', '', '', '0', '2100', 'WET RUBBER'),
(53, '2023-01-09', '91576', 'salwa', '266', '27', '', '', '', '0', '7182', 'COPRA'),
(54, '2023-01-09', '91577', 'julman', '1603', '29.50', '', '', '', '0', '47288.5', 'COPRA'),
(55, '2023-01-09', '91579', 'amin', '3098', '31', '', '', '', '0', '96038', 'COPRA'),
(56, '2023-01-09', '153106', 'toy', '100', '21', '', '', '', '0', '2100', 'WET RUBBER'),
(57, '2023-01-09', '91580', 'MOLEJE', '1684', '46', '', '50000', '', '0', '27464', 'BALES'),
(58, '2023-01-09', '195', 'ADELAYDA', '76', '20', '', '', '', '0', '1520', 'COPRA'),
(59, '2023-01-09', '91581', 'ADAM', '508', '29', '', '', '', '0', '14732', 'COPRA'),
(60, '2023-01-09', '39600', 'RONIE VILDAD', '3088', '23', '', '', '', '0', '71024', 'WET RUBBER'),
(61, '2023-01-10', '91585', 'tuna', '1444', '29.50', '', '', '', '0', '42598', 'COPRA'),
(62, '2023-01-10', '91584', 'amin', '2420', '31', '', '', '', '0', '75020', 'COPRA'),
(63, '2023-01-10', '91587', 'rodel', '1180', '19', '', '', '', '0', '22420', 'COPRA'),
(64, '2023-01-10', '91582', 'louie delos reyes', '4104', '46', '', '102460', '', '0', '86324', 'BALES'),
(66, '2023-01-10', '91586', 'tany sulayman', '12286', '50', '', '600730', '', '0', '13570', 'BALES'),
(67, '2023-01-12', '35277', 'tany sulayman', '', '', '', '', '', '', '149109.63', 'WET RUBBER'),
(68, '2023-01-12', '91589', 'amin abubakar', '920', '22.50', '', '', '', '0', '20700', 'WET RUBBER'),
(69, '2023-01-13', '91603', 'TON2X', '370', '20', '', '', '', '0', '7400', 'COPRA'),
(70, '2023-01-13', '91602', 'KABAYAN', '160', '19', '', '', '', '0', '3040', 'COPRA'),
(71, '2023-01-13', '91602', 'KABAYAN', '409', '19', '', '', '', '0', '7771', 'COPRA'),
(72, '2023-01-13', '91601', 'MORADOS', '789', '20', '', '5000', '', '0', '10780', 'COPRA'),
(73, '2023-01-14', '91596', 'Jimroy McLINTOCK', '3491', '44', '', '130000', '', '0', '23604', 'BALES'),
(74, '2023-01-14', '35136', 'MANCOM ERVIN SHARE', '2039', '21', '', '17128', '', '0', '25691', 'WET RUBBER'),
(75, '2023-01-14', '35136', 'MANCOM JBN SHARE', '2039', '21', '', '25691', '', '0', '17128', 'WET RUBBER'),
(76, '2023-01-14', '91605', 'ADAM', '1872', '29', '', '', '', '0', '54288', 'COPRA'),
(77, '2023-01-14', '91604', 'AMIN', '1679', '31', '', '', '', '0', '52049', 'COPRA'),
(78, '2023-01-14', '91592', 'CHARLY CAWLEY', '4270', '48', '', '130000', '', '0', '74960', 'BALES'),
(79, '2023-01-16', '91598', 'TANY SULAYMAN', '', '', '', '', '', '', '54810', 'BALES'),
(80, '2023-01-16', '153110', 'morados', '357', '22', '', '', '', '0', '7854', 'WET RUBBER'),
(81, '2023-01-16', '35144', 'nenet', '', '', '', '', '', '', '74154', 'BALES'),
(82, '2023-01-16', '91608', 'amin abubakar', '3219', '31', '', '', '', '0', '99789', 'COPRA'),
(83, '2023-01-16', '91608', 'amin abubakar', '3219', '31', '', '', '', '0', '99789', 'COPRA'),
(84, '2023-01-16', '91607', 'J.R', '285', '19', '', '', '', '0', '5415', 'COPRA'),
(85, '2023-01-16', '91606', 'JULMAN', '3011', '27', '', '', '', '0', '81297', 'COPRA'),
(86, '2023-01-16', '153107', 'PAMARAN', '1121', '24', '', '10000', '', '0', '16904', 'COPRA'),
(87, '2023-01-16', '153108', 'PAMARAN', '578', '24', '', '', '', '0', '13872', 'WET RUBBER'),
(88, '2023-01-16', '153109', 'PAMARAN', '214', '24', '', '', '', '0', '5136', 'WET RUBBER'),
(90, '2023-01-17', '91610', 'sarip', '1527', '27', '', '', '', '0', '41229', 'COPRA'),
(91, '2023-01-17', '35320', 'MARTIN MUSLIMIN', '', '', '', '', '', '', '39935..25', 'BALES'),
(92, '2023-01-18', '153111', 'sopiya', '2', '90', '', '', '', '0', '180', 'COFFEE BEANS'),
(93, '2023-01-18', '91600', 'charly cawley', '5390', '48', '', '', '', '0', '258720', 'BALES'),
(94, '2023-01-18', '91612', 'julman', '2582', '27', '', '', '', '0', '69714', 'COPRA'),
(95, '2023-01-18', '91611', 'ton2x', '460', '20', '', '', '', '0', '9200', 'COPRA'),
(96, '2023-01-17', '0005', 'RASMA', '215', '18', '', '', '', '0', '3870', 'COPRA'),
(97, '2023-01-17', '91597', 'MOLEJE', '3618', '46', '', '120000', '', '0', '46428', 'BALES'),
(98, '2023-01-17', '35321', 'TANNY SULAYMAN', '', '', '', '', '', '', '79018', 'BALES'),
(99, '2023-01-17', '91609', 'KABAYAN', '57', '19', '', '', '', '0', '1083', 'COPRA'),
(100, '2023-01-17', '35319', 'AMMAN AWALIN', '', '', '', '', '', '', '11767', 'BALES'),
(101, '2023-01-17', '0006', 'APAH', '50', '18', '', '', '', '0', '900', 'COPRA'),
(102, '2023-01-19', '91623', 'RUBEN RAMOS', '3747', '44', '', '130000', '', '0', '34868', 'BALES'),
(103, '2023-01-19', '91618', 'MATURAN', '612', '27', '', '', '', '0', '16524', 'COPRA'),
(104, '2023-01-19', '91616', 'NONONG FURIGAY', '4315', '30', '', '', '', '0', '129450', 'WET RUBBER'),
(105, '2023-01-12', '91621', 'HARIE', '569', '27', '', '', '', '0', '15363', 'COPRA'),
(106, '2023-01-19', '91617', 'AMDARI', '3018', '27', '', '', '', '0', '81486', 'COPRA'),
(107, '2023-01-19', '91615', 'ADAM', '1592', '27', '', '', '', '0', '42984', 'COPRA'),
(108, '2023-01-19', '91619', 'ALDASER', '889', '27', '', '', '', '0', '24003', 'COPRA'),
(109, '2023-01-19', '91614', 'AMIN', '2522', '31', '', '25000', '', '0', '53182', 'COPRA'),
(110, '2023-01-19', '91622', 'AMIN', '1852', '31', '', '', '', '0', '57412', 'COPRA'),
(111, '2023-01-20', '91625', 'TUNA', '1095', '29.50', '', '', '', '0', '32302.5', 'COPRA'),
(112, '2023-01-21', '91632', 'jimroy McClintock', '4031', '44', '', '100000', '', '0', '77364', 'BALES'),
(113, '2023-01-21', '0005', 'cash', '155', '18', '', '', '', '0', '2790', 'COPRA'),
(114, '2023-01-21', '91629', 'harie', '371', '27', '', '', '', '0', '10017', 'COPRA'),
(115, '2023-01-21', '91628', 'julman', '2043', '27', '', '', '', '0', '55161', 'COPRA'),
(116, '2023-01-21', '91633', 'FRANCINE', '544', '22', '', '', '', '0', '11968', 'WET RUBBER'),
(117, '2023-01-21', '35551', 'DONGA TENANT SHARE', '3753', '22', '', '38783', '', '0', '43783', 'WET RUBBER'),
(118, '2023-01-21', '229', 'tutuh', '85', '18', '', '', '', '0', '1530', 'COPRA'),
(119, '2023-01-23', '91635', 'amin', '3450', '31', '', '25000', '', '0', '81950', 'COPRA'),
(120, '2023-01-23', '235', 'kabayan', '86', '18', '', '', '', '0', '1548', 'COPRA'),
(121, '2023-01-23', '91636', 'ton2x', '525', '19', '', '', '', '0', '9975', 'COPRA'),
(122, '2023-01-23', '237', 'ibrahim', '300', '19', '', '', '', '0', '5700', 'COPRA'),
(123, '2023-01-23', '91637', 'arsenio', '480', '19', '', '', '', '0', '9120', 'COPRA'),
(124, '2023-01-23', '233', 'arsenio', '1133', '27', '', '', '', '0', '30591', 'COPRA'),
(125, '2023-01-23', '35605', 'tany sulayman', '', '', '', '', '', '', '135408', 'BALES'),
(126, '2023-01-23', '91640', 'cawley', '1255', '27', '', '', '', '0', '33885', 'COPRA'),
(127, '2023-01-24', '91638', 'LOUIE DELOS REYES', '2916', '46', '', '101778', '', '0', '32358', 'BALES'),
(128, '2023-01-24', '35614', 'HARIE SABTAL', '', '', '', '', '', '', '18020', 'BALES'),
(129, '2023-01-24', '35612', 'TANY SULAYMAN', '', '', '', '', '', '', '47170', 'BALES'),
(130, '2023-01-24', '91647', 'epigil moleje', '5860', '46', '', '100000', '', '0', '169560', 'BALES'),
(131, '2023-01-24', '91646', 'adam', '3094', '27', '', '50000', '', '0', '33538', 'COPRA'),
(132, '2023-01-24', '91644', 'amin abubakar', '1070', '22.50', '', '', '', '0', '24075', 'WET RUBBER'),
(134, '2023-01-24', '91642', 'ibrahim', '855', '19', '', '', '', '0', '16245', 'COPRA'),
(135, '2023-01-24', '35611', 'amman awalin', '', '', '', '', '', '', '16592', 'BALES'),
(136, '2023-01-25', '91660', 'ADAM', '623', '27', '', '', '', '0', '16821', 'COPRA'),
(137, '2023-01-25', '91658', 'JULMAN', '3169', '27', '', '', '', '0', '85563', 'COPRA'),
(138, '2023-01-25', '91659', 'CHARLY CAWLEY', '5810', '48', '', '', '', '0', '278880', 'BALES'),
(139, '2023-01-25', '35654', 'AMMAN AWALIN', '', '', '', '', '', '', '150942', 'BALES'),
(140, '2023-01-25', '35620', 'MARTIN MUSLIMIN', '', '', '', '', '', '', '97613', 'BALES'),
(141, '2023-01-25', '91649', 'IBRAHIM', '1064', '27', '', '', '', '0', '28728', 'COPRA'),
(142, '2023-01-26', '91650', 'SULAYMAN TANI', '9936', '30.30', '', '203011', '', '0', '98049.79999999999', 'COPRA'),
(143, '2023-01-26', '91806', 'ibrahim', '770', '18', '', '', '', '0', '13860', 'COPRA'),
(144, '2023-01-26', '91807', 'ibrahim', '865', '18', '', '', '', '0', '15570', 'COPRA'),
(145, '2023-01-27', '91811', 'JULMAN', '1532', '26', '', '', '', '0', '39832', 'COPRA'),
(146, '2023-01-27', '91808', 'LITO PURI', '3366', '48', '', '', '', '0', '161568', 'BALES'),
(147, '2023-01-27', '260', 'IBRAHIM', '1575', '18', '', '', '', '0', '28350', 'COPRA'),
(148, '2023-01-27', '153115', 'aloy', '477', '22', '', '', '', '0', '10494', 'WET RUBBER'),
(149, '2023-01-27', '153114', 'hassan', '157', '22', '', '', '', '0', '3454', 'WET RUBBER'),
(150, '2023-01-27', '153113', 'hamid', '118', '22', '', '', '', '0', '2596', 'WET RUBBER'),
(151, '2023-01-27', '153112', 'totong', '460', '22', '', '', '', '0', '10120', 'WET RUBBER'),
(152, '2023-01-27', '91810', 'mila quidilia', '2529', '25', '', '15000', '', '0', '48225', 'COPRA'),
(154, '2023-01-27', '35630', 'sulayman tani', '13633', '30.30', '', '213079.9', '', '0', '200000.00000000003', 'COPRA'),
(155, '2023-01-27', '257', 'sopyan', '76', '17', '', '', '', '0', '1292', 'COPRA'),
(156, '2023-01-27', '35631', 'abella', '80', '17', '', '', '', '0', '1360', 'COPRA'),
(157, '2023-01-28', '35634', 'ISMAEL', '280', '16', '', '', '', '0', '4480', 'COPRA'),
(158, '2023-01-28', '35633', 'IBRAHIM', '610', '16', '', '', '', '0', '9760', 'COPRA'),
(160, '2023-01-30', '272', 'roger', '45', '18', '', '', '', '0', '810', 'COPRA'),
(161, '2023-01-30', '91816', 'AMIN', '9090', '31', '', '50000', '', '0', '231790', 'COPRA'),
(162, '2023-01-30', '262', 'CASH', '59', '17', '', '', '', '0', '1003', 'COPRA'),
(163, '2023-01-30', '91651', 'SULAYMAN TANY', '13633', '30.30', '', '254131', '', '0', '158948.90000000002', 'COPRA'),
(164, '2023-01-30', '91815', 'AREVALO', '2551', '26', '', '', '', '0', '66326', 'WET RUBBER'),
(165, '2023-01-30', '91814', 'RONIE VILDAD', '', '', '', '', '', '', '12696', 'BALES'),
(166, '2023-01-30', '91817', 'ADAM', '3190', '27.50', '', '', '', '0', '87725', 'COPRA'),
(167, '2023-01-30', '91819', 'IBRAHIM', '1408', '27', '', '', '', '0', '38016', 'COPRA'),
(168, '2023-01-30', '91820', 'TON2X', '427', '18', '', '', '', '0', '7686', 'COPRA'),
(169, '2023-01-31', '91824', 'JImroy McClintock', '3228', '45', '', '100000', '', '0', '45260', 'BALES'),
(170, '2023-01-31', '153127', 'manis', '195', '23', '', '', '', '0', '4485', 'WET RUBBER'),
(171, '2023-01-31', '91823', 'CAWLEY', '1307', '27', '', '', '', '0', '35289', 'COPRA'),
(172, '2023-01-31', '35566', 'MANCOM ERVIN MAGNAYE TOPPERS SHARE', '1756', '21', '', '14751', '', '0', '22125', 'WET RUBBER'),
(173, '2023-01-31', '35566', 'MANCOM EJN SHARE', '1756', '21', '', '22125', '', '0', '14751', 'WET RUBBER'),
(174, '2023-01-31', '153123', 'MENDIJA', '147', '21', '', '', '', '0', '3087', 'WET RUBBER'),
(175, '2023-01-31', '91822', 'IBRAHIM', '592', '27', '', '', '', '0', '15984', 'COPRA'),
(176, '2023-01-31', '153124', 'PAMARAN', '1076', '25', '', '10000', '', '0', '16900', 'WET RUBBER'),
(177, '2023-01-31', '153125', 'PAMARAN', '644', '25', '', '', '', '0', '16100', 'WET RUBBER'),
(178, '2023-01-31', '153126', 'PAMARAN', '236', '25', '', '', '', '0', '5900', 'WET RUBBER'),
(179, '2023-01-31', '153122', 'RENS', '1058', '23', '', '', '', '0', '24334', 'WET RUBBER'),
(180, '2023-02-01', '35718', 'zaldy', '165', '18', '', '', '', '0', '2970', 'COPRA'),
(181, '2023-02-01', '35717', 'musam', '210', '18', '', '', '', '0', '3780', 'COPRA'),
(182, '2023-02-01', '91826', 'lee vbrown', '11372', '24', '', '200000', '', '0', '72928', 'BALES'),
(183, '2023-02-01', '91828', 'charly cawley', '5180', '48', '', '', '', '0', '248640', 'BALES'),
(184, '2023-02-01', '91829', 'nonong furigay', '3850', '31', '', '', '', '0', '119350', 'WET RUBBER'),
(185, '2023-02-01', '153128', 'HAIRE', '105', '22', '', '', '', '0', '2310', 'WET RUBBER'),
(186, '2023-02-02', '91832', 'amin', '5987', '28', '', '50000', '', '0', '117636', 'COPRA'),
(187, '2023-02-02', '00045', 'joel amahan', '2225', '24', '', '', '', '0', '53400', 'WET RUBBER'),
(188, '2023-02-02', '153139', 'lito', '76', '24', '', '', '', '0', '1824', 'WET RUBBER'),
(189, '2023-02-02', '153140', 'ibik', '184', '24', '', '', '', '0', '4416', 'COPRA'),
(190, '2023-02-02', '153141', 'baltazar', '382', '24', '', '', '', '0', '9168', 'WET RUBBER'),
(191, '2023-02-02', '153138', 'mANDO', '121', '24', '', '', '', '0', '2904', 'WET RUBBER'),
(192, '2023-02-03', '91836', 'AMIN ABUBAKAR', '1125', '23', '', '', '', '0', '25875', 'WET RUBBER'),
(193, '2023-02-03', '91835', 'KOTOH LASARUL', '2114', '27', '', '10000', '', '0', '47078', 'COPRA'),
(194, '2023-02-03', '35731', 'HARI SABTAL', '', '', '', '', '', '', '297388', 'WET RUBBER'),
(195, '2023-02-03', '35730', 'AMMAN AWALIN', '', '', '', '', '', '', '133650', 'BALES'),
(196, '2023-02-03', '91839', 'marites', '615', '17', '', '', '', '0', '10455', 'COPRA'),
(197, '2023-02-04', '91842', 'ton ton', '325', '18', '', '', '', '0', '5850', 'COPRA'),
(198, '2023-02-04', '91843', 'wahid', '145', '18', '', '', '', '0', '2610', 'COPRA'),
(199, '2023-02-04', '35734', 'sulayman tanny', '', '', '', '', '', '', '264978', 'WET RUBBER'),
(200, '2023-02-04', '153142', 'perez', '40', '22', '', '', '', '0', '880', 'WET RUBBER'),
(201, '2023-02-04', '91847', 'ibrahim', '467', '26', '', '', '', '0', '12142', 'COPRA'),
(202, '2023-02-04', '91841', 'amman awalin', '25037', '51', '', '1219520', '', '0', '57367', 'BALES'),
(203, '2023-02-06', '287', 'IBRAHIM', '255', '17', '', '', '', '0', '4335', 'COPRA'),
(204, '2023-02-06', '35739', 'TON2X', '470', '16', '', '', '', '0', '7520', 'COPRA'),
(205, '2023-02-07', '91851', 'cawley', '952', '27', '', '', '', '0', '25704', 'COPRA'),
(206, '2023-02-07', '91639', 'tuwa', '7094', '47', '', '295031', '', '0', '38387', 'BALES'),
(207, '2023-02-08', '91852', 'charly cawlet', '5040', '48', '', '', '', '0', '241920', 'BALES'),
(208, '2023-02-08', '91855', 'moleje', '2758', '46', '', '50000', '', '0', '76868', 'BALES'),
(209, '2023-02-08', '91853', 'louie delos reyes', '8332', '46', '', '235182', '', '0', '148090', 'BALES'),
(210, '2023-02-08', '91854', 'jimroy mcclintock', '3017', '46', '', '100000', '', '0', '38782', 'BALES'),
(211, '2023-02-08', '35762', 'ronie vildad', '5942', '24.50', '', '100000', '', '0', '45579', 'WET RUBBER'),
(212, '2023-02-09', '39660', 'sulayman tanny', '', '', '', '', '', '', '67656', 'BALES'),
(213, '2023-02-09', '91863', 'CAWLEY', '630', '27', '', '', '', '0', '17010', 'COPRA'),
(214, '2023-02-09', '91856', 'JUN McCLINTOCK', '3438', '46', '', '150000', '', '0', '8148', 'BALES'),
(215, '2023-02-09', '91861', 'AMIN', '6280', '28', '', '50000', '', '0', '125840', 'COPRA'),
(216, '2023-02-09', '91862', 'TATANG', '1259', '27', '', '', '', '0', '33993', 'COPRA'),
(217, '2023-02-10', '39661', 'hari sabtal', '', '', '', '', '', '', '20702', 'BALES'),
(218, '2023-02-11', '39662', 'AMMAN AWALIN', '', '', '', '', '', '', '24498', 'BALES'),
(219, '2023-02-11', '91866', 'amin abubakar', '1470', '23', '', '', '', '0', '33810', 'WET RUBBER'),
(220, '2023-02-11', '91859', 'samman awalin', '16736', '51', '', '815623', '', '0', '37913', 'BALES'),
(221, '2023-02-13', '35593', 'nenet costan', '', '', '', '', '', '0', '93040', 'WET RUBBER'),
(222, '2023-02-13', '91867', 'martin muslimin', '6180', '28', '', '', '', '0', '173040', 'COPRA'),
(223, '2023-02-13', '91870', 'adam', '3781', '27.50', '', '', '', '0', '103977.5', 'COPRA'),
(224, '2023-02-14', '35595', 'MANCOM-ERVIN SHARE', '1250', '21', '', '10500', '', '0', '15750', 'WET RUBBER'),
(225, '2023-02-14', '35595', 'JBN MANCOM SHARE', '1250', '21', '', '15750', '', '0', '10500', 'WET RUBBER'),
(226, '2023-02-14', '91875', 'AMIN ABUBAKAR', '3000', '28', '', '25000', '', '0', '59000', 'COPRA'),
(227, '2023-02-14', '91874', 'CHARLY CAWLEY', '', '', '', '', '', '', '269630', 'BALES'),
(228, '2023-02-14', '91872', 'MARTIN MUSLIMIN', '2855', '28', '', '', '', '0', '79940', 'COPRA'),
(229, '2023-02-14', '91871', 'MARTIN MUSLIMIN', '4836', '28', '', '', '', '0', '135408', 'COPRA'),
(230, '2023-02-15', '39685', 'SULAYMAN TANY', '', '', '', '', '', '', '36980', 'BALES'),
(231, '2023-02-15', '91882', 'amin abubakar', '2820', '28', '', '25000', '', '0', '53960', 'COPRA'),
(232, '2023-02-15', '153146', 'husin', '243', '23', '', '', '', '0', '5589', 'WET RUBBER'),
(233, '2023-02-15', '153148', 'halima', '262', '23', '', '', '', '0', '6026', 'WET RUBBER'),
(234, '2023-02-15', '153149', 'alvin', '197', '23', '', '', '', '0', '4531', 'WET RUBBER'),
(235, '2023-02-15', '153147', 'nelson', '192', '23', '', '', '', '0', '4416', 'WET RUBBER'),
(236, '2023-02-15', '91879', 'jimroy McClintock', '2864', '46', '', '100000', '', '0', '31744', 'BALES'),
(237, '2023-02-15', '35596', 'epigil molje', '3497', '48', '', '162816', '', '0', '5040', 'BALES'),
(238, '2023-02-15', '91876', 'martin', '2679', '28', '', '', '', '0', '75012', 'COPRA'),
(239, '2023-02-15', '153144', 'pamaran', '549', '27', '', '', '', '0', '14823', 'WET RUBBER'),
(240, '2023-02-15', '153143', 'pamaran', '202', '27', '', '', '', '0', '5454', 'WET RUBBER'),
(241, '2023-02-15', '153145', 'pamaran', '1089', '27', '', '20000', '', '0', '9403', 'WET RUBBER'),
(242, '2023-02-15', '39663', 'martin muslimin', '', '', '', '', '', '', '34314', 'BALES'),
(243, '2023-02-15', '91877', 'kotoh', '3708', '28', '', '', '', '0', '103824', 'COPRA'),
(244, '2023-02-16', '91886', 'sarip', '611', '27.50', '', '', '', '0', '16802.5', 'COPRA'),
(245, '2023-02-16', '91884', 'nonong furigay', '3970', '31', '', '', '', '0', '123070', 'WET RUBBER'),
(246, '2023-02-16', '91885', 'louie delos reyes', '3771', '47', '', '102275', '', '0', '74962', 'WET RUBBER'),
(247, '2023-02-16', '91880', 'esmeraldo', '9015', '27', '', '200000', '', '0', '43405', 'WET RUBBER'),
(248, '2023-02-16', '91883', 'ambil', '740', '28', '', '', '', '0', '20720', 'COPRA'),
(249, '2023-02-17', '91887', 'amin abubakar', '3560', '28', '', '25000', '', '0', '74680', 'COPRA'),
(250, '2023-02-18', '91889', 'JULMAN JALAN', '2192', '28', '', '', '', '0', '61376', 'COPRA'),
(251, '2023-02-20', '314', 'CASH', '26', '17', '', '', '', '0', '442', 'COPRA'),
(252, '2023-02-20', '313', 'ADELAYDA', '78', '17', '', '', '', '0', '1326', 'COPRA'),
(253, '2023-02-20', '153150', 'HASSAN', '104', '21', '', '', '', '0', '2184', 'WET RUBBER'),
(254, '2023-02-20', '91890', 'MARVIN', '566', '27', '', '', '', '0', '15282', 'COPRA'),
(255, '2023-02-21', '39773', 'sulayman tanny', '', '', '', '', '', '', '270024', 'WET RUBBER'),
(256, '2023-02-21', '91897', 'ambil', '591', '27', '', '', '', '0', '15957', 'COPRA'),
(257, '2023-02-21', '91896', 'amin', '3478', '28', '', '25000', '', '0', '72384', 'COPRA'),
(258, '2023-02-21', '39769', 'SULAYMAN TANY', '', '', '', '', '', '', '90121', 'WET RUBBER'),
(259, '2023-02-21', '39768', 'MUDZKIER ABDURAHMAN', '', '', '', '', '', '', '158165', 'WET RUBBER'),
(260, '2023-02-22', '39777', 'rashid amilin', '', '', '', '', '', '', '286612', 'WET RUBBER'),
(261, '2023-02-22', '93502', 'amin abubakar', '2731', '28', '', '', '', '0', '76468', 'COPRA'),
(262, '2023-02-22', '91900', 'belman', '1102', '27', '', '', '', '0', '29754', 'COPRA'),
(263, '2023-02-22', '91899', 'jimroy McClintock', '2964', '46', '', '100000', '', '0', '36344', 'BALES'),
(264, '2023-02-22', '91898', 'charly cawley', '5285', '50', '', '', '', '0', '264250', 'BALES'),
(265, '2023-02-23', '40866', 'francine', '328', '26.50', '', '', '', '0', '8692', 'WET RUBBER'),
(266, '2023-02-23', '93509', 'berto ahilul', '637', '27', '', '', '', '0', '17199', 'COPRA'),
(267, '2023-02-23', '93507', 'donga', '4106', '26.5', '', '53905', '', '0', '54904', 'WET RUBBER'),
(268, '2023-02-23', '93506', 'abdul', '819', '27', '', '', '', '0', '22113', 'COPRA'),
(269, '2023-02-23', '93504', 'berto', '730', '27', '', '', '', '0', '19710', 'COPRA'),
(270, '2023-02-23', '93503', 'zaldy', '213', '27', '', '', '', '0', '5751', 'COPRA'),
(271, '2023-02-24', '93513', 'RUBEN RAMOS', '3034', '47', '', '100000', '', '0', '42598', 'BALES'),
(272, '2023-02-24', '93514', 'SARIP', '855', '27.50', '', '', '', '0', '23512.5', 'COPRA'),
(273, '2023-02-24', '93511', 'JAMES TAN', '9044', '50', '', '300000', '', '0', '152200', 'BALES'),
(274, '2023-02-25', '39788', 'hari sabtal', '', '', '', '', '', '', '13576', 'BALES'),
(275, '2023-02-27', '325', 'sayugay copra  tenant share', '265', '16', '', '2120', '', '0', '2120', 'COPRA'),
(276, '2023-02-27', '325', 'JBN share sayugan copra', '265', '16', '', '2120', '', '0', '2120', 'COPRA'),
(277, '2023-02-27', '93519', 'liot puri', '2941', '51', '', '', '', '0', '149991', 'BALES'),
(278, '2023-02-28', '93525', 'arevalo', '2095', '27', '', '', '', '0', '56565', 'WET RUBBER'),
(279, '2023-02-28', '93526', 'martin', '3253', '28.50', '', '', '', '0', '92710.5', 'COPRA'),
(280, '2023-02-28', '93527', 'julman', '3277', '28', '', '', '', '0', '91756', 'COPRA'),
(281, '2023-02-28', '39787', 'rasid amilin', '', '', '', '', '', '', '13249', 'WET RUBBER'),
(282, '2023-02-28', '328', 'amin abubakar', '3473', '28.50', '', '50000', '', '0', '48980.5', 'COPRA'),
(283, '2023-03-02', '152572', 'PAMARAN', '172', '28', '', '', '', '0', '4816', 'WET RUBBER'),
(284, '2023-03-02', '152571', 'PAMARAN', '387', '28', '', '', '', '', '10836', 'WET RUBBER'),
(285, '2023-03-02', '152573', 'PAMARAN', '879', '28', '', '', '', '0', '24612', 'WET RUBBER'),
(286, '2023-03-02', '152569', 'BALTAZAR', '281', '28', '', '', '', '0', '7868', 'WET RUBBER'),
(287, '2023-03-02', '152568', 'JOSEPH', '186', '28', '', '', '', '0', '5208', 'WET RUBBER'),
(288, '2023-03-02', '152570', 'ATILANO', '89', '28', '', '', '', '0', '2492', 'WET RUBBER'),
(289, '2023-03-02', '35672', 'MANCOM ERVIN SHARE', '871', '21', '', '7316.40', '', '0', '10974.6', 'WET RUBBER'),
(290, '2023-03-02', '35672', 'MANCOM JBN SHARE 40', '871', '21', '', '10974.60', '', '0', '7316.4', 'WET RUBBER'),
(291, '2023-03-02', '91926', 'BELMAN', '873', '28', '', '', '', '0', '24444', 'COPRA'),
(292, '2023-03-02', '91925', 'KOTOH LASARUL', '3508', '28', '', '', '', '0', '98224', 'COPRA'),
(293, '2023-03-02', '93535', 'JESSICA FLORES', '4598', '26', '', '50000', '', '0', '69548', 'WET RUBBER'),
(294, '2023-03-02', '93532', 'AMIN ABUBAKAR', '4886', '28.50', '', '50000', '', '0', '89251', 'COPRA'),
(295, '2023-03-02', '93533', 'JIMROY MCCLINTOK', '4954', '50', '', '150000', '', '0', '97700', 'WET RUBBER'),
(296, '2023-03-02', '93534', 'JOEL AMAHAN', '2646', '28', '', '', '', '0', '74088', 'WET RUBBER'),
(297, '2023-03-04', '93539', 'EPIGIL MOLEJE', '2966', '50', '', '', '', '0', '148300', 'BALES'),
(298, '2023-03-04', '93540', 'RUBBEN RAMOS', '1070', '50.00', '', '30000', '', '', '23500', 'BALES'),
(299, '2023-03-06', '93542', 'louie delos reyes', '4131', '50', '', '2402', '', '0', '204148', 'BALES'),
(300, '2023-03-07', '39745', 'teeman copras dongga', '35', '3', '', '', '', '0', '105', 'COPRA'),
(301, '2023-03-07', '39745', 'entrada copra', '35', '3', '', '', '', '0', '105', 'COPRA'),
(302, '2023-03-07', '93545', 'lee brown', '8829', '25', '', '200000', '', '0', '20725', 'WET RUBBER'),
(303, '2023-03-07', '93544', 'charles cawley', '4725', '50', '', '130000', '', '0', '106250', 'WET RUBBER'),
(304, '2023-03-07', '93548', 'eric enriquea (dongga)', '1885', '18', '', '', '', '0', '33930', 'COPRA'),
(305, '2023-03-08', '93549', 'amin abubakar', '6398', '29', '', '50000', '', '0', '135542', 'COPRA'),
(306, '2023-03-09', '93552', 'abdul', '1587', '28', '', '', '', '0', '44436', 'COPRA'),
(307, '2023-03-10', '93554', 'babon', '1227', '28', '', '', '', '0', '34356', 'COPRA'),
(308, '2023-03-11', '0002', 'amin abubakar', '955', '25', '', '', '', '0', '23875', 'COPRA'),
(309, '2023-03-13', '12574', 'rogelio', '96', '23', '', '', '', '0', '2208', 'WET RUBBER'),
(310, '2023-03-13', '0003', 'jimroy mcclintok', '1948', '50', '', '50000', '', '0', '47400', 'WET RUBBER'),
(311, '2023-03-14', '93557', 'madzhar', '866', '28', '', '', '', '0', '24248', 'COPRA'),
(312, '2023-03-14', '0005', 'charles cawley', '4550', '50', '', '130000', '', '0', '97500', 'WET RUBBER'),
(313, '2023-03-14', '93555', 'jariba', '1215', '28', '', '', '', '0', '34020', 'COPRA'),
(314, '2023-03-15', '344', 'taniang', '235', '18', '', '', '', '0', '4230', 'COPRA'),
(315, '2023-03-15', '031523', 'hassan', '126', '23', '', '', '', '0', '2898', 'WET RUBBER'),
(316, '2023-03-15', '93558', 'kotoh lasarul', '3777', '28.50', '', '', '', '0', '107644.5', 'COPRA'),
(317, '2023-03-16', '152578', 'pamaran', '165', '28', '', '', '', '0', '4620', 'WET RUBBER'),
(318, '2023-03-16', '152577', 'pamaran', '533', '28', '', '', '', '0', '14924', 'WET RUBBER'),
(319, '2023-03-16', '152576', 'pamaran', '925', '28', '', '13000', '', '0', '12900', 'WET RUBBER'),
(320, '2023-03-15', '0007', 'charles cawley', '4130', '50', '', '', '', '0', '206500', 'WET RUBBER'),
(321, '2023-03-17', '152579', 'PEREZ', '157.6', '110', '', '', '', '0', '17336', 'COFFEE BERRIES'),
(322, '2023-03-17', '93562', 'AMIN ABUBAKAR', '3356', '28', '', '50000', '', '0', '43968', 'COPRA'),
(323, '2023-03-17', '40484', 'NENETH COSTAN', '3775', '49', '', '193040', '', '0', '-8065', 'BALES'),
(324, '2023-03-17', '40486', 'NENETH COSTAN- MALUSO', '15584', '30', '5000', '500000', '5000', '', '27025.60', 'WET RUBBER'),
(325, '2023-03-17', '40487', 'NENETH COSTAN', '10715', '52', '', '478590', '', '0', '78590', 'BALES'),
(326, '2023-03-17', '0013', 'NENETH COSTAN', '12686', '52', '', '500000', '', '0', '159672', 'BALES'),
(327, '2023-03-17', '0011', 'LONG SAN JUAN', '8125', '52', '', '400551', '', '0', '21949', 'BALES'),
(328, '2023-03-17', '93560', 'MARTIN MUSLIMIN', '7041', '28.50', '', '', '', '0', '200668.5', 'COPRA'),
(329, '2023-03-17', '93561', 'SARHA', '2459', '28', '', '', '', '0', '68852', 'COPRA'),
(330, '2023-03-18', '126679', 'DADO', '31.8', '110', '', '', '', '0', '3498', 'COFFEE BERRIES'),
(331, '2023-03-18', '126679', 'DADO', '33.2', '110', '', '', '', '0', '3652', 'COFFEE BERRIES'),
(332, '2023-03-18', '93563', 'AMIN ABUBAKAR', '2861', '29', '', '50000', '', '0', '32969', 'COPRA'),
(333, '2023-03-18', '152580', 'ROGELIO', '39', '22', '', '', '', '0', '858', 'WET RUBBER'),
(334, '2023-03-18', '93564', 'ARSENIO', '968', '28', '', '', '', '0', '27104', 'COPRA'),
(335, '2023-03-18', '0018', 'LOUIE DELOS REYES', '2891', '52', '', '101806', '', '0', '48526', 'WET RUBBER'),
(336, '2023-03-18', '0019', 'ESMERALDO', '6509', '30', '', '150000', '', '0', '45270', 'WET RUBBER'),
(337, '2023-03-20', '40509', 'LONG2 SAN JUAN', '4917', '52', '', '251240', '', '0', '4444', 'WET RUBBER'),
(338, '2023-03-20', '40510', 'LONG2 SAN JUAN', '4174', '52', '', '201136.85', '', '0', '15911', 'WET RUBBER'),
(339, '2023-03-20', '0023', 'EPIGIL MOLEJE', '3053', '50', '', '', '', '0', '152650', 'BALES'),
(340, '2023-03-20', '353', 'EJN MALOONG', '547', '26', '', '', '', '0', '14222', 'COPRA'),
(341, '2023-03-21', '152583', 'HAMID', '120', '24', '', '', '', '0', '2880', 'WET RUBBER'),
(342, '2023-03-21', '152582', 'HASSAN', '75', '24', '', '', '', '0', '1800', 'WET RUBBER'),
(343, '2023-03-21', '152581', 'TOTONG', '86', '24', '', '', '', '0', '2064', 'WET RUBBER'),
(344, '2023-03-21', '0026', 'NENETH COSTAN', '6113', '52', '', '278590', '', '0', '39286', 'BALES'),
(345, '2023-03-21', '0028', 'NENETH COSTAN', '12157', '30', '.35', '340000', '', '4254.95', '28965', 'BALES'),
(346, '2023-03-21', '93566', 'NAMIR', '2758', '28', '', '', '', '0', '77224', 'COPRA'),
(347, '2023-03-21', '9565', 'ABUBAKAR', '2616', '28', '', '', '', '0', '73248', 'COPRA'),
(348, '2023-03-23', '0033', 'DONGGA ENRIQUEZ', '2690', '24', '', '30780', '', '0', '33780', 'WET RUBBER'),
(349, '2023-03-23', '0034', 'RONIE VILDAD', '3057', '49', '', '145579', '', '0', '4214', 'BALES'),
(350, '2023-03-23', '0035', 'FRANCINE', '273', '24', '', '', '', '0', '6552', 'WET RUBBER'),
(351, '2023-03-23', '0032', 'ENGR. BONG', '82', '58', '35', '', '', '', '166460', 'BALES'),
(352, '2023-03-24', '0036', 'NONONG FURIGAY', '2700', '30', '', '', '', '0', '81000', 'WET RUBBER'),
(353, '2023-03-25', '126680', 'JOJO', '4', '90', '', '', '', '0', '360', 'COFFEE BEANS'),
(354, '2023-03-25', '93569', 'AMIN ABUBAKAR', '2802', '29', '', '', '', '0', '81258', 'COPRA'),
(355, '2023-03-27', '0043', 'tatah halal', '8823', '50', '', '63369', '', '0', '377781', 'BALES'),
(356, '2023-03-27', '93570', 'abdul', '909', '27', '', '', '', '0', '24543', 'COPRA'),
(357, '2023-03-27', '93571', 'ibrahim', '828', '27', '', '', '', '0', '22356', 'COPRA'),
(358, '2023-03-27', '93572', 'julman jalal', '3484', '28', '', '', '', '0', '97552', 'COPRA'),
(359, '2023-03-27', '93573', 'ibrahim', '790', '27', '', '', '', '0', '21330', 'COPRA'),
(360, '2023-03-28', '40555', 'ruben ramos return cash', '1996', '51', '', '150000', '', '0', '-48204', 'WET RUBBER'),
(361, '2023-03-28', '03282023', 'adelayda', '68', '17', '', '', '', '0', '1156', 'COPRA'),
(362, '2023-03-28', '93574', 'abdul', '326', '27', '', '', '', '0', '8802', 'COPRA'),
(363, '2023-03-29', '0051', 'lito puri', '3192.50', '51', '', '', '', '', '162817.5', 'BALES'),
(364, '2023-03-29', '152586', 'mitch', '115', '24', '', '', '', '0', '2760', 'WET RUBBER'),
(365, '2023-03-29', '0052', 'arevalo', '1177', '28.50', '', '', '', '0', '33544.5', 'WET RUBBER'),
(366, '2023-03-29', '0053', 'charles cawley', '2050', '50', '', '', '', '0', '102500', 'BALES'),
(367, '2023-03-29', '0053', 'charles cawley', '2255', '48', '', '', '', '0', '108240', 'BALES'),
(368, '2023-03-29', '0054', 'jimroy mcclintock', '2824', '50', '', '100000', '', '0', '41200', 'WET RUBBER'),
(369, '2023-03-30', '152592', 'aida', '142', '24', '', '', '', '0', '3408', 'WET RUBBER'),
(370, '2023-03-30', '93576', 'amin abubakar', '4154', '28', '', '50000', '', '0', '66312', 'COPRA'),
(371, '2023-03-30', '93575', 'ibrahim', '773', '27', '', '', '', '0', '20871', 'COPRA'),
(372, '2023-03-30', '93577', 'ibrahim', '702', '27', '', '', '', '0', '18954', 'COPRA'),
(373, '2023-03-30', '0057', 'arco', '7548', '28', '', '100000', '', '0', '111344', 'WET RUBBER'),
(374, '2023-03-30', '40570', 'ejn mancom', '1322', '21', '', '', '', '0', '27762', 'WET RUBBER'),
(375, '2023-03-31', '152813', 'jack', '19.8', '110', '', '', '', '0', '2178', 'COFFEE BEANS'),
(376, '2023-03-31', '152595', 'mando', '79', '28', '', '', '', '', '2212', 'WET RUBBER'),
(377, '2023-03-31', '152810', 'baltazar', '314', '28', '', '', '', '0', '8792', 'WET RUBBER'),
(378, '2023-03-31', '152811', 'jeff2', '92', '28', '', '', '', '0', '2576', 'WET RUBBER'),
(379, '2023-03-31', '152809', 'joseph', '76', '28', '', '', '', '0', '2128', 'WET RUBBER'),
(380, '2023-03-31', '152806', 'tan', '241', '28', '', '', '', '0', '6748', 'WET RUBBER'),
(381, '2023-03-31', '152808', 'atilano', '71', '28', '', '', '', '0', '1988', 'WET RUBBER'),
(382, '2023-03-31', '152807', 'batitong', '680', '28', '', '', '', '0', '19040', 'WET RUBBER'),
(383, '2023-03-31', '0060', 'joel amahan', '2897', '28', '', '', '', '0', '81116', 'WET RUBBER'),
(384, '2023-04-01', '152814', 'PAMARAN', '567', '26', '', '', '', '0', '14742', 'WET RUBBER'),
(385, '2023-04-01', '152815', 'PAMARAN', '818', '26', '', '13000', '', '0', '8268', 'WET RUBBER'),
(386, '2023-04-01', '152813', 'PAMARAN', '151', '26', '', '', '', '0', '3926', 'WET RUBBER'),
(387, '2023-04-01', '93578', 'IBRAHIM', '772', '27', '', '', '', '0', '20844', 'COPRA'),
(388, '2023-04-01', '91774', 'NONONG FURIGAY', '2235', '31', '', '', '', '0', '69285', 'WET RUBBER'),
(389, '2023-04-01', '93579', 'IBRAHIM', '695', '27', '', '', '', '0', '18765', 'COPRA'),
(390, '2023-04-03', '93580', 'MARJOE', '565', '27', '', '', '', '0', '15255', 'COPRA'),
(391, '2023-04-05', '93586', 'IBRAHIM', '381', '27', '', '', '', '0', '10287', 'COPRA'),
(392, '2023-04-05', '04052023', 'KABAYAN', '47', '17', '', '', '', '0', '799', 'COPRA'),
(393, '2023-04-05', '040523', 'kabayan', '47', '17', '', '', '', '0', '799', 'COPRA'),
(394, '2023-04-05', '93586', 'ibrahim', '381', '27', '', '', '', '0', '10287', 'COPRA'),
(395, '2023-04-08', '040823', 'AMIN ABUBAKAR', '3499', '29', '', '50000', '', '0', '51471', 'COPRA'),
(396, '2023-04-14', '91799', 'AMIN ABUBAKAR', '1830', '25.50', '', '', '', '0', '46665', 'WET RUBBER'),
(397, '2023-04-14', '91798', 'JIMROY MCCLINTOK', '2626', '50', '', '100000', '', '0', '31300', 'BALES'),
(398, '2023-04-14', '93595', 'ASRAFF HADITIYA TARZRIMIN', '2064', '28', '', '', '', '0', '57792', 'COPRA'),
(399, '2023-04-14', '40681', 'EJN MANCOM', '841', '21', '', '', '', '0', '17661', 'WET RUBBER'),
(400, '2023-04-10', '40648', 'adelayda', '55', '21', '', '', '', '0', '1155', 'COPRA'),
(401, '2023-04-10', '152816', 'nilo', '85', '23', '', '', '', '0', '1955', 'WET RUBBER'),
(402, '2023-04-10', '91786', 'louie delos reyes', '9256', '30', '', '200000', '', '0', '77680', 'WET RUBBER'),
(403, '2023-04-10', '93588', 'sanchez', '856', '27', '', '', '', '0', '23112', 'COPRA'),
(404, '2023-04-11', '152817', 'perez', '81.6', '110', '', '', '', '0', '8976', 'COFFEE BEANS'),
(405, '2023-04-11', '152817', 'perez', '13.2', '110', '', '', '', '0', '1452', 'COFFEE BEANS'),
(406, '2023-04-11', '93589', 'bacalso', '1982', '27', '', '', '', '0', '53514', 'COPRA'),
(407, '2023-04-11', '91789', 'epigil moleje', '3454', '50', '', '', '', '0', '172700', 'BALES'),
(408, '2023-04-11', '91790', 'charley cawley', '3640', '48', '', '130000', '', '0', '44720', 'BALES'),
(409, '2023-04-12', '93590', 'martin muslimin', '3496', '29', '', '', '', '0', '101384', 'COPRA'),
(410, '2023-04-12', '93591', 'martin muslimin', '2788', '29', '', '', '', '0', '80852', 'COPRA'),
(411, '2023-04-12', '91791', 'charles cawley', '4165', '48', '', '', '', '0', '199920', 'BALES'),
(413, '2023-04-13', '91796', 'louie delos reyes', '', '', '', '', '', '', '211442', 'BALES'),
(414, '2023-04-13', '91795', 'jerry ariero', '2874', '50', '', '70000', '', '0', '73700', 'BALES'),
(415, '2023-04-13', '91792', 'jessica florez', '3695', '25', '', '30000', '', '0', '62375', 'WET RUBBER'),
(416, '2023-04-13', '93593', 'martin muslimin', '2297', '29', '', '', '', '0', '66613', 'COPRA'),
(417, '2023-04-13', '93592', 'yaser', '370', '29', '', '', '', '0', '10730', 'COPRA'),
(418, '2023-04-13', '93594', 'ibrahim', '778', '28', '', '', '', '0', '21784', 'COPRA'),
(419, '2023-04-15', '93596', 'amin abubakar', '4042', '29', '', '50000', '', '0', '67218', 'COPRA'),
(420, '2023-04-17', '0101', 'jarwin garcia', '2811', '50', '', '121000', '', '0', '19550', 'WET RUBBER'),
(421, '2023-04-18', '152818', 'nestor', '117', '25', '', '', '', '0', '2925', 'WET RUBBER'),
(422, '2023-04-18', '0106', 'epigil moleje', '1197', '51', '', '', '', '0', '61047', 'BALES'),
(423, '2023-04-19', '041923', 'ibs', '87', '18', '', '', '', '0', '1566', 'COPRA'),
(424, '2023-04-19', '0111', 'charles cawley', '3465', '48', '', '', '', '0', '166320', 'BALES'),
(425, '2023-04-19', '0107', 'jarwin garcia', '6844', '50', '', '284750', '', '0', '57450', 'BALES'),
(426, '2023-04-18', '0109', 'larbeco', '30000', '29.30', '', '', '615300', '0', '263700', 'WET RUBBER'),
(427, '2023-04-20', '0113', 'LITO PURI', '3265', '52', '', '', '', '0', '169780', 'WET RUBBER'),
(428, '2023-04-20', '93598', 'IBRAHIM', '1020', '28', '', '', '', '0', '28560', 'COPRA'),
(429, '2023-04-22', '40808', 'LARBECO', '30743', '29.30', '', '615300', '', '0', '285469.9', 'WET RUBBER'),
(430, '2023-04-22', '0119', 'DONGGA/ ERIC ENRIQUEZ', '1988', '25', '', '22350', '', '0', '27350', 'WET RUBBER'),
(431, '2023-04-22', '0118', 'JENG ENRIQUEZ', '429', '25', '', '', '', '0', '10725', 'WET RUBBER'),
(432, '2023-04-22', '0117', 'JIMROY MCCLONTOCK', '3409', '51', '', '110000', '', '0', '63859', 'WET RUBBER'),
(433, '2023-04-24', '40801', 'NENETH COSTAN', '20190', '', '', '560000', '', '0', '13799.80', 'WET RUBBER'),
(434, '2023-04-24', '40817', 'LARBECO', '1046', '29.30', '', '', '', '0', '30647.8', 'WET RUBBER'),
(435, '2023-04-24', '0115', 'TATA HALAL ', '3086', '51', '', '20000', '', '0', '137386', 'BALES'),
(436, '2023-04-25', '152819', 'BABON', '68', '23', '', '', '', '0', '1564', 'WET RUBBER'),
(437, '2023-04-25', '0125', 'CHARLES CAWLEY', '4060', '48', '', '', '', '0', '194880', 'WET RUBBER'),
(438, '2023-04-26', '40836', 'AMIN ABUBAKAR', '1530', '25', '', '', '', '0', '38250', 'WET RUBBER'),
(439, '2023-04-26', '40835', 'ADELAIDA PACARO', '47', '19', '', '', '', '0', '893', 'COPRA'),
(440, '2023-04-27', '0401', 'HON. ARLEIGH EISMA', '2498', '28', '', '', '', '0', '69944', 'COPRA'),
(441, '2023-04-27', '93599', 'DENG/ HARIJA', '2004', '28.50', '', '', '', '0', '57114', 'COPRA'),
(442, '2023-04-27', '93600', 'AMIL SABBUDIN', '876', '28', '', '', '', '0', '24528', 'COPRA'),
(443, '2023-04-28', '152826', 'JACK', '19', '110', '', '', '', '0', '2090', 'COFFEE BEANS'),
(444, '2023-04-28', '0133', 'EPIGIL MOLEJE', '1860', '50', '', '', '', '0', '93000', 'WET RUBBER'),
(445, '2023-04-28', '0403', 'AMIN ABUBAKAR', '2620', '29', '', '50000', '', '0', '25980', 'COPRA'),
(446, '2023-04-28', '0132', 'JARWIN GARCIA', '2978', '50', '', '130750', '', '0', '18150', 'BALES'),
(447, '2023-04-28', '0132', 'JARWIN GARCIA', '2723', '50', '', '114375', '', '0', '21775', 'BALES'),
(448, '2023-04-28', '152820', 'MADINA', '166', '23', '', '', '', '0', '3818', 'WET RUBBER'),
(449, '2023-04-28', '0131', 'AREVALO', '1301', '28', '', '', '', '0', '36428', 'WET RUBBER'),
(450, '2023-04-28', '0402', 'IBRAHIM', '897', '27', '', '', '', '0', '24219', 'COPRA'),
(451, '2023-04-29', '0134', 'alvin gulpere- arco', '6915', '28.50', '', '150000', '', '0', '47077.5', 'WET RUBBER'),
(452, '2023-04-29', '152827', 'cash', '69', '23', '', '', '', '0', '1587', 'WET RUBBER'),
(453, '2023-04-29', '2895', 'mancom, maloong plantation', '575', '21', '', '4830', '', '0', '7245', 'WET RUBBER'),
(454, '2023-04-29', '2895', 'mancom jbn share', '575', '21', '', '7245', '', '0', '4830', 'WET RUBBER'),
(455, '2023-04-29', '40420', 'maloong canal plantation/ jay ar catall/ biddinga', '16259', '28.25', '', '', '', '0', '459316.75', 'WET RUBBER'),
(456, '2023-05-02', '40901', 'lee roy brown', '8336', '28', '', '200000', '', '0', '33408', 'WET RUBBER'),
(457, '2023-05-02', '0404', 'martin muslimin', '3112', '27', '', '', '', '0', '84024', 'COPRA'),
(458, '2023-05-03', '0405', 'kotoh lasarul', '3576', '28', '', '', '', '0', '100128', 'COPRA'),
(459, '2023-05-03', '0141', 'charles cawley', '2415', '48', '', '', '', '0', '115920', 'BALES'),
(460, '2023-05-03', '0141', 'charles cawley', '2205', '52', '', '', '', '0', '114660', 'BALES');

-- --------------------------------------------------------

--
-- Table structure for table `moisture_table`
--

CREATE TABLE `moisture_table` (
  `id` int(11) NOT NULL,
  `moisture_reading` varchar(20) NOT NULL,
  `discount_factor` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `moisture_table`
--

INSERT INTO `moisture_table` (`id`, `moisture_reading`, `discount_factor`) VALUES
(231, '6', '0'),
(232, '6.1', '0.1'),
(233, '6.2', '0.2'),
(234, '6.3', '0.3'),
(235, '6.4', '0.4'),
(236, '6.5', '0.5'),
(237, '6.6', '0.6'),
(238, '6.7', '0.7'),
(239, '6.8', '0.8'),
(240, '6.9', '0.9'),
(241, '7', '1'),
(242, '7.1', '1.1'),
(243, '7.2', '1.2'),
(244, '7.3', '1.3'),
(245, '7.4', '1.4'),
(246, '7.5', '1.5'),
(247, '7.6', '1.6'),
(248, '7.7', '1.7'),
(249, '7.8', '1.8'),
(250, '7.9', '1.9'),
(251, '8', '2'),
(252, '8.1', '2.1'),
(253, '8.2', '2.2'),
(254, '8.3', '2.3'),
(255, '8.4', '2.4'),
(256, '8.5', '2.5'),
(257, '8.6', '2.6'),
(258, '8.7', '2.7'),
(259, '8.8', '2.8'),
(260, '8.9', '2.9'),
(261, '9', '3'),
(262, '9.1', '3.4'),
(263, '9.2', '3.6'),
(264, '9.3', '3.7'),
(265, '9.4', '3.8'),
(266, '9.5', '3.9'),
(267, '9.6', '4'),
(268, '9.7', '4.1'),
(269, '9.8', '4.2'),
(270, '9.9', '4.3'),
(271, '10', '4.7'),
(272, '10.1', '4.8'),
(273, '10.2', '4.9'),
(274, '10.3', '5'),
(275, '10.4', '5.1'),
(276, '10.5', '5.2'),
(277, '10.6', '5.3'),
(278, '10.7', '5.4'),
(279, '10.8', '5.5'),
(280, '10.9', '5.6'),
(281, '11', '5.8'),
(282, '11.1', '6'),
(283, '11.2', '6.1'),
(284, '11.3', '6.2'),
(285, '11.4', '6.3'),
(286, '11.5', '6.4'),
(287, '11.6', '6.5'),
(288, '11.7', '6.6'),
(289, '11.8', '6.7'),
(290, '11.9', '6.8'),
(291, '12', '7.1'),
(292, '12.1', '7.2'),
(293, '12.2', '7.3'),
(294, '12.3', '7.4'),
(295, '12.4', '7.5'),
(296, '12.5', '7.6'),
(297, '12.6', '7.7'),
(298, '12.7', '7.8'),
(299, '12.8', '7.9'),
(300, '12.9', '8'),
(301, '13', '8.1'),
(302, '13.1', '8.6'),
(303, '13.2', '8.7'),
(304, '13.3', '8.8'),
(305, '13.4', '8.9'),
(306, '13.5', '9.1'),
(307, '13.6', '9.2'),
(308, '13.7', '9.3'),
(309, '13.8', '9.4'),
(310, '13.9', '9.5'),
(311, '14', '9.6'),
(312, '14.1', '9.8'),
(313, '14.2', '9.9'),
(314, '14.3', '10'),
(315, '14.4', '10.1'),
(316, '14.5', '10.2'),
(317, '14.6', '10.4'),
(318, '14.7', '10.5'),
(319, '14.8', '10.6'),
(320, '14.9', '10.7'),
(321, '15', '10.8'),
(322, '15.1', '11.1'),
(323, '15.2', '11.2'),
(324, '15.3', '11.3'),
(325, '15.4', '11.4'),
(326, '15.5', '11.6'),
(327, '15.6', '11.7'),
(328, '15.7', '11.8'),
(329, '15.8', '12.1'),
(330, '15.9', '12.2'),
(331, '16', '12.3'),
(332, '16.1', '12.4'),
(333, '16.2', '12.5'),
(334, '16.3', '12.6'),
(335, '16.4', '12.7'),
(336, '16.5', '12.9'),
(337, '16.6', '13'),
(338, '16.7', '13.1'),
(339, '16.8', '13.2'),
(340, '16.9', '13.3'),
(341, '17', '13.4'),
(342, '17.1', '14'),
(343, '17.2', '14.1'),
(344, '17.3', '14.2'),
(345, '17.4', '14.3'),
(346, '17.5', '14.5'),
(347, '17.6', '14.6'),
(348, '17.7', '14.7'),
(349, '17.8', '14.8'),
(350, '17.9', '14.9'),
(351, '18', '15'),
(352, '18.1', '15.6'),
(353, '18.2', '15.7'),
(354, '18.3', '15.8'),
(355, '18.4', '15.9'),
(356, '18.5', '16.1'),
(357, '18.6', '16.2'),
(358, '18.7', '16.3'),
(359, '18.8', '16.4'),
(360, '18.9', '16.5'),
(361, '19', '16.6'),
(362, '19.1', '17.2'),
(363, '19.2', '17.3'),
(364, '19.3', '17.4'),
(365, '19.4', '17.5'),
(366, '19.5', '17.7'),
(367, '19.6', '17.8'),
(368, '19.7', '17.9'),
(369, '19.8', '18'),
(370, '19.9', '18.1'),
(371, '20', '18.2'),
(372, '20.1', '18.6'),
(373, '20.2', '20.2'),
(374, '20.3', '20.3'),
(375, '20.4', '20.4'),
(376, '20.5', '20.5'),
(377, '20.6', '20.6'),
(378, '20.7', '20.7'),
(379, '20.8', '20.8'),
(380, '20.9', '20.9'),
(381, '21', '21'),
(382, '21.1', '21.1'),
(383, '21.2', '21.2'),
(384, '21.3', '21.3'),
(385, '21.4', '21.4'),
(386, '21.5', '21.5'),
(387, '21.6', '21.6'),
(388, '21.7', '21.7'),
(389, '21.8', '21.8'),
(390, '21.9', '21.9'),
(391, '22', '22'),
(392, '22.1', '22.1'),
(393, '22.2', '22.2'),
(394, '22.3', '22.3'),
(395, '22.4', '22.4'),
(396, '22.5', '22.5'),
(397, '22.6', '22.6'),
(398, '22.7', '22.7'),
(399, '22.8', '22.8'),
(400, '22.9', '22.9'),
(401, '23', '23'),
(402, '23.1', '23.1'),
(403, '23.2', '23.2'),
(404, '23.3', '23.3'),
(405, '23.4', '23.4'),
(406, '23.5', '23.5'),
(407, '23.6', '23.6'),
(408, '23.7', '23.7'),
(409, '23.8', '23.8'),
(410, '23.9', '23.9'),
(411, '24', '24'),
(412, '24.1', '24.1'),
(413, '24.2', '24.2'),
(414, '24.3', '24.3'),
(415, '24.4', '24.4'),
(416, '24.5', '24.5'),
(417, '24.6', '24.6'),
(418, '24.7', '24.7'),
(419, '24.8', '24.8'),
(420, '24.9', '24.9'),
(421, '25', '25'),
(422, '25.1', '25.1'),
(423, '25.2', '25.2'),
(424, '25.3', '25.3'),
(425, '25.4', '25.4'),
(426, '25.5', '25.5'),
(427, '25.6', '25.6'),
(428, '25.7', '25.7'),
(429, '25.8', '25.8'),
(430, '25.9', '25.9'),
(431, '26', '26'),
(432, '26.1', '26.1'),
(433, '26.2', '26.2'),
(434, '26.3', '26.3'),
(435, '26.4', '26.4'),
(436, '26.5', '26.5'),
(437, '26.6', '26.6'),
(438, '26.7', '26.7'),
(439, '26.8', '26.8'),
(440, '26.9', '26.9'),
(441, '27', '27'),
(442, '27.1', '27.1'),
(443, '27.2', '27.2'),
(444, '27.3', '27.3'),
(445, '27.4', '27.4'),
(446, '27.5', '27.5'),
(447, '27.6', '27.6'),
(448, '27.7', '27.7'),
(449, '27.8', '27.8'),
(450, '27.9', '27.9'),
(451, '28', '28'),
(452, '28.1', '28.1'),
(453, '28.2', '28.2'),
(454, '28.3', '28.3'),
(455, '28.4', '28.4'),
(456, '28.5', '28.5'),
(457, '28.6', '28.6'),
(458, '28.7', '28.7'),
(459, '28.8', '28.8'),
(460, '28.9', '28.9');

-- --------------------------------------------------------

--
-- Table structure for table `planta_bales_production`
--

CREATE TABLE `planta_bales_production` (
  `bales_prod_id` int(11) NOT NULL,
  `recording_id` int(11) DEFAULT NULL,
  `bales_type` varchar(255) DEFAULT NULL,
  `kilo_per_bale` float DEFAULT NULL,
  `rubber_weight` float DEFAULT NULL,
  `number_bales` float DEFAULT NULL,
  `bales_excess` float DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `date_produced` date DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `planta_bales_production`
--

INSERT INTO `planta_bales_production` (`bales_prod_id`, `recording_id`, `bales_type`, `kilo_per_bale`, `rubber_weight`, `number_bales`, `bales_excess`, `status`, `date_produced`, `description`) VALUES
(21, 9, '5L', 35, 1750, 50, 0, 'Production', NULL, ''),
(22, 9, 'SPR-5', 35, 805, 23, 0, 'Production', NULL, ''),
(23, 9, 'SPR-10', 35, 0, 0, 0, 'Production', NULL, ''),
(24, 9, 'SPR-20', 33.33, 0, 0, 0, 'Production', NULL, ''),
(25, 9, 'Off Color', 35, 0, 0, 0, 'Production', NULL, ''),
(26, 11, '5L', 35, 8178, 233, 23, 'Production', NULL, NULL),
(27, 11, 'SPR-5', 35, 0, 0, 0, 'Production', NULL, NULL),
(28, 11, 'SPR-10', 35, 0, 0, 0, 'Production', NULL, NULL),
(29, 11, 'SPR-20', 33.33, 0, 0, 0, 'Production', NULL, NULL),
(30, 11, 'Off Color', 35, 0, 0, 0, 'Production', NULL, NULL),
(31, 10, '5L', 35, 805, 23, 0, 'Production', NULL, 'test'),
(32, 10, 'SPR-5', 35, 0, 0, 0, 'Production', NULL, ''),
(33, 10, 'SPR-10', 35, 175, 5, 0, 'Production', NULL, ''),
(34, 10, 'SPR-20', 33.33, 0, 0, 0, 'Production', NULL, ''),
(35, 10, 'Off Color', 35, 0, 0, 0, 'Production', NULL, ''),
(36, 12, '5L', 35, 1050, 30, 0, 'Production', NULL, ''),
(37, 12, 'SPR-5', 35, 980, 28, 0, 'Production', NULL, ''),
(38, 12, 'SPR-10', 35, 0, 0, 0, 'Production', NULL, ''),
(39, 12, 'SPR-20', 33.33, 0, 0, 0, 'Production', NULL, ''),
(40, 12, 'Off Color', 35, 0, 0, 0, 'Production', NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `planta_recording`
--

CREATE TABLE `planta_recording` (
  `recording_id` int(11) NOT NULL,
  `purchased_id` int(11) DEFAULT NULL,
  `supplier` varchar(255) DEFAULT NULL,
  `receiving_date` datetime DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `driver` varchar(255) DEFAULT NULL,
  `truck_num` varchar(255) DEFAULT NULL,
  `weight` int(11) DEFAULT NULL,
  `reweight` int(11) DEFAULT NULL,
  `cuplump_remaining_weight` decimal(10,2) DEFAULT NULL,
  `cost` int(11) DEFAULT NULL,
  `total_cost` int(11) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `lot_num` varchar(255) DEFAULT NULL,
  `milling_date` date DEFAULT NULL,
  `drying_date` date DEFAULT NULL,
  `pressing_date` date DEFAULT NULL,
  `production_date` datetime DEFAULT NULL,
  `completion_date` datetime DEFAULT NULL,
  `selling_date` datetime DEFAULT NULL,
  `crumbed_weight` int(11) NOT NULL,
  `produce_total_weight` float DEFAULT NULL,
  `cost_ave` float DEFAULT NULL,
  `dry_weight` int(11) DEFAULT NULL,
  `drc` float DEFAULT NULL,
  `wet_inventory_sold` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `planta_recording`
--

INSERT INTO `planta_recording` (`recording_id`, `purchased_id`, `supplier`, `receiving_date`, `location`, `driver`, `truck_num`, `weight`, `reweight`, `cuplump_remaining_weight`, `cost`, `total_cost`, `status`, `lot_num`, `milling_date`, `drying_date`, `pressing_date`, `production_date`, `completion_date`, `selling_date`, `crumbed_weight`, `produce_total_weight`, `cost_ave`, `dry_weight`, `drc`, `wet_inventory_sold`) VALUES
(9, 17, 'NONONG FURIGAY', '2023-05-03 09:14:50', 'LAMITAN CITY', 'Driver Name 1', 'ABC123', 6360, 6300, NULL, 0, 0, 'Produced', 'DE45', '2023-05-03', NULL, '2023-05-03', '2023-05-03 09:14:57', NULL, NULL, 0, 2555, NULL, NULL, 40.173, NULL),
(10, 72, 'NENETH COSTAN', '2023-05-04 13:54:16', 'TABIAWAN, ISABELA CITY', 'Driver Name 1', 'ABC123', 9, 23, NULL, 0, 0, 'Pressing', 'DE45', '2023-05-09', NULL, '2023-05-09', '2023-05-09 09:04:07', NULL, NULL, 0, 980, NULL, NULL, 10888.9, NULL),
(11, 73, 'RUBEN RAMOS', '2023-05-09 08:34:18', '6KM. ISABELA CITY', 'Driver Name 1', 'ABC123', 980, 900, NULL, 0, 0, 'Produced', 'DE45', '2023-05-09', NULL, '2023-05-09', '2023-05-09 08:34:25', NULL, NULL, 0, 8178, NULL, NULL, 834.49, NULL),
(12, 76, 'JOEL AMAHAN', '2023-05-11 01:30:35', 'BOHE SAPA', 'Driver Name 1', '4335', 2069, 2000, NULL, 0, 0, 'Pressing', 'DE45', '2023-05-11', NULL, '2023-05-11', '2023-05-11 01:30:43', NULL, NULL, 0, 2030, NULL, NULL, 98.115, NULL);

--
-- Triggers `planta_recording`
--
DELIMITER $$
CREATE TRIGGER `after_planta_recording_insert` AFTER UPDATE ON `planta_recording` FOR EACH ROW BEGIN
    INSERT INTO `planta_recording_logs` (`recording_id`, `purchased_id`, `supplier`, `receiving_date`, `location`, `driver`, `truck_num`, `weight`, `reweight`, `cost`, `total_cost`, `status`, `lot_num`, `milling_date`, `drying_date`, `pressing_date`, `production_date`, `completion_date`, `selling_date`, `crumbed_weight`, `produce_total_weight`, `cost_ave`, `dry_weight`, `drc`,`cuplump_remaining_weight`)
    VALUES (NEW.recording_id, NEW.purchased_id, NEW.supplier, NEW.receiving_date, NEW.location, NEW.driver, NEW.truck_num, NEW.weight, NEW.reweight, NEW.cost, NEW.total_cost, NEW.status, NEW.lot_num, NEW.milling_date, NEW.drying_date, NEW.pressing_date, NEW.production_date, NEW.completion_date, NEW.selling_date, NEW.crumbed_weight, NEW.produce_total_weight, NEW.cost_ave, NEW.dry_weight, NEW.drc, NEW.cuplump_remaining_weight);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `planta_recording_logs`
--

CREATE TABLE `planta_recording_logs` (
  `planta_logs_id` int(11) NOT NULL,
  `recording_id` int(11) NOT NULL,
  `purchased_id` int(11) DEFAULT NULL,
  `supplier` varchar(255) DEFAULT NULL,
  `receiving_date` datetime DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `driver` varchar(255) DEFAULT NULL,
  `truck_num` varchar(255) DEFAULT NULL,
  `weight` int(11) DEFAULT NULL,
  `reweight` int(11) DEFAULT NULL,
  `cuplump_remaining_weight` decimal(10,2) DEFAULT NULL,
  `cost` int(11) DEFAULT NULL,
  `total_cost` int(11) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `lot_num` varchar(255) DEFAULT NULL,
  `milling_date` date DEFAULT NULL,
  `drying_date` date DEFAULT NULL,
  `pressing_date` date DEFAULT NULL,
  `production_date` datetime DEFAULT NULL,
  `completion_date` datetime DEFAULT NULL,
  `selling_date` datetime DEFAULT NULL,
  `crumbed_weight` int(11) NOT NULL,
  `produce_total_weight` float DEFAULT NULL,
  `cost_ave` float DEFAULT NULL,
  `dry_weight` int(11) DEFAULT NULL,
  `drc` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `planta_recording_logs`
--

INSERT INTO `planta_recording_logs` (`planta_logs_id`, `recording_id`, `purchased_id`, `supplier`, `receiving_date`, `location`, `driver`, `truck_num`, `weight`, `reweight`, `cuplump_remaining_weight`, `cost`, `total_cost`, `status`, `lot_num`, `milling_date`, `drying_date`, `pressing_date`, `production_date`, `completion_date`, `selling_date`, `crumbed_weight`, `produce_total_weight`, `cost_ave`, `dry_weight`, `drc`) VALUES
(31, 9, 17, 'NONONG FURIGAY', '2023-05-03 09:14:50', 'LAMITAN CITY', 'Driver Name 1', 'ABC123', 6360, 6300, NULL, 0, 0, 'Milling', 'DE45', '2023-05-03', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(32, 9, 17, 'NONONG FURIGAY', '2023-05-03 09:14:50', 'LAMITAN CITY', 'Driver Name 1', 'ABC123', 6360, 6300, NULL, 0, 0, 'Drying', 'DE45', '2023-05-03', NULL, NULL, '2023-05-03 09:14:57', NULL, NULL, 0, NULL, NULL, NULL, NULL),
(33, 9, 17, 'NONONG FURIGAY', '2023-05-03 09:14:50', 'LAMITAN CITY', 'Driver Name 1', 'ABC123', 6360, 6300, NULL, 0, 0, 'Pressing', 'DE45', '2023-05-03', NULL, '2023-05-03', '2023-05-03 09:14:57', NULL, NULL, 0, NULL, NULL, NULL, NULL),
(34, 11, 73, 'RUBEN RAMOS', '2023-05-09 08:34:18', '6KM. ISABELA CITY', 'Driver Name 1', 'ABC123', 980, 900, NULL, 0, 0, 'Milling', 'DE45', '2023-05-09', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(35, 11, 73, 'RUBEN RAMOS', '2023-05-09 08:34:18', '6KM. ISABELA CITY', 'Driver Name 1', 'ABC123', 980, 900, NULL, 0, 0, 'Drying', 'DE45', '2023-05-09', NULL, NULL, '2023-05-09 08:34:25', NULL, NULL, 0, NULL, NULL, NULL, NULL),
(36, 11, 73, 'RUBEN RAMOS', '2023-05-09 08:34:18', '6KM. ISABELA CITY', 'Driver Name 1', 'ABC123', 980, 900, NULL, 0, 0, 'Pressing', 'DE45', '2023-05-09', NULL, '2023-05-09', '2023-05-09 08:34:25', NULL, NULL, 0, NULL, NULL, NULL, NULL),
(37, 11, 73, 'RUBEN RAMOS', '2023-05-09 08:34:18', '6KM. ISABELA CITY', 'Driver Name 1', 'ABC123', 980, 900, NULL, 0, 0, 'Pressing', 'DE45', '2023-05-09', NULL, '2023-05-09', '2023-05-09 08:34:25', NULL, NULL, 0, 8178, NULL, NULL, 834.49),
(38, 11, 73, 'RUBEN RAMOS', '2023-05-09 08:34:18', '6KM. ISABELA CITY', 'Driver Name 1', 'ABC123', 980, 900, NULL, 0, 0, 'Produced', 'DE45', '2023-05-09', NULL, '2023-05-09', '2023-05-09 08:34:25', NULL, NULL, 0, 8178, NULL, NULL, 834.49),
(39, 9, 17, 'NONONG FURIGAY', '2023-05-03 09:14:50', 'LAMITAN CITY', 'Driver Name 1', 'ABC123', 6360, 6300, NULL, 0, 0, 'Pressing', 'DE45', '2023-05-03', NULL, '2023-05-03', '2023-05-03 09:14:57', NULL, NULL, 0, 1610, NULL, NULL, 25.3145),
(40, 9, 17, 'NONONG FURIGAY', '2023-05-03 09:14:50', 'LAMITAN CITY', 'Driver Name 1', 'ABC123', 6360, 6300, NULL, 0, 0, 'Pressing', 'DE45', '2023-05-03', NULL, '2023-05-03', '2023-05-03 09:14:57', NULL, NULL, 0, 2623.19, NULL, NULL, 41.2451),
(41, 9, 17, 'NONONG FURIGAY', '2023-05-03 09:14:50', 'LAMITAN CITY', 'Driver Name 1', 'ABC123', 6360, 6300, NULL, 0, 0, 'Pressing', 'DE45', '2023-05-03', NULL, '2023-05-03', '2023-05-03 09:14:57', NULL, NULL, 0, 2271.59, NULL, NULL, 35.7168),
(42, 9, 17, 'NONONG FURIGAY', '2023-05-03 09:14:50', 'LAMITAN CITY', 'Driver Name 1', 'ABC123', 6360, 6300, NULL, 0, 0, 'Pressing', 'DE45', '2023-05-03', NULL, '2023-05-03', '2023-05-03 09:14:57', NULL, NULL, 0, 15120, NULL, NULL, 237.736),
(43, 9, 17, 'NONONG FURIGAY', '2023-05-03 09:14:50', 'LAMITAN CITY', 'Driver Name 1', 'ABC123', 6360, 6300, NULL, 0, 0, 'Pressing', 'DE45', '2023-05-03', NULL, '2023-05-03', '2023-05-03 09:14:57', NULL, NULL, 0, 1750, NULL, NULL, 27.5157),
(44, 9, 17, 'NONONG FURIGAY', '2023-05-03 09:14:50', 'LAMITAN CITY', 'Driver Name 1', 'ABC123', 6360, 6300, NULL, 0, 0, 'Pressing', 'DE45', '2023-05-03', NULL, '2023-05-03', '2023-05-03 09:14:57', NULL, NULL, 0, 2555, NULL, NULL, 40.173),
(45, 9, 17, 'NONONG FURIGAY', '2023-05-03 09:14:50', 'LAMITAN CITY', 'Driver Name 1', 'ABC123', 6360, 6300, NULL, 0, 0, 'Produced', 'DE45', '2023-05-03', NULL, '2023-05-03', '2023-05-03 09:14:57', NULL, NULL, 0, 2555, NULL, NULL, 40.173),
(46, 10, 72, 'NENETH COSTAN', '2023-05-04 13:54:16', 'TABIAWAN, ISABELA CITY', 'Driver Name 1', 'ABC123', 9, 23, NULL, 0, 0, 'Milling', 'DE45', '2023-05-09', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(47, 10, 72, 'NENETH COSTAN', '2023-05-04 13:54:16', 'TABIAWAN, ISABELA CITY', 'Driver Name 1', 'ABC123', 9, 23, NULL, 0, 0, 'Drying', 'DE45', '2023-05-09', NULL, NULL, '2023-05-09 09:04:07', NULL, NULL, 0, NULL, NULL, NULL, NULL),
(48, 10, 72, 'NENETH COSTAN', '2023-05-04 13:54:16', 'TABIAWAN, ISABELA CITY', 'Driver Name 1', 'ABC123', 9, 23, NULL, 0, 0, 'Pressing', 'DE45', '2023-05-09', NULL, '2023-05-09', '2023-05-09 09:04:07', NULL, NULL, 0, NULL, NULL, NULL, NULL),
(49, 10, 72, 'NENETH COSTAN', '2023-05-04 13:54:16', 'TABIAWAN, ISABELA CITY', 'Driver Name 1', 'ABC123', 9, 23, NULL, 0, 0, 'Pressing', 'DE45', '2023-05-09', NULL, '2023-05-09', '2023-05-09 09:04:07', NULL, NULL, 0, 980, NULL, NULL, 10888.9),
(50, 10, 72, 'NENETH COSTAN', '2023-05-04 13:54:16', 'TABIAWAN, ISABELA CITY', 'Driver Name 1', 'ABC123', 9, 23, NULL, 0, 0, 'Pressing', 'DE45', '2023-05-09', NULL, '2023-05-09', '2023-05-09 09:04:07', NULL, NULL, 0, 980, NULL, NULL, 10888.9),
(51, 12, 76, 'JOEL AMAHAN', '2023-05-11 01:30:35', 'BOHE SAPA', 'Driver Name 1', '4335', 2069, 2000, NULL, 0, 0, 'Milling', 'DE45', '2023-05-11', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(52, 12, 76, 'JOEL AMAHAN', '2023-05-11 01:30:35', 'BOHE SAPA', 'Driver Name 1', '4335', 2069, 2000, NULL, 0, 0, 'Drying', 'DE45', '2023-05-11', NULL, NULL, '2023-05-11 01:30:43', NULL, NULL, 0, NULL, NULL, NULL, NULL),
(53, 12, 76, 'JOEL AMAHAN', '2023-05-11 01:30:35', 'BOHE SAPA', 'Driver Name 1', '4335', 2069, 2000, NULL, 0, 0, 'Pressing', 'DE45', '2023-05-11', NULL, '2023-05-11', '2023-05-11 01:30:43', NULL, NULL, 0, NULL, NULL, NULL, NULL),
(54, 12, 76, 'JOEL AMAHAN', '2023-05-11 01:30:35', 'BOHE SAPA', 'Driver Name 1', '4335', 2069, 2000, NULL, 0, 0, 'Pressing', 'DE45', '2023-05-11', NULL, '2023-05-11', '2023-05-11 01:30:43', NULL, NULL, 0, 2030, NULL, NULL, 98.115);

-- --------------------------------------------------------

--
-- Table structure for table `planta_seller`
--

CREATE TABLE `planta_seller` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `loc` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `planta_seller`
--

INSERT INTO `planta_seller` (`id`, `name`, `address`, `contact`, `loc`) VALUES
(2, 'Ronald Dale', 'Lamitan', '09352232051', NULL),
(2, 'Ronald Dale', 'Lamitan', '09352232051', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_category`
--

CREATE TABLE `purchase_category` (
  `id` int(11) NOT NULL,
  `category` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchase_category`
--

INSERT INTO `purchase_category` (`id`, `category`) VALUES
(1, 'COPRA'),
(2, 'WET RUBBER'),
(3, 'BALES'),
(4, 'COFFEE BEANS'),
(5, 'COFFEE BERRIES');

-- --------------------------------------------------------

--
-- Table structure for table `rubber_bales_sales`
--

CREATE TABLE `rubber_bales_sales` (
  `sale_id` int(11) NOT NULL,
  `ship_date` int(11) NOT NULL,
  `sale_type` int(11) NOT NULL,
  `sale_buyer` int(11) NOT NULL,
  `sale_destination` int(11) NOT NULL,
  `total_weight` int(11) NOT NULL,
  `sales` int(11) NOT NULL,
  `net_gain` int(11) NOT NULL,
  `amount_unpaid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `rubber_cashadvance`
--

CREATE TABLE `rubber_cashadvance` (
  `id` int(11) NOT NULL,
  `seller` varchar(255) NOT NULL,
  `amount` float NOT NULL,
  `category` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `loc` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rubber_cashadvance`
--

INSERT INTO `rubber_cashadvance` (`id`, `seller`, `amount`, `category`, `date`, `type`, `loc`) VALUES
(1, 'RASHID AMILIN', 528809, 'Rubber', '2022-10-27', 'BALES', 'Basilan'),
(2, 'NENETH COSTAN', 182844, 'Rubber', '2022-10-27', 'BALES', 'Basilan'),
(3, 'NENETH COSTAN', 131365, 'Rubber', '2022-10-27', 'BALES', 'Basilan'),
(4, 'NENETH COSTAN', 564824, 'Rubber', '2022-10-27', 'BALES', 'Basilan'),
(5, 'RASHID AMILIN', 0, 'Rubber', '2022-10-27', 'BALES', 'Basilan'),
(6, 'NENETH COSTAN', 0, 'Rubber', '2022-10-27', 'BALES', 'Basilan'),
(7, 'NENETH COSTAN', 0, 'Rubber', '2022-10-27', 'BALES', 'Basilan'),
(8, 'NENETH COSTAN', 136838, 'Rubber', '2022-10-27', 'BALES', 'Basilan'),
(9, 'TANY SULAYMAN', 576087, 'Rubber', '2022-10-28', 'BALES', 'Basilan'),
(10, 'EPIGIL MOLEJE', 50000, 'Rubber', '2022-10-28', 'BALES', 'Basilan'),
(11, 'NENETH COSTAN', 60042.5, 'Rubber', '2022-10-28', 'BALES', 'Basilan'),
(12, 'JESSICA EISMA FLOREZ', 280000, 'Rubber', '2022-10-29', 'WET', 'Basilan'),
(13, 'JESSICA EISMA FLOREZ', 0, 'Rubber', '2022-10-29', 'WET', 'Basilan'),
(14, 'JESSICA EISMA FLOREZ', 50000, 'Rubber', '2022-10-29', 'WET', 'Basilan'),
(15, 'JESSICA EISMA FLOREZ', 0, 'Rubber', '2022-10-29', 'WET', 'Basilan'),
(16, 'PLANTATION', 500000, 'Rubber', '2022-10-31', 'WET', 'Basilan'),
(17, 'PLANTATION', 0, 'Rubber', '2022-10-31', 'WET', 'Basilan'),
(18, 'EPIGIL MOLEJE', 100000, 'Rubber', '2022-11-03', 'BALES', 'Basilan'),
(19, 'NENETH COSTAN', 157215, 'Rubber', '2022-11-03', 'BALES', 'Basilan'),
(20, 'RONIE VILDAD', 214532, 'Rubber', '2022-11-03', 'BALES', 'Basilan'),
(21, 'LITO PURI', 100000, 'Rubber', '2022-11-09', 'BALES', 'Basilan'),
(22, 'TANY SULAYMAN', 0, 'Rubber', '2022-11-09', 'BALES', 'Basilan'),
(23, 'TANY SULAYMAN', 565911, 'Rubber', '2022-11-09', 'BALES', 'Basilan'),
(24, 'NENETH COSTAN', 0, 'Rubber', '2022-11-10', 'BALES', 'Basilan'),
(25, 'NENETH COSTAN', 195356, 'Rubber', '2022-11-10', 'BALES', 'Basilan'),
(26, 'SAMAN AWALIN', 792948, 'Rubber', '2022-11-14', 'BALES', 'Basilan'),
(27, 'RONIE VILDAD', 170258, 'Rubber', '2022-11-14', 'BALES', 'Basilan'),
(28, 'JIMROY MCCLINTOCK', 150000, 'Rubber', '2022-11-15', 'BALES', 'Basilan'),
(29, 'NENETH COSTAN', 172466, 'Rubber', '2022-11-15', 'BALES', 'Basilan'),
(30, 'EPIGIL MOLEJE', 50000, 'Rubber', '2022-11-21', 'BALES', 'Basilan'),
(31, 'ALIPIO', 140000, 'Rubber', '2022-11-21', 'BALES', 'Basilan'),
(32, 'LEE BROWN', 200000, 'Rubber', '2022-11-22', 'WET', 'Basilan'),
(33, 'RUBEN RAMOS', 100000, 'Rubber', '2022-11-23', 'WET', 'Basilan'),
(34, 'RONIE VILDAD', 0, 'Rubber', '2022-11-24', 'BALES', 'Basilan'),
(35, 'RONIE VILDAD', 170258, 'Rubber', '2022-11-24', 'BALES', 'Basilan'),
(36, 'RONIE VILDAD', 90714, 'Rubber', '2022-11-24', 'BALES', 'Basilan'),
(37, 'RONIE VILDAD', 183196, 'Rubber', '2022-11-24', 'BALES', 'Basilan'),
(38, 'RONIE VILDAD', 135266, 'Rubber', '2022-11-24', 'BALES', 'Basilan'),
(39, 'RONIE VILDAD', 34416, 'Rubber', '2022-11-24', 'BALES', 'Basilan'),
(40, 'RONIE VILDAD', 158928, 'Rubber', '2022-11-24', 'BALES', 'Basilan'),
(41, 'RONIE VILDAD', 68855, 'Rubber', '2022-11-24', 'BALES', 'Basilan'),
(42, 'RONIE VILDAD', 31043.5, 'Rubber', '2022-11-24', 'BALES', 'Basilan'),
(43, 'RONIE VILDAD', 170258, 'Rubber', '2022-11-24', 'BALES', 'Basilan'),
(44, 'RONIE VILDAD', 177146, 'Rubber', '2022-11-24', 'BALES', 'Basilan'),
(45, 'JIMROY MCCLINTOCK', 100000, 'Rubber', '2022-11-25', 'BALES', 'Basilan'),
(46, 'LITO PURI', 0, 'Rubber', '2022-11-25', 'BALES', 'Basilan'),
(47, 'JUN  MCCLINTOCK', 150000, 'Rubber', '2022-11-25', 'BALES', 'Basilan'),
(48, 'JIMROY MCCLINTOCK', 100000, 'Rubber', '2022-11-25', 'BALES', 'Basilan'),
(49, 'JIMROY MCCLINTOCK', 100000, 'Rubber', '2022-11-26', 'BALES', 'Basilan'),
(50, 'ARCO', 100000, 'Rubber', '2022-11-29', 'BALES', 'Basilan'),
(51, 'RUBEN RAMOS', 30000, 'Rubber', '2022-12-01', 'BALES', 'Basilan'),
(52, 'RUBEN RAMOS', 0, 'Rubber', '2022-12-01', 'BALES', 'Basilan'),
(53, 'RUBEN RAMOS', 0, 'Rubber', '2022-12-01', 'WET', 'Basilan'),
(54, 'RUBEN RAMOS', 0, 'Rubber', '2022-12-01', 'BALES', 'Basilan'),
(55, 'RUBEN RAMOS', 90000, 'Rubber', '2022-12-01', 'BALES', 'Basilan'),
(56, 'LOUIE DELOS REYES', 150000, 'Rubber', '2022-12-01', 'BALES', 'Basilan'),
(57, 'LOUIE DELOS REYES', 3181, 'Rubber', '2022-12-01', 'BALES', 'Basilan'),
(58, 'LOUIE DELOS REYES', 150000, 'Rubber', '2022-12-01', 'BALES', 'Basilan'),
(59, 'LEE BROWN', 58918, 'Rubber', '2022-12-02', 'WET', 'Basilan'),
(60, 'RONIE VILDAD', 218937, 'Rubber', '2022-12-05', 'BALES', 'Basilan'),
(61, 'RONIE VILDAD', 174504, 'Rubber', '2022-12-05', 'BALES', 'Basilan'),
(62, 'LOUIE DELOS REYES', 50000, 'Rubber', '2022-12-06', 'BALES', 'Basilan'),
(63, 'JUN  MCCLINTOCK', 150000, 'Rubber', '2022-12-07', 'BALES', 'Basilan'),
(64, 'LOUIE DELOS REYES', 50000, 'Rubber', '2022-12-07', 'BALES', 'Basilan'),
(65, 'EPIGIL MOLEJE', 60000, 'Rubber', '2022-12-07', 'BALES', 'Basilan'),
(66, 'NENETH COSTAN', 217398, 'Rubber', '2022-12-13', 'BALES', 'Basilan'),
(67, 'NENETH COSTAN', 103353, 'Rubber', '2022-12-13', 'BALES', 'Basilan'),
(68, 'NENETH COSTAN', 366506, 'Rubber', '2022-12-13', 'BALES', 'Basilan'),
(69, 'NENETH COSTAN', 321644, 'Rubber', '2022-12-13', 'BALES', 'Basilan'),
(70, 'NENETH COSTAN', 102601, 'Rubber', '2022-12-13', 'BALES', 'Basilan'),
(71, 'NENETH COSTAN', 296664, 'Rubber', '2022-12-13', 'BALES', 'Basilan'),
(72, 'NENETH COSTAN', 262706, 'Rubber', '2022-12-13', 'BALES', 'Basilan'),
(73, 'NENETH COSTAN', 119709, 'Rubber', '2022-12-13', 'BALES', 'Basilan'),
(74, 'NENETH COSTAN', 119709, 'Rubber', '2022-12-13', 'BALES', 'Basilan'),
(75, 'NENETH COSTAN', 30981, 'Rubber', '2022-12-13', 'BALES', 'Basilan'),
(76, 'NENETH COSTAN', 30981, 'Rubber', '2022-12-13', 'BALES', 'Basilan'),
(77, 'NENETH COSTAN', 30061, 'Rubber', '2022-12-13', 'BALES', 'Basilan'),
(78, 'NENETH COSTAN', 411148, 'Rubber', '2022-12-13', 'BALES', 'Basilan'),
(79, 'JIMROY MCCLINTOCK', 150000, 'Rubber', '2022-12-13', 'BALES', 'Basilan'),
(80, 'LOUIE DELOS REYES', 305857, 'Rubber', '2022-12-14', 'BALES', 'Basilan'),
(81, 'LOUIE DELOS REYES', 59527, 'Rubber', '2022-12-14', 'BALES', 'Basilan'),
(82, 'LOUIE DELOS REYES', 153411, 'Rubber', '2022-12-16', 'BALES', 'Basilan'),
(83, 'LOUIE DELOS REYES', 102446, 'Rubber', '2022-12-16', 'BALES', 'Basilan'),
(84, 'KIM AWALIN', 579410, 'Rubber', '2022-12-20', 'BALES', 'Basilan'),
(85, 'SAMAN AWALIN', 1353560, 'Rubber', '2022-12-20', 'BALES', 'Basilan'),
(86, 'RONIE VILDAD', 114840, 'Rubber', '2022-12-28', 'BALES', 'Basilan'),
(87, 'RONIE VILDAD', 104447, 'Rubber', '2022-12-28', 'BALES', 'Basilan'),
(88, 'RUBEN RAMOS', 100000, 'Rubber', '2022-12-28', 'BALES', 'Basilan'),
(89, 'EPIGIL MOLEJE', 100000, 'Rubber', '2022-12-30', 'BALES', 'Basilan'),
(90, 'JIMROY MCCLINTOCK', 150000, 'Rubber', '2022-12-30', 'BALES', 'Basilan'),
(91, 'LEE BROWN', 200000, 'Rubber', '2022-12-31', 'WET', 'Basilan'),
(92, 'LOUIE DELOS REYES', 102390, 'Rubber', '2023-01-05', 'BALES', 'Basilan'),
(93, 'JUN  MCCLINTOCK', 100000, 'Rubber', '2023-01-05', 'BALES', 'Basilan'),
(94, 'JUN  MCCLINTOCK', 140000, 'Rubber', '2023-01-05', 'BALES', 'Basilan'),
(95, 'HARI SABTAL', 517320, 'Rubber', '2023-01-05', 'BALES', 'Basilan'),
(96, 'JIMROY MCCLINTOCK', 100000, 'Rubber', '2023-01-06', 'BALES', 'Basilan'),
(97, 'EPIGIL MOLEJE', 50000, 'Rubber', '2023-01-09', 'BALES', 'Basilan'),
(98, 'LOUIE DELOS REYES', 100000, 'Rubber', '2023-01-09', 'BALES', 'Basilan'),
(99, 'LOUIE DELOS REYES', 102460, 'Rubber', '2023-01-09', 'BALES', 'Basilan'),
(100, 'LOUIE DELOS REYES', 102460, 'Rubber', '2023-01-10', 'BALES', 'Basilan'),
(101, 'TANY SULAYMAN', 600730, 'Rubber', '2023-01-10', 'BALES', 'Basilan'),
(102, 'EPIGIL MOLEJE', 120000, 'Rubber', '2023-01-16', 'BALES', 'Basilan'),
(103, 'TANY SULAYMAN', 602940, 'Rubber', '2023-01-16', 'BALES', 'Basilan'),
(104, 'TANY SULAYMAN', 349700, 'Rubber', '2023-01-16', 'BALES', 'Basilan'),
(105, 'RUBEN RAMOS', 30000, 'Rubber', '2023-01-19', 'BALES', 'Basilan'),
(106, 'ronald', 5000, 'copra', '2023-01-20', 'WET', 'Basilan'),
(107, 'AREVALO', 10000, 'Rubber', '2023-01-20', 'WET', 'Basilan'),
(138, 'JIMROY MCCLINTOCK', 100000, 'Rubber', '2023-01-21', 'BALES', 'Basilan'),
(139, 'LOUIE DELOS REYES', 101778, 'Rubber', '2023-01-23', 'BALES', 'Basilan'),
(140, 'TUWA', 295031, 'Rubber', '2023-01-23', 'BALES', 'Basilan'),
(141, 'EPIGIL MOLEJE', 100000, 'Rubber', '2023-01-24', 'BALES', 'Basilan'),
(142, 'RONIE VILDAD', 72404, 'Rubber', '2023-01-30', 'BALES', 'Basilan'),
(143, 'RONIE VILDAD', 71024, 'Rubber', '2023-01-30', 'BALES', 'Basilan'),
(144, 'JIMROY MCCLINTOCK', 100000, 'Rubber', '2023-01-31', 'BALES', 'Basilan'),
(145, 'LEE BROWN', 200000, 'Rubber', '2023-02-01', 'BALES', 'Basilan'),
(146, 'SAMAN AWALIN', 1219520, 'Rubber', '2023-02-03', 'BALES', 'Basilan'),
(147, 'LOUIE DELOS REYES', 235182, 'Rubber', '2023-02-07', 'BALES', 'Basilan'),
(148, 'JIMROY MCCLINTOCK', 100000, 'Rubber', '2023-02-08', 'BALES', 'Basilan'),
(149, 'EPIGIL MOLEJE', 50000, 'Rubber', '2023-02-08', 'BALES', 'Basilan'),
(150, 'JUN  MCCLINTOCK', 150000, 'Rubber', '2023-02-08', 'BALES', 'Basilan'),
(151, 'SAMAN AWALIN', 815623, 'Rubber', '2023-02-09', 'BALES', 'Basilan'),
(152, 'JIMROY MCCLINTOCK', 100000, 'Rubber', '2023-02-15', 'BALES', 'Basilan'),
(153, 'ESMERALDO', 200000, 'Rubber', '2023-02-16', 'WET', 'Basilan'),
(154, 'LOUIE DELOS REYES', 102275, 'Rubber', '2023-02-16', 'BALES', 'Basilan'),
(155, 'JIMROY MCCLINTOCK', 100000, 'Rubber', '2023-02-22', 'BALES', 'Basilan'),
(156, 'JAMES TAN', 300000, 'Rubber', '2023-02-24', 'BALES', 'Basilan'),
(157, 'JIMROY MCCLINTOCK', 150000, 'Rubber', '2023-03-02', 'BALES', 'Basilan'),
(158, 'JESSICA EISMA FLOREZ', 50000, 'Rubber', '2023-03-02', 'BALES', 'Basilan'),
(159, 'RUBEN RAMOS', 30000, 'Rubber', '2023-03-04', 'BALES', 'Basilan'),
(160, 'LEE BROWN', 200000, 'Rubber', '2023-03-07', 'WET', 'Basilan'),
(161, 'JIMROY MCCLINTOCK', 50000, 'Rubber', '2023-03-13', 'WET', 'Basilan'),
(162, 'JIMROY MCCLINTOCK', 50000, 'Rubber', '2023-03-13', 'BALES', 'Basilan'),
(163, 'NENETH COSTAN', 500000, 'Rubber', '2023-03-17', 'BALES', 'Basilan'),
(164, 'LONG2X SAN JUAN', 400551, 'Rubber', '2023-03-17', 'BALES', 'Basilan'),
(165, 'ESMERALDO', 150000, 'Rubber', '2023-03-18', 'WET', 'Basilan'),
(166, 'LONG2X SAN JUAN', 251240, 'Rubber', '2023-03-20', 'BALES', 'Basilan'),
(167, 'NENETH COSTAN', 278590, 'Rubber', '2023-03-21', 'BALES', 'Basilan'),
(168, 'RONIE VILDAD', 145579, 'Rubber', '2023-03-23', 'BALES', 'Basilan'),
(169, 'TATA HALAL', 63369, 'Rubber', '2023-03-27', 'BALES', 'Basilan'),
(170, 'JIMROY MCCLINTOCK', 100000, 'Rubber', '2023-03-29', 'BALES', 'Basilan'),
(171, 'ARCO', 100000, 'Rubber', '2023-03-30', 'WET', 'Basilan'),
(172, 'LOUIE DELOS REYES', 200000, 'Rubber', '2023-04-10', 'WET', 'Basilan'),
(173, 'JESSICA EISMA FLOREZ', 30000, 'Rubber', '2023-04-13', 'WET', 'Basilan'),
(174, 'JERRY ARIERO', 70000, 'Rubber', '2023-04-13', 'BALES', 'Basilan'),
(175, 'JIMROY MCCLINTOCK', 100000, 'Rubber', '2023-04-14', 'BALES', 'Basilan'),
(176, 'JARWIN GARCIA', 121000, 'Rubber', '2023-04-17', 'BALES', 'Basilan'),
(177, 'JARWIN GARCIA', 284750, 'Rubber', '2023-04-18', 'BALES', 'Basilan'),
(178, 'TATA HALAL', 20000, 'Rubber', '2023-04-21', 'BALES', 'Basilan'),
(179, 'JIMROY MCCLINTOCK', 110000, 'Rubber', '2023-04-22', 'BALES', 'Basilan'),
(180, 'JARWIN GARCIA', 130750, 'Rubber', '2023-04-28', 'BALES', 'Basilan'),
(181, 'ARCO', 150000, 'Rubber', '2023-04-29', 'WET', 'Basilan'),
(182, 'JARWIN GARCIA', 175750, 'Rubber', '2023-05-03', 'BALES', 'Basilan'),
(183, 'DANNY BARANDINO', 70926, 'Rubber', '2023-05-03', 'BALES', 'Basilan');

-- --------------------------------------------------------

--
-- Table structure for table `rubber_contract`
--

CREATE TABLE `rubber_contract` (
  `id` int(11) NOT NULL,
  `contract_no` varchar(255) NOT NULL,
  `seller` varchar(255) NOT NULL,
  `contract_quantity` float NOT NULL,
  `delivered` float NOT NULL,
  `balance` float NOT NULL,
  `date` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `status` varchar(10) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `loc` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rubber_contract`
--

INSERT INTO `rubber_contract` (`id`, `contract_no`, `seller`, `contract_quantity`, `delivered`, `balance`, `date`, `price`, `status`, `type`, `loc`) VALUES
(13, '2023-001', 'CHARLIE CAWLEY', 10000, 0, 10000, '2023-01-20', 48, 'PENDING', 'BALES', 'Basilan');

-- --------------------------------------------------------

--
-- Table structure for table `rubber_seller`
--

CREATE TABLE `rubber_seller` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `cash_advance` float DEFAULT NULL,
  `bales_cash_advance` float DEFAULT NULL,
  `loc` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rubber_seller`
--

INSERT INTO `rubber_seller` (`id`, `name`, `address`, `contact`, `cash_advance`, `bales_cash_advance`, `loc`) VALUES
(2, 'RUBEN RAMOS', '6KM. ISABELA CITY', '', 0, 0, 'Basilan'),
(3, 'RASHID AMILIN', 'SAYUGAN, LAMITAN CITY', '', 0, 0, 'Basilan'),
(4, 'NENETH COSTAN', 'TABIAWAN, ISABELA CITY', '', 0, -278590, 'Basilan'),
(5, 'AREVALO', 'COLONIA, LAMITAN CITY', '', 10000, NULL, 'Basilan'),
(6, 'TANY SULAYMAN', 'SAYUGAN, LAMITAN CITY', '', NULL, -349700, 'Basilan'),
(7, 'EPIGIL MOLEJE', 'MALOONG SAN JOSE, LAMITAN CITY', '', 0, 0, 'Basilan'),
(8, 'JESSICA EISMA FLOREZ', 'LAMITAN CITY', '', 0, 0, 'Basilan'),
(9, 'PLANTATION', 'MALOONG CANAL', '', 500000, NULL, 'Basilan'),
(10, 'LEE BROWN', '', 'PANUNSULAN, ISABELA CITY', 0, 400000, 'Basilan'),
(11, 'LEE BROWN', '', 'PANUNSULAN, ISABELA CITY', 0, 400000, 'Basilan'),
(12, 'RONIE VILDAD', 'MALOONG, LAMITAN CITY', '', NULL, -145579, 'Basilan'),
(13, 'JAMES TAN', 'ISABELA CITY', '', 0, -300000, 'Basilan'),
(14, 'LITO PURI', 'lamitan', '', NULL, 0, 'Basilan'),
(15, 'SAMAN AWALIN', 'SAYUGAN, LAMITAN CITY', '', NULL, -815623, 'Basilan'),
(16, 'JIMROY MCCLINTOCK', 'MALOONG, LAMITAN CITY', '', 0, -100000, 'Basilan'),
(17, 'ALIPIO', 'LOOK, LAMITAN CITY', '', 0, -140000, 'Basilan'),
(18, 'NONONG FURIGAY', 'LAMITAN CITY', '', 0, NULL, 'Basilan'),
(19, 'KENNYBELL FLOREZ', 'LI-MOOK, LAMITAN CITY', '', 0, NULL, 'Basilan'),
(20, 'RENZ MEDINA', 'BUAHAN, LAMITAN CITY', '', 0, NULL, 'Basilan'),
(21, 'BINSYO', 'BUAHAN, LAMITAN CITY', '', 0, NULL, 'Basilan'),
(22, 'DONGGA/ERIC ENRIQUEZ', 'BUAHAN, LAMITAN CITY', '', 0, NULL, 'Basilan'),
(23, 'LEE BROWN', 'PANUNSULAN, ISABELA CITY', '', 0, 400000, 'Basilan'),
(24, 'CHARLIE CAWLEY', 'LAMITAN CITY', '', NULL, 0, 'Basilan'),
(25, 'JUN  MCCLINTOCK', 'BINUANGAN, ISABELA CITY', '', NULL, -150000, 'Basilan'),
(26, 'JOEL AMAHAN', 'BOHE SAPA', '', 0, NULL, 'Basilan'),
(27, 'ARCO', 'ARCO, LAMITAN CITY', '', 0, 0, 'Basilan'),
(28, 'LOUIE DELOS REYES', 'PANUNSULAN, ISABELA CITY', '', 0, -102275, 'Basilan'),
(29, 'KIM AWALIN', 'SAYUGAN, LAMITAN CITY', '', NULL, -579410, 'Basilan'),
(30, 'AMIN ABUBAKAR', 'TUBURAN', '', 0, NULL, 'Basilan'),
(31, 'HARI SABTAL', 'SAYUGAN, LAMITAN CITY', '', NULL, -517320, 'Basilan'),
(32, 'SANDRA DUMDUM', 'LAMITAN CITY', '', 0, NULL, 'Basilan'),
(33, 'INFANTE', 'ISABELA CITY', '', 0, NULL, 'Basilan'),
(34, 'CRISTOPHER CENIZA', 'ISABELA CITY', '', 0, NULL, 'Basilan'),
(35, 'ronald', '', '', 5000, NULL, 'Basilan'),
(36, 'FRANCINE', 'BUAHAN, LAMITAN CITY', '', 0, NULL, 'Basilan'),
(37, 'TUWA', 'LAMITAN CITY', '', NULL, -295031, 'Basilan'),
(38, 'ESMERALDO', 'ISABELA CITY', '', 0, NULL, 'Basilan'),
(39, 'LONG2X SAN JUAN', 'LAMITAN CITY', '', NULL, -251240, 'Basilan'),
(40, 'TATA HALAL', 'BULINGAN, LAMITAN CITY', '', NULL, -20000, 'Basilan'),
(41, 'JERRY ARIERO', 'ULAMI, LAMITAN CITY', '', 0, -80000, 'Basilan'),
(42, 'JARWIN GARCIA', 'CALVARIO, LAMITAN CITY', '', 0, -175750, 'Basilan'),
(43, 'JENG ENRIQUEZ', 'BUAHAN, LAMITAN CITY', '', 0, NULL, 'Basilan'),
(44, '', '', '', NULL, NULL, 'Basilan'),
(45, 'DANNY BARANDINO', 'ISABELA CITY', '', NULL, -70926, 'Basilan');

-- --------------------------------------------------------

--
-- Table structure for table `rubber_transaction`
--

CREATE TABLE `rubber_transaction` (
  `id` int(11) NOT NULL,
  `invoice` int(255) NOT NULL,
  `contract` varchar(200) NOT NULL,
  `date` varchar(200) NOT NULL,
  `seller` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `gross` float NOT NULL,
  `tare` float NOT NULL,
  `net_weight` float NOT NULL,
  `price_1` float NOT NULL,
  `price_2` float DEFAULT NULL,
  `total_weight_1` float NOT NULL,
  `total_weight_2` float NOT NULL,
  `total_amount` float DEFAULT NULL,
  `less` float DEFAULT NULL,
  `amount_paid` float NOT NULL,
  `amount_words` varchar(255) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `loc` varchar(255) DEFAULT NULL,
  `planta_status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rubber_transaction`
--

INSERT INTO `rubber_transaction` (`id`, `invoice`, `contract`, `date`, `seller`, `address`, `gross`, `tare`, `net_weight`, `price_1`, `price_2`, `total_weight_1`, `total_weight_2`, `total_amount`, `less`, `amount_paid`, `amount_words`, `type`, `loc`, `planta_status`) VALUES
(11, 1, 'SPOT', '2022-10-28', 'AREVALO', 'COLONIA, LAMITAN CITY', 3425, 0, 3425, 23, 0, 3425, 0, 78775, 0, 78775, 'Seventy Eight Thousand Seven Hundred Seventy Five Peso/s ', 'WET', 'Basilan', NULL),
(12, 2, 'SPOT', '2022-10-29', 'JESSICA EISMA FLOREZ', 'LAMITAN CITY', 3227, 0, 3227, 23, 0, 3227, 0, 74221, 0, 74221, 'Seventy Four Thousand Two Hundred Twenty One Peso/s ', 'WET', 'Basilan', NULL),
(13, 3, 'SPOT', '2022-10-31', 'PLANTATION', 'MALOONG CANAL', 20843, 0, 20843, 26.71, 0, 20843, 0, 556716, 0, 556716, 'Five Hundred Fifty Six Thousand Seven Hundred Sixteen Peso/s Pesos And Five Three Centavo/s ', 'WET', 'Basilan', NULL),
(14, 4, 'SPOT', '2022-10-31', 'LEE BROWN', '', 13854, 0, 13854, 23, 0, 13854, 0, 318642, 0, 318642, 'Three Hundred Eighteen Thousand Six Hundred Forty Two Peso/s ', 'WET', 'Basilan', NULL),
(15, 5, 'SPOT', '2022-10-31', 'LEE BROWN', '', 9071, 0, 9071, 23, 0, 9071, 0, 208633, 0, 208633, 'Two Hundred Eight Thousand Six Hundred Thirty Three Peso/s ', 'WET', 'Basilan', NULL),
(16, 16, 'SPOT', '2022-11-15', 'ALIPIO', 'LOOK, LAMITAN CITY', 1560, 0, 1560, 22, 0, 1560, 0, 34320, 0, 34320, 'Thirty Four Thousand Three Hundred Twenty Peso/s ', 'WET', 'Basilan', NULL),
(17, 17, 'SPOT', '2022-11-17', 'NONONG FURIGAY', 'LAMITAN CITY', 6360, 0, 6360, 30, 0, 6360, 0, 190800, 0, 190800, 'One Hundred Ninety Thousand Eight Hundred Peso/s ', 'WET', 'Basilan', NULL),
(19, 18, 'SPOT', '2022-11-17', 'KENNYBELL FLOREZ', 'LI-MOOK, LAMITAN CITY', 10623, 0, 10623, 23.65, 0, 10623, 0, 251233, 0, 251234, 'Two Hundred Fifty One Thousand Two Hundred Thirty Three Peso/s Pesos And Nine Five Centavo/s ', 'WET', 'Basilan', NULL),
(20, 20, 'SPOT', '2022-11-21', 'RENZ MEDINA', 'BUAHAN, LAMITAN CITY', 1098, 0, 1098, 22, 0, 1098, 0, 24156, 0, 24156, 'Twenty Four Thousand One Hundred Fifty Six Peso/s ', 'WET', 'Basilan', NULL),
(21, 21, 'SPOT', '2022-11-21', 'BINSYO', 'BUAHAN, LAMITAN CITY', 272, 0, 272, 22, 0, 272, 0, 5984, 0, 5984, 'Five Thousand Nine Hundred Eighty Four Peso/s ', 'WET', 'Basilan', NULL),
(22, 22, 'SPOT', '2022-11-21', 'DONGGA/ERIC ENRIQUEZ', 'BUAHAN, LAMITAN CITY', 4228, 0, 4228, 22.5, 0, 4228, 0, 95130, 0, 95130, 'Ninety Five Thousand One Hundred Thirty Peso/s ', 'WET', 'Basilan', NULL),
(23, 23, 'SPOT', '2022-11-22', 'LEE BROWN', '', 6134, 0, 6134, 23, 0, 6134, 0, 141082, 0, 141082, 'One Hundred Forty One Thousand Eighty Two Peso/s ', 'WET', 'Basilan', NULL),
(24, 24, 'SPOT', '2022-11-28', 'JOEL AMAHAN', 'BOHE SAPA', 3184, 0, 3184, 24, 0, 3184, 0, 76416, 0, 76416, 'Seventy Six Thousand Four Hundred Sixteen Peso/s ', 'WET', 'Basilan', NULL),
(25, 25, 'SPOT', '2022-11-29', 'ARCO', 'ARCO, LAMITAN CITY', 10582, 0, 10582, 23, 0, 10582, 0, 243386, 100000, 143386, 'One Hundred Forty Three Thousand Three Hundred Eighty Six Peso/s ', 'WET', 'Basilan', NULL),
(26, 26, 'SPOT', '2022-12-02', 'LEE BROWN', '', 7782, 0, 7782, 23, 0, 7782, 0, 178986, 0, 178986, 'One Hundred Seventy Eight Thousand Nine Hundred Eighty Six Peso/s ', 'WET', 'Basilan', NULL),
(27, 27, 'SPOT', '2022-12-06', 'NONONG FURIGAY', 'LAMITAN CITY', 7070, 0, 7070, 28, 0, 7070, 0, 197960, 0, 197960, 'One Hundred Ninety Seven Thousand Nine Hundred Sixty Peso/s ', 'WET', 'Basilan', NULL),
(28, 28, 'SPOT', '2022-12-07', 'JAMES TAN', 'ISABELA CITY', 22569, 0, 22569, 25, 0, 22569, 0, 564225, 0, 564225, 'Five Hundred Sixty Four Thousand Two Hundred Twenty Five Peso/s ', 'WET', 'Basilan', NULL),
(29, 29, 'SPOT', '2022-12-21', 'RENZ MEDINA', 'BUAHAN, LAMITAN CITY', 1001, 0, 1001, 22, 0, 1001, 0, 22022, 0, 22022, 'Twenty Two Thousand Twenty Two Peso/s ', 'WET', 'Basilan', NULL),
(30, 30, 'SPOT', '2022-12-30', 'PLANTATION', 'MALOONG CANAL', 32852, 0, 32852, 28, 0, 32852, 0, 919856, 0, 919856, 'Nine Hundred Nineteen Thousand Eight Hundred Fifty Six Peso/s ', 'WET', 'Basilan', NULL),
(31, 31, 'SPOT', '2022-12-30', 'AMIN ABUBAKAR', 'TUBURAN', 3720, 2520, 1200, 22, 0, 1200, 0, 26400, 0, 26400, 'Twenty Six Thousand Four Hundred Peso/s ', 'WET', 'Basilan', NULL),
(32, 32, 'SPOT', '2022-12-30', 'ARCO', 'ARCO, LAMITAN CITY', 10943, 0, 10943, 22.5, 0, 10943, 0, 246217, 100000, 146218, 'One Hundred Forty Six Thousand Two Hundred Seventeen Peso/s Pesos And Five Centavo/s ', 'WET', 'Basilan', NULL),
(33, 33, 'SPOT', '2022-12-31', 'LEE BROWN', '', 11480, 0, 11480, 23, 0, 11480, 0, 264040, 0, 264040, 'Two Hundred Sixty Four Thousand Forty Peso/s ', 'WET', 'Basilan', NULL),
(34, 34, 'SPOT', '2023-01-03', 'NONONG FURIGAY', 'LAMITAN CITY', 4515, 0, 4515, 30, 0, 4515, 0, 135450, 0, 135450, 'One Hundred Thirty Five Thousand Four Hundred Fifty Peso/s ', 'WET', 'Basilan', NULL),
(35, 35, 'SPOT', '2023-01-05', 'JAMES TAN', 'ISABELA CITY', 20487, 0, 20487, 26, 0, 20487, 0, 532662, 0, 532662, 'Five Hundred Thirty Two Thousand Six Hundred Sixty Two Peso/s ', 'WET', 'Basilan', NULL),
(36, 36, 'SPOT', '2023-01-07', 'SANDRA DUMDUM', 'LAMITAN CITY', 5435, 0, 5435, 25, 0, 5435, 0, 135875, 0, 135875, 'One Hundred Thirty Five Thousand Eight Hundred Seventy Five Peso/s ', 'WET', 'Basilan', NULL),
(37, 37, 'SPOT', '2023-01-17', 'INFANTE', 'ISABELA CITY', 29505, 0, 29505, 28.67, 0, 29505, 0, 845908, 0, 845908, 'Eight Hundred Forty Five Thousand Nine Hundred Eight Peso/s Pesos And Three Five Centavo/s ', 'WET', 'Basilan', NULL),
(38, 38, 'SPOT', '2023-01-17', 'CRISTOPHER CENIZA', 'ISABELA CITY', 39798, 0, 39798, 28.67, 0, 39798, 0, 1141010, 0, 1141010, 'One Million One Hundred Forty One Thousand Eight Peso/s Pesos And Six Six Centavo/s ', 'WET', 'Basilan', NULL),
(39, 39, 'SPOT', '2023-01-19', 'NONONG FURIGAY', 'LAMITAN CITY', 4315, 0, 4315, 30, 0, 4315, 0, 129450, 0, 129450, 'One Hundred Twenty Nine Thousand Four Hundred Fifty Peso/s ', 'WET', 'Basilan', NULL),
(40, 40, 'SPOT', '2023-01-21', 'DONGGA/ERIC ENRIQUEZ', 'BUAHAN, LAMITAN CITY', 3753, 0, 3753, 22, 0, 3753, 0, 82566, 0, 82566, 'Eighty Two Thousand Five Hundred Sixty Six Peso/s ', 'WET', 'Basilan', NULL),
(41, 41, 'SPOT', '2023-01-21', 'FRANCINE', 'BUAHAN, LAMITAN CITY', 544, 0, 544, 22, 0, 544, 0, 11968, 0, 11968, 'Eleven Thousand Nine Hundred Sixty Eight Peso/s ', 'WET', 'Basilan', NULL),
(42, 42, 'SPOT', '2023-01-24', 'AMIN ABUBAKAR', 'TUBURAN', 3590, 2520, 1070, 22.5, 0, 1070, 0, 24075, 0, 24075, 'Twenty Four Thousand Seventy Five Peso/s ', 'WET', 'Basilan', NULL),
(43, 43, 'SPOT', '2023-02-01', 'LEE BROWN', '', 11372, 0, 11372, 24, 0, 11372, 0, 272928, 200000, 72928, 'Seventy Two Thousand Nine Hundred Twenty Eight Peso/s ', 'WET', 'Basilan', NULL),
(44, 44, 'SPOT', '2023-02-01', 'NONONG FURIGAY', 'LAMITAN CITY', 3850, 0, 3850, 31, 0, 3850, 0, 119350, 0, 119350, 'One Hundred Nineteen Thousand Three Hundred Fifty Peso/s ', 'WET', 'Basilan', NULL),
(45, 45, 'SPOT', '2023-02-02', 'JOEL AMAHAN', 'BOHE SAPA', 2225, 0, 2225, 24, 0, 2225, 0, 53400, 0, 53400, 'Fifty Three Thousand Four Hundred Peso/s ', 'WET', 'Basilan', NULL),
(46, 46, 'SPOT', '2023-02-06', 'JAMES TAN', 'ISABELA CITY', 6818, 0, 6818, 27, 0, 6818, 0, 184086, 0, 184086, 'One Hundred Eighty Four Thousand Eighty Six Peso/s ', 'WET', 'Basilan', NULL),
(47, 47, 'SPOT', '2023-02-11', 'AMIN ABUBAKAR', 'TUBURAN', 1470, 0, 1470, 23, 0, 1470, 0, 33810, 0, 33810, 'Thirty Three Thousand Eight Hundred Ten Peso/s ', 'WET', 'Basilan', NULL),
(48, 48, 'SPOT', '2023-02-16', 'ESMERALDO', 'ISABELA CITY', 9015, 0, 9015, 27, 0, 9015, 0, 243405, 200000, 43405, 'Forty Three Thousand Four Hundred Five Peso/s ', 'WET', 'Basilan', NULL),
(49, 49, 'SPOT', '2023-02-16', 'NONONG FURIGAY', 'LAMITAN CITY', 3970, 0, 3970, 31, 0, 3970, 0, 123070, 0, 123070, 'One Hundred Twenty Three Thousand Seventy Peso/s ', 'WET', 'Basilan', NULL),
(50, 50, 'SPOT', '2023-03-01', 'NONONG FURIGAY', 'LAMITAN CITY', 2495, 0, 2495, 31, 0, 2495, 0, 77345, 0, 77345, 'Seventy Seven Thousand Three Hundred Forty Five Peso/s ', 'WET', 'Basilan', NULL),
(51, 51, 'SPOT', '2023-03-02', 'JOEL AMAHAN', 'BOHE SAPA', 2646, 0, 2646, 28, 0, 2646, 0, 74088, 0, 74088, 'Seventy Four Thousand Eighty Eight Peso/s ', 'WET', 'Basilan', NULL),
(52, 52, 'SPOT', '2023-03-02', 'JESSICA EISMA FLOREZ', 'LAMITAN CITY', 4598, 0, 4598, 26, 0, 4598, 0, 119548, 50000, 69548, 'Sixty Nine Thousand Five Hundred Forty Eight Peso/s ', 'WET', 'Basilan', NULL),
(53, 53, 'SPOT', '2023-03-06', 'JAMES TAN', 'ISABELA CITY', 20617, 0, 20617, 31, 0, 20617, 0, 639127, 0, 639127, 'Six Hundred Thirty Nine Thousand One Hundred Twenty Seven Peso/s ', 'WET', 'Basilan', NULL),
(54, 54, 'SPOT', '2023-03-07', 'LEE BROWN', '', 8829, 0, 8829, 25, 0, 8829, 0, 220725, 200000, 20725, 'Twenty Thousand Seven Hundred Twenty Five Peso/s ', 'WET', 'Basilan', NULL),
(55, 55, 'SPOT', '2023-03-11', 'AMIN ABUBAKAR', 'TUBURAN', 955, 0, 955, 25, 0, 955, 0, 23875, 0, 23875, 'Twenty Three Thousand Eight Hundred Seventy Five Peso/s ', 'WET', 'Basilan', NULL),
(56, 56, 'SPOT', '2023-03-18', 'ESMERALDO', 'ISABELA CITY', 6509, 0, 6509, 30, 0, 6509, 0, 195270, 150000, 45270, 'Forty Five Thousand Two Hundred Seventy Peso/s ', 'WET', 'Basilan', NULL),
(57, 57, 'SPOT', '2023-03-23', 'DONGGA/ERIC ENRIQUEZ', 'BUAHAN, LAMITAN CITY', 2690, 0, 2690, 24, 0, 2690, 0, 64560, 0, 64560, 'Sixty Four Thousand Five Hundred Sixty Peso/s ', 'WET', 'Basilan', NULL),
(58, 58, 'SPOT', '2023-03-23', 'FRANCINE', 'BUAHAN, LAMITAN CITY', 273, 0, 273, 24, 0, 273, 0, 6552, 0, 6552, 'Six Thousand Five Hundred Fifty Two Peso/s ', 'WET', 'Basilan', NULL),
(59, 59, 'SPOT', '2023-03-24', 'NONONG FURIGAY', 'LAMITAN CITY', 2700, 0, 2700, 30, 0, 2700, 0, 81000, 0, 81000, 'Eighty One Thousand Peso/s ', 'WET', 'Basilan', NULL),
(60, 60, 'SPOT', '2023-03-30', 'ARCO', 'ARCO, LAMITAN CITY', 7548, 0, 7548, 28, 0, 7548, 0, 211344, 100000, 111344, 'One Hundred Eleven Thousand Three Hundred Forty Four Peso/s ', 'WET', 'Basilan', NULL),
(61, 61, 'SPOT', '2023-03-31', 'LEE BROWN', '', 6625, 0, 6625, 28, 0, 6625, 0, 185500, 0, 185500, 'One Hundred Eighty Five Thousand Five Hundred Peso/s ', 'WET', 'Basilan', NULL),
(62, 62, 'SPOT', '2023-04-01', 'NONONG FURIGAY', 'LAMITAN CITY', 2235, 0, 2235, 31, 0, 2235, 0, 69285, 0, 69285, 'Sixty Nine Thousand Two Hundred Eighty Five Peso/s ', 'WET', 'Basilan', NULL),
(63, 63, 'SPOT', '2023-04-10', 'LOUIE DELOS REYES', 'PANUNSULAN, ISABELA CITY', 9256, 0, 9256, 30, 0, 9256, 0, 277680, 200000, 77680, 'Seventy Seven Thousand Six Hundred Eighty Peso/s ', 'WET', 'Basilan', NULL),
(64, 64, 'SPOT', '2023-04-12', 'JAMES TAN', 'ISABELA CITY', 19033, 0, 19033, 30, 0, 19033, 0, 570990, 0, 570990, 'Five Hundred Seventy Thousand Nine Hundred Ninety Peso/s ', 'WET', 'Basilan', NULL),
(65, 65, 'SPOT', '2023-04-13', 'JESSICA EISMA FLOREZ', 'LAMITAN CITY', 3695, 0, 3695, 25, 0, 3695, 0, 92375, 30000, 62375, 'Sixty Two Thousand Three Hundred Seventy Five Peso/s ', 'WET', 'Basilan', NULL),
(66, 66, 'SPOT', '2023-04-14', 'AMIN ABUBAKAR', 'TUBURAN', 1830, 0, 1830, 25.5, 0, 1830, 0, 46665, 0, 46665, 'Forty Six Thousand Six Hundred Sixty Five Peso/s ', 'WET', 'Basilan', NULL),
(67, 67, 'SPOT', '2023-04-21', 'NONONG FURIGAY', 'LAMITAN CITY', 2345, 0, 2345, 31, 0, 2345, 0, 72695, 0, 72695, 'Seventy Two Thousand Six Hundred Ninety Five Peso/s ', 'WET', 'Basilan', NULL),
(68, 68, 'SPOT', '2023-04-22', 'JENG ENRIQUEZ', 'BUAHAN, LAMITAN CITY', 429, 0, 429, 25, 0, 429, 0, 10725, 0, 10725, 'Ten Thousand Seven Hundred Twenty Five Peso/s ', 'WET', 'Basilan', NULL),
(69, 69, 'SPOT', '2023-04-22', 'DONGGA/ERIC ENRIQUEZ', 'BUAHAN, LAMITAN CITY', 1988, 0, 1988, 25, 0, 1988, 0, 49700, 0, 49700, 'Forty Nine Thousand Seven Hundred Peso/s ', 'WET', 'Basilan', NULL),
(70, 70, 'SPOT', '2023-04-29', 'ARCO', 'ARCO, LAMITAN CITY', 6915, 0, 6915, 28.5, 0, 6915, 0, 197077, 150000, 47077.5, 'Forty Seven Thousand Seventy Seven Peso/s Pesos And Five Centavo/s ', 'WET', 'Basilan', NULL),
(72, 71, 'SPOT', '2023-05-04', 'NONONG FURIGAY', 'LAMITAN CITY', 4175, 0, 4175, 31, 0, 4175, 0, 129425, 0, 129425, 'One Hundred Twenty Nine Thousand Four Hundred Twenty Five Peso/s ', 'WET', 'Basilan', NULL),
(73, 73, 'SPOT', '2023-05-04', 'NONONG FURIGAY', 'LAMITAN CITY', 2400, 0, 2400, 31, 0, 2400, 0, 74400, 0, 74400, 'Seventy Four Thousand Four Hundred Peso/s ', 'WET', 'Basilan', NULL),
(75, 74, 'SPOT', '2023-05-04', 'RASHID AMILIN', 'SAYUGAN, LAMITAN CITY', 2333, 23, 2310, 23, 0, 2310, 0, 53130, 0, 53130, 'Fifty Three Thousand One Hundred Thirty Peso/s ', 'WET', 'Basilan', 0),
(76, 76, 'SPOT', '2023-05-10', 'JOEL AMAHAN', 'BOHE SAPA', 2069, 0, 2069, 27, 0, 2069, 0, 55863, 0, 55863, 'Fifty Five Thousand Eight Hundred Sixty Three Peso/s ', 'WET', 'Basilan', 0);

-- --------------------------------------------------------

--
-- Table structure for table `sales_bales_rec`
--

CREATE TABLE `sales_bales_rec` (
  `sale_bales_id` int(50) NOT NULL,
  `sales_date` date DEFAULT NULL,
  `ship_date` date DEFAULT NULL,
  `sale_buyer` varchar(100) DEFAULT NULL,
  `van_no` varchar(50) DEFAULT NULL,
  `sale_type` varchar(50) DEFAULT NULL,
  `info_lading` varchar(100) DEFAULT NULL,
  `sale_destination` varchar(100) DEFAULT NULL,
  `voyage` varchar(50) DEFAULT NULL,
  `source` varchar(50) DEFAULT NULL,
  `vessel` varchar(50) DEFAULT NULL,
  `bale_quality` varchar(50) DEFAULT NULL,
  `number_bales` decimal(10,2) DEFAULT NULL,
  `bale_total_weight` decimal(10,2) DEFAULT NULL,
  `bale_average_per_kilo` decimal(10,2) DEFAULT NULL,
  `bale_kilo_price` decimal(10,2) DEFAULT NULL,
  `sale_currency` varchar(10) DEFAULT NULL,
  `exchange_rate` decimal(10,2) DEFAULT NULL,
  `ship_exp_freight` decimal(10,2) DEFAULT NULL,
  `ship_exp_loading` decimal(10,2) DEFAULT NULL,
  `ship_exp_processing` decimal(10,2) DEFAULT NULL,
  `ship_exp_trucking` decimal(10,2) DEFAULT NULL,
  `ship_exp_cranage` decimal(10,2) DEFAULT NULL,
  `ship_exp_misc` decimal(10,2) DEFAULT NULL,
  `sales_total` decimal(10,2) DEFAULT NULL,
  `total_bale_cost` decimal(10,2) DEFAULT NULL,
  `total_milling_cost` decimal(10,2) DEFAULT NULL,
  `milling_KiloCost` decimal(10,2) DEFAULT NULL,
  `milling_weight` decimal(10,2) DEFAULT NULL,
  `total_ship_exp` decimal(10,2) DEFAULT NULL,
  `total_number_bales` decimal(10,2) DEFAULT NULL,
  `net_gain` decimal(10,2) DEFAULT NULL,
  `payment_sales` decimal(10,2) DEFAULT NULL,
  `paid_total` decimal(10,2) DEFAULT NULL,
  `amount_unpaid` decimal(10,2) DEFAULT NULL,
  `pay_date` date DEFAULT NULL,
  `pay_details` varchar(100) DEFAULT NULL,
  `paid_amount` decimal(10,2) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `recorded_by` varchar(255) NOT NULL,
  `status` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales_bales_rec`
--

INSERT INTO `sales_bales_rec` (`sale_bales_id`, `sales_date`, `ship_date`, `sale_buyer`, `van_no`, `sale_type`, `info_lading`, `sale_destination`, `voyage`, `source`, `vessel`, `bale_quality`, `number_bales`, `bale_total_weight`, `bale_average_per_kilo`, `bale_kilo_price`, `sale_currency`, `exchange_rate`, `ship_exp_freight`, `ship_exp_loading`, `ship_exp_processing`, `ship_exp_trucking`, `ship_exp_cranage`, `ship_exp_misc`, `sales_total`, `total_bale_cost`, `total_milling_cost`, `milling_KiloCost`, `milling_weight`, `total_ship_exp`, `total_number_bales`, `net_gain`, `payment_sales`, `paid_total`, `amount_unpaid`, `pay_date`, `pay_details`, `paid_amount`, `notes`, `recorded_by`, `status`) VALUES
(1, '2023-05-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'dale', NULL),
(2, '2023-05-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'dale', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sales_bales_selected_inventory`
--

CREATE TABLE `sales_bales_selected_inventory` (
  `id` int(11) NOT NULL,
  `bales_prod_id` int(11) DEFAULT NULL,
  `sales_id` int(11) NOT NULL,
  `bales_number` int(11) DEFAULT NULL,
  `loc` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales_bales_selected_inventory`
--

INSERT INTO `sales_bales_selected_inventory` (`id`, `bales_prod_id`, `sales_id`, `bales_number`, `loc`) VALUES
(1, 9, 2, 20, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sales_cuplumps_rec`
--

CREATE TABLE `sales_cuplumps_rec` (
  `sale_id` int(50) NOT NULL,
  `sales_date` date DEFAULT NULL,
  `ship_date` date DEFAULT NULL,
  `sale_buyer` varchar(100) DEFAULT NULL,
  `van_no` varchar(50) DEFAULT NULL,
  `sale_type` varchar(50) DEFAULT NULL,
  `info_lading` varchar(100) DEFAULT NULL,
  `sale_destination` varchar(100) DEFAULT NULL,
  `voyage` varchar(50) DEFAULT NULL,
  `source` varchar(50) DEFAULT NULL,
  `vessel` varchar(50) DEFAULT NULL,
  `cuplumps_total_cost` decimal(10,2) DEFAULT NULL,
  `cuplumps_total_weight` decimal(10,2) DEFAULT NULL,
  `cuplumps_average_per_kilo` decimal(10,2) DEFAULT NULL,
  `sale_currency` varchar(10) DEFAULT NULL,
  `exchange_rate` decimal(10,2) DEFAULT NULL,
  `wet_kilo_price` decimal(10,2) DEFAULT NULL,
  `ship_exp_freight` decimal(10,2) DEFAULT NULL,
  `ship_exp_loading` decimal(10,2) DEFAULT NULL,
  `ship_exp_processing` decimal(10,2) DEFAULT NULL,
  `ship_exp_trucking` decimal(10,2) DEFAULT NULL,
  `ship_exp_cranage` decimal(10,2) DEFAULT NULL,
  `ship_exp_misc` decimal(10,2) DEFAULT NULL,
  `sales_total` decimal(10,2) DEFAULT NULL,
  `total_wet_cost` decimal(10,2) DEFAULT NULL,
  `total_ship_exp` decimal(10,2) DEFAULT NULL,
  `net_gain` decimal(10,2) DEFAULT NULL,
  `payment_sales` decimal(10,2) DEFAULT NULL,
  `paid_total` decimal(10,2) DEFAULT NULL,
  `amount_unpaid` decimal(10,2) DEFAULT NULL,
  `pay_date` date DEFAULT NULL,
  `pay_details` varchar(100) DEFAULT NULL,
  `paid_amount` decimal(10,2) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `recorded_by` varchar(255) NOT NULL,
  `status` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales_cuplumps_rec`
--

INSERT INTO `sales_cuplumps_rec` (`sale_id`, `sales_date`, `ship_date`, `sale_buyer`, `van_no`, `sale_type`, `info_lading`, `sale_destination`, `voyage`, `source`, `vessel`, `cuplumps_total_cost`, `cuplumps_total_weight`, `cuplumps_average_per_kilo`, `sale_currency`, `exchange_rate`, `wet_kilo_price`, `ship_exp_freight`, `ship_exp_loading`, `ship_exp_processing`, `ship_exp_trucking`, `ship_exp_cranage`, `ship_exp_misc`, `sales_total`, `total_wet_cost`, `total_ship_exp`, `net_gain`, `payment_sales`, `paid_total`, `amount_unpaid`, `pay_date`, `pay_details`, `paid_amount`, `notes`, `recorded_by`, `status`) VALUES
(1, '2023-05-01', '0000-00-00', 'RONALD DALE', 'ABC', 'EXPORT', 'ABC', 'ABC', 'ABC', 'ABC', 'ABC', '74221.00', '23.00', '3227.00', 'PHP', '1.00', '50.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '1150.00', '74221.00', '0.00', '-73071.00', '1150.00', NULL, '150.00', '2023-05-01', '', '1000.00', NULL, 'dale', 'Completed'),
(2, '2023-05-02', '0000-00-00', 'ABC', 'ABC', 'EXPORT', 'ABC', 'ABC', 'ABC', 'ABC', 'ABC', '74221.00', '23.00', '3227.00', 'USD', '55.48', '400.00', '4000.00', '2000.00', '10000.00', '0.00', '0.00', '0.00', '510416.00', '74221.00', '16000.00', '420195.00', '510416.00', NULL, '-9583.00', '2023-05-02', '', '519999.00', NULL, 'dale', 'Completed');

-- --------------------------------------------------------

--
-- Table structure for table `sales_cuplump_selected_inventory`
--

CREATE TABLE `sales_cuplump_selected_inventory` (
  `id` int(11) NOT NULL,
  `sales_id` int(11) NOT NULL,
  `recording_id` int(11) NOT NULL,
  `weight_selected` int(11) DEFAULT NULL,
  `loc` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales_cuplump_selected_inventory`
--

INSERT INTO `sales_cuplump_selected_inventory` (`id`, `sales_id`, `recording_id`, `weight_selected`, `loc`) VALUES
(2, 2, 2, 23, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `seller`
--

CREATE TABLE `seller` (
  `id` int(11) NOT NULL,
  `code` varchar(50) NOT NULL,
  `name` varchar(60) NOT NULL,
  `address` varchar(60) NOT NULL,
  `cheque` varchar(60) NOT NULL,
  `contact` varchar(12) DEFAULT NULL,
  `cash_advance` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `seller`
--

INSERT INTO `seller` (`id`, `code`, `name`, `address`, `cheque`, `contact`, `cash_advance`) VALUES
(29, '001', 'Test', 'test', '', NULL, NULL),
(30, '002', 'JULMAR', 'lamitan', '', NULL, NULL);

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

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `loc` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `type`, `loc`) VALUES
(1, 'admin', 'admin', 'admin', 'Basilan'),
(2, 'ledger', 'ledger', 'finance', 'Basilan'),
(3, 'rubber', 'rubber', 'rubber', 'Basilan'),
(4, 'copra', 'copra', 'copra', 'Basilan'),
(5, 'planta', 'planta', 'planta', 'Basilan'),
(7, 'cecile', 'cecile', 'rubber', 'Kidapawan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bales_transaction`
--
ALTER TABLE `bales_transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_expenses`
--
ALTER TABLE `category_expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contract_purchase`
--
ALTER TABLE `contract_purchase`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `copra_cashadvance`
--
ALTER TABLE `copra_cashadvance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ledger_buahantoppers`
--
ALTER TABLE `ledger_buahantoppers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ledger_buying_station`
--
ALTER TABLE `ledger_buying_station`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ledger_cashadvance`
--
ALTER TABLE `ledger_cashadvance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ledger_expenses`
--
ALTER TABLE `ledger_expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ledger_maloong`
--
ALTER TABLE `ledger_maloong`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ledger_purchase`
--
ALTER TABLE `ledger_purchase`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `moisture_table`
--
ALTER TABLE `moisture_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `planta_bales_production`
--
ALTER TABLE `planta_bales_production`
  ADD PRIMARY KEY (`bales_prod_id`);

--
-- Indexes for table `planta_recording`
--
ALTER TABLE `planta_recording`
  ADD PRIMARY KEY (`recording_id`);

--
-- Indexes for table `planta_recording_logs`
--
ALTER TABLE `planta_recording_logs`
  ADD PRIMARY KEY (`planta_logs_id`);

--
-- Indexes for table `purchase_category`
--
ALTER TABLE `purchase_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rubber_cashadvance`
--
ALTER TABLE `rubber_cashadvance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rubber_contract`
--
ALTER TABLE `rubber_contract`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rubber_seller`
--
ALTER TABLE `rubber_seller`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rubber_transaction`
--
ALTER TABLE `rubber_transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_bales_rec`
--
ALTER TABLE `sales_bales_rec`
  ADD PRIMARY KEY (`sale_bales_id`);

--
-- Indexes for table `sales_bales_selected_inventory`
--
ALTER TABLE `sales_bales_selected_inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_cuplumps_rec`
--
ALTER TABLE `sales_cuplumps_rec`
  ADD PRIMARY KEY (`sale_id`);

--
-- Indexes for table `sales_cuplump_selected_inventory`
--
ALTER TABLE `sales_cuplump_selected_inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seller`
--
ALTER TABLE `seller`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_record`
--
ALTER TABLE `transaction_record`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bales_transaction`
--
ALTER TABLE `bales_transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;

--
-- AUTO_INCREMENT for table `category_expenses`
--
ALTER TABLE `category_expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `contract_purchase`
--
ALTER TABLE `contract_purchase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `copra_cashadvance`
--
ALTER TABLE `copra_cashadvance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `ledger_buahantoppers`
--
ALTER TABLE `ledger_buahantoppers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `ledger_buying_station`
--
ALTER TABLE `ledger_buying_station`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ledger_cashadvance`
--
ALTER TABLE `ledger_cashadvance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=642;

--
-- AUTO_INCREMENT for table `ledger_expenses`
--
ALTER TABLE `ledger_expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ledger_maloong`
--
ALTER TABLE `ledger_maloong`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `ledger_purchase`
--
ALTER TABLE `ledger_purchase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=461;

--
-- AUTO_INCREMENT for table `moisture_table`
--
ALTER TABLE `moisture_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=461;

--
-- AUTO_INCREMENT for table `planta_bales_production`
--
ALTER TABLE `planta_bales_production`
  MODIFY `bales_prod_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `planta_recording`
--
ALTER TABLE `planta_recording`
  MODIFY `recording_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `planta_recording_logs`
--
ALTER TABLE `planta_recording_logs`
  MODIFY `planta_logs_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `purchase_category`
--
ALTER TABLE `purchase_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `rubber_cashadvance`
--
ALTER TABLE `rubber_cashadvance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=184;

--
-- AUTO_INCREMENT for table `rubber_contract`
--
ALTER TABLE `rubber_contract`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `rubber_seller`
--
ALTER TABLE `rubber_seller`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `rubber_transaction`
--
ALTER TABLE `rubber_transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `sales_bales_rec`
--
ALTER TABLE `sales_bales_rec`
  MODIFY `sale_bales_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sales_bales_selected_inventory`
--
ALTER TABLE `sales_bales_selected_inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sales_cuplumps_rec`
--
ALTER TABLE `sales_cuplumps_rec`
  MODIFY `sale_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sales_cuplump_selected_inventory`
--
ALTER TABLE `sales_cuplump_selected_inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `seller`
--
ALTER TABLE `seller`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `transaction_record`
--
ALTER TABLE `transaction_record`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
