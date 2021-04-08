<?php
session_start();
require('./../connect.php');
?>

<?php
date_default_timezone_set('Asia/Manila');

if($_SESSION['admin_id']){
    $session_admin_id = $_SESSION['admin_id'];  
}

$program_name = $_POST['program_name'];
$program_description = $_POST['program_description'];
$date_added = date("Y-m-d");
// day 1
$upper1day1 = $_POST['upper-1-day-1'];
$upper2day1 = $_POST['upper-2-day-1'];
$upper3day1 = $_POST['upper-3-day-1'];
$lower1day1 = $_POST['lower-1-day-1'];
$lower2day1 = $_POST['lower-2-day-1'];
$lower3day1 = $_POST['lower-3-day-1'];
$abdominalday1 = $_POST['abdominal-day-1'];
// day 2
$upper1day2 = $_POST['upper-1-day-2'];
$upper2day2 = $_POST['upper-2-day-2'];
$upper3day2 = $_POST['upper-3-day-2'];
$lower1day2 = $_POST['lower-1-day-2'];
$lower2day2 = $_POST['lower-2-day-2'];
$lower3day2 = $_POST['lower-3-day-2'];
$abdominalday2 = $_POST['abdominal-day-2'];
// day 3
$upper1day3 = $_POST['upper-1-day-3'];
$upper2day3 = $_POST['upper-2-day-3'];
$upper3day3 = $_POST['upper-3-day-3'];
$lower1day3 = $_POST['lower-1-day-3'];
$lower2day3 = $_POST['lower-2-day-3'];
$lower3day3 = $_POST['lower-3-day-3'];
$abdominalday3 = $_POST['abdominal-day-3'];

//REGEX
$program_name_regex = "/[0-9]/";
$specialCharacterRegex  = "/[\\W_]/";
$checkSpace = "/\\s/";

 // INSERTING  ADMIN INFO 
 $sql0 = "SELECT * FROM admin WHERE admin_id = $session_admin_id";
 $query_run = mysqli_query($conn, $sql0);
 $rows = mysqli_fetch_assoc($query_run);

 $admin_id = $rows["admin_id"];
 $timeNow = date("h:i A");

//----------------------------------- ARRAY 
$data_trainer = array();
$tra = "SELECT * FROM trainer ORDER BY trainer_id DESC";
$trainers = mysqli_query($conn, $tra);
if($trainers) {
    while($row_trainer = mysqli_fetch_assoc($trainers)) {
        $data_trainer[] = $row_trainer["trainer_id"];
    }

    $trainer_id_array = $data_trainer[0];
}
// INSERTING  trainer INFO
$sql_trainer= "SELECT * FROM trainer WHERE trainer_id = $trainer_id_array";
$query_trainer = mysqli_query($conn, $sql_trainer);
$rowed_trainer = mysqli_fetch_assoc($query_trainer);

$trainer_id = $rowed_trainer["trainer_id"];

//--------------------------------------------

$exist = "SELECT * FROM program WHERE   program_name = '$program_name'";
$existProgramName = mysqli_query($conn, $exist);

