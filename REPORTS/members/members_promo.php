<?php 
require "./../connect.php";
session_start();

$promo = $_POST["promo"];

if($promo == "All") {
  $reportTitle = "List of members who availed a promo";
  $sql = "SELECT mp.*, p.promo_name, p.amount, m.first_name, m.last_name FROM memberpromos AS mp
        JOIN promo AS p
        ON mp.promo_id = p.promo_id
        JOIN member AS m
        ON mp.member_id = m.member_id
        WHERE mp.status = 'Active'";
  $res = mysqli_query($conn, $sql);
} else {
  $sql = "SELECT promo_name FROM promo WHERE promo_id = $promo";
  $query = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($query);
  $reportTitle = "List of members who availed ". $row["promo_name"];
  $sql = "SELECT mp.*, p.promo_name, p.amount, m.first_name, m.last_name FROM memberpromos AS mp
        JOIN promo AS p
        ON mp.promo_id = p.promo_id
        JOIN member AS m
        ON mp.member_id = m.member_id
        WHERE mp.status = 'Active'
        AND p.promo_id = $promo";
  $res = mysqli_query($conn, $sql);
}

$data = array();
if($res) {
  while($row = mysqli_fetch_assoc($res)) {
    $row["name"] = $row["first_name"]." ".$row["last_name"];
    $row["date_added"] = date("M d, Y", strtotime($row["date_added"]));
    $data[] = $row;
  }
}
$labels = array("Member ID", "Name", "Promo Name", "Promo Discount", "Date Availed");
$rowLabels = array("member_id", "name", "promo_name", "amount", "date_added");

$object = (object) [
  'data' => $data,
  'rowLabels' => $rowLabels,
  'labels' => $labels,
  'toDate' => $toDate,
  'fromDate' => $fromDate,
  'reportTitle' => $reportTitle,
  'fileName' => "ReportMembersPromoList_".date("MdY")
];

$_SESSION["reports"] = $object;
header("Location: ./../print_reports.php");
exit;
?>
