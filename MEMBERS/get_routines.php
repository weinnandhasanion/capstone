<?php 
require "./../connect.php";

$sql = "SELECT * FROM routines ORDER BY routine_name ASC";
$res = mysqli_query($conn, $sql);
$data = array();

if($res) {
  while($row = mysqli_fetch_assoc($res)) {
    $data[] = $row;
  }
}

echo json_encode($data);
?>