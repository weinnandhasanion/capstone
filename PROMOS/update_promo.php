<?php 
require "./connect.php";
session_start();

$id = $_POST["promo-id-update"];
$name = $_POST["promo-name-update"];
$amount = $_POST["promo-amount-update"];
$desc = $_POST["promo-description-update"];
$type = $_POST["promo-type-update"];
$startDate = date("Y-m-d", strtotime($_POST["promo-start-date-update"]));
$endDate = date("Y-m-d", strtotime($_POST["promo-end-date-update"]));

$sql = "UPDATE promo
        SET promo_name = '$name', amount = '$amount', promo_description = '$desc', promo_type = '$type', 
            promo_starting_date = '$startDate', promo_ending_date = '$endDate'
        WHERE promo_id = $id";
$res = mysqli_query($conn, $sql);
if($res) {
  echo "<script>
    alert('Promo updated successfully!');
    window.location.href = './promos.php';
  </script>";
} else {
  echo "<script>
    alert('Error: ".mysqli_error($conn)."');
    window.location.href = './promos.php';
  </script>";
}
?>