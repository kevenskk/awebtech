-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2024 at 04:32 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `x5q48`
--

-- --------------------------------------------------------

--
-- Table structure for table `captcha`
--

CREATE TABLE `captcha` (
  `CaptchaID` int(11) NOT NULL,
  `ImagePath` varchar(50) NOT NULL,
  `Solution` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `captcha`
--

INSERT INTO `captcha` (`CaptchaID`, `ImagePath`, `Solution`) VALUES
(1, 'images/captcha1.jpg', 'R84CH'),
(2, 'images/captcha2.jpg', 'RBSKW'),
(3, 'images/captcha3.jpg', 'TK58P');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `ItemID` int(11) NOT NULL,
  `ItemName` varchar(20) NOT NULL,
  `Price` decimal(10,2) NOT NULL,
  `Image` varchar(50) NOT NULL,
  `Type` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`ItemID`, `ItemName`, `Price`, `Image`, `Type`) VALUES
(1, 'Chicken Burger', 5.99, 'images/chickenburger.jpg', 'Burger'),
(2, 'Vegetable Burger', 1.99, 'images/vegetableburger.jpg', 'Burger'),
(3, 'Fish Burger', 5.79, 'images/fishburger.jpg', 'Burger'),
(5, 'BBQ Sandwich', 7.99, 'images/bbqsandwich.jpg', 'Sandwich'),
(6, 'Chicken Sandwich', 4.99, 'images/chickensandwich.jpg', 'Sandwich'),
(7, 'Falafel Sandwich', 2.99, 'images/falafelsandwich.jpg', 'Sandwich'),
(9, ' Fish Sandwich', 3.59, 'images/fishsandwich.jpg', 'Sandwich');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `OrderID` int(11) NOT NULL,
  `Customer` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Phone` varchar(11) NOT NULL,
  `Item` varchar(50) NOT NULL,
  `Price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`OrderID`, `Customer`, `Email`, `Phone`, `Item`, `Price`) VALUES
(70, 'michael', 'michael@gmail.com', '07555555555', 'Vegetable Burger', 1.99),
(71, 'michael', 'michael@gmail.com', '07555555555', 'Chicken Burger', 5.99),
(72, 'michael', 'michael@gmail.com', '07555555555', 'Vegetable Burger', 1.99),
(73, 'michael', 'michael@gmail.com', '07555555555', 'Fish Burger', 5.79),
(75, 'kevin', 'kevinnugget9@gmail.com', '07592264795', 'Vegetable Burger', 1.99),
(76, 'kevin', 'kevinnugget9@gmail.com', '07592264795', 'Fish Burger', 5.79),
(77, 'kevin', 'kevinnugget9@gmail.com', '07592264795', 'Vegetable Burger', 1.99),
(78, 'manager', 'manager@gmail.com', '07592264795', '', 0.00),
(79, 'nat', 'nat@gmail.com', '05555555555', 'Vegetable Burger', 1.99),
(80, 'nat', 'nat@gmail.com', '05555555555', 'Vegetable Burger', 1.99),
(81, 'mellow', 'mellow@gmail.com', '06666666666', 'Vegetable Burger', 1.99),
(82, 'kevinnug', 'kevinnug10@gmail.com', '90333333333', 'Fish Burger', 5.79),
(83, 'kevinnug', 'kevinnug10@gmail.com', '90333333333', 'Vegetable Burger', 1.99),
(84, 'kevinnug', 'kevinnug10@gmail.com', '90333333333', 'Chicken Burger', 5.99),
(85, 'maryam', 'maryam@gmail.com', '07777777777', 'Vegetable Burger', 1.99);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(5) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Phone` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Role` varchar(10) NOT NULL DEFAULT 'Customer'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `Name`, `Phone`, `Email`, `Password`, `Role`) VALUES
(109, 'manager', '07777777777', 'manager@gmail.com', '$2y$10$NdJJoeyaQow/8cM0H/NUkuDO7T2AHZFHwd2oUEQMvXzKMBn/vcs96', 'Manager'),
(110, 'john', '07777777777', 'john@gmail.com', '$2y$10$gRUBo/CCUnIdfbBlYY.Tu.pXbQlWdCOBMz7WOcDVYW/65ZuLw9wVy', 'Customer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `captcha`
--
ALTER TABLE `captcha`
  ADD PRIMARY KEY (`CaptchaID`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`ItemID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`OrderID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `captcha`
--
ALTER TABLE `captcha`
  MODIFY `CaptchaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `ItemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `OrderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
