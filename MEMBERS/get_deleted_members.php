<?php 
require "./connect.php";

$sql = "SELECT * FROM member WHERE acc_status = 'inactive' AND date_deleted IS NOT NULL";
$res = mysqli_query($conn, $sql);

$data = array();

if($res) {
  while($row = mysqli_fetch_assoc($res)) {
    $row["time_deleted"] = date("h:i A", strtotime($row["time_deleted"]));
    $row["date_deleted"] = date("M d, Y", strtotime($row["date_deleted"]));

    $data[] = $row;
  }
} 

echo json_encode($data);
?>