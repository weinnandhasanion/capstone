<?php 
session_start();
require('connect.php');

$program_name= $_POST['program_name'];
$program_description= $_POST['program_description'];

    $ox = "UPDATE program SET program_name = '$program_name', program_description = '$program_description'
    WHERE program_id = '$_POST[program_id]'"; 

        if($okay = mysqli_query($conn, $ox)){
        echo ("<script LANGUAGE='JavaScript'>
                window.alert('Program is successfully updated.');
                window.location.href='/PROJECT/MEMBERS/members.php';
                </script>");
        }else{
            echo "failure to register";
			header('Location: /PROJECT/MEMBERS/members.php?failure to register');
        }


?>