-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 06, 2026 at 04:24 PM
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
-- Database: `edulens`
--

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `class_id` int(11) NOT NULL,
  `class_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`class_id`, `class_name`) VALUES
(1, 'Form One'),
(2, 'Form Two'),
(3, 'Form Three'),
(4, 'Form Four');

-- --------------------------------------------------------

--
-- Table structure for table `difficulty_levels`
--

CREATE TABLE `difficulty_levels` (
  `difficulty_id` int(11) NOT NULL,
  `level_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `difficulty_levels`
--

INSERT INTO `difficulty_levels` (`difficulty_id`, `level_name`) VALUES
(1, 'Easy'),
(2, 'Medium'),
(3, 'Hard');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `difficulty_id` int(11) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `feedback_date` date DEFAULT NULL,
  `academic_year` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedback_id`, `user_id`, `class_id`, `subject_id`, `difficulty_id`, `comment`, `feedback_date`, `academic_year`) VALUES
(1, 1, 1, 1, 3, '', '2026-03-02', '2026'),
(2, 1, 1, 2, 2, '', '2026-03-02', '2026'),
(3, 1, 2, 4, 2, 'jvfvuihvvk', '2026-02-04', '2026'),
(4, 9, 3, 6, 3, 'vjuv8gjvgoi,cv9-ivkg0pvolv90vkovp', '2026-05-02', '2026'),
(5, 1, 3, 7, 1, 'vhfviovjhvklcxjdoipjd', '2026-02-11', '2026'),
(6, 12, 4, 3, 3, 'Sifahamu chochote kuhusu hiki  kitu', '2026-02-17', '2026'),
(7, 1, 3, 9, 3, 'bijgun9gjbbmgbtbi', '2026-02-17', '2026'),
(8, 1, 2, 6, 2, 'chduyuoirhuihn', '2026-02-17', '2026'),
(9, 1, 2, 7, 2, 'vbmjgbmuigbjgbi', '2026-02-13', '2026'),
(10, 12, 2, 4, 3, 'gumu sana', '2026-02-22', '2026');

-- --------------------------------------------------------

--
-- Table structure for table `feedback_topics`
--

CREATE TABLE `feedback_topics` (
  `id` int(11) NOT NULL,
  `feedback_id` int(11) DEFAULT NULL,
  `topic_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback_topics`
--

INSERT INTO `feedback_topics` (`id`, `feedback_id`, `topic_id`) VALUES
(1, 1, 1),
(2, 2, 3),
(3, 3, 9),
(4, 4, 17),
(5, 9, 19),
(6, 10, 10);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`) VALUES
(1, 'Student'),
(2, 'Teacher'),
(3, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `subject_id` int(11) NOT NULL,
  `subject_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`subject_id`, `subject_name`) VALUES
(1, 'Physics'),
(2, 'Mathematics'),
(3, 'Chemistry'),
(4, 'Biology'),
(5, 'English'),
(6, 'Geography'),
(7, 'Kiswahili'),
(8, 'Civics'),
(9, 'History'),
(10, 'Bookkeeping'),
(12, 'Economics');

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE `topics` (
  `topic_id` int(11) NOT NULL,
  `topic_name` varchar(100) NOT NULL,
  `subject_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`topic_id`, `topic_name`, `subject_id`) VALUES
(1, 'Bernoulli', 1),
(2, 'Friction', 1),
(3, 'Algebra', 2),
(4, 'Trigonometry', 2),
(5, 'Geometry', 2),
(6, 'Organic Chemistry', 3),
(7, 'Stoichiometry', 3),
(8, 'Acids and Bases', 3),
(9, 'Cell Biology', 4),
(10, 'Genetics', 4),
(11, 'Ecology', 4),
(12, 'Grammar', 5),
(13, 'Essay Writing', 5),
(14, 'Comprehension', 5),
(15, 'Map Reading', 6),
(16, 'Weather', 6),
(17, 'Earth Structure', 6),
(18, 'Sarufi', 7),
(19, 'Insha', 7),
(20, 'Fasihi', 7),
(21, 'Human Rights', 8),
(22, 'Gender', 8),
(23, 'Elections', 8),
(24, 'World War', 9),
(25, 'Colonialism', 9),
(26, 'African History', 9),
(27, 'Ledger', 10),
(28, 'Trial Balance', 10),
(29, 'Final Accounts', 10),
(30, 'Bernouli', 1),
(31, 'Cell Biology', 1),
(32, 'Differential Equation', 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `full_name`, `username`, `password`, `role_id`) VALUES
(1, 'Amina Juma Hamad', 'emiflair', '12345678', 1),
(2, 'Aisha Nassor Ali', 'rose', '87654321', 2),
(3, 'Meenart flair', 'artmeen', '1234', 3),
(7, 'Hiba Bakari Hamisi', 'hybn', '09876543', 1),
(8, 'Amina', 'emy', 'Amina', 2),
(9, 'Ainal Khatib Ali', 'Lania', 'lania456', 1),
(10, 'Laila Ahmed Haji', 'lamy', 'yamy', 1),
(12, 'Lukman Hamza Mohammed', 'abuy', 'lhm', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`class_id`);

--
-- Indexes for table `difficulty_levels`
--
ALTER TABLE `difficulty_levels`
  ADD PRIMARY KEY (`difficulty_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `class_id` (`class_id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `difficulty_id` (`difficulty_id`);

--
-- Indexes for table `feedback_topics`
--
ALTER TABLE `feedback_topics`
  ADD PRIMARY KEY (`id`),
  ADD KEY `feedback_id` (`feedback_id`),
  ADD KEY `topic_id` (`topic_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`subject_id`);

--
-- Indexes for table `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`topic_id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `difficulty_levels`
--
ALTER TABLE `difficulty_levels`
  MODIFY `difficulty_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `feedback_topics`
--
ALTER TABLE `feedback_topics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `topics`
--
ALTER TABLE `topics`
  MODIFY `topic_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `feedback_ibfk_2` FOREIGN KEY (`class_id`) REFERENCES `classes` (`class_id`),
  ADD CONSTRAINT `feedback_ibfk_3` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`subject_id`),
  ADD CONSTRAINT `feedback_ibfk_4` FOREIGN KEY (`difficulty_id`) REFERENCES `difficulty_levels` (`difficulty_id`);

--
-- Constraints for table `feedback_topics`
--
ALTER TABLE `feedback_topics`
  ADD CONSTRAINT `feedback_topics_ibfk_1` FOREIGN KEY (`feedback_id`) REFERENCES `feedback` (`feedback_id`),
  ADD CONSTRAINT `feedback_topics_ibfk_2` FOREIGN KEY (`topic_id`) REFERENCES `topics` (`topic_id`);

--
-- Constraints for table `topics`
--
ALTER TABLE `topics`
  ADD CONSTRAINT `topics_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`subject_id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
