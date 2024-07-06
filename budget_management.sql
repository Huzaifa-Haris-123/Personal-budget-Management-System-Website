-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 06, 2024 at 10:00 AM
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
-- Database: `budget management`
--

-- --------------------------------------------------------

--
-- Table structure for table `budgettable`
--

CREATE TABLE `budgettable` (
  `UserName` text NOT NULL,
  `Grocery` int(11) NOT NULL DEFAULT 0,
  `Clothing` int(11) NOT NULL DEFAULT 0,
  `Education` int(11) NOT NULL DEFAULT 0,
  `Food` int(11) NOT NULL DEFAULT 0,
  `Transportation` int(11) NOT NULL DEFAULT 0,
  `Entertainment` int(11) NOT NULL DEFAULT 0,
  `Other` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `budgettable`
--

INSERT INTO `budgettable` (`UserName`, `Grocery`, `Clothing`, `Education`, `Food`, `Transportation`, `Entertainment`, `Other`) VALUES
('saad', 0, 20, 30, 50, 10, 0, 20),
('huz', 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

CREATE TABLE `expense` (
  `UserName` text NOT NULL,
  `DOE` date NOT NULL,
  `Amount` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `expense`
--

INSERT INTO `expense` (`UserName`, `DOE`, `Amount`) VALUES
('saad', '2024-06-28', 230),
('huz', '2024-06-29', 0);

-- --------------------------------------------------------

--
-- Table structure for table `expensedetail`
--

CREATE TABLE `expensedetail` (
  `UserName` text NOT NULL,
  `DateEntry` date NOT NULL,
  `Amount` int(11) NOT NULL,
  `Category` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `expensedetail`
--

INSERT INTO `expensedetail` (`UserName`, `DateEntry`, `Amount`, `Category`) VALUES
('saad', '2024-06-28', 30, 'Grocery'),
('saad', '2024-06-28', 10, 'Grocery'),
('saad', '2024-06-28', 10, 'Grocery'),
('saad', '2024-06-29', 10, 'Grocery'),
('saad', '2024-06-29', 20, 'Clothing'),
('saad', '2024-06-29', 20, 'Education'),
('saad', '2024-06-29', 40, 'transportation'),
('saad', '2024-06-29', 50, 'entertainment'),
('saad', '2024-06-29', 30, 'other'),
('saad', '2024-06-29', 10, 'Grocery');

-- --------------------------------------------------------

--
-- Table structure for table `income`
--

CREATE TABLE `income` (
  `UserName` text NOT NULL,
  `DOI` date NOT NULL,
  `Amount` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `income`
--

INSERT INTO `income` (`UserName`, `DOI`, `Amount`) VALUES
('saad', '2024-06-28', 870),
('huz', '2024-06-29', 10050);

-- --------------------------------------------------------

--
-- Table structure for table `incomedetail`
--

CREATE TABLE `incomedetail` (
  `UserName` text NOT NULL,
  `DateEntry` date NOT NULL,
  `Amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `incomedetail`
--

INSERT INTO `incomedetail` (`UserName`, `DateEntry`, `Amount`) VALUES
('saad', '2024-06-28', 50),
('saad', '2024-06-29', 50),
('saad', '2024-06-29', 1000),
('huz', '2024-06-30', 50),
('huz', '2024-06-30', 10000);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `UserName` text NOT NULL,
  `Password` text NOT NULL,
  `DOJ` date NOT NULL,
  `Answer` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserName`, `Password`, `DOJ`, `Answer`) VALUES
('saad', '12', '2024-06-28', 'xioami'),
('huz', '12', '2024-06-29', '12');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
