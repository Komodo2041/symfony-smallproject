-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Czas generowania: 26 Wrz 2025, 15:09
-- Wersja serwera: 5.7.40
-- Wersja PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `symfo`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `budget`
--

DROP TABLE IF EXISTS `budget`;
CREATE TABLE IF NOT EXISTS `budget` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `saldo` float NOT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `del_time` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `budget`
--

INSERT INTO `budget` (`id`, `name`, `saldo`, `deleted`, `del_time`, `created_at`, `updated_at`) VALUES
(1, 'asdasdqweqwe', 556, 0, NULL, '2025-09-25 15:11:23', '2025-09-26 13:37:48'),
(2, 'bnvbnfghfg', -2333, 1, '2025-09-25 15:11:39', '2025-09-25 15:11:31', '2025-09-25 15:11:39'),
(3, 'agwa', -332, 0, NULL, '2025-09-25 15:16:07', '2025-09-26 13:37:44'),
(4, 'sdfsdf', 33, 0, NULL, '2025-09-25 15:19:14', '2025-09-25 15:19:14'),
(5, 'adasd', 222, 0, NULL, '2025-09-25 15:34:51', '2025-09-26 13:24:31'),
(6, 'sdfsdfsd', 33, 0, NULL, '2025-09-26 07:49:05', '2025-09-26 07:49:05'),
(7, 'gzimcomono', 555, 0, NULL, '2025-09-26 11:52:06', '2025-09-26 13:35:18'),
(8, 'zxczxcasas', -332, 0, NULL, '2025-09-26 13:22:37', '2025-09-26 13:22:37'),
(9, 'vcxvsdsdf', -323221, 0, NULL, '2025-09-26 13:35:05', '2025-09-26 13:35:05');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `contractor`
--

