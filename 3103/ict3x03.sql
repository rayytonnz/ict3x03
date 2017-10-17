-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 17, 2017 at 09:45 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ict3x03`
--

-- --------------------------------------------------------

--
-- Table structure for table `credit`
--

CREATE TABLE `credit` (
  `creditID` int(11) NOT NULL,
  `creditName` varchar(100) NOT NULL,
  `creditPrice` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `credit`
--

INSERT INTO `credit` (`creditID`, `creditName`, `creditPrice`) VALUES
(1, '5 DOLLAR', 7),
(2, '10 DOLLAR', 13),
(3, '15 DOLLAR', 20),
(4, '20 DOLLAR', 26),
(5, '30 DOLLAR', 39),
(6, '50 DOLLAR', 65);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `custID` int(11) NOT NULL,
  `custEmail` varchar(100) NOT NULL,
  `custName` varchar(100) NOT NULL,
  `custMobile` int(11) NOT NULL,
  `custCredit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`custID`, `custEmail`, `custName`, `custMobile`, `custCredit`) VALUES
(1, 'wongnz1992@hotmail.com', 'ningzhi', 97705168, 7);

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `historyID` int(11) NOT NULL,
  `historyCustomer` varchar(100) NOT NULL,
  `historyCreditID` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`historyID`, `historyCustomer`, `historyCreditID`) VALUES
(1, 'wongnz1992@hotmail.com', '1');

-- --------------------------------------------------------

--
-- Table structure for table `numbers`
--

CREATE TABLE `numbers` (
  `numberMobile` int(8) NOT NULL,
  `numberCode` int(6) NOT NULL,
  `numberVerified` int(11) NOT NULL,
  `numberCashier` varchar(100) NOT NULL,
  `numberVoucherID` int(11) NOT NULL,
  `numberdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `numbers`
--

INSERT INTO `numbers` (`numberMobile`, `numberCode`, `numberVerified`, `numberCashier`, `numberVoucherID`, `numberdate`) VALUES
(97705168, 567890, 0, 'siyuan@hotmail.com', 1, '2017-10-12 08:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `userEmail` varchar(100) NOT NULL,
  `userPassword` varchar(40) NOT NULL,
  `userRole` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `userEmail`, `userPassword`, `userRole`) VALUES
(1, 'siyuan@hotmail.com', 'admin', '1'),
(2, 'fangyu95@hotmail.sg', '_Y6JO8NHS6', '1'),
(3, 'wongnz1992@hotmail.com', 'admin', '2'),
(4, 'joseph@hotmail.com', 'admin', '3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `credit`
--
ALTER TABLE `credit`
  ADD PRIMARY KEY (`creditID`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`custID`),
  ADD KEY `custEmail` (`custEmail`),
  ADD KEY `custMobile` (`custMobile`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`historyID`);

--
-- Indexes for table `numbers`
--
ALTER TABLE `numbers`
  ADD PRIMARY KEY (`numberMobile`),
  ADD KEY `numberCashier` (`numberCashier`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`),
  ADD KEY `userEmail` (`userEmail`),
  ADD KEY `userEmail_2` (`userEmail`),
  ADD KEY `userEmail_3` (`userEmail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `credit`
--
ALTER TABLE `credit`
  MODIFY `creditID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `custID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `historyID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_ibfk_1` FOREIGN KEY (`custEmail`) REFERENCES `users` (`userEmail`);

--
-- Constraints for table `numbers`
--
ALTER TABLE `numbers`
  ADD CONSTRAINT `numbers_ibfk_1` FOREIGN KEY (`numberMobile`) REFERENCES `customers` (`custMobile`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
