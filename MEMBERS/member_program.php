<?php 
session_start();
require('connect.php');

$id = $_REQUEST['id'];
$newID = intval($id) ;
$sql = "SELECT * FROM `member` WHERE `program_id` = $newID ORDER BY date_registered DESC ";
$res = mysqli_query($conn, $sql);

//$sql1 = "SELECT * FROM `program` WHERE `program_id` = $newID ORDER BY program_id DESC ";
//$res1 = mysqli_query($conn, $sql1);

if(mysqli_num_rows($res) > 0) {
  $data = array();
  while($row = mysqli_fetch_assoc($res)) {
    $data[] = $row;
  }

  echo json_encode($data);
} else {
  echo 0;
}




?>