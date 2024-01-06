-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 05, 2024 at 03:36 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restomanagement`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(500) NOT NULL,
  `role` varchar(64) DEFAULT 'None',
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `email`, `password`, `role`, `created_at`) VALUES
(22, 'lanceruzel1202@gmail.com', '$2y$12$rmqDHPyUYIoUtx14POcZpOBxhpx4KczEmx2Y.svND2yUO7CcRXDTa', 'Receptionist', '2023-12-17');

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

CREATE TABLE `bill` (
  `id` int(11) NOT NULL,
  `assignedAccount` int(11) DEFAULT NULL,
  `assignedTable` int(11) DEFAULT NULL,
  `total` int(11) NOT NULL,
  `orderStatus` varchar(64) NOT NULL DEFAULT 'Pending',
  `paymentStatus` varchar(64) NOT NULL DEFAULT 'Pending',
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bill`
--

INSERT INTO `bill` (`id`, `assignedAccount`, `assignedTable`, `total`, `orderStatus`, `paymentStatus`, `created_at`) VALUES
(84, 22, 20, 65, 'Completed', 'Completed', '2023-12-20 23:03:27'),
(85, 22, 20, 66, 'Completed', 'Completed', '2023-12-20 23:07:30'),
(86, 22, 20, 24, 'Completed', 'Completed', '2023-12-20 23:14:24'),
(87, 22, 21, 64, 'Completed', 'Completed', '2023-12-20 23:17:02'),
(88, 22, 20, 108, 'Completed', 'Completed', '2023-12-20 23:22:11'),
(89, 22, 20, 24, 'Completed', 'Completed', '2023-12-21 16:49:07');

-- --------------------------------------------------------

--
-- Table structure for table `employeeinformation`
--

CREATE TABLE `employeeinformation` (
  `id` int(11) NOT NULL,
  `accountID` int(11) NOT NULL,
  `firstName` varchar(64) NOT NULL,
  `middleName` varchar(64) NOT NULL,
  `lastName` varchar(64) NOT NULL,
  `birthdate` date NOT NULL,
  `gender` varchar(6) NOT NULL,
  `address` varchar(255) NOT NULL,
  `contact` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employeeinformation`
--

INSERT INTO `employeeinformation` (`id`, `accountID`, `firstName`, `middleName`, `lastName`, `birthdate`, `gender`, `address`, `contact`) VALUES
(10, 22, 'Lance Ruzel', 'Caballes', 'Ambrocio', '2023-12-04', 'Male', 'Limay, Bataan', '09205524353');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `categoryID` int(11) DEFAULT NULL,
  `menuName` varchar(128) NOT NULL,
  `menuPrice` double NOT NULL,
  `availability` varchar(24) NOT NULL DEFAULT 'Available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `categoryID`, `menuName`, `menuPrice`, `availability`) VALUES
(6, 27, 'Menu 1', 1, 'Available'),
(7, 25, 'Dessert 1', 2, 'Available'),
(8, 25, 'Sisig', 21, 'Available');

-- --------------------------------------------------------

--
-- Table structure for table `menu_category`
--

CREATE TABLE `menu_category` (
  `id` int(11) NOT NULL,
  `categoryName` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu_category`
--

INSERT INTO `menu_category` (`id`, `categoryName`) VALUES
(25, 'Appetaizer'),
(27, 'Dessertt'),
(28, 'Drinks');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `billID` int(11) NOT NULL,
  `menuID` int(11) DEFAULT NULL,
  `price` double NOT NULL,
  `quantity` int(11) NOT NULL,
  `total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `billID`, `menuID`, `price`, `quantity`, `total`) VALUES
(59, 84, 8, 21, 3, 63),
(60, 84, 7, 2, 1, 2),
(61, 85, 8, 21, 3, 63),
(62, 85, 7, 2, 1, 2),
(63, 85, 6, 1, 1, 1),
(64, 86, 8, 21, 1, 21),
(65, 86, 7, 2, 1, 2),
(66, 86, 6, 1, 1, 1),
(67, 87, 8, 21, 3, 63),
(68, 87, 6, 1, 1, 1),
(69, 88, 8, 21, 10, 105),
(70, 88, 7, 2, 1, 2),
(71, 88, 6, 1, 1, 1),
(72, 89, 8, 21, 1, 21),
(73, 89, 7, 2, 1, 2),
(74, 89, 6, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tables`
--

CREATE TABLE `tables` (
  `id` int(11) NOT NULL,
  `tableName` varchar(64) NOT NULL,
  `tableCapacity` int(11) NOT NULL,
  `status` varchar(24) NOT NULL,
  `availability` varchar(24) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tables`
--

INSERT INTO `tables` (`id`, `tableName`, `tableCapacity`, `status`, `availability`) VALUES
(20, 'Table 22', 224, 'Active', 'Available'),
(21, 'Tale Name', 22, 'Active', 'Available'),
(22, 'Table 22', 23, 'Active', 'Available');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`id`),
  ADD KEY `aa1` (`assignedAccount`),
  ADD KEY `aa2` (`assignedTable`);

--
-- Indexes for table `employeeinformation`
--
ALTER TABLE `employeeinformation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Constraint 1` (`accountID`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Constraint 2` (`categoryID`);

--
-- Indexes for table `menu_category`
--
ALTER TABLE `menu_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `billdw` (`billID`),
  ADD KEY `dsdsfdsf` (`menuID`);

--
-- Indexes for table `tables`
--
ALTER TABLE `tables`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `bill`
--
ALTER TABLE `bill`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `employeeinformation`
--
ALTER TABLE `employeeinformation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `menu_category`
--
ALTER TABLE `menu_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `tables`
--
ALTER TABLE `tables`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bill`
--
ALTER TABLE `bill`
  ADD CONSTRAINT `aa1` FOREIGN KEY (`assignedAccount`) REFERENCES `account` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `aa2` FOREIGN KEY (`assignedTable`) REFERENCES `tables` (`id`);

--
-- Constraints for table `employeeinformation`
--
ALTER TABLE `employeeinformation`
  ADD CONSTRAINT `Constraint 1` FOREIGN KEY (`accountID`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `Constraint 2` FOREIGN KEY (`categoryID`) REFERENCES `menu_category` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `billdw` FOREIGN KEY (`billID`) REFERENCES `bill` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `dsdsfdsf` FOREIGN KEY (`menuID`) REFERENCES `menu` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
