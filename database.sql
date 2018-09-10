-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 10, 2018 at 02:31 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quantox`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `registerUser` (IN `name1` TEXT, IN `email1` TEXT, IN `pass1` TEXT)  BEGIN
    insert into users (email,name,pass) values (name1,email1,pass1);
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` text CHARACTER SET utf16 COLLATE utf16_bin NOT NULL,
  `name` text CHARACTER SET utf16 COLLATE utf16_bin NOT NULL,
  `pass` text CHARACTER SET utf16 COLLATE utf16_bin NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `name`, `pass`) VALUES
(10, 'petarpetrovic@gmail.com', 'Petar Petrovic', 'e084f8bb4416edc30daa26941f28f5df435b01f7'),
(9, 'nikolapejic95@gmail.com', 'Nikola Pejic', 'fcc37409a29e90d0fced5c26b3f53795d7376083'),
(11, 'testingthisout@gmail.com', 'Pera Mika', 'fcc37409a29e90d0fced5c26b3f53795d7376083'),
(12, 'testingmail@gmail.com', 'Nemanje Nemanjic', '3da541559918a808c2402bba5012f6c60b27661c');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
