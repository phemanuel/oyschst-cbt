-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2024 at 11:03 PM
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
(1, NULL, 'AKINYOOYE AKINFEMI EMMANUEL', '0', '20', '0', '20221200', NULL, '100', '2024/2025', 'First', 0, 20, NULL, 'C', 'B', 'A', 'D', 'A', 'C', 'A', 'A', 'B', 'B', 'B', 'C', 'B', 'A', 'A', 'B', 'B', 'B', 'C', 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'ENTRANCE', NULL, '2024-05-16 22:34:39', 'ENTRANCE', '0', '2024-05-16 22:34:39', '2024-05-16 22:34:39', '2024-05-17 05:34:39', '2024-05-17 05:34:39');

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
(1, NULL, 'AKINYOOYE AKINFEMI EMMANUEL', '0', '20', '0', '20221200', NULL, '100', '2024/2025', 'First', 0, 20, NULL, 'A', 'C', 'D', 'A', 'B', 'Nill', 'Nill', 'Nill', 'Nill', 'Nill', 'D', 'A', 'Nill', 'Nill', 'C', 'Nill', 'Nill', 'Nill', 'Nill', 'Nill', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'ENTRANCE', '1', '2024-05-16 22:34:39', 'ENTRANCE', '0', '2024-05-16 22:34:39', '2024-05-16 22:34:39', '2024-05-17 05:34:39', '2024-05-18 03:26:05');

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
(1, '2', 'AKINYOOYE AKINFEMI EMMANUEL', '0', '20', '20', '20221200', NULL, '100', '2024/2025', 'First', 0, 0, NULL, 17, 10, 5, 6, 20, 15, 19, 3, 12, 18, 11, 2, 7, 13, 1, 9, 16, 4, 8, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Diploma in Community Health(CHEW)', 'OBJECTIVE', 'GENERAL', 'ENTRANCE', '1', '2024-05-16 22:34:39', 'ENTRANCE', '0', '2024-05-16 22:34:39', '2024-05-16 22:34:39', '2024-05-17 05:34:39', '2024-05-18 04:01:29');

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
(1, 'Oyo State College of Health Science and Technology', 'info@oyschst.edu.ng', 'college/avatar.jpg', '08035882299', 'Beside fan-milk, Eleyele,Ibadan, Oyo State', 'http://oyschst.edu.ng', '2024-05-10 03:04:36', '2024-05-10 04:16:59');

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
  `no_of_qst` int(11) NOT NULL,
  `check_result` int(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exam_settings`
--

INSERT INTO `exam_settings` (`id`, `level`, `course`, `session1`, `semester`, `department`, `exam_type`, `exam_category`, `exam_mode`, `time_limit`, `duration`, `no_of_qst`, `check_result`, `created_at`, `updated_at`) VALUES
(1, '100', 'ENTRANCE', '2024/2025', 'First', 'Diploma in Community Health(CHEW)', 'ENTRANCE', 'GENERAL', 'OBJECTIVE', 5, 20, 20, 1, '2024-05-01 19:33:35', '2024-05-18 03:03:09');

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
(3, 'SEMESTER-EXAM', '2024-05-12 05:47:19', '2024-05-12 05:47:19');

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
(22, '2024_05_14_110426_create_cbt_evaluation2s_table', 7);

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

INSERT INTO `questions` (`id`, `session1`, `department`, `level`, `course`, `exam_type`, `exam_mode`, `exam_category`, `no_of_qst`, `upload_no_of_qst`, `question_type`, `question_no`, `question`, `answer`, `graphic`, `created_at`, `updated_at`) VALUES
(1, '2024/2025', 'Certificate for  Medical Laboratory Technicians(MLT)', '100', 'ENTRANCE', 'ENTRANCE', 'OBJECTIVE', 'GENERAL', 10, 10, 'text', 1, '<p>Actions&nbsp; like&nbsp; blinking an eye, smiling, whistling, crying, walking, talking, eating and even praying described -----------<br />\r\n<br />\r\n(A) personality<br />\r\n<br />\r\n(B) conduct<br />\r\n<br />\r\n(C ) Emotion<br />\r\n<br />\r\n(D) none of the option</p>', 'D', 'blank.jpg', '2024-05-12 06:51:08', '2024-05-12 18:21:38'),
(2, '2024/2025', 'Certificate for  Medical Laboratory Technicians(MLT)', '100', 'ENTRANCE', 'ENTRANCE', 'OBJECTIVE', 'GENERAL', 10, 10, 'text', 2, '<p>Observable traits such as politeness, submissiveness, shyness, friendliness talkativeness and initiative are linked to<br />\r\n<br />\r\n(A) Behavior&nbsp;<br />\r\n<br />\r\n(B) Bioethics<br />\r\n<br />\r\n(C)Personality<br />\r\n<br />\r\n(D) A and C</p>', 'C', 'blank.jpg', '2024-05-12 06:51:08', '2024-05-12 18:22:05'),
(3, '2024/2025', 'Certificate for  Medical Laboratory Technicians(MLT)', '100', 'ENTRANCE', 'ENTRANCE', 'OBJECTIVE', 'GENERAL', 10, 10, 'text', 3, '<p>The repository of&nbsp; libido (life force) or unlearned psychological motives and unlearned primitive reactions or instinctual impulses for satisfying them<br />\r\n<br />\r\n(A) Ego<br />\r\n<br />\r\n(B) id<br />\r\n<br />\r\n(C) psychosexual<br />\r\n<br />\r\n(D) super Ego</p>', 'B', 'blank.jpg', '2024-05-12 06:51:08', '2024-05-12 18:33:53'),
(4, '2024/2025', 'Certificate for  Medical Laboratory Technicians(MLT)', '100', 'ENTRANCE', 'ENTRANCE', 'OBJECTIVE', 'GENERAL', 10, 10, 'text', 4, '<p>The&nbsp; felt tendency towards something intuitively assessed as good, favorable, beneficial, or a way from something assessed as unfavorable, harmful , and /or bad<br />\r\n<br />\r\n(A) perception<br />\r\n<br />\r\n(B) consciousness&nbsp;<br />\r\n<br />\r\n(c) Emotion<br />\r\n<br />\r\n(D) all&nbsp; the options</p>', 'A', 'blank.jpg', '2024-05-12 06:51:08', '2024-05-12 18:34:34'),
(5, '2024/2025', 'Certificate for  Medical Laboratory Technicians(MLT)', '100', 'ENTRANCE', 'ENTRANCE', 'OBJECTIVE', 'GENERAL', 10, 10, 'text', 5, '<p>Behavior that is meditated by reactions below the conscious level or genetically hard &ndash;wired behaviors&nbsp; that enhance one&rsquo;s ability to cope with vital environmental contingencies&nbsp; is<br />\r\n<br />\r\n(A) coping mechanism<br />\r\n<br />\r\n(B) decision<br />\r\n<br />\r\n(C) instincts<br />\r\n<br />\r\n(D) doges</p>', 'C', 'blank.jpg', '2024-05-12 06:51:08', '2024-05-12 18:34:52'),
(6, '2024/2025', 'Certificate for  Medical Laboratory Technicians(MLT)', '100', 'ENTRANCE', 'ENTRANCE', 'OBJECTIVE', 'GENERAL', 10, 10, 'text', 6, '<p>Physique, capabilities. Potentialities, deficiencies, impressions and the believes other have of him and his aspiration identities&nbsp; called ------<br />\r\n<br />\r\n(A) Self reliance<br />\r\n<br />\r\n(B) self actualization&nbsp;<br />\r\n<br />\r\n(C ) self concept<br />\r\n<br />\r\n(D) self esteem</p>', 'C', 'blank.jpg', '2024-05-12 06:51:08', '2024-05-12 18:38:10'),
(7, '2024/2025', 'Certificate for  Medical Laboratory Technicians(MLT)', '100', 'ENTRANCE', 'ENTRANCE', 'OBJECTIVE', 'GENERAL', 10, 10, 'text', 7, '<p>-------- could be defined as the outward expression of an inner feelings or effect, a stage of arousal characterized by alteration of feeling tone and by physiological behavioral changes.<br />\r\n<br />\r\n(A) attitude<br />\r\n<br />\r\n(B) behavior<br />\r\n<br />\r\n(C ) personality<br />\r\n<br />\r\n(D) emotion</p>', 'D', 'blank.jpg', '2024-05-12 06:51:08', '2024-05-12 18:38:59'),
(8, '2024/2025', 'Certificate for  Medical Laboratory Technicians(MLT)', '100', 'ENTRANCE', 'ENTRANCE', 'OBJECTIVE', 'GENERAL', 10, 10, 'text', 8, '<p>My lord will make a way for me where there is no way is viewed&nbsp; as<br />\r\n<br />\r\n(A) Pessimism<br />\r\n<br />\r\n(B) envious<br />\r\n<br />\r\n(C) Optimism<br />\r\n<br />\r\n(D) trusting</p>', 'C', 'blank.jpg', '2024-05-12 06:51:08', '2024-05-12 18:39:23'),
(9, '2024/2025', 'Certificate for  Medical Laboratory Technicians(MLT)', '100', 'ENTRANCE', 'ENTRANCE', 'OBJECTIVE', 'GENERAL', 10, 10, 'text', 9, '<p>-------is the unique and distinctive characteristics which set a person apart from another (A) attitude<br />\r\n<br />\r\n(B) idea<br />\r\n<br />\r\n(C ) personality<br />\r\n<br />\r\n(D) behavior</p>', 'C', 'blank.jpg', '2024-05-12 06:51:08', '2024-05-12 18:40:08'),
(10, '2024/2025', 'Certificate for  Medical Laboratory Technicians(MLT)', '100', 'ENTRANCE', 'ENTRANCE', 'OBJECTIVE', 'GENERAL', 10, 10, 'text', 10, '<p>School of hygiene now known as Oyo state&nbsp; college of Health Science and technology was founded ----<br />\r\n<br />\r\nA. 2 /5/1933<br />\r\n<br />\r\nB. 1 /5 / 1933<br />\r\n<br />\r\nC. 1 /4/1933<br />\r\n<br />\r\nD. 2 /5/1933</p>', 'C', 'blank.jpg', '2024-05-12 06:51:08', '2024-05-12 18:44:19'),
(62, '2024/2025', 'Certificate for Pharmacy Technicians', '100', 'ENTRANCE', 'ENTRANCE', 'OBJECTIVE', 'GENERAL', 20, 20, 'text', 1, '<p>Itemize the levels of classification of living thing in correct sequence.</p>\r\n\r\n<p>(A) kingdom, phylum, class, family, order, genus, species</p>\r\n\r\n<p>(B). Kingdom, phylum, class, order, family, specie, genus</p>\r\n\r\n<p>(C). Kingdom, phylum, class, order, family, genus, specie</p>\r\n\r\n<p>(D) Kingdom, phylum, class, order, genus, family, specie</p>', 'A', 'blank.jpg', '2024-05-14 01:38:44', '2024-05-14 01:44:12'),
(63, '2024/2025', 'Certificate for Pharmacy Technicians', '100', 'ENTRANCE', 'ENTRANCE', 'OBJECTIVE', 'GENERAL', 20, 20, 'text', 2, '<p>At the end of meosis, the parent cell produce??daughter cell</p>\r\n\r\n<p>(A) 5</p>\r\n\r\n<p>(B)2</p>\r\n\r\n<p>(C) 4</p>\r\n\r\n<p>(D) 6</p>', 'C', 'blank.jpg', '2024-05-14 01:38:44', '2024-05-14 01:39:22'),
(64, '2024/2025', 'Certificate for Pharmacy Technicians', '100', 'ENTRANCE', 'ENTRANCE', 'OBJECTIVE', 'GENERAL', 20, 20, 'text', 3, '<p>Mention the stages involve in the process of mitosis.</p>\r\n\r\n<p>(A). Interphase, prophase, metaphase, anaphase, telophase.</p>\r\n\r\n<p>(B). Prophase, interphase, telophase, metaphase, anaphase</p>\r\n\r\n<p>(C). Interphase, prophase, telophase, metaphase, anaphase</p>\r\n\r\n<p>(D). Telophase, interphase, prophase, metaphase, anaphase</p>', 'A', 'blank.jpg', '2024-05-14 01:38:44', '2024-05-14 01:39:31'),
(65, '2024/2025', 'Certificate for Pharmacy Technicians', '100', 'ENTRANCE', 'ENTRANCE', 'OBJECTIVE', 'GENERAL', 20, 20, 'text', 4, '<p>The process of photosynthesis starts in the...................and the.......................of the chloroplast</p>\r\n\r\n<p>(A). Stroma and thylakoid</p>\r\n\r\n<p>(B). Thylakoid and stroma</p>\r\n\r\n<p>(C). cytoplasm and mitochondria</p>\r\n\r\n<p>(D). Thylakoid and cytoplasm</p>', 'B', 'blank.jpg', '2024-05-14 01:38:44', '2024-05-14 01:39:54'),
(66, '2024/2025', 'Certificate for Pharmacy Technicians', '100', 'ENTRANCE', 'ENTRANCE', 'OBJECTIVE', 'GENERAL', 20, 20, 'text', 5, '<p>During...............stage of mitosis the chromosome arrange themselves at the equator on the spindle fibre at a point called centromere.</p>\r\n\r\n<p>(A) metaphase</p>\r\n\r\n<p>(B) Anaphase</p>\r\n\r\n<p>(C ) prophase</p>\r\n\r\n<p>(D) telophase</p>', 'A', 'blank.jpg', '2024-05-14 01:38:44', '2024-05-14 01:40:09'),
(67, '2024/2025', 'Certificate for Pharmacy Technicians', '100', 'ENTRANCE', 'ENTRANCE', 'OBJECTIVE', 'GENERAL', 20, 20, 'text', 6, '<p>A cell is the basic unit of a living things because it can carry out all life activities. The following are life activities performed by a cell, except............</p>\r\n\r\n<p>(A) Reproduction</p>\r\n\r\n<p>(B) Excretion</p>\r\n\r\n<p>(C) Digestion</p>\r\n\r\n<p>(D) Mileage</p>', 'D', 'blank.jpg', '2024-05-14 01:38:44', '2024-05-14 01:40:23'),
(68, '2024/2025', 'Certificate for Pharmacy Technicians', '100', 'ENTRANCE', 'ENTRANCE', 'OBJECTIVE', 'GENERAL', 20, 20, 'text', 7, '<p>............and.......................are among the renowned scientist who worked on revealing the existence of cell.</p>\r\n\r\n<p>(A) Robert Hooke, Ivan Pavlov</p>\r\n\r\n<p>(B) Mattias Scledien, Robert Hooke.</p>\r\n\r\n<p>(C) Mattias Scledien, Felix Hooke</p>\r\n\r\n<p>(D) Mattias Scledien, Robert Hooke</p>', 'B', 'blank.jpg', '2024-05-14 01:38:44', '2024-05-14 01:40:43'),
(69, '2024/2025', 'Certificate for Pharmacy Technicians', '100', 'ENTRANCE', 'ENTRANCE', 'OBJECTIVE', 'GENERAL', 20, 20, 'text', 8, '<p>Computer deals with two major things</p>\r\n\r\n<p>(A) Memory and Location</p>\r\n\r\n<p>(B) Process and Address</p>\r\n\r\n<p>(C ) Data and Instruction</p>\r\n\r\n<p>(D) Power and Data</p>', 'C', 'blank.jpg', '2024-05-14 01:38:44', '2024-05-14 01:40:52'),
(70, '2024/2025', 'Certificate for Pharmacy Technicians', '100', 'ENTRANCE', 'ENTRANCE', 'OBJECTIVE', 'GENERAL', 20, 20, 'text', 9, '<p>Parenchyma, collenchyma, xylem, phloem cells are examples of ..............</p>\r\n\r\n<p>(A) Animal cell</p>\r\n\r\n<p>(B) Plants cell</p>\r\n\r\n<p>(C) mitosis</p>\r\n\r\n<p>(D) meiosis</p>', 'B', 'blank.jpg', '2024-05-14 01:38:44', '2024-05-14 01:41:29'),
(71, '2024/2025', 'Certificate for Pharmacy Technicians', '100', 'ENTRANCE', 'ENTRANCE', 'OBJECTIVE', 'GENERAL', 20, 20, 'text', 10, '<p>Cell division is considered as reproduction to ...............organism and as growth to...................organism.</p>\r\n\r\n<p>(A) Multicellular, unicellular</p>\r\n\r\n<p>(B) Unicellular, Multicellular</p>\r\n\r\n<p>(C) mitosis, meosis</p>\r\n\r\n<p>(D) meosis, muiticellular</p>', 'B', 'blank.jpg', '2024-05-14 01:38:44', '2024-05-14 01:41:47'),
(72, '2024/2025', 'Certificate for Pharmacy Technicians', '100', 'ENTRANCE', 'ENTRANCE', 'OBJECTIVE', 'GENERAL', 20, 20, 'text', 11, '<p>The first group of people in the world that started speaking French is.........</p>\r\n\r\n<p>(A) Francois</p>\r\n\r\n<p>(B)Le Gaule</p>\r\n\r\n<p>(C)Le Faule</p>\r\n\r\n<p>(D) Le Francois.</p>', 'B', 'blank.jpg', '2024-05-14 01:38:44', '2024-05-14 01:41:58'),
(73, '2024/2025', 'Certificate for Pharmacy Technicians', '100', 'ENTRANCE', 'ENTRANCE', 'OBJECTIVE', 'GENERAL', 20, 20, 'text', 12, '<p>French language was introduced in Nigeria in the year .........</p>\r\n\r\n<p>(A)1951</p>\r\n\r\n<p>(B)1961</p>\r\n\r\n<p>(C)1959</p>\r\n\r\n<p>(D)1969</p>', 'B', 'blank.jpg', '2024-05-14 01:38:44', '2024-05-14 01:42:10'),
(74, '2024/2025', 'Certificate for Pharmacy Technicians', '100', 'ENTRANCE', 'ENTRANCE', 'OBJECTIVE', 'GENERAL', 20, 20, 'text', 13, '<p>The SD card is not a primary memory because</p>\r\n\r\n<p>(A) It is not useful in the process of booting</p>\r\n\r\n<p>(B) It uses RAM technology</p>\r\n\r\n<p>(C ) It has low storage capacity</p>\r\n\r\n<p>(D) It is a removable storage device</p>', 'A', 'blank.jpg', '2024-05-14 01:38:44', '2024-05-14 01:42:21'),
(75, '2024/2025', 'Certificate for Pharmacy Technicians', '100', 'ENTRANCE', 'ENTRANCE', 'OBJECTIVE', 'GENERAL', 20, 20, 'text', 14, '<p>C&#39;est Stylo.</p>\r\n\r\n<p>(A)un</p>\r\n\r\n<p>(B)de</p>\r\n\r\n<p>(C)des</p>\r\n\r\n<p>(D)une</p>', 'A', 'blank.jpg', '2024-05-14 01:38:44', '2024-05-14 01:42:31'),
(76, '2024/2025', 'Certificate for Pharmacy Technicians', '100', 'ENTRANCE', 'ENTRANCE', 'OBJECTIVE', 'GENERAL', 20, 20, 'text', 15, '<p>The concept of miniaturization was first introduced in the ........generation of computer</p>\r\n\r\n<p>(A) First Generation</p>\r\n\r\n<p>(B) Second Generation</p>\r\n\r\n<p>(C ) Third Generation</p>\r\n\r\n<p>(D) Fourth Generation</p>', 'C', 'blank.jpg', '2024-05-14 01:38:44', '2024-05-14 01:42:45'),
(77, '2024/2025', 'Certificate for Pharmacy Technicians', '100', 'ENTRANCE', 'ENTRANCE', 'OBJECTIVE', 'GENERAL', 20, 20, 'text', 16, '<p>Which of the following memory device is prominent in old computers</p>\r\n\r\n<p>(A) CD Card</p>\r\n\r\n<p>(B) Flash Drive</p>\r\n\r\n<p>(C ) Floppy Drive</p>\r\n\r\n<p>(D) BIOS</p>', 'B', 'blank.jpg', '2024-05-14 01:38:44', '2024-05-14 01:42:55'),
(78, '2024/2025', 'Certificate for Pharmacy Technicians', '100', 'ENTRANCE', 'ENTRANCE', 'OBJECTIVE', 'GENERAL', 20, 20, 'text', 17, '<p>Another word for: &quot;A toute a l&#39;heure&quot; is:..........</p>\r\n\r\n<p>(A)Abientot</p>\r\n\r\n<p>(B)Abien tot</p>\r\n\r\n<p>(C)A bientot</p>\r\n\r\n<p>(D) A biento</p>', 'C', 'blank.jpg', '2024-05-14 01:38:44', '2024-05-14 01:43:05'),
(79, '2024/2025', 'Certificate for Pharmacy Technicians', '100', 'ENTRANCE', 'ENTRANCE', 'OBJECTIVE', 'GENERAL', 20, 20, 'text', 18, '<p>How do we great a birthday celebrant in French?.......</p>\r\n\r\n<p>(A) Bonne anniverssaire</p>\r\n\r\n<p>(B)Bon anniversaire</p>\r\n\r\n<p>(C) Bonne anniversaire</p>\r\n\r\n<p>(D)Bon anniversary</p>', 'B', 'blank.jpg', '2024-05-14 01:38:44', '2024-05-14 01:43:16'),
(80, '2024/2025', 'Certificate for Pharmacy Technicians', '100', 'ENTRANCE', 'ENTRANCE', 'OBJECTIVE', 'GENERAL', 20, 20, 'text', 19, '<p>....................is the electronic board that serve as template for connection of other peripheral components of the computer</p>\r\n\r\n<p>(A) Motherboard</p>\r\n\r\n<p>(B) System Clock</p>\r\n\r\n<p>(C ) CMOS</p>\r\n\r\n<p>(D) Local Disk</p>', 'A', 'blank.jpg', '2024-05-14 01:38:44', '2024-05-14 01:43:29'),
(81, '2024/2025', 'Certificate for Pharmacy Technicians', '100', 'ENTRANCE', 'ENTRANCE', 'OBJECTIVE', 'GENERAL', 20, 20, 'text', 20, '<p>... garcon est beau (A)Le (B) L&#39; (C)La(D)Les</p>', 'A', 'blank.jpg', '2024-05-14 01:38:44', '2024-05-14 01:43:37'),
(142, '2024/2025', 'Diploma in Community Health(CHEW)', '100', 'ENTRANCE', 'ENTRANCE', 'OBJECTIVE', 'GENERAL', 20, 20, 'text-image', 1, '<p style=\"font-size: 24px; font-family: Arial;\">Itemize the levels of classification of living thing in correct sequence. (A) kingdom, phylum, class, family, order, genus, species (B). Kingdom, phylum, class, order, family, specie, genus (C). Kingdom, phylum, class, order, family, genus, specie (D) Kingdom, phylum, class, order, genus, family, specie</p>', 'A', '1715958659_1.jpg', '2024-05-17 04:51:53', '2024-05-17 22:10:59'),
(143, '2024/2025', 'Diploma in Community Health(CHEW)', '100', 'ENTRANCE', 'ENTRANCE', 'OBJECTIVE', 'GENERAL', 20, 20, 'text-image', 2, '<p style=\"font-size: 24px; font-family: Arial;\">&nbsp; At the end of meosis, the parent cell produce??daughter cell (A) 5 (B)2 (C) 4 (D) 6 &nbsp;</p>', 'C', '1715958771_2.jpg', '2024-05-17 04:51:53', '2024-05-17 22:12:51'),
(144, '2024/2025', 'Diploma in Community Health(CHEW)', '100', 'ENTRANCE', 'ENTRANCE', 'OBJECTIVE', 'GENERAL', 20, 20, 'text', 3, '<p style=\"font-size: 24px; font-family: Arial;\">Mention the stages involve in the process of mitosis. (A). Interphase, prophase, metaphase, anaphase, telophase. (B). Prophase, interphase, telophase, metaphase, anaphase (C). Interphase, prophase, telophase, metaphase, anaphase (D). Telophase, interphase, prophase, metaphase, anaphase</p>', 'A', 'blank.jpg', '2024-05-17 04:51:53', '2024-05-17 05:02:40'),
(145, '2024/2025', 'Diploma in Community Health(CHEW)', '100', 'ENTRANCE', 'ENTRANCE', 'OBJECTIVE', 'GENERAL', 20, 20, 'text', 4, '<p style=\"font-size: 24px; font-family: Arial;\">The process of photosynthesis starts in the..........and the....................of the chloroplast (A). Stroma and thylakoid (B). Thylakoid and stroma (C). cytoplasm and mitochondria (D). Thylakoid and cytoplasm</p>', 'B', 'blank.jpg', '2024-05-17 04:51:53', '2024-05-17 05:04:14'),
(146, '2024/2025', 'Diploma in Community Health(CHEW)', '100', 'ENTRANCE', 'ENTRANCE', 'OBJECTIVE', 'GENERAL', 20, 20, 'text', 5, '<p style=\"font-size: 24px; font-family: Arial;\">During.................stage of mitosis the chromosome arrange themselves at the equator on the spindle fibre at a point called centromere. (A) metaphase (B) Anaphase(C ) prophase (D) telophase</p>', 'A', 'blank.jpg', '2024-05-17 04:51:53', '2024-05-17 05:04:21'),
(147, '2024/2025', 'Diploma in Community Health(CHEW)', '100', 'ENTRANCE', 'ENTRANCE', 'OBJECTIVE', 'GENERAL', 20, 20, 'text', 6, '<p style=\"font-size: 24px; font-family: Arial;\">A cell is the basic unit of a living things because it can carry out all life activities. The following are life activities performed by a cell, except............... (A) Reproduction (B) Excretion (C) Digestion (D) Mileage</p>', 'D', 'blank.jpg', '2024-05-17 04:51:53', '2024-05-17 05:04:29'),
(148, '2024/2025', 'Diploma in Community Health(CHEW)', '100', 'ENTRANCE', 'ENTRANCE', 'OBJECTIVE', 'GENERAL', 20, 20, 'text', 7, '<p style=\"font-size: 24px; font-family: Arial;\">.................and.....................are among the renowned scientist who worked on revealing the existence of cell. (A) Robert Hooke, Ivan Pavlov (B) Mattias Scledien, Robert Hooke. (C) Mattias Scledien, Felix Hooke (D) Mattias Scledien, Robert Hooke</p>', 'B', 'blank.jpg', '2024-05-17 04:51:53', '2024-05-17 05:04:40'),
(149, '2024/2025', 'Diploma in Community Health(CHEW)', '100', 'ENTRANCE', 'ENTRANCE', 'OBJECTIVE', 'GENERAL', 20, 20, 'text', 8, '<p style=\"font-size: 24px; font-family: Arial;\">Computer deals with two major things (A) Memory and Location (B) Process and Address (C ) Data and Instruction (D) Power and Data</p>', 'C', 'blank.jpg', '2024-05-17 04:51:53', '2024-05-17 05:04:44'),
(150, '2024/2025', 'Diploma in Community Health(CHEW)', '100', 'ENTRANCE', 'ENTRANCE', 'OBJECTIVE', 'GENERAL', 20, 20, 'text', 9, '<p style=\"font-size: 24px; font-family: Arial;\">Parenchyma, collenchyma, xylem, phloem cells are examples of ................. (A) Animal cell (B) Plants cell (C) mitosis (D) meiosis</p>', 'B', 'blank.jpg', '2024-05-17 04:51:53', '2024-05-17 05:04:51'),
(151, '2024/2025', 'Diploma in Community Health(CHEW)', '100', 'ENTRANCE', 'ENTRANCE', 'OBJECTIVE', 'GENERAL', 20, 20, 'text', 10, '<p style=\"font-size: 24px; font-family: Arial;\">Cell division is considered as reproduction to .....................organism and as growth to.....................organism. (A) Multicellular, unicellular (B) Unicellular, Multicellular(C) mitosis, meosis (D) meosis, muiticellular</p>', 'B', 'blank.jpg', '2024-05-17 04:51:53', '2024-05-17 05:05:04'),
(152, '2024/2025', 'Diploma in Community Health(CHEW)', '100', 'ENTRANCE', 'ENTRANCE', 'OBJECTIVE', 'GENERAL', 20, 20, 'text', 11, '<p style=\"font-size: 24px; font-family: Arial;\">The first group of people in the world that started speaking French is......... (A) Francois (B)Le Gaule (C)Le Faule (D) Le Francois.</p>', 'B', 'blank.jpg', '2024-05-17 04:51:53', '2024-05-17 05:05:07'),
(153, '2024/2025', 'Diploma in Community Health(CHEW)', '100', 'ENTRANCE', 'ENTRANCE', 'OBJECTIVE', 'GENERAL', 20, 20, 'text', 12, '<p style=\"font-size: 24px; font-family: Arial;\">French language was introduced in Nigeria in the year ...... (A)1951 (B)1961 (C)1959 (D)1969</p>', 'B', 'blank.jpg', '2024-05-17 04:51:53', '2024-05-17 05:05:14'),
(154, '2024/2025', 'Diploma in Community Health(CHEW)', '100', 'ENTRANCE', 'ENTRANCE', 'OBJECTIVE', 'GENERAL', 20, 20, 'text', 13, '<p style=\"font-size: 24px; font-family: Arial;\">The SD card is not a primary memory because (A) It is not useful in the process of booting (B) It uses RAM technology (C ) It has low storage capacity (D) It is a removable storage device</p>', 'A', 'blank.jpg', '2024-05-17 04:51:53', '2024-05-17 05:05:17'),
(155, '2024/2025', 'Diploma in Community Health(CHEW)', '100', 'ENTRANCE', 'ENTRANCE', 'OBJECTIVE', 'GENERAL', 20, 20, 'text', 14, '<p style=\"font-size: 24px; font-family: Arial;\">C&#39;est Stylo. (A)un (B)de (C)des (D)une</p>', 'A', 'blank.jpg', '2024-05-17 04:51:53', '2024-05-17 05:05:20'),
(156, '2024/2025', 'Diploma in Community Health(CHEW)', '100', 'ENTRANCE', 'ENTRANCE', 'OBJECTIVE', 'GENERAL', 20, 20, 'text', 15, '<p style=\"font-size: 24px; font-family: Arial;\">The concept of miniaturization was first introduced in the .................generation of computer (A) First Generation (B) Second Generation(C ) Third Generation (D) Fourth Generation</p>', 'C', 'blank.jpg', '2024-05-17 04:51:53', '2024-05-17 05:05:27'),
(157, '2024/2025', 'Diploma in Community Health(CHEW)', '100', 'ENTRANCE', 'ENTRANCE', 'OBJECTIVE', 'GENERAL', 20, 20, 'text', 16, '<p style=\"font-size: 24px; font-family: Arial;\">Which of the following memory device is prominent in old computers (A) CD Card (B) Flash Drive (C ) Floppy Drive (D) BIOS</p>', 'B', 'blank.jpg', '2024-05-17 04:51:53', '2024-05-17 05:05:30'),
(158, '2024/2025', 'Diploma in Community Health(CHEW)', '100', 'ENTRANCE', 'ENTRANCE', 'OBJECTIVE', 'GENERAL', 20, 20, 'text', 17, '<p style=\"font-size: 24px; font-family: Arial;\">Another word for: &quot;A toute a l&#39;heure&quot; is:.......... (A)Abientot (B)Abien tot (C)A bientot (D) A biento</p>', 'C', 'blank.jpg', '2024-05-17 04:51:53', '2024-05-17 05:05:34'),
(159, '2024/2025', 'Diploma in Community Health(CHEW)', '100', 'ENTRANCE', 'ENTRANCE', 'OBJECTIVE', 'GENERAL', 20, 20, 'text', 18, '<p style=\"font-size: 24px; font-family: Arial;\">How do we great a birthday celebrant in French?....... (A) Bonne anniverssaire (B)Bon anniversaire (C) Bonne anniversaire (D)Bon anniversary</p>', 'B', 'blank.jpg', '2024-05-17 04:51:53', '2024-05-17 05:05:37'),
(160, '2024/2025', 'Diploma in Community Health(CHEW)', '100', 'ENTRANCE', 'ENTRANCE', 'OBJECTIVE', 'GENERAL', 20, 20, 'text', 19, '<p style=\"font-size: 24px; font-family: Arial;\">...................is the electronic board that serve as template for connection of other peripheral components of the computer (A) Motherboard (B) System Clock (C ) CMOS (D) Local Disk</p>', 'A', 'blank.jpg', '2024-05-17 04:51:53', '2024-05-17 05:05:46'),
(161, '2024/2025', 'Diploma in Community Health(CHEW)', '100', 'ENTRANCE', 'ENTRANCE', 'OBJECTIVE', 'GENERAL', 20, 20, 'text', 20, '<p style=\"font-size: 24px; font-family: Arial;\">....... garcon est beau (A)Le (B) L&#39; (C)La(D)Les</p>', 'A', 'blank.jpg', '2024-05-17 04:51:53', '2024-05-17 05:05:53');

-- --------------------------------------------------------

--
-- Table structure for table `question_settings`
--

CREATE TABLE `question_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `session1` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `course` varchar(255) NOT NULL,
  `no_of_qst` int(11) NOT NULL,
  `level` varchar(255) NOT NULL,
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

INSERT INTO `question_settings` (`id`, `session1`, `department`, `course`, `no_of_qst`, `level`, `duration`, `exam_type`, `exam_category`, `exam_status`, `exam_mode`, `exam_date`, `check_result`, `created_at`, `updated_at`) VALUES
(1, '2024/2025', 'Certificate for  Medical Laboratory Technicians(MLT)', 'ENTRANCE', 10, '100', 10, 'ENTRANCE', 'GENERAL', 'Inactive', 'OBJECTIVE', '2024-06-04', 0, '2024-05-12 06:51:08', '2024-05-14 02:05:15'),
(18, '2024/2025', 'Certificate for Pharmacy Technicians', 'ENTRANCE', 20, '100', 20, 'ENTRANCE', 'GENERAL', 'Inactive', 'OBJECTIVE', '2024-06-03', 0, '2024-05-14 01:38:44', '2024-05-15 04:15:24'),
(22, '2024/2025', 'Diploma in Community Health(CHEW)', 'ENTRANCE', 20, '100', 20, 'ENTRANCE', 'GENERAL', 'Active', 'OBJECTIVE', '2024-06-04', 1, '2024-05-17 04:51:53', '2024-05-17 04:57:08');

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
(1, '20240082', 'ADEBAYO', 'PEACE', 'ADEDAMOLA', 'Diploma in Community Health(CHEW)', '7082286605', 'OYO', '100', 'Male', '7082286605', '7082286605', '7082286605', '20240082.jpg', '2023/2024', '1', 0, 'student', '2024-05-09 19:19:26', '2024-05-11 02:57:03'),
(2, '20240001', 'OJO', 'SARAH', 'KIKELOMO', 'Certificate for  Medical Laboratory Technicians(MLT)', '7052176722', 'DELTA', '100', 'Female', '7069637771', '7052176722', '7052176722', '20240001.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(3, '20240002', 'OSHIOMOGHO', 'LOVINA', '  ', 'Diploma in Community Health(CHEW)', '9067332202', 'EDO', '100', 'Female', '7055127094', '9067332202', '9067332202', '20240002.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(4, '20240003', 'IYIOLA', 'OYINDAMOLA', 'KAUSARA', 'Diploma for Health Technicians(DE)', '8050846795', 'OSUN', '100', 'Female', '8119461710', '8050846795', '8050846795', '20240003.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(5, '20240004', 'ADISA', 'OLUWADAMILOLA', 'ANUOLUWAPO', 'Professional Diploma in Health Information Management', '8024745930', 'OSUN', '100', 'Female', '8138504262', '8024745930', '8024745930', '20240004.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(6, '20240005', 'Ademola ', 'Roqeebah ', 'Adesola ', 'Diploma in Community Health(CHEW)', '8159010033', 'OYO', '100', 'Female', '9132476587', 'Ademola Roqeebah adesola ', 'Adex2sola.', '20240005.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(7, '20240006', 'MOSES', 'THERESA', 'BOLAWA', 'Diploma in Community Health(CHEW)', '9068268581', 'ONDO', '100', 'Female', '7035533177', '9068268581', '9068268581', '20240006.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(8, '20240007', 'YUSUFF', 'MARIAM', 'OPEYEMI', 'Certificate in Community Health(JCHEW)', '8064175589', 'OYO', '100', 'Female', '8038569053', 'YUSUFFMARIAMOPEYEMI', 'Yusuff@2024', '20240007.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(9, '20240008', 'JAYEOLA', 'ZAINAB', 'ABIODUN', 'Diploma in Community Health(CHEW)', '7048203315', 'OYO', '100', 'Female', '8062205539', '7048203315', '7048203315', '20240008.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(10, '20240009', 'TAJUDEEN', 'OLUWATOBILOBA', 'OPEYEMI', 'Certificate for Pharmacy Technicians', '8050600699', 'OSUN', '100', 'Female', '8057584500', '8050600699', '8050600699', '20240009.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(11, '20240010', 'RAJI', 'MORUFAT', 'OMOLADE', 'Certificate in Community Health(JCHEW)', '9155184725', 'OYO', '100', 'Female', '8133081076', '9155184725', '9155184725', '20240010.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(12, '20240011', 'OYEDIRAN', 'OLUWABUKOLA', 'OYENIKE', 'Diploma in Community Health(CHEW)(DE)', '9073833369', 'OYO', '200', 'Female', '9073833369', '9073833369', '9073833369', '20240011.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(13, '20240012', 'NWANKWO', 'CHRISTIANAH', 'SABELLA', 'ND(WAHEB) in Environmental Health Technology', '7015384476', 'ENUGU', 'NDI', 'Female', '8032348425', '7015384476', '7015384476', '20240012.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(14, '20240013', 'Emmanuel ', 'Ayodeji', 'Daniel ', 'Certificate for Pharmacy Technicians', '7049255043', 'OSUN', '100', 'Male', '7042595699', 'Ayodeji448', 'marlians448@', '20240013.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(15, '20240014', 'OLUSOGA', 'HALIMAT', 'MOTUNRAYO', 'Certificate in Community Health(JCHEW)', '8024588808', 'OGUN', '100', 'Female', '9043823099', '8024588808', '8024588808', '20240014.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(16, '20240015', 'OGUNBUNMI', 'HAPPINESS', 'OLUWAFEMI', 'ND in Environmental Health Technology', '9032838036', 'OYO', 'NDI', 'Female', '8065333339', 'Ogunbunmi Happiness', '123456789', '20240015.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(17, '20240016', 'ADELEKE', 'OLUWASEYI', 'FLORENCE', 'ND in Environmental Health Technology', '9025255205', 'OYO', 'NDI', 'Female', '8063435857', 'Adeleke Oluwaseyi', '123456789', '20240016.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(18, '20240017', 'Gilbert', 'Happiness', 'Ebunoluwa', 'Certificate for  Medical Laboratory Technicians(MLT)', '9119461742', 'ONDO', '100', 'Female', '8062979492', 'happinessgilbert026@gmail.com', '9119461742', '20240017.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(19, '20240018', 'ADESINA', 'BISOLA', 'BUKOLA', 'Certificate for Health Assistants', '8138995071', 'OYO', '100', 'Female', '7065293947', '8138995071', '8138995071', '20240018.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(20, '20240019', 'ABIONA ', 'OLUWAGBEMISOLA', 'HAPPINESS', 'Diploma in Community Health(CHEW)', '9131719173', 'EKITI', '100', 'Female', '8130593887', 'OLUWAFUNTO', 'Happi03@.', '20240019.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(21, '20240020', 'AJALA', 'DEBORAH', 'IYANUOLUWA', 'Diploma in Community Health(CHEW)', '9052405947', 'OYO', '100', 'Female', '8067694800', '9052405947', '9052405947', '20240020.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(22, '20240021', 'LIADI', 'SULIAT', 'ADEBOLA', 'Diploma in Community Health(CHEW)', '8119966009', 'OYO', '100', 'Female', '8119966209', '8119966009', '8119966009', '20240021.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(23, '20240022', 'SALAKO', 'DORCAS', 'IYANUOLUWA', 'Professional Diploma in Health Information Management', '', 'OYO', '100', '', '', 'DORCAS2024', 'DORCAS2024', '20240022.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(24, '20240023', 'ADEKANMBI', 'TAIWO', 'QUADIRAT', 'Certificate for  Medical Laboratory Technicians(MLT)', '9150960193', 'OYO', '100', 'Female', '8144605119', '9150960193', '9150960193', '20241206.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(25, '20240024', 'FAWOLE', 'MARY', 'BOWOFOLA', 'Diploma for Health Technicians', '9037473908', 'OYO', '100', 'Female', '8035852186', '9037473908', '9037473908', '20240024.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(26, '20240025', 'YUSUFF', 'FATIMAH', 'AYOKA', 'Diploma in Community Health(CHEW)', '7061456649', 'OYO', '100', 'Female', '8036215131', 'FATIMAH2004', 'ayoka2004', '20240025.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(27, '20240026', 'AJAYI', 'RACHEAL', 'OMOMOLAWA', 'Certificate for Pharmacy Technicians', '8029857066', 'OGUN', '100', 'Female', '8028419389', '8029857066', '8029857066', '20240026.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(28, '20240027', 'ABDULRAHEEM', 'FAIDAT', 'ADERONKE', 'Diploma in Community Health(CHEW)', '7047267597', 'OYO', '100', 'Female', '8111569650', '7047267597', '7047267597', '20240027.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(29, '20240028', 'OLASUPO', 'GRACE', 'ANUOLUWAPO', 'Diploma in Community Health(CHEW)', '8156201561', 'OYO', '100', 'Female', '7039392064', '8156201561', '8156201561', '20240028.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(30, '20240029', 'YEKIN', 'KOFOWOROLA', 'OYINKANSOLA', 'Diploma for Health Technicians(DE)', '9036247287', 'OGUN', '100', 'Female', '8023627420', '9036247287', '9036247287', '20240029.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(31, '20240030', 'Abidoye', 'Rofiyat', 'Abike', 'Professional Certificate in Medical Image Processing/X-ray Technician', '8061171424', 'OSUN', '100', 'Female', '8.06E+11', 'Abidoye', '8061171424', '20240030.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(32, '20240031', 'Okpubigho ', 'Courage', 'Akpevweoghene', 'Certificate for  Medical Laboratory Technicians(MLT)', '9043278035', 'OYO', '100', 'Female', '9136564166', 'Okpubigho20', 'okp', '20240031.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(33, '20240032', 'IDOWU', 'CHRISTIANAH', 'OLUWAFERANMI', 'Diploma in Community Health(CHEW)', '7032374404', 'OYO', '100', 'Female', '9123813864', '7032374404', '7032374404', '20240032.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(34, '20240033', 'MUKAILA', 'KAOSARA', 'IYABODE', 'Diploma in Community Health(CHEW)', '8076700015', 'OYO', '100', 'Female', '8051475042', '8076700015', '8076700015', '20240033.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(35, '20240034', 'AMOO', 'JOSEPH', 'IYANUOLUWA', 'Certificate for  Medical Laboratory Technicians(MLT)', '7030671729', 'OYO', '100', 'Male', '8070604480', '7030671729', 'Happy01#', '20240034.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(36, '20240035', 'OLAGBENRO', 'TAIWO', 'OMOBOLANLE', 'Diploma in Community Health(CHEW)', '9049030119', 'OYO', '100', 'Female', '8025912200', '9049030119', '9049030119', '20240035.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(37, '20240036', 'ADELEKE', 'DORCAS', 'IBUKUNOLUWA', 'Diploma in Community Health(CHEW)', '7019440184', 'OYO', '100', 'Female', '8060707854', '7019440184', '7019440184', '20240036.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(38, '20240037', 'ALAMU', 'JESUNIFEMI', 'CHRISTIANA', 'Diploma in Community Health(CHEW)', '8026300932', 'OYO', '100', 'Female', '8028998667', '8026300932', '8026300932', '20240037.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(39, '20240038', 'OLABAMIJI', 'AYOMIDE', 'OLUWADAMILOLA', 'Certificate for  Medical Laboratory Technicians(MLT)', '9049164254', 'OYO', '100', 'Female', '9055956930', '9049164254', '9049164254', '20240038.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(40, '20240039', 'AFOLABI', 'ABOSEDE', 'TOSIN', 'Diploma in Community Health(CHEW)', '7039741101', 'OSUN', '100', 'Female', '8144764025', '7039741101', '7039741101', '20240039.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(41, '20240040', 'ABDULSALAM', 'FATHIA', 'MOSUNMOLA', 'Diploma in Community Health(CHEW)', '8149017102', 'OGUN', '100', 'Female', '8025500684', '8149017102', '8149017102', '20240040.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(42, '20240042', 'OSO', 'OYINKANSOLA', 'OLUWAPELUMI', 'Diploma in Community Health(CHEW)', '9161636112', 'ONDO', '100', 'Female', '7066692671', '9161636112', '9161636112', '20240042.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(43, '20240043', 'ADISA ', 'SULIYAT', 'OPEYEMI', 'Diploma in Community Health(CHEW)', '9048704811', 'OYO', '100', 'Female', '8071105856', '9048704811', '9048704811', '20240043.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(44, '20240044', 'OYELAYO ', 'CHRISTIANA', 'TEMITOPE', 'Certificate in Community Health(JCHEW)', '7039607967', 'OYO', '100', 'Female', '9134721971', '7039607967', '7039607967', '20240044.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(45, '20240045', 'ADEROGBA', 'OYETOLA', 'MARY', 'Diploma in Community Health(CHEW)', '9130596479', 'OYO', '100', 'Female', '9130596479', '9130596479', '9130596479', '20240045.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(46, '20240046', 'ABDULAZEEZ', 'SHUKURAT', 'AYOMIDE', 'Certificate in Community Health(JCHEW)', '9048591530', 'OYO', '100', 'Female', '9058988483', '9048591530', '9048591530', '20240046.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(47, '20240047', 'AKINOLA', 'FEMI', 'JOHN', 'Certificate for Pharmacy Technicians', '9052911606', 'OYO', '100', 'Male', '8052166060', '9052911606', '9052911606', '20240047.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(48, '20240048', 'ABDUL-FATAI', 'SOFIYAT', 'AJOKE', 'Diploma in Community Health(CHEW)', '8122120019', 'OYO', '100', 'Female', '8062302695', '8122120019', '8122120019', '20240048.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(49, '20240049', 'BANKOLE', 'MAYOWA', 'DEBORAH', 'Certificate for  Medical Laboratory Technicians(MLT)', '9028816810', 'OYO', '100', 'Female', '9169596794', '9028816810', '9028816810', '20240049.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(50, '20240050', 'PETER', 'DUPE', 'PAULINA', 'Diploma in Community Health(CHEW)', '9115410264', 'BENUE', '100', 'Female', '7038642239', '9115410264', '9115410264', '20240050.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(51, '20240051', 'Olaniyi', 'Zainab ', 'Olaitan', 'Certificate for  Medical Laboratory Technicians(MLT)', '9135189878', 'OYO', '100', 'Female', '9164963167', 'Olaitanolaniyi', 'olaniyi12.', '20240051.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(52, '20240052', 'ADEYEMO', 'MARIAM', 'ARIKE', 'Certificate for Pharmacy Technicians', '9050602804', 'OYO', '100', 'Female', '8133438935', '9050602804', '9050602804', '20240052.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(53, '20240053', 'AKINBAMIJI', 'FUNMILAYO', 'DEBORAH', 'Diploma in Community Health(CHEW)', '9012905932', 'OYO', '100', 'Female', '7051371668', '9012905932', '9012905932', '20240053.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(54, '20240054', 'SALAUDEEN', 'ALIYAH', 'TEMILOLUWA', 'Diploma in Community Health(CHEW)', '8066071094', 'OYO', '100', 'Female', '7035569886', '8066071094', '8066071094', '20240054.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(55, '20240055', 'ORABIYI', 'RACHEAL', 'OLUWAFUNMILAYO', 'Diploma in Community Health(CHEW)', '7066121623', 'OSUN', '100', 'Female', '8076858385', '7066121623', '7066121623', '20240055.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(56, '20240056', 'KAREEM', 'OLABISI', 'ZAINAB', 'Diploma in Community Health(CHEW)', '8167651571', 'OYO', '100', 'Female', '9079882030', '8167651571', '8167651571', '20240056.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(57, '20240057', 'AGBEDEYI', 'TOLANI', 'ELIZABETH', 'Diploma in Community Health(CHEW)', '8153281778', 'OYO', '100', 'Female', '8088003491', '8153281778', '8153281778', '20240057.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(58, '20240058', 'OGUNGBENRO', 'CHRISTIANAH', 'ADEDOYIN', 'Certificate for  Medical Laboratory Technicians(MLT)', '9151820726', 'OYO', '100', 'Female', '8123020699', '9151820726', '9151820726', '20240058.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(59, '20240059', 'ABDULAZEEZ', 'BASIRAT', 'OMOLOLA', 'Diploma in Community Health(CHEW)', '9063718311', 'OSUN', '100', 'Female', '8124378984', '9063718311', '9063718311', '20240059.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(60, '20240060', 'ADENIJI', 'OMOTOYOSI', 'OLAYINKA', 'Diploma in Community Health(CHEW)(DE)', '8055684770', 'OYO', '200', 'Female', '8079936564', 'ADENIJIOMOTOYOSI', 'ADENIJIOMOTOYOSI', '20240060.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(61, '20240061', 'OLAMIDE', 'VICTORIA', 'ADENIKE', 'Certificate for  Medical Laboratory Technicians(MLT)', '9042902153', 'OGUN', '100', 'Female', '8034829144', '8034829144', '8034829144', '20240061.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(62, '20240062', 'ADEBANJO', 'MARY', 'ADEFUNKE', 'Professional Certificate in Medical Image Processing/X-ray Technician', '9028405807', 'OSUN', '100', 'Female', '90588121555', '9028405807', '9028405807', '20240062.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(63, '20240063', 'ADEDEJI', 'ALIMOT', 'ABIKE', 'Certificate in Community Health(JCHEW)', '9162744466', 'OYO', '100', 'Female', '8022574590', '9162744466', '9162744466', '20240063.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(64, '20240064', 'OGUNJIMI', 'DORCAS', 'MOYINOLUWA', 'Certificate for Pharmacy Technicians', '9138622133', 'OYO', '100', 'Female', '7033765454', '9138622133', '9138622133', '20240064.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(65, '20240065', 'AMBALI', 'BARAKAT', '', 'Diploma for Health Technicians', '7015811345', 'OYO', '100', 'Female', '8157404433', '7015811345', '7015811345', '20240065.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(66, '20240066', 'SOLA-AKINTUNDE', 'ELIZABETH', 'BOLANLE', 'Professional Certificate in Medical Image Processing/X-ray Technician', '9112967455', 'ONDO', '100', 'Female', '81070667635', '9112967455', '9112967455', '20240066.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(67, '20240067', 'SMITH', 'FAISAT', 'OMOWUNMI', 'Professional Diploma in Health Information Management', '8154196015', 'OYO', '100', 'Female', '9074207549', '8154196015', '8154196015', '20240067.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(68, '20240068', 'OGUNGBENRO', 'TAIWO', 'SERAH', 'Diploma in Community Health(CHEW)(DE)', '9070971974', 'OYO', '200', 'Female', '8149497406', '9070971974', '9070971974', '20240068.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(69, '20240069', 'TAIWO', 'EMMANULE', 'OMOTAYO', 'Certificate for Pharmacy Technicians', '7033404380', 'OSUN', '100', 'Male', '7068406185', '7033404380', '7033404380', '20240069.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(70, '20240070', 'BABATUNDE', 'AYOMIDE', 'EMMANUEL', 'Certificate for Pharmacy Technicians', '8138101061', 'OYO', '100', 'Male', '8023510286', '8138101061', '8138101061', '20240070.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(71, '20240071', 'SALAMI', 'AYOMIDE', 'ELIZABETH', 'Diploma in Community Health(CHEW)', '7015326357', 'OGUN', '100', 'Female', '8069421660', 'salami ayomide', 'salami', '20240071.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(72, '20240072', 'ALAYO', 'KAOSARAT', 'ABIDEMI', 'Diploma in Community Health(CHEW)', '8119828921', 'OYO', '100', 'Female', '9016950221', '8119828921', '8119828921', '20240072.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(73, '20240073', 'AJIBADE', 'OLAOLUWATOMIWA', 'PRAISE', 'Diploma for Health Technicians(DE)', '8160123811', 'OGUN', '100', 'Female', '8160123811', '8160123811', '8160123811', '20240073.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(74, '20240074', 'SOLOMON', 'OYINDAMOLA', 'SEMILORE', 'Diploma in Community Health(CHEW)', '9121822599', 'ONDO', '100', 'Female', '8053677709', '9121822599', '9121822599', '20241208.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(75, '20240075', 'JULIUS', 'MICHAEL', 'OLUWADAMILARE', 'Certificate for Pharmacy Technicians', '9028234245', 'OYO', '100', 'Male', '8024727716', '9028234245', '9028234245', '20241209.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(76, '20240076', 'EMMANUEL', 'OMOWUMI', 'CHRISTIANAH', 'Diploma in Community Health(CHEW)', '8067290091', 'ONDO', '100', 'Female', '7056105841', '8067290091', '8067290091', '20241210.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(77, '20240077', 'AYANWALE', 'SOFIAT', 'ADEKEMI', 'Diploma for Health Technicians', '9074094099', 'OYO', '100', 'Female', '8102906690', '9074094099', '9074094099', '20241211.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(78, '20240078', 'ADEYEMI', 'AMINAT', 'OMOWUMI', 'Diploma for Health Technicians', '8169517211', 'OYO', '100', 'Female', '8039263512', '8169517211', '8169517211', '20241212.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(79, '20240079', 'TAOFEEK', 'NAIMOT', 'ADEDOLAPO', 'Diploma in Community Health(CHEW)', '8084208072', 'OYO', '100', 'Female', '8051380581', '8084208072', '8084208072', '20241213.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(80, '20240080', 'Adetimilehin ', 'Sunday ', 'Bolu', 'Certificate for  Medical Laboratory Technicians(MLT)', '9150979795', 'OSUN', '100', 'Male', '8104600110', 'Sunbaby288', 'sasuke288', '20241214.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(81, '20240081', ' ALASA ', ' OMOHRIWO ', ' RALIAT', 'Diploma in Community Health(CHEW)', '7019363832', 'EDO', '100', 'Female', '8025579163', '7019363832', '7019363832', '20241215.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(82, '20240083', 'OYEBODE', 'KAOSARAT', 'SUBUOLA', 'Diploma in Community Health(CHEW)', '9019328997', 'OYO', '100', 'Female', '7065412185', '9019328997', '9019328997', '20240083.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(83, '20240085', 'ABIDOYE', 'AMINAT', 'KIKELOMO', 'Diploma in Community Health(CHEW)', '9157278518', 'OYO', '100', 'Female', '8055948825', '9157278518', '9157278518', '20241208.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(84, '20240086', 'KATEYEYANJUE', 'ALIMAH', 'ADEDIWURA', 'Diploma in Community Health(CHEW)', '8020525957', 'OSUN', '100', 'Female', '8059992629', '8020525957', '8020525957', '20240086.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(85, '20240087', 'MONDAY', 'CHRISTIAN', 'AJIMA', 'Diploma in Community Health(CHEW)', '7051964293', 'OYO', '100', 'Male', '9031280243', '7051964293', '7051964293', '20240087.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(86, '20240088', 'MORAWO', 'OLUWABUKOLA ', 'RUTH', 'Diploma in Community Health(CHEW)(DE)', '9015472760', 'OYO', '200', 'Female', '8141173822', '9015472760', '9015472760', '20240088.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(87, '20240089', 'SALAM', 'ATINUKE', 'OLAJUMOKE', 'Certificate for  Medical Laboratory Technicians(MLT)', '8123370056', 'OYO', '100', 'Female', '9028269291', '8123370056', '8123370056', '20240089.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(88, '20240090', 'OLAJIDE', 'JANET', 'OLUWAFUNMILAYO', 'Certificate for Pharmacy Technicians', '7068853118', 'OYO', '100', 'Female', '8169164171', '7068853118', '7068853118', '20240090.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(89, '20240091', 'BABALOLA', 'TEMILADE', 'AMINAT', 'Certificate in Community Health(JCHEW)', '7044356449', 'OYO', '100', 'Female', '8062913531', '7044356449', '7044356449', '20240091.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(90, '20240092', 'ADELEKE', 'AYOOLUWA', 'RIDWAN', 'Certificate for  Medical Laboratory Technicians(MLT)', '9162244481', 'OSUN', '100', 'Male', '9051509114', 'ayooluwa2024', 'Adeleke1@', '20240092.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(91, '20240093', 'ARUOTURE', 'STELLA', 'TINA', 'Diploma for Health Technicians', '9152426690', 'DELTA', '100', 'Female', '8069637384', '9152426690', '9152426690', '20240093.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(92, '20240094', 'ADEOYE', 'CHRISTOPHER', 'JADESOLA', 'Diploma in Community Health(CHEW)', '8154178334', 'OYO', '100', 'Male', '7033896257', '8154178334', '8154178334', '20240094.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(93, '20240095', 'LAWAL', 'MARY', 'VICTORIA', 'Diploma in Community Health(CHEW)', '7069133573', 'OYO', '100', 'Female', '8056682997', '7069133573', '7069133573', '20240095.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(94, '20240096', 'Chimezie ', 'Favour ', '', 'Certificate for Pharmacy Technicians', '7035689239', 'OYO', '100', 'Female', '8167538650', 'Favour20@', '7035689239', '20240096.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(95, '20240097', 'ABU-TIJANI', 'MARIAM', 'TOLULOPE', 'Diploma for Health Technicians', '7045174881', 'ONDO', '100', 'Female', '8168260107', '7045174881', '7045174881', '20240097.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(96, '20240098', 'AKANJI', 'MODINAT', 'OLABISI', 'Diploma in Community Health(CHEW)', '9092383718', 'OYO', '100', 'Female', '8053145223', '9092383718', '9092383718', '20240098.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(97, '20240099', 'OLATUNJI', 'DORCAS', 'MAVELLOUS', 'Certificate for  Medical Laboratory Technicians(MLT)', '9054360798', 'OYO', '100', 'Female', '8038122279', '9054360798', '9054360798', '20240099.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(98, '20240100', 'OLAPADE', 'BUKOLA', 'ELIZABETH', 'Certificate for  Medical Laboratory Technicians(MLT)', '9065929640', 'OYO', '100', 'Female', '8168198397', '9065929640', '9065929640', '20240100.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(99, '20240101', 'BUSARI', 'SUKURAT', 'ADEWUMI', 'Certificate for  Medical Laboratory Technicians(MLT)', '9063684798', 'OYO', '100', 'Female', '98964524028', '9063684798', '9063684798', '20240101.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(100, '20240102', 'OKELEKAN', 'DORCAS', 'AYOMIDE', 'Certificate for  Medical Laboratory Technicians(MLT)', '7043425990', 'OYO', '100', 'Female', '9139348542', '7043425990', '7043425990', '20240102.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(101, '20240103', 'AKEEM', 'TOLIAT', 'OMOLARA', 'Certificate for Pharmacy Technicians', '7041709212', 'OYO', '100', 'Female', '8027531976', '7041709212', '7041709212', '20240103.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(102, '20240104', 'Adediran ', 'Monsurat ', 'Motunrayo ', 'Professional Diploma for Dental Surgery Technicians', '7042683515', 'OYO', '100', 'Female', '7089347974', 'Tunrayo 2056', '7042683515', '20240104.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(103, '20240105', 'AYENI', 'IFEOLUWA', '', 'Certificate in Community Health(JCHEW)', '7084829790', 'EKITI', '100', 'Female', '9030037262', 'Ifeoluwaayeni', 'Olami24@', '20240105.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(104, '20240106', 'ODETOLA ', 'JOY', 'BUKAYOMI ', 'Diploma in Community Health(CHEW)', '8116955166', 'OYO', '100', 'Female', '8056610578', 'Eagle', 'eagle12345', '20240106.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(105, '20240107', 'MIKAIL', 'KAFILAT', 'ODUNAYO', 'Diploma in Community Health(CHEW)', '9132542479', 'OYO', '100', 'Female', '8036620278', '9132542479', '9132542479', '20240107.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(106, '20240108', 'OYEGBILE', 'EUNICE', 'OMOLOLA', 'Diploma in Community Health(CHEW)', '9024928149', 'OYO', '100', 'Female', '8035745728', '9024928149', '9024928149', '20240108.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(107, '20240109', 'AJIBOLA', 'FAITH', 'JUMOKE', 'Diploma for Health Technicians', '8055632654', 'OYO', '100', 'Female', '7044120535', '8055632654', '8055632654', '20240109.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(108, '20240110', 'IDOWU', 'FATIMO', 'BOLUWATIFE', 'Diploma for Health Technicians(DE)', '9124869803', 'OGUN', '100', 'Female', '8163337880', '9124869803', '9124869803', '20240110.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(109, '20240111', 'AZEEZ', 'OMOBOLANLE', 'MOTUNRAYO', 'Certificate for Pharmacy Technicians', '8072221622', 'OSUN', '100', 'Female', '9026865808', '8072221622', '8072221622', '20240111.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(110, '20240112', 'JOHNSON', 'NGOZI', 'GLORIA', 'Diploma in Community Health(CHEW)', '8169848753', 'EBONYI', '100', 'Female', '8038244637', '8169848753', '8169848753', '20240112.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(111, '20240113', 'FAGBEMI', 'SUKURAT', 'ALABA', 'Diploma for Health Technicians(DE)', '9169284542', 'OYO', '100', 'Female', '9169284542', '9169284542', '9169284542', '20240113.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(112, '20240114', 'AIKULOLA', 'OLUWANIFEMI', 'ANUOLUWAPO', 'Certificate for Pharmacy Technicians', '9047005790', 'OGUN', '100', 'Female', '08181528899, 0816147', '9047005790', '9047005790', '20240114.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(113, '20240115', 'Bamidele ', 'Blessing ', 'Elizabeth ', 'Diploma in Community Health(CHEW)', '8132788515', 'OYO', '100', 'Female', '8100044633', 'MissNiyoungB', 'YoungB3278', '20240115.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(114, '20240116', 'ADEYEMO', 'ADESEWA', 'FIYINFOLUWA', 'Diploma in Community Health(CHEW)', '7061599615', 'OSUN', '100', 'Female', '7061599615', '7061599615', '7061599615', '20240116.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(115, '20240117', 'GANIYU', 'ROKIBAT', 'ABIODUN', 'Diploma in Community Health(CHEW)', '8088383065', 'OYO', '100', 'Female', '8052413939', '8088383065', '8088383065', '20240117.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(116, '20240118', 'OLADIPUPO', 'OLUWATUMININU', 'ENITAN', 'Diploma in Community Health(CHEW)', '9033349882', 'OSUN', '100', 'Female', '8141845907', '9033349882', '9033349882', '20240118.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(117, '20240119', 'TAIWO', 'MISTURA', 'OLAMIDE', 'Diploma in Community Health(CHEW)', '7013840323', 'OYO', '100', 'Female', '7013840323', '7013840323', '7013840323', '20240119.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(118, '20240120', 'Ibrahim', 'Mariam', 'Opeyemi', 'Certificate for Pharmacy Technicians', '9014571598', 'KWARA', '100', 'Female', '8169893031', 'Mary', 'Horpeyemi', '20240120.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(119, '20240121', 'ABDULRASHEED', 'SUKURAT', 'OMOGBONJUBOLA', 'ND(WAHEB) in Environmental Health Technology', '9067758833', 'OYO', 'NDI', 'Female', '8140754258', '9067758833', '9067758833', '20240121.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(120, '20240122', 'SHITTU', 'ALICE', 'IYOPA', 'Diploma for Health Technicians', '9066068889', 'OYO', '100', 'Female', '7034989745', '9066068889', '9066068889', '20240122.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(121, '20240123', 'OLAWALE', 'ROKIBAT', 'OMOSHALEWA', 'Diploma for Health Technicians(DE)', '9157725522', 'OYO', '100', 'Female', '8033628971', '9157725522', '9157725522', '20240123.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(122, '20240124', 'OYETUNJI', 'RACHEAL', 'IDOWU', 'Diploma in Community Health(CHEW)', '7061683947', 'OYO', '100', 'Female', '7061683947', '7061683947', 'baba1989.', '20240124.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(123, '20240125', 'OJO', 'DEBORAH', 'IKEADE', 'Diploma in Community Health(CHEW)', '7080099759', 'OYO', '100', 'Female', '7080099759', '7080099759', '7080099759', '20240125.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(124, '20240126', 'HASSAN', 'LATIFAT', 'OLUWABUNMI', 'Diploma for Health Technicians(DE)', '8117693558', 'OYO', '100', 'Female', '8063059045', '8117693558', '8117693558', '20240126.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(125, '20240127', 'JUMAH', 'NAFEESAH', 'SALEWA', 'Certificate for  Medical Laboratory Technicians(MLT)', '9079791768', 'KWARA', '100', 'Female', '8033735407', '9079791768', '9079791768', '20240127.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(126, '20240128', 'OLAWORE', 'AISHAT', 'OYINDAMOLA', 'Certificate for  Medical Laboratory Technicians(MLT)', '9112706277', 'OGUN', '100', 'Female', '8160363243', '9112706277', '9112706277', '20240128.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(127, '20240129', 'OLUWASEGUN', 'PETER', 'GBENGA', 'Diploma in Community Health(CHEW)', '9067736619', 'OYO', '100', 'Male', '8078982877', '9067736619', '9067736619', '20240129.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(128, '20240130', 'POPOOLA', 'OLUWATOSIN', 'RACHEAL', 'Diploma in Community Health(CHEW)', '9152482329', 'OYO', '100', 'Female', '8066734958', '9152482329', '9152482329', '20240130.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(129, '20240131', 'OJEBODE', 'DAMILOLA', 'ADENIKE', 'Diploma for Health Technicians(DE)', '8163503349', 'OYO', '100', 'Female', '7042750059', '8163503349', '8163503349', '20240131.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(130, '20240132', 'ADEJUMO', 'ALIMOT', 'ANUOLUWAPO', 'Diploma in Community Health(CHEW)', '8127869174', 'OYO', '100', 'Female', '9010057718', '8127869174', '8127869174', '20240132.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(131, '20240133', 'AKINWUMI', 'JOY', 'OMOBOLANLE', 'Diploma in Community Health(CHEW)', '8132862817', 'OYO', '100', 'Female', '9079298552', '8132862817', '8132862817', '20240133.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(132, '20240134', 'EGBEYEMI', 'TOMIWA', 'OMOTADE', 'Diploma in Community Health(CHEW)', '9161866550', 'EKITI', '100', 'Female', '9159447190', 'Omotade11', 'Omotade11', '20240134.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(133, '20240135', 'ANIMASHAUN', 'TOYIN', 'DAMILOLA', 'Diploma in Community Health(CHEW)', '7011535645', 'OGUN', '100', 'Female', '8141360439', '7011535645', '7011535645', '20240135.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(134, '20240136', 'OLOSUNDE', 'TEMITOPE', 'adetola', 'Certificate for  Medical Laboratory Technicians(MLT)', '70857088055', 'OSUN', '100', 'Female', '8052570051', '70857088055', '70857088055', '20240136.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(135, '20240137', 'NATHANIEL', 'WONUOLA', 'EMMANUELLA', 'Certificate for Pharmacy Technicians', '9070561534', 'EKITI', '100', 'Female', '8139150368', '9070561534', '9070561534', '20240137.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(136, '20240138', 'AFOLABI', 'RHODA', 'OLAITAN', 'Diploma in Community Health(CHEW)', '9047073288', 'OYO', '100', 'Female', '9165571606', '9047073288', '9047073288', '20240138.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(137, '20240139', 'abdulrasaq', 'fawaz', 'afolabi', 'Diploma in Community Health(CHEW)', '9065744383', 'OYO', '100', 'Male', '8103221270', 'fawaz1122', 'Fawaz1122', '20240139.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(138, '20240140', 'IDOWU', 'AMINAT', 'OMOWUNMI', 'Diploma in Community Health(CHEW)', '8132026858', 'OGUN', '100', 'Female', '7057575250', '8132026858', '8132026858', '20240140.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(139, '20240141', 'Omoola ', 'Julianah ', 'Olamide ', 'Diploma in Community Health(CHEW)', '7063754233', 'OYO', '100', 'Female', '7058761491', 'Omoola Julianah olamide ', '7063754233', '20240141.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(140, '20240142', 'OLALERE', 'NASIRAT', 'OMOTUNRAYO', 'Diploma in Community Health(CHEW)', '9125993123', 'OYO', '100', 'Female', '9186086082', '9125993123', '9125993123', '20240142.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(141, '20240143', 'YEKEEN', 'SAKIRAT', 'OMOSALEWA', 'Certificate for  Medical Laboratory Technicians(MLT)', '8156502557', 'OYO', '100', 'Female', '8069695938', '8156502557', '8156502557', '20240143.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(142, '20240144', 'AYOADE', 'RACHEAL', 'FERANMI', 'Diploma in Community Health(CHEW)', '9041201682', 'OYO', '100', 'Female', '8107048969', '9041201682', '9041201682', '20240144.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(143, '20240145', 'OLADEJO', 'AMINAT', 'TEMITOPE', 'Certificate for  Medical Laboratory Technicians(MLT)', '9028426219', 'OYO', '100', 'Female', '8054063354', '9028426219', '9028426219', '20240145.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(144, '20240146', 'HAMZAT', 'HIKMOT', 'OMORILEWA', 'Diploma in Community Health(CHEW)', '8111073762', 'OYO', '100', 'Female', '8035129360', '8111073762', '8111073762', '20240146.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(145, '20240147', 'ABRAHAM', 'ESTHER', 'IFEOLUWA', 'Diploma in Community Health(CHEW)', '9115360358', 'OYO', '100', 'Female', '8051942803', '9115360358', '9115360358', '20240147.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(146, '20240148', 'OLANISEBE', 'ESTHER', 'OMOLARA', 'Certificate for Pharmacy Technicians', '7053428274', 'OYO', '100', 'Female', '8164746948', '7053428274', '7053428274', '20240148.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(147, '20240149', 'ADEGOKE', 'ALICE', 'KEMI', 'Diploma in Community Health(CHEW)', '8057073439', 'OYO', '100', 'Female', '8057073439', '8057073439', '8057073439', '20240149.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(148, '20240150', 'SALAUDEEN', 'AISHAT', 'MORENIKEJI', 'Diploma in Community Health(CHEW)', '7060916909', 'OYO', '100', 'Female', '7060916909', '7060916909', '7060916909', '20240150.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(149, '20240151', 'LAWAL', 'AISAHT', 'BUKOLA', 'Diploma in Community Health(CHEW)', '8167382110', 'OYO', '100', 'Female', '8056164971', '8167382110', '8167382110', '20240151.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(150, '20240152', 'FABUNMI', 'REBECCA', 'TIMILEYIN', 'ND Health Information Management', '9041436574', 'OYO', 'NDI', 'Female', '8121685889', '9041436574', '9041436574', '20240152.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(151, '20240153', 'ABDULRASHEED', 'SAKIRAT', 'IYABO', 'Diploma in Community Health(CHEW)', '7045833198', 'OYO', '100', 'Female', '8056493440', '7045833198', '7045833198', '20240153.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(152, '20240154', 'AMUDA', 'MORUFAT', 'GBEMISOLA', 'Certificate for  Medical Laboratory Technicians(MLT)', '8108840968', 'OYO', '100', 'Female', '7063616148', '8108840968', '8108840968', '20240154.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(153, '20240155', 'FAKOREDE', 'RUTH', 'FIYINFOLUWA', 'Professional Diploma for Dental Surgery Technicians', '8169505708', 'OYO', '100', 'Female', '8134104740', '8169505708', '8169505708', '20240155.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(154, '20240156', 'ABIALA', 'OLUWATOSIN', 'ESTHER', 'Certificate for Pharmacy Technicians', '7014984173', 'OGUN', '100', 'Female', '7066599820', '7014984173', '7014984173', '20240156.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(155, '20240157', 'FATERU', 'GRACE', 'OPEYEMI', 'Diploma in Community Health(CHEW)(DE)', '7017767183', 'OYO', '200', 'Female', '7052450830', 'FATERUGRACE', 'FATERUGRACE', '20240157.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(156, '20240158', 'OLANIRAN', 'FLORENCE', 'EUNICE', 'Diploma in Community Health(CHEW)', '9161257742', 'OYO', '100', 'Female', '8065910080', '9161257742', '9161257742', '20240158.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(157, '20240159', 'KUKU', 'DORCAS', 'AYOMIDE', 'Certificate for Pharmacy Technicians', '9116565226', 'OGUN', '100', 'Female', '8024555093', '9116565226', '9116565226', '20240159.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(158, '20240160', 'ALIU', 'OLUWABUSAYO', 'TOLANI', 'Certificate for  Medical Laboratory Technicians(MLT)', '9133105490', 'KWARA', '100', 'Female', '7084363492', 'tolani', '50303', '20240160.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(159, '20240161', 'SHOLANKE', 'AJOKE', 'FUNMILAYO', 'Certificate in Community Health(JCHEW)', '8124487648', 'OGUN', '100', 'Female', '8124487648', 'SHOLANKEAJOKE', 'SHOLANKEAJOKE', '20240161.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(160, '20240162', 'OGUNDEJI', 'OLUKEMI', 'IYABODE', 'Certificate for  Medical Laboratory Technicians(MLT)', '8051884516', 'OYO', '100', 'Female', '8051884516', '8051884516', '8051884516', '20240162.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(161, '20240163', 'FATIMEHIN', 'OLAOLUWA', 'JOHNSON', 'Certificate for Pharmacy Technicians', '8061268834', 'EKITI', '100', 'Male', '8061268834', '8061268834', '8061268834', '20240163.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(162, '20240164', 'ADEYANJU', 'LYDIA', 'IYANUOLUWA', 'Certificate for  Medical Laboratory Technicians(MLT)', '7089209182', 'OYO', '100', 'Female', '8033408883', '7089209182', '7089209182', '20240164.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(163, '20240165', 'ALUKO', 'ALICE', 'RONKE', 'Diploma in Community Health(CHEW)(DE)', '7043691510', 'OYO', '200', 'Female', '8107229303', 'wonderful22', '7043691510', '20240165.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(164, '20240166', 'OYINLOLA', 'DEBORAH', 'OLUWAFUNMILOLA', 'Diploma in Community Health(CHEW)(DE)', '8065480218', 'OYO', '200', 'Female', '7061111110', '8065480218', '8065480218', '20240166.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(165, '20240167', 'ADEWOYE', 'EXCELLENCE', 'ADEBIMPE', 'Professional Diploma in Health Information Management', '8021262045', 'OSUN', '100', 'Female', '8079174673', '8021262045', '8021262045', '20240167.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(166, '20240168', 'ADEYEMO', 'ASHABI', 'IKIMOT', 'Professional Diploma in Health Information Management', '7046915509', 'OYO', '100', 'Female', '9026616673', '7046915509', '7046915509', '20240168.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(167, '20240169', 'OKUNLOLA', 'SARAH', 'AANU', 'Diploma in Community Health(CHEW)', '8149768263', 'OYO', '100', 'Female', '8156638890', '8149768263', '8149768263', '20240169.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(168, '20240170', 'TAIWO', 'KAOSARA', 'ARIKE', 'Diploma in Community Health(CHEW)(DE)', '9116476026', 'OYO', '200', 'Female', '9097976585', 'taiwo22', '22222222', '20240170.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(169, '20240171', 'OLANIYAN', 'BOSE', 'FOLASADE', 'Diploma in Community Health(CHEW)', '8089454808', 'OYO', '100', 'Female', '8089454808', '8089454808', '8089454808', '20240171.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(170, '20240172', 'AJIBOYE', 'DORCAS', 'ABOSEDE', 'Diploma in Community Health(CHEW)', '7042158940', 'OYO', '100', 'Female', '8065129774', '7042158940', '7042158940', '20240172.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(171, '20240173', 'ALAMU', 'OLAWUMI', 'DORCAS', 'Diploma in Community Health(CHEW)', '8060667021', 'OYO', '100', 'Female', '7069200666', '8060667021', '8060667021', '20240173.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(172, '20240174', 'TIJANI', 'SUKURAT', 'DAMOLA', 'Diploma in Community Health(CHEW)', '9165784637', 'OYO', '100', 'Female', '8138999015', 'tijanisukurat@gmail.com', 'tijanisukurat@gmail.com', '20240174.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(173, '20240175', 'IGE', 'MARY', 'FOLASHADE', 'Diploma in Community Health(CHEW)', '7016472265', 'OYO', '100', 'Female', '8082131257', '7016472265', '7016472265', '20240175.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(174, '20240176', 'ABDULRAHEEM', 'AISHAT', 'ASAKE', 'Diploma in Community Health(CHEW)', '8136545638', 'OYO', '100', 'Female', '8039505362', '8136545638', '8136545638', '20240176.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(175, '20240177', 'ADELEKE', 'ODUNAYO', 'GRACE', 'Diploma in Community Health(CHEW)', '9039416485', 'OYO', '100', 'Female', '7069039199', '9039416485', '9039416485', '20240177.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(176, '20240178', 'Akinpelu ', 'Esther ', 'Oluwajuwonlo', 'Diploma in Community Health(CHEW)', '7025754094', 'OYO', '100', 'Female', '8064898746', 'Akinpelu Esther ', 'Oluwaferanmi081.', '20240178.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(177, '20240179', 'YUNUSA ', 'SULIAT', 'BAKE', 'Certificate for Pharmacy Technicians', '9161436327', 'KWARA', '100', 'Female', '7048232439', '9161436327', '9161436327', '20240179.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(178, '20240180', 'IYIOLA', 'OLUWATIMILEYIN', 'ABISOLA', 'Diploma in Community Health(CHEW)', '9060215344', 'OYO', '100', 'Female', '7036261888', '9060215344', '9060215344', '20240180.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(179, '20240181', 'OPADEJI', 'HAFUSAT', 'OPEYEMI', 'Diploma in Community Health(CHEW)', '9136424070', 'OGUN', '100', 'Female', '8168828798', '9136424070', '9136424070', '20240181.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(180, '20240182', 'Ogunseye', 'Blessing', 'Olajumoke', 'Certificate for Pharmacy Technicians', '9152565480', 'OGUN', '100', 'Female', '9041786227', 'daniellablessing95@gmail.com', 'adeniyidaniel', '20240182.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(181, '20240183', 'OLORUNSOLA', 'AISHAT', 'OLAITAN', 'Diploma for Health Technicians', '7026113467', 'OYO', '100', 'Female', '7069993022', '7026113467', '7026113467', '20240183.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(182, '20240184', 'INAOLAJI', 'ELIZABETH', 'KEHINDE', 'Professional Diploma for Dental Surgery Technicians', '8148707606', 'OSUN', '100', 'Female', '7066995153', 'INAOLAJI124', 'GIFTOFGOD', '20240184.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(183, '20240185', 'ADENIRAN', 'MARYAM', 'ADEDAYO', 'Diploma in Community Health(CHEW)', '8088743277', 'OYO', '100', 'Female', '8089720069', '8088743277', '8088743277', '20240185.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(184, '20240186', 'OGUNTONA', 'ABOSEDE', 'OMOWUNMI', 'Diploma in Community Health(CHEW)(DE)', '9041295333', 'OYO', '200', 'Female', '9076745362', '9041295333', '9041295333', '20240186.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(185, '20240187', 'Omotola', 'Racheal', 'Mayowa', 'Diploma in Community Health(CHEW)', '7062159233', 'KOGI', '100', 'Male', '8128983333', 'Mayor4sure', '6215', '20240187.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(186, '20240188', 'MOMOH', 'IYANUOLUWA', 'ADEGOKE', 'Certificate for Pharmacy Technicians', '9032588919', 'EKITI', '100', 'Male', '8161821577', 'MOMOHIYANUOLUWA', 'MOMOHIYANUOLUWA', '20240188.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26');
INSERT INTO `student_admissions` (`id`, `admission_no`, `surname`, `first_name`, `other_name`, `department`, `phone_no`, `state`, `level`, `sex`, `phone_no1`, `user_name`, `password`, `picture_name`, `session1`, `login_status`, `login_attempts`, `user_type`, `created_at`, `updated_at`) VALUES
(187, '20240189', 'AKINRINOYE', 'HUSMAN', 'OLALEKAN', 'Professional Diploma in Health Information Management', '7032321884', 'OYO', '100', 'Male', '9033332173', '7032321884', '7032321884', '20240189.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(188, '20240190', 'LIADI', 'ANUOLUWAPO', 'TEMITOPE', 'Professional Diploma for Dental Surgery Technicians', '8053543890', 'OGUN', '100', 'Female', '8166749892', '8053543890', '8053543890', '20240190.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(189, '20240191', 'OLOWOJESIKUN', 'CHRISTIANAH', 'CHRISTIANAH', 'Diploma in Community Health(CHEW)', '9137181455', 'ONDO', '100', 'Female', '8070996874', '9137181455', '9137181455', '20240191.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(190, '20240192', 'AWOKOYA', 'DOMINION', 'BOLAJI', 'Professional Certificate in Medical Image Processing/X-ray Technician', '8109014623', 'OGUN', '100', 'Male', '7012037872', '8109014623', '8109014623', '20240192.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(191, '20240193', 'OLADEJO', 'OLUWATOMISIN', 'SUSAN', 'Diploma in Community Health(CHEW)', '9060303277', 'OSUN', '100', 'Female', '8116744551', 'Oluwatomisin2002', 'Oluwatomisin2002', '20240193.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(192, '20240194', 'OLAYIWOLA', 'GRACE', 'TIMILEYIN', 'Professional Certificate in Medical Image Processing/X-ray Technician', '7064277938', 'OYO', '100', 'Female', '8056606418', '7064277938', '7064277938', '20240194.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(193, '20240195', 'ALAMU', 'ANUOLUWA', 'MARY', 'Diploma in Community Health(CHEW)', '9059348125', 'OYO', '100', 'Female', '8059334500', '9059348125', '9059348125', '20240195.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(194, '20240196', 'FAJOYE', 'SAMUEL', 'ADEWOLE', 'Certificate for Pharmacy Technicians', '8154679071', 'OYO', '100', 'Male', '8103177095', '8154679071', '8154679071', '20240196.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(195, '20240197', ' RICH', 'UGO', 'EGBUJOR', 'Professional Certificate in Medical Image Processing/X-ray Technician', '8038758803', 'IMO', '100', 'Male', '8073412433', '8038758803', '8038758803', '20240197.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(196, '20240198', 'DAKAKA', 'SADIQ', 'OPEYEMI', 'Professional Certificate in Medical Image Processing/X-ray Technician', '9061281292', 'EDO', '100', 'Male', '9051579442', '9061281292', '9061281292', '20240198.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(197, '20240199', 'ADEDEJI', 'DORCAS', 'ENITAN', 'Diploma for Health Technicians(DE)', '9021774804', 'OYO', '100', 'Female', '9069649510', '9021774804', '9021774804', '20240199.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(198, '20240200', 'ADEYEMO', 'ABIMBOLA', 'AZIZAT', 'Diploma in Community Health(CHEW)(DE)', '8057020403', 'OSUN', '200', 'Female', '7033601526', 'ADEYEMOABIMBOLA', 'ADEYEMOABIMBOLA', '20240200.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(199, '20240201', 'FEHINTOLA', 'EBUNOLUWA', 'SERAH', 'Professional Diploma in Health Information Management', '8039905741', 'OYO', '100', 'Female', '9056684090', '8039905741', '8039905741', '20240201.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(200, '20240202', 'OLUKAYODE', 'ESTHER', 'FLORENCE', 'Certificate for  Medical Laboratory Technicians(MLT)', '9117174355', 'OYO', '100', 'Female', '8138594770', '9117174355', '9117174355', '20240202.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(201, '20240203', 'SAMUEL ', 'MODUPEOLUWA', 'SARAH', 'Diploma in Community Health(CHEW)', '7086557009', 'OYO', '100', 'Female', '8068435978', '7086557009', 'GthTfeh6bArzfFV', '20240203.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(202, '20240204', 'OLOFIN', 'FUNMILOLA', 'OLUWASEUN', 'Professional Certificate in Medical Image Processing/X-ray Technician', '9014319246', 'OYO', '100', 'Female', '8051070027', '9014319246', '9014319246', '20240204.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(203, '20240205', 'ONIFADE', 'OMOWUMI', 'RAFIYAT', 'Professional Certificate in Medical Image Processing/X-ray Technician', '8035921250', 'OYO', '100', 'Female', '8034205390', '8035921250', '8035921250', '20240205.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(204, '20240206', 'YEKEEN', 'BOLAJI', 'SAMSON', 'Certificate in Community Health(JCHEW)', '9017275785', 'OYO', '100', 'Male', '9130557435', '9017275785', '9017275785', '20240206.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(205, '20240207', 'LAWAL', 'NAHEEMOT', 'ROMOKE', 'Certificate for  Medical Laboratory Technicians(MLT)', '8120676526', 'OYO', '100', 'Female', '9016468854', '8120676526', '8120676526', '20240207.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(206, '20240208', 'ADELEKE', 'ROQEEB', 'AYOMIDE', 'Diploma in Community Health(CHEW)', '9129611037', 'OSUN', '100', 'Male', '7038027477', '9129611037', '9129611037', '20240208.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(207, '20240209', 'ABDULAZEEZ', 'HAFSOH', 'OLANIKE', 'Diploma in Community Health(CHEW)', '9076549774', 'OYO', '100', 'Female', '8058821726', '9076549774', '9076549774', '20240209.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:26', '2024-05-09 19:19:26'),
(208, '20240210', 'OLUADE', 'IYABO', 'OLUWATIMILEYIN', 'Diploma in Community Health(CHEW)', '9027365295', 'OYO', '100', 'Female', '9127373350', '9027365295', '9027365295', '20240210.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(209, '20240211', 'OKOLIE', 'AMAKA', 'EMMANUELLA', 'Certificate for Pharmacy Technicians', '7081627650', 'DELTA', '100', 'Female', '9068985618', '7081627650', '7081627650', '20240211.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(210, '20240212', 'IBRAHIM', 'IKIMOT', 'ABIKE', 'Diploma in Community Health(CHEW)', '9131947418', 'KOGI', '100', 'Female', '9137296362', '9131947418', '9131947418', '20240212.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(211, '20240213', 'OYEBIYI', 'DORCAS', 'OLUWATIMILEYIN', 'Diploma in Community Health(CHEW)', '9112613429', 'OYO', '100', 'Female', '9077357152', '9112613429', '9112613429', '20240213.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(212, '20240214', 'DIEKOLA', 'MORENIKEJI', 'OPEOLUWA', 'Diploma in Community Health(CHEW)', '9061679929', 'OYO', '100', 'Female', '9014855735', '9061679929', '9061679929', '20240214.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(213, '20240215', 'ASIMIYU', 'FARUQ', 'AYOMIDE', 'Diploma in Community Health(CHEW)', '8116951173', 'OYO', '100', 'Male', '7026756998', '8116951173', '8116951173', '20240215.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(214, '20240216', 'IBRAHIM', 'SAKIRAT', 'OMOBISOLA', 'Professional Diploma in Health Information Management', '7042986324', 'OYO', '100', 'Female', '8025442397', '7042986324', '7042986324', '20240216.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(215, '20240217', 'AJIBOLA', 'AYOMIDE', 'OLUWABUKOLA', 'Diploma in Community Health(CHEW)', '7080217841', 'OYO', '100', 'Female', '9027271527', '7080217841', '7080217841', '20240217.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(216, '20240218', 'DAIRO', 'PRECIOUS', 'JESUTOFUNMI', 'Certificate for  Medical Laboratory Technicians(MLT)', '8132696680', 'OSUN', '100', 'Female', '8060068006', '8132696680', '8132696680', '20240218.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(217, '20240219', 'BAKARE', 'BALIKIS', 'ALABA', 'Certificate for  Medical Laboratory Technicians(MLT)', '7049042592', 'OGUN', '100', 'Female', '8034123931', '7049042592', '7049042592', '20240219.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(218, '20240220', 'AWOTILU', 'ESTHER', 'ADEMIJU', 'Diploma for Health Technicians', '9162248045', 'OYO', '100', 'Female', '8120792956', '9162248045', '9162248045', '20240220.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(219, '20240221', 'ADEBAYO', 'ESTHER', 'AYOMIDE', 'Certificate for Health Assistants', '9043595945', 'OYO', '100', 'Female', '8056852050', '9043595945', '9043595945', '20240221.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(220, '20240222', 'OJEKEHINDE', 'AYOMIDE', 'ELIZABETH', 'Diploma in Community Health(CHEW)(DE)', '9046125980', 'OYO', '200', 'Female', '8032329482', 'OJEKEHINDEELIZABETH', 'OJEKEHINDEELIZABETH', '20240222.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(221, '20240223', 'OJEKEHINDE', 'MARVELOUS', 'FERANMI', 'Certificate for Pharmacy Technicians', '9049283710', 'OYO', '100', 'Female', '8032329482', '9049283710', '9049283710', '20240223.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(222, '20240224', 'AJAYI', 'RUTH', 'OMOLOLA', 'Diploma in Community Health(CHEW)', '7038062565', 'EKITI', '100', 'Female', '8032195581', '7038062565', '7038062565', '20240224.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(223, '20240225', 'OJO', 'TITILOPE', 'ITUNUOLUWA', 'Diploma in Community Health(CHEW)(DE)', '8166793650', 'OYO', '200', 'Female', '7086374344', '8166793650', '8166793650', '20240225.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(224, '20240226', 'EMUOBONUVIE', 'FOLASADE', 'OGHENEROBHO', 'Diploma in Mental Health and Psychiatric Rehabilitation', '9068988791', 'DELTA', '100', 'Female', '9068988791', '9068988791', '9068988791', '20240226.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(225, '20240227', 'SHITTU', 'FLORENCE', 'IDOWU', 'Diploma in Community Health(CHEW)(DE)', '8066638328', 'OYO', '200', 'Female', '8103224532', '8066638328', '8066638328', '20240227.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(226, '20240228', 'BELLO', 'TOYYIBAH', 'IGBAYILOLA', 'Certificate for Pharmacy Technicians', '9053058541', 'OYO', '100', 'Female', '8033917764', '9053058541', '9053058541', '20240228.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(227, '20240229', 'ADESINA', 'TEMITOPE', 'OLUWATOYIN', 'ND(WAHEB) in Environmental Health Technology', '9066769418', 'OYO', 'NDI', 'Female', '9066769418', '9066769418', '9066769418', '20240229.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(228, '20240230', 'GANIYU', 'MORUFAT', 'TEMITOPE', 'Professional Diploma in Health Information Management', '8056555073', 'OYO', '100', 'Female', '8033584599', '8056555073', '8056555073', '20240230.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(229, '20240231', 'OLAREWAJU', 'FOLASHADE', 'BENITA', 'Diploma in Community Health(CHEW)', '9069062695', 'EKITI', '100', 'Female', '8142421856', '9069062695', '9069062695', '20240231.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(230, '20240232', 'DUROSARO', 'OLAIDE', 'ELIZABETH', 'Certificate for Pharmacy Technicians', '8159626293', 'OYO', '100', 'Female', '8179371596', '8159626293', '8159626293', '20240232.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(231, '20240233', 'ISIAQ', 'MUTMAINAT', 'OPEYEMI', 'Diploma in Community Health(CHEW)', '8117182310', 'OYO', '100', 'Female', '8034252144', 'ISIAQMUTMAINAT', 'ISIAQMUTMAINAT', '20240233.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(232, '20240234', 'RAFIU', 'RIANAT', 'OYINKANSOLA', 'Diploma in Community Health(CHEW)', '7010404848', 'OYO', '100', 'Female', '70413055133', '7010404848', '7010404848', '20240234.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(233, '20240235', 'SALAUDEEN', 'RODIYAT', 'IDOWU', 'Diploma in Community Health(CHEW)', '8115005288', 'OYO', '100', 'Female', '70413055133', '8115005288', '8115005288', '20240235.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(234, '20240236', 'JAHFAR', 'SOFIYAT', 'ADEOLA', 'Certificate for Pharmacy Technicians', '8102727605', 'OYO', '100', 'Female', '8065922369', '8102727605', '8102727605', '20240236.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(235, '20240244', 'ADEJUMO', 'IREMIDE', 'PRECIOUS', 'Diploma in Community Health(CHEW)', '9115874437', 'OYO', '100', 'Female', '8159062789', '9115874437', '9115874437', '20240244.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(236, '20240237', 'Olagundoye ', 'Jesutomilayo ', 'Testimony ', 'Certificate for  Medical Laboratory Technicians(MLT)', '7026329175', 'ONDO', '100', 'Female', '8064888844', 'Tomi1507', 'Tomi2004', '20240237.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(237, '20240238', 'OKUNLOLA', 'OMOLOLA', 'ELIZABETH', 'Certificate in Community Health(JCHEW)', '9120225804', 'OYO', '100', 'Female', '8116287431', '9120225804', '9120225804', '20240238.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(238, '20240239', 'DADA', 'IFEOLUWA', 'OLAPEJU', 'Certificate in Community Health(JCHEW)', '8051366117', 'OYO', '100', 'Female', '9058572749', '8051366117', '8051366117', '20240239.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(239, '20240240', 'OLAYINKA', 'OPEYEMI', 'OLAMILEKAN', 'Professional Certificate in Medical Image Processing/X-ray Technician', '8082897750', 'LAGOS', '100', 'Male', '9118030877', '8082897750', '8082897750', '20240240.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(240, '20240241', 'SALAMI', 'KEHINDE', 'WALIYAT', 'Certificate for  Medical Laboratory Technicians(MLT)', '9162881623', 'OYO', '100', 'Female', '8109478253', '9162881623', '9162881623', '20240241.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(241, '20240242', 'OLORUNTOBI', 'TAIWO', 'PELUMI', 'Diploma for Health Technicians', '8117665030', 'ONDO', '100', 'Female', '8139473803', '8117665030', '8117665030', '20240242.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(242, '20240243', 'MUHAMMED', 'KAOSARA', 'AJIBOLA', 'Diploma in Community Health(CHEW)', '8184111117', 'KWARA', '100', 'Female', '8037136173', '8184111117', '8184111117', '20240243.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(243, '20240245', 'FADIPE', 'ERI', 'TOBILOBA', 'Certificate in Community Health(JCHEW)', '7011837652', 'OGUN', '100', 'Female', '8083554486', '7011837652', '7011837652', '20240245.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(244, '20240246', 'FADIPE', 'ERITOBILOBA', 'DEBORAH', 'Certificate in Community Health(JCHEW)', '7011837652', 'OGUN', '100', 'Female', '8083554486', 'TOBILOBA', 'TOBILOBA', '20240246.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(245, '20240247', 'OLANREWAJU', 'PRAISE', 'BISOLA', 'Diploma in Community Health(CHEW)', '7044437257', 'OYO', '100', 'Female', '9069423778', '7044437257', '7044437257', '20240247.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(246, '20240248', 'Olanrewaju', 'Christianah', 'Abosede', 'Certificate for Pharmacy Technicians', '8157493475', 'OYO', '100', 'Female', '8066566403', 'opeyemi2024', '8157493475', '20240248.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(247, '20240249', 'ADETOLA', 'FRANCIS', 'FOLUSO', 'Diploma in Mental Health and Psychiatric Rehabilitation', '8059616260', 'OYO', '100', 'Male', '0805 168 8519', '8059616260', '8059616260', '20240249.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(248, '20240250', 'KEHINDE', 'ADIJAT', 'OLUWAKEMI', 'Diploma in Community Health(CHEW)', '9065189366', 'OGUN', '100', 'Female', '8058588951', 'adetunji2024', '12345678', '20240250.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(249, '20240251', 'OWOYEMI', 'JESUTOFUNMI', 'PELUMI', 'Certificate for Pharmacy Technicians', '8163692673', 'OYO', '100', 'Female', '8033522017', '8163692673', '8163692673', '20240251.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(250, '20240252', 'ADESOYE', 'AYOKUNNU', 'OLUWASEUN', 'Diploma in Community Health(CHEW)(DE)', '9162932345', 'OYO', '200', 'Male', '8061141940', 'OLUWASEUN', 'OLUWASEUN', '20240252.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(251, '20240253', 'AKINADE', 'ABOSEDE', 'OLUWASEUN', 'HND Dental Therapy', '9159475766', 'KWARA', 'HNDI', 'Female', '9131854115', '9159475766', '9159475766', '20240253.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(252, '20240254', 'ABDULAZEEZ', 'AISHAT', 'OLUWATOYIN', 'Diploma in Community Health(CHEW)', '9075787579', 'OYO', '100', 'Female', '7065282223', '9075787579', '9075787579', '20240254.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(253, '20240255', 'OYE', 'VICTOR', 'AYOOLA', 'Certificate for Pharmacy Technicians', '8039276534', 'ONDO', '100', 'Male', '8148681335', '8039276534', '8039276534', '20240255.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(254, '20240256', 'AKINYEMI', 'BLESSING', 'FEYINTOLA', 'Professional Diploma for Dental Surgery Technicians', '8105094135', 'EDO', '100', 'Female', '8028831216', '8105094135', '8105094135', '20240256.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(255, '20240257', 'GBOLAGADE', 'IDOWU', 'CHRISTIANAH', 'Diploma in Community Health(CHEW)', '7065885901', 'OYO', '100', 'Female', '8143297986', '7065885901', '7065885901', '20240257.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(256, '20240258', 'IGHODALO', 'GLORY', 'ENABEGE', 'Certificate for  Medical Laboratory Technicians(MLT)', '7059103637', 'EDO', '100', 'Female', '7065051489', '7059103637', '7059103637', '20240258.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(257, '20240259', 'BAMIDELE', 'TEMILOLUWA', 'ENOCH', 'Certificate for Pharmacy Technicians', '8053036331', 'OYO', '100', 'Male', '8132541312', '8053036331', '8053036331', '20240259.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(258, '20240260', 'AWE', 'ABIOLA', 'MONSURAT', 'Diploma in Community Health(CHEW)', '8164054233', 'OYO', '100', 'Female', '7033922124', '8164054233', '8164054233', '20240260.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(259, '20240263', 'OLOYEDE', 'ABIMBOLA', 'AYOMIDE', 'Certificate for Pharmacy Technicians', '8108299057', 'OYO', '100', 'Male', '9030533196', '8108299057', '8108299057', '20240263.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(260, '20240264', 'OJO', 'TITILAYO', 'OLUFUNKE', 'Certificate for Pharmacy Technicians', '8069695388', 'OYO', '100', 'Female', '8050662821', 'OJOTITILAYO', 'OJOTITILAYO', '20240264.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(261, '20240265', 'ABDULAZEEZ', 'MARYAM', 'ADUKE', 'Certificate for  Medical Laboratory Technicians(MLT)', '903,738,843,907,056,000', 'OYO', '100', 'Female', '8034360857', '9037388439', '9037388439', '20240265.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(262, '20240266', 'ABIODUN', 'MERCY', 'IKEOLUWA', 'Certificate for  Medical Laboratory Technicians(MLT)', '9073152512', 'OYO', '100', 'Female', '8160284957', 'Abiodunmercy', '9073152512', '20240266.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(263, '20240267', 'OLOMOLA', 'ODUNOLA', 'MARY', 'Diploma in Community Health(CHEW)', '8083816608', 'OYO', '100', 'Female', '8083816608', 'OLOMOLAMARY', 'OLOMOLAMARY', '20240267.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(264, '20240268', 'OLASUNMADE', 'FATHIA', 'OMODARASOLA', 'Diploma in Community Health(CHEW)', '9043665354', 'OSUN', '100', 'Female', '8161518882', '9043665354', '9043665354', '20240268.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(265, '20240269', 'LAWAL', 'OLAMIDE', 'SAMSON', 'Professional Diploma in Health Information Management', '9027989828', 'OYO', '100', 'Male', '8138888960', '9027989828', '9027989828', '20240269.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(266, '20240270', 'AYODELE', 'OMOLOLA', 'CHRISTIANAH', 'Diploma in Community Health(CHEW)(DE)', '8145674269', 'OYO', '200', 'Female', '8144944004', '8145674269', '8145674269', '20240270.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(267, '20240271', 'OLADEJO', 'SUKROH', 'OMOLOLA', 'Diploma in Community Health(CHEW)', '8108180211', 'OSUN', '100', 'Female', '8039376404', '8108180211', '8108180211', '20240271.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(268, '20240272', 'HADI', 'RODIAT', 'MOTUNRAYO', 'Diploma in Community Health(CHEW)', '9044937657', 'OYO', '100', 'Female', '8074572601', '9044937657', '9044937657', '20240272.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(269, '20240273', 'FADIPE', 'AZEEZAT', 'TITILAYO', 'Professional Diploma in Health Information Management', '9137602645', 'OYO', '100', 'Female', '8038401538', '9137602645', '9137602645', '20240273.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(270, '20240274', 'BADMUS', 'KAOSARAT', 'IYABO', 'Diploma in Community Health(CHEW)', '9069279286', 'OYO', '100', 'Female', '7034634544', '9069279286', '9069279286', '20240274.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(271, '20240275', 'ABDULGANIYU', 'ROKEEBAH', ' ', 'Diploma in Community Health(CHEW)', '7026999169', 'OSUN', '100', 'Female', '8060961963', '7026999169', '7026999169', '20240275.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(272, '20240276', 'SALAMI', 'FATHIAH', 'ODUNAYO', 'Certificate for Pharmacy Technicians', '8110006300', 'OYO', '100', 'Female', '8110006300', '8110006300', '8110006300', '20240276.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(273, '20240277', 'SAHEED', 'ROKEEBAT', 'AYOKE', 'Certificate for Pharmacy Technicians', '9046783032', 'OYO', '100', 'Female', '8083240278', '9046783032', '9046783032', '20240277.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(274, '20240278', 'ADEMOLA', 'SHERIFAT', 'ADEWUMI', 'Certificate for Pharmacy Technicians', '8151278333', 'OGUN', '100', 'Female', '8053443996', '8151278333', '8151278333', '20240278.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(275, '20240279', 'IYANDA', 'ESTHER', 'OPEYEMI', 'Diploma in Community Health(CHEW)', '7030260548', 'OYO', '100', 'Female', '8075401514', '7030260548', '7030260548', '20240279.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(276, '20240280', 'AKINSOJI', 'KHADIJAH', '', 'Certificate in Community Health(JCHEW)', '8135299781', 'OYO', '100', 'Female', '9060827873', 'akinsojikh', 'akinsoji2004', '20240280.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(277, '20240281', 'SALAUDDIN', 'KHADIJAT', 'KUBRAT', 'Diploma in Community Health(CHEW)', '8034807629', 'OYO', '100', 'Female', '8034807629', '8034807629', '8034807629', '20240281.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(278, '20240282', 'OLANREWAJU', 'RODIAT', 'ABIDEMI', 'Diploma in Community Health(CHEW)', '8153495887', 'OYO', '100', 'Female', '8104721047', '8153495887', '8153495887', '20240282.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(279, '20240283', 'ALABI', 'AISHAT', 'ADEOLA', 'Diploma in Community Health(CHEW)', '9071908594', 'OYO', '100', 'Female', '8153792715', '9071908594', '9071908594', '20240283.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(280, '20240284', 'OKE', 'BLESSING', 'HANNAH', 'Diploma in Community Health(CHEW)', '7086187762', 'EKITI', '100', 'Female', '9121312493', '7086187762', '7086187762', '20240284.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(281, '20240285', 'OGUNWALE', 'OLUWATOBILOBA', 'OMOLOLA', 'Certificate in Community Health(JCHEW)', '9162569220', 'OYO', '100', 'Female', '9154998162', '9162569220', '9162569220', '20240285.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(282, '20240286', 'JIMOH', 'RASHEEDAT', '  ', 'Certificate for Pharmacy Technicians', '8083414973', 'OYO', '100', 'Female', '7041305133', '8083414973', '8083414973', '20240286.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(283, '20240287', 'TIJANI', 'BARAKATULLAHI', '  ', 'Diploma in Community Health(CHEW)', '9124485295', 'OYO', '100', 'Female', '9124485295', '9124485295', '9124485295', '20240287.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(284, '20240288', 'RAHEEM ', 'BALIKIS', 'OMOLARA', 'Diploma in Community Health(CHEW)', '9037987134', 'OYO', '100', 'Female', '8068317348', '9037987134', '9037987134', '20240288.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(285, '20240289', 'BAMIGBOYE', 'OREOLUWA', 'DORCAS', 'Diploma in Community Health(CHEW)', '9039258278', 'OGUN', '100', 'Female', '8062272454', '9039258278', '9039258278', '20240289.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(286, '20240290', 'AJAYI', 'JOSEPH', 'BOLUWATIFE', 'Diploma for Health Technicians(DE)', '9132743684', 'OSUN', '100', 'Male', '7061271579', '9132743684', '9132743684', '20240290.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(287, '20240291', 'Aderibigbe', 'Mumini', 'Juwon', 'Certificate for Pharmacy Technicians', '7045633957', 'OSUN', '100', 'Male', '7033679921', 'ribjay1234', 'Adejay12#', '20240291.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(288, '20240292', 'OLANREWAJU', 'NAFISAT ', 'BOLUWATIFE ', 'Certificate for Pharmacy Technicians', '8029923853', 'OYO', '100', 'Female', '9078444325', '8029923853', '8029923853', '20240292.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(289, '20240293', 'AZEEZ', 'MUJIDAT', 'AJOKE ', 'Diploma for Health Technicians(DE)', '8038427085', 'OYO', '100', 'Female', '9119398914', '8038427085', '8038427085', '20240293.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(290, '20240294', 'AWONIYI', 'BUNMI', 'DORCAS', 'Diploma in Community Health(CHEW)', '7086345290', 'OYO', '100', 'Female', '8057212308', '7086345290', '7086345290', '20240294.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(291, '20240295', 'Babatunde', 'Heritage', 'Oluwafunmilayo', 'Certificate for  Medical Laboratory Technicians(MLT)', '8123702475', 'OSUN', '100', 'Female', '9070307235', '8123702475', '8123702475', '20240295.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(292, '20240296', 'EMMANUEL', 'BLESSING ', 'MARY', 'Diploma in Community Health(CHEW)', '7044593765', 'KWARA', '100', 'Female', '9022306047', '7044593765', '7044593765', '20240296.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(293, '20240297', 'OKENIYI ', 'ARINOLA', 'TEMITOPE', 'Diploma in Community Health(CHEW)', '7080503189', 'OYO', '100', 'Female', '7018274508', '7080503189', '7080503189', '20240297.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(294, '20240298', 'SALAMI', 'KHADIJAT', 'ADEKEMI', 'ND Dental Nursing', '9118147366', 'OYO', 'NDI', 'Female', '9155788064', 'salamikhadijat', '9118147366', '20240298.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(295, '20240299', 'ENIOLA', 'OYENIKE ', 'ALICE', 'Diploma in Community Health(CHEW)(DE)', '8104038211', 'OYO', '200', 'Female', '8104038211', '8104038211', '8104038211', '20240299.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(296, '20240300', 'IYANDA', 'OLAITAN', 'JANET', 'Diploma in Community Health(CHEW)', '7033652307', 'OYO', '100', 'Female', '7030260548', '7033652307', '7033652307', '20240300.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(297, '20240301', 'OLADOKUN', 'ADEBISI', 'MIRACLE', 'Diploma in Community Health(CHEW)', '9119465656', 'OYO', '100', 'Female', '8117046046', '9119465656', '9119465656', '20240301.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(298, '20240302', 'Makanjuola', 'Rofiyat', 'Odunayo', 'Diploma in Community Health(CHEW)', '9058510070', 'OSUN', '100', 'Female', '9150827146', 'ROFIYAT', '9058510070', '20240302.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(299, '20240303', 'ISMAILA', 'ALIA', 'BOLANALE', 'Certificate in Community Health(JCHEW)', '7037681096', 'OYO', '100', 'Female', '80516555007', '7037681096', '7037681096', '20240303.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(300, '20240304', 'BELLO', 'SHAKIRAT', 'ADEOLA', 'Diploma in Community Health(CHEW)(DE)', '9037624262', 'OGUN', '200', 'Female', '8059778424', '9037624262', '9037624262', '20240304.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(301, '20240305', 'OLOJEDE', 'GRACE', 'ADEDOYIN', 'Certificate for  Medical Laboratory Technicians(MLT)', '9115331926', 'OYO', '100', 'Female', '7055697663', '9115331926', '9115331926', '20240305.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(302, '20240306', 'AKINYIMIKA', 'OLUWATOSIN', 'ENIOLA', 'Professional Diploma in Mental Health and Psychiatric Rehabilitation', '9129087391', 'OYO', '', 'Male', '8039504018', '9129087391', '9129087391', '20240306.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(303, '20240307', 'OGUNSOLA', 'FAITH', 'ADERONKE', 'Diploma in Community Health(CHEW)', '8156335890', 'OYO', '100', 'Female', '8058553603', '8156335890', '8156335890', '20240307.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(304, '20240308', 'FALUSI', 'IBUKUNOLUWA', 'MARY', 'Diploma for Health Technicians', '8064098661', 'EKITI', '100', 'Female', '8028602109', '8064098661', '8064098661', '20240308.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(305, '20240309', 'UCHOLA', 'GLORIA', 'OPEYEMI', 'Diploma in Community Health(CHEW)', '7082323239', 'OYO', '100', 'Female', '7055775178', '7082323239', '7082323239', '20240309.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(306, '20240310', 'OLAGUNJU', 'AZEEZAH', 'TOYOSI', 'Certificate in Community Health(JCHEW)', '8081869976', 'OYO', '100', 'Female', '7059176955', '8081869976', '8081869976', '20240310.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(307, '20240311', 'SHITTU', 'RUKAYAT', 'MOJISOLA', 'Professional Diploma in Health Information Management', '7065557202', 'OYO', '100', 'Female', '7065557202', 'MOJISOLA', 'MOJISOLA', '20240311.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(308, '20240312', 'OSHOBUE', 'ZAINAB', 'SERAH', 'Certificate for Health Assistants', '8132256565', 'EDO', '100', 'Female', '7031143271', '8132256565', '8132256565', '20240312.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(309, '20240313', 'FATOLA', 'ENIOLA', 'JULIANA', 'Diploma in Community Health(CHEW)', '9132938761', 'OYO', '100', 'Female', '8050749454', '9132938761', '9132938761', '20240313.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(310, '20240314', 'KAREEM', 'AMINAT', 'OLAYINKA', 'Certificate for  Medical Laboratory Technicians(MLT)', '7056390873', 'OYO', '100', 'Female', '805222999', '7056390873', '7056390873', '20240314.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(311, '20240315', 'SERIKI', 'KOYINSOLA', 'ABOLANLE', 'Certificate in Community Health(JCHEW)', '9013993534', 'OGUN', '100', 'Female', '8028308821', '9013993534', '9013993534', '20240315.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(312, '20240316', 'ADUFE', 'OLUWATIMILEYIN', 'COMFORT', 'Diploma for Health Technicians(DE)', '8133455627', 'EKITI', '100', 'Female', '8060946728', '8133455627', '8133455627', '20240316.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(313, '20240317', 'OGUNLEKE', 'BUSAYO', 'DEBORAH', 'Diploma in Community Health(CHEW)', '7015625706', 'OYO', '100', 'Female', '8066113351', '7015625706', '7015625706', '20240317.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(314, '20240318', 'Ajibolade', 'Feyisola', 'Leah', 'ND Dental Nursing', '9131119595', 'ONDO', 'NDI', 'Female', '8131848950', 'Feyisolaleah91', 'Ajifeyi@123', '20240318.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(315, '20240319', 'KOLAWOLE ', 'AMUDALAT', 'TAIWO', 'Certificate for Pharmacy Technicians', '9151362532', 'OYO', '100', 'Female', '8154111948', '9151362532', '9151362532', '20240319.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(316, '20240320', 'KAGBAFOLOHUN', 'QUWIYAT', 'OMOWUNMI', 'Certificate for Pharmacy Technicians', '9153026788', 'OYO', '100', 'Female', '8035755728', '9153026788', '9153026788', '20240320.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(317, '20240321', 'ADEOSUN', 'TABITHA', 'ADEBOLA', 'Certificate for Pharmacy Technicians', '9069703763', 'OYO', '100', 'Female', '8062197189', '9069703763', '9069703763', '20240321.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(318, '20240322', 'KAMORUDEEN ', 'RAMOTALLAHI', 'MOTUNRAYO ', 'Diploma in Community Health(CHEW)', '9060467152', 'OYO', '100', 'Female', '8074060712', '9060467152', '9060467152', '20240322.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(319, '20240323', 'OJEDOKUN', 'MARY', 'OLAMIDE', 'Diploma in Community Health(CHEW)', '8131357276', 'OYO', '100', 'Female', '8117351944', '8131357276', '8131357276', '20240323.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(320, '20240324', 'OGUNLADE', 'OLUWATOBILOBA', 'ESTHER', 'Certificate for Pharmacy Technicians', '7032069414', 'EKITI', '100', 'Female', '8032419849', 'OGUNLADEESTHER', 'OGUNLADEESTHER', '20240324.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(321, '20240325', 'ADESOKAN', 'ABIODUN', 'ESTHER', 'Diploma in Community Health(CHEW)', '7070489379', 'OSUN', '100', 'Female', '8037887478', '7070489379', '7070489379', '20240325.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(322, '20240326', 'ADEOSUN', 'OLAWUMI', 'COMFORT', 'Diploma in Community Health(CHEW)', '8100805394', 'OGUN', '100', 'Female', '8136057714', '8100805394', '8100805394', '20240326.jpg', '2023/2024', '0', 0, 'student', '2024-05-09 19:19:27', '2024-05-09 19:19:27'),
(328, '20221200', 'AKINYOOYE', 'AKINFEMI', 'EMMANUEL', 'Diploma in Community Health(CHEW)', '7032689329', 'OYO', '100', 'Male', '7032689329', '7032689329', '7032689329', '20221200.jpg', '2024/2025', '0', 0, 'student', '2024-05-12 20:43:22', '2024-05-14 03:46:29');

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cbt_evaluation2`
--
ALTER TABLE `cbt_evaluation2`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cbt_evaluations`
--
ALTER TABLE `cbt_evaluations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `college_setups`
--
ALTER TABLE `college_setups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=162;

--
-- AUTO_INCREMENT for table `question_settings`
--
ALTER TABLE `question_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `software_version`
--
ALTER TABLE `software_version`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `student_admissions`
--
ALTER TABLE `student_admissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=329;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
