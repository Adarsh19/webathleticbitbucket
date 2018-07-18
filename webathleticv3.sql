-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 04, 2018 at 06:01 PM
-- Server version: 5.7.16
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webathleticv3`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `id` int(10) UNSIGNED NOT NULL,
  `log_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `subject_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `causer_id` int(11) DEFAULT NULL,
  `causer_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `properties` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`id`, `log_name`, `description`, `subject_id`, `subject_type`, `causer_id`, `causer_type`, `properties`, `created_at`, `updated_at`) VALUES
(1, 'Check In', 'logged in successfully.', NULL, NULL, 1, 'App\\User', '[]', '2018-06-04 05:15:15', '2018-06-04 05:15:15'),
(2, 'default', 'updated', 1, 'App\\Company', 1, 'App\\User', '{"attributes":{"company_name":"aweqweqw","address":"A\\/2, ravi tenement, A\\/2, ravi tenement","primary_language":"ewqwe","City":"asd","allow_cashback":2,"visit_location":2,"phone_main":"sd@gma.com","email_main":"sd@gma.com"},"old":{"company_name":null,"address":"A\\/2, ravi tenement, A\\/2, ravi tenement","primary_language":null,"City":null,"allow_cashback":0,"visit_location":0,"phone_main":null,"email_main":null}}', '2018-06-04 05:58:17', '2018-06-04 05:58:17'),
(3, 'Check In', 'logged in successfully.', NULL, NULL, 13, 'App\\User', '[]', '2018-06-04 06:58:22', '2018-06-04 06:58:22');

-- --------------------------------------------------------

--
-- Table structure for table `calendar_connected_users`
--

CREATE TABLE `calendar_connected_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `parent_user_id` int(11) NOT NULL,
  `schedule_id` int(11) NOT NULL,
  `user_color_code` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `calendar_connected_users`
--

INSERT INTO `calendar_connected_users` (`id`, `user_id`, `parent_user_id`, `schedule_id`, `user_color_code`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '#7d2c2c', '2018-06-04 05:21:52', '2018-06-04 05:53:47'),
(2, 2, 1, 1, '#0f2cc2', '2018-06-04 05:54:10', '2018-06-04 05:54:10');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `iban` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `taal` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `klant_sinds` date DEFAULT NULL,
  `about` text COLLATE utf8mb4_unicode_ci,
  `user_meta` text COLLATE utf8mb4_unicode_ci,
  `role` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `activation_status` tinyint(4) NOT NULL DEFAULT '0',
  `block_reason` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `blocked_at` timestamp NULL DEFAULT NULL,
  `place_holder` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_of_account_holder` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bic_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `barcode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(255) NOT NULL,
  `parent_id` bigint(20) DEFAULT '1',
  `Soort` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `City` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Contactpersoon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cashback` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_main` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_contact` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_administration` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_main` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_contact` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_administration` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kvk_number` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `btw_number` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `primary_language` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `visit_location` tinyint(4) NOT NULL,
  `allow_cashback` tinyint(4) NOT NULL,
  `zipcode` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `name`, `password`, `avatar`, `gender`, `phone`, `address`, `birthday`, `iban`, `taal`, `klant_sinds`, `about`, `user_meta`, `role`, `activation_status`, `block_reason`, `blocked_at`, `place_holder`, `name_of_account_holder`, `bic_code`, `barcode`, `remember_token`, `user_id`, `parent_id`, `Soort`, `City`, `Contactpersoon`, `cashback`, `created_at`, `updated_at`, `slug`, `phone_main`, `phone_contact`, `phone_administration`, `email_main`, `email_contact`, `email_administration`, `kvk_number`, `btw_number`, `primary_language`, `company_name`, `state`, `visit_location`, `allow_cashback`, `zipcode`) VALUES
(1, 'snehal', '$2y$10$fTInGzIS1X/BpYh8OIqhYuLscfionuHf0BbE6C/9WnJZWojRXCyAS', NULL, 'm', '1234567890', 'A/2, ravi tenement, A/2, ravi tenement', '2005-01-29', 'dafbgsadf', 'adfbadfbdf', '1970-01-03', 'wedgvawsedv', NULL, 'Company1', 0, '', '2018-05-22 07:16:04', NULL, NULL, NULL, NULL, 'nkImrflv8AfpmsIFi8MAxzxiWm6rsRKB4YeX9DxaRYQeBIOuu5gdk7tXKCcG', 1, 1, 'adsvadsfv', 'asd', 'snehal', 'active', '2018-04-18 12:33:16', '2018-06-04 05:58:17', 'Misty_Streich3645', 'sd@gma.com', NULL, NULL, 'sd@gma.com', NULL, NULL, NULL, NULL, 'ewqwe', 'aweqweqw', NULL, 2, 2, '23123'),
(2, 'Joel Hammes', '$2y$10$fTInGzIS1X/BpYh8OIqhYuLscfionuHf0BbE6C/9WnJZWojRXCyAS', '2.png', NULL, NULL, NULL, '0000-00-00', '', '', '0000-00-00', NULL, '{"i":{"kcal":"1200","eiwit":"12525","koolhydraat":"12065646","vezel":"238882","vet":"120885"},"b":{"kcal":"125550","eiwit":"12","koolhydraat":"12","vezel":"12","vet":"120"},"doelstelling":"Test Message","mayur":"test"}', 'user', 1, '', '2018-05-22 07:16:07', NULL, NULL, NULL, NULL, 'tGxUwVOCYKJ9RML2TQOoTa5CrzJbCzYWmzLEAEfdDfHjspcPVF9swVefZIYj', 0, 1, NULL, NULL, NULL, NULL, '2018-04-18 12:33:16', '2018-05-08 12:18:04', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(3, 'Andres Metz Sr.', '$2y$10$oWeLVANkG.dkOCsbqynHyue3KL1MUXw6JEnQf2vpaaL.0gCBlYDei', NULL, 'f', '9876543210', 'adsofihvopads', '2012-02-24', NULL, 'Angola', '1970-01-01', 'asdvas', NULL, 'user', 1, '', '2018-05-22 07:16:07', NULL, NULL, NULL, NULL, 'xEFj6SkKKm', 0, 1, NULL, NULL, NULL, NULL, '2018-04-18 12:33:16', '2018-05-22 01:09:59', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(4, 'Marisa Effertz', '$2y$10$oWeLVANkG.dkOCsbqynHyue3KL1MUXw6JEnQf2vpaaL.0gCBlYDei', NULL, NULL, NULL, NULL, '0000-00-00', '', '', '0000-00-00', NULL, NULL, 'user', 0, '', '2018-05-22 07:16:08', NULL, NULL, NULL, NULL, 'lhk2Wysftn', 0, 1, NULL, NULL, NULL, NULL, '2018-04-18 12:33:16', '2018-04-18 12:33:16', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(5, 'Hilton Bergnaum', '$2y$10$oWeLVANkG.dkOCsbqynHyue3KL1MUXw6JEnQf2vpaaL.0gCBlYDei', NULL, NULL, NULL, NULL, '0000-00-00', '', '', '0000-00-00', NULL, NULL, 'user', 0, '', '2018-05-22 07:16:08', NULL, NULL, NULL, NULL, 'ZSawMIPsf4', 0, 1, NULL, NULL, NULL, NULL, '2018-04-18 12:33:16', '2018-04-18 12:33:16', 'Hilton_Bergnaum6847', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(6, 'Clint Von PhD', '$2y$10$oWeLVANkG.dkOCsbqynHyue3KL1MUXw6JEnQf2vpaaL.0gCBlYDei', NULL, NULL, NULL, NULL, '0000-00-00', '', '', '0000-00-00', NULL, NULL, 'user', 1, '', '2018-05-22 07:16:10', NULL, NULL, NULL, NULL, 'l4J6fv1pvI', 0, 1, NULL, NULL, NULL, NULL, '2018-04-18 12:33:16', '2018-04-18 13:35:12', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(7, 'Theresa Sporer', '$2y$10$oWeLVANkG.dkOCsbqynHyue3KL1MUXw6JEnQf2vpaaL.0gCBlYDei', NULL, NULL, NULL, NULL, '0000-00-00', '', '', '0000-00-00', NULL, NULL, 'user', 0, '', '2018-05-22 07:16:09', NULL, NULL, NULL, NULL, 'WZUdUPOnyp', 0, 1, NULL, NULL, NULL, NULL, '2018-04-18 12:33:16', '2018-04-18 12:33:16', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(8, 'Simeon Koepp', '$2y$10$oWeLVANkG.dkOCsbqynHyue3KL1MUXw6JEnQf2vpaaL.0gCBlYDei', NULL, NULL, NULL, NULL, '0000-00-00', '', '', '0000-00-00', NULL, NULL, 'user', 0, '', '2018-05-22 07:16:10', NULL, NULL, NULL, NULL, 'vsfNgU6mfb', 0, 1, NULL, NULL, NULL, NULL, '2018-04-18 12:33:16', '2018-04-18 12:33:16', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(9, 'Weldon Williamson', '$2y$10$oWeLVANkG.dkOCsbqynHyue3KL1MUXw6JEnQf2vpaaL.0gCBlYDei', NULL, NULL, NULL, NULL, '0000-00-00', '', '', '0000-00-00', NULL, NULL, 'user', 0, '', '2018-05-22 07:16:14', NULL, NULL, NULL, NULL, 'YCjWrawPxj', 0, 1, NULL, NULL, NULL, NULL, '2018-04-18 12:33:16', '2018-04-18 12:33:16', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(10, 'Dr. Donnie Runte', '$2y$10$oWeLVANkG.dkOCsbqynHyue3KL1MUXw6JEnQf2vpaaL.0gCBlYDei', NULL, NULL, NULL, NULL, '0000-00-00', '', '', '0000-00-00', NULL, NULL, 'user', 0, '', '2018-05-22 07:16:15', NULL, NULL, NULL, NULL, 'SMEJgHmGih', 0, 1, NULL, NULL, NULL, NULL, '2018-04-18 12:33:16', '2018-04-18 12:33:16', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(13, 'vishal patel', '$2y$10$W038y1AXKLT7wmhMEgwupeT5JEUMokAldXdeaw0QLz42K/BCMxZtq', NULL, 'm', '9898646866', '702-703 iscon,jodhpur crose', NULL, NULL, NULL, NULL, 'dsfvds', NULL, 'company', 1, '', '2018-05-22 07:16:18', NULL, NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, '2018-05-21 05:18:10', '2018-05-21 05:18:10', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `exercises`
--

CREATE TABLE `exercises` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `tax` decimal(10,2) NOT NULL,
  `slug` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `path` text COLLATE utf8_unicode_ci,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `group_id` int(11) NOT NULL DEFAULT '0',
  `group_priority` int(11) NOT NULL DEFAULT '0',
  `barcode` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `exercises`
--

INSERT INTO `exercises` (`id`, `name`, `price`, `tax`, `slug`, `path`, `user_id`, `group_id`, `group_priority`, `barcode`, `created_at`, `updated_at`) VALUES
(1, 'deadlift1', '0.00', '0.00', 'deadlift', '1528116452.jpeg', 1, 1, 1, 'Slug: deadlift Name: 1 Price: 0.00Tax: 0.00', '2018-06-04 07:17:32', '2018-06-04 07:20:19'),
(2, 'deadlift', '0.00', '0.00', 'deadlift', '1528116452.jpeg', 1, 2, 1, 'Slug: deadlift Name: 2 Price: 0.00Tax: 0.00', '2018-06-04 07:17:32', '2018-06-04 07:17:32');

-- --------------------------------------------------------

--
-- Table structure for table `exercise_accent_muscle_group`
--

CREATE TABLE `exercise_accent_muscle_group` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `musclegroupname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `exercise_goals`
--

