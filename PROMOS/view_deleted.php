<?php 
require "./connect.php";
session_start();

$sql = "SELECT * FROM promo ORDER BY date_deleted DESC";
$res = mysqli_query($conn, $sql);
$data = array();
if($res) {
  if(mysqli_num_rows($res) > 0) {
    while($row = mysqli_fetch_assoc($res)) {
      $row["date_deleted"] = date("M d, Y", strtotime($row["date_deleted"]));
      $data[] = $row;
    }

    echo json_encode($data);
  } else {
    echo json_encode(0);
  }
} else {
  echo mysqli_error($conn);
}
?>