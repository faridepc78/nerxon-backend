-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 05, 2022 at 08:14 PM
-- Server version: 5.7.33
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nerxon`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(4, '2022_07_05_083241_create_jobs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 1, '+989162154221_api_token', 'a6d8d8f89d6cbab701c108026d07f63618688abf3f6723d1a1fb1558f0dfea44', '[\"*\"]', NULL, '2022-11-05 19:23:58', '2022-11-05 19:23:58'),
(2, 'App\\Models\\User', 1, '+989162154221_api_token', '91a9fa1d1258e20271988c2b27831d6eee01de5a94e856974eda05faafd8fef5', '[\"*\"]', NULL, '2022-11-05 19:29:44', '2022-11-05 19:29:44'),
(3, 'App\\Models\\User', 1, '+989162154221_api_token', '1f9221ef6278b8c03e67800bf0fcfad3f0431ee4a214a4b9accfab528af4a9ac', '[\"*\"]', NULL, '2022-11-05 19:37:39', '2022-11-05 19:37:39'),
(4, 'App\\Models\\User', 1, '+989162154221_api_token', '93b00d186aacf6c3cfe6da2e3b05ad533ee5c705785f9b93082755475bc7b441', '[\"*\"]', NULL, '2022-11-05 19:39:00', '2022-11-05 19:39:00'),
(5, 'App\\Models\\User', 1, '+989162154221_api_token', '4947f72125748aee664e317c8c5f612bab344251a965ee77dd97802584269be7', '[\"*\"]', NULL, '2022-11-05 19:39:05', '2022-11-05 19:39:05'),
(6, 'App\\Models\\User', 1, '+989162154221_api_token', 'e42450af52ea5a0a25a1aa612600d1a6bdaca1ef102db7bb2f77b7109d3ba09c', '[\"*\"]', '2022-11-05 20:05:15', '2022-11-05 19:52:45', '2022-11-05 20:05:15'),
(7, 'App\\Models\\User', 1, '+989162154221_api_token', '1c8a51ce27a682021cdefe00880a5ee338e7edf5bcf6189fc40f2d585e1b3e54', '[\"*\"]', NULL, '2022-11-05 20:05:10', '2022-11-05 20:05:10'),
(8, 'App\\Models\\User', 1, '+989162154221_api_token', 'd96b25835bf44cde1b9d18d8a6562a1a08e82634576f552af1a66c59f0080298', '[\"*\"]', NULL, '2022-11-05 20:05:29', '2022-11-05 20:05:29'),
(9, 'App\\Models\\User', 2, 'faridnewepc78@gmail.com_api_token', '2b945baaaf466089de3d9b54eadf17e8db25d15bce46d9e1c2e50857d222f84c', '[\"*\"]', NULL, '2022-11-05 20:07:17', '2022-11-05 20:07:17');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `expire_date` timestamp NOT NULL,
  `storage` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `user_mode` enum('active','blocked','suspended_blocked') COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_active_datetime` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `phone_number`, `country`, `city`, `address`, `expire_date`, `storage`, `user_mode`, `password`, `last_active_datetime`, `created_at`, `updated_at`) VALUES
(1, '+989162154221', 'farid@gmail.com', '+989162154221', 'iran', 'yazd', 'this is a test', '2032-11-05 19:22:52', '1', 'active', '$2y$10$1bqjYLSI0tCtJIFWsSwtKOpqbVWSDttCwerFfjBB8QLfU5epXLYJO', '2022-11-05 20:05:29', '2022-11-05 19:22:52', '2022-11-05 20:05:29'),
(2, 'faridnewepc78@gmail.com', 'faridnewepc78@gmail.com', NULL, NULL, NULL, NULL, '2032-11-05 20:06:53', '1', 'active', '$2y$10$ApPHlexl5DX1/1dGsjDMVuigxaHzX3X33jdQkkpHjJH9GwLui5a66', '2022-11-05 20:07:17', '2022-11-05 20:06:54', '2022-11-05 20:07:17');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_number_unique` (`phone_number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
