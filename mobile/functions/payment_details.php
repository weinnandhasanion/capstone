<?php 
require "./connect.php";
session_start();

$id = $_POST["id"];
$sql = "SELECT * FROM paymentlog WHERE payment_id = $id";
$res = mysqli_query($con, $sql);
if($res) {
  $data = mysqli_fetch_assoc($res);

  $date = date("M d, Y", strtotime($data["date_payment"]));
  $data["date_payment"] = $date;

  echo json_encode($data);
} else {
  echo "Error";
}
?>