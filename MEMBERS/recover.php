<?php 
session_start();
require('connect.php');

$id = $_REQUEST['id'];

if($_SESSION['admin_id']){
        $session_admin_id = $_SESSION['admin_id'];
    }

    
$ox = "UPDATE member SET acc_status = 'active'
WHERE member_id = " . intval($id) . "";     

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
$description = "Recovered a member";

// INSERTINGN REPORTS FOR THE MEMBER INFO
$sql11 = "SELECT first_name,last_name,member_id FROM member WHERE member_id = $id";
$query_run11 = mysqli_query($conn, $sql11);
$rows11 = mysqli_fetch_assoc($query_run11);

$member_fname = $rows11["first_name"];
$member_lname = $rows11["last_name"];
$member_id = $rows11["member_id"];
$identity = "member";

$John = "INSERT INTO `reports` ( `admin_id`,`admin_fname`,`admin_lname`,
member_id, member_fname,member_lname,`description`,`identity`)
VALUES ( '$admin_id', '$admin_fname', '$admin_lname','$member_id','$member_fname','$member_lname', '$description','$identity')";
$query_run123 = mysqli_query($conn, $John);

?>