<?php 
require "./connect.php";

$id = $_GET["id"];

$sql = "SELECT program_name, amount FROM program WHERE program_id = $id";
$row = mysqli_fetch_assoc(mysqli_query($con, $sql));

$data = (object) [
  "name" => $row["program_name"],
  "amount" => $row["amount"]
];

echo json_encode($data);
?>