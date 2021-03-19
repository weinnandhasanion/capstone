<?php 
require "./connect.php";
session_start();
date_default_timezone_set('Asia/Manila');

$sql = "SELECT * FROM member
        WHERE member_id = '".$_SESSION["member_id"]."'";
$res = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($res);
$today = date("Y-m-d");
$monthlyStart;
$monthlyEnd;
$annualStart; 
$annualEnd;

if($row["monthly_start"] == null || $row["monthly_end"] == null) {
  $monthlyStart = $today;
  $monthlyEnd = date("Y-m-d", strtotime($today."+ 30 days"));
} else if($today >= $row["monthly_start"] && $today <= $row["monthly_end"]) {
  $monthlyStart = $row["monthly_start"];
  $monthlyEnd = date("Y-m-d", strtotime($row["monthly_end"]."+ 30 days"));
} else {
  $monthlyStart = $today;
  $monthlyEnd = date("Y-m-d", strtotime($today."+ 30 days"));
}

if($row["annual_start"] == null || $row["annual_end"] == null) {
  $annualStart = $today;
  $annualEnd = date("Y-m-d", strtotime($today."+ 365 days"));
} else if($today >= $row["annual_start"] && $today <= $row["annual_end"]) {
  $annualStart = $row["annual_start"];
  $annualEnd = date("Y-m-d", strtotime($row["annual_end"]."+ 365 days"));
} else {
  $annualStart = $today;
  $annualEnd = date("Y-m-d", strtotime($today."+ 365 days"));
}
 
$data = json_decode($_POST["data"]);
$memberId = $_SESSION["member_id"];
$fname = $row["first_name"];
$lname = $row["last_name"];
$paymentDate = date("Y-m-d", strtotime($data->paymentDate));
$paymentTime = date("h:i A", strtotime($data->paymentDate));
$onlinePaymentId = $data->paymentId;
$promoAvailed = $data->promo ? $data->promo : null;
$ok = 0;
if(count($data->items) > 0) {
  foreach($data->items as $item) {
    $am = $item->unit_amount;
    $sql = "INSERT INTO paymentlog (member_id, first_name, last_name, payment_amount, member_type, payment_description, payment_type, date_payment, time_payment, online_payment_id, promo_availed)
            VALUES ($memberId, '$fname', '$lname', '".substr($am->value, 0, -3)."', 'Regular', '$item->name', 'Online', '$paymentDate', '$paymentTime', '$onlinePaymentId', '$promoAvailed')";
    $res = $con->query($sql);
    if($res) {
      if($item->name == "Monthly Subscription") {
        $sql = "UPDATE member SET monthly_start = '$monthlyStart', monthly_end = '$monthlyEnd' WHERE member_id = $memberId";
        mysqli_query($con, $sql);
      } else if($item->name == "Annual Subscription") {
        $sql = "UPDATE member SET annual_start = '$annualStart', annual_end = '$annualEnd' WHERE member_id = $memberId";
        mysqli_query($con, $sql);
      }

      $ok++;
    } else {
      echo "error: ". mysqli_error($con);
    }
  }
}

$lastMonthly;
$lastAnnual;

$sqlMonthly = "SELECT * FROM paymentlog WHERE member_id = '$memberId'
        AND payment_description = 'Monthly Subscription'
        ORDER BY payment_id DESC";
$resMonthly = mysqli_query($con, $sqlMonthly);
if($resMonthly) {
    $results = array();
    while($row = mysqli_fetch_assoc($resMonthly)) {
        $results[] = $row;
    }

    $lastMonthly = strtotime($results[0]["date_payment"]);
} else {
    echo mysqli_error($con);
}

$sqlAnnual = "SELECT * FROM paymentlog WHERE member_id = '$memberId'
              AND payment_description = 'Annual Membership'
              ORDER BY payment_id DESC";
$resAnnual = mysqli_query($con, $sqlAnnual);
if($resAnnual) {
  $results = array();
  while($row = mysqli_fetch_assoc($resAnnual)) {
      $results[] = $row;
  }

  $lastAnnual = strtotime($results[0]["date_payment"]);
}

if($resAnnual && $resMonthly) {
  $today = date("Y-m-d");
  $now = strtotime($today);
  $lastMonth = strtotime(date("Y-m-d", strtotime($today." - 30 days")));
  $lastYear = strtotime(date("Y-m-d", strtotime($today." - 365 days")));

  if($lastMonthly >= $lastMonth && $lastMonthly <= $now && $lastAnnual >= $lastYear && $lastAnnual <= $now) {
    $sql = "UPDATE member SET member_status = 'Paid'
            WHERE member_id = $memberId";
    mysqli_query($con, $sql);
  }
}

echo $ok;
?>