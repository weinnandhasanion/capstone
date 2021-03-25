<?php 
require "./../../connect.php";
session_start();
date_default_timezone_set('Asia/Manila');
if($_SESSION['admin_id']){
        $session_admin_id = $_SESSION['admin_id'];
    }


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
  'timespan' => $timespan,
  'fileName' => "ReportMembersPromoList_".date("MdY")
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

$description = "Generated a report for members who availed promo";
$identity = "Reports";
$timeNow = date("h:i A");
$user_fname = "members availed promo";

// INSERTING LOGTRAIL INFO  FOR THE LOGTRAIL DOING
$sql22 = "SELECT * FROM logtrail WHERE login_id = '$login_id'";
$query_run22 = mysqli_query($conn, $sql22);
$rows22 = mysqli_fetch_assoc($query_run22);

$login_id_new = $rows22["login_id"];

$sql1 = "INSERT INTO `logtrail_doing` ( `login_id`,`admin_id`, `user_fname`, `description`, `identity`,`time`)
VALUES ( '$login_id_new','$admin_id', '$user_fname', '$description','$identity', '$timeNow')";
mysqli_query($conn, $sql1);
        
?>
