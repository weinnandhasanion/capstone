<?php 
  require "./../functions/connect.php";
  session_start();

  if(!isset($_SESSION["member_id"])) {
    header("Location: ./pages/index.php");
  }

  $sql = "SELECT * FROM member WHERE member_id = '". $_SESSION["member_id"] ."'";
  $result = mysqli_query($con, $sql);

  $row = mysqli_fetch_assoc($result);

  if(isset($_POST["user"])) {
    if($_POST["user"] == $row["username"]) {
      echo 1;
      exit();
    } else {
      $query = "SELECT * FROM member WHERE username = '". $_POST["user"] ."'";
      $res = mysqli_query($con, $query);
      if(mysqli_num_rows($res) > 0) {
        echo 0;
        exit();
      } else {
        echo 1;
        exit();
      }
    }
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

    .change-profile-div {
      margin-top: 5px;
      margin-bottom: 10px;
      position: relative;
      display: flex;
      cursor: pointer;
    }

    .img-cont {
      height: 100px !important;
      width: 100px !important;
      border: none !important;
      object-fit: cover !important;
      overflow: hidden !important;
      border-radius: 100%;
      display: flex;
      justify-content: center;
    }

    .img-cont img {
      height: 100px;
      min-height: 100%;
      min-width: 100%;
      object-fit: cover;
    }

    .profile-mask {
      clip-path: circle(50.0% at 50% 50%);
      height: 100px;
      width: 100px;
      position: absolute;
      border-radius: 50%;
      top: 0;
      background-color: rgba(0,0,0,0.3);
      display: flex;
      justify-content: center;
      align-items: center;
      color: rgba(255,255,255,0.7);
      flex-direction: column;
      text-align: center;
      padding: 5px;
    }

    .profile-mask i {
      font-size: 30px;
    }

    .field-value {
      display: flex;
      align-items: center;
      min-width: 0;
      word-break: break-all;
      word-wrap: break-word;
      overflow-wrap: break-word;
    }

    .edit-field p {
      margin-top: 5px;
    }

    .field-value small {
      margin-left: 5px;
    }

    .form-field .form-input {
      font-size: 18px;
    }

    .form-field .form-input:focus {
      border-bottom: 2px solid #2c2c2c;
      outline: none !important;
      color: #2c2c2c;
    }

    .form-field .form-input:focus + label {
      color: #2c2c2c;
      font-weight: 700;
    }

    #email-edit, #phone-edit, #birthdate-edit, #address-edit, #username-edit, #change-user-pass {
      display: none;
    }

    #save-changes-btn {
      margin: 10px 0 0 0  !important;
    }

    .change-pass-div {
      margin-top: 5px;
    }

    .form-field .form-input {
      width: 50%;
    }

    .mb-5 {
      margin-bottom: 10px;
    }
  </style>
