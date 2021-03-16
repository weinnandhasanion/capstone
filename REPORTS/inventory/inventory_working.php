<?php 
require "./../connect.php";
session_start();


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
exit;

?>
