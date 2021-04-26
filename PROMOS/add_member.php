<?php
require "./../connect.php";
session_start();
date_default_timezone_set('Asia/Manila');

$promoId = $_REQUEST["promoId"];
$memberId = $_REQUEST["memberId"];
$status = intval($_REQUEST["status"]);
$date = date("Y-m-d");
$isActive = true;
$session_admin_id = $_SESSION["admin_id"];

$checkIfActiveSql = "SELECT acc_status FROM member WHERE member_id = $memberId";
$checkIfActiveQuery = mysqli_query($conn, $checkIfActiveSql);
if($checkIfActiveQuery) {
	$memberRow = mysqli_fetch_assoc($checkIfActiveQuery);

	if($memberRow["acc_status"] == "inactive") {
		$isActive = false;
	}
}

if($isActive) {
	if ($status == 2) {
		$sql = "SELECT mp.id FROM memberpromos AS mp
						INNER JOIN promo AS p
						ON mp.promo_id = p.promo_id
						WHERE mp.member_id = $memberId
						AND mp.status = 'Active'
						AND p.promo_type = 'Permanent'";
		$res = mysqli_query($conn, $sql);
		$row = mysqli_fetch_assoc($res);
	
		$sql = "UPDATE memberpromos SET status = 'Expired'
						WHERE id = " . $row["id"];
		$query = mysqli_query($conn, $sql);
	}
	
	$sql = "INSERT INTO memberpromos (promo_id, member_id, date_added)
					VALUES ($promoId, $memberId, '$date')";
	$res = mysqli_query($conn, $sql);
	
	if ($res) {
		//-----------LOGTRAIL DOING
	
		//this is for puting login_id in the array
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
	
		// INSERTING  ADMIN INFO FOR THE LOGTRAIL DOING
		$ad = "SELECT * FROM admin WHERE admin_id = $session_admin_id";
		$query_runad = mysqli_query($conn, $ad);
		$rowed = mysqli_fetch_assoc($query_runad);
	
		$admin_id = $rowed["admin_id"];
	
		// INSERTING MEMBER INFO FOR THE LOGTRAIL DOING
		$ew = "SELECT * FROM promo WHERE promo_id = '$promoId'";
		$query_runew = mysqli_query($conn, $ew);
		$rowew = mysqli_fetch_assoc($query_runew);
	
		$promo_id_new = $rowew["promo_id"];
		$description = "Added a member to " . $rowew["promo_name"];
		//$description = $echo.' '.$fullname;
		$identity = "Promos";
		$timeNow = date("h:i A");
	
	
		// INSERTING LOGTRAIL INFO  FOR THE LOGTRAIL DOING
		$sql22 = "SELECT * FROM logtrail WHERE login_id = '$login_id'";
		$query_run22 = mysqli_query($conn, $sql22);
		$rows22 = mysqli_fetch_assoc($query_run22);
	
		$login_id_new = $rows22["login_id"];
	
		// INSERTING LOGTRAIL INFO  FOR THE LOGTRAIL DOING
		$sql22q = "SELECT * FROM member WHERE member_id = '$memberId'";
		$query_run22q = mysqli_query($conn, $sql22q);
		$rows22q = mysqli_fetch_assoc($query_run22q);
	
		$member_id_new = $rows22q["member_id"];
		$user_fname = $rows22q["first_name"];
		$user_lname = $rows22q["last_name"];
		$fullname = $user_fname . ' ' . $user_lname;
	
		$sql1 = "INSERT INTO `logtrail_doing` 
		 ( `login_id`,`admin_id`,`promo_id`,`user_fname`,`description`, `identity`,`time`)
			 VALUES 
		 ( '$login_id_new','$admin_id', '$promoId', '$fullname','$description','$identity', '$timeNow')";
		mysqli_query($conn, $sql1);
	
		echo "<script>
		alert('Member successfully availed promo!');
		window.location.href = './promos.php';
		</script>";
	}
} else {
	echo "<script>
	alert('Member is already inactive. Cannot avail promo.');
	window.location.href = './promos.php';
	</script>";
}
?>