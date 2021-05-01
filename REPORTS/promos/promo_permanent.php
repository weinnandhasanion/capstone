<?php 
require "./../../connect.php";
session_start();
date_default_timezone_set('Asia/Manila');
if($_SESSION['admin_id']){
        $session_admin_id = $_SESSION['admin_id'];
    }


$promo_status = $_POST["status"];
$timespan = $_POST["timespan_promos_permanent"];
if($timespan == "Custom") {
  $fromDate = date("Y-m-d", strtotime($_POST["from_date_promos_permanent"]));
  $toDate = date("Y-m-d", strtotime($_POST["to_date_promos_permanent"]));
} else {
  $fromDate = NULL;
  $toDate = NULL;
}

if($promo_status == "Active"){
  $reportTitle = "List of Active Permanent Promos";
  if($timespan == "Custom") {
    $reportText = "Generating reports for active permanent promo  from ".date("F d, Y", strtotime($fromDate))." to ".date("F d, Y", strtotime($toDate))."...";
    $sql = "SELECT * FROM promo
            WHERE date_added >= '$fromDate' 
            AND date_added <= '$toDate'
            AND status = 'Active'
            AND promo_type = 'Permanent'";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "Today") {
    $reportText = "Generating reports for active permanent promo   today, ".date("F d, Y")."...";
    $today = date("Y-m-d");
    $sql = "SELECT * FROM promo
            WHERE date_added = '$today' AND
            status = 'Active'
            AND promo_type = 'Permanent'";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "This week") {
    $today = date("Y-m-d");
    $lastWeek = date("Y-m-d", strtotime($today. "- 7 days"));
    $reportText = "Generating reports for active  permanent promo  this week (".date("F d, Y", strtotime($lastWeek))." to ".date("F d, Y").")...";
    $sql = "SELECT * FROM promo
            WHERE date_added >= '$lastWeek'
            AND date_added <= '$today'
            AND status = 'Active'
            AND promo_type = 'Permanent'";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "This month") {
    $monthStart = date("Y-m-01");
    $monthEnd = date("Y-m-t");
    $reportText = "Generating reports for active permanent promo  this month of ".date("F")."...";
    $sql = "SELECT * FROM promo
            WHERE date_added >= '$monthStart'
            AND date_added <= '$monthEnd'
            AND status = 'Active'
            AND promo_type = 'Permanent'";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "This year") {
    $yearStart = date("Y-01-01");
    $yearEnd = date("Y-12-31");
    $reportText = "Generating reports for active  permanent promo this year (".date("Y").")...";
    $sql = "SELECT * FROM promo
            WHERE date_added >= '$yearStart'
            AND date_added <= '$yearEnd'
            AND status = 'Active'
            AND promo_type = 'Permanent'";
    $res = mysqli_query($conn, $sql);
  } else {
    $reportText = "Generating reports for active  permanent promo  since all of time...";
    $sql = "SELECT * FROM promo WHERE   status = 'Active' AND promo_type = 'Permanent'";
    $res = mysqli_query($conn, $sql);
  }
}else if($promo_status == "Expired"){
  $reportTitle = "List of Expired Permanent Promos";
    if($timespan == "Custom") {
        $reportText = "Generating reports for Expired permanent promo from ".date("F d, Y", strtotime($fromDate))." to ".date("F d, Y", strtotime($toDate))."...";
        $sql = "SELECT * FROM promo
                WHERE date_added >= '$fromDate' 
                AND date_added <= '$toDate'
                AND status = 'Expired'
                AND promo_type = 'Permanent'";
        $res = mysqli_query($conn, $sql);
      } else if($timespan == "Today") {
        $reportText = "Generating reports for Expired  permanent promo  today, ".date("F d, Y")."...";
        $today = date("Y-m-d");
        $sql = "SELECT * FROM promo
                WHERE date_added = '$today' AND
                status = 'Expired'
                AND promo_type = 'Permanent'";
        $res = mysqli_query($conn, $sql);
      } else if($timespan == "This week") {
        $today = date("Y-m-d");
        $lastWeek = date("Y-m-d", strtotime($today. "- 7 days"));
        $reportText = "Generating reports for Expired  permanent promo  this week (".date("F d, Y", strtotime($lastWeek))." to ".date("F d, Y").")...";
        $sql = "SELECT * FROM promo
                WHERE date_added >= '$lastWeek'
                AND date_added <= '$today'
                AND status = 'Expired'
                AND promo_type = 'Permanent'";
        $res = mysqli_query($conn, $sql);
      } else if($timespan == "This month") {
        $monthStart = date("Y-m-01");
        $monthEnd = date("Y-m-t");
        $reportText = "Generating reports for Expired  permanent promo  this month of ".date("F")."...";
        $sql = "SELECT * FROM promo
                WHERE date_added >= '$monthStart'
                AND date_added <= '$monthEnd'
                AND status = 'Expired'
                AND promo_type = 'Permanent'";
        $res = mysqli_query($conn, $sql);
      } else if($timespan == "This year") {
        $yearStart = date("Y-01-01");
        $yearEnd = date("Y-12-31");
        $reportText = "Generating reports for Expired  permanent promo this year (".date("Y").")...";
        $sql = "SELECT * FROM promo
                WHERE date_added >= '$yearStart'
                AND date_added <= '$yearEnd'
                AND status = 'Expired'
                AND promo_type = 'Permanent'";
        $res = mysqli_query($conn, $sql);
      } else {
        $reportText = "Generating reports for Expired  permanent promo  since all of time...";
        $sql = "SELECT * FROM promo WHERE   status = 'Expired'  AND promo_type = 'Permanent'";
        $res = mysqli_query($conn, $sql);
      }
}else if($promo_status == "Deleted"){
  $reportTitle = "List of Deleted Permanent Promos";
    if($timespan == "Custom") {
        $reportText = "Generating reports for Deleted permanent promo from ".date("F d, Y", strtotime($fromDate))." to ".date("F d, Y", strtotime($toDate))."...";
        $sql = "SELECT * FROM promo
                WHERE date_added >= '$fromDate' 
                AND date_added <= '$toDate'
                AND status = 'Deleted'
                AND promo_type = 'Permanent'";
        $res = mysqli_query($conn, $sql);
      } else if($timespan == "Today") {
        $reportText = "Generating reports for Deleted  permanent promo  today, ".date("F d, Y")."...";
        $today = date("Y-m-d");
        $sql = "SELECT * FROM promo
                WHERE date_added = '$today' AND
                status = 'Deleted'
                AND promo_type = 'Permanent'";
        $res = mysqli_query($conn, $sql);
      } else if($timespan == "This week") {
        $today = date("Y-m-d");
        $lastWeek = date("Y-m-d", strtotime($today. "- 7 days"));
        $reportText = "Generating reports for Deleted  permanent promo  this week (".date("F d, Y", strtotime($lastWeek))." to ".date("F d, Y").")...";
        $sql = "SELECT * FROM promo
                WHERE date_added >= '$lastWeek'
                AND date_added <= '$today'
                AND status = 'Deleted'
                AND promo_type = 'Permanent'";
        $res = mysqli_query($conn, $sql);
      } else if($timespan == "This month") {
        $monthStart = date("Y-m-01");
        $monthEnd = date("Y-m-t");
        $reportText = "Generating reports for Deleted permanent promo  this month of ".date("F")."...";
        $sql = "SELECT * FROM promo
                WHERE date_added >= '$monthStart'
                AND date_added <= '$monthEnd'
                AND status = 'Deleted'
                AND promo_type = 'Permanent'";
        $res = mysqli_query($conn, $sql);
      } else if($timespan == "This year") {
        $yearStart = date("Y-01-01");
        $yearEnd = date("Y-12-31");
        $reportText = "Generating reports for Deleted permanent promo this year (".date("Y").")...";
        $sql = "SELECT * FROM promo
                WHERE date_added >= '$yearStart'
                AND date_added <= '$yearEnd'
                AND status = 'Deleted'
                AND promo_type = 'Permanent'";
        $res = mysqli_query($conn, $sql);
      } else {
        $reportText = "Generating reports for Deleted  permanent promo  since all of time...";
        $sql = "SELECT * FROM promo WHERE   status = 'Deleted'  AND promo_type = 'Permanent'";
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

  $labels = array("Promo ID", "Promo Name", "Promo Type", "Date Added","Amount");
  $rowLabels = array("promo_id", "promo_name", "promo_type", "date_added","amount");

  $object = (object) [
    'data' => $data,
    'rowLabels' => $rowLabels,
    'labels' => $labels,
    'toDate' => $toDate,
    'fromDate' => $fromDate,
    'reportTitle' => $reportTitle,
    'timespan' => $timespan,
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
  
  $labels = array("Promo ID", "Promo Name", "Promo Type", "Date Added","Amount","Date Deleted");
  $rowLabels = array("promo_id", "promo_name", "promo_type", "date_added","amount","date_deleted");
  
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
$sql0 = "SELECT * FROM admin WHERE admin_id = $session_admin_id";
$query_run = mysqli_query($conn, $sql0);
$rows1 = mysqli_fetch_assoc($query_run);

$last_name = $rows1["last_name"];
$admin_id = $rows1["admin_id"];

$description = "Generated a report for list of permanent promos";
$identity = "Reports";
$timeNow = date("h:i A");
$user_fname = "permanent promos";

// INSERTING LOGTRAIL INFO  FOR THE LOGTRAIL DOING
$sql22 = "SELECT * FROM logtrail WHERE login_id = '$login_id'";
$query_run22 = mysqli_query($conn, $sql22);
$rows22 = mysqli_fetch_assoc($query_run22);

$login_id_new = $rows22["login_id"];

$sql1 = "INSERT INTO `logtrail_doing` ( `login_id`,`admin_id`, `user_fname`, `description`, `identity`,`time`)
VALUES ( '$login_id_new','$admin_id', '$user_fname', '$description','$identity', '$timeNow')";
mysqli_query($conn, $sql1);
        
?>

