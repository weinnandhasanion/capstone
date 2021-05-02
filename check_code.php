<?php 
require "./connect.php";

$code = $_GET["code"];
$email = $_GET["email"];

$sql = "SELECT code FROM admin WHERE username = '$email'";
$row = mysqli_fetch_assoc(mysqli_query($conn, $sql));

if($row["code"] == $code) {
  echo json_encode("success");
} else {
  echo json_encode("fail");
}
?>