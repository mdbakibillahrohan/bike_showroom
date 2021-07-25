-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 09, 2021 at 07:12 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `supershop`
--

-- --------------------------------------------------------

--
-- Table structure for table `barcodes`
--

CREATE TABLE `barcodes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `purchase_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `invoice_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `showroom_id` int(11) NOT NULL,
  `barcode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code_type` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barcodes`
--

INSERT INTO `barcodes` (`id`, `purchase_id`, `product_id`, `invoice_no`, `showroom_id`, `barcode`, `code_type`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '1000', 1, '200000', 0, '2021-01-09 10:50:08', '2021-01-09 10:50:08'),
(2, 2, 2, '1000', 1, '5646445', 1, '2021-01-09 10:50:08', '2021-01-09 10:50:08'),
(3, 2, 2, '1000', 1, '46646545', 1, '2021-01-09 10:50:08', '2021-01-09 10:50:08'),
(4, 2, 2, '1000', 1, '4242242', 1, '2021-01-09 10:50:08', '2021-01-09 10:50:08'),
(5, 2, 2, '1000', 1, '4242423', 1, '2021-01-09 10:50:08', '2021-01-09 10:50:08'),
(6, 3, 2, '1001', 1, '200001', 0, '2021-01-09 10:52:10', '2021-01-09 10:52:10'),
(7, 4, 2, '1001', 1, '200002', 0, '2021-01-09 10:52:10', '2021-01-09 10:52:10'),
(8, 5, 2, '1002', 1, '200003', 0, '2021-01-09 10:59:24', '2021-01-09 10:59:24'),
(9, 6, 2, '1002', 1, '2343242342', 1, '2021-01-09 10:59:24', '2021-01-09 10:59:24'),
(10, 6, 2, '1002', 1, '42342342423', 1, '2021-01-09 10:59:24', '2021-01-09 10:59:24'),
(11, 6, 2, '1002', 1, '42342342342', 1, '2021-01-09 10:59:24', '2021-01-09 10:59:24'),
(12, 7, 4, '1003', 1, '200004', 0, '2021-01-09 11:01:41', '2021-01-09 11:01:41'),
(13, 8, 4, '1003', 1, '200005', 0, '2021-01-09 11:01:41', '2021-01-09 11:01:41');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `brand_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `showroom_id` int(11) NOT NULL,
  `makeby` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `brand_name`, `brand_image`, `showroom_id`, `makeby`, `created_at`, `updated_at`) VALUES
(1, 'Nokia', '161004950286c50q.PI_S.jpg', 1, 1, '2021-01-07 13:58:22', '2021-01-07 13:58:22');

-- --------------------------------------------------------

--
-- Table structure for table `cash_recive_details`
--

CREATE TABLE `cash_recive_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `note_input` int(11) DEFAULT NULL,
  `return_show` int(11) DEFAULT NULL,
  `cardname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cardno` int(11) DEFAULT NULL,
  `bkash` int(11) DEFAULT NULL,
  `bankname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `chequeno` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `showroom_id` int(11) NOT NULL,
  `makeby` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `category_image`, `showroom_id`, `makeby`, `created_at`, `updated_at`) VALUES
(1, 'Mobile', '1610049491o9ehag.PI_S.jpg', 1, 1, '2021-01-07 13:58:11', '2021-01-07 13:58:11');

-- --------------------------------------------------------

--
-- Table structure for table `customerpayments`
--

CREATE TABLE `customerpayments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_id` int(11) NOT NULL,
  `showroom_id` int(11) NOT NULL,
  `pay_amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_way` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `money_receipt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `make_by` int(11) NOT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `showroom_id` int(11) NOT NULL,
  `flag` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer_accounts`
--

CREATE TABLE `customer_accounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` int(11) NOT NULL,
  `showroom_id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL DEFAULT 0,
  `accounts` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_12_27_204530_create_roles_table', 1),
