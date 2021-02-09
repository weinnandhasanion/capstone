<?php
session_start();
require('connect.php');
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




 // INSERTING  ADMIN INFO 
 $sql0 = "SELECT * FROM admin WHERE admin_id = $session_admin_id";
 $query_run = mysqli_query($conn, $sql0);
 $rows = mysqli_fetch_assoc($query_run);

 $admin_id = $rows["admin_id"];
 $timeNow = date("h:i A");

if(preg_match($program_name_regex, $program_name, $match)){
    echo ("<script LANGUAGE='JavaScript'>
    window.alert('Invalid program name. Please check, make sure no numbers...');
    window.location.href='/PROJECT/MEMBERS/members.php';
    </script>");
}else{
    
    $sql = "INSERT INTO `program` ( admin_id, program_name,program_description,date_added,time_added)
    VALUES ( '$admin_id','$program_name', '$program_description', '$date_added', '$timeNow')";

    $query_run = mysqli_query($conn, $sql);

    echo ("<script LANGUAGE='JavaScript'>
    window.alert('program is been added.');
    window.location.href='/PROJECT/MEMBERS/members.php';
    </script>");
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
$identity = "program";
$timeNow = date("h:i A");

$sql1 = "INSERT INTO `logtrail_doing` ( `program_id`, `login_id`,`admin_id`,`user_fname`,
`description`, `identity`,`time`)
VALUES ( '$program_id_new','$login_id_new','$admin_id', '$program_name','$description','$identity', '$timeNow')";
mysqli_query($conn, $sql1);

?>