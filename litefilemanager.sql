-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2023 at 02:59 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `litefilemanager`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

CREATE TABLE `administrator` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `user_type` varchar(50) NOT NULL DEFAULT 'admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`username`, `password`, `user_type`) VALUES
('abdul', '12345', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `phno` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`first_name`, `last_name`, `country`, `subject`, `phno`) VALUES
('Abdul', 'Rahman', 'india', 'ji', '8660509040'),
('Abdul', 'Rahman', 'india', 'hi', '8660509040'),
('shashank', 'bs', 'india', 'hi', '9845828907');

-- --------------------------------------------------------

--
-- Table structure for table `signup_requests`
--

CREATE TABLE `signup_requests` (
  `full_name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `user_type` varchar(50) NOT NULL,
  `reject` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `signup_requests`
--

INSERT INTO `signup_requests` (`full_name`, `username`, `email`, `password`, `user_type`, `reject`) VALUES
('Asim', 'asim', 'asim@gmail.com', '12345', 'admin', 0);

-- --------------------------------------------------------

--
-- Table structure for table `uploaded_internals`
--

CREATE TABLE `uploaded_internals` (
  `user_name` varchar(50) NOT NULL,
  `scheme` varchar(50) NOT NULL,
  `uploaded_date` varchar(50) NOT NULL,
  `semester` varchar(50) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `internal` varchar(50) NOT NULL,
  `document_path` varchar(50) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `uploaded_internals`
--

INSERT INTO `uploaded_internals` (`user_name`, `scheme`, `uploaded_date`, `semester`, `subject`, `internal`, `document_path`, `id`) VALUES
('rahman', '2018', '2023-11-22', 'Semester 1', 'ADA', 'internal 1', 'C:/xampp/htdocs/project/uploadinternals/Invoice-23', 2),
('rahman', '2018', '2023-11-22', 'Semester 1', 'PSP', 'internal 1', 'C:/xampp/htdocs/project/uploadinternals/Invoice-23', 3);

-- --------------------------------------------------------

--
-- Table structure for table `uploaded_notes`
--

CREATE TABLE `uploaded_notes` (
  `user_name` varchar(50) NOT NULL,
  `scheme` varchar(50) NOT NULL,
  `uploaded_date` varchar(50) NOT NULL,
  `semester` varchar(50) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `module` varchar(50) NOT NULL,
  `document_path` varchar(50) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `uploaded_notes`
--

INSERT INTO `uploaded_notes` (`user_name`, `scheme`, `uploaded_date`, `semester`, `subject`, `module`, `document_path`, `id`) VALUES
('rahman', '2018', '2023-11-25', 'Semester 1', 'PSP', 'module 1', 'C:/xampp/htdocs/project/notesuploads/CIPS-2012-011', 3);

-- --------------------------------------------------------

--
-- Table structure for table `uploaded_prev`
--

CREATE TABLE `uploaded_prev` (
  `user_name` varchar(50) NOT NULL,
  `scheme` varchar(50) NOT NULL,
  `uploaded_date` varchar(50) NOT NULL,
  `semester` varchar(50) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `document_path` varchar(50) NOT NULL,
  `module` varchar(10) NOT NULL DEFAULT 'N/A',
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `uploaded_prev`
--

INSERT INTO `uploaded_prev` (`user_name`, `scheme`, `uploaded_date`, `semester`, `subject`, `document_path`, `module`, `id`) VALUES
('rahman', '2018', '2023-11-22', 'Semester 1', 'ADA', 'C:/xampp/htdocs/project/prevuploads/Final_Approval', 'N/A', 3);

-- --------------------------------------------------------

--
-- Table structure for table `userregister`
--

CREATE TABLE `userregister` (
  `full_name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `user_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userregister`
--

INSERT INTO `userregister` (`full_name`, `username`, `email`, `password`, `user_type`) VALUES
('Abdul Rahman', 'rahman', 'rahmanckm018@gmail.com', '12345', 'admin'),
('Shashank B S', 'shashank', 'shashank@gmail.com', '12345', 'user'),
('vimesh', 'vimersh', 'vim@gmail.com', '12345', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `uploaded_internals`
--
ALTER TABLE `uploaded_internals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uploaded_notes`
--
ALTER TABLE `uploaded_notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uploaded_prev`
--
ALTER TABLE `uploaded_prev`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `uploaded_internals`
--
ALTER TABLE `uploaded_internals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `uploaded_notes`
--
ALTER TABLE `uploaded_notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `uploaded_prev`
--
ALTER TABLE `uploaded_prev`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
