<?php 
require "./connect.php";
session_start();
date_default_timezone_set('Asia/Manila');

$sql = "SELECT * FROM member
        WHERE member_id = '".$_SESSION["member_id"]."'";
$res = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($res);

$data = json_decode($_POST["data"]);
$memberId = $_SESSION["member_id"];
$fname = $row["first_name"];
$lname = $row["last_name"];
$paymentDate = date("Y-m-d", strtotime($data->paymentDate));
$paymentTime = date("h:i A", strtotime($data->paymentDate));
$programId = $data->program;
$onlinePaymentId = $data->paymentId;

$sql = "UPDATE member SET program_id = $programId WHERE member_id = $memberId";
if(mysqli_query($con, $sql)) {
  $item = $data->items[0];
  $am = $item->unit_amount;
  $sql = "INSERT INTO paymentlog (member_id, first_name, last_name, payment_amount, member_type, payment_description, payment_type, date_payment, time_payment, online_payment_id)
          VALUES ($memberId, '$fname', '$lname', '".substr($am->value, 0, -3)."', 'Regular', '$item->name', 'Online', '$paymentDate', '$paymentTime', '$onlinePaymentId')";
  $res = $con->query($sql);

  if($res) {
    echo json_encode("success");
  } else {
    echo json_encode(mysqli_error($con));
  }
}
?>