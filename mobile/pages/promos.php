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
  <title>Promo Page</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="./../css/default.css">
  <link rel="stylesheet" href="./../css/mediaquery.css">
  <link rel="icon" href="./../img/gym_logo.png">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">

  <style>
    .sub-cont {
      width: 100%;
      margin-top: 40px;
    }

    .modal-footer-btn {
      display: flex;
      justify-content: center;
      padding: 20px 20px 20px 20px;
      width: 100%;
    }

    .promo-div {
      text-align: center;
      width: 100%;
      margin-top: 20px;
    }

    .promo-list-div {
      text-align: left;
      margin-left: -40px;
      width: 100vw;
      padding: 15px;
      margin-top: 15px;
    }

    .promo-list-div button {
      font-size: 15px;
      max-width: 250px;
      margin: 0 !important;
      margin-top: 10px !important;
    }

    .no-promos-div {
      min-height: 40vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    @media screen and (min-width: 768px) {
      .promo-div {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
      }

      .promo-list-div {
        display: flex;
        border-radius: 10px;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        max-width: 468px;
        margin-left: 0;
        margin-bottom: 20px;
      }
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
      <a href="#">
        <span class="active">
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
      <i class="material-icons d-none" style="font-size: 32px;" id="menu">menu</i>
      <h2>Promos</h2>
    </div>
    <div class="icon-div">
      <div class="icon-cont">
        <i class="material-icons">shopping_cart</i>
      </div>
    </div>
    <div class="main-cont">
      <div class="content">
        <small>You are currently subscribed to</small>
        <span style="display: flex; align-items: center;">
          <?php 
          $sql = "SELECT MP.*, P.promo_name, P.promo_type, P.amount 
                  FROM memberpromos AS MP 
                  INNER JOIN promo AS P ON MP.promo_id = P.promo_id 
                  WHERE MP.member_id = '".$_SESSION["member_id"]."' AND MP.status = 'Active'"; 
          $res = mysqli_query($con, $sql);
          if(mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
          
          ?>
          <h1 class="text-green" id="availed-promo" style="text-decoration: underline">
            <?php echo $row["promo_name"] ?>
          </h1>
          <?php
          } else {
          ?>
          <h1 id="availed-promo">N/A</h1>
          <?php
          }
          ?>
        </span>
        <div class="promo-div">
          <h3>Available promos</h3>
          <?php 
          $sql = "SELECT * FROM promo WHERE status = 'Active' ORDER BY promo_starting_date ASC";
          $res = mysqli_query($con, $sql);

          if(mysqli_num_rows($res)) {
            while($row = mysqli_fetch_assoc($res)):
          ?>
          <div class="promo-list-div text-primary shadow-1">
            <h3><?php echo $row["promo_name"] ?></h3>
            <p><strong><?= $row["promo_type"] ?> &#x00B7 P<?php echo $row["amount"] ?> off </strong> 
            <?php 
            if($row["promo_type"] == "Seasonal") {
              $startDate = date("M d", strtotime($row["promo_starting_date"]));
              $endDate = date("M d", strtotime($row["promo_ending_date"]));
            ?>
            <br>
            <?= $startDate ?> - <?= $endDate ?>
            <?php
            } else {
              echo "";
            }
            ?>
            </p>
            <button class="btn btn-reg btn-red" data-id="<?php echo $row["promo_id"] ?>" data-name="<?= $row["promo_name"] ?>" onclick="showPromo(this)">View promo details</button>
          </div>
          <?php
            endwhile;
          } else {
          ?>
          <div class="no-promos-div text-disabled">
            There are no promos available as of the moment.
          </div>
          <?php
          }
          ?>
        </div>
      </div>
    </div>
  </main>

  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
  <script src="./../js/sidebar.js"></script>
  <script>
    window.onload = () => {
      showPromo = (elem) => {
        let id = elem.getAttribute('data-id');
        let name = elem.getAttribute('data-name');

        $.confirm({
          backgroundDismiss: true,
          theme: 'modern',
          useBootstrap: false,
          boxWidth: '325px',
          buttons: {
            avail: {
              text: 'avail promo',
              btnClass: 'btn-red',
              action: function () {
                availPromo(id, name);
              }
            }
          },
          content: function () {
            var self = this;
            return $.get("./../functions/promo_details.php?id=" + id, function(res) {
              let data = JSON.parse(res);

              self.setTitle(data.promo_name);

              if(data.active == "true") {
                self.buttons.avail.disable();
                self.buttons.avail.addClass('btn-disabled');
                self.buttons.avail.removeClass('btn-red');
              }

              if(data.promo_type == "Permanent") {
                self.setContent(`
                <h4 class="fw-400">${data.promo_type}</h4>
                <hr>
                <p>${data.promo_description}</p>
                `);
              } else {
                self.setContent(`
                <h4 class="fw-400">${data.promo_type}</h4>
                ${data.promo_starting_date} - ${data.promo_ending_date}</h4>
                <hr>
                <p>${data.promo_description}</p>
                `);
              }
            });
          }
        });
      }

      availPromo = (id, name) => {
        $.confirm({
          theme: 'material',
          boxWidth: '250px',
          useBootstrap: false,
          title: '',
          content: function () {
            var self = this;
            return $.get("./../functions/check_if_has_promo.php", function (res) {
              if(JSON.parse(res) == "true") {
                self.setBoxWidth('325px');
                self.setContent("You have an existing promo. If you avail this promo, you will lose your current promo and will have to re-avail should you wish to avail it again next time. Proceed?");
              } else if(JSON.parse(res) == "false") {
                self.close();
                $.alert({
                  theme: 'material',
                  boxWidth: '250px',
                  useBootstrap: false,
                  title: 'Error',
                  backgroundDismiss: true,
                  buttons: {
                    ok: {
                      isHidden: true,
                      btnClass: 'btn-green'
                    }
                  },
                  content: function () {
                    var self = this;

                    return $.post("./../functions/avail_promo.php", {id: id}, function (res) {
                      if(res == 1) {
                        self.setContent('Promo has not yet started!');
                      } else if(res == 2) {
                        self.setContent('Promo has already ended!');
                      } else if(res == 3) {
                        self.setContent('You have already availed this promo!');
                      } else {
                        self.backgroundDismiss = false;
                        self.buttons.ok.show();
                        self.buttons.ok.setText('close');
                        self.buttons.ok.action = function () {
                          $("#availed-promo").addClass("text-green");
                          $("#availed-promo").css("text-decoration", "underline");
                          $("#availed-promo").text(res);                        
                        }
                        self.setTitle('Success');
                        self.setContent('Successfully availed promo!');
                      }
                    });
                  }
                });
              } else {
                self.setContent(JSON.parse(res));
                self.backgroundDismiss = true;
                self.closeIcon = true;
                self.buttons.proceed.hide();
                self.buttons.cancel.hide();
              }
            });
          },
          buttons: {
            proceed: {
              btnClass: 'btn-red',
              action: function () {
                $.alert({
                  theme: 'material',
                  boxWidth: '250px',
                  useBootstrap: false,
                  title: 'Error',
                  backgroundDismiss: true,
                  buttons: {
                    ok: {
                      isHidden: true,
                      btnClass: 'btn-green'
                    },
                    proceed: {
                      isHidden: true,
                      btnClass: 'btn-green',
                      action: function () {
                        window.location.href = "./send_promo_request.php?id=" + id;
                      }
                    },
                    cancel: {
                      isHidden: true,
                      btnClass: 'btn-secondary',
                      action: function () {}
                    }
                  },
                  content: function () {
                    var self = this;

                    return $.post("./../functions/avail_promo.php", {id: id}, function (res) {
                      console.log(res);
                      if(res == 1) {
                        self.setContent('Promo has not yet started!');
                      } else if(res == 2) {
                        self.setContent('Promo has already ended!');
                      } else if(res == 3) {
                        self.setContent('You have already availed this promo!');
                      } else if(res == 5) {
                        self.setTitle('Send Identification Card');
                        self.setContent('You are about to avail a permanent promo. Availing permanent promos require you to send a request to the gym admin by uploading a verified ID depending on the promo requirements. Proceed?');
                        self.setBoxWidth('325px');
                        self.buttons.proceed.show();
                        self.buttons.cancel.show();
                        self.backgroundDismiss = false;
                        self.closeIcon = true;
                      } else {
                        self.backgroundDismiss = false;
                        self.buttons.ok.show();
                        self.buttons.ok.setText('close');
                        self.buttons.ok.action = function () {
                          $("#availed-promo").addClass("text-green");
                          $("#availed-promo").css("text-decoration", "underline");
                          $("#availed-promo").text(res);
                        }
                        self.setTitle('Success');
                        self.setContent('Successfully availed promo!');
                      }
                    });
                  }
                });
              }
            },
            cancel: {
              btnClass: 'btn-secondary',
              action: function () {}
            },
          },
        });
      }

      document.addEventListener('click', (evt) => {
        let target = evt.target;
        let checkModal = document.getElementById('promo-modal-check')
        let buttons = document.getElementsByClassName('btn btn-reg');

        do {
          for(let i = 0; i<buttons.length; i++) {
            if(target == buttons[i] || target == checkModal) {
              return;
            }
          }

          target = target.parentNode;
        } while(target);
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
    }
  </script>
</body>
</html>