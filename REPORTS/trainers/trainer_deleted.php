<?php 
require "./../connect.php";
session_start();


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
    'reportTitle' => $reportTitle,
    'fileName' => "ReportTrainersDeleted_".date("MdY")
  ];
  
  $_SESSION["reports"] = $object;
  header("Location: ./../print_reports.php");
  exit;

?>
