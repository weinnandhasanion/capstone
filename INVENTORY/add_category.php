<?php 
require "./../connect.php";
session_start();

$admin = $_SESSION["admin_id"];

$name = $_POST["category-name"];
$dateNow = date("Y-m-d H:i:s");

$sql = "SELECT * FROM category WHERE category_name = '$name'";
$res = mysqli_query($conn, $sql);

if($res) {
  if(mysqli_num_rows($res) > 0) {
    echo json_encode("Category name already exists.");
  } else {
    $sql = "INSERT INTO category (category_name, datetime_added)
      VALUES ('$name', '$dateNow')";
    $res = mysqli_query($conn, $sql);

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