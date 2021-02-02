CREATE DATABASE gym;
USE gym;

CREATE TABLE admin(
    admin_id INT(100) PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(100),
    password VARCHAR(100),
    first_name VARCHAR(100),
    last_name VARCHAR(100)
);
ALTER TABLE `admin`
  MODIFY `admin_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87000;

CREATE TABLE program(
    program_id INT(100) PRIMARY KEY,
    program_name VARCHAR(100),
    program_type VARCHAR(100),
    date_added DATE,
    date_deleted DATE,
    program_description VARCHAR(500),
    program_status ENUM('active','remove')NOT NULL
);
ALTER TABLE `program`
  MODIFY `program_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT= 1001;


CREATE TABLE member(
    member_id INT(100) PRIMARY KEY,
    first_name VARCHAR(100),
    last_name VARCHAR(100),
    username VARCHAR(100),
    password VARCHAR(100),
    gender ENUM('M','F'),
    birthdate DATE,
    email VARCHAR(100),
    phone VARCHAR(11),
    member_status ENUM('Not Paid','Paid', 'Expired') NOT NULL,
    date_registered DATE,
    date_deleted DATE,
    monthly_start DATE,
    monthly_end  DATE,
    annual_start DATE,
    annual_end  DATE,
    member_type ENUM('Regular','Walk-in'),
    address VARCHAR(100),
    acc_status ENUM('active','inactive') NOT NULL,
    admin_id INT(100),
    program_name VARCHAR(100),
    image_pathname varchar(9999) NOT NULL
);
ALTER TABLE `member`
  MODIFY `member_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1921681000;





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



INSERT INTO `promo` (`promo_id`, `promo_name`, `promo_type`, `promo_description`, `date_added`, `promo_starting_date`, `promo_ending_date`, `amount`, `status`, `date_deleted`) VALUES
(202100, 'Christmas Promo', 'Seasonal', 'Monthly subscription is P75 off for the whole month of December.', '2021-01-27', '2021-12-01', '2021-12-31', 75, 'Active', '2021-01-28'),
(202101, 'Student Discount', 'Permanent', 'Monthly subscription is P100 off for students. Please show valid school ID to the counter to avail.', '2021-01-27', NULL, NULL, 100, 'Active', NULL),
(202111, 'January Promo', 'Seasonal', 'P50 off for the whole month of January.', '2021-01-28', '2021-01-01', '2021-01-31', 50, 'Active', '2021-01-28'),
(202112, 'Senior Discount', 'Permanent', 'Monthly subscription is P100 off for ages 40 and above. Please present valid Senior Citizen ID to avail promo.', '2021-01-28', '1970-01-01', '1970-01-01', 100, 'Active', '2021-01-27');


ALTER TABLE `promo`
  ADD PRIMARY KEY (`promo_id`);


ALTER TABLE `promo`
  MODIFY `promo_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=202113;
COMMIT;

CREATE TABLE `memberpromos` (
  `id` int(100) NOT NULL,
  `promo_id` int(100) DEFAULT NULL,
  `member_id` int(100) DEFAULT NULL,
  `date_added` date DEFAULT NULL,
  `status` enum('Active','Expired') NOT NULL DEFAULT 'Active',
  `date_expired` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



ALTER TABLE `memberpromos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `memberpromos_ibfk_2` (`member_id`),
  ADD KEY `memberpromos_ibfk_1` (`promo_id`);


ALTER TABLE `memberpromos`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;


ALTER TABLE `memberpromos`
  ADD CONSTRAINT `memberpromos_ibfk_1` FOREIGN KEY (`promo_id`) REFERENCES `promo` (`promo_id`);

ALTER TABLE memberpromos
ADD FOREIGN KEY (member_id) REFERENCES member(member_id);



CREATE TABLE trainer(
    trainer_id INT(100) PRIMARY KEY,
    trainer_status ENUM('active','inactive') NOT NULL,
    trainer_position ENUM('junior','senior') NOT NULL,
    first_name VARCHAR(100),
    last_name VARCHAR(100),
    address VARCHAR(100),
    gender ENUM('M','F'),
    phone VARCHAR(11),
    email VARCHAR(100),
    file BLOB,
    birthdate DATE,
    date_hired DATE, 
    date_deleted DATE,
    acc_status ENUM('able','disable') NOT NULL
);
ALTER TABLE `trainer`
  MODIFY `trainer_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1510;
  

CREATE TABLE paymentlog(
    payment_id INT(100) PRIMARY KEY,
    member_id INT(100),
    first_name VARCHAR(100),
    last_name VARCHAR(100),
    payment_description ENUM('Monthly Subscription', 'Annual Subscription', 'Walk-in'),
    payment_type ENUM('Cash','Online') NOT NULL,
    date_time DATETIME DEFAULT CURRENT_TIMESTAMP,
    payment_amount ENUM('750','200','50'),
    member_type ENUM('Regular','Walk-in'),
    admin_id INT(100)
   
);
ALTER TABLE `paymentlog`
  MODIFY `payment_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=09260;

ALTER TABLE paymentlog
ADD FOREIGN KEY (member_id) REFERENCES member(member_id);


CREATE TABLE inventory(
  inventory_id INT(100) PRIMARY KEY,
  inventory_name VARCHAR(100),
  inventory_category ENUM('Cardio Equipment','Weight Equipment'),
  inventory_qty INT(255),
  inventory_damage INT(255),
  inventory_working INT(255),
  inventory_description VARCHAR(255),
  date_deleted DATE,
  date_added DATE
);
ALTER TABLE `inventory`
  MODIFY `inventory_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT= 110;
  

CREATE TABLE logtrail(
    login_id INT(100) PRIMARY KEY AUTO_INCREMENT,
    admin_id INT(100),
    first_name VARCHAR(100),
    last_name VARCHAR(100),
    dateandtime_login  DATETIME DEFAULT CURRENT_TIMESTAMP,
    dateandtime_logout DATETIME
);
ALTER TABLE `logtrail`
  MODIFY `login_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT= 3100;
ALTER TABLE logtrail
ADD FOREIGN KEY (admin_id) REFERENCES admin(admin_id);

CREATE TABLE reports(
    report_id INT(100) PRIMARY KEY AUTO_INCREMENT,
    admin_id INT(100),
    member_id INT(100),
    trainer_id INT(100),
    dateandtime  DATETIME DEFAULT CURRENT_TIMESTAMP,
    admin_fname VARCHAR(100),
    admin_lname VARCHAR(100),
    member_fname VARCHAR(100),
    member_lname VARCHAR(100),
    description VARCHAR(200),
    identity VARCHAR(100)
);
ALTER TABLE `reports`
  MODIFY `report_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT= 500;
ALTER TABLE reports
ADD FOREIGN KEY (admin_id) REFERENCES admin(admin_id);
ALTER TABLE reports
ADD FOREIGN KEY (member_id) REFERENCES member(member_id);
ALTER TABLE reports
ADD FOREIGN KEY (trainer_id) REFERENCES trainer(trainer_id);
  






