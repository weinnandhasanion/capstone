<?php 
session_start();
require('./../connect.php');
date_default_timezone_set('Asia/Manila');

if($_SESSION['admin_id']){
    $session_admin_id = $_SESSION['admin_id'];
}

  
$id = $_REQUEST['id'];

$ox = "UPDATE program SET program_status = 'active', date_deleted = null, time_deleted = null 
WHERE program_id = " . intval($id) . "";     
   

if(mysqli_query($conn, $ox))
        json_encode('success');
else
        echo mysqli_error($conn), 'NOT UPDATED';    

       
?>

<?php 
    //this is for puting login_id in the array
    $data_logtrail = array();
    $login_id;
    $log = "SELECT * FROM logtrail WHERE admin_id = $session_admin_id ORDER BY login_id DESC";
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

 
 // INSERTING LOGTRAIL INFO  FOR THE LOGTRAIL DOING
 $sql22 = "SELECT * FROM logtrail WHERE login_id = '$login_id'";
 $query_run22 = mysqli_query($conn, $sql22);
 $rows22 = mysqli_fetch_assoc($query_run22);
 
 $login_id_new = $rows22["login_id"];
 
 
 // INSERTING LOGTRAIL INFO  FOR THE LOGTRAIL DOING
 $sql222 = "SELECT * FROM program WHERE program_id = '$id'";
 $query_run222 = mysqli_query($conn, $sql222);
 $rows222 = mysqli_fetch_assoc($query_run222);

 $identity = "Programs";
 $timeNow = date("h:i A");
 $program_id_new = $rows222["program_id"];
 $program_name = $rows222["program_name"];   
 $description = "Recover the program";
 //$description = $echo.' '.$program_name;
 
 $sql1 = "INSERT INTO `logtrail_doing` ( `program_id`, `login_id`,`admin_id`,`user_fname`,
 `description`, `identity`,`time`)
  VALUES ( '$program_id_new','$login_id_new','$admin_id', '$program_name','$description','$identity', '$timeNow')";
  mysqli_query($conn, $sql1);

?>