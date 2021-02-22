<?php 
require "./connect.php";
session_start();

$id = $_GET["id"];

$sql = "UPDATE member_notifs SET status = 'Deleted' WHERE id = $id";
$res = mysqli_query($con, $sql);
$resp;
if($res) {
  $resp = 1;
} else {
  $resp = 0;
}

echo $resp;
?>