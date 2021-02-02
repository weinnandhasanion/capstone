<?php 
session_start();
require('connect.php');

if($_SESSION['admin_id']){
  $session_admin_id = $_SESSION['admin_id'];
}

$id = $_REQUEST['id'];

$ox = "UPDATE member SET member_type = 'Walk-in' WHERE member_id = " . intval($id) . ""; 
$res = mysqli_query($conn, $ox);

if($row = mysqli_fetch_assoc($res)) {
  echo json_encode($row);
}

// INSERTINGN REPORTS FOR THE ADMIN INFO
$sql0 = "SELECT first_name,last_name,admin_id FROM admin WHERE admin_id = $session_admin_id";
$query_run = mysqli_query($conn, $sql0);
$rows = mysqli_fetch_assoc($query_run);

$admin_fname = $rows["first_name"];
$admin_lname = $rows["last_name"];
$admin_id = $rows["admin_id"];
$description = "Updated to Walk-in";

// INSERTINGN REPORTS FOR THE MEMBER INFO
$sql0 = "SELECT first_name,last_name,member_id FROM member WHERE member_id = $id";
$query_run = mysqli_query($conn, $sql0);
$rows = mysqli_fetch_assoc($query_run);

$member_fname = $rows["first_name"];
$member_lname = $rows["last_name"];
$member_id = $rows["member_id"];
$identity = "member";

$sql1 = "INSERT INTO `reports` ( `admin_id`,`admin_fname`,`admin_lname`,
member_id, member_fname,member_lname,`description`,`identity`)
VALUES ( '$admin_id', '$admin_fname', '$admin_lname','$member_id','$member_fname','$member_lname', '$description','$identity')";
$query_run = mysqli_query($conn, $sql1);
?>