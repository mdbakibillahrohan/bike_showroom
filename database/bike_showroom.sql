-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 25, 2021 at 06:35 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bike_showroom`
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

-- --------------------------------------------------------

--
-- Table structure for table `bikecustomers`
--

CREATE TABLE `bikecustomers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bikesell_id` int(11) NOT NULL,
  `customer_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guardian_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guarantorname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guarantor_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guarantor_mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `national_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `electric_bill` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `other_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bikecustomers`
--

INSERT INTO `bikecustomers` (`id`, `bikesell_id`, `customer_name`, `guardian_name`, `address`, `mobile`, `guarantorname`, `guarantor_address`, `guarantor_mobile`, `customer_image`, `national_id`, `electric_bill`, `other_image`, `payment_type`, `created_at`, `updated_at`) VALUES
(1, 3, 'Zakir', 'nn', 'uta', '1552', 'miuu', 'hghj', '4747', '16111384050c9hx6.PI_S.jpg', NULL, NULL, NULL, 'Installment', '2021-01-20 04:26:45', '2021-01-20 04:26:45'),
(2, 3, 'Kamrul Hasan', 'Abdus Samad', 'Moheshpur Jhenaidah', '01936008507', 'Kamal Hossain', 'Kalispur Moheshpur', '01925539333', '16111686109pch5d.PI_S.jpg', '1611168610kgc3we.PI_S.jpg', '1611168610ouxgh0.PI_S.jpg', '1611168610d9z1u4.PI_S.jpg', 'Onetime', '2021-01-20 12:50:10', '2021-01-20 12:50:10'),
(4, 2, 'Ashadul', 'Irfan Molla', 'Shatkira', '01823515251', 'Samad', 'Uttara', '01936008532', '1611170730hoarfi.PI_S.jpg', '1611170730gs20um.PI_S.jpg', NULL, NULL, 'Installment', '2021-01-20 13:25:30', '2021-01-20 13:25:30');

-- --------------------------------------------------------

--
-- Table structure for table `bikeidentities`
--

CREATE TABLE `bikeidentities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bike_id` int(11) NOT NULL,
  `engine_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `chassis_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bikeidentities`
--

INSERT INTO `bikeidentities` (`id`, `bike_id`, `engine_no`, `chassis_no`, `created_at`, `updated_at`) VALUES
(5, 2, '42353532521', '42353532521', '2021-01-20 13:09:21', '2021-01-20 13:09:21'),
(6, 2, '42353532524', '42353532526', '2021-01-20 13:09:21', '2021-01-20 13:09:21'),
(7, 2, '42353532525', '42353532528', '2021-01-20 13:09:21', '2021-01-20 13:09:21');

-- --------------------------------------------------------

--
-- Table structure for table `bikepayments`
--

CREATE TABLE `bikepayments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `payment_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bikecustomer_id` int(11) NOT NULL,
  `bike_id` int(11) NOT NULL,
  `Pay_amount` int(11) NOT NULL,
  `bankdetails` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `carddetails` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobilebankdetails` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bikepayments`
--

INSERT INTO `bikepayments` (`id`, `payment_date`, `payment_type`, `bikecustomer_id`, `bike_id`, `Pay_amount`, `bankdetails`, `carddetails`, `mobilebankdetails`, `user_id`, `created_at`, `updated_at`) VALUES
(1, '20-01-2021', 'Cash Payment', 1, 3, 83000, NULL, NULL, NULL, 1, '2021-01-20 04:26:45', '2021-01-20 04:26:45'),
(2, '20-01-2021', 'Installment', 1, 3, 20000, NULL, NULL, NULL, 1, '2021-01-20 04:27:57', '2021-01-20 04:27:57'),
(3, '20-01-2021', 'Installment', 1, 3, 10000, NULL, NULL, NULL, 1, '2021-01-20 04:28:19', '2021-01-20 04:28:19'),
(4, '20-01-2021', 'Installment', 1, 3, 20000, NULL, NULL, NULL, 1, '2021-01-20 10:45:36', '2021-01-20 10:45:36'),
(5, '20-01-2021', 'Installment', 1, 3, 15000, NULL, NULL, NULL, 1, '2021-01-20 10:46:43', '2021-01-20 10:46:43'),
(6, '20-01-2021', 'Installment', 1, 3, 17000, NULL, NULL, NULL, 1, '2021-01-20 10:47:30', '2021-01-20 10:47:30'),
(7, '20-01-2021', 'Installment', 1, 3, 35000, NULL, NULL, NULL, 1, '2021-01-20 10:47:44', '2021-01-20 10:47:44'),
(8, '20-01-2021', 'Installment', 1, 3, 15000, NULL, NULL, NULL, 1, '2021-01-20 10:48:24', '2021-01-20 10:48:24'),
(9, '20-01-2021', 'Cash Payment', 2, 3, 110000, NULL, NULL, NULL, 1, '2021-01-20 12:50:10', '2021-01-20 12:50:10'),
(10, '20-01-2021', 'Cash Payment', 4, 2, 84000, NULL, NULL, NULL, 1, '2021-01-20 13:25:30', '2021-01-20 13:25:30');

-- --------------------------------------------------------

--
-- Table structure for table `bikepurchases`
--

CREATE TABLE `bikepurchases` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `invoice` int(11) NOT NULL,
  `bike_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `rest_qty` int(11) NOT NULL,
  `buy_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `commission` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `sell_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `offer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gift_product` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `showroom_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bikepurchases`
