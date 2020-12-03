-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: classmysql.engr.oregonstate.edu:3306
-- Generation Time: May 13, 2019 at 01:28 PM
-- Server version: 10.3.13-MariaDB-log
-- PHP Version: 7.0.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cs340_hartwelg`
--

-- --------------------------------------------------------

--
-- Table structure for table `BasketballGame`
--

CREATE TABLE IF NOT EXISTS `BasketballGame` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `FinalScoreOfWinningTeam` int(60) NOT NULL DEFAULT 0,
  `FinalScoreOfLosingTeam` int(60) NOT NULL DEFAULT 0,
  `Location` varchar(60) NOT NULL,
  `GameId` int(60) NOT NULL,
  `Team1Id` int(11) NOT NULL,
  `Team2Id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `Team1Id` (`Team1Id`),
  KEY `Team2Id` (`Team2Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `BasketballGame`
--
ALTER TABLE `BasketballGame`
  ADD CONSTRAINT `BasketballGame_ibfk_1` FOREIGN KEY (`Team1Id`) REFERENCES `BasketballTeams` (`id`),
  ADD CONSTRAINT `BasketballGame_ibfk_2` FOREIGN KEY (`Team2Id`) REFERENCES `BasketballTeams` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: classmysql.engr.oregonstate.edu:3306
-- Generation Time: May 13, 2019 at 01:29 PM
-- Server version: 10.3.13-MariaDB-log
-- PHP Version: 7.0.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cs340_hartwelg`
--

-- --------------------------------------------------------

--
-- Table structure for table `BasketballTeamPlayer`
--

CREATE TABLE IF NOT EXISTS `BasketballTeamPlayer` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `BasketballTeamId` int(11) NOT NULL,
  `FirstName` varchar(60) NOT NULL,
  `LastName` varchar(60) NOT NULL,
  `JerseyNumber` int(60) NOT NULL,
  `Position` varchar(60) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: classmysql.engr.oregonstate.edu:3306
-- Generation Time: May 13, 2019 at 01:30 PM
-- Server version: 10.3.13-MariaDB-log
-- PHP Version: 7.0.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cs340_hartwelg`
--

-- --------------------------------------------------------

--
-- Table structure for table `BasketballTeams`
--

CREATE TABLE IF NOT EXISTS `BasketballTeams` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `mascot` varchar(30) NOT NULL,
  `NumWins` int(11) NOT NULL,
  `NumLosses` int(11) NOT NULL,
  `BasketballTeamId` int(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: classmysql.engr.oregonstate.edu:3306
-- Generation Time: May 13, 2019 at 01:30 PM
-- Server version: 10.3.13-MariaDB-log
-- PHP Version: 7.0.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cs340_hartwelg`
--

-- --------------------------------------------------------

--
-- Table structure for table `LeadingScore`
--

CREATE TABLE IF NOT EXISTS `LeadingScore` (
  `id` int(11) NOT NULL,
  `Position` varchar(60) NOT NULL,
  `TeamId` int(11) NOT NULL,
  `GameId` int(11) NOT NULL,
  `TotalPointsPerGame` int(100) NOT NULL DEFAULT 0,
  KEY `id` (`id`),
  KEY `TeamId` (`TeamId`),
  KEY `GameId` (`GameId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `LeadingScore`
--
ALTER TABLE `LeadingScore`
  ADD CONSTRAINT `LeadingScore_ibfk_1` FOREIGN KEY (`id`) REFERENCES `BasketballTeamPlayer` (`Id`),
  ADD CONSTRAINT `LeadingScore_ibfk_2` FOREIGN KEY (`id`) REFERENCES `BasketballTeamPlayer` (`Id`),
  ADD CONSTRAINT `LeadingScore_ibfk_3` FOREIGN KEY (`TeamId`) REFERENCES `BasketballTeams` (`id`),
  ADD CONSTRAINT `LeadingScore_ibfk_4` FOREIGN KEY (`GameId`) REFERENCES `BasketballGame` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
