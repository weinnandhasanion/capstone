
<?php 
session_start();
require('connect.php');

if($_SESSION['admin_id']){
        $session_admin_id = $_SESSION['admin_id'];
    }
    
$id = $_REQUEST['id'];
$lastnameID = $_REQUEST['lastnameID'];

$username =   NULL;
$pass =   NULL;

$annual_start = date("Y-m-d h:i:s"); 
$annual_end = date("Y-m-d", strtotime($annual_start. " + 365 days"));

$ox = "UPDATE member SET username = '$username', password = '$pass', member_status = 'Expired', annual_start = '$annual_start',  annual_end = '$annual_end'
WHERE member_id = " . intval($id) . "";     


if(mysqli_query($conn, $ox))
        json_encode('success');
else
        echo mysqli_error($conn), 'NOT UPDATED';    



$annual_description = "Annual Subscription";
$amount = "200";
$date_payment = date("Y-m-d");

$sql0 = "SELECT first_name,last_name,member_type FROM member WHERE member_id = $id";
$sql2 = mysqli_query($conn, $sql0);
$rows = mysqli_fetch_assoc($sql2);

$first_name = $rows["first_name"];
$last_name = $rows["last_name"];
$member_type = $rows["member_type"];

$sql1 = "INSERT INTO `paymentlog` ( `member_id`,`first_name`,`last_name`,
`payment_description`,`payment_amount`,`date_payment`,`member_type`)
VALUES ( '$id', '$first_name', '$last_name', '$annual_description','$amount'
,'$date_payment','$member_type')";
$query_run = mysqli_query($conn, $sql1);


// INSERTINGN REPORTS FOR THE ADMIN INFO
$sql0 = "SELECT first_name,last_name,admin_id FROM admin WHERE admin_id = $session_admin_id";
$query_run = mysqli_query($conn, $sql0);
$rows = mysqli_fetch_assoc($query_run);

$admin_fname = $rows["first_name"];
$admin_lname = $rows["last_name"];
$admin_id = $rows["admin_id"];
$description = "Deactivated an account";


// INSERTINGN REPORTS FOR THE MEMBER INFO
$sql0 = "SELECT first_name,last_name,member_id FROM member WHERE member_id = $id";
$query_run = mysqli_query($conn, $sql0);
$rows = mysqli_fetch_assoc($query_run);

$member_fname = $rows["first_name"];
$member_lname = $rows["last_name"];
$member_id = $rows["member_id"];
$identity = "member";

$sql1 = "INSERT INTO `reports` ( `admin_id`,`admin_fname`,`admin_lname`,
member_id, member_fname,member_lname,`description`,`identity`)
VALUES ( '$admin_id', '$admin_fname', '$admin_lname','$member_id','$member_fname','$member_lname', '$description','$identity')";
$query_run = mysqli_query($conn, $sql1);

?>