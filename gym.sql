-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 29, 2021 at 10:55 AM
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
(87001, 'weinnandhasanion@gmail.com', '$2y$10$gNnkz9JJ5nNYFRuMuPpFkuBha9A6KpXKZxcSES56MnJufxQDB/hLa', 'Weinnand', 'Hasanion'),
(87002, 'babayaga@gmail.com', '$2y$10$aQT4kRsC5ZDz/ANKh4FsWOegfDzwcjWpz5la2dDxADVYObg8cYSga', 'baba', 'yaga');

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
  `inventory_status` enum('notdeleted','deleted') NOT NULL,
  `date_deleted` date DEFAULT NULL,
  `time_deleted` time DEFAULT NULL,
  `date_added` date DEFAULT NULL,
  `image_pathname` varchar(9999) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`inventory_id`, `inventory_name`, `inventory_category`, `inventory_qty`, `inventory_damage`, `inventory_working`, `inventory_description`, `inventory_status`, `date_deleted`, `time_deleted`, `date_added`, `image_pathname`) VALUES
(2010, '5 lbs dumbbell', 'Weight Equipment', 10, 2, NULL, '5 pound dumbbells.', 'notdeleted', NULL, NULL, '2021-03-20', '5lbdumbell.jpg'),
(2012, 'Treadmill', 'Cardio Equipment', 3, 1, NULL, 'Nordic TrackSeries T', 'notdeleted', NULL, NULL, '2021-03-06', '710XQC8XqpL._AC_SL1500_.jpg'),
(2013, 'charot', 'Cardio Equipment', 5, 1, NULL, 'hi cagot', 'deleted', '2021-03-18', '01:03:46', '2021-03-06', 'localhost_capstoneMobile_pages_pay.php(iPhone X).png'),
(2014, 'Rowing machine', 'Cardio Equipment', 3, 0, NULL, 'Concept2 Model D Indoor Rowing Machine with PM5', 'notdeleted', NULL, NULL, '2021-03-20', 'rowing machine.jpg'),
(2015, 'Exercise stationary bike', 'Cardio Equipment', 4, 0, NULL, 'Exercise stationary bikes good for cardio exercise.', 'notdeleted', NULL, NULL, '2021-03-20', 'exercise bike.png'),
(2016, '10 lbs dumbbell', 'Weight Equipment', 10, 0, NULL, '10 pound dumbbells.', 'notdeleted', NULL, NULL, '2021-03-20', '10dumbbell.png'),
(2017, '15 lbs weight disc', 'Weight Equipment', 8, NULL, NULL, '15 pound weight discs for adjustable barbells.', 'notdeleted', NULL, NULL, '2021-03-20', '15 plate.jpg'),
(2018, '15 lbs dumbbell', 'Weight Equipment', 12, NULL, NULL, '15 pound dumbbells.', 'notdeleted', NULL, NULL, '2021-03-20', '15dumbbell.jpg'),
(2019, '20 lbs dumbbell', 'Weight Equipment', 8, NULL, NULL, '20 pound dumbbells.', 'notdeleted', NULL, NULL, '2021-03-20', '20dumbbell.jpg'),
(2020, '25 lbs dumbbell', 'Weight Equipment', 12, NULL, NULL, '25 pound dumbbells.', 'notdeleted', NULL, NULL, '2021-03-20', '25dumbbell.jpg'),
(2021, 'Barbell bar', 'Weight Equipment', 6, NULL, NULL, 'Adjustable barbell bars.', 'notdeleted', NULL, NULL, '2021-03-20', 'barbell bar.jpg'),
(2022, '5 lbs weight disc', 'Weight Equipment', 6, NULL, NULL, '5 pound weight discs for adjustable barbells.', 'notdeleted', NULL, NULL, '2021-03-20', '5 plate.jpg'),
(2023, '10 lbs weight disc', 'Weight Equipment', 10, NULL, NULL, '10 pound weight discs for adjustable barbells.', 'notdeleted', NULL, NULL, '2021-03-20', '10plate.jpg');

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
(1, 87001, 'Weinnand', 'Hasanion', '2021-03-18 00:10:20', '2021-03-18 00:10:57'),
(2, 87001, 'Weinnand', 'Hasanion', '2021-03-18 04:30:51', '2021-03-18 04:31:25'),
(3, 87001, 'Weinnand', 'Hasanion', '2021-03-18 04:31:32', '2021-03-18 05:23:32'),
(4, 87001, 'Weinnand', 'Hasanion', '2021-03-18 11:44:15', '2021-03-18 18:28:44'),
(5, 87002, 'baba', 'yaga', '2021-03-18 18:28:54', '2021-03-18 18:57:09'),
(6, 87001, 'Weinnand', 'Hasanion', '2021-03-18 18:57:57', '2021-03-18 19:00:04'),
(7, 87002, 'baba', 'yaga', '2021-03-18 20:57:32', '2021-03-18 22:30:30'),
(8, 87002, 'baba', 'yaga', '2021-03-19 02:10:53', '2021-03-19 03:28:53'),
(9, 87002, 'baba', 'yaga', '2021-03-19 18:21:50', '2021-03-19 20:11:50'),
(10, 87001, 'Weinnand', 'Hasanion', '2021-03-20 11:14:38', '2021-03-20 01:02:38'),
(11, 87001, 'Weinnand', 'Hasanion', '2021-03-21 19:21:41', '2021-03-21 21:53:41'),
(12, 87001, 'Weinnand', 'Hasanion', '2021-03-22 10:25:08', '2021-03-22 12:04:08'),
(13, 87001, 'Weinnand', 'Hasanion', '2021-03-25 12:18:12', '2021-03-25 02:47:12'),
(14, 87001, 'Weinnand', 'Hasanion', '2021-03-29 10:20:06', '2021-03-29 12:10:06'),
(15, 87001, 'Weinnand', 'Hasanion', '2021-03-29 16:45:18', '2021-03-29 18:15:18');

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
  `inventory_id` int(100) DEFAULT NULL,
  `promo_id` int(100) DEFAULT NULL,
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

