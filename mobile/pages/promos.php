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
      width: 50%;
      margin: 0 !important;
      margin-top: 10px !important;
    }

    .no-promos-div {
      min-height: 40vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }
  </style>
</head>
<body>
  <div class="modal" id="promo-modal">
    <div class="modal-lg" id="promo-modal-check" style="padding-bottom: 0">
      <div class="close-modal">
        <span href="#" onclick="closeModal()">&#x2716;</span>
      </div>
      <h2 id="promo-name"></h2>
      <h4></h4>
      <h4 class="fw-100" id="promo-date"></h4>
      <hr>
      <p id="promo-description"></p>
      <div class="modal-footer-btn" style="flex-direction: column; justify-content: center; align-items: center; text-align: center">
        <button class="btn btn-green" style="margin-bottom: 5px" id="avail-promo" onclick="availPromo(this)">Avail promo</button>
      </div>
    </div>
  </div>
  <div class="modal" id="avail-success">
    <div class="modal-sm">
      <div class="close-modal">
        <span href="#" onclick="closeModal()">&#x2716;</span>
      </div>
      <h4 id="avail-message"></h4>
    </div>
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
      <i class="material-icons" style="font-size: 32px;" id="menu">menu</i>
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
          if(mysqli_num_rows($res) == 1) {
            $row = mysqli_fetch_assoc($res);
          
          ?>
          <h1 class="text-green" style="text-decoration: underline"><?php echo $row["promo_name"] ?></h1>
          <?php
          } else if(mysqli_num_rows($res) == 2) {
            $sql = "SELECT MP.*, P.promo_name, P.promo_type, P.amount 
                  FROM memberpromos AS MP 
                  INNER JOIN promo AS P ON MP.promo_id = P.promo_id 
                  WHERE MP.member_id = '".$_SESSION["member_id"]."' AND MP.status = 'Active' AND P.promo_type = 'Seasonal'"; 
            $res = mysqli_query($con, $sql);
          
            $row = mysqli_fetch_assoc($res);
          
          ?>
          <h1 class="text-green" style="text-decoration: underline"><?php echo $row["promo_name"] ?></h1>
          <?php
          } else {
          ?>
          <h1>N/A</h1>
          <?php
          }
          ?>
        </span>
        <div class="promo-div">
          <h3>Available seasonal promos</h3>
          <?php 
          $sql = "SELECT * FROM promo WHERE promo_type = 'Seasonal' AND status = 'Active' ORDER BY promo_starting_date ASC";
          $res = mysqli_query($con, $sql);

          if(mysqli_num_rows($res)) {
            while($row = mysqli_fetch_assoc($res)):
          ?>
          <div class="promo-list-div text-primary shadow-1">
            <h3><?php echo $row["promo_name"] ?></h3>
            <p><strong>P<?php echo $row["amount"] ?> off &#x00B7 </strong> 
            <?php 
            $startDate = date("M d", strtotime($row["promo_starting_date"]));
            $endDate = date("M d", strtotime($row["promo_ending_date"]));
            echo $startDate?> - <?php echo $endDate ?>
            </p>
            <button class="btn btn-reg btn-red" data-id="<?php echo $row["promo_id"] ?>" onclick="showPromo(this)">View promo details</button>
          </div>
          <?php
            endwhile;
          } else {
          ?>
          <div class="no-promos-div text-disabled">
            There are no seasonal promos available as of the moment.
          </div>
          <?php
          }
          ?>
        </div>
      </div>
    </div>
  </main>

  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <script src="./../js/sidebar.js"></script>
  <script>
    window.onload = () => {
      showPromo = (elem) => {
        let promoModal = $('#promo-modal');
        let promoName = $('#promo-name');
        let promoDate = $('#promo-date');
        let promoDesc = $('#promo-description');
        let availBtn = $('#avail-promo');
        let id = elem.getAttribute('data-id');

        $.get("./../functions/promo_details.php?id=" + id, function(res) {
          let data = JSON.parse(res);

          promoName.text(data.promo_name);
          promoDate.text(`${data.promo_starting_date} - ${data.promo_ending_date}`);
          promoDesc.text(data.promo_description);
          availBtn.attr("data-id", data.promo_id);
        }).then(() => {
          promoModal.css("display", "flex");
        });
      }

      availPromo = (el) => {
        let id = el.getAttribute('data-id');
        $.post("./../functions/avail_promo.php", {id: id}, function(res) {
          if(res == 1) {
            $("#avail-message").removeClass("text-red").addClass("text-green").text("Successfully availed promo!");
            $("#avail-success").css("display", "flex");
          } else {
            $("#avail-message").removeClass("text-green").addClass("text-red").text(res);
            $("#avail-success").css("display", "flex");
          }
        });
      }

      closeModal = () => {
        document.getElementById('promo-modal').style.display = 'none';
        $("#avail-success").css("display", "none");
      }

      document.addEventListener('click', (evt) => {
        let target = evt.target;
        let modal = document.getElementById('promo-modal');
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
        modal.style.display = 'none';
      })
    }
  </script>
</body>
</html>