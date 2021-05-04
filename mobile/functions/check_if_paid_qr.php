<?php 
require "./connect.php";
session_start();

$id = $_GET["id"];

$sql = "SELECT * FROM member WHERE member_id = $id";
$res = mysqli_query($con, $sql);
if($res) {
  $row = mysqli_fetch_assoc($res);
  $fn = $row["first_name"];
  $ln = $row["last_name"];
  $today = date("Y-m-d");

  $monthlyPaid = false;
  $annualPaid = false;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
  <link rel="icon" href="./../img/gym_logo.png">
  <title>Subscription Check</title>
  
  <style>
    html, body {
      margin: 0;
      height: 100vh;
      width: 100%;
    }

    .container {
      height: 100%;
    }

    .card-title, h6 {
      margin-bottom: 0 !important;
    }
  </style>
</head>
<body>
  <div class="container d-flex justify-content-center align-items-center">
    <div class="card text-center">
      <div class="card-header">
        California Fitness Gym
      </div>
      <div class="card-body d-flex justify-content-center flex-column align-items-center">
        <div id="profilepic"
          style="border-radius: 50%; height: 150px; width: 150px; overflow: hidden; background-position: 50% 50%; background-size: cover;  text-align: center; margin-right: 0">
          <img src=<?= (empty($row["image_pathname"])) ? "./../img/default_picture.png" : "./../img/uploads/".$row["image_pathname"]?> id="member_picture" alt="" style="height: 100%; width: 100%; object-fit: cover;">
        </div>
        <div style="height: 25px;"></div>
        <h5 class="card-title"><?= $fn." ".$ln ?></h5>
        <small>Registered last <?= date("M d, Y", strtotime($row["date_registered"])) ?></small>
        <div style="height: 20px"></div>
        <h6>Monthly Subscription: 
        <?php 
        if($today >= $row["monthly_start"] && $today <= $row["monthly_end"]) {
          $monthlyPaid = true;
          echo "<span class='text-success'>Paid</span>";
        } else {
          $monthlyPaid = false;
          echo "<span class='text-danger'>Due</span>";
        }
        ?></h6>
        <small>
        <?php 
          if(!empty($row["monthly_end"])) {
            echo ($monthlyPaid) ? "Expires" : "Expired" ?> on <?= date("M d, Y", strtotime($row["monthly_end"]));
          } else {
            echo "No payment for Monthly Subscription yet";
          }
        ?></small>
        <h6>Annual Membership: 
        <?php 
        if($today >= $row["annual_start"] && $today <= $row["annual_end"]) {
          $annualPaid = true;
          echo "<span class='text-success'>Paid</span>";
        } else {
          $annualPaid = false;
          echo "<span class='text-danger'>Due</span>";
        }
        ?></h6>
        <small>
        <?php 
          if(!empty($row["annual_end"])) {
            echo ($monthlyPaid) ? "Expires" : "Expired" ?> on <?= date("M d, Y", strtotime($row["annual_end"]));
          } else {
            echo "No payment for Annual Membership yet";
          }
        ?>
        </small>
        <div style="height: 50px"></div>
        <h6 class="card-text">
        <?php 
        if($monthlyPaid && $annualPaid) {
          if(isset($_SESSION["admin_id"])) {
            $adminId = $_SESSION["admin_id"];
            $dateNow = date("Y-m-d H:i:s");
            $sql = "INSERT INTO member_logtrail (member_id, login_date, scanned_by)
                    VALUES ($id, '$dateNow', $adminId)";
            $res = mysqli_query($con, $sql);
          }
          
          echo "$fn $ln is eligible to enter the gym.";
        } else if(!$monthlyPaid && $annualPaid) {
          if(!empty($row["monthly_start"])) {
            if($today > $row["monthly_end"]) {
              $earlier = new DateTime($row["monthly_end"]);
              $later = new DateTime($today);
  
              $diff = $later->diff($earlier)->format("%a");
              
              if($diff > 7) {
                echo "$fn $ln is not eligible to enter the gym. Please pay monthly subscription first.";
              } else {
                $earlier = new DateTime($today);
                $later = new DateTime(date("Y-m-d", strtotime($row["monthly_end"]. " + 7 days")));

                $diff = $later->diff($earlier)->format("%a");
                echo "$fn $ln can enter the gym. $fn only has $diff day(s) left to pay for his/her monthly subscription.";

                if(isset($_SESSION["admin_id"])) {
                  $adminId = $_SESSION["admin_id"];
                  $dateNow = date("Y-m-d H:i:s");
                  $sql = "INSERT INTO member_logtrail (member_id, login_date, scanned_by)
                          VALUES ($id, '$dateNow', $adminId)";
                  $res = mysqli_query($con, $sql);
                }                
              }
            } 
          } else {
            echo "$fn $ln is not eligible to enter the gym. Please pay monthly subscription first.";
          }
        } else {
          echo "$fn $ln is not eligible to enter the gym. Please pay membership fee first then pay monthly subscription.";
        }
        ?>
        </h6>
      </div>
      <div class="card-footer text-muted">
        
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
  <script>
    if("<?= (isset($_SESSION["admin_id"])) ? $_SESSION["admin_id"] : "" ?>" === "") {
      $.confirm({
        content: 'You are not logged in'
      });
    }
  </script>
</body>
</html>