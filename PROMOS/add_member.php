<?php 
require "./connect.php";
session_start();

$promoId = $_REQUEST["promo_id"];
$memberId = $_REQUEST["member_id"];
$date = date("Y-m-d");

$sql = "SELECT * FROM memberpromos WHERE promo_id = $promoId AND member_id = $memberId AND status = 'Active'";
$res = mysqli_query($conn, $sql);

if(mysqli_num_rows($res) > 0) {
  echo "<script>
    alert('Error: Member already availed promo!');
    window.location.href = './promos.php';
  </script>";
} else {
  $sql2 = "SELECT promo_starting_date, promo_ending_date, promo_type FROM promo WHERE promo_id = $promoId";
  $res2 = mysqli_query($conn, $sql2);
  $rows = mysqli_fetch_assoc($res2);

  if($rows["promo_type"] == "Seasonal") {
    if($rows["promo_starting_date"] > $date) {
      echo "<script>
        alert('Error: Seasonal promo has not started yet!');
        window.location.href = './promos.php';
      </script>";
    } else if($rows["promo_ending_date"] < $date) {
      echo "<script>
        alert('Error: Seasonal promo has already ended!');
        window.location.href = './promos.php';
      </script>";
    } else {
      $sql = "INSERT INTO memberpromos (promo_id, member_id, date_added)
      VALUES ('$promoId', '$memberId', '$date')";
      $res = mysqli_query($conn, $sql);
      if($res) {
        echo "<script>
        alert('Member successfully added to promo!');
        window.location.href = './promos.php';
        </script>";
      } else {
        echo "<script>
        alert('Error: ".mysqli_error($conn)."');
        window.location.href = './promos.php';
        </script>";
      }
    }
  } else {
    $sql = "INSERT INTO memberpromos (promo_id, member_id, date_added)
    VALUES ('$promoId', '$memberId', '$date')";
    $res = mysqli_query($conn, $sql);
    if($res) {
      echo "<script>
      alert('Member successfully added to promo!');
      window.location.href = './promos.php';
      </script>";
    } else {
      echo "<script>
      alert('Error: ".mysqli_error($conn)."');
      window.location.href = './promos.php';
      </script>";
    }
  }
}
?>