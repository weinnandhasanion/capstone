<?php 
require "./../connect.php";
session_start();

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
            AND (date_deleted BETWEEN '$fromDate' AND '$toDate' OR annual_end BETWEEN '$fromDate' AND NOW())";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "Today") {
    $sql = "SELECT * FROM member
            WHERE acc_status = 'inactive'
            AND (date_deleted = '$today' OR annual_end = '$today')";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "This week") {
    $sql = "SELECT * FROM member
            WHERE acc_status = 'inactive'
            AND (date_deleted BETWEEN '$lastWeek' AND '$today' OR annual_end BETWEEN '$lastWeek' AND '$today')";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "This month") {
    $sql = "SELECT * FROM member
            WHERE acc_status = 'inactive'
            AND (date_deleted BETWEEN '$monthStart' AND '$monthEnd' OR annual_end BETWEEN '$monthStart' AND NOW())";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "This year") {
    $sql = "SELECT * FROM member
            WHERE acc_status = 'inactive'
            AND (date_deleted BETWEEN '$yearStart' AND '$yearEnd' OR annual_end BETWEEN '$yearStart' AND NOW())";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "All-time") {
    $sql = "SELECT * FROM member
            WHERE acc_status = 'inactive'";
    $res = mysqli_query($conn, $sql);
  }
} else if($status == "Deleted") {
  $reportTitle = "List of inactive (deleted) members";

  if($timespan == "Custom") {
    $sql = "SELECT * FROM member
            WHERE acc_status = 'inactive'
            AND date_deleted BETWEEN '$fromDate' AND '$toDate'";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "Today") {
    $sql = "SELECT * FROM member
            WHERE acc_status = 'inactive'
            AND date_deleted = '$today'";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "This week") {
    $sql = "SELECT * FROM member
            WHERE acc_status = 'inactive'
            AND date_deleted BETWEEN '$lastWeek' AND '$today'";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "This month") {
    $sql = "SELECT * FROM member
            WHERE acc_status = 'inactive'
            AND date_deleted BETWEEN '$monthStart' AND '$monthEnd'";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "This year") {
    $sql = "SELECT * FROM member
            WHERE acc_status = 'inactive'
            AND date_deleted BETWEEN '$yearStart' AND '$yearEnd'";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "All-time") {
    $sql = "SELECT * FROM member
            WHERE acc_status = 'inactive'
            AND date_deleted IS NOT NULL";
    $res = mysqli_query($conn, $sql);
  }
} else {
  $reportTitle = "List of inactive (expired membership) members";

  if($timespan == "Custom") {
    $sql = "SELECT * FROM member
            WHERE acc_status = 'inactive'
            AND annual_end BETWEEN '$fromDate' AND NOW()
            AND date_deleted IS NULL";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "Today") {
    $sql = "SELECT * FROM member
            WHERE acc_status = 'inactive'
            AND annual_end = '$today'
            AND date_deleted IS NULL";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "This week") {
    $sql = "SELECT * FROM member
            WHERE acc_status = 'inactive'
            AND annual_end BETWEEN '$lastWeek' AND '$today'
            AND date_deleted IS NULL";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "This month") {
    $sql = "SELECT * FROM member
            WHERE acc_status = 'inactive'
            AND annual_end BETWEEN '$monthStart' AND NOW()
            AND date_deleted IS NULL";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "This year") {
    $sql = "SELECT * FROM member
            WHERE acc_status = 'inactive'
            AND annual_end BETWEEN '$yearStart' AND NOW()
            AND date_deleted IS NULL";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "All-time") {
    $sql = "SELECT * FROM member
            WHERE acc_status = 'inactive'
            AND annual_end < NOW()
            AND date_deleted IS NULL";
    $res = mysqli_query($conn, $sql);
  }
}

$data = array();
if($res) {
  while($row = mysqli_fetch_assoc($res)) {
    $row["name"] = $row["first_name"]." ".$row["last_name"];
    $row["monthly_end"] = date("M d, Y", strtotime($row["monthly_end"]));
    $row["annual_end"] = date("M d, Y", strtotime($row["annual_end"]));
    if($row["date_deleted"] != NULL) {
      $row["date_inactive"] = date("M d, Y", strtotime($row["date_deleted"]));
      $row["reason"] = "Deleted by admin";
    } else {
      $row["date_inactive"] = date("M d, Y", strtotime($row["annual_end"]));
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
  'reportTitle' => $reportTitle,
  'fileName' => "ReportInactiveSubscriptionList_".date("MdY")
];

$_SESSION["reports"] = $object;
header("Location: ./../print_reports.php");
exit;
?>