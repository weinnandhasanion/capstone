<?php
session_start();
require('./../connect.php');
date_default_timezone_set('Asia/Manila');

$session_admin_id = $_SESSION['admin_id'];

$id = $_REQUEST['id'];
$date_deleted = date("Y-m-d");
$time_deleted = date("H:i:s");

$admin_sql = "SELECT first_name,last_name,admin_id FROM admin WHERE admin_id = $session_admin_id";
$admin_query_run = mysqli_query($conn, $admin_sql);
$rows_admin = mysqli_fetch_assoc($admin_query_run);

$admin_delete_fullname = $rows_admin["first_name"] . " " . $rows_admin["last_name"];;

$ox = "UPDATE program 
        SET program_status = 'inactive',
            date_deleted = '$date_deleted', 
            time_deleted = '$time_deleted',
            admin_delete = '$admin_delete_fullname' 
        WHERE program_id = " . intval($id) . "";

if (mysqli_query($conn, $ox)) {
  $sql = "SELECT * FROM program WHERE program_status = 'active'";
  $res = mysqli_query($conn, $sql);

  if ($res) {
    $data = array();
    while ($row = mysqli_fetch_assoc($res)) {
      $data[] = $row;
    }

    $program_id = $data[0]["program_id"];

    $sql = "UPDATE member SET program_id = $program_id
            WHERE program_id = $id";
    $res = mysqli_query($conn, $sql);

    if ($res) {
      //this is for puting login_id in the array
      $data_logtrail = array();
      $login_id;
      $log = "SELECT * FROM logtrail WHERE admin_id = '" . $_SESSION["admin_id"] . "' ORDER BY login_id DESC";
      $logtrail = mysqli_query($conn, $log);
      if ($logtrail) {
        while ($rowrow = mysqli_fetch_assoc($logtrail)) {
          $data_logtrail[] = $rowrow["login_id"];
        }

        $login_id = $data_logtrail[0];
      }

      //this is for puting login_id in the array
      $data_program = array();
      $program_id;
      $progs = "SELECT * FROM program ORDER BY program_id DESC";
      $progs1 = mysqli_query($conn, $progs);
      if ($progs1) {
        while ($prog11 = mysqli_fetch_assoc($progs1)) {
          $data_program[] = $prog11["program_id"];
        }

        $program_id = $data_program[0];
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

      $identity = "Programs";
      $timeNow = date("h:i A");
      $program_id_new = $rows222["program_id"];
      $program_name = $rows222["program_name"];
      $description = "Deleted the program";
      //$description = $echo.' '.$program_name;

      $sql1 = "INSERT INTO `logtrail_doing` ( `program_id`, `login_id`,`admin_id`,`user_fname`,
           `description`, `identity`,`time`)
            VALUES ( '$program_id_new','$login_id_new','$admin_id', '$program_name','$description','$identity', '$timeNow')";
      mysqli_query($conn, $sql1);

      echo json_encode('success');
    } else {
      echo json_encode(mysqli_error($conn));
    }
  } else {
    echo json_encode(mysqli_error($conn));
  }
} else {
  echo json_encode(mysqli_error($conn));
}
