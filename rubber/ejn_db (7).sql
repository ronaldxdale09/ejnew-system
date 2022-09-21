-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 21, 2022 at 09:23 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.29

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
  `entry` int(100) DEFAULT NULL,
  `net_weight_1` int(100) DEFAULT NULL,
  `net_weight_2` int(100) DEFAULT NULL,
  `kilo_bales_1` int(100) DEFAULT NULL,
  `kilo_bales_2` int(100) DEFAULT NULL,
  `total_bales_1` varchar(255) DEFAULT NULL,
  `total_bales_2` varchar(255) DEFAULT NULL,
  `drc` int(100) DEFAULT NULL,
  `price_1` int(100) DEFAULT NULL,
  `price_2` int(100) DEFAULT NULL,
  `total_amount` int(100) DEFAULT NULL,
  `less` int(100) DEFAULT NULL,
  `amount_paid` int(100) DEFAULT NULL,
  `words_amount` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(1, 'SSS ROGER'),
(2, 'REPAIR & MAIN'),
(3, 'Medical'),
(4, 'Meryenda'),
(5, ''),
(6, 'Subscription');

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

--
-- Dumping data for table `contract_purchase`
--

INSERT INTO `contract_purchase` (`id`, `contract_no`, `seller`, `contract_quantity`, `delivered`, `balance`, `status`, `date`, `price_kg`) VALUES
(18, '2022-001', 'dale ronald', 1234, 1234, 0, 'COMPLETED', '2022-08-11', 29),
(19, '2022-002', 'Kaxandra lyka', 1000, 1000, 0, 'COMPLETED', '2022-08-20', 29),
(20, '2022-003', 'dale ronald', 1000, 1000, 0, 'COMPLETED', '2022-08-26', 30),
(21, '2022-004', 'dale ronald', 2000, 2000, 0, 'COMPLETED', '2022-08-26', 29);

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

--
-- Dumping data for table `copra_cashadvance`
--

INSERT INTO `copra_cashadvance` (`id`, `seller`, `amount`, `category`, `date`, `status`) VALUES
(9, 'dale ronald', '1000', 'copra', '2022-08-18', 'PENDING'),
(10, 'dale ronald', '1000', 'ntc', '2022-08-18', 'PENDING'),
(11, 'dale ronald', '1000', 'copra', '2022-08-26', 'PENDING');

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
(1, '2022-07-31', '888', 'ronald', 'Nenet Buying Station', 'Customer', '77777'),
(3, '2022-07-31', '78787', 'mark', 'Nenet Buying Station', 'Karpentero', '34343'),
(4, '2022-08-03', '3656', 'Mark', 'Sayugan Buying Station', 'Customer', '2000');

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
  `amount` varchar(100) NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `destination` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ledger_expenses`
--

INSERT INTO `ledger_expenses` (`id`, `voucher_no`, `particulars`, `date`, `category`, `amount`, `description`, `remarks`, `destination`) VALUES
(10, '3456', 'Ronald Dale', '2022-02-01', 'COPRA', '3543', NULL, NULL, NULL),
(14, '123456', 'TEST 4', '2022-07-06', 'Medical', '3333', NULL, NULL, NULL),
(15, '30739', 'test 2 ', '2022-07-09', 'REPAIR & MAIN', '3333', NULL, NULL, NULL),
(16, '37563', 'Ronald Dale', '2022-07-31', '', '76878', NULL, NULL, NULL),
(17, '45667', 'mark tubat', '2022-08-03', 'Meryenda', '1000', NULL, NULL, NULL),
(18, '30739', 'PLDT WIFI', '2022-08-09', 'Subscription', '1000', NULL, NULL, NULL),
(19, '23', 'GLOBE WIFI', '2022-07-09', 'Subscription', '1000', NULL, NULL, NULL),
(20, '23232', 'GLOBE WIFI', '2022-08-09', 'Subscription', '1000', NULL, NULL, NULL),
(21, '23232', 'GLOBE PLAN BILL', '2022-08-09', 'Subscription', '2333', NULL, NULL, NULL),
(23, '2442', 'Prime Mover - Arman', '2022-08-08', 'freight', '9550', 'Bales', 'One Way', 'Zamboanga');

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
(2, '2022-08-09', '2323', '2333', 'RONALD DALE ', '23', '53659', '54', '125982', 'Rice', '2232', '123750');

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
(17, '2022-02-26', '232', 'dale ronald', '2300', '15', '30', '30', '', '69000', '34470', 'COFFEE BERRIES'),
(18, '2022-02-26', '1234', 'FUENTEBELLA RONALD DALE', '2343', '50', '30', '50', '', '70290', '117100', 'COPRA');

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
-- Table structure for table `rubber_cashadvance`
--

CREATE TABLE `rubber_cashadvance` (
  `id` int(11) NOT NULL,
  `seller` varchar(255) NOT NULL,
  `amount` float NOT NULL,
  `category` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rubber_contract`
