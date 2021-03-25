<?php 
session_start();
require('./../connect.php');

$id = $_REQUEST['id'];
$newID = intval($id) ;
$sql = "SELECT * FROM `logtrail_doing` WHERE `login_id` = $newID ORDER BY logtrail_doing_id DESC ";
$res = mysqli_query($conn, $sql);

if(mysqli_num_rows($res) > 0) {
  $data = array();
  while($row = mysqli_fetch_assoc($res)) {
    $data[] = $row;
  }

  echo json_encode($data);
} else {
  echo json_encode(0);
}
?>
