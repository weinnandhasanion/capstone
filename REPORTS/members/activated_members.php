<?php 
require "./../../connect.php";
session_start();
date_default_timezone_set('Asia/Manila');
if($_SESSION['admin_id']){
        $session_admin_id = $_SESSION['admin_id'];
    }


$memberType = $_POST["member_type"];
$timespan = $_POST["timespan"];
if($timespan == "Custom") {
  $fromDate = date("Y-m-d", strtotime($_POST["from_date"]));
  $toDate = date("Y-m-d", strtotime($_POST["to_date"]));
} else {
  $fromDate = NULL;
  $toDate = NULL;
}

$reportTitle = "List of members who have activated their mobile account";
if($timespan == "Custom") {
  $reportText = "Generating reports for members activated from ".date("F d, Y", strtotime($fromDate))." to ".date("F d, Y", strtotime($toDate))."...";
  $sql = "SELECT * FROM member
          WHERE acc_status = 'active'
          AND date_activated >= '$fromDate' 
          AND date_activated <= '$toDate'
          AND date_activated IS NOT NULL";
  $res = mysqli_query($conn, $sql);
} else if($timespan == "Today") {
  $reportText = "Generating reports for members activated today, ".date("F d, Y")."...";
  $today = date("Y-m-d");
  $sql = "SELECT * FROM member
          WHERE acc_status = 'active'
          AND date_activated = '$today'
          AND date_activated IS NOT NULL";
  $res = mysqli_query($conn, $sql);
} else if($timespan == "This week") {
  $today = date("Y-m-d");
  $lastWeek = date("Y-m-d", strtotime($today. "- 7 days"));
  $reportText = "Generating reports for members activated this week (".date("F d, Y", strtotime($lastWeek))." to ".date("F d, Y").")...";
  $sql = "SELECT * FROM member
          WHERE acc_status = 'active'
          AND date_activated >= '$lastWeek'
          AND date_activated <= '$today'
          AND date_activated IS NOT NULL";
  $res = mysqli_query($conn, $sql);
} else if($timespan == "This month") {
  $monthStart = date("Y-m-01");
  $monthEnd = date("Y-m-t");
  $reportText = "Generating reports for members activated this month of ".date("F")."...";
  $sql = "SELECT * FROM member
          WHERE acc_status = 'active'
          AND date_activated >= '$monthStart'
          AND date_activated <= '$monthEnd'
          AND date_activated IS NOT NULL";
  $res = mysqli_query($conn, $sql);
} else if($timespan == "This year") {
  $yearStart = date("Y-01-01");
  $yearEnd = date("Y-12-31");
  $reportText = "Generating reports for members activated this year (".date("Y").")...";
  $sql = "SELECT * FROM member
          WHERE acc_status = 'active'
          AND date_activated >= '$yearStart'
          AND date_activated <= '$yearEnd'
          AND date_activated IS NOT NULL";
  $res = mysqli_query($conn, $sql);
} else {
  $reportText = "Generating reports for members activated since all of time...";
  $sql = "SELECT * FROM member WHERE acc_status = 'active'
  AND date_activated IS NOT NULL";
  $res = mysqli_query($conn, $sql);
}

$data = array();
if($res) {
  while($row = mysqli_fetch_assoc($res)) {
    $row["name"] = $row["first_name"]." ".$row["last_name"];
    $row["date_activated"] = date("M d, Y", strtotime($row["date_activated"]));
    $data[] = $row;
  }
}
$labels = array("Member ID", "Name", "Username", "Date Activated");
$rowLabels = array("member_id", "name", "username", "date_activated");

$object = (object) [
  'data' => $data,
  'rowLabels' => $rowLabels,
  'labels' => $labels,
  'toDate' => $toDate,
  'fromDate' => $fromDate,
  'reportTitle' => $reportTitle,
  'timespan' => $timespan,
  'fileName' => "ReportMembersActivatedMobile_".date("MdY")
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
$sql0 = "SELECT first_name,last_name,admin_id FROM admin WHERE admin_id = $session_admin_id";
$query_run = mysqli_query($conn, $sql0);
$rows1 = mysqli_fetch_assoc($query_run);

$last_name = $rows1["last_name"];
$admin_id = $rows1["admin_id"];

$description = "Generated a report for members who have activated their mobile account";
$identity = "Reports";
$timeNow = date("h:i A");
$user_fname = "members activated mobile account";

// INSERTING LOGTRAIL INFO  FOR THE LOGTRAIL DOING
$sql22 = "SELECT * FROM logtrail WHERE login_id = '$login_id'";
$query_run22 = mysqli_query($conn, $sql22);
$rows22 = mysqli_fetch_assoc($query_run22);

$login_id_new = $rows22["login_id"];

$sql1 = "INSERT INTO `logtrail_doing` ( `login_id`,`admin_id`, `user_fname`, `description`, `identity`,`time`)
VALUES ( '$login_id_new','$admin_id', '$user_fname', '$description','$identity', '$timeNow')";
mysqli_query($conn, $sql1);
        
?>

