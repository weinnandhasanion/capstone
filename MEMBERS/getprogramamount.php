<?php 
require "./../connect.php";

$id = $_GET["id"];

$sql = "SELECT amount FROM program WHERE program_id = $id";
$res = mysqli_query($conn, $sql);

if($res) {
  $row = mysqli_fetch_assoc($res);

  echo json_encode($row["amount"]);
}
?>