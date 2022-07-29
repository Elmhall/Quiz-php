-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Värd: 127.0.0.1:3306
-- Tid vid skapande: 29 jul 2022 kl 12:17
-- Serverversion: 5.7.31
-- PHP-version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databas: `quiz`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `question`
--

DROP TABLE IF EXISTS `question`;
CREATE TABLE IF NOT EXISTS `question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quiz_name` varchar(64) NOT NULL,
  `title` text NOT NULL,
  `correct_answere_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`quiz_name`),
  KEY `quiz_name` (`quiz_name`),
  KEY `correct_answere_id` (`correct_answere_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `question`
--

INSERT INTO `question` (`id`, `quiz_name`, `title`, `correct_answere_id`) VALUES
(1, '1', 'What is the rarest M&M color?', 1),
(2, '1', 'Which country consumes the most chocolate per capita?', 4),
(3, '1', 'What was the first soft drink in space?', 9),
(4, '1', 'What is the most consumed manufactured drink in the world?', 11);

-- --------------------------------------------------------

--
-- Tabellstruktur `question_answere`
--

DROP TABLE IF EXISTS `question_answere`;
CREATE TABLE IF NOT EXISTS `question_answere` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question_id` int(11) NOT NULL,
  `title` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `question_answere`
--

INSERT INTO `question_answere` (`id`, `question_id`, `title`) VALUES
(1, 1, 'Brown'),
(2, 1, 'Green'),
(3, 1, 'Blue'),
(4, 2, 'Switzerland'),
(5, 2, 'Sweden'),
(6, 2, 'Finland'),
(7, 3, 'Sprite'),
(8, 3, 'Fanta'),
(9, 3, 'Coca Cola'),
(10, 4, 'Coffe'),
(11, 4, 'Tea'),
(12, 4, 'Coca Cola');

-- --------------------------------------------------------

--
-- Tabellstruktur `quiz`
--

DROP TABLE IF EXISTS `quiz`;
CREATE TABLE IF NOT EXISTS `quiz` (
  `name` varchar(64) NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `quiz`
--

INSERT INTO `quiz` (`name`) VALUES
('1');

-- --------------------------------------------------------

--
-- Tabellstruktur `result`
--

DROP TABLE IF EXISTS `result`;
CREATE TABLE IF NOT EXISTS `result` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quiz` int(11) NOT NULL,
  `user_name` varchar(32) NOT NULL,
  `user_email` varchar(64) NOT NULL,
  `score` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `result`
--

INSERT INTO `result` (`id`, `quiz`, `user_name`, `user_email`, `score`) VALUES
(2, 1, 'Christian Elmhall', 'christian@elmhall.dev', 3);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
