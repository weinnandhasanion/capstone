<?php 
require "./connect.php";
session_start();

if(isset($_GET["givemepromoname"])) {
  $id = $_GET["givemepromoname"];
  $sql = "SELECT promo_name FROM promo WHERE promo_id = $id";
  $res = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($res);

  echo $row["promo_name"];
} else {
  $sql = "SELECT * FROM member WHERE member_type = 'Regular' AND isDeleted = 'false'";
  $res = mysqli_query($conn, $sql);
  $data = array();
  if($res) {
    while($row = mysqli_fetch_assoc($res)) {
      $row["fullname"] = $row["first_name"]." ".$row["last_name"];
      $data[] = $row;
    }

    echo json_encode($data);
  } else {
    echo mysqli_error($conn);
  }
}
?>