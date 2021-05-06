<?php
session_start();
require('./../connect.php');
date_default_timezone_set('Asia/Manila');

if ($_SESSION['admin_id']) {
  $session_admin_id = $_SESSION['admin_id'];
}

$email = $_POST['email'];
$id = $_POST['member_id'];
$phone = $_POST['phone'];
$member_type = $_POST['member_type'];
$address = $_POST['address'];
$program_id = $_POST["program_id"];
$phoneregex = "/[a-zA-Z]/";
$specialCharacterRegex  = "/[\\W_]/";
$checkSpace = "/\\s/";

$exist = "SELECT * FROM member WHERE member_id != '$id' AND email = '$email'";
$existEmail = mysqli_query($conn, $exist);

$exist = "SELECT * FROM member WHERE member_id != '$id' AND phone = '$phone'";
$existPhone = mysqli_query($conn, $exist);

if (preg_match($phoneregex, $phone, $match)) {
  echo json_encode("Please enter a valid phone number.");
} else if ($email == "") {
  echo json_encode("Email address is empty.");
} else if (preg_match($checkSpace, $email, $match)) {
  echo json_encode("Invalid email address.");
} else if (preg_match($checkSpace, $phone, $match)) {
  echo json_encode("Please enter a valid phone number.");
} else if (preg_match($specialCharacterRegex, $phone, $match)) {
  echo json_encode("Please enter a valid phone number.");
} else if (mysqli_num_rows($existEmail) > 0) {
  echo json_encode("Email address is already taken.");
} else if ($phone == "") {
  echo json_encode("Phone number is empty.");
} else if (strlen($phone) <= 10) {
  echo json_encode("Please enter a valid phone number.");
} else if (strlen($phone) > 11) {
  echo json_encode("Please enter a valid phone number.");
} else if (mysqli_num_rows($existPhone) > 0) {
  echo json_encode("Phone number is already taken.");
} else if ($address == "") {
  echo json_encode("Please enter an address.");
} else {
  if (!empty($program_id)) {
    $sql = "UPDATE member SET email = '$email', address = '$address', phone = '$phone', member_type = '$member_type', program_id = $program_id
    WHERE member_id = '$id'";
    $sql_update = mysqli_query($conn, $sql);

    if ($sql_update) {
      //this is for puting login_id in the array
      $data_logtrail = array();
      $login_id;
      $log = "SELECT * FROM logtrail WHERE admin_id = $session_admin_id ORDER BY login_id DESC";
      $logtrail = mysqli_query($conn, $log);
      if ($logtrail) {
        while ($rowrow = mysqli_fetch_assoc($logtrail)) {
          $data_logtrail[] = $rowrow["login_id"];
        }

        $login_id = $data_logtrail[0];
      }

      // INSERTING  ADMIN INFO FOR THE LOGTRAIL DOING
      $sql0 = "SELECT first_name,last_name FROM admin WHERE admin_id = $session_admin_id";
      $query_run = mysqli_query($conn, $sql0);
      $rows1 = mysqli_fetch_assoc($query_run);

      $first_name = $rows1["first_name"];
      $last_name = $rows1["last_name"];

      // INSERTING MEMBER INFO FOR THE LOGTRAIL DOING
      $sql2 = "SELECT first_name,last_name,member_id FROM member WHERE member_id = '$id'";
      $query_run2 = mysqli_query($conn, $sql2);
      $rows2 = mysqli_fetch_assoc($query_run2);

      $user_fname = $rows2["first_name"];
      $user_lname = $rows2["last_name"];
      $description = "Updated a member";
      $identity = "Members";
      $timeNow = date("h:i A");

      $sql1 = "INSERT INTO `logtrail_doing` ( `login_id`,`admin_id`,`member_id`,`user_fname`,`user_lname`,
              `description`, `identity`,`time`)
              VALUES ( '$login_id','$session_admin_id', '$id', '$user_fname','$user_lname','$description','$identity', '$timeNow')";
      if (mysqli_query($conn, $sql1)) {
        echo json_encode("success");
      } else {
        echo json_encode(mysqli_error($conn));
      }
    } else {
      echo json_encode(mysqli_error($conn));
    }
  } else {
    $sql = "UPDATE member SET email = '$email', address = '$address', phone = '$phone', member_type = '$member_type'
            WHERE member_id = $id";
    $sql_update = mysqli_query($conn, $sql);

    if ($sql_update) {
      //this is for puting login_id in the array
      $data_logtrail = array();
      $login_id;
      $log = "SELECT * FROM logtrail WHERE admin_id = $session_admin_id ORDER BY login_id DESC";
      $logtrail = mysqli_query($conn, $log);
      if ($logtrail) {
        while ($rowrow = mysqli_fetch_assoc($logtrail)) {
          $data_logtrail[] = $rowrow["login_id"];
        }

        $login_id = $data_logtrail[0];
      }

      // INSERTING  ADMIN INFO FOR THE LOGTRAIL DOING
      $sql0 = "SELECT first_name,last_name FROM admin WHERE admin_id = $session_admin_id";
      $query_run = mysqli_query($conn, $sql0);
      $rows1 = mysqli_fetch_assoc($query_run);

      $first_name = $rows1["first_name"];
      $last_name = $rows1["last_name"];

      // INSERTING MEMBER INFO FOR THE LOGTRAIL DOING
      $sql2 = "SELECT first_name,last_name,member_id FROM member WHERE member_id = $id";
      $query_run2 = mysqli_query($conn, $sql2);
      $rows2 = mysqli_fetch_assoc($query_run2);

      $user_fname = $rows2["first_name"];
      $user_lname = $rows2["last_name"];
      $description = "Updated a member";
      $identity = "Members";
      $timeNow = date("h:i A");

      $sql1 = "INSERT INTO `logtrail_doing` ( `login_id`,`admin_id`,`member_id`,`user_fname`,`user_lname`,
              `description`, `identity`,`time`)
              VALUES ( '$login_id','$session_admin_id', '$id', '$user_fname','$user_lname','$description','$identity', '$timeNow')";
      if (mysqli_query($conn, $sql1)) {
        echo json_encode("success");
      } else {
        echo json_encode(mysqli_error($conn));
      }
    } else {
      echo json_encode(mysqli_error($conn));
    }
  }
}
