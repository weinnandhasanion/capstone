<?php 
session_start();
require('connect.php');

date_default_timezone_set('Asia/Manila');

if($_SESSION['admin_id']){
    $session_admin_id = $_SESSION['admin_id'];
}

    
//-----------------------------------------------------------------------------------
$email= $_POST['email'];
$id = $_POST['member_id'];
$phone= $_POST['phone'];
$member_type= $_POST['member_type'];
$phoneregex = "/[a-zA-Z]/";

$sql = "UPDATE member SET email = '$email', phone = '$phone', member_type = '$member_type'
        WHERE member_id = '$id'"; 
$sql_update = mysqli_query($conn, $sql);

if (preg_match($phoneregex, $phone, $match)) 
{
        echo ("<script LANGUAGE='JavaScript'>
        window.alert('Phone has letters.. pelase check ur inputs.');
        window.location.href='/PROJECT/MEMBERS/members.php';
        </script>");
}else if($sql_update){
        echo ("<script LANGUAGE='JavaScript'>
        window.alert('Update successfully');
        window.location.href='/PROJECT/MEMBERS/members.php';
        </script>");
}else {
    echo ("<script LANGUAGE='JavaScript'>
                window.alert('Failed to update');
                window.location.href='/PROJECT/MEMBERS/members.php';
                </script>");
}

    ?>