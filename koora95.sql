-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 31, 2017 at 04:15 PM
-- Server version: 5.5.58-0ubuntu0.14.04.1
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
  `logo` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `competitions_name_unique` (`name`),
  KEY `competitions_location_id_location_type_index` (`location_id`,`location_type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `competitions`
--

INSERT INTO `competitions` (`id`, `name`, `comp_type_id`, `location_id`, `location_type`, `logo`, `created_at`, `updated_at`) VALUES
(1, 'Egyptian League', 1, 1, 'App\\Country', NULL, NULL, NULL),
(2, 'Premiere League', 1, 2, 'App\\Country', NULL, NULL, NULL),
(3, 'Egyptian Cup', 1, 1, 'App\\Country', NULL, NULL, NULL),
(4, 'La Liga', 1, 2, 'App\\Country', NULL, NULL, NULL),
(5, 'English Cup', 2, 2, 'App\\Country', NULL, NULL, NULL),
(6, 'الدورى المصرى', 1, 1, 'App\\Country', NULL, NULL, NULL),
(7, 'Friendly Match', 0, 0, '0', NULL, NULL, NULL);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `competition_types`
--

INSERT INTO `competition_types` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'league', NULL, NULL),
(2, 'cup', NULL, NULL),
(3, 'friendly competition', NULL, NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `continents`
--

INSERT INTO `continents` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Africa', NULL, NULL),
(2, 'Europe', NULL, NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `continent_id`, `created_at`, `updated_at`) VALUES
(1, 'Egypt', 1, NULL, NULL),
(2, 'England', 2, NULL, NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=23 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `stage_id`, `rounds_number`, `teams_number`, `created_at`, `updated_at`) VALUES
(1, 'A', 31, 18, 10, '2017-12-29 19:04:28', '2017-12-29 19:04:28'),
(2, 'B', 31, 18, 10, '2017-12-29 19:04:28', '2017-12-29 19:04:28'),
(3, 'A', 39, 6, 4, '2017-12-29 19:54:28', '2017-12-29 19:54:28'),
(4, 'B', 39, 6, 4, '2017-12-29 19:54:28', '2017-12-29 19:54:28'),
(5, 'A', 42, 9, 10, '2017-12-29 22:45:13', '2017-12-29 22:45:13'),
(6, 'B', 42, 9, 10, '2017-12-29 22:45:13', '2017-12-29 22:45:13'),
(13, 'A', 43, 9, 10, '2017-12-29 23:00:36', '2017-12-29 23:00:36'),
(14, 'B', 43, 9, 10, '2017-12-29 23:00:36', '2017-12-29 23:00:36'),
(15, 'A', 35, 6, 4, '2017-12-29 23:18:44', '2017-12-29 23:18:44'),
(16, 'B', 35, 6, 4, '2017-12-29 23:18:44', '2017-12-29 23:18:44'),
(17, 'C', 35, 6, 4, '2017-12-29 23:18:44', '2017-12-29 23:18:44'),
(18, 'D', 35, 6, 4, '2017-12-29 23:18:44', '2017-12-29 23:18:44'),
(19, 'E', 35, 6, 4, '2017-12-29 23:18:44', '2017-12-29 23:18:44'),
(20, 'F', 35, 6, 4, '2017-12-29 23:18:44', '2017-12-29 23:18:44'),
(21, 'G', 35, 6, 4, '2017-12-29 23:18:44', '2017-12-29 23:18:44'),
(22, 'H', 35, 6, 4, '2017-12-29 23:18:44', '2017-12-29 23:18:44');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=75 ;

--
-- Dumping data for table `group_rounds`
--

INSERT INTO `group_rounds` (`id`, `stage_id`, `round_number`, `created_at`, `updated_at`) VALUES
(1, 31, 1, NULL, NULL),
(2, 31, 2, NULL, NULL),
(3, 31, 3, NULL, NULL),
(4, 31, 4, NULL, NULL),
(5, 31, 5, NULL, NULL),
(6, 31, 6, NULL, NULL),
(7, 31, 7, NULL, NULL),
(8, 31, 8, NULL, NULL),
(9, 31, 9, NULL, NULL),
(10, 31, 10, NULL, NULL),
(11, 31, 11, NULL, NULL),
(12, 31, 12, NULL, NULL),
(13, 31, 13, NULL, NULL),
(14, 31, 14, NULL, NULL),
(15, 31, 15, NULL, NULL),
(16, 31, 16, NULL, NULL),
(17, 31, 17, NULL, NULL),
(18, 31, 18, NULL, NULL),
(19, 39, 1, NULL, NULL),
(20, 39, 2, NULL, NULL),
(21, 39, 3, NULL, NULL),
(22, 39, 4, NULL, NULL),
(23, 39, 5, NULL, NULL),
(24, 39, 6, NULL, NULL),
(25, 39, 7, NULL, NULL),
(26, 39, 8, NULL, NULL),
(27, 39, 9, NULL, NULL),
(28, 39, 10, NULL, NULL),
(29, 39, 11, NULL, NULL),
(30, 39, 12, NULL, NULL),
(31, 39, 13, NULL, NULL),
(32, 39, 14, NULL, NULL),
(33, 42, 1, NULL, NULL),
(34, 42, 2, NULL, NULL),
(35, 42, 3, NULL, NULL),
(36, 42, 4, NULL, NULL),
(37, 42, 5, NULL, NULL),
(38, 42, 6, NULL, NULL),
(39, 42, 7, NULL, NULL),
(40, 42, 8, NULL, NULL),
(41, 42, 9, NULL, NULL),
(42, 43, 1, NULL, NULL),
(43, 43, 2, NULL, NULL),
(44, 43, 3, NULL, NULL),
(45, 43, 4, NULL, NULL),
(46, 43, 5, NULL, NULL),
(47, 43, 6, NULL, NULL),
(48, 43, 7, NULL, NULL),
(49, 43, 8, NULL, NULL),
(50, 43, 9, NULL, NULL),
(51, 43, 1, NULL, NULL),
(52, 43, 2, NULL, NULL),
(53, 43, 3, NULL, NULL),
(54, 43, 4, NULL, NULL),
(55, 43, 5, NULL, NULL),
(56, 43, 6, NULL, NULL),
(57, 43, 7, NULL, NULL),
(58, 43, 8, NULL, NULL),
(59, 43, 9, NULL, NULL),
(60, 43, 1, NULL, NULL),
(61, 43, 2, NULL, NULL),
(62, 43, 3, NULL, NULL),
(63, 43, 4, NULL, NULL),
(64, 43, 5, NULL, NULL),
(65, 43, 6, NULL, NULL),
(66, 43, 7, NULL, NULL),
(67, 43, 8, NULL, NULL),
(68, 43, 9, NULL, NULL),
(69, 35, 1, NULL, NULL),
(70, 35, 2, NULL, NULL),
(71, 35, 3, NULL, NULL),
(72, 35, 4, NULL, NULL),
(73, 35, 5, NULL, NULL),
(74, 35, 6, NULL, NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `group_teams`
--

INSERT INTO `group_teams` (`id`, `group_id`, `register_team_id`, `played`, `wins`, `losses`, `draws`, `goals_for`, `goals_against`, `points`, `red_cards`, `yellow_cards`, `created_at`, `updated_at`) VALUES
(1, 3, 21, 1, 0, 1, 0, 0, 2, 0, 0, 0, NULL, NULL),
(2, 3, 25, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(3, 3, 29, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(4, 3, 26, 1, 1, 0, 0, 2, 0, 3, 0, 0, NULL, NULL),
(5, 4, 22, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(6, 4, 30, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(7, 4, 23, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(8, 4, 27, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL);

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
  `group_id` int(11) DEFAULT NULL,
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `matches`
--

INSERT INTO `matches` (`id`, `season_id`, `stage_id`, `group_round_id`, `group_id`, `status`, `register_team_1_id`, `register_team_2_id`, `date`, `time`, `stadium`, `team_1_goals`, `team_2_goals`, `winner_id`, `red_cards`, `yellow_cards`, `created_at`, `updated_at`) VALUES
(1, 0, 0, NULL, NULL, 'InProgressed', 5, 4, '2017-12-28', '00:59:00', 'Cairo Stadium', 1, 3, 0, 0, 0, NULL, NULL),
(2, 1, 1, NULL, NULL, 'Played', 14, 11, '2017-12-28', '15:00:00', 'Cairo Stadium', 1, 3, 0, 0, 0, NULL, NULL),
(3, 5, 39, 19, 3, 'Played', 26, 21, '2017-12-30', '14:00:00', 'Cairo Stadium', 2, 0, 26, 0, 0, NULL, NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=19 ;

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
(15, '2017_12_11_103150_create_stages_table', 1),
(16, '2017_12_11_134152_create_groups_table', 1),
(17, '2017_12_12_080446_create_group_teams_table', 1),
(18, '2017_12_14_090334_create_group_rounds_table', 1);

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
  `image` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `players`
--

INSERT INTO `players` (`id`, `name`, `position`, `team_id`, `country_id`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Abdullah Al-Said', 'CF', 2, 1, NULL, '2017-12-28 10:05:37', '2017-12-28 10:05:37');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1 ;

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
-- Dumping data for table `registered_teams`
--

INSERT INTO `registered_teams` (`id`, `season_id`, `team_id`, `played`, `wins`, `losses`, `draws`, `goals_for`, `goals_against`, `points`, `red_cards`, `yellow_cards`) VALUES
(4, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5, 0, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(6, 0, 3, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(7, 0, 4, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(8, 0, 5, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(9, 0, 6, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(10, 0, 7, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(11, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(12, 1, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(13, 1, 3, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(14, 1, 4, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(15, 1, 5, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(16, 1, 6, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(17, 1, 7, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(18, 1, 8, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(19, 1, 9, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(20, 1, 10, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(21, 5, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(22, 5, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(23, 5, 3, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(24, 5, 4, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(25, 5, 5, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(26, 5, 6, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(27, 5, 7, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(28, 5, 8, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(29, 5, 9, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(30, 5, 10, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `seasons`
--

DROP TABLE IF EXISTS `seasons`;
CREATE TABLE IF NOT EXISTS `seasons` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comp_id` int(11) NOT NULL,
  `teams_number` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `winner_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `seasons_name_comp_id_unique` (`name`,`comp_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `seasons`
--

INSERT INTO `seasons` (`id`, `name`, `comp_id`, `teams_number`, `active`, `winner_id`, `created_at`, `updated_at`) VALUES
(1, '2017', 1, 16, 1, NULL, NULL, NULL),
(2, '2018', 2, 20, 1, NULL, NULL, NULL),
(3, '2017', 3, 20, 1, NULL, NULL, NULL),
(4, '2018', 5, 30, 1, NULL, NULL, NULL),
(5, '2019', 6, 16, 1, NULL, NULL, NULL),
(6, '2020', 1, 20, 0, NULL, NULL, NULL),
(7, '2021', 1, 20, 0, NULL, NULL, NULL),
(8, '2019', 2, 20, 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `stages`
--

DROP TABLE IF EXISTS `stages`;
CREATE TABLE IF NOT EXISTS `stages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `season_id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=44 ;

--
-- Dumping data for table `stages`
--

INSERT INTO `stages` (`id`, `season_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 'week 1', NULL, NULL),
(2, 1, 'week 2', NULL, NULL),
(3, 1, 'week 3', NULL, NULL),
(4, 1, 'week 4', NULL, NULL),
(5, 1, 'week 5', NULL, NULL),
(6, 1, 'week 6', NULL, NULL),
(7, 1, 'week 7', NULL, NULL),
(8, 1, 'week 8', NULL, NULL),
(9, 1, 'week 9', NULL, NULL),
(10, 1, 'week 10', NULL, NULL),
(11, 1, 'week 11', NULL, NULL),
(12, 1, 'week 12', NULL, NULL),
(13, 1, 'week 13', NULL, NULL),
(14, 1, 'week 14', NULL, NULL),
(15, 1, 'week 15', NULL, NULL),
(16, 1, 'week 16', NULL, NULL),
(17, 1, 'week 17', NULL, NULL),
(18, 1, 'week 18', NULL, NULL),
(19, 1, 'week 19', NULL, NULL),
(20, 1, 'week 20', NULL, NULL),
(21, 1, 'week 21', NULL, NULL),
(22, 1, 'week 22', NULL, NULL),
(23, 1, 'week 23', NULL, NULL),
(24, 1, 'week 24', NULL, NULL),
(25, 1, 'week 25', NULL, NULL),
(26, 1, 'week 26', NULL, NULL),
(27, 1, 'week 27', NULL, NULL),
(28, 1, 'week 28', NULL, NULL),
(29, 1, 'week 29', NULL, NULL),
(30, 1, 'week 30', NULL, NULL),
(31, 2, 'group stage', NULL, NULL),
(32, 3, 'group stage', NULL, NULL),
(33, 4, 'first stage', NULL, NULL),
(34, 4, 'round of 64', NULL, NULL),
(35, 4, 'round of 32', NULL, NULL),
(36, 4, 'round of 16', NULL, NULL),
(37, 4, 'round of 8', NULL, NULL),
(38, 4, 'round of 4', NULL, NULL),
(39, 5, 'group stage', NULL, NULL),
(40, 5, 'next', NULL, NULL),
(41, 6, 'group stage', NULL, NULL),
(42, 7, 'group stage', NULL, NULL),
(43, 8, 'group stage', NULL, NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `name`, `type_id`, `logo`, `stadium`, `country_id`, `created_at`, `updated_at`) VALUES
(1, 'Al-Ismaili', 1, 'Al-Ismaili.png', 'Ismailia Stadium', 1, NULL, NULL),
(2, 'Al-Ahly', 1, 'Al-Ahly.png', 'Cairo Stadium', 1, NULL, NULL),
(3, 'Al-Zamalek', 1, 'Al-Zamalek.png', 'Cairo Stadium', 1, NULL, NULL),
(4, 'Al-Nasr', 1, 'Al-Nasr.png', 'Cairo Stadium', 1, NULL, NULL),
(5, 'Enpi', 1, 'Enpi.png', 'Cairo Stadium', 1, NULL, NULL),
(6, 'Petrojet', 1, 'Petrojet.png', 'Cairo Stadium', 1, NULL, NULL),
(7, 'Tanta', 1, 'Tanta.png', 'Tanta Stadium', 1, NULL, NULL),
(8, 'El-Gesh', 1, 'Tanta.png', 'Tanta Stadium', 1, NULL, NULL),
(9, 'Al-Mqawlon Al-Arab', 1, 'Tanta.png', 'El-Gabal Al-Akhdar', 1, NULL, NULL),
(10, 'Al-Rgaa', 1, 'Tanta.png', 'El-Gabal Al-Akhdar', 1, NULL, NULL);

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
-- Dumping data for table `team_types`
--

INSERT INTO `team_types` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Club', NULL, NULL),
(2, 'Nation', NULL, NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'abdo', 'abouzaid@mail.com', '$2y$10$Ez0DDUEty7rI/AjxgKJg8.ed52PcWfOMmIo2QxIcsD3/VgQNBUrCS', NULL, '2017-12-28 08:47:56', '2017-12-28 08:47:56');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
