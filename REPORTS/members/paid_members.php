<?php 
require "./../connect.php";
session_start();

$sql = "SELECT * FROM member WHERE member_status = 'Paid' AND member_type = 'Regular'";
$res = mysqli_query($conn, $sql);

$reportTitle = "List of members with ongoing subscription";

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
$labels = array("Member ID", "Name", "Monthly Subscription Expiry", 'Membership Expiry');
$rowLabels = array("member_id", "name", "monthly_end", "annual_end");

$object = (object) [
  'data' => $data,
  'rowLabels' => $rowLabels,
  'labels' => $labels,
  'toDate' => $toDate,
  'fromDate' => $fromDate,
  'reportTitle' => $reportTitle,
  'fileName' => "ReportOngoingSubscriptionList_".date("MdY")
];

$_SESSION["reports"] = $object;
header("Location: ./../print_reports.php");
exit;
?>
