-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 18, 2021 at 04:18 PM
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `logtrail`
--

INSERT INTO `logtrail` (`login_id`, `admin_id`, `first_name`, `last_name`, `dateandtime_login`, `dateandtime_logout`) VALUES
(3113, 87001, 'Weinnand', 'Hasanion', '2021-02-09 19:25:22', NULL),
(3114, 87001, 'Weinnand', 'Hasanion', '2021-02-15 12:11:58', NULL),
(3115, 87001, 'Weinnand', 'Hasanion', '2021-02-16 13:20:51', NULL),
(3116, 87001, 'Weinnand', 'Hasanion', '2021-02-18 18:50:20', NULL);

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

--
-- Dumping data for table `logtrail_doing`
--

INSERT INTO `logtrail_doing` (`logtrail_doing_id`, `login_id`, `admin_id`, `member_id`, `program_id`, `trainer_id`, `user_fname`, `user_lname`, `description`, `identity`, `time`, `trainer_status`, `trainer_phone`, `trainer_position`, `trainer_address`) VALUES
(20201000, 3113, 87001, 1921681011, NULL, NULL, 'John', 'Doe', 'Added a member', 'member', '07:27 PM', NULL, NULL, NULL, NULL),
(20201001, 3114, 87001, 1921681011, NULL, NULL, 'John', 'Doe', 'Activated the account', 'member', '12:12 PM', NULL, NULL, NULL, NULL),
(20201002, 3114, 87001, 1921681011, NULL, NULL, 'John', 'Doe', 'Paid Both Annual Membership and Monthly Subscription', 'member', '12:13 PM', NULL, NULL, NULL, NULL),
(20201003, 3114, 87001, NULL, 2, NULL, 'Gaining', NULL, 'Added a new program', 'program', '12:14 PM', NULL, NULL, NULL, NULL),
(20201004, 3114, 87001, NULL, 2, NULL, 'Reducing', NULL, 'Updated the program name', 'program', '12:17 PM', NULL, NULL, NULL, NULL),
(20201005, 3115, 87001, 1921681012, NULL, NULL, 'George', 'Duterte', 'Added a regular member ', 'member', '07:26 PM', NULL, NULL, NULL, NULL),
(20201006, 3115, 87001, NULL, 2, NULL, 'Reducing', NULL, 'Deleted the program', 'program', '08:09 PM', NULL, NULL, NULL, NULL),
(20201007, 3115, 87001, NULL, 2, NULL, 'Reducing', NULL, 'Deleted the program', 'program', '08:09 PM', NULL, NULL, NULL, NULL),
(20201008, 3115, 87001, 1921681013, NULL, NULL, 'Christian James', 'Gulapa', 'Added a regular member ', 'member', '01:20 AM', NULL, NULL, NULL, NULL),
(20201009, 3115, 87001, 1921681013, NULL, NULL, 'Christian James', 'Gulapa', 'Deleted an account from regular table', 'member', '01:24 AM', NULL, NULL, NULL, NULL),
(20201010, 3115, 87001, 1921681013, NULL, NULL, 'Christian James', 'Gulapa', 'Recover an account to Regular table', 'member', '02:23 AM', NULL, NULL, NULL, NULL),
(20201011, 3115, 87001, 1921681014, NULL, NULL, 'John Jay', 'Desierto', 'Added a regular member ', 'member', '02:24 AM', NULL, NULL, NULL, NULL),
(20201012, 3115, 87001, 1921681015, NULL, NULL, 'Kim', 'Jorolan', 'Added a regular member ', 'member', '02:24 AM', NULL, NULL, NULL, NULL),
(20201013, 3115, 87001, 1921681016, NULL, NULL, 'Michael', 'Antiporta', 'Added a regular member ', 'member', '02:25 AM', NULL, NULL, NULL, NULL),
(20201014, 3115, 87001, 1921681017, NULL, NULL, 'Thomas Rey', 'Barcenas', 'Added a regular member ', 'member', '02:25 AM', NULL, NULL, NULL, NULL),
(20201015, 3115, 87001, 1921681018, NULL, NULL, 'Justine', 'Garcia', 'Added a regular member ', 'member', '02:28 AM', NULL, NULL, NULL, NULL),
(20201016, 3115, 87001, 1921681019, NULL, NULL, 'Romhel', 'Ceniza', 'Added a regular member ', 'member', '02:29 AM', NULL, NULL, NULL, NULL),
(20201017, 3115, 87001, 1921681020, NULL, NULL, 'Jade', 'Tibon', 'Added a regular member ', 'member', '02:30 AM', NULL, NULL, NULL, NULL),
(20201018, 3115, 87001, 1921681021, NULL, NULL, 'Francis', 'Vasquez', 'Added a regular member ', 'member', '02:30 AM', NULL, NULL, NULL, NULL),
(20201019, 3115, 87001, 1921681022, NULL, NULL, 'Weinnand', 'Hasanion', 'Added a regular member ', 'member', '02:36 AM', NULL, NULL, NULL, NULL),
(20201020, 3115, 87001, 1921681023, NULL, NULL, 'Ivanne', 'Candano', 'Added a regular member ', 'member', '02:37 AM', NULL, NULL, NULL, NULL),
(20201021, 3116, 87001, 1921681024, NULL, NULL, 'Clint', 'Lapera', 'Added a regular member ', 'member', '06:51 PM', NULL, NULL, NULL, NULL),
(20201022, 3116, 87001, 1921681024, NULL, NULL, 'Clint', 'Lapera', 'Activated the account', 'member', '07:31 PM', NULL, NULL, NULL, NULL),
(20201023, 3116, 87001, 1921681024, NULL, NULL, 'Clint', 'Lapera', 'Paid Monthly Subscription', 'member', '09:06 PM', NULL, NULL, NULL, NULL),
(20201024, 3116, 87001, 1921681024, NULL, NULL, 'Clint', 'Lapera', 'Paid Annual Membership', 'member', '09:07 PM', NULL, NULL, NULL, NULL),
(20201025, 3116, 87001, 1921681024, NULL, NULL, 'Clint', 'Lapera', 'Paid Monthly Subscription', 'member', '09:07 PM', NULL, NULL, NULL, NULL),
(20201026, 3116, 87001, 1921681024, NULL, NULL, 'Clint', 'Lapera', 'Paid Monthly Subscription', 'member', '09:10 PM', NULL, NULL, NULL, NULL),
(20201027, 3116, 87001, 1921681024, NULL, NULL, 'Clint', 'Lapera', 'Paid Annual Membership', 'member', '09:11 PM', NULL, NULL, NULL, NULL),
(20201028, 3116, 87001, 1921681024, NULL, NULL, 'Clint', 'Lapera', 'Paid Monthly Subscription', 'member', '09:11 PM', NULL, NULL, NULL, NULL),
(20201029, 3116, 87001, 1921681024, NULL, NULL, 'Clint', 'Lapera', 'Paid Monthly Subscription', 'member', '09:44 PM', NULL, NULL, NULL, NULL),
(20201030, 3116, 87001, 1921681024, NULL, NULL, 'Clint', 'Lapera', 'Paid Annual Membership', 'member', '09:44 PM', NULL, NULL, NULL, NULL);

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
  `date_activated` date DEFAULT NULL,
  `monthly_start` date DEFAULT NULL,
  `monthly_end` date DEFAULT NULL,
  `annual_start` date DEFAULT NULL,
  `annual_end` date DEFAULT NULL,
  `member_type` enum('Regular','Walk-in') DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `acc_status` enum('active','inactive') NOT NULL,
  `program_id` int(11) NOT NULL,
  `image_pathname` varchar(9999) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`member_id`, `first_name`, `last_name`, `username`, `password`, `gender`, `birthdate`, `email`, `phone`, `member_status`, `date_registered`, `date_deleted`, `date_activated`, `monthly_start`, `monthly_end`, `annual_start`, `annual_end`, `member_type`, `address`, `acc_status`, `program_id`, `image_pathname`) VALUES
