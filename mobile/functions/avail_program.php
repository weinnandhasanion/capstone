<?php 
require "./connect.php";
session_start();

$id = $_SESSION["member_id"];
$programId = $_POST["program_id"];

$sql = "UPDATE member SET program_id = $programId WHERE member_id = $id";
if(mysqli_query($con, $sql)) {
  echo json_encode("success");
} else {
  echo json_encode(mysqli_error($con));
}
?>