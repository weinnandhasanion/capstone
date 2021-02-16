<?php
date_default_timezone_set('Asia/Manila');
$conn = mysqli_connect("localhost","root","","gym");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
		