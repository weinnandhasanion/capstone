<?php 
require "./connect.php";
session_start();

if(isset($_POST)) {
  $id = $_POST["id"];

  $sql = "UPDATE member SET program_id = $id WHERE member_id = '".$_SESSION["member_id"]."'";
  $res = mysqli_query($con, $sql);
  if($res) {
    echo 1;
  } else {
    echo 0;
  }
}
?>