CREATE TABLE `exercise_goals` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `goalname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `exercise_has_attributes`
--

CREATE TABLE `exercise_has_attributes` (
  `exerciseid` int(11) NOT NULL,
  `attributeid` int(11) NOT NULL,
  `attributetype` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `exercise_material`
--

CREATE TABLE `exercise_material` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `materiallevel` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `exercise_training_levels`
--

CREATE TABLE `exercise_training_levels` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `traininglevel` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `galleries`
--

CREATE TABLE `galleries` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `caption` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thumb` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `publication_status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `galleries`
--

INSERT INTO `galleries` (`id`, `user_id`, `caption`, `image`, `thumb`, `publication_status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Molestiae ex nihil excepturi asperiores nam quia cupiditate.', '1_786327837.png', 'thumb_1_786327837.png', 1, '2018-04-18 12:33:20', '2018-05-17 07:56:52'),
(2, 1, 'Deserunt enim alias voluptates et quam.', '2_1265860481.png', NULL, 1, '2018-04-18 12:33:21', '2018-05-17 05:40:15'),
(3, 1, 'Quae qui autem dolores autem.', '3_216125584.png', NULL, 1, '2018-04-18 12:33:21', '2018-05-17 05:40:44'),
(4, 1, 'Ut architecto enim possimus sit doloribus explicabo.', '1.jpg', NULL, 0, '2018-04-18 12:33:21', '2018-04-18 12:33:21'),
(5, 1, 'Aut dolor quidem temporibus quasi est et omnis.', '1.jpg', NULL, 0, '2018-04-18 12:33:21', '2018-04-19 16:06:47'),
(6, 1, 'Similique cum temporibus vel nam cumque.', '1.jpg', NULL, 0, '2018-04-18 12:33:21', '2018-04-18 12:33:21'),
(7, 1, 'Dolorum possimus voluptatem aliquam non sapiente.', '1.jpg', NULL, 0, '2018-04-18 12:33:21', '2018-04-18 12:33:21'),
(8, 1, 'Quidem qui consequuntur qui est quisquam dolorem fuga.', '1.jpg', NULL, 0, '2018-04-18 12:33:21', '2018-04-18 12:33:21'),
(9, 1, 'Fugit recusandae officiis deserunt eius animi consequatur.', '1.jpg', NULL, 0, '2018-04-18 12:33:21', '2018-04-18 12:33:21'),
(10, 1, 'Id odit quos reiciendis minima consequuntur quo.', '1.jpg', NULL, 0, '2018-04-18 12:33:21', '2018-04-19 16:06:42'),
(11, 1, 'Non ea veritatis veritatis velit quo magnam non.', '11.jpg', 'thumb_11.jpg', 1, '2018-04-18 12:33:21', '2018-05-17 05:49:53'),
(12, 1, 'Fuga repudiandae veritatis totam quia quia corrupti a.', '12_763253294.png', NULL, 1, '2018-04-18 12:33:21', '2018-05-17 05:42:27'),
(13, 1, 'Et quia doloremque voluptate maiores qui.', '1.jpg', NULL, 1, '2018-04-18 12:33:21', '2018-04-18 12:33:21'),
(14, 1, 'Quo incidunt sit soluta qui molestias rerum distinctio.', '1.jpg', NULL, 1, '2018-04-18 12:33:21', '2018-04-18 12:33:21'),
(15, 1, 'Excepturi voluptas voluptas eum neque eum.', '1.jpg', NULL, 0, '2018-04-18 12:33:21', '2018-04-18 12:33:21');

-- --------------------------------------------------------

--
-- Table structure for table `log_events`
--

