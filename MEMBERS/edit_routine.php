<?php 
require "./../connect.php";

$id = $_POST["id"];
$name = $_POST["name"];
$type = $_POST["type"];
$sets = intval($_POST["sets"]);
$reps = intval($_POST["reps"]);
$link = $_POST["link"];

$sql = "UPDATE routines
        SET routine_name = '$name',
            routine_type = '$type',
            routine_sets = $sets,
            routine_reps = $reps,
            routine_link = '$link'
        WHERE routine_id = $id";
$res = mysqli_query($conn, $sql);

if($res) {
  echo json_encode("success");
} else {
  echo json_encode(mysqli_error($conn));
}
?>