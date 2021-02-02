<?php
require "./connect.php";
session_start();

$user = $_POST["user"];
$email = $_POST["email"];
$phone = $_POST["phone"];
$birthdate = $_POST["birthdate"];
$address = $_POST["address"];

$sql = "UPDATE member SET username = '". $user ."', email = '". $email ."', phone = '". $phone ."', birthdate = '". $birthdate ."', 
      address = '". $address ."' WHERE member_id = '". $_SESSION["member_id"] ."'";
$result = mysqli_query($con, $sql);

if($result) {
  echo 1;
} else {
  echo 0;
}
?>