if(preg_match($program_name_regex, $program_name, $match)){
    echo ("<script LANGUAGE='JavaScript'>
    window.alert('Invalid program name. make sure no numbers');
    window.location.href='./../MEMBERS/members.php';
    </script>");
}else if(preg_match($checkSpace, $program_name, $match)){
        echo ("<script LANGUAGE='JavaScript'>
        window.alert('Invalid program name. make sure no space included');
        window.location.href='./../MEMBERS/members.php';
        </script>");
}else if(mysqli_num_rows($existProgramName)>0){
    echo ("<script LANGUAGE='JavaScript'>
    window.alert('Program name is already Taken');
    window.location.href='./../MEMBERS/members.php';
    </script>");
}else if(strlen($program_name) > 20){
        echo ("<script LANGUAGE='JavaScript'>
        window.alert('Invalid program name. Maximum of 20 letters only');
        window.location.href='./../MEMBERS/members.php';
        </script>");
}else if(strlen($program_description) > 60){
        echo ("<script LANGUAGE='JavaScript'>
        window.alert('Invalid program description. Maximum of 60 letters only');
        window.location.href='./../MEMBERS/members.php';
        </script>");
}else if(strlen($program_description) < 10){
        echo ("<script LANGUAGE='JavaScript'>
        window.alert('Invalid program description. Too short for a description');
        window.location.href='./../MEMBERS/members.php';
        </script>");
//---------------DAY 1 EMPTY VALIDATION
}else if($upper1day1 == ""){
    echo ("<script LANGUAGE='JavaScript'>
    window.alert('Day 1 Upper Body 1 is empty');
    window.location.href='./../MEMBERS/members.php';
    </script>");
}else if($upper2day1 == ""){
    echo ("<script LANGUAGE='JavaScript'>
    window.alert('Day 1 Upper Body 2 is empty');
    window.location.href='./../MEMBERS/members.php';
    </script>");
}else if($upper3day1 == ""){
    echo ("<script LANGUAGE='JavaScript'>
    window.alert('Day 1 Upper Body 3 is empty');
    window.location.href='./../MEMBERS/members.php';
    </script>");
}else if($lower1day1 == ""){
    echo ("<script LANGUAGE='JavaScript'>
    window.alert('Day 1 Upper Body 3 is empty');
    window.location.href='./../MEMBERS/members.php';
    </script>");
}else if($lower2day1 == ""){
    echo ("<script LANGUAGE='JavaScript'>
    window.alert('Day 1 Upper Body 3 is empty');
    window.location.href='./../MEMBERS/members.php';
    </script>");
}else if($lower3day1 == ""){
    echo ("<script LANGUAGE='JavaScript'>
    window.alert('Day 1 Upper Body 3 is empty');
    window.location.href='./../MEMBERS/members.php';
    </script>");
}else if($abdominalday1 == ""){
    echo ("<script LANGUAGE='JavaScript'>
    window.alert('Day 1 Upper Body 3 is empty');
    window.location.href='./..//MEMBERS/members.php';
    </script>");
//---------------DAY 2 EMPTY VALIDATION
}else if($upper1day2 == ""){
    echo ("<script LANGUAGE='JavaScript'>
    window.alert('Day 1 Upper Body 1 is empty');
    window.location.href='./../MEMBERS/members.php';
    </script>");
}else if($upper2day2 == ""){
    echo ("<script LANGUAGE='JavaScript'>
    window.alert('Day 1 Upper Body 2 is empty');
    window.location.href='./../MEMBERS/members.php';
    </script>");
}else if($upper3day2 == ""){
    echo ("<script LANGUAGE='JavaScript'>
    window.alert('Day 1 Upper Body 3 is empty');
    window.location.href='./../MEMBERS/members.php';
    </script>");
}else if($lower1day2 == ""){
    echo ("<script LANGUAGE='JavaScript'>
    window.alert('Day 1 Upper Body 3 is empty');
    window.location.href='./../MEMBERS/members.php';
    </script>");
}else if($lower2day2 == ""){
    echo ("<script LANGUAGE='JavaScript'>
    window.alert('Day 1 Upper Body 3 is empty');
    window.location.href='./../MEMBERS/members.php';
    </script>");
}else if($lower3day2 == ""){
    echo ("<script LANGUAGE='JavaScript'>
    window.alert('Day 1 Upper Body 3 is empty');
    window.location.href='./.../..//MEMBERS/members.php';
    </script>");
}else if($abdominalday2 == ""){
    echo ("<script LANGUAGE='JavaScript'>
    window.alert('Day 1 Upper Body 3 is empty');
    window.location.href='./../MEMBERS/members.php';
    </script>");
//---------------DAY 3 EMPTY VALIDATION
}else if($upper1day3 == ""){
    echo ("<script LANGUAGE='JavaScript'>
    window.alert('Day 1 Upper Body 1 is empty');
    window.location.href='./../MEMBERS/members.php';
    </script>");
}else if($upper2day3 == ""){
    echo ("<script LANGUAGE='JavaScript'>
    window.alert('Day 1 Upper Body 2 is empty');
    window.location.href='./../MEMBERS/members.php';
    </script>");
}else if($upper3day3 == ""){
    echo ("<script LANGUAGE='JavaScript'>
    window.alert('Day 1 Upper Body 3 is empty');
    window.location.href='./../MEMBERS/members.php';
    </script>");
}else if($lower1day3 == ""){
    echo ("<script LANGUAGE='JavaScript'>
    window.alert('Day 1 Upper Body 3 is empty');
    window.location.href='./../MEMBERS/members.php';
    </script>");
}else if($lower2day3 == ""){
    echo ("<script LANGUAGE='JavaScript'>
    window.alert('Day 1 Upper Body 3 is empty');
    window.location.href='./../MEMBERS/members.php';
    </script>");
}else if($lower3day3 == ""){
    echo ("<script LANGUAGE='JavaScript'>
    window.alert('Day 1 Upper Body 3 is empty');
    window.location.href='./../MEMBERS/members.php';
    </script>");
}else if($abdominalday3 == ""){
    echo ("<script LANGUAGE='JavaScript'>
    window.alert('Day 1 Upper Body 3 is empty');
    window.location.href='./../MEMBERS/members.php';
    </script>");
}else{
if(preg_match('/^[a-zA-Z]+( [a-zA-Z]+)*$/', $program_name, $match)){
    $sql = "INSERT INTO `program`
    ( admin_id, trainer_id, program_name,program_description,date_added,time_added,
    upper_1_day_1,upper_2_day_1,upper_3_day_1,lower_1_day_1,lower_2_day_1,lower_3_day_1,abdominal_day_1,
    upper_1_day_2,upper_2_day_2,upper_3_day_2,lower_1_day_2,lower_2_day_2,lower_3_day_2,abdominal_day_2,
    upper_1_day_3,upper_2_day_3,upper_3_day_3,lower_1_day_3,lower_2_day_3,lower_3_day_3,abdominal_day_3
     )
    VALUES ( '$admin_id','$trainer_id','$program_name', '$program_description', '$date_added', '$timeNow',
    '$upper1day1', '$upper2day1', '$upper3day1', '$lower1day1', '$lower2day1', '$lower3day1', '$abdominalday1', 
    '$upper1day2', '$upper2day2', '$upper3day2', '$lower1day2', '$lower2day2', '$lower3day2', '$abdominalday2', 
    '$upper1day3', '$upper2day3', '$upper3day3', '$lower1day3', '$lower2day3', '$lower3day3', '$abdominalday3')"; 
    
    $query_run = mysqli_query($conn, $sql);

    echo ("<script LANGUAGE='JavaScript'>
    window.alert('program is been added.');
    window.location.href='./../MEMBERS/members.php';
    </script>");

    

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

//this is for puting login_id in the array
$data_program = array();
$program_id;
$progs = "SELECT * FROM program ORDER BY program_id DESC";
$progs1 = mysqli_query($conn, $progs);
if($progs1) {
    while($prog11 = mysqli_fetch_assoc($progs1)) {
        $data_program[] = $prog11["program_id"];
    }

    $program_id = $data_program[0];
}

// INSERTING  ADMIN INFO FOR THE LOGTRAIL DOING
$ad= "SELECT * FROM admin WHERE admin_id = $session_admin_id";
$query_runad = mysqli_query($conn, $ad);
$rowed = mysqli_fetch_assoc($query_runad);

$admin_id = $rowed["admin_id"];



// INSERTING LOGTRAIL INFO  FOR THE LOGTRAIL DOING
$sql22 = "SELECT * FROM logtrail WHERE login_id = '$login_id'";
$query_run22 = mysqli_query($conn, $sql22);
$rows22 = mysqli_fetch_assoc($query_run22);

$login_id_new = $rows22["login_id"];


// INSERTING LOGTRAIL INFO  FOR THE LOGTRAIL DOING
$sql222 = "SELECT * FROM program WHERE program_id = '$program_id'";
$query_run222 = mysqli_query($conn, $sql222);
$rows222 = mysqli_fetch_assoc($query_run222);

$program_id_new = $rows222["program_id"];
$program_name = $rows222["program_name"];   
$description = "Added a new program";
//$description = $echo.' '.$program_name;
$identity = "Programs";
$timeNow = date("h:i A");

$sql1 = "INSERT INTO `logtrail_doing` ( `program_id`, `login_id`,`admin_id`,`user_fname`,
`description`, `identity`,`time`)
VALUES ( '$program_id_new','$login_id_new','$admin_id', '$program_name','$description','$identity', '$timeNow')";
mysqli_query($conn, $sql1);

}else{
    echo ("<script LANGUAGE='JavaScript'>
    window.alert('Invalid program name, make sure no special characters...');
    window.location.href='./../MEMBERS/members.php';
    </script>");
}
}

?>