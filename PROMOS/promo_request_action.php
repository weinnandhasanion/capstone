<?php 
require "./../connect.php";

$action = $_GET["action"];
$id = $_GET["id"];

$sql = "SELECT member_id, promo_id FROM memberpromos WHERE id = $id";
$row = mysqli_fetch_assoc(mysqli_query($conn, $sql));
$member_id = $row["member_id"];
$dateNow = date("Y-m-d H:i:s");

if($action == "accept") {
  $sql = "UPDATE memberpromos SET status = 'Removed' WHERE member_id = $member_id AND status = 'Active'";
  if(mysqli_query($conn, $sql)) {
    $sql = "UPDATE memberpromos SET status = 'Active', admin_action_date = '$dateNow' WHERE id = $id";
    $res = mysqli_query($conn, $sql);

    if($res) {
      $sql = "INSERT INTO member_notifs (member_id, notif_id, status, datetime_sent)
      VALUES ($member_id, 9, 'Unread', '$dateNow')";
      if(mysqli_query($conn, $sql)) {
        echo json_encode("success");
      }
    }
  }
} else {
  $sql = "UPDATE memberpromos SET status = 'Declined' WHERE id = $id";
  $res = mysqli_query($conn, $sql);

  if($res) {
    $sql = "INSERT INTO member_notifs (member_id, notif_id, status, datetime_sent)
    VALUES ($member_id, 10, 'Unread', '$dateNow')";
    if(mysqli_query($conn, $sql)) {
      echo json_encode("success");
    }
  }
}
?>