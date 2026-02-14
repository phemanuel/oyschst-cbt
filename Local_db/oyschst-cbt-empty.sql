-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 26, 2026 at 05:54 PM
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
  `OK101` text DEFAULT NULL,
  `OK102` text DEFAULT NULL,
  `OK103` text DEFAULT NULL,
  `OK104` text DEFAULT NULL,
  `OK105` text DEFAULT NULL,
  `OK106` text DEFAULT NULL,
  `OK107` text DEFAULT NULL,
  `OK108` text DEFAULT NULL,
  `OK109` text DEFAULT NULL,
  `OK110` text DEFAULT NULL,
  `OK111` text DEFAULT NULL,
  `OK112` text DEFAULT NULL,
  `OK113` text DEFAULT NULL,
  `OK114` text DEFAULT NULL,
  `OK115` text DEFAULT NULL,
  `OK116` text DEFAULT NULL,
  `OK117` text DEFAULT NULL,
  `OK118` text DEFAULT NULL,
  `OK119` text DEFAULT NULL,
  `OK120` text DEFAULT NULL,
  `OK121` text DEFAULT NULL,
  `OK122` text DEFAULT NULL,
  `OK123` text DEFAULT NULL,
  `OK124` text DEFAULT NULL,
  `OK125` text DEFAULT NULL,
  `OK126` text DEFAULT NULL,
  `OK127` text DEFAULT NULL,
  `OK128` text DEFAULT NULL,
  `OK129` text DEFAULT NULL,
  `OK130` text DEFAULT NULL,
  `OK131` text DEFAULT NULL,
  `OK132` text DEFAULT NULL,
  `OK133` text DEFAULT NULL,
  `OK134` text DEFAULT NULL,
  `OK135` text DEFAULT NULL,
  `OK136` text DEFAULT NULL,
  `OK137` text DEFAULT NULL,
  `OK138` text DEFAULT NULL,
  `OK139` text DEFAULT NULL,
  `OK140` text DEFAULT NULL,
  `OK141` text DEFAULT NULL,
  `OK142` text DEFAULT NULL,
  `OK143` text DEFAULT NULL,
  `OK144` text DEFAULT NULL,
  `OK145` text DEFAULT NULL,
  `OK146` text DEFAULT NULL,
  `OK147` text DEFAULT NULL,
  `OK148` text DEFAULT NULL,
  `OK149` text DEFAULT NULL,
  `OK150` text DEFAULT NULL,
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
  `OK101` text DEFAULT NULL,
  `OK102` text DEFAULT NULL,
  `OK103` text DEFAULT NULL,
  `OK104` text DEFAULT NULL,
  `OK105` text DEFAULT NULL,
  `OK106` text DEFAULT NULL,
  `OK107` text DEFAULT NULL,
  `OK108` text DEFAULT NULL,
  `OK109` text DEFAULT NULL,
  `OK110` text DEFAULT NULL,
  `OK111` text DEFAULT NULL,
  `OK112` text DEFAULT NULL,
  `OK113` text DEFAULT NULL,
  `OK114` text DEFAULT NULL,
  `OK115` text DEFAULT NULL,
  `OK116` text DEFAULT NULL,
  `OK117` text DEFAULT NULL,
  `OK118` text DEFAULT NULL,
  `OK119` text DEFAULT NULL,
  `OK120` text DEFAULT NULL,
  `OK121` text DEFAULT NULL,
  `OK122` text DEFAULT NULL,
  `OK123` text DEFAULT NULL,
  `OK124` text DEFAULT NULL,
  `OK125` text DEFAULT NULL,
  `OK126` text DEFAULT NULL,
  `OK127` text DEFAULT NULL,
  `OK128` text DEFAULT NULL,
  `OK129` text DEFAULT NULL,
  `OK130` text DEFAULT NULL,
  `OK131` text DEFAULT NULL,
  `OK132` text DEFAULT NULL,
  `OK133` text DEFAULT NULL,
  `OK134` text DEFAULT NULL,
  `OK135` text DEFAULT NULL,
  `OK136` text DEFAULT NULL,
  `OK137` text DEFAULT NULL,
  `OK138` text DEFAULT NULL,
  `OK139` text DEFAULT NULL,
  `OK140` text DEFAULT NULL,
  `OK141` text DEFAULT NULL,
  `OK142` text DEFAULT NULL,
  `OK143` text DEFAULT NULL,
  `OK144` text DEFAULT NULL,
  `OK145` text DEFAULT NULL,
  `OK146` text DEFAULT NULL,
  `OK147` text DEFAULT NULL,
  `OK148` text DEFAULT NULL,
  `OK149` text DEFAULT NULL,
  `OK150` text DEFAULT NULL,
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
  `A101` int(11) DEFAULT NULL,
  `A102` int(11) DEFAULT NULL,
  `A103` int(11) DEFAULT NULL,
  `A104` int(11) DEFAULT NULL,
  `A105` int(11) DEFAULT NULL,
  `A106` int(11) DEFAULT NULL,
  `A107` int(11) DEFAULT NULL,
  `A108` int(11) DEFAULT NULL,
  `A109` int(11) DEFAULT NULL,
  `A110` int(11) DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  `exam_mode` varchar(255) DEFAULT NULL,
  `exam_category` varchar(255) DEFAULT NULL,
  `course` varchar(255) DEFAULT NULL,
  `pageno` varchar(255) DEFAULT NULL,
  `examdate` datetime DEFAULT NULL,
  `exam_type` varchar(255) DEFAULT NULL,
  `msgstatus` varchar(255) DEFAULT NULL,
  `starttime` datetime DEFAULT NULL,
  `endtime` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `A111` int(11) DEFAULT NULL,
  `A112` int(11) DEFAULT NULL,
  `A113` int(11) DEFAULT NULL,
  `A114` int(11) DEFAULT NULL,
  `A115` int(11) DEFAULT NULL,
  `A116` int(11) DEFAULT NULL,
  `A117` int(11) DEFAULT NULL,
  `A118` int(11) DEFAULT NULL,
  `A119` int(11) DEFAULT NULL,
  `A120` int(11) DEFAULT NULL,
  `A121` int(11) DEFAULT NULL,
  `A122` int(11) DEFAULT NULL,
  `A123` int(11) DEFAULT NULL,
  `A124` int(11) DEFAULT NULL,
  `A125` int(11) DEFAULT NULL,
  `A126` int(11) DEFAULT NULL,
  `A127` int(11) DEFAULT NULL,
  `A128` int(11) DEFAULT NULL,
  `A129` int(11) DEFAULT NULL,
  `A130` int(11) DEFAULT NULL,
  `A131` int(11) DEFAULT NULL,
  `A132` int(11) DEFAULT NULL,
  `A133` int(11) DEFAULT NULL,
  `A134` int(11) DEFAULT NULL,
  `A135` int(11) DEFAULT NULL,
  `A136` int(11) DEFAULT NULL,
  `A137` int(11) DEFAULT NULL,
  `A138` int(11) DEFAULT NULL,
  `A139` int(11) DEFAULT NULL,
  `A140` int(11) DEFAULT NULL,
  `A141` int(11) DEFAULT NULL,
  `A142` int(11) DEFAULT NULL,
  `A143` int(11) DEFAULT NULL,
  `A144` int(11) DEFAULT NULL,
  `A145` int(11) DEFAULT NULL,
  `A146` int(11) DEFAULT NULL,
  `A147` int(11) DEFAULT NULL,
  `A148` int(11) DEFAULT NULL,
  `A149` int(11) DEFAULT NULL,
  `A150` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, 'Oyo State College of Health Science and Technology', 'info@oyschst.edu.ng', 'college/avatar.png', '08035882299', 'Beside fan-milk, Eleyele,Ibadan, Oyo State', 'http://oyschst.edu.ng', '2024-05-10 02:04:36', '2024-05-10 03:16:59');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `programme` varchar(255) DEFAULT NULL,
  `level` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `course_study_all`
