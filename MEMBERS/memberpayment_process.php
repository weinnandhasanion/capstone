<?php
session_start();
require('connect.php');
date_default_timezone_set('Asia/Manila');

if($_SESSION['admin_id']){
    $session_admin_id = $_SESSION['admin_id'];
}

$id = $_REQUEST['member_id'];
$payment_description = $_POST['payment_description'];
$monthly_end;
$monthly_start;

$checkIfPaidSql = "SELECT * FROM member WHERE member_id = $id";
$checkIfPaidQuery = mysqli_query($conn, $checkIfPaidSql);
$now = date("Y-m-d");
if($checkIfPaidQuery) {
    $assoc = mysqli_fetch_assoc($checkIfPaidQuery);

    if($now >= $assoc["monthly_start"] && $now < $assoc["monthly_end"]) {
        $monthly_start = $assoc["monthly_start"];
        $monthly_end = date("Y-m-d", strtotime($assoc["monthly_end"]. " + 30 days"));
    } else {
        $monthly_start = date("Y-m-d");
        $monthly_end = date("Y-m-d", strtotime($monthly_start. " + 30 days"));
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
    $payment_amount = '750';
    
    $sql0 = "SELECT first_name,last_name,member_type FROM member WHERE member_id = $id";
    $query_run = mysqli_query($conn, $sql0);
    $rows = mysqli_fetch_assoc($query_run);

    $first_name = $rows["first_name"];
    $last_name = $rows["last_name"];
    $member_type = $rows["member_type"];
 
    $monthly_start = date("Y-m-d"); 
    $sql2 = "UPDATE member 
    SET member_status = 'Paid',monthly_start = '$monthly_start', monthly_end = '$monthly_end'
    WHERE member_id = $id";     
    mysqli_query($conn, $sql2);

    $sql1 = "INSERT INTO `paymentlog` ( `member_id`,`first_name`,`last_name`, `time_payment`, `date_payment`,
    `payment_description`,`payment_amount`,`member_type`)
    VALUES ( '$id', '$first_name', '$last_name', '$timeNow', '$dateNow', '$payment_description','$payment_amount'
    ,'$member_type')";
    $query_run = mysqli_query($conn, $sql1);
    
    if($query_run) {
        echo ("<script LANGUAGE='JavaScript'>
                window.alert('Monthly Payment is been added.');
                window.location.href='/PROJECT/MEMBERS/members.php';
                </script>");
    } else {
        echo mysqli_error($conn);
    }

// INSERTINGN REPORTS FOR THE ADMIN INFO
$sql00 = "SELECT first_name,last_name,admin_id FROM admin WHERE admin_id = $session_admin_id";
$query_run1 = mysqli_query($conn, $sql00);
$rows1 = mysqli_fetch_assoc($query_run1);

$admin_fname = $rows1["first_name"];
$admin_lname = $rows1["last_name"];
$admin_id = $rows1["admin_id"];
$description = "Pay Monthly Subscription";

// INSERTINGN REPORTS FOR THE MEMBER INFO
$sql11 = "SELECT first_name,last_name,member_id FROM member WHERE member_id = $id";
$query_run11 = mysqli_query($conn, $sql11);
$rows11 = mysqli_fetch_assoc($query_run11);

$member_fname = $rows11["first_name"];
$member_lname = $rows11["last_name"];
$member_id = $rows11["member_id"];
$identity = "member";

$Cagz = "INSERT INTO `reports` ( `admin_id`,`admin_fname`,`admin_lname`,
member_id, member_fname,member_lname,`description`,`identity`)
VALUES ( '$admin_id', '$admin_fname', '$admin_lname','$member_id','$member_fname','$member_lname', '$description','$identity')";
$query_run123 = mysqli_query($conn, $Cagz);

 //Check if its Annual
}else if($payment_description == 'Annual Subscription'){
    $payment_amount = '200';

    $sql0 = "SELECT first_name,last_name,member_type FROM member WHERE member_id = $id";
    $query_run = mysqli_query($conn, $sql0);
    $rows = mysqli_fetch_assoc($query_run);

    $first_name = $rows["first_name"];
    $last_name = $rows["last_name"];
    $member_type = $rows["member_type"];

   
    $sql1 = "INSERT INTO `paymentlog` ( `member_id`,`first_name`,`last_name`,
    `payment_description`,`payment_amount`,`member_type`)
    VALUES ( '$id', '$first_name', '$last_name', '$payment_description','$payment_amount'
    ,'$member_type')";
    $query_run = mysqli_query($conn, $sql1);

    
 
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
$description = "Pay Annual Subscription";

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

}else if($payment_description == 'Walk-in'){
    $payment_amount = '50';

    $sql0 = "SELECT first_name,last_name,member_type FROM member WHERE member_id = $id";
    $query_run = mysqli_query($conn, $sql0);
    $rows = mysqli_fetch_assoc($query_run);

    $first_name = $rows["first_name"];
    $last_name = $rows["last_name"];
    $member_type = $rows["member_type"];

   
    
    $sql1 = "INSERT INTO `paymentlog` ( `member_id`,`first_name`,`last_name`,
    `payment_description`,`payment_amount`,`member_type`)
    VALUES ( '$id', '$first_name', '$last_name', '$payment_description','$payment_amount'
    ,'$member_type')";
    $query_run = mysqli_query($conn, $sql1);

    
    echo ("<script LANGUAGE='JavaScript'>
                window.alert('Walk-in Payment is been added.');
                window.location.href='/PROJECT/MEMBERS/members.php';
                </script>");

// INSERTINGN REPORTS FOR THE ADMIN INFO
$sql00 = "SELECT first_name,last_name,admin_id FROM admin WHERE admin_id = $session_admin_id";
$query_run1 = mysqli_query($conn, $sql00);
$rows1 = mysqli_fetch_assoc($query_run1);

$admin_fname = $rows1["first_name"];
$admin_lname = $rows1["last_name"];
$admin_id = $rows1["admin_id"];
$description = "Pay Walk-in";

// INSERTINGN REPORTS FOR THE MEMBER INFO
$sukarap = "SELECT first_name,last_name,member_id FROM member WHERE member_id = $id";
$biitok = mysqli_query($conn, $sukarap);
$doremon = mysqli_fetch_assoc($biitok);

$member_fname = $doremon["first_name"];
$member_lname = $doremon["last_name"];
$member_id = $doremon["member_id"];
$identity = "member";

$John = "INSERT INTO `reports` ( `admin_id`,`admin_fname`,`admin_lname`,
member_id, member_fname,member_lname,`description`,`identity`)
VALUES ( '$admin_id', '$admin_fname', '$admin_lname','$member_id','$member_fname','$member_lname', '$description','$identity')";
$query_run123 = mysqli_query($conn, $John);

    
}else{
    echo "failure to register";
    header('Location: /PROJECT/MEMBERS/members.php?failure to pay');
}
    
?>
