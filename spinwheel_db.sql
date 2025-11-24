-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2025 at 09:37 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spinwheel_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `spins`
--

CREATE TABLE `spins` (
  `id` int(11) NOT NULL,
  `user_ip` varchar(50) DEFAULT NULL,
  `prize_name` varchar(50) DEFAULT NULL,
  `segment_index` int(11) DEFAULT NULL,
  `spin_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `spins`
--

INSERT INTO `spins` (`id`, `user_ip`, `prize_name`, `segment_index`, `spin_time`, `user_id`) VALUES
(1, '::1', '50% OFF', 5, '2025-11-24 17:49:53', NULL),
(2, '::1', 'Better Luck Next Time', 2, '2025-11-24 17:55:09', NULL),
(3, '::1', 'Better Luck Next Time', 4, '2025-11-24 17:55:15', NULL),
(4, '::1', 'Better Luck Next Time', 4, '2025-11-24 17:55:20', NULL),
(5, '::1', 'Better Luck Next Time', 2, '2025-11-24 17:55:25', NULL),
(6, '::1', 'Better Luck Next Time', 0, '2025-11-24 17:55:31', NULL),
(7, '::1', '50% OFF', 1, '2025-11-24 17:55:50', NULL),
(8, '::1', '50% OFF', 1, '2025-11-24 17:55:55', NULL),
(9, '::1', '100% OFF', 3, '2025-11-24 17:56:00', NULL),
(10, '::1', '100% OFF', 3, '2025-11-24 17:56:05', NULL),
(11, '::1', 'Better Luck Next Time', 4, '2025-11-24 17:56:10', NULL),
(12, '::1', 'Better Luck Next Time', 0, '2025-11-24 18:37:22', NULL),
(13, '::1', 'Better Luck Next Time', 2, '2025-11-24 18:44:03', 1),
(14, '::1', 'Better Luck Next Time', 4, '2025-11-24 18:45:00', 2),
(15, '::1', '50% OFF', 5, '2025-11-24 19:08:54', 2),
(16, '::1', 'Better Luck Next Time', 2, '2025-11-24 19:27:16', 5),
(17, '::1', 'Better Luck Next Time', 0, '2025-11-24 19:27:22', 5),
(18, '::1', 'Better Luck Next Time', 2, '2025-11-24 19:27:28', 5),
(19, '::1', 'Better Luck Next Time', 4, '2025-11-24 19:27:33', 5),
(20, '::1', '50% OFF', 1, '2025-11-24 19:27:38', 5),
(21, '::1', '100% OFF', 3, '2025-11-24 19:27:44', 5),
(22, '::1', '50% OFF', 5, '2025-11-24 19:49:27', 1),
(23, '::1', '50% OFF', 1, '2025-11-24 19:49:32', 1),
(24, '::1', '100% OFF', 3, '2025-11-24 19:49:37', 1),
(25, '::1', '100% OFF', 3, '2025-11-24 19:49:42', 1),
(26, '::1', 'Better Luck Next Time', 0, '2025-11-24 19:49:48', 1),
(27, '::1', '100% OFF', 3, '2025-11-24 19:49:54', 1),
(28, '::1', '100% OFF', 3, '2025-11-24 19:49:59', 1),
(29, '::1', '50% OFF', 5, '2025-11-24 19:50:04', 1),
(30, '::1', '50% OFF', 1, '2025-11-24 19:50:10', 1),
(31, '::1', '50% OFF', 5, '2025-11-24 19:50:15', 1),
(32, '::1', '100% OFF', 3, '2025-11-24 19:50:21', 1),
(33, '::1', 'Better Luck Next Time', 0, '2025-11-24 19:50:26', 1),
(34, '::1', 'Better Luck Next Time', 4, '2025-11-24 19:50:32', 1),
(35, '::1', '50% OFF', 5, '2025-11-24 19:50:38', 1),
(36, '::1', '50% OFF', 1, '2025-11-24 19:50:44', 1),
(37, '::1', 'Better Luck Next Time', 2, '2025-11-24 19:50:50', 1),
(38, '::1', '100% OFF', 3, '2025-11-24 19:51:55', 1),
(39, '::1', '100% OFF', 3, '2025-11-24 19:52:01', 1),
(40, '::1', '100% OFF', 3, '2025-11-24 19:52:07', 1),
(41, '::1', '100% OFF', 3, '2025-11-24 19:52:12', 1),
(42, '::1', 'Better Luck Next Time', 2, '2025-11-24 19:53:00', 1),
(43, '::1', 'Better Luck Next Time', 0, '2025-11-24 19:53:06', 1),
(44, '::1', 'Better Luck Next Time', 0, '2025-11-24 19:53:11', 1),
(45, '::1', 'Better Luck Next Time', 4, '2025-11-24 19:53:38', 1),
(46, '::1', 'Better Luck Next Time', 0, '2025-11-24 19:53:43', 1),
(47, '::1', 'Better Luck Next Time', 4, '2025-11-24 19:53:49', 1),
(48, '::1', '50% OFF', 1, '2025-11-24 19:53:54', 1),
(49, '::1', 'Better Luck Next Time', 0, '2025-11-24 19:53:59', 1),
(50, '::1', 'Better Luck Next Time', 4, '2025-11-24 19:54:05', 1),
(51, '::1', 'Better Luck Next Time', 2, '2025-11-24 19:54:10', 1),
(52, '::1', '50% OFF', 5, '2025-11-24 19:55:27', 1),
(53, '::1', '50% OFF', 5, '2025-11-24 19:55:33', 1),
(54, '::1', '20% OFF', 2, '2025-11-24 19:55:38', 1),
(55, '::1', '100% OFF', 3, '2025-11-24 19:55:45', 1),
(56, '::1', '50% OFF', 1, '2025-11-24 19:55:50', 1),
(57, '::1', '20% OFF', 4, '2025-11-24 19:55:55', 1),
(58, '::1', 'Better Luck Next Time', 0, '2025-11-24 19:56:33', 1),
(59, '::1', '50% OFF', 1, '2025-11-24 20:21:59', 1),
(60, '::1', 'Better Luck Next Time', 4, '2025-11-24 20:23:10', 1),
(61, '::1', 'Better Luck Next Time', 4, '2025-11-24 20:23:16', 1),
(62, '::1', 'Better Luck Next Time', 2, '2025-11-24 20:23:23', 1),
(63, '::1', 'Better Luck Next Time', 2, '2025-11-24 20:30:24', 6);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'admin', '0192023a7bbd73250516f069df18b500', 'admin'),
(2, 'user1', '827ccb0eea8a706c4c34a16891f84e7b', 'user'),
(3, 'hi', '827ccb0eea8a706c4c34a16891f84e7b', 'user'),
(5, 'ronit', '827ccb0eea8a706c4c34a16891f84e7b', 'user'),
(6, 'ronit roy', '827ccb0eea8a706c4c34a16891f84e7b', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `spins`
--
ALTER TABLE `spins`
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
-- AUTO_INCREMENT for table `spins`
--
ALTER TABLE `spins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
