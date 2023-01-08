-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 08, 2023 at 12:56 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `repairs`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` int(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profilepic` varchar(100) NOT NULL,
  `creationdate` timestamp NOT NULL DEFAULT current_timestamp(),
  `updationdate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `email`, `mobile`, `password`, `profilepic`, `creationdate`, `updationdate`) VALUES
(1, 'ADMIN', 'admin@gmail.com', 712345678, 'ffc6c627e5533458e860427ec2e54ad1', 'd41d8cd98f00b204e9800998ecf8427e1657009512.jpg', '2019-11-14 17:36:19', '2023-01-08 11:50:46');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `amount` float NOT NULL DEFAULT 0,
  `balance` float NOT NULL DEFAULT 0,
  `refno` varchar(40) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `userid` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `amount`, `balance`, `refno`, `status`, `userid`, `date_created`) VALUES
(18, 1000, 0, 'erdadgfgggg', 0, 3, '2022-07-26 16:58:35'),
(20, 1500, 0, 'dhhdshdsg', 0, 7, '2022-07-26 18:40:44'),
(21, 0, 0, '', 0, 0, '2022-07-26 19:02:22'),
(22, 600, 0, 'mnhugftdkjhjk', 0, 7, '2022-07-26 19:41:43'),
(23, 0, 0, '', 0, 0, '2022-07-26 21:35:19'),
(24, 200, 0, 'dffgghh', 0, 7, '2022-07-27 07:05:35'),
(25, 3000, 0, 'sdfg', 0, 7, '2022-07-27 07:09:33'),
(26, 400, 0, 'asdffb', 0, 7, '2022-07-27 07:14:30'),
(27, 400, 0, 'werrt', 0, 9, '2022-07-27 08:15:59'),
(28, 300, 0, 'weerr', 1, 10, '2022-07-27 08:26:07'),
(29, 1500, 0, 'sddf', 1, 9, '2022-07-27 08:29:25'),
(30, 300, 0, 'dfsgsfd', 1, 3, '2022-07-27 08:52:47'),
(31, 15000, 0, 'bvhfhgg', 0, 8, '2022-07-27 08:54:18');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `pname` varchar(30) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL,
  `pimage` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `pname`, `date_created`, `status`, `pimage`) VALUES
(3, 'Tecno Spark 12', '2022-07-02 21:45:19', 1, ''),
(4, 'Itel a24', '2022-07-02 21:46:25', 1, ''),
(6, 'Computer', '2022-07-04 09:03:30', 1, ''),
(9, 'Samsung galaxy a20', '2022-07-27 02:22:44', 1, ''),
(10, 'car', '2022-07-27 07:20:52', 1, ''),
(11, 'fridge', '2022-07-27 08:22:48', 1, ''),
(12, 'tecno spark 4', '2022-07-27 12:34:33', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `repairs`
--

CREATE TABLE `repairs` (
  `id` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0 = pending, 1= Approved, 2 = In-Progress, 3 = Checking, 4 = Done, 5= Cancelled ',
  `price` float NOT NULL DEFAULT 0,
  `userid` int(11) NOT NULL,
  `date_created` date NOT NULL DEFAULT current_timestamp(),
  `done_date` date DEFAULT NULL,
  `pay_status` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `repairs`
--

INSERT INTO `repairs` (`id`, `pid`, `sid`, `status`, `price`, `userid`, `date_created`, `done_date`, `pay_status`) VALUES
(12, 3, 1, 0, 200, 3, '2022-07-04', NULL, ''),
(27, 3, 6, 4, 160, 7, '2022-07-26', NULL, ''),
(29, 9, 13, 1, 300, 7, '2022-07-27', '2022-07-30', 'Paid'),
(31, 6, 9, 1, 300, 7, '2022-07-27', '0000-00-00', 'Paid'),
(32, 10, 15, 1, 5000, 7, '2022-07-27', '0000-00-00', 'Paid'),
(33, 3, 1, 1, 200, 7, '2022-07-27', NULL, ''),
(34, 9, 13, 1, 300, 9, '2022-07-27', '0000-00-00', 'Paid'),
(35, 6, 10, 1, 1500, 9, '2022-07-27', '0000-00-00', 'Paid'),
(36, 3, 8, 0, 1000, 9, '2022-07-27', '0000-00-00', 'Paid'),
(37, 6, 5, 1, 1200, 7, '2022-07-27', NULL, ''),
(38, 3, 1, 1, 200, 7, '2022-07-27', NULL, ''),
(39, 4, 3, 1, 300, 11, '2023-01-08', NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `sname` varchar(30) NOT NULL,
  `price` float NOT NULL DEFAULT 0,
  `pid` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `sname`, `price`, `pid`, `date_created`, `status`) VALUES
(1, 'Battery replacement', 200, 3, '2022-07-02 22:19:06', 1),
(3, 'Cover replacement', 300, 4, '2022-07-03 15:26:03', 1),
(4, 'Binding', 100, 7, '2022-07-04 09:04:16', 1),
(5, 'windos 10 installation', 1200, 6, '2022-07-04 09:05:10', 1),
(6, 'Torch repair', 160, 3, '2022-07-05 01:59:53', 1),
(7, 'Screen Protector', 250, 3, '2022-07-05 02:00:41', 1),
(8, 'Fingerprint ', 1000, 3, '2022-07-05 02:01:20', 1),
(9, 'Ram Replacement', 300, 6, '2022-07-05 11:29:59', 1),
(10, 'Charger Installation', 1500, 6, '2022-07-05 11:30:57', 1),
(11, 'Wind-screen repair', 5000, 5, '2022-07-09 10:12:50', 1),
(12, 'screen repair', 2000, 6, '2022-07-15 14:07:00', 1),
(13, 'screen replacement', 300, 9, '2022-07-27 02:25:45', 1),
(14, 'windsreen', 3000, 10, '2022-07-27 07:21:22', 1),
(15, 'tire repair', 5000, 10, '2022-07-27 07:33:06', 1),
(16, 'stands', 1000, 11, '2022-07-27 08:23:20', 1);

-- --------------------------------------------------------

--
-- Table structure for table `system`
--

CREATE TABLE `system` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `mobile` int(15) NOT NULL,
  `working hours` varchar(100) NOT NULL,
  `profilepic` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `system`
--

INSERT INTO `system` (`id`, `email`, `address`, `mobile`, `working hours`, `profilepic`) VALUES
(1, 'mwanikijophat@gmail.com', '123-Pwani-Kilifi', 12345678, 'dsss', 'd41d8cd98f00b204e9800998ecf8427e1656838090.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(255) NOT NULL,
  `fname` varchar(15) NOT NULL,
  `lname` varchar(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `contact` int(15) NOT NULL,
  `status` int(2) DEFAULT NULL,
  `creationdate` timestamp NOT NULL DEFAULT current_timestamp(),
  `updationdate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `profilepic` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `email`, `password`, `contact`, `status`, `creationdate`, `updationdate`, `profilepic`) VALUES
(11, 'test', 'test', 'test@gmail.com', '5dd1e33dd7e4b1f9a4edc3fcb2520ab0', 0, 1, '2023-01-08 11:39:23', NULL, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `repairs`
--
ALTER TABLE `repairs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system`
--
ALTER TABLE `system`
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
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `repairs`
--
ALTER TABLE `repairs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `system`
--
ALTER TABLE `system`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
