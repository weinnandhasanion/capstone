<?php 
require "./../connect.php";
session_start();

$type = $_REQUEST["type"];

switch($type) {
  case "seasonal":
    $sql = "SELECT * FROM promo WHERE promo_type = 'Seasonal' AND status = 'Active' ORDER BY date_added DESC";
    $res = mysqli_query($conn, $sql);
    if($res) {
      $data = array();
      while($row = mysqli_fetch_assoc($res)) {
        $data[] = $row;
      }

      echo json_encode($data);
    } else {
      echo NULL;
    }
    break;
  case "permanent":
    $sql = "SELECT * FROM promo WHERE promo_type = 'Permanent' AND status = 'Active' ORDER BY date_added DESC";
    $res = mysqli_query($conn, $sql);
    if($res) {
      $data = array();
      while($row = mysqli_fetch_assoc($res)) {
        $data[] = $row;
      }

      echo json_encode($data);
    } else {
      echo NULL;
    }
    break;
  case "both":
    $sql = "SELECT * FROM promo WHERE status = 'Active' ORDER BY date_added DESC";
    $res = mysqli_query($conn, $sql);
    if($res) {
      $data = array();
      while($row = mysqli_fetch_assoc($res)) {
        $data[] = $row;
      }

      echo json_encode($data);
    } else {
      echo NULL;
    }
    break;
  default:
    echo NULL;
}
?>