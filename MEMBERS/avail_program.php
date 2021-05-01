<?php 
require "./../connect.php";
date_default_timezone_set('Asia/Manila');

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
      echo json_encode("success");
    }
  }
} else {
  echo json_encode(mysqli_error($conn));
}
?>