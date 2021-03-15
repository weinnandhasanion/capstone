<?php
require "./connect.php";
session_start();

$pass = $_GET["pass"];
$id = $_SESSION["member_id"];

$existing = 1;

$sql = "SELECT password FROM member WHERE member_id = $id";
$query = mysqli_query($con, $sql);

if($query) {
  $row = mysqli_fetch_assoc($query);

  if(password_verify($pass, $row["password"])) {
    $existing = 0;
  } else {
    $existing = 1;
  }
}

echo json_encode($existing);
?>