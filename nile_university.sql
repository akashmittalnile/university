-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 09, 2024 at 06:30 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nile_university`
--

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `reply` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `phone`, `email`, `address`, `message`, `status`, `reply`, `created_at`, `updated_at`) VALUES
(1, 'Rahul Katre', NULL, 'hulkweb21@gmail.com', '76767', 'mjhmjnk', NULL, NULL, '2024-01-08 08:32:41', '2024-01-08 08:32:41');

-- --------------------------------------------------------

--
-- Table structure for table `contents`
--

CREATE TABLE `contents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `value` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contents`
--

INSERT INTO `contents` (`id`, `name`, `type`, `value`, `created_at`, `updated_at`) VALUES
(1, 'about', NULL, '<h2>Our Recent Blogs</h2>\r\n\r\n<p>Giving you the professional guidance and expert tools you need to execute projects with soaring success to become leaders in business &amp; beyond&trade;.</p>\r\n\r\n<h2>Events</h2>\r\n\r\n<p>Most importantly, ECONO-ProjectEX is committed to collaborate with the international project management community, and offer tremendous advantages to Micro, Small and Medium-sized enterprises (MSMEs): Executives/Sponsors, Entrepreneurs, Consultants, Contractors, Teachers, Students, Project/ Senior Managers, Project Management Offices (PMOs) among others who are eager to shift and serve their industries.</p>\r\n\r\n<p><img alt=\"image\" class=\"img-fluid\" src=\"images/community.jpg\" style=\"border-bottom:10px solid #3fab40; border-left:10px solid #3fab40; box-shadow:rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px; display:block; margin-top:50px!important; margin:0 auto; width:600px\" /></p>\r\n\r\n<h2>Merch</h2>\r\n\r\n<p>Most importantly, ECONO-ProjectEX is committed to collaborate with the international project management community, and offer tremendous advantages to Micro, Small and Medium-sized enterprises (MSMEs): Executives/Sponsors, Entrepreneurs, Consultants, Contractors, Teachers, Students, Project/ Senior Managers, Project Management Offices (PMOs) among others who are eager to shift and serve their industries.</p>\r\n\r\n<div style=\"display: flex;justify-content: center;\"><img alt=\"image\" src=\"images/merch-1.jpg\" style=\"border-bottom:10px solid #3fab40; border-left:10px solid #3fab40; box-shadow:rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px; display:block; height:500px; margin-bottom:50px!important; margin-top:20px!important; margin:0 auto; object-fit:cover; width:400px\" /> <img alt=\"image\" src=\"images/merch-2.jpg\" style=\"border-bottom:10px solid #3fab40; border-left:10px solid #3fab40; box-shadow:rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px; display:block; height:500px; margin-bottom:50px!important; margin-top:20px!important; margin:0 auto; object-fit:cover; width:400px\" /></div>\r\n\r\n<h2>Conference</h2>\r\n\r\n<p>Most importantly, ECONO-ProjectEX is committed to collaborate with the international project management community, and offer tremendous advantages to Micro, Small and Medium-sized enterprises (MSMEs): Executives/Sponsors, Entrepreneurs, Consultants, Contractors, Teachers, Students, Project/ Senior Managers, Project Management Offices (PMOs) among others who are eager to shift and serve their industries.</p>', '2023-12-26 08:05:24', '2023-12-26 08:13:50'),
(2, 'mark-network', NULL, NULL, '2023-12-26 08:05:32', '2023-12-26 08:05:32'),
(3, 'mark-burnet', NULL, NULL, '2024-01-04 04:32:30', '2024-01-04 04:32:30'),
(4, 'resources', NULL, '<p>resources</p>', '2024-01-04 04:33:05', '2024-01-04 04:33:12'),
(5, 'gallery', NULL, NULL, '2024-01-04 04:48:59', '2024-01-04 04:48:59');

-- --------------------------------------------------------

--
-- Table structure for table `ebooks`
--

CREATE TABLE `ebooks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `pdf_file` text DEFAULT NULL,
  `pdf_file_size` text DEFAULT NULL,
  `thumbnail` text DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `plans` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `cancellation_policy` text DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `views` bigint(20) DEFAULT NULL,
  `downloads` bigint(20) DEFAULT NULL,
  `likes` bigint(20) DEFAULT NULL,
  `comments` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ebooks`
--

INSERT INTO `ebooks` (`id`, `name`, `pdf_file`, `pdf_file_size`, `thumbnail`, `price`, `plans`, `description`, `cancellation_policy`, `status`, `views`, `downloads`, `likes`, `comments`, `created_at`, `updated_at`) VALUES
(2, 'new ebook', 'ebook_6596b36cb3eec.pdf', '733.75 KB', 'ebook_6596b36cb3eec.jpg', NULL, '4,2', 'test', 'ets', NULL, NULL, NULL, NULL, NULL, '2024-01-04 08:02:28', '2024-01-04 08:03:46');

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
(1, '2014_10_12_000000_create_users_table', 1),
(3, '2023_12_20_110446_create_contents_table', 2),
(5, '2023_12_20_110312_create_podcasts_table', 3),
(6, '2023_12_20_110320_create_plans_table', 4),
(7, '2023_12_20_110117_create_ebooks_table', 5),
(8, '2024_01_05_132404_create_user_plan_details_table', 6),
(9, '2023_12_26_135013_create_contacts_table', 7);

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

CREATE TABLE `plans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `price_id` varchar(255) DEFAULT NULL,
  `product_id` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `image` text DEFAULT NULL,
  `flyers` int(11) DEFAULT NULL,
  `podcasts` int(11) DEFAULT NULL,
  `ebooks` tinyint(1) DEFAULT NULL,
  `gallary` tinyint(1) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `currency` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `plans`
