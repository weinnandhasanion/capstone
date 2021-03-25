<?php 
require "./../connect.php";

if(isset($_GET)) {
  $sql = "SELECT * FROM trainer WHERE trainer_status = 'deleted' ORDER BY trainer_id DESC";
  $res = mysqli_query($conn, $sql);

  if($res) {
    $data = array();
    while($row = mysqli_fetch_assoc($res)) {
      $row["fullname"] = $row["first_name"]." ".$row["last_name"];
      $row["date"] = date("M d, Y", strtotime($row["date_deleted"]));
      $row["time"] = date("h:i A", strtotime($row["time_deleted"]));
      $data[] = $row;
    }

    echo json_encode($data);
  }
}
?>