-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 26, 2020 at 02:49 AM
-- Server version: 5.7.24
-- PHP Version: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `music_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `artist`
--

CREATE TABLE `artist` (
  `artist_id` int(11) NOT NULL,
  `artist_name` varchar(40) DEFAULT NULL,
  `artist_description` varchar(100) DEFAULT NULL,
  `effective_from_dt` date DEFAULT NULL,
  `effective_end_dt` date DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_dt` datetime DEFAULT CURRENT_TIMESTAMP,
  `last_updated_by` int(11) DEFAULT NULL,
  `last_updated_dt` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `artist`
--

INSERT INTO `artist` (`artist_id`, `artist_name`, `artist_description`, `effective_from_dt`, `effective_end_dt`, `created_by`, `created_dt`, `last_updated_by`, `last_updated_dt`) VALUES
(1, 'ed sheeran', 'singer from england', '2020-09-24', '2020-09-25', 1, '2020-09-24 15:23:07', 1, '2020-09-26 00:50:43'),
(2, 'alan walker', 'popular DJ', '2020-09-24', '2020-09-25', 1, '2020-09-24 15:24:48', 1, '2020-09-26 00:50:43'),
(3, 'john doe', 'testing', '2020-09-24', '2020-09-24', 1, '2020-09-24 15:26:01', 1, '2020-09-24 15:26:07'),
(4, 'kavin', 'chandar', '2020-09-25', '2020-09-25', 1, '2020-09-25 22:29:35', 1, '2020-09-26 00:50:43'),
(5, 'aayush', 'dua', '2020-09-25', '2020-09-25', 1, '2020-09-25 22:29:35', 1, '2020-09-26 00:50:43'),
(6, 'random', 'testing', '2020-09-25', '2020-09-25', 1, '2020-09-25 22:34:50', 1, '2020-09-25 22:35:05'),
(7, 'Joji', 'filthy frank', '2020-09-25', NULL, 1, '2020-09-26 00:52:01', 1, '2020-09-26 00:52:01'),
(8, 'Tentacion', 'dead', '2020-09-25', NULL, 1, '2020-09-26 00:52:01', 1, '2020-09-26 00:52:01'),
(9, 'Shiloh', 'invisible', '2020-09-25', NULL, 1, '2020-09-26 00:52:01', 1, '2020-09-26 00:52:19'),
(10, 'Ed Sheeran', 'ginger', '2020-09-25', NULL, 1, '2020-09-26 00:52:01', 1, '2020-09-26 00:52:01'),
(11, 'Taylor Swift', 'Speed', '2020-09-25', NULL, 1, '2020-09-26 00:53:04', 1, '2020-09-26 00:53:04'),
(12, 'Panic At the Disco', 'one man band', '2020-09-25', NULL, 1, '2020-09-26 00:53:04', 1, '2020-09-26 00:53:04');

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE `genre` (
  `genre_id` int(11) NOT NULL,
  `genre_name` varchar(40) DEFAULT NULL,
  `effective_from_dt` date DEFAULT NULL,
  `effective_end_dt` date DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_dt` datetime DEFAULT CURRENT_TIMESTAMP,
  `last_updated_by` int(11) DEFAULT NULL,
  `last_updated_dt` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`genre_id`, `genre_name`, `effective_from_dt`, `effective_end_dt`, `created_by`, `created_dt`, `last_updated_by`, `last_updated_dt`) VALUES
(1, 'jazz', '2020-09-23', NULL, 1, '2020-09-23 17:03:35', 1, '2020-09-25 23:05:45'),
(2, 'pop', '2020-09-23', NULL, 1, '2020-09-23 17:07:32', 1, '2020-09-25 23:05:45'),
(3, 'rock', '2020-09-23', NULL, 1, '2020-09-23 17:07:32', 1, '2020-09-25 23:05:45'),
(4, 'classical', '2020-09-24', NULL, 1, '2020-09-24 10:32:33', 1, '2020-09-24 10:32:33'),
(5, 'happy', '2020-09-24', NULL, 1, '2020-09-24 10:32:33', 1, '2020-09-25 23:05:45'),
(6, 'lo-fi', '2020-09-24', NULL, 1, '2020-09-24 11:55:01', 1, '2020-09-24 11:55:01'),
(7, 'rock', '2020-09-25', '2020-09-25', 1, '2020-09-25 16:58:30', 1, '2020-09-26 00:56:41'),
(8, 'kavin', '2020-09-25', '2020-09-25', 1, '2020-09-25 23:07:48', 1, '2020-09-26 00:56:41'),
(9, 'nitin', '2020-09-25', '2020-09-25', 1, '2020-09-25 23:07:48', 1, '2020-09-26 00:56:41'),
(10, 'hip hop', '2020-09-25', NULL, 1, '2020-09-26 00:57:06', 1, '2020-09-26 00:57:06');

-- --------------------------------------------------------

--
-- Table structure for table `mood`
--

CREATE TABLE `mood` (
  `mood_id` int(11) NOT NULL,
  `mood_name` varchar(40) DEFAULT NULL,
  `mood_description` varchar(100) DEFAULT NULL,
  `effective_from_dt` date DEFAULT NULL,
  `effective_end_dt` date DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_dt` datetime DEFAULT CURRENT_TIMESTAMP,
  `last_updated_by` int(11) DEFAULT NULL,
  `last_updated_dt` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mood`
--

INSERT INTO `mood` (`mood_id`, `mood_name`, `mood_description`, `effective_from_dt`, `effective_end_dt`, `created_by`, `created_dt`, `last_updated_by`, `last_updated_dt`) VALUES
(1, 'workout', 'Hype it up', '2020-09-24', NULL, 1, '2020-09-24 15:38:30', 1, '2020-09-26 00:55:01'),
(2, 'Melancholy', 'When you are feeling down', '2020-09-24', NULL, 1, '2020-09-24 15:38:30', 1, '2020-09-26 00:55:01'),
(3, 'energetic', 'When you are filled with energy', '2020-09-24', NULL, 1, '2020-09-24 15:39:10', 1, '2020-09-26 00:55:01'),
(4, 'chill', 'When you feel alone', '2020-09-24', NULL, 1, '2020-09-24 15:39:10', 1, '2020-09-25 14:50:08'),
(5, 'study', 'Learning with passion', '2020-09-25', NULL, 1, '2020-09-25 14:50:26', 1, '2020-09-25 14:51:09'),
(7, 'Midnight jams', 'When you can\'t fall asleep', '2020-09-25', NULL, 1, '2020-09-26 00:56:01', 1, '2020-09-26 00:56:01');

-- --------------------------------------------------------

--
-- Table structure for table `playlist`
--

CREATE TABLE `playlist` (
  `playlist_id` int(11) NOT NULL,
  `playlist_name` varchar(40) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `effective_from_dt` date DEFAULT NULL,
  `effective_end_dt` date DEFAULT NULL,
  `created_dt` datetime DEFAULT CURRENT_TIMESTAMP,
  `last_updated_dt` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `playlist`
--

INSERT INTO `playlist` (`playlist_id`, `playlist_name`, `user_id`, `effective_from_dt`, `effective_end_dt`, `created_dt`, `last_updated_dt`) VALUES
(1, 'Favourites', 1, NULL, NULL, '2020-09-25 19:49:45', '2020-09-25 19:49:45');

-- --------------------------------------------------------

--
-- Table structure for table `songs`
--

CREATE TABLE `songs` (
  `song_id` int(11) NOT NULL,
  `song_name` varchar(50) DEFAULT NULL,
  `song_path` varchar(256) NOT NULL,
  `artist_id` int(11) DEFAULT NULL,
  `genre_id` int(11) DEFAULT NULL,
  `mood_id` int(11) DEFAULT NULL,
  `song_description` varchar(200) DEFAULT NULL,
  `effective_from_dt` date DEFAULT NULL,
  `effective_end_dt` date DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_dt` datetime DEFAULT CURRENT_TIMESTAMP,
  `last_updated_by` int(11) DEFAULT NULL,
  `last_updated_dt` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `songs`
--

INSERT INTO `songs` (`song_id`, `song_name`, `song_path`, `artist_id`, `genre_id`, `mood_id`, `song_description`, `effective_from_dt`, `effective_end_dt`, `created_by`, `created_dt`, `last_updated_by`, `last_updated_dt`) VALUES
(12, 'castle on the hill', '/hymn/admin/uploaded_songs/Ed Sheeran - Castle on the Hill.mp3', 1, 2, 7, 'song', '2020-09-25', NULL, NULL, '2020-09-26 00:58:30', NULL, '2020-09-26 00:58:30'),
(13, 'dont', '/hymn/admin/uploaded_songs/Ed Sheeran - Don_t.mp3', 1, 2, 3, 'song', '2020-09-25', NULL, NULL, '2020-09-26 01:01:27', NULL, '2020-09-26 01:01:27'),
(14, 'perfect', '/hymn/admin/uploaded_songs/Ed Sheeran - Perfect.mp3', 1, 2, 2, 'song', '2020-09-25', NULL, NULL, '2020-09-26 01:01:27', NULL, '2020-09-26 01:01:27');

-- --------------------------------------------------------

--
-- Table structure for table `songs_in_playlist`
--

CREATE TABLE `songs_in_playlist` (
  `songs_in_playlist_id` int(11) NOT NULL,
  `playlist_id` int(11) DEFAULT NULL,
  `song_id` int(11) DEFAULT NULL,
  `effective_from_dt` date DEFAULT NULL,
  `effective_end_dt` date DEFAULT NULL,
  `created_dt` datetime DEFAULT CURRENT_TIMESTAMP,
  `last_updated_dt` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_master`
--

CREATE TABLE `user_master` (
  `user_id` int(11) NOT NULL,
  `user_type_id` int(11) DEFAULT NULL,
  `full_name` varchar(20) DEFAULT NULL,
  `password` varchar(60) DEFAULT NULL,
  `email_id` varchar(50) DEFAULT NULL,
  `effective_from_dt` date DEFAULT NULL,
  `effective_end_dt` date DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_dt` datetime DEFAULT CURRENT_TIMESTAMP,
  `last_updated_by` int(11) DEFAULT NULL,
  `last_updated_dt` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_master`
--

INSERT INTO `user_master` (`user_id`, `user_type_id`, `full_name`, `password`, `email_id`, `effective_from_dt`, `effective_end_dt`, `created_by`, `created_dt`, `last_updated_by`, `last_updated_dt`) VALUES
(1, 1, 'Lennox Sherwin', 'a3db8cad2c48d1f0a35ac0adab419279', 'lennox.sweeton@gmail.com', '2020-09-22', NULL, 1, '2020-09-22 22:40:44', 1, '2020-09-23 14:36:01'),
(3, 2, 'john doe', '57baa06e7fd52d7b3cbb6a4130377984', 'john@gmail.com', '2020-09-23', NULL, NULL, '2020-09-23 15:14:38', NULL, '2020-09-23 15:14:38'),
(6, 1, 'Aayush Dua', 'a3db8cad2c48d1f0a35ac0adab419279', 'admin@gmail.com', '2020-09-22', NULL, 1, '2020-09-22 22:40:44', 1, '2020-09-23 14:36:01');

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `user_type_id` int(11) NOT NULL,
  `user_type` varchar(10) DEFAULT NULL,
  `effective_from_dt` date DEFAULT NULL,
  `effective_end_dt` date DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_dt` datetime DEFAULT CURRENT_TIMESTAMP,
  `last_updated_by` int(11) DEFAULT NULL,
  `last_updated_dt` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`user_type_id`, `user_type`, `effective_from_dt`, `effective_end_dt`, `created_by`, `created_dt`, `last_updated_by`, `last_updated_dt`) VALUES
(1, 'Admin', '2020-09-22', NULL, 1, '2020-09-22 22:35:44', 1, '2020-09-22 22:35:44'),
(2, 'Client', '2020-09-22', NULL, 1, '2020-09-22 22:35:44', 1, '2020-09-22 22:35:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `artist`
--
ALTER TABLE `artist`
  ADD PRIMARY KEY (`artist_id`);

--
-- Indexes for table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`genre_id`);

--
-- Indexes for table `mood`
--
ALTER TABLE `mood`
  ADD PRIMARY KEY (`mood_id`);

--
-- Indexes for table `playlist`
--
ALTER TABLE `playlist`
  ADD PRIMARY KEY (`playlist_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `songs`
--
ALTER TABLE `songs`
  ADD PRIMARY KEY (`song_id`),
  ADD KEY `artist_id` (`artist_id`),
  ADD KEY `genre_id` (`genre_id`),
  ADD KEY `mood_id` (`mood_id`);

--
-- Indexes for table `songs_in_playlist`
--
ALTER TABLE `songs_in_playlist`
  ADD PRIMARY KEY (`songs_in_playlist_id`),
  ADD KEY `playlist_id` (`playlist_id`),
  ADD KEY `song_id` (`song_id`);

--
-- Indexes for table `user_master`
--
ALTER TABLE `user_master`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `user_type_id` (`user_type_id`);

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`user_type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `artist`
--
ALTER TABLE `artist`
  MODIFY `artist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `genre`
--
ALTER TABLE `genre`
  MODIFY `genre_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `mood`
--
ALTER TABLE `mood`
  MODIFY `mood_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `playlist`
--
ALTER TABLE `playlist`
  MODIFY `playlist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `songs`
--
ALTER TABLE `songs`
  MODIFY `song_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `songs_in_playlist`
--
ALTER TABLE `songs_in_playlist`
  MODIFY `songs_in_playlist_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_master`
--
ALTER TABLE `user_master`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `user_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `playlist`
--
ALTER TABLE `playlist`
  ADD CONSTRAINT `playlist_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_master` (`user_id`);

--
-- Constraints for table `songs`
--
ALTER TABLE `songs`
  ADD CONSTRAINT `songs_ibfk_1` FOREIGN KEY (`artist_id`) REFERENCES `artist` (`artist_id`),
  ADD CONSTRAINT `songs_ibfk_2` FOREIGN KEY (`genre_id`) REFERENCES `genre` (`genre_id`),
  ADD CONSTRAINT `songs_ibfk_3` FOREIGN KEY (`mood_id`) REFERENCES `mood` (`mood_id`);

--
-- Constraints for table `songs_in_playlist`
--
ALTER TABLE `songs_in_playlist`
  ADD CONSTRAINT `songs_in_playlist_ibfk_1` FOREIGN KEY (`playlist_id`) REFERENCES `playlist` (`playlist_id`),
  ADD CONSTRAINT `songs_in_playlist_ibfk_2` FOREIGN KEY (`song_id`) REFERENCES `songs` (`song_id`);

--
-- Constraints for table `user_master`
--
ALTER TABLE `user_master`
  ADD CONSTRAINT `user_master_ibfk_1` FOREIGN KEY (`user_type_id`) REFERENCES `user_type` (`user_type_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
