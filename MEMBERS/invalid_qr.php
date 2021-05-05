<?php 

$message = "You scanned an invalid QR Code. Please scan a QR Code generated for the members of the gym.";
$type = "red";
$title = "Invalid QR Code";

$obj = (object) [
  "message" => $message,
  "type" => $type,
  "title" => $title
];

echo json_encode($obj);
?>