CREATE TABLE `log_events` (
  `id` int(255) NOT NULL,
  `log` longtext NOT NULL,
  `user_id` int(255) DEFAULT NULL,
  `role` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(3, '2018_05_03_014539_create_productmedia_table', 2),
(4, '2018_05_05_015755_create_user_orders_table', 2),
(5, '2018_05_05_015850_create_user_has_products_table', 2),
(6, '2018_05_08_165442_create_exercise_goals_table', 2),
(7, '2018_05_08_165549_create_exercise_accent_muscle_group_table', 2),
(8, '2018_05_08_165602_create_exercise_training_levels_table', 2),
(9, '2018_05_08_165625_create_exercise_material_table', 2),
(11, '2018_05_08_181519_create_exercise_has_attributes_table', 2),
(12, '2018_05_15_012750_create_training_schema_table', 2),
(13, '2018_05_15_012802_create_training_schedule_table', 2),
(14, '2018_05_15_012826_create_user_has_schema_table', 2),
(15, '2018_05_15_012850_create_schema_has_exercise_table', 2),
(16, '2018_05_17_100634_add_training_fields_to_users_table', 2),
(17, '2018_05_25_125018_create_users_table', 11),
(18, '2018_05_31_224303_create_calendar_connected_users_table', 12),
(19, '2018_05_31_224329_create_service_events_table', 12),
(20, '2018_05_31_224347_create_service_event_exceptions_table', 12),
(21, '2018_05_31_224414_create_service_opening_hours_table', 12),
(22, '2018_05_31_224435_create_service_schedules_table', 12),
(23, '2018_05_31_224457_create_service_schedule_has_users_table', 12),
(25, '2018_06_01_101328_change_fields_to_companies', 12),
(26, '2018_06_02_213235_create_activity_log_table', 12),
(28, '2018_05_03_014527_create_productgroup_table', 13),
(29, '2018_05_08_165827_create_exercises_table', 14),
(30, '2018_05_31_225906_create_transactions_table', 15);

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` int(10) UNSIGNED NOT NULL,
  `days` int(11) NOT NULL DEFAULT '0',
  `credits` int(11) NOT NULL DEFAULT '0',
  `products` int(11) NOT NULL DEFAULT '0',
  `pro_rato` int(11) NOT NULL DEFAULT '0',
  `expand_automatically` tinyint(4) NOT NULL DEFAULT '0',
  `Start_fee` int(11) NOT NULL DEFAULT '0',
  `entree` int(11) NOT NULL DEFAULT '0',
  `sell_category` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `enquette` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role_id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `max_users` int(255) NOT NULL,
  `added_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payment_days` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `days`, `credits`, `products`, `pro_rato`, `expand_automatically`, `Start_fee`, `entree`, `sell_category`, `enquette`, `created_at`, `updated_at`, `role_id`, `user_id`, `max_users`, `added_by`, `payment_days`) VALUES
(1, 2, 100, 1, 20, 1, 100, 1, 'adrfbgsd', 1200, NULL, '2018-05-25 08:27:50', 0, 0, 0, '', '05/31/2018,05/24/2018,05/17/2018,05/15/2018,05/23/2018,05/22/2018,05/29/2018,05/30/2018,05/16/2018,05/11/2018,05/05/2018,05/07/2018'),
(2, 25, 1205, 1, 12505, 1, 600, 1200, 'sfdwthndfrt', 0, '2018-05-18 06:16:30', '2018-05-25 08:22:59', 0, 0, 0, '', '05/31/2018,05/24/2018,05/17/2018,05/15/2018,05/23/2018,05/22/2018,05/29/2018,05/30/2018,05/16/2018,05/11/2018,05/05/2018,05/07/2018'),
(4, 10, 100, 2, 120, 1, 1200, 1200, 'asdgvads', 0, '2018-05-24 07:23:02', '2018-05-25 07:55:00', 0, 1, 0, '', '05/31/2018,05/24/2018,05/17/2018,05/15/2018,05/23/2018,05/22/2018,05/29/2018,05/30/2018,05/16/2018,05/11/2018,05/05/2018,05/07/2018'),
(5, 4, 200, 2, 120, 1, 220, 150, 'dfbsdfbadf', 0, '2018-05-24 07:27:18', '2018-05-24 07:27:18', 0, 1, 0, '', ''),
(7, 10, 120, 2, 201, 1, 120, 200, 'asdvadsfvads', 0, '2018-05-25 06:24:01', '2018-05-25 07:51:45', 0, 1, 0, 'admin', '05/17/2018,05/18/2018,05/25/2018,05/24/2018,05/31/2018,06/02/2018,06/29/2018,06/15/2018,06/12/2018,06/27/2018,06/13/2018,06/18/2018');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `page_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `page_slug` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `page_content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `page_featured_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thumb` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `publication_status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `user_id`, `page_name`, `category`, `page_slug`, `page_content`, `page_featured_image`, `thumb`, `meta_title`, `meta_keywords`, `meta_description`, `publication_status`, `created_at`, `updated_at`) VALUES
(4, 1, 'sign up', 'join', 'consequatur_a', '<p>Temporibus minima similique eum officia. Est autem voluptas ducimus expedita aut adipisci. Quidem eius cumque libero eos. Tempore esse magnam voluptatem. Accusamus vel fugit ad illum.</p>', NULL, NULL, 'Eos', 'rem, voluptate, voluptatem', 'Voluptates sit temporibus dolorem esse facere. Ab tenetur eum labore sunt deserunt minus. Incidunt omnis quis voluptatem modi totam quia nisi.', 0, '2018-04-18 12:33:20', '2018-05-16 10:01:13'),
(5, 1, 'login', 'join', 'quis_ut', 'Quaerat quidem voluptatem et expedita et quia ut. Consectetur id exercitationem possimus nobis. Rerum voluptas vel voluptas et mollitia sed. Vitae soluta sunt dolor.Quaerat quidem voluptatem et expedita et quia ut. Consectetur id \r\nexercitationem possimus nobis. Rerum voluptas vel voluptas et mollitia \r\nsed. Vitae soluta sunt dolor.Quaerat quidem voluptatem et expedita et quia ut. Consectetur id \r\nexercitationem possimus nobis. Rerum voluptas vel voluptas et mollitia \r\nsed. Vitae soluta sunt dolor.Quaerat quidem voluptatem et expedita et quia ut. Consectetur id \r\nexercitationem possimus nobis. Rerum voluptas vel voluptas et mollitia \r\nsed. Vitae soluta sunt dolor.Quaerat quidem voluptatem et expedita et quia ut. Consectetur id \r\nexercitationem possimus nobis. Rerum voluptas vel voluptas et mollitia \r\nsed. Vitae soluta sunt dolor.Quaerat quidem voluptatem et expedita et quia ut. Consectetur id \r\nexercitationem possimus nobis. Rerum voluptas vel voluptas et mollitia \r\nsed. Vitae soluta sunt dolor.', NULL, NULL, 'Architecto', 'voluptatem, necessitatibus, quia', 'At nulla deleniti non sequi. Voluptate ducimus soluta et. Dolore est odit ex et possimus et. Illum explicabo suscipit aut et sit.', 0, '2018-04-18 12:33:20', '2018-04-18 21:51:48'),
(6, 1, 'company details', 'coaching', 'page_slug', '<p>paldge<br></p>', NULL, NULL, 'page Here', 'Page', 'page here', 0, '2018-04-19 16:32:00', '2018-04-19 16:32:00'),
(11, 1, 'who I am & methods', 'coaching', '1', '', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL),
(12, 1, 'terms', 'conditions', '2', '', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL),
(13, 1, 'conditions', 'conditions', '1-', '', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL),
(14, 1, 'contact us', 'contact', '2-', '', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL),
(15, 1, 'about us', 'contact', 'sdfss', '', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL),
(16, 1, 'privacy policy', 'contact', 'sdf', '', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL),
(17, 1, 'blogs', 'contact', 'sdfd', '', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL),
(18, 1, 'how does it work?', 'information', 'sdfsdfsdfsdf', '<p>yes it is tyyyydsfsdfsdfsdf</p>', NULL, 'thumb_1526567978.png', 'tags', 'titles', 'Description', 1, NULL, '2018-05-17 09:09:38'),
(19, 1, 'connect', 'information', 'nemo_laborum', '<p>Tempora minima molestiae id quidem. Quod laborum itaque quae eveniet et illo quis. Aut nisi similique facilis eligendi aut inventore.</p>', NULL, NULL, 'Nesciunt', 'dolor, illum, ad', 'Eum voluptatum voluptatum adipisci. Ut omnis et corporis quis praesentium in totam.', 0, '2018-04-18 12:33:20', '2018-05-16 10:00:53'),
(20, 1, 'success stories', 'information', 'dolorem_eaque', '<p>Nihil vel qui vel maiores qui laudantium distinctio</p>', NULL, NULL, 'Nobis', 'perferendis, nemo, minus', 'Quae eum et dolorem et. Itaque et eaque ad et consequatur facilis explicabo quod. Dignissimos ipsam quaerat non.', 1, '2018-04-18 12:33:20', '2018-05-16 10:43:56'),
(21, 1, 'services', 'information', 'illo_culpa', '<p>Est atque</p>', NULL, NULL, 'Deserunt', 'consequuntur, amet, nihil', 'Nobis sit aliquid numquam. Nobis sed quaerat quibusdam itaque possimus ipsam sequi vero. Sapiente fuga ea consequatur magnam ex.', 1, '2018-04-18 12:33:20', '2018-05-16 10:43:48');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL,
  `permission` varchar(255) NOT NULL,
  `pdescription` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `added_by` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `permission`, `pdescription`, `user_id`, `created_at`, `updated_at`, `added_by`) VALUES
(1, 'user list', 'user list', 0, NULL, '2018-05-21 07:15:57', ''),
(4, 'user delete', 'user delete', 0, NULL, NULL, ''),
(6, 'user update', 'user update', 0, '2018-05-19 08:34:50', '2018-05-19 08:34:50', ''),
(8, 'user add', 'user add', 0, '2018-05-21 07:21:19', '2018-05-21 07:21:19', '');

-- --------------------------------------------------------

--
-- Table structure for table `productgroup`
--

CREATE TABLE `productgroup` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `imagepath` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `group_type` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'products',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `productgroup`
--

INSERT INTO `productgroup` (`id`, `name`, `slug`, `parent_id`, `imagepath`, `group_type`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'legs', 'legs', 0, 'noimage.jpeg', 'exercises', 1, '2018-06-04 07:15:03', '2018-06-04 07:15:03'),
(2, 'Chect', 'chect', 0, 'noimage.jpeg', 'exercises', 1, '2018-06-04 07:15:42', '2018-06-04 07:15:42'),
(3, 'Hotchoks', 'hotchoks', 0, 'noimage.jpeg', 'products', 1, '2018-06-04 08:39:43', '2018-06-04 08:39:43'),
(4, 'Hotchok', 'hotchok', 3, 'noimage.jpeg', 'products', 1, '2018-06-04 08:41:01', '2018-06-04 08:41:01'),
(5, 'Cold Chk', 'cold-chk', 3, 'noimage.jpeg', 'products', 1, '2018-06-04 08:41:23', '2018-06-04 08:41:23');

-- --------------------------------------------------------

--
-- Table structure for table `productmedia`
--