--

INSERT INTO `bikepurchases` (`id`, `supplier_id`, `date`, `invoice`, `bike_id`, `quantity`, `rest_qty`, `buy_price`, `commission`, `sell_price`, `discount_price`, `offer`, `gift_product`, `showroom_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, '20-01-2021', 30000, 3, 2, 0, '185000', '10000', '185000', '0', NULL, NULL, 1, 1, '2021-01-20 04:04:27', '2021-01-20 04:04:27'),
(2, 1, '20-01-2021', 30001, 2, 4, 3, '120000', '8500', '120000', '0', NULL, NULL, 1, 1, '2021-01-20 13:09:21', '2021-01-20 13:36:07');

-- --------------------------------------------------------

--
-- Table structure for table `bikes`
--

CREATE TABLE `bikes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `categorie_id` int(11) NOT NULL,
  `subcategorie_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `showroom_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bikes`
--

INSERT INTO `bikes` (`id`, `name`, `model`, `details`, `categorie_id`, `subcategorie_id`, `brand_id`, `user_id`, `showroom_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'TVS Appache', '2021', 'Red Color', 1, 2, 1, 1, 1, 1, '2021-01-19 10:12:36', '2021-01-19 10:12:36'),
(2, 'TVS Metro', '2021', 'Red Color', 1, 3, 1, 1, 1, 1, '2021-01-19 10:12:51', '2021-01-19 10:12:51'),
(3, 'RTR', '2021', 'Black', 1, 1, 1, 1, 1, 1, '2021-01-19 10:13:32', '2021-01-19 10:13:32');

-- --------------------------------------------------------

--
-- Table structure for table `bikesells`
--

CREATE TABLE `bikesells` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bikecustomer_id` int(11) NOT NULL,
  `bike_id` int(11) NOT NULL,
  `engine_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ChassisNo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `paymentway` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bikedetails` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bikesell_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sell_price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `discount` int(11) NOT NULL DEFAULT 0,
  `last_total_amount` int(11) NOT NULL,
  `cashpayment` int(11) NOT NULL,
  `interest` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_due_amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `onetime_payment_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `installmentno` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `installmentamount` int(11) DEFAULT NULL,
  `installment_start_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bikesells`
--

INSERT INTO `bikesells` (`id`, `invoice`, `date`, `bikecustomer_id`, `bike_id`, `engine_no`, `ChassisNo`, `paymentway`, `bikedetails`, `bikesell_type`, `sell_price`, `quantity`, `discount`, `last_total_amount`, `cashpayment`, `interest`, `last_due_amount`, `onetime_payment_date`, `installmentno`, `installmentamount`, `installment_start_date`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'BK-100', '20-01-2021', 1, 3, '53532532530', '53532532530', 'Cash Payment', NULL, 'Installment', 185000, 1, 2000, 183000, 83000, '2000', '102000', NULL, '6', 17000, '04-02-2021', 1, '2021-01-20 04:26:45', '2021-01-20 04:26:45'),
(2, 'BK-101', '20-01-2021', 2, 3, '53532532531', '53532532531', 'Cash Payment', NULL, 'Onetime', 185000, 1, 1000, 184000, 110000, '1500', '75500', '30-01-2021', '1', 75500, NULL, 1, '2021-01-20 12:50:10', '2021-01-20 12:50:10'),
(3, 'BK-102', '20-01-2021', 4, 2, '42353532523', '42353532523', 'Cash Payment', NULL, 'Installment', 120000, 1, 0, 120000, 84000, '1500', '37500', NULL, '4', 9375, '10-02-2021', 1, '2021-01-20 13:25:30', '2021-01-20 13:25:30');

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
(1, 'TVS', '1611072736wlnbth.PI_S.png', 1, 1, '2021-01-19 10:12:16', '2021-01-19 10:12:16');

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
(1, 'Motorcycle', '16110726891ojrbu.PI_S.jpg', 1, 1, '2021-01-19 10:11:29', '2021-01-19 10:11:29');

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
-- Table structure for table `expences`
--

