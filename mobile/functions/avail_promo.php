<?php 
require "./connect.php";
session_start();

$promoId = $_REQUEST["id"];
$memberId = $_SESSION["member_id"];
$date = date("Y-m-d");

$sql = "SELECT * FROM memberpromos WHERE promo_id = $promoId AND member_id = $memberId AND status = 'Active'";
$avail = "INSERT INTO memberpromos (promo_id, member_id, date_added)
          VALUES ('$promoId', '$memberId', '$date')";
$promo = "SELECT * FROM promo WHERE promo_id = $promoId";
$res = mysqli_query($con, $sql);
if(mysqli_num_rows($res) > 0) {
  echo 3;
} else {
  $promoRes = mysqli_query($con, $promo);
  $row = mysqli_fetch_assoc($promoRes);

  if($row["promo_type"] == "Seasonal") {
    $start = $row["promo_starting_date"];
    $end = $row["promo_ending_date"];

    if($date < $start) {
      echo 1;
    } else if($date > $end) {
      echo 2;
    } else {
      $sql = "UPDATE memberpromos SET status = 'Removed' WHERE member_id = $memberId AND status = 'Active'";
      if(mysqli_query($con, $sql)) {
        $res = mysqli_query($con, $avail);
        if($res) {
          echo $row["promo_name"];
        }
      } else {
        echo mysqli_error($con);
      }
    }
  } else {
    $sql = "SELECT * FROM memberpromos WHERE member_id = $memberId AND status = 'Pending'";
    $res = mysqli_query($con, $sql);
    if($res) {
      if(mysqli_num_rows($res) > 0) {
        echo 4;
      } else {
        echo 5;
      }
    } else {
      echo mysqli_error($con);
    }
  }
}
?>