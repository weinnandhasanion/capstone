<?php 
require "./../connect.php";
session_start();

$action = $_GET["action"];
$id = $_GET["id"];
$adminId = $_SESSION["admin_id"];
$time = date("h:i A");

$sql = "SELECT login_id FROM logtrail WHERE admin_id = $adminId ORDER BY login_id DESC";
$res = mysqli_query($conn, $sql);
$data = array();
while($row = mysqli_fetch_assoc($res)) {
  $data[] = $row;
}
$login_id = $data[0]["login_id"];

$sql = "SELECT mp.member_id, mp.promo_id, m.first_name, m.last_name 
  FROM memberpromos AS mp
  INNER JOIN member AS m
  ON mp.member_id = m.member_id
  WHERE id = $id";
$row = mysqli_fetch_assoc(mysqli_query($conn, $sql));
$fname = $row["first_name"]." ".$row["last_name"];
$member_id = $row["member_id"];
$dateNow = date("Y-m-d H:i:s");

if($action == "accept") {
  $sql = "UPDATE memberpromos SET status = 'Removed' WHERE member_id = $member_id AND status = 'Active'";
  if(mysqli_query($conn, $sql)) {
    $sql = "UPDATE memberpromos SET status = 'Active', admin_action_date = '$dateNow', date_added = '$dateNow' WHERE id = $id";
    $res = mysqli_query($conn, $sql);

    if($res) {
      $sql = "INSERT INTO member_notifs (member_id, notif_id, status, datetime_sent)
      VALUES ($member_id, 9, 'Unread', '$dateNow')";
      if(mysqli_query($conn, $sql)) {
        $sql = "INSERT INTO logtrail_doing (login_id, admin_id, user_fname, description, identity, time)
          VALUES ('$login_id', '$adminId', '$fname', 'Accepted promo request', 'Promos', '$time')";
        $res = mysqli_query($conn, $sql);

        if($res) {
          echo json_encode("success");
        } else {
          echo mysqli_error($conn);
        }
      }
    }
  }
} else {
  $sql = "UPDATE memberpromos SET status = 'Declined', admin_action_date = '$dateNow' WHERE id = $id";
  $res = mysqli_query($conn, $sql);

  if($res) {
    $sql = "INSERT INTO member_notifs (member_id, notif_id, status, datetime_sent)
    VALUES ($member_id, 10, 'Unread', '$dateNow')";
    if(mysqli_query($conn, $sql)) {
      $sql = "INSERT INTO logtrail_doing (login_id, admin_id, member_id, user_fname, description, identity, time)
        VALUES ('$login_id', '$adminId', '$member_id', '$fname', 'Declined promo request', 'Promos', '$time')";
      $res = mysqli_query($conn, $sql);

      if($res) {
        echo json_encode("success");
      } else {
        echo mysqli_error($conn);
      }
    }
  }
}
?>