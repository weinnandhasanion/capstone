<?php 
session_start();
require('connect.php');

if($_SESSION['admin_id']){
        $session_admin_id = $_SESSION['admin_id'];
    }


$member_type= $_POST['member_type'];
$member_status= $_POST['member_status'];

$ox = "UPDATE member SET member_type = '$member_type', member_status = '$member_status'
WHERE member_id = '$_POST[member_id]'";     

if(mysqli_query($conn, $ox))
        echo ("<script LANGUAGE='JavaScript'>
                window.alert('Trainer is successfully updated.');
                window.location.href='/PROJECT/MEMBERS/members.php';
                </script>");
else
        echo mysqli_error($conn), 'NOT UPDATED';    
 // INSERTINGN REPORTS FOR THE ADMIN INFO
 $sql0 = "SELECT first_name,last_name,admin_id FROM admin WHERE admin_id = $session_admin_id";
 $query_run = mysqli_query($conn, $sql0);
 $rows = mysqli_fetch_assoc($query_run);

 $admin_fname = $rows["first_name"];
 $admin_lname = $rows["last_name"];
 $admin_id = $rows["admin_id"];
 $description = "Update an Account";

 // INSERTINGN REPORTS FOR THE MEMBER INFO
 $sql0 = "SELECT first_name,last_name,member_id FROM member WHERE member_id = '$_POST[member_id]'";
 $query_run = mysqli_query($conn, $sql0);
 $rows = mysqli_fetch_assoc($query_run);
 
 $member_fname = $rows["first_name"];
 $member_lname = $rows["last_name"];
 $member_id = $rows["member_id"];

 $sql1 = "INSERT INTO `reports` ( `admin_id`,`admin_fname`,`admin_lname`,
 member_id, member_fname,member_lname,`description`)
 VALUES ( '$admin_id', '$admin_fname', '$admin_lname','$member_id','$member_fname','$member_lname', '$description')";
 $query_run = mysqli_query($conn, $sql1);

?>