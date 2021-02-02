<?php 
require "./connect.php";
session_start();

$promoId = $_REQUEST["id"];
$memberId = $_SESSION["member_id"];
$date = date("Y-m-d");

$sql = "SELECT * FROM memberpromos WHERE promo_id = $promoId AND member_id = $memberId";
$avail = "INSERT INTO memberpromos (promo_id, member_id, date_added)
          VALUES ('$promoId', '$memberId', '$date')";
$promo = "SELECT promo_starting_date, promo_ending_date FROM promo WHERE promo_id = $promoId";
$res = mysqli_query($con, $sql);
if(mysqli_num_rows($res) > 0) {
  echo "ERROR: You have already availed this promo!";
} else {
  $promoRes = mysqli_query($con, $promo);
  $row = mysqli_fetch_assoc($promoRes);

  $start = $row["promo_starting_date"];
  $end = $row["promo_ending_date"];

  if($date < $start) {
    echo "ERROR: Promo has not yet started!";
  } else if($date > $end) {
    echo "ERROR: Promo has already ended!";
  } else {
    $res = mysqli_query($con, $avail);
    if($res) {
      echo 1;
    }
  }

}
?>