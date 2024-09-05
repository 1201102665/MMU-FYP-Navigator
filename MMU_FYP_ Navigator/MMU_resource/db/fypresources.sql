-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2024 at 04:51 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fypresources`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `announcement_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`announcement_id`, `user_id`, `title`, `content`, `created_at`) VALUES
(10, 2, 'New Feature Release: Resource Upload', 'We are excited to announce the launch of our new Resource Upload feature! MMU students can now easily upload and share final year project resources through our user-friendly web application. Check it out in the \'Resources\' section of your dashboard.', '2024-06-23 13:23:00'),
(11, 2, 'Scheduled Maintenance', 'Please be aware that our website will undergo scheduled maintenance on July 5th, 2024, from 12:00 AM to 4:00 AM. During this time, the site may be temporarily unavailable. We apologize for any inconvenience and appreciate your understanding.', '2024-06-23 13:23:19'),
(12, 2, 'New Final Year Project Resources Added', 'We have added new final year project resources across various subjects. MMU students, make sure to check out the latest additions in the \'Resources\' section to help you with your projects.', '2024-06-23 13:23:42');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `resource_id` int(11) DEFAULT NULL,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faculties`
--

CREATE TABLE `faculties` (
  `faculty_id` int(11) NOT NULL,
  `faculty_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faculties`
--

INSERT INTO `faculties` (`faculty_id`, `faculty_name`) VALUES
(1, 'FCI'),
(2, 'FCM'),
(3, 'FOE'),
(4, 'FOM'),
(5, 'FAC');

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `id` int(11) NOT NULL,
  `question` text NOT NULL,
  `answer` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faq`
--

INSERT INTO `faq` (`id`, `question`, `answer`, `created_at`) VALUES
(10, 'hello who to change the profile picture', 'it is easy you can click your profile picture in the header\r\nand you will find manage your profile ', '2024-06-23 13:01:32'),
(11, 'from were i can make upload my resource	', 'You can upload your resource by logging into your account and navigating to the \'Upload Resource\' section on your dashboard header. Fill in the required details and follow the instructions to upload your file and cover picture.', '2024-06-23 13:55:30'),
(12, 'How can I change my email?', 'To change your email, log in to your account and go to the \'Profile\' section in the header. Click on the \'Manage Profile\' button and update your email address. Make sure to save the changes.', '2024-06-23 13:56:32');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `feedback_text` text NOT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedback_id`, `user_id`, `feedback_text`, `submitted_at`) VALUES
(12, 21, 'hi can you make the footer better please ', '2024-06-23 13:00:11'),
(13, 21, 'nice website but it need to be better ', '2024-06-23 13:31:39'),
(14, 21, 'the website is so good only if you can make a different design in the facture good luck ', '2024-06-23 13:32:51'),
(15, 21, 'The resource upload feature is incredibly user-friendly. I was able to upload my final year project materials in just a few minutes. The new updates have significantly improved the overall experience on the website.\r\n\r\n', '2024-06-23 13:51:41'),
(16, 29, 'I found the new resources added for the Faculty of Computing and Informatics extremely helpful. The content is well-structured and comprehensive. It has been a great aid in preparing for my exams.', '2024-06-23 13:52:13'),
(17, 29, 'The recent webinar on mastering final year projects was fantastic! The speakers provided valuable insights and practical tips that I can apply to my project. Looking forward to more such events.', '2024-06-23 13:52:24');

-- --------------------------------------------------------

--
-- Table structure for table `purchasedresources`
--

CREATE TABLE `purchasedresources` (
  `purchase_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `resource_id` int(11) DEFAULT NULL,
  `purchase_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `resources`
--

CREATE TABLE `resources` (
  `resource_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `pending_acceptance` tinyint(1) DEFAULT 1,
  `faculty_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `cover_picture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `resources`
--

