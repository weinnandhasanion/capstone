<?php 
require "./../connect.php";
session_start();
date_default_timezone_set('Asia/Manila');
if($_SESSION['admin_id']){
        $session_admin_id = $_SESSION['admin_id'];
    }


$timespan = $_POST["timespan_trainers_deleted"];
if($timespan == "Custom") {
  $fromDate = date("Y-m-d", strtotime($_POST["from_date_trainers_deleted"]));
  $toDate = date("Y-m-d", strtotime($_POST["to_date_trainers_deleted"]));
} else {  
  $fromDate = NULL;
  $toDate = NULL;
}

$reportTitle = "List of Deleted Trainers";
  if($timespan == "Custom") {
    $reportText = "Generating reports for trainers deleted from ".date("F d, Y", strtotime($fromDate))." to ".date("F d, Y", strtotime($toDate))."...";
    $sql = "SELECT * FROM trainer
            WHERE date_deleted >= '$fromDate' 
            AND date_deleted <= '$toDate'
            AND trainer_status = 'deleted'";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "Today") {
    $reportText = "Generating reports for trainers deleted today, ".date("F d, Y")."...";
    $today = date("Y-m-d");
    $sql = "SELECT * FROM trainer
            WHERE date_deleted = '$today'
            AND trainer_status = 'deleted'";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "This week") {
    $today = date("Y-m-d");
    $lastWeek = date("Y-m-d", strtotime($today. "- 7 days"));
    $reportText = "Generating reports for trainers deleted this week (".date("F d, Y", strtotime($lastWeek))." to ".date("F d, Y").")...";
    $sql = "SELECT * FROM trainer
            WHERE date_deleted >= '$lastWeek'
            AND date_deleted <= '$today'
            AND trainer_status = 'deleted'";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "This month") {
    $monthStart = date("Y-m-01");
    $monthEnd = date("Y-m-t");
    $reportText = "Generating reports for trainers deleted this month of ".date("F")."...";
    $sql = "SELECT * FROM trainer
            WHERE date_deleted >= '$monthStart'
            AND date_deleted <= '$monthEnd'
            AND trainer_status = 'deleted'";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "This year") {
    $yearStart = date("Y-01-01");
    $yearEnd = date("Y-12-31");
    $reportText = "Generating reports for trainers deleted this year (".date("Y").")...";
    $sql = "SELECT * FROM trainer
            WHERE date_deleted >= '$yearStart'
            AND date_deleted <= '$yearEnd'
            AND trainer_status = 'deleted'";
    $res = mysqli_query($conn, $sql);
  } else {
    $reportText = "Generating reports for trainers deleted since all of time...";
    $sql = "SELECT * FROM trainer WHERE  trainer_status = 'deleted'";
    $res = mysqli_query($conn, $sql);
  }

  
  $data = array();
  if($res) {
    while($row = mysqli_fetch_assoc($res)) {
      $row["name"] = $row["first_name"]." ".$row["last_name"];
      $row["date_hired"] = date("M d, Y", strtotime($row["date_hired"]));
      $row["date_deleted"] = date("M d, Y", strtotime($row["date_deleted"]));
      $data[] = $row;
    }
  }
  $labels = array("Trainer ID", "Name", "Email", "Date Registered","Date Deleted","Time Deleted");
  $rowLabels = array("trainer_id", "name", "email", "date_hired","date_deleted","time_deleted");
  
  $object = (object) [
    'data' => $data,
    'rowLabels' => $rowLabels,
    'labels' => $labels,
    'toDate' => $toDate,
    'fromDate' => $fromDate,
    'timespan' => $timespan,
    'reportTitle' => $reportTitle,
    'fileName' => "ReportTrainersDeleted_".date("MdY")
  ];
  
  $_SESSION["reports"] = $object;
  header("Location: ./../print_reports.php");

?>


<?php
//--------------------------LOGTRAIL DOING
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
$sql0 = "SELECT * FROM admin WHERE admin_id = $session_admin_id";
$query_run = mysqli_query($conn, $sql0);
$rows1 = mysqli_fetch_assoc($query_run);

$last_name = $rows1["last_name"];
$admin_id = $rows1["admin_id"];

$description = "Generated a report for list of deleted trainers";
$identity = "report";
$timeNow = date("h:i A");
$user_fname = "deleted trainers";

// INSERTING LOGTRAIL INFO  FOR THE LOGTRAIL DOING
$sql22 = "SELECT * FROM logtrail WHERE login_id = '$login_id'";
$query_run22 = mysqli_query($conn, $sql22);
$rows22 = mysqli_fetch_assoc($query_run22);

$login_id_new = $rows22["login_id"];

$sql1 = "INSERT INTO `logtrail_doing` ( `login_id`,`admin_id`, `user_fname`, `description`, `identity`,`time`)
VALUES ( '$login_id_new','$admin_id', '$user_fname', '$description','$identity', '$timeNow')";
mysqli_query($conn, $sql1);
        
?>



