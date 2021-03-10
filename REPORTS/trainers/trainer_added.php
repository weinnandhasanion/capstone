<?php 
require "./../connect.php";
session_start();


$timespan = $_POST["timespan_trainers_list"];
$status = $_POST["trainers_list_status"];
if($timespan == "Custom") {
  $fromDate = date("Y-m-d", strtotime($_POST["from_date_trainers_list"]));
  $toDate = date("Y-m-d", strtotime($_POST["to_date_trainers_list"]));
} else {
  $fromDate = NULL;
  $toDate = NULL;
}

if($status == 'active'){
$reportTitle = "List of Active Trainers";
  if($timespan == "Custom") {
    $reportText = "Generating reports for active trainers  from ".date("F d, Y", strtotime($fromDate))." to ".date("F d, Y", strtotime($toDate))."...";
    $sql = "SELECT * FROM trainer
            WHERE date_hired >= '$fromDate'
            AND trainer_status = 'active' 
            AND date_hired <= '$toDate'";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "Today") {
    $reportText = "Generating reports for active trainers  today, ".date("F d, Y")."...";
    $today = date("Y-m-d");
    $sql = "SELECT * FROM trainer
            WHERE date_hired = '$today'
            AND trainer_status = 'active'";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "This week") {
    $today = date("Y-m-d");
    $lastWeek = date("Y-m-d", strtotime($today. "- 7 days"));
    $reportText = "Generating reports for active trainers  this week (".date("F d, Y", strtotime($lastWeek))." to ".date("F d, Y").")...";
    $sql = "SELECT * FROM trainer
            WHERE date_hired >= '$lastWeek'
            AND trainer_status = 'active'
            AND date_hired <= '$today'";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "This month") {
    $monthStart = date("Y-m-01");
    $monthEnd = date("Y-m-t");
    $reportText = "Generating reports for active trainers  this month of ".date("F")."...";
    $sql = "SELECT * FROM trainer
            WHERE date_hired >= '$monthStart'
            AND trainer_status = 'active'
            AND date_hired <= '$monthEnd'";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "This year") {
    $yearStart = date("Y-01-01");
    $yearEnd = date("Y-12-31");
    $reportText = "Generating reports for active trainers  this year (".date("Y").")...";
    $sql = "SELECT * FROM trainer
            WHERE date_hired >= '$yearStart'
            AND trainer_status = 'active'
            AND date_hired <= '$yearEnd'";
    $res = mysqli_query($conn, $sql);
  } else {
    $reportText = "Generating reports for active trainers  since all of time...";
    $sql = "SELECT * FROM trainer WHERE trainer_status = 'active'";
    $res = mysqli_query($conn, $sql);
  }
}else if($status == 'inactive'){
  $reportTitle = "List of Inactive Trainers";
  if($timespan == "Custom") {
    $reportText = "Generating reports for inactive trainers  from ".date("F d, Y", strtotime($fromDate))." to ".date("F d, Y", strtotime($toDate))."...";
    $sql = "SELECT * FROM trainer
            WHERE date_hired >= '$fromDate'
            AND trainer_status = 'inactive' 
            AND date_hired <= '$toDate'";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "Today") {
    $reportText = "Generating reports for inactive trainers  today, ".date("F d, Y")."...";
    $today = date("Y-m-d");
    $sql = "SELECT * FROM trainer
            WHERE date_hired = '$today'
            AND trainer_status = 'inactive'";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "This week") {
    $today = date("Y-m-d");
    $lastWeek = date("Y-m-d", strtotime($today. "- 7 days"));
    $reportText = "Generating reports for inactive trainers  this week (".date("F d, Y", strtotime($lastWeek))." to ".date("F d, Y").")...";
    $sql = "SELECT * FROM trainer
            WHERE date_hired >= '$lastWeek'
            AND trainer_status = 'inactive'
            AND date_hired <= '$today'";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "This month") {
    $monthStart = date("Y-m-01");
    $monthEnd = date("Y-m-t");
    $reportText = "Generating reports for inactive trainers  this month of ".date("F")."...";
    $sql = "SELECT * FROM trainer
            WHERE date_hired >= '$monthStart'
            AND trainer_status = 'inactive'
            AND date_hired <= '$monthEnd'";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "This year") {
    $yearStart = date("Y-01-01");
    $yearEnd = date("Y-12-31");
    $reportText = "Generating reports for inactive trainers  this year (".date("Y").")...";
    $sql = "SELECT * FROM trainer
            WHERE date_hired >= '$yearStart'
            AND trainer_status = 'inactive'
            AND date_hired <= '$yearEnd'";
    $res = mysqli_query($conn, $sql);
  } else {
    $reportText = "Generating reports for inactive trainers  since all of time...";
    $sql = "SELECT * FROM trainer WHERE trainer_status = 'inactive'";
    $res = mysqli_query($conn, $sql);
  }
}else if($status == 'deleted'){
  $reportTitle = "List of Deleted Trainers";
  if($timespan == "Custom") {
    $reportText = "Generating reports for deleted trainers  from ".date("F d, Y", strtotime($fromDate))." to ".date("F d, Y", strtotime($toDate))."...";
    $sql = "SELECT * FROM trainer
            WHERE date_hired >= '$fromDate'
            AND trainer_status = 'deleted' 
            AND date_hired <= '$toDate'";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "Today") {
    $reportText = "Generating reports for deleted trainers  today, ".date("F d, Y")."...";
    $today = date("Y-m-d");
    $sql = "SELECT * FROM trainer
            WHERE date_hired = '$today'
            AND trainer_status = 'deleted'";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "This week") {
    $today = date("Y-m-d");
    $lastWeek = date("Y-m-d", strtotime($today. "- 7 days"));
    $reportText = "Generating reports for deleted trainers  this week (".date("F d, Y", strtotime($lastWeek))." to ".date("F d, Y").")...";
    $sql = "SELECT * FROM trainer
            WHERE date_hired >= '$lastWeek'
            AND trainer_status = 'deleted'
            AND date_hired <= '$today'";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "This month") {
    $monthStart = date("Y-m-01");
    $monthEnd = date("Y-m-t");
    $reportText = "Generating reports for deleted trainers  this month of ".date("F")."...";
    $sql = "SELECT * FROM trainer
            WHERE date_hired >= '$monthStart'
            AND trainer_status = 'deleted'
            AND date_hired <= '$monthEnd'";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "This year") {
    $yearStart = date("Y-01-01");
    $yearEnd = date("Y-12-31");
    $reportText = "Generating reports for deleted trainers  this year (".date("Y").")...";
    $sql = "SELECT * FROM trainer
            WHERE date_hired >= '$yearStart'
            AND trainer_status = 'deleted'
            AND date_hired <= '$yearEnd'";
    $res = mysqli_query($conn, $sql);
  } else {
    $reportText = "Generating reports for deleted trainers  since all of time...";
    $sql = "SELECT * FROM trainer WHERE trainer_status = 'deleted'";
    $res = mysqli_query($conn, $sql);
  }
}


