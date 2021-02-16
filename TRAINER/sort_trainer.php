<?php 
require "./connect.php";
session_start();

$type = $_REQUEST["type"];

switch($type) {
  case "active":
    $sql = "SELECT * FROM trainer WHERE trainer_status = 'active' AND acc_status = 'able' ORDER BY trainer_id DESC";
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
  case "inactive":
    $sql = "SELECT * FROM trainer WHERE trainer_status = 'inactive' AND acc_status = 'able' ORDER BY trainer_id DESC";
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
    $sql = "SELECT * FROM trainer WHERE acc_status = 'able'  ORDER BY trainer_id DESC";
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