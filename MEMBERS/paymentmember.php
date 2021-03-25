<?php 
session_start();
require('./../connect.php');

$id = $_REQUEST['id'];

$promoCheck = "SELECT promo.promo_name, promo.amount FROM promo
              INNER JOIN memberpromos ON promo.promo_id = memberpromos.promo_id
              WHERE memberpromos.member_id = $id AND memberpromos.status = 'Active'";
$promoQuery = mysqli_query($conn, $promoCheck);

$sql1 = "SELECT * FROM `member` WHERE `member_id` = " . intval($id) . "";
$res1 = mysqli_query($conn, $sql1);


if($row = mysqli_fetch_assoc($res1)) {
  if($promoQuery) {
    if(mysqli_num_rows($promoQuery) == 1) {
      $promoResult = mysqli_fetch_assoc($promoQuery);
      $row["promo_name"] = $promoResult["promo_name"];
      $row["amount"] = $promoResult["amount"];
    } else if(mysqli_num_rows($promoQuery) > 1){
      $promoCheck = "SELECT promo.promo_name, promo.amount FROM promo
              INNER JOIN memberpromos ON promo.promo_id = memberpromos.promo_id
              WHERE memberpromos.member_id = $id AND memberpromos.status = 'Active' AND promo.promo_type = 'Seasonal'";
      $promoQuery = mysqli_query($conn, $promoCheck);
      $promoRes = mysqli_fetch_assoc($promoQuery);
      $row["promo_name"] = $promoRes["promo_name"];
      $row["amount"] = $promoRes["amount"];
    } else {
      $row["promo_name"] = "N/A";
      $row["amount"] = 0;
    } 
  } else {
    $row["promo_name"] = "N/A";
    $row["amount"] = 0;
  }

  echo json_encode($row);
}
?>