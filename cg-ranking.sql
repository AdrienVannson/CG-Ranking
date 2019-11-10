SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


CREATE TABLE `cgranking_games` (
  `id` int(11) NOT NULL,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `formattedName` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `isContest` tinyint(1) NOT NULL,
  `isWatched` tinyint(1) NOT NULL,
  `timeBetweenUpdates` int(11) NOT NULL DEFAULT '1209240'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `cgranking_ranks` (
  `id` int(11) NOT NULL,
  `date` datetime DEFAULT NULL,
  `game` int(11) NOT NULL DEFAULT '2',
  `user` int(11) NOT NULL,
  `rank` int(11) NOT NULL,
  `agentID` int(11) NOT NULL DEFAULT '-1',
  `isInProgress` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `cgranking_users` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(32) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


ALTER TABLE `cgranking_games`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `cgranking_ranks`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `cgranking_users`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `cgranking_games`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `cgranking_ranks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `cgranking_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
