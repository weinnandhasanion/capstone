<?php 
require "./connect.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './plugins/PHPMailer/src/Exception.php';
require './plugins/PHPMailer/src/PHPMailer.php';
require './plugins/PHPMailer/src/SMTP.php';

$email = $_GET["email"];

$sql = "SELECT code FROM admin WHERE username = '$email'";
$res = mysqli_query($conn, $sql);

if($res) {
  if(mysqli_num_rows($res) > 0) {
    $row = mysqli_fetch_assoc($res);

    $code = $row["code"];
    $body = "Here is your code for changing password: $code";
    $mail = new PHPMailer;
  
    try {
      $mail->SMTPOptions = array(
        'ssl' => array(
          'verify_peer' => false,
          'verify_peer_name' => false,
          'allow_self_signed' => true
        )
      );
  
      $mail->isSMTP(); 
      $mail->Host = "smtp.gmail.com"; 
      $mail->Port = 587;
      $mail->SMTPSecure = 'tls';
      $mail->SMTPAuth = true;
      $mail->Username = "cfgym2019@gmail.com";
      $mail->Password = "cfgym12345";
      $mail->setFrom("cfgym2019@gmail.com", "California Fitness Gym");
      $mail->addAddress($email);
      $mail->Subject = 'Code for Admin Change Password';
      $mail->Body = $body;
      $mail->isHTML(false);
  
      $mail->send();
      echo json_encode("success");
    } catch (Exception $e) {
      echo json_encode($mail->ErrorInfo);
    }
  } else {
    echo json_encode("Email entered doesn't match any records.");
  }
} else {
  echo json_encode("Email entered doesn't match any records.");
}
?>