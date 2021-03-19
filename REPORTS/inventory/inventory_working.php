<?php 
require "./../connect.php";
session_start();
date_default_timezone_set('Asia/Manila');
if($_SESSION['admin_id']){
        $session_admin_id = $_SESSION['admin_id'];
    }

$timespan = $_POST["timespan_inventory_working"];
$category = $_POST["inventory_category_working"];
if($timespan == "Custom") {
  $fromDate = date("Y-m-d", strtotime($_POST["from_date_inventory_working"]));
  $toDate = date("Y-m-d", strtotime($_POST["to_date_inventory_working"]));
} else {
  $fromDate = NULL;
  $toDate = NULL;
}

if($category == "Weight Equipment"){
$reportTitle = "List of working weight equipment";
  if($timespan == "Custom") {
    $reportText = "Generating reports for working weight inventory  from ".date("F d, Y", strtotime($fromDate))." to ".date("F d, Y", strtotime($toDate))."...";
    $sql = "SELECT * FROM inventory
            WHERE date_added >= '$fromDate'
            AND inventory_category = 'Weight Equipment'
            AND date_added <= '$toDate'";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "Today") {
    $reportText = "Generating reports for working weight inventory  today, ".date("F d, Y")."...";
    $today = date("Y-m-d");
    $sql = "SELECT * FROM inventory
            WHERE date_added = '$today'
            AND inventory_category = 'Weight Equipment'";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "This week") {
    $today = date("Y-m-d");
    $lastWeek = date("Y-m-d", strtotime($today. "- 7 days"));
    $reportText = "Generating reports for working weight inventory  this week (".date("F d, Y", strtotime($lastWeek))." to ".date("F d, Y").")...";
    $sql = "SELECT * FROM inventory
            WHERE date_added >= '$lastWeek'
            AND inventory_category = 'Weight Equipment'
            AND date_added <= '$today'";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "This month") {
    $monthStart = date("Y-m-01");
    $monthEnd = date("Y-m-t");
    $reportText = "Generating reports for working weight inventory  this month of ".date("F")."...";
    $sql = "SELECT * FROM inventory
            WHERE date_added >= '$monthStart'
            AND inventory_category = 'Weight Equipment'
            AND date_added <= '$monthEnd'";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "This year") {
    $yearStart = date("Y-01-01");
    $yearEnd = date("Y-12-31");
    $reportText = "Generating reports for working weight inventory  this year (".date("Y").")...";
    $sql = "SELECT * FROM inventory
            WHERE date_added >= '$yearStart'
            AND inventory_category = 'Weight Equipment'
            AND date_added <= '$yearEnd'";
    $res = mysqli_query($conn, $sql);
  } else {
    $reportText = "Generating reports for working weight inventory  since all of time...";
    $sql = "SELECT * FROM inventory WHERE inventory_category = 'Weight Equipment'";
    $res = mysqli_query($conn, $sql);
  }
}else if($category == "Cardio Equipment"){
    $reportTitle = "List of working Cardio Equipment";
    if($timespan == "Custom") {
      $reportText = "Generating reports for working Cardio inventory  from ".date("F d, Y", strtotime($fromDate))." to ".date("F d, Y", strtotime($toDate))."...";
      $sql = "SELECT * FROM inventory
              WHERE date_added >= '$fromDate'
              AND inventory_category = 'Cardio Equipment'
              AND date_added <= '$toDate'";
      $res = mysqli_query($conn, $sql);
    } else if($timespan == "Today") {
      $reportText = "Generating reports for working Cardio inventory  today, ".date("F d, Y")."...";
      $today = date("Y-m-d");
      $sql = "SELECT * FROM inventory
              WHERE date_added = '$today'
              AND inventory_category = 'Cardio Equipment'";
      $res = mysqli_query($conn, $sql);
    } else if($timespan == "This week") {
      $today = date("Y-m-d");
      $lastWeek = date("Y-m-d", strtotime($today. "- 7 days"));
      $reportText = "Generating reports for working Cardio inventory  this week (".date("F d, Y", strtotime($lastWeek))." to ".date("F d, Y").")...";
      $sql = "SELECT * FROM inventory
              WHERE date_added >= '$lastWeek'
              AND inventory_category = 'Cardio Equipment'
              AND date_added <= '$today'";
      $res = mysqli_query($conn, $sql);
    } else if($timespan == "This month") {
      $monthStart = date("Y-m-01");
      $monthEnd = date("Y-m-t");
      $reportText = "Generating reports for working Cardio inventory  this month of ".date("F")."...";
      $sql = "SELECT * FROM inventory
              WHERE date_added >= '$monthStart'
              AND inventory_category = 'Cardio Equipment'
              AND date_added <= '$monthEnd'";
      $res = mysqli_query($conn, $sql);
    } else if($timespan == "This year") {
      $yearStart = date("Y-01-01");
      $yearEnd = date("Y-12-31");
      $reportText = "Generating reports for working Cardio inventory  this year (".date("Y").")...";
      $sql = "SELECT * FROM inventory
              WHERE date_added >= '$yearStart'
              AND inventory_category = 'Cardio Equipment'
              AND date_added <= '$yearEnd'";
      $res = mysqli_query($conn, $sql);
    } else {
      $reportText = "Generating reports for working Cardio inventory  since all of time...";
      $sql = "SELECT * FROM inventory WHERE inventory_category = 'Cardio Equipment'";
      $res = mysqli_query($conn, $sql);
    }
}else if($category == "Both"){
    $reportTitle = "List of working Equipment";
    if($timespan == "Custom") {
      $reportText = "Generating reports for working inventory  from ".date("F d, Y", strtotime($fromDate))." to ".date("F d, Y", strtotime($toDate))."...";
      $sql = "SELECT * FROM inventory
              WHERE date_added >= '$fromDate'
              AND date_added <= '$toDate'";
      $res = mysqli_query($conn, $sql);
    } else if($timespan == "Today") {
      $reportText = "Generating reports for working  inventory  today, ".date("F d, Y")."...";
      $today = date("Y-m-d");
      $sql = "SELECT * FROM inventory
              WHERE date_added = '$today'";
      $res = mysqli_query($conn, $sql);
    } else if($timespan == "This week") {
      $today = date("Y-m-d");
      $lastWeek = date("Y-m-d", strtotime($today. "- 7 days"));
      $reportText = "Generating reports for working  inventory  this week (".date("F d, Y", strtotime($lastWeek))." to ".date("F d, Y").")...";
      $sql = "SELECT * FROM inventory
              WHERE date_added >= '$lastWeek'
              AND date_added <= '$today'";
      $res = mysqli_query($conn, $sql);
    } else if($timespan == "This month") {
      $monthStart = date("Y-m-01");
      $monthEnd = date("Y-m-t");
      $reportText = "Generating reports for working  inventory  this month of ".date("F")."...";
      $sql = "SELECT * FROM inventory
              WHERE date_added >= '$monthStart'
              AND date_added <= '$monthEnd'";
      $res = mysqli_query($conn, $sql);
    } else if($timespan == "This year") {
      $yearStart = date("Y-01-01");
      $yearEnd = date("Y-12-31");
      $reportText = "Generating reports for working  inventory  this year (".date("Y").")...";
      $sql = "SELECT * FROM inventory
              WHERE date_added >= '$yearStart'
              AND date_added <= '$yearEnd'";
      $res = mysqli_query($conn, $sql);
    } else {
      $reportText = "Generating reports for working  inventory  since all of time...";
      $sql = "SELECT * FROM inventory";
      $res = mysqli_query($conn, $sql);
    }
}



  //--------------------------------display
    $data = array();
    if($res) {
      while($row = mysqli_fetch_assoc($res)) {
        $row["date_added"] = date("M d, Y", strtotime($row["date_added"]));
        if($row["inventory_working"] == null){
            $row["inventory_working"] = 0;
        }
        $data[] = $row;
      }
    }
    $labels = array("Inventory ID", "Name", "Category", "Quantity","Number of Working");
    $rowLabels = array("inventory_id", "inventory_name", "inventory_category", "inventory_qty","inventory_working");
    
    $object = (object) [
      'data' => $data,
      'rowLabels' => $rowLabels,
      'labels' => $labels,
      'toDate' => $toDate,
      'fromDate' => $fromDate,
      'reportTitle' => $reportTitle,
      'timespan' => $timespan,
      'fileName' => "ReportInventoryWorking_".date("MdY")
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

$description = "Generated a report for working equipment";
$identity = "Reports";
$timeNow = date("h:i A");
$user_fname = "working equipments";

// INSERTING LOGTRAIL INFO  FOR THE LOGTRAIL DOING
$sql22 = "SELECT * FROM logtrail WHERE login_id = '$login_id'";
$query_run22 = mysqli_query($conn, $sql22);
$rows22 = mysqli_fetch_assoc($query_run22);

$login_id_new = $rows22["login_id"];

$sql1 = "INSERT INTO `logtrail_doing` ( `login_id`,`admin_id`, `user_fname`, `description`, `identity`,`time`)
VALUES ( '$login_id_new','$admin_id', '$user_fname', '$description','$identity', '$timeNow')";
mysqli_query($conn, $sql1);
        
?>

