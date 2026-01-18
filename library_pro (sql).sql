-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 18, 2026 at 05:24 PM
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
-- Database: `library_pro`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `category` varchar(100) DEFAULT 'General',
  `pdf_file` varchar(255) DEFAULT NULL,
  `book_type` varchar(20) DEFAULT 'Free'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `author`, `created_at`, `category`, `pdf_file`, `book_type`) VALUES
(4, 'સરસ્વતીચંદ્ર ', 'ગોવર્ધનરામ ત્રિપાઠી', '2026-01-17 05:32:30', 'Fiction', NULL, 'Free'),
(6, 'ગુજરાતનો નાથ ', ' કનૈયાલાલ મુનશી', '2026-01-17 05:35:30', 'Literature', NULL, 'Free'),
(7, 'માધવ ક્યાંય નથી', ' હરીન્દ્ર દવે', '2026-01-17 05:36:10', 'Literature', NULL, 'Free'),
(8, 'જય સોમનાથ ', ' કનૈયાલાલ મુનશી', '2026-01-17 05:36:42', 'Literature', NULL, 'Free'),
(9, 'વિજ્ઞાનના ૪૦૦ પ્રયોગો ', ' સુરેશ અગ્રવાલ', '2026-01-17 05:38:51', 'Science', NULL, 'Free'),
(10, 'Wings of Fire', 'Dr. A.P.J. Abdul Kalam', '2026-01-17 05:50:44', 'motivation', 'apj.pdf', 'Premium'),
(11, 'Rich Dad Poor Daa', 'Robert Kiyosaki', '2026-01-17 05:51:48', 'motivation', 'rich.pdf', 'Premium'),
(12, 'What is Life ?', 'Erwin Schrödinger', '2026-01-17 05:52:11', 'motivation', NULL, 'Premium'),
(13, 'Atomic HAabits', 'James Clear', '2026-01-17 05:52:50', 'motivation', 'Atomic.pdf', 'Free'),
(14, 'Fundamental of physics', 'Halliday & Resnick', '2026-01-17 05:53:57', 'Science', NULL, 'Premium'),
(15, 'The Sixth Extinction', 'Elizabeth Kolbert', '2026-01-17 05:55:30', 'Science', NULL, 'Free'),
(16, '૧૦ અને ૧૨ પછી શું?', '   -', '2026-01-17 06:00:50', 'Education', NULL, 'Premium'),
(17, 'જનરલ નોલેજ (GK)', '     -', '2026-01-17 06:01:20', 'Education', NULL, 'Premium'),
(18, 'યાદશક્તિ અને એકાગ્રતા', 'ડૉ. જીતેન્દ્ર અઢિયા', '2026-01-17 06:01:56', 'Education', NULL, 'Free'),
(19, '7 Habits of Highly Effective People', '   -', '2026-01-17 06:03:10', 'Self-Help', NULL, 'Free'),
(20, 'The Richest Man in Babylon', '   -', '2026-01-17 06:04:02', 'Self-Help', NULL, 'Free'),
(21, ' Playing It My Way', 'સચિન તેંડુલકર', '2026-01-17 06:06:02', 'Sports Books', NULL, 'Premium'),
(22, 'રેસ ઓફ માય લાઈફ	', 'મિલ્ખા સિંહ  (એથ્લેટિક્સ)', '2026-01-17 06:07:30', 'Sports Books', NULL, 'Free'),
(23, '\"French in 30 Days', ' Author: Berlitz', '2026-01-17 06:09:06', 'Languages', NULL, 'Premium'),
(24, 'Easy Spanish Step-by-Step', 'Barbara Bregstein', '2026-01-17 06:09:58', 'Languages', NULL, 'Premium'),
(25, '5 Language Visual Dictionary', 'DK Publishing', '2026-01-17 06:10:33', 'Languages', NULL, 'primium'),
(26, 'ગુજરાતનો ઇતિહાસ', 'ડૉ. આર. કે. ધારૈયા', '2026-01-17 06:14:36', 'History', NULL, 'Free'),
(27, 'સૌરાષ્ટ્રનો ઇતિહાસ', ' શંભુપ્રસાદ દેસાઈ', '2026-01-17 06:15:22', 'History', NULL, 'Free'),
(28, 'સત્યના પ્રયોગો ', ' મહાત્મા ગાંધી', '2026-01-17 06:16:06', 'History', 'mahatma.pdf', 'primium'),
(29, 'The C Programming Language', 'Dennis Ritchie', '2026-01-18 02:33:41', 'Programming', NULL, 'premium'),
(30, 'Head First Java	', 'Kathy Sierra & Bert Bates', '2026-01-18 02:34:27', 'Programming', NULL, 'premium'),
(31, 'Think Python', 'Allen B. Downey', '2026-01-18 02:34:56', 'Programming', NULL, 'premium'),
(32, 'Thomas H. Cormen (CLRS)', 'Thomas H. Cormen (CLRS)', '2026-01-18 02:35:22', 'Programming', NULL, 'premium'),
(33, 'Computer Networks', 'Andrew S. Tanenbaum', '2026-01-18 02:36:31', 'Programming', NULL, 'free'),
(34, 'Introduction to Algorithms	', 'Thomas H. Cormen (CLRS)', '2026-01-18 02:36:54', 'Programming', NULL, 'premium'),
(35, 'Zero to One', 'Peter Thiel	', '2026-01-18 03:29:21', 'bisness', NULL, 'Free'),
(36, ' Think and Grow Rich	', 'Napoleon Hill', '2026-01-18 03:30:27', 'bisness', NULL, 'Free'),
(37, 'The Lean Startup	', 'Eric Ries', '2026-01-18 03:30:52', 'bisness', NULL, 'Free'),
(38, 'Principles', 'Ray Dalio', '2026-01-18 03:31:12', 'bisness', NULL, 'Free'),
(39, 'કાવ્યધારા (Kavyadhara)	', 'ઉમાશંકર જોશી', '2026-01-18 03:33:04', 'Poim', NULL, 'Free'),
(40, ' મરીઝની ગઝલો', 'મરીઝ ', '2026-01-18 03:33:43', 'Poim', NULL, 'Free');

