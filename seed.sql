DROP DATABASE IF EXISTS `tartan_tennis`;
CREATE DATABASE `tartan_tennis`;
USE `tartan_tennis`;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+05:00";   -- EST

CREATE TABLE `users` (
  `user_id` int(10) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pass` char(40) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `users`
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `first_name` (`first_name`),
  ADD KEY `last_name` (`last_name`),
  ADD KEY `created_at` (`created_at`),
  ADD KEY `updated_at` (`updated_at`);

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `username`, `email`, `pass`, `created_at`, `updated_at`) VALUES (NULL, 'Freya', 'Yuan', 'fyuan', 'fyuan@email.com', SHA1('123'), CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `username`, `email`, `pass`, `created_at`, `updated_at`) VALUES (NULL, 'Matt', 'Cho', 'mcho', 'mcho@email.com', SHA1('123'), CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `username`, `email`, `pass`, `created_at`, `updated_at`) VALUES (NULL, 'Xian', 'Hu', 'xhu', 'xhu@email.com', SHA1('123'), CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

CREATE TABLE `times` (
  `time_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `begins_date` varchar(20) NOT NULL,
  `begins_time` varchar(20) NOT NULL,
  `ends_time` varchar(20) NOT NULL,
  `tag` tinytext NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FULLTEXT (begins_date, begins_time, ends_time, tag)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `times`
  ADD KEY `created_at` (`created_at`),
  ADD KEY `user_id` (`user_id`);

INSERT INTO `times` (`begins_date`, `begins_time`, `ends_time`, `tag`, `user_id`) VALUES
('2017-05-09', '14:00', '15:00', 'I am Freya', 1); 

CREATE TABLE `friends` (
  `friend_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `friender_id` int(11) NOT NULL,
  `friendee_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `friends`
  ADD KEY `friender` (`friender_id`),
  ADD KEY `friendee` (`friendee_id`);

CREATE TABLE `appointments` (
  `appointment_id` int(10) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `poster_id` int(10) UNSIGNED NOT NULL,
  `responder_id` int(10) UNSIGNED NOT NULL,
  `time_id` int(11) UNSIGNED NOT NULL,
  `message_id` int(11) UNSIGNED NOT NULL,
  `is_accepted` boolean DEFAULT FALSE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `appointments`
  ADD KEY `poster_id` (`poster_id`),
  ADD KEY `responder_id` (`responder_id`),
  ADD KEY `time_id` (`time_id`),
  ADD KEY `message_id` (`message_id`);

CREATE TABLE `follows` (
  `follow_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `follower_id` int(11) NOT NULL,
  `followee_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `follows`
  ADD KEY `follower_id` (`follower_id`),
  ADD KEY `followee_id` (`followee_id`);

CREATE TABLE `likes` (
  `like_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `bad_like` tinyint(1) NOT NULL,
  `public_like` tinyint(1) NOT NULL,
  `private_like` tinyint(1) NOT NULL,
  `liker_id` int(11) NOT NULL,
  `likee_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `likes`
  ADD KEY `bad_like` (`bad_like`),
  ADD KEY `public_like` (`public_like`),
  ADD KEY `private_like` (`private_like`),
  ADD KEY `liker_id` (`liker_id`),
  ADD KEY `likee_id` (`likee_id`);

CREATE TABLE `messages` (
  `message_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `message_title` text NOT NULL,
  `message_body` text NOT NULL,
  `is_read` boolean DEFAULT FALSE,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `messages`
  ADD KEY `sender_id` (`sender_id`),
  ADD KEY `receiver_id` (`receiver_id`),
  ADD KEY `created_at` (`created_at`),
  ADD FULLTEXT KEY `body` (`message_body`);