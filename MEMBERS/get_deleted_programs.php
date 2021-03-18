<?php 
require "./connect.php";

$sql = "SELECT * FROM program WHERE program_status = 'inactive'";
$query = mysqli_query($conn, $sql);

$data = array();

if(mysqli_num_rows($query) > 0) {
  while($row = mysqli_fetch_assoc($query)) {
    $row["date_added"] = date("M d, Y", strtotime($row["date_added"]));
    $row["date_deleted"] = date("M d, Y", strtotime($row["date_deleted"]));
    $row["time_deleted"] = date("h:i A", strtotime($row["time_deleted"]));
    $data[] = $row;
  }
}

echo json_encode($data);
?>