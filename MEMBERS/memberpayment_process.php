<?php
session_start();
require('connect.php');
date_default_timezone_set('Asia/Manila');

if($_SESSION['admin_id']){
    $session_admin_id = $_SESSION['admin_id'];
}

$id = $_REQUEST['member_id'];
$payment_description = $_POST['payment_description'];
$discount = $_POST['promo_discount'];
$promo_availed = $_POST["promo_availed"];
$monthly_end;
$monthly_start;

$checkIfPaidSql = "SELECT * FROM member WHERE member_id = $id";
$checkIfPaidQuery = mysqli_query($conn, $checkIfPaidSql);
$now = date("Y-m-d");
if($checkIfPaidQuery) {
    $assoc = mysqli_fetch_assoc($checkIfPaidQuery);

    if($assoc["monthly_start"] == null || $assoc["monthly_end"] == null) {
        $monthly_start = $now;
        $monthly_end = date("Y-m-d", strtotime($now." + 30 days"));
    } else {
        if($now >= $assoc["monthly_start"] && $now < $assoc["monthly_end"]) {
            $monthly_start = $assoc["monthly_start"];
            $monthly_end = date("Y-m-d", strtotime($assoc["monthly_end"]. " + 30 days"));
        } else {
            $monthly_start = date("Y-m-d");
            $monthly_end = date("Y-m-d", strtotime($monthly_start. " + 30 days"));
        }
    }
}

if($checkIfPaidQuery) {
    $assoc1 = mysqli_fetch_assoc($checkIfPaidQuery);

    if($assoc1["annual_start"] == null || $assoc1["annual_end"] == null) {
        $annual_start = $now;
        $annual_end = date("Y-m-d", strtotime($now." + 365 days"));
    } else {
        if($now >= $assoc1["annual_start"] && $now < $assoc1["annual_end"]) {
            $annual_start = $assoc1["annual_start"];
            $annual_end = date("Y-m-d", strtotime($assoc1["annual_end"]. " + 365 days"));
        } else {
            $annual_start = date("Y-m-d");
            $annual_end = date("Y-m-d", strtotime($annual_start. " + 365 days"));
        }
    }
}

$dateNow = date("Y-m-d");
$timeNow = date("h:i A");

