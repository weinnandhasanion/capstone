<?php 
session_start();
require('connect.php');

date_default_timezone_set('Asia/Manila');

if($_SESSION['admin_id']){
    $session_admin_id = $_SESSION['admin_id'];
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


//-----------------------------------------------------------------------------------
$program_name= $_POST['program_name'];
$program_description= $_POST['program_description'];

    $sql_name = "UPDATE program SET program_name = '$program_name'
    WHERE program_id = '$_POST[program_id]'"; 
    $prog_name = mysqli_query($conn, $sql_name);

    $sql_description = "UPDATE program SET  program_description = '$program_description'
    WHERE program_id = '$_POST[program_id]'";
    $prog_description = mysqli_query($conn, $sql_description);

        if($prog_name ){
            
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
            $description = "Updated the program name";
            $identity = "program";
            $timeNow = date("h:i A");
            
            $sql1 = "INSERT INTO `logtrail_doing` ( `program_id`, `login_id`,`admin_id`,`user_fname`,
                    `description`, `identity`,`time`)
                     VALUES ( '$program_id_new','$login_id_new','$admin_id', '$program_name','$description','$identity', '$timeNow')";
                     mysqli_query($conn, $sql1);

            echo ("<script LANGUAGE='JavaScript'>
            window.alert('program name is updated.');
            window.location.href='/PROJECT/MEMBERS/members.php';
            </script>");

     
        }else if($prog_description){


            // INSERTING  ADMIN INFO FOR THE LOGTRAIL DOING
            $sql_admin= "SELECT * FROM admin WHERE admin_id = $session_admin_id";
            $query_run_admin = mysqli_query($conn, $sql_admin);
            $row_admin = mysqli_fetch_assoc($query_run_admin);
            
            $admin_id = $row_admin["admin_id"];
            
            
            // INSERTING LOGTRAIL INFO  FOR THE LOGTRAIL DOING
            $sql_logtrail = "SELECT * FROM logtrail WHERE login_id = '$login_id'";
            $query_run_logtrail = mysqli_query($conn, $sql_logtrail);
            $row_logtrail = mysqli_fetch_assoc($query_run_logtrail);
            
            $login_id_new = $row_logtrail["login_id"];
            
            
            // INSERTING LOGTRAIL INFO  FOR THE LOGTRAIL DOING
            $progprog = "SELECT * FROM program WHERE program_id = '$program_id'";
            $query_run_program = mysqli_query($conn, $progprog);
            $row_program= mysqli_fetch_assoc($query_run_program);
            
            $program_id_new = $row_program["program_id"];
            $program_name = $row_program["program_name"];  
            $description = "Updated the program description";
            $identity = "program";
            $timeNow = date("h:i A");
            
            $sql1 = "INSERT INTO `logtrail_doing` ( `program_id`, `login_id`,`admin_id`,`user_fname`,
                    `description`, `identity`,`time`)
                     VALUES ( '$program_id_new','$login_id_new','$admin_id', '$program_name','$description','$identity', '$timeNow')";
                     mysqli_query($conn, $sql1);

            echo ("<script LANGUAGE='JavaScript'>
            window.alert('program description is updated.');
            window.location.href='/PROJECT/MEMBERS/members.php';
            </script>");
           
        }else{
            echo "failure to register";
			header('Location: /PROJECT/MEMBERS/members.php?failure to register');
        }

  
    

    
?>