if($_POST["trainers_list_status"] == "active" || $_POST["trainers_list_status"] == "inactive"){
$data = array();
  if($res) {
    while($row = mysqli_fetch_assoc($res)) {
      $row["name"] = $row["first_name"]." ".$row["last_name"];
      $row["date_hired"] = date("M d, Y", strtotime($row["date_hired"]));
      $data[] = $row;
    }
  }

$labels = array( "Name","Gender", "Contact Number", "Email",  "Date Registered");
$rowLabels = array("name","gender", "phone","email", "date_hired");

  $object = (object) [
    'data' => $data,
    'rowLabels' => $rowLabels,
    'labels' => $labels,
    'toDate' => $toDate,
    'fromDate' => $fromDate,
    'reportTitle' => $reportTitle,
    'fileName' => "ReportTrainerList_".date("MdY")
  ];

}else if($_POST["trainers_list_status"] == "deleted"){
$data = array();
  if($res) {
    while($row = mysqli_fetch_assoc($res)) {
    $row["name"] = $row["first_name"]." ".$row["last_name"];
    $row["date_hired"] = date("M d, Y", strtotime($row["date_hired"]));
    $data[] = $row;
    }
  }
  $labels = array( "Name","Gender", "Contact Number", "Email",  "Date Registered", "Date deleted", "Time deleted");
$rowLabels = array("name","gender", "phone","email", "date_hired", "date_deleted", "time_deleted");
  
  $object = (object) [
    'data' => $data,
    'rowLabels' => $rowLabels,
    'labels' => $labels,
    'toDate' => $toDate,
    'fromDate' => $fromDate,
    'reportTitle' => $reportTitle,
    'fileName' => "ReportTrainersList_".date("MdY")
  ];
}



$_SESSION["reports"] = $object;
header("Location: ./../print_reports.php");
exit;

?>


