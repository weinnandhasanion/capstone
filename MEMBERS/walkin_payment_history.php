<?php 
session_start();
require('connect.php');

$id = $_REQUEST['id'];
$newID = intval($id) ;
$sql = "SELECT * FROM `paymentlog` WHERE `member_id` = $newID ORDER BY payment_id DESC ";
$res = mysqli_query($conn, $sql);

if(mysqli_num_rows($res) > 0) {
  $data = array();
  while($row = mysqli_fetch_assoc($res)) {
    $row["date_payment"] = date("M d, Y", strtotime($row["date_payment"]));
    $row["time_payment"] = date("h:i A", strtotime($row["time_payment"]));
    $data[] = $row;
  }

  echo json_encode($data);
} else {
  echo 0;
}
?>
