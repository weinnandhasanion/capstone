<?php 
require "./connect.php";
session_start();

$id = $_GET["id"];

$sql = "SELECT * FROM inventory WHERE inventory_id = $id";
$res = mysqli_query($conn, $sql);

if($res) {
  $row = mysqli_fetch_assoc($res);
  $row["date_added"] = date("M d, Y", strtotime($row["date_added"]));
  $row["inventory_damage"] = $row["inventory_damage"] == null ? 0 : $row["inventory_damage"];
  echo json_encode($row);
}
?>