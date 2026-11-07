-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 07, 2026 at 01:33 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inmatch`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-bagas@vendor.com|127.0.0.1', 'i:1;', 1778393871),
('laravel-cache-bagas@vendor.com|127.0.0.1:timer', 'i:1778393871;', 1778393871),
('laravel-cache-tapat@hotsauce.com|127.0.0.1', 'i:3;', 1778393825),
('laravel-cache-tapat@hotsauce.com|127.0.0.1:timer', 'i:1778393825;', 1778393825);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Video Editor', '2026-11-06 17:29:23', '2026-11-06 17:29:23'),
(2, 'Foto Editor', '2026-11-06 17:29:23', '2026-11-06 17:29:23'),
(3, 'Graphic Designer', '2026-11-06 17:29:23', '2026-11-06 17:29:23');

-- --------------------------------------------------------

--
-- Table structure for table `category_profile`
--

CREATE TABLE `category_profile` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `profile_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category_profile`
--

INSERT INTO `category_profile` (`id`, `profile_id`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 2, 2, NULL, NULL),
(2, 2, 3, NULL, NULL),
(3, 3, 1, NULL, NULL),
(4, 3, 2, NULL, NULL),
(5, 3, 3, NULL, NULL),
(6, 4, 1, NULL, NULL),
(7, 4, 2, NULL, NULL),
(8, 5, 2, NULL, NULL),
(9, 5, 3, NULL, NULL),
(10, 7, 1, NULL, NULL),
(11, 7, 2, NULL, NULL),
(12, 8, 2, NULL, NULL),
(13, 8, 3, NULL, NULL),
(14, 9, 1, NULL, NULL),
(15, 9, 2, NULL, NULL),
(16, 9, 3, NULL, NULL),
(17, 10, 1, NULL, NULL),
(18, 10, 2, NULL, NULL),
(19, 11, 2, NULL, NULL),
(20, 11, 3, NULL, NULL),
(21, 12, 1, NULL, NULL),
(22, 12, 2, NULL, NULL),
(23, 12, 3, NULL, NULL),
(24, 13, 1, NULL, NULL),
(25, 13, 2, NULL, NULL),
(26, 14, 2, NULL, NULL),
(27, 14, 3, NULL, NULL),
(28, 15, 1, NULL, NULL),
(29, 15, 2, NULL, NULL),
(30, 15, 3, NULL, NULL),
(31, 16, 1, NULL, NULL),
(32, 16, 2, NULL, NULL),
(33, 17, 2, NULL, NULL),
(34, 17, 3, NULL, NULL),
(35, 18, 1, NULL, NULL),
(36, 18, 2, NULL, NULL),
(37, 18, 3, NULL, NULL),
(38, 19, 1, NULL, NULL),
(39, 19, 2, NULL, NULL),
(40, 20, 2, NULL, NULL),
(41, 20, 3, NULL, NULL),
(42, 21, 1, NULL, NULL),
(43, 21, 2, NULL, NULL),
(44, 21, 3, NULL, NULL),
(45, 22, 1, NULL, NULL),
(46, 22, 2, NULL, NULL),
(47, 23, 2, NULL, NULL),
(48, 23, 3, NULL, NULL),
(49, 24, 1, NULL, NULL),
(50, 24, 2, NULL, NULL),
(51, 24, 3, NULL, NULL),
(52, 25, 1, NULL, NULL),
(53, 25, 2, NULL, NULL),
(54, 26, 2, NULL, NULL),
(55, 26, 3, NULL, NULL),
(56, 27, 1, NULL, NULL),
(57, 27, 2, NULL, NULL),
(58, 27, 3, NULL, NULL),
(59, 28, 1, NULL, NULL),
(60, 28, 2, NULL, NULL),
(61, 29, 2, NULL, NULL),
(62, 29, 3, NULL, NULL),
(63, 30, 1, NULL, NULL),
(64, 30, 2, NULL, NULL),
(65, 30, 3, NULL, NULL),
(66, 32, 1, NULL, NULL),
(67, 32, 2, NULL, NULL),
(68, 32, 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `chat_messages`
--

CREATE TABLE `chat_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `endorsement_id` bigint(20) UNSIGNED NOT NULL,
  `sender_id` bigint(20) UNSIGNED DEFAULT NULL,
  `message` text DEFAULT NULL,
  `attachment_path` varchar(255) DEFAULT NULL,
  `attachment_type` varchar(255) DEFAULT NULL,
  `is_system` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chat_messages`
--

INSERT INTO `chat_messages` (`id`, `endorsement_id`, `sender_id`, `message`, `attachment_path`, `attachment_type`, `is_system`, `created_at`, `updated_at`) VALUES
(1, 5, 7, 'e', NULL, NULL, 0, '2026-11-06 17:10:18', '2026-11-06 17:10:18');

-- --------------------------------------------------------

--
-- Table structure for table `dynamic_backgrounds`
--

CREATE TABLE `dynamic_backgrounds` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dynamic_backgrounds`
--

INSERT INTO `dynamic_backgrounds` (`id`, `type`, `content`, `is_active`, `created_at`, `updated_at`) VALUES
(6, 'shape', 'cube', 1, '2026-05-06 11:01:07', '2026-05-06 11:01:07'),
(7, 'shape', 'rhombus', 1, '2026-05-06 11:02:20', '2026-05-06 11:02:20'),
(8, 'shape', 'cube', 1, '2026-05-06 11:07:48', '2026-05-06 11:07:48'),
(9, 'shape', 'cylinder', 1, '2026-05-06 11:07:48', '2026-05-06 11:07:48'),
(10, 'shape', 'pyramid', 1, '2026-05-06 11:07:48', '2026-05-06 11:07:48');