(5, '2020_12_27_204743_create_showrooms_table', 1),
(6, '2020_12_27_205528_create_showroom_user_table', 1),
(7, '2020_12_28_160159_create_suppliers_table', 1),
(8, '2020_12_28_162833_create_supplier_accounts_table', 1),
(9, '2020_12_28_171650_create_customers_table', 1),
(10, '2020_12_28_171714_create_customer_accounts_table', 1),
(11, '2020_12_28_173950_create_categories_table', 1),
(12, '2020_12_28_174012_create_subcategories_table', 1),
(13, '2020_12_28_174026_create_brands_table', 1),
(14, '2020_12_28_174041_create_products_table', 1),
(15, '2020_12_31_124253_create_purchases_table', 1),
(16, '2020_12_31_131903_create_supplierpayments_table', 1),
(17, '2021_01_01_064709_create_purchasecosts_table', 1),
(18, '2021_01_05_072329_create_orders_table', 1),
(19, '2021_01_05_073446_create_customerpayments_table', 1),
(20, '2021_01_05_073924_create_recivecashes_table', 1),
(21, '2021_01_05_181942_create_profitorders_table', 1),
(22, '2021_01_05_195518_create_cash_recive_details_table', 1),
(23, '2021_01_09_160338_create_barcodes_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_no` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `showroom_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_details` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `sub_category` int(11) DEFAULT 0,
  `brand_id` int(11) DEFAULT 0,
  `product_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `sellprice` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` decimal(10,2) NOT NULL,
  `total_sellprice` decimal(10,2) NOT NULL,
  `sell_discount` decimal(10,2) DEFAULT 0.00,
  `sell_cost` decimal(10,2) DEFAULT 0.00,
  `lastsell_amount` decimal(10,2) DEFAULT 0.00,
  `vat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `attribute` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `return_cash` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `return_invoice` int(11) DEFAULT NULL,
  `selldate` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `warranty` int(11) DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_deatils` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `categorie_id` int(11) NOT NULL,
  `subcategorie_id` int(11) DEFAULT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `sell_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attrebute` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `warranty` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `big_unit_relation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `small_unit_relation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `showroom_id` int(11) NOT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `makeby` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `product_deatils`, `categorie_id`, `subcategorie_id`, `brand_id`, `sell_type`, `attrebute`, `warranty`, `big_unit_relation`, `small_unit_relation`, `showroom_id`, `status`, `makeby`, `created_at`, `updated_at`) VALUES
(1, 'Samsun Y9', '2GB 4G', 1, NULL, 1, 'Pic', NULL, NULL, NULL, NULL, 1, '1', 1, '2021-01-07 14:01:08', '2021-01-07 14:01:08'),
(2, 'T-Shart', 'Polo', 1, NULL, 1, 'Color', 'Red, Black, Whire, Purple', NULL, NULL, NULL, 1, '1', 1, '2021-01-07 14:02:56', '2021-01-07 14:02:56'),
(3, 'shop', 'poo', 1, NULL, 1, 'Dozen', '12', NULL, NULL, NULL, 1, '1', 1, '2021-01-08 12:10:03', '2021-01-08 12:10:03'),
(4, 'Tv', '17\"', 1, NULL, 1, 'Pic', '17, 20', NULL, NULL, NULL, 1, '1', 1, '2021-01-08 12:42:05', '2021-01-08 12:42:05');

-- --------------------------------------------------------

--
-- Table structure for table `profitorders`
--

CREATE TABLE `profitorders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_no` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `purchase_id` int(11) NOT NULL,
  `showroom_id` int(11) NOT NULL,
  `buy_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sell_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_buy_amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_sell_amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `selldate` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchasecosts`
--

