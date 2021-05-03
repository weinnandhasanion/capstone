<?php
require "./connect.php";
session_start();

$promo_id = intval($_POST['promo_id']);
$member_id = $_SESSION["member_id"];
$dateNow = date("Y-m-d h:i:s");
$filename = $_FILES['file']['name'];

if (0 < $_FILES['file']['error']) {
  echo json_encode($_FILES['file']['error']);
} else {
  if (move_uploaded_file($_FILES['file']['tmp_name'], './../img/uploads/requests/' . $_FILES['file']['name'])) {
    $sql = "INSERT INTO memberpromos (promo_id, member_id, date_requested, status, request_image) 
    VALUES ($promo_id, $member_id, '$dateNow', 'Pending', '$filename')";
    if(mysqli_query($con, $sql)) {
      echo json_encode("success");
    }
  } else {
    echo json_encode("Image was not uploaded. Please try again.");
  }
}
?>