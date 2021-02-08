-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 05, 2021 at 03:29 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gym`
--
CREATE DATABASE IF NOT EXISTS `gym` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `gym`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(100) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `password`, `first_name`, `last_name`) VALUES
(87000, 'klintjohn60@gmail.com', '$2y$10$I5JX347ujLO4i566c8qFeOIyTRy0eSdmkY.rs8Jz40.TH/.7xYeEG', 'klintjohn', 'cagot'),
(87001, 'weinnandhasanion@gmail.com', '$2y$10$gNnkz9JJ5nNYFRuMuPpFkuBha9A6KpXKZxcSES56MnJufxQDB/hLa', 'Weinnand', 'Hasanion');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `inventory_id` int(100) NOT NULL,
  `inventory_name` varchar(100) DEFAULT NULL,
  `inventory_category` enum('Cardio Equipment','Weight Equipment') DEFAULT NULL,
  `inventory_qty` int(255) DEFAULT NULL,
  `inventory_damage` int(255) DEFAULT NULL,
  `inventory_working` int(255) DEFAULT NULL,
  `inventory_description` varchar(255) DEFAULT NULL,
  `date_deleted` date DEFAULT NULL,
  `date_added` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `logtrail`
--

CREATE TABLE `logtrail` (
  `login_id` int(100) NOT NULL,
  `admin_id` int(100) DEFAULT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `dateandtime_login` datetime DEFAULT current_timestamp(),
  `dateandtime_logout` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logtrail`
--

INSERT INTO `logtrail` (`login_id`, `admin_id`, `first_name`, `last_name`, `dateandtime_login`, `dateandtime_logout`) VALUES
(3107, 87001, 'Weinnand', 'Hasanion', '2021-02-04 20:26:18', '2021-02-04 20:33:43'),
(3108, 87001, 'Weinnand', 'Hasanion', '2021-02-04 20:33:46', NULL),
(3109, 87001, 'Weinnand', 'Hasanion', '2021-02-05 20:44:38', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `logtrail_doing`
--

CREATE TABLE `logtrail_doing` (
  `logtrail_doing_id` int(100) NOT NULL,
  `login_id` int(100) NOT NULL,
  `admin_id` int(100) DEFAULT NULL,
  `member_id` int(100) DEFAULT NULL,
  `program_id` int(100) DEFAULT NULL,
  `trainer_id` int(100) DEFAULT NULL,
  `user_fname` varchar(100) DEFAULT NULL,
  `user_lname` varchar(100) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `identity` varchar(200) DEFAULT NULL,
  `time` varchar(15) DEFAULT NULL,
  `trainer_status` ENUM('active','inactive') DEFAULT NULL,
  `trainer_phone` varchar(100) DEFAULT NULL,
  `trainer_position`  ENUM('junior','senior') DEFAULT NULL,
  `trainer_address`  varchar(200) DEFAULT NULL
);
--
-- Dumping data for table `logtrail_doing`
--

INSERT INTO `logtrail_doing` (`logtrail_doing_id`, `login_id`, `admin_id`, `member_id`, `trainer_id`, `user_fname`, `user_lname`, `description`, `identity`, `time`) VALUES
(110, 3107, 87001, 1921681004, NULL, 'John', 'Doe', 'Added a member', 'member', '08:29 PM'),
(111, 3107, 87001, 1921681004, NULL, 'John', 'Doe', 'Activated the account', 'member', '08:31 PM'),
(112, 3107, 87001, 1921681004, NULL, 'John', 'Doe', 'Deactivated the Account', 'member', '08:31 PM'),
(113, 3109, 87001, 1921681004, NULL, 'John', 'Doe', 'Activated the account', 'member', '08:44 PM'),
(114, 3109, 87001, 1921681005, NULL, 'Klint', 'Cagot', 'Added a member', 'member', '10:10 PM');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `member_id` int(100) NOT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `gender` enum('M','F') DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(11) DEFAULT NULL,
  `member_status` enum('Not Paid','Paid','Expired') NOT NULL,
  `date_registered` date DEFAULT NULL,
  `date_deleted` date DEFAULT NULL,
  `monthly_start` date DEFAULT NULL,
  `monthly_end` date DEFAULT NULL,
  `annual_start` date DEFAULT NULL,
  `annual_end` date DEFAULT NULL,
  `member_type` enum('Regular','Walk-in') DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `acc_status` enum('active','inactive') NOT NULL,
  `admin_id` int(100) DEFAULT NULL,
  `program_name` varchar(100) DEFAULT NULL,
  `image_pathname` varchar(9999) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`member_id`, `first_name`, `last_name`, `username`, `password`, `gender`, `birthdate`, `email`, `phone`, `member_status`, `date_registered`, `date_deleted`, `monthly_start`, `monthly_end`, `annual_start`, `annual_end`, `member_type`, `address`, `acc_status`, `admin_id`, `program_name`, `image_pathname`) VALUES