-- --------------------------------------------------------

--
-- Table structure for table `endorsements`
--

CREATE TABLE `endorsements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vendor_id` bigint(20) UNSIGNED NOT NULL,
  `influencer_id` bigint(20) UNSIGNED NOT NULL,
  `description` text NOT NULL,
  `offered_price` decimal(15,2) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `vendor_completed_at` timestamp NULL DEFAULT NULL,
  `influencer_completed_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `endorsements`
--

INSERT INTO `endorsements` (`id`, `vendor_id`, `influencer_id`, `description`, `offered_price`, `status`, `created_at`, `updated_at`, `vendor_completed_at`, `influencer_completed_at`) VALUES
(1, 3, 4, 'p', 200000.00, 'completed', '2026-05-10 13:35:00', '2026-06-18 11:40:31', NULL, NULL),
(2, 3, 7, 'Tolong buatkan video', 300000.00, 'completed', '2026-06-18 11:40:20', '2026-06-18 12:40:57', NULL, NULL),
(3, 3, 7, 'Review resto di jakarta', 150000.00, 'completed', '2026-06-18 12:22:28', '2026-06-23 18:00:00', NULL, NULL),
(4, 8, 7, 'Review resto yang ada di bandung', 180000.00, 'completed', '2026-06-23 19:14:07', '2026-06-23 19:17:15', NULL, NULL),
(5, 3, 7, 'buatin spanduk, brosur, dan video dongs', 500000.00, 'pending', '2026-11-06 17:09:47', '2026-11-06 17:09:47', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `media_uploads`
--

CREATE TABLE `media_uploads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `file_type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `media_uploads`
--

INSERT INTO `media_uploads` (`id`, `user_id`, `file_path`, `file_type`, `created_at`, `updated_at`) VALUES
(1, 7, 'media/JyDnXcdTVXMyUr51YqzNYaarh6PhBMSeOTQIR110.jpg', 'image', '2026-06-18 11:05:37', '2026-06-18 11:05:37'),
(2, 7, 'media/Sj09BbDaMk3erw4TmLFlfyDUT8Gb0Lj0JBKQiALj.jpg', 'image', '2026-06-18 11:05:45', '2026-06-18 11:05:45'),
(4, 7, 'media/BACV88ntLeaRGhqdd9ZQQF84sBKKWGRosr2Qj1Ep.mp4', 'video', '2026-06-18 11:19:18', '2026-06-18 11:19:18'),
(5, 3, 'media/530US9oTD5P4GoTp23eXOrRimCPPDF9ccS39TDT4.jpg', 'image', '2026-06-18 13:32:28', '2026-06-18 13:32:28');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `endorsement_id` bigint(20) UNSIGNED NOT NULL,
  `sender_id` bigint(20) UNSIGNED NOT NULL,
  `message` text DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `file_type` varchar(255) DEFAULT NULL,
  `is_system` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `endorsement_id`, `sender_id`, `message`, `file_path`, `file_type`, `is_system`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 'bla bla bla ble ble ble blo blo blo', NULL, NULL, 0, '2026-06-18 11:39:30', '2026-06-18 11:39:30'),
(2, 1, 3, NULL, 'chat_attachments/LZpBVKnEiho2iBYG4v7DKZiR1Ntdira2cqIFLjvT.jpg', 'image', 0, '2026-06-18 11:39:43', '2026-06-18 11:39:43'),
(3, 1, 3, 'Kolaborasi ini telah ditandai sebagai SELESAI oleh Vendor (Tiktop Shop).', NULL, NULL, 1, '2026-06-18 11:40:31', '2026-06-18 11:40:31'),
(4, 2, 3, 'p', 'chat_attachments/DjKUsKYu11DnRsIfIK8r1c2fRMFEB5PynDFFYUg9.jpg', 'image', 0, '2026-06-18 11:40:56', '2026-06-18 11:40:56'),
(5, 2, 3, 'buatkan video promotion untuk restoran yang ada di jakarta', NULL, NULL, 0, '2026-06-18 11:41:33', '2026-06-18 11:41:33'),
(6, 2, 7, 'berapa menit ya kira-kira ?', NULL, NULL, 0, '2026-06-18 11:42:48', '2026-06-18 11:42:48'),
(7, 2, 3, '3 menit full edit', NULL, NULL, 0, '2026-06-18 11:47:20', '2026-06-18 11:47:20'),
(8, 2, 7, '300k ya', NULL, NULL, 0, '2026-06-18 11:47:39', '2026-06-18 11:47:39'),
(9, 2, 3, 'oke siap', NULL, NULL, 0, '2026-06-18 11:47:54', '2026-06-18 11:47:54'),
(10, 2, 7, 'Influencer (MyFood.id) mengajukan tawaran harga baru sebesar Rp 300.000 (sebelumnya Rp 250.000).', NULL, NULL, 1, '2026-06-18 11:48:09', '2026-06-18 11:48:09'),
(11, 2, 3, 'Vendor (Tiktop Shop) mengajukan tawaran harga baru sebesar Rp 300.000 (sebelumnya Rp 300.000).', NULL, NULL, 1, '2026-06-18 11:48:22', '2026-06-18 11:48:22'),
(12, 2, 7, 'Influencer (MyFood.id) telah MENYETUJUI tawaran harga sebesar Rp 300.000.', NULL, NULL, 1, '2026-06-18 11:48:38', '2026-06-18 11:48:38'),
(13, 2, 7, 'terima kasih telah memesan', NULL, NULL, 0, '2026-06-18 11:48:59', '2026-06-18 11:48:59'),
(14, 2, 3, '==================================\n         STRUK PEMBAYARAN RESMI   \n==================================\nNo. Transaksi : #TX-IM-2-FAE3EC\nCampaign      : Tolong buatkan video\nMetode        : CREDIT\nTotal Bayar   : Rp 300.000\nStatus        : LUNAS / BERHASIL\nWaktu         : 18-06-2026 05:11:34\n==================================\nPembayaran berhasil diselesaikan.\nKolaborasi kini berstatus AKTIF!', NULL, NULL, 1, '2026-06-18 12:11:34', '2026-06-18 12:11:34'),
(15, 3, 3, 'tolong review yak', 'chat_attachments/87JF8QFNx1IZazKndHOwOsjNrMXsJbhUAWZkGPau.jpg', 'image', 0, '2026-06-18 12:23:06', '2026-06-18 12:23:06'),
(16, 3, 7, 'oke', NULL, NULL, 0, '2026-06-18 12:24:03', '2026-06-18 12:24:03'),
(17, 2, 7, 'Kolaborasi ini telah ditandai sebagai SELESAI oleh Influencer (MyFood.id).', NULL, NULL, 1, '2026-06-18 12:40:57', '2026-06-18 12:40:57'),
(18, 2, 3, 'Vendor telah memberikan penilaian ⭐⭐⭐⭐⭐ (5/5) kepada Influencer.\nCatatan: \"bagus\"', NULL, NULL, 1, '2026-06-18 12:59:58', '2026-06-18 12:59:58'),
(19, 3, 3, '{\"receipt\":true,\"tx_number\":\"TX-IM-3-C1CB4B\",\"campaign\":\"Review resto di jakarta\",\"payment_method\":\"OVO\",\"amount\":150000,\"date\":\"23-06-2026 10:58:27\"}', NULL, NULL, 1, '2026-06-23 17:58:27', '2026-06-23 17:58:27'),
(20, 3, 7, 'Kolaborasi ini telah ditandai sebagai SELESAI oleh Influencer (MyFood.id).', NULL, NULL, 1, '2026-06-23 18:00:00', '2026-06-23 18:00:00'),
(21, 3, 3, 'Vendor telah memberikan penilaian ⭐⭐⭐⭐ (4/5) kepada Influencer.\nCatatan: \"Okelah, tidak terlalu wah juga\"', NULL, NULL, 1, '2026-06-23 18:00:26', '2026-06-23 18:00:26'),
(22, 4, 7, 'Influencer (MyFood.id) mengajukan tawaran harga baru sebesar Rp 200.000 (sebelumnya Rp 150.000).', NULL, NULL, 1, '2026-06-23 19:15:03', '2026-06-23 19:15:03'),
(23, 4, 8, 'Vendor (Bagas Prasetyo) mengajukan tawaran harga baru sebesar Rp 180.000 (sebelumnya Rp 200.000).', NULL, NULL, 1, '2026-06-23 19:15:22', '2026-06-23 19:15:22'),
(24, 4, 8, NULL, 'chat_attachments/dxlwmlrGz9f64JafvvWrdZuPhCPLNYTaxBIey4xI.jpg', 'image', 0, '2026-06-23 19:15:43', '2026-06-23 19:15:43'),
(25, 4, 7, 'Influencer (MyFood.id) telah MENYETUJUI tawaran harga sebesar Rp 180.000.', NULL, NULL, 1, '2026-06-23 19:16:12', '2026-06-23 19:16:12'),
(26, 4, 8, '{\"receipt\":true,\"tx_number\":\"TX-IM-4-CEB0A8\",\"campaign\":\"Review resto yang ada di ba...\",\"payment_method\":\"OVO\",\"amount\":180000,\"date\":\"23-06-2026 12:16:33\"}', NULL, NULL, 1, '2026-06-23 19:16:33', '2026-06-23 19:16:33'),
(27, 4, 7, 'Kolaborasi ini telah ditandai sebagai SELESAI oleh Influencer (MyFood.id).', NULL, NULL, 1, '2026-06-23 19:17:15', '2026-06-23 19:17:15'),
(28, 4, 8, 'Vendor telah memberikan penilaian ⭐⭐ (2/5) kepada Influencer.\nCatatan: \"Video kurang bagus\"', NULL, NULL, 1, '2026-06-23 19:17:55', '2026-06-23 19:17:55');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_05_04_060604_create_permission_tables', 1),
(5, '2026_05_04_060632_add_role_and_status_to_users_table', 1),
(6, '2026_05_04_060633_create_categories_table', 1),
(7, '2026_05_04_060633_create_profiles_table', 1),
(8, '2026_05_04_060634_create_dynamic_backgrounds_table', 1),
(9, '2026_05_04_060634_create_media_uploads_table', 1),
(10, '2026_05_04_060635_create_endorsements_table', 1),
(11, '2026_05_04_060635_create_ratings_table', 1),
(12, '2026_05_04_060636_create_reports_table', 1),
(13, '2026_05_05_033831_add_avatar_to_profiles_table', 1),
(14, '2026_05_05_040733_create_settings_table', 1),
(15, '2026_06_18_043646_create_messages_table', 2),
(16, '2026_07_07_111639_create_chat_messages_table', 3),
(17, '2026_07_07_112452_add_attachment_to_chat_messages_table', 3),
(18, '2026_07_07_114824_add_completion_flags_to_endorsements_table', 3),
(19, '2026_11_07_000001_create_category_profile_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 2),
(4, 'App\\Models\\User', 3),
(4, 'App\\Models\\User', 8),
(4, 'App\\Models\\User', 33),
(5, 'App\\Models\\User', 4),
(5, 'App\\Models\\User', 5),
(5, 'App\\Models\\User', 6),
(5, 'App\\Models\\User', 7),
(5, 'App\\Models\\User', 9),
(5, 'App\\Models\\User', 10),
(5, 'App\\Models\\User', 11),
(5, 'App\\Models\\User', 12),
(5, 'App\\Models\\User', 13),
(5, 'App\\Models\\User', 14),
(5, 'App\\Models\\User', 15),
(5, 'App\\Models\\User', 16),
(5, 'App\\Models\\User', 17),
(5, 'App\\Models\\User', 18),
(5, 'App\\Models\\User', 19),
(5, 'App\\Models\\User', 20),
(5, 'App\\Models\\User', 21),
(5, 'App\\Models\\User', 22),
(5, 'App\\Models\\User', 23),
(5, 'App\\Models\\User', 24),
(5, 'App\\Models\\User', 25),
(5, 'App\\Models\\User', 26),
(5, 'App\\Models\\User', 27),
(5, 'App\\Models\\User', 28),
(5, 'App\\Models\\User', 29),
(5, 'App\\Models\\User', 30),
(5, 'App\\Models\\User', 31),
(5, 'App\\Models\\User', 32),
(5, 'App\\Models\\User', 34);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `latitude` decimal(10,7) DEFAULT NULL,
  `longitude` decimal(10,7) DEFAULT NULL,
  `min_price` decimal(15,2) DEFAULT NULL,
  `max_price` decimal(15,2) DEFAULT NULL,
  `primary_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `secondary_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `user_id`, `avatar`, `bio`, `city`, `latitude`, `longitude`, `min_price`, `max_price`, `primary_category_id`, `secondary_category_id`, `created_at`, `updated_at`) VALUES
(1, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-10 13:19:30', '2026-05-10 13:19:30'),
(2, 4, NULL, NULL, 'Jakarta', NULL, NULL, 150000.00, NULL, 5, 6, '2026-05-10 13:28:24', '2026-05-10 13:32:09'),
(3, 5, 'avatars/T7rtw4guBVFaUuAue5rbp4qHnEL7IdX08eiF9twu.jpg', 'Hola! yo soy enrique, yo soy de mexico', 'Tangerang', NULL, NULL, 100000.00, NULL, 5, 8, '2026-06-18 10:58:35', '2026-07-05 03:37:47'),
(4, 6, 'avatars/UySkTFz1OYF8CwIgPuYTNPy3LIRhYsO0Ud5BVSpC.png', NULL, 'Jakarta', NULL, NULL, 200000.00, NULL, 6, 10, '2026-06-18 10:59:50', '2026-06-18 12:35:06'),
(5, 7, 'avatars/GMLZU4KTMp2KsinhC3acaXnk9lr4Av8dqOsddbTH.png', 'Me review makanan adalah fashion saya', 'Depok', NULL, NULL, 200000.00, NULL, 3, 6, '2026-06-18 11:01:18', '2026-06-23 19:18:36'),
(6, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-06-23 19:11:17', '2026-06-23 19:11:17'),
(7, 9, NULL, 'Fashion content creator & OOTD enthusiast.', 'Jakarta', NULL, NULL, 500000.00, 2000000.00, 1, 12, '2026-07-05 03:23:37', '2026-07-05 03:23:37'),
(8, 10, NULL, 'Mens fashion & streetwear curator.', 'Bandung', NULL, NULL, 300000.00, 1500000.00, 1, 11, '2026-07-05 03:23:38', '2026-07-05 03:23:38'),
(9, 11, NULL, 'Beauty vlogger & skincare reviewer.', 'Jakarta', NULL, NULL, 400000.00, 1800000.00, 2, 1, '2026-07-05 03:23:38', '2026-07-05 03:23:38'),
(10, 12, NULL, 'Makeup artist & beauty tips daily.', 'Surabaya', NULL, NULL, 600000.00, 2500000.00, 2, 6, '2026-07-05 03:23:38', '2026-07-05 03:23:38'),
(11, 13, NULL, 'Food explorer & street food hunter.', 'Yogyakarta', NULL, NULL, 200000.00, 1000000.00, 3, 5, '2026-07-05 03:23:39', '2026-07-05 03:23:39'),
(12, 14, NULL, 'Home cooking recipes & restaurant reviews.', 'Jakarta', NULL, NULL, 350000.00, 1200000.00, 3, 12, '2026-07-05 03:23:39', '2026-07-05 03:23:39'),
(13, 15, NULL, 'Tech reviewer & gadget unboxer.', 'Jakarta', NULL, NULL, 800000.00, 3000000.00, 4, 7, '2026-07-05 03:23:39', '2026-07-05 03:23:39'),
(14, 16, NULL, 'Software tips & smartphone comparisons.', 'Bandung', NULL, NULL, 500000.00, 2000000.00, 4, 10, '2026-07-05 03:23:39', '2026-07-05 03:23:39'),
(15, 17, NULL, 'Travel blogger & hidden gems explorer.', 'Bali', NULL, NULL, 700000.00, 3500000.00, 5, 3, '2026-07-05 03:23:40', '2026-07-05 03:23:40'),
(16, 18, NULL, 'Adventure traveler & mountain hiker.', 'Malang', NULL, NULL, 400000.00, 2000000.00, 5, 6, '2026-07-05 03:23:40', '2026-07-05 03:23:40'),
(17, 19, NULL, 'Health tips on a budget, fitness motivation.', 'Jakarta', NULL, NULL, 300000.00, 1500000.00, 6, 12, '2026-07-05 03:23:40', '2026-07-05 03:23:40'),
(18, 20, NULL, 'Personal trainer & nutrition guide.', 'Surabaya', NULL, NULL, 600000.00, 2500000.00, 6, 2, '2026-07-05 03:23:41', '2026-07-05 03:23:41'),
(19, 21, NULL, 'Pro gamer & mobile legends streamer.', 'Jakarta', NULL, NULL, 500000.00, 2000000.00, 7, 4, '2026-07-05 03:23:41', '2026-07-05 03:23:41'),
(20, 22, NULL, 'Casual gamer & Valorant content.', 'Bandung', NULL, NULL, 250000.00, 1000000.00, 7, 11, '2026-07-05 03:23:41', '2026-07-05 03:23:41'),
(21, 23, NULL, 'Parenting tips & family vlogs.', 'Semarang', NULL, NULL, 300000.00, 1200000.00, 8, 10, '2026-07-05 03:23:42', '2026-07-05 03:23:42'),
(22, 24, NULL, 'Dad life content & kids activity ideas.', 'Jakarta', NULL, NULL, 250000.00, 1000000.00, 8, 12, '2026-07-05 03:23:42', '2026-07-05 03:23:42'),
(23, 25, NULL, 'Financial literacy & investment tips.', 'Jakarta', NULL, NULL, 1000000.00, 5000000.00, 9, 10, '2026-07-05 03:23:42', '2026-07-05 03:23:42'),
(24, 26, NULL, 'Entrepreneurship & side hustle ideas.', 'Surabaya', NULL, NULL, 750000.00, 3000000.00, 9, 12, '2026-07-05 03:23:42', '2026-07-05 03:23:42'),
(25, 27, NULL, 'Education content & study motivation.', 'Yogyakarta', NULL, NULL, 200000.00, 800000.00, 10, 4, '2026-07-05 03:23:43', '2026-07-05 03:23:43'),
(26, 28, NULL, 'Career coaching & LinkedIn tips.', 'Jakarta', NULL, NULL, 500000.00, 2000000.00, 10, 9, '2026-07-05 03:23:43', '2026-07-05 03:23:43'),
(27, 29, NULL, 'Stand-up clips & daily comedy skits.', 'Jakarta', NULL, NULL, 400000.00, 2000000.00, 11, 12, '2026-07-05 03:23:43', '2026-07-05 03:23:43'),
(28, 30, NULL, 'Meme queen & relatable content.', 'Bandung', NULL, NULL, 300000.00, 1500000.00, 11, 7, '2026-07-05 03:23:43', '2026-07-05 03:23:43'),
(29, 31, NULL, 'Daily lifestyle, cafe hopping & self-care.', 'Bali', NULL, NULL, 500000.00, 2000000.00, 12, 5, '2026-07-05 03:23:44', '2026-07-05 03:23:44'),
(30, 32, NULL, 'Minimalist living & chill vibes creator.', 'Malang', NULL, NULL, 250000.00, 1000000.00, 12, 3, '2026-07-05 03:23:44', '2026-07-05 03:23:44'),
(31, 33, NULL, 'Perusahaan digital mencari creative talent.', 'Jakarta', NULL, NULL, NULL, NULL, NULL, NULL, '2026-11-06 17:30:45', '2026-11-06 17:30:45'),
(32, 34, NULL, 'Spesialis video editing, foto editing, dan desain grafis profesional.', 'Jakarta', NULL, NULL, 250000.00, NULL, NULL, NULL, '2026-11-06 17:30:45', '2026-11-06 17:30:45');

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `endorsement_id` bigint(20) UNSIGNED NOT NULL,
  `reviewer_id` bigint(20) UNSIGNED NOT NULL,
  `reviewee_id` bigint(20) UNSIGNED NOT NULL,
  `score` int(11) NOT NULL,
  `comment` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`id`, `endorsement_id`, `reviewer_id`, `reviewee_id`, `score`, `comment`, `created_at`, `updated_at`) VALUES
(1, 2, 3, 7, 5, 'bagus', '2026-06-18 12:59:58', '2026-06-18 12:59:58'),
(2, 3, 3, 7, 4, 'Okelah, tidak terlalu wah juga', '2026-06-23 18:00:26', '2026-06-23 18:00:26'),
(3, 4, 8, 7, 2, 'Video kurang bagus', '2026-06-23 19:17:55', '2026-06-23 19:17:55');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reporter_id` bigint(20) UNSIGNED NOT NULL,
  `reported_id` bigint(20) UNSIGNED NOT NULL,
  `reason` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `proof_path` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2026-05-06 10:30:47', '2026-05-06 10:30:47'),
