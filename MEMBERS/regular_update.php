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
$member_type = $_POST['member_type'];
$address= $_POST['address'];
$phoneregex = "/[a-zA-Z]/";

$sql = "UPDATE member SET email = '$email', address = '$address', phone = '$phone', member_type = '$member_type'
        WHERE member_id = '$id'"; 
$sql_update = mysqli_query($conn, $sql);

$exist = "SELECT * FROM member WHERE member_id != '$id' AND email = '$email'";
$existEmail = mysqli_query($conn, $exist);

$exist = "SELECT * FROM member WHERE member_id != '$id' AND phone = '$phone'";
$existPhone = mysqli_query($conn, $exist);



if (preg_match($phoneregex, $phone, $match)) {
        echo ("<script LANGUAGE='JavaScript'>
        window.alert('Phone has letters.. pelase check ur inputs.');
        window.location.href='/PROJECT/MEMBERS/members.php';
        </script>");
}else if($email == ""){
        echo ("<script LANGUAGE='JavaScript'>
        window.alert('Email address is empty');
        window.location.href='/PROJECT/MEMBERS/members.php';
        </script>");
}else if(mysqli_num_rows($existEmail)>0){
        echo ("<script LANGUAGE='JavaScript'>
        window.alert('Email is already Taken');
        window.location.href='/PROJECT/MEMBERS/members.php';
        </script>");
}else if($phone == ""){
        echo ("<script LANGUAGE='JavaScript'>
        window.alert('Contact number is empty');
        window.location.href='/PROJECT/MEMBERS/members.php';
        </script>");
}else if(mysqli_num_rows($existPhone)>0){
        echo ("<script LANGUAGE='JavaScript'>
        window.alert('Phone is already Taken');
        window.location.href='/PROJECT/MEMBERS/members.php';
        </script>");
}else if($address == ""){
        echo ("<script LANGUAGE='JavaScript'>
        window.alert('Address is empty');
        window.location.href='/PROJECT/MEMBERS/members.php';
        </script>");
}else if($sql_update){
        echo ("<script LANGUAGE='JavaScript'>
        window.alert('Update successfully');
        window.location.href='/PROJECT/MEMBERS/members.php';
        </script>");
}else{
    echo ("<script LANGUAGE='JavaScript'>
                window.alert('Failed to update');
                window.location.href='/PROJECT/MEMBERS/members.php';
                </script>");
}

if($member_type == "Walk-in"){
        $sql1 = "UPDATE member SET  username = null
        WHERE member_id = '$id'"; 
        mysqli_query($conn, $sql1);
}





//------------------------------LOGTRAIL DOING NANI

//this is for puting member_id in the array
$data = array();
$member_id;
$sql3 = "SELECT * FROM member ORDER BY member_id DESC";
$res3 = mysqli_query($conn, $sql3);
if($res3) {
    while($row = mysqli_fetch_assoc($res3)) {
        $data[] = $row["member_id"];
    }

    $member_id = $data[0];
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
$sql2 = "SELECT first_name,last_name,member_id FROM member WHERE member_id = '$member_id'";
$query_run2 = mysqli_query($conn, $sql2);
$rows2 = mysqli_fetch_assoc($query_run2);

$member_id_new = $rows2["member_id"];
$user_fname = $rows2["first_name"];
$user_lname = $rows2["last_name"];
$first_name = $rows["first_name"];
$description = "Updated a member";
$identity = "member";
$timeNow = date("h:i A");


// INSERTING LOGTRAIL INFO  FOR THE LOGTRAIL DOING
$sql22 = "SELECT * FROM logtrail WHERE login_id = '$login_id'";
$query_run22 = mysqli_query($conn, $sql22);
$rows22 = mysqli_fetch_assoc($query_run22);

$login_id_new = $rows22["login_id"];

$sql1 = "INSERT INTO `logtrail_doing` ( `login_id`,`admin_id`,`member_id`,`user_fname`,`user_lname`,
`description`, `identity`,`time`)
VALUES ( '$login_id_new','$admin_id', '$member_id_new', '$user_fname','$user_lname','$description','$identity', '$timeNow')";
mysqli_query($conn, $sql1);

    ?>