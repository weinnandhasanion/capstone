<?php
session_start();
require('./../connect.php');
?>

<?php
date_default_timezone_set('Asia/Manila');

if ($_SESSION['admin_id']) {
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
$avail = $_POST["program_form_check"];
$timeregistered = date("Y-m-d h:i:s");

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
$FnameNumregex = "/[0-9]/";
$LnameNumregex = "/[0-9]/";
$specialCharacterRegex  = "/[\\W_]/";
$checkSpace = "/\\s/";

//VALIDATION IF NAAY NUMBERS ANG GI INPUT NMO SA LASTNAME..
if (preg_match($LnameNumregex, $last_name, $match)) {
    echo json_encode("Invalid last name. Please make sure there are no numbers.");
}
//VALIDATION IF NAAY SPACE.. 
else if (preg_match($checkSpace, $phone, $match)) {
    echo json_encode('Invalid contact number. Please enter a valid phone number.');
}
//VALIDATION IF NAAY SPACE.. 
else if (preg_match($checkSpace, $email, $match)) {
    echo json_encode('Invalid email. Please enter a valid email.');
}

//VALIDATION IF NAAY SPECIAL CHARACTER.. 
else if (preg_match($specialCharacterRegex, $phone, $match)) {
    echo json_encode('Invalid contact number. Please enter a valid phone number.');
}

//VALIDATION IF NAAY NUMBERS ANG GI INPUT NMO SA FIRSTNAME.. 
else if (preg_match($FnameNumregex, $first_name, $match)) {
    echo json_encode("Invalid first name. Please make sure there are no numbers.");
}

//VALIDATION IF NAME IS ALREADY TAKEN.. 
else if (mysqli_num_rows($duplicate_name) > 0) {
    echo json_encode("Name is already taken.");
}
//VALIDATION IF EMAIL IS ALREADY TAKEN.. 
else if (mysqli_num_rows($duplicate_email) > 0) {
    echo json_encode("Email is already taken.");
}
//VALIDATION IF 5 LENGTH RA ANG GI INPUT NMO SA ADDRESS.. 
else if (strlen($address) < 5) {
    echo json_encode("Address is too short. Please enter a valid address.");
}
//VALIDATION IF CONTACT NUMBER IS ALREADY TAKEN.. 
else if (mysqli_num_rows($duplicate_phone) > 0) {
    echo json_encode("Phone number is already taken.");
}
//VALIDATION IF NAAY LETTERS ANG GI INPUT NMO SA CONTACT NUMBER.. IF WALA MO PROCEED SHA SA NEXT CHECKING
else if (preg_match($phoneregex, $phone, $match)) {
    echo json_encode('Invalid contact number. Please enter a valid phone number.');
} else if (strlen($phone) <= 10) {
    echo json_encode('Invalid contact number. Please enter a valid phone number.');
} else if (strlen($phone) > 11) {
    echo json_encode('Invalid contact number. Please enter a valid phone number.');
} else if (!checkBirthdate($birthdate)) {
    echo json_encode("Invalid birthdate. User must be at least 15 years old to enter the gym.");
} else if (!checkValidBdate($birthdate)) {
    echo json_encode('Invalid birthdate. Please enter a valid date.');
} else {
    if (preg_match('/^[a-zA-Z]+( [a-zA-Z]+)*$/', $first_name)) {
        if (preg_match('/^[a-zA-Z]+( [a-zA-Z]+)*$/', $last_name)) {
            if ($avail == "Yes") {
               if($member_type == "Regular") {
                $sql = "INSERT INTO `member` ( first_name,last_name,gender,birthdate,email,address,
                phone,member_type,date_registered,program_id )         
                VALUES ( '$first_name', '$last_name', '$gender', '$birthdate', '$email', 
                '$address', '$phone', '$member_type', '$date_registered','$program_id')";
                    $query_run = mysqli_query($conn, $sql);
    
                    if ($_SESSION['admin_id']) {
                        $session_admin_id = $_SESSION['admin_id'];
                    }
    
    
                    if ($query_run) {
                        //this is for puting member_id in the array
                        $data = array();
                        $sql3 = "SELECT * FROM member ORDER BY member_id DESC";
                        $res3 = mysqli_query($conn, $sql3);
                        if ($res3) {
                            while ($row = mysqli_fetch_assoc($res3)) {
                                $data[] = $row["member_id"];
                            }
    
                            $member_id = $data[0];
                        }
                    }
    
                    $login_id_data = array();
                    $sql31 = "SELECT * FROM logtrail WHERE admin_id = $session_admin_id ORDER BY login_id DESC";
                    $res31 = mysqli_query($conn, $sql31);
                    if ($res31) {
                        while ($row123 = mysqli_fetch_assoc($res31)) {
                            $login_id_data[] = $row123["login_id"];
                        }
    
                        $login_id = $login_id_data[0];
                    }
    
                    $program_id_data = array();
                    $sql311 = "SELECT * FROM program ORDER BY program_id DESC";
                    $res311 = mysqli_query($conn, $sql311);
                    if ($res311) {
                        while ($row1234 = mysqli_fetch_assoc($res311)) {
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
                    $identity = "Members";
                    $timeNow = date("h:i A");
    
                    // INSERTING program INFO FOR THE LOGTRAIL DOING
                    $sql5 = "SELECT * FROM program WHERE program_id = '$program_id'";
                    $query_run5 = mysqli_query($conn, $sql5);
                    $rows5 = mysqli_fetch_assoc($query_run5);
    
                    $program_id_new = $rows5["program_id"];
                    $date_added = date("y-m-d");
    
                    $sql1 = "INSERT INTO `logtrail_doing` ( `login_id`,`admin_id`,`member_id`,`user_fname`,`user_lname`,
                    `description`, `identity`,`time`)
                    VALUES ( '$login_id_new','$admin_id', '$member_id_new', '$user_fname','$user_lname','$regular_description','$identity', '$timeNow')";
                        mysqli_query($conn, $sql1);

                    echo json_encode("success");
               } else {
                $sql = "INSERT INTO `member` ( first_name,last_name,gender,birthdate,email,address,
                phone,member_type,date_registered)         
                VALUES ( '$first_name', '$last_name', '$gender', '$birthdate', '$email', 
                '$address', '$phone', '$member_type', '$date_registered')";
                    $query_run = mysqli_query($conn, $sql);
    
                    if ($_SESSION['admin_id']) {
                        $session_admin_id = $_SESSION['admin_id'];
                    }
    
    
                    if ($query_run) {
                        //this is for puting member_id in the array
                        $data = array();
                        $sql3 = "SELECT * FROM member ORDER BY member_id DESC";
                        $res3 = mysqli_query($conn, $sql3);
                        if ($res3) {
                            while ($row = mysqli_fetch_assoc($res3)) {
                                $data[] = $row["member_id"];
                            }
    
                            $member_id = $data[0];
                        }
                    }
    
                    $login_id_data = array();
                    $sql31 = "SELECT * FROM logtrail WHERE admin_id = $session_admin_id ORDER BY login_id DESC";
                    $res31 = mysqli_query($conn, $sql31);
                    if ($res31) {
                        while ($row123 = mysqli_fetch_assoc($res31)) {
                            $login_id_data[] = $row123["login_id"];
                        }
    
                        $login_id = $login_id_data[0];
                    }
    
                    $program_id_data = array();
                    $sql311 = "SELECT * FROM program ORDER BY program_id DESC";
                    $res311 = mysqli_query($conn, $sql311);
                    if ($res311) {
                        while ($row1234 = mysqli_fetch_assoc($res311)) {
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
                    $identity = "Members";
                    $timeNow = date("h:i A");
    
                    // INSERTING program INFO FOR THE LOGTRAIL DOING
                    $sql5 = "SELECT * FROM program WHERE program_id = '$program_id'";
                    $query_run5 = mysqli_query($conn, $sql5);
                    $rows5 = mysqli_fetch_assoc($query_run5);
    
                    $program_id_new = $rows5["program_id"];
                    $date_added = date("y-m-d");
    
                    $sql2 = "INSERT INTO `logtrail_doing` ( `login_id`,`admin_id`,`member_id`,`user_fname`,`user_lname`,
                    `description`, `identity`,`time`)
                    VALUES ( '$login_id_new','$admin_id', '$member_id_new', '$user_fname','$user_lname','$Walkin_description','$identity', '$timeNow')";
                        mysqli_query($conn, $sql2);

                    echo json_encode("success");
               }
            } else {
                $sql = "INSERT INTO `member` ( first_name,last_name,gender,birthdate,email,address,
            phone,member_type,date_registered )         
            VALUES ( '$first_name', '$last_name', '$gender', '$birthdate', '$email', 
            '$address', '$phone', '$member_type', '$date_registered')";
                $query_run = mysqli_query($conn, $sql);


                if ($_SESSION['admin_id']) {
                    $session_admin_id = $_SESSION['admin_id'];
                }


                if ($query_run) {
                    //this is for puting member_id in the array
                    $data = array();
                    $sql3 = "SELECT * FROM member ORDER BY member_id DESC";
                    $res3 = mysqli_query($conn, $sql3);
                    if ($res3) {
                        while ($row = mysqli_fetch_assoc($res3)) {
                            $data[] = $row["member_id"];
                        }

                        $member_id = $data[0];

                        $login_id_data = array();
                        $sql31 = "SELECT * FROM logtrail WHERE admin_id = $session_admin_id ORDER BY login_id DESC";
                        $res31 = mysqli_query($conn, $sql31);
                        if ($res31) {
                            while ($row123 = mysqli_fetch_assoc($res31)) {
                                $login_id_data[] = $row123["login_id"];
                            }

                            $login_id = $login_id_data[0];
                        }

                        $program_id_data = array();
                        $sql311 = "SELECT * FROM program ORDER BY program_id DESC";
                        $res311 = mysqli_query($conn, $sql311);
                        if ($res311) {
                            while ($row1234 = mysqli_fetch_assoc($res311)) {
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
                        $identity = "Members";
                        $timeNow = date("h:i A");

                        // INSERTING program INFO FOR THE LOGTRAIL DOING
                        $sql5 = "SELECT * FROM program WHERE program_id = '$program_id'";
                        $query_run5 = mysqli_query($conn, $sql5);
                        $rows5 = mysqli_fetch_assoc($query_run5);

                        $program_id_new = $rows5["program_id"];
                        $date_added = date("y-m-d");


                        if ($member_type == 'Regular') {
                            $sql1 = "INSERT INTO `logtrail_doing` ( `login_id`,`admin_id`,`member_id`,`user_fname`,`user_lname`,
                `description`, `identity`,`time`)
                VALUES ( '$login_id_new','$admin_id', '$member_id_new', '$user_fname','$user_lname','$regular_description','$identity', '$timeNow')";
                            mysqli_query($conn, $sql1);
                        } else if ($member_type == 'Walk-in') {
                            $sql2 = "INSERT INTO `logtrail_doing` ( `login_id`,`admin_id`,`member_id`,`user_fname`,`user_lname`,
                `description`, `identity`,`time`)
                VALUES ( '$login_id_new','$admin_id', '$member_id_new', '$user_fname','$user_lname','$Walkin_description','$identity', '$timeNow')";
                            mysqli_query($conn, $sql2);
                        }

                        echo json_encode("success");
                    }
                } else {
                    echo mysqli_error($conn);
                }
            }
        } else {
            echo json_encode('Invalid last name. Please make sure there are no special characters.');
        }
    } else {
        echo json_encode('Invalid last name. Please make sure there are no special characters.');
    }
}

function checkBirthdate($date)
{
    $today = date("Y-m-d");
    $byear = intval(date("Y", strtotime($date)));
    $year = intval(date("Y", strtotime($today)));

    $x = ($year - $byear < 15) ? false : true;

    return $x;
}

function checkValidBdate($date)
{
    $year = intval(date("Y", strtotime($date)));
    $now = intval(date("Y"));

    $x = ($year < 1910 || $year > $now) ? false : true;

    return $x;
}

?>