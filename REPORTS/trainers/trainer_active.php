<?php 
require "./../connect.php";
session_start();


$timespan = $_POST["timespan_trainers_active"];
if($timespan == "Custom") {
  $fromDate = date("Y-m-d", strtotime($_POST["from_date_trainers_active"]));
  $toDate = date("Y-m-d", strtotime($_POST["to_date_trainers_active"]));
} else {
  $fromDate = NULL;
  $toDate = NULL;
}

$reportTitle = "List of active Trainers";
  if($timespan == "Custom") {
    $reportText = "Generating reports for active trainers from ".date("F d, Y", strtotime($fromDate))." to ".date("F d, Y", strtotime($toDate))."...";
    $sql = "SELECT * FROM trainer
            WHERE date_hired >= '$fromDate' 
            AND date_hired <= '$toDate'
            AND  trainer_status = 'active'";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "Today") {
    $reportText = "Generating reports for active trainers  today, ".date("F d, Y")."...";
    $today = date("Y-m-d");
    $sql = "SELECT * FROM trainer
            WHERE date_hired = '$today' AND
            trainer_status = 'active'";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "This week") {
    $today = date("Y-m-d");
    $lastWeek = date("Y-m-d", strtotime($today. "- 7 days"));
    $reportText = "Generating reports for active trainers  this week (".date("F d, Y", strtotime($lastWeek))." to ".date("F d, Y").")...";
    $sql = "SELECT * FROM trainer
            WHERE date_hired >= '$lastWeek'
            AND date_hired <= '$today'
            AND trainer_status = 'active'";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "This month") {
    $monthStart = date("Y-m-01");
    $monthEnd = date("Y-m-t");
    $reportText = "Generating reports for active trainers  this month of ".date("F")."...";
    $sql = "SELECT * FROM trainer
            WHERE date_hired >= '$monthStart'
            AND date_hired <= '$monthEnd'
            AND trainer_status = 'active'";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "This year") {
    $yearStart = date("Y-01-01");
    $yearEnd = date("Y-12-31");
    $reportText = "Generating reports for active trainers this year (".date("Y").")...";
    $sql = "SELECT * FROM trainer
            WHERE date_hired >= '$yearStart'
            AND date_hired <= '$yearEnd'
            AND trainer_status = 'active'";
    $res = mysqli_query($conn, $sql);
  } else {
    $reportText = "Generating reports for active trainers  since all of time...";
    $sql = "SELECT * FROM trainer WHERE   trainer_status = 'active'";
    $res = mysqli_query($conn, $sql);
  }


  $data = array();
  if($res) {
    while($row = mysqli_fetch_assoc($res)) {
      $row["name"] = $row["first_name"]." ".$row["last_name"];
      $row["date_hired"] = date("M d, Y", strtotime($row["date_hired"]));
      $data[] = $row;
    }
  }
  $labels = array("Trainer ID", "Name", "Email", "Date Registered");
  $rowLabels = array("trainer_id", "name", "email", "date_hired");
  
  $object = (object) [
    'data' => $data,
    'rowLabels' => $rowLabels,
    'labels' => $labels,
    'toDate' => $toDate,
    'fromDate' => $fromDate,
    'reportTitle' => $reportTitle,
    'fileName' => "ReportTrainersActive_".date("MdY")
  ];
  
  $_SESSION["reports"] = $object;
  header("Location: ./../print_reports.php");
  exit;

?>
