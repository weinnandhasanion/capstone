<?php 
require "./connect.php";

$new = $_POST["new_pass"];
$confirm = $_POST["confirm_pass"];
$email = $_POST["email"];
$random = rand(10000, 99999);

if($new == $confirm) {
  $passw = password_hash($new, PASSWORD_DEFAULT);
  $sql = "UPDATE admin SET password = '$passw', code = $random WHERE username = '$email'";
  if(mysqli_query($conn, $sql)) {
    echo json_encode("success");
  } else {
    echo json_encode(mysqli_error($conn));
  }
} else {
  echo json_encode("Passwords do not match. Please try again.");
}
?>