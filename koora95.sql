-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 18, 2017 at 11:17 AM
-- Server version: 5.5.57-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `koora95`
--
CREATE DATABASE IF NOT EXISTS `koora95` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `koora95`;

-- --------------------------------------------------------

--
-- Table structure for table `competitions`
--

DROP TABLE IF EXISTS `competitions`;
CREATE TABLE IF NOT EXISTS `competitions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comp_type_id` int(11) NOT NULL,
  `location_id` int(10) unsigned NOT NULL,
  `location_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `competitions_name_unique` (`name`),
  KEY `competitions_location_id_location_type_index` (`location_id`,`location_type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=8 ;

--
-- Truncate table before insert `competitions`
--

TRUNCATE TABLE `competitions`;
--
-- Dumping data for table `competitions`
--

INSERT INTO `competitions` (`id`, `name`, `comp_type_id`, `location_id`, `location_type`, `created_at`, `updated_at`) VALUES
(1, 'Egyptian League', 1, 3, 'App\\Country', NULL, NULL),
(2, 'Egyptian cup', 1, 10, 'App\\Country', NULL, NULL),
(3, 'Premiere League', 1, 7, 'App\\Country', NULL, NULL),
(4, 'La Liga', 1, 6, 'App\\Country', NULL, NULL),
(5, 'Bundesliga', 1, 8, 'App\\Country', NULL, NULL),
(6, 'SeriaA', 1, 2, 'App\\Country', NULL, NULL),
(7, 'American league', 1, 1, 'App\\Country', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `competition_scopes`
--

DROP TABLE IF EXISTS `competition_scopes`;
CREATE TABLE IF NOT EXISTS `competition_scopes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=4 ;

--
-- Truncate table before insert `competition_scopes`
--

TRUNCATE TABLE `competition_scopes`;
--
-- Dumping data for table `competition_scopes`
--

INSERT INTO `competition_scopes` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Local', '2017-12-14 11:38:09', '2017-12-14 11:38:09'),
(2, 'Continental', '2017-12-14 11:38:09', '2017-12-14 11:38:09'),
(3, 'Global', '2017-12-14 11:38:09', '2017-12-14 11:38:09');

-- --------------------------------------------------------

--
-- Table structure for table `competition_types`
--

DROP TABLE IF EXISTS `competition_types`;
CREATE TABLE IF NOT EXISTS `competition_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=3 ;

--
-- Truncate table before insert `competition_types`
--

TRUNCATE TABLE `competition_types`;
--
-- Dumping data for table `competition_types`
--

INSERT INTO `competition_types` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'League', '2017-12-14 11:38:09', '2017-12-14 11:38:09'),
(2, 'Cup', '2017-12-14 11:38:09', '2017-12-14 11:38:09');

-- --------------------------------------------------------

--
-- Table structure for table `continents`
--

DROP TABLE IF EXISTS `continents`;
CREATE TABLE IF NOT EXISTS `continents` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=7 ;

--
-- Truncate table before insert `continents`
--

TRUNCATE TABLE `continents`;
--
-- Dumping data for table `continents`
--

INSERT INTO `continents` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Africa', '2017-12-14 11:38:08', '2017-12-14 11:38:08'),
(2, 'Asia', '2017-12-14 11:38:08', '2017-12-14 11:38:08'),
(3, 'Europe', '2017-12-14 11:38:08', '2017-12-14 11:38:08'),
(4, 'North America', '2017-12-14 11:38:08', '2017-12-14 11:38:08'),
(5, 'Australia', '2017-12-14 11:38:09', '2017-12-14 11:38:09'),
(6, 'South America', '2017-12-14 11:38:09', '2017-12-14 11:38:09');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
CREATE TABLE IF NOT EXISTS `countries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `continent_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `countries_name_unique` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=11 ;

--
-- Truncate table before insert `countries`
--

TRUNCATE TABLE `countries`;
--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `continent_id`, `created_at`, `updated_at`) VALUES
(1, 'Cambodia', 1, '2017-12-14 11:38:09', '2017-12-14 11:38:09'),
(2, 'India', 6, '2017-12-14 11:38:09', '2017-12-14 11:38:09'),
(3, 'Mauritania', 3, '2017-12-14 11:38:09', '2017-12-14 11:38:09'),
(4, 'Mongolia', 3, '2017-12-14 11:38:09', '2017-12-14 11:38:09'),
(5, 'Guinea', 2, '2017-12-14 11:38:09', '2017-12-14 11:38:09'),
(6, 'Marshall Islands', 1, '2017-12-14 11:38:09', '2017-12-14 11:38:09'),
(7, 'Canada', 3, '2017-12-14 11:38:09', '2017-12-14 11:38:09'),
(8, 'Ethiopia', 3, '2017-12-14 11:38:09', '2017-12-14 11:38:09'),
(9, 'Kyrgyz Republic', 3, '2017-12-14 11:38:09', '2017-12-14 11:38:09'),
(10, 'United States of America', 5, '2017-12-14 11:38:09', '2017-12-14 11:38:09');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stage_id` int(11) NOT NULL,
  `rounds_number` int(11) NOT NULL,
  `teams_number` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `groups_name_stage_id_unique` (`name`,`stage_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=11 ;

--
-- Truncate table before insert `groups`
--

TRUNCATE TABLE `groups`;
--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `stage_id`, `rounds_number`, `teams_number`, `created_at`, `updated_at`) VALUES
(1, 'A', 2, 3, 4, '2017-12-14 11:45:43', '2017-12-14 11:45:43'),
(2, 'B', 2, 3, 4, '2017-12-14 11:45:43', '2017-12-14 11:45:43'),
(3, 'A', 3, 3, 4, '2017-12-14 11:48:28', '2017-12-14 11:48:28'),
(4, 'B', 3, 3, 4, '2017-12-14 11:48:28', '2017-12-14 11:48:28'),
(5, 'A', 4, 3, 4, '2017-12-14 11:54:16', '2017-12-14 11:54:16'),
(6, 'B', 4, 3, 4, '2017-12-14 11:54:16', '2017-12-14 11:54:16'),
(7, 'A', 5, 6, 4, '2017-12-14 11:54:35', '2017-12-14 11:54:35'),
(8, 'B', 5, 6, 4, '2017-12-14 11:54:36', '2017-12-14 11:54:36'),
(10, 'B', 10, 6, 4, '2017-12-17 20:46:29', '2017-12-17 20:46:29');

-- --------------------------------------------------------

--
-- Table structure for table `group_rounds`
--

DROP TABLE IF EXISTS `group_rounds`;
CREATE TABLE IF NOT EXISTS `group_rounds` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `stage_id` int(11) NOT NULL,
  `round_number` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=25 ;

--
-- Truncate table before insert `group_rounds`
--

TRUNCATE TABLE `group_rounds`;
--
-- Dumping data for table `group_rounds`
--

