<?php 
session_start();
require('./../connect.php');

$id = $_REQUEST['id'];

$promoCheck = "SELECT promo.promo_name FROM promo
              INNER JOIN memberpromos ON promo.promo_id = memberpromos.promo_id
              WHERE memberpromos.member_id = $id AND memberpromos.status = 'Active'";
$promoQuery = mysqli_query($conn, $promoCheck);


$sql = "SELECT *
        FROM member 
        WHERE member_id = " . intval($id) . "";
$res = mysqli_query($conn, $sql);

if($row = mysqli_fetch_assoc($res)) {
  if($promoQuery) {
    if(mysqli_num_rows($promoQuery) == 1) {
      $promoResult = mysqli_fetch_assoc($promoQuery);
      $row["promo_name"] = $promoResult["promo_name"];
    } else if(mysqli_num_rows($promoQuery) > 1){
      $promoCheck = "SELECT promo.promo_name FROM promo
              INNER JOIN memberpromos ON promo.promo_id = memberpromos.promo_id
              WHERE memberpromos.member_id = $id AND memberpromos.status = 'Active' AND promo.promo_type = 'Seasonal'";
      $promoQuery = mysqli_query($conn, $promoCheck);
      $promoRes = mysqli_fetch_assoc($promoQuery);
      $row["promo_name"] = $promoRes["promo_name"];
    } else {
      $row["promo_name"] = "N/A";
    } 
  } else {
    $row["promo_name"] = "N/A";
  }

  $row["program_name"] = (empty($row["program_id"])) ? "N/A" : getProgramName($row["program_id"]);
  $row["date_registered"] != null ? $row["date_registered"] = date("M d, Y", strtotime($row["date_registered"])) : $row["date_registered"];
  $row["birthdate"] != null ? $row["birthdate"] = date("M d, Y", strtotime($row["birthdate"])) : $row["birthdate"];
  $row["annual_start"] != null ? $row["annual_start"] = date("M d, Y", strtotime($row["annual_start"])) : $row["annual_start"];
  $row["annual_end"] != null ? $row["annual_end"] = date("M d, Y", strtotime($row["annual_end"])) : $row["annual_end"];
  $row["monthly_start"] != null ? $row["monthly_start"] = date("M d, Y", strtotime($row["monthly_start"])) : $row["monthly_start"];
  $row["monthly_end"] != null ? $row["monthly_end"] = date("M d, Y", strtotime($row["monthly_end"])) : $row["monthly_end"];

  echo json_encode($row);
}

function getProgramName($id) {
  global $conn;

  $sql = "SELECT program_name FROM program WHERE program_id = $id";
  $res = mysqli_query($conn, $sql);

  $row = mysqli_fetch_assoc($res);
  return $row["program_name"];
}
?>