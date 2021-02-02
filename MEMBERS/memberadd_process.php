<?php
session_start();
require('connect.php');
?>

<?php

if($_SESSION['admin_id']){
    $session_admin_id = $_SESSION['admin_id'];
}

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$gender = $_POST['gender'];
$birthdate = $_POST['birthdate'];
$email = $_POST['email'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$member_type = $_POST['member_type'];
$date_registered = date("Y-m-d"); 
$program_name = $_POST['program_name'];



//REGEX
$phoneregex = "/[a-zA-Z]/";
$Fnameregex = "/[0-9]/";
$Lnameregex = "/[0-9]/";
//VALIDATION IF NAAY NUMBERS ANG GI INPUT NMO SA LASTNAME..
 if(preg_match($Lnameregex, $last_name, $match)){
    echo ("<script LANGUAGE='JavaScript'>
    window.alert('Invalid last name. Please check, make sure no numbers...');
    window.location.href='/PROJECT/MEMBERS/members.php';
    </script>");
}
//VALIDATION IF NAAY NUMBERS ANG GI INPUT NMO SA FIRSTNAME.. 
else if(preg_match($Fnameregex, $first_name, $match)){
    echo ("<script LANGUAGE='JavaScript'>
    window.alert('Invalid first name. Please check, make sure no numbers...');
    window.location.href='/PROJECT/MEMBERS/members.php';
    </script>");
}
//VALIDATION IF NAAY LETTERS ANG GI INPUT NMO SA CONTACT NUMBER.. IF WALA MO PROCEED SHA SA NEXT CHECKING
else if (preg_match($phoneregex, $phone, $match)){
    echo ("<script LANGUAGE='JavaScript'>
        window.alert('Phone has letters.. pelase check ur inputs.');
        window.location.href='/PROJECT/MEMBERS/members.php';
        </script>");
}
// CHECK IF 11 DIGIT IMONG PHONE NUMBER IF DLE MO EXIT SHA SA ELSE
else if(strlen($phone) == 11){


        $sql = "INSERT INTO `member` ( first_name,last_name,gender,birthdate,email,address,
        phone,member_type,date_registered,program_name )         
        VALUES ( '$first_name', '$last_name', '$gender', '$birthdate', '$email', 
        '$address', '$phone', '$member_type', '$date_registered','$program_name')";
        mysqli_query($conn, $sql);
        

    // INSERTINGN REPORTS FOR THE ADMIN INFO
    $sql0 = "SELECT first_name,last_name,admin_id FROM admin WHERE admin_id = $session_admin_id";
    $query_run = mysqli_query($conn, $sql0);
    $rows = mysqli_fetch_assoc($query_run);

    $admin_fname = $rows["first_name"];
    $admin_lname = $rows["last_name"];
    $admin_id = $rows["admin_id"];
    $description = "Added a member";
    $member_fname = "NOT YET";
    $member_lname = "FETCH";
    $identity = "member";
   
    $sql1 = "INSERT INTO `reports` ( `admin_id`,`admin_fname`,`admin_lname`,
    member_fname,member_lname,`description`,`identity`)
    VALUES ( '$admin_id', '$admin_fname', '$admin_lname', '$member_fname','$member_lname','$description','$identity')";
    $query_run = mysqli_query($conn, $sql1);
    
       
        echo ("<script LANGUAGE='JavaScript'>
				    window.alert('member is been added.');
				    window.location.href='/PROJECT/MEMBERS/members.php';
                    </script>");
        

// EXIT IF DLE 11 DIGITS IMONG PHONE NUMBER    
}else{
    echo ("<script LANGUAGE='JavaScript'>
    window.alert('Invalid Phone number. Make sure it has 11 digits...');
    window.location.href='/PROJECT/MEMBERS/members.php';
    </script>");
}

?>


