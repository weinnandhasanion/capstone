<?php
require "./../connect.php";
session_start();
date_default_timezone_set('Asia/Manila');
if ($_SESSION['admin_id']) {
  $session_admin_id = $_SESSION['admin_id'];
}

$id = $_REQUEST["id"];
$date = date("Y-m-d");

$sql = "UPDATE promo SET status = 'Deleted', date_deleted = '$date' WHERE promo_id = $id";
$res = mysqli_query($conn, $sql);

if ($res) {
  $data = array();
  $promo_id;
  $sql3 = "SELECT * FROM promo ORDER BY promo_id DESC";
  $res3 = mysqli_query($conn, $sql3);
  if ($res3) {
    while ($row = mysqli_fetch_assoc($res3)) {
      $data[] = $row["promo_id"];
    }

    $promo_id = $data[0];
  }

  $data_logtrail = array();
  $login_id;
  $log = "SELECT * FROM logtrail ORDER BY login_id DESC";
  $logtrail = mysqli_query($conn, $log);
  if ($logtrail) {
    while ($rowrow = mysqli_fetch_assoc($logtrail)) {
      $data_logtrail[] = $rowrow["login_id"];
    }

    $login_id = $data_logtrail[0];
  }

  $ad = "SELECT * FROM admin WHERE admin_id = $session_admin_id";
  $query_runad = mysqli_query($conn, $ad);
  $rowed = mysqli_fetch_assoc($query_runad);

  $admin_id = $rowed["admin_id"];

  $ew = "SELECT * FROM promo WHERE promo_id = '$id'";
  $query_runew = mysqli_query($conn, $ew);
  $rowew = mysqli_fetch_assoc($query_runew);

  $promo_id_new = $rowew["promo_id"];
  $user_fname = $rowew["promo_name"];
  $description = "Deleted a promo";
  $identity = "Promos";
  $timeNow = date("h:i A");

  $sql22 = "SELECT * FROM logtrail WHERE login_id = '$login_id'";
  $query_run22 = mysqli_query($conn, $sql22);
  $rows22 = mysqli_fetch_assoc($query_run22);
  $login_id_new = $rows22["login_id"];

  $sql1 = "INSERT INTO `logtrail_doing` 
	 ( `login_id`,`admin_id`,`promo_id`,`user_fname`,`description`, `identity`,`time`)
     VALUES 
	 ( '$login_id_new','$admin_id', '$promo_id_new', '$user_fname','$description','$identity', '$timeNow')";
  mysqli_query($conn, $sql1);

  echo "<script>
    alert('Promo successfully deleted.');
    window.location.href = './promos.php';
  </script>";
} else {
  echo "<script>
    alert('Error: " . mysqli_error($conn) . "');
    window.location.href = './promos.php';
  </script>";
}
?>