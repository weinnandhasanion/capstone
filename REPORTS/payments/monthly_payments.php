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

$today = date("Y-m-d");
$lastWeek = date("Y-m-d", strtotime($today. "- 7 days"));
$monthStart = date("Y-m-01");
$monthEnd = date("Y-m-t");
$yearStart = date("Y-01-01");
$yearEnd = date("Y-12-31");

if($timespan == "Custom") {
  $sql = "SELECT * FROM paymentlog
          WHERE date_payment BETWEEN '$fromDate' AND '$toDate'
          AND payment_description = 'Monthly Subscription'
          ORDER BY payment_id DESC";
  $res = mysqli_query($conn, $sql);
} else if($timespan == "Today") {
  $sql = "SELECT * FROM paymentlog
          WHERE date_payment = '$today'
          AND payment_description = 'Monthly Subscription'
          ORDER BY payment_id DESC";
  $res = mysqli_query($conn, $sql);
} else if($timespan == "This week") {
  $sql = "SELECT * FROM paymentlog
          WHERE date_payment BETWEEN '$lastWeek' AND NOW()
          AND payment_description = 'Monthly Subscription'
          ORDER BY payment_id DESC";
  $res = mysqli_query($conn, $sql);
} else if($timespan == "This month") {
  $sql = "SELECT * FROM paymentlog
          WHERE date_payment BETWEEN '$monthStart' AND NOW()
          AND payment_description = 'Monthly Subscription'
          ORDER BY payment_id DESC";
  $res = mysqli_query($conn, $sql);
} else if($timespan == "This year") {
  $sql = "SELECT * FROM paymentlog
          WHERE date_payment BETWEEN '$yearStart' AND NOW()
          AND payment_description = 'Monthly Subscription'
          ORDER BY payment_id DESC";
  $res = mysqli_query($conn, $sql);
} else if($timespan == "All-time") {
  $sql = "SELECT * FROM paymentlog
          WHERE payment_description = 'Monthly Subscription'
          ORDER BY payment_id DESC";
  $res = mysqli_query($conn, $sql);
}

$data = array();
if($res) {
  while($row = mysqli_fetch_assoc($res)) {
    $row["name"] = $row["first_name"]." ".$row["last_name"];
    $row["amount"] = "P".$row["payment_amount"].".00";
    $row["datetime"] = date("M d, Y", strtotime($row["date_payment"]))." ".$row["time_payment"];
    $data[] = $row;
  }
}
$labels = array("Payment ID", "Payer Name", "Promo Availed", "Payment Amount", "Date and Time of Payment");
$rowLabels = array("payment_id", "name", "promo_availed", "amount", "datetime");

$object = (object) [
  'data' => $data,
  'rowLabels' => $rowLabels,
  'labels' => $labels,
  'toDate' => $toDate,
  'fromDate' => $fromDate,
  'reportTitle' => "List of monthly subscription payments",
  'fileName' => "ReportMonthlyPayments_".date("MdY"),
  'displayTotalSales' => true
];

$_SESSION["reports"] = $object;
header("Location: ./../print_reports.php");
exit;
?>