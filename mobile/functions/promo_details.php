<?php 
require "./connect.php";
session_start();

$id = $_REQUEST["id"];
$memberId = $_SESSION["member_id"];
$active = "false";

$sql = "SELECT * FROM memberpromos WHERE promo_id = $id AND member_id = $memberId
        AND status = 'Active'";
if(mysqli_query($con, $sql)) {
  if(mysqli_num_rows(mysqli_query($con, $sql)) > 0) {
    $active = "true";
  } else {
    $sql = "SELECT * FROM memberpromos WHERE promo_id = $id AND member_id = $memberId
    AND status = 'Pending'";
    $res = mysqli_query($con, $sql);

    if($res) {
      if(mysqli_num_rows($res) > 0) {
        $active = "pending";
      } else {
        $active = "false";
      }
    } else {
      $active = mysqli_error($con);
    }
  }

  $sql = "SELECT * FROM promo WHERE promo_id = $id";
  $res = mysqli_query($con, $sql);
  $data = array();

  if(mysqli_num_rows($res) > 0) {
    while($row = mysqli_fetch_assoc($res)) {
      $row["promo_starting_date"] = date("M d Y", strtotime($row["promo_starting_date"]));
      $row["promo_ending_date"] = date("M d Y", strtotime($row["promo_ending_date"]));
      $row["active"] = $active;
      $data[] = $row;
    }

    echo json_encode($data[0]);
  } else {
    echo mysqli_error($con);
  }
} else {
  echo mysqli_error($con);
}
?>