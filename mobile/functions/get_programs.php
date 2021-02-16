<?php 
require "./connect.php";
session_start();

if(isset($_GET)) {
  $day = $_GET["day"];
  $memberId = $_SESSION["member_id"];
  $sql = "SELECT program_id FROM member WHERE member_id = $memberId";
  $res = mysqli_query($con, $sql);

  if($res) {
    $row = mysqli_fetch_assoc($res);
    $programId = $row["program_id"];

    $sql = "SELECT * FROM program WHERE program_id = $programId";
    $res = mysqli_query($con, $sql);

    if($res) {
      $row = mysqli_fetch_assoc($res);

      echo json_encode($row);
    }
  }
}
?>