<?php 
require "./connect.php";

if(isset($_GET)) {
  $sql = "SELECT * FROM program WHERE program_status = 'active'";
  $res = mysqli_query($conn, $sql);

  if($res) {
    $data = array();
    while($row = mysqli_fetch_assoc($res)) {
      $data[] = $row;
    }

    echo json_encode($data);
  }
}
?>