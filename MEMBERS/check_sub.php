<?php 
require "./../connect.php";

$id = $_GET["id"];
$today = date("Y-m-d");
$res;

$sql = "SELECT * FROM member WHERE member_id = $id";
$row = mysqli_fetch_assoc(mysqli_query($conn, $sql));

if(empty($row["monthly_start"])) {
  $res = "inactive";
} else if($row["monthly_end"] < $today) {
  $res = "inactive";
} else {
  $res = "active";
}

echo json_encode($res);
?>