<?php
session_start();
require('connect.php');
?>

<?php
date_default_timezone_set('Asia/Manila');

if($_SESSION['admin_id']){
    $session_admin_id = $_SESSION['admin_id'];
}

$program_name = $_POST['program_name'];
$program_description = $_POST['program_description'];
$date_added = date("Y-m-d"); 
//REGEX

$program_name_regex = "/[0-9]/";




 // INSERTING  ADMIN INFO 
 $sql0 = "SELECT * FROM admin WHERE admin_id = $session_admin_id";
 $query_run = mysqli_query($conn, $sql0);
 $rows = mysqli_fetch_assoc($query_run);

 $admin_id = $rows["admin_id"];
 $timeNow = date("h:i A");

if(preg_match($program_name_regex, $program_name, $match)){
    echo ("<script LANGUAGE='JavaScript'>
    window.alert('Invalid program name. Please check, make sure no numbers...');
    window.location.href='/PROJECT/MEMBERS/members.php';
    </script>");
}else{
    
    $sql = "INSERT INTO `program` ( admin_id, program_name,program_description,date_added,time_added)
    VALUES ( '$admin_id','$program_name', '$program_description', '$date_added', '$timeNow')";

    $query_run = mysqli_query($conn, $sql);

    echo ("<script LANGUAGE='JavaScript'>
    window.alert('program is been added.');
    window.location.href='/PROJECT/MEMBERS/members.php';
    </script>");
}

?>