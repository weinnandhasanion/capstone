<?php 
//CONNECTION SA DATABASE <3
session_start();
require('connect.php');

if($_SESSION['admin_id']){
        $session_admin_id = $_SESSION['admin_id'];
    }

//INPUTS FROM THE UPDATE NA GI STORE SA $VARIABLE NAME
$trainer_status= $_POST['trainer_status'];
$trainer_position= $_POST['trainer_position'];
$phone= $_POST['phone'];
$address= $_POST['address'];
// CONSTANT VARIABLE... REFERENCE IN THE DATABASE...//
$seniorSalary='20,000';
$juniorSalary='10,000';
$seniorPos = 'senior';
$juniorPos  = 'junior';

// MAIN QUERY NA MO UPDATE SA TANAN
$tan = "UPDATE trainer SET
               trainer_status = '$trainer_status',
               trainer_position = '$trainer_position',
               phone = '$phone',
               address = '$address' 
        WHERE trainer_id = '$_POST[trainer_id]'";

//VALIDATION IF NAAY LETTERS ANG GI INPUT NMO SA CONTACT NUMBER.. IF WALA MO PROCEED SHA SA NEXT CHECKING
$phoneregex = "/[a-zA-Z]/";
if (preg_match($phoneregex, $phone, $match)) 
{
        echo ("<script LANGUAGE='JavaScript'>
        window.alert('Phone has letters.. pelase check ur inputs.');
        window.location.href='/PROJECT/TRAINER/trainers.php';
        </script>");
// CHECK KUNG 11 NUMBERS IMO INPUT.. IF FALSE MO EXIT SA ELSE
}else if(strlen($phone) == 11){
   //MAIN  CONDITION NI SA UPDATE
        if($hubak = mysqli_query($conn, $tan)){

                        echo ("<script LANGUAGE='JavaScript'>
                        window.alert('Trainer is successfully updated.');
                        window.location.href='/PROJECT/TRAINER/trainers.php';
                        </script>"); 
                        

                
        }else{
                // EXIT IF FALSE ANG 1st CONDITION
                echo mysqli_error($conn), 'NOT UPDATED';
        }
// EXIT IF FALSE ANG PHONE NUMBER
}else{
        echo ("<script LANGUAGE='JavaScript'>
                window.alert('Invalid Phone number Please make sure it has 11 digits inputed');
                window.location.href='/PROJECT/TRAINER/trainers.php';
                </script>");
}       


?>