<?php 
require "./connect.php";
session_start();

$promoId = $_REQUEST["promo_id"];
$memberId = $_REQUEST["member_id"];

$sql = "UPDATE memberpromos 
        SET status = 'Expired', date_expired = '".date("Y-m-d")."'
        WHERE member_id = $memberId AND promo_id = $promoId";
$res = mysqli_query($conn, $sql);

if($res) {
  echo "<script>
    alert('Member successfully removed from promo.');
    window.location.href = './promos.php';
  </script>";
} else {
  echo "<script>
    alert('Error: ".mysqli_error($conn)."');
    window.location.href = './promos.php';
  </script>";
}
?>