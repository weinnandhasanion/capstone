<?php 
  require "./../functions/connect.php";
  session_start();

  if(!isset($_SESSION["member_id"])) {
    header("Location: ./../index.php");
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile Page</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="./../css/default.css">
  <link rel="stylesheet" href="./../css/sidebar.css">
  <link rel="stylesheet" href="./../css/mediaquery.css">
  <link rel="icon" href="./../img/gym_logo.png">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
  <style>
    .main-cont {
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
    }

    form {
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
    }

    .main-cont .btn {
      margin: 5px !important;
      width: 60%;
    }

    form .btn {
      margin: 5px !important;
      width: 60%;
    }

    .icon-cont {
      height: 35vh !important;
      width: 35vh !important;
      border: none !important;
      object-fit: cover !important;
      overflow: hidden !important;
    }

    .icon-div img {
      height: 35vh;
      /* clip-path: circle(50.0% at 50% 50%); */
      min-height: 100%;
      min-width: 100%;
      object-fit: cover;
    }    

    input[type="file"] {
      visibility: hidden;
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
      <a href="./promos.php"><i class="material-icons">keyboard_backspace</i></a>
      <h2>Send Promo Request</h2>
    </div>
    <div class="icon-div">
      <div class="icon-cont" style="border-radius: 0; border: solid 1px rgb(77, 77, 77) !important">
        <img src="./../img/id_default.jpg"  alt="profile_pic" id="profile_pic">
      </div>
    </div>    
    <div class="main-cont">
        <button class="btn btn-reg btn-green" id="upload-photo">Upload ID</button>
        <input type="file" name="file" id="choose-file" onchange="readURL(this)">
        <button class="btn btn-disabled" type="submit" disabled="disabled" id="send-request">Send request</button>
        <small class="text-red" id="error" style="display: none">Please choose a proper file type (.jpeg, .png).</small>
    </div>
  </main>

  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
  <script>
    $(document).ready(function() {
      $("#upload-photo").click(function(e) {
        e.stopPropagation();
        $("#choose-file").click();
      });

      $("#remove-photo").click(function(e) {
        e.stopPropagation();
        $(".modal").css("display", "flex");
      })

      $("#cancel").click(function(e) {
        e.stopPropagation();
        $(".modal").css("display", "none");
      })
    });

    function readURL(input) {
      if(input.files && input.files[0]) {
        if(input.files[0].type.match('image.*')) {
          var reader = new FileReader();

          reader.onload = function(e) {
            $("#profile_pic").attr("src", reader.result);  
          }

          reader.readAsDataURL(input.files[0]);
          $("#error").css("display", "none");
          $("#send-request").removeAttr("disabled").removeClass("btn-disabled");
        } else {
          $("#error").css("display", "block");
        }
      }
    }

    $("#send-request").click(function () {
      var file_data = $('#choose-file').prop('files')[0];   
      var form_data = new FormData();                  
      form_data.append('file', file_data);
      form_data.append('promo_id', '<?= $_GET["id"] ?>');

      $.confirm({
        closeIcon: true,
        theme: 'material',
        boxWidth: '250px',
        useBootstrap: false,
        title: '',
        content: 'Are you sure?',
        buttons: {
          proceed: {
            btnClass: 'btn-red',
            action: function () {
              $.alert({
                theme: 'material',
                title: '',
                boxWidth: '250px',
                useBootstrap: false,
                backgroundDismiss: true,
                content: function () {
                  var self = this;
                  return $.ajax({
                    url: "./../functions/send_id.php",
                    cache: false,
                    contentType: false,
                    processData: false,
                    type: 'post',
                    data: form_data,
                    success: function (res) {
                      if(JSON.parse(res) == "success") {
                        self.setType('green');
                        self.setContent('Request successfully sent.');
                        self.setTitle('Success');
                        self.backgroundDismiss = false;
                        self.buttons.ok.show();
                      } else {
                        self.setType('red');
                        self.setTitle('Error');
                        self.setContent(JSON.parse(res));
                      }
                    }
                  });
                },
                buttons: {
                  ok: {
                    btnClass: 'btn-green',
                    isHidden: true,
                    action: function () {
                      window.location.href = './promos.php';
                    }
                  }
                }
              });
            }
          }
        }
      });
    });
  </script>
</body>
</html>