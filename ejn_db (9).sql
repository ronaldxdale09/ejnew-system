-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 03, 2023 at 07:00 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

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
-- Table structure for table `bales_container_record`
--

CREATE TABLE `bales_container_record` (
  `container_id` int(11) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `container_no` varchar(255) DEFAULT NULL,
  `withdrawal_date` varchar(255) DEFAULT NULL,
  `quality` varchar(255) DEFAULT NULL,
  `kilo_bale` varchar(255) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `recorded_by` varchar(255) DEFAULT NULL,
  `van_no` varchar(255) DEFAULT NULL,
  `num_bales` float NOT NULL,
  `total_bale_weight` float NOT NULL,
  `total_bale_cost` decimal(10,2) NOT NULL,
  `total_milling_cost` decimal(10,2) NOT NULL,
  `average_kilo_cost` decimal(10,2) NOT NULL,
  `shipping_expense` decimal(10,2) NOT NULL,
  `source` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bales_container_record`
--

INSERT INTO `bales_container_record` (`container_id`, `status`, `container_no`, `withdrawal_date`, `quality`, `kilo_bale`, `remarks`, `recorded_by`, `van_no`, `num_bales`, `total_bale_weight`, `total_bale_cost`, `total_milling_cost`, `average_kilo_cost`, `shipping_expense`, `source`) VALUES
(11, 'Void', 'PSAU311069-5', '2023-06-07', 'SPR10', '33.33', 'SHOWA', 'JEANNE', 'PSAU311069-5        ', 600, 19998, 1021346.34, 239976.00, 51.07, 0.00, 'Basilan'),
(14, 'Void', '', '2023-06-18', 'SPR10', '35', 'SHOWA', 'planta', '49922', 170, 5916.6, 170.00, 5916.60, 5916.60, 0.00, 'Basilan'),
(15, 'Sold', '', '2023-06-18', 'SPR10', '35', 'DEC', 'planta', 'ABC', 325, 11375, 580076.89, 136500.00, 51.00, 0.00, 'Basilan'),
(16, 'Sold', '', '2023-06-18', 'SPR20', '35', 'DUNLOP', 'planta', 'SDFSF34R2', 568, 19880, 1046920.00, 238560.00, 52.66, 0.00, 'Basilan'),
(17, 'Sold', '', '2023-06-19', 'SPR10', '33.33', 'JAYSON', 'planta', 'ACASDC', 234, 8190, 422853.86, 98280.00, 51.63, 0.00, 'Basilan'),
(18, 'Sold', '', '2023-06-19', 'SPR10', '35', 'ABC', 'planta', 'ASDAD3434', 144, 5040, 255605.00, 60480.00, 62.72, 3721.00, 'Basilan'),
(19, 'Sold', '', '2023-06-19', 'SPR10', '35', 'ABCW', 'planta', 'ASDSAD32', 212, 7420, 367737.72, 89040.00, 61.56, 3721.00, 'Basilan'),
(20, 'Sold', '', '2023-06-19', 'SPR20', '35', 'SHOWA', 'planta', '2323A', 454, 15890, 818545.00, 120540.00, 59.10, 0.00, NULL),
(21, 'Void', '', '2023-06-29', 'SPR10', '35kg', '313', 'planta', 'ASDASD22', 0, 0, 0.00, 0.00, 0.00, 0.00, NULL),
(22, 'Sold', '', '2023-06-30', 'SPR5', '35', 'RONALD', 'planta', 'TEG23423', 106, 3710, 186170.59, 28560.00, 57.88, 2903.00, NULL),
(23, 'Sold', '', '2023-07-01', 'SPR10', '33.33', 'RONALD', 'planta', 'ADSAD', 272, 9481.59, 606230.93, 104119.08, 74.92, 2691.00, NULL),
(24, 'Void', '', '2023-06-30', 'SPR5', '35kg', 'CDE', 'planta', 'ABC', 0, 0, 0.00, 0.00, 0.00, 0.00, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bales_container_selection`
--

CREATE TABLE `bales_container_selection` (
  `selected_id` int(11) NOT NULL,
  `container_id` int(11) NOT NULL,
  `bales_id` int(11) NOT NULL,
  `num_bales` int(11) NOT NULL,
  `total_weight` int(11) NOT NULL,
  `planta_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bales_container_selection`
--

INSERT INTO `bales_container_selection` (`selected_id`, `container_id`, `bales_id`, `num_bales`, `total_weight`, `planta_id`) VALUES
(1, 15, 1, 100, 0, 1),
(2, 15, 2, 79, 0, 1),
(3, 15, 6, 29, 0, 4),
(4, 15, 7, 35, 0, 4),
(5, 15, 13, 82, 0, 6),
(6, 16, 14, 128, 0, 6),
(7, 16, 22, 212, 0, 13),
(8, 16, 23, 21, 0, 13),
(9, 16, 29, 207, 0, 2),
(11, 17, 25, 5, 0, 7),
(12, 17, 28, 80, 0, 2),
(13, 17, 31, 13, 0, 9),
(14, 17, 33, 24, 0, 11),
(15, 17, 34, 31, 0, 21),
(16, 17, 35, 81, 0, 17),
(17, 18, 36, 50, 0, 17),
(18, 18, 37, 28, 0, 52),
(19, 18, 38, 13, 0, 52),
(20, 18, 42, 12, 0, 53),
(21, 18, 57, 15, 0, 23),
(22, 18, 58, 26, 0, 23),
(23, 19, 59, 22, 0, 10),
(24, 19, 60, 30, 0, 10),
(25, 19, 62, 22, 0, 14),
(26, 19, 66, 82, 0, 24),
(27, 19, 68, 56, 0, 57),
(29, 20, 72, 27, 0, 60),
(30, 20, 81, 130, 0, 16),
(31, 20, 88, 127, 0, 66),
(32, 20, 89, 40, 0, 66),
(34, 22, 71, 4, 4, 18),
(35, 22, 73, 8, 500, 8),
(36, 22, 90, 38, 1, 67),
(37, 22, 91, 56, 2, 69),
(38, 23, 100, 23, 805, 74),
(39, 23, 96, 40, 3, 70),
(40, 23, 95, 56, 3, 70),
(41, 23, 92, 23, 2, 69),
(42, 23, 71, 130, 4, 18),
(43, 24, 71, 4, 4, 18);

-- --------------------------------------------------------

--
-- Table structure for table `bales_outsource_purchase`
--

CREATE TABLE `bales_outsource_purchase` (
  `outsource_recording_id` int(11) NOT NULL,
  `prod_type` varchar(255) NOT NULL,
  `trans_type` varchar(255) NOT NULL,
  `trans_date` date NOT NULL,
  `supplier` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `driver` varchar(255) NOT NULL,
  `truck_num` varchar(255) NOT NULL,
  `purchase_cost` decimal(10,2) NOT NULL,
  `total_weight` float NOT NULL,
  `expense_desc` varchar(255) NOT NULL,
  `expense` decimal(10,2) NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `recorded_by` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bales_outsource_purchase`
--

INSERT INTO `bales_outsource_purchase` (`outsource_recording_id`, `prod_type`, `trans_type`, `trans_date`, `supplier`, `location`, `driver`, `truck_num`, `purchase_cost`, `total_weight`, `expense_desc`, `expense`, `remarks`, `recorded_by`) VALUES
(1, 'SALE', 'OUTSOURCE', '2023-06-29', 'ABC', 'CDE', 'DATE', 'ASDASD2', 0.00, 766.59, 'TEST', 2.00, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `bales_purchase_inventory`
--

CREATE TABLE `bales_purchase_inventory` (
  `id` int(11) NOT NULL,
  `purchase_id` int(11) NOT NULL,
  `bales_id` int(11) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `kilo_bale` int(11) NOT NULL,
  `number_bales` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  `excess` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bales_purchase_inventory`
--

INSERT INTO `bales_purchase_inventory` (`id`, `purchase_id`, `bales_id`, `type`, `kilo_bale`, `number_bales`, `weight`, `excess`) VALUES
(53, 2, 13, 'SPR-10', 35, 82, 2870, 0),
(54, 2, 14, 'SPR-20', 35, 128, 4495, 15),
(55, 3, 3, 'SPR-10', 35, 207, 7245, 0),
(56, 3, 4, 'SPR-20', 35, 53, 1867, 12),
(57, 4, 3, 'SPR-10', 35, 207, 7245, 0),
(58, 4, 4, 'SPR-20', 35, 53, 1867, 12),
(59, 5, 3, 'SPR-10', 35, 207, 7245, 0),
(60, 5, 4, 'SPR-20', 35, 53, 1867, 12),
(61, 6, 5, 'SPR-10', 33, 129, 4300, 0),
(62, 7, 5, 'SPR-10', 33, 129, 4300, 0),
(63, 8, 5, 'SPR-10', 33, 129, 4300, 0),
(64, 11, 6, 'SPR-10', 35, 29, 1015, 0),
(65, 11, 7, 'SPR-20', 35, 35, 1243, 18),
(66, 14, 28, 'SPR-10', 35, 80, 2800, 0),
(67, 14, 29, 'SPR-20', 35, 207, 7257, 12),
(68, 15, 28, 'SPR-10', 35, 80, 2800, 0),
(69, 15, 29, 'SPR-20', 35, 207, 7257, 12),
(70, 16, 22, 'SPR-20', 35, 212, 7420, 0),
(71, 16, 23, 'SPR-20', 35, 21, 759, 24),
(72, 17, 32, 'SPR-10', 33, 99, 3300, 0),
(73, 17, 33, 'SPR-20', 35, 24, 840, 0),
(74, 20, 35, 'SPR-20', 35, 81, 2835, 0),
(75, 20, 36, 'SPR-10', 35, 50, 1767, 17),
(76, 21, 34, 'SPR-20', 35, 31, 1108, 23),
(77, 23, 37, 'SPR-10', 35, 28, 980, 0),
(78, 23, 38, 'SPR-20', 35, 13, 459, 4),
(79, 24, 39, 'SPR-10', 35, 10, 350, 0),
(80, 24, 40, 'SPR-20', 33, 42, 1413, 13),
(81, 25, 42, 'SPR-10', 35, 12, 420, 0),
(82, 25, 43, 'SPR-20', 35, 42, 1413, 13),
(83, 26, 41, 'SPR-10', 33, 131, 4366, 0),
(84, 27, 41, 'SPR-10', 33, 131, 4366, 0),
(85, 28, 41, 'SPR-10', 33, 131, 4366, 0),
(86, 29, 41, 'SPR-10', 33, 131, 4366, 0),
(87, 30, 41, 'SPR-10', 33, 131, 4366, 0),
(88, 31, 57, 'SPR-10', 35, 15, 525, 0),
(89, 31, 58, 'SPR-20', 35, 26, 924, 14),
(90, 33, 63, 'SPR-10', 35, 7, 233, 0),
(91, 33, 64, 'SPR-20', 35, 134, 4720, 30),
(92, 34, 70, 'SPR-10', 33, 7, 233, 0),
(93, 34, 71, 'SPR-20', 35, 134, 4720, 30),
(94, 36, 66, 'SPR-20', 35, 82, 2874, 4),
(95, 37, 68, 'SPR-20', 35, 56, 1983, 23),
(96, 38, 66, 'SPR-20', 35, 82, 2874, 4),
(97, 40, 72, 'SPR-20', 35, 27, 946, 1),
(98, 43, 79, 'SPR-20', 35, 130, 4550, 0),
(99, 43, 80, 'SPR-10', 35, 59, 1986, 20),
(100, 46, 88, 'SPR-20', 35, 127, 4445, 0),
(101, 46, 89, 'SPR-10', 35, 40, 1416, 16),
(102, 46, 90, 'SPR-20', 35, 38, 1356, 26),
(103, 47, 90, 'SPR-20', 35, 38, 1356, 26),
(104, 48, 91, 'SPR-10', 35, 56, 1960, 0),
(105, 48, 92, 'SPR-20', 33, 23, 767, 0),
(106, 50, 95, 'SPR-20', 35, 56, 1980, 20),
(107, 50, 96, 'SPR-10', 35, 40, 1345, 12);

-- --------------------------------------------------------

--
-- Table structure for table `bales_sales_container`
--

CREATE TABLE `bales_sales_container` (
  `sales_container_id` int(11) NOT NULL,
  `sales_id` int(11) NOT NULL,
  `container_id` int(11) NOT NULL,
  `van_no` varchar(255) NOT NULL,
  `bale_quality` varchar(255) NOT NULL,
  `kilo_bale` varchar(255) NOT NULL,
  `num_bales` int(11) NOT NULL,
  `total_bale_cost` float NOT NULL,
  `total_milling_cost` float NOT NULL,
  `total_weight` float NOT NULL,
  `ship_expense` float NOT NULL,
  `remarks` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bales_sales_payment`
--

CREATE TABLE `bales_sales_payment` (
  `payment_id` int(11) NOT NULL,
  `sales_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `details` varchar(255) NOT NULL,
  `amount_paid` decimal(10,2) NOT NULL,
  `currency` varchar(5) NOT NULL,
  `rate` decimal(10,2) NOT NULL,
  `pesos_equivalent` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bales_sales_record`
--

CREATE TABLE `bales_sales_record` (
  `bales_sales_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `sale_contract` varchar(255) NOT NULL,
  `purchase_contract` varchar(255) NOT NULL,
  `buyer_name` varchar(255) DEFAULT NULL,
  `sale_type` varchar(255) NOT NULL,
  `contract_quality` varchar(255) NOT NULL,
  `contract_quantity` int(11) NOT NULL,
  `contract_kiloPerBale` varchar(11) NOT NULL,
  `contract_container_num` int(11) NOT NULL,
  `contract_price` decimal(10,2) NOT NULL,
  `transaction_date` date NOT NULL,
  `shipping_date` varchar(255) NOT NULL,
  `source` varchar(255) NOT NULL,
  `destination` varchar(255) NOT NULL,
  `currency` varchar(5) NOT NULL,
  `other_terms` text DEFAULT NULL,
  `no_containers` int(11) NOT NULL,
  `total_num_bales` int(11) NOT NULL,
  `total_bale_weight` decimal(10,2) NOT NULL,
  `total_bale_cost` decimal(10,2) NOT NULL,
  `total_bale_prod_cost` decimal(10,2) NOT NULL,
  `total_ship_expense` decimal(10,2) NOT NULL,
  `overall_ave_cost_kilo` decimal(10,2) NOT NULL,
  `total_sales` decimal(10,2) NOT NULL,
  `amount_paid` decimal(10,2) NOT NULL,
  `unpaid_balance` decimal(10,2) NOT NULL,
  `sales_proceed` decimal(10,2) NOT NULL,
  `overall_cost` decimal(10,2) NOT NULL,
  `gross_profit` decimal(10,2) NOT NULL,
  `recorded_by` varchar(255) NOT NULL,
  `remarks` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bales_sales_record`
--

INSERT INTO `bales_sales_record` (`bales_sales_id`, `status`, `sale_contract`, `purchase_contract`, `buyer_name`, `sale_type`, `contract_quality`, `contract_quantity`, `contract_kiloPerBale`, `contract_container_num`, `contract_price`, `transaction_date`, `shipping_date`, `source`, `destination`, `currency`, `other_terms`, `no_containers`, `total_num_bales`, `total_bale_weight`, `total_bale_cost`, `total_bale_prod_cost`, `total_ship_expense`, `overall_ave_cost_kilo`, `total_sales`, `amount_paid`, `unpaid_balance`, `sales_proceed`, `overall_cost`, `gross_profit`, `recorded_by`, `remarks`) VALUES
(2, 'Draft', 'ABC123', '321ABC', 'RONALD DALE', 'EXPORT', 'SPR10', 23, '35', 5, 51.00, '2023-07-02', 'AUG', 'ZAMBOANGA', 'MANILA', 'PHP', 'TEST', 0, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 'Raquel Bais', 'TEST'),
(3, 'Draft', 'ABC', 'CD23', 'RONALD DALE', 'EXPORT', 'SPR10', 2333, '35', 5, 25.00, '2023-07-02', 'ADAS', 'ASD', 'DS', 'PHP', '', 0, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 'Raquel Bais', 'TEST');

-- --------------------------------------------------------

--
-- Table structure for table `bales_shipment_container`
--

CREATE TABLE `bales_shipment_container` (
  `bs_id` int(11) NOT NULL,
  `shipment_id` int(11) NOT NULL,
  `container_id` int(11) NOT NULL,
  `van_no` varchar(255) NOT NULL,
  `bale_quality` varchar(255) NOT NULL,
  `kilo_bale` varchar(255) NOT NULL,
  `num_bales` int(11) NOT NULL,
  `total_weight` float NOT NULL,
  `remarks` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bales_shipment_container`
--

INSERT INTO `bales_shipment_container` (`bs_id`, `shipment_id`, `container_id`, `van_no`, `bale_quality`, `kilo_bale`, `num_bales`, `total_weight`, `remarks`) VALUES
(4, 1, 15, 'ABC', 'SPR10', '35', 100, 11375, '580,076.89 pcs'),
(5, 1, 16, 'SDFSF34R2', 'SPR20', '35', 128, 19880, '1,046,920.00 pcs'),
(6, 2, 17, 'ACASDC', 'SPR10', '33.33', 5, 8190, '422,853.86 pcs'),
(7, 3, 19, 'ASDSAD32', 'SPR10', '35', 212, 7420, '₱ 367,737.72 '),
(8, 3, 18, 'ASDAD3434', 'SPR10', '35', 144, 5040, '₱ 255,605.00 '),
(9, 5, 22, 'TEG23423', 'SPR5', '35', 106, 3710, '₱ 186,170.59 '),
(10, 4, 23, 'ADSAD', 'SPR10', '33.33', 272, 9482, '₱ 606,230.93 ');

-- --------------------------------------------------------

--
-- Table structure for table `bales_transaction`
--

CREATE TABLE `bales_transaction` (
  `id` int(11) NOT NULL,
  `invoice` varchar(255) NOT NULL,
  `production_id` int(11) DEFAULT NULL,
  `seller` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `contract` varchar(255) DEFAULT NULL,
  `delivery_date` date DEFAULT NULL,
  `lot_code` varchar(255) DEFAULT NULL,
  `entry` decimal(10,2) DEFAULT NULL,
  `total_net_weight` decimal(10,2) DEFAULT NULL,
  `total_bales_pcs` int(11) NOT NULL,
  `excess` float NOT NULL,
  `drc` decimal(10,2) DEFAULT NULL,
  `price_1` decimal(10,2) DEFAULT NULL,
  `price_2` decimal(10,2) DEFAULT NULL,
  `first_total` decimal(10,2) DEFAULT NULL,
  `second_total` decimal(10,2) DEFAULT NULL,
  `net_total_1` float NOT NULL,
  `net_total_2` float NOT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `less` decimal(10,2) DEFAULT NULL,
  `amount_paid` decimal(10,2) DEFAULT NULL,
  `words_amount` varchar(255) DEFAULT NULL,
  `loc` varchar(255) DEFAULT NULL,
  `recorded_by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bales_transaction`
--

INSERT INTO `bales_transaction` (`id`, `invoice`, `production_id`, `seller`, `address`, `date`, `contract`, `delivery_date`, `lot_code`, `entry`, `total_net_weight`, `total_bales_pcs`, `excess`, `drc`, `price_1`, `price_2`, `first_total`, `second_total`, `net_total_1`, `net_total_2`, `total_amount`, `less`, `amount_paid`, `words_amount`, `loc`, `recorded_by`) VALUES
(2, '2', 6, 'TATA HALAL', 'BULINGAN, LAMITAN CITY', '2023-06-03', 'SPOT', '0000-00-00', '3', 12335.00, 7365.00, 210, 15, 59.71, 51.50, 0.00, 379297.50, NULL, 0, 0, 379297.50, 270000.00, 109297.50, 'One Hundred Nine Thousand Two Hundred Ninety Seven Peso/s And Five Centavo/s ', NULL, 'rubber'),
(8, '8', 3, 'CHARLIE CAWLEY', 'LAMITAN CITY', '2023-05-25', 'SPOT', '0000-00-00', 'D', 8585.00, 4299.57, 129, 0, 50.08, 52.00, 0.00, 223577.64, 0.00, 0, 0, 223577.64, 130000.00, 93577.64, 'Ninety Three Thousand Five Hundred Seventy Seven Peso/s And Sixty Four Centavo/s ', NULL, 'JANE'),
(11, '11', 4, 'LOUIE DELOS REYES', 'PANUNSULAN, ISABELA CITY', '2023-05-26', 'SPOT', '0000-00-00', 'M', 4095.00, 2258.00, 64, 18, 55.14, 52.00, 0.00, 117416.00, 0.00, 0, 0, 117416.00, 81433.20, 35982.80, 'Thirty Five Thousand Nine Hundred Eighty Two Peso/s And Eight Centavo/s ', NULL, 'JANE'),
(15, '15', 0, 'LONG2X SAN JUAN', 'LAMITAN CITY', '2023-06-05', 'SPOT', '0000-00-00', '', 17500.00, 10057.00, 287, 12, 57.47, 53.00, 0.00, 533021.00, 0.00, 0, 0, 533021.00, 568523.00, -35502.00, 'Undefined Hundred Thirty Five Thousand Five Hundred Two Peso/s ', NULL, 'JANE'),
(16, '16', 13, 'LONG2X SAN JUAN', 'LAMITAN CITY', '2023-06-05', 'SPOT', '0000-00-00', '19', 14085.00, 8179.00, 233, 24, 58.07, 53.00, 0.00, 433487.00, 0.00, 0, 0, 433487.00, 421968.00, 11519.00, 'Eleven Thousand Five Hundred Nineteen Peso/s ', NULL, 'JANE'),
(17, '17', 11, 'CHARLIE CAWLEY', 'LAMITAN CITY', '2023-06-05', 'SPOT', '0000-00-00', 'E', 8315.00, 4139.67, 123, 0, 49.79, 52.00, 0.00, 215262.84, 0.00, 0, 0, 215262.84, 150000.00, 65262.84, 'Sixty Five Thousand Two Hundred Sixty Two Peso/s And Eighty Four Centavo/s ', NULL, 'JANE'),
(20, '20', 17, 'JARWIN GARCIA', 'CALVARIO, LAMITAN CITY', '2023-06-05', 'SPOT', '0000-00-00', '8', 8200.00, 4602.00, 131, 17, 56.12, 51.00, 0.00, 234702.00, 0.00, 0, 0, 234702.00, 209100.00, 25602.00, 'Twenty Five Thousand Six Hundred Two Peso/s ', NULL, 'JANE'),
(21, '21', 21, 'RUBEN RAMOS', '6KM. ISABELA CITY', '2023-06-05', 'SPOT', '0000-00-00', 'X', 2113.00, 1108.00, 31, 23, 52.44, 51.00, 0.00, 56508.00, 0.00, 0, 0, 56508.00, 20000.00, 36508.00, 'Thirty Six Thousand Five Hundred Eight Peso/s ', NULL, 'JANE'),
(23, '23', 52, 'RUBEN RAMOS', '6KM. ISABELA CITY', '2023-06-05', 'SPOT', '0000-00-00', 'w', 2558.00, 1439.00, 41, 4, 56.25, 51.00, 0.00, 73389.00, 0.00, 0, 0, 73389.00, 70000.00, 3389.00, 'Three Thousand Three Hundred Eighty Nine Peso/s ', NULL, 'JANE'),
(25, '25', 53, 'EPIGIL MOLEJE', 'MALOONG SAN JOSE, LAMITAN CITY', '2023-06-06', 'SPOT', '0000-00-00', 'A', 3498.00, 1832.86, 54, 13, 52.40, 51.00, 0.00, 93475.86, 0.00, 0, 0, 93475.86, 0.00, 93475.86, 'Ninety Three Thousand Four Hundred Seventy Five Peso/s And Eighty Six Centavo/s ', NULL, 'JANE'),
(30, '30', 12, 'CHARLIE CAWLEY', 'LAMITAN CITY', '2023-06-06', 'SPOT', '0000-00-00', 'F', 8775.00, 4366.23, 131, 0, 49.76, 50.73, 0.00, 221498.85, 0.00, 0, 0, 221498.85, 0.00, 221498.85, 'Two Hundred Twenty One Thousand Four Hundred Ninety Eight Peso/s And Eighty Five Centavo/s ', NULL, 'jane'),
(31, '31', 23, 'DANNY BARANDINO', 'ISABELA CITY', '2023-06-07', 'SPOT', '0000-00-00', '3', 2685.00, 1449.00, 41, 14, 53.97, 50.00, 0.00, 72450.00, 0.00, 0, 0, 72450.00, 70566.80, 1883.20, 'One Thousand Eight Hundred Eighty Three Peso/s And Two Centavo/s ', NULL, 'JANE'),
(34, '34', 0, 'JARWIN GARCIA', 'CALVARIO, LAMITAN CITY', '2023-06-07', 'SPOT', '0000-00-00', '', 8340.00, 4953.31, 141, 30, 59.39, 51.00, 0.00, 252618.81, 0.00, 0, 0, 252618.81, 212670.00, 39948.81, 'Thirty Nine Thousand Nine Hundred Forty Eight Peso/s And Eighty One Centavo/s ', NULL, 'JANE'),
(37, '37', 57, 'LOUIE DELOS REYES', 'PANUNSULAN, ISABELA CITY', '2023-06-07', 'SPOT', '0000-00-00', 'N', 3355.00, 1983.00, 56, 23, 59.11, 52.00, 0.00, 103116.00, 0.00, 0, 0, 103116.00, 86387.00, 16729.00, 'Sixteen Thousand Seven Hundred Twenty Nine Peso/s ', NULL, 'rubber'),
(38, '38', 24, 'JIMROY MCCLINTOCK', 'MALOONG, LAMITAN CITY', '2023-06-07', 'SPOT', '0000-00-00', 'C', 5504.00, 2874.00, 82, 4, 52.22, 51.00, 0.00, 146574.00, 0.00, 0, 0, 146574.00, 140000.00, 6574.00, 'Six Thousand Five Hundred Seventy Four Peso/s ', NULL, 'rubber'),
(40, '40', 60, 'DANNY BARANDINO', 'ISABELA CITY', '2023-06-07', 'SPOT', '0000-00-00', '2', 1730.00, 946.00, 27, 1, 54.68, 50.00, 0.00, 47300.00, 0.00, 0, 0, 47300.00, 50457.00, -3157.00, 'Undefined Three Thousand One Hundred Fifty Seven Peso/s ', NULL, 'rubber'),
(43, '43', 0, 'LONG2X SAN JUAN', 'LAMITAN CITY', '2023-06-08', 'SPOT', '0000-00-00', '', 12410.00, 6536.47, 189, 20, 52.67, 53.00, 0.00, 346432.91, 0.00, 0, 0, 346432.91, 450319.50, -103886.59, 'Undefined Million One Hundred Three Thousand Eight Hundred Eighty Six Peso/s And Fifty Nine Centavo/s ', NULL, 'rubber'),
(46, '46', 66, 'JARWIN GARCIA', 'CALVARIO, LAMITAN CITY', '2023-06-13', 'SPOT', '0000-00-00', '7', 9885.00, 5861.00, 167, 16, 59.29, 51.00, 0.00, 298911.00, 0.00, 0, 0, 298911.00, 247124.00, 51787.00, 'Fifty One Thousand Seven Hundred Eighty Seven Peso/s ', NULL, 'jane'),
(47, '47', 67, 'JERRY ARIERO', 'ULAMI, LAMITAN CITY', '2023-06-13', 'SPOT', '0000-00-00', '3', 2075.00, 1356.00, 38, 26, 65.35, 50.00, 0.00, 67800.00, 0.00, 0, 0, 67800.00, 25000.00, 42800.00, 'Forty Two Thousand Eight Hundred Peso/s ', NULL, 'rubber'),
(48, '48', 69, 'RONIE VILDAD', 'MALOONG, LAMITAN CITY', '2023-06-18', 'SPOT', '0000-00-00', '34', 5000.00, 2726.59, 79, 0, 54.53, 52.00, 0.00, 141782.68, 0.00, 0, 0, 141782.68, 0.00, 141782.68, 'One Hundred Forty One Thousand Seven Hundred Eighty Two Peso/s And Sixty Eight Centavo/s ', NULL, 'rubber'),
(49, '', NULL, NULL, NULL, '2023-06-19', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, 'rubber'),
(50, '50', 70, 'NENETH COSTAN', 'TABIAWAN, ISABELA CITY', '2023-06-19', 'SPOT', '0000-00-00', 'D', 5000.00, 3325.20, 96, 32, 66.50, 50.00, 0.00, 166260.00, 0.00, 0, 0, 166260.00, 0.00, 166260.00, 'One Hundred Sixty Six Thousand Two Hundred Sixty Peso/s ', NULL, 'rubber');

-- --------------------------------------------------------

--
-- Table structure for table `bale_shipment_record`
--

CREATE TABLE `bale_shipment_record` (
  `shipment_id` int(11) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `ship_date` date NOT NULL,
  `destination` varchar(255) DEFAULT NULL,
  `source` varchar(255) DEFAULT NULL,
  `vessel` varchar(255) DEFAULT NULL,
  `bill_lading` varchar(255) NOT NULL,
  `freight` decimal(10,2) NOT NULL,
  `loading_unloading` decimal(10,2) NOT NULL,
  `processing_fee` decimal(10,2) NOT NULL,
  `trucking_expense` decimal(10,2) NOT NULL,
  `cranage_fee` decimal(10,2) NOT NULL,
  `miscellaneous` decimal(10,2) NOT NULL,
  `total_shipping_expense` decimal(10,2) NOT NULL,
  `no_containers` int(11) NOT NULL,
  `ship_cost_container` decimal(10,2) NOT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `recorded_by` varchar(255) DEFAULT NULL,
  `total_num_bales` float NOT NULL,
  `total_bale_weight` float NOT NULL,
  `total_bale_cost` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bale_shipment_record`
--

INSERT INTO `bale_shipment_record` (`shipment_id`, `type`, `status`, `ship_date`, `destination`, `source`, `vessel`, `bill_lading`, `freight`, `loading_unloading`, `processing_fee`, `trucking_expense`, `cranage_fee`, `miscellaneous`, `total_shipping_expense`, `no_containers`, `ship_cost_container`, `remarks`, `recorded_by`, `total_num_bales`, `total_bale_weight`, `total_bale_cost`) VALUES
(1, 'EXPORT', 'Complete', '2023-06-18', 'ABC', 'Basilan', 'ERD', 'DSA', 123.00, 3345.00, 678.00, 11.00, 22.00, 33.00, 4212.00, 2, 2106.00, 'ERD', 'DSA', 893, 31255, 1626996.89),
(2, 'EXPORT', 'Complete', '2023-06-19', 'MANILA', 'Basilan', 'ALESON', '2,322', 123.00, 345.00, 678.00, 910.00, 1112.00, 1314.00, 4482.00, 1, 4482.00, 'TEST REMARKS', 'TEST RECORDED', 234, 8190, 422853.86),
(3, 'EXPORT', 'Complete', '2023-06-19', 'DAVAO', 'Basilan', 'ALESON', 'TEST ', 2333.00, 12.00, 321.00, 4332.00, 321.00, 123.00, 7442.00, 2, 3721.00, 'TEST 2', ' TEST 3', 356, 12460, 623342.72),
(4, 'Select', 'Complete', '2023-06-26', 'ABC', 'CDE', 'VESSEL', 'LADING', 2000.00, 300.00, 302.00, 23.00, 43.00, 23.00, 2691.00, 1, 2691.00, 'TEST', 'TEST', 272, 9482, 606230.93),
(5, 'EXPORT', 'Complete', '2023-06-30', 'abc', 'xcd', 'qwe', 'qwe', 2323.00, 232.00, 3.00, 12.00, 12.00, 321.00, 2903.00, 1, 2903.00, 'qwe', 'qwe', 106, 3710, 186170.59);

-- --------------------------------------------------------

--
-- Table structure for table `category_expenses`
--

CREATE TABLE `category_expenses` (
  `id` int(11) NOT NULL,
  `category` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category_expenses`
--

INSERT INTO `category_expenses` (`id`, `category`) VALUES
(68, '  EJN SALARIES'),
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
(80, 'Other Expense'),
(83, 'Transportation Expenses'),
(84, 'OVERTIME EXPENSES'),
(85, 'SALARIES EXPENSES'),
(86, 'MALOONG EXPENSES'),
(87, 'MKTG. EXPENSES'),
(88, 'ZAMBOANGA PCF'),
(89, ' FREIGHT TO ZAMBO EXPENSES '),
(90, 'FREIGHT TO LAM EXPENSES'),
(91, 'MALOONG PLANTATION EXP.'),
(92, 'SAYUGAN EXPENSES'),
(93, 'LDC EXPENSES'),
(94, 'LACAFE EXPENSES'),
(95, 'TRANSPORTING FEE'),
(96, 'BOOKKEEPING EXPENSES'),
(97, 'ALLOWANCE FOR BUYING EXPENSES'),
(98, 'LOADING/UNLOADING EXPENSES'),
(99, 'ROOASTER EXPENSES'),
(100, 'KATHY EXPENSES'),
(101, 'KELVIN EXPENSES'),
(102, 'JBN EXPENSES'),
(103, 'DOLLAR EXCHANGES'),
(104, 'BIR EXPENSES'),
(105, 'LTO REGISTRATION EXPENSES'),
(106, 'GASOLINE/FUEL/LUBRICANT EXP.'),
(107, 'MANILA PCF'),
(108, 'TRUCK EXPENSES'),
(109, 'NTC expenses');

-- --------------------------------------------------------

--
-- Table structure for table `coffee_customer`
--

CREATE TABLE `coffee_customer` (
  `cof_customer_id` int(11) NOT NULL,
  `cof_customer_name` varchar(255) NOT NULL,
  `cof_customer_address` varchar(255) NOT NULL,
  `cof_customer_contact` varchar(50) NOT NULL,
  `cof_customer_balance` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coffee_customer`
--

INSERT INTO `coffee_customer` (`cof_customer_id`, `cof_customer_name`, `cof_customer_address`, `cof_customer_contact`, `cof_customer_balance`) VALUES
(1, 'a', 'b', 'c', 0.00),
(2, 'a', 'b', 'ca', 0.00),
(3, 'abc', '12345', 'nkjgiyf', 0.00),
(4, 'abc', '12345', 'nkjgiyf', 0.00),
(5, 'qwertyu', 'sdfghj', 'xcvbnm', 0.00),
(6, 'asdf', 'dfg', 'dfgq1', 0.00),
(7, 'asdf', 'dfg', 'dfgq1', 0.00),
(8, '12345', 'asdfghj', 'zxcvbnm', 0.00),
(9, '1111', '22222222222', '33333333333333', 0.00),
(10, '1111', '22222222222', '33333333333333', 0.00),
(11, '1111', '22222222222', '33333333333333', 0.00),
(12, '0000000000', '9999999999999', 'ooooooooooooooooooooo', 0.00),
(13, '0000000000', '9999999999999', 'ooooooooooooooooooooo', 0.00),
(14, '0000000000', '9999999999999', 'ooooooooooooooooooooo', 0.00),
(15, 'l', 'l', 'l', 0.00),
(16, 'l', 'l', 'l', 0.00),
(17, 'name here', 'address sample', '1234567890', 0.00),
(18, 'name here', 'address sample', '1234567890', 0.00),
(19, 'name here', 'address sample', '1234567890', 0.00),
(20, 'test', 'test', 'test', 0.00),
(21, 'rd', 'lala', 'dale', 0.00),
(22, 'abc', 'abc', 'abc', 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `coffee_sale`
--

CREATE TABLE `coffee_sale` (
  `coffee_id` int(11) NOT NULL,
  `coffee_status` varchar(255) DEFAULT NULL,
  `coffee_no` varchar(255) DEFAULT NULL,
  `coffee_date` date DEFAULT NULL,
  `coffee_customer` varchar(255) DEFAULT NULL,
  `coffee_total_amount` decimal(15,2) DEFAULT NULL,
  `coffee_paid` decimal(15,2) DEFAULT NULL,
  `coffee_balance` decimal(15,2) GENERATED ALWAYS AS (`coffee_total_amount` - `coffee_paid`) VIRTUAL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coffee_sale`
--

INSERT INTO `coffee_sale` (`coffee_id`, `coffee_status`, `coffee_no`, `coffee_date`, `coffee_customer`, `coffee_total_amount`, `coffee_paid`) VALUES
(10, 'On Account', 'ACV', '2023-06-15', 'RONALD', 384.00, 300.00),
(11, 'Paid', '232', '2023-06-15', 'RONALD', 4600.00, 4600.00);

-- --------------------------------------------------------

--
-- Table structure for table `coffee_sale_line`
--

CREATE TABLE `coffee_sale_line` (
  `line_id` int(11) NOT NULL,
  `coffee_id` int(11) DEFAULT NULL,
  `product` varchar(255) DEFAULT NULL,
  `unit` int(11) DEFAULT NULL,
  `price` decimal(15,2) DEFAULT NULL,
  `amount` decimal(15,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coffee_sale_line`
--

INSERT INTO `coffee_sale_line` (`line_id`, `coffee_id`, `product`, `unit`, `price`, `amount`) VALUES
(7, 0, 'LC_R', 2, 23.00, 46.00),
(8, 10, 'LC_W_KG', 12, 32.00, 384.00),
(9, 11, 'LC_R', 23, 200.00, 4600.00);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dry_price_transfer`
--

CREATE TABLE `dry_price_transfer` (
  `dry_id` int(11) NOT NULL,
  `seller` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `net` decimal(10,2) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `cash_advance` decimal(10,2) DEFAULT NULL,
  `planta_status` int(11) DEFAULT NULL,
  `recorded_by` varchar(255) DEFAULT NULL,
  `loc` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dry_price_transfer`
--

INSERT INTO `dry_price_transfer` (`dry_id`, `seller`, `address`, `date`, `net`, `price`, `cash_advance`, `planta_status`, `recorded_by`, `loc`, `type`) VALUES
(1, 'DANNY BARANDINO', 'ISABELA CITY', '2023-05-19', 2685.00, 50.00, 0.00, 0, 'JANE', 'Basilan', 'DRY'),
(2, 'DANNY BARANDINO', 'ISABELA CITY', '2023-05-03', 1730.00, 50.00, 0.00, 0, 'JANE', 'Basilan', 'DRY'),
(3, 'DANNY BARANDINO', 'ISABELA CITY', '2023-04-18', 2725.00, 50.00, 0.00, 1, 'JANE', 'Basilan', 'DRY'),
(4, 'JARWIN GARCIA', 'CALVARIO, LAMITAN CITY', '2023-04-28', 9970.00, 51.00, 0.00, 1, 'JANE', 'Basilan', 'DRY'),
(5, 'JARWIN GARCIA', 'CALVARIO, LAMITAN CITY', '2023-05-02', 9885.00, 51.00, 0.00, 0, 'JANE', 'Basilan', 'DRY'),
(6, 'JARWIN GARCIA', 'CALVARIO, LAMITAN CITY', '2023-05-10', 8200.00, 51.00, 0.00, 0, 'JANE', 'Basilan', 'DRY'),
(7, 'JARWIN GARCIA', 'CALVARIO, LAMITAN CITY', '2023-05-15', 8340.00, 51.00, 0.00, 0, 'JANE', 'Basilan', 'DRY'),
(8, 'JARWIN GARCIA', 'CALVARIO, LAMITAN CITY', '2023-04-17', 7030.00, 50.00, 0.00, 1, 'JANE', 'Basilan', 'DRY'),
(9, 'JARWIN GARCIA', 'CALVARIO, LAMITAN CITY', '2023-04-15', 4575.00, 50.00, 0.00, 1, 'JANE', 'Basilan', 'DRY'),
(10, 'JARWIN GARCIA', 'BALAGTASAN/ULAMI, LAMITAN CITY', '2023-04-10', 5230.00, 50.00, 0.00, 1, 'JANE', 'Basilan', 'DRY'),
(11, 'JARWIN GARCIA', 'CALVARIO, LAMITAN CITY', '2023-03-30', 4840.00, 50.00, 0.00, 1, 'JANE', 'Basilan', 'DRY'),
(12, 'JIMROY MCCLINTOCK', 'MALOONG, LAMITAN CITY', '2023-05-04', 4295.00, 50.00, 0.00, 1, 'JANE', 'Basilan', 'DRY'),
(13, 'TATA HALAL', 'BULINGAN, LAMITAN CITY', '0023-04-04', 12335.00, 51.50, 0.00, 1, 'JANE', 'Basilan', 'DRY'),
(14, 'TATA HALAL', 'BULINGAN, LAMITAN CITY', '2023-04-04', 5255.00, 51.00, 0.00, 1, 'JANE', 'Basilan', 'DRY'),
(15, 'TATA HALAL', 'BULINGAN, LAMITAN CITY', '2023-03-07', 13475.00, 50.00, 0.00, 1, 'JANE', 'Basilan', 'DRY'),
(16, 'EPIGIL MOLEJE', 'MALOONG SAN JOSE, LAMITAN CITY', '2023-05-16', 4967.00, 50.00, 0.00, 1, 'JANE', 'Basilan', 'DRY'),
(17, 'EPIGIL MOLEJE', 'MALOONG SAN JOSE, LAMITAN CITY', '2023-04-17', 3425.00, 50.00, 0.00, 1, 'JANE', 'Basilan', 'DRY'),
(18, 'EPIGIL MOLEJE', 'MALOONG SAN JOSE, LAMITAN CITY', '2023-03-25', 6725.00, 50.00, 0.00, 1, 'JANE', 'Basilan', 'DRY'),
(19, 'EPIGIL MOLEJE', 'MALOONG SAN JOSE, LAMITAN CITY', '2023-02-16', 5588.00, 50.00, 0.00, 1, 'JANE', 'Basilan', 'DRY'),
(20, 'EPIGIL MOLEJE', 'MALOONG SAN JOSE, LAMITAN CITY', '2023-01-31', 6304.00, 48.00, 0.00, 1, 'JANE', 'Basilan', 'DRY'),
(21, 'EPIGIL MOLEJE', 'MALOONG SAN JOSE, LAMITAN CITY', '2023-01-23', 5319.00, 46.00, 0.00, 1, 'JANE', 'Basilan', 'DRY'),
(22, 'EPIGIL MOLEJE', 'MALOONG SAN JOSE, LAMITAN CITY', '2023-01-04', 4040.00, 46.00, 0.00, 1, 'JANE', 'Basilan', 'DRY'),
(23, 'RUBEN RAMOS', '6KM. ISABELA CITY', '2023-05-01', 2558.00, 51.00, 0.00, 0, 'JANE', 'Basilan', 'DRY'),
(24, 'RUBEN RAMOS', '6KM. ISABELA CITY', '2023-05-16', 2113.00, 51.00, 20000.00, 0, 'JANE', 'Basilan', 'DRY'),
(25, 'RUBEN RAMOS', '6KM. ISABELA CITY', '2023-03-31', 4029.00, 51.00, 0.00, 1, 'JANE', 'Basilan', 'DRY'),
(27, 'JIMROY MCCLINTOCK', 'MALOONG, LAMITAN CITY', '2023-04-24', 3759.00, 51.00, 0.00, 1, 'JANE', 'Basilan', 'DRY'),
(29, 'JARWIN GARCIA', 'CALVARIO, LAMITAN CITY', '2023-04-01', 11390.00, 50.00, 0.00, 1, 'JANE', 'Basilan', 'DRY'),
(30, 'JIMROY MCCLINTOCK', 'MALOONG, LAMITAN CITY', '2023-04-10', 6385.00, 51.00, 0.00, 1, 'DALE', 'Basilan', 'DRY'),
(31, 'JIMROY MCCLINTOCK', 'MALOONG, LAMITAN CITY', '2023-03-28', 4709.00, 50.00, 0.00, 1, 'DALE', 'Basilan', 'DRY'),
(32, 'LITO PURI', 'Limutun', '2023-04-05', 5585.00, 0.00, 0.00, 1, 'JANE', 'Basilan', 'DRY'),
(33, 'LITO PURI', 'Limutun', '2023-02-28', 5530.00, 0.00, 0.00, 1, 'JANE', 'Basilan', 'DRY'),
(34, 'JIMROY MCCLINTOCK', 'MALOONG, LAMITAN CITY', '2023-03-10', 5305.00, 50.00, 0.00, 1, 'JANE', 'Basilan', 'DRY'),
(35, 'JIMROY MCCLINTOCK', 'MALOONG, LAMITAN CITY', '2023-02-27', 3320.00, 50.00, 0.00, 1, 'DALE', 'Basilan', 'DRY'),
(36, 'JIMROY MCCLINTOCK', 'MALOONG, LAMITAN CITY', '2023-02-16', 8907.00, 50.00, 0.00, 1, 'JANE', 'Basilan', 'DRY'),
(37, 'JIMROY MCCLINTOCK', 'MALOONG, LAMITAN CITY', '2023-01-30', 4950.00, 46.00, 0.00, 1, 'JANE', 'Basilan', 'DRY'),
(38, 'LONG2X SAN JUAN', 'LAMITAN CITY', '2023-05-13', 12410.00, 53.00, 0.00, 0, 'JANE', 'Basilan', 'DRY'),
(39, 'LONG2X SAN JUAN', 'LAMITAN CITY', '2023-04-04', 14085.00, 53.00, 0.00, 0, 'JANE', 'Basilan', 'DRY'),
(40, 'JERRY ARIERO', 'ULAMI, LAMITAN CITY', '2023-05-19', 2075.00, 50.00, 25000.00, 0, 'JANE', 'Basilan', 'DRY'),
(41, 'LONG2X SAN JUAN', 'LAMITAN CITY', '2023-05-01', 17500.00, 53.00, 0.00, 0, 'JANE', 'Basilan', 'DRY'),
(42, 'LONG2X SAN JUAN', 'LAMITAN CITY', '2023-04-28', 11480.00, 53.00, 0.00, 1, 'JANE', 'Basilan', 'DRY'),
(43, 'JERRY ARIERO', 'ULAMI, LAMITAN CITY', '2023-04-25', 3557.00, 50.00, 80000.00, 1, 'JANE', 'Basilan', 'DRY'),
(44, 'JERRY ARIERO', 'ULAMI, LAMITAN CITY', '2023-03-30', 4336.00, 50.00, 70000.00, 1, 'JANE', 'Basilan', 'DRY'),
(45, 'CHARLIE CAWLEY', 'LAMITAN CITY', '2022-12-28', 8405.00, 48.00, 0.00, 1, 'JANE', 'Basilan', 'DRY'),
(46, 'CHARLIE CAWLEY', 'LAMITAN CITY', '2023-01-04', 10375.00, 48.00, 0.00, 1, 'JANE', 'Basilan', 'DRY'),
(47, 'CHARLIE CAWLEY', 'LAMITAN CITY', '2023-01-11', 11405.00, 48.00, 0.00, 1, 'JANE', 'Basilan', 'DRY'),
(48, 'CHARLIE CAWLEY', 'LAMITAN CITY', '2023-01-18', 10270.00, 48.00, 0.00, 1, 'JANE', 'Basilan', 'DRY'),
(49, 'CHARLIE CAWLEY', 'LAMITAN CITY', '2023-01-25', 10015.00, 48.00, 0.00, 1, 'JANE', 'Basilan', 'DRY'),
(50, 'CHARLIE CAWLEY', 'LAMITAN CITY', '2023-02-01', 10910.00, 0.00, 0.00, 1, 'JANE', 'Basilan', 'DRY'),
(51, 'EPIGIL MOLEJE', 'MALOONG SAN JOSE, LAMITAN CITY', '2023-05-20', 3498.00, 51.00, 0.00, 0, 'JANE', 'Basilan', 'DRY'),
(52, 'LOUIE DELOS REYES', 'PANUNSULAN, ISABELA CITY', '2023-05-22', 3355.00, 52.00, 0.00, 0, 'JANE', 'Basilan', 'DRY'),
(53, 'LOUIE DELOS REYES', 'PANUNSULAN, ISABELA CITY', '2023-05-10', 4095.00, 52.00, 0.00, 0, 'JANE', 'Basilan', 'DRY'),
(56, 'HON. ARLEIGH EISMA', 'LAMITAN CITY', '2023-05-04', 2795.00, 0.00, 0.00, 1, 'JANE', 'Basilan', 'DRY'),
(58, 'CHARLIE CAWLEY', 'BAROY, LAMITAN CITY', '2023-02-08', 10465.00, 50.00, 0.00, 1, 'JANE', 'Basilan', 'DRY'),
(59, 'CHARLIE CAWLEY', 'BAROY, LAMITAN CITY', '2023-02-15', 9325.00, 50.00, 0.00, 1, 'JANE', 'Basilan', 'DRY'),
(60, 'CHARLIE CAWLEY', 'BAROY, LAMITAN CITY', '2023-02-22', 8815.00, 0.00, 0.00, 1, 'JANE', 'Basilan', 'DRY'),
(61, 'CHARLIE CAWLEY', 'BAROY, LAMITAN CITY', '2023-03-01', 8110.00, 50.00, 0.00, 1, 'JANE', 'Basilan', 'DRY'),
(62, 'CHARLIE CAWLEY', 'BAROY, LAMITAN CITY', '2023-03-08', 8525.00, 50.00, 0.00, 1, 'JANE', 'Basilan', 'DRY'),
(63, 'CHARLIE CAWLEY', 'BAROY, LAMITAN CITY', '2023-03-15', 8450.00, 0.00, 0.00, 1, 'JANE', 'Basilan', 'DRY'),
(64, 'CHARLIE CAWLEY', 'BAROY, LAMITAN CITY', '2023-03-22', 7275.00, 48.00, 0.00, 1, 'JANE', 'Basilan', 'DRY'),
(65, 'CHARLIE CAWLEY', 'BAROY, LAMITAN CITY', '2023-03-29', 8135.00, 48.00, 0.00, 1, 'JANE', 'Basilan', 'DRY'),
(66, 'CHARLIE CAWLEY', 'BAROY, LAMITAN CITY', '2023-04-05', 6985.00, 48.00, 0.00, 1, 'JANE', 'Basilan', 'DRY'),
(67, 'CHARLIE CAWLEY', 'BAROY, LAMITAN CITY', '2023-04-12', 8045.00, 48.00, 0.00, 1, 'JANE', 'Basilan', 'DRY'),
(68, 'CHARLIE CAWLEY', 'BAROY, LAMITAN CITY', '2023-04-19', 9215.00, 52.00, 0.00, 1, 'JANE', 'Basilan', 'DRY'),
(69, 'CHARLIE CAWLEY', 'BAROY, LAMITAN CITY', '2023-04-26', 8125.00, 52.00, 0.00, 1, 'JANE', 'Basilan', 'DRY'),
(70, 'CHARLIE CAWLEY', 'BAROY, LAMITAN CITY', '2023-05-03', 7625.00, 52.00, 0.00, 1, 'JANE', 'Basilan', 'DRY'),
(72, 'CHARLIE CAWLEY', 'BAROY, LAMITAN CITY', '2023-05-16', 8315.00, 52.00, 0.00, 1, 'JANE', 'Basilan', 'DRY'),
(73, 'EPIGIL MOLEJE', 'MALOONG SAN JOSE, LAMITAN CITY', '2023-04-03', 2125.00, 51.00, 0.00, 1, 'JANE', 'Basilan', 'DRY'),
(74, 'EPIGIL MOLEJE', 'MALOONG SAN JOSE, LAMITAN CITY', '2023-03-06', 5570.00, 50.00, 0.00, 1, 'JANE', 'Basilan', 'DRY'),
(75, 'JIMROY MCCLINTOCK', 'MALOONG, LAMITAN CITY', '2023-05-23', 5504.00, 51.00, 0.00, 0, 'JANE', 'Basilan', 'DRY'),
(76, 'NENETH COSTAN', 'KAIBAAN/KAPENGKONGAN', '2023-03-30', 3540.00, 51.00, 0.00, 1, 'JANE', 'Basilan', 'DRY'),
(77, 'NENETH COSTAN', 'MATARLING/BANYAS', '2023-04-02', 6325.00, 51.00, 0.00, 1, 'JANE', 'Basilan', 'DRY'),
(78, 'LONG2X SAN JUAN', 'SAYUGAN, LAMITAN CITY', '2023-04-03', 10350.00, 51.00, 0.00, 1, 'JANE', 'Basilan', 'DRY'),
(79, 'NENETH COSTAN', 'WILLIE TAN-BUSAY', '2023-04-03', 5810.00, 51.00, 0.00, 1, 'JANE', 'Basilan', 'DRY'),
(80, 'LONG2X SAN JUAN', 'LAMITAN CITY', '2023-04-05', 11820.00, 53.00, 0.00, 1, 'JANE', 'Basilan', 'DRY'),
(81, 'LONG2X SAN JUAN', 'SAYUGAN, LAMITAN CITY', '2023-04-11', 10845.00, 53.00, 0.00, 1, 'JANE', 'Basilan', 'DRY'),
(82, 'HON. ARLEIGH EISMA', 'BOHE YAWAS, LAMITAN CITY', '2023-04-17', 2505.00, 0.00, 0.00, 1, 'JANE', 'Basilan', 'DRY'),
(83, 'CHARLIE CAWLEY', 'BAROY, LAMITAN CITY', '2023-05-24', 8775.00, 52.00, 0.00, 1, 'JANE', 'Basilan', 'DRY'),
(84, 'CHARLIE CAWLEY', 'LAMITAN CITY', '2023-05-10', 8585.00, 52.00, 0.00, 0, 'JANE', 'Basilan', 'DRY'),
(85, 'JARWIN GARCIA', 'BALAGTASAN, LAMITAN CITY', '2023-05-25', 6615.00, 51.00, 0.00, 0, 'JANE', 'Basilan', 'DRY'),
(86, 'LOUIE DELOS REYES', 'PANUNSULAN, ISABELA CITY', '2023-05-26', 4175.00, 52.00, 0.00, 1, 'JANE', 'Basilan', 'DRY'),
(88, 'CHARLIE CAWLEY', 'LAMITAN CITY', '2023-05-31', 8855.00, 52.00, 0.00, 0, 'JANE', 'Basilan', 'DRY'),
(89, 'EPIGIL MOLEJE', 'MALOONG SAN JOSE, LAMITAN CITY', '2023-05-31', 3800.00, 51.00, 0.00, 0, 'JANE', 'Basilan', 'DRY'),
(90, 'JARWIN GARCIA', 'CALVARIO, LAMITAN CITY', '2023-05-31', 12810.00, 51.00, 0.00, 0, 'JANE', 'Basilan', 'DRY'),
(91, 'JERRY ARIERO', 'ULAMI, LAMITAN CITY', '2023-05-29', 3393.00, 51.00, 0.00, 0, 'JANE', 'Basilan', 'DRY'),
(93, 'LITO PURI', 'lamitan', '2023-06-01', 5005.00, 0.00, 0.00, 0, 'JANE', 'Basilan', 'DRY'),
(97, 'HON. ARLEIGH EISMA', 'LAMITAN CITY', '2023-06-03', 2850.00, 0.00, 0.00, 0, 'JANE', 'Basilan', 'DRY'),
(99, 'RUBEN RAMOS', '6KM. ISABELA CITY', '2023-05-31', 2307.00, 51.00, 0.00, 0, 'JANE', 'Basilan', 'DRY'),
(100, 'JARWIN GARCIA', 'CALVARIO, LAMITAN CITY', '2023-06-03', 10905.00, 51.00, 0.00, 0, 'JANE', 'Basilan', 'DRY'),
(101, 'TATA HALAL', 'BULINGAN, LAMITAN CITY', '2023-06-03', 14790.00, 52.00, 0.00, 0, 'JANE', 'Basilan', 'DRY'),
(102, 'JERRY ARIERO', 'ULAMI, LAMITAN CITY', '2023-05-30', 2515.00, 51.00, 0.00, 0, 'JANE', 'Basilan', 'DRY'),
(103, 'TATA HALAL', 'BULINGAN, LAMITAN CITY', '2023-06-05', 4150.00, 52.00, 0.00, 1, 'JANE', 'Basilan', 'DRY'),
(104, 'JIMROY MCCLINTOCK', 'MALOONG, LAMITAN CITY', '2023-06-06', 4725.00, 51.00, 0.00, 0, 'JANE', 'Basilan', 'DRY'),
(105, 'LOUIE DELOS REYES', 'PANUNSULAN, ISABELA CITY', '2023-06-06', 3340.00, 51.00, 0.00, 0, 'JANE', 'Basilan', 'DRY'),
(106, 'CHARLIE CAWLEY', 'LAMITAN CITY', '2023-06-07', 9090.00, 50.00, 0.00, 0, 'JANE', 'Basilan', 'DRY'),
(107, 'EPIGIL MOLEJE', 'MALOONG SAN JOSE, LAMITAN CITY', '2023-06-07', 4069.00, 51.00, 0.00, 0, 'JANE', 'Basilan', 'DRY'),
(108, 'TATA HALAL', 'BULINGAN, LAMITAN CITY', '2023-06-13', 9180.00, 52.00, 0.00, 0, 'JANE', 'Basilan', 'DRY'),
(109, 'JARWIN GARCIA', 'CALVARIO, LAMITAN CITY', '2023-06-13', 13860.00, 51.00, 0.00, 0, 'JANE', 'Basilan', 'DRY'),
(110, 'JERRY ARIERO', 'ULAMI, LAMITAN CITY', '2023-06-13', 1906.00, 51.00, 0.00, 0, 'JANE', 'Basilan', 'DRY'),
(111, 'LOUIE DELOS REYES', 'PANUNSULAN, ISABELA CITY', '2023-06-13', 8010.00, 52.00, 0.00, 1, 'JANE', 'Basilan', 'DRY'),
(112, 'RONIE VILDAD', 'MALOONG, LAMITAN CITY', '2023-06-18', 5000.00, 52.00, 0.00, 0, 'JANE', 'Basilan', 'DRY'),
(113, 'NENETH COSTAN', 'TABIAWAN, ISABELA CITY', '2023-06-19', 5000.00, 50.00, 0.00, 0, 'JANE', 'Basilan', 'DRY');

-- --------------------------------------------------------

--
-- Table structure for table `ejn_rubber_transfer`
--

CREATE TABLE `ejn_rubber_transfer` (
  `ejn_id` int(11) NOT NULL,
  `supplier` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `total_buying_weight` decimal(10,2) DEFAULT NULL,
  `total_purchase_cost` decimal(10,2) DEFAULT NULL,
  `ave_kiloCost` decimal(10,2) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `planta_status` int(11) DEFAULT NULL,
  `recorded_by` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `source` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ejn_rubber_transfer`
--

INSERT INTO `ejn_rubber_transfer` (`ejn_id`, `supplier`, `location`, `date`, `total_buying_weight`, `total_purchase_cost`, `ave_kiloCost`, `remarks`, `planta_status`, `recorded_by`, `type`, `source`) VALUES
(2, 'EJN RUBBER', 'LAMITAN CITY', '2023-05-21', 1000.00, 32222.00, 32.22, 'Test', 0, 'JANE', 'EJN', 'Basilan'),
(3, ' EJN RUBBER ', ' LAMITAN CITY ', '2023-05-26', 22000.00, 233233.00, 10.60, '  ', 0, ' JANE ', 'EJN', 'Basilan');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(27, '2023-05-02', '40449', 'henry abuena', '1547', '20', '30940', '', '0', '20', '6188', '', '', '6188'),
(28, '2023-05-09', '40939', 'JBn share buaha wet', '1547', '20', '30940', '40', '12376', '', '0', '', '', '0'),
(29, '2023-06-01', '41254', 'ejn share buahan', '1564', '20', '31280', '40', '12512', '', '0', '', '', '0'),
(30, '2023-06-01', '41253', 'henry arbuena', '1564', '20', '31280', '', '0', '20', '6256', '', '', '6256'),
(31, '2023-06-01', '2965', 'johan', '199', '20', '3980', '', '0', '40', '1592', 'Cash Advance', '500', '1092'),
(32, '2023-06-01', '2963', 'nonoy', '451', '20', '9020', '', '0', '40', '3608', 'Cash Advance', '2160', '1448'),
(33, '2023-06-01', '2962', 'sandijas', '290', '20', '5800', '', '0', '40', '2320', 'Cash Advance', '2160', '160'),
(34, '2023-06-01', '2964', 'sanogal', '425', '20', '8500', '', '0', '40', '3400', 'Cash Advance', '2160', '1240');

-- --------------------------------------------------------

--
-- Table structure for table `ledger_buying_station`
--

CREATE TABLE `ledger_buying_station` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(641, '2023-05-03', '143', 'long san juan', 'Sayugan Buying Station', 'Customer', '135000'),
(642, '2023-05-04', '0145', 'LONG2X SAN JUAN', 'Sayugan Buying Station', 'Customer', '50000'),
(643, '2023-05-04', '40910', 'EDITH BUTONA', 'ZAMBOANGA HELPER CLARET', 'Employee', '6000'),
(644, '2023-05-04', '0144', 'jimroy McClintock', 'WET BUYING DRY PRICE', 'Customer', '50000'),
(645, '2023-05-05', '0147', 'LONG2X SAN JUAN', 'Sayugan Buying Station', 'Customer', '86968'),
(646, '2023-05-05', '0148', 'LONG2X SAN JUAN', 'Sayugan Buying Station', 'Customer', '100000'),
(647, '2023-05-05', '0146', 'JERRY ARIORA', 'Sayugan Buying Station', 'Customer', '25000'),
(648, '2023-05-06', '40140', 'julio aballa', 'cash advance against salary', 'Employee', '5000'),
(649, '2023-05-06', '40151', 'contractual miller/crumbling/pogonero/furnace/guar', 'cash advance against bales', 'Maloong Contractual', '63500'),
(650, '2023-05-08', '40934', 'JOEY ORTEGA', 'CASH ADVANCE AGAINST SALARY GUARD SAYUGAN', 'Employee', '6000'),
(651, '2023-05-08', '0153', 'TATA ALFARO', 'CASH ADVANCE FOR DRY PRICE', 'Customer', '100000'),
(652, '2023-05-08', '40929', 'ERWIN GADU POGONERO', 'CASH ADVANCE FOR PERSONAL', 'Maloong Contractual', '7000'),
(653, '2023-05-08', '40928', 'REYNALDO NONOY ', 'CASH ADVANCE AGAINST CRUMBLING', 'Maloong Contractual', '7000'),
(654, '2023-05-08', '0152', 'NENET CONSTAN', 'CASH ADVANCE FOR EXPORT', 'Customer', '300000'),
(655, '2023-05-08', '0151', 'LONG2X SAN JUAN', 'CASH ADVANCE FOR RUBBER', 'Customer', '100000'),
(656, '2023-05-09', '0410', 'nenet', 'copra buying c.a', 'Customer', '100000'),
(657, '2023-05-09', '0409', 'amin abubakar', 'copra buying c.a', 'Customer', '200000'),
(658, '2023-05-09', '0157', 'long2x san juan', 'cash advance for dry price rubber', 'Customer', '100000'),
(659, '2023-05-09', '0156', 'jimroy McClintock', 'cash advance for dry price wet', 'Customer', '50000'),
(660, '2023-05-09', '0154', 'mudzkier adburahman', 'for wet 1 container export', 'Customer', '300000'),
(661, '2023-05-10', '27659', 'berto ahilul', 'cash advance for copra buying', 'Customer', '2000'),
(662, '2023-05-10', '40948', 'ar haim abdurajak', 'cash advance for salary', 'Customer', '2000'),
(663, '2023-05-10', '0161', 'nenet', 'cash advance for wet export', 'Customer', '150000'),
(664, '2023-05-10', '0160', 'long2x san juan', 'cash advance for dry price', 'Customer', '50000'),
(665, '2023-05-10', '0163', 'jarwin garcia', 'cash advance for dry price', 'Customer', '100000'),
(666, '2023-05-10', '40163', 'topen.manuel crumbling', 'cash advance for bales', 'Maloong Contractual', '14000'),
(667, '2023-05-10', '0158', 'louie delos reyes', 'cash advance for dry price', 'Customer', '150000'),
(668, '2023-05-10', '40941', 'noel guanznon', 'cash advance against salary', 'Employee', '10000'),
(669, '2023-05-10', '0159', 'long2x san juan', 'cash advance for wet export', 'Customer', '200000'),
(670, '2023-05-11', '0166', 'tata halal', 'wet buying FOR DRY', 'Customer', '50000'),
(671, '2023-05-11', '0165', 'TATA HALAL', 'WET BUYING FOR DRY', 'Customer', '50000'),
(672, '2023-05-12', '0167', 'LONG2X SAN JUAN', 'WET BUYING FOR MILLING', 'Customer', '100000'),
(673, '2023-05-13', '0170', 'NENET CONSTAN', 'WET BUYING EXPORT', 'Customer', '100000'),
(674, '2023-05-13', '39863', 'EDITHA LABANDERA', 'CASH ADVANCE FOR LABADA', 'HELPER LABANDERA', '500'),
(675, '2023-05-13', '0169', 'SAMMAN AWALIN', 'CASH ADVANCE FOR WET BUYING', 'Customer', '300000'),
(676, '2023-05-13', '0168', 'TATA HALAL', 'CASH ADVANCE FOR DRY PRICE', 'Customer', '50000'),
(677, '2023-05-13', '40171', 'ANTHONY CASTIL', 'CASH ADVANCE FOR SALARY', 'Employee MALOONG', '10000'),
(678, '2023-05-13', '40167', 'TOTO CASTIL', 'CASH ADVANCE FOR SALARY', 'Employee-MALOONG', '5000'),
(679, '2023-05-15', '39810', 'emelito langutan', 'cash advance for salary', 'Employee', '3000'),
(680, '2023-05-15', '39806', 'ERNESTO NALAM', 'CASH ADVANCE AGAINST SALARY', 'Employee', '2000'),
(681, '2023-05-15', '39888', 'ROGELIO ADAYA JR', 'CASH ADVANCE FOR SALARY', 'Employee', '3000'),
(682, '2023-05-15', '39894', 'MERCY PALCONIT', 'HELPER CASH ADVANCE', 'Employee', '1000'),
(683, '2023-05-15', '39883', 'RODJANE QUINOL', 'CASH ADVANCE FOR SALARY', 'Employee', '5000'),
(684, '2023-05-15', '39887', 'IRENEO TORRES', 'CASH ADVANCE FOR SALARY', 'Employee', '5000'),
(685, '2023-05-15', '39886', 'BERT ENRIQUEZ', 'CASH ADVANCE FOR SALARY', 'Employee', '4500'),
(686, '2023-05-15', '39892', 'ERIC MANUEL', 'CASH ADVANCE FOR SALARY', 'Employee', '6500'),
(687, '2023-05-15', '39885', 'DAYANARA REMIGIO', 'CASH ADVANCE FOR SALARY', 'Customer', '4500'),
(688, '2023-05-15', '39882', 'RAQUEL BAIS', 'CASH ADVANCE FOR SALARY', 'Employee', '10000'),
(689, '2023-05-15', '39879', 'GIGI BAPURA', 'CSH ADVANCE FOR SALARY', 'Employee', '4400'),
(690, '2023-05-15', '0416', 'RASHID AMILIN', 'CASH ADVANCE FOR COPRA', 'Customer', '200000'),
(691, '2023-05-15', '39876', 'MAE ANGELES', 'CASH ADVANCE FOR SALARY', 'Employee', '8500'),
(692, '2023-05-15', '0172', 'LONG2X SAN JUAN', 'CASH ADVANCE FOR EXPORT', 'Customer', '200000'),
(693, '2023-05-15', '0171', 'JARWIN GARCIA', 'CASH ADVANCE FOR DRY', 'Customer', '100000'),
(694, '2023-05-15', '39803', 'BRIAN ALBUTRA', 'CASH ADVANCE FOR SALARY', 'Employee', '5000'),
(695, '2023-05-15', '40952', 'GREGORIO MATULAC', 'CASH ADVANCE FOR SALARY', 'Employee-MALOONG', '3800'),
(696, '2023-05-15', '40952', 'GREGORIO MATULAC', 'CASH ADVANCE FOR SALARY', 'Employee-MALOONG', '3800'),
(697, '2023-05-15', '40953', 'EDWIN ASILAN', 'CASH ADVANCE FOR SALARY', 'Employee-MALOONG', '3800'),
(698, '2023-05-15', '40951', 'RONIE VILDAD', 'CASH ADVANCE FOR SALARY', 'Employee-MALOONG', '4000'),
(699, '2023-05-15', '40195', 'Ramillano Samuel', 'cash advance for salary', 'Employee-maloong', '5000'),
(700, '2023-05-15', '40197', 'cristobak edmundo', 'cash advance for salary', 'Employee', '6000'),
(701, '2023-05-15', '40198', 'pelegrin ramil', 'cash advance for salary', 'Employee-maloong', '3000'),
(702, '2023-05-15', '40199', 'cerilo sualog', 'cash advance for salary', 'Employee-maloong', '4000'),
(703, '2023-05-15', '40200', 'cornelio albert', 'cash advance for salary', 'Employee-maloong', '3000'),
(704, '2023-05-15', '40181', 'jovylyn samijon', 'cashn advance for salary', 'Employee-employee', '4000'),
(705, '2023-05-15', '40196', 'bonifacio alvin', 'cash advance for salary', 'Employee-maloong', '3000'),
(706, '2023-05-15', '40182', 'galano berto', 'cash advance for salary', 'Employee-maloong', '7000'),
(707, '2023-05-15', '40186', 'managuit jonathan', 'cash advance for salary', 'Employee-maloong', '9000'),
(708, '2023-05-15', '40187', 'corpuz dennis', 'cash advance for salary', 'Employee-maloong', '3000'),
(709, '2023-05-15', '40188', 'hipulan pablo', 'cash advance for salary', 'Employee-maloong', '4000'),
(710, '2023-05-15', '40189', 'luang ederito', 'cash advance for salary', 'employee-maloong', '3000'),
(711, '2023-05-15', '40190', 'pentojo dindo', 'cash advance for salary', 'Employee-maloong', '4000'),
(712, '2023-05-15', '40191', 'melvin ferer', 'cash advance for salary', 'Employee-maloong', '4500'),
(713, '2023-05-15', '40192', 'abaraquez rap2x', 'cash advance for salary', 'Employee-maloong', '3000'),
(714, '2023-05-15', '40193', 'garcia jerry', 'cash advance for salary', 'Employee-maloong', '3000'),
(715, '2023-05-15', '40194', 'abella jeanne', 'cash advance for salary', 'Employee-maloong', '7000'),
(716, '2023-05-15', '39871', 'JEROME ALCOREZA', 'CASH ADVANCE FOR TOPPING WET', 'MALOONG TOPPERS', '500'),
(717, '2023-05-15', '39871', 'OSCAR BALAGOHAN', 'CASH ADVANCE FOR WET TOPPING', 'MALOONG TOPPERS', '1000'),
(718, '2023-05-15', '39871', 'RENATO COTALLES', 'CASH ADVANCE FOR WET TOPPING', 'MALOONG TOPPERS', '1000'),
(719, '2023-05-15', '39884', 'JOSEPH BENOSA', 'CASH ADVANCE FOR SALARY', 'Employee', '3200'),
(720, '2023-05-15', '39805', 'FELIPE BORDA', 'CASH ADVANCE FOR SALARY', 'Employee', '2000'),
(721, '2023-05-15', '39804', 'jimson samsona', 'cash advance for salary', 'Employee', '3000'),
(722, '2023-05-15', '39807', 'jimson samsona', 'cash advance for salary', 'Employee-lacafe', '2050'),
(723, '2023-05-15', '39807', 'felipe borda', 'cash advance for salary', 'Employee-lacafe', '1750'),
(724, '2023-05-15', '39807', 'nalam', 'cash advance for salary', 'Employee-lacafe', '1712'),
(725, '2023-05-15', '39807', 'langutan', 'cash advance for salary', 'Employee-lacafe', '812'),
(726, '2023-05-16', '0173', 'asim gahaman', 'cash advance for wet rubber', 'Customer', '50000'),
(727, '2023-05-17', '41104', 'andrew abella', 'cash advance forsalary', 'painter in maloong', '2500'),
(728, '2023-05-17', '0178', 'ruben ramos', 'cash advance for dry price', 'Customer', '20000'),
(729, '2023-05-17', '176', 'long2x san juan', 'cash advance for wet export', 'Customer', '100000'),
(730, '2023-05-18', '179', 'danilo barandino', 'cash advance for dry price', 'Customer', '80000'),
(731, '2023-05-18', '41106', 'asim onz gahamun', 'cash advance for wet', 'Customer', '100000'),
(732, '2023-05-19', '40959', 'DALE PELIGRIN', 'CASH ADVANCE FOR SALARY', 'Employee', '2000'),
(733, '2023-05-19', '41113', 'ERIC MANUEL', 'CASH ADVANCE FOR SALARY', 'Employee', '2000'),
(734, '2023-05-19', '182', 'LONG2X SAN JUAN', 'CASH ADVANC FOR EXPORT WET', 'Customer', '50000'),
(735, '2023-05-20', '41120', 'g.a obongen', 'cash advance for salary', 'Employee', '3000'),
(736, '2023-05-20', '41119', 'tany sulayman', 'cash advanc for export wet', 'Customer', '100000'),
(737, '2023-05-20', '0184', 'jimroy McClintock', 'cash advance for  dry price', 'Customer', '30000'),
(738, '2023-05-22', '0191', 'louie delos reyes', 'cash advance for dry price', 'Customer', '85000'),
(739, '2023-05-22', '190', 'mudzkier abdurahman', 'cash advance for wet', 'Customer', '50000'),
(740, '2023-05-22', '189', 'asim gahamun', 'cash advance for export', 'Customer', '50000'),
(741, '2023-05-22', '432', 'amman awalin', 'cash advance fopra ', 'Customer', '100000'),
(742, '2023-05-22', '0186', 'jimroy McClintock', 'cash advance for dry price', 'Customer', '50000'),
(743, '2023-05-22', '41003', 'totoh castil', 'cash advance for salary', 'Employee', '5000'),
(744, '2023-05-22', '41126', 'dale peligrin', 'cash advance against lot collateral', 'Employee', '30000'),
(745, '2023-05-22', '41125', 'jimwell abella', 'cash advance for salary', 'Employee', '1000'),
(746, '2023-05-23', '41138', 'MELVIN FERER', 'CASH ADVANCE FOR SALARY', 'Employee', '5000'),
(747, '2023-05-23', '192', 'rasid amilin', 'cash advance for wet export', 'Customer', '100000'),
(748, '2023-05-24', '0196', 'nenet costan', 'cash advance for export', 'Customer', '50000'),
(749, '2023-05-24', '39819', 'felix albutra', 'cash advance for salary', 'Employee', '2000'),
(750, '2023-05-24', '41004', 'dale peligrin', 'cash advance for salary', 'Employee', '15000'),
(751, '2023-05-24', '0195', 'rashid amilin', 'cash advance for wet rubber', 'Customer', '100000'),
(752, '2023-05-24', '194', 'charly cawley', 'cash advance for dry price', 'Customer', '130000'),
(753, '2023-05-24', '0193', 'long2x san juan', 'cash advance for wet export', 'Customer', '100000'),
(754, '2023-05-25', '41143', 'noel guanzon', 'cash advanc for salary', 'Employee', '30000'),
(755, '2023-05-25', '197', 'long2x san juan', 'cash advanc for wet export', 'Customer', '200000'),
(756, '2023-05-26', '0501', 'jimroy McClintock', 'cash advanc for dry price', 'Customer', '30000'),
(757, '2023-05-26', '39820', 'mae angeles', 'cash advance for salary', 'Employee', '3000'),
(758, '2023-05-26', '41201', 'tany sulayman', 'cash advance for export', 'Customer', '50000'),
(759, '2023-05-26', '446', 'alih abdula', 'cash advance for copra', 'Customer', '40000'),
(760, '2023-05-27', '0505', 'nenet consta', 'cash advance for export', 'Customer', '100000'),
(761, '2023-05-27', '0504', 'mudzkie abdurahaman', 'cash advance for rubber deliver', 'Customer', '50000'),
(762, '2023-05-27', '503', 'long2x san juan', 'cash advance for export', 'Customer', '100000'),
(766, '2023-05-27', '41007', 'maloong contractual furnace/crumbling', 'cash advance for salary', 'Employee-maloong contractual', '49000'),
(767, '2023-05-29', '41208', 'DAILE PELIGRIN', 'CASH ADVANCE FOR LOT COLLATERAL', 'Employee', '35000'),
(768, '2023-05-29', '41216', 'DALE PELIGRIN', 'CASH ADVANCE FOR LOT COLLATERAL', 'Employee', '40000'),
(769, '2023-05-29', '507', 'JERRY ARIERO', 'CASH ADVANCE FOR RUBBER MILLING', 'Customer', '40000'),
(770, '2023-05-29', '41214', 'TANY SULAYMAN', 'CASH ADVANCE FOR WET', 'Customer', '50000'),
(771, '2023-05-29', '506', 'LONG2X SAN JUAN', 'CASH ADVANCE FOR EXPORT', 'Customer', '100000'),
(772, '2023-05-30', '513', 'JERRY ARIERO', 'CASH ADVANCE FOR DRY PRICE', 'Customer', '50000'),
(773, '2023-05-30', '39823', 'ALVIN GULPERE', 'CASH ADVANCE FOR WET ARCO', 'Customer', '250000'),
(774, '2023-05-30', '41222', 'MALELEEL CERO', 'CASH ADVANCE FOR 3PERSON in maloong plantation', 'Employee', '1500'),
(775, '2023-05-30', '41221', 'dale peligrin', 'cash advance for employe', 'Employee', '50000'),
(776, '2023-05-30', '510', 'tata alfaro', 'cash advance for dry price', 'Customer', '20000'),
(777, '2023-05-30', '508', 'long2x san juan', 'cash advance for export', 'Customer', '50000'),
(778, '2023-05-31', '39836', 'ernesto nalam', 'cash advance for salary', 'Customer', '2000'),
(779, '2023-05-31', '39835', 'jamson samsona', 'cash advance for salary', '3500', '3500'),
(780, '2023-05-31', '39833', 'brian albutra', 'cash advance for salary', 'Employee', '5000'),
(781, '2023-05-31', '41233', 'ireneo torres', 'cash advance for salary', 'Employee', '4500'),
(782, '2023-05-31', '41234', 'rogelio adaya jr', 'cash advance for salary', 'Employee', '3000'),
(783, '2023-05-31', '41227', 'rosamie angeles', 'cash advance for salary', 'Employee', '5000'),
(784, '2023-05-31', '41228', 'roberto enriquez', 'cash advance for salary', 'Employee', '7500'),
(785, '2023-05-31', '41230', 'rodjane quinol', 'cash advance for salary', 'Employee', '4400'),
(786, '2023-05-31', '41229', 'raquel bais', 'cash advance for salary', 'Employee', '9500'),
(787, '2023-05-31', '41231', 'joseph benosa', 'cash advance for salary', 'Employee', '3000'),
(788, '2023-05-31', '39837', 'felipe borda', 'cash advance for salary', 'Employee', '3000'),
(789, '2023-05-31', '39838', 'emelito langutan', 'cash advanc for salary', 'Employee', '3000'),
(790, '2023-05-31', '41236', 'eric manuel', 'csah advance for salary', 'Employee', '6500'),
(791, '2023-05-31', '41232', 'dayanara remigio', 'cash advance for salary', 'Employee', '4500'),
(792, '2023-05-31', '469', 'alih abdula', 'cash advance for copra', 'Customer', '20000'),
(793, '2023-05-31', '516', 'charly cawley', 'cash advance for dry price', 'Customer', '150000'),
(794, '2023-05-31', '515', 'jimroy McClintock', 'cash advance for dry price', 'Customer', '30000'),
(795, '2023-05-31', '41226', 'gigi bapura', 'cash advance for salary', 'Employee', '4300'),
(796, '2023-05-31', '41044', 'oscar  maloong toppers', 'cash advance for rubber', 'Topper', '1000'),
(797, '2023-05-31', '41030', 'cornelia albert', 'cash advance for salary', 'Employee', '3500'),
(798, '2023-05-31', '41031', 'cerilo sualog', 'cash advance for salary', 'Employee', '4000'),
(799, '2023-05-31', '41032', 'jovylyn samijon', 'cash advance for salary', 'Employee', '4000'),
(800, '2023-05-31', '41033', 'jay-ar quimcom', 'cash advance for salary', 'Employee', '3000'),
(801, '2023-05-31', '41034', 'dale peligrin', 'cash advanc for salary', 'Employee', '4000'),
(802, '2023-05-31', '41035', 'ramil pelegrin', 'csah advance for salary', 'Employee', '3500'),
(803, '2023-05-31', '41026', 'dindo pentojo', 'dindo pentojo', 'Employee', '4000'),
(804, '2023-05-31', '41018', 'ederito luang', 'cash advance  for salary', 'Employee', '3500'),
(805, '2023-05-31', '41027', 'pablo hipulan jr', 'cash advance for salary', 'Employee', '4000'),
(806, '2023-05-31', '41022', 'jonathan mamanguit', 'cash advance for salary', 'Employee', '9000'),
(807, '2023-05-31', '41024', 'edwin asilan', 'cash advance for salary', 'Employee', '4000'),
(808, '2023-05-31', '41017', 'gregorio matulac', 'cash advance for salary', 'Employee', '6000'),
(809, '2023-05-31', '41016', 'ronie vildad', 'cash advance for salary', 'Employee', '4000'),
(810, '2023-05-31', '41015', 'hereberto galano jr', 'cash advance for salary', 'Employee', '7000'),
(811, '2023-05-31', '41029', 'alvin bonifacio', 'cash advanc for salary', 'Employee', '3500'),
(812, '2023-05-31', '41025', 'samuel ramillano', 'cash advance for salary', 'Employee', '5000'),
(813, '2023-05-31', '41023', 'melvin ferer', 'cash advance for salary', 'Employee', '4000'),
(814, '2023-05-31', '41019', 'jeanne abella', 'cash advance for salary', 'Employee', '7000'),
(815, '2023-05-31', '41020', 'rafraf abarquez', 'cash advance for salary', 'Employee', '5000'),
(816, '2023-05-31', '41021', 'jerry garcia', 'cash advance for salary', 'Employee', '6000'),
(817, '2023-05-31', '41028', 'dennis corpuz', 'cash advance for salary', 'Employee', '5000'),
(818, '2023-05-31', '41045', 'jerome alcareza', 'cash advance for salary', 'Employee', '500'),
(819, '2023-05-31', '41046', 'guilbert panidar', 'cash advance for rubber', 'Employee', '1000'),
(820, '2023-05-31', '41037', 'edmundo cristobal', 'cash advance for salary', 'Employee', '15000'),
(821, '2023-05-31', '465', 'amman awalin', 'cash advance for copra', 'Customer', '100000'),
(822, '2023-05-31', '514', 'long2x san juan', 'cash advance for export', 'Customer', '100000'),
(823, '2023-05-31', '41245', 'G.A OBONGEN', 'CASH ADVANCE FOR SALARY', 'Employee', '2500'),
(824, '2023-06-01', '41252', 'buahan toppers', 'cash advance for wet  rubber', 'Employee', '4000'),
(825, '2023-06-01', '41250', 'joebert balasuela', 'cash advance for salary', 'Employee', '2000'),
(826, '2023-06-02', '518', 'long2x san juan', 'cash advance for export wet', 'Customer', '200000'),
(827, '2023-06-03', '519', 'TATAH ALFARO', 'CASH ADVANCE FOR WET RUBBER', 'Customer', '50000'),
(828, '2023-06-03', '40968', 'ALBERT MALAGUIT', 'CASH ADVANCE FOR SALARY', 'Employee', '3000'),
(829, '2023-06-05', '520', 'capt. alfaro', 'cash advance for dry price', 'Customer', '50000'),
(830, '2023-06-05', '521', 'long2x san juan', 'cash advance for export', 'Customer', '50000'),
(831, '2023-06-05', '41276', 'rashid amilin', 'cash advance for side mirror charge to copra', 'Customer', '1000'),
(832, '2023-06-05', '40315', 'ramil pelegrin', 'cash advance foo salary', 'Employee', '5000'),
(833, '2023-06-06', '528', 'louie delos reyes', 'cash advance for dry price', 'Customer', '50000'),
(834, '2023-06-06', '41307', 'jimson samsona', 'cash advance for salary', 'Employee', '2500'),
(835, '2023-06-06', '530', 'tata alfaro', 'cash advance for dry price', 'Customer', '50000'),
(836, '2023-06-06', '529', 'jimnroy McClintock', 'cash advance for dry price', 'Customer', '50000'),
(837, '2023-06-06', '529', 'jimnroy McClintock', 'cash advance for dry price', 'Customer', '50000'),
(838, '2023-06-06', '525', 'louie delos reyes', 'cash advance for dry price', 'Customer', '30000'),
(839, '2023-06-06', '41281', 'dale peligrin', 'cash advance for lot collatera', 'Employee', '65000'),
(840, '2023-06-06', '40318', 'edrito luang', 'cash advance for salary', 'Employee', '2000'),
(841, '2023-06-07', '531', 'long2x san juan', 'cash advance for rubber', 'Customer', '100000'),
(842, '2023-06-07', '41287', 'romeo baldon', 'cash advance for coal', 'coal', '50000'),
(843, '2023-06-07', '536', 'JImroy McClintock', 'cash advance for dry price', 'Customer', '30000'),
(844, '2023-06-08', '41294', 'edith butona', 'cash advance for salary', 'Employee', '6000'),
(845, '2023-06-08', '539', 'long2x san juan', 'cash advance for export', 'Customer', '100000'),
(846, '2023-06-08', '538', 'charly cawley', 'partial payment for dry price', 'Customer', '130000'),
(847, '2023-06-09', '41309', 'eric manuel', 'cash advance for salary', 'Employee', '4000'),
(848, '2023-06-09', '540', 'long2x san juan', 'cash advance for export', 'Customer', '100000'),
(849, '2023-06-09', '541', 'jerry ariero', 'cash advance for dry price', 'Customer', '25000'),
(850, '2023-06-09', '622', 'alih abdulla', 'cash advance for copra', 'Customer', '30000'),
(851, '2023-06-09', '41300', 'balugay shop', 'cash advance for slab cutter /ROLLER gear pinion', 'MACHINE SHOP', '50000'),
(852, '2023-06-09', '41353', 'JOECRIS CLIMACO', 'CASH ADVANCE FOR SALARY', 'Employee', '3000'),
(853, '2023-06-10', '41049', 'MALOONG CONTRACTUAL ', 'CASH ADVANCE FOR SALARY', 'Employee -MALOONG', '86200'),
(854, '2023-06-10', '545', 'NENET COSTAN', 'CASH ADVANCE FOR EXPORT', 'Customer', '30000'),
(855, '2023-06-10', '41359', 'MAE ANGELES', 'CASH ADVANCE FOR SALARY', 'Employee', '3000'),
(856, '2023-06-10', '546', 'JARWIN GARCIA', 'CASH ADVANCE FOR DRY PRICE', 'Customer', '50000'),
(857, '2023-06-10', '41358', 'EDITA LABADA', 'CSH ADVANCE FOR LABADA', 'Employee', '750'),
(858, '2023-06-10', '627', 'DATU SABTILAN', 'CASH ADVANCE FOR COPRA', 'Customer', '50000'),
(859, '2023-06-10', '547', 'HARI SABTAL', 'CASH ADVANCE FOR EXPORT', 'Customer', '50000'),
(860, '2023-06-10', '628', 'ALIH ABDULA', 'CASH ADVANCE FOR COPRA', 'Customer', '50000'),
(861, '2023-06-10', '549', 'JERRY ARIERO', 'CASH ADVANCE FOR DRY PRICE', 'Customer', '20000'),
(862, '2023-06-12', '548', 'NENET COSTAN', 'CASH ADVANCE FOR STA CLARA', 'Customer', '200000'),
(863, '2023-06-12', '550', 'RAYMUND SAN JUAN', 'CASH ADVANCE', 'Customer', '100000'),
(864, '2023-06-12', '551', 'JARWIN GARCIA', 'CASH ADVANCEFOR RUBBER', 'Customer', '50000'),
(865, '2023-06-12', '552', 'NENET COSTAN', 'CASH ADVANCE FOR RUBBER', 'Customer', '100000');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ledger_expenses`
--

INSERT INTO `ledger_expenses` (`id`, `voucher_no`, `particulars`, `date`, `category`, `type_expense`, `amount`, `description`, `remarks`, `destination`, `mode_transact`, `date_payment`, `location`) VALUES
(1, '1234', '', '2023-05-10', 'Philhealth', '', '2333', NULL, 'TEST', NULL, '', NULL, 'Basilan'),
(3, '2333', 'ABC', '2023-05-11', 'Food and Snack', '', '1000', NULL, '', NULL, 'Cash Advance', NULL, 'Basilan'),
(5, '40943', 'BREAD FOR OFFICE ', '2023-05-11', 'Food and Snack', 'Other Expenses', '60', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(6, '40943', 'OT ROASTING SNACK', '2023-05-11', 'LACAFE EXPENSES', 'Coffee Expenses', '100', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(7, '39852', 'EJN EMPLOYEE PHILHEALTH CONTRI FOR May 2023', '2023-05-11', 'Philhealth', 'Other Expenses', '18650.40', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(8, '40790', 'ENTRADA COPRA 34SACKS @3', '2023-05-11', 'Pakyawan Salaries', 'Copra Expenses', '102', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(9, '40950', 'kelvin cash to zambo', '2023-05-11', 'Personal Expenses', 'Personal Expenses', '15000', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(11, '40950', 'FARE TO OVAL MARKET', '2023-05-11', 'Transportation Expenses', 'Other Expenses', '40', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(12, '40950', 'GIGI OT LACAFE', '2023-05-11', 'OVERTIME EXPENSES', 'Coffee Expenses', '300', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(13, '39851', '9 1/2DAYS pordia of Ar Hazim Abdurakax from May 1-11, 2023 truckman joecris', '2023-05-11', 'SALARIES EXPENSES', 'Other Expenses', '2090', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(14, '39857', 'LABOR unloading panbelt/def.bar /formic acid / bearing', '2023-05-12', 'MALOONG EXPENSES', 'Rubber Expenses', '150', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(15, '40791', 'entrada copra 59sacks @ 3', '2023-05-12', 'Pakyawan Salaries', 'Copra Expenses', '177', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(16, '40791', 'loading rubber bales 300', '2023-05-12', 'Pakyawan Salaries', 'Rubber Expenses', '1000', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(17, '40950', 'MKTG. BUDGET', '2023-05-11', 'MKTG. EXPENSES', 'Personal Expenses', '2500', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(18, '39853', 'FARE TO OVAL MARKET', '2023-05-12', 'Transportation Expenses', 'Other Expenses', '40', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(19, '39853', '2 GALLON FOR KITCHEN USED', '2023-05-11', 'Water', 'Personal Expenses', '125', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(20, '40792', 'sacking copra 180sacks@ 3', '2023-05-12', 'Pakyawan Salaries', 'Copra Expenses', '540', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(21, '39856', 'ADDITIONAL PETTY CASH FOR ZAMBOANGA', '2023-05-12', 'ZAMBOANGA PCF', 'Other Expenses', '30000', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(22, '39853', '3PERSON ROASTING LACAFE', '2023-05-12', 'OVERTIME EXPENSES', 'Coffee Expenses', '1072', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(23, '2703', 'T139 adung copra to zamboanga 1way', '2023-05-12', 'FREIGHT TO ZAMBO EXPENSES', 'Other Expenses', '6966', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(24, '2703', 'T139 1way to pasahe to lamitan ', '2023-05-12', 'FREIGHT TO LAM EXPENSES', 'Other Expenses', '6106', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(25, '2702', 'T851 300bales pasahe to zambo', '2023-05-12', 'FREIGHT TO ZAMBO EXPENSES', 'Other Expenses', '6966', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(26, '2702', 'T851 pasahe to lamitan 1way', '2023-05-12', 'FREIGHT TO LAM EXPENSES', 'Other Expenses', '6106', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(27, '40173', 'BERTO GALANO OT', '2023-05-13', 'MALOONG EXPENSES', 'Rubber Expenses', '1983.03', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(28, '40173', 'RONIE VILDAD OT', '2023-05-13', 'MALOONG EXPENSES', 'Rubber Expenses', '520.22', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(29, '40173', 'JEANNE ABELLA OT', '2023-05-13', 'MALOONG EXPENSES', 'Rubber Expenses', '2379.63', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(30, '40173', 'JOVY SAMIJON OT', '2023-05-13', 'MALOONG EXPENSES', 'Rubber Expenses', '568.75', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(31, '40173', 'JAR AR QUIMCO OT', '2023-05-13', 'MALOONG EXPENSES', 'Rubber Expenses', '1109.38', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(32, '40173', 'RAP RAP ABARQUEZ OT', '2023-05-13', 'MALOONG EXPENSES', 'Rubber Expenses', '281.25', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(33, '40173', 'JERRY GARCIA OT', '2023-05-13', 'MALOONG EXPENSES', 'Rubber Expenses', '768.75', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(34, '40173', 'SAMUEL RAMILANO OT', '2023-05-13', 'MALOONG EXPENSES', 'Rubber Expenses', '1687.50', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(36, '40173', 'GREGORIO MATULAC OT', '2023-05-13', 'MALOONG EXPENSES', 'Rubber Expenses', '896.88', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(37, '40173', 'DINDO PENTOJO OT', '2023-05-13', 'MALOONG EXPENSES', 'Rubber Expenses', '2493.75', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(38, '40173', 'EDMUNDO CRISTOBAL ot', '2023-05-13', 'MALOONG EXPENSES', 'Rubber Expenses', '1218.75', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(39, '40173', 'PABLO HIPULAN OT', '2023-05-13', 'MALOONG EXPENSES', 'Rubber Expenses', '1378.13', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(40, '40173', 'DENNIS CORPUZ OT', '2023-05-13', 'MALOONG EXPENSES', 'Rubber Expenses', '1368.75', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(41, '40173', 'alvin bonifacio ot', '2023-05-13', 'MALOONG EXPENSES', 'Rubber Expenses', '1218.75', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(42, '40173', 'ederito luang ot', '2023-05-13', 'MALOONG EXPENSES', 'Rubber Expenses', '431.25', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(43, '40173', 'JULIO aballa OT', '2023-05-13', 'MALOONG EXPENSES', 'Rubber Expenses', '1700', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(44, '40173', 'RAMIL PELIGRIN OT', '2023-05-13', 'MALOONG EXPENSES', 'Rubber Expenses', '1331.25', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(45, '40173', 'ALBERT CORNELIA OT', '2023-05-13', 'MALOONG EXPENSES', 'Rubber Expenses', '2421.88', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(46, '40793', 'sacking copra 370sacks @ 3', '2023-05-13', 'Pakyawan Salaries', 'Copra Expenses', '1110', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(47, '40794', 'loading 2container bales ', '2023-05-13', 'Pakyawan Salaries', 'Rubber Expenses', '4000', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(48, '39864', 'ERVIN MAGNAYE BRASSING 5PERSON @ 6DAYS @ 300', '2023-05-13', 'MALOONG PLANTATION EXP.', 'Rubber Expenses', '9000', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(49, '39862', '7DAYS PORDIA OF Jolebert Balasuela sayugan hardinero', '2023-05-13', 'SAYUGAN EXPENSES', 'Other Expenses', '1215', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(50, '39858', 'payment of Labada editha', '2023-05-13', 'Other Expense', 'Personal Expenses', '750', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(51, '39858', 'ginamos / coconut milk', '2023-05-13', 'Other Expense', 'Personal Expenses', '80', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(52, '39858', 'medicine ', '2023-05-13', 'Other Expense', 'Personal Expenses', '64', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(53, '39858', 'MKTG. BUDGET', '2023-05-13', 'MKTG. EXPENSES', 'Personal Expenses', '2500', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(54, '39858', 'FARE TO OVAL MARKET', '2023-05-13', 'Transportation Expenses', 'Other Expenses', '40', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(55, '39858', 'SOP BASURA', '2023-05-13', 'Other Expense', 'Other Expenses', '400', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(56, '39860', 'tractor pasahe 1way', '2023-05-13', 'FREIGHT TO ZAMBO EXPENSES', 'Other Expenses', '4011', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(57, '39860', '6 wheeler T508 1way', '2023-05-13', 'FREIGHT TO ZAMBO EXPENSES', 'Other Expenses', '4806', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(58, '39861', '1way fare tractor orange', '2023-05-13', 'FREIGHT TO LAM EXPENSES', 'Other Expenses', '3711', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(59, '39865', 'labor for grass cutter', '2023-05-13', 'SAYUGAN EXPENSES', 'Other Expenses', '500', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(60, '48116', 'gasul for kitchen', '2023-05-13', 'Other Expense', 'Personal Expenses', '1237', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(61, '50696', 'jaf 7979 ROYALTY FEE TO WHARF', '2023-05-13', 'LDC EXPENSES', 'Rubber Expenses', '200', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(62, '40172', 'TOTO CASTIL OT may 2-8, 2023', '2023-05-13', 'MALOONG EXPENSES', 'Rubber Expenses', '3750', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(63, '40174', 'salary get bamboo for kuadra horse music may 9-12', '2023-05-13', 'MALOONG EXPENSES', 'Rubber Expenses', '1000', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(64, '40169', 'ANTHONY CASTIL  OT from 5/8-12/23', '2023-05-13', 'MALOONG EXPENSES', 'Rubber Expenses', '3000', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(65, '40166', 'food allow. of toto and anthony castil', '2023-05-13', 'MALOONG EXPENSES', 'Rubber Expenses', '1000', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(66, '40164', 'jean travel allow. ', '2023-05-13', 'MALOONG EXPENSES', 'Rubber Expenses', '300', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(67, '40168', 'ronie pelegrin 49PCS. BAMBOO FOR KUADRA HORSE MUSIC', '2023-05-13', 'MALOONG EXPENSES', 'Rubber Expenses', '1715', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(68, '40175', 'MALOONG FIELD WORKER WEEKLY SALARY', '2023-05-13', 'MALOONG EXPENSES', 'Rubber Expenses', '20000', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(69, '2705', 'PRIMEMOVER ERIC BALES 1WAY', '2023-05-13', 'FREIGHT TO ZAMBO EXPENSES', 'Rubber Expenses', '7750', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(70, '2705', 'PRIMEMOVER ERIC 1WAY', '2023-05-13', 'FREIGHT TO LAM EXPENSES', 'Other Expenses', '7216', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(71, '2704', 'PRIMEMOVER ORANGE BALES', '2023-05-13', 'FREIGHT TO ZAMBO EXPENSES', 'Rubber Expenses', '7750', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(72, '2704', 'PRIMEMOVER ORANGE 1WAY', '2023-05-13', 'FREIGHT TO LAM EXPENSES', 'Other Expenses', '7216', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(73, '39858', 'DRUM LATA FOR CHIMNEY', '2023-05-13', 'LACAFE EXPENSES', 'Coffee Expenses', '1500', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(74, '514506', '5trips to wharf', '2023-05-15', 'TRANSPORTING FEE', 'Other Expenses', '500', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(75, '41051', '25pail packing lacafe @25', '2023-05-15', 'LACAFE EXPENSES', 'Coffee Expenses', '625', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(76, '39875', 'labor plumber tubo', '2023-05-15', 'Other Expense', 'Personal Expenses', '800', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(77, '39875', 'FARE TO NTC', '2023-05-15', 'Transportation Expenses', 'Other Expenses', '40', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(78, '39868', 'FARE TO NTC', '2023-05-15', 'Transportation Expenses', 'Other Expenses', '40', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(79, '39868', 'h2o', '2023-05-15', 'Other Expense', 'Personal Expenses', '155', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(80, '39874', 'ADDITIONAL PETTY CASH FOR ZAMBOANGA', '2023-05-15', 'ZAMBOANGA PCF', 'Other Expenses', '40000', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(81, '40180', 'load wifi smart maloong ', '2023-05-15', 'MALOONG EXPENSES', 'Rubber Expenses', '1150', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(82, '050841', 'eric 090810 LAM TO ZAM', '2023-05-15', 'LDC EXPENSES', 'Other Expenses', '200', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(83, '50830', 'T851 LAM TO ZAM', '2023-05-15', 'LDC EXPENSES', 'Rubber Expenses', '200', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(84, '39875', 'RAQUEL BAIS AND JOSEPH BENOSA FROM MAY 1-15, 2023 @ 2500 EACH EJN /NTC BIR', '2023-05-15', 'BOOKKEEPING EXPENSES', 'Other Expenses', '5000', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(86, '39868', '2DAYS ALLOW. OF G.A NENET AND KIM BUYING', '2023-05-15', 'ALLOWANCE FOR BUYING EXPENSES', 'Rubber Expenses', '300', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(87, '39868', 'MKTG. BUDGET', '2023-05-15', 'MKTG. EXPENSES', 'Personal Expenses', '2500', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(88, '39868', 'FARE TO OVAL MARKET', '2023-05-15', 'Transportation Expenses', 'Other Expenses', '40', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(89, '40795', 'ENTRADA COPRA 814SACKS @3', '2023-05-15', 'Pakyawan Salaries', 'Copra Expenses', '2442', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(90, '40796', '5DRUMS DIESEL @ 20', '2023-05-15', 'LOADING/UNLOADING EXPENSES', 'Other Expenses', '100', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(91, '2707', 'PRIMEMOVER ERIC wet export', '2023-05-15', 'FREIGHT TO ZAMBO EXPENSES', 'Rubber Expenses', '8050', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(92, '2707', 'PRIMEMOVER ERIC', '2023-05-15', 'FREIGHT TO LAM EXPENSES', 'Other Expenses', '7216', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(93, '2706', 'PRIMEMOVER ARMAN ', '2023-05-15', 'FREIGHT TO ZAMBO EXPENSES', 'Rubber Expenses', '8050', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(94, '2706', 'PRIMEMOVER ARMAN ', '2023-05-15', 'FREIGHT TO LAM EXPENSES', 'Other Expenses', '7216', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(95, '39808', 'amante lequin ', '2023-05-15', '  EJN SALARIES', 'Other Expenses', '6290', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(96, '39808', 'G.A OBONGEN SALARY', '2023-05-15', '  EJN SALARIES', 'Other Expenses', '4622', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(97, '39801', 'ESTRELITO BRIEVA ', '2023-05-15', '  EJN SALARIES', 'Other Expenses', '1235', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(98, '39895', 'CONCHITA DELOS REYES ', '2023-05-15', '  EJN SALARIES', 'Other Expenses', '4500', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(99, '39898', 'LINDA DEL ROSARIO ', '2023-05-15', '  EJN SALARIES', 'Other Expenses', '3000', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(100, '39891', 'ryan atilano', '2023-05-15', '  EJN SALARIES', 'Other Expenses', '3025', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(101, '39889', 'joey ortega salary', '2023-05-15', '  EJN SALARIES', 'Other Expenses', '2400', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(102, '39890', 'DYELOBERT FERNANDEZ', '2023-05-15', '  EJN SALARIES', 'Other Expenses', '3425', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(103, '39877', 'rogeley ramos', '2023-05-15', '  EJN SALARIES', 'Other Expenses', '3950', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(104, '40954', 'jojo deliverio tabasero maloong processing from May 02-13, 2023', '2023-05-15', 'MALOONG EXPENSES', 'Rubber Expenses', '17750', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(105, '40177', 'toto castil ', '2023-05-15', '  EJN SALARIES', 'Rubber Expenses', '10100', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(106, '40178', 'anthony castil salary', '2023-05-15', 'MALOONG EXPENSES', 'Other Expenses', '8350', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(107, '39873', 'ronie sadio salary', '2023-05-15', '  EJN SALARIES', 'Other Expenses', '1750', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(108, '39802', 'JEFERSON ALIPIO salary', '2023-05-15', '  EJN SALARIES', 'Other Expenses', '3400', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(109, '39865', 'andrew abella', '2023-05-15', '  EJN SALARIES', 'Other Expenses', '5500', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(110, '39878', 'JULIO ABALLA SALARY', '2023-05-15', 'MALOONG EXPENSES', 'Other Expenses', '4612', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(111, '39878', 'JERRY GARCIA SALARY', '2023-05-15', 'MALOONG EXPENSES', 'Other Expenses', '630', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(112, '39878', 'SAMUEL SALARY', '2023-05-15', 'MALOONG EXPENSES', 'Other Expenses', '900', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(113, '39878', 'DINDO PENTOJO SALARY', '2023-05-15', 'MALOONG EXPENSES', 'Other Expenses', '1430', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(114, '39878', 'wilfredo quimaco salary', '2023-05-15', 'MALOONG EXPENSES', 'Other Expenses', '2500', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(115, '39878', 'LUANG EDERITO SALARY', '2023-05-15', 'MALOONG EXPENSES', 'Other Expenses', '630', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(116, '39878', 'CERILO SUALOG', '2023-05-15', 'MALOONG EXPENSES', 'Other Expenses', '250', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(117, '39878', 'ALBERT CORNELIA SALARY', '2023-05-15', 'MALOONG EXPENSES', 'Other Expenses', '850', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(118, '39881', 'michael tuñacao', '2023-05-15', '  EJN SALARIES', 'Other Expenses', '6423', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(119, '39881', 'AZENIT VALLEDOR', '2023-05-15', '  EJN SALARIES', 'Other Expenses', '4200', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(120, '39881', 'RONIE TORIBIO', '2023-05-15', '  EJN SALARIES', 'Other Expenses', '6838', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(121, '39881', 'ANTONIO ARMAN', '2023-05-15', '  EJN SALARIES', 'Other Expenses', '7650', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(122, '39881', 'RENANTE SAVEDRA', '2023-05-15', '  EJN SALARIES', 'Other Expenses', '7440', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(123, '39881', 'ETHEL BETITA', '2023-05-15', '  EJN SALARIES', 'Other Expenses', '3924', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(124, '39881', 'GUILBERT FERNANDEZ', '2023-05-15', '  EJN SALARIES', 'Other Expenses', '5220', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(125, '39899', 'reymar cabading', '2023-05-16', '  EJN SALARIES', 'Other Expenses', '2925', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(126, '39896', 'fare to ntc dayan', '2023-05-16', 'Transportation Expenses', 'Other Expenses', '20', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(127, '39896', 'editha ', '2023-05-16', 'Transportation Expenses', 'Other Expenses', '50', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(128, '39896', 'maloong snack', '2023-05-16', 'Food and Snack', 'Other Expenses', '200', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(129, '40798', 'labor for 1container bales', '2023-05-16', 'Pakyawan Salaries', 'Rubber Expenses', '2000', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(130, '41052', 'packing lacafe 24pail@ 25', '2023-05-16', 'LACAFE EXPENSES', 'Coffee Expenses', '500', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(131, '39897', 'LAMWAD water consumption for May 2023', '2023-05-16', 'Water', 'Personal Expenses', '5950', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(132, '40797', 'labor for export nenet', '2023-05-16', 'Pakyawan Salaries', 'Rubber Expenses', '4500', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(133, '39896', 'MKTG. BUDGET', '2023-05-16', 'MKTG. EXPENSES', 'Personal Expenses', '2500', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(134, '39896', 'FARE TO OVAL MARKET', '2023-05-16', 'Transportation Expenses', 'Other Expenses', '40', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(135, '39896', 'jayson food allow.', '2023-05-16', 'ALLOWANCE FOR BUYING EXPENSES', 'Other Expenses', '300', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(136, '39896', 'ESTRELITO BRIEVA ', '2023-05-16', '  EJN SALARIES', 'Other Expenses', '1750', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(137, '2709', 'PRIMEMOVER ARMAN bales to zambo', '2023-05-16', 'FREIGHT TO ZAMBO EXPENSES', 'Other Expenses', '7750', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(138, '2709', 'PRIMEMOVER ARMAN to lam', '2023-05-16', 'FREIGHT TO LAM EXPENSES', 'Other Expenses', '7216', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(139, '2710', 'primemover renante bales to zambo', '2023-05-16', 'FREIGHT TO ZAMBO EXPENSES', 'Other Expenses', '7750', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(140, '2710', 'PRIMEOVER RENANTE to lam.', '2023-05-16', 'FREIGHT TO LAM EXPENSES', 'Other Expenses', '7216', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(141, '2708', 'PRIMEMOVER renante 5/15/23 wet export', '2023-05-16', 'FREIGHT TO ZAMBO EXPENSES', 'Other Expenses', '8050', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(142, '2708', 'PRIMEOVER RENANTE', '2023-05-16', 'FREIGHT TO LAM EXPENSES', 'Other Expenses', '7216', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(143, '41054', '166sacks arabica unloading @ 10 ', '2023-05-17', 'LACAFE EXPENSES', 'Coffee Expenses', '1660', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(144, '41101', 'trash can bin for maloong office', '2023-05-17', 'MALOONG EXPENSES', 'Rubber Expenses', '480', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(145, '41101', 'FARE TO NTC', '2023-05-17', 'Transportation Expenses', 'Other Expenses', '40', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(146, '41101', 'SAGING PRITO', '2023-05-17', 'Food and Snack', 'Other Expenses', '50', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(147, '41101', 'tip to checker zambo', '2023-05-17', 'Transportation Expenses', 'Other Expenses', '20', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(148, '41151', 'entrada copra 145sacks@ 3', '2023-05-17', 'Pakyawan Salaries', 'Copra Expenses', '435', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(149, '40800', 'loading bales 1 container', '2023-05-17', 'Other Expense', 'Rubber Expenses', '2000', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(150, '40800', 'entrada copra 252sacks @ 3', '2023-05-17', 'Pakyawan Salaries', 'Copra Expenses', '756', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(151, '41101', 'MKTG. BUDGET', '2023-05-17', 'MKTG. EXPENSES', 'Personal Expenses', '2500', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(152, '41101', 'FARE TO OVAL MARKET', '2023-05-17', 'Transportation Expenses', 'Other Expenses', '40', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(153, '41101', 'jbn cash to zambo', '2023-05-17', 'Other Expense', 'Personal Expenses', '15000', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(154, '41101', 'tip to bus driver', '2023-05-17', 'Transportation Expenses', 'Other Expenses', '20', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(155, '41101', 'native chicken 3heads', '2023-05-17', 'Other Expense', 'Personal Expenses', '900', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(156, '41102', 'ADDITIONAL PETTY CASH FOR ZAMBOANGA', '2023-05-17', 'ZAMBOANGA PCF', 'Other Expenses', '40000', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(157, '41053', '6pail packing lacafe @ 25', '2023-05-17', 'LACAFE EXPENSES', 'Coffee Expenses', '150', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(158, '39811', 'JOECRIS CLIMACO SALARY', '2023-05-17', '  EJN SALARIES', 'Other Expenses', '3550', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(159, '40799', 'ENTRADA COPRA 470SACKS @3', '2023-05-17', 'Pakyawan Salaries', 'Other Expenses', '1410', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(160, '50863', 'erci prime/arman/renante to wharf  4trips @ 200', '2023-05-17', 'LDC EXPENSES', 'Other Expenses', '800', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(161, '2711', 'PRIMEMOVER ERIC BALES 1WAY', '2023-05-17', 'FREIGHT TO ZAMBO EXPENSES', 'Other Expenses', '7750', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(162, '2711', 'PRIMEMOVER ERIC to lamitan', '2023-05-17', 'FREIGHT TO LAM EXPENSES', 'Other Expenses', '7216', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(163, '41105', 'MINERAL WATER', '2023-05-18', 'Other Expense', 'Personal Expenses', '125', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(164, '41105', 'G. ALLOW. IN LOADING WET EXPORT ', '2023-05-18', 'ALLOWANCE FOR BUYING EXPENSES', 'Rubber Expenses', '150', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(165, '41105', 'ADDITIONAL TIP TO CHECKER TO ZAMBO', '2023-05-18', 'Transportation Expenses', 'Other Expenses', '20', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(166, '41105', 'MKTG. BUDGET', '2023-05-18', 'MKTG. EXPENSES', 'Personal Expenses', '1600', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(167, '41105', 'FARE TO OVAL MARKET', '2023-05-18', 'Transportation Expenses', 'Other Expenses', '40', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(168, '41105', 'DUCKTAPE', '2023-05-18', 'Other Expense', 'Rubber Expenses', '150', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(169, '41105', 'FEEDS FOR ROASTER W/FARE', '2023-05-18', 'ROOASTER EXPENSES', 'Other Expenses', '3945', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(170, '41152', '21DRUMS @ 10 DIESEL', '2023-05-18', 'LOADING/UNLOADING EXPENSES', 'Other Expenses', '210', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(171, '41153', 'ENTRADA COPRA 195SACKS @ 3', '2023-05-18', 'Pakyawan Salaries', 'Copra Expenses', '585', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(172, '41155', '2CONTAINERS RUBBER BALES', '2023-05-18', 'Pakyawan Salaries', 'Rubber Expenses', '4000', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(173, '41109', 'Cash deposit to Peter New bdo and gcash to Ivan Francisco  by RICHARD NEW', '2023-05-18', 'Other Expense', 'Personal Expenses', '45846', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(174, '2713', 'PRIMEMOVER ARMAN -wet export', '2023-05-18', 'FREIGHT TO ZAMBO EXPENSES', 'Other Expenses', '8050', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(175, '2713', 'PRIMEMOVER ARMAN ', '2023-05-18', 'FREIGHT TO LAM EXPENSES', 'Other Expenses', '7216', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(176, '2712', 'primemover renante bales ', '2023-05-18', 'FREIGHT TO ZAMBO EXPENSES', 'Rubber Expenses', '7750', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(177, '2712', 'primemover renante 1way', '2023-05-18', 'FREIGHT TO LAM EXPENSES', 'Other Expenses', '7216', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(178, '41157', 'entrada copra 829sacks@ 3', '2023-05-19', 'Pakyawan Salaries', 'Copra Expenses', '2487', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(179, '41156', 'loading wet rubber 1container nenet', '2023-05-19', 'Pakyawan Salaries', 'Rubber Expenses', '4500', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(180, '41112', 'FARE TO NTC', '2023-05-19', 'Transportation Expenses', 'Other Expenses', '40', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(181, '41112', 'OT ROASTING SNACK', '2023-05-19', 'LACAFE EXPENSES', 'Coffee Expenses', '100', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(182, '41055', 'extra pordia lacafe', '2023-05-19', 'LACAFE EXPENSES', 'Coffee Expenses', '240', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(183, '40958', 'BASELCO TIP CUT OUT  from may 16/18/19', '2023-05-19', 'MALOONG EXPENSES', 'Rubber Expenses', '1500', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(184, '41105', 'KATHY MEDICATION ALLOW.', '2023-05-19', 'KATHY EXPENSES', 'Personal Expenses', '200000', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(185, '41105', 'MKTG. BUDGET', '2023-05-19', 'MKTG. EXPENSES', 'Personal Expenses', '2500', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(186, '41105', 'FARE TO OVAL MARKET', '2023-05-19', 'Transportation Expenses', 'Personal Expenses', '40', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(187, '2714', '1WAY PASAHE PRIMEMOVER ERIC WET EXPORT', '2023-05-19', 'FREIGHT TO ZAMBO EXPENSES', 'Other Expenses', '8050', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(188, '2714', '1WAY PASAHE PRIME ERIC', '2023-05-19', 'FREIGHT TO LAM EXPENSES', 'Other Expenses', '7216', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(189, '41112', 'inner tuber for kawasaki in maloong for kumpay used', '2023-05-20', 'MALOONG EXPENSES', 'Rubber Expenses', '300', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(190, '41112', 'MKTG. BUDGET', '2023-05-20', 'MKTG. EXPENSES', 'Personal Expenses', '2500', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(191, '41112', 'FARE TO OVAL MARKET', '2023-05-20', 'Transportation Expenses', 'Other Expenses', '40', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(192, '41112', 'FARE TO NTC', '2023-05-20', 'Transportation Expenses', 'Other Expenses', '40', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(193, '41112', 'EDITHA labada payment less: 500 c.a', '2023-05-20', 'Other Expense', 'Personal Expenses', '250', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(194, '41123', '5days pordia of Joebert Balasuel @ 220 less: 325 hardinero ', '2023-05-20', 'SAYUGAN EXPENSES', 'Other Expenses', '775', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(195, '41160', 'camada copra 350sacks @ 3/ entrada copra 698sack s@ 3 less: roger 50', '2023-05-20', 'Pakyawan Salaries', 'Copra Expenses', '3094', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(196, '39814', '5person braasing 6days @ 300 may 15-20, 2023 ervin magnaye and comprany', '2023-05-20', 'MALOONG PLANTATION EXP.', 'Rubber Expenses', '9000', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(197, '41122', 'labor unloading 323pcs@ 1.50 EJN CONSTRUCTION USED', '2023-05-20', 'Pakyawan Salaries', 'Personal Expenses', '485', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(198, '41118', 'MALOONG MILLER PAYROLL', '2023-05-20', 'MALOONG EXPENSES', 'Rubber Expenses', '214405', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(199, '41116', 'MALOONG PAYROLL OPERATOR/FURNACE/SEC.GUARD/OPERATOR ROLLER4/FIELD', '2023-05-20', 'MALOONG EXPENSES', 'Rubber Expenses', '53202', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(200, '41159', 'LEE BROWN WET RUBBER 5085KLS@ .35', '2023-05-20', 'Pakyawan Salaries', 'Rubber Expenses', '1780', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(201, '41117', '4PERSON OT ROASTING', '2023-05-20', 'LACAFE EXPENSES', 'Coffee Expenses', '1321', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(202, '40304', 'MALOONG FIELD WORKER WEEKLE SALARY FROM MAY 15-20,2023', '2023-05-20', 'MALOONG EXPENSES', 'Rubber Expenses', '20750', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(203, '40303', 'SALARY OF JAYSON LIPAYO 5DAYS @ 250', '2023-05-20', 'MALOONG EXPENSES', 'Rubber Expenses', '1250', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(204, '40249', 'jeanne abella transpo allow. 5/22 to 5/27/23', '2023-05-20', 'MALOONG EXPENSES', 'Rubber Expenses', '300', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(205, '40250', 'FOOD ALLOW.OF ANTHONY CASTIL AND TOTOH CASTIL 5/22-28/23', '2023-05-20', 'MALOONG EXPENSES', 'Rubber Expenses', '1000', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(206, '40301', 'TOTOH CASTIL ot 5/15-18/23', '2023-05-20', 'MALOONG EXPENSES', 'Rubber Expenses', '3000', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(207, '40306', 'ANTHONY CASTIL  OT from 5/13-19/23', '2023-05-20', 'MALOONG EXPENSES', 'Rubber Expenses', '4200', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(208, '50876', 'royalty fee of truck and trialer to wharf from 5/17-20/23', '2023-05-20', 'LDC EXPENSES', 'Other Expenses', '800', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(209, '41158', 'loading /diesel 5drums @ 10', '2023-05-20', 'LOADING/UNLOADING EXPENSES', 'Other Expenses', '50', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(210, '41001', 'OT BERTO GALANO', '2023-05-20', 'MALOONG EXPENSES', 'Rubber Expenses', '2307.52', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(211, '41001', 'RONIE VILDAD OT', '2023-05-20', 'MALOONG EXPENSES', 'Rubber Expenses', '383.32', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(212, '41001', 'JEANNE ABELLA OT', '2023-05-20', 'MALOONG EXPENSES', 'Rubber Expenses', '3317.06', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(213, '41001', 'JOVY SAMIJON OT', '2023-05-20', 'MALOONG EXPENSES', 'Rubber Expenses', '612.50', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(214, '41001', 'JAR AR QUIMCO OT', '2023-05-20', 'MALOONG EXPENSES', 'Rubber Expenses', '906.25', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(215, '41001', 'RAP RAP ABARQUEZ OT', '2023-05-20', 'MALOONG EXPENSES', 'Rubber Expenses', '150', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(216, '41001', 'JERRY GARCIA OT', '2023-05-20', 'MALOONG EXPENSES', 'Rubber Expenses', '825', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(217, '41001', 'SAMUEL RAMILANO OT', '2023-05-20', 'MALOONG EXPENSES', 'Rubber Expenses', '1462.50', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(218, '41001', 'GREGORIO MATULAC OT', '2023-05-20', 'MALOONG EXPENSES', 'Rubber Expenses', '415.63', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(219, '41001', 'DINDO PENTOJO OT', '2023-05-20', 'MALOONG EXPENSES', 'Rubber Expenses', '2034.38', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(220, '41001', 'EDMUNDO CRISTOBAL ot', '2023-05-20', 'MALOONG EXPENSES', 'Rubber Expenses', '1350', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(221, '41001', 'PABLO HIPULAN OT', '2023-05-20', 'MALOONG EXPENSES', 'Rubber Expenses', '1575', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(222, '41001', 'DENNIS CORPUZ OT', '2023-05-20', 'MALOONG EXPENSES', 'Rubber Expenses', '1462.50', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(223, '41001', 'alvin bonifacio ot', '2023-05-20', 'MALOONG EXPENSES', 'Rubber Expenses', '1312.50', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(224, '41001', 'ederito luang ot', '2023-05-20', 'MALOONG EXPENSES', 'Rubber Expenses', '412.50', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(225, '41001', 'JULIO aballa OT', '2023-05-20', 'MALOONG EXPENSES', 'Rubber Expenses', '1150', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(226, '41001', 'RAMIL PELIGRIN OT', '2023-05-20', 'MALOONG EXPENSES', 'Rubber Expenses', '918.75', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(227, '41001', 'ALBERT CORNELIA OT', '2023-05-20', 'MALOONG EXPENSES', 'Rubber Expenses', '2765.63', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(228, '41132', 'GCASH CP#09171231110', '2023-05-22', 'RBN Expense', 'Personal Expenses', '15025', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(229, '41128', 'LULUBEL McCkay', '2023-05-22', 'DOLLAR EXCHANGES', 'Other Expenses', '5550', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(230, '41163', 'entrada copra 764sacks @ 3', '2023-05-22', 'Pakyawan Salaries', 'Copra Expenses', '2292', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(231, '41128', 'BRIAN ALBUTRA sunday', '2023-05-22', '  EJN SALARIES', 'Other Expenses', '400', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(232, '41128', 'mulawin lumber and labor trucking', '2023-05-22', 'Other Expense', 'Personal Expenses', '41000', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(233, '41128', 'laminat Registration LTO KAWASAKI USED IN MALOONG FOR KUMPAY', '2023-05-22', 'Other Expense', 'Personal Expenses', '40', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(234, '41128', 'RAQUEL BAIS BIR bookkeeping from EJN may 16-31, 2023', '2023-05-22', 'BIR EXPENSES', 'Other Expenses', '2500', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(235, '41131', 'ADDITIONAL PETTY CASH FOR ZAMBOANGA', '2023-05-22', 'ZAMBOANGA PCF', 'Other Expenses', '30000', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(236, '41130', 'feeds for 2 alive pigs for 1month consumption', '2023-05-22', 'RBN Expense', 'Personal Expenses', '10000', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(237, '41161', 'louie wet rubber labor 3355kls.@ .35', '2023-05-22', 'Pakyawan Salaries', 'Rubber Expenses', '1174.25', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(238, '41161', 'rafael half day sunday  charge to louie', '2023-05-22', '  EJN SALARIES', 'Other Expenses', '213', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(239, '00005', '2unit water pump chain sprocket and flunge fabrication', '2023-05-22', 'MALOONG EXPENSES', 'Rubber Expenses', '15000', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(240, '41129', '7days pordia of Ronie Sadio may 16-22, 2023 less: 500', '2023-05-22', 'SAYUGAN EXPENSES', 'Other Expenses', '1250', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(241, '41127', 'purchase 1unit kawasaki for kumpay music', '2023-05-22', 'MALOONG EXPENSES', 'Rubber Expenses', '25000', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(242, '41124', 'ronie vildad food allow, and load from may 2-29 to june 3, 2023', '2023-05-22', 'MALOONG EXPENSES', 'Rubber Expenses', '3170', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(243, '41124', 'additional inner tuber for kawasaki in maloong for kumpay used', '2023-05-22', 'MALOONG EXPENSES', 'Rubber Expenses', '200', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(244, '41124', '5days pordia of jimuel pintor', '2023-05-22', 'Other Expense', 'Personal Expenses', '6500', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(245, '41124', 'MKTG. BUDGET', '2023-05-22', 'MKTG. EXPENSES', 'Personal Expenses', '2500', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(246, '41124', 'FARE TO OVAL MARKET', '2023-05-22', 'Transportation Expenses', 'Other Expenses', '40', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(247, '41124', 'REGISTRATION OF KAWASAKI used in maloong ', '2023-05-22', 'LTO REGISTRATION EXPENSES', 'Other Expenses', '3000', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(248, '41117', 'tip to checker zambo', '2023-05-22', 'Other Expense', 'Other Expenses', '20', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(249, '41117', 'brooder for chicken in sayugan', '2023-05-22', 'ROOASTER EXPENSES', 'Other Expenses', '600', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(250, '41056', '20packing lacafe  @ 25', '2023-05-22', 'LACAFE EXPENSES', 'Coffee Expenses', '500', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(251, '41162', 'loading bales 2container ', '2023-05-22', 'Pakyawan Salaries', 'Rubber Expenses', '4000', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(252, '2715', 'PRIMEMOVER ARMAN 1 way fare bales to zambo', '2023-05-22', 'FREIGHT TO ZAMBO EXPENSES', 'Other Expenses', '7750', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(253, '2715', 'PRIMEMOVER ARMAN ', '2023-05-22', 'FREIGHT TO LAM EXPENSES', 'Other Expenses', '7216', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(254, '2716', 'PRIMEMOVER ERIC BALES 1WAY', '2023-05-22', 'FREIGHT TO ZAMBO EXPENSES', 'Other Expenses', '7750', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(255, '2716', 'PRIMEMOVER ERIC', '2023-05-22', 'FREIGHT TO LAM EXPENSES', 'Other Expenses', '7216', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(256, '41166', 'entrada copra 588sacks @ 3', '2023-05-23', 'Pakyawan Salaries', 'Copra Expenses', '1764', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(257, '41057', '20PAIL PACKING LACAFE @ 25', '2023-05-23', 'LACAFE EXPENSES', 'Coffee Expenses', '500', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(258, '41139', 'GASOLINE CONSUMPTION FROM APRIL 1-29, 2023', '2023-05-23', 'GASOLINE/FUEL/LUBRICANT EXP.', 'Other Expenses', '17362', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(259, '41134', 'FARE OF YAYA CHING', '2023-05-23', 'Transportation Expenses', 'Other Expenses', '20', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(260, '41134', 'siopao by JBN', '2023-05-23', 'Food and Snack', 'Personal Expenses', '480', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(261, '41134', 'UNIFORM BRIAN ALBUTRA', '2023-05-23', 'Other Expense', 'Personal Expenses', '3200', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(262, '41134', 'BREAD FOR MALOONG /BREAD FOR COPRA LABORER', '2023-05-23', 'Food and Snack', 'Personal Expenses', '400', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(263, '41131', 'sayugan water consumption for may 2023', '2023-05-23', 'SAYUGAN EXPENSES', 'Rubber Expenses', '2650', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(264, '50910', 'royalty fee for 2 prime arman and eric  5/22-23/23', '2023-05-23', 'LDC EXPENSES', 'Other Expenses', '400', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(265, '41134', 'gasoline for jimbong ', '2023-05-23', 'MALOONG EXPENSES', 'Rubber Expenses', '150', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(266, '41134', 'MKTG. BUDGET', '2023-05-23', 'MKTG. EXPENSES', 'Personal Expenses', '2500', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(267, '41134', 'FARE TO OVAL MARKET', '2023-05-23', 'Transportation Expenses', 'Other Expenses', '40', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(269, '41134', 'H2O', '2023-05-23', 'Other Expense', 'Personal Expenses', '155', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(270, '41134', 'G.A allow. donga wet rubber', '2023-05-23', 'Other Expense', 'Rubber Expenses', '100', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(271, '41164', 'donga wet rubber labor 3020kls@ .35', '2023-05-23', 'Pakyawan Salaries', 'Rubber Expenses', '1057', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(272, '41165', 'pata wet rubber labor 12865kls@ .35', '2023-05-23', 'Pakyawan Salaries', 'Rubber Expenses', '4503', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(273, '2717', 'PRIMEMOVER ERIC wet export pasahe to zambo', '2023-05-23', 'FREIGHT TO ZAMBO EXPENSES', 'Other Expenses', '8050', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(274, '2717', 'PRIMEMOVER ERIC to lamitan', '2023-05-23', 'FREIGHT TO LAM EXPENSES', 'Other Expenses', '7216', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(275, '41140', 'change of lacafe DR#17065 AND DR#17066', '2023-05-24', 'Other Expense', 'Coffee Expenses', '55', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(276, '41140', 'SNACK FOR KIDAPAWAN BOYS', '2023-05-24', 'Food and Snack', 'Personal Expenses', '100', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(277, '41140', 'Stamp pad marina JOECRIS T851', '2023-05-24', 'Other Expense', 'Other Expenses', '50', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(278, '41140', 'LUMBER used for making room in sayugan', '2023-05-24', 'SAYUGAN EXPENSES', 'Other Expenses', '2026', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(279, '41059', 'packing lacafe 21pail @ 25', '2023-05-24', 'LACAFE EXPENSES', 'Coffee Expenses', '525', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(280, '41005', 'kayanan Restaurant meals reimbursement plantation buahan and pattah', '2023-05-24', 'MALOONG EXPENSES', 'Rubber Expenses', '650', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(281, '41140', 'cash to zambo', '2023-05-24', 'JBN EXPENSES', 'Personal Expenses', '10000', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(282, '41140', 'MKTG. BUDGET', '2023-05-24', 'MKTG. EXPENSES', 'Personal Expenses', '2500', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(283, '41140', 'GIGI OT LACAFE', '2023-05-24', 'LACAFE EXPENSES', 'Coffee Expenses', '300', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(284, '41140', 'FARE TO OVAL MARKET', '2023-05-24', 'Transportation Expenses', 'Other Expenses', '40', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(285, '41140', 'BREAD FOR OFFICE ', '2023-05-24', 'Food and Snack', 'Other Expenses', '50', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(286, '41169', 'entrada copra 798sacks @ ', '2023-05-24', 'Pakyawan Salaries', 'Copra Expenses', '2394', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(287, '41168', 'wet rubber labor 12605kls@ .35', '2023-05-24', 'Pakyawan Salaries', 'Rubber Expenses', '4411', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(288, '41167', 'loading rubber bales 600 bales', '2023-05-24', 'Pakyawan Salaries', 'Rubber Expenses', '2000', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(289, '2718', 'T851 JOECRIS BALES EXPORT', '2023-05-24', 'FREIGHT TO ZAMBO EXPENSES', 'Rubber Expenses', '6966', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(290, '2718', 'T851 JOECRIS', '2023-05-24', 'FREIGHT TO LAM EXPENSES', 'Other Expenses', '6106', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(291, '2719', 'PRIMEMOVER ARMAN WET EXPORT', '2023-05-24', 'FREIGHT TO ZAMBO EXPENSES', 'Rubber Expenses', '8050', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(292, '2719', 'PRIMEMOVER ARMAN ', '2023-05-24', 'FREIGHT TO LAM EXPENSES', 'Other Expenses', '7216', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(293, '41140', 'FARE TO NTC', '2023-05-24', 'Transportation Expenses', 'Other Expenses', '40', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(294, '41142', 'snack for labor', '2023-05-25', 'Food and Snack', 'Other Expenses', '200', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(295, '2721', 'PRIMEMOVER ARMAN ', '2023-05-25', 'FREIGHT TO ZAMBO EXPENSES', 'Rubber Expenses', '8050', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(296, '2721', 'PRIMEMOVER ARMAN ', '2023-05-25', 'FREIGHT TO LAM EXPENSES', 'Other Expenses', '7216', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(297, '2720', 'PRIMEMOVER ERIC wet export', '2023-05-25', 'FREIGHT TO ZAMBO EXPENSES', 'Rubber Expenses', '8050', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(298, '2720', 'PRIMEMOVER ERIC', '2023-05-25', 'FREIGHT TO LAM EXPENSES', 'Other Expenses', '7216', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(299, '91753', 'separation pay for Jayzel Napalcruz from NTC', '2023-05-25', 'Other Expense', 'Other Expenses', '12000', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(301, '41142', 'ALLOW.OF G.Ain martin muslimin', '2023-05-25', 'Other Expense', 'Rubber Expenses', '150', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(302, '41142', 'MKTG. BUDGET', '2023-05-25', 'MKTG. EXPENSES', 'Personal Expenses', '2500', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(303, '41142', 'FARE TO OVAL MARKET', '2023-05-25', 'Transportation Expenses', 'Other Expenses', '40', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(304, '41142', 'loloy mktg.', '2023-05-25', 'MKTG. EXPENSES', 'Personal Expenses', '500', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(305, '41142', 'MKTG. BUDGET', '2023-05-25', 'MKTG. EXPENSES', 'Personal Expenses', '1000', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(306, '41142', 'jbn pasahe', '2023-05-25', 'Transportation Expenses', 'Personal Expenses', '20', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(307, '41142', 'CHARGE CEBuan CASH SEND TO NOEL C.A AND PCF', '2023-05-25', 'Other Expense', 'Other Expenses', '400', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(308, '50928', 'LAMITAN DOCKHANDLERS  MAY 24-25/23', '2023-05-25', 'LDC EXPENSES', 'Other Expenses', '600', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(309, '41170', 'loading wet rubber export 1 contaner', '2023-05-25', 'Pakyawan Salaries', 'Rubber Expenses', '6000', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(310, '41145', 'ADDITIONAL PETTY CASH FOR ZAMBOANGA', '2023-05-25', 'ZAMBOANGA PCF', 'Other Expenses', '30000', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(311, '41146', 'purchase raincot for ntc', '2023-05-25', 'Other Expense', 'Other Expenses', '15000', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(312, '41144', 'pcf for june 2023', '2023-05-25', 'MANILA PCF', 'Other Expenses', '10000', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(313, '41173', 'louie wet rubber 4175kls@ .35', '2023-05-26', 'Pakyawan Salaries', 'Rubber Expenses', '1461', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(314, '48708', 'gasul for kitchen', '2023-05-26', 'Other Expense', 'Personal Expenses', '1237', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(315, '41147', 'BREAD FOR OFFICE ', '2023-05-26', 'Food and Snack', 'Other Expenses', '200', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(316, '41147', 'charge union bank Dr.Kim Khauv', '2023-05-26', 'Other Expense', 'Other Expenses', '25', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(317, '41147', 'BREAD FOR OFFICE ', '2023-05-26', 'Food and Snack', 'Other Expenses', '45', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(318, '41147', 'MKTG. BUDGET', '2023-05-26', 'MKTG. EXPENSES', 'Personal Expenses', '2500', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(319, '41147', 'FARE TO OVAL MARKET', '2023-05-26', 'Transportation Expenses', 'Other Expenses', '40', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(320, '41147', 'mais', '2023-05-26', 'Other Expense', 'Personal Expenses', '200', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(321, '41147', 'load for dindo', '2023-05-26', 'Other Expense', 'Other Expenses', '100', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(322, '41149', 'dollar exchanges 500usd@ 55.65', '2023-05-26', 'Other Expense', 'Other Expenses', '27825', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(323, '41171', 'pata wet rubber labor 12560kls@ .35', '2023-05-26', 'Pakyawan Salaries', 'Rubber Expenses', '4396', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(324, '41172', 'entrada copra 674kls@ 3', '2023-05-26', 'Pakyawan Salaries', 'Rubber Expenses', '2022', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(325, '41174', 'pata labor wet rubber 8475kls@ .35', '2023-05-26', 'Pakyawan Salaries', 'Rubber Expenses', '2966', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(326, '41175', 'ENTRADA COPRA 431SACKS @3', '2023-05-26', 'Pakyawan Salaries', 'Copra Expenses', '1293', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(327, '2722', 'PRIMEMOVER ERIC', '2023-05-26', 'FREIGHT TO ZAMBO EXPENSES', 'Rubber Expenses', '8050', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(328, '2722', 'PRIMEMOVER ERIC', '2023-05-26', 'FREIGHT TO LAM EXPENSES', 'Other Expenses', '7216', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(329, '41206', 'patatas abnd carrots', '2023-05-27', 'Other Expense', 'Personal Expenses', '50', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(330, '41206', 'maloong saging prito', '2023-05-27', 'Food and Snack', 'Other Expenses', '300', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(331, '41206', 'LABADA EDITHA ', '2023-05-27', 'Other Expense', 'Personal Expenses', '750', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(332, '41206', '5days pordia @ 220 joebert balasuela', '2023-05-27', 'SAYUGAN EXPENSES', 'Other Expenses', '1100', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(333, '41206', 'roasting lacafe ', '2023-05-27', 'LACAFE EXPENSES', 'Coffee Expenses', '100', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(334, '41206', 'donation to church/mass offering for efren new', '2023-05-27', 'Other Expense', 'Personal Expenses', '5000', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(335, '00005', 'karpintero sayugan sajid 3days@ 400 / jemjem 3days @ 200', '2023-05-27', 'SAYUGAN EXPENSES', 'Other Expenses', '1800', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(336, '41206', 'H2O/BAGON GATA', '2023-05-27', 'Other Expense', 'Personal Expenses', '425', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(337, '41206', 'FISH ALLOW. FOR MALELEEL CERO COMPANY', '2023-05-27', 'Other Expense', 'Other Expenses', '300', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(338, '41206', 'VULCANIZING 1TIRE PRIME ORANGE', '2023-05-27', 'TRUCK EXPENSES', 'Other Expenses', '350', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(339, '41176', 'loading wet 1container', '2023-05-27', 'Pakyawan Salaries', 'Rubber Expenses', '4500', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(340, '41060', 'EXTRA PORDIA JORESH', '2023-05-27', 'LACAFE EXPENSES', 'Coffee Expenses', '240', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(341, '40314', 'cleaning of sacks rubber nono and utik may 21-27, 2023', '2023-05-27', 'MALOONG EXPENSES', 'Rubber Expenses', '1000', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(342, '40307', 'transpo allow of jean from may 29-to june 3', '2023-05-27', 'MALOONG EXPENSES', 'Rubber Expenses', '300', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(343, '40311', 'ot of anthony castil  ', '2023-05-27', 'MALOONG EXPENSES', 'Rubber Expenses', '3000', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(344, '40309', 'reimbursement royal biscocho for plantatin meeting jean abella', '2023-05-27', 'MALOONG EXPENSES', 'Rubber Expenses', '405', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(345, '40313', 'toto castil  OT', '2023-05-27', 'MALOONG EXPENSES', 'Rubber Expenses', '2812', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(346, '40308', 'TOTO AND ANTHONY FOOD ALLOW.', '2023-05-27', 'MALOONG EXPENSES', 'Rubber Expenses', '1000', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(347, '40312', 'MALOONG FIELD WORKER WEEKLE SALARY MAY 22 TO MAY 27', '2023-05-27', 'MALOONG EXPENSES', 'Rubber Expenses', '19750', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(348, '41204', 'MEDICINE AND VITAMINS CONSUMPTION ROSIR PHARMACY', '2023-05-27', 'Other Expense', 'Other Expenses', '4206', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(349, '41202', 'MKTG. BUDGET', '2023-05-27', 'MKTG. EXPENSES', 'Personal Expenses', '2540', NULL, '', NULL, 'Cash', NULL, 'Basilan');
INSERT INTO `ledger_expenses` (`id`, `voucher_no`, `particulars`, `date`, `category`, `type_expense`, `amount`, `description`, `remarks`, `destination`, `mode_transact`, `date_payment`, `location`) VALUES
(350, '41202', 'LALANG/JUNG2X AND TATA', '2023-05-27', 'OVERTIME EXPENSES', 'Other Expenses', '300', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(351, '41202', 'MELVIN ELECTRICIAN 2DAYS', '2023-05-27', 'OVERTIME EXPENSES', 'Other Expenses', '500', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(352, '41202', 'DIESEL FORTUNER', '2023-05-27', 'Other Expense', 'Personal Expenses', '2000', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(353, '41202', 'ICE CREAM', '2023-05-27', 'Other Expense', 'Personal Expenses', '400', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(354, '41177', 'ENTRADA COPRA 468SACKS @ 3', '2023-05-27', 'Pakyawan Salaries', 'Copra Expenses', '1404', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(355, '2723', 'PRIMEMOVER ARMAN WET EXPORT', '2023-05-27', 'FREIGHT TO ZAMBO EXPENSES', 'Rubber Expenses', '8050', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(356, '2723', 'PRIMEMOVER ARMAN ', '2023-05-27', 'FREIGHT TO LAM EXPENSES', 'Other Expenses', '7216', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(357, '40310', 'BERTO GALANO OT', '2023-05-27', 'MALOONG EXPENSES', 'Rubber Expenses', '1297.98', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(358, '40310', 'RONIE VILDAD OT', '2023-05-27', 'MALOONG EXPENSES', 'Rubber Expenses', '739.26', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(359, '40310', 'JEANNE ABELLA OT', '2023-05-27', 'MALOONG EXPENSES', 'Rubber Expenses', '2668.07', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(360, '40310', 'JOVY SAMIJON OT', '2023-05-27', 'MALOONG EXPENSES', 'Rubber Expenses', '503.13', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(361, '40310', 'JAR AR QUIMCO OT', '2023-05-27', 'MALOONG EXPENSES', 'Rubber Expenses', '937.50', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(362, '40310', 'RAP RAP ABARQUEZ OT', '2023-05-27', 'MALOONG EXPENSES', 'Rubber Expenses', '262.50', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(363, '40310', 'JERRY GARCIA OT', '2023-05-27', 'MALOONG EXPENSES', 'Rubber Expenses', '750', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(364, '40310', 'SAMUEL RAMILANO OT', '2023-05-27', 'MALOONG EXPENSES', 'Rubber Expenses', '1443.75', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(365, '40310', 'GREGORIO MATULAC OT', '2023-05-27', 'MALOONG EXPENSES', 'Rubber Expenses', '940.63', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(366, '40310', 'DINDO PENTOJO OT', '2023-05-27', 'MALOONG EXPENSES', 'Rubber Expenses', '2340.63', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(367, '40310', 'EDMUNDO CRISTOBAL ot', '2023-05-27', 'MALOONG EXPENSES', 'Rubber Expenses', '75', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(368, '40310', 'PABLO HIPULAN OT', '2023-05-27', 'MALOONG EXPENSES', 'Rubber Expenses', '875', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(369, '40310', 'DENNIS CORPUZ OT', '2023-05-27', 'MALOONG EXPENSES', 'Rubber Expenses', '900', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(370, '40310', 'ALVIN BONIFACIO SALARY', '2023-05-27', 'MALOONG EXPENSES', 'Rubber Expenses', '787.50', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(371, '40310', 'ederito luang ot', '2023-05-27', 'MALOONG EXPENSES', 'Rubber Expenses', '356.25', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(372, '40310', 'JULIO aballa OT', '2023-05-27', 'MALOONG EXPENSES', 'Rubber Expenses', '1650', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(373, '40310', 'RAMIL PELIGRIN OT', '2023-05-27', 'MALOONG EXPENSES', 'Rubber Expenses', '825', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(374, '40310', 'ALBERT CORNELIA OT', '2023-05-27', 'MALOONG EXPENSES', 'Rubber Expenses', '2781.25', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(375, '41202', 'ICE CREAM', '2023-05-27', 'Other Expense', 'Personal Expenses', '1000', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(376, '2725', 'PRIMEMOVER ERIC bales', '2023-05-29', 'FREIGHT TO ZAMBO EXPENSES', 'Rubber Expenses', '7750', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(377, '2725', 'PRIMEMOVER ERIC', '2023-05-29', 'FREIGHT TO LAM EXPENSES', 'Other Expenses', '7216', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(378, '2724', 'joecris T851 bales', '2023-05-29', 'FREIGHT TO ZAMBO EXPENSES', 'Rubber Expenses', '6966', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(379, '2724', 'joecris T851', '2023-05-29', 'FREIGHT TO LAM EXPENSES', 'Other Expenses', '6106', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(380, '41207', 'jimuel abella and compnay salary', '2023-05-29', '  EJN SALARIES', 'Other Expenses', '9550', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(381, '41013', 'jayson lipayo salary may 23 to 27, 2023 ', '2023-05-29', 'MALOONG EXPENSES', 'Rubber Expenses', '1250', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(382, '39822', 'ervin magnaye brassing pordia may 22-27', '2023-05-29', 'MALOONG PLANTATION EXP.', 'Other Expenses', '9000', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(383, '41219', 'ronie sadio 7days @ 25 from may 23-29', '2023-05-29', 'SAYUGAN EXPENSES', 'Other Expenses', '1750', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(384, '41218', 'butter dairy cream', '2023-05-29', 'Other Expense', 'Personal Expenses', '80', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(385, '41218', 'rbn BIHON', '2023-05-29', 'Other Expense', 'Personal Expenses', '250', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(386, '41218', 'MARITIME STAMP SOP', '2023-05-29', 'Other Expense', 'Rubber Expenses', '50', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(387, '41218', 'RBN CASH', '2023-05-29', 'RBN Expense', 'Personal Expenses', '2000', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(388, '41218', 'G.A ALLOW WET LOADING MUDZ AND NENET', '2023-05-29', 'ALLOWANCE FOR BUYING EXPENSES', 'Rubber Expenses', '300', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(389, '41218', 'G.A SALARY SUNDAY', '2023-05-29', '  EJN SALARIES', 'Other Expenses', '415', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(390, '41179', 'LOADING RUBBER BALES 2CONTAINER', '2023-05-29', 'Pakyawan Salaries', 'Rubber Expenses', '4000', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(391, '41217', 'ADDITIONAL PETTY CASH FOR ZAMBOANGA', '2023-05-29', 'ZAMBOANGA PCF', 'Other Expenses', '30000', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(392, '41014', 'JIMROY STORE PAYMENT SNACK DURING VISTS PLANTA', '2023-05-29', 'MALOONG EXPENSES', 'Rubber Expenses', '1050', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(393, '41213', 'SUNDAY OF BRYAN ALBUTRA', '2023-05-29', '  EJN SALARIES', 'Other Expenses', '400', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(394, '41213', 'FEEDS FOR ROASTER W/FARE', '2023-05-29', 'ROOASTER EXPENSES', 'Other Expenses', '3585', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(395, '50935', '6trips dockhandlers fee to wharf', '2023-05-29', 'LDC EXPENSES', 'Rubber Expenses', '1200', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(396, '41213', '4PERSON OT ROASTING', '2023-05-29', 'LACAFE EXPENSES', 'Coffee Expenses', '1321', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(397, '41212', 'ntc payment partial TO bir', '2023-05-29', 'BIR EXPENSES', 'Other Expenses', '300000', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(398, '41178', '5DRUMS DIESEL @ 20', '2023-05-29', 'LOADING/UNLOADING EXPENSES', 'Other Expenses', '100', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(399, '41207', 'jayson lipayo food allow.', '2023-05-29', 'Food and Snack', 'Other Expenses', '300', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(400, '41207', 'mktg. 2days 5/28-29/23', '2023-05-29', 'MKTG. EXPENSES', 'Personal Expenses', '5080', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(401, '41180', 'entrada copra 598sacks@ 3', '2023-05-29', 'Pakyawan Salaries', 'Copra Expenses', '1794', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(402, '15657', '19trips transfortng fee to wharf prime/truck/', '2023-05-29', 'TRANSPORTING FEE', 'Other Expenses', '1900', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(403, '41182', 'arevalo wet rubber 660kls@ .25  and loading/unloading 680kls@ .16', '2023-05-30', 'Pakyawan Salaries', 'Rubber Expenses', '274', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(404, '41181', 'labor wet rubber jr and platation 2305kls@ .35 / 16480kls.@ .35', '2023-05-30', 'Pakyawan Salaries', 'Rubber Expenses', '6575', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(405, '41220', 'coconut', '2023-05-30', 'Other Expense', 'Personal Expenses', '50', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(407, '41220', 'h2o', '2023-05-30', 'Other Expense', 'Personal Expenses', '125', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(408, '41220', 'CASH taken', '2023-05-30', 'RBN Expense', 'Personal Expenses', '2500', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(409, '41220', 'G. A allow.', '2023-05-30', 'ALLOWANCE FOR BUYING EXPENSES', 'Other Expenses', '100', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(410, '41184', 'aerco wet rubber labor 7655kls@ .35', '2023-05-30', 'Pakyawan Salaries', 'Rubber Expenses', '2680', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(411, '41184', 'entrada copra 538sacks @ 3 less: roger 50', '2023-05-30', 'Pakyawan Salaries', 'Copra Expenses', '1614', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(412, '41061', 'packing lacafe 7pail@ 25 ', '2023-05-30', 'LACAFE EXPENSES', 'Coffee Expenses', '175', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(413, '41218', 'MKTG. BUDGET', '2023-05-30', 'MKTG. EXPENSES', 'Personal Expenses', '3000', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(414, '41218', 'FARE TO OVAL MARKET', '2023-05-30', 'Transportation Expenses', 'Other Expenses', '40', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(415, '41218', 'jbn to zambo', '2023-05-30', 'JBN EXPENSES', 'Personal Expenses', '10000', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(416, '41218', 'OT gigi', '2023-05-30', 'LACAFE EXPENSES', 'Coffee Expenses', '300', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(417, '41185', 'entrada copra 713sacks @ 3', '2023-05-31', 'Pakyawan Salaries', 'Copra Expenses', '2139', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(418, '41185', 'LOADING 5DRUMS DIESEL @ 10 LESS: 50', '2023-05-31', 'LOADING/UNLOADING EXPENSES', 'Other Expenses', '50', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(420, '41220', 'MKTG. BUDGET', '2023-05-31', 'MKTG. EXPENSES', 'Other Expenses', '3000', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(421, '41220', 'FARE TO OVAL MARKET', '2023-05-31', 'Transportation Expenses', 'Other Expenses', '40', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(422, '41220', 'LECHE PLAN', '2023-05-31', 'Other Expense', 'Other Expenses', '200', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(423, '41223', 'LOAD STARLINK/INSTALLATION/US TANGLE DALE FUENTABELLA', '2023-05-31', 'Other Expense', 'Other Expenses', '5350', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(424, '41224', 'SEPARATION PAY', '2023-05-31', '  EJN SALARIES', 'Other Expenses', '24000', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(425, '50955', 'LAMITAN DOCKHANDLERS  MAY 29', '2023-05-31', 'LDC EXPENSES', 'Rubber Expenses', '400', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(426, '41238', 'LABORER SNACK', '2023-05-31', 'SSS', 'Other Expenses', '100', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(427, '41062', '24pail packing lacafe @ 25 CORAZON', '2023-05-31', 'LACAFE EXPENSES', 'Coffee Expenses', '600', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(428, '41238', 'JOSEPH BENOSA 5/16-31/23 NTC BIR BOOKKEEPING', '2023-05-31', 'BIR EXPENSES', 'Other Expenses', '2500', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(429, '39844', 'g.a OT overtime loading 5/24/23', '2023-05-31', 'OVERTIME EXPENSES', 'Rubber Expenses', '1210', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(430, '39846', 'renante saavedra loading export  may 3-16, 2023', '2023-05-31', 'OVERTIME EXPENSES', 'Rubber Expenses', '3692', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(431, '39845', 'loading wet rubber feb. 13 tp may 24', '2023-05-31', 'OVERTIME EXPENSES', 'Rubber Expenses', '1969', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(432, '41063', '18pail packing lacafe @# 25', '2023-05-31', 'LACAFE EXPENSES', 'Coffee Expenses', '450', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(433, '41244', 'felix albutra 21days @ 300 from may 11-31,2023', '2023-05-31', '  EJN SALARIES', 'Other Expenses', '6300', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(434, '39843', 'GUILBERT FERNANDEZ less: 500', '2023-05-31', '  EJN SALARIES', 'Other Expenses', '4820', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(435, '41225', 'ryan atilano from may 16-31, 2023 14days @ 235', '2023-05-31', '  EJN SALARIES', 'Other Expenses', '2790', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(436, '41040', 'totoh castil salary ', '2023-05-31', 'MALOONG EXPENSES', 'Rubber Expenses', '11300', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(437, '41038', 'anthony castil less: 2000', '2023-05-31', 'MALOONG EXPENSES', 'Rubber Expenses', '7700', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(438, '39825', 'renante saavedra loading export  may16-31 2023', '2023-05-31', '  EJN SALARIES', 'Other Expenses', '6269', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(439, '39826', 'MICHAEL TUNACAO ', '2023-05-31', '  EJN SALARIES', 'Other Expenses', '6500', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(441, '39826', 'azenit valledor', '2023-05-31', '  EJN SALARIES', 'Other Expenses', '4050', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(442, '39826', 'RONIE TORIBIO', '2023-05-31', '  EJN SALARIES', 'Other Expenses', '5961', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(443, '39826', 'arman antonio', '2023-05-31', '  EJN SALARIES', 'Other Expenses', '7800', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(444, '39826', 'ETHEL BETITA', '2023-05-31', '  EJN SALARIES', 'Other Expenses', '3924', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(445, '39830', 'JEFFERSON ALIPIO SALARY AND FOOD ALLOW. less: 500', '2023-05-31', '  EJN SALARIES', 'Other Expenses', '4200', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(446, '39829', 'fencing in processing may 15-31 2023 salary jojo deliverio and company', '2023-05-31', 'MALOONG EXPENSES', 'Other Expenses', '25000', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(447, '39827', 'JULIO ABALLA SALARY', '2023-05-31', 'MALOONG EXPENSES', 'Rubber Expenses', '5100', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(448, '39827', 'JERRY GARCIA SALARY', '2023-05-31', 'MALOONG EXPENSES', 'Rubber Expenses', '1200', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(449, '39827', 'DINDO PENTOJO SALARY', '2023-05-31', 'MALOONG EXPENSES', 'Rubber Expenses', '1700', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(450, '39827', 'LUANG EDERITO SALARY', '2023-05-31', 'MALOONG EXPENSES', 'Rubber Expenses', '1200', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(451, '39827', 'WILFRIDO QUIMCO SALARY', '2023-05-31', 'MALOONG EXPENSES', 'Rubber Expenses', '2500', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(452, '39827', 'ALVIN BONIFACIO SALARY', '2023-05-31', 'MALOONG EXPENSES', 'Rubber Expenses', '770', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(453, '39827', 'sualog ', '2023-05-31', 'MALOONG EXPENSES', 'Rubber Expenses', '550', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(454, '39827', 'ALBERT CORNELIA SALARY', '2023-05-31', 'MALOONG EXPENSES', 'Rubber Expenses', '1900', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(455, '41239', 'LINDA DEL ROSARIO ', '2023-05-31', '  EJN SALARIES', 'Other Expenses', '3000', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(456, '39831', 'rogeley ramos', '2023-05-31', '  EJN SALARIES', 'Other Expenses', '4424', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(457, '41237', 'jecelyn enriquez salary adjustment', '2023-05-31', 'Other Expense', 'Other Expenses', '2000', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(458, '39839', 'gomer alfer', '2023-05-31', 'SAYUGAN EXPENSES', 'Other Expenses', '1750', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(459, '39839', 'AMANTE LEQUIN SALARY', '2023-05-31', 'SAYUGAN EXPENSES', 'Other Expenses', '6500', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(460, '39834', 'tata torres', '2023-05-31', 'LACAFE EXPENSES', 'Coffee Expenses', '202.60', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(461, '39834', 'feliper borda salary', '2023-05-31', 'LACAFE EXPENSES', 'Coffee Expenses', '1900', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(462, '39834', 'ernesto ', '2023-05-31', 'LACAFE EXPENSES', 'Coffee Expenses', '1300', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(463, '39834', 'EMELITO LANGUTAN', '2023-05-31', 'LACAFE EXPENSES', 'Coffee Expenses', '710', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(464, '41240', 'mercy palconit less: 1000', '2023-05-31', '  EJN SALARIES', 'Personal Expenses', '6000', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(465, '41241', 'CONCHITA DELOS REYES SALARY less: 1100', '2023-05-31', '  EJN SALARIES', 'Personal Expenses', '4500', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(466, '39840', 'RAFAEL RAMIREZ ', '2023-05-31', '  EJN SALARIES', 'Other Expenses', '2945', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(467, '39842', 'ESTRELITO BRIEVA ', '2023-05-31', '  EJN SALARIES', 'Other Expenses', '4900', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(468, '41242', 'reymar cabading less: 500', '2023-05-31', '  EJN SALARIES', 'Other Expenses', '2700', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(469, '41243', 'DYELOBERT FERNANDEZ', '2023-05-31', '  EJN SALARIES', 'Other Expenses', '3290', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(470, '39841', 'joey ortega salary less: 1000', '2023-05-31', '  EJN SALARIES', 'Other Expenses', '4900', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(471, '2726', 'PRIMEMOVER ARMAN WET EXPORT', '2023-05-31', 'FREIGHT TO ZAMBO EXPENSES', 'Rubber Expenses', '8050', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(472, '2726', 'PRIMEMOVER ARMAN ', '2023-05-31', 'FREIGHT TO LAM EXPENSES', 'Other Expenses', '7216', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(473, '2727', 'PRIMEMOVER ERIC', '2023-05-31', 'FREIGHT TO ZAMBO EXPENSES', 'Rubber Expenses', '8050', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(474, '2727', 'PRIMEMOVER ERIC', '2023-05-31', 'FREIGHT TO LAM EXPENSES', 'Other Expenses', '7216', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(475, '41064', 'packing lacafe 13pail @ 25', '2023-06-01', 'LACAFE EXPENSES', 'Coffee Expenses', '325', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(476, '41186', 'loading wet rubber export ', '2023-06-01', 'Pakyawan Salaries', 'Rubber Expenses', '4500', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(477, '41248', 'baselco sayugan/bodega/tscale', '2023-06-01', 'Electricity', 'Other Expenses', '15258', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(478, '41246', 'laminate ID of rbn ph', '2023-06-01', 'Pag-ibig', 'Personal Expenses', '40', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(479, '41246', 'MKTG. BUDGET', '2023-06-01', 'Other Expense', 'Personal Expenses', '2500', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(480, '41246', 'FARE TO OVAL MARKET', '2023-06-01', 'Transportation Expenses', 'Other Expenses', '40', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(481, '41246', 'cash allow.', '2023-06-01', 'RBN Expense', 'Copra Expenses', '13000', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(482, '41246', 'JCI donation by JBN', '2023-06-01', 'Other Expense', 'Personal Expenses', '10000', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(483, '41246', 'DAYAN FARE 3DAYS sss AND PH', '2023-06-01', 'Transportation Expenses', 'Other Expenses', '250', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(484, '41246', 'lbc TO SHOWA docs', '2023-06-01', 'Other Expense', 'Rubber Expenses', '310', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(485, '41255', 'ADDITIONAL PETTY CASH FOR ZAMBOANGA', '2023-06-01', 'ZAMBOANGA PCF', 'Other Expenses', '30000', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(486, '39849', 'full payment in motor dryer maloong ', '2023-06-01', 'MALOONG EXPENSES', 'Rubber Expenses', '5000', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(487, '41187', 'entrada copra 422sack s@ 3 less: 50', '2023-06-01', 'Pakyawan Salaries', 'Other Expenses', '1216', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(488, '39848', 'JOECRIS CLIMACO SALARY less: 650', '2023-06-01', '  EJN SALARIES', 'Other Expenses', '3900', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(489, '41257', 'ar-hazim abdurajak 16days @ 220 from may 15-31.2023 less: 500', '2023-06-01', '  EJN SALARIES', 'Other Expenses', '3020', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(490, '2728', 'PRIMEMOVER ARMAN ', '2023-06-01', 'FREIGHT TO ZAMBO EXPENSES', 'Rubber Expenses', '8050', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(491, '2728', 'PRIMEMOVER ARMAN ', '2023-06-01', 'FREIGHT TO LAM EXPENSES', 'Other Expenses', '7216', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(492, '2729', 'PRIMEMOVER ERIC', '2023-06-01', 'FREIGHT TO ZAMBO EXPENSES', 'Rubber Expenses', '8050', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(493, '2729', 'PRIMEMOVER ERIC', '2023-06-01', 'FREIGHT TO LAM EXPENSES', 'Other Expenses', '7216', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(494, '2732', 'joecris T851 copra', '2023-06-02', 'FREIGHT TO ZAMBO EXPENSES', 'Copra Expenses', '6966', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(495, '2732', 'joecris T851', '2023-06-02', 'FREIGHT TO LAM EXPENSES', 'Other Expenses', '6106', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(496, '2732', 'MARITIME STAMP SOP', '2023-06-02', 'Other Expense', 'Rubber Expenses', '50', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(497, '2730', 'PRIMEMOVER ARMAN WET EXPORT', '2023-06-02', ' FREIGHT TO ZAMBO EXPENSES ', 'Rubber Expenses', '8050', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(498, '2730', 'PRIMEMOVER ARMAN ', '2023-06-02', 'FREIGHT TO LAM EXPENSES', 'Other Expenses', '7216', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(499, '2731', 'PRIMEMOVER ERIC wet export', '2023-06-02', ' FREIGHT TO ZAMBO EXPENSES ', 'Rubber Expenses', '8050', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(500, '2731', 'PRIMEMOVER ERIC', '2023-06-02', 'FREIGHT TO LAM EXPENSES', 'Other Expenses', '7216', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(501, '41246', 'MKTG. BUDGET', '2023-06-02', 'MALOONG EXPENSES', 'Personal Expenses', '3500', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(502, '41246', 'H2O', '2023-06-02', 'Other Expense', 'Personal Expenses', '155', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(503, '41246', 'FARE TO OVAL MARKET', '2023-06-02', 'Transportation Expenses', 'Other Expenses', '40', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(504, '41191', 'ENTRADA COPRA 22SACKS @ 3', '2023-06-02', 'Pakyawan Salaries', 'Copra Expenses', '66', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(505, '41258', 'RBN PLANE TICKET ', '2023-06-02', 'RBN Expense', 'Personal Expenses', '24000', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(506, '41261', 'JULIO TRANSO ALLOW. VICE VERSA FOR 26DAYS@ 40 MAY 1-31', '2023-06-02', 'MALOONG EXPENSES', 'Rubber Expenses', '1040', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(507, '41189', 'ENTRADA COPRA 349SACKS @ 3', '2023-06-02', 'Pakyawan Salaries', 'Copra Expenses', '1047', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(508, '41190', 'LOADING 4DRUMS DIESEL AND 3DRUMS UNLOADING', '2023-06-02', 'LOADING/UNLOADING EXPENSES', 'Other Expenses', '70', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(509, '41065', 'EXTRA PORDIA RENSIE', '2023-06-02', 'LACAFE EXPENSES', 'Coffee Expenses', '240', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(510, '48613', 'gasul for kitchen', '2023-06-02', 'Other Expense', 'Personal Expenses', '1237', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(511, '41262', 'NTC BIR payment', '2023-06-02', 'NTC expenses', 'Other Expenses', '350000', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(512, '41047', 'LUMBER FOR POGON USED IN MALOONG', '2023-06-02', 'MALOONG EXPENSES', 'Rubber Expenses', '50000', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(513, '41259', 'gcash cp#0991339955 date june 1 and gcash cp#09171424152 date  6/2', '2023-06-02', 'RBN Expense', 'Personal Expenses', '15050', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(514, '41258', 'food allow. in maloong plantation maleleel cero and company for 2days ', '2023-06-02', 'MALOONG PLANTATION EXP.', 'Personal Expenses', '600', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(515, '39850', 'ramon gutang tabas sprey 7days @ 310 may 25-31 in maloong plantation', '2023-06-02', '  EJN SALARIES', 'Other Expenses', '1670', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(516, '41301', 'ruben pascual 5/25-31/23 maloong plantation 6days@ 500 less: 500', '2023-06-02', '  EJN SALARIES', 'Other Expenses', '2500', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(517, '41302', 'jamine alimento 5/25-31/23 for 7days@ 310 less: 500', '2023-06-02', '  EJN SALARIES', 'Other Expenses', '1670', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(518, '41188', 'james tan wet rubber 12025kls@ .25', '2023-06-02', 'Pakyawan Salaries', 'Rubber Expenses', '4209', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(519, '41261', 'sprite', '2023-06-02', 'Other Expense', 'Personal Expenses', '17', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(520, '41261', 'siopao and drinks', '2023-06-02', 'Other Expense', 'Personal Expenses', '544', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(521, '2733', 'JOECRIS T139 COPRA', '2023-06-03', ' FREIGHT TO ZAMBO EXPENSES ', 'Copra Expenses', '6966', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(522, '41264', 'GIGI OT LACAFE', '2023-06-03', 'LACAFE EXPENSES', 'Coffee Expenses', '300', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(523, '41264', 'MKTG. BUDGET', '2023-06-03', 'MKTG. EXPENSES', 'Personal Expenses', '3500', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(524, '41264', 'FARE TO OVAL MARKET', '2023-06-03', 'Transportation Expenses', 'Other Expenses', '40', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(525, '40965', 'ANTHONY CASTIL  OT from 5/29/23 TO JUNE 2, 2023', '2023-06-03', 'MALOONG EXPENSES', 'Rubber Expenses', '3000', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(526, '40964', 'TOTOH CASTIL OT FROM MAY 29-JUNE 2', '2023-06-03', 'MALOONG EXPENSES', 'Rubber Expenses', '3750', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(527, '40960', 'TRANSPO ALLOW. JEANE ABELLA ', '2023-06-03', 'MALOONG EXPENSES', 'Rubber Expenses', '300', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(528, '40961', 'TOTO AND ANTHONY FOOD ALLOW.', '2023-06-03', 'MALOONG EXPENSES', 'Rubber Expenses', '1000', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(529, '40962', 'TIP TO BASELCO IN MALOONG CUT-OUT', '2023-06-03', 'MALOONG EXPENSES', 'Rubber Expenses', '500', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(530, '40963', 'DINDO PENTOJO kumpay june 1, 2023', '2023-06-03', 'MALOONG EXPENSES', 'Rubber Expenses', '500', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(531, '41303', 'additional PAYMENT MOTOr presser labor menzi', '2023-06-03', 'MALOONG EXPENSES', 'Rubber Expenses', '3000', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(532, '41264', '4PERSON OT ROASTING', '2023-06-03', 'LACAFE EXPENSES', 'Coffee Expenses', '1321', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(533, '40967', 'weekly salary maloong field worker may 29- june 3', '2023-06-03', 'MALOONG EXPENSES', 'Rubber Expenses', '20656', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(534, '40966', 'salary jayson lipayo', '2023-06-03', 'MALOONG EXPENSES', 'Rubber Expenses', '1500', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(535, '50980', 'LAMITAN DOCKHANDLERS  june 1-3', '2023-06-03', 'LDC EXPENSES', 'Rubber Expenses', '1000', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(536, '50987', 'LAMITAN DOCKHANDLERS  ', '2023-06-03', 'MALOONG EXPENSES', 'Rubber Expenses', '200', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(537, '41267', 'gcash 091171231110 with charge RBN', '2023-06-03', 'RBN Expense', 'Personal Expenses', '30025', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(538, '41268', 'MALOONG CONTRACTUAL PAYROLL MILLERS', '2023-06-03', 'MALOONG EXPENSES', 'Rubber Expenses', '136199', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(539, '41192', 'lee brown wet rubber labor 5980kls@ .35', '2023-06-03', 'Pakyawan Salaries', 'Rubber Expenses', '2093', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(540, '41266', 'jbn cash', '2023-06-03', 'JBN EXPENSES', 'Personal Expenses', '580', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(541, '41266', 'LECHE PLAN', '2023-06-03', 'Other Expense', 'Personal Expenses', '450', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(542, '41266', 'G.A ALLOW.  JAMES TAN AND LEE BROWN buying', '2023-06-03', 'ALLOWANCE FOR BUYING EXPENSES', 'Rubber Expenses', '300', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(543, '41270', 'JOEBERT BALASUELA PORDIA 5DAYS @ 220 SAYUGAN HARDINERO 5/28-03/23', '2023-06-03', '  EJN SALARIES', 'Other Expenses', '1540', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(544, '41193', 'james tan wet rubber 9225kls@.35 labor', '2023-06-03', 'Pakyawan Salaries', 'Rubber Expenses', '3229', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(545, '41193', 'loading copra 531sacks @ 3 / entrada copra 506sacks @ 3', '2023-06-03', 'Pakyawan Salaries', 'Copra Expenses', '3123', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(546, '41194', 'unloading 21drums @ 10', '2023-06-03', 'LOADING/UNLOADING EXPENSES', 'Other Expenses', '210', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(547, '41066', '13packing lacafe @ 25', '2023-06-03', 'LACAFE EXPENSES', 'Coffee Expenses', '325', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(548, '41271', 'additional pcf zambo', '2023-06-03', 'ZAMBOANGA PCF', 'Other Expenses', '30000', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(549, '41304', 'salary for 5person brassing may 29 to june 3', '2023-06-03', 'MALOONG PLANTATION EXP.', 'Other Expenses', '9000', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(550, '41266', 'MINERAL WATER', '2023-06-03', 'Other Expense', 'Personal Expenses', '155', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(551, '41266', 'daile hair dye to JBN ', '2023-06-03', 'Other Expense', 'Personal Expenses', '500', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(552, '41266', 'EDITHA labada payment', '2023-06-03', 'Other Expense', 'Personal Expenses', '750', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(553, '41048', 'OT BERTO GALANO', '2023-06-03', 'MALOONG EXPENSES', 'Rubber Expenses', '2091.19', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(554, '41048', 'RONIE VILDAD OT', '2023-06-03', 'MALOONG EXPENSES', 'Rubber Expenses', '547.60', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(555, '41048', 'JEANNE ABELLA OT', '2023-06-03', 'MALOONG EXPENSES', 'Rubber Expenses', '2956.51', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(556, '41048', 'JOVY SAMIJON OT', '2023-06-03', 'MALOONG EXPENSES', 'Rubber Expenses', '568.75', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(557, '41048', 'JAY AR QUIMCO OT', '2023-06-03', 'MALOONG EXPENSES', 'Rubber Expenses', '1000', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(558, '41048', 'RAP RAP ABARQUEZ OT', '2023-06-03', 'MALOONG EXPENSES', 'Rubber Expenses', '675', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(559, '41048', 'JERRY GARCIA OT', '2023-06-03', 'MALOONG EXPENSES', 'Rubber Expenses', '675', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(560, '41048', 'SAMUEL RAMILANO OT', '2023-06-03', 'MALOONG EXPENSES', 'Rubber Expenses', '1687.50', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(561, '41048', 'MELVIN FERER', '2023-06-03', 'MALOONG EXPENSES', 'Rubber Expenses', '175', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(562, '41048', 'GREGORIO MATULAC OT', '2023-06-03', 'MALOONG EXPENSES', 'Rubber Expenses', '328.13', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(563, '41048', 'DINDO PENTOJO OT', '2023-06-03', 'MALOONG EXPENSES', 'Rubber Expenses', '1728.13', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(564, '41048', 'PABLO HIPULAN OT', '2023-06-03', 'MALOONG EXPENSES', 'Rubber Expenses', '1443.75', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(565, '41048', 'DENNIS CORPUZ OT', '2023-06-03', 'MALOONG EXPENSES', 'Rubber Expenses', '1462.50', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(566, '41048', 'alvin bonifacio ot', '2023-06-03', 'MALOONG EXPENSES', 'Rubber Expenses', '1200', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(567, '41048', 'ederito luang ot', '2023-06-03', 'MALOONG EXPENSES', 'Rubber Expenses', '856.25', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(568, '41048', 'JULIO aballa OT', '2023-06-03', 'MALOONG EXPENSES', 'Rubber Expenses', '1750', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(569, '41048', 'RAMIL PELIGRIN OT', '2023-06-03', 'MALOONG EXPENSES', 'Rubber Expenses', '1012.50', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(570, '41048', 'ALBERT CORNELIA OT', '2023-06-03', 'MALOONG EXPENSES', 'Rubber Expenses', '2812.50', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(571, '2734', 'PRIMEMOVER ARMAN -bales to zambo', '2023-06-05', 'FREIGHT TO LAM EXPENSES', 'Rubber Expenses', '7750', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(572, '2734', 'PRIMEMOVER ARMAN ', '2023-06-05', 'FREIGHT TO LAM EXPENSES', 'Other Expenses', '7216', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(573, '41275', 'ronie sadio 7days @ 250 may 30 to june 5, 2023', '2023-06-05', 'SAYUGAN EXPENSES', 'Other Expenses', '1750', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(574, '41272', 'MKTG. BUDGET', '2023-06-05', 'MKTG. EXPENSES', 'Personal Expenses', '3000', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(575, '41272', 'FARE TO OVAL MARKET', '2023-06-05', 'Transportation Expenses', 'Other Expenses', '40', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(576, '41272', 'andrew abella company salary', '2023-06-05', '  EJN SALARIES', 'Other Expenses', '19000', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(577, '41272', 'change of lacafe dr#17089', '2023-06-05', 'Other Expense', 'Coffee Expenses', '15', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(578, '41272', 'lokon 3kls', '2023-06-05', 'Other Expense', 'Personal Expenses', '2400', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(579, '41272', 'MKTG. BUDGET', '2023-06-05', 'MKTG. EXPENSES', 'Personal Expenses', '2500', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(580, '41272', 'FARE TO OVAL MARKET', '2023-06-05', 'Transportation Expenses', 'Other Expenses', '40', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(581, '4172', 'church/jbn', '2023-06-05', 'JBN EXPENSES', 'Personal Expenses', '5400', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(582, '41272', 'change tire T250', '2023-06-05', 'TRUCK EXPENSES', 'Other Expenses', '200', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(583, '41274', 'CIGNAL FOR MAY 2023 payment to danilo barandino', '2023-06-05', 'Other Expense', 'Personal Expenses', '1650', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(584, '41274', 'mulawin lumber for ejn bldg', '2023-06-05', 'Other Expense', 'Copra Expenses', '19000', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(585, '41274', 'buaying', '2023-06-05', 'Other Expense', 'Personal Expenses', '500', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(586, '41274', 'tip to bus driver', '2023-06-05', 'Other Expense', 'Other Expenses', '20', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(587, '41274', 'rooster feeds and pasahe', '2023-06-05', 'SAYUGAN EXPENSES', 'Other Expenses', '3895', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(588, '41305', 'loading of wet rubber 4,150kls@ .25 tata halal', '2023-06-05', 'LOADING/UNLOADING EXPENSES', 'Rubber Expenses', '1037', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(589, '41277', 'burger', '2023-06-05', 'Other Expense', 'Personal Expenses', '500', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(590, '41277', 'solicitation to villa assuncion national highschool', '2023-06-05', 'Other Expense', 'Personal Expenses', '2000', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(591, '41277', 'tamban for rat cage', '2023-06-05', 'Other Expense', 'Personal Expenses', '100', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(592, '41195', 'entrada copra 792sacks @ 5 less: 50', '2023-06-05', 'Pakyawan Salaries', 'Copra Expenses', '3910', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(593, '41067', '13pail packing lacafe @ 25 ', '2023-06-05', 'LACAFE EXPENSES', 'Coffee Expenses', '325', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(594, '41068', '12pail packing lacafe jaquelyn', '2023-06-05', 'LACAFE EXPENSES', 'Coffee Expenses', '300', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(595, '2735', 'T851 primemover copra pasahe', '2023-06-06', ' FREIGHT TO ZAMBO EXPENSES ', 'Rubber Expenses', '7016', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(596, '2735', 'T851 JOECRIS', '2023-06-06', 'FREIGHT TO LAM EXPENSES', 'Other Expenses', '6106', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(597, '41197', 'louie wet rubber 3340kls@ .35', '2023-06-06', 'Pakyawan Salaries', 'Rubber Expenses', '1169', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(598, '41069', '19pail packing lacafe ', '2023-06-06', 'LACAFE EXPENSES', 'Coffee Expenses', '475', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(599, '41285', 'retainers fee in maloong processing', '2023-06-06', 'MALOONG EXPENSES', 'Rubber Expenses', '5000', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(600, '41196', '10drums @ 20', '2023-06-06', 'LOADING/UNLOADING EXPENSES', 'Other Expenses', '200', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(601, '41196', 'loasing bales 1container', '2023-06-06', 'Pakyawan Salaries', 'Rubber Expenses', '2000', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(602, '41196', 'loading copra 500sacks@ 5 and entrada copra 396sacks @ 5 less: 50', '2023-06-06', 'Pakyawan Salaries', 'Copra Expenses', '4490', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(603, '41283', 'A4 1rim bond paper', '2023-06-06', 'Other Expense', 'Other Expenses', '250', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(604, '41284', 'cash send thru cebuana payment for steel belt', '2023-06-06', 'MALOONG EXPENSES', 'Rubber Expenses', '16160', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(605, '41283', 'reimbursement to raquel ', '2023-06-06', 'Other Expense', 'Personal Expenses', '230', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(606, '41283', 'MINERAL WATER/downey/siopao and softdrinks', '2023-06-06', 'Other Expense', 'Personal Expenses', '447', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(607, '40317', 'reimbursement meal by rbn VISIT IN MALOONG 6/3/23', '2023-06-06', 'MALOONG EXPENSES', 'Rubber Expenses', '1535', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(608, '40316', 'FREDO MORALES walis ting2x 24pcs. @ 25', '2023-06-06', 'MALOONG EXPENSES', 'Rubber Expenses', '600', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(609, '41198', 'entrada copra 24sacks @ 5', '2023-06-06', 'Pakyawan Salaries', 'Copra Expenses', '120', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(610, '41285', '1300@ 55.90 dollar exchange LULUBEL McCkay', '2023-06-06', 'DOLLAR EXCHANGES', 'Other Expenses', '72670', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(611, '41280', 'cash allow.', '2023-06-06', 'RBN Expense', 'Personal Expenses', '2000', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(612, '41280', 'allow. jbn', '2023-06-06', 'JBN EXPENSES', 'Personal Expenses', '10620', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(613, '41280', 'bday treat to Jeanne Abella lechon manok', '2023-06-06', 'Other Expense', 'Personal Expenses', '620', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(614, '41278', '7days food allow. of maleleel cero and company 6/5-11/23 @ 300', '2023-06-06', 'MALOONG PLANTATION EXP.', 'Other Expenses', '2100', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(615, '41278', 'river sand for maloong plantation used in chicken house', '2023-06-06', 'ROOASTER EXPENSES', 'Other Expenses', '2000', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(616, '41277', 'jayson lipayo food allow.', '2023-06-06', 'MALOONG EXPENSES', 'Rubber Expenses', '300', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(617, '41277', 'MKTG. BUDGET', '2023-06-06', 'MKTG. EXPENSES', 'Personal Expenses', '3500', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(618, '41277', 'FARE TO OVAL MARKET', '2023-06-06', 'Transportation Expenses', 'Personal Expenses', '40', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(619, '41286', 'MKTG. BUDGET', '2023-06-07', 'MALOONG EXPENSES', 'Personal Expenses', '3500', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(620, '41286', 'FARE TO OVAL MARKET', '2023-06-07', 'Transportation Expenses', 'Personal Expenses', '40', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(621, '41286', 'FARE TO NTC', '2023-06-07', 'Transportation Expenses', 'Other Expenses', '40', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(622, '41286', 'pig wave for lechon and ingredients', '2023-06-07', 'Other Expense', 'Personal Expenses', '8300', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(623, '4199', 'sacking copra 200sacks@5 and entrada copra 782sacks @ 5 less: 50', '2023-06-07', 'Pakyawan Salaries', 'Coffee Expenses', '4860', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(624, '41286', 'snack for copra laborer', '2023-06-07', 'Food and Snack', 'Other Expenses', '100', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(625, '41286', 'SAGING PRITO', '2023-06-07', 'Food and Snack', 'Other Expenses', '100', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(626, '41286', 'dayan pasahe for refund yesterday in philhealth', '2023-06-07', 'Transportation Expenses', 'Other Expenses', '120', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(627, '41288', 'ADDITIONAL PETTY CASH FOR ZAMBOANGA', '2023-06-07', 'ZAMBOANGA PCF', 'Other Expenses', '30000', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(628, '2736', 'PRIMEMOVER ERIC', '2023-06-07', ' FREIGHT TO ZAMBO EXPENSES ', 'Rubber Expenses', '8050', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(629, '2736', 'PRIMEMOVER ERIC', '2023-06-07', 'FREIGHT TO LAM EXPENSES', 'Other Expenses', '7216', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(630, '41289', 'melchor by rbn', '2023-06-08', 'Other Expense', 'Personal Expenses', '700', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(631, '41289', 'chicken and pork', '2023-06-08', 'MKTG. EXPENSES', 'Personal Expenses', '1200', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(632, '41289', 'gulay for bihon', '2023-06-08', 'Other Expense', 'Personal Expenses', '500', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(633, '41291', 'dollar echanges  167@ 55.25 lulubner McCkay', '2023-06-08', 'DOLLAR EXCHANGES', 'Other Expenses', '9227', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(634, '51023', 'LAMITAN DOCKHANDLERS  ', '2023-06-08', 'LDC EXPENSES', 'Other Expenses', '200', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(635, '2737', 'PRIMEMOVER ARMAN ', '2023-06-08', ' FREIGHT TO ZAMBO EXPENSES ', 'Rubber Expenses', '8050', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(636, '2737', 'PRIMEMOVER ARMAN ', '2023-06-08', 'FREIGHT TO LAM EXPENSES', 'Other Expenses', '7216', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(637, '41289', 'fare to zambo', '2023-06-08', 'Transportation Expenses', 'Other Expenses', '250', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(638, '41289', 'downey', '2023-06-08', 'Other Expense', 'Personal Expenses', '24', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(639, '41289', 'G.A OBONgen allow.in nenet loading', '2023-06-09', 'ALLOWANCE FOR BUYING EXPENSES', 'Other Expenses', '150', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(640, '41289', 'jbn to zambo', '2023-06-08', 'JBN EXPENSES', 'Personal Expenses', '15000', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(641, '41289', 'PPA/ENTRANCE FORTUNER', '2023-06-08', 'Other Expense', 'Other Expenses', '146', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(642, '41289', 'G.A 2DAYS ALLOW. NENET ', '2023-06-08', 'ALLOWANCE FOR BUYING EXPENSES', 'Other Expenses', '150', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(643, '41293', 'GLOBE TELECOM payment ejn office and berto enriquez mobile plan', '2023-06-08', 'Other Expense', 'Other Expenses', '2510', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(644, '41070', 'extra pordia to lacafe roasting', '2023-06-08', 'LACAFE EXPENSES', 'Coffee Expenses', '240', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(645, '41295', 'fortuner to zambo pasahe boat', '2023-06-08', 'Other Expense', 'Other Expenses', '3000', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(646, '41295', 'lacafe snack roasting', '2023-06-08', 'LACAFE EXPENSES', 'Coffee Expenses', '100', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(647, '41295', 'SAGING PRITO', '2023-06-08', 'Other Expense', 'Other Expenses', '100', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(648, '517508', 'TRANSFORTING FEE TO WHARF ', '2023-06-08', 'Other Expense', 'Personal Expenses', '1100', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(649, '41295', 'gulay for bihon', '2023-06-08', 'Other Expense', 'Personal Expenses', '50', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(650, '41295', 'cash allow.', '2023-06-08', 'RBN Expense', 'Personal Expenses', '1000', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(651, '41200', 'sacking copra 75sacks @ 3 / entrada copra 741sacks@ 5 less: 50', '2023-06-08', 'Pakyawan Salaries', 'Copra Expenses', '4005', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(652, '2740', 'elf van rico to zambo', '2023-06-09', ' FREIGHT TO ZAMBO EXPENSES ', 'Rubber Expenses', '3591', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(653, '2740', 'elf van rico', '2023-06-09', 'FREIGHT TO LAM EXPENSES', 'Other Expenses', '3591', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(654, '2739', 'primemover arnel', '2023-06-09', ' FREIGHT TO ZAMBO EXPENSES ', 'Rubber Expenses', '8050', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(655, '2739', 'primemover arnel', '2023-06-09', 'FREIGHT TO LAM EXPENSES', 'Other Expenses', '7216', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(656, '2738', 'PRIMEMOVER ERIC', '2023-06-09', ' FREIGHT TO ZAMBO EXPENSES ', 'Rubber Expenses', '8050', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(657, '2738', 'PRIMEMOVER ERIC', '2023-06-09', 'FREIGHT TO LAM EXPENSES', 'Other Expenses', '7216', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(658, '41501', '5drums @ 20 diesel loading/unloading', '2023-06-09', 'LOADING/UNLOADING EXPENSES', 'Other Expenses', '100', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(659, '41501', 'entrada copra 525sacks @ 5', '2023-06-09', 'Pakyawan Salaries', 'Copra Expenses', '2625', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(660, '41072', '16pail packing lacafe @ 25', '2023-06-09', 'LACAFE EXPENSES', 'Coffee Expenses', '400', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(661, '41071', '15pail packig lacafe amor', '2023-06-09', 'LACAFE EXPENSES', 'Coffee Expenses', '375', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(662, '41297', 'lasna', '2023-06-09', 'Other Expense', 'Personal Expenses', '300', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(663, '41297', 'change of lacafe dr#36207', '2023-06-09', 'Other Expense', 'Coffee Expenses', '55', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(664, '41297', 'MKTG. BUDGET ', '2023-06-09', 'MKTG. EXPENSES', 'Personal Expenses', '3000', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(665, '41297', 'pusit/siopao/softdrinks/pizza by rbn', '2023-06-09', 'Other Expense', 'Personal Expenses', '1645', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(666, '41299', 'consideration pay JOHN GREGORIO ', '2023-06-09', 'MALOONG EXPENSES', 'Rubber Expenses', '25000', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(667, '48467', 'gasul for kitchen', '2023-06-09', 'Other Expense', 'Personal Expenses', '1180', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(668, '41351', 'RICO AND SIMEON TRAVEL ALLOW. GOING TO IPIL BALUGAY SHOP', '2023-06-09', 'ALLOWANCE FOR BUYING EXPENSES', 'Other Expenses', '2500', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(669, '41297', 'cash allow.', '2023-06-09', 'RBN Expense', 'Personal Expenses', '500', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(670, '41297', 'DR#36206 COFFEE CHANGE', '2023-06-09', 'LACAFE EXPENSES', 'Coffee Expenses', '5', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(671, '41297', 'LABOR CONNECT CCTV bodega ', '2023-06-09', 'Other Expense', 'Personal Expenses', '2000', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(672, '41296', 'light consumption in maloong construction', '2023-06-09', 'MALOONG EXPENSES', 'Rubber Expenses', '125', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(673, '41292', 'water consumption ejn ', '2023-06-09', 'Water', 'Other Expenses', '5730', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(674, '41352', '4PERSON OT ROASTING', '2023-06-09', 'LACAFE EXPENSES', 'Coffee Expenses', '1321', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(675, '41311', 'brassing plantation  6/8-10/23 5person @ 6days @ 300', '2023-06-10', 'MALOONG PLANTATION EXP.', 'Other Expenses', '9000', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(676, '2741', 'T851 JOECRIS', '2023-06-10', ' FREIGHT TO ZAMBO EXPENSES ', 'Rubber Expenses', '6866', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(677, '2741', 'T851 JOECRIS', '2023-06-10', 'FREIGHT TO LAM EXPENSES', 'Other Expenses', '6106', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(678, '41354', 'ADDITIONAL PETTY CASH FOR ZAMBOANGA', '2023-06-10', 'ZAMBOANGA PCF', 'Other Expenses', '30000', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(679, '51042', 'ROYALTY FEEFOR 2 TRIALER 6/10-8/23', '2023-06-10', 'LDC EXPENSES', 'Other Expenses', '400', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(680, '40978', 'jayson lipayo salary JUNE 5 to 10, 2023 ', '2023-06-10', 'MALOONG EXPENSES', 'Rubber Expenses', '1500', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(681, '40970', 'TOTOH AND ANTHONBY CASTIL', '2023-06-10', 'MALOONG EXPENSES', 'Rubber Expenses', '1000', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(682, '40971', 'LABOR BRING CARABAO  TO PLANTATION', '2023-06-10', 'MALOONG EXPENSES', 'Rubber Expenses', '500', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(683, '40975', 'TOTOH CASTIL SUMMARY OF OR 6/5-09/23', '2023-06-10', 'MALOONG EXPENSES', 'Rubber Expenses', '3750', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(684, '40976', 'ANTHONY CASTIL OT 6/5-9/23', '2023-06-10', 'MALOONG EXPENSES', 'Rubber Expenses', '3000', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(685, '40969', 'jeanne abella transpo allow.6/12-18/23', '2023-06-10', 'MALOONG EXPENSES', 'Rubber Expenses', '300', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(686, '40979', 'MALOONG FIELD WORKER WEEKLY SALARY ', '2023-06-10', 'MALOONG EXPENSES', 'Rubber Expenses', '20000', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(687, '40977', 'PAYMENT TO JIMROR STORE MEALS AND SNACK  FOR MILLER/FIELD/REGULAR EMPLOYEE', '2023-06-10', 'MALOONG EXPENSES', 'Rubber Expenses', '3462', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(688, '41074', '19PAIL PACKING LACAFE @ 25', '2023-06-10', 'LACAFE EXPENSES', 'Coffee Expenses', '475', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(689, '41073', '16pail packing lacafe @ 25', '2023-06-10', 'LACAFE EXPENSES', 'Coffee Expenses', '400', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(690, '41357', 'JOEBERT BALASUELA PORDIA 5DAYS @ 220 SAYUGAN HARDINERO', '2023-06-10', '  EJN SALARIES', 'Other Expenses', '1540', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(691, '41355', 'RBN CASH TO ZAMBO', '2023-06-10', 'RBN Expense', 'Personal Expenses', '25000', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(692, '41355', 'MINERAL WATER ', '2023-06-10', 'Other Expense', 'Personal Expenses', '155', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(693, '41355', 'ROGER SSS FOR 2MONTHS EJN SHARE MAY-JUNE', '2023-06-10', 'SSS', 'Other Expenses', '1050', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(694, '41355', 'SOP BASURA', '2023-06-10', 'Other Expense', 'Personal Expenses', '400', NULL, '', NULL, 'Cash', NULL, 'Basilan');
INSERT INTO `ledger_expenses` (`id`, `voucher_no`, `particulars`, `date`, `category`, `type_expense`, `amount`, `description`, `remarks`, `destination`, `mode_transact`, `date_payment`, `location`) VALUES
(695, '41355', 'BANGKA FOR MALOONG PLATATION', '2023-06-10', 'MALOONG PLANTATION EXP.', 'Personal Expenses', '3000', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(696, '41502', 'JOEL AMAHAN WET RUBBER LABOR 1904KLS@ .29 LESS: 50', '2023-06-10', 'Pakyawan Salaries', 'Rubber Expenses', '502.16', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(697, '41502', 'LOADING/UNLOADING WET RUBBER 1920KLS@ .16', '2023-06-10', 'Pakyawan Salaries', 'Rubber Expenses', '307', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(698, '41502', 'ENTRADA COPRA 806SACKS @ 5', '2023-06-10', 'Pakyawan Salaries', 'Copra Expenses', '4030', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(699, '41352', 'LABADA EDITHA ', '2023-06-10', 'Other Expense', 'Personal Expenses', '750', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(700, '41352', 'ERVIN STORE PAYMENT RBN ', '2023-06-10', 'RBN Expense', 'Personal Expenses', '488', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(701, '41352', 'SATTI', '2023-06-10', 'RBN Expense', 'Personal Expenses', '1000', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(702, '41352', 'OT of gigi', '2023-06-10', 'Other Expense', 'Coffee Expenses', '300', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(703, '41352', 'MKTG. BUDGET', '2023-06-10', 'MKTG. EXPENSES', 'Personal Expenses', '3000', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(704, '41352', 'FARE TO OVAL MARKET', '2023-06-10', 'Transportation Expenses', 'Personal Expenses', '40', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(705, '40981', 'BERTO GALANO OT', '2023-06-10', 'MALOONG EXPENSES', 'Rubber Expenses', '2019.08', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(706, '40981', 'RONIE VILDAD OT', '2023-06-10', 'MALOONG EXPENSES', 'Rubber Expenses', '711.88', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(707, '40981', 'JEANNE ABELLA OT', '2023-06-10', 'MALOONG EXPENSES', 'Rubber Expenses', '2920.46', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(708, '40981', 'JOVY SAMIJON OT', '2023-06-10', 'MALOONG EXPENSES', 'Rubber Expenses', '656.25', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(709, '40981', 'JAY AR QUIMCO OT', '2023-06-10', 'MALOONG EXPENSES', 'Rubber Expenses', '1203.13', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(710, '40981', 'RAP RAP ABARQUEZ OT', '2023-06-10', 'MALOONG EXPENSES', 'Rubber Expenses', '356.25', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(711, '40981', 'JERRY GARCIA OT', '2023-06-10', 'MALOONG EXPENSES', 'Rubber Expenses', '581.25', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(712, '40981', 'SAMUEL RAMILANO OT', '2023-06-10', 'MALOONG EXPENSES', 'Rubber Expenses', '2156.25', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(713, '40981', 'GREGORIO MATULAC OT', '2023-06-10', 'MALOONG EXPENSES', 'Rubber Expenses', '306.25', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(714, '40981', 'DINDO PENTOJO OT', '2023-06-10', 'MALOONG EXPENSES', 'Rubber Expenses', '2012.50', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(715, '40981', 'PABLO HIPULAN OT', '2023-06-10', 'MALOONG EXPENSES', 'Rubber Expenses', '2012.50', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(716, '40981', 'DENNIS CORPUZ OT', '2023-06-10', 'MALOONG EXPENSES', 'Rubber Expenses', '1818.75', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(717, '40981', 'alvin bonifacio ot', '2023-06-10', 'SALARIES EXPENSES', 'Rubber Expenses', '1725', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(718, '40981', 'ederito luang ot', '2023-06-10', 'MALOONG EXPENSES', 'Rubber Expenses', '393.75', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(719, '40981', 'JULIO aballa OT', '2023-06-10', 'MALOONG EXPENSES', 'Rubber Expenses', '1775', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(720, '40981', 'RAMIL PELIGRIN OT', '2023-06-10', 'MALOONG EXPENSES', 'Rubber Expenses', '975', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(721, '40981', 'ALBERT CORNELIA OT', '2023-06-10', 'MALOONG EXPENSES', 'Rubber Expenses', '2703.13', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(722, '41362', 'FOOD ALLOW.FOR MALELEEL CERO 6/12-18,2023', '2023-06-12', 'MALOONG EXPENSES', 'Rubber Expenses', '2100', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(723, '41363', 'FOOD ALLOW.AND LOAD FROM JUNE 5-17', '2023-06-12', 'Pakyawan Salaries', 'Personal Expenses', '1308', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(724, '41360', 'LOADING BALES 300 BALES', '2023-06-12', 'Pakyawan Salaries', 'Rubber Expenses', '1000', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(725, '40320', 'SNACK AND MEAL AND SOFTDRINKS LUNCE STA CLARA JEANNE AND COMPNY', '2023-06-12', 'MALOONG EXPENSES', 'Rubber Expenses', '1930', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(726, '0005', 'MOTOR BEARING  OIL ORIGINAL GREASE/ LABOR', '2023-06-12', 'Other Expense', 'Personal Expenses', '560', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(727, '41366', '7DAYS @ 250 RONIE SADIO LESS : 500', '2023-06-12', '  EJN SALARIES', 'Other Expenses', '1250', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(728, '40319', 'AMANTE LOAD WIFI MALOONG', '2023-06-12', 'MALOONG EXPENSES', 'Rubber Expenses', '1200', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(729, '41361', 'MKTG. BUDGET', '2023-06-12', 'MKTG. EXPENSES', 'Personal Expenses', '2500', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(730, '41361', 'FARE TO OVAL MARKET', '2023-06-12', 'Transportation Expenses', 'Other Expenses', '40', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(731, '41361', 'FEEDS FOR ROASTER W/FARE', '2023-06-12', 'ROOASTER EXPENSES', 'Other Expenses', '3966', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(732, '41361', 'rico sunday in ipil', '2023-06-12', '  EJN SALARIES', 'Other Expenses', '380', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(733, '41361', 'RAQUEL BAIS FROM june 1-15, 2023 ', '2023-06-12', 'BIR EXPENSES', 'Other Expenses', '2500', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(734, '41361', 'FARE TO NTC', '2023-06-12', 'Transportation Expenses', 'Other Expenses', '40', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(735, '41361', 'sunday of G. A', '2023-06-12', '  EJN SALARIES', 'Other Expenses', '415', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(736, '41361', 'ALLOW. IN WET BUYING SUMISIP', '2023-06-12', 'ALLOWANCE FOR BUYING EXPENSES', 'Other Expenses', '150', NULL, '', NULL, 'Cash', NULL, 'Basilan'),
(737, '41503', 'CAMADA COPRA 50SACKS @ 5 / SACKING COPRA 250SACKS @ 5/ENTRADA COPRA 462@ 5', '2023-06-12', 'Pakyawan Salaries', 'Copra Expenses', '3810', NULL, '', NULL, 'Cash', NULL, 'Basilan');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(49, '2023-04-29', '2893', '154', 'jerome a.', '', '0', '10', '1540', 'Cash Advance', '500', '1040'),
(50, '2023-05-09', '40937', '473', 'JBN share maloong wet', '10', '4730', '', '0', '', '', '0'),
(51, '2023-05-15', '39872', '719', 'JBN share maloong toppers', '10', '7190', '', '0', '', '', '0'),
(52, '2023-05-15', '2954', '222', 'jerome', '10', '2220', '10', '2220', 'Cash Advance', '680', '1540'),
(53, '2023-05-15', '2953', '170', 'mayeto', '10', '1700', '10', '1700', 'SSS', '280', '1420'),
(54, '2023-05-15', '2952', '47', 'guilbert', '10', '470', '10', '470', '', '', '470'),
(55, '2023-05-15', '29951', '137', 'renato', '10', '1370', '10', '1370', 'Cash Advance', '1000', '370'),
(56, '2023-05-15', '2955', '143', 'oscar', '10', '1430', '10', '1430', 'Cash Advance', '1300', '130'),
(57, '2023-05-31', '2959', '146', 'OSCAR', '10', '1460', '10', '1460', 'Cash Advance', '1000', '460'),
(58, '2023-05-31', '2958', '294', 'JEROME', '10', '2940', '10', '2940', 'Cash Advance', '500', '2440'),
(59, '2023-05-31', '2960', '118', 'MAYETO', '10', '1180', '10', '1180', '', '', '1180'),
(60, '2023-05-31', '2956', '84', 'RENATO', '10', '840', '10', '840', '', '', '840'),
(61, '2023-05-31', '2957', '170', 'GUILBERT', '10', '1700', '10', '1700', 'Cash Advance', '1000', '700'),
(62, '2023-06-01', '41235', '812', 'JBN share in maloong processing', '10', '8120', '', '0', '', '', '0');

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
  `category` varchar(50) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ledger_purchase`
--

INSERT INTO `ledger_purchase` (`id`, `date`, `voucher`, `customer_name`, `net_kilos`, `price`, `adjustment_price`, `less`, `partial_payment`, `net_total`, `total_amount`, `category`, `location`) VALUES
(23, '2023-01-02', '\'00180', 'ismael', '360', '19', '', '', '', '', '6840', 'COPRA', NULL),
(24, '2023-01-03', '91553', 'AMIN ABUBAKAR', '3219', '31', '', '', '', '', '99789', 'COPRA', NULL),
(25, '2023-01-02', '35122', 'MALOONG PLANTATION JR CATALLA', '32852', '28', '', '', '500000', '0', '419856', 'WET RUBBER', NULL),
(26, '2023-01-04', '91560', 'CHARLY CAWLEY', '1111', '44', '', '', '', '0', '48884', 'BALES', NULL),
(28, '2023-01-04', '91559', 'ABDUL', '610', '29', '', '', '', '0', '17690', 'COPRA', NULL),
(29, '2023-01-04', '91558', 'KOTOH', '3679', '29.5', '', '', '', '0', '108530.5', 'COPRA', NULL),
(30, '2023-01-04', '91557', 'JULMA', '3868', '29.50', '', '', '', '0', '114106', 'COPRA', NULL),
(31, '2023-01-03', '35124', 'TUWA', '7980', '47', '', '180029', '', '0', '195031', 'BALES', NULL),
(32, '2023-01-05', '91566', 'NORUDDIN', '3388', '29', '', '', '', '0', '98252', 'COPRA', NULL),
(33, '2023-01-05', '153105', 'TOTONG', '119', '21', '', '', '', '0', '2499', 'WET RUBBER', NULL),
(34, '2023-01-05', '91561', 'JULMA', '3244', '29.50', '', '', '', '0', '95698', 'COPRA', NULL),
(35, '2023-01-05', '91562', 'ABDUL', '2153', '29.50', '', '', '', '0', '63513.5', 'COPRA', NULL),
(36, '2023-01-05', ' \'0183', 'alih', '165', '19', '', '', '', '0', '3135', 'COPRA', NULL),
(37, '2023-01-05', '91565', 'louie delos reyes', '3698', '46', '', '102390', '', '0', '67718', 'BALES', NULL),
(38, '2023-01-04', '91560', 'charly cawley', '4489', '46', '', '', '', '0', '206494', 'BALES', NULL),
(40, '2023-01-02', '35123', 'NENET', '', '', '', '', '', '', '6014', 'BALES', NULL),
(41, '2023-01-03', '00183', 'jong', '102', '19', '', '', '', '0', '1938', 'COPRA', NULL),
(43, '2023-01-06', '35126', 'JUN mCcLINTOCK', '5240', '46', '', '241332', '', '0', '-292', 'BALES', NULL),
(44, '2023-01-06', '91569', 'JIMROY mCcLINTOCK', '3564', '46', '', '100000', '', '0', '63944', 'BALES', NULL),
(46, '2023-01-06', '91567', 'hari sabtal', '10587', '50', '', '517320', '', '0', '12030', 'BALES', NULL),
(47, '2023-01-07', '91573', 'NONONG FURIGAY', '4515', '30', '', '', '', '0', '135450', 'WET RUBBER', NULL),
(48, '2023-01-07', '91570', 'AMIN ABUBAKAR', '3899', '31', '', '', '', '0', '120869', 'COPRA', NULL),
(49, '2023-01-07', '00194', 'LIGIT', '75', '18', '', '', '', '0', '1350', 'COPRA', NULL),
(50, '2023-01-07', '91575', 'SANDRA DUMDUM', '5435', '25', '', '', '', '0', '135875', 'WET RUBBER', NULL),
(51, '2023-01-09', '91580', 'EPIGIL MOLEJE', '1684', '46', '', '50000', '', '0', '27464', 'BALES', NULL),
(52, '2023-01-09', '153106', 'TOY', '100', '21', '', '', '', '0', '2100', 'WET RUBBER', NULL),
(53, '2023-01-09', '91576', 'salwa', '266', '27', '', '', '', '0', '7182', 'COPRA', NULL),
(54, '2023-01-09', '91577', 'julman', '1603', '29.50', '', '', '', '0', '47288.5', 'COPRA', NULL),
(55, '2023-01-09', '91579', 'amin', '3098', '31', '', '', '', '0', '96038', 'COPRA', NULL),
(56, '2023-01-09', '153106', 'toy', '100', '21', '', '', '', '0', '2100', 'WET RUBBER', NULL),
(57, '2023-01-09', '91580', 'MOLEJE', '1684', '46', '', '50000', '', '0', '27464', 'BALES', NULL),
(58, '2023-01-09', '195', 'ADELAYDA', '76', '20', '', '', '', '0', '1520', 'COPRA', NULL),
(59, '2023-01-09', '91581', 'ADAM', '508', '29', '', '', '', '0', '14732', 'COPRA', NULL),
(60, '2023-01-09', '39600', 'RONIE VILDAD', '3088', '23', '', '', '', '0', '71024', 'WET RUBBER', NULL),
(61, '2023-01-10', '91585', 'tuna', '1444', '29.50', '', '', '', '0', '42598', 'COPRA', NULL),
(62, '2023-01-10', '91584', 'amin', '2420', '31', '', '', '', '0', '75020', 'COPRA', NULL),
(63, '2023-01-10', '91587', 'rodel', '1180', '19', '', '', '', '0', '22420', 'COPRA', NULL),
(64, '2023-01-10', '91582', 'louie delos reyes', '4104', '46', '', '102460', '', '0', '86324', 'BALES', NULL),
(66, '2023-01-10', '91586', 'tany sulayman', '12286', '50', '', '600730', '', '0', '13570', 'BALES', NULL),
(67, '2023-01-12', '35277', 'tany sulayman', '', '', '', '', '', '', '149109.63', 'WET RUBBER', NULL),
(68, '2023-01-12', '91589', 'amin abubakar', '920', '22.50', '', '', '', '0', '20700', 'WET RUBBER', NULL),
(69, '2023-01-13', '91603', 'TON2X', '370', '20', '', '', '', '0', '7400', 'COPRA', NULL),
(70, '2023-01-13', '91602', 'KABAYAN', '160', '19', '', '', '', '0', '3040', 'COPRA', NULL),
(71, '2023-01-13', '91602', 'KABAYAN', '409', '19', '', '', '', '0', '7771', 'COPRA', NULL),
(72, '2023-01-13', '91601', 'MORADOS', '789', '20', '', '5000', '', '0', '10780', 'COPRA', NULL),
(73, '2023-01-14', '91596', 'Jimroy McLINTOCK', '3491', '44', '', '130000', '', '0', '23604', 'BALES', NULL),
(74, '2023-01-14', '35136', 'MANCOM ERVIN SHARE', '2039', '21', '', '17128', '', '0', '25691', 'WET RUBBER', NULL),
(75, '2023-01-14', '35136', 'MANCOM JBN SHARE', '2039', '21', '', '25691', '', '0', '17128', 'WET RUBBER', NULL),
(76, '2023-01-14', '91605', 'ADAM', '1872', '29', '', '', '', '0', '54288', 'COPRA', NULL),
(77, '2023-01-14', '91604', 'AMIN', '1679', '31', '', '', '', '0', '52049', 'COPRA', NULL),
(78, '2023-01-14', '91592', 'CHARLY CAWLEY', '4270', '48', '', '130000', '', '0', '74960', 'BALES', NULL),
(79, '2023-01-16', '91598', 'TANY SULAYMAN', '', '', '', '', '', '', '54810', 'BALES', NULL),
(80, '2023-01-16', '153110', 'morados', '357', '22', '', '', '', '0', '7854', 'WET RUBBER', NULL),
(81, '2023-01-16', '35144', 'nenet', '', '', '', '', '', '', '74154', 'BALES', NULL),
(82, '2023-01-16', '91608', 'amin abubakar', '3219', '31', '', '', '', '0', '99789', 'COPRA', NULL),
(83, '2023-01-16', '91608', 'amin abubakar', '3219', '31', '', '', '', '0', '99789', 'COPRA', NULL),
(84, '2023-01-16', '91607', 'J.R', '285', '19', '', '', '', '0', '5415', 'COPRA', NULL),
(85, '2023-01-16', '91606', 'JULMAN', '3011', '27', '', '', '', '0', '81297', 'COPRA', NULL),
(86, '2023-01-16', '153107', 'PAMARAN', '1121', '24', '', '10000', '', '0', '16904', 'COPRA', NULL),
(87, '2023-01-16', '153108', 'PAMARAN', '578', '24', '', '', '', '0', '13872', 'WET RUBBER', NULL),
(88, '2023-01-16', '153109', 'PAMARAN', '214', '24', '', '', '', '0', '5136', 'WET RUBBER', NULL),
(90, '2023-01-17', '91610', 'sarip', '1527', '27', '', '', '', '0', '41229', 'COPRA', NULL),
(91, '2023-01-17', '35320', 'MARTIN MUSLIMIN', '', '', '', '', '', '', '39935..25', 'BALES', NULL),
(92, '2023-01-18', '153111', 'sopiya', '2', '90', '', '', '', '0', '180', 'COFFEE BEANS', NULL),
(93, '2023-01-18', '91600', 'charly cawley', '5390', '48', '', '', '', '0', '258720', 'BALES', NULL),
(94, '2023-01-18', '91612', 'julman', '2582', '27', '', '', '', '0', '69714', 'COPRA', NULL),
(95, '2023-01-18', '91611', 'ton2x', '460', '20', '', '', '', '0', '9200', 'COPRA', NULL),
(96, '2023-01-17', '0005', 'RASMA', '215', '18', '', '', '', '0', '3870', 'COPRA', NULL),
(97, '2023-01-17', '91597', 'MOLEJE', '3618', '46', '', '120000', '', '0', '46428', 'BALES', NULL),
(98, '2023-01-17', '35321', 'TANNY SULAYMAN', '', '', '', '', '', '', '79018', 'BALES', NULL),
(99, '2023-01-17', '91609', 'KABAYAN', '57', '19', '', '', '', '0', '1083', 'COPRA', NULL),
(100, '2023-01-17', '35319', 'AMMAN AWALIN', '', '', '', '', '', '', '11767', 'BALES', NULL),
(101, '2023-01-17', '0006', 'APAH', '50', '18', '', '', '', '0', '900', 'COPRA', NULL),
(102, '2023-01-19', '91623', 'RUBEN RAMOS', '3747', '44', '', '130000', '', '0', '34868', 'BALES', NULL),
(103, '2023-01-19', '91618', 'MATURAN', '612', '27', '', '', '', '0', '16524', 'COPRA', NULL),
(104, '2023-01-19', '91616', 'NONONG FURIGAY', '4315', '30', '', '', '', '0', '129450', 'WET RUBBER', NULL),
(105, '2023-01-12', '91621', 'HARIE', '569', '27', '', '', '', '0', '15363', 'COPRA', NULL),
(106, '2023-01-19', '91617', 'AMDARI', '3018', '27', '', '', '', '0', '81486', 'COPRA', NULL),
(107, '2023-01-19', '91615', 'ADAM', '1592', '27', '', '', '', '0', '42984', 'COPRA', NULL),
(108, '2023-01-19', '91619', 'ALDASER', '889', '27', '', '', '', '0', '24003', 'COPRA', NULL),
(109, '2023-01-19', '91614', 'AMIN', '2522', '31', '', '25000', '', '0', '53182', 'COPRA', NULL),
(110, '2023-01-19', '91622', 'AMIN', '1852', '31', '', '', '', '0', '57412', 'COPRA', NULL),
(111, '2023-01-20', '91625', 'TUNA', '1095', '29.50', '', '', '', '0', '32302.5', 'COPRA', NULL),
(112, '2023-01-21', '91632', 'jimroy McClintock', '4031', '44', '', '100000', '', '0', '77364', 'BALES', NULL),
(113, '2023-01-21', '0005', 'cash', '155', '18', '', '', '', '0', '2790', 'COPRA', NULL),
(114, '2023-01-21', '91629', 'harie', '371', '27', '', '', '', '0', '10017', 'COPRA', NULL),
(115, '2023-01-21', '91628', 'julman', '2043', '27', '', '', '', '0', '55161', 'COPRA', NULL),
(116, '2023-01-21', '91633', 'FRANCINE', '544', '22', '', '', '', '0', '11968', 'WET RUBBER', NULL),
(117, '2023-01-21', '35551', 'DONGA TENANT SHARE', '3753', '22', '', '38783', '', '0', '43783', 'WET RUBBER', NULL),
(118, '2023-01-21', '229', 'tutuh', '85', '18', '', '', '', '0', '1530', 'COPRA', NULL),
(119, '2023-01-23', '91635', 'amin', '3450', '31', '', '25000', '', '0', '81950', 'COPRA', NULL),
(120, '2023-01-23', '235', 'kabayan', '86', '18', '', '', '', '0', '1548', 'COPRA', NULL),
(121, '2023-01-23', '91636', 'ton2x', '525', '19', '', '', '', '0', '9975', 'COPRA', NULL),
(122, '2023-01-23', '237', 'ibrahim', '300', '19', '', '', '', '0', '5700', 'COPRA', NULL),
(123, '2023-01-23', '91637', 'arsenio', '480', '19', '', '', '', '0', '9120', 'COPRA', NULL),
(124, '2023-01-23', '233', 'arsenio', '1133', '27', '', '', '', '0', '30591', 'COPRA', NULL),
(125, '2023-01-23', '35605', 'tany sulayman', '', '', '', '', '', '', '135408', 'BALES', NULL),
(126, '2023-01-23', '91640', 'cawley', '1255', '27', '', '', '', '0', '33885', 'COPRA', NULL),
(127, '2023-01-24', '91638', 'LOUIE DELOS REYES', '2916', '46', '', '101778', '', '0', '32358', 'BALES', NULL),
(128, '2023-01-24', '35614', 'HARIE SABTAL', '', '', '', '', '', '', '18020', 'BALES', NULL),
(129, '2023-01-24', '35612', 'TANY SULAYMAN', '', '', '', '', '', '', '47170', 'BALES', NULL),
(130, '2023-01-24', '91647', 'epigil moleje', '5860', '46', '', '100000', '', '0', '169560', 'BALES', NULL),
(131, '2023-01-24', '91646', 'adam', '3094', '27', '', '50000', '', '0', '33538', 'COPRA', NULL),
(132, '2023-01-24', '91644', 'amin abubakar', '1070', '22.50', '', '', '', '0', '24075', 'WET RUBBER', NULL),
(134, '2023-01-24', '91642', 'ibrahim', '855', '19', '', '', '', '0', '16245', 'COPRA', NULL),
(135, '2023-01-24', '35611', 'amman awalin', '', '', '', '', '', '', '16592', 'BALES', NULL),
(136, '2023-01-25', '91660', 'ADAM', '623', '27', '', '', '', '0', '16821', 'COPRA', NULL),
(137, '2023-01-25', '91658', 'JULMAN', '3169', '27', '', '', '', '0', '85563', 'COPRA', NULL),
(138, '2023-01-25', '91659', 'CHARLY CAWLEY', '5810', '48', '', '', '', '0', '278880', 'BALES', NULL),
(139, '2023-01-25', '35654', 'AMMAN AWALIN', '', '', '', '', '', '', '150942', 'BALES', NULL),
(140, '2023-01-25', '35620', 'MARTIN MUSLIMIN', '', '', '', '', '', '', '97613', 'BALES', NULL),
(141, '2023-01-25', '91649', 'IBRAHIM', '1064', '27', '', '', '', '0', '28728', 'COPRA', NULL),
(142, '2023-01-26', '91650', 'SULAYMAN TANI', '9936', '30.30', '', '203011', '', '0', '98049.79999999999', 'COPRA', NULL),
(143, '2023-01-26', '91806', 'ibrahim', '770', '18', '', '', '', '0', '13860', 'COPRA', NULL),
(144, '2023-01-26', '91807', 'ibrahim', '865', '18', '', '', '', '0', '15570', 'COPRA', NULL),
(145, '2023-01-27', '91811', 'JULMAN', '1532', '26', '', '', '', '0', '39832', 'COPRA', NULL),
(146, '2023-01-27', '91808', 'LITO PURI', '3366', '48', '', '', '', '0', '161568', 'BALES', NULL),
(147, '2023-01-27', '260', 'IBRAHIM', '1575', '18', '', '', '', '0', '28350', 'COPRA', NULL),
(148, '2023-01-27', '153115', 'aloy', '477', '22', '', '', '', '0', '10494', 'WET RUBBER', NULL),
(149, '2023-01-27', '153114', 'hassan', '157', '22', '', '', '', '0', '3454', 'WET RUBBER', NULL),
(150, '2023-01-27', '153113', 'hamid', '118', '22', '', '', '', '0', '2596', 'WET RUBBER', NULL),
(151, '2023-01-27', '153112', 'totong', '460', '22', '', '', '', '0', '10120', 'WET RUBBER', NULL),
(152, '2023-01-27', '91810', 'mila quidilia', '2529', '25', '', '15000', '', '0', '48225', 'COPRA', NULL),
(154, '2023-01-27', '35630', 'sulayman tani', '13633', '30.30', '', '213079.9', '', '0', '200000.00000000003', 'COPRA', NULL),
(155, '2023-01-27', '257', 'sopyan', '76', '17', '', '', '', '0', '1292', 'COPRA', NULL),
(156, '2023-01-27', '35631', 'abella', '80', '17', '', '', '', '0', '1360', 'COPRA', NULL),
(157, '2023-01-28', '35634', 'ISMAEL', '280', '16', '', '', '', '0', '4480', 'COPRA', NULL),
(158, '2023-01-28', '35633', 'IBRAHIM', '610', '16', '', '', '', '0', '9760', 'COPRA', NULL),
(160, '2023-01-30', '272', 'roger', '45', '18', '', '', '', '0', '810', 'COPRA', NULL),
(161, '2023-01-30', '91816', 'AMIN', '9090', '31', '', '50000', '', '0', '231790', 'COPRA', NULL),
(162, '2023-01-30', '262', 'CASH', '59', '17', '', '', '', '0', '1003', 'COPRA', NULL),
(163, '2023-01-30', '91651', 'SULAYMAN TANY', '13633', '30.30', '', '254131', '', '0', '158948.90000000002', 'COPRA', NULL),
(164, '2023-01-30', '91815', 'AREVALO', '2551', '26', '', '', '', '0', '66326', 'WET RUBBER', NULL),
(165, '2023-01-30', '91814', 'RONIE VILDAD', '', '', '', '', '', '', '12696', 'BALES', NULL),
(166, '2023-01-30', '91817', 'ADAM', '3190', '27.50', '', '', '', '0', '87725', 'COPRA', NULL),
(167, '2023-01-30', '91819', 'IBRAHIM', '1408', '27', '', '', '', '0', '38016', 'COPRA', NULL),
(168, '2023-01-30', '91820', 'TON2X', '427', '18', '', '', '', '0', '7686', 'COPRA', NULL),
(169, '2023-01-31', '91824', 'JImroy McClintock', '3228', '45', '', '100000', '', '0', '45260', 'BALES', NULL),
(170, '2023-01-31', '153127', 'manis', '195', '23', '', '', '', '0', '4485', 'WET RUBBER', NULL),
(171, '2023-01-31', '91823', 'CAWLEY', '1307', '27', '', '', '', '0', '35289', 'COPRA', NULL),
(172, '2023-01-31', '35566', 'MANCOM ERVIN MAGNAYE TOPPERS SHARE', '1756', '21', '', '14751', '', '0', '22125', 'WET RUBBER', NULL),
(173, '2023-01-31', '35566', 'MANCOM EJN SHARE', '1756', '21', '', '22125', '', '0', '14751', 'WET RUBBER', NULL),
(174, '2023-01-31', '153123', 'MENDIJA', '147', '21', '', '', '', '0', '3087', 'WET RUBBER', NULL),
(175, '2023-01-31', '91822', 'IBRAHIM', '592', '27', '', '', '', '0', '15984', 'COPRA', NULL),
(176, '2023-01-31', '153124', 'PAMARAN', '1076', '25', '', '10000', '', '0', '16900', 'WET RUBBER', NULL),
(177, '2023-01-31', '153125', 'PAMARAN', '644', '25', '', '', '', '0', '16100', 'WET RUBBER', NULL),
(178, '2023-01-31', '153126', 'PAMARAN', '236', '25', '', '', '', '0', '5900', 'WET RUBBER', NULL),
(179, '2023-01-31', '153122', 'RENS', '1058', '23', '', '', '', '0', '24334', 'WET RUBBER', NULL),
(180, '2023-02-01', '35718', 'zaldy', '165', '18', '', '', '', '0', '2970', 'COPRA', NULL),
(181, '2023-02-01', '35717', 'musam', '210', '18', '', '', '', '0', '3780', 'COPRA', NULL),
(182, '2023-02-01', '91826', 'lee vbrown', '11372', '24', '', '200000', '', '0', '72928', 'BALES', NULL),
(183, '2023-02-01', '91828', 'charly cawley', '5180', '48', '', '', '', '0', '248640', 'BALES', NULL),
(184, '2023-02-01', '91829', 'nonong furigay', '3850', '31', '', '', '', '0', '119350', 'WET RUBBER', NULL),
(185, '2023-02-01', '153128', 'HAIRE', '105', '22', '', '', '', '0', '2310', 'WET RUBBER', NULL),
(186, '2023-02-02', '91832', 'amin', '5987', '28', '', '50000', '', '0', '117636', 'COPRA', NULL),
(187, '2023-02-02', '00045', 'joel amahan', '2225', '24', '', '', '', '0', '53400', 'WET RUBBER', NULL),
(188, '2023-02-02', '153139', 'lito', '76', '24', '', '', '', '0', '1824', 'WET RUBBER', NULL),
(189, '2023-02-02', '153140', 'ibik', '184', '24', '', '', '', '0', '4416', 'COPRA', NULL),
(190, '2023-02-02', '153141', 'baltazar', '382', '24', '', '', '', '0', '9168', 'WET RUBBER', NULL),
(191, '2023-02-02', '153138', 'mANDO', '121', '24', '', '', '', '0', '2904', 'WET RUBBER', NULL),
(192, '2023-02-03', '91836', 'AMIN ABUBAKAR', '1125', '23', '', '', '', '0', '25875', 'WET RUBBER', NULL),
(193, '2023-02-03', '91835', 'KOTOH LASARUL', '2114', '27', '', '10000', '', '0', '47078', 'COPRA', NULL),
(194, '2023-02-03', '35731', 'HARI SABTAL', '', '', '', '', '', '', '297388', 'WET RUBBER', NULL),
(195, '2023-02-03', '35730', 'AMMAN AWALIN', '', '', '', '', '', '', '133650', 'BALES', NULL),
(196, '2023-02-03', '91839', 'marites', '615', '17', '', '', '', '0', '10455', 'COPRA', NULL),
(197, '2023-02-04', '91842', 'ton ton', '325', '18', '', '', '', '0', '5850', 'COPRA', NULL),
(198, '2023-02-04', '91843', 'wahid', '145', '18', '', '', '', '0', '2610', 'COPRA', NULL),
(199, '2023-02-04', '35734', 'sulayman tanny', '', '', '', '', '', '', '264978', 'WET RUBBER', NULL),
(200, '2023-02-04', '153142', 'perez', '40', '22', '', '', '', '0', '880', 'WET RUBBER', NULL),
(201, '2023-02-04', '91847', 'ibrahim', '467', '26', '', '', '', '0', '12142', 'COPRA', NULL),
(202, '2023-02-04', '91841', 'amman awalin', '25037', '51', '', '1219520', '', '0', '57367', 'BALES', NULL),
(203, '2023-02-06', '287', 'IBRAHIM', '255', '17', '', '', '', '0', '4335', 'COPRA', NULL),
(204, '2023-02-06', '35739', 'TON2X', '470', '16', '', '', '', '0', '7520', 'COPRA', NULL),
(205, '2023-02-07', '91851', 'cawley', '952', '27', '', '', '', '0', '25704', 'COPRA', NULL),
(206, '2023-02-07', '91639', 'tuwa', '7094', '47', '', '295031', '', '0', '38387', 'BALES', NULL),
(207, '2023-02-08', '91852', 'charly cawlet', '5040', '48', '', '', '', '0', '241920', 'BALES', NULL),
(208, '2023-02-08', '91855', 'moleje', '2758', '46', '', '50000', '', '0', '76868', 'BALES', NULL),
(209, '2023-02-08', '91853', 'louie delos reyes', '8332', '46', '', '235182', '', '0', '148090', 'BALES', NULL),
(210, '2023-02-08', '91854', 'jimroy mcclintock', '3017', '46', '', '100000', '', '0', '38782', 'BALES', NULL),
(211, '2023-02-08', '35762', 'ronie vildad', '5942', '24.50', '', '100000', '', '0', '45579', 'WET RUBBER', NULL),
(212, '2023-02-09', '39660', 'sulayman tanny', '', '', '', '', '', '', '67656', 'BALES', NULL),
(213, '2023-02-09', '91863', 'CAWLEY', '630', '27', '', '', '', '0', '17010', 'COPRA', NULL),
(214, '2023-02-09', '91856', 'JUN McCLINTOCK', '3438', '46', '', '150000', '', '0', '8148', 'BALES', NULL),
(215, '2023-02-09', '91861', 'AMIN', '6280', '28', '', '50000', '', '0', '125840', 'COPRA', NULL),
(216, '2023-02-09', '91862', 'TATANG', '1259', '27', '', '', '', '0', '33993', 'COPRA', NULL),
(217, '2023-02-10', '39661', 'hari sabtal', '', '', '', '', '', '', '20702', 'BALES', NULL),
(218, '2023-02-11', '39662', 'AMMAN AWALIN', '', '', '', '', '', '', '24498', 'BALES', NULL),
(219, '2023-02-11', '91866', 'amin abubakar', '1470', '23', '', '', '', '0', '33810', 'WET RUBBER', NULL),
(220, '2023-02-11', '91859', 'samman awalin', '16736', '51', '', '815623', '', '0', '37913', 'BALES', NULL),
(221, '2023-02-13', '35593', 'nenet costan', '', '', '', '', '', '0', '93040', 'WET RUBBER', NULL),
(222, '2023-02-13', '91867', 'martin muslimin', '6180', '28', '', '', '', '0', '173040', 'COPRA', NULL),
(223, '2023-02-13', '91870', 'adam', '3781', '27.50', '', '', '', '0', '103977.5', 'COPRA', NULL),
(224, '2023-02-14', '35595', 'MANCOM-ERVIN SHARE', '1250', '21', '', '10500', '', '0', '15750', 'WET RUBBER', NULL),
(225, '2023-02-14', '35595', 'JBN MANCOM SHARE', '1250', '21', '', '15750', '', '0', '10500', 'WET RUBBER', NULL),
(226, '2023-02-14', '91875', 'AMIN ABUBAKAR', '3000', '28', '', '25000', '', '0', '59000', 'COPRA', NULL),
(227, '2023-02-14', '91874', 'CHARLY CAWLEY', '', '', '', '', '', '', '269630', 'BALES', NULL),
(228, '2023-02-14', '91872', 'MARTIN MUSLIMIN', '2855', '28', '', '', '', '0', '79940', 'COPRA', NULL),
(229, '2023-02-14', '91871', 'MARTIN MUSLIMIN', '4836', '28', '', '', '', '0', '135408', 'COPRA', NULL),
(230, '2023-02-15', '39685', 'SULAYMAN TANY', '', '', '', '', '', '', '36980', 'BALES', NULL),
(231, '2023-02-15', '91882', 'amin abubakar', '2820', '28', '', '25000', '', '0', '53960', 'COPRA', NULL),
(232, '2023-02-15', '153146', 'husin', '243', '23', '', '', '', '0', '5589', 'WET RUBBER', NULL),
(233, '2023-02-15', '153148', 'halima', '262', '23', '', '', '', '0', '6026', 'WET RUBBER', NULL),
(234, '2023-02-15', '153149', 'alvin', '197', '23', '', '', '', '0', '4531', 'WET RUBBER', NULL),
(235, '2023-02-15', '153147', 'nelson', '192', '23', '', '', '', '0', '4416', 'WET RUBBER', NULL),
(236, '2023-02-15', '91879', 'jimroy McClintock', '2864', '46', '', '100000', '', '0', '31744', 'BALES', NULL),
(237, '2023-02-15', '35596', 'epigil molje', '3497', '48', '', '162816', '', '0', '5040', 'BALES', NULL),
(238, '2023-02-15', '91876', 'martin', '2679', '28', '', '', '', '0', '75012', 'COPRA', NULL),
(239, '2023-02-15', '153144', 'pamaran', '549', '27', '', '', '', '0', '14823', 'WET RUBBER', NULL),
(240, '2023-02-15', '153143', 'pamaran', '202', '27', '', '', '', '0', '5454', 'WET RUBBER', NULL),
(241, '2023-02-15', '153145', 'pamaran', '1089', '27', '', '20000', '', '0', '9403', 'WET RUBBER', NULL),
(242, '2023-02-15', '39663', 'martin muslimin', '', '', '', '', '', '', '34314', 'BALES', NULL),
(243, '2023-02-15', '91877', 'kotoh', '3708', '28', '', '', '', '0', '103824', 'COPRA', NULL),
(244, '2023-02-16', '91886', 'sarip', '611', '27.50', '', '', '', '0', '16802.5', 'COPRA', NULL),
(245, '2023-02-16', '91884', 'nonong furigay', '3970', '31', '', '', '', '0', '123070', 'WET RUBBER', NULL),
(246, '2023-02-16', '91885', 'louie delos reyes', '3771', '47', '', '102275', '', '0', '74962', 'WET RUBBER', NULL),
(247, '2023-02-16', '91880', 'esmeraldo', '9015', '27', '', '200000', '', '0', '43405', 'WET RUBBER', NULL),
(248, '2023-02-16', '91883', 'ambil', '740', '28', '', '', '', '0', '20720', 'COPRA', NULL),
(249, '2023-02-17', '91887', 'amin abubakar', '3560', '28', '', '25000', '', '0', '74680', 'COPRA', NULL),
(250, '2023-02-18', '91889', 'JULMAN JALAN', '2192', '28', '', '', '', '0', '61376', 'COPRA', NULL),
(251, '2023-02-20', '314', 'CASH', '26', '17', '', '', '', '0', '442', 'COPRA', NULL),
(252, '2023-02-20', '313', 'ADELAYDA', '78', '17', '', '', '', '0', '1326', 'COPRA', NULL),
(253, '2023-02-20', '153150', 'HASSAN', '104', '21', '', '', '', '0', '2184', 'WET RUBBER', NULL),
(254, '2023-02-20', '91890', 'MARVIN', '566', '27', '', '', '', '0', '15282', 'COPRA', NULL),
(255, '2023-02-21', '39773', 'sulayman tanny', '', '', '', '', '', '', '270024', 'WET RUBBER', NULL),
(256, '2023-02-21', '91897', 'ambil', '591', '27', '', '', '', '0', '15957', 'COPRA', NULL),
(257, '2023-02-21', '91896', 'amin', '3478', '28', '', '25000', '', '0', '72384', 'COPRA', NULL),
(258, '2023-02-21', '39769', 'SULAYMAN TANY', '', '', '', '', '', '', '90121', 'WET RUBBER', NULL),
(259, '2023-02-21', '39768', 'MUDZKIER ABDURAHMAN', '', '', '', '', '', '', '158165', 'WET RUBBER', NULL),
(260, '2023-02-22', '39777', 'rashid amilin', '', '', '', '', '', '', '286612', 'WET RUBBER', NULL),
(261, '2023-02-22', '93502', 'amin abubakar', '2731', '28', '', '', '', '0', '76468', 'COPRA', NULL),
(262, '2023-02-22', '91900', 'belman', '1102', '27', '', '', '', '0', '29754', 'COPRA', NULL),
(263, '2023-02-22', '91899', 'jimroy McClintock', '2964', '46', '', '100000', '', '0', '36344', 'BALES', NULL),
(264, '2023-02-22', '91898', 'charly cawley', '5285', '50', '', '', '', '0', '264250', 'BALES', NULL),
(265, '2023-02-23', '40866', 'francine', '328', '26.50', '', '', '', '0', '8692', 'WET RUBBER', NULL),
(266, '2023-02-23', '93509', 'berto ahilul', '637', '27', '', '', '', '0', '17199', 'COPRA', NULL),
(267, '2023-02-23', '93507', 'donga', '4106', '26.5', '', '53905', '', '0', '54904', 'WET RUBBER', NULL),
(268, '2023-02-23', '93506', 'abdul', '819', '27', '', '', '', '0', '22113', 'COPRA', NULL),
(269, '2023-02-23', '93504', 'berto', '730', '27', '', '', '', '0', '19710', 'COPRA', NULL),
(270, '2023-02-23', '93503', 'zaldy', '213', '27', '', '', '', '0', '5751', 'COPRA', NULL),
(271, '2023-02-24', '93513', 'RUBEN RAMOS', '3034', '47', '', '100000', '', '0', '42598', 'BALES', NULL),
(272, '2023-02-24', '93514', 'SARIP', '855', '27.50', '', '', '', '0', '23512.5', 'COPRA', NULL),
(273, '2023-02-24', '93511', 'JAMES TAN', '9044', '50', '', '300000', '', '0', '152200', 'BALES', NULL),
(274, '2023-02-25', '39788', 'hari sabtal', '', '', '', '', '', '', '13576', 'BALES', NULL),
(275, '2023-02-27', '325', 'sayugay copra  tenant share', '265', '16', '', '2120', '', '0', '2120', 'COPRA', NULL),
(276, '2023-02-27', '325', 'JBN share sayugan copra', '265', '16', '', '2120', '', '0', '2120', 'COPRA', NULL),
(277, '2023-02-27', '93519', 'liot puri', '2941', '51', '', '', '', '0', '149991', 'BALES', NULL),
(278, '2023-02-28', '93525', 'arevalo', '2095', '27', '', '', '', '0', '56565', 'WET RUBBER', NULL),
(279, '2023-02-28', '93526', 'martin', '3253', '28.50', '', '', '', '0', '92710.5', 'COPRA', NULL),
(280, '2023-02-28', '93527', 'julman', '3277', '28', '', '', '', '0', '91756', 'COPRA', NULL),
(281, '2023-02-28', '39787', 'rasid amilin', '', '', '', '', '', '', '13249', 'WET RUBBER', NULL),
(282, '2023-02-28', '328', 'amin abubakar', '3473', '28.50', '', '50000', '', '0', '48980.5', 'COPRA', NULL),
(283, '2023-03-02', '152572', 'PAMARAN', '172', '28', '', '', '', '0', '4816', 'WET RUBBER', NULL),
(284, '2023-03-02', '152571', 'PAMARAN', '387', '28', '', '', '', '', '10836', 'WET RUBBER', NULL),
(285, '2023-03-02', '152573', 'PAMARAN', '879', '28', '', '', '', '0', '24612', 'WET RUBBER', NULL),
(286, '2023-03-02', '152569', 'BALTAZAR', '281', '28', '', '', '', '0', '7868', 'WET RUBBER', NULL),
(287, '2023-03-02', '152568', 'JOSEPH', '186', '28', '', '', '', '0', '5208', 'WET RUBBER', NULL),
(288, '2023-03-02', '152570', 'ATILANO', '89', '28', '', '', '', '0', '2492', 'WET RUBBER', NULL),
(289, '2023-03-02', '35672', 'MANCOM ERVIN SHARE', '871', '21', '', '7316.40', '', '0', '10974.6', 'WET RUBBER', NULL),
(290, '2023-03-02', '35672', 'MANCOM JBN SHARE 40', '871', '21', '', '10974.60', '', '0', '7316.4', 'WET RUBBER', NULL),
(291, '2023-03-02', '91926', 'BELMAN', '873', '28', '', '', '', '0', '24444', 'COPRA', NULL),
(292, '2023-03-02', '91925', 'KOTOH LASARUL', '3508', '28', '', '', '', '0', '98224', 'COPRA', NULL),
(293, '2023-03-02', '93535', 'JESSICA FLORES', '4598', '26', '', '50000', '', '0', '69548', 'WET RUBBER', NULL),
(294, '2023-03-02', '93532', 'AMIN ABUBAKAR', '4886', '28.50', '', '50000', '', '0', '89251', 'COPRA', NULL),
(295, '2023-03-02', '93533', 'JIMROY MCCLINTOK', '4954', '50', '', '150000', '', '0', '97700', 'WET RUBBER', NULL),
(296, '2023-03-02', '93534', 'JOEL AMAHAN', '2646', '28', '', '', '', '0', '74088', 'WET RUBBER', NULL),
(297, '2023-03-04', '93539', 'EPIGIL MOLEJE', '2966', '50', '', '', '', '0', '148300', 'BALES', NULL),
(298, '2023-03-04', '93540', 'RUBBEN RAMOS', '1070', '50.00', '', '30000', '', '', '23500', 'BALES', NULL),
(299, '2023-03-06', '93542', 'louie delos reyes', '4131', '50', '', '2402', '', '0', '204148', 'BALES', NULL),
(300, '2023-03-07', '39745', 'teeman copras dongga', '35', '3', '', '', '', '0', '105', 'COPRA', NULL),
(301, '2023-03-07', '39745', 'entrada copra', '35', '3', '', '', '', '0', '105', 'COPRA', NULL),
(302, '2023-03-07', '93545', 'lee brown', '8829', '25', '', '200000', '', '0', '20725', 'WET RUBBER', NULL),
(303, '2023-03-07', '93544', 'charles cawley', '4725', '50', '', '130000', '', '0', '106250', 'WET RUBBER', NULL),
(304, '2023-03-07', '93548', 'eric enriquea (dongga)', '1885', '18', '', '', '', '0', '33930', 'COPRA', NULL),
(305, '2023-03-08', '93549', 'amin abubakar', '6398', '29', '', '50000', '', '0', '135542', 'COPRA', NULL),
(306, '2023-03-09', '93552', 'abdul', '1587', '28', '', '', '', '0', '44436', 'COPRA', NULL),
(307, '2023-03-10', '93554', 'babon', '1227', '28', '', '', '', '0', '34356', 'COPRA', NULL),
(308, '2023-03-11', '0002', 'amin abubakar', '955', '25', '', '', '', '0', '23875', 'COPRA', NULL),
(309, '2023-03-13', '12574', 'rogelio', '96', '23', '', '', '', '0', '2208', 'WET RUBBER', NULL),
(310, '2023-03-13', '0003', 'jimroy mcclintok', '1948', '50', '', '50000', '', '0', '47400', 'WET RUBBER', NULL),
(311, '2023-03-14', '93557', 'madzhar', '866', '28', '', '', '', '0', '24248', 'COPRA', NULL),
(312, '2023-03-14', '0005', 'charles cawley', '4550', '50', '', '130000', '', '0', '97500', 'WET RUBBER', NULL),
(313, '2023-03-14', '93555', 'jariba', '1215', '28', '', '', '', '0', '34020', 'COPRA', NULL),
(314, '2023-03-15', '344', 'taniang', '235', '18', '', '', '', '0', '4230', 'COPRA', NULL),
(315, '2023-03-15', '031523', 'hassan', '126', '23', '', '', '', '0', '2898', 'WET RUBBER', NULL),
(316, '2023-03-15', '93558', 'kotoh lasarul', '3777', '28.50', '', '', '', '0', '107644.5', 'COPRA', NULL),
(317, '2023-03-16', '152578', 'pamaran', '165', '28', '', '', '', '0', '4620', 'WET RUBBER', NULL),
(318, '2023-03-16', '152577', 'pamaran', '533', '28', '', '', '', '0', '14924', 'WET RUBBER', NULL),
(319, '2023-03-16', '152576', 'pamaran', '925', '28', '', '13000', '', '0', '12900', 'WET RUBBER', NULL),
(320, '2023-03-15', '0007', 'charles cawley', '4130', '50', '', '', '', '0', '206500', 'WET RUBBER', NULL),
(321, '2023-03-17', '152579', 'PEREZ', '157.6', '110', '', '', '', '0', '17336', 'COFFEE BERRIES', NULL),
(322, '2023-03-17', '93562', 'AMIN ABUBAKAR', '3356', '28', '', '50000', '', '0', '43968', 'COPRA', NULL),
(323, '2023-03-17', '40484', 'NENETH COSTAN', '3775', '49', '', '193040', '', '0', '-8065', 'BALES', NULL),
(324, '2023-03-17', '40486', 'NENETH COSTAN- MALUSO', '15584', '30', '5000', '500000', '5000', '', '27025.60', 'WET RUBBER', NULL),
(325, '2023-03-17', '40487', 'NENETH COSTAN', '10715', '52', '', '478590', '', '0', '78590', 'BALES', NULL),
(326, '2023-03-17', '0013', 'NENETH COSTAN', '12686', '52', '', '500000', '', '0', '159672', 'BALES', NULL),
(327, '2023-03-17', '0011', 'LONG SAN JUAN', '8125', '52', '', '400551', '', '0', '21949', 'BALES', NULL),
(328, '2023-03-17', '93560', 'MARTIN MUSLIMIN', '7041', '28.50', '', '', '', '0', '200668.5', 'COPRA', NULL),
(329, '2023-03-17', '93561', 'SARHA', '2459', '28', '', '', '', '0', '68852', 'COPRA', NULL),
(330, '2023-03-18', '126679', 'DADO', '31.8', '110', '', '', '', '0', '3498', 'COFFEE BERRIES', NULL),
(331, '2023-03-18', '126679', 'DADO', '33.2', '110', '', '', '', '0', '3652', 'COFFEE BERRIES', NULL),
(332, '2023-03-18', '93563', 'AMIN ABUBAKAR', '2861', '29', '', '50000', '', '0', '32969', 'COPRA', NULL),
(333, '2023-03-18', '152580', 'ROGELIO', '39', '22', '', '', '', '0', '858', 'WET RUBBER', NULL),
(334, '2023-03-18', '93564', 'ARSENIO', '968', '28', '', '', '', '0', '27104', 'COPRA', NULL),
(335, '2023-03-18', '0018', 'LOUIE DELOS REYES', '2891', '52', '', '101806', '', '0', '48526', 'WET RUBBER', NULL),
(336, '2023-03-18', '0019', 'ESMERALDO', '6509', '30', '', '150000', '', '0', '45270', 'WET RUBBER', NULL),
(337, '2023-03-20', '40509', 'LONG2 SAN JUAN', '4917', '52', '', '251240', '', '0', '4444', 'WET RUBBER', NULL),
(338, '2023-03-20', '40510', 'LONG2 SAN JUAN', '4174', '52', '', '201136.85', '', '0', '15911', 'WET RUBBER', NULL),
(339, '2023-03-20', '0023', 'EPIGIL MOLEJE', '3053', '50', '', '', '', '0', '152650', 'BALES', NULL),
(340, '2023-03-20', '353', 'EJN MALOONG', '547', '26', '', '', '', '0', '14222', 'COPRA', NULL),
(341, '2023-03-21', '152583', 'HAMID', '120', '24', '', '', '', '0', '2880', 'WET RUBBER', NULL),
(342, '2023-03-21', '152582', 'HASSAN', '75', '24', '', '', '', '0', '1800', 'WET RUBBER', NULL),
(343, '2023-03-21', '152581', 'TOTONG', '86', '24', '', '', '', '0', '2064', 'WET RUBBER', NULL),
(344, '2023-03-21', '0026', 'NENETH COSTAN', '6113', '52', '', '278590', '', '0', '39286', 'BALES', NULL),
(345, '2023-03-21', '0028', 'NENETH COSTAN', '12157', '30', '.35', '340000', '', '4254.95', '28965', 'BALES', NULL),
(346, '2023-03-21', '93566', 'NAMIR', '2758', '28', '', '', '', '0', '77224', 'COPRA', NULL),
(347, '2023-03-21', '9565', 'ABUBAKAR', '2616', '28', '', '', '', '0', '73248', 'COPRA', NULL),
(348, '2023-03-23', '0033', 'DONGGA ENRIQUEZ', '2690', '24', '', '30780', '', '0', '33780', 'WET RUBBER', NULL),
(349, '2023-03-23', '0034', 'RONIE VILDAD', '3057', '49', '', '145579', '', '0', '4214', 'BALES', NULL),
(350, '2023-03-23', '0035', 'FRANCINE', '273', '24', '', '', '', '0', '6552', 'WET RUBBER', NULL),
(351, '2023-03-23', '0032', 'ENGR. BONG', '82', '58', '35', '', '', '', '166460', 'BALES', NULL),
(352, '2023-03-24', '0036', 'NONONG FURIGAY', '2700', '30', '', '', '', '0', '81000', 'WET RUBBER', NULL),
(353, '2023-03-25', '126680', 'JOJO', '4', '90', '', '', '', '0', '360', 'COFFEE BEANS', NULL),
(354, '2023-03-25', '93569', 'AMIN ABUBAKAR', '2802', '29', '', '', '', '0', '81258', 'COPRA', NULL),
(355, '2023-03-27', '0043', 'tatah halal', '8823', '50', '', '63369', '', '0', '377781', 'BALES', NULL),
(356, '2023-03-27', '93570', 'abdul', '909', '27', '', '', '', '0', '24543', 'COPRA', NULL),
(357, '2023-03-27', '93571', 'ibrahim', '828', '27', '', '', '', '0', '22356', 'COPRA', NULL),
(358, '2023-03-27', '93572', 'julman jalal', '3484', '28', '', '', '', '0', '97552', 'COPRA', NULL),
(359, '2023-03-27', '93573', 'ibrahim', '790', '27', '', '', '', '0', '21330', 'COPRA', NULL),
(360, '2023-03-28', '40555', 'ruben ramos return cash', '1996', '51', '', '150000', '', '0', '-48204', 'WET RUBBER', NULL),
(361, '2023-03-28', '03282023', 'adelayda', '68', '17', '', '', '', '0', '1156', 'COPRA', NULL),
(362, '2023-03-28', '93574', 'abdul', '326', '27', '', '', '', '0', '8802', 'COPRA', NULL),
(363, '2023-03-29', '0051', 'lito puri', '3192.50', '51', '', '', '', '', '162817.5', 'BALES', NULL),
(364, '2023-03-29', '152586', 'mitch', '115', '24', '', '', '', '0', '2760', 'WET RUBBER', NULL),
(365, '2023-03-29', '0052', 'arevalo', '1177', '28.50', '', '', '', '0', '33544.5', 'WET RUBBER', NULL),
(366, '2023-03-29', '0053', 'charles cawley', '2050', '50', '', '', '', '0', '102500', 'BALES', NULL),
(367, '2023-03-29', '0053', 'charles cawley', '2255', '48', '', '', '', '0', '108240', 'BALES', NULL),
(368, '2023-03-29', '0054', 'jimroy mcclintock', '2824', '50', '', '100000', '', '0', '41200', 'WET RUBBER', NULL),
(369, '2023-03-30', '152592', 'aida', '142', '24', '', '', '', '0', '3408', 'WET RUBBER', NULL),
(370, '2023-03-30', '93576', 'amin abubakar', '4154', '28', '', '50000', '', '0', '66312', 'COPRA', NULL),
(371, '2023-03-30', '93575', 'ibrahim', '773', '27', '', '', '', '0', '20871', 'COPRA', NULL),
(372, '2023-03-30', '93577', 'ibrahim', '702', '27', '', '', '', '0', '18954', 'COPRA', NULL),
(373, '2023-03-30', '0057', 'arco', '7548', '28', '', '100000', '', '0', '111344', 'WET RUBBER', NULL),
(374, '2023-03-30', '40570', 'ejn mancom', '1322', '21', '', '', '', '0', '27762', 'WET RUBBER', NULL),
(375, '2023-03-31', '152813', 'jack', '19.8', '110', '', '', '', '0', '2178', 'COFFEE BEANS', NULL),
(376, '2023-03-31', '152595', 'mando', '79', '28', '', '', '', '', '2212', 'WET RUBBER', NULL),
(377, '2023-03-31', '152810', 'baltazar', '314', '28', '', '', '', '0', '8792', 'WET RUBBER', NULL),
(378, '2023-03-31', '152811', 'jeff2', '92', '28', '', '', '', '0', '2576', 'WET RUBBER', NULL),
(379, '2023-03-31', '152809', 'joseph', '76', '28', '', '', '', '0', '2128', 'WET RUBBER', NULL),
(380, '2023-03-31', '152806', 'tan', '241', '28', '', '', '', '0', '6748', 'WET RUBBER', NULL),
(381, '2023-03-31', '152808', 'atilano', '71', '28', '', '', '', '0', '1988', 'WET RUBBER', NULL),
(382, '2023-03-31', '152807', 'batitong', '680', '28', '', '', '', '0', '19040', 'WET RUBBER', NULL),
(383, '2023-03-31', '0060', 'joel amahan', '2897', '28', '', '', '', '0', '81116', 'WET RUBBER', NULL),
(384, '2023-04-01', '152814', 'PAMARAN', '567', '26', '', '', '', '0', '14742', 'WET RUBBER', NULL),
(385, '2023-04-01', '152815', 'PAMARAN', '818', '26', '', '13000', '', '0', '8268', 'WET RUBBER', NULL),
(386, '2023-04-01', '152813', 'PAMARAN', '151', '26', '', '', '', '0', '3926', 'WET RUBBER', NULL),
(387, '2023-04-01', '93578', 'IBRAHIM', '772', '27', '', '', '', '0', '20844', 'COPRA', NULL),
(388, '2023-04-01', '91774', 'NONONG FURIGAY', '2235', '31', '', '', '', '0', '69285', 'WET RUBBER', NULL),
(389, '2023-04-01', '93579', 'IBRAHIM', '695', '27', '', '', '', '0', '18765', 'COPRA', NULL),
(390, '2023-04-03', '93580', 'MARJOE', '565', '27', '', '', '', '0', '15255', 'COPRA', NULL),
(391, '2023-04-05', '93586', 'IBRAHIM', '381', '27', '', '', '', '0', '10287', 'COPRA', NULL),
(392, '2023-04-05', '04052023', 'KABAYAN', '47', '17', '', '', '', '0', '799', 'COPRA', NULL),
(393, '2023-04-05', '040523', 'kabayan', '47', '17', '', '', '', '0', '799', 'COPRA', NULL),
(394, '2023-04-05', '93586', 'ibrahim', '381', '27', '', '', '', '0', '10287', 'COPRA', NULL),
(395, '2023-04-08', '040823', 'AMIN ABUBAKAR', '3499', '29', '', '50000', '', '0', '51471', 'COPRA', NULL),
(396, '2023-04-14', '91799', 'AMIN ABUBAKAR', '1830', '25.50', '', '', '', '0', '46665', 'WET RUBBER', NULL),
(397, '2023-04-14', '91798', 'JIMROY MCCLINTOK', '2626', '50', '', '100000', '', '0', '31300', 'BALES', NULL),
(398, '2023-04-14', '93595', 'ASRAFF HADITIYA TARZRIMIN', '2064', '28', '', '', '', '0', '57792', 'COPRA', NULL),
(399, '2023-04-14', '40681', 'EJN MANCOM', '841', '21', '', '', '', '0', '17661', 'WET RUBBER', NULL),
(400, '2023-04-10', '40648', 'adelayda', '55', '21', '', '', '', '0', '1155', 'COPRA', NULL),
(401, '2023-04-10', '152816', 'nilo', '85', '23', '', '', '', '0', '1955', 'WET RUBBER', NULL),
(402, '2023-04-10', '91786', 'louie delos reyes', '9256', '30', '', '200000', '', '0', '77680', 'WET RUBBER', NULL),
(403, '2023-04-10', '93588', 'sanchez', '856', '27', '', '', '', '0', '23112', 'COPRA', NULL),
(404, '2023-04-11', '152817', 'perez', '81.6', '110', '', '', '', '0', '8976', 'COFFEE BEANS', NULL),
(405, '2023-04-11', '152817', 'perez', '13.2', '110', '', '', '', '0', '1452', 'COFFEE BEANS', NULL),
(406, '2023-04-11', '93589', 'bacalso', '1982', '27', '', '', '', '0', '53514', 'COPRA', NULL),
(407, '2023-04-11', '91789', 'epigil moleje', '3454', '50', '', '', '', '0', '172700', 'BALES', NULL),
(408, '2023-04-11', '91790', 'charley cawley', '3640', '48', '', '130000', '', '0', '44720', 'BALES', NULL),
(409, '2023-04-12', '93590', 'martin muslimin', '3496', '29', '', '', '', '0', '101384', 'COPRA', NULL),
(410, '2023-04-12', '93591', 'martin muslimin', '2788', '29', '', '', '', '0', '80852', 'COPRA', NULL),
(411, '2023-04-12', '91791', 'charles cawley', '4165', '48', '', '', '', '0', '199920', 'BALES', NULL),
(413, '2023-04-13', '91796', 'louie delos reyes', '', '', '', '', '', '', '211442', 'BALES', NULL),
(414, '2023-04-13', '91795', 'jerry ariero', '2874', '50', '', '70000', '', '0', '73700', 'BALES', NULL),
(415, '2023-04-13', '91792', 'jessica florez', '3695', '25', '', '30000', '', '0', '62375', 'WET RUBBER', NULL),
(416, '2023-04-13', '93593', 'martin muslimin', '2297', '29', '', '', '', '0', '66613', 'COPRA', NULL),
(417, '2023-04-13', '93592', 'yaser', '370', '29', '', '', '', '0', '10730', 'COPRA', NULL),
(418, '2023-04-13', '93594', 'ibrahim', '778', '28', '', '', '', '0', '21784', 'COPRA', NULL),
(419, '2023-04-15', '93596', 'amin abubakar', '4042', '29', '', '50000', '', '0', '67218', 'COPRA', NULL),
(420, '2023-04-17', '0101', 'jarwin garcia', '2811', '50', '', '121000', '', '0', '19550', 'WET RUBBER', NULL),
(421, '2023-04-18', '152818', 'nestor', '117', '25', '', '', '', '0', '2925', 'WET RUBBER', NULL),
(422, '2023-04-18', '0106', 'epigil moleje', '1197', '51', '', '', '', '0', '61047', 'BALES', NULL),
(423, '2023-04-19', '041923', 'ibs', '87', '18', '', '', '', '0', '1566', 'COPRA', NULL),
(424, '2023-04-19', '0111', 'charles cawley', '3465', '48', '', '', '', '0', '166320', 'BALES', NULL),
(425, '2023-04-19', '0107', 'jarwin garcia', '6844', '50', '', '284750', '', '0', '57450', 'BALES', NULL),
(426, '2023-04-18', '0109', 'larbeco', '30000', '29.30', '', '', '615300', '0', '263700', 'WET RUBBER', NULL),
(427, '2023-04-20', '0113', 'LITO PURI', '3265', '52', '', '', '', '0', '169780', 'WET RUBBER', NULL),
(428, '2023-04-20', '93598', 'IBRAHIM', '1020', '28', '', '', '', '0', '28560', 'COPRA', NULL),
(429, '2023-04-22', '40808', 'LARBECO', '30743', '29.30', '', '615300', '', '0', '285469.9', 'WET RUBBER', NULL),
(430, '2023-04-22', '0119', 'DONGGA/ ERIC ENRIQUEZ', '1988', '25', '', '22350', '', '0', '27350', 'WET RUBBER', NULL),
(431, '2023-04-22', '0118', 'JENG ENRIQUEZ', '429', '25', '', '', '', '0', '10725', 'WET RUBBER', NULL),
(432, '2023-04-22', '0117', 'JIMROY MCCLONTOCK', '3409', '51', '', '110000', '', '0', '63859', 'WET RUBBER', NULL),
(433, '2023-04-24', '40801', 'NENETH COSTAN', '20190', '', '', '560000', '', '0', '13799.80', 'WET RUBBER', NULL),
(434, '2023-04-24', '40817', 'LARBECO', '1046', '29.30', '', '', '', '0', '30647.8', 'WET RUBBER', NULL),
(435, '2023-04-24', '0115', 'TATA HALAL ', '3086', '51', '', '20000', '', '0', '137386', 'BALES', NULL),
(436, '2023-04-25', '152819', 'BABON', '68', '23', '', '', '', '0', '1564', 'WET RUBBER', NULL),
(437, '2023-04-25', '0125', 'CHARLES CAWLEY', '4060', '48', '', '', '', '0', '194880', 'WET RUBBER', NULL),
(438, '2023-04-26', '40836', 'AMIN ABUBAKAR', '1530', '25', '', '', '', '0', '38250', 'WET RUBBER', NULL),
(439, '2023-04-26', '40835', 'ADELAIDA PACARO', '47', '19', '', '', '', '0', '893', 'COPRA', NULL),
(440, '2023-04-27', '0401', 'HON. ARLEIGH EISMA', '2498', '28', '', '', '', '0', '69944', 'COPRA', NULL),
(441, '2023-04-27', '93599', 'DENG/ HARIJA', '2004', '28.50', '', '', '', '0', '57114', 'COPRA', NULL),
(442, '2023-04-27', '93600', 'AMIL SABBUDIN', '876', '28', '', '', '', '0', '24528', 'COPRA', NULL),
(443, '2023-04-28', '152826', 'JACK', '19', '110', '', '', '', '0', '2090', 'COFFEE BEANS', NULL),
(444, '2023-04-28', '0133', 'EPIGIL MOLEJE', '1860', '50', '', '', '', '0', '93000', 'WET RUBBER', NULL),
(445, '2023-04-28', '0403', 'AMIN ABUBAKAR', '2620', '29', '', '50000', '', '0', '25980', 'COPRA', NULL),
(446, '2023-04-28', '0132', 'JARWIN GARCIA', '2978', '50', '', '130750', '', '0', '18150', 'BALES', NULL),
(447, '2023-04-28', '0132', 'JARWIN GARCIA', '2723', '50', '', '114375', '', '0', '21775', 'BALES', NULL),
(448, '2023-04-28', '152820', 'MADINA', '166', '23', '', '', '', '0', '3818', 'WET RUBBER', NULL),
(449, '2023-04-28', '0131', 'AREVALO', '1301', '28', '', '', '', '0', '36428', 'WET RUBBER', NULL),
(450, '2023-04-28', '0402', 'IBRAHIM', '897', '27', '', '', '', '0', '24219', 'COPRA', NULL),
(451, '2023-04-29', '0134', 'alvin gulpere- arco', '6915', '28.50', '', '150000', '', '0', '47077.5', 'WET RUBBER', NULL),
(452, '2023-04-29', '152827', 'cash', '69', '23', '', '', '', '0', '1587', 'WET RUBBER', NULL),
(453, '2023-04-29', '2895', 'mancom, maloong plantation', '575', '21', '', '4830', '', '0', '7245', 'WET RUBBER', NULL),
(454, '2023-04-29', '2895', 'mancom jbn share', '575', '21', '', '7245', '', '0', '4830', 'WET RUBBER', NULL),
(455, '2023-04-29', '40420', 'maloong canal plantation/ jay ar catall/ biddinga', '16259', '28.25', '', '', '', '0', '459316.75', 'WET RUBBER', NULL),
(456, '2023-05-02', '40901', 'lee roy brown', '8336', '28', '', '200000', '', '0', '33408', 'WET RUBBER', NULL),
(457, '2023-05-02', '0404', 'martin muslimin', '3112', '27', '', '', '', '0', '84024', 'COPRA', NULL),
(458, '2023-05-03', '0405', 'kotoh lasarul', '3576', '28', '', '', '', '0', '100128', 'COPRA', NULL),
(459, '2023-05-03', '0141', 'charles cawley', '2415', '48', '', '', '', '0', '115920', 'BALES', NULL),
(460, '2023-05-03', '0141', 'charles cawley', '2205', '52', '', '', '', '0', '114660', 'BALES', NULL),
(461, '2023-05-04', '40913', 'nonong furigay', '2400', '31', '', '', '', '0', '74400', 'WET RUBBER', NULL),
(462, '2023-05-04', '40911', 'mudzkier aldurahaman', '12232.20', '53', '', '500000', '', '0', '148306.6000000001', 'WET RUBBER', NULL),
(463, '2023-05-04', '0140', 'jarwin garcia', '4005', '50', '', '175750', '', '0', '24500', 'WET RUBBER', NULL),
(464, '2023-05-05', '40918', 'IBS', '364', '19', '', '', '', '0', '6916', 'COPRA', NULL),
(465, '2023-05-06', '40919', 'nenet constan', '11408.6', '50', '', '554500', '', '0', '15930', 'WET RUBBER', NULL),
(466, '2023-05-06', '152828', 'leo', '61', '23', '', '', '', '0', '1403', 'WET RUBBER', NULL),
(467, '2023-05-06', '0406', 'amin abubakar', '4121', '29', '', '50000', '', '0', '69509', 'COPRA', NULL),
(468, '2023-05-08', '0407', 'ARLEIGH EISMA', '963', '27', '', '', '', '0', '26001', 'COPRA', NULL),
(469, '2023-05-08', '0150', 'JERRY ARIERO', '2416', '50', '', '80000', '', '0', '40800', 'WET RUBBER', NULL),
(470, '2023-05-08', '40935', 'ABDULKARIM DOMPOL', '', '', '', '', '', '', '10652', 'WET RUBBER', NULL),
(471, '2023-05-09', '401', 'ibs', '130', '17', '', '', '', '0', '2210', 'COPRA', NULL),
(472, '2023-05-09', '0155', 'jimroy McClintock', '2015.8', '51', '', '100000', '', '0', '2805.800000000003', 'WET RUBBER', NULL),
(473, '2023-05-09', '0408', 'jesusa morados', '1072', '19', '', '', '', '0', '20368', 'COPRA', NULL),
(474, '2023-05-10', '152841', 'baltazar', '332', '27', '', '', '', '0', '8964', 'WET RUBBER', NULL),
(475, '2023-05-10', '152838', 'mando', '127', '27', '', '', '', '0', '3429', 'WET RUBBER', NULL),
(476, '2023-05-10', '152839', 'joseph', '76', '27', '', '', '', '0', '2052', 'WET RUBBER', NULL),
(477, '2023-05-10', '152837', 'romel', '1422', '27', '', '', '', '0', '38394', 'WET RUBBER', NULL),
(478, '2023-05-10', '152840', 'atilano', '112', '27', '', '', '', '0', '3024', 'WET RUBBER', NULL),
(479, '2023-05-11', '0411', 'ALEX', '1322', '28', '', '', '', '0', '37016', 'COPRA', 'Basilan'),
(480, '2023-05-11', '164', 'CHARLY CAWLEY', '4095', '52', '', '', '', '0', '212940', 'COPRA', 'Basilan'),
(481, '2023-05-11', '0411', 'ALEZ', '1322', '28', '', '', '', '0', '37016', 'COPRA', 'Basilan'),
(482, '2023-05-12', '39855', 'jarwin garcia', '4100', '51', '', '100000', '', '0', '109100', 'BALES', 'Basilan'),
(483, '2023-05-12', '413', 'tatang', '1078', '28', '', '', '', '0', '30184', 'COPRA', 'Basilan'),
(484, '2023-05-12', '412', 'berto', '1207', '28', '', '2000', '', '0', '31796', 'COPRA', 'Basilan'),
(485, '2023-05-13', '39866', 'tany sulayman', '', '', '', '', '', '', '36600', 'WET RUBBER', 'Basilan'),
(486, '2023-05-13', '39867', 'HARI SABTA;-BACK PAYMENT FOR RUBBER EXPORT', '', '', '', '', '', '', '12251', 'BALES', 'Basilan'),
(488, '2023-05-15', '39809', 'jarwin garcia', '4170', '51', '', '100000', '', '0', '112670', 'WET RUBBER', 'Basilan'),
(489, '2023-05-15', '39870', 'mudzkier andurahman', '', '', '', '', '', '', '39315', 'BALES', 'Basilan'),
(490, '2023-05-15', '39880', 'moleje', '2556', '50', '', '', '', '0', '127800', 'WET RUBBER', 'Basilan'),
(491, '2023-05-15', '0417', 'martin', '1380', '28.50', '', '', '', '0', '39330', 'COPRA', 'Basilan'),
(492, '2023-05-15', '0414', 'kasma', '', '', '', '', '', '', '', 'COPRA', 'Basilan'),
(493, '2023-05-15', '0414', 'kasma', '410', '19', '', '', '', '0', '7790', 'COPRA', 'Basilan'),
(494, '2023-05-15', '0415', 'yasser', '283', '28', '', '', '', '0', '7924', 'COPRA', 'Basilan'),
(495, '2023-05-15', '420', 'amin', '4405', '29', '', '50000', '', '0', '77745', 'COPRA', 'Basilan'),
(496, '2023-05-15', '0419', 'RASID', '11209', '29.50', '', '200000', '', '0', '130665.5', 'COPRA', 'Basilan'),
(497, '2023-05-16', '39900', 'mancom share', '890', '21', '', '7476', '', '0', '11214', 'WET RUBBER', 'Basilan'),
(498, '2023-05-15', '3990', 'JBN share mancom', '890', '21', '', '11214', '', '0', '7476', 'WET RUBBER', 'Basilan'),
(499, '2023-05-16', '0174', 'nonong furigay', '2195', '31.50', '', '', '', '0', '69142.5', 'WET RUBBER', 'Basilan'),
(501, '2023-05-16', '39898', 'nenet', '12452.60', '49', '', '554500', '', '0', '55677.40000000002', 'WET RUBBER', 'Basilan'),
(502, '2023-05-17', '175', 'louie delos reyes', '4386', '51.50', '', '152620', '', '0', '73259', 'BALES', 'Basilan'),
(503, '2023-05-17', '177', 'charly cawley', '3955', '52', '', '', '', '0', '205660', 'BALES', 'Basilan'),
(504, '2023-05-17', '422', 'hari sabtal', '5453', '29.75', '', '', '', '0', '162226.75', 'COPRA', 'Basilan'),
(505, '2023-05-18', '0424', 'Risma Mujajilun', '4915', '29.50', '', '', '', '0', '144992.5', 'COPRA', 'Basilan'),
(506, '2023-05-19', '0427', 'RASID', '6205', '29.5', '', '1830', '', '0', '181217.5', 'COPRA', 'Basilan'),
(507, '2023-05-19', '0183', 'JERRY ARIERO', '1356', '50', '', '25000', '', '0', '42800', 'BALES', 'Basilan'),
(508, '2023-05-19', '41111', 'ASIM ONZ GAHAMAN', '', '', '', '', '', '', '151089', 'WET RUBBER', 'Basilan'),
(509, '2023-05-19', '39813', 'NENET COSTAN', '11797.20', '50', '', '554500', '', '0', '35360', 'WET RUBBER', 'Basilan'),
(510, '2023-05-19', '181', 'TANNY SULAYMAN', '1962', '29.75', '', '', '', '0', '58369.5', 'COPRA', 'Basilan'),
(511, '2023-05-20', '428', 'rasid', '5935', '29.50', '', '1751', '', '0', '173331.5', 'COPRA', 'Basilan'),
(512, '2023-05-22', '433', 'amin abubakar', '5424', '29', '', '50000', '', '0', '107296', 'COPRA', 'Basilan'),
(513, '2023-05-22', '41133', 'jik', '37', '18', '', '', '', '0', '666', 'COPRA', 'Basilan'),
(514, '2023-05-22', '430', 'rasid', '5882', '29.50', '', '1735', '', '0', '171784', 'COPRA', 'Basilan'),
(515, '2023-05-22', '431', 'cash', '788', '28', '', '', '', '0', '22064', 'COPRA', 'Basilan'),
(516, '2023-05-22', '187', 'jarwin garcia', '5861', '51', '', '247124', '', '0', '51787', 'BALES', 'Basilan'),
(517, '2023-05-22', '185', 'jarwin garcia', '5618', '51', '', '249250', '', '0', '37268', 'BALES', 'Basilan'),
(518, '2023-05-22', '152842', 'nasira', '396', '26', '', '', '', '0', '10296', 'WET RUBBER', 'Basilan'),
(519, '2023-05-22', '188', 'jimroy McClintock', '2685', '50', '', '100000', '', '0', '34250', 'BALES', 'Basilan'),
(520, '2023-05-23', '39815', 'jeng2x enriquez', '855', '26.50', '', '', '', '0', '22657.5', 'WET RUBBER', 'Basilan'),
(521, '2023-05-23', '39817', 'eric enriquez toppers share', '2209', '26.50', '', '28569.25', '', '0', '29969.25', 'WET RUBBER', 'Basilan'),
(522, '2023-05-23', '41135', 'martin muslimin', '', '', '', '', '', '', '17924', 'WET RUBBER', 'Basilan'),
(523, '2023-05-23', '445', 'adelayda', '66', '18', '', '', '', '0', '1188', 'COPRA', 'Basilan'),
(524, '2023-05-23', '435', 'saman', '5002', '29.50', '', '', '', '0', '147559', 'COPRA', 'Basilan'),
(525, '2023-05-23', '434', 'hassan', '1196', '27', '', '', '', '0', '32292', 'COPRA', 'Basilan'),
(526, '2023-05-24', '436', 'SAMAN', '6351', '29.50', '', '', '', '0', '187354.5', 'COPRA', 'Basilan'),
(527, '2023-05-24', '437', 'MARTIN', '2632', '27.50', '', '', '', '0', '72380', 'COPRA', 'Basilan'),
(528, '2023-05-25', '440', 'abdul', '1524', '28', '', '', '', '0', '42672', 'COPRA', 'Basilan'),
(529, '2023-05-25', '198', 'charly cawley', '4270', '52', '', '130000', '', '0', '92040', 'BALES', 'Basilan'),
(530, '2023-05-25', '439', 'datu', '3632', '29', '', '', '', '0', '105328', 'COPRA', 'Basilan'),
(531, '2023-05-25', '438', 'ibrahim', '4554', '29', '', '', '', '0', '132066', 'COPRA', 'Basilan');
INSERT INTO `ledger_purchase` (`id`, `date`, `voucher`, `customer_name`, `net_kilos`, `price`, `adjustment_price`, `less`, `partial_payment`, `net_total`, `total_amount`, `category`, `location`) VALUES
(532, '2023-05-25', '152843', '88', '88', '24', '', '', '', '0', '2112', 'WET RUBBER', 'Basilan'),
(533, '2023-05-26', '502', 'louie delos reyes', '2258', '52', '', '81433.25', '', '0', '35982.75', 'WET RUBBER', 'Basilan'),
(534, '2023-05-26', '0200', 'lito puri', '2475', '52', '', '', '', '0', '128700', 'BALES', 'Basilan'),
(535, '2023-05-26', '41150', 'raymund san juan', '', '', '', '', '', '', '4800', 'WET RUBBER', 'Basilan'),
(536, '2023-05-26', '443', 'datu', '3480', '29', '', '', '', '0', '100920', 'COPRA', 'Basilan'),
(537, '2023-05-26', '442', 'ibrahim', '3692', '29', '', '', '', '0', '107068', 'COPRA', 'Basilan'),
(538, '2023-05-26', '441', 'ibrahim', '4910', '29', '', '', '', '0', '142390', 'COPRA', 'Basilan'),
(539, '2023-05-26', '445', 'abdulgapor', '1991', '28', '', '', '', '0', '55748', 'COPRA', 'Basilan'),
(540, '2023-05-27', '444', 'ibrahim', '3907', '29', '', '', '', '0', '113303', 'COPRA', 'Basilan'),
(541, '2023-05-27', '41205', 'tany sulayman', '', '', '', '', '', '', '74602', 'BALES', 'Basilan'),
(542, '2023-05-27', '39821', 'amin abubakar', '1320', '26', '', '', '', '0', '34320', 'WET RUBBER', 'Basilan'),
(543, '2023-05-27', '452', 'risma', '6387', '28.50', '', '82029.5', '', '0', '100000', 'COPRA', 'Basilan'),
(544, '2023-05-27', '451', 'abdulgapor', '1523', '28', '', '', '', '0', '42644', 'COPRA', 'Basilan'),
(545, '2023-05-27', '450', 'datu', '2832', '29', '', '', '', '0', '82128', 'COPRA', 'Basilan'),
(546, '2023-05-27', '449', 'alih', '1557', '28', '', '', '', '0', '43596', 'COPRA', 'Basilan'),
(547, '2023-05-27', '448', 'tong', '3784', '27.25', '', '', '', '0', '103114', 'COPRA', 'Basilan'),
(548, '2023-05-27', '447', 'alih', '2898', '28', '', '40000', '', '0', '41144', 'COPRA', 'Basilan'),
(549, '2023-05-29', '453', 'SAMAN', '2334', '29.50', '', '', '', '0', '68853', 'COPRA', 'Basilan'),
(550, '2023-05-29', '485', 'ADELAYDA', '21', '18', '', '', '', '0', '378', 'COPRA', 'Basilan'),
(551, '2023-05-29', '41215', 'RISMA', '6387', '28.50', '', '100000', '', '0', '82029.5', 'COPRA', 'Basilan'),
(552, '2023-05-29', '454', 'ABDULGAPOR', '2006', '28', '', '', '', '0', '56168', 'COPRA', 'Basilan'),
(553, '2023-05-29', '41209', 'IBRAHIM', '280', '28', '', '', '', '0', '7840', 'COPRA', 'Basilan'),
(554, '2023-05-29', '458', 'JERRY', '935', '28', '', '', '', '0', '26180', 'COPRA', 'Basilan'),
(555, '2023-05-29', '457', 'ALDASER', '652', '28', '', '', '', '0', '18256', 'COPRA', 'Basilan'),
(556, '2023-05-29', '459', 'ABDULGAPOR', '1428', '28', '', '', '', '0', '39984', 'COPRA', 'Basilan'),
(557, '2023-05-29', '455', 'DATU SABTILAN', '3454', '29', '', '', '', '0', '100166', 'COPRA', 'Basilan'),
(558, '2023-05-30', '464', 'ibrahim', '3795', '28.50', '.50', '', '', '1897.5', '108157.5', 'COPRA', 'Basilan'),
(559, '2023-05-30', '461', 'alih', '3419', '28', '', '', '', '0', '95732', 'COPRA', 'Basilan'),
(560, '2023-05-30', '512', 'plantation', '16864', '31', '', '', '', '0', '522784', 'COPRA', 'Basilan'),
(561, '2023-05-30', '463', 'ons', '3170', '28.50', '', '', '', '0', '90345', 'COPRA', 'Basilan'),
(562, '2023-05-30', '460', 'datu', '2432', '29', '', '', '', '0', '70528', 'COPRA', 'Basilan'),
(563, '2023-05-30', '511', 'jr catalla', '2349', '28', '', '', '', '0', '65772', 'WET RUBBER', 'Basilan'),
(564, '2023-05-30', '462', 'adham', '3327', '28', '', '', '', '0', '93156', 'COPRA', 'Basilan'),
(565, '2023-05-30', '509', 'AREVALO', '660', '26', '2', '', '', '1320', '17160', 'WET RUBBER', 'Basilan'),
(566, '2023-05-31', '39832', 'TATA HALAL', '7365', '51.50', '', '270000', '', '0', '109297.5', 'WET RUBBER', 'Basilan'),
(567, '2023-05-31', '468', 'DANNY', '628', '26', '', '', '', '0', '16328', 'COPRA', 'Basilan'),
(568, '2023-05-31', '470', 'DATU', '3511', '29', '', '51819', '', '0', '50000', 'COPRA', 'Basilan'),
(569, '2023-05-31', '466', 'ADHAM', '3315', '28', '', '', '', '0', '92820', 'COPRA', 'Basilan'),
(570, '2023-05-31', '467', 'TONG', '4234', '27.50', '', '', '', '0', '116435', 'COPRA', 'Basilan'),
(571, '2023-06-01', '41256', 'nenet', '', '', '', '', '', '', '12374', 'WET RUBBER', 'Basilan'),
(572, '2023-06-01', '472', 'onz', '1250', '28.50', '', '', '', '0', '35625', 'COPRA', 'Basilan'),
(573, '2023-06-01', '39847', 'mancom', '910', '21', '', '7644', '', '0', '11466', 'WET RUBBER', 'Basilan'),
(574, '2023-06-01', '39847', 'mancom', '910', '21', '', '11466', '', '0', '7644', 'WET RUBBER', 'Basilan'),
(575, '2023-06-01', '471', 'amin', '4979', '28.50', '', '50000', '', '0', '91901.5', 'COPRA', 'Basilan'),
(576, '2023-06-01', '517', 'nonong furigay', '2615', '30', '', '', '', '0', '78450', 'WET RUBBER', 'Basilan'),
(577, '2023-06-01', '41251', 'longlong san juan', '20910', '30', '', '550000', '', '0', '77300', 'WET RUBBER', 'Basilan'),
(578, '2023-06-01', '41249', 'datu', '3511', '29', '', '50000', '', '0', '51819', 'COPRA', 'Basilan'),
(579, '2023-06-01', '152849', 'totoy', '85', '23', '', '', '', '0', '1955', 'WET RUBBER', 'Basilan'),
(580, '2023-06-01', '152850', 'totoy', '19', '23', '', '', '', '0', '437', 'WET RUBBER', 'Basilan'),
(581, '2023-06-01', '474', 'hari', '856', '27', '', '', '', '0', '23112', 'COPRA', 'Basilan'),
(582, '2023-06-02', '41263', 'amman awalin', '', '', '', '', '', '', '73155', 'WET RUBBER', 'Basilan'),
(583, '2023-06-02', '475', 'hari', '877', '26', '', '', '', '0', '22802', 'COPRA', 'Basilan'),
(584, '2023-06-02', '473', 'sulayman', '3597', '27.50', '', '', '', '0', '98917.5', 'COPRA', 'Basilan'),
(585, '2023-06-02', '477', 'uniel', '1047', '27', '', '', '', '0', '28269', 'COPRA', 'Basilan'),
(586, '2023-06-03', '481', 'SAMAN', '3810', '28', '', '1066.80', '', '0', '105613.2', 'COPRA', 'Basilan'),
(587, '2023-06-03', '478', 'SULAYMAN', '4433', '27.50', '', '', '', '0', '121907.5', 'COPRA', 'Basilan'),
(588, '2023-06-03', '480', 'ALIH', '1087', '28', '', '', '', '0', '30436', 'COPRA', 'Basilan'),
(589, '2023-06-03', '479', 'ALIH', '2472', '28', '', '', '', '0', '69216', 'COPRA', 'Basilan'),
(590, '2023-06-05', '531', 'ibanez', '295', '19', '', '', '', '0', '5605', 'COPRA', 'Basilan'),
(591, '2023-06-05', '483', 'kotoh', '3663', '29', '', '1062.27', '', '0', '105164.73', 'COPRA', 'Basilan'),
(592, '2023-06-05', '485', 'adham', '3153', '27.50', '', '867.08', '', '0', '85840.42', 'COPRA', 'Basilan'),
(593, '2023-06-05', '486', 'ibrahim', '4062', '28', '', '1165', '', '0', '112571', 'COPRA', 'Basilan'),
(594, '2023-06-05', '487', 'sammy', '1449', '27', '', '419', '', '0', '38704', 'COPRA', 'Basilan'),
(595, '2023-06-05', '488', 'abdulgapor', '2522', '27.50', '', '693.55', '', '0', '68661.45', 'COPRA', 'Basilan'),
(596, '2023-06-05', '41269', 'excess wet rubber payment', '', '', '', '', '', '', '57000', 'WET RUBBER', 'Basilan'),
(597, '2023-06-05', '524', 'ruben ramos', '2547', '51', '', '90000', '', '0', '39897', 'WET RUBBER', 'Basilan'),
(598, '2023-06-05', '482', 'alih', '6504', '28', '', '', '', '0', '182112', 'WET RUBBER', 'Basilan'),
(599, '2023-06-06', '490', 'satar', '2139', '28', '', '628', '', '0', '59264', 'COPRA', 'Basilan'),
(600, '2023-06-06', '527', 'charly cawley', '4130', '52', '', '150000', '', '0', '64760', 'BALES', 'Basilan'),
(601, '2023-06-06', '489', 'mudz', '2442', '28', '', '711', '', '0', '67665', 'COPRA', 'Basilan'),
(602, '2023-06-06', '493', 'datu', '1051', '29', '', '334', '', '0', '30145', 'COPRA', 'Basilan'),
(603, '2023-06-06', '491', 'alih', '3353', '28', '', '967', '', '0', '92917', 'COPRA', 'Basilan'),
(604, '2023-06-06', '41273', 'mudzkier abdurahman', '', '', '', '', '', '', '21700', 'WET RUBBER', 'Basilan'),
(605, '2023-06-06', '523', 'jarwin garcia', '4602', '51', '', '209100', '', '0', '25602', 'BALES', 'Basilan'),
(606, '2023-06-06', '526', 'epigil moleje', '1832.86', '51', '', '', '', '0', '93475.86', 'WET RUBBER', 'Basilan'),
(607, '2023-06-07', '494', 'martin', '3082', '28', '', '862.96', '', '0', '85433.04', 'COPRA', 'Basilan'),
(608, '2023-06-07', '492', 'ibrahim', '1119', '27', '', '302.13', '', '0', '29910.87', 'COPRA', 'Basilan'),
(609, '2023-06-07', '495', 'ibrahim', '2020', '27', '', '573', '', '0', '53967', 'COPRA', 'Basilan'),
(610, '2023-06-07', '496', 'satar', '1133', '27.50', '', '340', '', '0', '30817.5', 'COPRA', 'Basilan'),
(611, '2023-06-07', '153401', 'perez', '35', '24', '', '', '', '0', '840', 'WET RUBBER', 'Basilan'),
(612, '2023-06-07', '41308', 'louie delos reyes', '3399', '26', '', '80000', '', '0', '8374', 'WET RUBBER', 'Basilan'),
(613, '2023-06-07', '534', 'louie delos reyes', '1983', '52', '', '90404', '', '0', '12712', 'WET RUBBER', 'Basilan'),
(614, '2023-06-07', '535', 'jimroy McClintock', '2874', '51', '', '140000', '', '0', '6574', 'WET RUBBER', 'Basilan'),
(615, '2023-06-12', '497', 'tats', '2229', '28', '', '624.12', '', '0', '61787.88', 'COPRA', 'Basilan'),
(616, '2023-06-07', '498', 'alih', '806', '28', '', '254', '', '0', '22314', 'COPRA', 'Basilan'),
(617, '2023-06-07', '499', 'maturan', '3095', '27.50', '', '879', '', '0', '84233.5', 'COPRA', 'Basilan'),
(618, '2023-06-08', '701', 'datu', '3665', '29', '', '1062.85', '', '0', '105222.15', 'COPRA', 'Basilan'),
(619, '2023-06-08', '0702', 'amin', '6106', '28.50', '', '1240.51', '50000', '0', '122780.49', 'COPRA', 'Basilan'),
(620, '2023-06-09', '703', 'ONS', '1902', '28', '', '532.56', '', '0', '52723.44', 'COPRA', 'Basilan'),
(621, '2023-06-09', '623', 'DURUDIN', '1539', '27.50', '', '416', '', '0', '41906.5', 'COPRA', 'Basilan'),
(622, '2023-06-09', '621', 'IBRAHIM', '1525', '27', '', '411.75', '', '0', '40763.25', 'COPRA', 'Basilan'),
(623, '2023-06-09', '704', 'MUDZ', '1532', '28', '', '457', '', '0', '42439', 'COPRA', 'Basilan'),
(624, '2023-06-09', '537', 'CHARLY CAWLEY', '1600', '52', '', '', '', '0', '83200', 'BALES', 'Basilan'),
(625, '2023-06-09', '537', 'CHARLY CAWLEY', '2775', '50', '', '130000', '', '0', '8750', 'BALES', 'Basilan'),
(626, '2023-06-09', '41136', 'ABDULKARIM DOMPOL', '', '', '', '', '', '', '33413', 'WET RUBBER', 'Basilan'),
(627, '2023-06-09', '153404', 'EDWIN', '590', '27', '', '', '', '0', '15930', 'WET RUBBER', 'Basilan'),
(628, '2023-06-09', '153402', 'ISTAM', '351', '27', '', '', '', '0', '9477', 'WET RUBBER', 'Basilan'),
(629, '2023-06-09', '153403', 'PAHAD', '65', '27', '', '', '', '0', '1755', 'WET RUBBER', 'Basilan'),
(630, '2023-06-10', '153414', 'LANDO', '132', '28', '', '', '', '0', '3696', 'WET RUBBER', 'Basilan'),
(632, '2023-06-10', '629', 'IBRAHIM ISMAEL', '2628', '28', '', '735.84', '', '0', '72848.16', 'COPRA', 'Basilan'),
(633, '2023-06-10', '41310', 'NENET COSTAN', '', '', '', '', '', '', '32030', 'WET RUBBER', 'Basilan'),
(634, '2023-06-10', '153415', 'BALTAZAR', '359', '28', '', '', '', '0', '10052', 'WET RUBBER', 'Basilan'),
(635, '2023-06-10', '533', 'JARWIN GARCIA', '4953.31', '51', '', '212670', '', '0', '39948.81000000003', 'BALES', 'Basilan'),
(636, '2023-06-10', '624', 'ARSENIO', '693.77', '27', '', '208', '', '0', '18523.79', 'COPRA', 'Basilan'),
(637, '2023-06-10', '625', 'IBRAHIM', '1283', '27', '', '346.41', '', '0', '34294.59', 'COPRA', 'Basilan'),
(638, '2023-06-10', '626', 'ADHAM', '2371', '27', '', '640.17', '', '0', '63376.83', 'COPRA', 'Basilan'),
(639, '2023-06-12', '713', 'IBRAHIM', '2012', '27', '', '543.24', '', '0', '53780.76', 'COPRA', 'Basilan'),
(640, '2023-06-12', '', '5026.819', '5026', '28', '', '81107.28', '', '0', '59620.72', 'COPRA', 'Basilan'),
(641, '2023-06-12', '41365', 'AMIN ABUBAKAR', '1605', '27', '', '', '', '0', '43335', 'WET RUBBER', 'Basilan'),
(642, '2023-06-12', '41367', 'ALIH', '', '', '', '', '', '', '1359', 'COPRA', 'Basilan');

-- --------------------------------------------------------

--
-- Table structure for table `moisture_table`
--

CREATE TABLE `moisture_table` (
  `id` int(11) NOT NULL,
  `moisture_reading` varchar(20) NOT NULL,
  `discount_factor` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `source_type` varchar(255) NOT NULL,
  `recording_id` int(11) DEFAULT NULL,
  `bales_type` varchar(255) DEFAULT NULL,
  `kilo_per_bale` float DEFAULT NULL,
  `rubber_weight` float DEFAULT NULL,
  `number_bales` float DEFAULT NULL,
  `remaining_bales` int(11) NOT NULL,
  `bales_excess` float DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `date_produced` date DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `source` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `planta_bales_production`
--

INSERT INTO `planta_bales_production` (`bales_prod_id`, `source_type`, `recording_id`, `bales_type`, `kilo_per_bale`, `rubber_weight`, `number_bales`, `remaining_bales`, `bales_excess`, `status`, `date_produced`, `description`, `source`) VALUES
(1, 'Produced', 1, 'SPR-10', 35, 3500, 100, 0, 0, 'Container', NULL, 'Export', 'Basilan'),
(2, 'Produced', 1, 'SPR-20', 35, 2785, 79, 0, 20, 'Container', NULL, 'Manhattan', 'Basilan'),
(5, 'Produced', 3, 'SPR-10', 33.33, 4299.57, 129, 0, 0, 'Container', NULL, 'SHOWA', 'Basilan'),
(6, 'Produced', 4, 'SPR-10', 35, 1015, 29, 0, 0, 'Container', NULL, 'Export', 'Basilan'),
(7, 'Produced', 4, 'SPR-20', 35, 1243, 35, 0, 18, 'Container', NULL, 'Manhattan', 'Basilan'),
(8, 'Produced', 5, 'SPR-10', 33.33, 1151.22, 34, 0, 18, 'Container', NULL, 'Showa', 'Basilan'),
(13, 'Produced', 6, 'SPR-10', 35, 2870, 82, 0, 0, 'Container', NULL, 'Export', 'Basilan'),
(14, 'Produced', 6, 'SPR-20', 35, 4495, 128, 0, 15, 'Container', NULL, 'Manhattan', 'Basilan'),
(22, 'Produced', 13, 'SPR-20', 35, 7420, 212, 0, 0, 'Container', NULL, 'MANHATTAN', 'Basilan'),
(23, 'Produced', 13, 'SPR-20', 35, 759, 21, 0, 24, 'Container', NULL, 'MANHATTAN', 'Basilan'),
(24, 'Produced', 7, 'SPR-10', 33.33, 199.98, 6, 0, 0, 'Container', NULL, 'SHOWA', 'Basilan'),
(25, 'Produced', 7, 'SPR-20', 35, 179, 5, 0, 4, 'Container', NULL, 'EXPORT', 'Basilan'),
(28, 'Produced', 2, 'SPR-10', 35, 2800, 80, 0, 0, 'Container', NULL, 'Export', 'Basilan'),
(29, 'Produced', 2, 'SPR-20', 35, 7257, 207, 0, 12, 'Container', NULL, 'Manhattan', 'Basilan'),
(30, 'Produced', 9, 'SPR-10', 33.33, 833.25, 25, 0, 0, 'Container', NULL, 'SHOWA', 'Basilan'),
(31, 'Produced', 9, 'SPR-10', 35, 466, 13, 0, 11, 'Container', NULL, 'EXPORT', 'Basilan'),
(32, 'Produced', 11, 'SPR-10', 33.33, 3299.67, 99, 0, 0, 'Container', NULL, 'SHOWA', 'Basilan'),
(33, 'Produced', 11, 'SPR-20', 35, 840, 24, 0, 0, 'Container', NULL, 'EXPORT', 'Basilan'),
(34, 'Produced', 21, 'SPR-20', 35, 1108, 31, 0, 23, 'Container', NULL, 'MANHATTAN', 'Basilan'),
(35, 'Produced', 17, 'SPR-20', 35, 2835, 81, 0, 0, 'Container', NULL, 'MANHATTAN', 'Basilan'),
(36, 'Produced', 17, 'SPR-10', 35, 1767, 50, 0, 17, 'Container', NULL, 'EXPORT', 'Basilan'),
(37, 'Produced', 52, 'SPR-10', 35, 980, 28, 0, 0, 'Container', NULL, 'EXPORT', 'Basilan'),
(38, 'Produced', 52, 'SPR-20', 35, 459, 13, 0, 4, 'Container', NULL, 'MANHATTAN', 'Basilan'),
(41, 'Produced', 12, 'SPR-10', 33.33, 4366.23, 131, 0, 0, 'Container', NULL, 'SHOWA', 'Basilan'),
(42, 'Produced', 53, 'SPR-10', 35, 420, 12, 0, 0, 'Container', NULL, 'MANHATTAN', 'Basilan'),
(43, 'Produced', 53, 'SPR-20', 33.33, 1412.86, 42, 0, 13, 'Container', NULL, 'SHOWA', 'Basilan'),
(57, 'Produced', 23, 'SPR-10', 35, 525, 15, 0, 0, 'Container', NULL, 'EXPORT', 'Basilan'),
(58, 'Produced', 23, 'SPR-20', 35, 924, 26, 0, 14, 'Container', NULL, 'MANHATTAN', 'Basilan'),
(59, 'Produced', 10, 'SPR-20', 35, 770, 22, 0, 0, 'Container', NULL, 'MANHATTAN', 'Basilan'),
(60, 'Produced', 10, 'SPR-10', 35, 1051, 30, 0, 1, 'Container', NULL, 'EXPORT', 'Basilan'),
(61, 'Produced', 14, 'SPR-10', 33.33, 2170, 62, 0, 0, 'Container', NULL, 'SHOWA', 'Basilan'),
(62, 'Produced', 14, 'SPR-10', 35, 771, 22, 0, 1, 'Container', NULL, 'DUNLOP', 'Basilan'),
(66, 'Produced', 24, 'SPR-20', 35, 2874, 82, 0, 4, 'Container', NULL, 'MANHATTAN', 'Basilan'),
(68, 'Produced', 57, 'SPR-20', 35, 1983, 56, 0, 23, 'Container', NULL, 'MANHATTAN', 'Basilan'),
(70, 'Produced', 18, 'SPR-10', 33.33, 233.31, 7, 0, 0, 'Container', NULL, 'SHOWA', 'Basilan'),
(71, 'Produced', 18, 'SPR-20', 35, 4720, 134, 4, 30, 'Produced', NULL, 'MANHATTAN', 'Basilan'),
(72, 'Produced', 60, 'SPR-20', 35, 946, 27, 0, 1, 'Container', NULL, 'MANHATTAN', 'Basilan'),
(73, 'Produced', 8, 'SPR-20', 35, 280, 8, 0, 0, 'Container', NULL, 'EXPORT', 'Basilan'),
(74, 'Produced', 8, 'SPR-10', 33.33, 219.98, 6, 0, 20, 'Container', NULL, 'SHOWA', 'Basilan'),
(81, 'Produced', 16, 'SPR-20', 35, 4550, 130, 0, 0, 'Container', NULL, 'MANHATTAN', 'Basilan'),
(82, 'Produced', 16, 'SPR-10', 33.33, 1986.47, 59, 0, 20, 'Container', NULL, 'SHOWA', 'Basilan'),
(85, 'Produced', 15, 'SPR-20', 35, 25130, 718, 718, 0, 'Produced', NULL, 'MANHATTAN', 'Basilan'),
(86, 'Produced', 15, 'SPR-10', 35, 700, 20, 20, 0, 'Produced', NULL, 'EXPORT', 'Basilan'),
(87, 'Produced', 19, 'SPR-10', 35, 315, 9, 9, 0, 'Produced', NULL, 'EXPORT', 'Basilan'),
(88, 'Produced', 66, 'SPR-20', 35, 4445, 127, 0, 0, 'Container', NULL, 'MANHATTAN', 'Basilan'),
(89, 'Produced', 66, 'SPR-10', 35, 1416, 40, 0, 16, 'Container', NULL, 'DUNLOP', 'Basilan'),
(90, 'Produced', 67, 'SPR-20', 35, 1356, 38, 0, 26, 'Container', NULL, 'MANHATTAN', 'Basilan'),
(91, 'Produced', 69, 'SPR-10', 35, 1960, 56, 0, 0, 'Container', NULL, 'SHOWA', 'Basilan'),
(92, 'Produced', 69, 'SPR-20', 33.33, 766.59, 23, 0, 0, 'Container', NULL, 'DUNLOP', 'Basilan'),
(95, 'Produced', 70, 'SPR-20', 35, 1980, 56, 0, 20, 'Container', NULL, '', NULL),
(96, 'Produced', 70, 'SPR-10', 35, 1345.2, 40, 0, 12, 'Container', NULL, '', NULL),
(100, 'Outsource', 74, 'SPR-20', 35, 805, 23, 0, 0, 'Container', NULL, '', 'Basilan');

-- --------------------------------------------------------

--
-- Table structure for table `planta_recording`
--

CREATE TABLE `planta_recording` (
  `recording_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `purchased_id` int(11) DEFAULT NULL,
  `trans_type` varchar(255) DEFAULT NULL,
  `prod_type` varchar(255) DEFAULT NULL,
  `supplier` varchar(255) DEFAULT NULL,
  `receiving_date` datetime DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `driver` varchar(255) DEFAULT NULL,
  `truck_num` varchar(255) DEFAULT NULL,
  `weight` int(11) DEFAULT NULL,
  `reweight` int(11) DEFAULT NULL,
  `cuplump_remaining_weight` decimal(10,2) DEFAULT NULL,
  `purchase_cost` decimal(10,2) DEFAULT NULL,
  `production_expense` decimal(10,2) DEFAULT NULL,
  `prod_expense_desc` varchar(255) DEFAULT NULL,
  `total_production_cost` decimal(10,2) DEFAULT NULL,
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
  `wet_inventory_sold` int(11) DEFAULT NULL,
  `source` varchar(255) DEFAULT NULL,
  `milling_cost` decimal(10,2) NOT NULL,
  `recorded_by` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `planta_recording`
--

INSERT INTO `planta_recording` (`recording_id`, `status`, `purchased_id`, `trans_type`, `prod_type`, `supplier`, `receiving_date`, `location`, `driver`, `truck_num`, `weight`, `reweight`, `cuplump_remaining_weight`, `purchase_cost`, `production_expense`, `prod_expense_desc`, `total_production_cost`, `lot_num`, `milling_date`, `drying_date`, `pressing_date`, `production_date`, `completion_date`, `selling_date`, `crumbed_weight`, `produce_total_weight`, `cost_ave`, `dry_weight`, `drc`, `wet_inventory_sold`, `source`, `milling_cost`, `recorded_by`) VALUES
(1, 'Complete', 4, 'SALE', 'SALE', 'KENNYBELL FLOREZ', '2023-05-29 01:42:35', 'LI-MOOK, LAMITAN CITY', 'RAFAEL', '250', 10739, 10739, NULL, 316800.00, 0.00, '', 316800.00, '2', '2023-05-29', NULL, '2023-05-29', '2023-05-29 01:46:53', NULL, NULL, 0, 6285, NULL, NULL, 58.525, NULL, 'Basilan', 12.00, ''),
(2, 'Complete', 41, 'DRY', 'PURCHASE', 'LONG2X SAN JUAN', '2023-05-29 01:53:25', 'LAMITAN CITY', 'RAFAEL', '250', 17500, 17500, NULL, 533021.00, 0.00, '', 533021.00, '18', '2023-05-29', NULL, '2023-05-29', '2023-05-29 01:53:37', NULL, NULL, 0, 10057, NULL, NULL, 57.4686, NULL, 'Basilan', 12.00, ''),
(3, 'Complete', 84, 'DRY', 'PURCHASE', 'CHARLIE CAWLEY', '2023-05-29 02:04:05', 'LAMITAN CITY', 'CAWLEY TRUCK', 'N/A', 8585, 8585, NULL, 223577.64, 0.00, '', 223577.64, 'D', '2023-05-29', NULL, '2023-05-29', '2023-05-29 02:04:19', NULL, NULL, 0, 4299.57, NULL, NULL, 50.0824, NULL, 'Basilan', 12.00, ''),
(4, 'Complete', 53, 'DRY', 'PURCHASE', 'LOUIE DELOS REYES', '2023-05-29 02:07:52', 'PANUNSULAN, ISABELA CITY', 'KULING', '366', 4095, 4095, NULL, 117416.00, 0.00, '', 117416.00, 'M', '2023-05-29', NULL, '2023-05-29', '2023-05-29 02:08:04', NULL, NULL, 0, 2258, NULL, NULL, 55.1404, NULL, 'Basilan', 12.00, ''),
(5, 'Complete', 5, 'SALE', 'SALE', 'JOEL AMAHAN', '2023-05-29 02:13:52', 'BOHE SAPA', 'RAFAEL', '250', 2069, 2055, NULL, 55863.00, 0.00, '', 55863.00, '6', '2023-05-29', NULL, '2023-05-29', '2023-05-29 02:14:04', NULL, NULL, 0, 1151.22, NULL, NULL, 55.6414, NULL, 'Basilan', 12.00, ''),
(6, 'Complete', 13, 'DRY', 'PURCHASE', 'TATA HALAL', '2023-05-29 02:19:03', 'BULINGAN, LAMITAN CITY', 'RAFAEL ', '250', 12335, 12335, NULL, 379297.50, 0.00, '', 379297.50, '3', '2023-05-29', NULL, '2023-05-29', '2023-05-29 02:19:26', NULL, NULL, 0, 7365, NULL, NULL, 59.7081, NULL, 'Basilan', 12.00, ''),
(7, 'Complete', 35, 'SALE', 'SALE', 'EJN PERSONAL', '2023-05-29 06:23:15', 'MALOONG PROCESSING', 'N/A', 'N/A', 719, 719, NULL, 14380.00, 0.00, '', 14380.00, '14', '2023-05-29', NULL, '2023-05-29', '2023-05-29 06:32:09', NULL, NULL, 0, 378.98, NULL, NULL, 52.7093, NULL, 'Basilan', 12.00, ''),
(8, 'Complete', 36, 'SALE', 'SALE', 'MANCOM', '2023-05-29 06:24:59', 'maloong plantation', 'JERRY', '407', 890, 890, NULL, 18690.00, 0.00, '', 18690.00, '13', '2023-05-29', NULL, '2023-06-05', '2023-05-29 06:32:30', NULL, NULL, 0, 499.98, NULL, NULL, 56.1775, NULL, 'Basilan', 12.00, ''),
(9, 'Complete', 34, 'SALE', 'SALE', 'NONONG FURIGAY', '2023-05-29 06:25:56', 'LAMITAN CITY', 'NONONG TRUCK', 'n/a', 2195, 2195, NULL, 69142.00, 0.00, '', 69142.00, '13', '2023-05-29', NULL, '2023-05-31', '2023-05-29 06:34:09', NULL, NULL, 0, 1299.25, NULL, NULL, 59.1913, NULL, 'Basilan', 12.00, ''),
(10, 'Complete', 23, 'SALE', 'SALE', 'DONGGA/ERIC ENRIQUEZ', '2023-05-29 06:30:33', 'BUAHAN, LAMITAN CITY', 'RAFAEL ', '250', 3064, 3064, NULL, 81196.00, 0.00, '', 81196.00, '10', '2023-05-29', NULL, '2023-06-06', '2023-05-29 06:34:38', NULL, NULL, 0, 1821, NULL, NULL, 59.4321, NULL, 'Basilan', 12.00, ''),
(11, 'Complete', 72, 'DRY', 'PURCHASE', 'CHARLIE CAWLEY', '2023-05-29 06:37:01', 'BAROY, LAMITAN CITY', 'CAWLEY TRUCK', 'N/a', 8315, 8315, NULL, 215262.84, 0.00, '', 215262.84, 'E', '2023-05-29', NULL, '2023-05-31', '2023-05-29 06:37:21', NULL, NULL, 0, 4139.67, NULL, NULL, 49.7856, NULL, 'Basilan', 12.00, ''),
(12, 'Complete', 83, 'DRY', 'PURCHASE', 'CHARLIE CAWLEY', '2023-05-29 06:38:21', 'BAROY, LAMITAN CITY', 'CAWLEY TRUCK', 'N/A', 8775, 8775, NULL, 221498.85, 0.00, '', 221498.85, 'F', '2023-05-29', NULL, '2023-06-06', '2023-05-29 06:38:44', NULL, NULL, 0, 4366.23, NULL, NULL, 49.7576, NULL, 'Basilan', 12.00, ''),
(13, 'Complete', 39, 'DRY', 'PURCHASE', 'LONG2X SAN JUAN', '2023-05-29 06:46:27', 'LAMITAN CITY', 'RAFAEL ', '250', 14085, 14085, NULL, 433487.00, 0.00, '', 433487.00, '19', '2023-05-29', NULL, '2023-05-31', '2023-05-29 06:46:44', NULL, NULL, 0, 8179, NULL, NULL, 58.0689, NULL, 'Basilan', 12.00, ''),
(14, 'Complete', 37, 'SALE', 'SALE', 'LEE BROWN', '2023-05-29 06:53:33', 'PANUNSULAN, ISABELA CITY', 'RAFAEL ', '250', 5224, 5224, NULL, 146272.00, 0.00, '', 146272.00, '13', '2023-05-29', NULL, '2023-06-06', '2023-05-29 06:53:51', NULL, NULL, 0, 2941, NULL, NULL, 56.2979, NULL, 'Basilan', 12.00, ''),
(15, 'Pressing', 40, 'SALE', 'SALE', 'hj. Patah', '2023-05-29 06:55:28', 'Bungos, Lamitan City', 'KULING', '366', 46177, 46177, NULL, 1500750.00, 0.00, '', 1500750.00, '1', '2023-05-29', NULL, '2023-06-06', '2023-05-29 08:43:14', NULL, NULL, 0, 25830, NULL, NULL, 55.9369, NULL, 'Basilan', 12.00, ''),
(16, 'Complete', 38, 'DRY', 'PURCHASE', 'LONG2X SAN JUAN', '2023-05-29 06:56:45', 'LAMITAN CITY', 'RAFAEL ', '250', 12410, 12410, NULL, 346432.91, 0.00, '', 346432.91, '20', '2023-05-29', NULL, '2023-06-05', '2023-05-29 06:57:03', NULL, NULL, 0, 6536.47, NULL, NULL, 52.671, NULL, 'Basilan', 12.00, ''),
(17, 'Complete', 6, 'DRY', 'PURCHASE', 'JARWIN GARCIA', '2023-05-29 06:58:07', 'CALVARIO, LAMITAN CITY', 'JARWIN TRUCK', 'N/A', 8200, 8200, NULL, 234702.00, 0.00, '', 234702.00, '8', '2023-05-29', NULL, '2023-06-05', '2023-05-29 06:58:29', NULL, NULL, 0, 4602, NULL, NULL, 56.122, NULL, 'Basilan', 12.00, ''),
(18, 'For Sale', 7, 'DRY', 'PURCHASE', 'JARWIN GARCIA', '2023-05-29 06:59:25', 'CALVARIO, LAMITAN CITY', 'JARWIN TRUCK', 'N/A', 8340, 8340, NULL, 252618.81, 0.00, '', 252618.81, '9', '2023-05-29', NULL, '2023-06-05', '2023-05-29 07:00:00', NULL, NULL, 0, 4953.31, NULL, NULL, 59.3922, NULL, 'Basilan', 12.00, ''),
(19, 'Pressing', 85, 'DRY', 'PURCHASE', 'JARWIN GARCIA', '2023-05-29 08:42:31', 'BALAGTASAN, LAMITAN CITY', 'JARWIN TRUCK', 'N/A', 6615, 6615, NULL, 0.00, 0.00, '', 0.00, '10', '2023-05-29', NULL, '2023-06-11', '2023-05-29 08:42:49', NULL, NULL, 0, 315, NULL, NULL, 4.7619, NULL, 'Basilan', 12.00, ''),
(21, 'Complete', 24, 'DRY', 'PURCHASE', 'RUBEN RAMOS', '2023-05-29 08:49:05', '6KM. ISABELA CITY', 'RUBEN TRUCK', 'N/A', 2113, 2113, NULL, 56508.00, 0.00, '', 56508.00, 'X', '2023-05-29', NULL, '2023-05-31', '2023-05-29 08:49:19', NULL, NULL, 0, 1108, NULL, NULL, 52.4373, NULL, 'Basilan', 12.00, ''),
(22, 'Drying', 39, 'SALE', 'SALE', 'PLANTATION', '2023-05-29 09:04:35', 'MALOONG CANAL', 'KULING', '366', 16864, 16864, NULL, 522784.00, NULL, NULL, NULL, 'A', '2023-06-06', '2023-06-19', NULL, '2023-06-07 00:23:00', NULL, NULL, 0, NULL, NULL, 5000, NULL, NULL, 'Basilan', 12.00, ''),
(23, 'Complete', 1, 'DRY', 'PURCHASE', 'DANNY BARANDINO', '2023-05-29 09:09:16', 'ISABELA CITY', 'RAFAEL ', '250', 2685, 2685, NULL, 72450.00, 0.00, '', 72450.00, '3', '2023-05-29', NULL, '2023-06-06', '2023-05-29 09:09:29', NULL, NULL, 0, 1449, NULL, NULL, 53.9665, NULL, 'Basilan', 12.00, ''),
(24, 'Complete', 75, 'DRY', 'PURCHASE', 'JIMROY MCCLINTOCK', '2023-05-29 09:19:08', 'MALOONG, LAMITAN CITY', 'RAFAEL ', '250', 5504, 4955, NULL, 146574.00, 0.00, '', 146574.00, 'C', '2023-05-29', NULL, '2023-06-06', '2023-05-29 09:19:23', NULL, NULL, 0, 2874, NULL, NULL, 52.2166, NULL, 'Basilan', 12.00, ''),
(25, 'Drying', 44, 'SALE', 'SALE', 'JR CATALLA', '2023-05-30 01:35:06', 'MALOONG CANAL', 'kuling', '366', 2349, 2305, NULL, 65772.00, NULL, NULL, NULL, '1', '2023-06-07', NULL, NULL, '2023-06-07 00:25:45', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'Basilan', 12.00, ''),
(29, 'Drying', 46, 'SALE', 'SALE', 'AREVALO', '2023-05-30 02:50:51', 'COLONIA, LAMITAN CITY', 'rafael ', '250', 660, 660, NULL, 18480.00, NULL, NULL, NULL, '10', '2023-06-07', NULL, NULL, '2023-06-07 00:26:09', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'Basilan', 12.00, ''),
(32, 'Drying', 90, 'DRY', 'PURCHASE', 'JARWIN GARCIA', '2023-05-31 23:42:50', 'CALVARIO, LAMITAN CITY', 'JARWIN TRUCK', 'N/A', 12810, 12810, NULL, 0.00, NULL, NULL, NULL, '11', '2023-06-07', NULL, NULL, '2023-06-07 00:24:19', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'Basilan', 12.00, ''),
(33, 'Drying', 89, 'DRY', 'PURCHASE', 'EPIGIL MOLEJE', '2023-05-31 23:45:20', 'MALOONG SAN JOSE, LAMITAN CITY', 'JERRY', '407', 3800, 3800, NULL, 0.00, NULL, NULL, NULL, 'B', '2023-06-07', NULL, NULL, '2023-06-07 00:21:29', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'Basilan', 12.00, ''),
(35, 'Drying', 88, 'DRY', 'PURCHASE', 'CHARLIE CAWLEY', '2023-06-03 05:10:41', 'LAMITAN CITY', 'CAWLEY DRIVER', 'N/A', 8855, 8855, NULL, 0.00, NULL, NULL, NULL, 'G', '2023-06-07', NULL, NULL, '2023-06-07 00:19:23', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'Basilan', 12.00, ''),
(36, 'Drying', 93, 'DRY', 'PURCHASE', 'LITO PURI', '2023-06-03 05:19:52', 'lamitan', 'LITO PURI TRUCK', 'N/A', 5005, 5005, NULL, 0.00, NULL, NULL, NULL, '15', '2023-06-07', NULL, NULL, '2023-06-08 00:55:14', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'Basilan', 12.00, ''),
(37, 'Drying', 48, 'SALE', 'SALE', 'NONONG FURIGAY', '2023-06-03 05:21:16', 'LAMITAN CITY', 'NONONG FURIGAY TRUCK', 'N/A', 2615, 2615, NULL, 78450.00, NULL, NULL, NULL, '14', '2023-06-06', NULL, NULL, '2023-06-06 08:20:52', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'Basilan', 12.00, ''),
(39, 'Drying', 54, 'SALE', 'SALE', 'EJN PERSONAL', '2023-06-03 06:25:36', 'MALOONG PROCESSING', 'JERRY TRUCK', '499', 812, 812, NULL, 16240.00, NULL, NULL, NULL, '15', '2023-06-06', NULL, NULL, '2023-06-06 08:20:09', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'Basilan', 12.00, ''),
(41, 'Milling', 57, 'SALE', 'SALE', 'JAMES TAN', '2023-06-03 06:35:27', 'ISABELA CITY', 'KULING', '366', 22142, 21250, NULL, 664260.00, NULL, NULL, NULL, '13', '2023-06-19', NULL, NULL, NULL, NULL, NULL, 2000, NULL, NULL, NULL, NULL, NULL, 'Basilan', 12.00, ''),
(43, 'Drying', 47, 'SALE', 'SALE', 'ARCO', '2023-06-04 08:27:45', 'ARCO, LAMITAN CITY', 'KULING', '366', 7788, 7788, NULL, 221958.00, NULL, NULL, NULL, '10', '2023-06-07', NULL, NULL, '2023-06-08 00:55:01', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'Basilan', 12.00, ''),
(44, 'Drying', 99, 'DRY', 'PURCHASE', 'RUBEN RAMOS', '2023-06-04 08:29:17', '6KM. ISABELA CITY', 'RUBEN TRUCK', 'N/A', 2307, 2307, NULL, 0.00, NULL, NULL, NULL, 'Y', '2023-06-07', NULL, NULL, '2023-06-07 00:21:53', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'Basilan', 12.00, ''),
(45, 'Drying', 53, 'SALE', 'SALE', 'EJN BUAHAN', '2023-06-04 08:34:46', 'BUAHAN, LAMITAN CITY', 'RAFAEL ', '250', 1564, 1564, NULL, 31280.00, NULL, NULL, NULL, '15', '2023-06-07', NULL, NULL, '2023-06-07 00:26:47', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'Basilan', 12.00, ''),
(46, 'Drying', 100, 'DRY', 'PURCHASE', 'JARWIN GARCIA', '2023-06-04 08:39:40', 'CALVARIO, LAMITAN CITY', 'JARWIN TRUCK', 'N/A', 10905, 10905, NULL, 0.00, NULL, NULL, NULL, '12', '2023-06-08', NULL, NULL, '2023-06-09 23:36:31', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'Basilan', 12.00, ''),
(47, 'Drying', 97, 'DRY', 'PURCHASE', 'HON. ARLEIGH EISMA', '2023-06-04 08:47:16', 'LAMITAN CITY', 'EISMA TRUCK', 'N/A', 2850, 2850, NULL, 0.00, NULL, NULL, NULL, '20', '2023-06-07', NULL, NULL, '2023-06-07 00:22:18', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'Basilan', 12.00, ''),
(48, 'Drying', 52, 'SALE', 'SALE', 'LEE BROWN', '2023-06-04 08:49:28', 'PANUNSULAN, ISABELA CITY', 'RAFAEL ', '250', 6183, 6183, NULL, 173124.00, NULL, NULL, NULL, '14', '2023-06-09', NULL, NULL, '2023-06-10 08:38:14', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'Basilan', 12.00, ''),
(49, 'Drying', 101, 'DRY', 'PURCHASE', 'TATA HALAL', '2023-06-05 00:00:57', 'BULINGAN, LAMITAN CITY', 'ADUNG', '139', 14790, 14790, NULL, 0.00, NULL, NULL, NULL, '4', '2023-06-07', NULL, NULL, '2023-06-08 23:38:38', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'Basilan', 12.00, ''),
(50, 'Drying', 91, 'DRY', 'PURCHASE', 'JERRY ARIERO', '2023-06-05 01:14:34', 'ULAMI, LAMITAN CITY', 'JERRY TRUCK', 'N/A', 3393, 3393, NULL, 0.00, NULL, NULL, NULL, '4', '2023-06-07', NULL, NULL, '2023-06-07 00:24:49', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'Basilan', 12.00, ''),
(51, 'Drying', 102, 'DRY', 'PURCHASE', 'JERRY ARIERO', '2023-06-05 01:16:39', 'ULAMI, LAMITAN CITY', 'JERRY TRUCK', 'n/a', 2515, 2515, NULL, 0.00, NULL, NULL, NULL, '5', '2023-06-07', NULL, NULL, '2023-06-07 00:25:13', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'Basilan', 12.00, ''),
(52, 'Complete', 23, 'DRY', 'PURCHASE', 'RUBEN RAMOS', '2023-06-05 06:21:02', '6KM. ISABELA CITY', 'RUBEN TRUCK', 'N/A', 2558, 2558, NULL, 73389.00, 0.00, '', 73389.00, 'w', '2023-06-05', NULL, '2023-06-05', '2023-06-05 06:21:27', NULL, NULL, 0, 1439, NULL, NULL, 56.2549, NULL, 'Basilan', 12.00, ''),
(53, 'Complete', 51, 'DRY', 'PURCHASE', 'EPIGIL MOLEJE', '2023-06-05 23:47:29', 'MALOONG SAN JOSE, LAMITAN CITY', 'JERRY TRUCK', '407', 3498, 3498, NULL, 93475.86, 0.00, '', 93475.86, 'A', '2023-06-05', NULL, '2023-06-05', '2023-06-05 23:47:53', NULL, NULL, 0, 1832.86, NULL, NULL, 52.3974, NULL, 'Basilan', 12.00, ''),
(54, 'Drying', 55, 'SALE', 'SALE', 'MANCOM', '2023-06-06 01:07:24', 'maloong plantation', 'JERRY TRUCK', '407', 910, 910, NULL, 19110.00, NULL, NULL, NULL, '14', '2023-06-07', NULL, NULL, '2023-06-07 01:14:43', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'Basilan', 12.00, ''),
(55, 'Drying', 86, 'DRY', 'PURCHASE', 'LOUIE DELOS REYES', '2023-06-07 00:36:59', 'PANUNSULAN, ISABELA CITY', 'RAFAEL ', '250', 4175, 4175, NULL, 0.00, NULL, NULL, NULL, 'O', '2023-06-07', NULL, NULL, '2023-06-07 01:44:43', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'Basilan', 12.00, ''),
(56, 'Milling', 104, 'DRY', 'PURCHASE', ' JIMROY MCCLINTOCK ', '2023-06-07 00:43:52', ' MALOONG, LAMITAN CITY ', ' RAFAEL  ', ' 250 ', 4725, 4725, NULL, 0.00, NULL, NULL, NULL, ' D ', '2023-06-19', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'Basilan', 12.00, ''),
(57, 'Complete', 52, 'DRY', 'PURCHASE', 'LOUIE DELOS REYES', '2023-06-07 01:08:49', 'PANUNSULAN, ISABELA CITY', 'RAFAEL ', '250', 3355, 3355, NULL, 103116.00, 0.00, '', 103116.00, 'N', '2023-06-07', NULL, '2023-06-07', '2023-06-07 01:09:58', NULL, NULL, 0, 1983, NULL, NULL, 59.1058, NULL, 'Basilan', 12.00, ''),
(58, 'Field', 105, 'DRY', 'PURCHASE', 'LOUIE DELOS REYES', '2023-06-07 02:30:57', 'PANUNSULAN, ISABELA CITY', 'RAFAEL ', '250', 3340, 3340, NULL, 0.00, NULL, NULL, NULL, 'P', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'Basilan', 12.00, ''),
(59, 'Drying', 106, 'DRY', 'PURCHASE', 'CHARLIE CAWLEY', '2023-06-07 07:04:22', 'LAMITAN CITY', 'CAWLEY TRUCK', 'N/A', 9090, 9090, NULL, 0.00, NULL, NULL, NULL, 'H', '2023-06-07', NULL, NULL, '2023-06-07 16:01:08', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'Basilan', 12.00, ''),
(60, 'Complete', 2, 'DRY', 'PURCHASE', 'DANNY BARANDINO', '2023-06-07 07:39:59', 'ISABELA CITY', 'KULING', '366', 1730, 1730, NULL, 47300.00, 0.00, '', 47300.00, '2', '2023-06-07', NULL, '2023-06-07', '2023-06-07 07:40:18', NULL, NULL, 0, 946, NULL, NULL, 54.6821, NULL, 'Basilan', 12.00, ''),
(61, 'Milling', 107, 'DRY', 'PURCHASE', 'EPIGIL MOLEJE', '2023-06-08 00:54:46', 'MALOONG SAN JOSE, LAMITAN CITY', 'JERRY TRUCK', '407', 4069, 4069, NULL, 0.00, NULL, NULL, NULL, 'C', '2023-06-19', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'Basilan', 12.00, ''),
(62, 'Field', 60, 'SALE', 'SALE', ' JOEL AMAHAN ', '2023-06-10 04:40:37', ' BOHE SAPA ', ' RAFAEL ', ' 250 ', 1904, 1920, NULL, 0.00, NULL, NULL, NULL, ' 7 ', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'Basilan', 12.00, ''),
(63, 'Field', 109, 'DRY', 'PURCHASE', 'JARWIN GARCIA', '2023-06-13 00:24:54', 'CALVARIO, LAMITAN CITY', 'JARWIN TRUCK', 'N/A', 13860, 13860, NULL, 0.00, NULL, NULL, NULL, '13', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'Basilan', 0.00, ''),
(64, 'Field', 108, 'DRY', 'PURCHASE', 'TATA HALAL', '2023-06-13 00:25:42', 'BULINGAN, LAMITAN CITY', 'RAFAEL ', '250', 9180, 9180, NULL, 0.00, NULL, NULL, NULL, '6', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'Basilan', 0.00, ''),
(65, 'Field', 110, 'DRY', 'PURCHASE', 'JERRY ARIERO', '2023-06-13 00:31:28', 'ULAMI, LAMITAN CITY', 'JERRY TRUCK', 'N/A', 1906, 1906, NULL, 0.00, NULL, NULL, NULL, '6', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'Basilan', 0.00, ''),
(66, 'Complete', 5, 'DRY', 'PURCHASE', 'JARWIN GARCIA', '2023-06-13 05:57:29', 'CALVARIO, LAMITAN CITY', 'JARWIN TRUCK', 'NA', 9885, 9885, NULL, 298911.00, 0.00, '', 298911.00, '7', '2023-06-13', NULL, '2023-06-13', '2023-06-13 05:57:51', NULL, NULL, 0, 5861, NULL, NULL, 59.2919, NULL, 'Basilan', 0.00, ''),
(67, 'Complete', 40, 'DRY', 'PURCHASE', 'JERRY ARIERO', '2023-06-13 06:09:22', 'ULAMI, LAMITAN CITY', 'JERRY TRUCK', 'N/A', 2075, 2075, NULL, 67800.00, 0.00, '', 67800.00, '3', '2023-06-13', NULL, '2023-06-13', '2023-06-13 06:09:42', NULL, NULL, 0, 1356, NULL, NULL, 65.3494, NULL, 'Basilan', 0.00, ''),
(68, 'Field', 62, 'SALE', 'SALE', 'EJN STA. CLARA', '2023-06-13 07:10:52', 'STA. CLARA, LAMITAN CITY', 'RAFAEL ', '250', 17116, 17116, NULL, 436458.00, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'Basilan', 0.00, ''),
(69, 'Complete', 112, 'DRY', 'PURCHASE', 'RONIE VILDAD', '2023-06-18 09:09:43', 'MALOONG, LAMITAN CITY', 'JAYSON', 'N/A', 5000, 4999, NULL, 141782.68, 200.00, 'LABOR', 141982.68, '34', '2023-06-18', NULL, '2023-06-18', '2023-06-18 09:10:24', NULL, NULL, 0, 2726.59, NULL, NULL, 54.5318, NULL, 'Basilan', 12.00, ''),
(70, 'Complete', 113, 'DRY', 'PURCHASE', 'NENETH COSTAN', '2023-06-19 14:24:49', 'TABIAWAN, ISABELA CITY', 'ABC', 'CDE', 5000, 5000, NULL, 166260.00, 2.00, 'Labor, diesel (25L@Php10)', 166262.00, 'D', '2023-06-19', NULL, '2023-06-19', '2023-06-19 14:27:24', NULL, NULL, 5000, 3325.2, NULL, NULL, 66.504, NULL, 'Basilan', 12.00, ''),
(74, 'Complete', 0, 'OUTSOURCE', 'SALE', 'RONALD', '2023-06-30 00:00:00', 'LAMITAN', 'LYKA', 'ASDJK2', 805, 805, NULL, 166260.00, 200.00, 'LABOR', 166260.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 805, NULL, NULL, 100, NULL, 'Basilan', 0.00, 'Raquel Bais');

-- --------------------------------------------------------

--
-- Table structure for table `planta_recording_logs`
--

CREATE TABLE `planta_recording_logs` (
  `planta_logs_id` int(11) NOT NULL,
  `recording_id` int(11) NOT NULL,
  `purchased_id` int(11) DEFAULT NULL,
  `prd_type` varchar(255) DEFAULT NULL,
  `supplier` varchar(255) DEFAULT NULL,
  `receiving_date` datetime DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `driver` varchar(255) DEFAULT NULL,
  `truck_num` varchar(255) DEFAULT NULL,
  `weight` int(11) DEFAULT NULL,
  `reweight` int(11) DEFAULT NULL,
  `cuplump_remaining_weight` decimal(10,2) DEFAULT NULL,
  `purchase_cost` decimal(10,2) DEFAULT NULL,
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
  `wet_inventory_sold` int(11) DEFAULT NULL,
  `source` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Triggers `planta_recording_logs`
--
DELIMITER $$
CREATE TRIGGER `planta_trigger` AFTER UPDATE ON `planta_recording_logs` FOR EACH ROW BEGIN
    INSERT INTO planta_recording_logs (recording_id, purchased_id, supplier, receiving_date, location, driver, truck_num, weight, reweight, cuplump_remaining_weight, purchase_cost, status, lot_num, milling_date, drying_date, pressing_date, production_date, completion_date, selling_date, crumbed_weight, produce_total_weight, cost_ave, dry_weight, drc, wet_inventory_sold)
    VALUES (NEW.recording_id, NEW.purchased_id, NEW.supplier, NEW.receiving_date, NEW.location, NEW.driver, NEW.truck_num, NEW.weight, NEW.reweight, NEW.cuplump_remaining_weight,NEW.purchase_cost, NEW.status, NEW.lot_num, NEW.milling_date, NEW.drying_date, NEW.pressing_date, NEW.production_date, NEW.completion_date, NEW.selling_date, NEW.crumbed_weight, NEW.produce_total_weight, NEW.cost_ave, NEW.dry_weight, NEW.drc, NEW.wet_inventory_sold);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_category`
--

CREATE TABLE `purchase_category` (
  `id` int(11) NOT NULL,
  `category` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rubber_cashadvance`
--

INSERT INTO `rubber_cashadvance` (`id`, `seller`, `amount`, `category`, `date`, `type`, `loc`) VALUES
(1, 'CHARLIE CAWLEY', 130000, 'Rubber', '2023-05-25', 'BALES', 'Basilan'),
(2, 'CHARLIE CAWLEY', 150000, 'Rubber', '2023-05-31', 'BALES', 'Basilan'),
(3, 'LEE BROWN', 200000, 'Rubber', '2023-06-03', 'WET', 'Basilan'),
(4, 'LOUIE DELOS REYES', 81433.2, 'Rubber', '2023-06-03', 'BALES', 'Basilan');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rubber_seller`
--

INSERT INTO `rubber_seller` (`id`, `name`, `address`, `contact`, `cash_advance`, `bales_cash_advance`, `loc`) VALUES
(2, 'RUBEN RAMOS', '6KM. ISABELA CITY', '', 0, 0, 'Basilan'),
(3, 'RASHID AMILIN', 'SAYUGAN, LAMITAN CITY', '', 0, 0, 'Basilan'),
(4, 'NENETH COSTAN', 'TABIAWAN, ISABELA CITY', '', 0, 0, 'Basilan'),
(5, 'AREVALO', 'COLONIA, LAMITAN CITY', '', 0, 0, 'Basilan'),
(6, 'TANY SULAYMAN', 'SAYUGAN, LAMITAN CITY', '', 0, 0, 'Basilan'),
(7, 'EPIGIL MOLEJE', 'MALOONG SAN JOSE, LAMITAN CITY', '', 0, 0, 'Basilan'),
(8, 'JESSICA EISMA FLOREZ', 'LAMITAN CITY', '', 0, 0, 'Basilan'),
(9, 'PLANTATION', 'MALOONG CANAL', '', 0, 0, 'Basilan'),
(10, 'LEE BROWN', '', 'PANUNSULAN, ISABELA CITY', 0, 0, 'Basilan'),
(12, 'RONIE VILDAD', 'MALOONG, LAMITAN CITY', '', 0, 0, 'Basilan'),
(13, 'JAMES TAN', 'ISABELA CITY', '', 0, 0, 'Basilan'),
(14, 'LITO PURI', 'lamitan', '', 0, 0, 'Basilan'),
(15, 'SAMAN AWALIN', 'SAYUGAN, LAMITAN CITY', '', 0, 0, 'Basilan'),
(16, 'JIMROY MCCLINTOCK', 'MALOONG, LAMITAN CITY', '', 0, 0, 'Basilan'),
(17, 'ALIPIO', 'LOOK, LAMITAN CITY', '', 0, 0, 'Basilan'),
(18, 'NONONG FURIGAY', 'LAMITAN CITY', '', 0, 0, 'Basilan'),
(19, 'KENNYBELL FLOREZ', 'LI-MOOK, LAMITAN CITY', '', 0, 0, 'Basilan'),
(20, 'RENZ MEDINA', 'BUAHAN, LAMITAN CITY', '', 0, 0, 'Basilan'),
(21, 'BINSYO', 'BUAHAN, LAMITAN CITY', '', 0, 0, 'Basilan'),
(22, 'DONGGA/ERIC ENRIQUEZ', 'BUAHAN, LAMITAN CITY', '', 0, 0, 'Basilan'),
(23, 'LEE BROWN', 'PANUNSULAN, ISABELA CITY', '', 0, 0, 'Basilan'),
(24, 'CHARLIE CAWLEY', 'LAMITAN CITY', '', 0, 0, 'Basilan'),
(25, 'JUN  MCCLINTOCK', 'BINUANGAN, ISABELA CITY', '', 0, 0, 'Basilan'),
(26, 'JOEL AMAHAN', 'BOHE SAPA', '', 0, 0, 'Basilan'),
(27, 'ARCO', 'ARCO, LAMITAN CITY', '', 0, 0, 'Basilan'),
(28, 'LOUIE DELOS REYES', 'PANUNSULAN, ISABELA CITY', '', 0, 0, 'Basilan'),
(29, 'KIM AWALIN', 'SAYUGAN, LAMITAN CITY', '', 0, 0, 'Basilan'),
(30, 'AMIN ABUBAKAR', 'TUBURAN', '', 0, 0, 'Basilan'),
(31, 'HARI SABTAL', 'SAYUGAN, LAMITAN CITY', '', 0, 0, 'Basilan'),
(32, 'SANDRA DUMDUM', 'LAMITAN CITY', '', 0, 0, 'Basilan'),
(33, 'INFANTE', 'ISABELA CITY', '', 0, 0, 'Basilan'),
(34, 'CRISTOPHER CENIZA', 'ISABELA CITY', '', 0, 0, 'Basilan'),
(35, 'ronald', '', '', 0, 0, 'Basilan'),
(36, 'FRANCINE', 'BUAHAN, LAMITAN CITY', '', 0, 0, 'Basilan'),
(37, 'TUWA', 'LAMITAN CITY', '', 0, 0, 'Basilan'),
(38, 'ESMERALDO', 'ISABELA CITY', '', 0, 0, 'Basilan'),
(39, 'LONG2X SAN JUAN', 'LAMITAN CITY', '', 0, 0, 'Basilan'),
(40, 'TATA HALAL', 'BULINGAN, LAMITAN CITY', '', 0, 0, 'Basilan'),
(41, 'JERRY ARIERO', 'ULAMI, LAMITAN CITY', '', 0, 0, 'Basilan'),
(42, 'JARWIN GARCIA', 'CALVARIO, LAMITAN CITY', '', 0, 0, 'Basilan'),
(43, 'JENG ENRIQUEZ', 'BUAHAN, LAMITAN CITY', '', 0, 0, 'Basilan'),
(44, '', '', '', 0, 0, 'Basilan'),
(45, 'DANNY BARANDINO', 'ISABELA CITY', '', 0, 0, 'Basilan'),
(46, 'mancom', 'MALOONG CANAL', '', 0, 0, 'Basilan'),
(47, 'MANCOM', 'maloong plantation', '', 0, 0, 'Basilan'),
(48, 'LARBECO', 'LARBECO, LAMITAN CITY', '', 0, 0, 'Basilan'),
(49, 'EJN BUYING', 'LAMITAN CITY', '', 0, 0, 'Basilan'),
(50, 'EJN LOUIE ', 'LAMITAN CITY', '', 0, 0, 'Basilan'),
(51, 'ANDREW PAMARAN', 'LAMITAN CITY', '', 0, 0, 'Basilan'),
(52, 'EJN BUAHAN', 'BUAHAN, LAMITAN CITY', '', 0, 0, 'Basilan'),
(53, 'EJN PERSONAL', 'MALOONG PROCESSING', '', 0, NULL, 'Basilan'),
(54, 'HON. ARLEIGH EISMA', 'LAMITAN CITY', '', NULL, NULL, 'Basilan'),
(55, 'hj. Patah', 'Bungos, Lamitan City', '', 0, NULL, 'Basilan'),
(56, 'MANCOM', 'maloong plantation', '', 0, NULL, 'Basilan'),
(57, 'JR CATALLA', 'MALOONG CANAL', '', 0, NULL, 'Basilan'),
(58, 'EJN STA. CLARA', 'STA. CLARA, LAMITAN CITY', '', 0, NULL, 'Basilan'),
(59, 'RONALD', 'DAVAO', '0923213', 0, NULL, 'Kidapawan');

-- --------------------------------------------------------

--
-- Table structure for table `rubber_transaction`
--

CREATE TABLE `rubber_transaction` (
  `id` int(11) NOT NULL,
  `invoice` int(255) DEFAULT NULL,
  `contract` varchar(200) DEFAULT NULL,
  `date` varchar(200) DEFAULT NULL,
  `seller` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `gross` float DEFAULT NULL,
  `tare` float DEFAULT NULL,
  `net_weight` float DEFAULT NULL,
  `price_1` float DEFAULT NULL,
  `price_2` float DEFAULT NULL,
  `total_weight_1` float DEFAULT NULL,
  `total_weight_2` float DEFAULT NULL,
  `total_amount` float DEFAULT NULL,
  `less` float DEFAULT NULL,
  `amount_paid` float DEFAULT NULL,
  `amount_words` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `loc` varchar(255) DEFAULT NULL,
  `planta_status` int(11) DEFAULT NULL,
  `supplier_type` int(11) DEFAULT NULL,
  `recorded_by` varchar(255) DEFAULT NULL,
  `assumed_drc` float DEFAULT NULL,
  `assumed_baleWeight` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rubber_transaction`
--

INSERT INTO `rubber_transaction` (`id`, `invoice`, `contract`, `date`, `seller`, `address`, `gross`, `tare`, `net_weight`, `price_1`, `price_2`, `total_weight_1`, `total_weight_2`, `total_amount`, `less`, `amount_paid`, `amount_words`, `type`, `loc`, `planta_status`, `supplier_type`, `recorded_by`, `assumed_drc`, `assumed_baleWeight`) VALUES
(3, NULL, 'SPOT', '2023-04-29', 'ARCO', 'ARCO, LAMITAN CITY', 6915, 0, 6915, 28.5, 0, 6915, 0, 197077, 0, 197078, 'One Hundred Ninety Seven Thousand Seventy Seven Peso/s Pesos And Five Centavo/s ', 'WET', 'Basilan', 1, 0, NULL, NULL, NULL),
(4, NULL, 'SPOT', '2023-05-02', 'KENNYBELL FLOREZ', 'LI-MOOK, LAMITAN CITY', 10739, 0, 10739, 29.5, 0, 10739, 0, 316800, 0, 316800, 'Three Hundred Sixteen Thousand Eight Hundred Peso/s Pesos And Five Centavo/s ', 'WET', 'Basilan', 0, 0, NULL, NULL, NULL),
(5, NULL, 'SPOT', '2023-05-10', 'JOEL AMAHAN', 'BOHE SAPA', 2069, 0, 2069, 27, 0, 2069, 0, 55863, 0, 55863, 'Fifty Five Thousand Eight Hundred Sixty Three Peso/s And Centavo/s ', 'WET', 'Basilan', 1, 0, NULL, NULL, NULL),
(8, NULL, 'SPOT', '2023-04-28', 'AREVALO', 'COLONIA, LAMITAN CITY', 1301, 0, 1301, 28, 0, 1301, 0, 36428, 0, 36428, 'Thirty Six Thousand Four Hundred Twenty Eight Peso/s ', 'WET', 'Basilan', 1, 0, NULL, NULL, NULL),
(9, NULL, 'SPOT', '2023-04-23', 'LARBECO', 'LARBECO, LAMITAN CITY', 1046, 0, 1046, 29.3, 0, 1046, 0, 30647, 0, 30647.8, 'Thirty Thousand Six Hundred Forty Seven Peso/s Pesos And Eight Centavo/s ', 'WET', 'Basilan', 1, 0, NULL, NULL, NULL),
(10, NULL, 'SPOT', '2023-04-23', 'DONGGA/ERIC ENRIQUEZ', 'BUAHAN, LAMITAN CITY', 2417, 0, 2417, 25, 0, 2417, 0, 60425, 0, 60425, 'Sixty Thousand Four Hundred Twenty Five Peso/s ', 'WET', 'Basilan', 1, 0, NULL, NULL, NULL),
(11, NULL, 'SPOT', '2023-04-21', 'LARBECO', 'LARBECO, LAMITAN CITY', 18603, 0, 18603, 29.3, 0, 18603, 0, 545067, 0, 545068, 'Five Hundred Forty Five Thousand Sixty Seven Peso/s Pesos And Nine Centavo/s ', 'WET', 'Basilan', 1, 0, NULL, NULL, NULL),
(12, NULL, 'SPOT', '2023-04-20', 'LARBECO', 'LARBECO, LAMITAN CITY', 12140, 0, 12140, 29.3, 0, 12140, 0, 355702, 0, 355702, 'Three Hundred Fifty Five Thousand Seven Hundred Two Peso/s ', 'WET', 'Basilan', 1, 0, NULL, NULL, NULL),
(13, NULL, 'SPOT', '2023-04-17', 'NONONG FURIGAY', 'LAMITAN CITY', 2345, 0, 2345, 31, 0, 2345, 0, 72695, 0, 72695, 'Seventy Two Thousand Six Hundred Ninety Five Peso/s ', 'WET', 'Basilan', 1, 0, NULL, NULL, NULL),
(14, NULL, 'SPOT', '2023-04-15', 'EJN BUYING', 'LAMITAN CITY', 3366, 0, 3366, 25.01, 0, 3366, 0, 84183, 0, 84183.7, 'Eighty Four Thousand One Hundred Eighty Three Peso/s Pesos And Six Six Centavo/s ', 'WET', 'Basilan', 1, 1, NULL, NULL, NULL),
(15, NULL, 'SPOT', '2023-04-13', 'JESSICA EISMA FLOREZ', 'LAMITAN CITY', 3695, 0, 3695, 25, 0, 3695, 0, 92375, 0, 92375, 'Ninety Two Thousand Three Hundred Seventy Five Peso/s ', 'WET', 'Basilan', 1, 0, NULL, NULL, NULL),
(16, NULL, 'SPOT', '2023-04-10', 'EJN LOUIE ', 'LAMITAN CITY', 1408, 0, 1408, 30, 0, 1408, 0, 42240, 0, 42240, 'Forty Two Thousand Two Hundred Forty Peso/s ', 'WET', 'Basilan', 1, 0, NULL, NULL, NULL),
(17, NULL, 'SPOT', '2023-04-10', 'EJN LOUIE ', 'LAMITAN CITY', 3906, 0, 3906, 30, 0, 3906, 0, 117180, 0, 117180, 'One Hundred Seventeen Thousand One Hundred Eighty Peso/s ', 'WET', 'Basilan', 1, 0, NULL, NULL, NULL),
(18, NULL, 'SPOT', '2023-04-03', 'JAMES TAN', 'ISABELA CITY', 5780, 0, 5780, 30, 0, 5780, 0, 173400, 0, 173400, 'One Hundred Seventy Three Thousand Four Hundred Peso/s ', 'WET', 'Basilan', 1, 0, NULL, NULL, NULL),
(19, NULL, 'SPOT', '2023-04-01', 'JAMES TAN', 'ISABELA CITY', 13253, 0, 13253, 30, 0, 13253, 0, 397590, 0, 397590, 'Three Hundred Ninety Seven Thousand Five Hundred Ninety Peso/s ', 'WET', 'Basilan', 1, 0, NULL, NULL, NULL),
(20, NULL, 'SPOT', '2023-04-01', 'ANDREW PAMARAN', 'LAMITAN CITY', 1536, 0, 1536, 26, 0, 1536, 0, 39936, 0, 39936, 'Thirty Nine Thousand Nine Hundred Thirty Six Peso/s ', 'WET', 'Basilan', 1, 0, NULL, NULL, NULL),
(21, NULL, 'SPOT', '2023-04-01', 'NONONG FURIGAY', 'LAMITAN CITY', 2235, 0, 2235, 31, 0, 2235, 0, 69285, 0, 69285, 'Sixty Nine Thousand Two Hundred Eighty Five Peso/s ', 'WET', 'Basilan', 1, 0, NULL, NULL, NULL),
(22, NULL, 'SPOT', '2023-03-31', 'LEE BROWN', '', 6625, 0, 6625, 28, 0, 6625, 0, 185500, 0, 185500, 'One Hundred Eighty Five Thousand Five Hundred Peso/s ', 'WET', 'Basilan', 1, 0, NULL, NULL, NULL),
(23, NULL, 'SPOT', '2023-05-23', 'DONGGA/ERIC ENRIQUEZ', 'BUAHAN, LAMITAN CITY', 3064, 0, 3064, 26.5, 0, 3064, 0, 81196, 0, 81196, 'Eighty One Thousand One Hundred Ninety Six Peso/s ', 'WET', 'Basilan', 0, 0, NULL, NULL, NULL),
(25, NULL, 'SPOT', '2023-03-20', 'ARCO', 'ARCO, LAMITAN CITY', 7548, 0, 7548, 28, 0, 7548, 0, 211344, 100000, 111344, 'One Hundred Eleven Thousand Three Hundred Forty Four Peso/s ', 'WET', 'Basilan', 1, 0, NULL, NULL, NULL),
(26, NULL, 'SPOT', '2023-03-31', 'JOEL AMAHAN', 'BOHE SAPA', 4370, 0, 4370, 28, 0, 4370, 0, 122360, 0, 122360, 'One Hundred Twenty Two Thousand Three Hundred Sixty Peso/s ', 'WET', 'Basilan', 1, 0, NULL, NULL, NULL),
(27, NULL, 'SPOT', '2023-04-05', 'EJN LOUIE ', 'LAMITAN CITY', 3942, 0, 3942, 30, 0, 3942, 0, 118260, 0, 118260, 'One Hundred Eighteen Thousand Two Hundred Sixty Peso/s ', 'WET', 'Basilan', 1, 0, NULL, NULL, NULL),
(34, NULL, 'SPOT', '2023-05-16', 'NONONG FURIGAY', 'LAMITAN CITY', 2195, 0, 2195, 31.5, 0, 2195, 0, 69142, 0, 69142.5, 'Sixty Nine Thousand One Hundred Forty Two Peso/s And Fifty Centavo/s ', 'WET', 'Basilan', 0, 0, 'JANE', NULL, NULL),
(36, NULL, 'SPOT', '2023-05-16', 'MANCOM', 'maloong plantation', 890, 0, 890, 21, 0, 890, 0, 18690, 0, 18690, 'Eighteen Thousand Six Hundred Ninety Peso/s And Centavo/s ', 'WET', 'Basilan', 0, 0, 'JANE', NULL, NULL),
(37, NULL, 'SPOT', '2023-05-20', 'LEE BROWN', 'PANUNSULAN, ISABELA CITY', 5224, 0, 5224, 28, 0, 5224, 0, 146272, 0, 146272, 'One Hundred Forty Six Thousand Two Hundred Seventy Two Peso/s And Centavo/s ', 'WET', 'Basilan', 0, 0, 'JANE', NULL, NULL),
(39, NULL, 'SPOT', '2023-05-29', 'PLANTATION', 'MALOONG CANAL', 16864, 0, 16864, 31, 0, 16864, 0, 522784, 0, 522784, 'Five Hundred Twenty Two Thousand Seven Hundred Eighty Four Peso/s And Centavo/s ', 'WET', 'Basilan', 1, 0, 'JANE', NULL, NULL),
(40, NULL, 'SPOT', '2023-05-29', 'hj. Patah', 'Bungos, Lamitan City', 46177, 0, 46177, 32.5, 0, 46177, 0, 1500750, 0, 1500750, 'One Million Five Hundred Thousand Seven Hundred Fifty Two Peso/s And Fifty Centavo/s ', 'WET', 'Basilan', 0, 0, 'JANE', NULL, NULL),
(44, NULL, 'SPOT', '2023-05-29', 'JR CATALLA', 'MALOONG CANAL', 2349, 0, 2349, 28, 0, 2349, 0, 65772, 0, 65772, 'Sixty Five Thousand Seven Hundred Seventy Two Peso/s And Centavo/s ', 'WET', 'Basilan', 0, 0, 'rubber', NULL, NULL),
(46, NULL, 'SPOT', '2023-05-30', 'AREVALO', 'COLONIA, LAMITAN CITY', 660, 0, 660, 28, 0, 660, 0, 18480, 0, 18480, 'Eighteen Thousand Four Hundred Eighty Peso/s And Centavo/s ', 'WET', 'Basilan', 0, 0, 'JANE', NULL, NULL),
(47, NULL, 'SPOT', '2023-05-30', 'ARCO', 'ARCO, LAMITAN CITY', 7788, 0, 7788, 28.5, 0, 7788, 0, 221958, 250000, -28042, 'Undefined Hundred Twenty Eight Thousand Forty Two Peso/s And Centavo/s ', 'WET', 'Basilan', 0, 0, 'JANE', NULL, NULL),
(48, NULL, 'SPOT', '2023-06-01', 'NONONG FURIGAY', 'LAMITAN CITY', 2615, 0, 2615, 30, 0, 2615, 0, 78450, 0, 78450, 'Seventy Eight Thousand Four Hundred Fifty Peso/s And Centavo/s ', 'WET', 'Basilan', 0, 0, 'JANE', NULL, NULL),
(52, NULL, 'SPOT', '2023-06-03', 'LEE BROWN', 'PANUNSULAN, ISABELA CITY', 6183, 0, 6183, 28, 0, 6183, 0, 173124, 200000, -26876, 'Undefined Hundred Twenty Six Thousand Eight Hundred Seventy Six Peso/s And Centavo/s ', 'WET', 'Basilan', 1, 0, 'JANE', NULL, NULL),
(53, NULL, 'SPOT', '2023-06-01', 'EJN BUAHAN', 'BUAHAN, LAMITAN CITY', 1564, 0, 1564, 20, 0, 1564, 0, 31280, 0, 31280, 'Thirty One Thousand Two Hundred Eighty Peso/s And Centavo/s ', 'WET', 'Basilan', 0, 0, 'JANE', NULL, NULL),
(54, NULL, 'SPOT', '2023-05-31', 'EJN PERSONAL', 'MALOONG PROCESSING', 812, 0, 812, 20, 0, 812, 0, 16240, 0, 16240, 'Sixteen Thousand Two Hundred Forty Peso/s And Centavo/s ', 'WET', 'Basilan', 0, 0, 'JANE', NULL, NULL),
(55, NULL, 'SPOT', '2023-05-31', 'MANCOM', 'maloong plantation', 910, 0, 910, 21, 0, 910, 0, 19110, 0, 19110, 'Nineteen Thousand One Hundred Ten Peso/s And Centavo/s ', 'WET', 'Basilan', 0, 0, 'JANE', NULL, NULL),
(57, NULL, 'SPOT', '2023-06-03', 'JAMES TAN', 'ISABELA CITY', 22142, 0, 22142, 30, 0, 22142, 0, 664260, 0, 664260, 'Six Hundred Sixty Four Thousand Two Hundred Sixty Peso/s And Centavo/s ', 'WET', 'Basilan', 0, 0, 'JANE', NULL, NULL),
(58, NULL, 'SPOT', '2023-05-15', 'EJN PERSONAL', 'MALOONG PROCESSING', 719, 0, 719, 20, 0, 719, 0, 14380, 0, 14380, 'Fourteen Thousand Three Hundred Eighty Peso/s And Centavo/s ', 'WET', 'Basilan', 1, 0, 'JANE', NULL, NULL),
(60, NULL, 'SPOT', '2023-06-10', 'JOEL AMAHAN', 'BOHE SAPA', 1904, 0, 1904, 28, 0, 1904, 0, 53312, 0, 53312, 'Fifty Three Thousand Three Hundred Twelve Peso/s And Centavo/s ', 'WET', 'Basilan', 0, 0, 'jane', NULL, NULL),
(62, NULL, 'SPOT', '2023-06-13', 'EJN STA. CLARA', 'STA. CLARA, LAMITAN CITY', 17116, 0, 17116, 25.5, 0, 17116, 0, 436458, 300000, 136458, 'One Hundred Thirty Six Thousand Four Hundred Fifty Eight Peso/s And Centavo/s ', 'WET', 'Basilan', 0, 0, 'JANE', NULL, NULL),
(63, NULL, NULL, '2023-06-19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Basilan', NULL, NULL, 'rubber', NULL, NULL),
(64, NULL, NULL, '2023-06-19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Basilan', NULL, NULL, 'rubber', NULL, NULL),
(65, NULL, 'SPOT', '2023-07-02', 'RONALD', 'DAVAO', 2333, 12, 2321, 51, 0, 2321, 0, 118371, 0, 118371, 'One Hundred Eighteen Thousand Three Hundred Seventy One Peso/s And Centavo/s ', 'WET', 'Kidapawan', 1, 0, 'Rannie', NULL, NULL),
(66, NULL, 'SPOT', '2023-07-02', 'RONALD', 'DAVAO', 2333, 1232, 1101, 23, 0, 1101, 0, 25323, 0, 25323, 'Twenty Five Thousand Three Hundred Twenty Three Peso/s And Centavo/s ', 'WET', 'Kidapawan', 1, 0, 'Rannie', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sales_cuplump_container`
--

CREATE TABLE `sales_cuplump_container` (
  `container_id` int(11) NOT NULL,
  `van_no` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `loading_date` date NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `recorded_by` varchar(255) NOT NULL,
  `total_cuplump_weight` float NOT NULL,
  `total_cuplump_cost` decimal(10,2) NOT NULL,
  `ave_cuplump_cost` decimal(10,2) NOT NULL,
  `ship_exp` decimal(10,2) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales_cuplump_container`
--

INSERT INTO `sales_cuplump_container` (`container_id`, `van_no`, `location`, `loading_date`, `remarks`, `recorded_by`, `total_cuplump_weight`, `total_cuplump_cost`, `ave_cuplump_cost`, `ship_exp`, `status`) VALUES
(1, 'BASDC', 'zam', '2023-07-02', 'TEST', 'Raquel Bais', 10000, 200000.00, 20.00, 0.00, 'Complete');

-- --------------------------------------------------------

--
-- Table structure for table `sales_cuplump_container_inv`
--

CREATE TABLE `sales_cuplump_container_inv` (
  `cuplump_inventory_id` int(11) NOT NULL,
  `sales_cuplump_id` int(11) NOT NULL,
  `supplier` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `loading_weight` int(255) NOT NULL,
  `cost_type` decimal(10,2) NOT NULL,
  `wet_cost` decimal(10,2) NOT NULL,
  `dry_cost` decimal(10,2) NOT NULL,
  `drc` decimal(10,2) NOT NULL,
  `cuplump_cost` decimal(10,2) NOT NULL,
  `amount_paid` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales_cuplump_container_inv`
--

INSERT INTO `sales_cuplump_container_inv` (`cuplump_inventory_id`, `sales_cuplump_id`, `supplier`, `location`, `loading_weight`, `cost_type`, `wet_cost`, `dry_cost`, `drc`, `cuplump_cost`, `amount_paid`) VALUES
(2, 1, 'MARK TUBAT', 'LAMITAN', 10000, 0.00, 20.00, 0.00, 0.00, 200000.00, 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `sales_cuplump_shipment`
--

CREATE TABLE `sales_cuplump_shipment` (
  `shipment_id` int(11) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `ship_date` date NOT NULL,
  `destination` varchar(255) DEFAULT NULL,
  `source` varchar(255) DEFAULT NULL,
  `vessel` varchar(255) DEFAULT NULL,
  `bill_lading` varchar(255) NOT NULL,
  `freight` decimal(10,2) NOT NULL,
  `loading_unloading` decimal(10,2) NOT NULL,
  `processing_fee` decimal(10,2) NOT NULL,
  `trucking_expense` decimal(10,2) NOT NULL,
  `cranage_fee` decimal(10,2) NOT NULL,
  `miscellaneous` decimal(10,2) NOT NULL,
  `total_shipping_expense` decimal(10,2) NOT NULL,
  `no_containers` int(11) NOT NULL,
  `ship_cost_container` decimal(10,2) NOT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `recorded_by` varchar(255) DEFAULT NULL,
  `total_cuplump_weight` float NOT NULL,
  `total_cuplump_cost` decimal(10,2) NOT NULL,
  `ave_cuplump_cost` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales_cuplump_shipment`
--

INSERT INTO `sales_cuplump_shipment` (`shipment_id`, `type`, `status`, `ship_date`, `destination`, `source`, `vessel`, `bill_lading`, `freight`, `loading_unloading`, `processing_fee`, `trucking_expense`, `cranage_fee`, `miscellaneous`, `total_shipping_expense`, `no_containers`, `ship_cost_container`, `remarks`, `recorded_by`, `total_cuplump_weight`, `total_cuplump_cost`, `ave_cuplump_cost`) VALUES
(0, 'LOCAL', 'In Progress', '2023-07-02', 'ABC', 'CDE', 'ASDASLDK', 'LASKDLK', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0.00, 'TEST', 'Raquel Bais', 0, 0.00, 0.00);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `seller`
--

INSERT INTO `seller` (`id`, `code`, `name`, `address`, `cheque`, `contact`, `cash_advance`) VALUES
(29, '001', 'Test', 'test', '', NULL, NULL),
(30, '002', 'JULMAR', 'lamitan', '', NULL, NULL),
(31, '056', 'adham', '', '', NULL, NULL);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `loc` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `type`, `loc`) VALUES
(1, 'Richard New', 'admin', 'admin', 'admin', 'Basilan'),
(2, 'Mae', 'ledger', 'ledger', 'finance', 'Basilan'),
(3, 'Jane', 'rubber', 'rubber', 'rubber', 'Basilan'),
(4, 'Joseph', 'copra', 'copra', 'copra', 'Basilan'),
(5, 'Jean', 'planta', 'planta', 'planta', 'Basilan'),
(7, 'Cecile', 'cecile', 'cecile', 'rubber', 'Kidapawan'),
(8, 'Jovie', 'Jovie', 'jovie', 'planta', 'Basilan'),
(9, 'Raquel Bais', 'sales', 'sales', 'sales', 'Basilan\r\n'),
(10, 'Rannie', 'rannie', 'planta', 'planta', 'Kidapawan'),
(11, 'Rannie', 'rannie', 'rubber', 'rubber', 'Kidapawan\r\n');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bales_container_record`
--
ALTER TABLE `bales_container_record`
  ADD PRIMARY KEY (`container_id`);

--
-- Indexes for table `bales_container_selection`
--
ALTER TABLE `bales_container_selection`
  ADD PRIMARY KEY (`selected_id`);

--
-- Indexes for table `bales_outsource_purchase`
--
ALTER TABLE `bales_outsource_purchase`
  ADD PRIMARY KEY (`outsource_recording_id`);

--
-- Indexes for table `bales_purchase_inventory`
--
ALTER TABLE `bales_purchase_inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bales_sales_container`
--
ALTER TABLE `bales_sales_container`
  ADD PRIMARY KEY (`sales_container_id`);

--
-- Indexes for table `bales_sales_payment`
--
ALTER TABLE `bales_sales_payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `bales_sales_record`
--
ALTER TABLE `bales_sales_record`
  ADD PRIMARY KEY (`bales_sales_id`);

--
-- Indexes for table `bales_shipment_container`
--
ALTER TABLE `bales_shipment_container`
  ADD PRIMARY KEY (`bs_id`);

--
-- Indexes for table `bales_transaction`
--
ALTER TABLE `bales_transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bale_shipment_record`
--
ALTER TABLE `bale_shipment_record`
  ADD PRIMARY KEY (`shipment_id`);

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
-- Indexes for table `dry_price_transfer`
--
ALTER TABLE `dry_price_transfer`
  ADD PRIMARY KEY (`dry_id`);

--
-- Indexes for table `ejn_rubber_transfer`
--
ALTER TABLE `ejn_rubber_transfer`
  ADD PRIMARY KEY (`ejn_id`);

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
-- Indexes for table `sales_cuplump_container`
--
ALTER TABLE `sales_cuplump_container`
  ADD PRIMARY KEY (`container_id`);

--
-- Indexes for table `sales_cuplump_container_inv`
--
ALTER TABLE `sales_cuplump_container_inv`
  ADD PRIMARY KEY (`cuplump_inventory_id`);

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
-- AUTO_INCREMENT for table `bales_container_record`
--
ALTER TABLE `bales_container_record`
  MODIFY `container_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `bales_container_selection`
--
ALTER TABLE `bales_container_selection`
  MODIFY `selected_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `bales_outsource_purchase`
--
ALTER TABLE `bales_outsource_purchase`
  MODIFY `outsource_recording_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bales_purchase_inventory`
--
ALTER TABLE `bales_purchase_inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `bales_sales_container`
--
ALTER TABLE `bales_sales_container`
  MODIFY `sales_container_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bales_sales_payment`
--
ALTER TABLE `bales_sales_payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bales_sales_record`
--
ALTER TABLE `bales_sales_record`
  MODIFY `bales_sales_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `bales_shipment_container`
--
ALTER TABLE `bales_shipment_container`
  MODIFY `bs_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `bales_transaction`
--
ALTER TABLE `bales_transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `bale_shipment_record`
--
ALTER TABLE `bale_shipment_record`
  MODIFY `shipment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `category_expenses`
--
ALTER TABLE `category_expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `contract_purchase`
--
ALTER TABLE `contract_purchase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `copra_cashadvance`
--
ALTER TABLE `copra_cashadvance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `dry_price_transfer`
--
ALTER TABLE `dry_price_transfer`
  MODIFY `dry_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT for table `ejn_rubber_transfer`
--
ALTER TABLE `ejn_rubber_transfer`
  MODIFY `ejn_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ledger_buahantoppers`
--
ALTER TABLE `ledger_buahantoppers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `ledger_buying_station`
--
ALTER TABLE `ledger_buying_station`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ledger_cashadvance`
--
ALTER TABLE `ledger_cashadvance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=866;

--
-- AUTO_INCREMENT for table `ledger_expenses`
--
ALTER TABLE `ledger_expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=738;

--
-- AUTO_INCREMENT for table `ledger_maloong`
--
ALTER TABLE `ledger_maloong`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `ledger_purchase`
--
ALTER TABLE `ledger_purchase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=643;

--
-- AUTO_INCREMENT for table `moisture_table`
--
ALTER TABLE `moisture_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=461;

--
-- AUTO_INCREMENT for table `planta_bales_production`
--
ALTER TABLE `planta_bales_production`
  MODIFY `bales_prod_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `planta_recording`
--
ALTER TABLE `planta_recording`
  MODIFY `recording_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `planta_recording_logs`
--
ALTER TABLE `planta_recording_logs`
  MODIFY `planta_logs_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchase_category`
--
ALTER TABLE `purchase_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `rubber_cashadvance`
--
ALTER TABLE `rubber_cashadvance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `rubber_contract`
--
ALTER TABLE `rubber_contract`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rubber_seller`
--
ALTER TABLE `rubber_seller`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `rubber_transaction`
--
ALTER TABLE `rubber_transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `sales_cuplump_container`
--
ALTER TABLE `sales_cuplump_container`
  MODIFY `container_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sales_cuplump_container_inv`
--
ALTER TABLE `sales_cuplump_container_inv`
  MODIFY `cuplump_inventory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `seller`
--
ALTER TABLE `seller`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `transaction_record`
--
ALTER TABLE `transaction_record`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
