<?php 
require "./connect.php";
session_start();

$id = $_REQUEST["id"];

$sql = "SELECT * FROM promo WHERE promo_id = ".intval($id);
$res = mysqli_query($conn, $sql);

function formatDate($date) {
  $format = date("M d, Y", strtotime($date));

  return $format;
}

if($res) {
  $data = mysqli_fetch_assoc($res);
  $data["date_added"] = formatDate($data["date_added"]);
  if($data["date_deleted"] != NULL) {
    $data["date_deleted"] = formatDate($data["date_deleted"]);
  }
  $data["promo_starting_date"] = formatDate($data["promo_starting_date"]);
  $data["promo_ending_date"] = formatDate($data["promo_ending_date"]);
  echo json_encode($data);
} else {
  echo mysqli_error($conn);
}
?>