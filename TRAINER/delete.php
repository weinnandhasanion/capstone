<?php 
session_start();
require('connect.php');
date_default_timezone_set('Asia/Manila');
if($_SESSION['admin_id']){
        $session_admin_id = $_SESSION['admin_id'];
    }

$id = $_REQUEST['id'];
$date_deleted = date("Y-m-d");
$time_deleted = date("H:i:s");

$ox = "UPDATE trainer SET trainer_status = 'deleted', date_deleted = '$date_deleted', time_deleted = '$time_deleted'
WHERE trainer_id = " . intval($id) . "";     

if(mysqli_query($conn, $ox))
        json_encode('success');
else
        echo mysqli_error($conn), 'NOT UPDATED';    
         
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
    $description = "Deleted a trainer";
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
            


?>