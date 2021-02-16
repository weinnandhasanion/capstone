<?php 
session_start();
require('connect.php');

$id = $_REQUEST['id'];

$sql = "SELECT * FROM `program` WHERE `program_id` = " . intval($id) . "";
$res = mysqli_query($conn, $sql);

if($row = mysqli_fetch_assoc($res)) {
  $row["upper_1_day_1"] = getName($row["upper_1_day_1"]);
  $row["upper_2_day_1"] = getName($row["upper_2_day_1"]);
  $row["upper_3_day_1"] = getName($row["upper_3_day_1"]);
  $row["upper_1_day_2"] = getName($row["upper_1_day_2"]);
  $row["upper_2_day_2"] = getName($row["upper_2_day_2"]);
  $row["upper_3_day_2"] = getName($row["upper_3_day_2"]);
  $row["upper_1_day_3"] = getName($row["upper_1_day_3"]);
  $row["upper_2_day_3"] = getName($row["upper_2_day_3"]);
  $row["upper_3_day_3"] = getName($row["upper_3_day_3"]);
  $row["lower_1_day_1"] = getName($row["lower_1_day_1"]);
  $row["lower_2_day_1"] = getName($row["lower_2_day_1"]);
  $row["lower_3_day_1"] = getName($row["lower_3_day_1"]);
  $row["lower_1_day_2"] = getName($row["lower_1_day_2"]);
  $row["lower_2_day_2"] = getName($row["lower_2_day_2"]);
  $row["lower_3_day_2"] = getName($row["lower_3_day_2"]);
  $row["lower_1_day_3"] = getName($row["lower_1_day_3"]);
  $row["lower_2_day_3"] = getName($row["lower_2_day_3"]);
  $row["lower_3_day_3"] = getName($row["lower_3_day_3"]);
  $row["abdominal_day_1"] = getName($row["abdominal_day_1"]);
  $row["abdominal_day_2"] = getName($row["abdominal_day_2"]);
  $row["abdominal_day_3"] = getName($row["abdominal_day_3"]);
  echo json_encode($row);
}

function getName($id) {
  include "./connect.php";
  $sql = "SELECT routine_name FROM routines WHERE routine_id = $id";
  $result = mysqli_query($conn, $sql);

  if($row = mysqli_fetch_assoc($result)) {
    return $row["routine_name"];
  }
}
?>