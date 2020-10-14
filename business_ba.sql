-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 21, 2020 at 10:08 PM
-- Server version: 5.6.47
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `business_ba`
--

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `status` enum('active','inactive') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(3, '{\"ar\":\"\\u0627\\u0644\\u0642\\u0627\\u0647\\u0631\\u0629\",\"en\":\"cairo\"}', 'inactive', '2020-05-12 11:17:09', '2020-08-21 18:21:58'),
(35, '{\"ar\":\"\\u0643\\u0648\\u0627\\u062a\\u0631\\u0648\",\"en\":\"Quatrro\"}', 'active', '2020-08-21 18:21:32', '2020-08-21 18:21:48');

-- --------------------------------------------------------

--
-- Table structure for table `branch_historics`
--

CREATE TABLE `branch_historics` (
  `id` int(10) UNSIGNED NOT NULL,
  `employee_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `branch_historics`
--

INSERT INTO `branch_historics` (`id`, `employee_id`, `branch_id`, `date`, `created_at`, `updated_at`) VALUES
(7, 15, 3, '2020-05-13', '2020-05-12 14:02:34', '2020-05-12 14:08:28'),
(8, 16, 3, '2020-05-25', '2020-05-13 22:11:46', '2020-05-13 22:11:46'),
(9, 18, 3, '2020-05-25', '2020-05-13 22:28:35', '2020-05-13 22:28:35');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_id` int(11) DEFAULT NULL,
  `latitude` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zoom` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL,
  `show_website` enum('show','hidden') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `soft_delete` enum('no','yes') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`, `country_id`, `latitude`, `longitude`, `zoom`, `status`, `show_website`, `soft_delete`, `created_at`, `updated_at`) VALUES
(1, '{\"ar\":\"Cairo\",\"en\":\"Cairo\"}', 1, '30.0444196', '31.23571160000006', '6', 'active', 'show', 'no', '2017-08-03 23:20:27', '2017-08-03 23:20:27'),
(2, '{\"ar\":\"\\u0628\\u0631\\u0644\\u064a\\u0646\",\"en\":\"Berlin\"}', 2, '52.52000659999999', '13.404953999999975', '8', 'active', 'show', 'no', '2017-08-12 12:05:38', '2020-04-25 12:20:26'),
(9, '{\"ar\":\"الاسكندرية\",\"en\":\"alex\"}', 1, '31.200178', '29.918762', '5', 'inactive', 'hidden', 'no', '2017-08-21 07:49:18', '2017-08-21 07:49:18'),
(10, '{\"ar\":\"اسوان\",\"en\":\"aswan\"}', 1, '24.088956', '32.899876', '0', 'inactive', 'hidden', 'no', '2017-08-21 07:49:18', '2017-08-21 07:49:18'),
(11, '{\"ar\":\"\\u0645\\u0643\\u0629\",\"en\":\"maka\"}', NULL, NULL, NULL, NULL, 'active', NULL, 'no', '2020-05-13 13:51:48', '2020-05-13 13:51:48'),
(12, '{\"ar\":\"\\u0627\\u0644\\u0645\\u0646\\u0648\\u0641\\u064a\\u06291\",\"en\":\"1almenofia\"}', NULL, NULL, NULL, NULL, 'active', NULL, 'no', '2020-05-13 14:00:26', '2020-05-14 08:37:31');

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `symbol` varchar(199) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `soft_delete` enum('no','yes') NOT NULL DEFAULT 'no',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `name`, `symbol`, `status`, `soft_delete`, `created_at`, `updated_at`) VALUES
(3, 'doller', '$', 'active', 'no', '2020-05-12 19:53:26', '2020-05-12 19:53:26'),
(4, 'يورو', 'يورو', 'active', 'no', '2020-05-14 09:18:00', '2020-05-14 09:18:00');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `code` varchar(191) NOT NULL,
  `type_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `mobile` varchar(191) DEFAULT NULL,
  `phone` varchar(191) DEFAULT NULL,
  `employee_id` varchar(191) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `soft_delete` enum('no','yes') NOT NULL DEFAULT 'no',
  `files` varchar(199) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `code`, `type_id`, `city_id`, `mobile`, `phone`, `employee_id`, `status`, `soft_delete`, `files`, `created_at`, `updated_at`) VALUES
(4, '{\"ar\":\"\\u0645\\u062d\\u0645\\u062f \\u0639\\u0644\\u064a\",\"en\":\"mohamed ali\"}', '232', 3, 1, '00201099608016', '3423433', '15', 'active', 'no', 'customer/1761589325562.jpg', '2020-05-12 18:56:37', '2020-05-12 23:19:22');

-- --------------------------------------------------------

--
-- Table structure for table `customer_types`
--

CREATE TABLE `customer_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `status` enum('active','inactive') NOT NULL,
  `soft_delete` enum('no','yes') NOT NULL DEFAULT 'no',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer_types`
--

INSERT INTO `customer_types` (`id`, `name`, `status`, `soft_delete`, `created_at`, `updated_at`) VALUES
(3, '{\"ar\":\"\\u0639\\u0645\\u064a\\u0644 \\u0645\\u0647\\u0645\",\"en\":\"vip\"}', 'active', 'no', '2020-05-12 16:01:27', '2020-05-12 16:10:14');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `status` enum('active','inactive') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(2, '{\"ar\":\"\\u0627\\u062e\\u062a\\u0628\\u0627\\u0631\",\"en\":\"test\"}', 'active', '2020-05-12 11:21:46', '2020-05-12 11:21:46'),
(46, '{\"ar\":\"\\u0642\\u0633\\u0645 \\u0627\\u0644\\u0627\\u0646\\u062a\\u0627\\u062c\",\"en\":\"production\"}', 'active', '2020-05-13 14:31:50', '2020-05-13 14:31:50');

-- --------------------------------------------------------

--
-- Table structure for table `depart__historics`
--

CREATE TABLE `depart__historics` (
  `id` int(10) UNSIGNED NOT NULL,
  `employee_id` int(11) NOT NULL,
  `depart_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `status` enum('active','inactive') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `depart__historics`
