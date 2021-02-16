<?php 
require "./connect.php";

if(isset($_GET)) {
  $sql = "SELECT * FROM trainer WHERE acc_status = 'able' ORDER BY trainer_id DESC";
  $res = mysqli_query($conn, $sql);

  if($res) {
    $data = array();
    while($row = mysqli_fetch_assoc($res)) {
      $row["fullname"] = $row["first_name"]." ".$row["last_name"];
      $data[] = $row;
    }

    echo json_encode($data);
  }
}
?>