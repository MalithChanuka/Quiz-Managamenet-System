-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 17, 2022 at 03:44 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `school`
--

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `E_id` int(11) NOT NULL,
  `users_user_id` int(11) DEFAULT NULL,
  `examName` varchar(255) NOT NULL,
  `examDate` varchar(145) NOT NULL,
  `e_duration` int(11) NOT NULL,
  `e_dateTime` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `exams`
--

INSERT INTO `exams` (`E_id`, `users_user_id`, `examName`, `examDate`, `e_duration`, `e_dateTime`, `status`) VALUES
(60, 2, 'mid year exam', '2022/07/15 11:18 AM', 900, '2022-07-17 19:07:00', 2),
(61, 2, 'oop', '2022/07/15 11:52 AM', 1800, '2022-07-15 19:40:00', 2);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `Q_id` int(11) NOT NULL,
  `exams_E_id` int(11) DEFAULT NULL,
  `questionNo` int(11) NOT NULL,
  `question` varchar(1000) NOT NULL,
  `answer1` int(11) NOT NULL,
  `answer2` int(11) NOT NULL,
  `answer3` int(11) NOT NULL,
  `answer4` int(11) NOT NULL,
  `correctAnswer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`Q_id`, `exams_E_id`, `questionNo`, `question`, `answer1`, `answer2`, `answer3`, `answer4`, `correctAnswer`) VALUES
(49, 60, 1, 'solve 1+4?', 1, 2, 5, 6, 0),
(51, 60, 2, 'solve 2+9?', 3, 2, 11, 9, 3),
(52, 60, 3, 'solve 3*4?', 3, 12, 4, 24, 2),
(53, 61, 1, 'solve 3-1?', 2, 13, 3, 5, 1),
(54, 61, 2, 'solve 4+6?', 3, 4, 10, 6, 3),
(55, 61, 3, 'solve 4+4?', 4, 8, 6, 9, 2),
(56, 61, 4, 'solve 5-2?', 5, 3, 2, 1, 2),
(70, 60, 4, 'solve 1+3?', 1, 4, 3, 6, 2);

-- --------------------------------------------------------

--
-- Table structure for table `student_examstatus`
--

CREATE TABLE `student_examstatus` (
  `student_userId` int(11) DEFAULT NULL,
  `student_examId` int(11) DEFAULT NULL,
  `student_status` int(11) DEFAULT NULL,
  `last_question` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_examstatus`
--

INSERT INTO `student_examstatus` (`student_userId`, `student_examId`, `student_status`, `last_question`) VALUES
(3, 60, 0, 1),
(4, 60, 2, 4),
(6, 60, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `student_result`
--

CREATE TABLE `student_result` (
  `result_examID` int(11) DEFAULT NULL,
  `result_userID` int(11) DEFAULT NULL,
  `result_qID` int(11) DEFAULT NULL,
  `st_answer` int(11) DEFAULT NULL,
  `checkAnswer` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_result`
--

INSERT INTO `student_result` (`result_examID`, `result_userID`, `result_qID`, `st_answer`, `checkAnswer`) VALUES
(60, 4, 49, 3, 0),
(60, 4, 51, 1, 0),
(60, 4, 52, 2, 1),
(60, 4, 70, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `userName` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL DEFAULT 'teacher',
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `userName`, `user_type`, `email`, `password`) VALUES
(1, 'peter', 'teacher', 'teacher0@gmail.com', 'teacher0@123'),
(2, 'harry', 'teacher', 'teacher1@gmail.com', 'teacher1@123'),
(3, 'nimal', 'student', 'student0@gmail.com', 'student0@123'),
(4, 'kamal', 'student', 'student1@gmail.com', 'student1@123'),
(5, 'kalum', 'teacher', 'teacher2@gmail.com', 'teacher2@123'),
(6, 'sunil', 'student', 'student2@gmail.com', 'student2@123'),
(11, 'kasuni', 'teacher', 'teacher3@gmail.com', 'teacher3@123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`E_id`),
  ADD KEY `fk_users` (`users_user_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`Q_id`),
  ADD KEY `fk_exams` (`exams_E_id`);

--
-- Indexes for table `student_examstatus`
--
ALTER TABLE `student_examstatus`
  ADD KEY `fk_userId` (`student_userId`),
  ADD KEY `fk_examId` (`student_examId`);

--
-- Indexes for table `student_result`
--
ALTER TABLE `student_result`
  ADD KEY `result_examID` (`result_examID`),
  ADD KEY `result_qID` (`result_qID`),
  ADD KEY `student_result_ibfk_2` (`result_userID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `E_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `Q_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `exams`
--
ALTER TABLE `exams`
  ADD CONSTRAINT `fk_users` FOREIGN KEY (`users_user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `fk_exams` FOREIGN KEY (`exams_E_id`) REFERENCES `exams` (`E_id`) ON DELETE CASCADE;

--
-- Constraints for table `student_examstatus`
--
ALTER TABLE `student_examstatus`
  ADD CONSTRAINT `fk_examId` FOREIGN KEY (`student_examId`) REFERENCES `exams` (`E_id`),
  ADD CONSTRAINT `fk_userId` FOREIGN KEY (`student_userId`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `student_result`
--
ALTER TABLE `student_result`
  ADD CONSTRAINT `student_result_ibfk_1` FOREIGN KEY (`result_examID`) REFERENCES `exams` (`E_id`),
  ADD CONSTRAINT `student_result_ibfk_2` FOREIGN KEY (`result_userID`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `student_result_ibfk_3` FOREIGN KEY (`result_qID`) REFERENCES `questions` (`Q_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
