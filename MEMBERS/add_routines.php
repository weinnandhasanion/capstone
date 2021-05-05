<?php 
require "./../connect.php";

$name = $_POST["name"];
$type = $_POST["type"];
$sets = intval($_POST["sets"]);
$reps = intval($_POST["reps"]);
$link = $_POST["link"];

$sql = "INSERT INTO routines (routine_name, routine_type, routine_sets, routine_reps, routine_link)
        VALUES ('$name', '$type', $sets, $reps, '$link')";
$res = mysqli_query($conn, $sql);

if($res) {
  echo json_encode("success");
} else {
  echo json_encode(mysqli_error($conn));
}
?>