</head>
<body>
  <div class="sidebar" id="sidebar">
    <div>
      <i class="material-icons v-hidden" style="font-size: 32px" id="back">keyboard_backspace</i>
      <img src="./../../logo.png" style="width: 32px; height: 32px; margin-left: 70px" alt="">
    </div>
    <div class="items">
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
      <a href="./profile.php"><i class="material-icons">keyboard_backspace</i></a>
      <h2>Edit profile</h2>
    </div>
    <div class="main-cont">
      <div id="edit-details">
        <button class="btn" id="change-user-pass-btn">Change password</button>
        <div class="change-profile-div">
          <div class="img-cont">
            <?php 
            if(empty($row["image_pathname"])) {
            ?>
            <img src="./../img/default_picture.png" alt="profile_pic">
            <?php
            } else {
            ?> 
            <img src="./../img/uploads/<?php echo $row["image_pathname"] ?>" alt="profile_pic">
            <?php
            }
            ?>
          </div>
          <div class="profile-mask" id="change-photo">
            <i class="material-icons">add</i>
            <small>Click to change photo</small>
          </div>
        </div>
        <div class="edit-field">
          <div class="mb-5">
            <p>Username:</p>
            <div class="field-value">
              <p class="fw-500" id="username-default"><?php echo $row["username"] ?></p>
              <input type="text" id="username-edit" class="edit">
            </div>
            <small class="text-red" style="display: none" id="invalid-username">Invalid username</small>
          </div>
          <div class="mb-5">
            <p>Email:</p>
            <div class="field-value">
              <p class="fw-500" id="email-default"><?php echo $row["email"] ?></p>
              <input type="text" id="email-edit" class="edit">
            </div>
            <small class="text-red" style="display: none" id="invalid-email">Invalid email</small>
          </div>
          <div class="mb-5">
            <p>Phone:</p>
            <div class="field-value">
              <p class="fw-500" id="phone-default"><?php echo $row["phone"] ?></p>
              <input type="text" id="phone-edit" class="edit">
            </div>
            <small class="text-red" style="display: none" id="invalid-phone">Invalid phone number</small>
          </div>
          <div class="mb-5">
            <p>Birthdate:</p>
            <div class="field-value">
              <p class="fw-500" id="birthdate-default">
                <?php 
                  $date = date_create($row["birthdate"]);
                  echo date_format($date, "F d, Y"); 
                ?>
              </p>
              <input type="date" id="birthdate-edit" class="edit">
            </div>
            <small class="text-red" style="display: none" id="invalid-birthdate">Invalid birthdate</small>
          </div>
          <div class="mb-5">
            <p>Address:</p>
            <div class="field-value">
              <p class="fw-500" id="address-default"><?php echo $row["address"] ?></p>
              <input type="text" id="address-edit" class="edit">
            </div>
            <small class="text-red" style="display: none" id="invalid-address">Invalid address</small>
          </div>
        </div>
        <small class="text-disabled"><i>NOTE: Click on values to edit</i></small>
        <br>
        <button class="btn btn-reg btn-disabled edit-details-btn" id="save-changes-btn" disabled>Save changes</button>
        <br>
        <small class="text-green" style="display: none" id="change-success">Profile updated successfully</small>
        <br>
        <small class="text-red" style="display: none" id="change-error">Failed to update profile</small>
      </div>
      <div id="change-user-pass">
        <button class="btn" id="edit-details-btn">Edit profile details</button>
        <div class="change-pass-div">
          <div class="form-field">
            <input type="password" name="" id="current-password" class="form-input">
            <label for="">Current password</label>
            <small class="text-red" id="wrong-password"></small>
            <input type="password" name="" id="new-password" class="form-input">
            <label for="">New password</label>
            <small class="text-red" id="error-msg"></small>
            <input type="password" name="" id="confirm-password" class="form-input">
            <label for="">Confirm password</label>
            <small class="text-red" id="confirm-error-msg"></small>
          </div>
        </div>
        <button class="btn btn-reg btn-disabled pass-btn" id="pass-btn">Save password</button>
        <br>
        <small class="text-green" style="display: none" id="success-msg">Password successfully changed</small>
        <small class="text-red" style="display: none" id="failed-msg">Password change failed</small>
      </div>
    </div>
  </main>

  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <script>
    $(document).ready(function() {
      var user = $("#username-default").text();
      var email = $("#email-default").text();
      var phone = $("#phone-default").text();
      var bdate = $("#birthdate-default").text();
      var d = new Date(bdate);
      var day = ("0" + d.getDate()).slice(-2);
      var month = ("0" + (d.getMonth() + 1)).slice(-2);
      var newBdate = `${d.getFullYear()}-${month}-${day}`;
      var address = $("#address-default").text();

      $("#username-edit").val(user);
      $("#email-edit").val(email);
      $("#phone-edit").val(phone);
      $("#birthdate-edit").val(newBdate);
      $("#address-edit").val(address);

      // Edit profile details
      $("#change-user-pass-btn").click(function() {
        $("#edit-details").hide();
        $("#change-user-pass").show();
      });

      $("#username-default").click(function() {
        var defaultVal = $("#username-default").text();

        $("#username-default").hide();
        $("#username-edit").show().focus();

        $("#username-edit").on("blur", function(evt) {
          var val = $("#username-edit").val();

          if($("#username-edit").val() == "" ) {
            $("#username-default").text(defaultVal).show();
            $("#username-edit").hide();
          } else {
            $("#username-default").text(val).show();
            $("#username-edit").hide();
          }
        });
      });

      $("#email-default").click(function() {
        var defaultVal = $("#email-default").text();

        $("#email-default").hide();
        $("#email-edit").show().focus();

        $("#email-edit").on("blur", function(evt) {
          var val = $("#email-edit").val();

          if($("#email-edit").val() == "" ) {
            $("#email-default").text(defaultVal).show();
            $("#email-edit").hide();
            $("#invalid-email").hide();
          } else {
            $("#email-default").text(val).show();
            $("#email-edit").hide();
          }
        });
      });

      $("#phone-default").click(function() {
        var defaultVal = $("#phone-default").text();

        $("#phone-default").hide();
        $("#phone-edit").show().focus();

        $("#phone-edit").on("blur", function(evt) {
          var val = $("#phone-edit").val();

          if($("#phone-edit").val() == "" ) {
            $("#phone-default").text(defaultVal).show();
            $("#phone-edit").hide();
          } else {
            $("#phone-default").text(val).show();
            $("#phone-edit").hide();
          }
        });
      });

      $("#birthdate-default").click(function() {
        const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

        var defaultVal = $("#birthdate-default").text();
        var d = new Date(defaultVal);
        var day = ("0" + d.getDate()).slice(-2);
        var month = ("0" + (d.getMonth() + 1)).slice(-2);
        var bdate = `${d.getFullYear()}-${month}-${day}`;

        $("#birthdate-default").hide();
        $("#birthdate-edit").val(bdate).show().focus();

        $("#birthdate-edit").on("blur", function(evt) {
          var val = $("#birthdate-edit").val();

          if($("#birthdate-edit").val() == "" ) {
            $("#birthdate-default").text(defaultVal).show();
            $("#birthdate-edit").hide();
          } else {
            var valDate = new Date(val);
            var fullTextDate = `${months[valDate.getMonth()]} ${("0" + valDate.getDate()).slice(-2)}, ${valDate.getFullYear()}`;
            $("#birthdate-default").text(fullTextDate).show();
            $("#birthdate-edit").hide();
          }
        });
      });

      $("#address-default").click(function() {
        var defaultVal = $("#address-default").text();

        $("#address-default").hide();
        $("#address-edit").show().focus();

        $("#address-edit").on("blur", function(evt) {
          var val = $("#address-edit").val();

          if($("#address-edit").val() == "" ) {
            $("#address-default").text(defaultVal).show();
            $("#address-edit").hide();
          } else {
            $("#address-default").text(val).show();
            $("#address-edit").hide();
          }
        });
      });

      $(".edit").on("change", function() {
        if($("#username-edit").val() != user || $("#email-edit").val() != email || $("#phone-edit").val() != phone || $("#birthdate-edit").val() != newBdate || $("#address-edit").val() != address) {
          $("#save-changes-btn").removeClass("btn-disabled").addClass("btn-red").removeAttr("disabled");
        } else if($("#username-edit").val() == user && $("#email-edit").val() == email && $("#phone-edit").val() == phone && $("#birthdate-edit").val() == newBdate && $("#address-edit").val() == address){
          $("#save-changes-btn").removeClass("btn-red").addClass("btn-disabled").attr("disabled", "disabled");
        }
      });

      $("#username-edit").on("change", function () {
        $("#invalid-username").hide();
      });

      $("#email-edit").on("change", function () {
        $("#invalid-email").hide();
      });

      $("#birthdate-edit").on("change", function () {
        $("#invalid-birthdate").hide();
      });

      $("#phone-edit").on("change", function () {
        $("#invalid-phone").hide();
      });

      function validateUsername(val) {
        var tmp;

        if(val.indexOf(' ') > 0) {
          tmp = {
            isValid: false,
            message: "Username must not contain whitespace"
          }
        } else {
          $.ajax({
            async: false,
            url: "./edit_profile.php",
            type: "json",
            method: "post",
            data: {
              user: val
            }, 
            success: function(res) {
              if(res == 0) {
                tmp = {
                  isValid: false,
                  message: "Username is already taken"
                }
              } else {
                tmp = {
                  isValid: true
                }
              }
            }
          });
        }

        return tmp;
      }

      function validateEmail(val) {
        var re = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
        return re.test(val);
      }

      function validatePhone(val) {
        var re = /^(09|\+639)\d{9}$/;
        return re.test(val);
      }

      function validateBirthdate(val) {
        var bdate = new Date(val);
        var byear = bdate.getFullYear();
        var bmonth = bdate.getMonth() + 1;
        var bday = bdate.getDate();
        var today = new Date();
        var res;
        
        if(bdate < today && (today.getFullYear() - byear) >= 15 && (today.getFullYear() - byear) <= 90) {
          res = true; 
        } else {
          res = false;
        }

        console.log(res);
        return res;
      }

      $("#save-changes-btn").click(function() {
        $("#change-success").hide();

        var usernameDef = $("#username-default").text();
        var usernameInvalid = $("#invalid-username");
        var emailDef = $("#email-default").text();
        var emailInvalid = $("#invalid-email");
        var phoneDef = $("#phone-default").text();
        var phoneInvalid = $("#invalid-phone");
        var birthdateDef = $("#birthdate-default").text();
        var birthdateInvalid = $("#invalid-birthdate");

        // validateUsername(usernameDef)

        // if(!validateUsername(usernameDef)) {
        //   usernameInvalid.show();
        // } else {
        //   usernameInvalid.hide();
        // }

        let valUser = validateUsername(usernameDef);
        if(!valUser.isValid) {
          usernameInvalid.text(valUser.message).show();
        } else {
          usernameInvalid.hide();
        }

        if(!validateEmail(emailDef)) {
          emailInvalid.show();
        } else {
          emailInvalid.hide();
        }

        if(!validatePhone(phoneDef)) {
          phoneInvalid.show();
        } else {
          phoneInvalid.hide();
        }

        if(!validateBirthdate(birthdateDef)) {
          birthdateInvalid.show();
        } else {
          birthdateInvalid.hide();
        }

        if(valUser.isValid && validateEmail(emailDef) && validatePhone(phoneDef) && validateBirthdate(birthdateDef)) {
          var d = new Date(birthdateDef.trim())
          var bdate = `${d.getFullYear()}-${d.getMonth() + 1}-${d.getDate()}`;

          $.ajax({
            url: "./../functions/edit_details.php",
            method: "post",
            data: {
              user: usernameDef,
              email: emailDef,
              phone: phoneDef,
              birthdate: bdate,
              address: $("#address-default").text()
            },
            success: function(res) {
              if(res == 1) {
                $("#change-success").show();
                $("#change-error").hide();
                $("#save-changes-btn").removeClass("btn-red").addClass("btn-disabled").attr("disabled", "disabled");

                user = usernameDef;
                email = emailDef;
                phone = phoneDef;
                newBdate = bdate;
                address = $("#address-default").text();
              } else {
                $("#change-success").hide();
                $("#change-error").show();
              }
            }
          });
        }
      });


      // Change password
      $("#edit-details-btn").click(function() {
        $("#edit-details").show();
        $("#change-user-pass").hide();
      });

      var currentDone = false;
      var newDone = false;
      var confirmDone = false;

      $("#current-password").on("keyup", function() {
        if(!$("#current-password").val() == "") {
          var password;
          $.ajax({
            url: "./../functions/get_password.php",
            method: "post",
            data: {
              pass: $("#current-password").val()
            },
            success: function(res) {
              if(res == 0) {
                // $("#current-password").val("");
                $("#wrong-password").text("Wrong password");
                currentDone = false;
                $("#pass-btn").removeClass("btn-red");
                $("#pass-btn").addClass("btn-disabled");
              } else {
                $("#wrong-password").text("");
                currentDone = true;
              }
            }
          });
        }
      });

      $("#new-password").on("keyup", function() {
        var newPass = $("#new-password").val();
        var error = $("#error-msg");
        if(!$("#new-password").val() == "") {
          if(newPass == $("#current-password").val()) {
            error.text("New password must not be the same as current password");
            newDone = false;
          } else if(newPass.length < 5) {
            error.text("Password must contain at least 5 characters");
            newDone = false;
          } else {
            error.text("");
            newDone = true;
          }
        }
      });

      $("#confirm-password").on("keyup", function() {
        var error = $("#confirm-error-msg");
        if($("#confirm-password").val() != $("#new-password").val()) {
          error.text("Passwords do not match")
          confirmDone = false;
        } else {
          error.text("");
          confirmDone = true;
        }
      });

      $(document).on("keyup", function() {
        if(currentDone && newDone && confirmDone) {
          $("#pass-btn").removeClass("btn-disabled");
          $("#pass-btn").addClass("btn-red");
        } else {
          $("#pass-btn").removeClass("btn-red");
          $("#pass-btn").addClass("btn-disabled");
        }
      });

      $("#pass-btn").click(function() {
        var pass = $("#confirm-password").val();

        $.ajax({
          url: "./../functions/change_password.php",
          method: "post",
          data: {
            pass: pass
          },
          success: function(res) {
            if(res == 1) {
              $("#success-msg").show();
            } else {
              $("#failed-msg").hide();
            }
          }
        });
      });     

      $("#change-photo").click(function() {
        window.location.href = "./change_photo.php";
      }); 
    });
  </script>
</body>
</html>