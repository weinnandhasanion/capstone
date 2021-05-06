<?php
session_start();
require('./../connect.php');
date_default_timezone_set('Asia/Manila');
if ($_SESSION['admin_id']) {
  $session_admin_id = $_SESSION['admin_id'];
}

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$address = $_POST['address'];
$birthdate = $_POST['birthdate'];
$phone = $_POST['phone'];
$gender = $_POST['gender'];
$date_hired = date("Y-m-d");

//---- query validations
$check_name = "SELECT * from trainer where first_name='$first_name' AND last_name='$last_name'";
$duplicate_name = mysqli_query($conn, $check_name);

$check_email = "SELECT * from trainer where email='$email'";
$duplicate_email = mysqli_query($conn, $check_email);

$check_phone = "SELECT * from trainer where phone='$phone'";
$duplicate_phone = mysqli_query($conn, $check_phone);
//--------------

//REGEX
$phoneregex = "/[a-zA-Z]/";
$Fnameregex = "/[0-9]/";
$Lnameregex = "/[0-9]/";
$specialCharacterRegex  = "/[\\W_]/";

if (preg_match($Lnameregex, $last_name, $match)) {
  echo json_encode("Invalid last name. Please make sure there are no numbers.");
} else if (strlen($last_name) > 20) {
  echo json_encode("Invalid last name. Maximum of 20 letters only.");
} else if (strlen($first_name) > 20) {
  echo json_encode("Invalid first name. Maximum of 20 letters only.");
} else if (preg_match($specialCharacterRegex, $phone, $match)) {
  echo json_encode("Please enter a valid phone number.");
} else if (strlen($address) < 5) {
  echo json_encode("Too short for an address.");
}
//VALIDATION IF EMAIL IS ALREADY TAKEN.. 
else if (mysqli_num_rows($duplicate_email) > 0) {
  echo json_encode("Email address is already taken.");
} else if (strlen($email) > 40) {
  echo json_encode("Invalid email address. Maximum of 40 letters only.");
}
//VALIDATION IF PHONE IS ALREADY TAKEN.. 
else if (mysqli_num_rows($duplicate_phone) > 0) {
  echo json_encode("Phone number is already taken.");
}
//VALIDATION IF NAME IS ALREADY TAKEN.. 
else if (mysqli_num_rows($duplicate_name) > 0) {
  echo json_encode("Name is already taken.");
}
//VALIDATION IF NAAY NUMBERS ANG GI INPUT NMO SA FIRSTNAME.. 
else if (preg_match($Fnameregex, $first_name, $match)) {
  echo json_encode("Invalid first name. Please make sure there are no numbers.");
}

//VALIDATION IF NAAY LETTERS ANG GI INPUT NMO SA CONTACT NUMBER.. IF WALA MO PROCEED SHA SA NEXT CHECKING
else if (preg_match($phoneregex, $phone, $match)) {
  echo json_encode("Please enter a valid phone number.");
}
// CHECK IF 11 DIGIT IMONG PHONE NUMBER IF DLE MO EXIT SHA SA ELSE
else if (strlen($phone) < 10) {
  echo json_encode("Please enter a valid phone number.");
} else if (strlen($phone) > 11) {
  echo json_encode("Please enter a valid phone number.");
} else if (!checkBirthdate($birthdate)) {
  echo json_encode("Invalid birthdate. Must be 20 years or older.");
} else if (!checkValidBdate($birthdate)) {
  echo json_encode("Invalid birthdate. Please enter a valid date.");
} else {
  if (preg_match('/^[a-zA-Z]+( [a-zA-Z]+)*$/', $first_name, $match)) {
    if (preg_match('/^[a-zA-Z]+( [a-zA-Z]+)*$/', $last_name, $match)) {
      $sql = "INSERT INTO `trainer` ( `first_name`,`last_name`,`email`,
            `address`,`birthdate`,`phone`,`gender`,date_hired)
             VALUES ( '$first_name', '$last_name', '$email', '$address',
            '$birthdate',  '$phone', '$gender','$date_hired')";
      $res = mysqli_query($conn, $sql);

      if ($res) {
        //this is for puting member_id in the array
        $data = array();
        $trainer_id;
        $sql3 = "SELECT * FROM trainer ORDER BY trainer_id DESC";
        $res3 = mysqli_query($conn, $sql3);
        if ($res3) {
          while ($row = mysqli_fetch_assoc($res3)) {
            $data[] = $row["trainer_id"];
          }

          $trainer_id = $data[0];
        }

        //this is for puting login_id in the array
        $data_logtrail = array();
        $login_id;
        $log = "SELECT * FROM logtrail ORDER BY login_id DESC";
        $logtrail = mysqli_query($conn, $log);
        if ($logtrail) {
          while ($rowrow = mysqli_fetch_assoc($logtrail)) {
            $data_logtrail[] = $rowrow["login_id"];
          }

          $login_id = $data_logtrail[0];
        }

        // INSERTING  ADMIN INFO FOR THE LOGTRAIL DOING
        $ad = "SELECT * FROM admin WHERE admin_id = $session_admin_id";
        $query_runad = mysqli_query($conn, $ad);
        $rowed = mysqli_fetch_assoc($query_runad);

        $admin_id = $rowed["admin_id"];

        // INSERTING MEMBER INFO FOR THE LOGTRAIL DOING
        $ew = "SELECT * FROM trainer WHERE trainer_id = '$trainer_id'";
        $query_runew = mysqli_query($conn, $ew);
        $rowew = mysqli_fetch_assoc($query_runew);

        $trainer_id_new = $rowew["trainer_id"];
        $user_fname = $rowew["first_name"];
        $user_lname = $rowew["last_name"];
        $fullname = $user_fname . ' ' . $user_lname;
        $description = "Added a trainer";
        //$description = $echo.' '.$fullname;
        $identity = "Trainers";
        $timeNow = date("h:i A");


        // INSERTING LOGTRAIL INFO  FOR THE LOGTRAIL DOING
        $sql22 = "SELECT * FROM logtrail WHERE login_id = '$login_id'";
        $query_run22 = mysqli_query($conn, $sql22);
        $rows22 = mysqli_fetch_assoc($query_run22);

        $login_id_new = $rows22["login_id"];

        $sql1 = "INSERT INTO `logtrail_doing` ( `login_id`,`admin_id`,`trainer_id`,`user_fname`,`user_lname`,
          `description`, `identity`,`time`)
          VALUES ( '$login_id_new','$admin_id', '$trainer_id_new', '$user_fname','$user_lname','$description','$identity', '$timeNow')";
        $res = mysqli_query($conn, $sql1);

        if ($res) {
          echo json_encode("success");
        } else {
          echo json_encode(mysqli_error($conn));
        }
      } else {
        echo json_encode(mysqli_error($conn));
      }
    } else {
      echo json_encode("Invalid last name. Please make sure there are no special characters.");
    }
  } else {
    echo json_encode("Invalid first name. Please make sure there are no special characters.");
  }
}


function checkBirthdate($date)
{
  $today = date("Y-m-d");
  $byear = intval(date("Y", strtotime($date)));
  $year = intval(date("Y", strtotime($today)));

  $x = ($year - $byear < 20) ? false : true;

  return $x;
}

function checkValidBdate($date)
{
  $year = intval(date("Y", strtotime($date)));
  $now = intval(date("Y"));

  $x = ($year < 1910 || $year > $now) ? false : true;

  return $x;
}
?>