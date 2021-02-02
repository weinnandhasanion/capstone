<?php 
session_start();
require('connect.php');

$id = $_REQUEST['id'];

$sql1 = "SELECT * FROM `member` WHERE `member_id` = " . intval($id) . "";
$res1 = mysqli_query($conn, $sql1);


if($row = mysqli_fetch_assoc($res1)) {
  echo json_encode($row);
}
?>