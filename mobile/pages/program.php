<?php 
require "./../functions/connect.php";
session_start();
if(!isset($_SESSION["member_id"])) {
  header("Location: ./../../index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Program Page</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="./../css/default.css">
  <link rel="stylesheet" href="./../css/mediaquery.css">
  <link rel="icon" href="./../img/gym_logo.png">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <style>
    .main-cont {
      padding: 0 !important;
    }

    table {
      border: 1px solid black;
      border-collapse: collapse;
      width: 95%;
    }

    th, td {
      border: 1px solid black;
      padding: 3px;
    }

    .content button {
      max-width: 250px;
    }

    .content > select {
      padding: 5px;
      border-radius: 5px;
      font-size: 16px;
      margin-bottom: 10px;
    }
  </style>
</head>
<body>
  <div class="full-page-loader" id="loader">
    <div class="loader"></div>
  </div>
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
    <div>
      <i class="material-icons v-hidden" style="font-size: 32px" id="back">keyboard_backspace</i>
      <img src="./../../logo.png" style="width: 32px; height: 32px; margin-left: 70px" alt="">
    </div>    <div class="items">
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
      <a href="#" class="active">
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
      <i class="material-icons d-none" style="font-size: 32px;" id="menu">menu</i>
      <h2>Program</h2>
    </div>
    <div class="icon-div">
      <div class="icon-cont">
        <i class="material-icons">settings</i>
      </div>
    </div>
    <div class="main-cont">
      <div class="content">
        <small>You are currently under the</small>
        <div style="display: flex">
          <h2 style="font-size: 1.8em" id="program-name"></h2>
        </div>
        <hr style="width: 80vw;">
        <select id="programDay">
          <option value="1">Day 1</option>
          <option value="2">Day 2</option>
          <option value="3">Day 3</option>
        </select>
        <h3 class="text-green">Upper Body</h3>
        <p id="upper1">Bent-over row &#183; 3 sets &#183; 15 reps</p>
        <p id="upper2">Bent-over row &#183; 3 sets &#183; 15 reps</p>
        <p id="upper3">Bent-over row &#183; 3 sets &#183; 15 reps</p>
        <h3 class="text-green">Lower Body</h3>
        <p id="lower1">Bent-over row &#183; 3 sets &#183; 15 reps</p>
        <p id="lower2">Bent-over row &#183; 3 sets &#183; 15 reps</p>
        <p id="lower3">Bent-over row &#183; 3 sets &#183; 15 reps</p>
        <h3 class="text-green">Abdominals</h3>
        <p id="abdominal">Bent-over row &#183; 3 sets &#183; 15 reps</p>
        <hr style="width: 80vw;">
        <button class="btn" id="change-program">Change your program</button>
      </div>
    </div>
  </main>

  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <script src="./../js/sidebar.js"></script>
  <script>
    var program, routines;

    $.get("./../functions/get_programs.php?day=1", function(res) {
      program = JSON.parse(res);

      $("#program-name").text(`${program.program_name} Program`);
    });

    $.get("./../functions/get_routines.php", function(res) {
      routines = JSON.parse(res);
      routines.unshift("");
    }).then(() => {
      $("#upper1").html(`${routines[program.upper_1_day_1].routine_name} &#183; ${routines[program.upper_1_day_1].routine_reps} reps &#183; ${routines[program.upper_1_day_1].routine_sets} sets`);
      $("#upper2").html(`${routines[program.upper_2_day_1].routine_name} &#183; ${routines[program.upper_2_day_1].routine_reps} reps &#183; ${routines[program.upper_2_day_1].routine_sets} sets`);
      $("#upper3").html(`${routines[program.upper_3_day_1].routine_name} &#183; ${routines[program.upper_3_day_1].routine_reps} reps &#183; ${routines[program.upper_3_day_1].routine_sets} sets`);
      $("#lower1").html(`${routines[program.lower_1_day_1].routine_name} &#183; ${routines[program.lower_1_day_1].routine_reps} reps &#183; ${routines[program.lower_1_day_1].routine_sets} sets`);
      $("#lower2").html(`${routines[program.lower_2_day_1].routine_name} &#183; ${routines[program.lower_2_day_1].routine_reps} reps &#183; ${routines[program.lower_2_day_1].routine_sets} sets`);
      $("#lower3").html(`${routines[program.lower_3_day_1].routine_name} &#183; ${routines[program.lower_3_day_1].routine_reps} reps &#183; ${routines[program.lower_3_day_1].routine_sets} sets`);
      $("#abdominal").html(`${routines[program.abdominal_day_1].routine_name} &#183; ${routines[program.abdominal_day_1].routine_reps} reps &#183; ${routines[program.abdominal_day_1].routine_sets} set(s)`);

      $("#loader").css("display", "none");
    });

    $("#programDay").change(function() {
      let val = $("#programDay").val();
      if(val == "1") {
        $("#upper1").html(`${routines[program.upper_1_day_1].routine_name} &#183; ${routines[program.upper_1_day_1].routine_reps} reps &#183; ${routines[program.upper_1_day_1].routine_sets} sets`);
        $("#upper2").html(`${routines[program.upper_2_day_1].routine_name} &#183; ${routines[program.upper_2_day_1].routine_reps} reps &#183; ${routines[program.upper_2_day_1].routine_sets} sets`);
        $("#upper3").html(`${routines[program.upper_3_day_1].routine_name} &#183; ${routines[program.upper_3_day_1].routine_reps} reps &#183; ${routines[program.upper_3_day_1].routine_sets} sets`);
        $("#lower1").html(`${routines[program.lower_1_day_1].routine_name} &#183; ${routines[program.lower_1_day_1].routine_reps} reps &#183; ${routines[program.lower_1_day_1].routine_sets} sets`);
        $("#lower2").html(`${routines[program.lower_2_day_1].routine_name} &#183; ${routines[program.lower_2_day_1].routine_reps} reps &#183; ${routines[program.lower_2_day_1].routine_sets} sets`);
        $("#lower3").html(`${routines[program.lower_3_day_1].routine_name} &#183; ${routines[program.lower_3_day_1].routine_reps} reps &#183; ${routines[program.lower_3_day_1].routine_sets} sets`);
        $("#abdominal").html(`${routines[program.abdominal_day_1].routine_name} &#183; ${routines[program.abdominal_day_1].routine_reps} reps &#183; ${routines[program.abdominal_day_1].routine_sets} set(s)`);
      } else if(val == "2") {
        $("#upper1").html(`${routines[program.upper_1_day_2].routine_name} &#183; ${routines[program.upper_1_day_2].routine_reps} reps &#183; ${routines[program.upper_1_day_2].routine_sets} sets`);
        $("#upper2").html(`${routines[program.upper_2_day_2].routine_name} &#183; ${routines[program.upper_2_day_2].routine_reps} reps &#183; ${routines[program.upper_2_day_2].routine_sets} sets`);
        $("#upper3").html(`${routines[program.upper_3_day_2].routine_name} &#183; ${routines[program.upper_3_day_2].routine_reps} reps &#183; ${routines[program.upper_3_day_2].routine_sets} sets`);
        $("#lower1").html(`${routines[program.lower_1_day_2].routine_name} &#183; ${routines[program.lower_1_day_2].routine_reps} reps &#183; ${routines[program.lower_1_day_2].routine_sets} sets`);
        $("#lower2").html(`${routines[program.lower_2_day_2].routine_name} &#183; ${routines[program.lower_2_day_2].routine_reps} reps &#183; ${routines[program.lower_2_day_2].routine_sets} sets`);
        $("#lower3").html(`${routines[program.lower_3_day_2].routine_name} &#183; ${routines[program.lower_3_day_2].routine_reps} reps &#183; ${routines[program.lower_3_day_2].routine_sets} sets`);
        $("#abdominal").html(`${routines[program.abdominal_day_2].routine_name} &#183; ${routines[program.abdominal_day_2].routine_reps} reps &#183; ${routines[program.abdominal_day_2].routine_sets} set(s)`);
      } else {
        $("#upper1").html(`${routines[program.upper_1_day_3].routine_name} &#183; ${routines[program.upper_1_day_3].routine_reps} reps &#183; ${routines[program.upper_1_day_3].routine_sets} sets`);
        $("#upper2").html(`${routines[program.upper_2_day_3].routine_name} &#183; ${routines[program.upper_2_day_3].routine_reps} reps &#183; ${routines[program.upper_2_day_3].routine_sets} sets`);
        $("#upper3").html(`${routines[program.upper_3_day_3].routine_name} &#183; ${routines[program.upper_3_day_3].routine_reps} reps &#183; ${routines[program.upper_3_day_3].routine_sets} sets`);
        $("#lower1").html(`${routines[program.lower_1_day_3].routine_name} &#183; ${routines[program.lower_1_day_3].routine_reps} reps &#183; ${routines[program.lower_1_day_3].routine_sets} sets`);
        $("#lower2").html(`${routines[program.lower_2_day_3].routine_name} &#183; ${routines[program.lower_2_day_3].routine_reps} reps &#183; ${routines[program.lower_2_day_3].routine_sets} sets`);
        $("#lower3").html(`${routines[program.lower_3_day_3].routine_name} &#183; ${routines[program.lower_3_day_3].routine_reps} reps &#183; ${routines[program.lower_3_day_3].routine_sets} sets`);
        $("#abdominal").html(`${routines[program.abdominal_day_3].routine_name} &#183; ${routines[program.abdominal_day_3].routine_reps} reps &#183; ${routines[program.abdominal_day_3].routine_sets} set(s)`);
      }
    });

    $("#confirm-logout").on("click", function() {
      $.ajax({
        url: "./../functions/logout_process.php",
        type: "json",
        method: "post",
        success: function() {
          window.location.reload();
        }
      });
    });

    $("#change-program").click(function() {
      window.location.href = "./change_program.php";
    });
  </script>
</body>
</html>