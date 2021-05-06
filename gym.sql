-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2021 at 04:16 PM
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

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(100) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `code` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `password`, `first_name`, `last_name`, `code`) VALUES
(87000, 'klintjohn60@gmail.com', '$2y$10$I5JX347ujLO4i566c8qFeOIyTRy0eSdmkY.rs8Jz40.TH/.7xYeEG', 'klintjohn', 'cagot', 84522),
(87001, 'weinnandhasanion@gmail.com', '$2y$10$sy5uIhi2sPX730cGyS4R4.6NaTuI4OQgzHyeoVtSqLzudczCtDWR2', 'Weinnand', 'Hasanion', 21755),
(87008, 'mizstereo@gmail.com', '$2y$10$6u3ql0yj5PuffYN9WffvSuQ3.CihCzWFEuZP0iH3ShIAbEf9Y8OW.', 'Miz', 'Stereo', 20289),
(87012, 'alvinarnibal@gmail.com', '$2y$10$EU5XXNZIhbU87joNEKgAYeVNYGlrkcUdr.HBW7lAZ86XdQ8dLcoXC', 'Alvin', 'Arnibal', 82424);

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `inventory_id` int(100) NOT NULL,
  `inventory_name` varchar(100) DEFAULT NULL,
  `inventory_category` enum('Cardio','Free Weights','Calisthenics','Strength','Supplies') DEFAULT NULL,
  `inventory_qty` int(255) DEFAULT NULL,
  `inventory_damage` int(255) DEFAULT NULL,
  `inventory_working` int(255) DEFAULT NULL,
  `inventory_description` varchar(255) DEFAULT NULL,
  `inventory_status` enum('notdeleted','deleted') NOT NULL,
  `date_deleted` date DEFAULT NULL,
  `time_deleted` time DEFAULT NULL,
  `admin_delete` varchar(50) DEFAULT NULL,
  `date_added` date DEFAULT NULL,
  `image_pathname` varchar(9999) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`inventory_id`, `inventory_name`, `inventory_category`, `inventory_qty`, `inventory_damage`, `inventory_working`, `inventory_description`, `inventory_status`, `date_deleted`, `time_deleted`, `admin_delete`, `date_added`, `image_pathname`) VALUES
