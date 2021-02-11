<?php
session_start();
require('connect.php');
date_default_timezone_set('Asia/Manila');
if($_SESSION['admin_id']){
    $session_admin_id = $_SESSION['admin_id'];
}

?>

<?php

    $first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $birthdate = $_POST['birthdate'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $date_hired = date("Y-m-d"); 
   
//---- query validations
$check_name = "SELECT * from trainer where first_name='$first_name' AND last_name='$last_name'";
$duplicate_name = mysqli_query($conn, $check_name);

$check_email = "SELECT * from trainer where email='$email'";
$duplicate_email = mysqli_query($conn, $check_email);

$check_phone = "SELECT * from trainer where phone='$phone'";
$duplicate_phone = mysqli_query($conn, $check_phone);
//--------------
     
//REGEX
$phoneregex = "/[a-zA-Z]/";
$Fnameregex = "/[0-9]/";
$Lnameregex = "/[0-9]/";
//VALIDATION IF NAAY NUMBERS ANG GI INPUT NMO SA LASTNAME..
if(preg_match($Lnameregex, $last_name, $match)){
    echo ("<script LANGUAGE='JavaScript'>
    window.alert('Invalid last name. Please check make sure no numbers...');
    window.location.href='/PROJECT/TRAINER/trainers.php';
    </script>");
}
//VALIDATION IF EMAIL IS ALREADY TAKEN.. 
else if(mysqli_num_rows($duplicate_email)>0){
    echo ("<script LANGUAGE='JavaScript'>
    window.alert('Email address is already Taken');
    window.location.href='/PROJECT/TRAINER/trainers.php';
    </script>");
}
//VALIDATION IF PHONE IS ALREADY TAKEN.. 
else if(mysqli_num_rows($duplicate_phone)>0){
    echo ("<script LANGUAGE='JavaScript'>
    window.alert('contact number is already Taken');
    window.location.href='/PROJECT/TRAINER/trainers.php';
    </script>");
}
//VALIDATION IF NAME IS ALREADY TAKEN.. 
else if(mysqli_num_rows($duplicate_name)>0){
    echo ("<script LANGUAGE='JavaScript'>
    window.alert('Name is already Taken');
    window.location.href='/PROJECT/TRAINER/trainers.php';
    </script>");
}
//VALIDATION IF NAAY NUMBERS ANG GI INPUT NMO SA FIRSTNAME.. 
else if(preg_match($Fnameregex, $first_name, $match)){
    echo ("<script LANGUAGE='JavaScript'>
    window.alert('Invalid first name. Please check make sure no numbers...');
    window.location.href='/PROJECT/TRAINER/trainers.php';
    </script>");
}

//VALIDATION IF NAAY LETTERS ANG GI INPUT NMO SA CONTACT NUMBER.. IF WALA MO PROCEED SHA SA NEXT CHECKING
else if (preg_match($phoneregex, $phone, $match)){
        echo ("<script LANGUAGE='JavaScript'>
            window.alert('Phone has letters.. pelase check ur inputs.');
            window.location.href='/PROJECT/TRAINER/trainers.php';
            </script>");
}
// CHECK IF 11 DIGIT IMONG PHONE NUMBER IF DLE MO EXIT SHA SA ELSE
else if(strlen($phone) == 11){
     // QUERY 
     $sql = "INSERT INTO `trainer` ( `first_name`,`last_name`,`email`,
     `address`,`birthdate`,`phone`,`gender`,date_hired)
      VALUES ( '$first_name', '$last_name', '$email', '$address',
     '$birthdate',  '$phone', '$gender','$date_hired')";

            //MAIN  CONDITION NI SA UPDATE
            if($query_run = mysqli_query($conn, $sql)){
                echo ("<script LANGUAGE='JavaScript'>
                        window.alert('Trainer is been added.');
                        window.location.href='/PROJECT/TRAINER/trainers.php';
                        </script>");
            }else{
                echo "failure to register";
                header('Location: /PROJECT/TRAINER/trainers.php?failure to register');
            }

            
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
     $ew = "SELECT * FROM trainer WHERE trainer_id = '$trainer_id'";
     $query_runew = mysqli_query($conn, $ew);
     $rowew = mysqli_fetch_assoc($query_runew);

     $trainer_id_new = $rowew["trainer_id"];
     $user_fname = $rowew["first_name"];
     $user_lname = $rowew["last_name"];
     $fullname = $user_fname.' '.$user_lname;
     $description = "Added a trainer";
     //$description = $echo.' '.$fullname;
     $identity = "trainer";
     $timeNow = date("h:i A");  


     // INSERTING LOGTRAIL INFO  FOR THE LOGTRAIL DOING
     $sql22 = "SELECT * FROM logtrail WHERE login_id = '$login_id'";
     $query_run22 = mysqli_query($conn, $sql22);
     $rows22 = mysqli_fetch_assoc($query_run22);

     $login_id_new = $rows22["login_id"];

     $sql1 = "INSERT INTO `logtrail_doing` ( `login_id`,`admin_id`,`trainer_id`,`user_fname`,`user_lname`,
     `description`, `identity`,`time`)
     VALUES ( '$login_id_new','$admin_id', '$trainer_id_new', '$user_fname','$user_lname','$description','$identity', '$timeNow')";
     mysqli_query($conn, $sql1);
   

// EXIT IF DLE 11 DIGITS IMONG PHONE NUMBER
}else{
    echo ("<script LANGUAGE='JavaScript'>
            window.alert('Invalid Phone number. Make sure it has 11 digits...');
            window.location.href='/PROJECT/TRAINER/trainers.php';
            </script>");
    }      

    ?>