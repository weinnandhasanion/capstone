<?php 
session_start();
require('./../connect.php');

$id = $_REQUEST['id'];

$sql = "SELECT * FROM `member` WHERE `member_id` = " . intval($id) . "";
$res = mysqli_query($conn, $sql);

if($row = mysqli_fetch_assoc($res)) {
  echo json_encode($row);
}
?>