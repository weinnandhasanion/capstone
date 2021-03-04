<?php 
require "./../connect.php";
session_start();

$promo_status = $_POST["status"];
$timespan = $_POST["timespan_promos_seasonal"];
if($timespan == "Custom") {
  $fromDate = date("Y-m-d", strtotime($_POST["from_date_promos_seasonal"]));
  $toDate = date("Y-m-d", strtotime($_POST["to_date_promos_seasonal"]));
} else {
  $fromDate = NULL;
  $toDate = NULL;
}

if($promo_status == "Active"){
  $reportTitle = "List of Active Seasonal Promos";
  if($timespan == "Custom") {
    $reportText = "Generating reports for active Seasonal promo  from ".date("F d, Y", strtotime($fromDate))." to ".date("F d, Y", strtotime($toDate))."...";
    $sql = "SELECT * FROM promo
            WHERE date_added >= '$fromDate' 
            AND date_added <= '$toDate'
            AND status = 'Active'
            AND promo_type = 'Seasonal'";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "Today") {
    $reportText = "Generating reports for active Seasonal promo   today, ".date("F d, Y")."...";
    $today = date("Y-m-d");
    $sql = "SELECT * FROM promo
            WHERE date_added = '$today' AND
            status = 'Active'
            AND promo_type = 'Seasonal'";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "This week") {
    $today = date("Y-m-d");
    $lastWeek = date("Y-m-d", strtotime($today. "- 7 days"));
    $reportText = "Generating reports for active  Seasonal promo  this week (".date("F d, Y", strtotime($lastWeek))." to ".date("F d, Y").")...";
    $sql = "SELECT * FROM promo
            WHERE date_added >= '$lastWeek'
            AND date_added <= '$today'
            AND status = 'Active'
            AND promo_type = 'Seasonal'";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "This month") {
    $monthStart = date("Y-m-01");
    $monthEnd = date("Y-m-t");
    $reportText = "Generating reports for active Seasonal promo  this month of ".date("F")."...";
    $sql = "SELECT * FROM promo
            WHERE date_added >= '$monthStart'
            AND date_added <= '$monthEnd'
            AND status = 'Active'
            AND promo_type = 'Seasonal'";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "This year") {
    $yearStart = date("Y-01-01");
    $yearEnd = date("Y-12-31");
    $reportText = "Generating reports for active  Seasonal promo this year (".date("Y").")...";
    $sql = "SELECT * FROM promo
            WHERE date_added >= '$yearStart'
            AND date_added <= '$yearEnd'
            AND status = 'Active'
            AND promo_type = 'Seasonal'";
    $res = mysqli_query($conn, $sql);
  } else {
    $reportText = "Generating reports for active  Seasonal promo  since all of time...";
    $sql = "SELECT * FROM promo WHERE   status = 'Active' AND promo_type = 'Seasonal'";
    $res = mysqli_query($conn, $sql);
  }
}else if($promo_status == "Expired"){
  $reportTitle = "List of Expired Seasonal Promos";
    if($timespan == "Custom") {
        $reportText = "Generating reports for Expired Seasonal promo from ".date("F d, Y", strtotime($fromDate))." to ".date("F d, Y", strtotime($toDate))."...";
        $sql = "SELECT * FROM promo
                WHERE date_added >= '$fromDate' 
                AND date_added <= '$toDate'
                AND status = 'Expired'
                AND promo_type = 'Seasonal'";
        $res = mysqli_query($conn, $sql);
      } else if($timespan == "Today") {
        $reportText = "Generating reports for Expired  Seasonal promo  today, ".date("F d, Y")."...";
        $today = date("Y-m-d");
        $sql = "SELECT * FROM promo
                WHERE date_added = '$today' AND
                status = 'Expired'
                AND promo_type = 'Seasonal'";
        $res = mysqli_query($conn, $sql);
      } else if($timespan == "This week") {
        $today = date("Y-m-d");
        $lastWeek = date("Y-m-d", strtotime($today. "- 7 days"));
        $reportText = "Generating reports for Expired  Seasonal promo  this week (".date("F d, Y", strtotime($lastWeek))." to ".date("F d, Y").")...";
        $sql = "SELECT * FROM promo
                WHERE date_added >= '$lastWeek'
                AND date_added <= '$today'
                AND status = 'Expired'
                AND promo_type = 'Seasonal'";
        $res = mysqli_query($conn, $sql);
      } else if($timespan == "This month") {
        $monthStart = date("Y-m-01");
        $monthEnd = date("Y-m-t");
        $reportText = "Generating reports for Expired  Seasonal promo  this month of ".date("F")."...";
        $sql = "SELECT * FROM promo
                WHERE date_added >= '$monthStart'
                AND date_added <= '$monthEnd'
                AND status = 'Expired'
                AND promo_type = 'Seasonal'";
        $res = mysqli_query($conn, $sql);
      } else if($timespan == "This year") {
        $yearStart = date("Y-01-01");
        $yearEnd = date("Y-12-31");
        $reportText = "Generating reports for Expired  Seasonal promo this year (".date("Y").")...";
        $sql = "SELECT * FROM promo
                WHERE date_added >= '$yearStart'
                AND date_added <= '$yearEnd'
                AND status = 'Expired'
                AND promo_type = 'Seasonal'";
        $res = mysqli_query($conn, $sql);
      } else {
        $reportText = "Generating reports for Expired  Seasonal promo  since all of time...";
        $sql = "SELECT * FROM promo WHERE   status = 'Expired'  AND promo_type = 'Seasonal'";
        $res = mysqli_query($conn, $sql);
      }
}else if($promo_status == "Deleted"){
  $reportTitle = "List of Deleted Seasonal Promos";
    if($timespan == "Custom") {
        $reportText = "Generating reports for Deleted Seasonal promo from ".date("F d, Y", strtotime($fromDate))." to ".date("F d, Y", strtotime($toDate))."...";
        $sql = "SELECT * FROM promo
                WHERE date_added >= '$fromDate' 
                AND date_added <= '$toDate'
                AND status = 'Deleted'
                AND promo_type = 'Seasonal'";
        $res = mysqli_query($conn, $sql);
      } else if($timespan == "Today") {
        $reportText = "Generating reports for Deleted  Seasonal promo  today, ".date("F d, Y")."...";
        $today = date("Y-m-d");
        $sql = "SELECT * FROM promo
                WHERE date_added = '$today' AND
                status = 'Deleted'
                AND promo_type = 'Seasonal'";
        $res = mysqli_query($conn, $sql);
      } else if($timespan == "This week") {
        $today = date("Y-m-d");
        $lastWeek = date("Y-m-d", strtotime($today. "- 7 days"));
        $reportText = "Generating reports for Deleted  Seasonal promo  this week (".date("F d, Y", strtotime($lastWeek))." to ".date("F d, Y").")...";
        $sql = "SELECT * FROM promo
                WHERE date_added >= '$lastWeek'
                AND date_added <= '$today'
                AND status = 'Deleted'
                AND promo_type = 'Seasonal'";
        $res = mysqli_query($conn, $sql);
      } else if($timespan == "This month") {
        $monthStart = date("Y-m-01");
        $monthEnd = date("Y-m-t");
        $reportText = "Generating reports for Deleted Seasonal promo  this month of ".date("F")."...";
        $sql = "SELECT * FROM promo
                WHERE date_added >= '$monthStart'
                AND date_added <= '$monthEnd'
                AND status = 'Deleted'
                AND promo_type = 'Seasonal'";
        $res = mysqli_query($conn, $sql);
      } else if($timespan == "This year") {
        $yearStart = date("Y-01-01");
        $yearEnd = date("Y-12-31");
        $reportText = "Generating reports for Deleted Seasonal promo this year (".date("Y").")...";
        $sql = "SELECT * FROM promo
                WHERE date_added >= '$yearStart'
                AND date_added <= '$yearEnd'
                AND status = 'Deleted'
                AND promo_type = 'Seasonal'";
        $res = mysqli_query($conn, $sql);
      } else {
        $reportText = "Generating reports for Deleted  Seasonal promo  since all of time...";
        $sql = "SELECT * FROM promo WHERE   status = 'Deleted'  AND promo_type = 'Seasonal'";
        $res = mysqli_query($conn, $sql);
      }
}

