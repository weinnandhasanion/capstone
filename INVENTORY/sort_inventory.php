<?php 
require "./../connect.php";
session_start();

$type = $_GET["type"];

$data = array();
$sql = "SELECT i.*, c.category_name
  FROM inventory AS i
  INNER JOIN category AS c
  ON i.category_id = c.category_id
  WHERE i.inventory_status = 'notdeleted'
  ORDER BY i.inventory_id DESC";
$res = mysqli_query($conn, $sql);

if($res) {
  while($row = mysqli_fetch_assoc($res)) {
    $row["image_pathname"] = (empty($row["image_pathname"])) ? "./blank.png" : $row["image_pathname"];
    $row["inventory_category"] = $row["category_name"];
    $data[] = $row;
  }
}

echo json_encode($data);
?>