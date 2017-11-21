-- phpMyAdmin SQL Dump
-- version 4.2.6deb1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1:3306
-- Erstellungszeit: 29. Jan 2015 um 13:48
-- Server Version: 5.5.41-0ubuntu0.14.10.1
-- PHP-Version: 5.5.12-2ubuntu4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `bib`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `sportnews_log`
--

CREATE TABLE IF NOT EXISTS `sportnews_log` (
`uid` int(11) NOT NULL,
  `severity` enum('error','warning','info') NOT NULL,
  `source` enum('frontend','backend','crawler','youtube-importer') NOT NULL,
  `detail` text NOT NULL,
  `item_type` varchar(45) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sportnews_log`
--
ALTER TABLE `sportnews_log`
 ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sportnews_log`
--
ALTER TABLE `sportnews_log`
MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