--

INSERT INTO `depart__historics` (`id`, `employee_id`, `depart_id`, `date`, `status`, `created_at`, `updated_at`) VALUES
(1, 15, 2, '2020-02-28', 'active', '2020-05-12 12:58:57', '2020-05-12 14:10:48'),
(3, 16, 2, '2020-05-11', 'active', '2020-05-13 22:12:19', '2020-05-13 22:12:19'),
(4, 18, 2, '2020-05-25', 'active', '2020-05-13 22:28:35', '2020-05-13 22:28:35');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `code` varchar(191) DEFAULT NULL,
  `email` varchar(191) DEFAULT NULL,
  `work_mobile` varchar(191) DEFAULT NULL,
  `personal_mobile` varchar(191) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `branch_id` int(11) NOT NULL,
  `address` varchar(191) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `depart_id` int(11) DEFAULT NULL,
  `postion_id` int(11) DEFAULT NULL,
  `notes` text,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `files` varchar(199) DEFAULT NULL,
  `salary_files` text,
  `soft_delete` enum('no','yes') NOT NULL DEFAULT 'no',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`, `code`, `email`, `work_mobile`, `personal_mobile`, `birth_date`, `start_date`, `end_date`, `branch_id`, `address`, `city_id`, `depart_id`, `postion_id`, `notes`, `status`, `files`, `salary_files`, `soft_delete`, `created_at`, `updated_at`) VALUES
(15, '{\"ar\":\"\\u0645\\u062d\\u0645\\u062f \\u0627\\u062d\\u0645\\u062f\",\"en\":\"mohamed ahmed\"}', '242', 'm@gmail.com', '2141214', '2412424', '2020-05-22', '2020-05-12', '2020-05-20', 3, 'لا يوجد', 1, 2, 2, 'لا يوجد', 'active', 'employees/97271589295615.jpg', NULL, 'yes', '2020-05-12 12:58:57', '2020-05-13 14:16:47'),
(16, '{\"ar\":\"Arabic empl\",\"en\":\"emp\"}', NULL, NULL, NULL, NULL, NULL, '2020-05-11', NULL, 3, NULL, 2, 2, 2, NULL, 'active', 'employees/55211589382443.pdf|employees/18321589382443.pdf|employees/96541589382298.png|employees/46191589382298.png|employees/30201589382298.png', NULL, 'no', '2020-05-13 22:04:58', '2020-05-14 03:24:43'),
(18, '{\"ar\":\"\\u0627\\u062e\\u062a\\u0628\\u0627\\u0631\",\"en\":\"test\"}', '32423432', 'm@gmail.com', '3423423', '01273626323', '2020-05-28', '2020-05-20', '2020-05-19', 3, 'لا يوجد', 1, 2, 2, NULL, 'active', 'employees/69701589383715.jpg', NULL, 'no', '2020-05-13 22:28:35', '2020-05-13 22:28:35');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` int(10) UNSIGNED NOT NULL,
  `invoice_number` varchar(191) NOT NULL,
  `date` date NOT NULL,
  `customer_id` int(11) NOT NULL,
  `amount` double NOT NULL,
  `invoice_type` int(11) NOT NULL,
  `currency_id` int(11) NOT NULL,
  `representor_id` int(11) NOT NULL,
  `notes` text,
  `softing_delete` enum('no','yes') NOT NULL DEFAULT 'no',
  `files` varchar(199) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `invoice_number`, `date`, `customer_id`, `amount`, `invoice_type`, `currency_id`, `representor_id`, `notes`, `softing_delete`, `files`, `created_at`, `updated_at`) VALUES
(3, '32341', '2020-05-27', 4, 567, 3, 3, 3, NULL, 'no', 'invoices/84821589323825.jpg', '2020-05-12 22:50:25', '2020-05-14 05:22:12');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_types`
--

CREATE TABLE `invoice_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `soft_delete` enum('no','yes') NOT NULL DEFAULT 'no',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `invoice_types`
--

INSERT INTO `invoice_types` (`id`, `name`, `status`, `soft_delete`, `created_at`, `updated_at`) VALUES
(3, '{\"ar\":\"\\u0646\\u0648\\u0639 \\u0641\\u0627\\u062a\\u0648\\u0631\\u0629 \\u0627\\u0648\\u0644\",\"en\":\"type voice\"}', 'active', 'no', '2020-05-12 19:38:31', '2020-05-12 19:38:31');

-- --------------------------------------------------------

--
-- Table structure for table `invoice__logs`
--

CREATE TABLE `invoice__logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `employee_id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `type` varchar(99) DEFAULT NULL,
  `action` varchar(191) NOT NULL,
  `old_value` varchar(191) DEFAULT NULL,
  `new_value` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `invoice__logs`
--

