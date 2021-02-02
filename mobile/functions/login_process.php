<?php 
require "./connect.php";
session_start();

$user = $_POST["user"];
$pass = $_POST["pass"];

$sql = "SELECT * FROM `member` WHERE `username` = '$user'";
$query = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($query);

if(!$query) {
  echo 0;
} else if(mysqli_num_rows($query) > 0) {
  if(password_verify($pass, $row['password'])) {
    if($row["member_type"] == "Regular") {
      echo 1;
      $_SESSION["member_id"] = $row["member_id"];
    } else {
      echo 2;
    }
  } 
}
?>