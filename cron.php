<?php 
require "./connect.php";
session_start();

// Notifications CRON job
$dateNow = date("Y-m-d H:i A");

$sql = "SELECT * FROM member WHERE acc_status = 'active' AND member_status = 'Paid'";
$res = mysqli_query($conn, $sql);

if($res) {
  while($row = mysqli_fetch_assoc($res)) {
    if($row["monthly_end"] == date("Y-m-d", strtotime($dateNow." + 7 days"))) {
      sendNotif($row["member_id"], $dateNow, 1);
    } else if($row["monthly_end"] == date("Y-m-d", strtotime($dateNow." + 3 days"))) {
      sendNotif($row["member_id"], $dateNow, 2);
    } else if($row["monthly_end"] == date("Y-m-d", strtotime($dateNow." + 1 day"))) {
      sendNotif($row["member_id"], $dateNow, 3);
    } 
    
    if($row["annual_end"] == date("Y-m-d", strtotime($dateNow." + 30 days"))) {
      sendNotif($row["member_id"], $dateNow, 6);
    } else if($row["annual_end"] == date("Y-m-d", strtotime($dateNow." + 7 days"))) {
      sendNotif($row["member_id"], $dateNow, 7);
    }
  }
} else {
  echo mysqli_error($conn);
}

// Checking if paid CRON job
$today = date("Y-m-d");
$memberSql = "UPDATE member SET member_status = 'Expired' WHERE (monthly_end < '$today' OR annual_end < '$today') AND member_status = 'Paid'";
$memberQuery = mysqli_query($conn, $memberSql);

$membersSql = "SELECT * FROM member WHERE member_status = 'Expired'";
$membersQuery = mysqli_query($conn, $membersSql);
if(mysqli_num_rows($membersQuery) > 0) {
  while($row = mysqli_fetch_assoc($membersQuery)) {
    if($today == date("Y-m-d", strtotime($row["monthly_end"]."+ 1 day"))) {
      sendNotif($row["member_id"], $dateNow, 4);
    }

    if($today == date("Y-m-d", strtotime($row["annual_end"]."+ 1 day"))) {
      sendNotif($row["member_id"], $dateNow, 5);
    } else if($today == date("Y-m-d", strtotime($row["annual_end"]."+ 7 days")) && $today >= date("Y-m-d", strtotime($row["monthly_end"]."+ 1 day"))) {
      sendNotif($row["member_id"], $dateNow, 8);
    } else if($today == date("Y-m-d", strtotime($row["annual_end"]."+ 15 days")) && $today >= date("Y-m-d", strtotime($row["monthly_end"]."+ 1 day"))) {
      makeInactive($row["member_id"]);
    }
  }
}

function sendNotif($id, $dateNow, $notifId) {
  global $conn;

  $hasNotifs = checkNotifs($id, $conn, $notifId);

  if(!$hasNotifs) {
    $sql = "INSERT INTO member_notifs (member_id, notif_id, status, datetime_sent)
            VALUES ($id, $notifId, 'Unread', '$dateNow')";
    mysqli_query($conn, $sql);
  }
}

function makeInactive($id) {
  global $conn;

  $sql = "UPDATE member SET member_status = 'inactive', date_deleted = '".date("Y-m-d")."' WHERE member_id = '$id'";
  mysqli_query($conn, $sql);
}
 
function checkNotifs($id, $conn, $notifId) {
  $date = date("Y-m-d");
  $sql = "SELECT * FROM member_notifs WHERE DATE(datetime_sent) = '$date' 
          AND member_id = $id AND notif_id = $notifId";
  $res = mysqli_query($conn, $sql);
  $hasNotifs = mysqli_num_rows($res) > 0 ? true : false;

  return $hasNotifs;
}

// Checking promo availability CRON job
$date = date("Y-m-d");

$promoSql = "UPDATE promo SET status = 'Expired'
              WHERE promo_ending_date < '$date'
              AND NOT promo_ending_date = '1970-01-01'";
$promoQuery = mysqli_query($conn, $promoSql);

$memberPromoSql = "UPDATE memberpromos AS mp 
                    INNER JOIN promo AS p
                    ON mp.promo_id = p.promo_id
                    SET mp.status = 'Expired'
                    WHERE p.status = 'Expired'";
$memberPromoQuery = mysqli_query($conn, $memberPromoSql);
?>