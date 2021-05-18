<?php 
require "./../connect.php";

$sql = "SELECT i.*, c.category_name FROM inventory AS i
  INNER JOIN category AS c
  ON i.category_id = c.category_id
  WHERE i.inventory_status = 'deleted'";
$res = mysqli_query($conn, $sql);
$data = array();

if(mysqli_num_rows($res) > 0) {
  while($row = mysqli_fetch_assoc($res)) {
    $row["date_deleted"] = date("F d Y", strtotime($row["date_deleted"]));
    $row["time_deleted"] = date("h:i A", strtotime($row["time_deleted"]));
    $row["inventory_category"] = $row["category_name"];
    $data[] = $row;
  }
}

echo json_encode($data);
?>