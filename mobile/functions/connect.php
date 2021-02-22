<?php 
date_default_timezone_set('Asia/Manila');
$con = new mysqli("localhost", "root", "", "gym");

if(mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}
?>