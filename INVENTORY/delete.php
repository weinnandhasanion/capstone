<?php 
session_start();
require('connect.php');
date_default_timezone_set('Asia/Manila');
if($_SESSION['admin_id']){
        $session_admin_id = $_SESSION['admin_id'];
    }

    
$id = $_REQUEST['id'];
$date_deleted = date("Y-m-d");
$time_deleted = date("h:i:s");

$ox = "UPDATE inventory SET inventory_status = 'deleted', date_deleted = '$date_deleted', time_deleted = '$time_deleted' 
WHERE inventory_id = " . intval($id) . "";     
 
if(mysqli_query($conn, $ox))
        json_encode('success');
else
        echo mysqli_error($conn), 'NOT UPDATED';    
?>


<?php
//this is for puting inventory_id in the array
$data = array();
$inventory_id;
$sql3 = "SELECT * FROM inventory ORDER BY inventory_id DESC";
$res3 = mysqli_query($conn, $sql3);
if($res3) {
    while($row = mysqli_fetch_assoc($res3)) {
        $data[] = $row["inventory_id"];
    }

    $inventory_id = $data[0];
}

//this is for puting login_id in the array
$data_logtrail = array();
$login_id;
$log = "SELECT * FROM logtrail ORDER BY login_id DESC";
$logtrail = mysqli_query($conn, $log);
if($logtrail) {
    while($rowrow = mysqli_fetch_assoc($logtrail)) {
        $data_logtrail[] = $rowrow["login_id"];
    }

    $login_id = $data_logtrail[0];
}


// INSERTING  ADMIN INFO FOR THE LOGTRAIL DOING
$sql0 = "SELECT first_name,last_name,admin_id FROM admin WHERE admin_id = $session_admin_id";
$query_run = mysqli_query($conn, $sql0);
$rows1 = mysqli_fetch_assoc($query_run);

$last_name = $rows1["last_name"];
$admin_id = $rows1["admin_id"];
// INSERTING MEMBER INFO FOR THE LOGTRAIL DOING
$sql2 = "SELECT * FROM inventory WHERE inventory_id = '$id'";
$query_run2 = mysqli_query($conn, $sql2);
$rows2 = mysqli_fetch_assoc($query_run2);

$inventory_id_new = $rows2["inventory_id"];
$user_fname = $rows2["inventory_name"];
$description = "Deleted an inventory";
$identity = "Inventory";
$timeNow = date("h:i A");

// INSERTING LOGTRAIL INFO  FOR THE LOGTRAIL DOING
$sql22 = "SELECT * FROM logtrail WHERE login_id = '$login_id'";
$query_run22 = mysqli_query($conn, $sql22);
$rows22 = mysqli_fetch_assoc($query_run22);

$login_id_new = $rows22["login_id"];

$sql1 = "INSERT INTO `logtrail_doing` ( `login_id`,`admin_id`,`inventory_id`,`user_fname`,
`description`, `identity`,`time`)
VALUES ( '$login_id_new','$admin_id', '$inventory_id_new', '$user_fname','$description','$identity', '$timeNow')";
mysqli_query($conn, $sql1);
?>