<?php 
require "./../connect.php";
session_start();
date_default_timezone_set('Asia/Manila');
if($_SESSION['admin_id']){
        $session_admin_id = $_SESSION['admin_id'];
    }


$status = $_POST["status"];
$timespan = $_POST["timespan"];
if($timespan == "Custom") {
  $fromDate = date("Y-m-d", strtotime($_POST["from_date"]));
  $toDate = date("Y-m-d", strtotime($_POST["to_date"]));
} else {
  $fromDate = NULL;
  $toDate = NULL;
}

$today = date("Y-m-d");
$lastWeek = date("Y-m-d", strtotime($today. "- 7 days"));
$monthStart = date("Y-m-01");
$monthEnd = date("Y-m-t");
$yearStart = date("Y-01-01");
$yearEnd = date("Y-12-31");

if($status == "Both") {
  $reportTitle = "List of inactive members";

  if($timespan == "Custom") {
    $sql = "SELECT * FROM member
            WHERE acc_status = 'inactive'
            AND date_deleted BETWEEN '$fromDate' AND '$toDate'
            ORDER BY date_deleted DESC";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "Today") {
    $sql = "SELECT * FROM member
            WHERE acc_status = 'inactive'
            AND (date_deleted = '$today')";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "This week") {
    $sql = "SELECT * FROM member
            WHERE acc_status = 'inactive'
            AND date_deleted BETWEEN '$lastWeek' AND '$today'
            ORDER BY date_deleted DESC";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "This month") {
    $sql = "SELECT * FROM member
            WHERE acc_status = 'inactive'
            AND date_deleted BETWEEN '$monthStart' AND '$monthEnd'
            ORDER BY date_deleted DESC";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "This year") {
    $sql = "SELECT * FROM member
            WHERE acc_status = 'inactive'
            AND date_deleted BETWEEN '$yearStart' AND '$yearEnd'
            ORDER BY date_deleted DESC";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "All-time") {
    $sql = "SELECT * FROM member
            WHERE acc_status = 'inactive'
            ORDER BY date_deleted DESC";
    $res = mysqli_query($conn, $sql);
  }
} else if($status == "Deleted") {
  $reportTitle = "List of inactive (deleted) members";

  if($timespan == "Custom") {
    $sql = "SELECT * FROM member
            WHERE acc_status = 'inactive'
            AND date_deleted BETWEEN '$fromDate' AND '$toDate'
            AND isDeleted = 'true'
            ORDER BY date_deleted DESC";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "Today") {
    $sql = "SELECT * FROM member
            WHERE acc_status = 'inactive'
            AND date_deleted = '$today'
            AND isDeleted = 'true'
            ORDER BY date_deleted DESC";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "This week") {
    $sql = "SELECT * FROM member
            WHERE acc_status = 'inactive'
            AND date_deleted BETWEEN '$lastWeek' AND '$today'
            AND isDeleted = 'true'
            ORDER BY date_deleted DESC";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "This month") {
    $sql = "SELECT * FROM member
            WHERE acc_status = 'inactive'
            AND date_deleted BETWEEN '$monthStart' AND '$monthEnd'
            AND isDeleted = 'true'
            ORDER BY date_deleted DESC";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "This year") {
    $sql = "SELECT * FROM member
            WHERE acc_status = 'inactive'
            AND date_deleted BETWEEN '$yearStart' AND '$yearEnd'
            AND isDeleted = 'true'
            ORDER BY date_deleted DESC";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "All-time") {
    $sql = "SELECT * FROM member
            WHERE acc_status = 'inactive'
            AND isDeleted = 'true'
            ORDER BY date_deleted DESC";
    $res = mysqli_query($conn, $sql);
  }
} else {
  $reportTitle = "List of inactive (expired membership) members";

  if($timespan == "Custom") {
    $sql = "SELECT * FROM member
            WHERE acc_status = 'inactive'
            AND annual_end BETWEEN '$fromDate' AND NOW()
            AND isDeleted = 'false'
            ORDER BY date_deleted DESC";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "Today") {
    $sql = "SELECT * FROM member
            WHERE acc_status = 'inactive'
            AND annual_end = '$today'
            AND isDeleted = 'false'
            ORDER BY date_deleted DESC";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "This week") {
    $sql = "SELECT * FROM member
            WHERE acc_status = 'inactive'
            AND annual_end BETWEEN '$lastWeek' AND '$today'
            AND isDeleted = 'false'
            ORDER BY date_deleted DESC";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "This month") {
    $sql = "SELECT * FROM member
            WHERE acc_status = 'inactive'
            AND annual_end BETWEEN '$monthStart' AND NOW()
            AND isDeleted = 'false'
            ORDER BY date_deleted DESC";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "This year") {
    $sql = "SELECT * FROM member
            WHERE acc_status = 'inactive'
            AND annual_end BETWEEN '$yearStart' AND NOW()
            AND isDeleted = 'false'
            ORDER BY date_deleted DESC";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "All-time") {
    $sql = "SELECT * FROM member
            WHERE acc_status = 'inactive'
            AND annual_end < NOW()
            AND isDeleted = 'false'
            ORDER BY date_deleted DESC";
    $res = mysqli_query($conn, $sql);
  }
}

$data = array();
if($res) {
  while($row = mysqli_fetch_assoc($res)) {
    $row["name"] = $row["first_name"]." ".$row["last_name"];
    $row["monthly_end"] = date("M d, Y", strtotime($row["monthly_end"]));
    $row["annual_end"] = date("M d, Y", strtotime($row["annual_end"]));
    $row["date_inactive"] = date("M d, Y", strtotime($row["date_deleted"]));
    if($row["isDeleted"] == "true") {
      $row["reason"] = "Deleted by admin";
    } else {
      $row["reason"] = "Failure to renew annual membership";
    }
    $data[] = $row;
  }
}
$labels = array("Member ID", "Name", "Reason for Inactivity", "Date Inactive");
$rowLabels = array("member_id", "name", "reason", "date_inactive");

$object = (object) [
  'data' => $data,
  'rowLabels' => $rowLabels,
  'labels' => $labels,
  'toDate' => $toDate,
  'fromDate' => $fromDate,
  'timespan' => $timespan,
  'reportTitle' => $reportTitle,
  'fileName' => "ReportInactiveSubscriptionList_".date("MdY")
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

$description = "Generated a report for list of inactive members";
$identity = "Reports";
$timeNow = date("h:i A");
$user_fname = "list of inactive members";

// INSERTING LOGTRAIL INFO  FOR THE LOGTRAIL DOING
$sql22 = "SELECT * FROM logtrail WHERE login_id = '$login_id'";
$query_run22 = mysqli_query($conn, $sql22);
$rows22 = mysqli_fetch_assoc($query_run22);

$login_id_new = $rows22["login_id"];

$sql1 = "INSERT INTO `logtrail_doing` ( `login_id`,`admin_id`, `user_fname`, `description`, `identity`,`time`)
VALUES ( '$login_id_new','$admin_id', '$user_fname', '$description','$identity', '$timeNow')";
mysqli_query($conn, $sql1);
        
?>