-- --------------------------------------------------------

--
-- Table structure for table `issued_books`
--

CREATE TABLE `issued_books` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `issue_date` date NOT NULL,
  `due_date` date NOT NULL,
  `return_date` date DEFAULT NULL,
  `status` varchar(20) DEFAULT 'Issued',
  `txn_id` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `issued_books`
--

INSERT INTO `issued_books` (`id`, `user_id`, `book_id`, `issue_date`, `due_date`, `return_date`, `status`, `txn_id`) VALUES
(1, 1, 1, '2026-01-16', '0000-00-00', NULL, 'issued', NULL),
(2, 1, 1, '2026-01-16', '0000-00-00', NULL, 'issued', NULL),
(3, 1, 1, '2026-01-17', '0000-00-00', NULL, 'issued', NULL),
(4, 1, 5, '2026-01-17', '0000-00-00', NULL, 'issued', NULL),
(5, 1, 11, '2026-01-17', '0000-00-00', NULL, 'issued', NULL),
(6, 2, 5, '2026-01-17', '0000-00-00', NULL, 'issued', NULL),
(7, 2, 7, '2026-01-17', '0000-00-00', NULL, 'issued', NULL),
(8, 2, 7, '2026-01-17', '0000-00-00', NULL, 'issued', NULL),
(9, 2, 12, '2026-01-17', '0000-00-00', NULL, 'issued', NULL),
(10, 3, 24, '2026-01-17', '0000-00-00', NULL, 'issued', NULL),
(11, 4, 14, '2026-01-17', '0000-00-00', NULL, 'issued', NULL),
(12, 1, 4, '2026-01-17', '0000-00-00', NULL, 'issued', NULL),
(13, 4, 17, '2026-01-18', '0000-00-00', NULL, 'issued', NULL),
(14, 4, 11, '2026-01-18', '0000-00-00', NULL, 'issued', NULL),
(15, 4, 10, '2026-01-18', '0000-00-00', NULL, 'issued', NULL),
(16, 6, 15, '2026-01-18', '0000-00-00', NULL, 'issued', NULL),
(17, 51, 4, '2026-01-18', '0000-00-00', NULL, 'issued', NULL),
(18, 51, 7, '2026-01-18', '0000-00-00', NULL, 'issued', NULL),
(19, 1, 10, '2026-01-18', '0000-00-00', NULL, 'issued', NULL),
(20, 1, 10, '2026-01-18', '0000-00-00', NULL, 'issued', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_status` varchar(50) DEFAULT 'Pending',
  `transaction_id` varchar(100) DEFAULT NULL,
  `plan_name` varchar(100) DEFAULT 'Premium',
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `user_id`, `amount`, `payment_status`, `transaction_id`, `plan_name`, `payment_date`) VALUES
(1, 1, 0.00, 'Completed', '121212 1111111111111111111', 'Monthly', '2026-01-16 16:30:53'),
(2, 1, 0.00, 'Completed', '22222222222222222222222222222222222222222222222222222222222222222222222222', 'Monthly', '2026-01-16 16:32:47'),
(3, 1, 199.00, 'Completed', '121212 11111', 'Monthly', '2026-01-16 16:42:30'),
(4, 1, 199.00, 'Completed', '444444444444', 'Monthly', '2026-01-16 16:45:43'),
(5, 1, 199.00, 'Completed', '111111111111', 'Monthly', '2026-01-16 16:47:04'),
(6, 1, 199.00, 'Completed', '222222222222', 'Monthly', '2026-01-17 02:09:13'),
(8, 3, 499.00, 'Completed', '676767676767', 'yearly', '2026-01-17 11:12:26'),
(9, 4, 99.00, 'Completed', '222222222220', 'monthly', '2026-01-17 16:10:12'),
(19, 7, 999.00, 'Completed', '221622162216', 'Yearly', '2026-01-18 05:53:14'),
(20, 7, 999.00, 'Completed', '221622162216', 'Yearly', '2026-01-18 05:54:06'),
(21, 8, 19.00, 'Completed', '7888888888888', 'Monthly', '2026-01-18 06:27:47');

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

CREATE TABLE `plans` (
  `id` int(11) NOT NULL,
  `plan_name` varchar(50) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `validity_days` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `plans`
--

INSERT INTO `plans` (`id`, `plan_name`, `price`, `validity_days`) VALUES
(1, 'Monthly', 19.00, 30),
(2, 'Yearly', 999.00, 365);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` int(1) DEFAULT 1,
  `user_type` varchar(20) DEFAULT 'Free',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_premium` int(1) DEFAULT 0,
  `plan_expiry` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `password`, `status`, `user_type`, `created_at`, `is_premium`, `plan_expiry`) VALUES
(1, 'disha', 'disha@gmail.com', 'disha', 1, 'Free', '2026-01-16 11:47:41', 1, '2027-01-17'),
(3, 'rekha', 'rekha@gmail.com', 'rekha', 1, 'Free', '2026-01-17 11:11:49', 1, '2027-01-17'),
(4, 'laptop', 'laptop@gmail.com', 'laptop', 1, 'Free', '2026-01-17 16:08:51', 1, '2026-02-16'),
(5, 'eshitabe', 'eshita@gmail.com', 'eshita', 1, 'Free', '2026-01-18 05:46:14', 0, NULL),
(6, 'muskan', 'muskan@gmail.com', 'muskan', 0, 'Free', '2026-01-18 06:11:02', 0, NULL),
(7, 'rajvi', 'rajvi@gmail.com', 'rajvi', 1, 'Free', '2026-01-18 10:22:47', 0, NULL),
(8, 'mobail', 'mobail@gmail.com', 'mobaol', 0, 'Free', '2026-01-18 10:55:48', 0, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `issued_books`
--
ALTER TABLE `issued_books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `issued_books`
--
ALTER TABLE `issued_books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
