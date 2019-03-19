-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 19. Mrz 2019 um 20:25
-- Server-Version: 10.1.37-MariaDB
-- PHP-Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `emp-gen`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `authorities`
--

CREATE TABLE `authorities` (
  `0_ID` int(11) NOT NULL,
  `1_name` text NOT NULL,
  `2_icon` text NOT NULL,
  `3_description` text NOT NULL,
  `4_mod` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `authorities`
--

INSERT INTO `authorities` (`0_ID`, `1_name`, `2_icon`, `3_description`, `4_mod`) VALUES
(1, 'Democratic', 'democratic', '[[IC:democratic;authority_imgs]] Democratic elections[[LB]][[IC:time]] 10 year term[[LB]][[IC:agenda]] Rulers have agendas[[LB]][[IC:election]] Re-election', 0),
(2, 'Oligarchic', 'oligarchic', '[[IC:oligarchic;authority_imgs]] Oligarchic elections[[LB]][[IC:time]] 20 years term[[LB]][[IC:agenda]] Rulers have agendas[[LB]][[IC:election]] Emergency elections (at [[IC:influence]] [[#FF0000;250]] Influence)', 0),
(3, 'Dictatorial', 'dictatorial', '[[IC:oligarchic;authority_imgs]] Oligarchic elections[[LB]]\r\n[[IC:time]] Life term[[LB]]\r\n[[IC:agenda]] Rulers have agendas', 0),
(4, 'Imperial', 'imperial', '[[IC:imperial;authority_imgs]] Hereditary rule[[LB]]\r\n[[IC:time]] Life term[[LB]]\r\n[[IC:agenda]] Rulers have agendas[[LB]]\r\n[[IC:yes]] Has heirs', 0),
(5, 'Hive Mind', 'hive_mind', '[[IC:time]] Immortal ruler[[LB]]\r\n[[IC:no]] Factions[[LB]]\r\n[[IC:no]] Change authority[[LB]]\r\n[[IC:no]] Robots[[LB]]\r\n[[IC:growth_speed]] [[#008000;+25%]] Growth Speed[[LB]]\r\n[[IC:resettlement_cost]] [[#008000;-50%]] Resettlement cost[[LB]]\r\n[[IC:hive_mind;authority_imgs]] Hive Mind civics', 6),
(6, 'Machine Intelligence', 'machine_intelligence', '[[IC:time]] Immortal ruler[[LB]]\r\n[[IC:no]] Factions[[LB]]\r\n[[IC:no]] Change authority[[LB]]\r\n[[IC:machine_intelligence;authority_imgs]] Machine civics[[LB]]\r\n[[IC:mechanical;traits_imgs]] Species group must be Machine', 5),
(7, 'Corporate', 'corporate', '[[IC:oligarchic;authority_imgs]] Oligarchic elections[[LB]][[IC:time]] 20 year term[[LB]][[IC:agenda]] Rulers have agendas[[LB]][[IC:election]] Emergency elections (at [[IC:influence]] [[#FF0000;250]] Influence)[[LB]][[IC:administrative_cap]] [[#008000;+20]] Administrative Cap[[LB]][[IC:empire_size_penalty]] [[#FF0000;+50%]] Empire Size Penalty', 8);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `citystyle`
--

CREATE TABLE `citystyle` (
  `0_ID` int(11) NOT NULL,
  `1_type` text NOT NULL,
  `2_mod` int(11) NOT NULL,
  `3_linkpart` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `citystyle`
--

INSERT INTO `citystyle` (`0_ID`, `1_type`, `2_mod`, `3_linkpart`) VALUES
(1, 'Humanoid Style', 0, 'humanoid'),
(2, 'Plantoid  Style', 4, 'plantoid'),
(3, 'Mammalian Style', 0, 'mammalian'),
(4, 'Reptilian Style', 0, 'reptilian'),
(5, 'Avian Style', 0, 'avian'),
(6, 'Molluscoid Style', 0, 'molluscoid'),
(7, 'Fungoid Style', 0, 'fungoid'),
(8, 'Arthropoid Style', 0, 'arthropoid');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `ethics`
--

CREATE TABLE `ethics` (
  `0_ID` int(11) NOT NULL,
  `1_name` text NOT NULL,
  `2_icon` text NOT NULL,
  `3_locks` text NOT NULL,
  `4_mod` int(11) NOT NULL,
  `5_description` text NOT NULL,
  `6_cost` int(11) NOT NULL,
  `7_block_authorities` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `ethics`
--

INSERT INTO `ethics` (`0_ID`, `1_name`, `2_icon`, `3_locks`, `4_mod`, `5_description`, `6_cost`, `7_block_authorities`) VALUES
(1, 'Authoritarian', 'authoritarian', '2,3,4,17', 0, '[[#008000;+0,5]] [[IC:influence]] Monthly Influence[[LB]][[#008000;+5%]] [[IC:slavery_tolerance]] Slave Resource Produktion', 1, '1,5,6'),
(2, 'Fanatic Authoritarian', 'fanatic_authoritarian', '1,3,4,17', 0, '[[#008000;+1]] [[IC:influence]] Monthly Influence[[LB]]\r\n[[#008000;+10%]] [[IC:slavery_tolerance]] Slave Resource Produktion', 2, '1,2,5,6'),
(3, 'Egalitarian', 'egalitarian', '1,2,4,17', 0, '[[#008000;+25%]] [[IC:happiness]] Faction Influence Gain[[LB]][[#008000;-10%]] [[IC:consumer_goods]] Consumer Goode Cost', 1, '3,4,5,6'),
(4, 'Fanatic Egalitarian', 'fanatic_egalitarian', '1,2,3,17', 0, '[[#008000;+50%]] [[IC:happiness]] Faction Influence Gain[[LB]][[#008000;-20%]] [[IC:consumer_goods]] Consumer Goode Cost', 2, '2,3,4,5,6'),
(5, 'Xenophobe', 'xenophobe', '6,7,8,17', 0, '[[#008000;-20%]] [[IC:influence]] Starbase Influence Cost[[LB]][[#008000;-10%]] [[IC:influence]] Claim Influence Cost', 1, '5,6'),
(6, 'Fanatic Xenophobe', 'fanatic_xenophobe', '5,7,8,17', 0, '[[#008000;-40%]] [[IC:influence]] Starbase Influence Cost[[LB]][[#008000;-20%]] [[IC:influence]] Claim Influence Cost', 2, '5,6'),
(7, 'Xenophile', 'xenophile', '5,6,8,17', 0, '[[#008000;-25%]] [[IC:border_friction]] Border Friction[[LB]][[#008000;-25%]] [[IC:influence]] Diplomatic Influence Cost', 1, '5,6'),
(8, 'Fanatic Xenophile', 'fanatic_xenophile', '5,6,7,17', 0, '[[#008000;-50%]] [[IC:border_friction]] Border Friction[[LB]][[#008000;-50%]] [[IC:influence]] Diplomatic Influence Cost', 2, '5,6'),
(9, 'Militarist', 'militarist', '10,11,12,17', 0, '[[#008000;-10%]] [[IC:war_exhaustion]] War Exhaustion Gain[[LB]][[#008000;+10%]] [[IC:fire_rate]] Fire Rate', 1, '5,6'),
(10, 'Fanatic Militarist', 'fanatic_militarist', '9,11,12,17', 0, '[[#008000;-20%]] [[IC:war_exhaustion]] War Exhaustion Gain[[LB]][[#008000;+20%]] [[IC:fire_rate]] Fire Rate', 2, '5,6'),
(11, 'Pacifist', 'pacifist', '9,10,12,17', 0, '[[#008000;+5%]] [[IC:resource_output]] Pop Resource Produktion[[LB]][[#008000;+2]] [[IC:core_sector_systems]] Core Sector Systems', 1, '5,6'),
(12, 'Fanatic Pacifist', 'fanatic_pacifist', '9,10,11,17', 0, '[[#008000;+10%]] [[IC:resource_output]] Pop Resource Produktion[[LB]][[#008000;+4]] [[IC:core_sector_systems]] Core Sector Systems', 2, '5,6'),
(13, 'Materialist', 'materialist', '14,15,16,17', 0, '[[#008000;-10%]] [[IC:robot_upkeep]] Robot Upkeep[[LB]][[#008000;+5%]] [[IC:research_speed]] Research Speed', 1, '5,6'),
(14, 'Fanatic Materialist', 'fanatic_materialist', '13,15,16,17', 0, '[[#008000;-20%]] [[IC:robot_upkeep]] Robot Upkeep[[LB]][[#008000;+10%]] [[IC:research_speed]] Research Speed', 2, '5,6'),
(15, 'Spiritualist', 'spiritualist', '13,14,16,17', 0, '[[#008000;+10%]] [[IC:unity]] Monthly Unity[[LB]][[#008000;-5%]] [[IC:edict_cost]] Edict Cost', 1, '5,6'),
(16, 'Fanatic Spiritualist', 'fanatic_spiritualist', '13,14,15,17', 0, '[[#008000;+20%]] [[IC:unity]] Monthly Unity[[LB]][[#008000;-10%]] [[IC:edict_cost]] Edict Cost', 2, '5,6'),
(17, 'Gestalt Consciousness', 'gestalt_consciousness', '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16', 5, '[[#008000;-20%]] [[IC:war_exhaustion]] War Exhaustion Gain[[LB]][[#008000;-33%]] [[IC:piracy_risk]] Piracy Risk[[LB]][[#008000;+1]] [[IC:influence]] Monthly Influence[[LB]][[#008000;+2]] [[IC:core_sector_systems]] Core Sector Systems', 3, '1,2,3,4');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `mods`
--

CREATE TABLE `mods` (
  `0_ID` int(11) NOT NULL,
  `1_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `mods`
--

INSERT INTO `mods` (`0_ID`, `1_name`) VALUES
(0, 'Vanilla'),
(1, 'Nova/Galaxy Edition'),
(2, 'Leviathans Story Pack DLC'),
(3, 'Humanoid Species Pack DLC'),
(4, 'Plantoids Species Pack DLC'),
(5, 'Synthetic Dawn DLC'),
(6, 'Utopia DLC'),
(7, 'Apocalypse DLC'),
(8, 'MegaCorp DLC');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `namelists`
--

CREATE TABLE `namelists` (
  `0_ID` int(11) NOT NULL,
  `1_name` text NOT NULL,
  `2_mod` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `namelists`
--

INSERT INTO `namelists` (`0_ID`, `1_name`, `2_mod`) VALUES
(1, 'Arthropoid 1', 0),
(2, 'Arthropoid 2', 0),
(3, 'Arthropoid 3', 0),
(4, 'Arthropoid 4', 0),
(5, 'Avian 1', 0),
(6, 'Avian 2', 0),
(7, 'Avian 3', 0),
(8, 'Avian 4', 0),
(9, 'Fungoid 1', 0),
(10, 'Fungoid 2', 0),
(11, 'Fungoid 3', 0),
(12, 'Fungoid 4', 0),
(13, 'Hive Mind', 0),
(14, 'Mammalian 5', 0),
(15, 'Humanoid 2', 0),
(16, 'Humanoid 3', 0),
(17, 'Humanoid 4', 0),
(18, 'Human (UNE)', 0),
(19, 'Human (CM)', 0),
(20, 'Human (SPQR)', 0),
(21, 'Maschine 1', 0),
(22, 'Maschine 2', 0),
(23, 'Maschine 3', 0),
(24, 'Maschine 4', 0),
(25, 'Mammalian 1', 0),
(26, 'Mammalian 2', 0),
(27, 'Mammalian 3', 0),
(28, 'Mammalian 4', 0),
(29, 'Molluscoid 1', 0),
(30, 'Molluscoid 2', 0),
(31, 'Molluscoid 3', 0),
(32, 'Molluscoid 4', 0),
(33, 'Plantoid 1', 4),
(34, 'Plantoid 2', 4),
(35, 'Plantoid 3', 4),
(36, 'Plantoid 4', 4),
(37, 'Reptile 1', 0),
(38, 'Reptile 2', 0),
(39, 'Reptile 3', 0),
(40, 'Reptile 4', 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `phenotypes`
--

CREATE TABLE `phenotypes` (
  `0_ID` int(11) NOT NULL,
  `1_category` int(11) NOT NULL,
  `2_image_link` text NOT NULL,
  `3_mod` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `phenotypes`
--

INSERT INTO `phenotypes` (`0_ID`, `1_category`, `2_image_link`, `3_mod`) VALUES
(1, 0, 'humanoid_01', 0),
(2, 0, 'humanoid_02', 0),
(3, 0, 'humanoid_03', 0),
(4, 0, 'humanoid_04', 0),
(5, 0, 'humanoid_05', 0),
(6, 0, 'humanoid_06', 3),
(7, 0, 'humanoid_07', 3),
(8, 0, 'humanoid_08', 3),
(9, 0, 'humanoid_09', 3),
(10, 0, 'humanoid_10', 3),
(11, 0, 'humanoid_11', 3),
(12, 0, 'humanoid_12', 3),
(13, 0, 'humanoid_13', 3),
(14, 0, 'humanoid_14', 3),
(15, 0, 'humanoid_15', 3),
(16, 1, 'machine_01', 5),
(17, 1, 'machine_02', 5),
(18, 1, 'machine_03', 5),
(19, 1, 'machine_04', 5),
(20, 1, 'machine_05', 5),
(21, 1, 'machine_06', 5),
(22, 1, 'machine_07', 5),
(23, 1, 'machine_08', 5),
(24, 1, 'machine_09', 5),
(25, 2, 'mammal_01', 0),
(26, 2, 'mammal_02', 0),
(27, 2, 'mammal_03', 0),
(28, 2, 'mammal_04', 0),
(29, 2, 'mammal_05', 0),
(30, 2, 'mammal_06', 0),
(31, 2, 'mammal_07', 0),
(32, 2, 'mammal_08', 0),
(33, 2, 'mammal_09', 0),
(34, 2, 'mammal_10', 0),
(35, 2, 'mammal_11', 0),
(36, 2, 'mammal_12', 0),
(37, 2, 'mammal_13', 0),
(38, 2, 'mammal_14', 0),
(39, 2, 'mammal_15', 0),
(40, 2, 'mammal_16', 0),
(41, 2, 'mammal_17', 0),
(42, 2, 'mammal_18', 0),
(43, 3, 'reptile_01', 0),
(44, 3, 'reptile_02', 0),
(45, 3, 'reptile_03', 0),
(46, 3, 'reptile_04', 0),
(47, 3, 'reptile_05', 0),
(48, 3, 'reptile_06', 0),
(49, 3, 'reptile_07', 0),
(50, 3, 'reptile_08', 0),
(51, 3, 'reptile_09', 0),
(52, 3, 'reptile_10', 0),
(53, 3, 'reptile_11', 0),
(54, 3, 'reptile_12', 0),
(55, 3, 'reptile_13', 0),
(56, 3, 'reptile_14', 0),
(57, 3, 'reptile_15', 0),
(58, 3, 'reptile_16', 2),
(59, 3, 'reptile_17', 0),
(60, 4, 'avian_01', 0),
(61, 4, 'avian_02', 0),
(62, 4, 'avian_03', 0),
(63, 4, 'avian_04', 0),
(64, 4, 'avian_05', 0),
(65, 4, 'avian_06', 0),
(66, 4, 'avian_07', 0),
(67, 4, 'avian_08', 0),
(68, 4, 'avian_09', 0),
(69, 4, 'avian_10', 0),
(70, 4, 'avian_11', 0),
(71, 4, 'avian_12', 0),
(72, 4, 'avian_13', 0),
(73, 4, 'avian_14', 0),
(74, 4, 'avian_15', 0),
(75, 4, 'avian_16', 0),
(76, 4, 'avian_17', 0),
(77, 4, 'avian_18', 0),
(78, 5, 'arthropoid_01', 0),
(79, 5, 'arthropoid_02', 0),
(80, 5, 'arthropoid_03', 0),
(81, 5, 'arthropoid_04', 0),
(82, 5, 'arthropoid_05', 0),
(83, 5, 'arthropoid_06', 0),
(84, 5, 'arthropoid_07', 0),
(85, 5, 'arthropoid_08', 0),
(86, 5, 'arthropoid_09', 0),
(87, 5, 'arthropoid_10', 0),
(88, 5, 'arthropoid_11', 0),
(89, 5, 'arthropoid_12', 0),
(90, 5, 'arthropoid_13', 0),
(91, 5, 'arthropoid_14', 0),
(92, 5, 'arthropoid_15', 2),
(93, 5, 'arthropoid_16', 1),
(94, 5, 'arthropoid_17', 0),
(95, 5, 'arthropoid_18', 0),
(96, 6, 'molluscoid_01', 0),
(97, 6, 'molluscoid_02', 0),
(98, 6, 'molluscoid_03', 0),
(99, 6, 'molluscoid_04', 0),
(100, 6, 'molluscoid_05', 0),
(101, 6, 'molluscoid_06', 0),
(102, 6, 'molluscoid_07', 0),
(103, 6, 'molluscoid_08', 0),
(104, 6, 'molluscoid_09', 0),
(105, 6, 'molluscoid_10', 0),
(106, 6, 'molluscoid_11', 0),
(107, 6, 'molluscoid_12', 0),
(108, 6, 'molluscoid_13', 0),
(109, 6, 'molluscoid_14', 0),
(110, 6, 'molluscoid_15', 2),
(111, 6, 'molluscoid_16', 2),
(112, 7, 'fungoid_01', 0),
(113, 7, 'fungoid_02', 0),
(114, 7, 'fungoid_03', 0),
(115, 7, 'fungoid_04', 0),
(116, 7, 'fungoid_05', 0),
(117, 7, 'fungoid_06', 0),
(118, 7, 'fungoid_07', 0),
(119, 7, 'fungoid_08', 0),
(120, 7, 'fungoid_09', 0),
(121, 7, 'fungoid_10', 0),
(122, 7, 'fungoid_11', 0),
(123, 7, 'fungoid_12', 0),
(124, 7, 'fungoid_13', 0),
(125, 7, 'fungoid_14', 0),
(126, 7, 'fungoid_15', 0),
(127, 7, 'fungoid_16', 2),
(128, 8, 'plantoid_01', 4),
(129, 8, 'plantoid_02', 4),
(130, 8, 'plantoid_03', 4),
(131, 8, 'plantoid_04', 4),
(132, 8, 'plantoid_05', 4),
(133, 8, 'plantoid_06', 4),
(134, 8, 'plantoid_07', 4),
(135, 8, 'plantoid_08', 4),
(136, 8, 'plantoid_09', 4),
(137, 8, 'plantoid_10', 4),
(138, 8, 'plantoid_11', 4),
(139, 8, 'plantoid_12', 4),
(140, 8, 'plantoid_13', 4),
(141, 8, 'plantoid_14', 4),
(142, 8, 'plantoid_15', 4);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `phenotype_categories`
--

CREATE TABLE `phenotype_categories` (
  `0_ID` int(11) NOT NULL,
  `1_categoryname` text NOT NULL,
  `2_mod` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `phenotype_categories`
--

INSERT INTO `phenotype_categories` (`0_ID`, `1_categoryname`, `2_mod`) VALUES
(0, 'Humanoid', 0),
(1, 'Machine', 5),
(2, 'Mammal', 0),
(3, 'Reptile', 0),
(4, 'Avian', 0),
(5, 'Arthropoid', 0),
(6, 'Molluscoid', 0),
(7, 'Fungoid', 0),
(8, 'Plantoid', 4);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `planets`
--

CREATE TABLE `planets` (
  `0_ID` int(11) NOT NULL,
  `1_type` text NOT NULL,
  `2_mod` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `planets`
--

INSERT INTO `planets` (`0_ID`, `1_type`, `2_mod`) VALUES
(1, 'Arid', 0),
(2, 'Desert', 0),
(3, 'Savanna', 0),
(4, 'Alpine', 0),
(5, 'Arctic', 0),
(6, 'Tundra', 0),
(7, 'Continental', 0),
(8, 'Ocean', 0),
(9, 'Tropical', 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `ships`
--

CREATE TABLE `ships` (
  `0_ID` int(11) NOT NULL,
  `1_name` text NOT NULL,
  `2_mod` int(11) NOT NULL,
  `3_file` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `ships`
--

INSERT INTO `ships` (`0_ID`, `1_name`, `2_mod`, `3_file`) VALUES
(1, 'Arthropoid Ships', 0, 'arthropoid'),
(2, 'Avian Ships', 0, 'avian'),
(3, 'Fungoid Ships', 0, 'fungoid'),
(4, 'Humanoid Ships', 0, 'humanoid'),
(5, 'Mammalian Ships', 0, 'mammalian'),
(6, 'Molluscoid Ships', 0, 'molluscoid'),
(7, 'Plantoid Ships', 4, 'plantoid'),
(8, 'Reptilian Ships', 0, 'reptilian');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `traits`
--

CREATE TABLE `traits` (
  `0_ID` int(11) NOT NULL,
  `1_name` text NOT NULL,
  `2_cost` int(11) NOT NULL,
  `3_exclude` text NOT NULL,
  `4_effect` text NOT NULL,
  `5_mod` int(11) NOT NULL,
  `6_icon` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `traits`
--

INSERT INTO `traits` (`0_ID`, `1_name`, `2_cost`, `3_exclude`, `4_effect`, `5_mod`, `6_icon`) VALUES
(1, 'Adaptive', 2, '2,25', '[[#008000;+10%]] [[IC:habitability]] Habitability', 0, 'adaptive'),
(2, 'Extremely Adaptive', 4, '1,25', '[[#008000;+20%]] [[IC:habitability]] Habitability', 0, 'extremely_adaptive'),
(3, 'Agrarian', 2, '', '[[#008000;+15%]] [[IC:food]] Food', 0, 'agrarian'),
(4, 'Charismatic', 1, '26', '[[#008000;+25%]] [[IC:opinion]] Opinion if your ruler is Charismatic[[LB]][[#008000;+5%]] [[IC:happiness]] Other species owner happiness', 0, 'charismatic'),
(5, 'Communal', 1, '33', '[[#008000;+5%]] [[IC:happiness]] Happiness', 0, 'communal'),
(6, 'Conformist', 2, '27', '[[#008000;+30%]] [[IC:ethics_attraction]] Governing Ethics Attraction', 0, 'conformists'),
(7, 'Enduring', 1, '8,28', '[[#008000;+20]] [[IC:leader_age]] Years Leader Lifespan', 0, 'enduring'),
(8, 'Venerable', 4, '7,28', '[[#008000;+80%]] [[IC:leader_age]] Years Leader Lifespan', 0, 'venerable'),
(9, 'Conservationist', 1, '34', '[[#008000;-15%]] [[IC:consumer_goods]] Consumer Goods Cost', 0, 'conservationist'),
(10, 'Industrious', 2, '', '[[#008000;+15%]] [[IC:minerals]] Minerals', 0, 'industrious'),
(11, 'Intelligent', 2, '', '[[#008000;+10%]] [[IC:research_all]] Research Output', 0, 'intelligent'),
(12, 'Natural Engineers', 1, '13,14', '[[#008000;+15%]] [[IC:research_engineering]] Engineering Output', 0, 'natural_engineers'),
(13, 'Natural Physicists', 1, '12,14', '[[#008000;+15%]] [[IC:research_physics]] Physics Output', 0, 'natural_physicists'),
(14, 'Natural Sociologists', 1, '12,13', '[[#008000;+15%]] [[IC:research_society]] Society Output', 0, 'natural_sociologists'),
(15, 'Nomadic', 1, '30', '[[#008000;+50%]] [[IC:migration_time]] Migration Speed[[LB]][[#008000;-25%]] [[IC:resettlement_cost]] Resettlement Cost', 0, 'nomadic'),
(16, 'Quick Learners', 1, '32', '[[#008000;+25%]] [[IC:leader_experience_gain]] Leader Experience Gain', 0, 'quick_learners'),
(17, 'Rapid Breeders', 1, '31', '[[#008000;+20%]] [[IC:growth_speed]] Growth Speed', 0, 'rapid_breeders'),
(18, 'Resilient', 1, '', '[[#008000;+50%]] [[IC:army_damage]] Defense Army Damage', 0, 'resilient'),
(19, 'Strong', 1, '20,35', '[[#008000;+20%]] [[IC:army_damage]] Army Damage[[LB]][[#008000;+5%]] [[IC:minerals]] Minerals', 0, 'strong'),
(20, 'Very Strong', 3, '19,35', '[[#008000;+40%]] [[IC:army_damage]] Army Damage[[LB]][[#008000;+10%]] [[IC:minerals]] Minerals', 0, 'very_strong'),
(21, 'Talented', 1, '', '[[#008000;+1]] [[IC:leader_skill_level]] Leader Level Cap', 0, 'talented'),
(22, 'Thrifty', 2, '', '[[#008000;+15%]] [[IC:energy]] Energy Credits', 0, 'thrifty'),
(23, 'Traditional', 1, '29', '[[#008000;+10%]] [[IC:unity]] Unity Output', 0, 'traditional'),
(24, 'Decadent', -1, '', '[[#FF0000;-10%]] [[IC:happiness]] Happiness without Slaves', 0, 'decadent'),
(25, 'Nonadaptive', -2, '1,2', '[[#FF0000;-10%]] [[IC:habitability]] Habitability', 0, 'nonadaptive'),
(26, 'Repugnant', -1, '4', '[[#FF0000;-25]] [[IC:opinion]] Opinion if your Ruler is Repugnant and theirs is not[[LB]][[#FF0000;-10]] [[IC:opinion]] Opinion if both Rulers are Repugnant[[LB]]\r\n[[#FF0000;-5%]] [[IC:happiness]] Other species owner happiness', 0, 'repugnant'),
(27, 'Deviants', -1, '6', '[[#FF0000;-15%]] [[IC:ethics_attraction]] Governing Ethics Attraction', 0, 'deviants'),
(28, 'Fleeting', -1, '7,8', '[[#FF0000;-10]] [[IC:leader_age]] Years Leader Lifespan', 0, 'fleeting'),
(29, 'Quarrelsome', -1, '23', '[[#FF0000;-10%]] [[IC:unity]] Unity Output', 0, 'quarrelsome'),
(30, 'Sedentary', -1, '15', '[[#FF0000;-50%]] [[IC:migration_time]] Migration Speed[[LB]]\r\n[[#FF0000;+25%]] [[IC:resettlement_cost]] Resettlement Cost', 0, 'sedentary'),
(31, 'Slow Breeders', -1, '17', '[[#FF0000;-20%]] [[IC:growth_speed]] Growth Speed', 0, 'slow_breeders'),
(32, 'Slow Learners', -1, '16', '[[#FF0000;-25%]] [[IC:leader_experience_gain]] Leader Experience Gain', 0, 'slow_learners'),
(33, 'Solitary', -1, '5', '[[#FF0000;-5%]] [[IC:happiness]] Happiness', 0, 'solitary'),
(34, 'Wasteful', -1, '9', '[[#FF0000;-15%]] [[IC:consumer_goods]] Consumer Goods Cost', 0, 'wasteful'),
(35, 'Weak', -1, '19,20', '[[#FF0000;-20%]] [[IC:army_damage]] Army Damage[[LB]][[#FF0000;-5%]] [[IC:minerals]] Minerals', 0, 'weak');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `0_ID` int(11) NOT NULL,
  `1_username` text NOT NULL,
  `2_password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`0_ID`, `1_username`, `2_password`) VALUES
(1, '3dwa21', '$2y$10$VokH/Zs0pYc4sm/Ca.ZpLeqrEcYMKq7X8kvQeZlZPWUbbYos1LKFO'),
(2, 'test', '$2y$10$xXpkoN2k35oX2nVLYGKrDuQQnGKiU0X39BWG.tYeu/fuynaopEH.W'),
(3, 'Guest', '$2y$10$XohfGY371gBAAzNHPkx9yu2aTZki9LCdVRkQG.WPGNv8oYwRLomhS'),
(4, 'Guest', '$2y$10$zcDVfOiFbWaRR7Z2JrBL5em3I54BOGkkXX2GU2V3oimGhNfEk8GzO');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `usersettings`
--

CREATE TABLE `usersettings` (
  `0_userid` int(11) NOT NULL,
  `1_active_mods` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `usersettings`
--

INSERT INTO `usersettings` (`0_userid`, `1_active_mods`) VALUES
(0, '0'),
(1, '0,1,2,3,4,5,6,7,8'),
(2, '0'),
(4, '0');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `authorities`
--
ALTER TABLE `authorities`
  ADD PRIMARY KEY (`0_ID`);

--
-- Indizes für die Tabelle `citystyle`
--
ALTER TABLE `citystyle`
  ADD PRIMARY KEY (`0_ID`);

--
-- Indizes für die Tabelle `ethics`
--
ALTER TABLE `ethics`
  ADD PRIMARY KEY (`0_ID`);

--
-- Indizes für die Tabelle `mods`
--
ALTER TABLE `mods`
  ADD PRIMARY KEY (`0_ID`);

--
-- Indizes für die Tabelle `namelists`
--
ALTER TABLE `namelists`
  ADD PRIMARY KEY (`0_ID`);

--
-- Indizes für die Tabelle `phenotypes`
--
ALTER TABLE `phenotypes`
  ADD PRIMARY KEY (`0_ID`);

--
-- Indizes für die Tabelle `phenotype_categories`
--
ALTER TABLE `phenotype_categories`
  ADD PRIMARY KEY (`0_ID`);

--
-- Indizes für die Tabelle `planets`
--
ALTER TABLE `planets`
  ADD PRIMARY KEY (`0_ID`);

--
-- Indizes für die Tabelle `ships`
--
ALTER TABLE `ships`
  ADD PRIMARY KEY (`0_ID`);

--
-- Indizes für die Tabelle `traits`
--
ALTER TABLE `traits`
  ADD PRIMARY KEY (`0_ID`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`0_ID`);

--
-- Indizes für die Tabelle `usersettings`
--
ALTER TABLE `usersettings`
  ADD PRIMARY KEY (`0_userid`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `authorities`
--
ALTER TABLE `authorities`
  MODIFY `0_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT für Tabelle `citystyle`
--
ALTER TABLE `citystyle`
  MODIFY `0_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT für Tabelle `ethics`
--
ALTER TABLE `ethics`
  MODIFY `0_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT für Tabelle `mods`
--
ALTER TABLE `mods`
  MODIFY `0_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT für Tabelle `namelists`
--
ALTER TABLE `namelists`
  MODIFY `0_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT für Tabelle `phenotypes`
--
ALTER TABLE `phenotypes`
  MODIFY `0_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143;

--
-- AUTO_INCREMENT für Tabelle `phenotype_categories`
--
ALTER TABLE `phenotype_categories`
  MODIFY `0_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT für Tabelle `planets`
--
ALTER TABLE `planets`
  MODIFY `0_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT für Tabelle `ships`
--
ALTER TABLE `ships`
  MODIFY `0_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT für Tabelle `traits`
--
ALTER TABLE `traits`
  MODIFY `0_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `0_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