CREATE TABLE `productmedia` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `tax` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `category` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `unlimited_stock` int(11) NOT NULL,
  `slug` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `path` text COLLATE utf8_unicode_ci,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `group_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `productmedia`
--

INSERT INTO `productmedia` (`id`, `name`, `price`, `tax`, `stock`, `category`, `unlimited_stock`, `slug`, `type`, `path`, `user_id`, `group_id`, `created_at`, `updated_at`) VALUES
(1, 'cold chok', '10.00', '1.00', 0, 'product_2018-06-04 14:09:08', 1, 'cold-chok', 'image', '15281213480.jpg', 1, 2, '2018-06-04 08:39:08', '2018-06-04 08:39:08'),
(2, 'Cold', '10.00', '1.00', 0, 'product_2018-06-04 14:11:41', 1, 'hot', 'image', '15281215010.jpg', 1, 5, '2018-06-04 08:41:41', '2018-06-04 08:42:08');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(255) UNSIGNED NOT NULL,
  `role` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `rdescription` text COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `added_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`, `rdescription`, `user_id`, `created_at`, `updated_at`, `added_by`) VALUES
(1, 'Administrator', 'This role stands for back side consumers of this product.', 1, '2018-05-18 06:35:02', '2018-05-21 07:50:24', ''),
(2, 'User', 'This role stands for front side customers of this product.', 1, '2018-05-18 06:35:59', '2018-05-18 06:35:59', ''),
(3, 'Company', 'company role is third party role', 0, '2018-05-21 07:52:38', '2018-05-21 07:52:38', ''),
(4, 'New Company', 'Testing the company roles.', 1, '2018-05-24 06:40:09', '2018-05-24 06:40:09', 'company1');

-- --------------------------------------------------------

--
-- Table structure for table `role_credentials`
--

CREATE TABLE `role_credentials` (
  `id` int(255) NOT NULL,
  `role_id` int(255) NOT NULL,
  `menu_id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role_credentials`
--

INSERT INTO `role_credentials` (`id`, `role_id`, `menu_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 0, NULL, NULL),
(24, 1, 1, 0, '2018-05-23 04:12:13', '2018-05-23 04:12:13'),
(25, 1, 4, 0, '2018-05-23 04:12:13', '2018-05-23 04:12:13'),
(26, 1, 6, 0, '2018-05-23 04:12:13', '2018-05-23 04:12:13'),
(27, 1, 8, 0, '2018-05-23 04:12:13', '2018-05-23 04:12:13');

-- --------------------------------------------------------

--
-- Table structure for table `schema_has_exercise`
--

