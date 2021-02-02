<?php 
session_start();
require('connect.php');

if($_SESSION['admin_id']){
        $session_admin_id = $_SESSION['admin_id'];
    }

$id = $_REQUEST['id'];
$date_deleted = date("Y-m-d");

$ox = "UPDATE trainer SET acc_status = 'disable', date_deleted = '$date_deleted'
WHERE trainer_id = " . intval($id) . "";     

if(mysqli_query($conn, $ox))
        json_encode('success');
else
        echo mysqli_error($conn), 'NOT UPDATED';    

// INSERTINGN REPORTS FOR THE ADMIN INFO
$sql00 = "SELECT first_name,last_name,admin_id FROM admin WHERE admin_id = $session_admin_id";
$query_run1 = mysqli_query($conn, $sql00);
$rows1 = mysqli_fetch_assoc($query_run1);

$admin_fname = $rows1["first_name"];
$admin_lname = $rows1["last_name"];
$admin_id = $rows1["admin_id"];
$description = "Deleted a trainer";

// INSERTINGN REPORTS FOR THE MEMBER INFO
$sql11 = "SELECT first_name,last_name,trainer_id FROM trainer WHERE trainer_id = $id";
$query_run11 = mysqli_query($conn, $sql11);     
$rows11 = mysqli_fetch_assoc($query_run11);

$first_name = $rows11["first_name"];
$last_name = $rows11["last_name"];
$trainer_id = $rows11["trainer_id"];
$identity = "trainer";

$John = "INSERT INTO `reports` ( `admin_id`,`admin_fname`,`admin_lname`,
trainer_id, member_fname,member_lname,`description`,`identity`)
VALUES ( '$admin_id', '$admin_fname', '$admin_lname','$trainer_id','$first_name','$last_name', '$description','$identity')";
$query_run123 = mysqli_query($conn, $John);
?>