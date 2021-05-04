<?php 
require "./../connect.php";
session_start();
date_default_timezone_set('Asia/Manila');

if(isset($_GET["id"])) {
  $id = $_GET["id"];

  $sql = "SELECT * FROM member WHERE member_id = $id";
  $res = mysqli_query($conn, $sql);
  $dateNow = date("Y-m-d H:i:s");
  $today = date("Y-m-d");
  $adminId = $_SESSION["admin_id"];

  $message = 'oten';
  $type;

  $monthlyPaid = true;
  $annualPaid = true;

  if($res) {
    if(mysqli_num_rows($res) > 0) {
      $row = mysqli_fetch_assoc($res);

      $earlier = new DateTime($row["monthly_end"]);
      $later = new DateTime($today);
      $diff = $later->diff($earlier)->format("%a");

      if(empty($row["monthly_start"])) {
        $monthlyPaid = false;
      } else if($row["monthly_end"] < $today) {
        $monthlyPaid = false;
      }

      if(empty($row["annual_start"])) {
        $annualPaid = false;
      } else if($row["annual_end"] < $today) {
        $annualPaid = false;
      }

      if(!$monthlyPaid && $annualPaid) {
        if($diff > 7) {     
          $message = $row["first_name"]." ".$row["last_name"]." is not eligible to enter the gym. Please pay monthly subscription first.";
          $type = "red";
          $title = "Error";
        } else {
          $sql = "INSERT INTO member_logtrail (member_id, login_date, scanned_by)
          VALUES $id, '$dateNow', $adminId";
          $res = mysqli_query($conn, $sql);

          $fn = $row["first_name"];
          $ln = $row["last_name"];

          $earlier = new DateTime($today);
          $later = new DateTime(date("Y-m-d", strtotime($row["monthly_end"]. " + 7 days")));

          $diff = $later->diff($earlier)->format("%a");
          $message = "$fn $ln's monthly subscription is expired. $fn only has $diff day(s) left to pay for his/her monthly subscription. $fn can still enter the gym. Login successful.";
          $type = "green";     
          $title = "Success";        
        }
      } else if(!$monthlyPaid && !$annualPaid) {
        $message = $row["first_name"]." ".$row["last_name"]." is not eligible to enter the gym. Please pay annual membership and monthly subscription.";
        $type = "red";
        $title = "Error";
      } else if($monthlyPaid && $annualPaid) {
        $sql = "INSERT INTO member_logtrail (member_id, login_date, scanned_by)
                VALUES ($id, '$dateNow', $adminId)";
        $res = mysqli_query($conn, $sql);

        if($res) {
          $message = $row["first_name"]." ".$row["last_name"]." is subscribed and is eligible to enter the gym. Login successful.";
          $type = "green";
          $title = "Success";
        }
      }
    } else {
      $message = "Member does not exist.";
      $type = "red";
      $title = "Error";
    }
  } else {
    $message = mysqli_error($conn);
    $type = "red";
    $title = "Error";
  }
  
  $obj = (object) [
    "message" => $message,
    "type" => $type,
    "title" => $title
  ];

  echo json_encode($obj);
} else {
  echo json_encode("walay sulod");
}
?>