-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 25, 2024 at 09:01 AM
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

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `id` int(11) NOT NULL,
  `name` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(29, 34, 'Cheese Burger', 150, 'Available'),
(30, 34, 'Cheese Sandwich', 150, 'Available'),
(31, 34, 'Chicken Burger', 185, 'Available'),
(32, 34, 'Spicy Burger', 250, 'Available'),
(33, 34, 'Chicken Wings', 250, 'Available'),
(34, 37, 'French Fries', 100, 'Available'),
(35, 37, 'Chicken Nuggets', 125, 'Available'),
(36, 37, 'Ice Cream', 150, 'Available'),
(37, 37, 'Cheese Cake', 140, 'Available'),
(38, 38, 'Green Tea', 100, 'Available'),
(39, 38, 'Iced Chocolate', 120, 'Available'),
(40, 38, 'Lemon Tea', 80, 'Available'),
(41, 38, 'Avocado Juice', 130, 'Available');

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
(34, 'Main Course'),
(37, 'Appetizer'),
(38, 'Drinks');

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
(33, 'Table 1', 2, 'Active', 'Available'),
(34, 'Table 2', 4, 'Active', 'Available'),
(35, 'Table 3', 2, 'Active', 'Available'),
(36, 'Table 4', 5, 'Active', 'Available'),
(37, 'Table 5', 3, 'Active', 'Available');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `bill`
--
ALTER TABLE `bill`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `employeeinformation`
--
ALTER TABLE `employeeinformation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `menu_category`
--
ALTER TABLE `menu_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `tables`
--
ALTER TABLE `tables`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bill`
--
ALTER TABLE `bill`
  ADD CONSTRAINT `aa1` FOREIGN KEY (`assignedAccount`) REFERENCES `account` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `aa2` FOREIGN KEY (`assignedTable`) REFERENCES `tables` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

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
