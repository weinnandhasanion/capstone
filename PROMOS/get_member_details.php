<?php 
require "./../connect.php";
session_start();

$memberId = $_POST["member_id"];

$sql = "SELECT last_name, first_name, member_status FROM member WHERE member_id = $memberId";
$res = mysqli_query($conn, $sql);

if($res) {
  $data = mysqli_fetch_assoc($res);

  echo json_encode($data);
} else {
  echo 0;
}
?>