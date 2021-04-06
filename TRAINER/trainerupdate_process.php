<?php 
//CONNECTION SA DATABASE <3
session_start();
require('./../connect.php');
date_default_timezone_set('Asia/Manila');
if($_SESSION['admin_id']){
        $session_admin_id = $_SESSION['admin_id'];
    }

//INPUTS FROM THE UPDATE NA GI STORE SA $VARIABLE NAME
$trainer_status= $_POST['trainer_status'];
$phone= $_POST['phone'];
$email= $_POST['email'];
$address= $_POST['address'];
$id = $_POST["trainer_id"];


// MAIN QUERY NA MO UPDATE SA TANAN
$tan = "UPDATE trainer SET
               trainer_status = '$trainer_status',
               phone = '$phone',
               email = '$email',
               address = '$address' 
        WHERE trainer_id = '$id'";
//---- query validations
$check_email = "SELECT * from trainer where trainer_id != '$_POST[trainer_id]' AND email='$email'";
$duplicate_email = mysqli_query($conn, $check_email);

$check_phone = "SELECT * from trainer where trainer_id != '$_POST[trainer_id]' AND phone = '$phone'";
$duplicate_phone = mysqli_query($conn, $check_phone); 
//--------------

//VALIDATION IF NAAY LETTERS ANG GI INPUT NMO SA CONTACT NUMBER.. IF WALA MO PROCEED SHA SA NEXT CHECKING
$phoneregex = "/[a-zA-Z]/";
$specialCharacterRegex  = "/[\\W_]/";

if (preg_match($phoneregex, $phone, $match)) 
{
        echo ("<script LANGUAGE='JavaScript'>
        window.alert('Contact number has letters. Please check ur inputs.');
        window.location.href='./../TRAINER/trainers.php';
        </script>");

// CHECK KUNG 11 NUMBERS IMO INPUT.. IF FALSE MO EXIT SA ELSE
}else if(mysqli_num_rows($duplicate_phone)>0){
    echo ("<script LANGUAGE='JavaScript'>
    window.alert('Contact number is already taken');
    window.location.href='./../TRAINER/trainers.php';
    </script>");
}else if(mysqli_num_rows($duplicate_email)>0){
    echo ("<script LANGUAGE='JavaScript'>
    window.alert('Email address is already taken');
    window.location.href='./../TRAINER/trainers.php';
    </script>");
}else if(preg_match($specialCharacterRegex, $phone, $match)){
    echo ("<script LANGUAGE='JavaScript'>
    window.alert('Invalid Contact number. make sure no special character and space');
    window.location.href='./../TRAINER/trainers.php';
    </script>");
}else if(strlen($phone) > 11){
   echo ("<script LANGUAGE='JavaScript'>
   window.alert('Invalid Phone number. Too many numbers inputed');
   window.location.href='./../TRAINER/trainers.php';
   </script>");
}else if(strlen($phone) < 10){
    echo ("<script LANGUAGE='JavaScript'>
    window.alert('Invalid Phone number. Lacking numbers input');
    window.location.href='./../TRAINER/trainers.php';
    </script>"); 
}else if(strlen($email) > 40){
    echo ("<script LANGUAGE='JavaScript'>
    window.alert('Invalid email address. Maximum of 40 letters only');
    window.location.href='./../TRAINER/trainers.php';
    </script>");      
}else if(strlen($address) > 60){
    echo ("<script LANGUAGE='JavaScript'>
    window.alert('Invalid  address. Maximum of 60 letters only');
    window.location.href='./..//TRAINER/trainers.php';
    </script>");       
}else if(strlen($address) < 5){
    echo ("<script LANGUAGE='JavaScript'>
    window.alert('Invalid  address. Too short for address');
    window.location.href='./../TRAINER/trainers.php';
    </script>");    
}else{
    mysqli_query($conn, $tan);
}       



//-----------------------------------------------------------------------------

 //this is for puting member_id in the array
 $data = array();
 $trainer_id;
 $sql3 = "SELECT * FROM trainer ORDER BY trainer_id DESC";
 $res3 = mysqli_query($conn, $sql3);
 if($res3) {
     while($row = mysqli_fetch_assoc($res3)) {
         $data[] = $row["trainer_id"];
     }

     $trainer_id = $data[0];
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
 $ad= "SELECT * FROM admin WHERE admin_id = $session_admin_id";
 $query_runad = mysqli_query($conn, $ad);
 $rowed = mysqli_fetch_assoc($query_runad);

 $admin_id = $rowed["admin_id"];

 // INSERTING MEMBER INFO FOR THE LOGTRAIL DOING
 $ew = "SELECT * FROM trainer WHERE trainer_id = '$id'";
 $query_runew = mysqli_query($conn, $ew);
 $rowew = mysqli_fetch_assoc($query_runew);

 $trainer_id_new = $rowew["trainer_id"];
 $user_fname = $rowew["first_name"];
 $user_lname = $rowew["last_name"];
 $identity = "Trainers";
 $timeNow = date("h:i A");

 // INSERTING LOGTRAIL INFO  FOR THE LOGTRAIL DOING
 $sql22 = "SELECT * FROM logtrail WHERE login_id = '$login_id'";
 $query_run22 = mysqli_query($conn, $sql22);
 $rows22 = mysqli_fetch_assoc($query_run22);

 $login_id_new = $rows22["login_id"];

 

//-------------------------------------------------------------------------------
        $description = "Updated a Trainer ";
        $sql1 = "INSERT INTO `logtrail_doing` ( `login_id`,`admin_id`,`trainer_id`,`user_fname`,`user_lname`,
        `description`, `identity`,`time`)
        VALUES ( '$login_id_new','$admin_id', '$trainer_id_new', '$user_fname','$user_lname','$description','$identity', '$timeNow')";
        mysqli_query($conn, $sql1);

        echo ("<script LANGUAGE='JavaScript'>
        window.alert('Trainer is successfully updated.');
        window.location.href='./../TRAINER/trainers.php';
        </script>"); 
//-------------------------------------------------------------------------------

?>

