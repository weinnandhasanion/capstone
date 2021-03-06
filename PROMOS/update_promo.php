<?php
require "./../connect.php";
session_start();
date_default_timezone_set('Asia/Manila');
if ($_SESSION['admin_id']) {
  $session_admin_id = $_SESSION['admin_id'];
}

$id = $_POST["promo-id-update"];
$name = $_POST["promo-name-update"];
$amount = $_POST["promo-amount-update"];
$desc = $_POST["promo-description-update"];
$type = $_POST["promo-type-update"];
$startDate = date("Y-m-d", strtotime($_POST["promo-start-date-update"]));
$endDate = date("Y-m-d", strtotime($_POST["promo-end-date-update"]));
//REGEX
$letterRegex = "/[a-zA-Z]/";
$numberRegex = "/[0-9]/";
$specialCharacterRegex  = "/[\\W_]/";

$check_name = "SELECT * from promo where promo_name='$name' AND promo_id != '$id'";
$duplicate_name = mysqli_query($conn, $check_name);

if (strlen($name) < 5) {
  echo json_encode("Invalid promo name. Promo name is too short.");
} else if (strlen($name) > 25) {
  echo json_encode("Invalid promo name. Maximum of 25 letters only.");
} else if (mysqli_num_rows($duplicate_name) > 0) {
  echo json_encode("Promo name is already taken.");
} else if ($type == "Seasonal" && $startDate >= $endDate) {
  echo json_encode("Ending date must be greater than starting date!");
} else {
  $checkStart = checkExistingDates($startDate);
  $checkEnd = checkExistingDates($endDate);
  if ($type == "Seasonal" && $checkStart->doesExist) {
    echo json_encode("Starting date is in conflict with " . $checkStart->name . " schedule. Choose another starting date.");
  } else if ($type == "Seasonal" && $checkEnd->doesExist) {
    echo json_encode("Ending date is in conflict with " . $checkEnd->name . " schedule. Choose another ending date.");
  } else {
    $sql = "UPDATE promo
      SET promo_name = '$name', amount = '$amount', promo_description = '$desc', promo_type = '$type', 
          promo_starting_date = '$startDate', promo_ending_date = '$endDate'
      WHERE promo_id = $id";
    $res = mysqli_query($conn, $sql);

    if ($res) {
      $data = array();
      $promo_id;
      $sql3 = "SELECT * FROM promo ORDER BY promo_id DESC";
      $res3 = mysqli_query($conn, $sql3);
      if ($res3) {
        while ($row = mysqli_fetch_assoc($res3)) {
          $data[] = $row["promo_id"];
        }

        $promo_id = $data[0];
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
      $ew = "SELECT * FROM promo WHERE promo_id = '$id'";
      $query_runew = mysqli_query($conn, $ew);
      $rowew = mysqli_fetch_assoc($query_runew);

      $promo_id_new = $rowew["promo_id"];
      $user_fname = $rowew["promo_name"];
      $description = "Update a promo";
      //$description = $echo.' '.$fullname;
      $identity = "Promos";
      $timeNow = date("h:i A");


      // INSERTING LOGTRAIL INFO  FOR THE LOGTRAIL DOING
      $sql22 = "SELECT * FROM logtrail WHERE login_id = '$login_id'";
      $query_run22 = mysqli_query($conn, $sql22);
      $rows22 = mysqli_fetch_assoc($query_run22);

      $login_id_new = $rows22["login_id"];

      $sql1 = "INSERT INTO `logtrail_doing` 
      ( `login_id`,`admin_id`,`promo_id`,`user_fname`,`description`, `identity`,`time`)
        VALUES 
      ( '$login_id_new','$admin_id', '$promo_id_new', '$user_fname','$description','$identity', '$timeNow')";
      $res = mysqli_query($conn, $sql1);

      if ($res) {
        echo json_encode("success");
      } else {
        echo json_encode(mysqli_error($conn));
      }
    } else {
      echo json_encode(mysqli_error($conn));
    }
  }
}

function checkExistingDates($date)
{
  global $conn, $id;

  $sql = "SELECT * FROM promo WHERE status = 'Active'";
  $res = mysqli_query($conn, $sql);
  $existing = false;
  $name = "";

  while ($row = mysqli_fetch_assoc($res)) {
    if (strtotime($date) > strtotime($row["promo_starting_date"]) && strtotime($date) < strtotime($row["promo_ending_date"]) && $id != $row["promo_id"]) {
      $existing = true;
      $name = $row["promo_name"];
      break;
    }
  }

  return (object) [
    "doesExist" => $existing,
    "name" => $name
  ];
}