CREATE TABLE `purchasecosts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `supplier_pay_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `showroom_id` int(11) NOT NULL,
  `cost_reson` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cost_amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `make_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_no` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attribute` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `buy_price` decimal(10,2) NOT NULL,
  `quantity` decimal(10,2) NOT NULL,
  `sub_total_buy` decimal(10,2) NOT NULL,
  `buy_cost` decimal(10,2) DEFAULT 0.00,
  `discount` decimal(10,2) DEFAULT 0.00,
  `actual_buy` decimal(10,2) NOT NULL,
  `rest_qty` decimal(10,2) NOT NULL,
  `rest_buy_amount` decimal(10,2) NOT NULL,
  `sell_price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `with_free` int(11) DEFAULT NULL,
  `showroom_id` int(11) NOT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `makeby` int(11) NOT NULL,
  `purchase_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`id`, `invoice_no`, `product_id`, `product_type`, `attribute`, `buy_price`, `quantity`, `sub_total_buy`, `buy_cost`, `discount`, `actual_buy`, `rest_qty`, `rest_buy_amount`, `sell_price`, `with_free`, `showroom_id`, `supplier_id`, `makeby`, `purchase_date`, `status`, `created_at`, `updated_at`) VALUES
(1, 1000, 1, 'Pic', NULL, '1000.00', '5.00', '5000.00', '0.00', '0.00', '5000.00', '5.00', '5000.00', '1200', NULL, 1, 1, 1, '09-01-2021', '1', '2021-01-09 10:50:08', '2021-01-09 10:50:08'),
(2, 1000, 2, 'Color', 'Red', '255.00', '4.00', '1020.00', '0.00', '0.00', '1020.00', '4.00', '1020.00', '300', NULL, 1, 1, 1, '09-01-2021', '1', '2021-01-09 10:50:08', '2021-01-09 10:50:08'),
(3, 1001, 2, 'Color', 'Black', '250.00', '5.00', '1250.00', '0.00', '0.00', '1250.00', '5.00', '1250.00', '300', NULL, 1, 1, 1, '09-01-2021', '1', '2021-01-09 10:52:10', '2021-01-09 10:52:10'),
(4, 1001, 2, 'Color', 'Purple', '250.00', '5.00', '1250.00', '0.00', '0.00', '1250.00', '5.00', '1250.00', '300', NULL, 1, 1, 1, '09-01-2021', '1', '2021-01-09 10:52:10', '2021-01-09 10:52:10'),
(5, 1002, 2, 'Color', 'Red', '22.00', '11.00', '242.00', '0.00', '0.00', '242.00', '11.00', '242.00', '22', NULL, 1, 1, 1, '09-01-2021', '1', '2021-01-09 10:59:24', '2021-01-09 10:59:24'),
(6, 1002, 2, 'Color', 'Black', '434.00', '3.00', '1302.00', '0.00', '0.00', '1302.00', '3.00', '1302.00', '432', NULL, 1, 1, 1, '09-01-2021', '1', '2021-01-09 10:59:24', '2021-01-09 10:59:24'),
(7, 1003, 4, 'Pic', '17', '5000.00', '5.00', '25000.00', '0.00', '0.00', '25000.00', '5.00', '25000.00', '5500', NULL, 1, 1, 1, '09-01-2021', '1', '2021-01-09 11:01:41', '2021-01-09 11:01:41'),
(8, 1003, 4, 'Pic', '20', '6000.00', '5.00', '30000.00', '0.00', '0.00', '30000.00', '5.00', '30000.00', '6500', NULL, 1, 1, 1, '09-01-2021', '1', '2021-01-09 11:01:41', '2021-01-09 11:01:41');

-- --------------------------------------------------------

--
-- Table structure for table `recivecashes`
--

CREATE TABLE `recivecashes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_id` int(11) NOT NULL,
  `showroom_id` int(11) NOT NULL,
  `received` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `received_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `received_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `user_type`, `created_at`, `updated_at`) VALUES
(1, 'Owner', '2021-01-07 13:57:06', '2021-01-07 13:57:06'),
(2, 'Manager', '2021-01-07 13:57:06', '2021-01-07 13:57:06'),
(3, 'User', '2021-01-07 13:57:06', '2021-01-07 13:57:06');

-- --------------------------------------------------------

--
-- Table structure for table `showrooms`
--

CREATE TABLE `showrooms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `showroom_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `showroom_details` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expired_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `showroom_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `slag` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `showrooms`
--