(1921681011, 'John', 'Doe', 'johndoe', '$2y$10$ng6vDgB2bZnNAZf4ojemaej77TYkwySfHKKQlbtGxIaz2btNWuZli', 'M', '1985-01-01', 'johndoe@gmail.com', '09431245555', 'Paid', '2021-02-09', NULL, '2021-02-10', '2021-02-15', '2021-03-17', '2021-02-16', '2022-02-16', 'Regular', '2nd floor G7 Suites', 'active', 1, '48380811_2483901434958508_4031859068325855232_n.jpg'),
(1921681012, 'George', 'Duterte', NULL, NULL, 'M', '1998-01-01', 'georgebush@hotmail.com', '09233215471', 'Paid', '2021-02-16', NULL, NULL, NULL, NULL, '2021-02-16', '2022-02-16', 'Regular', '2nd floor G7 Suites', 'active', 2, ''),
(1921681013, 'Christian James', 'Gulapa', NULL, NULL, 'M', '1978-01-01', 'cjbayot@gmail.com', '09166666666', 'Not Paid', '2021-02-17', '2021-02-17', NULL, NULL, NULL, NULL, NULL, 'Regular', 'Talamban, Cebu', 'active', 1, ''),
(1921681014, 'John Jay', 'Desierto', NULL, NULL, 'M', '1998-05-12', 'johnjay@gmail.com', '09124562133', 'Not Paid', '2021-02-17', NULL, NULL, NULL, NULL, NULL, NULL, 'Regular', 'Talamban, Cebu', 'active', 1, ''),
(1921681015, 'Kim', 'Jorolan', NULL, NULL, 'M', '1987-09-15', 'kimjorolan@gmail.com', '09234567891', 'Not Paid', '2021-02-17', NULL, NULL, NULL, NULL, NULL, NULL, 'Regular', 'Talamban, Cebu', 'active', 2, ''),
(1921681016, 'Michael', 'Antiporta', NULL, NULL, 'M', '1996-02-15', 'kaelantiporta@gmail.com', '09201235400', 'Not Paid', '2021-02-17', NULL, NULL, NULL, NULL, NULL, NULL, 'Regular', 'Badian, Cebu, Philippines', 'active', 1, ''),
(1921681017, 'Thomas Rey', 'Barcenas', NULL, NULL, 'M', '1993-09-04', 'thomdatrain@gmail.com', '09475466911', 'Not Paid', '2021-02-17', NULL, NULL, NULL, NULL, NULL, NULL, 'Regular', 'Toledo City, Cebu', 'active', 2, ''),
(1921681018, 'Justine', 'Garcia', NULL, NULL, 'M', '1998-11-15', 'justinegarcia@gmail.com', '09135644887', 'Not Paid', '2021-02-17', NULL, NULL, NULL, NULL, NULL, NULL, 'Regular', 'Subangdaku, Mandaue', 'active', 1, ''),
(1921681019, 'Romhel', 'Ceniza', NULL, NULL, 'M', '1998-01-21', 'aldiceniza@gmail.com', '09234561121', 'Not Paid', '2021-02-17', NULL, NULL, NULL, NULL, NULL, NULL, 'Regular', 'Pit-os, Talamban, Cebu City', 'active', 1, ''),
(1921681020, 'Jade', 'Tibon', NULL, NULL, 'M', '1999-12-15', 'jadetibones@gmail.com', '09334651320', 'Not Paid', '2021-02-17', NULL, NULL, NULL, NULL, NULL, NULL, 'Regular', 'Jagobiao, Mandaue City', 'active', 1, ''),
(1921681021, 'Francis', 'Vasquez', NULL, NULL, 'M', '1997-02-14', 'bogoorven@gmail.com', '09164562230', 'Not Paid', '2021-02-17', NULL, NULL, NULL, NULL, NULL, NULL, 'Regular', 'Bacolod City', 'active', 2, ''),
(1921681022, 'Weinnand', 'Hasanion', NULL, NULL, 'M', '1999-08-04', 'weinnandhasanion@gmail.com', '09206013530', 'Paid', '2021-02-17', NULL, NULL, '2021-02-18', '2021-03-20', '2021-02-18', '2022-02-18', 'Regular', 'Lapulapu City, Cebu', 'active', 1, ''),
(1921681023, 'Ivanne', 'Candano', NULL, NULL, 'M', '1998-03-16', 'vancandano@gmail.com', '09455641010', 'Paid', '2021-02-17', NULL, NULL, '2021-02-18', '2021-03-20', '2021-02-18', '2022-02-18', 'Regular', 'Pagadian, Philippines', 'active', 1, ''),
(1921681024, 'Clint', 'Lapera', '1921681024', '$2y$10$96uGA7tAS5TSAchRuLlPcu6kFQpBB9oUvkXfVmbvItAYY2E4uBgTK', 'M', '2000-02-10', 'clintlapera@gmail.com', '09165433165', 'Paid', '2021-02-18', NULL, '2021-02-18', '2021-02-18', '2021-03-20', '2021-02-18', '2022-02-18', 'Regular', 'Masulog, Lapu-Lapu City', 'active', 1, '');

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
(2, 202112, 1921681011, '2021-02-16', 'Active', NULL),
(3, 202111, 1921681011, '2021-02-16', 'Active', NULL),
(4, 202111, 1921681022, '2021-02-18', 'Active', NULL);

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
  `promo_availed` varchar(100) DEFAULT NULL,
  `online_payment_id` varchar(9999) DEFAULT NULL,
  `admin_id` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `paymentlog`
