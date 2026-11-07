-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 07, 2026 at 08:43 AM
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
(1, 'Fashion & Style', '2026-05-06 10:30:47', '2026-05-06 10:30:47'),
(2, 'Beauty & Makeup', '2026-05-06 10:30:47', '2026-05-06 10:30:47'),
(3, 'Food & Beverage', '2026-05-06 10:30:47', '2026-05-06 10:30:47'),
(4, 'Tech & Gadgets', '2026-05-06 10:30:47', '2026-05-06 10:30:47'),
(5, 'Travel & Leisure', '2026-05-06 10:30:47', '2026-05-06 10:30:47'),
(6, 'Health & Fitness', '2026-05-06 10:30:47', '2026-05-06 10:30:47'),
(7, 'Gaming & Esports', '2026-05-06 10:30:47', '2026-05-06 10:30:47'),
(8, 'Family & Parenting', '2026-05-06 10:30:47', '2026-05-06 10:30:47'),
(9, 'Finance & Business', '2026-05-06 10:30:47', '2026-05-06 10:30:47'),
(10, 'Education & Career', '2026-05-06 10:30:47', '2026-05-06 10:30:47'),
(11, 'Entertainment & Comedy', '2026-05-06 10:30:47', '2026-05-06 10:30:47'),
(12, 'Lifestyle', '2026-05-06 10:30:47', '2026-05-06 10:30:47');

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
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `endorsements`
--

