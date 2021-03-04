<?php 
require "./../connect.php";
session_start();

$memberType = $_POST["member_type"];
$timespan = $_POST["timespan"];
if($timespan == "Custom") {
  $fromDate = date("Y-m-d", strtotime($_POST["from_date"]));
  $toDate = date("Y-m-d", strtotime($_POST["to_date"]));
} else {
  $fromDate = NULL;
  $toDate = NULL;
}

if($memberType == "Both") {
  $reportTitle = "List of members";
  if($timespan == "Custom") {
    $reportText = "Generating reports for members added from ".date("F d, Y", strtotime($fromDate))." to ".date("F d, Y", strtotime($toDate))."...";
    $sql = "SELECT * FROM member
            WHERE date_registered >= '$fromDate' 
            AND date_registered <= '$toDate'
            ORDER BY date_registered DESC";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "Today") {
    $reportText = "Generating reports for members added today, ".date("F d, Y")."...";
    $today = date("Y-m-d");
    $sql = "SELECT * FROM member
            WHERE date_registered = '$today'
            ORDER BY date_registered DESC";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "This week") {
    $today = date("Y-m-d");
    $lastWeek = date("Y-m-d", strtotime($today. "- 7 days"));
    $reportText = "Generating reports for members added this week (".date("F d, Y", strtotime($lastWeek))." to ".date("F d, Y").")...";
    $sql = "SELECT * FROM member
            WHERE date_registered >= '$lastWeek'
            AND date_registered <= '$today'
            ORDER BY date_registered DESC";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "This month") {
    $monthStart = date("Y-m-01");
    $monthEnd = date("Y-m-t");
    $reportText = "Generating reports for members added this month of ".date("F")."...";
    $sql = "SELECT * FROM member
            WHERE date_registered >= '$monthStart'
            AND date_registered <= '$monthEnd'
            ORDER BY date_registered DESC";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "This year") {
    $yearStart = date("Y-01-01");
    $yearEnd = date("Y-12-31");
    $reportText = "Generating reports for members added this year (".date("Y").")...";
    $sql = "SELECT * FROM member
            WHERE date_registered >= '$yearStart'
            AND date_registered <= '$yearEnd'
            ORDER BY date_registered DESC";
    $res = mysqli_query($conn, $sql);
  } else {
    $reportText = "Generating reports for members added since all of time...";
    $sql = "SELECT * FROM member ORDER BY date_registered DESC";
    $res = mysqli_query($conn, $sql);
  }
} else {
  $reportTitle = "List of ".strtolower($memberType)." members";
  if($timespan == "Custom") {
    $reportText = "Generating reports for members added from ".date("F d, Y", strtotime($fromDate))." to ".date("F d, Y", strtotime($toDate))."...";
    $sql = "SELECT * FROM member WHERE member_type = '$memberType' 
            AND date_registered > '$fromDate' 
            AND date_registered < '$toDate'
            ORDER BY date_registered DESC";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "Today") {
    $reportText = "Generating reports for members added today, ".date("F d, Y")."...";
    $today = date("Y-m-d");
    $sql = "SELECT * FROM member
            WHERE member_type = '$memberType'
            AND date_registered = '$today'
            ORDER BY date_registered DESC";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "This week") {
    $today = date("Y-m-d");
    $lastWeek = date("Y-m-d", strtotime($today. "- 7 days"));
    $reportText = "Generating reports for members added this week (".date("F d, Y", strtotime($lastWeek))." to ".date("F d, Y").")...";
    $sql = "SELECT * FROM member
            WHERE member_type = '$memberType'
            AND date_registered >= '$lastWeek'
            AND date_registered <= '$today'
            ORDER BY date_registered DESC";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "This month") {
    $monthStart = date("Y-m-01");
    $monthEnd = date("Y-m-t");
    $reportText = "Generating reports for members added this month of ".date("F")."...";
    $sql = "SELECT * FROM member
            WHERE member_type = '$memberType'
            AND date_registered >= '$monthStart'
            AND date_registered <= '$monthEnd'
            ORDER BY date_registered DESC";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "This year") {
    $yearStart = date("Y-01-01");
    $yearEnd = date("Y-12-31");
    $reportText = "Generating reports for members added this year (".date("Y").")...";
    $sql = "SELECT * FROM member
            WHERE member_type = '$memberType'
            AND date_registered >= '$yearStart'
            AND date_registered <= '$yearEnd'
            ORDER BY date_registered DESC";
    $res = mysqli_query($conn, $sql);
  } else {
    $reportText = "Generating reports for members added since all of time...";
    $sql = "SELECT * FROM member WHERE member_type = '$memberType' ORDER BY date_registered DESC";
    $res = mysqli_query($conn, $sql);
  }
}

$data = array();
if($res) {
  while($row = mysqli_fetch_assoc($res)) {
    $row["name"] = $row["first_name"]." ".$row["last_name"];
    $row["date_registered"] = date("M d, Y", strtotime($row["date_registered"]));
    $data[] = $row;
  }
}
$labels = array("Member ID", "Name", "Member Type", "Date Registered");
$rowLabels = array("member_id", "name", "member_type", "date_registered");

$object = (object) [
  'data' => $data,
  'rowLabels' => $rowLabels,
  'labels' => $labels,
  'toDate' => $toDate,
  'fromDate' => $fromDate,
  'reportTitle' => $reportTitle,
  'fileName' => "ReportMembersList_".date("MdY")
];

$_SESSION["reports"] = $object;
header("Location: ./../print_reports.php");
exit;
?>