--

CREATE TABLE `course_study_all` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `department` varchar(100) NOT NULL,
  `dept` varchar(100) NOT NULL,
  `start_level` varchar(10) NOT NULL,
  `duration` int(5) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `departments_recruitment`
--

CREATE TABLE `departments_recruitment` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `department` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments_recruitment`
--

INSERT INTO `departments_recruitment` (`id`, `department`, `created_at`, `updated_at`) VALUES
(1, 'Assistant Lecturer(Health Information Management)', NULL, NULL),
(2, 'Assistant Lecturer(Scientific Officer-Anatomy)', NULL, NULL),
(3, 'Assistant Lecturer(Nutrition Officer II)', NULL, NULL),
(4, 'Technologist II (Environmental Health)', NULL, NULL),
(5, 'Medical Laboratory Technician', NULL, NULL),
(6, 'Assistant Lecturer(Social Work)', NULL, NULL),
(7, 'Librarian II', NULL, NULL),
(8, 'Pharmacy Technician', NULL, NULL),
(9, 'Community Health Extension Worker', NULL, NULL),
(10, 'Assistant Lecturer(Primary Health Care)', NULL, NULL),
(11, 'X-Ray Technician', NULL, NULL),
(12, 'Administrative Officer II', NULL, NULL),
(13, 'Higher Executive Officer', NULL, NULL),
(14, 'Instructor II(Dental Therapy)', NULL, NULL),
(15, 'Confidential Secretary', NULL, NULL),
(16, 'Dental Surgery Technician', '2025-06-03 06:12:57', '2025-06-03 06:12:57'),
(17, 'Assistant Lecturer(Scientific Officer-Biology)', NULL, NULL),
(18, 'Assistant Lecturer(Scientific Officer-Microbiology)', NULL, NULL),
(19, 'Assistant Lecturer(Scientific Officer-Chemistry)', '2025-06-03 11:14:05', '2025-06-03 11:14:05'),
(20, 'ACCOUNT', '2025-06-03 13:16:58', '2025-06-03 13:16:58'),
(21, 'Administrative Officer(Procurement)', '2025-06-03 13:17:23', '2025-06-03 13:17:23');

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
  `duration` int(11) NOT NULL,
  `upload_no_of_qst` int(11) NOT NULL,
  `no_of_qst` int(11) NOT NULL,
  `check_result` int(11) NOT NULL,
  `exam_date` date DEFAULT NULL,
  `lock_status` int(11) NOT NULL,
  `exam_view_type` varchar(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, '127.0.0.1', 'admin@gmail.com', '2024-05-08 23:52:37', '2024-05-08 23:52:37'),
(2, '127.0.0.1', 'admin@gmail.com', '2024-05-14 14:16:49', '2024-05-14 14:16:49'),
(3, '192.168.0.13', 'eclement66g53@gmail.com', '2024-06-25 17:35:10', '2024-06-25 17:35:10'),
(4, '192.168.0.251', 'paulawolola@gmail.com', '2024-07-22 16:57:01', '2024-07-22 16:57:01'),
(5, '192.168.0.251', 'paulawolola@gmail.com', '2024-07-22 17:20:26', '2024-07-22 17:20:26');

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
(1, 1, 1, '2024-05-09 18:19:26', '2024-05-09 18:19:26');

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
(30, '2024_05_30_021219_create_theory_answers_table', 14),
(31, '2024_06_13_174950_add_roles_to_users_table', 15),
(32, '2024_06_14_201603_add_roles_to_users_table', 16),
(33, '2024_10_01_154513_add_programme_to_courses_table', 17),
(34, '2025_01_14_095102_create_question_singles_table', 17);

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

-- --------------------------------------------------------

--
-- Table structure for table `question_settings`
--

CREATE TABLE `question_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `session1` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `course` varchar(255) NOT NULL,
  `upload_no_of_qst` int(11) NOT NULL,
  `no_of_qst` int(11) NOT NULL,
  `level` varchar(255) NOT NULL,
  `semester` varchar(255) NOT NULL,
  `duration` int(11) NOT NULL,
  `exam_type` varchar(255) NOT NULL,
  `exam_category` varchar(255) NOT NULL,
  `exam_status` enum('Active','Inactive') NOT NULL,
  `exam_mode` varchar(255) NOT NULL,
  `exam_date` date NOT NULL,
  `check_result` int(11) NOT NULL,
  `lock_status` int(11) NOT NULL,
  `exam_view_type` varchar(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `question_singles`
--

CREATE TABLE `question_singles` (
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
  `answer` varchar(255) NOT NULL,
  `question` text NOT NULL,
  `graphic` varchar(255) NOT NULL,
  `course` varchar(255) NOT NULL,
  `semester` varchar(255) NOT NULL,
  `option_a` text NOT NULL,
  `option_b` text NOT NULL,
  `option_c` text NOT NULL,
  `option_d` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, 'Computer Based Test', '2.5.1', '2024-05-09 18:19:26', '2024-05-09 18:19:26');

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
  `department1` text DEFAULT NULL,
  `phone_no` text DEFAULT NULL,
  `state` text DEFAULT NULL,
  `level` text DEFAULT NULL,
  `previous_level` varchar(255) DEFAULT NULL,
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
  `user_type` varchar(255) NOT NULL,
  `user_status` enum('Active','Inactive') NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_status` int(11) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `login_attempts` int(11) NOT NULL,
  `exam_setting` int(11) NOT NULL,
  `edit_exam_setting` int(11) NOT NULL,
  `qst_bank` int(11) NOT NULL,
  `create_question_bank` int(11) NOT NULL,
  `edit_question_bank` int(11) NOT NULL,
  `std_list` int(11) NOT NULL,
  `create_std_list` int(11) NOT NULL,
  `edit_std_list` int(11) NOT NULL,
  `delete_std_list` int(11) NOT NULL,
  `std_login_status` int(11) NOT NULL,
  `edit_std_login_status` int(11) NOT NULL,
  `change_course` int(11) NOT NULL,
  `edit_change_course` int(11) NOT NULL,
  `user_create` int(11) NOT NULL,
  `create_user_create` int(11) NOT NULL,
  `edit_user_create` int(11) NOT NULL,
  `status_user_create` int(11) NOT NULL,
  `college_setup` int(11) NOT NULL,
  `create_college_setup` int(11) NOT NULL,
  `edit_college_setup` int(11) NOT NULL,
  `delete_college_setup` int(11) NOT NULL,
  `report` int(11) NOT NULL,
  `check_report` int(11) NOT NULL,
  `export_report` int(11) NOT NULL,
  `grading_report` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_type`, `user_status`, `name`, `email`, `email_verified_status`, `email_verified_at`, `password`, `remember_token`, `login_attempts`, `exam_setting`, `edit_exam_setting`, `qst_bank`, `create_question_bank`, `edit_question_bank`, `std_list`, `create_std_list`, `edit_std_list`, `delete_std_list`, `std_login_status`, `edit_std_login_status`, `change_course`, `edit_change_course`, `user_create`, `create_user_create`, `edit_user_create`, `status_user_create`, `college_setup`, `create_college_setup`, `edit_college_setup`, `delete_college_setup`, `report`, `check_report`, `export_report`, `grading_report`, `created_at`, `updated_at`) VALUES