(2010, '5 lbs dumbbell', 'Free Weights', 10, 2, NULL, '5 pound dumbbells.', 'notdeleted', NULL, NULL, NULL, '2021-03-20', '5lbdumbell.jpg'),
(2012, 'Treadmill', 'Cardio', 3, 1, NULL, 'Nordic TrackSeries T', 'notdeleted', NULL, NULL, NULL, '2021-03-06', '710XQC8XqpL._AC_SL1500_.jpg'),
(2013, 'charot', '', 5, 1, NULL, 'hi cagot', 'deleted', '2021-05-06', '05:20:47', 'Alvin Arnibal', '2021-03-06', 'localhost_capstoneMobile_pages_pay.php(iPhone X).png'),
(2014, 'Rowing machine', 'Calisthenics', 3, 0, NULL, 'Concept2 Model D Indoor Rowing Machine with PM5', 'notdeleted', NULL, NULL, NULL, '2021-03-20', 'rowing machine.jpg'),
(2015, 'Exercise stationary bike', 'Cardio', 4, 0, NULL, 'Exercise stationary bikes good for cardio exercise.', 'notdeleted', NULL, NULL, NULL, '2021-03-20', 'exercise bike.png'),
(2016, '10 lbs dumbbell', 'Free Weights', 10, 0, NULL, '10 pound dumbbells.', 'notdeleted', NULL, NULL, NULL, '2021-03-20', '10dumbbell.png'),
(2017, '15 lbs weight disc', 'Free Weights', 8, NULL, NULL, '15 pound weight discs for adjustable barbells.', 'notdeleted', NULL, NULL, NULL, '2021-03-20', '15 plate.jpg'),
(2018, '15 lbs dumbbell', 'Free Weights', 12, NULL, NULL, '15 pound dumbbells.', 'notdeleted', NULL, NULL, NULL, '2021-03-20', '15dumbbell.jpg'),
(2019, '20 lbs dumbbell', 'Free Weights', 8, NULL, NULL, '20 pound dumbbells.', 'notdeleted', NULL, NULL, NULL, '2021-03-20', '20dumbbell.jpg'),
(2020, '25 lbs dumbbell', 'Free Weights', 12, NULL, NULL, '25 pound dumbbells.', 'notdeleted', NULL, NULL, NULL, '2021-03-20', '25dumbbell.jpg'),
(2021, 'Barbell bar', 'Strength', 6, NULL, NULL, 'Adjustable barbell bars.', 'notdeleted', NULL, NULL, NULL, '2021-03-20', 'barbell bar.jpg'),
(2022, '5 lbs weight disc', 'Free Weights', 6, NULL, NULL, '5 pound weight discs for adjustable barbells.', 'notdeleted', NULL, NULL, NULL, '2021-03-20', '5 plate.jpg'),
(2023, '10 lbs weight disc', 'Free Weights', 10, NULL, NULL, '10 pound weight discs for adjustable barbells.', 'notdeleted', NULL, NULL, NULL, '2021-03-20', '10plate.jpg'),
(2024, 'Pull up Machine', 'Calisthenics', 1, 0, NULL, 'Pull-up machine for calisthenics.', 'notdeleted', NULL, NULL, NULL, '2021-05-06', 'pull up.jpg');

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
(1, 87001, 'Weinnand', 'Hasanion', '2021-03-18 00:10:20', NULL),
(2, 87001, 'Weinnand', 'Hasanion', '2021-03-18 04:30:51', '2021-03-18 04:31:25'),
(3, 87001, 'Weinnand', 'Hasanion', '2021-03-18 04:31:32', NULL),
(4, 87001, 'Weinnand', 'Hasanion', '2021-03-18 11:44:15', '2021-03-18 18:28:44'),
(5, 87002, 'baba', 'yaga', '2021-03-18 18:28:54', '2021-03-18 18:57:09'),
(6, 87001, 'Weinnand', 'Hasanion', '2021-03-18 18:57:57', '2021-03-18 19:00:04'),
(7, 87002, 'baba', 'yaga', '2021-03-18 20:57:32', NULL),
(8, 87002, 'baba', 'yaga', '2021-03-19 02:10:53', NULL),
(9, 87002, 'baba', 'yaga', '2021-03-19 18:21:50', NULL),
(10, 87001, 'Weinnand', 'Hasanion', '2021-03-20 11:14:38', NULL),
(11, 87001, 'Weinnand', 'Hasanion', '2021-03-21 19:21:41', NULL),
(12, 87001, 'Weinnand', 'Hasanion', '2021-03-22 10:25:08', NULL),
(13, 87001, 'Weinnand', 'Hasanion', '2021-03-25 12:18:12', NULL),
(14, 87001, 'Weinnand', 'Hasanion', '2021-03-29 10:20:06', NULL),
(15, 87001, 'Weinnand', 'Hasanion', '2021-03-29 16:45:18', NULL),
(16, 87001, 'Weinnand', 'Hasanion', '2021-03-31 13:34:03', NULL),
(17, 87001, 'Weinnand', 'Hasanion', '2021-04-02 14:21:53', NULL),
(18, 87001, 'Weinnand', 'Hasanion', '2021-04-09 12:03:37', NULL),
(19, 87001, 'Weinnand', 'Hasanion', '2021-04-12 11:10:22', '2021-04-12 14:26:38'),
(20, 87001, 'Weinnand', 'Hasanion', '2021-04-12 17:24:01', NULL),
(21, 87001, 'Weinnand', 'Hasanion', '2021-04-13 20:44:17', NULL),
(22, 87001, 'Weinnand', 'Hasanion', '2021-04-15 09:23:32', NULL),
(23, 87001, 'Weinnand', 'Hasanion', '2021-04-26 14:30:25', NULL),
(24, 87001, 'Weinnand', 'Hasanion', '2021-04-26 23:30:27', NULL),
(25, 87001, 'Weinnand', 'Hasanion', '2021-04-27 00:09:56', NULL),
(26, 87001, 'Weinnand', 'Hasanion', '2021-04-27 19:44:42', NULL),
(27, 87001, 'Weinnand', 'Hasanion', '2021-04-28 22:07:23', NULL),
(28, 87001, 'Weinnand', 'Hasanion', '2021-04-30 20:41:03', '2021-04-30 21:45:06'),
(29, 87001, 'Weinnand', 'Hasanion', '2021-04-30 21:45:09', '2021-04-30 21:47:39'),
(30, 87001, 'Weinnand', 'Hasanion', '2021-04-30 22:36:45', '2021-04-30 23:20:28'),
(31, 87001, 'Weinnand', 'Hasanion', '2021-04-30 23:24:18', '2021-05-01 01:01:43'),
(32, 87001, 'Weinnand', 'Hasanion', '2021-05-01 01:06:23', '2021-05-02 01:30:09'),
(33, 87001, 'Weinnand', 'Hasanion', '2021-05-02 01:30:15', NULL),
(34, 87001, 'Weinnand', 'Hasanion', '2021-05-02 15:14:07', '2021-05-02 18:13:01'),
(35, 87001, 'Weinnand', 'Hasanion', '2021-05-02 18:13:39', '2021-05-02 18:15:00'),
(36, 87001, 'Weinnand', 'Hasanion', '2021-05-02 20:41:55', '2021-05-02 20:42:02'),
(37, 87001, 'Weinnand', 'Hasanion', '2021-05-02 20:42:18', '2021-05-02 22:19:46'),
(38, 87001, 'Weinnand', 'Hasanion', '2021-05-02 22:19:49', '2021-05-02 23:01:56'),
(39, 87001, 'Weinnand', 'Hasanion', '2021-05-02 23:22:57', '2021-05-02 23:23:07'),
(40, 87008, 'Miz', 'Stereo', '2021-05-03 01:02:31', '2021-05-03 01:02:40'),
(41, 87001, 'Weinnand', 'Hasanion', '2021-05-03 01:21:56', NULL),
(42, 87008, 'Miz', 'Stereo', '2021-05-03 16:15:51', '2021-05-03 16:15:52'),
(43, 87008, 'Miz', 'Stereo', '2021-05-03 16:18:17', '2021-05-03 16:19:00'),
(44, 87001, 'Weinnand', 'Hasanion', '2021-05-03 16:48:38', NULL),
(45, 87001, 'Weinnand', 'Hasanion', '2021-05-03 16:48:38', '2021-05-03 16:48:43'),
(46, 87001, 'Weinnand', 'Hasanion', '2021-05-03 16:49:04', '2021-05-03 16:49:19'),
(47, 87001, 'Weinnand', 'Hasanion', '2021-05-03 16:49:38', '2021-05-03 16:49:40'),
(48, 87001, 'Weinnand', 'Hasanion', '2021-05-03 16:50:52', '2021-05-03 16:50:55'),
(49, 87001, 'Weinnand', 'Hasanion', '2021-05-03 16:51:09', '2021-05-03 16:51:14'),
(50, 87001, 'Weinnand', 'Hasanion', '2021-05-03 16:52:01', '2021-05-03 16:52:24'),
(51, 87001, 'Weinnand', 'Hasanion', '2021-05-03 16:52:28', '2021-05-03 16:52:31'),
(52, 87001, 'Weinnand', 'Hasanion', '2021-05-03 16:52:42', '2021-05-03 16:52:52'),
(53, 87001, 'Weinnand', 'Hasanion', '2021-05-03 16:53:52', '2021-05-03 16:54:39'),
(54, 87001, 'Weinnand', 'Hasanion', '2021-05-03 19:38:38', NULL),
(55, 87001, 'Weinnand', 'Hasanion', '2021-05-04 11:21:45', NULL),
(56, 87001, 'Weinnand', 'Hasanion', '2021-05-05 14:04:54', NULL),
(57, 87012, 'Alvin', 'Arnibal', '2021-05-06 11:04:20', NULL);

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
(112, 15, 87001, 1921681011, NULL, NULL, NULL, NULL, 'John', 'Doe', 'Activated the account', 'Members', '04:49 PM', NULL, NULL, NULL, NULL),
(113, 15, 87001, 1921681022, NULL, NULL, NULL, NULL, 'Weinnand', 'Hasanion', 'Activated the account', 'Members', '04:56 PM', NULL, NULL, NULL, NULL),
(114, 16, 87001, NULL, NULL, NULL, NULL, 202112, 'John Doe', NULL, 'Remove a member from Senior Discount promo', 'Promos', '01:34 PM', NULL, NULL, NULL, NULL),
(115, 16, 87001, 1921681022, NULL, NULL, NULL, NULL, 'Weinnand', 'Hasanion', 'Paid Monthly Subscription', 'Members', '01:39 PM', NULL, NULL, NULL, NULL),
(116, 16, 87001, NULL, NULL, NULL, NULL, 202114, 'May Promo', NULL, 'Added new promo', 'Promos', '01:50 PM', NULL, NULL, NULL, NULL),
(117, 16, 87001, NULL, NULL, NULL, NULL, 202114, 'May Promo', NULL, 'Update a promo', 'Promos', '01:50 PM', NULL, NULL, NULL, NULL),
(118, 16, 87001, NULL, NULL, NULL, NULL, 202114, 'May Promo', NULL, 'Update a promo', 'Promos', '01:50 PM', NULL, NULL, NULL, NULL),
(119, 16, 87001, NULL, NULL, NULL, NULL, 202114, 'May Promo', NULL, 'Update a promo', 'Promos', '01:50 PM', NULL, NULL, NULL, NULL),
(120, 16, 87001, NULL, NULL, NULL, NULL, 202114, 'May Promo', NULL, 'Update a promo', 'Promos', '01:51 PM', NULL, NULL, NULL, NULL),
(121, 16, 87001, NULL, NULL, NULL, NULL, 202114, 'May Promo', NULL, 'Update a promo', 'Promos', '01:51 PM', NULL, NULL, NULL, NULL),
(122, 16, 87001, NULL, NULL, NULL, NULL, 202114, 'May Promo', NULL, 'Update a promo', 'Promos', '01:51 PM', NULL, NULL, NULL, NULL),
(123, 16, 87001, NULL, NULL, NULL, NULL, 202114, 'May Promo', NULL, 'Deleted a promo', 'Promos', '01:52 PM', NULL, NULL, NULL, NULL),
(124, 16, 87001, NULL, NULL, NULL, NULL, 202114, 'May Promo', NULL, 'Restore a promo', 'Promos', '01:56 PM', NULL, NULL, NULL, NULL),
(125, 17, 87001, NULL, NULL, NULL, NULL, 202113, 'John Doe', NULL, 'Remove a member from Back-to-school Promo promo', 'Promos', '02:22 PM', NULL, NULL, NULL, NULL),
(126, 17, 87001, NULL, NULL, NULL, NULL, 202114, 'April Promo', NULL, 'Update a promo', 'Promos', '02:25 PM', NULL, NULL, NULL, NULL),
(129, 19, 87001, NULL, 2, NULL, NULL, NULL, 'Reducing', NULL, 'Updated the program', 'Programs', '11:10 AM', NULL, NULL, NULL, NULL),
(130, 21, 87001, NULL, NULL, NULL, NULL, 202115, 'May Promo', NULL, 'Added new promo', 'Promos', '08:51 PM', NULL, NULL, NULL, NULL),
(131, 21, 87001, NULL, NULL, NULL, NULL, 202115, 'May Promo', NULL, 'Update a promo', 'Promos', '08:52 PM', NULL, NULL, NULL, NULL),
(132, 21, 87001, NULL, NULL, NULL, NULL, 202115, 'May Promo', NULL, 'Deleted a promo', 'Promos', '08:55 PM', NULL, NULL, NULL, NULL),
(133, 21, 87001, NULL, NULL, NULL, NULL, 202116, 'girl promo haha', NULL, 'Added new promo', 'Promos', '08:57 PM', NULL, NULL, NULL, NULL),
(134, 21, 87001, NULL, NULL, NULL, NULL, 202116, 'girl promo haha', NULL, 'Deleted a promo', 'Promos', '08:57 PM', NULL, NULL, NULL, NULL),
(135, 21, 87001, NULL, NULL, NULL, NULL, 202113, 'Back-to-school Promo', NULL, 'Deleted a promo', 'Promos', '09:10 PM', NULL, NULL, NULL, NULL),
(136, 23, 87001, 1921681024, NULL, NULL, NULL, NULL, 'Clint', 'Lapera', 'Activated the account', 'Members', '02:31 PM', NULL, NULL, NULL, NULL),
(137, 24, 87001, NULL, 4, NULL, NULL, NULL, 'Crossfit', NULL, 'Added a new program', 'Programs', '11:32 PM', NULL, NULL, NULL, NULL),
(138, 24, 87001, NULL, 4, NULL, NULL, NULL, 'Crossfit', NULL, 'Deleted the program', 'Programs', '11:32 PM', NULL, NULL, NULL, NULL),
(139, 24, 87001, NULL, 4, NULL, NULL, NULL, 'Crossfit', NULL, 'Recover the program', 'Programs', '11:32 PM', NULL, NULL, NULL, NULL),
(140, 24, 87001, NULL, 4, NULL, NULL, NULL, 'Crossfit', NULL, 'Deleted the program', 'Programs', '11:34 PM', NULL, NULL, NULL, NULL),
(141, 24, 87001, NULL, NULL, 1513, NULL, NULL, 'Greg', 'Ivor', 'Updated a Trainer ', 'Trainers', '11:35 PM', NULL, NULL, NULL, NULL),
(142, 24, 87001, NULL, 4, NULL, NULL, NULL, 'Crossfit', NULL, 'Recover the program', 'Programs', '11:37 PM', NULL, NULL, NULL, NULL),
(143, 24, 87001, NULL, 4, NULL, NULL, NULL, 'Crossfit', NULL, 'Deleted the program', 'Programs', '11:37 PM', NULL, NULL, NULL, NULL),
(148, 25, 87001, NULL, NULL, NULL, NULL, 202114, 'Michael Antiporta', NULL, 'Remove a member from April Promo promo', 'Promos', '12:11 AM', NULL, NULL, NULL, NULL),
(149, 25, 87001, NULL, NULL, NULL, NULL, 202114, 'John Doe', NULL, 'Remove a member from April Promo promo', 'Promos', '12:14 AM', NULL, NULL, NULL, NULL),
(150, 25, 87001, NULL, NULL, NULL, NULL, 202114, 'John Doe', NULL, 'Added a member to April Promo', 'Promos', '12:14 AM', NULL, NULL, NULL, NULL),
(151, 25, 87001, NULL, NULL, NULL, NULL, 202112, 'John Doe', NULL, 'Added a member to Senior Discount', 'Promos', '12:20 AM', NULL, NULL, NULL, NULL),
(152, 26, 87001, NULL, NULL, NULL, NULL, NULL, 'members ongoing subscription', NULL, 'Generated a report for members with  ongoing subscription', 'Reports', '07:45 PM', NULL, NULL, NULL, NULL),
(153, 26, 87001, NULL, NULL, NULL, NULL, NULL, 'members ongoing subscription', NULL, 'Generated a report for members with  ongoing subscription', 'Reports', '07:45 PM', NULL, NULL, NULL, NULL),
(154, 26, 87001, 1921681011, NULL, NULL, NULL, NULL, 'John', 'Doe', 'Paid Annual Membership', 'Members', '07:46 PM', NULL, NULL, NULL, NULL),
(155, 26, 87001, NULL, NULL, NULL, NULL, NULL, 'members ongoing subscription', NULL, 'Generated a report for members with  ongoing subscription', 'Reports', '07:46 PM', NULL, NULL, NULL, NULL),
(156, 26, 87001, NULL, NULL, NULL, NULL, NULL, 'members expired subscription', NULL, 'Generated a report for members with expired subscription', 'Reports', '07:46 PM', NULL, NULL, NULL, NULL),
(157, 26, 87001, NULL, NULL, NULL, NULL, NULL, 'members expired subscription', NULL, 'Generated a report for members with expired subscription', 'Reports', '07:46 PM', NULL, NULL, NULL, NULL),
(158, 26, 87001, NULL, NULL, NULL, NULL, NULL, 'members expired subscription', NULL, 'Generated a report for members with expired subscription', 'Reports', '07:46 PM', NULL, NULL, NULL, NULL),
(159, 26, 87001, NULL, NULL, NULL, NULL, NULL, 'members expired subscription', NULL, 'Generated a report for members with expired subscription', 'Reports', '07:47 PM', NULL, NULL, NULL, NULL),
(160, 26, 87001, NULL, NULL, NULL, NULL, NULL, 'members expired subscription', NULL, 'Generated a report for members with expired subscription', 'Reports', '07:47 PM', NULL, NULL, NULL, NULL),
(161, 26, 87001, NULL, NULL, NULL, NULL, NULL, 'members activated mobile account', NULL, 'Generated a report for members who have activated their mobile account', 'Reports', '10:14 PM', NULL, NULL, NULL, NULL),
(162, 26, 87001, 1921681013, NULL, NULL, NULL, NULL, 'Christian James', 'Gulapa', 'Activated the account', 'Members', '10:15 PM', NULL, NULL, NULL, NULL),
(163, 26, 87001, NULL, NULL, NULL, NULL, NULL, 'members activated mobile account', NULL, 'Generated a report for members who have activated their mobile account', 'Reports', '10:15 PM', NULL, NULL, NULL, NULL),
(164, 26, 87001, NULL, NULL, NULL, NULL, NULL, 'members activated mobile account', NULL, 'Generated a report for members who have activated their mobile account', 'Reports', '10:16 PM', NULL, NULL, NULL, NULL),
(165, 26, 87001, NULL, NULL, NULL, NULL, NULL, 'members activated mobile account', NULL, 'Generated a report for members who have activated their mobile account', 'Reports', '10:17 PM', NULL, NULL, NULL, NULL),
(166, 26, 87001, NULL, NULL, NULL, NULL, NULL, 'members activated mobile account', NULL, 'Generated a report for members who have activated their mobile account', 'Reports', '10:17 PM', NULL, NULL, NULL, NULL),
(167, 26, 87001, 1921681013, NULL, NULL, NULL, NULL, 'Christian James', 'Gulapa', 'Deactivated the Account', 'Members', '10:17 PM', NULL, NULL, NULL, NULL),
(168, 26, 87001, NULL, NULL, NULL, NULL, NULL, 'members activated mobile account', NULL, 'Generated a report for members who have activated their mobile account', 'Reports', '10:18 PM', NULL, NULL, NULL, NULL),
(169, 26, 87001, 1921681013, NULL, NULL, NULL, NULL, 'Christian James', 'Gulapa', 'Activated the account', 'Members', '10:18 PM', NULL, NULL, NULL, NULL),
(170, 26, 87001, NULL, NULL, NULL, NULL, NULL, 'members activated mobile account', NULL, 'Generated a report for members who have activated their mobile account', 'Reports', '10:18 PM', NULL, NULL, NULL, NULL),
(171, 26, 87001, 1921681013, NULL, NULL, NULL, NULL, 'Christian James', 'Gulapa', 'Deactivated the Account', 'Members', '10:18 PM', NULL, NULL, NULL, NULL),
(172, 26, 87001, 1921681013, NULL, NULL, NULL, NULL, 'Christian James', 'Gulapa', 'Activated the account', 'Members', '10:18 PM', NULL, NULL, NULL, NULL),
(173, 26, 87001, NULL, NULL, NULL, NULL, NULL, 'members activated mobile account', NULL, 'Generated a report for members who have activated their mobile account', 'Reports', '10:19 PM', NULL, NULL, NULL, NULL),
(174, 26, 87001, NULL, NULL, NULL, NULL, NULL, 'members availed promo', NULL, 'Generated a report for members who availed promo', 'Reports', '10:19 PM', NULL, NULL, NULL, NULL),
(175, 26, 87001, NULL, NULL, NULL, NULL, NULL, 'members availed promo', NULL, 'Generated a report for members who availed promo', 'Reports', '10:19 PM', NULL, NULL, NULL, NULL),
(176, 26, 87001, NULL, NULL, NULL, NULL, NULL, 'members availed promo', NULL, 'Generated a report for members who availed promo', 'Reports', '10:19 PM', NULL, NULL, NULL, NULL),
(177, 26, 87001, NULL, NULL, NULL, NULL, NULL, 'members availed promo', NULL, 'Generated a report for members who availed promo', 'Reports', '10:19 PM', NULL, NULL, NULL, NULL),
(178, 26, 87001, NULL, NULL, NULL, NULL, NULL, 'members availed promo', NULL, 'Generated a report for members who availed promo', 'Reports', '10:19 PM', NULL, NULL, NULL, NULL),
(179, 26, 87001, NULL, NULL, NULL, NULL, NULL, 'list of trainers', NULL, 'Generated a report for list of trainers', 'Reports', '10:19 PM', NULL, NULL, NULL, NULL),
(180, 26, 87001, NULL, NULL, NULL, NULL, NULL, 'list of trainers', NULL, 'Generated a report for list of trainers', 'Reports', '10:19 PM', NULL, NULL, NULL, NULL),
(181, 26, 87001, NULL, NULL, NULL, NULL, NULL, 'active trainers', NULL, 'Generated a report for list of active trainers', 'Reports', '10:20 PM', NULL, NULL, NULL, NULL),
(182, 26, 87001, NULL, NULL, NULL, NULL, NULL, 'active trainers', NULL, 'Generated a report for list of active trainers', 'Reports', '10:20 PM', NULL, NULL, NULL, NULL),
(183, 26, 87001, NULL, NULL, NULL, NULL, NULL, 'list of inventory', NULL, 'Generated a report for inventory list', 'Reports', '10:20 PM', NULL, NULL, NULL, NULL),
(184, 26, 87001, NULL, NULL, NULL, NULL, NULL, 'list of inventory', NULL, 'Generated a report for inventory list', 'Reports', '10:22 PM', NULL, NULL, NULL, NULL),
(185, 26, 87001, NULL, NULL, NULL, NULL, NULL, 'list of inventory', NULL, 'Generated a report for inventory list', 'Reports', '10:24 PM', NULL, NULL, NULL, NULL),
(186, 26, 87001, NULL, NULL, NULL, NULL, NULL, 'damage equipments', NULL, 'Generated a report for damage equipment', 'Reports', '10:26 PM', NULL, NULL, NULL, NULL),
(187, 26, 87001, NULL, NULL, NULL, NULL, NULL, 'damage equipments', NULL, 'Generated a report for damage equipment', 'Reports', '10:26 PM', NULL, NULL, NULL, NULL),
(188, 26, 87001, NULL, NULL, NULL, NULL, NULL, 'damage equipments', NULL, 'Generated a report for damage equipment', 'Reports', '10:27 PM', NULL, NULL, NULL, NULL),
(189, 26, 87001, NULL, NULL, NULL, NULL, NULL, 'seasonal promos', NULL, 'Generated a report for list of seasonal promos', 'Reports', '10:35 PM', NULL, NULL, NULL, NULL),
(190, 26, 87001, NULL, NULL, NULL, NULL, NULL, 'list of promos', NULL, 'Generated a report for list of promos', 'Reports', '10:35 PM', NULL, NULL, NULL, NULL),
(191, 26, 87001, NULL, NULL, NULL, NULL, NULL, 'list of promos', NULL, 'Generated a report for list of promos', 'Reports', '10:35 PM', NULL, NULL, NULL, NULL),
(192, 26, 87001, NULL, NULL, NULL, NULL, NULL, 'list of promos', NULL, 'Generated a report for list of promos', 'Reports', '10:35 PM', NULL, NULL, NULL, NULL),
(193, 26, 87001, NULL, NULL, NULL, NULL, NULL, 'list of promos', NULL, 'Generated a report for list of promos', 'Reports', '10:35 PM', NULL, NULL, NULL, NULL),
(194, 26, 87001, NULL, NULL, NULL, NULL, NULL, 'list of promos', NULL, 'Generated a report for list of promos', 'Reports', '10:36 PM', NULL, NULL, NULL, NULL),
(195, 27, 87001, NULL, NULL, NULL, NULL, 202114, 'Clint Lapera', NULL, 'Remove a member from April Promo promo', 'Promos', '10:07 PM', NULL, NULL, NULL, NULL),
(196, 27, 87001, NULL, NULL, NULL, NULL, 202114, 'Clint Lapera', NULL, 'Added a member to April Promo', 'Promos', '10:08 PM', NULL, NULL, NULL, NULL),
(197, 27, 87001, NULL, NULL, NULL, NULL, 202114, 'April Promo', NULL, 'Deleted a promo', 'Promos', '10:13 PM', NULL, NULL, NULL, NULL),
(198, 27, 87001, NULL, NULL, NULL, NULL, 202114, 'April Promo', NULL, 'Restore a promo', 'Promos', '10:13 PM', NULL, NULL, NULL, NULL),
(199, 27, 87001, 1921681030, NULL, NULL, NULL, NULL, 'Gil', 'Eaton', 'Deleted an account from regular table', 'Members', '10:16 PM', NULL, NULL, NULL, NULL),
(200, 27, 87001, 1921681030, NULL, NULL, NULL, NULL, 'Gil', 'Eaton', 'Recover an account to Regular table', 'Members', '10:17 PM', NULL, NULL, NULL, NULL),
(201, 27, 87001, 1921681030, NULL, NULL, NULL, NULL, 'Gil', 'Eaton', 'Deleted an account from regular table', 'Members', '10:17 PM', NULL, NULL, NULL, NULL),
(202, 27, 87001, 1921681030, NULL, NULL, NULL, NULL, 'Gil', 'Eaton', 'Recover an account to Regular table', 'Members', '10:17 PM', NULL, NULL, NULL, NULL),
(203, 27, 87001, 1921681030, NULL, NULL, NULL, NULL, 'Gil', 'Eaton', 'Deleted an account from regular table', 'Members', '10:50 PM', NULL, NULL, NULL, NULL),
(204, 27, 87001, 1921681026, NULL, NULL, NULL, NULL, 'Phelan', 'Blackwell', 'Paid Annual Membership', 'Members', '12:03 AM', NULL, NULL, NULL, NULL),
(205, 27, 87001, 1921681026, NULL, NULL, NULL, NULL, 'Phelan', 'Blackwell', 'Paid Annual Membership', 'Members', '12:06 AM', NULL, NULL, NULL, NULL),
(206, 27, 87001, 1921681026, NULL, NULL, NULL, NULL, 'Phelan', 'Blackwell', 'Activated the account', 'Members', '12:08 AM', NULL, NULL, NULL, NULL),
(207, 27, 87001, 1921681026, NULL, NULL, NULL, NULL, 'Phelan', 'Blackwell', 'Deactivated the Account', 'Members', '12:08 AM', NULL, NULL, NULL, NULL),
(208, 27, 87001, 1921681026, NULL, NULL, NULL, NULL, 'Phelan', 'Blackwell', 'Activated the account', 'Members', '12:08 AM', NULL, NULL, NULL, NULL),
(209, 27, 87001, 1921681026, NULL, NULL, NULL, NULL, 'Phelan', 'Blackwell', 'Deactivated the Account', 'Members', '12:09 AM', NULL, NULL, NULL, NULL),
(210, 27, 87001, 1921681026, NULL, NULL, NULL, NULL, 'Phelan', 'Blackwell', 'Activated the account', 'Members', '12:09 AM', NULL, NULL, NULL, NULL),
(211, 27, 87001, 1921681026, NULL, NULL, NULL, NULL, 'Phelan', 'Blackwell', 'Deactivated the Account', 'Members', '12:09 AM', NULL, NULL, NULL, NULL),
(212, 27, 87001, 1921681030, NULL, NULL, NULL, NULL, 'Gil', 'Eaton', 'Recover an account to Regular table', 'Members', '12:16 AM', NULL, NULL, NULL, NULL),
(213, 27, 87001, 1921681030, NULL, NULL, NULL, NULL, 'Gil', 'Eaton', 'Deleted an account from regular table', 'Members', '12:16 AM', NULL, NULL, NULL, NULL),
(214, 27, 87001, 1921681030, NULL, NULL, NULL, NULL, 'Gil', 'Eaton', 'Recover an account to Regular table', 'Members', '12:17 AM', NULL, NULL, NULL, NULL),
(215, 27, 87001, 1921681030, NULL, NULL, NULL, NULL, 'Gil', 'Eaton', 'Deleted an account from regular table', 'Members', '12:17 AM', NULL, NULL, NULL, NULL),
(216, 27, 87001, 1921681030, NULL, NULL, NULL, NULL, 'Gil', 'Eaton', 'Recover an account to Regular table', 'Members', '12:17 AM', NULL, NULL, NULL, NULL),
(217, 28, 87001, NULL, NULL, NULL, NULL, NULL, 'members ongoing subscription', NULL, 'Generated a report for members with  ongoing subscription', 'Reports', '08:49 PM', NULL, NULL, NULL, NULL),
(218, 28, 87001, NULL, NULL, NULL, NULL, NULL, 'members ongoing subscription', NULL, 'Generated a report for members with  ongoing subscription', 'Reports', '08:50 PM', NULL, NULL, NULL, NULL),
(219, 28, 87001, NULL, NULL, NULL, NULL, NULL, 'members expired subscription', NULL, 'Generated a report for members with expired subscription', 'Reports', '08:50 PM', NULL, NULL, NULL, NULL),
(220, 28, 87001, NULL, NULL, NULL, NULL, NULL, 'list of inactive members', NULL, 'Generated a report for list of inactive members', 'Reports', '08:51 PM', NULL, NULL, NULL, NULL),
(221, 28, 87001, NULL, NULL, NULL, NULL, NULL, 'list of inactive members', NULL, 'Generated a report for list of inactive members', 'Reports', '08:51 PM', NULL, NULL, NULL, NULL),
(222, 28, 87001, NULL, NULL, NULL, NULL, NULL, 'members activated mobile account', NULL, 'Generated a report for members who have activated their mobile account', 'Reports', '08:51 PM', NULL, NULL, NULL, NULL),
(223, 28, 87001, NULL, NULL, NULL, NULL, NULL, 'members availed promo', NULL, 'Generated a report for members who availed promo', 'Reports', '08:52 PM', NULL, NULL, NULL, NULL),
(224, 28, 87001, NULL, NULL, NULL, NULL, NULL, 'members availed promo', NULL, 'Generated a report for members who availed promo', 'Reports', '08:52 PM', NULL, NULL, NULL, NULL),
(225, 28, 87001, NULL, NULL, NULL, NULL, NULL, 'list of trainers', NULL, 'Generated a report for list of trainers', 'Reports', '08:52 PM', NULL, NULL, NULL, NULL),
(226, 28, 87001, NULL, NULL, NULL, NULL, NULL, 'list of trainers', NULL, 'Generated a report for list of trainers', 'Reports', '08:52 PM', NULL, NULL, NULL, NULL),
(227, 28, 87001, NULL, NULL, NULL, NULL, NULL, 'active trainers', NULL, 'Generated a report for list of active trainers', 'Reports', '08:53 PM', NULL, NULL, NULL, NULL),
(228, 28, 87001, NULL, NULL, NULL, NULL, NULL, 'inactive trainers', NULL, 'Generated a report for list of inactive trainers', 'Reports', '08:53 PM', NULL, NULL, NULL, NULL),
(229, 28, 87001, NULL, NULL, NULL, NULL, NULL, 'deleted trainers', NULL, 'Generated a report for list of deleted trainers', 'Reports', '08:53 PM', NULL, NULL, NULL, NULL),
(230, 28, 87001, NULL, NULL, NULL, NULL, NULL, 'list of inventory', NULL, 'Generated a report for inventory list', 'Reports', '08:53 PM', NULL, NULL, NULL, NULL),
(231, 28, 87001, NULL, NULL, NULL, NULL, NULL, 'working equipments', NULL, 'Generated a report for working equipment', 'Reports', '08:54 PM', NULL, NULL, NULL, NULL),
(232, 28, 87001, NULL, NULL, NULL, NULL, NULL, 'damage equipments', NULL, 'Generated a report for damage equipment', 'Reports', '08:54 PM', NULL, NULL, NULL, NULL),
(233, 28, 87001, NULL, NULL, NULL, NULL, NULL, 'list of promos', NULL, 'Generated a report for list of promos', 'Reports', '08:54 PM', NULL, NULL, NULL, NULL),
(234, 28, 87001, NULL, NULL, NULL, NULL, NULL, 'permanent promos', NULL, 'Generated a report for list of permanent promos', 'Reports', '08:54 PM', NULL, NULL, NULL, NULL),
(235, 28, 87001, NULL, NULL, NULL, NULL, NULL, 'seasonal promos', NULL, 'Generated a report for list of seasonal promos', 'Reports', '08:55 PM', NULL, NULL, NULL, NULL),
(236, 28, 87001, NULL, NULL, NULL, NULL, NULL, 'total sales', NULL, 'Generated a report for list of total sales', 'Reports', '08:55 PM', NULL, NULL, NULL, NULL),
(237, 28, 87001, NULL, NULL, NULL, NULL, NULL, 'monthly payments', NULL, 'Generated a report for list of monthly payments', 'Reports', '08:55 PM', NULL, NULL, NULL, NULL),
(238, 28, 87001, NULL, NULL, NULL, NULL, NULL, 'annual payments', NULL, 'Generated a report for list of annual payments', 'Reports', '08:56 PM', NULL, NULL, NULL, NULL),
(239, 28, 87001, NULL, NULL, NULL, NULL, NULL, 'walk-in payments', NULL, 'Generated a report for list of walk-in payments', 'Reports', '08:56 PM', NULL, NULL, NULL, NULL),
(240, 28, 87001, 1921681093, NULL, NULL, NULL, NULL, 'John', 'Lennon', 'Added a regular member ', 'Members', '08:57 PM', NULL, NULL, NULL, NULL),
(241, 28, 87001, 1921681093, NULL, NULL, NULL, NULL, 'John', 'Lennon', 'Deleted an account from regular table', 'Members', '08:59 PM', NULL, NULL, NULL, NULL),
(242, 28, 87001, NULL, 4, NULL, NULL, NULL, 'Crossfit', NULL, 'Recover the program', 'Programs', '09:06 PM', NULL, NULL, NULL, NULL),
(243, 28, 87001, NULL, NULL, NULL, NULL, 202100, 'April-May Promo', NULL, 'Update a promo', 'Promos', '09:42 PM', NULL, NULL, NULL, NULL),
(244, 28, 87001, NULL, NULL, NULL, NULL, 202100, 'March-May Promo', NULL, 'Update a promo', 'Promos', '09:43 PM', NULL, NULL, NULL, NULL),
(245, 28, 87001, NULL, NULL, NULL, NULL, 202100, 'Ivor Potts', NULL, 'Added a member to March-May Promo', 'Promos', '09:43 PM', NULL, NULL, NULL, NULL),
(246, 28, 87001, NULL, NULL, NULL, NULL, 202100, 'Steven Deleon', NULL, 'Added a member to March-May Promo', 'Promos', '09:43 PM', NULL, NULL, NULL, NULL),
(247, 28, 87001, NULL, NULL, NULL, NULL, 202100, 'Xanthus Joyce', NULL, 'Added a member to March-May Promo', 'Promos', '09:43 PM', NULL, NULL, NULL, NULL),
(248, 29, 87001, 1921681014, NULL, NULL, NULL, NULL, 'John Jay', 'Desierto', 'Paid Monthly Subscription', 'Members', '09:45 PM', NULL, NULL, NULL, NULL),
(249, 29, 87001, 1921681014, NULL, NULL, NULL, NULL, 'John Jay', 'Desierto', 'Activated the account', 'Members', '09:45 PM', NULL, NULL, NULL, NULL),
(250, 29, 87001, 1921681094, NULL, NULL, NULL, NULL, 'Ringo', 'Star', 'Added a regular member ', 'Members', '09:46 PM', NULL, NULL, NULL, NULL),
(251, 29, 87001, 1921681094, NULL, NULL, NULL, NULL, 'Ringo', 'Star', 'Paid Annual Membership', 'Members', '09:46 PM', NULL, NULL, NULL, NULL),
(252, 29, 87001, NULL, NULL, NULL, NULL, 202100, 'Ringo Star', NULL, 'Added a member to March-May Promo', 'Promos', '09:47 PM', NULL, NULL, NULL, NULL),
(254, 31, 87001, NULL, 4, NULL, NULL, NULL, 'Crossfit', NULL, 'Deleted the program', 'Programs', '11:49 PM', NULL, NULL, NULL, NULL),
(257, 31, 87001, 1921681100, NULL, NULL, NULL, NULL, 'check', 'check', 'Added a regular member ', 'Members', '12:01 AM', NULL, NULL, NULL, NULL),
(258, 31, 87001, NULL, NULL, 1512, NULL, NULL, 'George', 'Vasquez', 'Deleted a trainer', 'Trainers', '12:25 AM', NULL, NULL, NULL, NULL),
(259, 31, 87001, NULL, NULL, 1513, NULL, NULL, 'Greg', 'Ivor', 'Deleted a trainer', 'Trainers', '12:25 AM', NULL, NULL, NULL, NULL),
(260, 31, 87001, NULL, NULL, 1513, NULL, NULL, 'Greg', 'Ivor', 'Recovered a trainer', 'Trainers', '12:25 AM', NULL, NULL, NULL, NULL),
(261, 31, 87001, NULL, NULL, 1512, NULL, NULL, 'George', 'Vasquez', 'Recovered a trainer', 'Trainers', '12:26 AM', NULL, NULL, NULL, NULL),
(262, 31, 87001, NULL, NULL, 1514, NULL, NULL, 'Reyland', 'Nazareth', 'Recovered a trainer', 'Trainers', '12:26 AM', NULL, NULL, NULL, NULL),
(263, 31, 87001, NULL, NULL, 1514, NULL, NULL, 'Reyland', 'Nazareth', 'Deleted a trainer', 'Trainers', '12:26 AM', NULL, NULL, NULL, NULL),
(264, 31, 87001, NULL, NULL, 1513, NULL, NULL, 'Greg', 'Ivor', 'Deleted a trainer', 'Trainers', '12:28 AM', NULL, NULL, NULL, NULL),
(265, 31, 87001, NULL, NULL, 1512, NULL, NULL, 'George', 'Vasquez', 'Deleted a trainer', 'Trainers', '12:29 AM', NULL, NULL, NULL, NULL),
(266, 31, 87001, NULL, NULL, 1512, NULL, NULL, 'George', 'Vasquez', 'Recovered a trainer', 'Trainers', '12:29 AM', NULL, NULL, NULL, NULL),
(267, 31, 87001, NULL, NULL, 1513, NULL, NULL, 'Greg', 'Ivor', 'Recovered a trainer', 'Trainers', '12:29 AM', NULL, NULL, NULL, NULL),
(268, 31, 87001, NULL, NULL, 1514, NULL, NULL, 'Reyland', 'Nazareth', 'Recovered a trainer', 'Trainers', '12:29 AM', NULL, NULL, NULL, NULL),
(269, 31, 87001, NULL, NULL, 1514, NULL, NULL, 'Reyland', 'Nazareth', 'Deleted a trainer', 'Trainers', '12:32 AM', NULL, NULL, NULL, NULL),
(270, 31, 87001, NULL, NULL, 1513, NULL, NULL, 'Greg', 'Ivor', 'Deleted a trainer', 'Trainers', '12:32 AM', NULL, NULL, NULL, NULL),
(271, 31, 87001, NULL, NULL, 1512, NULL, NULL, 'George', 'Vasquez', 'Deleted a trainer', 'Trainers', '12:34 AM', NULL, NULL, NULL, NULL),
(272, 31, 87001, NULL, NULL, 1512, NULL, NULL, 'George', 'Vasquez', 'Recovered a trainer', 'Trainers', '12:34 AM', NULL, NULL, NULL, NULL),
(273, 31, 87001, NULL, NULL, 1513, NULL, NULL, 'Greg', 'Ivor', 'Recovered a trainer', 'Trainers', '12:34 AM', NULL, NULL, NULL, NULL),
(274, 31, 87001, NULL, NULL, 1514, NULL, NULL, 'Reyland', 'Nazareth', 'Recovered a trainer', 'Trainers', '12:34 AM', NULL, NULL, NULL, NULL),
(275, 31, 87001, NULL, NULL, 1514, NULL, NULL, 'Reyland', 'Nazareth', 'Deleted a trainer', 'Trainers', '12:34 AM', NULL, NULL, NULL, NULL),
(276, 31, 87001, NULL, NULL, 1513, NULL, NULL, 'Greg', 'Ivor', 'Deleted a trainer', 'Trainers', '12:35 AM', NULL, NULL, NULL, NULL),
(277, 31, 87001, NULL, NULL, 1512, NULL, NULL, 'George', 'Vasquez', 'Deleted a trainer', 'Trainers', '12:36 AM', NULL, NULL, NULL, NULL),
(278, 31, 87001, NULL, NULL, 1512, NULL, NULL, 'George', 'Vasquez', 'Recovered a trainer', 'Trainers', '12:36 AM', NULL, NULL, NULL, NULL),
(279, 31, 87001, NULL, NULL, 1512, NULL, NULL, 'George', 'Vasquez', 'Deleted a trainer', 'Trainers', '12:39 AM', NULL, NULL, NULL, NULL),
(280, 31, 87001, NULL, NULL, 1514, NULL, NULL, 'Reyland', 'Nazareth', 'Added a trainer', 'Trainers', '12:40 AM', NULL, NULL, NULL, NULL),
(281, 31, 87001, NULL, NULL, 1512, NULL, NULL, 'George', 'Vasquez', 'Recovered a trainer', 'Trainers', '12:42 AM', NULL, NULL, NULL, NULL),
(282, 32, 87001, NULL, 4, NULL, NULL, NULL, 'Crossfit', NULL, 'Recover the program', 'Programs', '09:02 PM', NULL, NULL, NULL, NULL),
(283, 32, 87001, 1921681101, NULL, NULL, NULL, NULL, 'asdf', 'qwer', 'Added a regular member ', 'Members', '09:24 PM', NULL, NULL, NULL, NULL),
(284, 32, 87001, 1921681100, NULL, NULL, NULL, NULL, 'check', 'check', 'Paid both Annual Membership and Monthly Subscription', 'Members', '10:16 PM', NULL, NULL, NULL, NULL),
(285, 32, 87001, 1921681102, NULL, NULL, NULL, NULL, 'george', 'harrison', 'Added a walk-in member ', 'Members', '10:34 PM', NULL, NULL, NULL, NULL),
(286, 32, 87001, 1921681094, NULL, NULL, NULL, NULL, 'Ringo', 'Star', 'Paid Monthly Subscription', 'Members', '11:13 PM', NULL, NULL, NULL, NULL),
(287, 32, 87001, 1921681094, NULL, NULL, NULL, NULL, 'Ringo', 'Star', 'Paid Monthly Subscription', 'Members', '11:17 PM', NULL, NULL, NULL, NULL),
(288, 33, 87001, 1921681101, NULL, NULL, NULL, NULL, 'asdf', 'qwer', 'Paid both Annual Membership and Monthly Subscription', 'Members', '01:31 AM', NULL, NULL, NULL, NULL),
(289, 33, 87001, 1921681091, NULL, NULL, NULL, NULL, 'Josiah', 'Luna', 'Paid both Annual Membership and Monthly Subscription', 'Members', '01:32 AM', NULL, NULL, NULL, NULL),
(290, 33, 87001, 1921681085, NULL, NULL, NULL, NULL, 'Ciaran', 'Kinney', 'Paid both Annual Membership and Monthly Subscription', 'Members', '01:32 AM', NULL, NULL, NULL, NULL),
(291, 33, 87001, 1921681087, NULL, NULL, NULL, NULL, 'Elton', 'Lyons', 'Paid Monthly Subscription', 'Members', '01:33 AM', NULL, NULL, NULL, NULL),
(292, 33, 87001, 1921681084, NULL, NULL, NULL, NULL, 'Hamilton', 'Bernard', 'Paid Annual Membership', 'Members', '01:33 AM', NULL, NULL, NULL, NULL),
(293, 33, 87001, 1921681084, NULL, NULL, NULL, NULL, 'Hamilton', 'Bernard', 'Paid Monthly Subscription', 'Members', '01:33 AM', NULL, NULL, NULL, NULL),
(294, 33, 87001, 1921681082, NULL, NULL, NULL, NULL, 'Jared', 'Mullins', 'Paid both Annual Membership and Monthly Subscription', 'Members', '01:33 AM', NULL, NULL, NULL, NULL),
(295, 33, 87001, 1921681079, NULL, NULL, NULL, NULL, 'Finn', 'Patterson', 'Paid both Annual Membership and Monthly Subscription', 'Members', '01:33 AM', NULL, NULL, NULL, NULL),
(296, 33, 87001, 1921681078, NULL, NULL, NULL, NULL, 'Sebastian', 'Farley', 'Paid both Annual Membership and Monthly Subscription', 'Members', '01:33 AM', NULL, NULL, NULL, NULL),
(297, 33, 87001, NULL, NULL, NULL, NULL, NULL, 'members ongoing subscription', NULL, 'Generated a report for members with  ongoing subscription', 'Reports', '01:34 AM', NULL, NULL, NULL, NULL),
(298, 33, 87001, 1921681022, NULL, NULL, NULL, NULL, 'Weinnand', 'Hasanion', 'Paid Monthly Subscription', 'Members', '01:34 AM', NULL, NULL, NULL, NULL),
(299, 34, 87001, 1921681103, NULL, NULL, NULL, NULL, 'Paul', 'McCartney', 'Added a regular member ', 'Members', '03:16 PM', NULL, NULL, NULL, NULL),
(301, 34, 87001, 1921681104, NULL, NULL, NULL, NULL, 'Kenan', 'Hasanion', 'Added a regular member ', 'Members', '03:40 PM', NULL, NULL, NULL, NULL),
(302, 34, 87001, 1921681104, NULL, NULL, NULL, NULL, 'Kenan', 'Hasanion', 'Paid both Annual Membership and Monthly Subscription', 'Members', '03:41 PM', NULL, NULL, NULL, NULL),
(303, 34, 87001, 1921681104, NULL, NULL, NULL, NULL, 'Kenan', 'Hasanion', 'Paid both Annual Membership and Monthly Subscription', 'Members', '03:49 PM', NULL, NULL, NULL, NULL),
(304, 34, 87001, 1921681103, NULL, NULL, NULL, NULL, 'Paul', 'McCartney', 'Paid both Annual Membership and Monthly Subscription', 'Members', '03:53 PM', NULL, NULL, NULL, NULL),
(305, 35, 87001, 1921681103, NULL, NULL, NULL, NULL, 'Paul', 'McCartney', 'Paid both Annual Membership and Monthly Subscription', 'Members', '06:13 PM', NULL, NULL, NULL, NULL),
(306, 35, 87001, 1921681103, NULL, NULL, NULL, NULL, 'Paul', 'McCartney', 'Activated the account', 'Members', '06:13 PM', NULL, NULL, NULL, NULL),
(307, 35, 87001, 1921681103, NULL, NULL, NULL, NULL, 'Paul', 'McCartney', 'Activated the account', 'Members', '06:13 PM', NULL, NULL, NULL, NULL),
(308, 41, 87001, NULL, NULL, NULL, NULL, NULL, 'list of trainers', NULL, 'Generated a report for list of trainers', 'Reports', '01:22 AM', NULL, NULL, NULL, NULL),
(309, 54, 87001, NULL, NULL, NULL, NULL, 202112, 'Senior Discount', NULL, 'Update a promo', 'Promos', '07:42 PM', NULL, NULL, NULL, NULL),
(310, 54, 87001, NULL, NULL, NULL, NULL, 202101, 'Student Discount', NULL, 'Update a promo', 'Promos', '07:42 PM', NULL, NULL, NULL, NULL),
(311, 54, 87001, NULL, NULL, NULL, NULL, 202101, 'Weinnand Hasanion', NULL, 'Added a member to Student Discount', 'Promos', '09:40 PM', NULL, NULL, NULL, NULL),
(312, 54, 87001, NULL, NULL, NULL, NULL, 202117, 'Front-liner Discount', NULL, 'Added new promo', 'Promos', '11:20 PM', NULL, NULL, NULL, NULL),
(313, 55, 87001, 1921681022, NULL, NULL, NULL, NULL, 'Weinnand', 'Hasanion', 'Paid Monthly Subscription', 'Members', '11:22 AM', NULL, NULL, NULL, NULL),
(314, 55, 87001, NULL, NULL, NULL, NULL, 202117, 'Paul McCartney', NULL, 'Added a member to Front-liner Discount', 'Promos', '11:23 AM', NULL, NULL, NULL, NULL),
(315, 55, 87001, NULL, NULL, NULL, NULL, 202117, 'George Duterte', NULL, 'Added a member to Front-liner Discount', 'Promos', '11:24 AM', NULL, NULL, NULL, NULL),
(316, 55, 87001, 1921681012, NULL, NULL, NULL, NULL, 'George', 'Duterte', 'Paid both Annual Membership and Monthly Subscription', 'Members', '11:24 AM', NULL, NULL, NULL, NULL),
(317, 55, 87001, 1921681101, NULL, NULL, NULL, NULL, 'asdf', 'qwer', 'Deleted an account from regular table', 'Members', '11:25 AM', NULL, NULL, NULL, NULL),
(318, 55, 87001, 1921681101, NULL, NULL, NULL, NULL, 'asdf', 'qwer', 'Deleted an account from regular table', 'Members', '11:25 AM', NULL, NULL, NULL, NULL),
(319, 55, 87001, 1921681101, NULL, NULL, NULL, NULL, 'asdf', 'qwer', 'Deleted an account from regular table', 'Members', '11:25 AM', NULL, NULL, NULL, NULL),
(320, 55, 87001, 1921681101, NULL, NULL, NULL, NULL, 'asdf', 'qwer', 'Deleted an account from regular table', 'Members', '11:26 AM', NULL, NULL, NULL, NULL),
(321, 55, 87001, 1921681100, NULL, NULL, NULL, NULL, 'check', 'check', 'Deleted an account from regular table', 'Members', '11:27 AM', NULL, NULL, NULL, NULL),
(322, 55, 87001, 1921681093, NULL, NULL, NULL, NULL, 'John', 'Lennon', 'Recover an account to Regular table', 'Members', '11:27 AM', NULL, NULL, NULL, NULL),
(323, 55, 87001, 1921681025, NULL, NULL, NULL, NULL, 'Dante', 'Phillips', 'Recover an account to Walk-in table', 'Members', '11:27 AM', NULL, NULL, NULL, NULL),
(324, 55, 87001, 1921681043, NULL, NULL, NULL, NULL, 'Clarke', 'Jacobson', 'Recover an account to Regular table', 'Members', '11:27 AM', NULL, NULL, NULL, NULL),
(325, 55, 87001, 1921681032, NULL, NULL, NULL, NULL, 'Rigel', 'Wilson', 'Recover an account to Walk-in table', 'Members', '11:27 AM', NULL, NULL, NULL, NULL),
(326, 55, 87001, 1921681093, NULL, NULL, NULL, NULL, 'John', 'Lennon', 'Deleted an account from regular table', 'Members', '11:27 AM', NULL, NULL, NULL, NULL),
(327, 55, 87001, 1921681090, NULL, NULL, NULL, NULL, 'Honorato', 'Barr', 'Deleted an account from walk-in table', 'Members', '11:28 AM', NULL, NULL, NULL, NULL),
(328, 55, 87001, NULL, NULL, NULL, NULL, 202117, 'Paul McCartney', NULL, 'Remove a member from Front-liner Discount promo', 'Promos', '11:29 AM', NULL, NULL, NULL, NULL);
INSERT INTO `logtrail_doing` (`logtrail_doing_id`, `login_id`, `admin_id`, `member_id`, `program_id`, `trainer_id`, `inventory_id`, `promo_id`, `user_fname`, `user_lname`, `description`, `identity`, `time`, `trainer_status`, `trainer_phone`, `trainer_position`, `trainer_address`) VALUES
(329, 55, 87001, NULL, NULL, NULL, NULL, 202100, 'March-May Promo', NULL, 'Update a promo', 'Promos', '11:30 AM', NULL, NULL, NULL, NULL),
(330, 55, 87001, NULL, NULL, NULL, NULL, 202117, 'Frontliner Discount', NULL, 'Update a promo', 'Promos', '11:38 AM', NULL, NULL, NULL, NULL),
(331, 55, 87001, NULL, NULL, NULL, NULL, 202101, 'Weinnand Hasanion', NULL, 'Remove a member from Student Discount promo', 'Promos', '12:37 PM', NULL, NULL, NULL, NULL),
(332, 55, 87001, NULL, NULL, NULL, NULL, 202101, 'John Doe', NULL, 'Remove a member from Student Discount promo', 'Promos', '12:39 PM', NULL, NULL, NULL, NULL),
(333, 55, 87001, 1921681016, NULL, NULL, NULL, NULL, 'Michael', 'Antiporta', 'Activated the account', 'Members', '01:31 PM', NULL, NULL, NULL, NULL),
(334, 56, 87001, 1921681048, NULL, NULL, NULL, NULL, 'Wang', 'Bradshaw', 'Paid both Annual Membership and Monthly Subscription', 'Members', '02:19 PM', NULL, NULL, NULL, NULL),
(335, 56, 87001, NULL, 4, NULL, NULL, NULL, 'Crossfit', NULL, 'Recover the program', 'Programs', '08:10 PM', NULL, NULL, NULL, NULL),
(336, 56, 87001, 1921681094, NULL, NULL, NULL, NULL, 'Ringo', 'Star', 'Activated the account', 'Members', '08:18 PM', NULL, NULL, NULL, NULL),
(337, 56, 87001, 1921681091, NULL, NULL, NULL, NULL, 'Josiah', 'Luna', 'Activated the account', 'Members', '08:19 PM', NULL, NULL, NULL, NULL),
(338, 56, 87001, 1921681082, NULL, NULL, NULL, NULL, 'Jared', 'Mullins', 'Activated the account', 'Members', '08:22 PM', NULL, NULL, NULL, NULL),
(339, 56, 87001, 1921681105, NULL, NULL, NULL, NULL, 'Chrisly', 'Caliso', 'Added a regular member ', 'Members', '08:48 PM', NULL, NULL, NULL, NULL),
(340, 56, 87001, 1921681105, NULL, NULL, NULL, NULL, 'Chrisly', 'Caliso', 'Paid Annual Membership', 'Members', '08:48 PM', NULL, NULL, NULL, NULL),
(341, 56, 87001, 1921681105, NULL, NULL, NULL, NULL, 'Chrisly', 'Caliso', 'Activated the account', 'Members', '08:48 PM', NULL, NULL, NULL, NULL),
(342, 56, 87001, 1921681103, NULL, NULL, NULL, NULL, 'Paul', 'McCartney', 'Updated a member', 'Members', '09:20 PM', NULL, NULL, NULL, NULL),
(343, 56, 87001, 1921681103, NULL, NULL, NULL, NULL, 'Paul', 'McCartney', 'Updated a member', 'Members', '09:20 PM', NULL, NULL, NULL, NULL),
(344, 56, 87001, 1921681047, NULL, NULL, NULL, NULL, 'Graiden', 'Knight', 'Deleted an account from regular table', 'Members', '09:20 PM', NULL, NULL, NULL, NULL),
(345, 56, 87001, 1921681061, NULL, NULL, NULL, NULL, 'Ulric', 'Rollins', 'Deleted an account from walk-in table', 'Members', '09:20 PM', NULL, NULL, NULL, NULL),
(346, 56, 87001, NULL, 8, NULL, NULL, NULL, 'Weightlifting', NULL, 'Added a new program', 'Programs', '09:47 PM', NULL, NULL, NULL, NULL),
(348, 56, 87001, NULL, 4, NULL, NULL, NULL, 'Crossfit', NULL, 'Recover the program', 'Programs', '09:52 PM', NULL, NULL, NULL, NULL),
(350, 56, 87001, NULL, 4, NULL, NULL, NULL, 'Crossfit', NULL, 'Recover the program', 'Programs', '09:56 PM', NULL, NULL, NULL, NULL),
(351, 56, 87001, NULL, 4, NULL, NULL, NULL, 'Crossfit', NULL, 'Deleted the program', 'Programs', '09:56 PM', NULL, NULL, NULL, NULL),
(354, 57, 87012, 1921681105, NULL, NULL, NULL, NULL, 'Chrisly', 'Caliso', 'Updated a member', 'Members', '11:56 AM', NULL, NULL, NULL, NULL),
(355, 57, 87012, 1921681105, NULL, NULL, NULL, NULL, 'Chrisly', 'Caliso', 'Updated a member', 'Members', '11:57 AM', NULL, NULL, NULL, NULL),
(356, 57, 87012, 1921681105, NULL, NULL, NULL, NULL, 'Chrisly', 'Caliso', 'Updated a member', 'Members', '11:58 AM', NULL, NULL, NULL, NULL),
(357, 57, 87012, 1921681105, NULL, NULL, NULL, NULL, 'Chrisly', 'Caliso', 'Updated a member', 'Members', '11:58 AM', NULL, NULL, NULL, NULL),
(358, 57, 87012, 1921681105, NULL, NULL, NULL, NULL, 'Chrisly', 'Caliso', 'Updated a member', 'Members', '11:58 AM', NULL, NULL, NULL, NULL),
(359, 57, 87012, 1921681105, NULL, NULL, NULL, NULL, 'Chrisly', 'Caliso', 'Updated a member', 'Members', '12:02 PM', NULL, NULL, NULL, NULL),
(360, 57, 87012, 1921681104, NULL, NULL, NULL, NULL, 'Kenan', 'Hasanion', 'Updated a member', 'Members', '12:04 PM', NULL, NULL, NULL, NULL),
(361, 57, 87012, 1921681104, NULL, NULL, NULL, NULL, 'Kenan', 'Hasanion', 'Updated a member', 'Members', '12:09 PM', NULL, NULL, NULL, NULL),
(362, 57, 87012, 1921681105, NULL, NULL, NULL, NULL, 'Chrisly', 'Caliso', 'Updated a member', 'Members', '12:09 PM', NULL, NULL, NULL, NULL),
(363, 57, 87012, NULL, 1, NULL, NULL, NULL, 'Gaining', NULL, 'Updated the program', 'Programs', '12:22 PM', NULL, NULL, NULL, NULL),
(364, 57, 87012, NULL, 4, NULL, NULL, NULL, 'Crossfit', NULL, 'Recover the program', 'Programs', '12:22 PM', NULL, NULL, NULL, NULL),
(365, 57, 87012, 1921681070, NULL, NULL, NULL, NULL, 'Thomas', 'Thornton', 'Paid Walk-in', 'Members', '12:23 PM', NULL, NULL, NULL, NULL),
(366, 57, 87012, 1921681029, NULL, NULL, NULL, NULL, 'Graham', 'Vang', 'Paid Walk-in', 'Members', '12:31 PM', NULL, NULL, NULL, NULL),
(367, 57, 87012, 1921681031, NULL, NULL, NULL, NULL, 'Lance', 'Calderon', 'Paid Walk-in', 'Members', '12:32 PM', NULL, NULL, NULL, NULL),
(368, 57, 87012, 1921681041, NULL, NULL, NULL, NULL, 'Rafael', 'Witt', 'Paid Walk-in', 'Members', '12:32 PM', NULL, NULL, NULL, NULL),
(369, 57, 87012, NULL, NULL, 1515, NULL, NULL, 'Raian', 'Miro', 'Added a trainer', 'Trainers', '01:43 PM', NULL, NULL, NULL, NULL),
(370, 57, 87012, NULL, NULL, 1516, NULL, NULL, 'asdfsaaaaaaaaaaaaaa', 'wtf', 'Added a trainer', 'Trainers', '01:44 PM', NULL, NULL, NULL, NULL),
(371, 57, 87012, NULL, NULL, 1516, NULL, NULL, 'asdfsaaaaaaaaaaaaaa', 'wtf', 'Deleted a trainer', 'Trainers', '01:45 PM', NULL, NULL, NULL, NULL),
(372, 57, 87012, NULL, NULL, 1516, NULL, NULL, 'asdfsaaaaaaaaaaaaaa', 'wtf', 'Deleted a trainer', 'Trainers', '01:45 PM', NULL, NULL, NULL, NULL),
(373, 57, 87012, NULL, NULL, 1517, NULL, NULL, 'Dexter', 'Inso', 'Added a trainer', 'Trainers', '01:51 PM', NULL, NULL, NULL, NULL),
(374, 57, 87012, NULL, NULL, 1516, NULL, NULL, 'asdfsaaaaaaaaaaaaaa', 'wtf', 'Updated a Trainer ', 'Trainers', '02:29 PM', NULL, NULL, NULL, NULL),
(375, 57, 87012, NULL, NULL, 1516, NULL, NULL, 'asdfsaaaaaaaaaaaaaa', 'wtf', 'Updated a Trainer ', 'Trainers', '02:30 PM', NULL, NULL, NULL, NULL),
(376, 57, 87012, NULL, NULL, 1516, NULL, NULL, 'asdfsaaaaaaaaaaaaaa', 'wtf', 'Updated a Trainer ', 'Trainers', '02:30 PM', NULL, NULL, NULL, NULL),
(377, 57, 87012, NULL, NULL, 1516, NULL, NULL, 'asdfsaaaaaaaaaaaaaa', 'wtf', 'Updated a Trainer ', 'Trainers', '02:30 PM', NULL, NULL, NULL, NULL),
(378, 57, 87012, NULL, NULL, 1516, NULL, NULL, 'asdfsaaaaaaaaaaaaaa', 'wtf', 'Deleted a trainer', 'Trainers', '02:30 PM', NULL, NULL, NULL, NULL),
(379, 57, 87012, NULL, NULL, 1516, NULL, NULL, 'asdfsaaaaaaaaaaaaaa', 'wtf', 'Deleted a trainer', 'Trainers', '02:30 PM', NULL, NULL, NULL, NULL),
(380, 57, 87012, NULL, NULL, 1513, NULL, NULL, 'Greg', 'Ivor', 'Recovered a trainer', 'Trainers', '02:32 PM', NULL, NULL, NULL, NULL),
(381, 57, 87012, NULL, NULL, NULL, NULL, NULL, 'list of promos', NULL, 'Generated a report for list of promos', 'Reports', '02:35 PM', NULL, NULL, NULL, NULL),
(382, 57, 87012, NULL, NULL, NULL, NULL, NULL, 'list of promos', NULL, 'Generated a report for list of promos', 'Reports', '02:36 PM', NULL, NULL, NULL, NULL),
(383, 57, 87012, NULL, NULL, 1514, NULL, NULL, 'Reyland', 'Nazareth', 'Recovered a trainer', 'Trainers', '02:48 PM', NULL, NULL, NULL, NULL),
(384, 57, 87012, NULL, NULL, 1514, NULL, NULL, 'Reyland', 'Nazareth', 'Deleted a trainer', 'Trainers', '02:48 PM', NULL, NULL, NULL, NULL),
(385, 57, 87012, NULL, NULL, NULL, 2024, NULL, 'Pull up Machine', NULL, 'Added new equipment', 'Inventory', '04:54 PM', NULL, NULL, NULL, NULL),
(386, 57, 87012, NULL, NULL, NULL, 2024, NULL, 'Pull up Machine', NULL, 'Update equipment', 'Inventory', '05:13 PM', NULL, NULL, NULL, NULL),
(387, 57, 87012, NULL, NULL, NULL, 2024, NULL, 'Pull up Machine', NULL, 'Update equipment', 'Inventory', '05:14 PM', NULL, NULL, NULL, NULL),
(388, 57, 87012, NULL, NULL, NULL, 2013, NULL, 'charot', NULL, 'Recover an inventory', 'Inventory', '05:17 PM', NULL, NULL, NULL, NULL),
(389, 57, 87012, NULL, NULL, NULL, 2013, NULL, 'charot', NULL, 'Deleted an inventory', 'Inventory', '05:20 PM', NULL, NULL, NULL, NULL),
(390, 57, 87012, NULL, NULL, NULL, NULL, 202118, 'asfdasdf asdfasdf', NULL, 'Added new promo', 'Promos', '06:15 PM', NULL, NULL, NULL, NULL),
(391, 57, 87012, NULL, NULL, NULL, NULL, 202119, 'asdfsadfsadfsadfdasf', NULL, 'Added new promo', 'Promos', '06:17 PM', NULL, NULL, NULL, NULL),
(392, 57, 87012, NULL, NULL, NULL, NULL, 202100, 'March-May Promo', NULL, 'Update a promo', 'Promos', '06:45 PM', NULL, NULL, NULL, NULL),
(393, 57, 87012, NULL, NULL, NULL, NULL, 202101, 'Phelan Blackwell', NULL, 'Remove a member from Student Discount promo', 'Promos', '06:52 PM', NULL, NULL, NULL, NULL),
(394, 57, 87012, NULL, NULL, NULL, NULL, 202115, 'May Promo', NULL, 'Restore a promo', 'Promos', '06:54 PM', NULL, NULL, NULL, NULL),
(395, 57, 87012, NULL, NULL, NULL, NULL, 202115, 'May Promo', NULL, 'Deleted a promo', 'Promos', '06:54 PM', NULL, NULL, NULL, NULL),
(396, 57, 87012, NULL, NULL, NULL, NULL, 202100, 'Jonas Garza', NULL, 'Added a member to March-May Promo', 'Promos', '07:03 PM', NULL, NULL, NULL, NULL),
(397, 57, 87012, NULL, NULL, NULL, NULL, 202100, 'Jonas Garza', NULL, 'Added a member to March-May Promo', 'Promos', '07:11 PM', NULL, NULL, NULL, NULL),
(398, 57, 87012, NULL, NULL, NULL, NULL, 202101, 'Steven Deleon', NULL, 'Added a member to Student Discount', 'Promos', '07:14 PM', NULL, NULL, NULL, NULL),
(399, 57, 87012, NULL, NULL, NULL, NULL, 202112, 'Wallace Velasquez', NULL, 'Added a member to Senior Discount', 'Promos', '07:15 PM', NULL, NULL, NULL, NULL),
(400, 57, 87012, NULL, NULL, NULL, NULL, 202112, 'Wallace Velasquez', NULL, 'Remove a member from Senior Discount promo', 'Promos', '07:15 PM', NULL, NULL, NULL, NULL),
(401, 57, 87012, NULL, NULL, NULL, NULL, 202115, 'May Promo', NULL, 'Restore a promo', 'Promos', '07:30 PM', NULL, NULL, NULL, NULL),
(402, 57, 87012, NULL, NULL, NULL, NULL, 202115, 'May Promo', NULL, 'Deleted a promo', 'Promos', '07:31 PM', NULL, NULL, NULL, NULL),
(405, 57, 87012, 1921681011, NULL, NULL, NULL, NULL, '', '', 'Declined promo request', 'Promos', '07:50 PM', NULL, NULL, NULL, NULL),
(406, 57, 87012, 1921681011, NULL, NULL, NULL, NULL, 'John', 'Doe', 'Declined promo request', 'Promos', '07:51 PM', NULL, NULL, NULL, NULL),
(407, 57, 87012, 1921681011, NULL, NULL, NULL, NULL, 'John Doe', NULL, 'Declined promo request', 'Promos', '07:54 PM', NULL, NULL, NULL, NULL);

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
  `admin_delete` varchar(30) NOT NULL,
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
  `program_id` int(11) DEFAULT NULL,
  `image_pathname` varchar(9999) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`member_id`, `first_name`, `last_name`, `username`, `password`, `gender`, `birthdate`, `email`, `phone`, `member_status`, `date_registered`, `date_deleted`, `time_deleted`, `admin_delete`, `isActivated`, `isDeleted`, `date_activated`, `monthly_start`, `monthly_end`, `annual_start`, `annual_end`, `member_type`, `address`, `acc_status`, `program_id`, `image_pathname`) VALUES
