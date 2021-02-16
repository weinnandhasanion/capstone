<?php 
require "./connect.php";
session_start();

$sql = "SELECT * FROM routines";
$res = mysqli_query($con, $sql);
if($res) {
  $data = array();
  while($row = mysqli_fetch_assoc($res)) {
    $data[] = $row;
  }

  echo json_encode($data);
}
?>