INSERT INTO `invoice__logs` (`id`, `employee_id`, `invoice_id`, `type`, `action`, `old_value`, `new_value`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 'payment', 'add', NULL, '45', '2020-05-13 13:30:29', '2020-05-13 13:30:29');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `action` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `table` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `route` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `record_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `action`, `table`, `route`, `type`, `data`, `user_id`, `record_id`, `created_at`, `updated_at`) VALUES
(86, '{\"ar\":\"تم اضافة بيان جديد => 1\",\"en\":\"Added Record . 1\"}', 'users', '{\"ar\":\"المستخدمين\",\"en\":\"Users\"}', 'edit', 'log.add_record | orbscope.users |  log.record_number  | 1', '1', NULL, '2020-09-21 18:08:18', '2020-09-21 18:08:18');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2016_03_01_193027_create_sent_emails_table', 1),
(4, '2016_09_07_193027_create_sent_emails_Url_Clicked_table', 1),
(5, '2016_11_10_213551_add-message-id-to-sent-emails-table', 1),
(6, '2017_06_17_150444_create_settings_table', 1),
(7, '2017_06_21_171534_create_countries_table', 1),
(8, '2017_06_24_022538_create_files_table', 1),
(9, '2017_06_30_061530_create_logs_table', 1),
(10, '2017_07_01_031736_create_unit_types_table', 1),
(11, '2017_07_01_050322_create_agent_types_table', 1),
(12, '2017_07_03_023146_create_cities_table', 1),
(13, '2017_07_03_182013_create_states_table', 1),
(14, '2017_10_01_031030_create_contacts_table', 1),
(15, '2017_10_02_033511_create_permission_tables', 1),
(16, '2017_10_08_203530_create_contact_uses_table', 1),
(17, '2017_10_10_184930_create_pages_table', 1),
(18, '2019_02_17_120325_create_companies_table', 1),
(19, '2019_02_17_164743_create_products_table', 1),
(20, '2019_03_05_141156_create_delegates_table', 1),
(21, '2019_03_05_141518_create_delegate__companys_table', 1),
(22, '2019_03_14_121020_create_orders_table', 2),
(23, '2019_03_15_160319_create_order__items_table', 3),
(24, '2017_07_01_041239_create_industries_table', 4),
(25, '2017_07_01_042123_create_complain_types_table', 4),
(26, '2017_07_05_132709_create_groups_table', 4),
(27, '2017_08_07_023855_create_leads_table', 4),
(28, '2017_08_13_051730_create_orders_table', 4),
(29, '2018_01_17_115805_create_publish_houses_table', 4),
(30, '2018_01_17_234701_create_order_items_table', 4),
(31, '2018_03_19_192949_create_schools_table', 4),
(32, '2018_03_19_221559_create_guides_table', 4),
(33, '2019_10_27_191417_create_free_lancers_table', 4),
(34, '2019_10_29_231328_create_tags_table', 5),
(35, '2019_10_29_235201_create_lancer_tags_table', 5),
(36, '2019_10_30_000350_create_lancer_subs_table', 6),
(37, '2019_11_09_135224_create_types_table', 7),
(38, '2019_11_10_003508_create_members_table', 8),
(39, '2020_04_23_170409_create_branches_table', 9),
(40, '2020_04_23_172150_create_departments_table', 10),
(41, '2020_04_23_192643_create_positions_table', 11),
(42, '2020_04_24_173919_create_employees_table', 12),
(43, '2020_04_29_141814_create_salaries_table', 13),
(44, '2020_04_29_142225_create_subtracts_table', 14),
(45, '2020_05_02_202805_create_customer_types_table', 15),
(46, '2020_05_05_160235_create_branch_historics_table', 16),
(47, '2020_05_05_160252_create_depart_historics_table', 16),
(48, '2020_05_07_150125_create_customers_table', 16),
(49, '2020_05_07_173833_create_invoice_types_table', 16),
(50, '2020_05_07_182607_create_currencies_table', 16),
(51, '2020_05_08_152550_create_represent_lists_table', 16),
(52, '2020_05_08_203608_create_representor__details_table', 16),
(53, '2020_05_09_135142_create_invoices_table', 16),
(54, '2020_05_09_162724_create_payments_table', 16),
(55, '2020_05_12_141959_create_position__historics_table', 17),
(56, '2020_05_12_151439_create_vacations_table', 18),
(57, '2020_05_12_161810_create_stays_table', 19),
(58, '2020_05_13_150400_create_invoice__logs_table', 20);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `model_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `model_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_id`, `model_type`) VALUES
(1, 1, 'App\\User'),
(5, 3, 'App\\User'),
(2, 11, 'App\\User'),
(2, 12, 'App\\User'),
(3, 12, 'App\\User'),
(2, 13, 'App\\User'),
(3, 13, 'App\\User'),
(3, 14, 'App\\User'),
(7, 18, 'App\\User'),
(5, 20, 'App\\User'),
(10, 22, 'App\\User'),
(9, 23, 'App\\User'),
(3, 24, 'App\\User'),
(5, 24, 'App\\User'),
(11, 25, 'App\\User'),
(11, 26, 'App\\User'),
(11, 27, 'App\\User'),
(1, 28, 'App\\User');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) NOT NULL,
  `type` varchar(191) NOT NULL,
  `notifiable_id` int(10) UNSIGNED NOT NULL,
  `notifiable_type` varchar(191) NOT NULL,
  `data` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_id`, `notifiable_type`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('04b35b06-3f7a-4cae-8237-b24db1183a11', 'App\\Notifications\\MessageNotification', 1, 'App\\User', '{\"id\":9,\"name\":\"ahmed\",\"date\":\"2018-09-23\",\"type\":\"message\"}', NULL, '2018-09-23 12:31:13', '2018-09-23 12:31:13'),
('9eb903eb-0509-4cd4-b48c-7b5b1c693aa4', 'App\\Notifications\\SchoolNotification', 1, 'App\\User', '{\"id\":15,\"name\":\"\\u0627\\u0644\\u062b\\u0627\\u0646\\u0648\\u064a\\u0629 \\u0627\\u0644\\u0639\\u0633\\u0643\\u0631\\u064a\\u0629\",\"date\":\"2018-09-23\",\"type\":\"school\"}', NULL, '2018-09-23 12:33:24', '2018-09-23 12:33:24');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('dev.mohamedreda@gmail.com', '$2y$10$eOCt08hlSQa.xow6F0.iL.5ni7TUVP7EuHdWD7nPKXK4.wgdQUfU2', '2017-09-30 18:09:32'),
('dev.mohamedreda@gmail.com', '$2y$10$eOCt08hlSQa.xow6F0.iL.5ni7TUVP7EuHdWD7nPKXK4.wgdQUfU2', '2017-09-30 18:09:32');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(10) UNSIGNED NOT NULL,
  `amount` double NOT NULL,
  `RV` varchar(191) NOT NULL,
  `due_date` date NOT NULL,
  `receive_date` date NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `amount`, `RV`, `due_date`, `receive_date`, `invoice_id`, `created_at`, `updated_at`) VALUES
(1, 100, '2334', '2020-04-29', '2020-04-30', 1, '2020-05-10 11:39:13', '2020-05-10 11:39:13'),
(2, 232, '2334', '2020-05-06', '2020-05-11', 2, '2020-05-12 21:42:26', '2020-05-12 21:42:26'),
(3, 34, '232', '2020-04-26', '2020-05-03', 3, '2020-05-13 12:56:11', '2020-05-13 12:56:11'),
(4, 451, '2334', '2020-05-10', '2020-05-25', 3, '2020-05-13 13:30:29', '2020-05-14 08:55:21');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `guard_name` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(120, 'Add Agents', 'web', '2017-10-02 05:31:11', '2017-10-03 00:09:41'),
(121, 'Edit Agents', 'web', '2017-10-02 05:31:18', '2017-10-03 00:09:46'),
(122, 'Show Agents', 'web', '2017-10-02 05:32:18', '2017-10-03 00:09:49'),
(123, 'Delete Agents', 'web', '2017-10-02 05:32:24', '2017-10-03 00:09:44'),
(141, 'Logs', 'web', '2017-10-02 05:37:56', '2017-10-02 05:37:56'),
(150, 'Add Roles', 'web', '2017-10-03 02:49:02', '2017-10-03 02:49:02'),
(151, 'Edit Roles', 'web', '2017-10-03 02:49:11', '2017-10-03 02:49:11'),
(152, 'Show Roles', 'web', '2017-10-03 02:49:21', '2017-10-03 02:49:21'),
(153, 'Delete Roles', 'web', '2017-10-03 02:49:29', '2017-10-03 02:49:29'),
(154, 'Log', 'web', '2017-10-03 04:41:38', '2017-10-03 04:41:38'),
(155, 'Settings', 'web', '2017-10-03 04:42:32', '2017-10-03 04:42:32'),
(162, 'Add Branches', 'web', '2020-04-23 15:09:11', '2020-04-23 15:09:11'),
(163, 'Edit Branches', 'web', '2020-04-23 15:09:22', '2020-04-23 15:09:22'),
(164, 'Show Branches', 'web', '2020-04-23 15:09:31', '2020-04-23 15:09:31'),
(165, 'Delete Branches', 'web', '2020-04-23 15:09:44', '2020-04-23 15:09:44'),
(166, 'Add Department', 'web', '2020-04-23 15:25:19', '2020-04-23 15:25:19'),
(167, 'Edit Department', 'web', '2020-04-23 15:25:25', '2020-04-23 15:25:25'),
(168, 'Show Department', 'web', '2020-04-23 15:25:32', '2020-04-23 15:25:32'),
(169, 'Delete Department', 'web', '2020-04-23 15:25:42', '2020-04-23 15:25:42'),
(170, 'Edit Position', 'web', '2020-04-23 17:33:56', '2020-04-23 17:33:56'),
(171, 'Add Position', 'web', '2020-04-23 17:34:03', '2020-04-23 17:34:03'),
(172, 'Show Position', 'web', '2020-04-23 17:34:11', '2020-04-23 17:34:11'),
(173, 'Delete Position', 'web', '2020-04-23 17:34:18', '2020-04-23 17:34:18'),
(174, 'Add Cities', 'web', '2020-04-24 15:52:54', '2020-04-24 15:52:54'),
(175, 'Edit Cities', 'web', '2020-04-24 15:53:03', '2020-04-24 15:53:03'),
(176, 'Show Cities', 'web', '2020-04-24 15:53:09', '2020-04-24 15:53:09'),
(177, 'Delete Cities', 'web', '2020-04-24 15:53:17', '2020-04-24 15:53:17'),
(178, 'Add Users', 'web', '2020-04-25 12:47:44', '2020-04-25 12:47:44'),
(179, 'Edit Users', 'web', '2020-04-25 12:47:56', '2020-04-25 12:47:56'),
(180, 'Show Users', 'web', '2020-04-25 12:48:06', '2020-04-25 12:48:06'),
(181, 'Show Salary', 'web', '2020-04-29 12:14:52', '2020-04-29 12:14:52'),
(182, 'Edit Salary', 'web', '2020-04-29 12:15:25', '2020-04-29 12:15:25'),
(183, 'Add Salary', 'web', '2020-04-29 12:15:46', '2020-04-29 12:15:46'),
(184, 'Delete CystomerType', 'web', '2020-05-02 18:31:58', '2020-05-02 18:31:58'),
(185, 'Show CystomerType', 'web', '2020-05-02 18:32:06', '2020-05-02 18:32:06'),
(186, 'Edit CystomerType', 'web', '2020-05-02 18:32:14', '2020-05-02 18:32:14'),
(187, 'Add CystomerType', 'web', '2020-05-02 18:32:23', '2020-05-02 18:32:23'),
(188, 'Add Invoice', 'web', '2020-05-10 12:36:51', '2020-05-10 12:36:51'),
(189, 'Edit Invoice', 'web', '2020-05-10 12:36:59', '2020-05-10 12:36:59'),
(190, 'Show Invoice', 'web', '2020-05-10 12:37:06', '2020-05-10 12:37:06'),
(191, 'Delete Invoice', 'web', '2020-05-10 12:37:13', '2020-05-10 12:37:13'),
(192, 'Add Currencies', 'web', '2020-05-10 12:37:24', '2020-05-10 12:37:24'),
(193, 'Edit Currencies', 'web', '2020-05-10 12:37:30', '2020-05-10 12:37:30'),
(194, 'Show Currencies', 'web', '2020-05-10 12:37:40', '2020-05-10 12:37:40'),
(195, 'Delete Currencies', 'web', '2020-05-10 12:37:47', '2020-05-10 12:37:47'),
(196, 'Add Customer', 'web', '2020-05-10 12:38:41', '2020-05-10 12:38:41'),
(197, 'Edit Customer', 'web', '2020-05-10 12:38:54', '2020-05-10 12:38:54'),
(198, 'Show Customer', 'web', '2020-05-10 12:39:02', '2020-05-10 12:39:02'),
(199, 'Delete Customer', 'web', '2020-05-10 12:39:10', '2020-05-10 12:39:10'),
(200, 'Add Representor_list', 'web', '2020-05-10 12:39:20', '2020-05-10 12:39:20'),
(201, 'Edit Representor_list', 'web', '2020-05-10 12:39:28', '2020-05-10 12:39:28'),
(202, 'Show Representor_list', 'web', '2020-05-10 12:39:37', '2020-05-10 12:39:37'),
(203, 'Delete Representor_list', 'web', '2020-05-10 12:39:44', '2020-05-10 12:39:44'),
(204, 'Add InvoiceType', 'web', '2020-05-10 12:39:55', '2020-05-10 12:39:55'),
(205, 'Edit InvoiceType', 'web', '2020-05-10 12:40:02', '2020-05-10 12:40:02'),
(206, 'Show InvoiceType', 'web', '2020-05-10 12:40:11', '2020-05-10 12:40:11'),
(207, 'Delete InvoiceType', 'web', '2020-05-10 12:40:20', '2020-05-10 12:40:20'),
(208, 'Show Representor_Details', 'web', '2020-05-10 12:40:58', '2020-05-10 12:40:58');

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `status` enum('active','inactive') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(2, '{\"ar\":\"\\u0645\\u0633\\u0627\\u0639\\u062f\",\"en\":\"assicstant\"}', 'active', '2020-05-12 11:26:56', '2020-05-12 11:26:56');

-- --------------------------------------------------------

--
-- Table structure for table `postion_historics`
--

CREATE TABLE `postion_historics` (
  `id` int(10) UNSIGNED NOT NULL,
  `employee_id` int(11) NOT NULL,
  `position_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `status` enum('active','inactive') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `postion_historics`
