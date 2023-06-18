-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 08, 2023 at 07:03 AM
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
-- Database: `Achiever`
--

-- --------------------------------------------------------

--
-- Table structure for table `Events`
--

CREATE TABLE `Events` (
  `id` int(11) NOT NULL,
  `eventDate` varchar(255) DEFAULT NULL,
  `activityType` varchar(255) DEFAULT NULL,
  `activity` varchar(255) DEFAULT NULL,
  `activityTitle` varchar(255) DEFAULT NULL,
  `activityDuration` varchar(255) DEFAULT NULL,
  `eventDescription` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Events`
--

INSERT INTO `Events` (`id`, `eventDate`, `activityType`, `activity`, `activityTitle`, `activityDuration`, `eventDescription`, `email`) VALUES
(2, 'Mon May 08 2023 00:00:00 GMT+0100 (British Summer Time)', 'Educational', 'Lecture', 'test', '10:12-13:13', 'TEST', 'user@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `assessment1` varchar(255) NOT NULL,
  `assessment2` varchar(255) NOT NULL,
  `assessment3` varchar(255) NOT NULL,
  `assessment4` varchar(255) NOT NULL,
  `assessment5` varchar(255) NOT NULL,
  `weight1` int(3) NOT NULL,
  `weight2` int(3) NOT NULL,
  `weight3` int(3) NOT NULL,
  `weight4` int(3) NOT NULL,
  `weight5` int(3) NOT NULL,
  `results1` float NOT NULL,
  `results2` float NOT NULL,
  `results3` float NOT NULL,
  `results4` float NOT NULL,
  `results5` float NOT NULL,
  `finalGrade` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`id`, `email`, `subject`, `assessment1`, `assessment2`, `assessment3`, `assessment4`, `assessment5`, `weight1`, `weight2`, `weight3`, `weight4`, `weight5`, `results1`, `results2`, `results3`, `results4`, `results5`, `finalGrade`) VALUES
(2, 'user@gmail.com', 'TEST', 'mcq', 'empty', 'empty', 'empty', 'empty', 100, 0, 0, 0, 0, 80, 0, 0, 0, 0, 80);

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id` int(11) NOT NULL,
  `noteTitle` varchar(255) NOT NULL,
  `noteDescription` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`id`, `noteTitle`, `noteDescription`, `email`) VALUES
(2, 'NOTE 1', '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut ', 'user@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `quotes`
--

CREATE TABLE `quotes` (
  `quote` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quotes`
--

INSERT INTO `quotes` (`quote`) VALUES
('\"Stay away from those people who try to disparage your ambitions. Small minds will always do that, but great minds will give you a feeling that you can become great too.” — Mark Twain'),
('\"The road to success and the road to failure are almost exactly the same.\" — Colin R. Davis'),
('\"You cannot plow a field by turning it over in your mind. To begin, begin.\" ―Gordon B. Hinckley'),
('Do the best you can. No one can do more than that.” ―John Wooden'),
('“Be a positive energy trampoline – absorb what you need and rebound more back.” — Dave Carolan'),
('“Develop success from failures. Discouragement and failure are two of the surest stepping stones to success.” —Dale Carnegie'),
('“Dont settle for average. Bring your best to the moment. Then, whether it fails or succeeds, at least you know you gave all you had.” —Angela Bassett'),
('“Either you run the day or the day runs you.” — Jim Rohn'),
('“Experience is a hard teacher because she gives the test first, the lesson afterwards.” ―Vernon Sanders Law'),
('“I am not a product of my circumstances. I am a product of my decisions.” — Stephen R. Covey'),
('“I am so clever that sometimes I don’t understand a single word of what I am saying.” — Oscar Wilde'),
('“I never dreamed about success. I worked for it.” —Estée Lauder'),
('“I’d rather regret the things I’ve done than regret the things I haven’t done.” —Lucille Ball'),
('“Just one small positive thought in the morning can change your whole day.” — Dalai Lama'),
('“Love your family, work super hard, live your passion.” — Gary Vaynerchuk'),
('“Nature has given us all the pieces required to achieve exceptional wellness and health, but has left it to us to put these pieces together.”—Diane McLaren'),
('“Opportunities dont happen, you create them.” — Chris Grosser'),
('“Opportunity is missed by most people because it is dressed in overalls and looks like work.” — Thomas Edison'),
('“Setting goals is the first step in turning the invisible into the visible.” — Tony Robbins'),
('“Success is getting what you want, happiness is wanting what you get.” ―W. P. Kinsella'),
('“Success usually comes to those who are too busy looking for it.” — Henry David Thoreau'),
('“The elevator to success is out of order. You’ll have to use the stairs, one step at a time.” — Joe Girard'),
('“The greatest discovery of my generation is that a human being can alter his life by altering his attitudes.” — William James '),
('“There are three ways to ultimate success: The first way is to be kind. The second way is to be kind. The third way is to be kind.” —Mister Rogers'),
('“We cannot solve problems with the kind of thinking we employed when we came up with them.” — Albert Einstein'),
('“When you arise in the morning think of what a privilege it is to be alive, to think, to enjoy, to love…” – Marcus Aurelius'),
('“Work until your bank account looks like a phone number.” — Unknown '),
('“You can get everything in life you want if you will just help enough other people get what they want.” —Zig Ziglar ');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `task` varchar(91) NOT NULL,
  `email` varchar(255) NOT NULL,
  `status` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `task`, `email`, `status`) VALUES
(2, 'TASK 1', 'user@gmail.com', 'incomplete'),
(3, 'test', 'user@gmail.com', 'incomplete');

-- --------------------------------------------------------

--
-- Table structure for table `UserData`
--

CREATE TABLE `UserData` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `favAnimal` varchar(255) NOT NULL,
  `favColor` varchar(255) NOT NULL,
  `course` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Login user details';

--
-- Dumping data for table `UserData`
--

INSERT INTO `UserData` (`id`, `email`, `password`, `firstname`, `lastname`, `favAnimal`, `favColor`, `course`) VALUES
(2, 'user@gmail.com', '$2y$10$a6SiKfo4MijpoIjT2AuSI.233DYgC9YKNDn94ju6HqfchWaWky9NG', 'Valentin', 'Madzharov', ' cat', ' red', 'Computer science');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Events`
--
ALTER TABLE `Events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quotes`
--
ALTER TABLE `quotes`
  ADD PRIMARY KEY (`quote`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `UserData`
--
ALTER TABLE `UserData`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Events`
--
ALTER TABLE `Events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `UserData`
--
ALTER TABLE `UserData`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
