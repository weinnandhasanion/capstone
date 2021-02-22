<?php 
require "./connect.php";
session_start();

$id = $_GET["id"];

$sql = "SELECT mn.*, n.notif_message FROM member_notifs AS mn
        INNER JOIN notifications AS n
        ON mn.notif_id = n.notif_id
        WHERE id = $id";
$res = mysqli_query($con, $sql);

if($res) {
  $row = mysqli_fetch_assoc($res);
  $row["date"] = date("M d, Y &#183; h:i A", strtotime($row["datetime_sent"]));
  $row["isUnread"] = $row["status"] == "Unread" ? true : false;

  if($row["isUnread"]) {
    updateNotif($row["id"]);
  }

  echo json_encode($row);
}

function updateNotif($id) {
  global $con;
  $now = date("Y-m-d H:i:s");

  $sql = "UPDATE member_notifs SET status = 'Read', date_read = '$now' WHERE id = $id";
  mysqli_query($con, $sql);
}
?>