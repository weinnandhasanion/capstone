<?php 
require "./connect.php";
session_start();

$pass = password_hash($_POST["pass"], PASSWORD_DEFAULT);

$sql = "UPDATE member SET password = '$pass' WHERE member_id = '". $_SESSION["member_id"] ."'";
$result = mysqli_query($con, $sql);

if($result) {
  echo 1;
} else {
  echo 0;
}
?>