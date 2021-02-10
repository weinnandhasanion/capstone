-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 09, 2021 at 12:18 PM
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

-- --------------------------------------------------------

--
-- Table structure for table `logtrail_doing`
--

CREATE TABLE `logtrail_doing` (
  `logtrail_doing_id` int(100) NOT NULL,
  `login_id` int(100) NOT NULL,
  `admin_id` int(100) DEFAULT NULL,
  `member_id` int(100) DEFAULT NULL,
  `program_id` int(11) DEFAULT NULL,
  `trainer_id` int(100) DEFAULT NULL,
  `user_fname` varchar(100) DEFAULT NULL,
  `user_lname` varchar(100) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `identity` varchar(200) DEFAULT NULL,
  `time` varchar(15) DEFAULT NULL,
  `trainer_status` enum('active','inactive') DEFAULT NULL,
  `trainer_phone` varchar(100) DEFAULT NULL,
  `trainer_position` enum('junior','senior') DEFAULT NULL,
  `trainer_address` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `program_id` int(11) NOT NULL,
  `image_pathname` varchar(9999) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


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

-- --------------------------------------------------------

--
-- Table structure for table `program`
--

CREATE TABLE `program` (
  `program_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `program_name` varchar(50) NOT NULL,
  `program_description` text NOT NULL,
  `date_added` date DEFAULT NULL,
  `time_added` varchar(10) NOT NULL,
  `program_status` ENUM('active','remove') NOT NULL,
  `date_deleted` DATE,
  `time_deleted` varchar(10),
  `upper_1_day_1` int(11) DEFAULT NULL,
  `upper_2_day_1` int(11) DEFAULT NULL,
  `upper_3_day_1` int(11) DEFAULT NULL,
  `upper_1_day_2` int(11) DEFAULT NULL,
  `upper_2_day_2` int(11) DEFAULT NULL,
  `upper_3_day_2` int(11) DEFAULT NULL,
  `upper_1_day_3` int(11) DEFAULT NULL,
  `upper_2_day_3` int(11) DEFAULT NULL,
  `upper_3_day_3` int(11) DEFAULT NULL,
  `lower_1_day_1` int(11) DEFAULT NULL,
  `lower_2_day_1` int(11) DEFAULT NULL,
  `lower_3_day_1` int(11) DEFAULT NULL,
  `lower_1_day_2` int(11) DEFAULT NULL,
  `lower_2_day_2` int(11) DEFAULT NULL,
  `lower_3_day_2` int(11) DEFAULT NULL,
  `lower_1_day_3` int(11) DEFAULT NULL,
  `lower_2_day_3` int(11) DEFAULT NULL,
  `lower_3_day_3` int(11) DEFAULT NULL,
  `abdominal_day_1` int(11) DEFAULT NULL,
  `abdominal_day_2` int(11) DEFAULT NULL,
  `abdominal_day_3` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `program`
--

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
-- Table structure for table `routines`
--

CREATE TABLE `routines` (
  `routine_id` int(11) NOT NULL,
  `routine_name` varchar(30) NOT NULL,
  `routine_link` varchar(9999) DEFAULT NULL,
  `routine_type` enum('Upper Body','Lower Body','Abdominal') DEFAULT NULL,
  `routine_reps` int(11) DEFAULT NULL,
  `routine_sets` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `routines`
--

INSERT INTO `routines` (`routine_id`, `routine_name`, `routine_link`, `routine_type`, `routine_reps`, `routine_sets`) VALUES
(1, 'Bent-over row', 'https://www.youtube.com/watch?v=vT2GjY_Umpw', 'Upper Body', 15, 3),
(2, 'Arnold press', 'https://www.youtube.com/watch?v=3ml7BH7mNwQ', 'Upper Body', 15, 3),
(3, 'Dumbbell bench press', 'https://www.youtube.com/watch?v=VmB1G1K7v94', 'Upper Body', 15, 3),
(4, 'Pullover', 'https://www.youtube.com/watch?v=tpLnfSQJ0gg', 'Upper Body', 15, 3),
(5, 'Dumbell rear-delt fly', 'https://www.youtube.com/watch?v=ttvfGg9d76c', 'Upper Body', 15, 3),
(6, 'Standing biceps curl', 'https://www.youtube.com/watch?v=sAq_ocpRh_I', 'Upper Body', 30, 3),
(7, 'Skull crusher press', 'https://www.youtube.com/watch?v=d_KZxkY_0cM', 'Upper Body', 15, 3),
(8, 'Seated overhead triceps extens', 'https://www.youtube.com/watch?v=YbX7Wd8jQ-Q', 'Upper Body', 15, 3),
(9, 'Front Squat', 'https://www.youtube.com/watch?v=tlfahNdNPPI', 'Lower Body', 20, 3),
(10, 'Deadlift', 'https://www.youtube.com/watch?v=op9kVnSso6Q', 'Lower Body', 15, 3),
(11, 'Bulgarian split squat', 'https://www.youtube.com/watch?v=2C-uNgKwPLE', 'Lower Body', 15, 3),
(12, 'Lateral lunge', 'https://www.youtube.com/watch?v=LlTUY7PA_BI', 'Lower Body', 20, 3),
(13, 'Dumbbell Stepup', 'https://www.youtube.com/watch?v=9ZknEYboBOQ', 'Lower Body', 15, 3),
(14, 'Leg Press', 'https://www.youtube.com/watch?v=IZxyjW7MPJQ', 'Lower Body', 10, 3),
(15, 'Overhead Lunge', 'https://www.youtube.com/watch?v=m6MczOv_Ayg', 'Lower Body', 10, 3),
(16, 'Plank', 'https://www.youtube.com/watch?v=pSHjTRCQxIw', 'Abdominal', 60, 1),
(17, 'Mountain climber', 'https://www.youtube.com/watch?v=De3Gl-nC7IQ', 'Abdominal', 60, 1),
(18, 'Reverse crunch', 'https://www.youtube.com/watch?v=7rRWy7-Gokg', 'Abdominal', 60, 1),
(19, 'Dead bug', 'https://www.youtube.com/watch?v=MCVX9wRd_h0', 'Abdominal', 20, 3),
(20, 'Leg raise', 'https://www.youtube.com/watch?v=l4kQd9eWclE', 'Abdominal', 20, 3),
(21, 'Abs roll-out', 'https://www.youtube.com/watch?v=5Tc7yKQysVQ', 'Abdominal', 20, 3),
(22, 'Bird-dog', 'https://www.youtube.com/watch?v=wiFNA3sqjCA', 'Abdominal', 20, 3),
(23, 'Hanging knee raise', 'https://www.youtube.com/watch?v=p9hhX_Sx5v0', 'Abdominal', 20, 3);

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
  ADD KEY `logtrail_doing_1` (`admin_id`),
  ADD KEY `logtrail_doing_2` (`login_id`),
  ADD KEY `logtrail_doing_3` (`member_id`),
  ADD KEY `logtrail_doing_4` (`trainer_id`),
  ADD KEY `logtrail_doing_ibfk_5` (`program_id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`member_id`),
  ADD KEY `program_id` (`program_id`);

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
  ADD PRIMARY KEY (`program_id`),
  ADD KEY `upper_body` (`upper_1_day_1`,`upper_2_day_1`,`upper_3_day_1`,`upper_1_day_2`,`upper_2_day_2`,`upper_3_day_2`,`upper_1_day_3`,`upper_2_day_3`,`upper_3_day_3`) USING BTREE,
  ADD KEY `lower_body` (`lower_1_day_1`,`lower_2_day_1`,`lower_3_day_1`,`lower_1_day_2`,`lower_2_day_2`,`lower_3_day_2`,`lower_1_day_3`,`lower_2_day_3`,`lower_3_day_3`) USING BTREE,
  ADD KEY `abdominals` (`abdominal_day_1`,`abdominal_day_2`,`abdominal_day_3`) USING BTREE,
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `promo`
--
ALTER TABLE `promo`
  ADD PRIMARY KEY (`promo_id`);

--
-- Indexes for table `routines`
--
ALTER TABLE `routines`
  ADD PRIMARY KEY (`routine_id`);

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
  MODIFY `inventory_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2000;

--
-- AUTO_INCREMENT for table `logtrail`
--
ALTER TABLE `logtrail`
  MODIFY `login_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3113;

--
-- AUTO_INCREMENT for table `logtrail_doing`
--
ALTER TABLE `logtrail_doing`
  MODIFY `logtrail_doing_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20201000;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `member_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1921681011;

--
-- AUTO_INCREMENT for table `memberpromos`
--
ALTER TABLE `memberpromos`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

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
  MODIFY `payment_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `program`
--
ALTER TABLE `program`
  MODIFY `program_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `promo`
--
ALTER TABLE `promo`
  MODIFY `promo_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=202113;

--
-- AUTO_INCREMENT for table `routines`
--
ALTER TABLE `routines`
  MODIFY `routine_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `trainer`
--
ALTER TABLE `trainer`
  MODIFY `trainer_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1512;

--
-- Constraints for dumped tables
--

ALTER TABLE `member`
  ADD CONSTRAINT `member_ibfk_1` FOREIGN KEY (`program_id`) REFERENCES `program` (`program_id`);

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
  ADD CONSTRAINT `logtrail_doing_ibfk_2` FOREIGN KEY (`login_id`) REFERENCES `logtrail` (`login_id`),
  ADD CONSTRAINT `logtrail_doing_ibfk_3` FOREIGN KEY (`member_id`) REFERENCES `member` (`member_id`),
  ADD CONSTRAINT `logtrail_doing_ibfk_4` FOREIGN KEY (`trainer_id`) REFERENCES `trainer` (`trainer_id`),
  ADD CONSTRAINT `logtrail_doing_ibfk_5` FOREIGN KEY (`program_id`) REFERENCES `program` (`program_id`);

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

--
-- Constraints for table `program`
--
ALTER TABLE `program`
  ADD CONSTRAINT `program_admin_fk` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
