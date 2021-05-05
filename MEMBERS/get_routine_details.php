<?php 
require "./../connect.php";

$id = $_GET["id"];

$sql = "SELECT * FROM routines WHERE routine_id = $id";
$res = mysqli_query($conn, $sql);

if($res) {
  $row = mysqli_fetch_assoc($res);
}

echo json_encode($row);
?>