--

INSERT INTO `paymentlog` (`payment_id`, `member_id`, `first_name`, `last_name`, `member_type`, `payment_description`, `payment_type`, `date_payment`, `time_payment`, `payment_amount`, `promo_availed`, `online_payment_id`, `admin_id`) VALUES
(9, 1921681011, 'John', 'Doe', 'Regular', 'Monthly Subscription', 'Cash', '2021-02-16', '07:25 PM', '700', 'January-February Promo', NULL, NULL),
(10, 1921681011, 'John', 'Doe', 'Regular', 'Annual Membership', 'Cash', '2021-02-16', '07:25 PM', '200', NULL, NULL, NULL),
(11, 1921681012, 'George', 'Duterte', 'Regular', 'Monthly Subscription', 'Cash', '2021-02-16', '07:26 PM', '750', 'N/A', NULL, NULL),
(12, 1921681012, 'George', 'Duterte', 'Regular', 'Annual Membership', 'Cash', '2021-02-16', '07:26 PM', '200', NULL, NULL, NULL),
(38, 1921681024, 'Clint', 'Lapera', 'Regular', 'Monthly Subscription', 'Cash', '2021-02-18', '09:46 PM', '750', 'N/A', NULL, NULL),
(39, 1921681024, 'Clint', 'Lapera', 'Regular', 'Annual Membership', 'Cash', '2021-02-18', '09:46 PM', '200', NULL, NULL, NULL),
(40, 1921681022, 'Weinnand', 'Hasanion', 'Regular', 'Monthly Subscription', 'Cash', '2021-02-18', '09:52 PM', '700', 'January-February Promo', NULL, NULL),
(41, 1921681022, 'Weinnand', 'Hasanion', 'Regular', 'Annual Membership', 'Cash', '2021-02-18', '09:52 PM', '200', NULL, NULL, NULL),
(42, 1921681023, 'Ivanne', 'Candano', 'Regular', 'Monthly Subscription', 'Cash', '2021-02-18', '10:36 PM', '750', 'N/A', NULL, NULL),
(43, 1921681023, 'Ivanne', 'Candano', 'Regular', 'Annual Membership', 'Cash', '2021-02-18', '10:36 PM', '200', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `program`
--

CREATE TABLE `program` (
  `program_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `program_name` varchar(50) NOT NULL,
  `program_description` text NOT NULL,
  `program_status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `date_added` date DEFAULT NULL,
  `time_added` time NOT NULL,
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

INSERT INTO `program` (`program_id`, `admin_id`, `program_name`, `program_description`, `program_status`, `date_added`, `time_added`, `upper_1_day_1`, `upper_2_day_1`, `upper_3_day_1`, `upper_1_day_2`, `upper_2_day_2`, `upper_3_day_2`, `upper_1_day_3`, `upper_2_day_3`, `upper_3_day_3`, `lower_1_day_1`, `lower_2_day_1`, `lower_3_day_1`, `lower_1_day_2`, `lower_2_day_2`, `lower_3_day_2`, `lower_1_day_3`, `lower_2_day_3`, `lower_3_day_3`, `abdominal_day_1`, `abdominal_day_2`, `abdominal_day_3`) VALUES
(1, 87001, 'Gaining', 'This is a program for members who aim to gain weight and mass.', 'active', '2021-02-09', '19:30:00', 1, 2, 3, 4, 5, 6, 7, 8, 2, 9, 10, 11, 12, 13, 14, 15, 17, 11, 16, 19, 20),
(2, 87001, 'Reducing', 'This program is for people who want to reduce body weight and mass.', 'active', '2021-02-15', '12:14:00', 1, 2, 3, 4, 5, 6, 7, 8, 1, 9, 10, 11, 12, 13, 14, 15, 9, 10, 16, 18, 18);

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
  `routine_name` varchar(100) NOT NULL,
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
(8, 'Seated overhead triceps extension', 'https://www.youtube.com/watch?v=YbX7Wd8jQ-Q', 'Upper Body', 15, 3),
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  MODIFY `login_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3117;

--
-- AUTO_INCREMENT for table `logtrail_doing`
--
ALTER TABLE `logtrail_doing`
  MODIFY `logtrail_doing_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20201031;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `member_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1921681025;

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
  MODIFY `payment_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `program`
--
ALTER TABLE `program`
  MODIFY `program_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
-- Constraints for table `member`
--
ALTER TABLE `member`
  ADD CONSTRAINT `member_ibfk_1` FOREIGN KEY (`program_id`) REFERENCES `program` (`program_id`);

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
