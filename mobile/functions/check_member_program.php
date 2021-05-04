<?php 
require "./connect.php";
session_start();

$id = $_SESSION["member_id"];

$sql = "SELECT program_id FROM member WHERE member_id = $id";
$res = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($res);

if(empty($row["program_id"])) {
  echo false;
} else {
  $sql = "SELECT program_name, amount FROM program WHERE program_id = ". $row["program_id"];
  $res = mysqli_query($con, $sql);
  $row = mysqli_fetch_assoc($res);

  $obj = (object) [
    "program_name" => $row["program_name"],
    "program_amount" => $row["amount"]
  ];

  echo json_encode($obj);
}
?>