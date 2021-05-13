<?php 
require "./../connect.php";
date_default_timezone_set('Asia/Manila');
session_start();

$session = $_SESSION["admin_id"];

$memberId = $_POST["memberId"];
$programId = $_POST["programId"];
$amount = $_POST["amount"];
$isActive = $_POST["isActive"];

$sql1 = "SELECT * FROM member WHERE member_id = $memberId";
$row = mysqli_fetch_assoc(mysqli_query($conn, $sql1));
$first_name = $row["first_name"];
$last_name = $row["last_name"];
$member_type = $row["member_type"];
$timeNow = date("h:i A");
$dateNow = date("Y-m-d");

$sql = "UPDATE member SET program_id = $programId
        WHERE member_id = $memberId";
$res = mysqli_query($conn, $sql);

if($res) {
  if($isActive == "false") {
    echo json_encode("success");
  } else {
    $sql2 = "INSERT INTO `paymentlog` (`member_id`, `first_name`, `last_name`, `time_payment`, `date_payment`,
            `payment_description`, `payment_amount`, `member_type`, `payment_type`)
            VALUES ('$memberId', '$first_name', '$last_name', '$timeNow', '$dateNow', 'Program Fee', ".intval($amount).", '$member_type', 'Cash')";
    $res2 = mysqli_query($conn, $sql2);

    if($res2) {
      $sql = "SELECT * FROM logtrail WHERE admin_id = $session ORDER BY login_id DESC";
      $res = mysqli_query($conn, $sql);
      $data = array();
      while($row = mysqli_fetch_assoc($res)) {
        $data[] = $row;
      }
      $login_id = $data[0]["login_id"];
      $timeNow = date("h:i A");

      $sql = "INSERT INTO logtrail_doing (login_id, admin_id, description, user_fname, user_lname, identity, time)
        VALUES ($login_id, $session, 'Paid program fee', '$first_name', '$last_name', 'Members', '$timeNow')";
      if (mysqli_query($conn, $sql)) {
        echo json_encode("success");
      } else {
        echo json_encode(mysqli_error($conn));
      }
    }
  }
} else {
  echo json_encode(mysqli_error($conn));
}
?>