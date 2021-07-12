-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 27, 2020 at 03:08 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookmarks`
--

CREATE TABLE `bookmarks` (
  `user_id` int(11) DEFAULT NULL,
  `game_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bookmarks`
--

INSERT INTO `bookmarks` (`user_id`, `game_id`) VALUES
(2, 3),
(2, 4),
(2, 5),
(3, 4),
(3, 5),
(3, 6),
(3, 7),
(3, 13),
(4, 8),
(4, 10),
(4, 11),
(4, 12),
(1, 2),
(1, 4),
(1, 5),
(2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE `games` (
  `id` int(11) NOT NULL,
  `title` varchar(150) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `genre` varchar(3) NOT NULL,
  `rating` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `games`
--

INSERT INTO `games` (`id`, `title`, `image`, `genre`, `rating`) VALUES
(1, 'Sid Meier\'s Civilization V: Brave New World', 'https://upload.wikimedia.org/wikipedia/en/3/30/C5BNWcover.jpg', 'str', 85),
(2, 'Crusader Kings II', 'https://i.redd.it/ma6oiz9duox31.jpg', 'str', 82),
(3, 'Warcraft III: Reforged ', 'https://images.g2a.com/newlayout/323x433/1x1x0/4ad2e1030f30/5c4ae318ae653a85857e7cb2', 'str', 60),
(4, 'Else Heart.Break()', 'https://f4.bcbits.com/img/a3071996844_10.jpg', 'rpg', 79),
(5, 'Shadowrun: Dragonfall - Director\'s Cut', 'https://gpstatic.com/acache/38/11/1/uk/packshot-6e6eb95282c317e0a11734a0f2c34f9a.jpg', 'rpg', 87),
(6, 'Stardew Valley', 'https://lh3.googleusercontent.com/IRzV1qSynfxIIS3huwZuAc5V8Jbej8N2dvX-yuVcCeCbRfgMGOxOjO_KlJpVH9d8jQ1cOXdSp5cL__8KOdlMeVyh0Q', 'rpg', 89),
(7, 'Disco Elysium', 'https://images.g2a.com/newlayout/323x433/1x1x0/5c0252f185ef/5de4dff27e696c78e9727332', 'rpg', 91),
(8, 'RimWorld', 'https://megadevcdn.azureedge.net/covers-163-239/RimWorld_3_1110.png', 'sim', 87),
(9, 'Tom Clancy\'s Rainbow Six® Siege', 'https://upload.wikimedia.org/wikipedia/en/thumb/4/47/Tom_Clancy%27s_Rainbow_Six_Siege_cover_art.jpg/220px-Tom_Clancy%27s_Rainbow_Six_Siege_cover_art.jpg', 'fps', 0),
(10, 'Euro Truck Simulator 2', 'https://images.g2a.com/newlayout/323x433/1x1x0/c6b70cd51f33/5911be5f5bafe371596e2db2', 'sim', 79),
(11, 'Farming Simulator 19', 'https://gpstatic.com/acache/37/28/1/uk/packshot-fdd0a4c1d8bfbf39de864da3ddb89e47.jpg', 'sim', 73),
(12, 'Train Simulator 2020', 'https://upload.wikimedia.org/wikipedia/en/thumb/4/44/Train_Sim_World_Cover.jpg/220px-Train_Sim_World_Cover.jpg', 'sim', 0),
(13, 'Project Zomboid', 'https://upload.wikimedia.org/wikipedia/en/0/0c/Boxshot_of_video_game_Project_zomboid.jpg', 'rpg', 87),
(14, 'Shadowrun Returns', 'https://giantbomb1.cbsistatic.com/uploads/scale_medium/1/16944/2968682-shadowrun-returns-cover-thumb.jpg', 'rpg', 76),
(15, 'Shadowrun: Hong Kong - Extended Edition', 'https://images.gog-statics.com/fcc90f964947d19b0bc49825d55cd181fea2389cd1312a5619ac731fc1c64208_product_card_v2_mobile_slider_639.jpg', 'rpg', 81),
(16, 'Cave Story+', 'https://external-preview.redd.it/OIQlImEvho7J6duc62oMaTb1uJ16vM4DMfbfy0d2f7k.png?auto=webp&s=bbcc265e0f61b6e317a47b4afdac8be87dc458b3', '???', 81),
(17, 'Sorcery! Parts 1 & 2', 'https://i.ytimg.com/vi/a-6Fk-2rIvc/maxresdefault.jpg', '???', 69),
(18, 'Dwarf Fortress', 'https://i.kym-cdn.com/entries/icons/mobile/000/012/352/dwarf-fortress-logo-vert.jpg', '???', 0);

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE `genres` (
  `id` varchar(3) NOT NULL,
  `title` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `genres`
--

INSERT INTO `genres` (`id`, `title`) VALUES
('???', 'Other'),
('fps', 'First Person Shooter'),
('rpg', 'Role-Playing Game'),
('sim', 'Simulation Game'),
('str', 'Strategy');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `game_id` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `title` varchar(150) DEFAULT NULL,
  `review` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `game_id`, `rating`, `title`, `review`) VALUES
(1, 1, 2, 1, 'bad', 'bad'),
(2, 2, 2, 5, 'gaaaad', 'gad'),
(3, 2, 4, 50, 'good game', '10/10');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `uname` varchar(40) DEFAULT NULL,
  `pass` varchar(255) DEFAULT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `is_admin` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `uname`, `pass`, `salt`, `is_admin`) VALUES
(1, 'jwalto', '244cad413fa94db1c686ff5bfc6777241ceaa3ea', 'abc123', 1),
(2, 'pwillic', '38bf8a5df0a227b697045c1b29a25a759e391f9b', 'java123', 0),
(3, 'rpgs', 'ba494cde63bd5d092e916b4083e27cda7c306d43', 'html42', 0),
(4, 'sims', 'c65e822545b8596c484112ac62a9194c6043c724', 'eadlc', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookmarks`
--
ALTER TABLE `bookmarks`
  ADD KEY `user_id` (`user_id`),
  ADD KEY `game_id` (`game_id`);

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`id`),
  ADD KEY `genre` (`genre`);

--
-- Indexes for table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `game_id` (`game_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookmarks`
--
ALTER TABLE `bookmarks`
  ADD CONSTRAINT `bookmarks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookmarks_ibfk_2` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `games`
--
ALTER TABLE `games`
  ADD CONSTRAINT `games_ibfk_1` FOREIGN KEY (`genre`) REFERENCES `genres` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