(1921681011, 'John', 'Doe', 'johndoe', '$2y$10$N0T2MQDZQrr9nvpP2vkt5uJVuNl7O1pLc9e73go741zDZDCgBnPbe', 'M', '1931-01-01', 'johndoe@gmail.com', '09152351252', 'Paid', '2021-02-09', NULL, NULL, '', 'true', 'false', NULL, '2021-05-04', '2021-06-03', '2021-04-27', '2022-04-27', 'Regular', 'Lapu-lapu City, Philippines', 'active', 1, 'default_picture.png'),
(1921681012, 'George', 'Duterte', NULL, NULL, 'M', '1998-01-01', 'georgebush@hotmail.com', '09233215471', 'Paid', '2021-02-16', NULL, NULL, '', 'false', 'false', NULL, '2021-05-04', '2021-06-03', '2021-05-04', '2022-05-04', 'Regular', '2nd floor G7 Suites', 'active', 2, ''),
(1921681013, 'Christian James', 'Gulapa', '1921681013', '$2y$10$AaEyAQSUrnT.tyhFfPhArewLnaJOnZ.Rc7pkEmYQImpNeGN735DHe', 'M', '1978-01-01', 'cjbayot@gmail.com', '09455611244', 'Expired', '2021-02-17', NULL, '06:39:31', '', 'true', 'false', '2021-04-27', '2021-03-18', '2021-04-17', '2021-03-18', '2022-03-18', 'Regular', 'Talamban, Cebu', 'active', 1, ''),
(1921681014, 'John Jay', 'Desierto', '1921681014', '$2y$10$SM9gjk1E4wTFWhbyS1rewOKUcdpqwr5ndlQsd09xsDGw/y7a0hUES', 'M', '1998-05-12', 'johnjay@gmail.com', '09124562133', 'Paid', '2021-02-17', NULL, NULL, '', 'true', 'false', '2021-04-30', '2021-04-30', '2021-05-30', '2021-03-05', '2022-03-05', 'Regular', 'Talamban, Cebu', 'active', 1, ''),
(1921681015, 'Kim', 'Jorolan', '1921681015', '$2y$10$Bla6ve7HtM52uRczZX8I3u7eDUJMNtRW2iiLve/UlA0S2dvHDN8Ym', 'M', '1987-09-15', 'kimjorolan@gmail.com', '09234567891', 'Not Paid', '2021-02-17', NULL, NULL, '', 'false', 'false', '2021-03-22', NULL, NULL, NULL, NULL, 'Regular', 'Talamban, Cebu', 'active', 2, ''),
(1921681016, 'Michael', 'Antiporta', '1921681016', '$2y$10$pm2RPs6jo.Y442ISAhzu4eKjyxUET5IAD0vqJBXUS/KPLm0y5oZXq', 'M', '1996-02-15', 'kaelantiporta@gmail.com', '09201235400', 'Paid', '2021-02-17', NULL, NULL, '', 'true', 'false', '2021-05-04', '2021-05-04', '2021-06-03', '2020-07-01', '2021-07-01', 'Regular', 'Badian, Cebu, Philippines', 'active', 2, ''),
(1921681017, 'Thomas Rey', 'Barcenas', NULL, NULL, 'M', '1993-09-04', 'thomdatrain@gmail.com', '09475466911', 'Not Paid', '2021-02-17', NULL, NULL, '', 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Regular', 'Toledo City, Cebu', 'active', 2, ''),
(1921681018, 'Justine', 'Garcia', NULL, NULL, 'M', '1998-11-15', 'justinegarcia@gmail.com', '09135644887', 'Not Paid', '2021-02-17', NULL, NULL, '', 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Regular', 'Subangdaku, Mandaue', 'active', 1, ''),
(1921681019, 'Romhel', 'Ceniza', NULL, NULL, 'M', '1998-01-21', 'aldiceniza@gmail.com', '09234561121', 'Not Paid', '2021-02-17', NULL, NULL, '', 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Regular', 'Pit-os, Talamban, Cebu City', 'active', 1, ''),
(1921681020, 'Jade', 'Tibon', NULL, NULL, 'M', '1999-12-15', 'jadetibones@gmail.com', '09334651320', 'Not Paid', '2021-02-17', NULL, NULL, '', 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Regular', 'Jagobiao, Mandaue City', 'active', 1, ''),
(1921681021, 'Francis', 'Vasquez', NULL, NULL, 'M', '1997-02-14', 'bogoorven@gmail.com', '09164562230', 'Expired', '2021-02-17', NULL, NULL, '', 'false', 'false', NULL, '2021-02-22', '2021-04-23', '2021-02-22', '2022-02-22', 'Regular', 'Bacolod City', 'active', 2, ''),
(1921681022, 'Weinnand', 'Hasanion', 'weinnandhasanion', '$2y$10$jLfDlT0Jiy3fA.yPQhSU3eulsrULRtJesHNVbR25YXaakhqM4ZiTi', 'M', '1999-08-04', 'weinnandhasanion@gmail.com', '09206013530', 'Paid', '2021-02-17', NULL, NULL, '', 'true', 'false', '2021-03-29', '2021-05-04', '2021-06-03', '2021-02-18', '2022-02-18', 'Regular', 'Lapulapu City, Cebu', 'active', 1, '23120087_2028065854089081_3898487251116680559_o.jpg'),
(1921681023, 'Ivanne', 'Candano', NULL, NULL, 'M', '1998-03-16', 'vancandano@gmail.com', '09455641010', 'Expired', '2021-02-17', NULL, NULL, '', 'false', 'false', NULL, '2021-02-18', '2021-03-20', '2021-02-18', '2022-02-18', 'Regular', 'Pagadian, Philippines', 'active', 1, ''),
(1921681024, 'Clint', 'Lapera', 'febieclint', '$2y$10$96uGA7tAS5TSAchRuLlPcu6kFQpBB9oUvkXfVmbvItAYY2E4uBgTK', 'M', '2000-02-10', 'clintlapera@gmail.com', '09165433165', 'Paid', '2021-02-18', '2021-02-23', NULL, '', 'true', 'false', '2021-03-10', '2021-04-26', '2021-05-26', '2021-02-18', '2022-02-18', 'Regular', 'Masulog, Lapu-Lapu City', 'active', 2, '121773513_3617406608324077_306887283432560114_o.jpg'),
(1921681025, 'Dante', 'Phillips', NULL, NULL, 'F', '1988-04-09', 'blandit.congue.In@vitaeeratVivamus.edu', '09503661490', 'Not Paid', '2020-12-26', '2021-03-18', '13:06:15', '', 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Walk-in', '4979 A Ave', 'active', 1, ''),
(1921681026, 'Phelan', 'Blackwell', '1921681026', '$2y$10$qY0d.hRKjXBwbZ3cpm1VlOotJ8gz5q/VGAodmbivFkjyk3rqoGDy6', 'M', '1988-12-03', 'magna@Praesenteudui.com', '09819897080', 'Not Paid', '2020-05-10', NULL, NULL, '', 'false', 'false', '2021-04-29', NULL, NULL, '2021-04-29', '2022-04-29', 'Regular', 'Ap #623-6725 Sit Rd.', 'active', 2, ''),
(1921681027, 'Hamish', 'Kelly', NULL, NULL, 'M', '1976-07-10', 'nunc.ac.mattis@a.co.uk', '09942335946', 'Not Paid', '2020-10-15', NULL, NULL, '', 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Regular', '133-6723 Lorem Road', 'active', 1, ''),
(1921681028, 'Cedric', 'Huffman', NULL, NULL, 'M', '1986-09-02', 'tellus.Phasellus.elit@loremfringilla.edu', '09859151288', 'Expired', '2018-08-03', '2020-10-25', NULL, '', 'false', 'false', NULL, '2020-01-05', '2020-03-04', '2019-10-01', '2020-10-01', 'Regular', '3286 Volutpat. Road', 'inactive', 2, ''),
(1921681029, 'Graham', 'Vang', NULL, NULL, 'F', '1974-08-03', 'auctor@sagittis.edu', '09728554807', 'Not Paid', '2018-07-26', NULL, NULL, '', 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Walk-in', 'Ap #213-9940 Nunc Street', 'active', 1, ''),
(1921681030, 'Gil', 'Eaton', NULL, NULL, 'F', '1989-04-10', 'bibendum@ac.com', '09283818109', 'Not Paid', '2018-07-01', '2021-04-29', '00:17:31', '', 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Regular', '118-1929 Nec Road', 'active', 2, ''),
(1921681031, 'Lance', 'Calderon', NULL, NULL, 'F', '1995-10-08', 'dolor.Fusce@ligulaNullamenim.edu', '09103482282', 'Not Paid', '2018-08-15', NULL, NULL, '', 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Walk-in', '770-6890 Consequat Avenue', 'active', 1, ''),
(1921681032, 'Rigel', 'Wilson', NULL, NULL, 'F', '1999-12-21', 'orci.quis@interdumfeugiat.co.uk', '09462250477', 'Not Paid', '2021-02-22', '2021-03-18', '00:11:07', '', 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Walk-in', 'P.O. Box 730, 5300 Dignissim. Ave', 'active', 1, ''),
(1921681033, 'Ivor', 'Potts', NULL, NULL, 'F', '1997-06-11', 'lectus.Nullam.suscipit@amet.edu', '09774901141', 'Not Paid', '2018-04-11', NULL, NULL, '', 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Regular', 'P.O. Box 942, 7742 Duis Rd.', 'active', 2, ''),
(1921681034, 'Xanthus', 'Joyce', NULL, NULL, 'F', '2000-04-02', 'eget@lacusEtiam.org', '09982524430', 'Not Paid', '2020-09-02', NULL, NULL, '', 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Regular', 'P.O. Box 364, 5901 Lorem St.', 'active', 2, ''),
(1921681035, 'Oren', 'Baird', NULL, NULL, 'F', '1976-03-15', 'Cum.sociis.natoque@dictum.com', '09282261414', 'Not Paid', '2018-11-12', NULL, NULL, '', 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Regular', '525-9260 Lorem, Ave', 'active', 2, ''),
(1921681036, 'Cameron', 'Bates', NULL, NULL, 'F', '1988-01-14', 'nisi.sem.semper@velmaurisInteger.ca', '09180678532', 'Not Paid', '2020-09-05', NULL, NULL, '', 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Regular', 'Ap #931-8291 Nunc Street', 'active', 1, ''),
(1921681037, 'Vincent', 'Hanson', NULL, NULL, 'F', '1992-01-03', 'iaculis.lacus@faucibusMorbivehicula.edu', '09648533037', 'Not Paid', '2019-05-03', NULL, NULL, '', 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Regular', 'P.O. Box 935, 8945 Cursus Avenue', 'active', 1, ''),
(1921681038, 'Joel', 'Calhoun', NULL, NULL, 'M', '1989-08-06', 'vel.venenatis@nunc.net', '09682880508', 'Not Paid', '2019-08-16', NULL, NULL, '', 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Regular', '7571 Penatibus Road', 'active', 1, ''),
(1921681039, 'Lyle', 'Griffith', NULL, NULL, 'M', '1995-09-01', 'Donec.tempor@Cum.org', '09848565730', 'Not Paid', '2019-04-08', NULL, NULL, '', 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Walk-in', '3094 Mi. Ave', 'active', 1, ''),
(1921681040, 'Jermaine', 'Osborn', NULL, NULL, 'M', '1989-10-19', 'vulputate.risus.a@ipsumnonarcu.com', '09637532023', 'Not Paid', '2019-08-12', NULL, NULL, '', 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Walk-in', '1623 Arcu St.', 'active', 2, ''),
(1921681041, 'Rafael', 'Witt', NULL, NULL, 'F', '1973-07-24', 'ac@idblanditat.org', '09531736583', 'Not Paid', '2018-03-20', NULL, NULL, '', 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Walk-in', '908-1554 Lectus Rd.', 'active', 2, ''),
(1921681042, 'Herrod', 'Lang', NULL, NULL, 'F', '1979-10-19', 'sagittis.lobortis.mauris@sedpedenec.edu', '09824158157', 'Not Paid', '2020-05-02', NULL, NULL, '', 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Walk-in', '8635 Neque Av.', 'active', 1, ''),
(1921681043, 'Clarke', 'Jacobson', NULL, NULL, 'F', '1980-02-16', 'ipsum@laciniaSedcongue.net', '09736071281', 'Expired', '2020-03-13', '2021-03-18', '12:50:14', '', 'false', 'false', NULL, '2021-02-23', '2021-03-25', '2021-02-23', '2022-02-23', 'Regular', '826-8158 Gravida Street', 'active', 1, ''),
(1921681044, 'Alvin', 'Vance', NULL, NULL, 'M', '1983-02-05', 'Sed.pharetra@temporbibendum.co.uk', '09334981692', 'Not Paid', '2018-11-19', NULL, NULL, '', 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Walk-in', '746-313 Orci Road', 'active', 1, ''),
(1921681045, 'Xavier', 'Ellis', NULL, NULL, 'F', '1991-05-14', 'nisi@Duis.ca', '09905178265', 'Not Paid', '2019-02-14', NULL, NULL, '', 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Walk-in', '2242 Neque Av.', 'active', 2, ''),
(1921681046, 'Wallace', 'Velasquez', NULL, NULL, 'F', '1991-04-28', 'at.pretium@euismodenimEtiam.co.uk', '09917962390', 'Not Paid', '2020-07-19', NULL, NULL, '', 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Regular', '253-1786 Lectus Rd.', 'active', 2, ''),
(1921681047, 'Graiden', 'Knight', NULL, NULL, 'M', '1988-04-28', 'ridiculus.mus.Aenean@ultricesVivamusrhoncus.net', '09449699878', 'Not Paid', '2020-01-09', '2021-05-05', '21:20:26', 'Weinnand Hasanion', 'false', 'true', NULL, NULL, NULL, NULL, NULL, 'Regular', '975-3806 A, Rd.', 'inactive', 2, ''),
(1921681048, 'Wang', 'Bradshaw', NULL, NULL, 'F', '1997-01-25', 'nisl.Nulla@sodales.co.uk', '09875369629', 'Paid', '2018-03-29', NULL, NULL, '', 'false', 'false', NULL, '2021-05-05', '2021-06-04', '2021-05-05', '2022-05-05', 'Regular', '5884 Egestas Ave', 'active', 2, ''),
(1921681049, 'Chandler', 'Lowery', NULL, NULL, 'M', '1976-02-08', 'neque.vitae@inconsequat.edu', '09944567659', 'Not Paid', '2019-05-21', NULL, NULL, '', 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Walk-in', '570-6336 Quam, Av.', 'active', 1, ''),
(1921681050, 'Caesar', 'Maxwell', NULL, NULL, 'F', '1999-07-27', 'molestie.arcu.Sed@adipiscingelitEtiam.com', '09691967540', 'Not Paid', '2018-04-16', NULL, NULL, '', 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Walk-in', 'P.O. Box 432, 9045 Morbi St.', 'active', 1, ''),
(1921681051, 'Akeem', 'Pollard', NULL, NULL, 'M', '1978-09-06', 'hymenaeos@felisNulla.edu', '09983166627', 'Not Paid', '2020-04-10', NULL, NULL, '', 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Regular', '1030 Orci St.', 'active', 1, ''),
(1921681052, 'Salvador', 'Knapp', NULL, NULL, 'F', '1976-08-25', 'sit.amet@Nunc.org', '09982239424', 'Not Paid', '2020-01-29', NULL, NULL, '', 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Walk-in', '9634 Eu, St.', 'active', 2, ''),
(1921681053, 'Magee', 'Ayers', NULL, NULL, 'M', '1982-03-06', 'tempus@non.net', '09320480090', 'Not Paid', '2019-07-07', NULL, NULL, '', 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Walk-in', 'Ap #218-8399 Vestibulum. Road', 'active', 2, ''),
(1921681054, 'Jeremy', 'Frye', NULL, NULL, 'F', '1978-01-15', 'cursus@ullamcorpereu.com', '09385439462', 'Not Paid', '2019-08-20', NULL, NULL, '', 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Walk-in', '273-8995 Enim. Ave', 'active', 2, ''),
(1921681055, 'Jonas', 'Garza', NULL, NULL, 'F', '1992-02-10', 'malesuada.vel.venenatis@massaVestibulum.edu', '09566241596', 'Not Paid', '2019-09-13', NULL, NULL, '', 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Regular', '811-6487 Et Rd.', 'active', 2, ''),
(1921681056, 'Porter', 'Lowery', NULL, NULL, 'M', '1979-09-11', 'taciti.sociosqu@non.org', '09509845702', 'Not Paid', '2020-07-14', NULL, NULL, '', 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Walk-in', 'Ap #450-1414 Adipiscing Av.', 'active', 2, ''),
(1921681057, 'Phelan', 'Galloway', NULL, NULL, 'F', '1989-04-20', 'mollis.Integer@consequatenim.ca', '09106606601', 'Not Paid', '2019-11-07', NULL, NULL, '', 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Walk-in', 'Ap #708-3794 Lacinia St.', 'active', 2, ''),
(1921681058, 'Asher', 'Mcclure', NULL, NULL, 'M', '1979-05-25', 'eros@molestiepharetra.edu', '09127396138', 'Not Paid', '2019-07-17', NULL, NULL, '', 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Regular', '445-9684 Sem St.', 'active', 2, ''),
(1921681059, 'Basil', 'Hodges', NULL, NULL, 'F', '1986-03-30', 'eu.metus.In@uteros.co.uk', '09115474709', 'Not Paid', '2019-06-27', NULL, NULL, '', 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Walk-in', 'P.O. Box 182, 725 Libero Rd.', 'active', 1, ''),
(1921681060, 'Boris', 'Hopkins', NULL, NULL, 'F', '1992-05-01', 'blandit.congue.In@lorem.co.uk', '09249104148', 'Not Paid', '2018-04-26', NULL, NULL, '', 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Regular', '5548 Nec, Ave', 'active', 1, ''),
(1921681061, 'Ulric', 'Rollins', NULL, NULL, 'M', '2000-05-19', 'non.lobortis.quis@pedeCrasvulputate.com', '09598153405', 'Not Paid', '2018-12-18', '2021-05-05', '21:20:48', 'Weinnand Hasanion', 'false', 'true', NULL, NULL, NULL, NULL, NULL, 'Walk-in', '756-1186 Phasellus Rd.', 'inactive', 1, ''),
(1921681062, 'William', 'Suarez', NULL, NULL, 'M', '1981-05-30', 'dui.Cum@tempusmauris.ca', '09930619290', 'Not Paid', '2020-01-29', NULL, NULL, '', 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Regular', 'P.O. Box 608, 8662 Ornare St.', 'active', 2, ''),
(1921681063, 'Lucian', 'Slater', NULL, NULL, 'F', '2000-03-28', 'cursus.purus@Praesent.edu', '09781339342', 'Not Paid', '2020-10-29', NULL, NULL, '', 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Walk-in', 'P.O. Box 508, 6827 Tincidunt. Road', 'active', 1, ''),
(1921681064, 'Cedric', 'Raymond', NULL, NULL, 'M', '1997-05-16', 'sem.Nulla.interdum@adipiscingenimmi.co.uk', '09372214862', 'Not Paid', '2019-06-22', NULL, NULL, '', 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Walk-in', 'Ap #497-8148 Faucibus Rd.', 'active', 1, ''),
(1921681065, 'Gage', 'Tucker', NULL, NULL, 'F', '1991-03-12', 'blandit.at@ipsumdolorsit.co.uk', '09301779974', 'Not Paid', '2020-08-28', NULL, NULL, '', 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Walk-in', '996-6180 Molestie Rd.', 'active', 2, ''),
(1921681066, 'Troy', 'Lloyd', NULL, NULL, 'F', '1978-03-22', 'dictum@etnuncQuisque.com', '09603704508', 'Not Paid', '2018-03-11', NULL, NULL, '', 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Walk-in', 'Ap #478-1955 Urna Av.', 'active', 2, ''),
(1921681067, 'David', 'Roach', NULL, NULL, 'M', '1996-01-09', 'ut@luctus.edu', '09267815600', 'Not Paid', '2019-02-22', NULL, NULL, '', 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Regular', '5503 Mauris Avenue', 'active', 2, ''),
(1921681068, 'Fuller', 'Boyd', NULL, NULL, 'M', '1995-05-12', 'Donec@loremfringilla.ca', '09394496753', 'Not Paid', '2019-02-07', NULL, NULL, '', 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Walk-in', '6721 Etiam Road', 'active', 1, ''),
(1921681069, 'Simon', 'Clarke', NULL, NULL, 'M', '2000-02-05', 'magna.Praesent@Donecegestas.edu', '09777071216', 'Not Paid', '2020-12-04', NULL, NULL, '', 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Regular', '471-7279 Vulputate, Avenue', 'active', 1, ''),
(1921681070, 'Thomas', 'Thornton', NULL, NULL, 'F', '1984-02-03', 'Cras.eget@vitae.ca', '09587604314', 'Not Paid', '2018-03-18', NULL, NULL, '', 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Walk-in', 'P.O. Box 283, 2691 Pede Av.', 'active', 2, ''),
(1921681071, 'Steven', 'Deleon', NULL, NULL, 'M', '1987-02-21', 'Phasellus@Maurisvelturpis.org', '09688024898', 'Not Paid', '2020-02-21', NULL, NULL, '', 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Regular', '3383 Interdum. Street', 'active', 2, ''),
(1921681072, 'Quentin', 'Mclaughlin', NULL, NULL, 'F', '1988-03-16', 'libero.Proin@utmiDuis.co.uk', '09934019321', 'Not Paid', '2019-04-06', NULL, NULL, '', 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Walk-in', 'Ap #585-3600 Nisi Avenue', 'active', 1, ''),
(1921681073, 'Cruz', 'Combs', NULL, NULL, 'F', '1986-12-25', 'mus.Proin@ultriciesdignissim.net', '09592681068', 'Not Paid', '2020-04-17', NULL, NULL, '', 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Regular', 'Ap #947-1102 Sem. Road', 'active', 1, ''),
(1921681074, 'Keefe', 'England', NULL, NULL, 'F', '1979-06-05', 'urna.Ut@maurisMorbi.edu', '09237518540', 'Not Paid', '2020-11-06', NULL, NULL, '', 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Walk-in', 'P.O. Box 850, 1111 Eu St.', 'active', 2, ''),
(1921681075, 'Samson', 'Harvey', NULL, NULL, 'M', '1997-04-28', 'In.faucibus@aliquetmolestietellus.co.uk', '09957764442', 'Not Paid', '2018-06-01', NULL, NULL, '', 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Regular', 'Ap #339-5086 Feugiat Road', 'active', 1, ''),
(1921681076, 'Damon', 'Reynolds', NULL, NULL, 'M', '1978-07-20', 'erat@acrisusMorbi.com', '09760567029', 'Not Paid', '2020-10-20', NULL, NULL, '', 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Regular', 'Ap #183-587 Duis Av.', 'active', 1, ''),
(1921681077, 'Ciaran', 'Vincent', NULL, NULL, 'M', '1996-01-20', 'vitae.posuere@Sedpharetra.net', '09354945184', 'Not Paid', '2019-01-18', NULL, NULL, '', 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Walk-in', '909-1700 Cursus St.', 'active', 2, ''),
(1921681078, 'Sebastian', 'Farley', NULL, NULL, 'F', '1989-12-21', 'Suspendisse@necimperdietnec.org', '09565747679', 'Paid', '2019-08-25', NULL, NULL, '', 'false', 'false', NULL, '2021-05-02', '2021-06-01', '2021-05-02', '2022-05-02', 'Regular', 'P.O. Box 587, 6935 Diam St.', 'active', 2, ''),
(1921681079, 'Finn', 'Patterson', NULL, NULL, 'F', '1994-05-25', 'arcu.Sed@Vivamus.com', '09477503056', 'Paid', '2019-04-11', NULL, NULL, '', 'false', 'false', NULL, '2021-05-02', '2021-06-01', '2021-05-02', '2022-05-02', 'Regular', '5332 Integer St.', 'active', 2, ''),
(1921681080, 'Graham', 'Nunez', NULL, NULL, 'F', '1997-03-10', 'mus@aliquet.ca', '09634684992', 'Not Paid', '2018-05-06', NULL, NULL, '', 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Walk-in', 'P.O. Box 591, 2996 Accumsan St.', 'active', 2, ''),
(1921681081, 'Dane', 'Bird', NULL, NULL, 'F', '1982-02-18', 'vestibulum.massa.rutrum@metusfacilisislorem.edu', '09270804621', 'Not Paid', '2019-07-25', NULL, NULL, '', 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Walk-in', 'Ap #402-6538 Amet, Avenue', 'active', 1, ''),
(1921681082, 'Jared', 'Mullins', '1921681082', '$2y$10$cTwssZP5DtZeRY3C4yapM.VzfhcLD3M4gjQ34hOUL9bCLJuDNvQ8K', 'M', '1999-11-22', 'in@semut.co.uk', '09808136994', 'Paid', '2019-02-28', NULL, NULL, '', 'true', 'false', '2021-05-05', '2021-05-02', '2021-06-01', '2021-05-02', '2022-05-02', 'Regular', '661-542 Vulputate St.', 'active', 2, ''),
(1921681083, 'Giacomo', 'Mcgowan', NULL, NULL, 'F', '1982-11-15', 'Nulla@eu.ca', '09380918963', 'Not Paid', '2020-08-26', NULL, NULL, '', 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Walk-in', 'Ap #340-2379 Massa. St.', 'active', 2, ''),
(1921681084, 'Hamilton', 'Bernard', NULL, NULL, 'F', '1994-02-06', 'Donec.tempor.est@nequeseddictum.com', '09769927909', 'Paid', '2019-04-22', NULL, NULL, '', 'false', 'false', NULL, '2021-05-02', '2021-06-01', '2021-05-02', '2022-05-02', 'Regular', '5262 Mi Road', 'active', 2, ''),
(1921681085, 'Ciaran', 'Kinney', NULL, NULL, 'M', '1992-02-11', 'a@Etiamimperdiet.ca', '09692243138', 'Paid', '2020-01-15', NULL, NULL, '', 'false', 'false', NULL, '2021-05-02', '2021-06-01', '2021-05-02', '2022-05-02', 'Regular', '526 Mollis Ave', 'active', 2, ''),
(1921681086, 'Ishmael', 'Davidson', NULL, NULL, 'F', '1973-03-05', 'massa.Mauris.vestibulum@Donecest.ca', '09315304442', 'Not Paid', '2019-04-29', NULL, NULL, '', 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Walk-in', '6371 Malesuada St.', 'active', 1, ''),
(1921681087, 'Elton', 'Lyons', NULL, NULL, 'M', '1973-10-21', 'in@gravidanunc.ca', '09276062812', 'Paid', '2020-07-24', NULL, NULL, '', 'false', 'false', NULL, '2021-05-02', '2021-06-01', '2021-02-23', '2022-02-23', 'Regular', 'P.O. Box 902, 1824 Tellus St.', 'active', 2, ''),
(1921681088, 'Burke', 'Good', NULL, NULL, 'M', '1990-08-06', 'orci.Phasellus@Proinsedturpis.org', '09905620678', 'Not Paid', '2021-01-21', NULL, '23:52:02', '', 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Walk-in', 'P.O. Box 923, 1396 Rhoncus. Road', 'active', 2, ''),
(1921681089, 'Oleg', 'Whitley', NULL, NULL, 'F', '2000-02-12', 'penatibus.et@tellusnon.co.uk', '09872820215', 'Not Paid', '2020-10-03', NULL, NULL, '', 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Walk-in', 'P.O. Box 417, 9010 Aliquam St.', 'active', 1, ''),
(1921681090, 'Honorato', 'Barr', NULL, NULL, 'M', '1989-09-06', 'non.vestibulum@maurisid.com', '09170867269', 'Not Paid', '2019-03-15', '2021-05-04', '11:28:49', 'Weinnand Hasanion', 'false', 'true', NULL, NULL, NULL, NULL, NULL, 'Walk-in', 'P.O. Box 672, 4154 Pede, St.', 'inactive', 1, ''),
(1921681091, 'Josiah', 'Luna', '1921681091', '$2y$10$SpYGqx9.iCYAOyVw25ppCeLe2JJ0q4R.vuCayhRI/4KK77FJvIvX6', 'F', '1985-02-26', 'a@nequeNullamnisl.edu', '09141565157', 'Paid', '2018-10-30', '2021-03-18', '12:50:21', '', 'true', 'false', '2021-05-05', '2021-05-02', '2021-06-01', '2021-05-02', '2022-05-02', 'Regular', '7983 Elementum Avenue', 'active', 1, ''),
(1921681092, 'Hammett', 'Vaughn', NULL, NULL, 'F', '1998-10-06', 'aliquet.Proin.velit@atarcu.com', '09495661215', 'Not Paid', '2018-12-16', NULL, NULL, '', 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Walk-in', '676 Penatibus Avenue', 'active', 2, ''),
(1921681093, 'John', 'Lennon', NULL, NULL, 'M', '1985-01-01', 'john@gmail.com', '09135426654', 'Not Paid', '2021-04-30', '2021-05-04', '11:27:58', 'Weinnand Hasanion', 'false', 'true', NULL, NULL, NULL, NULL, NULL, 'Regular', 'Liverpool', 'inactive', 1, ''),
(1921681094, 'Ringo', 'Star', '1921681094', '$2y$10$wyMp7vnDwQ872qmHy1..Puqw0Ou/ZVQEsWS7Sjs3grd4QMaw9XYH6', 'M', '1999-01-01', 'ringo@gmail.com', '09203165455', 'Paid', '2021-04-30', NULL, NULL, '', 'true', 'false', '2021-05-05', '2021-05-01', '2021-06-30', '2021-04-30', '2022-04-30', 'Regular', 'Liverpool', 'active', 1, ''),
(1921681100, 'check', 'check', NULL, NULL, 'M', '1999-11-11', 'check@check.com', '09000000001', 'Paid', '2021-05-01', '2021-05-04', '11:27:07', 'Weinnand Hasanion', 'false', 'true', NULL, '2021-05-01', '2021-05-31', '2021-05-01', '2022-05-01', 'Regular', 'check', 'inactive', NULL, ''),
(1921681101, 'asdf', 'qwer', NULL, NULL, 'M', '1999-11-11', 'asdf@gmail.com', '09125124411', 'Paid', '2021-05-01', '2021-05-04', '11:26:43', 'Weinnand Hasanion', 'false', 'true', NULL, '2021-05-02', '2021-06-01', '2021-05-02', '2022-05-02', 'Regular', 'asdfqwer', 'inactive', NULL, ''),
(1921681102, 'george', 'harrison', NULL, NULL, 'M', '1988-01-01', 'geoarge@gmail.com', '09201115421', 'Not Paid', '2021-05-01', NULL, NULL, '', 'false', 'false', NULL, NULL, NULL, NULL, NULL, 'Walk-in', 'liverpool', 'active', NULL, ''),
(1921681103, 'Paul', 'McCartney', '1921681103', '$2y$10$lWZF.9/C.9KaB29e67MROOumvxjG/Z8uMpAwAitgT4u8rctqqCPHK', 'M', '1975-01-12', 'paul@beatles.com', '09201354465', 'Paid', '2021-05-02', NULL, NULL, '', 'true', 'false', '2021-05-02', '2021-05-02', '2021-07-01', '2021-05-02', '2022-05-02', 'Regular', 'Liverpool', 'active', 1, ''),
(1921681104, 'Kenan', 'Hasanion', NULL, NULL, 'M', '2001-08-30', 'kenanhasanion@gmail.com', '09301245514', 'Paid', '2021-05-02', NULL, NULL, '', 'false', 'false', NULL, '2021-05-02', '2021-07-01', '2021-05-02', '2022-05-02', 'Regular', 'Gun-ob, LLC', 'active', 2, ''),
(1921681105, 'Chrisly', 'Caliso', '1921681105', '$2y$10$2mFVvy5gdlieHWsJnaJjuO0.isP37O0cJP3B5wxmKN7EcQXUGhZr6', 'F', '1999-12-25', 'calisochrisly@gmail.com', '09208032961', 'Not Paid', '2021-05-05', NULL, NULL, '', 'true', 'false', '2021-05-05', NULL, NULL, '2021-05-05', '2022-05-05', 'Regular', 'Lapulapu City, Cebu', 'active', NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `memberpromos`
--

CREATE TABLE `memberpromos` (
  `id` int(100) NOT NULL,
  `promo_id` int(100) DEFAULT NULL,
  `member_id` int(100) DEFAULT NULL,
  `date_added` date DEFAULT NULL,
  `date_requested` datetime DEFAULT NULL,
  `admin_action_date` datetime DEFAULT NULL,
  `status` enum('Active','Expired','Pending','Declined','Removed') NOT NULL DEFAULT 'Active',
  `date_expired` date DEFAULT NULL,
  `request_image` varchar(9999) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `memberpromos`
--

INSERT INTO `memberpromos` (`id`, `promo_id`, `member_id`, `date_added`, `date_requested`, `admin_action_date`, `status`, `date_expired`, `request_image`) VALUES
(2, 202112, 1921681011, '2021-02-16', NULL, NULL, 'Expired', '2021-03-31', NULL),
(3, 202111, 1921681011, '2021-02-16', NULL, NULL, 'Expired', NULL, NULL),
(5, 202111, 1921681043, '2021-02-23', NULL, NULL, 'Expired', NULL, NULL),
(6, 202112, 1921681013, '2021-02-23', NULL, NULL, 'Expired', NULL, NULL),
(7, 202101, 1921681014, '2021-02-23', NULL, NULL, 'Active', NULL, NULL),
(9, 202101, 1921681015, '2021-02-23', NULL, NULL, 'Expired', '2021-03-22', NULL),
(10, 202101, 1921681055, '2021-02-23', NULL, NULL, 'Removed', NULL, NULL),
(12, 202101, 1921681046, '2021-02-23', NULL, NULL, 'Removed', NULL, NULL),
(13, 202101, 1921681013, '2021-03-02', NULL, NULL, 'Expired', NULL, NULL),
(14, 202112, 1921681013, '2021-03-02', NULL, NULL, 'Active', NULL, NULL),
(15, 202113, 1921681015, '2021-03-05', NULL, NULL, 'Expired', '2021-03-22', NULL),
(16, 202113, 1921681014, '2021-03-05', NULL, NULL, 'Expired', NULL, NULL),
(17, 202113, 1921681016, '2021-03-06', NULL, NULL, 'Expired', NULL, NULL),
(18, 202112, 1921681030, '2021-03-18', NULL, NULL, 'Expired', '2021-04-29', NULL),
(19, 202101, 1921681026, '2021-03-18', NULL, NULL, 'Removed', '2021-05-06', NULL),
(20, 202101, 1921681047, '2021-03-18', NULL, NULL, 'Expired', '2021-05-05', NULL),
(21, 202113, 1921681024, '2021-03-22', NULL, NULL, 'Expired', NULL, NULL),
(22, 202113, 1921681011, '2021-03-31', NULL, NULL, 'Expired', '2021-04-02', NULL),
(23, 202114, 1921681011, '2021-04-02', NULL, NULL, 'Expired', '2021-04-28', NULL),
(24, 202114, 1921681024, '2021-04-26', NULL, NULL, 'Expired', '2021-04-28', NULL),
(25, 202114, 1921681058, '2021-04-26', NULL, NULL, 'Expired', '2021-04-28', NULL),
(26, 202114, 1921681026, '2021-04-27', NULL, NULL, 'Expired', '2021-04-28', NULL),
(27, 202114, 1921681020, '2021-04-27', NULL, NULL, 'Expired', '2021-04-28', NULL),
(28, 202114, 1921681016, '2021-04-27', NULL, NULL, 'Expired', '2021-04-28', NULL),
(29, 202114, 1921681011, '2021-04-27', NULL, NULL, 'Expired', '2021-04-28', NULL),
(30, 202112, 1921681011, '2021-04-27', NULL, NULL, 'Removed', NULL, NULL),
(31, 202114, 1921681024, '2021-04-28', NULL, NULL, 'Expired', '2021-04-28', NULL),
(33, 202100, 1921681033, '2021-04-30', NULL, NULL, 'Active', NULL, NULL),
(34, 202100, 1921681071, '2021-04-30', NULL, NULL, 'Removed', NULL, NULL),
(36, 202100, 1921681094, '2021-04-30', NULL, NULL, 'Active', NULL, NULL),
(62, 202101, 1921681022, '2021-05-03', NULL, NULL, 'Expired', '2021-05-04', NULL),
(64, 202100, 1921681022, '2021-05-03', NULL, NULL, 'Removed', NULL, NULL),
(65, 202101, 1921681022, NULL, '2021-05-03 09:45:35', '2021-05-03 23:11:33', 'Expired', '2021-05-04', '1392947.jpg'),
(66, 202112, 1921681022, NULL, '2021-05-03 10:46:46', NULL, 'Declined', NULL, '179309544_924144008420873_3664081796755861232_n.jpg'),
(67, 202101, 1921681011, NULL, '2021-05-03 11:13:52', '2021-05-03 23:14:00', 'Expired', '2021-05-04', 'qr-code (6).png'),
(68, 202117, 1921681103, '2021-05-04', NULL, NULL, 'Expired', '2021-05-04', NULL),
(69, 202117, 1921681012, '2021-05-04', NULL, NULL, 'Active', NULL, NULL),
(70, 202100, 1921681103, '2021-05-04', NULL, NULL, 'Removed', NULL, NULL),
(73, 202117, 1921681103, '2021-05-04', '2021-05-04 12:34:24', '2021-05-04 12:55:35', 'Active', NULL, 'bottom up.png'),
(74, 202100, 1921681103, '2021-05-04', NULL, NULL, 'Removed', NULL, NULL),
(76, 202101, 1921681022, NULL, '2021-05-04 12:40:38', '2021-05-04 12:41:01', 'Declined', NULL, '119656503_1125123494556495_6798268467851074616_n.jpg'),
(77, 202101, 1921681022, '2021-05-04', '2021-05-04 12:47:57', '2021-05-04 12:48:03', 'Active', NULL, 'diagram - Copy.png'),
(78, 202112, 1921681022, NULL, '2021-05-04 12:51:46', '2021-05-04 12:52:17', 'Declined', NULL, '179309544_924144008420873_3664081796755861232_n.jpg'),
(80, 202100, 1921681055, '2021-05-06', NULL, NULL, 'Active', NULL, NULL),
(81, 202101, 1921681071, '2021-05-06', NULL, NULL, 'Active', NULL, NULL),
(82, 202112, 1921681046, '2021-05-06', NULL, NULL, 'Removed', '2021-05-06', NULL),
(83, 202101, 1921681011, NULL, '2021-05-06 07:48:30', '2021-05-06 19:48:37', 'Declined', NULL, 'pull up.jpg'),
(84, 202101, 1921681011, NULL, '2021-05-06 07:49:27', '2021-05-06 19:49:32', 'Declined', NULL, 'pull up.jpg'),
(85, 202101, 1921681011, NULL, '2021-05-06 07:50:03', '2021-05-06 19:50:07', 'Declined', NULL, 'pull up.jpg'),
(86, 202101, 1921681011, NULL, '2021-05-06 07:51:10', '2021-05-06 19:51:16', 'Declined', NULL, 'pull up.jpg'),
(87, 202101, 1921681011, NULL, '2021-05-06 07:54:22', '2021-05-06 19:54:28', 'Declined', NULL, 'pull up.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `member_logtrail`
--

CREATE TABLE `member_logtrail` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `login_date` datetime NOT NULL,
  `scanned_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `member_logtrail`
--

INSERT INTO `member_logtrail` (`id`, `member_id`, `login_date`, `scanned_by`) VALUES
(6, 1921681022, '2021-05-04 22:48:11', 87001),
(7, 1921681022, '2021-05-05 14:09:29', 87001),
(9, 1921681011, '2021-05-05 14:49:18', 87001);

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
(76, 1921681011, 3, 'Read', '2021-04-29 03:24:00', '2021-05-03 15:14:12'),
(77, 1921681022, 3, 'Unread', '2021-04-29 03:24:00', NULL),
(78, 1921681011, 4, 'Read', '2021-05-01 04:07:46', '2021-05-03 15:14:08'),
(79, 1921681022, 4, 'Unread', '2021-05-01 04:07:46', NULL),
(81, 1921681022, 9, 'Deleted', '2021-05-03 15:11:33', NULL),
(82, 1921681022, 10, 'Deleted', '2021-05-03 15:11:58', '2021-05-03 15:12:04'),
(83, 1921681011, 9, 'Read', '2021-05-03 15:14:00', '2021-05-04 12:48:40'),
(84, 1921681103, 9, 'Read', '2021-05-04 03:41:40', '2021-05-04 03:41:58'),
(85, 1921681022, 9, 'Deleted', '2021-05-04 04:40:03', NULL),
(86, 1921681022, 10, 'Read', '2021-05-04 04:41:01', '2021-05-04 04:41:16'),
(87, 1921681022, 9, 'Unread', '2021-05-04 04:48:03', NULL),
(88, 1921681022, 10, 'Unread', '2021-05-04 04:52:17', NULL),
(89, 1921681103, 9, 'Read', '2021-05-04 04:55:35', '2021-05-04 04:55:53'),
(90, 1921681011, 10, 'Unread', '2021-05-06 11:48:37', NULL),
(91, 1921681011, 10, 'Unread', '2021-05-06 11:49:32', NULL),
(92, 1921681011, 10, 'Unread', '2021-05-06 11:50:07', NULL),
(93, 1921681011, 10, 'Unread', '2021-05-06 11:51:16', NULL),
(94, 1921681011, 10, 'Unread', '2021-05-06 11:54:28', NULL);

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
(8, 'Your annual membership fee and monthly subscription is long due. Failure to renew your membership and pay monthly subscription for the next 7 days will make your account inactive, losing access to your profile. Please settle your dues.'),
(9, 'Your request to avail a permanent promo has been accepted.'),
(10, 'Your request to avail a permanent promo has been declined.');

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
  `payment_description` enum('Monthly Subscription','Annual Membership','Walk-in','Program Fee') DEFAULT NULL,
  `payment_type` enum('Cash','Online') NOT NULL,
  `date_payment` date DEFAULT NULL,
  `time_payment` varchar(15) NOT NULL,
  `payment_amount` varchar(4) DEFAULT NULL,
  `program_enrolled` varchar(30) DEFAULT NULL,
  `program_amount` varchar(4) DEFAULT NULL,
  `promo_availed` varchar(100) DEFAULT NULL,
  `online_payment_id` varchar(9999) DEFAULT NULL,
  `admin_id` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `paymentlog`
--

INSERT INTO `paymentlog` (`payment_id`, `member_id`, `first_name`, `last_name`, `member_type`, `payment_description`, `payment_type`, `date_payment`, `time_payment`, `payment_amount`, `program_enrolled`, `program_amount`, `promo_availed`, `online_payment_id`, `admin_id`) VALUES
(10, 1921681011, 'John', 'Doe', 'Regular', 'Annual Membership', 'Cash', '2021-02-16', '07:25 PM', '200', NULL, NULL, NULL, NULL, NULL),
(11, 1921681012, 'George', 'Duterte', 'Regular', 'Monthly Subscription', 'Cash', '2021-02-16', '07:26 PM', '750', NULL, NULL, 'N/A', NULL, NULL),
(12, 1921681012, 'George', 'Duterte', 'Regular', 'Annual Membership', 'Cash', '2021-02-16', '07:26 PM', '200', NULL, NULL, NULL, NULL, NULL),
(38, 1921681024, 'Clint', 'Lapera', 'Regular', 'Monthly Subscription', 'Cash', '2021-02-18', '09:46 PM', '750', NULL, NULL, 'N/A', NULL, NULL),
(39, 1921681024, 'Clint', 'Lapera', 'Regular', 'Annual Membership', 'Cash', '2021-02-18', '09:46 PM', '200', NULL, NULL, NULL, NULL, NULL),
(40, 1921681022, 'Weinnand', 'Hasanion', 'Regular', 'Monthly Subscription', 'Cash', '2021-02-18', '09:52 PM', '700', NULL, NULL, 'January-February Promo', NULL, NULL),
(41, 1921681022, 'Weinnand', 'Hasanion', 'Regular', 'Annual Membership', 'Cash', '2021-02-18', '09:52 PM', '200', NULL, NULL, NULL, NULL, NULL),
(42, 1921681023, 'Ivanne', 'Candano', 'Regular', 'Monthly Subscription', 'Cash', '2021-02-18', '10:36 PM', '750', NULL, NULL, 'N/A', NULL, NULL),
(43, 1921681023, 'Ivanne', 'Candano', 'Regular', 'Annual Membership', 'Cash', '2021-02-18', '10:36 PM', '200', NULL, NULL, NULL, NULL, NULL),
(44, 1921681021, 'Francis', 'Vasquez', 'Regular', 'Monthly Subscription', 'Cash', '2021-02-22', '08:45 AM', '750', NULL, NULL, 'N/A', NULL, NULL),
(45, 1921681021, 'Francis', 'Vasquez', 'Regular', 'Annual Membership', 'Cash', '2021-02-22', '08:45 AM', '200', NULL, NULL, NULL, NULL, NULL),
(46, 1921681021, 'Francis', 'Vasquez', 'Regular', 'Monthly Subscription', 'Cash', '2021-02-22', '08:45 AM', '750', NULL, NULL, 'N/A', NULL, NULL),
(47, 1921681091, 'Josiah', 'Luna', 'Regular', 'Monthly Subscription', 'Cash', '2021-02-23', '02:55 PM', '750', NULL, NULL, 'N/A', NULL, NULL),
(48, 1921681091, 'Josiah', 'Luna', 'Regular', 'Annual Membership', 'Cash', '2021-02-23', '02:55 PM', '200', NULL, NULL, NULL, NULL, NULL),
(49, 1921681087, 'Elton', 'Lyons', 'Regular', 'Monthly Subscription', 'Cash', '2021-02-23', '02:55 PM', '750', NULL, NULL, 'N/A', NULL, NULL),
(50, 1921681087, 'Elton', 'Lyons', 'Regular', 'Annual Membership', 'Cash', '2021-02-23', '02:55 PM', '200', NULL, NULL, NULL, NULL, NULL),
(51, 1921681043, 'Clarke', 'Jacobson', 'Regular', 'Monthly Subscription', 'Cash', '2021-02-23', '02:56 PM', '700', NULL, NULL, 'January-February Promo', NULL, NULL),
(52, 1921681043, 'Clarke', 'Jacobson', 'Regular', 'Annual Membership', 'Cash', '2021-02-23', '02:56 PM', '200', NULL, NULL, NULL, NULL, NULL),
(53, 1921681032, 'Rigel', 'Wilson', 'Walk-in', 'Walk-in', 'Cash', '2021-03-05', '04:11 AM', '50', NULL, NULL, NULL, NULL, NULL),
(54, 1921681088, 'Burke', 'Good', 'Walk-in', 'Walk-in', 'Cash', '2021-03-05', '04:11 AM', '50', NULL, NULL, NULL, NULL, NULL),
(55, 1921681025, 'Dante', 'Phillips', 'Walk-in', 'Walk-in', 'Cash', '2021-03-05', '04:11 AM', '50', NULL, NULL, NULL, NULL, NULL),
(56, 1921681014, 'John Jay', 'Desierto', 'Regular', 'Monthly Subscription', 'Cash', '2021-03-05', '04:12 AM', '650', NULL, NULL, 'Student Discount', NULL, NULL),
(57, 1921681014, 'John Jay', 'Desierto', 'Regular', 'Annual Membership', 'Cash', '2021-03-05', '04:12 AM', '200', NULL, NULL, NULL, NULL, NULL),
(58, 1921681016, 'Michael', 'Antiporta', NULL, 'Monthly Subscription', 'Online', '2021-03-06', '11:06 PM', '750', NULL, NULL, NULL, '6K2378805T6522126', NULL),
(59, 1921681016, 'Michael', 'Antiporta', NULL, 'Annual Membership', 'Online', '2021-03-06', '11:06 PM', '200', NULL, NULL, NULL, '6K2378805T6522126', NULL),
(60, 1921681032, 'Rigel', 'Wilson', 'Walk-in', 'Walk-in', 'Cash', '2021-03-16', '06:40 PM', '50', NULL, NULL, NULL, NULL, NULL),
(61, 1921681013, 'Christian James', 'Gulapa', 'Regular', 'Annual Membership', 'Cash', '2021-03-18', '12:45 AM', '100', NULL, NULL, NULL, NULL, NULL),
(62, 1921681054, 'Jeremy', 'Frye', 'Walk-in', 'Walk-in', 'Cash', '2021-03-18', '12:46 AM', '50', NULL, NULL, NULL, NULL, NULL),
(63, 1921681013, 'Christian James', 'Gulapa', 'Regular', 'Monthly Subscription', 'Cash', '2021-03-18', '12:46 AM', '650', NULL, NULL, 'Senior Discount', NULL, NULL),
(68, 1921681024, 'Clint', 'Lapera', 'Regular', 'Monthly Subscription', 'Online', '2021-03-22', '11:34 AM', '675', NULL, NULL, 'Back-to-school Promo', '136225401D330332B', NULL),
(69, 1921681022, 'Weinnand', 'Hasanion', 'Regular', 'Monthly Subscription', 'Cash', '2021-03-31', '01:39 PM', '700', NULL, NULL, 'Student Discount', NULL, NULL),
(70, 1921681011, 'John', 'Doe', 'Regular', 'Monthly Subscription', 'Online', '2021-03-31', '01:46 PM', '750', NULL, NULL, '', '2MB59268H68586939', NULL),
(71, 1921681024, 'Clint', 'Lapera', 'Regular', 'Monthly Subscription', 'Online', '2021-04-26', '11:54 PM', '700', NULL, NULL, 'April Promo', '9EA49560X4174013C', NULL),
(72, 1921681011, 'John', 'Doe', 'Regular', 'Annual Membership', 'Cash', '2021-04-27', '07:46 PM', '150', NULL, NULL, NULL, NULL, NULL),
(74, 1921681026, 'Phelan', 'Blackwell', 'Regular', 'Annual Membership', 'Cash', '2021-04-29', '12:06 AM', '150', NULL, NULL, NULL, NULL, NULL),
(75, 1921681014, 'John Jay', 'Desierto', 'Regular', 'Monthly Subscription', 'Cash', '2021-04-30', '09:45 PM', '700', NULL, NULL, 'Student Discount', NULL, NULL),
(76, 1921681094, 'Ringo', 'Star', 'Regular', 'Annual Membership', 'Cash', '2021-04-30', '09:46 PM', '200', NULL, NULL, NULL, NULL, NULL),
(79, 1921681100, 'check', 'check', 'Regular', 'Monthly Subscription', 'Cash', '2021-05-01', '10:16 PM', '750', NULL, NULL, 'N/A', NULL, NULL),
(80, 1921681100, 'check', 'check', 'Regular', 'Annual Membership', 'Cash', '2021-05-01', '10:16 PM', '200', NULL, NULL, NULL, NULL, NULL),
(81, 1921681100, 'check', 'check', 'Regular', 'Program Fee', 'Cash', '2021-05-01', '10:23 PM', '30', NULL, NULL, NULL, NULL, NULL),
(83, 1921681094, 'Ringo', 'Star', 'Regular', 'Monthly Subscription', 'Cash', '2021-05-01', '11:17 PM', '705', 'Gaining', '30', 'March-May Promo', NULL, NULL),
(104, 1921681104, 'Kenan', 'Hasanion', 'Regular', 'Monthly Subscription', 'Cash', '2021-05-02', '03:49 PM', '780', 'Gaining', '30', 'N/A', NULL, NULL),
(105, 1921681104, 'Kenan', 'Hasanion', 'Regular', 'Annual Membership', 'Cash', '2021-05-02', '03:49 PM', '200', NULL, NULL, NULL, NULL, NULL),
(106, 1921681101, 'asdf', 'qwer', 'Regular', 'Program Fee', 'Cash', '2021-05-02', '03:52 PM', '30', NULL, NULL, NULL, NULL, NULL),
(107, 1921681103, 'Paul', 'McCartney', 'Regular', 'Monthly Subscription', 'Cash', '2021-05-02', '03:53 PM', '750', 'N/A', '0', 'N/A', NULL, NULL),
(108, 1921681103, 'Paul', 'McCartney', 'Regular', 'Annual Membership', 'Cash', '2021-05-02', '03:53 PM', '200', NULL, NULL, NULL, NULL, NULL),
(109, 1921681103, 'Paul', 'McCartney', 'Regular', 'Monthly Subscription', 'Cash', '2021-05-02', '06:13 PM', '750', 'N/A', '0', 'N/A', NULL, NULL),
(110, 1921681103, 'Paul', 'McCartney', 'Regular', 'Annual Membership', 'Cash', '2021-05-02', '06:13 PM', '200', NULL, NULL, NULL, NULL, NULL),
(114, 1921681022, 'Weinnand', 'Hasanion', 'Regular', 'Monthly Subscription', 'Cash', '2021-05-04', '11:22 AM', '680', 'Crossfit', '30', 'Student Discount', NULL, NULL),
(115, 1921681012, 'George', 'Duterte', 'Regular', 'Monthly Subscription', 'Cash', '2021-05-04', '11:24 AM', '630', 'Reducing', '30', 'Front-liner Discount', NULL, NULL),
(116, 1921681012, 'George', 'Duterte', 'Regular', 'Annual Membership', 'Cash', '2021-05-04', '11:24 AM', '200', NULL, NULL, NULL, NULL, NULL),
(117, 1921681103, 'Paul', 'McCartney', 'Regular', 'Program Fee', 'Online', '2021-05-04', '12:53 PM', '30', NULL, NULL, NULL, '29F5708896572833D', NULL),
(120, 1921681016, 'Michael', 'Antiporta', 'Regular', 'Monthly Subscription', 'Online', '2021-05-04', '01:40 PM', '780', 'Reducing', '30', '', '6H231400400861406', NULL),
(121, 1921681011, 'John', 'Doe', 'Regular', 'Monthly Subscription', 'Online', '2021-05-04', '01:46 PM', '780', 'Gaining', '30', '', '9K735057XY908071F', NULL),
(122, 1921681048, 'Wang', 'Bradshaw', 'Regular', 'Monthly Subscription', 'Cash', '2021-05-05', '02:19 PM', '780', 'Reducing', '30', 'N/A', NULL, NULL),
(123, 1921681048, 'Wang', 'Bradshaw', 'Regular', 'Annual Membership', 'Cash', '2021-05-05', '02:19 PM', '200', NULL, NULL, NULL, NULL, NULL),
(124, 1921681105, 'Chrisly', 'Caliso', 'Regular', 'Annual Membership', 'Cash', '2021-05-05', '08:48 PM', '200', NULL, NULL, NULL, NULL, NULL),
(125, 1921681070, 'Thomas', 'Thornton', 'Walk-in', 'Walk-in', 'Cash', '2021-05-06', '12:23 PM', '50', NULL, NULL, NULL, NULL, NULL),
(126, 1921681029, 'Graham', 'Vang', 'Walk-in', 'Walk-in', 'Cash', '2021-05-06', '12:31 PM', '50', NULL, NULL, NULL, NULL, NULL),
(127, 1921681031, 'Lance', 'Calderon', 'Walk-in', 'Walk-in', 'Cash', '2021-05-06', '12:32 PM', '50', NULL, NULL, NULL, NULL, NULL),
(128, 1921681041, 'Rafael', 'Witt', 'Walk-in', 'Walk-in', 'Cash', '2021-05-06', '12:32 PM', '50', NULL, NULL, NULL, NULL, NULL);

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
  `admin_delete` varchar(50) DEFAULT NULL,
  `amount` int(11) DEFAULT 30,
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

INSERT INTO `program` (`program_id`, `admin_id`, `trainer_id`, `program_name`, `program_description`, `program_status`, `date_added`, `time_added`, `date_deleted`, `time_deleted`, `admin_delete`, `amount`, `upper_1_day_1`, `upper_2_day_1`, `upper_3_day_1`, `upper_1_day_2`, `upper_2_day_2`, `upper_3_day_2`, `upper_1_day_3`, `upper_2_day_3`, `upper_3_day_3`, `lower_1_day_1`, `lower_2_day_1`, `lower_3_day_1`, `lower_1_day_2`, `lower_2_day_2`, `lower_3_day_2`, `lower_1_day_3`, `lower_2_day_3`, `lower_3_day_3`, `abdominal_day_1`, `abdominal_day_2`, `abdominal_day_3`) VALUES
(1, 87001, 1513, 'Gaining', 'This is a program for members who aim to gain weight and mass.', 'active', '2021-02-09', '19:30:00', NULL, '00:00:00', NULL, 30, 1, 2, 3, 4, 5, 6, 7, 8, 2, 9, 10, 11, 12, 13, 14, 15, 9, 11, 16, 19, 20),
(2, 87001, 1514, 'Reducing', 'This program is for reducing weight.', 'active', '2021-02-15', '12:14:00', NULL, '00:00:00', NULL, 30, 1, 2, 3, 4, 5, 6, 7, 8, 1, 9, 10, 11, 12, 13, 14, 15, 9, 10, 21, 20, 18),
(4, 87001, 1514, 'Crossfit', 'This is for members who want to try crossfit.', 'active', '2021-04-26', '11:32:00', NULL, '00:00:00', 'Weinnand Hasanion', 30, 1, 3, 2, 4, 7, 4, 8, 7, 6, 9, 10, 11, 12, 9, 10, 15, 14, 13, 16, 20, 23),
(8, 87001, 1512, 'Weightlifting', 'For the weightlifting peeps.', 'inactive', '2021-05-05', '09:47:00', '2021-05-05', '21:48:54', 'Weinnand Hasanion', 30, 1, 1, 1, 1, 1, 1, 1, 1, 1, 9, 9, 9, 9, 9, 9, 9, 9, 9, 16, 16, 16);

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
  `date_deleted` date DEFAULT NULL,
  `admin_delete` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `promo`
--

INSERT INTO `promo` (`promo_id`, `promo_name`, `promo_type`, `promo_description`, `date_added`, `promo_starting_date`, `promo_ending_date`, `amount`, `status`, `date_deleted`, `admin_delete`) VALUES
(202100, 'March-May Promo', 'Seasonal', 'Monthly subscription is P75 off for the months of March, April, and May.', '2021-01-27', '2021-03-01', '2021-05-31', 75, 'Active', '2021-03-18', NULL),
(202101, 'Student Discount', 'Permanent', 'Monthly subscription is P100 off for students. Please show valid school ID to the counter to avail.', '2021-01-27', NULL, NULL, 100, 'Active', NULL, NULL),
(202111, 'January-February Promo', 'Seasonal', 'P50 off for the whole month of January.', '2021-01-28', '2021-01-01', '2021-02-28', 50, 'Expired', '2021-02-28', NULL),
(202112, 'Senior Discount', 'Permanent', 'Monthly subscription is P100 off for ages 40 and above. Please present valid Senior Citizen ID to avail promo.', '2021-01-28', '1970-01-01', '1970-01-01', 100, 'Active', '2021-01-27', NULL),
(202113, 'Back-to-school Promo', 'Seasonal', 'P75 discount to all who avail our back-to-school promo. This promo is only available starting March 1, 2021 until March 31, 2021.', '2021-02-23', '2021-03-01', '2021-03-31', 75, 'Expired', '2021-03-31', NULL),
(202114, 'April Promo', 'Seasonal', 'P50 off for monthly subscription for the whole month of April.', '2021-03-31', '2021-04-01', '2021-04-30', 50, 'Expired', '2021-04-30', NULL),
(202115, 'May Promo', 'Seasonal', 'may prom ohaha', '2021-04-13', '2021-05-05', '2021-05-04', 60, 'Deleted', '2021-05-06', 'Alvin Arnibal'),
(202117, 'Frontliner Discount', 'Permanent', 'A big discount for our frontliners who risk their lives to save others. P150 off for monthly subscriptions. Please present valid ID that indicates you are a frontliner to avail.', '2021-05-03', '1970-01-01', '1970-01-01', 150, 'Active', NULL, NULL);

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
(22, 'Bird-dog', 'https://www.youtube.com/watch?v=wiFNA3sqjCA', 'Abdominal', 25, 3),
(23, 'Hanging knee raise', 'https://www.youtube.com/watch?v=p9hhX_Sx5v0', 'Abdominal', 20, 3),
(24, 'Bench Press', 'https://www.youtube.com/watch?v=gRVjAtPip0Y', 'Upper Body', 15, 3);

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
  `time_deleted` time DEFAULT NULL,
  `admin_delete` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `trainer`
--

INSERT INTO `trainer` (`trainer_id`, `trainer_status`, `trainer_position`, `first_name`, `last_name`, `address`, `gender`, `phone`, `email`, `file`, `birthdate`, `date_hired`, `date_deleted`, `time_deleted`, `admin_delete`) VALUES
(1512, 'active', 'junior', 'George', 'Vasquez', '2nd floor G7 Suites', 'M', '09453216542', 'leeapple619@gmail.com', NULL, '1985-01-01', '2021-02-23', NULL, NULL, NULL),
(1513, 'active', 'junior', 'Greg', 'Ivor', 'Cebu City', 'M', '09994562154', 'greg@gmail.com', NULL, '1990-02-16', '2021-02-23', NULL, NULL, NULL),
(1514, 'deleted', 'junior', 'Reyland', 'Nazareth', 'Lapulapu City', 'M', '09164543211', 'reylandbogo@gmail.com', NULL, '1977-09-23', '2021-02-23', '2021-05-06', '14:48:22', 'Alvin Arnibal'),
(1515, 'active', 'junior', 'Raian', 'Miro', 'Banilad, Cebu', 'M', '09453215422', 'raianmiro@gmail.com', NULL, '1998-01-01', '2021-05-06', NULL, NULL, NULL),
(1516, 'deleted', 'junior', 'asdfsaaaaaaaaaaaaaa', 'wtf', 'Cebu City', 'M', '09455611241', 'tarongni@gmail.com', NULL, '1921-05-04', '2021-05-06', '2021-05-06', '14:30:55', 'Alvin Arnibal'),
(1517, 'active', 'junior', 'Dexter', 'Inso', 'Tabok, Mandaue City', 'M', '09451214451', 'dexterinso@gmail.com', NULL, '1987-01-01', '2021-05-06', NULL, NULL, NULL);

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
  ADD KEY `member_ibfk_1` (`program_id`);

--
-- Indexes for table `memberpromos`
--
ALTER TABLE `memberpromos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `memberpromos_ibfk_2` (`member_id`),
  ADD KEY `memberpromos_ibfk_1` (`promo_id`);

--
-- Indexes for table `member_logtrail`
--
ALTER TABLE `member_logtrail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `member_id` (`member_id`);

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
  MODIFY `admin_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87013;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `inventory_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2025;

--
-- AUTO_INCREMENT for table `logtrail`
--
ALTER TABLE `logtrail`
  MODIFY `login_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `logtrail_doing`
--
ALTER TABLE `logtrail_doing`
  MODIFY `logtrail_doing_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=408;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `member_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1921681106;

--
-- AUTO_INCREMENT for table `memberpromos`
--
ALTER TABLE `memberpromos`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `member_logtrail`
--
ALTER TABLE `member_logtrail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `member_notifs`
--
ALTER TABLE `member_notifs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notif_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `paymentlog`
--
ALTER TABLE `paymentlog`
  MODIFY `payment_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT for table `program`
--
ALTER TABLE `program`
  MODIFY `program_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `promo`
--
ALTER TABLE `promo`
  MODIFY `promo_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=202120;

--
-- AUTO_INCREMENT for table `routines`
--
ALTER TABLE `routines`
  MODIFY `routine_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `trainer`
--
ALTER TABLE `trainer`
  MODIFY `trainer_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1518;

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
-- Constraints for table `member_logtrail`
--
ALTER TABLE `member_logtrail`
  ADD CONSTRAINT `member_id_fk` FOREIGN KEY (`member_id`) REFERENCES `member` (`member_id`);

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