DROP TABLE IF EXISTS `contractor`;
CREATE TABLE IF NOT EXISTS `contractor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `del_time` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `contractor`
--

INSERT INTO `contractor` (`id`, `name`, `deleted`, `del_time`, `created_at`, `updated_at`) VALUES
(1, 'Laptop', 0, NULL, NULL, NULL),
(2, 'Laptop', 1, '2025-09-26 11:11:16', NULL, '2025-09-26 11:11:16'),
(3, 'Laptopsssss', 0, NULL, NULL, '2025-09-25 14:24:47'),
(4, 'Lapasdasdtop fffds', 0, NULL, NULL, '2025-09-26 07:48:53'),
(5, 'czxczx', 0, NULL, NULL, '2025-09-26 11:11:25'),
(6, 'Laptop', 0, NULL, NULL, NULL),
(7, 'asdasd22', 0, NULL, NULL, NULL),
(8, 'Laptop', 1, '2025-09-25 12:58:46', NULL, NULL),
(9, 'Laptop', 0, NULL, NULL, NULL),
(10, 'Laptopfdgdfgdfg migo', 0, NULL, NULL, NULL),
(11, 'Laptop', 1, '2025-09-25 13:57:20', NULL, NULL),
(12, 'Laptop', 1, '2025-10-01 00:00:00', NULL, NULL),
(13, 'ewrwer', 1, '2025-09-25 13:57:27', NULL, NULL),
(14, 'Laptop', 0, NULL, NULL, NULL),
(15, 'Laptopss', 0, NULL, NULL, NULL),
(16, 'Laptopagistolano', 0, NULL, NULL, NULL),
(17, 'Laptop', 1, '2025-09-25 13:01:54', NULL, NULL),
(18, 'Laptop', 0, NULL, NULL, NULL),
(19, 'Bobt', 1, '2025-09-26 11:11:20', NULL, '2025-09-26 11:11:20'),
(20, 's', 0, NULL, NULL, NULL),
(21, 'xczzxcs', 0, NULL, NULL, NULL),
(22, 'bziko', 0, NULL, NULL, NULL),
(23, 'manitooomi', 0, NULL, NULL, NULL),
(24, 'AAAAAAAAS', 0, NULL, NULL, NULL),
(25, 'zxccxvww2', 0, NULL, NULL, '2025-09-25 15:37:05'),
(26, 'infogoti', 0, NULL, NULL, NULL),
(27, 'aasd', 0, NULL, NULL, NULL),
(28, 'as', 0, NULL, NULL, NULL),
(29, 'asdas', 0, NULL, '2025-09-25 00:00:00', NULL),
(30, 'asd', 0, NULL, '2025-09-25 14:17:56', NULL),
(31, 'asdas', 0, NULL, '2025-09-25 14:18:34', NULL),
(32, 'ibeso', 0, NULL, '2025-09-25 14:18:52', NULL),
(33, 'asdasd', 0, NULL, '2025-09-25 14:20:43', '2025-09-25 14:20:43'),
(34, 'asdasdfff', 0, NULL, '2025-09-25 14:24:23', '2025-09-25 14:24:23'),
(35, 'xxd', 0, NULL, '2025-09-25 14:25:29', '2025-09-25 14:25:29'),
(36, 'dfsdf', 0, NULL, '2025-09-26 07:48:47', '2025-09-26 07:48:47');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `core`
--

DROP TABLE IF EXISTS `core`;
CREATE TABLE IF NOT EXISTS `core` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(50) DEFAULT NULL,
  `rel_id` int(11) NOT NULL,
  `warning` varchar(256) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `del_time` datetime DEFAULT NULL,
  `deleted` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `core`
--

INSERT INTO `core` (`id`, `type`, `rel_id`, `warning`, `created_at`, `updated_at`, `del_time`, `deleted`) VALUES
(1, 'budget', 5, 'Budget minus', '2025-09-26 13:17:35', '2025-09-26 13:34:06', '2025-09-26 13:34:06', 1),
(2, 'budget', 7, 'Budget minus', '2025-09-26 13:17:35', '2025-09-26 13:35:22', '2025-09-26 13:35:22', 1),
(3, 'budget', 8, 'Budget minus', '2025-09-26 13:23:18', '2025-09-26 13:23:18', NULL, 0),
(4, 'budget', 1, 'Budget minus', '2025-09-26 13:35:22', '2025-09-26 13:37:52', '2025-09-26 13:37:52', 1),
(5, 'budget', 9, 'Budget minus', '2025-09-26 13:35:22', '2025-09-26 13:35:22', NULL, 0),
(6, 'budget', 3, 'Budget minus', '2025-09-26 13:37:52', '2025-09-26 14:25:30', '2025-09-26 14:25:30', 1),
(7, 'invoice', 1, 'Nieplacona faktura', '2025-09-26 14:12:41', '2025-09-26 14:12:41', NULL, 0),
(8, 'budget', 3, 'Budget minus', '2025-09-26 14:28:36', '2025-09-26 14:28:36', NULL, 0),
(9, 'invoice', 5, 'Nieplacona faktura', '2025-09-26 14:46:43', '2025-09-26 15:05:50', '2025-09-26 15:05:50', 1),
(10, 'contractor', 23, 'Klient ma duzo nieoplaconych faktur', '2025-09-26 15:05:06', '2025-09-26 15:05:50', '2025-09-26 15:05:50', 1),
(11, 'invoice', 6, 'Nieplacona faktura', '2025-09-26 15:05:50', '2025-09-26 15:05:50', NULL, 0),
(12, 'contractor', 25, 'Klient ma duzo nieoplaconych faktur', '2025-09-26 15:05:50', '2025-09-26 15:05:50', NULL, 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `invoice`
--

DROP TABLE IF EXISTS `invoice`;
CREATE TABLE IF NOT EXISTS `invoice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` varchar(256) NOT NULL,
  `contractor_id` int(11) NOT NULL,
  `amount` float NOT NULL,
  `status` tinyint(4) NOT NULL,
  `delayed_date` date NOT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `del_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `invoice`
--

INSERT INTO `invoice` (`id`, `uid`, `contractor_id`, `amount`, `status`, `delayed_date`, `deleted`, `created_at`, `updated_at`, `del_time`) VALUES
(1, '68d66d0d16dc4', 24, 3322, 0, '2025-09-20', 0, '2025-09-26 10:38:05', '2025-09-26 11:08:43', NULL),
(2, '68d66d7bdc940', 19, 33, 1, '2025-10-04', 0, '2025-09-26 10:39:56', '2025-09-26 10:39:56', NULL),
(3, '68d66d99e82e9', 19, 4343, 1, '2025-09-12', 1, '2025-09-26 10:40:26', '2025-09-26 10:54:44', '2025-09-26 10:54:44'),
(4, '68d674c4a56cf', 18, 3321, 0, '2025-09-28', 0, '2025-09-26 11:11:01', '2025-09-26 11:11:09', NULL),
(5, '68d6a74101e5a', 23, 170000, 1, '2025-09-12', 0, '2025-09-26 14:46:25', '2025-09-26 15:05:42', NULL),
(6, '68d6abbdf1af4', 25, 18000, 0, '2025-09-14', 0, '2025-09-26 15:05:34', '2025-09-26 15:05:34', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
