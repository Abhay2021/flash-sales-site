-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 04, 2019 at 03:56 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mvc`
--

-- --------------------------------------------------------

--
-- Table structure for table `deals`
--

CREATE TABLE `deals` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` float NOT NULL,
  `discounted_price` float NOT NULL,
  `quantity` int(11) NOT NULL,
  `remaining_quantity` int(11) DEFAULT NULL,
  `publish_date` date NOT NULL,
  `image` varchar(255) NOT NULL,
  `added_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `publish` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `deals`
--

INSERT INTO `deals` (`id`, `title`, `description`, `price`, `discounted_price`, `quantity`, `remaining_quantity`, `publish_date`, `image`, `added_date`, `publish`) VALUES
(1, 'deal today', 'deals awesome', 200, 150, 5, 3, '2019-07-27', 'Penguins.jpg', '2019-08-03 07:06:38', 1),
(2, 'super', 'super sale', 350, 250, 3, 0, '2019-08-03', 'Tulips.jpg', '2019-08-03 07:07:23', 1),
(3, 'dfvcx', 'v', 250, 150, 11, 9, '2019-08-01', 'Desert.jpg', '2019-08-03 07:07:10', 1);

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) NOT NULL,
  `ip` varchar(20) NOT NULL,
  `login_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login_attempts`
--

INSERT INTO `login_attempts` (`id`, `ip`, `login_time`) VALUES
(1, '127.0.0.1', '2019-08-04 13:25:41'),
(2, '127.0.0.1', '2019-08-04 13:25:58'),
(3, '127.0.0.1', '2019-08-04 13:26:07'),
(4, '127.0.0.1', '2019-08-04 13:26:15'),
(5, '127.0.0.1', '2019-08-04 13:26:35'),
(6, '127.0.0.1', '2019-08-04 13:29:02'),
(7, '127.0.0.1', '2019-08-04 13:36:18'),
(8, '127.0.0.1', '2019-08-04 13:52:56'),
(9, '127.0.0.1', '2019-08-04 13:53:05');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `deals_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '1',
  `added_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `deals_id`, `quantity`, `added_date`, `status`) VALUES
(1, 2, 1, 1, '2019-07-29 18:21:50', 1),
(2, 3, 1, 1, '2019-07-30 04:03:17', 1),
(3, 3, 2, 1, '2019-07-30 04:34:49', 1),
(4, 2, 2, 1, '2019-07-30 12:53:15', 1),
(5, 2, 3, 1, '2019-08-01 07:04:07', 1),
(6, 6, 1, 1, '2019-08-03 07:06:21', 1),
(7, 6, 3, 1, '2019-08-03 07:06:56', 1),
(8, 6, 2, 1, '2019-08-03 07:07:23', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `admin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `image`, `active`, `admin`) VALUES
(2, 'abhay', 'abhay@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', NULL, 1, 0),
(3, 'vikram', 'vikram@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', NULL, 1, 0),
(4, 'shankar', 'shankar@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', NULL, 1, 0),
(5, 'admin', 'admin@gmail.com', '$2y$10$RbQL1ue43SzvZ3xbbT0YUeaNeyrkvWmtoU3dv4GkzNM8ntzo9D4gi', 'Penguins.jpg', 1, 1),
(6, 'smith', 'smith@yahoo.com', '$2y$10$dH4A2N3W83C1gEzKzMfAiuuNul9qRa7z6u/ZxwN7gLAGKK4cCfgJe', 'Tulips.jpg', 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `deals`
--
ALTER TABLE `deals`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `publish_date` (`publish_date`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `deals`
--
ALTER TABLE `deals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
