<?php
session_start();
require('connect.php');
?>

<?php
date_default_timezone_set('Asia/Manila');

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
$program_id = $_POST['program_id'];

//---- query validations
$check_name = "SELECT * from member where first_name='$first_name' AND last_name='$last_name'";
$duplicate_name = mysqli_query($conn, $check_name);

$check_email = "SELECT * from member where email='$email'";
$duplicate_email = mysqli_query($conn, $check_email);

$check_phone = "SELECT * from member where phone='$phone'";
$duplicate_phone = mysqli_query($conn, $check_phone);
//--------------

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
//VALIDATION IF NAME IS ALREADY TAKEN.. 
else if(mysqli_num_rows($duplicate_name)>0){
    echo ("<script LANGUAGE='JavaScript'>
    window.alert('Name is already Taken');
    window.location.href='/PROJECT/MEMBERS/members.php';
    </script>");
}
//VALIDATION IF EMAIL IS ALREADY TAKEN.. 
else if(mysqli_num_rows($duplicate_email)>0){
    echo ("<script LANGUAGE='JavaScript'>
    window.alert('Email address is already Taken');
    window.location.href='/PROJECT/MEMBERS/members.php';
    </script>");
}
//VALIDATION IF CONTACT NUMBER IS ALREADY TAKEN.. 
else if(mysqli_num_rows($duplicate_phone)>0){
    echo ("<script LANGUAGE='JavaScript'>
    window.alert('Contact number is already Taken');
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
        phone,member_type,date_registered,program_id )         
        VALUES ( '$first_name', '$last_name', '$gender', '$birthdate', '$email', 
        '$address', '$phone', '$member_type', '$date_registered','$program_id')";
        $query_run = mysqli_query($conn, $sql);
        
        if($query_run){
            //this is for puting member_id in the array
            $data = array();
            $sql3 = "SELECT * FROM member ORDER BY member_id DESC";
            $res3 = mysqli_query($conn, $sql3);
            if($res3) {
                while($row = mysqli_fetch_assoc($res3)) {
                    $data[] = $row["member_id"];
                }
        
                $member_id = $data[0];
            }
        }
                            
    $login_id_data = array();
    $sql31 = "SELECT * FROM logtrail ORDER BY login_id DESC";
    $res31 = mysqli_query($conn, $sql31);
    if($res31) {
        while($row123 = mysqli_fetch_assoc($res31)) {
            $login_id_data[] = $row123["login_id"];
        }

        $login_id = $login_id_data[0];
    }

    $program_id_data = array();
    $sql311 = "SELECT * FROM program ORDER BY program_id DESC";
    $res311 = mysqli_query($conn, $sql311);
    if($res311) {
        while($row1234 = mysqli_fetch_assoc($res311)) {
            $program_id_data[] = $row1234["program_id"];
        }

        $program_id = $program_id_data[0];
    }



     // INSERTING  ADMIN INFO FOR THE LOGTRAIL DOING
     $sql0 = "SELECT * FROM admin WHERE admin_id = $session_admin_id";
     $query_run = mysqli_query($conn, $sql0);
     $rows = mysqli_fetch_assoc($query_run);
 
     $last_name = $rows["last_name"];
     $admin_id = $rows["admin_id"];
     // INSERTING MEMBER INFO FOR THE LOGTRAIL DOING
     $sql2 = "SELECT * FROM member WHERE member_id = '$member_id'";
     $query_run2 = mysqli_query($conn, $sql2);
     $rows2 = mysqli_fetch_assoc($query_run2);
 
     $member_id_new = $rows2["member_id"];
     $user_fname = $rows2["first_name"];
     $user_lname = $rows2["last_name"];
     $first_name = $rows["first_name"];
 
     // INSERTING logtrail INFO FOR THE LOGTRAIL DOING
     $sql3 = "SELECT * FROM logtrail WHERE login_id = '$login_id'";
     $query_run3 = mysqli_query($conn, $sql3);
     $rows3 = mysqli_fetch_assoc($query_run3);
     
     $login_id_new = $rows3["login_id"];
     $regular_description = "Added a regular member ";
     $Walkin_description = "Added a walk-in member ";
     $identity = "member";
     $timeNow = date("h:i A");
 
     // INSERTING program INFO FOR THE LOGTRAIL DOING
     $sql5 = "SELECT * FROM program WHERE program_id = '$program_id'";
     $query_run5 = mysqli_query($conn, $sql5);
     $rows5 = mysqli_fetch_assoc($query_run5);
 
     $program_id_new = $rows5["program_id"];
     $date_added = date("y-m-d");

     echo ("<script LANGUAGE='JavaScript'>
    window.alert('Successfully Added a member');
    window.location.href='/PROJECT/MEMBERS/members.php';
    </script>");

    
// EXIT IF DLE 11 DIGITS IMONG PHONE NUMBER    
}else{
    echo ("<script LANGUAGE='JavaScript'>
    window.alert('Invalid Phone number. Make sure it has 11 digits...');
    window.location.href='/PROJECT/MEMBERS/members.php';
    </script>");
}


if($member_type == 'Regular'){
    $sql1 = "INSERT INTO `logtrail_doing` ( `login_id`,`admin_id`,`member_id`,`user_fname`,`user_lname`,
    `description`, `identity`,`time`)
    VALUES ( '$login_id_new','$admin_id', '$member_id_new', '$user_fname','$user_lname','$regular_description','$identity', '$timeNow')";
    mysqli_query($conn, $sql1);
    
}else if($member_type == 'Walk-in'){
    $sql2 = "INSERT INTO `logtrail_doing` ( `login_id`,`admin_id`,`member_id`,`user_fname`,`user_lname`,
    `description`, `identity`,`time`)
    VALUES ( '$login_id_new','$admin_id', '$member_id_new', '$user_fname','$user_lname','$Walkin_description','$identity', '$timeNow')";
    mysqli_query($conn, $sql2);
}else{
    echo ("<script LANGUAGE='JavaScript'>
    window.alert('ERROR');
    window.location.href='/PROJECT/MEMBERS/members.php';
    </script>");
}

   

?>


