-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 31, 2021 at 02:06 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `memorize`
--
CREATE DATABASE IF NOT EXISTS `memorize` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `memorize`;

-- --------------------------------------------------------

--
-- Table structure for table `login_tokens`
--

CREATE TABLE `login_tokens` (
  `login_token_id` int(11) NOT NULL,
  `login_token` varchar(64) NOT NULL,
  `fk_users_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login_tokens`
--

INSERT INTO `login_tokens` (`login_token_id`, `login_token`, `fk_users_id`) VALUES
(1, '4ee8263f06c9ef67d8dfc26ff034456e3e928217', 2),
(2, '039ac45472b83066e1408a359752a9a257bd292f', 2),
(3, 'df5da7319709424c80eb428c919a35a1667a9745', 2),
(4, '2388112b1578b7d0572d8d42b51c532835346fd5', 2),
(5, 'dbcb4c8f0c4e23c8861e30f612b7b0836ab7197f', 2),
(6, 'cda51d412743f4110682ea98cc0cf64782c6e2db', 2),
(7, 'a26a100444d8008789c45d4e726fdee085b39272', 2),
(8, '21aaef2b7d6d60bc6f41f8313c1a4f9a3eb04c3a', 2),
(9, '4deed21a246d696e8b30a3c1ffa4b9d13b2df74f', 2);

-- --------------------------------------------------------

--
-- Table structure for table `memo`
--

CREATE TABLE `memo` (
  `memo_id` int(11) NOT NULL,
  `memo_title` varchar(40) NOT NULL DEFAULT 'Title',
  `memo_text` varchar(150) NOT NULL DEFAULT 'Something to remember',
  `audience` enum('public','private') NOT NULL DEFAULT 'public',
  `fk_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `memo`
--

INSERT INTO `memo` (`memo_id`, `memo_title`, `memo_text`, `audience`, `fk_user`) VALUES
(6, 'Title', 'Something to remembersss', 'public', 10),
(7, 'Title', 'Something to remembersssss', 'public', 10),
(23, 'Testing the thing', 'Test the thing damnit jeez!', 'public', 2),
(24, 'Test it moRE MO(RE TESTS NOW DO IT FA', 'Testing tests in the testy test test!', 'public', 2),
(25, 'TESTT ETETST', 'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA', 'public', 2),
(26, 'SCREAMS OF AGONY IN MY MEMORY', 'LYEEEEEEEEEEEEEEEEEEEEKE DISE', 'public', 2),
(27, 'pirvte', 'yis', 'private', 2),
(28, 'Mosquitos must die!', 'Remember to Kill all mosquitos!', 'public', 2),
(31, 'Hire Boris Jankovic', 'Don\'t forget, Boris is the best candidate ;)', 'public', 16),
(32, 'Seriously, Hire Boris Jankovic', 'Or else he will bring his banhammer', 'public', 16),
(33, 'It\'s just a joke', 'Boris would never hurt anyone he\'s too nice! That\'s why you should hire him :O', 'public', 16),
(35, 'I like it when it rains', 'Because rain smells amazing !', 'public', 16),
(36, 'Shopping list', 'Bread, Flour, Tomatoes', 'public', 16);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `users_id` int(11) NOT NULL,
  `first_name` varchar(40) NOT NULL,
  `last_name` varchar(40) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(60) NOT NULL,
  `role` enum('user','admin') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`users_id`, `first_name`, `last_name`, `password`, `email`, `role`) VALUES
(2, 'Boris', 'Jankovic', '$2y$10$utvs5wlakp.18PReyMkqEetR.2mfVDm6oFodMPfvL1arMCakbqD.K', 'borisjanko@outlook.com', 'admin'),
(10, 'Boris', 'Jankovic', '$2y$10$7kHgUUa6ZAs1eQ/LFtGhK.lUTLdqF6yGaSnvzLxu7Na7y0Bo8Eg9K', 'borisjanko@outlook.co', 'admin'),
(13, 'John', 'Thompson', '$2y$10$y5DrUnPA/j4LUmkwBJYXg.PcuHdwQRGCDT3O9Z/pYNlYUaSueX.5q', 'John@thompson.com', 'user'),
(16, 'Boris', 'Jankovic', '$2y$10$6NRjeG6OBB40yArW.3BJ/.EnIf4NStxfkHxcUdRel6Vr7FGgRHo0.', 'boris@janko.com', 'admin'),
(17, 'Its', 'Yaboi', '$2y$10$oowPThlk8k8j/PtOke8DC.XWPfrub.T3KpE89E8W5Q/4fSYfpKCD6', 'yaboi@meeeee.com', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `login_tokens`
--
ALTER TABLE `login_tokens`
  ADD PRIMARY KEY (`login_token_id`),
  ADD UNIQUE KEY `login_token` (`login_token`),
  ADD KEY `fk_users_id` (`fk_users_id`);

--
-- Indexes for table `memo`
--
ALTER TABLE `memo`
  ADD PRIMARY KEY (`memo_id`),
  ADD KEY `fk_user` (`fk_user`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`users_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `login_tokens`
--
ALTER TABLE `login_tokens`
  MODIFY `login_token_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `memo`
--
ALTER TABLE `memo`
  MODIFY `memo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `users_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `login_tokens`
--
ALTER TABLE `login_tokens`
  ADD CONSTRAINT `login_tokens_ibfk_1` FOREIGN KEY (`fk_users_id`) REFERENCES `users` (`users_id`);

--
-- Constraints for table `memo`
--
ALTER TABLE `memo`
  ADD CONSTRAINT `memo_ibfk_1` FOREIGN KEY (`fk_user`) REFERENCES `users` (`users_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
