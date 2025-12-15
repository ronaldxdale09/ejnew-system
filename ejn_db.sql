-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 11, 2025 at 01:19 PM
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
  `status` varchar(255) DEFAULT NULL,
  `total_milling_cost` decimal(10,2) NOT NULL,
  `average_kilo_cost` decimal(10,2) NOT NULL,
  `shipping_expense` decimal(10,2) NOT NULL,
  `shipment_id` int(11) DEFAULT NULL,
  `source` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `contract_price` decimal(10,4) NOT NULL,
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
  `tax_rate` float NOT NULL,
  `tax_amount` decimal(10,2) NOT NULL,
  `amount_paid` decimal(10,2) NOT NULL,
  `unpaid_balance` decimal(10,2) NOT NULL,
  `sales_proceed` decimal(10,2) NOT NULL,
  `overall_cost` decimal(10,2) NOT NULL,
  `gross_profit` decimal(10,2) NOT NULL,
  `recorded_by` varchar(255) NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `total_milling_cost` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `bale_shipment_record`
--

CREATE TABLE `bale_shipment_record` (
  `shipment_id` int(11) NOT NULL,
  `particular` varchar(255) DEFAULT NULL,
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

-- --------------------------------------------------------

--
-- Table structure for table `category_expenses`
--

CREATE TABLE `category_expenses` (
  `id` int(11) NOT NULL,
  `category` varchar(100) NOT NULL,
  `source` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `coffee_inventory`
--

CREATE TABLE `coffee_inventory` (
  `inventory_id` int(11) NOT NULL,
  `coffee_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coffee_production_list`
--

CREATE TABLE `coffee_production_list` (
  `id` int(11) NOT NULL,
  `production_id` int(11) NOT NULL,
  `coffee_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `weight` varchar(11) NOT NULL,
  `total_weight` decimal(11,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coffee_production_record`
--

CREATE TABLE `coffee_production_record` (
  `production_id` int(11) NOT NULL,
  `lot_no` varchar(255) DEFAULT NULL,
  `production_code` varchar(255) NOT NULL,
  `prod_date` date NOT NULL,
  `no_sack` int(11) DEFAULT NULL,
  `entry_weight` float NOT NULL,
  `total_weight` float NOT NULL,
  `recovery_weight` decimal(10,2) NOT NULL,
  `recorded_by` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coffee_products`
--

CREATE TABLE `coffee_products` (
  `coffee_id` int(11) NOT NULL,
  `coffee_name` varchar(255) NOT NULL,
  `weight` varchar(255) NOT NULL,
  `weight_unit` varchar(255) NOT NULL,
  `case_price` decimal(10,2) NOT NULL,
  `case_quantity` int(11) NOT NULL,
  `unit_price` decimal(10,2) NOT NULL,
  `created_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coffee_product_category`
--

CREATE TABLE `coffee_product_category` (
  `category_id` int(11) NOT NULL,
  `coffee_brand` varchar(255) NOT NULL,
  `category_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coffee_sale`
--

CREATE TABLE `coffee_sale` (
  `coffee_sale_id` int(11) NOT NULL,
  `coffee_status` varchar(255) DEFAULT NULL,
  `coffee_date` date DEFAULT NULL,
  `coffee_customer` varchar(255) DEFAULT NULL,
  `coffee_total_amount` decimal(15,2) DEFAULT NULL,
  `coffee_paid` decimal(15,2) DEFAULT NULL,
  `coffee_balance` decimal(15,2) GENERATED ALWAYS AS (`coffee_total_amount` - `coffee_paid`) VIRTUAL,
  `inventoryCheck` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coffee_sale_line`
--

CREATE TABLE `coffee_sale_line` (
  `sale_line_id` int(11) NOT NULL,
  `sale_id` int(11) DEFAULT NULL,
  `coffee_id` varchar(255) DEFAULT NULL,
  `specification` varchar(255) NOT NULL,
  `unit` int(11) DEFAULT NULL,
  `total_qty` int(11) NOT NULL,
  `price` decimal(15,2) DEFAULT NULL,
  `amount` decimal(15,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coffee_sale_payment`
--

CREATE TABLE `coffee_sale_payment` (
  `payment_id` int(11) NOT NULL,
  `sale_id` int(11) NOT NULL,
  `pay_date` date NOT NULL,
  `pay_details` varchar(255) NOT NULL,
  `payAmount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Table structure for table `copra_contract`
--

CREATE TABLE `copra_contract` (
  `id` int(11) NOT NULL,
  `contract_no` varchar(11) NOT NULL,
  `seller` varchar(50) NOT NULL,
  `contract_quantity` varchar(50) NOT NULL,
  `delivered` varchar(50) DEFAULT NULL,
  `balance` decimal(10,2) NOT NULL,
  `status` varchar(10) DEFAULT NULL,
  `date` varchar(10) DEFAULT NULL,
  `price_kg` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `copra_moisture`
--

CREATE TABLE `copra_moisture` (
  `id` int(11) NOT NULL,
  `moisture_reading` varchar(20) NOT NULL,
  `discount_factor` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `copra_seller`
--

CREATE TABLE `copra_seller` (
  `id` int(11) NOT NULL,
  `code` varchar(50) NOT NULL,
  `name` varchar(60) NOT NULL,
  `address` varchar(60) NOT NULL,
  `cheque` varchar(60) NOT NULL,
  `contact` varchar(12) DEFAULT NULL,
  `cash_advance` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `copra_transaction`
--

CREATE TABLE `copra_transaction` (
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
  `discount` decimal(10,2) NOT NULL,
  `total_moisture` decimal(10,2) NOT NULL,
  `net_res` decimal(10,2) NOT NULL,
  `first_res` decimal(10,2) NOT NULL,
  `sec_res` decimal(10,2) NOT NULL,
  `third_res` decimal(10,2) NOT NULL,
  `total_first_res` decimal(10,2) NOT NULL,
  `total_sec_res` decimal(10,2) NOT NULL,
  `total_third_res` decimal(10,2) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `less` decimal(10,2) NOT NULL,
  `amount_paid` decimal(10,2) NOT NULL,
  `tax_amount` decimal(10,2) NOT NULL,
  `amount_words` varchar(100) NOT NULL,
  `rese_weight_1` float NOT NULL,
  `rese_weight_2` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cuplump_container`
--

CREATE TABLE `cuplump_container` (
  `container_id` int(11) NOT NULL,
  `van_no` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `loading_date` date NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `recorded_by` varchar(255) NOT NULL,
  `total_cuplump_weight` float NOT NULL,
  `cuplump_selling_weight` decimal(10,2) NOT NULL,
  `total_cuplump_cost` decimal(10,2) NOT NULL,
  `ave_cuplump_cost` decimal(10,2) NOT NULL,
  `ship_exp` decimal(10,2) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cuplump_container_inv`
--

CREATE TABLE `cuplump_container_inv` (
  `cuplump_inventory_id` int(11) NOT NULL,
  `container_id` int(11) NOT NULL,
  `supplier` varchar(255) NOT NULL,
  `buying_weight` int(255) NOT NULL,
  `dry_weight` decimal(10,2) NOT NULL,
  `inv_remarks` varchar(55) NOT NULL,
  `drc` decimal(10,2) NOT NULL,
  `cost_per_kilo` decimal(10,2) NOT NULL,
  `total_cost` decimal(10,2) NOT NULL,
  `amount_paid` decimal(10,2) NOT NULL
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
  `source` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ledger_buahantoppers`
--

CREATE TABLE `ledger_buahantoppers` (
  `id` int(11) NOT NULL,
  `date` varchar(10) NOT NULL,
  `voucher` varchar(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `net_kilos` decimal(10,2) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `ejn_percent` decimal(10,2) NOT NULL,
  `ejn_total` decimal(10,2) NOT NULL,
  `toppers_percent` decimal(10,2) NOT NULL,
  `gross_amount` decimal(10,2) NOT NULL,
  `less_category` varchar(50) NOT NULL,
  `less_toppers` decimal(10,2) NOT NULL,
  `toppers_total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ledger_buying_station`
--

CREATE TABLE `ledger_buying_station` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `amount` decimal(10,2) NOT NULL,
  `less` decimal(10,2) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `destination` varchar(100) DEFAULT NULL,
  `mode_transact` varchar(255) DEFAULT NULL,
  `date_payment` date DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ledger_maloong`
--

CREATE TABLE `ledger_maloong` (
  `id` int(11) NOT NULL,
  `date` varchar(50) NOT NULL,
  `voucher` varchar(50) NOT NULL,
  `net_kilos` decimal(10,2) NOT NULL,
  `name` varchar(100) NOT NULL,
  `ejn_price` decimal(10,2) NOT NULL,
  `ejn_total` decimal(10,2) NOT NULL,
  `topper_price` decimal(10,2) NOT NULL,
  `topper_gross` decimal(10,2) NOT NULL,
  `less_category` varchar(100) NOT NULL,
  `less` decimal(10,2) NOT NULL,
  `topper_total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ledger_purchase`
--

CREATE TABLE `ledger_purchase` (
  `id` int(11) NOT NULL,
  `date` varchar(50) NOT NULL,
  `voucher` varchar(50) NOT NULL,
  `customer_name` varchar(50) NOT NULL,
  `net_kilos` decimal(10,2) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `cash_advance` decimal(10,2) NOT NULL,
  `tax_amount` decimal(10,2) NOT NULL,
  `others` decimal(10,2) NOT NULL,
  `others_desc` varchar(255) DEFAULT NULL,
  `net_total_amount` decimal(10,2) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `category` varchar(50) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `moisture_table`
--

CREATE TABLE `moisture_table` (
  `id` int(11) NOT NULL,
  `moisture_reading` varchar(20) NOT NULL,
  `discount_factor` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `planta_bales_production`
--

CREATE TABLE `planta_bales_production` (
  `bales_prod_id` int(11) NOT NULL,
  `source_type` varchar(255) DEFAULT NULL,
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

-- --------------------------------------------------------

--
-- Table structure for table `planta_recording`
--

CREATE TABLE `planta_recording` (
  `recording_id` int(11) NOT NULL,
  `source` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `lot_num` varchar(255) DEFAULT NULL,
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
  `crumbed_weight` int(11) NOT NULL,
  `dry_weight` int(11) DEFAULT NULL,
  `purchase_cost` decimal(10,2) DEFAULT NULL,
  `produce_total_weight` float DEFAULT NULL,
  `production_expense` decimal(10,2) DEFAULT NULL,
  `prod_expense_desc` varchar(255) DEFAULT NULL,
  `total_production_cost` decimal(10,2) DEFAULT NULL,
  `bales_average_cost` decimal(10,2) NOT NULL,
  `milling_date` date DEFAULT NULL,
  `drying_date` date DEFAULT NULL,
  `pressing_date` date DEFAULT NULL,
  `production_date` datetime DEFAULT NULL,
  `completion_date` datetime DEFAULT NULL,
  `selling_date` datetime DEFAULT NULL,
  `cuplump_remaining_weight` decimal(10,2) DEFAULT NULL,
  `milling_cost` decimal(10,2) NOT NULL,
  `wet_inventory_sold` int(11) DEFAULT NULL,
  `drc` float DEFAULT NULL,
  `recorded_by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `purchase_category`
--

CREATE TABLE `purchase_category` (
  `id` int(11) NOT NULL,
  `category` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `sales_cuplump_payment`
--

CREATE TABLE `sales_cuplump_payment` (
  `payment_id` int(11) NOT NULL,
  `cuplump_sales_id` int(11) NOT NULL,
  `payment_date` date NOT NULL,
  `payment_details` varchar(255) NOT NULL,
  `amount_paid` decimal(10,2) NOT NULL,
  `currency` varchar(5) NOT NULL,
  `exchange_rate` decimal(10,2) NOT NULL,
  `peso_equivalent` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sales_cuplump_record`
--

CREATE TABLE `sales_cuplump_record` (
  `cuplump_sales_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `sale_contract` varchar(255) NOT NULL,
  `purchase_contract` varchar(255) NOT NULL,
  `buyer_name` varchar(255) DEFAULT NULL,
  `sale_type` varchar(255) NOT NULL,
  `contract_price` decimal(10,4) NOT NULL,
  `transaction_date` date NOT NULL,
  `source` varchar(255) NOT NULL,
  `destination` varchar(255) NOT NULL,
  `currency` varchar(5) NOT NULL,
  `other_terms` text DEFAULT NULL,
  `no_containers` int(11) NOT NULL,
  `total_cuplump_weight` decimal(10,2) NOT NULL,
  `total_cuplump_cost` decimal(10,2) NOT NULL,
  `total_ship_expense` decimal(10,2) NOT NULL,
  `overall_ave_cost_kilo` decimal(10,2) NOT NULL,
  `total_sales` decimal(10,2) NOT NULL,
  `tax_rate` float NOT NULL,
  `tax_amount` decimal(10,2) NOT NULL,
  `amount_paid` decimal(10,2) NOT NULL,
  `unpaid_balance` decimal(10,2) NOT NULL,
  `sales_proceed` decimal(10,2) NOT NULL,
  `overall_cost` decimal(10,2) NOT NULL,
  `gross_profit` decimal(10,2) NOT NULL,
  `recorded_by` varchar(255) NOT NULL,
  `remarks` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sales_cuplump_selected_container`
--

CREATE TABLE `sales_cuplump_selected_container` (
  `sales_container_id` int(11) NOT NULL,
  `cuplump_sales_id` int(11) NOT NULL,
  `container_id` int(11) NOT NULL,
  `van_no` varchar(255) NOT NULL,
  `total_cuplump_cost` decimal(10,2) NOT NULL,
  `total_weight` decimal(10,2) NOT NULL,
  `selling_weight` decimal(10,2) NOT NULL,
  `ship_expense` decimal(10,2) NOT NULL,
  `ave_cost` decimal(10,2) NOT NULL,
  `remarks` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sales_cuplump_shipment`
--

CREATE TABLE `sales_cuplump_shipment` (
  `shipment_id` int(11) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `ship_date` date NOT NULL,
  `particular` varchar(255) DEFAULT NULL,
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
  `total_cuplump_weight` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sales_cuplump_shipment_container`
--

CREATE TABLE `sales_cuplump_shipment_container` (
  `cs_id` int(11) NOT NULL,
  `shipment_id` int(11) NOT NULL,
  `container_id` int(11) NOT NULL,
  `loading_date` date DEFAULT NULL,
  `van_no` varchar(255) NOT NULL,
  `total_weight` decimal(10,2) NOT NULL,
  `total_cost` decimal(10,2) NOT NULL,
  `ave_cost` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `name` varchar(255) DEFAULT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `loc` varchar(255) DEFAULT NULL,
  `last_active` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `token` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Indexes for table `coffee_customer`
--
ALTER TABLE `coffee_customer`
  ADD PRIMARY KEY (`cof_customer_id`);

--
-- Indexes for table `coffee_inventory`
--
ALTER TABLE `coffee_inventory`
  ADD PRIMARY KEY (`inventory_id`);

--
-- Indexes for table `coffee_production_list`
--
ALTER TABLE `coffee_production_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coffee_production_record`
--
ALTER TABLE `coffee_production_record`
  ADD PRIMARY KEY (`production_id`);

--
-- Indexes for table `coffee_products`
--
ALTER TABLE `coffee_products`
  ADD PRIMARY KEY (`coffee_id`);

--
-- Indexes for table `coffee_product_category`
--
ALTER TABLE `coffee_product_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `coffee_sale`
--
ALTER TABLE `coffee_sale`
  ADD PRIMARY KEY (`coffee_sale_id`);

--
-- Indexes for table `coffee_sale_line`
--
ALTER TABLE `coffee_sale_line`
  ADD PRIMARY KEY (`sale_line_id`);

--
-- Indexes for table `coffee_sale_payment`
--
ALTER TABLE `coffee_sale_payment`
  ADD PRIMARY KEY (`payment_id`);

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
-- Indexes for table `copra_contract`
--
ALTER TABLE `copra_contract`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `copra_moisture`
--
ALTER TABLE `copra_moisture`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `copra_seller`
--
ALTER TABLE `copra_seller`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `copra_transaction`
--
ALTER TABLE `copra_transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cuplump_container`
--
ALTER TABLE `cuplump_container`
  ADD PRIMARY KEY (`container_id`);

--
-- Indexes for table `cuplump_container_inv`
--
ALTER TABLE `cuplump_container_inv`
  ADD PRIMARY KEY (`cuplump_inventory_id`);

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
  ADD PRIMARY KEY (`bales_prod_id`),
  ADD KEY `plantaID` (`recording_id`);

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
-- Indexes for table `sales_cuplump_payment`
--
ALTER TABLE `sales_cuplump_payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `sales_cuplump_record`
--
ALTER TABLE `sales_cuplump_record`
  ADD PRIMARY KEY (`cuplump_sales_id`);

--
-- Indexes for table `sales_cuplump_selected_container`
--
ALTER TABLE `sales_cuplump_selected_container`
  ADD PRIMARY KEY (`sales_container_id`);

--
-- Indexes for table `sales_cuplump_shipment`
--
ALTER TABLE `sales_cuplump_shipment`
  ADD PRIMARY KEY (`shipment_id`);

--
-- Indexes for table `sales_cuplump_shipment_container`
--
ALTER TABLE `sales_cuplump_shipment_container`
  ADD PRIMARY KEY (`cs_id`);

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
  MODIFY `container_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bales_container_selection`
--
ALTER TABLE `bales_container_selection`
  MODIFY `selected_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bales_outsource_purchase`
--
ALTER TABLE `bales_outsource_purchase`
  MODIFY `outsource_recording_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bales_purchase_inventory`
--
ALTER TABLE `bales_purchase_inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `bales_sales_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bales_shipment_container`
--
ALTER TABLE `bales_shipment_container`
  MODIFY `bs_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bales_transaction`
--
ALTER TABLE `bales_transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bale_shipment_record`
--
ALTER TABLE `bale_shipment_record`
  MODIFY `shipment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category_expenses`
--
ALTER TABLE `category_expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `coffee_customer`
--
ALTER TABLE `coffee_customer`
  MODIFY `cof_customer_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `coffee_inventory`
--
ALTER TABLE `coffee_inventory`
  MODIFY `inventory_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `coffee_production_list`
--
ALTER TABLE `coffee_production_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `coffee_production_record`
--
ALTER TABLE `coffee_production_record`
  MODIFY `production_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `coffee_products`
--
ALTER TABLE `coffee_products`
  MODIFY `coffee_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `coffee_product_category`
--
ALTER TABLE `coffee_product_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `coffee_sale`
--
ALTER TABLE `coffee_sale`
  MODIFY `coffee_sale_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `coffee_sale_line`
--
ALTER TABLE `coffee_sale_line`
  MODIFY `sale_line_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `coffee_sale_payment`
--
ALTER TABLE `coffee_sale_payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contract_purchase`
--
ALTER TABLE `contract_purchase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `copra_cashadvance`
--
ALTER TABLE `copra_cashadvance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `copra_contract`
--
ALTER TABLE `copra_contract`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `copra_moisture`
--
ALTER TABLE `copra_moisture`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `copra_seller`
--
ALTER TABLE `copra_seller`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `copra_transaction`
--
ALTER TABLE `copra_transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cuplump_container`
--
ALTER TABLE `cuplump_container`
  MODIFY `container_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cuplump_container_inv`
--
ALTER TABLE `cuplump_container_inv`
  MODIFY `cuplump_inventory_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dry_price_transfer`
--
ALTER TABLE `dry_price_transfer`
  MODIFY `dry_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ejn_rubber_transfer`
--
ALTER TABLE `ejn_rubber_transfer`
  MODIFY `ejn_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ledger_buahantoppers`
--
ALTER TABLE `ledger_buahantoppers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ledger_buying_station`
--
ALTER TABLE `ledger_buying_station`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ledger_cashadvance`
--
ALTER TABLE `ledger_cashadvance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ledger_expenses`
--
ALTER TABLE `ledger_expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ledger_maloong`
--
ALTER TABLE `ledger_maloong`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ledger_purchase`
--
ALTER TABLE `ledger_purchase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `moisture_table`
--
ALTER TABLE `moisture_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `planta_bales_production`
--
ALTER TABLE `planta_bales_production`
  MODIFY `bales_prod_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `planta_recording`
--
ALTER TABLE `planta_recording`
  MODIFY `recording_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `planta_recording_logs`
--
ALTER TABLE `planta_recording_logs`
  MODIFY `planta_logs_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchase_category`
--
ALTER TABLE `purchase_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rubber_cashadvance`
--
ALTER TABLE `rubber_cashadvance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rubber_contract`
--
ALTER TABLE `rubber_contract`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rubber_seller`
--
ALTER TABLE `rubber_seller`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rubber_transaction`
--
ALTER TABLE `rubber_transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales_cuplump_payment`
--
ALTER TABLE `sales_cuplump_payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales_cuplump_record`
--
ALTER TABLE `sales_cuplump_record`
  MODIFY `cuplump_sales_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales_cuplump_selected_container`
--
ALTER TABLE `sales_cuplump_selected_container`
  MODIFY `sales_container_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales_cuplump_shipment`
--
ALTER TABLE `sales_cuplump_shipment`
  MODIFY `shipment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales_cuplump_shipment_container`
--
ALTER TABLE `sales_cuplump_shipment_container`
  MODIFY `cs_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `seller`
--
ALTER TABLE `seller`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaction_record`
--
ALTER TABLE `transaction_record`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `planta_bales_production`
--
ALTER TABLE `planta_bales_production`
  ADD CONSTRAINT `plantaID` FOREIGN KEY (`recording_id`) REFERENCES `planta_recording` (`recording_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
