<?php 
require "./../connect.php";
session_start();

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
  'reportTitle' => $reportTitle,
  'fileName' => "ReportExpiredSubscriptionList_".date("MdY")
];

$_SESSION["reports"] = $object;
header("Location: ./../print_reports.php");
exit;
?>
