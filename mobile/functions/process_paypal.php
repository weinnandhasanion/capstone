<?php 
require "./connect.php";
session_start();
date_default_timezone_set('Asia/Manila');

$sql = "SELECT first_name, last_name FROM member
        WHERE member_id = '".$_SESSION["member_id"]."'";
$res = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($res);

$data = json_decode($_POST["data"]);
$memberId = $_SESSION["member_id"];
$fname = $row["first_name"];
$lname = $row["last_name"];
$paymentDate = date("Y-m-d", strtotime($data->paymentDate));
$paymentTime = date("h:i A", strtotime($data->paymentDate));
$onlinePaymentId = $data->paymentId;
$ok = 0;
if(count($data->items) > 0) {
  foreach($data->items as $item) {
    $am = $item->unit_amount;
    $sql = "INSERT INTO paymentlog (member_id, first_name, last_name, payment_amount, payment_description, payment_type, date_payment, time_payment, online_payment_id)
            VALUES ($memberId, '$fname', '$lname', '".substr($am->value, 0, -3)."', '$item->name', 'Online', '$paymentDate', '$paymentTime', '$onlinePaymentId')";
    $res = $con->query($sql);
    if($res) {
      $ok++;
    } else {
      echo "error: ". mysqli_error($con);
    }
  }
}

echo $ok;
?>