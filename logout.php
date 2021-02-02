<?php
session_start();
require('connect.php');

$id = $_REQUEST['id'];
    
$sql1 = "UPDATE logtrail SET dateandtime_logout = now()
WHERE login_id = " . intval($id) . "";    


if(mysqli_query($conn, $sql1))
json_encode('success');

else
echo mysqli_error($conn), 'NOT UPDATED'; 


?>

        