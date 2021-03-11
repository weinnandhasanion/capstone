<?php 
require "./../functions/connect.php";
session_start();

if(!isset($_SESSION["member_id"])) {
  header("Location: ./../../index.php");
}

$sql = "SELECT member.program_id, program.program_name FROM member
        INNER JOIN program ON member.program_id = program.program_id
        WHERE member_id = '".$_SESSION["member_id"]."'";
$res = mysqli_query($con, $sql);
if($res) {
  $row = mysqli_fetch_assoc($res);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile Page</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="./../css/profile.css">
  <link rel="stylesheet" href="./../css/sidebar.css">
  <link rel="stylesheet" href="./../css/mediaquery.css">
  <link rel="icon" href="./../img/gym_logo.png">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <style>
    .sub-cont {
      width: 100%;
      margin-top: 40px;
    }

    .modal-footer-btn {
      display: flex;
      justify-content: center;
      padding: 20px 20px 0 20px;
      width: 80%;
    }

    .modal-footer-btn a {
      width: 100%;
    }

    .main-cont {
      min-width: 100vw;
      min-height: 80vh;
      word-wrap: break-word;
      overflow-wrap: break-word;

    }

    .main-cont div {
      word-wrap: break-word;
      overflow-wrap: break-word;
    }

    .change-program-div {
      margin-top: 30px;
      display: flex;
      justify-content: center;
      flex-direction: column;
    }

    select {
      padding: 5px;
      border-radius: 5px;
      font-size: 24px;
    }
  </style>
</head>
<body>
  <div class="sidebar" id="sidebar">
    <div>
      <i class="material-icons v-hidden" style="font-size: 32px" id="back">keyboard_backspace</i>
      <img src="./../../logo.png" style="width: 32px; height: 32px; margin-left: 70px" alt="">
    </div>    <div class="items">
      <a href="#">
        <span class="active">
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
      <a href="./tutorial.php">
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
      <a href="./program.php"><i class="material-icons">keyboard_backspace</i></a>
      <h2>Change program</h2>
    </div>
    <div class="main-cont">
      <div class="change-program-div">
        <label>Choose program</label>
        <select id="select-program">
        <?php
          $sql = "SELECT program_id, program_name
                  FROM program 
                  WHERE program_status = 'active'";
          $res = mysqli_query($con, $sql);
          if($res) {
            while($row = mysqli_fetch_assoc($res)) {
          ?>
          <option value="<?php echo $row["program_id"] ?>"><?php echo $row["program_name"] ?></option>
          <?php
            }
          }
          ?>
        </select>
      </div>
      <button class="btn btn-reg btn-sm" id="update-program">Update program</button>
      <small id="response" style="display: none"></small>
    </div>
  </main>

  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <script>
    $("#update-program").click(function() {
      $.post("./../functions/edit_program.php", {id: $("#select-program").val()}, function(res) {
        if(res == 1) {
          $("#response").addClass("text-green").text("Successfully changed program!").css("display", "block");
        } else {
          $("#response").addClass("text-red").text("Updating program failed.").css("display", "block");
        }
      });
    })
  </script>
</body>
</html>