//Check if you did not choose a subscription
if($payment_description == ''){
    echo ("<script LANGUAGE='JavaScript'>
                window.alert('FAIL TO PAY!..You did not choose subscription.');
                window.location.href='/PROJECT/MEMBERS/members.php';
                </script>");
}

//Check if its monthly
else if($payment_description == 'Monthly Subscription'){
    $payment_amount = 750 - $discount;
    
    $sql0 = "SELECT first_name,last_name,member_type FROM member WHERE member_id = $id";
    $query_run = mysqli_query($conn, $sql0);
    $rows = mysqli_fetch_assoc($query_run);

    $first_name = $rows["first_name"];
    $last_name = $rows["last_name"];
    $member_type = $rows["member_type"];
 
    $monthly_start = date("Y-m-d"); 
    $sql2 = "UPDATE member 
    SET monthly_start = '$monthly_start', monthly_end = '$monthly_end'
    WHERE member_id = $id";     
    mysqli_query($conn, $sql2);

    $sql1 = "INSERT INTO `paymentlog` ( `member_id`,`first_name`,`last_name`, `time_payment`, `date_payment`,
    `payment_description`,`payment_amount`,`member_type`, `promo_availed`)
    VALUES ('$id', '$first_name', '$last_name', '$timeNow', '$dateNow', '$payment_description','$payment_amount',
    '$member_type', '$promo_availed')";
    $query_run = mysqli_query($conn, $sql1);
    
    if($query_run) {
        echo ("<script LANGUAGE='JavaScript'>
                window.alert('Monthly Payment is been added.');
                window.location.href='/PROJECT/MEMBERS/members.php';
                </script>");
    } else {
        echo mysqli_error($conn);
    }

        //this is for puting member_id in the array
        $data = array();
        $member_id;
        $sql3 = "SELECT * FROM member ORDER BY member_id DESC";
        $res3 = mysqli_query($conn, $sql3);
        if($res3) {
            while($row = mysqli_fetch_assoc($res3)) {
                $data[] = $row["member_id"];
            }

            $member_id = $data[0];
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
        $ew = "SELECT * FROM member WHERE member_id = '$member_id'";
        $query_runew = mysqli_query($conn, $ew);
        $rowew = mysqli_fetch_assoc($query_runew);

        $member_id_new = $rowew["member_id"];
        $user_fname = $rowew["first_name"];
        $user_lname = $rowew["last_name"];
        $description = "Paid Monthly Subscription";
        $identity = "member";
        $timeNow = date("h:i A");

        // INSERTING LOGTRAIL INFO  FOR THE LOGTRAIL DOING
        $sql22 = "SELECT * FROM logtrail WHERE login_id = '$login_id'";
        $query_run22 = mysqli_query($conn, $sql22);
        $rows22 = mysqli_fetch_assoc($query_run22);

        $login_id_new = $rows22["login_id"];

        $sql1 = "INSERT INTO `logtrail_doing` ( `login_id`,`admin_id`,`member_id`,`user_fname`,`user_lname`,
        `description`, `identity`,`time`)
        VALUES ( '$login_id_new','$admin_id', '$member_id_new', '$user_fname','$user_lname','$description','$identity', '$timeNow')";
        mysqli_query($conn, $sql1);

        

 //Check if its Annual
}else if($payment_description == 'Annual Membership'){
    $payment_amount = 200;

    $sql0 = "SELECT * FROM member WHERE member_id = $id";
    $query_run = mysqli_query($conn, $sql0);
    $rows = mysqli_fetch_assoc($query_run);

    $first_name = $rows["first_name"];
    $last_name = $rows["last_name"];
    $member_type = $rows["member_type"];
 
    $annual_start = date("Y-m-d"); 
    $pass = password_hash('12345', PASSWORD_DEFAULT);

    $sql2 = "UPDATE member 
    SET annual_start = '$annual_start', annual_end = '$annual_end'
    WHERE member_id = $id";     
    mysqli_query($conn, $sql2);

    $sql1 = "INSERT INTO `paymentlog` ( `member_id`,`first_name`,`last_name`, `time_payment`, `date_payment`,
    `payment_description`,`payment_amount`,`member_type`)
    VALUES ( '$id', '$first_name', '$last_name', '$timeNow', '$dateNow', '$payment_description','$payment_amount'
    ,'$member_type')";
    $query_run = mysqli_query($conn, $sql1);
    
 
     //this is for puting member_id in the array
     $data = array();
     $member_id;
     $sql3 = "SELECT * FROM member ORDER BY member_id DESC";
     $res3 = mysqli_query($conn, $sql3);
     if($res3) {
         while($row = mysqli_fetch_assoc($res3)) {
             $data[] = $row["member_id"];
         }

         $member_id = $data[0];
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
     $ew = "SELECT * FROM member WHERE member_id = '$member_id'";
     $query_runew = mysqli_query($conn, $ew);
     $rowew = mysqli_fetch_assoc($query_runew);

     $member_id_new = $rowew["member_id"];
     $user_fname = $rowew["first_name"];
     $user_lname = $rowew["last_name"];
     $description = "Paid Annual Membership";
     $identity = "member";
     $timeNow = date("h:i A");

     // INSERTING LOGTRAIL INFO  FOR THE LOGTRAIL DOING
     $sql22 = "SELECT * FROM logtrail WHERE login_id = '$login_id'";
     $query_run22 = mysqli_query($conn, $sql22);
     $rows22 = mysqli_fetch_assoc($query_run22);

     $login_id_new = $rows22["login_id"];

     $sql1 = "INSERT INTO `logtrail_doing` ( `login_id`,`admin_id`,`member_id`,`user_fname`,`user_lname`,
     `description`, `identity`,`time`)
     VALUES ( '$login_id_new','$admin_id', '$member_id_new', '$user_fname','$user_lname','$description','$identity', '$timeNow')";
     mysqli_query($conn, $sql1);

    echo ("<script LANGUAGE='JavaScript'>
                window.alert('Annual Payment is been added.');
                window.location.href='/PROJECT/MEMBERS/members.php';
                </script>");

// INSERTINGN REPORTS FOR THE ADMIN INFO
$sql00 = "SELECT first_name,last_name,admin_id FROM admin WHERE admin_id = $session_admin_id";
$query_run1 = mysqli_query($conn, $sql00);
$rows1 = mysqli_fetch_assoc($query_run1);

$admin_fname = $rows1["first_name"];
$admin_lname = $rows1["last_name"];
$admin_id = $rows1["admin_id"];
$description = "Paid Annual Subscription";

// INSERTINGN REPORTS FOR THE MEMBER INFO
$joke = "SELECT first_name,last_name,member_id FROM member WHERE member_id = $id";
$sikwate = mysqli_query($conn, $joke);
$kaubo = mysqli_fetch_assoc($sikwate);

$member_fname = $kaubo["first_name"];
$member_lname = $kaubo["last_name"];
$member_id = $kaubo["member_id"];
$identity = "member";

$klint = "INSERT INTO `reports` ( `admin_id`,`admin_fname`,`admin_lname`,
member_id, member_fname,member_lname,`description`,`identity`)
VALUES ( '$admin_id', '$admin_fname', '$admin_lname','$member_id','$member_fname','$member_lname', '$description','$identity')";
$query_run123 = mysqli_query($conn, $klint);



}else if($payment_description == 'both'){
    $sql0 = "SELECT * FROM member WHERE member_id = $id";
    $query_run = mysqli_query($conn, $sql0);
    $rows = mysqli_fetch_assoc($query_run);

    $first_name = $rows["first_name"];
    $last_name = $rows["last_name"];
    $member_type = $rows["member_type"];

    $sql1 = "UPDATE member 
    SET monthly_start = '$monthly_start', monthly_end = '$monthly_end',
    annual_start = '$annual_start', annual_end = '$annual_end'
    WHERE member_id = $id";     
    mysqli_query($conn, $sql1);

    $sql2 = "INSERT INTO `paymentlog` ( `member_id`,`first_name`,`last_name`, `time_payment`, `date_payment`,
    `payment_description`,`payment_amount`,`member_type`, `promo_availed`)
    VALUES ( '$id', '$first_name', '$last_name', '$timeNow', '$dateNow', 'Monthly subscription',".intval(750 - $discount)."
    ,'$member_type', '$promo_availed')";
    mysqli_query($conn, $sql2);

    $sql3 = "INSERT INTO `paymentlog` ( `member_id`,`first_name`,`last_name`, `time_payment`, `date_payment`,
    `payment_description`,`payment_amount`,`member_type`)
    VALUES ( '$id', '$first_name', '$last_name', '$timeNow', '$dateNow', 'Annual Membership','200'
    ,'$member_type')";
    mysqli_query($conn, $sql3);

    echo ("<script LANGUAGE='JavaScript'>
    window.alert('Both Annual and Monthly  Payment is been added.');
    window.location.href='/PROJECT/MEMBERS/members.php';
    </script>");


}else if($payment_description == 'Walk-in'){
    $payment_amount = '50';

    $sql0 = "SELECT * FROM member WHERE member_id = $id";
    $query_run = mysqli_query($conn, $sql0);
    $rows = mysqli_fetch_assoc($query_run);

    $first_name = $rows["first_name"];
    $last_name = $rows["last_name"];
    $member_type = $rows["member_type"];


    $sql1 = "INSERT INTO `paymentlog` ( `member_id`,`first_name`,`last_name`, `time_payment`, `date_payment`,
    `payment_description`,`payment_amount`,`member_type`)
    VALUES ( '$id', '$first_name', '$last_name', '$timeNow', '$dateNow', '$payment_description','$payment_amount'
    ,'$member_type')";
    $query_run = mysqli_query($conn, $sql1);

    
    echo ("<script LANGUAGE='JavaScript'>
                window.alert('Walk-in Payment is been added.');
                window.location.href='/PROJECT/MEMBERS/members.php';
                </script>");

     //this is for puting member_id in the array
     $data = array();
     $member_id;
     $sql3 = "SELECT * FROM member ORDER BY member_id DESC";
     $res3 = mysqli_query($conn, $sql3);
     if($res3) {
         while($row = mysqli_fetch_assoc($res3)) {
             $data[] = $row["member_id"];
         }

         $member_id = $data[0];
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
     $ew = "SELECT * FROM member WHERE member_id = '$member_id'";
     $query_runew = mysqli_query($conn, $ew);
     $rowew = mysqli_fetch_assoc($query_runew);

     $member_id_new = $rowew["member_id"];
     $user_fname = $rowew["first_name"];
     $user_lname = $rowew["last_name"];
     $description = "Paid Walk-in";
     $identity = "member";
     $timeNow = date("h:i A");

     // INSERTING LOGTRAIL INFO  FOR THE LOGTRAIL DOING
     $sql22 = "SELECT * FROM logtrail WHERE login_id = '$login_id'";
     $query_run22 = mysqli_query($conn, $sql22);
     $rows22 = mysqli_fetch_assoc($query_run22);

     $login_id_new = $rows22["login_id"];

     $sql1 = "INSERT INTO `logtrail_doing` ( `login_id`,`admin_id`,`member_id`,`user_fname`,`user_lname`,
     `description`, `identity`,`time`)
     VALUES ( '$login_id_new','$admin_id', '$member_id_new', '$user_fname','$user_lname','$description','$identity', '$timeNow')";
     mysqli_query($conn, $sql1);

    echo ("<script LANGUAGE='JavaScript'>
                window.alert('Annual Payment is been added.');
                window.location.href='/PROJECT/MEMBERS/members.php';
                </script>");
}else{
    echo "failure to register";
    header('Location: /PROJECT/MEMBERS/members.php?failure to pay');
}

// Checking if paid
$lastMonthly;
$lastAnnual;

$sqlMonthly = "SELECT * FROM paymentlog WHERE member_id = '$id'
        AND payment_description = 'Monthly Subscription'
        ORDER BY payment_id DESC";
$resMonthly = mysqli_query($conn, $sqlMonthly);
if($resMonthly) {
    $results = array();
    while($row = mysqli_fetch_assoc($resMonthly)) {
        $results[] = $row;
    }

    $lastMonthly = strtotime($results[0]["date_payment"]);
    echo $lastMonthly;
} else {
    echo mysqli_error($conn);
}

$sqlAnnual = "SELECT * FROM paymentlog WHERE member_id = '$id'
        AND payment_description = 'Annual Membership'
        ORDER BY payment_id DESC";
$resAnnual = mysqli_query($conn, $sqlAnnual);
if($resAnnual) {
    $results = array();
    while($row = mysqli_fetch_assoc($resAnnual)) {
        $results[] = $row;
    }

    $lastAnnual = strtotime($results[0]["date_payment"]);
    echo $lastAnnual;
}

if($resAnnual && $resMonthly) {
    $today = date("Y-m-d");
    $now = strtotime($today);
    $lastMonth = strtotime(date("Y-m-d", strtotime($today." - 30 days")));
    $lastYear = strtotime(date("Y-m-d", strtotime($today." - 365 days")));

    if($lastMonthly >= $lastMonth && $lastMonthly <= $now && $lastAnnual >= $lastYear && $lastAnnual <= $now) {
        $sql = "UPDATE member SET member_status = 'Paid'
                WHERE member_id = $id";
        if(mysqli_query($conn, $sql)) {
            echo "Paid naka dots";
        } else {
            echo mysqli_error($conn);
        }
    }
}
?>
