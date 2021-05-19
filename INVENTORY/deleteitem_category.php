<?php 
require "./../connect.php";
session_start();
$admin = $_SESSION["admin_id"];

$id = $_GET["id"];

$sql = "SELECT * FROM inventory WHERE category_id = $id";
$res = mysqli_query($conn, $sql);
if($res) {
  if(mysqli_num_rows($res) <= 0) {
    echo json_encode("Cannot delete category. There are existing items in this category.");
  } else {
    $set = "SET foreign_key_checks = 0";
    $res1 = mysqli_query($conn, $set);
    $sql = "DELETE FROM inventory WHERE category_id = $id";
    $res = mysqli_query($conn, $sql);
    $set = "SET foreign_key_checks = 1";
    $res1 = mysqli_query($conn, $set);

    if($res) {
      echo json_encode("success");
    } else {
      echo json_encode(mysqli_error($conn));
    }
  }
} else {
  echo json_encode(mysqli_error($conn));
}
?>