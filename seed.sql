-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Apr 12, 2017 at 09:16 PM
-- Server version: 5.6.28
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `tartan-tennis`
--

-- --------------------------------------------------------

--
-- Table structure for table `time_windows`
--

CREATE TABLE `time_windows` (
  `time_windows_id` int(11) NOT NULL,
  `begins_date` date NOT NULL,
  `begins_time` time NOT NULL,
  `ends_date` date NOT NULL,
  `ends_time` time NOT NULL,
  `users_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `time_windows`
--

INSERT INTO `time_windows` (`time_windows_id`, `begins_date`, `begins_time`, `ends_date`, `ends_time`, `users_id`) VALUES
(1, '2017-04-12', '00:00:00', '2017-04-12', '00:00:00', 1),
(2, '2017-04-12', '00:00:00', '2017-04-12', '00:00:00', 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `users_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`users_id`, `first_name`, `last_name`, `email`, `pass`) VALUES
(1, 'Matt', 'Cho', 'mattcho@email.com', '202cb962ac59075b964b07152d234b70'),
(2, 'Erin', 'Cho', 'erincho@email.com', '202cb962ac59075b964b07152d234b70');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `time_windows`
--
ALTER TABLE `time_windows`
  ADD PRIMARY KEY (`time_windows_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`users_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `time_windows`
--
ALTER TABLE `time_windows`
  MODIFY `time_windows_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `users_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;