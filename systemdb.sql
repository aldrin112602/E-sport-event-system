-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 20, 2023 at 03:00 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `systemdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `id` int(11) NOT NULL,
  `event_name` varchar(20) NOT NULL,
  `start_date` varchar(20) NOT NULL,
  `start_time` varchar(50) NOT NULL,
  `description` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `message` varchar(200) NOT NULL,
  `unique_id` varchar(50) NOT NULL,
  `username` varchar(20) NOT NULL,
  `profile` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `message`, `unique_id`, `username`, `profile`) VALUES
(1, 'hello guys', 'a553e1c1c76fd2968510ead605db1f2f', 'aldrin25', ''),
(2, 'kamusta kayo hahaha', 'a553e1c1c76fd2968510ead605db1f2f', 'aldrin25', ''),
(3, 'yfghjfgjh', 'a553e1c1c76fd2968510ead605db1f2f', 'aldrin25', '../Uploads/63e842650'),
(4, 'hfg', 'a553e1c1c76fd2968510ead605db1f2f', 'aldrin25', '../Uploads/63e842650'),
(5, 'hgfjghjhg', 'b570690e7523a33e329f9a1f1d603218', 'admin@test', ''),
(6, 'hfghjfgh', 'a553e1c1c76fd2968510ead605db1f2f', 'aldrin25', '../Uploads/64408e6f3');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `detail` varchar(50) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `poll`
--

CREATE TABLE `poll` (
  `id` int(11) NOT NULL,
  `data` varchar(500) NOT NULL,
  `votes` varchar(500) NOT NULL,
  `unique_id` varchar(50) NOT NULL,
  `users_id` varchar(500) NOT NULL,
  `enabled` varchar(20) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `quiz_score`
--

CREATE TABLE `quiz_score` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `score` varchar(20) NOT NULL,
  `unique_id` varchar(50) NOT NULL,
  `user_type` varchar(20) NOT NULL,
  `profile` varchar(100) NOT NULL,
  `items` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `quiz_score`
--

INSERT INTO `quiz_score` (`id`, `username`, `score`, `unique_id`, `user_type`, `profile`, `items`) VALUES
(1, 'admin@test', '', 'b570690e7523a33e329f9a1f1d603218', '', '', ''),
(2, 'aldrin25', '', 'a553e1c1c76fd2968510ead605db1f2f', '', '../Uploads/64408e6f30104_328636784_487741166889867_261676604223418446_n.jpg', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(20) NOT NULL,
  `unique_id` varchar(50) NOT NULL,
  `user_type` varchar(20) NOT NULL,
  `profile` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `unique_id`, `user_type`, `profile`) VALUES
(1, 'admin@test', 'admin_test@gmail.com', 'admin@test', 'b570690e7523a33e329f9a1f1d603218', 'admin', ''),
(2, 'aldrin25', 'caballeroaldrin02@gmail.com', 'aldrin25', 'a553e1c1c76fd2968510ead605db1f2f', 'user', '../Uploads/64408e6f30104_328636784_487741166889867_261676604223418446_n.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` int(11) NOT NULL,
  `path` varchar(200) NOT NULL,
  `title` varchar(200) NOT NULL,
  `category` varchar(10) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `poll`
--
ALTER TABLE `poll`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quiz_score`
--
ALTER TABLE `quiz_score`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `poll`
--
ALTER TABLE `poll`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quiz_score`
--
ALTER TABLE `quiz_score`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
