<?php 
require "./connect.php";
session_start();

$id = $_REQUEST["id"];

$sql = "SELECT * FROM promo WHERE promo_id = $id";
$res = mysqli_query($con, $sql);
$data = array();

if(mysqli_num_rows($res) > 0) {
  while($row = mysqli_fetch_assoc($res)) {
    $row["promo_starting_date"] = date("M d Y", strtotime($row["promo_starting_date"]));
    $row["promo_ending_date"] = date("M d Y", strtotime($row["promo_ending_date"]));
    $data[] = $row;
  }

  echo json_encode($data[0]);
} else {
  echo NULL;
}
?>