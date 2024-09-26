-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 26, 2024 at 05:29 PM
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
(1, 'CCE BSIT', 'Bachelor of Science in Information Technology', '1'),
(2, 'CCE BSCS', 'Bachelor of Science in Computer Science', '1'),
(3, 'CCE BSIS', 'Bachelor of Science in Information System', '1'),
(4, 'BS Crim', 'Bachelor of Science in Criminology', '1'),
(5, 'BSED English', 'Bachelor of Secondary Education in  English', '1'),
(6, 'BEED', 'Bachelor of Elementary Education', '1'),
(7, 'BSED SC', 'Bachelor of Secondary Education in  Social Studies', '1'),
(8, 'BSED M', 'Bachelor of Secondary Education in  Mathematics', '1'),
(9, 'MAED (N)', 'Master of Arts in Education', '1'),
(10, 'MAED (O)', 'Master of Arts in Education', '1');

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
  `stud_bday` date NOT NULL,
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

INSERT INTO `student` (`stud_id`, `stud_course`, `stud_fname`, `stud_mname`, `stud_lname`, `stud_phone`, `stud_bday`, `stud_address`, `stud_gender`, `stud_year_level`, `stud_sem`, `stud_academic_status`, `stud_school_year`, `stud_status`) VALUES
(28, 'Bachelor of Science in Information Technology', 'Mark ', '', 'Espadera', '0931654654', '2024-10-04', 'comawas', 'male', '1st year', '1st', 'Irregular', '2024-2025', 1),
(99, 'Bachelor of Science in Information Criminology', 'angela', '', 'Denise', '123123', '2024-09-19', 'aweqe', 'male', 'Graduate', '3rd', 'Regular', '2022-2023', 1);

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
(83, 99, 518, 0.00);

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
(63, 1, 'CC 101 (BSIT)', 'Introduction to Computing with Keyboarding', 3, '', '1st year'),
(64, 1, 'CSS 1 (BSIT)', 'Install and Configure Computers/Set-up Computer Networks', 3, '', '1st year'),
(65, 1, 'GE 1 (BSIT)', 'Understanding Self', 3, '', '1st year'),
(66, 1, 'GE 2 (BSIT)', 'Reading in Philippines History', 3, '', '1st year'),
(67, 1, 'GE 3 (BSIT)', 'The Contemporary World', 3, '', '1st year'),
(68, 1, 'Path Fit 1 (BSIT)', 'Movement Competency Training', 2, '', '1st year'),
(69, 1, 'CC 102 (BSIT)', 'Computer Programming 1', 3, '', '1st year'),
(70, 1, 'GE 4 (BSIT)', 'Mathematics in Modern World', 3, '', '1st year'),
(71, 1, 'GE 5 (BSIT)', 'Purposive Communication', 3, '', '1st year'),
(72, 1, 'CSS 2 (BSIT)', 'Set-up Computer Servers/Maintain Computer Systems and Networ', 3, '', '1st year'),
(73, 1, 'Path Fit 2 (BSIT)', 'Exercise-based Fitness', 2, '', '1st year'),
(74, 1, 'NSTP 1 (BSIT)', 'Civic Welfare Training Service I', 3, '', '1st year'),
(75, 1, 'CC 103 (BSIT)', 'Computer Programming 2', 3, '', '1st year'),
(76, 1, 'MS 101 (BSIT)', 'Discrete Mathematics', 3, '', '1st year'),
(77, 1, 'GE 6 (BSIT)', 'Art Appreciation', 3, '', '1st year'),
(78, 1, 'GE 7 (BSIT)', 'Science, Technology & Society', 3, '', '1st year'),
(79, 1, 'GE 8 (BSIT)', 'Ethics', 3, '', '1st year'),
(80, 1, 'PATH Fit 3 (BSIT)', 'Dance and Sports', 2, '', '1st year'),
(81, 1, 'NSTP 2 (BSIT)', 'Civic Welfare Training Service II', 3, '', '1st year'),
(82, 1, 'PF 101 (BSIT)', 'Object Oriented Programming', 3, '', '2nd Year'),
(83, 1, 'CC 104 (BSIT)', 'Data Structures & Algorithms', 3, '', '2nd Year'),
(84, 1, 'PT 101 (BSIT)', 'Platform Technologies', 3, '', '2nd Year'),
(85, 1, 'CC 105 (BSIT)', 'Information Management', 3, '', '2nd Year'),
(86, 1, 'GE 10 (BSIT)', 'Phillippine Popular Culture', 3, '', '2nd Year'),
(87, 1, 'GE 9 (BSIT)', 'Gender and Society', 3, '', '2nd Year'),
(88, 1, 'PATH Fit 4 (BSIT)', 'Outdoor and Adventure Activities', 2, '', '2nd Year'),
(89, 1, 'IM 101 (BSIT)', 'Fundamentals of Database Systems', 3, '', '2nd Year'),
(90, 1, 'Net 101 (BSIT)', 'Networking 1', 3, '', '2nd Year'),
(91, 1, 'IPT 101  (BSIT)', 'Integrative Programming and Technologies', 3, '', '2nd Year'),
(92, 1, 'GE11 (BSIT)', 'Living in an IT Era', 3, '', '2nd Year'),
(93, 1, 'GE 12 (BSIT)', 'Life & Works of Rizal', 3, '', '2nd Year'),
(94, 1, 'SAD', 'System Analysis, Design and Development', 3, '', '2nd Year'),
(95, 1, 'IAS 101 (BSIT)', 'Information Assurance & Security', 3, '', '2nd Year'),
(96, 1, 'SIA 101  (BSIT)', 'System Integration and Architecture 1', 3, '', '2nd Year'),
(97, 1, 'HCI 101 (BSIT)', 'Introduction to Human Computer Interaction 1', 3, '', '2nd Year'),
(98, 1, 'MS 102 (BSIT)', 'Quantitative Methods (include Modelling & Simulation)', 3, '', '2nd Year'),
(99, 1, 'Stat 1 (BSIT)', 'Statistics', 3, '', '2nd Year'),
(100, 1, 'CC 106 (BSIT)', 'Application Development and Emerging Technologies', 3, '', '2nd Year'),
(101, 1, 'DM (BSIT)', 'Data Mining', 3, '', '2nd Year'),
(102, 1, 'BD 101 (BSIT)', 'Business Intelligence', 3, '', '3rd Year'),
(103, 1, 'SP 101 (BSIT)', 'Social and Professional Issues', 3, '', '3rd Year'),
(104, 1, 'Net 102 (BSIT)', 'Networking 2', 3, '', '3rd Year'),
(105, 1, 'SA 101 (BSIT)', 'System Administration and Maintainance', 3, '', '3rd Year'),
(106, 1, 'Cap 101 (BSIT)', 'Capstone Project and Research 1', 3, '', '3rd Year'),
(107, 1, 'IT Elec 1 (BSIT)', 'Web Systems and Technologies', 3, '', '3rd Year'),
(108, 1, 'CAP 102 (BSIT)', 'Capstone Project and Research 2', 3, '', '3rd Year'),
(109, 1, 'IT Elec 2 (BSIT)', 'Integrative Programming and Technologies 2', 3, '', '3rd Year'),
(110, 1, 'IAS 102 (BSIT)', 'Information Assurance & Security 2', 3, '', '3rd Year'),
(111, 1, 'Acctg. 1 (BSIT)', 'Basic Accounting 1', 3, '', '3rd Year'),
(112, 1, 'IT Elec 3 (BSIT)', 'Human Computer Interaction 2', 3, '', '3rd Year'),
(113, 1, 'PDC (BSIT)', 'Parallel and Distributed Computing', 3, '', '3rd Year'),
(114, 1, 'OS 101 (BSIT)', 'Operating Systems', 3, '', '3rd Year'),
(115, 1, 'PR 101 (BSIT)', 'Practicum(486hrs.)', 3, '', '3rd Year'),
(116, 1, 'IT Elec 4 (BSIT)', 'System Integration and Architecture 2', 0, '', '3rd Year'),
(117, 2, 'CC 101 (BSCS)', 'Introduction to Computing with Keyboarding', 3, '', '1st Year'),
(118, 2, 'GE 1 (BSCS)', 'Understanding Self', 3, '', '1st Year'),
(119, 2, 'GE 2 (BSCS)', 'Reading in Philippine History', 3, '', '1st Year'),
(120, 2, 'GE 3 (BSCS)', 'The Contemporary World', 3, '', '1st Year'),
(121, 2, 'CC 102 (BSCS)', 'Fundamentals  of Programming', 3, '', '1st Year'),
(122, 2, 'GE 4 (BSCS)', 'Mathematics in Modern World', 3, '', '1st Year'),
(123, 2, 'GE 5 (BSCS)', 'Purposive Communication', 3, '', '1st Year'),
(124, 2, 'CSS 2 (BSCS)', 'Set-up Computer Servers/Maintain Computer Systems and Networ', 3, '', '1st Year'),
(125, 2, 'CC 103 (BSCS)', 'Intermediate Programming', 3, '', '1st Year'),
(126, 2, 'DS 101 (BSCS)', 'Discrete Structure 1', 3, '', '1st Year'),
(127, 2, 'GE 6 (BSCS)', 'Art Appreciation', 3, '', '1st Year'),
(128, 2, 'GE 7 (BSCS)', 'Science, Technology & Society', 3, '', '1st Year'),
(129, 2, 'GE 8 (BSCS)', 'Ethics', 3, '', '1st Year'),
(130, 2, 'PATH Fit 3 (BSCS)', 'Dance and Sports', 2, '', '1st year'),
(131, 2, 'NSTP 2 (BSCS)', 'Civic Welfare Training Service II', 3, '', '1st Year'),
(132, 2, 'PATH Fit 1 (BSCS)', 'Movement Competency Trraining', 2, '', '1st year'),
(133, 2, 'PATH Fit 2 (BSCS)', 'Exercise-base Fitness', 2, '', '1st year'),
(134, 2, 'CSS 1 (BSCS)', 'Install and Configure Computers/Set-up Computer Networks', 3, '', '1st Year'),
(135, 2, 'NSTP 1 (BSCS)', 'Civic Welfare Training Service', 3, '', '1st Year'),
(136, 2, 'SDF 104 (BSCS)', 'Object Oriented Programming', 3, '', '2nd Year'),
(137, 2, 'CC 104 (BSCS)', 'Data Structures & Algorithms', 3, '', '2nd Year'),
(138, 2, 'CC 105 (BSCS)', 'Information Management', 3, '', '2nd Year'),
(139, 2, 'GE 9 (BSCS)', 'Gender and Society', 3, '', '2nd Year'),
(140, 2, 'GE 10 (BSCS)', 'Philippine Popular Culture', 3, '', '2nd Year'),
(141, 2, 'PATH Fit 4 (BSCS)', 'Outdoor and Adventure Activities', 2, '', '2nd Year'),
(142, 2, 'PT 101 (BSCS)', 'Platform Technologies', 3, '', '2nd Year'),
(143, 2, 'AL 101 (BSCS)', 'Algorithms & Complexity', 3, '', '2nd Year'),
(144, 2, 'Math 2A (BSCS)', 'Math Elective (Differential Calculus)', 3, '', '2nd Year'),
(145, 2, 'AR 101 (BSCS)', 'Architecture & Organization', 3, '', '2nd Year'),
(146, 2, 'SAD 101 (BSCS)', 'System Analysis, Design and Development', 3, '', '2nd Year'),
(147, 2, 'GE 11 (BSCS)', 'Living in an IT Era', 3, '', '2nd Year'),
(148, 2, 'SE 101 (BSCS)', 'Software Engineering 1', 3, '', '2nd Year'),
(149, 2, 'AL 102 (BSCS)', 'Automata Theory & Formal Languages', 3, '', '2nd Year'),
(150, 2, 'CC 106 (BSCS)', 'Application Development and Emerging Technologies', 3, '', '2nd Year'),
(151, 2, 'IAS 101 (BSCS)', 'Information Assurance & Security', 3, '', '2nd Year'),
(152, 2, 'HCI (BSCS)', 'Human Computer Interaction', 3, '', '2nd Year'),
(153, 2, 'Stat 1 (BSCS)', 'Statistics', 3, '', '2nd Year'),
(154, 2, 'SE 102 (BSCS)', '', 3, '', '2nd Year'),
(155, 2, 'DS 102 (BSCS)', 'Discrete Structure 2', 3, '', '2nd Year'),
(156, 2, 'THS 101 (BSCS)', 'CS Thesis Writing 1', 3, '', '3rd Year'),
(157, 2, 'BD 101 (BSCS)', 'Business Intelligence', 3, '', '3rd Year'),
(158, 2, 'DM (BSCS)', 'Data Mining', 3, '', '3rd Year'),
(159, 2, 'SP 101 (BSCS)', 'Social Issues & Professional Practice', 3, '', '3rd Year'),
(160, 2, 'NC 101 (BSCS)', 'Networks and Communication', 3, '', '3rd Year'),
(161, 2, 'CS Elec 1 (BSCS)', 'System Fundamentals', 3, '', '3rd Year'),
(162, 2, 'CS Elec 2 (BSCS)', 'Graphics and Visual Computing', 3, '', '3rd Year'),
(163, 2, 'THS 102 (BSCS)', 'CS Thesis Writing 2', 3, '', '3rd Year'),
(164, 2, 'CS Elec 3 (BSCS)', 'Computational Science', 3, '', '3rd Year'),
(165, 2, 'PDC 101 (BSCS)', 'Parallel and Distributed Computing', 3, '', '3rd Year'),
(166, 2, 'IS 101 (BSCS)', 'Intelligent System', 3, '', '3rd Year'),
(167, 2, 'OS 101 (BSCS)', 'Operating Systems', 3, '', '3rd Year'),
(168, 2, 'Acctg 101 (BSCS)', 'Basic Accounting', 3, '', '3rd Year'),
(169, 2, 'PL 101 (BSCS)', 'Programming Languages', 3, '', '3rd Year'),
(170, 2, 'PRC (BSCS)', 'Practicum(486hrs.)', 3, '', '3rd Year'),
(171, 2, 'G12 (BSCS)', 'Life & Works of Rizal', 3, '', '3rd Year'),
(172, 3, 'CC 101 (BSIS)', 'Introduction to Computing with Keyboarding', 3, '', '1st Year'),
(173, 3, 'CSS 1 (BSIS)', 'Install and Configure Computers/Set-up Computer Networks', 3, '', '1st Year'),
(174, 3, 'GE 1 (BSIS)', 'Understanding the Self', 3, '', '1st Year'),
(175, 3, 'GE 2 (BSIS)', 'Readings in Philippine History', 3, '', '1st Year'),
(176, 3, 'GE 3 (BSIS)', 'The Contemporary World', 3, '', '1st Year'),
(177, 3, 'PATH Fit 1 (BSIS)', 'Movement Competency Training', 2, '', '1st year'),
(178, 3, 'CC 102 (BSIS)', 'Computer Programming 1 (Fundamentals of Programming)', 3, '', '1st Year'),
(179, 3, 'GE 4 (BSIS)', 'Mathematics in the Modern World', 3, '', '1st Year'),
(180, 3, 'GE 5 (BSIS)', 'Purposive Communication', 3, '', '1st Year'),
(181, 3, 'CSS 2 (BSIS)', 'Set-up Computer Servers/Maintain Computer Systems & Networks', 3, '', '1st Year'),
(182, 3, 'PATH Fit 2 (BSIS)', 'Exercise-based Fitness', 2, '', '1st year'),
(183, 3, 'NSTP 1 (BSIS)', 'Civic Welfare Training Service I', 3, '', '1st Year'),
(184, 3, 'CC 103 (BSIS)', 'Computer Programming 2 (Intermediate Programming)', 3, '', '1st Year'),
(185, 3, 'IS 101 (BSIS)', 'Fundamentals of Information Systems', 3, '', '1st Year'),
(186, 3, 'GE 6 (BSIS)', 'Art Appreciation', 3, '', '1st Year'),
(187, 3, 'GE 7 (BSIS)', 'Science, Technology & Society', 3, '', '1st Year'),
(188, 3, 'GE 8 (BSIS)', 'Dance and Sports', 3, '', '1st Year'),
(189, 3, 'NSTP 2 (BSIS)', 'Civic Welfare Training Service II', 3, '', '1st Year'),
(190, 2, 'PATH Fit 3 (BSIS)', 'Dance and Sports', 2, '', '1st year'),
(191, 3, 'PF 101 (BSIS)', 'Object Oriented Programming', 3, '', '2nd Year'),
(192, 3, 'CC 104 (BSIS)', 'Data Structures and Algorithms', 3, '', '2nd Year'),
(193, 3, 'IS 103 (BSIS)', 'IT Infrastructure and Network Technologies', 3, '', '2nd Year'),
(194, 3, 'IS 102 (BSIS)', 'Professional Issues in Information Systems', 3, '', '2nd Year'),
(195, 3, 'GE 9 (BSIS)', 'Gender and Society', 3, '', '2nd Year'),
(196, 3, 'GE 10 (BSIS)', 'Philippine Popular Culture', 3, '', '2nd Year'),
(197, 3, 'PATH Fit 4 (BSIS)', 'Outdoor and Adventure Activities', 2, '', '2nd Year'),
(198, 3, 'IM 101 (BSIS)', 'Fundamentals of Database Systems', 3, '', '2nd Year'),
(199, 3, 'CC 105 (BSIS)', 'Information Management', 3, '', '2nd Year'),
(200, 3, 'IS 104 (BSIS)', 'System Analysis, Design and Development', 3, '', '2nd Year'),
(201, 3, 'DM 101 (BSIS)', 'Organization and Management Concepts', 3, '', '2nd Year'),
(202, 3, 'IPT 101 (BSIS)', 'Integrative Programming & Technologies', 3, '', '2nd Year'),
(203, 3, 'GE 11 (BSIS)', 'Living in an IT Era', 3, '', '2nd Year'),
(204, 3, 'GE12 (BSIS)', 'Life & Works Rizal', 3, '', '2nd Year'),
(205, 3, 'IAS 101 (BSIS)', 'Information Assurance & Security', 3, '', '2nd Year'),
(206, 3, 'HCI 101 (BSIS)', 'Human Computer Interaction', 3, '', '2nd Year'),
(207, 3, 'QUAMET (BSIS)', 'Quantitative Methods', 3, '', '2nd Year'),
(208, 3, 'Stat 1 (BSIS)', 'Statistics', 3, '', '2nd Year'),
(209, 3, 'IS 105 (BSIS)', 'Enterprise Architecture', 3, '', '2nd Year'),
(210, 3, 'IS Elec 1 (BSIS)', 'Data Mining', 3, '', '2nd Year'),
(211, 3, 'DM 102 (BSIS)', 'Financial Management', 3, '', '2nd Year'),
(212, 3, 'CAP 101 (BSIS)', 'Capstone Project 1', 3, '', '3rd Year'),
(213, 3, 'IS 106 (BSIS)', 'IS Project Management 1', 3, '', '3rd Year'),
(214, 3, 'ITAC (BSIS)', 'IT Audit and Controls', 3, '', '3rd Year'),
(215, 3, 'BD 101 (BSIS)', 'Business Intelligence', 3, '', '3rd Year'),
(216, 3, 'IS 107 (BSIS)', 'IS Strategy, Management and Acquisition', 3, '', '3rd Year'),
(217, 3, 'DM 103 (BSIS)', 'Business Process Design & Management', 3, '', '3rd Year'),
(218, 3, 'Reseearch (BSIS)', 'Methods of Research in Computing', 3, '', '3rd Year'),
(219, 3, 'CAP 102 (BSIS)', 'Capstone Project 2', 3, '', '3rd Year'),
(220, 3, 'CC 106 (BSIS)', 'Applications Devt. & Emerging Technologies', 3, '', '3rd Year'),
(221, 3, 'ISI (BSIS)', 'IS Innovation and New Technologies', 3, '', '3rd Year'),
(222, 3, 'Acctg. 1 (BSIS)', 'Basic Accounting 1', 3, '', '3rd Year'),
(223, 3, 'IS Elec 2 (BSIS)', 'Enterprise Resource Planning', 3, '', '3rd Year'),
(224, 3, 'IS Elec 3 (BSIS)', 'IS Project Management 2', 3, '', '3rd Year'),
(225, 3, 'Techno (BSIS)', 'Technopreneurship', 3, '', '3rd Year'),
(226, 3, 'DM 104 (BSIS)', 'Evaluation of Business Performance', 3, '', '3rd Year'),
(227, 3, 'IS Elec 4 (BSIS)', 'Customer Relationship Management', 3, '', '3rd Year'),
(228, 3, 'Prac 101 (BSIS)', 'Practicum for Information System (486 hours)', 3, '', '3rd Year'),
(229, 4, 'GE 1 (BS Crim)', 'Understanding the Self', 3, '', '1st Year'),
(230, 4, 'GE 2 (BS Crim)', 'Readings in Philippine History', 3, '', '1st Year'),
(231, 4, 'GE 3 (BS Crim)', 'The Contemporary World', 3, '', '1st Year'),
(232, 4, 'GE 4 (BS Crim)', 'Mathematics in Modern World', 3, '', '1st Year'),
(233, 4, 'Crim 1 (BS Crim)', 'Introduction to Criminology', 3, '', '1st Year'),
(234, 4, 'EC 1 (BS Crim)', 'Reading Comprehension', 3, '', '1st Year'),
(235, 4, 'DEFTAC 1 (BS Crim)', 'Fundamentals of Martial Arts', 2, '', '1st year'),
(236, 4, 'NSTP 1 (BS Crim)', 'ROTC 1', 3, '', '1st Year'),
(237, 4, 'GE 5 (BS Crim)', 'Purposive Communication', 3, '', '1st Year'),
(238, 4, 'GE 6 (BS Crim)', 'Art Appreciation', 3, '', '1st Year'),
(239, 4, 'GE 7 (BS Crim)', 'Science, Technology and Society', 3, '', '1st Year'),
(240, 4, 'LEA 1 (BS Crim)', 'Law Enforcement Organization and Administration', 4, '', '1st year'),
(241, 4, 'CLJ 1 (BS Crim)', 'Introduction to Philippine Criminal Justice System', 3, '', '1st Year'),
(242, 4, 'DEFTAC 2 (BS Crim)', 'Arnis and Disarming Technique', 2, '', '1st year'),
(243, 4, 'NSTP 2 (BS Crim)', 'ROTC 2', 3, '', '1st Year'),
(244, 4, 'GE 8 (BS Crim)', 'Ethics', 3, '', '1st Year'),
(245, 4, 'EC 2 (BS Crim)', 'Human Rights Education', 3, '', '1st Year'),
(246, 4, 'Crim 2 (BS Crim)', 'Theories of Crime Causation', 3, '', '1st Year'),
(247, 4, 'CDI 1 (BS Crim)', 'Fundamentals of Investigation and Intelligence', 4, '', '1st year'),
(248, 4, 'LEA 2 (BS Crim)', 'Comparative Models in Policing', 3, '', '1st Year'),
(249, 4, 'DEFTAC 3 (BS Crim)', 'First Aid and Water Safety', 2, '', '1st year'),
(250, 4, 'CLJ 2 (BS Crim)', 'Basic Computer Software', 3, '', '1st year'),
(251, 4, 'PC 1 (BS Crim)', 'Life and Works of Rizal', 3, '', '2nd Year'),
(252, 4, 'CDI 2 (BS Crim)', 'Specialized Crime Investigation 1 w/ Legal Medicine', 3, '', '2nd Year'),
(253, 4, 'CLJ 3 (BS Crim)', 'Criminal Law (Book 1)', 3, '', '2nd Year'),
(254, 4, 'Chem 1 (BS Crim)', 'General Chemistry (Organic)', 3, '', '2nd Year'),
(255, 4, 'Forensic 1 (BS Crim)', 'Forensic Photography', 3, '', '2nd Year'),
(256, 4, 'LEA 3 (BS Crim)', 'Introduction to Industrial Security Concepts', 3, '', '2nd Year'),
(257, 4, 'DEFTAC4 (BS Crim)', 'Marksmanship and Combat Shooting', 2, '', '2nd Year'),
(258, 4, 'EC 3 (BS Crim)', 'Politics & Governance with Philippine Constitution', 3, '', '2nd Year'),
(259, 4, 'Crim 3 (BS Crim)', 'Human Behavior and Victimology', 3, '', '2nd Year'),
(260, 4, 'Crim 4 (BS Crim)', 'Professional Conduct and Ethical Standards', 3, '', '2nd Year'),
(261, 4, 'CLJ 4 (BS Crim)', 'Criminal Law (Book 2)', 4, '', '2nd Year'),
(262, 4, 'Forensic 2 (BS Crim)', 'Personal Identification Techniques', 3, '', '2nd Year'),
(263, 4, 'CDI 3 (BS Crim)', 'Specialized Crime Investigation 2 w/ Simulation on Interroga', 3, '', '2nd Year'),
(264, 4, 'CA 1 (BS Crim)', 'Institutional Corrections', 3, '', '2nd Year'),
(265, 4, 'Forensic 3 (BS Crim)', 'Forensic Chemistry and Toxicology', 5, '', '2nd Year'),
(266, 4, 'CDI 4 (BS Crim)', 'Traffic Management and Accident Investigation w/ Driving', 3, '', '2nd Year'),
(267, 4, 'CA 2 (BS Crim)', 'Non-Institutional Corrections', 3, '', '2nd Year'),
(268, 4, 'Crim 5 (BS Crim)', 'Juvenile Delinquency and Juvenile Justice System', 3, '', '2nd Year'),
(269, 4, 'Crim 6 (BS Crim)', 'Dispute Resolution and Crises/Incidents Management', 3, '', '2nd Year'),
(270, 4, 'CFLM 1 (BS Crim)', 'Character Formation, Nationalism and Patriotism', 3, '', '2nd Year'),
(271, 4, 'LEA 4 (BS Crim)', 'Law Enforcement Operation and Planning w/ Crime Mapping', 3, '', '2nd Year'),
(272, 4, 'CLJ 5 (BS Crim)', 'Evidence', 3, '', '3rd Year'),
(273, 4, 'CFLM 2 (BS Crim)', 'Character Formation w/ Leadership, Decision Making, Manageme', 3, '', '3rd Year'),
(274, 4, 'CDI 5 (BS Crim)', 'Technical English 1 (Technical Report Writing & Presentation', 3, '', '3rd Year'),
(275, 4, 'CDI 6 (BS Crim)', 'Fire Protection & Arson Investigation', 3, '', '3rd Year'),
(276, 4, 'CA 3 (BS Crim)', 'Therapeutic Modalities', 2, '', '3rd Year'),
(277, 4, 'Forensic 4 (BS Crim)', 'Questioned Documents Examination', 3, '', '3rd Year'),
(278, 4, 'Crim 7 (BS Crim)', 'Criminological Research 1 (Research Methods with Applied Sta', 3, '', '3rd Year'),
(279, 4, 'Forensic 5 (BS Crim)', 'Lie Detection Techniques', 3, '', '3rd Year'),
(280, 4, 'Crim 8 (BS Crim)', 'Criminological Research 2 (Thesis Writing and Presentation)', 3, '', '3rd Year'),
(281, 4, 'CDI 7 (BS Crim)', 'Vice and Drug Education and Control', 3, '', '3rd Year'),
(282, 4, 'CLJ 6 (BS Crim)', 'Criminal Procedure & Court Testimony', 3, '', '3rd Year'),
(283, 4, 'Forensic 6 (BS Crim)', 'Forensic Ballistics', 3, '', '3rd Year'),
(284, 4, 'CDI 8 (BS Crim)', 'Technical English 2 (Legal Forms)', 3, '', '3rd Year'),
(285, 4, 'CDI 9 (BS Crim)', 'Introduction to Cybercrime and Environmental Laws and Protec', 3, '', '3rd Year'),
(286, 4, 'Criminology Practicum 1 (BS Crim)', 'Internship (On-the Job Training 1)', 3, '', '3rd Year'),
(287, 4, 'Sem 1 (BS Crim)', 'Seminar 1', 3, '', '3rd Year'),
(288, 4, 'Criminology Practicum 2 (BS Crim)', 'Internship (On-the Job Training 2)', 3, '', '4th Year'),
(289, 4, 'Sem 2 (BS Crim)', 'Seminar 2', 3, '', '4th Year'),
(290, 5, 'GE 1 (BSED-E)', 'Understanding the Self', 3, '', '1st Year'),
(291, 5, 'GE 2 (BSED-E)', 'Readings in Philippine History', 3, '', '1st Year'),
(292, 5, 'GE 3 (BSED-E)', 'The Contemporary World', 3, '', '1st Year'),
(293, 5, 'GE 4 (BSED-E)', 'Mathematics in the Modern World', 3, '', '1st Year'),
(294, 5, 'NSTP 1 (BSED-E)', 'Civic Welfare Training Service 1', 3, '', '1st Year'),
(295, 5, 'CoEd 100 (BSED-E)', 'The Child and Adolescent Learners and Learning Principles', 3, '', '1st Year'),
(296, 5, 'CSEE 101 (BSED-E)', 'Introduction to Linguistic', 3, '', '1st Year'),
(297, 5, 'GE 5 (BSED-E)', 'Purposive Communication', 3, '', '1st Year'),
(298, 5, 'GE 6 (BSED-E)', 'Art Appreciation', 3, '', '1st Year'),
(299, 5, 'GE 7 (BSED-E)', 'Science, Technology and Society', 3, '', '1st Year'),
(300, 5, 'PATH Fit 1 (BSED-E)', 'Movement Competency Training', 2, '', '1st year'),
(301, 5, 'NSTP 2 (BSED-E)', 'Civic Welfare Training Service 2', 3, '', '1st Year'),
(302, 5, 'CSEE 102 (BSED-E)', 'Language Culture & Society', 3, '', '1st Year'),
(303, 5, 'CSEE 103 (BSED-E)', 'Structure of English', 3, '', '1st Year'),
(304, 5, 'GE 8 (BSED-E)', 'Ethics', 3, '', '1st Year'),
(305, 5, 'GE 9 (BSED-E)', 'Gender and Society', 3, '', '1st Year'),
(306, 5, 'GE 10 (BSED-E)', 'Philippine Popular Culture', 3, '', '1st Year'),
(307, 5, 'PATH Fit 2 (BSED-E)', 'Exercise-based Fitness Activity', 2, '', '1st year'),
(308, 5, 'CoEd 103 (BSED-E)', 'Facilitating Learner-Centered Teaching', 3, '', '1st Year'),
(309, 5, 'CoEd 104 (BSED-E)', 'The Teaching Profession', 3, '', '1st Year'),
(310, 5, 'CSEE 104 (BSED-E)', 'Principles and Theories of Language Acquisition and Learning', 3, '', '1st Year'),
(311, 5, 'GE 11 (BSED-E)', 'Living in an IT Era', 3, '', '2nd Year'),
(312, 5, 'PATH Fit 3 (BSED-E)', 'Dance and Sports', 2, '', '2nd Year'),
(313, 5, 'Elective 1E (BSED-E)', 'Stylistic & Discourse Analysis', 3, '', '2nd Year'),
(314, 5, 'CoEd 202 (BSED-E)', 'The Teacher and the School Curriculum', 3, '', '2nd Year'),
(315, 5, 'CSEE 201 (BSED-E)', 'Teaching and Assessment of the Macro Skills', 3, '', '2nd Year'),
(316, 5, 'CSEE 202 (BSED-E)', 'Speech and Theater Arts', 3, '', '2nd Year'),
(317, 5, 'CSEE 203 (BSED-E)', 'Children and Adolescent Literature', 3, '', '2nd Year'),
(318, 5, 'PATH Fit 4 (BSED-E)', 'Outdoor and Adventure Activities', 2, '', '2nd Year'),
(319, 5, 'Elective 2E (BSED-E)', 'Creative Writing', 3, '', '2nd Year'),
(320, 5, 'TTL 1 (BSED-E)', 'Technology for Teaching and Learning 1', 3, '', '2nd Year'),
(321, 5, 'CoEd 201 (BSED-E)', 'Foundation of Special and Inclusive Education', 3, '', '2nd Year'),
(322, 5, 'CSEE 204 (BSED-E)', 'Contemporary, Popular, and Emergent Literature', 3, '', '2nd Year'),
(323, 5, 'CSEE 205 (BSED-E)', 'Teaching and Assessment of Grammar', 3, '', '2nd Year'),
(324, 5, 'CSEE 305 (BSED-E)', 'Survey of Philippine Literature in English', 3, '', '2nd Year'),
(325, 5, 'GE 12 (BSED-E)', 'The Life and Works of Rizal', 3, '', '2nd Year'),
(326, 5, 'TTL 2E (BSED-E)', 'Technology for Teaching and Learning 2 (Technology in Langua', 3, '', '2nd Year'),
(327, 5, 'CALE 1 (BSED-E)', 'Assessment of Learning 1 (English)', 3, '', '2nd Year'),
(328, 5, 'CSEE 206 (BSED-E)', 'Language Programs and Policies in Multilingual Societies', 3, '', '2nd Year'),
(329, 5, 'CSEE 207 (BSED-E)', 'Mythology and Folklore', 3, '', '2nd Year'),
(330, 5, 'CSEE 208 (BSED-E)', 'Survey of Afro-Asian Literature', 3, '', '2nd Year'),
(331, 5, 'CSEE 209 (BSED-E)', 'Technical Writing', 3, '', '2nd Year'),
(332, 5, 'Research 1 (BSED-E)', 'Introduction to Thesis Writing', 3, '', '3rd Year'),
(333, 5, 'CALE 2 (BSED-E)', 'Assessment in Learning 2 (English)', 3, '', '3rd Year'),
(334, 5, 'SEM 1 (BSED-E)', 'Seminar in Teaching MEFSS 1', 3, '', '3rd Year'),
(335, 5, 'CoEd 101 (BSED-E)', 'Building and Enhancing New Literacies Across the Curriculum', 3, '', '3rd Year'),
(336, 5, 'CoEd 305 (BSED-E)', 'The Teacher and the Community, School Culture and Organizati', 3, '', '3rd Year'),
(337, 5, 'CSEE 301 (BSED-E)', 'Survey of English and American Literature', 3, '', '3rd Year'),
(338, 5, 'CSEE 303 (BSED-E)', 'Campus Journalism', 3, '', '3rd Year'),
(339, 5, 'SEM 2 (BSED-E)', 'Seminar in Teaching MEFSS 2', 3, '', '3rd Year'),
(340, 5, 'CSEE 302 (BSED-E)', 'Literary Criticism', 3, '', '3rd Year'),
(341, 5, 'CSEE 304 (BSED-E)', 'Teaching and Assessment of Literature Studies', 3, '', '3rd Year'),
(342, 5, 'CSEE 306 (BSED-E)', 'Language Learning Materials Development', 3, '', '3rd Year'),
(343, 5, 'CSEE 307 (BSED-E)', 'Language Education Research', 3, '', '3rd Year'),
(344, 5, 'Research 2 (BSED-E)', 'Thesis Writing', 3, '', '3rd Year'),
(345, 5, 'FS 1 (BSED-E)', 'Observation of Teaching- Learning in Actual School Environme', 3, '', '3rd Year'),
(346, 5, 'FS 2 (BSED-E)', 'Participation and Teaching Assistantship', 3, '', '3rd Year'),
(347, 6, 'GE 1 (BEED)', 'Understanding the Self', 3, '', '1st Year'),
(348, 6, 'GE 2 (BEED)', 'Readings in Philippine History', 3, '', '1st Year'),
(349, 6, 'GE 3 (BEED)', 'The Contemporary World', 3, '', '1st Year'),
(350, 6, 'NSTP 1 (BEED)', 'Civic Welfare Training Service 1', 3, '', '1st Year'),
(351, 6, 'CoEd 100 (BEED)', 'The Child and Adolescent Learners and Learning Principles', 3, '', '1st Year'),
(352, 6, 'CoEd 101 (BEED)', 'Building and Enhancing New Literacies Across the Curriculum', 3, '', '1st Year'),
(353, 6, 'GE 4 (BEED)', 'Mathematics in the Modern World', 3, '', '1st Year'),
(354, 6, 'GE 5 (BEED)', 'Purposive Communication', 3, '', '1st Year'),
(355, 6, 'GE 6 (BEED)', 'Art Appreciation', 3, '', '1st Year'),
(356, 6, 'PATH Fit 1 (BEED)', 'Movement Competency Training', 2, '', '1st year'),
(357, 6, 'NSTP 2 (BEED)', 'Civic Welfare Training Service 2', 3, '', '1st Year'),
(358, 6, 'CoEd 102 (BEED)', 'Teaching Math in the Primary Grades', 3, '', '1st Year'),
(359, 6, 'CoEd 103 (BEED)', 'Facilitating Learner-Centered Teaching', 3, '', '1st Year'),
(360, 6, 'GE 7 (BEED)', 'Science, Technology and Society', 3, '', '1st Year'),
(361, 6, 'GE 8 (BEED)', 'Ethics', 3, '', '1st Year'),
(362, 6, 'PATH Fit 2 (BEED)', 'Exercise-based Fitness Activity', 2, '', '1st year'),
(363, 6, 'CoEd 104 (BEED)', 'The Teaching Profession\r\n(Edukasyon sa Pagpapakatao)', 3, '', '1st Year'),
(364, 6, 'CoEd 105 (BEED)', 'Good Manners and Right Conduct \r\n(Edukasyon sa Pagpapakatao)', 3, '', '1st Year'),
(365, 6, 'CoEd 106 (BEED)', 'Teaching Social Studies in Elementary Grades\r\n(Culture and G', 3, '', '1st Year'),
(366, 6, 'CoEd 107 (BEED)', 'Teaching Social Studies in Elementary Grades (Philippine His', 3, '', '1st Year'),
(367, 5, 'PRACTICUM (BSED-E)', 'Teaching Internship', 6, '', '3rd Year'),
(368, 6, 'GE 9 (BEED)', 'Gender and Society', 3, '', '2nd Year'),
(369, 6, 'GE 10 (BEED)', 'Philippine Popular Culture', 3, '', '2nd Year'),
(370, 6, 'GE 11 (BEED)', 'Living in an IT Era', 3, '', '2nd Year'),
(371, 6, 'PATH Fit 3 (BEED)', 'Dance and Sports', 2, '', '2nd Year'),
(372, 6, 'CoEd 200 (BEED)', 'Content and Pedagogy for the Mother-Tongue', 3, '', '2nd Year'),
(373, 6, 'CoEd 201 (BEED)', 'Foundations of Special and Inclusive Education', 3, '', '2nd Year'),
(374, 6, 'CoEd 202 (BEED)', 'The Teacher and the School Curriculum', 3, '', '2nd Year'),
(375, 6, 'PATH Fit 4 (BEED)', 'Outdoor and Adventure Activities', 2, '', '2nd Year'),
(376, 6, 'TTL 1 (BEED)', 'Technology for Teaching & Learning 1', 3, '', '2nd Year'),
(377, 6, 'CoEd 203 (BEED)', 'Teaching Science in Elementary Grades (Biology and Chemistry', 3, '', '2nd Year'),
(378, 6, 'CoEd 204 (BEED)', 'Pagtuturo ng Filipino sa Elementarya (I) Estruktura at Gamit', 3, '', '2nd Year'),
(379, 6, 'CoEd 205 (BEED)', 'Teaching English in the Elementary Grades (Language Arts)', 3, '', '2nd Year'),
(380, 6, 'CoEd 206 (BEED)', 'Teaching English in Elementary Grades Through Literature', 3, '', '2nd Year'),
(381, 6, 'GE 12 (BEED)', 'The Life and Works of Rizal', 3, '', '2nd Year'),
(382, 6, 'TTL 2 (BEED)', 'Technology for Teaching and Learning in the Elementary Grade', 3, '', '2nd Year'),
(383, 6, 'CAL 1 (BEED)', 'Assessment in Learning 1 (BEED)', 3, '', '2nd Year'),
(384, 6, 'CoEd 207 (BEED)', 'Teaching Science in Elementary Grades (Physics, Earth and Sp', 3, '', '2nd Year'),
(385, 6, 'CoEd 208 (BEED)', 'Pagtuturo ng Filipino sa Elementarya (II) Panitikan ng Pilip', 3, '', '2nd Year'),
(386, 6, 'CoEd 209 (BEED)', 'Teaching Math in the Intermediate Grades', 3, '', '2nd Year'),
(387, 6, 'CAL 2 (BEED)', 'Assessment in Learning 2 (BEED)', 3, '', '3rd Year'),
(388, 6, 'SEM 1 (BEED)', 'Seminar in Teaching MEFSS 1', 3, '', '3rd Year'),
(389, 6, 'CoEd 300 (BEED)', 'Teaching PE and Health in the Elementary Grades', 3, '', '3rd Year'),
(390, 6, 'CoEd 301 (BEED)', 'Edukasyong Pantahanan at Pangkabuhayan', 3, '', '3rd Year'),
(391, 6, 'CoEd 302 (BEED)', 'Teaching Arts in the Elementary Grades', 3, '', '3rd Year'),
(392, 6, 'CoEd 303 (BEED)', 'Teaching Music in the Elementary Grades', 3, '', '3rd Year'),
(393, 6, 'CoEd 304 (BEED)', 'Research in Education', 3, '', '3rd Year'),
(394, 6, 'Elective 1 (BEED)', 'Teaching Multi-Grade Classes', 3, '', '3rd Year'),
(395, 6, 'Elective 2 (BEED)', 'English for Specific Purposes', 3, '', '3rd Year'),
(396, 6, 'Research 1 (BEED)', 'Introduction to Thesis Writing', 3, '', '3rd Year'),
(397, 6, 'SEM 2 (BEED)', 'Seminar in Teaching MEFSS 2', 3, '', '3rd Year'),
(398, 6, 'CoEd 305 (BEED)', 'The Teacher and the Community, School Culture and Organizati', 3, '', '3rd Year'),
(399, 6, 'CoEd 306 (BEED)', 'Edukasyong Pantahanan at Pangkabuhayan with Entrepreneurship', 3, '', '3rd Year'),
(400, 6, 'Research 2 (BEED)', 'Thesis Writing', 3, '', '3rd Year'),
(401, 6, 'FS 1 (BEED)', 'Observation of Teaching- Learning in Actual School Environme', 3, '', '3rd Year'),
(402, 6, 'FS 2 (BEED)', 'Participation and Teaching Assistantship', 3, '', '3rd Year'),
(403, 6, 'PRACTICUM (BEED)', 'Teaching Internship', 6, '', '3rd Year'),
(404, 7, 'GE 1 (BSED-SC)', 'Understanding the Self', 3, '', '1st Year'),
(405, 7, 'GE 2 (BSED-SC)', 'Readings in Philippine History', 3, '', '1st Year'),
(406, 7, 'GE 3 (BSED-SC)', 'The Contemporary World', 3, '', '1st Year'),
(407, 7, 'GE 4 (BSED-SC)', 'Mathematics in the Modern World', 3, '', '1st Year'),
(408, 7, 'NSTP 1 (BSED-SC)', 'Civic Welfare Training Service 1', 3, '', '1st Year'),
(409, 7, 'CSES 101 (BSED-SC)', 'Geography 1 (Human Geography)', 3, '', '1st Year'),
(410, 7, 'GE 5 (BSED-SC)', 'Purposive Communication', 3, '', '1st Year'),
(411, 7, 'GE 6 (BSED-SC)', 'Art Appreciation', 3, '', '1st Year'),
(412, 7, 'GE 7 (BSED-SC)', 'Science, Technology & Society', 3, '', '1st Year'),
(413, 7, 'PE 1 (BSED-SC)', 'Physical Fitness', 2, '', '1st year'),
(414, 7, 'NSTP 2 (BSED-SC)', 'Civic Welfare Training Service 2', 3, '', '1st Year'),
(415, 7, 'CoEd 100 (BSED-SC)', 'The Child and Adolescent Learners and Learning Principles', 3, '', '1st Year'),
(416, 7, 'CSES 102 (BSED-SC)', 'Geography 2', 3, '', '1st Year'),
(417, 7, 'GE 8 (BSED-SC)', 'Ethics', 3, '', '1st Year'),
(418, 7, 'GE 9 (BSED-SC)', 'Introduksyon sa Pag- aaral ng Wika', 3, '', '1st Year'),
(419, 7, 'GE 10 (BSED-SC)', 'Panitikan ng Pilipinas', 3, '', '1st Year'),
(420, 7, 'CoEd 103 (BSED-SC)', 'Facilitating Learner-Centered Teaching', 3, '', '1st Year'),
(421, 7, 'CoEd 104 (BSED-SC)', 'The Teaching Profession', 3, '', '1st Year'),
(422, 7, 'CSES 103 (BSED-SC)', 'Geography 3', 3, '', '1st Year'),
(423, 7, 'PE 2 (BSED-SC)', 'Rhythmic Activities', 2, '', '1st year'),
(424, 7, 'GE 11 (BSED-SC)', 'Pagpapahalaga sa Kulturang Pilipino', 3, '', '2nd Year'),
(425, 7, 'PE  3 (BSED-SC)', 'Individual/ Dual Sports/ Games', 2, '', '2nd Year'),
(426, 7, 'CoEd 202 (BSED-SC)', 'The Teacher and the School Curriculum', 3, '', '2nd Year'),
(427, 7, 'CSES 201 (BSED-SC)', 'Foundation of Social Studies', 3, '', '2nd Year'),
(428, 7, 'CSES 202 (BSED-SC)', 'Asian Studies', 3, '', '2nd Year'),
(429, 7, 'CSES 203 (BSED-SC)', 'Places and Landscape in a Changing World', 3, '', '2nd Year'),
(430, 7, 'CSES 204 (BSED-SC)', 'Micro Economics', 3, '', '2nd Year'),
(431, 7, 'PE 4 (BSED-SC)', 'Recreational Activities', 2, '', '2nd Year'),
(432, 7, 'TTL 1 (BSED-SC)', 'Technology for Teaching and Learning 1', 3, '', '2nd Year'),
(433, 7, 'CoEd 201 (BSED-SC)', 'Foundation of Special and Inclusive Education', 3, '', '2nd Year'),
(434, 7, 'CSES 205 (BSED-SC)', 'World History 1', 3, '', '2nd Year'),
(435, 7, 'CSES 206 (BSED-SC)', 'Macro Economics', 3, '', '2nd Year'),
(436, 7, 'CSES 207 (BSED-SC)', 'Integrative Methods in Teaching Social Science discipline in', 3, '', '2nd Year'),
(437, 7, 'GE 12 (BSED-SC)', 'The Life and Works of Rizal', 3, '', '2nd Year'),
(438, 7, 'Elective 1S (BSED-SC)', 'Basic of School Management and Administration', 3, '', '2nd Year'),
(439, 7, 'TTL 2S (BSED-SC)', 'Technology for Teaching and Learning 2\r\n(Social Studies)', 3, '', '2nd Year'),
(440, 7, 'CALS 1 (BSED-SC)', 'Assessment of Learning 1 (Social Studies)', 3, '', '2nd Year'),
(441, 7, 'CSES 208 (BSED-SC)', 'World History 2', 3, '', '2nd Year'),
(442, 7, 'CSES 209 (BSED-SC)', 'Law-Related Studies', 3, '', '2nd Year'),
(443, 7, 'CSES 210 (BSED-SC)', 'Comparative Government and Politics', 3, '', '2nd Year'),
(444, 7, 'Elective 2S (BSED-SC)', 'Human Resources Management', 3, '', '3rd Year'),
(445, 7, 'CALS 2 (BSED-SC)', 'Assessment of Learning 2 (Social Studies)', 3, '', '3rd Year'),
(446, 7, 'SEM 1 (BSED-SC)', 'Seminar in Teaching MEFSS', 3, '', '3rd Year'),
(447, 7, 'CoEd 101 (BSED-SC)', 'Building and Enhancing New Literacies Across the Curriculum', 3, '', '3rd Year'),
(448, 7, 'CSES 301 (BSED-SC)', 'Assessment and Evaluation in the Social Sciences', 3, '', '3rd Year'),
(449, 7, 'CSES 302 (BSED-SC)', 'Production of Social Studies Instructional Materials', 3, '', '3rd Year'),
(450, 7, 'CSES 303 (BSED-SC)', 'Research in Social Studies', 3, '', '3rd Year'),
(451, 7, 'Research 1 (BSED-SC)', 'Introduction to Thesis Writing', 3, '', '3rd Year'),
(452, 7, 'SEM 2 (BSED-SC)', 'Seminar in Teaching MEFSS', 3, '', '3rd Year'),
(453, 7, 'CoEd 305 (BSED-SC)', 'The Teacher and the Community, School Culture and Organizati', 3, '', '3rd Year'),
(454, 7, 'CSES 305 (BSED-SC)', 'Teaching Approach in Secondary Social Studies', 3, '', '3rd Year'),
(455, 7, 'CSES 306 (BSED-SC)', 'Comparative Economic Planning', 3, '', '3rd Year'),
(456, 7, 'CSES 307 (BSED-SC)', 'Trends and Issues in Social Studies', 3, '', '3rd Year'),
(457, 7, 'Research 2 (BSED-SC)', 'Thesis Writing', 3, '', '3rd Year'),
(458, 7, 'FS 1 (BSED-SC)', 'Observation of Teaching- Learning in Actual School Environme', 3, '', '3rd Year'),
(459, 7, 'FS 2 (BSED-SC)', 'Participation and Teaching Assistantship', 3, '', '3rd Year'),
(460, 7, 'CSES 304 (BSED-SC)', 'Socio-Cultural Anthropology', 3, '', '3rd Year'),
(461, 7, 'PRACTICUM (BSED-SC)', 'Teaching Internship', 6, '', '3rd Year'),
(462, 8, 'GE 1 (BSED-M)', 'Understanding the Self', 3, '', '1st Year'),
(463, 8, 'GE 2 (BSED-M)', 'Readings in Philippine History', 3, '', '1st Year'),
(464, 8, 'GE 3 (BSED-M)', 'The Contemporary World', 3, '', '1st Year'),
(465, 8, 'GE 4 (BSED-M)', 'Mathematics in the Modern World', 3, '', '1st Year'),
(466, 8, 'NSTP 1 (BSED-M)', 'Civic Welfare Training Service 1', 3, '', '1st Year'),
(467, 8, 'CSEM 101 (BSED-M)', 'History of Mathematics', 3, '', '1st Year'),
(469, 8, 'GE 5 (BSED-M)', 'Purposive Communication', 3, '', '1st Year'),
(470, 8, 'GE 6 (BSED-M)', 'Art Appreciation', 3, '', '1st Year'),
(471, 8, 'GE 7 (BSED-M)', 'Science, Technology and Society', 3, '', '1st Year'),
(472, 8, 'PE 1 (BSED-M)', 'Physical Fitness', 2, '', '1st year'),
(473, 8, 'NSTP 2 (BSED-M)', 'Civic Welfare Training Service 2', 3, '', '1st Year'),
(474, 8, 'CoEd 100 (BSED-M)', 'The Child and Adolescent Learners and Learning Principles', 3, '', '1st Year'),
(475, 8, 'CSEM 102 (BSED-M)', 'College and Advanced Algebra', 3, '', '1st Year'),
(476, 8, 'GE 8 (BSED-M)', 'Ethics', 3, '', '1st Year'),
(477, 8, 'GE 9 (BSED-M)', 'Introduksyon sa Pag- aaral ng Wika', 3, '', '1st Year'),
(478, 8, 'PE 2 (BSED-M)', 'Rhythmic Activities', 2, '', '1st year'),
(479, 8, 'CoEd 101 (BSED-M)', 'Building and Enhancing New Literacies Across the Curriculum', 3, '', '1st Year'),
(480, 8, 'CoEd 104 (BSED-M)', 'The Teaching Profession', 3, '', '1st Year'),
(481, 8, 'CSEM 103 (BSED-M)', 'Logic and Set Theory', 3, '', '1st Year'),
(482, 8, 'CSEM 104 (BSED-M)', 'Mathematics of Investment', 3, '', '1st Year'),
(483, 8, 'GE 10 (BSED-M)', 'Panitikan ng Regiyon', 3, '', '2nd Year'),
(484, 8, 'GE 11 (BSED-M)', 'Pagpapahalaga sa Kulturang Pilipino', 3, '', '2nd Year'),
(485, 8, 'PE  3 (BSED-M)', 'Individual/ Dual Sports/ Games', 2, '', '2nd Year'),
(486, 8, 'CoEd 103 (BSED-M)', 'Facilitating Learner-Centered Teaching', 3, '', '2nd Year'),
(487, 8, 'CSEM 201 (BSED-M)', 'Plane and Solid Geometry', 3, '', '2nd Year'),
(488, 8, 'CSEM 202 (BSED-M)', 'Abstract Algebra', 3, '', '2nd Year'),
(489, 8, 'CSEM 203 (BSED-M)', 'Trigonometry', 3, '', '2nd Year'),
(490, 8, 'PE4 (BSED-M)', 'Recreational Activities', 2, '', '2nd Year'),
(491, 8, 'TTL 1 (BSED-M)', 'Technology for Teaching and Learning 1', 3, '', '2nd Year'),
(492, 8, 'CSEM 204 (BSED-M)', 'Modern Geometry', 3, '', '2nd Year'),
(493, 8, 'CSEM 205 (BSED-M)', 'Elementary Statistics & Probability', 3, '', '2nd Year'),
(494, 8, 'CSEM 206 (BSED-M)', 'Number Theory', 3, '', '2nd Year'),
(495, 8, 'CSEM 207 (BSED-M)', 'Linear Algebra', 3, '', '2nd Year'),
(496, 8, 'GE 12 (BSED-M)', 'The Life and Works of Rizal', 3, '', '2nd Year'),
(497, 8, 'TTL 2M (BSED-M)', 'Technology for Teaching and Learning 2 (Instrumentation and ', 3, '', '2nd Year'),
(498, 8, 'CALM 1 (BSED-M)', 'Assessment in Learning 1 (Mathematics)', 3, '', '2nd Year'),
(499, 8, 'CSEM 208 (BSED-M)', 'Calculus 1 (with Analytic Geometry)', 4, '', '2nd Year'),
(500, 8, 'CSEM 209 (BSED-M)', 'Problem Solving, Mathematical Investigations and Modelling', 3, '', '2nd Year'),
(501, 8, 'CSEM 210 (BSED-M)', 'Advanced Statistics', 3, '', '2nd Year'),
(502, 8, 'CALM 2 (BSED-M)', 'Assessment in Learning 2 (Mathematics)', 3, '', '3rd Year'),
(503, 8, 'SEM 1 (BSED-M)', 'Seminar in Teaching MEFSS 1', 3, '', '3rd Year'),
(504, 8, 'CoEd 201 (BSED-M)', 'Foundation of Special and Inclusive Education', 3, '', '3rd Year'),
(505, 8, 'CSEM 301 (BSED-M)', 'Principle and Strategies of Teaching Mathematics', 3, '', '3rd Year'),
(506, 8, 'CSEM 302 (BSED-M)', 'Calculus II', 3, '', '3rd Year'),
(507, 8, 'CSEM 303 (BSED-M)', 'Assessment and Evaluation in Mathematics', 3, '', '3rd Year'),
(508, 8, 'CSEM 304 (BSED-M)', 'Research in Mathematics', 4, '', '3rd Year'),
(509, 8, 'Research 1 (BSED-M)', 'Introduction to Thesis Writing', 3, '', '3rd Year'),
(510, 8, 'SEM 2 (BSED-M)', 'Seminar in Teaching MEFSS 2', 3, '', '3rd Year'),
(511, 8, 'CoEd 202 (BSED-M)', 'The Teacher and the School Curriculum', 3, '', '3rd Year'),
(512, 8, 'CoEd 305 (BSED-M)', 'The Teacher and the Community, School Culture and Organizati', 3, '', '3rd Year'),
(513, 8, 'CSEM 305 (BSED-M)', 'Calculus III', 4, '', '3rd Year'),
(514, 8, 'Research 2 (BSED-M)', 'Thesis Writing', 3, '', '3rd Year'),
(515, 8, 'FS 1 (BSED-M)', 'Observation of Teaching- Learning in Actual School Environme', 3, '', '3rd Year'),
(516, 8, 'FS 2 (BSED-M)', 'Participation and Teaching Assistantship', 3, '', '3rd Year'),
(517, 8, 'PRACTICUM (BSED-M)', 'Teaching Internship', 6, '', '3rd Year'),
(518, 9, 'Education 201 (MAED-N)', 'Advanced Methods of Research', 3, '', 'Graduate'),
(519, 9, 'Education 202 (MAED-N)', 'Adr anced Statistics in Education', 3, '', 'Graduate'),
(520, 9, 'Education 203 (MAED-N)', 'Philo-Sociological Foundations of Education', 3, '', 'Graduate'),
(521, 9, 'Education 204 (MAED-N)', 'Psychological Foundations of Education', 3, '', 'Graduate'),
(522, 9, 'Education 206 (MAED-N)', 'Theories and Practices in School Administration\r\nand Supervi', 3, '', 'Graduate'),
(523, 9, 'Education 205 (MAED-N)', 'Legal Aspects in School Administration and\r\nSupervision', 3, '', 'Graduate'),
(524, 9, 'Education 207 (MAED-N)', 'Advanced Curriculum Development', 3, '', 'Graduate'),
(525, 9, 'Education 210 (MAED-N)', 'Public Policy Analysis', 3, '', 'Graduate'),
(526, 9, 'Education 209 (MAED-N)', 'Educational Planning', 3, '', 'Graduate'),
(527, 9, 'Education 208 (MAED-N)', 'Research Seminar and Practicum', 3, '', 'Graduate'),
(528, 9, 'Education 213 (MAED-N)', 'Human Behavior in an Organization', 3, '', 'Graduate'),
(529, 9, 'Education 211 (MAED-N)', 'School Finance in a Changing Society', 3, '', 'Graduate'),
(530, 9, 'Education 212 (MAED-N)', 'Current Trends and Issues in Education', 3, '', 'Graduate'),
(531, 9, 'Education 21 4 (MAED-N)', 'Principles and Theories of Personality Development', 3, '', 'Graduate'),
(532, 9, 'Computer 1 (MAED-N)', 'Advanced Computer 1\r\n(Practical Application of Computer Soft', 3, '', 'Graduate'),
(533, 10, 'Educ. 201 (MAED-O)', 'Research Methods', 3, '', 'Graduate'),
(534, 10, 'Educ. 202 (MAED-O)', 'Statistics', 3, '', 'Graduate'),
(535, 10, 'Educ. 203 (MAED-O)', 'Adv. Philosophy of Educ.', 3, '', 'Graduate'),
(536, 10, 'Computer I (MAED-O)', 'Basic Computer |', 3, '', 'Graduate'),
(537, 10, 'Computer II (MAED-O)', 'Multimedia Development', 3, '', 'Graduate'),
(538, 10, 'Educ. 204 (MAED-O)', 'Principles and Theories of Educational Management', 3, '', 'Graduate'),
(539, 10, 'Educ. 205 (MAED-O)', 'School Legislation', 3, '', 'Graduate'),
(540, 10, 'Educ. 206 (MAED-O)', 'Human Behavior in Organization', 3, '', 'Graduate'),
(541, 10, 'MEM 207 (MAED-O)', 'Curriculum Development and Evaluation', 3, '', 'Graduate'),
(542, 10, 'MEM 208 (MAED-O)', 'Educational Leadership', 3, '', 'Graduate'),
(543, 10, 'Educ. 209 (MAED-O)', 'School Plant and planning', 3, '', 'Graduate'),
(544, 10, 'Educ. 210 (MAED-O)', 'Perspective Management in Educt l Org', 3, '', 'Graduate'),
(545, 10, 'Educ. 211 (MAED-O)', 'Institutional Education Fiscal Mgt', 3, '', 'Graduate'),
(546, 10, 'Educ. 212 (MAED-O)', 'Organization & Management in Higher Education', 3, '', 'Graduate'),
(547, 10, 'Educ. 213 (MAED-O)', 'Current Trends in Phil Education', 3, '', 'Graduate'),
(548, 10, 'Educ.214 (MAED-O)', 'Principles & Techniques of Guidance and Counseling', 3, '', 'Graduate'),
(549, 10, 'Educ.215 (MAED-O)', 'Teaching Process in Elementary Education', 3, '', 'Graduate'),
(550, 10, 'Educ.216 (MAED-O)', 'Issues and Functions in Secondary Education', 3, '', 'Graduate'),
(551, 10, 'Educ.217 (MAED-O)', 'Human Resource Management', 3, '', 'Graduate'),
(552, 10, 'Educ. 218 (MAED-O)', 'Thesis Seminar', 3, '', 'Graduate'),
(553, 10, 'Educ. 220 (MAED-O)', 'Thesis Writing', 6, '', 'Graduate'),
(554, 1, 'MIT-0001', 'for graduate', 5, '', 'Graduate');

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
(24, 'andy', '', 'anderson', 'andyanderson895@yahoo.com', 'andyanderson895', '$2y$10$coNIitr1ogZfvjC0pZ4Sv.J8fz7q3P3Pzi07064MYnDgoRv7zh8MK', 'admin', 'profile_66d4a8ddcd5f89.27748458.jpg', 1),
(25, 'Mark', '', 'Espadera', 'gab@gmail.com', 'callmegab', '$2y$10$hYaB7MmcE4RYVQM9IaA3iOQE30lYpWC6njTXtKq2ktk6HnRioIbcC', 'super_admin', 'profile_66e19f52940eb8.36184867.jpeg', 1);

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
  ADD PRIMARY KEY (`ss_id`),
  ADD KEY `ss_stud_id` (`ss_stud_id`);

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
  MODIFY `dept_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `stud_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2147483648;

--
-- AUTO_INCREMENT for table `student_subject`
--
ALTER TABLE `student_subject`
  MODIFY `ss_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=555;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `student_subject`
--
ALTER TABLE `student_subject`
  ADD CONSTRAINT `student_subject_ibfk_1` FOREIGN KEY (`ss_stud_id`) REFERENCES `student` (`stud_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