CREATE TABLE `schema_has_exercise` (
  `id` int(10) UNSIGNED NOT NULL,
  `schema_id` int(11) NOT NULL,
  `exercise_id` int(11) NOT NULL,
  `sets` int(11) DEFAULT NULL,
  `reps` int(11) DEFAULT NULL,
  `rust` int(11) DEFAULT NULL,
  `ex_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `priority` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `schema_has_exercise`
--

INSERT INTO `schema_has_exercise` (`id`, `schema_id`, `exercise_id`, `sets`, `reps`, `rust`, `ex_name`, `priority`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 1, 1, 1, 'deadlift', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `service` varchar(255) NOT NULL,
  `sdescription` text NOT NULL,
  `company_id` int(11) NOT NULL,
  `sprice` int(255) NOT NULL,
  `user_mass` int(255) NOT NULL,
  `payment_time` int(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `added_by` varchar(255) NOT NULL,
  `bg_color` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `service`, `sdescription`, `company_id`, `sprice`, `user_mass`, `payment_time`, `created_at`, `updated_at`, `added_by`, `bg_color`) VALUES
(1, 'service1', 'hello world, idswfbvndisa, asdvads. adfbv. asgdvbads', 1, 100, 200, 1200, NULL, NULL, '', ''),
(2, 'services', 'hello world, idswfbvndisa, asdvads. adfbv. asgddfwvbads', 0, 10, 20, 30, '2018-05-23 04:57:31', '2018-05-25 01:41:14', '', ''),
(3, 'New Service', 'hello world, idswfbvndisa, asdvads. adfbv.', 0, 100, 1000, 1200, '2018-05-24 07:44:19', '2018-05-25 02:16:05', 'company1', ''),
(4, 'helloo world', 'this is testing. only testing. No other intention please. afadssdfuiylghsd.', 0, 10, 20, 25, '2018-05-25 01:26:35', '2018-05-25 02:04:11', 'admin', '');

-- --------------------------------------------------------

--
-- Table structure for table `service_events`
--

CREATE TABLE `service_events` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `all_day` tinyint(4) NOT NULL,
  `service_schedule_id` int(11) NOT NULL,
  `app_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `notes` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `reminder` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `rrule` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `duration` int(11) NOT NULL,
  `editable` tinyint(4) NOT NULL,
  `can_user_book` enum('1','0') COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `backgroundColor` varchar(7) COLLATE utf8_unicode_ci NOT NULL,
  `borderColor` varchar(7) COLLATE utf8_unicode_ci NOT NULL,
  `service_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `service_events`
--

INSERT INTO `service_events` (`id`, `title`, `start`, `end`, `all_day`, `service_schedule_id`, `app_id`, `location`, `notes`, `url`, `reminder`, `rrule`, `duration`, `editable`, `can_user_book`, `backgroundColor`, `borderColor`, `service_id`, `created_at`, `updated_at`) VALUES
(1, 'services', '2018-05-10 01:15:00', '2018-05-31 01:30:00', 0, 0, '', 'Srinagr', 'Srinagr', '', '', 'FREQ=WEEKLY;INTERVAL=1;BYDAY=TH;COUNT=10', 31695, 1, '1', '', '', 0, '2018-06-04 05:36:04', '2018-06-04 05:36:04');

-- --------------------------------------------------------

--
-- Table structure for table `service_event_exceptions`
--

CREATE TABLE `service_event_exceptions` (
  `id` int(10) UNSIGNED NOT NULL,
  `event_id` int(11) NOT NULL,
  `exdate` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `service_opening_hours`
--

CREATE TABLE `service_opening_hours` (
  `id` int(10) UNSIGNED NOT NULL,
  `business_days` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `business_hours` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `min_time` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `max_time` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `service_schedules`
--

CREATE TABLE `service_schedules` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `color` varchar(7) COLLATE utf8_unicode_ci NOT NULL,
  `hidden` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `role` int(11) NOT NULL,
  `dragdrop` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `service_schedules`
--

INSERT INTO `service_schedules` (`id`, `title`, `color`, `hidden`, `user_id`, `role`, `dragdrop`, `created_at`, `updated_at`) VALUES
(1, 'My first schedule', '#c42222', 'yes', 1, 1, 1, '2018-06-04 05:18:55', '2018-06-04 05:18:55');

-- --------------------------------------------------------

--
-- Table structure for table `service_schedule_has_users`
--

CREATE TABLE `service_schedule_has_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `service_schedule_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `bookflag` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `service_schedule_has_users`
--

INSERT INTO `service_schedule_has_users` (`id`, `service_schedule_id`, `user_id`, `bookflag`, `created_at`, `updated_at`) VALUES
(1, 0, 1, 1, NULL, NULL),
(2, 0, 1, 1, NULL, NULL),
(3, 0, 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `site_images`
--

CREATE TABLE `site_images` (
  `id` int(255) NOT NULL,
  `name` varchar(1024) DEFAULT NULL,
  `src` varchar(1024) DEFAULT NULL,
  `title` varchar(1024) DEFAULT NULL,
  `description` varchar(1024) DEFAULT NULL,
  `type` varchar(1024) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `site_images`
--

INSERT INTO `site_images` (`id`, `name`, `src`, `title`, `description`, `type`) VALUES
(1, 'logo', 'images/logo.png', 'logo', 'logo', 'logo'),
(2, 'banner', 'images/home-img.png', 'banner', 'banner', 'banner'),
(3, 'footer-woomen', 'images/women-img.png ', NULL, NULL, NULL),
(4, 'none', 'images/1526540438glpus2.jpg', 'none', 'none', 'other'),
(5, 'test', 'images/152654242011_tshirt_front_woman.jpg', 'test', 'test', 'banner');

-- --------------------------------------------------------

--
-- Table structure for table `stories`
--

CREATE TABLE `stories` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `possition` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `story_featured_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thumb` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `publication_status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stories`
--

INSERT INTO `stories` (`id`, `user_id`, `name`, `content`, `possition`, `story_featured_image`, `thumb`, `publication_status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Nesciunt test again', '<p>Story Table</p>\r\n<p>&nbsp;</p>', 'Story Table Here', '1.jpg', 'thumb_1.jpg', 1, '2018-04-18 12:33:20', '2018-05-17 08:47:21'),
(2, 1, 'Nobis', '<p>Nihil vel qui vel maiores qui laudantium distinctio. Quaerat sapiente sint voluptatem consequatur aperiam placeat. Sequi ad voluptatem ut deleniti dolorem.</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>', 'Story Table Here', '2_1168218981.png', NULL, 1, '2018-04-18 12:33:20', '2018-05-17 05:02:14'),
(3, 1, 'Deserunt', '<p>Est atque consectetur accusantium quod. Fuga quos non nulla id accusamus. Quasi consequuntur quae amet voluptas aut deserunt. hi there</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>', 'Story Table Here', '3.jpg', NULL, 1, '2018-04-18 12:33:20', '2018-05-16 10:51:16'),
(6, 1, 'story name is Ulrich', '<p>Nihil vel qui vel maiores qui laudantium distinctio. Quaerat sapiente sint voluptatem consequatur aperiam placeat. Sequi ad voluptatem ut delenit</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>', 'Story Table Here', '6_1576047592.png', NULL, 1, '2018-04-19 13:44:17', '2018-05-17 05:43:07'),
(7, 1, 'Name of my', '<p>ttetstsdf ksdjf sd kjsd s</p>\r\n<p>dddd</p>\r\n<p>sdsd</p>', 'Designation of Client', '7.jpg', 'thumb_7.jpg', 1, '2018-04-19 16:44:32', '2018-05-17 06:05:46');

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscribers`
--

INSERT INTO `subscribers` (`id`, `email`, `created_at`, `updated_at`) VALUES
(1, 'lehner.lynn@example.net', '2018-04-18 12:33:16', '2018-04-18 12:33:16'),
(2, 'phyllis60@example.org', '2018-04-18 12:33:17', '2018-04-18 12:33:17'),
(4, 'nina60@example.net', '2018-04-18 12:33:17', '2018-04-18 12:33:17'),
(5, 'hjacobi@example.org', '2018-04-18 12:33:17', '2018-04-18 12:33:17'),
(6, 'ymueller@example.com', '2018-04-18 12:33:17', '2018-04-18 12:33:17'),
(7, 'roob.maria@example.net', '2018-04-18 12:33:17', '2018-04-18 12:33:17'),
(8, 'antonietta.hilll@example.net', '2018-04-18 12:33:17', '2018-04-18 12:33:17'),
(9, 'ybernhard@example.com', '2018-04-18 12:33:17', '2018-04-18 12:33:17'),
(10, 'christiansen.orie@example.com', '2018-04-18 12:33:17', '2018-04-18 12:33:17'),
(11, 'lindsey.hayes@example.net', '2018-04-18 12:33:17', '2018-04-18 12:33:17'),
(12, 'tyreek.champlin@example.org', '2018-04-18 12:33:17', '2018-04-18 12:33:17'),
(13, 'colby04@example.com', '2018-04-18 12:33:17', '2018-04-18 12:33:17'),
(14, 'janiya23@example.com', '2018-04-18 12:33:17', '2018-04-18 12:33:17'),
(15, 'yhowe@example.org', '2018-04-18 12:33:17', '2018-04-18 12:33:17'),
(16, 'camryn66@example.net', '2018-04-18 12:33:17', '2018-04-18 12:33:17'),
(17, 'xdaniel@example.org', '2018-04-18 12:33:17', '2018-04-18 12:33:17'),
(18, 'syost@example.org', '2018-04-18 12:33:17', '2018-04-18 12:33:17'),
(19, 'beatrice82@example.net', '2018-04-18 12:33:17', '2018-04-18 12:33:17'),
(20, 'harrison80@example.net', '2018-04-18 12:33:17', '2018-04-18 12:33:17'),
(21, 'ellie.reilly@example.org', '2018-04-18 12:33:17', '2018-04-18 12:33:17'),
(22, 'weissnat.sabrina@example.net', '2018-04-18 12:33:17', '2018-04-18 12:33:17'),
(23, 'ijacobi@example.com', '2018-04-18 12:33:17', '2018-04-18 12:33:17'),
(24, 'gaston10@example.net', '2018-04-18 12:33:17', '2018-04-18 12:33:17'),
(25, 'wanda.ruecker@example.com', '2018-04-18 12:33:17', '2018-04-18 12:33:17'),
(26, 'qtorphy@example.org', '2018-04-18 12:33:17', '2018-04-18 12:33:17'),
(27, 'joelle41@example.com', '2018-04-18 12:33:17', '2018-04-18 12:33:17'),
(28, 'tnolan@example.org', '2018-04-18 12:33:17', '2018-04-18 12:33:17'),
(29, 'adams.maribel@example.net', '2018-04-18 12:33:17', '2018-04-18 12:33:17'),
(30, 'robel.bridget@example.net', '2018-04-18 12:33:18', '2018-04-18 12:33:18'),
(31, 'leuschke.sherwood@example.net', '2018-04-18 12:33:18', '2018-04-18 12:33:18'),
(32, 'angie.kilback@example.com', '2018-04-18 12:33:18', '2018-04-18 12:33:18'),
(33, 'xsauer@example.net', '2018-04-18 12:33:18', '2018-04-18 12:33:18'),
(34, 'ortiz.osvaldo@example.org', '2018-04-18 12:33:18', '2018-04-18 12:33:18'),
(35, 'jaclyn28@example.net', '2018-04-18 12:33:18', '2018-04-18 12:33:18'),
(36, 'wdach@example.net', '2018-04-18 12:33:18', '2018-04-18 12:33:18'),
(37, 'marianne60@example.com', '2018-04-18 12:33:18', '2018-04-18 12:33:18'),
(38, 'donnell22@example.org', '2018-04-18 12:33:18', '2018-04-18 12:33:18'),
(39, 'beahan.clifton@example.org', '2018-04-18 12:33:18', '2018-04-18 12:33:18'),
(40, 'muriel51@example.net', '2018-04-18 12:33:18', '2018-04-18 12:33:18'),
(41, 'karl61@example.net', '2018-04-18 12:33:18', '2018-04-18 12:33:18'),
(42, 'stark.enola@example.com', '2018-04-18 12:33:18', '2018-04-18 12:33:18'),
(43, 'bbogan@example.org', '2018-04-18 12:33:18', '2018-04-18 12:33:18'),
(44, 'uswift@example.org', '2018-04-18 12:33:18', '2018-04-18 12:33:18'),
(45, 'johnathan63@example.net', '2018-04-18 12:33:18', '2018-04-18 12:33:18'),
(46, 'frederique.dicki@example.org', '2018-04-18 12:33:18', '2018-04-18 12:33:18'),
(47, 'ablock@example.com', '2018-04-18 12:33:18', '2018-04-18 12:33:18'),
(48, 'ismael94@example.org', '2018-04-18 12:33:18', '2018-04-18 12:33:18'),
(49, 'shettinger@example.org', '2018-04-18 12:33:18', '2018-04-18 12:33:18'),
(50, 'general45@example.org', '2018-04-18 12:33:18', '2018-04-18 12:33:18'),
(51, 'effie58@example.net', '2018-04-18 12:33:18', '2018-04-18 12:33:18'),
(52, 'miller.hortense@example.net', '2018-04-18 12:33:18', '2018-04-18 12:33:18'),
(53, 'dkuphal@example.com', '2018-04-18 12:33:18', '2018-04-18 12:33:18'),
(54, 'trath@example.com', '2018-04-18 12:33:18', '2018-04-18 12:33:18'),
(55, 'lamont13@example.net', '2018-04-18 12:33:18', '2018-04-18 12:33:18'),
(56, 'legros.katlynn@example.net', '2018-04-18 12:33:19', '2018-04-18 12:33:19'),
(57, 'gaston.wunsch@example.net', '2018-04-18 12:33:19', '2018-04-18 12:33:19'),
(58, 'corkery.loy@example.net', '2018-04-18 12:33:19', '2018-04-18 12:33:19'),
(59, 'murphy.jarrett@example.org', '2018-04-18 12:33:19', '2018-04-18 12:33:19'),
(60, 'garland.hayes@example.com', '2018-04-18 12:33:19', '2018-04-18 12:33:19'),
(61, 'alison90@example.com', '2018-04-18 12:33:19', '2018-04-18 12:33:19'),
(62, 'napoleon53@example.net', '2018-04-18 12:33:19', '2018-04-18 12:33:19'),
(63, 'nick.steuber@example.org', '2018-04-18 12:33:19', '2018-04-18 12:33:19'),
(64, 'fjacobs@example.net', '2018-04-18 12:33:19', '2018-04-18 12:33:19'),
(65, 'ilene67@example.net', '2018-04-18 12:33:19', '2018-04-18 12:33:19'),
(66, 'gerson.kuhlman@example.com', '2018-04-18 12:33:19', '2018-04-18 12:33:19'),
(67, 'yparker@example.net', '2018-04-18 12:33:19', '2018-04-18 12:33:19'),
(68, 'vdurgan@example.com', '2018-04-18 12:33:19', '2018-04-18 12:33:19'),
(69, 'hhodkiewicz@example.org', '2018-04-18 12:33:19', '2018-04-18 12:33:19'),
(70, 'logan21@example.net', '2018-04-18 12:33:19', '2018-04-18 12:33:19'),
(71, 'koepp.adeline@example.org', '2018-04-18 12:33:19', '2018-04-18 12:33:19'),
(72, 'lindsey00@example.org', '2018-04-18 12:33:19', '2018-04-18 12:33:19'),
(73, 'elisabeth37@example.net', '2018-04-18 12:33:19', '2018-04-18 12:33:19'),
(74, 'maya.harris@example.org', '2018-04-18 12:33:19', '2018-04-18 12:33:19'),
(75, 'jboyer@example.org', '2018-04-18 12:33:19', '2018-04-18 12:33:19'),
(76, 'audrey70@example.com', '2018-04-18 12:33:19', '2018-04-18 12:33:19'),
(77, 'agoyette@example.net', '2018-04-18 12:33:19', '2018-04-18 12:33:19'),
(78, 'ferry.oceane@example.org', '2018-04-18 12:33:19', '2018-04-18 12:33:19'),
(79, 'hayes.candido@example.net', '2018-04-18 12:33:19', '2018-04-18 12:33:19'),
(80, 'gideon85@example.org', '2018-04-18 12:33:19', '2018-04-18 12:33:19'),
(81, 'jayde36@example.net', '2018-04-18 12:33:19', '2018-04-18 12:33:19'),
(82, 'sweimann@example.net', '2018-04-18 12:33:19', '2018-04-18 12:33:19'),
(83, 'upton.raheem@example.com', '2018-04-18 12:33:20', '2018-04-18 12:33:20'),
(84, 'bernier.piper@example.org', '2018-04-18 12:33:20', '2018-04-18 12:33:20'),
(85, 'halie16@example.net', '2018-04-18 12:33:20', '2018-04-18 12:33:20'),
(86, 'paul04@example.com', '2018-04-18 12:33:20', '2018-04-18 12:33:20'),
(87, 'brown.adrain@example.net', '2018-04-18 12:33:20', '2018-04-18 12:33:20'),
(88, 'edgar67@example.net', '2018-04-18 12:33:20', '2018-04-18 12:33:20'),
(89, 'bryana.bins@example.org', '2018-04-18 12:33:20', '2018-04-18 12:33:20'),
(90, 'kshlerin.howard@example.net', '2018-04-18 12:33:20', '2018-04-18 12:33:20'),
(91, 'gust.hane@example.org', '2018-04-18 12:33:20', '2018-04-18 12:33:20'),
(92, 'jessyca90@example.com', '2018-04-18 12:33:20', '2018-04-18 12:33:20'),
(93, 'derek03@example.org', '2018-04-18 12:33:20', '2018-04-18 12:33:20'),
(94, 'icole@example.org', '2018-04-18 12:33:20', '2018-04-18 12:33:20'),
(95, 'stacey92@example.net', '2018-04-18 12:33:20', '2018-04-18 12:33:20'),
(96, 'jaime.schamberger@example.org', '2018-04-18 12:33:20', '2018-04-18 12:33:20'),
(97, 'tessie.hermiston@example.net', '2018-04-18 12:33:20', '2018-04-18 12:33:20'),
(98, 'johnston.carmen@example.com', '2018-04-18 12:33:20', '2018-04-18 12:33:20'),
(99, 'oscar87@example.org', '2018-04-18 12:33:20', '2018-04-18 12:33:20'),
(100, 'blang@example.com', '2018-04-18 12:33:20', '2018-04-18 12:33:20'),
(101, 'ulrichquatess@gmail.com', '2018-04-26 18:21:51', '2018-04-26 18:21:51'),
(102, 'adas@sdf.com', '2018-04-26 18:22:05', '2018-04-26 18:22:05'),
(103, 'mayur@gmail.com', '2018-04-26 18:22:55', '2018-04-26 18:22:55');

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `iban` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `taal` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `klant_sinds` date DEFAULT NULL,
  `about` text COLLATE utf8mb4_unicode_ci,
  `user_meta` text COLLATE utf8mb4_unicode_ci,
  `role` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `activation_status` tinyint(4) NOT NULL DEFAULT '0',
  `block_reason` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `blocked_at` timestamp NULL DEFAULT NULL,
  `place_holder` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_of_account_holder` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bic_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `barcode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(255) NOT NULL,
  `parent_id` bigint(20) DEFAULT '1',
  `Bedrijfsnaam` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Soort` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `City` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Contactpersoon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cashback` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`id`, `name`, `username`, `email`, `password`, `avatar`, `gender`, `phone`, `address`, `birthday`, `iban`, `taal`, `klant_sinds`, `about`, `user_meta`, `role`, `activation_status`, `block_reason`, `blocked_at`, `place_holder`, `name_of_account_holder`, `bic_code`, `barcode`, `remember_token`, `user_id`, `parent_id`, `Bedrijfsnaam`, `Soort`, `City`, `Contactpersoon`, `cashback`, `created_at`, `updated_at`, `slug`) VALUES
(1, 'Misty Streich', 'aperiam_nihil', 'ulrichquatess@gmail.com', '$2y$10$fTInGzIS1X/BpYh8OIqhYuLscfionuHf0BbE6C/9WnJZWojRXCyAS', NULL, NULL, NULL, NULL, '0000-00-00', '', '', '0000-00-00', NULL, NULL, 'admin', 0, '', '2018-05-22 07:16:04', NULL, NULL, NULL, NULL, 'nkImrflv8AfpmsIFi8MAxzxiWm6rsRKB4YeX9DxaRYQeBIOuu5gdk7tXKCcG', 0, 1, NULL, NULL, NULL, NULL, NULL, '2018-04-18 12:33:16', '2018-04-18 12:33:16', 'Misty_Streich3645'),
(2, 'Joel Hammes', 'assumenda_id', 'fdouglas@example.org', '$2y$10$fTInGzIS1X/BpYh8OIqhYuLscfionuHf0BbE6C/9WnJZWojRXCyAS', '2.png', NULL, NULL, NULL, '0000-00-00', '', '', '0000-00-00', NULL, '{"i":{"kcal":"1200","eiwit":"12525","koolhydraat":"12065646","vezel":"238882","vet":"120885"},"b":{"kcal":"125550","eiwit":"12","koolhydraat":"12","vezel":"12","vet":"120"},"doelstelling":"Test Message","mayur":"test"}', 'user', 1, '', '2018-05-22 07:16:07', NULL, NULL, NULL, NULL, 'tGxUwVOCYKJ9RML2TQOoTa5CrzJbCzYWmzLEAEfdDfHjspcPVF9swVefZIYj', 0, 1, NULL, NULL, NULL, NULL, NULL, '2018-04-18 12:33:16', '2018-05-08 12:18:04', ''),
(3, 'Andres Metz Sr.', 'pariatur_eos', 'admin@vh.com', '$2y$10$oWeLVANkG.dkOCsbqynHyue3KL1MUXw6JEnQf2vpaaL.0gCBlYDei', NULL, 'f', '9876543210', 'adsofihvopads', '2012-02-24', NULL, 'Angola', '1970-01-01', 'asdvas', NULL, 'user', 1, '', '2018-05-22 07:16:07', NULL, NULL, NULL, NULL, 'xEFj6SkKKm', 0, 1, NULL, NULL, NULL, NULL, NULL, '2018-04-18 12:33:16', '2018-05-22 01:09:59', ''),
(4, 'Marisa Effertz', 'ad_laboriosam', 'clara.watsica@example.org', '$2y$10$oWeLVANkG.dkOCsbqynHyue3KL1MUXw6JEnQf2vpaaL.0gCBlYDei', NULL, NULL, NULL, NULL, '0000-00-00', '', '', '0000-00-00', NULL, NULL, 'user', 0, '', '2018-05-22 07:16:08', NULL, NULL, NULL, NULL, 'lhk2Wysftn', 0, 1, NULL, NULL, NULL, NULL, NULL, '2018-04-18 12:33:16', '2018-04-18 12:33:16', ''),
(5, 'Hilton Bergnaum', 'quia_ducimus', 'btrantow@example.com', '$2y$10$oWeLVANkG.dkOCsbqynHyue3KL1MUXw6JEnQf2vpaaL.0gCBlYDei', NULL, NULL, NULL, NULL, '0000-00-00', '', '', '0000-00-00', NULL, NULL, 'user', 0, '', '2018-05-22 07:16:08', NULL, NULL, NULL, NULL, 'ZSawMIPsf4', 0, 1, NULL, NULL, NULL, NULL, NULL, '2018-04-18 12:33:16', '2018-04-18 12:33:16', 'Hilton_Bergnaum6847'),
(6, 'Clint Von PhD', 'sit_quasi', 'price.werner@example.com', '$2y$10$oWeLVANkG.dkOCsbqynHyue3KL1MUXw6JEnQf2vpaaL.0gCBlYDei', NULL, NULL, NULL, NULL, '0000-00-00', '', '', '0000-00-00', NULL, NULL, 'user', 1, '', '2018-05-22 07:16:10', NULL, NULL, NULL, NULL, 'l4J6fv1pvI', 0, 1, NULL, NULL, NULL, NULL, NULL, '2018-04-18 12:33:16', '2018-04-18 13:35:12', ''),
(7, 'Theresa Sporer', 'voluptas_explicabo', 'vhansen@example.net', '$2y$10$oWeLVANkG.dkOCsbqynHyue3KL1MUXw6JEnQf2vpaaL.0gCBlYDei', NULL, NULL, NULL, NULL, '0000-00-00', '', '', '0000-00-00', NULL, NULL, 'user', 0, '', '2018-05-22 07:16:09', NULL, NULL, NULL, NULL, 'WZUdUPOnyp', 0, 1, NULL, NULL, NULL, NULL, NULL, '2018-04-18 12:33:16', '2018-04-18 12:33:16', ''),
(8, 'Simeon Koepp', 'dolores_rerum', 'gwen.nader@example.com', '$2y$10$oWeLVANkG.dkOCsbqynHyue3KL1MUXw6JEnQf2vpaaL.0gCBlYDei', NULL, NULL, NULL, NULL, '0000-00-00', '', '', '0000-00-00', NULL, NULL, 'user', 0, '', '2018-05-22 07:16:10', NULL, NULL, NULL, NULL, 'vsfNgU6mfb', 0, 1, NULL, NULL, NULL, NULL, NULL, '2018-04-18 12:33:16', '2018-04-18 12:33:16', ''),
(9, 'Weldon Williamson', 'eveniet_voluptatem', 'grant82@example.com', '$2y$10$oWeLVANkG.dkOCsbqynHyue3KL1MUXw6JEnQf2vpaaL.0gCBlYDei', NULL, NULL, NULL, NULL, '0000-00-00', '', '', '0000-00-00', NULL, NULL, 'user', 0, '', '2018-05-22 07:16:14', NULL, NULL, NULL, NULL, 'YCjWrawPxj', 0, 1, NULL, NULL, NULL, NULL, NULL, '2018-04-18 12:33:16', '2018-04-18 12:33:16', ''),
(10, 'Dr. Donnie Runte', 'provident_est', 'juliet.bernhard@example.org', '$2y$10$oWeLVANkG.dkOCsbqynHyue3KL1MUXw6JEnQf2vpaaL.0gCBlYDei', NULL, NULL, NULL, NULL, '0000-00-00', '', '', '0000-00-00', NULL, NULL, 'user', 0, '', '2018-05-22 07:16:15', NULL, NULL, NULL, NULL, 'SMEJgHmGih', 0, 1, NULL, NULL, NULL, NULL, NULL, '2018-04-18 12:33:16', '2018-04-18 12:33:16', ''),
(13, 'vishal patel', 'abc', 'abc@ttt.com', '$2y$10$W038y1AXKLT7wmhMEgwupeT5JEUMokAldXdeaw0QLz42K/BCMxZtq', NULL, 'm', '9898646866', '702-703 iscon,jodhpur crose', NULL, NULL, NULL, NULL, 'dsfvds', NULL, 'company', 1, '', '2018-05-22 07:16:18', NULL, NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, '2018-05-21 05:18:10', '2018-05-21 05:18:10', '');

-- --------------------------------------------------------

--
-- Table structure for table `training_schedule`
--

CREATE TABLE `training_schedule` (
  `id` int(10) UNSIGNED NOT NULL,
  `schema_id` int(11) NOT NULL,
  `recurring` enum('yes','no') COLLATE utf8_unicode_ci DEFAULT NULL,
  `startdate` datetime DEFAULT NULL,
  `enddate` datetime DEFAULT NULL,
  `days` varchar(14) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `training_schedule`
--

INSERT INTO `training_schedule` (`id`, `schema_id`, `recurring`, `startdate`, `enddate`, `days`, `created_at`, `updated_at`) VALUES
(1, 2, 'yes', '2018-06-03 00:00:00', NULL, '0', '2018-06-04 07:23:26', '2018-06-04 07:23:26');

-- --------------------------------------------------------

--
-- Table structure for table `training_schema`
--

CREATE TABLE `training_schema` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent_id` int(11) NOT NULL,
  `schema_name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `schema_note` text COLLATE utf8_unicode_ci,
  `status` enum('incomplete','complete') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `training_schema`
--

INSERT INTO `training_schema` (`id`, `parent_id`, `schema_name`, `schema_note`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL, 'incomplete', '2018-06-04 07:18:10', '2018-06-04 07:18:10'),
(2, 1, 'Deadlift', 'every sunday', 'complete', '2018-06-04 07:19:51', '2018-06-04 07:23:26');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `parent_user_id` int(11) NOT NULL,
  `amount_debt` decimal(10,2) NOT NULL,
  `amount_received` decimal(10,2) NOT NULL,
  `payment_mode` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `transaction_type` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `note` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `user_id`, `parent_user_id`, `amount_debt`, `amount_received`, `payment_mode`, `transaction_type`, `note`, `date`, `created_at`, `updated_at`) VALUES
(1, 0, 1, '0.00', '70.70', 'by_cash', '_products_', 'Transactions from products cart for Cash payment', '2018-06-04 14:59:53', '2018-06-04 09:29:53', '2018-06-04 09:29:53');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `iban` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `taal` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `klant_sinds` date DEFAULT NULL,
  `about` text COLLATE utf8mb4_unicode_ci,
  `user_meta` text COLLATE utf8mb4_unicode_ci,
  `role` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `activation_status` tinyint(4) NOT NULL DEFAULT '0',
  `block_reason` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `blocked_at` timestamp NULL DEFAULT NULL,
  `materiallevel` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `traininglevel` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `musclegroupname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `goal` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `checkin_text_denied` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `checkin_text_warning` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `checkin_text_accept` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefoonnummernood` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `noodcontact` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `chronischeziekte` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meerinformatie` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `letsels` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hoofddoel` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `place_holder` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_of_account_holder` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bic_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `barcode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(255) NOT NULL,
  `parent_id` bigint(20) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `sign` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `packagefk` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `password`, `avatar`, `gender`, `phone`, `address`, `birthday`, `iban`, `taal`, `klant_sinds`, `about`, `user_meta`, `role`, `activation_status`, `block_reason`, `blocked_at`, `materiallevel`, `traininglevel`, `musclegroupname`, `goal`, `checkin_text_denied`, `checkin_text_warning`, `checkin_text_accept`, `telefoonnummernood`, `noodcontact`, `chronischeziekte`, `meerinformatie`, `letsels`, `hoofddoel`, `place_holder`, `name_of_account_holder`, `bic_code`, `barcode`, `remember_token`, `user_id`, `parent_id`, `created_at`, `updated_at`, `sign`, `packagefk`) VALUES
(1, 'snehal gajjarsdgbavsdgb', 'aperiam_nihil', 'ulrichquatess@gmail.com', '$2y$10$fTInGzIS1X/BpYh8OIqhYuLscfionuHf0BbE6C/9WnJZWojRXCyAS', NULL, 'm', '7046828181', 'A/2, ravi tenement, A/2, ravi tenement', '1970-01-01', 'adfhbrdfh6874', 'India', '1970-01-01', 'awsedgvardv', NULL, 'admin', 1, '', '2018-05-22 07:16:04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'nkImrflv8AfpmsIFi8MAxzxiWm6rsRKB4YeX9DxaRYQeBIOuu5gdk7tXKCcG', 1, 1, '2018-04-18 12:33:16', '2018-05-24 06:03:57', '', 0),
(2, 'Joel Hammes', 'assumenda_id', 'fdouglas@example.org', '$2y$10$fTInGzIS1X/BpYh8OIqhYuLscfionuHf0BbE6C/9WnJZWojRXCyAS', '2.png', NULL, NULL, NULL, '0000-00-00', '', '', '0000-00-00', NULL, '{"i":{"kcal":"1200","eiwit":"12525","koolhydraat":"12065646","vezel":"238882","vet":"120885"},"b":{"kcal":"125550","eiwit":"12","koolhydraat":"12","vezel":"12","vet":"120"},"doelstelling":"Test Message","mayur":"test"}', 'user', 1, '', '2018-05-22 07:16:07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tGxUwVOCYKJ9RML2TQOoTa5CrzJbCzYWmzLEAEfdDfHjspcPVF9swVefZIYj', 0, 1, '2018-04-18 12:33:16', '2018-05-08 12:18:04', '', 0),
(3, 'Andres Metz Sr.', 'pariatur_eos', 'admin@vh.com', '$2y$10$oWeLVANkG.dkOCsbqynHyue3KL1MUXw6JEnQf2vpaaL.0gCBlYDei', NULL, 'f', '9876543210', 'adsofihvopads', '2012-02-24', NULL, 'Angola', '1970-01-01', 'asdvas', NULL, 'user', 1, '', '2018-05-22 07:16:07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'xEFj6SkKKm', 0, 1, '2018-04-18 12:33:16', '2018-05-22 01:09:59', '', 0),
(4, 'Marisa Effertz', 'ad_laboriosam', 'clara.watsica@example.org', '$2y$10$oWeLVANkG.dkOCsbqynHyue3KL1MUXw6JEnQf2vpaaL.0gCBlYDei', NULL, NULL, NULL, NULL, '0000-00-00', '', '', '0000-00-00', NULL, NULL, 'user', 0, '', '2018-05-22 07:16:08', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'lhk2Wysftn', 0, 1, '2018-04-18 12:33:16', '2018-04-18 12:33:16', '', 0),
(5, 'Hilton Bergnaum', 'quia_ducimus', 'btrantow@example.com', '$2y$10$oWeLVANkG.dkOCsbqynHyue3KL1MUXw6JEnQf2vpaaL.0gCBlYDei', NULL, NULL, NULL, NULL, '0000-00-00', '', '', '0000-00-00', NULL, NULL, 'user', 0, '', '2018-05-22 07:16:08', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ZSawMIPsf4', 0, 1, '2018-04-18 12:33:16', '2018-04-18 12:33:16', '', 0),
(6, 'Clint Von PhD', 'sit_quasi', 'price.werner@example.com', '$2y$10$oWeLVANkG.dkOCsbqynHyue3KL1MUXw6JEnQf2vpaaL.0gCBlYDei', NULL, NULL, NULL, NULL, '0000-00-00', '', '', '0000-00-00', NULL, NULL, 'user', 1, '', '2018-05-22 07:16:10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'l4J6fv1pvI', 0, 1, '2018-04-18 12:33:16', '2018-04-18 13:35:12', '', 0),
(7, 'Theresa Sporer', 'voluptas_explicabo', 'vhansen@example.net', '$2y$10$oWeLVANkG.dkOCsbqynHyue3KL1MUXw6JEnQf2vpaaL.0gCBlYDei', NULL, NULL, NULL, NULL, '0000-00-00', '', '', '0000-00-00', NULL, NULL, 'user', 0, '', '2018-05-22 07:16:09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'WZUdUPOnyp', 0, 1, '2018-04-18 12:33:16', '2018-04-18 12:33:16', '', 0),
(8, 'Simeon Koepp', 'dolores_rerum', 'gwen.nader@example.com', '$2y$10$oWeLVANkG.dkOCsbqynHyue3KL1MUXw6JEnQf2vpaaL.0gCBlYDei', NULL, NULL, NULL, NULL, '0000-00-00', '', '', '0000-00-00', NULL, NULL, 'user', 0, '', '2018-05-22 07:16:10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'vsfNgU6mfb', 0, 1, '2018-04-18 12:33:16', '2018-04-18 12:33:16', '', 0),
(9, 'Weldon Williamson', 'eveniet_voluptatem', 'grant82@example.com', '$2y$10$oWeLVANkG.dkOCsbqynHyue3KL1MUXw6JEnQf2vpaaL.0gCBlYDei', NULL, NULL, NULL, NULL, '0000-00-00', '', '', '0000-00-00', NULL, NULL, 'user', 0, '', '2018-05-22 07:16:14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'YCjWrawPxj', 0, 1, '2018-04-18 12:33:16', '2018-04-18 12:33:16', '', 0),
(10, 'Dr. Donnie Runte', 'provident_est', 'juliet.bernhard@example.org', '$2y$10$oWeLVANkG.dkOCsbqynHyue3KL1MUXw6JEnQf2vpaaL.0gCBlYDei', NULL, NULL, NULL, NULL, '0000-00-00', '', '', '0000-00-00', NULL, NULL, 'user', 0, '', '2018-05-22 07:16:15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SMEJgHmGih', 0, 1, '2018-04-18 12:33:16', '2018-04-18 12:33:16', '', 0),
(13, 'vishal patel', 'abc', 'abc@ttt.com', '$2y$10$fTInGzIS1X/BpYh8OIqhYuLscfionuHf0BbE6C/9WnJZWojRXCyAS', NULL, 'm', '9898646866', '702-703 iscon,jodhpur crose', NULL, NULL, NULL, NULL, 'dsfvds', NULL, 'company', 1, '', '2018-05-22 07:16:18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Mtve8XKoPlwH1VZoDU5xatd8REpRC7SS0RnAgLmL3K7Ygwgn2vlkZcMaQtEZ', 0, 1, '2018-05-21 05:18:10', '2018-05-21 05:18:10', '', 0),
(15, 'snehal_gajjar', '', 'snehal@virtualheight.com', '$2y$10$Cy45.dkisQF9lc8dliviZeRbMLlqMWUZiZ2LlvUPz4DNMW5KhbG7C', NULL, NULL, '7046828181', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, '2018-05-24 15:43:00', '2018-05-24 15:43:00', '{"0":{"jQuery3310066079860842207522":{"kbwSignature":"{\\"lines\\":[]}"},"jQuery3310066079860842207521":{"events":{"remove":[{"type":"remove","origType":"remove","guid":4,"namespace":"signature0"}],"mousedown":[{"type":"mousedown","origType":"mousedown","guid":5,"namespace":"signature"}],"click":[{"type":"click","origType":"click","guid":6,"namespace":"signature"}]}}},"length":1}', 0),
(19, 'snehal_gajjar', 'snehal_gajjar8496', 'snehal@asdads.com', '$2y$10$/zTsurMbF.zZ.PS9/iHLnOcoBUkWidb.fS989qCi.JuAGiLvt.ybG', NULL, NULL, '7046828181', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, '2018-05-24 15:47:13', '2018-05-24 15:47:13', '{"0":{"jQuery331032680550806812892":{"kbwSignature":"{\\"lines\\":[]}"},"jQuery331032680550806812891":{"events":{"remove":[{"type":"remove","origType":"remove","guid":4,"namespace":"signature0"}],"mousedown":[{"type":"mousedown","origType":"mousedown","guid":5,"namespace":"signature"}],"click":[{"type":"click","origType":"click","guid":6,"namespace":"signature"}]}}},"length":1}', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_has_products`
--

CREATE TABLE `user_has_products` (
  `userid` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `name` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `tax` decimal(10,2) NOT NULL,
  `orderid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_has_products`
--

INSERT INTO `user_has_products` (`userid`, `productid`, `quantity`, `price`, `name`, `tax`, `orderid`) VALUES
(0, 2, 7, '10.00', 'Cold', '1.00', 1),
(0, 2, 12, '10.00', 'Cold', '1.00', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_has_schema`
--

CREATE TABLE `user_has_schema` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `schema_id` int(11) NOT NULL,
  `type` enum('predefined','created') COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_has_schema`
--

INSERT INTO `user_has_schema` (`id`, `user_id`, `schema_id`, `type`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'created', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_orders`
--

CREATE TABLE `user_orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `userid` int(11) NOT NULL,
  `balance` decimal(10,2) NOT NULL,
  `invoiceamount` decimal(10,2) NOT NULL,
  `status` enum('paid','incomplete') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_orders`
--

INSERT INTO `user_orders` (`id`, `userid`, `balance`, `invoiceamount`, `status`, `created_at`, `updated_at`) VALUES
(1, 0, '0.00', '70.70', 'paid', '2018-06-04 09:23:46', '2018-06-04 09:29:53'),
(2, 0, '0.00', '121.20', 'incomplete', '2018-06-04 09:30:01', '2018-06-04 09:32:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activity_log_log_name_index` (`log_name`);

--
-- Indexes for table `calendar_connected_users`
--
ALTER TABLE `calendar_connected_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exercises`
--
ALTER TABLE `exercises`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exercise_accent_muscle_group`
--
ALTER TABLE `exercise_accent_muscle_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exercise_goals`
--
ALTER TABLE `exercise_goals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exercise_material`
--
ALTER TABLE `exercise_material`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exercise_training_levels`
--
ALTER TABLE `exercise_training_levels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `galleries`
--
ALTER TABLE `galleries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `galleries_user_id_index` (`user_id`);

--
-- Indexes for table `log_events`
--
ALTER TABLE `log_events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pages_page_slug_unique` (`page_slug`),
  ADD KEY `pages_user_id_index` (`user_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `productgroup`
--
ALTER TABLE `productgroup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `productmedia`
--
ALTER TABLE `productmedia`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `productmedia_slug_unique` (`slug`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_credentials`
--
ALTER TABLE `role_credentials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schema_has_exercise`
--
ALTER TABLE `schema_has_exercise`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_events`
--
ALTER TABLE `service_events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_event_exceptions`
--
ALTER TABLE `service_event_exceptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_opening_hours`
--
ALTER TABLE `service_opening_hours`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_schedules`
--
ALTER TABLE `service_schedules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_schedule_has_users`
--
ALTER TABLE `service_schedule_has_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_images`
--
ALTER TABLE `site_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stories`
--
ALTER TABLE `stories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stories_user_id_index` (`user_id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subscribers_email_unique` (`email`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `training_schedule`
--
ALTER TABLE `training_schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `training_schema`
--
ALTER TABLE `training_schema`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_has_schema`
--
ALTER TABLE `user_has_schema`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_orders`
--
ALTER TABLE `user_orders`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `calendar_connected_users`
--
ALTER TABLE `calendar_connected_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `exercises`
--
ALTER TABLE `exercises`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `exercise_accent_muscle_group`
--
ALTER TABLE `exercise_accent_muscle_group`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `exercise_goals`
--
ALTER TABLE `exercise_goals`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `exercise_material`
--
ALTER TABLE `exercise_material`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `exercise_training_levels`
--
ALTER TABLE `exercise_training_levels`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `galleries`
--
ALTER TABLE `galleries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `log_events`
--
ALTER TABLE `log_events`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `productgroup`
--
ALTER TABLE `productgroup`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `productmedia`
--
ALTER TABLE `productmedia`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `role_credentials`
--
ALTER TABLE `role_credentials`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `schema_has_exercise`
--
ALTER TABLE `schema_has_exercise`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `service_events`
--
ALTER TABLE `service_events`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `service_event_exceptions`
--
ALTER TABLE `service_event_exceptions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `service_opening_hours`
--
ALTER TABLE `service_opening_hours`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `service_schedules`
--
ALTER TABLE `service_schedules`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `service_schedule_has_users`
--
ALTER TABLE `service_schedule_has_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `site_images`
--
ALTER TABLE `site_images`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `stories`
--
ALTER TABLE `stories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;
--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `training_schedule`
--
ALTER TABLE `training_schedule`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `training_schema`
--
ALTER TABLE `training_schema`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `user_has_schema`
--
ALTER TABLE `user_has_schema`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user_orders`
--
ALTER TABLE `user_orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `galleries`
--
ALTER TABLE `galleries`
  ADD CONSTRAINT `galleries_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pages`
--
ALTER TABLE `pages`
  ADD CONSTRAINT `pages_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `stories`
--
ALTER TABLE `stories`
  ADD CONSTRAINT `stories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