INSERT INTO `showrooms` (`id`, `showroom_name`, `address`, `mobile`, `showroom_details`, `expired_date`, `showroom_image`, `status`, `slag`, `created_at`, `updated_at`) VALUES
(1, 'Super Shop', 'Moheshpur', '5465', 'As', '07-01-2022', '1610049458m97yuc.PI_S.jpg', '1', '1610049458,Super_Shop,JPGVq', '2021-01-07 13:57:39', '2021-01-07 13:57:39');

-- --------------------------------------------------------

--
-- Table structure for table `showroom_user`
--

CREATE TABLE `showroom_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `showroom_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `categorie_id` int(11) DEFAULT NULL,
  `subcategory_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `makeby` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `supplierpayments`
--

CREATE TABLE `supplierpayments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `suplier_id` int(11) NOT NULL,
  `invoice_no` int(11) NOT NULL,
  `payment_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pay_amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_details` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `money_receipt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `make_by` int(11) NOT NULL,
  `status` int(11) DEFAULT NULL,
  `showroom_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `suplier_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `showroom_id` int(11) NOT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `suplier_name`, `address`, `mobile`, `showroom_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Kamrul', 'Dhaka', '256252', 1, '1', '2021-01-07 14:03:24', '2021-01-07 14:03:24'),
(2, 'Kamrul', 'Dhaka', '1256251', 1, '1', '2021-01-09 09:43:42', '2021-01-09 09:43:42');

-- --------------------------------------------------------

--
-- Table structure for table `supplier_accounts`
--

CREATE TABLE `supplier_accounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `showroom_id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL DEFAULT 0,
  `accounts` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `supplier_accounts`
--

INSERT INTO `supplier_accounts` (`id`, `supplier_id`, `showroom_id`, `invoice_id`, `accounts`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 101, '1000', 1, '2021-01-07 14:03:24', '2021-01-07 14:03:24'),
(2, 2, 1, 101, '500', 1, '2021-01-09 09:43:42', '2021-01-09 09:43:42'),
(3, 1, 1, 1000, '5020', 1, '2021-01-09 10:50:08', '2021-01-09 10:50:08'),
(4, 1, 1, 1001, '-2520', 0, '2021-01-09 10:52:10', '2021-01-09 10:52:10'),
(5, 1, 1, 1002, '-976', 0, '2021-01-09 10:59:24', '2021-01-09 10:59:24'),
(6, 1, 1, 1003, '54024', 1, '2021-01-09 11:01:41', '2021-01-09 11:01:41');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '3',
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `mobile`, `role_id`, `email`, `email_verified_at`, `password`, `image`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Abdus Samad', '01823151351', '1', 'samad1230@gmail.com', NULL, '$2y$10$R7L3AYru2Nf5ZT7fDNchJOA5gTGybQk72cEaOvnBwUGG8h4mrS4Yy', '1610049474m81iao.PI_S.jpg', '1', NULL, NULL, '2021-01-07 13:57:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barcodes`
--
ALTER TABLE `barcodes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cash_recive_details`
--
ALTER TABLE `cash_recive_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customerpayments`
--
ALTER TABLE `customerpayments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_accounts`
--
ALTER TABLE `customer_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profitorders`
--
ALTER TABLE `profitorders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchasecosts`
--
ALTER TABLE `purchasecosts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recivecashes`
--
ALTER TABLE `recivecashes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `showrooms`
--
ALTER TABLE `showrooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `showroom_user`
--
ALTER TABLE `showroom_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplierpayments`
--
ALTER TABLE `supplierpayments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier_accounts`
--
ALTER TABLE `supplier_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barcodes`
--
ALTER TABLE `barcodes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cash_recive_details`
--
ALTER TABLE `cash_recive_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customerpayments`
--
ALTER TABLE `customerpayments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_accounts`
--
ALTER TABLE `customer_accounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `profitorders`
--
ALTER TABLE `profitorders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchasecosts`
--
ALTER TABLE `purchasecosts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `recivecashes`
--
ALTER TABLE `recivecashes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `showrooms`
--
ALTER TABLE `showrooms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `showroom_user`
--
ALTER TABLE `showroom_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `supplierpayments`
--
ALTER TABLE `supplierpayments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `supplier_accounts`
--
ALTER TABLE `supplier_accounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