INSERT INTO `logtrail_doing` (`logtrail_doing_id`, `login_id`, `admin_id`, `member_id`, `program_id`, `trainer_id`, `inventory_id`, `promo_id`, `user_fname`, `user_lname`, `description`, `identity`, `time`, `trainer_status`, `trainer_phone`, `trainer_position`, `trainer_address`) VALUES
(1, 1, 87001, 1921681032, NULL, NULL, NULL, NULL, 'Rigel', 'Wilson', 'Deleted an account from walk-in table', 'Members', '12:11 AM', NULL, NULL, NULL, NULL),
(2, 1, 87001, 1921681025, NULL, NULL, NULL, NULL, 'Dante', 'Phillips', 'Recover an account to Walk-in table', 'Members', '12:15 AM', NULL, NULL, NULL, NULL),
(3, 1, 87001, NULL, NULL, NULL, NULL, 202112, 'Gil Eaton', NULL, 'Added a member to promo', 'Promos', '12:33 AM', NULL, NULL, NULL, NULL),
(4, 1, 87001, NULL, NULL, NULL, NULL, 202101, 'Phelan Blackwell', NULL, 'Added a member to ', 'Promos', '12:41 AM', NULL, NULL, NULL, NULL),
(5, 1, 87001, NULL, NULL, NULL, NULL, 202101, 'Graiden Knight', NULL, 'Added a member to Student Discount', 'Promos', '12:42 AM', NULL, NULL, NULL, NULL),
(6, 1, 87001, 1921681088, NULL, NULL, NULL, NULL, 'Burke', 'Good', 'Recover an account to Walk-in table', 'Members', '12:44 AM', NULL, NULL, NULL, NULL),
(7, 1, 87001, 1921681092, NULL, NULL, NULL, NULL, 'Hammett', 'Vaughn', 'Paid Annual Membership', 'member', '12:45 AM', NULL, NULL, NULL, NULL),
(8, 1, 87001, 1921681054, NULL, NULL, NULL, NULL, 'Jeremy', 'Frye', 'Paid Walk-in', 'Members', '12:46 AM', NULL, NULL, NULL, NULL),
(9, 1, 87001, 1921681013, NULL, NULL, NULL, NULL, 'Christian James', 'Gulapa', 'Paid Monthly Subscription', 'Members', '12:46 AM', NULL, NULL, NULL, NULL),
(10, 1, 87001, 1921681043, NULL, NULL, NULL, NULL, 'Clarke', 'Jacobson', 'Deleted an account from regular table', 'Members', '12:50 AM', NULL, NULL, NULL, NULL),
(11, 1, 87001, 1921681091, NULL, NULL, NULL, NULL, 'Josiah', 'Luna', 'Deleted an account from regular table', 'Members', '12:50 AM', NULL, NULL, NULL, NULL),
(12, 1, 87001, 1921681013, NULL, NULL, NULL, NULL, 'Christian James', 'Gulapa', 'Updated a member', 'Members', '12:56 AM', NULL, NULL, NULL, NULL),
(13, 1, 87001, 1921681013, NULL, NULL, NULL, NULL, 'Christian James', 'Gulapa', 'Updated a member', 'Members', '12:56 AM', NULL, NULL, NULL, NULL),
(14, 1, 87001, 1921681013, NULL, NULL, NULL, NULL, 'Christian James', 'Gulapa', 'Updated a member', 'Members', '12:56 AM', NULL, NULL, NULL, NULL),
(15, 1, 87001, 1921681013, NULL, NULL, NULL, NULL, 'Christian James', 'Gulapa', 'Updated a member', 'Members', '12:57 AM', NULL, NULL, NULL, NULL),
(16, 1, 87001, 1921681013, NULL, NULL, NULL, NULL, 'Christian James', 'Gulapa', 'Updated a member', 'Members', '12:58 AM', NULL, NULL, NULL, NULL),
(17, 1, 87001, 1921681013, NULL, NULL, NULL, NULL, 'Christian James', 'Gulapa', 'Updated a member', 'Members', '12:58 AM', NULL, NULL, NULL, NULL),
(18, 1, 87001, 1921681015, NULL, NULL, NULL, NULL, 'Kim', 'Jorolan', 'Updated a member', 'Members', '12:58 AM', NULL, NULL, NULL, NULL),
(19, 1, 87001, 1921681016, NULL, NULL, NULL, NULL, 'Michael', 'Antiporta', 'Updated a member', 'Members', '12:59 AM', NULL, NULL, NULL, NULL),
(20, 1, 87001, NULL, 1, NULL, NULL, NULL, 'Gaining', NULL, 'Recover the program', 'Programs', '01:00 AM', NULL, NULL, NULL, NULL),
(21, 1, 87001, NULL, 3, NULL, NULL, NULL, 'asfsafsaf', NULL, 'Added a new program', 'Programs', '01:00 AM', NULL, NULL, NULL, NULL),
(22, 1, 87001, NULL, NULL, NULL, 2013, NULL, 'charot', NULL, 'Deleted an inventory', 'Inventory', '01:03 AM', NULL, NULL, NULL, NULL),
(23, 1, 87001, NULL, NULL, NULL, 2013, NULL, 'charot', NULL, 'Recover an inventory', 'Inventory', '01:03 AM', NULL, NULL, NULL, NULL),
(24, 1, 87001, NULL, NULL, NULL, 2013, NULL, 'charot', NULL, 'Deleted an inventory', 'Inventory', '01:03 AM', NULL, NULL, NULL, NULL),
(25, 4, 87001, NULL, NULL, 1512, NULL, NULL, 'George', 'Vasquez', 'Updated a Trainer ', 'Trainers', '11:48 AM', NULL, NULL, NULL, NULL),
(26, 4, 87001, NULL, NULL, 1512, NULL, NULL, 'George', 'Vasquez', 'Updated a Trainer ', 'Trainers', '11:48 AM', NULL, NULL, NULL, NULL),
(27, 4, 87001, 1921681025, NULL, NULL, NULL, NULL, 'Dante', 'Phillips', 'Deleted an account from walk-in table', 'Members', '01:06 PM', NULL, NULL, NULL, NULL),
(28, 4, 87001, NULL, NULL, NULL, NULL, NULL, 'total sales', NULL, 'Generated a report for list of total sales', 'Reports', '01:27 PM', NULL, NULL, NULL, NULL),
(29, 4, 87001, NULL, NULL, NULL, NULL, 202100, 'Christmas Promo', NULL, 'Deleted a promo', 'Promos', '03:32 PM', NULL, NULL, NULL, NULL),
(30, 4, 87001, NULL, NULL, NULL, NULL, 202113, 'Back-to-school Promo', NULL, 'Added new promo', 'Promos', '05:11 PM', NULL, NULL, NULL, NULL),
(31, 4, 87001, NULL, NULL, NULL, NULL, 202113, 'Back-to-school Promo', NULL, 'Added new promo', 'Promos', '05:12 PM', NULL, NULL, NULL, NULL),
(32, 4, 87001, NULL, NULL, NULL, NULL, 202113, 'Back-to-school Promo', NULL, 'Added new promo', 'Promos', '05:28 PM', NULL, NULL, NULL, NULL),
(33, 4, 87001, NULL, NULL, NULL, NULL, 202113, 'Back-to-school Promo', NULL, 'Added new promo', 'Promos', '05:28 PM', NULL, NULL, NULL, NULL),
(34, 4, 87001, NULL, NULL, NULL, NULL, 202100, 'Christmas Promo', NULL, 'Restore a promo', 'Promos', '05:29 PM', NULL, NULL, NULL, NULL),
(35, 4, 87001, NULL, NULL, NULL, NULL, 202113, 'Back-to-school Promo', NULL, 'Added new promo', 'Promos', '05:29 PM', NULL, NULL, NULL, NULL),
(37, 4, 87001, NULL, NULL, NULL, NULL, 202113, 'Back-to-school Promo', NULL, 'Update a promo', 'Promos', '06:25 PM', NULL, NULL, NULL, NULL),
(38, 4, 87001, NULL, NULL, NULL, NULL, 202113, 'Back-to-school Promo', NULL, 'Update a promo', 'Promos', '06:26 PM', NULL, NULL, NULL, NULL),
(39, 4, 87001, NULL, NULL, NULL, NULL, 202113, 'Back-to-school Promo', NULL, 'Update a promo', 'Promos', '06:26 PM', NULL, NULL, NULL, NULL),
(40, 4, 87001, NULL, NULL, NULL, NULL, 202113, 'Back-to-school Promo', NULL, 'Update a promo', 'Promos', '06:27 PM', NULL, NULL, NULL, NULL),
(41, 4, 87001, NULL, NULL, NULL, NULL, 202113, 'Back-to-school Promo', NULL, 'Update a promo', 'Promos', '06:27 PM', NULL, NULL, NULL, NULL),
(42, 7, 87002, NULL, NULL, NULL, NULL, NULL, 'members expired subscription', NULL, 'Generated a report for members with expired subscription', 'Reports', '10:35 PM', NULL, NULL, NULL, NULL),
(43, 9, 87002, NULL, NULL, NULL, NULL, NULL, 'members expired subscription', NULL, 'Generated a report for members with expired subscription', 'Reports', '06:39 PM', NULL, NULL, NULL, NULL),
(44, 9, 87002, NULL, NULL, NULL, NULL, NULL, 'members expired subscription', NULL, 'Generated a report for members with expired subscription', 'Reports', '06:39 PM', NULL, NULL, NULL, NULL),
(45, 9, 87002, NULL, NULL, NULL, NULL, NULL, 'members expired subscription', NULL, 'Generated a report for members with expired subscription', 'Reports', '06:39 PM', NULL, NULL, NULL, NULL),
(46, 9, 87002, NULL, NULL, NULL, NULL, NULL, 'members expired subscription', NULL, 'Generated a report for members with expired subscription', 'Reports', '06:39 PM', NULL, NULL, NULL, NULL),
(47, 9, 87002, NULL, NULL, NULL, NULL, NULL, 'members expired subscription', NULL, 'Generated a report for members with expired subscription', 'Reports', '06:39 PM', NULL, NULL, NULL, NULL),
(48, 9, 87002, NULL, NULL, NULL, NULL, NULL, 'members expired subscription', NULL, 'Generated a report for members with expired subscription', 'Reports', '06:39 PM', NULL, NULL, NULL, NULL),
(49, 9, 87002, NULL, NULL, NULL, NULL, NULL, 'members expired subscription', NULL, 'Generated a report for members with expired subscription', 'Reports', '06:39 PM', NULL, NULL, NULL, NULL),
(50, 9, 87002, NULL, NULL, NULL, NULL, NULL, 'members expired subscription', NULL, 'Generated a report for members with expired subscription', 'Reports', '06:40 PM', NULL, NULL, NULL, NULL),
(51, 9, 87002, NULL, NULL, NULL, NULL, NULL, 'members expired subscription', NULL, 'Generated a report for members with expired subscription', 'Reports', '06:40 PM', NULL, NULL, NULL, NULL),
(52, 9, 87002, NULL, NULL, NULL, NULL, NULL, 'members expired subscription', NULL, 'Generated a report for members with expired subscription', 'Reports', '06:40 PM', NULL, NULL, NULL, NULL),
(53, 9, 87002, NULL, NULL, NULL, NULL, NULL, 'members expired subscription', NULL, 'Generated a report for members with expired subscription', 'Reports', '06:40 PM', NULL, NULL, NULL, NULL),
(54, 9, 87002, NULL, NULL, NULL, NULL, NULL, 'members expired subscription', NULL, 'Generated a report for members with expired subscription', 'Reports', '06:40 PM', NULL, NULL, NULL, NULL),
(55, 9, 87002, NULL, NULL, NULL, NULL, NULL, 'members expired subscription', NULL, 'Generated a report for members with expired subscription', 'Reports', '06:40 PM', NULL, NULL, NULL, NULL),
(56, 9, 87002, NULL, NULL, NULL, NULL, NULL, 'members ongoing subscription', NULL, 'Generated a report for members with  ongoing subscription', 'Reports', '06:40 PM', NULL, NULL, NULL, NULL),
(57, 9, 87002, NULL, NULL, NULL, NULL, NULL, 'members expired subscription', NULL, 'Generated a report for members with expired subscription', 'Reports', '06:41 PM', NULL, NULL, NULL, NULL),
(58, 9, 87002, NULL, NULL, NULL, NULL, NULL, 'members expired subscription', NULL, 'Generated a report for members with expired subscription', 'Reports', '06:41 PM', NULL, NULL, NULL, NULL),
(59, 9, 87002, NULL, NULL, NULL, NULL, NULL, 'members expired subscription', NULL, 'Generated a report for members with expired subscription', 'Reports', '06:42 PM', NULL, NULL, NULL, NULL),
(60, 9, 87002, NULL, NULL, NULL, NULL, NULL, 'members expired subscription', NULL, 'Generated a report for members with expired subscription', 'Reports', '06:43 PM', NULL, NULL, NULL, NULL),
(61, 9, 87002, NULL, NULL, NULL, NULL, NULL, 'members expired subscription', NULL, 'Generated a report for members with expired subscription', 'Reports', '06:43 PM', NULL, NULL, NULL, NULL),
(62, 9, 87002, NULL, NULL, NULL, NULL, 202112, 'Senior Discount', NULL, 'Update a promo', 'Promos', '07:36 PM', NULL, NULL, NULL, NULL),
(63, 9, 87002, NULL, NULL, NULL, NULL, 202101, 'Student Discount', NULL, 'Update a promo', 'Promos', '07:36 PM', NULL, NULL, NULL, NULL),
(64, 10, 87001, NULL, NULL, NULL, 2010, NULL, '5 lb dumbbell', NULL, 'Update equipment', 'Inventory', '11:27 AM', NULL, NULL, NULL, NULL),
(65, 10, 87001, NULL, NULL, NULL, 2014, NULL, 'Rowing machine', NULL, 'Added new equipment', 'Inventory', '11:36 AM', NULL, NULL, NULL, NULL),
(66, 10, 87001, NULL, NULL, NULL, 2015, NULL, 'Exercise Stationary Bike', NULL, 'Added new equipment', 'Inventory', '11:40 AM', NULL, NULL, NULL, NULL),
(67, 10, 87001, NULL, NULL, NULL, 2015, NULL, 'Exercise Stationary Bike', NULL, 'Update equipment', 'Inventory', '11:40 AM', NULL, NULL, NULL, NULL),
(68, 10, 87001, NULL, NULL, NULL, 2016, NULL, '10 lb dumbbell', NULL, 'Added new equipment', 'Inventory', '11:41 AM', NULL, NULL, NULL, NULL),
(69, 10, 87001, NULL, NULL, NULL, 2017, NULL, '15 lbs weight disc', NULL, 'Added new equipment', 'Inventory', '11:41 AM', NULL, NULL, NULL, NULL),
(70, 10, 87001, NULL, NULL, NULL, 2010, NULL, '5 lbs dumbbell', NULL, 'Update equipment', 'Inventory', '11:42 AM', NULL, NULL, NULL, NULL),
(71, 10, 87001, NULL, NULL, NULL, 2016, NULL, '10 lbs dumbbell', NULL, 'Update equipment', 'Inventory', '11:42 AM', NULL, NULL, NULL, NULL),
(72, 10, 87001, NULL, NULL, NULL, 2015, NULL, 'Exercise Stationary Bike', NULL, 'Update equipment', 'Inventory', '11:42 AM', NULL, NULL, NULL, NULL),
(73, 10, 87001, NULL, NULL, NULL, 2015, NULL, 'Exercise Stationary Bike', NULL, 'Update equipment', 'Inventory', '11:42 AM', NULL, NULL, NULL, NULL),
(74, 10, 87001, NULL, NULL, NULL, 2015, NULL, 'Exercise stationary bike', NULL, 'Update equipment', 'Inventory', '11:43 AM', NULL, NULL, NULL, NULL),
(75, 10, 87001, NULL, NULL, NULL, 2018, NULL, '15 lbs dumbbell', NULL, 'Added new equipment', 'Inventory', '11:44 AM', NULL, NULL, NULL, NULL),
(76, 10, 87001, NULL, NULL, NULL, 2019, NULL, '20 lbs dumbbell', NULL, 'Added new equipment', 'Inventory', '11:45 AM', NULL, NULL, NULL, NULL),
(77, 10, 87001, NULL, NULL, NULL, NULL, NULL, 'damage equipments', NULL, 'Generated a report for damage equipment', 'Reports', '11:46 AM', NULL, NULL, NULL, NULL),
(78, 10, 87001, NULL, NULL, NULL, NULL, NULL, 'list of trainers', NULL, 'Generated a report for list of trainers', 'Reports', '11:46 AM', NULL, NULL, NULL, NULL),
(79, 10, 87001, NULL, NULL, NULL, NULL, NULL, 'list of trainers', NULL, 'Generated a report for list of trainers', 'Reports', '11:48 AM', NULL, NULL, NULL, NULL),
(80, 10, 87001, NULL, NULL, NULL, NULL, NULL, 'list of trainers', NULL, 'Generated a report for list of trainers', 'Reports', '11:48 AM', NULL, NULL, NULL, NULL),
(81, 10, 87001, NULL, NULL, NULL, NULL, NULL, 'list of trainers', NULL, 'Generated a report for list of trainers', 'Reports', '11:48 AM', NULL, NULL, NULL, NULL),
(82, 10, 87001, NULL, NULL, NULL, 2020, NULL, '25 lbs dumbbell', NULL, 'Added new equipment', 'Inventory', '11:49 AM', NULL, NULL, NULL, NULL),
(83, 10, 87001, NULL, NULL, NULL, 2021, NULL, 'Barbell bar', NULL, 'Added new equipment', 'Inventory', '11:49 AM', NULL, NULL, NULL, NULL),
(84, 10, 87001, NULL, NULL, NULL, 2014, NULL, 'Rowing machine', NULL, 'Update equipment', 'Inventory', '11:51 AM', NULL, NULL, NULL, NULL),
(85, 10, 87001, NULL, NULL, NULL, 2022, NULL, '5 lbs weight disc', NULL, 'Added new equipment', 'Inventory', '11:52 AM', NULL, NULL, NULL, NULL),
(86, 10, 87001, NULL, NULL, NULL, 2023, NULL, '10 lbs weight disc', NULL, 'Added new equipment', 'Inventory', '11:54 AM', NULL, NULL, NULL, NULL),
(87, 12, 87001, NULL, NULL, NULL, NULL, NULL, 'list of inactive members', NULL, 'Generated a report for list of inactive members', 'Reports', '10:53 AM', NULL, NULL, NULL, NULL),
(88, 12, 87001, NULL, NULL, NULL, NULL, NULL, 'list of inactive members', NULL, 'Generated a report for list of inactive members', 'Reports', '10:53 AM', NULL, NULL, NULL, NULL),
(89, 12, 87001, NULL, NULL, NULL, NULL, NULL, 'list of inactive members', NULL, 'Generated a report for list of inactive members', 'Reports', '10:53 AM', NULL, NULL, NULL, NULL),
(90, 12, 87001, NULL, NULL, NULL, NULL, NULL, 'list of inactive members', NULL, 'Generated a report for list of inactive members', 'Reports', '10:55 AM', NULL, NULL, NULL, NULL),
(91, 12, 87001, NULL, NULL, NULL, NULL, NULL, 'list of inactive members', NULL, 'Generated a report for list of inactive members', 'Reports', '10:55 AM', NULL, NULL, NULL, NULL),
(92, 12, 87001, NULL, NULL, NULL, NULL, NULL, 'list of inactive members', NULL, 'Generated a report for list of inactive members', 'Reports', '11:04 AM', NULL, NULL, NULL, NULL),
(93, 12, 87001, 1921681091, NULL, NULL, NULL, NULL, 'Josiah', 'Luna', 'Recover an account to Regular table', 'Members', '11:06 AM', NULL, NULL, NULL, NULL),
(94, 12, 87001, 1921681091, NULL, NULL, NULL, NULL, 'Josiah', 'Luna', 'Recover an account to Regular table', 'Members', '11:06 AM', NULL, NULL, NULL, NULL),
(95, 12, 87001, 1921681091, NULL, NULL, NULL, NULL, 'Josiah', 'Luna', 'Recover an account to Regular table', 'Members', '11:08 AM', NULL, NULL, NULL, NULL),
(96, 12, 87001, NULL, NULL, NULL, NULL, NULL, 'list of inactive members', NULL, 'Generated a report for list of inactive members', 'Reports', '11:08 AM', NULL, NULL, NULL, NULL),
(97, 12, 87001, NULL, NULL, NULL, NULL, NULL, 'members ongoing subscription', NULL, 'Generated a report for members with  ongoing subscription', 'Reports', '11:08 AM', NULL, NULL, NULL, NULL),
(98, 12, 87001, NULL, NULL, NULL, NULL, NULL, 'list of inactive members', NULL, 'Generated a report for list of inactive members', 'Reports', '11:08 AM', NULL, NULL, NULL, NULL),
(99, 12, 87001, NULL, NULL, NULL, NULL, NULL, 'list of inactive members', NULL, 'Generated a report for list of inactive members', 'Reports', '11:09 AM', NULL, NULL, NULL, NULL),
(100, 12, 87001, NULL, NULL, NULL, NULL, NULL, 'list of inactive members', NULL, 'Generated a report for list of inactive members', 'Reports', '11:14 AM', NULL, NULL, NULL, NULL),
(101, 12, 87001, NULL, NULL, NULL, NULL, NULL, 'list of inactive members', NULL, 'Generated a report for list of inactive members', 'Reports', '11:15 AM', NULL, NULL, NULL, NULL),
(102, 12, 87001, NULL, NULL, NULL, NULL, NULL, 'members expired subscription', NULL, 'Generated a report for members with expired subscription', 'Reports', '11:16 AM', NULL, NULL, NULL, NULL),
(103, 12, 87001, NULL, NULL, NULL, NULL, NULL, 'members ongoing subscription', NULL, 'Generated a report for members with  ongoing subscription', 'Reports', '11:16 AM', NULL, NULL, NULL, NULL),
(104, 12, 87001, NULL, NULL, NULL, NULL, NULL, 'list of inactive members', NULL, 'Generated a report for list of inactive members', 'Reports', '11:16 AM', NULL, NULL, NULL, NULL),
(105, 12, 87001, NULL, NULL, NULL, NULL, NULL, 'list of inactive members', NULL, 'Generated a report for list of inactive members', 'Reports', '11:17 AM', NULL, NULL, NULL, NULL),
(106, 12, 87001, 1921681015, NULL, NULL, NULL, NULL, 'Kim', 'Jorolan', 'Activated the account', 'Members', '01:22 PM', NULL, NULL, NULL, NULL),
(107, 12, 87001, NULL, NULL, NULL, NULL, 202113, 'Kim Jorolan', NULL, 'Remove a member from Back-to-school Promo promo', 'Promos', '01:24 PM', NULL, NULL, NULL, NULL),
(108, 12, 87001, NULL, NULL, NULL, NULL, 202101, 'Kim Jorolan', NULL, 'Remove a member from Student Discount promo', 'Promos', '01:24 PM', NULL, NULL, NULL, NULL),
(109, 15, 87001, 1921681014, NULL, NULL, NULL, NULL, 'John Jay', 'Desierto', 'Activated the account', 'Members', '04:45 PM', NULL, NULL, NULL, NULL),
(110, 15, 87001, 1921681014, NULL, NULL, NULL, NULL, 'John Jay', 'Desierto', 'Deactivated the Account', 'Members', '04:45 PM', NULL, NULL, NULL, NULL),
(111, 15, 87001, 1921681014, NULL, NULL, NULL, NULL, 'John Jay', 'Desierto', 'Deactivated the Account', 'Members', '04:45 PM', NULL, NULL, NULL, NULL),
(112, 15, 87001, 1921681011, NULL, NULL, NULL, NULL, 'John', 'Doe', 'Activated the account', 'Members', '04:49 PM', NULL, NULL, NULL, NULL);

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
  `time_deleted` time DEFAULT NULL,
  `isActivated` enum('true','false') NOT NULL DEFAULT 'false',
  `isDeleted` enum('true','false') NOT NULL DEFAULT 'false',
  `date_activated` date DEFAULT NULL,
  `monthly_start` date DEFAULT NULL,
  `monthly_end` date DEFAULT NULL,
  `annual_start` date DEFAULT NULL,
  `annual_end` date DEFAULT NULL,
  `member_type` enum('Regular','Walk-in') DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `acc_status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `program_id` int(11) NOT NULL,
  `image_pathname` varchar(9999) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`member_id`, `first_name`, `last_name`, `username`, `password`, `gender`, `birthdate`, `email`, `phone`, `member_status`, `date_registered`, `date_deleted`, `time_deleted`, `isActivated`, `isDeleted`, `date_activated`, `monthly_start`, `monthly_end`, `annual_start`, `annual_end`, `member_type`, `address`, `acc_status`, `program_id`, `image_pathname`) VALUES
(1921681011, 'John', 'Doe', 'johndoe', '$2y$10$ng6vDgB2bZnNAZf4ojemaej77TYkwySfHKKQlbtGxIaz2btNWuZli', 'M', '1931-01-01', 'johndoe@gmail.com', '09152351252', 'Paid', '2021-02-09', NULL, NULL, 'true', 'false', '0000-00-00', '2021-03-19', '2021-04-18', '2021-02-16', '2022-02-16', 'Regular', '2nd floor G7 Suites', 'active', 1, 'wp6645977.png'),
(1921681012, 'George', 'Duterte', NULL, NULL, 'M', '1998-01-01', 'georgebush@hotmail.com', '09233215471', 'Not Paid', '2021-02-16', NULL, NULL, 'false', 'false', NULL, NULL, NULL, '2021-02-16', '2022-02-16', 'Regular', '2nd floor G7 Suites', 'active', 2, ''),
(1921681013, 'Christian James', 'Gulapa', NULL, NULL, 'M', '1978-01-01', 'cjbayot@gmail.com', '09455611244', 'Paid', '2021-02-17', NULL, '06:39:31', 'false', 'false', NULL, '2021-03-18', '2021-04-17', '2021-03-18', '2022-03-18', 'Regular', 'Talamban, Cebu', 'active', 1, ''),
(1921681014, 'John Jay', 'Desierto', '1921681014', '$2y$10$SM9gjk1E4wTFWhbyS1rewOKUcdpqwr5ndlQsd09xsDGw/y7a0hUES', 'M', '1998-05-12', 'johnjay@gmail.com', '09124562133', 'Paid', '2021-02-17', NULL, NULL, 'false', 'false', '2021-03-29', '2021-03-05', '2021-04-04', '2021-03-05', '2022-03-05', 'Regular', 'Talamban, Cebu', 'active', 1, ''),
(1921681015, 'Kim', 'Jorolan', '1921681015', '$2y$10$Bla6ve7HtM52uRczZX8I3u7eDUJMNtRW2iiLve/UlA0S2dvHDN8Ym', 'M', '1987-09-15', 'kimjorolan@gmail.com', '09234567891', 'Not Paid', '2021-02-17', NULL, NULL, 'false', 'false', '2021-03-22', NULL, NULL, NULL, NULL, 'Regular', 'Talamban, Cebu', 'active', 2, ''),
(1921681016, 'Michael', 'Antiporta', '1921681016', '$2y$10$pm2RPs6jo.Y442ISAhzu4eKjyxUET5IAD0vqJBXUS/KPLm0y5oZXq', 'M', '1996-02-15', 'kaelantiporta@gmail.com', '09201235400', 'Expired', '2021-02-17', NULL, NULL, 'false', 'false', '2021-03-06', '2020-07-01', '2020-07-31', '2020-07-01', '2021-07-01', 'Regular', 'Badian, Cebu, Philippines', 'active', 2, ''),
(1921681017, 'Thomas Rey', 'Barcenas', NULL, NULL, 'M', '1993-09-04', 'thomdatrain@gmail.com', '09475466911', 'Not Paid', '2021-02-17', NULL, NULL, 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Regular', 'Toledo City, Cebu', 'active', 2, ''),
(1921681018, 'Justine', 'Garcia', NULL, NULL, 'M', '1998-11-15', 'justinegarcia@gmail.com', '09135644887', 'Not Paid', '2021-02-17', NULL, NULL, 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Regular', 'Subangdaku, Mandaue', 'active', 1, ''),
(1921681019, 'Romhel', 'Ceniza', NULL, NULL, 'M', '1998-01-21', 'aldiceniza@gmail.com', '09234561121', 'Not Paid', '2021-02-17', NULL, NULL, 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Regular', 'Pit-os, Talamban, Cebu City', 'active', 1, ''),
(1921681020, 'Jade', 'Tibon', NULL, NULL, 'M', '1999-12-15', 'jadetibones@gmail.com', '09334651320', 'Not Paid', '2021-02-17', NULL, NULL, 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Regular', 'Jagobiao, Mandaue City', 'active', 1, ''),
(1921681021, 'Francis', 'Vasquez', NULL, NULL, 'M', '1997-02-14', 'bogoorven@gmail.com', '09164562230', 'Paid', '2021-02-17', NULL, NULL, 'false', 'false', NULL, '2021-02-22', '2021-04-23', '2021-02-22', '2022-02-22', 'Regular', 'Bacolod City', 'active', 2, ''),
(1921681022, 'Weinnand', 'Hasanion', NULL, NULL, 'M', '1999-08-04', 'weinnandhasanion@gmail.com', '09206013530', 'Expired', '2021-02-17', NULL, NULL, 'false', 'false', NULL, '2021-02-18', '2021-03-20', '2021-02-18', '2022-02-18', 'Regular', 'Lapulapu City, Cebu', 'active', 1, ''),
(1921681023, 'Ivanne', 'Candano', NULL, NULL, 'M', '1998-03-16', 'vancandano@gmail.com', '09455641010', 'Expired', '2021-02-17', NULL, NULL, 'false', 'false', NULL, '2021-02-18', '2021-03-20', '2021-02-18', '2022-02-18', 'Regular', 'Pagadian, Philippines', 'active', 1, ''),
(1921681024, 'Clint', 'Lapera', 'febieclint', '$2y$10$96uGA7tAS5TSAchRuLlPcu6kFQpBB9oUvkXfVmbvItAYY2E4uBgTK', 'M', '2000-02-10', 'clintlapera@gmail.com', '09165433165', 'Paid', '2021-02-18', '2021-02-23', NULL, 'false', 'false', '2021-02-18', '2021-03-22', '2021-04-21', '2021-02-18', '2022-02-18', 'Regular', 'Masulog, Lapu-Lapu City', 'active', 1, '121773513_3617406608324077_306887283432560114_o.jpg'),
(1921681025, 'Dante', 'Phillips', NULL, NULL, 'F', '1988-04-09', 'blandit.congue.In@vitaeeratVivamus.edu', '09503661490', 'Not Paid', '2020-12-26', '2021-03-18', '13:06:15', 'false', 'true', NULL, NULL, NULL, NULL, NULL, 'Walk-in', '4979 A Ave', 'inactive', 1, ''),
(1921681026, 'Phelan', 'Blackwell', NULL, NULL, 'M', '1988-12-03', 'magna@Praesenteudui.com', '09819897080', 'Not Paid', '2020-05-10', NULL, NULL, 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Regular', 'Ap #623-6725 Sit Rd.', 'active', 2, ''),
(1921681027, 'Hamish', 'Kelly', NULL, NULL, 'M', '1976-07-10', 'nunc.ac.mattis@a.co.uk', '09942335946', 'Not Paid', '2020-10-15', NULL, NULL, 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Regular', '133-6723 Lorem Road', 'active', 1, ''),
(1921681028, 'Cedric', 'Huffman', NULL, NULL, 'M', '1986-09-02', 'tellus.Phasellus.elit@loremfringilla.edu', '09859151288', 'Expired', '2018-08-03', '2020-10-25', NULL, 'false', 'false', NULL, '2020-01-05', '2020-03-04', '2019-10-01', '2020-10-01', 'Regular', '3286 Volutpat. Road', 'inactive', 2, ''),
(1921681029, 'Graham', 'Vang', NULL, NULL, 'F', '1974-08-03', 'auctor@sagittis.edu', '09728554807', 'Not Paid', '2018-07-26', NULL, NULL, 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Walk-in', 'Ap #213-9940 Nunc Street', 'active', 1, ''),
(1921681030, 'Gil', 'Eaton', NULL, NULL, 'F', '1989-04-10', 'bibendum@ac.com', '09283818109', 'Not Paid', '2018-07-01', NULL, NULL, 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Regular', '118-1929 Nec Road', 'active', 2, ''),
(1921681031, 'Lance', 'Calderon', NULL, NULL, 'F', '1995-10-08', 'dolor.Fusce@ligulaNullamenim.edu', '09103482282', 'Not Paid', '2018-08-15', NULL, NULL, 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Walk-in', '770-6890 Consequat Avenue', 'active', 1, ''),
(1921681032, 'Rigel', 'Wilson', NULL, NULL, 'F', '1999-12-21', 'orci.quis@interdumfeugiat.co.uk', '09462250477', 'Not Paid', '2021-02-22', '2021-03-18', '00:11:07', 'false', 'true', NULL, NULL, NULL, NULL, NULL, 'Walk-in', 'P.O. Box 730, 5300 Dignissim. Ave', 'inactive', 1, ''),
(1921681033, 'Ivor', 'Potts', NULL, NULL, 'F', '1997-06-11', 'lectus.Nullam.suscipit@amet.edu', '09774901141', 'Not Paid', '2018-04-11', NULL, NULL, 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Regular', 'P.O. Box 942, 7742 Duis Rd.', 'active', 2, ''),
(1921681034, 'Xanthus', 'Joyce', NULL, NULL, 'F', '2000-04-02', 'eget@lacusEtiam.org', '09982524430', 'Not Paid', '2020-09-02', NULL, NULL, 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Regular', 'P.O. Box 364, 5901 Lorem St.', 'active', 2, ''),
(1921681035, 'Oren', 'Baird', NULL, NULL, 'F', '1976-03-15', 'Cum.sociis.natoque@dictum.com', '09282261414', 'Not Paid', '2018-11-12', NULL, NULL, 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Regular', '525-9260 Lorem, Ave', 'active', 2, ''),
(1921681036, 'Cameron', 'Bates', NULL, NULL, 'F', '1988-01-14', 'nisi.sem.semper@velmaurisInteger.ca', '09180678532', 'Not Paid', '2020-09-05', NULL, NULL, 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Regular', 'Ap #931-8291 Nunc Street', 'active', 1, ''),
(1921681037, 'Vincent', 'Hanson', NULL, NULL, 'F', '1992-01-03', 'iaculis.lacus@faucibusMorbivehicula.edu', '09648533037', 'Not Paid', '2019-05-03', NULL, NULL, 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Regular', 'P.O. Box 935, 8945 Cursus Avenue', 'active', 1, ''),
(1921681038, 'Joel', 'Calhoun', NULL, NULL, 'M', '1989-08-06', 'vel.venenatis@nunc.net', '09682880508', 'Not Paid', '2019-08-16', NULL, NULL, 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Regular', '7571 Penatibus Road', 'active', 1, ''),
(1921681039, 'Lyle', 'Griffith', NULL, NULL, 'M', '1995-09-01', 'Donec.tempor@Cum.org', '09848565730', 'Not Paid', '2019-04-08', NULL, NULL, 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Walk-in', '3094 Mi. Ave', 'active', 1, ''),
(1921681040, 'Jermaine', 'Osborn', NULL, NULL, 'M', '1989-10-19', 'vulputate.risus.a@ipsumnonarcu.com', '09637532023', 'Not Paid', '2019-08-12', NULL, NULL, 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Walk-in', '1623 Arcu St.', 'active', 2, ''),
(1921681041, 'Rafael', 'Witt', NULL, NULL, 'F', '1973-07-24', 'ac@idblanditat.org', '09531736583', 'Not Paid', '2018-03-20', NULL, NULL, 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Walk-in', '908-1554 Lectus Rd.', 'active', 2, ''),
(1921681042, 'Herrod', 'Lang', NULL, NULL, 'F', '1979-10-19', 'sagittis.lobortis.mauris@sedpedenec.edu', '09824158157', 'Not Paid', '2020-05-02', NULL, NULL, 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Walk-in', '8635 Neque Av.', 'active', 1, ''),
(1921681043, 'Clarke', 'Jacobson', NULL, NULL, 'F', '1980-02-16', 'ipsum@laciniaSedcongue.net', '09736071281', 'Paid', '2020-03-13', '2021-03-18', '12:50:14', 'false', 'true', NULL, '2021-02-23', '2021-03-25', '2021-02-23', '2022-02-23', 'Regular', '826-8158 Gravida Street', 'inactive', 1, ''),
(1921681044, 'Alvin', 'Vance', NULL, NULL, 'M', '1983-02-05', 'Sed.pharetra@temporbibendum.co.uk', '09334981692', 'Not Paid', '2018-11-19', NULL, NULL, 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Walk-in', '746-313 Orci Road', 'active', 1, ''),
(1921681045, 'Xavier', 'Ellis', NULL, NULL, 'F', '1991-05-14', 'nisi@Duis.ca', '09905178265', 'Not Paid', '2019-02-14', NULL, NULL, 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Walk-in', '2242 Neque Av.', 'active', 2, ''),
(1921681046, 'Wallace', 'Velasquez', NULL, NULL, 'F', '1991-04-28', 'at.pretium@euismodenimEtiam.co.uk', '09917962390', 'Not Paid', '2020-07-19', NULL, NULL, 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Regular', '253-1786 Lectus Rd.', 'active', 2, ''),
(1921681047, 'Graiden', 'Knight', NULL, NULL, 'M', '1988-04-28', 'ridiculus.mus.Aenean@ultricesVivamusrhoncus.net', '09449699878', 'Not Paid', '2020-01-09', NULL, NULL, 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Regular', '975-3806 A, Rd.', 'active', 2, ''),
(1921681048, 'Wang', 'Bradshaw', NULL, NULL, 'F', '1997-01-25', 'nisl.Nulla@sodales.co.uk', '09875369629', 'Not Paid', '2018-03-29', NULL, NULL, 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Regular', '5884 Egestas Ave', 'active', 2, ''),
(1921681049, 'Chandler', 'Lowery', NULL, NULL, 'M', '1976-02-08', 'neque.vitae@inconsequat.edu', '09944567659', 'Not Paid', '2019-05-21', NULL, NULL, 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Walk-in', '570-6336 Quam, Av.', 'active', 1, ''),
(1921681050, 'Caesar', 'Maxwell', NULL, NULL, 'F', '1999-07-27', 'molestie.arcu.Sed@adipiscingelitEtiam.com', '09691967540', 'Not Paid', '2018-04-16', NULL, NULL, 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Walk-in', 'P.O. Box 432, 9045 Morbi St.', 'active', 1, ''),
(1921681051, 'Akeem', 'Pollard', NULL, NULL, 'M', '1978-09-06', 'hymenaeos@felisNulla.edu', '09983166627', 'Not Paid', '2020-04-10', NULL, NULL, 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Regular', '1030 Orci St.', 'active', 1, ''),
(1921681052, 'Salvador', 'Knapp', NULL, NULL, 'F', '1976-08-25', 'sit.amet@Nunc.org', '09982239424', 'Not Paid', '2020-01-29', NULL, NULL, 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Walk-in', '9634 Eu, St.', 'active', 2, ''),
(1921681053, 'Magee', 'Ayers', NULL, NULL, 'M', '1982-03-06', 'tempus@non.net', '09320480090', 'Not Paid', '2019-07-07', NULL, NULL, 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Walk-in', 'Ap #218-8399 Vestibulum. Road', 'active', 2, ''),
(1921681054, 'Jeremy', 'Frye', NULL, NULL, 'F', '1978-01-15', 'cursus@ullamcorpereu.com', '09385439462', 'Not Paid', '2019-08-20', NULL, NULL, 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Walk-in', '273-8995 Enim. Ave', 'active', 2, ''),
(1921681055, 'Jonas', 'Garza', NULL, NULL, 'F', '1992-02-10', 'malesuada.vel.venenatis@massaVestibulum.edu', '09566241596', 'Not Paid', '2019-09-13', NULL, NULL, 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Regular', '811-6487 Et Rd.', 'active', 2, ''),
(1921681056, 'Porter', 'Lowery', NULL, NULL, 'M', '1979-09-11', 'taciti.sociosqu@non.org', '09509845702', 'Not Paid', '2020-07-14', NULL, NULL, 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Walk-in', 'Ap #450-1414 Adipiscing Av.', 'active', 2, ''),
(1921681057, 'Phelan', 'Galloway', NULL, NULL, 'F', '1989-04-20', 'mollis.Integer@consequatenim.ca', '09106606601', 'Not Paid', '2019-11-07', NULL, NULL, 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Walk-in', 'Ap #708-3794 Lacinia St.', 'active', 2, ''),
(1921681058, 'Asher', 'Mcclure', NULL, NULL, 'M', '1979-05-25', 'eros@molestiepharetra.edu', '09127396138', 'Not Paid', '2019-07-17', NULL, NULL, 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Regular', '445-9684 Sem St.', 'active', 2, ''),
(1921681059, 'Basil', 'Hodges', NULL, NULL, 'F', '1986-03-30', 'eu.metus.In@uteros.co.uk', '09115474709', 'Not Paid', '2019-06-27', NULL, NULL, 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Walk-in', 'P.O. Box 182, 725 Libero Rd.', 'active', 1, ''),
(1921681060, 'Boris', 'Hopkins', NULL, NULL, 'F', '1992-05-01', 'blandit.congue.In@lorem.co.uk', '09249104148', 'Not Paid', '2018-04-26', NULL, NULL, 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Regular', '5548 Nec, Ave', 'active', 1, ''),
(1921681061, 'Ulric', 'Rollins', NULL, NULL, 'M', '2000-05-19', 'non.lobortis.quis@pedeCrasvulputate.com', '09598153405', 'Not Paid', '2018-12-18', NULL, NULL, 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Walk-in', '756-1186 Phasellus Rd.', 'active', 1, ''),
(1921681062, 'William', 'Suarez', NULL, NULL, 'M', '1981-05-30', 'dui.Cum@tempusmauris.ca', '09930619290', 'Not Paid', '2020-01-29', NULL, NULL, 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Regular', 'P.O. Box 608, 8662 Ornare St.', 'active', 2, ''),
(1921681063, 'Lucian', 'Slater', NULL, NULL, 'F', '2000-03-28', 'cursus.purus@Praesent.edu', '09781339342', 'Not Paid', '2020-10-29', NULL, NULL, 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Walk-in', 'P.O. Box 508, 6827 Tincidunt. Road', 'active', 1, ''),
(1921681064, 'Cedric', 'Raymond', NULL, NULL, 'M', '1997-05-16', 'sem.Nulla.interdum@adipiscingenimmi.co.uk', '09372214862', 'Not Paid', '2019-06-22', NULL, NULL, 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Walk-in', 'Ap #497-8148 Faucibus Rd.', 'active', 1, ''),
(1921681065, 'Gage', 'Tucker', NULL, NULL, 'F', '1991-03-12', 'blandit.at@ipsumdolorsit.co.uk', '09301779974', 'Not Paid', '2020-08-28', NULL, NULL, 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Walk-in', '996-6180 Molestie Rd.', 'active', 2, ''),
(1921681066, 'Troy', 'Lloyd', NULL, NULL, 'F', '1978-03-22', 'dictum@etnuncQuisque.com', '09603704508', 'Not Paid', '2018-03-11', NULL, NULL, 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Walk-in', 'Ap #478-1955 Urna Av.', 'active', 2, ''),
(1921681067, 'David', 'Roach', NULL, NULL, 'M', '1996-01-09', 'ut@luctus.edu', '09267815600', 'Not Paid', '2019-02-22', NULL, NULL, 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Regular', '5503 Mauris Avenue', 'active', 2, ''),
(1921681068, 'Fuller', 'Boyd', NULL, NULL, 'M', '1995-05-12', 'Donec@loremfringilla.ca', '09394496753', 'Not Paid', '2019-02-07', NULL, NULL, 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Walk-in', '6721 Etiam Road', 'active', 1, ''),
(1921681069, 'Simon', 'Clarke', NULL, NULL, 'M', '2000-02-05', 'magna.Praesent@Donecegestas.edu', '09777071216', 'Not Paid', '2020-12-04', NULL, NULL, 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Regular', '471-7279 Vulputate, Avenue', 'active', 1, ''),
(1921681070, 'Thomas', 'Thornton', NULL, NULL, 'F', '1984-02-03', 'Cras.eget@vitae.ca', '09587604314', 'Not Paid', '2018-03-18', NULL, NULL, 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Walk-in', 'P.O. Box 283, 2691 Pede Av.', 'active', 2, ''),
(1921681071, 'Steven', 'Deleon', NULL, NULL, 'M', '1987-02-21', 'Phasellus@Maurisvelturpis.org', '09688024898', 'Not Paid', '2020-02-21', NULL, NULL, 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Regular', '3383 Interdum. Street', 'active', 2, ''),
(1921681072, 'Quentin', 'Mclaughlin', NULL, NULL, 'F', '1988-03-16', 'libero.Proin@utmiDuis.co.uk', '09934019321', 'Not Paid', '2019-04-06', NULL, NULL, 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Walk-in', 'Ap #585-3600 Nisi Avenue', 'active', 1, ''),
(1921681073, 'Cruz', 'Combs', NULL, NULL, 'F', '1986-12-25', 'mus.Proin@ultriciesdignissim.net', '09592681068', 'Not Paid', '2020-04-17', NULL, NULL, 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Regular', 'Ap #947-1102 Sem. Road', 'active', 1, ''),
(1921681074, 'Keefe', 'England', NULL, NULL, 'F', '1979-06-05', 'urna.Ut@maurisMorbi.edu', '09237518540', 'Not Paid', '2020-11-06', NULL, NULL, 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Walk-in', 'P.O. Box 850, 1111 Eu St.', 'active', 2, ''),
(1921681075, 'Samson', 'Harvey', NULL, NULL, 'M', '1997-04-28', 'In.faucibus@aliquetmolestietellus.co.uk', '09957764442', 'Not Paid', '2018-06-01', NULL, NULL, 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Regular', 'Ap #339-5086 Feugiat Road', 'active', 1, ''),
(1921681076, 'Damon', 'Reynolds', NULL, NULL, 'M', '1978-07-20', 'erat@acrisusMorbi.com', '09760567029', 'Not Paid', '2020-10-20', NULL, NULL, 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Regular', 'Ap #183-587 Duis Av.', 'active', 1, ''),
(1921681077, 'Ciaran', 'Vincent', NULL, NULL, 'M', '1996-01-20', 'vitae.posuere@Sedpharetra.net', '09354945184', 'Not Paid', '2019-01-18', NULL, NULL, 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Walk-in', '909-1700 Cursus St.', 'active', 2, ''),
(1921681078, 'Sebastian', 'Farley', NULL, NULL, 'F', '1989-12-21', 'Suspendisse@necimperdietnec.org', '09565747679', 'Not Paid', '2019-08-25', NULL, NULL, 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Regular', 'P.O. Box 587, 6935 Diam St.', 'active', 2, ''),
(1921681079, 'Finn', 'Patterson', NULL, NULL, 'F', '1994-05-25', 'arcu.Sed@Vivamus.com', '09477503056', 'Not Paid', '2019-04-11', NULL, NULL, 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Regular', '5332 Integer St.', 'active', 2, ''),
(1921681080, 'Graham', 'Nunez', NULL, NULL, 'F', '1997-03-10', 'mus@aliquet.ca', '09634684992', 'Not Paid', '2018-05-06', NULL, NULL, 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Walk-in', 'P.O. Box 591, 2996 Accumsan St.', 'active', 2, ''),
(1921681081, 'Dane', 'Bird', NULL, NULL, 'F', '1982-02-18', 'vestibulum.massa.rutrum@metusfacilisislorem.edu', '09270804621', 'Not Paid', '2019-07-25', NULL, NULL, 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Walk-in', 'Ap #402-6538 Amet, Avenue', 'active', 1, ''),
(1921681082, 'Jared', 'Mullins', NULL, NULL, 'M', '1999-11-22', 'in@semut.co.uk', '09808136994', 'Not Paid', '2019-02-28', NULL, NULL, 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Regular', '661-542 Vulputate St.', 'active', 2, ''),
(1921681083, 'Giacomo', 'Mcgowan', NULL, NULL, 'F', '1982-11-15', 'Nulla@eu.ca', '09380918963', 'Not Paid', '2020-08-26', NULL, NULL, 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Walk-in', 'Ap #340-2379 Massa. St.', 'active', 2, ''),
(1921681084, 'Hamilton', 'Bernard', NULL, NULL, 'F', '1994-02-06', 'Donec.tempor.est@nequeseddictum.com', '09769927909', 'Not Paid', '2019-04-22', NULL, NULL, 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Regular', '5262 Mi Road', 'active', 2, ''),
(1921681085, 'Ciaran', 'Kinney', NULL, NULL, 'M', '1992-02-11', 'a@Etiamimperdiet.ca', '09692243138', 'Not Paid', '2020-01-15', NULL, NULL, 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Regular', '526 Mollis Ave', 'active', 2, ''),
(1921681086, 'Ishmael', 'Davidson', NULL, NULL, 'F', '1973-03-05', 'massa.Mauris.vestibulum@Donecest.ca', '09315304442', 'Not Paid', '2019-04-29', NULL, NULL, 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Walk-in', '6371 Malesuada St.', 'active', 1, ''),
(1921681087, 'Elton', 'Lyons', NULL, NULL, 'M', '1973-10-21', 'in@gravidanunc.ca', '09276062812', 'Paid', '2020-07-24', NULL, NULL, 'false', 'false', NULL, '2021-02-23', '2021-03-25', '2021-02-23', '2022-02-23', 'Regular', 'P.O. Box 902, 1824 Tellus St.', 'active', 2, ''),
(1921681088, 'Burke', 'Good', NULL, NULL, 'M', '1990-08-06', 'orci.Phasellus@Proinsedturpis.org', '09905620678', 'Not Paid', '2021-01-21', NULL, '23:52:02', 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Walk-in', 'P.O. Box 923, 1396 Rhoncus. Road', 'active', 2, ''),
(1921681089, 'Oleg', 'Whitley', NULL, NULL, 'F', '2000-02-12', 'penatibus.et@tellusnon.co.uk', '09872820215', 'Not Paid', '2020-10-03', NULL, NULL, 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Walk-in', 'P.O. Box 417, 9010 Aliquam St.', 'active', 1, ''),
(1921681090, 'Honorato', 'Barr', NULL, NULL, 'M', '1989-09-06', 'non.vestibulum@maurisid.com', '09170867269', 'Not Paid', '2019-03-15', NULL, NULL, 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Walk-in', 'P.O. Box 672, 4154 Pede, St.', 'active', 1, ''),
(1921681091, 'Josiah', 'Luna', NULL, NULL, 'F', '1985-02-26', 'a@nequeNullamnisl.edu', '09141565157', 'Paid', '2018-10-30', '2021-03-18', '12:50:21', 'false', 'false', NULL, '2021-02-23', '2021-03-25', '2021-02-23', '2022-02-23', 'Regular', '7983 Elementum Avenue', 'active', 2, ''),
(1921681092, 'Hammett', 'Vaughn', NULL, NULL, 'F', '1998-10-06', 'aliquet.Proin.velit@atarcu.com', '09495661215', 'Not Paid', '2018-12-16', NULL, NULL, 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Walk-in', '676 Penatibus Avenue', 'active', 2, '');

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
(3, 202111, 1921681011, '2021-02-16', 'Expired', NULL),
(4, 202111, 1921681022, '2021-02-18', 'Expired', NULL),
(5, 202111, 1921681043, '2021-02-23', 'Expired', NULL),
(6, 202112, 1921681013, '2021-02-23', 'Expired', NULL),
(7, 202101, 1921681014, '2021-02-23', 'Active', NULL),
(9, 202101, 1921681015, '2021-02-23', 'Expired', '2021-03-22'),
(10, 202101, 1921681055, '2021-02-23', 'Active', NULL),
(11, 202101, 1921681022, '2021-02-23', 'Active', NULL),
(12, 202101, 1921681046, '2021-02-23', 'Active', NULL),
(13, 202101, 1921681013, '2021-03-02', 'Expired', NULL),
(14, 202112, 1921681013, '2021-03-02', 'Active', NULL),
(15, 202113, 1921681015, '2021-03-05', 'Expired', '2021-03-22'),
(16, 202113, 1921681014, '2021-03-05', 'Active', NULL),
(17, 202113, 1921681016, '2021-03-06', 'Active', NULL),
(18, 202112, 1921681030, '2021-03-18', 'Active', NULL),
(19, 202101, 1921681026, '2021-03-18', 'Active', NULL),
(20, 202101, 1921681047, '2021-03-18', 'Active', NULL),
(21, 202113, 1921681024, '2021-03-22', 'Active', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `member_notifs`
--

CREATE TABLE `member_notifs` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `notif_id` int(11) NOT NULL,
  `status` enum('Unread','Read','Deleted') NOT NULL,
  `datetime_sent` timestamp NULL DEFAULT NULL,
  `date_read` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `member_notifs`
--

INSERT INTO `member_notifs` (`id`, `member_id`, `notif_id`, `status`, `datetime_sent`, `date_read`) VALUES
(14, 1921681011, 1, 'Read', '2021-02-18 01:24:10', '2021-02-23 06:10:00'),
(18, 1921681011, 2, 'Read', '2021-02-22 04:40:27', '2021-02-23 06:22:10'),
(20, 1921681016, 1, 'Deleted', '2021-03-06 15:40:23', '2021-03-06 15:42:13'),
(24, 1921681011, 4, 'Unread', '2021-03-19 10:36:00', NULL),
(25, 1921681087, 2, 'Unread', '2021-03-22 02:45:00', NULL);

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
(4, 'Your monthly subscription has already ended. Please pay within 15 days to continue your gym and member account access.'),
(5, 'Your annual membership has already ended. Please pay immediately to continue your membership in the gym.'),
(6, 'Your annual membership will expire in 1 month. Please pay before expiry date to continue your membership in the gym.'),
(7, 'Your annual membership will expire in 7 days. Please pay before expiry date to continue your membership in the gym.'),
(8, 'Your annual membership fee and monthly subscription is long due. Failure to renew your membership and pay monthly subscription for the next 7 days will make your account inactive, losing access to your profile. Please settle your dues.');

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
(10, 1921681011, 'John', 'Doe', 'Regular', 'Annual Membership', 'Cash', '2021-02-16', '07:25 PM', '200', NULL, NULL, NULL),
(11, 1921681012, 'George', 'Duterte', 'Regular', 'Monthly Subscription', 'Cash', '2021-02-16', '07:26 PM', '750', 'N/A', NULL, NULL),
(12, 1921681012, 'George', 'Duterte', 'Regular', 'Annual Membership', 'Cash', '2021-02-16', '07:26 PM', '200', NULL, NULL, NULL),
(38, 1921681024, 'Clint', 'Lapera', 'Regular', 'Monthly Subscription', 'Cash', '2021-02-18', '09:46 PM', '750', 'N/A', NULL, NULL),
(39, 1921681024, 'Clint', 'Lapera', 'Regular', 'Annual Membership', 'Cash', '2021-02-18', '09:46 PM', '200', NULL, NULL, NULL),
(40, 1921681022, 'Weinnand', 'Hasanion', 'Regular', 'Monthly Subscription', 'Cash', '2021-02-18', '09:52 PM', '700', 'January-February Promo', NULL, NULL),
(41, 1921681022, 'Weinnand', 'Hasanion', 'Regular', 'Annual Membership', 'Cash', '2021-02-18', '09:52 PM', '200', NULL, NULL, NULL),
(42, 1921681023, 'Ivanne', 'Candano', 'Regular', 'Monthly Subscription', 'Cash', '2021-02-18', '10:36 PM', '750', 'N/A', NULL, NULL),
(43, 1921681023, 'Ivanne', 'Candano', 'Regular', 'Annual Membership', 'Cash', '2021-02-18', '10:36 PM', '200', NULL, NULL, NULL),
(44, 1921681021, 'Francis', 'Vasquez', 'Regular', 'Monthly Subscription', 'Cash', '2021-02-22', '08:45 AM', '750', 'N/A', NULL, NULL),
(45, 1921681021, 'Francis', 'Vasquez', 'Regular', 'Annual Membership', 'Cash', '2021-02-22', '08:45 AM', '200', NULL, NULL, NULL),
(46, 1921681021, 'Francis', 'Vasquez', 'Regular', 'Monthly Subscription', 'Cash', '2021-02-22', '08:45 AM', '750', 'N/A', NULL, NULL),
(47, 1921681091, 'Josiah', 'Luna', 'Regular', 'Monthly Subscription', 'Cash', '2021-02-23', '02:55 PM', '750', 'N/A', NULL, NULL),
(48, 1921681091, 'Josiah', 'Luna', 'Regular', 'Annual Membership', 'Cash', '2021-02-23', '02:55 PM', '200', NULL, NULL, NULL),
(49, 1921681087, 'Elton', 'Lyons', 'Regular', 'Monthly Subscription', 'Cash', '2021-02-23', '02:55 PM', '750', 'N/A', NULL, NULL),
(50, 1921681087, 'Elton', 'Lyons', 'Regular', 'Annual Membership', 'Cash', '2021-02-23', '02:55 PM', '200', NULL, NULL, NULL),
(51, 1921681043, 'Clarke', 'Jacobson', 'Regular', 'Monthly Subscription', 'Cash', '2021-02-23', '02:56 PM', '700', 'January-February Promo', NULL, NULL),
(52, 1921681043, 'Clarke', 'Jacobson', 'Regular', 'Annual Membership', 'Cash', '2021-02-23', '02:56 PM', '200', NULL, NULL, NULL),
(53, 1921681032, 'Rigel', 'Wilson', 'Walk-in', 'Walk-in', 'Cash', '2021-03-05', '04:11 AM', '50', NULL, NULL, NULL),
(54, 1921681088, 'Burke', 'Good', 'Walk-in', 'Walk-in', 'Cash', '2021-03-05', '04:11 AM', '50', NULL, NULL, NULL),
(55, 1921681025, 'Dante', 'Phillips', 'Walk-in', 'Walk-in', 'Cash', '2021-03-05', '04:11 AM', '50', NULL, NULL, NULL),
(56, 1921681014, 'John Jay', 'Desierto', 'Regular', 'Monthly Subscription', 'Cash', '2021-03-05', '04:12 AM', '650', 'Student Discount', NULL, NULL),
(57, 1921681014, 'John Jay', 'Desierto', 'Regular', 'Annual Membership', 'Cash', '2021-03-05', '04:12 AM', '200', NULL, NULL, NULL),
(58, 1921681016, 'Michael', 'Antiporta', NULL, 'Monthly Subscription', 'Online', '2021-03-06', '11:06 PM', '750', NULL, '6K2378805T6522126', NULL),
(59, 1921681016, 'Michael', 'Antiporta', NULL, 'Annual Membership', 'Online', '2021-03-06', '11:06 PM', '200', NULL, '6K2378805T6522126', NULL),
(60, 1921681032, 'Rigel', 'Wilson', 'Walk-in', 'Walk-in', 'Cash', '2021-03-16', '06:40 PM', '50', NULL, NULL, NULL),
(61, 1921681013, 'Christian James', 'Gulapa', 'Regular', 'Annual Membership', 'Cash', '2021-03-18', '12:45 AM', '100', NULL, NULL, NULL),
(62, 1921681054, 'Jeremy', 'Frye', 'Walk-in', 'Walk-in', 'Cash', '2021-03-18', '12:46 AM', '50', NULL, NULL, NULL),
(63, 1921681013, 'Christian James', 'Gulapa', 'Regular', 'Monthly Subscription', 'Cash', '2021-03-18', '12:46 AM', '650', 'Senior Discount', NULL, NULL),
(67, 1921681011, 'John', 'Doe', 'Regular', 'Monthly Subscription', 'Online', '2021-03-19', '07:24 PM', '650', 'Senior Discount', '2M657311FH662914C', NULL),
(68, 1921681024, 'Clint', 'Lapera', 'Regular', 'Monthly Subscription', 'Online', '2021-03-22', '11:34 AM', '675', 'Back-to-school Promo', '136225401D330332B', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `program`
--

CREATE TABLE `program` (
  `program_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `trainer_id` int(11) NOT NULL,
  `program_name` varchar(50) NOT NULL,
  `program_description` text NOT NULL,
  `program_status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `date_added` date DEFAULT NULL,
  `time_added` time NOT NULL,
  `date_deleted` date DEFAULT NULL,
  `time_deleted` time NOT NULL,
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

INSERT INTO `program` (`program_id`, `admin_id`, `trainer_id`, `program_name`, `program_description`, `program_status`, `date_added`, `time_added`, `date_deleted`, `time_deleted`, `upper_1_day_1`, `upper_2_day_1`, `upper_3_day_1`, `upper_1_day_2`, `upper_2_day_2`, `upper_3_day_2`, `upper_1_day_3`, `upper_2_day_3`, `upper_3_day_3`, `lower_1_day_1`, `lower_2_day_1`, `lower_3_day_1`, `lower_1_day_2`, `lower_2_day_2`, `lower_3_day_2`, `lower_1_day_3`, `lower_2_day_3`, `lower_3_day_3`, `abdominal_day_1`, `abdominal_day_2`, `abdominal_day_3`) VALUES
(1, 87001, 1512, 'Gaining', 'This is a program for members who aim to gain weight and mass.', 'active', '2021-02-09', '19:30:00', NULL, '00:00:00', 1, 2, 3, 4, 5, 6, 7, 8, 2, 9, 10, 11, 12, 13, 14, 15, 9, 11, 16, 19, 20),
(2, 87001, 1514, 'Reducing', 'AD', 'active', '2021-02-15', '12:14:00', NULL, '00:00:00', 1, 2, 3, 4, 5, 6, 7, 8, 1, 9, 10, 11, 12, 13, 14, 15, 9, 10, 21, 20, 18),
(3, 87001, 1514, 'asfsafsaf', 'sdfsadhfsadfhsladkfhsadflkashflsakhflaskhfadslfhsalkdfh', 'inactive', '2021-03-16', '06:04:00', '2021-03-18', '12:04:00', 1, 1, 1, 1, 1, 1, 1, 1, 1, 9, 9, 9, 9, 9, 9, 9, 9, 9, 16, 16, 16);

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
(202100, 'Christmas Promo', 'Seasonal', 'Monthly subscription is P75 off for the whole month of December.', '2021-01-27', '2021-12-01', '2021-12-31', 75, 'Active', '2021-03-18'),
(202101, 'Student Discount', 'Permanent', 'Monthly subscription is P100 off for students. Please show valid school ID to the counter to avail.', '2021-01-27', '1970-01-01', '1970-01-01', 50, 'Active', NULL),
(202111, 'January-February Promo', 'Seasonal', 'P50 off for the whole month of January.', '2021-01-28', '2021-01-01', '2021-02-28', 50, 'Expired', '2021-02-03'),
(202112, 'Senior Discount', 'Permanent', 'Monthly subscription is P100 off for ages 40 and above. Please present valid Senior Citizen ID to avail promo.', '2021-01-28', '1970-01-01', '1970-01-01', 50, 'Active', '2021-01-27'),
(202113, 'Back-to-school Promo', 'Seasonal', 'P75 discount to all who avail our back-to-school promo. This promo is only available starting March 1, 2021 until March 31, 2021.', '2021-02-23', '2021-03-01', '2021-03-31', 75, 'Active', NULL);

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
  `trainer_status` enum('active','inactive','deleted') NOT NULL,
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
  `time_deleted` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `trainer`
--

INSERT INTO `trainer` (`trainer_id`, `trainer_status`, `trainer_position`, `first_name`, `last_name`, `address`, `gender`, `phone`, `email`, `file`, `birthdate`, `date_hired`, `date_deleted`, `time_deleted`) VALUES
(1512, 'active', 'junior', 'George', 'Vasquez', '2nd floor G7 Suites', 'M', '09453216542', 'leeapple619@gmail.com', NULL, '1985-01-01', '2021-02-23', NULL, NULL),
(1513, 'active', 'junior', 'Greg', 'Ivor', 'Cebu City', 'M', '09994562154', 'greg@gmail.com', NULL, '1990-02-16', '2021-02-23', NULL, NULL),
(1514, 'deleted', 'junior', 'Reyland', 'Nazareth', 'Lapulapu City', 'M', '09164543211', 'reylandbogo@gmail.com', NULL, '1977-09-23', '2021-02-23', '2021-03-15', '16:32:31');

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
  ADD KEY `logtrail_doing_5` (`inventory_id`),
  ADD KEY `logtrail_doing_6` (`promo_id`),
  ADD KEY `logtrail_doing_ibfk_7` (`program_id`);

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
  ADD KEY `admin_id` (`admin_id`),
  ADD KEY `trainer_id` (`trainer_id`);

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
  MODIFY `admin_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87003;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `inventory_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2024;

--
-- AUTO_INCREMENT for table `logtrail`
--
ALTER TABLE `logtrail`
  MODIFY `login_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `logtrail_doing`
--
ALTER TABLE `logtrail_doing`
  MODIFY `logtrail_doing_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `member_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1921681093;

--
-- AUTO_INCREMENT for table `memberpromos`
--
ALTER TABLE `memberpromos`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `member_notifs`
--
ALTER TABLE `member_notifs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notif_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `paymentlog`
--
ALTER TABLE `paymentlog`
  MODIFY `payment_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `program`
--
ALTER TABLE `program`
  MODIFY `program_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `promo`
--
ALTER TABLE `promo`
  MODIFY `promo_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=202114;

--
-- AUTO_INCREMENT for table `routines`
--
ALTER TABLE `routines`
  MODIFY `routine_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `trainer`
--
ALTER TABLE `trainer`
  MODIFY `trainer_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1515;

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
  ADD CONSTRAINT `logtrail_doing_ibfk_5` FOREIGN KEY (`inventory_id`) REFERENCES `inventory` (`inventory_id`),
  ADD CONSTRAINT `logtrail_doing_ibfk_6` FOREIGN KEY (`promo_id`) REFERENCES `promo` (`promo_id`),
  ADD CONSTRAINT `logtrail_doing_ibfk_7` FOREIGN KEY (`program_id`) REFERENCES `program` (`program_id`);

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
