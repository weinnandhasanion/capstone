<?php 
require "./connect.php";
session_start();

$id = $_SESSION["member_id"];
$data = array();

$sql = "SELECT MP.*, P.promo_name, P.promo_type, P.amount 
        FROM memberpromos AS MP 
        INNER JOIN promo AS P ON MP.promo_id = P.promo_id 
        WHERE MP.member_id = $id AND MP.status = 'Active'"; 
$res = mysqli_query($con, $sql);
if(mysqli_num_rows($res) == 1) {
  $row = mysqli_fetch_assoc($res);

  echo json_encode($row);
} else if(mysqli_num_rows($res) == 2) {
  $sql = "SELECT MP.*, P.promo_name, P.promo_type, P.amount 
        FROM memberpromos AS MP 
        INNER JOIN promo AS P ON MP.promo_id = P.promo_id 
        WHERE MP.member_id = $id AND MP.status = 'Active' AND P.promo_type = 'Seasonal'"; 
  $res = mysqli_query($con, $sql);

  $row = mysqli_fetch_assoc($res);

  echo json_encode($row);
} else {
  echo NULL;
}
?>