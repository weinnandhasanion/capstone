<?php 
require "./connect.php";

if(isset($_GET)) {
  $sql = "SELECT * FROM paymentlog  ORDER BY payment_id DESC";
  $res = mysqli_query($conn, $sql);

  if($res) {
    $data = array();
    while($row = mysqli_fetch_assoc($res)) {
      $row["fullname"] = $row["first_name"]." ".$row["last_name"];
      $row["date_payment"] = date("M d, Y", strtotime($row["date_payment"]));
      $data[] = $row;
    }

    echo json_encode($data);
  }
}
?>