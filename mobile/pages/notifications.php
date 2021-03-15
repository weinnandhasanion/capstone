<?php 
require "./../functions/connect.php";
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Notifications Page</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="./../css/default.css">
  <link rel="stylesheet" href="./../css/mediaquery.css">
  <link rel="icon" href="./../img/gym_logo.png">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <style>
    .main-cont {
      padding: 0 !important;
    }

    .notif-content {
      margin-top: 10vh;
      width: 100% !important;
      min-height: 60vh;
      border-bottom: none !important;
    }

    .no-notifs {
      display: none;
      justify-content: center;
      align-items: center;
      flex-direction: column;
      border-bottom: none !important;
    }

    .list-tile {
      display: flex;
      justify-content: space-between;
      border-bottom: 1px solid black;
    }

    .left {
      padding: 15px;
      white-space: nowrap;
      text-overflow: ellipsis !important;
      overflow: hidden;
      position: relative;
    }

    .mask {
      position: absolute;
      top: 0;
      width: 100%;
      height: 100%;
    }

    .right {
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .right i {
      position: relative;
    }

    .popup {
      width: 200px;
      height: 40px;
      padding: 5px;
      background-color: white;
      z-index: 10 !important;
      border-radius: 5px;
      box-shadow: black 1px 1px 10px;
      position: absolute;
      right: 0;
      display: none;
      align-items: center;
    }
  </style>
</head>
<body>
  <div class="popup" id="popup">
    Delete notification
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
      <a href="./program.php">
        <span>
          <i class="material-icons">settings</i>
          <h2>Program</h2>
        </span>
      </a>
      <a href="#" class="active">
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
      <h2>Notifications</h2>
    </div>
    <div class="icon-div">
      <div class="icon-cont">
        <i class="material-icons">notifications_active</i>
      </div>
    </div>
    <div class="main-cont">
      <div class="notif-content" id="notif-content">
        <div class="no-notifs" id="no-notif">
          <i class="material-icons text-disabled" style="font-size: 100px;">notifications_off</i>
          <p class="text-disabled">You have no new notifications</p>
        </div>
        <?php 
        $sql = "SELECT mn.*, n.notif_message FROM member_notifs AS mn
                INNER JOIN notifications AS n ON mn.notif_id = n.notif_id
                WHERE member_id = '".$_SESSION["member_id"]."'
                AND NOT status = 'Deleted'
                ORDER BY datetime_sent DESC";
        $res = mysqli_query($con, $sql);

        if(mysqli_num_rows($res) > 0) {
          while($row = mysqli_fetch_assoc($res)) {
            if($row["status"] == "Unread") {
        ?>
        <div class="list-tile" id='<?= $row["id"] ?>'>
          <div class="left">
            <h4 id="message-<?= $row["id"] ?>" class="notif-message fw-700">
              <i id="unread-<?= $row["id"] ?>" class="material-icons" style="color: dodgerblue; font-size: 18px; vertical-align: middle;">fiber_manual_record</i>
              <?= $row["notif_message"] ?>
            </h4>
            <small class="text-disabled"><?= date("M d, Y &#183; h:i A", strtotime($row["datetime_sent"])) ?></small>
            <div class="mask" id="<?= $row["id"] ?>"></div>
          </div>
          <div class="right">
            <i class="material-icons text-disabled notif-more" data-id="<?= $row["id"] ?>" style="font-size: 32px">more_vert</i>
          </div>
        </div>   
        <?php
            } else {
        ?>
        <div class="list-tile" id='<?= $row["id"] ?>'>
          <div class="left">
            <h4 class="notif-message fw-400">
              <?= $row["notif_message"] ?>
            </h4>
            <small class="text-disabled"><?= date("M d, Y &#183; h:i A", strtotime($row["datetime_sent"])) ?></small>
            <div class="mask" id="<?= $row["id"] ?>"></div>
          </div>
          <div class="right">
            <i class="material-icons text-disabled notif-more" data-id="<?= $row["id"] ?>" style="font-size: 32px">more_vert</i>
          </div>
        </div>  
        <?php
            }
          }
        }
        ?>
      </div>
    </div>
  </main>

  <div class="modal" id="notifs-modal">
    <div class="modal-md">
      <div class="close-modal">
        <span href="#" onclick="closeModal()">&#x2716;</span>
      </div>
      <h3 class="fw-400" id="notif-message"></h3>
      <small class="text-disabled" id="notif-datetime"></small>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <script src="./../js/sidebar.js"></script>
  <script>
    window.onload = () => {
      if(document.getElementsByClassName('list-tile').length == 0) {
        let content = document.getElementById('notif-content');
        content.style.display = 'flex';
        content.style.justifyContent = 'center';
        content.style.alignItems = 'center';
        document.getElementById('no-notif').style.display = 'flex';
      } else {
        let content = document.getElementById('notif-content');
        content.style.display = 'block';
      }

      // popup
      let mores = document.getElementsByClassName('notif-more');
      let popup = document.getElementById('popup');
      for(let i = 0; i < mores.length; i++) {
        mores[i].addEventListener('click', (e) => {
          id = e.target.parentNode.parentNode.id;
          position = e.target.getBoundingClientRect().top;
          popup.style.top = `${position + 30}px`;
          if(popup.style.display == 'flex') {
            popup.style.display = 'hidden';
          } else {
            popup.style.display = 'flex';
          }
          document.getElementsByTagName('main')[0].style.overflow = 'hidden';
        });
      }
      
      popup.onclick = (e) => {
        $.get("./../functions/delete_notif.php?id=" + id, function(res) {
          console.log(res);
          if(res == 1) {
            document.getElementById(id).remove();
            popup.style.display = 'none';
            if(document.getElementsByClassName('list-tile').length == 0) {
              let content = document.getElementById('notif-content');
              content.style.display = 'flex';
              content.style.justifyContent = 'center';
              content.style.alignItems = 'center';
              document.getElementById('no-notif').style.display = 'flex';
            } else {
              let content = document.getElementById('notif-content');
              content.style.display = 'block';
            }
          } else {
            alert("Unknown error: Couldn't delete notification.");
          }
        });
      }

      document.onpointerup = (e) => {
        let mores = $(".notif-more");
        if(e.target != popup && e.target != mores) {
          if(popup.style.display == 'flex') {
            popup.style.display = 'none';
          }
        }
      }

      $(".mask").click(function(e) {
        e = e.target;
        
        $.get("./../functions/notif_details.php?id=" + e.id, function(res) {
          let row = JSON.parse(res);

          if(row.isUnread) {
            $("#unread-" + row.id).remove();
            $("#message-" + row.id).removeClass("fw-700").addClass("fw-400");
          }

          $("#notif-message").text(row.notif_message);
          $("#notif-datetime").html(row.date);
        }).then(() => {
          $("#notifs-modal").css("display", "flex");
        });
      });

      closeModal = () => {
        document.getElementById('notifs-modal').style.display = 'none';
        $("#avail-success").css("display", "none");
      }

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