--

INSERT INTO `plans` (`id`, `name`, `price_id`, `product_id`, `type`, `image`, `flyers`, `podcasts`, `ebooks`, `gallary`, `status`, `price`, `currency`, `description`, `created_at`, `updated_at`) VALUES
(1, 'PLAN D', 'price_1Nt6EGFL18J9ekRoQ2N86vZb', 'prod_OgTA7ZhcdgN5k5', 'month', NULL, NULL, NULL, NULL, NULL, NULL, '234', 'inr', 'All Podcsts Unlimited Access', '2024-01-03 05:55:43', '2024-01-03 05:55:43'),
(2, 'PLAN C', 'price_1Nt6hEFL18J9ekRog7ZGoXhX', 'prod_Og7F6yYvGKId39', 'month', NULL, NULL, 12, 12, NULL, NULL, '120', 'inr', 'Access 12 podcasts,All ccomplishment Gallery unlimited access.,Access 12 ebooks', '2024-01-03 05:55:44', '2024-01-03 07:09:18'),
(3, 'Plan B', 'price_1NuCM9FL18J9ekRoJ5YPySM8', 'prod_OfNHX810wcW6Qr', 'month', NULL, NULL, 100, 100, 12, NULL, '200', 'inr', 'Access 100 podcasts,Access 12 ccomplishment Gallery,Access 100 ebooks', '2024-01-03 05:55:44', '2024-01-03 07:09:44'),
(4, 'Plan A', 'price_1Ns2OnFL18J9ekRoJ9G1yaKk', 'prod_OfN9qPtafhF8dV', 'month', NULL, NULL, 2, 1, 1, NULL, '0', 'inr', 'Access 2 podcasts,Access 1 ccomplishment Gallery,Access 1 ebooks', '2024-01-03 05:55:44', '2024-01-03 07:09:31');

-- --------------------------------------------------------

--
-- Table structure for table `podcasts`
--

