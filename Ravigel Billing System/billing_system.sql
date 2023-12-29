-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 29, 2023 at 12:18 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `billing_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `user` int(11) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `name`, `price`, `user`, `picture`, `status`) VALUES
(6, 'Nakiri', '700.00', 0, 'Screenshot_20210218-182107.png', 'Active'),
(8, 'Intramurals', '350.00', 0, 'png-clipart-intramural-sports-graphic-design-desktop-intramurals-logo-computer-wallpaper.png', 'Active'),
(9, 'Kasal', '70.00', 0, '846dc9d315ee6e94f6c35b183ce2b74c.jpg', 'Active'),
(10, 'Year End', '270.00', 0, 'Year-End-Review-1.png', 'Active'),
(11, 'food contest', '100.00', 0, 'diamond.png', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(128) NOT NULL,
  `event` varchar(128) NOT NULL,
  `user` int(128) NOT NULL,
  `price` decimal(64,0) NOT NULL,
  `payment` varchar(16) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `event`, `user`, `price`, `payment`, `date`) VALUES
(1, 'Nakiri', 2, '700', 'Mastercard', '2023-12-14 00:19:00'),
(2, 'Kasal', 2, '70', 'Paypal', '2023-12-16 13:55:32'),
(3, 'Nakiri', 3, '700', 'Visa', '2023-12-16 15:05:12'),
(4, 'Nakiri', 6, '700', 'GCash', '2023-12-16 15:26:08'),
(5, 'Year End', 6, '270', 'Visa', '2023-12-16 15:29:07');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `level` enum('Admin','Guest') NOT NULL DEFAULT 'Guest',
  `firstname` varchar(32) NOT NULL,
  `lastname` varchar(32) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `email` varchar(32) NOT NULL,
  `status` int(11) DEFAULT 1,
  `is_disabled` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `level`, `firstname`, `lastname`, `gender`, `phone`, `email`, `status`, `is_disabled`) VALUES
(1, 'Shania', 'jm000000', 'Admin', 'Shania', 'Flores', 'F', '09513652687', 'shannynflores8@gmail.com', 1, 0),
(2, 'Ravigel', 'ablen123', 'Admin', 'Ravigel', 'Ablen', 'M', '09513652687', 'ravigel7@gmail.com', 1, 0),
(3, 'queen', 'queen123', 'Guest', 'Queennie', 'Escala', 'F', '09876543362', 'queen@gmail.com', 1, 0),
(4, 'shania', 'lucasbaby', 'Guest', 'Shannyn', 'Flores', 'F', '09876543362', 'shannynflores8@gmail.com', 1, 0),
(5, 'lucas', 'lucasbaby', 'Guest', 'lucas', 'Flores', 'M', '09876543362', 'shannynflores8@gmail.com', 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(128) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
