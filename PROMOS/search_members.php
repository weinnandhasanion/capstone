<?php 
require "./../connect.php";
session_start();

if(isset($_REQUEST["val"])) {
  $val = $_REQUEST["val"];

  $sql = "SELECT * FROM member WHERE member_type = 'Regular' AND first_name LIKE '$val%' OR last_name LIKE '$val%'";
  $res = mysqli_query($conn, $sql);
  $data = array();
  if($res) {
    if(mysqli_num_rows($res) > 0) {
      while($row = mysqli_fetch_assoc($res)) {
        $data[] = $row;
      }
    
      echo json_encode($data);
    } else {
      echo json_encode(0);
    }
  } else {
    echo mysqli_error($conn);
  }
} else {
  $sql = "SELECT * FROM member WHERE member_type = 'Regular'";
  $res = mysqli_query($conn, $sql);
  $data = array();
  if($res) {
    if(mysqli_num_rows($res) > 0) {
      while($row = mysqli_fetch_assoc($res)) {
        $data[] = $row;
      }
    
      echo json_encode($data);
    } else {
      echo mysqli_error($conn);
    }
  } else {
    echo mysqli_error($conn);
  }
}
?>