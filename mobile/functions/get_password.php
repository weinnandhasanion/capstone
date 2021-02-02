<?php 
require "./connect.php";
session_start();

$pass = $_POST["pass"];

$sql = "SELECT * FROM member WHERE member_id = '". $_SESSION["member_id"] ."'";
$res = mysqli_query($con, $sql);

if($row = mysqli_fetch_assoc($res)) {
  if(password_verify($pass, $row["password"])) {
    echo 1;
  } else {
    echo 0;
  }
} else {
  echo 0;
}
?>