-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 10, 2019 at 11:08 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chat`
--

-- --------------------------------------------------------

--
-- Table structure for table `chat_message`
--

CREATE TABLE `chat_message` (
  `chat_message_id` int(11) NOT NULL,
  `to_user_id` int(11) NOT NULL,
  `from_user_id` int(11) NOT NULL,
  `chat_message` mediumtext COLLATE utf8mb4_bin NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `chat_message`
--

INSERT INTO `chat_message` (`chat_message_id`, `to_user_id`, `from_user_id`, `chat_message`, `timestamp`, `status`) VALUES
(1, 1, 8, 'Hi Mr osama👋', '2019-08-10 08:56:33', 0),
(3, 1, 8, 'hi mr', '2019-08-10 08:58:50', 0),
(4, 1, 8, '👋👋', '2019-08-10 08:58:56', 0),
(5, 8, 1, 'hi mohamed ', '2019-08-10 08:59:11', 0),
(6, 1, 8, 'hi mr osama', '2019-08-10 08:59:41', 1),
(7, 0, 4, '<div>hi every body</div><div><br></div>', '2019-08-10 09:02:27', 0),
(8, 0, 1, 'hi mayar', '2019-08-10 09:02:35', 0),
(9, 0, 8, 'hi mr osama', '2019-08-10 09:02:43', 0),
(10, 0, 4, '<p> <img src=\"upload/traversy.jpg\" class=\"img-thumbnail\">  </p>', '2019-08-10 09:03:05', 0);

-- --------------------------------------------------------

--
-- Table structure for table `login_details`
--

CREATE TABLE `login_details` (
  `login_details_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `last_activity` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_type` enum('no','yes') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login_details`
--

INSERT INTO `login_details` (`login_details_id`, `user_id`, `last_activity`, `is_type`) VALUES
(1, 1, '2019-08-10 08:35:48', 'no'),
(2, 2, '2019-08-10 08:39:39', 'no'),
(3, 3, '2019-08-10 08:42:08', 'no'),
(4, 4, '2019-08-10 08:42:59', 'no'),
(5, 5, '2019-08-10 08:45:04', 'no'),
(6, 1, '2019-08-10 08:46:20', 'no'),
(7, 8, '2019-08-10 09:03:23', 'no'),
(8, 1, '2019-08-10 09:03:20', 'no'),
(9, 4, '2019-08-10 09:03:50', 'no'),
(10, 8, '2019-08-10 09:07:37', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_pass` varchar(100) NOT NULL,
  `profile_pic` varchar(100) NOT NULL,
  `user_gender` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `user_email`, `user_pass`, `profile_pic`, `user_gender`) VALUES
(1, 'Osama Mohamed', 'osama@gmail.com', 'd0b5d73b4f38a9ae1f4dda7938a70eaf054576f1', 'upload/osama.jpg', '1'),
(2, 'maximilian', 'max@gmail.com', 'd7f4aeba7fb8ad3839f7aa3b93e0f5c8971d4d3d', 'upload/max.jpg', '1'),
(3, 'Traversy Media', 'traversy@gmail.com', 'd6c8618b699853f85a68a876170ce2db208ddb9d', 'upload/traversy.jpg', '1'),
(4, 'mariam hossam', 'mariam@gmail.com', 'c95ddf1e378b54ea6e1b0e0000a5a9121d2fd3e1', 'upload/new_0400_00006_1x.png', '2'),
(5, 'default female', 'default2@gmail.com', '02afb50fd0899c192ec5d80e8668e2bf80c2d126', 'https://www.w3schools.com/howto/img_avatar2.png', '2'),
(6, 'default male', 'default@gmail.com', '8748d3e5b7385b19ac6f78f59ec63418a450586f', 'https://www.w3schools.com/w3images/avatar2.png', '1'),
(8, 'Mohamed Hossam', 'mohamed@gmail.com', 'c0735d958c03a58be71e84b16650aeb762840107', 'upload/rami.jpg', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chat_message`
--
ALTER TABLE `chat_message`
  ADD PRIMARY KEY (`chat_message_id`);

--
-- Indexes for table `login_details`
--
ALTER TABLE `login_details`
  ADD PRIMARY KEY (`login_details_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chat_message`
--
ALTER TABLE `chat_message`
  MODIFY `chat_message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `login_details`
--
ALTER TABLE `login_details`
  MODIFY `login_details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
