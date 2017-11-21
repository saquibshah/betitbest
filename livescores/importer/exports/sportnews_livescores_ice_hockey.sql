-- phpMyAdmin SQL Dump
-- version 4.3.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2015 at 04:09 PM
-- Server version: 5.5.39-MariaDB-log
-- PHP Version: 5.4.37

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sportnews-stage`
--

-- --------------------------------------------------------

--
-- Table structure for table `sportnews_livescores_ice_hockey`
--

CREATE TABLE IF NOT EXISTS `sportnews_livescores_ice_hockey` (
  `matchid` int(8) NOT NULL,
  `leagueid` int(8) DEFAULT NULL,
  `categoryid` int(8) DEFAULT NULL,
  `country` text COLLATE latin1_german2_ci,
  `league` text COLLATE latin1_german2_ci,
  `matchdate` bigint(20) NOT NULL DEFAULT '0',
  `matchstatus` text COLLATE latin1_german2_ci,
  `hometeam` text COLLATE latin1_german2_ci,
  `awayteam` text COLLATE latin1_german2_ci,
  `uniqueTeamHome` text COLLATE latin1_german2_ci,
  `uniqueTeamAway` text COLLATE latin1_german2_ci,
  `scorehome` int(2) DEFAULT NULL,
  `scoreaway` int(2) DEFAULT NULL,
  `q1_scorehome` int(2) DEFAULT NULL,
  `q1_scoreaway` int(2) DEFAULT NULL,
  `q2_scorehome` int(2) DEFAULT NULL,
  `q2_scoreaway` int(2) DEFAULT NULL,
  `q3_scorehome` int(2) DEFAULT NULL,
  `q3_scoreaway` int(2) DEFAULT NULL,
  `ot_scorehome` int(2) DEFAULT NULL,
  `ot_scoreaway` int(2) DEFAULT NULL,
  `winner` text COLLATE latin1_german2_ci,
  `winnername` text COLLATE latin1_german2_ci,
  `lastteamscored` text COLLATE latin1_german2_ci,
  `createtime` text COLLATE latin1_german2_ci,
  `lastchangeby` text COLLATE latin1_german2_ci,
  `xmltime` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_german2_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sportnews_livescores_ice_hockey`
--
ALTER TABLE `sportnews_livescores_ice_hockey`
  ADD PRIMARY KEY (`matchid`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
