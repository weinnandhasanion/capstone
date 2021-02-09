<?php 
session_start();
require('connect.php');

$id = $_REQUEST['id'];

$sql = "SELECT * FROM `member` WHERE `member_id` = " . intval($id) . "";
$res = mysqli_query($conn, $sql);

if($row = mysqli_fetch_assoc($res)) {
  $getProgramName = "SELECT program_name FROM program WHERE program_id = '".$row["program_id"]."'";
  $result = mysqli_query($conn, $getProgramName);
  $prog = mysqli_fetch_assoc($result);

  $row["program_name"] = $prog["program_name"];
  echo json_encode($row);
}
?>