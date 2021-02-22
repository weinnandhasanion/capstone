<?php 
require "./../functions/connect.php";
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tutorials Page</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="./../css/default.css">
  <link rel="icon" href="./../img/gym_logo.png">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <style>
    .tutorial-content {
      margin-top: 10vh;
    }

    .cont {
      display: flex;
      flex-direction: column;
      margin-bottom: 20px;
    }

    a {
      text-decoration: underline;
      font-size: 18px;
    }
  </style>
</head>
<body>
  <!-- Logout confirmation modal -->
  <div class="modal" id="logout-modal">
    <div class="modal-sm">
      <p class="fw-600">Are you sure you want to logout?</p>
      <div style="height: 50px"></div>
      <div class="modal-footer">
        <a href="#" id="confirm-logout" class="text-red fw-600">Logout</a>
        <a href="#" id="cancel-logout">Cancel</a>
      </div>
    </div>
  </div>
  <div class="sidebar" id="sidebar">
    <i class="material-icons" style="font-size: 32px" id="back">keyboard_backspace</i>
    <div class="items">
      <a href="./profile.php">
        <span>
          <i class="material-icons">account_circle</i>
          <h2>Profile</h2>
        </span>
      </a>
      <a href="./pay.php">
        <span>
          <i class="material-icons">payment</i>
          <h2>Pay</h2>
        </span>
      </a>
      <a href="./promos.php">
        <span>
          <i class="material-icons">shopping_cart</i>
          <h2>Promos</h2>
        </span>
      </a>
      <a href="./payment_history.php">
        <span>
          <i class="material-icons">history</i>
          <h2>Payment History</h2>
        </span>
      </a>
      <a href="./program.php">
        <span>
          <i class="material-icons">settings</i>
          <h2>Program</h2>
        </span>
      </a>
      <a href="./notifications.php">
        <span>
          <i class="material-icons">notifications_active</i>
          <h2>Notifications</h2>
        </span>
      </a>
      <a href="#" class="active">
        <span>
          <i class="material-icons">slow_motion_video</i>
          <h2>Tutorials</h2>
        </span>
      </a>
    </div>
    <div class="logout">
      <button class="btn btn-red" style="width: 80%" id="logout-btn">Logout</button>
    </div>
  </div>
  <main>
    <div class="menu">
      <i class="material-icons" style="font-size: 32px;" id="menu">menu</i>
      <h2>Tutorials</h2>
    </div>
    <div class="icon-div">
      <div class="icon-cont">
        <i class="material-icons">slow_motion_video</i>
      </div>
    </div>
    <div class="main-cont">
      <div class="tutorial-content">
        <div class="cont">
          <h2>Upper Body Workouts</h2>
          <?php 
          $sql = "SELECT * FROM routines WHERE routine_type = 'Upper Body'";
          $res = mysqli_query($con, $sql);
          if($res) {
            while($row = mysqli_fetch_assoc($res)) {
          ?>
          <a href="<?= $row["routine_link"] ?>"><?= $row["routine_name"] ?></a>
          <?php
            }
          }
          ?>
        </div>
        <div class="cont">
          <h2>Lower Body Workouts</h2>
          <?php 
          $sql = "SELECT * FROM routines WHERE routine_type = 'Lower Body'";
          $res = mysqli_query($con, $sql);
          if($res) {
            while($row = mysqli_fetch_assoc($res)) {
          ?>
          <a href="<?= $row["routine_link"] ?>"><?= $row["routine_name"] ?></a>
          <?php
            }
          }
          ?>
        </div>
        <div class="cont">
          <h2>Abdominals</h2>
          <?php 
          $sql = "SELECT * FROM routines WHERE routine_type = 'Abdominal'";
          $res = mysqli_query($con, $sql);
          if($res) {
            
            while($row = mysqli_fetch_assoc($res)) {
          ?>
          <a href="<?= $row["routine_link"] ?>"><?= $row["routine_name"] ?></a>
          <?php
            }
          }
          ?>
        </div>
      </div>
    </div>
  </main>

  <script src="./../js/sidebar.js"></script>
  <script>
    window.onload = () => {

    }
  </script>
</body>
</html>