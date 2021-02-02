<?php 
require "connect.php";
session_start();

$name = $_POST["promo-name"];
$type = $_POST["promo-type"];
$description = $_POST["promo-description"];
$amount = $_POST["promo-amount"];
$startDate = date("Y-m-d", strtotime($_POST["promo-start-date"]));
$endDate = date("Y-m-d", strtotime($_POST["promo-end-date"]));
$dateAdded = date("Y-m-d");

$sql = "INSERT INTO promo (promo_name, promo_type, promo_description, date_added, promo_starting_date, promo_ending_date, amount)
        VALUES ('$name', '$type', '$description', '$dateAdded', '$startDate', '$endDate', '$amount')";
$res = mysqli_query($conn, $sql);

if($res) {
  echo "<script>
    window.alert('Promo successfully added!');
    window.location.href = './promos.php';
  </script>";
} else {
  echo "<script>
    window.alert('Error: ".mysqli_error($conn)."');
    window.location.href = './promos.php';
  </script>";
}
?>