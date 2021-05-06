<?php 
require "./../connect.php";
session_start();

$id = $_REQUEST["id"];

$sql = "SELECT * FROM memberpromos WHERE promo_id = $id AND status = 'Active' ORDER BY id DESC";
$res = mysqli_query($conn, $sql);
if($res) {
  if(mysqli_num_rows($res) > 0) {
    $data = array();
    while($row = mysqli_fetch_assoc($res)) {
      $row["date_added"] = date("M d, Y", strtotime($row["date_added"]));
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