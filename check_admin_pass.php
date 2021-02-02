<?php 

$pass = $_GET["pass"];
$code = "/california2021";

if($pass == $code) {
  echo true;
} else {
  echo false;
}
?>