<?php
session_start();
require('./../connect.php');
date_default_timezone_set('Asia/Manila');

if ($_SESSION['admin_id']) {
    $session_admin_id = $_SESSION['admin_id'];
}

$id = $_REQUEST['id'];
$today = date("Y-m-d");

$sql = "SELECT * FROM member WHERE member_id = $id";
$query = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($query);

if (empty($row["annual_start"]) || $today > $row["annual_end"]) {
    echo json_encode("failure");
} else {
    if (empty($row["date_activated"])) {
        $pass = password_hash('12345', PASSWORD_DEFAULT);
        $dateNow = date("Y-m-d");

        $ox = "UPDATE member SET username = '$id', password = '$pass', date_activated = '$dateNow', isActivated = 'true'
        WHERE member_id = " . intval($id) . "";


        if (mysqli_query($conn, $ox)) {
            echo json_encode('success');
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
            $sql0 = "SELECT first_name,last_name,admin_id FROM admin WHERE admin_id = $session_admin_id";
            $query_run = mysqli_query($conn, $sql0);
            $rows1 = mysqli_fetch_assoc($query_run);

            $last_name = $rows1["last_name"];
            $admin_id = $rows1["admin_id"];
            // INSERTING MEMBER INFO FOR THE LOGTRAIL DOING
            $sql2 = "SELECT first_name,last_name,member_id FROM member WHERE member_id = '$id'";
            $query_run2 = mysqli_query($conn, $sql2);
            $rows2 = mysqli_fetch_assoc($query_run2);

            $member_id_new = $rows2["member_id"];
            $user_fname = $rows2["first_name"];
            $user_lname = $rows2["last_name"];
            $first_name = $rows["first_name"];
            $description = "Activated the account";
            $identity = "Members";
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
        } else {
            echo mysqli_error($conn), 'NOT UPDATED';
        }
    } else {
        $dateNow = date("Y-m-d");

        $ox = "UPDATE member SET date_activated = '$dateNow', isActivated = 'true'
        WHERE member_id = " . intval($id) . "";

        if (mysqli_query($conn, $ox)) {
            echo json_encode('success');
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
            $sql0 = "SELECT first_name,last_name,admin_id FROM admin WHERE admin_id = $session_admin_id";
            $query_run = mysqli_query($conn, $sql0);
            $rows1 = mysqli_fetch_assoc($query_run);

            $last_name = $rows1["last_name"];
            $admin_id = $rows1["admin_id"];
            // INSERTING MEMBER INFO FOR THE LOGTRAIL DOING
            $sql2 = "SELECT first_name,last_name,member_id FROM member WHERE member_id = '$id'";
            $query_run2 = mysqli_query($conn, $sql2);
            $rows2 = mysqli_fetch_assoc($query_run2);

            $member_id_new = $rows2["member_id"];
            $user_fname = $rows2["first_name"];
            $user_lname = $rows2["last_name"];
            $first_name = $rows2["first_name"];
            $description = "Activated the account";
            $identity = "Members";
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
        } else {
            echo mysqli_error($conn), 'NOT UPDATED';
        }
    }
}
