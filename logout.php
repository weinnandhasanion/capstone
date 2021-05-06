<?php
session_start();
require('connect.php');
date_default_timezone_set('Asia/Manila');
$id = $_REQUEST['id'];

$sql1 = "UPDATE logtrail SET dateandtime_logout = '" . date("Y-m-d H:i:s") . "'
WHERE login_id = " . intval($id) . "";


if (mysqli_query($conn, $sql1)) {
  json_encode('success');
} else {
  echo mysqli_error($conn), 'NOT UPDATED';
}