CREATE TABLE `podcasts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `audio_file` text DEFAULT NULL,
  `audio_file_size` text DEFAULT NULL,
  `thumbnail` text DEFAULT NULL,
  `free` tinyint(1) NOT NULL DEFAULT 0,
  `price` varchar(255) DEFAULT NULL,
  `plans` text DEFAULT NULL,
  `trial_mins` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `cancellation_policy` text DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `views` bigint(20) DEFAULT 0,
  `listens` bigint(20) DEFAULT 0,
  `likes` bigint(20) DEFAULT 0,
  `comments` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `podcasts`
--

INSERT INTO `podcasts` (`id`, `name`, `audio_file`, `audio_file_size`, `thumbnail`, `free`, `price`, `plans`, `trial_mins`, `description`, `cancellation_policy`, `status`, `views`, `listens`, `likes`, `comments`, `created_at`, `updated_at`) VALUES
(3, 'new podcast 2', 'podcast_65940d2f84aa0.mp3', '371.46 KB', 'podcast_65940d2f84aa0.webp', 0, '343', NULL, '4', 'dds', 'fg', NULL, 0, 0, 0, NULL, '2024-01-02 07:48:39', '2024-01-02 07:48:39'),
(4, 'newpodcast', 'podcast_65969bb245bab.mp3', '1.79 MB', 'podcast_6596974cc1750.webp', 0, NULL, '4,2', NULL, 'description', 'description', NULL, 0, 0, 0, NULL, '2024-01-04 06:02:28', '2024-01-04 06:21:14'),
(5, 'best podcast to discover new things', 'podcast_65969f5bf1feb.mp3', '645.27 KB', 'podcast_65969f5bf1feb.webp', 0, NULL, '4,2', NULL, 'description', 'policy', NULL, 0, 0, 0, NULL, '2024-01-04 06:36:51', '2024-01-04 06:36:51');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT 0,
  `address` text DEFAULT NULL,
  `profile` text DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `customer_id` text DEFAULT NULL,
  `subscription_id` text DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `email`, `email_verified_at`, `password`, `admin`, `address`, `profile`, `remember_token`, `created_at`, `updated_at`, `customer_id`, `subscription_id`, `last_login`) VALUES
(1, 'Admin', NULL, 'admin@university.com', NULL, '$2y$12$2DwSCh1lFeniUYc/efwHT.5y9Tb5SAM/JvR2/xYy3h6saUz/ldeja', 1, NULL, NULL, NULL, '2023-12-20 07:29:15', '2024-01-05 07:59:27', 'cus_PJrBnJYe06tpXV', 'sub_1OVDSiFL18J9ekRoZm68o5H6', NULL),
(2, 'rahul katre', '9755908334', 'smart1boy2rahul3@gmail.com', NULL, '$2y$12$4YpVaFZEHbzopIGYCZiFKOUjZBZGSK5l7WPR.TqzqvBZw6bCZyXxK', 0, NULL, NULL, NULL, '2023-12-26 05:37:57', '2023-12-26 05:37:57', NULL, NULL, NULL),
(3, 'new user', '334343434343434', 'rahul1@gmail.com', NULL, '$2y$12$Kuf/c2IE4ihUunAvDHa9hucn81jgGPitCp0gFgCDKFrm4ohfrVYDi', 0, NULL, NULL, NULL, '2024-01-04 04:16:29', '2024-01-04 04:16:29', NULL, NULL, NULL),
(4, 'john alex', '8343434343434', 'alex@yopmail.com', NULL, '$2y$12$oZFo4V7g/pz96vuQmMZIWupMdM/g8aYtoaQjCePeZhLtbLaJvLlVq', 0, NULL, NULL, NULL, '2024-01-04 04:53:09', '2024-01-05 08:02:06', 'cus_PJrDHguO2HUF57', 'sub_1OVDVHFL18J9ekRo08XVtFtn', NULL),
(5, 'alex geek', '9723849833', 'geek@yopmail.com', NULL, '$2y$12$KDddrz1SUCViuNAUN31ae.rzdqmjrXuOQ6UkJ6jbU9Y/ywGwxhJqu', 0, NULL, NULL, NULL, '2024-01-04 06:23:54', '2024-01-04 06:23:54', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_plan_details`
--

CREATE TABLE `user_plan_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `plan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `subs_id` varchar(255) DEFAULT NULL,
  `transaction_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_plan_details`
--

INSERT INTO `user_plan_details` (`id`, `user_id`, `plan_id`, `start_date`, `end_date`, `status`, `subs_id`, `transaction_id`, `created_at`, `updated_at`) VALUES
(1, 1, 2, '2024-01-05 13:29:27', '2024-02-02 13:29:27', 'Active', 'sub_1OVDSiFL18J9ekRoZm68o5H6', 'ch_1OVDSkFL18J9ekRoB4xoIicA', '2024-01-05 07:59:27', '2024-01-05 07:59:27'),
(2, 4, 2, '2024-01-05 13:32:06', '2024-02-02 13:32:06', 'Active', 'sub_1OVDVHFL18J9ekRo08XVtFtn', 'ch_1OVDVKFL18J9ekRolB09ubQM', '2024-01-05 08:02:06', '2024-01-05 08:02:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contents`
--
ALTER TABLE `contents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ebooks`
--
ALTER TABLE `ebooks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `podcasts`
--
ALTER TABLE `podcasts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_plan_details`
--
ALTER TABLE `user_plan_details`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contents`
--
ALTER TABLE `contents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ebooks`
--
ALTER TABLE `ebooks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `podcasts`
--
ALTER TABLE `podcasts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_plan_details`
--
ALTER TABLE `user_plan_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
