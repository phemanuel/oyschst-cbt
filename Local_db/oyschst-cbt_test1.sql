-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2024 at 07:02 PM
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
-- Database: `oyschst-cbt`
--

-- --------------------------------------------------------

--
-- Table structure for table `academic_sessions`
--

CREATE TABLE `academic_sessions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `session1` varchar(255) NOT NULL,
  `status` enum('active','Inactive') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `academic_sessions`
--

INSERT INTO `academic_sessions` (`id`, `session1`, `status`, `created_at`, `updated_at`) VALUES
(1, '2022/2023', 'active', '2024-05-09 20:12:38', '2024-05-09 20:12:38'),
(2, '2023/2024', 'active', '2024-05-09 20:12:38', '2024-05-09 20:12:38'),
(3, '2024/2025', 'active', '2024-05-09 20:12:38', '2024-05-09 20:12:38'),
(4, '2025/2026', 'active', '2024-05-09 20:12:38', '2024-05-09 20:12:38'),
(5, '2026/2027', 'active', '2024-05-09 20:12:38', '2024-05-09 20:12:38'),
(6, '2027/2028', 'active', '2024-05-09 20:12:38', '2024-05-09 20:12:38'),
(7, '2028/2029', 'active', '2024-05-09 20:12:38', '2024-05-09 20:12:38'),
(8, '2029/2030', 'active', '2024-05-09 20:12:38', '2024-05-09 20:12:38'),
(9, '2030/2031', 'active', '2024-05-09 20:12:38', '2024-05-09 20:12:38'),
(10, '2031/2032', 'active', '2024-05-09 20:12:38', '2024-05-09 20:12:38'),
(11, '2032/2033', 'active', '2024-05-09 20:12:38', '2024-05-09 20:12:38'),
(12, '2033/2034', 'active', '2024-05-09 20:12:38', '2024-05-09 20:12:38'),
(13, '2034/2035', 'active', '2024-05-09 20:12:38', '2024-05-09 20:12:38'),
(14, '2035/2036', 'active', '2024-05-09 20:12:38', '2024-05-09 20:12:38'),
(15, '2036/2037', 'active', '2024-05-09 20:12:38', '2024-05-09 20:12:38'),
(16, '2037/2038', 'active', '2024-05-09 20:12:38', '2024-05-09 20:12:38'),
(17, '2038/2039', 'active', '2024-05-09 20:12:38', '2024-05-09 20:12:38'),
(18, '2039/2040', 'active', '2024-05-09 20:12:38', '2024-05-09 20:12:38');

-- --------------------------------------------------------

--
-- Table structure for table `cbt_classes`
--

CREATE TABLE `cbt_classes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `level` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cbt_classes`
--

INSERT INTO `cbt_classes` (`id`, `level`, `created_at`, `updated_at`) VALUES
(1, '100', '2024-05-10 03:35:58', '2024-05-10 03:35:58'),
(2, '200', '2024-05-10 03:36:05', '2024-05-10 03:36:05'),
(3, '300', '2024-05-10 03:36:10', '2024-05-10 03:36:10'),
(4, 'NDI', '2024-05-10 03:36:16', '2024-05-10 03:36:16'),
(5, 'NDII', '2024-05-10 03:36:22', '2024-05-10 03:36:22'),
(6, 'HNDI', '2024-05-10 03:36:27', '2024-05-10 03:36:27'),
(7, 'HNDII', '2024-05-10 03:36:33', '2024-05-10 03:36:33');

-- --------------------------------------------------------

--
-- Table structure for table `cbt_evaluation1`
--

CREATE TABLE `cbt_evaluation1` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `examstatus` text DEFAULT NULL,
  `studentname` text DEFAULT NULL,
  `correct` text DEFAULT NULL,
  `noofquestion` text DEFAULT NULL,
  `wrong` text DEFAULT NULL,
  `studentno` text DEFAULT NULL,
  `score` text DEFAULT NULL,
  `level` text DEFAULT NULL,
  `session1` text DEFAULT NULL,
  `semester` text DEFAULT NULL,
  `hour` int(11) DEFAULT NULL,
  `minute` int(11) DEFAULT NULL,
  `qstno` text DEFAULT NULL,
  `OK1` text DEFAULT NULL,
  `OK2` text DEFAULT NULL,
  `OK3` text DEFAULT NULL,
  `OK4` text DEFAULT NULL,
  `OK5` text DEFAULT NULL,
  `OK6` text DEFAULT NULL,
  `OK7` text DEFAULT NULL,
  `OK8` text DEFAULT NULL,
  `OK9` text DEFAULT NULL,
  `OK10` text DEFAULT NULL,
  `OK11` text DEFAULT NULL,
  `OK12` text DEFAULT NULL,
  `OK13` text DEFAULT NULL,
  `OK14` text DEFAULT NULL,
  `OK15` text DEFAULT NULL,
  `OK16` text DEFAULT NULL,
  `OK17` text DEFAULT NULL,
  `OK18` text DEFAULT NULL,
  `OK19` text DEFAULT NULL,
  `OK20` text DEFAULT NULL,
  `OK21` text DEFAULT NULL,
  `OK22` text DEFAULT NULL,
  `OK23` text DEFAULT NULL,
  `OK24` text DEFAULT NULL,
  `OK25` text DEFAULT NULL,
  `OK26` text DEFAULT NULL,
  `OK27` text DEFAULT NULL,
  `OK28` text DEFAULT NULL,
  `OK29` text DEFAULT NULL,
  `OK30` text DEFAULT NULL,
  `OK31` text DEFAULT NULL,
  `OK32` text DEFAULT NULL,
  `OK33` text DEFAULT NULL,
  `OK34` text DEFAULT NULL,
  `OK35` text DEFAULT NULL,
  `OK36` text DEFAULT NULL,
  `OK37` text DEFAULT NULL,
  `OK38` text DEFAULT NULL,
  `OK39` text DEFAULT NULL,
  `OK40` text DEFAULT NULL,
  `OK41` text DEFAULT NULL,
  `OK42` text DEFAULT NULL,
  `OK43` text DEFAULT NULL,
  `OK44` text DEFAULT NULL,
  `OK45` text DEFAULT NULL,
  `OK46` text DEFAULT NULL,
  `OK47` text DEFAULT NULL,
  `OK48` text DEFAULT NULL,
  `OK49` text DEFAULT NULL,
  `OK50` text DEFAULT NULL,
  `OK51` text DEFAULT NULL,
  `OK52` text DEFAULT NULL,
  `OK53` text DEFAULT NULL,
  `OK54` text DEFAULT NULL,
  `OK55` text DEFAULT NULL,
  `OK56` text DEFAULT NULL,
  `OK57` text DEFAULT NULL,
  `OK58` text DEFAULT NULL,
  `OK59` text DEFAULT NULL,
  `OK60` text DEFAULT NULL,
  `OK61` text DEFAULT NULL,
  `OK62` text DEFAULT NULL,
  `OK63` text DEFAULT NULL,
  `OK64` text DEFAULT NULL,
  `OK65` text DEFAULT NULL,
  `OK66` text DEFAULT NULL,
  `OK67` text DEFAULT NULL,
  `OK68` text DEFAULT NULL,
  `OK69` text DEFAULT NULL,
  `OK70` text DEFAULT NULL,
  `OK71` text DEFAULT NULL,
  `OK72` text DEFAULT NULL,
  `OK73` text DEFAULT NULL,
  `OK74` text DEFAULT NULL,
  `OK75` text DEFAULT NULL,
  `OK76` text DEFAULT NULL,
  `OK77` text DEFAULT NULL,
  `OK78` text DEFAULT NULL,
  `OK79` text DEFAULT NULL,
  `OK80` text DEFAULT NULL,
  `OK81` text DEFAULT NULL,
  `OK82` text DEFAULT NULL,
  `OK83` text DEFAULT NULL,
  `OK84` text DEFAULT NULL,
  `OK85` text DEFAULT NULL,
  `OK86` text DEFAULT NULL,
  `OK87` text DEFAULT NULL,
  `OK88` text DEFAULT NULL,
  `OK89` text DEFAULT NULL,
  `OK90` text DEFAULT NULL,
  `OK91` text DEFAULT NULL,
  `OK92` text DEFAULT NULL,
  `OK93` text DEFAULT NULL,
  `OK94` text DEFAULT NULL,
  `OK95` text DEFAULT NULL,
  `OK96` text DEFAULT NULL,
  `OK97` text DEFAULT NULL,
  `OK98` text DEFAULT NULL,
  `OK99` text DEFAULT NULL,
  `OK100` text DEFAULT NULL,
  `department` text DEFAULT NULL,
  `exam_mode` text DEFAULT NULL,
  `exam_category` text DEFAULT NULL,
  `course` text DEFAULT NULL,
  `pageno` text DEFAULT NULL,
  `examdate` datetime DEFAULT NULL,
  `exam_type` text DEFAULT NULL,
  `msgstatus` text DEFAULT NULL,
  `starttime` datetime NOT NULL,
  `endtime` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cbt_evaluation1`
--

