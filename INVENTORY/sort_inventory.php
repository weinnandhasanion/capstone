<?php 
require "./connect.php";
session_start();

$type = $_GET["type"];

$data = array();
if($type == "cardio") {
  $sql = "SELECT * FROM inventory
          WHERE inventory_category = 'Cardio Equipment' AND inventory_status = 'notdeleted'
          ORDER BY inventory_id DESC";
  $res = mysqli_query($conn, $sql);
  if($res) {
    while($row = mysqli_fetch_assoc($res)) {
      $data[] = $row;
    }
  }
} else if($type == "weights") {
  $sql = "SELECT * FROM inventory
          WHERE inventory_category = 'Weight Equipment'  AND inventory_status = 'notdeleted'
          ORDER BY inventory_id DESC";
  $res = mysqli_query($conn, $sql);
  if($res) {
    while($row = mysqli_fetch_assoc($res)) {
      $data[] = $row;
    }
  }
} else {
  $sql = "SELECT * FROM inventory WHERE inventory_status = 'notdeleted'
          ORDER BY inventory_id DESC";
  $res = mysqli_query($conn, $sql);
  if($res) {
    while($row = mysqli_fetch_assoc($res)) {
      $data[] = $row;
    }
  }
}

echo json_encode($data);
?>