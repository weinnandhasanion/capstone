<?php 
require "./../connect.php";
session_start();

$memberId = $_GET["member_id"];
$promoId = $_GET["promo_id"];
$date = date("Y-m-d");

$resultObj = new \stdClass;

$messages = array(
  "Member has already availed promo!",
  "Seasonal promo has not started yet!",
  "Seasonal promo has already ended!",
  null
);

$promo = null;
$msgIndex = 3;

$sql = "SELECT * FROM memberpromos WHERE promo_id = $promoId AND member_id = $memberId AND status = 'Active'";
$res = mysqli_query($conn, $sql);


if(mysqli_num_rows($res) > 0) {
  $msgIndex = 0;
  $status = 0;
} else {
  $sql = "SELECT mp.*, p.promo_name, p.promo_type FROM memberpromos AS mp
    INNER JOIN promo AS p
    ON mp.promo_id = p.promo_id
    WHERE mp.member_id = $memberId
    AND mp.status = 'Active'";
  $res = mysqli_query($conn, $sql);

  if(mysqli_num_rows($res) > 0) {
    $row = mysqli_fetch_assoc($res);
    $promo = $row["promo_name"];
    $status = 2;
  } else {
    $sql2 = "SELECT promo_starting_date, promo_ending_date, promo_type FROM promo WHERE promo_id = $promoId";
    $res2 = mysqli_query($conn, $sql2);
    $rows = mysqli_fetch_assoc($res2);

    if($rows["promo_type"] == "Seasonal") {
      if($rows["promo_starting_date"] > $date) {
        $msgIndex = 1;
        $status = 0;
      } else if($rows["promo_ending_date"] < $date) {
        $msgIndex = 2;
        $status = 0;
      } else {
        $status = 1;
      }
    } else {
      $status = 1;
    }
  }
}

$resultObj->msg = $messages[$msgIndex];
$resultObj->status = $status;
$resultObj->promo = $promo;

echo json_encode($resultObj);
?>