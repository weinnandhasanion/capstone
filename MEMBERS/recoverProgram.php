<?php 
session_start();
require('connect.php');

$id = $_REQUEST['id'];

$ox = "UPDATE program SET program_status = 'active'
WHERE program_id = " . intval($id) . "";     

if(mysqli_query($conn, $ox))
        json_encode('success');
else
        echo mysqli_error($conn), 'NOT UPDATED';    
?>