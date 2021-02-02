<?php
session_start();
require('connect.php');
?>

<?php

$program_name = $_POST['program_name'];
$program_description = $_POST['program_description'];
$date_added = date("Y-m-d"); 
//REGEX

$program_name_regex = "/[0-9]/";


if(preg_match($program_name_regex, $program_name, $match)){
    echo ("<script LANGUAGE='JavaScript'>
    window.alert('Invalid program name. Please check, make sure no numbers...');
    window.location.href='/PROJECT/MEMBERS/members.php';
    </script>");
}else{
    
    $sql = "INSERT INTO `program` ( program_name,program_description,date_added)
    VALUES ( '$program_name', '$program_description', '$date_added')";

    $query_run = mysqli_query($conn, $sql);

    echo ("<script LANGUAGE='JavaScript'>
    window.alert('program is been added.');
    window.location.href='/PROJECT/MEMBERS/members.php';
    </script>");
}

?>