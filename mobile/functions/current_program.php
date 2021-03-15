<?php 
require "./connect.php";
session_start();

$sql = "SELECT program_id FROM member WHERE member_id = '".$_SESSION["member_id"]."'";
$query = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($query);

echo json_encode($row["program_id"]);
?>