INSERT INTO `resources` (`resource_id`, `user_id`, `title`, `description`, `file_path`, `pending_acceptance`, `faculty_id`, `created_at`, `price`, `cover_picture`) VALUES
(28, 21, 'Advanced Data Structures and Algorithms', 'This resource provides an in-depth exploration of advanced data structures and algorithms, focusing on their implementation and optimization. Topics covered include balanced trees, hash tables, graphs, and dynamic programming. Each section includes theoretical explanations, practical examples, and exercises to reinforce learning. Ideal for computer science students and professionals looking to enhance their knowledge in this crucial area.', 'resources/Algo_Report_Improved.docx', 0, 1, '2024-06-23 13:35:12', 15.00, 'coverPictures/WhatsApp Image 2024-06-23 at 21.04.45_afc88c17.jpg'),
(29, 29, 'Principles of Marketing', 'This comprehensive guide covers the fundamental principles of marketing, including market research, consumer behavior, branding, and digital marketing strategies. Designed for business students, this resource provides practical insights and case studies from various industries. It is an essential tool for understanding how to effectively market products and services in today&#39;s competitive environment.', 'resources/paid kawsar.pdf', 1, 5, '2024-06-23 13:38:00', 20.00, 'coverPictures/WhatsApp Image 2024-06-23 at 21.04.45_fbd400b0.jpg'),
(30, 29, 'Introduction to Quantum Mechanics', 'This resource offers a detailed introduction to the principles and applications of quantum mechanics. Topics include wave-particle duality, Schrödinger&#39;s equation, and quantum states. The material is suitable for physics students and anyone interested in understanding the fascinating world of quantum physics. It includes problem sets and solutions to enhance comprehension.', 'resources/Assignment_Marking_Scheme[1].pdf', 0, 3, '2024-06-23 13:38:47', 25.00, 'coverPictures/WhatsApp Image 2024-06-23 at 21.04.45_396a516b.jpg'),
(31, 29, 'Modern Web Development', 'This resource is a complete guide to modern web development, covering front-end and back-end technologies. Topics include HTML5, CSS3, JavaScript, React, Node.js, and database management. Ideal for computer science students and aspiring web developers, this resource includes practical projects and examples to build real-world applications.', 'resources/lecture-04.pdf', 1, 1, '2024-06-23 13:40:20', 30.00, 'coverPictures/WhatsApp Image 2024-06-23 at 21.04.45_396a516b.jpg'),
(32, 21, 'Financial Accounting Basics', 'This resource provides a thorough introduction to the basics of financial accounting. It covers key concepts such as the accounting cycle, financial statements, and accounting principles. Ideal for accounting students and professionals, this resource includes detailed examples and exercises to reinforce learning.', 'resources/Algo_Report_Sample.docx', 0, 2, '2024-06-23 13:41:13', 18.00, 'coverPictures/WhatsApp Image 2024-06-23 at 21.04.45_fbd400b0.jpg'),
(33, 21, 'Human Anatomy and Physiology', 'This resource is an extensive guide to human anatomy and physiology. It covers all major body systems, including the cardiovascular, respiratory, and nervous systems. The material is perfect for medical students and healthcare professionals. It includes detailed diagrams, illustrations, and quizzes to enhance understanding.', 'resources/Assignment_Marking_Scheme[1].pdf', 1, 5, '2024-06-23 13:41:58', 22.00, 'coverPictures/WhatsApp Image 2024-06-23 at 21.04.45_afc88c17.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `userquestions`
--

CREATE TABLE `userquestions` (
  `question_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `question_text` text NOT NULL,
  `asked_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `answer_text` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `userquestions`
--

INSERT INTO `userquestions` (`question_id`, `user_id`, `question_text`, `asked_at`, `answer_text`) VALUES
(37, 21, 'hello who to change the profile picture ', '2024-06-23 12:59:23', NULL),
(38, 21, 'from were i can make upload my resoruce ', '2024-06-23 13:30:33', NULL),
(39, 21, 'how to change my email ', '2024-06-23 13:30:44', NULL),
(40, 21, 'how to see my statues of my uploaded resources  ', '2024-06-23 13:31:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `is_admin` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `profile_picture`, `is_admin`, `created_at`) VALUES
(2, 'the king youssef 5', '$2y$10$gYvpC.cdzvLbeQt4WDVyHOw/0z/DzP7FBowj/GKcPKDYL0uGbuUJW', 'youssef@gmail.com', 'profilePicture/super/default.png', 1, '2024-06-13 06:23:14'),
(21, 'Youssef ', '$2y$10$BC0Rb.5MUeLe.ePduKedZ.gZqpOwYkBW2CGwyBav42zPoZHSL6qp6', '1221302092@student.mmu.edu.my', 'profilePicture/IMG_0020.JPG', 0, '2024-06-17 12:39:35'),
(29, 'baraa', '$2y$10$mXpk2yAyAc2/cmyPeOxME.hlVZ0WX9AsU8Pobxz1STtFKQ8k0J4D.', 'baraa@gmail.com', 'profilePicture/download.jpeg', 0, '2024-06-23 13:36:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`announcement_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `idx_cart_user_id` (`user_id`),
  ADD KEY `idx_cart_resource_id` (`resource_id`);

--
-- Indexes for table `faculties`
--
ALTER TABLE `faculties`
  ADD PRIMARY KEY (`faculty_id`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_id`),
  ADD KEY `idx_feedback_user_id` (`user_id`);

--
-- Indexes for table `purchasedresources`
--
ALTER TABLE `purchasedresources`
  ADD PRIMARY KEY (`purchase_id`),
  ADD KEY `idx_purchased_resources_user_id` (`user_id`),
  ADD KEY `idx_purchased_resources_resource_id` (`resource_id`);

--
-- Indexes for table `resources`
--
ALTER TABLE `resources`
  ADD PRIMARY KEY (`resource_id`),
  ADD KEY `idx_resources_user_id` (`user_id`),
  ADD KEY `idx_resources_faculty_id` (`faculty_id`);

--
-- Indexes for table `userquestions`
--
ALTER TABLE `userquestions`
  ADD PRIMARY KEY (`question_id`),
  ADD KEY `idx_user_questions_user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `announcement_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `faculties`
--
ALTER TABLE `faculties`
  MODIFY `faculty_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `purchasedresources`
--
ALTER TABLE `purchasedresources`
  MODIFY `purchase_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `resources`
--
ALTER TABLE `resources`
  MODIFY `resource_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `userquestions`
--
ALTER TABLE `userquestions`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`resource_id`) REFERENCES `resources` (`resource_id`) ON DELETE CASCADE;

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `purchasedresources`
--
ALTER TABLE `purchasedresources`
  ADD CONSTRAINT `purchasedresources_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `purchasedresources_ibfk_2` FOREIGN KEY (`resource_id`) REFERENCES `resources` (`resource_id`) ON DELETE CASCADE;

--
-- Constraints for table `resources`
--
ALTER TABLE `resources`
  ADD CONSTRAINT `resources_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `resources_ibfk_2` FOREIGN KEY (`faculty_id`) REFERENCES `faculties` (`faculty_id`) ON DELETE CASCADE;

--
-- Constraints for table `userquestions`
--
ALTER TABLE `userquestions`
  ADD CONSTRAINT `userquestions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