(2, 'vendor', 'web', '2026-05-06 10:30:47', '2026-05-06 10:30:47'),
(3, 'influencer', 'web', '2026-05-06 10:30:47', '2026-05-06 10:30:47'),
(4, 'client', 'web', '2026-11-06 17:30:38', '2026-11-06 17:30:38'),
(5, 'creator', 'web', '2026-11-06 17:30:38', '2026-11-06 17:30:38');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('bbe1CA8WB5TYAdlolPocUePExeK5MiLzJK2ikBRt', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/156.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTVljZ1VucFlhZW1RUGJSanUzVWd0VDVXT3FVOHdnOHZFNEhjQ0dzUCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7Tjt9fQ==', 1794010246),
('J0AQ3uuYZg05j6NQ9aaXRu7gIaY5z6LwLV42lVtW', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/156.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoid0F6T0psUEYxRmZuQXc2VlU1d1lrV0lUTDIzT0NRVndPSmFmY2xqNiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTA5OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvY2xpZW50L2Rhc2hib2FyZD9idWRnZXQ9MTUwMDAwJmNhdGVnb3JpZXMlNUIwJTVEPTImY2F0ZWdvcmllcyU1QjElNUQ9MyZsb2NhdGlvbj1KYWthcnRhIjtzOjU6InJvdXRlIjtzOjE2OiJjbGllbnQuZGFzaGJvYXJkIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mzt9', 1794013792),
('K1ylvcIb5flX43oVcKIk3aTEiSmqmQwl5jBVDZLy', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/156.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoicFFqMmhrSEVBQWc5N1JBUTJtVUk0QmlLT3lCZW45RE0wbU95S1lQNyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jbGllbnQvZGFzaGJvYXJkIjtzOjU6InJvdXRlIjtzOjE2OiJjbGllbnQuZGFzaGJvYXJkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mzt9', 1794053697);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'bg_animation_speed', 'fast', '2026-05-06 10:40:46', '2026-05-06 10:40:46'),
(2, 'bg_element_count', '25', '2026-05-06 10:40:46', '2026-05-06 11:07:48'),
(3, 'bg_element_shape', 'cube', '2026-05-06 10:40:46', '2026-05-06 10:56:09');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `status`) VALUES
(1, 'Test User', 'test@example.com', '2026-05-06 10:30:46', '$2y$12$8z82u01l6pGOyx1SvglJuebGqzw.l38WmyWCPR40dPTuLpIjULywO', 'qthr3HAINr', '2026-05-06 10:30:46', '2026-11-06 17:30:38', 'approved'),
(2, 'Super Admin', 'admin@inmatch.com', NULL, '$2y$12$4QaGS7R/ls8U6jx8iBxYrOYpnXhfNHFRNLsPYBEiZ2zWda7pIA2O2', NULL, '2026-05-06 10:30:47', '2026-11-06 17:30:38', 'approved'),
(3, 'Tiktop Shop', 'tts@tiktok.com', NULL, '$2y$12$snFLapfDm0jiLBH7TAnvCuzV63JNX7rTJLL6mpuhkFr7yk8qc69Cu', NULL, '2026-05-10 13:19:30', '2026-11-06 17:30:39', 'approved'),
(4, 'Influecer besar', 'infb@gmail.com', NULL, '$2y$12$EBxODvVHyApXLcNjlgyiF.tJJ.FwptJCbOJLxCcLUnZtGBFbiVS66', NULL, '2026-05-10 13:28:24', '2026-11-06 17:30:39', 'approved'),
(5, 'Enrique', 'enrique@gmail.com', NULL, '$2y$12$CZiMCdR12OKRVEj2h6AXQ.kcL/B6mC2pQJo6aFaWFew0W25bHBlui', NULL, '2026-06-18 10:58:35', '2026-11-06 17:30:39', 'approved'),
(6, 'Dawgter Gen Z', 'dawgter@gmail.com', NULL, '$2y$12$c0qVonhHJ5Onxidr9RMPr.XctmK64779N8AfWXkJdARyyzarcAonC', NULL, '2026-06-18 10:59:50', '2026-11-06 17:30:39', 'approved'),
(7, 'MyFood.id', 'myfood@gmail.com', NULL, '$2y$12$sOdH.ZIdZ3aXUB3F64HMXusRpJvlptrlKnIVrqVnwOxmDpWQOF/Qm', NULL, '2026-06-18 11:01:18', '2026-11-06 17:30:40', 'approved'),
(8, 'Bagas Prasetyo', 'bagasp@gmail.com', NULL, '$2y$12$q/xENbxc0kHOM5mY0fX/VuFAzdwu7cDyUT2S6MoihydJffSx3Wnkm', NULL, '2026-06-23 19:11:16', '2026-11-06 17:30:40', 'approved'),
(9, 'Rina Fashionista', 'rinafashionista@gmail.com', NULL, '$2y$12$x8tZS.QpnGv13Ib0ohk/COYPBvc7aJxvcGlmj2v7h45uoa4pJrVei', NULL, '2026-07-05 03:23:36', '2026-11-06 17:30:40', 'approved'),
(10, 'Dimas Style', 'dimasstyle@gmail.com', NULL, '$2y$12$P73naaF/klr8k4cwx1yuuO6H1P9ZI6n9Xf4WIY3wf4XJ1com52nuq', NULL, '2026-07-05 03:23:38', '2026-11-06 17:30:40', 'approved'),
(11, 'Sari Cantik', 'saricantik@gmail.com', NULL, '$2y$12$tXg5cNdvTmS1dZM/QUDBjeTHVPkKq6XjttaS9nh6aS1..nVXuzJSK', NULL, '2026-07-05 03:23:38', '2026-11-06 17:30:40', 'approved'),
(12, 'Lina Glow', 'linaglow@gmail.com', NULL, '$2y$12$HyEFG1HPHFKO.G03OFlLUeCemNqubmcxTP./quY16AGc9Ho3rGQiu', NULL, '2026-07-05 03:23:38', '2026-11-06 17:30:41', 'approved'),
(13, 'Budi Makan', 'budimakan@gmail.com', NULL, '$2y$12$IFpIj94atdSV/ZvdO2sBLOudsC6dh0t5kTJJnJFUTZPWDk3PyfyYu', NULL, '2026-07-05 03:23:39', '2026-11-06 17:30:41', 'approved'),
(14, 'Nisa Kuliner', 'nisakuliner@gmail.com', NULL, '$2y$12$K8tT/69pIE5BTs/7czpo0uV0n8j4BoZnUAdojWei.VmTDYT.DfRK.', NULL, '2026-07-05 03:23:39', '2026-11-06 17:30:41', 'approved'),
(15, 'Andi Tekno', 'anditekno@gmail.com', NULL, '$2y$12$OxSeSzDLPsazvkoob1aH9OCQec/KTg2fmSAHYHAQsBa0q2fHxO7kG', NULL, '2026-07-05 03:23:39', '2026-11-06 17:30:41', 'approved'),
(16, 'Fajar Digital', 'fajardigital@gmail.com', NULL, '$2y$12$nca3D0eUYOvtE8RV1YEeaO5wdPK.h6ThmueLlUnXgtY3MjxzoTt8a', NULL, '2026-07-05 03:23:39', '2026-11-06 17:30:42', 'approved'),
(17, 'Maya Jalan', 'mayajalan@gmail.com', NULL, '$2y$12$jFzvAu.ycWf4GQvvtgAsx.M0brgBUWgPl2WgWUJ6oKFYYzf7aJNJe', NULL, '2026-07-05 03:23:40', '2026-11-06 17:30:42', 'approved'),
(18, 'Reza Wanderer', 'rezawanderer@gmail.com', NULL, '$2y$12$rJfYcL0JVxYe7ZkCVrDbheQKixTghKdJu3gdX.UPjSmSRUYsyujg6', NULL, '2026-07-05 03:23:40', '2026-11-06 17:30:42', 'approved'),
(19, 'Dokter Kere', 'dokterkere@gmail.com', NULL, '$2y$12$T7Jd41r7JTKhTWcr0CLM3OH7OIHzLv/LTqAmm/NFq4L73uJO/dlTi', NULL, '2026-07-05 03:23:40', '2026-11-06 17:30:42', 'approved'),
(20, 'Fitri Sehat', 'fitrisehat@gmail.com', NULL, '$2y$12$iv0nPJtR.VOaEMgnPB1gD.QzmIFPQ3jIz.pZaRgoCLuvxDX1ARree', NULL, '2026-07-05 03:23:41', '2026-11-06 17:30:42', 'approved'),
(21, 'Galih Gamer', 'galihgamer@gmail.com', NULL, '$2y$12$ritJ0BGeITgImtD3VL7mhOO8xq8dhL5a6Fe/6MWNs5oEvHD5cWUGq', NULL, '2026-07-05 03:23:41', '2026-11-06 17:30:43', 'approved'),
(22, 'Tina Play', 'tinaplay@gmail.com', NULL, '$2y$12$uL3EBxJ4Q2e7E1xCEvp5PeVZDE6XrHo.SY2mPms6LIZgYT6dWtlQm', NULL, '2026-07-05 03:23:41', '2026-11-06 17:30:43', 'approved'),
(23, 'Mama Lia', 'mamalia@gmail.com', NULL, '$2y$12$IKbBMGJKOWFHuIBGmjxtje1114QS7if8iqk7nKS5C5xKncp9PG73y', NULL, '2026-07-05 03:23:41', '2026-11-06 17:30:43', 'approved'),
(24, 'Papa Arif', 'papaarif@gmail.com', NULL, '$2y$12$/aq2ZDVwUBMrT0IcLoIucOJtwuQRyPnpFqMYYa58pQoQmjgdMRw7S', NULL, '2026-07-05 03:23:42', '2026-11-06 17:30:43', 'approved'),
(25, 'Eko Cuan', 'ekocuan@gmail.com', NULL, '$2y$12$qDL.CPzZuT2494dYziH8/./F2Y5LmCLUc51g4YO52gkctz0Wkq0Ji', NULL, '2026-07-05 03:23:42', '2026-11-06 17:30:43', 'approved'),
(26, 'Dewi Bisnis', 'dewibisnis@gmail.com', NULL, '$2y$12$.Z0g.X56mqZjs.zsL7Q.fuEdDhPK/AAHvqZEAojfLc0LJsC0gvThG', NULL, '2026-07-05 03:23:42', '2026-11-06 17:30:44', 'approved'),
(27, 'Guru Viral', 'guruviral@gmail.com', NULL, '$2y$12$1FOdIe7pS9E4k4.MjykQKOlP9IU2VayZvz24MIBmz7f7r55RvPS6u', NULL, '2026-07-05 03:23:43', '2026-11-06 17:30:44', 'approved'),
(28, 'Sinta Karir', 'sintakarir@gmail.com', NULL, '$2y$12$A6xcVhaFTVNu2GC.5X3cqe1ZNfB3xF8CaI3C/rtdzf65EqdKT9hwC', NULL, '2026-07-05 03:23:43', '2026-11-06 17:30:44', 'approved'),
(29, 'Joko Lucu', 'jokolucu@gmail.com', NULL, '$2y$12$azDo9arJ.cicicWsvOrlTe3.uI5kzuDkEJku9qeQ0sxz5d56KtRdi', NULL, '2026-07-05 03:23:43', '2026-11-06 17:30:44', 'approved'),
(30, 'Cici Receh', 'cicireceh@gmail.com', NULL, '$2y$12$Gl8rmM/vSgiCc0QKVoKUJ..CNvylIsF/6BI27LxwfC7bqtcnszsyu', NULL, '2026-07-05 03:23:43', '2026-11-06 17:30:45', 'approved'),
(31, 'Ayu Daily', 'ayudaily@gmail.com', NULL, '$2y$12$U9vxFRhr/9JpO5iuS10f6O0pdY8quhKxwQONnmJHC2r/48oGTAbpK', NULL, '2026-07-05 03:23:44', '2026-11-06 17:30:45', 'approved'),
(32, 'Hadi Santai', 'hadisantai@gmail.com', NULL, '$2y$12$SfMfjb7X9sq6p3LPfdF4VuUhmFd0tYUYcbLgeXcluR30AXhKQraiC', NULL, '2026-07-05 03:23:44', '2026-11-06 17:30:45', 'approved'),
(33, 'Sample Client', 'client@inmatch.com', NULL, '$2y$12$Xm0AQTJXt4YzUUJEXE4K7.l4ABZdGzsJLuCHUhJN9C7vEVHWCSmr2', NULL, '2026-11-06 17:30:45', '2026-11-06 17:30:45', 'approved'),
(34, 'Creative Studio', 'creator@inmatch.com', NULL, '$2y$12$S0DCfvmSsyuXBd3/u1BDc..imAtQWvntutCixC2fv.ialoOzCnCO2', NULL, '2026-11-06 17:30:45', '2026-11-06 17:30:45', 'approved');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_profile`
--
ALTER TABLE `category_profile`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `category_profile_profile_id_category_id_unique` (`profile_id`,`category_id`),
  ADD KEY `category_profile_category_id_foreign` (`category_id`);

--
-- Indexes for table `chat_messages`
--
ALTER TABLE `chat_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chat_messages_endorsement_id_foreign` (`endorsement_id`),
  ADD KEY `chat_messages_sender_id_foreign` (`sender_id`);

--
-- Indexes for table `dynamic_backgrounds`
--
ALTER TABLE `dynamic_backgrounds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `endorsements`
--
ALTER TABLE `endorsements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `endorsements_vendor_id_foreign` (`vendor_id`),
  ADD KEY `endorsements_influencer_id_foreign` (`influencer_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `media_uploads`
--
ALTER TABLE `media_uploads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `media_uploads_user_id_foreign` (`user_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_endorsement_id_foreign` (`endorsement_id`),
  ADD KEY `messages_sender_id_foreign` (`sender_id`);

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
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profiles_user_id_foreign` (`user_id`),
  ADD KEY `profiles_primary_category_id_foreign` (`primary_category_id`),
  ADD KEY `profiles_secondary_category_id_foreign` (`secondary_category_id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ratings_endorsement_id_foreign` (`endorsement_id`),
  ADD KEY `ratings_reviewer_id_foreign` (`reviewer_id`),
  ADD KEY `ratings_reviewee_id_foreign` (`reviewee_id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reports_reporter_id_foreign` (`reporter_id`),
  ADD KEY `reports_reported_id_foreign` (`reported_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_key_unique` (`key`);

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
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `category_profile`
--
ALTER TABLE `category_profile`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `chat_messages`
--
ALTER TABLE `chat_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `dynamic_backgrounds`
--
ALTER TABLE `dynamic_backgrounds`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `endorsements`
--
ALTER TABLE `endorsements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `media_uploads`
--
ALTER TABLE `media_uploads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `category_profile`
--
ALTER TABLE `category_profile`
  ADD CONSTRAINT `category_profile_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `category_profile_profile_id_foreign` FOREIGN KEY (`profile_id`) REFERENCES `profiles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `chat_messages`
--
ALTER TABLE `chat_messages`
  ADD CONSTRAINT `chat_messages_endorsement_id_foreign` FOREIGN KEY (`endorsement_id`) REFERENCES `endorsements` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `chat_messages_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `endorsements`
--
ALTER TABLE `endorsements`
  ADD CONSTRAINT `endorsements_influencer_id_foreign` FOREIGN KEY (`influencer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `endorsements_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `media_uploads`
--
ALTER TABLE `media_uploads`
  ADD CONSTRAINT `media_uploads_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_endorsement_id_foreign` FOREIGN KEY (`endorsement_id`) REFERENCES `endorsements` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `messages_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `profiles`
--
ALTER TABLE `profiles`
  ADD CONSTRAINT `profiles_primary_category_id_foreign` FOREIGN KEY (`primary_category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `profiles_secondary_category_id_foreign` FOREIGN KEY (`secondary_category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `profiles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_endorsement_id_foreign` FOREIGN KEY (`endorsement_id`) REFERENCES `endorsements` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ratings_reviewee_id_foreign` FOREIGN KEY (`reviewee_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ratings_reviewer_id_foreign` FOREIGN KEY (`reviewer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `reports_reported_id_foreign` FOREIGN KEY (`reported_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reports_reporter_id_foreign` FOREIGN KEY (`reporter_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
