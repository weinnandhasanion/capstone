<?php 
require "./connect.php";
session_start();

$promoId = $_REQUEST["promoId"];
$memberId = $_REQUEST["memberId"];
$status = intval($_REQUEST["status"]);
$date = date("Y-m-d");

if($status == 2) {
  $sql = "SELECT mp.id FROM memberpromos AS mp
          INNER JOIN promo AS p
          ON mp.promo_id = p.promo_id
          WHERE mp.member_id = $memberId
          AND mp.status = 'Active'
          AND p.promo_type = 'Permanent'";
  $res = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($res);

  $sql = "UPDATE memberpromos SET status = 'Expired'
          WHERE id = ".$row["id"];
  $query = mysqli_query($conn, $sql);
}

$sql = "INSERT INTO memberpromos (promo_id, member_id, date_added)
        VALUES ($promoId, $memberId, '$date')";
$res = mysqli_query($conn, $sql);

if($res) {
  echo "<script>
  alert('Member successfully availed promo!');
  window.location.href = './promos.php';
  </script>";
}
?>