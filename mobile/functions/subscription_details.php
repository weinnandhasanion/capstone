<?php 
require "./connect.php";
session_start();

$monthlyHasValue = false;
$annualHasValue = false;
$subscribed = false;
$paidMonthly = false;
$paidAnnual = false;
$data = new \stdClass();

$sql = "SELECT * FROM paymentlog WHERE member_id = '".$_SESSION["member_id"]."' 
        AND payment_description = 'Monthly Subscription' 
        ORDER BY date_payment DESC";
$res = mysqli_query($con, $sql);
if($res) {
  if(mysqli_num_rows($res) > 0) {
    $monthlyHasValue = true;
    $monthlyData = array();
    while($row = mysqli_fetch_array($res)) {
      $monthlyData[] = $row;
    }
  
    $monthly = $monthlyData[0];
    $x = new DateTime($monthly["date_payment"]);
    
    $monthlyStart = $x->format('Y-m-d');
    $monthlyEnd = date("Y-m-d", strtotime($monthlyStart. " + 30 days"));
  } else {
    $monthlyHasValue = false;
  }
}

$sql2 = "SELECT * FROM paymentlog WHERE member_id = '".$_SESSION["member_id"]."' 
        AND payment_description = 'Annual Membership' 
        ORDER BY date_payment DESC";
$res2 = mysqli_query($con, $sql2);
if($res) {
  if(mysqli_num_rows($res2) > 0) {
    $annualHasValue = true;
    $annualData = array();
    while($row = mysqli_fetch_array($res2)) {
      $annualData[] = $row;
    }
  
    $annual = $annualData[0];
    $y = new DateTime($annual["date_payment"]);
  
    $annualStart = $y->format('Y-m-d');
    $annualEnd = date("Y-m-d", strtotime($annualStart. " + 365 days"));
  } else {
    $annualHasValue = false;
  }
}

if($monthlyHasValue) {
  $now = date("Y-m-d");
  ($now > $monthlyEnd) ? $paidMonthly = false : $paidMonthly = true;
}

if($annualHasValue) {
  $now = date("Y-m-d");
  ($now > $annualEnd) ? $paidAnnual = false : $paidAnnual = true;
}

($paidMonthly && $paidAnnual) ? $subscribed = true : $subscribed = false;

function formatDate(string $date) {
  $newDate = new DateTime($date);
  $date = $newDate->format("M d, Y");

  return $date;
}

if($monthlyHasValue && $annualHasValue) {
  if($paidMonthly && $paidAnnual) {
    $data->mpaid = true;
    $data->apaid = true;
    $data->mstart = formatDate($monthlyStart);
    $data->mend = formatDate($monthlyEnd);
    $data->astart = formatDate($annualStart);
    $data->aend = formatDate($annualEnd);
  } else if($paidMonthly && !$paidAnnual) {
    $data->mpaid = true;
    $data->apaid = false;
    $data->mstart = formatDate($monthlyStart);
    $data->mend = formatDate($monthlylEnd);
    $data->astart = formatDate($annualStart);
    $data->aend = formatDate($annualEnd);
  } else if(!$paidMonthly && $paidAnnual) {
    $data->mpaid = false;
    $data->apaid = true;
    $data->mstart = formatDate($monthlyStart);
    $data->mend = formatDate($monthlyEnd);
    $data->astart = formatDate($annualStart);
    $data->aend = formatDate($annualEnd);
  } else {
    $data->mpaid = false;
    $data->apaid = false;
    $data->mstart = formatDate($monthlyStart);
    $data->mend = formatDate($monthlyEnd);
    $data->astart = formatDate($annualStart);
    $data->aend = formatDate($annualEnd);
  }
} else if($monthlyHasValue && !$annualHasValue) {
  if($paidMonthly) {
    $data->mpaid = true;
    $data->apaid = false;
    $data->mstart = formatDate($monthlyStart);
    $data->mend = formatDate($monthlylEnd);
    $data->astart = "No payment";
    $data->aend = "No payment";
  } else {
    $data->mpaid = false;
    $data->apaid = false;
    $data->mstart = formatDate($monthlyStart);
    $data->mend = formatDate($monthlylEnd);
    $data->astart = "No payment";
    $data->aend = "No payment";
  }
} else if(!$monthlyHasValue && $annualHasValue) {
  if($paidAnnual) {
    $data->mpaid = false;
    $data->apaid = true;
    $data->mstart = "No payment";
    $data->mend = "No payment";
    $data->astart = formatDate($annualStart);
    $data->aend = formatDate($annualEnd);
  } else {
    $data->mpaid = false;
    $data->apaid = false;
    $data->mstart = "No payment";
    $data->mend = "No payment";
    $data->astart = formatDate($annualStart);
    $data->aend = formatDate($annualEnd);
  }
} else {
  $data->mpaid = false;
  $data->apaid = false;
  $data->mstart = "No payment";
  $data->mend = "No payment";
  $data->astart = "No payment";
  $data->aend = "No payment";
}

if(isset($_GET)) {
  $data->isSubscribed = $subscribed;
  echo json_encode($data);
}
?>