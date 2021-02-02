<?php 
require "./connect.php";
session_start();

$id = $_REQUEST["id"];
$date = date("Y-m-d");

$sql = "UPDATE promo SET status = 'Deleted', date_deleted = '$date' WHERE promo_id = $id";
$res = mysqli_query($conn, $sql);

if($res) {
  echo "<script>
    alert('Promo successfully deleted.');
    window.location.href = './promos.php';
  </script>";
} else {
  echo "<script>
    alert('Error: ".mysqli_error($conn)."');
    window.location.href = './promos.php';
  </script>";
}
?>