DROP DATABASE IF EXISTS 'tartan-tennis'
CREATE DATABASE 'tartan-tennis';

-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Apr 14, 2017 at 06:15 AM
-- Server version: 5.6.28
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `tartan-tennis`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `appointments_id` int(10) UNSIGNED NOT NULL,
  `poster_id` int(10) UNSIGNED NOT NULL,
  `responder_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `follows`
--

CREATE TABLE `follows` (
  `follows_id` int(11) NOT NULL,
  `follower_id` int(11) NOT NULL,
  `followee_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE `friends` (
  `friends_id` int(11) NOT NULL,
  `friender_id` int(11) NOT NULL,
  `friendee_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `likes_id` int(11) NOT NULL,
  `bad_like` tinyint(1) NOT NULL,
  `public_like` tinyint(1) NOT NULL,
  `private_like` tinyint(1) NOT NULL,
  `liker_id` int(11) NOT NULL,
  `likee_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `messages_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `message_body` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`messages_id`, `sender_id`, `receiver_id`, `message_body`, `created_at`) VALUES
(1, 1, 2, 'This is testing.', '2017-04-12 21:31:43');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `tags_id` int(11) NOT NULL,
  `time_windows_id` int(11) NOT NULL,
  `tag_body` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

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
  `user_id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `tennis_level` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `pass` char(40) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `tennis_level`, `email`, `pass`, `created_at`, `updated_at`) VALUES
(3, 'Erin', 'Cho', 'beginner', 'erin@email.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '2017-04-14 01:20:27', '2017-04-14 01:20:27'),
(6, 'Matt', 'Cho', 'intermediate', 'matt@email.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '2017-04-14 02:56:35', '2017-04-14 02:56:35'),
(7, 'Chris', 'Lee', 'advanced', 'chris@email.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '2017-04-14 03:06:24', '2017-04-14 03:06:24'),
(9, 'Kevin', 'Kim', 'advanced', 'kevin@email.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '2017-04-14 03:36:18', '2017-04-14 03:36:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`appointments_id`),
  ADD KEY `poster_id` (`poster_id`),
  ADD KEY `responder_id` (`responder_id`);

--
-- Indexes for table `follows`
--
ALTER TABLE `follows`
  ADD PRIMARY KEY (`follows_id`),
  ADD KEY `follower_id` (`follower_id`),
  ADD KEY `followee_id` (`followee_id`);

--
-- Indexes for table `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`friends_id`),
  ADD KEY `friender` (`friender_id`),
  ADD KEY `friendee` (`friendee_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`likes_id`),
  ADD KEY `bad_like` (`bad_like`),
  ADD KEY `public_like` (`public_like`),
  ADD KEY `private_like` (`private_like`),
  ADD KEY `liker_id` (`liker_id`),
  ADD KEY `likee_id` (`likee_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`messages_id`),
  ADD KEY `sender_id` (`sender_id`),
  ADD KEY `receiver_id` (`receiver_id`),
  ADD KEY `created_at` (`created_at`);
ALTER TABLE `messages` ADD FULLTEXT KEY `body` (`message_body`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`tags_id`),
  ADD KEY `time_windows_id` (`time_windows_id`),
  ADD KEY `created_at` (`created_at`);
ALTER TABLE `tags` ADD FULLTEXT KEY `body` (`tag_body`);

--
-- Indexes for table `time_windows`
--
ALTER TABLE `time_windows`
  ADD PRIMARY KEY (`time_windows_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `first_name` (`first_name`),
  ADD KEY `last_name` (`last_name`),
  ADD KEY `created_at` (`created_at`),
  ADD KEY `updated_at` (`updated_at`),
  ADD KEY `tennis_level` (`tennis_level`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `appointments_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `follows`
--
ALTER TABLE `follows`
  MODIFY `follows_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `friends`
--
ALTER TABLE `friends`
  MODIFY `friends_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `time_windows`
--
ALTER TABLE `time_windows`
  MODIFY `time_windows_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;