--

INSERT INTO `postion_historics` (`id`, `employee_id`, `position_id`, `date`, `status`, `created_at`, `updated_at`) VALUES
(3, 14, 2, '2020-05-19', 'active', '2020-05-12 12:58:04', '2020-05-12 12:58:04'),
(4, 15, 2, '2020-05-13', 'active', '2020-05-12 12:58:57', '2020-05-12 14:08:45'),
(5, 18, 2, '2020-05-19', 'active', '2020-05-13 22:28:35', '2020-05-13 22:28:35'),
(6, 16, 2, '2020-05-28', 'active', '2020-05-14 03:24:43', '2020-05-14 03:24:43');

-- --------------------------------------------------------

--
-- Table structure for table `representor__details`
--

CREATE TABLE `representor__details` (
  `id` int(10) UNSIGNED NOT NULL,
  `street` varchar(191) DEFAULT NULL,
  `represent_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `sales_percent` double DEFAULT NULL,
  `service_percent` double DEFAULT NULL,
  `spare_part_percent` double DEFAULT NULL,
  `team_leader` tinyint(1) DEFAULT NULL,
  `manager_leader` tinyint(1) DEFAULT NULL,
  `soft_delete` enum('no','yes') NOT NULL DEFAULT 'no',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `representor__details`
--

INSERT INTO `representor__details` (`id`, `street`, `represent_id`, `employee_id`, `sales_percent`, `service_percent`, `spare_part_percent`, `team_leader`, `manager_leader`, `soft_delete`, `created_at`, `updated_at`) VALUES
(1, NULL, 1, 7, 0.66, 0, 0, 1, NULL, 'no', '2020-05-10 12:42:58', '2020-05-10 12:42:58'),
(2, NULL, 3, 15, 55.6, 4.5, 3.3, 1, NULL, 'no', '2020-05-12 19:14:27', '2020-05-12 19:14:27');

-- --------------------------------------------------------

--
-- Table structure for table `represent_lists`
--

CREATE TABLE `represent_lists` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `soft_delete` enum('no','yes') NOT NULL DEFAULT 'no',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `represent_lists`
--

INSERT INTO `represent_lists` (`id`, `name`, `status`, `soft_delete`, `created_at`, `updated_at`) VALUES
(3, '{\"ar\":\"\\u0627\\u0644\\u0642\\u0627\\u0626\\u0645\\u0629 \\u0627\\u0644\\u0627\\u0648\\u0644\\u064a\",\"en\":\"first list\"}', 'active', 'no', '2020-05-12 19:09:49', '2020-05-12 19:09:49');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `guard_name` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'web', '2017-10-03 00:26:29', '2017-10-03 00:26:29'),
(11, 'DB-HR', 'web', '2020-04-25 12:44:33', '2020-04-25 12:44:33'),
(12, 'Accountant', 'web', '2020-05-10 12:36:30', '2020-05-10 12:36:30');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(96, 1),
(97, 1),
(98, 1),
(99, 1),
(108, 1),
(109, 1),
(110, 1),
(111, 1),
(120, 1),
(121, 1),
(122, 1),
(123, 1),
(124, 1),
(125, 1),
(126, 1),
(127, 1),
(128, 1),
(129, 1),
(130, 1),
(136, 1),
(137, 1),
(138, 1),
(139, 1),
(141, 1),
(142, 1),
(143, 1),
(144, 1),
(145, 1),
(147, 1),
(148, 1),
(149, 1),
(150, 1),
(151, 1),
(152, 1),
(153, 1),
(154, 1),
(155, 1),
(156, 1),
(157, 1),
(160, 1),
(162, 1),
(163, 1),
(164, 1),
(165, 1),
(166, 1),
(167, 1),
(168, 1),
(169, 1),
(170, 1),
(171, 1),
(172, 1),
(173, 1),
(174, 1),
(175, 1),
(176, 1),
(177, 1),
(178, 1),
(179, 1),
(180, 1),
(181, 1),
(182, 1),
(183, 1),
(184, 1),
(185, 1),
(186, 1),
(187, 1),
(188, 1),
(189, 1),
(190, 1),
(191, 1),
(192, 1),
(193, 1),
(194, 1),
(195, 1),
(196, 1),
(197, 1),
(198, 1),
(199, 1),
(200, 1),
(201, 1),
(202, 1),
(203, 1),
(204, 1),
(205, 1),
(206, 1),
(207, 1),
(208, 1),
(157, 3),
(161, 5),
(159, 7),
(160, 9),
(163, 11),
(164, 11),
(165, 11),
(166, 11),
(167, 11),
(168, 11),
(169, 11),
(170, 11),
(171, 11),
(172, 11),
(173, 11),
(185, 12),
(186, 12),
(187, 12),
(188, 12),
(189, 12),
(192, 12),
(194, 12),
(196, 12),
(197, 12),
(198, 12),
(199, 12),
(200, 12),
(201, 12),
(202, 12),
(203, 12),
(204, 12),
(205, 12),
(206, 12),
(207, 12),
(208, 12);

-- --------------------------------------------------------

--
-- Table structure for table `salaries`
--

CREATE TABLE `salaries` (
  `id` int(10) UNSIGNED NOT NULL,
  `employee_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `salary` double NOT NULL,
  `id_office` varchar(191) NOT NULL,
  `sub_id` int(11) DEFAULT NULL,
  `note` text,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `salaries`
--

INSERT INTO `salaries` (`id`, `employee_id`, `date`, `salary`, `id_office`, `sub_id`, `note`, `status`, `created_at`, `updated_at`) VALUES
(1, 7, '2019-07-17', 2500, '3342', NULL, 'لا يوجد', 'active', '2020-04-29 18:58:28', '2020-05-03 05:31:10'),
(2, 7, '2020-04-16', 3000, '3342', NULL, NULL, 'active', '2020-04-30 13:12:09', '2020-04-30 13:12:09'),
(3, 7, '2020-05-26', 100, '123', NULL, 'test', 'active', '2020-05-03 05:30:47', '2020-05-03 05:30:47'),
(4, 12, '2020-05-04', 3000, '2342', NULL, NULL, 'active', '2020-05-10 18:03:53', '2020-05-10 18:03:53'),
(5, 7, '2020-05-31', 3000, '2342', NULL, NULL, 'active', '2020-05-10 18:04:40', '2020-05-10 18:04:40'),
(6, 16, '2020-05-06', 100, '5468', NULL, 'ىخ', 'active', '2020-05-13 22:12:58', '2020-05-13 22:12:58');

-- --------------------------------------------------------

--
-- Table structure for table `sent_emails`
--

CREATE TABLE `sent_emails` (
  `id` int(10) UNSIGNED NOT NULL,
  `hash` char(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` text COLLATE utf8mb4_unicode_ci,
  `sender` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `recipient` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `opens` int(11) DEFAULT NULL,
  `clicks` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `message_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sent_emails_url_clicked`
--

CREATE TABLE `sent_emails_url_clicked` (
  `id` int(10) UNSIGNED NOT NULL,
  `sent_email_id` int(10) UNSIGNED NOT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hash` char(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `clicks` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `login_color` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keywords` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci,
  `address` text COLLATE utf8mb4_unicode_ci,
  `admin_path` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin_theme` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website_theme` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `language` enum('en','ar') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `enable_watermark` enum('yes','no') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `watermark_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `watermark_position` enum('top-left','top','top-right','left','center','right','bottom-left','bottom','bottom-right') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `watermark_offset` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `multi_lang` enum('yes','no') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website_status` enum('open','closed') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `allow_admin_theme` enum('yes','no') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `allow_website_theme` enum('yes','no') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `close_message` longtext COLLATE utf8mb4_unicode_ci,
  `allow_register` enum('yes','no') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `session_timeout` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about_title` text COLLATE utf8mb4_unicode_ci,
  `contact_title` text COLLATE utf8mb4_unicode_ci,
  `address_lang` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_lat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zoom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `form_desc` text COLLATE utf8mb4_unicode_ci,
  `slider` varchar(199) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `copy_right` varchar(199) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Alweseemy',
  `slider_2` varchar(199) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `homepageTitle` text COLLATE utf8mb4_unicode_ci,
  `homesliderDesc` text COLLATE utf8mb4_unicode_ci,
  `homepageTitle_2` text COLLATE utf8mb4_unicode_ci,
  `homesliderDesc_2` text COLLATE utf8mb4_unicode_ci,
  `homepageImage` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `googleplus` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `footer_desc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `email`, `phone`, `mobile`, `color`, `login_color`, `logo`, `icon`, `keywords`, `description`, `address`, `admin_path`, `admin_theme`, `website_theme`, `language`, `enable_watermark`, `watermark_image`, `watermark_position`, `watermark_offset`, `multi_lang`, `website_status`, `allow_admin_theme`, `allow_website_theme`, `close_message`, `allow_register`, `session_timeout`, `contact_image`, `about_image`, `about_title`, `contact_title`, `address_lang`, `address_lat`, `zoom`, `form_desc`, `slider`, `copy_right`, `slider_2`, `homepageTitle`, `homesliderDesc`, `homepageTitle_2`, `homesliderDesc_2`, `homepageImage`, `facebook`, `twitter`, `googleplus`, `linkedin`, `footer_desc`, `created_at`, `updated_at`) VALUES
(1, '{\"ar\":\"بلو أرو\",\"en\":\"Blue Arrow\"}', 'info@b-arrow.com', '96897890223', '+964', NULL, '#1062e5', 'images/21331598037442.png', 'images/681598036773.png', '{\"ar\":\"هذا اختبار هذا اختبار هذا اختبار\",\"en\":null}', '{\"ar\":null,\"en\":null}', '{\"ar\":\"Erbil\",\"en\":\"Iraq\"}', 'admin', 'layout1', 'layout1', 'en', 'yes', '/orbscope/logo.png', 'bottom-left', '10', 'yes', 'open', 'yes', 'no', 'bn', 'yes', '2800', 'images/58381507567271.jpg', 'images/43011507567228.jpg', '{\"ar\":\"ما هو \\\"لوريم إيبسوم\\\" ؟\",\"en\":\"What is Lorem Ipsum?\"}', '{\"ar\":null,\"en\":null}', NULL, NULL, NULL, '{\"ar\":null,\"en\":null}', 'images/9121569536925.jpg', 'Blue Arrow', 'images/24201569538776.jpg', '{\"ar\":null,\"en\":null}', '{\"ar\":null,\"en\":null}', '{\"ar\":null,\"en\":null}', '{\"ar\":null,\"en\":null}', 'images/9101507567167.jpg', 'https://www.facebook.com/', 'https://www.facebook.com/', 'https://www.facebook.com', 'https://www.facebook.com/', '{\"ar\":null,\"en\":null}', '2017-06-17 19:41:22', '2020-08-21 18:17:22');

-- --------------------------------------------------------

--
-- Table structure for table `stays`
--

CREATE TABLE `stays` (
  `id` int(10) UNSIGNED NOT NULL,
  `employee_id` int(11) NOT NULL,
  `return` double NOT NULL,
  `stay` double NOT NULL,
  `date` date NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stays`
--

INSERT INTO `stays` (`id`, `employee_id`, `return`, `stay`, `date`, `status`, `created_at`, `updated_at`) VALUES
(1, 15, 45.7, 345.7, '2020-05-10', 'active', '2020-05-12 14:34:45', '2020-05-12 14:39:59'),
(2, 16, 1000, 2000, '2020-05-25', 'active', '2020-05-14 03:25:27', '2020-05-14 03:25:27');

-- --------------------------------------------------------

--
-- Table structure for table `subtracts`
--

CREATE TABLE `subtracts` (
  `id` int(10) UNSIGNED NOT NULL,
  `employee_id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `date` date NOT NULL,
  `amount` double NOT NULL,
  `note` text,
  `type` enum('sub','reward') NOT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subtracts`
--

INSERT INTO `subtracts` (`id`, `employee_id`, `name`, `date`, `amount`, `note`, `type`, `status`, `created_at`, `updated_at`) VALUES
(1, 7, 'خصم يوم', '2020-05-01', 100, 'لا يوجد', 'sub', 'active', '2020-04-30 14:30:57', '2020-05-01 12:12:32'),
(2, 7, 'حافز اداء', '2020-04-08', 100, 'لا يوجد', 'reward', 'active', '2020-05-01 12:00:27', '2020-05-01 12:00:27');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(225) CHARACTER SET utf8 DEFAULT NULL,
  `lang` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `admin_theme` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('inactive','active') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(99) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `inactive_date` date DEFAULT NULL,
  `active_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `phone`, `lang`, `employee_id`, `admin_theme`, `status`, `remember_token`, `type`, `inactive_date`, `active_date`, `created_at`, `updated_at`) VALUES
(1, 'Omar Ayad', 'omar@b-arrow.com', '$2y$10$TlEGw/a7/PQlTp78aARdZe/dSCHDAUgtj3tjekCtAcekR1v.VCi2O', '', 'ar', NULL, 'layout1', 'active', '5IRCgj9WaOFQmwhtfnIevXeGExQQFONMwoG1NnfHaHspynF5Kf1wqhRwwg8y', 'admin', NULL, NULL, '2017-06-17 19:41:22', '2020-09-21 18:08:18'),
(25, 'hr user', 'hr@gmail.com', '$2y$10$SooRrIDxbk82YaDou18DSu9Am/hBS8PHHk..W4/qzw0aHIM2MMx9u', NULL, NULL, NULL, NULL, 'inactive', 'EvEI56WfDDeK8qrrMToGRU09MX5uA9tKL5E18V8STuWvRNjunxYEpuQ5oQov', 'agent', '2020-08-22', NULL, '2020-04-25 13:32:15', '2020-08-21 21:11:42'),
(27, 'gwerger', 'alisa@gmail.com', '$2y$10$oLuVLo05KlYBUNlr7zOGzebIUnDWk4hjMTDQYYRwLGyfibT0fJ9XW', NULL, NULL, 16, NULL, 'inactive', NULL, 'agent', NULL, NULL, '2020-04-26 15:22:20', '2020-05-15 15:07:49'),
(28, 'Omar', 'omar@gmail.com', '$2y$10$tnu0NEi.vHenvM27CxCEh.2pxy2.Basi8ASjqQc16/k/9hpEqKBba', NULL, NULL, NULL, NULL, 'inactive', NULL, 'agent', '2020-05-15', NULL, '2020-05-03 05:17:11', '2020-05-15 14:56:53');

-- --------------------------------------------------------

--
-- Table structure for table `vacations`
--

CREATE TABLE `vacations` (
  `id` int(10) UNSIGNED NOT NULL,
  `employee_id` int(11) NOT NULL,
  `totla_hours` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vacations`
--

INSERT INTO `vacations` (`id`, `employee_id`, `totla_hours`, `start_date`, `end_date`, `status`, `created_at`, `updated_at`) VALUES
(1, 15, 47, '2020-05-17', '2020-05-19', 'active', '2020-05-12 13:50:50', '2020-05-12 14:01:41'),
(2, 16, 34, '2020-05-12', '2020-05-19', 'active', '2020-05-14 04:59:09', '2020-05-14 04:59:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branch_historics`
--
ALTER TABLE `branch_historics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `currencies_name_unique` (`name`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customers_name_unique` (`name`),
  ADD UNIQUE KEY `customers_code_unique` (`code`);

--
-- Indexes for table `customer_types`
--
ALTER TABLE `customer_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `depart__historics`
--
ALTER TABLE `depart__historics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `invoices_invoice_number_unique` (`invoice_number`);

--
-- Indexes for table `invoice_types`
--
ALTER TABLE `invoice_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `invoice_types_name_unique` (`name`);

--
-- Indexes for table `invoice__logs`
--
ALTER TABLE `invoice__logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_id_notifiable_type_index` (`notifiable_id`,`notifiable_type`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `postion_historics`
--
ALTER TABLE `postion_historics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `representor__details`
--
ALTER TABLE `representor__details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `represent_lists`
--
ALTER TABLE `represent_lists`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `represent_lists_name_unique` (`name`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `salaries`
--
ALTER TABLE `salaries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sent_emails`
--
ALTER TABLE `sent_emails`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sent_emails_hash_unique` (`hash`);

--
-- Indexes for table `sent_emails_url_clicked`
--
ALTER TABLE `sent_emails_url_clicked`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sent_emails_url_clicked_sent_email_id_foreign` (`sent_email_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stays`
--
ALTER TABLE `stays`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subtracts`
--
ALTER TABLE `subtracts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `vacations`
--
ALTER TABLE `vacations`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `branch_historics`
--
ALTER TABLE `branch_historics`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `customer_types`
--
ALTER TABLE `customer_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `depart__historics`
--
ALTER TABLE `depart__historics`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `invoice_types`
--
ALTER TABLE `invoice_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `invoice__logs`
--
ALTER TABLE `invoice__logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=209;

--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `postion_historics`
--
ALTER TABLE `postion_historics`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `representor__details`
--
ALTER TABLE `representor__details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `represent_lists`
--
ALTER TABLE `represent_lists`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `salaries`
--
ALTER TABLE `salaries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `stays`
--
ALTER TABLE `stays`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `subtracts`
--
ALTER TABLE `subtracts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `vacations`
--
ALTER TABLE `vacations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
