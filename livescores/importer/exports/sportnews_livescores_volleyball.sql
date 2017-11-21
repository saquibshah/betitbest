-- phpMyAdmin SQL Dump
-- version 4.3.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2015 at 05:00 PM
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
-- Table structure for table `sportnews_livescores_volleyball`
--

CREATE TABLE IF NOT EXISTS `sportnews_livescores_volleyball` (
  `matchid` int(8) NOT NULL,
  `leagueid` int(8) DEFAULT NULL,
  `categoryid` int(8) DEFAULT NULL,
  `country` text COLLATE latin1_german2_ci,
  `league` text COLLATE latin1_german2_ci,
  `tournament` text COLLATE latin1_german2_ci,
  `matchdate` text COLLATE latin1_german2_ci,
  `matchstatus` text COLLATE latin1_german2_ci,
  `hometeam` text COLLATE latin1_german2_ci,
  `homecountrylogo` text COLLATE latin1_german2_ci,
  `homecountry` text COLLATE latin1_german2_ci,
  `awayteam` text COLLATE latin1_german2_ci,
  `awaycountrylogo` text COLLATE latin1_german2_ci,
  `awaycountry` text COLLATE latin1_german2_ci,
  `lastperioddate` text COLLATE latin1_german2_ci,
  `scorehome` text COLLATE latin1_german2_ci,
  `scoreaway` text COLLATE latin1_german2_ci,
  `p1_scorehome` int(2) DEFAULT NULL,
  `p1_scoreaway` int(2) DEFAULT NULL,
  `p2_scorehome` int(2) DEFAULT NULL,
  `p2_scoreaway` int(2) DEFAULT NULL,
  `p3_scorehome` int(2) DEFAULT NULL,
  `p3_scoreaway` int(2) DEFAULT NULL,
  `p4_scorehome` int(2) DEFAULT NULL,
  `p4_scoreaway` int(2) DEFAULT NULL,
  `p5_scorehome` int(2) DEFAULT NULL,
  `p5_scoreaway` int(2) DEFAULT NULL,
  `pointhome` text COLLATE latin1_german2_ci,
  `pointaway` text COLLATE latin1_german2_ci,
  `winner` text COLLATE latin1_german2_ci,
  `winnername` text COLLATE latin1_german2_ci,
  `lastgoaltime` text COLLATE latin1_german2_ci,
  `uniqueTeamHome` text COLLATE latin1_german2_ci,
  `uniqueTeamAway` text COLLATE latin1_german2_ci,
  `lastgoalteam` text COLLATE latin1_german2_ci,
  `servingplayer` text COLLATE latin1_german2_ci,
  `scoremin` text COLLATE latin1_german2_ci,
  `scoredby` text COLLATE latin1_german2_ci,
  `createtime` text COLLATE latin1_german2_ci,
  `lastchangeby` text COLLATE latin1_german2_ci,
  `xmltime` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_german2_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sportnews_livescores_volleyball`
--
ALTER TABLE `sportnews_livescores_volleyball`
  ADD PRIMARY KEY (`matchid`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
