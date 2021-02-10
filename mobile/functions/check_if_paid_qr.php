<?php 
require "./connect.php";
$id = $_GET["id"];

$sql = "SELECT first_name, last_name, member_status FROM member WHERE member_id = $id";
$res = mysqli_query($con, $sql);
if($res) {
  $row = mysqli_fetch_assoc($res);
  $fn = $row["first_name"];
  $ln = $row["last_name"];

  if($row["member_status"] == "Paid") {
    echo "$fn $ln ($id) is currently subscribed.";
  } else {
    echo "$fn $ln ($id) is not subscribed. Please pay your subscription.";
  }
}
?>