-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2020 at 09:30 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cars`
--

-- --------------------------------------------------------

--
-- Table structure for table `cars1`
--

CREATE TABLE `cars1` (
  `car_id` int(11) NOT NULL,
  `car` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `views` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cars1`
--

INSERT INTO `cars1` (`car_id`, `car`, `price`, `views`, `user_id`) VALUES
(1, 'Peugeot 407', 3250, 26, 1),
(2, 'Alfa Romeo 159', 2900, 1, 1),
(3, 'Audi A4', 5500, 0, 1),
(4, 'Audi A5 r', 7100, 1, 1),
(5, 'Bmw 320 x drive', 6500, 1, 1),
(6, 'Fiat Grande Punto', 2350, 0, 1),
(7, 'Fiat Stilo', 1800, 1, 1),
(8, 'Fiat 500Lsport', 4800, 0, 1),
(9, 'Mercedes Benz C 180 compressor', 8500, 0, 1),
(10, 'Opel Astra', 1650, 0, 1),
(11, 'Opel Vectra', 1400, 1, 1),
(12, 'Peugeot 508', 7500, 0, 1),
(13, 'Renault Clio x', 1100, 0, 1),
(14, 'Renault Megane', 2200, 1, 1),
(15, 'Volkswagen Golf 2', 600, 0, 1),
(16, 'Volkswagen Golf 5', 5200, 0, 1),
(17, 'Volkswagen B6', 5800, 2, 1),
(18, 'Volkswagen Passat B7', 6800, 12, 1);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `car_id` int(11) NOT NULL,
  `date_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment`, `user_id`, `car_id`, `date_time`) VALUES
(1, 'prelep auto', 1, 1, '2020-04-17 18:00:54'),
(2, 'sjajan auto', 1, 2, '2020-04-16 00:00:00'),
(3, 'sjajan auto', 1, 3, '2020-04-16 00:00:00'),
(4, 'sjajan auto', 1, 4, '2020-04-16 00:00:00'),
(5, 'sjajan auto', 1, 5, '2020-04-16 00:00:00'),
(6, 'preporuka, mali potrosac', 1, 6, '2020-04-16 00:00:00'),
(7, 'preporuka, mali potrosac', 1, 7, '2020-04-16 00:00:00'),
(8, 'preporuka, mali potrosac', 1, 8, '2020-04-16 00:00:00'),
(9, 'preporuka, mali potrosac', 1, 9, '2020-04-16 00:00:00'),
(10, 'vrlo stabilan i pouzdan, preporucujem', 1, 10, '2020-04-16 00:00:00'),
(11, 'vrlo stabilan i pouzdan, preporucujem', 1, 11, '2020-04-16 00:00:00'),
(12, 'vrlo stabilan i pouzdan, preporucujem', 1, 12, '2020-04-16 00:00:00'),
(13, 'udoban auto, za porodicu fantastican', 1, 13, '2020-04-16 00:00:00'),
(14, 'udoban auto, za porodicu fantastican', 1, 14, '2020-04-16 00:00:00'),
(15, 'udoban auto, za porodicu fantastican', 1, 15, '2020-04-16 00:00:00'),
(16, 'preporuka za ovaj auto, ocena 5+', 1, 16, '2020-04-16 00:00:00'),
(17, 'preporuka za ovaj auto, ocena 5+', 1, 17, '2020-04-16 00:00:00'),
(18, 'preporuka za ovaj auto, ocena 5+', 1, 18, '2020-04-16 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `info1`
--

CREATE TABLE `info1` (
  `info_id` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `body` varchar(255) NOT NULL,
  `fuel` varchar(255) NOT NULL,
  `cm3` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `car_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `info1`
--

INSERT INTO `info1` (`info_id`, `year`, `body`, `fuel`, `cm3`, `description`, `car_id`) VALUES
(1, 2006, 'Limuzina', 'Dizel', '1999', '', 1),
(2, 2020, 'Limuzina', 'Benzin', '32', '', 2),
(3, 2004, 'Limuzina', 'Dizel', '1600', '', 3),
(4, 2008, 'Limuzina', 'Dizel', '1900', '', 4),
(5, 2010, 'Karavan', 'Benzin', '1600', '', 5),
(7, 2008, 'Karavan', 'Dizel', '1900', '', 6),
(8, 2008, 'Karavan', 'Dizel', '1900', '', 7),
(9, 2008, 'Karavan', 'Dizel', '1900', '', 8),
(10, 2008, 'Karavan', 'Dizel', '1900', '', 9),
(11, 2008, 'Karavan', 'Dizel', '1900', '', 10),
(12, 2012, 'Limuzina', 'Benzin', '1400', '', 11),
(13, 2012, 'Limuzina', 'Benzin', '1400', '', 12),
(14, 2012, 'Limuzina', 'Benzin', '1400', '', 13),
(15, 2012, 'Limuzina', 'Benzin', '1400', '', 14),
(16, 2007, 'Kupe', 'Benzin', '1800', '', 15),
(17, 2007, 'Kupe', 'Benzin', '1800', '', 16),
(18, 2007, 'Kupe', 'Benzin', '1800', '', 17),
(19, 2007, 'Kupe', 'Benzin', '1800', '', 18);

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `like_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `car_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`like_id`, `user_id`, `car_id`) VALUES
(4, 1, 2),
(5, 1, 3),
(6, 1, 4),
(7, 1, 5),
(8, 1, 6),
(9, 1, 7),
(10, 1, 8),
(11, 1, 9),
(12, 1, 10),
(13, 1, 11),
(14, 1, 12),
(15, 1, 13),
(16, 1, 14),
(17, 1, 15),
(18, 1, 16),
(19, 1, 17),
(20, 1, 18),
(21, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `likes_unlikes_comment`
--

CREATE TABLE `likes_unlikes_comment` (
  `likes_unlikes_comment_id` int(11) NOT NULL,
  `num_likes_comment` int(11) NOT NULL,
  `num_unlikes_comment` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `likes_unlikes_comment`
--

INSERT INTO `likes_unlikes_comment` (`likes_unlikes_comment_id`, `num_likes_comment`, `num_unlikes_comment`, `comment_id`) VALUES
(1, 4, 0, 1),
(2, 3, 0, 2),
(4, 3, 0, 3),
(5, 31, 0, 4),
(6, 3, 2, 5),
(7, 3, 0, 6),
(8, 3, 0, 7),
(9, 22, 1, 8),
(10, 3, 0, 9),
(11, 19, 0, 10),
(12, 3, 0, 11),
(13, 5, 0, 12),
(14, 3, 4, 13),
(15, 15, 0, 14),
(16, 6, 0, 15),
(17, 3, 1, 16),
(18, 22, 0, 17),
(19, 13, 3, 18);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user`, `password`) VALUES
(1, 'milos', '8b764977a676f7c4b750fc3af0e753f9');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cars1`
--
ALTER TABLE `cars1`
  ADD PRIMARY KEY (`car_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `info1`
--
ALTER TABLE `info1`
  ADD PRIMARY KEY (`info_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`like_id`);

--
-- Indexes for table `likes_unlikes_comment`
--
ALTER TABLE `likes_unlikes_comment`
  ADD PRIMARY KEY (`likes_unlikes_comment_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cars1`
--
ALTER TABLE `cars1`
  MODIFY `car_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `info1`
--
ALTER TABLE `info1`
  MODIFY `info_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `like_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `likes_unlikes_comment`
--
ALTER TABLE `likes_unlikes_comment`
  MODIFY `likes_unlikes_comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
