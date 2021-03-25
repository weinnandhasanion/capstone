<?php 
require "./../connect.php";
session_start();
date_default_timezone_set('Asia/Manila');
if($_SESSION['admin_id']){
        $session_admin_id = $_SESSION['admin_id'];
    }
$memberId = $_REQUEST["member_id"];
$promoId = $_REQUEST["promo_id"];

$sql = "UPDATE memberpromos 
        SET status = 'Expired', date_expired = '".date("Y-m-d")."'
        WHERE member_id = $memberId AND promo_id = $promoId";
$res = mysqli_query($conn, $sql);

if($res) {
     //this is for puting promo_id in the array
     $data = array();
     $promo_id;
     $sql3 = "SELECT * FROM promo ORDER BY promo_id DESC";
     $res3 = mysqli_query($conn, $sql3);
     if($res3) {
         while($row = mysqli_fetch_assoc($res3)) {
             $data[] = $row["promo_id"];
         }

         $promo_id = $data[0];
     }

     //this is for puting promo_id in the array
     $data = array();
     $sql3q = "SELECT * FROM member ORDER BY member_id DESC";
     $res3a = mysqli_query($conn, $sql3q);
     if($res3a) {
         while($rowq = mysqli_fetch_assoc($res3a)) {
             $data[] = $rowq["member_id"];
         }

         $member_id_okay = $data[0];
     }


     //this is for puting login_id in the array
     $data_logtrail = array();
     $login_id;
     $log = "SELECT * FROM logtrail ORDER BY login_id DESC";
     $logtrail = mysqli_query($conn, $log);
     if($logtrail) {
         while($rowrow = mysqli_fetch_assoc($logtrail)) {
             $data_logtrail[] = $rowrow["login_id"];
         }

         $login_id = $data_logtrail[0];
     }

     // INSERTING  ADMIN INFO FOR THE LOGTRAIL DOING
     $ad= "SELECT * FROM admin WHERE admin_id = $session_admin_id";
     $query_runad = mysqli_query($conn, $ad);
     $rowed = mysqli_fetch_assoc($query_runad);

     $admin_id = $rowed["admin_id"];

     // INSERTING MEMBER INFO FOR THE LOGTRAIL DOING
     $ew = "SELECT * FROM promo WHERE promo_id = '$promoId'";
     $query_runew = mysqli_query($conn, $ew);
     $rowew = mysqli_fetch_assoc($query_runew);

     $promo_id_new = $rowew["promo_id"];
     $promo_name = $rowew["promo_name"];
     $description = "Remove a member from $promo_name promo";
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
        $fullname = $user_fname.' '.$user_lname;

     $sql1 = "INSERT INTO `logtrail_doing` 
	 ( `login_id`,`admin_id`,`promo_id`,`user_fname`,`description`, `identity`,`time`)
     VALUES 
	 ( '$login_id_new','$admin_id', '$promo_id_new', '$fullname','$description','$identity', '$timeNow')";
     mysqli_query($conn, $sql1);


  echo "<script>
    alert('Member successfully removed from promo.');
    window.location.href = './promos.php';
  </script>";
} else {
  echo "<script>
    alert('Error: ".mysqli_error($conn)."');
    window.location.href = './promos.php';
  </script>";
}
?>