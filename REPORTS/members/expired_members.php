<?php 
require "./../connect.php";
session_start();
date_default_timezone_set('Asia/Manila');
if($_SESSION['admin_id']){
        $session_admin_id = $_SESSION['admin_id'];
    }

$timespan = $_POST["timespan"];
if($timespan == "Custom") {
  $fromDate = date("Y-m-d", strtotime($_POST["from_date"]));
  $toDate = date("Y-m-d", strtotime($_POST["to_date"]));
} else {
  $fromDate = NULL;
  $toDate = NULL;
}

if($timespan == "Custom") {
  if($toDate > date("Y-m-d")) {
    $sql = "SELECT * FROM member WHERE member_status = 'Expired' AND member_type = 'Regular'
        AND (monthly_end BETWEEN '$fromDate' AND NOW())
        AND annual_end > NOW()";
    $res = mysqli_query($conn, $sql);
  } else {
    $sql = "SELECT * FROM member WHERE member_status = 'Expired' AND member_type = 'Regular'
        AND (monthly_end BETWEEN '$fromDate' AND '$toDate')
        AND annual_end > NOW()";
    $res = mysqli_query($conn, $sql);
  }
} else if($timespan == "Today") {
  $today = date("Y-m-d");
  $sql = "SELECT * FROM member WHERE member_status = 'Expired' AND member_type = 'Regular'
        AND monthly_end <= NOW()
        AND annual_end > NOW()";
  $res = mysqli_query($conn, $sql);
} else if($timespan == "This week") {
  $lastWeek = date("Y-m-d", strtotime($today. "- 7 days"));
  $sql = "SELECT * FROM member WHERE member_status = 'Expired' AND member_type = 'Regular'
        AND (monthly_end BETWEEN '$lastWeek' AND NOW())
        AND annual_end > NOW()";
  $res = mysqli_query($conn, $sql);
} else if($timespan == "This month") {
  $monthStart = date("Y-m-01");
  $sql = "SELECT * FROM member WHERE member_status = 'Expired' AND member_type = 'Regular'
        AND (monthly_end BETWEEN '$monthStart' AND NOW())
        AND annual_end > NOW()";
  $res = mysqli_query($conn, $sql);
} else if($timespane == "This year") {
  $yearStart = date("Y-01-01");
  $sql = "SELECT * FROM member WHERE member_status = 'Expired' AND member_type = 'Regular'
        AND (monthly_end BETWEEN '$yearStart' AND NOW())
        AND annual_end > NOW()";
  $res = mysqli_query($conn, $sql);
} else if($timespan == "All-time") {
  $sql = "SELECT * FROM member WHERE member_status = 'Expired' AND member_type = 'Regular'
        AND monthly_end < NOW()
        AND annual_end > NOW()";
  $res = mysqli_query($conn, $sql);
}

$reportTitle = "List of members with expired monthly subscription";

$data = array();
if($res) {
  while($row = mysqli_fetch_assoc($res)) {
    $sql = "SELECT * FROM paymentlog WHERE member_id = '".$row["member_id"]."'
            AND payment_description = 'Monthly Subscription'";
    $row["name"] = $row["first_name"]." ".$row["last_name"];
    $row["monthly_end"] = date("M d, Y", strtotime($row["monthly_end"]));
    $row["annual_end"] = date("M d, Y", strtotime($row["annual_end"]));
    $data[] = $row;
  }
}
$labels = array("Member ID", "Name", "Date Expired", 'Membership Expiry');
$rowLabels = array("member_id", "name", "monthly_end", "annual_end");

$object = (object) [
  'data' => $data,
  'rowLabels' => $rowLabels,
  'labels' => $labels,
  'toDate' => $toDate,
  'fromDate' => $fromDate,
  'timespan' => $timespan,
  'reportTitle' => $reportTitle,
  'fileName' => "ReportExpiredSubscriptionList_".date("MdY")
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

$description = "Generated a report for members with expired subscription";
$identity = "Reports";
$timeNow = date("h:i A");
$user_fname = "members expired subscription";

// INSERTING LOGTRAIL INFO  FOR THE LOGTRAIL DOING
$sql22 = "SELECT * FROM logtrail WHERE login_id = '$login_id'";
$query_run22 = mysqli_query($conn, $sql22);
$rows22 = mysqli_fetch_assoc($query_run22);

$login_id_new = $rows22["login_id"];

$sql1 = "INSERT INTO `logtrail_doing` ( `login_id`,`admin_id`, `user_fname`, `description`, `identity`,`time`)
VALUES ( '$login_id_new','$admin_id', '$user_fname', '$description','$identity', '$timeNow')";
mysqli_query($conn, $sql1);
        
?>