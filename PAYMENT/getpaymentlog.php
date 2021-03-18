<?php 
require "./connect.php";

if(isset($_GET["sort"])) {
  $sort = $_GET["sort"];

  $today = date("Y-m-d");
  $yesterday = date("Y-m-d", strtotime($today." - 1 day"));
  $lastweek = date("Y-m-d", strtotime($today." - 7 days"));
  $lastmonth = date("Y-m-d", strtotime($today." - 30 days"));

  if($sort == "today") {
    $sql = "SELECT * FROM paymentlog WHERE date_payment = '$today' ORDER BY payment_id DESC";
    $res = mysqli_query($conn, $sql);

    if($res) {
      $data = array();
      while($row = mysqli_fetch_assoc($res)) {
        $row["fullname"] = $row["first_name"]." ".$row["last_name"];
        $row["date_payment"] = date("M d, Y", strtotime($row["date_payment"]));
        $data[] = $row;
      }

      echo json_encode($data);
    }
  } else if($sort == "yesterday") {
    $sql = "SELECT * FROM paymentlog WHERE date_payment = '$yesterday' ORDER BY payment_id DESC";
    $res = mysqli_query($conn, $sql);

    if($res) {
      $data = array();
      while($row = mysqli_fetch_assoc($res)) {
        $row["fullname"] = $row["first_name"]." ".$row["last_name"];
        $row["date_payment"] = date("M d, Y", strtotime($row["date_payment"]));
        $data[] = $row;
      }

      echo json_encode($data);
    }
  } else if($sort == "lastweek") {
    $sql = "SELECT * FROM paymentlog WHERE date_payment BETWEEN '$lastweek' AND '$today' ORDER BY payment_id DESC";
    $res = mysqli_query($conn, $sql);

    if($res) {
      $data = array();
      while($row = mysqli_fetch_assoc($res)) {
        $row["fullname"] = $row["first_name"]." ".$row["last_name"];
        $row["date_payment"] = date("M d, Y", strtotime($row["date_payment"]));
        $data[] = $row;
      }

      echo json_encode($data);
    }
  } else if($sort == "lastmonth") {
    $sql = "SELECT * FROM paymentlog WHERE date_payment BETWEEN '$lastmonth' AND '$today' ORDER BY payment_id DESC";
    $res = mysqli_query($conn, $sql);

    if($res) {
      $data = array();
      while($row = mysqli_fetch_assoc($res)) {
        $row["fullname"] = $row["first_name"]." ".$row["last_name"];
        $row["date_payment"] = date("M d, Y", strtotime($row["date_payment"]));
        $data[] = $row;
      }

      echo json_encode($data);
    }
  } else if($sort == "alltime"){
    $sql = "SELECT * FROM paymentlog WHERE date_payment ORDER BY payment_id DESC";
    $res = mysqli_query($conn, $sql);

    if($res) {
      $data = array();
      while($row = mysqli_fetch_assoc($res)) {
        $row["fullname"] = $row["first_name"]." ".$row["last_name"];
        $row["date_payment"] = date("M d, Y", strtotime($row["date_payment"]));
        $data[] = $row;
      }

      echo json_encode($data);
    }
  }
}
?>