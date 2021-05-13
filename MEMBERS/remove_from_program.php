<?php 
require "./../connect.php";
session_start();

$session = $_SESSION["admin_id"];

$id = $_GET["id"];

$sql = "UPDATE member SET program_id = NULL WHERE member_id = $id";
if(mysqli_query($conn, $sql)) {
  $sql = "SELECT * FROM  member WHERE member_id = $id";
  $res = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($res);
  $fname = $row["first_name"];
  $lname = $row["last_name"];

  $sql = "SELECT * FROM logtrail WHERE admin_id = $session ORDER BY login_id DESC";
  $res = mysqli_query($conn, $sql);
  $data = array();
  while($row = mysqli_fetch_assoc($res)) {
    $data[] = $row;
  }
  $login_id = $data[0]["login_id"];
  $timeNow = date("h:i A");

  $sql = "INSERT INTO logtrail_doing (login_id, admin_id, description, user_fname, user_lname, identity, time)
    VALUES ($login_id, $session, 'Removed from program', '$fname', '$lname', 'Members', '$timeNow')";
  if (mysqli_query($conn, $sql)) {
    echo json_encode("success");
  } else {
    echo json_encode(mysqli_error($conn));
  }
} else {
  echo json_encode(mysqli_error($conn));
}
?>