-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 11, 2024 at 08:05 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `studentinv`
--

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `dept_id` int(11) NOT NULL,
  `dept_name` varchar(60) NOT NULL,
  `dept_description` varchar(60) NOT NULL,
  `dept_status` varchar(60) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`dept_id`, `dept_name`, `dept_description`, `dept_status`) VALUES
(1, 'IT', 'for information technology', '1'),
(2, 'HRM', 'for hotel restaurant managements', '1'),
(3, 'Cs', 'for computer science', '1'),
(4, 'IS', 'for information system', '1'),
(6, 'test', 'test', '0'),
(7, 'PE', 'test 2', '1'),
(8, 'NEW', 'NEW', '0');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `stud_id` int(11) NOT NULL,
  `stud_course` varchar(60) NOT NULL,
  `stud_fname` varchar(60) NOT NULL,
  `stud_mname` varchar(60) DEFAULT NULL,
  `stud_lname` varchar(60) NOT NULL,
  `stud_phone` varchar(60) NOT NULL,
  `stud_email` varchar(60) NOT NULL,
  `stud_address` varchar(60) NOT NULL,
  `stud_gender` varchar(60) NOT NULL,
  `stud_year_level` varchar(60) NOT NULL,
  `stud_sem` varchar(60) NOT NULL,
  `stud_academic_status` varchar(60) NOT NULL,
  `stud_school_year` varchar(255) NOT NULL,
  `stud_status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`stud_id`, `stud_course`, `stud_fname`, `stud_mname`, `stud_lname`, `stud_phone`, `stud_email`, `stud_address`, `stud_gender`, `stud_year_level`, `stud_sem`, `stud_academic_status`, `stud_school_year`, `stud_status`) VALUES
(18, 'Bachelor of Science in Information Technology', 'joshua', 'raymundo', 'padilla', '', '', '', '', '2nd Year', '2nd', 'Irregular', '2024-2025', 1),
(19, 'Bachelor of Science in Mechanical Engineering', 'Ayanna', '', 'Misola', '09454454744', 'ayanna@gmail.com', 'tibagan', 'female', '1st year', '2nd', 'Regular', '2023-2024', 1),
(20, 'Bachelor of Science in Information Technology', 'Azi', '', 'Acosta', '09123456784', 'azi@gmail.com', 'barangay 000 muntinlupa city', 'female', '1st year', '1st', 'Regular', '2023-2024', 1),
(21, 'Bachelor of Science in Mechanical Engineering', 'Denise', '', 'Esteban', '09454454542', 'denice@gmail.com', 'barangay 634 quezon city', 'female', '2nd Year', '2nd', 'Regular', '2024-2025', 1),
(22, 'Bachelor of Science in Mechanical Engineering', 'AJ', 'A', 'Raval', '09000000003', 'aj@gmail.com', 'sta.rosa 2', 'female', '3rd Year', '3rd', 'Irregular', '2021-2022', 1),
(23, 'Bachelor of Science in Computer Science', 'April ', 'Jane', 'De leon', '', '', '', '', '2nd Year', '2nd', 'Regular', '2024-2025', 0),
(24, 'Bachelor of Science in Computer Science', 'joshua', 'r', 'r', '34', 'wda@gawd.com', 'wdwa', 'male', '2nd Year', '3rd', 'Regular', '2024-2025', 1),
(25, 'Bachelor of Science in Civil Engineering', 'alu', '', 'card', '09454454744', 'alucard@gmail.com', 'mobile legends', 'male', '2nd Year', '3rd', 'Regular', '2022-2023', 1),
(26, 'Bachelor of Science in Computer Science', 'test', 'test', 'tes', 'test', 'test@tes.com', 'test', 'male', '1st year', '1st', 'Regular', '2022-2023', 1),
(27, 'Bachelor of Science in Information Technology', 'juan', '', 'Dela cruz', '09454454711', 'juan@gmail.com', 'san juan ', 'male', '1st year', '1st', 'Regular', '2024-2025', 1);

-- --------------------------------------------------------

--
-- Table structure for table `student_subject`
--

CREATE TABLE `student_subject` (
  `ss_id` int(11) NOT NULL,
  `ss_stud_id` int(11) NOT NULL,
  `ss_subject_id` int(11) NOT NULL,
  `ss_final_grade` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_subject`
--

INSERT INTO `student_subject` (`ss_id`, `ss_stud_id`, `ss_subject_id`, `ss_final_grade`) VALUES
(57, 22, 49, 1.00),
(58, 23, 49, 0.00),
(59, 18, 48, 5.00),
(60, 21, 48, 1.25),
(61, 22, 48, 0.00),
(62, 22, 54, 0.00),
(64, 18, 49, 2.50),
(67, 19, 57, 0.00),
(69, 26, 55, 3.00),
(70, 26, 49, 2.00),
(71, 27, 56, 3.00),
(72, 20, 56, 5.00);

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `subject_id` int(11) NOT NULL,
  `sub_dept_id` int(11) NOT NULL,
  `course_code` varchar(60) NOT NULL,
  `descriptive_title` varchar(60) NOT NULL,
  `units` int(11) NOT NULL,
  `pre_requisite` varchar(60) NOT NULL,
  `for_year_level` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`subject_id`, `sub_dept_id`, `course_code`, `descriptive_title`, `units`, `pre_requisite`, `for_year_level`) VALUES
(48, 3, 'PROG 1', 'hands on programming ', 3, '', '2nd Year'),
(49, 7, 'PE 1', 'physical education 1', 2, '3', '1st year'),
(54, 3, 'AWS', 'amazon web services', 4, '', '3rd Year'),
(55, 3, 'ITFUN', 'IT FUNDAMENTALS', 3, '', '1st year'),
(56, 1, 'IT-01', 'information technology 1', 2, '', '1st year'),
(57, 4, 'IS2', 'information system 1', 2, '', '2nd Year');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `admin_id` int(11) NOT NULL,
  `fname` varchar(60) NOT NULL,
  `mname` varchar(60) DEFAULT NULL,
  `lname` varchar(60) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `type` varchar(20) NOT NULL,
  `profile_img` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`admin_id`, `fname`, `mname`, `lname`, `email`, `username`, `password`, `type`, `profile_img`, `status`) VALUES
(1, 'Joshua Anderson', 'raymundo', 'Padilla', 'andersonandy046@gmail.com', 'admin', '$2y$10$JBj5w7egG82WPXwSjZrJROlMs7bSuXJBMh/qQ.S1dfEIkM3XmBhTC', 'super_admin', 'profile_66e03e8de1c266.83250222.jpg', 1),
(24, 'andy', '', 'anderson', 'andyanderson895@yahoo.com', 'andyanderson895', '$2y$10$coNIitr1ogZfvjC0pZ4Sv.J8fz7q3P3Pzi07064MYnDgoRv7zh8MK', 'admin', 'profile_66d4a8ddcd5f89.27748458.jpg', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`dept_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`stud_id`);

--
-- Indexes for table `student_subject`
--
ALTER TABLE `student_subject`
  ADD PRIMARY KEY (`ss_id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`subject_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`admin_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `dept_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `stud_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `student_subject`
--
ALTER TABLE `student_subject`
  MODIFY `ss_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
