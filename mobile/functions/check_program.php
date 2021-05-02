<?php 
require "./connect.php";

$id = $_GET["id"];

$sql = "SELECT program_id FROM member WHERE member_id = $id";
$row = mysqli_fetch_assoc(mysqli_query($con, $sql));

if(empty($row["program_id"])) {
  echo json_encode("false");
} else {
  echo json_encode("true");
}
?>