<?php 
  require "./connect.php";
  session_start();
  unset($_SESSION["admin_id"]);

  if(isset($_SESSION["admin_id"])) {
    header("Location: ./MEMBERS/members.php");
  } else {
    header("Location: ./index_admin.php");
  }
?>