CREATE TABLE `expences` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `showroom_id` int(11) NOT NULL,
  `expense_reason` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expense_details` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expense_amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
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
-- Table structure for table `installments`
--

CREATE TABLE `installments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `payment_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bikecustomer_id` int(11) NOT NULL,
  `bike_id` int(11) NOT NULL,
  `installment_no` int(11) NOT NULL,
  `installment_amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `install_paydate` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pay_amount` int(11) NOT NULL DEFAULT 0,
  `interest` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `blanch` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `installments`
--

INSERT INTO `installments` (`id`, `payment_date`, `bikecustomer_id`, `bike_id`, `installment_no`, `installment_amount`, `install_paydate`, `pay_amount`, `interest`, `blanch`, `status`, `created_at`, `updated_at`) VALUES
(1, '04-03-2021', 1, 3, 1, '17000.00', '20-01-2021', 0, '0', '17000.00', '0', '2021-01-20 04:26:45', '2021-01-20 10:45:36'),
(2, '04-04-2021', 1, 3, 2, '17000.00', '20-01-2021', 0, '0', '17000.00', '0', '2021-01-20 04:26:45', '2021-01-20 10:46:43'),
(3, '04-05-2021', 1, 3, 3, '17000.00', '20-01-2021', 0, '0', '17000.00', '0', '2021-01-20 04:26:45', '2021-01-20 10:47:30'),
(4, '04-06-2021', 1, 3, 4, '17000.00', '20-01-2021', 0, '0', '17000.00', '0', '2021-01-20 04:26:45', '2021-01-20 10:47:44'),
(5, '04-07-2021', 1, 3, 5, '17000.00', '20-01-2021', 17000, '333.33333333333', '0', '1', '2021-01-20 04:26:45', '2021-01-20 10:47:44'),
(6, '04-08-2021', 1, 3, 6, '17000.00', '20-01-2021', 0, '0', '17000.00', '0', '2021-01-20 04:26:45', '2021-01-20 10:48:24'),
(7, '30-01-2021', 2, 3, 1, '75500', NULL, 0, '0', '75500', '0', '2021-01-20 12:50:10', '2021-01-20 12:50:10'),
(8, '10-03-2021', 4, 2, 1, '9375.00', NULL, 0, '0', '9375.00', '0', '2021-01-20 13:36:07', '2021-01-20 13:36:07'),
(9, '10-04-2021', 4, 2, 2, '9375.00', NULL, 0, '0', '9375.00', '0', '2021-01-20 13:36:07', '2021-01-20 13:36:07'),
(10, '10-05-2021', 4, 2, 3, '9375.00', NULL, 0, '0', '9375.00', '0', '2021-01-20 13:36:07', '2021-01-20 13:36:07'),
(11, '10-06-2021', 4, 2, 4, '9375.00', NULL, 0, '0', '9375.00', '0', '2021-01-20 13:36:07', '2021-01-20 13:36:07');

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
(23, '2021_01_10_122256_create_expences_table', 1),
(24, '2021_01_12_081425_create_returnorders_table', 1),
(25, '2021_01_13_181842_create_barcodes_table', 1),
(26, '2021_01_15_134512_create_bikepurchases_table', 1),
(27, '2021_01_15_134557_create_bikesells_table', 1),
(28, '2021_01_15_134652_create_installments_table', 1),
(29, '2021_01_15_134716_create_registrations_table', 1),
(30, '2021_01_15_134734_create_bikecustomers_table', 1),
(31, '2021_01_15_134812_create_bikepayments_table', 1),
(32, '2021_01_15_175844_create_bikes_table', 1),
(33, '2021_01_15_201052_create_bikeidentities_table', 1);

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
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `makeby` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profitorders`
--

CREATE TABLE `profitorders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` int(11) NOT NULL,
  `purchase_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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

