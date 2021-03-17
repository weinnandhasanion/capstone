<?php 
session_start();
require('connect.php');
date_default_timezone_set('Asia/Manila');

if($_SESSION['admin_id']){
    $session_admin_id = $_SESSION['admin_id'];
}

//----------------------------------------------------------------------------------- UPDATE
$id = $_REQUEST['id'];
$program_name = $_POST['program_name'];
$program_description = $_POST['program_description'];  
$trainer_id = $_POST["trainer_id"];

$upper1day1 = $_POST['upper-1-day-1'];
$upper2day1 = $_POST['upper-2-day-1']; 
$upper3day1 = $_POST['upper-3-day-1']; 
$lower1day1 = $_POST['lower-1-day-1'];
$lower2day1 = $_POST['lower-2-day-1']; 
$lower3day1 = $_POST['lower-3-day-1'];  
$abdominalday1 = $_POST['abdominal-day-1']; 

$upper1day2 = $_POST['upper-1-day-2'];
$upper2day2 = $_POST['upper-2-day-2']; 
$upper3day2 = $_POST['upper-3-day-2']; 
$lower1day2 = $_POST['lower-1-day-2'];
$lower2day2 = $_POST['lower-2-day-2']; 
$lower3day2 = $_POST['lower-3-day-2'];  
$abdominalday2 = $_POST['abdominal-day-2']; 

$upper1day3 = $_POST['upper-1-day-3'];
$upper2day3 = $_POST['upper-2-day-3']; 
$upper3day3 = $_POST['upper-3-day-3']; 
$lower1day3 = $_POST['lower-1-day-3'];
$lower2day3 = $_POST['lower-2-day-3']; 
$lower3day3 = $_POST['lower-3-day-3'];  
$abdominalday3 = $_POST['abdominal-day-3']; 

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

   
//--------------------------------------------------------------------------
            
if($query) {
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
    $description = "Updated the program";
    $identity = "program";
    $timeNow = date("h:i A");
    
    $sql1 = "INSERT INTO `logtrail_doing` ( `program_id`, `login_id`,`admin_id`,`user_fname`,
            `description`, `identity`,`time`)
            VALUES ( '$program_id_new','$login_id_new','$admin_id', '$program_name','$description','$identity', '$timeNow')";
            mysqli_query($conn, $sql1);

    echo "<script>
        alert('Program is successfully updated!');
        window.location.href = './members.php';
        </script>";
} else {
    echo "<script>
        alert('Update unsuccessful. Error: ". mysqli_error($conn) ."');
        </script>";
}