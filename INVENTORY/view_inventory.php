<?php 
require "./../connect.php";
session_start();

$id = $_GET["id"];

$sql = "SELECT i.*, c.category_name
  FROM inventory AS i
  INNER JOIN category AS c
  ON i.category_id = c.category_id
  WHERE i.inventory_status = 'notdeleted'
  AND i.inventory_id = $id
  ORDER BY i.inventory_id DESC";
$res = mysqli_query($conn, $sql);

if($res) {
  $row = mysqli_fetch_assoc($res);
  $row["date_added"] = date("M d, Y", strtotime($row["date_added"]));
  $row["inventory_damage"] = $row["inventory_damage"] == null ? 0 : $row["inventory_damage"];
  $row["inventory_category"] = $row["category_id"];
  echo json_encode($row);
}
?>