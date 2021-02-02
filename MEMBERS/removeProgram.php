<?php 
session_start();
require('connect.php');

$id = $_REQUEST['id'];
$date_deleted = date("Y-m-d");

$ox = "UPDATE program SET program_status = 'remove',date_deleted = '$date_deleted' 
WHERE program_id = " . intval($id) . "";     

if(mysqli_query($conn, $ox))
        json_encode('success');
else
        echo mysqli_error($conn), 'NOT UPDATED';    
?>