--

INSERT INTO `rubber_contract` (`id`, `contract_no`, `seller`, `contract_quantity`, `delivered`, `balance`, `date`, `price`, `status`, `type`) VALUES
(1, '2022-001', 'Mark Tubat', 1000, 1000, 0, '2022-08-19', 23, 'COMPLETED', NULL),
(2, '2022-002', 'Mark Tubat', 6888, 0, 6888, '2022-08-20', 28, 'PENDING', 'WET'),
(4, '2022-003', 'Mark Tubat', 1000, 0, 1000, '2022-09-15', 29, 'PENDING', 'BALES'),
(5, '2022-004', 'Mark Tubat', 50000, 0, 50000, '2022-09-21', 50, 'PENDING', 'WET'),
(6, '2022-005', 'Mark Tubat', 50000, 0, 50000, '2022-09-21', 50, 'PENDING', 'WET'),
(7, '2022-006', 'Mark Tubat', 50000, 0, 50000, '2022-09-21', 50000, 'PENDING', 'WET'),
(8, '2022-007', 'Mark Tubat', 100000, 0, 100000, '2022-09-21', 59, 'PENDING', 'BALES'),
(9, '2022-008', 'Mark Tubat', 1000, 0, 1000, '2022-09-21', 29, 'PENDING', 'WET');

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
  `bales_cash_advance` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rubber_seller`
--

INSERT INTO `rubber_seller` (`id`, `name`, `address`, `contact`, `cash_advance`, `bales_cash_advance`) VALUES
(1, 'Mark Tubat', 'Titay', '09352232051', 30000, 10000);

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
  `type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rubber_transaction`
--

INSERT INTO `rubber_transaction` (`id`, `invoice`, `contract`, `date`, `seller`, `address`, `gross`, `tare`, `net_weight`, `price_1`, `price_2`, `total_weight_1`, `total_weight_2`, `total_amount`, `less`, `amount_paid`, `amount_words`, `type`) VALUES
(7, 1, 'SPOT', '2022-09-16', 'Mark Tubat', 'Titay', 10000, 2000, 8000, 30, 0, 8000, 0, 240000, 0, 240000, '  peso/s', 'WET');

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
(27, '001', 'dale ronald', 'San Jose Cawa Cawa', '', NULL, '0'),
(28, '002', 'Kaxandra lyka', 'Viscaa', '', NULL, '0');

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
(119, '001', '2022-08-29', 'SPOT', 'dale ronald', 1000, 2333, 1, 2332, 1, 0, 2332, 13, 8.1, -189, 2143, 27, 0, 0, 57861, 0, 0, 57861, 1000, 56861, 'Fifty Six Thousand Eight Hundred Sixty One peso/s', 2143, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `type`) VALUES
(1, 'admin', 'admin', 'admin'),
(2, 'ledger', 'ledger', 'finance'),
(3, 'rubber', 'rubber', 'rubber'),
(4, 'copra', 'copra', 'copra');

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
-- Indexes for table `purchase_category`
--
ALTER TABLE `purchase_category`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category_expenses`
--
ALTER TABLE `category_expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `contract_purchase`
--
ALTER TABLE `contract_purchase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `copra_cashadvance`
--
ALTER TABLE `copra_cashadvance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `ledger_buahantoppers`
--
ALTER TABLE `ledger_buahantoppers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ledger_buying_station`
--
ALTER TABLE `ledger_buying_station`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ledger_cashadvance`
--
ALTER TABLE `ledger_cashadvance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ledger_expenses`
--
ALTER TABLE `ledger_expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `ledger_maloong`
--
ALTER TABLE `ledger_maloong`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ledger_purchase`
--
ALTER TABLE `ledger_purchase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `moisture_table`
--
ALTER TABLE `moisture_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=461;

--
-- AUTO_INCREMENT for table `purchase_category`
--
ALTER TABLE `purchase_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `rubber_contract`
--
ALTER TABLE `rubber_contract`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `rubber_seller`
--
ALTER TABLE `rubber_seller`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rubber_transaction`
--
ALTER TABLE `rubber_transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `seller`
--
ALTER TABLE `seller`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `transaction_record`
--
ALTER TABLE `transaction_record`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