(1921681004, 'John', 'Doe', 'johndoe', '$2y$10$kGYJcQ.Ac7X4uJOAYkm2CesgVGz9nqqKNIhTZbFf/pnAJOKDGKx/y', 'M', '1999-01-01', 'johndoe@gmail.com', '09151234567', 'Paid', '2021-02-04', NULL, NULL, NULL, '2021-02-05', '2022-02-05', 'Regular', '2nd floor G7 Suites', 'active', NULL, 'Light Weight', ''),
(1921681005, 'Klint', 'Cagot', NULL, NULL, 'M', '1998-01-01', 'klintcagot@gmail.com', '09121354655', 'Not Paid', '2021-02-05', NULL, NULL, NULL, NULL, NULL, 'Regular', 'Tipolo, Mandaue City', 'active', NULL, 'Light Weight', '');

-- --------------------------------------------------------

--
-- Table structure for table `memberpromos`
--

CREATE TABLE `memberpromos` (
  `id` int(100) NOT NULL,
  `promo_id` int(100) DEFAULT NULL,
  `member_id` int(100) DEFAULT NULL,
  `date_added` date DEFAULT NULL,
  `status` enum('Active','Expired') NOT NULL DEFAULT 'Active',
  `date_expired` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `memberpromos`
--

INSERT INTO `memberpromos` (`id`, `promo_id`, `member_id`, `date_added`, `status`, `date_expired`) VALUES
(4, 202111, 1921681004, '2021-02-05', 'Active', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `member_notifs`
--

CREATE TABLE `member_notifs` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `notif_id` int(11) NOT NULL,
  `status` enum('Unread','Read') NOT NULL,
  `date_sent` date NOT NULL,
  `date_read` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `notif_id` int(11) NOT NULL,
  `notif_message` varchar(9999) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`notif_id`, `notif_message`) VALUES
(1, 'Your subscription will end in 7 days. Please pay before the expiry date to continue your access to the gym.'),
(2, 'Your subscription will end in 3 days. Please pay before the expiry date to continue your access to the gym.'),
(3, 'Your subscription will end tomorrow. Please pay before the expiry date to continue your access to the gym.'),
(4, 'Your monthly subscription has already ended. Please pay within 7 days to continue your gym and member account access.'),
(5, 'Your annual membership has already ended. Please pay immediately to continue your membership in the gym.');

-- --------------------------------------------------------

--
-- Table structure for table `paymentlog`
--

CREATE TABLE `paymentlog` (
  `payment_id` int(100) NOT NULL,
  `member_id` int(100) DEFAULT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `member_type` enum('Regular','Walk-in') DEFAULT NULL,
  `payment_description` enum('Monthly Subscription','Annual Membership','Walk-in') DEFAULT NULL,
  `payment_type` enum('Cash','Online') NOT NULL,
  `date_payment` date DEFAULT NULL,
  `time_payment` varchar(15) NOT NULL,
  `payment_amount` varchar(4) DEFAULT NULL,
  `online_payment_id` varchar(9999) DEFAULT NULL,
  `admin_id` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `paymentlog`
--

INSERT INTO `paymentlog` (`payment_id`, `member_id`, `first_name`, `last_name`, `member_type`, `payment_description`, `payment_type`, `date_payment`, `time_payment`, `payment_amount`, `online_payment_id`, `admin_id`) VALUES
(3, 1921681004, 'John', 'Doe', NULL, 'Monthly Subscription', 'Online', '2021-02-05', '08:59 PM', '700', '42626284UB660163W', NULL),
(4, 1921681004, 'John', 'Doe', NULL, 'Annual Membership', 'Online', '2021-02-05', '08:59 PM', '200', '42626284UB660163W', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `program`
--

CREATE TABLE `program` (
  `program_id` int(100) NOT NULL,
  `admin_id`int(100) NOT NULL,  
  `program_name` varchar(100) DEFAULT NULL,
  `date_added` date DEFAULT NULL,
  `time_added` varchar(15) DEFAULT NULL,
  `date_deleted` date DEFAULT NULL,
  `program_description` varchar(500) DEFAULT NULL,
  `program_status` enum('active','remove') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `program_member` (
  `program_member_id` int(100) PRIMARY KEY NOT NULL,
  `program_id`int(100) NOT NULL,
  `member_id`int(100) NOT NULL,
  `admin_id`int(100) NOT NULL,
  `program_name` varchar(100) DEFAULT NULL,
  `member_fname` varchar(100) DEFAULT NULL,
  `member_lname` varchar(100) DEFAULT NULL,
  `date_added` date DEFAULT NULL,
  `time_added` varchar(15) DEFAULT NULL
);

-- --------------------------------------------------------

--
-- Table structure for table `promo`
--

CREATE TABLE `promo` (
  `promo_id` int(100) NOT NULL,
  `promo_name` varchar(255) DEFAULT NULL,
  `promo_type` enum('Permanent','Seasonal') DEFAULT NULL,
  `promo_description` varchar(255) DEFAULT NULL,
  `date_added` date DEFAULT NULL,
  `promo_starting_date` date DEFAULT NULL,
  `promo_ending_date` date DEFAULT NULL,
  `amount` int(100) DEFAULT NULL,
  `status` enum('Active','Expired','Deleted') NOT NULL DEFAULT 'Active',
  `date_deleted` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `promo`
--

INSERT INTO `promo` (`promo_id`, `promo_name`, `promo_type`, `promo_description`, `date_added`, `promo_starting_date`, `promo_ending_date`, `amount`, `status`, `date_deleted`) VALUES
(202100, 'Christmas Promo', 'Seasonal', 'Monthly subscription is P75 off for the whole month of December.', '2021-01-27', '2021-12-01', '2021-12-31', 75, 'Active', '2021-02-03'),
(202101, 'Student Discount', 'Permanent', 'Monthly subscription is P100 off for students. Please show valid school ID to the counter to avail.', '2021-01-27', NULL, NULL, 100, 'Active', NULL),
(202111, 'January-February Promo', 'Seasonal', 'P50 off for the whole month of January.', '2021-01-28', '2021-01-01', '2021-02-28', 50, 'Active', '2021-02-03'),
(202112, 'Senior Discount', 'Permanent', 'Monthly subscription is P100 off for ages 40 and above. Please present valid Senior Citizen ID to avail promo.', '2021-01-28', '1970-01-01', '1970-01-01', 100, 'Active', '2021-01-27');

-- --------------------------------------------------------

--
-- Table structure for table `trainer`
--

CREATE TABLE `trainer` (
  `trainer_id` int(100) NOT NULL,
  `trainer_status` enum('active','inactive') NOT NULL,
  `trainer_position` enum('junior','senior') NOT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `gender` enum('M','F') DEFAULT NULL,
  `phone` varchar(11) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `file` blob DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `date_hired` date DEFAULT NULL,
  `date_deleted` date DEFAULT NULL,
  `acc_status` enum('able','disable') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trainer`
--

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`inventory_id`);

--
-- Indexes for table `logtrail`
--
ALTER TABLE `logtrail`
  ADD PRIMARY KEY (`login_id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `logtrail_doing`
--
ALTER TABLE `logtrail_doing`
  ADD PRIMARY KEY (`logtrail_doing_id`),
  ADD KEY `logtrail_doing_ibfk_1` (`admin_id`),
  ADD KEY `logtrail_doing_ibfk_2` (`login_id`),
  ADD KEY `logtrail_doing_ibfk_3` (`member_id`),
  ADD KEY `logtrail_doing_ibfk_4` (`trainer_id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`member_id`);

--
-- Indexes for table `memberpromos`
--
ALTER TABLE `memberpromos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `memberpromos_ibfk_2` (`member_id`),
  ADD KEY `memberpromos_ibfk_1` (`promo_id`);

--
-- Indexes for table `member_notifs`
--
ALTER TABLE `member_notifs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `member_id` (`member_id`),
  ADD KEY `notif_id` (`notif_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notif_id`);

--
-- Indexes for table `paymentlog`
--
ALTER TABLE `paymentlog`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `member_id` (`member_id`);

--
-- Indexes for table `program`
--
ALTER TABLE `program`
  ADD PRIMARY KEY (`program_id`);

--
-- Indexes for table `promo`
--
ALTER TABLE `promo`
  ADD PRIMARY KEY (`promo_id`);

--
-- Indexes for table `trainer`
--
ALTER TABLE `trainer`
  ADD PRIMARY KEY (`trainer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87002;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `inventory_id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `logtrail`
--
ALTER TABLE `logtrail`
  MODIFY `login_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3110;

--
-- AUTO_INCREMENT for table `logtrail_doing`
--
ALTER TABLE `logtrail_doing`
  MODIFY `logtrail_doing_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `member_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1921681006;

--
-- AUTO_INCREMENT for table `memberpromos`
--
ALTER TABLE `memberpromos`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `member_notifs`
--
ALTER TABLE `member_notifs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notif_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `paymentlog`
--
ALTER TABLE `paymentlog`
  MODIFY `payment_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `program`
--
ALTER TABLE `program`
  MODIFY `program_id` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=092700;

ALTER TABLE `program_member`
  MODIFY `program_member_id` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19100;
--
-- AUTO_INCREMENT for table `promo`
--
ALTER TABLE `promo`
  MODIFY `promo_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=202113;

--
-- AUTO_INCREMENT for table `trainer`
--
ALTER TABLE `trainer`
  MODIFY `trainer_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1511;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `logtrail`
--
ALTER TABLE `logtrail`
  ADD CONSTRAINT `logtrail_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`);

--
-- Constraints for table `logtrail_doing`
--
ALTER TABLE `logtrail_doing`
  ADD CONSTRAINT `logtrail_doing_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`),
  ADD CONSTRAINT `logtrail_doing_ibfk_2` FOREIGN KEY (`program_id`) REFERENCES `program` (`program_id`),
  ADD CONSTRAINT `logtrail_doing_ibfk_3` FOREIGN KEY (`login_id`) REFERENCES `logtrail` (`login_id`),
  ADD CONSTRAINT `logtrail_doing_ibfk_4` FOREIGN KEY (`member_id`) REFERENCES `member` (`member_id`),
  ADD CONSTRAINT `logtrail_doing_ibfk_5` FOREIGN KEY (`trainer_id`) REFERENCES `trainer` (`trainer_id`);

--
-- Constraints for table `memberpromos`
--
ALTER TABLE `memberpromos`
  ADD CONSTRAINT `memberpromos_ibfk_1` FOREIGN KEY (`promo_id`) REFERENCES `promo` (`promo_id`),
  ADD CONSTRAINT `memberpromos_ibfk_2` FOREIGN KEY (`member_id`) REFERENCES `member` (`member_id`);

--
-- Constraints for table `member_notifs`
--
ALTER TABLE `member_notifs`
  ADD CONSTRAINT `fk_member_id` FOREIGN KEY (`member_id`) REFERENCES `member` (`member_id`),
  ADD CONSTRAINT `fk_notif_id` FOREIGN KEY (`notif_id`) REFERENCES `notifications` (`notif_id`);

--
-- Constraints for table `paymentlog`
--
ALTER TABLE `paymentlog`
  ADD CONSTRAINT `paymentlog_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `member` (`member_id`);

ALTER TABLE `program`
  ADD CONSTRAINT `program_ibfk_2` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`);

  
ALTER TABLE `program_member`
  ADD CONSTRAINT `program_member_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `member` (`member_id`),
  ADD CONSTRAINT `program_member_ibfk_2` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`),
  ADD CONSTRAINT `program_member_ibfk_3` FOREIGN KEY (`program_id`) REFERENCES `program` (`program_id`);

--
-- Constraints for table `reports`

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
