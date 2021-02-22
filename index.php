<?php
  require "./mobile/functions/connect.php";
  session_start();

  if(isset($_SESSION["member_id"])) {
    header("Location: ./mobile/pages/profile.php");
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="./mobile/css/style.css">
  <link rel="icon" href="./mobile/img/gym_logo.png">
  <title>California Fitness Gym - Members</title>

  <style>
    .modal-sm .form-field .form-input:focus {
      border-bottom: 2px solid;
      outline: none !important;
      color: #2c2c2c;
    }

    .modal-sm .form-field .form-input:focus + label {
      font-weight: 700;
      color: #2c2c2c;
    }

    .form-field {
      width: 80vw;
    }

    input {
      border-radius: 0 !important;
    }
  </style>
</head>
<body>
  <div class="full-page-loader" id="loader">
    <div class="loader"></div>
  </div>
  <div class="modal" id="admin-pass-modal">
    <div class="modal-sm">
      <div class="form-field">
        <input class="form-input" type="password" name="admin-pass" id="admin-pass">
        <label for="admin-pass">Enter security code</label>
      </div>
      <button class="btn" style="width: 50%; margin-bottom: 0" id="submit-admin-pass">Enter</button>
      <small class="text-red" id="admin-error" style="display: none">Invalid security code.</small>
    </div>
  </div>
  <main>
    <div class="logo">
      <img src="./mobile/img/gym_logo.png" alt="gym-logo">
      <p>California Fitness Gym</p>
    </div>
    <div class="sign-in">
      <div class="form-field">
        <input class="form-input" type="text" name="username" id="username">
        <label for="username">Username</label>
      </div>
      <div class="form-field">
        <input class="form-input" type="password" name="password" id="password">
        <label for="password">Password</label>
      </div>
      <small id="error-msg" style="text-align: center"></small>
      <button class="btn" id="login" type="submit">Login</button>
    </div>
    <a href="#" id="is-admin">Are you an admin? Click here</a>
  </main>

  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <script>
    window.addEventListener("load", function() {
      $("#loader").css("display", "none");
      $("#login").on("click", function() {
        let user = $("#username").val();
        let pass = $("#password").val();
        $("#error-msg").text("");

        $.ajax({
          method: 'post',
          url: './mobile/functions/login_process.php',
          data: {
            user: user,
            pass: pass
          },
          success: function(res) {
            if(res == 0) {
              $("#error-msg").text("Invalid username or password");
            } else if(res == 2) {
              $("#error-msg").html("You should be a regular member <br> in order to access your account");
            } else {
              window.location.reload();
            }
          },
        });
      });

      $("#is-admin").click(function() {
        $("#admin-pass-modal").css("display", "flex");
      });

      $("#submit-admin-pass").click(function() {
        let pass = $("#admin-pass").val();
        $.get("./check_admin_pass.php?pass=" + pass, function(data) {
          console.log(data);
          if(data == 1) {
            window.location.href = "./index_admin.php";
          } else {
            $("#admin-error").css("display", "block");
          }
        });
      });
    });
  </script>
</body>
</html>