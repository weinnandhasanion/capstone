<?php 
session_start();
require('connect.php');

$id = $_REQUEST['id'];


$sql = "SELECT * FROM `paymentlog` WHERE `payment_id` = " . intval($id) . "";
$res = mysqli_query($conn, $sql);


if($row = mysqli_fetch_assoc($res)) {
  $row["date_payment"] = date("M d, Y", strtotime($row["date_payment"]));
  echo json_encode($row);
}
?>