<?php 
session_start();
require('connect.php');

$id = $_REQUEST['id'];

$sql = "SELECT member.*, program.program_name 
        FROM member 
        INNER JOIN program 
        ON member.program_id = program.program_id
        WHERE member_id = " . intval($id) . "";
$res = mysqli_query($conn, $sql);

if($row = mysqli_fetch_assoc($res)) {
  echo json_encode($row);
}
?>