INSERT INTO `group_rounds` (`id`, `stage_id`, `round_number`, `created_at`, `updated_at`) VALUES
(1, 2, 1, NULL, NULL),
(2, 2, 2, NULL, NULL),
(3, 2, 3, NULL, NULL),
(4, 2, 1, NULL, NULL),
(5, 2, 2, NULL, NULL),
(6, 2, 3, NULL, NULL),
(7, 3, 1, NULL, NULL),
(8, 3, 2, NULL, NULL),
(9, 3, 3, NULL, NULL),
(10, 4, 1, NULL, NULL),
(11, 4, 2, NULL, NULL),
(12, 4, 3, NULL, NULL),
(13, 5, 1, NULL, NULL),
(14, 5, 2, NULL, NULL),
(15, 5, 3, NULL, NULL),
(16, 5, 4, NULL, NULL),
(17, 5, 5, NULL, NULL),
(18, 5, 6, NULL, NULL),
(19, 10, 1, NULL, NULL),
(20, 10, 2, NULL, NULL),
(21, 10, 3, NULL, NULL),
(22, 10, 4, NULL, NULL),
(23, 10, 5, NULL, NULL),
(24, 10, 6, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `group_teams`
--

DROP TABLE IF EXISTS `group_teams`;
CREATE TABLE IF NOT EXISTS `group_teams` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `register_team_id` int(11) NOT NULL,
  `played` int(11) NOT NULL,
  `wins` int(11) NOT NULL,
  `losses` int(11) NOT NULL,
  `draws` int(11) NOT NULL,
  `goals_for` int(11) NOT NULL,
  `goals_against` int(11) NOT NULL,
  `points` int(11) NOT NULL,
  `red_cards` int(11) NOT NULL,
  `yellow_cards` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `group_teams_group_id_register_team_id_unique` (`group_id`,`register_team_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=8 ;

--
-- Truncate table before insert `group_teams`
--

TRUNCATE TABLE `group_teams`;
--
-- Dumping data for table `group_teams`
--

INSERT INTO `group_teams` (`id`, `group_id`, `register_team_id`, `played`, `wins`, `losses`, `draws`, `goals_for`, `goals_against`, `points`, `red_cards`, `yellow_cards`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, 0, 0, 2, 1, 3, 0, 1, NULL, NULL),
(2, 1, 2, 1, 0, 1, 0, 1, 2, 0, 1, 2, NULL, NULL),
(4, 1, 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(5, 1, 5, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(6, 9, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(7, 9, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `matches`
--

DROP TABLE IF EXISTS `matches`;
CREATE TABLE IF NOT EXISTS `matches` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `season_id` int(11) NOT NULL,
  `stage_id` int(11) NOT NULL,
  `group_round_id` int(11) DEFAULT NULL,
  `group_id` int(20) DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `register_team_1_id` int(11) NOT NULL,
  `register_team_2_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `stadium` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `team_1_goals` int(11) NOT NULL,
  `team_2_goals` int(11) NOT NULL,
  `winner_id` int(11) NOT NULL,
  `red_cards` int(11) NOT NULL,
  `yellow_cards` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=9 ;

--
-- Truncate table before insert `matches`
--

TRUNCATE TABLE `matches`;
--
-- Dumping data for table `matches`
--

INSERT INTO `matches` (`id`, `season_id`, `stage_id`, `group_round_id`, `group_id`, `status`, `register_team_1_id`, `register_team_2_id`, `date`, `time`, `stadium`, `team_1_goals`, `team_2_goals`, `winner_id`, `red_cards`, `yellow_cards`, `created_at`, `updated_at`) VALUES
(1, 9, 2, 1, 1, 'Not Player Yet', 1, 2, '2017-12-20', '16:30:00', 'Cairo', 0, 0, 0, 0, 0, NULL, NULL),
(2, 9, 6, NULL, NULL, 'played', 1, 2, '2017-12-20', '16:30:00', 'Cairo', 2, 1, 1, 1, 3, NULL, NULL),
(3, 9, 6, NULL, NULL, 'Not Played Yet', 1, 2, '2017-12-20', '16:30:00', 'Cairo', 0, 0, 0, 0, 0, NULL, NULL),
(4, 9, 6, NULL, NULL, 'Not Played Yet', 1, 2, '2017-12-20', '16:30:00', 'Cairo', 0, 0, 0, 0, 0, NULL, NULL),
(5, 9, 6, NULL, NULL, 'Not Played Yet', 1, 2, '2017-12-20', '16:30:00', 'Cairo', 0, 0, 0, 0, 0, NULL, NULL),
(6, 9, 2, NULL, NULL, 'Not Played Yet', 1, 2, '2017-12-20', '16:30:00', 'Cairo', 0, 0, 0, 0, 0, NULL, NULL),
(7, 9, 2, NULL, NULL, 'Not Played Yet', 1, 2, '2017-12-18', '16:30:00', 'Cairo', 0, 0, 0, 0, 0, NULL, NULL),
(8, 9, 2, 1, 1, 'played', 1, 2, '2017-12-20', '16:30:00', 'Cairo', 2, 1, 1, 1, 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=21 ;

--
-- Truncate table before insert `migrations`
--

TRUNCATE TABLE `migrations`;
--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2017_12_04_111019_create_continents_table', 1),
(4, '2017_12_04_112612_create_countries_table', 1),
(5, '2017_12_04_113157_create_competitions_table', 1),
(6, '2017_12_04_113727_create_seasons_table', 1),
(7, '2017_12_04_114134_create_teams_table', 1),
(8, '2017_12_04_114310_create_players_table', 1),
(9, '2017_12_04_114600_create_competition_types_table', 1),
(10, '2017_12_04_114632_create_competition_scopes_table', 1),
(11, '2017_12_04_114700_create_team_types_table', 1),
(12, '2017_12_06_085518_create_registered_teams_table', 1),
(13, '2017_12_06_090914_create_registered_players_table', 1),
(14, '2017_12_06_111728_create_matches_table', 1),
(15, '2017_12_10_141728_create_weeks_table', 1),
(16, '2017_12_10_141738_create_rounds_table', 1),
(17, '2017_12_11_103150_create_stages_table', 1),
(18, '2017_12_11_134152_create_groups_table', 1),
(19, '2017_12_12_080446_create_group_teams_table', 1),
(20, '2017_12_14_090334_create_group_rounds_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Truncate table before insert `password_resets`
--

TRUNCATE TABLE `password_resets`;
-- --------------------------------------------------------

--
-- Table structure for table `players`
--

DROP TABLE IF EXISTS `players`;
CREATE TABLE IF NOT EXISTS `players` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `team_id` int(11) DEFAULT NULL,
  `country_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=501 ;

--
-- Truncate table before insert `players`
--

TRUNCATE TABLE `players`;
--
-- Dumping data for table `players`
--

INSERT INTO `players` (`id`, `name`, `position`, `team_id`, `country_id`, `created_at`, `updated_at`) VALUES
(1, 'Prof. Ruthe Crist', 'SS', 10, 10, '2017-12-14 11:38:39', '2017-12-14 11:38:39'),
(2, 'Hosea Williamson', 'LB', 338, 10, '2017-12-14 11:38:39', '2017-12-14 11:38:39'),
(3, 'Ms. Bessie Murphy', 'GK', 388, 10, '2017-12-14 11:38:39', '2017-12-14 11:38:39'),
(4, 'Mr. Ervin Dibbert', 'CM', 95, 10, '2017-12-14 11:38:39', '2017-12-14 11:38:39'),
(5, 'Neil Brakus', 'RB', 212, 10, '2017-12-14 11:38:39', '2017-12-14 11:38:39'),
(6, 'Prof. Leonardo Kunde', 'WM', 499, 10, '2017-12-14 11:38:39', '2017-12-14 11:38:39'),
(7, 'Tavares Pfannerstill', 'WF', 120, 10, '2017-12-14 11:38:39', '2017-12-14 11:38:39'),
(8, 'Mrs. Elfrieda Armstrong', 'CM', 313, 10, '2017-12-14 11:38:39', '2017-12-14 11:38:39'),
(9, 'Fiona Breitenberg', 'LWB', 238, 10, '2017-12-14 11:38:39', '2017-12-14 11:38:39'),
(10, 'Kay Halvorson', 'AM', 157, 10, '2017-12-14 11:38:40', '2017-12-14 11:38:40'),
(11, 'Dr. Werner Marvin', 'SW', 130, 10, '2017-12-14 11:38:40', '2017-12-14 11:38:40'),
(12, 'Prof. Hollie Sawayn', 'CM', 455, 10, '2017-12-14 11:38:40', '2017-12-14 11:38:40'),
(13, 'Dr. Jarrett Murphy IV', 'GK', 337, 10, '2017-12-14 11:38:40', '2017-12-14 11:38:40'),
(14, 'Ms. Lavinia Skiles', 'LB', 149, 10, '2017-12-14 11:38:40', '2017-12-14 11:38:40'),
(15, 'Dr. Domenica Lind', 'WF', 466, 10, '2017-12-14 11:38:40', '2017-12-14 11:38:40'),
(16, 'Cyrus Ankunding V', 'SW', 314, 10, '2017-12-14 11:38:40', '2017-12-14 11:38:40'),
(17, 'Jefferey Reichert', 'DM', 130, 10, '2017-12-14 11:38:40', '2017-12-14 11:38:40'),
(18, 'Gerry Hirthe', 'CF', 209, 10, '2017-12-14 11:38:40', '2017-12-14 11:38:40'),
(19, 'Bobby Crona', 'DM', 167, 10, '2017-12-14 11:38:40', '2017-12-14 11:38:40'),
(20, 'Eric Marquardt IV', 'CB', 359, 10, '2017-12-14 11:38:40', '2017-12-14 11:38:40'),
(21, 'Gerard Stokes II', 'SS', 184, 10, '2017-12-14 11:38:40', '2017-12-14 11:38:40'),
(22, 'Jessica Ernser', 'WM', 320, 10, '2017-12-14 11:38:40', '2017-12-14 11:38:40'),
(23, 'Braeden O''Reilly', 'RWB', 134, 10, '2017-12-14 11:38:40', '2017-12-14 11:38:40'),
(24, 'Blake D''Amore', 'LB', 422, 10, '2017-12-14 11:38:40', '2017-12-14 11:38:40'),
(25, 'Jackson Dach', 'SW', 469, 10, '2017-12-14 11:38:40', '2017-12-14 11:38:40'),
(26, 'Chaim Bayer', 'WF', 296, 10, '2017-12-14 11:38:40', '2017-12-14 11:38:40'),
(27, 'Ms. Alessia Jenkins DVM', 'AM', 397, 10, '2017-12-14 11:38:40', '2017-12-14 11:38:40'),
(28, 'Prof. Karine Wintheiser', 'WF', 382, 10, '2017-12-14 11:38:40', '2017-12-14 11:38:40'),
(29, 'Dr. Carlo D''Amore', 'CB', 197, 10, '2017-12-14 11:38:40', '2017-12-14 11:38:40'),
(30, 'Duncan Jacobs', 'SS', 427, 10, '2017-12-14 11:38:40', '2017-12-14 11:38:40'),
(31, 'Susanna Volkman', 'SW', 206, 10, '2017-12-14 11:38:40', '2017-12-14 11:38:40'),
(32, 'Kim Ankunding PhD', 'SW', 404, 10, '2017-12-14 11:38:40', '2017-12-14 11:38:40'),
(33, 'Miss Cora McKenzie Sr.', 'RWB', 46, 10, '2017-12-14 11:38:40', '2017-12-14 11:38:40'),
(34, 'Junior Mann', 'CM', 55, 10, '2017-12-14 11:38:41', '2017-12-14 11:38:41'),
(35, 'Garret Nikolaus', 'SS', 394, 10, '2017-12-14 11:38:41', '2017-12-14 11:38:41'),
(36, 'Koby Kovacek', 'LWB', 197, 10, '2017-12-14 11:38:41', '2017-12-14 11:38:41'),
(37, 'Estefania Sanford', 'LWB', 166, 10, '2017-12-14 11:38:41', '2017-12-14 11:38:41'),
(38, 'Hector Crist DDS', 'SS', 21, 10, '2017-12-14 11:38:41', '2017-12-14 11:38:41'),
(39, 'Willard Boyle DDS', 'CF', 145, 10, '2017-12-14 11:38:41', '2017-12-14 11:38:41'),
(40, 'Mckayla Lowe', 'LB', 33, 10, '2017-12-14 11:38:41', '2017-12-14 11:38:41'),
(41, 'Clarissa Bechtelar', 'DM', 371, 10, '2017-12-14 11:38:41', '2017-12-14 11:38:41'),
(42, 'Kenneth Swift', 'CM', 8, 10, '2017-12-14 11:38:41', '2017-12-14 11:38:41'),
(43, 'Mr. Abdul Schumm', 'CM', 422, 10, '2017-12-14 11:38:41', '2017-12-14 11:38:41'),
(44, 'Dr. Dixie Ruecker DDS', 'AM', 177, 10, '2017-12-14 11:38:41', '2017-12-14 11:38:41'),
(45, 'Prof. Karson Lakin', 'WM', 432, 10, '2017-12-14 11:38:41', '2017-12-14 11:38:41'),
(46, 'Prof. Wendell Auer Jr.', 'RB', 74, 10, '2017-12-14 11:38:42', '2017-12-14 11:38:42'),
(47, 'Miss Stacey Crona V', 'CB', 48, 10, '2017-12-14 11:38:42', '2017-12-14 11:38:42'),
(48, 'Lauren Pfeffer', 'WF', 180, 10, '2017-12-14 11:38:42', '2017-12-14 11:38:42'),
(49, 'Prof. Hailie Schroeder', 'DM', 312, 10, '2017-12-14 11:38:42', '2017-12-14 11:38:42'),
(50, 'Marcellus Tromp', 'SS', 435, 10, '2017-12-14 11:38:42', '2017-12-14 11:38:42'),
(51, 'Mr. Triston Adams', 'DM', 456, 10, '2017-12-14 11:38:42', '2017-12-14 11:38:42'),
(52, 'Clement Grant', 'WM', 23, 10, '2017-12-14 11:38:42', '2017-12-14 11:38:42'),
(53, 'Shanel Braun', 'DM', 379, 10, '2017-12-14 11:38:42', '2017-12-14 11:38:42'),
(54, 'Wellington D''Amore', 'WF', 132, 10, '2017-12-14 11:38:42', '2017-12-14 11:38:42'),
(55, 'Chauncey Murray', 'RB', 241, 10, '2017-12-14 11:38:42', '2017-12-14 11:38:42'),
(56, 'Miss Britney Labadie V', 'CB', 462, 10, '2017-12-14 11:38:42', '2017-12-14 11:38:42'),
(57, 'Jannie Sporer', 'SW', 253, 10, '2017-12-14 11:38:42', '2017-12-14 11:38:42'),
(58, 'Katharina Braun Sr.', 'LWB', 212, 10, '2017-12-14 11:38:42', '2017-12-14 11:38:42'),
(59, 'Jewell Howe', 'CF', 483, 10, '2017-12-14 11:38:42', '2017-12-14 11:38:42'),
(60, 'Elvie Swaniawski', 'CM', 115, 10, '2017-12-14 11:38:42', '2017-12-14 11:38:42'),
(61, 'Prof. Paris Hahn Jr.', 'LB', 488, 10, '2017-12-14 11:38:42', '2017-12-14 11:38:42'),
(62, 'Larissa Marquardt', 'DM', 237, 10, '2017-12-14 11:38:42', '2017-12-14 11:38:42'),
(63, 'Eunice Botsford I', 'SS', 331, 10, '2017-12-14 11:38:42', '2017-12-14 11:38:42'),
(64, 'Dr. Delphia Gorczany IV', 'RWB', 270, 10, '2017-12-14 11:38:42', '2017-12-14 11:38:42'),
(65, 'Ms. Rae Bins DDS', 'CF', 346, 10, '2017-12-14 11:38:42', '2017-12-14 11:38:42'),
(66, 'Frederique Marks', 'CF', 135, 10, '2017-12-14 11:38:42', '2017-12-14 11:38:42'),
(67, 'Dr. Fermin Kulas MD', 'LB', 44, 10, '2017-12-14 11:38:43', '2017-12-14 11:38:43'),
(68, 'Elmira Howe', 'RB', 81, 10, '2017-12-14 11:38:43', '2017-12-14 11:38:43'),
(69, 'Raoul Rowe', 'RWB', 146, 10, '2017-12-14 11:38:43', '2017-12-14 11:38:43'),
(70, 'Prof. Marty Walsh DDS', 'LWB', 279, 10, '2017-12-14 11:38:43', '2017-12-14 11:38:43'),
(71, 'Ms. Eve Heathcote', 'LB', 245, 10, '2017-12-14 11:38:43', '2017-12-14 11:38:43'),
(72, 'Dr. Esperanza Kub', 'RWB', 129, 10, '2017-12-14 11:38:43', '2017-12-14 11:38:43'),
(73, 'Narciso Gleason', 'DM', 174, 10, '2017-12-14 11:38:43', '2017-12-14 11:38:43'),
(74, 'Mr. Hoyt Willms', 'RB', 299, 10, '2017-12-14 11:38:43', '2017-12-14 11:38:43'),
(75, 'Reilly Erdman', 'SW', 292, 10, '2017-12-14 11:38:43', '2017-12-14 11:38:43'),
(76, 'Ricardo Gaylord', 'WF', 403, 10, '2017-12-14 11:38:43', '2017-12-14 11:38:43'),
(77, 'Darion Hauck', 'SW', 48, 10, '2017-12-14 11:38:43', '2017-12-14 11:38:43'),
(78, 'Idella Kassulke', 'SW', 207, 10, '2017-12-14 11:38:43', '2017-12-14 11:38:43'),
(79, 'Doyle Erdman', 'RWB', 300, 10, '2017-12-14 11:38:43', '2017-12-14 11:38:43'),
(80, 'Arne Stokes PhD', 'GK', 316, 10, '2017-12-14 11:38:43', '2017-12-14 11:38:43'),
(81, 'Candelario Herzog', 'WM', 366, 10, '2017-12-14 11:38:43', '2017-12-14 11:38:43'),
(82, 'Keely Pfeffer', 'WM', 476, 10, '2017-12-14 11:38:43', '2017-12-14 11:38:43'),
(83, 'Joannie Schuppe', 'LWB', 412, 10, '2017-12-14 11:38:43', '2017-12-14 11:38:43'),
(84, 'Geo Rutherford', 'RB', 436, 10, '2017-12-14 11:38:43', '2017-12-14 11:38:43'),
(85, 'Freddy O''Hara II', 'CB', 48, 10, '2017-12-14 11:38:43', '2017-12-14 11:38:43'),
(86, 'Sophie Reichel', 'CM', 271, 10, '2017-12-14 11:38:44', '2017-12-14 11:38:44'),
(87, 'Marianne Brekke', 'RWB', 409, 10, '2017-12-14 11:38:44', '2017-12-14 11:38:44'),
(88, 'Prof. Justina Bednar DDS', 'RB', 45, 10, '2017-12-14 11:38:44', '2017-12-14 11:38:44'),
(89, 'Leo Effertz', 'AM', 400, 10, '2017-12-14 11:38:44', '2017-12-14 11:38:44'),
(90, 'Clotilde DuBuque', 'WM', 389, 10, '2017-12-14 11:38:44', '2017-12-14 11:38:44'),
(91, 'Mrs. Mikayla Schaefer', 'CM', 402, 10, '2017-12-14 11:38:44', '2017-12-14 11:38:44'),
(92, 'Gloria Wintheiser', 'SS', 141, 10, '2017-12-14 11:38:44', '2017-12-14 11:38:44'),
(93, 'Valentin Brakus', 'WM', 421, 10, '2017-12-14 11:38:44', '2017-12-14 11:38:44'),
(94, 'Guido Wiegand', 'AM', 468, 10, '2017-12-14 11:38:44', '2017-12-14 11:38:44'),
(95, 'Jacynthe Weber', 'CF', 298, 10, '2017-12-14 11:38:44', '2017-12-14 11:38:44'),
(96, 'Lina Luettgen', 'CM', 373, 10, '2017-12-14 11:38:44', '2017-12-14 11:38:44'),
(97, 'Deontae Gleichner', 'AM', 352, 10, '2017-12-14 11:38:44', '2017-12-14 11:38:44'),
(98, 'Beryl Spinka Jr.', 'CF', 257, 10, '2017-12-14 11:38:44', '2017-12-14 11:38:44'),
(99, 'Emma Swaniawski', 'CF', 219, 10, '2017-12-14 11:38:44', '2017-12-14 11:38:44'),
(100, 'Hattie Friesen', 'WF', 318, 10, '2017-12-14 11:38:44', '2017-12-14 11:38:44'),
(101, 'Mafalda Rice', 'AM', 102, 10, '2017-12-14 11:38:44', '2017-12-14 11:38:44'),
(102, 'Mr. Keeley Medhurst', 'CF', 231, 10, '2017-12-14 11:38:44', '2017-12-14 11:38:44'),
(103, 'Rachael Thompson DDS', 'RWB', 418, 10, '2017-12-14 11:38:44', '2017-12-14 11:38:44'),
(104, 'Mr. Dion Brekke', 'DM', 263, 10, '2017-12-14 11:38:44', '2017-12-14 11:38:44'),
(105, 'Prof. Keven Schiller Sr.', 'SS', 153, 10, '2017-12-14 11:38:44', '2017-12-14 11:38:44'),
(106, 'Roxanne Jacobi III', 'SS', 401, 10, '2017-12-14 11:38:45', '2017-12-14 11:38:45'),
(107, 'Prof. Zita Langosh V', 'CB', 2, 10, '2017-12-14 11:38:45', '2017-12-14 11:38:45'),
(108, 'Haylie Rice', 'GK', 63, 10, '2017-12-14 11:38:45', '2017-12-14 11:38:45'),
(109, 'Duane Rohan MD', 'RWB', 395, 10, '2017-12-14 11:38:45', '2017-12-14 11:38:45'),
(110, 'Edd Spinka V', 'AM', 211, 10, '2017-12-14 11:38:45', '2017-12-14 11:38:45'),
(111, 'Prof. Veronica Dietrich V', 'RB', 282, 10, '2017-12-14 11:38:45', '2017-12-14 11:38:45'),
(112, 'Dr. Janice Hane II', 'WF', 455, 10, '2017-12-14 11:38:45', '2017-12-14 11:38:45'),
(113, 'Merlin Keebler', 'AM', 90, 10, '2017-12-14 11:38:45', '2017-12-14 11:38:45'),
(114, 'Ms. Ernestina Cormier Jr.', 'LWB', 462, 10, '2017-12-14 11:38:45', '2017-12-14 11:38:45'),
(115, 'Enola Purdy', 'CB', 181, 10, '2017-12-14 11:38:45', '2017-12-14 11:38:45'),
(116, 'Hollie Bosco', 'WM', 124, 10, '2017-12-14 11:38:45', '2017-12-14 11:38:45'),
(117, 'Cooper Adams', 'LB', 444, 10, '2017-12-14 11:38:45', '2017-12-14 11:38:45'),
(118, 'Prof. Jefferey Romaguera', 'WF', 212, 10, '2017-12-14 11:38:45', '2017-12-14 11:38:45'),
(119, 'Dovie Kunze', 'CF', 149, 10, '2017-12-14 11:38:45', '2017-12-14 11:38:45'),
(120, 'Felton Lueilwitz', 'RB', 176, 10, '2017-12-14 11:38:45', '2017-12-14 11:38:45'),
(121, 'Katrine Ferry PhD', 'CM', 276, 10, '2017-12-14 11:38:45', '2017-12-14 11:38:45'),
(122, 'Mrs. Antonette Reilly', 'SW', 490, 10, '2017-12-14 11:38:45', '2017-12-14 11:38:45'),
(123, 'Prof. Watson Thompson', 'LWB', 459, 10, '2017-12-14 11:38:45', '2017-12-14 11:38:45'),
(124, 'Prof. Haskell Williamson Sr.', 'RWB', 427, 10, '2017-12-14 11:38:45', '2017-12-14 11:38:45'),
(125, 'Trevor Wuckert', 'CM', 463, 10, '2017-12-14 11:38:45', '2017-12-14 11:38:45'),
(126, 'Dr. Precious Leuschke', 'CB', 287, 10, '2017-12-14 11:38:46', '2017-12-14 11:38:46'),
(127, 'Ezra Medhurst', 'SS', 137, 10, '2017-12-14 11:38:46', '2017-12-14 11:38:46'),
(128, 'Rosella Bergstrom', 'DM', 424, 10, '2017-12-14 11:38:46', '2017-12-14 11:38:46'),
(129, 'Elinor Eichmann II', 'SW', 181, 10, '2017-12-14 11:38:46', '2017-12-14 11:38:46'),
(130, 'Carlotta Monahan Sr.', 'CB', 145, 10, '2017-12-14 11:38:46', '2017-12-14 11:38:46'),
(131, 'Dr. Guy Schiller I', 'RWB', 474, 10, '2017-12-14 11:38:46', '2017-12-14 11:38:46'),
(132, 'Dr. Carlie Miller DVM', 'CB', 363, 10, '2017-12-14 11:38:46', '2017-12-14 11:38:46'),
(133, 'Dino Will DVM', 'WM', 68, 10, '2017-12-14 11:38:46', '2017-12-14 11:38:46'),
(134, 'Lawson Auer', 'CM', 447, 10, '2017-12-14 11:38:46', '2017-12-14 11:38:46'),
(135, 'Aaliyah Moen', 'LB', 124, 10, '2017-12-14 11:38:46', '2017-12-14 11:38:46'),
(136, 'Nolan Farrell', 'SS', 302, 10, '2017-12-14 11:38:46', '2017-12-14 11:38:46'),
(137, 'Remington Bins I', 'CB', 446, 10, '2017-12-14 11:38:46', '2017-12-14 11:38:46'),
(138, 'Wyman Schaden', 'RB', 367, 10, '2017-12-14 11:38:46', '2017-12-14 11:38:46'),
(139, 'Julie Zulauf', 'SW', 121, 10, '2017-12-14 11:38:46', '2017-12-14 11:38:46'),
(140, 'Karolann Volkman', 'LB', 125, 10, '2017-12-14 11:38:46', '2017-12-14 11:38:46'),
(141, 'Jaylon Pacocha', 'RB', 301, 10, '2017-12-14 11:38:46', '2017-12-14 11:38:46'),
(142, 'Oceane Medhurst', 'SW', 180, 10, '2017-12-14 11:38:46', '2017-12-14 11:38:46'),
(143, 'Prof. Aletha Wunsch PhD', 'CB', 366, 10, '2017-12-14 11:38:46', '2017-12-14 11:38:46'),
(144, 'Jasper Wyman', 'LB', 454, 10, '2017-12-14 11:38:46', '2017-12-14 11:38:46'),
(145, 'Raymond Kautzer', 'AM', 139, 10, '2017-12-14 11:38:46', '2017-12-14 11:38:46'),
(146, 'Donato Wolff DDS', 'WM', 453, 10, '2017-12-14 11:38:46', '2017-12-14 11:38:46'),
(147, 'Austen Koch', 'CF', 414, 10, '2017-12-14 11:38:47', '2017-12-14 11:38:47'),
(148, 'Carrie Robel DDS', 'CF', 148, 10, '2017-12-14 11:38:47', '2017-12-14 11:38:47'),
(149, 'Dr. Gunner Kutch', 'SW', 239, 10, '2017-12-14 11:38:47', '2017-12-14 11:38:47'),
(150, 'Ms. Arvilla Krajcik Jr.', 'DM', 373, 10, '2017-12-14 11:38:47', '2017-12-14 11:38:47'),
(151, 'Irving Aufderhar', 'SW', 207, 10, '2017-12-14 11:38:47', '2017-12-14 11:38:47'),
(152, 'Emile Dibbert', 'RWB', 170, 10, '2017-12-14 11:38:47', '2017-12-14 11:38:47'),
(153, 'Bette Rowe', 'WM', 487, 10, '2017-12-14 11:38:47', '2017-12-14 11:38:47'),
(154, 'Godfrey Christiansen', 'DM', 51, 10, '2017-12-14 11:38:47', '2017-12-14 11:38:47'),
(155, 'Soledad Green V', 'DM', 246, 10, '2017-12-14 11:38:47', '2017-12-14 11:38:47'),
(156, 'Fiona Ritchie', 'CM', 238, 10, '2017-12-14 11:38:47', '2017-12-14 11:38:47'),
(157, 'Ms. Magali Glover PhD', 'RWB', 460, 10, '2017-12-14 11:38:47', '2017-12-14 11:38:47'),
(158, 'Caleb Kreiger', 'SS', 270, 10, '2017-12-14 11:38:47', '2017-12-14 11:38:47'),
(159, 'Lucas Torp MD', 'RB', 188, 10, '2017-12-14 11:38:47', '2017-12-14 11:38:47'),
(160, 'Prof. Laila Schumm III', 'SW', 301, 10, '2017-12-14 11:38:47', '2017-12-14 11:38:47'),
(161, 'Jannie Hoeger Jr.', 'CB', 237, 10, '2017-12-14 11:38:47', '2017-12-14 11:38:47'),
(162, 'Elyssa Wisoky', 'SS', 428, 10, '2017-12-14 11:38:48', '2017-12-14 11:38:48'),
(163, 'Gino Kunde', 'WM', 5, 10, '2017-12-14 11:38:48', '2017-12-14 11:38:48'),
(164, 'Mr. Andre Parker Sr.', 'CM', 191, 10, '2017-12-14 11:38:48', '2017-12-14 11:38:48'),
(165, 'Immanuel Moore', 'WM', 128, 10, '2017-12-14 11:38:48', '2017-12-14 11:38:48'),
(166, 'Dr. Emilio Stehr I', 'RWB', 243, 10, '2017-12-14 11:38:48', '2017-12-14 11:38:48'),
(167, 'Gregory Ullrich', 'DM', 101, 10, '2017-12-14 11:38:48', '2017-12-14 11:38:48'),
(168, 'Olga Towne DVM', 'GK', 287, 10, '2017-12-14 11:38:48', '2017-12-14 11:38:48'),
(169, 'Quentin Adams', 'LWB', 270, 10, '2017-12-14 11:38:48', '2017-12-14 11:38:48'),
(170, 'Kianna Swift', 'WF', 241, 10, '2017-12-14 11:38:48', '2017-12-14 11:38:48'),
(171, 'Jalyn Bahringer', 'RB', 121, 10, '2017-12-14 11:38:48', '2017-12-14 11:38:48'),
(172, 'Layla Mosciski', 'LB', 358, 10, '2017-12-14 11:38:48', '2017-12-14 11:38:48'),
(173, 'Jean Treutel', 'GK', 378, 10, '2017-12-14 11:38:48', '2017-12-14 11:38:48'),
(174, 'Art Konopelski Sr.', 'LB', 494, 10, '2017-12-14 11:38:49', '2017-12-14 11:38:49'),
(175, 'Webster Brakus', 'LWB', 172, 10, '2017-12-14 11:38:49', '2017-12-14 11:38:49'),
(176, 'Abigale Christiansen', 'CF', 240, 10, '2017-12-14 11:38:49', '2017-12-14 11:38:49'),
(177, 'Dr. Furman Bergnaum', 'RB', 57, 10, '2017-12-14 11:38:49', '2017-12-14 11:38:49'),
(178, 'Demetrius Swift', 'RB', 476, 10, '2017-12-14 11:38:49', '2017-12-14 11:38:49'),
(179, 'Thalia Dach', 'GK', 284, 10, '2017-12-14 11:38:49', '2017-12-14 11:38:49'),
(180, 'Stevie Koelpin DVM', 'LWB', 277, 10, '2017-12-14 11:38:49', '2017-12-14 11:38:49'),
(181, 'Else Kshlerin DDS', 'LB', 77, 10, '2017-12-14 11:38:49', '2017-12-14 11:38:49'),
(182, 'Hiram Pagac', 'LB', 276, 10, '2017-12-14 11:38:49', '2017-12-14 11:38:49'),
(183, 'Prof. Adelbert Klein', 'WM', 277, 10, '2017-12-14 11:38:49', '2017-12-14 11:38:49'),
(184, 'Nikolas Turcotte', 'LB', 267, 10, '2017-12-14 11:38:50', '2017-12-14 11:38:50'),
(185, 'Miss Arlie Gottlieb III', 'RWB', 335, 10, '2017-12-14 11:38:50', '2017-12-14 11:38:50'),
(186, 'Arch Hammes', 'WF', 162, 10, '2017-12-14 11:38:50', '2017-12-14 11:38:50'),
(187, 'Hugh Balistreri', 'AM', 408, 10, '2017-12-14 11:38:50', '2017-12-14 11:38:50'),
(188, 'Ms. Emilia Champlin', 'RWB', 493, 10, '2017-12-14 11:38:50', '2017-12-14 11:38:50'),
(189, 'Vesta Rohan MD', 'GK', 367, 10, '2017-12-14 11:38:50', '2017-12-14 11:38:50'),
(190, 'Dr. Sherwood Schmidt PhD', 'CB', 140, 10, '2017-12-14 11:38:50', '2017-12-14 11:38:50'),
(191, 'Prof. Aliyah Hintz II', 'CM', 211, 10, '2017-12-14 11:38:50', '2017-12-14 11:38:50'),
(192, 'Destiny Bechtelar IV', 'CB', 229, 10, '2017-12-14 11:38:50', '2017-12-14 11:38:50'),
(193, 'Alanna Waters', 'DM', 228, 10, '2017-12-14 11:38:50', '2017-12-14 11:38:50'),
(194, 'Reyes Kuhlman', 'WM', 436, 10, '2017-12-14 11:38:50', '2017-12-14 11:38:50'),
(195, 'Dina Jacobson', 'RB', 108, 10, '2017-12-14 11:38:50', '2017-12-14 11:38:50'),
(196, 'Mr. Liam Carroll Sr.', 'SW', 191, 10, '2017-12-14 11:38:51', '2017-12-14 11:38:51'),
(197, 'Dr. Rey Runte', 'LB', 455, 10, '2017-12-14 11:38:51', '2017-12-14 11:38:51'),
(198, 'Sarina Ullrich', 'GK', 301, 10, '2017-12-14 11:38:51', '2017-12-14 11:38:51'),
(199, 'Kayli Hettinger MD', 'SS', 49, 10, '2017-12-14 11:38:51', '2017-12-14 11:38:51'),
(200, 'Easton Abbott', 'CM', 59, 10, '2017-12-14 11:38:51', '2017-12-14 11:38:51'),
(201, 'Prof. Jamal Emmerich I', 'GK', 408, 10, '2017-12-14 11:38:51', '2017-12-14 11:38:51'),
(202, 'Rowena Kessler', 'SW', 249, 10, '2017-12-14 11:38:51', '2017-12-14 11:38:51'),
(203, 'Andreanne Rath', 'RB', 453, 10, '2017-12-14 11:38:51', '2017-12-14 11:38:51'),
(204, 'Kelton Heaney', 'AM', 312, 10, '2017-12-14 11:38:51', '2017-12-14 11:38:51'),
(205, 'Jay O''Reilly', 'CF', 263, 10, '2017-12-14 11:38:51', '2017-12-14 11:38:51'),
(206, 'Johathan Quigley', 'LB', 132, 10, '2017-12-14 11:38:52', '2017-12-14 11:38:52'),
(207, 'April Kuvalis', 'CB', 2, 10, '2017-12-14 11:38:52', '2017-12-14 11:38:52'),
(208, 'Pattie Weissnat', 'RWB', 254, 10, '2017-12-14 11:38:52', '2017-12-14 11:38:52'),
(209, 'Santina Collier DDS', 'LWB', 74, 10, '2017-12-14 11:38:52', '2017-12-14 11:38:52'),
(210, 'Rickey Schamberger', 'CM', 462, 10, '2017-12-14 11:38:52', '2017-12-14 11:38:52'),
(211, 'Elfrieda Schmeler', 'SW', 220, 10, '2017-12-14 11:38:52', '2017-12-14 11:38:52'),
(212, 'Miss Maureen Gottlieb II', 'GK', 33, 10, '2017-12-14 11:38:52', '2017-12-14 11:38:52'),
(213, 'Rocky Ledner', 'AM', 51, 10, '2017-12-14 11:38:52', '2017-12-14 11:38:52'),
(214, 'Mr. Herbert Keeling Sr.', 'RB', 332, 10, '2017-12-14 11:38:52', '2017-12-14 11:38:52'),
(215, 'Sim Nader', 'LB', 15, 10, '2017-12-14 11:38:52', '2017-12-14 11:38:52'),
(216, 'Nayeli Cummerata', 'WM', 101, 10, '2017-12-14 11:38:52', '2017-12-14 11:38:52'),
(217, 'Kevin West', 'LWB', 30, 10, '2017-12-14 11:38:53', '2017-12-14 11:38:53'),
(218, 'Hubert Price', 'WM', 193, 10, '2017-12-14 11:38:53', '2017-12-14 11:38:53'),
(219, 'Everette Schinner', 'LB', 140, 10, '2017-12-14 11:38:53', '2017-12-14 11:38:53'),
(220, 'Harley Moore MD', 'SW', 312, 10, '2017-12-14 11:38:53', '2017-12-14 11:38:53'),
(221, 'Ms. Magdalen Adams', 'LWB', 457, 10, '2017-12-14 11:38:53', '2017-12-14 11:38:53'),
(222, 'Prof. Deshaun Kuhic', 'SW', 178, 10, '2017-12-14 11:38:53', '2017-12-14 11:38:53'),
(223, 'Eusebio Jaskolski', 'SW', 249, 10, '2017-12-14 11:38:53', '2017-12-14 11:38:53'),
(224, 'Rosina Treutel', 'LWB', 139, 10, '2017-12-14 11:38:53', '2017-12-14 11:38:53'),
(225, 'Mr. Gino Runolfsson PhD', 'AM', 197, 10, '2017-12-14 11:38:53', '2017-12-14 11:38:53'),
(226, 'Anahi Corkery V', 'LWB', 27, 10, '2017-12-14 11:38:53', '2017-12-14 11:38:53'),
(227, 'Prof. Jewel Olson', 'CB', 221, 10, '2017-12-14 11:38:53', '2017-12-14 11:38:53'),
(228, 'Sabina Barton', 'LB', 22, 10, '2017-12-14 11:38:53', '2017-12-14 11:38:53'),
(229, 'Prof. Jayda Boyer', 'RWB', 182, 10, '2017-12-14 11:38:53', '2017-12-14 11:38:53'),
(230, 'Mozell Glover', 'RWB', 194, 10, '2017-12-14 11:38:53', '2017-12-14 11:38:53'),
(231, 'Dr. Antonina Kling IV', 'CF', 484, 10, '2017-12-14 11:38:53', '2017-12-14 11:38:53'),
(232, 'Ethan Schmidt', 'WM', 263, 10, '2017-12-14 11:38:53', '2017-12-14 11:38:53'),
(233, 'Bennett Frami', 'WM', 57, 10, '2017-12-14 11:38:53', '2017-12-14 11:38:53'),
(234, 'Dr. Caden Bergstrom PhD', 'WF', 336, 10, '2017-12-14 11:38:53', '2017-12-14 11:38:53'),
(235, 'Lawrence Aufderhar', 'RWB', 20, 10, '2017-12-14 11:38:53', '2017-12-14 11:38:53'),
(236, 'Darren Mueller', 'CF', 61, 10, '2017-12-14 11:38:54', '2017-12-14 11:38:54'),
(237, 'Rogelio Cole', 'LB', 468, 10, '2017-12-14 11:38:54', '2017-12-14 11:38:54'),
(238, 'Kristy Dietrich', 'SW', 277, 10, '2017-12-14 11:38:54', '2017-12-14 11:38:54'),
(239, 'Lorenz Bernier MD', 'CB', 81, 10, '2017-12-14 11:38:54', '2017-12-14 11:38:54'),
(240, 'Freddy VonRueden', 'LWB', 334, 10, '2017-12-14 11:38:54', '2017-12-14 11:38:54'),
(241, 'Veronica Hilll I', 'CB', 390, 10, '2017-12-14 11:38:54', '2017-12-14 11:38:54'),
(242, 'Theo Schaefer', 'RWB', 272, 10, '2017-12-14 11:38:54', '2017-12-14 11:38:54'),
(243, 'Mrs. Annabelle Abernathy Sr.', 'CB', 352, 10, '2017-12-14 11:38:54', '2017-12-14 11:38:54'),
(244, 'Kurt Parisian', 'LB', 449, 10, '2017-12-14 11:38:54', '2017-12-14 11:38:54'),
(245, 'Alexandre Sawayn', 'WF', 33, 10, '2017-12-14 11:38:54', '2017-12-14 11:38:54'),
(246, 'Miss Alycia Smith', 'WF', 248, 10, '2017-12-14 11:38:54', '2017-12-14 11:38:54'),
(247, 'Lucie Keeling', 'CF', 57, 10, '2017-12-14 11:38:54', '2017-12-14 11:38:54'),
(248, 'Dr. Watson Casper', 'CM', 132, 10, '2017-12-14 11:38:54', '2017-12-14 11:38:54'),
(249, 'Gwendolyn Keebler', 'WF', 153, 10, '2017-12-14 11:38:54', '2017-12-14 11:38:54'),
(250, 'Mr. Newell McClure V', 'RB', 274, 10, '2017-12-14 11:38:54', '2017-12-14 11:38:54'),
(251, 'Fanny Gusikowski III', 'CM', 231, 10, '2017-12-14 11:38:54', '2017-12-14 11:38:54'),
(252, 'Rachel Kunde', 'RWB', 395, 10, '2017-12-14 11:38:54', '2017-12-14 11:38:54'),
(253, 'Joseph Macejkovic Sr.', 'CF', 494, 10, '2017-12-14 11:38:54', '2017-12-14 11:38:54'),
(254, 'Vince Blick', 'CM', 414, 10, '2017-12-14 11:38:54', '2017-12-14 11:38:54'),
(255, 'Elwyn Wiegand', 'LWB', 425, 10, '2017-12-14 11:38:54', '2017-12-14 11:38:54'),
(256, 'Dolores Feeney', 'WM', 344, 10, '2017-12-14 11:38:54', '2017-12-14 11:38:54'),
(257, 'Trycia Treutel Sr.', 'LB', 68, 10, '2017-12-14 11:38:54', '2017-12-14 11:38:54'),
(258, 'Dorcas Weber', 'CB', 297, 10, '2017-12-14 11:38:54', '2017-12-14 11:38:54'),
(259, 'Lottie Wehner', 'CB', 38, 10, '2017-12-14 11:38:55', '2017-12-14 11:38:55'),
(260, 'Vallie Wyman', 'SS', 209, 10, '2017-12-14 11:38:55', '2017-12-14 11:38:55'),
(261, 'Miss Missouri Kuhlman', 'RB', 434, 10, '2017-12-14 11:38:55', '2017-12-14 11:38:55'),
(262, 'Georgianna Hamill IV', 'CM', 284, 10, '2017-12-14 11:38:55', '2017-12-14 11:38:55'),
(263, 'Giles Lakin', 'CF', 227, 10, '2017-12-14 11:38:55', '2017-12-14 11:38:55'),
(264, 'Cruz Hessel', 'AM', 265, 10, '2017-12-14 11:38:55', '2017-12-14 11:38:55'),
(265, 'Ruthe Braun', 'GK', 76, 10, '2017-12-14 11:38:55', '2017-12-14 11:38:55'),
(266, 'Casandra Pfannerstill', 'DM', 254, 10, '2017-12-14 11:38:55', '2017-12-14 11:38:55'),
(267, 'Emil Franecki', 'RWB', 358, 10, '2017-12-14 11:38:55', '2017-12-14 11:38:55'),
(268, 'Ofelia Deckow V', 'WF', 141, 10, '2017-12-14 11:38:55', '2017-12-14 11:38:55'),
(269, 'Sim Shields MD', 'RWB', 208, 10, '2017-12-14 11:38:55', '2017-12-14 11:38:55'),
(270, 'Melvina Cole', 'WM', 378, 10, '2017-12-14 11:38:55', '2017-12-14 11:38:55'),
(271, 'Mrs. Felicia Stoltenberg', 'SW', 126, 10, '2017-12-14 11:38:55', '2017-12-14 11:38:55'),
(272, 'Cristal Kessler', 'CM', 405, 10, '2017-12-14 11:38:55', '2017-12-14 11:38:55'),
(273, 'Wellington Rolfson', 'AM', 363, 10, '2017-12-14 11:38:55', '2017-12-14 11:38:55'),
(274, 'Isai Becker', 'LWB', 422, 10, '2017-12-14 11:38:55', '2017-12-14 11:38:55'),
(275, 'Sanford Mante', 'CF', 211, 10, '2017-12-14 11:38:55', '2017-12-14 11:38:55'),
(276, 'Makenna Larkin', 'CB', 135, 10, '2017-12-14 11:38:55', '2017-12-14 11:38:55'),
(277, 'Dr. Erik Carroll IV', 'RB', 90, 10, '2017-12-14 11:38:55', '2017-12-14 11:38:55'),
(278, 'Mose Wolff V', 'DM', 73, 10, '2017-12-14 11:38:56', '2017-12-14 11:38:56'),
(279, 'Freeman Hermiston', 'DM', 362, 10, '2017-12-14 11:38:56', '2017-12-14 11:38:56'),
(280, 'Prof. Harmony Hand II', 'DM', 240, 10, '2017-12-14 11:38:56', '2017-12-14 11:38:56'),
(281, 'Cristina Murray', 'CB', 246, 10, '2017-12-14 11:38:56', '2017-12-14 11:38:56'),
(282, 'Meredith Robel', 'WF', 19, 10, '2017-12-14 11:38:56', '2017-12-14 11:38:56'),
(283, 'Dr. Filiberto Kreiger', 'RB', 298, 10, '2017-12-14 11:38:56', '2017-12-14 11:38:56'),
(284, 'Mr. Clyde Powlowski', 'SW', 338, 10, '2017-12-14 11:38:56', '2017-12-14 11:38:56'),
(285, 'Mrs. Genoveva Hilll I', 'SS', 485, 10, '2017-12-14 11:38:56', '2017-12-14 11:38:56'),
(286, 'Cornelius Brakus', 'WM', 312, 10, '2017-12-14 11:38:56', '2017-12-14 11:38:56'),
(287, 'Larry Jacobi', 'RWB', 188, 10, '2017-12-14 11:38:56', '2017-12-14 11:38:56'),
(288, 'Dr. Dusty Bashirian', 'CF', 391, 10, '2017-12-14 11:38:56', '2017-12-14 11:38:56'),
(289, 'Dr. Isai Pagac', 'GK', 245, 10, '2017-12-14 11:38:56', '2017-12-14 11:38:56'),
(290, 'Skylar Hoeger', 'WM', 369, 10, '2017-12-14 11:38:56', '2017-12-14 11:38:56'),
(291, 'Abner Kulas', 'SS', 121, 10, '2017-12-14 11:38:56', '2017-12-14 11:38:56'),
(292, 'Eleonore Bechtelar', 'SS', 338, 10, '2017-12-14 11:38:56', '2017-12-14 11:38:56'),
(293, 'Jamaal Rath', 'LB', 174, 10, '2017-12-14 11:38:56', '2017-12-14 11:38:56'),
(294, 'Mrs. Dorothy Bayer', 'GK', 27, 10, '2017-12-14 11:38:56', '2017-12-14 11:38:56'),
(295, 'Haylee Crooks', 'LWB', 433, 10, '2017-12-14 11:38:56', '2017-12-14 11:38:56'),
(296, 'Myrl Fay', 'CB', 397, 10, '2017-12-14 11:38:56', '2017-12-14 11:38:56'),
(297, 'Brad DuBuque', 'AM', 35, 10, '2017-12-14 11:38:57', '2017-12-14 11:38:57'),
(298, 'Bridget Beatty', 'CB', 423, 10, '2017-12-14 11:38:57', '2017-12-14 11:38:57'),
(299, 'Patrick Walter', 'CF', 179, 10, '2017-12-14 11:38:57', '2017-12-14 11:38:57'),
(300, 'Mr. Miles Schuster', 'SS', 273, 10, '2017-12-14 11:38:57', '2017-12-14 11:38:57'),
(301, 'Mr. Troy Mosciski Sr.', 'RB', 131, 10, '2017-12-14 11:38:57', '2017-12-14 11:38:57'),
(302, 'Lina Bergnaum', 'AM', 464, 10, '2017-12-14 11:38:57', '2017-12-14 11:38:57'),
(303, 'Mr. Lance Nikolaus I', 'WF', 240, 10, '2017-12-14 11:38:57', '2017-12-14 11:38:57'),
(304, 'Ms. Maggie Baumbach V', 'LWB', 384, 10, '2017-12-14 11:38:57', '2017-12-14 11:38:57'),
(305, 'Dr. Serena Crona I', 'WF', 317, 10, '2017-12-14 11:38:57', '2017-12-14 11:38:57'),
(306, 'Breanna Lakin', 'GK', 214, 10, '2017-12-14 11:38:57', '2017-12-14 11:38:57'),
(307, 'Prof. Jerome Metz II', 'RB', 281, 10, '2017-12-14 11:38:57', '2017-12-14 11:38:57'),
(308, 'Sonia Zboncak', 'WM', 346, 10, '2017-12-14 11:38:57', '2017-12-14 11:38:57'),
(309, 'Holden Harber', 'WF', 465, 10, '2017-12-14 11:38:57', '2017-12-14 11:38:57'),
(310, 'Dr. Donato Morissette Jr.', 'WF', 132, 10, '2017-12-14 11:38:57', '2017-12-14 11:38:57'),
(311, 'Martina Rolfson', 'DM', 33, 10, '2017-12-14 11:38:57', '2017-12-14 11:38:57'),
(312, 'Dr. Allene Koelpin', 'WM', 455, 10, '2017-12-14 11:38:57', '2017-12-14 11:38:57'),
(313, 'Brendon Crona Jr.', 'DM', 419, 10, '2017-12-14 11:38:57', '2017-12-14 11:38:57'),
(314, 'Prof. Pearline Ebert', 'GK', 490, 10, '2017-12-14 11:38:57', '2017-12-14 11:38:57'),
(315, 'Kyleigh Windler', 'CF', 368, 10, '2017-12-14 11:38:58', '2017-12-14 11:38:58'),
(316, 'Royal Collier PhD', 'RB', 133, 10, '2017-12-14 11:38:58', '2017-12-14 11:38:58'),
(317, 'Savanah Jerde', 'LB', 358, 10, '2017-12-14 11:38:58', '2017-12-14 11:38:58'),
(318, 'Carolanne Wisozk DVM', 'SW', 126, 10, '2017-12-14 11:38:58', '2017-12-14 11:38:58'),
(319, 'Lionel Kuhn II', 'GK', 282, 10, '2017-12-14 11:38:58', '2017-12-14 11:38:58'),
(320, 'Rosalind Gulgowski', 'CM', 436, 10, '2017-12-14 11:38:58', '2017-12-14 11:38:58'),
(321, 'Stefan Satterfield', 'AM', 348, 10, '2017-12-14 11:38:58', '2017-12-14 11:38:58'),
(322, 'Vada Dibbert', 'CM', 483, 10, '2017-12-14 11:38:58', '2017-12-14 11:38:58'),
(323, 'Stephan McClure', 'LB', 86, 10, '2017-12-14 11:38:59', '2017-12-14 11:38:59'),
(324, 'Mr. Monserrate Reichert', 'LB', 274, 10, '2017-12-14 11:38:59', '2017-12-14 11:38:59'),
(325, 'Prof. Casandra Volkman Jr.', 'WM', 436, 10, '2017-12-14 11:38:59', '2017-12-14 11:38:59'),
(326, 'Mr. Buddy Schamberger V', 'LWB', 404, 10, '2017-12-14 11:38:59', '2017-12-14 11:38:59'),
(327, 'Beau Koepp', 'AM', 25, 10, '2017-12-14 11:38:59', '2017-12-14 11:38:59'),
(328, 'Gideon Klocko', 'LWB', 22, 10, '2017-12-14 11:38:59', '2017-12-14 11:38:59'),
(329, 'Dr. Gordon Dicki', 'RWB', 329, 10, '2017-12-14 11:38:59', '2017-12-14 11:38:59'),
(330, 'Shaniya Sanford PhD', 'LB', 308, 10, '2017-12-14 11:38:59', '2017-12-14 11:38:59'),
(331, 'Vincent Ebert', 'CF', 38, 10, '2017-12-14 11:38:59', '2017-12-14 11:38:59'),
(332, 'Dereck Trantow', 'CM', 382, 10, '2017-12-14 11:38:59', '2017-12-14 11:38:59'),
(333, 'Ned Cronin', 'GK', 289, 10, '2017-12-14 11:38:59', '2017-12-14 11:38:59'),
(334, 'Prof. Alberto Conroy V', 'SW', 139, 10, '2017-12-14 11:39:00', '2017-12-14 11:39:00'),
(335, 'Jade Turcotte V', 'CB', 484, 10, '2017-12-14 11:39:00', '2017-12-14 11:39:00'),
(336, 'Christ Metz DDS', 'WF', 417, 10, '2017-12-14 11:39:00', '2017-12-14 11:39:00'),
(337, 'Hans Feeney', 'WF', 198, 10, '2017-12-14 11:39:00', '2017-12-14 11:39:00'),
(338, 'Dr. Colt Hahn II', 'CF', 456, 10, '2017-12-14 11:39:00', '2017-12-14 11:39:00'),
(339, 'Luis Wilkinson', 'RWB', 150, 10, '2017-12-14 11:39:00', '2017-12-14 11:39:00'),
(340, 'Dr. Dawson Wilkinson V', 'GK', 272, 10, '2017-12-14 11:39:01', '2017-12-14 11:39:01'),
(341, 'Ms. Tabitha Marquardt I', 'DM', 98, 10, '2017-12-14 11:39:01', '2017-12-14 11:39:01'),
(342, 'Roy Feeney', 'RB', 95, 10, '2017-12-14 11:39:01', '2017-12-14 11:39:01'),
(343, 'Mrs. Antoinette Volkman', 'LB', 118, 10, '2017-12-14 11:39:01', '2017-12-14 11:39:01'),
(344, 'Prof. Jess Donnelly', 'LWB', 277, 10, '2017-12-14 11:39:01', '2017-12-14 11:39:01'),
(345, 'Camden Rodriguez Sr.', 'LB', 176, 10, '2017-12-14 11:39:02', '2017-12-14 11:39:02'),
(346, 'Earnest Crist', 'SS', 249, 10, '2017-12-14 11:39:02', '2017-12-14 11:39:02'),
(347, 'Marques Pfannerstill', 'WM', 140, 10, '2017-12-14 11:39:02', '2017-12-14 11:39:02'),
(348, 'Jimmy Fritsch DVM', 'CF', 176, 10, '2017-12-14 11:39:02', '2017-12-14 11:39:02'),
(349, 'Junius Torp Sr.', 'SW', 391, 10, '2017-12-14 11:39:02', '2017-12-14 11:39:02'),
(350, 'Dr. Christina Marks DDS', 'LWB', 138, 10, '2017-12-14 11:39:03', '2017-12-14 11:39:03'),
(351, 'Cassandra Johnston', 'SW', 349, 10, '2017-12-14 11:39:03', '2017-12-14 11:39:03'),
(352, 'Kamren Reynolds', 'GK', 421, 10, '2017-12-14 11:39:03', '2017-12-14 11:39:03'),
(353, 'Burnice Feeney', 'WF', 165, 10, '2017-12-14 11:39:04', '2017-12-14 11:39:04'),
(354, 'Montana Bosco', 'WM', 90, 10, '2017-12-14 11:39:04', '2017-12-14 11:39:04'),
(355, 'Jedidiah Morar', 'WM', 421, 10, '2017-12-14 11:39:04', '2017-12-14 11:39:04'),
(356, 'Mrs. Aiyana Luettgen', 'LWB', 453, 10, '2017-12-14 11:39:04', '2017-12-14 11:39:04'),
(357, 'Prof. Eleonore Bartell V', 'SW', 136, 10, '2017-12-14 11:39:04', '2017-12-14 11:39:04'),
(358, 'Mrs. Elinore Rau', 'RWB', 184, 10, '2017-12-14 11:39:05', '2017-12-14 11:39:05'),
(359, 'Chaim Sanford', 'WM', 257, 10, '2017-12-14 11:39:05', '2017-12-14 11:39:05'),
(360, 'Furman Bartell', 'WF', 201, 10, '2017-12-14 11:39:05', '2017-12-14 11:39:05'),
(361, 'Everette Runolfsson MD', 'LB', 296, 10, '2017-12-14 11:39:05', '2017-12-14 11:39:05'),
(362, 'Louvenia Crist', 'RB', 54, 10, '2017-12-14 11:39:05', '2017-12-14 11:39:05'),
(363, 'Darron Huels', 'WM', 458, 10, '2017-12-14 11:39:05', '2017-12-14 11:39:05'),
(364, 'Mr. Dominic Beatty Jr.', 'LWB', 176, 10, '2017-12-14 11:39:05', '2017-12-14 11:39:05'),
(365, 'Mayra Parisian', 'RWB', 344, 10, '2017-12-14 11:39:05', '2017-12-14 11:39:05'),
(366, 'Cielo Schmidt', 'CF', 226, 10, '2017-12-14 11:39:05', '2017-12-14 11:39:05'),
(367, 'Kali Boyer', 'WM', 441, 10, '2017-12-14 11:39:06', '2017-12-14 11:39:06'),
(368, 'Cheyenne Kessler', 'SS', 54, 10, '2017-12-14 11:39:06', '2017-12-14 11:39:06'),
(369, 'Javier Hilll', 'AM', 141, 10, '2017-12-14 11:39:06', '2017-12-14 11:39:06'),
(370, 'Nelda Lakin', 'LB', 442, 10, '2017-12-14 11:39:06', '2017-12-14 11:39:06'),
(371, 'Ahmed Yundt', 'WF', 361, 10, '2017-12-14 11:39:06', '2017-12-14 11:39:06'),
(372, 'Mrs. Karolann Durgan Sr.', 'RB', 310, 10, '2017-12-14 11:39:06', '2017-12-14 11:39:06'),
(373, 'Maudie Morar', 'WF', 334, 10, '2017-12-14 11:39:06', '2017-12-14 11:39:06'),
(374, 'Amina Kihn', 'SW', 357, 10, '2017-12-14 11:39:06', '2017-12-14 11:39:06'),
(375, 'Daniela Stracke II', 'RWB', 439, 10, '2017-12-14 11:39:06', '2017-12-14 11:39:06'),
(376, 'Jonas Hills', 'CM', 152, 10, '2017-12-14 11:39:06', '2017-12-14 11:39:06'),
(377, 'Dovie Heller Sr.', 'WF', 356, 10, '2017-12-14 11:39:06', '2017-12-14 11:39:06'),
(378, 'Carmel Franecki', 'AM', 186, 10, '2017-12-14 11:39:06', '2017-12-14 11:39:06'),
(379, 'Tyrell Haag', 'RWB', 30, 10, '2017-12-14 11:39:06', '2017-12-14 11:39:06'),
(380, 'Mariam Kling', 'CB', 371, 10, '2017-12-14 11:39:06', '2017-12-14 11:39:06'),
(381, 'Braulio Barrows', 'CM', 55, 10, '2017-12-14 11:39:06', '2017-12-14 11:39:06'),
(382, 'Rachael McLaughlin Jr.', 'SW', 349, 10, '2017-12-14 11:39:06', '2017-12-14 11:39:06'),
(383, 'Samara Hane I', 'SS', 346, 10, '2017-12-14 11:39:07', '2017-12-14 11:39:07'),
(384, 'Willow Senger', 'GK', 496, 10, '2017-12-14 11:39:07', '2017-12-14 11:39:07'),
(385, 'Lou Moen', 'WM', 111, 10, '2017-12-14 11:39:07', '2017-12-14 11:39:07'),
(386, 'Jamil Altenwerth', 'DM', 96, 10, '2017-12-14 11:39:07', '2017-12-14 11:39:07'),
(387, 'Brenden Gerhold', 'AM', 146, 10, '2017-12-14 11:39:07', '2017-12-14 11:39:07'),
(388, 'Henri Schinner II', 'WF', 174, 10, '2017-12-14 11:39:07', '2017-12-14 11:39:07'),
(389, 'Eliezer Kris', 'CB', 448, 10, '2017-12-14 11:39:07', '2017-12-14 11:39:07'),
(390, 'Gennaro Schulist', 'AM', 159, 10, '2017-12-14 11:39:07', '2017-12-14 11:39:07'),
(391, 'Dr. Dimitri Hoeger I', 'AM', 277, 10, '2017-12-14 11:39:07', '2017-12-14 11:39:07'),
(392, 'Clark Schuster', 'SW', 329, 10, '2017-12-14 11:39:08', '2017-12-14 11:39:08'),
(393, 'Dr. Michele Adams III', 'RB', 40, 10, '2017-12-14 11:39:08', '2017-12-14 11:39:08'),
(394, 'Jade Cormier', 'RWB', 73, 10, '2017-12-14 11:39:08', '2017-12-14 11:39:08'),
(395, 'Dr. Forest Zulauf', 'WF', 198, 10, '2017-12-14 11:39:08', '2017-12-14 11:39:08'),
(396, 'Lessie Casper', 'CB', 274, 10, '2017-12-14 11:39:09', '2017-12-14 11:39:09'),
(397, 'Dovie Kreiger', 'WF', 498, 10, '2017-12-14 11:39:09', '2017-12-14 11:39:09'),
(398, 'Mohammed Erdman', 'LB', 144, 10, '2017-12-14 11:39:09', '2017-12-14 11:39:09'),
(399, 'Dr. Darius Howell', 'RB', 8, 10, '2017-12-14 11:39:09', '2017-12-14 11:39:09'),
(400, 'Prof. Alex Langworth', 'DM', 259, 10, '2017-12-14 11:39:09', '2017-12-14 11:39:09'),
(401, 'Kristoffer Hayes Sr.', 'RWB', 454, 10, '2017-12-14 11:39:09', '2017-12-14 11:39:09'),
(402, 'Prof. Lacy Rice Sr.', 'LB', 108, 10, '2017-12-14 11:39:09', '2017-12-14 11:39:09'),
(403, 'Katelin McClure', 'DM', 356, 10, '2017-12-14 11:39:09', '2017-12-14 11:39:09'),
(404, 'Tristin Lehner II', 'GK', 255, 10, '2017-12-14 11:39:09', '2017-12-14 11:39:09'),
(405, 'Cecilia Friesen', 'LB', 107, 10, '2017-12-14 11:39:10', '2017-12-14 11:39:10'),
(406, 'Garrett Okuneva IV', 'AM', 455, 10, '2017-12-14 11:39:10', '2017-12-14 11:39:10'),
(407, 'Prof. Domenica Price Sr.', 'LWB', 62, 10, '2017-12-14 11:39:10', '2017-12-14 11:39:10'),
(408, 'Prof. Chaz Daugherty I', 'LWB', 476, 10, '2017-12-14 11:39:10', '2017-12-14 11:39:10'),
(409, 'Zackery Kuvalis', 'WM', 479, 10, '2017-12-14 11:39:10', '2017-12-14 11:39:10'),
(410, 'Emile Schmeler', 'GK', 297, 10, '2017-12-14 11:39:10', '2017-12-14 11:39:10'),
(411, 'Tierra Hudson', 'RB', 278, 10, '2017-12-14 11:39:10', '2017-12-14 11:39:10'),
(412, 'Mrs. Libbie Haag', 'CF', 396, 10, '2017-12-14 11:39:10', '2017-12-14 11:39:10'),
(413, 'Gudrun Heidenreich', 'CM', 272, 10, '2017-12-14 11:39:10', '2017-12-14 11:39:10'),
(414, 'Raymundo Torphy', 'RWB', 176, 10, '2017-12-14 11:39:10', '2017-12-14 11:39:10'),
(415, 'Lazaro Corkery', 'LB', 433, 10, '2017-12-14 11:39:10', '2017-12-14 11:39:10'),
(416, 'Mrs. Lydia Schuppe Jr.', 'CF', 197, 10, '2017-12-14 11:39:10', '2017-12-14 11:39:10'),
(417, 'Otho Stiedemann', 'WM', 479, 10, '2017-12-14 11:39:11', '2017-12-14 11:39:11'),
(418, 'Miss Isabella Mosciski', 'RWB', 399, 10, '2017-12-14 11:39:11', '2017-12-14 11:39:11'),
(419, 'Mr. Hayden Roberts', 'RWB', 356, 10, '2017-12-14 11:39:11', '2017-12-14 11:39:11'),
(420, 'Lindsey Olson', 'CF', 360, 10, '2017-12-14 11:39:11', '2017-12-14 11:39:11'),
(421, 'Blaze Nikolaus', 'SS', 329, 10, '2017-12-14 11:39:11', '2017-12-14 11:39:11'),
(422, 'Rosella Reichert', 'WF', 356, 10, '2017-12-14 11:39:11', '2017-12-14 11:39:11'),
(423, 'Anna Weber', 'LB', 340, 10, '2017-12-14 11:39:11', '2017-12-14 11:39:11'),
(424, 'Noah Hettinger', 'GK', 60, 10, '2017-12-14 11:39:11', '2017-12-14 11:39:11'),
(425, 'Jovan Kutch', 'WM', 197, 10, '2017-12-14 11:39:11', '2017-12-14 11:39:11'),
(426, 'Janae Marquardt', 'RWB', 426, 10, '2017-12-14 11:39:11', '2017-12-14 11:39:11'),
(427, 'Felipa Murray', 'AM', 23, 10, '2017-12-14 11:39:11', '2017-12-14 11:39:11'),
(428, 'Loraine Denesik', 'RB', 300, 10, '2017-12-14 11:39:11', '2017-12-14 11:39:11'),
(429, 'Joanne Abernathy', 'LWB', 349, 10, '2017-12-14 11:39:11', '2017-12-14 11:39:11'),
(430, 'Dr. Axel Wilkinson', 'RB', 136, 10, '2017-12-14 11:39:11', '2017-12-14 11:39:11'),
(431, 'Annamae Terry', 'RWB', 42, 10, '2017-12-14 11:39:11', '2017-12-14 11:39:11'),
(432, 'Dr. Ladarius Nicolas', 'LB', 458, 10, '2017-12-14 11:39:11', '2017-12-14 11:39:11'),
(433, 'Maximillian McGlynn V', 'CB', 197, 10, '2017-12-14 11:39:11', '2017-12-14 11:39:11'),
(434, 'Dahlia Smith', 'SW', 231, 10, '2017-12-14 11:39:11', '2017-12-14 11:39:11'),
(435, 'Jordon Weimann', 'CM', 308, 10, '2017-12-14 11:39:11', '2017-12-14 11:39:11'),
(436, 'Alek Crist', 'WF', 233, 10, '2017-12-14 11:39:12', '2017-12-14 11:39:12'),
(437, 'Dennis Lueilwitz III', 'RB', 359, 10, '2017-12-14 11:39:12', '2017-12-14 11:39:12'),
(438, 'Lilian Friesen', 'AM', 188, 10, '2017-12-14 11:39:12', '2017-12-14 11:39:12'),
(439, 'Jana Romaguera', 'GK', 336, 10, '2017-12-14 11:39:12', '2017-12-14 11:39:12'),
(440, 'Janet Gibson', 'LWB', 255, 10, '2017-12-14 11:39:12', '2017-12-14 11:39:12'),
(441, 'Garry McLaughlin', 'SW', 307, 10, '2017-12-14 11:39:12', '2017-12-14 11:39:12'),
(442, 'Annalise Dach', 'RWB', 396, 10, '2017-12-14 11:39:12', '2017-12-14 11:39:12'),
(443, 'Mrs. Estell Medhurst DVM', 'LWB', 441, 10, '2017-12-14 11:39:12', '2017-12-14 11:39:12'),
(444, 'Miss Maud Stroman PhD', 'SS', 264, 10, '2017-12-14 11:39:12', '2017-12-14 11:39:12'),
(445, 'Hugh Nolan', 'CB', 65, 10, '2017-12-14 11:39:12', '2017-12-14 11:39:12'),
(446, 'Dr. Rudolph Runolfsson Sr.', 'DM', 415, 10, '2017-12-14 11:39:12', '2017-12-14 11:39:12'),
(447, 'Dr. Eudora Kiehn PhD', 'RWB', 469, 10, '2017-12-14 11:39:12', '2017-12-14 11:39:12'),
(448, 'Jovani Hills', 'DM', 328, 10, '2017-12-14 11:39:12', '2017-12-14 11:39:12'),
(449, 'Shyanne Bauch', 'CF', 66, 10, '2017-12-14 11:39:12', '2017-12-14 11:39:12'),
(450, 'Dorothea Price', 'CM', 395, 10, '2017-12-14 11:39:12', '2017-12-14 11:39:12'),
(451, 'Meaghan Stokes', 'CM', 419, 10, '2017-12-14 11:39:12', '2017-12-14 11:39:12'),
(452, 'Mabelle Nolan', 'LB', 329, 10, '2017-12-14 11:39:12', '2017-12-14 11:39:12'),
(453, 'Dr. Elliott Senger Jr.', 'DM', 66, 10, '2017-12-14 11:39:12', '2017-12-14 11:39:12'),
(454, 'Brent Carroll', 'CB', 293, 10, '2017-12-14 11:39:13', '2017-12-14 11:39:13'),
(455, 'Prof. Cecelia Emmerich Sr.', 'RB', 19, 10, '2017-12-14 11:39:13', '2017-12-14 11:39:13'),
(456, 'Agnes Gerhold Jr.', 'RWB', 112, 10, '2017-12-14 11:39:13', '2017-12-14 11:39:13'),
(457, 'Katharina Roob', 'CB', 74, 10, '2017-12-14 11:39:13', '2017-12-14 11:39:13'),
(458, 'Adolphus Kohler', 'CF', 342, 10, '2017-12-14 11:39:13', '2017-12-14 11:39:13'),
(459, 'Ms. Pat Botsford', 'RB', 40, 10, '2017-12-14 11:39:13', '2017-12-14 11:39:13'),
(460, 'Rosina Hahn', 'WM', 457, 10, '2017-12-14 11:39:13', '2017-12-14 11:39:13'),
(461, 'Libbie Pfannerstill', 'GK', 275, 10, '2017-12-14 11:39:13', '2017-12-14 11:39:13'),
(462, 'Dr. Sidney Stehr', 'CB', 407, 10, '2017-12-14 11:39:13', '2017-12-14 11:39:13'),
(463, 'Eldon Stroman', 'CB', 361, 10, '2017-12-14 11:39:13', '2017-12-14 11:39:13'),
(464, 'Trey Yundt', 'WM', 190, 10, '2017-12-14 11:39:13', '2017-12-14 11:39:13'),
(465, 'Murl Gutkowski', 'GK', 265, 10, '2017-12-14 11:39:13', '2017-12-14 11:39:13'),
(466, 'Cornelius Mann', 'AM', 290, 10, '2017-12-14 11:39:13', '2017-12-14 11:39:13'),
(467, 'Flo Bayer', 'DM', 150, 10, '2017-12-14 11:39:13', '2017-12-14 11:39:13'),
(468, 'Dr. Ari Konopelski', 'RB', 113, 10, '2017-12-14 11:39:13', '2017-12-14 11:39:13'),
(469, 'Maxime Farrell', 'LWB', 52, 10, '2017-12-14 11:39:13', '2017-12-14 11:39:13'),
(470, 'Madge Olson', 'LB', 102, 10, '2017-12-14 11:39:13', '2017-12-14 11:39:13'),
(471, 'Mrs. Pattie Rogahn', 'AM', 94, 10, '2017-12-14 11:39:13', '2017-12-14 11:39:13'),
(472, 'Brando Heller II', 'RWB', 164, 10, '2017-12-14 11:39:13', '2017-12-14 11:39:13'),
(473, 'Lauryn Bechtelar', 'RB', 4, 10, '2017-12-14 11:39:14', '2017-12-14 11:39:14'),
(474, 'Kara Miller III', 'SW', 323, 10, '2017-12-14 11:39:14', '2017-12-14 11:39:14'),
(475, 'Prof. Pat Mraz', 'WF', 465, 10, '2017-12-14 11:39:14', '2017-12-14 11:39:14'),
(476, 'Dr. Douglas Feest', 'RB', 113, 10, '2017-12-14 11:39:14', '2017-12-14 11:39:14'),
(477, 'Keara Jacobi', 'WF', 290, 10, '2017-12-14 11:39:14', '2017-12-14 11:39:14'),
(478, 'Rosella Nikolaus', 'CB', 85, 10, '2017-12-14 11:39:14', '2017-12-14 11:39:14'),
(479, 'Cathy Wilkinson', 'CF', 75, 10, '2017-12-14 11:39:14', '2017-12-14 11:39:14'),
(480, 'Fleta Dare', 'CB', 19, 10, '2017-12-14 11:39:14', '2017-12-14 11:39:14'),
(481, 'Mertie Swaniawski', 'SW', 198, 10, '2017-12-14 11:39:14', '2017-12-14 11:39:14'),
(482, 'Mr. Travon Dietrich II', 'AM', 488, 10, '2017-12-14 11:39:14', '2017-12-14 11:39:14'),
(483, 'Corene Langworth', 'LB', 327, 10, '2017-12-14 11:39:14', '2017-12-14 11:39:14'),
(484, 'Brayan Steuber', 'SS', 447, 10, '2017-12-14 11:39:14', '2017-12-14 11:39:14'),
(485, 'Jorge Jaskolski', 'WF', 34, 10, '2017-12-14 11:39:14', '2017-12-14 11:39:14'),
(486, 'Dave Kris Jr.', 'GK', 409, 10, '2017-12-14 11:39:14', '2017-12-14 11:39:14'),
(487, 'Dr. Alycia Halvorson Sr.', 'RB', 209, 10, '2017-12-14 11:39:14', '2017-12-14 11:39:14'),
(488, 'Dr. Hazle Runolfsson', 'CM', 350, 10, '2017-12-14 11:39:14', '2017-12-14 11:39:14'),
(489, 'Roy Greenholt', 'LWB', 406, 10, '2017-12-14 11:39:15', '2017-12-14 11:39:15'),
(490, 'Arnulfo Shields', 'CF', 238, 10, '2017-12-14 11:39:15', '2017-12-14 11:39:15'),
(491, 'Albertha Thiel DDS', 'CM', 381, 10, '2017-12-14 11:39:15', '2017-12-14 11:39:15'),
(492, 'Caroline Hand', 'AM', 313, 10, '2017-12-14 11:39:15', '2017-12-14 11:39:15'),
(493, 'Prof. Cordia Friesen DDS', 'DM', 78, 10, '2017-12-14 11:39:15', '2017-12-14 11:39:15'),
(494, 'Prof. Jamie Barton PhD', 'CM', 475, 10, '2017-12-14 11:39:15', '2017-12-14 11:39:15'),
(495, 'Prof. Milan Witting', 'CM', 103, 10, '2017-12-14 11:39:15', '2017-12-14 11:39:15'),
(496, 'Ms. Lenore McGlynn', 'SS', 497, 10, '2017-12-14 11:39:15', '2017-12-14 11:39:15'),
(497, 'Eva Ebert', 'WF', 46, 10, '2017-12-14 11:39:15', '2017-12-14 11:39:15'),
(498, 'Rebeca McCullough', 'SS', 218, 10, '2017-12-14 11:39:15', '2017-12-14 11:39:15'),
(499, 'Sonia Stroman II', 'RB', 112, 10, '2017-12-14 11:39:15', '2017-12-14 11:39:15'),
(500, 'Arne Corwin', 'GK', 497, 10, '2017-12-14 11:39:15', '2017-12-14 11:39:15');

-- --------------------------------------------------------

--
-- Table structure for table `registered_players`
--

DROP TABLE IF EXISTS `registered_players`;
CREATE TABLE IF NOT EXISTS `registered_players` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `registered_team_id` int(11) NOT NULL,
  `player_id` int(11) NOT NULL,
  `played` int(11) NOT NULL,
  `goals` int(11) NOT NULL,
  `assists` int(11) NOT NULL,
  `red_cards` int(11) NOT NULL,
  `yellow_cards` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `registered_players_registered_team_id_player_id_unique` (`registered_team_id`,`player_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=112 ;

--
-- Truncate table before insert `registered_players`
--

TRUNCATE TABLE `registered_players`;
--
-- Dumping data for table `registered_players`
--

INSERT INTO `registered_players` (`id`, `registered_team_id`, `player_id`, `played`, `goals`, `assists`, `red_cards`, `yellow_cards`, `created_at`, `updated_at`) VALUES
(2, 75, 259, 0, 0, 0, 0, 0, NULL, NULL),
(3, 63, 39, 0, 0, 0, 0, 0, NULL, NULL),
(4, 420, 10, 0, 0, 0, 0, 0, NULL, NULL),
(5, 49, 163, 0, 0, 0, 0, 0, NULL, NULL),
(6, 451, 76, 0, 0, 0, 0, 0, NULL, NULL),
(7, 251, 492, 0, 0, 0, 0, 0, NULL, NULL),
(8, 437, 467, 0, 0, 0, 0, 0, NULL, NULL),
(9, 263, 256, 0, 0, 0, 0, 0, NULL, NULL),
(10, 95, 67, 0, 0, 0, 0, 0, NULL, NULL),
(11, 437, 193, 0, 0, 0, 0, 0, NULL, NULL),
(12, 313, 429, 0, 0, 0, 0, 0, NULL, NULL),
(13, 337, 350, 0, 0, 0, 0, 0, NULL, NULL),
(14, 217, 392, 0, 0, 0, 0, 0, NULL, NULL),
(15, 61, 105, 0, 0, 0, 0, 0, NULL, NULL),
(16, 3, 152, 0, 0, 0, 0, 0, NULL, NULL),
(17, 36, 333, 0, 0, 0, 0, 0, NULL, NULL),
(18, 489, 467, 0, 0, 0, 0, 0, NULL, NULL),
(19, 413, 455, 0, 0, 0, 0, 0, NULL, NULL),
(20, 152, 265, 0, 0, 0, 0, 0, NULL, NULL),
(21, 452, 262, 0, 0, 0, 0, 0, NULL, NULL),
(22, 462, 339, 0, 0, 0, 0, 0, NULL, NULL),
(23, 140, 209, 0, 0, 0, 0, 0, NULL, NULL),
(24, 108, 92, 0, 0, 0, 0, 0, NULL, NULL),
(25, 454, 58, 0, 0, 0, 0, 0, NULL, NULL),
(26, 309, 40, 0, 0, 0, 0, 0, NULL, NULL),
(27, 298, 99, 0, 0, 0, 0, 0, NULL, NULL),
(28, 174, 327, 0, 0, 0, 0, 0, NULL, NULL),
(29, 464, 206, 0, 0, 0, 0, 0, NULL, NULL),
(30, 340, 156, 0, 0, 0, 0, 0, NULL, NULL),
(31, 305, 496, 0, 0, 0, 0, 0, NULL, NULL),
(32, 154, 198, 0, 0, 0, 0, 0, NULL, NULL),
(33, 334, 111, 0, 0, 0, 0, 0, NULL, NULL),
(34, 120, 188, 0, 0, 0, 0, 0, NULL, NULL),
(35, 497, 439, 0, 0, 0, 0, 0, NULL, NULL),
(36, 418, 244, 0, 0, 0, 0, 0, NULL, NULL),
(37, 324, 407, 0, 0, 0, 0, 0, NULL, NULL),
(38, 4, 281, 0, 0, 0, 0, 0, NULL, NULL),
(39, 134, 363, 0, 0, 0, 0, 0, NULL, NULL),
(40, 116, 70, 0, 0, 0, 0, 0, NULL, NULL),
(41, 200, 295, 0, 0, 0, 0, 0, NULL, NULL),
(42, 199, 238, 0, 0, 0, 0, 0, NULL, NULL),
(43, 48, 165, 0, 0, 0, 0, 0, NULL, NULL),
(44, 7, 124, 0, 0, 0, 0, 0, NULL, NULL),
(45, 475, 47, 0, 0, 0, 0, 0, NULL, NULL),
(46, 409, 415, 0, 0, 0, 0, 0, NULL, NULL),
(47, 458, 402, 0, 0, 0, 0, 0, NULL, NULL),
(48, 320, 120, 0, 0, 0, 0, 0, NULL, NULL),
(49, 35, 459, 0, 0, 0, 0, 0, NULL, NULL),
(50, 166, 207, 0, 0, 0, 0, 0, NULL, NULL),
(51, 77, 361, 0, 0, 0, 0, 0, NULL, NULL),
(52, 388, 140, 0, 0, 0, 0, 0, NULL, NULL),
(53, 46, 169, 0, 0, 0, 0, 0, NULL, NULL),
(54, 278, 42, 0, 0, 0, 0, 0, NULL, NULL),
(55, 371, 190, 0, 0, 0, 0, 0, NULL, NULL),
(56, 351, 335, 0, 0, 0, 0, 0, NULL, NULL),
(57, 149, 296, 0, 0, 0, 0, 0, NULL, NULL),
(58, 100, 234, 0, 0, 0, 0, 0, NULL, NULL),
(59, 160, 226, 0, 0, 0, 0, 0, NULL, NULL),
(60, 269, 63, 0, 0, 0, 0, 0, NULL, NULL),
(61, 95, 280, 0, 0, 0, 0, 0, NULL, NULL),
(62, 294, 364, 0, 0, 0, 0, 0, NULL, NULL),
(63, 260, 345, 0, 0, 0, 0, 0, NULL, NULL),
(64, 106, 420, 0, 0, 0, 0, 0, NULL, NULL),
(65, 48, 89, 0, 0, 0, 0, 0, NULL, NULL),
(66, 299, 450, 0, 0, 0, 0, 0, NULL, NULL),
(67, 69, 327, 0, 0, 0, 0, 0, NULL, NULL),
(68, 141, 185, 0, 0, 0, 0, 0, NULL, NULL),
(69, 354, 77, 0, 0, 0, 0, 0, NULL, NULL),
(70, 263, 227, 0, 0, 0, 0, 0, NULL, NULL),
(71, 389, 99, 0, 0, 0, 0, 0, NULL, NULL),
(72, 194, 236, 0, 0, 0, 0, 0, NULL, NULL),
(73, 288, 311, 0, 0, 0, 0, 0, NULL, NULL),
(74, 391, 401, 0, 0, 0, 0, 0, NULL, NULL),
(75, 365, 352, 0, 0, 0, 0, 0, NULL, NULL),
(76, 355, 147, 0, 0, 0, 0, 0, NULL, NULL),
(77, 243, 352, 0, 0, 0, 0, 0, NULL, NULL),
(78, 398, 159, 0, 0, 0, 0, 0, NULL, NULL),
(79, 278, 93, 0, 0, 0, 0, 0, NULL, NULL),
(80, 358, 307, 0, 0, 0, 0, 0, NULL, NULL),
(81, 440, 404, 0, 0, 0, 0, 0, NULL, NULL),
(82, 357, 314, 0, 0, 0, 0, 0, NULL, NULL),
(83, 386, 144, 0, 0, 0, 0, 0, NULL, NULL),
(84, 252, 228, 0, 0, 0, 0, 0, NULL, NULL),
(85, 160, 341, 0, 0, 0, 0, 0, NULL, NULL),
(86, 429, 144, 0, 0, 0, 0, 0, NULL, NULL),
(87, 455, 311, 0, 0, 0, 0, 0, NULL, NULL),
(88, 95, 333, 0, 0, 0, 0, 0, NULL, NULL),
(89, 79, 244, 0, 0, 0, 0, 0, NULL, NULL),
(90, 257, 215, 0, 0, 0, 0, 0, NULL, NULL),
(91, 322, 75, 0, 0, 0, 0, 0, NULL, NULL),
(92, 379, 176, 0, 0, 0, 0, 0, NULL, NULL),
(93, 95, 363, 0, 0, 0, 0, 0, NULL, NULL),
(94, 55, 45, 0, 0, 0, 0, 0, NULL, NULL),
(95, 374, 55, 0, 0, 0, 0, 0, NULL, NULL),
(96, 90, 334, 0, 0, 0, 0, 0, NULL, NULL),
(97, 341, 330, 0, 0, 0, 0, 0, NULL, NULL),
(98, 483, 205, 0, 0, 0, 0, 0, NULL, NULL),
(99, 194, 123, 0, 0, 0, 0, 0, NULL, NULL),
(100, 267, 56, 0, 0, 0, 0, 0, NULL, NULL),
(101, 424, 157, 0, 0, 0, 0, 0, NULL, NULL),
(102, 255, 138, 0, 0, 0, 0, 0, NULL, NULL),
(103, 139, 218, 0, 0, 0, 0, 0, NULL, NULL),
(104, 361, 273, 0, 0, 0, 0, 0, NULL, NULL),
(105, 162, 273, 0, 0, 0, 0, 0, NULL, NULL),
(106, 291, 444, 0, 0, 0, 0, 0, NULL, NULL),
(107, 159, 208, 0, 0, 0, 0, 0, NULL, NULL),
(108, 146, 23, 0, 0, 0, 0, 0, NULL, NULL),
(109, 251, 71, 0, 0, 0, 0, 0, NULL, NULL),
(110, 64, 71, 0, 0, 0, 0, 0, NULL, NULL),
(111, 1, 1, 0, 0, 0, 0, 0, '2017-12-17 18:39:03', '2017-12-17 18:39:03');

-- --------------------------------------------------------

--
-- Table structure for table `registered_teams`
--

DROP TABLE IF EXISTS `registered_teams`;
CREATE TABLE IF NOT EXISTS `registered_teams` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `season_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `played` int(11) NOT NULL,
  `wins` int(11) NOT NULL,
  `losses` int(11) NOT NULL,
  `draws` int(11) NOT NULL,
  `goals_for` int(11) NOT NULL,
  `goals_against` int(11) NOT NULL,
  `points` int(11) NOT NULL,
  `red_cards` int(11) NOT NULL,
  `yellow_cards` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `registered_teams_season_id_team_id_unique` (`season_id`,`team_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=31 ;

--
-- Truncate table before insert `registered_teams`
--

TRUNCATE TABLE `registered_teams`;
--
-- Dumping data for table `registered_teams`
--

INSERT INTO `registered_teams` (`id`, `season_id`, `team_id`, `played`, `wins`, `losses`, `draws`, `goals_for`, `goals_against`, `points`, `red_cards`, `yellow_cards`) VALUES
(1, 9, 458, 1, 1, 0, 0, 2, 1, 3, 0, 1),
(2, 9, 411, 1, 0, 1, 0, 1, 2, 0, 1, 2),
(3, 9, 106, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(4, 9, 449, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5, 9, 236, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(6, 9, 253, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(7, 9, 158, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(8, 9, 302, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(9, 9, 148, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(10, 9, 103, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(11, 9, 116, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(12, 9, 81, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(13, 9, 141, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(14, 9, 24, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(15, 9, 403, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(16, 9, 270, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(17, 9, 183, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(18, 9, 93, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(19, 9, 54, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(20, 9, 422, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(21, 9, 42, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(22, 9, 53, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(23, 9, 65, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(24, 9, 157, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(25, 9, 62, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(26, 9, 205, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(27, 9, 175, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(28, 9, 140, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(29, 9, 339, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(30, 9, 416, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `rounds`
--

DROP TABLE IF EXISTS `rounds`;
CREATE TABLE IF NOT EXISTS `rounds` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=8 ;

--
-- Truncate table before insert `rounds`
--

TRUNCATE TABLE `rounds`;
--
-- Dumping data for table `rounds`
--

INSERT INTO `rounds` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'First round', NULL, NULL),
(2, '64', NULL, NULL),
(3, '32', NULL, NULL),
(4, '16', NULL, NULL),
(5, '8', NULL, NULL),
(6, '4', NULL, NULL),
(7, 'Final', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `seasons`
--

DROP TABLE IF EXISTS `seasons`;
CREATE TABLE IF NOT EXISTS `seasons` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comp_id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `seasons_name_comp_id_unique` (`name`,`comp_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=11 ;

--
-- Truncate table before insert `seasons`
--

TRUNCATE TABLE `seasons`;
--
-- Dumping data for table `seasons`
--

INSERT INTO `seasons` (`id`, `name`, `comp_id`, `active`, `created_at`, `updated_at`) VALUES
(1, '2009', 1, 0, '2017-12-14 11:38:10', '2017-12-14 11:38:10'),
(2, '2010', 1, 0, '2017-12-14 11:38:10', '2017-12-14 11:38:10'),
(3, '2011', 1, 0, '2017-12-14 11:38:10', '2017-12-14 11:38:10'),
(4, '2012', 1, 0, '2017-12-14 11:38:10', '2017-12-14 11:38:10'),
(5, '2013', 1, 0, '2017-12-14 11:38:10', '2017-12-14 11:38:10'),
(6, '2014', 1, 0, '2017-12-14 11:38:10', '2017-12-14 11:38:10'),
(7, '2015', 1, 0, '2017-12-14 11:38:10', '2017-12-14 11:38:10'),
(8, '2016', 1, 0, '2017-12-14 11:38:10', '2017-12-14 11:38:10'),
(9, '2017', 1, 1, '2017-12-14 11:38:10', '2017-12-14 11:38:10'),
(10, '2017', 2, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `stages`
--

DROP TABLE IF EXISTS `stages`;
CREATE TABLE IF NOT EXISTS `stages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `season_id` int(11) NOT NULL,
  `stage_id` int(10) unsigned NOT NULL,
  `stage_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `stages_stage_id_stage_type_index` (`stage_id`,`stage_type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=46 ;

--
-- Truncate table before insert `stages`
--

TRUNCATE TABLE `stages`;
--
-- Dumping data for table `stages`
--

INSERT INTO `stages` (`id`, `season_id`, `stage_id`, `stage_type`, `created_at`, `updated_at`) VALUES
(1, 9, 1, 'App\\Week', NULL, NULL),
(2, 9, 2, 'App\\Week', NULL, NULL),
(3, 9, 3, 'App\\Week', NULL, NULL),
(4, 9, 4, 'App\\Week', NULL, NULL),
(5, 9, 5, 'App\\Week', NULL, NULL),
(6, 9, 6, 'App\\Week', NULL, NULL),
(7, 9, 7, 'App\\Week', NULL, NULL),
(8, 9, 8, 'App\\Week', NULL, NULL),
(9, 9, 9, 'App\\Week', NULL, NULL),
(10, 9, 10, 'App\\Week', NULL, NULL),
(11, 9, 11, 'App\\Week', NULL, NULL),
(12, 9, 12, 'App\\Week', NULL, NULL),
(13, 9, 13, 'App\\Week', NULL, NULL),
(14, 9, 14, 'App\\Week', NULL, NULL),
(15, 9, 15, 'App\\Week', NULL, NULL),
(16, 9, 16, 'App\\Week', NULL, NULL),
(17, 9, 17, 'App\\Week', NULL, NULL),
(18, 9, 18, 'App\\Week', NULL, NULL),
(19, 9, 19, 'App\\Week', NULL, NULL),
(20, 9, 20, 'App\\Week', NULL, NULL),
(21, 9, 21, 'App\\Week', NULL, NULL),
(22, 9, 22, 'App\\Week', NULL, NULL),
(23, 9, 23, 'App\\Week', NULL, NULL),
(24, 9, 24, 'App\\Week', NULL, NULL),
(25, 9, 25, 'App\\Week', NULL, NULL),
(26, 9, 26, 'App\\Week', NULL, NULL),
(27, 9, 27, 'App\\Week', NULL, NULL),
(28, 9, 28, 'App\\Week', NULL, NULL),
(29, 9, 29, 'App\\Week', NULL, NULL),
(30, 9, 30, 'App\\Week', NULL, NULL),
(31, 9, 31, 'App\\Week', NULL, NULL),
(32, 9, 32, 'App\\Week', NULL, NULL),
(33, 9, 33, 'App\\Week', NULL, NULL),
(34, 9, 34, 'App\\Week', NULL, NULL),
(35, 9, 35, 'App\\Week', NULL, NULL),
(36, 9, 36, 'App\\Week', NULL, NULL),
(37, 9, 37, 'App\\Week', NULL, NULL),
(38, 9, 38, 'App\\Week', NULL, NULL),
(39, 10, 1, 'App\\Round', NULL, NULL),
(40, 10, 2, 'App\\Round', NULL, NULL),
(41, 10, 3, 'App\\Round', NULL, NULL),
(42, 10, 4, 'App\\Round', NULL, NULL),
(43, 10, 5, 'App\\Round', NULL, NULL),
(44, 10, 6, 'App\\Round', NULL, NULL),
(45, 10, 7, 'App\\Round', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

DROP TABLE IF EXISTS `teams`;
CREATE TABLE IF NOT EXISTS `teams` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_id` int(11) NOT NULL,
  `logo` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `stadium` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `teams_country_id_name_unique` (`country_id`,`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=501 ;

--
-- Truncate table before insert `teams`
--

TRUNCATE TABLE `teams`;
--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `name`, `type_id`, `logo`, `stadium`, `country_id`, `created_at`, `updated_at`) VALUES
(1, 'Meda Wiegand', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(2, 'Jared Waters', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(3, 'Jameson Hansen', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(4, 'Dr. Emmalee Shields IV', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(5, 'Genoveva Kris', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(6, 'Sunny Berge', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(7, 'Benny Boehm PhD', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(8, 'Mr. Jerrod Dickinson Jr.', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(9, 'Berneice Mohr', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(10, 'Selena Beahan', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(11, 'Mr. Jon O''Keefe DVM', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(12, 'Prof. Marjolaine Hagenes', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(13, 'Elta Braun', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(14, 'Dominic Prosacco', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(15, 'Johann Gleason', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(16, 'Mr. Eldred Zieme DDS', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(17, 'Arno Pollich', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(18, 'Mafalda Crooks DVM', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(19, 'Prof. Itzel Vandervort II', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(20, 'Edgar Kessler', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(21, 'Cecil Goodwin', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(22, 'Cameron Bogisich IV', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(23, 'Katlynn Dooley Sr.', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(24, 'Heath Strosin', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(25, 'Dr. Janick Emard MD', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(26, 'Prof. Clovis Brakus', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(27, 'Lily Kris', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(28, 'Chet Harvey', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(29, 'Dr. Sadie Haag', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(30, 'Maximilian Gerhold IV', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(31, 'Mr. Abel Stoltenberg', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(32, 'Coby Schinner', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(33, 'Ms. Margot Bergnaum III', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(34, 'Hilbert Tillman', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(35, 'Evans Reilly II', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(36, 'Prof. Cicero Kessler V', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(37, 'Eliza Schaden', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(38, 'Christian Hayes', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(39, 'Kaci Hettinger', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(40, 'Mrs. Ruthie Marvin III', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(41, 'Dr. Jean Herzog', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(42, 'Prof. Hertha Krajcik', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(43, 'Allison Friesen', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(44, 'Prof. Reagan Glover MD', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(45, 'Kelton Gorczany II', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(46, 'Dan Murphy', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(47, 'Dr. Santa Kassulke', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(48, 'Dr. Luz Schinner III', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(49, 'Prof. Beverly Hermann Sr.', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(50, 'Marlen Tremblay', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(51, 'Leonora Batz Sr.', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(52, 'Tommie Donnelly', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(53, 'Elaina Denesik', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(54, 'Dr. Myrtie Sanford', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(55, 'Guido Blanda', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(56, 'Dawson Boyer', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(57, 'Jakob Skiles', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(58, 'Laurel Waters', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(59, 'Concepcion Purdy', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(60, 'Augustus VonRueden', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(61, 'Mr. Braeden Pacocha', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(62, 'Mara Dickens', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(63, 'Mr. Bell Cormier', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(64, 'Dr. Whitney Steuber Sr.', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(65, 'Jody Willms DVM', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(66, 'Aisha Collier II', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(67, 'Nikolas Olson', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(68, 'Derek Shanahan', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(69, 'Mrs. Brisa Schumm', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(70, 'Dr. Ollie Daniel', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(71, 'Paolo O''Kon', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(72, 'Miss Velda McDermott', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(73, 'Mrs. Destinee Romaguera IV', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(74, 'Miss Rozella Spinka', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(75, 'Prof. Tyrell Erdman PhD', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(76, 'Ava Hirthe', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(77, 'Ashlee Kirlin DDS', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(78, 'Elmira Johns DDS', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(79, 'Prof. Felix Green V', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(80, 'Marshall O''Conner', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(81, 'Cassandra Bernhard', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(82, 'Pete Schumm', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(83, 'Toy Keebler', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(84, 'Santa Abshire', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(85, 'Mr. Cruz Von DVM', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(86, 'Dr. Myrtle Mosciski', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(87, 'Dr. Marcellus Hettinger', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(88, 'Annamarie Schuppe III', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(89, 'Matilde Hansen', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(90, 'Lora Heathcote', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(91, 'Janet Stroman DDS', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(92, 'Dimitri Walsh', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(93, 'Ross O''Keefe', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(94, 'Ms. Polly Kuhic III', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(95, 'Hertha Orn', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(96, 'Eda Reichert IV', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(97, 'Magdalen Hermann III', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(98, 'Camila Herman', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(99, 'Jarrett Pacocha', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(100, 'Margarett Price', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(101, 'Autumn Schimmel', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(102, 'Harrison Feest', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(103, 'Kayden Bergnaum', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(104, 'Dorcas Parker', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(105, 'Raleigh Langosh', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(106, 'Sigurd Kiehn', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(107, 'Garett Jacobson', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(108, 'Mr. Franz Champlin', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(109, 'Mrs. Lilla Schaefer MD', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(110, 'Hester Hodkiewicz', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(111, 'Leta Brekke', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(112, 'Lilyan Gottlieb', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(113, 'Sven Ebert Sr.', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(114, 'Jaleel Grant', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(115, 'Camden Kutch', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(116, 'Miss Patricia Howe III', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(117, 'Mrs. Oceane Koss', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(118, 'Kaitlyn Schimmel', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(119, 'Keaton Baumbach V', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(120, 'Caleigh Dare III', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(121, 'Ines Kessler', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(122, 'Emil Cole', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(123, 'Moses Hintz', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(124, 'Halle Schoen', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(125, 'Gregoria Glover', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(126, 'Samson Adams', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(127, 'Ms. Creola Strosin', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(128, 'Cathrine Breitenberg', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(129, 'Carleton Orn', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(130, 'Miss Bulah Monahan PhD', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(131, 'Jarod Walsh', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(132, 'Eloy Littel', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(133, 'Dr. Troy Larson I', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(134, 'Sage Wuckert', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(135, 'Houston Bednar', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(136, 'Mr. Gerard Hand I', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(137, 'Elmira Pacocha I', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(138, 'Laila Schamberger', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(139, 'Sunny Thiel', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(140, 'Charley Larkin', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(141, 'Destiney Mraz', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(142, 'Mayra Barrows', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(143, 'Adan Schroeder', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(144, 'Hardy Kassulke', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(145, 'Alf Brown', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(146, 'Allan O''Connell', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(147, 'Magdalen Becker', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(148, 'Prof. Esteban Towne', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(149, 'Corine Homenick', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(150, 'Prof. Dock Daniel III', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(151, 'Torrey Yundt', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(152, 'Mr. Martin Rempel', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(153, 'Miss Rosetta Stokes DVM', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(154, 'Sierra Kuphal', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(155, 'Marguerite Blick', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(156, 'Danika Gusikowski', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(157, 'Prof. Hulda Berge', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(158, 'Miss Shany Dibbert Sr.', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(159, 'Emily Hodkiewicz', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(160, 'Demetrius Cartwright', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(161, 'Devyn Kautzer', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(162, 'Torrance Hudson Sr.', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(163, 'Dr. Delphine Olson', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(164, 'Mrs. Carolanne Leuschke Jr.', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(165, 'Mitchel Considine', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(166, 'Josephine Windler', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(167, 'Bettye Luettgen', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(168, 'Dr. June Morissette PhD', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(169, 'Foster Donnelly', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(170, 'Teagan Sipes', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(171, 'Zane Raynor', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(172, 'Demond Ebert MD', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(173, 'Hassie Wisozk', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(174, 'Paige Ebert', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(175, 'Prof. Luigi Bednar PhD', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(176, 'Ms. Gudrun Bayer', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(177, 'Maximilian Casper PhD', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(178, 'Prof. Terrill Mante', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(179, 'Eden Breitenberg', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(180, 'Paul Lesch Sr.', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(181, 'Lew Stamm II', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(182, 'Rollin Koelpin', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(183, 'Lazaro Hauck', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(184, 'Granville Lindgren', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(185, 'Verda Batz I', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(186, 'Arianna Bergnaum PhD', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(187, 'Kaylah Stanton', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(188, 'Margarett Kiehn', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(189, 'Mr. Jasmin Upton', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(190, 'Ambrose Homenick MD', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(191, 'Rosa White', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(192, 'Clovis Bode', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(193, 'Bianka Ankunding PhD', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(194, 'Jakob Mayert', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(195, 'Dr. Rylan Lind', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(196, 'Dan Huel', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(197, 'Jo Stoltenberg IV', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(198, 'Prof. Abe Emard', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(199, 'Roel Bayer', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(200, 'Dr. Tyrique Vandervort II', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(201, 'Maximillia Hirthe', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(202, 'Skye Osinski', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(203, 'Hillary Fadel III', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(204, 'Oliver Lakin', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(205, 'Margret Legros', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(206, 'Prof. Ezra Johnson Sr.', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(207, 'Lamar O''Keefe', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(208, 'Dr. Roscoe Mohr Jr.', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(209, 'Joanny Marquardt', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(210, 'Mathias Breitenberg', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(211, 'Mrs. Alayna Hills', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(212, 'Miss Anabelle Reynolds DVM', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(213, 'Rosie Kovacek', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(214, 'Lewis Gutmann', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(215, 'Herminia Kautzer IV', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(216, 'Jacey Bergnaum', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(217, 'Miss Shawna Herman', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(218, 'Juston Stoltenberg II', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(219, 'Trudie Swaniawski', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(220, 'Hettie Smith', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(221, 'Shanna O''Hara', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(222, 'Susanna Johns', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(223, 'Alana Emard', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(224, 'Keely Roob', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(225, 'Ms. Aletha Schmeler', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(226, 'Bonita Cronin', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(227, 'Susan Kreiger DVM', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(228, 'Bryana Weber', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(229, 'Catherine Hane Jr.', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(230, 'Pink Weber', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(231, 'Prof. Cale Langosh', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(232, 'Ms. Verdie Orn MD', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(233, 'Gage Oberbrunner IV', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(234, 'Miss Dulce Senger', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(235, 'Dave Ebert', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(236, 'Dr. Norene Hettinger', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(237, 'Maddison Schiller', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(238, 'Prof. Blaze Lynch III', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(239, 'Danielle Pacocha', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(240, 'Alessia Daniel', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(241, 'Kirk Swaniawski', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(242, 'Owen Parisian MD', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(243, 'Myles Becker', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(244, 'Zita Waters', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(245, 'Ruthe Johnson', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(246, 'Carlotta Kautzer', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(247, 'Keagan Hartmann DDS', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(248, 'Jeremie Lockman III', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(249, 'Oleta Morar', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(250, 'Anjali Leannon', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(251, 'Mr. Ian Homenick I', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(252, 'Keyshawn Abbott DVM', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(253, 'Karianne Monahan', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(254, 'Terrance Toy DDS', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(255, 'Prof. Dayton Spencer DDS', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(256, 'Mrs. Hertha Frami V', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(257, 'Ms. Adele Leannon Sr.', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(258, 'Jennyfer Kerluke', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(259, 'Ruben Jacobi', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(260, 'Ilene Huels', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(261, 'Terrell Hermann IV', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(262, 'Laverne Rolfson', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(263, 'Grace Gleichner II', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(264, 'Litzy Tillman', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(265, 'Brenna Dicki', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(266, 'Yvonne Heaney IV', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(267, 'Ola Reynolds', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(268, 'Zoe Reinger', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(269, 'Prof. Euna McClure', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(270, 'Eden Bartoletti', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(271, 'Juliet Daugherty', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(272, 'Tess Lubowitz', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(273, 'Chet Feeney', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(274, 'Thurman Stroman', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(275, 'Mr. Camren White', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(276, 'Amanda Walter', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(277, 'Vada Larkin', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(278, 'Mr. Juvenal Ruecker DVM', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(279, 'Claudine Schamberger', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(280, 'Miss Marjorie Wisozk IV', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(281, 'Aaliyah Runolfsson', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(282, 'Mr. Toby Waelchi', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(283, 'Audreanne Rowe', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(284, 'Enrique Durgan', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(285, 'Ambrose Swaniawski DVM', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(286, 'Maryse Morar Jr.', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(287, 'Ardith Powlowski MD', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(288, 'Dr. Wyatt Ortiz PhD', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(289, 'Mr. Jonas Braun', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(290, 'Spencer Nolan', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(291, 'Mr. Moises Tillman', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(292, 'Miss Magdalena Corkery I', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(293, 'Leonor Volkman', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(294, 'Austin Fahey', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(295, 'Genoveva Kerluke', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(296, 'Mr. Eddie Ziemann DDS', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(297, 'Rey D''Amore', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(298, 'Griffin Thiel', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(299, 'Mr. Austin Rogahn', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(300, 'Sophie Becker', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(301, 'Jamir Leffler', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(302, 'Dr. Mae Schoen IV', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(303, 'Dr. Filiberto Fritsch', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(304, 'Prof. Emmalee Wolff', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(305, 'Kailyn Reilly', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(306, 'Bobbie Hegmann', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(307, 'Mercedes Reichel', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(308, 'Andre Barton', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(309, 'Celestine Zboncak', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(310, 'Quinton Reynolds', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(311, 'Dessie Lindgren MD', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(312, 'Mr. Lloyd Cassin V', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(313, 'Billie Gorczany', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(314, 'Prof. Wilber Klocko', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(315, 'Fanny Purdy', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(316, 'Mr. Horacio Hettinger', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(317, 'Mrs. Joanie Leuschke', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(318, 'America Runte', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(319, 'Bertrand Collins', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(320, 'Cameron Kuphal', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(321, 'Gust Dicki', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(322, 'Brian Cormier DVM', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(323, 'Dr. Mekhi Haley', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(324, 'Bette Pfannerstill', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(325, 'Mr. Cesar Emmerich II', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(326, 'Xander Blick', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(327, 'Clementine Fahey', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(328, 'Beulah Kulas', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(329, 'Prof. Martin Walker', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(330, 'Kasey Senger MD', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(331, 'Millie Larson', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(332, 'Prof. Hollis Cole I', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(333, 'Mrs. Phoebe Ruecker Sr.', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(334, 'Ford Langosh', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(335, 'Eldon Labadie', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(336, 'Gideon Jacobi', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(337, 'Electa Pfeffer', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(338, 'Brenna Nienow DVM', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(339, 'Freeman Rohan III', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(340, 'Mr. Quincy Ruecker', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(341, 'Prof. Marie Lebsack III', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(342, 'Broderick Cruickshank', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(343, 'Edmond Koch', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(344, 'Andre Hane', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(345, 'Mr. Cornell Schneider MD', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(346, 'Francesca Walker DDS', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(347, 'Retha Hudson', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(348, 'Ms. Clotilde Moen', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(349, 'Alan Mueller', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(350, 'Ms. Asha Spencer PhD', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(351, 'Eddie Upton IV', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(352, 'Dillon Blanda', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(353, 'Bailee Kessler', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(354, 'Prof. Madison Simonis Jr.', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(355, 'Selina Daugherty PhD', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(356, 'Dr. Nikita Ferry MD', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(357, 'Jaycee Rodriguez', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(358, 'Prof. Dorothea Carter V', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(359, 'Henri Hills', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(360, 'Aglae Gusikowski', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(361, 'Tyrese Koss', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(362, 'Kelvin O''Reilly', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(363, 'Selmer Farrell', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(364, 'Marilyne Ratke', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(365, 'Ernie Beier', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(366, 'Miss Jannie Koepp', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(367, 'Mr. Godfrey Berge', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(368, 'Derick Bode', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(369, 'Miss Isabelle Rempel', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(370, 'Mr. Zechariah Howe', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(371, 'Prof. Antonia Boyle DVM', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(372, 'Ozella Sporer', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(373, 'Prof. Krista Spencer PhD', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(374, 'Aracely DuBuque', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(375, 'Marlin Cartwright', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(376, 'Retha Schmitt V', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(377, 'Yoshiko Terry', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(378, 'Earline Anderson', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(379, 'Chadrick Jacobson III', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(380, 'Dr. Gerald Trantow III', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(381, 'Breanna Monahan', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(382, 'Malika Bayer', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(383, 'Marvin Morar', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(384, 'Eliezer Mann', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(385, 'Marisa Waters', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(386, 'Laurie Senger', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(387, 'Quentin Quigley', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(388, 'Angelita Batz I', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(389, 'Dr. Jeramie Koepp', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(390, 'Samantha Hammes', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(391, 'Freida Rice', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(392, 'Dr. Raoul Schaden I', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(393, 'Stan Corwin', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(394, 'Hipolito Murphy Sr.', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(395, 'Chandler Renner', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(396, 'Shany Smitham', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(397, 'Sophie Roberts', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(398, 'Catherine Gusikowski Sr.', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(399, 'Bartholome Walsh', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(400, 'Ariel Leuschke', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(401, 'Viviane Wisozk DVM', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(402, 'Mr. Foster Hyatt V', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(403, 'Milo Streich', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(404, 'Prof. Karlee Jenkins II', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(405, 'Tre Toy', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(406, 'Donato Torp IV', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(407, 'Camryn Waelchi', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(408, 'Oral Jerde', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(409, 'Alysha Kirlin', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(410, 'Mr. Wilson Wisozk III', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(411, 'Antonio Stiedemann', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(412, 'Gabriel Wiegand', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(413, 'Brant Fay', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(414, 'Kenny Marvin', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(415, 'Teagan Schroeder', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(416, 'Domingo Cummings', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(417, 'Pedro Lemke DVM', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(418, 'Elian Stoltenberg', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(419, 'Dejon Schoen', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(420, 'Ms. Aglae Lehner', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(421, 'Prof. Jovan Zulauf I', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(422, 'Prof. Rosa Brown II', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(423, 'Violette McClure', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(424, 'Jordane Corwin', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(425, 'Miss Brionna Tromp IV', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(426, 'Prof. Giovanni Tremblay Jr.', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(427, 'Dr. Rey Okuneva', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(428, 'Kenya Schaden', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(429, 'Xavier Strosin', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(430, 'Mary Grant', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(431, 'Rick Turner', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(432, 'Arvel Koch', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(433, 'Ivy Walter', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(434, 'Roosevelt Prohaska', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(435, 'Miguel Schneider', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(436, 'Cristobal Langworth Jr.', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(437, 'Vaughn Olson', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(438, 'Deion Block V', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(439, 'Mrs. Mafalda Cartwright DVM', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(440, 'Mr. Everett Williamson III', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(441, 'Kenton Hermiston', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(442, 'Ms. Nella Schmidt', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(443, 'Katherine Reinger', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(444, 'Myrtice Konopelski', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(445, 'Berneice Hintz', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(446, 'Wilfrid Wuckert', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(447, 'Susie Graham', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(448, 'Prof. Gino McCullough DDS', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(449, 'Brycen Lang', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(450, 'Leonardo Hayes', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(451, 'Willy Farrell', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(452, 'Mckenzie Swift', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(453, 'Darlene Krajcik', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(454, 'Roxanne Bednar DVM', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(455, 'Jennings Torp', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(456, 'Alivia Paucek', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(457, 'Javonte Daniel IV', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(458, 'Jaycee Christiansen', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(459, 'Emmanuelle Kunze', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(460, 'Jacquelyn Torp', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(461, 'Reva Nikolaus', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(462, 'Jacky Gerlach', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(463, 'Morris Wilderman', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(464, 'Lawson Adams MD', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(465, 'Marisol Donnelly', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(466, 'Lorine Nader', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(467, 'Alba Pacocha', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(468, 'Prof. Virgie Langosh Jr.', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(469, 'Elinore Cassin III', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(470, 'Tony Schroeder', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(471, 'Alvis Marvin', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(472, 'Hans Wolff', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(473, 'Dr. Rosetta Murazik', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(474, 'Brannon Barton', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(475, 'Zelma Barton', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(476, 'Jaren White', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(477, 'Prof. Nikko Gaylord', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(478, 'Prof. Rigoberto King', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(479, 'Aiden Balistreri', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(480, 'Dr. Mikel Blick II', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(481, 'Antwan Borer III', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(482, 'Lexie Maggio PhD', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(483, 'Braxton Quigley', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(484, 'Dr. Dewitt Johnson IV', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(485, 'Dr. Edgardo Feil II', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(486, 'Dorris Waelchi', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(487, 'Prof. Kayla Jacobson', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(488, 'Jason Leuschke', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(489, 'Dr. Rosalyn Konopelski DVM', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(490, 'Alysson Fisher', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(491, 'Titus Kuhlman', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(492, 'Prof. Blake Trantow', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(493, 'Kali Mertz DVM', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(494, 'Reyna Schumm', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(495, 'Dr. Javier Kihn', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(496, 'Loma Sanford', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(497, 'Arvel Hegmann', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(498, 'Brown Bashirian PhD', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(499, 'Brady Swaniawski', 1, 'logo.png', 'ahly club', 1, NULL, NULL),
(500, 'Ashton Kunde', 1, 'logo.png', 'ahly club', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `team_types`
--

DROP TABLE IF EXISTS `team_types`;
CREATE TABLE IF NOT EXISTS `team_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=3 ;

--
-- Truncate table before insert `team_types`
--

TRUNCATE TABLE `team_types`;
--
-- Dumping data for table `team_types`
--

INSERT INTO `team_types` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'team', NULL, NULL),
(2, 'nation', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1 ;

--
-- Truncate table before insert `users`
--

TRUNCATE TABLE `users`;
-- --------------------------------------------------------

--
-- Table structure for table `weeks`
--

DROP TABLE IF EXISTS `weeks`;
CREATE TABLE IF NOT EXISTS `weeks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `number` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=100 ;

--
-- Truncate table before insert `weeks`
--

TRUNCATE TABLE `weeks`;
--
-- Dumping data for table `weeks`
--

INSERT INTO `weeks` (`id`, `number`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL),
(2, 2, NULL, NULL),
(3, 3, NULL, NULL),
(4, 4, NULL, NULL),
(5, 5, NULL, NULL),
(6, 6, NULL, NULL),
(7, 7, NULL, NULL),
(8, 8, NULL, NULL),
(9, 9, NULL, NULL),
(10, 10, NULL, NULL),
(11, 11, NULL, NULL),
(12, 12, NULL, NULL),
(13, 13, NULL, NULL),
(14, 14, NULL, NULL),
(15, 15, NULL, NULL),
(16, 16, NULL, NULL),
(17, 17, NULL, NULL),
(18, 18, NULL, NULL),
(19, 19, NULL, NULL),
(20, 20, NULL, NULL),
(21, 21, NULL, NULL),
(22, 22, NULL, NULL),
(23, 23, NULL, NULL),
(24, 24, NULL, NULL),
(25, 25, NULL, NULL),
(26, 26, NULL, NULL),
(27, 27, NULL, NULL),
(28, 28, NULL, NULL),
(29, 29, NULL, NULL),
(30, 30, NULL, NULL),
(31, 31, NULL, NULL),
(32, 32, NULL, NULL),
(33, 33, NULL, NULL),
(34, 34, NULL, NULL),
(35, 35, NULL, NULL),
(36, 36, NULL, NULL),
(37, 37, NULL, NULL),
(38, 38, NULL, NULL),
(39, 39, NULL, NULL),
(40, 40, NULL, NULL),
(41, 41, NULL, NULL),
(42, 42, NULL, NULL),
(43, 43, NULL, NULL),
(44, 44, NULL, NULL),
(45, 45, NULL, NULL),
(46, 46, NULL, NULL),
(47, 47, NULL, NULL),
(48, 48, NULL, NULL),
(49, 49, NULL, NULL),
(50, 50, NULL, NULL),
(51, 51, NULL, NULL),
(52, 52, NULL, NULL),
(53, 53, NULL, NULL),
(54, 54, NULL, NULL),
(55, 55, NULL, NULL),
(56, 56, NULL, NULL),
(57, 57, NULL, NULL),
(58, 58, NULL, NULL),
(59, 59, NULL, NULL),
(60, 60, NULL, NULL),
(61, 61, NULL, NULL),
(62, 62, NULL, NULL),
(63, 63, NULL, NULL),
(64, 64, NULL, NULL),
(65, 65, NULL, NULL),
(66, 66, NULL, NULL),
(67, 67, NULL, NULL),
(68, 68, NULL, NULL),
(69, 69, NULL, NULL),
(70, 70, NULL, NULL),
(71, 71, NULL, NULL),
(72, 72, NULL, NULL),
(73, 73, NULL, NULL),
(74, 74, NULL, NULL),
(75, 75, NULL, NULL),
(76, 76, NULL, NULL),
(77, 77, NULL, NULL),
(78, 78, NULL, NULL),
(79, 79, NULL, NULL),
(80, 80, NULL, NULL),
(81, 81, NULL, NULL),
(82, 82, NULL, NULL),
(83, 83, NULL, NULL),
(84, 84, NULL, NULL),
(85, 85, NULL, NULL),
(86, 86, NULL, NULL),
(87, 87, NULL, NULL),
(88, 88, NULL, NULL),
(89, 89, NULL, NULL),
(90, 90, NULL, NULL),
(91, 91, NULL, NULL),
(92, 92, NULL, NULL),
(93, 93, NULL, NULL),
(94, 94, NULL, NULL),
(95, 95, NULL, NULL),
(96, 96, NULL, NULL),
(97, 97, NULL, NULL),
(98, 98, NULL, NULL),
(99, 99, NULL, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