INSERT INTO `endorsements` (`id`, `vendor_id`, `influencer_id`, `description`, `offered_price`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, 4, 'p', 200000.00, 'completed', '2026-05-10 13:35:00', '2026-06-18 11:40:31'),
(2, 3, 7, 'Tolong buatkan video', 300000.00, 'completed', '2026-06-18 11:40:20', '2026-06-18 12:40:57'),
(3, 3, 7, 'Review resto di jakarta', 150000.00, 'completed', '2026-06-18 12:22:28', '2026-06-23 18:00:00'),
(4, 8, 7, 'Review resto yang ada di bandung', 180000.00, 'completed', '2026-06-23 19:14:07', '2026-06-23 19:17:15');

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
(15, '2026_06_18_043646_create_messages_table', 2);

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
(2, 'App\\Models\\User', 3),
(2, 'App\\Models\\User', 8),
(3, 'App\\Models\\User', 4),
(3, 'App\\Models\\User', 5),
(3, 'App\\Models\\User', 6),
(3, 'App\\Models\\User', 7),
(3, 'App\\Models\\User', 9),
(3, 'App\\Models\\User', 10),
(3, 'App\\Models\\User', 11),
(3, 'App\\Models\\User', 12),
(3, 'App\\Models\\User', 13),
(3, 'App\\Models\\User', 14),
(3, 'App\\Models\\User', 15),
(3, 'App\\Models\\User', 16),
(3, 'App\\Models\\User', 17),
(3, 'App\\Models\\User', 18),
(3, 'App\\Models\\User', 19),
(3, 'App\\Models\\User', 20),
(3, 'App\\Models\\User', 21),
(3, 'App\\Models\\User', 22),
(3, 'App\\Models\\User', 23),
(3, 'App\\Models\\User', 24),
(3, 'App\\Models\\User', 25),
(3, 'App\\Models\\User', 26),
(3, 'App\\Models\\User', 27),
(3, 'App\\Models\\User', 28),
(3, 'App\\Models\\User', 29),
(3, 'App\\Models\\User', 30),
(3, 'App\\Models\\User', 31),
(3, 'App\\Models\\User', 32);

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
(30, 32, NULL, 'Minimalist living & chill vibes creator.', 'Malang', NULL, NULL, 250000.00, 1000000.00, 12, 3, '2026-07-05 03:23:44', '2026-07-05 03:23:44');

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
(3, 'influencer', 'web', '2026-05-06 10:30:47', '2026-05-06 10:30:47');

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
('GZae00M0PwJKubWoa90nEaUxYF3OFzoe1ZTqdRh2', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiV1lweUpXdXhaWVpXd2hJQXNnT0gxcERXeXlDeHNhb3NXdWhnRW1SOCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC92ZW5kb3IvZGFzaGJvYXJkIjtzOjU6InJvdXRlIjtzOjE2OiJ2ZW5kb3IuZGFzaGJvYXJkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mzt9', 1783406325);

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
(1, 'Test User', 'test@example.com', '2026-05-06 10:30:46', '$2y$12$iJ0JJa01KMZH/66DK5xXte9GIhw8u/76G.M.aS7gU1YBhQrTYpa12', 'qthr3HAINr', '2026-05-06 10:30:46', '2026-06-18 12:31:14', 'banned'),
(2, 'Super Admin', 'admin@inmatch.com', NULL, '$2y$12$5/Eq5i4jXI3p5DiVybJFWuR7/1J0VfwSTe1E9TbgpL8bBjhhjTbAu', NULL, '2026-05-06 10:30:47', '2026-05-06 10:30:47', 'approved'),
(3, 'Tiktop Shop', 'tts@tiktok.com', NULL, '$2y$12$MQcIPNi8OJIrrjAHlU/5rOqS38c9De2cECkXUA6z0DtB1.cWKfC1G', NULL, '2026-05-10 13:19:30', '2026-05-10 13:26:17', 'approved'),
(4, 'Influecer besar', 'infb@gmail.com', NULL, '$2y$12$NI9667ukICnrwjOJ.B5OVOL0ouXfnbLBi922s1U8..A0mAXx7dg/e', NULL, '2026-05-10 13:28:24', '2026-06-18 12:31:42', 'banned'),
(5, 'Enrique', 'enrique@gmail.com', NULL, '$2y$12$9ZuacoYjfeEIhS29BSnqeel907bdc6l5SrW8xz.daXKMcYnq941fu', NULL, '2026-06-18 10:58:35', '2026-06-18 11:01:47', 'approved'),
(6, 'Dawgter Gen Z', 'dawgter@gmail.com', NULL, '$2y$12$BacUh0heKdR/EMZnkjjkBeCgvkhXOromaE8KGRJ6hKs7eTO8f42lC', NULL, '2026-06-18 10:59:50', '2026-06-18 11:01:51', 'approved'),
(7, 'MyFood.id', 'myfood@gmail.com', NULL, '$2y$12$iNxpXBe4HLR28HFV9tsPsOPtaFtpVuIeMwf3oczxAbZ70zP9UeJi.', NULL, '2026-06-18 11:01:18', '2026-06-18 11:01:54', 'approved'),
(8, 'Bagas Prasetyo', 'bagasp@gmail.com', NULL, '$2y$12$ixYEC/3Xv7umJcIDBestJ.Z5LcCf8sJcOyDVoJ2b33Bs.zzQiIAsC', NULL, '2026-06-23 19:11:16', '2026-06-23 19:12:43', 'approved'),
(9, 'Rina Fashionista', 'rinafashionista@gmail.com', NULL, '$2y$12$VVF1YAwNdRaUJ6l52d3y6OsAZeG4TDdYJiRUWUriOoI3zhJ5hXGrG', NULL, '2026-07-05 03:23:36', '2026-07-05 03:23:36', 'approved'),
(10, 'Dimas Style', 'dimasstyle@gmail.com', NULL, '$2y$12$IIFcEvRFmlaTdO6XxpAKmOm1tDrS2qc73laqP5X6zvwFIYB9xq.Yu', NULL, '2026-07-05 03:23:38', '2026-07-05 03:23:38', 'approved'),
(11, 'Sari Cantik', 'saricantik@gmail.com', NULL, '$2y$12$uEeA.zd7lTkefgunWuL./OSts5tD2T7f3VrTwbxVrGZXfY9VaICi2', NULL, '2026-07-05 03:23:38', '2026-07-05 03:23:38', 'approved'),
(12, 'Lina Glow', 'linaglow@gmail.com', NULL, '$2y$12$Ram3WnGH3SGXwta7uCZW5ejgJzsXo.THI5MirbanINndCQMIQPR/i', NULL, '2026-07-05 03:23:38', '2026-07-05 03:23:38', 'approved'),
(13, 'Budi Makan', 'budimakan@gmail.com', NULL, '$2y$12$QFgHhHD61Ev3UZAdSjoqj.J7P9owIT4KRBGAXcg.GQ8FY0eE1fpyi', NULL, '2026-07-05 03:23:39', '2026-07-05 03:23:39', 'approved'),
(14, 'Nisa Kuliner', 'nisakuliner@gmail.com', NULL, '$2y$12$53.tZgya01qvxSauZlmRrOrbhqS61iGBnuI/qQ4rwVEalYy7QnNh6', NULL, '2026-07-05 03:23:39', '2026-07-05 03:23:39', 'approved'),
(15, 'Andi Tekno', 'anditekno@gmail.com', NULL, '$2y$12$3vML3dpywonJl2cznIXkd.qgT9vhkK8FIKFNMnRHI1D3mEhWxVJkm', NULL, '2026-07-05 03:23:39', '2026-07-05 03:23:39', 'approved'),
(16, 'Fajar Digital', 'fajardigital@gmail.com', NULL, '$2y$12$pTH1cSbT8.UHCD5ms1.CiOtdjBUASKpFU8VbiUEt4LWgCe5TMeUWa', NULL, '2026-07-05 03:23:39', '2026-07-05 03:23:39', 'approved'),
(17, 'Maya Jalan', 'mayajalan@gmail.com', NULL, '$2y$12$fk87u8DlzssoYYsAaq3qb.X6vmBdmzoGzClnyH00eW2pJMj.H08Me', NULL, '2026-07-05 03:23:40', '2026-07-05 03:23:40', 'approved'),
(18, 'Reza Wanderer', 'rezawanderer@gmail.com', NULL, '$2y$12$1DRESBG1NnbY2GkRWoBlNOKIc5cOxjv5nzQ/gMAW2g1pk3pw/IR6q', NULL, '2026-07-05 03:23:40', '2026-07-05 03:23:40', 'approved'),
(19, 'Dokter Kere', 'dokterkere@gmail.com', NULL, '$2y$12$1SxWaqPVioSDur9WNZynWu33VLtdHN6vOmjh8cXdlVIflq.pKrye.', NULL, '2026-07-05 03:23:40', '2026-07-05 03:23:40', 'approved'),
(20, 'Fitri Sehat', 'fitrisehat@gmail.com', NULL, '$2y$12$2ASXZAaU1x9ZUvziRqKmSe9r9xvSV1CoUjIquoubasoRGG8.IOJtS', NULL, '2026-07-05 03:23:41', '2026-07-05 03:23:41', 'approved'),
(21, 'Galih Gamer', 'galihgamer@gmail.com', NULL, '$2y$12$PW9cwCapeu5MzK2QFQvTZeyG/JpnkoD1V5WjNkbuuRVkxQKe28882', NULL, '2026-07-05 03:23:41', '2026-07-05 03:23:41', 'approved'),
(22, 'Tina Play', 'tinaplay@gmail.com', NULL, '$2y$12$EskCWUKEo7OfCQyCiypRJOJMLNhiQjnoA9pyG9y.LhGt/Tvu0YJeK', NULL, '2026-07-05 03:23:41', '2026-07-05 03:23:41', 'approved'),
(23, 'Mama Lia', 'mamalia@gmail.com', NULL, '$2y$12$85huADteVApnI19jqNqJj.Gih3Ohve6pIFK2XuNcoQYo2oiIDbi5y', NULL, '2026-07-05 03:23:41', '2026-07-05 03:23:41', 'approved'),
(24, 'Papa Arif', 'papaarif@gmail.com', NULL, '$2y$12$Er4.iWDMbgn6R96Fu/erkexROr7Pu3RcAVdo7xWryk1tSbVaBbIEG', NULL, '2026-07-05 03:23:42', '2026-07-05 03:23:42', 'approved'),
(25, 'Eko Cuan', 'ekocuan@gmail.com', NULL, '$2y$12$2wwFqVCtG9Zt0Uten9ZmIezsrUFGOYurUtTPujIsJY.Z96fOCZdFa', NULL, '2026-07-05 03:23:42', '2026-07-05 03:23:42', 'approved'),
(26, 'Dewi Bisnis', 'dewibisnis@gmail.com', NULL, '$2y$12$CLjqvjoiiWkC4ldXBrD9bOmhsMxobh1yre6WrYMDODy/HvautP5dy', NULL, '2026-07-05 03:23:42', '2026-07-05 03:23:42', 'approved'),
(27, 'Guru Viral', 'guruviral@gmail.com', NULL, '$2y$12$ngZpkAVpWhb1z99Y.HFayOsVoSArkgXS61cJy9yocid5I8iiiBmZ2', NULL, '2026-07-05 03:23:43', '2026-07-05 03:23:43', 'approved'),
(28, 'Sinta Karir', 'sintakarir@gmail.com', NULL, '$2y$12$3.GZFsG42Vm8mUiZ/aasg.2lL.C1FLQ9lNhLqnMhYUUdu8c7IUqC6', NULL, '2026-07-05 03:23:43', '2026-07-05 03:23:43', 'approved'),
(29, 'Joko Lucu', 'jokolucu@gmail.com', NULL, '$2y$12$boqrRN7NW4l7bBSNPPlOvur.CT5qkuCmJg3RGN9.RWsNSLkUxS/G2', NULL, '2026-07-05 03:23:43', '2026-07-05 03:23:43', 'approved'),
(30, 'Cici Receh', 'cicireceh@gmail.com', NULL, '$2y$12$t351m8zpdJtud0vjZzyWSOFxnW9YWMzOp64tMz6cW/nMAxeuKDrj6', NULL, '2026-07-05 03:23:43', '2026-07-05 03:23:43', 'approved'),
(31, 'Ayu Daily', 'ayudaily@gmail.com', NULL, '$2y$12$oik/WfUDR5pw.S/DC0jv3OKmLDUjLTFPwFBifXSB5q1fgZa1L6APa', NULL, '2026-07-05 03:23:44', '2026-07-05 03:23:44', 'approved'),
(32, 'Hadi Santai', 'hadisantai@gmail.com', NULL, '$2y$12$6Y7DF1cZW9oa8mBUecPno.mnyRtfaqJBesYWCzI9jgNDkEXQRbpQi', NULL, '2026-07-05 03:23:44', '2026-07-05 03:23:44', 'approved');

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `dynamic_backgrounds`
--
ALTER TABLE `dynamic_backgrounds`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `endorsements`
--
ALTER TABLE `endorsements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Constraints for dumped tables
--

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
