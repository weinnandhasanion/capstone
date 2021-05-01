<?php 
require "./../connect.php";

$id = $_GET["id"];

$sql = "UPDATE member SET program_id = NULL WHERE member_id = $id";
if(mysqli_query($conn, $sql)) {
  echo json_encode("success");
} else {
  echo json_encode(mysqli_error($conn));
}
?>