--
-- Dumping data for table `profitorders`
--

INSERT INTO `profitorders` (`id`, `invoice_no`, `product_id`, `purchase_id`, `showroom_id`, `buy_price`, `sell_price`, `quantity`, `total_buy_amount`, `total_sell_amount`, `selldate`, `created_at`, `updated_at`) VALUES
(1, 'BK-102', 3, 'BK-102', 1, '175000', '184900', '1', '175000', '184900', '20-01-2021', '2021-01-20 04:20:34', '2021-01-20 04:20:34'),
(2, 'BK-100', 3, 'BK-100', 1, '175000', '183000', '1', '175000', '183000', '20-01-2021', '2021-01-20 04:26:45', '2021-01-20 04:26:45'),
(3, 'BK-100', 3, '1', 1, '0', '333.33333333333', '1', '0', '333.33333333333', '20-01-2021', '2021-01-20 10:45:36', '2021-01-20 10:45:36'),
(4, 'BK-100', 3, '1', 1, '0', '333.33333333333', '1', '0', '333.33333333333', '20-01-2021', '2021-01-20 10:46:44', '2021-01-20 10:46:44'),
(5, 'BK-100', 3, '1', 1, '0', '333.33333333333', '1', '0', '333.33333333333', '20-01-2021', '2021-01-20 10:47:30', '2021-01-20 10:47:30'),
(6, 'BK-100', 3, '1', 1, '0', '333.33333333333', '1', '0', '333.33333333333', '20-01-2021', '2021-01-20 10:47:44', '2021-01-20 10:47:44'),
(7, 'BK-100', 3, '1', 1, '0', '333.33333333333', '1', '0', '333.33333333333', '20-01-2021', '2021-01-20 10:48:24', '2021-01-20 10:48:24'),
(8, 'BK-101', 3, 'BK-101', 1, '175000', '184000', '1', '175000', '184000', '20-01-2021', '2021-01-20 12:50:10', '2021-01-20 12:50:10'),
(9, 'BK-103', 2, 'BK-103', 1, '111500', '120000', '1', '111500', '120000', '20-01-2021', '2021-01-20 13:36:07', '2021-01-20 13:36:07');

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
  `user_id` int(11) NOT NULL,
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
  `purchase_type` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `recivecashes`
--

INSERT INTO `recivecashes` (`id`, `invoice_no`, `customer_id`, `showroom_id`, `received`, `received_date`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'BK-100', 1, 1, '20000', '20-01-2021', 1, '2021-01-20 10:45:36', '2021-01-20 10:45:36'),
(2, 'BK-100', 1, 1, '15000', '20-01-2021', 1, '2021-01-20 10:46:44', '2021-01-20 10:46:44'),
(3, 'BK-100', 1, 1, '17000', '20-01-2021', 1, '2021-01-20 10:47:30', '2021-01-20 10:47:30'),
(4, 'BK-100', 1, 1, '35000', '20-01-2021', 1, '2021-01-20 10:47:44', '2021-01-20 10:47:44'),
(5, 'BK-100', 1, 1, '15000', '20-01-2021', 1, '2021-01-20 10:48:24', '2021-01-20 10:48:24'),
(6, 'BK-101', 2, 1, '127500', '20-01-2021', 1, '2021-01-20 12:50:10', '2021-01-20 12:50:10'),
(7, 'BK-103', 4, 1, '85000', '20-01-2021', 1, '2021-01-20 13:36:07', '2021-01-20 13:36:07');

-- --------------------------------------------------------

--
-- Table structure for table `registrations`
--

CREATE TABLE `registrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bikecustomer_id` int(11) NOT NULL,
  `bike_id` int(11) NOT NULL,
  `registrationtype` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vatamount` int(11) NOT NULL,
  `registrationamount` int(11) NOT NULL,
  `total_amount` int(11) NOT NULL DEFAULT 0,
  `payment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `due_amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `delivery_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `registrations`
--

