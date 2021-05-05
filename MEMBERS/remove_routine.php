<?php 
require "./../connect.php";

$id = $_GET["id"];

$sql = "DELETE FROM routines WHERE routine_id = $id";
$res = mysqli_query($conn, $sql);

if($res) {
  echo json_encode("success");
} else {
  echo json_encode(mysqli_error($conn));
}
?>