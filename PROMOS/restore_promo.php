<?php 
require "./connect.php";
session_start();

$id = $_REQUEST["id"];

$sql = "UPDATE promo SET status = 'Active' WHERE promo_id = $id";
$res = mysqli_query($conn, $sql);

if($res) {
  echo "<script>
    alert('Promo successfully restored!');
    window.location.href = './promos.php';
  </script>";
} else {
  echo "<script>
    alert('Error: ".mysqli_error($conn)."');
    window.location.href = './promos.php';
  </script>";
}
?>