INSERT INTO `registrations` (`id`, `bikecustomer_id`, `bike_id`, `registrationtype`, `vatamount`, `registrationamount`, `total_amount`, `payment`, `due_amount`, `delivery_date`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 3, '2 Years', 2000, 15000, 17000, '10000', '7000', '25-02-2021', 0, '2021-01-20 04:26:45', '2021-01-20 04:26:45'),
(2, 2, 3, '2 Years', 2000, 15500, 17500, '10000', '7500', '25-02-2021', 0, '2021-01-20 12:50:10', '2021-01-20 12:50:10'),
(3, 4, 2, NULL, 1000, 0, 1000, '1000', '0', '0', 0, '2021-01-20 13:36:07', '2021-01-20 13:36:07');

-- --------------------------------------------------------

--
-- Table structure for table `returnorders`
--

CREATE TABLE `returnorders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `return_invoice` int(11) NOT NULL,
  `sell_invoice` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `showroom_id` int(11) NOT NULL,
  `sellprice` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deducted` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `return_cash` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `return_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
(1, 'Owner', '2021-01-19 09:26:48', '2021-01-19 09:26:48'),
(2, 'Manager', '2021-01-19 09:26:48', '2021-01-19 09:26:48'),
(3, 'User', '2021-01-19 09:26:48', '2021-01-19 09:26:48');

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
(1, 'TVS AUTO', 'Moheshpur', '01823151351', 'Motorcycle', '19-01-2022', '1611070085zfktu7.PI_S.png', '1', '1611070085,TVS_AUTO,2718y', '2021-01-19 09:28:06', '2021-01-19 09:28:06');

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

--
-- Dumping data for table `showroom_user`
--

INSERT INTO `showroom_user` (`id`, `showroom_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 2, NULL, NULL);

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

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`id`, `categorie_id`, `subcategory_name`, `makeby`, `created_at`, `updated_at`) VALUES
(1, 1, '150CC', 1, '2021-01-19 10:11:47', '2021-01-19 10:11:47'),
(2, 1, '160 CC', 1, '2021-01-19 10:11:55', '2021-01-19 10:11:55'),
(3, 1, '125 CC', 1, '2021-01-19 10:12:02', '2021-01-19 10:12:02');

-- --------------------------------------------------------

--
-- Table structure for table `submenus`
--