if($_POST["status"] == "Active" || $_POST["status"] == "Expired"){
  $data = array();
  if($res) {
    while($row = mysqli_fetch_assoc($res)) {
      $row["date_added"] = date("M d, Y", strtotime($row["date_added"]));
      $row["promo_starting_date"] = date("M d, Y", strtotime($row["promo_starting_date"]));
      $row["promo_ending_date"] = date("M d, Y", strtotime($row["promo_ending_date"]));
      $row["date_deleted"] = date("M d, Y", strtotime($row["date_deleted"]));
      $data[] = $row;
    }
  }

  $labels = array("Promo ID", "Promo Name", "Promo Type", "Starting Date","Ending Date","Amount");
  $rowLabels = array("promo_id", "promo_name", "promo_type", "promo_starting_date","promo_ending_date","amount");

  $object = (object) [
    'data' => $data,
    'rowLabels' => $rowLabels,
    'labels' => $labels,
    'toDate' => $toDate,
    'fromDate' => $fromDate,
    'reportTitle' => $reportTitle,
    'fileName' => "ReportPromoList_".date("MdY")
  ];

}else if($_POST["status"] == "Deleted"){

  $data = array();
  if($res) {
    while($row = mysqli_fetch_assoc($res)) {
      $row["date_added"] = date("M d, Y", strtotime($row["date_added"]));
      $row["promo_starting_date"] = date("M d, Y", strtotime($row["promo_starting_date"]));
      $row["promo_ending_date"] = date("M d, Y", strtotime($row["promo_ending_date"]));
      $row["date_deleted"] = date("M d, Y", strtotime($row["date_deleted"]));
      $data[] = $row;
    }
  }
  
  $labels = array("Promo ID", "Promo Name", "Promo Type", "Starting Date","Ending Date","Amount","Date Deleted");
  $rowLabels = array("promo_id", "promo_name", "promo_type", "promo_starting_date","promo_ending_date","amount","date_deleted");
  
  $object = (object) [
    'data' => $data,
    'rowLabels' => $rowLabels,
    'labels' => $labels,
    'toDate' => $toDate,
    'fromDate' => $fromDate,
    'reportTitle' => $reportTitle,
    'fileName' => "ReportPromoList_".date("MdY")
  ];

}

$_SESSION["reports"] = $object;
header("Location: ./../print_reports.php");
exit;

?>
