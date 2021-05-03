<?php 
require "./connect.php";
session_start();

$id = $_SESSION["member_id"];

$sql = "SELECT * FROM memberpromos WHERE member_id = $id AND status = 'Active'";
if(mysqli_query($con, $sql)) {
  if(mysqli_num_rows(mysqli_query($con, $sql)) > 0) {
    echo json_encode("true");
  } else {
    echo json_encode("false");
  }
} else {
  echo json_encode(mysqli_error($con));
}
?>