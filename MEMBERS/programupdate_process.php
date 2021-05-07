<?php
session_start();
require('./../connect.php');
date_default_timezone_set('Asia/Manila');

if ($_SESSION['admin_id']) {
    $session_admin_id = $_SESSION['admin_id'];
}

//----------------------------------------------------------------------------------- UPDATE
$id = $_POST['program_id'];
$program_name = $_POST['program_name'];
$program_description = $_POST['program_description'];
$trainer_id = $_POST["trainer_id"];

$upper1day1 = $_POST['u1d1'];
$upper2day1 = $_POST['u2d1'];
$upper3day1 = $_POST['u3d1'];
$lower1day1 = $_POST['l1d1'];
$lower2day1 = $_POST['l2d1'];
$lower3day1 = $_POST['l3d1'];
$abdominalday1 = $_POST['ad1'];

$upper1day2 = $_POST['u1d2'];
$upper2day2 = $_POST['u2d2'];
$upper3day2 = $_POST['u3d2'];
$lower1day2 = $_POST['l1d2'];
$lower2day2 = $_POST['l2d2'];
$lower3day2 = $_POST['l3d2'];
$abdominalday2 = $_POST['ad2'];

$upper1day3 = $_POST['u1d3'];
$upper2day3 = $_POST['u2d3'];
$upper3day3 = $_POST['u3d3'];
$lower1day3 = $_POST['l1d3'];
$lower2day3 = $_POST['l2d3'];
$lower3day3 = $_POST['l3d3'];
$abdominalday3 = $_POST['ad3'];
$NumberRegex = "/[0-9]/";
$specialCharacterRegex  = "/[\\W_]/";
$checkSpace = "/\\s/";

$exist = "SELECT * FROM program WHERE program_id != '$id' AND program_name = '$program_name'";
$existProgramName = mysqli_query($conn, $exist);

$exist1 = "SELECT * FROM program WHERE program_id != '$id' AND program_description = '$program_description'";
$existProgramDescription = mysqli_query($conn, $exist1);

if (preg_match($NumberRegex, $program_name, $match)) {
    echo json_encode("Invalid program name. Please make sure there are no numbers.");
} else if (preg_match($NumberRegex, $program_description, $match)) {
    echo json_encode("Invalid program description. Please make sure there are no numbers.");
} else if (mysqli_num_rows($existProgramName) > 0) {
    echo json_encode("Program name is already taken.");
} else if (mysqli_num_rows($existProgramDescription) > 0) {
    echo json_encode("Program description is already taken.");
} else if (strlen($program_name) > 20) {
    echo json_encode("Invalid program name. Maximum of 20 letters only");
} else if (strlen($program_description) > 100) {
    echo json_encode("Invalid program description. Maximum of 100 letters only.");
} else {
    if (preg_match('/^[a-zA-Z]+( [a-zA-Z]+)*$/', $program_name, $match)) {
        $sql_update = "UPDATE program 
    SET program_name = '$program_name', program_description = '$program_description', trainer_id = '$trainer_id',
    upper_1_day_1 = '$upper1day1', upper_2_day_1 = '$upper2day1', upper_3_day_1 = '$upper3day1',
    lower_1_day_1 = '$lower1day1', lower_2_day_1 = '$lower2day1', lower_3_day_1 = '$lower3day1', abdominal_day_1 = '$abdominalday1',
    upper_1_day_2 = '$upper1day2', upper_2_day_2 = '$upper2day2', upper_3_day_2 = '$upper3day2',
    lower_1_day_2 = '$lower1day2', lower_2_day_2 = '$lower2day2', lower_3_day_2 = '$lower3day2', abdominal_day_2 = '$abdominalday2',
    upper_1_day_3 = '$upper1day3', upper_2_day_3 = '$upper2day3', upper_3_day_3 = '$upper3day3',
    lower_1_day_3 = '$lower1day3', lower_2_day_3 = '$lower2day3', lower_3_day_3 = '$lower3day3', abdominal_day_3 = '$abdominalday3'
    WHERE program_id =" . intval($id) . "";
        $query = mysqli_query($conn, $sql_update);

        echo json_encode("success");

        //this is for puting login_id in the array
        $data_logtrail = array();
        $login_id;
        $log = "SELECT * FROM logtrail ORDER BY login_id DESC";
        $logtrail = mysqli_query($conn, $log);
        if ($logtrail) {
            while ($rowrow = mysqli_fetch_assoc($logtrail)) {
                $data_logtrail[] = $rowrow["login_id"];
            }

            $login_id = $data_logtrail[0];
        }

        // INSERTING  ADMIN INFO FOR THE LOGTRAIL DOING
        $ad = "SELECT * FROM admin WHERE admin_id = $session_admin_id";
        $query_runad = mysqli_query($conn, $ad);
        $rowed = mysqli_fetch_assoc($query_runad);

        $admin_id = $rowed["admin_id"];


        // INSERTING LOGTRAIL INFO  FOR THE LOGTRAIL DOING
        $sql22 = "SELECT * FROM logtrail WHERE login_id = '$login_id'";
        $query_run22 = mysqli_query($conn, $sql22);
        $rows22 = mysqli_fetch_assoc($query_run22);

        $login_id_new = $rows22["login_id"];


        // INSERTING LOGTRAIL INFO  FOR THE LOGTRAIL DOING
        $sql222 = "SELECT * FROM program WHERE program_id = '$id'";
        $query_run222 = mysqli_query($conn, $sql222);
        $rows222 = mysqli_fetch_assoc($query_run222);

        $program_id_new = $rows222["program_id"];
        $program_name = $rows222["program_name"];
        $description = "Updated the program";
        $identity = "Programs";
        $timeNow = date("h:i A");

        $sql1 = "INSERT INTO `logtrail_doing` ( `program_id`, `login_id`,`admin_id`,`user_fname`,
               `description`, `identity`,`time`)
               VALUES ( '$id','$login_id_new','$admin_id', '$program_name','$description','$identity', '$timeNow')";
        mysqli_query($conn, $sql1);
    } else {
        echo json_encode("Invalid program name. Please make sure there are no special characters.");
    }
}
