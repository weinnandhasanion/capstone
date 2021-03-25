<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");
date_default_timezone_set('Asia/Manila');
$conn = mysqli_connect("localhost","root","","gym");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
		