CREATE TABLE `submenus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `index_no` int(11) NOT NULL,
  `mainmenu_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `submenu_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `submenu_route` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `submenus`
--

INSERT INTO `submenus` (`id`, `index_no`, `mainmenu_id`, `submenu_name`, `submenu_route`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Showroom Panel', 'Add Showroom', 'Add.Showroom', '1', '2021-01-21 14:21:19', '2021-01-21 14:21:19'),
(2, 1, 'Showroom Staff', 'User Details', 'Add.User', '1', '2021-01-21 14:21:19', '2021-01-21 14:21:19'),
(3, 2, 'Showroom Staff', 'Menu Permission', 'menu.permission', '1', '2021-01-21 14:21:19', '2021-01-21 14:21:19'),
(4, 1, 'Product', 'Add Category', 'categories.index', '1', '2021-01-21 14:21:19', '2021-01-21 14:21:19'),
(5, 2, 'Product', 'Sub Category', 'subcategories.index', '1', '2021-01-21 14:21:19', '2021-01-21 14:21:19'),
(6, 3, 'Product', 'Brand', 'brand.index', '1', '2021-01-21 14:21:19', '2021-01-21 14:21:19'),
(7, 4, 'Product', 'Add Product', 'Product.index', '1', '2021-01-21 14:21:19', '2021-01-21 14:21:19'),
(8, 5, 'Product', 'Product List', 'Product.List', '1', '2021-01-21 14:21:19', '2021-01-21 14:21:19'),
(9, 6, 'Product', 'Product Purchase', 'product.purchase_index', '1', '2021-01-21 14:21:19', '2021-01-21 14:21:19'),
(10, 7, 'Product', 'Product Stoke', 'product.stoke_index', '1', '2021-01-21 14:21:19', '2021-01-21 14:21:19'),
(11, 8, 'Product', 'Purchase Details', 'product.details_index', '1', '2021-01-21 14:21:19', '2021-01-21 14:21:19'),
(12, 9, 'Product', 'Bike Add', 'bike.nameadd', '1', '2021-01-21 14:21:19', '2021-01-21 14:21:19'),
(13, 10, 'Product', 'Bike Purchase', 'bike.purchase', '1', '2021-01-21 14:21:19', '2021-01-21 14:21:19'),
(14, 11, 'Product', 'Bike Stoke', 'bike.stokedetails', '1', '2021-01-21 14:21:19', '2021-01-21 14:21:19'),
(15, 1, 'Order', 'Bike Sell', 'bike.sell', '1', '2021-01-21 14:21:19', '2021-01-21 14:21:19'),
(16, 2, 'Order', 'Sell Details', 'bikesell.details', '1', '2021-01-21 14:21:19', '2021-01-21 14:21:19'),
(17, 3, 'Order', 'Sell Order', 'Order.Index', '1', '2021-01-21 14:21:19', '2021-01-21 14:21:19'),
(18, 4, 'Order', 'Invoice Order', 'Order.Invoice', '1', '2021-01-21 14:21:19', '2021-01-21 14:21:19'),
(19, 5, 'Order', 'Order Details', 'Order.Details', '1', '2021-01-21 14:21:19', '2021-01-21 14:21:19'),
(20, 6, 'Order', 'Return Order', 'order.return', '1', '2021-01-21 14:21:19', '2021-01-21 14:21:19'),
(21, 7, 'Order', 'Return Details', 'return.details', '1', '2021-01-21 14:21:19', '2021-01-21 14:21:19'),
(22, 1, 'Bike', 'Installment', 'bikesell.installment', '1', '2021-01-21 14:21:19', '2021-01-21 14:21:19'),
(23, 2, 'Bike', 'Payment Receive', 'payment.received', '1', '2021-01-21 14:21:19', '2021-01-21 14:21:19'),
(24, 3, 'Bike', 'Bike Registration', 'registration.details', '1', '2021-01-21 14:21:19', '2021-01-21 14:21:19'),
(25, 4, 'Bike', 'Customer Accounts', 'customer.accounts_details', '1', '2021-01-21 14:21:19', '2021-01-21 14:21:19'),
(26, 1, 'Accounts', 'Suppliers', 'supplier.indexdata', '1', '2021-01-21 14:21:19', '2021-01-21 14:21:19'),
(27, 2, 'Accounts', 'Customers', 'customer.index', '1', '2021-01-21 14:21:19', '2021-01-21 14:21:19'),
(28, 3, 'Accounts', 'Showroom Cost', 'showroom.cost', '1', '2021-01-21 14:21:19', '2021-01-21 14:21:19'),
(29, 4, 'Accounts', 'Showroom Profit', 'showroom.profit', '1', '2021-01-21 14:21:19', '2021-01-21 14:21:19'),
(30, 5, 'Accounts', 'Receive Cash', 'showroom.recivecash', '1', '2021-01-21 14:21:19', '2021-01-21 14:21:19'),
(31, 1, 'Report', 'Showroom Summery', 'showroom.summery', '1', '2021-01-21 14:21:19', '2021-01-21 14:21:19'),
(32, 2, 'Report', 'Product Stoke Search', 'product.stokefilter', '1', '2021-01-21 14:21:19', '2021-01-21 14:21:19'),
(33, 3, 'Report', 'Selling Report', 'selling.details', '1', '2021-01-21 14:21:19', '2021-01-21 14:21:19'),
(34, 1, 'Setting', 'Vat setting', 'showroom.vatsetting', '1', '2021-01-21 14:21:19', '2021-01-21 14:21:19'),
(35, 2, 'Setting', 'Print Setting', 'showroom.printerset', '1', '2021-01-21 14:21:19', '2021-01-21 14:21:19'),
(36, 3, 'Setting', 'Product Barcode', 'barcode.generate', '1', '2021-01-21 14:21:19', '2021-01-21 14:21:19'),
(37, 1, 'Showroom Panel', 'Add Showroom', 'Add.Showroom', '1', '2021-01-21 14:22:59', '2021-01-21 14:22:59'),
(38, 1, 'Showroom Staff', 'User Details', 'Add.User', '1', '2021-01-21 14:22:59', '2021-01-21 14:22:59'),
(39, 2, 'Showroom Staff', 'Menu Permission', 'menu.permission', '1', '2021-01-21 14:22:59', '2021-01-21 14:22:59'),
(40, 1, 'Product', 'Add Category', 'categories.index', '1', '2021-01-21 14:22:59', '2021-01-21 14:22:59'),
(41, 2, 'Product', 'Sub Category', 'subcategories.index', '1', '2021-01-21 14:22:59', '2021-01-21 14:22:59'),
(42, 3, 'Product', 'Brand', 'brand.index', '1', '2021-01-21 14:22:59', '2021-01-21 14:22:59'),
(43, 4, 'Product', 'Add Product', 'Product.index', '1', '2021-01-21 14:22:59', '2021-01-21 14:22:59'),
(44, 5, 'Product', 'Product List', 'Product.List', '1', '2021-01-21 14:22:59', '2021-01-21 14:22:59'),
(45, 6, 'Product', 'Product Purchase', 'product.purchase_index', '1', '2021-01-21 14:22:59', '2021-01-21 14:22:59'),
(46, 7, 'Product', 'Product Stoke', 'product.stoke_index', '1', '2021-01-21 14:22:59', '2021-01-21 14:22:59'),
(47, 8, 'Product', 'Purchase Details', 'product.details_index', '1', '2021-01-21 14:22:59', '2021-01-21 14:22:59'),
(48, 9, 'Product', 'Bike Add', 'bike.nameadd', '1', '2021-01-21 14:22:59', '2021-01-21 14:22:59'),
(49, 10, 'Product', 'Bike Purchase', 'bike.purchase', '1', '2021-01-21 14:22:59', '2021-01-21 14:22:59'),
(50, 11, 'Product', 'Bike Stoke', 'bike.stokedetails', '1', '2021-01-21 14:22:59', '2021-01-21 14:22:59'),
(51, 1, 'Order', 'Bike Sell', 'bike.sell', '1', '2021-01-21 14:22:59', '2021-01-21 14:22:59'),
(52, 2, 'Order', 'Sell Details', 'bikesell.details', '1', '2021-01-21 14:22:59', '2021-01-21 14:22:59'),
(53, 3, 'Order', 'Sell Order', 'Order.Index', '1', '2021-01-21 14:22:59', '2021-01-21 14:22:59'),
(54, 4, 'Order', 'Invoice Order', 'Order.Invoice', '1', '2021-01-21 14:22:59', '2021-01-21 14:22:59'),
(55, 5, 'Order', 'Order Details', 'Order.Details', '1', '2021-01-21 14:22:59', '2021-01-21 14:22:59'),
(56, 6, 'Order', 'Return Order', 'order.return', '1', '2021-01-21 14:22:59', '2021-01-21 14:22:59'),
(57, 7, 'Order', 'Return Details', 'return.details', '1', '2021-01-21 14:22:59', '2021-01-21 14:22:59'),
(58, 1, 'Bike', 'Installment', 'bikesell.installment', '1', '2021-01-21 14:22:59', '2021-01-21 14:22:59'),
(59, 2, 'Bike', 'Payment Receive', 'payment.received', '1', '2021-01-21 14:22:59', '2021-01-21 14:22:59'),
(60, 3, 'Bike', 'Bike Registration', 'registration.details', '1', '2021-01-21 14:22:59', '2021-01-21 14:22:59'),
(61, 4, 'Bike', 'Customer Accounts', 'customer.accounts_details', '1', '2021-01-21 14:22:59', '2021-01-21 14:22:59'),
(62, 1, 'Accounts', 'Suppliers', 'supplier.indexdata', '1', '2021-01-21 14:22:59', '2021-01-21 14:22:59'),
(63, 2, 'Accounts', 'Customers', 'customer.index', '1', '2021-01-21 14:22:59', '2021-01-21 14:22:59'),
(64, 3, 'Accounts', 'Showroom Cost', 'showroom.cost', '1', '2021-01-21 14:22:59', '2021-01-21 14:22:59'),
(65, 4, 'Accounts', 'Showroom Profit', 'showroom.profit', '1', '2021-01-21 14:22:59', '2021-01-21 14:22:59'),
(66, 5, 'Accounts', 'Receive Cash', 'showroom.recivecash', '1', '2021-01-21 14:22:59', '2021-01-21 14:22:59'),
(67, 1, 'Report', 'Showroom Summery', 'showroom.summery', '1', '2021-01-21 14:22:59', '2021-01-21 14:22:59'),
(68, 2, 'Report', 'Product Stoke Search', 'product.stokefilter', '1', '2021-01-21 14:22:59', '2021-01-21 14:22:59'),
(69, 3, 'Report', 'Selling Report', 'selling.details', '1', '2021-01-21 14:22:59', '2021-01-21 14:22:59'),
(70, 1, 'Setting', 'Vat setting', 'showroom.vatsetting', '1', '2021-01-21 14:22:59', '2021-01-21 14:22:59'),
(71, 2, 'Setting', 'Print Setting', 'showroom.printerset', '1', '2021-01-21 14:22:59', '2021-01-21 14:22:59'),
(72, 3, 'Setting', 'Product Barcode', 'barcode.generate', '1', '2021-01-21 14:22:59', '2021-01-21 14:22:59');

-- --------------------------------------------------------

--
-- Table structure for table `submenu_user`
--

CREATE TABLE `submenu_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `submenu_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `submenu_user`
--

INSERT INTO `submenu_user` (`id`, `user_id`, `submenu_id`, `created_at`, `updated_at`) VALUES
(1, 2, 1, NULL, NULL),
(2, 2, 2, NULL, NULL),
(3, 2, 12, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `supplierpayments`
--

CREATE TABLE `supplierpayments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `supplier_id` int(11) NOT NULL,
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
(1, 'TVS Motors', 'Moheshpur', '32', 1, '1', '2021-01-20 04:03:55', '2021-01-20 04:03:55');

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
(1, 1, 1, 101, '0', 0, '2021-01-20 04:03:55', '2021-01-20 04:03:55'),
(2, 1, 1, 30000, '555000', 1, '2021-01-20 04:04:27', '2021-01-20 04:04:27'),
(3, 1, 1, 30001, '1035000', 1, '2021-01-20 13:09:21', '2021-01-20 13:09:21');

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
(1, 'Abdus Samad', '01823151351', '1', 'samad1230@gmail.com', NULL, '$2y$10$81RdcxKkXstdZbZpuH8jDuWcRa83GvuxlT8sZV3ZBf3C/0I0mmmPK', '1611070102l3fwtd.PI_S.jpg', '1', NULL, NULL, '2021-01-19 09:28:22'),
(2, 'Manik', '018256241', '2', 'manik@gmail.com', NULL, '$2y$10$egLPWFrupD7NvqeoLE7i9umzxrAk3TJY962ana5RfRAdQKqJ9pcH2', '1611258949j8op7m.PI_S.jpg', '1', NULL, '2021-01-21 13:55:49', '2021-01-21 13:55:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barcodes`
--
ALTER TABLE `barcodes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bikecustomers`
--
ALTER TABLE `bikecustomers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bikeidentities`
--
ALTER TABLE `bikeidentities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bikepayments`
--
ALTER TABLE `bikepayments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bikepurchases`
--
ALTER TABLE `bikepurchases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bikes`
--
ALTER TABLE `bikes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bikesells`
--
ALTER TABLE `bikesells`
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
-- Indexes for table `expences`
--
ALTER TABLE `expences`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `installments`
--
ALTER TABLE `installments`
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
-- Indexes for table `registrations`
--
ALTER TABLE `registrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `returnorders`
--
ALTER TABLE `returnorders`
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
-- Indexes for table `submenus`
--
ALTER TABLE `submenus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `submenu_user`
--
ALTER TABLE `submenu_user`
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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bikecustomers`
--
ALTER TABLE `bikecustomers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `bikeidentities`
--
ALTER TABLE `bikeidentities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `bikepayments`
--
ALTER TABLE `bikepayments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `bikepurchases`
--
ALTER TABLE `bikepurchases`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bikes`
--
ALTER TABLE `bikes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `bikesells`
--
ALTER TABLE `bikesells`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
-- AUTO_INCREMENT for table `expences`
--
ALTER TABLE `expences`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `installments`
--
ALTER TABLE `installments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `profitorders`
--
ALTER TABLE `profitorders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `purchasecosts`
--
ALTER TABLE `purchasecosts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `recivecashes`
--
ALTER TABLE `recivecashes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `registrations`
--
ALTER TABLE `registrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `returnorders`
--
ALTER TABLE `returnorders`
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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `submenus`
--
ALTER TABLE `submenus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `submenu_user`
--
ALTER TABLE `submenu_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `supplierpayments`
--
ALTER TABLE `supplierpayments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `supplier_accounts`
--
ALTER TABLE `supplier_accounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