(1, 'superadmin', 'Active', 'Admin CBT', 'admin@gmail.com', 1, NULL, '$2y$12$ZnTRyBs.WISiLa5h/2lwxu3.zl1UR6I8Jn8DftqX4I3swyQIHBQS2', NULL, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, '2024-05-09 18:19:26', '2026-01-21 11:15:18');

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
-- Indexes for table `course_study_all`
--
ALTER TABLE `course_study_all`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments_recruitment`
--
ALTER TABLE `departments_recruitment`
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
-- Indexes for table `question_singles`
--
ALTER TABLE `question_singles`
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
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academic_sessions`
--
ALTER TABLE `academic_sessions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `cbt_evaluation1`
--
ALTER TABLE `cbt_evaluation1`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cbt_evaluation2`
--
ALTER TABLE `cbt_evaluation2`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cbt_evaluations`
--
ALTER TABLE `cbt_evaluations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `college_setups`
--
ALTER TABLE `college_setups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `course_study_all`
--
ALTER TABLE `course_study_all`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `departments_recruitment`
--
ALTER TABLE `departments_recruitment`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `exam_settings`
--
ALTER TABLE `exam_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exam_types`
--
ALTER TABLE `exam_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loading_checks`
--
ALTER TABLE `loading_checks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `question_settings`
--
ALTER TABLE `question_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `question_singles`
--
ALTER TABLE `question_singles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_admissions`
--
ALTER TABLE `student_admissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