INSERT INTO `cbt_evaluation1` (`id`, `examstatus`, `studentname`, `correct`, `noofquestion`, `wrong`, `studentno`, `score`, `level`, `session1`, `semester`, `hour`, `minute`, `qstno`, `OK1`, `OK2`, `OK3`, `OK4`, `OK5`, `OK6`, `OK7`, `OK8`, `OK9`, `OK10`, `OK11`, `OK12`, `OK13`, `OK14`, `OK15`, `OK16`, `OK17`, `OK18`, `OK19`, `OK20`, `OK21`, `OK22`, `OK23`, `OK24`, `OK25`, `OK26`, `OK27`, `OK28`, `OK29`, `OK30`, `OK31`, `OK32`, `OK33`, `OK34`, `OK35`, `OK36`, `OK37`, `OK38`, `OK39`, `OK40`, `OK41`, `OK42`, `OK43`, `OK44`, `OK45`, `OK46`, `OK47`, `OK48`, `OK49`, `OK50`, `OK51`, `OK52`, `OK53`, `OK54`, `OK55`, `OK56`, `OK57`, `OK58`, `OK59`, `OK60`, `OK61`, `OK62`, `OK63`, `OK64`, `OK65`, `OK66`, `OK67`, `OK68`, `OK69`, `OK70`, `OK71`, `OK72`, `OK73`, `OK74`, `OK75`, `OK76`, `OK77`, `OK78`, `OK79`, `OK80`, `OK81`, `OK82`, `OK83`, `OK84`, `OK85`, `OK86`, `OK87`, `OK88`, `OK89`, `OK90`, `OK91`, `OK92`, `OK93`, `OK94`, `OK95`, `OK96`, `OK97`, `OK98`, `OK99`, `OK100`, `department`, `exam_mode`, `exam_category`, `course`, `pageno`, `examdate`, `exam_type`, `msgstatus`, `starttime`, `endtime`, `created_at`, `updated_at`) VALUES
(1, NULL, 'OJO YETUNDE BOLUWATIFE', '0', '50', '0', 'CHEW2021053', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, 'B', 'C', 'B', 'C', 'B', 'D', 'D', 'B', 'C', 'A', 'A', 'C', 'B', 'A', 'A', 'D', 'C', 'C', 'C', 'B', 'A', 'B', 'B', 'C', 'A', 'C', 'A', 'D', 'D', 'C', 'C', 'B', 'C', 'D', 'A', 'A', 'C', 'A', 'B', 'C', 'D', 'B', 'B', 'D', 'C', 'A', 'C', 'B', 'C', 'B', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', NULL, '2024-05-30 19:24:02', 'PREPARATORY', '0', '2024-05-30 19:24:02', '2024-05-30 19:24:02', '2024-05-31 02:24:02', '2024-05-31 02:24:02'),
(2, NULL, 'ABDULRASHEED MARYAM EJIDE', '0', '50', '0', 'CHEW2021002', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, 'D', 'D', 'B', 'A', 'B', 'B', 'B', 'C', 'C', 'B', 'B', 'B', 'A', 'C', 'C', 'B', 'C', 'C', 'C', 'C', 'C', 'B', 'C', 'B', 'C', 'B', 'A', 'A', 'A', 'D', 'B', 'D', 'A', 'A', 'C', 'C', 'C', 'C', 'C', 'A', 'A', 'D', 'B', 'D', 'B', 'D', 'C', 'A', 'D', 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', NULL, '2024-05-30 19:24:17', 'PREPARATORY', '0', '2024-05-30 19:24:17', '2024-05-30 19:24:17', '2024-05-31 02:24:17', '2024-05-31 02:24:17'),
(3, NULL, 'JIMOH ROKIBAT ABISOLA', '0', '50', '0', 'CHEW2021042', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, 'C', 'C', 'C', 'C', 'B', 'C', 'A', 'B', 'D', 'D', 'B', 'C', 'A', 'B', 'D', 'C', 'B', 'C', 'B', 'A', 'B', 'A', 'B', 'A', 'B', 'B', 'B', 'A', 'C', 'C', 'D', 'A', 'B', 'C', 'A', 'C', 'D', 'A', 'A', 'B', 'C', 'D', 'C', 'B', 'D', 'C', 'C', 'C', 'D', 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', NULL, '2024-05-30 19:24:20', 'PREPARATORY', '0', '2024-05-30 19:24:20', '2024-05-30 19:24:20', '2024-05-31 02:24:20', '2024-05-31 02:24:20'),
(4, NULL, 'OYEOLA VICTORIA OLUWATOSIN', '0', '50', '0', 'CHEW2021066', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, 'B', 'D', 'B', 'C', 'B', 'A', 'A', 'B', 'C', 'A', 'D', 'B', 'B', 'D', 'C', 'A', 'D', 'A', 'D', 'C', 'B', 'B', 'B', 'C', 'B', 'A', 'B', 'A', 'C', 'C', 'C', 'B', 'A', 'D', 'A', 'A', 'B', 'D', 'C', 'C', 'C', 'C', 'A', 'C', 'C', 'D', 'B', 'C', 'C', 'C', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', NULL, '2024-05-30 19:25:03', 'PREPARATORY', '0', '2024-05-30 19:25:03', '2024-05-30 19:25:03', '2024-05-31 02:25:03', '2024-05-31 02:25:03'),
(5, NULL, 'FOLORUNSO BOLUWATIFE VICTORIA', '0', '50', '0', 'CHEW2021032', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, 'C', 'D', 'A', 'A', 'D', 'B', 'A', 'B', 'A', 'D', 'C', 'B', 'C', 'C', 'C', 'B', 'D', 'D', 'B', 'C', 'A', 'C', 'B', 'A', 'D', 'B', 'C', 'B', 'C', 'B', 'C', 'C', 'B', 'A', 'C', 'D', 'A', 'A', 'A', 'C', 'C', 'D', 'B', 'C', 'B', 'B', 'A', 'C', 'C', 'B', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', NULL, '2024-05-30 19:25:11', 'PREPARATORY', '0', '2024-05-30 19:25:11', '2024-05-30 19:25:11', '2024-05-31 02:25:11', '2024-05-31 02:25:11'),
(6, NULL, 'ADEBAYO ROKIBAT ADUNOLA', '0', '50', '0', 'CHEW2021004', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, 'A', 'A', 'A', 'C', 'A', 'C', 'B', 'B', 'C', 'B', 'B', 'C', 'A', 'C', 'C', 'B', 'B', 'C', 'C', 'C', 'C', 'A', 'B', 'D', 'C', 'D', 'B', 'A', 'D', 'A', 'D', 'A', 'D', 'C', 'B', 'C', 'A', 'B', 'C', 'D', 'C', 'A', 'C', 'B', 'B', 'D', 'D', 'B', 'C', 'B', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', NULL, '2024-05-30 19:25:12', 'PREPARATORY', '0', '2024-05-30 19:25:12', '2024-05-30 19:25:12', '2024-05-31 02:25:12', '2024-05-31 02:25:12'),
(7, NULL, 'TAIWO SELIMOT OLAWUMI', '0', '50', '0', 'CHEW2021075', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, 'C', 'D', 'C', 'C', 'A', 'B', 'C', 'B', 'B', 'A', 'D', 'A', 'C', 'B', 'B', 'A', 'A', 'B', 'C', 'D', 'C', 'C', 'D', 'B', 'D', 'A', 'A', 'C', 'C', 'B', 'B', 'B', 'A', 'C', 'A', 'A', 'B', 'C', 'C', 'B', 'D', 'C', 'A', 'C', 'B', 'B', 'D', 'C', 'D', 'C', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', NULL, '2024-05-30 19:25:21', 'PREPARATORY', '0', '2024-05-30 19:25:21', '2024-05-30 19:25:21', '2024-05-31 02:25:21', '2024-05-31 02:25:21'),
(8, NULL, 'ADEKUNLE GLORY ADEBOLA', '0', '50', '0', 'CHEW2021010', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, 'D', 'B', 'A', 'D', 'C', 'A', 'C', 'C', 'C', 'B', 'B', 'B', 'A', 'A', 'C', 'D', 'C', 'A', 'C', 'C', 'D', 'C', 'C', 'B', 'C', 'B', 'C', 'A', 'B', 'B', 'A', 'D', 'A', 'D', 'B', 'A', 'B', 'A', 'A', 'B', 'B', 'C', 'B', 'D', 'D', 'C', 'C', 'C', 'C', 'B', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', NULL, '2024-05-30 19:26:36', 'PREPARATORY', '0', '2024-05-30 19:26:36', '2024-05-30 19:26:36', '2024-05-31 02:26:36', '2024-05-31 02:26:36'),
(9, NULL, 'IBRAHIM KHADIJAT AJOKE', '0', '50', '0', 'CHEW2021037', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, 'A', 'C', 'D', 'D', 'B', 'B', 'C', 'B', 'A', 'A', 'B', 'D', 'C', 'C', 'C', 'B', 'D', 'A', 'A', 'C', 'C', 'B', 'A', 'A', 'C', 'B', 'C', 'B', 'C', 'A', 'B', 'D', 'A', 'C', 'D', 'B', 'A', 'B', 'B', 'C', 'D', 'C', 'C', 'B', 'C', 'C', 'A', 'C', 'B', 'D', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', NULL, '2024-05-30 19:26:49', 'PREPARATORY', '0', '2024-05-30 19:26:49', '2024-05-30 19:26:49', '2024-05-31 02:26:49', '2024-05-31 02:26:49'),
(10, NULL, 'Opoola Victor Okikijesu', '0', '50', '0', 'CHEW2021065', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, 'D', 'C', 'B', 'C', 'C', 'D', 'C', 'C', 'A', 'A', 'B', 'C', 'B', 'C', 'A', 'B', 'D', 'A', 'B', 'C', 'D', 'C', 'D', 'C', 'A', 'B', 'B', 'A', 'A', 'D', 'D', 'C', 'B', 'C', 'B', 'C', 'C', 'B', 'A', 'B', 'A', 'B', 'C', 'C', 'B', 'C', 'A', 'D', 'B', 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', NULL, '2024-05-30 19:27:16', 'PREPARATORY', '0', '2024-05-30 19:27:16', '2024-05-30 19:27:16', '2024-05-31 02:27:16', '2024-05-31 02:27:16'),
(11, NULL, 'ADEMOLA ZAINAB ABIDEMI', '0', '50', '0', 'CHEW2021011', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, 'A', 'D', 'C', 'B', 'C', 'A', 'D', 'B', 'C', 'A', 'B', 'D', 'C', 'A', 'C', 'C', 'B', 'C', 'B', 'B', 'C', 'A', 'A', 'D', 'C', 'B', 'C', 'B', 'D', 'C', 'B', 'D', 'A', 'C', 'B', 'A', 'C', 'B', 'D', 'B', 'C', 'B', 'C', 'A', 'D', 'C', 'C', 'A', 'B', 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', NULL, '2024-05-30 19:27:27', 'PREPARATORY', '0', '2024-05-30 19:27:27', '2024-05-30 19:27:27', '2024-05-31 02:27:27', '2024-05-31 02:27:27'),
(12, NULL, 'OYERO ADEBIMPE REBECCA', '0', '50', '0', 'CHEW2021067', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, 'B', 'D', 'C', 'A', 'A', 'C', 'C', 'A', 'C', 'C', 'A', 'C', 'C', 'C', 'D', 'A', 'D', 'B', 'C', 'B', 'A', 'C', 'B', 'D', 'C', 'C', 'A', 'B', 'C', 'A', 'B', 'C', 'C', 'B', 'A', 'B', 'D', 'D', 'D', 'B', 'A', 'B', 'B', 'B', 'D', 'B', 'A', 'B', 'C', 'C', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', NULL, '2024-05-30 19:27:50', 'PREPARATORY', '0', '2024-05-30 19:27:50', '2024-05-30 19:27:50', '2024-05-31 02:27:50', '2024-05-31 02:27:50'),
(13, NULL, 'KOLAWOLE BUKOLA MARY', '0', '50', '0', 'CHEW2021046', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, 'C', 'B', 'A', 'C', 'D', 'C', 'A', 'C', 'D', 'D', 'D', 'C', 'B', 'D', 'C', 'C', 'B', 'C', 'A', 'A', 'D', 'B', 'B', 'B', 'D', 'B', 'C', 'B', 'A', 'A', 'C', 'A', 'C', 'A', 'C', 'B', 'C', 'C', 'A', 'C', 'C', 'A', 'D', 'B', 'A', 'B', 'B', 'B', 'B', 'C', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', NULL, '2024-05-30 19:28:02', 'PREPARATORY', '0', '2024-05-30 19:28:02', '2024-05-30 19:28:02', '2024-05-31 02:28:02', '2024-05-31 02:28:02'),
(14, NULL, 'TAIWO OREOLUWA DEBORAH', '0', '50', '0', 'CHEW2021076', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, 'B', 'A', 'B', 'C', 'C', 'B', 'A', 'C', 'D', 'B', 'D', 'B', 'D', 'C', 'A', 'C', 'B', 'D', 'C', 'D', 'C', 'A', 'B', 'C', 'B', 'A', 'A', 'B', 'D', 'C', 'C', 'A', 'B', 'C', 'B', 'C', 'B', 'B', 'D', 'C', 'A', 'C', 'D', 'C', 'A', 'A', 'A', 'C', 'B', 'C', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', NULL, '2024-05-30 19:28:10', 'PREPARATORY', '0', '2024-05-30 19:28:10', '2024-05-30 19:28:10', '2024-05-31 02:28:10', '2024-05-31 02:28:10'),
(15, NULL, 'ADENIYI OLUWAKEMI OPEYEMI', '0', '50', '0', 'CHEW2021012', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, 'D', 'A', 'B', 'B', 'D', 'A', 'A', 'C', 'C', 'C', 'A', 'C', 'B', 'A', 'C', 'B', 'C', 'C', 'C', 'C', 'B', 'A', 'B', 'B', 'B', 'A', 'A', 'A', 'C', 'C', 'A', 'B', 'A', 'D', 'D', 'B', 'D', 'D', 'B', 'D', 'C', 'B', 'B', 'D', 'C', 'C', 'B', 'C', 'C', 'C', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', NULL, '2024-05-30 19:28:34', 'PREPARATORY', '0', '2024-05-30 19:28:34', '2024-05-30 19:28:34', '2024-05-31 02:28:34', '2024-05-31 02:28:34'),
(16, NULL, 'OGUNTADE JULIHANNAH TEMITOPE', '0', '50', '0', 'CHEW2021051', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, 'B', 'C', 'C', 'B', 'B', 'B', 'D', 'B', 'B', 'C', 'D', 'B', 'C', 'B', 'B', 'A', 'A', 'B', 'D', 'C', 'B', 'C', 'C', 'A', 'D', 'C', 'D', 'C', 'C', 'B', 'C', 'D', 'B', 'A', 'A', 'A', 'D', 'B', 'A', 'A', 'C', 'C', 'C', 'A', 'A', 'C', 'A', 'D', 'C', 'C', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', NULL, '2024-05-30 19:28:41', 'PREPARATORY', '0', '2024-05-30 19:28:41', '2024-05-30 19:28:41', '2024-05-31 02:28:41', '2024-05-31 02:28:41'),
(17, NULL, 'KAMORUDEEN AISHAT YETUNDE', '0', '50', '0', 'CHEW2021044', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, 'A', 'A', 'D', 'C', 'C', 'C', 'B', 'B', 'D', 'C', 'A', 'A', 'A', 'C', 'A', 'D', 'B', 'C', 'B', 'D', 'C', 'A', 'A', 'B', 'C', 'B', 'D', 'C', 'C', 'A', 'B', 'B', 'C', 'D', 'B', 'C', 'C', 'D', 'B', 'B', 'A', 'B', 'C', 'A', 'B', 'D', 'B', 'C', 'C', 'C', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', NULL, '2024-05-30 19:28:57', 'PREPARATORY', '0', '2024-05-30 19:28:57', '2024-05-30 19:28:57', '2024-05-31 02:28:57', '2024-05-31 02:28:57'),
(18, NULL, 'HAMZAT WASILAT OKIKIOLA', '0', '50', '0', 'CHEW2021035', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, 'D', 'C', 'C', 'B', 'D', 'A', 'C', 'C', 'C', 'B', 'D', 'C', 'B', 'A', 'B', 'B', 'C', 'A', 'A', 'B', 'A', 'C', 'C', 'C', 'B', 'C', 'C', 'D', 'B', 'A', 'B', 'C', 'A', 'C', 'B', 'D', 'A', 'A', 'C', 'B', 'D', 'A', 'B', 'D', 'C', 'C', 'D', 'A', 'B', 'B', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', NULL, '2024-05-30 19:29:03', 'PREPARATORY', '0', '2024-05-30 19:29:03', '2024-05-30 19:29:03', '2024-05-31 02:29:03', '2024-05-31 02:29:03'),
(19, NULL, 'ADEROJU ROFIAT OMOTOLA', '0', '50', '0', 'CHEW2021014', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, 'B', 'C', 'D', 'D', 'B', 'B', 'B', 'A', 'A', 'B', 'C', 'A', 'B', 'C', 'D', 'C', 'A', 'B', 'A', 'C', 'B', 'A', 'A', 'D', 'B', 'D', 'C', 'A', 'C', 'A', 'B', 'D', 'C', 'C', 'D', 'B', 'C', 'C', 'B', 'C', 'C', 'C', 'A', 'C', 'A', 'B', 'C', 'B', 'C', 'D', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', NULL, '2024-05-30 19:29:18', 'PREPARATORY', '0', '2024-05-30 19:29:18', '2024-05-30 19:29:18', '2024-05-31 02:29:18', '2024-05-31 02:29:18'),
(20, NULL, 'ADESOLA LYDIA ADEDAPO', '0', '50', '0', 'CHEW2021015', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, 'B', 'D', 'C', 'A', 'A', 'B', 'C', 'C', 'C', 'C', 'A', 'C', 'C', 'A', 'C', 'C', 'A', 'A', 'B', 'A', 'C', 'B', 'B', 'B', 'C', 'B', 'A', 'D', 'C', 'D', 'A', 'C', 'D', 'D', 'C', 'B', 'A', 'D', 'C', 'B', 'B', 'D', 'D', 'B', 'B', 'B', 'C', 'C', 'A', 'B', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', NULL, '2024-05-30 19:29:20', 'PREPARATORY', '0', '2024-05-30 19:29:20', '2024-05-30 19:29:20', '2024-05-31 02:29:20', '2024-05-31 02:29:20'),
(21, NULL, 'ISIAQ FAOSIYAT BIODUN', '0', '50', '0', 'CHEW2021041', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, 'A', 'C', 'B', 'A', 'B', 'B', 'D', 'B', 'A', 'B', 'D', 'D', 'C', 'A', 'B', 'D', 'B', 'A', 'C', 'A', 'D', 'A', 'C', 'C', 'A', 'C', 'C', 'B', 'C', 'A', 'C', 'C', 'C', 'C', 'A', 'C', 'B', 'B', 'B', 'D', 'C', 'B', 'C', 'D', 'B', 'A', 'C', 'B', 'D', 'C', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', NULL, '2024-05-30 19:29:50', 'PREPARATORY', '0', '2024-05-30 19:29:50', '2024-05-30 19:29:50', '2024-05-31 02:29:50', '2024-05-31 02:29:50'),
(22, NULL, 'AKINWUMI OMOSHALEWA AWAWU', '0', '50', '0', 'CHEW2021020', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, 'A', 'D', 'B', 'C', 'C', 'C', 'A', 'D', 'A', 'B', 'B', 'D', 'B', 'B', 'D', 'C', 'D', 'C', 'C', 'B', 'A', 'C', 'D', 'C', 'A', 'B', 'C', 'A', 'B', 'D', 'B', 'C', 'A', 'C', 'C', 'B', 'C', 'D', 'C', 'B', 'A', 'B', 'A', 'C', 'B', 'B', 'A', 'C', 'A', 'C', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', NULL, '2024-05-30 19:30:02', 'PREPARATORY', '0', '2024-05-30 19:30:02', '2024-05-30 19:30:02', '2024-05-31 02:30:02', '2024-05-31 02:30:02'),
(23, NULL, 'ONIOSUN DEBORAH OLUWAMAYOKUN', '0', '50', '0', 'CHEW2021064', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, 'D', 'B', 'A', 'B', 'A', 'B', 'B', 'B', 'A', 'A', 'D', 'C', 'B', 'B', 'B', 'A', 'C', 'B', 'C', 'C', 'B', 'C', 'D', 'A', 'D', 'C', 'C', 'D', 'A', 'C', 'B', 'B', 'C', 'A', 'C', 'A', 'C', 'B', 'C', 'C', 'C', 'C', 'D', 'A', 'D', 'B', 'D', 'C', 'C', 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', NULL, '2024-05-30 19:30:46', 'PREPARATORY', '0', '2024-05-30 19:30:46', '2024-05-30 19:30:46', '2024-05-31 02:30:46', '2024-05-31 02:30:46'),
(24, NULL, 'AYUBA MORENIKE ROKIBA', '0', '50', '0', 'CHEW2021025', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, 'C', 'B', 'D', 'B', 'B', 'C', 'D', 'D', 'D', 'B', 'C', 'B', 'C', 'A', 'A', 'A', 'D', 'C', 'D', 'C', 'C', 'C', 'A', 'C', 'C', 'C', 'D', 'B', 'C', 'B', 'C', 'B', 'B', 'A', 'C', 'B', 'B', 'A', 'C', 'A', 'C', 'B', 'A', 'B', 'A', 'A', 'D', 'C', 'A', 'B', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', NULL, '2024-05-30 19:31:14', 'PREPARATORY', '0', '2024-05-30 19:31:14', '2024-05-30 19:31:14', '2024-05-31 02:31:14', '2024-05-31 02:31:15'),
(25, NULL, 'ABDULMALIK NAMEEROH ADERONKE', '0', '50', '0', 'CHEW2021001', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, 'B', 'A', 'C', 'B', 'B', 'C', 'C', 'D', 'C', 'C', 'D', 'A', 'B', 'B', 'A', 'C', 'A', 'D', 'A', 'A', 'C', 'A', 'D', 'C', 'D', 'C', 'C', 'A', 'C', 'C', 'A', 'C', 'B', 'C', 'C', 'C', 'B', 'B', 'A', 'B', 'B', 'C', 'D', 'D', 'B', 'B', 'B', 'D', 'A', 'B', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', NULL, '2024-05-30 19:31:17', 'PREPARATORY', '0', '2024-05-30 19:31:17', '2024-05-30 19:31:17', '2024-05-31 02:31:17', '2024-05-31 02:31:17'),
(26, NULL, 'Oladunni Yewande Bukola', '0', '50', '0', 'CHEW2021056', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, 'B', 'A', 'D', 'B', 'B', 'D', 'A', 'C', 'B', 'D', 'B', 'C', 'C', 'B', 'A', 'A', 'B', 'C', 'C', 'D', 'A', 'A', 'C', 'C', 'B', 'C', 'B', 'A', 'C', 'C', 'D', 'A', 'C', 'D', 'B', 'D', 'C', 'B', 'A', 'B', 'D', 'C', 'C', 'C', 'A', 'A', 'B', 'B', 'C', 'C', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', NULL, '2024-05-30 19:31:40', 'PREPARATORY', '0', '2024-05-30 19:31:40', '2024-05-30 19:31:40', '2024-05-31 02:31:40', '2024-05-31 02:31:40'),
(27, NULL, 'BASHIRU AMINAT OYINLOLA', '0', '50', '0', 'CHEW2021027', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, 'C', 'C', 'C', 'B', 'D', 'C', 'A', 'B', 'B', 'C', 'B', 'D', 'D', 'B', 'C', 'C', 'B', 'C', 'A', 'B', 'B', 'B', 'C', 'D', 'A', 'A', 'C', 'C', 'D', 'C', 'C', 'D', 'A', 'C', 'A', 'B', 'B', 'A', 'C', 'B', 'A', 'C', 'C', 'B', 'B', 'D', 'A', 'D', 'A', 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', NULL, '2024-05-30 19:31:42', 'PREPARATORY', '0', '2024-05-30 19:31:42', '2024-05-30 19:31:42', '2024-05-31 02:31:42', '2024-05-31 02:31:42'),
(28, NULL, 'BOLAJI DAMILOLA GRACE', '0', '50', '0', 'CHEW2021028', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, 'B', 'A', 'D', 'C', 'C', 'C', 'B', 'D', 'A', 'A', 'C', 'A', 'B', 'B', 'C', 'A', 'B', 'B', 'D', 'C', 'B', 'A', 'C', 'B', 'A', 'D', 'A', 'B', 'C', 'C', 'B', 'D', 'D', 'B', 'B', 'A', 'D', 'C', 'C', 'C', 'C', 'B', 'C', 'B', 'C', 'C', 'C', 'A', 'D', 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', NULL, '2024-05-30 19:32:27', 'PREPARATORY', '0', '2024-05-30 19:32:27', '2024-05-30 19:32:27', '2024-05-31 02:32:27', '2024-05-31 02:32:27'),
(29, NULL, 'JOHN SHALOM KEMI', '0', '50', '0', 'CHEW2021043', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, 'C', 'A', 'B', 'C', 'A', 'A', 'C', 'A', 'B', 'B', 'B', 'C', 'C', 'A', 'A', 'B', 'A', 'C', 'D', 'B', 'B', 'C', 'D', 'B', 'A', 'C', 'C', 'D', 'B', 'C', 'C', 'A', 'B', 'C', 'A', 'C', 'C', 'D', 'C', 'B', 'B', 'A', 'C', 'C', 'D', 'D', 'D', 'B', 'D', 'B', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', NULL, '2024-05-30 19:33:03', 'PREPARATORY', '0', '2024-05-30 19:33:03', '2024-05-30 19:33:03', '2024-05-31 02:33:03', '2024-05-31 02:33:03'),
(30, NULL, 'OLAYIWOLA KABIRAT OMOWUNMI', '0', '50', '0', 'CHEW2021060', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, 'C', 'D', 'C', 'B', 'D', 'B', 'C', 'A', 'B', 'B', 'C', 'C', 'B', 'D', 'D', 'C', 'C', 'C', 'C', 'A', 'C', 'B', 'B', 'B', 'C', 'B', 'A', 'A', 'A', 'B', 'A', 'D', 'C', 'B', 'A', 'C', 'A', 'D', 'C', 'C', 'B', 'C', 'B', 'C', 'A', 'D', 'D', 'B', 'A', 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', NULL, '2024-05-30 19:33:33', 'PREPARATORY', '0', '2024-05-30 19:33:33', '2024-05-30 19:33:33', '2024-05-31 02:33:33', '2024-05-31 02:33:33'),
(31, NULL, 'ADENIYI KAOSARA WURAOLA', '0', '50', '0', 'CHEW2021013', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, 'A', 'B', 'A', 'C', 'C', 'B', 'A', 'C', 'B', 'B', 'C', 'B', 'D', 'C', 'B', 'B', 'D', 'D', 'C', 'B', 'D', 'C', 'C', 'C', 'C', 'C', 'A', 'C', 'A', 'A', 'B', 'D', 'A', 'B', 'D', 'B', 'D', 'A', 'C', 'A', 'A', 'C', 'C', 'C', 'A', 'D', 'C', 'B', 'B', 'B', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', NULL, '2024-05-30 19:33:34', 'PREPARATORY', '0', '2024-05-30 19:33:34', '2024-05-30 19:33:34', '2024-05-31 02:33:34', '2024-05-31 02:33:34'),
(32, NULL, 'IBRAHIM FATIU ', '0', '50', '0', 'CHEW2021038', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, 'D', 'C', 'B', 'D', 'B', 'D', 'A', 'D', 'A', 'B', 'C', 'C', 'B', 'A', 'A', 'C', 'C', 'B', 'C', 'A', 'D', 'B', 'C', 'C', 'C', 'B', 'B', 'C', 'C', 'C', 'A', 'B', 'D', 'A', 'C', 'C', 'A', 'C', 'D', 'B', 'C', 'B', 'D', 'B', 'B', 'A', 'A', 'C', 'B', 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', NULL, '2024-05-30 19:33:36', 'PREPARATORY', '0', '2024-05-30 19:33:36', '2024-05-30 19:33:36', '2024-05-31 02:33:36', '2024-05-31 02:33:36'),
(33, NULL, 'OLADIPUPO ESTHER OLAIDE', '0', '50', '0', 'CHEW2021055', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, 'C', 'B', 'C', 'C', 'A', 'D', 'C', 'A', 'A', 'C', 'D', 'B', 'B', 'C', 'A', 'A', 'A', 'B', 'B', 'A', 'A', 'C', 'A', 'D', 'D', 'C', 'B', 'C', 'C', 'B', 'C', 'B', 'D', 'B', 'C', 'A', 'C', 'C', 'D', 'B', 'C', 'A', 'B', 'D', 'B', 'C', 'B', 'C', 'D', 'B', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', NULL, '2024-05-30 19:34:42', 'PREPARATORY', '0', '2024-05-30 19:34:42', '2024-05-30 19:34:42', '2024-05-31 02:34:42', '2024-05-31 02:34:42'),
(34, NULL, 'ROTIMI VICTORIA IDOWU', '0', '50', '0', 'CHEW2021070', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, 'C', 'A', 'D', 'A', 'A', 'C', 'B', 'C', 'A', 'B', 'D', 'C', 'C', 'C', 'D', 'B', 'B', 'C', 'B', 'C', 'A', 'D', 'B', 'C', 'A', 'B', 'B', 'B', 'B', 'C', 'A', 'A', 'D', 'C', 'B', 'A', 'C', 'C', 'B', 'A', 'D', 'B', 'A', 'C', 'D', 'C', 'D', 'B', 'C', 'C', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', NULL, '2024-05-30 19:35:58', 'PREPARATORY', '0', '2024-05-30 19:35:58', '2024-05-30 19:35:58', '2024-05-31 02:35:58', '2024-05-31 02:35:58'),
(35, NULL, 'ADARAMOLA TAIWO ANUOLUWAPO', '0', '50', '0', 'CHEW2021003', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, 'B', 'D', 'B', 'B', 'C', 'A', 'D', 'A', 'B', 'C', 'C', 'C', 'B', 'C', 'B', 'B', 'B', 'D', 'B', 'A', 'A', 'B', 'C', 'A', 'C', 'D', 'D', 'B', 'A', 'C', 'C', 'B', 'D', 'D', 'B', 'C', 'C', 'A', 'A', 'C', 'C', 'C', 'B', 'A', 'D', 'A', 'C', 'A', 'C', 'C', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', NULL, '2024-05-30 19:36:28', 'PREPARATORY', '0', '2024-05-30 19:36:28', '2024-05-30 19:36:28', '2024-05-31 02:36:28', '2024-05-31 02:36:28'),
(36, NULL, 'ADETOUN RANTI DORCAS', '0', '50', '0', 'CHEW2021016', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, 'B', 'B', 'A', 'B', 'B', 'A', 'C', 'C', 'C', 'C', 'C', 'B', 'A', 'B', 'D', 'A', 'A', 'D', 'B', 'B', 'B', 'D', 'A', 'B', 'D', 'C', 'A', 'D', 'A', 'C', 'C', 'B', 'C', 'D', 'A', 'A', 'D', 'C', 'D', 'C', 'A', 'C', 'C', 'B', 'C', 'C', 'B', 'B', 'C', 'C', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', NULL, '2024-05-30 19:37:23', 'PREPARATORY', '0', '2024-05-30 19:37:23', '2024-05-30 19:37:23', '2024-05-31 02:37:23', '2024-05-31 02:37:23'),
(37, NULL, 'AZEEZ KHADIJAH ABIKE', '0', '50', '0', 'CHEW2021105', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, 'C', 'D', 'C', 'B', 'A', 'A', 'C', 'A', 'A', 'A', 'C', 'B', 'C', 'B', 'C', 'A', 'C', 'B', 'C', 'C', 'C', 'B', 'B', 'B', 'C', 'C', 'C', 'D', 'A', 'B', 'D', 'B', 'A', 'B', 'D', 'B', 'B', 'D', 'C', 'A', 'C', 'A', 'B', 'D', 'C', 'D', 'A', 'C', 'B', 'D', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', NULL, '2024-05-30 19:37:24', 'PREPARATORY', '0', '2024-05-30 19:37:24', '2024-05-30 19:37:24', '2024-05-31 02:37:24', '2024-05-31 02:37:24'),
(38, NULL, 'SALAUDEEN KERIMOT OPEYEMI', '0', '50', '0', 'CHEW2021071', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, 'B', 'B', 'C', 'B', 'C', 'A', 'C', 'D', 'A', 'D', 'D', 'B', 'C', 'D', 'C', 'B', 'A', 'A', 'A', 'D', 'A', 'C', 'A', 'D', 'B', 'B', 'B', 'C', 'A', 'C', 'C', 'B', 'B', 'C', 'A', 'C', 'A', 'B', 'C', 'C', 'B', 'A', 'C', 'B', 'D', 'D', 'C', 'C', 'B', 'C', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', NULL, '2024-05-30 19:37:54', 'PREPARATORY', '0', '2024-05-30 19:37:54', '2024-05-30 19:37:54', '2024-05-31 02:37:54', '2024-05-31 02:37:54'),
(39, NULL, 'OLAWALE ODUNOLA SELIMOT', '0', '50', '0', 'CHEW2021058', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, 'D', 'C', 'B', 'B', 'B', 'B', 'A', 'C', 'A', 'C', 'C', 'D', 'C', 'A', 'D', 'B', 'C', 'A', 'C', 'A', 'B', 'B', 'D', 'A', 'B', 'B', 'D', 'C', 'A', 'C', 'A', 'A', 'B', 'B', 'C', 'C', 'B', 'C', 'D', 'B', 'D', 'C', 'C', 'C', 'C', 'A', 'B', 'C', 'D', 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', NULL, '2024-05-30 19:38:49', 'PREPARATORY', '0', '2024-05-30 19:38:49', '2024-05-30 19:38:49', '2024-05-31 02:38:49', '2024-05-31 02:38:49'),
(40, NULL, 'QOMORUDEEN MUTIYAT TOLANI', '0', '50', '0', 'CHEW2021069', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, 'C', 'C', 'A', 'C', 'C', 'D', 'B', 'D', 'C', 'A', 'B', 'D', 'C', 'B', 'B', 'C', 'B', 'B', 'D', 'D', 'C', 'B', 'A', 'D', 'A', 'D', 'B', 'A', 'C', 'A', 'A', 'A', 'C', 'A', 'C', 'C', 'B', 'C', 'A', 'B', 'B', 'D', 'C', 'C', 'C', 'B', 'B', 'A', 'B', 'C', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', NULL, '2024-05-30 19:39:39', 'PREPARATORY', '0', '2024-05-30 19:39:39', '2024-05-30 19:39:39', '2024-05-31 02:39:39', '2024-05-31 02:39:39');

-- --------------------------------------------------------

--
-- Table structure for table `cbt_evaluation2`
--

CREATE TABLE `cbt_evaluation2` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `examstatus` text DEFAULT NULL,
  `studentname` text DEFAULT NULL,
  `correct` text DEFAULT NULL,
  `noofquestion` text DEFAULT NULL,
  `wrong` text DEFAULT NULL,
  `studentno` text DEFAULT NULL,
  `score` text DEFAULT NULL,
  `level` text DEFAULT NULL,
  `session1` text DEFAULT NULL,
  `semester` text DEFAULT NULL,
  `hour` int(11) DEFAULT NULL,
  `minute` int(11) DEFAULT NULL,
  `qstno` text DEFAULT NULL,
  `OK1` text DEFAULT NULL,
  `OK2` text DEFAULT NULL,
  `OK3` text DEFAULT NULL,
  `OK4` text DEFAULT NULL,
  `OK5` text DEFAULT NULL,
  `OK6` text DEFAULT NULL,
  `OK7` text DEFAULT NULL,
  `OK8` text DEFAULT NULL,
  `OK9` text DEFAULT NULL,
  `OK10` text DEFAULT NULL,
  `OK11` text DEFAULT NULL,
  `OK12` text DEFAULT NULL,
  `OK13` text DEFAULT NULL,
  `OK14` text DEFAULT NULL,
  `OK15` text DEFAULT NULL,
  `OK16` text DEFAULT NULL,
  `OK17` text DEFAULT NULL,
  `OK18` text DEFAULT NULL,
  `OK19` text DEFAULT NULL,
  `OK20` text DEFAULT NULL,
  `OK21` text DEFAULT NULL,
  `OK22` text DEFAULT NULL,
  `OK23` text DEFAULT NULL,
  `OK24` text DEFAULT NULL,
  `OK25` text DEFAULT NULL,
  `OK26` text DEFAULT NULL,
  `OK27` text DEFAULT NULL,
  `OK28` text DEFAULT NULL,
  `OK29` text DEFAULT NULL,
  `OK30` text DEFAULT NULL,
  `OK31` text DEFAULT NULL,
  `OK32` text DEFAULT NULL,
  `OK33` text DEFAULT NULL,
  `OK34` text DEFAULT NULL,
  `OK35` text DEFAULT NULL,
  `OK36` text DEFAULT NULL,
  `OK37` text DEFAULT NULL,
  `OK38` text DEFAULT NULL,
  `OK39` text DEFAULT NULL,
  `OK40` text DEFAULT NULL,
  `OK41` text DEFAULT NULL,
  `OK42` text DEFAULT NULL,
  `OK43` text DEFAULT NULL,
  `OK44` text DEFAULT NULL,
  `OK45` text DEFAULT NULL,
  `OK46` text DEFAULT NULL,
  `OK47` text DEFAULT NULL,
  `OK48` text DEFAULT NULL,
  `OK49` text DEFAULT NULL,
  `OK50` text DEFAULT NULL,
  `OK51` text DEFAULT NULL,
  `OK52` text DEFAULT NULL,
  `OK53` text DEFAULT NULL,
  `OK54` text DEFAULT NULL,
  `OK55` text DEFAULT NULL,
  `OK56` text DEFAULT NULL,
  `OK57` text DEFAULT NULL,
  `OK58` text DEFAULT NULL,
  `OK59` text DEFAULT NULL,
  `OK60` text DEFAULT NULL,
  `OK61` text DEFAULT NULL,
  `OK62` text DEFAULT NULL,
  `OK63` text DEFAULT NULL,
  `OK64` text DEFAULT NULL,
  `OK65` text DEFAULT NULL,
  `OK66` text DEFAULT NULL,
  `OK67` text DEFAULT NULL,
  `OK68` text DEFAULT NULL,
  `OK69` text DEFAULT NULL,
  `OK70` text DEFAULT NULL,
  `OK71` text DEFAULT NULL,
  `OK72` text DEFAULT NULL,
  `OK73` text DEFAULT NULL,
  `OK74` text DEFAULT NULL,
  `OK75` text DEFAULT NULL,
  `OK76` text DEFAULT NULL,
  `OK77` text DEFAULT NULL,
  `OK78` text DEFAULT NULL,
  `OK79` text DEFAULT NULL,
  `OK80` text DEFAULT NULL,
  `OK81` text DEFAULT NULL,
  `OK82` text DEFAULT NULL,
  `OK83` text DEFAULT NULL,
  `OK84` text DEFAULT NULL,
  `OK85` text DEFAULT NULL,
  `OK86` text DEFAULT NULL,
  `OK87` text DEFAULT NULL,
  `OK88` text DEFAULT NULL,
  `OK89` text DEFAULT NULL,
  `OK90` text DEFAULT NULL,
  `OK91` text DEFAULT NULL,
  `OK92` text DEFAULT NULL,
  `OK93` text DEFAULT NULL,
  `OK94` text DEFAULT NULL,
  `OK95` text DEFAULT NULL,
  `OK96` text DEFAULT NULL,
  `OK97` text DEFAULT NULL,
  `OK98` text DEFAULT NULL,
  `OK99` text DEFAULT NULL,
  `OK100` text DEFAULT NULL,
  `department` text DEFAULT NULL,
  `exam_mode` text DEFAULT NULL,
  `exam_category` text DEFAULT NULL,
  `course` text DEFAULT NULL,
  `pageno` text DEFAULT NULL,
  `examdate` datetime DEFAULT NULL,
  `exam_type` text DEFAULT NULL,
  `msgstatus` text DEFAULT NULL,
  `starttime` datetime NOT NULL,
  `endtime` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cbt_evaluation2`
--

INSERT INTO `cbt_evaluation2` (`id`, `examstatus`, `studentname`, `correct`, `noofquestion`, `wrong`, `studentno`, `score`, `level`, `session1`, `semester`, `hour`, `minute`, `qstno`, `OK1`, `OK2`, `OK3`, `OK4`, `OK5`, `OK6`, `OK7`, `OK8`, `OK9`, `OK10`, `OK11`, `OK12`, `OK13`, `OK14`, `OK15`, `OK16`, `OK17`, `OK18`, `OK19`, `OK20`, `OK21`, `OK22`, `OK23`, `OK24`, `OK25`, `OK26`, `OK27`, `OK28`, `OK29`, `OK30`, `OK31`, `OK32`, `OK33`, `OK34`, `OK35`, `OK36`, `OK37`, `OK38`, `OK39`, `OK40`, `OK41`, `OK42`, `OK43`, `OK44`, `OK45`, `OK46`, `OK47`, `OK48`, `OK49`, `OK50`, `OK51`, `OK52`, `OK53`, `OK54`, `OK55`, `OK56`, `OK57`, `OK58`, `OK59`, `OK60`, `OK61`, `OK62`, `OK63`, `OK64`, `OK65`, `OK66`, `OK67`, `OK68`, `OK69`, `OK70`, `OK71`, `OK72`, `OK73`, `OK74`, `OK75`, `OK76`, `OK77`, `OK78`, `OK79`, `OK80`, `OK81`, `OK82`, `OK83`, `OK84`, `OK85`, `OK86`, `OK87`, `OK88`, `OK89`, `OK90`, `OK91`, `OK92`, `OK93`, `OK94`, `OK95`, `OK96`, `OK97`, `OK98`, `OK99`, `OK100`, `department`, `exam_mode`, `exam_category`, `course`, `pageno`, `examdate`, `exam_type`, `msgstatus`, `starttime`, `endtime`, `created_at`, `updated_at`) VALUES
(1, NULL, 'OJO YETUNDE BOLUWATIFE', '0', '50', '0', 'CHEW2021053', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, 'B', 'C', 'C', 'C', 'B', 'B', 'B', 'D', 'A', 'D', 'A', 'B', 'B', 'C', 'D', 'B', 'A', 'B', 'C', 'D', 'B', 'B', 'A', 'B', 'A', 'C', 'B', 'C', 'A', 'C', 'B', 'B', 'D', 'D', 'D', 'D', 'C', 'A', 'A', 'B', 'B', 'B', 'B', 'B', 'C', 'A', 'C', 'B', 'B', 'B', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', '1', '2024-05-30 19:24:02', 'PREPARATORY', '0', '2024-05-30 19:24:02', '2024-05-30 19:24:02', '2024-05-31 02:24:02', '2024-05-31 02:41:59'),
(2, NULL, 'ABDULRASHEED MARYAM EJIDE', '0', '50', '0', 'CHEW2021002', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, 'B', 'D', 'C', 'B', 'C', 'B', 'B', 'D', 'C', 'B', 'B', 'B', 'D', 'B', 'C', 'A', 'D', 'C', 'C', 'B', 'B', 'B', 'B', 'B', 'C', 'B', 'D', 'D', 'B', 'A', 'C', 'B', 'C', 'A', 'B', 'C', 'C', 'D', 'D', 'B', 'B', 'D', 'D', 'D', 'C', 'B', 'C', 'C', 'D', 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', '1', '2024-05-30 19:24:17', 'PREPARATORY', '0', '2024-05-30 19:24:17', '2024-05-30 19:24:17', '2024-05-31 02:24:17', '2024-05-31 02:37:38'),
(3, NULL, 'JIMOH ROKIBAT ABISOLA', '0', '50', '0', 'CHEW2021042', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, 'B', 'C', 'C', 'B', 'B', 'D', 'B', 'B', 'D', 'C', 'B', 'D', 'A', 'B', 'B', 'A', 'B', 'B', 'B', 'D', 'B', 'B', 'B', 'B', 'B', 'B', 'B', 'C', 'B', 'D', 'D', 'B', 'B', 'B', 'B', 'A', 'C', 'C', 'A', 'B', 'A', 'B', 'C', 'C', 'C', 'B', 'C', 'C', 'C', 'C', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', '1', '2024-05-30 19:24:20', 'PREPARATORY', '0', '2024-05-30 19:24:20', '2024-05-30 19:24:20', '2024-05-31 02:24:20', '2024-05-31 02:35:37'),
(4, NULL, 'OYEOLA VICTORIA OLUWATOSIN', '0', '50', '0', 'CHEW2021066', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, 'B', 'C', 'B', 'C', 'B', 'B', 'B', 'A', 'B', 'B', 'B', 'C', 'B', 'C', 'B', 'C', 'C', 'B', 'B', 'B', 'A', 'C', 'D', 'B', 'C', 'A', 'B', 'C', 'A', 'B', 'C', 'B', 'A', 'C', 'B', 'C', 'B', 'A', 'B', 'B', 'A', 'D', 'D', 'B', 'C', 'B', 'A', 'B', 'B', 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', '1', '2024-05-30 19:25:03', 'PREPARATORY', '0', '2024-05-30 19:25:03', '2024-05-30 19:25:03', '2024-05-31 02:25:03', '2024-05-31 02:38:05'),
(5, NULL, 'FOLORUNSO BOLUWATIFE VICTORIA', '0', '50', '0', 'CHEW2021032', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, 'D', 'A', 'C', 'B', 'D', 'A', 'B', 'D', 'B', 'C', 'D', 'B', 'A', 'D', 'C', 'C', 'B', 'A', 'D', 'C', 'C', 'B', 'B', 'D', 'A', 'B', 'A', 'D', 'B', 'B', 'C', 'B', 'C', 'A', 'B', 'D', 'A', 'D', 'B', 'C', 'B', 'D', 'A', 'D', 'B', 'D', 'A', 'B', 'D', 'D', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', '1', '2024-05-30 19:25:11', 'PREPARATORY', '0', '2024-05-30 19:25:11', '2024-05-30 19:25:11', '2024-05-31 02:25:11', '2024-05-31 02:32:00'),
(6, NULL, 'ADEBAYO ROKIBAT ADUNOLA', '0', '50', '0', 'CHEW2021004', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, 'A', 'B', 'D', 'D', 'B', 'A', 'C', 'D', 'C', 'B', 'B', 'A', 'B', 'B', 'D', 'B', 'A', 'A', 'C', 'C', 'A', 'A', 'D', 'C', 'C', 'C', 'A', 'A', 'B', 'A', 'A', 'B', 'C', 'A', 'B', 'C', 'B', 'C', 'A', 'C', 'B', 'B', 'B', 'C', 'C', 'A', 'B', 'B', 'C', 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', '1', '2024-05-30 19:25:12', 'PREPARATORY', '0', '2024-05-30 19:25:12', '2024-05-30 19:25:12', '2024-05-31 02:25:12', '2024-05-31 02:37:58'),
(7, NULL, 'TAIWO SELIMOT OLAWUMI', '0', '50', '0', 'CHEW2021075', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, 'C', 'D', 'B', 'C', 'C', 'B', 'C', 'B', 'B', 'C', 'B', 'B', 'C', 'C', 'B', 'C', 'C', 'A', 'A', 'D', 'C', 'B', 'D', 'B', 'B', 'B', 'D', 'B', 'A', 'C', 'B', 'B', 'C', 'C', 'A', 'A', 'D', 'B', 'C', 'B', 'A', 'C', 'B', 'C', 'B', 'B', 'A', 'C', 'C', 'C', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', '1', '2024-05-30 19:25:21', 'PREPARATORY', '0', '2024-05-30 19:25:21', '2024-05-30 19:25:21', '2024-05-31 02:25:21', '2024-05-31 02:43:50'),
(8, NULL, 'ADEKUNLE GLORY ADEBOLA', '0', '50', '0', 'CHEW2021010', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, 'A', 'B', 'B', 'A', 'B', 'B', 'B', 'B', 'D', 'D', 'B', 'B', 'A', 'D', 'C', 'A', 'C', 'C', 'B', 'B', 'D', 'A', 'C', 'C', 'C', 'B', 'B', 'C', 'B', 'B', 'A', 'A', 'A', 'C', 'D', 'C', 'A', 'A', 'B', 'D', 'D', 'B', 'D', 'C', 'D', 'B', 'C', 'D', 'A', 'B', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', '1', '2024-05-30 19:26:36', 'PREPARATORY', '0', '2024-05-30 19:26:36', '2024-05-30 19:26:36', '2024-05-31 02:26:36', '2024-05-31 02:47:38'),
(9, NULL, 'IBRAHIM KHADIJAT AJOKE', '0', '50', '0', 'CHEW2021037', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, 'A', 'B', 'C', 'B', 'B', 'B', 'B', 'B', 'B', 'A', 'B', 'C', 'B', 'D', 'D', 'B', 'B', 'A', 'C', 'A', 'B', 'B', 'C', 'B', 'C', 'A', 'C', 'B', 'A', 'B', 'A', 'B', '', '', 'C', 'A', 'C', 'B', 'D', 'C', 'D', 'C', '', '', '', 'B', 'D', 'C', 'D', 'D', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', '1', '2024-05-30 19:26:49', 'PREPARATORY', '0', '2024-05-30 19:26:49', '2024-05-30 19:26:49', '2024-05-31 02:26:49', '2024-05-31 02:45:03'),
(10, NULL, 'Opoola Victor Okikijesu', '0', '50', '0', 'CHEW2021065', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', '1', '2024-05-30 19:27:16', 'PREPARATORY', '0', '2024-05-30 19:27:16', '2024-05-30 19:27:16', '2024-05-31 02:27:16', '2024-05-31 02:27:16'),
(11, NULL, 'ADEMOLA ZAINAB ABIDEMI', '0', '50', '0', 'CHEW2021011', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', '1', '2024-05-30 19:27:27', 'PREPARATORY', '0', '2024-05-30 19:27:27', '2024-05-30 19:27:27', '2024-05-31 02:27:27', '2024-05-31 02:27:27'),
(12, NULL, 'OYERO ADEBIMPE REBECCA', '0', '50', '0', 'CHEW2021067', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, 'B', 'C', 'C', 'A', 'C', 'C', 'B', 'A', 'C', 'B', 'A', 'C', 'C', 'C', 'B', 'B', 'C', 'A', 'C', 'B', 'A', 'C', 'B', 'D', 'C', 'C', 'C', 'B', 'B', 'B', 'B', 'C', 'A', 'D', 'C', 'B', 'D', 'C', 'C', 'B', 'A', 'B', 'D', 'B', 'D', 'B', 'C', 'A', 'A', 'C', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', '1', '2024-05-30 19:27:50', 'PREPARATORY', '0', '2024-05-30 19:27:50', '2024-05-30 19:27:50', '2024-05-31 02:27:50', '2024-05-31 02:48:57'),
(13, NULL, 'KOLAWOLE BUKOLA MARY', '0', '50', '0', 'CHEW2021046', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', '1', '2024-05-30 19:28:02', 'PREPARATORY', '0', '2024-05-30 19:28:02', '2024-05-30 19:28:02', '2024-05-31 02:28:02', '2024-05-31 02:28:02'),
(14, NULL, 'TAIWO OREOLUWA DEBORAH', '0', '50', '0', 'CHEW2021076', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, 'B', 'A', 'D', 'B', 'A', 'B', 'C', 'C', 'C', 'B', 'B', 'C', 'B', 'A', 'D', 'C', 'B', 'B', 'B', 'C', 'A', 'B', 'C', 'B', 'A', 'D', 'C', 'C', 'D', 'B', 'A', 'C', 'B', 'A', 'D', 'A', 'B', 'C', 'B', 'A', 'C', 'C', 'C', 'B', 'C', 'A', 'B', 'D', 'C', 'B', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', '1', '2024-05-30 19:28:10', 'PREPARATORY', '0', '2024-05-30 19:28:10', '2024-05-30 19:28:10', '2024-05-31 02:28:10', '2024-05-31 02:42:00'),
(15, NULL, 'ADENIYI OLUWAKEMI OPEYEMI', '0', '50', '0', 'CHEW2021012', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, 'B', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', '1', '2024-05-30 19:28:34', 'PREPARATORY', '0', '2024-05-30 19:28:34', '2024-05-30 19:28:34', '2024-05-31 02:28:34', '2024-05-31 02:28:40'),
(16, NULL, 'OGUNTADE JULIHANNAH TEMITOPE', '0', '50', '0', 'CHEW2021051', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, 'B', 'C', 'C', 'C', 'A', 'B', 'B', 'A', 'B', 'C', 'D', 'A', 'B', 'D', 'B', 'B', 'A', 'D', 'B', 'B', 'D', 'C', 'C', 'A', 'D', 'B', 'B', 'C', 'A', 'B', 'C', 'A', 'B', 'B', 'B', 'D', 'B', 'B', 'D', 'A', 'D', 'B', 'D', 'D', 'A', 'C', 'D', 'A', 'C', 'B', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', '1', '2024-05-30 19:28:41', 'PREPARATORY', '0', '2024-05-30 19:28:41', '2024-05-30 19:28:41', '2024-05-31 02:28:41', '2024-05-31 02:48:04'),
(17, NULL, 'KAMORUDEEN AISHAT YETUNDE', '0', '50', '0', 'CHEW2021044', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', '1', '2024-05-30 19:28:57', 'PREPARATORY', '0', '2024-05-30 19:28:57', '2024-05-30 19:28:57', '2024-05-31 02:28:57', '2024-05-31 02:28:57'),
(18, NULL, 'HAMZAT WASILAT OKIKIOLA', '0', '50', '0', 'CHEW2021035', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, 'B', 'C', 'D', 'A', 'C', 'C', 'A', 'C', 'D', 'B', 'B', 'B', 'B', 'D', 'B', 'D', 'A', 'C', 'C', 'B', 'A', 'A', 'B', 'C', 'D', 'C', 'B', 'D', 'B', 'B', 'C', 'A', 'D', 'B', 'C', 'C', 'B', 'A', 'C', 'C', 'D', 'B', 'D', 'B', 'C', 'B', 'B', 'D', 'B', 'C', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', '1', '2024-05-30 19:29:03', 'PREPARATORY', '0', '2024-05-30 19:29:03', '2024-05-30 19:29:03', '2024-05-31 02:29:03', '2024-05-31 02:47:01'),
(19, NULL, 'ADEROJU ROFIAT OMOTOLA', '0', '50', '0', 'CHEW2021014', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, 'A', 'D', 'B', 'C', 'B', '', 'B', 'B', 'A', 'B', 'C', 'C', 'B', 'C', 'D', 'D', 'A', 'B', 'A', 'A', 'A', 'A', 'B', 'B', 'B', 'C', 'C', 'A', 'D', 'A', 'B', 'D', 'D', 'C', 'C', 'B', 'B', 'B', 'B', 'C', 'C', 'C', 'A', 'D', 'B', 'D', 'A', 'B', 'A', 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', '1', '2024-05-30 19:29:18', 'PREPARATORY', '0', '2024-05-30 19:29:18', '2024-05-30 19:29:18', '2024-05-31 02:29:18', '2024-05-31 02:46:59'),
(20, NULL, 'ADESOLA LYDIA ADEDAPO', '0', '50', '0', 'CHEW2021015', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, 'A', 'A', 'B', 'C', 'B', 'A', 'A', 'B', 'B', 'B', 'A', 'C', 'A', 'A', 'A', 'B', 'A', 'A', 'A', 'A', 'B', 'A', 'A', 'A', 'A', 'A', 'A', 'B', 'B', 'C', 'A', 'B', 'B', 'B', 'B', 'A', 'C', 'C', 'B', 'A', 'B', 'B', 'C', 'C', 'C', 'D', 'D', 'D', 'B', 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', '1', '2024-05-30 19:29:20', 'PREPARATORY', '0', '2024-05-30 19:29:20', '2024-05-30 19:29:20', '2024-05-31 02:29:20', '2024-05-31 02:40:19'),
(21, NULL, 'ISIAQ FAOSIYAT BIODUN', '0', '50', '0', 'CHEW2021041', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, 'B', 'D', 'B', 'C', 'A', 'D', 'C', 'D', 'A', 'B', 'B', 'C', 'D', '', '', '', '', 'C', '', '', 'C', 'B', 'A', 'C', 'B', 'D', 'C', 'D', 'D', 'B', 'C', 'C', 'A', 'C', 'C', 'C', 'D', 'C', 'B', 'A', 'A', 'B', 'B', 'C', 'A', 'D', 'B', 'D', 'D', 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', '1', '2024-05-30 19:29:50', 'PREPARATORY', '0', '2024-05-30 19:29:50', '2024-05-30 19:29:50', '2024-05-31 02:29:50', '2024-05-31 02:41:03'),
(22, NULL, 'AKINWUMI OMOSHALEWA AWAWU', '0', '50', '0', 'CHEW2021020', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, 'A', 'B', 'B', 'C', 'B', 'C', 'C', 'A', 'B', 'B', 'A', 'B', 'C', 'B', 'B', 'C', 'C', 'D', 'A', 'B', 'B', 'C', 'D', 'C', 'B', 'D', 'A', 'A', 'B', 'C', 'A', 'C', 'D', 'C', 'B', 'B', 'B', 'D', 'C', 'B', 'B', 'A', 'D', 'C', 'D', 'B', 'B', 'C', 'A', 'C', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', '1', '2024-05-30 19:30:02', 'PREPARATORY', '0', '2024-05-30 19:30:02', '2024-05-30 19:30:02', '2024-05-31 02:30:02', '2024-05-31 02:44:45'),
(23, NULL, 'ONIOSUN DEBORAH OLUWAMAYOKUN', '0', '50', '0', 'CHEW2021064', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, 'C', 'B', 'B', 'B', 'A', 'B', 'B', 'B', 'D', 'A', 'B', 'C', 'B', 'D', 'B', 'A', 'C', 'B', 'C', 'C', 'B', 'C', 'D', 'D', 'A', 'C', 'D', 'D', 'C', 'B', 'B', 'B', 'C', 'B', 'D', 'B', 'C', 'B', 'C', 'C', 'C', 'D', 'D', 'A', 'D', 'B', 'D', 'B', 'C', 'D', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', '1', '2024-05-30 19:30:46', 'PREPARATORY', '0', '2024-05-30 19:30:46', '2024-05-30 19:30:46', '2024-05-31 02:30:46', '2024-05-31 02:54:15'),
(24, NULL, 'AYUBA MORENIKE ROKIBA', '0', '50', '0', 'CHEW2021025', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, 'C', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', '1', '2024-05-30 19:31:15', 'PREPARATORY', '0', '2024-05-30 19:31:15', '2024-05-30 19:31:15', '2024-05-31 02:31:15', '2024-05-31 02:31:22'),
(25, NULL, 'ABDULMALIK NAMEEROH ADERONKE', '0', '50', '0', 'CHEW2021001', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, 'D', 'A', 'B', 'B', 'B', 'C', 'C', 'D', 'B', 'B', 'D', 'A', 'B', 'B', 'A', 'C', 'A', 'D', 'D', 'B', 'C', 'A', 'C', 'B', 'D', 'C', 'C', 'A', 'C', 'C', 'B', 'A', 'A', 'C', 'A', 'C', 'B', 'B', 'A', 'B', 'B', 'C', 'B', 'C', 'B', 'B', 'B', 'D', 'A', 'B', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', '1', '2024-05-30 19:31:17', 'PREPARATORY', '0', '2024-05-30 19:31:17', '2024-05-30 19:31:17', '2024-05-31 02:31:17', '2024-05-31 02:58:08'),
(26, NULL, 'Oladunni Yewande Bukola', '0', '50', '0', 'CHEW2021056', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, 'A', 'A', 'B', 'A', 'B', 'B', 'D', 'C', 'A', 'D', 'D', 'D', 'C', 'B', 'D', 'B', 'B', 'C', '', 'C', 'A', 'C', 'C', 'A', 'B', 'B', 'D', 'A', 'A', 'C', 'D', 'D', 'B', 'B', 'C', 'D', 'C', 'D', 'D', 'B', 'B', 'B', 'D', 'D', 'C', 'C', 'B', 'B', 'A', 'C', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', '1', '2024-05-30 19:31:40', 'PREPARATORY', '0', '2024-05-30 19:31:40', '2024-05-30 19:31:40', '2024-05-31 02:31:40', '2024-05-31 02:49:55'),
(27, NULL, 'BASHIRU AMINAT OYINLOLA', '0', '50', '0', 'CHEW2021027', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, 'D', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', '1', '2024-05-30 19:31:42', 'PREPARATORY', '0', '2024-05-30 19:31:42', '2024-05-30 19:31:42', '2024-05-31 02:31:42', '2024-05-31 02:31:47'),
(28, NULL, 'BOLAJI DAMILOLA GRACE', '0', '50', '0', 'CHEW2021028', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, 'B', 'C', 'B', 'B', 'B', 'C', 'C', 'B', 'B', 'A', 'B', 'B', 'B', 'B', 'B', 'B', 'B', 'B', 'C', 'C', 'B', 'A', 'B', 'C', 'C', 'B', 'C', 'C', 'B', 'B', 'C', 'C', 'C', 'B', 'D', 'B', 'B', 'B', 'B', 'B', 'B', 'B', 'B', 'B', 'B', 'B', 'B', 'B', 'B', 'B', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', '1', '2024-05-30 19:32:27', 'PREPARATORY', '0', '2024-05-30 19:32:27', '2024-05-30 19:32:27', '2024-05-31 02:32:27', '2024-05-31 02:43:00'),
(29, NULL, 'JOHN SHALOM KEMI', '0', '50', '0', 'CHEW2021043', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, 'B', '', 'B', '', 'B', 'B', '', 'B', '', 'B', 'B', '', 'B', 'C', '', 'B', 'C', 'B', 'C', 'B', 'B', '', '', 'B', 'C', 'C', 'B', 'C', '', 'B', 'B', 'B', '', 'B', '', 'B', 'B', 'B', 'B', 'B', 'B', 'B', 'B', 'B', '', 'B', 'B', '', 'B', 'B', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', '1', '2024-05-30 19:33:03', 'PREPARATORY', '0', '2024-05-30 19:33:03', '2024-05-30 19:33:03', '2024-05-31 02:33:03', '2024-05-31 02:43:42'),
(30, NULL, 'OLAYIWOLA KABIRAT OMOWUNMI', '0', '50', '0', 'CHEW2021060', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, 'C', 'D', 'B', 'B', 'B', 'C', 'C', 'A', 'A', 'C', 'C', 'A', 'A', 'D', 'D', 'C', 'B', 'C', 'C', 'B', 'B', 'B', 'B', 'B', 'D', 'B', 'A', 'A', 'A', 'B', 'D', 'C', 'C', '', 'C', 'C', 'B', 'D', 'C', 'C', 'B', 'C', 'B', 'C', 'A', 'C', 'D', 'B', 'A', 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', '1', '2024-05-30 19:33:33', 'PREPARATORY', '0', '2024-05-30 19:33:33', '2024-05-30 19:33:33', '2024-05-31 02:33:33', '2024-05-31 02:52:40'),
(31, NULL, 'ADENIYI KAOSARA WURAOLA', '0', '50', '0', 'CHEW2021013', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, 'A', 'B', 'C', 'B', 'B', 'C', 'C', 'C', 'C', 'C', 'B', 'A', 'D', 'C', 'C', 'A', 'A', 'C', 'B', 'B', 'C', 'A', 'B', 'A', 'D', 'D', 'C', 'C', 'C', 'A', 'A', 'B', 'B', 'A', 'A', 'A', 'A', 'B', 'A', 'B', 'A', 'A', 'A', 'B', 'B', 'B', 'C', 'B', 'B', 'B', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', '1', '2024-05-30 19:33:34', 'PREPARATORY', '0', '2024-05-30 19:33:34', '2024-05-30 19:33:34', '2024-05-31 02:33:34', '2024-05-31 02:45:32'),
(32, NULL, 'IBRAHIM FATIU ', '0', '50', '0', 'CHEW2021038', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, 'D', 'C', 'B', 'C', 'B', 'D', 'A', 'C', 'C', 'B', 'C', 'B', 'B', 'C', 'C', '', 'D', 'B', 'C', 'B', 'B', 'B', 'C', 'C', 'C', 'C', 'B', 'C', 'C', 'C', 'A', 'B', 'C', 'A', 'C', 'C', 'B', 'D', 'D', 'B', 'C', 'B', 'A', 'B', 'B', 'D', 'A', 'B', 'B', 'B', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', '1', '2024-05-30 19:33:36', 'PREPARATORY', '0', '2024-05-30 19:33:36', '2024-05-30 19:33:36', '2024-05-31 02:33:36', '2024-05-31 02:53:45'),
(33, NULL, 'OLADIPUPO ESTHER OLAIDE', '0', '50', '0', 'CHEW2021055', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, 'C', 'D', 'C', 'B', 'B', 'C', '', 'C', 'D', 'C', 'C', 'B', 'B', 'A', 'B', 'B', 'B', 'A', 'B', 'B', 'C', 'B', 'C', 'D', 'D', 'C', 'B', 'C', 'D', 'B', 'B', 'B', 'D', 'B', 'C', 'C', 'B', 'A', 'C', 'B', 'C', 'C', 'B', 'B', 'B', 'C', 'B', 'C', 'C', 'B', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', '1', '2024-05-30 19:34:42', 'PREPARATORY', '0', '2024-05-30 19:34:42', '2024-05-30 19:34:42', '2024-05-31 02:34:42', '2024-05-31 03:01:39'),
(34, NULL, 'ROTIMI VICTORIA IDOWU', '0', '50', '0', 'CHEW2021070', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', '1', '2024-05-30 19:35:58', 'PREPARATORY', '0', '2024-05-30 19:35:58', '2024-05-30 19:35:58', '2024-05-31 02:35:58', '2024-05-31 02:35:58'),
(35, NULL, 'ADARAMOLA TAIWO ANUOLUWAPO', '0', '50', '0', 'CHEW2021003', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, 'B', 'C', 'A', 'D', 'D', 'B', 'D', 'A', 'B', 'C', 'C', 'B', 'B', 'C', 'B', 'A', 'B', 'D', 'B', 'C', 'D', 'B', 'C', 'A', 'B', 'B', 'C', 'B', 'B', 'C', 'A', 'C', 'C', 'C', 'B', 'B', 'B', 'A', 'B', 'B', 'B', 'C', 'B', 'B', 'B', 'A', 'C', 'C', 'B', 'C', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', '1', '2024-05-30 19:36:28', 'PREPARATORY', '0', '2024-05-30 19:36:28', '2024-05-30 19:36:28', '2024-05-31 02:36:28', '2024-05-31 03:04:19'),
(36, NULL, 'ADETOUN RANTI DORCAS', '0', '50', '0', 'CHEW2021016', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', '1', '2024-05-30 19:37:23', 'PREPARATORY', '0', '2024-05-30 19:37:23', '2024-05-30 19:37:23', '2024-05-31 02:37:23', '2024-05-31 02:37:23'),
(37, NULL, 'AZEEZ KHADIJAH ABIKE', '0', '50', '0', 'CHEW2021105', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, 'A', 'B', 'D', 'A', 'B', 'A', 'C', 'D', 'A', 'B', 'A', 'A', 'D', 'A', 'C', 'D', 'C', 'B', 'A', 'C', 'C', 'B', 'B', 'B', 'B', 'B', 'A', 'D', 'B', 'D', '', '', '', '', '', '', '', '', '', '', 'A', 'B', 'D', 'D', 'C', 'C', 'A', 'C', 'B', 'B', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', '1', '2024-05-30 19:37:24', 'PREPARATORY', '0', '2024-05-30 19:37:24', '2024-05-30 19:37:24', '2024-05-31 02:37:24', '2024-05-31 02:54:31'),
(38, NULL, 'SALAUDEEN KERIMOT OPEYEMI', '0', '50', '0', 'CHEW2021071', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', '1', '2024-05-30 19:37:54', 'PREPARATORY', '0', '2024-05-30 19:37:54', '2024-05-30 19:37:54', '2024-05-31 02:37:54', '2024-05-31 02:37:54'),
(39, NULL, 'OLAWALE ODUNOLA SELIMOT', '0', '50', '0', 'CHEW2021058', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', '1', '2024-05-30 19:38:49', 'PREPARATORY', '0', '2024-05-30 19:38:49', '2024-05-30 19:38:49', '2024-05-31 02:38:49', '2024-05-31 02:38:49'),
(40, NULL, 'QOMORUDEEN MUTIYAT TOLANI', '0', '50', '0', 'CHEW2021069', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', '1', '2024-05-30 19:39:39', 'PREPARATORY', '0', '2024-05-30 19:39:39', '2024-05-30 19:39:39', '2024-05-31 02:39:39', '2024-05-31 02:39:39');

-- --------------------------------------------------------

--
-- Table structure for table `cbt_evaluations`
--

CREATE TABLE `cbt_evaluations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `examstatus` varchar(255) DEFAULT NULL,
  `studentname` varchar(255) DEFAULT NULL,
  `correct` varchar(255) DEFAULT NULL,
  `noofquestion` varchar(255) DEFAULT NULL,
  `wrong` varchar(255) DEFAULT NULL,
  `studentno` varchar(255) DEFAULT NULL,
  `score` varchar(255) DEFAULT NULL,
  `level` varchar(255) DEFAULT NULL,
  `session1` varchar(255) DEFAULT NULL,
  `semester` varchar(255) DEFAULT NULL,
  `hour` int(11) DEFAULT NULL,
  `minute` int(11) DEFAULT NULL,
  `qstno` varchar(255) DEFAULT NULL,
  `A1` int(11) DEFAULT NULL,
  `A2` int(11) DEFAULT NULL,
  `A3` int(11) DEFAULT NULL,
  `A4` int(11) DEFAULT NULL,
  `A5` int(11) DEFAULT NULL,
  `A6` int(11) DEFAULT NULL,
  `A7` int(11) DEFAULT NULL,
  `A8` int(11) DEFAULT NULL,
  `A9` int(11) DEFAULT NULL,
  `A10` int(11) DEFAULT NULL,
  `A11` int(11) DEFAULT NULL,
  `A12` int(11) DEFAULT NULL,
  `A13` int(11) DEFAULT NULL,
  `A14` int(11) DEFAULT NULL,
  `A15` int(11) DEFAULT NULL,
  `A16` int(11) DEFAULT NULL,
  `A17` int(11) DEFAULT NULL,
  `A18` int(11) DEFAULT NULL,
  `A19` int(11) DEFAULT NULL,
  `A20` int(11) DEFAULT NULL,
  `A21` int(11) DEFAULT NULL,
  `A22` int(11) DEFAULT NULL,
  `A23` int(11) DEFAULT NULL,
  `A24` int(11) DEFAULT NULL,
  `A25` int(11) DEFAULT NULL,
  `A26` int(11) DEFAULT NULL,
  `A27` int(11) DEFAULT NULL,
  `A28` int(11) DEFAULT NULL,
  `A29` int(11) DEFAULT NULL,
  `A30` int(11) DEFAULT NULL,
  `A31` int(11) DEFAULT NULL,
  `A32` int(11) DEFAULT NULL,
  `A33` int(11) DEFAULT NULL,
  `A34` int(11) DEFAULT NULL,
  `A35` int(11) DEFAULT NULL,
  `A36` int(11) DEFAULT NULL,
  `A37` int(11) DEFAULT NULL,
  `A38` int(11) DEFAULT NULL,
  `A39` int(11) DEFAULT NULL,
  `A40` int(11) DEFAULT NULL,
  `A41` int(11) DEFAULT NULL,
  `A42` int(11) DEFAULT NULL,
  `A43` int(11) DEFAULT NULL,
  `A44` int(11) DEFAULT NULL,
  `A45` int(11) DEFAULT NULL,
  `A46` int(11) DEFAULT NULL,
  `A47` int(11) DEFAULT NULL,
  `A48` int(11) DEFAULT NULL,
  `A49` int(11) DEFAULT NULL,
  `A50` int(11) DEFAULT NULL,
  `A51` int(11) DEFAULT NULL,
  `A52` int(11) DEFAULT NULL,
  `A53` int(11) DEFAULT NULL,
  `A54` int(11) DEFAULT NULL,
  `A55` int(11) DEFAULT NULL,
  `A56` int(11) DEFAULT NULL,
  `A57` int(11) DEFAULT NULL,
  `A58` int(11) DEFAULT NULL,
  `A59` int(11) DEFAULT NULL,
  `A60` int(11) DEFAULT NULL,
  `A61` int(11) DEFAULT NULL,
  `A62` int(11) DEFAULT NULL,
  `A63` int(11) DEFAULT NULL,
  `A64` int(11) DEFAULT NULL,
  `A65` int(11) DEFAULT NULL,
  `A66` int(11) DEFAULT NULL,
  `A67` int(11) DEFAULT NULL,
  `A68` int(11) DEFAULT NULL,
  `A69` int(11) DEFAULT NULL,
  `A70` int(11) DEFAULT NULL,
  `A71` int(11) DEFAULT NULL,
  `A72` int(11) DEFAULT NULL,
  `A73` int(11) DEFAULT NULL,
  `A74` int(11) DEFAULT NULL,
  `A75` int(11) DEFAULT NULL,
  `A76` int(11) DEFAULT NULL,
  `A77` int(11) DEFAULT NULL,
  `A78` int(11) DEFAULT NULL,
  `A79` int(11) DEFAULT NULL,
  `A80` int(11) DEFAULT NULL,
  `A81` int(11) DEFAULT NULL,
  `A82` int(11) DEFAULT NULL,
  `A83` int(11) DEFAULT NULL,
  `A84` int(11) DEFAULT NULL,
  `A85` int(11) DEFAULT NULL,
  `A86` int(11) DEFAULT NULL,
  `A87` int(11) DEFAULT NULL,
  `A88` int(11) DEFAULT NULL,
  `A89` int(11) DEFAULT NULL,
  `A90` int(11) DEFAULT NULL,
  `A91` int(11) DEFAULT NULL,
  `A92` int(11) DEFAULT NULL,
  `A93` int(11) DEFAULT NULL,
  `A94` int(11) DEFAULT NULL,
  `A95` int(11) DEFAULT NULL,
  `A96` int(11) DEFAULT NULL,
  `A97` int(11) DEFAULT NULL,
  `A98` int(11) DEFAULT NULL,
  `A99` int(11) DEFAULT NULL,
  `A100` int(11) DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  `exam_mode` varchar(255) DEFAULT NULL,
  `exam_category` varchar(255) DEFAULT NULL,
  `course` varchar(255) DEFAULT NULL,
  `pageno` varchar(255) DEFAULT NULL,
  `examdate` datetime DEFAULT NULL,
  `exam_type` varchar(255) DEFAULT NULL,
  `msgstatus` varchar(255) DEFAULT NULL,
  `starttime` datetime NOT NULL,
  `endtime` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cbt_evaluations`
--

INSERT INTO `cbt_evaluations` (`id`, `examstatus`, `studentname`, `correct`, `noofquestion`, `wrong`, `studentno`, `score`, `level`, `session1`, `semester`, `hour`, `minute`, `qstno`, `A1`, `A2`, `A3`, `A4`, `A5`, `A6`, `A7`, `A8`, `A9`, `A10`, `A11`, `A12`, `A13`, `A14`, `A15`, `A16`, `A17`, `A18`, `A19`, `A20`, `A21`, `A22`, `A23`, `A24`, `A25`, `A26`, `A27`, `A28`, `A29`, `A30`, `A31`, `A32`, `A33`, `A34`, `A35`, `A36`, `A37`, `A38`, `A39`, `A40`, `A41`, `A42`, `A43`, `A44`, `A45`, `A46`, `A47`, `A48`, `A49`, `A50`, `A51`, `A52`, `A53`, `A54`, `A55`, `A56`, `A57`, `A58`, `A59`, `A60`, `A61`, `A62`, `A63`, `A64`, `A65`, `A66`, `A67`, `A68`, `A69`, `A70`, `A71`, `A72`, `A73`, `A74`, `A75`, `A76`, `A77`, `A78`, `A79`, `A80`, `A81`, `A82`, `A83`, `A84`, `A85`, `A86`, `A87`, `A88`, `A89`, `A90`, `A91`, `A92`, `A93`, `A94`, `A95`, `A96`, `A97`, `A98`, `A99`, `A100`, `department`, `exam_mode`, `exam_category`, `course`, `pageno`, `examdate`, `exam_type`, `msgstatus`, `starttime`, `endtime`, `created_at`, `updated_at`) VALUES
(1, '2', 'OJO YETUNDE BOLUWATIFE', '22', '50', '28', 'CHEW2021053', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, 25, 17, 19, 28, 1, 31, 41, 43, 36, 27, 26, 21, 7, 13, 23, 6, 38, 18, 16, 48, 35, 5, 46, 34, 47, 50, 4, 29, 12, 49, 30, 22, 11, 2, 20, 42, 3, 32, 39, 14, 10, 40, 24, 37, 9, 8, 15, 44, 33, 45, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', '1', '2024-05-30 19:24:02', 'PREPARATORY', '0', '2024-05-30 19:24:02', '2024-05-30 19:24:02', '2024-05-31 02:24:02', '2024-05-31 02:44:45'),
(2, '2', 'ABDULRASHEED MARYAM EJIDE', '22', '50', '28', 'CHEW2021002', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, 41, 37, 48, 42, 25, 22, 7, 38, 30, 40, 5, 44, 13, 36, 34, 46, 21, 11, 16, 33, 14, 39, 18, 45, 17, 1, 20, 47, 23, 31, 19, 29, 26, 27, 9, 50, 28, 3, 15, 8, 32, 2, 43, 6, 24, 10, 49, 35, 12, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', '1', '2024-05-30 19:24:17', 'PREPARATORY', '0', '2024-05-30 19:24:17', '2024-05-30 19:24:17', '2024-05-31 02:24:17', '2024-05-31 02:45:08'),
(3, '2', 'JIMOH ROKIBAT ABISOLA', '22', '50', '28', 'CHEW2021042', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, 21, 17, 30, 50, 25, 49, 4, 43, 2, 6, 39, 3, 32, 44, 10, 14, 5, 15, 1, 42, 22, 27, 7, 23, 19, 48, 46, 8, 11, 16, 41, 47, 40, 38, 26, 36, 12, 13, 35, 45, 18, 29, 9, 24, 37, 28, 34, 33, 31, 20, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', '1', '2024-05-30 19:24:20', 'PREPARATORY', '0', '2024-05-30 19:24:20', '2024-05-30 19:24:20', '2024-05-31 02:24:20', '2024-05-31 02:44:06'),
(4, '2', 'OYEOLA VICTORIA OLUWATOSIN', '12', '50', '38', 'CHEW2021066', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, 45, 29, 5, 30, 44, 42, 35, 39, 18, 47, 31, 46, 1, 41, 16, 26, 6, 27, 10, 33, 24, 40, 25, 38, 19, 13, 7, 23, 11, 14, 50, 43, 8, 2, 4, 32, 48, 12, 34, 36, 3, 49, 20, 21, 15, 37, 22, 9, 17, 28, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', '1', '2024-05-30 19:25:03', 'PREPARATORY', '0', '2024-05-30 19:25:03', '2024-05-30 19:25:03', '2024-05-31 02:25:03', '2024-05-31 02:45:32'),
(5, '2', 'FOLORUNSO BOLUWATIFE VICTORIA', '15', '50', '35', 'CHEW2021032', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, 50, 6, 27, 8, 2, 1, 13, 46, 42, 29, 3, 39, 14, 11, 33, 25, 37, 31, 43, 28, 4, 38, 48, 47, 12, 45, 16, 40, 30, 22, 15, 18, 19, 32, 34, 10, 20, 35, 26, 36, 21, 41, 5, 9, 7, 24, 23, 49, 17, 44, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', '1', '2024-05-30 19:25:11', 'PREPARATORY', '0', '2024-05-30 19:25:11', '2024-05-30 19:25:11', '2024-05-31 02:25:11', '2024-05-31 02:45:27'),
(6, '2', 'ADEBAYO ROKIBAT ADUNOLA', '15', '50', '35', 'CHEW2021004', NULL, '300', '2024/2025', 'First', 31, 1860, NULL, 13, 8, 42, 3, 23, 18, 44, 25, 17, 19, 1, 21, 26, 15, 34, 24, 40, 38, 30, 28, 49, 4, 7, 6, 11, 12, 46, 27, 31, 20, 37, 47, 2, 36, 43, 50, 35, 22, 16, 41, 14, 32, 9, 5, 48, 10, 29, 45, 33, 39, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', '1', '2024-05-30 19:25:12', 'PREPARATORY', '0', '2024-05-30 19:25:12', '2024-05-30 19:25:12', '2024-05-31 02:25:12', '2024-05-31 02:44:57'),
(7, '2', 'TAIWO SELIMOT OLAWUMI', '26', '50', '24', 'CHEW2021075', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, 16, 29, 9, 33, 47, 45, 18, 24, 1, 27, 41, 8, 3, 46, 19, 42, 35, 43, 14, 6, 11, 30, 2, 7, 10, 13, 26, 36, 28, 40, 22, 48, 20, 15, 23, 4, 25, 49, 17, 44, 37, 34, 32, 21, 39, 5, 12, 38, 31, 50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', '1', '2024-05-30 19:25:21', 'PREPARATORY', '0', '2024-05-30 19:25:21', '2024-05-30 19:25:21', '2024-05-31 02:25:21', '2024-05-31 02:46:10'),
(8, '2', 'ADEKUNLE GLORY ADEBOLA', '18', '50', '32', 'CHEW2021010', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, 41, 19, 13, 29, 14, 20, 34, 11, 15, 48, 5, 44, 32, 8, 16, 12, 18, 26, 21, 50, 2, 9, 17, 45, 38, 7, 36, 42, 40, 25, 4, 10, 23, 37, 39, 27, 1, 47, 35, 24, 22, 30, 43, 6, 31, 3, 28, 49, 33, 46, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', '1', '2024-05-30 19:26:36', 'PREPARATORY', '0', '2024-05-30 19:26:36', '2024-05-30 19:26:36', '2024-05-31 02:26:36', '2024-05-31 02:48:50'),
(9, '2', 'IBRAHIM KHADIJAT AJOKE', '18', '50', '32', 'CHEW2021037', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, 20, 34, 41, 31, 46, 19, 18, 43, 47, 27, 5, 12, 9, 50, 3, 44, 10, 23, 26, 49, 21, 24, 42, 35, 38, 45, 11, 39, 15, 32, 1, 37, 13, 17, 6, 7, 4, 40, 22, 30, 2, 28, 16, 25, 14, 36, 8, 33, 48, 29, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', '1', '2024-05-30 19:26:49', 'PREPARATORY', '0', '2024-05-30 19:26:49', '2024-05-30 19:26:49', '2024-05-31 02:26:49', '2024-05-31 02:45:30'),
(10, '1', 'Opoola Victor Okikijesu', '0', '50', '0', 'CHEW2021065', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, 12, 15, 25, 3, 38, 31, 33, 14, 35, 26, 22, 16, 19, 50, 27, 7, 37, 32, 1, 9, 10, 28, 2, 18, 42, 24, 46, 13, 8, 41, 6, 36, 44, 49, 43, 17, 30, 39, 20, 45, 23, 5, 21, 34, 48, 11, 4, 29, 40, 47, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', '1', '2024-05-30 19:27:16', 'PREPARATORY', '0', '2024-05-30 19:27:16', '2024-05-30 19:27:16', '2024-05-31 02:27:16', '2024-05-31 02:27:16'),
(11, '1', 'ADEMOLA ZAINAB ABIDEMI', '0', '50', '0', 'CHEW2021011', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, 4, 37, 36, 40, 9, 26, 31, 48, 30, 8, 39, 10, 3, 13, 49, 28, 43, 14, 24, 45, 34, 27, 20, 41, 11, 25, 21, 46, 12, 38, 1, 29, 35, 33, 22, 47, 17, 5, 2, 19, 18, 44, 16, 42, 6, 50, 15, 23, 7, 32, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', '1', '2024-05-30 19:27:27', 'PREPARATORY', '0', '2024-05-30 19:27:27', '2024-05-30 19:27:27', '2024-05-31 02:27:27', '2024-05-31 02:27:27'),
(12, '2', 'OYERO ADEBIMPE REBECCA', '30', '50', '20', 'CHEW2021067', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, 46, 12, 17, 35, 20, 11, 9, 27, 15, 36, 4, 38, 49, 14, 29, 23, 6, 39, 3, 5, 42, 34, 24, 2, 16, 33, 13, 40, 30, 47, 1, 50, 18, 48, 26, 45, 37, 10, 31, 44, 8, 19, 22, 7, 41, 25, 32, 43, 21, 28, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', '1', '2024-05-30 19:27:50', 'PREPARATORY', '0', '2024-05-30 19:27:50', '2024-05-30 19:27:50', '2024-05-31 02:27:50', '2024-05-31 02:49:19'),
(13, '1', 'KOLAWOLE BUKOLA MARY', '0', '50', '0', 'CHEW2021046', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, 38, 44, 27, 17, 37, 28, 20, 36, 31, 10, 2, 9, 1, 12, 16, 49, 5, 15, 23, 4, 29, 22, 24, 45, 41, 43, 50, 25, 42, 47, 11, 8, 34, 35, 3, 40, 21, 18, 32, 33, 14, 26, 6, 48, 13, 7, 46, 19, 39, 30, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', '1', '2024-05-30 19:28:02', 'PREPARATORY', '0', '2024-05-30 19:28:02', '2024-05-30 19:28:02', '2024-05-31 02:28:02', '2024-05-31 02:28:02'),
(14, '2', 'TAIWO OREOLUWA DEBORAH', '12', '50', '38', 'CHEW2021076', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, 45, 47, 39, 36, 11, 24, 26, 38, 2, 46, 41, 22, 31, 50, 42, 9, 43, 10, 14, 29, 34, 20, 19, 30, 48, 13, 35, 5, 12, 28, 21, 23, 25, 3, 44, 17, 7, 40, 37, 49, 8, 16, 6, 15, 4, 27, 32, 18, 1, 33, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', '1', '2024-05-30 19:28:09', 'PREPARATORY', '0', '2024-05-30 19:28:09', '2024-05-30 19:28:09', '2024-05-31 02:28:09', '2024-05-31 02:45:29'),
(15, '2', 'ADENIYI OLUWAKEMI OPEYEMI', '0', '50', '50', 'CHEW2021012', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, 10, 13, 5, 24, 29, 26, 4, 28, 34, 21, 47, 9, 39, 35, 18, 45, 33, 16, 50, 36, 1, 42, 7, 46, 44, 20, 27, 8, 11, 38, 32, 22, 23, 37, 41, 25, 12, 31, 43, 6, 49, 40, 19, 2, 15, 3, 48, 30, 17, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', '1', '2024-05-30 19:28:34', 'PREPARATORY', '0', '2024-05-30 19:28:34', '2024-05-30 19:28:34', '2024-05-31 02:28:34', '2024-05-31 02:48:04'),
(16, '2', 'OGUNTADE JULIHANNAH TEMITOPE', '22', '50', '28', 'CHEW2021051', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, 24, 17, 21, 43, 44, 46, 12, 1, 48, 34, 2, 45, 50, 22, 25, 35, 8, 39, 41, 3, 5, 18, 30, 26, 31, 33, 10, 38, 15, 7, 49, 29, 19, 23, 20, 47, 6, 40, 13, 32, 9, 36, 28, 4, 42, 16, 27, 37, 11, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', '1', '2024-05-30 19:28:41', 'PREPARATORY', '0', '2024-05-30 19:28:41', '2024-05-30 19:28:41', '2024-05-31 02:28:41', '2024-05-31 02:48:55'),
(17, '1', 'KAMORUDEEN AISHAT YETUNDE', '0', '50', '0', 'CHEW2021044', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, 32, 42, 37, 21, 11, 15, 25, 40, 10, 33, 23, 20, 35, 16, 26, 6, 43, 34, 7, 12, 36, 8, 4, 46, 50, 1, 31, 49, 14, 13, 24, 5, 9, 41, 22, 17, 3, 2, 39, 19, 27, 48, 28, 47, 45, 29, 44, 30, 38, 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', '1', '2024-05-30 19:28:57', 'PREPARATORY', '0', '2024-05-30 19:28:57', '2024-05-30 19:28:57', '2024-05-31 02:28:57', '2024-05-31 02:28:57'),
(18, '2', 'HAMZAT WASILAT OKIKIOLA', '16', '50', '34', 'CHEW2021035', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, 6, 15, 30, 39, 31, 20, 34, 50, 11, 22, 29, 9, 44, 8, 24, 7, 49, 4, 42, 40, 23, 14, 18, 3, 25, 28, 33, 2, 19, 32, 1, 21, 35, 17, 48, 12, 13, 27, 36, 46, 41, 26, 45, 10, 38, 16, 37, 47, 5, 43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', '1', '2024-05-30 19:29:03', 'PREPARATORY', '0', '2024-05-30 19:29:03', '2024-05-30 19:29:03', '2024-05-31 02:29:03', '2024-05-31 02:47:50'),
(19, '2', 'ADEROJU ROFIAT OMOTOLA', '26', '50', '24', 'CHEW2021014', NULL, '300', '2024/2025', 'First', 33, 1980, NULL, 48, 38, 10, 41, 44, 25, 5, 26, 27, 46, 18, 4, 1, 11, 2, 36, 23, 7, 32, 49, 22, 42, 35, 6, 24, 31, 34, 8, 9, 47, 43, 29, 33, 17, 12, 40, 14, 3, 39, 21, 28, 15, 13, 16, 20, 19, 50, 45, 30, 37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', '1', '2024-05-30 19:29:18', 'PREPARATORY', '0', '2024-05-30 19:29:18', '2024-05-30 19:29:18', '2024-05-31 02:29:18', '2024-05-31 02:47:08'),
(20, '2', 'ADESOLA LYDIA ADEDAPO', '9', '50', '41', 'CHEW2021015', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, 25, 41, 34, 20, 23, 43, 30, 15, 3, 9, 42, 33, 16, 4, 49, 38, 32, 27, 19, 47, 17, 22, 5, 48, 21, 39, 35, 10, 28, 6, 8, 36, 29, 31, 50, 40, 13, 37, 11, 24, 7, 12, 2, 45, 46, 1, 18, 14, 26, 44, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', '1', '2024-05-30 19:29:20', 'PREPARATORY', '0', '2024-05-30 19:29:20', '2024-05-30 19:29:20', '2024-05-31 02:29:20', '2024-05-31 02:45:45'),
(21, '2', 'ISIAQ FAOSIYAT BIODUN', '12', '50', '38', 'CHEW2021041', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, 47, 18, 1, 4, 19, 24, 6, 45, 23, 40, 10, 37, 3, 32, 48, 2, 39, 8, 11, 20, 29, 13, 17, 50, 42, 30, 28, 43, 9, 35, 16, 15, 36, 33, 26, 34, 46, 25, 22, 12, 14, 7, 21, 31, 5, 27, 49, 44, 41, 38, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', '1', '2024-05-30 19:29:50', 'PREPARATORY', '0', '2024-05-30 19:29:50', '2024-05-30 19:29:50', '2024-05-31 02:29:50', '2024-05-31 02:45:38'),
(22, '2', 'AKINWUMI OMOSHALEWA AWAWU', '24', '50', '26', 'CHEW2021020', NULL, '300', '2024/2025', 'First', 35, 2100, NULL, 20, 10, 24, 18, 15, 3, 13, 12, 35, 40, 22, 6, 25, 7, 29, 34, 31, 49, 9, 44, 26, 17, 41, 16, 27, 48, 14, 32, 46, 37, 39, 33, 4, 30, 38, 45, 36, 2, 11, 5, 23, 1, 8, 21, 43, 19, 47, 28, 42, 50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', '1', '2024-05-30 19:30:02', 'PREPARATORY', '0', '2024-05-30 19:30:02', '2024-05-30 19:30:02', '2024-05-31 02:30:02', '2024-05-31 02:45:47'),
(23, '2', 'ONIOSUN DEBORAH OLUWAMAYOKUN', '34', '50', '16', 'CHEW2021064', NULL, '300', '2024/2025', 'First', 26, 1560, NULL, 10, 39, 27, 40, 4, 45, 22, 25, 26, 8, 6, 16, 19, 48, 5, 47, 11, 1, 3, 18, 7, 28, 29, 23, 12, 50, 49, 41, 32, 30, 43, 46, 9, 35, 15, 42, 17, 44, 38, 33, 21, 34, 37, 20, 2, 24, 31, 36, 14, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', '1', '2024-05-30 19:30:46', 'PREPARATORY', '0', '2024-05-30 19:30:46', '2024-05-30 19:30:46', '2024-05-31 02:30:46', '2024-05-31 02:55:38'),
(24, '1', 'AYUBA MORENIKE ROKIBA', '0', '50', '0', 'CHEW2021025', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, 21, 40, 41, 22, 44, 17, 29, 37, 6, 25, 28, 19, 33, 42, 32, 4, 2, 30, 10, 3, 38, 18, 35, 49, 14, 16, 31, 24, 36, 45, 34, 7, 48, 13, 15, 43, 5, 8, 11, 20, 50, 46, 26, 39, 23, 47, 12, 9, 27, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', '1', '2024-05-30 19:31:14', 'PREPARATORY', '0', '2024-05-30 19:31:14', '2024-05-30 19:31:14', '2024-05-31 02:31:14', '2024-05-31 02:31:14'),
(25, '2', 'ABDULMALIK NAMEEROH ADERONKE', '36', '50', '14', 'CHEW2021001', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, 22, 35, 33, 1, 5, 16, 9, 29, 36, 14, 31, 23, 40, 25, 47, 38, 4, 41, 42, 26, 15, 8, 12, 49, 2, 21, 50, 27, 30, 17, 20, 18, 19, 28, 3, 34, 39, 43, 13, 7, 46, 11, 10, 6, 48, 24, 45, 37, 32, 44, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', '1', '2024-05-30 19:31:17', 'PREPARATORY', '0', '2024-05-30 19:31:17', '2024-05-30 19:31:17', '2024-05-31 02:31:17', '2024-05-31 02:59:36'),
(26, '2', 'Oladunni Yewande Bukola', '20', '50', '30', 'CHEW2021056', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, 43, 32, 6, 19, 44, 10, 20, 9, 24, 2, 25, 28, 14, 39, 13, 26, 1, 17, 16, 29, 23, 27, 11, 49, 5, 18, 45, 47, 15, 38, 37, 8, 34, 12, 46, 41, 50, 40, 4, 22, 31, 36, 30, 33, 35, 42, 7, 48, 3, 21, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', '1', '2024-05-30 19:31:40', 'PREPARATORY', '0', '2024-05-30 19:31:40', '2024-05-30 19:31:40', '2024-05-31 02:31:40', '2024-05-31 02:50:12'),
(27, '1', 'BASHIRU AMINAT OYINLOLA', '0', '50', '0', 'CHEW2021027', NULL, '300', '2024/2025', 'First', 21, 1260, NULL, 30, 28, 50, 5, 29, 17, 26, 45, 22, 11, 1, 31, 2, 46, 21, 18, 25, 38, 42, 48, 7, 19, 33, 10, 27, 20, 36, 16, 37, 3, 14, 6, 35, 9, 23, 44, 43, 4, 49, 39, 8, 15, 34, 40, 24, 12, 47, 41, 32, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', '1', '2024-05-30 19:31:42', 'PREPARATORY', '0', '2024-05-30 19:31:42', '2024-05-30 19:31:42', '2024-05-31 02:31:42', '2024-05-31 03:00:44'),
(28, '2', 'BOLAJI DAMILOLA GRACE', '13', '50', '37', 'CHEW2021028', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, 5, 26, 10, 18, 30, 34, 1, 37, 47, 23, 11, 42, 24, 48, 36, 8, 39, 46, 6, 28, 44, 27, 16, 43, 13, 31, 35, 22, 38, 17, 45, 12, 2, 25, 19, 4, 41, 50, 21, 3, 49, 40, 33, 7, 15, 14, 9, 20, 29, 32, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', '1', '2024-05-30 19:32:27', 'PREPARATORY', '0', '2024-05-30 19:32:27', '2024-05-30 19:32:27', '2024-05-31 02:32:27', '2024-05-31 02:45:19'),
(29, '2', 'JOHN SHALOM KEMI', '11', '50', '39', 'CHEW2021043', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, 11, 47, 19, 16, 23, 13, 30, 4, 5, 43, 24, 34, 50, 8, 35, 44, 20, 49, 2, 1, 7, 9, 6, 22, 26, 15, 3, 31, 39, 36, 18, 32, 25, 14, 27, 38, 21, 12, 17, 46, 45, 42, 28, 33, 29, 10, 41, 48, 37, 40, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', '1', '2024-05-30 19:33:03', 'PREPARATORY', '0', '2024-05-30 19:33:03', '2024-05-30 19:33:03', '2024-05-31 02:33:03', '2024-05-31 02:44:15'),
(30, '2', 'OLAYIWOLA KABIRAT OMOWUNMI', '33', '50', '17', 'CHEW2021060', NULL, '300', '2024/2025', 'First', 28, 1680, NULL, 50, 29, 15, 1, 10, 43, 11, 13, 39, 40, 14, 18, 19, 31, 41, 34, 36, 3, 17, 26, 49, 45, 44, 48, 9, 25, 23, 32, 4, 24, 42, 6, 28, 22, 20, 16, 47, 2, 30, 21, 46, 38, 5, 33, 35, 12, 37, 7, 27, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', '1', '2024-05-30 19:33:33', 'PREPARATORY', '0', '2024-05-30 19:33:33', '2024-05-30 19:33:33', '2024-05-31 02:33:33', '2024-05-31 02:55:38'),
(31, '2', 'ADENIYI KAOSARA WURAOLA', '13', '50', '37', 'CHEW2021013', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, 32, 44, 26, 21, 36, 40, 4, 28, 7, 24, 9, 39, 29, 14, 1, 48, 10, 31, 38, 25, 12, 34, 50, 17, 30, 15, 27, 16, 13, 23, 43, 37, 42, 19, 41, 22, 2, 47, 33, 35, 20, 18, 3, 49, 8, 6, 11, 46, 5, 45, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', '1', '2024-05-30 19:33:34', 'PREPARATORY', '0', '2024-05-30 19:33:34', '2024-05-30 19:33:34', '2024-05-31 02:33:34', '2024-05-31 02:46:14'),
(32, '2', 'IBRAHIM FATIU ', '32', '50', '18', 'CHEW2021038', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, 31, 17, 24, 10, 43, 2, 23, 6, 8, 48, 38, 49, 40, 13, 4, 14, 33, 19, 16, 27, 37, 1, 34, 28, 11, 45, 5, 15, 9, 36, 32, 44, 41, 47, 50, 18, 35, 3, 29, 22, 30, 7, 12, 25, 46, 42, 20, 21, 39, 26, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', '1', '2024-05-30 19:33:36', 'PREPARATORY', '0', '2024-05-30 19:33:36', '2024-05-30 19:33:36', '2024-05-31 02:33:36', '2024-05-31 02:56:32'),
(33, '2', 'OLADIPUPO ESTHER OLAIDE', '24', '50', '26', 'CHEW2021055', NULL, '300', '2024/2025', 'First', 23, 1380, NULL, 17, 43, 49, 14, 27, 31, 28, 42, 13, 18, 12, 46, 7, 3, 26, 23, 47, 1, 45, 4, 35, 21, 20, 2, 37, 34, 48, 11, 38, 5, 36, 22, 41, 24, 30, 32, 33, 15, 6, 39, 50, 8, 44, 29, 19, 16, 40, 9, 10, 25, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', '1', '2024-05-30 19:34:42', 'PREPARATORY', '0', '2024-05-30 19:34:42', '2024-05-30 19:34:42', '2024-05-31 02:34:42', '2024-05-31 03:01:59'),
(34, '1', 'ROTIMI VICTORIA IDOWU', '0', '50', '0', 'CHEW2021070', NULL, '300', '2024/2025', 'First', 44, 2640, NULL, 18, 13, 10, 47, 4, 28, 25, 30, 8, 19, 6, 17, 36, 15, 41, 22, 5, 21, 48, 3, 35, 12, 45, 14, 32, 44, 1, 40, 7, 49, 20, 23, 29, 38, 43, 26, 9, 50, 46, 42, 2, 39, 27, 33, 31, 11, 37, 24, 34, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', '1', '2024-05-30 19:35:58', 'PREPARATORY', '0', '2024-05-30 19:35:58', '2024-05-30 19:35:58', '2024-05-31 02:35:58', '2024-05-31 02:41:59'),
(35, '2', 'ADARAMOLA TAIWO ANUOLUWAPO', '24', '50', '26', 'CHEW2021003', NULL, '300', '2024/2025', 'First', 22, 1320, NULL, 24, 2, 19, 22, 38, 13, 29, 27, 44, 18, 34, 28, 43, 50, 39, 46, 45, 41, 5, 35, 26, 1, 33, 32, 36, 10, 37, 7, 47, 17, 9, 48, 12, 31, 40, 15, 14, 42, 20, 21, 30, 3, 25, 23, 6, 8, 11, 4, 49, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', '1', '2024-05-30 19:36:28', 'PREPARATORY', '0', '2024-05-30 19:36:28', '2024-05-30 19:36:28', '2024-05-31 02:36:28', '2024-05-31 03:04:50'),
(36, '1', 'ADETOUN RANTI DORCAS', '0', '50', '0', 'CHEW2021016', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, 19, 45, 13, 40, 48, 32, 34, 38, 15, 28, 14, 24, 47, 5, 37, 26, 20, 2, 22, 44, 43, 12, 27, 25, 31, 30, 4, 6, 35, 18, 11, 39, 33, 10, 23, 8, 41, 50, 29, 49, 42, 17, 21, 1, 16, 3, 7, 46, 9, 36, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', '1', '2024-05-30 19:37:23', 'PREPARATORY', '0', '2024-05-30 19:37:23', '2024-05-30 19:37:23', '2024-05-31 02:37:23', '2024-05-31 02:37:23'),
(37, '2', 'AZEEZ KHADIJAH ABIKE', '17', '50', '33', 'CHEW2021105', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, 16, 12, 11, 1, 35, 42, 3, 20, 27, 23, 21, 48, 38, 39, 17, 8, 15, 40, 18, 30, 28, 45, 46, 25, 14, 36, 34, 41, 4, 22, 2, 19, 47, 7, 6, 43, 5, 29, 9, 13, 50, 26, 24, 31, 49, 37, 32, 33, 44, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', '1', '2024-05-30 19:37:24', 'PREPARATORY', '0', '2024-05-30 19:37:24', '2024-05-30 19:37:24', '2024-05-31 02:37:24', '2024-05-31 02:54:58'),
(38, '1', 'SALAUDEEN KERIMOT OPEYEMI', '0', '50', '0', 'CHEW2021071', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, 46, 24, 21, 1, 49, 13, 11, 29, 8, 31, 10, 44, 9, 12, 34, 43, 47, 27, 32, 37, 35, 17, 42, 2, 48, 22, 25, 33, 20, 36, 16, 5, 19, 38, 26, 18, 23, 40, 30, 28, 39, 4, 14, 45, 41, 6, 15, 50, 7, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', '1', '2024-05-30 19:37:54', 'PREPARATORY', '0', '2024-05-30 19:37:54', '2024-05-30 19:37:54', '2024-05-31 02:37:54', '2024-05-31 02:37:54'),
(39, '1', 'OLAWALE ODUNOLA SELIMOT', '0', '50', '0', 'CHEW2021058', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, 12, 28, 43, 7, 40, 39, 20, 18, 42, 33, 49, 41, 30, 35, 37, 45, 16, 4, 15, 8, 48, 22, 6, 32, 44, 1, 29, 14, 47, 17, 27, 13, 5, 25, 50, 38, 24, 36, 31, 19, 2, 11, 34, 21, 9, 23, 46, 3, 10, 26, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', '1', '2024-05-30 19:38:49', 'PREPARATORY', '0', '2024-05-30 19:38:49', '2024-05-30 19:38:49', '2024-05-31 02:38:49', '2024-05-31 02:38:49'),
(40, '1', 'QOMORUDEEN MUTIYAT TOLANI', '0', '50', '0', 'CHEW2021069', NULL, '300', '2024/2025', 'First', 50, 3000, NULL, 30, 28, 32, 11, 36, 12, 43, 10, 3, 8, 25, 6, 50, 39, 5, 15, 45, 7, 29, 41, 34, 1, 20, 31, 42, 37, 46, 47, 49, 4, 26, 13, 38, 23, 17, 14, 44, 33, 27, 24, 22, 2, 9, 16, 18, 19, 40, 35, 48, 21, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'PREPARATORY', '1', '2024-05-30 19:39:39', 'PREPARATORY', '0', '2024-05-30 19:39:39', '2024-05-30 19:39:39', '2024-05-31 02:39:39', '2024-05-31 02:39:39');

-- --------------------------------------------------------

--
-- Table structure for table `college_setups`
--

CREATE TABLE `college_setups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `web_url` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `college_setups`
--

INSERT INTO `college_setups` (`id`, `name`, `email`, `avatar`, `phone`, `address`, `web_url`, `created_at`, `updated_at`) VALUES
(1, 'Oyo State College of Health Science and Technology', 'info@oyschst.edu.ng', 'college/avatar.png', '08035882299', 'Beside fan-milk, Eleyele,Ibadan, Oyo State', 'http://oyschst.edu.ng', '2024-05-10 03:04:36', '2024-05-10 04:16:59');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course`, `created_at`, `updated_at`) VALUES
(1, 'ENTRANCE', '2024-05-29 00:02:52', '2024-05-29 00:02:52'),
(2, 'ACCIDENT AND EMERGENCY', '2024-05-29 00:02:56', '2024-05-29 00:02:56'),
(3, 'PREPARATORY', '2024-05-29 00:02:59', '2024-05-29 00:02:59');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `department` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `department`, `created_at`, `updated_at`) VALUES
(1, 'HND in Public Health Nursing (DE)', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(2, 'Certificate for Health Assistants', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(3, 'Diploma for Health Technicians', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(4, 'Certificate for Environmental Health Technicians', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(5, 'Diploma in Health Promotion and education', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(6, 'Professional Diploma in Health Information Management', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(7, 'Diploma in Community Health(CHEW)', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(8, 'Diploma in Community Health(CHEW)(DE)', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(9, 'Certificate in Community Health(JCHEW)', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(10, 'Certificate for Pharmacy Technicians', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(11, 'Professional Diploma for Dental Surgery Technicians', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(12, 'Certificate for  Medical Laboratory Technicians(MLT)', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(13, 'Diploma for Health Technicians(DE)', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(14, 'Diploma in Hospitality Management', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(15, 'Diploma in Complementary Health Sciences (Natural/Alternative Medicine)', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(16, 'ND in Environmental Health Technology', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(17, 'HND in Environmental Health Technology', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(18, 'ND Nutrition and Dietetics', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(19, 'ND Health Information Management', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(20, 'ND Dental Therapy', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(21, 'ND Dental Nursing', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(22, 'Professional Certificate in Medical Image Processing/X-ray Technician', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(23, 'ND(WAHEB) in Environmental Health Technology', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(24, 'HND Dental Therapy', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(25, 'HND Dental Nursing', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(26, 'HND Health Information Management', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(27, 'HND Nutrition and Dietetics', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(28, 'Diploma in Medical Social Work', '2024-05-10 02:07:39', '2024-05-10 02:07:39'),
(29, 'Diploma in Tourism and Hospitality Management', '2024-05-10 03:37:27', '2024-05-10 03:37:27'),
(30, 'Professional Diploma in Mental Health and Psychiatric Rehabilitation', '2024-05-10 03:40:31', '2024-05-10 03:40:31');

-- --------------------------------------------------------

--
-- Table structure for table `exam_settings`
--

CREATE TABLE `exam_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `level` varchar(255) NOT NULL,
  `course` varchar(255) NOT NULL,
  `session1` varchar(255) NOT NULL,
  `semester` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `exam_type` varchar(255) NOT NULL,
  `exam_category` varchar(255) NOT NULL,
  `exam_mode` varchar(255) NOT NULL,
  `time_limit` int(11) NOT NULL,
  `duration` int(10) NOT NULL,
  `upload_no_of_qst` int(10) NOT NULL,
  `no_of_qst` int(11) NOT NULL,
  `check_result` int(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exam_settings`
--

INSERT INTO `exam_settings` (`id`, `level`, `course`, `session1`, `semester`, `department`, `exam_type`, `exam_category`, `exam_mode`, `time_limit`, `duration`, `upload_no_of_qst`, `no_of_qst`, `check_result`, `created_at`, `updated_at`) VALUES
(1, '300', 'PREPARATORY', '2024/2025', 'First', 'Diploma in Community Health(CHEW)', 'PREPARATORY', 'GENERAL', 'OBJECTIVE', 5, 50, 50, 50, 1, '2024-05-01 19:33:35', '2024-05-31 02:23:57');

-- --------------------------------------------------------

--
-- Table structure for table `exam_types`
--

CREATE TABLE `exam_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `exam_type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exam_types`
--

INSERT INTO `exam_types` (`id`, `exam_type`, `created_at`, `updated_at`) VALUES
(1, 'ENTRANCE', '2024-05-09 04:44:12', '2024-05-09 04:44:12'),
(2, 'WEEDING-OUT', '2024-05-09 04:44:31', '2024-05-09 04:44:31'),
(3, 'SEMESTER-EXAM', '2024-05-12 05:47:19', '2024-05-12 05:47:19'),
(4, 'PREPARATORY', '2024-05-30 01:57:16', '2024-05-30 01:57:16');

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
-- Table structure for table `failed_logins`
--

CREATE TABLE `failed_logins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `admission_no` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `failed_logins`
--

INSERT INTO `failed_logins` (`id`, `ip_address`, `admission_no`, `created_at`, `updated_at`) VALUES
(1, '127.0.0.1', 'admin@gmail.com', '2024-05-09 00:52:37', '2024-05-09 00:52:37'),
(2, '127.0.0.1', 'admin@gmail.com', '2024-05-14 15:16:49', '2024-05-14 15:16:49');

-- --------------------------------------------------------

--
-- Table structure for table `loading_checks`
--

CREATE TABLE `loading_checks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `loading_check` int(11) NOT NULL,
  `app_check` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `loading_checks`
--

INSERT INTO `loading_checks` (`id`, `loading_check`, `app_check`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2024-05-09 19:19:26', '2024-05-09 19:19:26');

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
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_05_06_201533_create_departments_table', 1),
(6, '2024_05_06_204631_create_cbt_evaluations_table', 1),
(7, '2024_05_06_205746_create_cbt_evaluation1s_table', 1),
(8, '2024_05_06_205804_create_cbt_evaluation2s_table', 1),
(9, '2024_05_06_210702_create_exam_settings_table', 1),
(10, '2024_05_06_211213_create_loading_checks_table', 1),
(11, '2024_05_06_211557_create_questions_table', 1),
(12, '2024_05_06_215150_create_academic_sessions_table', 1),
(13, '2024_05_07_194217_create_failed_logins_table', 1),
(14, '2024_05_08_013143_create_student_admissions_table', 1),
(15, '2024_05_08_190430_software_version', 2),
(16, '2024_05_08_201547_create_exam_types_table', 3),
(17, '2024_05_09_195138_create_cbt_classes_table', 4),
(18, '2024_05_09_195202_create_college_setups_table', 4),
(19, '2024_05_10_214623_create_question_settings_table', 5),
(20, '2024_05_14_110338_create_cbt_evaluations_table', 6),
(21, '2024_05_14_110409_create_cbt_evaluation1s_table', 7),
(22, '2024_05_14_110426_create_cbt_evaluation2s_table', 7),
(23, '2024_05_18_054942_create_courses_table', 8),
(24, '2024_05_28_095609_create_theory_questions_table', 9),
(25, '2024_05_28_095649_create_theory_answers_table', 9),
(26, '2024_05_30_010610_create_theory_answers_table', 10),
(27, '2024_05_30_011457_create_theory_answers_table', 11),
(28, '2024_05_30_011703_create_theory_answers_table', 12),
(29, '2024_05_30_020706_create_theory_answers_table', 13),
(30, '2024_05_30_021219_create_theory_answers_table', 14);

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
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `session1` varchar(255) DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  `level` varchar(255) DEFAULT NULL,
  `semester` varchar(255) NOT NULL,
  `course` varchar(255) NOT NULL,
  `exam_type` varchar(255) DEFAULT NULL,
  `exam_mode` varchar(255) NOT NULL,
  `exam_category` varchar(255) NOT NULL,
  `no_of_qst` int(11) DEFAULT NULL,
  `upload_no_of_qst` int(11) DEFAULT NULL,
  `question_type` varchar(255) DEFAULT NULL,
  `question_no` int(11) DEFAULT NULL,
  `question` text DEFAULT NULL,
  `answer` varchar(1) DEFAULT NULL,
  `graphic` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `session1`, `department`, `level`, `semester`, `course`, `exam_type`, `exam_mode`, `exam_category`, `no_of_qst`, `upload_no_of_qst`, `question_type`, `question_no`, `question`, `answer`, `graphic`, `created_at`, `updated_at`) VALUES
(1, '2024/2025', 'Diploma in Community Health(CHEW)', '300', 'First', 'PREPARATORY', 'PREPARATORY', 'OBJECTIVE', 'GENERAL', 50, 50, 'text', 1, '<p style=\"font-size: 24px; font-family: Arial;\">What is the causative agent of tuberculosis?\n   a) Virus\n   b) Bacteria\n   c) Fungus\n   d) Protozoa\n</p>', 'B', 'blank.jpg', '2024-05-31 02:21:18', '2024-05-31 02:21:18'),
(2, '2024/2025', 'Diploma in Community Health(CHEW)', '300', 'First', 'PREPARATORY', 'PREPARATORY', 'OBJECTIVE', 'GENERAL', 50, 50, 'text', 2, '<p style=\"font-size: 24px; font-family: Arial;\">Which of the following diseases is caused by the Human Immunodeficiency Virus (HIV)?\n   a) Tuberculosis\n   b) Malaria\n   c) Hepatitis B\n   d) AIDS\n</p>', 'D', 'blank.jpg', '2024-05-31 02:21:18', '2024-05-31 02:21:18'),
(3, '2024/2025', 'Diploma in Community Health(CHEW)', '300', 'First', 'PREPARATORY', 'PREPARATORY', 'OBJECTIVE', 'GENERAL', 50, 50, 'text', 3, '<p style=\"font-size: 24px; font-family: Arial;\">Which of the following is NOT a vector-borne disease?\n   a) Malaria\n   b) Dengue Fever\n   c) Tuberculosis\n   d) Zika Virus\n</p>', 'C', 'blank.jpg', '2024-05-31 02:21:18', '2024-05-31 02:21:18'),
(4, '2024/2025', 'Diploma in Community Health(CHEW)', '300', 'First', 'PREPARATORY', 'PREPARATORY', 'OBJECTIVE', 'GENERAL', 50, 50, 'text', 4, '<p style=\"font-size: 24px; font-family: Arial;\">What is the primary mode of transmission of Hepatitis B?\n   a) Sexual contact\n   b) Airborne\n   c) Contaminated food and water\n   d) Vector-borne\n</p>', 'A', 'blank.jpg', '2024-05-31 02:21:18', '2024-05-31 02:21:18'),
(5, '2024/2025', 'Diploma in Community Health(CHEW)', '300', 'First', 'PREPARATORY', 'PREPARATORY', 'OBJECTIVE', 'GENERAL', 50, 50, 'text', 5, '<p style=\"font-size: 24px; font-family: Arial;\">Which of the following is a vaccine-preventable disease?\n   a) Cholera\n   b) Measles\n   c) Dengue Fever\n   d) Typhoid\n</p>', 'B', 'blank.jpg', '2024-05-31 02:21:18', '2024-05-31 02:21:18'),
(6, '2024/2025', 'Diploma in Community Health(CHEW)', '300', 'First', 'PREPARATORY', 'PREPARATORY', 'OBJECTIVE', 'GENERAL', 50, 50, 'text', 6, '<p style=\"font-size: 24px; font-family: Arial;\">What is the causative agent of Malaria?\n   a) Plasmodium virus\n   b) Anopheles mosquito\n   c) Plasmodium parasite\n   d) Plasmodium bacteria\n</p>', 'D', 'blank.jpg', '2024-05-31 02:21:18', '2024-05-31 02:21:18'),
(7, '2024/2025', 'Diploma in Community Health(CHEW)', '300', 'First', 'PREPARATORY', 'PREPARATORY', 'OBJECTIVE', 'GENERAL', 50, 50, 'text', 7, '<p style=\"font-size: 24px; font-family: Arial;\">Which of the following diseases is transmitted through contaminated food and water?\n   a) Tuberculosis\n   b) Cholera\n   c) Dengue Fever\n   d) HIV/AIDS\n</p>', 'B', 'blank.jpg', '2024-05-31 02:21:18', '2024-05-31 02:21:18'),
(8, '2024/2025', 'Diploma in Community Health(CHEW)', '300', 'First', 'PREPARATORY', 'PREPARATORY', 'OBJECTIVE', 'GENERAL', 50, 50, 'text', 8, '<p style=\"font-size: 24px; font-family: Arial;\">What is the primary mode of transmission of Dengue Fever?\n   a) Vector-borne\n   b) Sexual contact\n   c) Airborne\n   d) Direct contact with infected blood\n</p>', 'A', 'blank.jpg', '2024-05-31 02:21:18', '2024-05-31 02:21:18'),
(9, '2024/2025', 'Diploma in Community Health(CHEW)', '300', 'First', 'PREPARATORY', 'PREPARATORY', 'OBJECTIVE', 'GENERAL', 50, 50, 'text', 9, '<p style=\"font-size: 24px; font-family: Arial;\">Which of the following diseases is caused by a virus?\n   a) Cholera\n   b) Tuberculosis\n   c) Influenza\n   d) Tetanus\n</p>', 'C', 'blank.jpg', '2024-05-31 02:21:18', '2024-05-31 02:21:18'),
(10, '2024/2025', 'Diploma in Community Health(CHEW)', '300', 'First', 'PREPARATORY', 'PREPARATORY', 'OBJECTIVE', 'GENERAL', 50, 50, 'text', 10, '<p style=\"font-size: 24px; font-family: Arial;\">What is the incubation period of Hepatitis A?\n    a) 1-2 days\n    b) 1-2 weeks\n    c) 1-2 months\n    d) 1-2 years\n</p>', 'D', 'blank.jpg', '2024-05-31 02:21:18', '2024-05-31 02:21:18'),
(11, '2024/2025', 'Diploma in Community Health(CHEW)', '300', 'First', 'PREPARATORY', 'PREPARATORY', 'OBJECTIVE', 'GENERAL', 50, 50, 'text', 11, '<p style=\"font-size: 24px; font-family: Arial;\">Which of the following is NOT a symptom of Tuberculosis?\n    a) Persistent cough\n    b) Fever\n    c) Rash\n    d) Weight loss\n</p>', 'C', 'blank.jpg', '2024-05-31 02:21:18', '2024-05-31 02:21:18'),
(12, '2024/2025', 'Diploma in Community Health(CHEW)', '300', 'First', 'PREPARATORY', 'PREPARATORY', 'OBJECTIVE', 'GENERAL', 50, 50, 'text', 12, '<p style=\"font-size: 24px; font-family: Arial;\">How is Ebola primarily transmitted?\n    a) Airborne\n    b) Vector-borne\n    c) Direct contact with bodily fluids\n    d) Contaminated food and water\n</p>', 'D', 'blank.jpg', '2024-05-31 02:21:18', '2024-05-31 02:21:18'),
(13, '2024/2025', 'Diploma in Community Health(CHEW)', '300', 'First', 'PREPARATORY', 'PREPARATORY', 'OBJECTIVE', 'GENERAL', 50, 50, 'text', 13, '<p style=\"font-size: 24px; font-family: Arial;\">What is the primary vector for the transmission of Zika Virus?\n    a) Aedes mosquito\n    b) Anopheles mosquito\n    c) Culex mosquito\n    d) Tsetse fly\n</p>', 'A', 'blank.jpg', '2024-05-31 02:21:18', '2024-05-31 02:21:18'),
(14, '2024/2025', 'Diploma in Community Health(CHEW)', '300', 'First', 'PREPARATORY', 'PREPARATORY', 'OBJECTIVE', 'GENERAL', 50, 50, 'text', 14, '<p style=\"font-size: 24px; font-family: Arial;\">Which of the following diseases is NOT caused by a virus?\n    a) Influenza\n    b) Dengue Fever\n    c) Tuberculosis\n    d) HIV/AIDS\n</p>', 'C', 'blank.jpg', '2024-05-31 02:21:18', '2024-05-31 02:21:18'),
(15, '2024/2025', 'Diploma in Community Health(CHEW)', '300', 'First', 'PREPARATORY', 'PREPARATORY', 'OBJECTIVE', 'GENERAL', 50, 50, 'text', 15, '<p style=\"font-size: 24px; font-family: Arial;\">What is the causative agent of Chikungunya Fever?\n    a) Virus\n    b) Bacteria\n    c) Protozoa\n    d) Fungus\n</p>', 'C', 'blank.jpg', '2024-05-31 02:21:18', '2024-05-31 02:21:18'),
(16, '2024/2025', 'Diploma in Community Health(CHEW)', '300', 'First', 'PREPARATORY', 'PREPARATORY', 'OBJECTIVE', 'GENERAL', 50, 50, 'text', 16, '<p style=\"font-size: 24px; font-family: Arial;\">Which of the following diseases is transmitted through contaminated needles?\n    a) Tetanus\n    b) Malaria\n    c) Hepatitis C\n    d) Dengue Fever\n</p>', 'C', 'blank.jpg', '2024-05-31 02:21:18', '2024-05-31 02:21:18'),
(17, '2024/2025', 'Diploma in Community Health(CHEW)', '300', 'First', 'PREPARATORY', 'PREPARATORY', 'OBJECTIVE', 'GENERAL', 50, 50, 'text', 17, '<p style=\"font-size: 24px; font-family: Arial;\">What is the primary mode of transmission of Typhoid Fever?\n    a) Sexual contact\n    b) Airborne\n    c) Contaminated food and water\n    d) Vector-borne\n</p>', 'C', 'blank.jpg', '2024-05-31 02:21:18', '2024-05-31 02:21:18'),
(18, '2024/2025', 'Diploma in Community Health(CHEW)', '300', 'First', 'PREPARATORY', 'PREPARATORY', 'OBJECTIVE', 'GENERAL', 50, 50, 'text', 18, '<p style=\"font-size: 24px; font-family: Arial;\">Which of the following is a symptom of Rabies?\n    a) Rash\n    b) Fever\n    c) Hydrophobia\n    d) Joint pain\n</p>', 'C', 'blank.jpg', '2024-05-31 02:21:18', '2024-05-31 02:21:18'),
(19, '2024/2025', 'Diploma in Community Health(CHEW)', '300', 'First', 'PREPARATORY', 'PREPARATORY', 'OBJECTIVE', 'GENERAL', 50, 50, 'text', 19, '<p style=\"font-size: 24px; font-family: Arial;\">What is the causative agent of Yellow Fever?\n    a) Bacteria\n    b) Virus\n    c) Protozoa\n    d) Fungus\n</p>', 'B', 'blank.jpg', '2024-05-31 02:21:18', '2024-05-31 02:21:18'),
(20, '2024/2025', 'Diploma in Community Health(CHEW)', '300', 'First', 'PREPARATORY', 'PREPARATORY', 'OBJECTIVE', 'GENERAL', 50, 50, 'text', 20, '<p style=\"font-size: 24px; font-family: Arial;\">Which of the following diseases is caused by a protozoan parasite?\n    a) Malaria\n    b) Influenza\n    c) Dengue Fever\n    d) Typhoid Fever\n</p>', 'A', 'blank.jpg', '2024-05-31 02:21:18', '2024-05-31 02:21:18'),
(21, '2024/2025', 'Diploma in Community Health(CHEW)', '300', 'First', 'PREPARATORY', 'PREPARATORY', 'OBJECTIVE', 'GENERAL', 50, 50, 'text', 21, '<p style=\"font-size: 24px; font-family: Arial;\">What is the primary mode of transmission of Leprosy?\n    a) Airborne\n    b) Vector-borne\n    c) Direct contact\n    d) Sexual contact\n</p>', 'C', 'blank.jpg', '2024-05-31 02:21:18', '2024-05-31 02:21:18'),
(22, '2024/2025', 'Diploma in Community Health(CHEW)', '300', 'First', 'PREPARATORY', 'PREPARATORY', 'OBJECTIVE', 'GENERAL', 50, 50, 'text', 22, '<p style=\"font-size: 24px; font-family: Arial;\">Which of the following diseases is NOT vaccine-preventable?\n    a) Measles\n    b) Tuberculosis\n    c) Polio\n    d) Tetanus\n</p>', 'B', 'blank.jpg', '2024-05-31 02:21:18', '2024-05-31 02:21:18'),
(23, '2024/2025', 'Diploma in Community Health(CHEW)', '300', 'First', 'PREPARATORY', 'PREPARATORY', 'OBJECTIVE', 'GENERAL', 50, 50, 'text', 23, '<p style=\"font-size: 24px; font-family: Arial;\">23. What is the causative agent of Cholera?\n    a) Bacteria\n    b) Virus\n    c) Protozoa\n    d) Fungus\n</p>', 'A', 'blank.jpg', '2024-05-31 02:21:18', '2024-05-31 02:21:18'),
(24, '2024/2025', 'Diploma in Community Health(CHEW)', '300', 'First', 'PREPARATORY', 'PREPARATORY', 'OBJECTIVE', 'GENERAL', 50, 50, 'text', 24, '<p style=\"font-size: 24px; font-family: Arial;\">Which of the following diseases is transmitted through respiratory droplets?\n    a) Tetanus\n    b) Tuberculosis\n    c) Malaria\n    d) Dengue Fever\n</p>', 'B', 'blank.jpg', '2024-05-31 02:21:18', '2024-05-31 02:21:18'),
(25, '2024/2025', 'Diploma in Community Health(CHEW)', '300', 'First', 'PREPARATORY', 'PREPARATORY', 'OBJECTIVE', 'GENERAL', 50, 50, 'text', 25, '<p style=\"font-size: 24px; font-family: Arial;\">What is the primary mode of transmission of Pertussis (Whooping Cough)?\n    a) Sexual contact\n    b) Airborne\n    c) Vector-borne\n    d) Direct contact with infected blood\n</p>', 'B', 'blank.jpg', '2024-05-31 02:21:18', '2024-05-31 02:21:18'),
(26, '2024/2025', 'Diploma in Community Health(CHEW)', '300', 'First', 'PREPARATORY', 'PREPARATORY', 'OBJECTIVE', 'GENERAL', 50, 50, 'text', 26, '<p style=\"font-size: 24px; font-family: Arial;\">Which of the following diseases is NOT caused by a bacterium?\n    a) Tuberculosis\n    b) Hepatitis A\n    c) Tetanus\n    d) Cholera\n</p>', 'A', 'blank.jpg', '2024-05-31 02:21:18', '2024-05-31 02:21:18'),
(27, '2024/2025', 'Diploma in Community Health(CHEW)', '300', 'First', 'PREPARATORY', 'PREPARATORY', 'OBJECTIVE', 'GENERAL', 50, 50, 'text', 27, '<p style=\"font-size: 24px; font-family: Arial;\">What is the causative agent of Typhoid Fever?\n    a) Bacteria\n    b) Virus\n    c) Protozoa\n    d) Fungus\n</p>', 'A', 'blank.jpg', '2024-05-31 02:21:18', '2024-05-31 02:21:18'),
(28, '2024/2025', 'Diploma in Community Health(CHEW)', '300', 'First', 'PREPARATORY', 'PREPARATORY', 'OBJECTIVE', 'GENERAL', 50, 50, 'text', 28, '<p style=\"font-size: 24px; font-family: Arial;\">Which of the following diseases is transmitted through contaminated water?\n    a) Malaria\n    b) Dengue Fever\n    c) Typhoid Fever\n    d) Yellow Fever\n</p>', 'C', 'blank.jpg', '2024-05-31 02:21:18', '2024-05-31 02:21:18'),
(29, '2024/2025', 'Diploma in Community Health(CHEW)', '300', 'First', 'PREPARATORY', 'PREPARATORY', 'OBJECTIVE', 'GENERAL', 50, 50, 'text', 29, '<p style=\"font-size: 24px; font-family: Arial;\">What is the primary mode of transmission of Polio?\n    a) Sexual contact\n    b) Airborne\n    c) Vector-borne\n    d) Fecal-oral route\n</p>', 'D', 'blank.jpg', '2024-05-31 02:21:18', '2024-05-31 02:21:18'),
(30, '2024/2025', 'Diploma in Community Health(CHEW)', '300', 'First', 'PREPARATORY', 'PREPARATORY', 'OBJECTIVE', 'GENERAL', 50, 50, 'text', 30, '<p style=\"font-size: 24px; font-family: Arial;\">Which of the following diseases is caused by a fungus?\n    a) Malaria\n    b) Influenza\n    c) Ringworm\n    d) Typhoid Fever\n</p>', 'C', 'blank.jpg', '2024-05-31 02:21:18', '2024-05-31 02:21:18'),
(31, '2024/2025', 'Diploma in Community Health(CHEW)', '300', 'First', 'PREPARATORY', 'PREPARATORY', 'OBJECTIVE', 'GENERAL', 50, 50, 'text', 31, '<p style=\"font-size: 24px; font-family: Arial;\">What is the causative agent of Ringworm?\n    a) Virus\n    b) Bacteria\n    c) Protozoa\n    d) Fungus\n</p>', 'D', 'blank.jpg', '2024-05-31 02:21:18', '2024-05-31 02:21:18'),
(32, '2024/2025', 'Diploma in Community Health(CHEW)', '300', 'First', 'PREPARATORY', 'PREPARATORY', 'OBJECTIVE', 'GENERAL', 50, 50, 'text', 32, '<p style=\"font-size: 24px; font-family: Arial;\">Which of the following diseases is transmitted through contaminated soil?\n    a) Tetanus\n    b) Tuberculosis\n    c) Dengue Fever\n    d) Yellow Fever\n</p>', 'A', 'blank.jpg', '2024-05-31 02:21:18', '2024-05-31 02:21:18'),
(33, '2024/2025', 'Diploma in Community Health(CHEW)', '300', 'First', 'PREPARATORY', 'PREPARATORY', 'OBJECTIVE', 'GENERAL', 50, 50, 'text', 33, '<p style=\"font-size: 24px; font-family: Arial;\">What is the primary mode of transmission of Gonorrhea?\n    a) Vector-borne\n    b) Airborne\n    c) Sexual contact\n    d) Direct contact with bodily fluids\n</p>', 'C', 'blank.jpg', '2024-05-31 02:21:18', '2024-05-31 02:21:18'),
(34, '2024/2025', 'Diploma in Community Health(CHEW)', '300', 'First', 'PREPARATORY', 'PREPARATORY', 'OBJECTIVE', 'GENERAL', 50, 50, 'text', 34, '<p style=\"font-size: 24px; font-family: Arial;\">Which of the following diseases is characterized by the formation of ulcers in the genital area?\n    a) Cholera\n    b) Gonorrhea\n    c) Syphilis\n    d) Malaria\n</p>', 'C', 'blank.jpg', '2024-05-31 02:21:18', '2024-05-31 02:21:18'),
(35, '2024/2025', 'Diploma in Community Health(CHEW)', '300', 'First', 'PREPARATORY', 'PREPARATORY', 'OBJECTIVE', 'GENERAL', 50, 50, 'text', 35, '<p style=\"font-size: 24px; font-family: Arial;\">What is the causative agent of Syphilis?\n    a) Bacteria\n    b) Virus\n    c) Protozoa\n    d) Fungus\n</p>', 'A', 'blank.jpg', '2024-05-31 02:21:18', '2024-05-31 02:21:18'),
(36, '2024/2025', 'Diploma in Community Health(CHEW)', '300', 'First', 'PREPARATORY', 'PREPARATORY', 'OBJECTIVE', 'GENERAL', 50, 50, 'text', 36, '<p style=\"font-size: 24px; font-family: Arial;\">Which of the following diseases is transmitted through infected blood transfusions?\n    a) Malaria\n    b) Hepatitis C\n    c) Tuberculosis\n    d) Chikungunya Fever\n</p>', 'C', 'blank.jpg', '2024-05-31 02:21:18', '2024-05-31 02:21:18'),
(37, '2024/2025', 'Diploma in Community Health(CHEW)', '300', 'First', 'PREPARATORY', 'PREPARATORY', 'OBJECTIVE', 'GENERAL', 50, 50, 'text', 37, '<p style=\"font-size: 24px; font-family: Arial;\">What is the primary mode of transmission of Mumps?\n    a) Sexual contact\n    b) Airborne\n    c) Vector-borne\n    d) Direct contact with respiratory droplets\n</p>', 'D', 'blank.jpg', '2024-05-31 02:21:18', '2024-05-31 02:21:18'),
(38, '2024/2025', 'Diploma in Community Health(CHEW)', '300', 'First', 'PREPARATORY', 'PREPARATORY', 'OBJECTIVE', 'GENERAL', 50, 50, 'text', 38, '<p style=\"font-size: 24px; font-family: Arial;\">Which of the following diseases is characterized by swelling of the parotid glands?\n    a) Measles\n    b) Rubella\n    c) Mumps\n    d) Chickenpox\n</p>', 'C', 'blank.jpg', '2024-05-31 02:21:18', '2024-05-31 02:21:18'),
(39, '2024/2025', 'Diploma in Community Health(CHEW)', '300', 'First', 'PREPARATORY', 'PREPARATORY', 'OBJECTIVE', 'GENERAL', 50, 50, 'text', 39, '<p style=\"font-size: 24px; font-family: Arial;\">What is the causative agent of Measles?\n    a) Bacteria\n    b) Virus\n    c) Protozoa\n    d) Fungus\n</p>', 'B', 'blank.jpg', '2024-05-31 02:21:18', '2024-05-31 02:21:18'),
(40, '2024/2025', 'Diploma in Community Health(CHEW)', '300', 'First', 'PREPARATORY', 'PREPARATORY', 'OBJECTIVE', 'GENERAL', 50, 50, 'text', 40, '<p style=\"font-size: 24px; font-family: Arial;\">Which of the following diseases is characterized by a distinctive red rash?\n    a) Tuberculosis\n    b) Measles\n    c) Tetanus\n    d) Hepatitis B\n</p>', 'B', 'blank.jpg', '2024-05-31 02:21:18', '2024-05-31 02:21:18'),
(41, '2024/2025', 'Diploma in Community Health(CHEW)', '300', 'First', 'PREPARATORY', 'PREPARATORY', 'OBJECTIVE', 'GENERAL', 50, 50, 'text', 41, '<p style=\"font-size: 24px; font-family: Arial;\">What is the primary mode of transmission of Rubella?\n    a) Sexual contact\n    b) Airborne\n    c) Vector-borne\n    d) Direct contact with respiratory droplets\n</p>', 'D', 'blank.jpg', '2024-05-31 02:21:18', '2024-05-31 02:21:18'),
(42, '2024/2025', 'Diploma in Community Health(CHEW)', '300', 'First', 'PREPARATORY', 'PREPARATORY', 'OBJECTIVE', 'GENERAL', 50, 50, 'text', 42, '<p style=\"font-size: 24px; font-family: Arial;\">Which of the following diseases can cause congenital abnormalities if contracted during pregnancy?\n    a) Rubella\n    b) Tuberculosis\n    c) Dengue Fever\n    d) Tetanus\n</p>', 'A', 'blank.jpg', '2024-05-31 02:21:18', '2024-05-31 02:21:18'),
(43, '2024/2025', 'Diploma in Community Health(CHEW)', '300', 'First', 'PREPARATORY', 'PREPARATORY', 'OBJECTIVE', 'GENERAL', 50, 50, 'text', 43, '<p style=\"font-size: 24px; font-family: Arial;\">What is the causative agent of Chickenpox?\n    a) Bacteria\n    b) Virus\n    c) Protozoa\n    d) Fungus\n</p>', 'B', 'blank.jpg', '2024-05-31 02:21:18', '2024-05-31 02:21:18'),
(44, '2024/2025', 'Diploma in Community Health(CHEW)', '300', 'First', 'PREPARATORY', 'PREPARATORY', 'OBJECTIVE', 'GENERAL', 50, 50, 'text', 44, '<p style=\"font-size: 24px; font-family: Arial;\">Which of the following diseases is characterized by itchy blisters on the skin?\n    a) Tuberculosis\n    b) Chickenpox\n    c) Hepatitis C\n    d) Yellow Fever\n</p>', 'B', 'blank.jpg', '2024-05-31 02:21:18', '2024-05-31 02:21:18'),
(45, '2024/2025', 'Diploma in Community Health(CHEW)', '300', 'First', 'PREPARATORY', 'PREPARATORY', 'OBJECTIVE', 'GENERAL', 50, 50, 'text', 45, '<p style=\"font-size: 24px; font-family: Arial;\">What is the primary mode of transmission of Pertussis (Whooping Cough)?\n    a) Sexual contact\n    b) Airborne\n    c) Vector-borne\n    d) Direct contact with infected blood\n</p>', 'B', 'blank.jpg', '2024-05-31 02:21:18', '2024-05-31 02:21:18'),
(46, '2024/2025', 'Diploma in Community Health(CHEW)', '300', 'First', 'PREPARATORY', 'PREPARATORY', 'OBJECTIVE', 'GENERAL', 50, 50, 'text', 46, '<p style=\"font-size: 24px; font-family: Arial;\">Which of the following diseases is characterized by severe coughing fits?\n    a) Cholera\n    b) Pertussis\n    c) Typhoid Fever\n    d) Yellow Fever\n</p>', 'B', 'blank.jpg', '2024-05-31 02:21:18', '2024-05-31 02:21:18'),
(47, '2024/2025', 'Diploma in Community Health(CHEW)', '300', 'First', 'PREPARATORY', 'PREPARATORY', 'OBJECTIVE', 'GENERAL', 50, 50, 'text', 47, '<p style=\"font-size: 24px; font-family: Arial;\">What is the causative agent of Tetanus?\n    a) Bacteria\n    b) Virus\n    c) Protozoa\n    d) Fungus\n</p>', 'A', 'blank.jpg', '2024-05-31 02:21:18', '2024-05-31 02:21:18'),
(48, '2024/2025', 'Diploma in Community Health(CHEW)', '300', 'First', 'PREPARATORY', 'PREPARATORY', 'OBJECTIVE', 'GENERAL', 50, 50, 'text', 48, '<p style=\"font-size: 24px; font-family: Arial;\">Which of the following diseases is characterized by muscle stiffness and spasms?\n    a) Tuberculosis\n    b) Tetanus\n    c) Hepatitis A\n    d) Dengue Fever\n</p>', 'B', 'blank.jpg', '2024-05-31 02:21:18', '2024-05-31 02:21:18'),
(49, '2024/2025', 'Diploma in Community Health(CHEW)', '300', 'First', 'PREPARATORY', 'PREPARATORY', 'OBJECTIVE', 'GENERAL', 50, 50, 'text', 49, '<p style=\"font-size: 24px; font-family: Arial;\">What is the primary mode of transmission of Listeriosis?\n    a) Sexual contact\n    b) Airborne\n    c) Contaminated food\n    d) Vector-borne\n</p>', 'C', 'blank.jpg', '2024-05-31 02:21:18', '2024-05-31 02:21:18'),
(50, '2024/2025', 'Diploma in Community Health(CHEW)', '300', 'First', 'PREPARATORY', 'PREPARATORY', 'OBJECTIVE', 'GENERAL', 50, 50, 'text', 50, '<p style=\"font-size: 24px; font-family: Arial;\">Which of the following diseases is caused by Listeria monocytogenes?\n    a) Tuberculosis\n    b) Tetanus\n    c) Listeriosis\n    d) Malaria\n</p>', 'C', 'blank.jpg', '2024-05-31 02:21:18', '2024-05-31 02:21:18');

-- --------------------------------------------------------

--
-- Table structure for table `question_settings`
--

CREATE TABLE `question_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `session1` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `course` varchar(255) NOT NULL,
  `upload_no_of_qst` int(10) NOT NULL,
  `no_of_qst` int(11) NOT NULL,
  `level` varchar(255) NOT NULL,
  `semester` varchar(255) NOT NULL,
  `duration` int(11) NOT NULL,
  `exam_type` varchar(255) NOT NULL,
  `exam_category` varchar(255) NOT NULL,
  `exam_status` enum('Active','Inactive') NOT NULL,
  `exam_mode` varchar(255) NOT NULL,
  `exam_date` date NOT NULL,
  `check_result` int(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `question_settings`
--

INSERT INTO `question_settings` (`id`, `session1`, `department`, `course`, `upload_no_of_qst`, `no_of_qst`, `level`, `semester`, `duration`, `exam_type`, `exam_category`, `exam_status`, `exam_mode`, `exam_date`, `check_result`, `created_at`, `updated_at`) VALUES
(1, '2024/2025', 'Diploma in Community Health(CHEW)', 'PREPARATORY', 50, 50, '300', 'First', 50, 'PREPARATORY', 'GENERAL', 'Active', 'OBJECTIVE', '2024-06-04', 1, '2024-05-31 02:21:18', '2024-05-31 02:23:57');

-- --------------------------------------------------------

--
-- Table structure for table `software_version`
--

CREATE TABLE `software_version` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `version` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `software_version`
--

INSERT INTO `software_version` (`id`, `name`, `version`, `created_at`, `updated_at`) VALUES
(1, 'Computer Based Test', '2.5.1', '2024-05-09 19:19:26', '2024-05-09 19:19:26');

-- --------------------------------------------------------

--
-- Table structure for table `student_admissions`
--

CREATE TABLE `student_admissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admission_no` text NOT NULL,
  `surname` text DEFAULT NULL,
  `first_name` text DEFAULT NULL,
  `other_name` text DEFAULT NULL,
  `department` text DEFAULT NULL,
  `phone_no` text DEFAULT NULL,
  `state` text DEFAULT NULL,
  `level` text DEFAULT NULL,
  `sex` text DEFAULT NULL,
  `phone_no1` text DEFAULT NULL,
  `user_name` text DEFAULT NULL,
  `password` text DEFAULT NULL,
  `picture_name` text DEFAULT NULL,
  `session1` text DEFAULT NULL,
  `login_status` text DEFAULT NULL,
  `login_attempts` int(11) DEFAULT NULL,
  `user_type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_admissions`
--

INSERT INTO `student_admissions` (`id`, `admission_no`, `surname`, `first_name`, `other_name`, `department`, `phone_no`, `state`, `level`, `sex`, `phone_no1`, `user_name`, `password`, `picture_name`, `session1`, `login_status`, `login_attempts`, `user_type`, `created_at`, `updated_at`) VALUES
(1, 'JCHEW2021001', 'ABDULWAHAB', 'HIKMAT', 'FOLAKE', 'Certificate in Community Health(JCHEW)', '8104472844', 'OYO', '200', 'Female', '8104472844', '8104472844', '8104472844', 'blank.jpg', '2024/2025', '0', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:20:36'),
(2, 'JCHEW2021002', 'ABIADE', 'BARAKAT', 'BOLA', 'Certificate in Community Health(JCHEW)', '8173899236', 'OYO', '200', 'Female', '8173899236', '8173899236', '8173899236', 'blank.jpg', '2024/2025', '0', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:20:36'),
(3, 'JCHEW2021003', 'ADEBAYO', 'BUKOLA', 'ALIMAT', 'Certificate in Community Health(JCHEW)', '9048787556', 'OYO', '200', 'Female', '9048787556', '9048787556', '9048787556', 'blank.jpg', '2024/2025', '0', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:20:36'),
(4, 'JCHEW2021004', 'ADEGOKE', 'DAMILOLA', 'GRACE', 'Certificate in Community Health(JCHEW)', '7054821025', 'OYO', '200', 'Female', '7054821025', '7054821025', '7054821025', 'blank.jpg', '2024/2025', '0', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:20:36'),
(5, 'JCHEW2021005', 'ADENIRAN', 'ADESOLA', 'ELIZABETH', 'Certificate in Community Health(JCHEW)', '8066520359', 'ONDO', '200', 'Female', '8066520359', '8066520359', '8066520359', 'blank.jpg', '2024/2025', '0', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:20:36'),
(6, 'JCHEW2021006', 'ADEPOJU  ', 'OLUWATUNMISE', 'OLUWAFERANMI', 'Certificate in Community Health(JCHEW)', '8148923095', 'OYO', '200', 'Female', '8148923095', '8148923095', '8148923095', 'blank.jpg', '2024/2025', '0', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:20:36'),
(7, 'JCHEW2021007', 'ADEREMI  ', 'AJIBOLA', 'OLUWATOSIN', 'Certificate in Community Health(JCHEW)', '9045453705', 'OYO', '200', 'Female', '9045453705', '9045453705', '9045453705', 'blank.jpg', '2024/2025', '0', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:20:36'),
(8, 'JCHEW2021008', 'ADESIYAN', 'KARIMOT', 'ABOSEDE', 'Certificate in Community Health(JCHEW)', '8101099871', 'OYO', '200', 'Female', '8101099871', '8101099871', '8101099871', 'blank.jpg', '2024/2025', '0', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:20:36'),
(9, 'JCHEW2021009', 'ADETUNJI', 'FAIDAT', 'MOJISOLA', 'Certificate in Community Health(JCHEW)', '8102317876', 'OYO', '200', 'Female', '8102317876', '8102317876', '8102317876', 'blank.jpg', '2024/2025', '0', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:20:36'),
(10, 'JCHEW2021010', 'AFOLABI', 'ANUOLUWAPO', 'ENIOLA', 'Certificate in Community Health(JCHEW)', '9121931429', 'OYO', '200', 'Female', '9121931429', '9121931429', '9121931429', 'blank.jpg', '2024/2025', '0', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:20:36'),
(11, 'JCHEW2021011', 'AJAYI', 'OLUWADAMILOLA', 'ELIZABETH', 'Certificate in Community Health(JCHEW)', '8164356189', 'OYO', '200', 'Female', '8164356189', '8164356189', '8164356189', 'blank.jpg', '2024/2025', '0', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:20:36'),
(12, 'JCHEW2021012', 'AJIBOYE', 'IBRAHIM', 'OLALEKAN', 'Certificate in Community Health(JCHEW)', '7030550509', 'OYO', '200', 'Male', '7030550509', '7030550509', '7030550509', 'blank.jpg', '2024/2025', '0', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:20:36'),
(13, 'JCHEW2021013', 'AKANMU', 'LEAH', 'OREOFE', 'Certificate in Community Health(JCHEW)', '8087198956', 'OYO', '200', 'Female', '8087198956', '8087198956', '8087198956', 'blank.jpg', '2024/2025', '0', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:20:36'),
(14, 'JCHEW2021014', 'AKINPELU', 'AISHAT', 'ABIDEMI', 'Certificate in Community Health(JCHEW)', '8117936141', 'OSUN', '200', 'Female', '8117936141', '8117936141', '8117936141', 'blank.jpg', '2024/2025', '0', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:20:36'),
(15, 'JCHEW2021015', 'AKINTOYE', 'OPEYEMI', 'CHRISTIANAH', 'Certificate in Community Health(JCHEW)', '8163300424', 'OGUN', '200', 'Female', '8163300424', '8163300424', '8163300424', 'blank.jpg', '2024/2025', '0', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:20:36'),
(16, 'JCHEW2021016', 'AMUSAN', 'AYOMIDE', 'OYINDAMOLA', 'Certificate in Community Health(JCHEW)', '8163749383', 'OYO', '200', 'Female', '8163749383', '8163749383', '8163749383', 'blank.jpg', '2024/2025', '0', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:20:36'),
(17, 'JCHEW2021017', 'ANYANWU', 'JOY', 'ADANNE', 'Certificate in Community Health(JCHEW)', '9070223575', 'IMO', '200', 'Female', '9070223575', '9070223575', '9070223575', 'blank.jpg', '2024/2025', '0', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:20:36'),
(18, 'JCHEW2021018', 'ATANDA', 'OPEYEMI', 'TOYOSI', 'Certificate in Community Health(JCHEW)', '8057271616', 'OYO', '200', 'Female', '8057271616', '8057271616', '8057271616', 'blank.jpg', '2024/2025', '0', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:20:36'),
(19, 'JCHEW2021019', 'BADMUS', 'PEACE', 'ABOSEDE', 'Certificate in Community Health(JCHEW)', '8034690576', 'OSUN', '200', 'Female', '8034690576', '8034690576', '8034690576', 'blank.jpg', '2024/2025', '0', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:20:36'),
(20, 'JCHEW2021020', 'DAUDA', 'RAFIAT', 'OMOTAYO', 'Certificate in Community Health(JCHEW)', '8155067739', 'OYO', '200', 'Female', '8155067739', '8155067739', '8155067739', 'blank.jpg', '2024/2025', '0', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:20:36'),
(21, 'JCHEW2021021', 'GBADAMOSI', 'DAMILOLA', 'OLUWAYEMISI', 'Certificate in Community Health(JCHEW)', '9041384165', 'OYO', '200', 'Female', '9041384165', '9041384165', '9041384165', 'blank.jpg', '2024/2025', '0', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:20:36'),
(22, 'JCHEW2021022', 'GBENRO', 'JUMOKE', 'KEMI', 'Certificate in Community Health(JCHEW)', '9028041004', 'OYO', '200', 'Female', '9028041004', '9028041004', '9028041004', 'blank.jpg', '2024/2025', '0', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:20:36'),
(23, 'JCHEW2021023', 'IBRAHEEM', 'ROFIAT', 'OMOBOLANLE', 'Certificate in Community Health(JCHEW)', '9040260185', 'OYO', '200', 'Female', '9040260185', '9040260185', '9040260185', 'blank.jpg', '2024/2025', '0', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:20:36'),
(24, 'JCHEW2021024', 'IGBAYILOLA', 'GRACE', 'IYANUOLUWA', 'Certificate in Community Health(JCHEW)', '9131145620', 'OYO', '200', 'Female', '9131145620', '9131145620', '9131145620', 'blank.jpg', '2024/2025', '0', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:20:36'),
(25, 'JCHEW2021025', 'ISIAKA', 'TAWA', 'OLUWATOYIN', 'Certificate in Community Health(JCHEW)', '9032713434', 'OYO', '200', 'Female', '9032713434', '9032713434', '9032713434', 'blank.jpg', '2024/2025', '0', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:20:36'),
(26, 'JCHEW2021026', 'KHALID', 'HAEMONULLAH', 'ADEOLA', 'Certificate in Community Health(JCHEW)', '8109276246', 'OSUN', '200', 'Female', '8109276246', '8109276246', '8109276246', 'blank.jpg', '2024/2025', '0', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:20:36'),
(27, 'JCHEW2021027', 'LAWAL', 'NASIRAT', 'OMOLOLA', 'Certificate in Community Health(JCHEW)', '8119128931', 'OYO', '200', 'Female', '8119128931', '8119128931', '8119128931', 'blank.jpg', '2024/2025', '0', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:20:36'),
(28, 'JCHEW2021028', 'MONEHIN', 'OPEMIPO', 'ABOSEDE', 'Certificate in Community Health(JCHEW)', '8089968411', 'ONDO', '200', 'Female', '8089968411', '8089968411', '8089968411', 'blank.jpg', '2024/2025', '0', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:20:36'),
(29, 'JCHEW2021029', 'MUSA', 'BASIRAT', 'ROMOKE', 'Certificate in Community Health(JCHEW)', '8131898204', 'OYO', '200', 'Female', '8131898204', '8131898204', '8131898204', 'blank.jpg', '2024/2025', '0', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:20:36'),
(30, 'JCHEW2021030', 'MUSTAPHA', 'MARIAM', 'OLUWASEUN', 'Certificate in Community Health(JCHEW)', '8165387511', 'OYO', '200', 'Female', '8165387511', '8165387511', '8165387511', 'blank.jpg', '2024/2025', '0', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:20:36'),
(31, 'JCHEW2021031', 'ODETOYINBO', 'FUNKE', 'ODUNOLA', 'Certificate in Community Health(JCHEW)', '7068934385', 'OYO', '200', 'Female', '7068934385', '7068934385', '7068934385', 'blank.jpg', '2024/2025', '0', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:20:36'),
(32, 'JCHEW2021032', 'OGUNBANWO', 'BLESSING', 'OLUWASEUN', 'Certificate in Community Health(JCHEW)', '8173959576', 'OGUN', '200', 'Female', '8173959576', '8173959576', '8173959576', 'blank.jpg', '2024/2025', '0', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:20:36'),
(33, 'JCHEW2021033', 'OGUNLETI', 'ELIZABETH', 'ADEKEMI', 'Certificate in Community Health(JCHEW)', '7039787121', 'OYO', '200', 'Female', '7039787121', '7039787121', '7039787121', 'blank.jpg', '2024/2025', '0', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:20:36'),
(34, 'JCHEW2021034', 'OGUNYEMI', 'OLANIKE', 'OLUWAFUNKE', 'Certificate in Community Health(JCHEW)', '7063683140', 'OYO', '200', 'Female', '7063683140', '7063683140', '7063683140', 'blank.jpg', '2024/2025', '0', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:20:36'),
(35, 'JCHEW2021035', 'OKE', 'OLUWATOBI', 'OLAMIDE', 'Certificate in Community Health(JCHEW)', '7034902598', 'OYO', '200', 'Female', '7034902598', '7034902598', '7034902598', 'blank.jpg', '2024/2025', '0', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:20:36'),
(36, 'JCHEW2021036', 'OKESOOTO', 'BLESSING', 'RASHIDAT', 'Certificate in Community Health(JCHEW)', '8069546329', 'OYO', '200', 'Female', '8069546329', '8069546329', '8069546329', 'blank.jpg', '2024/2025', '0', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:20:36'),
(37, 'JCHEW2021037', 'OLADAPO', 'ISRAEL', 'TEMITOPE', 'Certificate in Community Health(JCHEW)', '8115271861', 'OYO', '200', 'Male', '8115271861', '8115271861', '8115271861', 'blank.jpg', '2024/2025', '0', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:20:36'),
(38, 'JCHEW2021038', 'OLADEPO', 'SULIYAT', 'OPEYEMI', 'Certificate in Community Health(JCHEW)', '9070907613', 'OYO', '200', 'Female', '9070907613', '9070907613', '9070907613', 'blank.jpg', '2024/2025', '0', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:20:36'),
(39, 'JCHEW2021039', 'OLAGOKE', 'ROFIAT', 'EBUNOLUWA', 'Certificate in Community Health(JCHEW)', '8157826307', 'OYO', '200', 'Female', '8157826307', '8157826307', '8157826307', 'blank.jpg', '2024/2025', '0', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:20:36'),
(40, 'JCHEW2021040', 'OLALEKAN', 'ZAINAB', 'PELUMI', 'Certificate in Community Health(JCHEW)', '8025461527', 'OYO', '200', 'Female', '8025461527', '8025461527', '8025461527', 'blank.jpg', '2024/2025', '0', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:20:36'),
(41, 'JCHEW2021041', 'OLUOKUN', 'SEFIAT', 'BOLUWATIFE', 'Certificate in Community Health(JCHEW)', '9021382616', 'OYO', '200', 'Female', '9021382616', '9021382616', '9021382616', 'blank.jpg', '2024/2025', '0', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:20:36'),
(42, 'JCHEW2021042', 'ONI', 'OMOLOLA', 'OLUWAFUNMILAYO', 'Certificate in Community Health(JCHEW)', '8105063031', 'OYO', '200', 'Female', '8105063031', '8105063031', '8105063031', 'blank.jpg', '2024/2025', '0', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:20:36'),
(43, 'JCHEW2021043', 'OPADEJI', 'ABIGEAL', 'BOSE', 'Certificate in Community Health(JCHEW)', '8140663527', 'OYO', '200', 'Female', '8140663527', '8140663527', '8140663527', 'blank.jpg', '2024/2025', '0', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:20:36'),
(44, 'JCHEW2021044', 'OPAREMI', 'AZIZAT', 'YETUNDE', 'Certificate in Community Health(JCHEW)', '8155734579', 'OYO', '200', 'Female', '8155734579', '8155734579', '8155734579', 'blank.jpg', '2024/2025', '0', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:20:36'),
(45, 'JCHEW2021045', 'OYEWOLE', 'ROHEEMOT', '', 'Certificate in Community Health(JCHEW)', '70340711803', 'OYO', '200', 'Female', '70340711803', '70340711803', '70340711803', 'blank.jpg', '2024/2025', '0', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:20:36'),
(46, 'JCHEW2021046', 'OYEWOLE', 'SHUKURAT', 'OLOLADE', 'Certificate in Community Health(JCHEW)', '8138474029', 'OYO', '200', 'Female', '8138474029', '8138474029', '8138474029', 'blank.jpg', '2024/2025', '0', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:20:36'),
(47, 'JCHEW2021047', 'QUADRI  ', 'AISHAT', 'OYINDAMOLA', 'Certificate in Community Health(JCHEW)', '8171858480', 'OYO', '200', 'Female', '8171858480', '8171858480', '8171858480', 'blank.jpg', '2024/2025', '0', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:20:36'),
(48, 'JCHEW2021048', 'TAJUDEEN', 'HASSANAT', 'OLAIDE', 'Certificate in Community Health(JCHEW)', '8029579189', 'OYO', '200', 'Female', '8029579189', '8029579189', '8029579189', 'blank.jpg', '2024/2025', '0', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:20:36'),
(49, 'JCHEW2021049', 'TAOFEEK', 'KUDIRAT', 'AJOKE', 'Certificate in Community Health(JCHEW)', '7061831844', 'KWARA', '200', 'Female', '7061831844', '7061831844', '7061831844', 'blank.jpg', '2024/2025', '0', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:20:36'),
(50, 'JCHEW2021050', 'TIJANI', 'NAFISAT', 'OPEYEMI', 'Certificate in Community Health(JCHEW)', '8127198454', 'OYO', '200', 'Female', '8127198454', '8127198454', '8127198454', 'blank.jpg', '2024/2025', '0', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:20:36'),
(51, 'CHEW2021001', 'ABDULMALIK', 'NAMEEROH', 'ADERONKE', 'Diploma in Community Health(CHEW)', '8162114712', 'OSUN', '300', 'Female', '8162114712', '8162114712', '8162114712', 'blank.jpg', '2024/2025', '2', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:59:36'),
(52, 'CHEW2021002', 'ABDULRASHEED', 'MARYAM', 'EJIDE', 'Diploma in Community Health(CHEW)', '8165822992', 'OYO', '300', 'Female', '8165822992', '8165822992', '8165822992', 'blank.jpg', '2024/2025', '2', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:45:08'),
(53, 'CHEW2021003', 'ADARAMOLA', 'TAIWO', 'ANUOLUWAPO', 'Diploma in Community Health(CHEW)', '8124851512', 'OYO', '300', 'Female', '8124851512', '8124851512', '8124851512', 'blank.jpg', '2024/2025', '2', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 03:04:50'),
(54, 'CHEW2021004', 'ADEBAYO', 'ROKIBAT', 'ADUNOLA', 'Diploma in Community Health(CHEW)', '8081906975', 'OYO', '300', 'Female', '8081906975', '8081906975', '8081906975', 'blank.jpg', '2024/2025', '2', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:44:57'),
(55, 'CHEW2021005', 'ADEBAYO', 'ABOSEDE', 'MARY', 'Diploma in Community Health(CHEW)', '9034970861', 'OYO', '300', 'Female', '9034970861', '9034970861', '9034970861', 'blank.jpg', '2024/2025', '0', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:20:36'),
(56, 'CHEW2021006', 'ADEDOJA', 'SULIAT', 'YETUNDE', 'Diploma in Community Health(CHEW)', '8111339696', 'OYO', '300', 'Female', '8111339696', '8111339696', '8111339696', 'blank.jpg', '2024/2025', '0', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:20:36'),
(57, 'CHEW2021007', 'ADEGBENJO', 'BOSE', 'JANET', 'Diploma in Community Health(CHEW)', '7058451738', 'OYO', '300', 'Female', '7058451738', '7058451738', '7058451738', 'blank.jpg', '2024/2025', '0', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:20:36'),
(58, 'CHEW2021008', 'ADEKUNLE', 'MARY', 'ABOSEDE', 'Diploma in Community Health(CHEW)', '9015236289', 'OYO', '300', 'Female', '9015236289', '9015236289', '9015236289', 'blank.jpg', '2024/2025', '0', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:20:36'),
(59, 'CHEW2021009', 'ADEKUNLE', 'FATAI', 'ABIODUN', 'Diploma in Community Health(CHEW)', '7034777500', 'OYO', '300', 'Male', '7034777500', '7034777500', '7034777500', 'blank.jpg', '2024/2025', '0', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:20:36'),
(60, 'CHEW2021010', 'ADEKUNLE', 'GLORY', 'ADEBOLA', 'Diploma in Community Health(CHEW)', '9046053650', 'OYO', '300', 'Female', '9046053650', '9046053650', '9046053650', 'blank.jpg', '2024/2025', '2', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:48:50'),
(61, 'CHEW2021011', 'ADEMOLA', 'ZAINAB', 'ABIDEMI', 'Diploma in Community Health(CHEW)', '7012310056', 'OYO', '300', 'Female', '7012310056', '7012310056', '7012310056', 'blank.jpg', '2024/2025', '1', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:27:23'),
(62, 'CHEW2021012', 'ADENIYI', 'OLUWAKEMI', 'OPEYEMI', 'Diploma in Community Health(CHEW)', '8034339981', 'OYO', '300', 'Female', '8034339981', '8034339981', '8034339981', 'blank.jpg', '2024/2025', '2', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:48:04'),
(63, 'CHEW2021013', 'ADENIYI', 'KAOSARA', 'WURAOLA', 'Diploma in Community Health(CHEW)', '8110601674', 'OSUN', '300', 'Female', '8110601674', '8110601674', '8110601674', 'blank.jpg', '2024/2025', '2', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:46:14'),
(64, 'CHEW2021014', 'ADEROJU', 'ROFIAT', 'OMOTOLA', 'Diploma in Community Health(CHEW)', '8112027411', 'OYO', '300', 'Female', '8112027411', '8112027411', '8112027411', 'blank.jpg', '2024/2025', '2', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:47:07'),
(65, 'CHEW2021015', 'ADESOLA', 'LYDIA', 'ADEDAPO', 'Diploma in Community Health(CHEW)', '8073817573', 'OYO', '300', 'Female', '8073817573', '8073817573', '8073817573', 'blank.jpg', '2024/2025', '2', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:45:45'),
(66, 'CHEW2021016', 'ADETOUN', 'RANTI', 'DORCAS', 'Diploma in Community Health(CHEW)', '9072138761', 'OYO', '300', 'Female', '9072138761', '9072138761', '9072138761', 'blank.jpg', '2024/2025', '1', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:37:20'),
(67, 'CHEW2021017', 'ADEYEMI', 'IKIMAT', 'BUKOLA', 'Diploma in Community Health(CHEW)', '7054864625', 'OYO', '300', 'Female', '7054864625', '7054864625', '7054864625', 'blank.jpg', '2024/2025', '0', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:20:36'),
(68, 'CHEW2021018', 'AJIKANLE', 'ABIDAT', 'OMOTAYO', 'Diploma in Community Health(CHEW)', '8116849257', 'OYO', '300', 'Female', '8116849257', '8116849257', '8116849257', 'blank.jpg', '2024/2025', '0', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:20:36'),
(69, 'CHEW2021019', 'AKINGBOYE', 'NAHEEMOT', 'OLABISI', 'Diploma in Community Health(CHEW)', '7089391251', 'OYO', '300', 'Female', '7089391251', '7089391251', '7089391251', 'blank.jpg', '2024/2025', '0', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:20:36'),
(70, 'CHEW2021020', 'AKINWUMI', 'OMOSHALEWA', 'AWAWU', 'Diploma in Community Health(CHEW)', '8167932434', 'OYO', '300', 'Female', '8167932434', '8167932434', '8167932434', 'blank.jpg', '2024/2025', '2', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:45:47'),
(71, 'CHEW2021021', 'ALABI', 'OLATOMIWA', 'MUMINAT', 'Diploma in Community Health(CHEW)', '8129703878', 'OYO', '300', 'Female', '8129703878', '8129703878', '8129703878', 'blank.jpg', '2024/2025', '0', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:20:36'),
(72, 'CHEW2021022', 'ALAO', 'OLUWAYOMI', 'ATOLANI', 'Diploma in Community Health(CHEW)', '8134628971', 'OYO', '300', 'Female', '8134628971', '8134628971', '8134628971', 'blank.jpg', '2024/2025', '0', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:20:36'),
(73, 'CHEW2021023', 'ARIYIBI', 'ESTHER', 'ABIODUN', 'Diploma in Community Health(CHEW)', '9056478473', 'OYO', '300', 'Female', '9056478473', '9056478473', '9056478473', 'blank.jpg', '2024/2025', '0', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:20:36'),
(74, 'CHEW2021024', 'AYODELE', 'IRETIAYO', 'JANET', 'Diploma in Community Health(CHEW)', '8035782870', 'OYO', '300', 'Female', '8035782870', '8035782870', '8035782870', 'blank.jpg', '2024/2025', '0', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:20:36'),
(75, 'CHEW2021025', 'AYUBA', 'MORENIKE', 'ROKIBA', 'Diploma in Community Health(CHEW)', '9093836062', 'OYO', '300', 'Female', '9093836062', '9093836062', '9093836062', 'blank.jpg', '2024/2025', '1', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:31:12'),
(76, 'CHEW2021026', 'BAKARE', 'OLAMIDE', 'GRACE', 'Diploma in Community Health(CHEW)', '8111171999', 'OYO', '300', 'Female', '8111171999', '8111171999', '8111171999', 'blank.jpg', '2024/2025', '0', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:20:36'),
(77, 'CHEW2021027', 'BASHIRU', 'AMINAT', 'OYINLOLA', 'Diploma in Community Health(CHEW)', '9041554393', 'OYO', '300', 'Female', '9041554393', '9041554393', '9041554393', 'blank.jpg', '2024/2025', '1', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:31:39'),
(78, 'CHEW2021028', 'BOLAJI', 'DAMILOLA', 'GRACE', 'Diploma in Community Health(CHEW)', '9072733563', 'OSUN', '300', 'Female', '9072733563', '9072733563', '9072733563', 'blank.jpg', '2024/2025', '2', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:45:19'),
(79, 'CHEW2021029', 'BUSARI', 'ADEOLA', 'NAFISAT', 'Diploma in Community Health(CHEW)', '9152265873', 'OYO', '300', 'Female', '9152265873', '9152265873', '9152265873', 'blank.jpg', '2024/2025', '0', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:20:36'),
(80, 'CHEW2021030', 'FAGBENRO', 'FUNMILAYO', 'GRACE', 'Diploma in Community Health(CHEW)', '9067526184', 'OYO', '300', 'Female', '9067526184', '9067526184', '9067526184', 'blank.jpg', '2024/2025', '0', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:20:36'),
(81, 'CHEW2021031', 'FAREMI', 'MARY', 'TEMITOPE', 'Diploma in Community Health(CHEW)', '7089494203', 'OYO', '300', 'Female', '7089494203', '7089494203', '7089494203', 'blank.jpg', '2024/2025', '0', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:20:36'),
(82, 'CHEW2021032', 'FOLORUNSO', 'BOLUWATIFE', 'VICTORIA', 'Diploma in Community Health(CHEW)', '8101307893', 'OYO', '300', 'Female', '8101307893', '8101307893', '8101307893', 'blank.jpg', '2024/2025', '2', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:45:27'),
(83, 'CHEW2021033', 'GANIYU', 'OMOWUMI', 'MARIAM', 'Diploma in Community Health(CHEW)', '7065477638', 'OYO', '300', 'Female', '7065477638', '7065477638', '7065477638', 'blank.jpg', '2024/2025', '0', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:20:36'),
(84, 'CHEW2021034', 'GBADEGESIN', 'OYINDAMOLA', 'DEBORAH', 'Diploma in Community Health(CHEW)', '8165941534', 'OYO', '300', 'Female', '8165941534', '8165941534', '8165941534', 'blank.jpg', '2024/2025', '0', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:20:36'),
(85, 'CHEW2021035', 'HAMZAT', 'WASILAT', 'OKIKIOLA', 'Diploma in Community Health(CHEW)', '8076914957', 'OYO', '300', 'Female', '8076914957', '8076914957', '8076914957', 'blank.jpg', '2024/2025', '2', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:47:50'),
(86, 'CHEW2021036', 'HANBAL', 'MUSLIMAH', 'ABIOLA', 'Diploma in Community Health(CHEW)', '8024108787', 'OYO', '300', 'Female', '8024108787', '8024108787', '8024108787', 'blank.jpg', '2024/2025', '0', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:20:36'),
(87, 'CHEW2021037', 'IBRAHIM', 'KHADIJAT', 'AJOKE', 'Diploma in Community Health(CHEW)', '9068457853', 'KOGI', '300', 'Female', '9068457853', '9068457853', '9068457853', 'blank.jpg', '2024/2025', '2', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:45:30'),
(88, 'CHEW2021038', 'IBRAHIM', 'FATIU', '', 'Diploma in Community Health(CHEW)', '7014472111', 'OYO', '300', 'Male', '7014472111', '7014472111', '7014472111', 'blank.jpg', '2024/2025', '2', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:56:32'),
(89, 'CHEW2021039', 'IDOWU', 'NOFISAT', 'ODUNAYO', 'Diploma in Community Health(CHEW)', '8129170087', 'OYO', '300', 'Female', '8129170087', '8129170087', '8129170087', 'blank.jpg', '2024/2025', '0', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:20:36'),
(90, 'CHEW2021040', 'ILUMOKA', 'PRECIOUS', 'ELIZABETH', 'Diploma in Community Health(CHEW)', '8148602024', 'OGUN', '300', 'Female', '8148602024', '8148602024', '8148602024', 'blank.jpg', '2024/2025', '0', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:20:36'),
(91, 'CHEW2021041', 'ISIAQ', 'FAOSIYAT', 'BIODUN', 'Diploma in Community Health(CHEW)', '8105885737', 'OYO', '300', 'Female', '8105885737', '8105885737', '8105885737', 'blank.jpg', '2024/2025', '2', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:45:38'),
(92, 'CHEW2021042', 'JIMOH', 'ROKIBAT', 'ABISOLA', 'Diploma in Community Health(CHEW)', '9035927914', 'OYO', '300', 'Female', '9035927914', '9035927914', '9035927914', 'blank.jpg', '2024/2025', '2', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:44:06'),
(93, 'CHEW2021043', 'JOHN', 'SHALOM', 'KEMI', 'Diploma in Community Health(CHEW)', '9073285894', 'OGUN', '300', 'Female', '9073285894', '9073285894', '9073285894', 'blank.jpg', '2024/2025', '2', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:44:15'),
(94, 'CHEW2021044', 'KAMORUDEEN', 'AISHAT', 'YETUNDE', 'Diploma in Community Health(CHEW)', '9074153561', 'OYO', '300', 'Female', '9074153561', '9074153561', '9074153561', 'blank.jpg', '2024/2025', '1', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:28:53'),
(95, 'CHEW2021045', 'KASALI', 'BILIKISU', 'OLANIKE', 'Diploma in Community Health(CHEW)', '8151583068', 'OYO', '300', 'Female', '8151583068', '8151583068', '8151583068', 'blank.jpg', '2024/2025', '0', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:20:36'),
(96, 'CHEW2021046', 'KOLAWOLE', 'BUKOLA', 'MARY', 'Diploma in Community Health(CHEW)', '9153037428', 'OYO', '300', 'Female', '9153037428', '9153037428', '9153037428', 'blank.jpg', '2024/2025', '1', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:27:59'),
(97, 'CHEW2021047', 'KOYI', 'OLUWAPELUMI', 'GRACE', 'Diploma in Community Health(CHEW)', '8107049690', 'OYO', '300', 'Female', '8107049690', '8107049690', '8107049690', 'blank.jpg', '2024/2025', '0', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:20:36'),
(98, 'CHEW2021048', 'MEGBATENIBI', 'OLASINBO', 'GLORIOUS', 'Diploma in Community Health(CHEW)', '7055658285', 'ONDO', '300', 'Female', '7055658285', '7055658285', '7055658285', 'blank.jpg', '2024/2025', '0', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:20:36'),
(99, 'CHEW2021049', 'MUFUTAU', 'BARAKAT', 'OPEYEMI', 'Diploma in Community Health(CHEW)', '8165541504', 'OYO', '300', 'Female', '8165541504', '8165541504', '8165541504', 'blank.jpg', '2024/2025', '0', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:20:36'),
(100, 'CHEW2021050', 'OBIUKWU', 'ZOE', 'SOPURUCHI', 'Diploma in Community Health(CHEW)', '8138312853', 'IMO', '300', 'Female', '8138312853', '8138312853', '8138312853', 'blank.jpg', '2024/2025', '0', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:20:36'),
(101, 'CHEW2021051', 'OGUNTADE', 'JULIHANNAH', 'TEMITOPE', 'Diploma in Community Health(CHEW)', '8113071435', 'OYO', '300', 'Female', '8113071435', '8113071435', '8113071435', 'blank.jpg', '2024/2025', '2', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:48:55'),
(102, 'CHEW2021052', 'OGUNTUASE', 'OLUWATOSIN', 'OLANIKE', 'Diploma in Community Health(CHEW)', '8157240457', 'EKITI', '300', 'Female', '8157240457', '8157240457', '8157240457', 'blank.jpg', '2024/2025', '0', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:20:36'),
(103, 'CHEW2021053', 'OJO', 'YETUNDE', 'BOLUWATIFE', 'Diploma in Community Health(CHEW)', '7055679952', 'OYO', '300', 'Female', '7055679952', '7055679952', '7055679952', 'blank.jpg', '2024/2025', '2', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:44:45'),
(104, 'CHEW2021054', 'OKUNADE', 'DEBORAH', 'ADEDAMOLA', 'Diploma in Community Health(CHEW)', '8022584107', 'OYO', '300', 'Female', '8022584107', '8022584107', '8022584107', 'blank.jpg', '2024/2025', '0', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:20:36'),
(105, 'CHEW2021055', 'OLADIPUPO', 'ESTHER', 'OLAIDE', 'Diploma in Community Health(CHEW)', '7035625876', 'OYO', '300', 'Female', '7035625876', '7035625876', '7035625876', 'blank.jpg', '2024/2025', '2', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 03:01:59'),
(106, 'CHEW2021056', 'Oladunni', 'Yewande', 'Bukola', 'Diploma in Community Health(CHEW)', '8147933935', 'ONDO', '300', 'Female', '8147933935', '8147933935', '8147933935', 'blank.jpg', '2024/2025', '2', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:50:12'),
(107, 'CHEW2021057', 'OLATINWO', 'TIMILEYIN', 'HANNAH', 'Diploma in Community Health(CHEW)', '8108215379', 'OYO', '300', 'Female', '8108215379', '8108215379', '8108215379', 'blank.jpg', '2024/2025', '0', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:20:36'),
(108, 'CHEW2021058', 'OLAWALE', 'ODUNOLA', 'SELIMOT', 'Diploma in Community Health(CHEW)', '7088159195', 'OYO', '300', 'Female', '7088159195', '7088159195', '7088159195', 'blank.jpg', '2024/2025', '1', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:38:43'),
(109, 'CHEW2021059', 'OLAWUYI', 'FAISAT', 'ADENIKE', 'Diploma in Community Health(CHEW)', '7087762133', 'OYO', '300', 'Female', '7087762133', '7087762133', '7087762133', 'blank.jpg', '2024/2025', '0', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:20:36'),
(110, 'CHEW2021060', 'OLAYIWOLA', 'KABIRAT', 'OMOWUNMI', 'Diploma in Community Health(CHEW)', '9019994147', 'OYO', '300', 'Female', '9019994147', '9019994147', '9019994147', 'blank.jpg', '2024/2025', '2', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:55:38'),
(111, 'CHEW2021061', 'OLOFINTOYE', 'IFEOLUWA', 'ESTHER', 'Diploma in Community Health(CHEW)', '8073722515', 'OYO', '300', 'Female', '8073722515', '8073722515', '8073722515', 'blank.jpg', '2024/2025', '0', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:20:36'),
(112, 'CHEW2021062', 'OLUBODE', 'IDOWU', 'VICTORIA', 'Diploma in Community Health(CHEW)', '9029281256', 'OYO', '300', 'Female', '9029281256', '9029281256', '9029281256', 'blank.jpg', '2024/2025', '0', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:20:36'),
(113, 'CHEW2021063', 'OLUWOLE', 'TOYIN', 'DAMILOLA', 'Diploma in Community Health(CHEW)', '8038713834', 'OYO', '300', 'Female', '8038713834', '8038713834', '8038713834', 'blank.jpg', '2024/2025', '0', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:20:36'),
(114, 'CHEW2021064', 'ONIOSUN', 'DEBORAH', 'OLUWAMAYOKUN', 'Diploma in Community Health(CHEW)', '8134997017', 'OYO', '300', 'Female', '8134997017', '8134997017', '8134997017', 'blank.jpg', '2024/2025', '2', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:55:38'),
(115, 'CHEW2021065', 'Opoola', 'Victor', 'Okikijesu', 'Diploma in Community Health(CHEW)', '9152594519', 'OYO', '300', 'Male', '9152594519', '9152594519', '9152594519', 'blank.jpg', '2024/2025', '1', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:27:12'),
(116, 'CHEW2021066', 'OYEOLA', 'VICTORIA', 'OLUWATOSIN', 'Diploma in Community Health(CHEW)', '8148468518', 'OYO', '300', 'Female', '8148468518', '8148468518', '8148468518', 'blank.jpg', '2024/2025', '2', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:45:32'),
(117, 'CHEW2021067', 'OYERO', 'ADEBIMPE', 'REBECCA', 'Diploma in Community Health(CHEW)', '8181133954', 'LAGOS', '300', 'Female', '8181133954', '8181133954', '8181133954', 'blank.jpg', '2024/2025', '2', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:49:19'),
(118, 'CHEW2021068', 'OYETUNDE', 'SAIDAT', 'ADESHEWA', 'Diploma in Community Health(CHEW)', '9026628706', 'OYO', '300', 'Female', '9026628706', '9026628706', '9026628706', 'blank.jpg', '2024/2025', '0', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:20:36'),
(119, 'CHEW2021069', 'QOMORUDEEN', 'MUTIYAT', 'TOLANI', 'Diploma in Community Health(CHEW)', '8023961302', 'OYO', '300', 'Female', '8023961302', '8023961302', '8023961302', 'blank.jpg', '2024/2025', '1', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:39:36'),
(120, 'CHEW2021070', 'ROTIMI', 'VICTORIA', 'IDOWU', 'Diploma in Community Health(CHEW)', '7081630614', 'LAGOS', '300', 'Female', '7081630614', '7081630614', '7081630614', 'blank.jpg', '2024/2025', '1', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:35:55'),
(121, 'CHEW2021071', 'SALAUDEEN', 'KERIMOT', 'OPEYEMI', 'Diploma in Community Health(CHEW)', '8166150275', 'KWARA', '300', 'Female', '8166150275', '8166150275', '8166150275', 'blank.jpg', '2024/2025', '1', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:37:51'),
(122, 'CHEW2021072', 'SANNI', 'BOLADE', 'TOLANI', 'Diploma in Community Health(CHEW)', '8032348006', 'OYO', '300', 'Female', '8032348006', '8032348006', '8032348006', 'blank.jpg', '2024/2025', '0', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:20:36'),
(123, 'CHEW2021073', 'SOLOMON', 'YETUNDE', 'OLAMIDE', 'Diploma in Community Health(CHEW)', '8114886132', 'OYO', '300', 'Female', '8114886132', '8114886132', '8114886132', 'blank.jpg', '2024/2025', '0', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:20:36'),
(124, 'CHEW2021074', 'SULAIMON', 'AZEEZAT', 'ABISOLA', 'Diploma in Community Health(CHEW)', '8154322661', 'OYO', '300', 'Female', '8154322661', '8154322661', '8154322661', 'blank.jpg', '2024/2025', '0', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:20:36'),
(125, 'CHEW2021075', 'TAIWO', 'SELIMOT', 'OLAWUMI', 'Diploma in Community Health(CHEW)', '9055011291', 'OYO', '300', 'Female', '9055011291', '9055011291', '9055011291', 'blank.jpg', '2024/2025', '2', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:46:10'),
(126, 'CHEW2021076', 'TAIWO', 'OREOLUWA', 'DEBORAH', 'Diploma in Community Health(CHEW)', '8120686232', 'OYO', '300', 'Female', '8120686232', '8120686232', '8120686232', 'blank.jpg', '2024/2025', '2', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:45:29'),
(127, 'CHEW2021105', 'AZEEZ', 'KHADIJAH', 'ABIKE', 'Diploma in Community Health(CHEW)', '8161651099', 'OSUN', '300', 'Female', '8161651099', '8161651099', '8161651099', 'blank.jpg', '2024/2025', '2', 0, 'student', '2024-05-31 02:20:36', '2024-05-31 02:54:58');

-- --------------------------------------------------------

--
-- Table structure for table `theory_answers`
--

CREATE TABLE `theory_answers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `examstatus` int(11) NOT NULL,
  `studentno` varchar(255) NOT NULL,
  `studentname` varchar(255) NOT NULL,
  `total_score` double NOT NULL,
  `no_of_qst` int(11) NOT NULL,
  `session1` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `upload_no_of_qst` int(11) NOT NULL,
  `level` varchar(255) NOT NULL,
  `exam_type` varchar(255) NOT NULL,
  `exam_category` varchar(255) NOT NULL,
  `exam_mode` varchar(255) NOT NULL,
  `course` varchar(255) NOT NULL,
  `semester` varchar(255) NOT NULL,
  `minute` int(11) NOT NULL,
  `hour` int(11) NOT NULL,
  `exam_date` date NOT NULL,
  `A1` int(11) DEFAULT NULL,
  `A2` int(11) DEFAULT NULL,
  `A3` int(11) DEFAULT NULL,
  `A4` int(11) DEFAULT NULL,
  `A5` int(11) DEFAULT NULL,
  `A6` int(11) DEFAULT NULL,
  `A7` int(11) DEFAULT NULL,
  `A8` int(11) DEFAULT NULL,
  `A9` int(11) DEFAULT NULL,
  `A10` int(11) DEFAULT NULL,
  `Q1` text DEFAULT NULL,
  `Q2` text DEFAULT NULL,
  `Q3` text DEFAULT NULL,
  `Q4` text DEFAULT NULL,
  `Q5` text DEFAULT NULL,
  `Q6` text DEFAULT NULL,
  `Q7` text DEFAULT NULL,
  `Q8` text DEFAULT NULL,
  `Q9` text DEFAULT NULL,
  `Q10` text DEFAULT NULL,
  `ANS1` text DEFAULT NULL,
  `ANS2` text DEFAULT NULL,
  `ANS3` text DEFAULT NULL,
  `ANS4` text DEFAULT NULL,
  `ANS5` text DEFAULT NULL,
  `ANS6` text DEFAULT NULL,
  `ANS7` text DEFAULT NULL,
  `ANS8` text DEFAULT NULL,
  `ANS9` text DEFAULT NULL,
  `ANS10` text DEFAULT NULL,
  `score1` double DEFAULT NULL,
  `score2` double DEFAULT NULL,
  `score3` double DEFAULT NULL,
  `score4` double DEFAULT NULL,
  `score5` double DEFAULT NULL,
  `score6` double DEFAULT NULL,
  `score7` double DEFAULT NULL,
  `score8` double DEFAULT NULL,
  `score9` double DEFAULT NULL,
  `score10` double DEFAULT NULL,
  `QT1` varchar(255) DEFAULT NULL,
  `QT2` varchar(255) DEFAULT NULL,
  `QT3` varchar(255) DEFAULT NULL,
  `QT4` varchar(255) DEFAULT NULL,
  `QT5` varchar(255) DEFAULT NULL,
  `QT6` varchar(255) DEFAULT NULL,
  `QT7` varchar(255) DEFAULT NULL,
  `QT8` varchar(255) DEFAULT NULL,
  `QT9` varchar(255) DEFAULT NULL,
  `QT10` varchar(255) DEFAULT NULL,
  `G1` varchar(255) DEFAULT NULL,
  `G2` varchar(255) DEFAULT NULL,
  `G3` varchar(255) DEFAULT NULL,
  `G4` varchar(255) DEFAULT NULL,
  `G5` varchar(255) DEFAULT NULL,
  `G6` varchar(255) DEFAULT NULL,
  `G7` varchar(255) DEFAULT NULL,
  `G8` varchar(255) DEFAULT NULL,
  `G9` varchar(255) DEFAULT NULL,
  `G10` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `theory_questions`
--

CREATE TABLE `theory_questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question_no` int(11) NOT NULL,
  `no_of_qst` int(11) NOT NULL,
  `session1` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `upload_no_of_qst` int(11) NOT NULL,
  `level` varchar(255) NOT NULL,
  `exam_type` varchar(255) NOT NULL,
  `exam_category` varchar(255) NOT NULL,
  `exam_mode` varchar(255) NOT NULL,
  `question_type` varchar(255) NOT NULL,
  `question` text NOT NULL,
  `graphic` varchar(255) NOT NULL,
  `course` varchar(255) NOT NULL,
  `semester` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_status` int(10) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `login_attempts` int(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_status`, `email_verified_at`, `password`, `remember_token`, `login_attempts`, `created_at`, `updated_at`) VALUES
(1, 'Admin CBT', 'admin@gmail.com', 1, NULL, '$2y$12$ZnTRyBs.WISiLa5h/2lwxu3.zl1UR6I8Jn8DftqX4I3swyQIHBQS2', NULL, 0, '2024-05-09 19:19:26', '2024-05-14 15:19:04'),
(2, 'Miracle Peters', 'miracle.kingsbranding@gmail.com', 1, NULL, '$2y$12$rVfbOFULxlRuqKriYbIFUO4HkJ7KLA8TZG0/hs9drngnYSUe7gkzG', NULL, 0, '2024-05-10 00:18:09', '2024-05-10 00:18:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academic_sessions`
--
ALTER TABLE `academic_sessions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cbt_classes`
--
ALTER TABLE `cbt_classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cbt_evaluation1`
--
ALTER TABLE `cbt_evaluation1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cbt_evaluation2`
--
ALTER TABLE `cbt_evaluation2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cbt_evaluations`
--
ALTER TABLE `cbt_evaluations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `college_setups`
--
ALTER TABLE `college_setups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam_settings`
--
ALTER TABLE `exam_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam_types`
--
ALTER TABLE `exam_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `failed_logins`
--
ALTER TABLE `failed_logins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loading_checks`
--
ALTER TABLE `loading_checks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `question_settings`
--
ALTER TABLE `question_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `software_version`
--
ALTER TABLE `software_version`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_admissions`
--
ALTER TABLE `student_admissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `student_admissions_admission_no_unique` (`admission_no`) USING HASH;

--
-- Indexes for table `theory_answers`
--
ALTER TABLE `theory_answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `theory_questions`
--
ALTER TABLE `theory_questions`
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
-- AUTO_INCREMENT for table `academic_sessions`
--
ALTER TABLE `academic_sessions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `cbt_classes`
--
ALTER TABLE `cbt_classes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `cbt_evaluation1`
--
ALTER TABLE `cbt_evaluation1`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `cbt_evaluation2`
--
ALTER TABLE `cbt_evaluation2`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `cbt_evaluations`
--
ALTER TABLE `cbt_evaluations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `college_setups`
--
ALTER TABLE `college_setups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `exam_settings`
--
ALTER TABLE `exam_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `exam_types`
--
ALTER TABLE `exam_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_logins`
--
ALTER TABLE `failed_logins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `loading_checks`
--
ALTER TABLE `loading_checks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `question_settings`
--
ALTER TABLE `question_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `software_version`
--
ALTER TABLE `software_version`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `student_admissions`
--
ALTER TABLE `student_admissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT for table `theory_answers`
--
ALTER TABLE `theory_answers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `theory_questions`
--
ALTER TABLE `theory_questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
